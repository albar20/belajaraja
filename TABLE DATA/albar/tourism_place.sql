-- phpMyAdmin SQL Dump
-- version 3.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 03, 2017 at 08:49 PM
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
-- Table structure for table `tourism_place`
--

CREATE TABLE IF NOT EXISTS `tourism_place` (
  `tourism_place_id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `description` text,
  `slug` varchar(100) NOT NULL,
  `picture_1` varchar(50) DEFAULT NULL,
  `picture_2` varchar(50) DEFAULT NULL,
  `picture_3` varchar(50) DEFAULT NULL,
  `create_date` datetime NOT NULL,
  `update_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`tourism_place_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `tourism_place`
--

INSERT INTO `tourism_place` (`tourism_place_id`, `name`, `description`, `slug`, `picture_1`, `picture_2`, `picture_3`, `create_date`, `update_date`) VALUES
(6, 'asdasdsad', 'dsadsadasdasd', 'asdasdsad', '11DreadOut_branding_image.jpg', '500px-Commons-emblem-success_svg.png', '530c0b63cbb7e13932982752464754-dreadout_cover_.jpg', '0000-00-00 00:00:00', '2017-06-03 17:32:13'),
(7, 'dgasfdgh jfggdhfas hgfdhgsaf dhgasf', 'dsadasdasd', 'dgasfdgh-jfggdhfas-hgfdhgsaf-dhgasf', '164569184.jpg', '1280836_508974962520609_250687996_n.jpg', '7873936ee0cb1ebf13ec7ac61e04fdaf.jpg', '0000-00-00 00:00:00', '2017-06-03 17:33:42'),
(8, 'dsad dsad asads  sa', 'asdsad', 'dsad-dsad-asads-sa', 'a6dVEo9_460sa_v1.gif', 'a9Mjx60_700b.jpg', 'aGwRXOZ_460s_v1.jpg', '0000-00-00 00:00:00', '2017-06-03 18:14:00'),
(9, 'dsadsa dsa d', 'dasd', 'dsadsa-dsa-d', 'alarm.png', 'gmail.jpg', 'mysterybox.png', '0000-00-00 00:00:00', '2017-06-03 18:14:24'),
(10, 'dsjhagjhs', 'dsadsadsad dsadsadsadsad', 'dsjhagjhs', 'multy-user.png', 'aQp8X2q_460sa_v1.gif', 'game_engine.jpg', '0000-00-00 00:00:00', '2017-06-03 18:15:00'),
(11, 'dasdsad hjhjkhjkh', 'dsadsad dsadasd', 'dasdsad-hjhjkhjkh', 'aGVndD0_460s_v2.jpg', 'amL2v49_460sa_v1.gif', 'aypwR1p_460s.jpg', '0000-00-00 00:00:00', '2017-06-03 18:24:26'),
(12, 'edsadt tasr', 'dasd', 'edsadt-tasr', 'Desert.jpg', 'Lighthouse.jpg', 'Penguins.jpg', '0000-00-00 00:00:00', '2017-06-03 18:24:50'),
(13, 'fasd sad as', 'as das sad asdsa d', 'fasd-sad-as', 'Koala.jpg', 'Jellyfish.jpg', 'Hydrangeas.jpg', '0000-00-00 00:00:00', '2017-06-03 18:25:05'),
(14, 'sdasdasdsad asd sad', 'cvxcvcxvxcv', 'sdasdasdsad-asd-sad', 'Tulips.jpg', 'Chrysanthemum.jpg', 'Desert.jpg', '0000-00-00 00:00:00', '2017-06-03 18:25:27'),
(15, 'sadasvcbv', 'vbcbvcbvc bvcbcvb', 'sadasvcbv', 'Jellyfish.jpg', '1280836_508974962520609_250687996_n.jpg', '500px-Commons-emblem-success_svg.png', '0000-00-00 00:00:00', '2017-06-03 18:25:50'),
(16, 'jgfhfhg fgh fgh', 'hgfh fgh fghfg  hfg', 'jgfhfhg-fgh-fgh', 'a2PDbNZ_460s.jpg', 'CLIPART_OF_13165_SM_2.jpg', 'images2.jpg', '0000-00-00 00:00:00', '2017-06-03 18:26:10');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
