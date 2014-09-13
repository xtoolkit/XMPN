<?php
if (stristr(htmlentities($_SERVER['PHP_SELF']), "Xcalg.php")) {
	die ("You can't access this file directly...");
}
function xcalmf($xcyear,$xcmonth,$mod1,$mod2){
$xreturn="";
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
$xreturn .="<div id=\"k2ModuleBox194\" class=\"k2CalendarBlock\">
<table class=\"calendar\">
<tr>
<td class=\"calendarNavMonthPrev\">";
if($mod2==1){
$xreturn .="<a class=\"calendarNavLink\" href=\"modules.php?name=Xcalendar&xccset=miladi&xcyear=";
$xreturn .="$prev_year";
$xreturn .="&xcmonth=";
$xreturn .="$prev_month";
$xreturn .="\">&laquo;</a>";
}
$xreturn .="</td><td class=\"calendarCurrentMonth\" colspan=\"5\">";
if($mod2==0){
$xreturn .="<a class=\"calendarNavLink\" href=\"modules.php?name=Xcalendar&xccset=miladi&xcyear=";
$xreturn .="$cYear";
$xreturn .="&xcmonth=";
$xreturn .="$cMonth";
$xreturn .="\">";
$xreturn .=$monthNames[$cMonth-1];
$xreturn .="</a>";
}else{
$xreturn .=$monthNames[$cMonth-1].' '.$cYear;
}
$xreturn .="</td>
<td class=\"calendarNavMonthNext\">";
if($mod2==1){
$xreturn .="<a class=\"calendarNavLink\" href=\"modules.php?name=Xcalendar&xccset=miladi&xcyear=";
$xreturn .="$next_year";
$xreturn .="&xcmonth=";
$xreturn .="$next_month";
$xreturn .="\">&raquo;</a>";
}
$xreturn .="</td></tr>
<tr>";
if($mod1==1){
$xreturn .="<td class=\"calendarDayName\" style=\"width:14%\">Sunday</td>
<td class=\"calendarDayName\" style=\"width:14%\">Monday</td>
<td class=\"calendarDayName\" style=\"width:14%\">Tuesday</td>
<td class=\"calendarDayName\" style=\"width:14%\">Wednesday</td>
<td class=\"calendarDayName\" style=\"width:14%\">Thursday</td>
<td class=\"calendarDayName\" style=\"width:14%\">Friday</td>
<td class=\"calendarDayName\" style=\"width:14%\">Saturday</td>";
}elseif($mod1==2){
$xreturn .="<td class=\"calendarDayName\" style=\"width:14%\">Su</td>
<td class=\"calendarDayName\" style=\"width:14%\">Mo</td>
<td class=\"calendarDayName\" style=\"width:14%\">Tu</td>
<td class=\"calendarDayName\" style=\"width:14%\">W</td>
<td class=\"calendarDayName\" style=\"width:14%\">Th</td>
<td class=\"calendarDayName\" style=\"width:14%\">Fr</td>
<td class=\"calendarDayName\" style=\"width:14%\">Sa</td>";
}
$xreturn .="</tr>";
$timestamp=mktime(0,0,0,$cMonth,1,$cYear);
$maxday=date("t",$timestamp);
$thismonth=getdate ($timestamp);
$startday=$thismonth['wday'];
$xcnow=time();
$xcnowdx=date("d", $xcnow);
$xcnowyx=date("Y", $xcnow);
$xcnowmx=date("m", $xcnow);
for ($i=0; $i<($maxday+$startday); $i++) {
if(($i % 7) == 0 ){$xreturn .="<tr>\n";}
if($i < $startday){
$xreturn .="<td class=\"calendarDateEmpty\">&nbsp;</td>\n";
}else{
$xreturn .="<td";
$xccaldayx=$i - $startday + 1;
if($xccaldayx==$xcnowdx AND $cYear==$xcnowyx AND $cMonth==$xcnowmx){
if(xccheckactivity("miladi",$cYear,$cMonth,$xccaldayx)==1){
$xreturn .=" class=\"calendarToday\Linked\"";
}else{
$xreturn .=" class=\"calendarToday\"";
}
}else{
if(xccheckactivity("miladi",$cYear,$cMonth,$xccaldayx)==1){
$xreturn .=" class=\"calendarDateLinked\"";
}else{
$xreturn .=" class=\"calendarDateToday\"";
}
} $xreturn .=">";
if(xccheckactivity("miladi",$cYear,$cMonth,$xccaldayx)==1){
$xreturn .="<a href=\"modules.php?name=Xcalendar&xccset=miladi&xcyear=$cYear&xcmonth=$cMonth&xcday=$xccaldayx\">";
$xreturn .="". ($i - $startday + 1) . "";
$xreturn .="</a>";
}else{
$xreturn .="". ($i - $startday + 1) . "";
}
$xreturn .="</td>\n";}
if(($i % 7) == 6 ){$xreturn .="</tr>\n";}
}
$xreturn .="</table></div>";
return $xreturn;
}
?>