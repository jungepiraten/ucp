<?php

class verify {
	private $options;

	public function __construct($options) {
		$this->options = $options;
	}

	public function main() {
		global $userdb;
		ob_start();

		$h = Hash::getByHash(stripslashes($_GET["v"]));
		list($uid, $mail) = explode("\0", $h->getData());

		if (!$h->isValid($this->options["mail_limit"], $hash)) {
			echo "<p>Dieser Best&auml;tigungslink ist leider ung&uuml;ltig. Vielleicht ist er abgelaufen?</p>";
		} else if ($userdb->isVerified($uid, $mail)) {
			echo "<p>Dieser Account wurde bereits verifiziert.</p>";
		} else {
			$user = $userdb->getUser($uid);
			if ($user->verifyMailAddress($mail)) {
				echo "<p>Die E-Mail Adresse wurde erfolgreich verifiziert.</p>";
			} else {
				echo "<p>Die E-Mail Adresse konnte nicht verifiziert werden. M&ouml;glicherweise wurde diese nach Versenden der Best&auml;tigungsmail ge&auml;ndert. Bitte lassen Sie sich die Best&auml;tigungsmail erneut senden.</p>";
			}
		}

		$content = ob_get_contents();
		ob_end_clean();
		return $content;
	}
}

?>
