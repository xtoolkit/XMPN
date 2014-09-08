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
function get_latest_xdisableverj($mode=''){
	if (extension_loaded('sockets') && function_exists('fsockopen') ){
		if ($fsock = @fsockopen("www.xstar.ir", 80, $errno, $errstr, 10))
		{
			@fputs($fsock, "GET /xdisableverj.txt HTTP/1.1\r\n");
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
			die("1.1.1 beta");
		}
		return "1.1.1 beta";
	}
}
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
function xduemailsd($nuim){
global $prefix, $db, $dbname;
$nuim=intval($nuim);
$db->sql_query("DELETE FROM `$dbname`.`" . $prefix . "_xdisable` WHERE `" . $prefix . "_xdisable`.`xdid` = $nuim");
}
function xdieus($nuim,$xxvalue){
global $prefix, $db, $dbname;
$nuim=intval($nuim);
$db->sql_query("UPDATE `$dbname`.`" . $prefix . "_xdisable` SET `xdvalue` = '$xxvalue' WHERE `" . $prefix . "_xdisable`.`xdid` =$nuim;");
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
function xdisable() {
	global $bgcolor2, $prefix, $db, $admin_file, $dbname, $xdisablex, $xdnotify, $xdmin, $xdhour, $xdday, $xdmoon, $xdyear, $xdtheme, $xdtitle, $xddes, $xdtlogo, $xdsfb, $xdstt, $xdsgp, $xdsli, $xdid, $com, $xdetit, $xdedes, $adminmail, $sitename;
include ("header.php");
GraphicAdmin();
OpenAdminTable();
$xmnvaa=="1.1.1 beta";
if (extension_loaded('sockets') && function_exists('fsockopen') ){ $xmnvaa=get_latest_xdisableverj(); } 
if($xmnvaa=="1.1.1 beta"){}else{massaggex("<a href=\"http://www.phpnuke.ir/Forum/forum-f9/xdisable-t70969.html\">نسخه جدید سیستم xmenu به ورژن $xmnvaa انتشار یافت !!!</a>");}
?><center><font class="title"><b>غیر فعال کنند سیستم نیوک</b></font></center><br>
<?php
if(isset($xdisablex) AND isset($xdnotify) AND isset($xdmin) AND isset($xdhour) AND isset($xdday) AND isset($xdmoon) AND isset($xdyear) AND isset($xdtheme) AND isset($xdtitle) AND isset($xddes) AND isset($xdtlogo) AND isset($xdsfb) AND isset($xdstt) AND isset($xdsgp) AND isset($xdsli)){
xdieus(1,$xdisablex);
xdieus(2,$xdtheme);
xdieus(3,$xdtitle);
xdieus(4,$xddes);
xdieus(5,$xdyear);
xdieus(6,$xdmoon);
xdieus(7,$xdday);
xdieus(8,$xdhour);
xdieus(9,$xdmin);
xdieus(10,$xdnotify);
xdieus(11,$xdsfb);
xdieus(12,$xdstt);
xdieus(13,$xdsgp);
xdieus(14,$xdsli);
xdieus(15,$xdtlogo);
massaggex("تغییرات با موفقیت انجام شد.");
}
if($com=="dele" AND isset($xdid)){
xduemailsd($xdid);
massaggex("ایمیل با موفقیت حذف گردید.");
}
if(isset($xdetit) AND isset($xdedes)){
$resulft = $db->sql_query("SELECT *
FROM `" . $prefix . "_xdisable`
WHERE `xdname` LIKE 'xduemail'
ORDER BY `" . $prefix . "_xdisable`.`xdid` DESC
LIMIT 0 , 99999");
	while ($roaw = $db->sql_fetchrow($resulft)) {
	mb_internal_encoding('UTF-8');
	$xdvaluse = $roaw['xdvalue'];
	$xdokem=phpnuke_mail($xdvaluse,$xdetit,$xdedes,$adminmail,$sitename);
	if($xdokem){massaggex("ایمیل با موفقیت ارسال شد.");}
}
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
	<li><a href="#admindisable"><span>مدیریت سیستم</span></a></li>
	<li><a href="#xdemain"><span>ایمیل های ثبت شده</span></a></li>
	<li><a href="#xdnutfe"><span>اعلام بازگشایی</span></a></li>
	<li><a href="#menusetting"><span>اطلاعات سیستم</span></a></li>
</ul>
<div id="admindisable">
<form action="<?php echo $admin_file; ?>.php" method="post">
<table align="center" border="0" cellpadding="4" cellspacing="4" width="100%" id="id-form">
<tr><th style="width:250px">غیر فعال کردن نیوک</th><td>بلی <input name="xdisablex" type="radio" class="styled" value="1" <?php if(xdvs(1)==1){ ?>checked<?php } ?>> &nbsp;&nbsp; خیر <input name="xdisablex" type="radio" class="styled" value="0" <?php if(xdvs(1)==0){ ?>checked<?php } ?>></td></tr>
<tr><th>فعال کردن ثبت ایمیل</th><td>بلی <input name="xdnotify" type="radio" class="styled" value="1" <?php if(xdvs(10)==1){ ?>checked<?php } ?>> &nbsp;&nbsp; خیر <input name="xdnotify" type="radio" class="styled" value="0" <?php if(xdvs(10)==0){ ?>checked<?php } ?>></td></tr>
<tr><th>زمان باز گشایی</th>
<td><select name="xdmin" class="styledselect-select">
<?php 
for ($i=00; $i < 60; $i++) {
echo "	<option value='$i' "; if(xdvs(9)==$i){ echo"selected"; } echo">$i</option>\n";
}
?>
</select> : <select name="xdhour" class="styledselect-select">
<?php 
for ($i=00; $i < 24; $i++) {
echo "	<option value='$i' "; if(xdvs(8)==$i){ echo"selected"; } echo">$i</option>\n";
}
?>
</select> - <select name="xdday" class="styledselect-select">
<?php 
for ($i=01; $i < 32; $i++) {
echo "	<option value='$i' "; if(xdvs(7)==$i){ echo"selected"; } echo">$i</option>\n";
}
?>
</select> / <select name="xdmoon" class="styledselect-select">
<?php 
for ($i=01; $i < 13; $i++) {
echo "	<option value='$i' "; if(xdvs(6)==$i){ echo"selected"; } echo">$i</option>\n";
}
?>
</select> / <select name="xdyear" class="styledselect-select">
<?php 
for ($i=2014; $i < 2099; $i++) {
echo "	<option value='$i' "; if(xdvs(5)==$i){ echo"selected"; } echo">$i</option>\n";
}
?>
</select></td>
</tr>
<tr><th>قالب غیر فعال سازی</th><td><select name="xdtheme" class="styledselect-select">
	<option value="default" titile="(باید تابع xdisable_theme در theme.php وجود داشته باشد)" <?php if(xdvs(2)=="default"){ echo"selected"; } ?>>استفاده از تابع پوسته سایت </option>
<?php
		$handle=opendir("includes/xdisable/");
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
				echo "	<option value='$themelist[$i]' "; if(xdvs(2)==$themelist[$i]){ echo"selected"; } echo">$themelist[$i]</option>\n";
			}
		}
?>
</select></td></tr>
<tr><td>facebook</td><td><input name='xdsfb' value='<?php echo xdvs(11); ?>' class="inp-form-ltr"></td></tr>
<tr><td>twitter</td><td><input name='xdstt' value='<?php echo xdvs(12); ?>' class="inp-form-ltr"></td></tr>
<tr><td>google plus</td><td><input name='xdsgp' value='<?php echo xdvs(13); ?>' class="inp-form-ltr"></td></tr>
<tr><td>linkedin</td><td><input name='xdsli' value='<?php echo xdvs(14); ?>' class="inp-form-ltr"></td></tr>
<tr><td>لوگو سایت</td><td><input name='xdtlogo' value='<?php echo xdvs(15); ?>' class="inp-form-ltr"></td></tr>
<tr><td>عنوان غیر فعال ساز</td><td><input name='xdtitle' value='<?php echo xdvs(3); ?>' class="inp-form-ltr"></td></tr>
<tr><td>متن شما برای غیر فعال سازی</td><td><?php wysiwyg_textarea('xddes',xdvs(4), 'Comments', 50, 15); ?></td></tr>
<tr><td><input class="form-submit" type='submit' value='ذخیره'>
</td></tr>
<input type="hidden" name="op" value="xdisable">
</table>
</form>
</div>
<div id="xdemain">
<table id="product-table" border="0" width="100%"><tr>
<th class="table-header-repeat line-left" style="text-align:center;width:40px;"><a>شمارنده</a></th>
<th class="table-header-repeat line-left" style="text-align:center;"><a>ایمیل</a></th>
<th class="table-header-repeat line-left" style="text-align:center;width:50px;"><a>حذف</a></th>
</tr><?php
$result = $db->sql_query("SELECT *
FROM `" . $prefix . "_xdisable`
WHERE `xdname` LIKE 'xduemail'
ORDER BY `" . $prefix . "_xdisable`.`xdid` DESC
LIMIT 0 , 99999");
	while ($row = $db->sql_fetchrow($result)) {
	mb_internal_encoding('UTF-8');
	$xdid = intval($row['xdid']);
	$xdvalue = $row['xdvalue'];
	?><tr>
<td align="center" width="40"><?php echo $xdid; ?></td>
<td align="center" width="auto"><?php echo $xdvalue; ?></td>
<td align="center" width="50px">
	<a href="<?php echo $admin_file; ?>.php?op=xdisable&com=dele&xdid=<?php echo $xdid ; ?>" title="حذف ایمیل" class="icon-2 info-tooltip"></a>
</td><?php } ?>
</tr></table>
</div>
<div id="xdnutfe">
<form action="<?php echo $admin_file; ?>.php" method="post">
<table align="center" border="0" cellpadding="4" cellspacing="4" width="100%" id="id-form">
<tr><td>عنوان ایمیل</td><td><input name='xdetit' value='' class="inp-form-ltr"></td></tr>
<tr><td>متن ایمیل</td><td><?php wysiwyg_textarea('xdedes','', 'Comments', 50, 15); ?></td></tr>
<tr><td><input class="form-submit" type='submit' value='ارسال به ایمیل های ثبت شده'>
</td></tr>
<input type="hidden" name="op" value="xdisable">
</table>
</form>
</div>
<div id="menusetting">
<div class="Table">
<div class="Contents">
				<div align="center">
					<table id="product-table" border="1" width="600">
						<tr>
							<th colspan="2" class="table-header-repeat line-left" style="text-align:center;"><a>مدیریت سیستم</a></th>
						</tr>
						<tr>
							<td style="width:50%;line-height:25px;">نسخه نصب شده غیر فعال کننده نیوک</td>
							<td style="width:50%;line-height:25px;direction:ltr;">1.1.1 beta</td>
						</tr>
						<tr>
							<td style="width:50%;line-height:25px;">آخرین نسخه انتشار یافته توسط <a href="http://www.xstar.ir/">Xstar</a></td>
							<td style="width:50%;line-height:25px;direction:ltr;"><?php if (extension_loaded('sockets') && function_exists('fsockopen') ){ echo get_latest_xdisableverj(); } ?></td>
						</tr>
						<tr>
							<td style="width:50%;line-height:25px;">تغییرات</td>
							<td style="width:50%;line-height:25px;direction:ltr;"><a href="http://www.phpnuke.ir/Forum/forum-f9/xdisable-t70969.html">view changlogs</a></td>
						</tr>
					</table>
				</div>
				</div>
</div>
</div>
</div>
</div>
</div><?php
CloseAdminTable();
include ("footer.php");
}

switch($op) {
	case "xdisable":
		xdisable();
	break;
}

} else {
	header("location: ".$admin_file.".php");
}
?>