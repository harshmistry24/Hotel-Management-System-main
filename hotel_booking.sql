-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Apr 08, 2025 at 02:07 AM
-- Server version: 9.1.0
-- PHP Version: 8.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hotel_booking`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `id` int NOT NULL AUTO_INCREMENT,
  `firstName` varchar(200) NOT NULL,
  `lastName` varchar(200) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `firstName`, `lastName`, `email`, `password`) VALUES
(1, 'Deep', 'Patel', 'deep@gmail.com', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `banquet`
--

DROP TABLE IF EXISTS `banquet`;
CREATE TABLE IF NOT EXISTS `banquet` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(250) NOT NULL,
  `email` varchar(250) NOT NULL,
  `phone` varchar(10) NOT NULL,
  `date` date NOT NULL,
  `persons` int NOT NULL,
  `event_type` varchar(255) NOT NULL,
  `days` int NOT NULL,
  `total_price` int NOT NULL,
  `payment_status` varchar(250) NOT NULL DEFAULT 'pending',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `date` (`date`)
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `banquet`
--

INSERT INTO `banquet` (`id`, `name`, `email`, `phone`, `date`, `persons`, `event_type`, `days`, `total_price`, `payment_status`, `created_at`) VALUES
(34, 'Hitanshu Metha', 'deepatel0024@gmail.com', '', '2025-04-10', 9, 'party', 2, 0, 'pending', '2025-04-02 18:24:11'),
(35, 'Hitanshu Metha', 'deepatel0024@gmail.com', '', '2025-04-11', 9, 'party', 2, 0, 'pending', '2025-04-02 18:25:21'),
(36, 'Deep Patel', 'deepatel0024@gmail.com', '', '2025-04-13', 10, 'party', 2, 10110, 'pending', '2025-04-02 18:38:29'),
(37, 'Deep Patel', 'deepatel0024@gmail.com', '', '2025-06-07', 10, 'party', 4, 20220, 'pending', '2025-04-03 20:11:35'),
(38, 'Deep Patel', 'deepatel0024@gmail.com', '', '2025-04-05', 10, 'party', 2, 10110, 'pending', '2025-04-05 18:00:59'),
(39, 'Harshil Moghariya', 'harshil@gmail.com', '6868686767', '2025-03-12', 10, 'Meeting', 1, 5055, 'success', '2025-04-05 18:05:53'),
(40, 'Deep Patel', 'deepatel0024@gmail.com', '9913609357', '2025-04-08', 100, 'party', 1, 5055, 'success', '2025-04-06 16:04:50'),
(41, 'Harsh Mistry', 'harsh@gmail.com', '9898989898', '2025-04-16', 1000, 'Marriage', 3, 15165, 'success', '2025-04-08 00:47:48');

-- --------------------------------------------------------

--
-- Table structure for table `banquet_dining_set`
--

DROP TABLE IF EXISTS `banquet_dining_set`;
CREATE TABLE IF NOT EXISTS `banquet_dining_set` (
  `id` int NOT NULL AUTO_INCREMENT,
  `banquet_price` int NOT NULL,
  `banquet_capacity` int NOT NULL,
  `dining_deposit` int NOT NULL,
  `dining_capacity` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `banquet_dining_set`
--

INSERT INTO `banquet_dining_set` (`id`, `banquet_price`, `banquet_capacity`, `dining_deposit`, `dining_capacity`) VALUES
(1, 5055, 1000, 1001, 50);

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

DROP TABLE IF EXISTS `bookings`;
CREATE TABLE IF NOT EXISTS `bookings` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `room_type` varchar(50) NOT NULL,
  `checkin_date` date NOT NULL,
  `checkout_date` date NOT NULL,
  `total_price` decimal(10,2) NOT NULL,
  `payment_status` varchar(250) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT 'pending',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `booked_room` int DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=72 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`id`, `name`, `email`, `phone`, `room_type`, `checkin_date`, `checkout_date`, `total_price`, `payment_status`, `created_at`, `booked_room`) VALUES
(16, 'Deep Patel', 'deepatel0024@gmail.com', '09913609357', 'Deluxe', '2025-03-23', '2025-03-24', 150.00, 'Pending', '2025-03-23 12:46:15', 1),
(17, 'Deep Patel', 'deepatel0024@gmail.com', '09913609357', 'Deluxe', '2025-03-23', '2025-03-28', 750.00, 'Pending', '2025-03-23 12:50:23', 1),
(18, 'Deep Patel', 'deepatel0024@gmail.com', '09913609357', 'Deluxe', '2025-03-23', '2025-03-25', 300.00, 'Pending', '2025-03-23 18:09:51', 1),
(19, 'Deep Patel', 'deepatel0024@gmail.com', '09913609357', 'Deluxe', '2025-03-23', '2025-03-25', 300.00, 'Pending', '2025-03-23 18:10:16', 1),
(20, 'Deep Patel', 'deepatel0024@gmail.com', '09913609357', 'Deluxe', '2025-03-24', '2025-03-26', 300.00, 'Pending', '2025-03-23 18:44:08', 1),
(21, 'Deep Patel', 'deepatel0024@gmail.com', '09913609357', 'Deluxe', '2025-03-24', '2025-04-05', 1800.00, 'Pending', '2025-03-23 18:47:50', 1),
(22, 'Deep Patel', 'deepatel0024@gmail.com', '09913609357', 'Deluxe', '2025-06-26', '2025-06-28', 300.00, 'Pending', '2025-03-23 22:36:07', 1),
(51, 'Deep Patel', 'deep@gmail.com', '09913609357', 'Suite', '2025-04-01', '2025-04-02', 350.00, 'Pending', '2025-04-01 16:47:51', 1),
(52, 'Deep Patel', 'deep@gmail.com', '09913609357', 'Suite', '2025-04-08', '2025-04-09', 350.00, 'Pending', '2025-04-01 16:52:50', 1),
(53, 'Deep Patel', 'deep@gmail.com', '09913609357', 'Suite', '2025-04-08', '2025-04-09', 350.00, 'Pending', '2025-04-01 16:55:11', 1),
(54, 'Deep Patel', 'deep@gmail.com', '09913609357', 'Suite', '2025-04-08', '2025-04-09', 350.00, 'Pending', '2025-04-01 17:03:43', 1),
(55, 'Deep Patel', 'deep@gmail.com', '09913609357', 'Suite', '2025-04-09', '2025-04-19', 3500.00, 'Pending', '2025-04-01 17:04:13', 1),
(56, 'Deep Patel', 'deep@gmail.com', '09913609357', 'Deluxe', '2025-04-05', '2025-04-06', 150.00, 'Pending', '2025-04-01 17:04:30', 1),
(57, 'Deep Patel', 'deep@gmail.com', '09913609357', 'Deluxe', '2025-04-05', '2025-04-06', 150.00, 'Pending', '2025-04-01 17:13:58', 1),
(58, 'Deep Patel', 'deep@gmail.com', '09913609357', 'Standard', '2025-04-02', '2025-04-04', 200.00, 'Pending', '2025-04-01 17:24:36', 1),
(59, 'Deep Patel', 'dishant@gmail.com', '09913609357', 'Standard', '2025-04-02', '2025-04-04', 200.00, 'Pending', '2025-04-01 17:26:06', 1),
(60, 'Deep Patel', 'dishant@gmail.com', '09913609357', 'Suite', '2025-04-25', '2025-04-28', 1050.00, 'Pending', '2025-04-01 17:28:32', 1),
(61, 'Deep Patel', 'dishant@gmail.com', '09913609357', 'Deluxe', '2025-04-04', '2025-04-13', 1350.00, 'Pending', '2025-04-01 17:51:29', 1),
(62, 'Deep Patel', 'deepatel0024@gmail.com', '9913609357', 'Deluxe', '2025-04-01', '2025-04-04', 450.00, 'Pending', '2025-04-01 17:57:59', 1),
(63, 'Deep Patel', 'deepatel0024@gmail.com', '9913609357', 'Suite', '2025-04-05', '2025-04-07', 98750.00, 'Pending', '2025-04-04 11:02:21', 1),
(64, 'Harsh Mistry', 'deepatel0024@gmail.com', '9898989898', 'Suite', '2025-04-06', '2025-04-08', 98750.00, 'Pending', '2025-04-06 16:02:24', 1),
(65, 'Harsh Mistry', 'deepatel0024@gmail.com', '9898989898', 'Suite', '2025-04-06', '2025-04-07', 49375.00, 'Pending', '2025-04-06 16:03:25', 1),
(66, 'Divyang Parmar', 'deepatel0024@gmail.com', '9292929292', 'Suite', '2025-04-08', '2025-04-10', 98750.00, 'Pending', '2025-04-07 06:26:53', 1),
(67, 'Kirpal Solanki', 'deepatel0024@gmail.com', '9292929292', 'Suite', '2025-04-07', '2025-04-09', 98750.00, 'Pending', '2025-04-07 07:08:20', 1),
(68, 'Kirpal Solanki', 'deepatel0024@gmail.com', '9292929292', 'Deluxe', '2025-04-07', '2025-04-08', 12600.00, 'Pending', '2025-04-07 16:49:13', 1),
(69, 'Deep Patel', 'deepatel0024@gmail.com', '09913609357', 'Deluxe', '2025-04-07', '2025-04-08', 12600.00, 'Pending', '2025-04-07 20:39:00', 1),
(70, 'Deep Patel', 'deepatel0024@gmail.com', '9913609350', 'Deluxe', '2025-04-08', '2025-04-09', 12600.00, '', '2025-04-07 20:45:40', 1),
(71, 'Deep Patel', 'deepatel0024@gmail.com', '9913609350', 'Deluxe', '2025-04-07', '2025-04-08', 12600.00, 'success', '2025-04-07 20:48:41', 1);

-- --------------------------------------------------------

--
-- Table structure for table `dining`
--

DROP TABLE IF EXISTS `dining`;
CREATE TABLE IF NOT EXISTS `dining` (
  `id` int NOT NULL AUTO_INCREMENT,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `email` varchar(250) NOT NULL,
  `contact` varchar(20) NOT NULL,
  `guests` int NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `total_price` int NOT NULL DEFAULT '500',
  `payment_status` varchar(250) NOT NULL DEFAULT 'pending',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dining`
