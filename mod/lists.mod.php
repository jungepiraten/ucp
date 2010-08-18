<?php

require_once(dirname(__FILE__) . "/../class/Mailman.class.php");

class lists
{

	private function overview() {
		global $config, $user, $smarty;

		ob_start();

		$mails = array();
		foreach ($user->getMails() as $mail) {
			if ($user->isVerified($mail)) {
				$mails[] = $mail;
			}
		}
		$smarty->assign("mails", $mails);

		$mailman = new Mailman($user);

		if (isset($_POST["submit"])) {
			foreach ($mails as $mail) {
				foreach ($_POST["old"][$mail] as $key => $value) {
					if ($value == 0 && $_POST["new"][$mail][$key] != 0) {
						// add user to list
						$mailman->getList($key)->addMember($mail);
					}
					if ($value == 1 && $_POST["new"][$mail][$key] != 1) {
						// remove user from list
						$mailman->getList($key)->removeMember($mail);
					}
				}
			}
		}

		$lists = array();
		foreach ($mailman->getLists() as $list) {
			$members = array();
			$has = false;
			foreach ($mails as $mail) {
				if ($list->hasMember($mail)) {
					$members[] = $mail;
					$has = true;
				}
			}
			$lists[] = array($list->getName(), $list->getDescription(), $has, $members);
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
