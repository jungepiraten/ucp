<?php

require_once(dirname(__FILE__) . "/../lib/etherpad-lite-client.php");

class pads {
	private $eplite;

	public function __construct() {
		global $config;

		$this->eplite = new EtherpadLiteClient($config["modules"]["pads"]["eplite_apikey"], $config["modules"]["pads"]["eplite_url"] . "api");
	}

	private function overview() {
		global $config, $user, $smarty;

		$pads = array();
		foreach ($this->eplite->listPads($config["modules"]["pads"]["eplite_groupid"])->padIDs as $padID) {
			list($groupID, $padName) = explode('$', $padID, 2);
			$pad = array();
			$pad["pad"] = $padName;
			$pad["isProtected"] = $this->eplite->isPasswordProtected($padID)->isPasswordProtected;
			$pad["isPublic"] = $this->eplite->getPublicStatus($padID)->publicStatus;
			$pads[] = $pad;
		}
		$smarty->assign("pads", $pads);
		$smarty->assign("showPadOptions", ($user != null && $user->isAdmin()) );

		return $smarty->fetch("pads.tpl");
	}

	private function createPad() {
		global $config;

		try {
			$padID = $this->eplite->createGroupPad($config["modules"]["pads"]["eplite_groupid"], stripslashes($_REQUEST["pad"]), "")->padID;
			list($groupID, $padName) = explode('$', $padID, 2);
			$this->showPad($padName);
		} catch (InvalidArgumentException $e) {
			return "<p>" . htmlentities($e->getMessage()) . "</p>";
		}
	}

	private function setPublic() {
		global $config, $user;

		if (!$user->isAdmin()) {
			return;
		}

		$this->eplite->setPublicStatus($config["modules"]["pads"]["eplite_groupid"] . '$' . $_REQUEST["pad"], $_REQUEST["public"]);
	}

	private function setPassword() {
		global $config, $user;

		if (!$user->isAdmin()) {
			return;
		}

		$this->eplite->setPassword($config["modules"]["pads"]["eplite_groupid"] . '$' . $_REQUEST["pad"], $_REQUEST["password"]);
	}

	private function showPad($pad = null) {
		global $config, $user, $smarty;

		if ($pad == null) {
			$pad = $_REQUEST["pad"];
		}

		if ($user != null) {
			$userid = $user->getUid();
			$username = $nick = $userid;
		} else {
			$userid = "Besucher " . rand(1000,9999);
			$username = $nick = $userid;
			if (isset($_REQUEST["nick"])) {
				$nick = strip_tags(stripslashes($_REQUEST["nick"]));
				$username = $nick . " (Gast)";
			}
		}
		$authorID = $this->eplite->createAuthorIfNotExistsFor($userid, $username)->authorID;
		$sessionID = $this->eplite->createSession($config["modules"]["pads"]["eplite_groupid"], $authorID, time() + 60)->sessionID;

		setcookie("sessionID", $sessionID, 0, parse_url($config["modules"]["pads"]["eplite_url"], PHP_URL_PATH), parse_url($config["modules"]["pads"]["eplite_url"], PHP_URL_HOST));

		$smarty->assign("showNickBox", ($user == null));
		$smarty->assign("nick", $nick);
		$smarty->assign("pad", $pad);
		$smarty->assign("padlink", $config["modules"]["pads"]["eplite_url"] . "p/" . $config["modules"]["pads"]["eplite_groupid"] . '$' . urlencode($pad));
		return $smarty->fetch("viewpad.tpl");
	}

	public function main() {
		global $config, $user;

		$do = isset($_REQUEST["do"]) ? stripslashes($_REQUEST["do"]) : "";
		switch ($do) {
			case "createPad":
				return $this->createPad();
			case "setPublic":
				$this->setPublic();
				return $this->overview();
			case "setPassword":
				$this->setPassword();
				return $this->overview();
			case "showPad":
				return $this->showPad();
			default:
			case "overview":
				return $this->overview();
		}
	}

}

?>
