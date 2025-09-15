-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 08, 2025 at 03:47 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ddpdoo`
--

-- --------------------------------------------------------

--
-- Table structure for table `activity_log`
--

CREATE TABLE `activity_log` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `log_name` varchar(255) DEFAULT NULL,
  `description` text NOT NULL,
  `subject_type` varchar(255) DEFAULT NULL,
  `event` varchar(255) DEFAULT NULL,
  `subject_id` bigint(20) UNSIGNED DEFAULT NULL,
  `causer_type` varchar(255) DEFAULT NULL,
  `causer_id` bigint(20) UNSIGNED DEFAULT NULL,
  `properties` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`properties`)),
  `batch_uuid` char(36) DEFAULT NULL,
  `ip_address` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `activity_log`
--

INSERT INTO `activity_log` (`id`, `log_name`, `description`, `subject_type`, `event`, `subject_id`, `causer_type`, `causer_id`, `properties`, `batch_uuid`, `ip_address`, `created_at`, `updated_at`) VALUES
(1, 'default', 'Menu Created, ID: 1', NULL, NULL, NULL, 'App\\Models\\User', 1, '{\"ip_address\":\"127.0.0.1\"}', NULL, NULL, '2025-08-23 17:17:49', '2025-08-23 17:17:49'),
(2, 'default', 'Menu Created, ID: 2', NULL, NULL, NULL, 'App\\Models\\User', 1, '{\"ip_address\":\"127.0.0.1\"}', NULL, NULL, '2025-08-23 17:25:41', '2025-08-23 17:25:41'),
(3, 'default', 'Menu Created, ID: 3', NULL, NULL, NULL, 'App\\Models\\User', 1, '{\"ip_address\":\"127.0.0.1\"}', NULL, NULL, '2025-08-23 17:34:47', '2025-08-23 17:34:47'),
(4, 'default', 'Media Created, ID: 3', NULL, NULL, NULL, 'App\\Models\\User', 1, '{\"ip_address\":\"127.0.0.1\"}', NULL, NULL, '2025-08-23 18:33:54', '2025-08-23 18:33:54'),
(5, 'default', 'Media Updated, ID: 3', NULL, NULL, NULL, 'App\\Models\\User', 1, '{\"ip_address\":\"127.0.0.1\"}', NULL, NULL, '2025-08-23 18:37:15', '2025-08-23 18:37:15'),
(6, 'default', 'Media Updated, ID: 3', NULL, NULL, NULL, 'App\\Models\\User', 1, '{\"ip_address\":\"127.0.0.1\"}', NULL, NULL, '2025-08-23 18:43:00', '2025-08-23 18:43:00'),
(7, 'default', 'Media Updated, ID: 3', NULL, NULL, NULL, 'App\\Models\\User', 1, '{\"ip_address\":\"127.0.0.1\"}', NULL, NULL, '2025-08-23 18:44:00', '2025-08-23 18:44:00'),
(8, 'default', 'Menu Created, ID: 4', NULL, NULL, NULL, 'App\\Models\\User', 1, '{\"ip_address\":\"127.0.0.1\"}', NULL, NULL, '2025-08-23 19:22:18', '2025-08-23 19:22:18'),
(9, 'default', 'Media Created, ID: 4', NULL, NULL, NULL, 'App\\Models\\User', 1, '{\"ip_address\":\"127.0.0.1\"}', NULL, NULL, '2025-08-23 19:24:19', '2025-08-23 19:24:19'),
(10, 'default', 'Menu Created, ID: 5', NULL, NULL, NULL, 'App\\Models\\User', 1, '{\"ip_address\":\"127.0.0.1\"}', NULL, NULL, '2025-08-23 19:54:06', '2025-08-23 19:54:06'),
(11, 'default', 'Menu Created, ID: 6', NULL, NULL, NULL, 'App\\Models\\User', 1, '{\"ip_address\":\"127.0.0.1\"}', NULL, NULL, '2025-08-23 19:56:51', '2025-08-23 19:56:51'),
(12, 'default', 'Menu Created, ID: 7', NULL, NULL, NULL, 'App\\Models\\User', 1, '{\"ip_address\":\"127.0.0.1\"}', NULL, NULL, '2025-08-23 19:58:32', '2025-08-23 19:58:32'),
(13, 'default', 'Category Created, ID: 1', NULL, NULL, NULL, 'App\\Models\\User', 1, '{\"ip_address\":\"127.0.0.1\"}', NULL, NULL, '2025-08-23 20:05:32', '2025-08-23 20:05:32'),
(14, 'default', 'Document Created, ID: 1', NULL, NULL, NULL, 'App\\Models\\User', 1, '{\"ip_address\":\"127.0.0.1\"}', NULL, NULL, '2025-08-23 20:06:38', '2025-08-23 20:06:38'),
(15, 'default', 'Menu Created, ID: 8', NULL, NULL, NULL, 'App\\Models\\User', 1, '{\"ip_address\":\"127.0.0.1\"}', NULL, NULL, '2025-08-24 15:01:01', '2025-08-24 15:01:01'),
(16, 'default', 'Menu Created, ID: 1', NULL, NULL, NULL, 'App\\Models\\User', 1, '{\"ip_address\":\"152.58.177.222\"}', NULL, NULL, '2025-08-25 04:45:19', '2025-08-25 04:45:19'),
(17, 'default', 'Menu Created, ID: 2', NULL, NULL, NULL, 'App\\Models\\User', 1, '{\"ip_address\":\"152.58.176.83\"}', NULL, NULL, '2025-08-25 04:47:20', '2025-08-25 04:47:20'),
(18, 'default', 'Menu Created, ID: 3', NULL, NULL, NULL, 'App\\Models\\User', 1, '{\"ip_address\":\"152.58.177.245\"}', NULL, NULL, '2025-08-25 04:53:55', '2025-08-25 04:53:55'),
(19, 'default', 'Menu Updated, ID: 3', NULL, NULL, NULL, 'App\\Models\\User', 1, '{\"ip_address\":\"152.58.176.6\"}', NULL, NULL, '2025-08-25 04:55:49', '2025-08-25 04:55:49'),
(20, 'default', 'Menu Created, ID: 4', NULL, NULL, NULL, 'App\\Models\\User', 1, '{\"ip_address\":\"152.58.176.81\"}', NULL, NULL, '2025-08-25 04:57:20', '2025-08-25 04:57:20'),
(21, 'default', 'Menu Created, ID: 5', NULL, NULL, NULL, 'App\\Models\\User', 1, '{\"ip_address\":\"152.58.177.175\"}', NULL, NULL, '2025-08-25 04:58:06', '2025-08-25 04:58:06'),
(22, 'default', 'Menu Created, ID: 6', NULL, NULL, NULL, 'App\\Models\\User', 1, '{\"ip_address\":\"152.58.177.175\"}', NULL, NULL, '2025-08-25 04:58:49', '2025-08-25 04:58:49'),
(23, 'default', 'Menu Created, ID: 7', NULL, NULL, NULL, 'App\\Models\\User', 1, '{\"ip_address\":\"152.58.177.189\"}', NULL, NULL, '2025-08-25 05:00:18', '2025-08-25 05:00:18'),
(24, 'default', 'Menu Created, ID: 8', NULL, NULL, NULL, 'App\\Models\\User', 1, '{\"ip_address\":\"152.58.177.189\"}', NULL, NULL, '2025-08-25 05:01:47', '2025-08-25 05:01:47'),
(25, 'default', 'Menu Created, ID: 9', NULL, NULL, NULL, 'App\\Models\\User', 1, '{\"ip_address\":\"152.58.177.152\"}', NULL, NULL, '2025-08-25 05:03:36', '2025-08-25 05:03:36'),
(26, 'default', 'Menu Created, ID: 10', NULL, NULL, NULL, 'App\\Models\\User', 1, '{\"ip_address\":\"152.58.176.142\"}', NULL, NULL, '2025-08-25 05:04:28', '2025-08-25 05:04:28'),
(27, 'default', 'Menu Created, ID: 11', NULL, NULL, NULL, 'App\\Models\\User', 1, '{\"ip_address\":\"152.58.177.252\"}', NULL, NULL, '2025-08-25 05:05:13', '2025-08-25 05:05:13'),
(28, 'default', 'Menu Created, ID: 12', NULL, NULL, NULL, 'App\\Models\\User', 1, '{\"ip_address\":\"152.58.176.60\"}', NULL, NULL, '2025-08-25 05:06:02', '2025-08-25 05:06:02'),
(29, 'default', 'Menu Created, ID: 13', NULL, NULL, NULL, 'App\\Models\\User', 1, '{\"ip_address\":\"152.58.176.215\"}', NULL, NULL, '2025-08-25 05:06:47', '2025-08-25 05:06:47'),
(30, 'default', 'Menu Created, ID: 14', NULL, NULL, NULL, 'App\\Models\\User', 1, '{\"ip_address\":\"152.58.176.3\"}', NULL, NULL, '2025-08-25 05:07:44', '2025-08-25 05:07:44'),
(31, 'default', 'Menu Created, ID: 15', NULL, NULL, NULL, 'App\\Models\\User', 1, '{\"ip_address\":\"152.58.177.77\"}', NULL, NULL, '2025-08-25 05:09:08', '2025-08-25 05:09:08'),
(32, 'default', 'Menu Created, ID: 16', NULL, NULL, NULL, 'App\\Models\\User', 1, '{\"ip_address\":\"152.58.177.112\"}', NULL, NULL, '2025-08-25 05:13:08', '2025-08-25 05:13:08'),
(33, 'default', 'Menu Created, ID: 17', NULL, NULL, NULL, 'App\\Models\\User', 1, '{\"ip_address\":\"152.58.177.112\"}', NULL, NULL, '2025-08-25 05:14:24', '2025-08-25 05:14:24'),
(34, 'default', 'Menu Updated, ID: 17', NULL, NULL, NULL, 'App\\Models\\User', 1, '{\"ip_address\":\"152.58.176.89\"}', NULL, NULL, '2025-08-25 05:20:49', '2025-08-25 05:20:49'),
(35, 'default', 'Menu Created, ID: 18', NULL, NULL, NULL, 'App\\Models\\User', 1, '{\"ip_address\":\"152.58.177.128\"}', NULL, NULL, '2025-08-25 05:21:37', '2025-08-25 05:21:37'),
(36, 'default', 'Menu Created, ID: 19', NULL, NULL, NULL, 'App\\Models\\User', 1, '{\"ip_address\":\"152.58.176.217\"}', NULL, NULL, '2025-08-25 05:23:30', '2025-08-25 05:23:30'),
(37, 'default', 'Menu Created, ID: 20', NULL, NULL, NULL, 'App\\Models\\User', 1, '{\"ip_address\":\"152.58.177.227\"}', NULL, NULL, '2025-08-25 05:24:20', '2025-08-25 05:24:20'),
(38, 'default', 'Menu Created, ID: 21', NULL, NULL, NULL, 'App\\Models\\User', 1, '{\"ip_address\":\"152.58.176.230\"}', NULL, NULL, '2025-08-25 05:25:46', '2025-08-25 05:25:46'),
(39, 'default', 'Menu Created, ID: 22', NULL, NULL, NULL, 'App\\Models\\User', 1, '{\"ip_address\":\"152.58.176.60\"}', NULL, NULL, '2025-08-25 05:27:04', '2025-08-25 05:27:04'),
(40, 'default', 'Menu Created, ID: 23', NULL, NULL, NULL, 'App\\Models\\User', 1, '{\"ip_address\":\"152.58.176.141\"}', NULL, NULL, '2025-08-25 05:28:14', '2025-08-25 05:28:14'),
(41, 'default', 'Menu Created, ID: 24', NULL, NULL, NULL, 'App\\Models\\User', 1, '{\"ip_address\":\"152.58.176.218\"}', NULL, NULL, '2025-08-25 05:29:13', '2025-08-25 05:29:13'),
(42, 'default', 'Menu Created, ID: 25', NULL, NULL, NULL, 'App\\Models\\User', 1, '{\"ip_address\":\"152.58.177.217\"}', NULL, NULL, '2025-08-25 05:30:27', '2025-08-25 05:30:27'),
(43, 'default', 'Menu Created, ID: 26', NULL, NULL, NULL, 'App\\Models\\User', 1, '{\"ip_address\":\"152.58.177.217\"}', NULL, NULL, '2025-08-25 05:31:25', '2025-08-25 05:31:25'),
(44, 'default', 'Menu Created, ID: 27', NULL, NULL, NULL, 'App\\Models\\User', 1, '{\"ip_address\":\"152.58.176.118\"}', NULL, NULL, '2025-08-25 05:32:10', '2025-08-25 05:32:10'),
(45, 'default', 'Banner Created, ID: 1', NULL, NULL, NULL, 'App\\Models\\User', 1, '{\"ip_address\":\"152.58.177.223\"}', NULL, NULL, '2025-08-25 05:36:27', '2025-08-25 05:36:27'),
(46, 'default', 'Banner Created, ID: 2', NULL, NULL, NULL, 'App\\Models\\User', 1, '{\"ip_address\":\"152.58.176.83\"}', NULL, NULL, '2025-08-25 05:38:57', '2025-08-25 05:38:57'),
(47, 'default', 'Content Created, ID: 1', NULL, NULL, NULL, 'App\\Models\\User', 1, '{\"ip_address\":\"152.58.176.86\"}', NULL, NULL, '2025-08-25 05:44:43', '2025-08-25 05:44:43'),
(48, 'default', 'Content Created, ID: 2', NULL, NULL, NULL, 'App\\Models\\User', 1, '{\"ip_address\":\"152.58.176.91\"}', NULL, NULL, '2025-08-25 05:49:39', '2025-08-25 05:49:39'),
(49, 'default', 'Content Created, ID: 3', NULL, NULL, NULL, 'App\\Models\\User', 1, '{\"ip_address\":\"152.58.177.150\"}', NULL, NULL, '2025-08-25 05:51:09', '2025-08-25 05:51:09'),
(50, 'default', 'Document Created, ID: 1', NULL, NULL, NULL, 'App\\Models\\User', 1, '{\"ip_address\":\"152.58.177.164\"}', NULL, NULL, '2025-08-25 06:27:21', '2025-08-25 06:27:21'),
(51, 'default', 'Document Created, ID: 2', NULL, NULL, NULL, 'App\\Models\\User', 1, '{\"ip_address\":\"152.58.176.19\"}', NULL, NULL, '2025-08-25 06:31:02', '2025-08-25 06:31:02'),
(52, 'default', 'Document Created, ID: 3', NULL, NULL, NULL, 'App\\Models\\User', 1, '{\"ip_address\":\"152.58.176.2\"}', NULL, NULL, '2025-08-25 06:39:03', '2025-08-25 06:39:03'),
(53, 'default', 'Document Created, ID: 4', NULL, NULL, NULL, 'App\\Models\\User', 1, '{\"ip_address\":\"152.58.176.2\"}', NULL, NULL, '2025-08-25 06:40:05', '2025-08-25 06:40:05'),
(54, 'default', 'Document Created, ID: 5', NULL, NULL, NULL, 'App\\Models\\User', 1, '{\"ip_address\":\"152.58.177.227\"}', NULL, NULL, '2025-08-25 06:43:35', '2025-08-25 06:43:35'),
(55, 'default', 'Document Created, ID: 6', NULL, NULL, NULL, 'App\\Models\\User', 1, '{\"ip_address\":\"152.58.177.207\"}', NULL, NULL, '2025-08-25 06:44:56', '2025-08-25 06:44:56'),
(56, 'default', 'Designation Created, ID: 1', NULL, NULL, NULL, 'App\\Models\\User', 1, '{\"ip_address\":\"152.58.177.179\"}', NULL, NULL, '2025-08-25 06:48:24', '2025-08-25 06:48:24'),
(57, 'default', 'Designation Created, ID: 2', NULL, NULL, NULL, 'App\\Models\\User', 1, '{\"ip_address\":\"152.58.176.8\"}', NULL, NULL, '2025-08-25 06:49:07', '2025-08-25 06:49:07'),
(58, 'default', 'Team Created, ID: 1', NULL, NULL, NULL, 'App\\Models\\User', 1, '{\"ip_address\":\"152.58.177.132\"}', NULL, NULL, '2025-08-25 06:52:32', '2025-08-25 06:52:32'),
(59, 'default', 'Team Created, ID: 2', NULL, NULL, NULL, 'App\\Models\\User', 1, '{\"ip_address\":\"152.58.176.6\"}', NULL, NULL, '2025-08-25 06:53:44', '2025-08-25 06:53:44'),
(60, 'default', 'Team Updated, ID: 2', NULL, NULL, NULL, 'App\\Models\\User', 1, '{\"ip_address\":\"152.58.177.248\"}', NULL, NULL, '2025-08-25 06:57:06', '2025-08-25 06:57:06'),
(61, 'default', 'Team Updated, ID: 1', NULL, NULL, NULL, 'App\\Models\\User', 1, '{\"ip_address\":\"152.58.177.69\"}', NULL, NULL, '2025-08-25 06:57:44', '2025-08-25 06:57:44'),
(62, 'default', 'Team Created, ID: 3', NULL, NULL, NULL, 'App\\Models\\User', 1, '{\"ip_address\":\"152.58.177.16\"}', NULL, NULL, '2025-08-25 07:00:22', '2025-08-25 07:00:22'),
(63, 'default', 'Team Created, ID: 4', NULL, NULL, NULL, 'App\\Models\\User', 1, '{\"ip_address\":\"152.58.176.42\"}', NULL, NULL, '2025-08-25 07:04:04', '2025-08-25 07:04:04'),
(64, 'default', 'Team Updated, ID: 4', NULL, NULL, NULL, 'App\\Models\\User', 1, '{\"ip_address\":\"152.58.177.198\"}', NULL, NULL, '2025-08-25 07:05:02', '2025-08-25 07:05:02'),
(65, 'default', 'Team Updated, ID: 3', NULL, NULL, NULL, 'App\\Models\\User', 1, '{\"ip_address\":\"152.58.177.198\"}', NULL, NULL, '2025-08-25 07:05:59', '2025-08-25 07:05:59'),
(66, 'default', 'Team Created, ID: 5', NULL, NULL, NULL, 'App\\Models\\User', 1, '{\"ip_address\":\"152.58.177.83\"}', NULL, NULL, '2025-08-25 07:09:04', '2025-08-25 07:09:04'),
(67, 'default', 'Team Updated, ID: 5', NULL, NULL, NULL, 'App\\Models\\User', 1, '{\"ip_address\":\"152.58.177.199\"}', NULL, NULL, '2025-08-25 07:09:49', '2025-08-25 07:09:49'),
(68, 'default', 'Team Created, ID: 6', NULL, NULL, NULL, 'App\\Models\\User', 1, '{\"ip_address\":\"152.58.177.113\"}', NULL, NULL, '2025-08-25 07:11:41', '2025-08-25 07:11:41'),
(69, 'default', 'Content Created, ID: 4', NULL, NULL, NULL, 'App\\Models\\User', 1, '{\"ip_address\":\"152.59.163.68\"}', NULL, NULL, '2025-08-25 09:37:44', '2025-08-25 09:37:44'),
(70, 'default', 'Menu Deleted, ID: 3', NULL, NULL, NULL, 'App\\Models\\User', 1, '{\"ip_address\":\"152.59.163.68\"}', NULL, NULL, '2025-08-25 09:39:12', '2025-08-25 09:39:12'),
(71, 'default', 'Menu Created, ID: 28', NULL, NULL, NULL, 'App\\Models\\User', 1, '{\"ip_address\":\"152.59.163.68\"}', NULL, NULL, '2025-08-25 09:40:31', '2025-08-25 09:40:31'),
(72, 'default', 'Media Created, ID: 1', NULL, NULL, NULL, 'App\\Models\\User', 1, '{\"ip_address\":\"59.160.211.138\"}', NULL, NULL, '2025-08-25 17:44:58', '2025-08-25 17:44:58'),
(73, 'default', 'Content Created, ID: 5', NULL, NULL, NULL, 'App\\Models\\User', 1, '{\"ip_address\":\"59.160.211.138\"}', NULL, NULL, '2025-08-25 21:12:15', '2025-08-25 21:12:15'),
(74, 'default', 'Media Created, ID: 2', NULL, NULL, NULL, 'App\\Models\\User', 1, '{\"ip_address\":\"59.160.211.138\"}', NULL, NULL, '2025-08-25 21:15:35', '2025-08-25 21:15:35'),
(75, 'default', 'Media Created, ID: 3', NULL, NULL, NULL, 'App\\Models\\User', 1, '{\"ip_address\":\"59.160.211.138\"}', NULL, NULL, '2025-08-25 21:49:58', '2025-08-25 21:49:58'),
(76, 'default', 'Banner Order Updated', NULL, NULL, NULL, 'App\\Models\\User', 1, '{\"ip_address\":\"59.160.211.138\"}', NULL, NULL, '2025-08-25 21:53:40', '2025-08-25 21:53:40'),
(77, 'default', 'Banner Updated, ID: 1', NULL, NULL, NULL, 'App\\Models\\User', 1, '{\"ip_address\":\"59.160.211.138\"}', NULL, NULL, '2025-08-25 21:57:11', '2025-08-25 21:57:11'),
(78, 'default', 'Banner Created, ID: 3', NULL, NULL, NULL, 'App\\Models\\User', 1, '{\"ip_address\":\"59.160.211.138\"}', NULL, NULL, '2025-08-25 21:59:10', '2025-08-25 21:59:10'),
(79, 'default', 'Menu Created, ID: 29', NULL, NULL, NULL, 'App\\Models\\User', 1, '{\"ip_address\":\"59.160.211.138\"}', NULL, NULL, '2025-08-25 22:01:34', '2025-08-25 22:01:34'),
(80, 'default', 'Content Created, ID: 6', NULL, NULL, NULL, 'App\\Models\\User', 1, '{\"ip_address\":\"59.160.211.138\"}', NULL, NULL, '2025-08-25 22:04:18', '2025-08-25 22:04:18'),
(81, 'default', 'Content Updated, ID: 6', NULL, NULL, NULL, 'App\\Models\\User', 1, '{\"ip_address\":\"59.160.211.138\"}', NULL, NULL, '2025-08-25 22:05:19', '2025-08-25 22:05:19'),
(82, 'default', 'Menu Updated, ID: 29', NULL, NULL, NULL, 'App\\Models\\User', 1, '{\"ip_address\":\"59.160.211.138\"}', NULL, NULL, '2025-08-25 22:07:00', '2025-08-25 22:07:00'),
(83, 'default', 'Content Created, ID: 7', NULL, NULL, NULL, 'App\\Models\\User', 1, '{\"ip_address\":\"59.160.211.138\"}', NULL, NULL, '2025-08-25 22:08:18', '2025-08-25 22:08:18'),
(84, 'default', 'Menu Updated, ID: 29', NULL, NULL, NULL, 'App\\Models\\User', 1, '{\"ip_address\":\"59.160.211.138\"}', NULL, NULL, '2025-08-25 22:10:26', '2025-08-25 22:10:26'),
(85, 'default', 'Content Updated, ID: 7', NULL, NULL, NULL, 'App\\Models\\User', 1, '{\"ip_address\":\"59.160.211.138\"}', NULL, NULL, '2025-08-25 22:11:30', '2025-08-25 22:11:30'),
(86, 'default', 'Content Deleted, ID: 7', NULL, NULL, NULL, 'App\\Models\\User', 1, '{\"ip_address\":\"59.160.211.138\"}', NULL, NULL, '2025-08-25 22:11:54', '2025-08-25 22:11:54'),
(87, 'default', 'Content Created, ID: 8', NULL, NULL, NULL, 'App\\Models\\User', 1, '{\"ip_address\":\"59.160.211.138\"}', NULL, NULL, '2025-08-25 22:13:13', '2025-08-25 22:13:13'),
(88, 'default', 'Menu Created, ID: 30', NULL, NULL, NULL, 'App\\Models\\User', 1, '{\"ip_address\":\"59.160.211.138\"}', NULL, NULL, '2025-08-25 22:15:16', '2025-08-25 22:15:16'),
(89, 'default', 'Content Created, ID: 9', NULL, NULL, NULL, 'App\\Models\\User', 1, '{\"ip_address\":\"59.160.211.138\"}', NULL, NULL, '2025-08-25 22:17:20', '2025-08-25 22:17:20'),
(90, 'default', 'Menu Updated, ID: 30', NULL, NULL, NULL, 'App\\Models\\User', 1, '{\"ip_address\":\"59.160.211.138\"}', NULL, NULL, '2025-08-25 22:19:00', '2025-08-25 22:19:00'),
(91, 'default', 'Content Created, ID: 10', NULL, NULL, NULL, 'App\\Models\\User', 1, '{\"ip_address\":\"59.160.211.138\"}', NULL, NULL, '2025-08-25 22:19:59', '2025-08-25 22:19:59'),
(92, 'default', 'Menu Updated, ID: 30', NULL, NULL, NULL, 'App\\Models\\User', 1, '{\"ip_address\":\"59.160.211.138\"}', NULL, NULL, '2025-08-25 22:22:09', '2025-08-25 22:22:09'),
(93, 'default', 'Content Created, ID: 11', NULL, NULL, NULL, 'App\\Models\\User', 1, '{\"ip_address\":\"152.58.177.224\"}', NULL, NULL, '2025-08-26 05:30:20', '2025-08-26 05:30:20'),
(94, 'default', 'Content Updated, ID: 11', NULL, NULL, NULL, 'App\\Models\\User', 1, '{\"ip_address\":\"152.58.177.224\"}', NULL, NULL, '2025-08-26 05:31:37', '2025-08-26 05:31:37'),
(95, 'default', 'Content Created, ID: 12', NULL, NULL, NULL, 'App\\Models\\User', 1, '{\"ip_address\":\"152.58.177.224\"}', NULL, NULL, '2025-08-26 05:35:54', '2025-08-26 05:35:54'),
(96, 'default', 'Content Updated, ID: 12', NULL, NULL, NULL, 'App\\Models\\User', 1, '{\"ip_address\":\"152.58.177.224\"}', NULL, NULL, '2025-08-26 05:38:06', '2025-08-26 05:38:06'),
(97, 'default', 'Content Created, ID: 13', NULL, NULL, NULL, 'App\\Models\\User', 1, '{\"ip_address\":\"152.58.177.224\"}', NULL, NULL, '2025-08-26 05:41:51', '2025-08-26 05:41:51'),
(98, 'default', 'Content Updated, ID: 13', NULL, NULL, NULL, 'App\\Models\\User', 1, '{\"ip_address\":\"152.58.177.224\"}', NULL, NULL, '2025-08-26 05:48:12', '2025-08-26 05:48:12'),
(99, 'default', 'Content Created, ID: 14', NULL, NULL, NULL, 'App\\Models\\User', 1, '{\"ip_address\":\"152.58.177.224\"}', NULL, NULL, '2025-08-26 06:09:29', '2025-08-26 06:09:29'),
(100, 'default', 'Content Updated, ID: 14', NULL, NULL, NULL, 'App\\Models\\User', 1, '{\"ip_address\":\"152.58.177.224\"}', NULL, NULL, '2025-08-26 06:11:58', '2025-08-26 06:11:58'),
(101, 'default', 'Content Updated, ID: 14', NULL, NULL, NULL, 'App\\Models\\User', 1, '{\"ip_address\":\"152.58.177.224\"}', NULL, NULL, '2025-08-26 06:14:32', '2025-08-26 06:14:32'),
(102, 'default', 'Content Created, ID: 15', NULL, NULL, NULL, 'App\\Models\\User', 1, '{\"ip_address\":\"152.58.177.224\"}', NULL, NULL, '2025-08-26 06:16:30', '2025-08-26 06:16:30'),
(103, 'default', 'Content Created, ID: 16', NULL, NULL, NULL, 'App\\Models\\User', 1, '{\"ip_address\":\"152.58.177.224\"}', NULL, NULL, '2025-08-26 06:17:49', '2025-08-26 06:17:49'),
(104, 'default', 'Content Updated, ID: 15', NULL, NULL, NULL, 'App\\Models\\User', 1, '{\"ip_address\":\"152.58.177.224\"}', NULL, NULL, '2025-08-26 06:18:40', '2025-08-26 06:18:40'),
(105, 'default', 'Content Created, ID: 17', NULL, NULL, NULL, 'App\\Models\\User', 1, '{\"ip_address\":\"152.58.177.224\"}', NULL, NULL, '2025-08-26 06:20:27', '2025-08-26 06:20:27'),
(106, 'default', 'Content Updated, ID: 16', NULL, NULL, NULL, 'App\\Models\\User', 1, '{\"ip_address\":\"152.58.177.224\"}', NULL, NULL, '2025-08-26 06:21:32', '2025-08-26 06:21:32'),
(107, 'default', 'Menu Created, ID: 31', NULL, NULL, NULL, 'App\\Models\\User', 1, '{\"ip_address\":\"59.160.211.138\"}', NULL, NULL, '2025-08-26 17:18:15', '2025-08-26 17:18:15'),
(108, 'default', 'Content Created, ID: 18', NULL, NULL, NULL, 'App\\Models\\User', 1, '{\"ip_address\":\"59.160.211.138\"}', NULL, NULL, '2025-08-26 17:20:27', '2025-08-26 17:20:27'),
(109, 'default', 'User Created, ID: 14', NULL, NULL, NULL, 'App\\Models\\User', 1, '{\"ip_address\":\"59.160.211.138\"}', NULL, NULL, '2025-08-26 17:22:12', '2025-08-26 17:22:12'),
(110, 'default', 'Content Created, ID: 19', NULL, NULL, NULL, 'App\\Models\\User', 1, '{\"ip_address\":\"59.160.211.138\"}', NULL, NULL, '2025-08-26 17:25:20', '2025-08-26 17:25:20'),
(111, 'default', 'Content Updated, ID: 19', NULL, NULL, NULL, 'App\\Models\\User', 14, '{\"ip_address\":\"59.160.211.138\"}', NULL, NULL, '2025-08-26 17:27:19', '2025-08-26 17:27:19'),
(112, 'default', 'Permission Updated for role: Content Approver', NULL, NULL, NULL, 'App\\Models\\User', 1, '{\"ip_address\":\"59.160.211.138\"}', NULL, NULL, '2025-08-26 17:34:43', '2025-08-26 17:34:43'),
(113, 'default', 'Media Created, ID: 4', NULL, NULL, NULL, 'App\\Models\\User', 1, '{\"ip_address\":\"59.160.211.138\"}', NULL, NULL, '2025-08-26 17:58:20', '2025-08-26 17:58:20'),
(114, 'default', 'Content Updated, ID: 19', NULL, NULL, NULL, 'App\\Models\\User', 1, '{\"ip_address\":\"59.160.211.138\"}', NULL, NULL, '2025-08-26 19:02:34', '2025-08-26 19:02:34'),
(115, 'default', 'Content Updated, ID: 19', NULL, NULL, NULL, 'App\\Models\\User', 1, '{\"ip_address\":\"59.160.211.138\"}', NULL, NULL, '2025-08-26 19:06:42', '2025-08-26 19:06:42'),
(116, 'default', 'Menu Created, ID: 32', NULL, NULL, NULL, 'App\\Models\\User', 1, '{\"ip_address\":\"59.160.211.138\"}', NULL, NULL, '2025-08-26 19:08:12', '2025-08-26 19:08:12'),
(117, 'default', 'Content Created, ID: 20', NULL, NULL, NULL, 'App\\Models\\User', 1, '{\"ip_address\":\"59.160.211.138\"}', NULL, NULL, '2025-08-26 19:09:02', '2025-08-26 19:09:02'),
(118, 'default', 'Media Created, ID: 5', NULL, NULL, NULL, 'App\\Models\\User', 1, '{\"ip_address\":\"59.160.211.138\"}', NULL, NULL, '2025-08-26 19:12:47', '2025-08-26 19:12:47'),
(119, 'default', 'Media Updated, ID: 5', NULL, NULL, NULL, 'App\\Models\\User', 1, '{\"ip_address\":\"59.160.211.138\"}', NULL, NULL, '2025-08-26 19:14:14', '2025-08-26 19:14:14'),
(120, 'default', 'Media Created, ID: 6', NULL, NULL, NULL, 'App\\Models\\User', 1, '{\"ip_address\":\"59.160.211.138\"}', NULL, NULL, '2025-08-26 19:18:12', '2025-08-26 19:18:12'),
(121, 'default', 'Menu Created, ID: 33', NULL, NULL, NULL, 'App\\Models\\User', 1, '{\"ip_address\":\"127.0.0.1\"}', NULL, NULL, '2025-08-26 17:27:37', '2025-08-26 17:27:37'),
(122, 'default', 'Banner Order Updated', NULL, NULL, NULL, 'App\\Models\\User', 1, '{\"ip_address\":\"59.160.211.138\"}', NULL, NULL, '2025-08-28 18:33:04', '2025-08-28 18:33:04'),
(123, 'default', 'Content Created, ID: 21', NULL, NULL, NULL, 'App\\Models\\User', 1, '{\"ip_address\":\"127.0.0.1\"}', NULL, NULL, '2025-08-30 12:02:33', '2025-08-30 12:02:33'),
(124, 'default', 'Content Created, ID: 22', NULL, NULL, NULL, 'App\\Models\\User', 1, '{\"ip_address\":\"127.0.0.1\"}', NULL, NULL, '2025-08-30 17:47:52', '2025-08-30 17:47:52'),
(125, 'default', 'Media Created, ID: 7', NULL, NULL, NULL, 'App\\Models\\User', 1, '{\"ip_address\":\"127.0.0.1\"}', NULL, NULL, '2025-08-30 17:55:10', '2025-08-30 17:55:10'),
(126, 'default', 'Content Created, ID: 23', NULL, NULL, NULL, 'App\\Models\\User', 1, '{\"ip_address\":\"127.0.0.1\"}', NULL, NULL, '2025-08-31 04:41:19', '2025-08-31 04:41:19'),
(127, 'default', 'Content Created, ID: 24', NULL, NULL, NULL, 'App\\Models\\User', 1, '{\"ip_address\":\"127.0.0.1\"}', NULL, NULL, '2025-08-31 04:45:07', '2025-08-31 04:45:07'),
(128, 'default', 'Feedback Reply', NULL, NULL, NULL, 'App\\Models\\User', 1, '{\"ip_address\":\"127.0.0.1\"}', NULL, NULL, '2025-08-31 18:40:10', '2025-08-31 18:40:10'),
(129, 'default', 'Menu Created, ID: 34', NULL, NULL, NULL, 'App\\Models\\User', 1, '{\"ip_address\":\"127.0.0.1\"}', NULL, NULL, '2025-09-02 19:48:24', '2025-09-02 19:48:24'),
(130, 'default', 'AiprMaster Created, ID: 1', NULL, NULL, NULL, 'App\\Models\\User', 1, '{\"ip_address\":\"127.0.0.1\"}', NULL, NULL, '2025-09-02 19:50:25', '2025-09-02 19:50:25'),
(131, 'default', 'Banner Created, ID: 4', NULL, NULL, NULL, 'App\\Models\\User', 1, '{\"ip_address\":\"127.0.0.1\"}', NULL, NULL, '2025-09-02 20:24:23', '2025-09-02 20:24:23'),
(132, 'default', 'Banner Created, ID: 5', NULL, NULL, NULL, 'App\\Models\\User', 1, '{\"ip_address\":\"127.0.0.1\"}', NULL, NULL, '2025-09-02 20:25:49', '2025-09-02 20:25:49'),
(133, 'default', 'Content Created, ID: 25', NULL, NULL, NULL, 'App\\Models\\User', 1, '{\"ip_address\":\"127.0.0.1\"}', NULL, NULL, '2025-09-07 10:40:05', '2025-09-07 10:40:05'),
(134, 'default', 'Content Updated, ID: 25', NULL, NULL, NULL, 'App\\Models\\User', 1, '{\"ip_address\":\"127.0.0.1\"}', NULL, NULL, '2025-09-07 10:57:02', '2025-09-07 10:57:02'),
(135, 'default', 'Permission Updated for role: Super Admin', NULL, NULL, NULL, 'App\\Models\\User', 1, '{\"ip_address\":\"127.0.0.1\"}', NULL, NULL, '2025-09-07 10:58:04', '2025-09-07 10:58:04'),
(136, 'default', 'Content Updated, ID: 25', NULL, NULL, NULL, 'App\\Models\\User', 1, '{\"ip_address\":\"127.0.0.1\"}', NULL, NULL, '2025-09-07 11:16:17', '2025-09-07 11:16:17'),
(137, 'default', 'Permission Updated for role: Super Admin', NULL, NULL, NULL, 'App\\Models\\User', 1, '{\"ip_address\":\"127.0.0.1\"}', NULL, NULL, '2025-09-07 17:19:34', '2025-09-07 17:19:34'),
(138, 'default', 'Permission Updated for role: Super Admin', NULL, NULL, NULL, 'App\\Models\\User', 1, '{\"ip_address\":\"127.0.0.1\"}', NULL, NULL, '2025-09-07 17:25:26', '2025-09-07 17:25:26'),
(139, 'default', 'Permission Updated for role: Super Admin', NULL, NULL, NULL, 'App\\Models\\User', 1, '{\"ip_address\":\"127.0.0.1\"}', NULL, NULL, '2025-09-07 17:48:45', '2025-09-07 17:48:45'),
(140, 'default', 'Website Setting Updated', NULL, NULL, NULL, 'App\\Models\\User', 1, '{\"ip_address\":\"127.0.0.1\"}', NULL, NULL, '2025-09-07 17:51:17', '2025-09-07 17:51:17'),
(141, 'default', 'Website Setting Updated', NULL, NULL, NULL, 'App\\Models\\User', 1, '{\"ip_address\":\"127.0.0.1\"}', NULL, NULL, '2025-09-07 17:52:04', '2025-09-07 17:52:04');

-- --------------------------------------------------------

--
-- Table structure for table `advertises`
--

CREATE TABLE `advertises` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) DEFAULT NULL,
  `title_en` varchar(255) DEFAULT NULL,
  `title_hi` varchar(255) DEFAULT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `file` varchar(255) DEFAULT NULL,
  `is_active` tinyint(4) DEFAULT 1 COMMENT '0:Inactive,1:Active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `aiprs`
--

CREATE TABLE `aiprs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) DEFAULT NULL,
  `pno` varchar(255) DEFAULT NULL COMMENT 'Personal Number',
  `name` varchar(255) DEFAULT NULL COMMENT 'Name of the Officer',
  `unit` varchar(255) DEFAULT NULL COMMENT 'Unit of the Officer',
  `dpsu` varchar(255) DEFAULT NULL COMMENT 'DPSU of the Officer',
  `grade` varchar(255) DEFAULT NULL COMMENT 'Grade of the Officer',
  `currect_grade` varchar(255) DEFAULT NULL,
  `designation` varchar(255) DEFAULT NULL COMMENT 'Designation of the Officer',
  `doj_iofs` varchar(255) DEFAULT NULL COMMENT 'Date of Joining in IOFS',
  `dob` varchar(255) DEFAULT NULL COMMENT 'Date of Birth',
  `dor` varchar(255) DEFAULT NULL COMMENT 'Date of Retirement',
  `address` text DEFAULT NULL COMMENT 'Address of the Officer',
  `sex` varchar(255) DEFAULT NULL COMMENT 'Gender of the Officer',
  `sno` varchar(255) DEFAULT NULL COMMENT 'Serial Number',
  `others` varchar(255) DEFAULT NULL COMMENT 'Any other information',
  `menu_id` bigint(20) UNSIGNED NOT NULL,
  `unit_id` bigint(20) UNSIGNED NOT NULL,
  `is_active` tinyint(4) DEFAULT 1 COMMENT '0:Inactive,1:Active',
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `aiprs`
--

