<?php
if (stristr(htmlentities($_SERVER['PHP_SELF']), "Xlb.lib.php")) {
	die ("You can't access this file directly...");
}
require_once("mainfile.php");
global $nukeurl, $prefix, $db;
function xlbsetv($nuim){
global $prefix, $db, $dbname;
$nuim=intval($nuim);
$result = $db->sql_query("SELECT * FROM `" . $prefix . "_xlbset` WHERE `xlb` =$nuim LIMIT 0 , 1");
	while ($row = $db->sql_fetchrow($result)) {
	mb_internal_encoding('UTF-8');
	$xlbname = $row['xlbvalue'];
}
return $xlbname;
}
function xasetv($nuim){
global $prefix, $db, $dbname;
$nuim=intval($nuim);
$result = $db->sql_query("SELECT * FROM `" . $prefix . "_xaset` WHERE `xasid` =$nuim LIMIT 0 , 1");
	while ($row = $db->sql_fetchrow($result)) {
	mb_internal_encoding('UTF-8');
	$xasvalue = $row['xasvalue'];
}
return $xasvalue;
}
if(xlbsetv(1)==0){$xlbtheme=xlbsetv(3);if($xlbtheme=="default"){}else{include("modules/XMoreOption/theme/XlinksBox/$xlbtheme/xlbtheme.php");}}else{function xlb_theme($id,$mod){}}
if(xasetv(1)==0){$xatheme=xasetv(2);if($xlbtheme=="default"){}else{include("modules/XMoreOption/theme/Xaparat/$xatheme/xatheme.php");}}else{function xa_theme($id,$mod){}}
?>