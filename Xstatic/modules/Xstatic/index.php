<?php
if (!defined('MODULE_FILE')) {
	die ("You can't access this file directly...");
}
require_once("mainfile.php");
$module_name = basename(dirname(__FILE__));
global $nukeurl, $prefix, $db, $xsurl, $staticcomm;
define('INDEX_FILE', true);
$pagetitle = "-  $xstitle";
$tags=check_html($xsurl);
$tags=htmlentities(trim($xsurl), ENT_QUOTES,"utf-8");
$xsurl=mysql_escape_string($xsurl);
function checksubxs($nuim){
global $prefix, $db, $dbname;
$nuim=intval($nuim);
$numrow = $db->sql_numrows($db->sql_query("SELECT *
FROM `" . $prefix . "_xstatic`
WHERE `xssid` =$nuim
LIMIT 0 , 30"));
return $numrow;
}
function checkyesxs($item){
global $prefix, $db, $dbname;
$numrow = $db->sql_numrows($db->sql_query("SELECT *
FROM `" . $prefix . "_xstatic`
WHERE `xsgt` = '$item'
LIMIT 0 , 30"));
return $numrow;
}
function checkysxds($nuim){
global $prefix, $db, $dbname;
$nuim=intval($nuim);
$result = $db->sql_query("SELECT *
FROM `" . $prefix . "_xstatic`
WHERE `xsid` =$nuim
LIMIT 0 , 1");
	while ($row = $db->sql_fetchrow($result)) {
	mb_internal_encoding('UTF-8');
	$xsid = intval($row['xssid']);
}
return $xsid;
}
function checkvojxs($nuim,$nuim1){
global $prefix, $db, $dbname;
$result = $db->sql_query("SELECT *
FROM `" . $prefix . "_xstatic`
WHERE `xssid` =$nuim1
AND `xsgt` = '$nuim'
ORDER BY `" . $prefix . "_xstatic`.`xsid` DESC
LIMIT 0 , 1");
	while ($row = $db->sql_fetchrow($result)) {
	mb_internal_encoding('UTF-8');
	$xsid = intval($row['xsid']);
}
return $xsid;
}
function gettitlexs($nuim,$nuim1){
global $prefix, $db, $dbname;
$result = $db->sql_query("SELECT *
FROM `" . $prefix . "_xstatic`
WHERE `xssid` =$nuim1
AND `xsgt` = '$nuim'
ORDER BY `" . $prefix . "_xstatic`.`xsid` DESC
LIMIT 0 , 1");
	while ($row = $db->sql_fetchrow($result)) {
	mb_internal_encoding('UTF-8');
	$xsid = $row['xstitle'];
}
return $xsid;
}
function gettitlexsx($nuim){
global $prefix, $db, $dbname;
$result = $db->sql_query("SELECT *
FROM `" . $prefix . "_xstatic`
WHERE `xsid` =$nuim
LIMIT 0 , 1");
	while ($row = $db->sql_fetchrow($result)) {
	mb_internal_encoding('UTF-8');
	$xsid = $row['xstitle'];
}
return $xsid;
}
function xsgetpageid($nuim,$nuim1){
global $prefix, $db, $dbname;
$result = $db->sql_query("SELECT *
FROM `" . $prefix . "_xstatic`
WHERE `xssid` =$nuim1
AND `xsgt` = '$nuim'
ORDER BY `" . $prefix . "_xstatic`.`xsid` DESC
LIMIT 0 , 1");
	while ($row = $db->sql_fetchrow($result)) {
	mb_internal_encoding('UTF-8');
	$xsid = intval($row['xsid']);
}
return $xsid;
}
function xscounterx($nuim){
global $prefix, $db, $dbname;
$result = $db->sql_query("SELECT *
FROM `" . $prefix . "_xstatic`
WHERE `xsid` =$nuim
ORDER BY `" . $prefix . "_xstatic`.`xsid` DESC
LIMIT 0 , 1");
	while ($row = $db->sql_fetchrow($result)) {
	mb_internal_encoding('UTF-8');
	$xscounter = intval($row['xscounter']);
}
$xscounter=$xscounter+1;
$db->sql_query("UPDATE `$dbname`.`" . $prefix . "_xstatic` SET `xscounter` = '$xscounter' WHERE `" . $prefix . "_xstatic`.`xsid` =$nuim;");
}
function xsindex(){
global $prefix, $db, $dbname;
$numrow = $db->sql_numrows($db->sql_query("SELECT *
FROM `" . $prefix . "_xstatic`
LIMIT 0 , 30"));
if($numrow==0){
OpenTable();
?><p style="text-align:center;font:bold 24px 'Segoe UI',tahoma,arial;color:#ff3333;">تا کنون صفحه ای ثبت نشده است.</p><?php
CloseTable();
}else{
?><p style="font:normal 14px 'Segoe UI',tahoma,arial">صفحه های سایت</p>
<script src="modules/Xstatic/script/jquery.treeview.js" type="text/javascript"></script>
<script type="text/javascript">
$(document).ready(function(){$("#red").treeview({animated:"fast",collapsed:true,control:"#treecontrol"})})
</script>
<style type="text/css">
.treeview, .treeview ul{padding:0;margin:0;list-style:none;}
.treeview ul{margin-top:4px;}
.treeview .hitarea{height:16px;width:16px;margin-right:-16px;float:right;cursor:pointer;background:url(modules/Xstatic/images/17.png) center center no-repeat;}
.treeview .collapsable-hitarea{background:url(modules/Xstatic/images/18.png) center center no-repeat;}
* html .hitarea{display:inline;float:none;}
.treeview li{margin:0;padding:3px 16px 3px 0;}
#treecontrol{margin:1em 0;display:none;}
.treeview .hover{color:red;cursor:pointer;}
.filetree li{padding:3px 16px 2px 0;}
.filetree span.folder, .filetree span.file{padding:1px 16px 1px 0;display:block;}
.treeview li a{color:#000;font:normal 11px tahoma;}
.treeview li a:hover{color:#359fba;}
.treeview li ul li a{color:#000;font:normal 11px tahoma;}
</style>
<p><ul id="red" class="treeview-red">
<?php
$result = $db->sql_query("SELECT *
FROM `" . $prefix . "_xstatic`
WHERE `xssid` =0
ORDER BY `" . $prefix . "_xstatic`.`xsid` DESC
LIMIT 0 , 99999");
	while ($row = $db->sql_fetchrow($result)) {
	mb_internal_encoding('UTF-8');
	$xsid = intval($row['xsid']);
	$xstitle = $row['xstitle'];
	$xsgt = $row['xsgt'];
	?>	<li><a href="modules.php?name=Xstatic&xsurl=<?php echo $xsgt; ?>/"><?php echo $xstitle; ?></a><?php if(checksubxs($xsid)>0){xsmorepage($xsid,$xsgt);} ?></li><?php
	}
?>
</ul></p><?php
}
}
function xsmorepagee($nuim,$xsmgt){
global $prefix, $db, $dbname;
$nuim=intval($nuim);
$xsmgtt="$xsmgt/";
?><ul><?php
$result = $db->sql_query("SELECT *
FROM `" . $prefix . "_xstatic`
WHERE `xssid` =$nuim
ORDER BY `" . $prefix . "_xstatic`.`xsid` DESC
LIMIT 0 , 99999");
	while ($row = $db->sql_fetchrow($result)) {
	mb_internal_encoding('UTF-8');
	$xsid = intval($row['xsid']);
	$xstitle = $row['xstitle'];
	$xsgt = $row['xsgt'];
	$xsmgttt="$xsmgtt$xsgt";
	?>	<li><a href="modules.php?name=Xstatic&xsurl=<?php echo $xsmgttt; ?>/"><?php echo $xstitle; ?></a><?php if(checksubxs($xsid)>0){xsmorepage($xsid,$xsmgttt);} ?></li>
	<?php
	}
?></ul><?php
}
function asdasjda($xsid,$xsmgtt,$hudjs){
global $prefix, $db, $dbname;
?><p style="font:normal 14px 'Segoe UI',tahoma,arial">صفحه های <?php echo gettitlexsx($xsid); ?></p>
<script src="modules/Xstatic/script/jquery.treeview.js" type="text/javascript"></script>
<script type="text/javascript">
$(document).ready(function(){$("#red").treeview({animated:"fast",collapsed:true,control:"#treecontrol"})})
</script>
<style type="text/css">
.treeview, .treeview ul{padding:0;margin:0;list-style:none;}
.treeview ul{margin-top:4px;}
.treeview .hitarea{height:16px;width:16px;margin-right:-16px;float:right;cursor:pointer;background:url(modules/Xstatic/images/17.png) center center no-repeat;}
.treeview .collapsable-hitarea{background:url(modules/Xstatic/images/18.png) center center no-repeat;}
* html .hitarea{display:inline;float:none;}
.treeview li{margin:0;padding:3px 16px 3px 0;}
#treecontrol{margin:1em 0;display:none;}
.treeview .hover{color:red;cursor:pointer;}
.filetree li{padding:3px 16px 2px 0;}
.filetree span.folder, .filetree span.file{padding:1px 16px 1px 0;display:block;}
.treeview li a{color:#000;font:normal 11px tahoma;}
.treeview li a:hover{color:#359fba;}
.treeview li ul li a{color:#000;font:normal 11px tahoma;}
</style>
<p><ul id="red" class="treeview-red"><?php
$result = $db->sql_query("SELECT *
FROM `" . $prefix . "_xstatic`
WHERE `xssid` =$xsid
ORDER BY `" . $prefix . "_xstatic`.`xsid` DESC
LIMIT 0 , 99999");
	while ($row = $db->sql_fetchrow($result)) {
	mb_internal_encoding('UTF-8');
	$xsid = intval($row['xsid']);
	$xstitle = $row['xstitle'];
	$xsgt = $row['xsgt'];
	$xsmgttt="$hudjs$xsmgtt$xsgt";
	?>	<li><a href="modules.php?name=Xstatic&xsurl=<?php echo $xsmgttt; ?>/"><?php echo $xstitle; ?></a><?php if(checksubxs($xsid)>0){xsmorepagee($xsid,$xsmgttt);} ?></li>
	<?php
	}
?></ul></p><?php
}
function xsmorepage($nuim,$xsmgt){
global $prefix, $db, $dbname;
$nuim=intval($nuim);
$xsmgtt="$xsmgt/";
?><ul><?php
$result = $db->sql_query("SELECT *
FROM `" . $prefix . "_xstatic`
WHERE `xssid` =$nuim
ORDER BY `" . $prefix . "_xstatic`.`xsid` DESC
LIMIT 0 , 99999");
	while ($row = $db->sql_fetchrow($result)) {
	mb_internal_encoding('UTF-8');
	$xsid = intval($row['xsid']);
	$xstitle = $row['xstitle'];
	$xsgt = $row['xsgt'];
	$xsmgttt="$xsmgtt$xsgt";
	?>	<li><a href="modules.php?name=Xstatic&xsurl=<?php echo $xsmgttt; ?>/"><?php echo $xstitle; ?></a><?php if(checksubxs($xsid)>0){xsmorepage($xsid,$xsmgttt);} ?></li>
	<?php
	}
?></ul><?php
}
if(isset($xsurl) AND $xsurl!==""){
$xsurl=explode('/', $xsurl);
$checkarrayxs=count($xsurl);
if($xsurl[$checkarrayxs-1]==""){unset($xsurl[$checkarrayxs-1]);}
$checkarrayxs=count($xsurl);
$xserr=0;
$xserrr=0;
$xserrrr=0;
$getxsurl="";
$getxsu="";
$hudjs="";
foreach ($xsurl as $value) {
if(checkyesxs($value)==0){$xserr=1;}
if($xserrrr==checkysxds(checkvojxs($value,$xserrrr))){}else{$xserr=1;}
$getxsu .="$value/";
$hudjs .="$value/";
if($xsurl[$checkarrayxs-1]==$value){}else{$getxsurl .="<a href=\"modules.php?name=Xstatic&xsurl=$getxsu\">";}
$getxsurl .=gettitlexs($value,$xserrrr);
if($xsurl[$checkarrayxs-1]==$value){}else{$getxsurl .="</a> > ";}
$xserrrr=xsgetpageid($value,$xserrrr);
$resum=$value;

}
if($xserr==1){
$pagetitle = "-  صفحه یافت نشد";
include("header.php");
OpenTable();
?><p style="text-align:center;font:bold 24px 'Segoe UI',tahoma,arial;color:#ff3333;">صفحه مورد نظر پیدا نشد</p><?php
CloseTable();
OpenTable();
xsindex();
CloseTable();
include("footer.php");
}else{
$result = $db->sql_query("SELECT *
FROM `" . $prefix . "_xstatic`
WHERE `xsid` =$xserrrr
LIMIT 0 , 1");
	while ($row = $db->sql_fetchrow($result)) {
	mb_internal_encoding('UTF-8');
	$xsid = intval($row['xsid']);
	$xscounter = intval($row['xscounter']);
	$xstitle = $row['xstitle'];
	$xstext = $row['xstext'];
	$xstags = $row['xstags'];
	$xredirect = $row['xredirect'];
	xscounterx($xsid);
	$pagetitle = "-  $xstitle";
	if($xredirect!==""){
	Header("Location: $xredirect");
	}
	include("header.php");
	OpenTable();
	echo"<p style=\"font-weight:bold;\"><a href=\"modules.php?name=Xstatic\">صفحه ها</a> > $getxsurl</p>";
	CloseTable();
	OpenTable();
	echo $xstext;
?><br><hr><br><p>بازدید : <?php echo $xscounter; ?> بار</p><?php
?><p>کلمات کلیدی : <?php echo $xstags; ?></p><?php
	CloseTable();
	if(checksubxs($xsid)>0){
	OpenTable();
	asdasjda($xsid,$xsmgtt,$hudjs);
	CloseTable();
	}
	$staticid = $xsid;
		if($staticcomm == 1){
			$comcode = 5;
			$comtable = "staticpages_comments";
			OpenTable();
			include("includes/comments.php");
			CloseTable();
		}
	include("footer.php");
	}
}
}else{
	$pagetitle = "-  صفحه ها";
	include("header.php");
OpenTable();
xsindex();
CloseTable();
	include("footer.php");
}
?>