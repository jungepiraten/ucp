<?php

class verify
{
	public function main() {
		global $config, $userdb;
		ob_start();

		$uid = $_GET["u"];
		$mail = $_GET["m"];
		$hash = $_GET["h"];
		$timestamp = $_GET["t"];

		if (time() > $timestamp + $config["mail"]["verification_limit"]) {
			echo "<p>Dieser Best&auml;tigungslink ist leider abgelaufen. Bitte lassen Sie sich die Best&auml;tigungsmail erneut senden.</p>";
		} else if ($userdb->isVerified(base64_decode($uid), base64_decode($mail))) {
			echo "<p>Dieser Account wurde bereits verifiziert.</p>";
		} else if ($hash == md5($config["misc"]["secret"] . " " . $timestamp . " " . $uid . " " . $mail)) {
			$user = $userdb->getUser(base64_decode($uid));
			if ($user->verifyMailAddress(base64_decode($mail))) {
				$mailman = new Mailman($user);
				foreach ($user->popListVerifyQueue(base64_decode($mail)) as $list) {
					$list = $mailman->getList($list);
					$list->addMember(base64_decode($mail));
				}
				echo "<p>Die E-Mail Adresse wurde erfolgreich verifiziert.</p>";
			} else {
				echo "<p>Die E-Mail Adresse konnte nicht verifiziert werden. M&ouml;glicherweise wurde diese nach Versenden der Best&auml;tigungsmail ge&auml;ndert. Bitte lassen Sie sich die Best&auml;tigungsmail erneut senden.</p>";
			}
		} else {
			echo "Dieser Best&auml;tigungslink ist ung&uuml;ltig. &Uuml;berpr&uuml;fen Sie, ob Sie den Link korrekt aus der E-Mail &uuml;bertragen haben und lassen Sie sich ggf. die Best&auml;tigungsmail erneut senden.";
		}

		$content = ob_get_contents();
		ob_end_clean();
		return $content;
	}
}

?>
