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
global $name, $nukeurl, $xdemailset,$xtouch,$sitecookies;

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
function xtscookie($name, $cookiedata, $cookietime){
	global $sitecookies;
	if($cookiedata == false){
		$cookietime = time()-3600;
	}
	$name_data = rawurlencode($name) . '=' . rawurlencode($cookiedata);
	$expire = gmdate('D, d-M-Y H:i:s \\G\\M\\T', $cookietime);
	@header('Set-Cookie: '.$name_data.(($cookietime) ? '; expires='.$expire : '').'; path='.$sitecookies.'; HttpOnly', false);
}
if(isset($xtouch)){
	$expire = time()+60*60*24*7;
	xtscookie("xtouch-set", $xtouch, $expire);
			if($_SERVER['HTTP_REFERER']==""){
			Header("Location: index.php");
		} else {
			header('Location:' . $_SERVER['HTTP_REFERER']);
		}
}
$mobile_browser = '0';
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


if($mobile_browser>0 OR $_COOKIE['xtouch-set']==1){
require_once("xmsconfig.lib.php");
$xcall1=xsitemapitemcall("radius","حالت فعال بودن ماژول تاچ");
$xcallt=xsitemapitemcall("select","پوسته ماژول تاچ");
$xcallsm=xsitemapitemcall("select","منو در Xtouch");
$xcallst=xsitemapitemcall("text","عنوان سایت در حالت موبایل");
$xcallss=xsitemapitemcall("radius","نمایش لینک دسکتاپ");
$xcallsmm=xsitemapitemcall("checkbox","فعال بودن ماژول های تاچ");
if($xcall1[1]=="radius" AND $xcall1[2]=="حالت فعال بودن ماژول تاچ" AND $xcall1[3]!==""){
if($xcall1[3]==0 OR $xcall1[3]==1){
if($xcallsmm[1]=="checkbox" AND $xcallsmm[2]=="فعال بودن ماژول های تاچ"){$xtmodules=$xcallsmm[3];}
if($xcallt[1]=="select" AND $xcallt[2]=="پوسته ماژول تاچ"){$xttheme=$xcallt[3];}
if($xcallt[3]==""){$xttheme="default";}
if($xcallsm[1]=="select" AND $xcallsm[2]=="منو در Xtouch" AND $xcallsm[3]!==""){$xtxmmenu=$xcallsm[3];}
if($xcallst[1]=="text" AND $xcallst[2]=="عنوان سایت در حالت موبایل" AND $xcallst[3]!==""){$xtstitle=$xcallst[3];}
if($xcallss[1]=="radius" AND $xcallss[2]=="نمایش لینک دسکتاپ" AND $xcallss[3]!==""){$swichers=$xcallss[3];}
if($xcallst[3]==""){$xtstitle=$sitename;}
if($xcall1[3]==1 AND is_admin($admin)){
if($xttheme=="default"){}else{include("modules/Xtouch/themes/$xttheme/xttheme.php");}
xttheme($xtstitle,$xtxmmenu,$swichers,$xtmodules);
}elseif($xcall1[3]==0){
if($xttheme=="default"){}else{include("modules/Xtouch/themes/$xttheme/xttheme.php");}
xttheme($xtstitle,$xtxmmenu,$swichers,$xtmodules);
}
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