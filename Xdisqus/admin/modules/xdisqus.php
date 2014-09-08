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
function get_latest_xdisqusverj($mode=''){
	if (extension_loaded('sockets') && function_exists('fsockopen') ){
		if ($fsock = @fsockopen("www.xstar.ir", 80, $errno, $errstr, 10))
		{
			@fputs($fsock, "GET /xdisqusverj.txt HTTP/1.1\r\n");
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
			die("1.0.1 initial");
		}
		return "1.0.1 initial";
	}
}
function xsvs($nuim){
global $prefix, $db, $dbname;
$nuim=intval($nuim);
$result = $db->sql_query("SELECT * FROM `" . $prefix . "_xdisqus` WHERE `xsid` =$nuim LIMIT 0 , 1");
	while ($row = $db->sql_fetchrow($result)) {
	mb_internal_encoding('UTF-8');
	$xsid = intval($row['xsid']);
	$xsname = $row['xsname'];
	$xsvalue = $row['xsvalue'];
}
return $xsvalue;
}
function xsieus($nuim,$xxvalue){
global $prefix, $db, $dbname;
$nuim=intval($nuim);
$db->sql_query("UPDATE `$dbname`.`" . $prefix . "_xdisqus` SET `xsvalue` = '$xxvalue' WHERE `" . $prefix . "_xdisqus`.`xsid` =$nuim;");
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
function checksubxd($nuim,$table,$pagefiled){
global $prefix, $db, $dbname;
$nuim=intval($nuim);
$numrow = $db->sql_numrows($db->sql_query("SELECT *
FROM `" . $prefix . "_" . $table . "`
WHERE `$pagefiled` =$nuim
LIMIT 0 , 30"));
return $numrow;
}
function xddisimp($comtable,$pagefiled,$parent,$xdsid,$pagefiled){
global $prefix, $db, $dbname;
$result = $db->sql_query("SELECT *
FROM `".$prefix."_".$comtable."`
WHERE `$pagefiled` =$xdsid
ORDER BY `".$prefix."_".$comtable."`.`tid` ASC
LIMIT 0 , 99999");
	while ($row_q = $db->sql_fetchrow($result)) {
	mb_internal_encoding('UTF-8');
		$tid = intval($row_q['tid']);
		$pagevar = intval($row_q[$pagefiled]);
		$parentid = intval($row_q[$parent]);
		$act = intval($row_q['act']);
		$date = $row_q['date'];
		$email = $row_q['email'];
		$c_name = filter($row_q['name'], "nohtml");
		$host_name = filter($row_q['host_name'], "nohtml");
		$comment = stripslashes($row_q['comment']);
		$comment = preg_replace("/(\r\n|\n|\r|\t)/i", '', $comment);
		$score = intval($row_q['score']);
		$reason = intval($row_q['reason']);
		if (empty($c_name)) { $c_name = "Anonymous"; }
		$resultt = $db->sql_query("SELECT user_id, user_avatar, karma, user_website FROM ".$prefix."_users WHERE username='$c_name'");
		$userrow = $db->sql_fetchrow($resultt);
		$user_id = intval($userrow['user_id']);
		$user_avatar = $userrow['user_avatar'];
		if($email==""){$email = $userrow['user_email'];}
		$user_website = $userrow['user_website'];
				$avaimage = addslashes($user_avatar);
		if(!@ereg("/", $avaimage) && !@ereg("blank.gif", $avaimage)){
			$avaimage = "Forum/download/file.php?avatar=$avaimage";
		}elseif(@ereg("http://", $avaimage)){
			$avaimage = "$avaimage";
		}else{
			$avaimage = "Forum/images/avatars/gallery/$avaimage";
		}
		if ($avaimage != "")  {
			$avaimage = "$avaimage";
		}else {
			$avaimage = "modules/Forums/images/avatars/gallery/blank.gif";
		}
		$Req_Protocol 	= strpos(strtolower($_SERVER['SERVER_PROTOCOL']),'https') === FALSE ? 'http' : 'https';
$Req_Hosta     	= $_SERVER['HTTP_HOST'];
$Req_Uri		= $_SERVER['REQUEST_URI'];
$Req_URIs		= $Req_Protocol . '://' . $Req_Host . $Req_Uri;
?>      <wp:comment>
        <wp:comment_id><?php echo $tid; ?></wp:comment_id>
        <wp:comment_author><?php echo $c_name; ?></wp:comment_author>
        <wp:comment_author_email><?php echo $c_name; ?>@<?php echo $Req_Hosta; ?></wp:comment_author_email>
<?php if($user_website==""){}else{ ?>        <wp:comment_author_url><?php echo $user_website; ?></wp:comment_author_url>
<?php } ?>        <wp:comment_author_IP><?php echo $host_name; ?></wp:comment_author_IP>
        <wp:comment_date_gmt><?php echo date("Y-m-d H:i:s", $date); ?></wp:comment_date_gmt>
        <wp:comment_content><![CDATA[<?php echo $comment; ?>]]></wp:comment_content>
        <wp:comment_approved><?php echo $act; ?></wp:comment_approved>
        <wp:comment_parent><?php echo $parentid; ?></wp:comment_parent>
      </wp:comment>
<?php }
}
function gettibyb($nuim, $nim,$pagefiled){
global $prefix, $db, $dbname;
$nuim=intval($nuim);
$result = $db->sql_query("SELECT *
FROM `" . $prefix . "_" . $nim . "`
WHERE `$pagefiled` =$nuim
LIMIT 0 , 1");
	while ($row = $db->sql_fetchrow($result)) {
	mb_internal_encoding('UTF-8');
	$title = $row['title'];
	if($pagefiled=="pollID"){$title = $row['pollTitle'];}
}
return $title;
}
function gettibybh($nuim, $nim, $pagefiled){
global $prefix, $db, $dbname;
$nuim=intval($nuim);
$result = $db->sql_query("SELECT *
FROM `" . $prefix . "_" . $nim . "`
WHERE `$pagefiled` =$nuim
LIMIT 0 , 1");
	while ($row = $db->sql_fetchrow($result)) {
	mb_internal_encoding('UTF-8');
	$title = $row['hometext'];
	if($pagefiled=="pageid" OR $pagefiled=="staticid"){$title = $row['text'];}
	$title = strip_tags($title);
	$title = mb_substr($title, 0, 500) . '...';
	$title = preg_replace("/(\r\n|\n|\r|\t)/i", '', $title);
}
return $title;
}
function gettibybd($nuim, $nim, $pagefiled){
global $prefix, $db, $dbname;
$nuim=intval($nuim);
$result = $db->sql_query("SELECT *
FROM `" . $prefix . "_" . $nim . "`
WHERE `$pagefiled` =$nuim
LIMIT 0 , 1");
	while ($row = $db->sql_fetchrow($result)) {
	mb_internal_encoding('UTF-8');
	$title = $row['time'];
	if($pagefiled=="pollID"){$title = $row['timeStamp'];}
}
return $title;
}
function xdisqus() {
	global $bgcolor2, $prefix, $db, $admin_file, $dbname, $sitename, $xdisqusx, $xssn, $exportcom, $nukeurl,$articlecomm,$pollcomm,$productscomm,$contentcom,$staticcomm;;
if(isset($exportcom) AND $exportcom=="nuketodisqus"){
header("Pragma: public");
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0"); 
header("Content-Type: application/force-download");
header("Content-Type: application/octet-stream");
header("Content-Type: application/download");
header("Content-Disposition: attachment;filename=xdcominport.xhtml ");
header("Content-Transfer-Encoding: binary ");
echo"<?xml version=\"1.0\" encoding=\"UTF-8\"?>
<rss version=\"2.0\"
  xmlns:content=\"http://purl.org/rss/1.0/modules/content/\"
  xmlns:dsq=\"http://www.disqus.com/\"
  xmlns:dc=\"http://purl.org/dc/elements/1.1/\"
  xmlns:wp=\"http://wordpress.org/export/1.0/\"
>";
?>

  <channel>
<?php
		$ctable = "stories";
		$pagefiled = "sid";
		$parent = "pid";
		$allowcomments = $articlecomm;
		$comtable="".$ctable."_comments";
		$result = $db->sql_query("SELECT * FROM ".$prefix."_".$ctable." LIMIT 999999");
while ($row = $db->sql_fetchrow($result)) {
			$rsid = intval($row[$pagefiled]);
			if(checksubxd($rsid,$comtable,$pagefiled)>0){
?>
   <item>
      <title><?php echo gettibyb($rsid, $ctable,$pagefiled); ?></title>
      <link><?php echo LinkToGT(newslink($rsid)); ?></link>
      <?php if(gettibybh($rsid, $ctable,$pagefiled)==""){}else{ ?><content:encoded><![CDATA[<?php echo gettibybh($rsid, $ctable,$pagefiled); ?>]]></content:encoded><?php } ?>
      <dsq:thread_identifier><?php echo"$pagefiled-$rsid-$ctable"; ?></dsq:thread_identifier>
      <wp:post_date_gmt><?php echo date("Y-m-d H:i:s", gettibybd($rsid, $ctable,$pagefiled)); ?></wp:post_date_gmt>
      <wp:comment_status><?php if($allowcomments==1){ ?>open<?php }else{ ?>closed<?php } ?></wp:comment_status>
<?php  xddisimp($comtable,$pagefiled,$parent,$rsid,$pagefiled); ?>
    </item>
<?php }
}
		$ctable = "poll_desc";
		$pagefiled = "pollID";
		$parent = "pid";
		$allowcomments = $pollcomm;
		$comtable="pollcomments";
		$result = $db->sql_query("SELECT * FROM ".$prefix."_".$ctable." LIMIT 999999");
		while ($row = $db->sql_fetchrow($result)) {
			$rsid = intval($row[$pagefiled]);
			if(checksubxd($rsid,$comtable,$pagefiled)>0){
?>
   <item>
      <title><?php echo gettibyb($rsid, $ctable,$pagefiled); ?></title>
      <link><?php echo $nukeurl; ?>modules.php?name=$module_name&amp;op=pollMain&amp;pollID=<?php echo $rsid; ?></link>
      <?php if(gettibybh($rsid, $ctable,$pagefiled)==""){}else{ ?><content:encoded><![CDATA[<?php echo gettibybh($rsid, $ctable,$pagefiled); ?>]]></content:encoded><?php } ?>
      <dsq:thread_identifier><?php echo"$pagefiled-$rsid-$ctable"; ?></dsq:thread_identifier>
      <wp:post_date_gmt><?php echo date("Y-m-d H:i:s", gettibybd($rsid, $ctable,$pagefiled)); ?></wp:post_date_gmt>
      <wp:comment_status><?php if($allowcomments==1){ ?>open<?php }else{ ?>closed<?php } ?></wp:comment_status>
<?php  xddisimp($comtable,$pagefiled,$parent,$rsid,$pagefiled); ?>
    </item>
<?php }
}
		$ctable = "products";
		$pagefiled = "sid";
		$parent = "pid";
		$allowcomments = $productscomm;
		$comtable="".$ctable."_comments";
		$result = $db->sql_query("SELECT * FROM ".$prefix."_".$ctable." LIMIT 999999");
		while ($row = $db->sql_fetchrow($result)) {
			$rsid = intval($row[$pagefiled]);
			if(checksubxd($rsid,$comtable,$pagefiled)>0){
?>
   <item>
      <title><?php echo gettibyb($rsid, $ctable,$pagefiled); ?></title>
      <link><?php echo LinkToGT(product_link($rsid)); ?></link>
      <?php if(gettibybh($rsid, $ctable,$pagefiled)==""){}else{ ?><content:encoded><![CDATA[<?php echo gettibybh($rsid, $ctable,$pagefiled); ?>]]></content:encoded><?php } ?>
      <dsq:thread_identifier><?php echo"$pagefiled-$rsid-$ctable"; ?></dsq:thread_identifier>
      <wp:post_date_gmt><?php echo date("Y-m-d H:i:s", gettibybd($rsid, $ctable,$pagefiled)); ?></wp:post_date_gmt>
      <wp:comment_status><?php if($allowcomments==1){ ?>open<?php }else{ ?>closed<?php } ?></wp:comment_status>
<?php  xddisimp($comtable,$pagefiled,$parent,$rsid,$pagefiled); ?>
    </item>
<?php }
}
		$ctable = "pages";
		$pagefiled = "pageid";
		$parent = "prid";
		$allowcomments = $contentcom;
		$comtable="".$ctable."_comments";
		$result = $db->sql_query("SELECT * FROM ".$prefix."_".$ctable." LIMIT 999999");
		while ($row = $db->sql_fetchrow($result)) {
			$rsid = intval($row[$pagefiled]);
			if(checksubxd($rsid,$comtable,$pagefiled)>0){
?>
   <item>
      <title><?php echo gettibyb($rsid, $ctable,$pagefiled); ?></title>
      <link><?php echo LinkToGT(content_link($rsid)); ?></link>
      <?php if(gettibybh($rsid, $ctable,$pagefiled)==""){}else{ ?><content:encoded><![CDATA[<?php echo gettibybh($rsid, $ctable,$pagefiled); ?>]]></content:encoded><?php } ?>
      <dsq:thread_identifier><?php echo"$pagefiled-$rsid-$ctable"; ?></dsq:thread_identifier>
      <wp:post_date_gmt><?php echo date("Y-m-d H:i:s", gettibybd($rsid, $ctable,$pagefiled)); ?></wp:post_date_gmt>
      <wp:comment_status><?php if($allowcomments==1){ ?>open<?php }else{ ?>closed<?php } ?></wp:comment_status>
<?php  xddisimp($comtable,$pagefiled,$parent,$rsid,$pagefiled); ?>
    </item>
<?php }
}
		$ctable = "staticpages";
		$pagefiled = "staticid";
		$parent = "prid";
		$allowcomments = $staticcomm;
		$comtable="".$ctable."_comments";
		$result = $db->sql_query("SELECT * FROM ".$prefix."_".$ctable." LIMIT 999999");
		while ($row = $db->sql_fetchrow($result)) {
			$rsid = intval($row[$pagefiled]);
			if(checksubxd($rsid,$comtable,$pagefiled)>0){
?>
   <item>
      <title><?php echo gettibyb($rsid, $ctable,$pagefiled); ?></title>
      <link><?php echo $nukeurl; ?>modules.php?name=static&amp;op=viewpage&amp;pid=<?php echo $rsid; ?></link>
      <?php if(gettibybh($rsid, $ctable,$pagefiled)==""){}else{ ?><content:encoded><![CDATA[<?php echo gettibybh($rsid, $ctable,$pagefiled); ?>]]></content:encoded><?php } ?>
      <dsq:thread_identifier><?php echo"$pagefiled-$rsid-$ctable"; ?></dsq:thread_identifier>
      <wp:post_date_gmt><?php echo date("Y-m-d H:i:s", gettibybd($rsid, $ctable,$pagefiled)); ?></wp:post_date_gmt>
      <wp:comment_status><?php if($allowcomments==1){ ?>open<?php }else{ ?>closed<?php } ?></wp:comment_status>
<?php  xddisimp($comtable,$pagefiled,$parent,$rsid,$pagefiled); ?>
    </item>
<?php }
}
?>
  </channel>
</rss><?php
die();
}
include ("header.php");
GraphicAdmin();
OpenAdminTable();
$xmnvaa=="1.0.1 initial";
if (extension_loaded('sockets') && function_exists('fsockopen') ){ $xmnvaa=get_latest_xdisqusverj(); } 
if($xmnvaa=="1.0.1 initial"){}else{massaggex("<a href=\"http://www.phpnuke.ir/Forum/forum-f9/xdisqus-t70997.html\">نسخه جدید سیستم Xdisqus به ورژن $xmnvaa انتشار یافت !!!</a>");}
?><center><font class="title"><b>سیستم نظردهی دیسکاس</b></font></center><br>
<?php
if(isset($xdisqusx) AND isset($xssn)){
if($xssn==""){
massagrex("فید shortname را پر کنید.");
}else{
xsieus(1,$xdisqusx);
xsieus(2,$xssn);
massaggex("تغییرات با موفقیت انجام شد.");
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
	<li><a href="#admindisqus"><span>مدیریت سیستم</span></a></li>
	<li><a href="#xdisqusnotify"><span>اطلاعات سیستم</span></a></li>
	<li><a href="#helpingdisqus"><span>راهنما سیستم</span></a></li>
</ul>
<div id="admindisqus">
<form action="<?php echo $admin_file; ?>.php" method="post">
<table align="center" border="0" cellpadding="4" cellspacing="4" width="100%" id="id-form">
<tr><th style="width:250px">فعال بودن دیسکاس</th><td>بلی <input name="xdisqusx" type="radio" class="styled" value="1" <?php if(xsvs(1)==1){ ?>checked<?php } ?>> &nbsp;&nbsp; خیر <input name="xdisqusx" type="radio" class="styled" value="0" <?php if(xsvs(1)==0){ ?>checked<?php } ?>></td></tr>
<tr><td>shortname سایت</td><td><input name='xssn' value='<?php echo xsvs(2); ?>' class="inp-form-ltr"> shortname که موقع ثبت سایت پر کردید</td></tr>
<tr><td><input class="form-submit" type='submit' value='ذخیره'>
</td></tr>
<input type="hidden" name="op" value="xdisqus">
</table>
</form>
<a href="<?php echo $admin_file; ?>.php?op=xdisqus&exportcom=nuketodisqus">خروجی برای ارسال نظرات نیوک به دیسکاس</a> (News,Products,Pages,Pulls,Old static)
</div>
<div id="xdisqusnotify">
<div class="Table">
<div class="Contents">
				<div align="center">
					<table id="product-table" border="1" width="600">
						<tr>
							<th colspan="2" class="table-header-repeat line-left" style="text-align:center;"><a>مدیریت سیستم</a></th>
						</tr>
						<tr>
							<td style="width:50%;line-height:25px;">نسخه نصب شده نظردهی دیسکاس</td>
							<td style="width:50%;line-height:25px;direction:ltr;">1.0.1 initial</td>
						</tr>
						<tr>
							<td style="width:50%;line-height:25px;">آخرین نسخه انتشار یافته توسط <a href="http://www.xstar.ir/">Xstar</a></td>
							<td style="width:50%;line-height:25px;direction:ltr;"><?php if (extension_loaded('sockets') && function_exists('fsockopen') ){ echo get_latest_xdisqusverj(); } ?></td>
						</tr>
						<tr>
							<td style="width:50%;line-height:25px;">تغییرات</td>
							<td style="width:50%;line-height:25px;direction:ltr;"><a href="http://www.phpnuke.ir/Forum/forum-f9/xdisqus-t70997.html">view changlogs</a></td>
						</tr>
					</table>
				</div>
				</div>
</div>
</div>
<div id="helpingdisqus">
<p>
به نام خدا</p><br>
<p>
به راهنمای سیستم نظردهی دیسکاس خوش آمدید.</p><br>
<p style="font:bold 13px tahoma;">
Disqus چیست؟</p><p>
دیسکاس یک سیستم نظردهی ، با بیش از 70 میلیون نفر عضو در سراسر جهان می باشد. دیسکاس ، مدیریت نظرات سایت شما را بر عهده میگیرد و دیدگاههای سایت شما را بصورت آژاکس و خیلی حرفه ای نشان میدهد به طوری که احساس میکنید در قسمت دیدگاه های یک شبکه اجتماعی قرار دارید. امکان follow کردن کاربران ، ورود بوسیله شبکه های اجتماعی و سایت خود دیسکاس  و همچنین نمایش برترین نظر دهندگان از جمله امکان دیسکاس می باشد.</p>
<p>
دیسکاس بدون شک یکی از بهترین جایگزین برای سیستم نظر دهی سنتی CMS ها می باشد. برای اطلاعات بیشتر به سایت <a href="http://disqus.com/">دیسکاس</a> مراجعه کنید.</p><br>
<p style="font:bold 13px tahoma;">
چگونه سایت خود را در دیسکاس ثبت کنم؟</p><p>
برای ثبت سایت خود در دیسکاس ابتدا به این آدرس مراجعه نمایید : <a href="https://disqus.com/admin/signup/?utm_source=New-Site">https://disqus.com/admin/signup/?utm_source=New-Site</a><br />
&nbsp;</p>
<div align="center">
<img alt="http://arshen.ugig.ir/upload/images/46zaqudo9v6woxj1ksfw.png" class="decoded" src="http://arshen.ugig.ir/upload/images/46zaqudo9v6woxj1ksfw.png" /><br />
</div>
<br />
بعد پر کردن فید ها Next step را کلیک کنید.<br />
<br />
<div align="center">
<img alt="http://arshen.ugig.ir/upload/images/xrtx7qaj2zxd1nutdjq.png" class="decoded" src="http://arshen.ugig.ir/upload/images/xrtx7qaj2zxd1nutdjq.png" /></div>
<br />
بعد پر کردن فید ها بر رو دکمه Finish registration کلیک کنید تا ثبت نام کامل شود.<br />
حتما بعد ثبت نام ، ایمیل حاوی لینک verify را تایید کنید!<br />
بعد ثبت نام ، shortname که در فرم پروفایل سایت ثبت کردید را در مدیریت دیسکاس در نیوک قرار دهید.
<br><br><p style="font:bold 13px tahoma;">چگونه نظرات کنونی را در دیسکاس import کنم؟</p><p>
ابتدا از صفحه مدیریت دیسکاس در سایت خود خروجی را دانلود کنید و بعد به آدرس <a href="https://<?php echo xsvs(2); ?>.disqus.com/admin/discussions/import/platform/generic/">import generic</a> مراجعه کنید.</p>
<p>بعد بر روی دکمه browse کلیک کنید و فایل دانلود شده را انتخاب کنید و بعد upload and import را بزنید.</p>
<p>Your import has been successfully uploaded and queued. We'll email you when your import has completed.</p>
<p>این پیام نشان دهنده ایپورت شدن نظرات سایت شما می باشد. لازم به ذکر است در ساعاتی به دلیل مصرف زیاد از سرور دیسکاس نظرات شما با تاخیری چند دقیقه ای import می شود.</p>
<br><p style="font:bold 13px tahoma;">چگونه دیسکاس را فارسی کنم؟</p><p>
ابتدا به ادرس <a href="https://<?php echo xsvs(2); ?>.disqus.com/admin/settings/">Setting</a> مراجعه کنید.</p>
<p>در قسمت Site Identity زبان سایت Language را به persian فارسی تغییر دهید.</p>
</div>
</div>
</div>
</div>
</div><?php
CloseAdminTable();
include ("footer.php");
}

switch($op) {
	case "xdisqus":
		xdisqus();
	break;
}

} else {
	header("location: ".$admin_file.".php");
}
?>