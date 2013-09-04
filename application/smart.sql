-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2013 年 02 月 04 日 13:58
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
  `area_name` varchar(100) DEFAULT NULL,
  `area_is_del` char(1) NOT NULL,
  `area_ins_date` timestamp NOT NULL DEFAULT '2038-01-18 19:14:07',
  `area_up_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`area_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- 转存表中的数据 `area`
--

INSERT INTO `area` (`area_id`, `area_name`, `area_is_del`, `area_ins_date`, `area_up_date`) VALUES
(1, '123', '1', '2013-02-04 13:47:49', '2013-02-04 13:47:49'),
(2, '123', '1', '2013-02-04 13:48:06', '2013-02-04 13:48:06');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=101 ;

--
-- 转存表中的数据 `t_student`
--

INSERT INTO `t_student` (`st_id`, `st_user_id`, `st_firstname`, `st_surname`, `st_address`, `st_city`, `st_state`, `st_zip`, `st_phone`, `st_email`, `st_update`, `st_delete`) VALUES
(1, 'aes', 'aa', 'bb', NULL, NULL, NULL, NULL, NULL, NULL, '2013-01-01 12:54:03', '1'),
(100, 'aes', 'aa', 'bb', NULL, NULL, NULL, NULL, NULL, NULL, '2013-01-01 13:06:46', '1');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
