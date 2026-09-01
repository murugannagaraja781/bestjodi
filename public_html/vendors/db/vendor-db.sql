-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 06, 2016 at 01:56 PM
-- Server version: 5.6.16
-- PHP Version: 5.5.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `green_matri`
--

-- --------------------------------------------------------

--
-- Table structure for table `vendors`
--

CREATE TABLE IF NOT EXISTS `vendors` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `city_id` int(20) NOT NULL,
  `address1` varchar(300) NOT NULL,
  `pincode` int(10) NOT NULL,
  `description` varchar(500) NOT NULL,
  `mobile_no` varchar(100) NOT NULL,
  `office_no` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `address2` varchar(200) NOT NULL,
  `starting_price` varchar(100) NOT NULL,
  `stating_category` varchar(100) NOT NULL,
  `image` varchar(200) NOT NULL,
  `image_1` varchar(200) NOT NULL,
  `image_2` varchar(200) NOT NULL,
  `image_3` varchar(200) NOT NULL,
  `image_4` varchar(200) NOT NULL,
  `image_5` varchar(200) NOT NULL,
  `image_6` varchar(200) NOT NULL,
  `image_7` varchar(200) NOT NULL,
  `image_8` varchar(200) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`),
  KEY `category_id` (`category_id`),
  KEY `city_id` (`city_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `vendors`
--

