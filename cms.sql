-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 11, 2015 at 02:30 PM
-- Server version: 5.6.21
-- PHP Version: 5.5.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `cms`
--

-- --------------------------------------------------------

--
-- Table structure for table `article_type`
--

CREATE TABLE IF NOT EXISTS `article_type` (
`id` int(11) NOT NULL,
  `title` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `page` varchar(35) COLLATE utf8_unicode_ci NOT NULL,
  `src_img` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `speaking_URL` varchar(200) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `article_type`
--

INSERT INTO `article_type` (`id`, `title`, `content`, `page`, `src_img`, `speaking_URL`) VALUES
(1, 'Contact', '<p><span style="color: #1a1a1a; font-family: OpenSansRegular, sans-serif; font-size: 15px; line-height: 24px; text-align: justify;">Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur?</span></p>', 'home', '20141218134914Desert.jpg', 'contact-1'),
(2, 'A CLEAN WELCOME', '<p style="box-sizing: border-box; margin: 0px 0px 14px; text-align: justify; color: #1a1a1a; font-family: OpenSansRegular, sans-serif; font-size: 15px; line-height: 24px;">Cleanall Environmental Services limited was specifically incorporated to meet the environmental challenges and prevent marine pollution.</p>\r\n<p style="box-sizing: border-box; margin: 0px 0px 14px; text-align: justify; color: #1a1a1a; font-family: OpenSansRegular, sans-serif; font-size: 15px; line-height: 24px;">As providers of integrated environmental solutions in the maritime sector, the company initiated public private sector partnership for management of pollution in 2001 at the Nigerian Ports Authority. With the seeming agitation for a cleaner environment and proper management of waste generated from vessels at the Nigerian coastal waters, the company capitalized on existing local and international regulations promulgated by International Maritime Organization to drive its various projects.</p>', 'home', '20141216224444Desert.jpg', 'a-clean-welcome-2'),
(4, 'A CLEAN WELCOME', '<p style="box-sizing: border-box; margin: 0px 0px 14px; text-align: justify; color: #1a1a1a; font-family: OpenSansRegular, sans-serif; font-size: 15px; line-height: 24px;">Cleanall Environmental Services limited was specifically incorporated to meet the environmental challenges and prevent marine pollution.</p>\r\n<p style="box-sizing: border-box; margin: 0px 0px 14px; text-align: justify; color: #1a1a1a; font-family: OpenSansRegular, sans-serif; font-size: 15px; line-height: 24px;">As providers of integrated environmental solutions in the maritime sector, the company initiated public private sector partnership for management of pollution in 2001 at the Nigerian Ports Authority. With the seeming agitation for a cleaner environment and proper management of waste generated from vessels at the Nigerian coastal waters, the company capitalized on existing local and international regulations promulgated by International Maritime Organization to drive its various projects.</p>\r\n<p style="box-sizing: border-box; margin: 0px 0px 14px; text-align: justify; color: #1a1a1a; font-family: OpenSansRegular, sans-serif; font-size: 15px; line-height: 24px;">&nbsp;</p>\r\n<p style="box-sizing: border-box; margin: 0px 0px 14px; text-align: justify; color: #1a1a1a; font-family: OpenSansRegular, sans-serif; font-size: 15px; line-height: 24px;">Cleanall Environmental Services limited was specifically incorporated to meet the environmental challenges and prevent marine pollution.</p>\r\n<p style="box-sizing: border-box; margin: 0px 0px 14px; text-align: justify; color: #1a1a1a; font-family: OpenSansRegular, sans-serif; font-size: 15px; line-height: 24px;">As providers of integrated environmental solutions in the maritime sector, the company initiated public private sector partnership for management of pollution in 2001 at the Nigerian Ports Authority. With the seeming agitation for a cleaner environment and proper management of waste generated from vessels at the Nigerian coastal waters, the company capitalized on existing local and international regulations promulgated by International Maritime Organization to drive its various projects.</p>', 'about_us', '20141217000537Tulips.jpg', 'a-clean-welcome-4'),
(5, 'A CLEAN WELCOME', '<p>Extended paragraph. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod&nbsp;</p>\r\n<p>tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud&nbsp;</p>\r\n<p>exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in&nbsp;</p>\r\n<p>reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint&nbsp;</p>\r\n<p>occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>', 'about_us', '20141217002013Jellyfish.jpg', 'a-clean-welcome-5'),
(12, 'A CLEAN WELCOME', '<p>The PHP web team are delighted to announce the launch of the new web theme that has been in beta for many months. Lots of hard work has gone into this release and we will be continually improving things over time now that we have migrated away from the legacy theme.</p>\r\n<p>&nbsp;</p>\r\n<p>From an aesthetics point of view the general color scheme of the website has been lightened from the older dark purple. Lots of borders and links use a similar purple color to attain consistency. Fonts are smoother, and colors, contrast and highlighting have significantly improved; especially on function reference pages. Code examples should now be much more readable.</p>\r\n<p>&nbsp;</p>\r\n<p>The theme is marked up using HTML5 and is generally much more modern. We are using Google Fonts and Bootstrap for our theme base.</p>', 'home', '20141217231254Lighthouse.jpg', 'a-clean-welcome-12'),
(13, 'A CLEAN WELCOME', '<p>We are continuing to work through the repercussions of the php.net malware issue described in a news post earlier today. As part of this, the php.net systems team have audited every server operated by php.net, and have found that two servers were compromised: the server which hosted the www.php.net, static.php.net and git.php.net domains, and was previously suspected based on the JavaScript malware, and the server hosting bugs.php.net. The method by which these servers were compromised is unknown at this time.</p>\r\n<p>&nbsp;</p>\r\n<p>All affected services have been migrated off those servers. We have verified that our Git repository was not compromised, and it remains in read only mode as services are brought back up in full.</p>\r\n<p>&nbsp;</p>\r\n<p>As it s possible that the attackers may have accessed the private key of the php.net SSL certificate, we have revoked it immediately. We are in the process of getting a new certificate, and expect to restore access to php.net sites that require SSL (including bugs.php.net and wiki.php.net) in the next few hours.</p>\r\n<p>&nbsp;</p>\r\n<p>As it s possible that the attackers may have accessed the private key of the php.net SSL certificate, we have revoked it immediately. We are in the process of getting a new certificate, and expect to restore access to php.net sites that require SSL (including bugs.php.net and wiki.php.net) in the next few hours.</p>', 'home', '20150107152508Chrysanthemum.jpg', 'a-clean-welcome-13'),
(22, 'ervin', '<p>er</p>', '', '', 'ervin-22'),
(23, 'erer', '<p>ererre</p>', '', '20150109144501Desert.jpg', 'erer-23');

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE IF NOT EXISTS `contact` (
`id` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(35) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `message` text COLLATE utf8_unicode_ci NOT NULL,
  `date` datetime(6) NOT NULL,
  `viewed` int(4) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`id`, `name`, `phone`, `email`, `message`, `date`, `viewed`) VALUES
(8, 'Róbert', '024/730-977', 'robi@gmail.com', 'Ez egy teszt üznet az adminnak. Ez egy teszt üznet az adminnak. Ez egy teszt üznet az adminnak. Ez egy teszt üznet az adminnak. Ez egy teszt üznet az adminnak. Ez egy teszt üznet az adminnak. Ez egy teszt üznet az adminnak. Ez egy teszt üznet az adminnak. Ez egy teszt üznet az adminnak. Ez egy teszt üznet az adminnak. Ez egy teszt üznet az adminnak. Ez egy teszt üznet az adminnak. Ez egy teszt üznet az adminnak. Ez egy teszt üznet az adminnak. ', '2014-12-24 13:50:54.000000', 1),
(11, 'Ervin', '064-352-0011', 'ervin.toth@gmail.com', 'Ezt egy teszt üzenet az admin számára! Ezt egy teszt üzenet az admin számára! Ezt egy teszt üzenet az admin számára! Ezt egy teszt üzenet az admin számára! Ezt egy teszt üzenet az admin számára! Ezt egy teszt üzenet az admin számára!', '2015-01-05 22:29:11.000000', 0),
(12, 'Ervin', 'ertert', 'erv@gmail.com', 'ertret', '2015-01-06 11:43:46.000000', 1);

-- --------------------------------------------------------

--
-- Table structure for table `header_rotator`
--

CREATE TABLE IF NOT EXISTS `header_rotator` (
`id` int(11) NOT NULL,
  `name` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `img` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `header_rotator`
--

INSERT INTO `header_rotator` (`id`, `name`, `img`) VALUES
(3, 'Penguins', '20150106085817Penguins.jpg'),
(4, 'Tulips', '20150106085849Tulips.jpg'),
(8, 'proba', '20150106112236Desert.jpg'),
(9, 'kep11', '20150108215052Jellyfish.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE IF NOT EXISTS `login` (
`id` int(11) NOT NULL,
  `username` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `passwd` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `user_right` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `date` datetime(6) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`id`, `username`, `email`, `passwd`, `user_right`, `date`) VALUES
(1, 'admin', 'admin@gmail.com', '21232f297a57a5a743894a0e4a801fc3', 'admin', '2015-01-10 00:06:55.000000'),
(2, 'Róbert Tóth', 'laci@gmail.com', 'ae8f9036644b8a0a05d8e5ec504e7ad8', 'user', '0000-00-00 00:00:00.000000'),
(5, 'Beáta', 'bea@gmail.com', 'c7d0b218c69e9357718a1b6ed7a0c17b', 'user', '0000-00-00 00:00:00.000000'),
(6, 'Ágnes', 'agi@gmail.com', '370790335a0538fc3fc5a7b522b050de', 'user', '0000-00-00 00:00:00.000000');

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE IF NOT EXISTS `news` (
`id` int(11) NOT NULL,
  `author` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `src_img` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `date` datetime(6) NOT NULL,
  `status` int(10) NOT NULL,
  `speaking_URL` varchar(200) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`id`, `author`, `title`, `content`, `src_img`, `date`, `status`, `speaking_URL`) VALUES
(9, 'Tóth Ervin', 'MINDEN, AMIT IDÉN ÉRDEMES TUDNI A LINUXRÓL', '<p>A legkev&eacute;sb&eacute; sem reprezentat&iacute;v, &aacute;tlagos sz&aacute;m&iacute;t&oacute;g&eacute;p-felhaszn&aacute;l&oacute;k k&ouml;r&eacute;ben v&eacute;gzett felm&eacute;r&eacute;s&uuml;nk szerint m&eacute;g mindig akadnak j&oacute; n&eacute;h&aacute;nyan, akik szerint a Linux valami bonyolult rendszer, ahol parancssorokba g&eacute;pel a t&uacute;lk&eacute;pzett egyetemista. Pedig ha valaki megn&eacute;zi a manaps&aacute;g aktu&aacute;lis Linux disztrib&uacute;ci&oacute;kat, a Windowshoz m&eacute;rhető grafikus felhaszn&aacute;l&oacute;i fel&uuml;lettel, kiterjedt funkcionalit&aacute;ssal tal&aacute;lkozhat, r&aacute;ad&aacute;sul a parancssorba p&ouml;ty&ouml;g&eacute;stől is j&oacute;val egyszerűbb&eacute; &eacute;s felhaszn&aacute;l&oacute;bar&aacute;tabb&aacute; v&aacute;lt a kezel&eacute;s.</p>\r\n<p>&nbsp;</p>\r\n<p>De pontosan kik is haszn&aacute;lnak manaps&aacute;g Linuxot? Melyek a legfontosabb disztrib&uacute;ci&oacute;k? Azt h&aacute;nyan tudj&aacute;k, hogy az okostelefonokon &eacute;s tableteken h&oacute;d&iacute;t&oacute; Android is Linux alapokra &eacute;p&uuml;l? A Pingdom &aacute;ltal k&eacute;sz&iacute;tett infografik&aacute;b&oacute;l kider&uuml;l, mi &uacute;js&aacute;g mostan&aacute;ban a "pingvines oper&aacute;ci&oacute;s rendszerrel".</p>', '20141218150247linux.jpg', '2014-12-18 14:30:29.000000', 1, 'minden-amit-iden-erdemes-tudni-a-linuxrol-9'),
(10, 'Tóth Ervin', 'Kipróbáltuk a Windows 10-et', '<p>Tegnap este a Microsoft bemutatta a Windows 10-et, amely a Windows 8 halad&oacute; szellemis&eacute;g&eacute;t &ouml;tv&ouml;zi a Windows 7 bev&aacute;lt funkci&oacute;ival. Azt m&eacute;g nem lehet tudni, hogy pontosan mikor jelenik meg, &eacute;s, hogy t&eacute;nyleg ingyenes lesz-e, ugyanakkor a v&aacute;llalkoz&oacute; kedvűek m&aacute;r most kipr&oacute;b&aacute;lhatj&aacute;k a Technical Preview nevű előzetest. Persze azt nem szabad elfelejteni, hogy ez messze nem a v&eacute;gleges v&aacute;ltozat - akadnak benne hib&aacute;k. A Microsoft az eddigi legny&iacute;ltabban akar egy&uuml;ttműk&ouml;dni a felhaszn&aacute;l&oacute;kkal, &iacute;gy a j&ouml;vő &eacute;v k&ouml;zep&eacute;n v&aacute;rhat&oacute; megjelen&eacute;sig m&eacute;g nagyon sokat v&aacute;ltozhat a Windows 10.&nbsp;</p>\r\n<p>Mi m&aacute;r nagyon k&iacute;v&aacute;ncsiak voltunk a Windows 10-re, ez&eacute;rt amint el&eacute;rhető lett, m&aacute;ris kipr&oacute;b&aacute;ltuk az előzetes&eacute;t. Az &uacute;jdons&aacute;gok k&ouml;z&ouml;tt olyan dolgokat n&eacute;zt&uuml;nk meg, mint a meg&uacute;jult Start men&uuml;, a virtu&aacute;lis asztalok, az Alt + Tab funkci&oacute;, az ablakrendez&eacute;si opci&oacute; vagy &eacute;ppen az ablakban fut&oacute; appok.&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<h3><strong>A m&aacute;gikus Start men&uuml;</strong></h3>\r\n<p>Igazs&aacute;g szerint a Start men&uuml; hi&aacute;ny&aacute;t mindig is t&uacute;llihegt&eacute;k a Windows 8-ban &eacute;s 8.1-ben. Elv&eacute;gre nem csak, hogy harmadik f&eacute;ltől sz&aacute;rmaz&oacute; programokkal p&oacute;tolhat&oacute;, de egy dokkol&oacute;program &eacute;s/vagy egy T&aacute;lc&aacute;ra tett Eszk&ouml;zt&aacute;r ut&aacute;n soha t&ouml;bb&eacute; nem is hi&aacute;nyzik majd. Az elm&uacute;lt &eacute;vek alapj&aacute;n m&eacute;gis &uacute;gy tűnik, e k&ouml;r&uuml;l forog a windowsos vil&aacute;g, h&aacute;t a Windows 10-ben visszat&eacute;rt.&nbsp;</p>', '20141218144835images.jpg', '2014-12-18 14:48:35.000000', 1, 'kiprobaltuk-a-windows-10-et-10'),
(11, 'Tóth Ervin', 'Februárban jön az új Android', '<p>Jelen az 5.0.1-es a legfrissebb Android verzi&oacute;, ami kisebb jav&iacute;t&aacute;sokat tartalmaz az alap 5-0-hoz k&eacute;pest, a h&iacute;rek szerint azonban egy komolyabb r&aacute;ncfelvarr&aacute;s v&aacute;rhat&oacute; a k&ouml;zelj&ouml;vőben.</p>\r\n<p>Az &uacute;j verzi&oacute; 5.0.2 helyett m&aacute;r egyből az 5.1-es sz&aacute;mot fogja kapni, ami j&oacute;l jelzi a v&aacute;ltoztat&aacute;sok, &uacute;j&iacute;t&aacute;sok nagys&aacute;g&aacute;t. Maga a Lollipop elnevez&eacute;s persze nem v&aacute;ltozik, azaz &uacute;gy kell elk&eacute;pzelni az eg&eacute;szet, mint a Jelly Bean eset&eacute;ben, aminek a sz&aacute;moz&aacute;sa 4.1-től eg&eacute;szen 4.3-ig tartott.</p>\r\n<p>A k&ouml;vetkező fejleszt&eacute;sek v&aacute;rhat&oacute;k: lesz n&eacute;ma m&oacute;d (ez kimaradt az 5.0-b&oacute;l), nagyobb stabilit&aacute;s, tov&aacute;bbfejlesztett RAM-menedzsment, alkalmaz&aacute;sle&aacute;ll&aacute;sok jav&iacute;t&aacute;sa, jobb akkumul&aacute;tor menedzsment, Wifi hib&aacute;k kik&uuml;sz&ouml;b&ouml;l&eacute;se, &eacute;rtes&iacute;t&eacute;si hib&aacute;k jav&iacute;t&aacute;sa, stb.</p>\r\n<p>Hivatalos inform&aacute;ci&oacute;k ugyan m&eacute;g nincsenek az Android 5.1-ről, azaz semmi biztosat nem tudunk, de egyes h&iacute;rek szerint m&aacute;r febru&aacute;rban j&ouml;het a robotos rendszer &uacute;j verzi&oacute;ja.</p>', '20141218150020mp-lol.jpg', '2014-12-18 15:00:20.000000', 1, 'februarban-jon-az-uj-android-11'),
(12, 'Tóth Ervin', 'A Földmegfigyelő', '<h3><em><strong>Radarokr&oacute;l k&ouml;z&eacute;rthetően</strong></em></h3>\r\n<p>&nbsp;</p>\r\n<p>Az ember vizu&aacute;lis l&eacute;ny, legfontosabb &eacute;rz&eacute;kel&eacute;si m&oacute;dja a l&aacute;t&aacute;s. Tal&aacute;n &eacute;ppen ez&eacute;rt, azokat a dolgokat a legnehezebb ismertetni, amelyek l&aacute;thatatlanul mennek v&eacute;gbe. A radarberendez&eacute;ssel t&ouml;rt&eacute;nő "f&eacute;nyk&eacute;pez&eacute;s" olyan elektrom&aacute;gneses hull&aacute;mok seg&iacute;ts&eacute;g&eacute;vel alkot k&eacute;pet objektumokr&oacute;l, amelyek az ember sz&aacute;m&aacute;ra nem &eacute;rz&eacute;kelhetők. A mikrohull&aacute;m seg&iacute;ts&eacute;g&eacute;vel t&ouml;rt&eacute;nő lek&eacute;pez&eacute;s k&ouml;nnyebb megismer&eacute;se &eacute;rdek&eacute;ben tekints&uuml;k &aacute;t leegyszerűs&iacute;tve a hagyom&aacute;nyos digit&aacute;lis f&eacute;nyk&eacute;pez&eacute;s alapj&aacute;t.</p>\r\n<p>&nbsp;</p>\r\n<p>A legelterjedtebb sz&iacute;nes digit&aacute;lis k&eacute;pr&ouml;gz&iacute;t&eacute;si elj&aacute;r&aacute;sban a k&eacute;p&eacute;rz&eacute;kelő elemi r&eacute;szeiből legal&aacute;bb h&aacute;romf&eacute;le tal&aacute;lhat&oacute; az &eacute;rz&eacute;kelőlapon: az egyik a v&ouml;r&ouml;sre, a m&aacute;sik a z&ouml;ldre, a harmadik pedig a k&eacute;kre van &eacute;rz&eacute;keny&iacute;tve. Az elemi k&eacute;ppont ezekből &eacute;p&uuml;l fel, ebből a h&aacute;rom sz&iacute;nből kikeverve adja meg a pixel sz&iacute;n&eacute;t. Mivel a h&aacute;rom r&eacute;szadat h&aacute;rom k&uuml;l&ouml;nb&ouml;ző ponton k&eacute;pződ&ouml;tt le (legyenek azok szorosan egym&aacute;s k&ouml;zel&eacute;ben, vagy egym&aacute;s alatt), az elektromos jelet digit&aacute;lis jell&eacute; alak&iacute;t&oacute; rendszer is k&uuml;l&ouml;n kezeli őket, sőt a sz&aacute;m&iacute;t&oacute;g&eacute;p&uuml;nk&ouml;n is h&aacute;rom k&uuml;l&ouml;nb&ouml;ző csatorn&aacute;n t&aacute;rol&oacute;dnak el.</p>\r\n<p>&nbsp;</p>\r\n<p>A sz&aacute;m&iacute;t&oacute;g&eacute;p&uuml;nk monitora adott k&eacute;pter&uuml;let sz&iacute;n&aacute;rnyalat&aacute;t ugyancsak a h&aacute;rom csatorn&aacute;n elt&aacute;rolt sz&iacute;n&eacute;rt&eacute;kekből keveri ki, &iacute;gy a kommersz k&eacute;pmegjelen&iacute;tő szoftverek t&ouml;bbs&eacute;g&eacute;t a h&aacute;romcsatorn&aacute;s, csatorn&aacute;nk&eacute;nt 8 bites (egy&uuml;ttesen 24 bit) k&eacute;pek kezel&eacute;s&eacute;re dolgozt&aacute;k ki. Az adott pixelekhez teh&aacute;t h&aacute;rom f&eacute;nyerő&eacute;rt&eacute;keket t&aacute;rol&oacute; csatorna adatait rendelik a szoftverek, ami sz&iacute;nes k&eacute;p eset&eacute;ben v&ouml;r&ouml;s, z&ouml;ld &eacute;s k&eacute;k csatorn&aacute;t, fekete feh&eacute;r k&eacute;p eset&eacute;ben egy sz&uuml;rke&aacute;rnyalatos csatorn&aacute;t jelent. A sz&uuml;rke&aacute;rnyalatos k&eacute;pek minden k&eacute;ppontja f&eacute;nyerő&eacute;rt&eacute;kkel rendelkezik, amely 0-t&oacute;l (fekete) 255-ig (feh&eacute;r) terjedhet. 16 &eacute;s 32 bites k&eacute;peken a sz&iacute;n&aacute;rnyalatok sz&aacute;ma jelentősen nagyobb, mint a 8 bites k&eacute;peken. B&aacute;r a fekete-feh&eacute;r k&eacute;p teljes eg&eacute;sz&eacute;ben elt&aacute;rolhat&oacute; egyetlen csatorn&aacute;n, vannak olyan k&eacute;pmegjelen&iacute;tő szoftverek, amelyek kiz&aacute;r&oacute;lag a h&aacute;romcsatorn&aacute;s k&eacute;peket k&eacute;pesek &eacute;rtelmezni, ez&eacute;rt sokszor RGB-sz&iacute;nm&oacute;dban, h&aacute;rom csatorn&aacute;n t&aacute;rolj&aacute;k őket, ahol mind a h&aacute;rom csatorna azonos, sz&uuml;rke&aacute;rnyalatos f&eacute;nyerő&eacute;rt&eacute;keket hordoz. Ez term&eacute;szetesen felesleges t&aacute;rol&oacute;hely-kapacit&aacute;s foglal&aacute;s&aacute;hoz vezet, de nagyobb kompatibilit&aacute;st biztos&iacute;t.</p>', '20150105135108TDXFormation.jpg', '2015-01-05 13:51:08.000000', 1, 'a-foldmegfigyelo-12');

-- --------------------------------------------------------

--
-- Table structure for table `newsletter`
--

CREATE TABLE IF NOT EXISTS `newsletter` (
`id` int(11) NOT NULL,
  `name` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `newsletter`
--

INSERT INTO `newsletter` (`id`, `name`, `email`) VALUES
(16, 'ervin', 'ervin.toth@gmail.com'),
(17, 'arpad', 'arpad@gmail.com'),
(21, 'Lóri', 'lori@gmail.com'),
(22, 'user', 'user@gmail.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `article_type`
--
ALTER TABLE `article_type`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `header_rotator`
--
ALTER TABLE `header_rotator`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `newsletter`
--
ALTER TABLE `newsletter`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `article_type`
--
ALTER TABLE `article_type`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `header_rotator`
--
ALTER TABLE `header_rotator`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `newsletter`
--
ALTER TABLE `newsletter`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=23;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
