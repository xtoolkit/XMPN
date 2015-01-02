<?php
function xtmodule($query){
	global $db, $prefix, $currentlang;
	?><div class="xnotify">گالری</div>
<ul class="galcat"><?php
       $rowpath = $db->sql_fetchrow($db->sql_query("SELECT picpath , picpathtum , picperpage, picheight, picwidth FROM ".$prefix."_galconfig"));
        $picpath = addslashes($rowpath['picpath']);
        $picpathtum = addslashes($rowpath['picpathtum']);
        $picperpage = intval($rowpath['picperpage']);
		$picwidth = intval($rowpath['picwidth']);
		$picheight = intval($rowpath['picheight']);
		$picwidth = intval($rowpath['picwidth']);
        $limitnum = $picperpage;
        $result2 = $db->sql_query("SELECT id_cat, categories , catpic FROM ".$prefix."_mtgalcat ORDER BY id_cat ASC LIMIT 0,$limitnum");
        $i=1;
        while ($row2 = $db->sql_fetchrow($result2)) {
		$id_cat = intval($row2['id_cat']);
		$categories = filter($row2['categories'], "nohtml");
		$catpic = filter($row2['catpic'], "catpic");

echo "	<li><a title=\"$categories\" href=\"modules.php?name=MT-Gallery&amp;pa=ShowGAL&amp;gal=yes&amp;id_cat=$id_cat\"><img src =\"$picpath/$catpic\" alt=\"\"/></a></li>
";
		}
?></ul><?php
}
function xShowGAL($id_cat, $categories) {
	global $bgcolor2, $sitename, $prefix, $db, $datetype;
        $check = $db->sql_query("SELECT id_cat FROM ".$prefix."_mtgalpic WHERE id_cat='$id_cat'");
        $rowcheck = $db->sql_fetchrow($check);
        $idcheck = intval($rowcheck['id_cat']);
	if ($id_cat AND $idcheck == $id_cat) {
		$rowpath = $db->sql_fetchrow($db->sql_query("SELECT * FROM ".$prefix."_galconfig"));
        $picpath = addslashes($rowpath['picpath']);
		$picwidth = intval($rowpath['picwidth']);
        $picpathtum = addslashes($rowpath['picpathtum']);
        $picperpage = intval($rowpath['picperpage']);
        $categories = filter($categories, "nohtml");
		$shuffle_photos = intval($rowpath['shuffle_photos']);
		$time_interval = $rowpath['time_interval'];
		$disable_panning = intval($rowpath['disable_panning']);
		$disable_fading = intval($rowpath['disable_fading']);
		$enable_autoplay = intval($rowpath['enable_autoplay']);
		$enable_loop = intval($rowpath['enable_loop']);
		$disable_email_link = intval($rowpath['disable_email_link']);
		$disable_photo_link = intval($rowpath['disable_photo_link']);
		$disable_toolbar = intval($rowpath['disable_toolbar']);
		$text_font_size = intval($rowpath['text_font_size']);
		$border_width = intval($rowpath['border_width']);
		$disable_shade = intval($rowpath['disable_shade']);
		$shade_color = $rowpath['shade_color'];
		$shade_opacity = $rowpath['shade_opacity'];
		$background_color = $rowpath['background_color'];		
        $limitnum = $picperpage;
        $result = $db->sql_query("SELECT id, id_cat, picname, pictname, dateadd , count FROM ".$prefix."_mtgalpic WHERE id_cat='$id_cat' ORDER BY id ASC LIMIT $limitnum");
		$piclist= array();
			?><ul class="galcat"><?php
        while ($row2 = $db->sql_fetchrow($result)) {
			$id = intval($row2['id']);
			$id_cat = intval($row2['id_cat']);
			$count = intval($row2['count']);
			$picname = filter($row2['picname'], "nohtml");
			$pictname = filter($row2['pictname'], "nohtml");
			$dateadd = nuketimes(intval($row2['dateadd']));
			$piclist[$i] ="$picpath$pictname";
echo "	<li><a title=\"$picname-("._COUNTER.": $count)\" href=\"modules.php?name=MT-Gallery&amp;pa=showpic&amp;gal=yes&amp;id=$id\"><img src =\"$picpath/$pictname\" alt=\"\"/></a></li>
";
        }
			?></ul><?php
	}else {
?><div class="xnotify"><?php echo ""._NoPIC."" ?></div><?php
	}
}
function xmturl($id){
return "modules.php?name=MT-Gallery&amp;pa=showpic&amp;gal=yes&amp;id=$id";
}
function nextsid($id,$id_cat){
	global $db, $prefix, $nukeurl;
	$xresult = $db->sql_query("SELECT id FROM ".$prefix."_mtgalpic WHERE( id > '$id' AND id_cat='$id_cat') LIMIT 0,1");
	$row2 = $db->sql_fetchrow($xresult);
	$next = intval($row2['id']);
	return $next;
}
function prevsid($id,$id_cat){
	global $db, $prefix, $nukeurl;
	$xresult = $db->sql_query("SELECT id FROM ".$prefix."_mtgalpic WHERE( id < '$id' AND id_cat='$id_cat') ORDER BY `".$prefix."_mtgalpic`.`id` DESC LIMIT 0,1");
	$row2 = $db->sql_fetchrow($xresult);
	$prev = intval($row2['id']);
	return $prev;
}
function gotitlesid($sid){
	global $db, $prefix;
$result = $db->sql_query("select picname FROM ".$prefix."_mtgalpic where id='$sid'");
$row = $db->sql_fetchrow($result);
return filter($row['picname'], "nohtml");
}
function xshowpic($id) {
	global $prefix, $db, $module_name, $datetype, $nukeurl;
	$check = $db->sql_query("SELECT id FROM ".$prefix."_mtgalpic WHERE id='$id'");
	$rowcheck = $db->sql_fetchrow($check);
	$idcheck = intval($rowcheck['id']);
	if ($id AND $idcheck == $id) {
        $rowpath = $db->sql_fetchrow($db->sql_query("SELECT picpath , picpathtum , picperpage FROM ".$prefix."_galconfig"));
        $picpath = addslashes($rowpath['picpath']);
        $picpathtum = addslashes($rowpath['picpathtum']);
        $picperpage = intval($rowpath['picperpage']);
		$id = intval($id);
		$result = $db->sql_query("SELECT id, id_cat, picname, pictname, dateadd , count , picdec FROM ".$prefix."_mtgalpic WHERE id='$id'");
		$db->sql_query("UPDATE ".$prefix."_mtgalpic SET count=count+1 WHERE id='$id'");
        while ($row = $db->sql_fetchrow($result)) {
		$id = intval($row['id']);
		$id_cat = intval($row['id_cat']);
		$count = intval($row['count']);
		$picname = filter($row['picname'], "nohtml");
		$pictname = filter($row['pictname'], "nohtml");
		$picdec = filter($row['picdec'], "nohtml");
		$dateadd = nuketimes(intval($row['dateadd']));
		if($num = $db->sql_numrows($result)){
			$record = $db->sql_fetchrowset($result);
			$name = addslashes($record["name"]);
			echo $name;
		}
		$result2 = $db->sql_query("SELECT id FROM ".$prefix."_mtgalpic WHERE( id > '$id' AND id_cat='$id_cat') LIMIT 0,1");
		$result3 = $db->sql_query("SELECT id FROM ".$prefix."_mtgalpic WHERE( id < '$id' AND id_cat='$id_cat') LIMIT 0,1");
		$row2 = $db->sql_fetchrow($result2);
		$row3 = $db->sql_fetchrow($result3);
		$next = intval($row2['id']);
		$prev = intval($row3['id']);
		$result4 = $db->sql_query("SELECT id FROM ".$prefix."_mtgalpic WHERE id_cat='$id_cat'");
?><div class="post">
<div class="phead"><div class="pcdate"><?php echo $dateadd; ?></div><h2><?php echo $picname; ?></h2></div>
<img class="pimg" src="<?php echo $picpath; ?>/<?php echo $pictname; ?>" alt=""/>
<ul class="share">
	<li><a class="facebook" href="//www.facebook.com/sharer.php?u=<?php echo $nukeurl,xmturl($id); ?>" target="_blank"><span>اشتراک</span></a></li>
	<li><a class="twitter" href="//twitter.com/intent/tweet?source=xtouch&text=<?php echo $picname; ?>+-+&url=<?php echo $nukeurl,xmturl($id); ?>" target="_blank"><span>توییت</span></a></li>
	<li><a class="google" href="//plus.google.com/share?url=<?php echo $nukeurl,xmturl($id); ?>" target="_blank"><span>+ 1</span></a></li>
	<li><a class="email" href="mailto:?subject=<?php echo $picname; ?>&body=<?php echo $nukeurl,xmturl($id); ?>"><span>رایانامه</span></a></li>
</ul>
<div class="conta"><div class="contax"><?php echo $picdec; ?></div></div>
</div><div class="npbox">
<?php if(prevsid($id,$id_cat)>0){ ?><a class="prev" href="<?php echo "modules.php?name=MT-Gallery&amp;pa=showpic&amp;gal=yes&amp;id=".prevsid($id,$id_cat).""; ?>"><?php echo gotitlesid(prevsid($id,$id_cat)); ?></a><?php } ?>
<?php if(nextsid($id,$id_cat)>0){ ?><a class="next" href="<?php echo "modules.php?name=MT-Gallery&amp;pa=showpic&amp;gal=yes&amp;id=".nextsid($id,$id_cat).""; ?>"><?php echo gotitlesid(nextsid($id,$id_cat)); ?></a><?php } ?>
</div><?php
		}
	}else {
?><div class="xnotify"><?php echo ""._InvalidID."" ?></div><?php
	}
}
?>