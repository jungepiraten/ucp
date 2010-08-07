<?php

class logout
{
	public function main() {
		global $smarty, $module;
		$_SESSION["authenticated"] = false;
		session_destroy();
		header("refresh:0; url=index.php");
	}
}

?>
