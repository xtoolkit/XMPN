<?php
function xp_theme($id,$mod){
global $prefix, $db, $dbname;
$numrow = $db->sql_numrows($db->sql_query("SELECT *
FROM `" . $prefix . "_xpshpt`
WHERE `xpmid` =$id
AND `xpmod` LIKE '$mod'
LIMIT 0 , 30"));
if($numrow>0){
?><link rel="stylesheet" href="modules/XMoreOption/theme/Xpshpt/Simple/css/style.css" type="text/css" /><div class="xptheme"><div class="xptitle">اسکرین شات</div><div class="xpitems"><?php
$result = $db->sql_query("SELECT *
FROM `" . $prefix . "_xpshpt`
WHERE `xpmid` =$id
AND `xpmod` LIKE '$mod'
LIMIT 0 , 30");
	while ($row = $db->sql_fetchrow($result)) {
	mb_internal_encoding('UTF-8');
	$xpid = intval($row['xpid']);
	$xptag = $row['xptag'];
	$xptitle = $row['xptitle'];
?><a href="<?php echo $xptag; ?>" rel="lightbox"><img src="timthumb.php?src=<?php echo $xptag; ?>&q=100&w=100&h=75" alt="<?php echo $xptitle; ?>"></a><?php
}
?></div></div><?php
}

}
?>