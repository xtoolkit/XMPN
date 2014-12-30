<?php
if (stristr(htmlentities($_SERVER['PHP_SELF']), "Xsiteinfo.lib.php")) {
	die ("You can't access this file directly...");
}
require_once("mainfile.php");
function xsitemapinsert($xstag,$xsname,$xsvalue){
global $prefix, $db, $dbname;
$xserror1check = $db->sql_numrows($db->sql_query("SELECT *
FROM `" . $prefix . "_xmsconfig`
WHERE `xstag` = '$xstag'
AND `xsname` = '$xsname'
AND `xsvalue` = '$xsvalue'
LIMIT 0 , 2"));
$xserror2check = $db->sql_numrows($db->sql_query("SELECT *
FROM `" . $prefix . "_xmsconfig`
WHERE `xstag` = '$xstag'
AND `xsname` = '$xsname'
LIMIT 0 , 2"));
if($xserror1check>0 OR $xserror2check>0 OR $xstag==""){

}else{
$db->sql_query("INSERT INTO `$dbname`.`" . $prefix . "_xmsconfig` (
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
FROM `" . $prefix . "_xmsconfig`
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
function xngo($yaroo){
global $prefix, $db, $dbname;
$result = $db->sql_query("SELECT *
FROM `" . $prefix . "_xmsconfig`
WHERE `xsname` = '$yaroo'
LIMIT 0 , 1");
	while ($row = $db->sql_fetchrow($result)) {
	mb_internal_encoding('UTF-8');
	$xsvalue[0] = $row['xsid'];
	$xsvalue[1] = $row['xstag'];
	$xsvalue[2] = $row['xsname'];
	$xsvalue[3] = $row['xsvalue'];
}
if(is_array($xsvalue)){}else{
$xsvalue[4]==1;
}
return $xsvalue;
}
function xngonum($yaroo){
global $prefix, $db, $dbname;
$result = $db->sql_query("SELECT *
FROM `" . $prefix . "_xmsconfig`
WHERE `xsid` = $yaroo
LIMIT 0 , 1");
	while ($row = $db->sql_fetchrow($result)) {
	mb_internal_encoding('UTF-8');
	$xsvalue[0] = $row['xsid'];
	$xsvalue[1] = $row['xstag'];
	$xsvalue[2] = $row['xsname'];
	$xsvalue[3] = $row['xsvalue'];
}
if(is_array($xsvalue)){}else{
$xsvalue[4]==1;
}
return $xsvalue;
}
function xcheckboxcheck($value,$value2){
$xbsds=0;
$value=explode(',', $value);
foreach($value as $key){
if($key==$value2){
	$xbsds=1;
	break;
}
}
return $xbsds;
}
function massaggex($text){
?>		<div id="message-green">
		<table border="0" width="100%" cellpadding="0" cellspacing="0">
		<tr><td class="green-right"><a class="close-green"><img src="admin/template/images/table/icon_close_green.gif"   alt="" /></a></td>
		<td class="green-left"><?php echo $text; ?></a></td>
		</tr>
		</table>
		</div>
<?php
}
function xsxesdi($nuim,$xxxvalue){
global $prefix, $db, $dbname;
$nuim=intval($nuim);
$db->sql_query("UPDATE `$dbname`.`" . $prefix . "_xmsconfig` SET `xsvalue` = '$xxxvalue' WHERE `" . $prefix . "_xmsconfig`.`xsid` =$nuim;");
}
function xmsconfigform($xmsoptions,$xmsconf,$dsfsdf){
global $prefix, $db, $dbname;
if($xmsconf==1){
foreach($dsfsdf as $dkay => $dvalue){
$xcall=xngonum($dkay);
if($xcall[4]==0){
if($xcall[1]=="checkbox"){
$xregsx="";
$xbdcout=count($dvalue)-1;
foreach($dvalue as $ddkay => $ddvalue){
$xregsx.=$ddvalue;
if($xbdcout==0){}else{
$xregsx.=",";
}
$dvalue=$xregsx;
$xbdcout--;
}
}
xsxesdi($dkay,$dvalue);
}
}
massaggex("ویرایش با موفقیت انجام شد.");
}
?>
<form action="" method="post">
<table align="center" border="0" cellpadding="4" cellspacing="4" width="100%" id="id-form">
<?php
foreach($xmsoptions as $value){
if(is_array($value)){
$xcall=xngo($value["set"]);
if($xcall[4]==0){
unset($value["set"]);
if($xcall[1]=="select"){
?><tr><td style="width:250px;"><?php echo $xcall[2]; ?></td><td><select name="xmlsa[<?php echo $xcall[0]; ?>]" class="styledselect-select"><?php
foreach($value as $value2 => $key){
	?><option value="<?php echo $value2; ?>" <?php if($xcall[3]==$value2){ ?>selected<?php } ?>><?php echo $key; ?></option><?php
}
?></select></td></tr>
<?php
}elseif($xcall[1]=="radius"){
?><tr><td style="width:250px;"><?php echo $xcall[2]; ?></td><td><?php
foreach($value as $value2 => $key){
	echo $key; ?> <input name="xmlsa[<?php echo $xcall[0]; ?>]" type="radio" class="styled" value="<?php echo $value2; ?>" <?php if($xcall[3]==$value2){ ?>checked<?php } ?>> &nbsp;&nbsp; <?php
}
?></td></tr>
<?php
}elseif($xcall[1]=="checkbox"){
?><tr><td style="width:250px;"><?php echo $xcall[2]; ?></td><td><?php
foreach($value as $value2 => $key){
	echo $key; ?> <input name="xmlsa[<?php echo $xcall[0]; ?>][]" type="checkbox" class="styled" value="<?php echo $value2; ?>" <?php if(xcheckboxcheck($xcall[3],$value2)==1){ ?>checked<?php } ?>> &nbsp;&nbsp; <?php
}
?></td></tr>
<?php
}
}
}else{
$xcall=xngo($value);
if($xcall[4]==0){
if($xcall[1]=="text"){
?><tr><td style="width:250px;"><?php echo $xcall[2]; ?></td><td><input type="<?php echo $xcall[1]; ?>" name="xmlsa[<?php echo $xcall[0]; ?>]" class="inp-form-ltr" value="<?php echo $xcall[3]; ?>"/></td></tr>
<?php
}elseif($xcall[1]=="textarea"){
$asdfad="xmlsa[".$xcall[0]."]";
?><tr><td style="width:250px;"><?php echo $xcall[2]; ?></td><td><?php wysiwyg_textarea($asdfad,$xcall[3], 'Comments', 50, 15); ?></td></tr>
<?php
}
}
}
}
?><input type="hidden" name="xmsconf" value="1">
<tr><td><input class="form-submit" type='submit' value='ذخیره'>
</td></tr>
</table>
</form>
<?php
}
?>