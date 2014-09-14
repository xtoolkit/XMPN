<?php
require_once("mainfile.php");
function xsitemapinsert($xstag,$xsname,$xsvalue){
global $prefix, $db, $dbname;
$xserror1check = $db->sql_numrows($db->sql_query("SELECT *
FROM `" . $prefix . "_xsiteinfo`
WHERE `xstag` = '$xstag'
AND `xsname` = '$xsname'
AND `xsvalue` = '$xsvalue'
LIMIT 0 , 2"));
$xserror2check = $db->sql_numrows($db->sql_query("SELECT *
FROM `" . $prefix . "_xsiteinfo`
WHERE `xstag` = '$xstag'
AND `xsname` = '$xsname'
LIMIT 0 , 2"));
if($xserror1check>0 OR $xserror2check>0 OR $xstag==""){

}else{
$db->sql_query("INSERT INTO `$dbname`.`" . $prefix . "_xsiteinfo` (
`xsid` ,
`xstag` ,
`xsname` ,
`xsvalue`
)
VALUES (
NULL , '$xstag', '$xsname', '$xsvalue'
);");
}
}
function xsitemapitemcall($xstag,$xsname){
global $prefix, $db, $dbname;
$nuim=intval($nuim);
$result = $db->sql_query("SELECT *
FROM `" . $prefix . "_xsiteinfo`
WHERE `xstag` = '$xstag'
AND `xsname` = '$xsname'
LIMIT 0 , 1");
	while ($row = $db->sql_fetchrow($result)) {
	mb_internal_encoding('UTF-8');
	$xsvalue[0] = $row['xsid'];
	$xsvalue[1] = $row['xstag'];
	$xsvalue[2] = $row['xsname'];
	$xsvalue[3] = $row['xsvalue'];
}
return $xsvalue;
}
?>