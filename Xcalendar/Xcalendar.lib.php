<?php
require_once("mainfile.php");
global $nukeurl, $dbname, $prefix, $db, $xccset, $xcmonth, $xcyear, $xcday;
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
if($xid==1){
$xreturn="<style type=\"text/css\">
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
</style>";
}else{
$xreturn="<style type=\"text/css\">
div.k2CalendarBlock{height:auto;margin:8px 0}
table.calendar{width:99%;margin:0 auto;background:#fff;border-collapse:collapse}
table.calendar tr td{height:20px;text-align:center;vertical-align:middle;padding:2px;border:1px solid #f4f4f4;background:#fff}
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
}
return $xreturn;
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
?>