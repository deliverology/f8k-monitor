-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 07, 2018 at 03:13 PM
-- Server version: 5.7.14
-- PHP Version: 5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dev_monevdki`
--

-- --------------------------------------------------------

--
-- Table structure for table `acl_perm`
--

CREATE TABLE `acl_perm` (
  `id` int(10) UNSIGNED NOT NULL,
  `key` varchar(30) NOT NULL,
  `name` varchar(30) NOT NULL,
  `type` tinyint(1) NOT NULL DEFAULT '2'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `acl_perm`
--

INSERT INTO `acl_perm` (`id`, `key`, `name`, `type`) VALUES
(1, 'monitor', '', 1),
(2, 'domains', '', 1),
(3, 'mc', '', 1),
(4, 'setting', '', 1),
(5, 'profile', '', 1),
(6, 'monitor_add', '', 2),
(7, 'monitor_edit', '', 2),
(8, 'monitor_delete', '', 2),
(9, 'monitor_prioritas_add', '', 2),
(10, 'monitor_prioritas_edit', '', 2),
(11, 'monitor_prioritas_delete', '', 2),
(12, 'monitor_program_add', '', 2),
(13, 'monitor_program_edit', '', 2),
(14, 'monitor_program_delete', '', 2),
(15, 'monitor_renaksi_add', '', 2),
(16, 'monitor_renaksi_edit', '', 2),
(17, 'monitor_renaksi_delete', '', 2),
(18, 'monitor_kriteria_add', '', 2),
(19, 'monitor_kriteria_edit', '', 2),
(20, 'monitor_kriteria_delete', '', 2),
(21, 'monitor_ukuran_add', '', 2),
(22, 'monitor_ukuran_edit', '', 2),
(23, 'monitor_ukuran_delete', '', 2),
(24, 'monitor_lapor', '', 2),
(25, 'monitor_verifikasi', '', 2),
(26, 'domains_add', '', 2),
(27, 'domains_edit', '', 2),
(28, 'domains_delete', '', 2),
(29, 'mc_monitor_status', '', 2),
(30, 'mc_checkpoint_status', '', 2),
(31, 'mc_checkpoint_add', '', 2),
(32, 'mc_checkpoint_edit', '', 2),
(33, 'mc_checkpoint_delete', '', 2),
(34, 'setting_user', '', 2),
(35, 'setting_user_add', '', 2),
(36, 'setting_user_edit', '', 2),
(37, 'setting_user_delete', '', 2),
(38, 'setting_user_reset', '', 2),
(39, 'setting_role', '', 2),
(40, 'setting_role_add', '', 2),
(41, 'setting_role_edit', '', 2),
(42, 'setting_module', '', 2),
(43, 'setting_module_add', '', 2),
(44, 'setting_module_delete', '', 2),
(45, 'setting_acl', '', 2),
(46, 'profile_change_email', '', 2),
(47, 'profile_change_password', '', 2),
(48, 'profile_change_data', '', 2);

-- --------------------------------------------------------

--
-- Table structure for table `acl_role_perms`
--

CREATE TABLE `acl_role_perms` (
  `id` int(20) UNSIGNED NOT NULL,
  `role_id` int(20) NOT NULL,
  `perm_id` int(20) NOT NULL,
  `value` tinyint(1) NOT NULL DEFAULT '0',
  `addDate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `acl_role_perms`
--

