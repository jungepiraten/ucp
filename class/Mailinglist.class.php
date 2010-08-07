<?php

class Mailinglist
{
	private $name = "";
	private $description = "";
	private $subscribe_policy = 0;
	private $has_member = 0;

	function __construct($name, $description, $subscribe_policy, $has_member) {
		$this->name = $name;
		$this->description = $description;
		$this->subscribe_policy = $subscribe_policy;
		$this->has_member = $has_member;
	}

	function addMember($member) {
		global $user;
		exec("newgrp list <<< \"" . MAILMAN_BIN_PATH . "add_members --welcome-msg=n --admin-notify=n --regular-members-file=- " . $this->getName() . " <<< " . $member . "\"");
		if ($member == $user->getMail()) {
			$this->has_member = true;
		}
	}

	function removeMember($member) {
		global $user;
		exec("newgrp list <<< \"" . MAILMAN_BIN_PATH . "remove_members --nouserack --noadminack --file=- " . $this->getName() . " <<< " . $member . "\"");
		if ($member == $user->getMail()) {
			$this->has_member = false;
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

	function getHasMember() {
		return $this->has_member;
	}

}

?>
