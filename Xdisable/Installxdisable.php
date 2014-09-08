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
$db->sql_query("CREATE TABLE IF NOT EXISTS `".$prefix."_xdisable` (
  `xdid` int(11) NOT NULL AUTO_INCREMENT,
  `xdname` text NOT NULL,
  `xdvalue` text NOT NULL,
  PRIMARY KEY (`xdid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=17 ;");

$db->sql_query("INSERT INTO `".$prefix."_xdisable` (`xdid`, `xdname`, `xdvalue`) VALUES
(1, 'xdisable', '0'),
(2, 'xdtheme', 'Webuild'),
(3, 'xdtitle', 'سایت غیر فعال می باشد'),
(4, 'xddes', '<p>با سلام</p><p>به زودی سایت با امکانات جدید بازگشایی خواهد شد.</p><p>با تشکر</p>'),
(5, 'xdyear', '2015'),
(6, 'xdmoon', '8'),
(7, 'xdday', '26'),
(8, 'xdhour', '21'),
(9, 'xdmin', '45'),
(10, 'xdnotify', '0'),
(11, 'xdsfb', 'http://www.facebook.com/test'),
(12, 'xdstt', 'http://twitter.com/test'),
(13, 'xdsgp', 'https://plus.google.com/105230280970104221098'),
(14, 'xdsli', 'http://www.linkedin.com/profile/view?id=testid'),
(15, 'xdtlogo', 'images/nuke.jpg'),
(16, 'xduemail', 'delta.dorna@gmail.com');");

OpenTable();
echo "<center>با تشکر از صبر و تحمل شما ، دیتابیس تزریق شد.<br />
حال فایل Installxdisable.php رو از روت سایت خود حذف نمائید.
</center>";
CloseTable();
}else {
OpenTable();
echo "<center>شما مدیر سایت نیستید . ابتدا وارد مدیریت شوید.</center>";
CloseTable();
}
include("footer.php");
?>