--

INSERT INTO `dining` (`id`, `first_name`, `last_name`, `email`, `contact`, `guests`, `date`, `time`, `total_price`, `payment_status`, `created_at`) VALUES
(31, 'Deep', 'Patel', 'deepatel0024@gmail.com', '9913609350', 8, '2025-04-06', '14:06:00', 1001, 'pending', '2025-04-05 17:37:25'),
(32, 'Deep', 'Patel', 'deepatel0024@gmail.com', '9913609350', 8, '2025-04-06', '14:06:00', 1001, 'pending', '2025-04-05 17:37:40'),
(33, 'Deep', 'Patel', 'deepatel0024@gmail.com', '9913609350', 8, '2025-04-06', '14:06:00', 1001, 'pending', '2025-04-05 17:40:05'),
(34, 'Deep', 'Patel', 'deepatel0024@gmail.com', '9913609350', 8, '2025-04-06', '14:06:00', 1001, 'pending', '2025-04-05 17:40:08'),
(35, 'Deep', 'Patel', 'deepatel0024@gmail.com', '9913609350', 8, '2025-04-06', '19:06:00', 1001, 'pending', '2025-04-05 17:42:28'),
(36, 'Deep', 'Patel', 'deepatel0024@gmail.com', '9913609350', 8, '2025-04-06', '20:06:00', 1001, 'pending', '2025-04-05 17:42:35'),
(37, 'Deep', 'Patel', 'deepatel0024@gmail.com', '9913609350', 6, '2025-04-06', '12:35:00', 1001, 'pending', '2025-04-06 16:06:06'),
(38, 'Deep', 'Patel', 'deepatel0024@gmail.com', '9913609350', 3, '2025-04-08', '14:39:00', 1001, 'pending', '2025-04-07 20:09:55'),
(39, 'Deep', 'Patel', 'deepatel0024@gmail.com', '9913609350', 4, '2025-04-08', '13:58:00', 1001, 'success', '2025-04-07 20:28:32'),
(40, 'Deep', 'Patel', 'deepatel0024@gmail.com', '9913609350', 4, '2025-04-08', '13:58:00', 1001, 'success', '2025-04-07 20:28:42'),
(42, 'Harsh', 'Mistry', 'harsh@gmail.com', '9898989898', 2, '2025-04-09', '20:15:00', 1001, 'success', '2025-04-08 00:44:18');

