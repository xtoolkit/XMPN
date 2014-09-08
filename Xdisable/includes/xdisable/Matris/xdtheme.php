<?php
function xdisable_theme(){
global $sitename,$xdemailset;
$name = $_SERVER['SCRIPT_NAME'];
$server = $_SERVER['HTTP_USER_AGENT'];
$datetime = date('m/d/Y');
$uip = $_SERVER["REMOTE_ADDR"];
$xdstitle=xdvs(3);
?><!doctype html>
<html>
<head>
<title><?php echo $sitename; ?></title>
<?php @include("includes/meta.php"); ?>
<style type="text/css">
html,body,p{margin:0;padding:0;}
body{direction:ltr;background-color:black;color:#0abb01;font-family: courier new,courier,monospace;}
a{color:#0abb01;outline:none;text-decoration:none;}
p{text-indent:5px;text-align:left;}
.ended{color:#013fbb;}
span{background:#fff;padding:5px;}
</style>
<script type="text/javascript" src="includes/xdisable/Matris/tools.js"></script>
</head>
<body>
<?php echo"<p id=\"TickerLink\"></p><script type=\"text/javascript\">
var theCharacterTimeout = 10;
var theStoryTimeout = 999999999999999;
var theWidgetOne = \"\";
var theWidgetTwo = \"\";
var theWidgetNone = \"\";
var theLeadString = \"\";
var theSummaries = new Array();
var theSiteLinks = new Array();
var theItemCount = 1;
theSummaries[0] = \"<p>Start JavaScript CMD In $datetime;</p><p>Your IP is $uip;</p><p>Check Your Browser;</p><p>Set Coockie Enable;</p><p>Use CMD Memury Enable;</p><p>Use SSL 3.0 Enable;</p><p>Use TSL 1.0 Enable;</p><p>$server</p><p>Check Your Browser is Successfully!;</p><p><br>_______________________________________________________________________________________<br><br></p><p class='ended'>Admin Message : <span>$xdstitle</span></p><p><br>_______________________________________________________________________________________<br><br></p><p>End CMD;</p><p>End;</p>\";
startTicker();
</script>";
?>
</body>
</html>
<?php
die();
}
?>