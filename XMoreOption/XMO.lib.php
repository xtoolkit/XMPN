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
function xssetv($nuim){
global $prefix, $db, $dbname;
$nuim=intval($nuim);
$result = $db->sql_query("SELECT * FROM `" . $prefix . "_xsset` WHERE `xssid` =$nuim LIMIT 0 , 1");
	while ($row = $db->sql_fetchrow($result)) {
	mb_internal_encoding('UTF-8');
	$xssvalue = $row['xssvalue'];
}
return $xssvalue;
}
function xpsetv($nuim){
global $prefix, $db, $dbname;
$nuim=intval($nuim);
$result = $db->sql_query("SELECT * FROM `" . $prefix . "_xsset` WHERE `xssid` =$nuim LIMIT 0 , 1");
	while ($row = $db->sql_fetchrow($result)) {
	mb_internal_encoding('UTF-8');
	$xssvalue = $row['xssvalue'];
}
return $xssvalue;
}
function xp_fpics($id,$mod,$sort,$khorooj){
global $prefix, $db, $dbname;
if($sort=="DESC"){
$sort=="DESC";
}elseif($sort=="ASC"){
$sort=="ASC";
}else{
$sort=="DESC";
}
$numrow = $db->sql_numrows($db->sql_query("SELECT *
FROM `" . $prefix . "_xpshpt`
WHERE `xpmid` = $id
AND `xpmod` LIKE '$mod'
ORDER BY `" . $prefix . "_xpshpt`.`xpid` $sort
LIMIT 0 , 1"));
if($numrow>0){
$result = $db->sql_query("SELECT *
FROM `" . $prefix . "_xpshpt`
WHERE `xpmid` = $id
AND `xpmod` LIKE '$mod'
ORDER BY `" . $prefix . "_xpshpt`.`xpid` $sort
LIMIT 0 , 1");
	while ($row = $db->sql_fetchrow($result)) {
	mb_internal_encoding('UTF-8');
	$xpid = intval($row['xpid']);
	$xptag = $row['xptag'];
	$xptitle = $row['xptitle'];
	if($khorooj=="url"){
	return $xptag;
	}elseif($khorooj=="title"){
	return $xptitle;
	}else{
	return $xptag;
	}
}
}else{
return "Not_Found";
}
}
if(xlbsetv(1)==0){$xlbtheme=xlbsetv(3);if($xlbtheme=="default"){}else{include("modules/XMoreOption/theme/XlinksBox/$xlbtheme/xlbtheme.php");}}else{function xlb_theme($id,$mod){}}
if(xasetv(1)==0){$xatheme=xasetv(2);if($xatheme=="default"){}else{include("modules/XMoreOption/theme/Xaparat/$xatheme/xatheme.php");}}else{function xa_theme($id,$mod){}}
if(xssetv(1)==0){$xstheme=xssetv(2);if($xstheme=="default"){}else{include("modules/XMoreOption/theme/Xsound/$xstheme/xstheme.php");}}else{function xs_theme($id,$mod){}}
if(xpsetv(1)==0){$xptheme=xpsetv(2);if($xptheme=="default"){}else{include("modules/XMoreOption/theme/Xpshpt/$xstheme/xptheme.php");}}else{function xp_theme($id,$mod){}}
?>