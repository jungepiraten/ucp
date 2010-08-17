<?php

class register
{
	private function displayForm($errors = null) {
		global $smarty;
		if ($errors !== null) {
			$smarty->assign("errors", $errors);
		}
		$smarty->display("register.tpl");
	}

	private function performRegistration() {
		global $userdb;
		$errors = array();
		if (empty($_POST["user"])) {
			$errors[] = "Es wurde kein Nutzername angegeben.";
		} else {
			if (strlen($_POST["user"]) < 3) {
				$errors[] = "Der Nutzername muss aus mindestens 3 Zeichen bestehen.";
			}
			if (!preg_match("/^[a-zA-Z0-9._]+$/", $_POST["user"])) {
				$errors[] = "Der Nutzername darf nur Buchstaben (A-Z), Zahlen (0-9), Unterstriche und Punkte enthalten.";
			}
			if (count($errors) < 1) {
				if ($userdb->userExists($_POST["user"])) {
					$errors[] = "Der angegebene Nutzername ist leider schon vergeben.";
				}
			}
		}
		if (empty($_POST["mail"])) {
			$errors[] = "Es wurde keine E-Mail Adresse angegeben.";
		} else {
			if (!$userdb->isValidMailAddress($_POST["mail"])) {
				$errors[] = "Die angegebene E-Mail Adresse ist ung&uuml;ltig.";
			} else {
				if ($userdb->mailUsed($_POST["mail"])) {
					$errors[] = "Die angegebene E-Mail Adresse wird bereits bei einem anderen Account verwendet.";
				}
			}
		}
		if (empty($_POST["pass"])) {
			$errors[] = "Es wurde kein Passwort angegeben.";
		} else if ($_POST["pass"] != $_POST["pass_repeat"]) {
			$errors[] = "Die beiden Passw&ouml;rter stimmen nicht &uuml;berein.";
		} else if (strlen($_POST["pass"]) < 6) {
			$errors[] = "Das Passwort muss mindestens 6 Zeichen lang sein.";
		}

		if (count($errors) > 0) {
			$this->displayForm($errors);
		} else {
			if ($userdb->registerUser($_POST["user"], $_POST["pass"], $_POST["mail"])) {
				echo "Der Account wurde erstellt. Sie k&ouml;nnen sich nun einloggen.";
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
