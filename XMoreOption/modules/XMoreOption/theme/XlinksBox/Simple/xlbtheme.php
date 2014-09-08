<?php
function xlb_theme($id,$mod){
global $prefix, $db, $dbname;
if($mod=='News'){
$numrow = $db->sql_numrows($db->sql_query("SELECT * FROM `" . $prefix . "_xlinksbox` WHERE `xlbmid` = '$id' LIMIT 0 , 30"));
}
if($numrow>0){
?><link rel="stylesheet" href="modules/XMoreOption/theme/XlinksBox/Simple/css/style.css" type="text/css" />
<div class="downbox">
<div class="xlbin">
<?php
$result = $db->sql_query("SELECT *
FROM `" . $prefix . "_xlinksbox`
WHERE `xlbmid` =$id
AND `xlbmod` LIKE '$mod'
ORDER BY `" . $prefix . "_xlinksbox`.`xlbid` ASC
LIMIT 0 , 30");
$setguild=1;
	while ($row = $db->sql_fetchrow($result)) {
	mb_internal_encoding('UTF-8');
$xlbid= $row['xlbid'];
$xlbti= $row['xlbti'];
$xlbdl= $row['xlbdl'];
$xlbmrdl= $row['xlbmrdl'];
$xlbmb= $row['xlbmb'];
$xlbmd= $row['xlbmd'];
if($setguild==1){
$xlbidd= $row['xlbid'];
$xlbdolar= $row['xlbdolar'];
$xlbgemu= $row['xlbgemu'];
$xlbscsh= $row['xlbscsh'];
$xlbup= $row['xlbup'];
$xlbref= $row['xlbref'];
$xlbpw= $row['xlbpw'];
}
?><div class="xlbdlabj">
<div class="xlbdltit"><a><?php echo $xlbti; ?></a><?php if($xlbmb==""){}else{ ?> (<span class="xlbdlmb"><?php echo $xlbmb; ?></span>)<?php } ?></div>
<?php if($xlbdl==""){}else{ ?><a class="xlbdlbut" href="modules.php?name=XMoreOption&xset=XlinksBox&com=xlbdl&xlbid=<?php echo $xlbid; ?>"<?php if($xlbmd==""){}else{ ?> title="md5 : <?php echo $xlbmd; ?>"<?php } ?>>دانلود</a><?php } ?>
<?php if($xlbmrdl==""){}else{ ?><a class="xlbdlbut" href="modules.php?name=XMoreOption&xset=XlinksBox&com=xlbmdl&xlbid=<?php echo $xlbid; ?>"<?php if($xlbmd==""){}else{ ?> title="md5 : <?php echo $xlbmd; ?>"<?php } ?>>کمکی</a><?php } ?>
</div>
<?php $setguild=$setguild+1;} ?>
<div class="xlbinfo">
<?php if($xlbdolar==""){}else{ ?><div class="xlbdolar xlbingh"><span>قیمت</span> : <?php echo $xlbdolar; ?></div><?php } ?>
<?php if($xlbgemu==""){}else{ ?><div class="xlbgenu xlbingh"><span>مجوز</span> : <?php echo $xlbgemu; ?></div><?php } ?>
<?php if($xlbscsh==""){}else{ ?><a class="xlbsc xlbingh" href="modules.php?name=XMoreOption&xset=XlinksBox&com=xlbsc&xlbid=<?php echo $xlbidd; ?>" title="اسکرین شات">اسکرین شات</a><?php } ?>
<?php if($xlbup==""){}else{ ?><div class="xlbup xlbingh"><span>آخرین بروز رسانی</span> : <?php echo $xlbup; ?></div><?php } ?>
<?php if($xlbref==""){}else{ ?><a class="xlbref xlbingh" href="<?php echo $xlbref; ?>">منبع</a><?php } ?>
<?php if($xlbpw==""){}else{ ?><div class="xlbpass xlbingh"><span>رمز فایل</span> : <?php echo $xlbpw; ?></div><?php } ?>
<div class="xlbrepbug xlbingh"><a href="modules.php?name=reports&sid=<?php echo $id; ?>&rcode=1" class="thickbox">گزارش خرابی</a></div>
</div>
</div>
</div>
<?php
}
}
?>