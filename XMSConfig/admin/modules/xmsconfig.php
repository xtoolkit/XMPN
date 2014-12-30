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
function get_latest_xmsconfigverj($mode=''){
	if (extension_loaded('sockets') && function_exists('fsockopen') ){
		if ($fsock = @fsockopen("www.xstar.ir", 80, $errno, $errstr, 10))
		{
			@fputs($fsock, "GET /xmsconfigverj.txt HTTP/1.1\r\n");
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
			die("Beta2");
		}
		return "Beta2";
	}
}
function xsivs($nuim){
global $prefix, $db, $dbname;
$nuim=intval($nuim);
$result = $db->sql_query("SELECT * FROM `" . $prefix . "_xmsconfig` WHERE `xsid` =$nuim LIMIT 0 , 1");
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
$db->sql_query("DELETE FROM `$dbname`.`" . $prefix . "_xmsconfig` WHERE `" . $prefix . "_xmsconfig`.`xsid` = $nuim");
}
function xsedi($nuim,$xxvalue,$xxxvalue){
global $prefix, $db, $dbname;
$nuim=intval($nuim);
$db->sql_query("UPDATE `$dbname`.`" . $prefix . "_xmsconfig` SET `xsname` = '$xxvalue',
`xsvalue` = '$xxxvalue' WHERE `" . $prefix . "_xmsconfig`.`xsid` =$nuim;");
}
function xsins($xstag,$xsname,$xsvalue){
global $prefix, $db, $dbname;
$nuim=intval($nuim);

$db->sql_query("INSERT INTO `$dbname`.`" . $prefix . "_xmsconfig` (
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
?><div id="<?php echo $item5; ?>">
<form action="<?php echo $admin_file; ?>.php#<?php echo $item5; ?>" method="post">
<table align="center" border="0" cellpadding="4" cellspacing="4" width="100%" id="id-form">
<tr><td style="width:250px;"><?php echo $item1; ?> (فید اصلی)</td><td><input name='xsaname' value='<?php echo $item2; ?>' class="inp-form-ltr"></td></tr>
<tr><td><?php echo $item3; ?> (مقدار فید)</td><td><?php if($item5=="textarea"){wysiwyg_textarea('xsavalue',$item4, 'Comments', 50, 15);}else{ ?><input name='xsavalue' value='<?php echo $item4; ?>' class="inp-form-ltr"><?php } ?></td></tr>
<input type="hidden" name="xsatag" value="<?php echo $item5; ?>">
<input type="hidden" name="op" value="xmsconfig">
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
FROM `" . $prefix . "_xmsconfig`
WHERE `xstag` LIKE '$item5'
ORDER BY `" . $prefix . "_xmsconfig`.`xsid` DESC
LIMIT 0 , 99999");
	while ($row = $db->sql_fetchrow($result)) {
	mb_internal_encoding('UTF-8');
	$xsid = intval($row['xsid']);
	$xstag = $row['xstag'];
	$xsname = $row['xsname'];
	$xsvalue = $row['xsvalue'];
if($item5=="textarea"){
	$xsvalue = strip_tags($xsvalue);
	$xsvalue = mb_substr($xsvalue, 0, 150) . '...';
}
	?><tr>
<td align="center" width="40"><?php echo $xsid; ?></td>
<td align="center" width="auto"><?php echo $xsname; ?></td>
<td align="center" width="auto"><?php echo $xsvalue; ?></td>
<td align="center" width="90px">
	<a href="<?php echo $admin_file; ?>.php?op=xmsconfig&xnikis=dele&xsid=<?php echo $xsid ; ?>" title="حذف آیتم" class="icon-2 info-tooltip"></a>
	<a href="<?php echo $admin_file; ?>.php?op=xmsconfig&xnikis=edit&xsid=<?php echo $xsid ; ?>" title="ویرایش آیتم" class="icon-6 info-tooltip"></a>
</td><?php } ?>
</tr></table>
</div><?php
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
function xmsconfig() {
	global $bgcolor2, $prefix, $db, $admin_file, $dbname, $xnikis, $xsatag, $xsaname, $xsavalue, $xsid;
include ("header.php");
GraphicAdmin();
OpenAdminTable();
$xmnvaa=="Beta2";
if (extension_loaded('sockets') && function_exists('fsockopen') ){ $xmnvaa=get_latest_xmsconfigverj(); } 
if($xmnvaa=="Beta2"){}else{massaggex("<a href=\"http://www.phpnuke.ir/Forum/forum-f9/xmsconfig-t71012.html\">نسخه جدید سیستم xmsconfig به ورژن $xmnvaa انتشار یافت !!!</a>");}
$dfsdfsd = $db->sql_numrows($db->sql_query("SELECT *
FROM `" . $prefix . "_xmsconfig`
LIMIT 0 , 3"));
if($dfsdfsd>0){}else{
$db->sql_query("CREATE TABLE IF NOT EXISTS `" . $prefix . "_xmsconfig` (
  `xsid` int(11) NOT NULL AUTO_INCREMENT,
  `xstag` text NOT NULL,
  `xsname` text NOT NULL,
  `xsvalue` text NOT NULL,
  PRIMARY KEY (`xsid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;");
xsins('powered', 'by', 'xstar');
xsins('text', 'twitter', 'https://twitter.com/HichkasOfficial');
xsins('text', 'facebook', 'https://www.fb.com/folan');
xsins('text', 'linkedin', 'http://ir.linkedin.com/pub/number');
xsins('text', 'cloob', 'http://www.cloob.com/name/yourname');
xsins('text', 'googleplus', 'https://plus.google.com/108515851566157817652');
xsins('text', 'footer-block-right', 'پیشنهادات');
xsins('text', 'product-select1', 'کتاب های درسی');
xsins('textarea', 'successfully-send-massage', '<p style="text-align: center;"><strong>ایمیل </strong>شما با موفقیت <span style="color:#00ff00;">ارسال </span>شد !!<img alt="enlightened" height="20" src="http://localhost/Xs/includes/ckeditor/plugins/smiley/images/lightbulb.gif" title="enlightened" width="20" />(منتظر پاسخ ما باشی)</p>');
xsins('textarea', 'error-bad-mail-massage', '<p style="text-align: center;"><span style="color:#ff0000;">ایمیل خود را درست وارد کنید <img alt="enlightened" height="20" src="http://localhost/Xs/includes/ckeditor/plugins/smiley/images/lightbulb.gif" title="enlightened" width="20" />(مانند : info@xstar.ir)</span></p>');
xsins('text', 'logo', 'http://www.example.com/logo2.png');
xsins('text', 'background', 'images/bg1.jpg');
xsins('text', 'mobile-num', '00989350000000');
xsins('text', 'tell-num', '00981310000000');
xsins('text', 'first-name', 'مهدی');
xsins('text', 'last-name', 'حسین زاده');
xsins('text', 'company', 'xstar');
xsins('text', 'adress', 'ایران - گیلان - رشت - میدان مصلی');
xsins('select', 'footer-block-left', '3');
xsins('select', 'blocks-right-top', '1');
xsins('select', 'header-slider', '2');
xsins('select', 'blocks-left-tow', '5');
xsins('select', 'index-mainslider', '6');
xsins('checkbox', 'موضوعات درون اسلایدر', '6,2,1,5');
xsins('radius', 'hidden-search', '0');
xsins('radius', 'hidden-mapadress', '1');
xsins('radius', 'hidden-smartphone-switch', '0');
xsins('radius', 'hidden-centerblock-slider', '1');
massaggex("نصب مود اطالاعات بیشتر ، با موفقیت نصب شد.");
}
if(isset($xsatag) AND isset($xsaname) AND isset($xsavalue)){
$xserror1check = $db->sql_numrows($db->sql_query("SELECT *
FROM `" . $prefix . "_xmsconfig`
WHERE `xstag` = '$xsatag'
AND `xsname` = '$xsaname'
AND `xsvalue` = '$xsavalue'
LIMIT 0 , 2"));
$xserror2check = $db->sql_numrows($db->sql_query("SELECT *
FROM `" . $prefix . "_xmsconfig`
WHERE `xstag` = '$xsatag'
AND `xsname` = '$xsaname'
LIMIT 0 , 2"));
if($xsatag=="textarea"){
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
<tr><td>(مقدار فید)</td><td><?php if($xsinfoitem2=="textarea"){wysiwyg_textarea('xsavalue',$xsinfoitem4, 'Comments', 50, 15);}else{ ?><input name='xsavalue' value='<?php echo $xsinfoitem4; ?>' class="inp-form-ltr"><?php } ?></td></tr>
<input type="hidden" name="xsid" value="<?php echo $xsinfoitem1; ?>">
<input type="hidden" name="xnikis" value="edited">
<input type="hidden" name="op" value="xmsconfig">
<tr><td><input class="form-submit" type='submit' value='ذخیره'>
</td></tr>
</table>
</form>
<?php
include("footer.php");
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
<tr><td>(مقدار فید)</td><td><?php if($xsinfoitem2=="textarea"){wysiwyg_textarea('xsavalue',$xsinfoitem4, 'Comments', 50, 15);}else{ ?><input name='xsavalue' value='<?php echo $xsinfoitem4; ?>' class="inp-form-ltr"><?php } ?></td></tr>
<input type="hidden" name="xsid" value="<?php echo $xsinfoitem1; ?>">
<input type="hidden" name="xnikis" value="edited">
<input type="hidden" name="op" value="xmsconfig">
<tr><td><input class="form-submit" type='submit' value='ذخیره'>
</td></tr>
</table>
</form>
<?php
include("footer.php");
die();
}else{
if($xsinfoitem2=="textarea"){
$xsvavalue = strip_tags($xsavalue);
$xsvavalue = mb_substr($xsvavalue, 0, 150) . '...';
}else{
$xsvavalue=$xsavalue;
}
xsedi($xsid,$xsaname,$xsavalue);
massaggex("$xsvavalue با موفقیت در $xsaname ویرایش شد.");
}
}
?><center><font class="title"><b>مود پیکربندی اطلاعات بیشتر</b></font></center><br>
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
	<li><a href="#text"><span>متن کوتاه</span></a></li>
	<li><a href="#textarea"><span>متن بلند</span></a></li>
	<li><a href="#select"><span>انتخابی از نوع select</span></a></li>
	<li><a href="#checkbox"><span>انتخابی از نوع checkbox</span></a></li>
	<li><a href="#radius"><span>انتخابی از نوع radius</span></a></li>
	<li><a href="#xmsconfigmanag"><span>اطلاعات مود</span></a></li>
	<li><a href="#xmsconfighelp"><span>راهنما</span></a></li>
</ul>
<?php
if($xiserror==1){
xsaform("عنوان",$xsaname,"مقدار",$xsavalue,"text");
}else{
xsaform("عنوان","","مقدار","","text");
}
if($xiserror==1){
xsaform("عنوان",$xsaname,"مقدار",$xsavalue,"textarea");
}else{
xsaform("عنوان","","مقدار","","textarea");
}
if($xiserror==1){
xsaform("عنوان",$xsaname,"مقدار",$xsavalue,"select");
}else{
xsaform("عنوان","","مقدار","","select");
}
if($xiserror==1){
xsaform("عنوان",$xsaname,"مقدار",$xsavalue,"checkbox");
}else{
xsaform("عنوان","","مقدار","","checkbox");
}
if($xiserror==1){
xsaform("عنوان",$xsaname,"مقدار",$xsavalue,"radius");
}else{
xsaform("عنوان","","مقدار","","radius");
}
?>
<div id="xmsconfigmanag">
<div class="Table">
<div class="Contents">
				<div align="center">
					<table id="product-table" border="1" width="600">
						<tr>
							<th colspan="2" class="table-header-repeat line-left" style="text-align:center;"><a>مدیریت سیستم</a></th>
						</tr>
						<tr>
							<td style="width:50%;line-height:25px;">نسخه نصب شده</td>
							<td style="width:50%;line-height:25px;direction:ltr;">Beta2</td>
						</tr>
						<tr>
							<td style="width:50%;line-height:25px;">آخرین نسخه انتشار یافته توسط <a href="http://www.xstar.ir/">Xstar</a></td>
							<td style="width:50%;line-height:25px;direction:ltr;"><?php if (extension_loaded('sockets') && function_exists('fsockopen') ){ echo get_latest_xmsconfigverj(); } ?></td>
						</tr>
						<tr>
							<td style="width:50%;line-height:25px;">تغییرات</td>
							<td style="width:50%;line-height:25px;direction:ltr;"><a href="http://www.phpnuke.ir/Forum/forum-f9/xmsconfig-t71012.html">view changlogs</a></td>
						</tr>
					</table>
				</div>
				</div>
</div>
</div>
<div id="xmsconfighelp">
<p>به نام خدا</p>
<p>راهنمای استفاده از مود پیکربندی اطلاعات بیشتر برای توسعه دهندگان</p>
<p>این مود با هدف یک دست شدن اطلاعات مورد نیاز مود ها ، ماژول ها و پوسته هایی که برای نیوک طراحی میشوند ، ساخت و توسعه یافته است. توسعه دهندگان امکان اضافه کردن اطلاعات به مدیریت با مقدار پیشفرض برای مود ها ، ماژول ها و پوسته های خود و بار گذاری آن را خواهند داشت و از این طریق مدیران سایت ها می توانند اطلاعات خود را به جای ویرایش فایل php ، از طریق مدیریت اطلاعات بیشتر تغییرات مورد نظر را اعمال کنند.</p>
<br><p style="font:bold 13px tahoma;">تگ های به کار رفته در مود اطلاعات بیشتر :</p><br>
<p style="direction:ltr;text-align:left;"><pre style="direction:ltr;text-align:left;">text // short text
textarea // big test
select // select option type
checkbox // select checkbox type
radisu // select radius type</pre></p>
<br><p style="font:bold 13px tahoma;">چگونه از طریق theme.php و جاهای دیگر اطلاعات به مود اطلاعات بیشتر اضافه کنیم؟</p><br>
<p>برای این کار به صورت زیر عمل کنید :</p>
<p style="direction:ltr;text-align:left;"><pre style="direction:ltr;text-align:left;">require_once("xmsconfig.lib.php");
xsitemapinsert("global xmsconfig tags","your tag","your value"); // for example : xsitemapinsert("text","facebook","https://www.facebook.com/test");</pre></p>
<p>دقت کنید که اگه xmsconfigtag و yourtag با هم کنار هم تو دیتابیس قبلا وجود داشته باشد ، درخواست شما ثبت نخواهد شد!</p>
<br><p style="font:bold 13px tahoma;">چگونه اطلاعات را دریافت کنیم ؟</p><br>
<p>با توجه به مثال بالا به صورت زیر اطلاعات مورد نظر را دریافت میکنید :</p>
<p style="direction:ltr;text-align:left;"><pre style="direction:ltr;text-align:left;">require_once("xmsconfig.lib.php");
$xcall=xsitemapitemcall("text","facebook"); // xcall is array !! [0] : id in db , [1] : xmsconfig tag , [2] : your tag , [3] : user value</pre></p>
<p>به طور مثال ، شما میخواهید لینک فیس بوک را نمایش دهید : </p>
<p style="direction:ltr;text-align:left;"><pre style="direction:ltr;text-align:left;">if($xcall[1]=="text" AND $xcall[2]=="facebook" AND $xcall[3]!==""){
echo $xcall[3];
}</pre></p>
<p>که در ای حالت شما قبلا text > facebook را ثبت کرده اید. اگر مدیر سایت نخواهد لینک مورد نظر نمایش یابد میتواند در ویرایش facebook مقدار را خالی بگذارد.</p>
<br><p style="font:bold 13px tahoma;">چگونه فرم بسازیم؟</p><br>
<p>در نسخه جدید ماژول امکان ایجاد فرم با آیتم های مورد نظر قرار داده شده است. شما می توانید آیتم های مورد نظر خود را در هر جای قسمت مدیریت سایت فراخوانی کنید و امکان ویرایش آیتم ها را در همان مکان فراهم کنید. بدین منظور به روش زیر عمل کنید.</p>
<p style="direction:ltr;text-align:left;"><pre style="direction:ltr;text-align:left;">require_once("xmsconfig.lib.php");
$xmstextform=array(
	"facebook",
	"logo",
	array(
		"set"=>"index-mainslider",
		22=>"top",
		31=>"top mod 3"
	),
	array(
		"set"=>"hidden-search",
		0=>"بلی",
		1=>"خیر"
	),
	array(
		"set"=>"موضوعات درون اسلایدر",
		0=>"اخبار",
		1=>"تست",
		2=>"بلاگ",
		3=>"موزیک خارجی",
		4=>"تست 2",
		5=>"یاروو",
		6=>"اپس"
	),
	"error-bad-mail-massage"
);
global $xmsconf,$xmlsa;
xmsconfigform($xmstextform,$xmsconf,$xmlsa);</pre></p>
<p>که در این صورت فرمی به صورت زیر خواهید داشت. دقت کنید آیتم های اصلی باید از قبل در سیستم قرار دادشه شده باشد. در صورت عدم وجود در فرم قرار نخواهد گرفت.</p>
<p style="text-align:center"><img src="http://arshen.ugig.ir/upload/images/gddf99h3mjicx3yujf.png" alt=""/></p>
</div>
</div>
</div>
</div><?php
CloseAdminTable();
include ("footer.php");
}

switch($op) {
	case "xmsconfig":
		xmsconfig();
	break;
}

} else {
	header("location: ".$admin_file.".php");
}
?>