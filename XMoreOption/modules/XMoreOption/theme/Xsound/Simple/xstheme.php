<?php
function xs_theme($id,$mod){
global $prefix, $db, $dbname;
$numrow = $db->sql_numrows($db->sql_query("SELECT *
FROM `" . $prefix . "_xsound`
WHERE `xsmid` =$id
AND `xsmod` LIKE '$mod'
LIMIT 0 , 30"));
if($numrow>0){
?><link rel="stylesheet" href="modules/XMoreOption/theme/Xsound/Simple/css/style.css" type="text/css" /><?php
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
<div class="xsoption"><div class="xsbti">پخش آنلاین</div><?php if($xstitle!==""){ ?><a class="xstitle" href="<?php echo $xstag; ?>"><?php echo $xstitle; ?></a><?php } ?>
<object type="application/x-shockwave-flash" data="modules/XMoreOption/theme/Xsound/Simple/dewplayer.swf?mp3=<?php echo $xstag; ?>" id="dewplayer"><param name="wmode" value="transparent" /><param name="movie" value="modules/XMoreOption/theme/Xsound/Simple/dewplayer.swf?mp3=<?php echo $xstag; ?>" /></object>
</div></div><?php
}
}

}
?>