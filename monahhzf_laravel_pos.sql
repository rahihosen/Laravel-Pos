-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 17, 2021 at 07:19 AM
-- Server version: 10.3.28-MariaDB-log-cll-lve
-- PHP Version: 7.3.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `monahhzf_laravel_pos`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `account_id` int(10) NOT NULL,
  `account_name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `account_branch` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `account_no` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `account_type` int(11) NOT NULL,
  `account_created_by` int(11) NOT NULL,
  `account_created_date` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `account_created_time` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `account_updated_by` int(11) DEFAULT NULL,
  `account_updated_date` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `account_updated_time` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`account_id`, `account_name`, `account_branch`, `account_no`, `account_type`, `account_created_by`, `account_created_date`, `account_created_time`, `account_updated_by`, `account_updated_date`, `account_updated_time`) VALUES
(1, 'Cash ', 'Bright ', '01', 1, 10, '2020-08-24', '15:14:51', NULL, NULL, NULL),
(2, 'UCB ', 'Anderkilla ', '02', 2, 10, '2020-08-24', '15:15:14', NULL, NULL, NULL),
(3, 'EBL', 'Agrabad', '10101', 2, 10, '2020-11-01', '14:45:34', NULL, NULL, NULL),
(4, 'Cash', 'CTG', '101', 1, 10, '2020-12-21', '16:35:33', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `admin_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `admin_role` int(11) NOT NULL DEFAULT 1,
  `admin_status` tinyint(1) NOT NULL DEFAULT 1,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `admin_created_by` int(4) DEFAULT NULL,
  `admin_created_date` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `admin_created_time` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `admin_updated_by` int(4) DEFAULT NULL,
  `admin_updated_time` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `admin_updated_date` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`, `email`, `admin_image`, `password`, `admin_role`, `admin_status`, `remember_token`, `admin_created_by`, `admin_created_date`, `admin_created_time`, `admin_updated_by`, `admin_updated_time`, `admin_updated_date`) VALUES
(1, 'Bright Master Admin', 'bright@email.com', 'public/admin_image/122639users-vector-icon-png_260862.jpg', '$2y$12$sFMcsb1It/SNuiAC4jc9BeXFYaFUcJ8Wf9KKOzyfyGJqdbnyEmPi.', 1, 1, 'LIfnXKVkUtdaYJwkBn8YCgbdQosae2w9QfZmeXBpFG8YkCsuGFsKEBMo3sXM', NULL, NULL, NULL, 1, '18:36:46', '2019-04-16'),
(8, 'Rubel', 'rubel@email.com', 'public/admin_image/123331users-vector-icon-png_260862.jpg', '$2y$10$FbwnCPO7L9fRxNQzmb75seCiLU/KGrMqQSK4eupgV02l8yn7Roby6', 2, 0, 'mK8EvdtPSXhNbAoEm6HgKURf8WSooYKNrrRh7LoHYhUaB2XgoEWbgRU1I5Oy', 1, '2020-02-09', '12:33:31', 10, '14:30:40', '2020-11-01'),
(9, 'Imu', 'imu@email.com', 'public/admin_image/15550820180505_133900.png', '$2y$10$6KGFV/fJQTCbR.KENdF0KOWyOGcu9yvM8RTv.12L0pc8ohcG/NkAO', 1, 1, 'VnB6XbI8pnzAjBinq96weKbLwbb7Fhe9oS1uDxR0TKMSk4bAjoFGWK4wD4np', 1, '2020-02-24', '15:55:08', NULL, NULL, NULL),
(10, 'Demo', 'admin@email.com', 'public/admin_image/131352security-4868172_1280.jpg', '$2y$12$sFMcsb1It/SNuiAC4jc9BeXFYaFUcJ8Wf9KKOzyfyGJqdbnyEmPi.', 1, 1, 'Y7V2TDZss8TFRVJYOEyKgEAPxtkUsBh13yzr645p6PtIEPpXTcnLZNgciSsQ', NULL, NULL, NULL, NULL, NULL, NULL),
(11, 'rahi', 'sale@email.com', 'public/admin_image/154635Deshbarta-logo.jpg', '$2y$10$G./H.TFzZRHnGTj7qaH9VuV6tGa7tr.3gnXR.RAKx4WNt02a5Iy02', 3, 1, 'MF2zTU3sddF4EZFcDeGowGlfOtTC6A9tvhdOKNYCWqrBCRhk4LMqEN8pOknK', 10, '2020-12-09', '15:46:35', NULL, NULL, NULL),
(12, 'bijoy', 'bijoymoon222@gmail.com', 'public/admin_image/170442105629190_167267524780137_2741402992929283120_n.jpg', '$2y$10$phJ1aPczlzxeJhlOUn3s6uG9i4fHM9.9GzAJufUlh8w4B3i8lxxiu', 3, 1, NULL, 10, '2020-12-21', '17:04:42', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `admin_role`
--

CREATE TABLE `admin_role` (
  `role_id` int(11) NOT NULL,
  `admin_role_features` varchar(255) NOT NULL,
  `manager_role_features` varchar(255) NOT NULL,
  `salesman_role_features` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admin_role`
--

INSERT INTO `admin_role` (`role_id`, `admin_role_features`, `manager_role_features`, `salesman_role_features`) VALUES
(1, '1,2,3,4,5,6,7,8', '3,4,5,6,7,8', '4,7,9');

-- --------------------------------------------------------

--
-- Table structure for table `balance_table`
--

