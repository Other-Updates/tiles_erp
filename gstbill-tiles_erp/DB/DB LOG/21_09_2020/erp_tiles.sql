-- phpMyAdmin SQL Dump
-- version 4.8.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 21, 2020 at 08:08 AM
-- Server version: 10.1.31-MariaDB
-- PHP Version: 5.6.35

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `erp_tiles`
--

-- --------------------------------------------------------

--
-- Table structure for table `address`
--

CREATE TABLE `address` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `type` enum('present','permanent') DEFAULT NULL,
  `line1` varchar(255) DEFAULT NULL,
  `line2` varchar(255) DEFAULT NULL,
  `line3` varchar(255) DEFAULT NULL,
  `post_office` varchar(45) DEFAULT NULL,
  `district` varchar(45) DEFAULT NULL,
  `city` varchar(45) DEFAULT NULL,
  `state` varchar(45) DEFAULT NULL,
  `country` varchar(45) DEFAULT NULL,
  `zip` varchar(20) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(60) NOT NULL,
  `admin_image` varchar(30) NOT NULL,
  `df` int(1) NOT NULL DEFAULT '0',
  `created_date` date NOT NULL,
  `last_entry` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`, `admin_image`, `df`, `created_date`, `last_entry`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'admin_icon.png', 0, '2014-11-13', '2016-12-21 10:41:53');

-- --------------------------------------------------------

--
-- Table structure for table `ci_sessions`
--

CREATE TABLE `ci_sessions` (
  `session_id` varchar(40) NOT NULL DEFAULT '0',
  `ip_address` varchar(45) NOT NULL DEFAULT '0',
  `user_agent` varchar(120) NOT NULL,
  `last_activity` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `user_data` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ci_sessions`
--