-- --------------------------------------------------------

--
-- Table structure for table `food_menu_images`
--

DROP TABLE IF EXISTS `food_menu_images`;
CREATE TABLE IF NOT EXISTS `food_menu_images` (
  `id` int NOT NULL AUTO_INCREMENT,
  `menu_description` varchar(250) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `image_name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `food_menu_images`
--

INSERT INTO `food_menu_images` (`id`, `menu_description`, `image_name`) VALUES
(16, '', 'mm.jpg'),
(6, 'International Glimpses', '1m.jpg'),
(8, 'Kids Corner', '2m.jpg'),
(9, 'Cuisine', '3m.jpg'),
(10, 'Indian Mains', '4m.jpg'),
(11, 'Combo Meals', '5m.jpg'),
(12, 'Mid night menu - Cuisine', '6m.jpg'),
(13, 'Mains', '7m.jpg'),
(14, 'Beverages & Salads', '8m.jpg'),
(15, 'Kouzina Special', '10m.jpg'),
(5, '24-Seven', '9m.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `footer_content`
--

DROP TABLE IF EXISTS `footer_content`;
CREATE TABLE IF NOT EXISTS `footer_content` (
  `id` int NOT NULL AUTO_INCREMENT,
  `phone` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `address` varchar(255) NOT NULL,
  `about_us` varchar(500) NOT NULL,
  `facebook` varchar(255) DEFAULT NULL,
  `twitter` varchar(255) DEFAULT NULL,
  `instagram` varchar(255) DEFAULT NULL,
  `linkedin` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `footer_content`
--

INSERT INTO `footer_content` (`id`, `phone`, `email`, `address`, `about_us`, `facebook`, `twitter`, `instagram`, `linkedin`) VALUES
(1, '+91 9999999999', 'info@presidenthotel.com', 'The President Hotel, AV Road, Anand, Gujarat, India', 'Experience luxury and comfort at The President Hotel. Your satisfaction is our first priority.', 'https://www.bing.com/ck/a?!&&p=e767736928b5f6ce7ab70a48d415330c52a8b0eb8d4055d4e9868d43f4e65f8fJmltdHM9MTc0MzI5MjgwMA&ptn=3&ver=2&hsh=4&fclid=2ab755b6-7cff-66a3-010a-44547d576756&psq=facebook&u=a1aHR0cHM6Ly93d3cuZmFjZWJvb2suY29tLw&ntb=1', '', 'https://www.bing.com/ck/a?!&&p=e767736928b5f6ce7ab70a48d415330c52a8b0eb8d4055d4e9868d43f4e65f8fJmltdHM9MTc0MzI5MjgwMA&ptn=3&ver=2&hsh=4&fclid=2ab755b6-7cff-66a3-010a-44547d576756&psq=facebook&u=a1aHR0cHM6Ly93d3cuZmFjZWJvb2suY29tLw&ntb=1', 'https://www.bing.com/ck/a?!&&p=e767736928b5f6ce7ab70a48d415330c52a8b0eb8d4055d4e9868d43f4e65f8fJmltdHM9MTc0MzI5MjgwMA&ptn=3&ver=2&hsh=4&fclid=2ab755b6-7cff-66a3-010a-44547d576756&psq=facebook&u=a1aHR0cHM6Ly93d3cuZmFjZWJvb2suY29tLw&ntb=1');

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

DROP TABLE IF EXISTS `payments`;
CREATE TABLE IF NOT EXISTS `payments` (
  `id` int NOT NULL AUTO_INCREMENT,
  `booking_id` int NOT NULL,
  `transaction_id` varchar(100) NOT NULL,
  `payment_amount` decimal(10,2) NOT NULL,
  `payment_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `booking_id` (`booking_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `qr_codes`
--

DROP TABLE IF EXISTS `qr_codes`;
CREATE TABLE IF NOT EXISTS `qr_codes` (
  `id` int NOT NULL AUTO_INCREMENT,
  `booking_id` int NOT NULL,
  `qr_code_path` varchar(255) NOT NULL,
  `generated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `booking_id` (`booking_id`)
) ENGINE=InnoDB AUTO_INCREMENT=73 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `qr_codes`
--

INSERT INTO `qr_codes` (`id`, `booking_id`, `qr_code_path`, `generated_at`) VALUES
(8, 19, '../qr_codes/banquet_BookingID_19.png', '2025-04-01 14:33:24'),
(9, 19, '../qr_codes/banquet_BookingID_19.png', '2025-04-01 14:34:34'),
(12, 21, '../qr_codes/banquet_BookingID_21.png', '2025-04-01 16:17:30'),
(13, 22, '../qr_codes/banquet_BookingID_22.png', '2025-04-01 16:26:01'),
(14, 62, '../qr_codes/room_BookingID_62.png', '2025-04-01 17:59:05'),
(16, 18, '../qr_codes/dining_BookingID_18.png', '2025-04-02 16:36:10'),
(29, 30, '../qr_codes/banquet_BookingID_30.png', '2025-04-02 18:04:32'),
(30, 30, '../qr_codes/banquet_BookingID_30.png', '2025-04-02 18:04:51'),
(31, 32, '../qr_codes/banquet_BookingID_32.png', '2025-04-02 18:09:42'),
(32, 36, '../qr_codes/banquet_BookingID_36.png', '2025-04-02 18:39:28'),
(33, 19, '../qr_codes/dining_BookingID_19.png', '2025-04-02 18:48:14'),
(34, 21, '../qr_codes/dining_BookingID_21.png', '2025-04-03 19:10:32'),
(35, 21, '../qr_codes/dining_BookingID_21.png', '2025-04-03 19:14:19'),
(36, 21, '../qr_codes/dining_BookingID_21.png', '2025-04-03 19:15:14'),
(37, 21, '../qr_codes/dining_BookingID_21.png', '2025-04-03 19:15:51'),
(38, 21, '../qr_codes/dining_BookingID_21.png', '2025-04-03 19:18:36'),
(39, 21, '../qr_codes/dining_BookingID_21.png', '2025-04-03 19:34:27'),
(40, 21, '../qr_codes/dining_BookingID_21.png', '2025-04-03 19:35:36'),
(41, 21, '../qr_codes/dining_BookingID_21.png', '2025-04-03 19:36:34'),
(42, 21, '../qr_codes/dining_BookingID_21.png', '2025-04-03 19:37:37'),
(43, 21, '../qr_codes/dining_BookingID_21.png', '2025-04-03 19:38:04'),
(44, 21, '../qr_codes/dining_BookingID_21.png', '2025-04-03 19:39:44'),
(45, 21, '../qr_codes/dining_BookingID_21.png', '2025-04-03 19:40:08'),
(46, 21, '../qr_codes/dining_BookingID_21.png', '2025-04-03 19:40:36'),
(47, 21, '../qr_codes/dining_BookingID_21.png', '2025-04-03 19:51:27'),
(48, 21, '../qr_codes/dining_BookingID_21.png', '2025-04-03 19:52:07'),
(49, 21, '../qr_codes/dining_BookingID_21.png', '2025-04-03 19:52:39'),
(50, 21, '../qr_codes/dining_BookingID_21.png', '2025-04-03 19:53:45'),
(51, 21, '../qr_codes/dining_BookingID_21.png', '2025-04-03 19:55:11'),
(52, 21, '../qr_codes/dining_BookingID_21.png', '2025-04-03 19:55:37'),
(53, 21, 'qr_codes/dining_BookingID_21.png', '2025-04-03 20:02:33'),
(54, 21, 'qr_codes/dining_BookingID_21.png', '2025-04-03 20:04:20'),
(55, 37, 'qr_codes/banquet_BookingID_37.png', '2025-04-03 20:11:49'),
(56, 37, 'qr_codes/banquet_BookingID_37.png', '2025-04-03 20:15:16'),
(57, 37, '../qr_codes/banquet_BookingID_37.png', '2025-04-03 20:17:41'),
(58, 37, '../qr_codes/banquet_BookingID_37.png', '2025-04-03 20:20:06'),
(59, 63, '../qr_codes/room_BookingID_63.png', '2025-04-04 11:03:32'),
(60, 29, '../qr_codes/dining_BookingID_29.png', '2025-04-05 17:36:25'),
(61, 65, '../qr_codes/room_BookingID_65.png', '2025-04-06 16:04:01'),
(62, 40, '../qr_codes/banquet_BookingID_40.png', '2025-04-06 16:05:14'),
(63, 37, '../qr_codes/dining_BookingID_37.png', '2025-04-06 16:06:21'),
(64, 66, '../qr_codes/room_BookingID_66.png', '2025-04-07 06:27:54'),
(65, 67, '../qr_codes/room_BookingID_67.png', '2025-04-07 07:08:38'),
(66, 38, '../qr_codes/dining_BookingID_38.png', '2025-04-07 20:10:42'),
(67, 40, '../qr_codes/dining_BookingID_40.png', '2025-04-07 20:37:57'),
(68, 70, '../qr_codes/room_BookingID_70.png', '2025-04-07 20:46:29'),
(69, 71, '../qr_codes/room_BookingID_71.png', '2025-04-07 20:49:06'),
(70, 41, '../qr_codes/dining_BookingID_41.png', '2025-04-07 21:06:06'),
(71, 42, '../qr_codes/dining_BookingID_42.png', '2025-04-08 00:44:37'),
(72, 41, '../qr_codes/banquet_BookingID_41.png', '2025-04-08 00:48:16');

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

DROP TABLE IF EXISTS `rooms`;
CREATE TABLE IF NOT EXISTS `rooms` (
  `id` int NOT NULL AUTO_INCREMENT,
  `room_type` varchar(50) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `total_rooms` int NOT NULL,
  `image` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `room_type` (`room_type`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`id`, `room_type`, `price`, `total_rooms`, `image`) VALUES
(1, 'Deluxe', 8600.00, 20, 'duplex.jpg'),
(2, 'Suite', 49375.00, 10, 'suite.png'),
(3, 'Standard', 3500.00, 30, 'HMSimages/6.png');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `email` varchar(100) NOT NULL,
  `firstName` varchar(100) NOT NULL,
  `lastName` varchar(100) NOT NULL,
  `phone` varchar(10) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `firstName`, `lastName`, `phone`, `password`, `created_at`) VALUES
(41, 'harshil@gmail.com', 'Harshil', 'Mogariya', '9856786443', '1bbd886460827015e5d605ed44252251', '2025-02-18 04:15:44'),
(43, 'deepatel0024@gmail.com', 'deep', 'patel', '9913609357', '1bbd886460827015e5d605ed44252251', '2025-04-01 17:54:08'),
(44, 'harsh@gmail.com', 'Harsh', 'Mistry', '9898989898', 'bae5e3208a3c700e3db642b6631e95b9', '2025-04-08 00:43:34');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payments_ibfk_1` FOREIGN KEY (`booking_id`) REFERENCES `bookings` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
