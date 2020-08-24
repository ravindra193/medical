-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 21, 2017 at 05:09 AM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 7.0.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_medicalstore`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_bill_history`
--

CREATE TABLE `tbl_bill_history` (
  `id` int(20) NOT NULL,
  `bill_number` int(100) NOT NULL,
  `user_id` int(20) NOT NULL,
  `customer_id` int(20) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_bill_history`
--

INSERT INTO `tbl_bill_history` (`id`, `bill_number`, `user_id`, `customer_id`, `created_date`) VALUES
(1, 62222290, 1, 152, '2017-11-17 07:54:31'),
(3, 74591064, 1, 153, '2017-11-17 07:56:50');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_customer`
--

CREATE TABLE `tbl_customer` (
  `id` int(20) NOT NULL,
  `user_id` int(20) NOT NULL,
  `bill_number` int(20) NOT NULL,
  `customer_name` varchar(200) NOT NULL,
  `customer_mobile` varchar(20) NOT NULL,
  `address` text NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_customer`
--

INSERT INTO `tbl_customer` (`id`, `user_id`, `bill_number`, `customer_name`, `customer_mobile`, `address`, `created_date`, `updated_date`) VALUES
(194, 1, 180054, 'vrs', '445555454', '     surat                                                                               ', '2017-11-18 13:15:16', '0000-00-00 00:00:00'),
(195, 1, 87380981, 'gfgf', '34343434', ' bvbvb                                                                                   ', '2017-11-18 13:22:11', '0000-00-00 00:00:00'),
(196, 1, 85638427, 'gfgf', '34343434', ' bvbvb                                                                                   ', '2017-11-18 13:22:57', '0000-00-00 00:00:00'),
(199, 1, 29248047, 'gfgf', '34343434', ' bvbvb                                                                                   ', '2017-11-18 13:28:19', '0000-00-00 00:00:00'),
(200, 1, 40585327, 'gfgf', '34343434', ' bvbvb                                                                                   ', '2017-11-18 13:28:31', '0000-00-00 00:00:00'),
(201, 1, 92346191, 'gfgf', '34343434', ' bvbvb                                                                                   ', '2017-11-18 13:28:45', '0000-00-00 00:00:00'),
(202, 1, 50711060, 'gfgf', '34343434', ' bvbvb                                                                                   ', '2017-11-18 13:29:14', '0000-00-00 00:00:00'),
(203, 1, 81668091, 'gfgf', '34343434', ' bvbvb                                                                                   ', '2017-11-18 13:29:42', '0000-00-00 00:00:00'),
(207, 1, 94583129, 'dfdf', '232323', '                                      ddfd                                              ', '2017-11-18 13:44:35', '0000-00-00 00:00:00'),
(209, 1, 19454956, 'sina', '34434343434', '     sina                                                                              ', '2017-11-20 05:24:58', '0000-00-00 00:00:00'),
(210, 1, 80621338, 'jj', '3434', '      343                                                                              ', '2017-11-20 05:28:53', '0000-00-00 00:00:00'),
(211, 1, 47570801, 'ghgh', '565656', '     656                                                                               ', '2017-11-20 05:34:54', '0000-00-00 00:00:00'),
(212, 1, 16641236, 'ghgh', '565656', '     656                                                                               ', '2017-11-20 05:36:58', '0000-00-00 00:00:00'),
(213, 1, 85989380, 'ghg', '4545', '   fgfg                                                                                 ', '2017-11-20 05:37:40', '0000-00-00 00:00:00'),
(214, 1, 28964234, 'ghg', '4545', '   fgfg                                                                                 ', '2017-11-20 05:37:40', '0000-00-00 00:00:00'),
(215, 1, 39331055, 'dfdf', '434', '                                gfg                                                    ', '2017-11-20 05:43:32', '0000-00-00 00:00:00'),
(216, 1, 21517945, 'sds', '2323', '             dfdf                                                                       ', '2017-11-20 05:46:33', '0000-00-00 00:00:00'),
(217, 47, 2310181, 'jems', '23232323', '                  dfdf                                                                  ', '2017-11-20 05:55:29', '0000-00-00 00:00:00'),
(218, 1, 20266724, 'erer', '3434', '   rttrt                                                                                 ', '2017-11-20 13:17:34', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_inventory`
--

CREATE TABLE `tbl_inventory` (
  `id` int(20) NOT NULL,
  `user_id` int(20) NOT NULL COMMENT 'added by this user(permission) ',
  `supplier_id` int(20) NOT NULL,
  `product_category` varchar(200) NOT NULL,
  `product_name` varchar(200) NOT NULL,
  `product_sku` varchar(100) NOT NULL,
  `expiry_date` varchar(200) NOT NULL,
  `quantity` int(100) NOT NULL,
  `price` int(100) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_date` datetime NOT NULL,
  `is_active` tinyint(1) NOT NULL COMMENT 'no="0",yes="1" for sell'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_inventory`
--

INSERT INTO `tbl_inventory` (`id`, `user_id`, `supplier_id`, `product_category`, `product_name`, `product_sku`, `expiry_date`, `quantity`, `price`, `created_date`, `updated_date`, `is_active`) VALUES
(9, 1, 6, '2', 'medisin', '10', '11/23/2017', 45, 100, '2017-11-11 10:08:07', '2017-11-14 12:22:52', 1),
(10, 1, 6, '3', 'dfdf', '11', '11/24/2017', 44, 10, '2017-11-11 11:14:18', '2017-11-14 12:22:38', 1),
(11, 1, 5, '2', 'rose', '44', '11/30/2017', 100, 10, '2017-11-13 13:01:35', '2017-11-14 12:22:01', 1),
(12, 47, 5, '2', 'mouse', '648745', '11/30/2017', 0, 50, '2017-11-20 11:16:21', '2017-11-20 13:49:35', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_inventory_category`
--

CREATE TABLE `tbl_inventory_category` (
  `id` int(20) NOT NULL,
  `user_id` int(20) NOT NULL,
  `category_name` varchar(200) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_inventory_category`
--

INSERT INTO `tbl_inventory_category` (`id`, `user_id`, `category_name`, `created_date`, `updated_date`) VALUES
(2, 47, 'category 3', '2017-11-11 12:03:55', '2017-11-13 12:46:30'),
(3, 1, 'category 2', '2017-11-11 12:13:49', '2017-11-11 13:27:31');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_permissions`
--

CREATE TABLE `tbl_permissions` (
  `id` int(20) NOT NULL,
  `user_id` int(20) NOT NULL,
  `permission_name` varchar(200) NOT NULL,
  `permissions` text NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_permissions`
--

INSERT INTO `tbl_permissions` (`id`, `user_id`, `permission_name`, `permissions`, `created_date`, `updated_date`) VALUES
(24, 66, 'inventory', 'view,edit,delete', '2017-11-16 05:20:16', '0000-00-00 00:00:00'),
(25, 66, 'sell', 'view,edit,delete', '2017-11-16 05:20:17', '0000-00-00 00:00:00'),
(26, 66, 'bill', 'yes,no', '2017-11-16 05:20:17', '0000-00-00 00:00:00'),
(27, 66, 'report', 'view,edit,delete', '2017-11-16 05:20:17', '0000-00-00 00:00:00'),
(28, 64, 'inventory', 'view,edit', '2017-11-16 06:51:50', '0000-00-00 00:00:00'),
(29, 64, 'sell', 'edit', '2017-11-16 07:04:30', '0000-00-00 00:00:00'),
(30, 64, 'bill', 'yes,no', '2017-11-16 07:09:41', '0000-00-00 00:00:00'),
(31, 64, 'report', 'view', '2017-11-16 07:09:41', '0000-00-00 00:00:00'),
(32, 47, 'inventory', 'view,edit,delete', '2017-11-16 07:28:46', '0000-00-00 00:00:00'),
(33, 47, 'sell', 'view,edit,delete', '2017-11-16 07:28:46', '0000-00-00 00:00:00'),
(34, 47, 'bill', 'yes,no', '2017-11-16 07:28:46', '0000-00-00 00:00:00'),
(35, 47, 'report', 'view,edit,delete', '2017-11-16 07:28:46', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_permissions_list`
--

CREATE TABLE `tbl_permissions_list` (
  `id` int(20) NOT NULL,
  `permissions_name` varchar(200) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_permissions_list`
--

INSERT INTO `tbl_permissions_list` (`id`, `permissions_name`, `created_date`, `updated_date`) VALUES
(2, 'add_inventory', '2017-11-13 09:09:27', '2017-11-13 10:58:21'),
(3, 'view_inventory', '2017-11-13 09:57:26', '2017-11-13 10:58:24'),
(6, 'add_inventory_category', '2017-11-13 10:14:42', '0000-00-00 00:00:00'),
(9, 'delete_inventory', '2017-11-13 11:33:32', '0000-00-00 00:00:00'),
(10, 'delete_inventory_category', '2017-11-13 11:33:45', '0000-00-00 00:00:00'),
(11, 'view_inventory_category', '2017-11-13 11:33:54', '0000-00-00 00:00:00'),
(12, 'update_inventory_category', '2017-11-13 11:34:14', '0000-00-00 00:00:00'),
(13, 'update_inventory', '2017-11-13 11:58:21', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_sell_bill`
--

CREATE TABLE `tbl_sell_bill` (
  `id` int(20) NOT NULL,
  `bill_number` int(50) NOT NULL,
  `product_id` int(20) NOT NULL,
  `user_id` int(20) NOT NULL COMMENT 'created by this user ',
  `customer_id` int(20) NOT NULL,
  `description` text NOT NULL,
  `quantity` int(20) NOT NULL,
  `price` int(100) NOT NULL,
  `discount` text NOT NULL,
  `medicine_vat` int(10) NOT NULL,
  `total_price` int(200) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_sell_bill`
--

INSERT INTO `tbl_sell_bill` (`id`, `bill_number`, `product_id`, `user_id`, `customer_id`, `description`, `quantity`, `price`, `discount`, `medicine_vat`, `total_price`, `created_date`, `updated_date`) VALUES
(220, 80621338, 44, 1, 210, 'hjhj', 1, 10, '0', 10, 111, '2017-11-20 05:28:53', '0000-00-00 00:00:00'),
(221, 80621338, 10, 1, 210, 'hjhj', 1, 100, '0', 10, 111, '2017-11-20 05:28:54', '0000-00-00 00:00:00'),
(222, 85989380, 44, 1, 213, 'fgfg', 2, 20, '0', 10, 36, '2017-11-20 05:37:40', '0000-00-00 00:00:00'),
(223, 85989380, 44, 1, 213, 'fgfg', 1, 10, '0', 10, 36, '2017-11-20 05:37:40', '0000-00-00 00:00:00'),
(224, 28964234, 44, 1, 214, 'fgfg', 2, 20, '0', 10, 36, '2017-11-20 05:37:40', '0000-00-00 00:00:00'),
(225, 28964234, 44, 1, 214, 'fgfg', 1, 10, '0', 10, 36, '2017-11-20 05:37:41', '0000-00-00 00:00:00'),
(226, 39331055, 44, 1, 215, 'fgfg', 1, 10, '0', 10, 10, '2017-11-20 05:43:33', '0000-00-00 00:00:00'),
(227, 39331055, 44, 1, 215, 'fgfg', 2, 10, '0', 10, 20, '2017-11-20 05:43:33', '0000-00-00 00:00:00'),
(228, 21517945, 44, 1, 216, 'gfgf', 1, 10, '0', 10, 10, '2017-11-20 05:46:33', '0000-00-00 00:00:00'),
(229, 2310181, 44, 47, 217, 'dfdf', 1, 10, '0', 1, 10, '2017-11-20 05:55:29', '0000-00-00 00:00:00'),
(230, 20266724, 44, 1, 218, 'rtrt', 1, 10, '0', 10, 10, '2017-11-20 13:17:34', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_supplier`
--

CREATE TABLE `tbl_supplier` (
  `id` int(20) NOT NULL,
  `first_name` varchar(200) NOT NULL,
  `last_name` varchar(200) NOT NULL,
  `email` varchar(100) NOT NULL,
  `mobile_no` int(20) NOT NULL,
  `gender` varchar(100) NOT NULL,
  `profile` text NOT NULL,
  `address` text NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated` datetime NOT NULL,
  `is_active` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_supplier`
--

INSERT INTO `tbl_supplier` (`id`, `first_name`, `last_name`, `email`, `mobile_no`, `gender`, `profile`, `address`, `created`, `updated`, `is_active`) VALUES
(5, 'kk', 'kk', 'ravindra@tecocraft.com', 2147483647, 'male', 'Desert.jpg', 'hjhj', '2017-11-10 11:24:02', '0000-00-00 00:00:00', 1),
(6, 'joy', 'joy', 'joy@gmail.com', 456327895, 'male', 'Lighthouse.jpg', 'london', '2017-11-10 11:39:39', '0000-00-00 00:00:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_detail`
--

CREATE TABLE `user_detail` (
  `id` int(11) NOT NULL,
  `first_name` varchar(200) NOT NULL,
  `last_name` varchar(200) NOT NULL,
  `username` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` varchar(255) NOT NULL,
  `gender` varchar(20) NOT NULL,
  `profile` text NOT NULL,
  `photo_id` text NOT NULL,
  `dob` varchar(100) NOT NULL,
  `mobile_no` varchar(20) NOT NULL,
  `address` text NOT NULL,
  `medicine_vat` int(10) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated` datetime NOT NULL,
  `roll` varchar(200) NOT NULL,
  `is_active` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_detail`
--

INSERT INTO `user_detail` (`id`, `first_name`, `last_name`, `username`, `email`, `password`, `gender`, `profile`, `photo_id`, `dob`, `mobile_no`, `address`, `medicine_vat`, `created`, `updated`, `roll`, `is_active`) VALUES
(1, 'ravindra', 'hjhj', 'admin', 'ravindra@tecocraft.com', '21232f297a57a5a743894a0e4a801fc3', 'male', '', '', 'ADMIN', '2147483647', 'hjhjhj', 10, '2017-11-20 05:01:44', '2017-10-30 10:20:53', '0', ''),
(38, 'kk', 'kkghgh', 'kk', 'kk@gmail.com', 'dc468c70fb574ebd07287b38d0d0676d', 'male', 'Chrysanthemum3.jpg', '', '', '323278454', 'kk', 0, '2017-11-10 09:37:36', '0000-00-00 00:00:00', '1', '1'),
(46, 'monalisa', 'monalisa', 'monalisa', 'monalisa@gmail.com', '845ba0dc1e457673aed2044a39ec6b5a', 'female', 'Lighthouse.jpg', '', '', '1236547895', 'monalisa', 0, '2017-11-10 09:38:02', '0000-00-00 00:00:00', '1', '1'),
(47, 'jems', 'jems1', 'jems', 'jems@gmail.com', 'd268730a1be879df70cea522f3bcc9e5', 'male', 'Chrysanthemum4.jpg', '', '', '5463217895', 'uk', 1, '2017-11-20 04:56:48', '0000-00-00 00:00:00', '1', '1'),
(64, 'mahi', 'mahi', 'mahi', 'mahi@tecocraft.com', '99941a8015cd830b498cd9f0ddf4a500', 'male', 'Koala1.jpg', '', '', '434233222', 'hgdfsdff', 0, '2017-11-13 07:20:50', '0000-00-00 00:00:00', '1', '1'),
(65, 'dfdf', 'sdssd', 'vbxasa', 'ravindsddra@tecocraft.com', '7aeabdcbb7dc8db900d7dc1a303b4821', 'male', 'Chrysanthemum2.jpg', '', '', '3434223231', 'fggdfdf', 0, '2017-11-10 08:45:47', '0000-00-00 00:00:00', '1', '1'),
(66, 'dfdf', 'sdfsdsd', 'sdsdsd', 'ravindrasdsd@tecocraft.com', 'c8288d40aa02a4fd133fcd6684ffb46d', 'male', '', '', '', '2323233434', 'sdsd', 0, '2017-11-16 05:20:16', '0000-00-00 00:00:00', '1', '1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_bill_history`
--
ALTER TABLE `tbl_bill_history`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_customer`
--
ALTER TABLE `tbl_customer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_inventory`
--
ALTER TABLE `tbl_inventory`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_inventory_category`
--
ALTER TABLE `tbl_inventory_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_permissions`
--
ALTER TABLE `tbl_permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_permissions_list`
--
ALTER TABLE `tbl_permissions_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_sell_bill`
--
ALTER TABLE `tbl_sell_bill`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_supplier`
--
ALTER TABLE `tbl_supplier`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_detail`
--
ALTER TABLE `user_detail`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_bill_history`
--
ALTER TABLE `tbl_bill_history`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `tbl_customer`
--
ALTER TABLE `tbl_customer`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=219;
--
-- AUTO_INCREMENT for table `tbl_inventory`
--
ALTER TABLE `tbl_inventory`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `tbl_inventory_category`
--
ALTER TABLE `tbl_inventory_category`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `tbl_permissions`
--
ALTER TABLE `tbl_permissions`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;
--
-- AUTO_INCREMENT for table `tbl_permissions_list`
--
ALTER TABLE `tbl_permissions_list`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `tbl_sell_bill`
--
ALTER TABLE `tbl_sell_bill`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=231;
--
-- AUTO_INCREMENT for table `tbl_supplier`
--
ALTER TABLE `tbl_supplier`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `user_detail`
--
ALTER TABLE `user_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
