<?php
if (stristr(htmlentities($_SERVER['PHP_SELF']), "Xcals.php")) {
	die ("You can't access this file directly...");
}
function xcalsf($xcyear,$xcmonth){
require_once("includes/jdatetime.class.php");
$date=new jDateTime(true, true, 'Asia/Tehran');
$monthNames=Array("فروردین", "اردیبهست", "خرداد", "تیر", "مرداد", "شهریور", "مهر", "آبان", "آذر", "دی", "بهمن", "اسفند");
if(!isset($xcmonth)){$xcmonth=$date->date("n",false, false);}
if(!isset($xcyear)){$xcyear=$date->date("Y",false, false);}
$cMonth=$xcmonth;
$cYear=$xcyear;
$prev_year=$cYear;
$next_year=$cYear;
$prev_month=$cMonth-1;
$next_month=$cMonth+1;
if($cMonth==1){
    $prev_month=12;
    $prev_year=$cYear-1;
}
if($cMonth==12){
    $next_month=1;
    $next_year=$cYear+1;
}
?><div id="k2ModuleBox194" class="k2CalendarBlock">
<table class="calendar">
<tr>
<td class="calendarNavMonthPrev"><a class="calendarNavLink" href="modules.php?name=Xcalendar&xccset=shamsi&xcyear=<?php echo $prev_year; ?>&xcmonth=<?php echo $prev_month; ?>">&laquo;</a></td>
<td class="calendarCurrentMonth" colspan="5"><?php echo $monthNames[$cMonth-1].' '.$cYear; ?></td>
<td class="calendarNavMonthNext"><a class="calendarNavLink" href="modules.php?name=Xcalendar&xccset=shamsi&xcyear=<?php echo $next_year; ?>&xcmonth=<?php echo $next_month; ?>">&raquo;</a></td>
</tr>
<tr>
<td class="calendarDayName" style="width:14%">دوشنبه</td>
<td class="calendarDayName" style="width:14%">سه شنبه</td>
<td class="calendarDayName" style="width:14%">چهارشنبه</td>
<td class="calendarDayName" style="width:14%">پنجشنبه</td>
<td class="calendarDayName" style="width:14%">جمعه</td>
<td class="calendarDayName" style="width:14%">شنبه</td>
<td class="calendarDayName" style="width:14%">یکشنبه</td>
</tr>
<?php
$timestamp=$date->mktime(0,0,0,$cMonth,7,$cYear);
$maxday=$date->date("t",$timestamp,false, false);
$thismonth=getdate ($timestamp);
$startday=$thismonth['wday'];
$xcnowdx=$date->date("d",false, false);
$xcnowyx=$date->date("Y",false, false);
$xcnowmx=$date->date("m",false, false);
for ($i=0; $i<($maxday+$startday); $i++) {
if(($i % 7) == 0 ){echo "<tr>\n";}
if($i < $startday){
echo "<td class=\"calendarDateEmpty\">&nbsp;</td>\n";
}else{
echo "<td";
$xccaldayx=$i - $startday + 1;
if($xccaldayx==$xcnowdx AND $cYear==$xcnowyx AND $cMonth==$xcnowmx){
if(xccheckactivity("shamsi",$cYear,$cMonth,$xccaldayx)==1){
echo" class=\"calendarToday\Linked\"";
}else{
echo" class=\"calendarToday\"";
}
}else{
if(xccheckactivity("shamsi",$cYear,$cMonth,$xccaldayx)==1){
echo" class=\"calendarDateLinked\"";
}else{
echo" class=\"calendarDateToday\"";
}
} echo">";
if(xccheckactivity("shamsi",$cYear,$cMonth,$xccaldayx)==1){
echo"<a href=\"modules.php?name=Xcalendar&xccset=shamsi&xcyear=$cYear&xcmonth=$cMonth&xcday=$xccaldayx\">";
echo"". ($i - $startday + 1) . "";
echo"</a>";
}else{
echo"". ($i - $startday + 1) . "";
}
echo"</td>\n";}
if(($i % 7) == 6 ){echo "</tr>\n";}
}
?></table></div>
<?php
}
?>