-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 2016-04-17 17:06:50
-- 服务器版本： 10.1.9-MariaDB
-- PHP Version: 5.6.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mydb`
--

-- --------------------------------------------------------

--
-- 表的结构 `client`
--

CREATE TABLE `client` (
  `user` varchar(50) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `client`
--

INSERT INTO `client` (`user`, `email`, `password`) VALUES
('admin', '123456@qq.com', '123456'),
('zws', '156659@qq.com', '000000');

-- --------------------------------------------------------

--
-- 表的结构 `mydiary`
--

CREATE TABLE `mydiary` (
  `user` varchar(100) DEFAULT NULL,
  `header` varchar(300) DEFAULT NULL,
  `context` varchar(3000) DEFAULT NULL,
  `date` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `mydiary`
--

INSERT INTO `mydiary` (`user`, `header`, `context`, `date`) VALUES
('zws', '我的时光', '第一次注册！', '2016/04/15'),
('admin', 'whtsese', 'awawda', '2016/04/15'),
('admin', 'zzdfgrkuikyuqq', 'wqwrthtff', '2016/04/15'),
('admin', 'wqweqweqwe', 'awdawd', '2016/04/16'),
('zws', '发布04/16', '测试发布', '2016/04/16'),
('admin', 'qweqw', 'awgawgadgwdaw', '2016/04/16'),
('admin', '4/17', '敲注册代码', '2016/04/17'),
('zws', 'wadwaw', 'awawd', '2016/04/17');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`user`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
