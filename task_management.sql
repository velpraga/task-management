-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jan 11, 2025 at 06:23 AM
-- Server version: 8.0.40-0ubuntu0.24.04.1
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `task_management`
--

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

CREATE TABLE `tasks` (
  `id` int NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text,
  `assigned_to` int DEFAULT NULL,
  `status` enum('Pending','In Progress','Completed','On Hold','Cancelled') DEFAULT 'Pending',
  `priority` enum('Low','Medium','High','Critical') DEFAULT 'Medium',
  `due_date` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tasks`
--

INSERT INTO `tasks` (`id`, `title`, `description`, `assigned_to`, `status`, `priority`, `due_date`, `created_at`, `updated_at`) VALUES
(1, 'Facilis', 'Eveniet deserunt ne', 7, 'Pending', 'Critical', '2010-08-17', '2025-01-11 04:03:05', '2025-01-11 05:13:22'),
(3, 'Et quos aut a possim', 'Harum facilis ea min', 13, 'Completed', 'High', '2009-11-07', '2025-01-11 05:07:13', '2025-01-11 05:07:13'),
(4, 'Cumque dicta rerum i', 'Ut tempore explicab', 16, 'On Hold', 'Medium', '2021-11-30', '2025-01-11 05:08:40', '2025-01-11 05:08:40'),
(5, 'Deleniti tempor volu', 'Consequat Voluptate', 16, 'In Progress', 'High', '1994-05-03', '2025-01-11 05:13:41', '2025-01-11 05:13:41'),
(6, 'Maxime voluptate aut', 'Ut est sunt in unde', 13, 'Cancelled', 'Critical', '2014-02-07', '2025-01-11 05:13:55', '2025-01-11 05:13:55'),
(7, 'Molestias veritatis', 'Ut explicabo Sed ne', 18, 'Cancelled', 'Medium', '2009-07-29', '2025-01-11 06:00:42', '2025-01-11 06:00:42'),
(9, 'Doloribus dolore dol', 'Error excepteur moll', 18, 'Pending', 'Critical', '2013-10-21', '2025-01-11 06:04:01', '2025-01-11 06:04:01');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('Admin','User') DEFAULT 'User',
  `status` enum('Active','Inactive') DEFAULT 'Active',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `password`, `role`, `status`, `created_at`, `updated_at`) VALUES
(7, 'Velu1234', 'Murugan', 'velu@mailinator.com', '$2y$10$JgowDvS9pcw8P2D.S5iqv.b1zQ3qz3CPMvXVXiHqUijg6OyAipLBG', 'Admin', 'Active', '2025-01-06 15:29:22', '2025-01-10 15:43:05'),
(12, 'Daryl', 'Weber', 'wujuvix@mailinator.com', '$2y$10$zs8A7CyKcXwo5SNqvX7TNuhz0pNG6x3HC7Pt9pvSAovUYBCmDrYRC', 'Admin', 'Active', '2025-01-11 02:27:46', '2025-01-11 02:34:35'),
(13, 'Christopher', 'Morales', 'japonatoba@mailinator.com', '$2y$10$0JNt/TdyKB65aZ2UV0p.se3qb9KQU8MIhhbeq0jirILIEEPln965e', 'User', 'Active', '2025-01-11 02:27:59', '2025-01-11 02:28:19'),
(15, 'Inga', 'Wolf', 'supaza@mailinator.com', '$2y$10$k6SC3KQnsWX9TTU2d9J8/ec7/wyFM7BD2Rs5lwjLLEY0IqCoMMg9a', 'Admin', 'Inactive', '2025-01-11 02:37:11', '2025-01-11 02:37:40'),
(16, 'Skyler', 'Norman', 'jodexypu@mailinator.com', '$2y$10$oHFNo01eMVkX/xh4qqTk0OKTBqi1IqjfyIZffXDUSnLc5gV2OnU6.', 'Admin', 'Active', '2025-01-11 02:39:11', '2025-01-11 02:39:11'),
(17, 'Hanna', 'Edwards', 'kyrinyja@mailinator.com', '$2y$10$n4JIf8xOKOzUVFHkvweJEOV9moaW9nHkXeogrvUCIC7zXlyW6Vfte', 'User', 'Active', '2025-01-11 02:44:05', '2025-01-11 02:44:05'),
(18, 'Infoflo', 'Test', 'infoflotestest@gmail.com', '$2y$10$AeG8GcoHRHY0QnNs..K/nuSSLSGiuTIyaCWENRgibHo3Fef0Zno/S', 'Admin', 'Active', '2025-01-11 06:00:22', '2025-01-11 06:00:22');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `assigned_to` (`assigned_to`);

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
-- AUTO_INCREMENT for table `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tasks`
--
ALTER TABLE `tasks`
  ADD CONSTRAINT `tasks_ibfk_1` FOREIGN KEY (`assigned_to`) REFERENCES `users` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