CREATE TABLE `balance_table` (
  `balance_id` int(11) NOT NULL,
  `account_id` int(11) NOT NULL,
  `balance_type` int(10) DEFAULT NULL,
  `ammount` double(10,2) NOT NULL,
  `note` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `balance_created_by` int(11) NOT NULL,
  `balance_created_date` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `balance_created_time` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `order_id` int(11) NOT NULL DEFAULT 0,
  `purchase_id` int(11) NOT NULL DEFAULT 0,
  `deposit_id` int(11) NOT NULL DEFAULT 0,
  `loan_id` int(11) NOT NULL DEFAULT 0,
  `transfer_id` int(11) NOT NULL DEFAULT 0,
  `expense_id` int(11) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `balance_table`
--

INSERT INTO `balance_table` (`balance_id`, `account_id`, `balance_type`, `ammount`, `note`, `balance_created_by`, `balance_created_date`, `balance_created_time`, `status`, `order_id`, `purchase_id`, `deposit_id`, `loan_id`, `transfer_id`, `expense_id`) VALUES
(1, 1, 6, 1500.00, 'Income from orders', 10, '2020-08-24', '15:15:57', 0, 1, 0, 0, 0, 0, 0),
(2, 1, 6, 2900.00, 'Income from orders', 10, '2020-08-24', '15:36:13', 0, 2, 0, 0, 0, 0, 0),
(3, 1, 1, 37000.00, '', 10, '2020-08-24', '15:38:49', 1, 0, 0, 1, 0, 0, 0),
(4, 1, 6, 900.00, 'Income from orders', 10, '2020-11-01', '14:42:29', 1, 3, 0, 0, 0, 0, 0),
(5, 3, 1, 1000.00, '', 10, '2020-11-01', '14:46:22', 1, 0, 0, 2, 0, 0, 0),
(6, 1, 6, 1.00, 'Income from orders', 10, '2020-11-05', '12:43:04', 1, 4, 0, 0, 0, 0, 0),
(7, 1, 6, 25.00, 'Income from orders', 10, '2020-11-05', '15:45:20', 1, 5, 0, 0, 0, 0, 0),
(8, 1, 6, 10.00, 'Income from orders', 10, '2020-11-05', '16:59:50', 1, 6, 0, 0, 0, 0, 0),
(9, 1, 6, 12.00, 'Income from orders', 10, '2020-11-07', '10:52:08', 1, 7, 0, 0, 0, 0, 0),
(10, 1, 6, 45.00, 'Income from orders', 10, '2020-11-07', '10:53:47', 1, 8, 0, 0, 0, 0, 0),
(11, 1, 6, 4.00, 'Income from orders', 10, '2020-11-07', '10:57:36', 1, 9, 0, 0, 0, 0, 0),
(12, 1, 6, 4.00, 'Income from orders', 10, '2020-11-07', '10:58:51', 1, 10, 0, 0, 0, 0, 0),
(13, 1, 6, 12.00, 'Income from orders', 10, '2020-11-07', '11:06:15', 1, 11, 0, 0, 0, 0, 0),
(14, 1, 6, 90.00, 'Income from orders', 10, '2020-11-07', '11:12:14', 1, 12, 0, 0, 0, 0, 0),
(15, 1, 9, 12345.00, 'Supply Expenses (Purchase)', 10, '2020-11-07', '12:00:59', 1, 0, 2, 0, 0, 0, 0),
(16, 1, 6, 0.00, 'Income from orders', 10, '2020-11-07', '14:51:48', 1, 13, 0, 0, 0, 0, 0),
(17, 1, 6, 100.00, 'Income from orders', 10, '2020-11-07', '14:52:52', 1, 14, 0, 0, 0, 0, 0),
(18, 1, 6, 772.00, 'Income from orders', 10, '2020-11-08', '13:58:36', 1, 16, 0, 0, 0, 0, 0),
(19, 1, 6, 2.00, 'Income from orders', 10, '2020-11-08', '14:51:00', 1, 17, 0, 0, 0, 0, 0),
(20, 1, 6, 9.00, 'Income from orders', 10, '2020-11-08', '15:52:46', 1, 18, 0, 0, 0, 0, 0),
(21, 1, 6, 5.00, 'Income from orders', 10, '2020-11-08', '15:59:35', 1, 22, 0, 0, 0, 0, 0),
(22, 1, 6, 500.00, 'Income from orders', 10, '2020-11-09', '10:36:47', 1, 23, 0, 0, 0, 0, 0),
(23, 1, 6, 100.00, 'Income from orders', 10, '2020-11-09', '15:46:24', 1, 24, 0, 0, 0, 0, 0),
(24, 1, 6, 260.00, 'Income from orders', 10, '2020-11-09', '16:24:29', 1, 25, 0, 0, 0, 0, 0),
(25, 1, 9, 1000.00, 'Supply Expenses (Purchase)', 10, '2020-11-10', '10:51:00', 1, 0, 3, 0, 0, 0, 0),
(26, 1, 9, 17000.00, 'Supply Expenses (Purchase)', 10, '2020-11-10', '10:52:44', 1, 0, 4, 0, 0, 0, 0),
(27, 1, 6, 10.00, 'Income from orders', 10, '2020-11-10', '11:09:45', 0, 26, 0, 0, 0, 0, 0),
(28, 1, 9, 48.00, 'Supply Expenses (Purchase)', 10, '2020-11-12', '10:48:53', 1, 0, 5, 0, 0, 0, 0),
(29, 1, 9, 30.00, 'Supply Expenses (Purchase)', 10, '2020-11-12', '10:59:45', 1, 0, 6, 0, 0, 0, 0),
(30, 1, 9, 35.00, 'Supply Expenses (Purchase)', 10, '2020-11-12', '11:23:09', 1, 0, 7, 0, 0, 0, 0),
(31, 1, 9, 15.00, 'Supply Expenses (Purchase)', 10, '2020-11-12', '11:26:01', 1, 0, 8, 0, 0, 0, 0),
(32, 1, 9, 12.00, 'Supply Expenses (Purchase)', 10, '2020-11-12', '12:29:07', 1, 0, 9, 0, 0, 0, 0),
(33, 1, 9, 30.00, 'Supply Expenses (Purchase)', 10, '2020-11-12', '16:00:10', 1, 0, 10, 0, 0, 0, 0),
(34, 1, 6, 300.00, 'Income from orders', 10, '2020-11-16', '16:58:47', 0, 27, 0, 0, 0, 0, 0),
(35, 1, 9, 2000.00, 'Supply Expenses (Purchase)', 10, '2020-11-16', '17:00:14', 1, 0, 11, 0, 0, 0, 0),
(36, 1, 9, 100.00, 'Supply Expenses (Purchase)', 10, '2020-11-16', '18:15:29', 1, 0, 12, 0, 0, 0, 0),
(37, 1, 6, 1000.00, 'Income from orders', 10, '2020-11-16', '18:19:31', 0, 28, 0, 0, 0, 0, 0),
(38, 1, 6, 0.00, 'Income from orders', 10, '2020-11-16', '20:39:39', 0, 29, 0, 0, 0, 0, 0),
(39, 1, 1, 1000.00, '', 10, '2020-11-16', '20:55:51', 1, 0, 0, 3, 0, 0, 0),
(40, 1, 2, 2000.00, 'lkjlkj', 10, '2020-11-16', '21:00:26', 1, 0, 0, 0, 1, 0, 0),
(41, 1, 3, 1000.00, 'jhgjiu', 10, '2020-11-16', '21:00:55', 1, 0, 0, 0, 1, 0, 0),
(42, 1, 7, 200.00, '', 10, '2020-11-16', '21:02:08', 1, 0, 0, 0, 0, 1, 0),
(43, 2, 8, 200.00, '', 10, '2020-11-16', '21:02:08', 1, 0, 0, 0, 0, 1, 0),
(44, 1, 9, 20.00, 'Supply Expenses (Purchase)', 10, '2020-11-24', '12:02:32', 1, 0, 13, 0, 0, 0, 0),
(45, 1, 9, 10.00, 'Supply Expenses (Purchase)', 10, '2020-11-24', '12:05:15', 1, 0, 14, 0, 0, 0, 0),
(46, 1, 9, 80.00, 'Supply Expenses (Purchase)', 10, '2020-11-24', '12:11:30', 1, 0, 15, 0, 0, 0, 0),
(47, 1, 6, 80.00, 'Income from orders', 10, '2020-11-25', '16:57:42', 0, 30, 0, 0, 0, 0, 0),
(48, 1, 5, 2000.00, 'dfredfred', 10, '2020-11-26', '12:36:09', 1, 0, 0, 0, 0, 0, 1),
(49, 1, 6, 200.00, 'Income from orders', 10, '2020-12-09', '15:41:13', 1, 31, 0, 0, 0, 0, 0),
(50, 1, 6, 1000.00, 'Income from orders', 11, '2020-12-09', '15:48:08', 1, 32, 0, 0, 0, 0, 0),
(51, 1, 6, 200.00, 'Income from orders', 10, '2020-12-09', '15:56:38', 1, 33, 0, 0, 0, 0, 0),
(52, 1, 6, 100.00, 'Income from orders', 10, '2020-12-09', '15:59:27', 1, 34, 0, 0, 0, 0, 0),
(53, 1, 6, 10000.00, 'Income from orders', 10, '2020-12-12', '17:01:55', 1, 35, 0, 0, 0, 0, 0),
(54, 1, 6, 500.00, 'Income from orders', 10, '2020-12-15', '12:50:26', 1, 36, 0, 0, 0, 0, 0),
(55, 1, 6, 2000.00, 'Income from orders', 11, '2020-12-15', '15:51:16', 1, 37, 0, 0, 0, 0, 0),
(56, 1, 6, 2000.00, 'Income from orders', 10, '2020-12-17', '11:07:51', 1, 38, 0, 0, 0, 0, 0),
(57, 1, 6, 500.00, 'Income from orders', 10, '2020-12-17', '13:26:12', 1, 39, 0, 0, 0, 0, 0),
(58, 1, 6, 1000.00, 'Income from orders', 10, '2020-12-17', '13:29:33', 1, 40, 0, 0, 0, 0, 0),
(59, 1, 6, 200.00, 'Income from orders', 10, '2020-12-17', '13:30:08', 1, 41, 0, 0, 0, 0, 0),
(60, 1, 6, 200.00, 'Income from orders', 10, '2020-12-17', '15:39:31', 1, 42, 0, 0, 0, 0, 0),
(61, 1, 6, 200.00, 'Income from orders', 11, '2020-12-19', '15:56:33', 1, 43, 0, 0, 0, 0, 0),
(62, 1, 6, 500.00, 'Income from orders', 10, '2020-12-20', '13:20:41', 1, 44, 0, 0, 0, 0, 0),
(63, 1, 6, 500.00, 'Income from orders', 10, '2020-12-20', '13:22:21', 1, 45, 0, 0, 0, 0, 0),
(64, 1, 6, 500.00, 'Income from orders', 10, '2020-12-20', '13:43:21', 1, 46, 0, 0, 0, 0, 0),
(65, 1, 6, 500.00, 'Income from orders', 10, '2020-12-20', '15:47:35', 1, 47, 0, 0, 0, 0, 0),
(66, 1, 6, 500.00, 'Income from orders', 10, '2020-12-21', '15:43:47', 1, 48, 0, 0, 0, 0, 0),
(67, 1, 6, 10000.00, 'Income from orders', 10, '2020-12-21', '16:22:39', 1, 49, 0, 0, 0, 0, 0),
(68, 1, 6, 200.00, 'Income from orders', 10, '2020-12-21', '16:24:25', 1, 50, 0, 0, 0, 0, 0),
(69, 1, 1, 500.00, 'N/A', 10, '2020-12-21', '16:35:54', 1, 0, 0, 4, 0, 0, 0),
(70, 1, 6, 275.00, 'Income from orders', 10, '2020-12-21', '17:07:30', 1, 51, 0, 0, 0, 0, 0),
(71, 1, 6, 300.00, 'Income from orders', 10, '2020-12-22', '15:23:30', 1, 54, 0, 0, 0, 0, 0),
(72, 1, 6, 200.00, 'Income from orders', 10, '2020-12-23', '16:50:13', 1, 55, 0, 0, 0, 0, 0),
(73, 1, 6, 200.00, 'Income from orders', 10, '2020-12-23', '16:51:39', 1, 56, 0, 0, 0, 0, 0),
(74, 1, 6, 500.00, 'Income from orders', 10, '2020-12-23', '16:53:07', 1, 57, 0, 0, 0, 0, 0),
(75, 1, 6, 232.00, 'Income from orders', 10, '2021-02-25', '17:57:33', 1, 58, 0, 0, 0, 0, 0),
(76, 1, 6, 123.00, 'Income from orders', 10, '2021-02-25', '17:58:01', 1, 59, 0, 0, 0, 0, 0),
(77, 1, 2, 62.00, 'Vero aperiam veniam', 10, '2021-02-25', '17:58:48', 1, 0, 0, 0, 2, 0, 0),
(78, 4, 7, 16.00, 'Repellendus Aut omn', 10, '2021-02-25', '17:59:20', 1, 0, 0, 0, 0, 2, 0),
(79, 2, 8, 16.00, 'Repellendus Aut omn', 10, '2021-02-25', '17:59:20', 1, 0, 0, 0, 0, 2, 0),
(80, 1, 6, 500.00, 'Income from orders', 10, '2021-04-12', '11:18:17', 1, 60, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `buyers`
--

CREATE TABLE `buyers` (
  `buyer_id` int(11) NOT NULL,
  `buyer_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `buyer_mobile` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `buyer_email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `previous_due` int(255) DEFAULT NULL,
  `buyer_address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `buyer_created_by` int(11) NOT NULL,
  `buyer_created_date` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `buyer_created_time` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `buyer_updated_by` int(11) DEFAULT NULL,
  `buyer_updated_date` datetime DEFAULT NULL,
  `buyer_updated_time` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `buyers`
--

INSERT INTO `buyers` (`buyer_id`, `buyer_name`, `buyer_mobile`, `buyer_email`, `previous_due`, `buyer_address`, `buyer_created_by`, `buyer_created_date`, `buyer_created_time`, `buyer_updated_by`, `buyer_updated_date`, `buyer_updated_time`) VALUES
(4, 'Amulet Pharmaceuticals Ltd', '520', '', 200, '', 10, '2020-11-16', '16:57:30', NULL, NULL, NULL),
(3, 'ACI Limited ', '20200220202020', '', 20, '', 10, '2020-11-16', '16:56:52', NULL, NULL, NULL),
(5, 'ACME Laboratories Ltd', '8088080', '', 200, '', 10, '2020-11-16', '16:58:01', NULL, NULL, NULL),
(6, 'dsff', '4654646', 'wee@email.com', 0, 'dwerwr', 10, '2020-11-16', '17:07:38', NULL, NULL, NULL),
(7, 'SDFERFE', '46464', 'supplier@email.com', 2, 'DFFERFE', 10, '2020-11-16', '17:14:02', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `category_id` int(10) UNSIGNED NOT NULL,
  `category_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `parent_cat` int(100) DEFAULT NULL,
  `category_order` int(11) DEFAULT NULL,
  `special_menu` int(11) NOT NULL,
  `category_status` tinyint(4) NOT NULL,
  `category_created_date` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_created_time` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_created_by` int(11) NOT NULL,
  `category_updated_date` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `category_updated_time` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `category_updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `category_name`, `parent_cat`, `category_order`, `special_menu`, `category_status`, `category_created_date`, `category_created_time`, `category_created_by`, `category_updated_date`, `category_updated_time`, `category_updated_by`) VALUES
(7, '5-Fluorouracil [5-FU]', 0, 1, 1, 1, '2020-11-16', '16:51:56', 10, NULL, NULL, NULL),
(8, '5 FU PhaRes', 0, 2, 1, 1, '2020-11-16', '16:52:16', 10, NULL, NULL, NULL),
(9, ' Fluroxan', 0, 20, 1, 1, '2020-11-16', '16:52:47', 10, NULL, NULL, NULL),
(10, 'Acitretin', 0, 5, 1, 1, '2020-11-16', '16:53:20', 10, NULL, NULL, NULL),
(11, 'you', NULL, NULL, 1, 1, '2020-11-16', '17:03:26', 10, NULL, NULL, NULL),
(12, 'love', NULL, 2, 1, 1, '2020-11-17', '15:38:52', 10, '2020-11-17', '15:39:15', 10);

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `customer_id` int(10) UNSIGNED NOT NULL,
  `customer_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `customer_mobile` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `customer_email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `customer_address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `customer_nid` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `customer_group_id` int(11) DEFAULT NULL,
  `credit_limit` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT '0',
  `prev_due` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `customer_created_by` int(11) DEFAULT NULL,
  `customer_created_date` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `customer_created_time` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `customer_updated_date` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `customer_updated_time` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `customer_updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`customer_id`, `customer_name`, `customer_mobile`, `customer_email`, `customer_address`, `customer_nid`, `customer_group_id`, `credit_limit`, `prev_due`, `customer_created_by`, `customer_created_date`, `customer_created_time`, `customer_updated_date`, `customer_updated_time`, `customer_updated_by`) VALUES
(7, 'Thistest', '66666', '', NULL, '', 3, '600', NULL, 10, '2020-11-16', '18:16:39', NULL, NULL, NULL),
(8, 'Afser', '01766215878', 'admin@email.com', NULL, '123456789', 3, '0', NULL, 10, '2020-11-16', '20:39:39', NULL, NULL, NULL),
(9, 'This is test', '', '', NULL, '', 3, '', NULL, 10, '2020-11-16', '20:44:44', NULL, NULL, NULL),
(10, 'hanif', '01251402', NULL, NULL, NULL, NULL, NULL, NULL, 10, '2020-11-22', '15:53:17', NULL, NULL, NULL),
(11, 'Tanvir hosen', '012365541', NULL, 'ctg', NULL, NULL, NULL, NULL, 10, '2020-12-17', '15:38:38', NULL, NULL, NULL),
(12, 'Maa Pharmacy', '01827271707', 'afser@afser.com', NULL, '12555', 3, '0', NULL, 10, '2020-12-21', '16:24:25', NULL, NULL, NULL),
(13, 'rahi', '464646', NULL, 'edwdwed', NULL, NULL, NULL, '5000', 10, '2020-12-23', '13:11:26', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `customer_extra_payment`
--

CREATE TABLE `customer_extra_payment` (
  `c_p_id` int(11) NOT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `order_id` int(11) DEFAULT NULL,
  `account_id` int(11) DEFAULT NULL,
  `amount` double(10,2) DEFAULT NULL,
  `note` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `check_no` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `transaction` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) DEFAULT 1,
  `created_by` int(10) DEFAULT NULL,
  `created_date` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_time` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customer_extra_payment`
--

INSERT INTO `customer_extra_payment` (`c_p_id`, `customer_id`, `order_id`, `account_id`, `amount`, `note`, `check_no`, `transaction`, `status`, `created_by`, `created_date`, `created_time`) VALUES
(2, 11, 48, 1, 300.00, '', '', '', 1, 10, '2020-12-21', '15:45:03'),
(3, 13, 57, 1, 200.00, '', '', '', 1, 10, '2020-12-23', '16:54:10'),
(4, 13, 55, 1, 100.00, '', '', '', 1, 10, '2020-12-23', '16:59:54');

-- --------------------------------------------------------

--
-- Table structure for table `customer_group`
--

CREATE TABLE `customer_group` (
  `group_id` int(11) NOT NULL,
  `group_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_date` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_time` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `updated_date` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_time` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer_group`
--

INSERT INTO `customer_group` (`group_id`, `group_name`, `created_by`, `created_date`, `created_time`, `updated_by`, `updated_date`, `updated_time`) VALUES
(3, 'VIP', 10, '2020-11-16', '18:16:21', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `expenses`
--

CREATE TABLE `expenses` (
  `expenses_id` int(11) NOT NULL,
  `expenses_head_id` int(11) NOT NULL,
  `expenses_sub_head_id` int(11) NOT NULL,
  `account_id` int(11) NOT NULL,
  `expenses_ammount` double(8,2) NOT NULL,
  `expenses_note` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expenses_created_by` int(11) NOT NULL,
  `expenses_created_date` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expenses_created_time` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `expenses`
--

INSERT INTO `expenses` (`expenses_id`, `expenses_head_id`, `expenses_sub_head_id`, `account_id`, `expenses_ammount`, `expenses_note`, `expenses_created_by`, `expenses_created_date`, `expenses_created_time`) VALUES
(1, 1, 1, 1, 2000.00, 'dfredfred', 10, '2020-11-26', '12:36:09');

-- --------------------------------------------------------

--
-- Table structure for table `expenses_head`
--

CREATE TABLE `expenses_head` (
  `expenses_head_id` int(11) NOT NULL,
  `expenses_head_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expenses_head_created_by` int(11) NOT NULL,
  `expenses_head_created_date` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expenses_head_created_time` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expenses_head_updated_by` int(11) DEFAULT NULL,
  `expenses_head_updated_date` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `expenses_head_updated_time` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `expenses_head`
--

INSERT INTO `expenses_head` (`expenses_head_id`, `expenses_head_name`, `expenses_head_created_by`, `expenses_head_created_date`, `expenses_head_created_time`, `expenses_head_updated_by`, `expenses_head_updated_date`, `expenses_head_updated_time`) VALUES
(1, 'operation expance', 10, '2020-11-26', '12:35:12', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `expenses_sub_head`
--

CREATE TABLE `expenses_sub_head` (
  `expenses_sub_head_id` int(11) NOT NULL,
  `expenses_head_id` int(11) NOT NULL,
  `expenses_sub_head_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expenses_sub_head_created_by` int(11) NOT NULL,
  `expenses_sub_head_created_date` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expenses_sub_head_created_time` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expenses_sub_head_updated_by` int(11) DEFAULT NULL,
  `expenses_sub_head_updated_date` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `expenses_sub_head_updated_time` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `expenses_sub_head`
--

INSERT INTO `expenses_sub_head` (`expenses_sub_head_id`, `expenses_head_id`, `expenses_sub_head_name`, `expenses_sub_head_created_by`, `expenses_sub_head_created_date`, `expenses_sub_head_created_time`, `expenses_sub_head_updated_by`, `expenses_sub_head_updated_date`, `expenses_sub_head_updated_time`) VALUES
(1, 1, 'supplies', 10, '2020-11-26', '12:35:54', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `investment_table`
--

CREATE TABLE `investment_table` (
  `investment_id` int(11) NOT NULL,
  `account_id` int(11) NOT NULL,
  `ammount` double NOT NULL,
  `note` varchar(250) NOT NULL,
  `balance_created_by` int(11) NOT NULL,
  `balance_created_date` varchar(20) NOT NULL,
  `balance_created_time` varchar(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `investment_table`
--

INSERT INTO `investment_table` (`investment_id`, `account_id`, `ammount`, `note`, `balance_created_by`, `balance_created_date`, `balance_created_time`) VALUES
(4, 1, 500, 'N/A', 10, '2020-12-21', '16:35:54');

-- --------------------------------------------------------

--
-- Table structure for table `loans_table`
--

CREATE TABLE `loans_table` (
  `loan_id` int(11) NOT NULL,
  `account_id` int(11) NOT NULL,
  `loan_ammount` double(10,2) NOT NULL,
  `loan_description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `loan_created_by` int(10) NOT NULL,
  `loan_created_date` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `loan_created_time` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `loans_table`
--

INSERT INTO `loans_table` (`loan_id`, `account_id`, `loan_ammount`, `loan_description`, `loan_created_by`, `loan_created_date`, `loan_created_time`) VALUES
(1, 1, 2000.00, 'lkjlkj', 10, '2020-11-16', '21:00:26'),
(2, 1, 62.00, 'Vero aperiam veniam', 10, '2021-02-25', '17:58:48');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

CREATE TABLE `order` (
  `order_id` int(10) UNSIGNED NOT NULL,
  `customer_id` int(11) NOT NULL,
  `order_total` double(8,2) NOT NULL,
  `order_vat` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order_discount` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `after_discount` double(8,2) DEFAULT NULL,
  `total_amount_payable` double(8,2) DEFAULT NULL,
  `table_number` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order_status` int(11) NOT NULL DEFAULT 1,
  `order_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order_created_date` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `order_created_time` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `order_created_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order`
--

INSERT INTO `order` (`order_id`, `customer_id`, `order_total`, `order_vat`, `order_discount`, `after_discount`, `total_amount_payable`, `table_number`, `order_status`, `order_type`, `order_created_date`, `order_created_time`, `order_created_by`) VALUES
(27, 1, 500.00, NULL, '200  ৳', 300.00, 300.00, '0', 0, NULL, '2020-11-16', '16:58:47', 10),
(28, 7, 12500.00, NULL, '500  ৳', 12000.00, 12000.00, '0', 0, NULL, '2020-11-16', '18:19:31', 10),
(29, 8, 1143.98, NULL, '0  ৳', 1143.98, 1143.98, '0', 0, NULL, '2020-11-16', '20:39:39', 10),
(30, 1, 800.00, NULL, '0  ৳', 800.00, 800.00, '0', 0, NULL, '2020-11-25', '16:57:42', 10),
(31, 1, 500.00, NULL, '0  ৳', 500.00, 500.00, '0', 1, NULL, '2020-12-09', '15:41:13', 10),
(32, 1, 1800.00, NULL, '10  ৳', 1790.00, 1790.00, '0', 1, NULL, '2020-12-09', '15:48:08', 11),
(33, 1, 1000.00, NULL, '0  ৳', 1000.00, 1000.00, '0', 1, NULL, '2020-12-09', '15:56:38', 10),
(34, 1, 500.00, NULL, '0  ৳', 500.00, 500.00, '0', 1, NULL, '2020-12-09', '15:59:27', 10),
(35, 8, 160000.00, NULL, '0  ৳', 160000.00, 160000.00, '0', 1, NULL, '2020-12-12', '17:01:55', 10),
(36, 10, 1000.00, NULL, '0  ৳', 1000.00, 1000.00, '0', 1, NULL, '2020-12-15', '12:50:26', 10),
(37, 7, 3000.00, NULL, '0  ৳', 3000.00, 3000.00, '0', 1, NULL, '2020-12-15', '15:51:16', 11),
(38, 1, 2500.00, NULL, '0  ৳', 2500.00, 2500.00, '0', 1, NULL, '2020-12-17', '11:07:51', 10),
(39, 1, 1700.00, NULL, '0  ৳', 1700.00, 1700.00, '0', 1, NULL, '2020-12-17', '13:26:12', 10),
(40, 1, 2000.00, NULL, '20  ৳', 1980.00, 1980.00, '0', 1, NULL, '2020-12-17', '13:29:33', 10),
(41, 8, 600.00, NULL, '20  ৳', 580.00, 580.00, '0', 1, NULL, '2020-12-17', '13:30:08', 10),
(42, 11, 600.00, NULL, '0  ৳', 600.00, 600.00, '0', 1, NULL, '2020-12-17', '15:39:31', 10),
(43, 8, 500.00, NULL, '0  ৳', 500.00, 500.00, '0', 1, NULL, '2020-12-19', '15:56:33', 11),
(44, 1, 1000.00, NULL, '0  ৳', 1000.00, 1000.00, '0', 1, NULL, '2020-12-20', '13:20:41', 10),
(45, 1, 1000.00, NULL, '0  ৳', 1000.00, 1000.00, '0', 1, NULL, '2020-12-20', '13:22:21', 10),
(46, 1, 1100.00, NULL, '0  ৳', 1100.00, 1100.00, '0', 1, NULL, '2020-12-20', '13:43:21', 10),
(47, 1, 1003.00, NULL, '0  ৳', 1003.00, 1003.00, '0', 1, NULL, '2020-12-20', '15:47:35', 10),
(48, 11, 1100.00, NULL, '0  ৳', 1100.00, 1100.00, '0', 1, NULL, '2020-12-21', '15:43:47', 10),
(49, 8, 15100.00, NULL, '100  ৳', 15000.00, 15000.00, '0', 1, NULL, '2020-12-21', '16:22:39', 10),
(50, 12, 276.00, NULL, '0  ৳', 276.00, 276.00, '0', 1, NULL, '2020-12-21', '16:24:25', 10),
(51, 1, 1000.00, NULL, '0  ৳', 1022.00, 1022.00, '0', 1, NULL, '2020-12-21', '17:07:30', 10),
(52, 1, 600.00, NULL, '0  ৳', 600.00, 600.00, '0', 1, NULL, '2020-12-22', '15:19:09', 10),
(53, 1, 600.00, NULL, '0  ৳', 600.00, 600.00, '0', 1, NULL, '2020-12-22', '15:20:02', 10),
(54, 1, 600.00, NULL, '0  ৳', 600.00, 600.00, '0', 1, NULL, '2020-12-22', '15:23:30', 10),
(55, 13, 700.00, NULL, '0  ৳', 700.00, 700.00, '0', 1, NULL, '2020-12-23', '16:50:13', 10),
(56, 1, 500.00, NULL, '20  ৳', 480.00, 480.00, '0', 1, NULL, '2020-12-23', '16:51:39', 10),
(57, 13, 800.00, NULL, '55  ৳', 745.00, 745.00, '0', 1, NULL, '2020-12-23', '16:53:07', 10),
(58, 1, 1100.00, NULL, '120  ৳', 980.00, 980.00, '0', 1, NULL, '2021-02-25', '17:57:33', 10),
(59, 1, 600.00, NULL, '12  ৳', 588.00, 588.00, '0', 1, NULL, '2021-02-25', '17:58:01', 10),
(60, 13, 1501.00, NULL, '450  ৳', 1051.00, 1051.00, '0', 1, NULL, '2021-04-12', '11:18:17', 10);

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `order_details_id` int(10) UNSIGNED NOT NULL,
  `order_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_sale_price` double(8,2) NOT NULL,
  `purchase_price` double(8,2) NOT NULL,
  `product_qty` double(8,2) NOT NULL,
  `pack_size` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order_details_status` int(11) NOT NULL DEFAULT 1,
  `order_details_created_date` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `order_details_created_time` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `order_details_created_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`order_details_id`, `order_id`, `customer_id`, `product_id`, `product_sale_price`, `purchase_price`, `product_qty`, `pack_size`, `order_details_status`, `order_details_created_date`, `order_details_created_time`, `order_details_created_by`) VALUES
(49, 27, 1, 38, 500.00, 0.00, 1.00, NULL, 0, '2020-11-16', '16:58:47', 10),
(50, 28, 7, 38, 300.00, 200.00, 40.00, NULL, 0, '2020-11-16', '18:19:31', 10),
(51, 28, 7, 40, 500.00, 0.00, 1.00, NULL, 0, '2020-11-16', '18:19:31', 10),
(52, 29, 8, 40, 500.00, 0.00, 2.00, NULL, 0, '2020-11-16', '20:39:39', 10),
(53, 29, 8, 38, 100.00, 5.00, 1.00, NULL, 0, '2020-11-16', '20:39:39', 10),
(54, 29, 8, 41, 43.98, 0.00, 1.00, NULL, 0, '2020-11-16', '20:39:39', 10),
(55, 30, 1, 40, 800.00, 10.00, 1.00, NULL, 0, '2020-11-25', '16:57:42', 10),
(56, 31, 1, 40, 500.00, 10.00, 1.00, NULL, 1, '2020-12-09', '15:41:13', 10),
(57, 32, 1, 40, 600.00, 10.00, 3.00, NULL, 1, '2020-12-09', '15:48:08', 11),
(58, 33, 1, 40, 500.00, 10.00, 2.00, NULL, 1, '2020-12-09', '15:56:38', 10),
(59, 34, 1, 40, 500.00, 10.00, 1.00, NULL, 1, '2020-12-09', '15:59:27', 10),
(60, 35, 8, 40, 800.00, 10.00, 200.00, NULL, 1, '2020-12-12', '17:01:55', 10),
(61, 36, 10, 40, 500.00, 10.00, 2.00, NULL, 1, '2020-12-15', '12:50:26', 10),
(62, 37, 7, 40, 500.00, 10.00, 6.00, NULL, 1, '2020-12-15', '15:51:16', 11),
(63, 38, 1, 40, 500.00, 10.00, 5.00, NULL, 1, '2020-12-17', '11:07:51', 10),
(64, 39, 1, 40, 500.00, 10.00, 3.00, NULL, 1, '2020-12-17', '13:26:12', 10),
(65, 39, 1, 38, 100.00, 10.00, 2.00, NULL, 1, '2020-12-17', '13:26:12', 10),
(66, 40, 1, 40, 500.00, 10.00, 3.00, NULL, 1, '2020-12-17', '13:29:33', 10),
(67, 40, 1, 38, 100.00, 10.00, 5.00, NULL, 1, '2020-12-17', '13:29:33', 10),
(68, 41, 8, 38, 100.00, 10.00, 1.00, NULL, 1, '2020-12-17', '13:30:08', 10),
(69, 41, 8, 40, 500.00, 10.00, 1.00, NULL, 1, '2020-12-17', '13:30:08', 10),
(70, 42, 11, 40, 500.00, 10.00, 1.00, NULL, 1, '2020-12-17', '15:39:31', 10),
(71, 42, 11, 38, 100.00, 10.00, 1.00, NULL, 1, '2020-12-17', '15:39:31', 10),
(72, 43, 8, 40, 500.00, 10.00, 1.00, NULL, 1, '2020-12-19', '15:56:33', 11),
(73, 45, 1, 38, 20.00, 10.00, 50.00, NULL, 1, '2020-12-20', '13:22:21', 10),
(74, 46, 1, 40, 22.00, 10.00, 50.00, NULL, 1, '2020-12-20', '13:43:21', 10),
(75, 47, 1, 38, 3.00, 10.00, 1.00, NULL, 1, '2020-12-20', '15:47:35', 10),
(76, 47, 1, 40, 500.00, 10.00, 2.00, NULL, 1, '2020-12-20', '15:47:35', 10),
(77, 48, 11, 40, 500.00, 10.00, 2.00, NULL, 1, '2020-12-21', '15:43:47', 10),
(78, 48, 11, 38, 100.00, 10.00, 1.00, NULL, 1, '2020-12-21', '15:43:47', 10),
(79, 49, 8, 43, 100.00, 0.00, 1.00, NULL, 1, '2020-12-21', '16:22:39', 10),
(80, 49, 8, 44, 300.00, 0.00, 50.00, NULL, 1, '2020-12-21', '16:22:39', 10),
(81, 50, 12, 43, 1.00, 0.00, 1.00, NULL, 1, '2020-12-21', '16:24:25', 10),
(82, 50, 12, 44, 275.00, 0.00, 1.00, NULL, 1, '2020-12-21', '16:24:25', 10),
(83, 51, 1, 43, 500.00, 0.00, 2.00, NULL, 1, '2020-12-21', '17:07:30', 10),
(84, 54, 1, 38, 100.00, 10.00, 1.00, NULL, 1, '2020-12-22', '15:23:30', 10),
(85, 54, 1, 40, 500.00, 10.00, 1.00, NULL, 1, '2020-12-22', '15:23:30', 10),
(86, 55, 13, 38, 100.00, 10.00, 2.00, NULL, 1, '2020-12-23', '16:50:13', 10),
(87, 55, 13, 40, 500.00, 10.00, 1.00, NULL, 1, '2020-12-23', '16:50:13', 10),
(88, 56, 1, 38, 100.00, 10.00, 5.00, NULL, 1, '2020-12-23', '16:51:39', 10),
(89, 57, 13, 38, 100.00, 10.00, 8.00, NULL, 1, '2020-12-23', '16:53:07', 10),
(90, 58, 1, 40, 500.00, 10.00, 2.00, NULL, 1, '2021-02-25', '17:57:33', 10),
(91, 58, 1, 38, 100.00, 10.00, 1.00, NULL, 1, '2021-02-25', '17:57:33', 10),
(92, 59, 1, 38, 100.00, 10.00, 1.00, NULL, 1, '2021-02-25', '17:58:01', 10),
(93, 59, 1, 40, 500.00, 10.00, 1.00, NULL, 1, '2021-02-25', '17:58:01', 10),
(94, 60, 13, 40, 500.00, 10.00, 3.00, NULL, 1, '2021-04-12', '11:18:17', 10),
(95, 60, 13, 43, 1.00, 0.00, 1.00, NULL, 1, '2021-04-12', '11:18:17', 10);

-- --------------------------------------------------------

--
-- Table structure for table `pament_details`
--

CREATE TABLE `pament_details` (
  `payment_details_id` int(10) NOT NULL,
  `order_id` int(11) NOT NULL,
  `account_id` int(11) DEFAULT NULL,
  `amount` double(8,2) NOT NULL,
  `transaction_no` varchar(250) DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `created_date` varchar(20) NOT NULL,
  `created_time` varchar(10) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `amount_return` int(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pament_details`
--

INSERT INTO `pament_details` (`payment_details_id`, `order_id`, `account_id`, `amount`, `transaction_no`, `created_by`, `created_date`, `created_time`, `status`, `amount_return`) VALUES
(33, 35, 1, 10000.00, '', 10, '2020-12-12', '17:01:55', 1, NULL),
(32, 34, 1, 100.00, '', 10, '2020-12-09', '15:59:27', 1, NULL),
(31, 33, 1, 200.00, '', 10, '2020-12-09', '15:56:38', 1, NULL),
(30, 32, 1, 1000.00, '', 11, '2020-12-09', '15:48:08', 1, NULL),
(29, 31, 1, 200.00, '', 10, '2020-12-09', '15:41:13', 1, NULL),
(28, 30, 1, 80.00, '', 10, '2020-11-25', '16:57:42', 0, NULL),
(27, 29, 1, 0.00, '', 10, '2020-11-16', '20:39:39', 0, NULL),
(26, 28, 1, 1000.00, '', 10, '2020-11-16', '18:19:31', 0, NULL),
(25, 27, 1, 300.00, '', 10, '2020-11-16', '16:58:47', 0, NULL),
(34, 36, 1, 500.00, '', 10, '2020-12-15', '12:50:26', 1, NULL),
(35, 37, 1, 2000.00, '', 11, '2020-12-15', '15:51:16', 1, NULL),
(36, 38, 1, 2000.00, '', 10, '2020-12-17', '11:07:51', 1, NULL),
(37, 39, 1, 500.00, '', 10, '2020-12-17', '13:26:12', 1, NULL),
(38, 40, 1, 1000.00, '', 10, '2020-12-17', '13:29:33', 1, NULL),
(39, 41, 1, 200.00, '', 10, '2020-12-17', '13:30:08', 1, NULL),
(40, 42, 1, 200.00, '', 10, '2020-12-17', '15:39:31', 1, NULL),
(41, 43, 1, 200.00, '', 11, '2020-12-19', '15:56:33', 1, NULL),
(42, 44, 1, 500.00, '', 10, '2020-12-20', '13:20:41', 1, NULL),
(43, 45, 1, 500.00, '', 10, '2020-12-20', '13:22:21', 1, NULL),
(44, 46, 1, 500.00, '', 10, '2020-12-20', '13:43:21', 1, NULL),
(45, 47, 1, 500.00, '', 10, '2020-12-20', '15:47:35', 1, NULL),
(46, 48, 1, 500.00, '', 10, '2020-12-21', '15:43:47', 1, NULL),
(47, 49, 1, 10000.00, '', 10, '2020-12-21', '16:22:39', 1, NULL),
(48, 50, 1, 200.00, '', 10, '2020-12-21', '16:24:25', 1, NULL),
(49, 51, 1, 275.00, '', 10, '2020-12-21', '17:07:30', 1, NULL),
(50, 54, 1, 300.00, '', 10, '2020-12-22', '15:23:30', 1, NULL),
(51, 55, 1, 200.00, '', 10, '2020-12-23', '16:50:13', 1, NULL),
(52, 56, 1, 200.00, '', 10, '2020-12-23', '16:51:39', 1, NULL),
(53, 57, 1, 500.00, '', 10, '2020-12-23', '16:53:07', 1, NULL),
(54, 58, 1, 232.00, '', 10, '2021-02-25', '17:57:33', 1, NULL),
(55, 59, 1, 123.00, '', 10, '2021-02-25', '17:58:01', 1, NULL),
(56, 60, 1, 500.00, '', 10, '2021-04-12', '11:18:17', 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `prescription`
--

CREATE TABLE `prescription` (
  `prescription_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `prescription_image` varchar(250) NOT NULL,
  `created_by` int(1) NOT NULL,
  `created_date` varchar(20) NOT NULL,
  `created_time` varchar(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `product_id` int(10) UNSIGNED NOT NULL,
  `fk_category_id` int(11) NOT NULL,
  `product_type` int(11) DEFAULT 0,
  `product_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pro_purchase_price` int(11) DEFAULT NULL,
  `product_sell_price` float NOT NULL,
  `product_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_status` tinyint(4) NOT NULL,
  `out_of_stock_range` int(11) DEFAULT 10,
  `pack_size` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_created_date` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_created_time` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_created_by` int(11) NOT NULL,
  `product_updated_date` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_updated_time` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`product_id`, `fk_category_id`, `product_type`, `product_name`, `pro_purchase_price`, `product_sell_price`, `product_image`, `product_status`, `out_of_stock_range`, `pack_size`, `product_created_date`, `product_created_time`, `product_created_by`, `product_updated_date`, `product_updated_time`, `product_updated_by`) VALUES
(38, 9, 17, ' Viscotin ', NULL, 100, NULL, 1, 10, '10 pec', '2020-11-16', '16:54:59', 10, NULL, NULL, NULL),
(39, 9, 17, ' Soricap ', NULL, 200, NULL, 1, 10, NULL, '2020-11-16', '16:55:49', 10, NULL, NULL, NULL),
(40, 9, 17, ' Soritec ', NULL, 500, NULL, 1, 10, NULL, '2020-11-16', '16:56:20', 10, NULL, NULL, NULL),
(41, 9, 17, 'DFEFTG', NULL, 43.98, NULL, 1, 10, NULL, '2020-11-16', '17:19:49', 10, NULL, NULL, NULL),
(42, 8, 16, 'Napa', NULL, 5, NULL, 1, 10, '10 pec', '2020-12-21', '10:46:09', 10, NULL, NULL, NULL),
(43, 7, 17, 'Gluco Active Machine', NULL, 1, NULL, 1, 10, '01', '2020-12-21', '16:18:55', 10, NULL, NULL, NULL),
(44, 7, 17, 'Gluco Active Strips 25', NULL, 275, NULL, 1, 10, '25', '2020-12-21', '16:20:47', 10, NULL, NULL, NULL),
(45, 9, 17, 'Gluco Active strips 50', NULL, 550, NULL, 1, 10, NULL, '2020-12-21', '17:10:46', 10, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `product_type`
--

CREATE TABLE `product_type` (
  `type_id` int(11) NOT NULL,
  `type_name` varchar(250) NOT NULL,
  `type_created_by` int(11) NOT NULL,
  `type_created_date` varchar(20) NOT NULL,
  `type_created_time` varchar(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_type`
--

INSERT INTO `product_type` (`type_id`, `type_name`, `type_created_by`, `type_created_date`, `type_created_time`) VALUES
(17, 'Effervescent Granules', 10, '2020-11-16', '16:54:04'),
(16, 'Capsule', 10, '2020-11-16', '16:53:48'),
(18, 'Blood Glucos Meter', 10, '2020-12-21', '16:17:47');

-- --------------------------------------------------------

--
-- Table structure for table `purchase`
--

CREATE TABLE `purchase` (
  `purchase_id` int(11) NOT NULL,
  `buyer_id` int(11) NOT NULL,
  `purchase_note` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_name` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `purchase_total` double(8,2) NOT NULL,
  `purchase_discount` double(8,2) NOT NULL,
  `after_discount` double(8,2) NOT NULL,
  `purchase_vat` double(8,2) DEFAULT NULL,
  `total_ammount_payable` double(8,2) NOT NULL,
  `transport` double(10,2) DEFAULT 0.00,
  `purchase_status` int(11) NOT NULL DEFAULT 1,
  `expire_date` date DEFAULT NULL,
  `purchase_created_by` int(11) NOT NULL,
  `purchase_created_date` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `purchase_created_time` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `purchase`
--

INSERT INTO `purchase` (`purchase_id`, `buyer_id`, `purchase_note`, `product_name`, `purchase_total`, `purchase_discount`, `after_discount`, `purchase_vat`, `total_ammount_payable`, `transport`, `purchase_status`, `expire_date`, `purchase_created_by`, `purchase_created_date`, `purchase_created_time`) VALUES
(15, 4, 'dfesf', ' Soritec ', 100.00, 0.00, 100.00, NULL, 100.00, NULL, 1, '2020-11-26', 10, '2020-11-24', '12:11:30'),
(13, 3, 'wewr', ' Soritec ', 125.00, 20.00, 105.00, NULL, 105.00, NULL, 1, '2020-11-25', 10, '2020-11-24', '12:02:32'),
(14, 6, 'wwerwer', ' Viscotin ', 50.00, 0.00, 50.00, NULL, 50.00, NULL, 1, '2020-11-27', 10, '2020-11-24', '12:05:15');

-- --------------------------------------------------------

--
-- Table structure for table `purchase_details`
--

CREATE TABLE `purchase_details` (
  `pur_details_id` int(11) NOT NULL,
  `purchase_id` int(11) NOT NULL,
  `buyer_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_purchase_price` double(8,2) NOT NULL,
  `product_qty` double(8,2) NOT NULL,
  `pur_details_status` int(11) NOT NULL DEFAULT 1,
  `pur_details_created_by` int(11) NOT NULL,
  `pur_details_created_date` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pur_details_created_time` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `purchase_details`
--

INSERT INTO `purchase_details` (`pur_details_id`, `purchase_id`, `buyer_id`, `product_id`, `product_purchase_price`, `product_qty`, `pur_details_status`, `pur_details_created_by`, `pur_details_created_date`, `pur_details_created_time`) VALUES
(17, 15, 4, 40, 10.00, 10.00, 1, 10, '2020-11-24', '12:11:30'),
(16, 14, 6, 38, 10.00, 5.00, 1, 10, '2020-11-24', '12:05:15'),
(15, 13, 3, 40, 25.00, 5.00, 1, 10, '2020-11-24', '12:02:32');

-- --------------------------------------------------------

--
-- Table structure for table `purchase_payment_details`
--

CREATE TABLE `purchase_payment_details` (
  `pur_payment_details_id` int(11) NOT NULL,
  `purchase_id` int(11) NOT NULL,
  `account_id` int(11) NOT NULL,
  `pur_ammount` double(8,2) NOT NULL,
  `pur_payment_note` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_check_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_transaction_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pur_payment_status` int(11) NOT NULL DEFAULT 1,
  `pur_payment_created_by` int(11) NOT NULL,
  `pur_payment_created_date` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pur_payment_created_time` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `purchase_payment_details`
--

INSERT INTO `purchase_payment_details` (`pur_payment_details_id`, `purchase_id`, `account_id`, `pur_ammount`, `pur_payment_note`, `payment_check_no`, `payment_transaction_no`, `pur_payment_status`, `pur_payment_created_by`, `pur_payment_created_date`, `pur_payment_created_time`) VALUES
(14, 15, 1, 80.00, 'dfdg', 'dd', 'rfer', 1, 10, '2020-11-24', '12:11:30'),
(13, 14, 1, 10.00, 'fer', 'efre', '', 1, 10, '2020-11-24', '12:05:15'),
(12, 13, 1, 20.00, '', '', '', 1, 10, '2020-11-24', '12:02:32');

-- --------------------------------------------------------

--
-- Table structure for table `refund_table`
--

CREATE TABLE `refund_table` (
  `refund_id` int(11) NOT NULL,
  `account_id` int(11) NOT NULL,
  `loan_id` int(11) NOT NULL,
  `refund_ammount` double(10,2) NOT NULL,
  `refund_note` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `refund_created_by` int(10) NOT NULL,
  `refund_created_date` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `refund_created_time` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `refund_table`
--

INSERT INTO `refund_table` (`refund_id`, `account_id`, `loan_id`, `refund_ammount`, `refund_note`, `refund_created_by`, `refund_created_date`, `refund_created_time`) VALUES
(1, 1, 1, 1000.00, 'jhgjiu', 10, '2020-11-16', '21:00:55');

-- --------------------------------------------------------

--
-- Table structure for table `sales_report`
--

CREATE TABLE `sales_report` (
  `sales_report_id` int(11) NOT NULL,
  `sales_report_date` varchar(20) NOT NULL,
  `total_sold` bigint(20) NOT NULL,
  `total_wastage` bigint(20) NOT NULL,
  `created_by` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sales_report`
--

INSERT INTO `sales_report` (`sales_report_id`, `sales_report_date`, `total_sold`, `total_wastage`, `created_by`) VALUES
(17, '2020-12-12', 200, 0, 10),
(16, '2020-12-10', 0, 0, NULL),
(15, '2020-12-09', 7, 0, 10),
(18, '2020-12-13', 0, 0, NULL),
(19, '2020-12-14', 0, 0, NULL),
(20, '2020-12-15', 8, 0, 11),
(21, '2020-12-17', 22, 0, 10),
(22, '2020-12-19', 1, 0, 11),
(23, '2020-12-20', 103, 0, 10),
(24, '2020-12-21', 58, 0, 10),
(25, '2020-12-22', 2, 0, 10),
(26, '2020-12-23', 16, 0, 10),
(27, '2020-12-26', 0, 0, NULL),
(28, '2021-02-25', 5, 0, 10),
(29, '2021-04-12', 4, 0, 10),
(30, '2021-06-12', 0, 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `settings_id` int(11) NOT NULL,
  `company_name` varchar(50) NOT NULL,
  `company_logo` varchar(255) NOT NULL,
  `company_mobile` varchar(50) NOT NULL,
  `company_email` varchar(50) NOT NULL,
  `company_address` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`settings_id`, `company_name`, `company_logo`, `company_mobile`, `company_email`, `company_address`) VALUES
(1, 'Company Name', 'public/settings_image/16024212.jpg', '01982211000', 'Company@email.com', 'Company Address ');

-- --------------------------------------------------------

--
-- Table structure for table `stock`
--

CREATE TABLE `stock` (
  `stock_id` int(10) UNSIGNED NOT NULL,
  `product_id` int(11) NOT NULL,
  `purchase_id` int(11) DEFAULT NULL,
  `stock_quantity` int(11) DEFAULT NULL,
  `purchase_price` double(8,2) NOT NULL,
  `stock_created_date` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stock_created_time` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stock_created_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `stock`
--

INSERT INTO `stock` (`stock_id`, `product_id`, `purchase_id`, `stock_quantity`, `purchase_price`, `stock_created_date`, `stock_created_time`, `stock_created_by`) VALUES
(23, 41, NULL, 1, 0.00, '2020-11-16', '21:19:17', 10),
(24, 40, NULL, 3, 0.00, '2020-11-16', '21:19:25', 10),
(25, 40, 13, 5, 25.00, '2020-11-24', '12:02:32', 10),
(26, 38, 14, 5, 10.00, '2020-11-24', '12:05:15', 10),
(27, 40, 15, 10, 10.00, '2020-11-24', '12:11:30', 10),
(28, 42, NULL, 500, 5.00, '2020-12-21', '10:47:20', 10),
(29, 43, NULL, 500, 490.00, '2020-12-21', '16:19:16', 10),
(30, 44, NULL, 500, 0.00, '2020-12-21', '16:21:10', 10);

-- --------------------------------------------------------

--
-- Table structure for table `supplier_extra_payment`
--

CREATE TABLE `supplier_extra_payment` (
  `extra_p_id` int(11) NOT NULL,
  `buyer_id` int(11) DEFAULT NULL,
  `purchase_id` int(11) DEFAULT NULL,
  `account_id` int(11) DEFAULT NULL,
  `amount` double(10,2) DEFAULT NULL,
  `note` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `check_no` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `transaction` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_by` int(11) DEFAULT NULL,
  `created_date` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_time` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tables`
--

CREATE TABLE `tables` (
  `table_id` int(10) UNSIGNED NOT NULL,
  `table_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `transfer_table`
--

CREATE TABLE `transfer_table` (
  `transfer_id` int(11) NOT NULL,
  `transfer_from` int(11) NOT NULL,
  `ammount` int(11) NOT NULL,
  `transfer_to` int(11) NOT NULL,
  `note` varchar(250) NOT NULL,
  `transfer_created_by` int(11) NOT NULL,
  `transfer_created_date` varchar(20) NOT NULL,
  `transfer_created_time` varchar(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transfer_table`
--

INSERT INTO `transfer_table` (`transfer_id`, `transfer_from`, `ammount`, `transfer_to`, `note`, `transfer_created_by`, `transfer_created_date`, `transfer_created_time`) VALUES
(1, 1, 200, 2, '', 10, '2020-11-16', '21:02:08'),
(2, 4, 16, 2, 'Repellendus Aut omn', 10, '2021-02-25', '17:59:20');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `vat`
--

CREATE TABLE `vat` (
  `vat_id` int(11) NOT NULL,
  `vat_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `vat_amount` double(8,2) DEFAULT NULL,
  `vat_status` int(11) NOT NULL DEFAULT 1,
  `vat_created_by` int(11) NOT NULL,
  `vat_created_date` varchar(20) NOT NULL,
  `vat_created_time` varchar(10) NOT NULL,
  `vat_updated_by` int(11) DEFAULT NULL,
  `vat_updated_date` varchar(20) DEFAULT NULL,
  `vat_updated_time` varchar(10) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `wastage`
--

CREATE TABLE `wastage` (
  `wastage_id` int(10) NOT NULL,
  `product_id` int(11) NOT NULL,
  `purchase_price` double(8,2) NOT NULL,
  `wastage_quantity` mediumint(11) DEFAULT NULL,
  `wastage_created_date` varchar(20) NOT NULL,
  `wastage_created_time` varchar(10) NOT NULL,
  `wastage_created_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `withdraw_table`
--

CREATE TABLE `withdraw_table` (
  `withdraw_id` int(11) NOT NULL,
  `account_id` int(11) NOT NULL,
  `ammount` double NOT NULL,
  `note` varchar(250) NOT NULL,
  `withdraw_created_by` int(11) NOT NULL,
  `withdraw_created_date` varchar(20) NOT NULL,
  `withdraw_created_time` varchar(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`account_id`);

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin_role`
--
ALTER TABLE `admin_role`
  ADD PRIMARY KEY (`role_id`);

--
-- Indexes for table `balance_table`
--
ALTER TABLE `balance_table`
  ADD PRIMARY KEY (`balance_id`);

--
-- Indexes for table `buyers`
--
ALTER TABLE `buyers`
  ADD PRIMARY KEY (`buyer_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`customer_id`);

--
-- Indexes for table `customer_extra_payment`
--
ALTER TABLE `customer_extra_payment`
  ADD PRIMARY KEY (`c_p_id`);

--
-- Indexes for table `customer_group`
--
ALTER TABLE `customer_group`
  ADD PRIMARY KEY (`group_id`);

--
-- Indexes for table `expenses`
--
ALTER TABLE `expenses`
  ADD PRIMARY KEY (`expenses_id`);

--
-- Indexes for table `expenses_head`
--
ALTER TABLE `expenses_head`
  ADD PRIMARY KEY (`expenses_head_id`);

--
-- Indexes for table `expenses_sub_head`
--
ALTER TABLE `expenses_sub_head`
  ADD PRIMARY KEY (`expenses_sub_head_id`);

--
-- Indexes for table `investment_table`
--
ALTER TABLE `investment_table`
  ADD PRIMARY KEY (`investment_id`);

--
-- Indexes for table `loans_table`
--
ALTER TABLE `loans_table`
  ADD PRIMARY KEY (`loan_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`order_details_id`);

--
-- Indexes for table `pament_details`
--
ALTER TABLE `pament_details`
  ADD PRIMARY KEY (`payment_details_id`);

--
-- Indexes for table `prescription`
--
ALTER TABLE `prescription`
  ADD PRIMARY KEY (`prescription_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `product_type`
--
ALTER TABLE `product_type`
  ADD PRIMARY KEY (`type_id`);

--
-- Indexes for table `purchase`
--
ALTER TABLE `purchase`
  ADD PRIMARY KEY (`purchase_id`);

--
-- Indexes for table `purchase_details`
--
ALTER TABLE `purchase_details`
  ADD PRIMARY KEY (`pur_details_id`);

--
-- Indexes for table `purchase_payment_details`
--
ALTER TABLE `purchase_payment_details`
  ADD PRIMARY KEY (`pur_payment_details_id`);

--
-- Indexes for table `refund_table`
--
ALTER TABLE `refund_table`
  ADD PRIMARY KEY (`refund_id`);

--
-- Indexes for table `sales_report`
--
ALTER TABLE `sales_report`
  ADD PRIMARY KEY (`sales_report_id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`settings_id`);

--
-- Indexes for table `stock`
--
ALTER TABLE `stock`
  ADD PRIMARY KEY (`stock_id`);

--
-- Indexes for table `supplier_extra_payment`
--
ALTER TABLE `supplier_extra_payment`
  ADD PRIMARY KEY (`extra_p_id`);

--
-- Indexes for table `tables`
--
ALTER TABLE `tables`
  ADD PRIMARY KEY (`table_id`);

--
-- Indexes for table `transfer_table`
--
ALTER TABLE `transfer_table`
  ADD PRIMARY KEY (`transfer_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vat`
--
ALTER TABLE `vat`
  ADD PRIMARY KEY (`vat_id`);

--
-- Indexes for table `wastage`
--
ALTER TABLE `wastage`
  ADD PRIMARY KEY (`wastage_id`);

--
-- Indexes for table `withdraw_table`
--
ALTER TABLE `withdraw_table`
  ADD PRIMARY KEY (`withdraw_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounts`
--
ALTER TABLE `accounts`
  MODIFY `account_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `admin_role`
--
ALTER TABLE `admin_role`
  MODIFY `role_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `balance_table`
--
ALTER TABLE `balance_table`
  MODIFY `balance_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- AUTO_INCREMENT for table `buyers`
--
ALTER TABLE `buyers`
  MODIFY `buyer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `customer_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `customer_extra_payment`
--
ALTER TABLE `customer_extra_payment`
  MODIFY `c_p_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `customer_group`
--
ALTER TABLE `customer_group`
  MODIFY `group_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `expenses`
--
ALTER TABLE `expenses`
  MODIFY `expenses_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `expenses_head`
--
ALTER TABLE `expenses_head`
  MODIFY `expenses_head_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `expenses_sub_head`
--
ALTER TABLE `expenses_sub_head`
  MODIFY `expenses_sub_head_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `investment_table`
--
ALTER TABLE `investment_table`
  MODIFY `investment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `loans_table`
--
ALTER TABLE `loans_table`
  MODIFY `loan_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `order`
--
ALTER TABLE `order`
  MODIFY `order_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `order_details_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=96;

--
-- AUTO_INCREMENT for table `pament_details`
--
ALTER TABLE `pament_details`
  MODIFY `payment_details_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `prescription`
--
ALTER TABLE `prescription`
  MODIFY `prescription_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `product_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `product_type`
--
ALTER TABLE `product_type`
  MODIFY `type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `purchase`
--
ALTER TABLE `purchase`
  MODIFY `purchase_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `purchase_details`
--
ALTER TABLE `purchase_details`
  MODIFY `pur_details_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `purchase_payment_details`
--
ALTER TABLE `purchase_payment_details`
  MODIFY `pur_payment_details_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `refund_table`
--
ALTER TABLE `refund_table`
  MODIFY `refund_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sales_report`
--
ALTER TABLE `sales_report`
  MODIFY `sales_report_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `settings_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `stock`
--
ALTER TABLE `stock`
  MODIFY `stock_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `supplier_extra_payment`
--
ALTER TABLE `supplier_extra_payment`
  MODIFY `extra_p_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tables`
--
ALTER TABLE `tables`
  MODIFY `table_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `transfer_table`
--
ALTER TABLE `transfer_table`
  MODIFY `transfer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `vat`
--
ALTER TABLE `vat`
  MODIFY `vat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `wastage`
--
ALTER TABLE `wastage`
  MODIFY `wastage_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `withdraw_table`
--
ALTER TABLE `withdraw_table`
  MODIFY `withdraw_id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
