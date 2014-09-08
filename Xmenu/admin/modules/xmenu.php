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
function get_latest_xmenuverj($mode=''){
	if (extension_loaded('sockets') && function_exists('fsockopen') ){
		if ($fsock = @fsockopen("www.xstar.ir", 80, $errno, $errstr, 10))
		{
			@fputs($fsock, "GET /xmenuverj.txt HTTP/1.1\r\n");
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
			die("1.1.3 RC");
		}
		return "1.1.3 RC";
	}
}

function dkxm($xid){
global $prefix, $db, $dbname;
$db->sql_query("DELETE FROM `$dbname`.`" . $prefix . "_xmenu` WHERE `" . $prefix . "_xmenu`.`xmid` = $xid");
}
function mkxm($xid, $xmsub, $xmclass, $xmtitle, $xmlink){
global $prefix, $db, $dbname;
$db->sql_query("INSERT INTO `$dbname`.`" . $prefix . "_xmenu` (
`xmid` ,
`xid` ,
`xmsub` ,
`xmclass` ,
`xmtitle` ,
`xmlink`
)
VALUES (
NULL , '$xid', '$xmsub', '$xmclass', '$xmtitle', '$xmlink'
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
function edxm($xmid, $xmsub, $xmclass, $xmtitle, $xmlink){
global $prefix, $db, $dbname;
$db->sql_query("UPDATE `$dbname`.`" . $prefix . "_xmenu` SET `xmsub` = '$xmsub',
`xmclass` = '$xmclass',
`xmtitle` = '$xmtitle',
`xmlink` = '$xmlink' WHERE `" . $prefix . "_xmenu`.`xmid` =$xmid;");
}
function dexm($xmid){
global $prefix, $db, $dbname;
$db->sql_query("DELETE FROM `$dbname`.`" . $prefix . "_xmenu` WHERE `" . $prefix . "_xmenu`.`xmid` = $xmid");
}
function mkfmgmenu($mgmenu,$xmtitle,$xmclass,$xmlink){
global $admin_file;
?>
<form action="<?php echo $admin_file; ?>.php" method="post">
<table border="0" align="right" cellpadding="3" id="id-form">
<tr><td>نام منو:</td><td><input name='xmtitle' value='<?php echo $xmtitle; ?>' class="inp-form-ltr"></td></tr>
<tr><td>class element نام:</td><td><input name='xmclass' value='<?php echo $xmclass; ?>' class="inp-form-ltr"></td></tr>
<tr><td>id element نام:</td><td><input name='xmlink' value='<?php echo $xmlink; ?>' class="inp-form-ltr"></td></tr>
<tr><td><input class="form-submit" type='submit' value='ذخیره'>
</td></tr>
<?php if($mgmenu=="mgmenu"){ ?>
<input type="hidden" name="op" value="mgmenu">
<?php }else{ ?>
<input type="hidden" name="op" value="mgmenu">
<input type="hidden" name="mgeleman" value="<?php echo $mgmenu; ?>">
<?php } ?>
</table>
</form>
<?php
}
function mkggmgmenu($item1,$item2,$item3,$item4,$item5,$item6){
global $prefix, $db, $dbname, $admin_file;
?>
<form action="<?php echo $admin_file; ?>.php" method="post">
<table border="0" align="right" cellpadding="3" id="id-form">
<tr><td>نام منو</td><td><input name='xmtitle' value='<?php echo $item1; ?>' class="inp-form-ltr"></td></tr>
<tr><td>لینک خروجی منو</td><td><input name='xmlink' value='<?php echo $item2; ?>' class="inp-form-ltr"></td></tr>
<tr><td>نام class</td><td><input name='xmclass' value='<?php echo $item3; ?>' class="inp-form-ltr"></td></tr>
<tr><td>در شاخه</td><td><select name="xmsub" class="styledselect-select">
<option value="0">-------</option><?php
$result = $db->sql_query("SELECT *
FROM `" . $prefix . "_xmenu`
WHERE `xid` =$item5
LIMIT 0 , 999999");
	while ($row = $db->sql_fetchrow($result)) {
	mb_internal_encoding('UTF-8');
	$xmid = intval($row['xmid']);
	$xmtitle = $row['xmtitle'];
	if($xmid==$item6){}else{
	echo"<option value=\"$xmid\" "; if($xmid==$item4){ ?>selected<?php } echo">$xmtitle</option>";
	}
} 
?>
</select></td></tr>
<tr><td><input class="form-submit" type='submit' value='ذخیره'>
</td></tr>
<input type="hidden" name="op" value="mgmenu">
<?php if($item6==""){ ?><input type="hidden" name="sonan" value="<?php echo $item5; ?>"/><?php }else{ ?><input type="hidden" name="sigaro" value="<?php echo $item6; ?>"><?php } ?>
</table>
</form>
<?php
}
function godbforgetout1($xid){
global $prefix, $db, $dbname;
$result = $db->sql_query("SELECT *
FROM `" . $prefix . "_xmenu`
WHERE `xmid` =$xid
ORDER BY `" . $prefix . "_xmenu`.`xmid` DESC
LIMIT 0 , 1");
	while ($row = $db->sql_fetchrow($result)) {
	mb_internal_encoding('UTF-8');
	$xmtitle = $row['xmtitle'];
	return $xmtitle;
	}
}
function vfxgmgmenu($dalex){
global $prefix, $db, $dbname, $admin_file;
?>
<table id="product-table" border="0" width="100%"><tr>
<th class="table-header-repeat line-left" style="text-align:center;width:40px;"><a>شمارنده</a></th>
<th class="table-header-repeat line-left" style="text-align:center;"><a>نام منو</a></th>
<th class="table-header-repeat line-left" style="text-align:center;"><a>لینک خروجی منو</a></th>
<th class="table-header-repeat line-left" style="text-align:center;"><a>در شاخه</a></th>
<th class="table-header-repeat line-left" style="text-align:center;"><a>نام class</a></th>
<th class="table-header-repeat line-left" style="text-align:center;width:100px;"><a>امکانات</a></th>
</tr><?php
$result = $db->sql_query("SELECT *
FROM `" . $prefix . "_xmenu`
WHERE `xid` =$dalex
ORDER BY `" . $prefix . "_xmenu`.`xmid` DESC
LIMIT 0 , 30");
	while ($row = $db->sql_fetchrow($result)) {
	mb_internal_encoding('UTF-8');
	$xmid = intval($row['xmid']);
	$xid = intval($row['xid']);
	$xmsub = $row['xmsub'];
	$xmtitle = $row['xmtitle'];
	$xmclass = $row['xmclass'];
	$xmlink = $row['xmlink'];
	?><tr>
<td align="center" width="40"><?php echo $xmid; ?></td>
<td align="center" width="auto"><?php echo $xmtitle; ?></td>
<td align="center" width="auto"><?php echo $xmlink; ?></td>
<td align="center" width="auto"><?php echo godbforgetout1($xmsub); ?></td>
<td align="center" width="auto"><?php echo $xmclass; ?></td>
<td align="center" width="100px">
	<a href="<?php echo $admin_file; ?>.php?op=mgmenu&com=delek&sxid=<?php echo $xmid ; ?>" title="حذف منو" class="icon-2 info-tooltip"></a>
	<a href="<?php echo $admin_file; ?>.php?op=mgmenu&com=editk&sxid=<?php echo $xmid ; ?>" title="ویرایش منو" class="icon-6 info-tooltip"></a>
</td><?php } ?>
</tr></table><?php
}
function vfmgmenu(){
global $prefix, $db, $dbname, $admin_file;
?><table id="product-table" border="0" width="100%"><tr>
<th class="table-header-repeat line-left" style="text-align:center;width:40px;"><a>شمارنده</a></th>
<th class="table-header-repeat line-left" style="text-align:center;"><a>نام منو</a></th>
<th class="table-header-repeat line-left" style="text-align:center;"><a>class element نام</a></th>
<th class="table-header-repeat line-left" style="text-align:center;"><a>id element نام</a></th>
<th class="table-header-repeat line-left" style="text-align:center;width:100px;"><a>امکانات</a></th>
</tr><?php
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
	$xmlink = $row['xmlink'];
	?><tr>
<td align="center" width="40"><?php echo $xmid; ?></td>
<td align="center" width="auto"><?php echo $xmtitle; ?></td>
<td align="center" width="auto"><?php echo $xmclass; ?></td>
<td align="center" width="auto"><?php echo $xmlink; ?></td>
<td align="center" width="100px">
	<a href="<?php echo $admin_file; ?>.php?op=mgmenu&com=mng&sxid=<?php echo $xmid ; ?>" class="icon-1 info-tooltip" title="مدیریت منو"></a>
	<a href="<?php echo $admin_file; ?>.php?op=mgmenu&com=dele&sxid=<?php echo $xmid ; ?>" title="حذف منو" class="icon-2 info-tooltip"></a>
	<a href="<?php echo $admin_file; ?>.php?op=mgmenu&com=edit&sxid=<?php echo $xmid ; ?>" title="ویرایش منو" class="icon-6 info-tooltip"></a>
</td><?php } ?>
</tr></table><?php
}
function xmenu() {
	global $bgcolor2, $prefix, $db, $admin_file, $dbname, $tikatika;
include ("header.php");
GraphicAdmin();
OpenAdminTable();
if (extension_loaded('sockets') && function_exists('fsockopen') ){ $xmnvaa=get_latest_xmenuverj(); } 
if($xmnvaa=="1.1.3 RC"){}else{massaggex("<a href=\"http://www.phpnuke.ir/Forum/forum-f9/xmenu-t70968.html\">نسخه جدید سیستم xmenu به ورژن $xmnvaa انتشار یافت !!!</a>");}
?><center><font class="title"><b>سیستم یکپارچه مدیریت منو ها</b></font></center>
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
	<li><a href="#adminmenu"><span>منو ها</span></a></li>
	<li><a href="#menusetting"><span>مدیریت سیستم</span></a></li>
	<li><a href="#menutools"><span>راهنمای سیستم</span></a></li>
</ul>
<div id="adminmenu">
<?php
mkfmgmenu("mgmenu","","","");
vfmgmenu();
$sisisjsjshs = $db->sql_numrows($db->sql_query("SELECT *
FROM `" . $prefix . "_xmenu`
WHERE `xid` =0
ORDER BY `" . $prefix . "_xmenu`.`xmid` DESC
LIMIT 0 , 999"));
?>
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
							<td style="width:50%;line-height:25px;">نسخه نصب شده سیستم یکپارچه مدیریت منو ها</td>
							<td style="width:50%;line-height:25px;direction:ltr;">1.1.3 RC</td>
						</tr>
						<tr>
							<td style="width:50%;line-height:25px;">آخرین نسخه انتشار یافته توسط تیم Xstar</td>
							<td style="width:50%;line-height:25px;direction:ltr;"><?php if (extension_loaded('sockets') && function_exists('fsockopen') ){ echo get_latest_xmenuverj(); } ?></td>
						</tr>
						<tr>
							<td style="width:50%;line-height:25px;">تعداد منو های ساخته شده</td>
							<td style="width:50%;line-height:25px;direction:ltr;"><?php echo $sisisjsjshs; ?></td>
						</tr>
						<tr>
							<td style="width:50%;line-height:25px;">تغییرات</td>
							<td style="width:50%;line-height:25px;direction:ltr;"><a href="http://www.phpnuke.ir/Forum/forum-f9/xmenu-t70968.html">view changlogs</a></td>
						</tr>
						<tr>
							<td style="width:50%;line-height:25px;">پاک کردن اطلاعات <?php echo $prefix ; ?>_xmenu</td>
							<td style="width:50%;line-height:25px;direction:ltr;"><a href="<?php echo $admin_file; ?>.php?op=mgmenu&com=empty">Empty the table (TRUNCATE)</a></td>
						</tr>
					</table>
				</div>
				</div>
</div>
</div>
<div id="menutools">
<p>
	به نام خدا</p>
<p>
	به راهنمای سیستم یکپارچه مدیریت منو ها خوش آمدید.</p>
<p>این سیستم با هدف راحت و دلنشین کردن مدیریت منو در نیوک توسط گروه Xstar برای استفاده عموم و طراحان نیوک تولید شده است. شما با استفاده از این سیستم می توانید بی نهایت منو برای سایت خود تعریف کنید و همچنین دولوپر های نیوک هم می توانند از این سیستم برای استفاده در پروژه های ، تم ها و افزونه های خود استفاده کنند. این سیستم طوری طراحی شده که دولوپر های نیوک با دستی باز منو ها رو با کد های دلخواه خودشون نمایش بدهند.</p>
<br><p style="font:bold 13px tahoma;">	چگونه یک منو ایجاد کنیم ؟</p><br>
<p>
	ابتدا وارد صفحه مدیریت منو ها (Xmenu) شده و یک منو با el های نام منو ، کلاس منو ، آیدی منو ایجاد کنید.</p>
<p style="direction:ltr;text-align:left;"><pre style="direction:ltr;text-align:left;">&lt;ul class=&quot;آیدی منو&quot; id=&quot;کلاس منو&quot;&gt;</pre></p>
<p>
	بعد از ایجاد منو با کلیک بر مدیریت منو (آیکن چرخ دنده در انتهای سطون منو و در ردیف امکانات) وارد قسمت مدیریت منوهای منو مورد نظر شوید و در آنجا منو های دلخواه برای منو مورد نظر ایجاد کنید.</p>
<br><p style="font:bold 13px tahoma;">چگونه منو مورد نظر را نمایش&nbsp; دهیم ؟</p><br>
<p>برای نمایش استاندارد منو در نیوک می توانید با استفاده از شمارنده منو مورد نظر توسط تابع زیر منو خود را نمایش دهید :</p>
<p style="direction:ltr;text-align:left;"><pre style="direction:ltr;text-align:left;">echo xmenux(شمارنده);</pre></p>
<p>و همچنین برای نمایش منو با رابط $xmoption به صورت زیر عمل کنید :</p>
<p style="direction:ltr;text-align:left;"><pre style="direction:ltr;text-align:left;">$xmoption=array();<br>echo xmenux(شمارنده,$xmoption);</pre></p>
<br><p style="font:bold 13px tahoma;">چگونه منو را به صورت کد دلخواه نمایش دهیم؟</p><br>
<p>شما دولوپر ها می توانید با الگو گرفتن از توابع ارائه شده در فایل custom_mainfile.php برای خود تابع اختصاصی بسازید و در هر جای نیوک استفاده کنید.</p>
<br><p style="font:bold 13px tahoma;">توابع موجود در custom_mainfile.php چه کار می کنند ؟</p><br>
<p>در custom_mainfile.php 4 تابع برای Xmenu وجود دارد :</p>
<p>تابع checksubxm : این تابع تعداد منو های زیر شاخه رو شمارش می کند</p>
<p>تابع xmenux : این تابع ul و li اصلی منو را نمایش می دهد.</p>
<p>تابع vxmenu : این تابع شاخه اول را نمایش می دهد</p>
<p>تابع vxmenu1 : این تابع شاخه های دوم به بعد را نمایش می دهد.</p>
<br><p style="font:bold 13px tahoma;">$xmoption چیست و چگونه از آن استفاده کنیم؟</p><br>
<p>$xmoption به عنوان رابط شما با تابع xmenux() عمل می کند و تغییرات دلخواه شما را در استاندارد نمایش میدهد. برای استفاده از آن برای xmenux() به صورت زیر تعریف کنید:(با داده های مثالی)</p>
<p style="direction:ltr;text-align:left;"><pre style="direction:ltr;text-align:left;">
	$xmoption=array(<br />
	&nbsp;&nbsp; &nbsp;&quot;bful&quot;=&gt;&quot;&lt;div class=\&quot;xmega\&quot;&gt;&quot;, // befor frist ul ==&gt; $&lt;ul&gt; [ul.$]<br />
	&nbsp;&nbsp; &nbsp;&quot;aful&quot;=&gt;&quot;&lt;/div&gt;&quot;, // after frist ul ==&gt; &lt;/ul&gt;$<br />
	&nbsp;&nbsp; &nbsp;&quot;bscul&quot;=&gt;&quot;&lt;div class=\&quot;xsub xsubmega\&quot;&gt;&quot;, // befor second ul ==&gt; $&lt;ul&gt;<br />
	&nbsp;&nbsp; &nbsp;&quot;ascul&quot;=&gt;&quot;&lt;/div&gt;&quot;, // after second ul ==&gt; &lt;/ul&gt;$<br />
	&nbsp;&nbsp; &nbsp;&quot;sulc&quot;=&gt;&quot;ultramenu&quot;, // second ul class ==&gt; &lt;ul class=&quot;$&quot;&gt; [ul li ul.$]<br />
	&nbsp;&nbsp; &nbsp;&quot;bmul&quot;=&gt;&quot;&lt;div class=\&quot;xsub\&quot;&gt;&quot;, // befor more ul ==&gt; $&lt;ul&gt;<br />
	&nbsp;&nbsp; &nbsp;&quot;amul&quot;=&gt;&quot;&lt;/div&gt;&quot;, // after more ul ==&gt; &lt;/ul&gt;$<br />
	&nbsp;&nbsp; &nbsp;&quot;mulc&quot;=&gt;&quot;subm&quot;, // more ul class ==&gt; &lt;ul class=&quot;$&quot;&gt; [ul li ul li ul.$]<br />
	&nbsp;&nbsp; &nbsp;&quot;bflisa&quot;=&gt;&quot;&lt;span&gt;&quot;, // before frist li start a element ==&gt; $&lt;a&gt;<br />
	&nbsp;&nbsp; &nbsp;&quot;aflisa&quot;=&gt;&quot;&quot;, // after frist li start a element ==&gt; &lt;a&gt;$<br />
	&nbsp;&nbsp; &nbsp;&quot;bfliea&quot;=&gt;&quot;&quot;, // before frist li end a element ==&gt; $&lt;/a&gt;<br />
	&nbsp;&nbsp; &nbsp;&quot;afliea&quot;=&gt;&quot;&lt;/span&gt;&quot;, // after frist li end a element ==&gt; &lt;/a&gt;$<br />
	&nbsp;&nbsp; &nbsp;&quot;bslisa&quot;=&gt;&quot;&lt;span&gt;&quot;, // before second li start a element ==&gt; $&lt;a&gt;<br />
	&nbsp;&nbsp; &nbsp;&quot;aslisa&quot;=&gt;&quot;&quot;, // after second li start a element ==&gt; &lt;a&gt;$<br />
	&nbsp;&nbsp; &nbsp;&quot;bsliea&quot;=&gt;&quot;&quot;, // before second li end a element ==&gt; $&lt;/a&gt;<br />
	&nbsp;&nbsp; &nbsp;&quot;asliea&quot;=&gt;&quot;&lt;/span&gt;&quot;, // after second li end a element ==&gt; &lt;/a&gt;$<br />
	&nbsp;&nbsp; &nbsp;&quot;bmlisa&quot;=&gt;&quot;&lt;span&gt;&quot;, // before more li start a element ==&gt; $&lt;a&gt;<br />
	&nbsp;&nbsp; &nbsp;&quot;amlisa&quot;=&gt;&quot;&quot;, // before more li start a element ==&gt; &lt;a&gt;$<br />
	&nbsp;&nbsp; &nbsp;&quot;bmliea&quot;=&gt;&quot;&quot;, // after more li end a element ==&gt; $&lt;/a&gt;<br />
	&nbsp;&nbsp; &nbsp;&quot;amliea&quot;=&gt;&quot;&lt;/span&gt;&quot; // after more li end a element ==&gt; &lt;/a&gt;$<br />
	);</pre></p>
<p>تمامی دستورات این رابط به طور پیشفرض  خالی می باشد و شما برای ساده نویسی خط هایی را که نمیخواهید پاک کنید.</p>
<p></p>
<p></p>
<br><hr><br>
<p>کاری از تیم <a href="http://www.xstar.ir/">ایکس استار</a></p>
</div>
</div>
</div>
</div><?php
CloseAdminTable();
include ("footer.php");
}
function mgmenu() {
	global $prefix, $db, $dbname, $com, $sxid,$mgeleman,$xmtitle,$xmclass,$xmlink,$sigaro,$xmsub,$sonan;
include ("header.php");
GraphicAdmin();
OpenAdminTable();
if(isset($mgeleman)){
$result = $db->sql_query("SELECT *
FROM `" . $prefix . "_xmenu`
WHERE `xmid` =$mgeleman
LIMIT 0 , 1");
	while ($row = $db->sql_fetchrow($result)) {
	mb_internal_encoding('UTF-8');
	$xmid = intval($row['xmid']);
	$xmsub = $row['xmsub'];
	edxm($mgeleman, $xmsub, $xmclass, $xmtitle, $xmlink);
	massaggex("ویرایش با موفقیت انجام شد.");
	mkfmgmenu("mgmenu","","","");
	vfmgmenu();
}
}elseif(isset($sigaro)){
$result = $db->sql_query("SELECT *
FROM `" . $prefix . "_xmenu`
WHERE `xmid` =$sigaro
LIMIT 0 , 1");
	while ($row = $db->sql_fetchrow($result)) {
	mb_internal_encoding('UTF-8');
	$xidd = $row['xid'];
	edxm($sigaro, $xmsub, $xmclass, $xmtitle, $xmlink);
	massaggex("ویرایش با موفقیت انجام شد.");
?>
<style type="text/css">
.Contents ul{padding-right:15px;}
</style>
<p style="text-align:center">نمای کلی منو</p>
<?php
echo xmenux($xidd);
?>
<br><hr><br>
<?php
mkggmgmenu("","","","",$xidd,"");
vfxgmgmenu($xidd);
}
}elseif($com=="mng" & isset($sxid)){
?>
<style type="text/css">
.Contents ul{padding-right:15px;}
</style>
<p style="text-align:center">نمای کلی منو</p>
<?php
echo xmenux($sxid);
?>
<br><hr><br>
<?php
mkggmgmenu("","","","",$sxid,"");
vfxgmgmenu($sxid);
}elseif(isset($xmtitle) AND isset($xmclass) AND isset($xmlink) AND isset($xmsub)){
mkxm($sonan, $xmsub, $xmclass, $xmtitle, $xmlink);
massaggex("منو اضافه شد.");
mkggmgmenu("","","","",$sonan,"");
vfxgmgmenu($sonan);
}elseif(isset($xmtitle) AND isset($xmclass) AND isset($xmlink)){
mkxm(0, "ulmenu", $xmclass, $xmtitle, $xmlink);
massaggex("منو جامه اضافه شد.");
	mkfmgmenu("mgmenu","","","");
	vfmgmenu();
}elseif($com=="dele" & isset($sxid)){
dkxm($sxid);
massaggex("حذف با موفقیت انجام شد.");
mkfmgmenu("mgmenu","","","");
vfmgmenu();
}elseif($com=="delek" & isset($sxid)){
$result = $db->sql_query("SELECT *
FROM `" . $prefix . "_xmenu`
WHERE `xmid` =$sxid
LIMIT 0 , 1");
	while ($row = $db->sql_fetchrow($result)) {
	mb_internal_encoding('UTF-8');
	$xidd = $row['xid'];
}
dkxm($sxid);
?>
<style type="text/css">
.Contents ul{padding-right:15px;}
</style>
<p style="text-align:center">نمای کلی منو</p>
<?php
xmenux($xidd);
?>
<br><hr><br>
<?php
massaggex("حذف با موفقیت انجام شد.");
mkggmgmenu("","","","",$xidd,"");
vfxgmgmenu($xidd);
}elseif($com=="empty"){
$db->sql_query("TRUNCATE TABLE `" . $prefix . "_xmenu`");
massaggex("دیتابیس پاکسازی شد.");
}elseif($com=="editk" & isset($sxid)){
$result = $db->sql_query("SELECT *
FROM `" . $prefix . "_xmenu`
WHERE `xmid` =$sxid
LIMIT 0 , 1");
	while ($row = $db->sql_fetchrow($result)) {
	mb_internal_encoding('UTF-8');
	$xmid = intval($row['xmid']);
	$xid = intval($row['xid']);
	$xmtitle = $row['xmtitle'];
	$xmclass = $row['xmclass'];
	$xmsub = $row['xmsub'];
	$xmlink = $row['xmlink'];
	mkggmgmenu($xmtitle,$xmlink,$xmclass,$xmsub,$xid,$xmid);
	}
}elseif($com=="edit" & isset($sxid)){
$result = $db->sql_query("SELECT *
FROM `" . $prefix . "_xmenu`
WHERE `xmid` =$sxid
LIMIT 0 , 1");
	while ($row = $db->sql_fetchrow($result)) {
	mb_internal_encoding('UTF-8');
	$xmid = intval($row['xmid']);
	$xmtitle = $row['xmtitle'];
	$xmclass = $row['xmclass'];
	$xmlink = $row['xmlink'];
	mkfmgmenu($xmid,$xmtitle,$xmclass,$xmlink);
	}
}else{
echo 0;
}
CloseAdminTable();
include ("footer.php");
}
switch($op) {
	case "xmenu":
		xmenu();
	break;
	case "mgmenu":
		mgmenu();
	break;
}

} else {
	header("location: ".$admin_file.".php");
}
?>