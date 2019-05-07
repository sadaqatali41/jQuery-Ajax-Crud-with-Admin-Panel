-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 07, 2019 at 06:47 PM
-- Server version: 5.5.8
-- PHP Version: 5.3.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `jquery_ajax_crud`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fname` varchar(100) NOT NULL,
  `uname` varchar(100) NOT NULL,
  `pwd` varchar(100) NOT NULL,
  `role` varchar(255) NOT NULL DEFAULT 'minor',
  `status` int(11) NOT NULL DEFAULT '1',
  `created_date` varchar(255) NOT NULL,
  `updated_date` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `fname`, `uname`, `pwd`, `role`, `status`, `created_date`, `updated_date`) VALUES
(1, 'Sadaqat Ali', 'sadaqat1', 'Sadaqat1@', 'major', 1, '2018-12-15 22:20:30', NULL),
(2, 'Saif Ali', 'saifali', 'Saifali1@', 'minor', 1, '2018-12-30 22:20:50', '2019-04-29 22:53:07'),
(3, 'wasim reza', 'wasimreza1', 'Wasimreza1@', 'minor', 1, '2019-04-28 15:31:55', '2019-04-30 00:34:55'),
(4, 'saadat karim', 'saadatk1', 'Saadat1@', 'minor', 1, '2019-04-28 15:34:53', NULL),
(5, 'shadab alam', 'shadaba1', 'Shadaab1@', 'minor', 1, '2019-04-28 15:38:19', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `articles`
--

CREATE TABLE IF NOT EXISTS `articles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `body` text NOT NULL,
  `image_path` varchar(200) NOT NULL,
  `created_date` varchar(100) NOT NULL,
  `updated_date` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `userid` (`userid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `articles`
--

INSERT INTO `articles` (`id`, `userid`, `title`, `body`, `image_path`, `created_date`, `updated_date`) VALUES
(1, 1, 'Mango', 'Mango is the King of Fruits', 'article_photos/_mango.jpg', '2018-11-26 23:43:18', '2018-12-09 21:46:43'),
(2, 1, 'Lemons', 'Lemon is little bit sour, but is very helpful in stomach.', 'article_photos/_lemons.jpg', '2018-11-26 23:46:40', '2018-12-10 00:52:33'),
(3, 1, 'Orange', 'Orange is also a good fruit changes.', 'article_photos/_orange.jpg', '2018-11-27 00:42:23', '2019-03-26 23:46:54'),
(7, 5, 'APJ Abul Kalam', 'Avul Pakir Jainulabdeen Abdul Kalam was an Indian scientist who served as the 11th President of India from 2002 to 2007.', 'article_photos/_apj.jpg', '2018-12-06 21:25:50', '2018-12-06 21:30:40'),
(8, 5, 'APJ Abul Kalam Sir', 'Avul Pakir Jainulabdeen Abdul Kalam was an Indian scientist who served as the 11th President of India from 2002 to 2007', 'article_photos/_Tulips.jpg', '2018-11-30 23:33:58', '2018-12-01 00:05:21');

-- --------------------------------------------------------

--
-- Table structure for table `contact_us`
--

CREATE TABLE IF NOT EXISTS `contact_us` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `mobile` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `created_date` varchar(255) NOT NULL,
  `updated_date` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `contact_us`
--

INSERT INTO `contact_us` (`id`, `name`, `email`, `mobile`, `message`, `status`, `created_date`, `updated_date`) VALUES
(1, 'sadaqat ali', 'sadaqatali890@gmail.com', '7893941364', 'Hello everyone this is test data for checking the application', 1, '2019-04-30 00:26:44', '2019-05-01 15:43:51'),
(2, 'shadab alam', 'shadab.tmt07@gmail.com', '9044786570', 'Hello,testing again', 1, '2019-04-30 00:29:58', '2019-05-01 15:42:28'),
(3, 'saadat karim', 'saadatk07@gmail.com', '7865453490', 'Hello, Testing is finally done', 1, '2019-04-30 00:32:07', '2019-05-01 15:44:18');

-- --------------------------------------------------------

--
-- Table structure for table `crud`
--

CREATE TABLE IF NOT EXISTS `crud` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fname` varchar(100) NOT NULL,
  `uname` varchar(100) NOT NULL,
  `pwd` varchar(100) NOT NULL,
  `mobile` bigint(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `created_date` varchar(100) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `image_path` varchar(100) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `uname` (`uname`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `mobile` (`mobile`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `crud`
--

INSERT INTO `crud` (`id`, `fname`, `uname`, `pwd`, `mobile`, `email`, `created_date`, `gender`, `image_path`, `status`) VALUES
(1, 'sadaqat ali', 'sadaqat1', 'Sadaqat1@', 7893941364, 'sadaqatali890@gmail.com', '2018-11-24 21:20:24', 'male', 'images/1542821366_sadaqat.jpg', 1),
(2, 'saif ali', 'saifali2', 'saifali', 7893941361, 'saifali890@gmail.com', '2018-11-24 21:25:26', 'male', 'images/1542911480_behavior.jpg', 0),
(3, 'mohd arif', 'arif1234', 'arif1234', 9878654567, 'arif123@gmail.com', '2018-11-24 21:26:40', 'male', 'images/1543162540_ishq.jpg', 0),
(4, 'saif ali', 'saif123', 'saif123', 8960962290, 'saifaali123@gmail.com', '2018-11-24 21:30:50', 'male', 'images/1543162702_foto.jpg', 0),
(5, 'ozair ahamd', 'ozair23', 'ozair23', 7890876545, 'ozairahmad23@gmail.com', '2018-11-25 22:11:29', 'male', 'images/1543164089_usufZuekha.jpg', 1),
(6, 'Imran khan', 'imran123', 'imran123', 7890675467, 'imrankhan123@gmail.com', '2018-11-26 00:19:46', 'male', 'images/1543171786_usufZuekha.jpg', 0);

-- --------------------------------------------------------

--
-- Table structure for table `delete_articles`
--

CREATE TABLE IF NOT EXISTS `delete_articles` (
  `id` int(11) NOT NULL DEFAULT '0',
  `userid` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `body` text NOT NULL,
  `image_path` varchar(200) NOT NULL,
  `created_date` varchar(100) NOT NULL,
  `updated_date` varchar(100) NOT NULL,
  `deleted_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `delete_articles`
--

INSERT INTO `delete_articles` (`id`, `userid`, `title`, `body`, `image_path`, `created_date`, `updated_date`, `deleted_date`) VALUES
(9, 5, 'Munsi Premchand', 'Munshi Premchand was the famous Hindi story writer and novelist. He was the pioneer of modern Hindi and Urdu social fiction. He made Hindi the language of masses. He is rightly called theÂ â€˜Father of Hindi fictionâ€˜. He was born in 1880 at 31st of July in the Lamhi village near Varanasi.', 'article_photos/_Premchandxyz123.jpg', '2018-12-01 00:29:37', '2018-12-01 00:31:13', '2019-03-31 23:33:48');

-- --------------------------------------------------------

--
-- Table structure for table `story`
--

CREATE TABLE IF NOT EXISTS `story` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(11) NOT NULL,
  `story` text NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `created_date` varchar(255) NOT NULL,
  `updated_date` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `story`
--

INSERT INTO `story` (`id`, `userid`, `story`, `status`, `created_date`, `updated_date`) VALUES
(1, 1, 'Hello all, i am Sadaqat Ali and working at IQ Wave Solution in ameerpet, hyderabad, Telangana. 500028.', 1, '2019-04-04 17:25:11', '2019-04-24 01:17:36'),
(2, 2, 'Hello, This is Saif Ali from Maunath Bhanjan U.P. 275101.', 1, '2019-04-20 00:24:30', '2019-04-24 01:01:00'),
(3, 3, 'Hello, I am Mohammad Arif from Tanda U.P. 229101', 1, '2019-04-20 00:43:30', '2019-04-20 01:06:23'),
(4, 4, 'This Saif Ali from U.P.', 1, '2019-04-20 00:49:26', NULL),
(5, 5, 'This is Ozair Ahmad from Maunath Bhanjan U.P.', 1, '2019-04-20 00:50:07', NULL),
(6, 6, 'This is Imran Khan from U.P. 275101', 1, '2019-04-20 00:51:22', '2019-04-20 01:05:47');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `articles`
--
ALTER TABLE `articles`
  ADD CONSTRAINT `articles_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `crud` (`id`);
