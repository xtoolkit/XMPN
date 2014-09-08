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
			die("1.0 initial");
		}
		return "1.0 initial";
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
function xlbitems($item1,$item2,$item3,$item4,$item5,$item6){
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
<tr><td>متن صفحه</td><td><?php wysiwyg_textarea('xstext',$item4, 'Artikel', 50, 15); ?></td></tr>
<tr><td>کلمات کلیدی : </td><td><input name='xstag' value='<?php echo $item5; ?>' class="inp-form-ltr"></td></tr>
<?php
}
function gettibyb($nuim){
global $prefix, $db, $dbname;
$nuim=intval($nuim);
if($nuim==0){
$xstitle="";
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
function xstatic() {
	global $prefix, $db, $admin_file, $dbname, $sitename, $xniniki, $xnikiuid, $xsuid, $xssid, $xstitle, $xsgt, $xstext, $xstag;
include ("header.php");
GraphicAdmin();
OpenAdminTable();
$xmnvaa=="1.0 initial";
if (extension_loaded('sockets') && function_exists('fsockopen') ){$xmnvaa=get_latest_xstaticverj();} 
if($xmnvaa=="1.0 initial" OR $xmnvaa==""){}else{massaggex("<a href=\"http://www.phpnuke.ir/Forum/forum-f9/xstatic-t70995.html\">نسخه جدید ماژول Xstatic به ورژن $xmnvaa انتشار یافت !!!</a>");}
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
	xlbitems($exssid,$exstitle,$exsgt,$exstext,$exstag,$exsid);
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
die();
}
if(isset($xniniki) AND $xniniki=="edited" AND isset($xstag) AND isset($xssid) AND isset($xstitle) AND isset($xstext) AND isset($xsgt)){
if($xstitle=="" OR $xsgt=="" OR $xstext=="" OR $xstag==""){
if($xstag==""){$xsnoptag="کلمات کلیدی";}
if($xstitle==""){$xsnoptit="عنوان";}
if($xstext==""){$xsnoptex="متن";}
if($xsgt==""){$xsnopgt="تگ برای آدرس";}
//$xsnop="$xsnoptit - $xsnoptex - $xsnopgt - $xsnoptag";
$xsnop="";
if(isset($xsnoptit)){$xsnop .="$xsnoptit - ";}
if(isset($xsnoptex)){$xsnop .="$xsnoptex - ";}
if(isset($xsnopgt)){$xsnop .="$xsnopgt - ";}
if(isset($xsnoptag)){$xsnop .="$xsnoptag";}
massagrex("اطلاعات ناقص است ، لطفا فید های $xsnop را پر کنید.");
?><form action="<?php echo $admin_file; ?>.php" method="post">
<table align="center" border="0" cellpadding="4" cellspacing="4" width="100%" id="id-form">
<?php
	xlbitems($xssid,$xstitle,$xsgt,$xstext,$xstag,$xnikiuid);
?>
<tr><td><input class="form-submit" type='submit' value='ارسال'>
</td></tr>
<input type="hidden" name="xniniki" value="edited">
<input type="hidden" name="xnikiuid" value="<?php echo $xnikiuid; ?>">
<input type="hidden" name="op" value="xstatic">
</table>
</form>
<?php
die();
}else{
$db->sql_query("UPDATE `$dbname`.`" . $prefix . "_xstatic` SET `xssid` = '$xssid',
`xsgt` = '$xsgt',
`xstitle` = '$xstitle',
`xstext` = '$xstext',
`xstags` = '$xstag' WHERE `" . $prefix . "_xstatic`.`xsid` =$xnikiuid;");
massaggex("صفحه ویرایش شد.");
}
}
if(isset($xniniki) AND $xniniki=="send" AND isset($xstag) AND isset($xssid) AND isset($xstitle) AND isset($xstext) AND isset($xsgt)){
if($xstitle=="" OR $xsgt=="" OR $xstext=="" OR $xstag==""){
if($xstag==""){$xsnoptag="کلمات کلیدی";}
if($xstitle==""){$xsnoptit="عنوان";}
if($xstext==""){$xsnoptex="متن";}
if($xsgt==""){$xsnopgt="تگ برای آدرس";}
//$xsnop="$xsnoptit - $xsnoptex - $xsnopgt - $xsnoptag";
$xsnop="";
if(isset($xsnoptit)){$xsnop .="$xsnoptit - ";}
if(isset($xsnoptex)){$xsnop .="$xsnoptex - ";}
if(isset($xsnopgt)){$xsnop .="$xsnopgt - ";}
if(isset($xsnoptag)){$xsnop .="$xsnoptag";}
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
`xscomment` 
)
VALUES (
NULL , '$xssid', '$xsgt', '$xstitle', '$xstext', '$xstag', '0', '0'
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
xlbitems($xssid,$xstitle,$xsgt,$xstext,$xstag,'');
}
}else{
xlbitems('','','','','','');
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
	?><tr>
<td align="center" width="40"><?php echo $xsid; ?></td>
<td align="center" width="auto"><?php echo $xstitle; ?></td>
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
							<td style="width:50%;line-height:25px;direction:ltr;">1.0 initial</td>
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
RewriteRule ^Xstatic/([a-zA-Z0-9+_./-اآبپتثجچحخدذرزژسشصضطظعغفقكکگلمنوهیي-]*) modules.php?name=Xstatic&amp;xsurl=$1
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