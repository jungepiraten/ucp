<?php

require_once(dirname(__FILE__) . "/../class/Mailman.class.php");

class profile
{

	private function overview() {
		global $smarty, $user;

		ob_start();

		$smarty->assign("user", $user->getUid());
		if ($user->isVerified()) {
			$smarty->assign("mail", $user->getMail()
			. "<br /><a href=\"?do=change_mail\">[&auml;ndern]</a>");
		} else {
			$smarty->assign("mail", "<i>" . $user->getMail() . "</i> <b>(nicht verifiziert)</b>"
			. "<br /><a href=\"?do=change_mail\">[&auml;ndern]</a>"
			. "- <a href=\"?do=verify\">[verifizieren]</a>"
			);
		}
		$smarty->assign("pass", "********"
			. "<br /><a href=\"?do=change_password\">[&auml;ndern]</a>");
		$smarty->display("profile.tpl");

		$content = ob_get_contents();
		ob_end_clean();
		return $content;
	}

	private function changeMail() {
		global $smarty, $user, $userdb;

		ob_start();

		$smarty->assign("mail", $user->getMail());
		if (isset($_POST["mail"])) {
			$oldmail = stripslashes($_POST["oldmail"]);
			$mail = stripslashes($_POST["mail"]);
			if (!in_array($oldmail, $user->getMails())) {
				echo "<p>Die Mailadresse wird derzeit nicht benutzt.</p>";
				$smarty->display("change_mail.tpl");
			} else if (!$userdb->isValidMailAddress($mail)) {
				echo "<p>Die angegebene E-Mail Adresse ist ung&uuml;ltig</p>";
				$smarty->display("change_mail.tpl");
			} else if (in_array($mail, $user->getMails())) {
				echo $this->overview();
			} else if ($userdb->mailUsed($mail)) {
				echo "<p>Die angegebene E-Mail Adresse wird bereits bei einem anderen Account verwendet.</p>";
				$smarty->display("change_mail.tpl");
			} else {
				if (isset($_POST["movelists"])) {
					$mailman = new Mailman($user);
					foreach ($mailman->getLists() as $list) {
						if ($list->hasMember($oldmail)) {
							$list->removeMember($oldmail);
							$list->addMember($mail);
						}
					}
				}
				$user->changeMail($oldmail, $mail);
				$user->save();
				echo "<p>Die E-Mail Adresse wurde erfolgreich ge&auml;ndert.</p>";
				echo $this->overview();
			}
		} else {
			$smarty->display("change_mail.tpl");
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

	private function verify() {
		global $smarty, $user, $config;

		ob_start();

		if (isset($_POST["send"])) {
			$formatted_uid = base64_encode($user->getUid());
			$formatted_email = base64_encode($user->getMail());
			$timestamp = time();
			$hash = md5($config["misc"]["secret"] . " " . $timestamp . " " . $formatted_uid . " " . $formatted_email);
			$verification_link = $config['site']['url'] . "/index.php?module=verify&u=" . $formatted_uid . "&m=" . $formatted_email . "&h=" . $hash . "&t=" . $timestamp;
			$text = <<<verification_mail
Ahoi {$user->getUid()},

jemand hat einen Account im User Control Panel der Jungen Piraten
( http://ucp.junge-piraten.de/ ) erstellt und dabei deine E-Mail
Adresse benutzt.
Um diese E-Mail Adresse zu bestätigen, klick bitte auf:
{$verification_link}

Falls du den Account nicht erstellt hast, ignoriere dies E-Mail
einfach :o)

Klarmachen zum Ändern
verification_mail;
			if ($config["mail"]["use_smtp"]) {
				// TODO *hust*
			} else {
				mail($user->getMail(), "[Junge Piraten] =?UTF-8?Q?Best=C3=A4tigung?= deiner E-Mail Adresse", $text, "From: " . $config["mail"]["from"] . "\r\n" . "Content-Type: text/plain; Charset=UTF-8");
				echo "<p>Die Best&auml;tigungsmail wurde versandt.</p>";
				echo $this->overview();
			}
		} else {
			$smarty->assign("mail", $user->getMail());
			$smarty->display("verify_mail.tpl");
		}

		$content = ob_get_contents();
		ob_end_clean();
		return $content;
	}

	public function main() {
		global $config, $smarty, $user;

		switch ($_GET["do"]) {
			case "change_mail":
				$content = $this->changeMail();
				break;
			case "verify":
				$content = $this->verify();
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
