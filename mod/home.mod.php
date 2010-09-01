<?php

class home
{
	public function main() {
		global $user;

		ob_start();

		echo "<p class=\"greeting\">Willkommen, " . $user->getUid() . "!</p>";

		if (!$user->hasMail()) {
			echo "<p class=\"note\">Deinem Account sind noch keine Mailadressen zugeordnet. Um die Funktionen dieses Panels voll nutzen zu k&ouml;nnen, solltest du <a href=\"?module=profile&amp;do=add_mail\">eine Mailadresse eintragen</a>.</p>";
		} else if (!$user->isVerified()) {
			echo "<p class=\"note\">Deine Mailadresse wurde bisher noch nicht verifiziert. Ohne Verifizierung stehen einige Funktionen (wie das vereinfachte Abonnieren von Mailinglisten) nicht zur Verf&uuml;gung. <a href=\"?module=profile&amp;do=verify_mail&amp;mail=" . array_shift($user->getMails()) . "\">Jetzt verifizieren</a>.</p>";
		} else {
			echo "<p class=\"note\">Dein Account ist verifiziert - Es kann los gehen :).</p>";
		}

		$output = ob_get_contents();
		ob_end_clean();

		return $output;
	}
}

?>