INSERT INTO `acl_role_perms` (`id`, `role_id`, `perm_id`, `value`, `addDate`) VALUES
(1, 1, 1, 1, '2015-07-03 10:07:03'),
(2, 2, 1, 1, '2015-07-03 04:24:39'),
(3, 3, 1, 1, '2015-07-03 04:25:48'),
(4, 4, 1, 1, '2015-07-03 04:26:20'),
(5, 5, 1, 1, '2015-07-03 04:26:27'),
(6, 6, 1, 1, '2015-07-03 04:26:37'),
(7, 7, 1, 1, '2015-07-03 04:26:45'),
(8, 1, 2, 1, '2015-07-03 12:58:50'),
(9, 2, 2, 1, '2015-07-03 12:58:50'),
(10, 3, 2, 1, '2015-07-03 12:58:50'),
(11, 4, 2, 1, '2015-07-03 12:58:50'),
(12, 5, 2, 0, '2015-07-03 12:58:50'),
(13, 6, 2, 0, '2015-07-03 12:58:50'),
(14, 7, 2, 1, '2015-07-03 12:58:50'),
(15, 1, 3, 1, '2015-07-03 12:59:17'),
(16, 2, 3, 0, '2015-07-03 12:59:17'),
(17, 3, 3, 0, '2015-07-03 12:59:17'),
(18, 4, 3, 0, '2015-07-03 12:59:17'),
(19, 5, 3, 0, '2015-07-03 12:59:17'),
(20, 6, 3, 0, '2015-07-03 12:59:17'),
(21, 7, 3, 0, '2015-07-03 12:59:17'),
(22, 1, 4, 1, '2015-07-03 12:59:46'),
(23, 2, 4, 0, '2015-07-03 12:59:46'),
(24, 3, 4, 0, '2015-07-03 12:59:46'),
(25, 4, 4, 0, '2015-07-03 12:59:46'),
(26, 5, 4, 0, '2015-07-03 12:59:46'),
(27, 6, 4, 0, '2015-07-03 12:59:46'),
(28, 7, 4, 0, '2015-07-03 12:59:46'),
(29, 1, 5, 1, '2015-07-03 12:59:57'),
(30, 2, 5, 1, '2015-07-03 12:59:57'),
(31, 3, 5, 1, '2015-07-03 12:59:57'),
(32, 4, 5, 1, '2015-07-03 12:59:57'),
(33, 5, 5, 1, '2015-07-03 12:59:57'),
(34, 6, 5, 1, '2015-07-03 12:59:57'),
(35, 7, 5, 1, '2015-07-03 12:59:57'),
(36, 1, 6, 1, '2015-07-03 01:01:39'),
(37, 2, 6, 0, '2015-07-03 01:01:39'),
(38, 3, 6, 0, '2015-07-03 01:01:39'),
(39, 4, 6, 0, '2015-07-03 01:01:39'),
(40, 5, 6, 0, '2015-07-03 01:01:39'),
(41, 6, 6, 0, '2015-07-03 01:01:39'),
(42, 7, 6, 0, '2015-07-03 01:01:39'),
(43, 1, 7, 1, '2015-07-03 01:01:49'),
(44, 2, 7, 0, '2015-07-03 01:01:49'),
(45, 3, 7, 0, '2015-07-03 01:01:49'),
(46, 4, 7, 0, '2015-07-03 01:01:49'),
(47, 5, 7, 0, '2015-07-03 01:01:49'),
(48, 6, 7, 0, '2015-07-03 01:01:49'),
(49, 7, 7, 0, '2015-07-03 01:01:49'),
(50, 1, 8, 1, '2015-07-03 01:01:57'),
(51, 2, 8, 0, '2015-07-03 01:01:57'),
(52, 3, 8, 0, '2015-07-03 01:01:57'),
(53, 4, 8, 0, '2015-07-03 01:01:57'),
(54, 5, 8, 0, '2015-07-03 01:01:57'),
(55, 6, 8, 0, '2015-07-03 01:01:57'),
(56, 7, 8, 0, '2015-07-03 01:01:57'),
(57, 1, 9, 1, '2015-07-03 01:02:41'),
(58, 2, 9, 0, '2015-07-03 01:02:41'),
(59, 3, 9, 0, '2015-07-03 01:02:41'),
(60, 4, 9, 0, '2015-07-03 01:02:41'),
(61, 5, 9, 0, '2015-07-03 01:02:41'),
(62, 6, 9, 0, '2015-07-03 01:02:41'),
(63, 7, 9, 0, '2015-07-03 01:02:41'),
(64, 1, 10, 1, '2015-07-03 01:02:53'),
(65, 2, 10, 0, '2015-07-03 01:02:53'),
(66, 3, 10, 0, '2015-07-03 01:02:53'),
(67, 4, 10, 0, '2015-07-03 01:02:53'),
(68, 5, 10, 0, '2015-07-03 01:02:53'),
(69, 6, 10, 0, '2015-07-03 01:02:53'),
(70, 7, 10, 0, '2015-07-03 01:02:53'),
(71, 1, 11, 1, '2015-07-03 01:03:02'),
(72, 2, 11, 0, '2015-07-03 01:03:02'),
(73, 3, 11, 0, '2015-07-03 01:03:02'),
(74, 4, 11, 0, '2015-07-03 01:03:02'),
(75, 5, 11, 0, '2015-07-03 01:03:02'),
(76, 6, 11, 0, '2015-07-03 01:03:02'),
(77, 7, 11, 0, '2015-07-03 01:03:02'),
(78, 1, 12, 1, '2015-07-03 01:03:19'),
(79, 2, 12, 0, '2015-07-03 01:03:19'),
(80, 3, 12, 0, '2015-07-03 01:03:19'),
(81, 4, 12, 0, '2015-07-03 01:03:19'),
(82, 5, 12, 0, '2015-07-03 01:03:19'),
(83, 6, 12, 0, '2015-07-03 01:03:19'),
(84, 7, 12, 0, '2015-07-03 01:03:19'),
(85, 1, 13, 1, '2015-07-03 01:03:26'),
(86, 2, 13, 0, '2015-07-03 01:03:26'),
(87, 3, 13, 0, '2015-07-03 01:03:26'),
(88, 4, 13, 0, '2015-07-03 01:03:26'),
(89, 5, 13, 0, '2015-07-03 01:03:26'),
(90, 6, 13, 0, '2015-07-03 01:03:26'),
(91, 7, 13, 0, '2015-07-03 01:03:26'),
(92, 1, 14, 1, '2015-07-03 01:03:33'),
(93, 2, 14, 0, '2015-07-03 01:03:33'),
(94, 3, 14, 0, '2015-07-03 01:03:33'),
(95, 4, 14, 0, '2015-07-03 01:03:33'),
(96, 5, 14, 0, '2015-07-03 01:03:33'),
(97, 6, 14, 0, '2015-07-03 01:03:33'),
(98, 7, 14, 0, '2015-07-03 01:03:33'),
(99, 1, 15, 1, '2015-07-03 01:03:57'),
(100, 2, 15, 0, '2015-07-03 01:03:57'),
(101, 3, 15, 0, '2015-07-03 01:03:57'),
(102, 4, 15, 0, '2015-07-03 01:03:57'),
(103, 5, 15, 0, '2015-07-03 01:03:57'),
(104, 6, 15, 0, '2015-07-03 01:03:57'),
(105, 7, 15, 0, '2015-07-03 01:03:57'),
(106, 1, 16, 1, '2015-07-03 01:04:04'),
(107, 2, 16, 0, '2015-07-03 01:04:04'),
(108, 3, 16, 0, '2015-07-03 01:04:04'),
(109, 4, 16, 0, '2015-07-03 01:04:04'),
(110, 5, 16, 0, '2015-07-03 01:04:04'),
(111, 6, 16, 0, '2015-07-03 01:04:04'),
(112, 7, 16, 0, '2015-07-03 01:04:04'),
(113, 1, 17, 1, '2015-07-03 01:04:10'),
(114, 2, 17, 0, '2015-07-03 01:04:10'),
(115, 3, 17, 0, '2015-07-03 01:04:10'),
(116, 4, 17, 0, '2015-07-03 01:04:10'),
(117, 5, 17, 0, '2015-07-03 01:04:10'),
(118, 6, 17, 0, '2015-07-03 01:04:10'),
(119, 7, 17, 0, '2015-07-03 01:04:10'),
(120, 1, 18, 1, '2015-07-03 01:04:41'),
(121, 2, 18, 0, '2015-07-03 01:04:41'),
(122, 3, 18, 0, '2015-07-03 01:04:41'),
(123, 4, 18, 0, '2015-07-03 01:04:41'),
(124, 5, 18, 0, '2015-07-03 01:04:41'),
(125, 6, 18, 0, '2015-07-03 01:04:41'),
(126, 7, 18, 0, '2015-07-03 01:04:41'),
(127, 1, 19, 1, '2015-07-03 01:04:47'),
(128, 2, 19, 0, '2015-07-03 01:04:47'),
(129, 3, 19, 0, '2015-07-03 01:04:47'),
(130, 4, 19, 0, '2015-07-03 01:04:47'),
(131, 5, 19, 0, '2015-07-03 01:04:47'),
(132, 6, 19, 0, '2015-07-03 01:04:47'),
(133, 7, 19, 0, '2015-07-03 01:04:47'),
(134, 1, 20, 1, '2015-07-03 01:04:52'),
(135, 2, 20, 0, '2015-07-03 01:04:52'),
(136, 3, 20, 0, '2015-07-03 01:04:52'),
(137, 4, 20, 0, '2015-07-03 01:04:52'),
(138, 5, 20, 0, '2015-07-03 01:04:52'),
(139, 6, 20, 0, '2015-07-03 01:04:52'),
(140, 7, 20, 0, '2015-07-03 01:04:52'),
(141, 1, 21, 1, '2015-07-03 01:05:15'),
(142, 2, 21, 0, '2015-07-03 01:05:15'),
(143, 3, 21, 0, '2015-07-03 01:05:15'),
(144, 4, 21, 0, '2015-07-03 01:05:15'),
(145, 5, 21, 0, '2015-07-03 01:05:15'),
(146, 6, 21, 0, '2015-07-03 01:05:15'),
(147, 7, 21, 0, '2015-07-03 01:05:15'),
(148, 1, 22, 1, '2015-07-03 01:05:26'),
(149, 2, 22, 0, '2015-07-03 01:05:26'),
(150, 3, 22, 0, '2015-07-03 01:05:26'),
(151, 4, 22, 0, '2015-07-03 01:05:26'),
(152, 5, 22, 0, '2015-07-03 01:05:26'),
(153, 6, 22, 0, '2015-07-03 01:05:26'),
(154, 7, 22, 0, '2015-07-03 01:05:26'),
(155, 1, 23, 1, '2015-07-03 01:05:32'),
(156, 2, 23, 0, '2015-07-03 01:05:32'),
(157, 3, 23, 0, '2015-07-03 01:05:32'),
(158, 4, 23, 0, '2015-07-03 01:05:32'),
(159, 5, 23, 0, '2015-07-03 01:05:32'),
(160, 6, 23, 0, '2015-07-03 01:05:32'),
(161, 7, 23, 0, '2015-07-03 01:05:32'),
(162, 1, 24, 1, '2015-07-03 01:06:49'),
(163, 2, 24, 0, '2015-07-03 01:06:49'),
(164, 3, 24, 0, '2015-07-03 01:06:49'),
(165, 4, 24, 0, '2015-07-03 01:06:49'),
(166, 5, 24, 0, '2015-07-03 01:06:49'),
(167, 6, 24, 0, '2015-07-03 01:06:49'),
(168, 7, 24, 0, '2015-07-03 01:06:49'),
(169, 1, 25, 1, '2015-07-03 01:07:00'),
(170, 2, 25, 0, '2015-07-03 01:07:00'),
(171, 3, 25, 0, '2015-07-03 01:07:00'),
(172, 4, 25, 0, '2015-07-03 01:07:00'),
(173, 5, 25, 0, '2015-07-03 01:07:00'),
(174, 6, 25, 0, '2015-07-03 01:07:00'),
(175, 7, 25, 0, '2015-07-03 01:07:00'),
(176, 1, 26, 1, '2015-07-03 01:07:54'),
(177, 2, 26, 0, '2015-07-03 01:07:54'),
(178, 3, 26, 0, '2015-07-03 01:07:54'),
(179, 4, 26, 0, '2015-07-03 01:07:54'),
(180, 5, 26, 0, '2015-07-03 01:07:54'),
(181, 6, 26, 0, '2015-07-03 01:07:54'),
(182, 7, 26, 0, '2015-07-03 01:07:54'),
(183, 1, 27, 1, '2015-07-03 01:08:00'),
(184, 2, 27, 0, '2015-07-03 01:08:00'),
(185, 3, 27, 0, '2015-07-03 01:08:00'),
(186, 4, 27, 0, '2015-07-03 01:08:00'),
(187, 5, 27, 0, '2015-07-03 01:08:00'),
(188, 6, 27, 0, '2015-07-03 01:08:00'),
(189, 7, 27, 0, '2015-07-03 01:08:00'),
(190, 1, 28, 1, '2015-07-03 01:08:06'),
(191, 2, 28, 0, '2015-07-03 01:08:06'),
(192, 3, 28, 0, '2015-07-03 01:08:06'),
(193, 4, 28, 0, '2015-07-03 01:08:06'),
(194, 5, 28, 0, '2015-07-03 01:08:06'),
(195, 6, 28, 0, '2015-07-03 01:08:06'),
(196, 7, 28, 0, '2015-07-03 01:08:06'),
(197, 1, 29, 1, '2015-07-03 01:09:31'),
(198, 2, 29, 0, '2015-07-03 01:09:31'),
(199, 3, 29, 0, '2015-07-03 01:09:31'),
(200, 4, 29, 0, '2015-07-03 01:09:31'),
(201, 5, 29, 0, '2015-07-03 01:09:31'),
(202, 6, 29, 0, '2015-07-03 01:09:31'),
(203, 7, 29, 0, '2015-07-03 01:09:31'),
(204, 1, 30, 1, '2015-07-03 01:09:55'),
(205, 2, 30, 0, '2015-07-03 01:09:55'),
(206, 3, 30, 0, '2015-07-03 01:09:55'),
(207, 4, 30, 0, '2015-07-03 01:09:55'),
(208, 5, 30, 0, '2015-07-03 01:09:55'),
(209, 6, 30, 0, '2015-07-03 01:09:55'),
(210, 7, 30, 0, '2015-07-03 01:09:55'),
(211, 1, 31, 1, '2015-07-03 01:11:32'),
(212, 2, 31, 0, '2015-07-03 01:11:32'),
(213, 3, 31, 0, '2015-07-03 01:11:32'),
(214, 4, 31, 0, '2015-07-03 01:11:32'),
(215, 5, 31, 0, '2015-07-03 01:11:32'),
(216, 6, 31, 0, '2015-07-03 01:11:32'),
(217, 7, 31, 0, '2015-07-03 01:11:32'),
(218, 1, 32, 1, '2015-07-03 01:11:40'),
(219, 2, 32, 0, '2015-07-03 01:11:40'),
(220, 3, 32, 0, '2015-07-03 01:11:40'),
(221, 4, 32, 0, '2015-07-03 01:11:40'),
(222, 5, 32, 0, '2015-07-03 01:11:40'),
(223, 6, 32, 0, '2015-07-03 01:11:40'),
(224, 7, 32, 0, '2015-07-03 01:11:40'),
(225, 1, 33, 1, '2015-07-03 01:11:47'),
(226, 2, 33, 0, '2015-07-03 01:11:47'),
(227, 3, 33, 0, '2015-07-03 01:11:47'),
(228, 4, 33, 0, '2015-07-03 01:11:47'),
(229, 5, 33, 0, '2015-07-03 01:11:47'),
(230, 6, 33, 0, '2015-07-03 01:11:47'),
(231, 7, 33, 0, '2015-07-03 01:11:47'),
(232, 1, 34, 1, '2015-07-03 01:12:36'),
(233, 2, 34, 0, '2015-07-03 01:12:36'),
(234, 3, 34, 0, '2015-07-03 01:12:36'),
(235, 4, 34, 0, '2015-07-03 01:12:36'),
(236, 5, 34, 0, '2015-07-03 01:12:36'),
(237, 6, 34, 0, '2015-07-03 01:12:36'),
(238, 7, 34, 0, '2015-07-03 01:12:36'),
(239, 1, 35, 1, '2015-07-03 01:12:45'),
(240, 2, 35, 0, '2015-07-03 01:12:45'),
(241, 3, 35, 0, '2015-07-03 01:12:45'),
(242, 4, 35, 0, '2015-07-03 01:12:45'),
(243, 5, 35, 0, '2015-07-03 01:12:45'),
(244, 6, 35, 0, '2015-07-03 01:12:45'),
(245, 7, 35, 0, '2015-07-03 01:12:45'),
(246, 1, 36, 1, '2015-07-03 01:12:55'),
(247, 2, 36, 0, '2015-07-03 01:12:55'),
(248, 3, 36, 0, '2015-07-03 01:12:55'),
(249, 4, 36, 0, '2015-07-03 01:12:55'),
(250, 5, 36, 0, '2015-07-03 01:12:55'),
(251, 6, 36, 0, '2015-07-03 01:12:55'),
(252, 7, 36, 0, '2015-07-03 01:12:55'),
(253, 1, 37, 1, '2015-07-03 01:13:00'),
(254, 2, 37, 0, '2015-07-03 01:13:00'),
(255, 3, 37, 0, '2015-07-03 01:13:00'),
(256, 4, 37, 0, '2015-07-03 01:13:00'),
(257, 5, 37, 0, '2015-07-03 01:13:00'),
(258, 6, 37, 0, '2015-07-03 01:13:00'),
(259, 7, 37, 0, '2015-07-03 01:13:00'),
(260, 1, 38, 1, '2015-07-03 01:13:11'),
(261, 2, 38, 0, '2015-07-03 01:13:11'),
(262, 3, 38, 0, '2015-07-03 01:13:11'),
(263, 4, 38, 0, '2015-07-03 01:13:11'),
(264, 5, 38, 0, '2015-07-03 01:13:11'),
(265, 6, 38, 0, '2015-07-03 01:13:11'),
(266, 7, 38, 0, '2015-07-03 01:13:11'),
(267, 1, 39, 1, '2015-07-03 01:13:43'),
(268, 2, 39, 0, '2015-07-03 01:13:43'),
(269, 3, 39, 0, '2015-07-03 01:13:43'),
(270, 4, 39, 0, '2015-07-03 01:13:43'),
(271, 5, 39, 0, '2015-07-03 01:13:43'),
(272, 6, 39, 0, '2015-07-03 01:13:43'),
(273, 7, 39, 0, '2015-07-03 01:13:43'),
(274, 1, 40, 1, '2015-07-03 01:13:50'),
(275, 2, 40, 0, '2015-07-03 01:13:50'),
(276, 3, 40, 0, '2015-07-03 01:13:50'),
(277, 4, 40, 0, '2015-07-03 01:13:50'),
(278, 5, 40, 0, '2015-07-03 01:13:50'),
(279, 6, 40, 0, '2015-07-03 01:13:50'),
(280, 7, 40, 0, '2015-07-03 01:13:50'),
(281, 1, 41, 1, '2015-07-03 01:13:59'),
(282, 2, 41, 0, '2015-07-03 01:13:59'),
(283, 3, 41, 0, '2015-07-03 01:13:59'),
(284, 4, 41, 0, '2015-07-03 01:13:59'),
(285, 5, 41, 0, '2015-07-03 01:13:59'),
(286, 6, 41, 0, '2015-07-03 01:13:59'),
(287, 7, 41, 0, '2015-07-03 01:13:59'),
(288, 1, 42, 1, '2015-07-03 01:14:27'),
(289, 2, 42, 0, '2015-07-03 01:14:27'),
(290, 3, 42, 0, '2015-07-03 01:14:27'),
(291, 4, 42, 0, '2015-07-03 01:14:27'),
(292, 5, 42, 0, '2015-07-03 01:14:27'),
(293, 6, 42, 0, '2015-07-03 01:14:27'),
(294, 7, 42, 0, '2015-07-03 01:14:27'),
(295, 1, 43, 1, '2015-07-03 01:14:33'),
(296, 2, 43, 0, '2015-07-03 01:14:33'),
(297, 3, 43, 0, '2015-07-03 01:14:33'),
(298, 4, 43, 0, '2015-07-03 01:14:33'),
(299, 5, 43, 0, '2015-07-03 01:14:33'),
(300, 6, 43, 0, '2015-07-03 01:14:33'),
(301, 7, 43, 0, '2015-07-03 01:14:33'),
(302, 1, 44, 1, '2015-07-03 01:14:42'),
(303, 2, 44, 0, '2015-07-03 01:14:42'),
(304, 3, 44, 0, '2015-07-03 01:14:42'),
(305, 4, 44, 0, '2015-07-03 01:14:42'),
(306, 5, 44, 0, '2015-07-03 01:14:42'),
(307, 6, 44, 0, '2015-07-03 01:14:42'),
(308, 7, 44, 0, '2015-07-03 01:14:42'),
(309, 1, 45, 1, '2015-07-03 01:15:07'),
(310, 2, 45, 0, '2015-07-03 01:15:07'),
(311, 3, 45, 0, '2015-07-03 01:15:07'),
(312, 4, 45, 0, '2015-07-03 01:15:07'),
(313, 5, 45, 0, '2015-07-03 01:15:07'),
(314, 6, 45, 0, '2015-07-03 01:15:07'),
(315, 7, 45, 0, '2015-07-03 01:15:07'),
(316, 1, 46, 1, '2015-07-03 01:16:31'),
(317, 2, 46, 1, '2015-07-03 01:16:31'),
(318, 3, 46, 1, '2015-07-03 01:16:31'),
(319, 4, 46, 1, '2015-07-03 01:16:31'),
(320, 5, 46, 1, '2015-07-03 01:16:31'),
(321, 6, 46, 1, '2015-07-03 01:16:31'),
(322, 7, 46, 1, '2015-07-03 01:16:31'),
(323, 1, 47, 1, '2015-07-03 01:16:39'),
(324, 2, 47, 1, '2015-07-03 01:16:39'),
(325, 3, 47, 1, '2015-07-03 01:16:39'),
(326, 4, 47, 1, '2015-07-03 01:16:39'),
(327, 5, 47, 1, '2015-07-03 01:16:39'),
(328, 6, 47, 1, '2015-07-03 01:16:39'),
(329, 7, 47, 1, '2015-07-03 01:16:39'),
(330, 1, 48, 1, '2015-07-03 01:16:46'),
(331, 2, 48, 1, '2015-07-03 01:16:46'),
(332, 3, 48, 1, '2015-07-03 01:16:46'),
(333, 4, 48, 1, '2015-07-03 01:16:46'),
(334, 5, 48, 1, '2015-07-03 01:16:46'),
(335, 6, 48, 1, '2015-07-03 01:16:46'),
(336, 7, 48, 1, '2015-07-03 01:16:46');

