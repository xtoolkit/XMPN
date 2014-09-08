<?php
function xa_theme($id,$mod){
global $prefix, $db, $dbname;
$numrow = $db->sql_numrows($db->sql_query("SELECT *
FROM `" . $prefix . "_xaparat`
WHERE `xamid` =$id
AND `xamod` LIKE '$mod'
LIMIT 0 , 30"));
if($numrow>0){
?><link rel="stylesheet" href="modules/XMoreOption/theme/Xaparat/Simple/css/style.css" type="text/css" /><?php
}
$result = $db->sql_query("SELECT *
FROM `" . $prefix . "_xaparat`
WHERE `xamid` =$id
AND `xamod` LIKE '$mod'
LIMIT 0 , 30");
	while ($row = $db->sql_fetchrow($result)) {
	mb_internal_encoding('UTF-8');
	$xaid = intval($row['xaid']);
	$xatag = $row['xatag'];
	$xatitle = $row['xatitle'];
?><div class="xatheme">
<iframe src="http://www.aparat.com/video/video/embed/videohash/<?php echo $xatag; ?>/vt/frame" allowFullScreen="true" webkitallowfullscreen="true" mozallowfullscreen="true"></iframe>
<?php if($xatitle!=="" OR xasetv(3)!=="") { ?><div class="xaoption">
<?php if($xatitle!==""){ ?><div class="xatitle"><?php echo $xatitle; ?></div><?php } ?>
<?php if(xasetv(3)!==""){ ?><div class="xacanel"><a href="http://www.aparat.com/<?php echo xasetv(3); ?>">کانال ما</a></div><?php } ?>
</div><?php } ?>
</div><?php
}
}
?>