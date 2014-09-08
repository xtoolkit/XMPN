<?php

/* 
* @package ShoutboxPro
* @version $Id: 1.0 2011-03-18 17:40:12 Nukers.ir [SajjadSalemi] $
* @copyright (c) 2011 Nukers Group http://www.Nukers.ir
* @license http://opensource.org/licenses/gpl-license.php GNU Public License 
*/

require_once("mainfile.php");
global $prefix,$admin, $user_prefix, $db;
include("header.php");
if (is_admin($admin)) {
$db->sql_query("CREATE TABLE IF NOT EXISTS `".$prefix."_xdisqus` (
  `xsid` int(11) NOT NULL AUTO_INCREMENT,
  `xsname` text NOT NULL,
  `xsvalue` text NOT NULL,
  PRIMARY KEY (`xsid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;");
$db->sql_query("INSERT INTO `".$prefix."_xdisqus` (`xsid`, `xsname`, `xsvalue`) VALUES
(1, 'xstrue', '0'),
(2, 'xssn', '');");
OpenTable();
echo "<center>با تشکر از صبر و تحمل شما ، دیتابیس تزریق شد.<br />
حال فایل Installxdisqus.php رو از روت سایت خود حذف نمائید.
</center>";
CloseTable();
}else {
OpenTable();
echo "<center>شما مدیر سایت نیستید . ابتدا وارد مدیریت شوید.</center>";
CloseTable();
}
include("footer.php");
?>