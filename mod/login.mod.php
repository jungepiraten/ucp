<?php

class login {
	private $options;
	
	public function __construct($options) {
		$this->options = $options;
	}

	public function main() {
		global $smarty, $user, $userdb;

		if (!isset($_POST["user"])) {
			return $smarty->fetch("login.tpl");
		} else {
			if (($user = $userdb->authenticate($_POST["user"], $_POST["pass"])) instanceof User) {
				$_SESSION["authenticated"] = true;
				$_SESSION["user_override"] = null;
				header("refresh:0; url=index.php");
			} else {
				$smarty->assign("loginfailed", 1);
				return $smarty->fetch("login.tpl");
			}
		}
	}

}

?>
