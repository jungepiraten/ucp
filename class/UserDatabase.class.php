<?php

require_once(dirname(__FILE__) . "/User.class.php");

class UserDatabase {
	private $ldapconn;
	private $ldapserver;
	private $ldapbinddn;
	private $ldapbindpw;
	private $ldapbasedn;

	private $mysqlconn;
	private $mysqlserver;
	private $mysqluser;
	private $mysqlpw;
	private $mysqldb;

	public function __construct($ldapserver, $ldapbinddn, $ldapbindpw, $ldapbasedn, $mysqlserver, $mysqluser, $mysqlpw, $mysqldb) {
		$this->ldapserver = $ldapserver;
		$this->ldapbinddn = $ldapbinddn;
		$this->ldapbindpw = $ldapbindpw;
		$this->ldapbasedn = $ldapbasedn;
		$this->mysqlserver = $mysqlserver;
		$this->mysqluser = $mysqluser;
		$this->mysqlpw = $mysqlpw;
		$this->mysqldb = $mysqldb;
	}

	public function open() {
		$this->ldapconn = ldap_connect($this->ldapserver);
		ldap_set_option($this->ldapconn, LDAP_OPT_PROTOCOL_VERSION, 3);
		ldap_set_option($this->ldapconn, LDAP_OPT_REFERRALS, 0);
		ldap_bind($this->ldapconn, $this->ldapbinddn, $this->ldapbindpw);

		$this->mysqlconn = new MySQLi($this->mysqlserver, $this->mysqluser, $this->mysqlpw, $this->mysqldb);
	}

	public function close() {
		ldap_close($this->ldapconn);
		$this->mysqlconn->close();
	}

	public function getUserDN($username) {
		$resource = ldap_search($this->ldapconn, $this->ldapbasedn, "uid=" . ldap_escape($username, true));
		if ($resource) {
			$entry = ldap_first_entry($this->ldapconn, $resource);
			if ($dn = @ldap_get_dn($this->ldapconn, $entry))
				return $dn;
		}
		return false;
	}

	public function userExists($username) {
		return $this->getUserDN($username) !== false;
	}

	public function getUser($username) {
		$resource = ldap_search($this->ldapconn, $this->ldapbasedn, "uid=" . ldap_escape($username, true));
		if ($resource) {
			$entry = ldap_first_entry($this->ldapconn, $resource);
			$dn = @ldap_get_dn($this->ldapconn, $entry);
			if ($dn) {
				$attrs = ldap_get_attributes($this->ldapconn, $entry);
                        	return new User($this, $username, $attrs['mail'][0]);
			}
		}
		return false;
	}

        public function authenticate($username, $password) {
		$resource = ldap_search($this->ldapconn, $this->ldapbasedn, "uid=" . ldap_escape($username, true));
		if ($resource) {
			$entry = ldap_first_entry($this->ldapconn, $resource);
			$dn = @ldap_get_dn($this->ldapconn, $entry);
			if ($dn && @ldap_bind($this->ldapconn, $dn, $password)) {
				ldap_bind($this->ldapconn, $this->ldapbinddn, $this->ldapbindpw);
				$attrs = ldap_get_attributes($this->ldapconn, $entry);
                        	return new User($this, $attrs['uid'][0], $attrs['mail'][0]);
			}
		}
		return false;
        }

	public function registerUser($username, $password, $mail) {
		$entry = array(
			"cn" => ldap_escape($username),
			"mail" => ldap_escape($mail),
			"userPassword" => $this->generatePasswordHash($password),
			"objectClass" => array("inetOrgPerson"),
			"sn" => $username,
			"preferredLanguage" => "de",
		);
		if (ldap_add($this->ldapconn, "uid=" . ldap_escape($username,true) . "," . $this->ldapbasedn, $entry)) {
			return true;
		}
	}

	public function modifyUser($uid, $attrs) {
		$dn = $this->getUserDN($uid);
		if (!ldap_modify($this->ldapconn, $dn, $attrs)) {
			return false;
		}
	}

	public function mailUsed($mail) {
		$resource = ldap_search($this->ldapconn, $this->ldapbasedn, "mail=" . ldap_escape($mail, true));
		if ($resource) {
			$entry = ldap_first_entry($this->ldapconn, $resource);
			if (@ldap_get_dn($this->ldapconn, $entry))
				return true;
		}
		return false;
	}

	public function isVerified($username, $mail) {
		$query = "SELECT 1 FROM `verifiedMail` WHERE `mail` LIKE '" . $this->mysqlconn->real_escape_string($mail) . "' AND `uid` = '" . $this->mysqlconn->real_escape_string($username) . "'";
		$rslt = $this->mysqlconn->query($query);
		return $rslt->num_rows > 0;
	}

	public function verifyMailAddress($username, $mail) {
		$query = "INSERT INTO `verifiedMail` (`mail`, `uid`) VALUES ('" . $this->mysqlconn->real_escape_string($mail) . "', '" . $this->mysqlconn->real_escape_string($username) . "')";
		$rslt = $this->mysqlconn->query($query);
		return $this->mysqlconn->affected_rows > 0;
	}

	public function generatePasswordHash($password) {
		return "{MD5}" . base64_encode(pack("H*", md5($password)));
	}

	public function isValidMailAddress($mail) {
		return preg_match("/^[_a-zA-Z0-9]+(\.[_a-zA-Z0-9-]+)*@([a-zA-Z0-9-]+\.)+([a-zA-Z0-9]{2,4})$/", $mail);
	}

}

?>
