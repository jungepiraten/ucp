<?php

class home
{
	public function main() {
		global $config, $user;

		ob_start();

		echo "<p><b>Willkommen, " . $user->getUid() . "!</b></p>";

		if ($user->isVerified()) {
			echo "Ihr Account ist verifiziert.";
		} else {
			echo "Ihr Account wurde bisher noch nicht verifiziert. Ohne Verifizierung stehen Ihnen einige Funktionen (wie das vereinfachte Abonnieren von Mailinglisten) nicht zur Verf&uuml;gung. <a href=\"?module=profile&do=verify\">Jetzt verifizieren</a>";
		}

		$output = ob_get_contents();
		ob_end_clean();

		return $output;
	}
}

?>
