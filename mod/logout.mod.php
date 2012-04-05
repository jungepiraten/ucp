<?php

class logout {
	private $options;
	
	public function __construct($options) {
		$this->options = $options;
	}

	public function main() {
		global $smarty, $user, $userdb;

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
