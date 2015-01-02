<?php
if (!defined('MODULE_FILE')) {
	die ("You can't access this file directly...");
}
require_once("mainfile.php");
$module_name = basename(dirname(__FILE__));
global $nukeurl, $dbname, $prefix, $db, $xccset, $xcmonth, $xcyear, $xcday;
	Header("Location: ".LinkToGT("index.php")."");
?>