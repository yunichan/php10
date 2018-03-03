-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: 2018 年 3 月 03 日 02:41
-- サーバのバージョン： 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `face`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `face_upfile`
--

CREATE TABLE IF NOT EXISTS `face_upfile` (
`id` int(128) NOT NULL,
  `image` varchar(128) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;

--
-- テーブルのデータのダンプ `face_upfile`
--

INSERT INTO `face_upfile` (`id`, `image`) VALUES
(1, 'upload/20180302194947d41d8cd98f00b204e9800998ecf8427e.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `face_upfile`
--
ALTER TABLE `face_upfile`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `face_upfile`
--
ALTER TABLE `face_upfile`
MODIFY `id` int(128) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=23;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
