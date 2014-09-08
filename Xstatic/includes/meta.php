<?php

/************************************************************************/
/* PHP-NUKE: Web Portal System                                          */
/* ===========================                                          */
/*                                                                      */
/* Copyright (c) 2002 by Francisco Burzi                                */
/* http://phpnuke.org                                                   */
/*                                                                      */
/* This program is free software. You can redistribute it and/or modify */
/* it under the terms of the GNU General Public License as published by */
/* the Free Software Foundation; either version 2 of the License.       */
/************************************************************************/

if (stristr(htmlentities($_SERVER['PHP_SELF']), "meta.php")) {
	Header("Location: index.php");
	die();
}

##################################################
# Include for meta Tags generation               #
##################################################
global $db, $prefix , $sid , $nukeurl , $xstags;
$result1 = $db->sql_query("SELECT sid , notes FROM ".$prefix."_stories where sid = '$sid'");
while ($row = $db->sql_fetchrow($result)) {
	$s_sid = intval($row['sid']);
	$notes = stripslashes($row['notes']);
}
if ($notes != "") {
	$notes = str_replace(":", ",", $notes);
	$tags = stripslashes($notes);
}else{
	$result = $db->sql_query("SELECT tags FROM " . $prefix . "_meta");
	$row = $db->sql_fetchrow($result);
	$tags = $row['tags'];
	$tags = stripslashes($tags);
}
$result3 = $db->sql_query("SELECT gverify , alexverify, yverify FROM " . $prefix . "_seo");
while ($row3 = $db->sql_fetchrow($result3)) {
	$gverify = stripslashes($row3['gverify']);
	$alexverify = stripslashes($row3['alexverify']);
	$yverify = stripslashes($row3['yverify']);
}
if($name=="Xstatic"){
if($xstags==""){}else{$tags=$xstags;}
}
echo "<meta http-equiv=\"content-Type\" content=\"text/html; charset="._CHARSET."\">\n";
echo "<meta http-equiv=\"EXPIRES\" content=\"0\">\n";
echo "<meta name=\"RESOURCE-TYPE\" content=\"DOCUMENT\">\n";
echo "<meta name=\"DISTRIBUTION\" content=\"GLOBAL\">\n";
echo "<meta name=\"AUTHOR\" content=\"$sitename\">\n";
echo "<meta name=\"COPYRIGHT\" content=\"Copyright (c) by $sitename\">\n";
echo "<meta name=\"KEYWORDS\" content=\"$tags\">\n";
echo "<meta name=\"DESCRIPTION\" content=\"$slogan\">\n";
echo "<meta name=\"ROBOTS\" content=\"INDEX, FOLLOW\">\n";
echo "<meta name=\"REVISIT-AFTER\" content=\"1 DAYS\">\n";
echo "<meta name=\"RATING\" content=\"GENERAL\">\n";
echo "<meta name=\"google-site-verification\" content=\"$gverify\" />\n";
echo "<meta name=\"alexaVerifyID\" content=\"$alexverify\" />\n";
echo "<META name=\"y_key\" content=\"$yverify\">\n";
echo "<base href=\"$nukeurl\">\n";

###############################################
# DO NOT REMOVE THE FOLLOWING COPYRIGHT LINE! #
# YOU'RE NOT ALLOWED TO REMOVE NOR EDIT THIS. #
###############################################

// IF YOU REALLY NEED TO REMOVE IT AND HAVE MY WRITTEN AUTHORIZATION CHECK: http://phpnuke.org/modules.php?name=Commercial_License
// PLAY FAIR AND SUPPORT THE DEVELOPMENT, PLEASE!

//echo "<meta name=\"GENERATOR\" content=\"PHP-Nuke - Copyright by http://phpnuke.org\">\n";

?>