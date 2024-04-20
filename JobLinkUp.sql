-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: db
-- Generation Time: Apr 20, 2024 at 06:38 AM
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
-- Table structure for table `chat`
--

CREATE TABLE `chat` (
  `chat_id` int(11) NOT NULL,
  `posted_on` datetime NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `color` char(7) DEFAULT '#000000'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `chat`
--

INSERT INTO `chat` (`chat_id`, `posted_on`, `user_name`, `message`, `color`) VALUES
(1, '2024-04-19 11:18:43', 'Guest346', 'hi', '#000000'),
(2, '2024-04-19 11:18:52', 'Guest346', 'hello', '#000000'),
(3, '2024-04-19 11:20:22', 'Guest996', 'hi', '#000000'),
(4, '2024-04-19 11:20:24', 'Guest996', 'klkl', '#000000'),
(5, '2024-04-19 11:20:25', 'Guest996', ';;k', '#000000'),
(6, '2024-04-19 11:20:27', 'Guest996', ']k;k;', '#000000'),
(7, '2024-04-19 11:20:28', 'Guest996', 'klk', '#000000'),
(8, '2024-04-19 12:01:53', 'Guest24', 'tt', '#000000');

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
  `banner_img` varchar(255) NOT NULL DEFAULT '/img/job-detail-bg.jpg',
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `is_varified` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jobs`
--

INSERT INTO `jobs` (`id`, `recruiter_id`, `topic`, `location`, `website`, `rate`, `rate_type`, `type`, `detail`, `keywords`, `banner_img`, `created_at`, `is_varified`) VALUES
(62, 1, 'Article Writer', '1156 High St, Santa Cruz, CA 95064', 'example.com', 5000, 'One-Time', 'Freelance', 'Hello !', 'artist engineer', '66222261cca6d4.62846650.png', '2024-04-19 07:50:57', 0),
(63, 1, 'Article Writer', '1156 High St, Santa Cruz, CA 95064', 'example.com', 5000, 'One-Time', 'Freelance', 'Hello', 'artist engineer', '662226cbc8f1c6.88433449.jpg', '2024-04-19 08:09:47', 0),
(64, 1, 'Badminton coaching', '1156 High St, Santa Cruz, CA 95064', '', 9500, 'One-Time', 'Freelance', 'Hello !', 'artist engineer', '662344fb1d42e0.98090963.jpg', '2024-04-20 04:30:51', 0);

-- --------------------------------------------------------

--
-- Table structure for table `jobseekers`
--

CREATE TABLE `jobseekers` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jobseekers`
--

INSERT INTO `jobseekers` (`id`, `username`, `email`, `password`, `created_at`) VALUES
(2, 'iamtrazy', 'iamtrazy@proton.me', '$2y$10$w3FtqY32n8c4gF0FBGK0QekpuX0kE2jrXluYsUd1GdY3tDjxAhYWW', '2023-09-30 12:46:49'),
(16, 'Kasun Hansamal', 'kasun@gmail.com', '$2y$10$5hh0IYThhv3iWgp6hYU7iezxYCWFqcY/fhdri2RDH4NFBiNhUFPyS', '2023-11-01 01:56:14');

-- --------------------------------------------------------

--
-- Table structure for table `jobs_applied`
--

CREATE TABLE `jobs_applied` (
  `seeker_id` int(11) NOT NULL,
  `job_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jobs_applied`
--

INSERT INTO `jobs_applied` (`seeker_id`, `job_id`, `created_at`) VALUES
(16, 62, '2024-04-20 04:36:16'),
(16, 63, '2024-04-19 16:24:31'),
(16, 64, '2024-04-20 04:35:58');

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
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `recruiters`
--

INSERT INTO `recruiters` (`id`, `email`, `password`, `name`, `created_at`) VALUES
(1, 'info@sanima.lk', '$2y$10$sZ/Ihj1gB6dzDfrQP.9ZgOT1x/eWN6nRj4p3qo12D6oGD8uXNQ6KW', 'AT Softwares', '2023-11-02 09:06:43');

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
(16, 62, '2024-04-20 06:15:10'),
(16, 63, '2024-04-19 15:15:32'),
(16, 64, '2024-04-20 04:36:33');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `chat`
--
ALTER TABLE `chat`
  ADD PRIMARY KEY (`chat_id`);

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
-- Indexes for table `jobs_applied`
--
ALTER TABLE `jobs_applied`
  ADD PRIMARY KEY (`seeker_id`,`job_id`),
  ADD KEY `FK3` (`job_id`);

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
-- AUTO_INCREMENT for table `chat`
--
ALTER TABLE `chat`
  MODIFY `chat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT for table `jobseekers`
--
ALTER TABLE `jobseekers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `moderators`
--
ALTER TABLE `moderators`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `recruiters`
--
ALTER TABLE `recruiters`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `jobs_applied`
--
ALTER TABLE `jobs_applied`
  ADD CONSTRAINT `FK3` FOREIGN KEY (`job_id`) REFERENCES `jobs` (`id`),
  ADD CONSTRAINT `FK4` FOREIGN KEY (`seeker_id`) REFERENCES `jobseekers` (`id`);

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