INSERT INTO `aiprs` (`id`, `uuid`, `pno`, `name`, `unit`, `dpsu`, `grade`, `currect_grade`, `designation`, `doj_iofs`, `dob`, `dor`, `address`, `sex`, `sno`, `others`, `menu_id`, `unit_id`, `is_active`, `created_by`, `updated_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(2, '857bd5e9-9cde-4768-bc8a-a089b06d4058', '990038', 'MAURYA A K', 'DOOKOL', 'DOO', 'APEX', '19-07-2024', 'DGO (C&S)', '08-08-1988', '05-10-1969', NULL, NULL, 'M', '1', NULL, 23, 1, 1, 1, NULL, '2025-08-26 19:16:52', '2025-08-26 19:17:47', '2025-08-26 19:17:47'),
(3, '3bf8ecc2-4ef5-465b-b2c6-47a799d1946a', '990038', 'MAURYA A K', 'DOOKOL', 'DOO', 'APEX', '19-07-2024', 'DGO (C&S)', '08-08-1988', '05-10-1969', NULL, NULL, 'M', '1', NULL, 23, 1, 1, 1, NULL, '2025-08-26 19:17:47', '2025-08-26 19:17:47', NULL),
(4, 'a1e4015d-ef06-4c79-855d-cb9e106ec2ba', '990038', 'SAMPLE 1', 'DOOKOL', 'DOO', 'APEX', NULL, 'DGO (C&S)', '05-10-1991', '05-10-1969', '19-07-2024', 'ADDRESS 1', 'M', '1', NULL, 24, 1, 1, 1, NULL, '2025-08-26 19:18:40', '2025-08-26 19:18:40', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `aipr_masters`
--

CREATE TABLE `aipr_masters` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `pno` varchar(255) DEFAULT NULL,
  `grade` varchar(255) DEFAULT NULL,
  `file` varchar(255) DEFAULT NULL,
  `file_size` varchar(255) DEFAULT NULL,
  `file_type` varchar(255) DEFAULT NULL,
  `menu_id` bigint(20) UNSIGNED NOT NULL,
  `unit_id` bigint(20) UNSIGNED NOT NULL,
  `is_active` tinyint(4) DEFAULT 1 COMMENT '0:Inactive,1:Active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `aipr_masters`
--

INSERT INTO `aipr_masters` (`id`, `uuid`, `name`, `pno`, `grade`, `file`, `file_size`, `file_type`, `menu_id`, `unit_id`, `is_active`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '297f0b72-8161-4153-bffd-6898e616fca0', 'dsfds', 'fds', 'dsfds', '68b74a800298d.png', '279.69KB', 'image/png', 34, 1, 1, '2025-09-02 19:50:25', '2025-09-02 19:50:25', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `banners`
--

CREATE TABLE `banners` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `unit_id` bigint(20) UNSIGNED DEFAULT NULL,
  `uuid` char(36) DEFAULT NULL,
  `title_en` varchar(255) DEFAULT NULL,
  `title_hi` varchar(255) DEFAULT NULL,
  `description_en` longtext DEFAULT NULL,
  `description_hi` longtext DEFAULT NULL,
  `file` varchar(255) DEFAULT NULL,
  `publish_date` date DEFAULT NULL,
  `expire_date` date DEFAULT NULL,
  `possition` varchar(255) DEFAULT NULL,
  `is_active` tinyint(4) DEFAULT 1 COMMENT '0:Inactive,1:Active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `menu_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `banners`
--

INSERT INTO `banners` (`id`, `unit_id`, `uuid`, `title_en`, `title_hi`, `description_en`, `description_hi`, `file`, `publish_date`, `expire_date`, `possition`, `is_active`, `created_at`, `updated_at`, `deleted_at`, `menu_id`) VALUES
(1, 1, '425b8dc4-5c15-46b1-a052-4c28f811963b', 'Indian Defense System', 'Indian Defense System', '<p>Hello this is Banner</p>', NULL, '68ab4693e3ba0.jpg', '2025-08-24', NULL, '1', 1, '2025-08-25 05:36:27', '2025-08-28 18:33:04', NULL, 1),
(2, 1, 'e60834aa-cf78-4594-b469-23fdf13d18cd', 'Title 2', 'Title 2', NULL, NULL, '68ab4729137e0.jpg', '2025-08-24', NULL, '2', 1, '2025-08-25 05:38:57', '2025-08-28 18:33:04', NULL, NULL),
(3, 1, '84863306-d3e3-454c-93fa-53b962602785', 'Test', NULL, '<p>Test Banner</p>', '<p>Test Banner</p>', '68ac2ce6af9a3.png', '2025-08-25', '2025-08-28', '3', 1, '2025-08-25 21:59:10', '2025-08-28 18:33:04', NULL, 1),
(4, 1, '58ea796d-fa4e-4996-bd70-2e1ce0553838', NULL, NULL, NULL, NULL, '68b7526b83d16.png', '2025-09-03', NULL, '4', 1, '2025-09-02 20:24:22', '2025-09-02 20:24:22', NULL, 1),
(5, 1, '79f32c28-c26f-4258-b2c0-6c905f943a60', NULL, NULL, NULL, NULL, '68b752cd8ff87.png', '2025-09-03', NULL, '5', 1, '2025-09-02 20:25:49', '2025-09-02 20:25:49', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `blogs`
--

CREATE TABLE `blogs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `description` longtext DEFAULT NULL,
  `file` varchar(255) DEFAULT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `meta_data` varchar(255) DEFAULT NULL,
  `meta_title` varchar(255) DEFAULT NULL,
  `meta_description` varchar(255) DEFAULT NULL,
  `is_active` tinyint(4) DEFAULT 1 COMMENT '0:Inactive,1:Active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) DEFAULT NULL,
  `title_en` varchar(255) DEFAULT NULL,
  `title_hi` varchar(255) DEFAULT NULL,
  `is_active` tinyint(4) DEFAULT 1 COMMENT '0:Inactive,1:Active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `uuid`, `title_en`, `title_hi`, `is_active`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '9b7dc0d3-17b7-4cf7-bde7-931f25c29993', 'General', 'केंद्रीय मंत्रिमंडल के निर्णय के अनुसरण में, 1 अक्टूबर, 2021 से प्रभावी', 1, '2025-08-23 20:05:32', '2025-08-23 20:05:32', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `cms`
--

CREATE TABLE `cms` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `contant_reviewer_id` bigint(20) UNSIGNED DEFAULT NULL,
  `contant_approver_id` bigint(20) UNSIGNED DEFAULT NULL,
  `hi_contant_writter_id` bigint(20) UNSIGNED DEFAULT NULL,
  `en_contant_writter_id` int(11) DEFAULT NULL,
  `uuid` char(36) DEFAULT NULL,
  `title_en` longtext DEFAULT NULL,
  `title_hi` longtext DEFAULT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `description_en` longtext DEFAULT NULL,
  `description_hi` longtext DEFAULT NULL,
  `file` varchar(255) DEFAULT NULL,
  `link` varchar(255) DEFAULT NULL,
  `date` varchar(255) DEFAULT NULL,
  `file_size` varchar(255) DEFAULT NULL,
  `file_type` varchar(255) DEFAULT NULL,
  `menu_id` bigint(20) UNSIGNED DEFAULT NULL,
  `section_id` bigint(20) UNSIGNED DEFAULT NULL,
  `is_active` tinyint(4) DEFAULT 1 COMMENT '0:Inactive,1:Active',
  `redirect_to` int(11) DEFAULT 0 COMMENT '0:No Redirect ,1:Link ,2:Details Page,3:Open File',
  `status` tinyint(4) DEFAULT 0 COMMENT '0:assigned,1:contant written done,2:contant approved done',
  `view_type` tinyint(4) DEFAULT 1 COMMENT '1:Description View,2:List View',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `publish_date` date DEFAULT NULL,
  `expire_date` date DEFAULT NULL,
  `unit_id` bigint(20) UNSIGNED DEFAULT NULL,
  `need_approval` varchar(255) DEFAULT NULL,
  `approve_status` enum('1','0') NOT NULL DEFAULT '0',
  `review_status` enum('1','0') NOT NULL DEFAULT '0',
  `en_content_writting_done` enum('1','0') NOT NULL DEFAULT '0',
  `hi_content_writting_done` enum('1','0') NOT NULL DEFAULT '0',
  `approver_comment` longtext DEFAULT NULL,
  `reviewer_comment` longtext DEFAULT NULL,
  `need_content_writter` varchar(255) DEFAULT NULL,
  `position` varchar(255) DEFAULT NULL,
  `hindi_approver_id` bigint(20) UNSIGNED DEFAULT NULL,
  `hindi_reviewer_id` bigint(20) UNSIGNED DEFAULT NULL,
  `hindi_approver_status` int(11) NOT NULL DEFAULT 0,
  `hindi_reviewer_status` int(11) NOT NULL DEFAULT 0,
  `hindi_contant_creator_status` int(11) NOT NULL DEFAULT 0,
  `english_contant_creator_status` int(11) NOT NULL DEFAULT 0,
  `task` longtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cms`
--

INSERT INTO `cms` (`id`, `contant_reviewer_id`, `contant_approver_id`, `hi_contant_writter_id`, `en_contant_writter_id`, `uuid`, `title_en`, `title_hi`, `slug`, `description_en`, `description_hi`, `file`, `link`, `date`, `file_size`, `file_type`, `menu_id`, `section_id`, `is_active`, `redirect_to`, `status`, `view_type`, `created_at`, `updated_at`, `deleted_at`, `publish_date`, `expire_date`, `unit_id`, `need_approval`, `approve_status`, `review_status`, `en_content_writting_done`, `hi_content_writting_done`, `approver_comment`, `reviewer_comment`, `need_content_writter`, `position`, `hindi_approver_id`, `hindi_reviewer_id`, `hindi_approver_status`, `hindi_reviewer_status`, `hindi_contant_creator_status`, `english_contant_creator_status`, `task`) VALUES
(1, 8, 7, 6, 5, '1bbca8ba-3db0-4ce7-bf7d-7a3d73e692c5', 'Advertisement for Walk-in Interview for hiring of HMP( MBBS doctor) at 09:30 AM on 01-09-2025 at OFH-Katni', 'Advertisement for Walk-in Interview for hiring of HMP( MBBS doctor) at 09:30 AM on 01-09-2025 at OFH-Katni', 'advertisement-for-walk-in-interview-for-hiring-of-hmp-mbbs-doctor-at-0930-am-on-01-09-2025-at-ofh-katni', NULL, NULL, NULL, NULL, '2025-08-24', NULL, NULL, 1, 2, 1, 1, 0, 1, '2025-08-25 05:44:43', '2025-08-25 05:44:43', NULL, '2025-08-24', NULL, 1, 'yes', '0', '0', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, NULL),
(2, 8, 7, 6, 5, '5813a80e-da86-4c19-b537-132b6ebf174c', 'In pursuance of the decision of the Union Cabinet, with effect from 1st October, 2021', 'In pursuance of the decision of the Union Cabinet, with effect from 1st October, 2021', 'in-pursuance-of-the-decision-of-the-union-cabinet-with-effect-from-1st-october-2021', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 2, 1, 2, 0, 1, '2025-08-25 05:49:39', '2025-08-25 05:49:39', NULL, '2025-08-24', NULL, 1, 'yes', '0', '0', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, NULL),
(3, 8, 7, 6, 5, '0bcd735f-1ace-4074-89c4-37c03562b4cb', 'List of provisionally selected candidates for engagement of professionals', 'List of provisionally selected candidates for engagement of professionals', 'list-of-provisionally-selected-candidates-for-engagement-of-professionals', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 2, 1, 3, 0, 1, '2025-08-25 05:51:09', '2025-08-25 05:51:09', NULL, '2025-08-24', NULL, 1, 'yes', '0', '0', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, NULL),
(4, NULL, NULL, NULL, NULL, '6c964983-4489-4858-8ac7-cd4bace1b83b', 'Home', 'घर', 'home', '<h4><strong>The Beginning</strong></h4><p>The history and development of Indian Ordnance Factories is directly linked with the British reign in India. East India company of England for their economic interest in India and to increase their political hold considered military hardware as vital element. During 1775 British authorities accepted the establishment of Board of Ordnance in Fort William, Kolkata. This marks the official beginning of the Army Ordnance in India.</p><p>In 1787 a gun powder factory was established at Ishapore which started production from 1791 (location at which Rifle Factory was established in 1904). In 1801 a Gun Carriage Agency at Cossipore, Kolkata (presently known as Gun &amp; Shell Factory, Cossipore) was eatablished and production started from 18th March, 1802. This is the first Industrial establishment of Ordnance Factories which has continued its existence till date.</p><h4><strong>Mission</strong></h4><h4><strong>Growth of Indian Ordnance Factories</strong></h4><p>The growth of the Ordnance Factories leading to its present setup has been continuous but in spurts. There were 18 ordnance factories before India became independent in 1947. 23 factories have been established after independence - mostly, in wake of defence preparedness imperatives caused by the three major wars fought by the Indian Armed forces.</p><h4><strong>Main Events</strong></h4><p>Main events in the evolution of Ordnance Factory can be listed as below:</p>', '<h4><strong>The Beginning</strong></h4><p>The history and development of Indian Ordnance Factories is directly linked with the British reign in India. East India company of England for their economic interest in India and to increase their political hold considered military hardware as vital element. During 1775 British authorities accepted the establishment of Board of Ordnance in Fort William, Kolkata. This marks the official beginning of the Army Ordnance in India.</p><p>In 1787 a gun powder factory was established at Ishapore which started production from 1791 (location at which Rifle Factory was established in 1904). In 1801 a Gun Carriage Agency at Cossipore, Kolkata (presently known as Gun &amp; Shell Factory, Cossipore) was eatablished and production started from 18th March, 1802. This is the first Industrial establishment of Ordnance Factories which has continued its existence till date.</p><h4><strong>Mission</strong></h4><h4><strong>Growth of Indian Ordnance Factories</strong></h4><p>The growth of the Ordnance Factories leading to its present setup has been continuous but in spurts. There were 18 ordnance factories before India became independent in 1947. 23 factories have been established after independence - mostly, in wake of defence preparedness imperatives caused by the three major wars fought by the Indian Armed forces.</p><h4><strong>Main Events</strong></h4><p>Main events in the evolution of Ordnance Factory can be listed as below:</p>', NULL, NULL, NULL, NULL, NULL, 4, 19, 1, NULL, 0, 1, '2025-08-25 09:37:44', '2025-08-25 09:37:44', NULL, '2025-08-19', NULL, 1, 'no', '1', '1', '0', '0', NULL, NULL, 'no', NULL, NULL, NULL, 0, 0, 0, 0, NULL),
(5, 8, 7, 6, 13, '1a418d39-d168-42fb-b72c-af94fa4f80f9', 'Test Content', 'परीक्षण सामग्री', 'test-content', NULL, NULL, NULL, NULL, '2025-08-25', NULL, NULL, 1, 4, 1, NULL, 0, 1, '2025-08-25 21:12:15', '2025-08-25 21:12:15', NULL, '2025-08-26', '2025-08-28', 1, 'yes', '0', '0', '0', '0', NULL, NULL, 'yes', NULL, NULL, NULL, 0, 0, 0, 0, NULL),
(6, NULL, NULL, NULL, NULL, '563c9626-bbbb-45c8-afa2-408b5cfc477c', 'Blank_Test', 'Blank_Test', 'blank-test', '<p>Hello OFB Test Data</p>', '<p>Hello OFB Test Data</p>', NULL, NULL, NULL, NULL, NULL, 29, 40, 1, NULL, 0, 1, '2025-08-25 22:04:18', '2025-08-25 22:05:19', NULL, '2025-08-25', '2025-08-26', 1, 'no', '1', '1', '0', '0', NULL, NULL, 'no', NULL, NULL, NULL, 0, 0, 0, 0, NULL),
(7, NULL, NULL, NULL, NULL, '520090a8-48e7-490a-83ca-e50cf12fa6cd', 'Test', 'Test', 'test', '<p>Hi Test</p>', NULL, NULL, NULL, NULL, NULL, NULL, 29, NULL, 1, NULL, 0, 1, '2025-08-25 22:08:18', '2025-08-25 22:11:54', '2025-08-25 22:11:54', '2025-08-24', '2025-08-28', 1, 'no', '1', '1', '0', '0', NULL, NULL, 'no', NULL, NULL, NULL, 0, 0, 0, 0, NULL),
(8, NULL, NULL, NULL, NULL, 'd6461161-4172-42db-9acf-f61007aa352c', 'Hello!', 'Hello!', 'hello', '<p>Test Data</p>', NULL, NULL, NULL, NULL, NULL, NULL, 29, 41, 1, NULL, 0, 1, '2025-08-25 22:13:13', '2025-08-25 22:13:13', NULL, '2025-08-24', NULL, 1, 'no', '1', '1', '0', '0', NULL, NULL, 'no', NULL, NULL, NULL, 0, 0, 0, 0, NULL),
(9, NULL, NULL, NULL, NULL, '2442de4c-6df9-4300-a1ef-82e6718e44ab', 'Test Hi', 'Test Hi', 'test-hi', '<p>ASCBHDBD</p>', '<p>ASCBHDBD</p>', NULL, NULL, NULL, NULL, NULL, 30, NULL, 1, NULL, 0, 1, '2025-08-25 22:17:20', '2025-08-25 22:17:20', NULL, '2025-08-25', NULL, 1, 'no', '1', '1', '0', '0', NULL, NULL, 'no', NULL, NULL, NULL, 0, 0, 0, 0, NULL),
(10, NULL, NULL, NULL, NULL, 'ac625c4d-e30a-4cc4-9364-2cd4cc3010d8', 'Hii', 'Hii', 'hii', '<p>Hello!!!!</p>', NULL, NULL, NULL, NULL, NULL, NULL, 30, NULL, 1, NULL, 0, 1, '2025-08-25 22:19:59', '2025-08-25 22:19:59', NULL, '2025-08-25', NULL, 1, 'no', '1', '1', '0', '0', NULL, NULL, 'no', NULL, NULL, NULL, 0, 0, 0, 0, NULL),
(11, 8, 7, 6, 5, '9684a31b-7912-4da3-b91e-ebed854db772', 'About Ministry', 'मंत्रालय के बारे में', 'about-ministry', '<p>In pursuance of the decision of the Union Cabinet to corporatise the functions of 41 production units (Ordnance Factories) of the erstwhile Ordnance Factory Board (\"OFB\"), functioning under the Department of Defence Production, Ministry of Defence (“DDP”), the Directorate of Ordnance (Coordination and Services), DOO(C&amp;S) came into existence on 1st October, 2021.<br><br>Furthermore, with effect from 1st October, 2021, the management, control, operations and maintenance of the 41 production units (Ordnance Factories) and identified non-production units of the erstwhile Ordnance Factory Board (“OFB”),were also handed over to the newly formed 7 DPSUs</p>', '<p>रक्षा उत्पादन विभाग, रक्षा मंत्रालय (\"डीडीपी\") के अंतर्गत कार्यरत पूर्ववर्ती आयुध निर्माणी बोर्ड (\"ओएफबी\") की 41 उत्पादन इकाइयों (आयुध निर्माणियों) के कार्यों का निगमीकरण करने के केंद्रीय मंत्रिमंडल के निर्णय के अनुसरण में, आयुध निदेशालय (समन्वय एवं सेवाएँ), डीओओ (सी एंड एस) 1 अक्टूबर, 2021 को अस्तित्व में आया।\r\n\r\nइसके अलावा, 1 अक्टूबर, 2021 से पूर्ववर्ती आयुध निर्माणी बोर्ड (\"ओएफबी\") की 41 उत्पादन इकाइयों (आयुध निर्माणियों) और चिन्हित गैर-उत्पादन इकाइयों का प्रबंधन, नियंत्रण, संचालन और रखरखाव भी नवगठित 7 डीपीएसयू को सौंप दिया गया।</p>', NULL, NULL, NULL, NULL, NULL, 1, 4, 1, NULL, 0, 1, '2025-08-26 05:30:19', '2025-08-26 05:31:37', NULL, '2025-08-25', NULL, 1, 'no', '1', '1', '0', '0', NULL, NULL, 'no', NULL, NULL, NULL, 0, 0, 0, 0, NULL),
(12, NULL, NULL, NULL, NULL, 'b299efab-3011-498b-8c6c-c565cceb19d1', 'About Ministry', 'मंत्रालय के बारे में', 'about-ministry', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 1, NULL, 0, 1, '2025-08-26 05:35:54', '2025-08-26 05:38:06', NULL, '2025-08-25', NULL, 1, 'no', '1', '1', '0', '0', NULL, NULL, 'no', NULL, NULL, NULL, 0, 0, 0, 0, NULL),
(14, NULL, NULL, NULL, NULL, '3d0fdc22-a5cd-4461-96b3-1ed6a107a10e', 'Creation of 7 DPSUs and Directorate of Ordnance (Coordination and Services)', 'Creation of 7 DPSUs and Directorate of Ordnance (Coordination and Services)', 'creation-of-7-dpsus-and-directorate-of-ordnance-coordination-and-services', 'The history and development of Indian Ordnance Factories is directly linked with the British reign in India. East India company of England for their economic interest in India and to increase their political hold considered military hardware as vital element. During 1775 British authorities accepted the establishment of Board of Ordnance in Fort William, Kolkata. This marks the official beginning of the Army Ordnance ', 'The history and development of Indian Ordnance Factories is directly linked with the British reign in India. East India company of England for their economic interest in India and to increase their political hold considered military hardware as vital element. During 1775 British authorities accepted the establishment of Board of Ordnance in Fort William, Kolkata. This marks the official beginning of the Army Ordnance ', NULL, NULL, NULL, NULL, NULL, 5, NULL, 1, 2, 0, 2, '2025-08-26 06:09:29', '2025-08-26 06:14:32', NULL, '2025-08-25', NULL, 1, 'no', '1', '1', '0', '0', NULL, NULL, 'no', NULL, NULL, NULL, 0, 0, 0, 0, NULL),
(15, NULL, NULL, NULL, NULL, '27fa0515-0720-495b-952e-c2eef8273650', 'Directorate of Ordnance (Coordination & Services) Field Unit Avadi (DFUAV)', 'Directorate of Ordnance (Coordination & Services) Field Unit Avadi (DFUAV)', 'directorate-of-ordnance-coordination-services-field-unit-avadi-dfuav', 'vdv', 'vfdz', NULL, NULL, NULL, NULL, NULL, 5, NULL, 1, 2, 0, 2, '2025-08-26 06:16:30', '2025-08-26 06:18:40', NULL, '2025-08-25', NULL, 1, 'no', '1', '1', '0', '0', NULL, NULL, 'no', NULL, NULL, NULL, 0, 0, 0, 0, NULL),
(16, NULL, NULL, NULL, NULL, '4e95efa7-bd98-4004-8a58-466a6993e606', 'Directorate of Ordnance (Coordination & Services) Field Unit Dehradun (DFUDUN)', 'Directorate of Ordnance (Coordination & Services) Field Unit Dehradun (DFUDUN)', 'directorate-of-ordnance-coordination-services-field-unit-dehradun-dfudun', 'fvd', 'dz', NULL, NULL, NULL, NULL, NULL, 5, NULL, 1, 2, 0, 2, '2025-08-26 06:17:49', '2025-08-26 06:21:32', NULL, '2025-08-25', NULL, 1, 'no', '1', '1', '0', '0', NULL, NULL, 'no', NULL, NULL, NULL, 0, 0, 0, 0, NULL),
(17, NULL, NULL, NULL, NULL, '2f9bcb30-1e67-42d8-b4be-2b3858d6a01d', 'Directorate of Ordnance (Coordination & Services) Field Unit Jabalpur (DFUJBL)', 'Directorate of Ordnance (Coordination & Services) Field Unit Jabalpur (DFUJBL)', 'directorate-of-ordnance-coordination-services-field-unit-jabalpur-dfujbl', 'df', 'df', NULL, NULL, NULL, NULL, NULL, 5, NULL, 1, 2, 0, 2, '2025-08-26 06:20:27', '2025-08-26 06:20:27', NULL, '2025-08-25', NULL, 1, 'no', '1', '1', '0', '0', NULL, NULL, 'no', NULL, NULL, NULL, 0, 0, 0, 0, NULL),
(18, NULL, NULL, NULL, NULL, '3c0be571-2cb3-4b7b-b555-5a370686af9e', 'Test-Blank', 'Test-Blank', 'test-blank', '<h4><strong>The Beginning</strong></h4><p>The history and development of Indian Ordnance Factories is directly linked with the British reign in India. East India company of England for their economic interest in India and to increase their political hold considered military hardware as vital element. During 1775 British authorities accepted the establishment of Board of Ordnance in Fort William, Kolkata. This marks the official beginning of the Army Ordnance in India.</p><p>In 1787 a gun powder factory was established at Ishapore which started production from 1791 (location at which Rifle Factory was established in 1904). In 1801 a Gun Carriage Agency at Cossipore, Kolkata (presently known as Gun &amp; Shell Factory, Cossipore) was eatablished and production started from 18th March, 1802. This is the first Industrial establishment of Ordnance Factories which has continued its existence till date.</p>', '<h4><strong>The Beginning</strong></h4><p>The history and development of Indian Ordnance Factories is directly linked with the British reign in India. East India company of England for their economic interest in India and to increase their political hold considered military hardware as vital element. During 1775 British authorities accepted the establishment of Board of Ordnance in Fort William, Kolkata. This marks the official beginning of the Army Ordnance in India.</p><p>In 1787 a gun powder factory was established at Ishapore which started production from 1791 (location at which Rifle Factory was established in 1904). In 1801 a Gun Carriage Agency at Cossipore, Kolkata (presently known as Gun &amp; Shell Factory, Cossipore) was eatablished and production started from 18th March, 1802. This is the first Industrial establishment of Ordnance Factories which has continued its existence till date.</p>', NULL, NULL, NULL, NULL, NULL, 31, 44, 1, NULL, 0, 1, '2025-08-26 17:20:27', '2025-08-26 17:20:27', NULL, '2025-08-26', '2025-08-26', 1, 'no', '1', '1', '0', '0', NULL, NULL, 'no', NULL, NULL, NULL, 0, 0, 0, 0, NULL),
(19, 8, 7, 6, 14, 'bc49ca32-18d7-4f8b-b0a6-0b7181249ec4', 'Test Content', 'परीक्षण सामग्री', 'test-content', '<p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>', '<p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>', NULL, NULL, NULL, NULL, NULL, 31, 45, 1, NULL, 0, 1, '2025-08-26 17:25:20', '2025-08-26 19:06:42', NULL, '2025-08-26', NULL, 1, 'no', '1', '1', '0', '0', NULL, NULL, 'no', NULL, NULL, NULL, 0, 0, 0, 0, NULL),
(20, NULL, NULL, NULL, NULL, '83300a16-5c52-4745-ac48-a2a53d0aa492', 'Test', 'Test', 'test', '<h4><strong>The Beginning</strong></h4><p>The history and development of Indian Ordnance Factories is directly linked with the British reign in India. East India company of England for their economic interest in India and to increase their political hold considered military hardware as vital element. During 1775 British authorities accepted the establishment of Board of Ordnance in Fort William, Kolkata. This marks the official beginning of the Army Ordnance in India.</p><p>In 1787 a gun powder factory was established at Ishapore which started production from 1791 (location at which Rifle Factory was established in 1904). In 1801 a Gun Carriage Agency at Cossipore, Kolkata (presently known as Gun &amp; Shell Factory, Cossipore) was eatablished and production started from 18th March, 1802. This is the first Industrial establishment of Ordnance Factories which has continued its existence till date.</p>', '<h4><strong>The Beginning</strong></h4><p>The history and development of Indian Ordnance Factories is directly linked with the British reign in India. East India company of England for their economic interest in India and to increase their political hold considered military hardware as vital element. During 1775 British authorities accepted the establishment of Board of Ordnance in Fort William, Kolkata. This marks the official beginning of the Army Ordnance in India.</p><p>In 1787 a gun powder factory was established at Ishapore which started production from 1791 (location at which Rifle Factory was established in 1904). In 1801 a Gun Carriage Agency at Cossipore, Kolkata (presently known as Gun &amp; Shell Factory, Cossipore) was eatablished and production started from 18th March, 1802. This is the first Industrial establishment of Ordnance Factories which has continued its existence till date.</p>', NULL, NULL, NULL, NULL, NULL, 32, 47, 1, NULL, 0, 1, '2025-08-26 19:09:02', '2025-08-26 19:09:02', NULL, '2025-08-26', NULL, 1, 'no', '1', '1', '0', '0', NULL, NULL, 'no', NULL, NULL, NULL, 0, 0, 0, 0, NULL),
(21, NULL, NULL, NULL, NULL, '8600d453-0aa8-4bdf-bfe4-e865172cd93f', 'List of provisionally selected candidates for engagement of professionals', 'पेशेवरों की नियुक्ति के लिए अनंतिम रूप से चयनित उम्मीदवारों की सूची', 'list-of-provisionally-selected-candidates-for-engagement-of-professionals', '<h4><strong>In pursuance of the decision of the Union Cabinet, with effect from 1st October, 2021</strong></h4>', '<h4><strong>In pursuance of the decision of the Union Cabinet, with effect from 1st October, 2021</strong></h4>', NULL, 'https://ddpdoo.gov.in/', NULL, NULL, NULL, 7, NULL, 1, 1, 0, 1, '2025-08-30 12:02:33', '2025-08-30 12:02:33', NULL, '2025-08-21', NULL, 1, 'no', '1', '1', '0', '0', NULL, NULL, 'no', NULL, NULL, NULL, 0, 0, 0, 0, NULL),
(22, NULL, NULL, NULL, NULL, 'ac2c0378-a2d5-426a-956e-5b169f8775af', 'OVRA Portal is down due to maintenance.', 'केंद्रीय मंत्रिमंडल के निर्णय के अनुसरण में, 1 अक्टूबर, 2021 से प्रभावी', 'ovra-portal-is-down-due-to-maintenance', '<p>cfsadsafdsaf</p>', '<p>fsafsaf</p>', NULL, NULL, NULL, NULL, NULL, 7, NULL, 1, NULL, 0, 1, '2025-08-30 17:47:52', '2025-08-30 17:47:52', NULL, '2025-08-29', NULL, 1, 'no', '1', '1', '0', '0', NULL, NULL, 'no', NULL, NULL, NULL, 0, 0, 0, 0, NULL),
(23, NULL, NULL, NULL, NULL, '50cd8bfc-7aaf-4de6-8a9a-a7d53576d29b', 'List of provisionally selected candidates for engagement of professionals', 'पेशेवरों की नियुक्ति के लिए अनंतिम रूप से चयनित उम्मीदवारों की सूची', 'list-of-provisionally-selected-candidates-for-engagement-of-professionals', '<p>hthrthrthtr</p>', '<p>hrthrth</p>', NULL, NULL, NULL, NULL, NULL, 9, NULL, 1, NULL, 0, 1, '2025-08-31 04:41:18', '2025-08-31 04:41:18', NULL, '2025-08-29', NULL, 1, 'no', '1', '1', '0', '0', NULL, NULL, 'no', NULL, NULL, NULL, 0, 0, 0, 0, NULL),
(24, NULL, NULL, NULL, NULL, '62c9adbc-6588-46fa-90d6-997e9dc2ac52', 'Main Events', 'केंद्रीय मंत्रिमंडल के निर्णय के अनुसरण में, 1 अक्टूबर, 2021 से प्रभावी', 'main-events', '<p>bv</p>', '<p>vc</p>', NULL, NULL, NULL, NULL, NULL, 9, NULL, 1, NULL, 0, 1, '2025-08-31 04:45:07', '2025-08-31 04:45:07', NULL, '2025-08-27', NULL, 1, 'no', '1', '1', '0', '0', NULL, NULL, 'no', NULL, NULL, NULL, 0, 0, 0, 0, NULL),
(25, 8, 7, 6, 5, '05a27e8a-9723-442e-a633-7c7d8dda5df9', 'DDGVSGDSGDSGDSGDSGDSF', NULL, 'ddgvsgdsgdsgdsgdsgdsf', '<p>GDSGDSGDGDSGDSGDSGDSGDS</p>', NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 1, NULL, 0, 1, '2025-09-07 10:40:05', '2025-09-07 11:16:17', NULL, NULL, NULL, 1, NULL, '0', '0', '0', '0', NULL, NULL, 'yes', NULL, NULL, NULL, 0, 0, 0, 0, 'vsdasfvsadfds');

-- --------------------------------------------------------

--
-- Table structure for table `designations`
--

CREATE TABLE `designations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `is_active` tinyint(4) DEFAULT 1 COMMENT '0:Inactive,1:Active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `designations`
--

INSERT INTO `designations` (`id`, `uuid`, `title`, `is_active`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '1e548198-426f-4c3f-8a3e-f4b3738da038', 'Director General Ordnance (C&S)', 1, '2025-08-25 06:48:24', '2025-08-25 06:48:24', NULL),
(2, '7f11f8d7-a2bb-4606-a98c-5aae99fc129e', 'Additional Director General Ordnance (C&S)', 1, '2025-08-25 06:49:07', '2025-08-25 06:49:07', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `documents`
--

CREATE TABLE `documents` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) DEFAULT NULL,
  `title_en` varchar(255) DEFAULT NULL,
  `title_hi` varchar(255) DEFAULT NULL,
  `file` varchar(255) DEFAULT NULL,
  `file_size` varchar(255) DEFAULT NULL,
  `file_type` varchar(255) DEFAULT NULL,
  `public_date` date DEFAULT NULL,
  `expiry_date` date DEFAULT NULL,
  `category_id` bigint(20) UNSIGNED DEFAULT NULL,
  `menu_id` bigint(20) UNSIGNED NOT NULL,
  `unit_id` bigint(20) UNSIGNED NOT NULL,
  `is_active` tinyint(4) DEFAULT 1 COMMENT '0:Inactive,1:Active',
  `file_language` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `position` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `documents`
--

INSERT INTO `documents` (`id`, `uuid`, `title_en`, `title_hi`, `file`, `file_size`, `file_type`, `public_date`, `expiry_date`, `category_id`, `menu_id`, `unit_id`, `is_active`, `file_language`, `created_at`, `updated_at`, `deleted_at`, `position`) VALUES
(1, 'e37a4689-6220-4d0a-ad6e-0d62ea55242f', 'List of provisionally selected candidates for engagement of professionals', 'List of provisionally selected candidates for engagement of professionals', '68ab5281ce237.pdf', '48.51KB', 'application/pdf', '2025-08-24', NULL, 1, 11, 1, 1, NULL, '2025-08-25 06:27:21', '2025-08-25 06:27:21', NULL, NULL),
(2, '51b255b2-c229-4165-aca6-16bb12bf6811', 'List of provisionally selected candidates for engagement of professionals', 'List of provisionally selected candidates for engagement of professionals', '68ab535e8faa5.pdf', '48.51KB', 'application/pdf', '2025-08-24', NULL, 1, 11, 1, 1, NULL, '2025-08-25 06:31:02', '2025-08-25 06:31:02', NULL, NULL),
(3, '87103f20-bed5-4368-a28a-ed844c2f5f97', 'List of provisionally selected candidates for engagement of professionals', 'List of provisionally selected candidates for engagement of professionals', '68ab553f9c212.pdf', '48.51KB', 'application/pdf', '2025-08-24', NULL, 1, 10, 1, 1, NULL, '2025-08-25 06:39:03', '2025-08-25 06:39:03', NULL, NULL),
(4, '4fb298fc-2d08-44a6-95aa-c94c1f34f8ca', 'List of provisionally selected candidates for engagement of professionals', 'List of provisionally selected candidates for engagement of professionals', '68ab557d32322.pdf', '48.51KB', 'application/pdf', '2025-08-24', NULL, 1, 10, 1, 1, NULL, '2025-08-25 06:40:05', '2025-08-25 06:40:05', NULL, NULL),
(5, 'f44933ea-93fc-46c3-8fce-10fc18550240', 'Demo report 1', 'Demo report', '68ab564f979b6.pdf', '48.51KB', 'application/pdf', '2025-08-24', NULL, 1, 21, 1, 1, NULL, '2025-08-25 06:43:35', '2025-08-25 06:43:35', NULL, NULL),
(6, 'e932ee3c-ed14-4525-b895-3045c321e876', 'Demo report 2', 'Demo report 2', '68ab56a09a962.pdf', '48.51KB', 'application/pdf', '2025-08-24', NULL, 1, 21, 1, 1, NULL, '2025-08-25 06:44:56', '2025-08-25 06:44:56', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `features`
--

CREATE TABLE `features` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `description` longtext DEFAULT NULL,
  `file` varchar(255) DEFAULT NULL,
  `icon` varchar(255) DEFAULT NULL,
  `is_active` tinyint(4) DEFAULT 1 COMMENT '0:Inactive,1:Active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `mobile` varchar(255) DEFAULT NULL,
  `feedback` text DEFAULT NULL,
  `unit_id` bigint(20) UNSIGNED NOT NULL,
  `feedback_type` varchar(255) DEFAULT NULL,
  `is_replied` int(11) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`id`, `name`, `email`, `mobile`, `feedback`, `unit_id`, `feedback_type`, `is_replied`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Anol Koley', 'anol@gmail.com', '9087766554', 'hi demo demo', 1, NULL, 1, '2025-08-26 18:38:17', '2025-08-31 18:40:10', NULL),
(2, 'dsggds', 'gdsgds@gmail.com', '3245324354', 'bvfcxbfvdxbfd', 1, 'gdsgdsg', 0, '2025-08-31 14:16:39', '2025-08-31 14:16:39', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `hods`
--

CREATE TABLE `hods` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `uuid` char(36) DEFAULT NULL,
  `hod_name` varchar(255) DEFAULT NULL,
  `designation` varchar(255) DEFAULT NULL,
  `from_date` date DEFAULT NULL,
  `to_date` date DEFAULT NULL,
  `unit_id` bigint(20) UNSIGNED DEFAULT NULL,
  `file` varchar(255) DEFAULT NULL,
  `is_active` tinyint(4) DEFAULT 1 COMMENT '0:Inactive,1:Active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `important_links`
--

CREATE TABLE `important_links` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) DEFAULT NULL,
  `title_en` varchar(255) DEFAULT NULL,
  `title_hi` varchar(255) DEFAULT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `description_en` longtext DEFAULT NULL,
  `description_hi` longtext DEFAULT NULL,
  `file` varchar(255) DEFAULT NULL,
  `is_active` tinyint(4) DEFAULT 1 COMMENT '0:Inactive,1:Active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `media`
--

CREATE TABLE `media` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) DEFAULT NULL,
  `title_en` varchar(255) DEFAULT NULL,
  `title_hi` varchar(255) DEFAULT NULL,
  `youtube_link` longtext DEFAULT NULL,
  `menu_id` bigint(20) UNSIGNED NOT NULL,
  `unit_id` bigint(20) UNSIGNED NOT NULL,
  `is_active` tinyint(4) DEFAULT 1 COMMENT '0:Inactive,1:Active',
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `media`
--

INSERT INTO `media` (`id`, `uuid`, `title_en`, `title_hi`, `youtube_link`, `menu_id`, `unit_id`, `is_active`, `created_by`, `updated_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '4734a621-18eb-40bd-abd4-b37c093de787', 'Service', 'सेवा', NULL, 26, 1, 1, NULL, NULL, '2025-08-25 17:44:58', '2025-08-25 17:44:58', NULL),
(2, '624ede49-60b1-4ec8-81bd-fa7e40bd613a', 'Reports', 'Reports', 'https://www.youtube.com/watch?v=WfqMmypbACg&list=RDWfqMmypbACg&start_radio=1', 27, 1, 1, NULL, NULL, '2025-08-25 21:15:35', '2025-08-25 21:15:35', NULL),
(3, 'a9f59289-8eb8-4d7d-b668-8f1cc8144075', 'Reports', 'Reports', NULL, 26, 1, 1, NULL, NULL, '2025-08-25 21:49:58', '2025-08-25 21:49:58', NULL),
(4, 'd0e2f644-5933-48c4-b88d-2a19e0596b73', 'Test Albulm', 'Test Albulm', NULL, 26, 1, 1, NULL, NULL, '2025-08-26 17:58:20', '2025-08-26 17:58:20', NULL),
(5, '3f5d6e45-9d79-491b-aec9-1090b4f5ae46', 'Test Albulm', 'Test Album', NULL, 26, 1, 1, NULL, NULL, '2025-08-26 19:12:47', '2025-08-26 19:12:47', NULL),
(6, '6ce55ab2-8975-42df-a897-5a9d1da9e49b', 'Video - Test', 'Video - Test', '<iframe width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/Qm846KdZN_c?si=fradPh6KXuTKlJfs\" title=\"YouTube video player\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share\" referrerpolicy=\"strict-origin-when-cross-origin\" allowfullscreen></iframe>', 27, 1, 1, NULL, NULL, '2025-08-26 19:18:12', '2025-08-26 19:18:12', NULL),
(7, 'f4fd5f77-8771-4a02-a327-0bdda37aef00', 'fdsfdsfd', 'fdsfdsfds', '<iframe width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/hxMNYkLN7tI?si=q6wPJAdt7MpXP8T6\" title=\"YouTube video player\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share\" referrerpolicy=\"strict-origin-when-cross-origin\" allowfullscreen></iframe>', 27, 1, 1, NULL, NULL, '2025-08-30 17:55:10', '2025-08-30 17:55:10', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `media_images`
--

CREATE TABLE `media_images` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) DEFAULT NULL,
  `file` varchar(255) DEFAULT NULL,
  `media_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `media_images`
--

INSERT INTO `media_images` (`id`, `uuid`, `file`, `media_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, NULL, '68abf152b35b0.jpg', 1, '2025-08-25 17:44:58', '2025-08-25 17:44:58', NULL),
(2, NULL, '68ac2abe2451b.jpg', 3, '2025-08-25 21:49:58', '2025-08-25 21:49:58', NULL),
(3, NULL, '68ad45f44e71a.jpg', 4, '2025-08-26 17:58:20', '2025-08-26 17:58:20', NULL),
(4, NULL, '68ad45f454927.jpg', 4, '2025-08-26 17:58:20', '2025-08-26 17:58:20', NULL),
(5, NULL, '68ad45f45556c.png', 4, '2025-08-26 17:58:20', '2025-08-26 17:58:20', NULL),
(6, NULL, '68ad45f455ede.jpg', 4, '2025-08-26 17:58:20', '2025-08-26 17:58:20', NULL),
(7, NULL, '68ad57675976e.jpg', 5, '2025-08-26 19:12:47', '2025-08-26 19:12:47', NULL),
(8, NULL, '68ad57675cae0.PNG', 5, '2025-08-26 19:12:47', '2025-08-26 19:12:47', NULL),
(9, NULL, '68ad57675d477.jpg', 5, '2025-08-26 19:12:47', '2025-08-26 19:12:47', NULL),
(10, NULL, '68ad57be0cccf.png', 5, '2025-08-26 19:14:14', '2025-08-26 19:14:14', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `menus`
--

CREATE TABLE `menus` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `extend_to` bigint(20) UNSIGNED DEFAULT NULL,
  `menu_type` varchar(255) DEFAULT '0' COMMENT '0: header, 1: footer',
  `unit_id` bigint(20) UNSIGNED DEFAULT NULL,
  `uuid` char(36) DEFAULT NULL,
  `title_en` varchar(255) DEFAULT NULL,
  `title_hi` varchar(255) DEFAULT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `file` varchar(255) DEFAULT NULL,
  `parent_id` bigint(20) UNSIGNED DEFAULT NULL,
  `position` int(11) DEFAULT NULL,
  `is_active` tinyint(4) DEFAULT 1 COMMENT '0:Inactive,1:Active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `menus`
--

INSERT INTO `menus` (`id`, `updated_by`, `created_by`, `extend_to`, `menu_type`, `unit_id`, `uuid`, `title_en`, `title_hi`, `slug`, `file`, `parent_id`, `position`, `is_active`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, NULL, 1, 1, '0', 1, '6c5789dd-d3bd-4d01-b8e5-2fd3fb82ed13', 'Home', 'घर', 'home', NULL, NULL, NULL, 1, '2025-08-25 04:45:19', '2025-08-25 04:45:19', NULL),
(2, NULL, 1, NULL, '0', 1, '42181faa-7426-484e-8227-694c43df3eff', 'Ministry', 'Ministry', 'ministry', NULL, NULL, NULL, 1, '2025-08-25 04:47:20', '2025-08-25 04:47:20', NULL),
(4, NULL, 1, 3, '0', 1, 'f46da563-f46a-42c7-9052-89f6b7093f0f', 'Our History', 'Our History', 'our-history', NULL, 2, NULL, 1, '2025-08-25 04:57:20', '2025-08-25 04:57:20', NULL),
(5, NULL, 1, 5, '0', 1, '704fe052-23f6-4351-a4cf-cda5a32871c9', 'Our Organization', 'Our Organization', 'our-organization', NULL, 2, NULL, 1, '2025-08-25 04:58:06', '2025-08-25 04:58:06', NULL),
(6, NULL, 1, 4, '0', 1, 'f7cc1766-3d09-4dc1-ae67-4a21943e58d2', 'Our Team', 'Our Team', 'our-team', NULL, 2, NULL, 1, '2025-08-25 04:58:49', '2025-08-25 04:58:49', NULL),
(7, NULL, 1, 6, '0', 1, 'ed19f066-1309-4215-ac32-821674fbeb63', 'Whats New', 'Whats New', 'whats-new', NULL, 2, NULL, 1, '2025-08-25 05:00:18', '2025-08-25 05:00:18', NULL),
(8, NULL, 1, NULL, '0', 1, '78f00603-7f48-4855-8483-e72e5bcdb433', 'Offerings', 'Offerings', 'offerings', NULL, NULL, NULL, 1, '2025-08-25 05:01:47', '2025-08-25 05:01:47', NULL),
(9, NULL, 1, 7, '0', 1, 'f27be875-3781-4530-afdd-cffe04966bb0', 'Schemes  and Services', 'Schemes and  Services', 'schemes-and-services', NULL, 8, NULL, 1, '2025-08-25 05:03:36', '2025-08-25 05:03:36', NULL),
(10, NULL, 1, 8, '0', 1, '1ee5c7bb-2c09-4a4a-8e23-5c7460f84cc9', 'Vacancies', 'Vacancies', 'vacancies', NULL, 8, NULL, 1, '2025-08-25 05:04:28', '2025-08-25 05:04:28', NULL),
(11, NULL, 1, 9, '0', 1, '389c07d5-6826-4ee2-be8c-4edb6f529d9a', 'Tenders', 'Tenders', 'tenders', NULL, 8, NULL, 1, '2025-08-25 05:05:13', '2025-08-25 05:05:13', NULL),
(12, NULL, 1, NULL, '0', 1, 'd1f3ea4c-8ca3-4211-b625-da3404d901d2', 'Vigilance', 'Vigilance', 'vigilance', NULL, NULL, NULL, 1, '2025-08-25 05:06:02', '2025-08-25 05:06:02', NULL),
(13, NULL, 1, 2, '0', 1, '85073404-f620-407c-89ba-1f5ffa235431', 'About Us', 'About Us', 'about-us', NULL, 12, NULL, 1, '2025-08-25 05:06:47', '2025-08-25 05:06:47', NULL),
(14, NULL, 1, 4, '0', 1, '0f02fd7b-ab31-4bcf-96d5-74b3dcaaf4fa', 'Our Team', 'Our Team', 'our-team', NULL, 12, NULL, 1, '2025-08-25 05:07:44', '2025-08-25 05:07:44', NULL),
(15, NULL, 1, 10, '0', 1, 'fe5d4afd-4dac-4d4f-bf98-09906454f7e8', 'Contact Us', 'Contact Us', 'contact-us', NULL, 12, NULL, 1, '2025-08-25 05:09:08', '2025-08-25 05:09:08', NULL),
(16, NULL, 1, 18, '0', 1, 'ed279f43-ae82-4185-9bef-a5a65e08ae73', 'Vigilance Awareness Week 2024', 'Vigilance Awareness Week 2024', 'vigilance-awareness-week-2024', NULL, 12, NULL, 1, '2025-08-25 05:13:08', '2025-08-25 05:13:08', NULL),
(17, 1, 1, NULL, '0', 1, '657ea783-a846-4468-867e-9f0c2bda559d', 'Connect', 'Connect', 'connect', NULL, NULL, NULL, 1, '2025-08-25 05:14:24', '2025-08-25 05:20:49', NULL),
(18, NULL, 1, 10, '0', 1, '75524cf4-86d0-4ff7-b40b-f20438503452', 'Contact Us', 'Contact Us', 'contact-us', NULL, 17, NULL, 1, '2025-08-25 05:21:37', '2025-08-25 05:21:37', NULL),
(19, NULL, 1, 4, '0', 1, '83d13590-fd59-4a9c-a909-4aeca74fe753', 'Directory', 'Directory', 'directory', NULL, 17, NULL, 1, '2025-08-25 05:23:30', '2025-08-25 05:23:30', NULL),
(20, NULL, 1, 11, '0', 1, '0a52e1ae-e9f1-4dab-8ac4-12f738600212', 'RTI', 'RTI', 'rti', NULL, 17, NULL, 1, '2025-08-25 05:24:20', '2025-08-25 05:24:20', NULL),
(21, NULL, 1, 17, '0', 1, '02fb0e98-8e6d-4c5f-be65-98c7837053d0', 'Reports', 'Reports', 'reports', NULL, NULL, NULL, 1, '2025-08-25 05:25:46', '2025-08-25 05:25:46', NULL),
(22, NULL, 1, NULL, '0', 1, '579fed6f-c4df-4dce-ad15-ed3062bd76c5', 'IOFS Officer', 'IOFS Officer', 'iofs-officer', NULL, NULL, NULL, 1, '2025-08-25 05:27:04', '2025-08-25 05:27:04', NULL),
(23, NULL, 1, 16, '0', 1, 'b9e1996d-850b-48e9-ab0b-bb92a24e577d', 'IOFS Officers list', 'IOFS Officers list', 'iofs-officers-list', NULL, 22, NULL, 1, '2025-08-25 05:28:14', '2025-08-25 05:28:14', NULL),
(24, NULL, 1, 15, '0', 1, '2e8394a8-8232-4301-b46f-98caf40ff410', 'Retired IOFS Officers list', 'Retired IOFS Officers list', 'retired-iofs-officers-list', NULL, 22, NULL, 1, '2025-08-25 05:29:13', '2025-08-25 05:29:13', NULL),
(25, NULL, 1, NULL, '0', 1, 'd1de33d9-eacc-4fc8-a18d-43941fc42b27', 'Media', 'Media', 'media', NULL, NULL, NULL, 1, '2025-08-25 05:30:27', '2025-08-25 05:30:27', NULL),
(26, NULL, 1, 13, '0', 1, '4a980013-89e8-4f66-9d06-c24a1b64be61', 'Image', 'Image', 'image', NULL, 25, NULL, 1, '2025-08-25 05:31:25', '2025-08-25 05:31:25', NULL),
(27, NULL, 1, 14, '0', 1, '41f4f147-d48e-4925-8687-f3a48f8f1939', 'Video', 'Video', 'video', NULL, 25, NULL, 1, '2025-08-25 05:32:10', '2025-08-25 05:32:10', NULL),
(29, 1, 1, 2, '0', 1, 'dc14b404-a3fc-4c62-a4f9-062e88a8442a', 'Blank Menu', 'Blank Menu', 'blank-menu', NULL, NULL, NULL, 1, '2025-08-25 22:01:34', '2025-08-25 22:10:26', NULL),
(30, 1, 1, 3, '0', 1, 'bf6f0154-d4d9-4b7b-8e6f-b66dbccf5857', 'Blank 2', 'Blank 2', 'blank-2', NULL, 4, NULL, 1, '2025-08-25 22:15:16', '2025-08-25 22:22:09', NULL),
(31, NULL, 1, 3, '0', 1, '99a46996-a608-4447-91b2-454989815bb9', 'Test-Blank', 'Test-Blank', 'test-blank', NULL, NULL, NULL, 1, '2025-08-26 17:18:15', '2025-08-26 17:18:15', NULL),
(32, NULL, 1, 3, '0', 1, '04986a53-b2e4-4e1e-9c17-451108d98ed3', 'SUB-1', 'SUB-1', 'sub-1', NULL, NULL, NULL, 1, '2025-08-26 19:08:12', '2025-08-26 19:08:12', NULL),
(33, NULL, 1, 19, '1', 1, '31efa598-98c3-4efc-ac75-a993cd1b446e', 'Feedback', 'Feedback', 'feedback', NULL, NULL, NULL, 1, '2025-08-26 17:27:37', '2025-08-26 17:27:37', NULL),
(34, NULL, 1, 22, '0', 1, 'e945d5a7-a2fc-4c86-b262-445abcfbcd3c', 'Aipr', 'Aipr', 'aipr', NULL, NULL, NULL, 1, '2025-09-02 19:48:23', '2025-09-02 19:48:23', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2016_06_01_000001_create_oauth_auth_codes_table', 1),
(4, '2016_06_01_000002_create_oauth_access_tokens_table', 1),
(5, '2016_06_01_000003_create_oauth_refresh_tokens_table', 1),
(6, '2016_06_01_000004_create_oauth_clients_table', 1),
(7, '2016_06_01_000005_create_oauth_personal_access_clients_table', 1),
(8, '2019_08_19_000000_create_failed_jobs_table', 1),
(9, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(10, '2024_02_29_131924_create_banners_table', 1),
(11, '2024_03_05_064720_create_features_table', 1),
(12, '2024_03_05_085543_create_news_table', 1),
(13, '2024_03_05_141914_create_categories_table', 1),
(14, '2024_03_18_090659_create_blogs_table', 1),
(15, '2024_03_21_113017_create_roles_table', 1),
(16, '2024_03_21_114325_create_permissions_table', 1),
(17, '2024_03_21_114355_create_users_roles_table', 1),
(18, '2024_03_21_114358_create_roles_permissions_table', 1),
(19, '2024_03_21_114425_create_users_permissions_table', 1),
(20, '2024_12_03_063548_create_notifications_table', 1),
(21, '2024_12_06_094920_create_push_notification_queues_table', 1),
(22, '2025_01_24_165317_create_units_table', 1),
(23, '2025_06_18_064813_create_settings_table', 1),
(24, '2025_07_03_051332_add_varification_otp_time_to_users_table', 1),
(25, '2025_07_04_013033_create_sessions_table', 1),
(26, '2025_07_04_015115_create_activity_log_table', 1),
(27, '2025_07_04_015116_add_event_column_to_activity_log_table', 1),
(28, '2025_07_04_015117_add_batch_uuid_column_to_activity_log_table', 1),
(29, '2025_07_06_140121_create_testimonials_table', 1),
(30, '2025_07_06_195352_add_varification_attempted_to_users_table', 1),
(31, '2025_07_06_222115_add_fields_to_users_table', 1),
(32, '2025_07_09_233538_create_menus_table', 1),
(33, '2025_07_10_214717_create_designations_table', 1),
(34, '2025_07_11_102953_create_user_password_lists_table', 1),
(35, '2025_07_11_115259_create_user_posts_table', 1),
(36, '2025_07_11_122458_create_teams_table', 1),
(37, '2025_07_11_170046_create_sections_table', 1),
(38, '2025_07_11_171611_create_documents_table', 1),
(39, '2025_07_14_140645_create_important_links_table', 1),
(40, '2025_07_14_142241_create_advertises_table', 1),
(41, '2025_07_21_100959_create_cms_table', 1),
(42, '2025_07_22_005049_add_field_to_cms_table', 1),
(43, '2025_07_26_092727_add_unit_id_to_menus_table', 1),
(44, '2025_07_26_154941_add_unit_id_to_banner_table', 1),
(45, '2025_07_26_230606_create_states_table', 1),
(46, '2025_07_26_231507_add_fiels_to_units_table', 1),
(47, '2025_07_27_063652_add_designation_users_table', 1),
(48, '2025_07_27_064322_add_field_roles_table', 1),
(49, '2025_07_27_151542_add_field_menus_table', 1),
(50, '2025_07_27_161226_add_filed_to_sections_table', 1),
(51, '2025_07_27_173641_add_filed_to_cms_table', 1),
(52, '2025_07_30_114449_add_fields_to_settings_table', 1),
(53, '2025_07_30_122039_add_fields_to_cms_table', 1),
(54, '2025_07_31_111823_add_field_to_menus_table', 1),
(55, '2025_08_03_020953_add_unit_id_to_users_table', 2),
(56, '2025_08_03_021555_add_unit_admin_id_to_units_table', 3),
(57, '2025_08_03_023227_add_fields_to_cms_table', 4),
(58, '2025_08_07_234504_create_hods_table', 5),
(59, '2025_08_08_005255_add_field_to_cms_table', 5),
(60, '2025_08_20_160943_add_fields_to_settings_table', 6),
(61, '2025_08_20_163852_add_fields_to_roles_table', 7),
(62, '2025_08_20_172535_add_fields_to_units_table', 8),
(63, '2025_08_20_193757_add_fields_to_menus_table', 9),
(64, '2025_08_20_193813_add_fields_to_hods_table', 9),
(65, '2025_08_20_193954_add_fields_to_sections_table', 9),
(67, '2025_08_21_230154_create_media_table', 11),
(68, '2025_08_22_233836_create_media_images_table', 11),
(69, '2025_08_20_194500_create_aiprs_table', 12),
(70, '2025_08_24_231349_add_banner_to_banner_table', 13),
(71, '2025_08_24_231409_add_filed_to_cms_table', 13),
(73, '2025_08_26_233408_create_feedback_table', 14),
(75, '2025_09_02_235430_create_aipr_masters_table', 15),
(76, '2025_09_01_131011_add_cms_to_cms_table', 16),
(77, '2025_09_01_131131_add_teams_to_teams_table', 16),
(78, '2025_09_01_131218_add_position_to_documents_table', 16),
(79, '2025_09_03_020056_add_position_to_menus_table', 16),
(80, '2025_09_03_234451_add_fields_to_cms_table', 17);

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `description` longtext DEFAULT NULL,
  `file` varchar(255) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `is_active` tinyint(4) DEFAULT 1 COMMENT '0:Inactive,1:Active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `type` varchar(100) DEFAULT NULL,
  `for` tinyint(4) DEFAULT 1 COMMENT '1:Super Admin,2:User',
  `is_read` tinyint(4) DEFAULT 0 COMMENT '0:Unread,1:Read',
  `is_active` tinyint(4) DEFAULT 1 COMMENT '0:Inactive,1:Active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `uuid`, `user_id`, `title`, `description`, `type`, `for`, `is_read`, `is_active`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '4d4b2cea-28a3-4396-b811-a49ea91db0da', 5, 'Advertisement for Walk-in Interview for hiring of HMP( MBBS doctor) at 09:30 AM on 01-09-2025 at OFH-Katni', NULL, NULL, 1, 0, 1, '2025-08-25 05:44:43', '2025-08-25 05:44:43', NULL),
(2, 'a7ee5773-09de-42de-97f8-cdd492e15d4e', 6, 'Advertisement for Walk-in Interview for hiring of HMP( MBBS doctor) at 09:30 AM on 01-09-2025 at OFH-Katni', NULL, NULL, 1, 0, 1, '2025-08-25 05:44:43', '2025-08-25 05:44:43', NULL),
(3, '6e9b7e58-369f-4368-a724-15aa69f7c8cf', 6, 'Advertisement for Walk-in Interview for hiring of HMP( MBBS doctor) at 09:30 AM on 01-09-2025 at OFH-Katni', NULL, NULL, 1, 0, 1, '2025-08-25 05:44:43', '2025-08-25 05:44:43', NULL),
(4, '0fbbf1b7-1047-445e-8c13-97fb8fc9b254', 6, 'Advertisement for Walk-in Interview for hiring of HMP( MBBS doctor) at 09:30 AM on 01-09-2025 at OFH-Katni', NULL, NULL, 1, 0, 1, '2025-08-25 05:44:43', '2025-08-25 05:44:43', NULL),
(5, '910d7996-6b8f-425c-b7a5-905d264cf759', 5, 'In pursuance of the decision of the Union Cabinet, with effect from 1st October, 2021', NULL, NULL, 1, 0, 1, '2025-08-25 05:49:39', '2025-08-25 05:49:39', NULL),
(6, 'fdc8e052-6e7a-41f8-bf87-a0902b00c536', 6, 'In pursuance of the decision of the Union Cabinet, with effect from 1st October, 2021', NULL, NULL, 1, 0, 1, '2025-08-25 05:49:39', '2025-08-25 05:49:39', NULL),
(7, '00c2157c-a5e6-4470-bd19-1fe6d522cb1c', 6, 'In pursuance of the decision of the Union Cabinet, with effect from 1st October, 2021', NULL, NULL, 1, 0, 1, '2025-08-25 05:49:39', '2025-08-25 05:49:39', NULL),
(8, 'db1b0065-082e-4748-9c55-cc0fde32a72c', 6, 'In pursuance of the decision of the Union Cabinet, with effect from 1st October, 2021', NULL, NULL, 1, 0, 1, '2025-08-25 05:49:39', '2025-08-25 05:49:39', NULL),
(9, 'd5bcd03a-31ff-455c-87d7-1ed93e893d0b', 5, 'List of provisionally selected candidates for engagement of professionals', NULL, NULL, 1, 0, 1, '2025-08-25 05:51:09', '2025-08-25 05:51:09', NULL),
(10, '0f099823-c982-4250-8bc9-b1ea944394b3', 6, 'List of provisionally selected candidates for engagement of professionals', NULL, NULL, 1, 0, 1, '2025-08-25 05:51:09', '2025-08-25 05:51:09', NULL),
(11, '54cae38a-b89f-435c-a429-b2ee74f29605', 6, 'List of provisionally selected candidates for engagement of professionals', NULL, NULL, 1, 0, 1, '2025-08-25 05:51:09', '2025-08-25 05:51:09', NULL),
(12, 'f0b50f68-b9e0-44ca-80a3-f322df401ba3', 6, 'List of provisionally selected candidates for engagement of professionals', NULL, NULL, 1, 0, 1, '2025-08-25 05:51:09', '2025-08-25 05:51:09', NULL),
(13, '0a24e3dc-992f-4321-916f-597d4e0e818b', 13, 'Test Content', NULL, NULL, 1, 0, 1, '2025-08-25 21:12:15', '2025-08-25 21:12:15', NULL),
(14, 'ca26287a-d071-46b4-9c77-c540e2918f10', 6, 'Test Content', NULL, NULL, 1, 0, 1, '2025-08-25 21:12:15', '2025-08-25 21:12:15', NULL),
(15, 'eb3400e3-08f3-4239-99f7-65b865a41522', 6, 'Test Content', NULL, NULL, 1, 0, 1, '2025-08-25 21:12:15', '2025-08-25 21:12:15', NULL),
(16, '3dbd1fab-28bb-4512-9e5d-3d99a914e37c', 6, 'Test Content', NULL, NULL, 1, 0, 1, '2025-08-25 21:12:15', '2025-08-25 21:12:15', NULL),
(17, '3fb4840e-efe4-4351-ad51-38717c850b95', 5, 'About Ministry', NULL, NULL, 1, 0, 1, '2025-08-26 05:30:19', '2025-08-26 05:30:19', NULL),
(18, '563b52f6-bdb2-4137-8f30-93aa0b64fcb9', 6, 'About Ministry', NULL, NULL, 1, 0, 1, '2025-08-26 05:30:19', '2025-08-26 05:30:19', NULL),
(19, 'cdea08cb-1ce9-4048-a208-678777128d9c', 6, 'About Ministry', NULL, NULL, 1, 0, 1, '2025-08-26 05:30:19', '2025-08-26 05:30:19', NULL),
(20, '382afb7e-1fe9-4b41-86af-5dfc39a4fc58', 6, 'About Ministry', NULL, NULL, 1, 0, 1, '2025-08-26 05:30:19', '2025-08-26 05:30:19', NULL),
(21, '1f57f1a3-7d17-4a20-8a9f-e3b9f1db2ddb', 14, 'Test Content', NULL, NULL, 1, 0, 1, '2025-08-26 17:25:20', '2025-08-26 17:25:20', NULL),
(22, '7a2e0e00-c7c9-4c36-b764-e3bbbad20f3e', 6, 'Test Content', NULL, NULL, 1, 0, 1, '2025-08-26 17:25:20', '2025-08-26 17:25:20', NULL),
(23, '4b41f71c-a6bd-450b-a599-b26f66ecf886', 6, 'Test Content', NULL, NULL, 1, 0, 1, '2025-08-26 17:25:20', '2025-08-26 17:25:20', NULL),
(24, 'f968b1ec-6600-482f-b2b0-5ff8d387bad3', 6, 'Test Content', NULL, NULL, 1, 0, 1, '2025-08-26 17:25:20', '2025-08-26 17:25:20', NULL),
(25, '1e46801a-9ccc-430b-8907-6495228a5c13', 14, 'Test Content', NULL, NULL, 1, 0, 1, '2025-08-26 17:27:19', '2025-08-26 17:27:19', NULL),
(26, '0097eb6e-3ea1-4d98-b7a3-88599e9a8869', 6, 'Test Content', NULL, NULL, 1, 0, 1, '2025-08-26 17:27:19', '2025-08-26 17:27:19', NULL),
(27, '79a9664d-c287-40e9-81a7-1edd6fbc8231', 6, 'Test Content', NULL, NULL, 1, 0, 1, '2025-08-26 17:27:19', '2025-08-26 17:27:19', NULL),
(28, '3283c1df-5326-4b40-8bfc-4e654b406697', 6, 'Test Content', NULL, NULL, 1, 0, 1, '2025-08-26 17:27:19', '2025-08-26 17:27:19', NULL),
(29, '12f13b22-adec-4c48-802e-7b2eaa02781e', 14, 'Test Content', NULL, NULL, 1, 0, 1, '2025-08-26 19:02:34', '2025-08-26 19:02:34', NULL),
(30, '54562292-fced-4756-9b5b-58dec7927ccb', 6, 'Test Content', NULL, NULL, 1, 0, 1, '2025-08-26 19:02:34', '2025-08-26 19:02:34', NULL),
(31, '8855fb54-5c1e-4810-84e2-eee4e7167e7c', 5, NULL, NULL, NULL, 1, 0, 1, '2025-09-07 10:40:05', '2025-09-07 10:40:05', NULL),
(32, '9b757f03-4c8d-4467-943e-9efaf0252a7a', 6, NULL, NULL, NULL, 1, 0, 1, '2025-09-07 10:40:05', '2025-09-07 10:40:05', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `oauth_access_tokens`
--

CREATE TABLE `oauth_access_tokens` (
  `id` varchar(100) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `scopes` text DEFAULT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_auth_codes`
--

CREATE TABLE `oauth_auth_codes` (
  `id` varchar(100) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `scopes` text DEFAULT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_clients`
--

CREATE TABLE `oauth_clients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `secret` varchar(100) DEFAULT NULL,
  `provider` varchar(255) DEFAULT NULL,
  `redirect` text NOT NULL,
  `personal_access_client` tinyint(1) NOT NULL,
  `password_client` tinyint(1) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_personal_access_clients`
--

CREATE TABLE `oauth_personal_access_clients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_refresh_tokens`
--

CREATE TABLE `oauth_refresh_tokens` (
  `id` varchar(100) NOT NULL,
  `access_token_id` varchar(100) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `group_by` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `uuid`, `name`, `slug`, `group_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'c19cf66f-b999-465c-a4f8-806ccfe67e98', 'All Unit', 'all-unit', 'Unit Permission', '2025-09-07 09:06:44', '2025-09-07 09:06:44', NULL),
(2, 'ffb79330-47f9-4570-add0-df555e88842d', 'Specific Unit', 'specific-unit', 'Unit Permission', '2025-09-07 09:06:44', '2025-09-07 09:06:44', NULL),
(3, 'be5123cc-0ed6-40f6-a368-d2f815b5541f', 'User List', 'user-list', 'User', '2025-09-07 09:06:44', '2025-09-07 09:06:44', NULL),
(4, 'df8f8c7e-4ab6-4241-840d-7079ea40d593', 'Add User', 'add-user', 'User', '2025-09-07 09:06:44', '2025-09-07 09:06:44', NULL),
(5, '5b0d0cc5-bb22-47da-8c8c-c742335b66f3', 'Edit User', 'edit-user', 'User', '2025-09-07 09:06:44', '2025-09-07 09:06:44', NULL),
(6, 'c5a183fa-ae9b-4233-9e25-bad6cb585951', 'Delete User', 'delete-user', 'User', '2025-09-07 09:06:44', '2025-09-07 09:06:44', NULL),
(7, '3b012e1d-aef1-46d0-a2e4-a07c3982c0ca', 'User Status Change', 'user-status-change', 'User', '2025-09-07 09:06:44', '2025-09-07 09:06:44', NULL),
(8, '4f66f527-172d-491d-add6-f2e2c330803a', 'Banner List', 'banner-list', 'Banner', '2025-09-07 09:06:44', '2025-09-07 09:06:44', NULL),
(9, 'd66e238e-d5f5-4270-bdb0-042fee39c570', 'Add Banner', 'add-banner', 'Banner', '2025-09-07 09:06:44', '2025-09-07 09:06:44', NULL),
(10, '31118bfa-dac2-4ddd-a685-6e9c91ab408e', 'Edit Banner', 'edit-banner', 'Banner', '2025-09-07 09:06:44', '2025-09-07 09:06:44', NULL),
(11, '56229a46-b985-4894-a5e9-370488343463', 'Delete Banner', 'delete-banner', 'Banner', '2025-09-07 09:06:44', '2025-09-07 09:06:44', NULL),
(12, '00223fc0-7b71-4dee-b645-0cc2e9ced6a1', 'Banner Status Change', 'banner-status-change', 'Banner', '2025-09-07 09:06:44', '2025-09-07 09:06:44', NULL),
(13, '1f67313e-e7f1-4c21-8527-f9ec37bd5d6a', 'All Contant', 'all-contant', 'Contant', '2025-09-07 09:06:44', '2025-09-07 09:06:44', NULL),
(14, '71b0e46e-a8db-4b1f-858d-2124c051f09f', 'My Contant', 'my-contant', 'Contant', '2025-09-07 09:06:44', '2025-09-07 09:06:44', NULL),
(15, 'b75338e5-e85c-4c17-afca-c95abaac3396', 'Edit Contant', 'edit-contant', 'Contant', '2025-09-07 09:06:44', '2025-09-07 09:06:44', NULL),
(16, '99e0a9e9-5185-4310-84ce-52efaabe3a9f', 'View Contant', 'view-contant', 'Contant', '2025-09-07 09:06:44', '2025-09-07 09:06:44', NULL),
(17, 'a5047abc-7f0f-4d6f-aa52-2045e86390c5', 'Delete Contant', 'delete-contant', 'Contant', '2025-09-07 09:06:44', '2025-09-07 09:06:44', NULL),
(18, '255a4030-68ba-4a1c-bdc3-70429c3342cf', 'Contant Status Change', 'contant-status-change', 'Contant', '2025-09-07 09:06:44', '2025-09-07 09:06:44', NULL),
(19, '723016bb-b3ad-466f-8c13-369d09666421', 'Contant Approve Review', 'contant-approve-review', 'Contant', '2025-09-07 09:06:44', '2025-09-07 09:06:44', NULL),
(20, '22267549-b50c-4c76-a31f-a34cc47cc536', 'Archived Contant', 'archived-contant', 'Contant', '2025-09-07 09:06:44', '2025-09-07 09:06:44', NULL),
(21, '44408a52-6ba7-43d1-94b5-37b935788dcf', 'Active Contant', 'active-contant', 'Contant', '2025-09-07 09:06:44', '2025-09-07 09:06:44', NULL),
(22, '3a75306d-8d57-44fd-ab73-8828fddf0f6e', 'Add Edit All Contant Details', 'add-edit-all-contant-details', 'Contant', '2025-09-07 09:06:44', '2025-09-07 09:06:44', NULL),
(23, '6f9f5e16-f70b-461d-baf1-0b71b5b0cc06', 'Add Edit Hindi Contant Details', 'add-edit-hindi-contant-details', 'Contant', '2025-09-07 09:06:44', '2025-09-07 09:06:44', NULL),
(24, '7aabd7ad-79e3-4eeb-a9df-89447c15bce7', 'Add Edit English Contant Details', 'add-edit-english-contant-details', 'Contant', '2025-09-07 09:06:44', '2025-09-07 09:06:44', NULL),
(25, 'e53c7fdd-1f04-40ce-85f4-67c8f658b3d5', 'Designation List', 'designation-list', 'Designation', '2025-09-07 09:06:44', '2025-09-07 09:06:44', NULL),
(26, 'bc70f7c9-fb74-4501-a803-c7bbd7fd163c', 'Add Designation', 'add-designation', 'Designation', '2025-09-07 09:06:44', '2025-09-07 09:06:44', NULL),
(27, 'c61a7521-103b-4934-9d08-7e6d74cb6763', 'Edit Designation', 'edit-designation', 'Designation', '2025-09-07 09:06:44', '2025-09-07 09:06:44', NULL),
(28, 'ab6e38a1-1f76-4705-bd80-266f579d3f11', 'Delete Designation', 'delete-designation', 'Designation', '2025-09-07 09:06:44', '2025-09-07 09:06:44', NULL),
(29, 'dbfda263-2515-40e6-b1c1-7cfabff008d0', 'Designation Status Change', 'designation-status-change', 'Designation', '2025-09-07 09:06:44', '2025-09-07 09:06:44', NULL),
(30, '26333bad-36f7-405c-be98-f70cd82c4deb', 'Unit List', 'unit-list', 'Unit', '2025-09-07 09:06:44', '2025-09-07 09:06:44', NULL),
(31, '318d4950-6d7a-4932-ac53-d0cdde654221', 'Add Unit', 'add-unit', 'Unit', '2025-09-07 09:06:44', '2025-09-07 09:06:44', NULL),
(32, '4e7a4da4-99b1-4c65-a890-8ce03eb2fd06', 'Edit Unit', 'edit-unit', 'Unit', '2025-09-07 09:06:44', '2025-09-07 09:06:44', NULL),
(33, 'af9ef0f4-f95b-4d28-b5a8-6553e8c3603e', 'Delete Unit', 'delete-unit', 'Unit', '2025-09-07 09:06:44', '2025-09-07 09:06:44', NULL),
(34, '1ab78ce6-0f89-42df-b9b5-43813b5fe34f', 'Unit Status Change', 'unit-status-change', 'Unit', '2025-09-07 09:06:44', '2025-09-07 09:06:44', NULL),
(35, '81184e58-5aab-41a2-bc82-41133d8372a4', 'Menu List', 'menu-list', 'Menu', '2025-09-07 09:06:44', '2025-09-07 09:06:44', NULL),
(36, 'f8abfb88-92b0-4711-95a6-beb63bd5ff15', 'Add Menu', 'add-menu', 'Menu', '2025-09-07 09:06:44', '2025-09-07 09:06:44', NULL),
(37, '7f1e8f33-ff84-4bc2-b4c4-beb888be31aa', 'Edit Menu', 'edit-menu', 'Menu', '2025-09-07 09:06:44', '2025-09-07 09:06:44', NULL),
(38, '1703767d-2e99-4e9b-af1c-54bb8fef21d2', 'Delete Menu', 'delete-menu', 'Menu', '2025-09-07 09:06:44', '2025-09-07 09:06:44', NULL),
(39, '99e0b152-a4a7-451e-8166-5147edcb7808', 'Menu Status Change', 'menu-status-change', 'Menu', '2025-09-07 09:06:44', '2025-09-07 09:06:44', NULL),
(40, 'e91b5150-f89d-478e-ae42-9eba76ab0ce0', 'Category List', 'category-list', 'Category', '2025-09-07 09:06:44', '2025-09-07 09:06:44', NULL),
(41, 'c7dc7ac5-8398-42bc-8dea-edbb70acf6a4', 'Add Category', 'add-category', 'Category', '2025-09-07 09:06:44', '2025-09-07 09:06:44', NULL),
(42, 'e0faeb9b-f9b9-4820-9d84-507f99f2a87a', 'Edit Category', 'edit-category', 'Category', '2025-09-07 09:06:44', '2025-09-07 09:06:44', NULL),
(43, '02c29f81-3f9c-40cf-a8a2-68c79a6f5ab5', 'Delete Category', 'delete-category', 'Category', '2025-09-07 09:06:44', '2025-09-07 09:06:44', NULL),
(44, 'a66b7633-bd3a-4dda-b975-17af1790777f', 'Category Status Change', 'category-status-change', 'Category', '2025-09-07 09:06:44', '2025-09-07 09:06:44', NULL),
(45, 'c78408f3-3655-47b0-af93-57c0e8e07aa6', 'Hod List', 'hod-list', 'Hod', '2025-09-07 09:06:44', '2025-09-07 09:06:44', NULL),
(46, 'e5006689-fcbc-4df1-ba82-a468bd223fd8', 'Add Hod', 'add-hod', 'Hod', '2025-09-07 09:06:44', '2025-09-07 09:06:44', NULL),
(47, 'd93fc3ea-f991-4647-952e-22c0c701baee', 'Edit Hod', 'edit-hod', 'Hod', '2025-09-07 09:06:44', '2025-09-07 09:06:44', NULL),
(48, '7bf58fc6-fea8-4e72-96a9-eba78c0bf7a2', 'Delete Hod', 'delete-hod', 'Hod', '2025-09-07 09:06:44', '2025-09-07 09:06:44', NULL),
(49, '3d3023ab-869a-4ac2-86ba-cb366594eafa', 'Hod Status Change', 'hod-status-change', 'Hod', '2025-09-07 09:06:44', '2025-09-07 09:06:44', NULL),
(50, '7ecc4c8c-cf14-4670-9ea7-12ac4dd48052', 'Section List', 'section-list', 'Section', '2025-09-07 09:06:44', '2025-09-07 09:06:44', NULL),
(51, '80012ed3-ab44-4405-9a47-c5c430d4fb11', 'Section Status Change', 'section-status-change', 'Section', '2025-09-07 09:06:44', '2025-09-07 09:06:44', NULL),
(52, '16b7cea2-19ce-451c-8d6f-13eb81ecc0ae', 'Archived Document', 'archived-document', 'Document', '2025-09-07 09:06:44', '2025-09-07 09:06:44', NULL),
(53, '8f5e1a6e-4ab8-4e02-82e1-21c536d46d07', 'Active Document', 'active-document', 'Document', '2025-09-07 09:06:44', '2025-09-07 09:06:44', NULL),
(54, '668d24cb-22e8-4880-9fa8-26f3b140e150', 'Document List', 'document-list', 'Document', '2025-09-07 09:06:44', '2025-09-07 09:06:44', NULL),
(55, '7bb51647-b6ec-4d7c-81b1-bb4ec9f90f92', 'Add Document', 'add-document', 'Document', '2025-09-07 09:06:44', '2025-09-07 09:06:44', NULL),
(56, '080e141a-2ff6-458c-a4d0-05b08464ddb1', 'Edit Document', 'edit-document', 'Document', '2025-09-07 09:06:44', '2025-09-07 09:06:44', NULL),
(57, 'ba7c0977-82a9-48da-a70e-c9523659b147', 'Delete Document', 'delete-document', 'Document', '2025-09-07 09:06:44', '2025-09-07 09:06:44', NULL),
(58, '661681a2-9be8-4173-b2e2-ed584b43949a', 'Document Status Change', 'document-status-change', 'Document', '2025-09-07 09:06:44', '2025-09-07 09:06:44', NULL),
(59, 'ae887d7d-bed6-4050-a0b6-1161bc92fd7e', 'Team List', 'team-list', 'Team', '2025-09-07 09:06:44', '2025-09-07 09:06:44', NULL),
(60, 'ea234011-c274-44cc-9188-93a76aece687', 'Add Team', 'add-team', 'Team', '2025-09-07 09:06:44', '2025-09-07 09:06:44', NULL),
(61, '3350e27e-dc52-454a-b3a4-d3028cddbe14', 'Edit Team', 'edit-team', 'Team', '2025-09-07 09:06:44', '2025-09-07 09:06:44', NULL),
(62, '8606ebd6-f7e9-4056-88d3-d83f8b80e527', 'Delete Team', 'delete-team', 'Team', '2025-09-07 09:06:44', '2025-09-07 09:06:44', NULL),
(63, '6bde8ca1-00fb-451b-ae92-9033ffb39da7', 'Team Status Change', 'team-status-change', 'Team', '2025-09-07 09:06:44', '2025-09-07 09:06:44', NULL),
(64, 'db1cac6d-cad8-4d3f-833d-ed53e5ebe1aa', 'Role List', 'role-list', 'Role', '2025-09-07 09:06:44', '2025-09-07 09:06:44', NULL),
(65, 'db752392-163f-4c47-9f7d-396431dbe88f', 'Add Role', 'add-role', 'Role', '2025-09-07 09:06:44', '2025-09-07 09:06:44', NULL),
(66, '2c7ed4bf-30f9-4c37-b6ce-9a27b781732f', 'Edit Role', 'edit-role', 'Role', '2025-09-07 09:06:44', '2025-09-07 09:06:44', NULL),
(67, 'a82df062-2830-4bfe-a124-7ee6c4b18254', 'Delete Role', 'delete-role', 'Role', '2025-09-07 09:06:44', '2025-09-07 09:06:44', NULL),
(68, 'eef4f307-d2b7-43c1-86d4-cd0169caf529', 'Give Permission', 'give-permission', 'Role', '2025-09-07 09:06:44', '2025-09-07 09:06:44', NULL),
(69, '83a9b93f-42e6-4260-84da-a5d2fcb953eb', 'Activity Log', 'activity-log', 'Activity Log', '2025-09-07 09:06:44', '2025-09-07 09:06:44', NULL),
(70, '73fae079-f81b-401c-b44f-240a875168d1', 'Website Setting List', 'website-setting-list', 'Website Setting', '2025-09-07 09:06:44', '2025-09-07 09:06:44', NULL),
(71, '6e830475-9ed1-459a-aa75-56fdb5fbb10a', 'Edit Website Setting', 'edit-website-setting', 'Website Setting', '2025-09-07 09:06:44', '2025-09-07 09:06:44', NULL),
(72, 'e7ca5adc-62dc-43c1-907f-956292bcb6c6', 'Notification List', 'notification-list', 'Notification', '2025-09-07 09:06:44', '2025-09-07 09:06:44', NULL),
(73, 'ec2c530e-fcc7-440f-8f41-d16065ee89ff', 'Delete Notification', 'delete-notification', 'Notification', '2025-09-07 09:06:44', '2025-09-07 09:06:44', NULL),
(74, '7bfb462a-c290-429d-bed0-cac0eb1ab6d7', 'Total User', 'total-user', 'Dashboard', '2025-09-07 09:06:44', '2025-09-07 09:06:44', NULL),
(75, 'af655a83-835b-4441-859d-f7d278cbbac6', 'Total Unit', 'total-unit', 'Dashboard', '2025-09-07 09:06:44', '2025-09-07 09:06:44', NULL),
(76, '711fce06-ccc8-4392-a2ca-2828d26cbcc3', 'Total Unit Admin', 'total-unit-admin', 'Dashboard', '2025-09-07 09:06:44', '2025-09-07 09:06:44', NULL),
(77, '5aaf5055-0504-4765-8d2f-aec988c988ce', 'Total Approver', 'total-approver', 'Dashboard', '2025-09-07 09:06:44', '2025-09-07 09:06:44', NULL),
(78, '0f3f0eef-f5b1-4c58-b171-f05bd9ecfd64', 'Total Reviewer', 'total-reviewer', 'Dashboard', '2025-09-07 09:06:44', '2025-09-07 09:06:44', NULL),
(79, 'a566f400-129f-409b-bb00-e71e1193750f', 'Aipr List', 'aipr-list', 'Aipr', '2025-09-07 09:06:44', '2025-09-07 09:06:44', NULL),
(80, '29351c8f-43cf-475d-b62a-a6b137add224', 'Upload Aipr', 'upload-aipr', 'Aipr', '2025-09-07 09:06:44', '2025-09-07 09:06:44', NULL),
(81, '190c4dbc-e967-4d48-9b35-433a1b55c04b', 'Delete Aipr', 'delete-aipr', 'Aipr', '2025-09-07 09:06:44', '2025-09-07 09:06:44', NULL),
(82, 'ec182ff9-11e4-4d97-9a37-cf0dddf4cdab', 'Aipr Status Change', 'aipr-status-change', 'Aipr', '2025-09-07 09:06:44', '2025-09-07 09:06:44', NULL),
(83, 'ca7fd821-852b-41e2-a5e4-2616dff73825', 'Media List', 'media-list', 'Media', '2025-09-07 09:06:44', '2025-09-07 09:06:44', NULL),
(84, '7ec27d5a-0cad-4ade-8ac7-a50ca42bf485', 'Add Media', 'add-media', 'Media', '2025-09-07 09:06:44', '2025-09-07 09:06:44', NULL),
(85, 'cd46b98a-613c-40b9-bab0-a3f8744558b4', 'Edit Media', 'edit-media', 'Media', '2025-09-07 09:06:44', '2025-09-07 09:06:44', NULL),
(86, '675bfd61-d114-4ef6-8f35-0243bebd5dc2', 'Delete Media', 'delete-media', 'Media', '2025-09-07 09:06:44', '2025-09-07 09:06:44', NULL),
(87, '1215120b-a415-4007-ad9f-c91ddae3ae0f', 'Media Status Change', 'media-status-change', 'Media', '2025-09-07 09:06:44', '2025-09-07 09:06:44', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `push_notification_queues`
--

CREATE TABLE `push_notification_queues` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `fcm_token` text DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `body` longtext DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `uuid` char(36) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `is_active` tinyint(4) DEFAULT 0 COMMENT '0:Inactive,1:Active',
  `is_editable` varchar(255) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `updated_by`, `created_by`, `uuid`, `name`, `slug`, `is_active`, `is_editable`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, NULL, NULL, '78780809-5da0-431a-8fae-33d54138b9d3', 'Super Admin', 'super-admin', 1, '1', '2025-08-02 18:10:46', '2025-09-07 10:58:04', NULL),
(2, NULL, NULL, 'b0bdc465-26ce-47b1-a424-35df0d1a297a', 'Sub Admin', 'sub-admin', 0, '1', '2025-08-02 18:10:46', '2025-08-20 11:04:20', '2025-08-20 11:04:20'),
(3, NULL, NULL, '0b49bb5f-b2d5-4c51-a8c7-7d25d78064ca', 'En Content Writter', 'en-content-writter', 1, '1', '2025-08-02 18:10:46', '2025-08-17 06:59:30', NULL),
(4, NULL, NULL, '3a2eef17-53eb-4413-9620-8255175234a1', 'Content Approver', 'content-approver', 1, '1', '2025-08-02 18:10:46', '2025-08-20 11:05:24', NULL),
(5, NULL, NULL, '9f40efa9-5e8d-4d68-be05-61ddc0afdb74', 'Content Reviewer', 'content-reviewer', 0, '1', '2025-08-02 18:10:46', '2025-08-02 18:10:46', NULL),
(6, NULL, NULL, '8dde1812-9fae-4042-8126-fb875172a3c3', 'unit wise admin user', 'unit-wise-admin-user', 1, '1', '2025-08-02 20:04:17', '2025-08-11 06:51:56', NULL),
(7, NULL, NULL, '0b49bb5f-b2d5-4c51-a8c7-7d25d78064cv', 'Hi Content Writter', 'hi-content-writter', 0, '1', '2025-08-02 18:10:46', '2025-08-03 13:49:15', NULL),
(8, NULL, NULL, 'd9846122-7bc9-42c7-a4e3-9ccfca3e2b03', 'fdsfdsf11', 'fdsfdsf11', 0, '1', '2025-08-20 10:59:45', '2025-08-20 11:02:36', '2025-08-20 11:02:36');

-- --------------------------------------------------------

--
-- Table structure for table `roles_permissions`
--

CREATE TABLE `roles_permissions` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `permission_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `roles_permissions`
--

INSERT INTO `roles_permissions` (`role_id`, `permission_id`) VALUES
(1, 1),
(1, 3),
(1, 4),
(1, 5),
(1, 6),
(1, 7),
(1, 8),
(1, 9),
(1, 10),
(1, 11),
(1, 12),
(1, 13),
(1, 14),
(1, 15),
(1, 16),
(1, 17),
(1, 18),
(1, 19),
(1, 20),
(1, 21),
(1, 22),
(1, 23),
(1, 24),
(1, 25),
(1, 26),
(1, 27),
(1, 28),
(1, 29),
(1, 30),
(1, 31),
(1, 32),
(1, 33),
(1, 34),
(1, 35),
(1, 36),
(1, 37),
(1, 38),
(1, 39),
(1, 40),
(1, 41),
(1, 42),
(1, 43),
(1, 44),
(1, 45),
(1, 46),
(1, 47),
(1, 48),
(1, 49),
(1, 50),
(1, 51),
(1, 52),
(1, 53),
(1, 54),
(1, 55),
(1, 56),
(1, 57),
(1, 58),
(1, 59),
(1, 60),
(1, 61),
(1, 62),
(1, 63),
(1, 64),
(1, 65),
(1, 66),
(1, 67),
(1, 68),
(1, 69),
(1, 70),
(1, 71),
(1, 72),
(1, 73),
(1, 74),
(1, 75),
(1, 76),
(1, 77),
(1, 78),
(1, 79),
(1, 80),
(1, 81),
(1, 82),
(1, 83),
(1, 84),
(1, 85),
(1, 86),
(1, 87);

-- --------------------------------------------------------

--
-- Table structure for table `sections`
--

CREATE TABLE `sections` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `uuid` char(36) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `menu_id` bigint(20) UNSIGNED NOT NULL,
  `unit_id` bigint(20) UNSIGNED DEFAULT NULL,
  `is_active` tinyint(4) DEFAULT 1 COMMENT '0:Inactive,1:Active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sections`
--

INSERT INTO `sections` (`id`, `updated_by`, `created_by`, `uuid`, `title`, `slug`, `menu_id`, `unit_id`, `is_active`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, NULL, NULL, 'ba81affb-96f1-4bb3-84c3-e1b3972b43a9', 'banner', 'banner', 1, 1, 1, '2025-08-25 04:45:19', '2025-08-25 04:45:19', NULL),
(2, NULL, NULL, '56c1bc67-fd95-49ed-814f-bddbe67bf185', 'announcements', 'announcements', 1, 1, 1, '2025-08-25 04:45:19', '2025-08-25 04:45:19', NULL),
(3, NULL, NULL, '58b4cb39-0ae1-4317-800b-d718613306bf', 'pm-modi-at-mann-ki-baat', 'pm-modi-at-mann-ki-baat', 1, 1, 1, '2025-08-25 04:45:19', '2025-08-25 04:45:19', NULL),
(4, NULL, NULL, '456357a2-2b2b-407b-9859-c02347d254ac', 'about-ministry', 'about-ministry', 1, 1, 1, '2025-08-25 04:45:19', '2025-08-25 04:45:19', NULL),
(5, NULL, NULL, '99707874-f4bb-42fa-9f4f-94371f09bb73', 'hod-section', 'hod-section', 1, 1, 1, '2025-08-25 04:45:19', '2025-08-25 04:45:19', NULL),
(6, NULL, NULL, '0fffab45-1d8c-4c20-a740-6a4fc78fd57e', 'our-history', 'our-history', 1, 1, 1, '2025-08-25 04:45:19', '2025-08-25 04:45:19', NULL),
(7, NULL, NULL, '308309a2-201f-4d57-ac80-825ad744f0a7', 'our-unit', 'our-unit', 1, 1, 1, '2025-08-25 04:45:19', '2025-08-25 04:45:19', NULL),
(8, NULL, NULL, '292eb672-4b4a-4d93-aac9-b704a7fc36a8', 'join-us', 'join-us', 1, 1, 1, '2025-08-25 04:45:19', '2025-08-25 04:45:19', NULL),
(9, NULL, NULL, 'a363ce86-46bd-4c6b-b413-bcc8ea5872dd', 'schemes', 'schemes', 1, 1, 1, '2025-08-25 04:45:19', '2025-08-25 04:45:19', NULL),
(10, NULL, NULL, 'e40235a1-c9e2-4523-8258-d653c5031053', 'vacancies', 'vacancies', 1, 1, 1, '2025-08-25 04:45:19', '2025-08-25 04:45:19', NULL),
(11, NULL, NULL, '33b644a4-1891-428c-b796-b04cf6a61ea4', 'tenders', 'tenders', 1, 1, 1, '2025-08-25 04:45:19', '2025-08-25 04:45:19', NULL),
(12, NULL, NULL, 'f8b6e817-0252-4068-b39b-d1dc7022a2d9', 'whats-new', 'whats-new', 1, 1, 1, '2025-08-25 04:45:19', '2025-08-25 04:45:19', NULL),
(13, NULL, NULL, '1472fd45-fb3c-494a-a2b9-d7cf76d04ba9', 'recent-documents', 'recent-documents', 1, 1, 1, '2025-08-25 04:45:19', '2025-08-25 04:45:19', NULL),
(14, NULL, NULL, '6baa6058-3eda-44c6-a82e-ad0166bc8d55', 'explore-user-personas', 'explore-user-personas', 1, 1, 1, '2025-08-25 04:45:19', '2025-08-25 04:45:19', NULL),
(15, NULL, NULL, 'b3881615-d6a2-4721-9f9a-ec72e9ed566a', 'important-links', 'important-links', 1, 1, 1, '2025-08-25 04:45:19', '2025-08-25 04:45:19', NULL),
(16, NULL, NULL, '6a043f30-d85c-431c-b0ef-788f28092ee5', 'social-media', 'social-media', 1, 1, 1, '2025-08-25 04:45:19', '2025-08-25 04:45:19', NULL),
(17, NULL, NULL, 'e3e805c0-9fe4-4469-a316-671b7c5d0aaa', 'advertisement', 'advertisement', 1, 1, 1, '2025-08-25 04:45:19', '2025-08-25 04:45:19', NULL),
(18, NULL, NULL, 'e525abb1-dadc-4973-9c51-3d2836900ee0', 'testimonial', 'testimonial', 1, 1, 1, '2025-08-25 04:45:19', '2025-08-25 04:45:19', NULL),
(19, NULL, NULL, '8eff2e8a-62af-4358-83c0-65ade92e1cb8', 'the-beginning-growth-of-indian-ordnance-factories-main-event-description', 'the-beginning-growth-of-indian-ordnance-factories-main-event-description', 4, 1, 1, '2025-08-25 04:57:20', '2025-08-25 04:57:20', NULL),
(20, NULL, NULL, '1642a14d-6201-4c7e-a2ba-d3086f780e1d', 'main-events', 'main-events', 4, 1, 1, '2025-08-25 04:57:20', '2025-08-25 04:57:20', NULL),
(21, NULL, NULL, 'cd4020d6-67f9-4c2f-a5d4-4c09c6606f12', 'creation-of-7-dpsus-and-directorate-of-ordnance', 'creation-of-7-dpsus-and-directorate-of-ordnance', 4, 1, 1, '2025-08-25 04:57:20', '2025-08-25 04:57:20', NULL),
(22, NULL, NULL, '8cdee875-3668-4668-870e-e142efe6934d', 'our-team-in-header', 'our-team-in-header', 6, 1, 1, '2025-08-25 04:58:49', '2025-08-25 04:58:49', NULL),
(23, NULL, NULL, '83d7ee81-ace0-4a9c-b910-6ae272ad7bc9', 'our-team-in-listing', 'our-team-in-listing', 6, 1, 1, '2025-08-25 04:58:49', '2025-08-25 04:58:49', NULL),
(24, NULL, NULL, 'c575f7b5-af9a-4056-baa7-01c3d347597b', 'vision-statement', 'vision-statement', 13, 1, 1, '2025-08-25 05:06:47', '2025-08-25 05:06:47', NULL),
(25, NULL, NULL, '6090f694-21ed-4c87-8e89-216e46ed9f15', 'about-the-directorate-of-ordnance-and-mission', 'about-the-directorate-of-ordnance-and-mission', 13, 1, 1, '2025-08-25 05:06:47', '2025-08-25 05:06:47', NULL),
(26, NULL, NULL, 'd5f58e7a-669a-4925-ab89-f0c7288d6b04', 'objectives', 'objectives', 13, 1, 1, '2025-08-25 05:06:47', '2025-08-25 05:06:47', NULL),
(27, NULL, NULL, '5a0a89aa-39bd-421c-a4cb-a8b1c8db600e', 'functions-of-ddo', 'functions-of-ddo', 13, 1, 1, '2025-08-25 05:06:47', '2025-08-25 05:06:47', NULL),
(28, NULL, NULL, 'c9636ced-acfc-44a1-b56f-4d929776c6e9', 'our-team-in-header', 'our-team-in-header', 14, 1, 1, '2025-08-25 05:07:44', '2025-08-25 05:07:44', NULL),
(29, NULL, NULL, '15eb73bf-4378-419d-a830-3bd49949749f', 'our-team-in-listing', 'our-team-in-listing', 14, 1, 1, '2025-08-25 05:07:44', '2025-08-25 05:07:44', NULL),
(30, NULL, NULL, '61413662-1da5-4195-9bd1-73f39586ea79', 'our-team-in-header', 'our-team-in-header', 19, 1, 1, '2025-08-25 05:23:30', '2025-08-25 05:23:30', NULL),
(31, NULL, NULL, '3184542e-ff95-4015-a408-8010eb2149f9', 'our-team-in-listing', 'our-team-in-listing', 19, 1, 1, '2025-08-25 05:23:30', '2025-08-25 05:23:30', NULL),
(32, NULL, NULL, '8e66ffec-5ad5-4cf1-a80c-8f6356038a7c', 'right-to-information-act-2005', 'right-to-information-act-2005', 20, 1, 1, '2025-08-25 05:24:20', '2025-08-25 05:24:20', NULL),
(33, NULL, NULL, '7e4f4e32-22be-41cd-b481-a79b27e4d14f', 'rti-act', 'rti-act', 20, 1, 1, '2025-08-25 05:24:20', '2025-08-25 05:24:20', NULL),
(34, NULL, NULL, '450a0432-43d3-4f8c-9b0d-595fe4a6ba88', 'download-rti-act', 'download-rti-act', 20, 1, 1, '2025-08-25 05:24:20', '2025-08-25 05:24:20', NULL),
(35, NULL, NULL, 'ecaaf0ce-5383-413f-999d-51cb9b1923b9', 'for-filing-online-rti-application-or-appeal', 'for-filing-online-rti-application-or-appeal', 20, 1, 1, '2025-08-25 05:24:20', '2025-08-25 05:24:20', NULL),
(36, NULL, NULL, '4ecd6336-3b49-406a-9a5a-0ba6ed35ceac', 'vision-statement', 'vision-statement', 28, 1, 1, '2025-08-25 09:40:31', '2025-08-25 09:40:31', NULL),
(37, NULL, NULL, '09dabb3e-cf03-449c-a83b-80bc8620f94d', 'about-the-directorate-of-ordnance-and-mission', 'about-the-directorate-of-ordnance-and-mission', 28, 1, 1, '2025-08-25 09:40:31', '2025-08-25 09:40:31', NULL),
(38, NULL, NULL, '2eebf3dd-37cc-4fe3-a76f-93e314848ef6', 'objectives', 'objectives', 28, 1, 1, '2025-08-25 09:40:31', '2025-08-25 09:40:31', NULL),
(39, NULL, NULL, '9b09c808-4d47-4f6a-b9bd-45568323d83b', 'functions-of-ddo', 'functions-of-ddo', 28, 1, 1, '2025-08-25 09:40:31', '2025-08-25 09:40:31', NULL),
(40, NULL, NULL, '13a56ae7-4460-4dca-b7a9-7cd779226e27', 'vision-statement', 'vision-statement', 29, 1, 1, '2025-08-25 22:01:34', '2025-08-25 22:01:34', NULL),
(41, NULL, NULL, '6c9b4dff-ef18-422a-bb35-157389efd750', 'about-the-directorate-of-ordnance-and-mission', 'about-the-directorate-of-ordnance-and-mission', 29, 1, 1, '2025-08-25 22:01:34', '2025-08-25 22:01:34', NULL),
(42, NULL, NULL, '2ffd4c63-f56c-4e82-b081-1d8721dab0c7', 'objectives', 'objectives', 29, 1, 1, '2025-08-25 22:01:34', '2025-08-25 22:01:34', NULL),
(43, NULL, NULL, '3d82212a-8529-4063-86de-e5012b0e787b', 'functions-of-ddo', 'functions-of-ddo', 29, 1, 1, '2025-08-25 22:01:34', '2025-08-25 22:01:34', NULL),
(44, NULL, NULL, 'bbdb631c-8a31-4991-9c03-33988eee3317', 'the-beginning-growth-of-indian-ordnance-factories-main-event-description', 'the-beginning-growth-of-indian-ordnance-factories-main-event-description', 31, 1, 1, '2025-08-26 17:18:15', '2025-08-26 17:18:15', NULL),
(45, NULL, NULL, 'd75a49a8-47aa-4795-a70d-76b0c456cf2f', 'main-events', 'main-events', 31, 1, 1, '2025-08-26 17:18:15', '2025-08-26 17:18:15', NULL),
(46, NULL, NULL, 'c3c79d93-57bb-43d1-ae52-8a800bc0581a', 'creation-of-7-dpsus-and-directorate-of-ordnance', 'creation-of-7-dpsus-and-directorate-of-ordnance', 31, 1, 1, '2025-08-26 17:18:15', '2025-08-26 17:18:15', NULL),
(47, NULL, NULL, '7f23e374-becb-4945-af91-89f438ebbc3e', 'the-beginning-growth-of-indian-ordnance-factories-main-event-description', 'the-beginning-growth-of-indian-ordnance-factories-main-event-description', 32, 1, 1, '2025-08-26 19:08:12', '2025-08-26 19:08:12', NULL),
(48, NULL, NULL, '3cd9dd69-cfa7-489d-a341-553fc7bef1ee', 'main-events', 'main-events', 32, 1, 1, '2025-08-26 19:08:12', '2025-08-26 19:08:12', NULL),
(49, NULL, NULL, 'f428bc0e-9afd-41b8-8dc7-3c253c5bf1cb', 'creation-of-7-dpsus-and-directorate-of-ordnance', 'creation-of-7-dpsus-and-directorate-of-ordnance', 32, 1, 1, '2025-08-26 19:08:12', '2025-08-26 19:08:12', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('23Qkk36WVVhykpnTRYdV505RUH1b9QBCs7Hee85N', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'YTo2OntzOjY6Il90b2tlbiI7czo0MDoiV1h0eFZZTlpTTVgyMUxhNUpHc3VWVEF2UjRJNkdTWG1FVVdOZEJQayI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czozNzoiaHR0cDovLzEyNy4wLjAuMTo4MDAwL2FkbWluL3JvbGUvbGlzdCI7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjQ0OiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvYWRtaW4vc2V0dGluZy9hZGQvTWc9PSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7czoyMjoiUEhQREVCVUdCQVJfU1RBQ0tfREFUQSI7YTowOnt9fQ==', 1757267532);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `instagram` varchar(255) DEFAULT NULL,
  `facebook` varchar(255) DEFAULT NULL,
  `twitter` varchar(255) DEFAULT NULL,
  `linkedin` varchar(255) DEFAULT NULL,
  `youtube` varchar(255) DEFAULT NULL,
  `file1` varchar(255) DEFAULT NULL,
  `file2` varchar(255) DEFAULT NULL,
  `file3` varchar(255) DEFAULT NULL,
  `footer_file1` varchar(255) DEFAULT NULL,
  `footer_file2` varchar(255) DEFAULT NULL,
  `file4` varchar(255) DEFAULT NULL,
  `hod_designation` varchar(255) DEFAULT NULL,
  `hod_name` varchar(255) DEFAULT NULL,
  `desctiption_en` text DEFAULT NULL,
  `desctiption_hi` text DEFAULT NULL,
  `unit_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `location` longtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `updated_by`, `created_by`, `instagram`, `facebook`, `twitter`, `linkedin`, `youtube`, `file1`, `file2`, `file3`, `footer_file1`, `footer_file2`, `file4`, `hod_designation`, `hod_name`, `desctiption_en`, `desctiption_hi`, `unit_id`, `created_at`, `updated_at`, `location`) VALUES
(1, 1, NULL, 'http://127.0.0.1:8000/en/home', 'http://127.0.0.1:8000/en/home', 'http://127.0.0.1:8000/en/home', 'http://127.0.0.1:8000/en/home', 'http://127.0.0.1:8000/en/home', '688f94ca4b52a.jpg', '68768cb72572e.png', '68768cb726451.png', '68768cb727a45.png', '68768cb72898f.png', '688f94cb5ae98.jpg', 'Chief General Manager', 'Dr. J. P. Dash', '<p>This Website belongs to Directorate of Ordnance (Coordination &amp; Services), Government of India</p>', '<p>gsdgsdfgfsd</p>', 2, '2025-07-14 13:40:37', '2025-09-07 17:51:17', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3684.3181230593523!2d88.3390101753003!3d22.567202179495563!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3a02779f0bfcbc9b%3A0x22c74a348885196f!2sDIRECTORATE%20OF%20ORDNANCE%20(COORDINATION%20AND%20SERVICES)AYUDH%20BHAWAN%2C%20KOLKATA!5e0!3m2!1sen!2sin!4v1752268237935!5m2!1sen!2sin'),
(2, 1, NULL, 'http://127.0.0.1:8000/en/home', 'http://127.0.0.1:8000/en/home', 'http://127.0.0.1:8000/en/home', 'http://127.0.0.1:8000/en/home', 'http://127.0.0.1:8000/en/home', '68768cb60f63e.png', '68768cb72572e.png', '68768cb726451.png', '68768cb727a45.png', '68768cb72898f.png', '688e58fcb35bb.png', 'Director General Ordnance (C&S)', 'SANJEEV GUPTA', '<p>This Website belongs to Directorate of Ordnance (Coordination &amp; Services), Government of India</p>', '<p>vdcxvgfdgfdg</p>', 1, '2025-08-03 16:46:15', '2025-09-07 17:52:04', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3684.3181230593523!2d88.3390101753003!3d22.567202179495563!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3a02779f0bfcbc9b%3A0x22c74a348885196f!2sDIRECTORATE%20OF%20ORDNANCE%20(COORDINATION%20AND%20SERVICES)AYUDH%20BHAWAN%2C%20KOLKATA!5e0!3m2!1sen!2sin!4v1752268237935!5m2!1sen!2sin'),
(3, NULL, NULL, 'http://127.0.0.1:8000/en/home', 'http://127.0.0.1:8000/en/home', 'http://127.0.0.1:8000/en/home', 'http://127.0.0.1:8000/en/home', 'http://127.0.0.1:8000/en/home', '688f94ca4b52a.jpg', '68768cb72572e.png', '68768cb726451.png', '68768cb727a45.png', '68768cb72898f.png', '688f94cb5ae98.jpg', 'Chief General Manager', 'Dr. J. P. Dash', '<p>This Website belongs to Directorate of Ordnance (Coordination &amp; Services), Government of India</p>', '<p>This Website belongs to Directorate of Ordnance (Coordination &amp; Services), Government of India</p>', 3, '2025-08-11 17:35:34', '2025-08-11 17:35:34', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3684.3181230593523!2d88.3390101753003!3d22.567202179495563!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3a02779f0bfcbc9b%3A0x22c74a348885196f!2sDIRECTORATE%20OF%20ORDNANCE%20(COORDINATION%20AND%20SERVICES)AYUDH%20BHAWAN%2C%20KOLKATA!5e0!3m2!1sen!2sin!4v1752268237935!5m2!1sen!2sin');

-- --------------------------------------------------------

--
-- Table structure for table `states`
--

CREATE TABLE `states` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `teams`
--

CREATE TABLE `teams` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `mobile_no` varchar(255) DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `designation_others` varchar(255) DEFAULT NULL,
  `file` varchar(255) DEFAULT NULL,
  `show` varchar(255) DEFAULT NULL COMMENT '0:show in header,1:show in listing',
  `designation_id` bigint(20) UNSIGNED NOT NULL,
  `menu_id` bigint(20) UNSIGNED NOT NULL,
  `unit_id` bigint(20) UNSIGNED NOT NULL,
  `is_active` tinyint(4) DEFAULT 1 COMMENT '0:Inactive,1:Active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `position` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `teams`
--

INSERT INTO `teams` (`id`, `uuid`, `name`, `email`, `mobile_no`, `location`, `designation_others`, `file`, `show`, `designation_id`, `menu_id`, `unit_id`, `is_active`, `created_at`, `updated_at`, `deleted_at`, `position`) VALUES
(1, '8e8a3759-7702-4cb6-a31a-f3438828897f', 'SANJEEV GUPTA', 'sanjeevgupta@ord.gov.in', '033-22482730', 'Ayudh Bhawan 10-A, S. K. Bose Road Kolkata - 700001, India', NULL, NULL, '1', 1, 6, 1, 1, '2025-08-25 06:52:32', '2025-08-25 06:57:44', NULL, NULL),
(2, 'b9b782b7-4198-4847-a55c-dbf11bc583b9', 'SANJEEV GUPTA', 'sanjeevgupta@ord.gov.in', '033-22482730', 'Ayudh Bhawan 10-A, S. K. Bose Road Kolkata - 700001, India', NULL, NULL, '1', 2, 6, 1, 1, '2025-08-25 06:53:44', '2025-08-25 06:57:06', NULL, NULL),
(3, '63243fbd-b17f-451d-806f-7a716fc19f0d', 'RAKESH SINGH LAL', NULL, NULL, NULL, NULL, '68ab5b8f91544.png', '0', 2, 6, 1, 1, '2025-08-25 07:00:22', '2025-08-25 07:05:59', NULL, NULL),
(4, '7a99be86-7b50-4de9-a965-2df26badfd77', 'N K AGGARWAL', NULL, NULL, NULL, NULL, '68ab5b56d54bb.png', '0', 1, 6, 1, 1, '2025-08-25 07:04:04', '2025-08-25 07:05:02', NULL, NULL),
(5, 'af6633df-853c-4e1f-accb-10a777ec1f1c', 'Shri Pankaj Gupta', NULL, NULL, NULL, NULL, '68ab5c48667f1.png', '0', 1, 14, 1, 1, '2025-08-25 07:09:04', '2025-08-25 07:09:49', NULL, NULL),
(6, '8d85345c-737e-4b6b-a8d1-297d83e15d33', 'SANJEEV GUPTA', 'sanjeevgupta@ord.gov.in', '033-22482730', 'Ayudh Bhawan 10-A, S. K. Bose Road Kolkata - 700001, India', NULL, '68ab5ce59649e.png', '1', 1, 14, 1, 1, '2025-08-25 07:11:41', '2025-08-25 07:11:41', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `templetes`
--

CREATE TABLE `templetes` (
  `id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `file_name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `templetes`
--

INSERT INTO `templetes` (`id`, `title`, `file_name`) VALUES
(1, 'Home', 'home'),
(2, 'About Us', 'about-us'),
(3, 'Our History', 'our-history'),
(4, 'Our Team', 'our-team'),
(5, 'Our Organization', 'our-organization'),
(6, 'Whats New', 'whats-new'),
(7, 'Schemes and Services', 'schemes-and-services'),
(8, 'Vacancies', 'vacancies'),
(9, 'Tenders', 'tenders'),
(10, 'Contact Us', 'contact-us'),
(11, 'RTI', 'rti'),
(13, 'Image', 'image'),
(14, 'Video', 'video'),
(15, 'Retired IOFS Officers List', 'retired-iofs-officers-list'),
(16, 'IOFS Officers List', 'iofs-officers-list'),
(17, 'Report', 'report'),
(19, 'feedback', 'feedback'),
(21, 'Our Directory', 'our-directory'),
(22, 'Aipr', 'aipr');

-- --------------------------------------------------------

--
-- Table structure for table `templete_sections`
--

CREATE TABLE `templete_sections` (
  `id` int(11) NOT NULL,
  `templete_id` int(11) DEFAULT NULL,
  `tile_slug` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `templete_sections`
--

INSERT INTO `templete_sections` (`id`, `templete_id`, `tile_slug`) VALUES
(1, 1, 'banner'),
(2, 1, 'announcements'),
(3, 1, 'pm-modi-at-mann-ki-baat'),
(4, 1, 'about-ministry'),
(5, 1, 'hod-section'),
(6, 1, 'our-history'),
(7, 1, 'our-unit'),
(8, 1, 'join-us'),
(9, 1, 'schemes'),
(10, 1, 'vacancies'),
(11, 1, 'tenders'),
(12, 1, 'whats-new'),
(13, 1, 'recent-documents'),
(14, 1, 'explore-user-personas'),
(15, 1, 'important-links'),
(16, 1, 'social-media'),
(17, 1, 'advertisement'),
(18, 1, 'testimonial'),
(19, 2, 'vision-statement'),
(20, 2, 'about-the-directorate-of-ordnance-and-mission'),
(21, 2, 'objectives'),
(22, 2, 'functions-of-ddo'),
(23, 3, 'the-beginning-growth-of-indian-ordnance-factories-main-event-description'),
(24, 3, 'main-events'),
(25, 3, 'creation-of-7-dpsus-and-directorate-of-ordnance'),
(26, 4, 'our-team-in-header'),
(27, 4, 'our-team-in-listing'),
(28, 11, 'right-to-information-act-2005'),
(29, 11, 'rti-act'),
(30, 11, 'download-rti-act'),
(31, 11, 'for-filing-online-rti-application-or-appeal');

-- --------------------------------------------------------

--
-- Table structure for table `testimonials`
--

CREATE TABLE `testimonials` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) DEFAULT NULL,
  `title_en` varchar(255) DEFAULT NULL,
  `title_hi` varchar(255) DEFAULT NULL,
  `description_en` longtext DEFAULT NULL,
  `description_hi` longtext DEFAULT NULL,
  `file` varchar(255) DEFAULT NULL,
  `possition` varchar(255) DEFAULT NULL,
  `is_active` tinyint(4) DEFAULT 1 COMMENT '0:Inactive,1:Active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `units`
--

CREATE TABLE `units` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `state_id` bigint(20) UNSIGNED DEFAULT NULL,
  `uuid` char(36) DEFAULT NULL,
  `title_en` varchar(255) DEFAULT NULL,
  `title_hi` varchar(255) DEFAULT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `is_active` tinyint(4) DEFAULT 1 COMMENT '0:Inactive,1:Active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `short_code` varchar(255) DEFAULT NULL,
  `factory_code` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `units`
--

INSERT INTO `units` (`id`, `updated_by`, `created_by`, `state_id`, `uuid`, `title_en`, `title_hi`, `slug`, `is_active`, `created_at`, `updated_at`, `deleted_at`, `short_code`, `factory_code`) VALUES
(1, NULL, NULL, NULL, '5cd1aa00-4bb0-4ca3-820c-89c3015e6338', 'Main', 'main', 'main', 1, '2025-07-26 03:20:09', '2025-07-26 03:20:09', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `unit_id` bigint(20) UNSIGNED DEFAULT NULL,
  `designation_id` bigint(20) UNSIGNED DEFAULT NULL,
  `uuid` char(36) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL COMMENT 'Users Username',
  `user_type` tinyint(4) NOT NULL DEFAULT 2 COMMENT '1-Super Admin,2:All Admin,3:Customer,4:Merchant',
  `email` varchar(255) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `original_password` varchar(255) DEFAULT NULL,
  `phone_code` bigint(20) DEFAULT 91,
  `mobile_number` bigint(20) DEFAULT NULL,
  `verification_code` varchar(255) DEFAULT NULL COMMENT 'OTP used for verifying the phone number',
  `varification_otp_time` timestamp NULL DEFAULT NULL COMMENT 'Time when the verification OTP was sent',
  `no_of_attempted` int(11) DEFAULT NULL,
  `registration_ip` varchar(100) DEFAULT NULL,
  `is_verified` tinyint(4) DEFAULT 1 COMMENT '0:Not Verified,1:Verified',
  `is_active` tinyint(4) DEFAULT 1 COMMENT '0:Inactive,1:Active',
  `is_approve` tinyint(4) DEFAULT 1 COMMENT '0:Unapproved,1:Approved',
  `is_blocked` tinyint(4) DEFAULT 0 COMMENT '0:Unblocked,1:Blocked',
  `country_id` int(11) DEFAULT NULL,
  `state_id` int(11) DEFAULT NULL,
  `city_id` int(11) DEFAULT NULL,
  `lat` varchar(255) DEFAULT NULL,
  `lng` varchar(255) DEFAULT NULL,
  `profile_image` varchar(255) DEFAULT NULL,
  `fcm_token` varchar(255) DEFAULT NULL,
  `device_type` varchar(255) DEFAULT '1' COMMENT '1:Android,2:IOS',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `form_validation_otp` int(11) DEFAULT NULL,
  `form_validation_otp_time` timestamp NULL DEFAULT NULL,
  `form_validation_no_of_attempted` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `unit_id`, `designation_id`, `uuid`, `name`, `username`, `user_type`, `email`, `remember_token`, `password`, `original_password`, `phone_code`, `mobile_number`, `verification_code`, `varification_otp_time`, `no_of_attempted`, `registration_ip`, `is_verified`, `is_active`, `is_approve`, `is_blocked`, `country_id`, `state_id`, `city_id`, `lat`, `lng`, `profile_image`, `fcm_token`, `device_type`, `created_at`, `updated_at`, `deleted_at`, `form_validation_otp`, `form_validation_otp_time`, `form_validation_no_of_attempted`) VALUES
(1, NULL, NULL, 'f106146b-8056-4cc6-b987-612981a62011', 'Super Admin', 'SuperAdmin', 1, 'iamabackenddeveloper@gmail.com', NULL, '$2y$12$Qt.Rm1qAnRxo5p9mT6UG8u3WBLelroj.TEO4htVAoOIIHhMwucxP6', 'superadmin', 91, 9876543210, '396899', '2025-09-07 17:32:09', 3, '127.0.0.1', 1, 1, 1, 0, 101, 41, 5583, NULL, NULL, NULL, NULL, '1', '2025-08-02 18:10:49', '2025-09-07 17:51:57', NULL, 631665, '2025-09-07 17:51:57', 3),
(4, 1, 1, '61d1e1e4-5fea-4ab7-bd72-c29c8a3eb412', 'Unit one Admin User', NULL, 6, 'unit1@gmail.com', NULL, '$2y$12$Qt.Rm1qAnRxo5p9mT6UG8u3WBLelroj.TEO4htVAoOIIHhMwucxP6', NULL, 91, 3985568558, '3846', '2025-08-17 12:26:05', 3, NULL, 1, 1, 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '2025-08-02 20:26:52', '2025-08-17 12:26:05', NULL, NULL, NULL, NULL),
(5, 1, 1, '2d73d186-1ac0-4e7c-8335-0ec92b843914', 'Content Writter en', NULL, 3, 'contentwritteren@gmail.com', NULL, '$2y$12$Qt.Rm1qAnRxo5p9mT6UG8u3WBLelroj.TEO4htVAoOIIHhMwucxP6', NULL, 91, 2852855555, NULL, NULL, NULL, NULL, 1, 1, 1, 0, NULL, NULL, NULL, NULL, NULL, '688f7da15eebe.png', NULL, '1', '2025-08-03 15:17:54', '2025-08-03 15:17:54', NULL, NULL, NULL, NULL),
(6, 1, 1, 'd228898f-eaab-495d-850f-755e4094a666', 'Content Writter HI', NULL, 7, 'contentwritterhi@gmail.com', NULL, '$2y$12$Qt.Rm1qAnRxo5p9mT6UG8u3WBLelroj.TEO4htVAoOIIHhMwucxP6', NULL, 91, 2558574447, NULL, NULL, NULL, NULL, 1, 1, 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '2025-08-03 15:23:09', '2025-08-03 15:28:19', NULL, NULL, NULL, NULL),
(7, 1, 1, '1a5b65f2-78f3-4f5f-9a77-e53ce0d894a8', 'Content Approver', NULL, 4, 'contentapprover@gmail.com', NULL, '$2y$12$Qt.Rm1qAnRxo5p9mT6UG8u3WBLelroj.TEO4htVAoOIIHhMwucxP6', NULL, 91, 4585555555, '663257', '2025-08-26 17:32:47', 3, NULL, 1, 1, 1, 0, NULL, NULL, NULL, NULL, NULL, '688f7f4841c6a.jpeg', NULL, '1', '2025-08-03 15:24:56', '2025-08-26 17:32:47', NULL, NULL, NULL, NULL),
(8, 1, 1, 'fa19ef91-5ab3-44f8-a30f-d1060bdc4ff1', 'Reviewer', NULL, 5, 'reviewer@gmail.com', NULL, '$2y$12$Qt.Rm1qAnRxo5p9mT6UG8u3WBLelroj.TEO4htVAoOIIHhMwucxP6', NULL, 91, 5564654458, NULL, NULL, NULL, NULL, 1, 1, 1, 0, NULL, NULL, NULL, NULL, NULL, '688fa6da0e263.jpg', NULL, '1', '2025-08-03 18:13:46', '2025-08-03 18:13:46', NULL, NULL, NULL, NULL),
(9, 1, 1, '4be18850-2ca7-4937-aec2-d06b396d6b14', 'Web Admin Main website', NULL, 2, 'baijukumar@ord.gov.in', NULL, '$2y$12$LFf/H/8qEtlWKch/g4M6M.3AIgIOOk4AoS4m9zy8k.IB2p7dm29DW', NULL, 91, 8902643282, '2824', '2025-08-11 22:14:10', 3, NULL, 1, 1, 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '2025-08-11 17:33:04', '2025-08-11 22:14:10', NULL, NULL, NULL, NULL),
(10, 3, 1, 'e81e05c0-51f7-438d-b2af-d40c54040b9c', 'RFI Admin', NULL, 6, 'ofbit@ord.gov.in', NULL, '$2y$12$.x/9Nzj6mMqXNYgKNCmBjubH7Qf3gCjbCQ2telMteKawBd9DslXPK', NULL, 91, 7869927181, '5884', '2025-08-11 21:00:51', 3, NULL, 1, 1, 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '2025-08-11 17:39:03', '2025-08-11 21:00:51', NULL, NULL, NULL, NULL),
(11, 2, 1, 'c6605dc9-bb4b-41f7-aab2-267cc83b1913', 'Subhajit', NULL, 6, 'subhajit.bhowmick@shyamfuture.com', NULL, '$2y$12$5p9LqpKnt4G9sH8/tcYdp.fUaoX2z.D9uFQ8eLwKygM9fTAMWWhBa', NULL, 91, 9330412252, '7582', '2025-08-12 07:13:29', 3, NULL, 1, 1, 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '2025-08-12 07:12:11', '2025-08-12 07:13:29', NULL, NULL, NULL, NULL),
(12, 1, 1, 'e4f53559-c48e-4126-b4d8-239074477c73', 'Rahul D', NULL, 6, 'rahuld@gmail.com', NULL, '$2y$12$hOBluYx3JB/1AF1vc8B1PuPpUi8rskB3fN6qevit70cWAUTF.EpPC', NULL, 91, 9638527410, '4634', '2025-08-16 14:14:34', 3, NULL, 1, 1, 1, 0, NULL, NULL, NULL, NULL, NULL, '68a070b7f0ea5.jpg', NULL, '1', '2025-08-16 11:51:21', '2025-08-16 14:14:34', NULL, NULL, NULL, NULL),
(13, 1, 2, '96679bc1-6084-42f6-8014-a01488c83e9f', 'Kamla H', NULL, 3, 'kamla@gmail.com', NULL, '$2y$12$0XO6H/MDL5pI8tF6c5sQ3eDVCEiaRu5Ck5.AFBWveIJknFJaYte/.', NULL, 91, 5435435435, '1405', '2025-08-17 11:09:34', 3, NULL, 1, 1, 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '2025-08-17 07:04:29', '2025-08-17 12:18:28', NULL, 3422, '2025-08-17 12:18:28', 3),
(14, 1, 1, 'cba41a26-3f21-4f20-8811-e05eb4aacaf9', 'Anindya', NULL, 3, 'anindya.paul@shyamfuture.com', NULL, '$2y$12$KrCe9UKtf0qGcJnpujkPBOMh5V223IiIVaKeLB2PsW6iffoyeACsS', NULL, 91, 8976564567, '682290', '2025-08-26 17:26:12', 3, NULL, 1, 1, 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '2025-08-26 17:22:12', '2025-08-26 17:27:13', NULL, 882279, '2025-08-26 17:27:13', 3);

-- --------------------------------------------------------

--
-- Table structure for table `users_permissions`
--

CREATE TABLE `users_permissions` (
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `permission_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users_roles`
--

CREATE TABLE `users_roles` (
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users_roles`
--

INSERT INTO `users_roles` (`user_id`, `role_id`) VALUES
(1, 1),
(4, 6),
(5, 3),
(6, 7),
(7, 4),
(8, 5),
(9, 2),
(10, 6),
(11, 6),
(12, 6),
(13, 3),
(14, 3);

-- --------------------------------------------------------

--
-- Table structure for table `user_password_lists`
--

CREATE TABLE `user_password_lists` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `password` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_password_lists`
--

INSERT INTO `user_password_lists` (`id`, `user_id`, `password`, `created_at`, `updated_at`) VALUES
(1, 4, '$2y$12$1q86QAqrKzo.CnjSs1wyeOvw7mZ.WzSSkGPTk/uCn0K.95cQeEBs2', '2025-08-02 20:26:53', '2025-08-02 20:26:53'),
(2, 5, '$2y$12$fmHkRgVvFxaoWq3ZGFsa0u40nHOGiytUoCCXYa/9o3yKktCJXA2mq', '2025-08-03 15:17:55', '2025-08-03 15:17:55'),
(3, 6, '$2y$12$naSfsmen2U1PWaXi7ArbtOnIOJuVM9U6NH2aCZFSwK62I3skrx2BS', '2025-08-03 15:23:11', '2025-08-03 15:23:11'),
(4, 7, '$2y$12$6s3O7jt8KtLGWBveNttkWOdL0ilH8IM.P9xsS82NabzMDSfiUxT/e', '2025-08-03 15:24:56', '2025-08-03 15:24:56'),
(5, 8, '$2y$12$QmRvQtviczjyB6oFqthEBuqFQbVmgv3V.t6PXL/El1/4fxXg0lgNa', '2025-08-03 18:13:46', '2025-08-03 18:13:46'),
(6, 9, '$2y$12$/112o88esqMf2DrO140J8e2Cf/G24U7jg7g0L6Euo/IHS8o1gxbsW', '2025-08-11 17:33:04', '2025-08-11 17:33:04'),
(7, 10, '$2y$12$Gq1LYIHl/UfrrvmReFwOR.eSebJ.lrIyfCXwE7MukJC3edxpIHhJq', '2025-08-11 17:39:04', '2025-08-11 17:39:04'),
(8, 11, '$2y$12$QumRj6we9ngJeRKyCmhdUeBM77shGQpSa15F36kGkiBUEK96N3sty', '2025-08-12 07:12:12', '2025-08-12 07:12:12'),
(9, 12, '$2y$12$DP1/7/eemd0jxG.BBz.zTOqkCYupCPdwtLYS2CRTbGhsn3gsCJzgi', '2025-08-16 11:51:22', '2025-08-16 11:51:22'),
(10, 13, '$2y$12$Uf7oILvnKKjbE5V9Ecahd.5dyzar58YHTUdO6DWbJJw5xS/8d85Dy', '2025-08-17 07:04:30', '2025-08-17 07:04:30'),
(11, 14, '$2y$12$/VhuT0eIQ5E34WajVw/BP.zQnqDqEPEvLDLhRF0FlJiQ5ayKpTg..', '2025-08-26 17:22:12', '2025-08-26 17:22:12');

-- --------------------------------------------------------

--
-- Table structure for table `user_posts`
--

CREATE TABLE `user_posts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) DEFAULT NULL,
  `title_en` varchar(255) DEFAULT NULL,
  `title_hi` varchar(255) DEFAULT NULL,
  `menu_id` bigint(20) UNSIGNED NOT NULL,
  `is_active` tinyint(4) DEFAULT 1 COMMENT '0:Inactive,1:Active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activity_log`
--
ALTER TABLE `activity_log`
  ADD PRIMARY KEY (`id`),
  ADD KEY `subject` (`subject_type`,`subject_id`),
  ADD KEY `causer` (`causer_type`,`causer_id`),
  ADD KEY `activity_log_log_name_index` (`log_name`),
  ADD KEY `activity_log_ip_address_index` (`ip_address`);

--
-- Indexes for table `advertises`
--
ALTER TABLE `advertises`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `advertises_uuid_unique` (`uuid`);

--
-- Indexes for table `aiprs`
--
ALTER TABLE `aiprs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `aiprs_uuid_unique` (`uuid`),
  ADD KEY `aiprs_menu_id_foreign` (`menu_id`),
  ADD KEY `aiprs_unit_id_foreign` (`unit_id`),
  ADD KEY `aiprs_created_by_foreign` (`created_by`),
  ADD KEY `aiprs_updated_by_foreign` (`updated_by`);

--
-- Indexes for table `aipr_masters`
--
ALTER TABLE `aipr_masters`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `aipr_masters_uuid_unique` (`uuid`),
  ADD KEY `aipr_masters_menu_id_foreign` (`menu_id`),
  ADD KEY `aipr_masters_unit_id_foreign` (`unit_id`);

--
-- Indexes for table `banners`
--
ALTER TABLE `banners`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `banners_uuid_unique` (`uuid`),
  ADD KEY `banners_unit_id_foreign` (`unit_id`),
  ADD KEY `banners_menu_id_foreign` (`menu_id`);

--
-- Indexes for table `blogs`
--
ALTER TABLE `blogs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `blogs_uuid_unique` (`uuid`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `categories_uuid_unique` (`uuid`);

--
-- Indexes for table `cms`
--
ALTER TABLE `cms`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `cms_uuid_unique` (`uuid`),
  ADD KEY `cms_menu_id_foreign` (`menu_id`),
  ADD KEY `cms_section_id_foreign` (`section_id`),
  ADD KEY `cms_unit_id_foreign` (`unit_id`),
  ADD KEY `cms_contant_writter_id_foreign` (`hi_contant_writter_id`),
  ADD KEY `cms_contant_approver_id_foreign` (`contant_approver_id`),
  ADD KEY `cms_contant_reviewer_id_foreign` (`contant_reviewer_id`),
  ADD KEY `cms_hindi_approver_id_foreign` (`hindi_approver_id`),
  ADD KEY `cms_hindi_reviewer_id_foreign` (`hindi_reviewer_id`);

--
-- Indexes for table `designations`
--
ALTER TABLE `designations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `designations_uuid_unique` (`uuid`);

--
-- Indexes for table `documents`
--
ALTER TABLE `documents`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `documents_uuid_unique` (`uuid`),
  ADD KEY `documents_category_id_foreign` (`category_id`),
  ADD KEY `documents_menu_id_foreign` (`menu_id`),
  ADD KEY `documents_unit_id_foreign` (`unit_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `features`
--
ALTER TABLE `features`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `features_uuid_unique` (`uuid`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`id`),
  ADD KEY `feedback_unit_id_foreign` (`unit_id`);

--
-- Indexes for table `hods`
--
ALTER TABLE `hods`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `hods_uuid_unique` (`uuid`),
  ADD KEY `hods_unit_id_foreign` (`unit_id`),
  ADD KEY `hods_created_by_foreign` (`created_by`),
  ADD KEY `hods_updated_by_foreign` (`updated_by`);

--
-- Indexes for table `important_links`
--
ALTER TABLE `important_links`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `important_links_uuid_unique` (`uuid`);

--
-- Indexes for table `media`
--
ALTER TABLE `media`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `media_uuid_unique` (`uuid`),
  ADD KEY `media_menu_id_foreign` (`menu_id`),
  ADD KEY `media_unit_id_foreign` (`unit_id`),
  ADD KEY `media_created_by_foreign` (`created_by`),
  ADD KEY `media_updated_by_foreign` (`updated_by`);

--
-- Indexes for table `media_images`
--
ALTER TABLE `media_images`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `media_images_uuid_unique` (`uuid`),
  ADD KEY `media_images_media_id_foreign` (`media_id`);

--
-- Indexes for table `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `menus_uuid_unique` (`uuid`),
  ADD KEY `menus_parent_id_foreign` (`parent_id`),
  ADD KEY `menus_unit_id_foreign` (`unit_id`),
  ADD KEY `menus_extend_to_foreign` (`extend_to`),
  ADD KEY `menus_created_by_foreign` (`created_by`),
  ADD KEY `menus_updated_by_foreign` (`updated_by`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `news_uuid_unique` (`uuid`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `notifications_uuid_unique` (`uuid`),
  ADD KEY `notifications_user_id_foreign` (`user_id`);

--
-- Indexes for table `oauth_access_tokens`
--
ALTER TABLE `oauth_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_access_tokens_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_auth_codes`
--
ALTER TABLE `oauth_auth_codes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_auth_codes_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_clients`
--
ALTER TABLE `oauth_clients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_clients_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `oauth_refresh_tokens`
--
ALTER TABLE `oauth_refresh_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_refresh_tokens_access_token_id_index` (`access_token_id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_uuid_unique` (`uuid`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `push_notification_queues`
--
ALTER TABLE `push_notification_queues`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_uuid_unique` (`uuid`),
  ADD KEY `roles_created_by_foreign` (`created_by`),
  ADD KEY `roles_updated_by_foreign` (`updated_by`);

--
-- Indexes for table `roles_permissions`
--
ALTER TABLE `roles_permissions`
  ADD KEY `roles_permissions_role_id_foreign` (`role_id`),
  ADD KEY `roles_permissions_permission_id_foreign` (`permission_id`);

--
-- Indexes for table `sections`
--
ALTER TABLE `sections`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `sections_uuid_unique` (`uuid`),
  ADD KEY `sections_menu_id_foreign` (`menu_id`),
  ADD KEY `sections_unit_id_foreign` (`unit_id`),
  ADD KEY `sections_created_by_foreign` (`created_by`),
  ADD KEY `sections_updated_by_foreign` (`updated_by`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `settings_unit_id_foreign` (`unit_id`),
  ADD KEY `settings_created_by_foreign` (`created_by`),
  ADD KEY `settings_updated_by_foreign` (`updated_by`);

--
-- Indexes for table `states`
--
ALTER TABLE `states`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `teams`
--
ALTER TABLE `teams`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `teams_uuid_unique` (`uuid`),
  ADD KEY `teams_designation_id_foreign` (`designation_id`),
  ADD KEY `teams_menu_id_foreign` (`menu_id`),
  ADD KEY `teams_unit_id_foreign` (`unit_id`);

--
-- Indexes for table `templetes`
--
ALTER TABLE `templetes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `templete_sections`
--
ALTER TABLE `templete_sections`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `testimonials`
--
ALTER TABLE `testimonials`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `testimonials_uuid_unique` (`uuid`);

--
-- Indexes for table `units`
--
ALTER TABLE `units`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `units_uuid_unique` (`uuid`),
  ADD KEY `units_state_id_foreign` (`state_id`),
  ADD KEY `units_created_by_foreign` (`created_by`),
  ADD KEY `units_updated_by_foreign` (`updated_by`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_uuid_unique` (`uuid`),
  ADD UNIQUE KEY `users_username_unique` (`username`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_mobile_number_unique` (`mobile_number`),
  ADD KEY `users_designation_id_foreign` (`designation_id`),
  ADD KEY `users_unit_id_foreign` (`unit_id`);

--
-- Indexes for table `users_permissions`
--
ALTER TABLE `users_permissions`
  ADD KEY `users_permissions_user_id_foreign` (`user_id`),
  ADD KEY `users_permissions_permission_id_foreign` (`permission_id`);

--
-- Indexes for table `users_roles`
--
ALTER TABLE `users_roles`
  ADD KEY `users_roles_user_id_foreign` (`user_id`),
  ADD KEY `users_roles_role_id_foreign` (`role_id`);

--
-- Indexes for table `user_password_lists`
--
ALTER TABLE `user_password_lists`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_password_lists_user_id_foreign` (`user_id`);

--
-- Indexes for table `user_posts`
--
ALTER TABLE `user_posts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_posts_uuid_unique` (`uuid`),
  ADD KEY `user_posts_menu_id_foreign` (`menu_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activity_log`
--
ALTER TABLE `activity_log`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=142;

--
-- AUTO_INCREMENT for table `advertises`
--
ALTER TABLE `advertises`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `aiprs`
--
ALTER TABLE `aiprs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `aipr_masters`
--
ALTER TABLE `aipr_masters`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `banners`
--
ALTER TABLE `banners`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `blogs`
--
ALTER TABLE `blogs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `cms`
--
ALTER TABLE `cms`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `designations`
--
ALTER TABLE `designations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `documents`
--
ALTER TABLE `documents`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `features`
--
ALTER TABLE `features`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `hods`
--
ALTER TABLE `hods`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `important_links`
--
ALTER TABLE `important_links`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `media`
--
ALTER TABLE `media`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `media_images`
--
ALTER TABLE `media_images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `menus`
--
ALTER TABLE `menus`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `oauth_clients`
--
ALTER TABLE `oauth_clients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=88;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `push_notification_queues`
--
ALTER TABLE `push_notification_queues`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `sections`
--
ALTER TABLE `sections`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `states`
--
ALTER TABLE `states`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `teams`
--
ALTER TABLE `teams`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `templetes`
--
ALTER TABLE `templetes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `templete_sections`
--
ALTER TABLE `templete_sections`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `testimonials`
--
ALTER TABLE `testimonials`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `units`
--
ALTER TABLE `units`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `user_password_lists`
--
ALTER TABLE `user_password_lists`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `user_posts`
--
ALTER TABLE `user_posts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `aiprs`
--
ALTER TABLE `aiprs`
  ADD CONSTRAINT `aiprs_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `aiprs_menu_id_foreign` FOREIGN KEY (`menu_id`) REFERENCES `menus` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `aiprs_unit_id_foreign` FOREIGN KEY (`unit_id`) REFERENCES `units` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `aiprs_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `aipr_masters`
--
ALTER TABLE `aipr_masters`
  ADD CONSTRAINT `aipr_masters_menu_id_foreign` FOREIGN KEY (`menu_id`) REFERENCES `menus` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `aipr_masters_unit_id_foreign` FOREIGN KEY (`unit_id`) REFERENCES `units` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `banners`
--
ALTER TABLE `banners`
  ADD CONSTRAINT `banners_menu_id_foreign` FOREIGN KEY (`menu_id`) REFERENCES `menus` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `banners_unit_id_foreign` FOREIGN KEY (`unit_id`) REFERENCES `units` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `cms`
--
ALTER TABLE `cms`
  ADD CONSTRAINT `cms_contant_approver_id_foreign` FOREIGN KEY (`contant_approver_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `cms_contant_reviewer_id_foreign` FOREIGN KEY (`contant_reviewer_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `cms_contant_writter_id_foreign` FOREIGN KEY (`hi_contant_writter_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `cms_hindi_approver_id_foreign` FOREIGN KEY (`hindi_approver_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `cms_hindi_reviewer_id_foreign` FOREIGN KEY (`hindi_reviewer_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `cms_menu_id_foreign` FOREIGN KEY (`menu_id`) REFERENCES `menus` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `cms_section_id_foreign` FOREIGN KEY (`section_id`) REFERENCES `sections` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `cms_unit_id_foreign` FOREIGN KEY (`unit_id`) REFERENCES `units` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `documents`
--
ALTER TABLE `documents`
  ADD CONSTRAINT `documents_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `documents_menu_id_foreign` FOREIGN KEY (`menu_id`) REFERENCES `menus` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `documents_unit_id_foreign` FOREIGN KEY (`unit_id`) REFERENCES `units` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `feedback`
--
ALTER TABLE `feedback`
  ADD CONSTRAINT `feedback_unit_id_foreign` FOREIGN KEY (`unit_id`) REFERENCES `units` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `hods`
--
ALTER TABLE `hods`
  ADD CONSTRAINT `hods_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `hods_unit_id_foreign` FOREIGN KEY (`unit_id`) REFERENCES `units` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `hods_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `media`
--
ALTER TABLE `media`
  ADD CONSTRAINT `media_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `media_menu_id_foreign` FOREIGN KEY (`menu_id`) REFERENCES `menus` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `media_unit_id_foreign` FOREIGN KEY (`unit_id`) REFERENCES `units` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `media_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `media_images`
--
ALTER TABLE `media_images`
  ADD CONSTRAINT `media_images_media_id_foreign` FOREIGN KEY (`media_id`) REFERENCES `media` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `menus`
--
ALTER TABLE `menus`
  ADD CONSTRAINT `menus_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `menus_parent_id_foreign` FOREIGN KEY (`parent_id`) REFERENCES `menus` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `menus_unit_id_foreign` FOREIGN KEY (`unit_id`) REFERENCES `units` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `menus_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `notifications_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `roles`
--
ALTER TABLE `roles`
  ADD CONSTRAINT `roles_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `roles_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `roles_permissions`
--
ALTER TABLE `roles_permissions`
  ADD CONSTRAINT `roles_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `roles_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
