<?php

class home {
	private $options;
	
	public function __construct($options) {
		$this->options = $options;
	}

	public function main() {
		global $user, $smarty;

		$smarty->assign("user", $user->getUid());

		if (!$user->hasMail()) {
			$smarty->assign("showAddMail", 1);
		} else if (!$user->isVerified()) {
			$smarty->assign("showVerify", 1);
			$smarty->assign("userMail", $user->getUnverfiedMailAddress());
		}

		return $smarty->fetch("home.tpl");
	}
}

?>
