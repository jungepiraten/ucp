<?php

class login {
	public function main() {
		global $smarty, $config, $user, $userdb;
		ob_start();
		if (!isset($_POST["user"])) {
			$smarty->display("login.tpl");
		} else {
			if (($user = $userdb->authenticate($_POST["user"], $_POST["pass"])) instanceof User) {
				$_SESSION["authenticated"] = true;
				header("refresh:0; url=index.php");
			} else {
				echo "<p><b>Authentifizierung fehlgeschlagen!</b></p>";
				$smarty->display("login.tpl");
			}
		}
		$content = ob_get_contents();
		ob_end_clean();
		return $content;
	}

}

?>
