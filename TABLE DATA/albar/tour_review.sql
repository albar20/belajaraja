-- phpMyAdmin SQL Dump
-- version 3.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 13, 2017 at 06:31 PM
-- Server version: 5.5.25a
-- PHP Version: 5.4.4

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `infongetrip`
--

-- --------------------------------------------------------

--
-- Table structure for table `tour_review`
--

CREATE TABLE IF NOT EXISTS `tour_review` (
  `tour_review_id` varchar(250) NOT NULL,
  `tourism_place_id` varchar(30) NOT NULL,
  `user_id` int(11) NOT NULL,
  `judul` varchar(50) NOT NULL,
  `review` text NOT NULL,
  `rate` float NOT NULL,
  `picture_1` varchar(50) DEFAULT NULL,
  `picture_2` varchar(50) DEFAULT NULL,
  `picture_3` varchar(50) DEFAULT NULL,
  `video_youtube` varchar(100) DEFAULT NULL,
  `edited` int(11) NOT NULL,
  `create_date` datetime NOT NULL,
  `update_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`tour_review_id`),
  KEY `product_id` (`tourism_place_id`,`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tour_review`
--

INSERT INTO `tour_review` (`tour_review_id`, `tourism_place_id`, `user_id`, `judul`, `review`, `rate`, `picture_1`, `picture_2`, `picture_3`, `video_youtube`, `edited`, `create_date`, `update_date`) VALUES
('1', '6', 1, 'Ini adalah review test', 'Tempatnya bagus dan murah .......', 3.5, NULL, NULL, NULL, NULL, 0, '2017-06-12 00:00:00', '2017-06-12 06:27:29'),
('1593e35ccd210520170612013348', '7', 1, 'kurang bagus ', 'Banyak Begal', 1.5, NULL, NULL, NULL, NULL, 0, '2017-06-12 00:00:00', '2017-06-12 06:33:48');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
