<?php
$urlin = array(
"'(?<!/)modules.php\?name=Xstatic&amp;xsurl=([a-zA-Z0-9+_./-اآبپتثجچحخدذرزژسشصضطظعغفقكکگلمنوهیي-]*)'",
"'(?<!/)modules.php\?name=Xstatic'",
);

$urlout = array(
"Xstatic/\\1",
"Xstatic/",
);

?>
