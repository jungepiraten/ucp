<?php

class lostpw {
	public function main() {
		global $smarty, $config, $userdb, $user;
		ob_start();

		if (isset($_REQUEST["pass"])) {
			$uid = stripslashes($_REQUEST["u"]);
			$hash = stripslashes($_REQUEST["h"]);
			$timestamp = stripslashes($_REQUEST["t"]);
			$smarty->assign("uid", $uid);
			$smarty->assign("hash", $hash);
			$smarty->assign("timestamp", $timestamp);

			if ($timestamp + $config["mail"]["lostpw_limit"] < time()) {
				echo "<p>Dieser Passwort-Vergessen-Link ist leider abgelaufen. Bitte lass dir die Best&auml;tigungsmail erneut senden.</p>";
			} else if (md5($config["misc"]["secret"] . " " . $timestamp . " " . $uid) != $hash) {
				echo "<p>Dieser Hash ist ung&uuml;ltig</p>";
			} else if ($_POST["pass"] != $_POST["pass_repeat"]) {
				echo "<p>Die beiden Passw&ouml;rter stimmen nicht &uuml;berein.</b>";
				$smarty->display("lostpw.tpl");
			} else if (strlen($_POST["pass"]) < 6) {
				echo "<p>Das Passwort muss mindestens 6 Zeichen lang sein.";
				$smarty->display("lostpw.tpl");
			} else {
				$user = $userdb->getUser(base64_decode($uid));
				$user->changePassword($_POST["pass"]);
				$user->save();
				$_SESSION["authenticated"] = true;
				header("refresh:0; url=index.php");
			}
		} else if (isset($_REQUEST["u"])) {
			$uid = stripslashes($_REQUEST["u"]);
			$hash = stripslashes($_REQUEST["h"]);
			$timestamp = stripslashes($_REQUEST["t"]);

			if ($timestamp + $config["mail"]["lostpw_limit"] < time()) {
				echo "<p>Dieser Passwort-Vergessen-Link ist leider abgelaufen. Bitte lass dir die Best&auml;tigungsmail erneut senden.</p>";
			} else if (md5($config["misc"]["secret"] . " " . $timestamp . " " . $uid) != $hash) {
				echo "<p>Dieser Hash ist ung&uuml;ltig</p>";
			} else {
				$smarty->assign("uid", $uid);
				$smarty->assign("hash", $hash);
				$smarty->assign("timestamp", $timestamp);
				$smarty->display("lostpw.tpl");
			}
		} else if (!isset($_POST["user"])) {
			$smarty->display("lostpw-request.tpl");
		} else {
			$user = stripslashes($_POST["user"]);
			$smarty->assign("user", $user);
			$user = $userdb->getUser($user);

			$mail = stripslashes($_POST["mail"]);
			$smarty->assign("mail", $mail);
			
			if (!in_array($mail, $user->getMails())) {
				echo "<p>Mailadresse geh&ouml;rt nicht zum Benutzer.</p>";
			} else {
				$formatted_uid = base64_encode($user->getUid());
				$timestamp = time();
				$hash = md5($config["misc"]["secret"] . " " . $timestamp . " " . $formatted_uid);
				$lostpw_link = $config['site']['url'] . "/index.php?module=lostpw&u=" . $formatted_uid . "&h=" . $hash . "&t=" . $timestamp;
				$text = <<<lostpw_mail
Ahoi {$user->getUid()},

jemand hat die Passwort-Vergessen-Funktion des User-Control-Panels
der Jungen Piraten ( https://ucp.junge-piraten.de/ ) für deinen
Account benutzt. Um ein neues Passwort zu setzen, klicke auf
{$lostpw_link}

Falls du kein neues Passwort angefordert hast, ignoriere dies E-Mail
einfach :o)

Klarmachen zum Ändern
lostpw_mail;
				mail($mail, "[Junge Piraten] Passwort vergessen?", $text, "From: " . $config["mail"]["from"] . "\n" . "Content-Type: text/plain; Charset=UTF-8");
				echo "<p>Der Hilfelink wurde versandt.</p>";
			}
		}
		$content = ob_get_contents();
		ob_end_clean();
		return $content;
	}

}

?>
