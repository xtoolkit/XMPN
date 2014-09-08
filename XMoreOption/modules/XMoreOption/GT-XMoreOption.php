<?php
$urlin = array(
"'(?<!/)modules.php\?name=XMoreOption&amp;xset=XlinksBox&amp;com=xlbdl&amp;xlbid=([0-9]*)'",
"'(?<!/)modules.php\?name=XMoreOption&amp;xset=XlinksBox&amp;com=xlbmdl&amp;xlbid=([0-9]*)'",
"'(?<!/)modules.php\?name=XMoreOption&amp;xset=XlinksBox&amp;com=xlbsc&amp;xlbid=([0-9]*)'",
"'(?<!/)modules.php\?name=XMoreOption&amp;xset=XlinksBox'",
);
$urlout = array(
"XMoreOption/XlinksBox/Download/\\1/",
"XMoreOption/XlinksBox/Download/Mirror/\\1/",
"XMoreOption/XlinksBox/ScreenShot/\\1/",
"XMoreOption/XlinksBox/",
);
?>