-- --------------------------------------------------------

--
-- Table structure for table `acl_user_domains`
--

CREATE TABLE `acl_user_domains` (
  `user_id` int(11) NOT NULL,
  `domain_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `acl_user_perms`
--

CREATE TABLE `acl_user_perms` (
  `id` int(20) UNSIGNED NOT NULL,
  `user_id` int(20) NOT NULL,
  `perm_id` int(20) NOT NULL,
  `value` tinyint(1) NOT NULL DEFAULT '0',
  `addDate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `app_properties`
--

CREATE TABLE `app_properties` (
  `nid` int(11) NOT NULL,
  `app` varchar(100) NOT NULL,
  `ref_nid` int(11) NOT NULL,
  `property_name` varchar(200) NOT NULL,
  `property_value` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ci_sessions`
--

CREATE TABLE `ci_sessions` (
  `session_id` varchar(40) COLLATE utf8_bin NOT NULL DEFAULT '0',
  `ip_address` varchar(16) COLLATE utf8_bin NOT NULL DEFAULT '0',
  `user_agent` varchar(150) COLLATE utf8_bin NOT NULL,
  `last_activity` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `user_data` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `ci_sessions`
--

INSERT INTO `ci_sessions` (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES
('57f312cc06bf6e9188b543783fca786e', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/67.0.3396.99 Safari/537.36', 1533654759, '');

-- --------------------------------------------------------

--
-- Table structure for table `domains`
--

CREATE TABLE `domains` (
  `id` int(11) NOT NULL,
  `parent_id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `name_alias` varchar(200) NOT NULL,
  `domains_type_id` tinyint(4) NOT NULL,
  `verified` tinyint(4) NOT NULL,
  `is_active` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `domains`
--

INSERT INTO `domains` (`id`, `parent_id`, `name`, `name_alias`, `domains_type_id`, `verified`, `is_active`) VALUES
(1, 0, 'Pemerintah Republik Indonesia', 'RI', 1, 1, 1),
(2, 1, 'Kementerian Kelautan dan Perikanan', 'KKP', 2, 1, 1),
(3, 2, 'Staf Ahli Menteri', 'Staf Ahli', 7, 1, 1),
(4, 2, 'Staf Khusus Menteri', 'Staf Khusus', 7, 1, 1),
(5, 2, 'Sekretariat Jenderal', 'Setjen', 7, 1, 1),
(6, 2, 'Inspektorat Jenderal', 'Itjen', 7, 1, 1),
(7, 2, 'Direktorat Jenderal Perikanan Tangkap', 'DJPT', 7, 1, 1),
(8, 2, 'Direktorat Jenderal Perikanan Budidaya', 'DJPB', 7, 1, 1),
(9, 2, 'Direktorat Jenderal Penguatan Daya Saing Produk Kelautan dan Perikanan', 'Ditjen PDSPKP', 7, 1, 1),
(10, 2, 'Direktorat Jenderal Pengelolaan Ruang Laut', 'Ditjen PRL', 7, 1, 1),
(11, 2, 'Direktorat Jenderal Pengawasan Sumber Daya Kelautan dan Perikanan', 'Ditjen PSDKP', 7, 1, 1),
(12, 2, 'Badan Penelitian dan Pengembangan Kelautan Perikanan', 'Balitbang KP', 7, 1, 1),
(13, 2, 'Badan Pengembangan Sumber Daya Manusia dan Pemberdayaan Masyarakat Kelautan dan Perikanan', 'BPSDMKP', 7, 1, 1),
(14, 2, 'Badan Karantina Ikan, Pengendalian Mutu, Dan Keamanan Hasil Perikanan', 'BKIPM', 7, 1, 1),
(15, 5, 'Biro Perencanaan', 'Roren', 8, 1, 1),
(16, 5, 'Biro Kepegawaian', 'Ropeg', 8, 1, 1),
(17, 5, 'Biro Keuangan', 'Rokeu', 8, 1, 1),
(18, 5, 'Biro Hukum dan Organisasi', '', 8, 1, 1),
(19, 5, 'Biro Umum', '', 8, 1, 1),
(20, 5, 'Pusat Data dan Informasi', 'Pusdatin', 8, 1, 1),
(21, 5, 'Biro Kerja Sama dan Hubungan Masyarakat', 'Kermas', 8, 1, 1),
(22, 6, 'Sekretaria Inspektorat Jenderal', 'Sesitjen', 8, 1, 1),
(23, 6, 'Inspektur I', '', 8, 1, 1),
(24, 6, 'Inspektur II', '', 8, 1, 1),
(25, 6, 'Inspektur III', '', 8, 1, 1),
(26, 6, 'Inspektur IV', '', 8, 1, 1),
(27, 6, 'Inspektur V', '', 8, 1, 1),
(28, 7, 'Sekretariat Direktorat Jenderal Perikanan Tangkap', 'Sesditjen Perikanan Tangkap', 8, 1, 1),
(29, 7, 'Direktorat Sumber Daya Ikan', '', 8, 1, 1),
(30, 7, 'Direktorat Kapal Perikanan dan Alat Penangkap Ikan', '', 8, 1, 1),
(31, 7, 'Direktorat Pelabuhan Perikanan', '', 8, 1, 1),
(32, 7, 'Direktorat Pengendalian Penangkapan Ikan', '', 8, 1, 1),
(33, 7, 'Direktorat Kenelayanan', '', 8, 1, 1),
(34, 8, 'Sekretariat Direktorat Jenderal Perikanan Budidaya', 'Sesditjen Perikanan Budidaya', 8, 1, 1),
(35, 8, 'Direktorat Kawasan Budidaya', '', 8, 1, 1),
(36, 8, 'Direktorat Perbenihan', '', 8, 1, 1),
(37, 8, 'Direktorat Pakan\r\n', '', 8, 1, 1),
(38, 8, 'Direktorat Kesehatan Ikan dan Lingkungan', '', 8, 1, 1),
(39, 8, 'Direktorat Produksi dan Usaha Budidaya', '', 8, 1, 1),
(40, 9, 'Sekretariat Direktorat Jenderal Penguatan Daya Saing Produk Kelautan dan Perikanan', 'Sesditjen PDSPKP', 8, 1, 1),
(41, 9, 'Direktorat Akses Pasar dan Promosi', '', 8, 1, 1),
(42, 9, 'Direktorat Bina Mutu dan Diversifikasi Produk Perikanan', '', 8, 1, 1),
(43, 9, 'Direktorat Bina Mutu dan Diversifikasi Produk Kelautan', '', 8, 1, 1),
(44, 9, 'Direktorat Sistem Logistik', '', 8, 1, 1),
(45, 9, 'Direktorat Pengembangan Investasi', '', 8, 1, 1),
(46, 10, 'Sekretariat Direktorat Jenderal Pengelolaan Ruang Laut', 'Sesditjen PRL', 8, 1, 1),
(47, 10, 'Direktorat Perencanaan Ruang Laut', '', 8, 1, 1),
(48, 10, 'Direktorat Pendayagunaan Pesisir', '', 8, 1, 1),
(49, 10, 'Direktorat Pendayagunaan Pulau-Pulau Kecil', '', 8, 1, 1),
(50, 10, 'Direktorat Jasa Kelautan', '', 8, 1, 1),
(51, 10, 'Direktorat Konservasi dan Keanekaragaman Hayati Laut', '', 8, 1, 1),
(52, 11, 'Sekretariat Direktorat Jenderal Pengawasan Sumber Daya Kelautan dan Perikanan', 'Sesditjen PSDKP', 8, 1, 1),
(53, 11, 'Direktorat Pemantauan dan Peningkatan Infrastruktur', '', 8, 1, 1),
(54, 11, 'Direktorat Pengawasan Pengelolaan Sumber Daya Kelautan', '', 8, 1, 1),
(55, 11, 'Direktorat Pengawasan Pengelolaan SUmber Daya Perikanan', '', 8, 1, 1),
(56, 11, 'Direktorat Pengoperasian Kapal Pengawas', '', 8, 1, 1),
(57, 11, 'Direktorat Penanganan Pelanggaran', '', 8, 1, 1),
(58, 12, 'Sekretariat Badan Penelitan dan Pengembangan Kelautan Perikanan', 'Sesbalitbang KP', 8, 1, 1),
(59, 12, 'Pusat Penelitian dan Pengembangan Perikanan', '', 8, 1, 1),
(60, 12, 'Pusat Penelitian dan Pengembangan Sumber Daya Laut dan Pesisir', '', 8, 1, 1),
(61, 12, 'Pusat Penelitian dan Pengembangan Daya Saing Produk dan Bioteknologi Kelautan dan Perikanan', '', 8, 1, 1),
(62, 12, 'Pusat Penelitian Sosial Ekonomi Kelautan dan Perikanan', '', 8, 1, 1),
(63, 13, 'Sekretariat Badan Pengembangan Sumber Daya Manusia dan Pemberdayaan Masyarakat Kelautan dan Perikanan', '', 8, 1, 1),
(64, 13, 'Pusat Pendidikan Kelautan dan Perikanan', '', 8, 1, 1),
(65, 13, 'Pusat Pelatihan Kelautan dan Perikanan', '', 8, 1, 1),
(66, 13, 'Pusat Penyuluhan dan Pemberdayaan Masyarakat Kelautan dan Perikanan', '', 8, 1, 1),
(67, 14, 'Sekretariat Badan Karantina Ikan, Pengendalian Mutu, dan Keamanan Hasil Perikanan', 'Sekretariat BKPIM', 8, 1, 1),
(68, 14, 'Pusat Karantina dan Keamanan Hayati Ikan', '', 8, 1, 1),
(69, 14, 'Pusat Sertifikasi Mutu dan Keamanan Hasil Perikanan', '', 8, 1, 1),
(70, 14, 'Pusat Standardisasi, Kepatuhan, dan Kerja Sama', '', 8, 1, 1),
(71, 1, 'Majelis Permusyawaratan Rakyat', 'MPR', 2, 1, 1),
(72, 1, 'Dewan Perwakilan Rakyat', 'DPR', 2, 1, 1),
(73, 1, 'Badan Pemeriksa Keuangan', 'BPK', 2, 1, 1),
(74, 1, 'Mahkamah Agung', 'MA', 2, 1, 1),
(75, 1, 'Kejaksaan Republik Indonesia', 'Kejaksaan', 2, 1, 1),
(76, 1, 'Kementerian Sekretariat Negara', 'Kemensetneg', 2, 1, 1),
(77, 1, 'Kementerian Dalam Negeri', 'Kemendagri', 2, 1, 1),
(78, 1, 'Kementerian Luar Negeri', 'Kemenlu', 2, 1, 1),
(79, 1, 'Kementerian Pertahanan', 'Kemenhan', 2, 1, 1),
(80, 1, 'Kementerian Hukum dan Hak Asasi Manusia Republik Indonesia', 'Kemenkumham RI', 2, 1, 1),
(81, 1, 'Kementerian Keuangan', 'Kemenkeu', 2, 1, 1),
(82, 1, 'Kementerian Pertanian', 'Kementan', 2, 1, 1),
(83, 1, 'Kementerian Perindustrian', 'Kemenperin', 2, 1, 1),
(84, 1, 'Kementerian Energi dan Sumber Daya Mineral', 'Kemen ESDM', 2, 1, 1),
(85, 1, 'Kementerian Perhubungan', 'Kemenhub', 2, 1, 1),
(86, 1, 'Kementerian Pendidikan dan Kebudayaan', 'Kemendikbud', 2, 1, 1),
(87, 1, 'Kementerian Kesehatan', 'Kemenkes', 2, 1, 1),
(88, 1, 'Kementerian Agama', 'Kemenag', 2, 1, 1),
(89, 1, 'Kementerian Ketenagakerjaan', 'Kemenaker', 2, 1, 1),
(90, 1, 'Kementerian Sosial', 'Kemensos', 2, 1, 1),
(91, 1, 'Kementerian Lingkungan Hidup dan Kehutanan', 'Kemen LH dan Kehutanan', 2, 1, 1),
(93, 1, 'Kementerian Pekerjaan Umum dan Perumahan Rakyat', 'Kemen PU-Pera', 2, 1, 1),
(94, 1, 'Kementerian Koordinator Bidang Politik, Hukum dan Keamanan', 'Kemenkopolhukam', 2, 1, 1),
(95, 1, 'Kementerian Koordinator Bidang Perekonomian', 'Kemenko Eko', 2, 1, 1),
(96, 1, 'Kementerian Koordinator Bidang Pembangunan Manusia dan Kebudayaan', 'Kemenko PM dan Kebudayaan', 2, 1, 1),
(97, 1, 'Kementerian Pariwisata', 'Kemenpar', 2, 1, 1),
(98, 1, 'Kementerian Badan Usaha Milik Negara', 'Kemen BUMN', 2, 1, 1),
(99, 1, 'Kementerian Ristek dan Pendidikan Tinggi', 'Kemenristek dan Dikti', 2, 1, 1),
(100, 1, 'Kementerian Koperasi dan Pengusaha Kecil dan Menengah', 'Kemen KUKM', 2, 1, 1),
(101, 1, 'Kementerian Pemberdayaan Perempuan dan Perlindungan Anak', 'Kemen PPPA', 2, 1, 1),
(102, 1, 'Kementerian Pendayagunaan Aparatur Negara dan Reformasi Birokrasi', 'Kemen PAN-RB', 2, 1, 1),
(103, 1, 'Badan Intelijen Negara ', 'BIN', 2, 1, 1),
(104, 1, 'Lembaga Sandi Negara', 'Lemsaneg', 2, 1, 1),
(105, 1, 'Dewan Ketawahan Nasional', 'Wantannas', 2, 1, 1),
(106, 1, 'Badan Pusat Statistik', 'BPS', 2, 1, 1),
(107, 1, 'Kementerian Perencanaan Pembangunan Nasional / Badan Perencanaan Pembangunan Nasional', 'Kemen PPN / Bappenas', 2, 1, 1),
(108, 1, 'Kementerian Agraria dan Tata Ruang / BPN', 'Kemen Agraria dan Tata Ruang / BPN', 2, 1, 1),
(109, 1, 'Perpustakaan Nasional Republik Indonesia', 'Perpusnas RI', 2, 1, 1),
(110, 1, 'Kementerian Komunikasi dan Informatika', 'Kemenkominfo', 2, 1, 1),
(111, 1, 'Kepolisian Negara Republik Indonesia', 'Polri', 2, 1, 1),
(112, 1, 'Badan Pengawasa Obat dan Makanan', 'BPOM', 2, 1, 1),
(113, 1, 'Lembaga Ketahanan Nasional', 'Lemhanas', 2, 1, 1),
(114, 1, 'Badan Koordinasi Penanaman Modal', 'BKPM', 2, 1, 1),
(115, 1, 'Badan Narkotika Nasional', 'BNN', 2, 1, 1),
(116, 1, 'Kementerian Desa, PDT dan Transmigrasi', 'Kemendes PDT dan Transmigrasi', 2, 1, 1),
(117, 1, 'Badan Kependudukan dan Keluarga Berencana Nasional', 'BKKBN', 2, 1, 1),
(118, 1, 'Komisi Nasional Hak Asasi Manusia', 'Komnasham', 2, 1, 1),
(119, 1, 'Badan Meteorologi, Klimatologi, dan Geofisika', 'BMKG', 2, 1, 1),
(120, 1, 'Komisi Pemilihan Umum', 'KPU', 2, 1, 1),
(121, 1, 'Mahkamah Konstitusi Republik Indonesia', 'MK', 2, 1, 1),
(122, 1, 'Pusat Pelaporan dan Analisa Transaksi Keuangan', 'PPATK', 2, 1, 1),
(123, 1, 'Lembaga Ilmu Pengetahuan Indonesia', 'LIPI', 2, 1, 1),
(124, 1, 'Batan Tenaga Nuklir Nasional', 'Batan', 2, 1, 1),
(125, 1, 'Badan Pengkajian dan Penerapan Teknologi', 'BPPT', 2, 1, 1),
(126, 1, 'Lembaga Penerbangan dan Antariksa Nasional', 'LAPAN', 2, 1, 1),
(127, 1, 'Badan Informasi Geospasial', 'BIG', 2, 1, 1),
(128, 1, 'Badan Strandarisasi Nasional', 'BSN', 2, 1, 1),
(129, 1, 'Badan Pengawas Tenaga Nuklir', 'Bapeten', 2, 1, 1),
(130, 1, 'Lembaga Administrasi Negara', 'LAN', 2, 1, 1),
(131, 1, 'Arsip Nasional Republik Indonesia', 'ANRI', 2, 1, 1),
(132, 1, 'Badan Kepegawaian Negara', 'BKN', 2, 1, 1),
(133, 1, 'Badan Pengawas Keuangan dan Pembangunan', 'BPKP', 2, 1, 1),
(134, 1, 'Kementerian Pergadangan', 'Kemendag', 2, 1, 1),
(135, 1, 'Kementerian Pemudan dan Olahraga', 'Kemenpora', 2, 1, 1),
(136, 1, 'Komisi Pemberantasan Korupsi', 'KPK', 2, 1, 1),
(137, 1, 'Dewan Perwakilan Daerah', 'DPD', 2, 1, 1),
(138, 1, 'Komisi Yudisial Republik Indonesia', 'KY', 2, 1, 1),
(139, 1, 'Badan Nasional Penanggulangan Bencana', 'BNPB', 2, 1, 1),
(140, 1, 'Badan Nasional Penempatan dan Perlindungan Tenaga Kerja Indonesia', 'BNP2TKI', 2, 1, 1),
(141, 1, 'Badan Penanggulangan Lumpur Sidoarjo', 'BPLS', 2, 1, 1),
(142, 1, 'Lembaga Kebijakan Pengadaan Barang/Jasa Pemerintah', 'LKPP', 2, 1, 1),
(143, 1, 'Badan SAR Nasional', 'Basarnas', 2, 1, 1),
(144, 1, 'Komisi Pengawas Persaingan Usaha', 'KPPU', 2, 1, 1),
(145, 1, 'Badan Pengembangan Wilayah Suramadu', 'BPWS', 2, 1, 1),
(146, 1, 'Ombudsman Republik Indonesia', 'ORI', 2, 1, 1),
(147, 1, 'Badan Nasional Pengelola Perbatasan', 'BNPP', 2, 1, 1),
(148, 1, 'Badan Pengusahaan Kawasan Perdagangan Bebas dan Pelabuhan Bebas Batam', 'BP Batam', 2, 1, 1),
(149, 1, 'Badan Nasional Penanggulangan Terorisme', 'BNPT', 2, 1, 1),
(150, 1, 'Sekretariat Kabinet', 'Setkab', 2, 1, 1),
(151, 1, 'Badan Pengawas Pemilihan Umum', 'Bawaslu', 2, 1, 1),
(152, 1, 'Lembaga Penyiaran Publik Radio Republik Indonesia', 'LPP RRI', 2, 1, 1),
(153, 1, 'Lembaga Penyiaran Publik Televisi Republik Indonesia', 'LPP TVRI', 2, 1, 1),
(154, 1, 'Badan Pengusahaan Kawasan Perdagangan Bebas dan Pelabuhan Bebas Sabang', 'BP Sabang', 2, 1, 1),
(155, 1, 'Kementerian Koordinator Bidang Kemaritiman', 'Kemenko Maritim', 2, 1, 1),
(156, 77, 'Pemerintah Aceh', 'Aceh', 3, 1, 1),
(157, 77, 'Pemerintah Provinsi Sumatera Utara', 'Sumut', 3, 1, 1),
(158, 77, 'Pemerintah Provinsi Sumatera Barat', 'Sumbar', 3, 1, 1),
(159, 77, 'Pemerintah Provinsi Riau', 'Riau', 3, 1, 1),
(160, 77, 'Pemerintah Provinsi Kepulauan Riau', 'Kepri', 3, 1, 1),
(161, 77, 'Pemerintah Provinsi Jambi', 'Jambi', 3, 1, 1),
(162, 77, 'Pemerintah Provinsi Bengkulu', 'Bengkulu', 3, 1, 1),
(163, 77, 'Pemerintah Provinsi Sumatera Selatan', 'Sumsel', 3, 1, 1),
(164, 77, 'Pemerintah Provinsi Kepulauan Bangka Belitung', 'Babel', 3, 1, 1),
(165, 77, 'Pemerintah Provinsi Lampung', 'Lampung', 3, 1, 1),
(166, 77, 'Pemerintah Provinsi Banten', 'Banten', 3, 1, 1),
(167, 77, 'Pemerintah Provinsi Jawa Barat', 'Jabar', 3, 1, 1),
(168, 77, 'Pemerintah Provinsi DKI Jakarta', 'DKI Jakarta', 3, 1, 1),
(169, 77, 'Pemerintah Provinsi Jawa Tengah', 'Jateng', 3, 1, 1),
(170, 77, 'Pemerintah Provinsi Jawa Timur', 'Jatim', 3, 1, 1),
(171, 77, 'Pemerintah Provinsi DI Yogyakarta', 'DIY', 3, 1, 1),
(172, 77, 'Pemerintah Provinsi Bali', 'Bali', 3, 1, 1),
(173, 77, 'Pemerintah Provinsi Nusa Tenggara Barat', 'NTB', 3, 1, 1),
(174, 77, 'Pemerintah Provinsi Nusa Tenggara Timur', 'NTT', 3, 1, 1),
(175, 77, 'Pemerintah Provinsi Kalimantan Barat', 'Kalbar', 3, 1, 1),
(176, 77, 'Pemerintah Provinsi Kalimantan Selatan', 'Kalsel', 3, 1, 1),
(177, 77, 'Pemerintah Provinsi Tengah', 'Kalteng', 3, 1, 1),
(178, 77, 'Pemerintah Provinsi Timur', 'Kaltim', 3, 1, 1),
(179, 77, 'Pemerintah Provinsi Utara', 'Kaltara', 3, 1, 1),
(180, 77, 'Pemerintah Provinsi Gorontalo', 'Gorontalo', 3, 1, 1),
(181, 77, 'Pemerintah Provinsi Sulawesi Selatan', 'Sulsel', 3, 1, 1),
(182, 77, 'Pemerintah Provinsi Sulawesi Tenggara', 'Sultra', 3, 1, 1),
(183, 77, 'Pemerintah Provinsi Sulawesi Tengah', 'Sulteng', 3, 1, 1),
(184, 77, 'Pemerintah Provinsi Sulawesi Utara', 'Sulut', 3, 1, 1),
(185, 77, 'Pemerintah Provinsi Sulawesi Barat', 'Sulbar', 3, 1, 1),
(186, 77, 'Pemerintah Provinsi Maluku', 'Maluku', 3, 1, 1),
(187, 77, 'Pemerintah Provinsi Maluku Utara', 'Malut', 3, 1, 1),
(188, 77, 'Pemerintah Provinsi Papua', 'Papua', 3, 1, 1),
(189, 77, 'Pemerintah Provinsi Papua Barat', 'Papua Barat', 3, 1, 1),
(190, 2, 'Unit Kerja Eselon 1', 'Es1', 7, 1, 1),
(191, 2, 'Unit Kerja Eselon 1', 'Es1', 7, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `domains_type`
--

CREATE TABLE `domains_type` (
  `id` tinyint(4) NOT NULL,
  `name` varchar(100) NOT NULL,
  `is_active` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `domains_type`
--

INSERT INTO `domains_type` (`id`, `name`, `is_active`) VALUES
(1, 'Negara', 1),
(2, 'Kementerian-Lembaga', 1),
(3, 'Pemerintah Provinsi', 1),
(4, 'Pemerintah Kabupaten/Kota', 1),
(5, 'Badan Usaha Milik Negara', 1),
(6, 'Badan Usaha Milik Daerah', 1),
(7, 'Unit Kerja Esselon I K/L Atau Setingkat', 1),
(8, 'Unit Kerja Esselon II K/L Atau Setingkat', 1),
(9, 'Unit Kerja Esselon III K/L Atau Setingkat', 1),
(10, 'Unit Kerja Esselon IV K/L Atau Setingkat', 1),
(11, 'Unit Kerja Esselon I Pemerintah Provinsi Atau Setingkat', 1),
(12, 'Unit Kerja Esselon II Pemerintah Provinsi Atau Setingkat', 1),
(13, 'Unit Kerja Esselon III Pemerintah Provinsi Atau Setingkat', 1),
(14, 'Unit Kerja Esselon IV Pemerintah Provinsi Atau Setingkat', 1),
(15, 'Unit Kerja Esselon I Pemerintah Kabupaten/Kota Atau Setingkat', 1),
(16, 'Unit Kerja Esselon II Pemerintah Kabupaten/Kota Atau Setingkat', 1),
(17, 'Unit Kerja Esselon III Pemerintah Kabupaten/Kota Atau Setingkat', 1),
(18, 'Unit Kerja Esselon IV Pemerintah Kabupaten/Kota Atau Setingkat', 1),
(19, 'Perusahaan Swasta', 1),
(20, 'Lainnya', 1),
(21, 'Unit Kerja Adhock', 1);

-- --------------------------------------------------------

--
-- Table structure for table `login_attempts`
--

CREATE TABLE `login_attempts` (
  `id` int(11) NOT NULL,
  `ip_address` varchar(40) COLLATE utf8_bin NOT NULL,
  `login` varchar(50) COLLATE utf8_bin NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `logs`
--

CREATE TABLE `logs` (
  `id` int(11) NOT NULL,
  `timestamp` datetime NOT NULL,
  `monitor_ukuran_checkpoint_id` int(11) NOT NULL,
  `capaian` float NOT NULL,
  `realisasi_keuangan` float DEFAULT '0',
  `realisasi_fisik` float DEFAULT '0',
  `keterangan` text NOT NULL,
  `log_ref_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `is_active` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `log_ref`
--

CREATE TABLE `log_ref` (
  `id` int(11) NOT NULL,
  `key_name` varchar(200) NOT NULL,
  `name` varchar(200) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `log_ref`
--

INSERT INTO `log_ref` (`id`, `key_name`, `name`, `status`) VALUES
(1, 'monitor_ukuran_checkpoint_lapor', 'Mengirim laporan capaian', 1),
(2, 'monitor_ukuran_checkpoint_verifikasi', 'Verifikasi laporan capaian', 1),
(3, 'monitor_ukuran_checkpoint_lapor_update', 'Memperbarui laporan capaian', 1),
(4, 'monitor_ukuran_checkpoint_verifikasi_update', 'Memperbarui verifikasi laporan capaian', 1),
(5, 'monitor_ukuran_checkpoint_lapor_req', 'Permohonan laporan capaian susulan', 1),
(6, 'monitor_ukuran_checkpoint_approval', 'Laporan susulan telah disetujui', 1),
(7, 'monitor_ukuran_checkpoint_verifikasi_req', 'Permohonan verifikasi laporan capaian susulan', 1);

-- --------------------------------------------------------

--
-- Table structure for table `monitor`
--

CREATE TABLE `monitor` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `name_code` varchar(5) NOT NULL,
  `monitor_type_id` tinyint(4) NOT NULL,
  `verifikator_domains_id` text NOT NULL,
  `observer_domains_id` text,
  `is_active` tinyint(4) NOT NULL DEFAULT '1',
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '1:Pengisian,2:Lapor,3:Arsip'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `monitor_checkpoint`
--

CREATE TABLE `monitor_checkpoint` (
  `id` int(11) NOT NULL,
  `monitor_id` int(11) NOT NULL,
  `year` int(11) NOT NULL,
  `month` int(11) NOT NULL,
  `week` int(11) DEFAULT NULL,
  `date_open` date NOT NULL,
  `date_close` date NOT NULL,
  `status` tinyint(4) NOT NULL,
  `is_active` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `monitor_kriteria`
--

CREATE TABLE `monitor_kriteria` (
  `id` int(11) NOT NULL,
  `renaksi_id` int(11) NOT NULL,
  `name` text NOT NULL,
  `penanggung_jawab` int(11) NOT NULL,
  `instansi_terkait` text NOT NULL,
  `is_active` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `monitor_lampiran`
--

CREATE TABLE `monitor_lampiran` (
  `id` int(11) NOT NULL,
  `monitor_ukuran_checkpoint_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `created` datetime NOT NULL,
  `is_active` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `monitor_prioritas`
--

CREATE TABLE `monitor_prioritas` (
  `id` int(11) NOT NULL,
  `monitor_id` int(11) NOT NULL,
  `name` text NOT NULL,
  `serial` int(11) NOT NULL,
  `is_active` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `monitor_program`
--

CREATE TABLE `monitor_program` (
  `id` int(11) NOT NULL,
  `prioritas_id` int(11) NOT NULL,
  `name` text NOT NULL,
  `serial` int(11) NOT NULL,
  `is_active` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `monitor_renaksi`
--

CREATE TABLE `monitor_renaksi` (
  `id` int(11) NOT NULL,
  `program_id` int(11) NOT NULL,
  `domains_id` int(11) DEFAULT NULL,
  `name` text NOT NULL,
  `serial` int(11) NOT NULL,
  `is_active` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `monitor_type`
--

CREATE TABLE `monitor_type` (
  `id` tinyint(4) NOT NULL,
  `name` varchar(25) NOT NULL,
  `is_active` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `monitor_type`
--

INSERT INTO `monitor_type` (`id`, `name`, `is_active`) VALUES
(1, 'Kinerja Program (F8K)', 1);

-- --------------------------------------------------------

--
-- Table structure for table `monitor_ukuran`
--

CREATE TABLE `monitor_ukuran` (
  `id` int(11) NOT NULL,
  `kriteria_id` int(11) NOT NULL,
  `name` text NOT NULL,
  `anggaran` bigint(20) NOT NULL DEFAULT '0',
  `serial` int(11) NOT NULL DEFAULT '1',
  `type` tinyint(4) DEFAULT '1' COMMENT '1=f8k,2=f8k extend',
  `finish` int(11) NOT NULL DEFAULT '0',
  `finish_on` int(11) DEFAULT NULL,
  `is_active` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `monitor_ukuran_checkpoint`
--

CREATE TABLE `monitor_ukuran_checkpoint` (
  `id` int(11) NOT NULL,
  `ukuran_id` int(11) NOT NULL,
  `checkpoint_id` int(11) NOT NULL,
  `name` text NOT NULL,
  `target_keuangan` float DEFAULT '0',
  `realisasi_keuangan` float DEFAULT '0',
  `target_fisik` float DEFAULT '0',
  `realisasi_fisik` float DEFAULT '0',
  `capaian` float DEFAULT '0',
  `keterangan` text,
  `status` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `role` varchar(255) NOT NULL,
  `default` tinyint(2) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `role`, `default`) VALUES
(1, 'Administrator', 0),
(2, 'Verifikator Seluruh Monitor', 0),
(3, 'Verifikator Kinerja Progam (F8K)', 0),
(4, 'Verifikator Kinerja Anggaran', 0),
(5, 'Pelapor Kinerja Program (F8K)', 0),
(6, 'Pelapor Kinerja Anggaran', 0),
(7, 'Pemantau', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tmp_monitor_lampiran`
--

CREATE TABLE `tmp_monitor_lampiran` (
  `id` int(11) NOT NULL,
  `monitor_ukuran_checkpoint_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `created` datetime NOT NULL,
  `status` tinyint(4) NOT NULL COMMENT '0: tmp, 1:sync'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tmp_monitor_lampiran`
--

INSERT INTO `tmp_monitor_lampiran` (`id`, `monitor_ukuran_checkpoint_id`, `user_id`, `name`, `created`, `status`) VALUES
(210, 351, 0, '201609_F8K_Draft_Laporan_Perkembangan_Pengadaan_API_dan_kapal2.pdf', '2016-10-04 03:54:39', 0),
(211, 351, 0, '201609_F8K_KAPI_Data_Dukung_F8K_Kapal2.pdf', '2016-10-04 03:54:39', 0),
(297, 607, 0, '15._Updating_survey_dart_WPP_714_Triwulan_III.pdf', '2016-10-05 09:49:32', 0),
(320, 0, 0, '201612_F8K_Kapal_Rekap.pdf', '2017-01-04 12:23:03', 0),
(321, 0, 0, '201612_F8K_FOTO_3GT.pdf', '2017-01-04 12:24:11', 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) COLLATE utf8_bin NOT NULL,
  `password` varchar(255) COLLATE utf8_bin NOT NULL,
  `email` varchar(100) COLLATE utf8_bin NOT NULL,
  `role_id` int(11) NOT NULL,
  `activated` tinyint(1) NOT NULL DEFAULT '1',
  `banned` tinyint(1) NOT NULL DEFAULT '0',
  `ban_reason` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `new_password_key` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `new_password_requested` datetime DEFAULT NULL,
  `new_email` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `new_email_key` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `last_ip` varchar(40) COLLATE utf8_bin NOT NULL,
  `last_login` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `role_id`, `activated`, `banned`, `ban_reason`, `new_password_key`, `new_password_requested`, `new_email`, `new_email_key`, `last_ip`, `last_login`, `created`, `modified`) VALUES
(1, 'admin', '$P$BFZfpGfqJdkPsIuAyL/4joXCjN48cG.', 'admin@abc.go.id', 1, 1, 0, NULL, NULL, NULL, NULL, NULL, '::1', '2018-08-07 15:02:43', '2015-03-16 15:04:00', '2018-08-07 15:02:43');

-- --------------------------------------------------------

--
-- Table structure for table `user_autologin`
--

CREATE TABLE `user_autologin` (
  `key_id` char(32) COLLATE utf8_bin NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `user_agent` varchar(150) COLLATE utf8_bin NOT NULL,
  `last_ip` varchar(40) COLLATE utf8_bin NOT NULL,
  `last_login` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `user_autologin`
--

INSERT INTO `user_autologin` (`key_id`, `user_id`, `user_agent`, `last_ip`, `last_login`) VALUES
('0c2f5cc90b053cbef52b132f8c51ad68', 7, 'Mozilla/5.0 (Windows NT 6.1; rv:40.0) Gecko/20100101 Firefox/40.0', '10.20.102.45', '2015-09-10 04:27:14'),
('0e81731014f0418cd186456595114198', 38, 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/50.0.2661.102 Safari/537.36', '10.31.173.206', '2016-05-25 02:30:29'),
('0ed2b7a3f6b08a3bf23a4515991633bf', 36, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.96 Safari/537.36', '10.30.209.81', '2017-05-04 07:03:03'),
('103b22a6e42b3bade74d9cbe30bb6746', 37, 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/55.0.2883.87 Safari/537.36', '10.0.206.7', '2017-01-04 06:33:38'),
('11c928de1fdcaf865339836d16700853', 7, 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:45.0) Gecko/20100101 Firefox/45.0', '202.62.16.154', '2016-02-18 06:38:58'),
('13c08876cd48e7f8fdf9365f880be5b0', 39, 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/51.0.2704.103 Safari/537.36', '183.91.70.2', '2016-07-22 01:29:48'),
('13c2785b95e353f9fdcb639a7b6e65fe', 39, 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/51.0.2704.103 Safari/537.36', '183.91.70.2', '2016-06-29 01:46:27'),
('2468f21b80fe612dcb6857911afe3c78', 24, 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_10_5) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/53.0.2785.143 Safari/537.36', '192.168.12.253', '2016-11-10 07:04:10'),
('2cbc6efe701e4840a98b166b3e75652a', 35, 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:46.0) Gecko/20100101 Firefox/46.0', '10.30.214.79', '2016-05-24 01:33:41'),
('35272d837eac85eedcd981156629999d', 34, 'Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 6.1; Trident/4.0; GTB7.5; SLCC2; .NET CLR 2.0.50727; .NET CLR 3.5.30729; .NET CLR 3.0.30729; Media Cent', '10.50.11.89', '2016-04-06 07:20:49'),
('37a2994236ceaa6146241b0d6ec5ef7a', 24, 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_10_5) AppleWebKit/601.7.7 (KHTML, like Gecko) Version/9.1.2 Safari/601.7.7', '114.4.79.102', '2016-07-22 16:06:30'),
('3f56f6ecd1613526b9495e4884ceb1f4', 37, 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/56.0.2924.87 Safari/537.36 OPR/43.0.2442.1144', '10.0.206.7', '2017-03-22 01:18:54'),
('41909f3a9c0a59241f7eebbdb8920102', 33, 'Mozilla/5.0 (Windows NT 10.0) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/49.0.2623.110 Safari/537.36', '172.16.25.4', '2016-04-06 00:38:48'),
('41f46b40650fe41c478349a763cb9707', 34, 'Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.36', '10.50.11.103', '2017-06-16 02:01:48'),
('45e051d7429d761dd78d23bdc972adc7', 33, 'Mozilla/5.0 (Windows NT 10.0) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/49.0.2623.87 Safari/537.36', '172.16.25.4', '2016-03-22 02:09:02'),
('47367f28f475e885df6f3982089ffd2b', 33, 'Mozilla/5.0 (Windows NT 10.0) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/42.0.2311.135 Safari/537.36 Edge/12.10240', '172.16.25.4', '2016-03-30 00:48:52'),
('495c9533708378dd6918025fce968310', 28, 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/48.0.2564.116 Safari/537.36', '10.20.108.45', '2016-03-07 01:39:32'),
('4eef9693285d703cee6b5be7178b5568', 37, 'Mozilla/5.0 (Windows NT 6.2; WOW64; rv:12.0) Gecko/20100101 Firefox/12.0', '10.0.206.166', '2016-08-12 00:26:32'),
('4f132fa1718207ce1296516bd874c297', 34, 'Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/59.0.3071.115 Safari/537.36', '10.50.11.103', '2017-07-25 00:58:45'),
('589191576ca4efa7e8c39d4fa0cba047', 32, 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:50.0) Gecko/20100101 Firefox/50.0', '10.0.212.20', '2017-01-12 00:36:46'),
('6677f48897e53cf49cb3ddfd922d08d4', 33, 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/55.0.2883.87 Safari/537.36', '172.16.25.4', '2017-01-04 05:36:50'),
('66b2f380e6d17286555fbe5b381cb855', 32, 'Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US; rv:1.9.0.19) Gecko/2010031422 Firefox/3.0.19', '10.0.212.14', '2016-04-05 05:58:41'),
('6bacb53188d0528c4190af6f649de18a', 36, 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/48.0.2564.116 Safari/537.36', '10.30.211.97', '2016-03-07 06:03:24'),
('6cee7d17cf5b7eded7bb9a4576321e55', 24, 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_10_5) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/53.0.2785.116 Safari/537.36', '10.20.108.39', '2016-10-19 01:32:11'),
('7752cb1fc5c7db2845a5291834cd45d0', 7, 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/43.0.2357.124 Safari/537.36', '10.20.105.6', '2016-04-08 07:20:46'),
('786bebd8ba789ffdd57dbc001f19c1c5', 34, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/48.0.2564.116 Safari/537.36', '10.50.11.40', '2016-03-07 04:41:05'),
('7dcaa8e5022bd750e53bd4e3106c3cfc', 33, 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/49.0.2623.87 Safari/537.36', '36.77.198.227', '2016-03-29 07:40:13'),
('8025615b73a9ad9ef2298eaf7ef06fdc', 27, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:59.0) Gecko/20100101 Firefox/59.0', '10.20.108.86', '2018-05-14 09:41:28'),
('806825e2b4ef455ce34817f5f5fca3d4', 33, 'Mozilla/5.0 (Windows NT 10.0) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/49.0.2623.110 Safari/537.36', '10.21.117.44', '2016-04-07 06:55:46'),
('84b31b7f737b09093338140008c4612c', 39, 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/55.0.2883.87 Safari/537.36', '183.91.70.2', '2017-01-05 00:22:32'),
('856e63731e711126de9ad027b2c1c4b2', 39, 'Mozilla/5.0 (Windows NT 6.3; WOW64; Trident/7.0; Touch; rv:11.0) like Gecko', '183.91.70.2', '2016-10-04 09:49:53'),
('8751e1dc2dd6219298b6c2de22d40272', 37, 'Mozilla/5.0 (Windows NT 6.2; WOW64; rv:12.0) Gecko/20100101 Firefox/12.0', '10.0.206.2', '2016-09-28 01:41:12'),
('8abfe793e8eec031c557a5717942c4e8', 33, 'Mozilla/5.0 (Linux; Android 5.1.1; C6903 Build/14.6.A.1.236) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/48.0.2564.95 Mobile Safari/537.36', '64.233.173.113', '2016-03-29 00:30:37'),
('8b416ce4f0ca3e63e32ef8d789872b96', 33, 'Mozilla/5.0 (Windows NT 10.0) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/49.0.2623.110 Safari/537.36', '36.77.203.56', '2016-04-04 04:43:53'),
('8e708eea3ac0b9c4bd5e71aa18da4ecc', 33, 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/49.0.2623.110 Safari/537.36', '10.50.5.12', '2016-04-07 06:17:28'),
('8fccede0fa1f54e3c9d3c137e36557cc', 33, 'Mozilla/5.0 (Windows NT 6.2; rv:20.0) Gecko/20100101 Firefox/20.0', '172.16.25.4', '2016-03-30 07:29:37'),
('904cf1c207a4b7fda19e12916d50b4a0', 47, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.101 Safari/537.36', '172.16.25.4', '2017-08-29 08:05:38'),
('994316d22858a2050e83102056ff6d23', 41, 'Mozilla/5.0 (Windows NT 6.2; rv:45.0) Gecko/20100101 Firefox/45.0', '10.50.4.26', '2016-04-22 02:16:27'),
('9bdb851a2f21542f5f229cae4fbcc5c3', 34, 'Mozilla/5.0 (Windows NT 6.1; rv:45.0) Gecko/20100101 Firefox/45.0', '10.50.11.89', '2016-03-29 03:23:21'),
('9ea290ee12cc7bebafcc29917f98319a', 38, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/50.0.2661.102 Safari/537.36', '118.96.76.251', '2016-05-24 09:41:29'),
('9f1d4cbe1279a6dc77ba9bb1562c759c', 35, 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/33.0.1734.5 Safari/537.36', '172.16.25.4', '2016-06-25 11:04:21'),
('a1769a0815f5e7e30fa54e10a62958b3', 24, 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_10_5) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/49.0.2623.110 Safari/537.36', '10.20.108.32', '2016-04-12 02:44:16'),
('a1e043a42c579f52b4a7c68eec304d7f', 22, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:47.0) Gecko/20100101 Firefox/47.0', '103.10.145.122', '2016-07-22 07:01:40'),
('a8ee6157b66e6c8e4923513d4a63d5e9', 32, 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/50.0.2661.102 Safari/537.36', '124.153.32.125', '2016-05-24 13:53:36'),
('aff173d33e707307502cbd01d9e579ed', 41, 'Mozilla/5.0 (Windows NT 6.2; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/53.0.2785.143 Safari/537.36', '10.50.4.27', '2016-10-25 02:59:05'),
('b70b736c010e48eb8ae4c2336cd2072d', 47, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.113 Safari/537.36', '172.16.25.4', '2017-09-26 07:10:17'),
('b9c7c670d959fac7ef6e4223fba497c2', 33, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/49.0.2623.75 Safari/537.36 OPR/36.0.2130.32', '36.70.7.5', '2016-03-31 02:21:47'),
('bf4e265e807badcafa430587704e8e73', 41, 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/55.0.2883.87 Safari/537.36', '10.50.4.28', '2017-01-06 02:34:04'),
('c0cdb7832a543fe53aa578169947c526', 33, 'Mozilla/5.0 (Windows NT 10.0; Trident/7.0; MATP; MATP; rv:11.0) like Gecko', '172.16.25.4', '2016-03-30 08:07:54'),
('c13f57e433b60374b53e43269ae55625', 24, 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_10_5) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/55.0.2883.95 Safari/537.36', '10.20.108.36', '2017-01-17 06:34:07'),
('c559cbc95e247bcbb17160a19ad5267a', 35, 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_10_3) AppleWebKit/600.5.17 (KHTML, like Gecko) Version/8.0.5 Safari/600.5.17', '112.215.63.15', '2016-05-26 05:31:26'),
('c599ff66fa9507a2f81785a0a5f2736a', 41, 'Mozilla/5.0 (Windows NT 6.2; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/55.0.2883.87 Safari/537.36', '10.50.4.27', '2016-12-22 02:59:15'),
('c5a4bf8f025cbb029188047fe3e3974b', 33, 'Mozilla/5.0 (Windows NT 10.0) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/51.0.2704.103 Safari/537.36', '36.70.5.133', '2016-07-12 01:02:11'),
('c80508371b7c316b65ebba04804e651f', 39, 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/53.0.2785.116 Safari/537.36', '183.91.70.2', '2016-09-27 23:38:59'),
('ccb2b097f0429074b192e8b996076d38', 37, 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/50.0.2661.102 Safari/537.36', '10.0.206.166', '2016-06-07 01:10:23'),
('cdecdd6ac1ce9d8cfdbbf6f637182ab0', 17, 'Mozilla/5.0 (Windows NT 10.0) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/45.0.2454.93 Safari/537.36', '36.71.167.119', '2015-09-29 09:26:51'),
('cdfd3122ca18e66ca4da3449c7597388', 32, 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:43.0) Gecko/20100101 Firefox/43.0', '222.165.217.27', '2016-11-19 11:03:17'),
('d315f0d91a358aaaac31d0844d2b7f9b', 47, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/59.0.3071.115 Safari/537.36', '172.16.25.4', '2017-07-27 04:16:28'),
('da2dd02726661396293537f97127621c', 47, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/62.0.3202.94 Safari/537.36', '103.93.190.4', '2017-11-16 04:14:19'),
('dbc84d56adf1d9a7fd178e066b638df1', 38, 'Mozilla/5.0 (Windows NT 6.1; rv:46.0) Gecko/20100101 Firefox/46.0', '114.121.232.78', '2016-05-26 04:28:38'),
('e184f74395e039ccc6c7a92a83f2d115', 34, 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/51.0.2704.103 Safari/537.36', '10.50.11.41', '2016-07-14 02:52:21'),
('e25afc1368e5fffa3fa7fa49c3c3e678', 22, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:49.0) Gecko/20100101 Firefox/49.0', '10.20.108.34', '2016-10-12 03:18:46'),
('e35a9f5998411e7980fb2ac4baf96bb8', 24, 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_10_5) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/55.0.2883.95 Safari/537.36', '140.0.121.149', '2017-01-12 11:47:33'),
('e8b4c7f746e4bc1e7212acff6445fbed', 22, 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/49.0.2623.110 Safari/537.36', '10.20.108.20', '2016-04-08 03:03:44'),
('eca6f381bf9f3190ba27a6d6cd9cfa47', 41, 'Mozilla/5.0 (Windows NT 6.2; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/54.0.2840.99 Safari/537.36', '10.50.4.27', '2016-12-09 06:45:19'),
('ecb01359104912c61b4895e6c2487528', 47, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/56.0.2924.87 Safari/537.36', '172.16.25.4', '2017-03-07 09:32:52'),
('fb1ba607fbcfeaa02a9903112fe9f441', 39, 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/49.0.2623.112 Safari/537.36', '111.94.164.182', '2016-04-14 21:54:38'),
('fd11454e8993fe61419a15af0b8fead6', 33, 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:43.0) Gecko/20100101 Firefox/43.0', '10.50.5.93', '2016-04-05 01:50:11');

-- --------------------------------------------------------

--
-- Table structure for table `user_profiles`
--

CREATE TABLE `user_profiles` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `domain_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `position` varchar(500) COLLATE utf8_bin DEFAULT NULL,
  `phone` varchar(15) COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `user_profiles`
--

INSERT INTO `user_profiles` (`id`, `user_id`, `domain_id`, `name`, `position`, `phone`) VALUES
(1, 1, 1, 'Admin Monev', '', '');

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_monitor_f8k`
-- (See below for the actual view)
--
CREATE TABLE `v_monitor_f8k` (
`monitor_id` int(11)
,`monitor_name` text
,`monitor_code` varchar(5)
,`monitor_type` tinyint(4)
,`monitor_observer` text
,`monitor_verifikator` text
,`monitor_status` tinyint(4)
,`prioritas_id` int(11)
,`prioritas_name` text
,`prioritas_serial` int(11)
,`prioritas_is_active` tinyint(4)
,`program_id` int(11)
,`program_name` text
,`program_serial` int(11)
,`program_is_active` tinyint(4)
,`renaksi_id` int(11)
,`renaksi_name` text
,`renaksi_domain_id` int(11)
,`renaksi_serial` int(11)
,`renaksi_is_active` tinyint(4)
,`kriteria_id` int(11)
,`kriteria_name` text
,`kriteria_penanggung_jawab` int(11)
,`kriteria_instansi_terkait` text
,`kriteria_is_active` tinyint(4)
,`ukuran_id` int(11)
,`ukuran_name` text
,`ukuran_type` tinyint(4)
,`ukuran_jumlah_anggaran` bigint(20)
,`ukuran_finish` int(11)
,`ukuran_finish_on` int(11)
,`ukuran_is_active` tinyint(4)
,`uc_id` int(11)
,`uc_name` text
,`uc_capaian` float
,`uc_keterangan` text
,`uc_status` tinyint(4)
,`uc_target_fisik` float
,`uc_target_keuangan` float
,`uc_realisasi_fisik` float
,`uc_realisasi_keuangan` float
,`mc_id` int(11)
,`mc_year` int(11)
,`mc_month` int(11)
,`mc_week` int(11)
,`mc_status` tinyint(4)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_monitor_f8k_`
-- (See below for the actual view)
--
CREATE TABLE `v_monitor_f8k_` (
`monitor_id` int(11)
,`monitor_name` text
,`monitor_code` varchar(5)
,`monitor_type` tinyint(4)
,`monitor_observer` text
,`monitor_verifikator` text
,`monitor_status` tinyint(4)
,`prioritas_id` int(11)
,`prioritas_name` text
,`prioritas_serial` int(11)
,`prioritas_is_active` tinyint(4)
,`program_id` int(11)
,`program_name` text
,`program_serial` int(11)
,`program_is_active` tinyint(4)
,`renaksi_id` int(11)
,`renaksi_name` text
,`renaksi_domain_id` int(11)
,`renaksi_serial` int(11)
,`renaksi_is_active` tinyint(4)
,`kriteria_id` int(11)
,`kriteria_name` text
,`kriteria_penanggung_jawab` int(11)
,`kriteria_instansi_terkait` text
,`kriteria_is_active` tinyint(4)
,`ukuran_id` int(11)
,`ukuran_name` text
,`ukuran_type` tinyint(4)
,`ukuran_jumlah_anggaran` bigint(20)
,`ukuran_finish` int(11)
,`ukuran_finish_on` int(11)
,`ukuran_is_active` tinyint(4)
,`uc_id` int(11)
,`uc_name` text
,`uc_capaian` float
,`uc_keterangan` text
,`uc_status` tinyint(4)
,`uc_target_fisik` float
,`uc_target_keuangan` float
,`uc_realisasi_fisik` float
,`uc_realisasi_keuangan` float
,`mc_id` int(11)
,`mc_year` int(11)
,`mc_month` int(11)
,`mc_week` int(11)
,`mc_status` tinyint(4)
);

-- --------------------------------------------------------

--
-- Structure for view `v_monitor_f8k`
--
DROP TABLE IF EXISTS `v_monitor_f8k`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_monitor_f8k`  AS  select `m`.`id` AS `monitor_id`,`m`.`name` AS `monitor_name`,`m`.`name_code` AS `monitor_code`,`m`.`monitor_type_id` AS `monitor_type`,`m`.`observer_domains_id` AS `monitor_observer`,`m`.`verifikator_domains_id` AS `monitor_verifikator`,`m`.`status` AS `monitor_status`,`pri`.`id` AS `prioritas_id`,`pri`.`name` AS `prioritas_name`,`pri`.`serial` AS `prioritas_serial`,`pri`.`is_active` AS `prioritas_is_active`,`pro`.`id` AS `program_id`,`pro`.`name` AS `program_name`,`pro`.`serial` AS `program_serial`,`pro`.`is_active` AS `program_is_active`,`r`.`id` AS `renaksi_id`,`r`.`name` AS `renaksi_name`,`r`.`domains_id` AS `renaksi_domain_id`,`r`.`serial` AS `renaksi_serial`,`r`.`is_active` AS `renaksi_is_active`,`k`.`id` AS `kriteria_id`,`k`.`name` AS `kriteria_name`,`k`.`penanggung_jawab` AS `kriteria_penanggung_jawab`,`k`.`instansi_terkait` AS `kriteria_instansi_terkait`,`k`.`is_active` AS `kriteria_is_active`,`u`.`id` AS `ukuran_id`,`u`.`name` AS `ukuran_name`,`u`.`type` AS `ukuran_type`,`u`.`anggaran` AS `ukuran_jumlah_anggaran`,`u`.`finish` AS `ukuran_finish`,`u`.`finish_on` AS `ukuran_finish_on`,`u`.`is_active` AS `ukuran_is_active`,`uc`.`id` AS `uc_id`,`uc`.`name` AS `uc_name`,`uc`.`capaian` AS `uc_capaian`,`uc`.`keterangan` AS `uc_keterangan`,`uc`.`status` AS `uc_status`,`uc`.`target_fisik` AS `uc_target_fisik`,`uc`.`target_keuangan` AS `uc_target_keuangan`,`uc`.`realisasi_fisik` AS `uc_realisasi_fisik`,`uc`.`realisasi_keuangan` AS `uc_realisasi_keuangan`,`mc`.`id` AS `mc_id`,`mc`.`year` AS `mc_year`,`mc`.`month` AS `mc_month`,`mc`.`week` AS `mc_week`,`mc`.`status` AS `mc_status` from (((((((`monitor_ukuran_checkpoint` `uc` join `monitor_ukuran` `u` on((`uc`.`ukuran_id` = `u`.`id`))) join `monitor_kriteria` `k` on((`u`.`kriteria_id` = `k`.`id`))) join `monitor_renaksi` `r` on((`k`.`renaksi_id` = `r`.`id`))) join `monitor_program` `pro` on((`r`.`program_id` = `pro`.`id`))) join `monitor_prioritas` `pri` on((`pro`.`prioritas_id` = `pri`.`id`))) join `monitor` `m` on((`pri`.`monitor_id` = `m`.`id`))) join `monitor_checkpoint` `mc` on((`uc`.`checkpoint_id` = `mc`.`id`))) where ((`u`.`is_active` = 1) and (`k`.`is_active` = 1) and (`r`.`is_active` = 1) and (`pro`.`is_active` = 1) and (`pri`.`is_active` = 1) and (`m`.`is_active` = 1) and (`mc`.`is_active` = 1)) ;

-- --------------------------------------------------------

--
-- Structure for view `v_monitor_f8k_`
--
DROP TABLE IF EXISTS `v_monitor_f8k_`;

CREATE ALGORITHM=UNDEFINED DEFINER=`kkpmonev`@`192.168.12.58` SQL SECURITY DEFINER VIEW `v_monitor_f8k_`  AS  select `m`.`id` AS `monitor_id`,`m`.`name` AS `monitor_name`,`m`.`name_code` AS `monitor_code`,`m`.`monitor_type_id` AS `monitor_type`,`m`.`observer_domains_id` AS `monitor_observer`,`m`.`verifikator_domains_id` AS `monitor_verifikator`,`m`.`status` AS `monitor_status`,`pri`.`id` AS `prioritas_id`,`pri`.`name` AS `prioritas_name`,`pri`.`serial` AS `prioritas_serial`,`pri`.`is_active` AS `prioritas_is_active`,`pro`.`id` AS `program_id`,`pro`.`name` AS `program_name`,`pro`.`serial` AS `program_serial`,`pro`.`is_active` AS `program_is_active`,`r`.`id` AS `renaksi_id`,`r`.`name` AS `renaksi_name`,`r`.`domains_id` AS `renaksi_domain_id`,`r`.`serial` AS `renaksi_serial`,`r`.`is_active` AS `renaksi_is_active`,`k`.`id` AS `kriteria_id`,`k`.`name` AS `kriteria_name`,`k`.`penanggung_jawab` AS `kriteria_penanggung_jawab`,`k`.`instansi_terkait` AS `kriteria_instansi_terkait`,`k`.`is_active` AS `kriteria_is_active`,`u`.`id` AS `ukuran_id`,`u`.`name` AS `ukuran_name`,`u`.`type` AS `ukuran_type`,`u`.`anggaran` AS `ukuran_jumlah_anggaran`,`u`.`finish` AS `ukuran_finish`,`u`.`finish_on` AS `ukuran_finish_on`,`u`.`is_active` AS `ukuran_is_active`,`uc`.`id` AS `uc_id`,`uc`.`name` AS `uc_name`,`uc`.`capaian` AS `uc_capaian`,`uc`.`keterangan` AS `uc_keterangan`,`uc`.`status` AS `uc_status`,`uc`.`target_fisik` AS `uc_target_fisik`,`uc`.`target_keuangan` AS `uc_target_keuangan`,`uc`.`realisasi_fisik` AS `uc_realisasi_fisik`,`uc`.`realisasi_keuangan` AS `uc_realisasi_keuangan`,`mc`.`id` AS `mc_id`,`mc`.`year` AS `mc_year`,`mc`.`month` AS `mc_month`,`mc`.`week` AS `mc_week`,`mc`.`status` AS `mc_status` from (((((((`monitor_ukuran_checkpoint` `uc` join `monitor_ukuran` `u` on((`uc`.`ukuran_id` = `u`.`id`))) join `monitor_kriteria` `k` on((`u`.`kriteria_id` = `k`.`id`))) join `monitor_renaksi` `r` on((`k`.`renaksi_id` = `r`.`id`))) join `monitor_program` `pro` on((`r`.`program_id` = `pro`.`id`))) join `monitor_prioritas` `pri` on((`pro`.`prioritas_id` = `pri`.`id`))) join `monitor` `m` on((`pri`.`monitor_id` = `m`.`id`))) join `monitor_checkpoint` `mc` on((`uc`.`checkpoint_id` = `mc`.`id`))) where ((`u`.`is_active` = 1) and (`k`.`is_active` = 1) and (`r`.`is_active` = 1) and (`pro`.`is_active` = 1) and (`pri`.`is_active` = 1) and (`m`.`is_active` = 1) and (`mc`.`is_active` = 1)) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `acl_perm`
--
ALTER TABLE `acl_perm`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permKey` (`key`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `acl_role_perms`
--
ALTER TABLE `acl_role_perms`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roleID_2` (`role_id`,`perm_id`);

--
-- Indexes for table `acl_user_domains`
--
ALTER TABLE `acl_user_domains`
  ADD UNIQUE KEY `user_id` (`user_id`,`domain_id`);

--
-- Indexes for table `acl_user_perms`
--
ALTER TABLE `acl_user_perms`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `userID` (`user_id`,`perm_id`);

--
-- Indexes for table `app_properties`
--
ALTER TABLE `app_properties`
  ADD PRIMARY KEY (`nid`);

--
-- Indexes for table `ci_sessions`
--
ALTER TABLE `ci_sessions`
  ADD PRIMARY KEY (`session_id`);

--
-- Indexes for table `domains`
--
ALTER TABLE `domains`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `domains_type`
--
ALTER TABLE `domains_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `login_attempts`
--
ALTER TABLE `login_attempts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `log_ref`
--
ALTER TABLE `log_ref`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `monitor`
--
ALTER TABLE `monitor`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `monitor_checkpoint`
--
ALTER TABLE `monitor_checkpoint`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `monitor_kriteria`
--
ALTER TABLE `monitor_kriteria`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `monitor_lampiran`
--
ALTER TABLE `monitor_lampiran`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `monitor_prioritas`
--
ALTER TABLE `monitor_prioritas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `monitor_program`
--
ALTER TABLE `monitor_program`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `monitor_renaksi`
--
ALTER TABLE `monitor_renaksi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `monitor_type`
--
ALTER TABLE `monitor_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `monitor_ukuran`
--
ALTER TABLE `monitor_ukuran`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `monitor_ukuran_checkpoint`
--
ALTER TABLE `monitor_ukuran_checkpoint`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tmp_monitor_lampiran`
--
ALTER TABLE `tmp_monitor_lampiran`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_autologin`
--
ALTER TABLE `user_autologin`
  ADD PRIMARY KEY (`key_id`,`user_id`);

--
-- Indexes for table `user_profiles`
--
ALTER TABLE `user_profiles`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `acl_perm`
--
ALTER TABLE `acl_perm`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;
--
-- AUTO_INCREMENT for table `acl_role_perms`
--
ALTER TABLE `acl_role_perms`
  MODIFY `id` int(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=337;
--
-- AUTO_INCREMENT for table `acl_user_perms`
--
ALTER TABLE `acl_user_perms`
  MODIFY `id` int(20) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `app_properties`
--
ALTER TABLE `app_properties`
  MODIFY `nid` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `domains`
--
ALTER TABLE `domains`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=199;
--
-- AUTO_INCREMENT for table `domains_type`
--
ALTER TABLE `domains_type`
  MODIFY `id` tinyint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT for table `login_attempts`
--
ALTER TABLE `login_attempts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `logs`
--
ALTER TABLE `logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `log_ref`
--
ALTER TABLE `log_ref`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `monitor`
--
ALTER TABLE `monitor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `monitor_checkpoint`
--
ALTER TABLE `monitor_checkpoint`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `monitor_kriteria`
--
ALTER TABLE `monitor_kriteria`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `monitor_lampiran`
--
ALTER TABLE `monitor_lampiran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `monitor_prioritas`
--
ALTER TABLE `monitor_prioritas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `monitor_program`
--
ALTER TABLE `monitor_program`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `monitor_renaksi`
--
ALTER TABLE `monitor_renaksi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `monitor_type`
--
ALTER TABLE `monitor_type`
  MODIFY `id` tinyint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `monitor_ukuran`
--
ALTER TABLE `monitor_ukuran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `monitor_ukuran_checkpoint`
--
ALTER TABLE `monitor_ukuran_checkpoint`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `tmp_monitor_lampiran`
--
ALTER TABLE `tmp_monitor_lampiran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=322;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;
--
-- AUTO_INCREMENT for table `user_profiles`
--
ALTER TABLE `user_profiles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
