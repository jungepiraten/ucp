<?php
// User Control Panel

require_once(dirname(__FILE__) . "/config.inc.php");
require_once(dirname(__FILE__) . "/functions.inc.php");

require_once(dirname(__FILE__) . "/class/LDAPUser.class.php");
require_once(dirname(__FILE__) . "/class/LDAPUserManagement.class.php");

require_once("/usr/share/php/Smarty/Smarty.class.php");

session_start();

// Establish the LDAP connection and set some options
$ldapconn = ldap_connect($config["ldap"]["server"]);
ldap_set_option($ldapconn, LDAP_OPT_PROTOCOL_VERSION, 3);
ldap_set_option($ldapconn, LDAP_OPT_REFERRALS, 0);

// Create the smarty object (templating engine)
$smarty = new Smarty();
$smarty->template_dir = "data/templates";
$smarty->compile_dir = "data/templates_c";

// If the user is authenticated, the user object is serialized and saved inside a session variable.
// Therefore, it has to be unserialized at this point.
if ($_SESSION["authenticated"]) {
	$user = unserialize($_SESSION["user"]);
}

// If a module name has been specified by a GET variable, it is made the current module and saved inside a session variable.
// Otherwise, the module specified by the session variable is made the current module.
if (isset($_GET["module"])) {
	$module = $_GET["module"];
	$_SESSION["module"] = $module;
} else if (isset($_SESSION["module"])) {
	$module = $_SESSION["module"];
}

// Check whether the given module name is a valid existing module. In addition, check whether the module can be executed with the user's current state of authentication. (Some modules can only be executed by authenticated users, vice versa)
if (!is_array($config["modules"][$module]) || $config["modules"][$module]["force_authenticated"] && !$_SESSION["authenticated"] || $config["modules"][$module]["force_notauthenticated"] && $_SESSION["authenticated"]) {
	// If the specified module cannot be executed, execute the default module.
	if ($_SESSION["authenticated"]) {
		$module = "home";
	} else {
		$module = "login";
	}
}

// Include the module class and execute the main function.
include(dirname(__FILE__) . "/mod/" . $module . ".mod.php");
$_module = new $module;
$_content = $_module->main();

// Serialize the user object and save it to a session variable.
if ($_SESSION["authenticated"]) {
	$_SESSION["user"] = serialize($user);
}

// Generate the navigation
$_navigation = array();
foreach ($config["modules"] as $key => $value) {
	if (!($value["hide_navigation"]) && !($value["force_authenticated"] && !$_SESSION["authenticated"] || $value["force_notauthenticated"] && $_SESSION["authenticated"]) && !($value["force_verified"] && !$user->isVerified())) {
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

// Close the LDAP connection
ldap_close($ldapconn);

?>
