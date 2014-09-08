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
$db->sql_query("CREATE TABLE IF NOT EXISTS `".$prefix."_xmenu` (
  `xmid` int(11) NOT NULL AUTO_INCREMENT,
  `xid` int(11) NOT NULL,
  `xmsub` text NOT NULL,
  `xmclass` text NOT NULL,
  `xmtitle` text NOT NULL,
  `xmlink` text NOT NULL,
  PRIMARY KEY (`xmid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=14 ;");

$db->sql_query("INSERT INTO `".$prefix."_xmenu` (`xmid`, `xid`, `xmsub`, `xmclass`, `xmtitle`, `xmlink`) VALUES
(1, 0, 'ulmenu', 'hmenu1', 'منو آزمایشی برای هدر', 'mheadup'),
(2, 1, '0', 'iconh', 'صفحه اصلی', ''),
(3, 1, '0', 'iconf', 'تالار گفتمان', 'Forum/'),
(4, 1, '0', 'iconu', 'تنظیمات کاربری', 'users/'),
(6, 1, '0', '', 'دیگر', '#'),
(7, 1, '0', 'iconc', 'ارتباط با ما', 'feedback/'),
(8, 1, '6', 'iconn', 'اخبار', 'News/'),
(9, 1, '8', 'icont', 'موضوعات', 'topics/'),
(10, 1, '9', '', 'موضوع اول', 'topics/1/'),
(11, 1, '9', '', 'موضوع دوم', 'topics/2/'),
(12, 1, '9', '', 'آرشیو', 'archive/'),
(13, 1, '6', '', 'مقالات', 'content/');");

OpenTable();
echo "<center>با تشکر از صبر و تحمل شما ، دیتابیس تزریق شد.<br />
حال فایل Installxmenu.php رو از روت سایت خود حذف نمائید.
</center>";
CloseTable();
}else {
OpenTable();
echo "<center>شما مدیر سایت نیستید . ابتدا وارد مدیریت شوید.</center>";
CloseTable();
}
include("footer.php");
?>