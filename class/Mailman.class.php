<?php

class Mailman
{
	private $lists = array();

	function __construct() {
		$this->loadAttributes();
	}

	function loadAttributes() {
		global $config, $user;

		$this->setLists(array());
		exec("newgrp list <<< \"" . $config[site][path] . "/lib/ucp_mailman.py " . $user->getMail() . "\"", $lists);
		foreach($lists as $value) {
			$listinfo = explode(",", $value);
			if ($listinfo[2] == 1) { // Oeffentliche Liste?
				$this->lists[] = new Mailinglist($listinfo[0], $listinfo[1], $listinfo[2], $listinfo[3]);
			}
		}
	}

	function setLists($lists) {
		$this->lists = $lists;
	}

	function getLists() {
		return $this->lists;
	}

	function &getList($listname) {
		foreach ($this->lists as $value) {
			if ($value->getName() == $listname) return ($value);
		}
	}

	function addList($list) {
		$this->lists[] = $list;
	}

	function hasList($list) {
		foreach ($this->getLists() as $value) {
			if ($value == $list) {
				return true;
			}
		}
		return false;
	}
}

?>
