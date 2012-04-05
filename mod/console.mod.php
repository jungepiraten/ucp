<?php

class console {
	private $options;
	
	public function __construct($options) {
		$this->options = $options;
	}

	public function overview() {
		global $smarty, $userdb;
		
		ob_start();
		
		$filter = null;
		if (!empty($_REQUEST["filter"])) {
			$filter = "*" . stripslashes($_REQUEST["filter"]) . "*";
		}
		$users = $userdb->getUsers($filter);
		$smarty->assign("users", $users);

		$smarty->display("userlist.tpl");

		$output = ob_get_contents();
		ob_end_clean();

		return $output;
	}

	public function delete() {
		global $userdb;
		
		ob_start();
		
		if (!isset($_REQUEST["users"])) {
			return $this->overview();
		}
		
		foreach ($_REQUEST["users"] as $user) {
			if ($userdb->removeUser($user)) {
				echo "<p>Benutzer <strong>" . htmlentities($user) . "</strong> gel&ouml;scht!</p>";
			} else {
				echo "<p><strong>FEHLER!</strong></p>";
			}
		}

		$output = ob_get_contents();
		ob_end_clean();

		return $output;
	}

	public function override() {
		global $userdb, $user;
		
		$username = stripslashes($_REQUEST["user"]);
		$newuser = $userdb->getUser($username);
		if (!($newuser instanceof User)) {
			return "<p><b>Benutzer nicht gefunden.</b></p>";
		} else if (isset($_SESSION["user_override"])) {
			return "<p><b>Bereits im Override-Modus.</b></p>";
		} else {
			$_SESSION["user_override"] = $user->getUid();
			$user = $newuser;
			return "<p><b>Als Benutzer &quot;" . htmlentities($username) . "&quot; angemeldet. Take a lot of care!</b></p>";
		}
	}

	public function main() {
		$do = isset($_REQUEST["do"]) ? stripslashes($_REQUEST["do"]) : "";
		switch ($do) {
			case "delete":
				return $this->delete();
			case "override":
				return $this->override();
			default:
				return $this->overview();
		}
	}
}

?>
