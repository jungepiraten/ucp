<?php

require_once(dirname(__FILE__) . "/../class/Mailman.class.php");
require_once(dirname(__FILE__) . "/../class/Mailinglist.class.php");

class lists
{

	private function overview() {
		global $config, $user, $smarty;

		ob_start();

		$mailman = new Mailman($user);

		if (isset($_POST["submit"])) {
			foreach ($_POST["old"] as $key => $value) {
				if ($value == 0 && $_POST["new"][$key] != 0) {
					// add user to list
					$mailman->getList($key)->addMember($user->getMail());
				}
				if ($value == 1 && $_POST["new"][$key] != 1) {
					// remove user from list
					$mailman->getList($key)->removeMember($user->getMail());
				}
			}
		}

		$lists = array();
		foreach ($mailman->getLists() as $list) {
			$lists[] = array($list->getName(), $list->getDescription(), $list->hasMember());
		}
		$smarty->assign("lists", $lists);
		$smarty->display("lists.tpl");

		$content = ob_get_contents();
		ob_end_clean();

		return $content;
	}

	public function main() {
		global $config, $user;

		ob_start();

		if (!$user->isVerified()) {
			echo "Bevor Sie Ihre Mailinglisten verwalten k&ouml;nnen, muss Ihre E-Mail Adresse durch eine Best&auml;tigungsmail verifiziert werden.";
		} else {
			switch($_GET["do"]) {
				case "overview":
				default:
					echo $this->overview();
			}
		}

		$content = ob_get_contents();
		ob_end_clean();

		return $content;
	}

}

?>
