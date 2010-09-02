<?php

class lostpw {
	public function changePassword() {
		global $smarty, $config, $userdb, $user;
		ob_start();

		$v = stripslashes($_REQUEST["v"]);
		$smarty->assign("v", $v);
		$hash = Hash::getByHash($v);
		$uid = $hash->getData();

		if (isset($_REQUEST["pass"])) {
			$smarty->assign("uid", $uid);

			if (!$hash->isValid($config["mail"]["lostpw_limit"])) {
				echo "<p>Dieser Passwort-Vergessen-Link ist leider ung&uuml;ltig. Vermutlich ist er abgelaufen.</p>";
			} else if ($_POST["pass"] != $_POST["pass_repeat"]) {
				echo "<p>Die beiden Passw&ouml;rter stimmen nicht &uuml;berein.</b>";
				$smarty->display("lostpw.tpl");
			} else if (strlen($_POST["pass"]) < 6) {
				echo "<p>Das Passwort muss mindestens 6 Zeichen lang sein.";
				$smarty->display("lostpw.tpl");
			} else {
				$user = $userdb->getUser($uid);
				$user->changePassword($_POST["pass"]);
				$user->save();
				header("Location: index.php");
				return;
			}
		} else {
			if (!$hash->isValid($config["mail"]["lostpw_limit"])) {
				echo "<p>Dieser Passwort-Vergessen-Link ist leider ung&uuml;ltig. Vermutlich ist er abgelaufen.</p>";
			} else {
				$smarty->display("lostpw.tpl");
			}
		}
		$content = ob_get_contents();
		ob_end_clean();
		return $content;
	}

	public function sendMail() {
		global $smarty, $config, $userdb;
		ob_start();

		if (isset($_POST["user"])) {
			$user = stripslashes($_POST["user"]);
			$smarty->assign("user", $user);
			$user = $userdb->getUser($user);

			$mail = stripslashes($_POST["mail"]);
			$smarty->assign("mail", $mail);
			
			if (!in_array($mail, $user->getMails())) {
				echo "<p>Mailadresse geh&ouml;rt nicht zum Benutzer.</p>";
			} else {
				$hash =  new Hash($user->getUid());
				$lostpw_link = $config['site']['url'] . "/index.php?module=lostpw&v=" . $hash;
				$text = <<<lostpw_mail
Ahoi {$user->getUid()},

jemand hat die Passwort-Vergessen-Funktion des User-Control-Panels
der Jungen Piraten ( https://ucp.junge-piraten.de/ ) für deinen
Account benutzt. Um ein neues Passwort zu setzen, klicke auf
{$lostpw_link}

Falls du kein neues Passwort angefordert hast, ignoriere diese E-Mail
einfach :o)

Klarmachen zum Ändern
lostpw_mail;
				mail($mail, "[Junge Piraten] Passwort vergessen?", $text, "From: " . $config["mail"]["from"] . "\n" . "Content-Type: text/plain; Charset=UTF-8");
				echo "<p>Der Hilfelink wurde versandt.</p>";
			}
		} else {
			$smarty->display("lostpw-request.tpl");
		}
		$content = ob_get_contents();
		ob_end_clean();
		return $content;
	}

	public function main() {
		if (isset($_REQUEST["v"])) {
			return $this->changePassword();
		} else {
			return $this->sendMail();
		}
	}

}

?>
