<?php
function xa_theme($id,$mod){
global $prefix, $db, $dbname;
$numrow = $db->sql_numrows($db->sql_query("SELECT *
FROM `" . $prefix . "_xaparat`
WHERE `xamid` =$id
AND `xamod` LIKE '$mod'
LIMIT 0 , 30"));
if($numrow>0){
?><link rel="stylesheet" href="modules/XMoreOption/theme/Xaparat/Flat/css/style.css" type="text/css" /><?php
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
<?php if($xatitle!==""){ ?><div class="xaoption"><div class="xatitle"><?php echo $xatitle; ?></div></div><?php } ?>
<embed flashvars="config=http://www.aparat.com/video/video/config/videohash/<?php echo $xatag; ?>" allowfullscreen="true" quality="high" name="aparattv" id="aparattv" style="" src="http://www.aparat.com/public/public/player/aparattv" type="application/x-shockwave-flash">
<?php if(xasetv(3)!==""){ ?><div class="xaoption"><div class="xacanel"><a href="http://www.aparat.com/<?php echo xasetv(3); ?>">کانال ما</a></div></div><?php } ?>
</div><?php
}
}
?>