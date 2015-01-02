<?php
function xtmnews($page){
global $db, $prefix, $sitename, $pagetitle, $ThemeSel, $name, $sid, $userinfo, $user_news, $storyhome, $new_topic, $query, $page, $nukeurl;
$xpage=0;
if(isset($page)){
$xpage=($page-1)*5;
}
 ?><ul class="mainlist">
<?php	$result = $db->sql_query("SELECT * FROM `" . $prefix . "_stories` ORDER BY `" . $prefix . "_stories`.`sid` DESC LIMIT $xpage , 5");
	while ($row = $db->sql_fetchrow($result)) {
	mb_internal_encoding('UTF-8');
	$sid = intval($row['sid']);
	$hometext = $row['hometext'];
	$datetime = $row['time'];
	$datetime = nuketimes($row['time']);
	$title = check_html($row['title'], "nohtml");
	$doc=new DOMDocument();
	$doc->loadHTML($hometext);
	$xml=simplexml_import_dom($doc); // just to make xpath more simple
        $img = $doc->getElementsByTagName('img')->item(0);
	if(file_exists('files/News/'.$sid.'.jpg')){
		$imageurl = 'files/News/'.$sid.'.jpg';
	}else{
        if (!empty($img)) {
        	$imageurl = $img->getAttribute('src');
	} else {
		$imageurl = "themes/$ThemeSel/images/no-photo.jpeg";
	}
	}
?>	<li><a href="<?php echo newslink($sid); ?>" title="<?=$title?>"><img src="timthumb.php?src=<?php echo $imageurl; ?>&q=100&w=70&h=70" alt=""/><div class="umlmain"><div class="date"><?php echo $datetime; ?></div><h4 class="xsxh4"><?=$title?></h4></div></a></li>
<?php } ?></ul><?php
if (!(isset($new_topic))) { $new_topic = 0; }
if($new_topic==0){
$link_to = "modules.php?name=News";
}else{
$link_to = "modules.php?name=News&new_topic=$new_topic";
}
    if (isset($userinfo['storynum']) AND $user_news == 1) {
		$storynum = $userinfo['storynum'];
	} else {
		$storynum = $storyhome;
	}
		$entries_per_page = $storynum;
	$current_page = (empty($page)) ? 1 : $page;
	$start_at  = ($current_page * $entries_per_page) - $entries_per_page;
		$total_rows = 0;
	$query = $db->sql_query("SELECT * FROM `" . $prefix . "_stories` ORDER BY `" . $prefix . "_stories`.`sid` DESC LIMIT 0 , 99999999999");
	if ($new_topic == 0) {$total_rows = $db->sql_numrows($query);}else{
		while ($qrow = $db->sql_fetchrow($query)) {
			$sid = intval($qrow['sid']);
			$topicsf = explode(",",$qrow['topic']);
			if(in_array($new_topic,$topicsf)){
				$oksid[] = $sid;
				$total_rows++;
			}
		}
	
	}
		echo"<div class=\"pagination\">";
		xclean_pagination($total_rows, $entries_per_page, $current_page, $link_to);
		echo"</div>";
}
function nextsid($sid){
	global $db, $prefix, $nukeurl;
	$xresult = $db->sql_query("SELECT sid FROM ".$prefix."_stories WHERE sid > '$sid' LIMIT 0,1");
	$row2 = $db->sql_fetchrow($xresult);
	$next = intval($row2['sid']);
	return $next;
}
function prevsid($sid){
	global $db, $prefix, $nukeurl;
	$xresult = $db->sql_query("SELECT sid FROM ".$prefix."_stories WHERE sid < '$sid' ORDER BY `".$prefix."_stories`.`sid` DESC LIMIT 0,1");
	$row2 = $db->sql_fetchrow($xresult);
	$prev = intval($row2['sid']);
	return $prev;
}
function gotitlesid($sid){
	global $db, $prefix;
$result = $db->sql_query("select title FROM ".$prefix."_stories where sid='$sid'");
$row = $db->sql_fetchrow($result);
return $row['title'];
}
function xtmodule($sid){
	global $db, $prefix, $nukeurl;
$result = $db->sql_query("select aid, time, title, hometext, bodytext, newslevel, news_group, topic, informant, newsurl, notes, acomm, haspoll, pollID, score, ratings, story_pass, topic_link, counter FROM ".$prefix."_stories where sid='$sid'");
if ($numrows = $db->sql_numrows($result) != 1) {
	Header("Location: ".LinkToGT("index.php")."");
	die();
}
$row = $db->sql_fetchrow($result);
$aid = filter($row['aid'], "nohtml");
$time = filter($row['time']);
$title = filter($row['title'], "nohtml");
$hometext = stripslashes($row['hometext']);
$hometext = codereplace($hometext,$sid);
$bodytext = stripslashes($row['bodytext']);
$bodytext = codereplace($bodytext,$sid);
$newslevel  = intval($row['newslevel']);
$news_group = intval($row['news_group']);
$counter = intval($row['counter']);
$topics = $row['topic'];
$topic_link = $row['topic_link'];
$informant = filter($row['informant'], "nohtml");
$newsurl = filter($row['newsurl']);
$notes = filter($row['notes']);
$notes2 = filter($row['notes']);
$acomm = intval($row['acomm']);
$haspoll = intval($row['haspoll']);
$pollID = intval($row['pollID']);
$score = intval($row['score']);
$ratings = intval($row['ratings']);
$story_pass = $row['story_pass'];
$topic_result = $db->sql_query("SELECT topicname, topicimage FROM ".$prefix."_topics WHERE topicid = $topic_link");
$torow = $db->sql_fetchrow($topic_result);
$topictext_link = filter($torow['topictext'], "nohtml");
$topicname_link = filter($torow['topicname'], "nohtml");
$topicimage_link = filter($torow['topicimage'], "nohtml");

if (empty($aid)) {
	Header("Location: ".LinkToGT("modules.php?name=News")."");
}

$db->sql_query("UPDATE ".$prefix."_stories SET counter=counter+1 where sid='$sid'");

$artpage = 1;
$pagetitle = "- $title";
$artpage = 0;
$datetime=nuketimes($time);

if(empty($informant)) {
	$informant = $anonymous;
}

if ($newslevel == 0) {
} elseif ($newslevel == 1 AND (is_user($user) AND is_group_news($user, $sid)) OR is_admin($admin)) {	
} elseif ($newslevel == 1 AND (is_user($user) and !is_group_news($user, $sid)) AND !is_admin($admin)) {	
      if ($news_group != 0) {
        $result3 = $db->sql_query("SELECT name FROM ".$prefix."_groups WHERE id='".intval($news_group)."'");
        $row3 = $db->sql_fetchrow($result3);
        $resultz = $db->sql_query("SELECT points FROM ".$prefix."_groups WHERE id='".intval($news_group)."'");
        $rowz = $db->sql_fetchrow($resultz);
        $bodytext= "<center>";
        $bodytext.=""._DEDICATEDTO1." <b>".$row3['name']."</b> "._DEDICATEDTO1."<br><br>";
        $bodytext.= ""._NEEDEDSCORE." : ".$rowz['points']."<br><br>";
        $bodytext.= "</center>";
      }
        $bodytext.="<center>";
        $bodytext.= _GOBACK;
        $bodytext.= "</center>";
} elseif ($newslevel == 2 AND is_admin($admin)) {
} elseif ($newslevel == 2 AND !is_admin($admin)) {
        $bodytext= "<center>";
        $bodytext.=""._DEDICATEDTOADMINS."<br><br>";
        $bodytext.= _GOBACK;
        $bodytext.= "</center>";
} elseif ($newslevel == 3 AND paid()) {
} else {
        $bodytext= "<center>";
        $bodytext.=""._REGISTERNEED."<br><br><a href = 'modules.php?name=Your_Account&op=new_user'>"._CZ_REGISTER."</a><br><br>";
        $bodytext.= _GOBACK;
        $bodytext.= "</center>";
}

$this_article_pass = $_COOKIE['this_article_pass'.$sid];
$this_article_pass = intval($this_article_pass);

if(($story_pass != "") && ($this_article_pass != "1")){
	if(!isset($your_pass)){
		$bodytext= "<center>";
		$bodytext.=""._REQUIRED_PASS."<br><br><form action=\"modules.php?name=$module_name&file=article-seo&sid=$sid-\" method=\"post\">";
		$bodytext.=""._INSERT_PASS." &nbsp;<input type=\"password\" name=\"your_pass\" /> &nbsp;<input type=\"submit\" value=\""._SEND."\" />";
		$bodytext.= _GOBACK;
		$bodytext.= "</center>";
		$ending = 1;
	}elseif(isset($your_pass) && ($story_pass != $your_pass)){
		$bodytext= "<center>";
		$bodytext.=""._WRONG_PASS."<br><br><form action=\"modules.php?name=$module_name&file=article-seo&sid=$sid-\" method=\"post\">";
		$bodytext.=""._INSERT_PASS." &nbsp;<input type=\"password\" name=\"your_pass\" /> &nbsp;<input type=\"submit\" value=\""._SEND."\" />";		
		$bodytext.= _GOBACK;
		$bodytext.= "</center>";
		$ending = 1;
	}elseif(isset($your_pass) && ($story_pass == $your_pass)){
		nuke_set_cookie("this_article_pass".$sid,"1",time()+3600);
		Header("Location: ".LinkToGT(newslink($sid))."");
	}
}
$printpage = "modules.php?name=$module_name&amp;file=print&amp;sid=$sid";
	$doc=new DOMDocument();
	$doc->loadHTML($hometext);
	$xml=simplexml_import_dom($doc); // just to make xpath more simple
        $img = $doc->getElementsByTagName('img')->item(0);
	if(file_exists('files/News/'.$sid.'.jpg')){
		$imageurl = 'files/News/'.$sid.'.jpg';
	}else{
        if (!empty($img)) {
        	$imageurl = $img->getAttribute('src');
	} else {
		$imageurl = "noimg";
	}
	}
?><div class="post">
<div class="phead"><div class="pcdate"><?php echo $datetime; ?></div><h2><?php echo $title; ?></h2></div>
<?php if($imageurl=="noimg"){}else{ ?><img class="pimg" src="<?php echo $imageurl; ?>" alt=""/><?php } ?>
<ul class="share">
	<li><a class="facebook" href="//www.facebook.com/sharer.php?u=<?php echo $nukeurl,newslink($sid); ?>" target="_blank"><span>اشتراک</span></a></li>
	<li><a class="twitter" href="//twitter.com/intent/tweet?source=xtouch&text=<?php echo $title; ?>+-+&url=<?php echo $nukeurl,newslink($sid); ?>" target="_blank"><span>توییت</span></a></li>
	<li><a class="google" href="//plus.google.com/share?url=<?php echo $nukeurl,newslink($sid); ?>" target="_blank"><span>+ 1</span></a></li>
	<li><a class="email" href="mailto:?subject=<?php echo $title; ?>&body=<?php echo $nukeurl,newslink($sid); ?>"><span>رایانامه</span></a></li>
</ul>
<div class="conta"><div class="contax"><?php echo $hometext; ?><br><br><?php echo $bodytext; ?></div></div>
</div>
<div class="npbox">
<?php if(prevsid($sid)>0){ ?><a class="prev" href="<?php echo newslink(prevsid($sid)); ?>"><?php echo gotitlesid(prevsid($sid)); ?></a><?php } ?>
<?php if(nextsid($sid)>0){ ?><a class="next" href="<?php echo newslink(nextsid($sid)); ?>"><?php echo gotitlesid(nextsid($sid)); ?></a><?php } ?>
</div><?php
}
?>