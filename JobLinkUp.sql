-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: db
-- Generation Time: Apr 27, 2024 at 09:08 AM
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
(1, 'iamtrazy', 'iamtrazy@proton.me', '$2y$10$w3FtqY32n8c4gF0FBGK0QekpuX0kE2jrXluYsUd1GdY3tDjxAhYWW', '2023-11-02 17:10:10');

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
(16, 70, 3, '2024-04-26 07:41:38', 'approved');

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
  `city` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `br_details`
--

INSERT INTO `br_details` (`application_id`, `recruiter_id`, `business_name`, `business_type`, `business_reg_no`, `business_address`, `br_path`, `first_name`, `last_name`, `phone`, `address`, `city`) VALUES
(3, 1, 'AT Software', 'Sole Proprietership', '123', '1156 High St, Santa Cruz, CA 95064', '662c022a36f685.96565381.pdf', 'minoli', 'perera', '0771231239', '38/4, Mihindu Mw, Malabe', 'Colombo');

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
(14, 16, 3, '2024-04-26 14:35:29');

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
  `is_varified` tinyint(1) NOT NULL DEFAULT 0,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  `view_count` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jobs`
--

INSERT INTO `jobs` (`id`, `recruiter_id`, `topic`, `location`, `website`, `rate`, `rate_type`, `type`, `detail`, `keywords`, `banner_img`, `created_at`, `expire_in`, `is_varified`, `is_deleted`, `view_count`) VALUES
(70, 3, 'Football Coach', '1156 High St, Santa Cruz, CA 95064', 'example.com', 5000, 'One-Time', 'Part-Time', 'TEST TEST', 'artist engineer user', 'job-detail-bg.jpg', '2024-04-26 07:30:01', '2024-05-10 07:30:01', 0, 0, 7);

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
(16, 'Kasun hansamal', 'kasun@gmail.com', 'male', '$2y$10$5hh0IYThhv3iWgp6hYU7iezxYCWFqcY/fhdri2RDH4NFBiNhUFPyS', '2023-11-01 01:56:14', 1, '0702339061', 'iamtrazy.eu.org', 22, '38/4, Mihindu Mw, Malabe', 1, 'test,test,test,test', 'Hello', '662a5468199935.86525510.jpg', '662a471480f875.44027307.pdf', 'linkedin.com', '0702339061', 0),
(18, 'kasun2@gmail.com', 'kasun2@gmail.com', 'male', '$2y$10$mS/x8mV7JVw./B7ofLbiqeupp.hptGzG3tl2VgA.axen9uPGwJ/Wi', '2024-04-20 11:01:55', 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, 'default.jpg', NULL, NULL, NULL, 0),
(19, 'Test User', 'kavishkafoodshop@gmail.com', 'male', '$2y$10$B/LhTinqMGoAITZZI021uu8Cae/yR9hKciCleqcLjpKch/SdbP8WW', '2024-04-23 05:01:12', 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, 'default.jpg', NULL, NULL, NULL, 0),
(20, 'Test User', 'discord.cmn24@simplelogin.com', 'male', '$2y$10$VbS4Kj0O0mBhauy2271DGeJ0nVF/bBKWxqh6RT.Fh3Jyj1F90DKly', '2024-04-23 05:01:59', 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, 'default.jpg', NULL, NULL, NULL, 0),
(26, 'Kasun Hansamal', 'kasunhansamalboy@gmail.com', 'male', '$2y$10$bNf7boyMzTsZDN6a6NDabehUP7Ow5.PjeLy/jC/RJLEW0JhBbjmWC', '2024-04-27 07:42:15', 1, NULL, NULL, NULL, NULL, 0, NULL, NULL, 'default.jpg', NULL, NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `moderators`
--

CREATE TABLE `moderators` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `moderators`
--

INSERT INTO `moderators` (`id`, `email`, `name`, `password`, `created_at`) VALUES
(6, 'kasun@gmail.com', 'Moderator 1', '$2y$10$wJQKQjhKC0YGSEo0t5BTxewZsXSPXTupGmQISps5T089peru91HIy', '2023-11-02 23:17:19');

-- --------------------------------------------------------

--
-- Table structure for table `recruiters`
--

CREATE TABLE `recruiters` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `br_uploaded` tinyint(1) NOT NULL DEFAULT 0,
  `is_varified` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `recruiters`
--

INSERT INTO `recruiters` (`id`, `email`, `password`, `name`, `created_at`, `br_uploaded`, `is_varified`) VALUES
(1, 'info@sanima.lk', '$2y$10$sZ/Ihj1gB6dzDfrQP.9ZgOT1x/eWN6nRj4p3qo12D6oGD8uXNQ6KW', 'AT Softwares', '2023-11-02 09:06:43', 1, 1),
(2, 'hello@business.lk', '$2y$10$sZ/Ihj1gB6dzDfrQP.9ZgOT1x/eWN6nRj4p3qo12D6oGD8uXNQ6KW', 'BG Softwares', '2024-04-21 06:34:39', 0, 0),
(3, 'iamtrazy@proton.me', '$2y$10$wBOgCFIKnfy19OhZtmy1j.v/TkvYVw7TiHl8jK96.qbW/wweNN4uS', 'XY Softwares', '2024-04-26 07:07:16', 0, 0);

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
(16, 16, 'seeker', '897978', '2024-04-27 08:46:33');

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
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT for table `br_details`
--
ALTER TABLE `br_details`
  MODIFY `application_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `chat_texts`
--
ALTER TABLE `chat_texts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT for table `chat_threads`
--
ALTER TABLE `chat_threads`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT for table `jobseekers`
--
ALTER TABLE `jobseekers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `moderators`
--
ALTER TABLE `moderators`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `recruiters`
--
ALTER TABLE `recruiters`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `verification_codes`
--
ALTER TABLE `verification_codes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Constraints for dumped tables
--

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
-- Constraints for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD CONSTRAINT `FK1` FOREIGN KEY (`job_id`) REFERENCES `jobs` (`id`),
  ADD CONSTRAINT `FK2` FOREIGN KEY (`seeker_id`) REFERENCES `jobseekers` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
