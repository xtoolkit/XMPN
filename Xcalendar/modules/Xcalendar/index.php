﻿<?php
if (!defined('MODULE_FILE')) {
	die ("You can't access this file directly...");
}
require_once("mainfile.php");
$module_name = basename(dirname(__FILE__));
global $nukeurl, $dbname, $prefix, $db, $xccset, $xcmonth, $xcyear, $xcday;
if(isset($xcmonth)){$xcmonth=intval($xcmonth);}
if(isset($xcyear)){$xcyear=intval($xcyear);}
if(isset($xcday)){$xcday=intval($xcday);}
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
function xcvitemxs($xcmc,$xcy,$xcm,$xcd){
global $prefix, $db, $dbname;
if($xcmc=="shamsi"){
require_once("includes/jdatetime.class.php");
$date=new jDateTime(true, true, 'Asia/Tehran');
$time = $date->mktime(0,0,0, $xcm, $xcd, $xcy);
$xcy=$date->date("Y", $time, false, false);
$xcm=$date->date("m", $time, false, false);
$xcd=$date->date("d", $time, false, false);
}
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
function xcstylecss($xid){
$xreturn="<style type=\"text/css\">
div.k2CalendarBlock{height:auto;margin:8px 0}
table.calendar{width:99%;margin:0 auto;background:#fff;border-collapse:collapse}
table.calendar tr td{height:".$xid."px;text-align:center;vertical-align:middle;padding:2px;border:1px solid #f4f4f4;background:#fff}
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
</style>";
return $xreturn;
}
function xcbarmap($xcmod,$xcmodx,$xcyear,$xcmonth,$xcday){
if($xcmod=="shamsi"){
$monthNames=Array("فروردین", "اردیبهست", "خرداد", "تیر", "مرداد", "شهریور", "مهر", "آبان", "آذر", "دی", "بهمن", "اسفند");
}elseif($xcmod=="miladi"){
$monthNames=Array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
}
?>
<p style="font-weight:bold;">
<a href="modules.php?name=Xcalendar">تقویم سایت</a> > 
<a href="modules.php?name=Xcalendar&xccset=<?php echo $xcmod; ?>"><?php echo $xcmodx; ?></a> > 
<?php if(isset($xcyear) AND $xcyear!==""){ ?><a href="modules.php?name=Xcalendar&xccset=<?php echo $xcmod; ?>&xcyear=<?php echo $xcyear; ?>">سال <?php echo $xcyear; ?></a> <?php if(isset($xcmonth) AND $xcmonth!==""){ ?>> <?php }} ?>
<?php if(isset($xcmonth) AND $xcmonth!==""){ ?><a href="modules.php?name=Xcalendar&xccset=<?php echo $xcmod; ?>&xcyear=<?php echo $xcyear; ?>&xcmonth=<?php echo $xcmonth; ?>">ماه <?php echo $monthNames[$xcmonth-1]; ?></a> <?php if(isset($xcday) AND $xcday!==""){ ?>> <?php }} ?>
<?php if(isset($xcday) AND $xcday!==""){ ?><a href="modules.php?name=Xcalendar&xccset=<?php echo $xcmod; ?>&xcyear=<?php echo $xcyear; ?>&xcmonth=<?php echo $xcmonth; ?>&xcday=<?php echo $xcday; ?>">روز <?php echo $xcday; ?></a><?php } ?>
</p>
<?php
}
if($xccset=="miladi"){
$xccsetgh="miladi";
}elseif($xccset=="shamsi"){
$xccsetgh="shamsi";
}else{
if(xcvs(1)==2){
$xccsetgh="miladi";
}else{
$xccsetgh="shamsi";
}
}
if($xccsetgh=="miladi"){
if(!isset($xcyear)){$xcyear=date("Y");}
$fxcalsf="xcalmf";
$fxcaltitle="میلادی";
}elseif($xccsetgh=="shamsi"){
require_once("includes/jdatetime.class.php");
$date=new jDateTime(true, true, 'Asia/Tehran');
if(!isset($xcyear)){$xcyear=$date->date("Y",false, false);}
$fxcalsf="xcalsf";
$fxcaltitle="شمسی";
}
$xsprevxy=$xcyear-1;
$xsnextxy=$xcyear+1;
require_once("modules/Xcalendar/Xcals.php");
require_once("modules/Xcalendar/Xcalm.php");
OpenTable();
echo xcstylecss(30);
if(isset($xcmonth) AND (12<$xcmonth OR $xcmonth<1)){
?><p><center><span style="color:#C00;">همچین ماه ـی وجود ندارد !!! عدد ماه 1-12 می باشد!!!</span></center></p><?php
}elseif(isset($xcday) AND isset($xcmonth) AND isset($xcyear) AND 32>$xcday AND $xcday>0){
xcbarmap($xccsetgh,$fxcaltitle,$xcyear,$xcmonth,$xcday);
CloseTable();
OpenTable();
if(xccheckactivity($xccsetgh,$xcyear,$xcmonth,$xcday)==1){
xcvitemxs($xccsetgh,$xcyear,$xcmonth,$xcday);
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
if(xcvs(3)==0 AND xcvs(4)==0 AND xcvs(5)==0){
?><p><center><span style="color:#C00;">روز انتخاب شده : <?php echo $xcyear; ?>/<?php echo $xcmonth; ?>/<?php echo $xcday; ?> <?php echo $xctesla; ?></span></center></p><?php
}else{
?><p><center><span style="color:#C00;">متاسفانه در این روز <?php echo $sasdsdsgasd; ?> در سایت ثبت نشده است.</span></center></p><?php
}
?><p><center><a href="modules.php?name=Xcalendar" style="color:#black;">بازگشت به تقویم</a></center></p><?php
}
}else{
if(isset($xcmonth) AND $xcmonth!==""){
xcbarmap($xccsetgh,$fxcaltitle,$xcyear,$xcmonth,$xcday);
CloseTable();
OpenTable();
echo $fxcalsf($xcyear,$xcmonth,1,1);
}else{
xcbarmap($xccsetgh,$fxcaltitle,$xcyear,$xcmonth,$xcday);
CloseTable();
OpenTable();
?>
<table class="calendar">
<tr>
<td class="calendarNavMonthPrev"><a class="calendarNavLink" href="Xcalendar/<?php echo $xccsetgh; ?>/<?php echo $xsprevxy; ?>/">&laquo;</a></td>
<td class="calendarCurrentMonth" colspan="5"><?php echo $xcyear; ?></td>
<td class="calendarNavMonthNext"><a class="calendarNavLink" href="Xcalendar/<?php echo $xccsetgh; ?>/<?php echo $xsnextxy; ?>/">&raquo;</a></td></tr>
<tr>
</table>
<table align="center" border="0" cellpadding="0" cellspacing="0" width="100%">
<tr>
<td style="width:33.3%" valign="top"><?php echo $fxcalsf($xcyear,1,2,0); ?></td>
<td style="width:33.3%" valign="top"><?php echo $fxcalsf($xcyear,2,2,0); ?></td>
<td style="width:33.3%" valign="top"><?php echo $fxcalsf($xcyear,3,2,0); ?></td>
</tr>
<tr>
<td style="width:33.3%" valign="top"><?php echo $fxcalsf($xcyear,4,2,0); ?></td>
<td style="width:33.3%" valign="top"><?php echo $fxcalsf($xcyear,5,2,0); ?></td>
<td style="width:33.3%" valign="top"><?php echo $fxcalsf($xcyear,6,2,0); ?></td>
</tr>
<tr>
<td style="width:33.3%" valign="top"><?php echo $fxcalsf($xcyear,7,2,0); ?></td>
<td style="width:33.3%" valign="top"><?php echo $fxcalsf($xcyear,8,2,0); ?></td>
<td style="width:33.3%" valign="top"><?php echo $fxcalsf($xcyear,9,2,0); ?></td>
</tr>
<tr>
<td style="width:33.3%" valign="top"><?php echo $fxcalsf($xcyear,10,2,0); ?></td>
<td style="width:33.3%" valign="top"><?php echo $fxcalsf($xcyear,11,2,0); ?></td>
<td style="width:33.3%" valign="top"><?php echo $fxcalsf($xcyear,12,2,0); ?></td>
</tr>
</table><?php
}
}
CloseTable();
include("footer.php");
?>