<?php

class Mailinglist {
	private $mailman;

	private $name = "";
	private $description = "";
	private $subscribe_policy = 0;
	private $members = array();

	function __construct($mailman, $name, $description, $subscribe_policy, $members) {
		$this->mailman = $mailman;
		$this->name = $name;
		$this->description = $description;
		$this->subscribe_policy = $subscribe_policy;
		$this->members = $members;
	}

	function addMember($member) {
		$this->mailman->addListMember($this->getName(), $member);
		if (!in_array($member, $this->members)) {
			$this->members[] = $member;
		}
	}

	function removeMember($member) {
		$this->mailman->removeListMember($this->getName(), $member);
		if (in_array($member, $this->members)) {
			unset($this->members[array_search($member, $this->members)]);
		}
	}

	function getName() {
		return $this->name;
	}

	function getDescription() {
		return $this->description;
	}

	function getSubscribePolicy() {
		return $this->subscribe_policy;
	}

	function hasMember() {
		return count($this->members) > 0;
	}

	function getMembers() {
		return $this->members;
	}

}

?>
