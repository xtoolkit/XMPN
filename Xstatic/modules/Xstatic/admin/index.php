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
$row = $db->sql_fetchrow($db->sql_query("SELECT title, admins FROM ".$prefix."_modules WHERE title='Xstatic'"));
$row2 = $db->sql_fetchrow($db->sql_query("SELECT name, radminsuper FROM ".$prefix."_authors WHERE aid='$aid'"));
$admins = explode(",", $row['admins']);
$auth_user = 0;
for ($i=0; $i < sizeof($admins); $i++) {
  if ($row2['name'] == "$admins[$i]" AND !empty($row['admins'])) {
    $auth_user = 1;
  }
}

if ($row2['radminsuper'] == 1 || $auth_user == 1) {
function get_latest_xstaticverj($mode=''){
	if (extension_loaded('sockets') && function_exists('fsockopen') ){
		if ($fsock = @fsockopen("www.xstar.ir", 80, $errno, $errstr, 10))
		{
			@fputs($fsock, "GET /xstaticverj.txt HTTP/1.1\r\n");
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
			die("RC3");
		}
		return "RC3";
	}
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
function xlbitems($item1,$item2,$item3,$item4,$item5,$item6,$item7){
	global $prefix,$db,$dbname;
?>
<tr><td style="width:250px">زیر صفحه : </td><td><select name="xssid" class="styledselect-select">
<option value="0">---</option>
<?php $result = $db->sql_query("SELECT *
FROM `" . $prefix . "_xstatic`
ORDER BY `" . $prefix . "_xstatic`.`xsid` DESC
LIMIT 0 , 99999");
	while ($row = $db->sql_fetchrow($result)) {
	mb_internal_encoding('UTF-8');
	$xsid = intval($row['xsid']);
	$xstitle = $row['xstitle'];
	if($xsid==$item6){}else{ ?><option value="<?php echo $xsid; ?>" <?php if($xsid==$item1){ ?>selected<?php } ?>><?php echo $xstitle; ?></option><?php }} ?>
</select></td></tr>
<tr><td>عنوان صفحه : </td><td><input name='xstitle' value='<?php echo $item2; ?>' class="inp-form-ltr"></td></tr>
<tr><td>تگ برای آدرس(English) : </td><td><input name='xsgt' value='<?php echo $item3; ?>' class="inp-form-ltr"></td></tr>
<tr><td>صفحه انتقال(Redirect) : </td><td><input name='xsred' value='<?php echo $item7; ?>' class="inp-form-ltr"></td></tr>
<tr><td>متن صفحه</td><td><?php wysiwyg_textarea('xstext',$item4, 'Artikel', 50, 15); ?></td></tr>
<tr><td>کلمات کلیدی : </td><td><input name='xstag' value='<?php echo $item5; ?>' class="inp-form-ltr"></td></tr>
<?php
}
function gettibyb($nuim){
global $prefix, $db, $dbname;
$nuim=intval($nuim);
if($nuim==0){
$xstitle="شاخه اصلی";
}else{
$result = $db->sql_query("SELECT *
FROM `" . $prefix . "_xstatic`
WHERE `xsid` =$nuim
LIMIT 0 , 1");
	while ($row = $db->sql_fetchrow($result)) {
	mb_internal_encoding('UTF-8');
	$xstitle = $row['xstitle'];
}
}
return $xstitle;
}
function getxslink($nuim){
global $prefix, $db, $dbname, $gtset;
$nuim=intval($nuim);
$result = $db->sql_query("SELECT *
FROM `" . $prefix . "_xstatic`
WHERE `xsid` =$nuim
LIMIT 0 , 1");
	while ($row = $db->sql_fetchrow($result)) {
	mb_internal_encoding('UTF-8');
	$xssid = $row['xssid'];
	$xsgt = $row['xsgt'];
	$xreturn.="$xsgt/";
	if($xssid==0){}else{$xreturn.=getxslink($xssid);}
}
$xreturn=explode('/', $xreturn);
$checkarrayxs=count($xreturn);
if($xreturn[$checkarrayxs-1]==""){unset($xreturn[$checkarrayxs-1]);}
$checkarrayxs=count($xreturn);
for ($i=$checkarrayxs; $i>0; $i--) {
$xreturne.=$xreturn[$i-1];
$xreturne.="/";
}

return $xreturne;
}
function checkgxurl($nuim,$xsgt){
global $prefix, $db, $dbname, $gtset;
$nuim=intval($nuim);
$dfsdfsd = $db->sql_numrows($db->sql_query("SELECT *
FROM `" . $prefix . "_xstatic`
WHERE `xssid` =$nuim
AND `xsgt` = '$xsgt'
LIMIT 0 , 30"));
$dfsdfsd=intval($dfsdfsd);
return $dfsdfsd;
}
function checkgxurcl($nuim,$xsgt){
global $prefix, $db, $dbname, $gtset;
$nuim=intval($nuim);
$dfsdfsd = $db->sql_numrows($db->sql_query("SELECT *
FROM `" . $prefix . "_xstatic`
WHERE `xsid` =$nuim
AND `xsgt` = '$xsgt'
LIMIT 0 , 30"));
$dfsdfsd=intval($dfsdfsd);
return $dfsdfsd;
}
function xstatic() {
	global $prefix, $db, $admin_file, $dbname, $sitename, $xniniki, $xnikiuid, $xsuid, $xssid, $xstitle, $xsgt, $xstext, $xstag, $xsred,$gtset;
include ("header.php");
GraphicAdmin();
OpenAdminTable();
$dfsdfsd = $db->sql_numfields($db->sql_query("SELECT *
FROM `" . $prefix . "_xstatic`"));
if($dfsdfsd==9){
}elseif($dfsdfsd==8){
$db->sql_query("ALTER TABLE `nuke_xstatic` ADD `xredirect` TEXT NOT NULL");
massaggex("آپدیت با موفقیت انجام شد. برای ادامه <a href=\"$admin_file.php?op=xstatic\">اینجا</a> کلیک کنید.");
CloseAdminTable();
include("footer.php");
die();
}else{
$db->sql_query("CREATE TABLE IF NOT EXISTS `".$prefix."_xstatic` (
  `xsid` int(11) NOT NULL AUTO_INCREMENT,
  `xssid` int(11) NOT NULL,
  `xsgt` text NOT NULL,
  `xstitle` text NOT NULL,
  `xstext` text NOT NULL,
  `xstags` text NOT NULL,
  `xscounter` int(11) NOT NULL,
  `xscomment` int(11) NOT NULL,
  PRIMARY KEY (`xsid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;");
mb_internal_encoding('UTF-8');
$db->sql_query("SET NAMES utf8;");
$db->sql_query("INSERT INTO `".$prefix."_xstatic` (`xsid`, `xssid`, `xsgt`, `xstitle`, `xstext`, `xstags`, `xscounter`, `xscomment`) VALUES
(1, 0, 'wiki', 'ÙˆÛŒÚ©ÛŒ Ù†ÛŒÙˆÚ©', '<p>\r\n	Ù…Ø±Ú©Ø² Ø¢Ù…ÙˆØ²Ø´Ù‡Ø§ Ùˆ Ø³Ø¤Ø§Ù„Ø§Øª Ø±Ø§ÛŒØ¬ Ù†ÛŒÙˆÚ© Ù…Ø´Ù‡Ø¯ ØªÛŒÙ…</p>\r\n', 'wiki,nuke,ÙˆÛŒÚ©ÛŒ,Ù†ÛŒÙˆÚ©', 0, 0),
(2, 1, 'start-with-persian-nuke', 'Ø´Ø±ÙˆØ¹ ÙƒØ§Ø± Ø¨Ø§ Ù†ÙŠÙˆÙƒ ÙØ§Ø±Ø³ÛŒ', '<p>\r\n	Ø¢Ù…ÙˆØ²Ø´ Ù‡Ø§ÛŒ Ø´Ø±ÙˆØ¹ ÙƒØ§Ø± Ø¨Ø§ Ù†ÙŠÙˆÙƒ ÙØ§Ø±Ø³ÛŒ</p>\r\n', 'start,with,persian,nuke', 3, 0),
(3, 2, 'basic-option', 'ØªØ¸ÙŠÙ…Ø§Øª Ø§ÙˆÙ„ÙŠÙ‡ Ù†ÙŠÙˆÙƒ', '<p>\r\n	Ø¨Ø¹Ø¯ Ø§Ø² Ù†ØµØ¨ Ù†ÙŠÙˆÙƒ Ø§ÙˆÙ„ÙŠÙ† Ù‚Ø¯Ù… ØªÙ†Ø¸ÙŠÙ…Ø§Øª Ø§ÙˆÙ„ÙŠÙ‡ Ø³Ø§ÙŠØª Ù‡Ø³Øª.Ø¨Ø§ÙŠØ¯ Ø§ÙŠÙ† ØªÙ†Ø¸ÙŠÙ…Ø§Øª Ø¨Ù‡ Ø®ÙˆØ¨ÙŠ Ø§Ù†Ø¬Ø§Ù… Ø¨Ø´Ù‡ ØªØ§ Ø¨ØªÙˆÙ†ÙŠØ¯ Ù…Ø¯ÙŠØ±ÙŠØª ÙƒØ§Ù…Ù„ÙŠ Ø¨Ø± Ø³Ø§ÙŠØªØªÙˆÙ† Ø¯Ø§Ø´ØªÙ‡ Ø¨Ø§Ø´ÙŠØ¯.</p>\r\n<p>\r\n	Ø¨Ø±Ø§ÙŠ Ø±ÙØªÙ† Ø¨Ù‡ ØªÙ†Ø¸ÙŠÙ…Ø§Øª Ø¯Ø± Ù…Ù†ÙˆÙŠ Ù…Ø¯ÙŠØ±ÙŠØª Ø±ÙˆÙŠ Ø¢ÙŠÙƒÙˆÙ† ØªÙ†Ø¸ÙŠÙ…Ø§Øª Ø³ÙŠØ³ØªÙ… ÙƒÙ„ÙŠÙƒ ÙƒÙ†ÙŠØ¯.</p>\r\n<p style=\"text-align: center;\">\r\n	<a href=\"http://phpnuke.ir/wikipath/images/lessons/9-1.jpg\" rel=\"lightbox1\" target=\"_blank\"><img alt=\"\" border=\"0\" height=\"396\" src=\"http://phpnuke.ir/wikipath/images/lessons/9-1.jpg\" width=\"500\" /></a></p>\r\n<p>\r\n	ØªÙ†Ø¸ÙŠÙ…Ø§Øª Ø±Ùˆ Ø·Ø¨Ù‚ Ø¹ÙƒØ³ Ø²ÙŠØ± ØªÙˆØ¶ÙŠØ­ Ù…ÙŠØ¯Ù….</p>\r\n<p style=\"text-align: center;\">\r\n	<a href=\"http://phpnuke.ir/wikipath/images/lessons/9-2.jpg\" rel=\"lightbox1\" target=\"_blank\"><img alt=\"\" border=\"0\" height=\"500\" src=\"http://phpnuke.ir/wikipath/images/lessons/9-2.jpg\" width=\"362\" /></a></p>\r\n<p>\r\n	&nbsp;</p>\r\n<p>\r\n	1. Ø¹Ù†ÙˆØ§Ù† Ø³Ø§ÙŠØª.Ø§ÙŠÙ† Ø¹Ù†ÙˆØ§Ù† Ø¯Ø± Ù‡Ù…Ù‡ Ø¬Ø§ÙŠ Ø³Ø§ÙŠØª Ù…ÙˆØ±Ø¯ Ø§Ø³ØªÙØ§Ø¯Ù‡ Ù‚Ø±Ø§Ø± Ù…ÙŠÚ¯ÙŠØ±Ù‡.</p>\r\n<p>\r\n	2. Ø¢Ø¯Ø±Ø³ Ø³Ø§ÙŠØª.Ø§ÙŠÙ† Ù‚Ø³Ù…Øª Ø®ÙŠÙ„ÙŠ Ù…Ù‡Ù…Ù‡ Ùˆ Ø¨Ø§ÙŠØ¯ Ø¯Ù‚ÙŠÙ‚Ø§Ù‹ Ù…Ø·Ø§Ø¨Ù‚ Ø¢Ø®Ø±ÙŠÙ† Ø¢Ø¯Ø±Ø³ Ø³Ø§ÙŠØªØªÙˆÙ† Ø¨Ø§Ø´Ù‡.Ú†ÙˆÙ† Ù…Ù…ÙƒÙ†Ù‡ Ø¨Ù†Ø§ Ø¨Ù‡ Ù‡Ø± Ø¯Ù„ÙŠÙ„ÙŠ Ø¢Ø¯Ø±Ø³ Ø³Ø§ÙŠØªØªÙˆÙ† Ø±Ùˆ Ø¹ÙˆØ¶ ÙƒÙ†ÙŠØ¯.Ù†ÙƒØªÙ‡Ø¨Ø¹Ø¯ÙŠ Ø§ÙŠÙ† ÙƒÙ‡ Ø¨Ø§ÙŠØ¯ Ø­ØªÙ…Ø§Ù‹&zwnj;Ø¢Ø¯Ø±Ø³ Ø¨Ø§ / ØªÙ…ÙˆÙ… Ø¨Ø´Ù‡ Ù…Ø«Ù„Ø§Ù‹</p>\r\n<p style=\"text-align: left; direction: ltr;\">\r\n	http://phpnuke.ir/</p>\r\n<p>\r\n	3. Ø´Ø¹Ø§Ø± Ø³Ø§ÙŠØª.Ù…Ù…ÙƒÙ†Ù‡ Ø³Ø§ÙŠØª Ø´Ù…Ø§ Ø¯Ø§Ø±Ø§ÙŠ Ø´Ø¹Ø§Ø±ÙŠ Ø¨Ø§Ø´Ù‡.Ù…ÙŠØªÙˆÙ†ÙŠØ¯ Ø§ÙŠÙ†Ø¬Ø§ Ø§ÙŠÙ† Ø´Ø¹Ø§Ø± Ø±Ùˆ ÙˆØ§Ø±Ø¯ ÙƒÙ†ÙŠØ¯ Ùˆ Ù…Ø«Ù„Ø§Ù‹&zwnj;Ø¯Ø± Ø·Ø±Ø§Ø­ÙŠ Ù‚Ø§Ù„Ø¨Ù‡Ø§ØªÙˆÙ† Ø§Ø²Ø´ Ø§Ø³ØªÙØ¯Ù‡ ÙƒÙ†ÙŠØ¯.Ú†ÙˆÙ† Ø¨Ù‡ Ø·ÙˆØ± Ù¾ÙŠØ´ÙØ±Ø¶ ØªÙˆ Ø³ÙŠØ³ØªÙ… Ú¯Ù†Ø¬ÙˆÙ†Ø¯Ù‡ Ù†Ø´Ø¯Ù‡.</p>\r\n<p>\r\n	4. ØªØ§Ø±ÙŠØ® Ø´Ø±ÙˆØ¹ Ø¨Ù‡ ÙƒØ§Ø± Ø³Ø§ÙŠØª Ù‡Ù… ÙƒÙ‡ Ù…Ø´Ø®ØµÙ‡.</p>\r\n<p>\r\n	5. Ù†ÙˆØ¹ ØªØ§Ø±ÙŠØ®.ØªÙˆ ÙˆØ±&zwj;Ù† 8.3 Ø³Ù‡ Ù†ÙˆØ¹ ØªØ§Ø±ÙŠØ® Ø¯Ù‡ÙŠ ÙˆØ¬ÙˆØ¯ Ø¯Ø§Ø±Ù‡ ÙƒÙ‡ Ù‡Ø± ÙƒØ³ Ø¨Ø§ Ù‡Ø± Ø²Ø¨Ø§Ù† Ùˆ ØªØ§Ø±ÙŠØ®ÙŠ Ù…ÙŠØªÙˆÙ†Ù‡ Ø§Ø² Ø§ÙŠÙ† Ø§Ù†ÙˆØ§Ø¹ ØªØ§Ø±ÙŠØ® Ø¯Ù‡ÙŠ Ø§Ø³ØªÙØ§Ø¯Ù‡ ÙƒÙ†Ù‡.Ø¯Ø± Ø­Ø§Ù„ Ø­Ø§Ø¶Ø± Ø³Ù‡ ØªØ§Ø±ÙŠØ® Ø§ØµÙ„ÙŠ Ø´Ù…Ø³ÙŠ Ùˆ Ù‚Ù…Ø±ÙŠ Ùˆ Ù…ÙŠÙ„Ø§Ø¯ÙŠ Ø¨Ø±Ø§ÙŠ Ø§Ø³ØªÙØ§Ø¯Ù‡ ÙƒØ§Ø±Ø¨Ø±Ø§Ù† Ù…ÙˆØ¬ÙˆØ¯Ù‡.</p>\r\n<p>\r\n	6. Ù…Ø±Ø¨ÙˆØ· Ø¨Ù‡ Ø¢ÙŠÙƒÙˆÙ†Ù‡Ø§ÙŠÙŠ Ù…ÙŠØ´Ù‡ ÙƒÙ‡ Ø¯Ø± ØµÙØ­Ù‡ Ù…Ø¯ÙŠØ±ÙŠØª Ù…Ø´Ø§Ù‡Ø¯Ù‡ Ù…ÙŠÙƒÙ†ÙŠØ¯.Ø§Ú¯Ø± Ø³Ø±Ø¹Øª Ù„ÙˆØ¯ØªÙˆÙ† Ù¾Ø§ÙŠÙŠÙ†Ù‡ Ù…ÙŠØªÙˆÙ†ÙŠØ¯ Ø§ÙŠÙ† Ú¯Ø²ÙŠÙ†Ù‡ Ø±Ùˆ Ø®ÙŠØ± Ø¨Ø²Ù†ÙŠØ¯ ØªØ§ Ø¯Ø± Ø¶ÙØ­Ù‡ Ø§ÙˆÙ„ Ù…Ø¯ÙŠØ±ÙŠØª Ø¹ÙƒØ³Ù‡Ø§ Ù„ÙˆØ¯ Ù†Ø´Ø¯Ù† Ùˆ Ø³Ø±Ø¹ØªØªÙˆÙ† ÙŠÙ‡ Ø®ÙˆØ±Ø¯Ù‡ Ø¨ÙŠØ´ØªØ± Ø¨Ø´Ù‡.</p>\r\n<p>\r\n	7. Ø¯Ø± Ø§ÙŠÙ† Ù‚Ø³Ù…Øª Ø§Ù†ÙˆØ§Ø¹ Ù…Ø®ØªÙ„Ù Ù†Ù…Ø§ÙŠØ´ ÙƒØ¯ Ø§Ù…Ù†ÙŠØªÙŠ Ø±Ùˆ Ù…Ø´Ø®Øµ ÙƒØ±Ø¯ÙŠÙ….Ø¨Ø§ ØªØºÙŠÙŠØ± Ù‡Ø± ÙƒØ¯ÙˆÙ… Ø§Ø² Ø§ÙŠÙ† Ú¯Ø²ÙŠÙ†Ù‡ Ù‡Ø§ ÙƒØ¯ Ø§Ù…Ù†ÙŠØªÙŠ Ø¯Ø± Ù…Ø­Ù„ Ù…ÙˆØ±Ø¯ Ù†Ø¸Ø± Ù†Ù…Ø§ÙŠØ´ Ø¯Ø§Ø¯Ù‡ Ù…ÙŠØ´Ù‡ ÙŠØ§ ØºÙŠØ± ÙØ¹Ø§Ù„ Ù…ÙŠØ´Ù‡.</p>\r\n<p>\r\n	8. Ø§Ø¯ÙŠØªÙˆØ± Ø³Ø§ÙŠØª Ø¯Ùˆ Ù†ÙˆØ¹ Ù‡Ø³Øª.Ø³Ø§Ø¯Ù‡ Ùˆ Ù¾ÙŠØ´Ø±ÙØªÙ‡.Ø¯Ø± Ø­Ø§Ù„Øª Ù¾ÙŠØ´ÙØ±Ø¶ Ø§Ø¯ÙŠØªÙˆØ± Ø±ÙˆÙŠ Ø­Ø§Ù„Øª Ù¾ÙŠØ´Ø±ÙØªÙ‡ Ø³Øª Ø´Ø¯Ù‡ ÙƒÙ‡ Ø§Ú¯Ø± Ø¯ÙˆØ³Øª Ø¯Ø§Ø´ØªÙŠØ¯ Ø§Ø¯ÙŠØªÙˆØ±ØªÙˆÙ† Ø³Ø§Ø¯Ù‡ Ø¨Ø§Ø´Ù‡ Ø§ÙˆÙ† Ø±Ùˆ Ø±ÙˆÙŠ Ø§Ø¯ÙŠØªÙˆØ± Ù…ØªÙ† ÙŠØ§ (Ø¨Ø¯ÙˆÙ† Ø§Ø¯ÙŠØªÙˆØ±) Ù‚Ø±Ø§Ø± Ø¨Ø¯ÙŠØ¯.</p>\r\n<p>\r\n	9. Ø¨Ø§ Ø§Ù†ØªØ®Ø§Ø¨ Ø§ÙŠÙ† Ú¯Ø²ÙŠÙ†Ù‡ Ù…ÙŠØªÙˆÙ†ÙŠØ¯ ØªØ¹ÙŠÙŠÙ† ÙƒÙ†ÙŠØ¯ ÙƒÙ‡ Ø®Ø·Ø§Ù‡Ø§ÙŠ Ø³ÙŠØ³ØªÙ… Ù†Ù…Ø§ÙŠØ´ Ø¯Ø§Ø¯Ù‡ Ø¨Ø´Ù† ÙŠØ§ Ù†Ù‡.Ø¯Ø± Ø­Ø§Ù„Øª Ù¾ÙŠØ´ÙØ±Ø¶ Ù†Ù…Ø§ÙŠØ´ Ø§ÙŠÙ† Ø®Ø·Ø§Ù‡Ø§ ÙØ¹Ø§Ù„Ù‡.</p>\r\n<p>\r\n	10. Ø§ÙŠÙ† Ù…ÙˆØ±Ø¯ ÙŠÙƒÙŠ Ø§Ø² Ù…Ù‡Ù…ØªØ±ÙŠÙ† Ù‚Ø³Ù…ØªÙ‡Ø§Ø³Øª.Ù…Ø±Ø¨ÙˆØ· Ø¨Ù‡ Ø³Ø¦Ùˆ Ù…ÙŠØ´Ù‡ Ùˆ Ø§Ù†ØªØ®Ø§Ø¨ Ø¨Ù„ÙŠ Ø¨Ø±Ø§ÙŠ Ø§ÙˆÙ† Ú˜ÙŠØ´Ù†Ù‡Ø§Ø¯ Ù…ÙŠØ´Ù‡ Ù…Ú¯Ø± Ø§ÙŠÙ†ÙƒÙ‡ Ù‡Ø§Ø³Øª Ø´Ù…Ø§ Ø±Ø§ÙŠÚ¯Ø§Ù† Ø¨Ø§Ø´Ù‡ Ùˆ Ø§Ø§ÙŠÙ† Ù‚Ø§Ø¨Ù„ÙŠØª Ø±Ùˆ Ù¾Ø´ØªÙŠØ¨Ø§Ù†ÙŠ Ù†ÙƒÙ†Ù‡.</p>\r\n<p>\r\n	11. Ø§Ú¯Ø± Ø§ÙŠÙ† Ù…ÙˆØ±Ø¯ ÙØ¹Ø§Ù„ Ø¨Ø§Ø´Ù‡ Ù‡Ø± Ø¬Ø§ÙŠ Ø®Ø¨Ø±Ù‡Ø§ ÙƒÙ‡ Ù„ÙŠÙ†ÙƒÙŠ Ù‚Ø±Ø§Ø± Ø¨Ø¯ÙŠØ¯ ÙÙ‚Ø· Ø¨Ø±Ø§ÙŠ ÙƒØ§Ø±Ø¨Ø±Ø§Ù† Ø¹Ø¶Ùˆ Ø´Ø¯Ù‡ Ø³Ø§ÙŠØª Ù‚Ø§Ø¨Ù„ Ù†Ù…Ø§ÙŠØ´ Ù‡Ø³Øª Ùˆ Ø¨Ø±Ø§ÙŠ Ù…Ù‡Ù…Ø§Ù†Ø§Ù† Ù†Ù…Ø§ÙŠØ´ Ø¯Ø§Ø¯Ù‡ Ù†Ù…ÙŠØ´Ù‡.</p>\r\n<p>\r\n	12. Ø§ÙŠÙ† Ù…ÙˆØ±Ø¯ Ù‡Ù… Ø§Ú¯Ø± Ø¨Ù„ÙŠ Ø¨Ø§Ø´Ù‡ Ù…ÙˆÙ‚Ø¹ÙŠ ÙƒÙ‡ Ø¯Ø± Ø®Ø¨Ø±Ù‡Ø§ Ø±ÙˆÙŠ Ø¹ÙƒØ³ÙŠ ÙƒÙ„ÙŠÙƒ Ù…ÙŠÙƒÙ†ÙŠØ¯ Ø¹ÙƒØ³ Ø¨Ù‡ ØµÙˆØ±Øª Ù„Ø§ÙŠØª Ø¨Ø§ÙƒØ³ lightbox&nbsp; Ø¨Ø§Ø² Ù…ÙŠØ´Ù‡ ÙƒÙ‡ Ø¬Ù„ÙˆÙ‡ Ø¬Ø§Ù„Ø¨ÙŠ Ø¯Ø§Ø±Ù‡.</p>\r\n<p>\r\n	13. Ù†ÙˆØ¹ Ø§Ù…ØªÙŠØ§Ø² Ø¯Ù‡ÙŠ Ø¯Ø± ÙˆØ±Ú˜Ù† 8.3 Ø¨Ù‡ Ø¯Ùˆ Ù†ÙˆØ¹ Ø³ØªØ§Ø±Ù‡ Ø§ÙŠ Ùˆ Ù…Ø«Ø¨Øª Ùˆ Ù…Ù†ÙÙŠ ØªØºÙŠÙŠØ± ÙƒØ±Ø¯Ù‡.Ø´Ø§ÙŠØ¯ Ø¯ÙˆØ³Øª Ø¯Ø§Ø´ØªÙ‡ Ø¨Ø§Ø´ÙŠØ¯ Ø¨Ø±Ø§ÙŠ Ø®Ø¨Ø±Ù‡Ø§ØªÙˆÙ† Ø§Ø² Ø§Ù…ØªÙŠØ§Ø² Ù…Ù†ÙÙŠ Ø§Ø³ØªÙØ§Ø¯Ù‡ ÙƒÙ†ÙŠØ¯ ÙƒÙ‡ Ø§ÙŠÙ† Ù…ÙˆØ±Ø¯ Ø®ÙŠÙ„ÙŠ Ø¨Ø¯Ø±Ø¯ Ù…ÙŠØ®ÙˆØ±Ù‡.</p>\r\n<p>\r\n	14. ÙƒÙ„Ù…Ù‡ Ø¹Ø¨ÙˆØ± Ø¯Ø± Ø§ÙˆÙ„ÙŠÙ† ÙˆØ±ÙˆØ¯ Ø´Ù…Ø§ Ø¨Ù‡ Ù…Ø¯ÙŠØ±ÙŠØª Ø³Ø§ÙŠØª Ø¨Ø§ÙŠØ¯ ØªØºÙŠÙŠØ± ÙƒÙ†Ù‡ ÙˆÚ¯Ø±Ù†Ù‡ Ø¨Ø§ Ù…Ø´ÙƒÙ„ Ø¬Ø¯ÙŠ Ø±ÙˆØ¨Ø±Ùˆ Ø®ÙˆØ§Ù‡ÙŠØ¯ Ø´Ø¯.Ú†ÙˆÙ† Ø¯Ø§Ø´ØªÙ† Ø§ÙŠÙ† Ø±Ù…Ø² Ø¨Ù‡ Ù…Ø¹Ù†ÙŠ Ø¯Ø³ØªØ±Ø³ÙŠ Ø¨Ù‡ ØªÙ…Ø§Ù… ÙØ§ÙŠÙ„Ù‡Ø§ÙŠ Ù…ÙˆØ¬ÙˆØ¯ Ø¯Ø± Ù‡Ø§Ø³Øª Ø´Ù…Ø§Ø³Øª.Ø¯Ø± Ø§ÙˆÙ„ÙŠÙ† ÙˆØ±ÙˆØ¯ Ø¨Ù‡ Ù…Ù†ÙˆÙŠ Ù…Ø¯ÙŠØ±ÙŠØª Ø¨Ø¹Ø¯ Ø§Ø² Ù†ØµØ¨ Ù†ÙŠÙˆÙƒ Ø­ØªÙ…Ø§Ù‹ Ø§ÙŠÙ† ÙÙŠÙ„Ø¯ Ø±Ùˆ Ù¾Ø± ÙƒÙ†ÙŠØ¯.</p>\r\n<p>\r\n	15. Ù…ÙˆÙ‚Ø¹ Ø¨Ø§Ø² Ø´Ø¯Ù† Ø³Ø§ÙŠØª Ù‡Ø§Ù„Ù‡ Ø³ÙŠØ§Ù‡ Ø±Ù†Ú¯ÙŠ Ø±ÙˆÙŠ Ø³Ø§ÙŠØª Ø¸Ø§Ù‡Ø± Ù…ÙŠØ´Ù‡ Ùˆ ØªØ§ Ù¾Ø§ÙŠØ§Ù† Ù„ÙˆØ¯ÙŠÙ†Ú¯ Ù‡Ù… Ø§Ø¯Ø§Ù…Ù‡ Ø¯Ø§Ø±Ù‡ Ø¨Ø§ ØºÙŠØ± ÙØ¹Ø§Ù„ ÙƒØ±Ø¯Ù† Ø§ÙŠÙ† Ú¯Ø²ÙŠÙ†Ù‡ ÙƒØ§Ø±Ø¨Ø±Ø§Ù† Ù…Ø³ØªÙ‚ÙŠÙ… Ù…ÙŠØªÙˆÙ†Ù† Ø³Ø§ÙŠØª Ø±Ùˆ Ø¨Ø¨ÙŠÙ†Ù†.</p>\r\n<p>\r\n	Ø§Ø¯Ø§Ù…Ù‡ ØªÙ†Ø¸ÙŠÙ…Ø§Øª Ø¯Ø± Ø¢Ù…ÙˆØ²Ø´Ù‡Ø§ÙŠ Ø¨Ø¹Ø¯ÙŠ....</p>\r\n', 'basic,option,ØªØ¸ÙŠÙ…Ø§Øª,Ø§ÙˆÙ„ÙŠÙ‡,Ù†ÙŠÙˆÙƒ', 1, 0),
(4, 2, 'how-to-install', 'Ú†Ú¯ÙˆÙ†Ù‡ Ù†ÙŠÙˆÙƒ Ø±Ø§ Ù†ØµØ¨ ÙƒÙ†ÙŠÙ…', '<p>\r\n	Ø¨Ø¹Ø¯ Ø§Ø² Ù†ØµØ¨ xampp&nbsp; Ø§Ø¬Ø±Ø§ÙŠ ØµØ­ÙŠØ­ localhost Ø¨Ù‡ Ù…Ø³ÙŠØ± Ù†ØµØ¨ xampp Ø¨Ø±ÙŠØ¯.Ø¨Ø¹Ø¯Ø´ Ù¾ÙˆØ´Ù‡ htdocs.ÙŠØ¹Ù†ÙŠ Ù…Ø³ÙŠØ± C:xampphtdocs.Ø§ÙŠÙ†Ø¬Ø§ ÙŠÙƒ Ù¾ÙˆØ´Ù‡ Ø¨Ø³Ø§Ø²ÙŠØ¯.Ù‡Ø± Ø§Ø³Ù…ÙŠ Ø¯ÙˆØ³Øª Ø¯Ø§Ø´ØªÙ‡ Ø¨Ø§Ø´ÙŠØ¯ Ù…ÙŠØªÙˆÙ†ÙŠØ¯ Ø¨Ø²Ø§Ø±ÙŠØ¯.Ù…Ø«Ù„Ø§Ù‹&zwnj;Ù…Ø§ Ø¯Ø± Ø§ÙŠÙ† Ø¢Ù…ÙˆØ²Ø´ nuke Ø±Ùˆ Ù…ÙŠØ²Ø§Ø±ÙŠÙ….Ù…Ø«Ù„ Ø¹ÙƒØ³ Ø²ÙŠØ±</p>\r\n<p style=\"text-align: center;\">\r\n	<a href=\"http://phpnuke.ir/wikipath/images/lessons/5%20%281%29.jpg\" rel=\"lightbox1\" target=\"_blank\"><img alt=\"\" border=\"0\" height=\"191\" src=\"http://phpnuke.ir/wikipath/images/lessons/5%20%281%29.jpg\" width=\"500\" /></a></p>\r\n<p>\r\n	Ù…Ø­ØªÙˆÙŠØ§Øª Ù†ÙŠÙˆÙƒÙŠ ÙƒÙ‡ Ø¯Ø§Ù†Ù„ÙˆØ¯ ÙƒØ±Ø¯ÙŠØ¯ Ø±Ùˆ ØªÙˆ Ø§ÙŠÙ† Ù¾ÙˆØ´Ù‡ Ù…ÙŠØ±ÙŠØ²ÙŠØ¯.</p>\r\n<p style=\"text-align: center;\">\r\n	<a href=\"http://phpnuke.ir/wikipath/images/lessons/5%20%282%29.jpg\" rel=\"lightbox1\" target=\"_blank\"><img alt=\"\" border=\"0\" height=\"500\" src=\"http://phpnuke.ir/wikipath/images/lessons/5%20%282%29.jpg\" width=\"500\" /></a></p>\r\n<p>\r\n	Ø¨Ø¹Ø¯ Ø§Ø² Ø¢Ù†Ø²ÙŠÙ¾ ÙƒØ§Ù…Ù„ ÙØ§ÙŠÙ„Ù‡Ø§ Ø¨Ù‡ Ø¢Ø¯Ø±Ø³ http://localhost/phpmyadmin Ø¨Ø±ÙŠØ¯.Ø¯Ø± Ø§ÙŠÙ† Ù‚Ø³Ù…Øª Ø´Ù…Ø§ Ù…ÙŠØªÙˆÙ†ÙŠØ¯ Ø¯ÙŠØªØ§Ø¨ÙŠØ³ Ø¨Ø³Ø§Ø²ÙŠØ¯.Ù†Ø§Ù… ÙƒØ§Ø±Ø¨Ø±ÙŠ phpmyadmin Ø¨Ù‡ Ø·ÙˆØ± Ù¾ÙŠØ´ÙØ±Ø¶ root Ù‡Ø³Øª.ÙƒÙ„Ù…Ù‡ Ø¹Ø¨ÙˆØ± Ù‡Ù… ÙƒÙ‡ Ú†ÙŠØ²ÙŠ Ù†ÙŠØ³Øª Ùˆ Ù‡Ø± Ø¬Ø§ Ù„Ø§Ø²Ù… Ø¨ÙˆØ¯ Ø®Ø§Ù„ÙŠ Ù…ÙŠØ²Ø§Ø±ÙŠÙ….</p>\r\n<p>\r\n	Ø§Ù„Ø¨ØªÙ‡ Ø§ÙŠÙ† Ù…ÙˆØ±Ø¯ ÙÙ‚Ø· Ø±ÙˆÙŠ Ù„ÙˆÙƒØ§Ù„ ØµØ¯Ù‚ Ù…ÙŠÙƒÙ†Ù‡ Ùˆ Ø¯Ø± Ù‡Ø§Ø³Øª Ø­ØªÙ…Ø§Ù‹&zwnj;Ø¨Ø§ÙŠØ¯ ÙƒÙ„Ù…Ù‡ Ø¹Ø¨ÙˆØ± Ø±Ùˆ Ø¯Ø§Ø´ØªÙ‡ Ø¨Ø§Ø´ÙŠÙ… ÙƒÙ‡ Ø¨Ø¹Ø¯Ø§Ù‹ Ø¯Ø± Ù…ÙˆØ±Ø¯Ø´ ØµØ­Ø¨Øª Ù…ÙŠÙƒÙ†ÙŠÙ….</p>\r\n<p style=\"text-align: center;\">\r\n	<a href=\"http://phpnuke.ir/wikipath/images/lessons/5%20%284%29.jpg\" rel=\"lightbox1\" target=\"_blank\"><img alt=\"\" border=\"0\" height=\"311\" src=\"http://phpnuke.ir/wikipath/images/lessons/5%20%284%29.jpg\" width=\"500\" /></a></p>\r\n<p>\r\n	Ø¨Ø¹Ø¯ Ø§Ø² ÙˆØ§Ø±Ø¯ ÙƒØ±Ø¯Ù† Ù†Ø§Ù… Ø¯ÙŠØªØ§Ø¨ÙŠØ³ Ø¬Ø¯ÙŠØ¯ Ø¨Ø±Ø§ÙŠ Ù†ÙŠÙˆÙƒ Ø¢Ø¯Ø±Ø³ Ù¾ÙˆØ´Ù‡ Ù…Ø±ÙˆØ¨Ø· Ø¨Ù‡ Ù†ÙŠÙˆÙƒ Ø±Ùˆ ÙˆØ§Ø±Ø¯ ÙƒÙ†ÙŠØ¯.Ø¯Ø± Ø§ÙŠÙ† Ø¢Ù…ÙˆØ²Ø´ http://localhost/nuke Ø¢Ø¯Ø±Ø³ Ù†ÙŠÙˆÙƒ Ù…Ø§ Ø±ÙˆÙŠ localhost Ù‡Ø³Øª.Ùˆ Ø¨Ø¹Ø¯Ø´ Ø±ÙˆÙŠ Ú¯Ø²ÙŠÙ†Ù‡ web installation ÙƒÙ„ÙŠÙƒ ÙƒÙ†ÙŠØ¯.</p>\r\n<p style=\"text-align: center;\">\r\n	<a href=\"http://phpnuke.ir/wikipath/images/lessons/5%20%283%29.jpg\" rel=\"lightbox1\" target=\"_blank\"><img alt=\"\" border=\"0\" height=\"283\" src=\"http://phpnuke.ir/wikipath/images/lessons/5%20%283%29.jpg\" width=\"500\" /></a></p>\r\n<p>\r\n	Ø¯Ø± Ø§ÙŠÙ† Ù‚Ø³Ù…Øª Ø±ÙˆÙŠ Ù‚Ø¨ÙˆÙ„ Ø¯Ø§Ø±Ù… ÙƒÙ„ÙŠÙƒ ÙƒÙ†ÙŠØ¯ Ùˆ Ø¯Ø± Ù…Ø±Ø­Ù„Ù‡ Ø¯ÙˆÙ… Ù…Ø´Ø®ØµØ§Øª Ø¯ÙŠØªØ§Ø¨ÙŠØ³ØªÙˆÙ† Ø±Ùˆ ÙˆØ§Ø±Ø¯ ÙƒÙ†ÙŠØ¯.Ù…Ø¶Ø®ØµØ§Øª Ø·Ø¨Ù‚ Ø¹ÙƒØ³ Ø²ÙŠØ± Ø¨Ø§ÙŠØ¯ ÙˆØ§Ø±Ø¯ Ø¨Ø´Ù‡.Ø¯Ù‚Øª ÙƒÙ†ÙŠØ¯ Ú¯Ø²ÙŠÙ†Ù‡ Ø¢Ø®Ø± Ø¨Ø§ÙŠØ¯ Ø®Ø§Ù„ÙŠ Ø¨Ø§Ø´Ù‡.Ú†ÙˆÙ† ÙˆÙŠ Ù„ÙˆÙƒØ§Ù„ ÙŠÙˆØ²Ø± phpmyadmin Ø±Ù…Ø² Ù†Ø¯Ø§Ø±Ù‡.</p>\r\n<p style=\"text-align: center;\">\r\n	<a href=\"http://phpnuke.ir/wikipath/images/lessons/5%20%285%29.jpg\" rel=\"lightbox1\" target=\"_blank\"><img alt=\"\" border=\"0\" height=\"299\" src=\"http://phpnuke.ir/wikipath/images/lessons/5%20%285%29.jpg\" width=\"500\" /></a></p>\r\n<p>\r\n	Ùˆ Ø¨Ù‡ Ù‡Ù…ÙŠÙ† ØªØ±ØªÙŠØ¨ Ù…Ø±Ø§Ø­Ù„ Ø±Ùˆ Ø§Ø¯Ø§Ù…Ù‡ Ù…ÙŠØ¯ÙŠØ¯ ØªØ§ Ù¾ÙŠØºØ§Ù… Ù†ØµØ¨ Ù…ÙˆÙÙ‚ÙŠØª Ø¢Ù…ÙŠØ² Ø¨ÙŠØ§Ø¯.Ø±ÙˆÙŠ Ù„ÙŠÙ†Ùƒ ÙˆØ±ÙˆØ¯ Ø¨Ù‡ Ù…Ø¯ÙŠØ±ÙŠØª Ø³Ø§ÙŠØª ÙƒÙ„ÙŠÙƒ ÙƒÙ†ÙŠØ¯ ØªØ§ Ø¨Ù‡ Ù…Ø±Ø­Ù„Ù‡ Ø¨Ø¹Ø¯ÙŠ Ù†ØµØ¨ Ø¨Ø±ÙŠÙ….</p>\r\n<p style=\"text-align: center;\">\r\n	<a href=\"http://phpnuke.ir/wikipath/images/lessons/5%20%286%29.jpg\" rel=\"lightbox1\" target=\"_blank\"><img alt=\"\" border=\"0\" height=\"500\" src=\"http://phpnuke.ir/wikipath/images/lessons/5%20%286%29.jpg\" width=\"500\" /></a></p>\r\n<p style=\"text-align: center;\">\r\n	<a href=\"http://phpnuke.ir/wikipath/images/lessons/5%20%287%29.jpg\" rel=\"lightbox1\" target=\"_blank\"><img alt=\"\" border=\"0\" height=\"309\" src=\"http://phpnuke.ir/wikipath/images/lessons/5%20%287%29.jpg\" width=\"500\" /></a></p>\r\n<p>\r\n	Ø¯Ø± Ø§ÙŠÙ† Ù‚Ø³Ù…Øª Ù…Ø´Ø®ØµØ§Øª Ù…Ø¯ÙŠØ± Ø¬Ø¯ÙŠØ¯ Ø±Ùˆ ÙˆØ§Ø±Ø¯ ÙƒÙ†ÙŠØ¯.Ø§ÙŠÙ† Ù…Ø´Ø®ØµØ§Øª Ø¨Ø±Ø§ÙŠ ÙŠÙˆØ²Ø± Ø§ÙˆÙ„ØªÙˆÙ† Ù‡Ù… Ù…ÙˆØ±Ø¯ Ø§Ø³ØªÙØ§Ø¯Ù‡ Ù‚Ø±Ø§Ø± Ù…ÙŠÚ¯ÙŠØ±Ù‡ Ùˆ ÙƒØ§Ø±Ø¨Ø±ÙŠ Ø¯Ù‚ÙŠÙ‚Ø§Ù‹ Ø¨Ø§ Ù‡Ù…ÙŠÙ† Ù†Ø§Ù… Ùˆ ÙƒÙ„Ù…Ù‡ Ø¹Ø¨ÙˆØ± Ø§ÙŠØ¬Ø§Ø¯ Ù…ÙŠØ´Ù‡.</p>\r\n<p style=\"text-align: center;\">\r\n	<a href=\"http://phpnuke.ir/wikipath/images/lessons/5%20%288%29.jpg\" rel=\"lightbox1\" target=\"_blank\"><img alt=\"\" border=\"0\" height=\"218\" src=\"http://phpnuke.ir/wikipath/images/lessons/5%20%288%29.jpg\" width=\"500\" /></a></p>\r\n<p>\r\n	Ø¨Ø¹Ø¯ Ø§Ø² ÙˆØ±ÙˆØ¯ Ø¨Ù‡ Ù…Ø¯ÙŠØ±ÙŠØª Ø¨Ù‡ Ù‚Ø³Ù…Øª ØªÙ†Ø¸ÙŠÙ…Ø§Øª Ø³ÙŠØ³ØªÙ… Ø¨Ø±ÙŠØ¯ Ùˆ Ø§ÙˆÙ„ÙŠÙ† ÙƒØ§Ø±ÙŠ ÙƒÙ‡ Ù…ÙŠÙƒÙ†ÙŠØ¯ Ø¨Ø±Ø§ÙŠ Ù…Ø¯ÙŠØ±ÙŠØª ÙØ§ÙŠÙ„ ÙƒÙ„Ù…Ù‡ Ø¹Ø¨ÙˆØ± Ø§Ù†ØªØ®Ø§Ø¨ Ù…ÙŠÙƒÙ†ÙŠØ¯. http://localhost/nuke/admin.php?op=Configure</p>\r\n<p style=\"text-align: center;\">\r\n	<a href=\"http://phpnuke.ir/wikipath/images/lessons/5%20%289%29.jpg\" rel=\"lightbox1\" target=\"_blank\"><img alt=\"\" border=\"0\" height=\"500\" src=\"http://phpnuke.ir/wikipath/images/lessons/5%20%289%29.jpg\" width=\"500\" /></a></p>\r\n<p>\r\n	Ø­Ø§Ù„Ø§ ØµÙØ­Ù‡ Ø§ÙˆÙ„ Ø³Ø§ÙŠØª Ø±Ùˆ Ø¨Ø§Ø² ÙƒÙ†ÙŠØ¯.Ù…Ù…ÙƒÙ†Ù‡ ÙŠÙƒÙ… Ø·ÙˆÙ„ Ø¨ÙƒØ´Ù‡.Ø§ÙŠÙ† Ø¨Ù‡ Ø®Ø§Ø·Ø± Ø§ÙŠØ¬Ø§Ø¯ Ø±ÙƒÙˆØ±Ø¯Ù‡Ø§ÙŠÙŠ Ø¯Ø± Ø¬Ø¯ÙˆÙ„ Ø¢Ù…Ø§Ø± ÙƒØ§Ø±Ø¨Ø±Ø§Ù† Ù‡Ø³Øª ÙƒÙ‡ ÙÙ‚Ø· Ø¨Ø§Ø± Ø§ÙˆÙ„ Ø§ÙŠÙ† Ø§ØªÙØ§Ù‚ Ù…ÙŠÙØªÙ‡ Ùˆ Ø¯Ø± Ø¯ÙØ¹Ø§Øª Ø¨Ø¹Ø¯ÙŠ ÙˆØ±ÙˆØ¯ Ø¯ÙŠÚ¯Ù‡ Ø§ÙŠÙ† ÙˆÙ‚ÙÙ‡ Ø§ÙŠØ¬Ø§Ø¯ Ù†Ù…ÙŠØ´Ù‡.Ù¾Ø³ Ø´ÙƒÙŠØ¨Ø§ Ø¨Ø§Ø´ÙŠØ¯ Ùˆ Ø§Ø² Ø±ÙØ±Ø´ ÙƒØ±Ø¯Ù† Ùˆ Ù…ÙˆØ§Ø±Ø¯ Ø§ÙŠÙ†Ú†Ù†ÙŠÙ†ÙŠ Ù¾Ø±Ù‡ÙŠØ² ÙƒÙ†ÙŠØ¯. http://localhost/nuke/index.php</p>\r\n<p>\r\n	Ø¯Ø± Ø§Ù†ØªÙ‡Ø§ Ø¨Ø§ ØªÙˆØ¬Ù‡ Ø¨Ù‡ Ø§ÛŒÙ†Ú©Ù‡ Ø´Ù…Ø§ Ù†ÛŒÙˆÚ© Ø±Ø§ Ø¯Ø± Ø±ÙˆØª Ù†Ø±ÛŒØ®ØªÙ‡ Ø§ÛŒØ¯ Ùˆ Ø¯Ø± Ù¾ÙˆØ´Ù‡ nuke Ù†ØµØ¨ Ú©Ø±Ø¯Ù‡ Ø§ÛŒØ¯ Ùˆ Ø¢Ø¯Ø±Ø³Ø´ Ø³Ø§ÛŒØª Ø´Ù…Ø§ http://localhost/nuke/index.php Ù…ÛŒØ¨Ø§Ø´Ø¯. Ø¨Ø§ÛŒØ¯ ÙØ§ÛŒÙ„ .htaccess Ø±Ø§ ØªÙ†Ø¸ÛŒÙ… Ú©Ù†ÛŒØ¯.</p>\r\n<p>\r\n	Ø§ÛŒÙ† ÙØ§ÛŒÙ„ Ø±Ø§ Ø¯Ø± Ø±ÙˆØª Ù†ÛŒÙˆÚ©ØªÙˆÙ† Ø¨Ø§Ø² Ú©Ù†ÛŒØ¯ Ùˆ Ø§ÛŒÙ† Ø®Ø· Ø±Ø§ Ù¾ÛŒØ¯Ø§ Ú©Ù†ÛŒØ¯ :</p>\r\n<div align=\"left\" dir=\"ltr\">\r\n	RewriteBase /</div>\r\n<p>\r\n	Ø¨Ù‡ Ø§ÛŒÙ† Ø®Ø· ØªØºÛŒÛŒØ±Ø´ Ø¨Ø¯ÛŒØ¯ :</p>\r\n<div align=\"left\" dir=\"ltr\">\r\n	RewriteBase /nuke/</div>\r\n<p>\r\n	&nbsp;</p>\r\n<p>\r\n	ØªØ¨Ø±ÙŠÙƒ.Ù†ÙŠÙˆÙƒ Ø´Ù…Ø§ Ø¨Ø§ Ù…ÙˆÙÙ‚ÙŠØª Ù†ØµØ¨ Ø´Ø¯.</p>\r\n', 'how,to,install', 1, 0),
(5, 2, 'how-localhost-and-how-install-in-to', 'localhost Ú†ÙŠØ³Øª Ùˆ Ú†Ú¯ÙˆÙ†Ù‡ Ø¢Ù† Ø±Ø§ Ù†ØµØ¨ ÙƒÙ†Ù…', '<p>\r\n	Ø¨Ø±Ø§ÙŠ Ù†ØµØ¨ Ù†ÙŠÙˆÙƒ Ø¨Ø§ÙŠØ¯ Ø­ØªÙ…Ø§Ù‹ Ø§Ø¨ØªØ¯Ø§ Ù†ÙŠÙˆÙƒ Ø±Ùˆ Ø±ÙˆÙŠ localhost Ù†ØµØ¨ ÙƒØ±Ø¯.localhost ÙŠØ§ Ù‡Ø§Ø³Øª Ù…Ø­Ù„ÙŠ ØŒ&zwnj; Ø¨Ø±Ø§ÙŠ Ø´Ù…Ø§ ÙƒØ§Ø± Ø³Ø±ÙˆØ± Ø±Ùˆ Ù…ÙŠÙƒÙ†Ù‡ Ù…Ù†ØªÙ‡Ø§ ØªÙˆ Ø®ÙˆØ¯ Ø³ÙŠØ³ØªÙ… ÙŠØ§ Ø±Ø§ÙŠØ§Ù†ØªÙˆÙ†.Ù…Ø·Ù…Ø¦Ù†Ø§Ù‹ Ù…Ù‚Ø§Ù„Ø§Øª Ø²ÙŠØ§Ø¯ÙŠ Ø¯Ø± Ù…ÙˆØ±Ø¯ localhost ÙˆØ¬ÙˆØ¯ Ø¯Ø§Ø±Ù‡ ÙƒÙ‡ Ù…ÙŠØªÙˆÙ†ÙŠØ¯ Ø¬Ø³ØªØ¬Ùˆ. ÙƒÙ†ÙŠØ¯.Ù…Ø§ Ø§ÙŠÙ†Ø¬Ø§ Ø¨Ù‡ Ø·ÙˆØ± Ø®ÙŠÙ„ÙŠ Ø³Ø§Ø¯Ù‡ Ø¢Ù…ÙˆØ²Ø´ Ø§Ø³ØªÙØ§Ø¯Ù‡ Ø§Ø² Ø§ÙŠÙ† Ù‚Ø§Ø¨Ù„ÙŠØª Ø±Ùˆ Ø§Ø±Ø§Ø¦Ù‡ Ù…ÙŠØ¯ÙŠÙ….</p>\r\n<p>\r\n	Ø¨Ø±Ø§ÙŠ Ø§Ø³ØªÙØ§Ø¯Ù‡ Ø§Ø² localhost Ù†ÙŠØ§Ø² Ø¨Ù‡ Ù†Ø±Ù… Ø§ÙØ²Ø§Ø±Ù‡Ø§ÙŠ Ù…Ø¯ÙŠØ±ÙŠØª ÙˆØ¨ Ø³Ø±ÙˆØ± Ø¯Ø§Ø±ÙŠÙ….ÙŠÙƒÙŠ Ø§Ø² Ø§ÙŠÙ† Ù†Ø±Ù… Ø§ÙØ²Ø§Ø±Ù‡Ø§ÙŠ ÙƒÙ‡ Ø®ÙŠÙ„ÙŠ Ù‡Ù… Ù…Ø­Ø¨ÙˆØ¨ Ùˆ ÙƒØ§Ø±Ø¨Ø±Ø¯ÙŠ Ùˆ ÙƒØ§Ù…Ù„ Ù‡Ø³Øª Ù†Ø±Ù… Ø§ÙØ²Ø§Ø± Ù…Ø¯ÙŠØ±ÙŠØª ÙˆØ¨ Ø³Ø±ÙˆØ± Ø®Ø§Ù†Ú¯ÙŠ xampp Ù‡Ø³Øª ÙƒÙ‡ Ø¢Ø®Ø±ÙŠÙ† ÙˆØ±&zwj;Ù† Ø§ÙŠÙ† Ù†Ø±Ù… Ø§ÙØ²Ø§Ø± Ø±Ùˆ Ù…ÙŠØªÙˆÙ†ÙŠØ¯ Ø§Ø² Ø§ÙŠÙ†Ø¬Ø§ Ø¯Ø±ÙŠØ§ÙØª ÙƒÙ†ÙŠØ¯.</p>\r\n<h2>\r\n	<a href=\"http://www.apachefriends.org/en/xampp-linux.html\"> XAMPP for Linux </a></h2>\r\n<h2>\r\n	<a href=\"http://www.apachefriends.org/en/xampp-windows.html\"> XAMPP for Windows </a></h2>\r\n<h2>\r\n	<a href=\"http://www.apachefriends.org/en/xampp-macosx.html\"> XAMPP for Mac OS X </a></h2>\r\n<h2>\r\n	<a href=\"http://www.apachefriends.org/en/xampp-solaris.html\"> XAMPP for Solaris </a></h2>\r\n<p>\r\n	Ø¨Ù†Ø§ Ø¨Ù‡ Ù†ÙŠØ§Ø²ØªÙˆÙ† Ù…ÙŠØªÙˆÙ†ÙŠØ¯ Ù‡Ø± ÙƒØ¯ÙˆÙ… Ø§Ø² Ø§ÙŠÙ† Ù¾ÙƒÙŠØ¬Ù‡Ø§ Ø±Ùˆ Ø¯Ø§Ù†Ù„ÙˆØ¯ ÙƒÙ†ÙŠØ¯.Ø¨Ù‡ Ø®Ø§Ø·Ø± Ø§Ø³ØªÙØ§Ø¯Ù‡ Ø¨ÙŠØ´ØªØ± ÙƒØ§Ø±Ø¨Ø±Ø§Ù† ÙˆÙŠÙ†Ø¯ÙˆØ² Ù…Ø§ Ø§ÙŠÙ†Ø¬Ø§ ÙÙ‚Ø· Ø¢Ù…ÙˆØ²Ø´ Ù†ØµØ¨ xampp Ø±Ùˆ Ø±ÙˆÙŠ ÙˆÙŠÙ†Ø¯ÙˆØ² Ù…ÙŠØ²Ø§Ø±ÙŠÙ….</p>\r\n<p>\r\n	Ø¨Ø¹Ø¯ Ø§Ø² Ø¯Ø§Ù†Ù„ÙˆØ¯ ÙØ§ÙŠÙ„ Ù†ØµØ¨ Ø±Ùˆ Ø§Ø¬Ø±Ø§ ÙƒÙ†ÙŠØ¯ Ùˆ Ø·Ø¨Ù‚ Ø¹ÙƒØ³Ù‡Ø§ÙŠ Ø²ÙŠØ± Ù¾ÙŠØ´ Ø¨Ø±ÙŠØ¯.</p>\r\n<p style=\"text-align: center;\">\r\n	<a href=\"http://phpnuke.ir/wikipath/images/lessons/4%20%281%29.jpg\" rel=\"lightbox1\" target=\"_blank\"><img alt=\"\" border=\"0\" height=\"218\" src=\"http://phpnuke.ir/wikipath/images/lessons/4%20%281%29.jpg\" width=\"500\" /></a></p>\r\n<p>\r\n	Ù…Ø±Ø§Ø­Ù„ Ù†ØµØ¨ Ø±Ùˆ Ø¨Ù‡ Ø¯Ù‚Øª Ø¨Ø§ ØªÙˆØ¬Ù‡ Ø¨Ù‡ Ø¹ÙƒØ³Ù‡Ø§ÙŠÙŠ ÙƒÙ‡ Ú¯Ø°Ø§Ø´ØªÙ‡ Ù…ÙŠØ´Ù‡ Ø§Ø¯Ø§Ù…Ù‡ Ø¨Ø¯ÙŠØ¯.</p>\r\n<p style=\"text-align: center;\">\r\n	<a href=\"http://phpnuke.ir/wikipath/images/lessons/4%20%282%29.jpg\" rel=\"lightbox1\" target=\"_blank\"><img alt=\"\" border=\"0\" height=\"500\" src=\"http://phpnuke.ir/wikipath/images/lessons/4%20%282%29.jpg\" width=\"500\" /></a></p>\r\n<p>\r\n	&nbsp;</p>\r\n<p>\r\n	Ø¯Ø± Ø§ÙŠÙ† Ù‚Ø³Ù…Øª Ø¯Ùˆ ØªÙŠÙƒ Ù…Ø±Ø¨ÙˆØ· Ø¨Ù‡ Ù†ØµØ¨ Apache Ùˆ MySql&nbsp; Ø±Ùˆ Ø¹Ù„Ø§Ù…Øª Ø¯Ø§Ø± ÙƒÙ†ÙŠØ¯ Ùˆ Ø§Ø¯Ø§Ù…Ù‡ Ø¨Ø¯ÙŠØ¯.</p>\r\n<p style=\"text-align: center;\">\r\n	<a href=\"http://phpnuke.ir/wikipath/images/lessons/4%20%284%29.jpg\" rel=\"lightbox1\" target=\"_blank\"><img alt=\"\" border=\"0\" height=\"500\" src=\"http://phpnuke.ir/wikipath/images/lessons/4%20%284%29.jpg\" width=\"500\" /></a></p>\r\n<p style=\"text-align: center;\">\r\n	<a href=\"http://phpnuke.ir/wikipath/images/lessons/4%20%285%29.jpg\" rel=\"lightbox1\" target=\"_blank\"><img alt=\"\" border=\"0\" height=\"500\" src=\"http://phpnuke.ir/wikipath/images/lessons/4%20%285%29.jpg\" width=\"500\" /></a></p>\r\n<p style=\"text-align: center;\">\r\n	<a href=\"http://phpnuke.ir/wikipath/images/lessons/4%20%286%29.jpg\" rel=\"lightbox1\" target=\"_blank\"><img alt=\"\" border=\"0\" height=\"500\" src=\"http://phpnuke.ir/wikipath/images/lessons/4%20%286%29.jpg\" width=\"500\" /></a></p>\r\n<p>\r\n	Ø§Ú¯Ø± Ù‡Ù…Ù‡ Ù…Ø±Ø§Ø­Ù„ Ù…Ø«Ù„ Ø¹ÙƒØ³Ù‡Ø§ÙŠ Ø¨Ø§Ù„Ø§ Ø¨ÙˆØ¯ Ù…Ø±ÙˆØ±Ú¯Ø± Ø±Ùˆ Ø¨Ø§Ø² ÙƒÙ†ÙŠØ¯ Ùˆ Ø¢Ø¯Ø±Ø³ http://localhost Ø±Ùˆ ÙˆØ§Ø±Ø¯ ÙƒÙ†ÙŠØ¯.Ù…Ø«Ù„ Ø¹ÙƒØ³ Ø²ÙŠØ±</p>\r\n<p style=\"text-align: center;\">\r\n	<a href=\"http://phpnuke.ir/wikipath/images/lessons/4%20%287%29.jpg\" rel=\"lightbox1\" target=\"_blank\"><img alt=\"\" border=\"0\" height=\"150\" src=\"http://phpnuke.ir/wikipath/images/lessons/4%20%287%29.jpg\" width=\"500\" /></a></p>\r\n<p>\r\n	Ù†ØªÙŠØ¬Ù‡ Ø¨Ø§ÙŠØ¯ Ù…Ø«Ù„ Ø¹ÙƒØ³ Ø²ÙŠØ± Ø¨Ø§Ø´Ù‡</p>\r\n<p style=\"text-align: center;\">\r\n	<a href=\"http://phpnuke.ir/wikipath/images/lessons/4%20%288%29.jpg\" rel=\"lightbox1\" target=\"_blank\"><img alt=\"\" border=\"0\" height=\"213\" src=\"http://phpnuke.ir/wikipath/images/lessons/4%20%288%29.jpg\" width=\"500\" /></a></p>\r\n<p>\r\n	Ø¯Ø± ØµÙˆØ±ØªÙŠ ÙƒÙ‡ Ø§ÙŠÙ† Ù…Ø±Ø§Ø­Ù„ Ø¨Ù‡ Ø¯Ø±Ø³ØªÙŠ Ø§Ù†Ø¬Ø§Ù… Ø´Ø¯Ù‡ Ø¨Ø§Ø´Ù‡ Ù†Ø±Ù… Ø§ÙØ²Ø§Ø± Ù…Ø¯ÙŠØ±ÙŠØª ÙˆØ¨ Ø³Ø±ÙˆØ± Ø®Ø§Ù†Ú¯ÙŠ Ø´Ù…Ø§ Ù†ØµØ¨ Ùˆ Ø¯Ø± Ø­Ø§Ù„ Ø§Ø¬Ø±Ø§Ø³Øª.Ø§ÙŠÙ† Ù†Ø±Ù… Ø§ÙØ²Ø§Ø± Ø¯Ø± Ù‡Ø± Ø¨Ø§Ø± Ø±ÙˆØ´Ù†&nbsp; ÙƒØ±Ø¯Ù† Ø³ÙŠØ³ØªÙ… Ù‡Ù… ÙØ¹Ø§Ù„Ù‡ Ùˆ Ù†ÙŠØ§Ø²ÙŠ Ø¨Ù‡ ÙØ¹Ø§Ù„Ø³Ø§Ø²ÙŠ Ø§ÙˆÙ† Ù†ÙŠØ³Øª.</p>\r\n', 'how-localhost,how-install-in-to', 1, 0),
(6, 1, 'train-HTML', 'Ø¢Ù…ÙˆØ²Ø´Ù‡Ø§ÛŒ HTML', '<p>\r\n	Ø¢Ù…ÙˆØ²Ø´Ù‡Ø§ÛŒ HTML</p>\r\n<p>\r\n	Ù…Ù†Ø¨Ø¹ Ø§Ø² w3-school</p>\r\n', 'train,HTML', 0, 0),
(7, 6, 'Part1', 'Ù‚Ø³Ù…Øª Ø§ÙˆÙ„', '<p>\r\n	<span style=\"color:darkred;\">Ø¨Ø®Ø´ Ø§ÙˆÙ„ ----------------------</span><br />\r\n	<br />\r\n	<br />\r\n	<span style=\"color:red;\">ÙÙ‡Ø±Ø³Øª::::::::::</span><br />\r\n	<br />\r\n	ØªÚ¯ Ú†ÙŠØ³ØªØŸ / Ú†Ù‡ Ú†ÙŠØ²ÙŠ Ø§Ø­ØªÙŠØ§Ø¬ Ø¯Ø§Ø±ÙŠÙ… ØŸ / Ø³Ø§Ø®Øª Ø§ÙˆÙ„ÙŠÙ† ØµÙØ­Ù‡ ÙˆØ¨ / html ÙŠØ§ htm / Ø³Ø±ÙØµÙ„ Ùˆ ÙŠØ§ Head line / Ù¾Ø§Ø±Ø§Ú¯Ø±Ø§Ù / Ù¾ÙŠÙˆÙ†Ø¯ Ùˆ ÙŠØ§ Ù„ÙŠÙ†Ú© Ù‡Ø§ / ØªØµØ§ÙˆÙŠØ± / Ø¹Ù†Ø§ØµØ± HTML / ØªÚ¯ Ù‡Ø§ÙŠ HTML ØªÙˆ Ø¯Ø± ØªÙˆ / ØªÚ¯Ù‡Ø§ÙŠ Ù¾Ø§ÙŠØ§Ù†ÙŠ Ø±Ø§ ÙØ±Ø§Ù…ÙˆØ´ Ù†Ú©Ù†ÙŠØ¯ / Ø¹Ù†Ø§ØµØ± HTML Ø­Ø±Ù Ø¨Ø²Ø±Ú¯ ÙŠØ§ Ú©ÙˆÚ†Ú©<br />\r\n	<br />\r\n	------------------------------------------------------------------------------------------------------------------------------------------<br />\r\n	<span style=\"color:green;\">ØªÚ¯ Ú†ÙŠØ³ØªØŸ</span><br />\r\n	ØªÚ¯Ù‡Ø§ Ú©Ù„Ù…Ø§ØªÙŠ Ù‡Ø³ØªÙ†Ø¯ Ú©Ù‡ Ø¨Ù‡ ÙˆØ³ÙŠÙ„Ù‡ ÙŠÚ© Ø¬ÙØª Ø¹Ù„Ø§Ù…Øª &lt;&gt; Ø§Ø­Ø§Ø·Ù‡ Ø´Ø¯Ù‡ Ø§Ù†Ø¯ Ù…Ø§Ù†Ù†Ø¯Ù‡ &lt;html&gt; Ùˆ Ù…Ø¹Ù…ÙˆÙ„Ø§ Ø¨Ù‡ ØµÙˆØ±Øª ÙŠÚ© Ø¬ÙØª Ù…ÙŠØ¨Ø§Ø´Ù†Ø¯<br />\r\n	Ù…Ø§Ù†Ù†Ø¯Ù‡ &lt;b&gt; Ùˆ &lt;b/&gt;<br />\r\n	Ø§ÙˆÙ„ÙŠÙ† ØªÚ¯ ( ØªÚ¯ Ø§Ø¨ØªØ¯Ø§ÙŠÙŠ) Ùˆ Ø¯ÙˆÙ…ÙŠÙ† ØªÚ¯ (ØªÚ¯ Ø§Ù†ØªÙ‡Ø§ÙŠÙŠ ) Ù†Ø§Ù…ÙŠØ¯Ù‡ Ù…ÙŠØ´ÙˆØ¯ . ØªÚ¯ Ø§Ø¨ØªØ¯Ø§ÙŠÙŠ ØªÚ¯ Ø´Ø±ÙˆØ¹ Ùˆ ÙŠØ§ ØªÚ¯ Ø¨Ø§Ø² Ùˆ ØªÚ¯ Ø§Ù†ØªÙ‡Ø§ÙŠÙŠ ØªÚ¯ Ù¾Ø§ÙŠØ§Ù†ÙŠ Ùˆ ÙŠØ§ ØªÚ¯ Ø¨Ø³ØªÙ‡ Ù†ÙŠØ² Ù†Ø§Ù…ÙŠØ¯Ù‡ Ù…ÙŠØ´ÙˆØ¯<br />\r\n	<br />\r\n	Ù…Ù†Ø¸ÙˆØ± Ø§Ø² ÙŠÚ© Ù…Ø±ÙˆØ±Ú¯Ø± ÙˆØ¨ Ù…Ø§Ù†Ù†Ø¯ internet explorer Ùˆ firefox ÙˆØ³ÙŠÙ„Ù‡ Ø§ÙŠØ³Øª Ø¨Ø±Ø§ÙŠ Ø®ÙˆØ§Ù†Ø¯Ù† Ú©Ø¯ Ù‡Ø§ÙŠ HTML Ùˆ ØªØ±Ø¬Ù…Ù‡ Ùˆ Ù†Ù…Ø§ÙŠØ´ Ø¢Ù†Ù‡Ø§ Ø¨Ù‡ ØµÙˆØ±Øª ØµÙØ­Ø§Øª ÙˆØ¨ . ÙŠÚ© Ù…Ø±ÙˆØ±Ú¯Ø± ØªÚ¯ Ù‡Ø§ Ø±Ø§ Ù†Ø´Ø§Ù† Ù†Ù…ÙŠ Ø¯Ù‡Ø¯ Ø¨Ù„Ú©Ù‡ Ø§Ù†Ù‡Ø§ ØµÙØ­Ù‡ ÙˆØ¨ Ø§Ø³ØªÙØ§Ø¯Ù‡ Ù…ÙŠÚ©Ù†Ø¯<br />\r\n	<br />\r\n	Ø¯Ø± Ø²ÙŠØ± Ù…ÙŠØªÙˆØ§Ù†ÙŠØ¯ Ù†Ù…ÙˆÙ†Ù‡ Ø§ÙŠ Ø§Ø² Ú©Ø¯ Ù‡Ø§ÙŠ HTML Ø±Ø§ Ø¨Ø¨ÙŠÙ†ÙŠØ¯ :</p>\r\n<p dir=\"ltr\">\r\n	<code style=\"direction:ltr;text-align:left;\">&lt;html&gt;<br />\r\n	&lt;body&gt;<br />\r\n	&lt;h1&gt; phpnuke &lt;/h1&gt;<br />\r\n	&lt;p&gt; Ù…Ø±Ø¬Ø¹ Ù†ÙŠÙˆÚ© Ø§ÙŠØ±Ø§Ù† &lt;/p&gt;<br />\r\n	&lt;/body&gt;<br />\r\n	&lt;/html&gt;</code><br />\r\n	&nbsp;</p>\r\n<p>\r\n	Ù…ØªÙ† Ø¨ÙŠÙ† &lt;html&gt;Ùˆ &lt;html/&gt; ØµÙØ­Ù‡ ÙˆØ¨ Ø±Ø§ Ù…Ø´Ø®Øµ Ù…ÙŠÚ©Ù†Ø¯ Ùˆ Ù…ØªÙ† &lt;body&gt; Ùˆ &lt;body/&gt; Ù‚Ø³Ù…Øª Ù‚Ø§Ø¨Ù„ Ø±ÙˆØª ÙŠÚ© ØµÙØ­Ù‡ ÙˆØ¨ Ø±Ø§ Ù†Ø´Ø§Ù† Ù…ÙŠØ¯Ù‡Ø¯ . Ù…ØªÙ† Ø¨ÙŠÙ† &lt;h1&gt; Ùˆ &lt;h1/&gt; Ø¨Ù‡ ØµÙˆØ±Øª ÙŠÚ© Ø³Ø± ÙØµÙ„ Ù†Ù…Ø§ÙŠØ´ Ø¯Ø§Ø¯Ù‡ Ù…Ø´ÙˆØ¯ Ùˆ Ù…ØªÙ† Ø¨ÙŠÙ† &lt;p&gt; Ùˆ &lt;p/&gt; Ø¨Ù‡ ØµÙˆØ±Øª ÙŠÚ© Ù¾Ø§Ø±Ø§Ú¯Ø±Ø§Ù Ù†Ù…Ø§ÙŠØ´ Ø¯Ø§Ø¯Ù‡ Ù…ÙŠØ´ÙˆØ¯<br />\r\n	<br />\r\n	<span style=\"color:green;\">Ú†Ù‡ Ú†ÙŠØ²ÙŠ Ø§Ø­ØªÙŠØ§Ø¬ Ø¯Ø§Ø±ÙŠÙ… ØŸ</span><br />\r\n	<br />\r\n	Ø´Ù…Ø§ Ø¨Ø±Ø§ÙŠ ÙŠØ§Ø¯Ú¯ÙŠØ±ÙŠ HTML Ø§Ø­ØªÙŠØ§Ø¬ Ø¨Ù‡ Ù‡ÙŠÚ† Ù†Ø±Ù… Ø§ÙØ²Ø± Ù¾ÙŠÚ†ÙŠØ¯Ù‡ Ø§ÙŠ Ù†Ø¯Ø§Ø±ÙŠØ¯ Ø¯Ø± Ø§ÙŠÙ† Ø®ÙˆØ¯ Ø¢Ù…ÙˆØ² Ù…Ø§ Ø§Ø² Ù†Ø±Ù… Ø§ÙØ²Ø± notepad Ù…ÙˆØ¬ÙˆØ¯ Ø¯Ø± windows Ø¨Ø±Ø§ÙŠ Ù†ÙˆØ´ØªÙ† Ùˆ ÙˆÙŠØ±Ø§ÙŠØ´ Ú©Ø¯ Ù‡Ø§ÙŠ HTML Ø§Ø³ØªÙØ§Ø¯Ù‡ Ù…ÙŠÚ©Ù†ÙŠÙ… Ùˆ Ø§Ø¹ØªÙ‚Ø§Ø¯ Ø¯Ø§Ø±ÙŠÙ… Ú©Ù‡ Ø§ÙŠÙ† Ø¨Ù‡ØªØ±ÙŠÙ† Ø±Ø§Ù‡ Ø¨Ø±Ø§ÙŠ ÙŠØ§Ø¯ Ú¯ÙŠØ±ÙŠ HTML Ù…ÙŠØ¨Ø§Ø´Ø¯<br />\r\n	<br />\r\n	Ú©Ø¯ Ù†ÙˆÙŠØ³Ø§Ù† Ø­Ø±ÙÙ‡ Ø§ÙŠ Ø§Ø² Ù†Ø±Ù… Ø§ÙØ²Ø§Ø± Ù‡Ø§ÙŠ front page Ùˆ dream weaver Ùˆ notepad++&nbsp;&nbsp;Ø¨Ø±Ø§ÙŠ ØªÙˆÙ„ÙŠØ¯ ØµÙØ­Ø§Øª ÙˆØ¨ Ø§Ø³ØªÙØ§Ø¯Ù‡ Ù…ÙŠÚ©Ù†Ù†<br />\r\n	<span style=\"color:green;\">Ø³Ø§Ø®Øª Ø§ÙˆÙ„ÙŠÙ† ØµÙØ­Ù‡ ÙˆØ¨ </span><br />\r\n	Ø¨Ø±Ø§ÙŠ Ø´Ø±ÙˆØ¹ Ø´Ù…Ø§ Ù†Ø±Ù… Ø§ÙØ²Ø§Ø± notepad Ø®ÙˆØ¯ Ø±Ø§ Ø§Ø² Ø§Ø¯Ø±Ø³ accessories&lt;program&lt;start Ø¨Ø§Ø² Ú©Ù†ÙŠØ¯ Ùˆ Ù…ØªÙ† Ø²ÙŠØ± Ø±Ø§ Ø¯Ø±ÙˆÙ† Ø¢Ù† Ø¨Ù†ÙˆÙŠØ³ÙŠØ¯<br />\r\n	<br />\r\n	<span style=\"color:red;\">ØªØ°Ú©Ø± Ø®ÙŠÙ„ÙŠ Ù…Ù‡Ù…::: Ø§Ú¯Ø± Ù…ÙŠØ®ÙˆØ§ÙŠ HTML ÙŠØ§Ø¯ Ø¨Ú¯ÙŠØ±ÙŠ Ù…ØªÙ† Ø²ÙŠØ± Ú©Ù¾ÙŠ Ù†Ú©Ù† ØªØ§ÙŠÙ¾ Ú©Ù† Ø®ÙˆØ¯Øª Ø§Ú¯Ø± Ù…ÙŠØ®ÙˆØ§ÙŠ Ú©Ù¾ÙŠ Ú©Ù†ÙŠ ØªØ§ 20 Ø³Ø§Ù„ Ø¯ÙŠÚ¯Ù‡ Ù‡Ù… ÙŠØ§Ø¯ Ù†Ù…ÙŠÚ¯ÙŠØ±ÙŠ </span><br />\r\n	================================================== =====================</p>\r\n<br />\r\n<p dir=\"ltr\">\r\n	<code style=\"direction:ltr;text-align:left;\">&lt;html&gt;<br />\r\n	&nbsp;&nbsp;&nbsp;&nbsp;&lt;body&gt;<br />\r\n	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&lt;h1&gt; this is my main page&lt;/h1&gt;<br />\r\n	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&lt;p&gt;this is some test &lt;/p&gt;<br />\r\n	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&lt;p&gt;&lt;a href=&quot;http://phpnuke.ir&quot;&gt;php nuke&lt;/a&gt;&lt;/p&gt;<br />\r\n	&nbsp;&nbsp;&nbsp;&nbsp;&lt;/body&gt;<br />\r\n	&lt;/html&gt;</code></p>\r\n<p>\r\n	<br />\r\n	<br />\r\n	Ù¾Ø³ Ø§Ø² Ø§ØªÙ…Ø§Ù… ØŒ Ù†ÙˆØ´ØªÙ‡ Ù…ÙˆØ±Ø¯ Ù†Ø¸Ø± Ø®ÙˆØ¯ Ø±Ø§ Ø¨Ø§ Ù¾Ø³ÙˆÙ†Ø¯ Ù‡Ø§ÙŠ htm Ùˆ ÙŠØ§ HTML Ø¨Ø§ Ù†Ø§Ù…phpnuke page1 Ø°Ø®ÙŠØ±Ù‡ Ú©Ù†ÙŠØ¯<br />\r\n	<br />\r\n	Ø§ÙŠÙ† Ø§ÙˆÙ„ÙŠÙ† ØµÙØ­Ù‡ ÙˆØ¨ Ø³Ø§Ø®ØªÙ‡ Ø´Ø¯Ù‡ ØªÙˆØ³Ø· Ø´Ù…Ø§ Ø§Ø³Øª .<br />\r\n	<br />\r\n	<strong><span style=\"color:#ff0000;\">Ù¾Ø§Ø¨Ø§Ù† Ù‚Ø³Ù…Øª Ø§ÙˆÙ„</span></strong></p>\r\n', 'train,HTML,part1', 0, 0),
(8, 6, 'Part2', 'Ù‚Ø³Ù…Øª Ø¯ÙˆÙ…', '<p>\r\n	<span style=\"color:darkred;\">Ø§Ø¯Ø§Ù…Ù‡ Ø¨Ø®Ø´ Ø§ÙˆÙ„....................</span><br />\r\n	<br />\r\n	<span style=\"color:seagreen;\">htm ÙŠØ§ html ØŸ</span><br />\r\n	<br />\r\n	Ø¨Ø±Ø§ÙŠ Ø°Ø®ÙŠØ±Ù‡ ÙŠÚ© ØµÙØ­Ù‡ ÙˆØ¨ Ø´Ù…Ø§ Ø¨Ø§ÙŠØ¯ ÙŠÚ©ÙŠ Ø§Ø² Ø§ÙŠÙ† Ù¾Ø³ÙˆÙ†Ø¯ Ù‡Ø§ Ø±Ø§ Ø§Ù†ØªØ®Ø§Ø¨ Ú©Ù†ÙŠØ¯ htm.html<br />\r\n	<br />\r\n	Ø¯Ø± Ø¹Ù…Ù„ Ø§ÙŠÙ† Ø¯Ùˆ Ù¾Ø³ÙˆÙ†Ø¯ ØªÙØ§ÙˆØªÙŠ Ø¨Ø§ Ù‡Ù… Ù†Ø¯Ø§Ø±Ù†Ø¯ . htm ÙŠÚ© Ù¾Ø³ÙˆÙ†Ø¯ Ù‚Ø¯ÙŠÙ…ÙŠØ³Øª Ùˆ Ù…Ø±Ø¨ÙˆØ· Ø¨Ù‡ Ø²Ù…Ø§Ù†ÙŠ Ø§Ø³Øª Ú©Ù‡ Ù¾Ø³ÙˆÙ†Ø¯ Ù‡Ø§ Ø§Ø² 3 Ø­Ø±Ù ØªØ´Ú©ÙŠÙ„ Ù…ÙŠØ´ÙˆÙ†Ø¯ ÙˆÙ„ÙŠ Ø§Ù…Ø±ÙˆØ²Ù‡ Ø¨Ù‡ØªØ± Ø§Ø³Øª Ø§Ø² Ù¾Ø³ÙˆÙ†Ø¯ html Ø§Ø³ØªÙØ§Ø¯Ù‡ Ú©Ù†ÙŠÙ…<br />\r\n	<br />\r\n	Ø§Ú¯Ø± Ø§Ø­ØªÙ…Ø§Ù„Ø§ Ù…Ø·Ø§Ù„Ø¨ÙŠ Ú©Ù‡ ØªØ§ Ú©Ù†ÙˆÙ† Ø¨Ø±Ø§ÙŠ Ø´Ù…Ø§ Ú¯ÙØªÙ‡ Ø´Ø¯Ù‡ Ù…Ø¨Ù‡Ù… Ø¨ÙˆØ¯Ù‡ Ø§Ø³Øª Ø§Ø­Ø³Ø§Ø³ Ù†Ú¯Ø±Ø§Ù†ÙŠ Ù†Ú©Ù†ÙŠØ¯ Ø²ÙŠØ±Ø§ Ø¯Ø± Ù‚Ø³Ù…Øª Ù‡Ø§ÙŠ Ø¨Ø¹Ø¯ÙŠ ØªÙˆØ¶ÙŠØ­Ø§Øª Ø¨ÙŠØ´ØªØ±ÙŠ Ø®ÙˆØ§Ù‡ÙŠÙ… Ø¯Ø§Ø´Øª<br />\r\n	<br />\r\n	Ø¨Ø±Ø§ÙŠ ÙŠØ§Ø¯ Ú¯ÙŠØ±ÙŠ Ø¨Ù‡ØªØ± Ø§Ø² Ú†Ù†Ø¯ÙŠÙ† Ù…Ø«Ø§Ù„ Ø§Ø³ØªÙØ§Ø¯Ù‡ Ù…ÙŠÚ©Ù†ÙŠÙ…<br />\r\n	<br />\r\n	<br />\r\n	<span style=\"color:green;\">Ø³Ø±ÙØµÙ„ Ùˆ ÙŠØ§ head line</span><br />\r\n	<br />\r\n	&nbsp;</p>\r\n<p dir=\"ltr\">\r\n	<code style=\"direction:ltr;text-align:left;\">&lt;html&gt;<br />\r\n	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &lt;body&gt;<br />\r\n	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &lt;h1&gt; this is heading &lt;/h1&gt;<br />\r\n	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &lt;h2&gt; this is heading &lt;/h2&gt;<br />\r\n	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &lt;h3&gt; this is heading &lt;/h3&gt;<br />\r\n	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &lt;/body&gt;<br />\r\n	&lt;/html&gt;</code></p>\r\n<br />\r\n<br />\r\n<br />\r\n<br />\r\n<p>\r\n	Ø³Ø±ÙØµÙ„Ù‡Ø§ ØªÙˆØ³Ø· ØªÚ¯ Ù‡Ø§ÙŠ &lt;h1&gt; ØªØ§ &lt;h6&gt; Ø¹Ù„Ø§Ù…Øª Ú¯Ø°Ø§Ø±ÙŠ Ù…ÙŠØ´ÙˆØ¯<br />\r\n	<br />\r\n	<span style=\"color:green;\">Ù¾Ø§Ø±Ø§Ú¯Ø±Ø§Ù</span></p>\r\n<br />\r\n<div align=\"LEFT\">\r\n	<p dir=\"ltr\">\r\n		<code style=\"direction:ltr;text-align:left;\">&lt;p&gt; this is heading &lt;/p&gt;<br />\r\n		<br />\r\n		&lt;p&gt; this is heading test&lt;/p&gt;<br />\r\n		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</code></p>\r\n</div>\r\n<div align=\"LEFT\">\r\n	<br />\r\n	<br />\r\n	<div align=\"JUSTIFY\">\r\n		Ù¾Ø§Ø±Ø§Ú¯Ø±Ø§Ù Ù‡Ø§ ØªÙˆØ³Ø· ØªÚ¯Ù‡Ø§ÙŠ &lt;p&gt; Ø¹Ù„Ø§Ù…Øª Ú¯Ø°Ø§Ø±ÙŠ Ù…ÙŠØ´ÙˆØ¯<br />\r\n		<br />\r\n		<span style=\"color:green;\">Ù¾ÙŠÙˆÙ†Ø¯ Ù‡Ø§ Ùˆ ÙŠØ§ Ù„ÙŠÙ†Ú© Ù‡Ø§ </span><br />\r\n		<br />\r\n		<p dir=\"ltr\">\r\n			<code style=\"direction:ltr;text-align:left;\">&lt;a href=&quot;www.internetstar.ir&quot;&gt; internetstar &lt;/a&gt;</code><br />\r\n			<br />\r\n			link Ù‡Ø§ Ùˆ ÙŠØ§ Ù¾ÙŠÙˆÙ†Ø¯ Ù‡Ø§ ØªÙˆØ³Ø· ØªÚ¯ &lt;a&gt; Ø¹Ù„Ø§Ù…Øª Ú¯Ø°Ø§Ø±ÙŠ Ù…ÙŠØ´ÙˆØ¯ Ø§ÙŠÙ† ØªÚ¯ Ù‡Ø§ Ø¯Ø§Ø±Ø§ÙŠ Ù†Ø´Ø§Ù†Ù‡ Ù‡Ø§ÙŠÙŠ Ù…ÙŠØ¨Ø§Ø´Ø¯ Ú©Ù‡ Ø¯Ø± Ù‚Ø³Ù…Øª Ù‡Ø§ÙŠ Ø¨Ø¹Ø¯ÙŠ ØªÙˆØ¶ÙŠØ­ Ø¯Ø§Ø¯Ù‡ Ø®ÙˆØ§Ù‡Ø¯ Ø´Ø¯ .<br />\r\n			<br />\r\n			<span style=\"color:green;\">ØªØµØ§ÙˆÙŠØ± </span><br />\r\n			&nbsp;</p>\r\n	</div>\r\n</div>\r\n<br />\r\n<div align=\"LEFT\">\r\n	<p dir=\"ltr\">\r\n		<code style=\"direction:ltr;text-align:left;\">&lt;img src=&quot;internetstar.gif&quot; width&quot;104&quot; height=&quot;142&quot;/&gt;</code></p>\r\n</div>\r\n<br />\r\n<br />\r\n<p>\r\n	ØªØµØ§ÙˆÙŠØ± ØªÙˆØ³Ø· ØªÚ¯ &lt;/img&gt; Ø¹Ù„Ø§Ù…Øª Ú¯Ø°Ø§Ø±ÙŠ Ù…ÙŠØ´ÙˆÙ†Ø¯ Ú©Ù‡ Ø¯Ø§Ø±Ø§ÙŠ Ù†Ø´Ø§Ù†Ù‡ Ù‡Ø§ Ùˆ ØªÙØ§ÙˆØª Ù‡Ø§ÙŠÙŠ Ø¨Ø§ 3 ØªÚ¯ Ù‚Ø¨Ù„ÙŠ Ø§Ø³Øª Ú©Ù‡ Ø¯Ø± Ø§Ø¯Ø§Ù…Ù‡ ØªÙˆØ¶ÙŠØ­ Ø¯Ø§Ø¯Ù‡ Ù…ÙŠØ´ÙˆØ¯ (Ù…Ø§Ù†Ù†Ø¯Ù‡ Ù†Ø§Ù… Ùˆ Ø§Ù†Ø¯Ø§Ø²Ù‡ ØªØµØ§ÙˆÙŠØ± )<br />\r\n	<br />\r\n	<span style=\"color:teal;\"><span style=\"color:green;\">Ø¹Ù†Ø§ØµØ± HTML</span></span><br />\r\n	<br />\r\n	Ø¹Ù†Ø§ØµØ± HTML Ø§Ø¬Ø²Ø§Ø¡ Ø³Ø§Ø²Ù†Ø¯Ù‡ ÙŠÚ© Ù…Ø¬Ù…ÙˆØ¹ HTML Ù‡Ø³ØªÙ†Ø¯ .Ø¹Ù†ØµØ± HTML ÙŠØ¹Ù†ÙŠ Ù‡Ø± Ú†ÙŠØ²ÙŠ Ú©Ù‡ Ø¨ÙŠÙ† ØªÚ¯ Ø§Ø¨ØªØ¯Ø§ÙŠÙŠ Ùˆ Ø§Ù†ØªÙ‡Ø§ÙŠÙŠ ÙˆØ¬ÙˆØ¯ Ø¯Ø§Ø±Ø¯<br />\r\n	<br />\r\n	ØªÚ¯ Ø´Ø±ÙˆØ¹ ØªÚ¯ Ø¨Ø§Ø² Ùˆ ØªÚ¯ Ù¾Ø§ÙŠØ§Ù†ÙŠ ØªÚ¯ Ø¨Ø³ØªÙ‡ Ù†ÙŠØ² Ù†Ø§Ù…ÙŠØ¯Ù‡ Ù…ÙŠØ´ÙˆØ¯<br />\r\n	<br />\r\n	Ø¹Ù†Ø§ØµØ± Ùˆ ÙŠØ§ Ø§Ø¬Ø²Ø§Ø¡ ÙŠÚ© Ù…Ø¬Ù…ÙˆØ¹Ù‡ HTML Ø¯Ø§Ø±Ø§ÙŠ Ù†Ø¸Ø§Ù… Ùˆ Ù‚ÙˆØ§Ø¹Ø¯ Ø®Ø§ØµÙŠ Ù‡Ø³ØªÙ†Ø¯ Ú©Ù‡ ØªØ¹Ø¯Ø§Ø¯ÙŠ Ø§Ø² Ø§Ù†Ù‡Ø§ Ø¯Ø± Ø²ÙŠØ± Ú¯ÙØªÙ‡ Ù…ÙŠØ´ÙˆØ¯</p>\r\n<br />\r\n<br />\r\n<ul>\r\n	<li>\r\n		Ø¹Ù†Ø§ØµØ± HTML Ø¨Ø§ ÙŠÚ© ØªÚ¯ Ø¨Ø§Ø² Ø´Ø±ÙˆØ¹ Ù…ÙŠ Ø´ÙˆØ¯ .</li>\r\n	<li>\r\n		Ø¹Ù†Ø§ØµØ±HTML Ø¨Ø§ ÙŠÚ© ØªÚ¯ Ø¨Ø³ØªÙ‡ Ø¨Ù‡ Ù¾Ø§ÙŠØ§Ù† Ù…ÙŠØ±Ø³Ø¯.</li>\r\n	<li>\r\n		Ù…Ø­ØªÙˆØ§ÙŠ Ø¹Ù†Ø§ØµØ± Ø¯Ø± Ø¨ÙŠÙ† ØªÚ¯Ù‡Ø§ÙŠ Ø§Ø¨ØªØ¯Ø§ÙŠÙŠ Ùˆ Ø§Ù†ØªÙ‡Ø§ÙŠÙŠ Ù‚Ø±Ø§Ø± Ù…ÙŠÚ¯ÙŠØ±Ø¯</li>\r\n	<li>\r\n		Ø¨Ø¹Ø¶ÙŠ Ø§Ø² Ø¹Ù†Ø§ØµØ± HTML Ù…Ø­ØªÙˆØ§ÙŠÙŠ Ù†Ø¯Ø§Ø±Ù† .</li>\r\n	<li>\r\n		Ø§ÙŠÙ† Ø¹Ù†Ø§ØµØ± Ø¯Ø± ØªÚ¯ Ø§Ø¨ØªØ¯Ø§ÙŠÙŠ Ø¨Ø³ØªÙ‡ Ù…ÙŠØ´ÙˆØ¯ Ù…Ø§Ù†Ù†Ø¯Ù‡ &lt;/br&gt;</li>\r\n	<li>\r\n		Ø¨Ø¹Ø¶ÙŠ Ø§Ø² Ø¹Ù†Ø§ØµØ±HTML Ø¯Ø§Ø±Ø§ÙŠ Ù…Ø´Ø®ØµØ§Øª Ùˆ ØªÙˆØ§Ù†Ø§ÙŠÙŠ Ù‡Ø§ÙŠÙŠ Ù‡Ø³ØªÙ†Ø¯</li>\r\n</ul>\r\n<p>\r\n	Ø§Ù„Ø¨ØªÙ‡ Ø¯Ø± Ù…ÙˆØ±Ø¯ ØªÙˆØ§Ù†Ø§ÙŠÙŠ Ù‡Ø§ÙŠ Ùˆ Ù…Ø´Ø®ØµØ§Øª Ø¹Ù†Ø§ØµØ± HTML Ø¯Ø± Ø§Ø¯Ø§Ù…Ù‡ Ø¨Ù‡ ØµÙˆØ±Øª Ú©Ø§Ù…Ù„ ØªÙˆØ¶ÙŠØ­ Ø¯Ø§Ø¯Ù‡ Ø®ÙˆØ§Ù‡Ø¯ Ø´Ø¯.<br />\r\n	<br />\r\n	<span style=\"color:green;\">ØªÚ¯Ù‡Ø§ÙŠ HTML ØªÙˆ Ø¯Ø± ØªÙˆ </span></p>\r\n<br />\r\n<br />\r\n<p dir=\"ltr\">\r\n	<code style=\"direction:ltr;text-align:left;\">&lt;html&gt;<br />\r\n	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &lt;body&gt;<br />\r\n	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &lt;p&gt;&nbsp;&nbsp;site phpnuke.ir &lt;/p&gt;<br />\r\n	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br />\r\n	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &lt;/body&gt;<br />\r\n	&lt;/html&gt;</code></p>\r\n<br />\r\n<br />\r\n<br />\r\n<br />\r\n<p>\r\n	ØªÚ¯Ù‡Ø§ÙŠ HTML Ù…Ø¹Ù…ÙˆÙ„Ø§ ØªÙˆØ³Ø· ØªÚ¯Ù‡Ø§ÙŠ Ø§Ø­Ø§Ø·Ù‡ Ø´Ø¯Ù‡ Ø§Ù†Ø¯ Ùˆ Ø§Ø² Ù‚Ø§Ù†ÙˆÙ† Ø®Ø§ØµÙŠ Ù¾ÙŠØ±ÙˆÙŠ Ù…ÙŠ Ú©Ù†Ù†Ø¯ Ø¨Ù‡ Ø§ÙŠÙ† ØµÙˆØ±Øª Ú©Ù‡ ØªÚ¯ Ø§Ø¨ØªØ¯Ø§ Ø¯Ø± Ø¢Ø®Ø± Ø¨Ø³ØªÙ‡ Ù…ÙŠØ´ÙˆØ¯ Ø§ÙŠÙ† Ø¨Ø¯ÙŠÙ† Ù…Ø¹Ù†Ø§ Ø³Øª Ú©Ù‡ ØªÚ¯ÙŠ Ú©Ù‡ Ø¬Ù„Ùˆ ØªØ± Ø§Ø² Ù‡Ù…Ù‡ ØªÚ¯Ù‡Ø§ Ø¨Ø§Ø² Ù…ÙŠØ´ÙˆØ¯ Ø¨Ø§ÙŠØ¯ Ø¯Ø± Ø¢Ø®Ø± Ù‡Ù…Ù‡ Ø¢Ù†Ù‡Ø§ Ø¨Ø³ØªÙ‡ Ø´ÙˆØ¯ Ø¨Ø±Ø§ÙŠ Ø¯Ø±Ú© Ø¨Ù‡ØªØ± Ø§ÙŠÙ† Ù…Ø·Ù„Ø¨ Ø¨Ù‡ Ù…Ø«Ø§Ù„ Ø²ÙŠØ± ØªÙˆØ¬Ù‡ Ú©Ù†ÙŠØ¯<br />\r\n	<br />\r\n	<br />\r\n	Ø¯Ø± Ø§ÙŠÙ† Ù…Ø«Ø§Ù„ ØªÚ¯ &lt;html&gt; Ø¯Ø± Ø§Ø¨ØªØ¯Ø§ÙŠ Ù‡Ù…Ù‡ ØªÚ¯Ù‡Ø§ Ø¨Ø§Ø² Ø´Ø¯Ù‡ Ø§Ø³Øª Ùˆ Ø¯Ø± Ø§Ù†ØªÙ‡Ø§ÙŠ Ù‡Ù…Ù‡ Ø§Ù†Ù‡Ø§ Ø¨Ø§ &lt;html/&gt; Ø¨Ø³ØªÙ‡ Ø´Ø¯Ù‡ . Ù…Ø­ØªÙˆØ§ÙŠ ØªÚ¯ &lt;html&gt; ØªÚ¯Ù‡Ø§ÙŠ &lt;body&gt; Ùˆ &lt;p&gt; Ù‡Ø³ØªÙ†Ø¯<br />\r\n	ØªÚ¯ &lt;body&gt; Ú©Ù‡ Ø¨Ø¹Ø¯ Ø§Ø² Ø¢Ù† Ø¨Ø§Ø² Ø´Ø¯Ù‡ Ù‚Ø¨Ù„ Ø§Ø² Ø§Ù† Ø¨Ø§ &lt;body/&gt; Ø¨Ø³ØªÙ‡ Ø´Ø¯Ù‡ Ø§Ø³Øª . Ù…Ø­ØªÙˆØ§ÙŠ ØªÚ¯ &lt;body&gt; Ú©Ù‡ Ø¯Ø± ÙˆØ§Ù‚Ø¹ Ø¨Ø¯Ù†Ù‡ Ùˆ Ù‚Ø³Ù…Øª Ù‚Ø§Ø¨Ù„ Ø±ÙˆÙŠØª ÙŠÚ© ØµÙØ­Ù‡ HTML Ø§Ø³Øª Ø¯Ø± Ø§ÙŠÙ† Ù…Ø«Ø§Ù„ ÙŠÚ© ØªÚ¯ &lt;p&gt; Ø§Ø³Øª Ø¯Ø± Ù…ÙˆØ±Ø¯ ØªÚ¯ &lt;p&gt; Ù‡Ù… Ø§ÙŠÙ† Ù…ÙˆØ¶ÙˆØ¹ ØªÚ©Ø±Ø§Ø± Ø´Ø¯Ù‡ Ø§Ø³Øª<br />\r\n	<span style=\"color:green;\">ØªÚ¯ Ù‡Ø§ÙŠ Ù¾Ø§ÙŠØ§Ù†ÙŠ Ø±Ø§ ÙØ±Ø§Ù…ÙˆØ´ Ù†Ú©Ù†ÙŠØ¯ </span></p>\r\n<br />\r\n<p dir=\"ltr\">\r\n	<code style=\"direction:ltr;text-align:left;\">&lt;p&gt;&nbsp;&nbsp;site phpnuke.ir &lt;/p&gt;</code></p>\r\n', 'train,HTML,part2', 0, 0);");
$db->sql_query("INSERT INTO `".$prefix."_xstatic` (`xsid`, `xssid`, `xsgt`, `xstitle`, `xstext`, `xstags`, `xscounter`, `xscomment`) VALUES
(9, 6, 'Part3', 'Ù‚Ø³Ù…Øª Ø³ÙˆÙ…', '<p>\r\n	<br />\r\n	<a href=\"http://www.phpnuke.ir/wiki/faqs/31/%D8%A2%D9%85%D9%88%D8%B2%D8%B4_HTML_%D9%82%D8%B3%D9%85%D8%AA_%D8%B3%D9%88%D9%85/#T1\">ØªÙˆØ§Ù†Ø§ÙŠÙŠÙ‡Ø§ Ùˆ Ø®ØµÙˆØµÙŠØ§Øª Ø¹Ù†Ø§ØµØ± HTML</a><br />\r\n	<a href=\"http://www.phpnuke.ir/wiki/faqs/31/%D8%A2%D9%85%D9%88%D8%B2%D8%B4_HTML_%D9%82%D8%B3%D9%85%D8%AA_%D8%B3%D9%88%D9%85/#T2\">Ø§Ù‡Ù…ÙŠØª ØªÚ¯Ù‡Ø§ÙŠ head line</a><br />\r\n	<a href=\"http://www.phpnuke.ir/wiki/faqs/31/%D8%A2%D9%85%D9%88%D8%B2%D8%B4_HTML_%D9%82%D8%B3%D9%85%D8%AA_%D8%B3%D9%88%D9%85/#T3\">ØªÚ¯Ù‡Ø§ÙŠ Ø®Ø· Ú©Ø´ÙŠ Ùˆ ÙŠØ§ Ø®Ø· (line)</a><br />\r\n	<a href=\"http://www.phpnuke.ir/wiki/faqs/31/%D8%A2%D9%85%D9%88%D8%B2%D8%B4_HTML_%D9%82%D8%B3%D9%85%D8%AA_%D8%B3%D9%88%D9%85/#T4\">Ú†Ú¯ÙˆÙ†Ù‡ Ú©Ø¯ Ù‡Ø§ÙŠ HTML ÙŠÚ© ØµÙØ­Ù‡ ÙˆØ¨ Ø±Ø§ Ø¨Ø¨ÙŠÙ†ÙŠÙ…ØŸ</a><br />\r\n	<span style=\"color:darkred;\">================================================== ==</span><br />\r\n	<a name=\"T1\"><span style=\"color:seagreen;\"><strong>ØªÙˆØ§Ù†Ø§ÙŠÙŠÙ‡Ø§ÙŠ Ùˆ Ø®ØµÙˆØµÙŠØ§Øª Ø¹Ù†Ø§ØµØ± HTML </strong></span></a><br />\r\n	<br />\r\n	Ø­Ø§Ù„Ø§ Ø¨Ù‡ ØªÙØµÙŠÙ„ Ø¨Ù‡ ØªÙˆØ§Ù†Ø§ÙŠÙŠÙ‡Ø§ÙŠ Ø¨Ø¹Ø¶ÙŠ Ø§Ø² Ø¹Ù†Ø§ØµØ± HTML Ù…ÙŠÙ¾Ø±Ø¯Ø§Ø²ÙŠÙ… . Ù‡Ø± Ø¹Ù†ØµØ± HTML Ø¯Ø§Ø±Ø§ÙŠ ØªÙˆØ§Ù†Ø§ÙŠÙŠÙ‡Ø§ Ùˆ Ø®ØµÙˆØµÙŠØªÙ‡Ø§ÙŠÙŠ Ù…Ø¨Ø§Ø´Ø¯ . Ø§ÙŠÙ† Ø®ØµÙˆØµÙŠØª Ù‡Ø§ ÙŠÚ© Ø³Ø±ÙŠ Ø§Ø·Ù„Ø§Ø¹Ø§Øª Ø§Ø¶Ø§ÙÙ‡ Ùˆ ØªÚ©Ù…ÙŠÙ„ÙŠ Ø¯Ø± Ù…ÙˆØ±Ø¯ Ù‡Ø± Ø¹Ù†ØµØ± HTML Ø§Ø³Øª . Ø§Ø·Ù„Ø§Ø¹Ø§Øª Ø¯Ø± Ø¨ÙŠÙ† ØªÚ¯ Ù‡Ø§ÙŠ Ø§Ø¨ØªØ¯Ø§ÙŠÙŠ Ù…Ø§Ù†Ù†Ø¯Ù‡<br />\r\n	&nbsp;</p>\r\n<div style=\"text-align:left;direction:ltr;\">\r\n	&lt;a href=&quot;http://www.internetstar.ir&quot;&gt; internetstar web site&lt;/a&gt;</div>\r\n<br />\r\n<br />\r\n<p>\r\n	Ù…Ø±ÙˆØ±Ú¯Ø± Ù‡Ø§ Ø¨Ù‡ ØµÙˆØ±Øª Ø§ØªÙˆ Ù…Ø§ØªÙŠÚ© ÙŠÚ© Ø®Ø· ÙØ§ØµÙ„Ù‡ Ø¨Ø¹Ø¯ Ø§Ø² Ø§ÙŠÙ† ØªÚ¯Ù‡Ø§ Ø§ÙŠØ¬Ø§Ø¯ Ù…ÙŠÚ©Ù†Ø¯.<br />\r\n	<a name=\"T2\"><span style=\"color:green;\"><strong>Ø§Ù‡Ù…ÙŠØª ØªÚ¯ Ù‡Ø§ÙŠ head line</strong></span></a><br />\r\n	Ø§Ø² Ø§ÙŠÙ† ØªÚ¯ Ù‡Ø§ Ø¨Ø±Ø§ÙŠ Ø¨Ø²Ø±Ú¯ Ùˆ ÙŠØ§ Ú©ÙˆÚ†Ú© Ú©Ø±Ø¯Ù† Ù†ÙˆØ´ØªÙ‡ Ù‡Ø§ Ø§Ø³ØªÙØ§Ø¯Ù‡ Ù†Ú©Ù†ÙŠØ¯ Ø¨Ù„Ú©Ù‡ Ø¨Ø±Ø§ÙŠ Ù…ÙˆØ¶ÙˆØ¹Ø§Øª Ù¾Ø± Ø§Ù‡Ù…ÙŠØª Ø§Ø² Ø§Ù†Ù‡Ø§ Ø§Ø³ØªÙØ§Ø¯Ù‡ Ú©Ù†ÙŠØ¯ Ùˆ Ù…ÙˆØ¶ÙˆØ¹Ø§Øª Ùˆ Ù†ÙˆØ´ØªÙ‡ Ù‡Ø§ÙŠ Ù¾Ø± Ø§Ù‡Ù…ÙŠØª Ø±Ø§ Ø¯Ø§Ø®Ù„ Ø§Ù†Ù‡Ø§ Ù‚Ø±Ø§Ø± Ø¯Ù‡ÙŠØ¯ .<br />\r\n	Ù…ÙˆØªÙˆØ± Ù‡Ø§ÙŠ Ø¬Ø³ØªØ¬Ùˆ Ù…Ø§Ù†Ù†Ø¯ Ú¯ÙˆÚ¯Ù„ Ùˆ ÙŠØ§Ù‡Ùˆ Ø¨Ø±Ø§ÙŠ Ù¾ÙŠ Ø¨Ø±Ø¯Ù† Ø¨Ù‡ Ù…ÙˆØ¶ÙˆØ¹ ÙˆØ¨ Ø³Ø§ÙŠØª Ùˆ ØµÙØ­Ù‡ ÙˆØ¨ Ø³Ø§ÙŠØª Ø´Ù…Ø§ Ø§Ø² Ù†ÙˆØ´ØªÙ‡ Ù‡Ø§ÙŠÙŠ Ú©Ù‡ Ø¯Ø§Ø®Ù„ Ø§ÙŠÙ† ØªÚ¯ Ù‡Ø§ ÙˆØ¬ÙˆØ¯ Ø¯Ø§Ø±Ø¯ Ø§Ø³ØªÙØ§Ø¯Ù‡ Ù…ÙŠÚ©Ù†Ù†Ø¯<br />\r\n	ØªØ±ØªÙŠØ¨ Ø§Ù‡Ù…ÙŠØª Ø§ÙŠÙ† ØªÚ¯ Ù‡Ø§Ø¨Ù‡ ØªØ±ØªÙŠØ¨ Ø¨ÙŠØ´ØªØ± Ø§Ø² h1 Ø¨Ù‡ h6 Ù…ÙŠ Ø±Ø³Ø¯<br />\r\n	<a name=\"T3\"><span style=\"color:green;\"><strong>ØªÚ¯Ù‡Ø§ÙŠ Ø®Ø· Ú©Ø´ÙŠ Ùˆ ÙŠØ§ Ø®Ø· (line)</strong></span></a><br />\r\n	<br />\r\n	ØªÚ¯ &lt;/hr&gt; Ø¨Ø±Ø§ÙŠ Ú©Ø´ÙŠØ¯Ù† Ø®Ø· Ù‡Ø§ÙŠ Ø§ÙÙ‚ÙŠ Ø§Ø³ØªÙØ§Ø¯Ù‡ Ù…ÙŠØ´ÙˆØ¯</p>\r\n<br />\r\n<br />\r\n<div style=\"text-align:left;direction:ltr;\">\r\n	&lt;h1&gt; phpnuke web &lt;/h1&gt;<br />\r\n	&lt;hr/&gt;<br />\r\n	&lt;h2&gt; phpnuke web &lt;/h2&gt;<br />\r\n	&lt;hr/&gt;<br />\r\n	&lt;h3&gt; phpnuke web &lt;/h3&gt;<br />\r\n	&lt;hr/&gt;<br />\r\n	&lt;h4&gt; phpnuke web &lt;/h4&gt;<br />\r\n	&lt;hr/&gt;<br />\r\n	&lt;h5&gt; phpnuke web &lt;/h5&gt;<br />\r\n	&lt;hr/&gt;<br />\r\n	&lt;h6&gt; phpnuke web &lt;/h6&gt;</div>\r\n<br />\r\n<br />\r\n<p>\r\n	Ù†ÙˆØ´ØªÙ† ØªÙˆØ¶ÙŠØ­Ø§Øª Ø¨Ø±Ø§ÙŠ Ú©Ø¯ Ù‡Ø§ÙŠ HTML<br />\r\n	<br />\r\n	Ø§ÙŠÙ† ØªÙˆØ¶ÙŠØ­Ø§Øª Ø¨Ø§ÙŠØ¯ Ø¨Ù‡ ØµÙˆØ±ØªÙŠ Ø¯Ø± Ø¯Ø±ÙˆÙ† Ú©Ø¯ Ù‡Ø§ÙŠ HTML Ù‚Ø±Ø§Ø± Ú¯ÙŠØ±Ø¯ Ú©Ù‡ ØªÙˆØ³Ø· Ù…Ø±ÙˆØ±Ú¯Ø± Ù‡Ø§ Ø®ÙˆØ§Ù†Ø¯Ù‡ Ù†Ø´ÙˆØ¯ Ø¨Ù†Ø§Ø¨Ø± Ø§ÙŠÙ† ØªÙˆØ¶ÙŠØ­Ø§Øª Ø±Ø§ Ø¨Ù‡ Ø§ÙŠÙ† ØµÙˆØ±Øª Ù†ÙˆØ´ØªÙ‡ Ù…ÙŠØ´ÙˆØ¯</p>\r\n<br />\r\n<br />\r\n<div style=\"text-align:left;direction:ltr;\">\r\n	&lt;!-- Ø§ÙŠÙ†Ø¬Ø§ Ù…Ø­Ù„ Ù†ÙˆØ´ØªÙ† ØªÙˆØ¶ÙŠØ­Ø§Øª Ù‡Ø³Øª --&gt;</div>\r\n<p>\r\n	<br />\r\n	<br />\r\n	Ø§ÙŠÙ† Ù†ÙˆØ´ØªÙ‡ Ù‡Ø§ ØªÙˆØ³Ø· Ù…Ø±ÙˆØ±Ú¯Ø± Ù‡Ø§ Ø®ÙˆØ§Ù†Ø¯Ù‡ Ù†Ù…ÙŠ Ø´ÙˆÙ†Ø¯ Ø¹Ù„Ø§Ù…Øª ØªØ¹Ø¬Ø¨ ÙÙ‚Ø· Ø¯Ø± Ø§Ø¨ØªØ¯Ø§ Ù‚Ø±Ø§Ø± Ù…ÙŠÚ¯ÙŠØ±Ø¯ Ùˆ Ø¯Ø± Ù¾Ø§ÙŠØ§Ù† Ù†Ù…ÙŠ Ø§ÙŠØ¯<br />\r\n	<br />\r\n	<a name=\"T4\"><strong><span style=\"color:green;\">Ú†Ú¯ÙˆÙ†Ù‡ Ú©Ø¯ Ù‡Ø§ÙŠ HTML ÙŠÚ© ØµÙØ­Ù‡ ÙˆØ¨ Ø±Ø§ Ø¨Ø¨ÙŠÙ†ÙŠÙ… ØŸ</span></strong></a><br />\r\n	Ø¨Ø±Ø§ÙŠ Ø§ÙŠÙ† Ú©Ø§Ø± Ø´Ù…Ø§ Ù…ÙŠØªÙˆØ§Ù†ÙŠØ¯ Ø¯Ø± ØµÙØ­Ù‡ Ù…Ø±ÙˆØ±Ú¯Ø± ØªØ§Ù† Ú¯Ø²ÙŠÙ†Ù‡ view Ø±Ø§ Ø§Ø² Ù†ÙˆØ§Ø± Ø§Ø¨Ø²Ø§Ø± Ø§Ù†ØªØ®Ø§Ø¨ Ú©Ù†ÙŠØ¯ Ùˆ Ø³Ù¾Ø³ Ú¯Ø²ÙŠÙ†Ù‡ view source Ùˆ ÙŠØ§ source Ø±Ø§ Ø§Ù†ØªØ®Ø§Ø¨ Ú©Ù†ÙŠØ¯ Ø¯Ø± Ø§ÙŠÙ† Ø­Ø§Ù„Øª ÙŠÚ© Ù¾Ù†Ø¬Ø±Ù‡ Ø¬Ø¯ÙŠØ¯ Ø¨Ø§Ø² Ù…ÙŠØ´ÙˆØ¯ Ú©Ù‡ Ú©Ø¯ Ù‡Ø§ÙŠ HTML Ø±Ø§ Ø¨Ù‡ Ø´Ù…Ø§ Ù†Ø´Ø§Ù† Ù…ÙŠØ¯Ù‡Ø¯</p>\r\n', 'train,HTML,part3', 0, 0),
(10, 0, 'Hosting', 'Ù…ÛŒØ²Ø¨Ø§Ù†ÛŒ ÙˆØ¨', '<p>\r\n	<font color=\"#808080\">Ø¢ÛŒØ§ ØªØ§ Ø¨Ù‡ Ø­Ø§Ù„ Ø¨Ù‡ Ø§ÛŒÙ† ÙÚ©Ø± Ø§ÙØªØ§Ø¯Ù‡ Ø§ÛŒØ¯ Ú©Ù‡ Ø¨Ø±Ø§ÛŒ Ø®ÙˆØ¯ ÛŒÚ© ØµÙØ­Ù‡ Ø´Ø®ØµÛŒ Ø¯Ø± Ø¯Ù†ÛŒØ§ÛŒ Ø§ÛŒÙ†ØªØ±Ù†Øª Ø¯Ø§Ø´ØªÙ‡ Ø¨Ø§Ø´ÛŒØ¯ ÛŒØ§ Ø§ÛŒÙ†Ú©Ù‡ Ø¨Ø±Ø§ÛŒ Ù…Ø¹Ø±ÙÛŒ Ø´Ø±Ú©Øª ÛŒØ§ Ù…Ø­ØµÙˆÙ„ Ø®ÙˆØ¯ Ø§Ø² Ø·Ø±ÛŒÙ‚ Ø§ÛŒÙ†ØªØ±Ù†Øª ÛŒÚ© Ø³Ø§ÛŒØª Ø§Ø®ØªØµØ§ØµÛŒ Ø§ÛŒØ¬Ø§Ø¯ Ú©Ù†ÛŒØ¯ . Ù…Ø´Ù‡Ø¯ØªÛŒÙ… Ø¢Ù…Ø§Ø¯Ú¯ÛŒ Ø®ÙˆØ¯ Ø±Ø§ Ø¨Ø±Ø§ÛŒ Ø§Ø±Ø§Ø¦Ù‡ Ø³Ø±ÙˆÛŒØ³ Ù‡Ø§ÛŒ Ù‡Ø§Ø³ØªÛŒÙ†Ú¯ Ùˆ Ø«Ø¨Øª Ø¯Ø§Ù…Ù†Ù‡ Ø¨Ø§ Ù…Ù†Ø§Ø³Ø¨ ØªØ±ÛŒÙ† Ù‚ÛŒÙ…Øª Ùˆ Ø¨Ù‡ØªØ±ÛŒÙ† Ø§Ù…Ú©Ø§Ù†Ø§Øª Ø§Ø¹Ù„Ø§Ù… Ù…ÛŒÚ©Ù†Ø¯ . Ø³Ø±ÙˆÛŒØ³ Ù‡Ø§Ø³ØªÛŒÙ†Ú¯ Ù…Ø´Ù‡Ø¯ØªÛŒÙ… Ø¨Ø§ Ú©Ø§Ø¯Ø± Ù…Ø¬Ø±Ø¨ Ø¨ØµÙˆØ±Øª 24 Ø³Ø§Ø¹ØªÙ‡ Ù¾Ø§Ø³Ø®Ú¯ÙˆÛŒ Ø´Ù…Ø§ Ø®ÙˆØ§Ù‡Ø¯ Ø¨ÙˆØ¯ . Ù¾Ø³ Ø§Ø² Ø§Ø¬Ø§Ø±Ù‡ ÙØ¶Ø§ Ø§Ú¯Ø± Ø´Ù…Ø§ ØªÙ…Ø§ÛŒÙ„ Ø¨Ù‡ Ø§Ø³ØªÙØ§Ø¯Ù‡ Ø§Ø² Ù†Ø³Ø®Ù‡ Ù‡Ø§ÛŒ Ù…Ø®ØªÙ„Ù php-nuke ÙØ§Ø±Ø³ÛŒ Ø±Ø§ Ø¯Ø§Ø±ÛŒØ¯ Ú¯Ø±ÙˆÙ‡ Ù…Ø´Ù‡Ø¯ØªÛŒÙ… Ø§ÛŒÙ† Ø³ÛŒØ³ØªÙ… Ù…Ø¯ÛŒØ±ÛŒØª Ù…Ø­ØªÙˆØ§ Ø±Ø§ Ø¨Ø±Ø§ÛŒ Ø´Ù…Ø§ Ø¨ØµÙˆØ±Øª Ø±Ø§ÛŒÚ¯Ø§Ù† Ù†ØµØ¨ Ùˆ ØªÙ†Ø¸ÛŒÙ… Ù…ÛŒÙ†Ù…Ø§ÛŒØ¯ Ø¨Ø±Ø§ÛŒ Ù…Ø´Ø§Ù‡Ø¯Ù‡ Ø§Ù…Ú©Ø§Ù†Ø§Øª Ø¨ÛŒ Ù†Ø¸ÛŒØ± Ù‡Ø§Ø³ØªÛŒÙ†Ú¯ Ù…Ø´Ù‡Ø¯ØªÛŒÙ… Ù…ÛŒØªÙˆØ§Ù†ÛŒØ¯ Ø§Ø² Ø¨Ø®Ø´ Ù…Ø´Ø®ØµØ§Øª ÙÙ†ÛŒ Ø§Ø³ØªÙØ§Ø¯Ù‡ ÙØ±Ù…Ø§Ø¦ÛŒØ¯ Ù‡Ù…Ú†Ù†ÛŒÙ† Ø¨Ø±Ø§ÛŒ Ø®Ø±ÛŒØ¯ Ù‡Ø§Ø³ØªÛŒÙ†Ú¯ Ùˆ Ø«Ø¨Øª Ø¯Ø§Ù…Ù†Ù‡ Ø¨ØµÙˆØ±Øª Ø§Ù†Ù„Ø§ÛŒÙ† Ø¨Ù‡ Ù‚Ø³Ù…Øª <a href=\"http://www.phpnuke.ir/modules.php?name=hosting&amp;page=4\">ÙØ±Ù… Ø¯Ø±Ø®ÙˆØ§Ø³Øª</a> Ù…Ø±Ø§Ø¬Ø¹Ù‡ ÙØ±Ù…Ø§Ø¦ÛŒØ¯ Ùˆ Ù…Ø´Ø®ØµØ§Øª Ù„Ø§Ø²Ù… Ø±Ø§ Ø¨Ø±Ø§ÛŒ Ù…Ø§ Ø§Ø±Ø³Ø§Ù„ Ú©Ù†ÛŒØ¯.</font></p>\r\n', 'hosting', 0, 0),
(11, 10, 'Price', 'Ù‚ÛŒÙ…Øª', '<p>\r\n	<strong><span style=\"color:#ff0000;\">Ù…Ø´ØªØ±ÛŒ Ú¯Ø±Ø§Ù…ÛŒ ØŒ Ø³Ø±ÙˆÛŒØ³ Ù‡Ø§Ø³ØªÛŒÙ†Ú¯ Ù†ÛŒÙˆÚ© ÙØ§Ø±Ø³ÛŒ Ø¢Ù…Ø§Ø¯Ú¯ÛŒ Ø®ÙˆØ¯ Ø±Ø§ Ø¬Ù‡Øª Ø«Ø¨Øª ØªÙ…Ø§Ù…ÛŒ Ø¯Ø§Ù…ÛŒÙ† Ù‡Ø§ÛŒ Ù…Ø¬Ø§Ø² Ø§Ø¹Ù„Ø§Ù… Ù…ÛŒÙ†Ù…Ø§ÛŒØ¯ Ùˆ ØªØ§ Ø§Ø·Ù„Ø§Ø¹ Ø«Ø§Ù†ÙˆÛŒ Ø¨Ù‡ Ù…Ù†Ø¸ÙˆØ± Ø§Ø±Ø§Ø¦Ù‡ Ø®Ø¯Ù…Ø§Øª Ø¨Ù‡ÛŒÙ†Ù‡ Ø¨Ù‡ Ú©Ø§Ø±Ø¨Ø±Ø§Ù† Ø¯Ø± ØµÙˆØ±Øª Ø§Ù†ØªØ®Ø§Ø¨ Ø¯Ø§Ù…ÛŒÙ† Ø¨Ø§ Ù¾Ø³ÙˆÙ†Ø¯ Ø¢ÛŒ Ø¢Ø± Ù…Ø¨Ù„Øº 10 Ù‡Ø²Ø§Ø± ØªÙˆÙ…Ø§Ù† Ø§Ø² ÙØ§Ú©ØªÙˆØ± Ù†Ù‡Ø§ÛŒÛŒ Ø³Ø±ÙˆÛŒØ³ Ø§Ù†ØªØ®Ø§Ø¨ÛŒ Ø´Ù…Ø§ Ú©Ø³Ø± Ø®ÙˆØ§Ù‡Ø¯ Ø´Ø¯ . Ù‡Ù…Ú†Ù†ÛŒÙ† Ù¾Ø³ÙˆÙ†Ø¯Ù‡Ø§ÛŒ Ø¨ÛŒÙ† Ø§Ù„Ù…Ù„Ù„ÛŒ Ù…Ø§Ù†Ù†Ø¯ Ø¯Ø§Øª Ú©Ø§Ù… Ø¨Ù‡ Ù‚ÛŒÙ…Øª Ø±ÙˆØ² Ù…Ø­Ø§Ø³Ø¨Ù‡ Ù…ÛŒÚ¯Ø±Ø¯Ø¯ Ùˆ Ù‡Ø²ÛŒÙ†Ù‡ Ù¾Ø³ Ø§Ø² ØªÚ©Ù…ÛŒÙ„ ÙØ±Ù… Ø°ÛŒÙ„ Ø¯Ø± ÙØ§Ú©ØªÙˆØ± Ù†Ù‡Ø§ÛŒÛŒ Ù…Ø­Ø§Ø³Ø¨Ù‡ Ø®ÙˆØ§Ù‡Ø¯ Ø´Ø¯. </span></strong></p>\r\n<div align=\"center\">\r\n	<center>\r\n		<table bgcolor=\"#fffdea\" border=\"1\" cellspacing=\"1\" dir=\"rtl\" height=\"122\" id=\"AutoNumber1\" width=\"617\">\r\n			<tbody>\r\n				<tr>\r\n					<td bgcolor=\"#fffacc\" height=\"28\" width=\"95\">\r\n						<font face=\"Tahoma\" style=\"FONT-SIZE: 9pt\">Ù†ÙˆØ¹ Ø³Ø±ÙˆÛŒØ³</font></td>\r\n					<td align=\"center\" bgcolor=\"#fffacc\" height=\"28\" width=\"53\">\r\n						<font face=\"Tahoma\" style=\"FONT-SIZE: 9pt\">ÙØ¶Ø§(Ù…Ú¯Ø§Ø¨Ø§ÛŒØª)</font></td>\r\n					<td align=\"center\" bgcolor=\"#fffacc\" height=\"28\" width=\"64\">\r\n						<font face=\"Tahoma\" style=\"FONT-SIZE: 9pt\">Ø¯Ø§Ù…ÛŒÙ† Ø±Ø§ÛŒÚ¯Ø§Ù†</font></td>\r\n					<td align=\"center\" bgcolor=\"#fffacc\" height=\"28\" width=\"70\">\r\n						<font face=\"Tahoma\" style=\"FONT-SIZE: 9pt\">Ù¾Ø§ÛŒÚ¯Ø§Ù‡ Ø¯Ø§Ø¯Ù‡ (mysql)</font></td>\r\n					<td align=\"center\" bgcolor=\"#fffacc\" height=\"28\" width=\"91\">\r\n						<font face=\"Tahoma\" style=\"FONT-SIZE: 9pt\">ØªØ±Ø§ÙÛŒÚ© Ù…Ø§Ù‡ÛŒØ§Ù†Ù‡</font></td>\r\n					<td align=\"center\" bgcolor=\"#fffacc\" height=\"28\" width=\"64\">\r\n						<font face=\"Tahoma\" style=\"FONT-SIZE: 9pt\">Ø­Ø³Ø§Ø¨ FTP</font></td>\r\n					<td align=\"center\" bgcolor=\"#fffacc\" height=\"28\" width=\"88\">\r\n						<font face=\"Tahoma\" style=\"FONT-SIZE: 9pt\">Ù†ÛŒÙˆÚ©<span lang=\"en-us\"> </span> ÙØ§Ø±Ø³ÛŒ </font></td>\r\n					<td align=\"center\" bgcolor=\"#fffacc\" height=\"28\" width=\"46\">\r\n						<font face=\"Tahoma\" style=\"FONT-SIZE: 9pt\">Ù‚ÛŒÙ…Øª</font></td>\r\n				</tr>\r\n				<tr>\r\n					<td bgcolor=\"#fffacc\" height=\"21\" width=\"95\">\r\n						<font face=\"Tahoma\" style=\"FONT-SIZE: 9pt\">Ø³Ø±ÙˆÛŒØ³ </font> <span lang=\"en-us\"><font face=\"Tahoma\" style=\"font-size: 9pt\">Silver</font></span></td>\r\n					<td align=\"center\" height=\"21\" width=\"53\">\r\n						<font face=\"Tahoma\" style=\"FONT-SIZE: 9pt\">100</font></td>\r\n					<td align=\"center\" height=\"21\" width=\"64\">\r\n						<font face=\"Tahoma\" style=\"FONT-SIZE: 9pt\">Ø¨Ù„ÛŒ</font></td>\r\n					<td align=\"center\" height=\"21\" width=\"70\">\r\n						<font face=\"Tahoma\" style=\"FONT-SIZE: 9pt\">Ø¨ÛŒ Ù†Ù‡Ø§ÛŒØª</font></td>\r\n					<td align=\"center\" height=\"21\" width=\"91\">\r\n						<font face=\"Tahoma\" style=\"FONT-SIZE: 9pt\"><span lang=\"en-us\">10</span>000 Ù…Ú¯Ø§Ø¨Ø§ÛŒØª</font></td>\r\n					<td align=\"center\" height=\"21\" width=\"64\">\r\n						<font face=\"Tahoma\" style=\"FONT-SIZE: 9pt\">Ø¨ÛŒ Ù†Ù‡Ø§ÛŒØª</font></td>\r\n					<td align=\"center\" height=\"21\" width=\"88\">\r\n						<font face=\"Tahoma\" style=\"FONT-SIZE: 9pt\">Ø¨Ù„ÛŒ</font></td>\r\n					<td align=\"center\" height=\"21\" width=\"46\">\r\n						<font face=\"Tahoma\" style=\"font-size: 9pt\">635000 </font></td>\r\n				</tr>\r\n				<tr>\r\n					<td bgcolor=\"#fffacc\" height=\"21\" width=\"95\">\r\n						<font face=\"Tahoma\" style=\"FONT-SIZE: 9pt\">Ø³Ø±ÙˆÛŒØ³ Golden</font></td>\r\n					<td align=\"center\" height=\"21\" width=\"53\">\r\n						<font face=\"Tahoma\" style=\"font-size: 9pt\">200</font></td>\r\n					<td align=\"center\" height=\"21\" width=\"64\">\r\n						<span lang=\"fa\"><font face=\"Tahoma\" style=\"FONT-SIZE: 9pt\">Ø¨Ù„ÛŒ</font></span></td>\r\n					<td align=\"center\" height=\"21\" width=\"70\">\r\n						<font face=\"Tahoma\" style=\"FONT-SIZE: 9pt\">Ø¨ÛŒ Ù†Ù‡Ø§ÛŒØª</font></td>\r\n					<td align=\"center\" height=\"21\" width=\"91\">\r\n						<font face=\"Tahoma\" style=\"FONT-SIZE: 9pt\">20000 Ù…Ú¯Ø§Ø¨Ø§ÛŒØª</font></td>\r\n					<td align=\"center\" height=\"21\" width=\"64\">\r\n						<font face=\"Tahoma\" style=\"FONT-SIZE: 9pt\">Ø¨ÛŒ Ù†Ù‡Ø§ÛŒØª</font></td>\r\n					<td align=\"center\" height=\"21\" width=\"88\">\r\n						<font face=\"Tahoma\" style=\"FONT-SIZE: 9pt\">Ø¨Ù„ÛŒ</font></td>\r\n					<td align=\"center\" height=\"21\" width=\"46\">\r\n						<font face=\"Tahoma\" style=\"FONT-SIZE: 9pt\">695000 </font></td>\r\n				</tr>\r\n				<tr>\r\n					<td bgcolor=\"#fffacc\" height=\"28\" width=\"95\">\r\n						<font face=\"Tahoma\" style=\"FONT-SIZE: 9pt\">Ø³Ø±ÙˆÛŒØ³ </font> <span lang=\"en-us\"><font face=\"Tahoma\" style=\"font-size: 9pt\"> Platinum</font></span></td>\r\n					<td align=\"center\" height=\"28\" width=\"53\">\r\n						<font face=\"Tahoma\" style=\"FONT-SIZE: 9pt\">500</font></td>\r\n					<td align=\"center\" height=\"28\" width=\"64\">\r\n						<span lang=\"fa\"><font face=\"Tahoma\" style=\"FONT-SIZE: 9pt\">Ø¨Ù„ÛŒ</font></span></td>\r\n					<td align=\"center\" height=\"28\" width=\"70\">\r\n						<font face=\"Tahoma\" style=\"FONT-SIZE: 9pt\">Ø¨ÛŒ Ù†Ù‡Ø§ÛŒØª</font></td>\r\n					<td align=\"center\" height=\"28\" width=\"91\">\r\n						<font face=\"Tahoma\" style=\"FONT-SIZE: 9pt\"><span lang=\"en-us\">30</span>000 Ù…Ú¯Ø§Ø¨Ø§ÛŒØª</font></td>\r\n					<td align=\"center\" height=\"28\" width=\"64\">\r\n						<font face=\"Tahoma\" style=\"FONT-SIZE: 9pt\">Ø¨ÛŒ Ù†Ù‡Ø§ÛŒØª</font></td>\r\n					<td align=\"center\" height=\"28\" width=\"88\">\r\n						<font face=\"Tahoma\" style=\"FONT-SIZE: 9pt\">Ø¨Ù„ÛŒ</font></td>\r\n					<td align=\"center\" height=\"28\" width=\"46\">\r\n						<font face=\"Tahoma\" style=\"FONT-SIZE: 9pt\">795000 </font></td>\r\n				</tr>\r\n				<tr>\r\n					<td bgcolor=\"#fffacc\" height=\"28\" width=\"95\">\r\n						<font face=\"Tahoma\" style=\"FONT-SIZE: 9pt\">Ø³Ø±ÙˆÛŒØ³ </font> <span lang=\"en-us\"><font face=\"Tahoma\" style=\"font-size: 9pt\"> Plus1GIG</font></span></td>\r\n					<td align=\"center\" height=\"28\" width=\"53\">\r\n						<font face=\"Tahoma\" style=\"FONT-SIZE: 9pt\">1000</font></td>\r\n					<td align=\"center\" height=\"28\" width=\"64\">\r\n						<span lang=\"fa\"><font face=\"Tahoma\" style=\"FONT-SIZE: 9pt\">Ø¨Ù„ÛŒ</font></span></td>\r\n					<td align=\"center\" height=\"28\" width=\"70\">\r\n						<font face=\"Tahoma\" style=\"FONT-SIZE: 9pt\">Ø¨ÛŒ Ù†Ù‡Ø§ÛŒØª</font></td>\r\n					<td align=\"center\" height=\"28\" width=\"91\">\r\n						<font face=\"Tahoma\" style=\"FONT-SIZE: 9pt\"><span lang=\"en-us\">40</span>000 Ù…Ú¯Ø§Ø¨Ø§ÛŒØª</font></td>\r\n					<td align=\"center\" height=\"28\" width=\"64\">\r\n						<font face=\"Tahoma\" style=\"FONT-SIZE: 9pt\">Ø¨ÛŒ Ù†Ù‡Ø§ÛŒØª</font></td>\r\n					<td align=\"center\" height=\"28\" width=\"88\">\r\n						<font face=\"Tahoma\" style=\"FONT-SIZE: 9pt\">Ø¨Ù„ÛŒ</font></td>\r\n					<td align=\"center\" height=\"28\" width=\"46\">\r\n						<font face=\"Tahoma\" style=\"FONT-SIZE: 9pt\">925000 </font></td>\r\n				</tr>\r\n				<tr>\r\n					<td bgcolor=\"#fffacc\" height=\"28\" width=\"95\">\r\n						<font face=\"Tahoma\" style=\"FONT-SIZE: 9pt\">Ø³Ø±ÙˆÛŒØ³ </font> <span lang=\"en-us\"><font face=\"Tahoma\" style=\"font-size: 9pt\"> Plus2GIG</font></span></td>\r\n					<td align=\"center\" height=\"28\" width=\"53\">\r\n						<font face=\"Tahoma\" style=\"FONT-SIZE: 9pt\">2000</font></td>\r\n					<td align=\"center\" height=\"28\" width=\"64\">\r\n						<span lang=\"fa\"><font face=\"Tahoma\" style=\"FONT-SIZE: 9pt\">Ø¨Ù„ÛŒ</font></span></td>\r\n					<td align=\"center\" height=\"28\" width=\"70\">\r\n						<font face=\"Tahoma\" style=\"FONT-SIZE: 9pt\">Ø¨ÛŒ Ù†Ù‡Ø§ÛŒØª</font></td>\r\n					<td align=\"center\" height=\"28\" width=\"91\">\r\n						<font face=\"Tahoma\" style=\"FONT-SIZE: 9pt\"><span lang=\"en-us\">50</span>000 Ù…Ú¯Ø§Ø¨Ø§ÛŒØª</font></td>\r\n					<td align=\"center\" height=\"28\" width=\"64\">\r\n						<font face=\"Tahoma\" style=\"FONT-SIZE: 9pt\">Ø¨ÛŒ Ù†Ù‡Ø§ÛŒØª</font></td>\r\n					<td align=\"center\" height=\"28\" width=\"88\">\r\n						<font face=\"Tahoma\" style=\"FONT-SIZE: 9pt\">Ø¨Ù„ÛŒ</font></td>\r\n					<td align=\"center\" height=\"28\" width=\"46\">\r\n						<font face=\"Tahoma\" style=\"FONT-SIZE: 9pt\">1100000 </font></td>\r\n				</tr>\r\n			</tbody>\r\n		</table>\r\n	</center>\r\n</div>\r\n<p align=\"center\">\r\n	<a href=\"http://www.phpnuke.ir/modules.php?name=hosting&amp;page=4\">ÙØ±Ù… Ø¯Ø±Ø®ÙˆØ§Ø³Øª</a></p>\r\n', 'hosting,Price', 0, 0),
(12, 10, 'Server-Config', 'Ù…Ø´Ø®ØµØ§Øª ÙÙ†ÛŒ', '<p>\r\n	&nbsp;</p>\r\n<ul dir=\"ltr\">\r\n	<li dir=\"ltr\">\r\n		<pre>\r\n<b>Processor #1 Vendor: GenuineIntel\r\nProcessor #1 Name: Intel(R) Xeon(R) CPU           E5310  @ 1.60GHz\r\nProcessor #1 speed: 1600.089 MHz\r\nProcessor #1 cache size: 4096 KB\r\n\r\nProcessor #2 Vendor: GenuineIntel\r\nProcessor #2 Name: Intel(R) Xeon(R) CPU           E5310  @ 1.60GHz\r\nProcessor #2 speed: 1600.089 MHz\r\nProcessor #2 cache size: 4096 KB\r\n\r\nProcessor #3 Vendor: GenuineIntel\r\nProcessor #3 Name: Intel(R) Xeon(R) CPU           E5310  @ 1.60GHz\r\nProcessor #3 speed: 1600.089 MHz\r\nProcessor #3 cache size: 4096 KB\r\n\r\nProcessor #4 Vendor: GenuineIntel\r\nProcessor #4 Name: Intel(R) Xeon(R) CPU           E5310  @ 1.60GHz\r\nProcessor #4 speed: 1600.089 MHz\r\nProcessor #4 cache size: 4096 KB\r\n\r\nProcessor #5 Vendor: GenuineIntel\r\nProcessor #5 Name: Intel(R) Xeon(R) CPU           E5310  @ 1.60GHz\r\nProcessor #5 speed: 1600.089 MHz\r\nProcessor #5 cache size: 4096 KB\r\n\r\nProcessor #6 Vendor: GenuineIntel\r\nProcessor #6 Name: Intel(R) Xeon(R) CPU           E5310  @ 1.60GHz\r\nProcessor #6 speed: 1600.089 MHz\r\nProcessor #6 cache size: 4096 KB\r\n\r\nProcessor #7 Vendor: GenuineIntel\r\nProcessor #7 Name: Intel(R) Xeon(R) CPU           E5310  @ 1.60GHz\r\nProcessor #7 speed: 1600.089 MHz\r\nProcessor #7 cache size: 4096 KB\r\n\r\nProcessor #8 Vendor: GenuineIntel\r\nProcessor #8 Name: Intel(R) Xeon(R) CPU           E5310  @ 1.60GHz\r\nProcessor #8 speed: 1600.089 MHz\r\nProcessor #8 cache size: 4096 KB\r\n</b></pre>\r\n	</li>\r\n	<li dir=\"ltr\">\r\n		<p dir=\"ltr\">\r\n			<b>RAM : 4145688k</b></p>\r\n	</li>\r\n	<li dir=\"ltr\">\r\n		<p dir=\"ltr\">\r\n			<font color=\"#F5F5F5\"><b><font face=\"Tahoma\" style=\"FONT-SIZE: 11px\">System info : CentOS<br />\r\n			Direct Admin Final</font> </b></font></p>\r\n	</li>\r\n</ul>\r\n', 'Server,Config', 0, 0);");
massaggex("نصب با موفقیت انجام شد. برای ادامه <a href=\"$admin_file.php?op=xstatic\">اینجا</a> کلیک کنید.");
CloseAdminTable();
include("footer.php");
die();
}
$xmnvaa=="RC3";
if (extension_loaded('sockets') && function_exists('fsockopen') ){$xmnvaa=get_latest_xstaticverj();} 
if($xmnvaa=="RC3" OR $xmnvaa==""){}else{massaggex("<a href=\"http://www.phpnuke.ir/Forum/forum-f9/xstatic-t70995.html\">نسخه جدید ماژول Xstatic به ورژن $xmnvaa انتشار یافت !!!</a>");}
if(isset($xniniki) AND $xniniki=="emptycom"){
$db->sql_query("TRUNCATE TABLE `" . $prefix . "_staticpages_comments`");
massaggex("نظرات پاک سازی شد.");
}
if(isset($xniniki) AND $xniniki=="empty"){
$db->sql_query("TRUNCATE TABLE `" . $prefix . "_xstatic`");
massaggex("دیتابیس پاکسازی شد.");
}
if(isset($xniniki) AND $xniniki=="dele" AND isset($xsuid) AND $xsuid!==""){
$db->sql_query("DELETE FROM `$dbname`.`" . $prefix . "_xstatic` WHERE `" . $prefix . "_xstatic`.`xsid` = $xsuid");
massaggex("صفحه با موفقیت حذف شد.");
}
if(isset($xniniki) AND $xniniki=="edit" AND isset($xsuid) AND $xsuid!==""){
?><form action="<?php echo $admin_file; ?>.php" method="post">
<table align="center" border="0" cellpadding="4" cellspacing="4" width="100%" id="id-form">
<?php
$result = $db->sql_query("SELECT *
FROM `" . $prefix . "_xstatic`
WHERE `xsid` =$xsuid
LIMIT 0 , 1");
	while ($row = $db->sql_fetchrow($result)) {
	mb_internal_encoding('UTF-8');
	$exsid = intval($row['xsid']);
	$exssid = intval($row['xssid']);
	$exstitle = $row['xstitle'];
	$exstext = $row['xstext'];
	$exsgt = $row['xsgt'];
	$exstag = $row['xstags'];
	$exsred = $row['xredirect'];
	xlbitems($exssid,$exstitle,$exsgt,$exstext,$exstag,$exsid,$exsred);
}
?>
<tr><td><input class="form-submit" type='submit' value='ارسال'>
</td></tr>
<input type="hidden" name="xniniki" value="edited">
<input type="hidden" name="xnikiuid" value="<?php echo $exsid; ?>">
<input type="hidden" name="op" value="xstatic">
</table>
</form>
<?php
CloseAdminTable();
include("footer.php");
die();
}
if(isset($xniniki) AND $xniniki=="edited" AND isset($xstag) AND isset($xssid) AND isset($xstitle) AND isset($xstext) AND isset($xsgt) AND isset($xsred)){
if($xstitle=="" OR $xsgt=="" OR $xstag=="" OR (checkgxurcl($xnikiuid,$xsgt)==0 AND checkgxurl($xssid,$xsgt)>0)){
if(checkgxurcl($xnikiuid,$xsgt)==0 AND checkgxurl($xssid,$xsgt)>0){
massagrex("$xsgt در ". gettibyb($xssid) ." موجود می باشد ! لطفا از تگ برای آدرس دیگری استفاده کنید.");
}
if($xstitle==""){$xsnoptit="عنوان";}
if($xsgt==""){$xsnopgt="تگ برای آدرس";}
$xsnop="";
if(isset($xsnoptit)){$xsnop .="$xsnoptit - ";}
if(isset($xsnopgt)){$xsnop .="$xsnopgt - ";}
if($xstitle=="" OR $xsgt==""){massagrex("اطلاعات ناقص است ، لطفا فید های $xsnop را پر کنید.");}
?><form action="<?php echo $admin_file; ?>.php" method="post">
<table align="center" border="0" cellpadding="4" cellspacing="4" width="100%" id="id-form">
<?php
	xlbitems($xssid,$xstitle,$xsgt,$xstext,$xstag,$xnikiuid,$xsred);
?>
<tr><td><input class="form-submit" type='submit' value='ارسال'>
</td></tr>
<input type="hidden" name="xniniki" value="edited">
<input type="hidden" name="xnikiuid" value="<?php echo $xnikiuid; ?>">
<input type="hidden" name="op" value="xstatic">
</table>
</form>
<?php
CloseAdminTable();
include("footer.php");
die();
}else{
$db->sql_query("UPDATE `$dbname`.`" . $prefix . "_xstatic` SET `xssid` = '$xssid',
`xsgt` = '$xsgt',
`xstitle` = '$xstitle',
`xstext` = '$xstext',
`xstags` = '$xstag',
`xredirect` = '$xsred' WHERE `" . $prefix . "_xstatic`.`xsid` =$xnikiuid;");
massaggex("صفحه ویرایش شد.");
}
}
if(isset($xniniki) AND $xniniki=="send" AND isset($xstag) AND isset($xssid) AND isset($xstitle) AND isset($xstext) AND isset($xsgt) AND isset($xsred)){
if($xstitle=="" OR $xsgt=="" OR checkgxurl($xssid,$xsgt)>0){
if(checkgxurl($xssid,$xsgt)>0){
massagrex("$xsgt در ". gettibyb($xssid) ." موجود می باشد ! لطفا از تگ برای آدرس دیگری استفاده کنید.");
}
if($xstitle==""){$xsnoptit="عنوان";}
if($xsgt==""){$xsnopgt="تگ برای آدرس";}
$xsnop="";
if(isset($xsnoptit)){$xsnop .="$xsnoptit - ";}
if(isset($xsnopgt)){$xsnop .="$xsnopgt - ";}
massagrex("اطلاعات ناقص است ، لطفا فید های $xsnop را پر کنید.");
$senderror=1;
}else{
$db->sql_query("INSERT INTO `$dbname`.`" . $prefix . "_xstatic` (
`xsid` ,
`xssid` ,
`xsgt` ,
`xstitle` ,
`xstext` ,
`xstags` ,
`xscounter` ,
`xscomment`, 
`xredirect` 
)
VALUES (
NULL , '$xssid', '$xsgt', '$xstitle', '$xstext', '$xstag', '0', '0', '$xsred'
);");
massaggex("صفحه اضافه شد.");
}
}
?><center><font class="title"><b>مدیریت صفحات اضافی پیشرفته</b></font></center><br>
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
	<li><a href="#sendpage"><span>ایجاد صفحه</span></a></li>
	<li><a href="#managpages"><span>مدیریت صفحه ها</span></a></li>
	<li><a href="#xssetting"><span>اطلاعات ماژول</span></a></li>
	<li><a href="#xssettingg"><span>راهنما ماژول</span></a></li>
</ul>
<div id="sendpage">
<form action="<?php echo $admin_file; ?>.php" method="post">
<table align="center" border="0" cellpadding="4" cellspacing="4" width="100%" id="id-form">
<?php
if(isset($senderror)){
if($senderror==1){
xlbitems($xssid,$xstitle,$xsgt,$xstext,$xstag,'',$xsred);
}
}else{
xlbitems('','','','','','','');
}
?>
<tr><td><input class="form-submit" type='submit' value='ارسال'>
</td></tr>
<input type="hidden" name="xniniki" value="send">
<input type="hidden" name="op" value="xstatic">
</table>
</form>
</div>
<div id="managpages">
<table id="product-table" border="0" width="100%"><tr>
<th class="table-header-repeat line-left" style="text-align:center;width:40px;"><a>شمارنده</a></th>
<th class="table-header-repeat line-left" style="text-align:center;"><a>عنوان صفحه</a></th>
<th class="table-header-repeat line-left" style="text-align:center;"><a>تگ آدرس</a></th>
<th class="table-header-repeat line-left" style="text-align:center;"><a>در صفحه ی</a></th>
<th class="table-header-repeat line-left" style="text-align:center;width:90px;"><a>بازدید</a></th>
<th class="table-header-repeat line-left" style="text-align:center;width:90px;"><a>امکانات</a></th>
</tr><?php
$result = $db->sql_query("SELECT *
FROM `" . $prefix . "_xstatic`
ORDER BY `" . $prefix . "_xstatic`.`xsid` DESC
LIMIT 0 , 99999");
	while ($row = $db->sql_fetchrow($result)) {
	mb_internal_encoding('UTF-8');
	$xsid = intval($row['xsid']);
	$xssid = intval($row['xssid']);
	$xscounter = intval($row['xscounter']);
	$xstitle = $row['xstitle'];
	$xsgt = $row['xsgt'];
if($gtset==0){
$gtxsdsw="modules.php?name=Xstatic&xsurl=";
}else{
$gtxsdsw="Xstatic/";
}
	?><tr>
<td align="center" width="40"><?php echo $xsid; ?></td>
<td align="center" width="auto"><a href="<?php echo $gtxsdsw,getxslink($xsid); ?>"><?php echo $xstitle; ?></a></td>
<td align="center" width="auto"><?php echo $xsgt; ?></td>
<td align="center" width="auto"><?php echo gettibyb($xssid); ?></td>
<td align="center" width="auto"><?php echo $xscounter; ?></td>
<td align="center" width="auto">
	<a href="<?php echo $admin_file; ?>.php?op=xstatic&xniniki=dele&xsuid=<?php echo $xsid ; ?>" title="حذف صفحه" class="icon-2 info-tooltip"></a>
	<a href="<?php echo $admin_file; ?>.php?op=xstatic&xniniki=edit&xsuid=<?php echo $xsid ; ?>" title="ویرایش صفحه" class="icon-6 info-tooltip"></a>
</td><?php } ?>
</tr></table>
</div>
<div id="xssetting">
<div class="Table">
<div class="Contents">
				<div align="center">
					<table id="product-table" border="1" width="600">
						<tr>
							<th colspan="2" class="table-header-repeat line-left" style="text-align:center;"><a>مدیریت ماژول</a></th>
						</tr>
						<tr>
							<td style="width:50%;line-height:25px;">نسخه نصب شده صفحات اضافی پیشرفته</td>
							<td style="width:50%;line-height:25px;direction:ltr;">RC3</td>
						</tr>
						<tr>
							<td style="width:50%;line-height:25px;">آخرین نسخه انتشار یافته توسط <a href="http://www.xstar.ir/">Xstar</a></td>
							<td style="width:50%;line-height:25px;direction:ltr;"><?php if (extension_loaded('sockets') && function_exists('fsockopen') ){ echo get_latest_xstaticverj(); } ?></td>
						</tr>
						<tr>
							<td style="width:50%;line-height:25px;">تغییرات</td>
							<td style="width:50%;line-height:25px;direction:ltr;"><a href="http://www.phpnuke.ir/Forum/forum-f9/xstatic-t70995.html">view changlogs</a></td>
						</tr>
						<tr>
							<td style="width:50%;line-height:25px;">پاک کردن اطلاعات <?php echo $prefix ; ?>_staticpages_comments</td>
							<td style="width:50%;line-height:25px;direction:ltr;"><a href="<?php echo $admin_file; ?>.php?op=xstatic&xniniki=emptycom">Empty the table (TRUNCATE)</a></td>
						</tr>
						<tr>
							<td style="width:50%;line-height:25px;">پاک کردن اطلاعات <?php echo $prefix ; ?>_xstatic</td>
							<td style="width:50%;line-height:25px;direction:ltr;"><a href="<?php echo $admin_file; ?>.php?op=xstatic&xniniki=empty">Empty the table (TRUNCATE)</a></td>
						</tr>
					</table>
				</div>
				</div>
</div>
</div>
<div id="xssettingg">
<p>
	به نام خدا</p>
<p>
	به راهنمای ماژول صفحات اضافی پیشرفته خوش آمدید.</p>
<p>این ماژول طبق نیاز های پایه کاربرا طراحی شده است. شما در این ماژول می توانید بینهایت صفحه ایجاد کنید و زیر مجموعه صفحات دیگر ، ایجاد کنید.</p>
<p>
	در این راهنما چند نکته به شما توصیه می شود.</p>
<br><p>
	1- علائم مجاز در تگ برای آدرس ، (تمامی حروف بزرگ و کوچک انگلیسی) (اعداد) (حروف فارسی) (-) (_) (.)</p>
<br><p>
	2- در زیر مجموعه اصلی (root) و در هر زیر مجموعه ، تگ آدرس انحصاری تعریف کنید.</p>
<p>
	به طور مثال:</p>
<p style="direction:ltr;text-align:left;"><pre style="direction:ltr;text-align:left;">/page1/
/page1/sub1/
/page1/sub2/
/page2/
/page2/sub1/
/page2/sub2/
/page2/sub2/sub2/
</pre></p>
<br><p>
	3- برای استفاده از صفحات به صورت گوگل تب کد های زیر را در انتهای فایل .htaccess قرار دهید.</p>
<p style="direction:ltr;text-align:left;"><pre style="direction:ltr;text-align:left;">
#Xstatic
RewriteRule ^Xstatic/([a-zA-Z0-9-\s+_./-اآبپتثجچحخدذرزژسشصضطظعغفقكکگلمنوهیي-]*) modules.php?name=Xstatic&amp;xsurl=$1
RewriteRule ^Xstatic/ modules.php?name=Xstatic</p></pre>
<br><p>
	4- برای بهینه بودن ماژول سیستم نظرات صفحه اضافی پیشفرض نیوک به ماژول وصل شده است. برای جلوگیری از مشکل ، حتما یک بار در تب اطلاعات ماژول ، اطلاعات نظرات را پاک سازی کنید. همچنین برای تنظیمات نظرات به تنظیمات نیوک مراجعه نمایید.</p>

</div>
</div>
</div>
</div><?php
CloseAdminTable();
include ("footer.php");
}
switch ($op){
		default:
		xstatic();
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