-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 15, 2024 at 07:45 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.0.25

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
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2024_10_14_110113_add_role_to_users_table', 2),
(6, '2024_10_14_112323_create_tasks_table', 3),
(7, '2024_10_14_135433_add_user_id_to_tasks_table', 4),
(8, '2024_10_15_034338_add_assigned_by_to_tasks_table', 5);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Table structure for table `tasks`
--

CREATE TABLE `tasks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `priority` enum('low','medium','high') NOT NULL,
  `deadline` date NOT NULL,
  `document_path` varchar(255) DEFAULT NULL,
  `status` enum('pending','completed') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `assigned_by` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tasks`
--

INSERT INTO `tasks` (`id`, `title`, `description`, `priority`, `deadline`, `document_path`, `status`, `created_at`, `updated_at`, `user_id`, `assigned_by`) VALUES
(2, 'vvv', 'bbb', 'high', '2024-10-10', 'documents/LmiBbVEwivuRt9sVVITNIV7eG2TaG2tY7XYwcEA6.pdf', 'pending', '2024-10-14 10:49:27', '2024-10-14 10:49:27', NULL, 1),
(4, 'aaqq', 'aaa', 'medium', '2024-10-30', 'documents/Zm2dkbZnVZ99GgcSMn1bVqLRWjzPBgdnVbM7946z.pdf', 'pending', '2024-10-14 11:00:58', '2024-10-14 21:49:16', 5, 1),
(5, 'ww', 'ww', 'low', '2024-10-30', 'documents/rw35xS45vYnG8HVWlL3FWwgkghjalqMXdic0asaZ.pdf', 'pending', '2024-10-14 11:07:09', '2024-10-14 11:49:54', 3, 2),
(9, 'ss', 'sss', 'medium', '2024-10-24', 'documents/fPVJF05JAnzfp2wuNUX0pp5z0I3Do88eW1mrcI83.pdf', 'pending', '2024-10-14 21:53:16', '2024-10-14 21:59:50', 5, 1),
(10, 'work', 'work', 'medium', '2024-10-18', 'documents/FgVQ6RzchuamqL9UK5tu5L4UydJefKshwIUTlXEN.pdf', 'pending', '2024-10-14 21:57:08', '2024-10-14 21:57:08', 5, 2),
(11, 'mh', 'mh', 'high', '2024-10-18', 'documents/eHclkCkzCRgha2ceHiz51Y7TVlMm8GTkRMt65Rs9.pdf', 'pending', '2024-10-14 22:02:25', '2024-10-14 22:02:25', 5, 1),
(12, 'test', 'test', 'medium', '2024-10-25', 'documents/vyX3UFteYjkqj3kgwC1eS705iCZrRzv8USY04X0v.pdf', 'pending', '2024-10-14 22:06:49', '2024-10-14 22:06:49', 2, 1),
(14, 'ee', 'eee', 'medium', '2024-10-18', 'documents/bg4H1nH88rHTjNxUwQrfEqCZLLdmgzgurhsUM50F.pdf', 'pending', '2024-10-15 00:01:15', '2024-10-15 00:01:15', 4, 2),
(15, 'ee', 'eee', 'medium', '2024-10-18', 'documents/YPnKXpNITm4f1aZWXyj1iQTGnYuE3vrYRgaiXt64.pdf', 'pending', '2024-10-15 00:03:14', '2024-10-15 00:03:14', 4, 2),
(16, 'rr', 'rr', 'low', '2024-10-18', 'documents/ToN10uZsMZCVQ2X045ughksVx070I0X4akrEiaxj.pdf', 'pending', '2024-10-15 00:08:28', '2024-10-15 00:08:28', 5, 5),
(17, 'mnn', 'mnn', 'high', '2024-10-11', 'documents/5Jt5P6t12FZ1GDXol2STCryGlhDaWwjlMYX44piU.pdf', 'pending', '2024-10-15 00:11:18', '2024-10-15 00:11:18', 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `role` varchar(255) NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `role`) VALUES
(1, 'Admin User', 'admin@example.com', NULL, '$2y$10$072xee05WO55qVLqVIX6v.0vR5pXCKunY7afyjERpZcR.rWD24ZNG', NULL, '2024-10-14 05:48:32', '2024-10-14 05:48:32', 'admin'),
(2, 'Manager User', 'manager@example.com', NULL, '$2y$10$zTMHq9GkQE/0TJItPgUlSeCl/Pzb3h/mA3OYn3aXOQlgr1GaawD7.', NULL, '2024-10-14 05:48:32', '2024-10-14 05:48:32', 'manager'),
(3, 'Regular User', 'user@example.com', NULL, '$2y$10$m6f7mgTPincSLGkpj7yJN.wpGIrUmOTlT5GAmW9rpZyGwY/x68eeq', NULL, '2024-10-14 05:48:32', '2024-10-14 05:48:32', 'user'),
(4, 'mahesh', 'mahesh@gmail.com', NULL, '$2y$10$5STBAm8cDLFu0Q/nbEt.f.paqRfkuAHIzWpvWwDalJi9C19zaXzpm', NULL, '2024-10-14 07:36:05', '2024-10-14 07:36:05', 'user'),
(5, 'mh', 'mh@gmail.com', NULL, '$2y$10$.L2bFDy.Vn4WRUwBoIkRvOFLK8YNYACkFiBu6Xtb/03bTR/wh3Z4y', NULL, '2024-10-14 07:38:31', '2024-10-14 07:38:31', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tasks_user_id_foreign` (`user_id`),
  ADD KEY `tasks_assigned_by_foreign` (`assigned_by`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tasks`
--
ALTER TABLE `tasks`
  ADD CONSTRAINT `tasks_assigned_by_foreign` FOREIGN KEY (`assigned_by`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `tasks_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
