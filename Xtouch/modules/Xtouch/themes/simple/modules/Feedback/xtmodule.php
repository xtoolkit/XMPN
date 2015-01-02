<?php
function xform_block() {
global $message, $module_name, $sender_emaile, $sender_name, $gfx_chk, $sitename, $subject, $fbrseccode, $align, $db, $prefix, $feedback_config, $cookie;
	if($align == "rtl"){
		$align2="right";
	}else{
		$align2="left";
	}
	$cookie[0] = intval($cookie[0]);
	if (!empty($cookie[1])) {
		$row = $db->sql_fetchrow($db->sql_query("SELECT name, username, user_email FROM ".$prefix."_users WHERE user_id='$cookie[0]'"));
		if (!empty($row['name'])) {
			$sender_name = stripslashes($row['name']);
		} else {
			$sender_name = stripslashes($row['username']);
		}
			$sender_emaile = stripslashes($row['user_email']);
	}
	?><div class="xnotify"><?php echo _FEEDBACKTITLE; ?></div><?php
	echo "<form name=\"feedback\">";
		?><div class="xnotify"><?php echo _FEEDBACKNOTE; ?></div><div class="feedbackbox">
<script type="text/javascript">
function GetXmlHttpObject()
{
var xmlHttp=null;
try
  {
  // Firefox, Opera 8.0+, Safari
  xmlHttp=new XMLHttpRequest();
  }
catch (e)
  {
  // Internet Explorer
  try
    {
    xmlHttp=new ActiveXObject("Msxml2.XMLHTTP");
    }
  catch (e)
    {
    xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
    }
  }
return xmlHttp;
}
var xmlHttp = new GetXmlHttpObject();

function answer()
{
if(xmlHttp.readyState==4)
    {
        document.getElementById("mj").innerHTML =xmlHttp.responseText;
        randNum();
    }
else{
		document.getElementById("mj").innerHTML='<img src="images/loader.gif">';
	}
}
function sendCode()
{
var param="";
var sender_name = document.getElementById("sender_name").value;
var sender_emaile = document.getElementById("sender_emaile").value;
var subject = document.getElementById("subject").value;
var message = document.getElementById("message").value;
var security_code=document.feedback.security_code.value;
var security_code_id=document.feedback.security_code_id.value;
//var fbrsecured = document.getElementById("fbrsecured").value;
var responsibility = document.getElementById("responsibility").value;

if(sender_name=="" || sender_emaile=="" || subject=="" || message=="" || security_code=="")
{ 
 alert("تمامي موارد را تکميل نمائيد");
}else{
	param += "sender_name="+sender_name+"&sender_emaile="+sender_emaile+"&subject="+subject+"&message="+message+"&security_code="+security_code+"&responsibility="+responsibility+"&security_code_id="+security_code_id;
	xmlHttp.open("POST","modules.php?name=Feedback&action=xresponse",true);
	xmlHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xmlHttp.setRequestHeader("Content-length", param.length);
	xmlHttp.setRequestHeader("Connection", "close");
	xmlHttp.onreadystatechange=answer;
	xmlHttp.send(param);
	}
}
</script><?php
	echo"<label for=\"sender_name\">"._YOURNAME."<input type=\"text\" name=\"sender_name\" id=\"sender_name\" value=\"$sender_name\" size=\"30\"></label>";
	echo "<label for=\"sender_emaile\">"._YOUREMAIL."<input type=\"text\" name=\"sender_emaile\" id=\"sender_emaile\" value=\"$sender_emaile\" size=\"30\"></label>";
	echo "<label for=\"subject\">"._SUBJECT."<input type=\"text\" name=\"subject\" id=\"subject\" value=\"$subject\" size=\"30\"></label>";
	if($feedback_config['deptson'] == 1){
	echo "<label for=\"responsibility\">"._CONTACT_TO."<select name=\"responsibility\" id=\"responsibility\"><option value=\"0\">"._DEFAULT."</option>";
	$result = $db->sql_query("SELECT * FROM ".$prefix."_feedback_depts ORDER BY did ASC");
	while ($row = $db->sql_fetchrow($result)) {
		$did = intval($row['did']);
		$dname = filter($row['dname'], "nohtml");
		$dresponsibility = filter($row['dresponsibility'], "nohtml");
		echo "<option value=\"$did\">$dname $dresponsibility</option>";
	}
	echo"</select></label>";
	}else{
		echo"<input type=\"hidden\" value=\"0\" name=\"responsibility\" id=\"responsibility\" />";
	}
	echo "<label for=\"message\">"._MESSAGE."<textarea name=\"message\" id=\"message\" cols=\"80\" rows=\"20\" wrap=\"virtual\" >$message</textarea></label>";

	 if (extension_loaded("gd") && defined("SEC_CODE")) {
?><div class="xnotify"><?php echo ""._TYPESECCODE.""; ?></div><?php
	echo "<p>";
	$codepasss = makePass("feed");
	echo "$codepasss</p>";
	}
	echo "<input name=\"action\" type=\"hidden\" value=\"FBSend\">\n";
	echo "<input class=\"submit\" type=\"button\" name=\"submit\" onClick=\"sendCode()\" value=\""._SEND."\">";
	?><div class="xnotify" id="mj">><?php echo _ALLFIELDSREQUIRED; ?></div><?php
	echo "</div></form>";
}
function xcheck_email_address($sender_emaile) {
	if (!@ereg("^[^@]{1,64}@[^@]{1,255}$", $sender_emaile)) {
		return false;
	}
	$email_array = explode("@", $sender_emaile);
	$local_array = explode(".", $email_array[0]);
	for ($i = 0; $i < sizeof($local_array); $i++) {
		if (!@ereg("^(([A-Za-z0-9!#$%&'*+/=?^_`{|}~-][A-Za-z0-9!#$%&'*+/=?^_`{|}~\.-]{0,63})|(\"[^(\\|\")]{0,62}\"))$", $local_array[$i])) {
			return false;
		}
	}
	if (!@ereg("^\[?[0-9\.]+\]?$", $email_array[1])) {
		$domain_array = explode(".", $email_array[1]);
		if (sizeof($domain_array) < 2) {
			return false;
		}
		for ($i = 0; $i < sizeof($domain_array); $i++) {
			if (!@ereg("^(([A-Za-z0-9][A-Za-z0-9-]{0,61}[A-Za-z0-9])|([A-Za-z0-9]+))$", $domain_array[$i])) {
				return false;
			}
		}
	}
	return true;
}

function xtmodule($action){
	global $db, $prefix, $nukeurl;
$configresult = $db->sql_query("SELECT * FROM ".$prefix."_feedback_config");
while (list($config_name, $config_value) = $db->sql_fetchrow($configresult)) {
    $feedback_config[$config_name] = $config_value;
}
define('NO_EDITOR', TRUE);
define('SEC_CODE', TRUE);
switch ($action) {
	case"FBRSecure":
		xfbrsecure();
	break;
	default:
		xform_block();
	break;

}
}
?>