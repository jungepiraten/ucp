<?php
// User Control Panel

require_once(dirname(__FILE__) . "/config.inc.php");
require_once(dirname(__FILE__) . "/functions.inc.php");

require_once(dirname(__FILE__) . "/class/UserDatabase.class.php");
require_once(dirname(__FILE__) . "/class/Mailman.class.php");

require_once("/usr/share/php/Smarty/Smarty.class.php");

session_start();

// Establish the LDAP connection and set some options
$userdb = new UserDatabase(
		$config["ldap"]["server"], $config["ldap"]["rdn"], $config["ldap"]["pass"], $config["ldap"]["base_dn"],
		$config["mysql"]["server"], $config["mysql"]["user"], $config["mysql"]["pass"], $config["mysql"]["db"] );
$userdb->open();

// Create the smarty object (templating engine)
$smarty = new Smarty();
$smarty->template_dir = "data/templates";
$smarty->compile_dir = "data/templates_c";

// If we are authenticated, load User-informations from UserDB
if ($_SESSION["authenticated"]) {
	$user = $userdb->getUser($_SESSION["user"]);
}

// If a module name has been specified by a GET variable, it is made the current module and saved inside a session variable.
// Otherwise, the module specified by the session variable is made the current module.
if (isset($_GET["module"])) {
	$module = $_GET["module"];
	$_SESSION["module"] = $module;
} else if (isset($_SESSION["module"])) {
	$module = $_SESSION["module"];
}

function maySeeModule($module, $authenticated) {
	global $config;
	if (!is_array($config["modules"][$module])) {
		return false;
	}
	if ($config["modules"][$module]["force_authenticated"] === true && !$authenticated) {
		return false;
	}
	if ($config["modules"][$module]["force_notauthenticated"] === true && $authenticated) {
		return false;
	}
	return true;
}

// Check whether the given module name is a valid existing module. In addition, check whether the module can be executed with the user's current state of authentication. (Some modules can only be executed by authenticated users, vice versa)
if (!maySeeModule($module, $user instanceof User)) {
	// If the specified module cannot be executed, execute the default module.
	if ($user instanceof User) {
		$module = "home";
	} else {
		$module = "login";
	}
}

// Include the module class and execute the main function.
include(dirname(__FILE__) . "/mod/" . $module . ".mod.php");
$_module = new $module;
$_content = $_module->main();

// Do not serialize the user, since the User-Object stores a DB-Link,
// which gets broken during serialization
if ($user instanceof User) {
	$_SESSION["authenticated"] = true;
	$_SESSION["user"] = $user->getUid();
}

// Generate the navigation
$_navigation = array();
foreach ($config["modules"] as $key => $value) {
	if (!($value["hide_navigation"]) && maySeeModule($key, $user instanceof User)) {
		$_navigation[$key] = $value["title"];
	}
}

// Assign the template variables
$smarty->assign("module", $module);
$smarty->assign("navigation", $_navigation);
$smarty->assign("title", $config["site"]["title"] . ": " . $config["modules"][$module]["title"]);
$smarty->assign("content", $_content);

// Display the page
$smarty->display("main.tpl");

// Close the UserDB connection
$userdb->close();

?>
