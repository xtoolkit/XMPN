<?php

/************************************************************************/
/* PHP-NUKE: Web Portal System                                          */
/* ===========================                                          */
/*                                                                      */
/* Copyright (c) 2006 by Francisco Burzi                                */
/* http://phpnuke.org                                                   */
/*                                                                      */
/* This program is free software. You can redistribute it and/or modify */
/* it under the terms of the GNU General Public License as published by */
/* the Free Software Foundation; either version 2 of the License.       */
/************************************************************************/

if (!defined('ADMIN_FILE')) {
  die ("Access Denied");
}

global $prefix, $db, $admin_file;
$aid = substr($aid, 0,25);
$row = $db->sql_fetchrow($db->sql_query("SELECT title, admins FROM ".$prefix."_modules WHERE title='Xtouch'"));
$row2 = $db->sql_fetchrow($db->sql_query("SELECT name, radminsuper FROM ".$prefix."_authors WHERE aid='$aid'"));
$admins = explode(",", $row['admins']);
$auth_user = 0;
for ($i=0; $i < sizeof($admins); $i++) {
  if ($row2['name'] == "$admins[$i]" AND !empty($row['admins'])) {
    $auth_user = 1;
  }
}

if ($row2['radminsuper'] == 1 || $auth_user == 1) {
function get_latest_xtouchverj($mode=''){
	if (extension_loaded('sockets') && function_exists('fsockopen') ){
		if ($fsock = @fsockopen("www.xstar.ir", 80, $errno, $errstr, 10))
		{
			@fputs($fsock, "GET /xtouchverj.txt HTTP/1.1\r\n");
			@fputs($fsock, "HOST: www.xstar.ir\r\n");
			@fputs($fsock, "Connection: close\r\n\r\n");

			$file_info = '';
			$get_info = false;

			while (!@feof($fsock))
			{
				if ($get_info)
				{
					$file_info .= @fread($fsock, 1024);
				}
				else
				{
					$line = @fgets($fsock, 1024);
					if ($line == "\r\n")
					{
						$get_info = true;
					}
					else if (stripos($line, '404 not found') !== false)
					{
						$errstr = 'FILE_NOT_FOUND : version.html';
						return false;
					}
				}
			}
			@fclose($fsock);
		}
		else
		{
			if ($errstr)
			{
				return false;
			}
			else
			{
				$errstr = "The operation could not be completed because the <var>fsockopen</var> function has been disabled or the server being queried could not be found.";
				return false;
			}
		}

		return $file_info;
	}else{
		if(isset($mode) && $mode == "adminmain"){
			die("Initial3");
		}
		return "Initial3";
	}
}
function massagrex($text){
?>		<div id="message-red">
		<table border="0" width="100%" cellpadding="0" cellspacing="0">
		<tr><td class="red-right"><a class="close-red"><img src="admin/template/images/table/icon_close_red.gif"   alt="" /></a></td>
		<td class="red-left"><?php echo $text; ?></a></td>
		</tr>
		</table>
		</div>
<?php
}
function xtouch() {
	global $bgcolor2, $prefix, $db, $admin_file, $dbname, $sitename, $nukeurl;
include ("header.php");
require_once("XMSConfig.lib.php");
GraphicAdmin();
OpenAdminTable();
$exitxmenu=0;
$exitxmsc=0;
if(file_exists("admin/modules/xmenu.php")){$exitxmenu=1;}
if(file_exists("admin/modules/xmsconfig.php")){$exitxmsc=1;}
$dfsdfsd = $db->sql_numrows($db->sql_query("SELECT * FROM `" . $prefix . "_xmsconfig` LIMIT 0 , 1"));
if($exitxmsc==0){
massagrex("<a href=\"http://www.phpnuke.ir/Forum/forum-f9/xmsconfig-t71285.html\">ماژول پیکربندی اطلاعات بیشتر نصب نشده است. برای نصب ماژول تاچ ابتدا ماژول پیکربندی اطلاعات بیشتر باید نصب شود.</a>");
}
if($exitxmenu==0){
massagrex("<a href=\"http://www.phpnuke.ir/Forum/forum-f9/xmenu-t70968.html#p414010\">سیستم یکپارچه مدیریت منوها نصب نشده است. برای نصب ماژول تاچ ابتدا سیستم یکپارچه مدیریت منوها باید نصب شود.</a>");
}
if (extension_loaded('sockets') && function_exists('fsockopen') ){ $xmnvaa=get_latest_xtouchverj(); } 
if($xmnvaa==""){$xmnvaa=="Initial3";}
if($xmnvaa=="Initial3"){}else{massaggex("<a href=\"http://www.phpnuke.ir/Forum/forum-f9/xtouch-t71295.html\">نسخه جدید ماژول Xtouch به ورژن $xmnvaa انتشار یافت !!!</a>");}
if($exitxmsc==1 AND $exitxmenu==1){
?><center><font class="title"><b>ماژول تاچ</b></font></center><br>
<link rel="stylesheet" href="includes/Ajax/jquery/jquery.tabs.css" type="text/css" media="print, projection, screen" />
<script src="includes/Ajax/jquery/jquery.tabs.pack.js" type="text/javascript"></script>
<script type="text/javascript">
$(function() {
$('#container-4').tabs({ fxFade: true, fxSpeed: 'fast' });                              
});
</script>
<br><div class="Table">
<div class="Contents">
<div id="container-4">
<ul>
	<li><a href="#admincal"><span>مدیریت ماژول</span></a></li>
	<li><a href="#calnotify"><span>اطلاعات ماژول</span></a></li>
	<li><a href="#calhelp"><span>راهنما ماژول</span></a></li>
</ul>
<div id="admincal">
<?php
xsitemapinsert("text","عنوان سایت در حالت موبایل",$sitename);
xsitemapinsert("radius","حالت فعال بودن ماژول تاچ","0");
xsitemapinsert("radius","نمایش لینک دسکتاپ","1");
xsitemapinsert("checkbox","فعال بودن ماژول های تاچ","0,1");
xsitemapinsert("select","پوسته ماژول تاچ","simple");
xsitemapinsert("select","منو در Xtouch","0");
$xmstextform=array(
	"عنوان سایت در حالت موبایل",
	array(
		"set"=>"حالت فعال بودن ماژول تاچ",
		0=>"نمایش برای همه",
		1=>"نمایش فقط برای مدیران",
		2=>"غیر فعال کردن ماژول"
	),
	array(
		"set"=>"نمایش لینک دسکتاپ",
		0=>"خیر",
		1=>"بلی"
	),
	array(
		"set"=>"فعال بودن ماژول های تاچ"
	),
	array(
		"set"=>"پوسته ماژول تاچ",
		"default"=>"فراخوانی توسط تابع در گوسته سایت"
	),
	array(
		"set"=>"منو در Xtouch",
		"0"=>"غیر فعال"
	)
);
		$handle=opendir("modules/Xtouch/themes/");
		while ($file = readdir($handle)) {
			if ( (!@ereg("[.]",$file)) ) {
				$themelist .= "$file ";
			}
		}
		closedir($handle);
		$themelist = explode(" ", $themelist);
		sort($themelist);
		for ($i=0; $i < sizeof($themelist); $i++) {
			if(!empty($themelist[$i])) {
				$xmstextform[4][$themelist[$i]]=$themelist[$i];
			}
		}
		$xcallt=xsitemapitemcall("select","پوسته ماژول تاچ");
		if($xcallt[1]=="select" AND $xcallt[2]=="پوسته ماژول تاچ"){$xttheme=$xcallt[3];}
		if($xcallt[3]==""){$xttheme="default";}
		if($xttheme=="default"){
		$ThemeSel = get_theme();
		$handlee=opendir("themes/$ThemeSel/Xtouch/modules/");
		}else{
		$handlee=opendir("modules/Xtouch/themes/$xttheme/modules/");
		}
		while ($file = readdir($handlee)) {
			if ( (!@ereg("[.]",$file)) ) {
				$themelistt .= "$file ";
			}
		}
		closedir($handlee);
		$themelistt = explode(" ", $themelistt);
		sort($themelistt);
		for ($i=0; $i < sizeof($themelistt); $i++) {
			if(!empty($themelistt[$i])) {
				$xmstextform[3][$themelistt[$i]]=$themelistt[$i];
			}
		}
$result = $db->sql_query("SELECT *
FROM `" . $prefix . "_xmenu`
WHERE `xid` =0
ORDER BY `" . $prefix . "_xmenu`.`xmid` DESC
LIMIT 0 , 30");
	while ($row = $db->sql_fetchrow($result)) {
	mb_internal_encoding('UTF-8');
	$xmid = intval($row['xmid']);
	$xmtitle = $row['xmtitle'];
	$xmclass = $row['xmclass'];
	if($xmclass=="xtouchmenu"){$xmstextform[5][$xmid]=$xmtitle;}
}
global $xmsconf,$xmlsa;
xmsconfigform($xmstextform,$xmsconf,$xmlsa);
?>
</div>
<div id="calnotify">
<div class="Table">
<div class="Contents">
				<div align="center">
					<table id="product-table" border="1" width="600">
						<tr>
							<th colspan="2" class="table-header-repeat line-left" style="text-align:center;"><a>مدیریت ماژول</a></th>
						</tr>
						<tr>
							<td style="width:50%;line-height:25px;">نسخه نصب شده غیر فعال کننده نیوک</td>
							<td style="width:50%;line-height:25px;direction:ltr;">Initial3</td>
						</tr>
						<tr>
							<td style="width:50%;line-height:25px;">آخرین نسخه انتشار یافته توسط <a href="http://www.xstar.ir/">Xstar</a></td>
							<td style="width:50%;line-height:25px;direction:ltr;"><?php if (extension_loaded('sockets') && function_exists('fsockopen') ){ echo get_latest_xtouchverj(); } ?></td>
						</tr>
						<tr>
							<td style="width:50%;line-height:25px;">تغییرات</td>
							<td style="width:50%;line-height:25px;direction:ltr;"><a href="http://www.phpnuke.ir/Forum/forum-f9/xtouch-t71295.html">view changlogs</a></td>
						</tr>
					</table>
				</div>
				</div>
</div>
</div>
<div id="calhelp">
<p>به نام خدا</p>
<p>راهنمای ماژول تاچ</p>
<p>با آمدن طرح های رسپانسیو دقدقه وبسایت ها برای تلفن همراه تا حدودی بر طرف شد. اما بسیاری از سایت ها از سبک قدیمی طراحی استفاده می کنند. ماژول تاچ به این گونه وبسایت ها اجازه می دهد در کنار طرح اصلی سایت خود طرحی جدا برای تلفن ها ایجاد کنند.</p>
<br><p style="font:bold 13px tahoma;">نکته :</p><p>
1- بدیهیست در نسخه ابتدایی ماژول شاهد مشکلاتی باشید. گزارش مشکلات شما به سرعت بخشی حالت پایدار ماژول کمک خواهد کرد.<br>
2- پوسته simple فعلا تعداد محدودی از ماژول ها را پشتیبانی خواهد کرد.<br>
3- برای ارسال منو به ماژول در Xmenu ریشه منو مورد نظر خود را با کلاس xtouchmenu تعریف کنید.<br>
4- در فایل زیپ 2 فایل header قرار داده شده است. اگر از مود Xdisbale نصب کرده اید header2 را به header تغییر دهید.</p>
<br><p style="font:bold 13px tahoma;">چگونه پوسته اختصاصی طراحی کنیم؟</p>
<p>ب طراحان پوسته نیوک می توانند با ایجاد تابع xttheme برای theme.php خود جعبه اختصاصی تعریف کنند.
<br>
همچنین می توانند به صورت مسقل به نشانی modules/Xtouch/theme/ برای نیوک جعبه با پوسته مستقل بسازند.
</p><br><p style="font:bold 13px tahoma;">چگونه به کاربران اجازه انتخاب دهیم؟</p>
<p>بدین منظور کافیست لینک سوئیچ را در سایت خود قرار دهید. لینک سوئیچ:</p>
<p style="direction:ltr;text-align:left;"><pre style="direction:ltr;text-align:left;">
<?php echo $nukeurl; ?>?xtouch=1
</pre></p>
</div>
</div>
</div>
</div><?php
}
CloseAdminTable();
include ("footer.php");
}

switch ($op){
		default:
		xtouch();
		break;
}
} else {
  include("header.php");
  GraphicAdmin();
  OpenAdminTable();
  echo "<center><b>"._ERROR."</b><br><br>You do not have administration permission for module \"$module_name\"</center>";
  CloseAdminTable();
  include("footer.php");
}

?>