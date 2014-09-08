<?php
function checksubxm($nuim){
global $prefix, $db, $dbname;
$nuim=intval($nuim);
$numrow = $db->sql_numrows($db->sql_query("SELECT *
FROM `" . $prefix . "_xmenu`
WHERE `xmsub` LIKE '$nuim'
LIMIT 0 , 30"));
return $numrow;
}
function vxmenu1($nuims, $xmenu, $xmoption){
global $prefix, $db, $dbname;
$nuim=intval($nuim);
$xmenu=intval($xmenu);
if(isset($xmoption['mulc'])){$mulc=$xmoption['mulc'];}
if(isset($xmoption['bmul'])){$bmul=$xmoption['bmul'];}
if(isset($xmoption['amul'])){$amul=$xmoption['amul'];}
if(isset($xmoption['bmlisa'])){$bmlisa=$xmoption['bmlisa'];}
if(isset($xmoption['amlisa'])){$amlisa=$xmoption['amlisa'];}
if(isset($xmoption['bmliea'])){$bmliea=$xmoption['bmliea'];}
if(isset($xmoption['amliea'])){$amliea=$xmoption['amliea'];}
$xmreturnz="\n";
if(isset($bmul)){$xmreturnz .="		$bmul\n";}
$xmreturnz .="		<ul";
if(isset($sulc)){ $xmreturnz .=" class=\"$sulc\""; }
$xmreturnz .=">\n";
$result = $db->sql_query("SELECT * FROM `" . $prefix . "_xmenu` WHERE `xid` =$xmenu AND `xmsub` LIKE '$nuims' ORDER BY `" . $prefix . "_xmenu`.`xmid` ASC LIMIT 0 , 30");
	while ($row = $db->sql_fetchrow($result)) {
	mb_internal_encoding('UTF-8');
	$xmid = intval($row['xmid']);
	$xid = intval($row['xid']);
	$xmclass = $row['xmclass'];
	$xmtitle = $row['xmtitle'];
	$xmlink = $row['xmlink'];
$xmreturnz .="			<li>$bmlisa<a";
if($xmlink==""){}else{ $xmreturnz .=" href=\"$xmlink\""; }
if($xmclass==""){}else{ $xmreturnz .=" class=\"$xmclass\""; }
if($xmtitle==""){}else{ $xmreturnz .=" title=\"$xmtitle\""; }
$xmreturnz .=">$amlisa$xmtitle$bmliea</a>$amliea";
if(checksubxm($xmid) > 0){$xmreturnz .=vxmenu1($xmid,$xmenu, $xmoption);}
$xmreturnz .="</li>\n";} 
$xmreturnz .="		</ul>\n";
if(isset($amul)){$xmreturnz .="		$amul\n";}
$xmreturnz .="		";
return $xmreturnz;
}
function vxmenu($nuims, $xmenu, $xmoption){
global $prefix, $db, $dbname;
$nuim=intval($nuim);
$xmenu=intval($xmenu);
if(isset($xmoption['sulc'])){$sulc=$xmoption['sulc'];}
if(isset($xmoption['bscul'])){$bscul=$xmoption['bscul'];}
if(isset($xmoption['ascul'])){$ascul=$xmoption['ascul'];}
if(isset($xmoption['bslisa'])){$bslisa=$xmoption['bslisa'];}
if(isset($xmoption['aslisa'])){$aslisa=$xmoption['aslisa'];}
if(isset($xmoption['bsliea'])){$bsliea=$xmoption['bsliea'];}
if(isset($xmoption['asliea'])){$asliea=$xmoption['asliea'];}
$xmreturnz ="\n";
if(isset($bscul)){$xmreturnz .="	$bscul\n";}
$xmreturnz .="	<ul";
if(isset($sulc)){ $xmreturnz .=" class=\"$sulc\""; }
$xmreturnz .=">\n";
$result = $db->sql_query("SELECT * FROM `" . $prefix . "_xmenu` WHERE `xid` =$xmenu AND `xmsub` LIKE '$nuims' ORDER BY `" . $prefix . "_xmenu`.`xmid` ASC LIMIT 0 , 30");
	while ($row = $db->sql_fetchrow($result)) {
	mb_internal_encoding('UTF-8');
	$xmid = $row['xmid'];
	$xid = $row['xid'];
	$xmclass = $row['xmclass'];
	$xmtitle = $row['xmtitle'];
	$xmlink = $row['xmlink'];
$xmreturnz .="		<li>$bslisa<a";
if($xmlink==""){}else{ $xmreturnz .=" href=\"$xmlink\""; }
if($xmclass==""){}else{ $xmreturnz .=" class=\"$xmclass\""; }
if($xmtitle==""){}else{ $xmreturnz .=" title=\"$xmtitle\""; }
$xmreturnz .=">$aslisa$xmtitle$bsliea</a>$asliea";
if(checksubxm($xmid) > 0){$xmreturnz .=vxmenu1($xmid,$xmenu, $xmoption);}
$xmreturnz .="</li>\n";} 
$xmreturnz .="	</ul>\n	";
if(isset($ascul)){$xmreturnz .="	$ascul\n	";} ?>	<?php
return $xmreturnz;
}
function xmenux($xmenu, $xmoption=''){
global $prefix, $db, $dbname;
if(isset($xmoption['bful'])){$bful=$xmoption['bful'];}
if(isset($xmoption['aful'])){$aful=$xmoption['aful'];}
if(isset($xmoption['bflisa'])){$bflisa=$xmoption['bflisa'];}
if(isset($xmoption['aflisa'])){$aflisa=$xmoption['aflisa'];}
if(isset($xmoption['bfliea'])){$bfliea=$xmoption['bfliea'];}
if(isset($xmoption['afliea'])){$afliea=$xmoption['afliea'];}
$xmenu=intval($xmenu);
$result = $db->sql_query("SELECT * FROM `" . $prefix . "_xmenu` WHERE `xmid` =$xmenu LIMIT 0 , 1");
while ($row = $db->sql_fetchrow($result)) {
mb_internal_encoding('UTF-8');
$ulxmclass = $row['xmclass'];
$ulxmlink = $row['xmlink'];
}
if(isset($bful)){$xmreturnz .="$bful\n";}
$xmreturnz .="<ul";
if($ulxmclass==""){}else{ $xmreturnz .=" class=\"$ulxmclass\""; }
if($ulxmlink==""){}else{ $xmreturnz .=" id=\"$ulxmlink\""; }
$xmreturnz .=">\n";
$result = $db->sql_query("SELECT * FROM `" . $prefix . "_xmenu` WHERE `xid` =$xmenu AND `xmsub` LIKE '0' ORDER BY `" . $prefix . "_xmenu`.`xmid` ASC LIMIT 0 , 30");
	while ($row = $db->sql_fetchrow($result)) {
	mb_internal_encoding('UTF-8');
	$xmid = intval($row['xmid']);
	$xid = intval($row['xid']);
	$xmclass = $row['xmclass'];
	$xmtitle = $row['xmtitle'];
	$xmlink = $row['xmlink'];
$xmreturnz .="	<li>$bflisa<a";
if($xmlink==""){}else{ $xmreturnz .=" href=\"$xmlink\""; }
if($xmclass==""){}else{ $xmreturnz .=" class=\"$xmclass\""; }
if($xmtitle==""){}else{ $xmreturnz .=" title=\"$xmtitle\""; } 
$xmreturnz .=">$aflisa$xmtitle$bfliea</a>$afliea";
if(checksubxm($xmid) > 0){$xmreturnz .=vxmenu($xmid,$xmenu, $xmoption);}
$xmreturnz .="</li>\n";}
$xmreturnz .="</ul>";
if(isset($bful)){$xmreturnz .="\n$aful";}
return $xmreturnz;
}
?>