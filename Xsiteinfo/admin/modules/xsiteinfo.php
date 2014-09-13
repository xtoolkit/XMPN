<?php

if (!defined('ADMIN_FILE')) {
	die ("Access Denied");
}

global $prefix, $db, $admin_file;
$aid = substr("$aid", 0,25);
$row1 = $db->sql_fetchrow($db->sql_query("SELECT name, radminsuper, aadminsuper FROM " . $prefix . "_authors WHERE aid='$aid'"));
if ($row1['aadminsuper'] == 1) {
	$filename =  basename(__FILE__);
	$filename = substr($filename,0,-4);
	$row = $db->sql_fetchrow($db->sql_query("SELECT * FROM " . $prefix . "_admins_menu WHERE atitle='$filename'"));
	$aadmins = $row['aadmins'];
	$aadmins = explode(",",$aadmins);
	if(in_array($row1['name'],$aadmins)){
		$yes = 1;
	}else{
		$yes = 0;
	}
}
if ($row1['radminsuper'] == 1 OR $yes == 1) {
function get_latest_xsiteinfoverj($mode=''){
	if (extension_loaded('sockets') && function_exists('fsockopen') ){
		if ($fsock = @fsockopen("www.xstar.ir", 80, $errno, $errstr, 10))
		{
			@fputs($fsock, "GET /xsiteinfoverj.txt HTTP/1.1\r\n");
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
			die("Initial1");
		}
		return "Initial1";
	}
}
function xsivs($nuim){
global $prefix, $db, $dbname;
$nuim=intval($nuim);
$result = $db->sql_query("SELECT * FROM `" . $prefix . "_xsiteinfo` WHERE `xsid` =$nuim LIMIT 0 , 1");
	while ($row = $db->sql_fetchrow($result)) {
	mb_internal_encoding('UTF-8');
	$xsvalue[0] = $row['xsid'];
	$xsvalue[1] = $row['xstag'];
	$xsvalue[2] = $row['xsname'];
	$xsvalue[3] = $row['xsvalue'];
}
return $xsvalue;
}
function xsudi($nuim){
global $prefix, $db, $dbname;
$nuim=intval($nuim);
$db->sql_query("DELETE FROM `$dbname`.`" . $prefix . "_xsiteinfo` WHERE `" . $prefix . "_xsiteinfo`.`xsid` = $nuim");
}
function xsedi($nuim,$xxvalue,$xxxvalue){
global $prefix, $db, $dbname;
$nuim=intval($nuim);
$db->sql_query("UPDATE `$dbname`.`" . $prefix . "_xsiteinfo` SET `xsname` = '$xxvalue',
`xsvalue` = '$xxxvalue' WHERE `" . $prefix . "_xsiteinfo`.`xsid` =$nuim;");
}
function xsins($xstag,$xsname,$xsvalue){
global $prefix, $db, $dbname;
$nuim=intval($nuim);
$db->sql_query("INSERT INTO `xs`.`nuke_xsiteinfo` (
`xsid` ,
`xstag` ,
`xsname` ,
`xsvalue`
)
VALUES (
NULL , '$xstag', '$xsname', '$xsvalue'
);");
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
function xsaform($item1,$item2,$item3,$item4,$item5){
	global $prefix, $db, $admin_file;
?><form action="<?php echo $admin_file; ?>.php#<?php echo $item5; ?>" method="post">
<table align="center" border="0" cellpadding="4" cellspacing="4" width="100%" id="id-form">
<tr><td style="width:250px;"><?php echo $item1; ?> (فید اصلی)</td><td><input name='xsaname' value='<?php echo $item2; ?>' class="inp-form-ltr"></td></tr>
<tr><td><?php echo $item3; ?> (مقدار فید)</td><td><?php if($item5=="customtext"){wysiwyg_textarea('xsavalue',$item4, 'Comments', 50, 15);}else{ ?><input name='xsavalue' value='<?php echo $item4; ?>' class="inp-form-ltr"><?php } ?></td></tr>
<input type="hidden" name="xsatag" value="<?php echo $item5; ?>">
<input type="hidden" name="op" value="xsiteinfo">
<tr><td><input class="form-submit" type='submit' value='ذخیره'>
</td></tr>
</table>
</form>
<table id="product-table" border="0" width="100%"><tr>
<th class="table-header-repeat line-left" style="text-align:center;width:40px;"><a>شمارنده</a></th>
<th class="table-header-repeat line-left" style="text-align:center;"><a><?php echo $item1; ?></a></th>
<th class="table-header-repeat line-left" style="text-align:center;"><a><?php echo $item3; ?></a></th>
<th class="table-header-repeat line-left" style="text-align:center;width:90px;"><a>امکانات</a></th>
</tr><?php
$result = $db->sql_query("SELECT *
FROM `" . $prefix . "_xsiteinfo`
WHERE `xstag` LIKE '$item5'
ORDER BY `" . $prefix . "_xsiteinfo`.`xsid` DESC
LIMIT 0 , 99999");
	while ($row = $db->sql_fetchrow($result)) {
	mb_internal_encoding('UTF-8');
	$xsid = intval($row['xsid']);
	$xstag = $row['xstag'];
	$xsname = $row['xsname'];
	$xsvalue = $row['xsvalue'];
if($item5=="customtext"){
	$xsvalue = strip_tags($xsvalue);
	$xsvalue = mb_substr($xsvalue, 0, 150) . '...';
}
	?><tr>
<td align="center" width="40"><?php echo $xsid; ?></td>
<td align="center" width="auto"><?php echo $xsname; ?></td>
<td align="center" width="auto"><?php echo $xsvalue; ?></td>
<td align="center" width="90px">
	<a href="<?php echo $admin_file; ?>.php?op=xsiteinfo&xnikis=dele&xsid=<?php echo $xsid ; ?>" title="حذف آیتم" class="icon-2 info-tooltip"></a>
	<a href="<?php echo $admin_file; ?>.php?op=xsiteinfo&xnikis=edit&xsid=<?php echo $xsid ; ?>" title="ویرایش آیتم" class="icon-6 info-tooltip"></a>
</td><?php } ?>
</tr></table><?php
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
function xsiteinfo() {
	global $bgcolor2, $prefix, $db, $admin_file, $dbname, $xnikis, $xsatag, $xsaname, $xsavalue, $xsid;
include ("header.php");
GraphicAdmin();
OpenAdminTable();
$xmnvaa=="Initial1";
if (extension_loaded('sockets') && function_exists('fsockopen') ){ $xmnvaa=get_latest_xsiteinfoverj(); } 
if($xmnvaa=="Initial1"){}else{massaggex("<a href=\"http://www.phpnuke.ir/Forum/forum-f9/xsiteinfo-t70969.html\">نسخه جدید سیستم xsiteinfo به ورژن $xmnvaa انتشار یافت !!!</a>");}
$dfsdfsd = $db->sql_numrows($db->sql_query("SELECT *
FROM `" . $prefix . "_xsiteinfo`
LIMIT 0 , 3"));
if($dfsdfsd>0){}else{
$db->sql_query("CREATE TABLE IF NOT EXISTS `" . $prefix . "_xsiteinfo` (
  `xsid` int(11) NOT NULL AUTO_INCREMENT,
  `xstag` text NOT NULL,
  `xsname` text NOT NULL,
  `xsvalue` text NOT NULL,
  PRIMARY KEY (`xsid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;");
xsins('powered', 'by', 'xstar');
xsins('booksmark', 'twitter', 'https://twitter.com/HichkasOfficial');
xsins('booksmark', 'facebook', 'https://www.fb.com/folan');
xsins('booksmark', 'linkedin', 'http://ir.linkedin.com/pub/number');
xsins('booksmark', 'cloob', 'http://www.cloob.com/name/yourname');
xsins('booksmark', 'googleplus', 'https://plus.google.com/108515851566157817652');
xsins('customtitle', 'footer-block-right', 'پیشنهادات');
xsins('customtitle', 'product-select1', 'کتاب های درسی');
xsins('customtext', 'successfully-send-massage', '<p style="text-align: center;"><strong>ایمیل </strong>شما با موفقیت <span style="color:#00ff00;">ارسال </span>شد !!<img alt="enlightened" height="20" src="http://localhost/Xs/includes/ckeditor/plugins/smiley/images/lightbulb.gif" title="enlightened" width="20" />(منتظر پاسخ ما باشی)</p>');
xsins('customtext', 'error-bad-mail-massage', '<p style="text-align: center;"><span style="color:#ff0000;">ایمیل خود را درست وارد کنید <img alt="enlightened" height="20" src="http://localhost/Xs/includes/ckeditor/plugins/smiley/images/lightbulb.gif" title="enlightened" width="20" />(مانند : info@xstar.ir)</span></p>');
xsins('customimage', 'logo', 'images/logo.png');
xsins('customimage', 'background', 'http://www.example.com/bg.jpg');
xsins('informations', 'mobile-num', '00989350000000');
xsins('informations', 'tell-num', '00981310000000');
xsins('informations', 'first-name', 'مهدی');
xsins('informations', 'last-name', 'حسین زاده');
xsins('informations', 'company', 'xstar');
xsins('informations', 'adress', 'ایران - گیلان - رشت - میدان مصلی - پلاک 530');
xsins('customposition', 'footer-block-left', '3');
xsins('customposition', 'blocks-right-top', '1');
xsins('customposition', 'header-slider', '2');
xsins('customtopic', 'blocks-left-tow', '5');
xsins('customtopic', 'index-mainslider', '6');
xsins('customtools', 'hidden-search', '0');
xsins('customtools', 'hidden-mapadress', '1');
xsins('customtools', 'hidden-smartphone-switch', '0');
xsins('customtools', 'hidden-centerblock-slider', '1');
massaggex("نصب مود اطالاعات اضافی ، با موفقیت نصب شد.");
}
if(isset($xsatag) AND isset($xsaname) AND isset($xsavalue)){
$xserror1check = $db->sql_numrows($db->sql_query("SELECT *
FROM `" . $prefix . "_xsiteinfo`
WHERE `xstag` = '$xsatag'
AND `xsname` = '$xsaname'
AND `xsvalue` = '$xsavalue'
LIMIT 0 , 2"));
$xserror2check = $db->sql_numrows($db->sql_query("SELECT *
FROM `" . $prefix . "_xsiteinfo`
WHERE `xstag` = '$xsatag'
AND `xsname` = '$xsaname'
LIMIT 0 , 2"));
if($xsatag=="customtext"){
$xsvavalue = strip_tags($xsavalue);
$xsvavalue = mb_substr($xsvavalue, 0, 150) . '...';
}else{
$xsvavalue=$xsavalue;
}
if($xserror1check>0){
massagrex("آیتم $xsvavalue در $xsaname وجود دارد!!!");
}elseif($xserror2check>0){
massagrex("$xsaname وجود دارد!!!");
}else{
if($xsaname==""){
massagrex("فید اصلی خالی است !!");
$xiserror=1;
}else{
xsins($xsatag,$xsaname,$xsavalue);
massaggex("$xsvavalue با موفقیت در $xsaname ثبت شد.");
}
}
}
if(isset($xnikis) AND $xnikis=="dele" AND isset($xsid) AND $xsid!==""){
$xsinfoitem=xsivs($xsid);
$xsinfoitem3=$xsinfoitem[2];
$xsinfoitem4=$xsinfoitem[3];
xsudi($xsid);
massaggex("$xsinfoitem4 در $xsinfoitem3 با موفقیت حذف گردید.");
}
if(isset($xnikis) AND $xnikis=="edit" AND isset($xsid) AND $xsid!==""){
$xsinfoitem=xsivs($xsid);
$xsinfoitem1=$xsinfoitem[0];
$xsinfoitem2=$xsinfoitem[1];
$xsinfoitem3=$xsinfoitem[2];
$xsinfoitem4=$xsinfoitem[3];
?><center><font class="title"><b>ویرایش آیتم</b></font></center><br>
<form action="<?php echo $admin_file; ?>.php#<?php echo $xsinfoitem2; ?>" method="post">
<table align="center" border="0" cellpadding="4" cellspacing="4" width="100%" id="id-form">
<tr><td style="width:250px;">(فید اصلی)</td><td><input name='xsaname' value='<?php echo $xsinfoitem3; ?>' class="inp-form-ltr"></td></tr>
<tr><td>(مقدار فید)</td><td><?php if($xsinfoitem2=="customtext"){wysiwyg_textarea('xsavalue',$xsinfoitem4, 'Comments', 50, 15);}else{ ?><input name='xsavalue' value='<?php echo $xsinfoitem4; ?>' class="inp-form-ltr"><?php } ?></td></tr>
<input type="hidden" name="xsid" value="<?php echo $xsinfoitem1; ?>">
<input type="hidden" name="xnikis" value="edited">
<input type="hidden" name="op" value="xsiteinfo">
<tr><td><input class="form-submit" type='submit' value='ذخیره'>
</td></tr>
</table>
</form>
<?php
die();
}
if(isset($xnikis) AND $xnikis=="edited" AND isset($xsaname) AND isset($xsavalue) AND isset($xsid) AND $xsid!==""){
$xsinfoitem=xsivs($xsid);
$xsinfoitem1=$xsinfoitem[0];
$xsinfoitem2=$xsinfoitem[1];
$xsinfoitem3=$xsinfoitem[2];
$xsinfoitem4=$xsinfoitem[3];
if($xsaname==""){
massagrex("فید اصلی خالی است !!");
?><center><font class="title"><b>ویرایش آیتم</b></font></center><br>
<form action="<?php echo $admin_file; ?>.php#<?php echo $xsinfoitem2; ?>" method="post">
<table align="center" border="0" cellpadding="4" cellspacing="4" width="100%" id="id-form">
<tr><td style="width:250px;">(فید اصلی)</td><td><input name='xsaname' value='<?php echo $xsinfoitem3; ?>' class="inp-form-ltr"></td></tr>
<tr><td>(مقدار فید)</td><td><?php if($xsinfoitem2=="customtext"){wysiwyg_textarea('xsavalue',$xsinfoitem4, 'Comments', 50, 15);}else{ ?><input name='xsavalue' value='<?php echo $xsinfoitem4; ?>' class="inp-form-ltr"><?php } ?></td></tr>
<input type="hidden" name="xsid" value="<?php echo $xsinfoitem1; ?>">
<input type="hidden" name="xnikis" value="edited">
<input type="hidden" name="op" value="xsiteinfo">
<tr><td><input class="form-submit" type='submit' value='ذخیره'>
</td></tr>
</table>
</form>
<?php
die();
}else{
if($xsinfoitem2=="customtext"){
$xsvavalue = strip_tags($xsavalue);
$xsvavalue = mb_substr($xsvavalue, 0, 150) . '...';
}else{
$xsvavalue=$xsavalue;
}
xsedi($xsid,$xsaname,$xsavalue);
massaggex("$xsvavalue با موفقیت در $xsaname ویرایش شد.");
}
}
?><center><font class="title"><b>اطلاعات اضافی</b></font></center><br>
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
	<li><a href="#booksmark"><span>شبکه های اجتماعی</span></a></li>
	<li><a href="#customtitle"><span>عنوان های سفارشی</span></a></li>
	<li><a href="#customtext"><span>متن های سفارشی</span></a></li>
	<li><a href="#customimage"><span>عکس های سفارشی</span></a></li>
	<li><a href="#informations"><span>اطلاعات عمومی</span></a></li>
	<li><a href="#customposition"><span>موقعیت های سفارشی</span></a></li>
	<li><a href="#customtopic"><span>موضوعات سفارشی</span></a></li>
	<li><a href="#customtools"><span>تنظیمات سفارشی</span></a></li>
	<li><a href="#xsiteinfomanag"><span>اطلاعات مود</span></a></li>
	<li><a href="#xsiteinfohelp"><span>راهنما</span></a></li>
</ul>
<div id="booksmark">
<?php
if($xiserror==1){
xsaform("شبکه اجتماعی",$xsaname,"لینک شما در شبکه اجتماعی",$xsavalue,"booksmark");
}else{
xsaform("شبکه اجتماعی","","لینک شما در شبکه اجتماعی","","booksmark");
}
?>
</div>
<div id="customtitle">
<?php
if($xiserror==1){
xsaform("نام عنوان مورد نظر",$xsaname,"عنوان مورد نظر",$xsavalue,"customtitle");
}else{
xsaform("نام عنوان مورد نظر","","عنوان مورد نظر","","customtitle");
}
?>
</div>
<div id="customtext">
<?php
if($xiserror==1){
xsaform("نام متن مورد نظر",$xsaname,"متن مورد نظر",$xsavalue,"customtext");
}else{
xsaform("نام متن مورد نظر","","متن مورد نظر","","customtext");
}
?>
</div>
<div id="customimage">
<?php
if($xiserror==1){
xsaform("نام عکس مورد نظر",$xsaname,"لینک عکس",$xsavalue,"customimage");
}else{
xsaform("نام عکس مورد نظر","","لینک عکس","","customimage");
}
?>
</div>
<div id="informations">
<?php
if($xiserror==1){
xsaform("عنوان مورد اطلاع",$xsaname,"اطلاعات مربوطه",$xsavalue,"informations");
}else{
xsaform("عنوان مورد اطلاع","","اطلاعات مربوطه","","informations");
}
?>
</div>
<div id="customposition">
<?php
if($xiserror==1){
xsaform("عنوان بخش موقعیت",$xsaname,"آی دی موقعیت دلخواه",$xsavalue,"customposition");
}else{
xsaform("عنوان بخش موقعیت","","آی دی موقعیت دلخواه","","customposition");
}
?>
</div>
<div id="customtopic">
<?php
if($xiserror==1){
xsaform("عنوان بخش موضوع",$xsaname,"آی دی موضوع دلخواه",$xsavalue,"customtopic");
}else{
xsaform("عنوان بخش موضوع","","آی دی موضوع دلخواه","","customtopic");
}
?>
</div>
<div id="customtools">
<?php
if($xiserror==1){
xsaform("عنوان تنظیمات",$xsaname,"مقدار تنظیم برای تنظیم",$xsavalue,"customtools");
}else{
xsaform("عنوان تنظیمات","","مقدار تنظیم برای تنظیم","","customtools");
}
?>
</div>
<div id="xsiteinfomanag">
<div class="Table">
<div class="Contents">
				<div align="center">
					<table id="product-table" border="1" width="600">
						<tr>
							<th colspan="2" class="table-header-repeat line-left" style="text-align:center;"><a>مدیریت سیستم</a></th>
						</tr>
						<tr>
							<td style="width:50%;line-height:25px;">نسخه نصب شده</td>
							<td style="width:50%;line-height:25px;direction:ltr;">Initial1</td>
						</tr>
						<tr>
							<td style="width:50%;line-height:25px;">آخرین نسخه انتشار یافته توسط <a href="http://www.xstar.ir/">Xstar</a></td>
							<td style="width:50%;line-height:25px;direction:ltr;"><?php if (extension_loaded('sockets') && function_exists('fsockopen') ){ echo get_latest_xsiteinfoverj(); } ?></td>
						</tr>
						<tr>
							<td style="width:50%;line-height:25px;">تغییرات</td>
							<td style="width:50%;line-height:25px;direction:ltr;"><a href="http://www.phpnuke.ir/Forum/forum-f9/xsiteinfo-t70969.html">view changlogs</a></td>
						</tr>
					</table>
				</div>
				</div>
</div>
</div>
<div id="xsiteinfohelp">راهما</div>
</div>
</div>
</div><?php
CloseAdminTable();
include ("footer.php");
}

switch($op) {
	case "xsiteinfo":
		xsiteinfo();
	break;
}

} else {
	header("location: ".$admin_file.".php");
}
?>