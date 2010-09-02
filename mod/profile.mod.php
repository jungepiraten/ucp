<?php

class profile
{

	private function overview() {
		global $smarty, $user;

		ob_start();

		$smarty->assign("user", $user->getUid());
		$mailadresses = $user->getMails();
		$mails = array();
		foreach ($mailadresses as $mail) {
			$mails[] = array($mail, $user->isVerified($mail));
		}
		$smarty->assign("mails", $mails);
		$smarty->display("profile.tpl");

		$content = ob_get_contents();
		ob_end_clean();
		return $content;
	}

	private function addMail() {
		global $config, $smarty, $user, $userdb;

		ob_start();

		$mail = stripslashes($_POST["mail"]);
		$smarty->assign("mail", $mail);
		if (isset($_POST["act"])) {
			if (!$userdb->isValidMailAddress($mail)) {
				echo "<p>Die angegebene E-Mail Adresse ist ung&uuml;ltig</p>";
				$smarty->display("add_mail.tpl");
			} else if (is_array($user->getMails()) && in_array($mail, $user->getMails())) {
				echo $this->overview();
			} else if ($config["misc"]["singletonmail"] && $userdb->mailUsed($mail)) {
				echo "<p>Die angegebene E-Mail Adresse wird bereits bei einem anderen Account verwendet.</p>";
				$smarty->display("add_mail.tpl");
			} else {
				$user->addMail($mail);
				$user->save();
				echo "<p>Die E-Mail Adresse wurde erfolgreich hinzugef&uuml;gt.</p>";
				if (!$user->isVerified($mail)) {
					header("Location: index.php?module=profile&do=verify_mail&mail=" . urlencode($mail));
					exit;
				}
				echo $this->overview();
			}
		} else {
			$smarty->display("add_mail.tpl");
		}

		$content = ob_get_contents();
		ob_end_clean();
		return $content;
	}

	private function deleteMail() {
		global $smarty, $user, $userdb;

		ob_start();

		$smarty->assign("mail", stripslashes($_REQUEST["mail"]));
		$allmails = $user->getMails();
		$mails = array();
		foreach ($allmails as $mail) {
			if ($user->isVerified($mail)) {
				$mails[] = $mail;
			}
		}
		$smarty->assign("mails", $mails);
		if (isset($_POST["act"])) {
			$mail = stripslashes($_POST["mail"]);
			$listsoption = stripslashes($_POST["listsoption"]);
			$movemail = stripslashes($_REQUEST["movemail"]);
			if (!in_array($mail, $user->getMails())) {
				echo "<p>Die Mailadresse wird derzeit nicht benutzt.</p>";
				echo $this->overview();
			} else if ($listsoption == "move" && !$user->isVerified($movemail)) {
				echo "<p>Kann nicht zu dieser Mailadress verschieben: Sie ist nicht verifiziert.</p>";
				$smarty->display("delete_mail.html.tpl");
			} else if ($listsoption == "move" && $mail == $movemail) {
				echo "<p>Witzbold ;)</p>";
				$smarty->display("delete_mail.html.tpl");
			} else {
				$mailman = new Mailman($user);
				if ($listsoption == "delete") {
					$mailman = new Mailman($user);
					foreach ($mailman->getLists() as $list) {
						if ($list->hasMember($mail)) {
							$list->removeMember($mail);
						}
					}
				}
				if ($listsoption == "move") {
					$mailman = new Mailman($user);
					foreach ($mailman->getLists() as $list) {
						if ($list->hasMember($mail)) {
							$list->removeMember($mail);
							$list->addMember($movemail);
						}
					}
				}
				$user->deleteMail($mail);
				$user->save();
				echo "<p>Die E-Mail Adresse wurde erfolgreich gel&ouml;scht.</p>";
				echo $this->overview();
			}
		} else {
			$smarty->display("delete_mail.tpl");
		}

		$content = ob_get_contents();
		ob_end_clean();
		return $content;
	}

	private function changePassword() {
		global $smarty, $user, $userdb;

		ob_start();

		if (isset($_POST["pass"]) && isset($_POST["pass_repeat"])) {
			if (empty($_POST["pass"])) {
				echo $this->overview();
			} else if (!isset($_POST["old_pass"])) {
				echo "<p>Sie haben das alte Passwort nicht angegeben.</p>";
				$smarty->display("change_password.tpl");
			} else if (!$userdb->authenticate($user->getUid(), $_POST["old_pass"])) {
				echo "<p>Das alte Passwort ist falsch.</p>";
				$smarty->display("change_password.tpl");
			} else if ($_POST["pass"] != $_POST["pass_repeat"]) {
				echo "<p>Die beiden Passw&ouml;rter stimmen nicht &uuml;berein.</b>";
				$smarty->display("change_password.tpl");
			} else if (strlen($_POST["pass"]) < 6) {
				echo "<p>Das Passwort muss mindestens 6 Zeichen lang sein.";
				$smarty->display("change_password.tpl");
			} else {
				echo "<p>Das Passwort wurde erfolgreich ge&auml;ndert.";
				$user->changePassword($_POST["pass"]);
				$user->save();
				echo $this->overview();
			}
		} else {
			$smarty->display("change_password.tpl");
		}

		$content = ob_get_contents();
		ob_end_clean();

		return $content;
	}

	private function verify_mail() {
		global $smarty, $user, $config;

		$mail = stripslashes($_REQUEST["mail"]);
		if ($user->isVerified($mail)) {
			return "<p>Diese Mailadresse wurde bereits verifiziert.</p>"; 
		}

		ob_start();

		if (isset($_POST["send"])) {
			$hash = new Hash($user->getUid() . "\0" . $mail);
			$verification_link = $config['site']['url'] . "/index.php?module=verify&v=" . $hash;
			$text = <<<verification_mail
Ahoi {$user->getUid()},

jemand hat einen Account im User Control Panel der Jungen Piraten
( http://ucp.junge-piraten.de/ ) erstellt und dabei deine E-Mail
Adresse benutzt.
Um diese E-Mail Adresse zu bestätigen, klick bitte auf:
{$verification_link}

Falls du den Account nicht erstellt hast, ignoriere diese E-Mail
einfach :o)

Klarmachen zum Ändern
verification_mail;
			mail($mail, "[Junge Piraten] =?UTF-8?Q?Best=C3=A4tigung?= deiner E-Mail Adresse", $text, "From: " . $config["mail"]["from"] . "\n" . "Content-Type: text/plain; Charset=UTF-8");
			echo "<p>Die Best&auml;tigungsmail wurde versandt.</p>";
			echo $this->overview();
		} else {
			$smarty->assign("mail", $mail);
			$smarty->display("verify_mail.tpl");
		}

		$content = ob_get_contents();
		ob_end_clean();
		return $content;
	}

	public function main() {
		global $config, $smarty, $user;

		switch ($_GET["do"]) {
			case "add_mail":
				$content = $this->addMail();
				break;
			case "delete_mail":
				$content = $this->deleteMail();
				break;
			case "verify_mail":
				$content = $this->verify_mail();
				break;
			case "change_password":
				$content = $this->changePassword();
				break;
			default:
				$content = $this->overview();
		}

		return $content;
	}

}

?>
