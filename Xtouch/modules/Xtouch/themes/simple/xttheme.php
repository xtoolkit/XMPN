<?php
function xresponse (){
global $sender_name, $gfx_chk, $sender_emaile, $subject, $message, $randnum, $adminmail, $sitename, $security_code, $security_code_id, $db, $prefix, $responsibility, $feedback_config, $align;
	// Checks for Valid Security Code
        if (extension_loaded("gd") && defined("SEC_CODE")) {
			include("includes/captcha/securimage.php");
			$img = new Securimage();
			$valid = $img->check($security_code, $security_code_id);
			if(empty($security_code) || $valid != true) {
				$name_err .= "<span class=\"option\" style=\"font-weight: bold; font-style: italic;\">"._FBINVALIDCODE."</span>\n";
				$send = _NO;
			}
		}
		if (empty($sender_name)) {
			$code_err .= "<span class=\"option\" style=\"font-weight: bold; font-style: italic;\">"._FBENTERNAME."</span>\n";
			$send = _NO;
		}
		if (@eregi("(Content-Type)|(MIME-Version)|(Content-Disposition)|(\\\\n)|(%0A)|(0x0A)|(\\\\r)|(0x0D)|(%0D)|(to:)|(cc:)|(bcc:)", $sender_name)) {
			$name_err .= "<span class=\"option\" style=\"font-weight: bold; font-style: italic;\">"._FBINVALIDNAME."</span>\n";
			$sender_name = "";
			$send = _NO;
		}
		if (empty($sender_emaile)) {
			$email_err .= "<span class=\"option\" style=\"font-weight: bold; font-style: italic;\">"._FBENTEREMAIL."</span>\n";
			$send = _NO;
		}
		if (!check_email_address($sender_emaile)) {
			$email_err .= "<span class=\"option\" style=\"font-weight: bold; font-style: italic;\">"._FBRENTEREMAIL."</span>\n";
			$sender_emaile = "";
			$send = _NO;
		}
		if (empty($subject)) {
			$subject_err .= "<span class=\"option\" style=\"font-weight: bold; font-style: italic;\">"._FBENTERSUBJECT."</span>\n";
			$send = _NO;
		}
		if (@eregi("(Content-Type)|(MIME-Version)|(Content-Disposition)|(\\\\n)|(%0A)|(0x0A)|(\\\\r)|(0x0D)|(%0D)|(to:)|(cc:)|(bcc:)", $subject)) {
			$subject_err .= "<span class=\"option\" style=\"font-weight: bold; font-style: italic;\">"._FBINVALIDSUBJECT."</span>\n";
			$subject = "";
			$send = _NO;
		}
		if (empty($message)) {
			$message_err .= "<span class=\"option\" style=\"font-weight: bold; font-style: italic;\">"._FBENTERMESSAGE."</span>\n";
			$send = _NO;
		}
		if ($send !== _NO) {
			$resultfe = $db->sql_query("SELECT * FROM ".$prefix."_feedback_depts where did='$responsibility'");
			$rowfe = $db->sql_fetchrow($resultfe);
			$dname = filter($rowfe['dname'], "nohtml");
			$demail = filter($rowfe['demail'], "nohtml");
			$dresponsibility = filter($rowfe['dresponsibility'], "nohtml");
			if($responsibility == 0){
				$to = $feedback_config['ademail'];
			}else{
				$to = $demail;
			}
			
			$subject2 = $subject;
			$subject = "$sitename - "._FEEDBACK.": $subject\n";
			$subject = stripslashes(FixQuotes(check_html(removecrlf($subject))));
			$sender_name = stripslashes(FixQuotes(check_html(removecrlf($sender_name))));
			$sender_emaile = stripslashes(FixQuotes(check_html(removecrlf($sender_emaile))));
			$msg  = "$sitename\r\n\r\n";
			$msg .= ""._TO.": $dname $dresponsibility\r\n\r\n";
			$msg .= ""._SENDERNAME.": $sender_name\r\n\r\n";
			$msg .= ""._SENDEREMAIL.": $sender_emaile\r\n\r\n";
			$msg .= ""._SUBJECT.": $subject\r\n\r\n";
			$msg .= ""._MESSAGE.": $message\r\n\r\n";
			global $waiting;
			$waiting = intval($waiting);
			if($waiting != 1){
				if($feedback_config['letreceive'] == 1){
					phpnuke_mail($sender_emaile,$subject,$msg,$adminmail,$sitename);
				}
				phpnuke_mail($to,$subject,$msg,$adminmail,$sitename);
				$result = $db->sql_query("INSERT INTO ".$prefix."_feedbacks VALUE (NULL,'$sender_name','$sender_emaile','$subject2','$message','$responsibility','')");
				///send message with sms to admins or members
				$smsfresult = $db->sql_query("SELECT * FROM ".$prefix."_sms_settings");
				$smsfrows = $db->sql_fetchrow($smsfresult);
				$sabausername = $smsfrows['sabausername'];
				$sabapassword = $smsfrows['sabapassword'];
				$sms_auto_number = $smsfrows['sms_auto_number'];
				$smsadmins  = $smsfrows['smsadmins'];
				$sms_def_title  = $smsfrows['sms_def_title'];
				$smsstatusef = explode(",",$smsfrows['statusef']);
				if(in_array(6, $smsstatusef)){
					require_once('modules/sms/includes/sabapayamak.php');
					$sabapayamak = new sabapayamak($sabausername,$sabapassword);
					$smsadmins = explode(",",$smsadmins);
					foreach($smsadmins as $smsadmin){
						$smsadmin = explode(":",$smsadmin);
						$smsadminnumber[] = $smsadmin[1];
					}
					$smsmessage = "$sms_def_title:\n"._MESSAGE."\n";
					$message = @preg_replace("/<[^>]+\>/i", "", $message); 
					$smsmessage .= substr($message,0,100);
					$smsadminnumber = implode(",",$smsadminnumber);
					$smss = $sabapayamak->Send($sms_auto_number,$smsadminnumber,$smsmessage,0);
				}
				///send message with sms to admins or members
				nuke_set_cookie("waiting","1",time()+600);
				echo ""._FBMAILSENT."</div>\n";
				echo ""._FBTHANKSFORCONTACT."</div>\n";
			}else{
				echo ""._WAITFORTENMIN."\n";
			}
		} elseif ($send == _NO) {
			echo "$code_err\n";
			echo "$name_err\n";
			echo "$email_err\n";
			echo "$subject_err\n";
			echo "$message_err\n";
		}
}

