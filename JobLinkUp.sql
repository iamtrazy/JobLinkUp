-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: db
-- Generation Time: Apr 30, 2024 at 02:28 AM
-- Server version: 11.3.2-MariaDB-1:11.3.2+maria~ubu2204
-- PHP Version: 8.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `JobLinkUp`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `password`, `created_at`) VALUES
(1, 'Administrator', 'iamtrazy@proton.me', '$2y$10$w3FtqY32n8c4gF0FBGK0QekpuX0kE2jrXluYsUd1GdY3tDjxAhYWW', '2023-11-02 17:10:10');

-- --------------------------------------------------------

--
-- Table structure for table `admin_report_jobs`
--

CREATE TABLE `admin_report_jobs` (
  `report_id` int(11) NOT NULL,
  `job_id` int(11) NOT NULL,
  `moderator_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_report_jobs`
--

INSERT INTO `admin_report_jobs` (`report_id`, `job_id`, `moderator_id`) VALUES
(1, 72, 6);

-- --------------------------------------------------------

--
-- Table structure for table `admin_report_recruiters`
--

CREATE TABLE `admin_report_recruiters` (
  `report_id` int(11) NOT NULL,
  `recruiter_id` int(11) NOT NULL,
  `moderator_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_report_recruiters`
--

INSERT INTO `admin_report_recruiters` (`report_id`, `recruiter_id`, `moderator_id`) VALUES
(1, 1, 6);

-- --------------------------------------------------------

--
-- Table structure for table `ads`
--

CREATE TABLE `ads` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `text` varchar(255) NOT NULL,
  `color` varchar(20) NOT NULL,
  `url` varchar(255) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `type` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ads`
--

INSERT INTO `ads` (`id`, `title`, `text`, `color`, `url`, `admin_id`, `type`) VALUES
(1, 'Need a quick part time job?', 'Get Best Matched Jobs On your Email. Add Resume NOW!', '#ff0000', 'joblinkup.com/recruiters', 1, 1),
(2, 'Need a quick part time job?', 'Get Best Matched Jobs On your Email. Add Resume NOW!', '#6868dd', 'joblinkup.com/recruiters', 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `applications`
--

CREATE TABLE `applications` (
  `seeker_id` int(11) NOT NULL,
  `job_id` int(11) NOT NULL,
  `recruiter_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `status` enum('pending','rejected','approved') NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `applications`
--

INSERT INTO `applications` (`seeker_id`, `job_id`, `recruiter_id`, `created_at`, `status`) VALUES
(2, 72, 1, '2024-04-27 11:24:25', 'approved'),
(16, 70, 3, '2024-04-26 07:41:38', 'rejected'),
(16, 71, 1, '2024-04-27 22:47:30', 'rejected'),
(16, 72, 1, '2024-04-27 11:22:17', 'approved'),
(29, 72, 1, '2024-04-28 13:27:41', 'approved'),
(31, 70, 1, '2024-04-29 09:19:54', 'approved');

-- --------------------------------------------------------

--
-- Table structure for table `br_details`
--

CREATE TABLE `br_details` (
  `application_id` int(11) NOT NULL,
  `recruiter_id` int(11) NOT NULL,
  `business_name` varchar(255) NOT NULL,
  `business_type` varchar(255) NOT NULL,
  `business_reg_no` varchar(50) NOT NULL,
  `business_address` varchar(255) NOT NULL,
  `br_path` varchar(255) DEFAULT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `phone` varchar(10) NOT NULL,
  `address` varchar(200) NOT NULL,
  `city` varchar(50) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `br_details`
--

INSERT INTO `br_details` (`application_id`, `recruiter_id`, `business_name`, `business_type`, `business_reg_no`, `business_address`, `br_path`, `first_name`, `last_name`, `phone`, `address`, `city`, `created_at`) VALUES
(3, 1, 'AT Software', 'Sole Proprietership', '123', '1156 High St, Santa Cruz, CA 95064', '662c022a36f685.96565381.pdf', 'minoli', 'perera', '0771231239', '38/4, Mihindu Mw, Malabe', 'Colombo', '2024-04-28 06:09:40'),
(5, 2, 'BG software', 'Sole Proprietership', '123', '38/4, Mihindu Mawatha , Malabe', '662e474fc73520.02995312.pdf', 'minoli', 'perera', '0771231239', '38/4, Mihindu Mw, Malabe', 'Colombo', '2024-04-28 12:55:47');

-- --------------------------------------------------------

--
-- Table structure for table `chat_texts`
--

CREATE TABLE `chat_texts` (
  `id` int(11) NOT NULL,
  `thread_id` int(11) NOT NULL,
  `text` varchar(255) NOT NULL,
  `reply` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `chat_texts`
--

INSERT INTO `chat_texts` (`id`, `thread_id`, `text`, `reply`, `created_at`) VALUES
(75, 21, 'hi', 0, '2024-04-28 13:29:39'),
(76, 21, 'hi', 1, '2024-04-28 13:29:47'),
(77, 23, 'hi', 1, '2024-04-29 09:25:40'),
(78, 23, 'hi', 0, '2024-04-29 09:25:47');

-- --------------------------------------------------------

--
-- Table structure for table `chat_threads`
--

CREATE TABLE `chat_threads` (
  `id` int(11) NOT NULL,
  `seeker_id` int(11) NOT NULL,
  `recruiter_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `chat_threads`
--

INSERT INTO `chat_threads` (`id`, `seeker_id`, `recruiter_id`, `created_at`) VALUES
(20, 2, 1, '2024-04-28 07:25:10'),
(21, 29, 1, '2024-04-28 13:29:20'),
(23, 31, 1, '2024-04-29 09:24:21'),
(26, 2, 1, '2024-04-30 01:09:35'),
(27, 2, 1, '2024-04-30 01:15:55'),
(28, 2, 1, '2024-04-30 01:19:15');

-- --------------------------------------------------------

--
-- Table structure for table `disputes`
--

CREATE TABLE `disputes` (
  `seeker_id` int(11) NOT NULL,
  `job_id` int(11) NOT NULL,
  `recruiter_id` int(11) NOT NULL,
  `reason` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `disputes`
--

INSERT INTO `disputes` (`seeker_id`, `job_id`, `recruiter_id`, `reason`) VALUES
(16, 70, 1, 'inappropriate'),
(16, 72, 1, 'misleading');

-- --------------------------------------------------------

--
-- Table structure for table `dropbox_keys`
--

CREATE TABLE `dropbox_keys` (
  `id` int(11) NOT NULL,
  `client_id` varchar(255) NOT NULL,
  `client_secret` varchar(255) NOT NULL,
  `access_token` varchar(255) NOT NULL,
  `admin_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dropbox_keys`
--

INSERT INTO `dropbox_keys` (`id`, `client_id`, `client_secret`, `access_token`, `admin_id`) VALUES
(2, 'm91cjmivnpmg6rh', '6rs0z9ki0ylyv1t', 'sl.B0T9OyVnyvGXXdLltTw3O5ogP3VZ7ojPhBJekH6s0vkbSc69BjiOCr-2S8JWP6ieiAusqzY2rySw8A-KgESSyCrLhajuzqKq7WYe_7iB5omtMNfzr8NwY_wKoum_PI_9gn1thG686WIB', 1);

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` int(11) NOT NULL,
  `recruiter_id` int(11) NOT NULL,
  `topic` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `website` varchar(255) DEFAULT NULL,
  `rate` decimal(10,0) NOT NULL,
  `rate_type` enum('One-Time','Hour','Week','Month') NOT NULL,
  `type` enum('Freelance','Internship','Part-Time','Volunteer','Other') NOT NULL DEFAULT 'Other',
  `detail` varchar(255) NOT NULL,
  `keywords` varchar(255) NOT NULL,
  `banner_img` varchar(255) NOT NULL DEFAULT 'job-detail-bg.jpg',
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `expire_in` datetime NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  `view_count` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jobs`
--

INSERT INTO `jobs` (`id`, `recruiter_id`, `topic`, `location`, `website`, `rate`, `rate_type`, `type`, `detail`, `keywords`, `banner_img`, `created_at`, `expire_in`, `is_deleted`, `view_count`) VALUES
(70, 1, 'Football Coach', '1156 High St, Santa Cruz, CA 95064', 'example.com', 3000, 'One-Time', 'Part-Time', 'TEST TEST', 'artist engineer user', 'job-detail-bg.jpg', '2024-04-26 07:30:01', '2024-05-10 07:30:01', 0, 87),
(71, 1, 'Football Coach', '38/4, mihindu mawatha, malabe', 'example.com', 5000, 'One-Time', 'Freelance', 'test test', '', '662cdd7b52ced5.05595632.jpg', '2024-04-27 11:11:55', '2024-04-27 11:11:55', 0, 21),
(72, 1, 'Tennis Coach', '1156 High St, Santa Cruz, CA 95064', 'example.com', 6000, 'One-Time', 'Freelance', 'Hello World', 'artist engineer user', '66303d871a9bb2.85590529.jpeg', '2024-04-27 11:19:51', '2024-05-11 11:19:51', 0, 66),
(73, 1, 'Football Coach', '1156 High St, Santa Cruz, CA 95064', 'example.com', 6000, 'One-Time', 'Freelance', 'Hi', 'artist engineer', '6630395eec99e6.13229338.jpg', '2024-04-30 00:16:55', '2024-05-14 00:16:55', 0, 3),
(74, 1, 'Football Coach', '1156 High St, Santa Cruz, CA 95064', 'example.com', 5000, 'One-Time', 'Freelance', 'hiaaaaaaaaaaa', 'artist engineer', 'job-detail-bg.jpg', '2024-04-30 00:23:19', '2024-05-14 00:23:19', 0, 1),
(75, 1, 'Badminton coaching', '1156 High St, Santa Cruz, CA 95064', 'example.com', 12345, 'One-Time', 'Freelance', 'hihiahiah', 'artist engineer user', 'job-detail-bg.jpg', '2024-04-30 00:41:37', '2024-05-14 00:41:37', 0, 1);

--
-- Triggers `jobs`
--
DELIMITER $$
CREATE TRIGGER `expire` BEFORE INSERT ON `jobs` FOR EACH ROW SET NEW.created_at = IFNULL(NEW.created_at, NOW()), 
    NEW.expire_in = TIMESTAMPADD(DAY, 14, NEW.created_at)
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `jobseekers`
--

CREATE TABLE `jobseekers` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `gender` enum('male','female') NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `code_verified` tinyint(1) NOT NULL DEFAULT 0,
  `phone_no` char(10) DEFAULT NULL,
  `website` varchar(255) DEFAULT NULL,
  `age` int(3) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `location_rec` tinyint(1) NOT NULL DEFAULT 0,
  `keywords` varchar(255) DEFAULT NULL,
  `about` varchar(255) DEFAULT NULL,
  `profile_image` varchar(255) NOT NULL DEFAULT 'default.jpg',
  `cv` varchar(255) DEFAULT NULL,
  `linkedin_url` varchar(255) DEFAULT NULL,
  `whatsapp_url` varchar(255) DEFAULT NULL,
  `is_complete` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jobseekers`
--

INSERT INTO `jobseekers` (`id`, `username`, `email`, `gender`, `password`, `created_at`, `code_verified`, `phone_no`, `website`, `age`, `address`, `location_rec`, `keywords`, `about`, `profile_image`, `cv`, `linkedin_url`, `whatsapp_url`, `is_complete`) VALUES
(2, 'Kasun Hansamal', 'iamtrazy@proton.me', 'male', '$2y$10$bNf7boyMzTsZDN6a6NDabehUP7Ow5.PjeLy/jC/RJLEW0JhBbjmWC', '2023-09-30 12:46:49', 1, '0702339061', '', 20, '', 0, 'hi hi hiii', '', 'default.jpg', NULL, '', '', 0),
(16, 'Kasun Hansamal', 'kasun@gmail.com', 'male', '$2y$10$z4UT/b/wj/9Hj.9ukYytO.q/hqKrV6mZNJgVm6RWdm0ePIIxrQS/6', '2023-11-01 01:56:14', 1, '0702339061', 'iamtrazy.eu.org', 22, 'malabe', 0, 'Test', 'Hello', '662ff607effd08.74674414.png', '662ff9d0e184c9.23175327.pdf', 'linkedin.com', '0702339061', 1),
(27, 'Test User', 'discord.cmn24@simplelogin.com', 'male', '$2y$10$TmrBCGbFFuOTMenlL6Xkgu.mUPLbZVt5IRA.13EdonlJ1bmqooyXm', '2024-04-27 11:00:23', 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, 'default.jpg', NULL, NULL, NULL, 0),
(28, 'Hello Hello', 'hello@gmail.com', 'male', '$2y$10$qJbMx5c4tRBdyO6PYE/8IO/wuFuB7A5m1mlvfkc4jD27Gj5SZU/SC', '2024-04-28 10:19:28', 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, 'default.jpg', NULL, NULL, NULL, 0),
(29, 'Testing 1', 'zcx1b6abm@mozmail.com', 'male', '$2y$10$Ib8qFpBJ1oEaPtCBelFpyeOiZEUUOpOGpN/LufHR7oRS0OVVit4hG', '2024-04-28 13:24:08', 1, NULL, NULL, NULL, NULL, 0, NULL, NULL, 'default.jpg', NULL, NULL, NULL, 0),
(30, 'Kasun Hansamal', 'parima4097@togito.com', 'male', '$2y$10$3NrEK.DZJq5yNT8ZEEEJ.uNCAFh88UmomJYuWD35EcBH8rrgmMNnC', '2024-04-29 09:01:25', 1, NULL, NULL, NULL, NULL, 0, NULL, NULL, 'default.jpg', NULL, NULL, NULL, 0),
(31, 'Kasun Hansamal', 'zeydigaspe@gufum.com', 'male', '$2y$10$j1YZUhR.uskvclQQOQtOiupec/4uewcz2GoEMkMGRvPh3c.feu2BG', '2024-04-29 09:19:07', 1, '0702339061', 'example.com', 22, '38/4, Mihindu Mw, Malabe', 0, 'hi, hi', 'Hello', '662f66bdb7a164.10567768.jpg', '662f66bdb7c2f4.00429714.pdf', 'linkedin.com', '0702339061', 1);

-- --------------------------------------------------------

--
-- Table structure for table `moderators`
--

CREATE TABLE `moderators` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `last_active` datetime NOT NULL DEFAULT current_timestamp(),
  `is_disabled` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `moderators`
--

INSERT INTO `moderators` (`id`, `email`, `name`, `password`, `created_at`, `last_active`, `is_disabled`) VALUES
(6, 'kasun@gmail.com', 'Moderator 1', '$2y$10$wJQKQjhKC0YGSEo0t5BTxewZsXSPXTupGmQISps5T089peru91HIy', '2023-11-02 23:17:19', '2024-04-28 18:12:50', 1);

-- --------------------------------------------------------

--
-- Table structure for table `recruiters`
--

CREATE TABLE `recruiters` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `age` int(3) DEFAULT NULL,
  `phone_no` char(10) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `profile_image` varchar(255) NOT NULL DEFAULT 'default_recruiter.jpg',
  `about` varchar(255) DEFAULT NULL,
  `linkedin_url` varchar(255) DEFAULT NULL,
  `whatsapp_url` char(10) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `code_verified` tinyint(1) NOT NULL DEFAULT 0,
  `br_uploaded` tinyint(1) NOT NULL DEFAULT 0,
  `paid` tinyint(1) NOT NULL DEFAULT 0,
  `is_varified` tinyint(1) NOT NULL DEFAULT 0,
  `is_banned` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `recruiters`
--

INSERT INTO `recruiters` (`id`, `email`, `password`, `name`, `age`, `phone_no`, `address`, `profile_image`, `about`, `linkedin_url`, `whatsapp_url`, `created_at`, `code_verified`, `br_uploaded`, `paid`, `is_varified`, `is_banned`) VALUES
(1, 'iamtrazy@proton.me', '$2y$10$4sF75Dmow/zTRv/cmz5L2.qXnPAFv/TNtJumb4JlHBN7PiB3tGqXK', 'AT Softwares', 30, '0702339061', '38/4, Mihindu Mw, Malabe', '662f6854b88e60.25610087.jpg', 'Test About', 'linkedin.com', '0702339061', '2023-11-02 09:06:43', 1, 1, 1, 1, 0),
(2, 'hello@business.lk', '$2y$10$ungeuHkk3ZE9JnrkCdPDyO.8p1I325lKr3wAvYKpGEtXfYuMkLNTm', 'BG Softwares', NULL, NULL, NULL, 'default_recruiter.jpg', NULL, NULL, '', '2024-04-21 06:34:39', 1, 1, 0, 0, 0),
(3, 'iamtrazy@proton.me', '$2y$10$wBOgCFIKnfy19OhZtmy1j.v/TkvYVw7TiHl8jK96.qbW/wweNN4uS', 'XY Softwares', NULL, NULL, NULL, 'default_recruiter.jpg', NULL, NULL, '', '2024-04-26 07:07:16', 0, 0, 0, 1, 0),
(7, 'kasunhansamalboy@gmail.com', '$2y$10$GprO4iIN1ERD01Su2Z661eq9/nUtjCGGEj433qxQuUyTqKGebg7dO', 'Hello World', NULL, NULL, NULL, 'default_recruiter.jpg', NULL, NULL, '', '2024-04-27 10:52:05', 1, 0, 0, 0, 0),
(8, 'hello@gmail.com', '$2y$10$7u6JXuTwwfbGxfA7Lhvl7e4DYX0q3E.xqBJOUUrojSHBFsDHEGNzq', 'Hello Hello', NULL, NULL, NULL, 'default_recruiter.jpg', NULL, NULL, NULL, '2024-04-28 10:20:56', 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `verification_codes`
--

CREATE TABLE `verification_codes` (
  `id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `role` enum('seeker','recruiter','moderator') NOT NULL,
  `code` char(6) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `verification_codes`
--

INSERT INTO `verification_codes` (`id`, `role_id`, `role`, `code`, `created_at`) VALUES
(4, 26, 'seeker', '107019', '2024-04-27 08:07:16'),
(5, 26, 'seeker', '101512', '2024-04-27 08:07:16'),
(6, 26, 'seeker', '399791', '2024-04-27 08:07:16'),
(7, 26, 'seeker', '941734', '2024-04-27 08:07:16'),
(8, 26, 'seeker', '993598', '2024-04-27 08:07:42'),
(9, 2, 'seeker', '225951', '2024-04-27 08:30:26'),
(10, 16, 'seeker', '461570', '2024-04-27 08:36:49'),
(11, 16, 'seeker', '533375', '2024-04-27 08:43:48'),
(12, 16, 'seeker', '517539', '2024-04-27 08:44:52'),
(13, 16, 'seeker', '916518', '2024-04-27 08:45:36'),
(14, 16, 'seeker', '208788', '2024-04-27 08:45:47'),
(15, 16, 'seeker', '388527', '2024-04-27 08:46:04'),
(16, 16, 'seeker', '897978', '2024-04-27 08:46:33'),
(17, 4, 'recruiter', '219416', '2024-04-27 10:32:14'),
(18, 4, 'recruiter', '433078', '2024-04-27 10:37:46'),
(19, 4, 'recruiter', '815253', '2024-04-27 10:39:20'),
(22, 6, 'recruiter', '497662', '2024-04-27 10:48:44'),
(23, 7, 'recruiter', '925856', '2024-04-27 10:52:05'),
(24, 27, 'seeker', '862122', '2024-04-27 11:00:23'),
(25, 1, 'recruiter', '653927', '2024-04-27 11:10:20'),
(26, 28, 'seeker', '398519', '2024-04-28 10:19:28'),
(27, 8, 'recruiter', '373454', '2024-04-28 10:20:56'),
(28, 2, 'recruiter', '628271', '2024-04-28 12:50:26'),
(29, 2, 'recruiter', '525699', '2024-04-28 12:50:54'),
(30, 2, 'recruiter', '623282', '2024-04-28 12:52:22'),
(31, 29, 'seeker', '742380', '2024-04-28 13:24:08'),
(32, 30, 'seeker', '450962', '2024-04-29 09:01:25'),
(33, 31, 'seeker', '956923', '2024-04-29 09:19:07');

-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--

CREATE TABLE `wishlist` (
  `seeker_id` int(11) NOT NULL,
  `job_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `wishlist`
--

INSERT INTO `wishlist` (`seeker_id`, `job_id`, `created_at`) VALUES
(16, 71, '2024-04-28 15:49:18'),
(29, 72, '2024-04-28 13:27:57'),
(31, 70, '2024-04-29 09:19:57');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin_report_jobs`
--
ALTER TABLE `admin_report_jobs`
  ADD PRIMARY KEY (`report_id`),
  ADD KEY `FK_AD_1` (`job_id`),
  ADD KEY `FK_AD_2` (`moderator_id`);

--
-- Indexes for table `admin_report_recruiters`
--
ALTER TABLE `admin_report_recruiters`
  ADD PRIMARY KEY (`report_id`),
  ADD KEY `FK_AD_3` (`recruiter_id`),
  ADD KEY `FK_AD_4` (`moderator_id`);

--
-- Indexes for table `ads`
--
ALTER TABLE `ads`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_ADD_1` (`admin_id`);

--
-- Indexes for table `applications`
--
ALTER TABLE `applications`
  ADD PRIMARY KEY (`seeker_id`,`job_id`),
  ADD KEY `FK3` (`job_id`),
  ADD KEY `FK5` (`recruiter_id`);

--
-- Indexes for table `br_details`
--
ALTER TABLE `br_details`
  ADD PRIMARY KEY (`application_id`),
  ADD KEY `FK_BR_1` (`recruiter_id`);

--
-- Indexes for table `chat_texts`
--
ALTER TABLE `chat_texts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_CHAT_3` (`thread_id`);

--
-- Indexes for table `chat_threads`
--
ALTER TABLE `chat_threads`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_CHAT_1` (`recruiter_id`),
  ADD KEY `FK_CHAT_2` (`seeker_id`);

--
-- Indexes for table `disputes`
--
ALTER TABLE `disputes`
  ADD PRIMARY KEY (`seeker_id`,`job_id`),
  ADD KEY `DISPUTE_1` (`job_id`),
  ADD KEY `DISPUTE_3` (`recruiter_id`);

--
-- Indexes for table `dropbox_keys`
--
ALTER TABLE `dropbox_keys`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_DB_1` (`admin_id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jobseekers`
--
ALTER TABLE `jobseekers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `moderators`
--
ALTER TABLE `moderators`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `recruiters`
--
ALTER TABLE `recruiters`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `verification_codes`
--
ALTER TABLE `verification_codes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`seeker_id`,`job_id`),
  ADD KEY `FK1` (`job_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `admin_report_jobs`
--
ALTER TABLE `admin_report_jobs`
  MODIFY `report_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `admin_report_recruiters`
--
ALTER TABLE `admin_report_recruiters`
  MODIFY `report_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `ads`
--
ALTER TABLE `ads`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `br_details`
--
ALTER TABLE `br_details`
  MODIFY `application_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `chat_texts`
--
ALTER TABLE `chat_texts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;

--
-- AUTO_INCREMENT for table `chat_threads`
--
ALTER TABLE `chat_threads`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `dropbox_keys`
--
ALTER TABLE `dropbox_keys`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;

--
-- AUTO_INCREMENT for table `jobseekers`
--
ALTER TABLE `jobseekers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `moderators`
--
ALTER TABLE `moderators`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `recruiters`
--
ALTER TABLE `recruiters`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `verification_codes`
--
ALTER TABLE `verification_codes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admin_report_jobs`
--
ALTER TABLE `admin_report_jobs`
  ADD CONSTRAINT `FK_AD_1` FOREIGN KEY (`job_id`) REFERENCES `jobs` (`id`),
  ADD CONSTRAINT `FK_AD_2` FOREIGN KEY (`moderator_id`) REFERENCES `moderators` (`id`);

--
-- Constraints for table `admin_report_recruiters`
--
ALTER TABLE `admin_report_recruiters`
  ADD CONSTRAINT `FK_AD_3` FOREIGN KEY (`recruiter_id`) REFERENCES `recruiters` (`id`),
  ADD CONSTRAINT `FK_AD_4` FOREIGN KEY (`moderator_id`) REFERENCES `moderators` (`id`);

--
-- Constraints for table `ads`
--
ALTER TABLE `ads`
  ADD CONSTRAINT `FK_ADD_1` FOREIGN KEY (`admin_id`) REFERENCES `admins` (`id`);

--
-- Constraints for table `applications`
--
ALTER TABLE `applications`
  ADD CONSTRAINT `FK3` FOREIGN KEY (`job_id`) REFERENCES `jobs` (`id`),
  ADD CONSTRAINT `FK4` FOREIGN KEY (`seeker_id`) REFERENCES `jobseekers` (`id`),
  ADD CONSTRAINT `FK5` FOREIGN KEY (`recruiter_id`) REFERENCES `recruiters` (`id`);

--
-- Constraints for table `br_details`
--
ALTER TABLE `br_details`
  ADD CONSTRAINT `FK_BR_1` FOREIGN KEY (`recruiter_id`) REFERENCES `recruiters` (`id`);

--
-- Constraints for table `chat_texts`
--
ALTER TABLE `chat_texts`
  ADD CONSTRAINT `FK_CHAT_3` FOREIGN KEY (`thread_id`) REFERENCES `chat_threads` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `chat_threads`
--
ALTER TABLE `chat_threads`
  ADD CONSTRAINT `FK_CHAT_1` FOREIGN KEY (`recruiter_id`) REFERENCES `recruiters` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_CHAT_2` FOREIGN KEY (`seeker_id`) REFERENCES `jobseekers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `disputes`
--
ALTER TABLE `disputes`
  ADD CONSTRAINT `DISPUTE_1` FOREIGN KEY (`job_id`) REFERENCES `jobs` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `DISPUTE_2` FOREIGN KEY (`seeker_id`) REFERENCES `jobseekers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `DISPUTE_3` FOREIGN KEY (`recruiter_id`) REFERENCES `recruiters` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `dropbox_keys`
--
ALTER TABLE `dropbox_keys`
  ADD CONSTRAINT `FK_DB_1` FOREIGN KEY (`admin_id`) REFERENCES `admins` (`id`);

--
-- Constraints for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD CONSTRAINT `FK1` FOREIGN KEY (`job_id`) REFERENCES `jobs` (`id`),
  ADD CONSTRAINT `FK2` FOREIGN KEY (`seeker_id`) REFERENCES `jobseekers` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
