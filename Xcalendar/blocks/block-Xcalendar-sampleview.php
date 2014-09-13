<?php
if ( !defined('BLOCK_FILE') ) {
    Header("Location: ../index.php");
    die();
}
require_once("Xcalendar.lib.php");
$content=xcstylecss(20);
$content .=$fxcalsf('','',2,1);
?>