<?php
$urlin = array(
"'(?<!/)modules.php\?name=Xcalendar&amp;xccset=shamsi&amp;xcyear=([0-9]*)&amp;xcmonth=([0-9]*)&amp;xcday=([0-9]*)'",
"'(?<!/)modules.php\?name=Xcalendar&amp;xccset=shamsi&amp;xcyear=([0-9]*)&amp;xcmonth=([0-9]*)'",
"'(?<!/)modules.php\?name=Xcalendar&amp;xccset=shamsi&amp;xcyear=([0-9]*)'",
"'(?<!/)modules.php\?name=Xcalendar&amp;xccset=shamsi'",
"'(?<!/)modules.php\?name=Xcalendar&amp;xccset=miladi&amp;xcyear=([0-9]*)&amp;xcmonth=([0-9]*)&amp;xcday=([0-9]*)'",
"'(?<!/)modules.php\?name=Xcalendar&amp;xccset=miladi&amp;xcyear=([0-9]*)&amp;xcmonth=([0-9]*)'",
"'(?<!/)modules.php\?name=Xcalendar&amp;xccset=miladi&amp;xcyear=([0-9]*)'",
"'(?<!/)modules.php\?name=Xcalendar&amp;xccset=miladi'",
"'(?<!/)modules.php\?name=Xcalendar&amp;&amp;xcyear=([0-9]*)&amp;xcmonth=([0-9]*)&amp;xcday=([0-9]*)'",
"'(?<!/)modules.php\?name=Xcalendar&amp;&amp;xcyear=([0-9]*)&amp;xcmonth=([0-9]*)'",
"'(?<!/)modules.php\?name=Xcalendar&amp;&amp;xcyear=([0-9]*)'",
"'(?<!/)modules.php\?name=Xcalendar'",
);

$urlout = array(
"Xcalendar/shamsi/\\1/\\2/\\3/",
"Xcalendar/shamsi/\\1/\\2/",
"Xcalendar/shamsi/\\1/",
"Xcalendar/shamsi/",
"Xcalendar/miladi/\\1/\\2/\\3/",
"Xcalendar/miladi/\\1/\\2/",
"Xcalendar/miladi/\\1/",
"Xcalendar/miladi/",
"Xcalendar/\\1/\\2/\\3/",
"Xcalendar/\\1/\\2/",
"Xcalendar/\\1/",
"Xcalendar/",
);

?>
