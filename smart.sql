-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2013 年 09 月 04 日 23:21
-- 服务器版本: 5.5.24-log
-- PHP 版本: 5.4.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `smart`
--

-- --------------------------------------------------------

--
-- 表的结构 `area`
--

CREATE TABLE IF NOT EXISTS `area` (
  `area_id` int(11) NOT NULL AUTO_INCREMENT,
  `area_name` varbinary(100) DEFAULT NULL,
  `area_int` int(11) DEFAULT NULL,
  `area_bigint` bigint(20) DEFAULT NULL,
  `area_is_del` bit(1) NOT NULL,
  `area_ins_date` timestamp NULL DEFAULT NULL,
  `area_up_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`area_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=37 ;

--
-- 转存表中的数据 `area`
--

INSERT INTO `area` (`area_id`, `area_name`, `area_int`, `area_bigint`, `area_is_del`, `area_ins_date`, `area_up_date`) VALUES
(7, '2,...,', 17, NULL, b'0', '2038-01-18 19:14:07', '2013-02-23 13:51:03'),
(12, '&lt;&gt;', 0, NULL, b'0', '2038-01-18 19:14:07', '2013-02-17 13:50:17'),
(13, '243234', 20, NULL, b'0', '2038-01-18 19:14:07', '2013-02-17 13:50:06'),
(14, '13456', 2, NULL, b'1', '2038-01-18 19:14:07', '2013-02-17 13:50:28'),
(15, '12345', 19, NULL, b'0', '0000-00-00 00:00:00', '2013-02-21 14:35:15'),
(16, '23233', 14, NULL, b'0', '0000-00-00 00:00:00', '2013-02-21 14:36:41'),
(17, 'sfdsh', 0, NULL, b'0', '2013-02-07 00:23:23', '2013-05-19 08:52:33'),
(18, 'eyhrtyh', 1, NULL, b'1', '2013-02-17 05:45:25', '2013-02-17 13:54:27'),
(19, 't434y', 1, NULL, b'0', '2013-02-17 05:51:57', '2013-02-17 13:51:57'),
(20, '徐松的感谢', 31, NULL, b'1', '2013-02-17 06:33:02', '2013-02-17 14:43:50'),
(21, '&quot;&amp;', 1, NULL, b'1', '2013-02-18 06:47:04', '2013-02-18 14:51:27'),
(22, '23245', 1, NULL, b'1', '2013-02-18 06:48:56', '2013-02-18 14:48:56'),
(23, '&amp;^', 1, NULL, b'1', '2013-02-18 06:52:20', '2013-02-18 14:52:21'),
(24, 'teste', 0, NULL, b'1', '2013-02-20 15:00:39', '2013-02-20 23:00:39'),
(25, '12345', 1, NULL, b'1', '2013-02-23 05:26:38', '2013-02-23 13:26:38'),
(26, 'reerre', 3, NULL, b'1', '2013-02-23 18:31:05', '2013-02-24 02:31:05'),
(27, '123456', 4, NULL, b'1', '2013-02-23 18:31:52', '2013-02-24 02:31:52'),
(28, '4ttet', 21, NULL, b'1', '2013-05-19 00:51:46', '2013-05-19 08:51:46'),
(29, 't443r4', 30, NULL, b'1', '2013-05-19 00:52:06', '2013-05-19 08:52:06'),
(30, 't8p;8', 3, NULL, b'1', '2013-05-19 00:55:53', '2013-05-19 08:55:53'),
(31, 'qwerwqer', 31, NULL, b'1', '2013-05-19 00:56:32', '2013-05-19 08:56:32'),
(32, 'erregre', 1, NULL, b'1', '2013-05-19 01:00:11', '2013-05-19 09:00:11'),
(33, 'thetr', 6, NULL, b'1', '2013-05-19 01:02:37', '2013-05-19 09:02:37'),
(34, 'thetr', 6, NULL, b'0', '2013-05-19 01:02:37', '2013-05-19 09:04:54'),
(35, 'thetr', 6, NULL, b'0', '2013-05-19 01:02:37', '2013-05-19 09:04:28'),
(36, '343252', 3, NULL, b'0', '2013-05-19 01:05:27', '2013-05-19 09:05:27');

-- --------------------------------------------------------

--
-- 表的结构 `book`
--

CREATE TABLE IF NOT EXISTS `book` (
  `book_id` int(11) NOT NULL AUTO_INCREMENT,
  `book_name` varbinary(30) DEFAULT NULL,
  `book_pass` varbinary(44) NOT NULL,
  `book_purview` int(11) NOT NULL DEFAULT '0',
  `book_attention` int(11) DEFAULT NULL,
  `book_is_del` bit(1) NOT NULL,
  `ins_date` mediumtext NOT NULL,
  `up_date` mediumtext NOT NULL,
  PRIMARY KEY (`book_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- 转存表中的数据 `book`
--

INSERT INTO `book` (`book_id`, `book_name`, `book_pass`, `book_purview`, `book_attention`, `book_is_del`, `ins_date`, `up_date`) VALUES
(1, 'doors', '', 0, 15, b'0', '1370268365', '1370353899'),
(2, 'seeks', '', 0, 1, b'0', '1370268457', '1370268457'),
(3, 'abceo', '', 0, 17, b'0', '1370269406', '1370269406'),
(4, 'ccedit', '', 0, 21, b'0', '1370269415', '1370269415'),
(5, 'aaaaa', '', 0, 5, b'0', '1370269431', '1370269431'),
(6, '一地在要工', '', 0, 4, b'0', '1370269441', '1370355548'),
(7, 'ntry4', '', 0, 1, b'0', '1370355534', '1370355534');

-- --------------------------------------------------------

--
-- 表的结构 `ci_sessions`
--

CREATE TABLE IF NOT EXISTS `ci_sessions` (
  `session_id` varchar(40) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT '0',
  `ip_address` varchar(16) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT '0',
  `user_agent` varchar(90) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `last_activity` int(10) unsigned NOT NULL DEFAULT '0',
  `user_data` text CHARACTER SET utf8 COLLATE utf8_bin,
  PRIMARY KEY (`session_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 转存表中的数据 `ci_sessions`
--

INSERT INTO `ci_sessions` (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES
('40abae579b664b4ad09c2616afa310ef38a6b14a', '127.0.0.1', 'Mozilla/5.0 (Windows NT 5.1; rv:24.0) Gecko/20100101 Firefox/24.0', 1377870983, NULL);

-- --------------------------------------------------------

--
-- 表的结构 `client`
--

CREATE TABLE IF NOT EXISTS `client` (
  `client_id` int(11) NOT NULL AUTO_INCREMENT,
  `client_name` varbinary(30) DEFAULT NULL,
  `client_pass` varbinary(44) NOT NULL,
  `client_purview` int(11) NOT NULL DEFAULT '0',
  `client_attention` int(11) DEFAULT NULL,
  `client_is_del` bit(1) NOT NULL,
  `ins_date` timestamp NULL DEFAULT NULL,
  `up_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`client_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=30 ;

--
-- 转存表中的数据 `client`
--

INSERT INTO `client` (`client_id`, `client_name`, `client_pass`, `client_purview`, `client_attention`, `client_is_del`, `ins_date`, `up_date`) VALUES
(1, '12345', '12345688', 0, 21, b'1', '0000-00-00 00:00:00', '2013-05-15 23:21:02'),
(2, '&lt;script&gt;', '123456', 0, 28, b'0', '2013-02-23 19:06:15', '2013-06-03 13:08:48'),
(3, 'abcdre', '123456', 0, 14, b'0', '2013-02-24 15:36:15', '2013-05-02 22:40:16'),
(4, '1qwww', '123456', 0, 10, b'1', '2013-02-24 15:46:47', '2013-05-15 23:19:31'),
(5, 'wewewe', '123456', 0, 1, b'0', '2013-02-24 15:46:52', '2013-05-15 15:02:20'),
(6, 'werwerr3', '123456', 0, 16, b'0', '2013-02-24 15:47:27', '2013-05-15 23:07:50'),
(7, '教材科技时事经济地理', '123456', 0, 13, b'0', '2013-02-28 06:53:54', '2013-05-19 13:21:51'),
(8, '12312', '', 0, 5, b'0', '2013-03-02 19:23:05', '2013-05-15 14:21:41'),
(9, '123123123123', '', 0, 1, b'1', '2013-03-02 19:24:03', '2013-05-14 23:15:36'),
(10, '我是徐松', 'VgBSAlFWAQJSVVAKVQJbVAZXAwZQUgwDAQYOXQAADQU=', 0, 24, b'0', '2013-03-03 02:05:39', '2013-06-01 01:39:23'),
(11, 'hi', '123123', 0, 1, b'1', '0000-00-00 00:00:00', '2013-05-15 14:11:56'),
(12, '12345', '', 0, 0, b'0', '2013-05-15 06:52:25', '2013-05-15 14:52:25'),
(13, '22345', '', 0, 20, b'1', '2013-05-15 06:57:15', '2013-05-16 14:36:30'),
(14, 'eh5dr', '', 0, 0, b'0', '2013-05-15 06:58:57', '2013-05-15 14:58:57'),
(15, '3re33', '', 0, 12, b'1', '2013-05-15 14:48:17', '2013-05-16 14:36:13'),
(16, '&lt;script&gt;', '', 0, 14, b'0', '2013-05-15 14:48:55', '2013-05-19 11:08:50'),
(17, 'ymtmu', '', 0, 18, b'1', '2013-05-15 14:50:56', '2013-05-15 23:19:12'),
(18, 'grth23', '', 0, 6, b'0', '2013-05-16 15:06:56', '2013-05-29 13:17:00'),
(19, 'r34343', '', 0, 3, b'0', '2013-05-18 06:22:08', '2013-05-29 13:17:33'),
(20, 'r3323', '', 0, 0, b'0', '2013-05-18 06:24:31', '2013-05-18 14:24:31'),
(21, '1212ra', '', 0, 0, b'0', '2013-05-18 06:26:35', '2013-05-18 14:26:35'),
(22, 'oouuii', '', 0, 17, b'0', '2013-05-18 22:09:34', '2013-05-19 06:09:34'),
(23, 't43&#39;', '', 0, 2, b'0', '2013-05-19 00:40:06', '2013-05-19 12:45:48'),
(24, 'qwert2', '', 0, 3, b'0', '2013-05-19 00:54:29', '2013-05-19 08:54:29'),
(25, 'asbcx', '', 0, 3, b'0', '2013-05-19 00:55:22', '2013-05-19 08:55:22'),
(26, '&#39;&quot;&#39;&quot;&#39;', '', 0, 3, b'0', '2013-05-19 03:05:23', '2013-05-19 12:39:47'),
(27, 'rthe2', '', 0, 1, b'0', '2013-05-19 06:33:30', '2013-05-19 14:33:30'),
(28, 'kuytt', '', 0, 1, b'0', '2013-05-31 14:08:11', '2013-05-31 22:08:11'),
(29, 'seek_job', '', 0, 1, b'0', '2013-06-03 06:00:52', '2013-06-03 14:00:52');

-- --------------------------------------------------------

--
-- 表的结构 `domains`
--

CREATE TABLE IF NOT EXISTS `domains` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `url` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `registrar` varchar(100) NOT NULL,
  `dateregd` int(11) NOT NULL DEFAULT '0',
  `cost` float NOT NULL DEFAULT '0',
  `regdfor` int(11) NOT NULL DEFAULT '0',
  `notes` blob NOT NULL,
  `pw` varchar(25) NOT NULL,
  `un` varchar(25) NOT NULL,
  `lastupdate` int(11) NOT NULL DEFAULT '0',
  `submit` varchar(25) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

-- --------------------------------------------------------

--
-- 表的结构 `events`
--

CREATE TABLE IF NOT EXISTS `events` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL DEFAULT 'not set',
  `type` enum('test','alert','report') NOT NULL,
  `testid` int(10) NOT NULL,
  `siteid` int(10) NOT NULL,
  `userid` int(10) NOT NULL,
  `reported` int(11) NOT NULL,
  `result` blob NOT NULL,
  `TIME` int(11) NOT NULL,
  `timetaken` float NOT NULL,
  `isalert` varchar(2) NOT NULL,
  `emailid` int(11) NOT NULL,
  `submit` varchar(25) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=69 ;

-- --------------------------------------------------------

--
-- 表的结构 `frequencies`
--

CREATE TABLE IF NOT EXISTS `frequencies` (
  `id` int(10) NOT NULL,
  `name` varchar(16) NOT NULL,
  `submit` varchar(25) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `group`
--

CREATE TABLE IF NOT EXISTS `group` (
  `group_id` int(11) NOT NULL AUTO_INCREMENT,
  `group_name` varbinary(30) NOT NULL,
  `group_pass` varbinary(44) DEFAULT NULL,
  `group_permit` int(11) NOT NULL DEFAULT '0',
  `group_attention` int(11) DEFAULT NULL,
  `group_is_del` bit(1) NOT NULL,
  `group_ins_date` mediumtext NOT NULL,
  `group_up_date` mediumtext NOT NULL,
  PRIMARY KEY (`group_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=40 ;

--
-- 转存表中的数据 `group`
--

INSERT INTO `group` (`group_id`, `group_name`, `group_pass`, `group_permit`, `group_attention`, `group_is_del`, `group_ins_date`, `group_up_date`) VALUES
(1, 'lisp-lang', NULL, 0, 29, b'1', '1371991123', '1372773811'),
(2, 'think in java', NULL, 0, 5, b'1', '1371994890', '1372894382'),
(3, 'fib niii', NULL, 0, 2, b'1', '1371994936', '1375969076'),
(4, 'abcde', NULL, 0, 1, b'1', '1371994991', '1371994991'),
(5, 'ccedit', NULL, 0, 10, b'1', '1371995000', '1371995000'),
(6, 'cnnc1', NULL, 0, 19, b'0', '1371995021', '1378126905'),
(7, 'erlanp', NULL, 0, 9, b'0', '1371997693', '1375884654'),
(8, 'acvbn&amp;gt;', NULL, 0, 22, b'0', '1372115211', '1375500837'),
(9, 'zxcvb', NULL, 0, 0, b'0', '1372115234', '1374449970'),
(10, 'abcqw&gt;', NULL, 0, 23, b'0', '1372117183', '1375886182'),
(11, 'aabbcc&lt;', NULL, 0, 1, b'0', '1372117193', '1376403872'),
(12, 'abc22&lt;&gt;', NULL, 0, 2, b'0', '1372117273', '1374408586'),
(13, 'awerty&#39;', NULL, 0, 30, b'0', '1372117292', '1375500012'),
(14, '43t342&quot;', NULL, 0, 2, b'0', '1372117409', '1375530864'),
(15, 'drerr', NULL, 0, 6, b'1', '1372117420', '1372501222'),
(16, 'ergtre2', NULL, 0, 30, b'0', '1372117433', '1375920052'),
(17, 'ageew', NULL, 0, 2, b'0', '1372117552', '1378163405'),
(18, '44reww', NULL, 0, 1, b'0', '1372117676', '1372376326'),
(19, '342q2', NULL, 0, 2, b'0', '1372117817', '1372117817'),
(20, 'qweqr', NULL, 0, 3, b'0', '1372117845', '1375499965'),
(21, 'qwerty', NULL, 0, 14, b'0', '1372117881', '1375882965'),
(22, 'yrtyu', NULL, 0, 6, b'0', '1372375526', '1376575857'),
(23, 'ahjkl', NULL, 0, 2, b'0', '1372375548', '1372375548'),
(24, '3herr', NULL, 0, 0, b'0', '1372376001', '1373583113'),
(25, 'werty', NULL, 0, 4, b'0', '1372376970', '1372376970'),
(26, 'abqwe', NULL, 0, 0, b'0', '1372376978', '1373583121'),
(27, 'wwrrt', NULL, 0, 0, b'1', '1372499346', '1372499346'),
(28, 'wwrrt', NULL, 0, 0, b'1', '1372499353', '1372499353'),
(29, 'wetwe', NULL, 0, 3, b'0', '1372500444', '1376438008'),
(30, 'wrwerrwe', NULL, 0, 3, b'1', '1372503808', '1372503808'),
(31, 'werwett', NULL, 0, 2, b'0', '1372503822', '1372503822'),
(32, 'oyoioi', NULL, 0, 18, b'0', '1372514340', '1372514340'),
(33, 'abere', NULL, 0, 1, b'1', '1373097733', '1373097733'),
(34, 'fefre', NULL, 0, 1, b'1', '1373168896', '1373168896'),
(35, 'abc34', NULL, 0, 5, b'1', '1373412852', '1373412852'),
(36, 'tw-9)', NULL, 0, 2, b'0', '1375452343', '1375452343'),
(37, 'ageew2', NULL, 0, 2, b'0', '1375530894', '1375530894'),
(38, 'abcde2', NULL, 0, 2, b'0', '1375530913', '1375530913'),
(39, 'abcde21', NULL, 0, 6, b'0', '1376313630', '1376313630');

-- --------------------------------------------------------

--
-- 表的结构 `hosts`
--

CREATE TABLE IF NOT EXISTS `hosts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cost` float NOT NULL,
  `name` varchar(100) NOT NULL,
  `hosturl` varchar(100) NOT NULL,
  `un` varchar(50) NOT NULL,
  `pw` varchar(50) NOT NULL,
  `ns1url` varchar(36) NOT NULL,
  `ns1ip` varchar(36) NOT NULL,
  `ns2url` varchar(36) NOT NULL,
  `ns2ip` varchar(36) NOT NULL,
  `ftpurl` varchar(100) NOT NULL,
  `ftpserverip` varchar(36) NOT NULL,
  `ftpun` varchar(50) NOT NULL,
  `ftppw` varchar(50) NOT NULL,
  `cpurl` varchar(36) NOT NULL,
  `cpun` varchar(36) NOT NULL,
  `cppw` varchar(36) NOT NULL,
  `pop3server` varchar(36) NOT NULL,
  `servicetel` varchar(50) NOT NULL,
  `servicetel2` varchar(50) NOT NULL,
  `serviceemail` varchar(100) NOT NULL,
  `webroot` varchar(48) NOT NULL,
  `absoluteroot` varchar(48) NOT NULL,
  `cgiroot` varchar(48) NOT NULL,
  `booked` int(11) NOT NULL,
  `duration` int(11) NOT NULL,
  `lastupdate` int(11) NOT NULL DEFAULT '0',
  `submit` varchar(25) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

-- --------------------------------------------------------

--
-- 表的结构 `member`
--

CREATE TABLE IF NOT EXISTS `member` (
  `member_id` int(11) NOT NULL AUTO_INCREMENT,
  `member_name` varbinary(30) NOT NULL,
  `member_email` varbinary(100) NOT NULL,
  `member_pass` varbinary(54) NOT NULL,
  `member_purview` int(11) NOT NULL DEFAULT '0',
  `member_attention` int(11) DEFAULT NULL,
  `member_is_del` bit(1) NOT NULL,
  `member_ins_date` mediumtext NOT NULL,
  `member_up_date` mediumtext NOT NULL,
  PRIMARY KEY (`member_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `people`
--

CREATE TABLE IF NOT EXISTS `people` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uname` varchar(25) NOT NULL,
  `pw` varchar(25) NOT NULL,
  `status` smallint(3) NOT NULL DEFAULT '1',
  `name` varchar(50) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `surname` varchar(50) NOT NULL,
  `email` varchar(120) NOT NULL,
  `lastupdate` int(11) NOT NULL DEFAULT '0',
  `submit` varchar(25) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

-- --------------------------------------------------------

--
-- 表的结构 `sites`
--

CREATE TABLE IF NOT EXISTS `sites` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `url` varchar(100) NOT NULL,
  `un` varchar(50) NOT NULL,
  `pw` varchar(50) NOT NULL,
  `client1` int(10) NOT NULL DEFAULT '0',
  `client2` int(10) NOT NULL DEFAULT '0',
  `admin1` int(10) NOT NULL DEFAULT '0',
  `admin2` int(10) NOT NULL DEFAULT '0',
  `domainid` int(10) NOT NULL DEFAULT '0',
  `hostid` int(10) NOT NULL DEFAULT '0',
  `webroot` varchar(50) NOT NULL,
  `files` text NOT NULL,
  `filesdate` int(11) NOT NULL DEFAULT '0',
  `lastupdate` int(11) NOT NULL DEFAULT '0',
  `submit` varchar(25) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=15 ;

-- --------------------------------------------------------

--
-- 表的结构 `tests`
--

CREATE TABLE IF NOT EXISTS `tests` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `siteid` int(11) NOT NULL DEFAULT '0',
  `name` varchar(250) NOT NULL,
  `type` varchar(25) NOT NULL,
  `url` varchar(120) NOT NULL,
  `regex` varchar(250) NOT NULL,
  `p1` varchar(250) NOT NULL,
  `p2` varchar(250) NOT NULL,
  `p3` varchar(250) NOT NULL,
  `p4` varchar(250) NOT NULL,
  `p5` varchar(250) NOT NULL,
  `p6` varchar(250) NOT NULL,
  `frequency` int(10) NOT NULL DEFAULT '0',
  `lastdone` int(10) NOT NULL DEFAULT '0',
  `isalert` varchar(2) NOT NULL,
  `setup` int(10) NOT NULL DEFAULT '0',
  `lastupdate` int(10) NOT NULL DEFAULT '0',
  `notes` varchar(250) NOT NULL,
  `submit` varchar(25) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

-- --------------------------------------------------------

--
-- 表的结构 `types`
--

CREATE TABLE IF NOT EXISTS `types` (
  `id` varchar(7) NOT NULL,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `type_test`
--

CREATE TABLE IF NOT EXISTS `type_test` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `boolean` tinyint(1) DEFAULT NULL,
  `float` float DEFAULT NULL,
  `varchar` varchar(32) DEFAULT NULL,
  `timestamp` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- 转存表中的数据 `type_test`
--

INSERT INTO `type_test` (`id`, `boolean`, `float`, `varchar`, `timestamp`) VALUES
(1, 0, 12, '123123', '2013-02-03 09:20:56'),
(2, NULL, NULL, NULL, '2013-02-03 09:20:56'),
(3, 1, 12, '123123', '2013-02-03 09:21:40'),
(4, NULL, NULL, NULL, '2013-02-03 09:21:40');

-- --------------------------------------------------------

--
-- 表的结构 `t_student`
--

CREATE TABLE IF NOT EXISTS `t_student` (
  `st_id` int(11) NOT NULL AUTO_INCREMENT,
  `st_user_id` varchar(16) DEFAULT NULL,
  `st_firstname` varchar(32) DEFAULT NULL,
  `st_surname` varchar(32) DEFAULT NULL,
  `st_address` varchar(128) DEFAULT NULL,
  `st_city` varchar(32) DEFAULT NULL,
  `st_state` varchar(2) DEFAULT NULL,
  `st_zip` varchar(10) DEFAULT NULL,
  `st_phone` varchar(20) DEFAULT NULL,
  `st_email` varchar(64) DEFAULT NULL,
  `st_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `st_delete` varchar(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`st_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=101 ;

--
-- 转存表中的数据 `t_student`
--

INSERT INTO `t_student` (`st_id`, `st_user_id`, `st_firstname`, `st_surname`, `st_address`, `st_city`, `st_state`, `st_zip`, `st_phone`, `st_email`, `st_update`, `st_delete`) VALUES
(1, 'aes', 'aa', 'bb', NULL, NULL, NULL, NULL, NULL, NULL, '2013-01-01 12:54:03', '1'),
(100, 'aes', 'aa', 'bb', NULL, NULL, NULL, NULL, NULL, NULL, '2013-01-01 13:06:46', '1');

-- --------------------------------------------------------

--
-- 表的结构 `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varbinary(30) NOT NULL,
  `user_email` varbinary(100) NOT NULL,
  `user_phone` bigint(14) DEFAULT NULL,
  `user_pass` varbinary(54) NOT NULL,
  `user_salt` varbinary(13) DEFAULT NULL,
  `user_permit` int(11) NOT NULL DEFAULT '0',
  `user_attention` int(11) DEFAULT NULL,
  `user_is_del` bit(1) NOT NULL,
  `user_ins_date` mediumtext NOT NULL,
  `user_up_date` mediumtext NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- 转存表中的数据 `user`
--

INSERT INTO `user` (`user_id`, `user_name`, `user_email`, `user_phone`, `user_pass`, `user_salt`, `user_permit`, `user_attention`, `user_is_del`, `user_ins_date`, `user_up_date`) VALUES
(1, 'abcde', 'aa@aa.com', 234241421, 'XVMEAQMCVQsBUQFQWwQFAVxQVwZVA1UGVlsJUAIGUAM=', '52121934c29fc', 0, 2, b'0', '1376223148', '1376921873'),
(2, 'rgerger', 'aa@aa1.com', NULL, 'DApeU1NRXVYEXgdaUgYDXVVTVgAIXFZfWFYBXwBaBFU=', '52121aecbef60', 0, 4, b'0', '1376228719', '1376228732'),
(3, 't343t2', 'a@aa.aa', NULL, 'AFdbVFIAD11UUFlSDgVWBwNVXAAHDldXBFZTBAJcBQI=', '52121afd5fbda', 0, 6, b'0', '1376403379', '1376403379'),
(4, 'wetwe', 'ae@aa.aa', 12345678901, 'UwZcUQACCVNXVA5SDAZdA1FWVQdSVldUBwlUU1JeAgQ=', '52122db48e50c', 0, 3, b'0', '1376489356', '1376923060'),
(5, 'ey213', '2@a1a.aa', 123456789011, 'AwYHUAABUANRBgdQDFRSVQMHVAcAAgJVUVcDUFVdUlA=', '52121b0db38d3', 0, 0, b'0', '1376523007', '1376868365');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
