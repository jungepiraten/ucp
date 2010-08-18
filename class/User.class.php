<?php

class User {
	private $userdb;

	private $dn = "";
	private $uid = "";
	private $mail = "";
	private $verified = false;

	private $replace_attrs = array();

	public function __construct($userdb, $uid, $mail) {
		$this->userdb = $userdb;
		$this->uid = $uid;
		$this->mail = $mail;
	}

	public function save() {
		if (count($this->replace_attrs) > 0) {
			if (!$this->userdb->modifyUser($this->getUid(), $this->replace_attrs)) {	
				return false;
			}
		}
	}

	public function changeMail($oldmail, $mail) {
		$this->mail = $mail;
		$this->replace_attrs["mail"] = ldap_escape($mail);
	}

	public function changePassword($password) {
		$this->replace_attrs["userPassword"] = UserDatabase::generatePasswordHash($password);
	}

	public function setDn($dn) {
		$this->dn = $dn;
	}

	public function getDn() {
		return $this->dn;
	}

	public function getUid() {
		return $this->uid;
	}

	public function addListVerifyQueue($mail, $list) {
		$this->userdb->addListVerifyQueue($mail, $list);
	}

	public function popListVerifyQueue($mail) {
		return $this->userdb->popListVerifyQueue($mail);
	}

	public function getMails() {
		return array($this->mail);
	}

	public function verifyMailAddress($mail) {
		return $this->userdb->verifyMailAddress($this->getUid(), $mail);
	}

	// TODO mehrere Mailadressen / user
	public function getMail() {
		return $this->mail;
	}

	public function isVerified() {
		return $this->userdb->isVerified($this->getUid(), $this->getMail());
	}
}

?>
