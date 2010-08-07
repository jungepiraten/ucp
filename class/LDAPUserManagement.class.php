<?php

class LDAPUserManagement
{

	public function userExists($username) {
		global $config, $ldapconn;

		ldap_bind($ldapconn, $config["ldap"]["rdn"], $config["ldap"]["pass"]);
		$resource = ldap_search($ldapconn, $config["ldap"]["base_dn"], "uid=" . ldap_escape($username, true));
		if ($resource) {
			$entry = ldap_first_entry($ldapconn, $resource);
			if (@ldap_get_dn($ldapconn, $entry))
				return true;
		}
		return false;
	}

	public function mailUsed($mail) {
		global $config, $ldapconn;

		ldap_bind($ldapconn, $config["ldap"]["rdn"], $config["ldap"]["pass"]);
		$resource = ldap_search($ldapconn, $config["ldap"]["base_dn"], "mail=" . ldap_escape($mail, true));
		if ($resource) {
			$entry = ldap_first_entry($ldapconn, $resource);
			if (@ldap_get_dn($ldapconn, $entry))
				return true;
		}
		return false;
	}

	public function isVerified($username) {
		global $config, $ldapconn;

		ldap_bind($ldapconn, $config["ldap"]["rdn"], $config["ldap"]["pass"]);
		$resource = @ldap_search($ldapconn, $config["ldap"]["verified_dn"], "uid=" . ldap_escape($username, true));
		if ($resource) {
			$entry = ldap_first_entry($ldapconn, $resource);
			if (@ldap_get_dn($ldapconn, $entry))
				return true;
		}
		return false;
	}

        public function authenticate($username, $password) {
                global $config, $ldapconn;

                ldap_bind($ldapconn, $config["ldap"]["rdn"], $config["ldap"]["pass"]);
                $resource = ldap_search($ldapconn, $config["ldap"]["base_dn"], "uid=" . ldap_escape($username, true));
                if ($resource) {
                        $entry = ldap_first_entry($ldapconn, $resource);
                        $dn = @ldap_get_dn($ldapconn, $entry);
                        if ($dn && @ldap_bind($ldapconn, $dn, $password)) {
                                return $dn;
                        }
                }

                return false;
        }

	public function generatePasswordHash($password) {
		return "{MD5}" . base64_encode(pack("H*", md5($password)));
	}

	public function registerUser($username, $password, $mail) {
		global $config, $ldapconn;

		ldap_bind($ldapconn, $config["ldap"]["rdn"], $config["ldap"]["pass"]);
		$entry = array(
			"cn" => ldap_escape($username),
			"mail" => ldap_escape($mail),
			"userPassword" => LDAPUserManagement::generatePasswordHash($password),
			"objectClass" => array("inetOrgPerson"),
			"sn" => $username,
			"preferredLanguage" => "de",
		);
		if (ldap_add($ldapconn, "uid=" . ldap_escape($username,true) . "," . $config["ldap"]["accounts_dn"], $entry))
		{
			return true;
		}
	}

	public function verifyMailAddress($uid, $mail) {
		global $config, $ldapconn, $user;
		ldap_bind($ldapconn, $config["ldap"]["rdn"], $config["ldap"]["pass"]);
		$filter = "(&(uid=" . ldap_escape($uid,true) . ")(mail=" . ldap_escape($mail, true) . "))";
		$resource = ldap_search($ldapconn, $config["ldap"]["base_dn"], $filter);
		if ($resource) {
			$entry = ldap_first_entry($ldapconn, $resource);
			$old_dn = @ldap_get_dn($ldapconn, $entry);
			if ($old_dn) {
				$attrs = ldap_get_attributes($ldapconn, $entry);
				$new_rdn = "uid=" . ldap_escape($attrs[uid][0], true);
				ldap_rename($ldapconn, $old_dn, $new_rdn, $config["ldap"]["verified_dn"], true);
				$user->setDn($new_rdn . "," . $config["ldap"]["verified_dn"]);
				return true;
			}
		}
		return false;
	}

	function isValidMailAddress($mail) {
		return preg_match("/^[_a-zA-Z0-9]+(\.[_a-zA-Z0-9-]+)*@([a-zA-Z0-9-]+\.)+([a-zA-Z0-9]{2,4})$/", $mail);
	}

}

?>