function xclean_pagination($total_rows, $entries_per_page, $current_page, $link_to){
	global $align;
	$total_page = ceil($total_rows / $entries_per_page);
	$str_page  = (strpos($link_to, "?") === false) ? "?page" : "&amp;page";
	$page = $current_page-3;
	$upper =$current_page+3;

	if ($page <=0) {
		$page=1;
	}
	if ($upper >$total_page) {
		$upper =$total_page;
	}

  	if ($upper-$page <6){

		//We know that one of the page has maxed out
		//check which one it is
		//echo "$upper >=$maxPage<br>";
		if ($upper >=$total_page){
			//the upper end has maxed, put more on the front end
			//echo "to begining<br>";
			$dif =$total_page-$page;
			//echo "$dif<br>";
				if ($dif==3){
					$page=$page-3;
				}elseif ($dif==4){
					$page=$page-2;
				}elseif ($dif==5){
					$page=$page-1;
				}
		}elseif ($page <1) {
			//its the low end, add to upper end
			//echo "to upper<br>";
			$dif =$upper-1;

			if ($dif==3){
				$upper=$upper+3;
			}elseif ($dif==4){
				$upper=$upper+2;
			}elseif ($dif==5){
				$upper=$upper+1;
			}
		}
	}	
	if ($page <=0) {
		$page=1;
	}
	if($align == "rtl"){
	$dirrr="right";
	}else{
	$dirrr="left";
	}
 	for($page; $page <=  $upper; $page++) {
		if ($page == $current_page){
			$nav .= "<span class=\"current current-page\" style=\"float:$dirrr\">$page</span>";
		}else{
			$nav .= "<a href=\"$link_to$str_page=$page\" style=\"float:$dirrr\">$page</a>";
		}
	}	  
	if ($current_page > 1){
		$ppage  = $current_page - 1;
		$prev  = "<a href=\"$link_to$str_page=$ppage\" style=\"float:$dirrr\"><</a> ";
		$first = "<a href=\"$link_to\" style=\"float:$dirrr\">«</a> ";
	}else{
		$prev  = "<span class=\"disabled\" style=\"float:$dirrr\"><</span> ";
		$first = "<span class=\"disabled\" style=\"float:$dirrr\">«</span> ";
	}	
	if ($current_page < $total_page AND $upper <= $total_page) {
		$page = $current_page + 1;
		$next = " <a href=\"$link_to$str_page=$page\" style=\"float:$dirrr\">></a>";
		$last = " <a href=\"$link_to$str_page=$total_page\" style=\"float:$dirrr\">»</a>";
	} else {
		$next = " <span class=\"disabled\" style=\"float:$dirrr\">></span>";
		$last = " <span class=\"disabled\" style=\"float:$dirrr\">»</span>";
	}	

	$paginate_links = "<div align=\"center\"><table align=\"center\" border=\"0\"><tr><td align=\"center\">".$first . $prev . $nav . $next . $last."</td></tr></table></div>";
	
if($total_rows != '0'){
  print $paginate_links;
  }
}
function xtcheckboxcheck($value,$value2){
$xbsds=0;
$value=explode(',', $value);
foreach($value as $key){
if($key==$value2){
	$xbsds=1;
	break;
}
}
return $xbsds;
}
function xttheme($xtstitle,$xtxmmenu,$swichers,$xtmodules){
global $db, $prefix, $sitename, $pagetitle, $ThemeSel, $name, $sid, $userinfo, $user_news, $storyhome, $new_topic, $query, $page, $pa, $id_cat, $categories, $id, $action;
$yaroox=$_SERVER['REQUEST_URI'];
if($name=="Feedback"){
if($action=="xresponse"){
xresponse();
die();
}
}
?><!doctype html>
<html>
<?php
		echo "<head>\n";
		echo"<title>$sitename $pagetitle</title>\n";
				@include("includes/meta.php");
		if (file_exists("themes/$ThemeSel/images/favicon.ico")) {
			echo "<link rel=\"shortcut icon\" href=\"themes/$ThemeSel/images/favicon.ico\" type=\"image/x-icon\" />\n";
		}
?>
<link rel="stylesheet" href="modules/Xtouch/themes/simple/style/style.css" type="text/css"/>
<script src="modules/Xtouch/themes/simple/script/tools.js" type="text/javascript"></script>
</head>
<body>
<?php if($xtxmmenu>0){echo xmenux($xtxmmenu);} ?>

<div class="theme">
<div class="bar">
<?php if($xtxmmenu>0){ ?><div class="hide"><div></div><div></div><div></div></div><?php }else{ ?><div class="xhide"></div><?php } ?>
<a href=""><?php echo $xtstitle; ?></a>
<div class="search"></div>
</div>
<form class="searchbox" action="search/" method="post">
<input class="text" type="text" name="query" value=""/>
<input class="submit" type="submit" value="جستجو"/>
</form>
<?php if($name=="News" AND xtcheckboxcheck($xtmodules,"News")==1){
include("modules/Xtouch/themes/simple/modules/News/xtmodule.php");
if(isset($page)){
xtmnews($page);
}elseif($sid){
xtmodule($sid);
}else{
xtmnews($page);
}
}elseif($name=="Search" AND xtcheckboxcheck($xtmodules,"Search")==1){
include("modules/Xtouch/themes/simple/modules/Search/xtmodule.php");
xtmodule($query);
}elseif($name=="Feedback" AND xtcheckboxcheck($xtmodules,"Feedback")==1){
include("modules/Xtouch/themes/simple/modules/Feedback/xtmodule.php");
xtmodule($action);
}elseif($name=="MT-Gallery" AND xtcheckboxcheck($xtmodules,"MT-Gallery")==1){
include("modules/Xtouch/themes/simple/modules/MT-Gallery/xtmodule.php");
if($pa=="ShowGAL"){
xShowGAL($id_cat, $categories);
}elseif($pa=="showpic"){
xshowpic($id);
}else{
xtmodule();
}
}else{
include("modules/Xtouch/themes/simple/modules/News/xtmodule.php");
xtmnews($page);
}
?>
<div class="footer">
<div class="gbackdi"><a href="<?php echo $yaroox; ?>#" class="gbackt">بازگشت با بالا</a></div>
<?php if($swichers==1){ ?><div class="swicher">
<div class="slink slinks">موبایل</div>
<a class="slink" href="?xtouch=0">دستکتاپ</a>
</div><?php } ?>
<div class="copyright">قدرت گرفته توسط<br><a href="#">ماژول تاچ برای نیوک مشهد تیم</a></div>
</div>
</div>
</body>
</html><?php
die();
}
?>