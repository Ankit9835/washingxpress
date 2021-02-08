-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 08, 2021 at 05:29 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.3.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `washing_center`
--

-- --------------------------------------------------------

--
-- Table structure for table `add_point`
--

CREATE TABLE `add_point` (
  `apid` int(10) UNSIGNED NOT NULL,
  `customer_id` int(10) NOT NULL,
  `point_add` double NOT NULL,
  `contact` varchar(20) NOT NULL,
  `bill` varchar(200) NOT NULL,
  `bill_id` varchar(200) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `add_point`
--

INSERT INTO `add_point` (`apid`, `customer_id`, `point_add`, `contact`, `bill`, `bill_id`, `created_at`, `updated_at`) VALUES
(1, 18, 3, '8789596764', '50', '1234', '2019-12-12 17:30:06', '2019-12-12 17:30:06');

-- --------------------------------------------------------

--
-- Table structure for table `redeem_point`
--

CREATE TABLE `redeem_point` (
  `rid` int(10) UNSIGNED NOT NULL,
  `customer_id` int(10) NOT NULL,
  `r_point` double NOT NULL,
  `otp` varchar(20) NOT NULL,
  `contact` varchar(200) NOT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `redeem_point`
--

INSERT INTO `redeem_point` (`rid`, `customer_id`, `r_point`, `otp`, `contact`, `status`, `created_at`, `updated_at`) VALUES
(1, 18, 1, 'ApLHCfQ', '8789596764', '1', '2019-12-12 17:30:53', '2019-12-12 17:30:53');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `userid` int(10) NOT NULL,
  `username` varchar(200) NOT NULL,
  `useremail` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`userid`, `username`, `useremail`, `password`) VALUES
(3, 'washing123', 'washing@gmail.com', '12345'),
(5, 'test', 'test@gmail.com', '123456'),
(6, 'test123', 'anky@gmail.com', '12345');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_customer`
--

CREATE TABLE `tbl_customer` (
  `id` int(10) UNSIGNED NOT NULL,
  `admin_id` int(10) NOT NULL,
  `customer_name` varchar(200) NOT NULL,
  `aadhar_number` varchar(100) NOT NULL,
  `contact_number` varchar(20) NOT NULL,
  `card_number` varchar(200) NOT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_customer`
--

INSERT INTO `tbl_customer` (`id`, `admin_id`, `customer_name`, `aadhar_number`, `contact_number`, `card_number`, `status`) VALUES
(20, 3, 'Manish', '1234567891', '9504244335', '123456', '1');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_point`
--

CREATE TABLE `tbl_point` (
  `point_id` int(10) NOT NULL,
  `customer_id` int(10) NOT NULL,
  `total_point` int(10) NOT NULL,
  `redeem_point` int(10) NOT NULL,
  `current_point` int(10) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_point`
--

INSERT INTO `tbl_point` (`point_id`, `customer_id`, `total_point`, `redeem_point`, `current_point`, `created_at`, `updated_at`) VALUES
(20, 20, 0, 0, 0, '2019-12-18 15:04:09', '2019-12-18 15:04:09');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `add_point`
--
ALTER TABLE `add_point`
  ADD PRIMARY KEY (`apid`);

--
-- Indexes for table `redeem_point`
--
ALTER TABLE `redeem_point`
  ADD PRIMARY KEY (`rid`);

--
-- Indexes for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`userid`);

--
-- Indexes for table `tbl_customer`
--
ALTER TABLE `tbl_customer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_point`
--
ALTER TABLE `tbl_point`
  ADD PRIMARY KEY (`point_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `add_point`
--
ALTER TABLE `add_point`
  MODIFY `apid` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `redeem_point`
--
ALTER TABLE `redeem_point`
  MODIFY `rid` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `userid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_customer`
--
ALTER TABLE `tbl_customer`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `tbl_point`
--
ALTER TABLE `tbl_point`
  MODIFY `point_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
