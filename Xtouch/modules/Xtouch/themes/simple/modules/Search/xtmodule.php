<?php
function xstories_search($query, $topic, $author, $days, $page){
	global $admin, $prefix, $db, $articlecomm, $multilingual, $admin_file, $currentlang,$ThemeSel;
	$module_name="Search";
	if(isset($query)){
		if ($multilingual == 1) {
			$querylang = "AND (alanguage='$currentlang' OR alanguage='')";
		} else {
			$querylang = "";
		}
	
		$query = stripslashes(check_html($query, "nohtml"));
		$query2 = filter($query, "nohtml", 1);
		$query3 = filter($query, "", 1);
		$topic = intval($topic);
		$daystime = time() - intval($days)*86400;
		$entries_per_page = 20;
		$current_page = (empty($page)) ? 1 : $page;
		$start_at  = ($current_page * $entries_per_page) - $entries_per_page;
		$author = (empty($author)) ? "All" : $author;
		$link_to = "modules.php?name=$module_name&op=stories_search&author=$author&topic=$topic&query=$query&days=$days";
		$q = "select s.sid, s.aid, s.informant, s.title, s.time, s.hometext, s.bodytext, s.comments, s.topic from ".$prefix."_stories s, ".$prefix."_authors a where s.aid=a.aid $querylang AND (s.title LIKE '%$query2%' OR s.hometext LIKE '%$query3%' OR s.bodytext LIKE '%$query3%' OR s.notes LIKE '%$query3%') ";
		if (!empty($author) && $author != "All") $q .= "AND s.aid='$author' ";
		if (!empty($days) && $days != 0) $q .= "AND time >= '$daystime'";
		if (!empty($topic)){
			$siquery = $db->sql_query($q);
			while ($qrow = $db->sql_fetchrow($siquery)) {
				$sid = intval($qrow['sid']);
				$topicsf = explode(",",$qrow['topic']);
				if(in_array($topic,$topicsf)){
					$oksid[] = $sid;
				}
			}
			array_map('intval',$oksid);
			$oksid = implode(',',$oksid);
			$q .= " AND s.sid IN ($oksid)";
		}
		$qs .= $q." ORDER BY s.time DESC LIMIT $start_at,$entries_per_page";
		$result = $db->sql_query($qs);
		$result1 = $db->sql_query($q);
		$total_rows = $db->sql_numrows($result1);
		if ($total_rows > 0) {
		echo "<div class=\"xnotify\">"._SEARCHRESULTS." - "._ARTICLES."</div>";
		echo "<ul class=\"mainlist\">\n";
			while($row = $db->sql_fetchrow($result)) {
				$sid = intval($row['sid']);
				$aid = stripslashes($row['aid']);
				$informant = filter($row['informant'], "nohtml");
				$title = filter($row['title'], "nohtml");
				$time = $row['time'];
				$hometext = filter($row['hometext']);
				$bodytext = filter($row['bodytext']);
				$url = filter($row['url'], "nohtml");
				$comments = intval($row['comments']);
				$topic = $row['topic'];
				$topics = explode(",",$topic);
				unset($topicnames);
				foreach($topics as $topicc){
					$row6 = $db->sql_fetchrow($db->sql_query("SELECT topictext from ".$prefix."_topics where topicid='$topicc'"));
					$topictext = filter($row6['topictext'], "nohtml");
					$topicnames[] = "<a href=\"modules.php?name=$module_name&amp;query=$query&amp;topic=$topicc\">$topictext</a> ";
				}
				$topicnames = implode(",",$topicnames);
				$furl = newslink($sid);
				$datetime=nuketimes($time);						
				if (empty($informant)) {
					$informant = $aid;
				} else {
					$informant = "<a href=\"modules.php?name=Your_Account&amp;op=userinfo&amp;username=$informant\">$informant</a>";
				}
				if (!empty($query) AND $query != "*") {
					if (@eregi(quotemeta($query),$title)) {
						$a = 1;
					}
					$text = "$hometext$bodytext";
					if (@eregi(quotemeta($query),$text)) {
						$a = 2;
					}
					if (@eregi(quotemeta($query),$text) AND @eregi(quotemeta($query),$title)) {
						$a = 3;
					}
					if ($a == 1) {
						$match = _MATCHTITLE;
					} elseif ($a == 2) {
						$match = _MATCHTEXT;
					} elseif ($a == 3) {
						$match = _MATCHBOTH;
					}
					if (!isset($a)) {
						$match = "";
					} else {
						$match = "$match<br>";
					}
				}

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
<?php
			}
		echo "</ul>";
		} else {
		echo "<div class=\"xnotify\">"._NOMATCHES."</div>";
		}
		if ($total_rows>0) {
			echo"<div id=\"pagination\" class=\"pagination\">";
			xclean_pagination($total_rows, $entries_per_page, $current_page, $link_to);
			echo"</div>";
		}
	}else{
		echo "<div class=\"xnotify\">جستجو برای کلمات بیش از 3 حرف امکان پذیر می باشد.</div>";
	}
}
function xtmodule($query){
	global $db, $prefix;
if (isset($query)) {
if (strlen($query) < 3) {
	echo "<div class=\"xnotify\">جستجو برای کلمات بیش از 3 حرف امکان پذیر می باشد.</div>";
}else{
	xstories_search($query,"","","","");
}
}else{
?><style type="text/css">form.searchbox{display:block}</style><?php
	echo "<div class=\"xnotify\">برای جستجو از باکس بالا استفاده کنید.</div>";
}
}
?>