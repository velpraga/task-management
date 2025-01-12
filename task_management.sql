-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 12, 2025 at 03:32 PM
-- Server version: 10.4.27-MariaDB
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
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `assigned_to` int(11) DEFAULT NULL,
  `status` enum('Pending','In Progress','Completed','On Hold','Cancelled') DEFAULT 'Pending',
  `priority` enum('Low','Medium','High','Critical') DEFAULT 'Medium',
  `due_date` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tasks`
--

INSERT INTO `tasks` (`id`, `title`, `description`, `assigned_to`, `status`, `priority`, `due_date`, `created_at`, `updated_at`) VALUES
(1, 'Facilis', 'Eveniet deserunt ne', 16, 'Pending', 'Critical', '2010-08-17', '2025-01-11 04:03:05', '2025-01-12 13:21:45'),
(3, 'Et quos aut a possim', 'Harum facilis ea min', 24, 'Completed', 'High', '2009-11-07', '2025-01-11 05:07:13', '2025-01-12 13:19:45'),
(4, 'Cumque dicta rerum i', 'Ut tempore explicab', 16, 'On Hold', 'Medium', '2021-11-30', '2025-01-11 05:08:40', '2025-01-12 13:25:47'),
(5, 'Deleniti tempor volu', 'Task completed', 19, 'Completed', 'Low', '2025-05-03', '2025-01-11 05:13:41', '2025-01-12 11:53:01'),
(7, 'Molestias veritatis', 'Ut explicabo Sed ne', 19, 'Cancelled', 'Medium', '2009-07-29', '2025-01-11 06:00:42', '2025-01-12 13:17:50'),
(9, 'Doloribus dolore dol', 'Error excepteur moll', 19, 'Pending', 'Critical', '2013-10-21', '2025-01-11 06:04:01', '2025-01-12 13:17:50'),
(11, 'Duis amet irure ess', 'Omnis occaecat error', 19, 'Pending', 'Medium', '2002-08-30', '2025-01-12 07:45:55', '2025-01-12 07:45:55'),
(12, 'Ipsum sunt aliqua', 'Et nulla quo accusam', 7, 'Pending', 'Medium', '1996-06-13', '2025-01-12 07:47:45', '2025-01-12 13:26:17'),
(13, 'Eu inventore laudant', 'Dignissimos molestia', 19, 'In Progress', 'High', '1972-05-05', '2025-01-12 07:49:28', '2025-01-12 13:26:27'),
(15, 'Magna similique volu', 'Dolor quo fugit sun', 19, 'On Hold', 'High', '1972-09-09', '2025-01-12 07:51:55', '2025-01-12 13:17:50'),
(16, 'Ratione enim libero', 'Mollit amet sed et', 19, 'On Hold', 'High', '2011-07-15', '2025-01-12 07:52:27', '2025-01-12 13:17:50'),
(17, 'Delectus non quia d', 'Doloremque optio no', 19, 'Pending', 'Low', '2002-01-19', '2025-01-12 07:53:48', '2025-01-12 13:17:50'),
(18, 'Ullamco et qui minim', 'In labore non ipsum', 19, 'In Progress', 'Medium', '2015-06-01', '2025-01-12 07:54:36', '2025-01-12 13:17:50');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('Admin','User') DEFAULT 'User',
  `status` enum('Active','Inactive') DEFAULT 'Active',
  `reset_password_token` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `password`, `role`, `status`, `reset_password_token`, `created_at`, `updated_at`) VALUES
(7, 'Vel 123', 'Murugan', 'velu@mailinator.com', '$2y$10$JgowDvS9pcw8P2D.S5iqv.b1zQ3qz3CPMvXVXiHqUijg6OyAipLBG', 'Admin', 'Active', NULL, '2025-01-06 15:29:22', '2025-01-12 13:14:55'),
(16, 'Skyler', 'Norman', 'jodexypu@mailinator.com', '$2y$10$oHFNo01eMVkX/xh4qqTk0OKTBqi1IqjfyIZffXDUSnLc5gV2OnU6.', 'Admin', 'Active', NULL, '2025-01-11 02:39:11', '2025-01-11 02:39:11'),
(17, 'Hanna', 'Edwards', 'kyrinyja@mailinator.com', '$2y$10$n4JIf8xOKOzUVFHkvweJEOV9moaW9nHkXeogrvUCIC7zXlyW6Vfte', 'User', 'Active', NULL, '2025-01-11 02:44:05', '2025-01-11 02:44:05'),
(18, 'Infoflo', 'Test', 'infoflotestest@gmail.com', '$2y$10$cO8qgowx6wJfl5TKp/zyFe36lZQ0np2Hlaw.6KOkofubtNnfopbFm', 'Admin', 'Active', '', '2025-01-11 06:00:22', '2025-01-12 13:30:56'),
(19, 'Muruga Sundaram', 'D', 'muruga@mailinator.com', '$2y$10$gvBmkdmII5E8aFkHZm7vgeDOEjMHJxmGrOPRLZu1S/ccp3MqxGqEm', 'User', 'Active', '', '2025-01-11 07:59:56', '2025-01-12 13:06:09'),
(20, 'Ginger', 'Rivera', 'punakeqah@mailinator.com', '$2y$10$bRatEGiGuKxP/7RoY50T3O9Ht/AYPIeNSI6yDRbLPAI5owD2Gay.W', 'User', 'Active', NULL, '2025-01-12 08:08:52', '2025-01-12 08:08:52'),
(21, 'Chadwick', 'Patrick', 'jilahil@mailinator.com', '$2y$10$vF0IKAOYNQFJVGIwj7D1iekFHsQ5QQho/uG6G7ZDaCjaab4A1ep.G', 'Admin', 'Inactive', NULL, '2025-01-12 08:09:04', '2025-01-12 08:09:04'),
(22, 'Rose', 'Vincent', 'zeguh@mailinator.com', '$2y$10$Arv2pypkyjfQe90Zx2KpYOhhNIOfxH9jC1lwxf.dSbgSg1ALfKhwS', 'User', 'Inactive', NULL, '2025-01-12 08:09:11', '2025-01-12 08:09:11'),
(23, 'Jin', 'Finley', 'zesokosot@mailinator.com', '$2y$10$DLrKQZwA/b5BdL2rRxqipeEPeP14zFTnfug9W06RZRe7pjfQIj4/.', 'User', 'Active', NULL, '2025-01-12 08:09:23', '2025-01-12 08:09:23'),
(24, 'Amal', 'Fox', 'fojujito@mailinator.com', '$2y$10$zCfkeiNf7qbjQfUTdQS.yeMkBD98LQGrDgkJnPtALXhbEbQr1fzTK', 'Admin', 'Active', NULL, '2025-01-12 08:09:32', '2025-01-12 08:09:32'),
(25, 'Hiram', 'Wyatt', 'vebajisas@mailinator.com', '$2y$10$1Qa4cF8GpzCarJP1f5pfW.9.ieX/Kr2TbLJ1z6X/iaQjgLFmK7.96', 'Admin', 'Inactive', NULL, '2025-01-12 08:09:44', '2025-01-12 08:09:44'),
(26, 'Ferdinand', 'Henderson', 'qocesuby@mailinator.com', '$2y$10$a4z9ozElcFzgUaALpV5/DOc7WNnX.rYzqb/x3W5MXY.FYjB/H.p4C', 'User', 'Active', NULL, '2025-01-12 08:36:53', '2025-01-12 08:36:53'),
(27, 'Haviva', 'Church', 'fijugy@mailinator.com', '$2y$10$AZfxak7vlCMVMSetfxJj3O7gPbNSyC.OhJQiPM5Q17GjJ6r2KHidW', 'User', 'Active', NULL, '2025-01-12 13:28:40', '2025-01-12 13:28:40');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

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
