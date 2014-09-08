<?php
if (!defined('MODULE_FILE')) {
	die ("You can't access this file directly...");
}
require_once("mainfile.php");
$module_name = basename(dirname(__FILE__));
global $nukeurl, $prefix, $db, $com, $xlbid, $xlbpwhr, $xlbreport, $xset;
define('INDEX_FILE', true);
if($xset=="XlinksBox"){
function xlbsetv($nuim){
global $prefix, $db, $dbname;
$nuim=intval($nuim);
$result = $db->sql_query("SELECT * FROM `" . $prefix . "_xlbset` WHERE `xlb` =$nuim LIMIT 0 , 1");
	while ($row = $db->sql_fetchrow($result)) {
	mb_internal_encoding('UTF-8');
	$xlbname = $row['xlbvalue'];
}
return $xlbname;
}
function xlbdlgra($nuim,$mod){
global $prefix, $db, $dbname;
$nuim=intval($nuim);
$result = $db->sql_query("SELECT *
FROM `" . $prefix . "_xlinksbox`
WHERE `xlbid` =$nuim
LIMIT 0 , 1");
	while ($row = $db->sql_fetchrow($result)) {
	mb_internal_encoding('UTF-8');
	$xlbvi = $row['xlbvi'];
	if($mod=="xlbdl"){$xlbdlgr = $row['xlbdl'];}
	if($mod=="xlbmdl"){$xlbdlgr = $row['xlbmrdl'];}
	if($mod=="xlbsc"){$xlbdlgr = $row['xlbscsh'];}
}
if($mod=="xlbsc"){}else{
$xlbvi=$xlbvi+1;
$db->sql_query("UPDATE `$dbname`.`" . $prefix . "_xlinksbox` SET `xlbvi` = '$xlbvi' WHERE `nuke_xlinksbox`.`xlbid` =$nuim;");
}
return $xlbdlgr;
}
function xlbpwform($item1,$item2,$item3){
include("header.php");
OpenTable();
if($item3==0){}else{ ?><p><center><span style="color:#C00;">رمز نادرست است !!!</span></center></p><?php } ?>
<p><span style="color:#C00;">برای دانلود این فایل رمز عبور نیاز می باشد.</span></p>
<form action="modules.php" method="get">
<input type="hidden" name="name" value="XMoreOption"/>
<input type="hidden" name="xset" value="XlinksBox"/>
<input type="hidden" name="com" value="<?php echo $item1; ?>"/>
<input type="hidden" name="xlbid" value="<?php echo $item2; ?>"/>
<label for="asdasd">رمز دانلود خود را وارد نمایید : <input type="password" id="asdasd" name="xlbpwhr" value=""/></label>
<input type="submit" value="دریافت"/>
</form>
<?php
CloseTable();
include("footer.php");
}
function redirect($url) {
        echo '<script type="text/javascript">';
        echo 'window.location.href="'.$url.'";';
        echo '</script>';
        echo '<noscript>';
        echo '<meta http-equiv="refresh" content="0;url='.$url.'" />';
        echo '</noscript>';
}
function checkhasfilex($nuim,$mod){
global $prefix, $db, $dbname;
$nuim=intval($nuim);

}
if($com=="xlbdl" AND isset($xlbid) AND $xlbid!==""){
$xlbdlgr=xlbdlgra($xlbid,$com);
if($xlbdlgr==""){
include("header.php");
OpenTable();
?><p><center><span style="color:#C00;">فایل مورد نظر یافت نشد</span></center></p><?php
CloseTable();
include("footer.php");
}else{
if(xlbsetv(4)==1){
if(isset($xlbpwhr)){
if(xlbsetv(5)==$xlbpwhr){
if(xlbsetv(6)==1){Header("Location: $xlbdlgr", true, 302);exit;}else{redirect($xlbdlgr);exit;}
}else{
xlbpwform($com,$xlbid,1);
}
}else{
xlbpwform($com,$xlbid,0);
}
}else{
if(xlbsetv(6)==1){Header("Location: $xlbdlgr", true, 302);exit;}else{redirect($xlbdlgr);exit;}
}
}
}elseif($com=="xlbmdl" AND isset($xlbid) AND $xlbid!==""){
$xlbdlgr=xlbdlgra($xlbid,$com);
if($xlbdlgr==""){
include("header.php");
OpenTable();
?><p><center><span style="color:#C00;">فایل مورد نظر یافت نشد</span></center></p><?php
CloseTable();
include("footer.php");
}else{
if(xlbsetv(4)==1){
if(isset($xlbpwhr)){
if(xlbsetv(5)==$xlbpwhr){
if(xlbsetv(6)==1){Header("Location: $xlbdlgr", true, 302);exit;}else{redirect($xlbdlgr);exit;}
}else{
xlbpwform($com,$xlbid,1);
}
}else{
xlbpwform($com,$xlbid,0);
}
}else{
if(xlbsetv(6)==1){Header("Location: $xlbdlgr", true, 302);exit;}else{redirect($xlbdlgr);exit;}
}
}
}elseif($com=="xlbsc" AND isset($xlbid) AND $xlbid!==""){
$xlbdlgr=xlbdlgra($xlbid,$com);
if($xlbdlgr==""){
include("header.php");
OpenTable();
?><p><center><span style="color:#C00;">فایل مورد نظر یافت نشد</span></center></p><?php
CloseTable();
include("footer.php");
}else{
redirect($xlbdlgr);exit;
}
}else{
	Header("Location: index.php");
	exit;
}
}else{
	Header("Location: index.php");
	exit;
}
?>