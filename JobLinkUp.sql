-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: db
-- Generation Time: Apr 26, 2024 at 05:30 AM
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
(16, 62, 1, '2024-04-25 17:49:01', 'rejected'),
(16, 63, 1, '2024-04-25 17:49:05', 'rejected'),
(16, 64, 1, '2024-04-25 17:07:39', 'pending'),
(16, 65, 1, '2024-04-25 17:00:29', 'pending'),
(16, 68, 1, '2024-04-25 16:31:03', 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `br_details`
--

CREATE TABLE `br_details` (
  `application_id` int(11) NOT NULL,
  `recruiter_id` int(11) NOT NULL,
  `website` varchar(20) NOT NULL,
  `business_email` varchar(20) NOT NULL,
  `business_contact_no` int(10) NOT NULL,
  `business_name` varchar(20) NOT NULL,
  `business_type` varchar(20) NOT NULL,
  `business_reg_no` varchar(10) NOT NULL,
  `business_address` varchar(20) NOT NULL,
  `contact_person` varchar(20) NOT NULL,
  `contact_email` varchar(20) NOT NULL,
  `contact_number` varchar(10) NOT NULL,
  `agree_to_terms` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
(2, 69, 1, 'inappropriate'),
(16, 62, 1, 'inappropriate'),
(16, 63, 1, 'inappropriate'),
(16, 64, 1, 'misleading'),
(16, 68, 1, 'inappropriate'),
(16, 69, 1, 'inappropriate');

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
  `is_varified` tinyint(1) NOT NULL DEFAULT 0,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jobs`
--

INSERT INTO `jobs` (`id`, `recruiter_id`, `topic`, `location`, `website`, `rate`, `rate_type`, `type`, `detail`, `keywords`, `banner_img`, `created_at`, `is_varified`, `is_deleted`) VALUES
(62, 1, 'Article Writer', '1156 High St, Santa Cruz, CA 95064', 'example.com', 5000, 'Hour', 'Internship', 'Hello !', 'artist engineer user', '662b2e803242a4.39722744.jpeg', '2024-04-19 07:50:57', 0, 0),
(63, 1, 'Article Writer', '1156 High St, Santa Cruz, CA 95064', 'example.com', 5000, 'One-Time', 'Freelance', 'Hello', 'artist engineer', 'job-detail-bg.jpg', '2024-04-19 08:09:47', 0, 0),
(64, 1, 'Badminton coaching', '1156 High St, Santa Cruz, CA 95064', '', 9500, 'One-Time', 'Freelance', 'Hello !', 'artist engineer', '662344fb1d42e0.98090963.jpg', '2024-04-20 04:30:51', 0, 0),
(65, 1, 'Tennis Coach', '1156 High St, Santa Cruz, CA 95064', 'https://iamtrazy.eu.org', 5000, 'One-Time', 'Part-Time', 'jaokoaiuaoiaoiuiauiauia', 'test\nkeyword', '662575e0080b06.61876525.jpg', '2024-04-21 20:24:00', 0, 0),
(68, 1, 'Badminton coaching', '1156 High St, Santa Cruz, CA 95064', 'example.com', 9500, 'One-Time', 'Freelance', 'Test Description', 'artist engineer', 'job-detail-bg.jpg', '2024-04-22 04:40:26', 0, 0),
(69, 1, 'Football Coach', '1156 High St, Santa Cruz, CA 95064', 'example.com', 5000, 'One-Time', 'Freelance', 'Test', 'artist engineer', '66265e8505b4d2.86228966.png', '2024-04-22 12:56:37', 0, 0);

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

INSERT INTO `jobseekers` (`id`, `username`, `email`, `gender`, `password`, `created_at`, `phone_no`, `website`, `age`, `address`, `location_rec`, `keywords`, `about`, `profile_image`, `cv`, `linkedin_url`, `whatsapp_url`, `is_complete`) VALUES
(2, 'kasun kasun', 'iamtrazy@proton.me', 'male', '$2y$10$w3FtqY32n8c4gF0FBGK0QekpuX0kE2jrXluYsUd1GdY3tDjxAhYWW', '2023-09-30 12:46:49', '0702339061', NULL, NULL, NULL, 0, 'hi hi hiii', NULL, 'default.jpg', NULL, NULL, NULL, 0),
(16, 'Kasun hansamal', 'kasun@gmail.com', 'male', '$2y$10$5hh0IYThhv3iWgp6hYU7iezxYCWFqcY/fhdri2RDH4NFBiNhUFPyS', '2023-11-01 01:56:14', '0702339061', 'iamtrazy.eu.org', 22, '38/4, Mihindu Mw, Malabe', 1, 'test,test,test,test', 'Hello', '662a5468199935.86525510.jpg', '662a471480f875.44027307.pdf', 'linkedin.com', '0702339061', 0),
(18, 'kasun2@gmail.com', 'kasun2@gmail.com', 'male', '$2y$10$mS/x8mV7JVw./B7ofLbiqeupp.hptGzG3tl2VgA.axen9uPGwJ/Wi', '2024-04-20 11:01:55', NULL, NULL, NULL, NULL, 0, NULL, NULL, 'default.jpg', NULL, NULL, NULL, 0),
(19, 'Test User', 'kavishkafoodshop@gmail.com', 'male', '$2y$10$B/LhTinqMGoAITZZI021uu8Cae/yR9hKciCleqcLjpKch/SdbP8WW', '2024-04-23 05:01:12', NULL, NULL, NULL, NULL, 0, NULL, NULL, 'default.jpg', NULL, NULL, NULL, 0),
(20, 'Test User', 'discord.cmn24@simplelogin.com', 'male', '$2y$10$VbS4Kj0O0mBhauy2271DGeJ0nVF/bBKWxqh6RT.Fh3Jyj1F90DKly', '2024-04-23 05:01:59', NULL, NULL, NULL, NULL, 0, NULL, NULL, 'default.jpg', NULL, NULL, NULL, 0);

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
  `business_name` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `recruiters`
--

INSERT INTO `recruiters` (`id`, `email`, `password`, `name`, `business_name`, `created_at`) VALUES
(1, 'info@sanima.lk', '$2y$10$sZ/Ihj1gB6dzDfrQP.9ZgOT1x/eWN6nRj4p3qo12D6oGD8uXNQ6KW', 'AT Softwares', 'Sanima Holdings', '2023-11-02 09:06:43'),
(2, 'hello@business.lk', '$2y$10$sZ/Ihj1gB6dzDfrQP.9ZgOT1x/eWN6nRj4p3qo12D6oGD8uXNQ6KW', 'Test Business', 'Test Company', '2024-04-21 06:34:39');

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
(2, 69, '2024-04-24 12:44:09'),
(16, 63, '2024-04-25 16:30:54'),
(16, 64, '2024-04-25 07:26:59'),
(16, 65, '2024-04-25 16:28:35');

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
  ADD PRIMARY KEY (`application_id`);

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
  MODIFY `application_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `chat_texts`
--
ALTER TABLE `chat_texts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT for table `chat_threads`
--
ALTER TABLE `chat_threads`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT for table `jobseekers`
--
ALTER TABLE `jobseekers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `moderators`
--
ALTER TABLE `moderators`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `recruiters`
--
ALTER TABLE `recruiters`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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
