-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 12, 2026 at 10:55 AM
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
-- Database: `ftp_server`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `parent_id`, `created_at`) VALUES
(1, 'Movies', NULL, '2026-08-24 23:02:30'),
(2, 'Software', NULL, '2026-08-24 23:02:30'),
(3, 'TV Series', NULL, '2026-08-24 23:02:30'),
(4, 'Games', NULL, '2026-08-24 23:02:30'),
(5, 'Action', 1, '2026-08-24 23:02:30'),
(6, 'Comedy', 1, '2026-08-24 23:02:30');

-- --------------------------------------------------------

--
-- Table structure for table `contents`
--

CREATE TABLE `contents` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `file_path` varchar(500) NOT NULL,
  `category_id` int(11) NOT NULL,
  `uploader_id` int(11) NOT NULL,
  `download_count` int(11) DEFAULT 0,
  `uploaded_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `content_requests`
--

CREATE TABLE `content_requests` (
  `id` int(11) NOT NULL,
  `requester_ip` varchar(45) DEFAULT NULL,
  `content_title` varchar(255) NOT NULL,
  `category_requested` varchar(100) NOT NULL,
  `message` text DEFAULT NULL,
  `status` enum('pending','fulfilled','rejected') DEFAULT 'pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `content_requests`
--

INSERT INTO `content_requests` (`id`, `requester_ip`, `content_title`, `category_requested`, `message`, `status`, `created_at`) VALUES
(1, '::1', 'The girl NExt door', 'Movies', '2004', 'rejected', '2026-09-08 08:15:03'),
(2, '::1', 'Meet Mr Bruce', 'Movies', '1998', 'pending', '2026-09-10 10:41:37');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `role` enum('admin','moderator') NOT NULL,
  `profile_picture` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password_hash`, `role`, `profile_picture`, `created_at`) VALUES
(15, 'razinraian', 'razinraian991@gmail.com', '$2y$10$8nhGSVM0w0AfVuxqid4/H.FkZaCvdpKQeZSwjFAFkim5xUelAFPda', 'moderator', 'profile_6a8ccf6fc489e1.26616655.jpg', '2026-08-24 23:10:39'),
(16, 'razinraian45', '23-54603-3@student.aiub.edu', '$2y$10$O/RPNAKk6ZvU7NokjVPZ0.I4eRCHf2aMbhE0OnIlYcnVaTphYQMXe', 'moderator', 'profile_6a8d01e3e38575.48918550.jpg', '2026-08-25 02:45:55'),
(17, 'zenin', 'zenin612@gmail.com', '$2y$10$.X2FqH/.HO0WtxFpQtXHjudOkm2vdPGf9Ea0xl6BGROnXSY9odrky', 'moderator', 'profile_6a8d040a46ac31.48794998.jpg', '2026-08-25 02:55:06'),
(18, 'tanvir', 'tanvir991@gmail.com', '$2y$10$.qFSz9Sv4LKfk8FlS/R1ROWWlhPxGb0U8K9ldOvRUbt1fToET5NRq', 'moderator', 'profile_6a8d0437605423.17860095.jpg', '2026-08-25 02:55:51'),
(24, 'razinraian1211', 'rrazin2411@gmail.com', '$2y$10$oLGV/OX70CAO.gXQRKtyCOLHrtrRd7FCnzEo3gCPkNtM8ZRuwYceG', 'moderator', 'profile_6a9fe45d2583e3.29440508.jpg', '2026-09-08 10:33:01'),
(25, 'razinraian111', 'razinraian61211@gmail.com', '$2y$10$gD674YBgKPNU6d8F.cht3.Lqr5z.YTMnYyMB8QSrbViZWLO4x0SYm', 'moderator', NULL, '2026-09-10 08:15:07'),
(26, 'razinraian', 'razinraian9911@gmail.com', '$2y$10$FCmsKhW/JnmTpR8W1UxGpefxrCQceHxjK1Wqs1rwEvpBsLQJIP3/G', 'moderator', NULL, '2026-09-10 08:47:44'),
(27, 'banglavai', 'razinraian6122@gmail.com', '$2y$10$CjPT74Oi5QLik8qFnDkLVO2wNX/KcJSTtx0g5e4KDeVV9SYPS6Bwy', 'admin', NULL, '2026-09-10 08:55:47'),
(28, 'hasnat11', 'has9911@gmail.com', '$2y$10$jkrkV3qVJdi1lJbU7bSAu.slXK3xbWAWDLmM9FfuFr3jF5MkTmILi', 'moderator', 'profile_6aa282a6db7c86.96844196.jpg', '2026-09-10 10:12:54'),
(29, 'MD Razin Raian', 'razinraian90@gmail.com', '$2y$10$Kj9sRrvsK34pk1CzHQHt2uykgJMF6TTeSPH5dPN2mWltlx5C4RBGK', 'admin', NULL, '2026-09-10 10:36:24'),
(30, 'tanvir', 'tanvir@gmail.com', '$2y$10$lHNPUBufPhOxJkEHo4mlLOHbFrMCuemvDR/Dgn1NJcgy23XT6elKy', 'moderator', 'profile_6aa2b42e960e51.59912992.jpg', '2026-09-10 13:44:14');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `parent_id` (`parent_id`);

--
-- Indexes for table `contents`
--
ALTER TABLE `contents`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`),
  ADD KEY `uploader_id` (`uploader_id`);

--
-- Indexes for table `content_requests`
--
ALTER TABLE `content_requests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `contents`
--
ALTER TABLE `contents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `content_requests`
--
ALTER TABLE `content_requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `categories`
--
ALTER TABLE `categories`
  ADD CONSTRAINT `categories_ibfk_1` FOREIGN KEY (`parent_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `contents`
--
ALTER TABLE `contents`
  ADD CONSTRAINT `contents_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `contents_ibfk_2` FOREIGN KEY (`uploader_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
