<?php

class home {
	private $options;
	
	public function __construct($options) {
		$this->options = $options;
	}

	public function main() {
		global $user, $smarty;

		if (!$user->hasMail()) {
			$smarty->assign("showAddMail", 1);
		} else if (!$user->isVerified()) {
			$smarty->assign("showVerify", 1);
		}

		return $smarty->fetch("home.tpl");
	}
}

?>
