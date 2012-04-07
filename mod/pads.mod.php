<?php

require_once(dirname(__FILE__) . "/../lib/etherpad-lite-client.php");

class pads {
	private $options;
	private $eplite;
	
	public function __construct($options) {
		$this->options = $options;
		$this->eplite = new EtherpadLiteClient($this->options["eplite_apikey"], $this->options["eplite_apiurl"]);
	}

	private function overview() {
		global $user, $smarty;

		$pads = array();
		foreach ($this->eplite->listPads($this->options["eplite_groupid"])->padIDs as $padID) {
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
		try {
			$padID = $this->eplite->createGroupPad($this->options["eplite_groupid"], stripslashes($_REQUEST["pad"]), "")->padID;
			list($groupID, $padName) = explode('$', $padID, 2);
			$this->showPad($padName);
		} catch (InvalidArgumentException $e) {
			return "<p>" . htmlentities($e->getMessage()) . "</p>";
		}
	}

	private function setPublic() {
		global $user;

		if (!$user->isAdmin()) {
			return;
		}

		$this->eplite->setPublicStatus($this->options["eplite_groupid"] . '$' . $_REQUEST["pad"], $_REQUEST["public"] == "1" ? "true" : "false");
	}

	private function setPassword() {
		global $user;

		if (!$user->isAdmin()) {
			return;
		}

		$this->eplite->setPassword($this->options["eplite_groupid"] . '$' . $_REQUEST["pad"], $_REQUEST["password"]);
	}

	private function showPad($pad = null) {
		global $user, $smarty;

		if ($pad == null) {
			$pad = $_REQUEST["pad"];
		}

		if ($user != null) {
			$authorID = $this->eplite->createAuthorIfNotExistsFor($user->getUid(), $user->getUid())->authorID;
		} else {
			$authorID = $this->eplite->createAuthor("Anonymous")->authorID;
		}
		$sessionID = $this->eplite->createSession($this->options["eplite_groupid"], $authorID, time() + 24*60*60)->sessionID;

		setcookie("sessionID", $sessionID, 0, dirname(parse_url($this->options["eplite_padurl"], PHP_URL_PATH)), parse_url($this->options["eplite_padurl"], PHP_URL_HOST));

		return '<html><body style="margin:0px;padding:0px"><iframe src="' . $this->options["eplite_padurl"] . urlencode($pad) . '" style="width:100%; height:100%; border:0px; margin:0px;"></iframe></body></html>';
	}

	private function deletePad($pad = null) {
		global $user;

		if ($pad == null) {
			$pad = $_REQUEST["pad"];
		}

		if (!$user->isAdmin()) {
			return;
		}

		$this->eplite->deletePad($this->options["eplite_groupid"] . '$' . $pad);
	}

	public function main() {
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
			case "deletePad":
				$this->deletePad();
				return $this->overview();
			default:
			case "overview":
				return $this->overview();
		}
	}

}

?>
