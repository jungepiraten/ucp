<?php

class verify
{
	public function main() {
		global $config, $user;
		ob_start();

		$uid = $_GET["u"];
		$mail = $_GET["m"];
		$hash = $_GET["h"];
		$timestamp = $_GET["t"];

		if (time() > $timestamp + $config["mail"]["verification_limit"]) {
			echo "Dieser Best&auml;tigungslink ist leider abgelaufen. Bitte lassen Sie sich die Best&auml;tigungsmail erneut senden.";
		} else if (LDAPUserManagement::isVerified(base64_decode($uid))) {
			echo "Dieser Account wurde bereits verifiziert.";
		} else if ($hash == md5($config["misc"]["secret"] . " " . $timestamp . " " . $uid . " " . $mail)) {
			if (LDAPUserManagement::verifyMailAddress(base64_decode($uid), base64_decode($mail))) {
				echo "Die E-Mail Adresse wurde erfolgreich verifiziert.";
				if ($_SESSION["authenticated"]) {
					$user->readFromLdap();
				}
			} else {
				echo "Die E-Mail Adresse konnte nicht verifiziert werden. M&ouml;glicherweise wurde diese nach Versenden der Best&auml;tigungsmail ge&auml;ndert. Bitte lassen Sie sich die Best&auml;tigungsmail erneut senden.";
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
