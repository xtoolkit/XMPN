<?php
if (stristr(htmlentities($_SERVER['PHP_SELF']), "Xcals.php")) {
	die ("You can't access this file directly...");
}
function xcalsf($xcyear,$xcmonth,$mod1,$mod2){
require_once("includes/jdatetime.class.php");
$xreturn="";
$date=new jDateTime(true, true, 'Asia/Tehran');
$monthNames=Array("فروردین", "اردیبهست", "خرداد", "تیر", "مرداد", "شهریور", "مهر", "آبان", "آذر", "دی", "بهمن", "اسفند");
if($xcmonth==""){$xcmonth=$date->date("n",false, false);}
if($xcyear==""){$xcyear=$date->date("Y",false, false);}
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
$xreturn .="<a class=\"calendarNavLink\" href=\"modules.php?name=Xcalendar&xccset=shamsi&xcyear=";
$xreturn .="$prev_year";
$xreturn .="&xcmonth=";
$xreturn .="$prev_month";
$xreturn .="\">&laquo;</a>";
}
$xreturn .="</td><td class=\"calendarCurrentMonth\" colspan=\"5\">";
if($mod2==0){
$xreturn .="<a class=\"calendarNavLink\" href=\"modules.php?name=Xcalendar&xccset=shamsi&xcyear=";
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
$xreturn .="<a class=\"calendarNavLink\" href=\"modules.php?name=Xcalendar&xccset=shamsi&xcyear=";
$xreturn .="$next_year";
$xreturn .="&xcmonth=";
$xreturn .="$next_month";
$xreturn .="\">&raquo;</a>";
}
$xreturn .="</td></tr>
<tr>";
if($mod1==1){
$xreturn .="<td class=\"calendarDayName\" style=\"width:14%\">دوشنبه</td>
<td class=\"calendarDayName\" style=\"width:14%\">سه شنبه</td>
<td class=\"calendarDayName\" style=\"width:14%\">چهارشنبه</td>
<td class=\"calendarDayName\" style=\"width:14%\">پنجشنبه</td>
<td class=\"calendarDayName\" style=\"width:14%\">جمعه</td>
<td class=\"calendarDayName\" style=\"width:14%\">شنبه</td>
<td class=\"calendarDayName\" style=\"width:14%\">یکشنبه</td>";
}elseif($mod1==2){
$xreturn .="<td class=\"calendarDayName\" style=\"width:14%\">د</td>
<td class=\"calendarDayName\" style=\"width:14%\">س</td>
<td class=\"calendarDayName\" style=\"width:14%\">چ</td>
<td class=\"calendarDayName\" style=\"width:14%\">پ</td>
<td class=\"calendarDayName\" style=\"width:14%\">ج</td>
<td class=\"calendarDayName\" style=\"width:14%\">ش</td>
<td class=\"calendarDayName\" style=\"width:14%\">ی</td>";
}
$xreturn .="</tr>";
$timestamp=$date->mktime(0,0,0,$cMonth,7,$cYear);
$maxday=$date->date("t",$timestamp,false, false);
$thismonth=getdate ($timestamp);
$startday=$thismonth['wday'];
$xcnowdx=$date->date("d",false, false);
$xcnowyx=$date->date("Y",false, false);
$xcnowmx=$date->date("m",false, false);
for ($i=0; $i<($maxday+$startday); $i++) {
if(($i % 7) == 0 ){$xreturn .="<tr>\n";}
if($i < $startday){
$xreturn .="<td class=\"calendarDateEmpty\">&nbsp;</td>\n";
}else{
$xreturn .="<td";
$xccaldayx=$i - $startday + 1;
if($xccaldayx==$xcnowdx AND $cYear==$xcnowyx AND $cMonth==$xcnowmx){
if(xccheckactivity("shamsi",$cYear,$cMonth,$xccaldayx)==1){
$xreturn .=" class=\"calendarToday\Linked\"";
}else{
$xreturn .=" class=\"calendarToday\"";
}
}else{
if(xccheckactivity("shamsi",$cYear,$cMonth,$xccaldayx)==1){
$xreturn .=" class=\"calendarDateLinked\"";
}else{
$xreturn .=" class=\"calendarDateToday\"";
}
} $xreturn .=">";
if(xccheckactivity("shamsi",$cYear,$cMonth,$xccaldayx)==1){
$xreturn .="<a href=\"modules.php?name=Xcalendar&xccset=shamsi&xcyear=$cYear&xcmonth=$cMonth&xcday=$xccaldayx\">";
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