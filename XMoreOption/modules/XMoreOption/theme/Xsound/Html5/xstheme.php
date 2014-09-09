<?php
function xs_theme($id,$mod){
global $prefix, $db, $dbname;
$numrow = $db->sql_numrows($db->sql_query("SELECT *
FROM `" . $prefix . "_xsound`
WHERE `xsmid` =$id
AND `xsmod` LIKE '$mod'
LIMIT 0 , 30"));
if($numrow>0){
?><link rel="stylesheet" href="modules/XMoreOption/theme/Xsound/Html5/css/style.css" type="text/css" /><?php
$result = $db->sql_query("SELECT *
FROM `" . $prefix . "_xsound`
WHERE `xsmid` =$id
AND `xsmod` LIKE '$mod'
LIMIT 0 , 30");
	while ($row = $db->sql_fetchrow($result)) {
	mb_internal_encoding('UTF-8');
	$xsid = intval($row['xsid']);
	$xstag = $row['xstag'];
	$xstitle = $row['xstitle'];
?><div class="xstheme">
<div class="xsoption"><?php if($xstitle!==""){ ?><div class="xstitle"><a href="<?php echo $xstag; ?>"><?php echo $xstitle; ?></a></div><?php } ?>
 <audio controls>
  <source src="<?php echo $xstag; ?>" type="audio/mpeg">
</audio>
</div></div><?php
}
}

}
?>