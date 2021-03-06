<?php

class Mailinglist {
	private $mailman;

	private $name = "";
	private $hostname = "";
	private $description = "";
	private $archiveurl = "";
	private $subscribe_policy = 0;
	private $members = array();

	function __construct($mailman, $name, $hostname, $description, $archiveurl, $subscribe_policy, $members) {
		$this->mailman = $mailman;
		$this->name = $name;
		$this->hostname = $hostname;
		$this->description = $description;
		$this->archiveurl = $archiveurl;
		$this->subscribe_policy = $subscribe_policy;
		$this->members = $members;
	}

	function getName() {
		return $this->name;
	}

	function getHostname() {
		return $this->hostname;
	}

	function getSendAddress() {
		return $this->name . "@" . $this->getHostname();
	}

	function getDescription() {
		return $this->description;
	}

	function getArchiveURL() {
		return $this->archiveurl;
	}

	function getSubscribePolicy() {
		return $this->subscribe_policy;
	}

	function addMember($member) {
		$this->mailman->addListMember($this->getName(), $member);
		if (!$this->hasMember($member)) {
			$this->members[] = $member;
		}
	}

	function removeMember($member) {
		$this->mailman->removeListMember($this->getName(), $member);
		if ($this->hasMember($member)) {
			unset($this->members[array_search($member, $this->members)]);
		}
	}

	function hasMember($member = null) {
		if ($member != null) {
			return in_array($member, $this->members);
		}
		return count($this->members) > 0;
	}

	function getMembers() {
		return $this->members;
	}

}

?>
