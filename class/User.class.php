<?php

class User {
	private $userdb;

	private $dn = "";
	private $uid = "";
	private $pass = null;
	private $mails = array();

	private $verified = false;

	public function __construct($userdb, $uid, $mails) {
		$this->userdb = $userdb;
		$this->uid = $uid;
		$this->mails = $mails;
	}

	public function save() {
		if (!$this->userdb->modifyUser($this->getUid(), $this->pass, $this->getMails())) {	
			return false;
		}
	}

	public function addMail($mail) {
		$this->mails[] = $mail;
	}

	public function deleteMail($mail) {
		unset($this->mails[array_search($mail, $this->getMails())]);
	}

	public function changePassword($password) {
		$this->pass = UserDatabase::generatePasswordHash($password);
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

	public function hasMail() {
		return count($this->getMails()) > 0;
	}

	public function getMails() {
		return is_array($this->mails) ? $this->mails : array();
	}

	public function verifyMailAddress($mail) {
		return $this->userdb->verifyMailAddress($this->getUid(), $mail);
	}

	/**
	 * @return string|bool returns first unverified mail adress or false
	 */
	public function getUnverfiedMailAddress()
	{
		if ($this->hasMail()) {
			foreach ($this->getMails() as $mail) {
				if (!$this->isVerified($mail))
					return $mail;
			}
			return false;
		}
		return false;
	}

	public function isVerified($mail = null) {
		if ($mail === null) {
			foreach ($this->getMails() as $mail) {
				if ($this->isVerified($mail)) {
					return true;
				}
			}
			return false;
		}
		return $this->userdb->isVerified($this->getUid(), $mail);
	}

	public function isAdmin() {
		return $this->userdb->isAdmin($this->getUid());	
	}
}

?>
