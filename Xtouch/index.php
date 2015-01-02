<?php
/************************************************************************/
/* PHP-NUKE: Advanced Content Management System                         */
/* ============================================                         */
/*                                                                      */
/* Copyright (c) 2006 by Francisco Burzi                                */
/* http://phpnuke.org                                                   */
/*                                                                      */
/* This program is free software. You can redistribute it and/or modify */
/* it under the terms of the GNU General Public License as published by */
/* the Free Software Foundation; either version 2 of the License.       */
/************************************************************************/

@require_once("mainfile.php");
global $prefix, $db, $admin_file, $gname;
$mobile_browser = '0';

///////////////////////////// Nuke mobile Version - Zero-F
if(@preg_match('/(up.browser|up.link|mmp|symbian|smartphone|midp|wap|phone)/i',
    strtolower($_SERVER['HTTP_USER_AGENT']))){
    $mobile_browser++;
    }

if((strpos(strtolower($_SERVER['HTTP_ACCEPT']),'application/vnd.wap.xhtml+xml')>0) or
    ((isset($_SERVER['HTTP_X_WAP_PROFILE']) or isset($_SERVER['HTTP_PROFILE'])))){
    $mobile_browser++;
    }

$mobile_ua = strtolower(substr($_SERVER['HTTP_USER_AGENT'],0,4));
$mobile_agents = array(
    'w3c ','acs-','alav','alca','amoi','audi','avan','benq','bird','blac',
    'blaz','brew','cell','cldc','cmd-','dang','doco','eric','hipt','inno',
    'ipaq','java','jigs','kddi','keji','leno','lg-c','lg-d','lg-g','lge-',
    'maui','maxo','midp','mits','mmef','mobi','mot-','moto','mwbp','nec-',
    'newt','noki','oper','palm','pana','pant','phil','play','port','prox',
    'qwap','sage','sams','sany','sch-','sec-','send','seri','sgh-','shar',
    'sie-','siem','smal','smar','sony','sph-','symb','t-mo','teli','tim-',
    'tosh','tsm-','upg1','upsi','vk-v','voda','wap-','wapa','wapi','wapp',
    'wapr','webc','winw','winw','xda','xda-');

if(in_array($mobile_ua,$mobile_agents)){
    $mobile_browser++;
    }
if (strpos(strtolower($_SERVER['ALL_HTTP']),'OperaMini')>0) {
    $mobile_browser++;
    }
if (strpos(strtolower($_SERVER['HTTP_USER_AGENT']),'windows')>0) {
    $mobile_browser=0;
    }


if($mobile_browser>0){
   header('Location: avantgo.html');
   }
///////////////////////////// Nuke mobile Version - Zero-F

if (isset($op) AND ($op == "ad_click") AND isset($bid)) {
	$bid = intval($bid);
	$sql = "SELECT clickurl FROM ".$prefix."_banner WHERE bid='$bid'";
	$result = $db->sql_query($sql);
	list($clickurl) = $db->sql_fetchrow($result);
	$clickurl = filter($clickurl, "nohtml");
	$db->sql_query("UPDATE ".$prefix."_banner SET clicks=clicks+1 WHERE bid='$bid'");
	update_points(21,'');
	Header("Location: ".addslashes($clickurl));
	die();
}

if($gname == ""){
	if (file_exists('install/index.php')){
		header("location:install/index.php");
		exit;
	}
}

$modpath = '';
define('MODULE_FILE', true);
$_SERVER['PHP_SELF'] = "modules.php";
define('HOME_FILE', true);

if (isset($url) AND isset($_GET['url']) AND is_admin($admin)) {
	$url = urldecode($url);
	echo "<meta http-equiv=\"refresh\" content=\"0; url=$url\">";
	die();
}

if ($httpref == 1) {
    if (isset($_SERVER['HTTP_REFERER'])) {
    $referer = $_SERVER['HTTP_REFERER'];
    $referer = check_html($referer, "nohtml");
    if (@eregi("nuke_", $referer) && @eregi("into", $referer) && @eregi("from", $referer)) {
    	$referer = "";
    }
    }
    if (!empty($referer) && !stripos_clone($referer, "unknown") && !stripos_clone($referer, "bookmark") && !stripos_clone($referer, $_SERVER['HTTP_HOST'])) {
    $result = $db->sql_query("INSERT INTO ".$prefix."_referer VALUES (NULL, '".addslashes($referer)."')");
    }
    $numrows = $db->sql_numrows($db->sql_query("SELECT * FROM ".$prefix."_referer"));
    if($numrows>=$httprefmax) {
        $result2 = $db->sql_query("DELETE FROM ".$prefix."_referer");
    }
}
if (!isset($mop)) { $mop="modload"; }
if (!isset($mod_file)) { $mod_file="index"; }
$gname = trim($gname);
if (isset($file)) { $file = trim($file); }
$mod_file = trim($mod_file);
$mop = trim($mop);
if (stripos_clone($gname,"..") || (isset($file) && stripos_clone($file,"..")) || stripos_clone($mod_file,"..") || stripos_clone($mop,"..")) {
	die("You are so cool...");
} else {
	$ThemeSel = get_theme();
	if (file_exists("themes/$ThemeSel/module.php")) {
		@include("themes/$ThemeSel/module.php");
		if (is_active("$default_module") AND file_exists("modules/$default_module/".$mod_file.".php")) {
			$gname = $default_module;
		}
	}
	if (file_exists("themes/$ThemeSel/modules/$gname/".$mod_file.".php")) {
		$modpath = "themes/$ThemeSel/";
	}
	$modpath .= "modules/$gname/".$mod_file.".php";

	if (file_exists($modpath)) {
		@include($modpath);
	} else {
		define('INDEX_FILE', true);
		@include("header.php");
		OpenTable();
		if (is_admin($admin)) {
			echo "<center><font class=\"\"><b>"._HOMEPROBLEM."</b></font><br><br>[ <a href=\"".$admin_file.".php?op=modules\">"._ADDAHOME."</a> ]</center>";
		} else {
			echo "<center>"._HOMEPROBLEMUSER."</center>";
		}
		CloseTable();
		@include("footer.php");
	}
}
?>