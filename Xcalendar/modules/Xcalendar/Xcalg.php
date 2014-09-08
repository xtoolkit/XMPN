<?php
if (stristr(htmlentities($_SERVER['PHP_SELF']), "Xcalg.php")) {
	die ("You can't access this file directly...");
}
function xcalgf($xcyear,$xcmonth){
$monthNames=Array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
if($xcmonth==""){$xcmonth=date("n");}
if($xcyear==""){$xcyear=date("Y");}
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
<td class="calendarNavMonthPrev"><a class="calendarNavLink" href="modules.php?name=Xcalendar&xccset=miladi&xcyear=<?php echo $prev_year; ?>&xcmonth=<?php echo $prev_month; ?>">&laquo;</a></td>
<td class="calendarCurrentMonth" colspan="5"><?php echo $monthNames[$cMonth-1].' '.$cYear; ?></td>
<td class="calendarNavMonthNext"><a class="calendarNavLink" href="modules.php?name=Xcalendar&xccset=miladi&xcyear=<?php echo $next_year; ?>&xcmonth=<?php echo $next_month; ?>">&raquo;</a></td>
</tr>
<tr>
<td class="calendarDayName" style="width:14%">Sunday</td>
<td class="calendarDayName" style="width:14%">Monday</td>
<td class="calendarDayName" style="width:14%">Tuesday</td>
<td class="calendarDayName" style="width:14%">Wednesday</td>
<td class="calendarDayName" style="width:14%">Thursday</td>
<td class="calendarDayName" style="width:14%">Friday</td>
<td class="calendarDayName" style="width:14%">Saturday</td>
</tr>
<?php
$timestamp=mktime(0,0,0,$cMonth,1,$cYear);
$maxday=date("t",$timestamp);
$thismonth=getdate ($timestamp);
$startday=$thismonth['wday'];
$xcnow=time();
$xcnowdx=date("d", $xcnow);
$xcnowyx=date("Y", $xcnow);
$xcnowmx=date("m", $xcnow);
for ($i=0; $i<($maxday+$startday); $i++) {
if(($i % 7) == 0 ){echo "<tr>\n";}
if($i < $startday){
echo "<td class=\"calendarDateEmpty\">&nbsp;</td>\n";
}else{
echo "<td";
$xccaldayx=$i - $startday + 1;
if($xccaldayx==$xcnowdx AND $cYear==$xcnowyx AND $cMonth==$xcnowmx){
if(xccheckactivity("miladi",$cYear,$cMonth,$xccaldayx)==1){
echo" class=\"calendarToday\Linked\"";
}else{
echo" class=\"calendarToday\"";
}
}else{
if(xccheckactivity("miladi",$cYear,$cMonth,$xccaldayx)==1){
echo" class=\"calendarDateLinked\"";
}else{
echo" class=\"calendarDateToday\"";
}
} echo">";
if(xccheckactivity("miladi",$cYear,$cMonth,$xccaldayx)==1){
echo"<a href=\"modules.php?name=Xcalendar&xccset=miladi&xcyear=$cYear&xcmonth=$cMonth&xcday=$xccaldayx\">";
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