INSERT INTO `ci_sessions` (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES
('7b7d97728316b0c28172875f64e760be', '::1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/85.0.4183.102 Safari/537.36', 1600662165, 'a:2:{s:9:\"user_data\";s:0:\"\";s:8:\"scootero\";s:3884:\"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\";}'),
('f7b502d808fd7ef40618aafc311ee8df', '::1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/85.0.4183.102 Safari/537.36', 1600668405, 'a:2:{s:9:\"user_data\";s:0:\"\";s:8:\"scootero\";s:3884:\"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\";}');

-- --------------------------------------------------------

--
-- Table structure for table `company_details`
--

CREATE TABLE `company_details` (
  `id` int(11) NOT NULL,
  `company_name` varchar(100) NOT NULL,
  `phone_no` varchar(12) NOT NULL,
  `address1` varchar(100) NOT NULL,
  `address2` varchar(100) NOT NULL,
  `city` varchar(50) NOT NULL,
  `state` varchar(50) NOT NULL,
  `bank_name` varchar(50) NOT NULL,
  `branch` varchar(50) NOT NULL,
  `ifsc` varchar(20) NOT NULL,
  `ac_no` varchar(50) NOT NULL,
  `pin` varchar(8) NOT NULL,
  `email` varchar(50) NOT NULL,
  `tin_no` int(120) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `company_details`
--

INSERT INTO `company_details` (`id`, `company_name`, `phone_no`, `address1`, `address2`, `city`, `state`, `bank_name`, `branch`, `ifsc`, `ac_no`, `pin`, `email`, `tin_no`) VALUES
(1, '  Incredible solutions', '04428587037', 'No 25, Malayappan Street', 'Parrys', 'Chennai', 'Tamil Nadu', 'INDIAN BANK', 'MADIWALA', '56235', '23123213', '600001', 'jinna_traders@gmail.com', 66666);

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `id` int(11) NOT NULL,
  `state_id` int(5) DEFAULT NULL,
  `name` varchar(60) NOT NULL,
  `short_name` varchar(60) NOT NULL,
  `store_name` varchar(60) NOT NULL,
  `contact_person` varchar(60) NOT NULL,
  `address1` varchar(100) DEFAULT NULL,
  `address2` varchar(100) NOT NULL,
  `address3` varchar(100) NOT NULL,
  `city` varchar(255) NOT NULL,
  `street_name` varchar(60) DEFAULT NULL,
  `mobil_number` varchar(13) NOT NULL,
  `email_id` varchar(60) NOT NULL,
  `dob` date NOT NULL,
  `anniversary` date NOT NULL,
  `bank_name` varchar(200) NOT NULL,
  `bank_branch` varchar(50) NOT NULL,
  `account_num` varchar(40) NOT NULL,
  `ifsc` varchar(20) NOT NULL,
  `agent_name` int(11) NOT NULL,
  `payment_terms` varchar(120) NOT NULL,
  `advance` float(7,2) NOT NULL,
  `tin` varchar(30) DEFAULT NULL,
  `customer_type` varchar(200) NOT NULL,
  `credit_days` int(11) NOT NULL,
  `credit_limit` varchar(50) NOT NULL,
  `temp_credit_limit` varchar(50) DEFAULT NULL,
  `approved_by` int(55) DEFAULT NULL,
  `customer_region` varchar(50) NOT NULL,
  `sell_price` varchar(50) NOT NULL,
  `idf` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `pincode` varchar(7) NOT NULL DEFAULT '0',
  `status` int(1) NOT NULL DEFAULT '1',
  `firm_id` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`id`, `state_id`, `name`, `short_name`, `store_name`, `contact_person`, `address1`, `address2`, `address3`, `city`, `street_name`, `mobil_number`, `email_id`, `dob`, `anniversary`, `bank_name`, `bank_branch`, `account_num`, `ifsc`, `agent_name`, `payment_terms`, `advance`, `tin`, `customer_type`, `credit_days`, `credit_limit`, `temp_credit_limit`, `approved_by`, `customer_region`, `sell_price`, `idf`, `pincode`, `status`, `firm_id`, `created_by`, `created_date`) VALUES
(1, 31, '', '', 'ABDUL RAHMAN', '', 'cbe', '', '', '', '', '9874563211', 'rahman@gmail.com', '0000-00-00', '0000-00-00', '', '', '', '', 0, '', 0.00, '', '1', 0, '', NULL, NULL, 'non-local', '', '2019-04-10 06:05:06', '0', 1, 1, 1, '0000-00-00 00:00:00'),
(2, 31, '', '', 'Fazil', '', 'coimbatore', '', '', '', '', '9685741236', 'faz@gmail.com', '0000-00-00', '0000-00-00', '', '', '', '', 0, '', 0.00, '', '1', 0, '', NULL, NULL, 'non-local', '', '2020-03-04 04:55:45', '0', 1, 3, 1, '0000-00-00 00:00:00'),
(3, 31, '', '', 'Riyas', '', 'chennai', '', '', '', '', '9368521478', '', '0000-00-00', '0000-00-00', '', '', '', '', 0, '', 0.00, '', '1', 1, '', NULL, NULL, 'non-local', '', '2019-05-24 12:25:38', '0', 0, 3, 1, '0000-00-00 00:00:00'),
(4, 29, '', '', 'Khaleel ahmed', '', 'g', '', '', '', '', '8696521452', 'gogulbui2k19@gmail.com', '0000-00-00', '0000-00-00', '', '', '', '', 0, '', 0.00, '', '2', 0, '', NULL, NULL, 'non-local', '', '2019-05-10 04:42:01', '0', 1, 1, 1, '0000-00-00 00:00:00'),
(5, 28, '', '', 'Rohan', '', 'h', '', '', '', '', '8596415263', '', '0000-00-00', '0000-00-00', '', '', '', '', 0, '', 0.00, '', '1', 0, '', NULL, NULL, 'non-local', '', '2019-05-09 04:37:19', '0', 1, 6, 1, '0000-00-00 00:00:00'),
(6, 31, '', '', 'Test Accounts', '', 'Cbe', '', '', '', 'test', '9843567288', '', '0000-00-00', '0000-00-00', '', '', '', '', 0, '', 0.00, '', '1', 0, '', NULL, NULL, 'local', '', '2020-09-14 10:51:55', '0', 1, 5, 1, '0000-00-00 00:00:00'),
(7, NULL, '', '', 'Test Muti User', '', 'test', '', '', '', NULL, '9789415166', 'testt@gmail.com', '0000-00-00', '0000-00-00', '', '', '', '', 0, '', 0.00, NULL, '', 0, '', '', NULL, '', '', '2020-09-18 08:54:51', '0', 1, 0, 0, '0000-00-00 00:00:00'),
(8, NULL, '', '', 'Test User', '', 'test', '', '', '', NULL, '9789415166', 'testt11@gmail.com', '0000-00-00', '0000-00-00', '', '', '', '', 0, '', 0.00, NULL, '', 0, '', '', NULL, '', '', '2020-09-18 09:47:11', '0', 1, 0, 0, '0000-00-00 00:00:00'),
(9, 31, '', '', 'Test Muti User', '', 'test', '', '', '', NULL, '9789415164', 'testt@gmail.com', '0000-00-00', '0000-00-00', '', '', '', '', 0, '', 0.00, '', '1', 0, '', NULL, NULL, '', '', '2020-09-18 11:53:54', '0', 1, 1, 0, '0000-00-00 00:00:00'),
(10, NULL, '', '', 'kalai vani', '', '37 Cardinal Lane\r\nPetersburg, VA 23803\r\nUnited States of America\r\nZip Code: 85001', '', '', '', NULL, '9789415199', 'testt@gmail.com', '0000-00-00', '0000-00-00', '', '', '', '', 0, '', 0.00, NULL, '', 0, '', '', NULL, '', '', '2020-09-18 14:07:51', '0', 1, 0, 0, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `customer_payment`
--

CREATE TABLE `customer_payment` (
  `id` int(11) NOT NULL,
  `payment_no` varchar(12) DEFAULT NULL,
  `customer_id` int(11) NOT NULL DEFAULT '0',
  `created_date` date DEFAULT NULL,
  `updated_date` date DEFAULT NULL,
  `amount` double(10,2) DEFAULT NULL,
  `status` int(1) NOT NULL DEFAULT '1',
  `is_deleted` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer_payment`
--

INSERT INTO `customer_payment` (`id`, `payment_no`, `customer_id`, `created_date`, `updated_date`, `amount`, `status`, `is_deleted`) VALUES
(1, 'Pay129', 7, '2020-09-18', '2020-09-18', 1000.00, 1, 0),
(2, 'Pay125', 2, '2020-09-18', '2020-09-18', 1000.00, 1, 0),
(3, 'Pay123', 1, '2020-09-18', '2020-09-18', 3000.00, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `erp_brand`
--

CREATE TABLE `erp_brand` (
  `id` int(11) NOT NULL,
  `brands` varchar(30) NOT NULL,
  `status` int(1) NOT NULL DEFAULT '1',
  `firm_id` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `erp_brand`
--

INSERT INTO `erp_brand` (`id`, `brands`, `status`, `firm_id`, `created_by`, `created_date`) VALUES
(1, 'FYBROS', 1, 1, 1, '2019-04-17 13:00:23'),
(2, 'OTHER', 1, 1, 1, '2019-04-17 13:00:24'),
(3, 'ASTRAL', 1, 1, 1, '2019-04-17 13:00:24'),
(4, 'ASHIRVAD', 1, 1, 1, '2019-04-17 13:00:24'),
(5, 'A SQUARE', 1, 1, 1, '2019-04-17 13:00:24'),
(6, 'FUTURA', 1, 1, 1, '2019-04-17 13:00:24'),
(7, 'GREEN', 1, 1, 1, '2019-04-17 13:00:24'),
(8, 'RAYZ', 1, 1, 1, '2019-04-17 13:00:24'),
(9, 'PRESS', 1, 1, 1, '2019-04-17 13:00:24'),
(10, 'KUNDAN', 1, 1, 1, '2019-04-17 13:00:24'),
(11, 'PRINCE', 1, 1, 1, '2019-04-17 13:00:24'),
(12, 'AJEET', 1, 1, 1, '2019-04-17 13:00:25'),
(13, 'CORAL', 1, 1, 1, '2019-04-17 13:00:25'),
(14, 'AV MODULAR', 1, 1, 1, '2019-04-17 13:00:25'),
(15, 'ARINA', 1, 1, 1, '2019-04-17 13:00:28'),
(16, 'GERMA', 1, 1, 1, '2019-04-17 13:00:28'),
(17, 'LIGHT', 1, 1, 1, '2019-04-17 13:00:28'),
(18, 'RR', 1, 1, 1, '2019-04-17 13:00:28'),
(19, 'CERA', 1, 1, 1, '2019-04-17 13:00:28'),
(20, 'CARYSIL', 1, 1, 1, '2019-04-17 13:00:29'),
(21, 'RAJCO', 1, 1, 1, '2019-04-17 13:00:29'),
(22, 'CEILING LIGHT', 1, 1, 1, '2019-04-17 13:00:29'),
(23, 'HAVELLS', 1, 1, 1, '2019-04-17 13:00:29'),
(24, 'PRAYAG', 1, 1, 1, '2019-04-17 13:00:29'),
(25, 'CHIRAG', 1, 1, 1, '2019-04-17 13:00:29'),
(26, 'CROMPTON', 1, 1, 1, '2019-04-17 13:00:30'),
(27, '', 1, 1, 1, '2019-04-17 13:00:30'),
(28, 'GPL', 1, 1, 1, '2019-04-17 13:00:30'),
(29, 'CKM', 1, 1, 1, '2019-04-17 13:00:31'),
(30, 'STANDARD', 1, 1, 1, '2019-04-17 13:00:31'),
(31, 'DOOM LIGHT', 1, 1, 1, '2019-04-17 13:00:31'),
(32, 'JENE GOLD', 1, 1, 1, '2019-04-17 13:00:32'),
(33, 'MEERAKUNJ', 1, 1, 1, '2019-04-17 13:00:32'),
(34, 'FINOLEX', 1, 1, 1, '2019-04-17 13:00:32'),
(35, 'JET', 1, 1, 1, '2019-04-17 13:00:32'),
(36, 'DN', 1, 1, 1, '2019-04-17 13:00:33'),
(37, 'GATE LIGHT', 1, 1, 1, '2019-04-17 13:00:34'),
(38, 'DECORA', 1, 1, 1, '2019-04-17 13:00:34'),
(39, 'GOLD MEDAL', 1, 1, 1, '2019-04-17 13:00:34'),
(40, 'HANGING LIGHT', 1, 1, 1, '2019-04-17 13:00:38'),
(41, 'GANGA', 1, 1, 1, '2019-04-17 13:00:38'),
(42, 'HPL', 1, 1, 1, '2019-04-17 13:00:38'),
(43, 'HINDWARE', 1, 1, 1, '2019-04-17 13:00:38'),
(44, 'DEER', 1, 1, 1, '2019-04-17 13:00:39'),
(45, 'JAQUAR', 1, 1, 1, '2019-04-17 13:00:39'),
(46, 'JOHNSON', 1, 1, 1, '2019-04-17 13:00:40'),
(47, 'LEGRAND', 1, 1, 1, '2019-04-17 13:00:43'),
(48, 'WALL LIGHT', 1, 1, 1, '2019-04-17 13:00:45'),
(49, 'LUKER', 1, 1, 1, '2019-04-17 13:00:45'),
(50, 'MIRROR LIGHT', 1, 1, 1, '2019-04-17 13:00:46'),
(51, 'ORIENT', 1, 1, 1, '2019-04-17 13:00:46'),
(52, 'PARRYWARE', 1, 1, 1, '2019-04-17 13:00:46'),
(53, 'PHILIPS', 1, 1, 1, '2019-04-17 13:00:46'),
(54, 'POLYCAP', 1, 1, 1, '2019-04-17 13:00:46'),
(55, 'TATA', 1, 1, 1, '2019-04-17 13:00:46'),
(56, 'STAINA', 1, 1, 1, '2019-04-17 13:00:46'),
(57, 'CHETAK', 1, 1, 1, '2019-04-17 13:00:47'),
(58, 'ROEWIN', 1, 1, 1, '2019-04-17 13:00:47'),
(59, 'XPERT', 1, 1, 1, '2019-04-17 13:00:48'),
(60, 'STAR', 1, 1, 1, '2019-04-17 13:00:48'),
(61, 'SCHNEIDER', 1, 1, 1, '2019-04-17 13:00:49'),
(62, 'EXCELO', 1, 1, 1, '2019-04-17 13:00:49'),
(63, 'ARROW', 1, 1, 1, '2019-04-17 13:00:49'),
(64, 'STREET LIGHT', 1, 1, 1, '2019-04-17 13:00:49'),
(65, 'SOMANY', 1, 1, 1, '2019-04-17 13:00:49'),
(66, 'SONET', 1, 1, 1, '2019-04-17 13:03:00'),
(67, 'DIAMONT', 1, 1, 1, '2019-04-17 13:03:00'),
(68, 'SURYA', 1, 1, 1, '2019-04-17 13:03:00'),
(69, 'UP-DOWN', 1, 1, 1, '2019-04-17 13:03:01'),
(70, 'TIGER', 1, 1, 1, '2019-04-17 13:03:02'),
(71, 'CUMI', 1, 1, 1, '2019-04-17 13:03:02'),
(72, 'AMOGHA', 1, 1, 1, '2019-04-17 13:03:02'),
(73, '', 1, 4, 1, '2019-04-17 13:08:33'),
(74, 'SRI AANDAL', 1, 2, 1, '2019-04-17 13:13:19'),
(75, 'OTHER', 1, 2, 1, '2019-04-17 13:13:19'),
(76, 'DR.FIXIT', 1, 2, 1, '2019-04-17 13:13:19'),
(77, 'WILLSON', 1, 2, 1, '2019-04-17 13:13:19'),
(78, 'UDHAYA', 1, 2, 1, '2019-04-17 13:13:19'),
(79, 'PADMASHRI', 1, 2, 1, '2019-04-17 13:13:19'),
(80, 'AATHAVAN', 1, 2, 1, '2019-04-17 13:13:19'),
(81, 'ASIAN', 1, 2, 1, '2019-04-17 13:13:20'),
(82, 'NIPPON', 1, 2, 1, '2019-04-17 13:13:21'),
(83, 'AGSAR', 1, 2, 1, '2019-04-17 13:13:21'),
(84, 'BERGER', 1, 2, 1, '2019-04-17 13:13:23'),
(85, 'BIRLA', 1, 2, 1, '2019-04-17 13:13:23'),
(86, 'JAYAM', 1, 2, 1, '2019-04-17 13:13:23'),
(87, 'SHEENLAC', 1, 2, 1, '2019-04-17 13:13:23'),
(88, 'SAI', 1, 2, 1, '2019-04-17 13:13:24'),
(89, 'FEVICOL', 1, 2, 1, '2019-04-17 13:13:24'),
(90, 'SUPREME', 1, 2, 1, '2019-04-17 13:13:24'),
(91, 'DULUX', 1, 2, 1, '2019-04-17 13:13:24'),
(92, 'SURFA COATS', 1, 2, 1, '2019-04-17 13:13:24'),
(93, 'FIXON', 1, 2, 1, '2019-04-17 13:13:24'),
(94, '', 1, 2, 1, '2019-04-17 13:13:24'),
(95, 'HB', 1, 2, 1, '2019-04-17 13:13:24'),
(96, 'ARALDITE', 1, 2, 1, '2019-04-17 13:13:24'),
(97, 'MRF', 1, 2, 1, '2019-04-17 13:13:24'),
(98, 'WINLAC', 1, 2, 1, '2019-04-17 13:13:25'),
(99, 'MALLI', 1, 2, 1, '2019-04-17 13:13:25'),
(100, 'RKC', 1, 2, 1, '2019-04-17 13:13:25'),
(101, 'JOTHI', 1, 2, 1, '2019-04-17 13:13:25'),
(102, 'SCOTTLAND', 1, 2, 1, '2019-04-17 13:13:25'),
(103, 'UROPLAST', 1, 2, 1, '2019-04-17 13:13:27'),
(104, '', 1, 3, 1, '2019-04-17 13:15:52'),
(105, 'DURAL', 1, 3, 1, '2019-04-17 13:15:52'),
(106, 'BONZER', 1, 3, 1, '2019-04-17 13:15:52'),
(107, 'CYBER', 1, 3, 1, '2019-04-17 13:15:53'),
(108, 'CITY', 1, 3, 1, '2019-04-17 13:15:53'),
(109, 'JL', 1, 3, 1, '2019-04-17 13:15:53'),
(110, 'JOHNSON', 1, 3, 1, '2019-04-17 13:15:53'),
(111, 'KOHINOOR', 1, 3, 1, '2019-04-17 13:15:53'),
(112, 'SUNMARK', 1, 3, 1, '2019-04-17 13:15:53'),
(113, 'SOMANY', 1, 3, 1, '2019-04-17 13:15:53'),
(114, 'SPENZEN', 1, 3, 1, '2019-04-17 13:15:54'),
(115, 'SOLENZO', 1, 3, 1, '2019-04-17 13:15:55'),
(116, 'SYSKA LED1', 1, 1, 1, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `erp_budget`
--

CREATE TABLE `erp_budget` (
  `id` int(11) NOT NULL,
  `firm_id` int(11) NOT NULL,
  `vc_no` varchar(60) NOT NULL,
  `budget_name` varchar(60) NOT NULL,
  `estimated_bud_cost` varchar(50) NOT NULL,
  `net_total` float NOT NULL,
  `remarks` varchar(250) NOT NULL,
  `from_date` date NOT NULL,
  `to_date` date NOT NULL,
  `created_date` date NOT NULL,
  `created_by` int(11) NOT NULL,
  `estatus` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `erp_budget_details`
--

CREATE TABLE `erp_budget_details` (
  `id` int(11) NOT NULL,
  `bd_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `customer` varchar(150) DEFAULT NULL,
  `amount` float NOT NULL,
  `created_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `erp_cash_out_flow`
--

CREATE TABLE `erp_cash_out_flow` (
  `id` int(11) NOT NULL,
  `firm_id` int(11) NOT NULL,
  `user_name` varchar(60) DEFAULT NULL,
  `sender_firm_id` int(11) NOT NULL,
  `sender_name` varchar(50) NOT NULL,
  `mobile_number` int(12) NOT NULL,
  `amount_type` enum('cash','credit') NOT NULL,
  `cash_out` float(7,2) NOT NULL,
  `cash_in` float(7,2) NOT NULL,
  `balance` float(7,2) NOT NULL,
  `payment_status` enum('pending','completed') NOT NULL,
  `remarks` varchar(100) NOT NULL,
  `is_force_pay` int(11) NOT NULL DEFAULT '0',
  `created_date` datetime NOT NULL,
  `updated_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `erp_cash_out_flow_history`
--

CREATE TABLE `erp_cash_out_flow_history` (
  `id` int(11) NOT NULL,
  `cash_out_id` int(11) NOT NULL,
  `amount_in` float(7,2) NOT NULL,
  `remarks` varchar(100) NOT NULL,
  `created_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `erp_category`
--

CREATE TABLE `erp_category` (
  `cat_id` int(11) NOT NULL,
  `categoryName` varchar(80) NOT NULL,
  `eStatus` int(11) NOT NULL DEFAULT '1',
  `firm_id` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `createdDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `erp_category`
--

INSERT INTO `erp_category` (`cat_id`, `categoryName`, `eStatus`, `firm_id`, `created_by`, `createdDate`) VALUES
(1, 'KUNDAN CABLES', 1, 1, 1, '2019-04-17 07:30:23'),
(2, 'PLATES', 1, 1, 1, '2019-04-17 07:30:23'),
(3, 'CPVC SOLVENT', 1, 1, 1, '2019-04-17 07:30:24'),
(4, 'PANEL LIGHTS', 1, 1, 1, '2019-04-17 07:30:24'),
(5, 'ELECTRIC MATERIALS', 1, 1, 1, '2019-04-17 07:30:24'),
(6, 'SCREW ITEM', 1, 1, 1, '2019-04-17 07:30:24'),
(7, 'PVC PIPES', 1, 1, 1, '2019-04-17 07:30:24'),
(8, 'UPVC', 1, 1, 1, '2019-04-17 07:30:24'),
(9, 'ELECTRIC PIPES', 1, 1, 1, '2019-04-17 07:30:24'),
(10, 'JAGUAR LED LIGHT', 1, 1, 1, '2019-04-17 07:30:24'),
(11, 'KUNDAN', 1, 1, 1, '2019-04-17 07:30:24'),
(12, 'AJEET TAPS', 1, 1, 1, '2019-04-17 07:30:25'),
(13, 'CORAL TAPS', 1, 1, 1, '2019-04-17 07:30:25'),
(14, 'AV SHEETS', 1, 1, 1, '2019-04-17 07:30:25'),
(15, 'AV SWITCHES', 1, 1, 1, '2019-04-17 07:30:25'),
(16, 'BOWL BASIN', 1, 1, 1, '2019-04-17 07:30:28'),
(17, '', 1, 1, 1, '2019-04-17 07:30:28'),
(18, 'RR CABLES', 1, 1, 1, '2019-04-17 07:30:28'),
(19, 'CERA SANITARY', 1, 1, 1, '2019-04-17 07:30:28'),
(20, 'CHIMNEY', 1, 1, 1, '2019-04-17 07:30:29'),
(21, 'SWITCHES', 1, 1, 1, '2019-04-17 07:30:29'),
(22, 'CLAMPS', 1, 1, 1, '2019-04-17 07:30:29'),
(23, 'WOOD BOX CONCILD', 1, 1, 1, '2019-04-17 07:30:29'),
(24, 'CONECTER HOSE PRAYAG', 1, 1, 1, '2019-04-17 07:30:29'),
(25, 'CABINET', 1, 1, 1, '2019-04-17 07:30:29'),
(26, 'TOWEL ROD SET', 1, 1, 1, '2019-04-17 07:30:29'),
(27, 'CPVC PIPES', 1, 1, 1, '2019-04-17 07:30:30'),
(28, 'CROMPTON FAN', 1, 1, 1, '2019-04-17 07:30:30'),
(29, 'HAVELLS & STANDARD MCB', 1, 1, 1, '2019-04-17 07:30:31'),
(30, 'BATH FITTINGS', 1, 1, 1, '2019-04-17 07:30:32'),
(31, 'FINOLEX PIPES', 1, 1, 1, '2019-04-17 07:30:32'),
(32, 'FYBROS', 1, 1, 1, '2019-04-17 07:30:32'),
(33, 'GI PIPES', 1, 1, 1, '2019-04-17 07:30:33'),
(34, 'GOLD MEDAL', 1, 1, 1, '2019-04-17 07:30:34'),
(35, 'HASHA BLADE', 1, 1, 1, '2019-04-17 07:30:36'),
(36, 'HEATERS', 1, 1, 1, '2019-04-17 07:30:36'),
(37, 'HAVELLS SWITCHES', 1, 1, 1, '2019-04-17 07:30:36'),
(38, 'HPL SWITCHES', 1, 1, 1, '2019-04-17 07:30:38'),
(39, 'HINDWARE SANITARY', 1, 1, 1, '2019-04-17 07:30:38'),
(40, 'HINDWARE EWC', 1, 1, 1, '2019-04-17 07:30:39'),
(41, 'INSULATION TAPES', 1, 1, 1, '2019-04-17 07:30:39'),
(42, 'JAQUAR LED LIGHT', 1, 1, 1, '2019-04-17 07:30:39'),
(43, 'JOHNSON TAPS', 1, 1, 1, '2019-04-17 07:30:40'),
(44, 'JOHNSON SANITARY', 1, 1, 1, '2019-04-17 07:30:40'),
(45, 'JAGUAR TAPS', 1, 1, 1, '2019-04-17 07:30:40'),
(46, 'JAGUAR SANITARY', 1, 1, 1, '2019-04-17 07:30:40'),
(47, 'LED LIGHT', 1, 1, 1, '2019-04-17 07:30:43'),
(48, 'LEGRAND SWITCHES', 1, 1, 1, '2019-04-17 07:30:43'),
(49, 'LEGRAND PLATES', 1, 1, 1, '2019-04-17 07:30:43'),
(50, 'LUKER', 1, 1, 1, '2019-04-17 07:30:45'),
(51, 'LED TUBE LIGHT', 1, 1, 1, '2019-04-17 07:30:45'),
(52, 'GATE LIGHT', 1, 1, 1, '2019-04-17 07:30:45'),
(53, 'SHEETS & BOARDS', 1, 1, 1, '2019-04-17 07:30:45'),
(54, 'MIRROR CABINET', 1, 1, 1, '2019-04-17 07:30:45'),
(55, 'ORIENT FANS', 1, 1, 1, '2019-04-17 07:30:46'),
(56, 'SANITARYWARE', 1, 1, 1, '2019-04-17 07:30:46'),
(57, 'PHILIPS LED LIGHT', 1, 1, 1, '2019-04-17 07:30:46'),
(58, 'POLYCAP FAN', 1, 1, 1, '2019-04-17 07:30:46'),
(59, 'SINKS', 1, 1, 1, '2019-04-17 07:30:46'),
(60, 'SINK', 1, 1, 1, '2019-04-17 07:30:48'),
(61, 'CALLING BELLS', 1, 1, 1, '2019-04-17 07:30:48'),
(62, 'SHOW LIGHTS', 1, 1, 1, '2019-04-17 07:30:48'),
(63, 'SNEIDER', 1, 1, 1, '2019-04-17 07:30:49'),
(64, 'CFL LIGHTS', 1, 1, 1, '2019-04-17 07:30:49'),
(65, 'SOMANY TAPS', 1, 1, 1, '2019-04-17 07:30:49'),
(66, 'SOMANY SANITARY', 1, 1, 1, '2019-04-17 07:30:49'),
(67, 'SM-BOTTLE TRAP', 1, 1, 1, '2019-04-17 07:32:56'),
(68, 'SHOWER SET', 1, 1, 1, '2019-04-17 07:32:57'),
(69, 'SM-HEALTH FAUCET', 1, 1, 1, '2019-04-17 07:32:59'),
(70, 'SONET SANITARY', 1, 1, 1, '2019-04-17 07:33:00'),
(71, 'TUBE LIGHT', 1, 1, 1, '2019-04-17 07:33:00'),
(72, 'UP DOWNS', 1, 1, 1, '2019-04-17 07:33:02'),
(73, 'PIPE', 1, 4, 1, '2019-04-17 07:38:33'),
(74, 'ALDROPS', 1, 4, 1, '2019-04-17 07:38:33'),
(75, 'ANTIQUE SCREW', 1, 4, 1, '2019-04-17 07:38:34'),
(76, 'ARALDITE', 1, 4, 1, '2019-04-17 07:38:34'),
(77, 'AUTO HINGES', 1, 4, 1, '2019-04-17 07:38:34'),
(78, 'HINGES', 1, 4, 1, '2019-04-17 07:38:34'),
(79, 'BATH HANDLE', 1, 4, 1, '2019-04-17 07:38:35'),
(80, 'BABY LATCH', 1, 4, 1, '2019-04-17 07:38:35'),
(81, 'PLYWOOD', 1, 4, 1, '2019-04-17 07:38:35'),
(82, '', 1, 4, 1, '2019-04-17 07:38:35'),
(83, 'Lock', 1, 4, 1, '2019-04-17 07:38:35'),
(84, 'BOX LOCK', 1, 4, 1, '2019-04-17 07:38:35'),
(85, 'NILES 1', 1, 4, 1, '2019-04-17 07:38:35'),
(86, 'BRASS SCREW', 1, 4, 1, '2019-04-17 07:38:35'),
(87, 'BUSH', 1, 4, 1, '2019-04-17 07:38:36'),
(88, 'CABLE MANAGER', 1, 4, 1, '2019-04-17 07:38:36'),
(89, 'CURTAIN BRACKETS', 1, 4, 1, '2019-04-17 07:38:36'),
(90, 'CD PAPER', 1, 4, 1, '2019-04-17 07:38:36'),
(91, 'L BRACKETS', 1, 4, 1, '2019-04-17 07:38:37'),
(92, 'CUP BOARD HANDLE', 1, 4, 1, '2019-04-17 07:38:37'),
(93, 'ALLIED HANDLES', 1, 4, 1, '2019-04-17 07:38:37'),
(94, 'HANOI CUB BOARD HANDLES', 1, 4, 1, '2019-04-17 07:38:38'),
(95, 'S-TEAM HANDLES', 1, 4, 1, '2019-04-17 07:38:38'),
(96, 'CHIMNEYS', 1, 4, 1, '2019-04-17 07:38:39'),
(97, 'CLOTH HOOKS', 1, 4, 1, '2019-04-17 07:38:39'),
(98, 'BATH FITTING', 1, 4, 1, '2019-04-17 07:38:39'),
(99, 'CSK SCREW', 1, 4, 1, '2019-04-17 07:38:39'),
(100, 'CHEST HANDLES', 1, 4, 1, '2019-04-17 07:38:39'),
(101, 'MISC', 1, 4, 1, '2019-04-17 07:38:39'),
(102, 'Mortic Lock', 1, 4, 1, '2019-04-17 07:38:39'),
(103, 'D BRACKETS', 1, 4, 1, '2019-04-17 07:38:39'),
(104, 'FLOOR SPRING', 1, 4, 1, '2019-04-17 07:38:39'),
(105, 'Traded Goods', 1, 4, 1, '2019-04-17 07:38:39'),
(106, 'DOOR HANDLE', 1, 4, 1, '2019-04-17 07:38:39'),
(107, 'DORSET ROSE HANDLE', 1, 4, 1, '2019-04-17 07:38:40'),
(108, 'DORSET KABA', 1, 4, 1, '2019-04-17 07:38:40'),
(109, 'MAGNET', 1, 4, 1, '2019-04-17 07:38:42'),
(110, 'DOOR EYE LENS', 1, 4, 1, '2019-04-17 07:38:42'),
(111, 'DOOR CLOSERS', 1, 4, 1, '2019-04-17 07:38:42'),
(112, 'DOORS', 1, 4, 1, '2019-04-17 07:38:42'),
(113, 'FEVICOL', 1, 4, 1, '2019-04-17 07:38:42'),
(114, 'DOOR STOPPER', 1, 4, 1, '2019-04-17 07:38:43'),
(115, 'EDGE BAND', 1, 4, 1, '2019-04-17 07:38:43'),
(116, 'EUROPA LOCK', 1, 4, 1, '2019-04-17 07:38:43'),
(117, 'F BRACKETS', 1, 4, 1, '2019-04-17 07:38:43'),
(118, 'FISHER', 1, 4, 1, '2019-04-17 07:38:43'),
(119, 'Folding Bracket', 1, 4, 1, '2019-04-17 07:38:43'),
(120, 'GATE HOOKS', 1, 4, 1, '2019-04-17 07:38:43'),
(121, 'GATE HOOK', 1, 4, 1, '2019-04-17 07:38:44'),
(122, 'GLASS LOCKS', 1, 4, 1, '2019-04-17 07:38:44'),
(123, 'GLASS STUD', 1, 4, 1, '2019-04-17 07:38:44'),
(124, 'GLASS HINGES', 1, 4, 1, '2019-04-17 07:38:44'),
(125, 'GLASS RUNNERS', 1, 4, 1, '2019-04-17 07:38:44'),
(126, 'PALAM LOCK', 1, 4, 1, '2019-04-17 07:38:45'),
(127, 'GODREJ LOCK', 1, 4, 1, '2019-04-17 07:38:45'),
(128, 'MULTI PURPOSECUP BOARD LOCK', 1, 4, 1, '2019-04-17 07:38:45'),
(129, 'DOOR LOCKS', 1, 4, 1, '2019-04-17 07:38:46'),
(130, 'BEADINGS', 1, 4, 1, '2019-04-17 07:38:46'),
(131, 'KITCHEN SS JALLI', 1, 4, 1, '2019-04-17 07:38:46'),
(132, 'KEY HOLDER', 1, 4, 1, '2019-04-17 07:38:46'),
(133, 'KNOBS', 1, 4, 1, '2019-04-17 07:38:46'),
(134, 'Ms Screw', 1, 4, 1, '2019-04-17 07:38:46'),
(135, 'DOOR MAGNET', 1, 4, 1, '2019-04-17 07:38:46'),
(136, 'MORTICE HANDLE', 1, 4, 1, '2019-04-17 07:38:47'),
(137, 'MORTIC HANDLE', 1, 4, 1, '2019-04-17 07:38:47'),
(138, 'SPIDER LOCKS', 1, 4, 1, '2019-04-17 07:38:48'),
(139, 'NAKODA', 1, 4, 1, '2019-04-17 07:38:48'),
(140, 'PAN SCREW', 1, 4, 1, '2019-04-17 07:38:48'),
(141, 'PIPE BRACKETS', 1, 4, 1, '2019-04-17 07:38:49'),
(142, 'PC SCREWS', 1, 4, 1, '2019-04-17 07:38:49'),
(143, 'PHILIPS HEAD SCREW', 1, 4, 1, '2019-04-17 07:38:49'),
(144, 'PLATE RINGS', 1, 4, 1, '2019-04-17 07:38:49'),
(145, 'BATHROOM ACCESSORIES', 1, 4, 1, '2019-04-17 07:38:49'),
(146, 'GLASS VACUME BUSH', 1, 4, 1, '2019-04-17 07:38:49'),
(147, 'ROSE HANDLE', 1, 4, 1, '2019-04-17 07:38:51'),
(148, 'DORSET LEVER ON ROSE HANDLE', 1, 4, 1, '2019-04-17 07:38:51'),
(149, 'DORSET MORTICE LOCK', 1, 4, 1, '2019-04-17 07:38:51'),
(150, 'SOAP DISH', 1, 4, 1, '2019-04-17 07:38:51'),
(151, 'BRACKETS', 1, 4, 1, '2019-04-17 07:38:51'),
(152, 'SS SCREW', 1, 4, 1, '2019-04-17 07:38:51'),
(153, 'TOWER BOLTS', 1, 4, 1, '2019-04-17 07:38:52'),
(154, 'TOWER BOLT', 1, 4, 1, '2019-04-17 07:38:52'),
(155, 'TELESCOPIC CHANNELS', 1, 4, 1, '2019-04-17 07:38:53'),
(156, 'TOWEL ROD', 1, 4, 1, '2019-04-17 07:38:54'),
(157, 'PEAK TUBULAR LOCK', 1, 4, 1, '2019-04-17 07:38:54'),
(158, 'TURN BUTTONS', 1, 4, 1, '2019-04-17 07:38:54'),
(159, 'WHEEL', 1, 4, 1, '2019-04-17 07:38:54'),
(160, 'WOOD SCREW', 1, 4, 1, '2019-04-17 07:38:54'),
(161, 'WINDOW STAY', 1, 4, 1, '2019-04-17 07:38:55'),
(162, '', 1, 2, 1, '2019-04-17 07:43:19'),
(163, 'NIPPON ', 1, 3, 1, '2019-05-08 09:19:59'),
(164, '12*18', 1, 3, 1, '2019-04-17 07:45:52'),
(165, 'BEADING', 1, 3, 1, '2019-04-17 07:45:52'),
(166, '800*800', 1, 3, 1, '2019-04-17 07:45:52'),
(167, '3*1', 1, 3, 1, '2019-04-17 07:45:52'),
(168, '2*1', 1, 3, 1, '2019-04-17 07:45:52'),
(169, '10*16', 1, 3, 1, '2019-04-17 07:45:52'),
(170, '4*2', 1, 3, 1, '2019-04-17 07:45:53'),
(171, '1*1', 1, 3, 1, '2019-04-17 07:45:53'),
(172, '2*2', 1, 3, 1, '2019-04-17 07:45:53'),
(173, '800*1200', 1, 3, 1, '2019-04-17 07:45:53'),
(174, '10*15', 1, 3, 1, '2019-04-17 07:45:54'),
(175, 'asian', 1, 2, 1, '2019-05-08 09:20:48'),
(176, '', 0, 3, 1, '2019-10-08 09:44:20'),
(177, 'sd', 0, 1, 1, '2019-10-11 07:55:07'),
(178, 'sd', 0, 2, 1, '2019-10-11 07:54:55'),
(179, 'fgfbh', 0, 1, 1, '2019-10-11 09:26:46'),
(180, 'n', 0, 1, 1, '2019-10-11 09:27:42'),
(181, 'n', 0, 1, 1, '2019-10-11 09:27:22'),
(182, 'Asian ', 1, 1, 1, '2019-10-11 10:06:54');

-- --------------------------------------------------------

--
-- Table structure for table `erp_category_sub_category`
--

CREATE TABLE `erp_category_sub_category` (
  `id` int(11) NOT NULL,
  `cat_id` int(11) NOT NULL,
  `actionId` int(11) NOT NULL,
  `status` int(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `erp_company_amount`
--

CREATE TABLE `erp_company_amount` (
  `id` int(11) NOT NULL,
  `receiver_type` varchar(255) NOT NULL,
  `receipt_id` varchar(120) NOT NULL,
  `recevier_id` int(120) NOT NULL,
  `recevier` enum('company','agent') NOT NULL,
  `bill_amount` float DEFAULT NULL,
  `type` enum('credit','debit') NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `erp_delivery_challan`
--

CREATE TABLE `erp_delivery_challan` (
  `id` int(11) NOT NULL,
  `dc_no` varchar(60) NOT NULL,
  `customer` int(11) NOT NULL,
  `total_qty` int(11) NOT NULL,
  `tax_label` varchar(120) NOT NULL,
  `tax` float NOT NULL,
  `subtotal_qty` float NOT NULL,
  `net_total` float NOT NULL,
  `discount` int(11) DEFAULT NULL,
  `remarks` varchar(250) NOT NULL,
  `created_date` date NOT NULL,
  `created_by` int(11) NOT NULL,
  `estatus` tinyint(1) NOT NULL DEFAULT '1',
  `firm_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `erp_delivery_challan_details`
--

CREATE TABLE `erp_delivery_challan_details` (
  `id` int(11) NOT NULL,
  `dc_id` int(11) NOT NULL,
  `category` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_description` varchar(255) DEFAULT NULL,
  `type` enum('product','service') NOT NULL,
  `brand` int(11) NOT NULL,
  `quantity` int(4) NOT NULL,
  `per_cost` float NOT NULL,
  `tax` float NOT NULL,
  `gst` float NOT NULL,
  `sub_total` float NOT NULL,
  `created_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `erp_enquiry`
--

CREATE TABLE `erp_enquiry` (
  `id` int(11) NOT NULL,
  `enquiry_no` varchar(11) NOT NULL,
  `customer_name` varchar(70) NOT NULL,
  `customer_address` varchar(250) NOT NULL,
  `customer_email` varchar(70) NOT NULL,
  `contact_number` varchar(120) NOT NULL,
  `enquiry_about` varchar(250) NOT NULL,
  `remarks` varchar(250) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `followup_date` date NOT NULL,
  `created_by` int(11) NOT NULL,
  `status` enum('Pending','Completed','Reject') NOT NULL DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `erp_invoice`
--

CREATE TABLE `erp_invoice` (
  `id` int(11) NOT NULL,
  `inv_id` varchar(125) NOT NULL,
  `q_id` int(11) NOT NULL DEFAULT '0',
  `firm_id` int(11) NOT NULL,
  `customer` int(11) NOT NULL,
  `sales_man` int(50) DEFAULT NULL,
  `contract_customer` int(11) NOT NULL DEFAULT '0',
  `total_qty` decimal(10,2) NOT NULL,
  `delivery_qty` decimal(10,2) NOT NULL,
  `tax_label` varchar(120) NOT NULL,
  `tax` float NOT NULL,
  `cgst_price` float(10,2) NOT NULL,
  `igst_price` float(10,2) NOT NULL,
  `taxable_price` float(10,2) NOT NULL,
  `subtotal_qty` float NOT NULL,
  `net_total` float NOT NULL,
  `round_off` float(7,2) NOT NULL,
  `transport` float(7,2) NOT NULL,
  `labour` float(7,2) NOT NULL,
  `commission_rate` decimal(12,2) DEFAULT NULL,
  `ref_name` int(11) NOT NULL,
  `remarks` varchar(120) NOT NULL,
  `customer_po` varchar(120) NOT NULL,
  `bill_type` enum('cash','credit') NOT NULL,
  `created_date` date NOT NULL,
  `credit_due_date` date NOT NULL,
  `credit_days` int(55) DEFAULT NULL,
  `credit_limit` varchar(50) DEFAULT NULL,
  `temp_credit_limit` varchar(50) DEFAULT NULL,
  `approved_by` int(55) DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `invoice_status` enum('waiting','approved') NOT NULL,
  `payment_status` enum('Pending','Completed') NOT NULL,
  `delivery_status` enum('pending','partially_delivered','delivered') NOT NULL,
  `estatus` tinyint(1) NOT NULL DEFAULT '1',
  `is_deleted` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `erp_invoice`
--

INSERT INTO `erp_invoice` (`id`, `inv_id`, `q_id`, `firm_id`, `customer`, `sales_man`, `contract_customer`, `total_qty`, `delivery_qty`, `tax_label`, `tax`, `cgst_price`, `igst_price`, `taxable_price`, `subtotal_qty`, `net_total`, `round_off`, `transport`, `labour`, `commission_rate`, `ref_name`, `remarks`, `customer_po`, `bill_type`, `created_date`, `credit_due_date`, `credit_days`, `credit_limit`, `temp_credit_limit`, `approved_by`, `created_by`, `invoice_status`, `payment_status`, `delivery_status`, `estatus`, `is_deleted`) VALUES
(1, 'INV0001', 0, 1, 7, 1, 0, '1.00', '1.00', '', 110, 50.00, 60.00, 0.00, 1000, 1110, 0.00, 0.00, 0.00, NULL, 0, '', '', 'cash', '2020-09-18', '2020-09-18', NULL, NULL, NULL, NULL, 1, 'approved', 'Pending', 'delivered', 1, 0),
(2, 'INV0002', 0, 1, 8, 1, 0, '4.00', '4.00', '', 220, 100.00, 120.00, 0.00, 2000, 2220, 0.00, 0.00, 0.00, NULL, 0, '', '', 'cash', '2020-09-18', '2020-09-18', NULL, NULL, NULL, NULL, 1, 'approved', 'Pending', 'delivered', 1, 0),
(3, 'INV0003', 0, 1, 9, 1, 0, '1.00', '1.00', '', 11, 5.00, 6.00, 89.00, 100, 100, 100.00, 0.00, 0.00, '0.00', 0, '', ' PO123', 'cash', '2020-09-18', '2020-09-18', NULL, NULL, NULL, NULL, 1, 'waiting', 'Pending', 'pending', 1, 0),
(4, 'INV002', 0, 1, 10, 1, 0, '6.00', '6.00', '', 316.25, 143.75, 172.50, 2558.75, 2875, 2875, 2875.00, 0.00, 0.00, NULL, 0, '', '123  ', 'cash', '2020-09-18', '2020-09-18', NULL, NULL, NULL, NULL, 1, 'approved', 'Pending', 'delivered', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `erp_invoice_details`
--

CREATE TABLE `erp_invoice_details` (
  `id` int(11) NOT NULL,
  `q_id` int(11) NOT NULL,
  `in_id` int(120) NOT NULL,
  `category` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_description` varchar(255) DEFAULT NULL,
  `product_type` enum('product','service') NOT NULL,
  `brand` int(11) NOT NULL,
  `unit` varchar(15) DEFAULT NULL,
  `quantity` decimal(10,2) NOT NULL DEFAULT '0.00',
  `delivery_quantity` int(11) NOT NULL,
  `return_quantity` int(11) NOT NULL DEFAULT '0',
  `customer_exists_qty` int(11) DEFAULT '0',
  `per_cost` float NOT NULL,
  `tax` float NOT NULL,
  `gst` float DEFAULT NULL,
  `igst` float DEFAULT NULL,
  `taxable_cost` float(10,2) NOT NULL,
  `discount` float DEFAULT NULL,
  `sub_total` float NOT NULL,
  `created_date` datetime NOT NULL,
  `is_deleted` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `erp_invoice_details`
--

INSERT INTO `erp_invoice_details` (`id`, `q_id`, `in_id`, `category`, `product_id`, `product_description`, `product_type`, `brand`, `unit`, `quantity`, `delivery_quantity`, `return_quantity`, `customer_exists_qty`, `per_cost`, `tax`, `gst`, `igst`, `taxable_cost`, `discount`, `sub_total`, `created_date`, `is_deleted`) VALUES
(1, 0, 1, 2, 1, NULL, 'product', 1, '1', '1.00', 1, 0, 0, 1000, 5, 0, 6, 0.00, 0, 1000, '2020-09-18 14:24:52', 0),
(2, 0, 2, 2, 1, NULL, 'product', 1, '1', '4.00', 4, 0, 0, 500, 5, 0, 6, 0.00, 0, 2000, '2020-09-18 15:17:11', 0),
(4, 0, 3, 2, 1, NULL, 'product', 1, '1', '1.00', 1, 0, 0, 100, 5, 0, 6, 89.00, 0, 100, '2020-09-18 19:19:27', 0),
(8, 0, 4, 2, 1, NULL, 'product', 1, '1', '5.00', 5, 0, 0, 555, 5, 0, 6, 493.95, 0, 2775, '2020-09-21 11:10:03', 0),
(9, 0, 4, 2, 1, NULL, 'product', 1, '1', '1.00', 1, 0, 0, 100, 5, 0, 6, 89.00, 0, 100, '2020-09-21 11:10:03', 0);

-- --------------------------------------------------------

--
-- Table structure for table `erp_invoice_product_details`
--

CREATE TABLE `erp_invoice_product_details` (
  `id` int(11) NOT NULL,
  `q_id` int(11) NOT NULL,
  `in_id` int(120) NOT NULL,
  `category` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_description` varchar(255) DEFAULT NULL,
  `product_type` enum('product','service') NOT NULL,
  `brand` int(11) NOT NULL,
  `unit` varchar(15) DEFAULT NULL,
  `quantity` decimal(10,2) NOT NULL DEFAULT '0.00',
  `delivery_quantity` int(11) NOT NULL,
  `customer_exists_qty` int(11) NOT NULL DEFAULT '0',
  `per_cost` float NOT NULL,
  `tax` float NOT NULL,
  `gst` float DEFAULT NULL,
  `igst` float DEFAULT NULL,
  `discount` float DEFAULT NULL,
  `sub_total` float NOT NULL,
  `created_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `erp_invoice_product_details`
--

INSERT INTO `erp_invoice_product_details` (`id`, `q_id`, `in_id`, `category`, `product_id`, `product_description`, `product_type`, `brand`, `unit`, `quantity`, `delivery_quantity`, `customer_exists_qty`, `per_cost`, `tax`, `gst`, `igst`, `discount`, `sub_total`, `created_date`) VALUES
(1, 1, 3, 2, 1, '', 'product', 1, '1', '1.00', 0, 0, 100, 5, 0, 6, 0, 100, '2020-09-18 17:24:00');

-- --------------------------------------------------------

--
-- Table structure for table `erp_manage_firms`
--

CREATE TABLE `erp_manage_firms` (
  `firm_id` int(11) NOT NULL,
  `firm_name` varchar(50) NOT NULL,
  `prefix` varchar(10) NOT NULL,
  `contact_person` varchar(50) NOT NULL,
  `mobile_number` varchar(13) NOT NULL,
  `email_id` varchar(100) NOT NULL,
  `pincode` varchar(7) NOT NULL,
  `address` varchar(250) NOT NULL,
  `gstin` varchar(20) NOT NULL,
  `status` int(11) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `erp_manage_firms`
--

INSERT INTO `erp_manage_firms` (`firm_id`, `firm_name`, `prefix`, `contact_person`, `mobile_number`, `email_id`, `pincode`, `address`, `gstin`, `status`, `created_date`) VALUES
(1, 'Marvell Tiles', 'M', 'Seyad', '0442858703', 'marveltile@gmail.com', '628204', 'No 25, Malayappan Street, Parrys, Chennai - 600001', '33AAOFT3699J1ZG', 1, '2020-09-18 05:32:32'),
(4, 'HARDWARES', 'H', 'Hardwares', '7200337260', 'total.kayal@gmail.com', '628204', '50Q - 50T, VANNAKUDI KADAI STREET, MAIN ROAD, KAYALPATNAM', '33AAOFT3699J1ZG', 1, '2019-04-09 05:11:47'),
(5, 'ACCOUNTS', 'A', 'Muthu Kumar', '9876543210', 'mail@mkumar.com', '628204', '50Q - 50T, VANNAKUDI KADAI STREET, MAIN ROAD, KAYALPATNAM', '33AAOFT3699J1ZG', 1, '2019-04-09 05:13:11'),
(6, 'HARDWARE', 'A', 'Abdul', '8963415263', 'abdul@gmail.com', '641002', 'h', '22AAAH234543j3333333', 1, '2019-05-08 03:31:28');

-- --------------------------------------------------------

--
-- Table structure for table `erp_notification`
--

CREATE TABLE `erp_notification` (
  `id` int(11) NOT NULL,
  `type` enum('min_qty','quotation','payment','purchase_payment','credit_days_exceeded','credit_limit_exceeded','invoice','purchase_request') NOT NULL,
  `receiver_id` text NOT NULL,
  `Message` varchar(250) NOT NULL,
  `link` varchar(100) NOT NULL,
  `notification_date` date NOT NULL,
  `due_date` date DEFAULT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `erp_notification`
--

INSERT INTO `erp_notification` (`id`, `type`, `receiver_id`, `Message`, `link`, `notification_date`, `due_date`, `created_date`, `status`) VALUES
(1, 'min_qty', '', 'Plates is in minimum stock', 'stock/', '2020-09-18', NULL, '2020-09-18 11:54:02', 0);

-- --------------------------------------------------------

--
-- Table structure for table `erp_order`
--

CREATE TABLE `erp_order` (
  `id` int(11) NOT NULL,
  `order_no` varchar(11) NOT NULL,
  `q_id` int(11) NOT NULL,
  `approved_by` int(11) NOT NULL,
  `created_date` datetime NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `erp_other_cost`
--

CREATE TABLE `erp_other_cost` (
  `id` int(11) NOT NULL,
  `j_id` varchar(120) NOT NULL,
  `item_name` varchar(120) NOT NULL,
  `amount` float NOT NULL,
  `type` varchar(120) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `erp_physical_stock`
--

CREATE TABLE `erp_physical_stock` (
  `id` int(11) NOT NULL,
  `shrinkage_id` int(11) NOT NULL,
  `firm_id` int(11) NOT NULL,
  `category` int(100) NOT NULL,
  `brand` int(100) DEFAULT NULL,
  `product_id` int(100) NOT NULL,
  `system_quantity` int(100) NOT NULL,
  `physical_quantity` int(100) NOT NULL,
  `entry_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `erp_po`
--

CREATE TABLE `erp_po` (
  `id` int(11) NOT NULL,
  `pr_no` varchar(20) NOT NULL,
  `po_no` varchar(20) NOT NULL,
  `supplier` int(11) NOT NULL,
  `total_qty` int(11) NOT NULL,
  `delivery_qty` int(11) NOT NULL,
  `tax_label` varchar(120) NOT NULL,
  `tax` float NOT NULL,
  `subtotal_qty` float NOT NULL,
  `net_total` float NOT NULL,
  `discount` int(11) DEFAULT NULL,
  `remarks` varchar(250) NOT NULL,
  `delivery_schedule` date NOT NULL,
  `mode_of_payment` varchar(11) NOT NULL,
  `created_date` date NOT NULL,
  `created_by` int(11) NOT NULL,
  `pr_status` enum('waiting','approved') DEFAULT NULL,
  `delivery_status` enum('pending','partially_delivered','delivered') NOT NULL,
  `payment_status` enum('Pending','Completed') NOT NULL DEFAULT 'Pending',
  `estatus` tinyint(1) NOT NULL DEFAULT '1',
  `firm_id` int(11) NOT NULL,
  `po_type` enum('cash','credit') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `erp_po_details`
--

CREATE TABLE `erp_po_details` (
  `id` int(11) NOT NULL,
  `po_id` int(11) NOT NULL,
  `category` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_description` varchar(255) DEFAULT NULL,
  `type` enum('product','service') NOT NULL,
  `brand` int(11) NOT NULL,
  `unit` varchar(15) DEFAULT NULL,
  `quantity` int(4) NOT NULL,
  `delivery_quantity` int(11) NOT NULL,
  `per_cost` float NOT NULL,
  `tax` float NOT NULL,
  `gst` float DEFAULT NULL,
  `igst` float DEFAULT NULL,
  `discount` float NOT NULL,
  `transport` float NOT NULL,
  `sub_total` float NOT NULL,
  `created_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `erp_pr`
--

CREATE TABLE `erp_pr` (
  `id` int(11) NOT NULL,
  `pr_no` varchar(20) NOT NULL,
  `po_no` varchar(20) NOT NULL,
  `po_id` int(11) NOT NULL,
  `supplier` int(11) NOT NULL,
  `total_qty` int(11) NOT NULL,
  `delivery_qty` int(11) NOT NULL,
  `tax_label` varchar(120) NOT NULL,
  `tax` float NOT NULL,
  `subtotal_qty` float NOT NULL,
  `net_total` float NOT NULL,
  `discount` int(11) DEFAULT NULL,
  `remarks` varchar(250) NOT NULL,
  `delivery_schedule` date NOT NULL,
  `mode_of_payment` varchar(11) NOT NULL,
  `created_date` date NOT NULL,
  `created_by` int(11) NOT NULL,
  `pr_status` enum('waiting','approved') DEFAULT NULL,
  `delivery_status` enum('pending','partially_delivered','delivered') NOT NULL,
  `payment_status` enum('Pending','Completed') NOT NULL DEFAULT 'Pending',
  `estatus` tinyint(1) NOT NULL DEFAULT '1',
  `firm_id` int(11) NOT NULL,
  `po_type` enum('cash','credit') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `erp_product`
--

CREATE TABLE `erp_product` (
  `id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `brand_id` int(11) NOT NULL,
  `model_no` varchar(250) NOT NULL,
  `product_name` varchar(250) NOT NULL,
  `barcode` varchar(60) NOT NULL,
  `product_description` varchar(250) NOT NULL,
  `product_image` varchar(250) NOT NULL,
  `type` enum('product','service') NOT NULL,
  `min_qty` int(11) NOT NULL,
  `qty` varchar(100) NOT NULL,
  `selling_price` int(120) NOT NULL,
  `reorder_quantity` int(11) NOT NULL,
  `cost_price` float NOT NULL,
  `cash_cus_price` float NOT NULL,
  `credit_cus_price` float NOT NULL,
  `cash_con_price` float NOT NULL,
  `credit_con_price` float NOT NULL,
  `vip_price` varchar(20) DEFAULT NULL,
  `vvip_price` varchar(20) DEFAULT NULL,
  `h1_price` float(7,2) NOT NULL,
  `h2_price` float(7,2) NOT NULL,
  `discount` float NOT NULL DEFAULT '0',
  `status` int(11) NOT NULL DEFAULT '1',
  `firm_id` int(11) NOT NULL,
  `unit` varchar(10) NOT NULL,
  `is_non_gst` tinyint(4) NOT NULL,
  `hsn_sac_name` varchar(60) NOT NULL,
  `hsn_sac` varchar(60) NOT NULL,
  `hsn_sac_rate` varchar(60) NOT NULL,
  `cgst` float(5,2) NOT NULL,
  `sgst` float(5,2) NOT NULL,
  `igst` float(5,2) NOT NULL,
  `expires_in` int(60) NOT NULL,
  `expired_date` date NOT NULL,
  `created_date` date NOT NULL,
  `created_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `erp_product`
--

INSERT INTO `erp_product` (`id`, `category_id`, `brand_id`, `model_no`, `product_name`, `barcode`, `product_description`, `product_image`, `type`, `min_qty`, `qty`, `selling_price`, `reorder_quantity`, `cost_price`, `cash_cus_price`, `credit_cus_price`, `cash_con_price`, `credit_con_price`, `vip_price`, `vvip_price`, `h1_price`, `h2_price`, `discount`, `status`, `firm_id`, `unit`, `is_non_gst`, `hsn_sac_name`, `hsn_sac`, `hsn_sac_rate`, `cgst`, `sgst`, `igst`, `expires_in`, `expired_date`, `created_date`, `created_by`) VALUES
(1, 2, 1, '', 'Plates', '', '', '', 'product', 1, '0', 0, 1, 0, 0, 0, 0, 0, '0', '0', 0.00, 0.00, 0, 1, 1, '1', 0, '', '123', '', 5.00, 5.00, 6.00, 0, '0000-00-00', '2020-09-18', 1);

-- --------------------------------------------------------

--
-- Table structure for table `erp_project_cost`
--

CREATE TABLE `erp_project_cost` (
  `id` int(11) NOT NULL,
  `job_id` varchar(125) NOT NULL,
  `ref_name` varchar(15) NOT NULL,
  `firm_id` int(11) NOT NULL,
  `customer` int(11) NOT NULL,
  `contract_customer` int(11) NOT NULL,
  `total_qty` int(11) NOT NULL,
  `tax_label` varchar(120) NOT NULL,
  `tax` float NOT NULL,
  `subtotal_qty` float NOT NULL,
  `net_total` float NOT NULL,
  `remarks` varchar(120) NOT NULL,
  `created_date` date NOT NULL,
  `created_by` int(11) NOT NULL,
  `notification_date` date NOT NULL,
  `q_no` varchar(120) NOT NULL,
  `inv_id` varchar(120) NOT NULL,
  `estatus` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `erp_project_details`
--

CREATE TABLE `erp_project_details` (
  `id` int(11) NOT NULL,
  `j_id` int(120) NOT NULL,
  `category` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_description` varchar(255) DEFAULT NULL,
  `product_type` enum('product','service') NOT NULL,
  `brand` int(11) NOT NULL,
  `unit` varchar(15) DEFAULT NULL,
  `quantity` int(4) NOT NULL,
  `per_cost` float NOT NULL,
  `tax` float NOT NULL,
  `gst` float DEFAULT NULL,
  `igst` float DEFAULT NULL,
  `discount` float NOT NULL,
  `sub_total` float NOT NULL,
  `created_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `erp_pr_details`
--

CREATE TABLE `erp_pr_details` (
  `id` int(11) NOT NULL,
  `po_id` int(11) NOT NULL,
  `pr_id` int(11) NOT NULL,
  `category` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_description` varchar(255) DEFAULT NULL,
  `type` enum('product','service') NOT NULL,
  `brand` int(11) NOT NULL,
  `unit` varchar(15) DEFAULT NULL,
  `quantity` int(4) NOT NULL DEFAULT '0',
  `delivery_qty` varchar(255) NOT NULL DEFAULT '0',
  `return_quantity` int(4) NOT NULL,
  `per_cost` float NOT NULL,
  `tax` float NOT NULL,
  `gst` float DEFAULT NULL,
  `igst` float DEFAULT NULL,
  `discount` float NOT NULL,
  `transport` float NOT NULL,
  `sub_total` float NOT NULL,
  `created_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `erp_quotation`
--

CREATE TABLE `erp_quotation` (
  `id` int(11) NOT NULL,
  `ref_name` varchar(125) NOT NULL,
  `q_no` varchar(20) NOT NULL,
  `firm_id` int(11) NOT NULL,
  `customer` int(11) NOT NULL,
  `total_qty` int(11) NOT NULL,
  `tax_label` varchar(120) NOT NULL,
  `tax` float NOT NULL,
  `subtotal_qty` float NOT NULL,
  `net_total` float NOT NULL,
  `discount` int(11) DEFAULT NULL,
  `remarks` varchar(250) NOT NULL,
  `delivery_schedule` date NOT NULL,
  `mode_of_payment` varchar(11) NOT NULL,
  `validity` varchar(120) NOT NULL,
  `type` enum('direct','indirect') NOT NULL,
  `created_date` date NOT NULL,
  `created_by` int(11) NOT NULL,
  `notification_date` date NOT NULL,
  `job_id` varchar(120) NOT NULL,
  `inv_id` varchar(20) NOT NULL,
  `estatus` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `erp_quotation`
--

INSERT INTO `erp_quotation` (`id`, `ref_name`, `q_no`, `firm_id`, `customer`, `total_qty`, `tax_label`, `tax`, `subtotal_qty`, `net_total`, `discount`, `remarks`, `delivery_schedule`, `mode_of_payment`, `validity`, `type`, `created_date`, `created_by`, `notification_date`, `job_id`, `inv_id`, `estatus`) VALUES
(1, '', 'QUO001', 1, 9, 1, '', 0, 111, 111, NULL, '', '1970-01-01', '', '', 'direct', '2020-09-18', 1, '1970-01-01', '', '', 2);

-- --------------------------------------------------------

--
-- Table structure for table `erp_quotation_details`
--

CREATE TABLE `erp_quotation_details` (
  `id` int(11) NOT NULL,
  `q_id` int(11) NOT NULL,
  `category` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_description` varchar(255) DEFAULT NULL,
  `type` enum('product','service') NOT NULL,
  `brand` int(11) NOT NULL,
  `unit` varchar(15) DEFAULT NULL,
  `quantity` int(4) NOT NULL,
  `per_cost` float NOT NULL,
  `tax` float NOT NULL,
  `gst` float DEFAULT NULL,
  `igst` float DEFAULT NULL,
  `discount` float NOT NULL,
  `sub_total` float NOT NULL,
  `created_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `erp_quotation_details`
--

INSERT INTO `erp_quotation_details` (`id`, `q_id`, `category`, `product_id`, `product_description`, `type`, `brand`, `unit`, `quantity`, `per_cost`, `tax`, `gst`, `igst`, `discount`, `sub_total`, `created_date`) VALUES
(1, 1, 2, 1, 'null', 'product', 1, '1', 1, 100, 5, 0, 6, 0, 111, '2020-09-18 17:23:00');

-- --------------------------------------------------------

--
-- Table structure for table `erp_quotation_history`
--

CREATE TABLE `erp_quotation_history` (
  `id` int(11) NOT NULL,
  `org_q_id` int(11) NOT NULL,
  `ref_name` varchar(125) NOT NULL,
  `q_no` varchar(11) NOT NULL,
  `firm_id` int(11) NOT NULL,
  `customer` int(11) NOT NULL,
  `total_qty` int(11) NOT NULL,
  `tax_label` varchar(125) NOT NULL,
  `tax` float NOT NULL,
  `subtotal_qty` float NOT NULL,
  `net_total` float NOT NULL,
  `discount` int(11) DEFAULT NULL,
  `remarks` varchar(11) NOT NULL,
  `delivery_schedule` date NOT NULL,
  `mode_of_payment` varchar(11) NOT NULL,
  `validity` varchar(120) NOT NULL,
  `type` enum('direct','indirect') NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_by` int(11) NOT NULL,
  `notification_date` date NOT NULL,
  `job_id` varchar(120) NOT NULL,
  `inv_id` varchar(20) NOT NULL,
  `estatus` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `erp_quotation_history_details`
--

CREATE TABLE `erp_quotation_history_details` (
  `id` int(11) NOT NULL,
  `h_id` int(11) NOT NULL,
  `org_q_id` int(11) NOT NULL,
  `category` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_description` varchar(255) NOT NULL,
  `type` enum('product','service') NOT NULL,
  `brand` int(11) NOT NULL,
  `unit` varchar(15) DEFAULT NULL,
  `quantity` int(4) NOT NULL,
  `per_cost` float NOT NULL,
  `tax` float NOT NULL,
  `gst` float NOT NULL,
  `igst` float NOT NULL,
  `discount` float NOT NULL,
  `sub_total` float NOT NULL,
  `created_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `erp_reference_groups`
--

CREATE TABLE `erp_reference_groups` (
  `id` int(11) NOT NULL,
  `firm_id` int(11) NOT NULL,
  `reference_type` int(5) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `others` varchar(50) DEFAULT NULL,
  `contact_person` varchar(60) NOT NULL,
  `email_id` varchar(60) NOT NULL,
  `mobil_number` varchar(13) NOT NULL,
  `address1` varchar(100) NOT NULL,
  `address2` varchar(100) NOT NULL,
  `city` varchar(255) NOT NULL,
  `state_id` int(55) NOT NULL,
  `bank_name` varchar(200) NOT NULL,
  `bank_branch` varchar(50) NOT NULL,
  `account_num` varchar(40) NOT NULL,
  `ifsc` varchar(20) NOT NULL,
  `agent_name` int(11) NOT NULL,
  `payment_terms` varchar(120) NOT NULL,
  `commission_rate` varchar(50) NOT NULL,
  `status` int(1) NOT NULL DEFAULT '1',
  `created_by` int(11) NOT NULL DEFAULT '1',
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `erp_sales_man`
--

CREATE TABLE `erp_sales_man` (
  `id` int(11) NOT NULL,
  `firm_id` int(11) NOT NULL,
  `sales_man_name` varchar(60) NOT NULL,
  `email_id` varchar(60) NOT NULL,
  `mobil_number` varchar(13) NOT NULL,
  `address1` varchar(100) NOT NULL,
  `bank_name` varchar(200) NOT NULL,
  `bank_branch` varchar(50) NOT NULL,
  `account_num` varchar(40) NOT NULL,
  `ifsc` varchar(20) NOT NULL,
  `status` int(1) NOT NULL DEFAULT '1',
  `target_rate` varchar(50) NOT NULL,
  `created_by` int(11) NOT NULL DEFAULT '1',
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `erp_sales_man`
--

INSERT INTO `erp_sales_man` (`id`, `firm_id`, `sales_man_name`, `email_id`, `mobil_number`, `address1`, `bank_name`, `bank_branch`, `account_num`, `ifsc`, `status`, `target_rate`, `created_by`, `created_date`) VALUES
(1, 1, 'Rohit', 'rohit@gmail.com', '6787567876', 'h', 'SBI', 'race course', '3456546765', 'SBIN0040528', 1, '2019', 1, '2019-05-09 12:57:39');

-- --------------------------------------------------------

--
-- Table structure for table `erp_sales_return`
--

CREATE TABLE `erp_sales_return` (
  `id` int(11) NOT NULL,
  `invoice_id` int(11) NOT NULL,
  `inv_id` varchar(125) NOT NULL,
  `q_id` varchar(11) NOT NULL,
  `firm_id` int(11) NOT NULL,
  `customer` int(11) NOT NULL,
  `total_qty` int(11) NOT NULL,
  `tax_label` varchar(120) NOT NULL,
  `tax` float NOT NULL,
  `subtotal_qty` float NOT NULL,
  `net_total` float NOT NULL,
  `discount` float(7,2) NOT NULL,
  `remarks` varchar(120) NOT NULL,
  `customer_po` varchar(120) NOT NULL,
  `bill_type` enum('cash','credit') NOT NULL,
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_by` int(11) NOT NULL,
  `payment_status` enum('Pending','Completed') NOT NULL,
  `estatus` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `erp_sales_return_details`
--

CREATE TABLE `erp_sales_return_details` (
  `id` int(11) NOT NULL,
  `return_id` int(11) NOT NULL,
  `q_id` int(11) NOT NULL,
  `in_id` int(120) NOT NULL,
  `category` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_description` varchar(255) DEFAULT NULL,
  `product_type` enum('product','service') NOT NULL,
  `brand` int(11) NOT NULL,
  `unit` varchar(15) DEFAULT NULL,
  `return_quantity` int(4) NOT NULL,
  `per_cost` float NOT NULL,
  `tax` float NOT NULL,
  `gst` float NOT NULL,
  `igst` float DEFAULT NULL,
  `sub_total` float NOT NULL,
  `discount` float(7,2) DEFAULT NULL,
  `created_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `erp_stock`
--

CREATE TABLE `erp_stock` (
  `id` int(11) NOT NULL,
  `firm_id` int(11) NOT NULL,
  `category` int(120) NOT NULL,
  `brand` int(120) NOT NULL,
  `product_id` int(120) NOT NULL,
  `quantity` decimal(10,2) NOT NULL DEFAULT '0.00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `erp_stock`
--

INSERT INTO `erp_stock` (`id`, `firm_id`, `category`, `brand`, `product_id`, `quantity`) VALUES
(1, 1, 2, 0, 1, '0.00');

-- --------------------------------------------------------

--
-- Table structure for table `erp_stock_history`
--

CREATE TABLE `erp_stock_history` (
  `id` int(11) NOT NULL,
  `ref_no` varchar(120) NOT NULL,
  `type` enum('in','out','return') NOT NULL,
  `category` int(120) NOT NULL,
  `brand` int(120) NOT NULL,
  `product_id` int(120) NOT NULL,
  `quantity` decimal(10,2) NOT NULL DEFAULT '0.00',
  `created_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `erp_stock_history`
--

INSERT INTO `erp_stock_history` (`id`, `ref_no`, `type`, `category`, `brand`, `product_id`, `quantity`, `created_date`) VALUES
(1, 'INITIAl', 'in', 2, 1, 1, '0.00', '2020-09-18 10:54:00');

-- --------------------------------------------------------

--
-- Table structure for table `erp_sub_category`
--

CREATE TABLE `erp_sub_category` (
  `actionId` int(11) NOT NULL,
  `sub_categoryName` varchar(150) NOT NULL,
  `createdDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `erp_user`
--

CREATE TABLE `erp_user` (
  `id` int(11) NOT NULL,
  `name` varchar(120) NOT NULL,
  `nick_name` varchar(125) NOT NULL,
  `username` varchar(120) NOT NULL,
  `password` varchar(120) NOT NULL,
  `admin_image` varchar(130) NOT NULL,
  `mobile_no` varchar(15) NOT NULL,
  `email_id` varchar(120) NOT NULL,
  `address` varchar(120) NOT NULL,
  `role` int(120) NOT NULL,
  `signature` varchar(125) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `erp_user`
--

INSERT INTO `erp_user` (`id`, `name`, `nick_name`, `username`, `password`, `admin_image`, `mobile_no`, `email_id`, `address`, `role`, `signature`, `status`) VALUES
(1, 'Admin', 'Admin', 'admin', '81dc9bdb52d04dc20036dbd8313ed055', 'Hydrangeas2.jpg', '797643643', 'mail@admin.com', 'Admin', 1, 'Sign8.JPG', 1),
(2, 'TT EP supervisor', 'EP supervisor', 'ttepsupervisor', '81dc9bdb52d04dc20036dbd8313ed055', 'Tulips10.jpg', '2147483647', 'epsupervisor@gmail.com', '45, new test', 2, 'Tulips.jpg', 0),
(3, 'purchase manager', 'Manager', 'manager', '81dc9bdb52d04dc20036dbd8313ed055', '', '79956311', 'ttsupervisor@gmail.com', '2.erfr street ', 6, 'images1.jpg', 0),
(4, 'TT HW supervisor', 'hw supervisor', 'tthwsupervisor', '81dc9bdb52d04dc20036dbd8313ed055', '', '907645353', 'hwsupervisor@gmail.com', 'supervisor street', 2, 'Tulips1.jpg', 0),
(5, 'TTP Supervisor', 'ttpsupervisor', 'ttpsupervisor', '37d153a06c79e99e4de5889dbe2e7c57', '', '1111111111', 'rilwan.com@gmail.com', 'ttpsupervisor', 5, 'Sign1.JPG', 0),
(6, 'TTEP Purchase Manager', 'TTEP', 'ttepmanager', '81dc9bdb52d04dc20036dbd8313ed055', '', '1234567896', 'ttepmanager@gmail.com', 'xxx', 3, 'Desert.jpg', 0),
(7, 'Purchase Manager TTP', 'TTP', 'ttpmanager', '81dc9bdb52d04dc20036dbd8313ed055', '', '1233655889', 'ttpmanager@gmail.com', 'xxxx', 3, 'Hydrangeas.jpg', 0),
(8, 'TTT Supervisor', 'hi', 'tttsupervisor', '4061838f4395ef541fb1b3f07e42bc21', '', '7395845459', 'mailsalban@gmail.com', 'test', 5, 'Desktop_Background.jpg', 0),
(9, 'Mohudhoom', 'mohudhoom', 'mohudhoom', 'a60f61deb5a2091983ac747c5e362c44', '', '9042667829', 'mail@mohudhoom.com', 'mohudhoom', 2, 'Sign2.JPG', 0),
(10, 'Abdullah TTT', 'abdullah', 'Abdullah', '3be06b4ffb001d7c48b7eddd68f15c40', 'background-2887350_960_720-540x660.jpg', '7200337230', 'mail@abdullah.com', 'abdullah', 2, 'Sign3.JPG', 0),
(11, 'Muthu Kumar', 'mkumar', 'muthukumar', 'e10adc3949ba59abbe56e057f20f883e', '', '2255889977', 'mail@kumar.com', 'test', 6, 'Sign4.JPG', 0),
(12, 'Thamby', 'Thamby', 'Thamby', '25d55ad283aa400af464c76d713c07ad', '', '7200337260', 'mail@thamby.com', 'Thamby', 2, 'Sign16.JPG', 1),
(13, 'Buhary', 'buhary', 'buhary', '25d55ad283aa400af464c76d713c07ad', '', '8667219267', 'mail@buhary.com', 'Tiles', 2, 'Sign17.JPG', 0),
(14, 'Abdullah TTEP', 'abdullah', 'abdullahs', '25d55ad283aa400af464c76d713c07ad', '', '8190919973', 'mail@abdullah.com', 'abdullah', 2, 'Sign22.JPG', 1),
(15, 'Althaf', 'Althaf', 'althaf', 'e10adc3949ba59abbe56e057f20f883e', '', '9489606203', 'mail@althaf.com', 'KPM', 2, 'Sign10.JPG', 0),
(16, 'Abdul Cader', 'NM', 'NM', '25d55ad283aa400af464c76d713c07ad', '', '7200337200', 'mail@nm.com', 'KPM', 3, 'IMG-20181030-WA0046.jpg', 1),
(17, 'Faizal', 'Faizal', 'faizal', 'ef73781effc5774100f87fe2f437a435', '', '9629321428', 'mail@faizal.com', 'KPM', 2, 'Sign21.JPG', 1),
(18, 'Althaf TTEP', 'althaf', 'althafttep', 'c33367701511b4f6020ec61ded352059', '', '9489606203', 'mail@althaf.com', 'KPM', 2, 'Capture.JPG', 1),
(19, 'Althaf TTP', 'althaf', 'althafttp', 'c33367701511b4f6020ec61ded352059', '', '9489606203', 'mail@althaf.com', 'KPM', 2, 'Capture1.JPG', 1),
(20, 'Althaf TTT', 'Althaf', 'althafttt', 'c33367701511b4f6020ec61ded352059', '', '9489606203', 'mail@althaf.com', 'KPM', 2, 'Capture2.JPG', 1),
(21, 'Althaf TTHW', 'Althaf', 'althaftthw', 'c33367701511b4f6020ec61ded352059', '', '9489606203', 'mail@althaf.com', 'KPM', 2, 'Capture3.JPG', 1),
(22, 'Azeez', 'Azeez', 'azeez', '25d55ad283aa400af464c76d713c07ad', '', '9489606201', 'mail@azeez.com', 'KPM', 2, 'Sign20.JPG', 1),
(23, 'MOHAMED LEBBAI', 'lebbai', 'lebbai', '25d55ad283aa400af464c76d713c07ad', '', '8148141872', 'mail@lebbai.com', 'kpm', 2, 'Untitled.png', 1),
(24, 'Rakesh', 'Ra', 'Rakesh', '8f5d860b0b3fa6420a22df98dcbf8a1e', '', '8697415255', 'rakesh@gmail.com', 'f', 7, 'Penguins2.jpg', 1),
(25, 'Gogul', 'Tanwar', 'gogul', 'd41d8cd98f00b204e9800998ecf8427e', 'test', '9625315874', 'gogulbui2k19@gmail.com', 'test', 7, 'test', 1),
(47, 'Gogul', 'G', 'Gogul', '81dc9bdb52d04dc20036dbd8313ed055', 'test', '9789328887', 'gogulbui2k19@gmail.com', 'test', 0, 'test', 1),
(48, 'Test', 'Test', 'Test', '25d55ad283aa400af464c76d713c07ad', 'test', '8574856352', 'test@gmail.com', 'test', 7, 'Penguins3.jpg', 1),
(49, 'Test', 'Test', 'Test', '25f9e794323b453885f5181f1b624d0b', 'test', '', '', 'test', 7, 'test', 1),
(50, 'Test', 'Test', 'Test', '25f9e794323b453885f5181f1b624d0b', 'test', '7865675434', 'test@gmail.com', 'test', 7, 'test', 1),
(51, 'Test', 'Test', 'Test', '25d55ad283aa400af464c76d713c07ad', 'test', '7865675434', 'test@gmail.com', 'test', 0, 'test', 1),
(52, 'Test', 'Test', 'Test', '25d55ad283aa400af464c76d713c07ad', 'test', '7865675434', 'test@gmail.com', 'test', 0, 'test', 1);

-- --------------------------------------------------------

--
-- Table structure for table `erp_user_firms`
--

CREATE TABLE `erp_user_firms` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `firm_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `erp_user_firms`
--

INSERT INTO `erp_user_firms` (`id`, `user_id`, `firm_id`) VALUES
(25, 2, 1),
(27, 4, 4),
(30, 3, 1),
(31, 3, 2),
(32, 3, 3),
(33, 3, 4),
(34, 6, 1),
(35, 7, 2),
(36, 5, 2),
(37, 8, 3),
(42, 9, 2),
(59, 11, 5),
(61, 10, 3),
(92, 15, 1),
(93, 15, 2),
(94, 15, 3),
(95, 15, 4),
(107, 1, 1),
(108, 1, 2),
(109, 1, 3),
(110, 1, 4),
(112, 19, 2),
(113, 20, 3),
(115, 18, 1),
(116, 21, 4),
(129, 12, 4),
(130, 13, 3),
(133, 22, 2),
(134, 17, 1),
(135, 16, 1),
(136, 16, 2),
(137, 16, 3),
(138, 16, 4),
(139, 14, 2),
(140, 14, 3),
(141, 23, 1),
(142, 24, 6),
(144, 27, 4),
(146, 26, 4),
(147, 28, 4),
(148, 29, 1),
(149, 30, 1),
(150, 37, 4),
(151, 42, 4),
(152, 43, 4),
(153, 44, 1),
(154, 45, 1),
(155, 48, 1);

-- --------------------------------------------------------

--
-- Table structure for table `erp_user_modules`
--

CREATE TABLE `erp_user_modules` (
  `id` int(11) NOT NULL,
  `user_module_name` varchar(100) NOT NULL,
  `user_module_key` varchar(100) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_date` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `erp_user_modules`
--

INSERT INTO `erp_user_modules` (`id`, `user_module_name`, `user_module_key`, `status`, `created_date`, `updated_date`) VALUES
(1, 'Dashboard', 'dashboard', 1, '2018-03-13 11:34:18', NULL),
(2, 'Masters', 'masters', 1, '2018-03-13 11:34:18', NULL),
(3, 'Quotation', 'quotation', 1, '2018-03-13 11:34:18', NULL),
(4, 'Purchase', 'purchase', 0, '2018-03-13 11:34:18', NULL),
(5, 'Stock', 'stock', 0, '2018-03-13 11:34:18', NULL),
(6, 'Sales', 'sales', 1, '2018-03-13 11:34:18', NULL),
(7, 'Delivery Challan', 'delivery_challan', 0, '2018-03-13 11:34:18', NULL),
(8, 'Budget', 'budget', 0, '2018-03-13 11:34:18', NULL),
(9, 'Payments', 'payments', 1, '2018-03-13 11:34:18', NULL),
(10, 'Reports', 'reports', 1, '2018-03-13 11:34:18', NULL),
(11, 'Notification', 'notification', 0, '2018-03-13 11:34:18', NULL),
(12, 'Attendance', 'attendance', 0, '2019-01-30 16:13:22', NULL),
(13, 'Task Manager', 'task_manager', 0, '2019-02-05 16:17:23', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `erp_user_roles`
--

CREATE TABLE `erp_user_roles` (
  `id` int(11) NOT NULL,
  `user_role` varchar(30) NOT NULL,
  `permission` int(4) NOT NULL,
  `grand_all` tinyint(1) NOT NULL DEFAULT '0',
  `status` int(1) NOT NULL DEFAULT '1',
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `erp_user_roles`
--

INSERT INTO `erp_user_roles` (`id`, `user_role`, `permission`, `grand_all`, `status`, `created_date`, `updated_date`) VALUES
(1, 'Admin', 1000, 1, 1, '0000-00-00 00:00:00', '2020-09-14 12:46:52'),
(2, 'Supervisor', 900, 0, 1, '0000-00-00 00:00:00', '2019-02-06 05:13:44'),
(3, 'Purchase Manager', 500, 0, 1, '0000-00-00 00:00:00', '2018-05-02 09:49:25'),
(4, 'Paints Supervisor', 0, 0, 1, '2018-03-26 18:51:16', NULL),
(5, 'Paints_Svr', 0, 0, 1, '2018-03-26 20:40:58', '2018-03-27 02:16:50'),
(6, 'Accounts', 0, 0, 1, '2018-04-02 07:49:04', '2019-05-15 10:45:43'),
(7, 'Staff', 0, 1, 1, '2018-04-10 17:27:47', '2019-05-15 12:51:05'),
(8, 'afsdgfdhfgjhk', 0, 0, 1, '2019-01-04 17:38:10', NULL),
(0, 'Salesman', 0, 0, 1, '2019-05-08 14:38:00', '2019-05-15 10:43:26');

-- --------------------------------------------------------

--
-- Table structure for table `erp_user_role_permissions`
--

CREATE TABLE `erp_user_role_permissions` (
  `id` int(11) NOT NULL,
  `user_role_id` int(11) NOT NULL,
  `module_id` int(11) NOT NULL,
  `section_id` int(11) NOT NULL,
  `acc_all` int(1) NOT NULL COMMENT '0-Disabled, 1-Enabled',
  `acc_view` int(1) NOT NULL COMMENT '0-Disabled, 1-Enabled',
  `acc_add` int(1) NOT NULL COMMENT '0-Disabled, 1-Enabled',
  `acc_edit` int(1) NOT NULL COMMENT '0-Disabled, 1-Enabled',
  `acc_delete` int(1) NOT NULL COMMENT '0-Disabled, 1-Enabled',
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `erp_user_role_permissions`
--

INSERT INTO `erp_user_role_permissions` (`id`, `user_role_id`, `module_id`, `section_id`, `acc_all`, `acc_view`, `acc_add`, `acc_edit`, `acc_delete`, `created_date`, `updated_date`) VALUES
(151, 5, 1, 1, 1, 1, 0, 0, 0, '2018-03-27 02:16:50', NULL),
(152, 5, 2, 3, 1, 1, 1, 1, 1, '2018-03-27 02:16:50', NULL),
(153, 5, 2, 7, 1, 1, 1, 1, 1, '2018-03-27 02:16:50', NULL),
(154, 5, 2, 8, 1, 1, 1, 1, 1, '2018-03-27 02:16:50', NULL),
(155, 5, 2, 9, 1, 1, 1, 1, 1, '2018-03-27 02:16:50', NULL),
(156, 5, 2, 10, 1, 1, 1, 1, 1, '2018-03-27 02:16:50', NULL),
(157, 5, 3, 13, 1, 1, 1, 1, 1, '2018-03-27 02:16:50', NULL),
(158, 5, 4, 14, 1, 1, 1, 0, 1, '2018-03-27 02:16:50', NULL),
(159, 5, 4, 15, 1, 1, 1, 1, 1, '2018-03-27 02:16:50', NULL),
(160, 5, 5, 18, 1, 1, 0, 0, 0, '2018-03-27 02:16:50', NULL),
(161, 5, 5, 19, 1, 1, 1, 1, 1, '2018-03-27 02:16:50', NULL),
(162, 5, 5, 20, 1, 1, 1, 1, 1, '2018-03-27 02:16:50', NULL),
(163, 5, 6, 21, 1, 1, 1, 1, 1, '2018-03-27 02:16:50', NULL),
(164, 5, 6, 22, 1, 1, 1, 1, 1, '2018-03-27 02:16:50', NULL),
(165, 5, 6, 23, 1, 1, 1, 1, 1, '2018-03-27 02:16:50', NULL),
(166, 5, 6, 24, 1, 1, 1, 1, 1, '2018-03-27 02:16:50', NULL),
(167, 5, 7, 25, 1, 1, 1, 1, 1, '2018-03-27 02:16:50', NULL),
(168, 5, 9, 27, 1, 1, 1, 1, 1, '2018-03-27 02:16:50', NULL),
(169, 5, 10, 28, 1, 1, 1, 1, 1, '2018-03-27 02:16:50', NULL),
(170, 5, 10, 31, 1, 1, 1, 1, 1, '2018-03-27 02:16:50', NULL),
(171, 5, 10, 32, 1, 1, 1, 1, 1, '2018-03-27 02:16:50', NULL),
(172, 5, 10, 33, 1, 1, 1, 1, 1, '2018-03-27 02:16:50', NULL),
(173, 5, 10, 34, 1, 1, 1, 1, 1, '2018-03-27 02:16:50', NULL),
(174, 5, 10, 35, 1, 1, 1, 1, 1, '2018-03-27 02:16:50', NULL),
(175, 5, 10, 36, 1, 1, 0, 0, 0, '2018-03-27 02:16:50', NULL),
(176, 5, 10, 37, 1, 1, 0, 0, 0, '2018-03-27 02:16:50', NULL),
(177, 5, 11, 40, 1, 1, 1, 1, 1, '2018-03-27 02:16:50', NULL),
(178, 5, 11, 41, 1, 1, 1, 1, 1, '2018-03-27 02:16:50', NULL),
(179, 5, 11, 42, 1, 1, 1, 1, 1, '2018-03-27 02:16:50', NULL),
(180, 5, 11, 43, 1, 1, 1, 1, 1, '2018-03-27 02:16:50', NULL),
(779, 3, 1, 1, 1, 1, 0, 0, 0, '2018-05-02 09:49:25', NULL),
(780, 3, 4, 14, 1, 1, 1, 1, 1, '2018-05-02 09:49:25', NULL),
(781, 3, 4, 15, 1, 1, 1, 1, 1, '2018-05-02 09:49:25', NULL),
(782, 3, 4, 16, 1, 1, 1, 1, 1, '2018-05-02 09:49:26', NULL),
(783, 3, 4, 17, 1, 1, 1, 1, 1, '2018-05-02 09:49:26', NULL),
(784, 3, 10, 39, 1, 1, 1, 1, 1, '2018-05-02 09:49:26', NULL),
(785, 3, 11, 40, 1, 1, 1, 1, 1, '2018-05-02 09:49:26', NULL),
(786, 3, 11, 41, 1, 1, 1, 1, 1, '2018-05-02 09:49:26', NULL),
(787, 3, 11, 42, 1, 1, 1, 1, 1, '2018-05-02 09:49:26', NULL),
(788, 3, 11, 43, 1, 1, 1, 1, 1, '2018-05-02 09:49:26', NULL),
(917, 2, 1, 1, 1, 1, 0, 0, 0, '2019-02-06 05:13:44', NULL),
(918, 2, 2, 3, 1, 1, 1, 1, 1, '2019-02-06 05:13:44', NULL),
(919, 2, 2, 7, 1, 1, 1, 1, 1, '2019-02-06 05:13:44', NULL),
(920, 2, 2, 8, 1, 1, 1, 1, 1, '2019-02-06 05:13:44', NULL),
(921, 2, 2, 9, 1, 1, 1, 1, 1, '2019-02-06 05:13:44', NULL),
(922, 2, 2, 10, 1, 1, 1, 1, 1, '2019-02-06 05:13:44', NULL),
(923, 2, 3, 13, 1, 1, 1, 1, 1, '2019-02-06 05:13:44', NULL),
(924, 2, 4, 14, 1, 1, 1, 1, 1, '2019-02-06 05:13:44', NULL),
(925, 2, 4, 15, 1, 1, 1, 1, 1, '2019-02-06 05:13:44', NULL),
(926, 2, 4, 16, 1, 1, 1, 1, 1, '2019-02-06 05:13:44', NULL),
(927, 2, 4, 17, 1, 1, 1, 1, 1, '2019-02-06 05:13:45', NULL),
(928, 2, 5, 18, 1, 1, 1, 1, 1, '2019-02-06 05:13:45', NULL),
(929, 2, 5, 19, 1, 1, 1, 1, 1, '2019-02-06 05:13:45', NULL),
(930, 2, 5, 20, 1, 1, 1, 1, 1, '2019-02-06 05:13:45', NULL),
(931, 2, 6, 21, 1, 1, 1, 1, 1, '2019-02-06 05:13:45', NULL),
(932, 2, 6, 22, 1, 1, 1, 1, 1, '2019-02-06 05:13:45', NULL),
(933, 2, 6, 23, 1, 1, 1, 1, 1, '2019-02-06 05:13:45', NULL),
(934, 2, 6, 24, 1, 1, 1, 1, 1, '2019-02-06 05:13:45', NULL),
(935, 2, 7, 25, 1, 1, 1, 1, 1, '2019-02-06 05:13:45', NULL),
(936, 2, 9, 27, 1, 1, 1, 1, 1, '2019-02-06 05:13:45', NULL),
(937, 2, 10, 28, 1, 1, 1, 1, 1, '2019-02-06 05:13:45', NULL),
(938, 2, 10, 31, 1, 1, 1, 1, 1, '2019-02-06 05:13:45', NULL),
(939, 2, 10, 32, 1, 1, 1, 1, 1, '2019-02-06 05:13:45', NULL),
(940, 2, 10, 33, 1, 1, 1, 1, 1, '2019-02-06 05:13:45', NULL),
(941, 2, 10, 34, 1, 1, 1, 1, 1, '2019-02-06 05:13:45', NULL),
(942, 2, 10, 35, 1, 1, 1, 1, 1, '2019-02-06 05:13:45', NULL),
(943, 2, 10, 36, 1, 1, 1, 1, 1, '2019-02-06 05:13:45', NULL),
(944, 2, 10, 37, 1, 1, 1, 1, 1, '2019-02-06 05:13:45', NULL),
(945, 2, 11, 40, 1, 1, 1, 1, 1, '2019-02-06 05:13:45', NULL),
(946, 2, 11, 42, 1, 1, 1, 1, 1, '2019-02-06 05:13:45', NULL),
(947, 2, 13, 52, 1, 1, 1, 1, 1, '2019-02-06 05:13:45', NULL),
(948, 2, 13, 53, 1, 1, 1, 1, 1, '2019-02-06 05:13:45', NULL),
(949, 2, 13, 54, 1, 1, 1, 1, 1, '2019-02-06 05:13:45', NULL),
(0, 0, 6, 21, 1, 1, 1, 1, 1, '2019-05-15 10:43:26', NULL),
(0, 0, 6, 22, 1, 1, 1, 1, 1, '2019-05-15 10:43:26', NULL),
(0, 0, 6, 23, 1, 1, 1, 1, 1, '2019-05-15 10:43:26', NULL),
(0, 0, 6, 24, 1, 1, 1, 1, 1, '2019-05-15 10:43:26', NULL),
(0, 6, 7, 25, 1, 1, 1, 1, 1, '2019-05-15 10:45:43', NULL),
(0, 6, 9, 27, 1, 1, 1, 1, 1, '2019-05-15 10:45:43', NULL),
(0, 7, 1, 1, 1, 1, 0, 0, 0, '2019-05-15 12:51:05', NULL),
(0, 7, 2, 2, 1, 1, 1, 1, 1, '2019-05-15 12:51:05', NULL),
(0, 7, 2, 3, 1, 1, 1, 1, 1, '2019-05-15 12:51:05', NULL),
(0, 7, 2, 4, 1, 1, 1, 1, 1, '2019-05-15 12:51:05', NULL),
(0, 7, 2, 5, 1, 1, 1, 1, 1, '2019-05-15 12:51:05', NULL),
(0, 7, 2, 6, 1, 1, 1, 1, 1, '2019-05-15 12:51:05', NULL),
(0, 7, 2, 7, 1, 1, 1, 1, 1, '2019-05-15 12:51:05', NULL),
(0, 7, 2, 8, 1, 1, 1, 1, 1, '2019-05-15 12:51:05', NULL),
(0, 7, 2, 9, 1, 1, 1, 1, 1, '2019-05-15 12:51:05', NULL),
(0, 7, 2, 10, 1, 1, 1, 1, 1, '2019-05-15 12:51:05', NULL),
(0, 7, 2, 11, 1, 1, 1, 1, 1, '2019-05-15 12:51:05', NULL),
(0, 7, 2, 12, 1, 1, 1, 1, 1, '2019-05-15 12:51:05', NULL),
(0, 7, 3, 13, 1, 1, 1, 1, 1, '2019-05-15 12:51:05', NULL),
(0, 7, 4, 14, 1, 1, 1, 1, 1, '2019-05-15 12:51:05', NULL),
(0, 7, 4, 15, 1, 1, 1, 1, 1, '2019-05-15 12:51:05', NULL),
(0, 7, 4, 16, 1, 1, 1, 1, 1, '2019-05-15 12:51:05', NULL),
(0, 7, 4, 17, 1, 1, 1, 1, 1, '2019-05-15 12:51:05', NULL),
(0, 7, 5, 18, 1, 1, 1, 1, 1, '2019-05-15 12:51:05', NULL),
(0, 7, 5, 19, 1, 1, 1, 1, 1, '2019-05-15 12:51:05', NULL),
(0, 7, 5, 20, 1, 1, 1, 1, 1, '2019-05-15 12:51:05', NULL),
(0, 7, 6, 21, 1, 1, 1, 1, 1, '2019-05-15 12:51:05', NULL),
(0, 7, 6, 22, 1, 1, 1, 1, 1, '2019-05-15 12:51:05', NULL),
(0, 7, 6, 23, 1, 1, 1, 1, 1, '2019-05-15 12:51:05', NULL),
(0, 7, 6, 24, 1, 1, 1, 1, 1, '2019-05-15 12:51:05', NULL),
(0, 7, 7, 25, 1, 1, 1, 1, 1, '2019-05-15 12:51:05', NULL),
(0, 7, 8, 26, 1, 1, 1, 1, 1, '2019-05-15 12:51:05', NULL),
(0, 7, 9, 27, 1, 1, 1, 1, 1, '2019-05-15 12:51:05', NULL),
(0, 7, 10, 28, 1, 1, 1, 1, 1, '2019-05-15 12:51:05', NULL),
(0, 7, 10, 29, 1, 1, 1, 1, 1, '2019-05-15 12:51:05', NULL),
(0, 7, 10, 30, 1, 1, 1, 1, 1, '2019-05-15 12:51:05', NULL),
(0, 7, 10, 31, 1, 1, 1, 1, 1, '2019-05-15 12:51:05', NULL),
(0, 7, 10, 32, 1, 1, 1, 1, 1, '2019-05-15 12:51:05', NULL),
(0, 7, 10, 33, 1, 1, 1, 1, 1, '2019-05-15 12:51:05', NULL),
(0, 7, 10, 34, 1, 1, 1, 1, 1, '2019-05-15 12:51:05', NULL),
(0, 7, 10, 35, 1, 1, 1, 1, 1, '2019-05-15 12:51:05', NULL),
(0, 7, 10, 36, 1, 1, 1, 1, 1, '2019-05-15 12:51:05', NULL),
(0, 7, 10, 37, 1, 1, 1, 1, 1, '2019-05-15 12:51:05', NULL),
(0, 7, 10, 38, 1, 1, 1, 1, 1, '2019-05-15 12:51:05', NULL),
(0, 7, 10, 39, 1, 1, 1, 1, 1, '2019-05-15 12:51:05', NULL),
(0, 7, 10, 44, 1, 1, 1, 1, 1, '2019-05-15 12:51:05', NULL),
(0, 7, 11, 40, 1, 1, 1, 1, 1, '2019-05-15 12:51:05', NULL),
(0, 7, 11, 41, 1, 1, 1, 1, 1, '2019-05-15 12:51:05', NULL),
(0, 7, 11, 42, 1, 1, 1, 1, 1, '2019-05-15 12:51:05', NULL),
(0, 7, 11, 43, 1, 1, 1, 1, 1, '2019-05-15 12:51:05', NULL),
(0, 7, 12, 45, 1, 1, 1, 1, 1, '2019-05-15 12:51:05', NULL),
(0, 7, 12, 46, 1, 1, 1, 1, 1, '2019-05-15 12:51:05', NULL),
(0, 7, 12, 47, 1, 1, 1, 1, 1, '2019-05-15 12:51:05', NULL),
(0, 7, 12, 48, 1, 1, 1, 1, 1, '2019-05-15 12:51:05', NULL),
(0, 7, 12, 49, 1, 1, 1, 1, 1, '2019-05-15 12:51:05', NULL),
(0, 7, 12, 50, 1, 1, 1, 1, 1, '2019-05-15 12:51:05', NULL),
(0, 7, 12, 51, 1, 1, 1, 1, 1, '2019-05-15 12:51:05', NULL),
(0, 7, 13, 52, 1, 1, 1, 1, 1, '2019-05-15 12:51:05', NULL),
(0, 7, 13, 53, 1, 1, 1, 1, 1, '2019-05-15 12:51:05', NULL),
(0, 7, 13, 54, 1, 1, 1, 1, 1, '2019-05-15 12:51:05', NULL),
(0, 1, 1, 1, 1, 1, 0, 0, 0, '2020-09-14 12:46:52', NULL),
(0, 1, 2, 3, 1, 1, 1, 1, 1, '2020-09-14 12:46:52', NULL),
(0, 1, 2, 4, 1, 1, 1, 1, 1, '2020-09-14 12:46:52', NULL),
(0, 1, 2, 5, 1, 1, 1, 1, 1, '2020-09-14 12:46:52', NULL),
(0, 1, 2, 6, 1, 1, 1, 1, 1, '2020-09-14 12:46:52', NULL),
(0, 1, 2, 7, 1, 1, 1, 1, 1, '2020-09-14 12:46:52', NULL),
(0, 1, 2, 8, 1, 1, 1, 1, 1, '2020-09-14 12:46:52', NULL),
(0, 1, 2, 9, 1, 1, 1, 1, 1, '2020-09-14 12:46:53', NULL),
(0, 1, 2, 11, 1, 1, 1, 1, 1, '2020-09-14 12:46:53', NULL),
(0, 1, 3, 13, 1, 1, 1, 1, 1, '2020-09-14 12:46:53', NULL),
(0, 1, 3, 14, 1, 1, 1, 1, 1, '2020-09-14 12:46:53', NULL),
(0, 1, 6, 22, 1, 1, 1, 1, 1, '2020-09-14 12:46:53', NULL),
(0, 1, 9, 27, 1, 1, 1, 1, 1, '2020-09-14 12:46:53', NULL),
(0, 1, 10, 34, 1, 1, 1, 1, 1, '2020-09-14 12:46:53', NULL),
(0, 1, 10, 44, 1, 1, 1, 1, 1, '2020-09-14 12:46:53', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `erp_user_sections`
--

CREATE TABLE `erp_user_sections` (
  `id` int(11) NOT NULL,
  `module_id` int(11) NOT NULL,
  `user_section_name` varchar(100) NOT NULL,
  `user_section_key` varchar(100) NOT NULL,
  `acc_view` int(1) NOT NULL DEFAULT '0' COMMENT '0-Disabled, 1-Enabled',
  `acc_add` int(1) NOT NULL DEFAULT '0' COMMENT '0-Disabled, 1-Enabled',
  `acc_edit` int(1) NOT NULL DEFAULT '0' COMMENT '0-Disabled, 1-Enabled',
  `acc_delete` int(1) DEFAULT '0' COMMENT '0-Disabled, 1-Enabled',
  `status` tinyint(1) DEFAULT '1',
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `erp_user_sections`
--

INSERT INTO `erp_user_sections` (`id`, `module_id`, `user_section_name`, `user_section_key`, `acc_view`, `acc_add`, `acc_edit`, `acc_delete`, `status`, `created_date`, `updated_date`) VALUES
(1, 1, 'Dashboard', 'dashboard', 1, 0, 0, 0, 1, '2018-03-13 11:34:19', NULL),
(2, 2, 'Suppliers', 'suppliers', 1, 1, 1, 1, 0, '2018-03-13 11:34:19', NULL),
(3, 2, 'Customers', 'customers', 1, 1, 1, 1, 1, '2018-03-13 11:34:19', NULL),
(4, 2, 'Firms', 'firms', 1, 1, 1, 1, 1, '2018-03-13 11:34:19', NULL),
(5, 2, 'User Roles', 'user_roles', 1, 1, 1, 1, 1, '2018-03-13 11:34:19', NULL),
(6, 2, 'Users', 'users', 1, 1, 1, 1, 1, '2018-03-13 11:34:19', NULL),
(7, 2, 'Products', 'products', 1, 1, 1, 1, 1, '2018-03-13 11:34:19', NULL),
(8, 2, 'Categories', 'categories', 1, 1, 1, 1, 1, '2018-03-13 11:34:19', NULL),
(9, 2, 'Brands', 'brands', 1, 1, 1, 1, 1, '2018-03-13 11:34:19', NULL),
(10, 2, 'Reference Groups', 'reference_groups', 1, 1, 1, 1, 0, '2018-03-13 11:34:19', NULL),
(11, 2, 'Sales Man', 'sales_man', 1, 1, 1, 1, 1, '2018-03-13 11:34:19', NULL),
(12, 2, 'Email Settings', 'email_settings', 1, 1, 1, 1, 0, '2018-03-13 11:34:19', NULL),
(13, 3, 'Quotation', 'quotation', 1, 1, 1, 1, 1, '2018-03-13 11:34:19', NULL),
(14, 3, 'Quotation Return', 'quotation_return', 1, 1, 1, 1, 1, '2018-03-13 11:34:19', NULL),
(15, 4, 'Order', 'purchase_order', 1, 1, 1, 1, 0, '2018-03-13 11:34:19', NULL),
(16, 4, 'Return', 'purchase_return', 1, 1, 1, 1, 0, '2018-03-13 11:34:19', NULL),
(17, 4, 'Receipt', 'purchase_receipt', 1, 1, 1, 1, 0, '2018-03-13 11:34:19', NULL),
(18, 5, 'Stock', 'stock', 1, 1, 1, 1, 0, '2018-03-13 11:34:19', NULL),
(19, 5, 'SKU', 'manage_sku', 1, 1, 1, 1, 0, '2018-03-13 11:34:19', NULL),
(20, 5, 'Shrinkage Control', 'physical_report', 1, 1, 1, 1, 1, '2018-03-13 11:34:19', NULL),
(21, 6, 'Sales', 'sales', 1, 1, 1, 1, 0, '2018-03-13 11:34:19', NULL),
(22, 6, 'Invoice', 'invoice', 1, 1, 1, 1, 1, '2018-03-13 11:34:19', NULL),
(23, 6, 'Return', 'sales_return', 1, 1, 1, 1, 0, '2018-03-13 11:34:19', NULL),
(24, 6, 'Receipt', 'sales_receipt', 1, 1, 1, 1, 0, '2018-03-13 11:34:19', NULL),
(25, 7, 'Delivery Challan', 'delivery_challan', 1, 1, 1, 1, 0, '2018-03-13 11:34:19', NULL),
(26, 8, 'Budget', 'budget', 1, 1, 1, 1, 1, '2018-03-13 11:34:19', NULL),
(27, 9, 'Payments', 'payments', 1, 1, 1, 1, 1, '2018-03-13 11:34:19', NULL),
(28, 10, 'Quotation Report', 'quotation_report', 1, 1, 1, 1, 0, '2018-03-13 11:34:19', NULL),
(29, 10, 'Purchase Report', 'purchase_report', 1, 1, 1, 1, 0, '2018-03-13 11:34:19', NULL),
(30, 10, 'Purchase Receipt Report', 'purchase_receipt_report', 1, 1, 1, 1, 0, '2018-03-13 11:34:19', NULL),
(31, 10, 'Customer Based Report', 'customer_based_report', 1, 1, 1, 1, 0, '2018-03-13 11:34:19', NULL),
(32, 10, 'Stock Report', 'stock_report', 1, 1, 1, 1, 0, '2018-03-13 11:34:19', NULL),
(33, 10, 'Sales Report', 'pc_report', 1, 1, 1, 1, 0, '2018-03-13 11:34:19', NULL),
(34, 10, 'Invoice Report', 'invoice_report', 1, 1, 1, 1, 1, '2018-03-13 11:34:19', NULL),
(35, 10, 'Contractor Report', 'hr_invoice_report', 1, 1, 1, 1, 0, '2018-03-13 11:34:20', NULL),
(36, 10, 'Outstanding Report', 'payment_receipt_report', 1, 1, 1, 1, 0, '2018-03-13 11:34:20', NULL),
(37, 10, 'Outstanding Report - Due Date', 'outstanding_report_due_date', 1, 1, 1, 1, 0, '2018-03-13 11:34:20', NULL),
(38, 10, 'Outstanding Report - Firm', 'outstanding_report_firm', 1, 1, 1, 1, 0, '2018-03-13 11:34:20', NULL),
(39, 10, 'Profit and Loss Report', 'profit_list', 1, 1, 1, 1, 0, '2018-03-13 11:34:20', NULL),
(40, 11, 'Today Sales and Purchase', 'today_notification', 1, 1, 1, 1, 0, '2018-03-13 11:34:20', NULL),
(41, 11, 'Purchase Payment', 'purchase_notification', 1, 1, 1, 1, 1, '2018-03-13 11:34:20', NULL),
(42, 11, 'Invoice Payment', 'invoice_notification', 1, 1, 1, 1, 1, '2018-03-13 11:34:20', NULL),
(43, 11, 'General', 'general_notification', 1, 1, 1, 1, 1, '2018-03-13 11:34:20', NULL),
(44, 10, 'Customer Payment Report', 'customer_payment_report', 1, 1, 1, 1, 1, '2018-08-02 09:35:14', NULL),
(45, 12, 'Dashboard', 'dashboard', 1, 1, 1, 1, 1, '2019-01-30 16:14:21', NULL),
(46, 12, 'Monthly Report', 'monthly_reports', 1, 1, 1, 1, 1, '2019-01-30 16:16:28', NULL),
(47, 12, 'Daily Report', 'daily_reports', 1, 1, 1, 1, 1, '2019-01-30 16:18:34', NULL),
(48, 12, 'Late coming report', 'late_coming_report', 1, 1, 1, 1, 1, '2019-01-30 16:19:43', NULL),
(49, 12, 'Early going report', 'early_going_report', 1, 1, 1, 1, 1, '2019-01-30 16:21:56', NULL),
(50, 12, 'Overtime Report', 'overtime_report', 1, 1, 1, 1, 1, '2019-01-30 16:24:15', NULL),
(51, 12, 'Settings', 'settings', 1, 1, 1, 1, 1, '2019-01-30 16:25:33', NULL),
(52, 13, 'Weekly task report', 'weekly_task_report', 1, 1, 1, 1, 1, '2019-02-05 16:21:19', NULL),
(53, 13, 'Daily task report', 'daily_task_report', 1, 1, 1, 1, 1, '2019-02-05 16:21:19', NULL),
(54, 13, 'task report', 'task_report', 1, 1, 1, 1, 1, '2019-02-05 16:21:58', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `increment`
--

CREATE TABLE `increment` (
  `id` int(11) NOT NULL,
  `type` varchar(30) NOT NULL,
  `code` varchar(10) NOT NULL,
  `prefix` varchar(50) NOT NULL,
  `last_increment_id` varchar(10) NOT NULL DEFAULT '001'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `increment`
--

INSERT INTO `increment` (`id`, `type`, `code`, `prefix`, `last_increment_id`) VALUES
(1, 'TTEP', 'TT', '18/03', '001'),
(2, 'TTP', 'TT', '18/03', '011'),
(3, 'TTT', 'TT', '18/03', '001'),
(4, 'TTH', 'TT', '18/03', '001'),
(5, 'TTEP', 'PO', '18/03', '001'),
(6, 'TTT', 'PO', '18/03', '001'),
(7, 'TTP', 'PO', '18/03', '001'),
(8, 'TTH', 'PO', '18/03', '001'),
(9, 'TTEP', 'VC', '18/03', '001'),
(10, 'TTP', 'VC', '18/03', '001'),
(11, 'TTP', 'TT', '18/04', '415'),
(12, 'TTEP', 'TT', '18/04', '083'),
(13, 'TTT', 'TT', '18/04', '006'),
(14, 'TTH', 'TT', '18/04', '390'),
(15, 'TTEP', 'PO', '18/04', '001'),
(16, 'TTP', 'PO', '18/04', '001'),
(17, 'TTT', 'PO', '18/04', '001'),
(18, 'TTH', 'PO', '18/04', '001'),
(19, 'TTP', 'VC', '18/04', '001'),
(20, '', 'TT', '18/04', '001'),
(21, 'TTP', 'TT', '18/05', '473'),
(22, 'TTEP', 'TT', '18/05', '821'),
(23, 'TTH', 'TT', '18/05', '287'),
(24, 'TTT', 'TT', '18/05', '030'),
(25, 'TTEP', 'PO', '18/05', '002'),
(26, 'TTP', 'PO', '18/05', '001'),
(27, 'TTP', 'TT', '18/06', '506'),
(28, 'TTEP', 'TT', '18/06', '566'),
(29, 'TTH', 'TT', '18/06', '310'),
(30, 'TTT', 'TT', '18/06', '042'),
(31, 'TTEP', 'TT', '18/07', '608'),
(32, 'TTH', 'TT', '18/07', '525'),
(33, 'TTP', 'TT', '18/07', '352'),
(34, 'TTT', 'TT', '18/07', '016'),
(35, 'TTH', 'TT', '18/08', '240'),
(36, 'TTEP', 'TT', '18/08', '255'),
(37, 'TTP', 'TT', '18/08', '327'),
(38, 'TTT', 'TT', '18/08', '006'),
(39, '', 'TT', '18/08', '001'),
(40, 'TTH', 'PO', '18/08', '001'),
(41, 'TTH', 'TT', '18/09', '299'),
(42, 'TTP', 'TT', '18/09', '269'),
(43, 'TTEP', 'TT', '18/09', '243'),
(44, 'TTT', 'TT', '18/09', '003'),
(45, 'TTH', 'PO', '18/09', '002'),
(46, 'TTP', 'PO', '18/09', '003'),
(47, 'TTP', 'TT', '18/10', '288'),
(48, 'TTH', 'TT', '18/10', '339'),
(49, 'TTEP', 'TT', '18/10', '464'),
(50, 'TTH', 'PO', '18/10', '010'),
(51, 'TTP', 'PO', '18/10', '006'),
(52, 'TTT', 'TT', '18/10', '002'),
(53, 'TTEP', 'PO', '18/10', '011'),
(54, 'TTT', 'PO', '18/10', '001'),
(55, 'TTP', 'TT', '18/11', '310'),
(56, 'TTEP', 'TT', '18/11', '309'),
(57, 'TTH', 'TT', '18/11', '391'),
(58, 'TTEP', 'PO', '18/11', '045'),
(59, 'TTH', 'PO', '18/11', '017'),
(60, 'TTP', 'PO', '18/11', '005'),
(61, 'TTT', 'TT', '18/11', '094'),
(62, 'TTP', 'TT', '18/12', '385'),
(63, 'TTH', 'TT', '18/12', '328'),
(64, 'TTH', 'PO', '18/12', '017'),
(65, 'TTEP', 'TT', '18/12', '361'),
(66, 'TTEP', 'PO', '18/12', '046'),
(67, 'TTP', 'PO', '18/12', '001'),
(68, 'TTEP', 'TT', '19/01', '251'),
(69, 'TTH', 'TT', '19/01', '341'),
(70, 'TTP', 'TT', '19/01', '311'),
(71, 'TTEP', 'PO', '19/01', '024'),
(72, 'TTT', 'TT', '19/01', '003'),
(73, 'TTEP', 'TT', '19/02', '137'),
(74, 'TTEP', 'PO', '19/02', '020'),
(75, 'TTP', 'TT', '19/02', '170'),
(76, 'TTH', 'TT', '19/02', '124'),
(77, 'TTT', 'TT', '19/02', '049'),
(78, 'TWM - SBC-', 'TT', '19/02', '001'),
(79, 'TWM - SBC-', 'PO', '19/02', '001'),
(80, 'TWM - SBC-', 'VC', '19/02', '001'),
(81, 'TWM ', 'PO', '19/02', '002'),
(82, 'TWM - SBC-', 'TT', '19/03', '001'),
(83, 'TWM ', 'TT', '19/03', '002'),
(84, 'TWM - SBC-', 'PO', '19/03', '001'),
(85, 'TWM ', 'PO', '19/03', '002'),
(86, 'TWM - SBC-', 'VC', '19/03', '001'),
(87, 'EP', 'TT', '19/04', '005'),
(88, 'P', 'TT', '19/04', '003'),
(89, 'H', 'TT', '19/04', '001'),
(90, 'T', 'TT', '19/04', '001'),
(91, 'EP', 'PO', '19/04', '001'),
(92, 'P', 'VC', '19/04', '002'),
(93, 'P', 'PO', '19/04', '001'),
(94, 'T', 'PO', '19/04', '002'),
(95, 'EP', 'TT', '19/05', '025'),
(96, 'T', 'TT', '19/05', '008'),
(97, 'P', 'TT', '19/05', '008'),
(98, 'EP', 'PO', '19/05', '003'),
(99, 'P', 'PO', '19/05', '002'),
(100, 'T', 'PO', '19/05', '001'),
(101, 'H', 'TT', '19/05', '004'),
(102, 'EP', 'TT', '19/06', '002'),
(103, 'EP', 'PO', '19/06', '002'),
(104, 'P', 'TT', '19/06', '001'),
(105, 'EP', 'TT', '19/08', '004'),
(106, 'EP', 'TT', '19/09', '001'),
(107, 'EP', 'TT', '19/10', '002'),
(108, 'P', 'TT', '19/10', '002'),
(109, 'T', 'TT', '19/10', '001'),
(110, 'EP', 'TT', '19/11', '001'),
(111, 'P', 'PO', '19/12', '002'),
(112, 'P', 'TT', '19/12', '001'),
(113, 'EP', 'TT', '20/01', '003'),
(114, 'T', 'TT', '20/01', '001'),
(115, 'P', 'TT', '20/01', '001'),
(116, 'H', 'TT', '20/01', '001'),
(117, 'EP', 'PO', '20/01', '001'),
(118, 'P', 'VC', '20/01', '002'),
(119, 'EP', 'PO', '20/02', '001'),
(120, 'EP', 'TT', '20/02', '001'),
(121, 'P', 'TT', '20/02', '001'),
(122, 'P', 'PO', '20/02', '001'),
(123, 'T', 'PO', '20/02', '001'),
(124, 'EP', 'TT', '20/03', '001'),
(125, 'EP', 'TT', '20/06', '002'),
(126, 'P', 'TT', '20/06', '001'),
(127, 'T', 'TT', '20/06', '001'),
(128, 'H', 'TT', '20/06', '001'),
(129, 'EP', 'PO', '20/06', '003'),
(130, 'EP', 'TT', '20/09', '001');

-- --------------------------------------------------------

--
-- Table structure for table `increment_table`
--

CREATE TABLE `increment_table` (
  `id` int(11) NOT NULL,
  `type` varchar(30) NOT NULL,
  `value` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `increment_table`
--

INSERT INTO `increment_table` (`id`, `type`, `value`) VALUES
(1, 'lot_code', ''),
(2, 'color_code', 'COL0001'),
(3, 'grn_code', 'GN0001'),
(4, 'dl_code', 'DC0001'),
(5, 'po_code', 'PO0001'),
(6, 'job_code', 'SL0001'),
(7, 'inv_code', 'INV0001'),
(8, 'rp_code', 'RECQ00015'),
(9, 'pi_code', 'PR16170001'),
(10, 'pr_code', 'PI16170001'),
(11, 'enq_code', 'ERQ0001'),
(12, 'qno_code', 'IS//2016/001'),
(13, 'm_code', 'MOD0001'),
(14, 'sku_code', 'SKU003');

-- --------------------------------------------------------

--
-- Table structure for table `master_category`
--

CREATE TABLE `master_category` (
  `id` int(11) NOT NULL,
  `category` varchar(30) NOT NULL,
  `idf` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` int(1) NOT NULL DEFAULT '1',
  `df` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `master_fit`
--

CREATE TABLE `master_fit` (
  `id` int(11) NOT NULL,
  `master_fit` varchar(30) NOT NULL,
  `idf` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `df` int(1) NOT NULL DEFAULT '0',
  `status` int(1) NOT NULL DEFAULT '1',
  `created_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `master_state`
--

CREATE TABLE `master_state` (
  `id` int(11) NOT NULL,
  `state` varchar(60) NOT NULL,
  `st` float DEFAULT NULL,
  `cst` float DEFAULT NULL,
  `vat` float DEFAULT NULL,
  `idf` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `df` int(1) NOT NULL DEFAULT '0',
  `status` int(1) NOT NULL DEFAULT '1',
  `created_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `master_state`
--

INSERT INTO `master_state` (`id`, `state`, `st`, `cst`, `vat`, `idf`, `df`, `status`, `created_date`) VALUES
(1, 'Andaman and Nicobar Islands', NULL, NULL, NULL, '2016-12-14 23:44:01', 0, 1, '0000-00-00 00:00:00'),
(2, 'Andhra Pradesh', NULL, NULL, NULL, '2016-12-14 23:44:46', 0, 1, '0000-00-00 00:00:00'),
(3, 'Arunachal Pradesh', NULL, NULL, NULL, '2016-12-14 23:44:46', 0, 1, '0000-00-00 00:00:00'),
(4, 'Assam', NULL, NULL, NULL, '2016-12-14 23:45:14', 0, 1, '0000-00-00 00:00:00'),
(5, 'Bihar', NULL, NULL, NULL, '2016-12-14 23:45:14', 0, 1, '0000-00-00 00:00:00'),
(6, 'Chandigarh', NULL, NULL, NULL, '2016-12-14 23:46:00', 0, 1, '0000-00-00 00:00:00'),
(7, 'Chhattisgarh', NULL, NULL, NULL, '2016-12-14 23:46:00', 0, 1, '0000-00-00 00:00:00'),
(8, 'Dadra and Nagar Haveli', NULL, NULL, NULL, '2016-12-14 23:46:51', 0, 1, '0000-00-00 00:00:00'),
(9, 'Daman and Diu', 0, NULL, NULL, '2016-12-14 23:55:24', 0, 1, '0000-00-00 00:00:00'),
(10, 'Delhi', NULL, NULL, NULL, '2016-12-14 23:48:39', 0, 1, '0000-00-00 00:00:00'),
(11, 'Goa', NULL, NULL, NULL, '2016-12-14 23:48:39', 0, 1, '0000-00-00 00:00:00'),
(12, 'Gujarat', NULL, NULL, NULL, '2016-12-14 23:49:09', 0, 1, '0000-00-00 00:00:00'),
(13, 'Haryana', NULL, NULL, NULL, '2016-12-14 23:49:09', 0, 1, '0000-00-00 00:00:00'),
(14, 'Himachal Pradesh', NULL, NULL, NULL, '2016-12-14 23:49:33', 0, 1, '0000-00-00 00:00:00'),
(15, 'Jammu and Kashmir', NULL, NULL, NULL, '2016-12-14 23:49:33', 0, 1, '0000-00-00 00:00:00'),
(16, 'Jharkhand', NULL, NULL, NULL, '2016-12-14 23:49:52', 0, 1, '0000-00-00 00:00:00'),
(17, 'Karnataka', NULL, NULL, NULL, '2016-12-14 23:49:52', 0, 1, '0000-00-00 00:00:00'),
(18, 'Kerala', NULL, NULL, NULL, '2016-12-14 23:50:29', 0, 1, '0000-00-00 00:00:00'),
(19, 'Lakshadweep ', NULL, NULL, NULL, '2016-12-14 23:50:29', 0, 1, '0000-00-00 00:00:00'),
(20, 'Madhya Pradesh', NULL, NULL, NULL, '2016-12-14 23:51:00', 0, 1, '0000-00-00 00:00:00'),
(21, 'Maharashtra', NULL, NULL, NULL, '2016-12-14 23:51:00', 0, 1, '0000-00-00 00:00:00'),
(22, 'Manipur', NULL, NULL, NULL, '2016-12-14 23:51:26', 0, 1, '0000-00-00 00:00:00'),
(23, 'Meghalaya', NULL, NULL, NULL, '2016-12-14 23:51:26', 0, 1, '0000-00-00 00:00:00'),
(24, 'Mizoram', NULL, NULL, NULL, '2016-12-14 23:51:48', 0, 1, '0000-00-00 00:00:00'),
(25, 'Nagaland', NULL, NULL, NULL, '2016-12-14 23:51:48', 0, 1, '0000-00-00 00:00:00'),
(26, 'Odisha', NULL, NULL, NULL, '2016-12-14 23:52:11', 0, 1, '0000-00-00 00:00:00'),
(27, 'Puducherry', NULL, NULL, NULL, '2016-12-14 23:52:11', 0, 1, '0000-00-00 00:00:00'),
(28, 'Punjab', NULL, NULL, NULL, '2016-12-14 23:52:32', 0, 1, '0000-00-00 00:00:00'),
(29, 'Rajasthan', NULL, NULL, NULL, '2016-12-14 23:52:32', 0, 1, '0000-00-00 00:00:00'),
(30, 'Sikkim', NULL, NULL, NULL, '2016-12-14 23:52:54', 0, 1, '0000-00-00 00:00:00'),
(31, 'Tamil Nadu', NULL, NULL, NULL, '2016-12-14 23:52:54', 0, 1, '0000-00-00 00:00:00'),
(32, 'Telangana', NULL, NULL, NULL, '2016-12-14 23:53:22', 0, 1, '0000-00-00 00:00:00'),
(33, 'Tripura', NULL, NULL, NULL, '2016-12-14 23:53:22', 0, 1, '0000-00-00 00:00:00'),
(34, 'Uttar Pradesh', NULL, NULL, NULL, '2016-12-14 23:53:51', 0, 1, '0000-00-00 00:00:00'),
(35, 'Uttarakhand', NULL, NULL, NULL, '2016-12-14 23:53:51', 0, 1, '0000-00-00 00:00:00'),
(36, 'West Bengal', NULL, NULL, NULL, '2016-12-14 23:54:10', 0, 1, '0000-00-00 00:00:00'),
(37, 'others', NULL, NULL, NULL, '2016-12-23 13:42:19', 0, 1, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `master_street`
--

CREATE TABLE `master_street` (
  `id` int(11) NOT NULL,
  `street_name` varchar(60) NOT NULL,
  `status` int(1) NOT NULL DEFAULT '1',
  `created_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `master_user_role`
--

CREATE TABLE `master_user_role` (
  `id` int(11) NOT NULL,
  `user_role` varchar(30) NOT NULL,
  `permission` int(4) NOT NULL,
  `idf` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` int(1) NOT NULL DEFAULT '1',
  `created_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `master_user_role`
--

INSERT INTO `master_user_role` (`id`, `user_role`, `permission`, `idf`, `status`, `created_date`) VALUES
(1, 'Admin', 1000, '2016-12-23 05:53:58', 1, '0000-00-00 00:00:00'),
(2, 'Supervisor', 900, '2018-03-15 13:09:26', 1, '0000-00-00 00:00:00'),
(3, 'Purchase Manager', 500, '2018-03-15 13:09:16', 1, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `purchase_receipt_bill`
--

CREATE TABLE `purchase_receipt_bill` (
  `id` int(11) NOT NULL,
  `recevier` varchar(20) NOT NULL,
  `recevier_id` int(11) NOT NULL,
  `receipt_id` int(11) NOT NULL,
  `receipt_no` varchar(20) NOT NULL,
  `bill_amount` float NOT NULL,
  `discount` float NOT NULL,
  `discount_per` varchar(10) NOT NULL,
  `terms` int(1) NOT NULL,
  `ac_no` varchar(30) NOT NULL,
  `branch` varchar(50) NOT NULL,
  `dd_no` varchar(50) NOT NULL,
  `remarks` varchar(125) NOT NULL,
  `due_date` date NOT NULL,
  `created_date` date NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `receipt_bill`
--

CREATE TABLE `receipt_bill` (
  `id` int(11) NOT NULL,
  `recevier` varchar(20) NOT NULL,
  `recevier_id` int(11) NOT NULL,
  `receipt_id` int(11) NOT NULL,
  `receipt_no` varchar(20) NOT NULL,
  `bill_amount` float NOT NULL,
  `discount` float NOT NULL,
  `discount_per` varchar(10) NOT NULL,
  `terms` int(1) NOT NULL,
  `ac_no` varchar(30) NOT NULL,
  `branch` varchar(50) NOT NULL,
  `dd_no` varchar(50) NOT NULL,
  `remarks` text NOT NULL,
  `due_date` date NOT NULL,
  `created_date` date NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `reference_details`
--

CREATE TABLE `reference_details` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `relation` varchar(45) DEFAULT NULL,
  `company_name` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `contact_no` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `reference_types`
--

CREATE TABLE `reference_types` (
  `id` int(20) NOT NULL,
  `ref_type` varchar(50) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reference_types`
--

INSERT INTO `reference_types` (`id`, `ref_type`, `status`) VALUES
(1, 'Workers', 1),
(2, 'Contractors', 1),
(3, 'Team Lead / Engineer', 1),
(4, 'Others', 1);

-- --------------------------------------------------------

--
-- Table structure for table `sales_man`
--

CREATE TABLE `sales_man` (
  `id` int(11) NOT NULL,
  `firm_id` int(11) NOT NULL,
  `sales_man_name` int(5) NOT NULL,
  `email_id` varchar(60) NOT NULL,
  `mobil_number` varchar(13) NOT NULL,
  `address1` varchar(100) NOT NULL,
  `status` int(1) NOT NULL DEFAULT '1',
  `created_by` int(11) NOT NULL DEFAULT '1',
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sales_return_details`
--

CREATE TABLE `sales_return_details` (
  `id` int(11) NOT NULL,
  `customer` int(11) NOT NULL,
  `inv_id` int(11) NOT NULL,
  `inv_number` varchar(255) NOT NULL,
  `inv_detail_id` int(11) NOT NULL DEFAULT '0',
  `cat_id` int(11) NOT NULL,
  `brand_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `unit` varchar(50) DEFAULT NULL,
  `total_qty` int(11) NOT NULL,
  `return_qty` int(11) NOT NULL,
  `per_cost` float NOT NULL,
  `tax` float NOT NULL,
  `gst` float NOT NULL,
  `igst` float DEFAULT NULL,
  `sub_total` float NOT NULL,
  `return_cost_total` decimal(10,2) NOT NULL,
  `return_amount` decimal(10,2) NOT NULL,
  `discount` float(7,2) DEFAULT NULL,
  `created_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Table structure for table `temp_data`
--

CREATE TABLE `temp_data` (
  `id` int(11) NOT NULL,
  `key` varchar(70) DEFAULT NULL,
  `value` longblob,
  `status` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `access_id` varchar(45) DEFAULT NULL,
  `employee_id` varchar(45) DEFAULT NULL,
  `username` varchar(45) DEFAULT NULL,
  `password` varchar(45) DEFAULT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `mobile` varchar(20) DEFAULT NULL,
  `landline_no` varchar(20) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `gender` enum('male','female') DEFAULT NULL,
  `marital_status` enum('single','married','widow','widower') DEFAULT NULL,
  `religion` varchar(45) DEFAULT NULL,
  `blood_group` varchar(5) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `moved` int(1) DEFAULT '0',
  `status` int(1) DEFAULT NULL,
  `created` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `access_id`, `employee_id`, `username`, `password`, `first_name`, `last_name`, `email`, `mobile`, `landline_no`, `dob`, `gender`, `marital_status`, `religion`, `blood_group`, `image`, `moved`, `status`, `created`) VALUES
(1, '1', 'EMP-1', 'elavarasan', '81dc9bdb52d04dc20036dbd8313ed055', 'Elavarasan', 'Elavarasan', 'temp@f2fsolutions.co.in', '9867656433', '0422455466', '1983-01-01', 'male', 'single', 'Hindu', 'A +ve', NULL, 0, 1, '2014-06-12 18:52:26'),
(2, '2', 'EMP-2', 'anandh', '81dc9bdb52d04dc20036dbd8313ed055', 'anandh', 'anandh', 'anandh@test.com', '79567568568', '356457568', '2001-01-26', 'male', 'single', 'test', 'test', 'test', 0, 1, '2018-10-26 00:00:00'),
(3, '3', 'EMP-3', 'vicky', '81dc9bdb52d04dc20036dbd8313ed055', 'vicky', 'vicky', 'vicky@test.com', '796876879', '5756464757', '2001-01-26', 'male', 'single', 'test', 'test', 'test', 0, NULL, '2018-10-26 00:00:00'),
(4, '4', 'EMP-4', 'Adhil', '81dc9bdb52d04dc20036dbd8313ed055', 'Adhil', 'Adhil', 'temp@brightuitecnologies.com', '9867656433', '0422455466', '1988-06-22', 'male', 'single', 'Hindu', 'A +ve', NULL, 0, 1, '2018-08-24 13:23:24'),
(15, '15', 'EMP-15', 'sabana', '81dc9bdb52d04dc20036dbd8313ed055', 'sabana', 'sabana', 'sabana@test.com', '69776867979', '4654756867', '2001-01-26', 'female', 'single', 'test', 'test', 'test', 0, 1, '2018-10-26 00:00:00'),
(23, '23', 'EMP-23', 'aslam', '81dc9bdb52d04dc20036dbd8313ed055', 'Aslam', 'Aslam', 'aslam@test.com', '79678658679', '46457568769', '2001-01-26', 'male', 'single', 'test', 'test', 'test', 0, 1, '2018-10-26 00:00:00'),
(28, '28', 'EMP-28', 'balamurugan', '81dc9bdb52d04dc20036dbd8313ed055', 'balamurugan', 'balamurugan', 'balamurugan@gmail.com', '987456321', '', '1995-06-07', 'female', 'single', 'hindu', 'B +ve', NULL, 0, 0, '2018-08-24 13:14:25'),
(34, '34', 'EMP-34', 'vijay', '81dc9bdb52d04dc20036dbd8313ed055', 'vijay', 'k', 'temp@brightuitecnologies.com', '957454545', '0422322154', '1991-06-26', 'male', 'single', 'Hindu', 'A +ve', NULL, 0, 1, '2014-06-25 12:23:00'),
(36, '36', 'EMP-36', 'raja', '81dc9bdb52d04dc20036dbd8313ed055', 'Raja', 'ks', 'temp@brightuitecnologies.com', '9867656433', '0422455466', '1991-06-01', 'male', 'single', 'Hindu', 'B +ve', NULL, 0, 1, '2018-11-24 11:17:29'),
(37, '37', 'EMP-37', 'Deepan', '81dc9bdb52d04dc20036dbd8313ed055', 'Deepan', 'Raj', 'temp@brightuitecnologies.com', '9999999999', '', '1986-06-18', 'female', 'married', 'Hindu', 'A +ve', NULL, 0, 1, '2014-06-18 14:42:05'),
(38, '38', 'EMP-38', 'Deepika', '81dc9bdb52d04dc20036dbd8313ed055', 'Deepika', 'K', 'temp@brightuitecnologies.com', '9952452600', '', '1991-06-05', 'male', 'married', 'Hindu', 'A +ve', NULL, 0, 1, '2014-06-18 13:44:37'),
(39, '39', 'EMP-39', 'kavitha', '81dc9bdb52d04dc20036dbd8313ed055', 'kavitha', 'kavitha', 'kavitha@test.com', '5756867854654', '24346547568', '2001-01-26', 'female', 'single', 'test', 'test', 'test', 0, 1, '2018-10-26 00:00:00'),
(40, '40', 'EMP-40', 'Saranya', '81dc9bdb52d04dc20036dbd8313ed055', 'Saranya', 'R', 'temp@brightuitecnologies.com', '8925478015', '', '1984-06-01', 'male', 'married', 'Muslim', 'B +ve', NULL, 0, 1, '2014-06-18 13:42:36'),
(41, '41', 'EMP-41', 'kaviya', '81dc9bdb52d04dc20036dbd8313ed055', 'kaviya', 'kaviya', 'kaviya@test.com', '6868675868', '86769685758', '2001-01-26', 'male', 'single', 'test', 'test', 'test', 0, 1, '2018-10-26 00:00:00'),
(42, '42', 'EMP-42', 'kalaivani', '81dc9bdb52d04dc20036dbd8313ed055', 'kalaivani', 'kalaivani', 'kalaivani@test.com', '795657547568', '5475698568679', '2001-01-26', 'female', 'single', 'test', 'test', 'test', 0, 1, '2018-10-26 00:00:00'),
(43, '43', 'EMP-43', 'Mohaseen', '81dc9bdb52d04dc20036dbd8313ed055', 'Mohaseen', 'Mohaseen', 'temp@brightuitecnologies.com', '9999999999', '', '1985-06-12', 'male', 'married', 'Christian', 'A +ve', NULL, 0, 1, '2014-06-18 13:40:37'),
(44, '48', 'EMP-48', 'Gogul', '81dc9bdb52d04dc20036dbd8313ed055', 'Gogul', 'G', 'gogulbui2k19@gmail.com', '9789328887', 'Tamil Nadu', '1996-05-07', 'male', 'single', 'Hindu', 'B +ve', NULL, 0, 0, '2019-05-15 11:44:35');

-- --------------------------------------------------------

--
-- Table structure for table `user_roles`
--

CREATE TABLE `user_roles` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `roles` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_roles`
--

INSERT INTO `user_roles` (`id`, `user_id`, `roles`) VALUES
(4, 1, '[\"masters:employees\",\"masters:view_employee\",\"masters:add_employee\",\"masters:edit_employee\",\"masters:delete_employee\",\"masters:employee_roles\",\"masters:view_roles\",\"masters:edit_roles\",\"masters:shifts\",\"masters:view_shift\",\"masters:add_shift\",\"masters:edit_shift\",\"masters:delete_shift\",\"masters:salary_groups\",\"masters:view_salary_group\",\"masters:add_salary_group\",\"masters:delete_salary_group\",\"masters:designations\",\"masters:add_designation\",\"masters:edit_designation\",\"masters:delete_designation\",\"masters:departments\",\"masters:view_department\",\"masters:add_department\",\"masters:edit_department\",\"masters:delete_department\",\"masters:public_holidays\",\"masters:add_public_holidays\",\"masters:edit_public_holiday\",\"masters:delete_public_holiday\",\"masters:white_list\",\"masters:add_whitelist\",\"masters:edit_whitelist\",\"masters:delete_whitelist\",\"masters:educations_list\",\"masters:add_education\",\"masters:edit_education\",\"masters:delete_education\",\"masters:blood_groups\",\"masters:add_blood_group\",\"masters:edit_blood_group\",\"masters:delete_blood_group\",\"masters:relations\",\"masters:add_relation\",\"masters:edit_relation\",\"masters:delete_relation\",\"masters:documents\",\"masters:add_document\",\"masters:edit_document\",\"masters:delete_document\",\"masters:settings\",\"masters:edit_settings\",\"masters:salary_group_type\",\"masters:add_salary_group_type\",\"masters:edit_salary_group_type\",\"masters:delete_salary_group_type\",\"masters:id_card\",\"masters:id_card\",\"attendance:monthly_attendance\",\"attendance:view_attendance\",\"attendance:add_attendance\",\"attendance:edit_attendance\",\"attendance:daily_attendance\",\"attendance:add_attendance_for_day\",\"leave:apply_or_modify_leaves\",\"leave:view_user_leaves\",\"leave:leave_balance_and_history\",\"leave:view_leave_history\",\"leave:edit_available_user_leaves\",\"wages:process_wages\",\"wages:process_wages\",\"wages:process_user_wages\",\"wages:print_wage_slip\",\"wages:generate_wage_slip\",\"wages:wage_estimates\",\"wages:wage_estimates\",\"reports:attendance_reports\",\"reports:attendance_reports\",\"reports:overtime_reports\",\"reports:overtime_reports\",\"reports:wage_process_reports\",\"reports:wage_process_reports\",\"reports:wage_reports\",\"reports:wage_reports\",\"reports:time_reports\",\"reports:time_reports\",\"reports:incentive_reports\",\"reports:incentive_reports\",\"reports:view_time_reports\",\"reports:view_time_reports\",\"reports:allowance_reports\",\"reports:allowance_reports\",\"reports:deduction_reports\",\"reports:deduction_reports\",\"reports:tds_reports\",\"reports:tds_reports\",\"documents:print_documents_for_attaching\",\"documents:print_document\",\"documents:edit_document\",\"documents:attach_documents\",\"documents:attach_document\",\"documents:view_documents\",\"documents:view_user_document\",\"migration:index\",\"migration:edit_migration\",\"admin_dashboard:index\",\"admin_dashboard:index\",\"suspicious_entries:index\",\"suspicious_entries:index\",\"incentives:index\",\"incentives:view_incentives\",\"incentives:edit_incentives\",\"allowances:index\",\"allowances:index\",\"allowances:edit_allowances\",\"deductions:index\",\"deductions:index\",\"deductions:edit_deductions\",\"tds:index\",\"tds:index\",\"tds:edit_tds\"]'),
(5, 5, '[\"wages:process_wages\",\"wages:process_wages\",\"wages:process_user_wages\",\"wages:print_wage_slip\",\"wages:generate_wage_slip\",\"tds:index\",\"tds:index\"]'),
(6, 3, '[\"leave:apply_or_modify_leaves\",\"leave:view_user_leaves\",\"leave:apply_leave\",\"leave:edit_user_leaves\",\"leave:cancel_user_leave\"]'),
(7, 2, 'false'),
(8, 4, '[\"masters:employees\",\"masters:view_employee\",\"masters:salary_groups\",\"masters:view_salary_group\"]'),
(9, 7, '[\"masters:employees\",\"masters:view_employee\",\"masters:white_list\",\"masters:add_whitelist\"]');

-- --------------------------------------------------------

--
-- Table structure for table `vendor`
--

CREATE TABLE `vendor` (
  `id` int(11) NOT NULL,
  `state_id` int(5) DEFAULT NULL,
  `name` varchar(60) NOT NULL,
  `short_name` varchar(60) NOT NULL,
  `store_name` varchar(60) NOT NULL,
  `type` varchar(60) NOT NULL,
  `address1` varchar(100) NOT NULL,
  `address2` varchar(100) NOT NULL,
  `address3` varchar(100) NOT NULL,
  `city` varchar(50) NOT NULL,
  `pincode` int(6) NOT NULL,
  `mobil_number` varchar(13) NOT NULL,
  `landline` varchar(15) NOT NULL,
  `email_id` varchar(60) NOT NULL,
  `dob` date NOT NULL,
  `anniversary_date` date NOT NULL,
  `bank_name` varchar(200) NOT NULL,
  `bank_branch` varchar(50) NOT NULL,
  `account_num` varchar(40) NOT NULL,
  `ifsc` varchar(20) NOT NULL,
  `credit_days` int(10) NOT NULL,
  `payment_percent` float NOT NULL,
  `vendor_image` varchar(255) NOT NULL,
  `payment_terms` varchar(120) NOT NULL,
  `tin` varchar(20) NOT NULL,
  `idf` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `df` int(1) NOT NULL DEFAULT '0',
  `status` int(1) NOT NULL DEFAULT '1',
  `firm_id` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `address`
--
ALTER TABLE `address`
  ADD PRIMARY KEY (`id`),
  ADD KEY `address_user_id_idx` (`user_id`);

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ci_sessions`
--
ALTER TABLE `ci_sessions`
  ADD PRIMARY KEY (`session_id`);

--
-- Indexes for table `company_details`
--
ALTER TABLE `company_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer_payment`
--
ALTER TABLE `customer_payment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `erp_brand`
--
ALTER TABLE `erp_brand`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `erp_budget`
--
ALTER TABLE `erp_budget`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `erp_budget_details`
--
ALTER TABLE `erp_budget_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `erp_cash_out_flow`
--
ALTER TABLE `erp_cash_out_flow`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `erp_cash_out_flow_history`
--
ALTER TABLE `erp_cash_out_flow_history`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `erp_category`
--
ALTER TABLE `erp_category`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `erp_category_sub_category`
--
ALTER TABLE `erp_category_sub_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `erp_company_amount`
--
ALTER TABLE `erp_company_amount`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `erp_delivery_challan`
--
ALTER TABLE `erp_delivery_challan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `erp_delivery_challan_details`
--
ALTER TABLE `erp_delivery_challan_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `erp_enquiry`
--
ALTER TABLE `erp_enquiry`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `erp_invoice`
--
ALTER TABLE `erp_invoice`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `erp_invoice_details`
--
ALTER TABLE `erp_invoice_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `erp_invoice_product_details`
--
ALTER TABLE `erp_invoice_product_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `erp_manage_firms`
--
ALTER TABLE `erp_manage_firms`
  ADD PRIMARY KEY (`firm_id`);

--
-- Indexes for table `erp_notification`
--
ALTER TABLE `erp_notification`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `erp_order`
--
ALTER TABLE `erp_order`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `erp_other_cost`
--
ALTER TABLE `erp_other_cost`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `erp_physical_stock`
--
ALTER TABLE `erp_physical_stock`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `erp_po`
--
ALTER TABLE `erp_po`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `erp_po_details`
--
ALTER TABLE `erp_po_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `erp_pr`
--
ALTER TABLE `erp_pr`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `erp_product`
--
ALTER TABLE `erp_product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `erp_project_cost`
--
ALTER TABLE `erp_project_cost`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `erp_project_details`
--
ALTER TABLE `erp_project_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `erp_pr_details`
--
ALTER TABLE `erp_pr_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `erp_quotation`
--
ALTER TABLE `erp_quotation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `erp_quotation_details`
--
ALTER TABLE `erp_quotation_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `erp_quotation_history_details`
--
ALTER TABLE `erp_quotation_history_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `erp_reference_groups`
--
ALTER TABLE `erp_reference_groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `erp_sales_man`
--
ALTER TABLE `erp_sales_man`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `erp_sales_return`
--
ALTER TABLE `erp_sales_return`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `erp_sales_return_details`
--
ALTER TABLE `erp_sales_return_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `erp_stock`
--
ALTER TABLE `erp_stock`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `erp_stock_history`
--
ALTER TABLE `erp_stock_history`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `erp_sub_category`
--
ALTER TABLE `erp_sub_category`
  ADD PRIMARY KEY (`actionId`);

--
-- Indexes for table `erp_user`
--
ALTER TABLE `erp_user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `erp_user_firms`
--
ALTER TABLE `erp_user_firms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `erp_user_modules`
--
ALTER TABLE `erp_user_modules`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `erp_user_sections`
--
ALTER TABLE `erp_user_sections`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `increment`
--
ALTER TABLE `increment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `increment_table`
--
ALTER TABLE `increment_table`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `master_category`
--
ALTER TABLE `master_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `master_fit`
--
ALTER TABLE `master_fit`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `master_state`
--
ALTER TABLE `master_state`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `master_street`
--
ALTER TABLE `master_street`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `master_user_role`
--
ALTER TABLE `master_user_role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purchase_receipt_bill`
--
ALTER TABLE `purchase_receipt_bill`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `receipt_bill`
--
ALTER TABLE `receipt_bill`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reference_types`
--
ALTER TABLE `reference_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sales_man`
--
ALTER TABLE `sales_man`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sales_return_details`
--
ALTER TABLE `sales_return_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `temp_data`
--
ALTER TABLE `temp_data`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_users_id` (`id`),
  ADD KEY `idx_users_details` (`access_id`,`employee_id`,`username`,`first_name`,`last_name`,`status`);

--
-- Indexes for table `vendor`
--
ALTER TABLE `vendor`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `address`
--
ALTER TABLE `address`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `company_details`
--
ALTER TABLE `company_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `customer_payment`
--
ALTER TABLE `customer_payment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `erp_brand`
--
ALTER TABLE `erp_brand`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=117;

--
-- AUTO_INCREMENT for table `erp_budget`
--
ALTER TABLE `erp_budget`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `erp_budget_details`
--
ALTER TABLE `erp_budget_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `erp_cash_out_flow`
--
ALTER TABLE `erp_cash_out_flow`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `erp_cash_out_flow_history`
--
ALTER TABLE `erp_cash_out_flow_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `erp_category`
--
ALTER TABLE `erp_category`
  MODIFY `cat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=183;

--
-- AUTO_INCREMENT for table `erp_category_sub_category`
--
ALTER TABLE `erp_category_sub_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `erp_company_amount`
--
ALTER TABLE `erp_company_amount`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `erp_delivery_challan`
--
ALTER TABLE `erp_delivery_challan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `erp_delivery_challan_details`
--
ALTER TABLE `erp_delivery_challan_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `erp_enquiry`
--
ALTER TABLE `erp_enquiry`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `erp_invoice`
--
ALTER TABLE `erp_invoice`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `erp_invoice_details`
--
ALTER TABLE `erp_invoice_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `erp_invoice_product_details`
--
ALTER TABLE `erp_invoice_product_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `erp_manage_firms`
--
ALTER TABLE `erp_manage_firms`
  MODIFY `firm_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `erp_notification`
--
ALTER TABLE `erp_notification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `erp_order`
--
ALTER TABLE `erp_order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `erp_other_cost`
--
ALTER TABLE `erp_other_cost`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `erp_physical_stock`
--
ALTER TABLE `erp_physical_stock`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `erp_po`
--
ALTER TABLE `erp_po`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `erp_po_details`
--
ALTER TABLE `erp_po_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `erp_pr`
--
ALTER TABLE `erp_pr`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `erp_product`
--
ALTER TABLE `erp_product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `erp_project_cost`
--
ALTER TABLE `erp_project_cost`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `erp_project_details`
--
ALTER TABLE `erp_project_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `erp_pr_details`
--
ALTER TABLE `erp_pr_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `erp_quotation`
--
ALTER TABLE `erp_quotation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `erp_quotation_details`
--
ALTER TABLE `erp_quotation_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `erp_quotation_history_details`
--
ALTER TABLE `erp_quotation_history_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `erp_reference_groups`
--
ALTER TABLE `erp_reference_groups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `erp_sales_man`
--
ALTER TABLE `erp_sales_man`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `erp_sales_return`
--
ALTER TABLE `erp_sales_return`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `erp_sales_return_details`
--
ALTER TABLE `erp_sales_return_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `erp_stock`
--
ALTER TABLE `erp_stock`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `erp_stock_history`
--
ALTER TABLE `erp_stock_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `erp_sub_category`
--
ALTER TABLE `erp_sub_category`
  MODIFY `actionId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `erp_user`
--
ALTER TABLE `erp_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `erp_user_firms`
--
ALTER TABLE `erp_user_firms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=156;

--
-- AUTO_INCREMENT for table `erp_user_modules`
--
ALTER TABLE `erp_user_modules`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `erp_user_sections`
--
ALTER TABLE `erp_user_sections`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `increment`
--
ALTER TABLE `increment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=131;

--
-- AUTO_INCREMENT for table `increment_table`
--
ALTER TABLE `increment_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `master_category`
--
ALTER TABLE `master_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `master_fit`
--
ALTER TABLE `master_fit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `master_state`
--
ALTER TABLE `master_state`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `master_street`
--
ALTER TABLE `master_street`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `master_user_role`
--
ALTER TABLE `master_user_role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `purchase_receipt_bill`
--
ALTER TABLE `purchase_receipt_bill`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `receipt_bill`
--
ALTER TABLE `receipt_bill`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reference_types`
--
ALTER TABLE `reference_types`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `sales_man`
--
ALTER TABLE `sales_man`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sales_return_details`
--
ALTER TABLE `sales_return_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `temp_data`
--
ALTER TABLE `temp_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `vendor`
--
ALTER TABLE `vendor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
