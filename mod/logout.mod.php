<?php

class logout
{
	public function main() {
		global $smarty, $module, $user, $userdb;

		if (isset($_SESSION["user_override"])) {
			$user = $userdb->getUser($_SESSION["user_override"]);
			unset($_SESSION["user_override"]);
			header("refresh:0; url=index.php?module=home");
		} else {
			$_SESSION["authenticated"] = false;
			session_destroy();
			header("refresh:0; url=index.php?module=login");
		}
	}
}

?>
