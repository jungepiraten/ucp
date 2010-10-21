<?php
require_once(dirname(__FILE__) . "/../lib/recaptchalib.php");

class register
{
	private function displayForm() {
		global $config, $smarty;

		// Get reCaptcha code
		$captcha = recaptcha_get_html($config["modules"]["register"]["recaptcha_publickey"], null, $_SERVER["HTTPS"] == "on");
		
		$smarty->assign("captcha", $captcha);
		$smarty->display("register.tpl");
	}

	private function performRegistration() {
		global $config, $userdb, $user;

		// Check recaptcha answer
		$resp = recaptcha_check_answer($config["modules"]["register"]["recaptcha_privatekey"], $_SERVER["REMOTE_ADDR"], $_POST["recaptcha_challenge_field"], $_POST["recaptcha_response_field"]);
		
		if (empty($_POST["user"])) {
			echo "<p>Es wurde kein Nutzername angegeben.</p>";
		} else if (strlen($_POST["user"]) < 3) {
			echo "<p>Der Nutzername muss aus mindestens 3 Zeichen bestehen.</p>";
		} else if (!preg_match("/^[a-zA-Z0-9._]+$/", $_POST["user"])) {
			echo "<p>Der Nutzername darf nur Buchstaben (A-Z), Zahlen (0-9), Unterstriche und Punkte enthalten.</p>";
		} else if ($userdb->userExists($_POST["user"])) {
			echo "<p>Der angegebene Nutzername ist leider schon vergeben.</p>";
		} else if (empty($_POST["mail"])) {
			echo "<p>Es wurde keine E-Mail Adresse angegeben.</p>";
		} else if (!$userdb->isValidMailAddress($_POST["mail"])) {
			echo "<p>Die angegebene E-Mail Adresse ist ung&uuml;ltig.</p>";
		} else if ($config["misc"]["singletonmail"] && $userdb->mailUsed($_POST["mail"])) {
			echo "<p>Die angegebene E-Mail Adresse wird bereits bei einem anderen Account verwendet.</p>";
		} else if (empty($_POST["pass"])) {
			echo "<p>Es wurde kein Passwort angegeben.</p>";
		} else if ($_POST["pass"] != $_POST["pass_repeat"]) {
			echo "<p>Die beiden Passw&ouml;rter stimmen nicht &uuml;berein.</p>";
		} else if (strlen($_POST["pass"]) < 6) {
			echo "<p>Das Passwort muss mindestens 6 Zeichen lang sein.</p>";
		} else if (empty($_POST["recaptcha_challenge_field"]) || empty($_POST["recaptcha_response_field"])) {
			echo "<p>Der Captcha muss gel&ouml;st werden!</p>";
		} else if (!$resp->is_valid) {
			echo "<p>Falsche Captcha-L&ouml;sung.</p>";
		} else {
			if ($user = $userdb->registerUser($_POST["user"], $_POST["pass"], $_POST["mail"])) {
				header("Location: index.php?module=profile&do=verify_mail&mail=" . urlencode($_POST["mail"]));
				return;
			} else {
				echo "<p>Fehler beim Registrieren!</p>";
			}
		}
	}

	public function main() {
		ob_start();
		if (!isset($_POST["register"])) {
			$this->displayForm();
		} else {
			$this->performRegistration();
		}
		$output = ob_get_contents();
		ob_end_clean();
		return $output;
	}
}

?>
