<?php

class console
{
	public function overview() {
		global $smarty, $userdb;
		
		ob_start();

		$users = $userdb->getUsers();
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

	public function main() {
		switch ($_REQUEST["do"]) {
			case "delete":
				return $this->delete();
			default:
				return $this->overview();
		}
	}
}

?>
