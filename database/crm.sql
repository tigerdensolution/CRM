-- phpMyAdmin SQL Dump
-- version 4.4.15.8
-- https://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 26, 2016 at 12:13 PM
-- Server version: 5.6.31
-- PHP Version: 7.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `crm`
--

-- --------------------------------------------------------

--
-- Table structure for table `clients_information`
--

CREATE TABLE IF NOT EXISTS `clients_information` (
  `id` int(11) NOT NULL,
  `customer_email` varchar(255) NOT NULL,
  `customer_name` varchar(255) NOT NULL,
  `company_name` varchar(255) NOT NULL,
  `address_1` varchar(255) DEFAULT NULL,
  `address_2` varchar(255) DEFAULT NULL,
  `address_3` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `state` varchar(255) DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  `country_code` varchar(10) NOT NULL,
  `pincode` int(11) DEFAULT NULL,
  `prifix` int(11) DEFAULT NULL,
  `contact_number` int(11) DEFAULT NULL,
  `mobile_number` varchar(255) DEFAULT NULL,
  `delete_status` enum('true','false') NOT NULL DEFAULT 'false'
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `clients_information`
--

INSERT INTO `clients_information` (`id`, `customer_email`, `customer_name`, `company_name`, `address_1`, `address_2`, `address_3`, `city`, `state`, `country`, `country_code`, `pincode`, `prifix`, `contact_number`, `mobile_number`, `delete_status`) VALUES
(26, 'webmaster.albertsons@gmail.com', 'Ramesh Shetty', 'Albertsons International Private Limited', '2nd Floor', 'PARIN, Collectors Gate', 'Balmatta Road', 'Mangalore', 'Karnataka', 'India', '+91', 575001, 824, 4288799, '0', 'false'),
(27, 'webmaster.bemschool@gmail.com', 'Principal BEM', 'South Kanara Educational and Cultural Society', '151 ande', 'Mission High School Raod', 'Carstreet', 'Mangalore', 'Karnataka', 'India', '+91', 575001, 824, 4288799, '0', 'false'),
(28, 'webmaster.rgdesign@gmail.com', 'Rajiv CharlesGoveas', 'R G Design', 'RanRaj', 'Shivbagh New Road', 'Kadri', 'Mangalore', 'Karnataka', 'India', '+91', 575002, 824, 4288799, '0', 'false'),
(29, 'webmaster.ballikana@gmail.com', 'Ramesh Rai', 'Balakrishna', 'Ariadka Village & Post', '', '', 'Puttur', 'Karnataka', 'India', '+91', 576105, 824, 4288799, '0', 'false'),
(30, 'webmaster.cask@gmail.com', 'Capt. John P Menezes', 'Catholic Association of South Kanara  (CASK)', '#5,T-7, III Floor', ' Pio Mall', 'Bejai Church Road', 'Mangalore', 'Karnataka', 'India', '+91', 575001, 824, 4288799, '0', 'true'),
(31, 'dasdsa@dg.vv', 'fsfsd', 'fdf', 'fsdf', '', '', 'Fsdf', 'fsdf', 'dfsdf', '+91', 424234, 824, 8512457, '9036457837', 'true'),
(32, 'ff@ddd.cv', 'fdsfds', 'fdsf', 'dsfdsf', '', '', 'dfsf', 'sfsdf', 'sdfsdfsd', '+91', 343243, 824, 3434343, '4343434343', 'true'),
(33, 'dix@gmail.com', 'fsdfds', 'ddsfdsf', 'fsdfdsf', '', '', 'fsdf', 'sfsfsd', 'fsdfsdf', '+91', 575014, 824, 3434343, '8596321475', 'true'),
(34, 'dix@gmail.com', 'fsdfds', 'Raju', 'fdsf', '', '', 'fsdf', 'sdfsdf', 'dsfsd', '+91', 334343, 824, 3434333, '3434343434', 'true'),
(35, 'anand@gmail.com', 'fdsfdfsdf', 'tiger den solu', '151 anderson channel RD\r\n4170', '', '', 'palestine', 'Florida', 'United States', '+91', 575014, 824, 3434343, '1234567890', 'true'),
(36, 'anand@gmail.com', 'fdsfdfsdf', 'tiger den solu', '334\r\ndelray beach', '', '', 'palestine', 'Florida', 'United States', '+91', 123456, 824, 2222222, '9036457837', 'true'),
(37, 'sdas@dfasd.com', 'ramu', 'raju', 'sdsadsad', '', '', 'manh', 'asds', 'sadasd', '+91', 585759, 824, 5785489, '5485458749', 'false'),
(38, 'sdas@dfasd.com', 'ramu', 'raju', 'xvdxsfdsfsdf', '', '', 'manh', 'asds', 'sadasd', '+91', 587545, 824, 5875458, '8569854785', 'false'),
(39, 'sdas@dfasd.com', 'ramu', 'raju', 'fgfdgfdgfdg', '', '', 'manh', 'asds', 'sadasd', '+91', 123456, 824, 1233457, '1234567891', 'false'),
(40, 'sdas@dfasd.com', 'ramu', 'raju', 'gdsfgfdg', '', '', 'manh', 'asds', 'gdggsdgsdg', '+91', 123465, 824, 1234567, '1234657981', 'false'),
(41, 'sdas@dfasd.com', 'ramu', 'raju', 'rwqewqewqe', '', '', 'manh', 'asds', 'dasdsad', '+91', 123465, 824, 1234156, '1234657981', 'true'),
(42, 'anand@gmail.com', 'fdsfdfsdf', 'tiger den solu', '334\r\ndelray beach', '', '', 'palestine', 'Florida', 'United States', '+91', 123456, 824, 1234657, '9036457837', 'true');

-- --------------------------------------------------------

--
-- Table structure for table `domain_information`
--

CREATE TABLE IF NOT EXISTS `domain_information` (
  `id` int(11) NOT NULL,
  `company_name` varchar(255) NOT NULL,
  `domain_name` varchar(255) NOT NULL,
  `admin_name` varchar(255) NOT NULL,
  `admin_email` varchar(255) NOT NULL,
  `admin_password` varchar(255) NOT NULL,
  `editor_name` varchar(255) NOT NULL,
  `editor_password` varchar(255) NOT NULL,
  `editor_email` varchar(255) NOT NULL,
  `delete_status` enum('true','false') NOT NULL DEFAULT 'false'
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `domain_information`
--

INSERT INTO `domain_information` (`id`, `company_name`, `domain_name`, `admin_name`, `admin_email`, `admin_password`, `editor_name`, `editor_password`, `editor_email`, `delete_status`) VALUES
(1, 'Albertsons International Private Limited', 'albertsons.co.in', 'dZ894869wugS', 'webmaster.albertsons@gmail.com', 'G628c6*Y3tFPhTWDC4', 'Albertsons', 'Tdkonnect@9880488799', 'editor@adlbertsons.co.in', 'false'),
(2, 'South Kanara Educational and Cultural Society', 'bemschool.org', 'F7C7c484N6QK', 'webmaster.bemschool@gmail.com', '9Dx4722^8C@xhMQ33b', 'bemschool', '9Dx4722^8C@xhMQ33b', 'editor@bemschool.com', 'true'),
(3, 'R G Design', 'rgdesign.in', 'm58d267D6E6E', 'webmaster.rgdesign@gmail.com', '6Cv98488Q#X@hrPCjb', 'RG Design', '6Cv98488Q#X@hrPCjb', 'rgd@gmail.com', 'false'),
(6, 'Raju', 'sdfdsf', 'sdfsdfds', 'den@email.com', 'dfdfd', 'fdfs', 'dfsdfds', 'den@tiger.com', 'false'),
(7, 'ddsfdsf', 'dfsdfds', 'sfsdfsd', 'den@gmail.com', 'dfsfsd', 'fsdfsd', 'sdfdsf', 'solution@email.com', 'true'),
(10, 'Balakrishna', 'sdasd', 'asdsad', 'sadsad@gmail.com', 'dasd', 'asdsad', 'sdfsdf', 'solution@email.com', 'false');

-- --------------------------------------------------------

--
-- Table structure for table `links_list`
--

CREATE TABLE IF NOT EXISTS `links_list` (
  `id` int(11) NOT NULL,
  `list_name` varchar(255) NOT NULL,
  `list_description` varchar(255) NOT NULL,
  `links` varchar(255) NOT NULL,
  `delete_status` enum('true','false') NOT NULL DEFAULT 'false'
) ENGINE=InnoDB AUTO_INCREMENT=88 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `links_list`
--

INSERT INTO `links_list` (`id`, `list_name`, `list_description`, `links`, `delete_status`) VALUES
(61, 'manu', 'list of manu', 'https://www.google.co.in/', 'false'),
(62, 'manu', 'list of manu', 'https://www.youtube.com/', 'false'),
(63, 'manu', 'list of manu', 'https://www.facebook.com/', 'false'),
(64, 'manu', 'list of manu', 'https://www.yahoo.com/', 'true'),
(69, 'Raju', 'list of raju links', 'www.google.com', 'false'),
(70, 'Raju', 'list of raju links', 'www.youtube.com', 'false'),
(71, 'Raju', 'list of raju links', 'www.gmail.com', 'false'),
(72, 'Raju', 'list of raju links', 'www.yahoo.com', 'false'),
(83, 'deekshith', 'deekshith list', 'www.google.com', 'true'),
(84, 'deekshith', 'deekshith list', 'www.youtube.com', 'true'),
(85, 'deekshith', 'deekshith list', 'www.gmail.com', 'true'),
(86, 'deekshith', 'deekshith list', 'www.yahoo.com', 'true'),
(87, 'deekshith', 'deekshith list', 'www.facebook.com', 'true');

-- --------------------------------------------------------

--
-- Table structure for table `user_login`
--

CREATE TABLE IF NOT EXISTS `user_login` (
  `id` int(11) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_login`
--

INSERT INTO `user_login` (`id`, `user_name`, `password`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `clients_information`
--
ALTER TABLE `clients_information`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `domain_information`
--
ALTER TABLE `domain_information`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `links_list`
--
ALTER TABLE `links_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_login`
--
ALTER TABLE `user_login`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `clients_information`
--
ALTER TABLE `clients_information`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=46;
--
-- AUTO_INCREMENT for table `domain_information`
--
ALTER TABLE `domain_information`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `links_list`
--
ALTER TABLE `links_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=88;
--
-- AUTO_INCREMENT for table `user_login`
--
ALTER TABLE `user_login`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
