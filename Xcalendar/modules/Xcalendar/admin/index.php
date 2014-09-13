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
$row = $db->sql_fetchrow($db->sql_query("SELECT title, admins FROM ".$prefix."_modules WHERE title='XlinksBox'"));
$row2 = $db->sql_fetchrow($db->sql_query("SELECT name, radminsuper FROM ".$prefix."_authors WHERE aid='$aid'"));
$admins = explode(",", $row['admins']);
$auth_user = 0;
for ($i=0; $i < sizeof($admins); $i++) {
  if ($row2['name'] == "$admins[$i]" AND !empty($row['admins'])) {
    $auth_user = 1;
  }
}

if ($row2['radminsuper'] == 1 || $auth_user == 1) {
function get_latest_xcalendarverj($mode=''){
	if (extension_loaded('sockets') && function_exists('fsockopen') ){
		if ($fsock = @fsockopen("www.xstar.ir", 80, $errno, $errstr, 10))
		{
			@fputs($fsock, "GET /xcalendarverj.txt HTTP/1.1\r\n");
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
			die("beta1");
		}
		return "beta1";
	}
}
function xcvs($nuim){
global $prefix, $db, $dbname;
$nuim=intval($nuim);
$result = $db->sql_query("SELECT * FROM `" . $prefix . "_xcalendar` WHERE `xcid` =$nuim LIMIT 0 , 1");
	while ($row = $db->sql_fetchrow($result)) {
	mb_internal_encoding('UTF-8');
	$xcid = intval($row['xcid']);
	$xcname = $row['xcname'];
	$xcvalue = $row['xcvalue'];
}
return $xcvalue;
}
function xcieus($nuim,$xxvalue){
global $prefix, $db, $dbname;
$nuim=intval($nuim);
$db->sql_query("UPDATE `$dbname`.`" . $prefix . "_xcalendar` SET `xcvalue` = '$xxvalue' WHERE `" . $prefix . "_xcalendar`.`xcid` =$nuim;");
}
function massaggex($text){
?>		<div id="message-green">
		<table border="0" width="100%" cellpadding="0" cellspacing="0">
		<tr><td class="green-right"><a class="close-green"><img src="admin/template/images/table/icon_close_green.gif"   alt="" /></a></td>
		<td class="green-left"><?php echo $text; ?></a></td>
		</tr>
		</table>
		</div>
<?php
}
function xcalendar() {
	global $bgcolor2, $prefix, $db, $admin_file, $dbname, $xccalset, $xctheme, $xcnnews, $xcnprod, $xcncon;
include ("header.php");
GraphicAdmin();
OpenAdminTable();
$dfsdfsd = $db->sql_numrows($db->sql_query("SELECT *
FROM `" . $prefix . "_xcalendar`
LIMIT 0 , 3"));
if($dfsdfsd>0){}else{
$db->sql_query("CREATE TABLE IF NOT EXISTS `" . $prefix . "_xcalendar` (
  `xcid` int(11) NOT NULL AUTO_INCREMENT,
  `xcname` text NOT NULL,
  `xcvalue` text NOT NULL,
  PRIMARY KEY (`xcid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;");
$db->sql_query("INSERT INTO `" . $prefix . "_xcalendar` (`xcid`, `xcname`, `xcvalue`) VALUES
(1, 'xccalset', '1'),
(2, 'xctheme', 'Simple'),
(3, 'xcnnews', '1'),
(4, 'xcnprod', '1'),
(5, 'xcncon', '1');");
massaggex("نصب تقویم نیوک با موفقیت انجام شد.");
}
if (extension_loaded('sockets') && function_exists('fsockopen') ){ $xmnvaa=get_latest_xcalendarverj(); } 
if($xmnvaa==""){$xmnvaa=="beta1";}
if($xmnvaa=="beta1"){}else{massaggex("<a href=\"http://www.phpnuke.ir/Forum/forum-f9/xcalendar-t71002.html\">نسخه جدید ماژول Xcalendar به ورژن $xmnvaa انتشار یافت !!!</a>");}
?><center><font class="title"><b>ماژول تقویم برای نیوک</b></font></center><br>
<?php
if(isset($xccalset) AND isset($xctheme) AND isset($xcnnews) AND isset($xcnprod) AND isset($xcncon)){
xcieus(1,$xccalset);
xcieus(2,$xctheme);
xcieus(3,$xcnnews);
xcieus(4,$xcnprod);
xcieus(5,$xcncon);
massaggex("تغییرات با موفقیت انجام شد.");
}
?>
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
<form action="<?php echo $admin_file; ?>.php" method="post">
<table align="center" border="0" cellpadding="4" cellspacing="4" width="100%" id="id-form">
<tr><th>تقویم پیشفرض</th><td><select name="xccalset" class="styledselect-select">
<option value="1" <?php if(xcvs(1)=="1"){ echo"selected"; } ?>>شمسی</option>
<option value="2" <?php if(xcvs(1)=="2"){ echo"selected"; } ?>>میلادی</option>
</select></td></tr>
<tr style="display:none;"><th>پوسته تقویم</th><td><select name="xctheme" class="styledselect-select">
	<option value="default" titile="(باید تابع xc_theme در theme.php وجود داشته باشد)" <?php if(xcvs(2)=="default"){ echo"selected"; } ?>>استفاده از تابع پوسته سایت </option>
<?php
		$handle=opendir("modules/Xcalendar/theme/");
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
				echo "	<option value='$themelist[$i]' "; if(xcvs(2)==$themelist[$i]){ echo"selected"; } echo">$themelist[$i]</option>\n";
			}
		}
?>
</select></td></tr>
<tr><th style="width:250px">اخبار در تقویم :</th><td>بلی <input name="xcnnews" type="radio" class="styled" value="1" <?php if(xcvs(3)==1){ ?>checked<?php } ?>> &nbsp;&nbsp; خیر <input name="xcnnews" type="radio" class="styled" value="0" <?php if(xcvs(3)==0){ ?>checked<?php } ?>></td></tr>
<tr><th style="width:250px">فروشگاه در تقویم :</th><td>بلی <input name="xcnprod" type="radio" class="styled" value="1" <?php if(xcvs(4)==1){ ?>checked<?php } ?>> &nbsp;&nbsp; خیر <input name="xcnprod" type="radio" class="styled" value="0" <?php if(xcvs(4)==0){ ?>checked<?php } ?>></td></tr>
<tr><th style="width:250px">مقالات در تقویم :</th><td>بلی <input name="xcncon" type="radio" class="styled" value="1" <?php if(xcvs(5)==1){ ?>checked<?php } ?>> &nbsp;&nbsp; خیر <input name="xcncon" type="radio" class="styled" value="0" <?php if(xcvs(5)==0){ ?>checked<?php } ?>></td></tr>
<tr><td><input class="form-submit" type='submit' value='ذخیره'>
</td></tr>
<input type="hidden" name="op" value="xcalendar">
</table>
</form>
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
							<td style="width:50%;line-height:25px;direction:ltr;">beta1</td>
						</tr>
						<tr>
							<td style="width:50%;line-height:25px;">آخرین نسخه انتشار یافته توسط <a href="http://www.xstar.ir/">Xstar</a></td>
							<td style="width:50%;line-height:25px;direction:ltr;"><?php if (extension_loaded('sockets') && function_exists('fsockopen') ){ echo get_latest_xcalendarverj(); } ?></td>
						</tr>
						<tr>
							<td style="width:50%;line-height:25px;">تغییرات</td>
							<td style="width:50%;line-height:25px;direction:ltr;"><a href="http://www.phpnuke.ir/Forum/forum-f9/xcalendar-t71002.html">view changlogs</a></td>
						</tr>
					</table>
				</div>
				</div>
</div>
</div>
<div id="calhelp">
<p>به نام خدا</p>
<p>راهنمای مژول تقویم</p>
<br><p style="font:bold 13px tahoma;">چگونه در theme.php و یا بلوک تقویم را بارگذاری کنم ؟</p>
<p>شما میتوانید به شیوه زیر عمل کنید :</p>
<p style="direction:ltr;text-align:left;"><pre style="direction:ltr;text-align:left;">
require_once("Xcalendar.lib.php");
echo xcstylecss(20); // td heath : 20
echo $fxcalsf("","",2,1); // ("year", "month", "show full name day : 1 , show own alphabet name day : 2", "hidden prev and next and year , add link for month : 1 , else 2");
</pre></p>
<br><p style="font:bold 13px tahoma;">موقع کلیک بر روی لینک تقویم ، ارور 404 می دهد ؟</p>
<p>
	کد های زیر را در انتهای فایل .htaccess قرار دهید.</p>
<p style="direction:ltr;text-align:left;"><pre style="direction:ltr;text-align:left;">#Xcalendar
RewriteRule ^Xcalendar/shamsi/([0-9]*)/([0-9]*)/([0-9]*)/ modules.php?name=Xcalendar&xccset=shamsi&xcyear=$1&xcmonth=$2&xcday=$3
RewriteRule ^Xcalendar/shamsi/([0-9]*)/([0-9]*)/ modules.php?name=Xcalendar&xccset=shamsi&xcyear=$1&xcmonth=$2
RewriteRule ^Xcalendar/shamsi/([0-9]*)/ modules.php?name=Xcalendar&xccset=shamsi&xcyear=$1
RewriteRule ^Xcalendar/shamsi/ modules.php?name=Xcalendar&xccset=shamsi
RewriteRule ^Xcalendar/miladi/([0-9]*)/([0-9]*)/([0-9]*)/ modules.php?name=Xcalendar&xccset=miladi&xcyear=$1&xcmonth=$2&xcday=$3
RewriteRule ^Xcalendar/miladi/([0-9]*)/([0-9]*)/ modules.php?name=Xcalendar&xccset=miladi&xcyear=$1&xcmonth=$2
RewriteRule ^Xcalendar/miladi/([0-9]*)/ modules.php?name=Xcalendar&xccset=miladi&xcyear=$1
RewriteRule ^Xcalendar/miladi/ modules.php?name=Xcalendar&xccset=miladi
RewriteRule ^Xcalendar/([0-9]*)/([0-9]*)/([0-9]*)/ modules.php?name=Xcalendar&xcyear=$1&xcmonth=$2&xcday=$3
RewriteRule ^Xcalendar/([0-9]*)/([0-9]*)/ modules.php?name=Xcalendar&xcyear=$1&xcmonth=$2
RewriteRule ^Xcalendar/([0-9]*)/ modules.php?name=Xcalendar&xcyear=$1
RewriteRule ^Xcalendar/ modules.php?name=Xcalendar</pre></p>
</div>
</div>
</div>
</div><?php
CloseAdminTable();
include ("footer.php");
}

switch ($op){
		default:
		xcalendar();
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