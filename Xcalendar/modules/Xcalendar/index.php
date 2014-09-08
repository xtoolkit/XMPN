<?php
if (!defined('MODULE_FILE')) {
	die ("You can't access this file directly...");
}
require_once("mainfile.php");
$module_name = basename(dirname(__FILE__));
global $nukeurl, $dbname, $prefix, $db, $xccset, $xcmonth, $xcyear, $xcday;
if(isset($xcmonth)){$xcmonth=intval($xcmonth);}
if(isset($xcyear)){$xcyear=intval($xcyear);}
if(isset($xcday)){$xcday=intval($xcday);}
define('INDEX_FILE', true);
include("header.php");
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
function xccheckactivity($xcmc,$xcy,$xcm,$xcd){
global $prefix, $db, $dbname;
if($xcmc=="shamsi"){
require_once("includes/jdatetime.class.php");
$date=new jDateTime(true, true, 'Asia/Tehran');
$time = $date->mktime(0,0,0, $xcm, $xcd, $xcy);
$xcy=$date->date("Y", $time, false, false);
$xcm=$date->date("m", $time, false, false);
$xcd=$date->date("d", $time, false, false);
}
$xcset=0;
if(xcvs(3)==1){
$result=$db->sql_query("SELECT *
FROM `" . $prefix . "_stories`
ORDER BY `" . $prefix . "_stories`.`sid` DESC
LIMIT 0 , 999999");
	while ($row=$db->sql_fetchrow($result)) {
	mb_internal_encoding('UTF-8');
	$xcnow=$row['time'];
	$xcnowdx=date("d", $xcnow);
	$xcnowyx=date("Y", $xcnow);
	$xcnowmx=date("m", $xcnow);
	if($xcnowdx==$xcd AND $xcnowyx==$xcy AND $xcnowmx==$xcm){$xcset=1;}
}
}
if(xcvs(4)==1){
$result=$db->sql_query("SELECT *
FROM `" . $prefix . "_products`
ORDER BY `" . $prefix . "_products`.`sid` DESC
LIMIT 0 , 999999");
	while ($row=$db->sql_fetchrow($result)) {
	mb_internal_encoding('UTF-8');
	$xcnow=$row['time'];
	$xcnowdx=date("d", $xcnow);
	$xcnowyx=date("Y", $xcnow);
	$xcnowmx=date("m", $xcnow);
	if($xcnowdx==$xcd AND $xcnowyx==$xcy AND $xcnowmx==$xcm){$xcset=1;}
}
}
if(xcvs(5)==1){
$result=$db->sql_query("SELECT *
FROM `" . $prefix . "_pages`
ORDER BY `" . $prefix . "_pages`.`pid` DESC
LIMIT 0 , 999999");
	while ($row=$db->sql_fetchrow($result)) {
	mb_internal_encoding('UTF-8');
	$xcnow=$row['date'];
	$xcnowdx=date("d", $xcnow);
	$xcnowyx=date("Y", $xcnow);
	$xcnowmx=date("m", $xcnow);
	if($xcnowdx==$xcd AND $xcnowyx==$xcy AND $xcnowmx==$xcm){$xcset=1;}
}
}
return $xcset;
}
function xcvitemxs($xcy,$xcm,$xcd){
global $prefix, $db, $dbname;
if(xcvs(3)==1){
$numrow = $db->sql_numrows($db->sql_query("SELECT *
FROM `" . $prefix . "_stories`
ORDER BY `" . $prefix . "_stories`.`sid` DESC
LIMIT 0 , 999999"));
if($numrow>0) {
$asdas=0;
$result=$db->sql_query("SELECT *
FROM `" . $prefix . "_stories`
ORDER BY `" . $prefix . "_stories`.`sid` DESC
LIMIT 0 , 999999");
	while ($row=$db->sql_fetchrow($result)) {
	mb_internal_encoding('UTF-8');
	$xcnow=$row['time'];
	$xcisid=$row['sid'];
	$xcititle=$row['title'];
	$xcicounter=$row['counter'];
	$xcnowdx=date("d", $xcnow);
	$xcnowyx=date("Y", $xcnow);
	$xcnowmx=date("m", $xcnow);
if($xcnowdx==$xcd AND $xcnowyx==$xcy AND $xcnowmx==$xcm){$asdas=$asdas+1;
if($asdas==1){ ?><p><font color="#666666"><span style="FONT-WEIGHT: 700; FONT-SIZE: 8pt">خبر های منتشر شده در این روز :</span></font></p>
<?php  }
?><div style="padding:5px;margin:3px;border:1px solid #cccccc;"><b><a href="<?php echo newslink($xcisid); ?>">&nbsp;<?php echo $xcititle; ?></a></b> &nbsp;<?php echo $xcicounter; ?> مشاهده [ <?php echo nuketimes($xcnow); ?> ]</div>
<?php }
}
echo"<br>";}
}
if(xcvs(4)==1){
$numrow = $db->sql_numrows($db->sql_query("SELECT *
FROM `" . $prefix . "_products`
ORDER BY `" . $prefix . "_products`.`sid` DESC
LIMIT 0 , 999999"));
if($numrow>0) {
$asdas=0;
$result=$db->sql_query("SELECT *
FROM `" . $prefix . "_products`
ORDER BY `" . $prefix . "_products`.`sid` DESC
LIMIT 0 , 999999");
	while ($row=$db->sql_fetchrow($result)) {
	mb_internal_encoding('UTF-8');
	$xcnow=$row['time'];
	$xcisid=$row['sid'];
	$xcititle=$row['title'];
	$xcicounter=$row['counter'];
	$xcnowdx=date("d", $xcnow);
	$xcnowyx=date("Y", $xcnow);
	$xcnowmx=date("m", $xcnow);
if($xcnowdx==$xcd AND $xcnowyx==$xcy AND $xcnowmx==$xcm){$asdas=$asdas+1;
if($asdas==1){ ?><p><font color="#666666"><span style="FONT-WEIGHT: 700; FONT-SIZE: 8pt">محصولات منتشر شده در این روز :</span></font></p>
<?php  }
?><div style="padding:5px;margin:3px;border:1px solid #cccccc;"><b><a href="<?php echo product_link($xcisid); ?>">&nbsp;<?php echo $xcititle; ?></a></b> &nbsp;<?php echo $xcicounter; ?> مشاهده [ <?php echo nuketimes($xcnow); ?> ]</div>
<?php }
}
echo"<br>";}
}
if(xcvs(5)==1){
$numrow = $db->sql_numrows($db->sql_query("SELECT *
FROM `" . $prefix . "_pages`
ORDER BY `" . $prefix . "_pages`.`pid` DESC
LIMIT 0 , 999999"));
if($numrow>0) {
$asdas=0;
$result=$db->sql_query("SELECT *
FROM `" . $prefix . "_pages`
ORDER BY `" . $prefix . "_pages`.`pid` DESC
LIMIT 0 , 999999");
	while ($row=$db->sql_fetchrow($result)) {
	mb_internal_encoding('UTF-8');
	$xcnow=$row['date'];
	$xcisid=$row['pid'];
	$xcititle=$row['title'];
	$xcicounter=$row['counter'];
	$xcnowdx=date("d", $xcnow);
	$xcnowyx=date("Y", $xcnow);
	$xcnowmx=date("m", $xcnow);
if($xcnowdx==$xcd AND $xcnowyx==$xcy AND $xcnowmx==$xcm){$asdas=$asdas+1;
if($asdas==1){ ?><p><font color="#666666"><span style="FONT-WEIGHT: 700; FONT-SIZE: 8pt">مقالات منتشر شده در این روز :</span></font></p>
<?php  }
?><div style="padding:5px;margin:3px;border:1px solid #cccccc;"><b><a href="<?php echo content_link($xcisid); ?>">&nbsp;<?php echo $xcititle; ?></a></b> &nbsp;<?php echo $xcicounter; ?> مشاهده [ <?php echo nuketimes($xcnow); ?> ]</div>
<?php }
}
}
}
}
function xcstylecss(){
?><style type="text/css">
div.k2CalendarBlock{height:auto;margin:8px 0}
table.calendar{width:99%;margin:0 auto;background:#fff;border-collapse:collapse}
table.calendar tr td{height:30px;text-align:center;vertical-align:middle;padding:2px;border:1px solid #f4f4f4;background:#fff}
table.calendar tr td.calendarNavMonthPrev{background:#f3f3f3;text-align:left}
table.calendar tr td.calendarNavMonthPrev a{font-size:20px;text-decoration:none}
table.calendar tr td.calendarNavMonthPrev a:hover{font-size:20px;text-decoration:none}
table.calendar tr td.calendarCurrentMonth{background:#f3f3f3}
table.calendar tr td.calendarNavMonthNext{background:#f3f3f3;text-align:right}
table.calendar tr td.calendarNavMonthNext a{font-size:20px;text-decoration:none}
table.calendar tr td.calendarNavMonthNext a:hover{font-size:20px;text-decoration:none}
table.calendar tr td.calendarDayName{background:#e9e9e9;font-size:11px;width:14.2%}
table.calendar tr td.calendarDateEmpty{background:#fbfbfb}
table.calendar tr td.calendarDate{}
table.calendar tr td.calendarDateLinked{padding:0}
table.calendar tr td.calendarDateLinked a{display:block;padding:9px;text-decoration:none;background:#eee}
table.calendar tr td.calendarDateLinked a:hover{display:block;background:#135cae;color:#fff;padding:9px;text-decoration:none}
table.calendar tr td.calendarToday{background:#555;color:#fff}
table.calendar tr td.calendarTodayLinked{background:#135cae;color:#fff;padding:0}
table.calendar tr td.calendarTodayLinked a{display:block;padding:9px;color:#fff;text-decoration:none}
table.calendar tr td.calendarTodayLinked a:hover{display:block;background:#BFD9FF;padding:9px;text-decoration:none}
</style><?php
}
OpenTable();
if(isset($xcmonth) AND (12<$xcmonth OR $xcmonth<1)){
?><p><center><span style="color:#C00;">همچین ماه ـی وجود ندارد !!! عدد ماه 1-12 می باشد!!!</span></center></p><?php
}elseif(isset($xcday) AND isset($xcmonth) AND isset($xcyear) AND 32>$xcday AND $xcday>0){
if($xccset=="shamsi"){
$xctesla="هجری شمسی";
}elseif($xccset=="miladi"){
$xctesla="میلادی";
}elseif(xcvs(1)==1){
$xctesla="هجری شمسی";
$xccset="shamsi";
}elseif(xcvs(1)==2){
$xctesla="میلادی";
$xccset="miladi";
}
?><p><center><span style="color:#C00;">روز انتخاب شده : <?php echo $xcyear; ?>/<?php echo $xcmonth; ?>/<?php echo $xcday; ?> <?php echo $xctesla; ?></span></center></p><?php
if(xccheckactivity($xccset,$xcyear,$xcmonth,$xcday)==1){
if($xccset=="shamsi"){
require_once("includes/jdatetime.class.php");
$date=new jDateTime(true, true, 'Asia/Tehran');
$time = $date->mktime(0,0,0, $xcmonth, $xcday, $xcyear);
$xcyear=$date->date("Y", $time, false, false);
$xcmonth=$date->date("m", $time, false, false);
$xcday=$date->date("d", $time, false, false);
}
xcvitemxs($xcyear,$xcmonth,$xcday);
?><p><center><a href="modules.php?name=Xcalendar" style="color:#black;">بازگشت به تقویم</a></center></p><?php
}else{
if(xcvs(3)==1 AND xcvs(4)==1 AND xcvs(5)==1){
$sasdsdsgasd="خبر ، محصول و مقاله ای";
}elseif(xcvs(3)==1 AND xcvs(4)==1){
$sasdsdsgasd="خبر و محصولی";
}elseif(xcvs(3)==1 AND xcvs(5)==1){
$sasdsdsgasd="خبر و مقاله ای";
}elseif(xcvs(4)==1 AND xcvs(5)==1){
$sasdsdsgasd="محصول و مقاله ای";
}elseif(xcvs(3)==1){
$sasdsdsgasd="خبری";
}elseif(xcvs(4)==1){
$sasdsdsgasd="محصولی";
}elseif(xcvs(5)==1){
$sasdsdsgasd="مقاله ای";
}
if(xcvs(3)==0 AND xcvs(4)==0 AND xcvs(5)==0){}else{
?><p><center><span style="color:#C00;">متاسفانه در این روز <?php echo $sasdsdsgasd; ?> در سایت ثبت نشده است.</span></center></p>
<p><center><a href="modules.php?name=Xcalendar" style="color:#black;">بازگشت به تقویم</a></center></p><?php
}
}
}elseif($xccset=="shamsi"){
require_once("modules/Xcalendar/Xcals.php");
?><p><center>تقویم هجری شمسی سایت</center></p><?php
CloseTable();
OpenTable();
xcstylecss();xcalsf($xcyear,$xcmonth);
}elseif($xccset=="miladi"){
require_once("modules/Xcalendar/Xcalg.php");
?><p><center>تقویم میلادی سایت</center></p><?php
CloseTable();
OpenTable();
xcstylecss();xcalgf($xcyear,$xcmonth);
}elseif(xcvs(1)==1){
require_once("modules/Xcalendar/Xcals.php");
?><p><center>تقویم هجری شمسی سایت</center></p><?php
CloseTable();
OpenTable();
xcstylecss();xcalsf($xcyear,$xcmonth);
}elseif(xcvs(1)==2){
require_once("modules/Xcalendar/Xcalg.php");
?><p><center>تقویم میلادی سایت</center></p><?php
CloseTable();
OpenTable();
xcstylecss();xcalgf($xcyear,$xcmonth);
}else{
echo "out";
}
CloseTable();
include("footer.php");
?>