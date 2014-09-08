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

if (stristr(htmlentities($_SERVER['PHP_SELF']), "header.php")) {
	Header("Location: index.php");
	die();
}
$preloader = 1; //Preloader
define('NUKE_HEADER', true);
@require_once("mainfile.php");
global $db ,$prefix ,$gtset ,$admin ,$adminmail;
if ($gtset == "1") {
nextGenTap(1,0,0);
}
if(!$row = $db->sql_fetchrow($db->sql_query("SELECT * from ".$prefix."_nukesql"))){
         die(header("location: upgrade.php"));
}
##################################################
# Include some common header for HTML generation #
##################################################
global $pagetitle;
if(defined("ADMIN_FILE")){
	adminheader($pagetitle);
}else{
global $name, $nukeurl, $xdemailset;

//// in this code we save current page that user is in it.
if($name != "Your_Account"){
	$currentpagelink = $_SERVER['REQUEST_URI'];
	$arr_nukeurl = explode("/",$nukeurl);
	$arr_nukeurl = array_filter($arr_nukeurl);
	foreach($arr_nukeurl as $key => $values){
		if($key > 2){
			unset($arr_nukeurl[$key]);
		}
	}
	$arr_nukeurl = array_filter($arr_nukeurl);
	$new_nukeurl = $arr_nukeurl[0]."//".$arr_nukeurl[2];

	$currentpage = $new_nukeurl.$currentpagelink;
	nuke_set_cookie("currentpage",$currentpage,time()+1800);
}
if(!function_exists('head')){
	function head() {
		global $slogan, $name, $sitename, $banners, $nukeurl, $Version_Num, $ab_config, $artpage, $topic, $hlpfile, $user, $hr, $theme, $cookie, $bgcolor1, $bgcolor2, $bgcolor3, $bgcolor4, $textcolor1, $textcolor2, $forumpage, $adminpage, $userpage, $pagetitle, $pagetags, $align, $preloader, $anonymous;
		$ThemeSel = get_theme();
		theme_lang();
		echo "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">\n";
		echo "<html xmlns=\"http://www.w3.org/1999/xhtml\">\n";
		echo "<head>\n";
		echo"<title>$sitename $pagetitle</title>";
		@include("includes/meta.php");
		@include("includes/javascript.php");
		if (file_exists("themes/$ThemeSel/images/favicon.ico")) {
			echo "<link rel=\"shortcut icon\" href=\"themes/$ThemeSel/images/favicon.ico\" type=\"image/x-icon\" />\n";
		}
		echo "</head>\n";
if($preloader == 1){

		echo "<div id=\"waitDiv\" onclick=\"this.style.visibility='hidden'\" style=\" direction:rtl; text-align:center; line-height:17px; position:fixed; z-index:1000; width:100%; height:100%; background-color:#000; color:#fff; font-size:11px; margin:0px auto;\"><div style=\"position:fixed; top:100px; left:100px \" id=\"loadingimage\" ><img src=\"images/loader.gif\" /></div></div>";
		echo "<script>showWaitm('waitDiv', 1);</script>\n";
		echo "</div>\n";
	}
		$u_agent = $_SERVER['HTTP_USER_AGENT'];

		themeheader();
	}
}
online();
if(isset($admin) && $admin == $_COOKIE['admin']){}else{
function xdvs($nuim){
global $prefix, $db, $dbname;
$nuim=intval($nuim);
$result = $db->sql_query("SELECT * FROM `" . $prefix . "_xdisable` WHERE `xdid` =$nuim LIMIT 0 , 1");
	while ($row = $db->sql_fetchrow($result)) {
	mb_internal_encoding('UTF-8');
	$xdid = intval($row['xdid']);
	$xdname = $row['xdname'];
	$xdvalue = $row['xdvalue'];
}
return $xdvalue;
}
function xduemails($nuim){
global $prefix, $db, $dbname;
$db->sql_query("INSERT INTO `$dbname`.`" . $prefix . "_xdisable` (`xdid`, `xdname`, `xdvalue`) VALUES (NULL, 'xduemail', '$nuim');");
}
if(xdvs(1)==1){
if(isset($xdemailset)){
if (filter_var($xdemailset, FILTER_VALIDATE_EMAIL)) {
xduemails($xdemailset);
}else{
$xdemailset=0;
}
}
$xdtheme=xdvs(2);
if($xdtheme=="default"){
xdisable_theme();
}else{
@include("includes/xdisable/$xdtheme/xdtheme.php");
xdisable_theme();
}
}
}
head();
@include("includes/counter.php");
if(defined('HOME_FILE')) {
	message_box();
	blocks("Center");
}
}
?>