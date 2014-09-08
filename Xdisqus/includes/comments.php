<?php

/************************************************************************/
/* PHP-NUKE: Web Portal System                                          */
/* ===========================                                          */
/*                                                                      */
/* Copyright (c) 2006 by Francisco Burzi                                */
/* http://phpnuke.org                                                   */
/*                                                                      */
/* This program is free software. You can redistribute it and/or modify */
/* it under the terms of the GNU General Public License as published by */
/* the Free Software Foundation; either version 2 of the License.       */
/************************************************************************/

if (!defined('MODULE_FILE')) {
	die ("You can't access this file directly...");
}
require_once("mainfile.php");
get_lang($module_name);
$pagetitle = "- "._NEWS."";
global $user;
cookiedecode($user);
getusrinfo($user);
$mode = $userinfo['umode'];
$order = $userinfo['uorder'];
$thold = $userinfo['thold'];
function xsvs($nuim){
global $prefix, $db, $dbname;
$nuim=intval($nuim);
$result = $db->sql_query("SELECT * FROM `" . $prefix . "_xdisqus` WHERE `xsid` =$nuim LIMIT 0 , 1");
	while ($row = $db->sql_fetchrow($result)) {
	mb_internal_encoding('UTF-8');
	$xsid = intval($row['xsid']);
	$xsname = $row['xsname'];
	$xsvalue = $row['xsvalue'];
}
return $xsvalue;
}
function xdisqusview($xdisqusid,$xdif){
global $prefix, $db, $dbname;
?><div id="disqus_thread"></div><script type="text/javascript">var disqus_identifier = '<?php echo $xdif; ?>';var disqus_shortname="<?php echo $xdisqusid; ?>";(function(){var e=document.createElement("script");e.type="text/javascript";e.async=true;e.src="//"+disqus_shortname+".disqus.com/embed.js";(document.getElementsByTagName("head")[0]||document.getElementsByTagName("body")[0]).appendChild(e)})()</script><noscript>Please enable JavaScript to view the <a href="http://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript><a href="http://disqus.com" class="dsq-brlink">comments powered by <span class="logo-disqus">Disqus</span></a>
<?php
}
if(xsvs(1)==1){
switch($comcode){
	case"1":
		$ctable = "stories";
		$pagevar = "$sid";
		$pagefiled = "sid";
		$parent = "pid";
		$admin_delete_op = "removeComment";
		$admin_edit_op = "editcomm";
		$allowcomments = $articlecomm;
	break;
	case"2":
		$ctable = "poll_desc";
		$pagevar = "$pollID";
		$pagefiled = "pollID";
		$parent = "pid";
		$admin_delete_op = "RemovePollComment";
		$admin_edit_op = "editPollComment";
		$allowcomments = $pollcomm;
	break;
	case"3":
		$ctable = "products";
		$pagevar = "$sid";
		$pagefiled = "sid";
		$parent = "pid";
		$admin_delete_op = "pro_removeComment";
		$admin_edit_op = "pro_editcomm";
		$allowcomments = $productscomm;
	break;
	
	case"4":
		$ctable = "pages";
		$pagevar = "$pageid";
		$pagefiled = "pageid";
		$parent = "prid";
		$admin_delete_op = "removeconComment";
		$admin_edit_op = "editconcomm";
		$allowcomments = $contentcom;
	break;
	case"5":
		$ctable = "staticpages";
		$pagevar = "$staticid";
		$pagefiled = "staticid";
		$parent = "prid";
		$admin_delete_op = "removestacom";
		$admin_edit_op = "editstacom";
		$allowcomments = $staticcomm;
	break;
}
$xdif="$ctable-$pagefiled-$pagevar";
if(xsvs(2)==""){
?><p style="text-align:center;color:red;font:normal 12px tahoma;">لطفا shortname خود را ثبت کنید.</p><?php
}else{
xdisqusview(xsvs(2),$xdif);
}
}else{
$Req_Protocol 	= strpos(strtolower($_SERVER['SERVER_PROTOCOL']),'https') === FALSE ? 'http' : 'https';
$Req_Hosta     	= $_SERVER['HTTP_HOST'];
$Req_Uri		= $_SERVER['REQUEST_URI'];
$Req_URIs		= $Req_Protocol . '://' . $Req_Host . $Req_Uri;
$show_sec_code = 1;

switch($comcode){
	case"1":
		$ctable = "stories";
		$pagevar = "$sid";
		$pagefiled = "sid";
		$parent = "pid";
		$admin_delete_op = "removeComment";
		$admin_edit_op = "editcomm";
		$allowcomments = $articlecomm;
	break;
	case"2":
		$ctable = "poll_desc";
		$pagevar = "$pollID";
		$pagefiled = "pollID";
		$parent = "pid";
		$admin_delete_op = "RemovePollComment";
		$admin_edit_op = "editPollComment";
		$allowcomments = $pollcomm;
	break;
	case"3":
		$ctable = "products";
		$pagevar = "$sid";
		$pagefiled = "sid";
		$parent = "pid";
		$admin_delete_op = "pro_removeComment";
		$admin_edit_op = "pro_editcomm";
		$allowcomments = $productscomm;
	break;
	
	case"4":
		$ctable = "pages";
		$pagevar = "$pageid";
		$pagefiled = "pageid";
		$parent = "prid";
		$admin_delete_op = "removeconComment";
		$admin_edit_op = "editconcomm";
		$allowcomments = $contentcom;
	break;
	case"5":
		$ctable = "staticpages";
		$pagevar = "$staticid";
		$pagefiled = "staticid";
		$parent = "prid";
		$admin_delete_op = "removestacom";
		$admin_edit_op = "editstacom";
		$allowcomments = $staticcomm;
	break;
}

function comments_form(){
	global $user, $anonpost, $prefix, $db, $module_name, $admin, $userinfo, $cookie, $comment_editor, $mode, $order, $thold, $Req_URI, $comcode, $show_sec_code, $sid, $pid;
	echo "\n\n<!-- COMMENTS NAVIGATION BAR START -->\n\n";
	echo "<a name=\"commenteditor\"></a>\n";
	echo "<form name = 'comments' action=\"$Req_URI\" method=\"post\">";
	echo "<table width=\"100%\" border=\"0\"><tr>"
	."<td colspan=\"2\"><font class=option><b>"._YOURNAME.":</b></font> ";
	if (is_user($user)) {
		cookiedecode($user);
		echo "<a href=\"modules.php?name=Your_Account\">$cookie[1]</a> <font class=\"content\">[ <a href=\"modules.php?name=Your_Account&amp;op=logout\">"._LOGOUT."</a> ]</font><br><br>";
	} else {
		echo "<font class=\"content\">$anonymous";
		echo " [ <a href=\"modules.php?name=Your_Account\">"._NEWUSER."</a> ]<br><br>";
	}
	echo"</td></tr>";
	//Zero-F Added 
	$cfresult = $db->sql_query("SELECT * FROM ".$prefix."_comments_config WHERE code='$comcode' ORDER BY weight ASC");
	$m=0;
	while($cfrows = $db->sql_fetchrow($cfresult)){
		if($cfrows['need'] == 1){
			$need = "("._REQUIERD.")";
		}else{
			$need = "";
		}
		echo "<tr><td width=\"130\"><font class=\"option\"><b>".$cfrows['title']." $need:</b></font></td>";
		$cfvalue = explode("::",filter($cfrows['value'], "nohtml"));
		if (count($cfvalue) == 1) {
			echo "<td><input onkeypress=FKeyPress(this); onkeydown=FKeyDown(this); size=\"30\" type=\"text\" name=\"cfname[$m]\"  value=\"".$cfrows['value']."\" />&nbsp;<img src=\"images/fa2.gif\" align=\"absbottom\" style=\"CURSOR: hand\" onclick=change(subject);></td></tr>\n";
		} else {
			echo "<td><select name=\"cfname[$m]\">\n";
			for ($i = 0; $i<count($cfvalue); $i++) {
				echo "<option value=\"".trim($cfvalue[$i])."\">".trim($cfvalue[$i])."</option>\n";
			}
			echo "</select></td></tr>";
		}
		$m++;
	}
	echo "<tr><td><font class=\"option\"><b>"._UCOMMENT.":</b></font></td><td>";

	if($comment_editor == 1){
		echo "<script language=\"javascript\">
				function Smiles(which) {
					document.comments.comment.value = document.comments.comment.value + which;
				} 
				</SCRIPT>";
		echo"<textarea onkeypress=FKeyPress(this); onkeydown=FKeyDown(this); wrap=\"virtual\" cols=\"70\" rows=\"15\" name=\"comment\">$comment</textarea><br><img src=\"images/fa.gif\" align=\"absbottom\" style=\"CURSOR: hand\" onclick=change(comment);><br>";
		echo "<br><a href=\"javascript:Smiles(':)')\"><img src=\"images/smiles/icon_biggrin.gif\" border=0 alt=':)'></a> ";
		echo "<a href=\"javascript:Smiles(';)')\"><img src=\"images/smiles/icon_arrow.gif\" border=0 alt=';)'></a> ";
		echo "<a href=\"javascript:Smiles('|)')\"><img src=\"images/smiles/icon_confused.gif\" border=0 alt='|)'></a> ";
		echo "<a href=\"javascript:Smiles(':-')\"><img src=\"images/smiles/icon_cool.gif\" border=0 alt=':-'></a> ";
		echo "<a href=\"javascript:Smiles(':(')\"><img src=\"images/smiles/icon_cry.gif\" border=0 alt=':('></a> ";
		echo "<a href=\"javascript:Smiles(':0')\"><img src=\"images/smiles/icon_eek.gif\" border=0 alt=':0'></a> ";
		echo "<a href=\"javascript:Smiles(':#')\"><img src=\"images/smiles/icon_evil.gif\" border=0 alt=':#'></a> ";
		echo "<a href=\"javascript:Smiles('*)')\"><img src=\"images/smiles/icon_exclaim.gif\" border=0 alt='*)'></a> ";
		echo "<a href=\"javascript:Smiles('^)')\"><img src=\"images/smiles/icon_razz.gif\" border=0 alt='^)'></a> ";
		echo "<a href=\"javascript:Smiles('+))')\"><img src=\"images/smiles/icon_surprised.gif\" border=0 alt='+))'></a> ";
		echo "<a href=\"javascript:Smiles(':}')\"><img src=\"images/smiles/icon_smile.gif\" border=0 alt=':}'></a> ";
		echo "<a href=\"javascript:Smiles('|((')\"><img src=\"images/smiles/icon_sad.gif\" border=0 alt='|(('></a> ";
		echo "<a href=\"javascript:Smiles('@:')\"><img src=\"images/smiles/icon_rolleyes.gif\" border=0 alt='@:'></a> ";
		echo "<a href=\"javascript:Smiles('(:)')\"><img src=\"images/smiles/icon_redface.gif\" border=0 alt='(:)'></a> ";
		echo "<a href=\"javascript:Smiles(':?')\"><img src=\"images/smiles/icon_question.gif\" border=0 alt=':?'></a> ";
		echo "<a href=\"javascript:Smiles(':**')\"><img src=\"images/smiles/icon_idea.gif\" border=0 alt=':**'></a> ";
	}elseif($comment_editor == 2){
		wysiwyg_textarea('comment', '', 'Comments', '50', '8');
	}
	echo"</td></tr>";
	if (extension_loaded("gd") && $show_sec_code == 1) {
		echo "<tr><td><b>"._SECURITYCODE."</b></td><td>".makePass("_newscomment")."</td></tr>";
	}
	echo "<tr id=\"replayto\">&nbsp;</tr>";
	echo"<tr><td></td><td>";
	if (is_user($user) AND ($anonpost == 1)) {
		echo " <input type=\"checkbox\" name=\"xanonpost\"> "._POSTANON."";
	}
	echo"</td></tr>\n
	<tr><td>&nbsp;</td><td><input type=\"submit\" value=\""._OK."\">
	<input type=\"hidden\" name=\"comop\" value=\"sendcomment\"> "._GOBACK."\n
	</font></td></tr></table></form>\n";
	if ($anonpost == 0 AND !is_user($user)) {
		echo "<br>";
		echo "<center>"._NOANONCOMMENTS."</center>";
	}
}

function display_comments($tid, $classtyp){
	global $user, $anonpost, $prefix, $db, $module_name, $admin, $userinfo, $cookie, $comment_editor, $mode, $order, $thold, $Req_URI, $comcode, $show_sec_code, $comtable, $pagevar, $pagefiled, $acomm, $allowcomments, $Req_Hosta, $admin_delete_op, $admin_edit_op, $parent;
	$partid = intval($tid);
	if(is_admin($admin)){
		$q = "SELECT * FROM ".$prefix."_".$comtable." WHERE $pagefiled = '$pagevar' AND $parent = '$partid'";
	}else{
		$q = "SELECT * FROM ".$prefix."_".$comtable." WHERE $pagefiled = '$pagevar' and act='1' AND $parent = '$partid'";
	}
	if(!empty($thold)) {
		$q .= " AND score >= '$thold'";
	} else {
		$q .= " AND score >= '0'";
	}
	if ($order==1) $q .= " ORDER BY date DESC";
	if ($order==2) $q .= " ORDER BY score DESC";
	$something = $db->sql_query($q);
	$num_tid = $db->sql_numrows($something);
	if ($acomm == 1) {
		return;
	}
	while ($row_q = $db->sql_fetchrow($something)) {
		$tid = intval($row_q['tid']);
		$pagevar = intval($row_q[$pagefiled]);
		$parentid = intval($row_q[$parent]);
		$act = intval($row_q['act']);
		$date = $row_q['date'];
		$c_name = filter($row_q['name'], "nohtml");
		$host_name = filter($row_q['host_name'], "nohtml");
		$comment = stripslashes($row_q['comment']);
		$score = intval($row_q['score']);
		$reason = intval($row_q['reason']);
		if (empty($c_name)) { $c_name = "Anonymous"; }
		$result = $db->sql_query("SELECT user_id, user_avatar, karma, user_website FROM ".$prefix."_users WHERE username='$c_name'");
		$userrow = $db->sql_fetchrow($result);
		$user_id = intval($userrow['user_id']);
		$user_avatar = $userrow['user_avatar'];
		$karma = intval($userrow['karma']);
		if (is_admin($admin)) {
			if ($karma == 1) {
				$karma = "<img src=\"images/karma/1.gif\" border=\"0\" alt=\""._KARMALOW."\" title=\""._KARMALOW."\">&nbsp;";
			} elseif ($karma == 2) {
				$karma = "<img src=\"images/karma/2.gif\" border=\"0\" alt=\""._KARMABAD."\" title=\""._KARMABAD."\">&nbsp;";
			} elseif ($karma == 3) {
				$karma = "<img src=\"images/karma/3.gif\" border=\"0\" alt=\""._KARMADEVIL."\" title=\""._KARMADEVIL."\">&nbsp;";
			} else {
				$karma = "";	
			}
		} else {
			$karma = "";	
		}

		if(is_admin($admin) AND $act == 0){
			$deact = "<p align=\"center\" style=\"color:#FF0000;\"><b>"._INACTIVE."</b></p>";
		}else{
			$deact = "";
		}
		$datetime=nuketimes($date);
		$cfresult = $db->sql_query("SELECT * FROM ".$prefix."_comments_config WHERE code='$comcode' ORDER BY weight ASC");
		while($cfrow = $db->sql_fetchrow($cfresult)){
			$weight[] = $cfrow['weight'];
			sort($weight);
			$cftitle[] = $cfrow['title'];
		}
		foreach($weight as $weight2){
			$cfresult2 = $db->sql_query("SELECT * FROM ".$prefix."_".$comtable."_fildes WHERE(tid='$tid' AND weight='$weight2')");
			$cfrows2 = $db->sql_fetchrow($cfresult2);
			$cfvalue[] = filter($cfrows2['cfvalue'], "nohtml");
		}		
		$b=0;
		unset($fileds);
		foreach($cfvalue as $value){
			$fileds .= "<b>$cftitle[$b]</b>: $value<br />";
			$b++;
		}
		$b=0;
		unset($cfvalue);
		unset($cftitle);
		unset($weight);
		/* If you are admin you can see the Poster IP address */
		/* with this you can see who is flaming you...*/

		$journal = "";
		if (is_active("Journal")) {
			$row = $db->sql_fetchrow($db->sql_query("SELECT jid FROM ".$prefix."_journal WHERE aid='$c_name' AND status='yes' ORDER BY pdate,jid DESC LIMIT 0,1"));
			$jid = intval($row['jid']);
			if (!empty($jid) AND isset($jid)) {
				$journal = " | <a href=\"modules.php?name=Journal&amp;file=display&amp;jid=$jid\">"._JOURNAL."</a>";
			} else {
				$journal = "";
			}
		}
		
		$url = filter($userrow['user_website'], "nohtml");
		if ($url != "http://" AND !empty($url) AND stripos_clone($url, "http://")) { $u_website = "$url"; }

		if(is_admin($admin)) {
			$row3 = $db->sql_fetchrow($db->sql_query("SELECT host_name FROM ".$prefix."_".$comtable." WHERE tid='$tid'"));
			$host_name = filter($row3['host_name'], "nohtml");
			$u_ip = "$host_name";
		}

		
		$avaimage = addslashes($user_avatar);
		if(!@ereg("/", $avaimage) && !@ereg("blank.gif", $avaimage)){
			$avaimage = "Forum/download/file.php?avatar=$avaimage";
		}elseif(@ereg("http://", $avaimage)){
			$avaimage = "$avaimage";
		}else{
			$avaimage = "Forum/images/avatars/gallery/$avaimage";
		}
		if ($avaimage != "")  {
			$avaimage = "$avaimage";
		}else {
			$avaimage = "modules/Forums/images/avatars/gallery/blank.gif";
		}
		
		$comment = str_replace(":)", "<img src='images/smiles/icon_biggrin.gif'>", $comment);
		$comment = str_replace(";)", "<img src='images/smiles/icon_arrow.gif'>", $comment);
		$comment = str_replace("|)", "<img src='images/smiles/icon_confused.gif'>", $comment);
		$comment = str_replace(":-", "<img src='images/smiles/icon_cool.gif'>", $comment);
		$comment = str_replace(":(", "<img src='images/smiles/icon_cry.gif'>", $comment);
		$comment = str_replace(":0", "<img src='images/smiles/icon_eek.gif'>", $comment);
		$comment = str_replace(":#", "<img src='images/smiles/icon_evil.gif'>", $comment);
		$comment = str_replace("*)", "<img src='images/smiles/icon_exclaim.gif'>", $comment);
		$comment = str_replace("^)", "<img src='images/smiles/icon_razz.gif'>", $comment);
		$comment = str_replace("+))", "<img src='images/smiles/icon_surprised.gif'>", $comment);
		$comment = str_replace(":}", "<img src='images/smiles/icon_smile.gif'>", $comment);
		$comment = str_replace("|((", "<img src='images/smiles/icon_sad.gif'>", $comment);
		$comment = str_replace("@:", "<img src='images/smiles/icon_rolleyes.gif'>", $comment);
		$comment = str_replace("(:)", "<img src='images/smiles/icon_redface.gif'>", $comment);
		$comment = str_replace(":?", "<img src='images/smiles/icon_question.gif'>", $comment);
		$comment = str_replace(":**", "<img src='images/smiles/icon_idea.gif'>", $comment);
		if($classtyp == 0){
			$classstyle = "comment_class1";
			$classtyp=1;
		}else{
			$classstyle = "comment_class2";
			$classtyp=0;
		}
		if(is_admin($admin)){
			$subcomres = $db->sql_query("SELECT tid FROM ".$prefix."_".$comtable." WHERE $parent = '$tid'");
		}else{
			$subcomres = $db->sql_query("SELECT tid FROM ".$prefix."_".$comtable." WHERE act='1' AND $parent = '$tid'");
		}
		$subcomrow = intval($db->sql_numrows($subcomres));
		comments_show($tid, $deact, $fileds, $score, $c_name, $datetime, $journal, $u_website, $u_ip, $karma, $avaimage, $comment, $pagevar, $pagefiled, $parent, $admin_delete_op, $admin_edit_op, $comcode, $parentid, $classstyle, $classtyp, $subcomrow, $Req_URI);
		unset($fileds);
	}

	if ($allowcomments == 1 && $partid == 0) {
		comments_form();
	}
}

function sendcomment($xanonpost, $cfname, $comment, $replay, $security_code, $security_code_id){
	global $user, $anonpost, $prefix, $db, $module_name, $admin, $userinfo, $cookie, $comment_editor, $mode, $order, $thold, $Req_URI, $comcode, $show_sec_code, $comtable, $pagevar, $pagefiled, $acomm, $allowcomments, $Req_Hosta, $admin_delete_op, $admin_edit_op, $parent, $confirm_need;
	
	$cfresult = $db->sql_query("SELECT * FROM ".$prefix."_comments_config WHERE code='$comcode' ORDER BY weight ASC");
	$m=0;
	while($cfrows = $db->sql_fetchrow($cfresult)){
		$need = intval($cfrows['need']);
		if($need == 1){
			if(empty($cfname[$m])){
				$a = 1;
				break;
			}
		}
		$m++;
	}
	if ($a == 1 OR empty($comment) OR (empty($security_code) AND $show_sec_code == 1 AND extension_loaded("gd"))) {
		title("$sitename - "._COMMENTSSYSTEM."");
		echo "<center>"._COMMENTPOSTERROR."<br><br>"._GOBACK."</center>";
		return;
	}
	if (is_user($user) AND !$xanonpost) {
		$name = $userinfo['username'];
		$email = $userinfo['femail'];
		$url = $userinfo['user_website'];
		$score = 1;
	} else {
		$name = "";
		$email = "";
		$url = "";
		$score = 0;
	}
	if(!isset($ip)) {
		$ip = $_SERVER['REMOTE_ADDR'];
	}
	if ($allowcomments == 1) {
		if (($anonpost == 0 AND is_user($user)) OR $anonpost == 1) {
			if (extension_loaded("gd") && $show_sec_code == 1) {
				include("includes/captcha/securimage.php");
				$img = new Securimage();
				$valid = $img->check($security_code, $security_code_id);
				if(empty($security_code) || $valid != true) {
					$codesend = false;
				}else{
					$codesend = true;
				}
			}else{
				$codesend = true;
			}
			if ($codesend == true) {
				if($confirm_need == 1 && !is_admin($admin)){
					$act = 0;
				}else{
					$act = 1;
				}
				$time = time();
				$replay = intval($replay);
				$db->sql_query("INSERT INTO ".$prefix."_".$comtable." ($parent, $pagefiled, date, name, url, host_name, comment, score, act) VALUES ('$replay', '$pagevar', '$time', '$name', '$url', '$ip', '$comment', '$score', '$act')");
				$resultw = $db->sql_query("select tid FROM ".$prefix."_".$comtable." ORDER BY tid DESC LIMIT 0,1");
				$roww = $db->sql_fetchrow($resultw);
				$tidw = intval($roww['tid']);
				$cfresult = $db->sql_query("SELECT * FROM ".$prefix."_comments_config WHERE code='$comcode' ORDER BY weight ASC");
				$n=0;
				while($cfrows = $db->sql_fetchrow($cfresult)){
					$cfid = intval($cfrows['cfid']);
					$weight = intval($cfrows['weight']);
					$db->sql_query("INSERT INTO ".$prefix."_".$comtable."_fildes VALUES (NULL, '$tidw', '$cfid', '$cfname[$n]','$weight')");
					$n++;
				}
                global $ctable;
				$db->sql_query("UPDATE ".$prefix."_".$ctable." SET comments=comments+1 WHERE $pagefiled='$pagevar'");
				///send comment with sms to admins or members
				$smsfresult = $db->sql_query("SELECT * FROM ".$prefix."_sms_settings");
				$smsfrows = $db->sql_fetchrow($smsfresult);
				$sabausername = $smsfrows['sabausername'];
				$sabapassword = $smsfrows['sabapassword'];
				$sms_auto_number = $smsfrows['sms_auto_number'];
				$smsadmins  = $smsfrows['smsadmins'];
				$sms_def_title  = $smsfrows['sms_def_title'];
				$smsstatusef = explode(",",$smsfrows['statusef']);
				if(in_array(1, $smsstatusef)){
					require_once('modules/sms/includes/sabapayamak.php');
					$sabapayamak = new sabapayamak($sabausername,$sabapassword);
					$smsadmins = explode(",",$smsadmins);
					foreach($smsadmins as $smsadmin){
						$smsadmin = explode(":",$smsadmin);
						$smsadminnumber[] = $smsadmin[1];
					}
					$comment = @preg_replace("/<[^>]+\>/i", "", $comment); 
					$message = "$sms_def_title:\n"._COMMENTS."\n";
					$message .= substr($comment,0,100);
					$smsadminnumber = implode(",",$smsadminnumber);
					$smss = $sabapayamak->Send($sms_auto_number,$smsadminnumber,$message,0);
				}
				///send comment with sms to admins or members
			}
			update_points(5);
			if ($ultramode) { ultramode(); }
		} else {
			echo "<center>"._ERRORSENDCOMMENT."<br><br>"._GOBACK."</center>";
		}
		if($confirm_need ==1 && !is_admin($admin)){
			nuke_set_cookie("sendtoconfirm_".$ctable."","1",'');
		}
		Header("Location: ".$Req_URI."");
	}
}

switch($comop) {

	case "sendcomment":
		sendcomment($xanonpost, $cfname, $comment, $replay, $security_code, $security_code_id);
	break;

	default:
		display_comments($tid, $classtyp);
	break;

}
}
?>