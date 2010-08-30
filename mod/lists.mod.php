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

		if (isset($_POST["save"])) {
			foreach ($mailman->getLists() as $list) {
				$mail = stripslashes($_POST["mail"][$list->getName()]);
				if ( (empty($mail) && $list->hasMember() )
				  || (!empty($mail) && !$list->hasMember($mail) ) ) {
					foreach ($list->getMembers() as $member) {
						$list->removeMember($member);
					}
				}
				if (!empty($mail) && !$list->hasMember($mail)) {
					$list->addMember($mail);
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
			echo "Bevor du deine Mailinglisten verwalten kannst, muss mindestens eine E-Mail Adresse durch eine Best&auml;tigungsmail verifiziert werden.";
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