INSERT INTO `vendors` (`id`, `category_id`, `name`, `city_id`, `address1`, `pincode`, `description`, `mobile_no`, `office_no`, `email`, `address2`, `starting_price`, `stating_category`, `image`, `image_1`, `image_2`, `image_3`, `image_4`, `image_5`, `image_6`, `image_7`, `image_8`) VALUES
(4, 1, 'dhaval', 5, 'sarathi appartment', 382415, 'this is demo vendor', '8469195096', '07922893530', 'pdpanchalmec@gmail.com', '', '5000', 'per plate', 'Koala.jpg', 'Desert.jpg', 'Lighthouse.jpg', 'Lighthouse.jpg', 'Lighthouse.jpg', 'Hydrangeas.jpg', 'Tulips.jpg', 'Tulips.jpg', 'Penguins.jpg'),
(5, 1, 'dhaval', 5, 'sarathi appartment', 382415, 'this is demo vendor', '8469195096', '07922893530', 'pdpanchalmec1@gmail.com', '', '5000', 'per plate', 'Hydrangeas.jpg', 'Desert.jpg', 'Lighthouse.jpg', 'Lighthouse.jpg', 'Lighthouse.jpg', 'Hydrangeas.jpg', 'Tulips.jpg', 'Tulips.jpg', 'Penguins.jpg'),
(6, 1, 'dhaval', 5, 'sarathi appartment', 382415, 'this is demo vendor', '8469195096', '07922893530', 'pdpanchalmec2@gmail.com', '', '5000', 'per plate', 'Jellyfish.jpg', 'Desert.jpg', 'Lighthouse.jpg', 'Lighthouse.jpg', 'Lighthouse.jpg', 'Hydrangeas.jpg', 'Tulips.jpg', 'Tulips.jpg', 'Penguins.jpg'),
(7, 1, 'dhaval', 1, 'sarathi appartment', 382454, 'zdfasdasdasd', '8469195096', '21512151544', 'dhaval1@gmail.com', 'sa', '5000', 'per plate', 'Penguins.jpg', 'Penguins.jpg', 'Lighthouse.jpg', 'Penguins.jpg', 'Jellyfish.jpg', 'Tulips.jpg', 'Tulips.jpg', 'Jellyfish.jpg', 'Penguins.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `vendor_category`
--

CREATE TABLE IF NOT EXISTS `vendor_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

--
-- Dumping data for table `vendor_category`
--

INSERT INTO `vendor_category` (`id`, `name`) VALUES
(1, 'Wedding Venues'),
(2, 'Wedding Photographers'),
(3, 'Bridal Makeup'),
(4, 'Bridal Wear'),
(5, 'Groom Wear'),
(6, 'Wedding Decor'),
(7, 'Wedding Planner'),
(8, 'Wedding Cards'),
(9, 'Wedding Videography'),
(10, 'Mehendi Artist'),
(11, 'Wedding Cakes'),
(12, 'Wedding Jewellery'),
(13, 'Wedding Catering'),
(14, 'Trousseau Packers'),
(15, 'DJ'),
(16, 'Choreographers'),
(17, 'Wedding Accessories'),
(18, 'Wedding Favors');

-- --------------------------------------------------------

--
-- Table structure for table `vendor_city`
--

CREATE TABLE IF NOT EXISTS `vendor_city` (
  `city_id` int(11) NOT NULL AUTO_INCREMENT,
  `city_name` varchar(100) NOT NULL,
  PRIMARY KEY (`city_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=101 ;

--
-- Dumping data for table `vendor_city`
--

INSERT INTO `vendor_city` (`city_id`, `city_name`) VALUES
(1, 'Mumbai'),
(2, 'Delhi'),
(3, 'Bangalore'),
(4, 'Hyderabad'),
(5, 'Ahmedabad'),
(6, 'Chennai'),
(7, 'Kolkata'),
(8, 'Surat'),
(9, 'Pune'),
(10, 'Jaipur'),
(11, 'Lucknow'),
(12, 'Kanpur'),
(13, 'Nagpur'),
(14, 'Indore'),
(15, 'Thane'),
(16, 'Bhopal'),
(17, 'Visakhapatnam'),
(18, 'Pimpri & Chinchwad'),
(19, 'Patna'),
(20, 'Vadodara'),
(21, 'Ghaziabad'),
(22, 'Ludhiana'),
(23, 'Agra'),
(24, 'Nashik'),
(25, 'Faridabad'),
(26, 'Meerut'),
(27, 'Rajkot'),
(28, 'Kalyan & Dombivali'),
(29, 'Vasai Virar'),
(30, 'Varanasi'),
(31, 'Srinagar'),
(32, 'Aurangabad'),
(33, 'Dhanbad'),
(34, 'Amritsar'),
(35, 'Navi Mumbai'),
(36, 'Allahabad'),
(37, 'Ranchi'),
(38, 'Haora'),
(39, 'Coimbatore'),
(40, 'Jabalpur'),
(41, 'Gwalior'),
(42, 'Vijayawada'),
(43, 'Jodhpur'),
(44, 'Madurai'),
(45, 'Raipur'),
(46, 'Kota'),
(47, 'Guwahati'),
(48, 'Chandigarh'),
(49, 'Solapur'),
(50, 'Hubli and Dharwad'),
(51, 'Bareilly'),
(52, 'Moradabad'),
(53, 'Mysore'),
(54, 'Gurgaon'),
(55, 'Aligarh'),
(56, 'Jalandhar'),
(57, 'Tiruchirappalli'),
(58, 'Bhubaneswar'),
(59, 'Salem'),
(60, 'Mira and Bhayander'),
(61, 'Thiruvananthapuram'),
(62, 'Bhiwandi'),
(63, 'Saharanpur'),
(64, 'Gorakhpur'),
(65, 'Guntur'),
(66, 'Bikaner'),
(67, 'Amravati'),
(68, 'Noida'),
(69, 'Jamshedpur'),
(70, 'Bhilai Nagar'),
(71, 'Warangal'),
(72, 'Cuttack'),
(73, 'Firozabad'),
(74, 'Kochi'),
(75, 'Bhavnagar'),
(76, 'Dehradun'),
(77, 'Durgapur'),
(78, 'Asansol'),
(79, 'Nanded Waghala'),
(80, 'Kolapur'),
(81, 'Ajmer'),
(82, 'Gulbarga'),
(83, 'Jamnagar'),
(84, 'Ujjain'),
(85, 'Loni'),
(86, 'Siliguri'),
(87, 'Jhansi'),
(88, 'Ulhasnagar'),
(89, 'Nellore'),
(90, 'Jammu'),
(91, 'Sangli Miraj Kupwad'),
(92, 'Belgaum'),
(93, 'Mangalore'),
(94, 'Ambattur'),
(95, 'Tirunelveli'),
(96, 'Malegoan'),
(97, 'Gaya'),
(98, 'Jalgaon'),
(99, 'Udaipur'),
(100, 'Maheshtala');

-- --------------------------------------------------------

--
-- Table structure for table `vendor_specification`
--

CREATE TABLE IF NOT EXISTS `vendor_specification` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `attribute_id` int(11) NOT NULL,
  `vendor_id` int(11) NOT NULL,
  `attribute_name` varchar(100) NOT NULL,
  `attribute_value` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `vendor_specification`
--

INSERT INTO `vendor_specification` (`id`, `attribute_id`, `vendor_id`, `attribute_name`, `attribute_value`) VALUES
(6, 1, 4, 'fcsadsdf', 'sfsssdfcsd'),
(7, 2, 4, 'scvsdcs', 'sfcsdcsdcsd'),
(8, 0, 5, 'sdsd', 'sdsds'),
(9, 0, 6, 'sdsd', 'sdsds'),
(10, 1, 7, 'adadas', 'adasdas');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
