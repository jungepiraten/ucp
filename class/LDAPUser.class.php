<?php

class LDAPUser
{
	private $dn = "";
	private $uid = "";
	private $mail = "";
	private $verified = false;

	private $replace_attrs = array();

	public function __construct($uid, $dn) {
		$this->setUid($uid);
		$this->setDn($dn);
		$this->readFromLdap();
	}

	public function readFromLdap() {
		global $config, $ldapconn;
		$dn = $this->getDn();
		ldap_bind($ldapconn, $config["ldap"]["rdn"], $config["ldap"]["pass"]);
		$resource = ldap_search($ldapconn, $config["ldap"]["base_dn"], "uid=" . ldap_escape($this->getUid(), true));
		$entry = ldap_first_entry($ldapconn, $resource);
		$attrs = ldap_get_attributes($ldapconn, $entry);
		$this->setUid($attrs[uid][0]);
		$this->setMail($attrs[mail][0]);
		$this->setVerified(LDAPUserManagement::isVerified($this->getUid()));
	}

	public function writeToLdap() {
		global $config, $ldapconn;

		if (count($this->replace_attrs) > 0) {
			$bind = ldap_bind($ldapconn, $config["ldap"]["rdn"], $config["ldap"]["pass"]);
			if (!ldap_modify($ldapconn, $this->getDn(), $this->replace_attrs)) {
				return false;
			}

			if (isset($this->replace_attrs["mail"]) && $this->verified) {
				$old_dn = $this->getDn();
				$new_rdn = "uid=" . ldap_escape($this->getUid(), true);
				ldap_rename($ldapconn, $old_dn, $new_rdn, $config["ldap"]["accounts_dn"], true);
				$this->setDn($new_rdn . "," . $config["ldap"]["accounts_dn"]);
				$this->setVerified(false);
			}
		}

	}

	public function changeMail($mail) {
		$this->mail = $mail;
		$this->replace_attrs["mail"] = ldap_escape($mail);
	}

	public function changePassword($password) {
		$this->replace_attrs["userPassword"] = LDAPUserManagement::generatePasswordHash($password);
	}

	public function setDn($dn) {
		$this->dn = $dn;
	}

	public function getDn() {
		return $this->dn;
	}

	public function setUid($uid) {
		$this->uid = $uid;
	}

	public function getUid() {
		return $this->uid;
	}

	public function setMail($mail) {
		$this->mail = $mail;
	}

	public function getMail() {
		return $this->mail;
	}

	public function setVerified($verified) {
		$this->verified = $verified;
	}

	public function isVerified() {
		return $this->verified;
	}

}

?>
