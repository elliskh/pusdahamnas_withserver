-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: mysql
-- Generation Time: Sep 13, 2022 at 10:31 AM
-- Server version: 10.6.4-MariaDB-1:10.6.4+maria~focal
-- PHP Version: 7.4.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ci-skote`
--

-- --------------------------------------------------------

--
-- Table structure for table `actions`
--

CREATE TABLE `actions` (
  `id` int(11) NOT NULL,
  `uuid` varchar(255) DEFAULT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `is_active` enum('0','1') DEFAULT '1',
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `actions`
--

INSERT INTO `actions` (`id`, `uuid`, `nama`, `is_active`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '7e661758-f17b-4112-8597-a76d4cf57421', 'lihat', '1', '2022-08-27 04:56:09', '2022-08-30 04:06:46', NULL),
(2, '0fd48d7a-0393-4cd5-adc7-979464fe16c0', 'tambah', '1', '2022-08-27 04:56:09', '2022-08-27 09:18:05', NULL),
(3, '6d30753a-f84d-40d8-a287-eabb7d8627b3', 'ubah', '1', '2022-08-27 04:56:09', '2022-08-27 09:18:05', NULL),
(4, '786630af-9d79-4e4a-a6b7-d6e162ed719e', 'hapus', '1', '2022-08-27 04:56:09', '2022-08-27 09:18:05', NULL),
(5, NULL, 'unduh', '', '2022-08-27 16:32:38', '2022-08-27 16:33:58', '2022-08-27 23:33:58');

-- --------------------------------------------------------

--
-- Table structure for table `ci_sessions`
--

CREATE TABLE `ci_sessions` (
  `id` varchar(128) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `timestamp` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `data` blob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `ci_sessions`
--

INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES
('5daab9d81ec6e3cd946856682c1c114de049bc19', '172.31.0.1', 1663065016, 0x5f5f63695f6c6173745f726567656e65726174657c693a313636333036353031363b69647c733a36303a226345354352533878524746696133423051305a76624373794e444e595a5456495654464b59575668646a564d56477472536e5977616a6c30647a303d223b6e616d617c733a31333a2241646d696e6973747261746f72223b757365726e616d657c733a353a2261646d696e223b726f6c655f69647c733a36303a224d466877566b524e54574a46626a56585a697443646b566b55314633613267784e46466e51574934555752524f5846714b7a64766546464a5254303d223b6e616d615f726f6c657c733a31333a2261646d696e6973747261746f72223b6d756c7469726f6c657c623a313b6d6f64657c733a353a226c69676874223b736964656261727c733a383a22766572746963616c223b62756c616e7c693a393b746168756e7c693a323032323b),
('c5d03a60add5951e973ddcec03e4ee454b2eaf88', '172.31.0.1', 1663065088, 0x5f5f63695f6c6173745f726567656e65726174657c693a313636333036353038383b);

-- --------------------------------------------------------

--
-- Table structure for table `contoh`
--

CREATE TABLE `contoh` (
  `id` int(11) NOT NULL,
  `uuid` varchar(255) DEFAULT NULL,
  `kolom_1` varchar(255) DEFAULT NULL,
  `kolom_2` varchar(255) DEFAULT NULL,
  `kolom_3` varchar(255) DEFAULT NULL,
  `is_active` enum('0','1') DEFAULT '1',
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `contoh`
--

INSERT INTO `contoh` (`id`, `uuid`, `kolom_1`, `kolom_2`, `kolom_3`, `is_active`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'test', 'test', 'test', 'test', '1', '2022-09-10 05:16:39', NULL, NULL),
(2, 'test', 'test', 'test', 'test', '1', '2022-09-10 05:16:39', NULL, NULL),
(3, 'test', 'test', 'test', 'test', '1', '2022-09-10 05:16:39', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `menus`
--

CREATE TABLE `menus` (
  `id` int(11) NOT NULL,
  `uuid` varchar(255) DEFAULT NULL,
  `ref_menu_group_id` int(11) DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `urutan` int(255) DEFAULT NULL,
  `route` varchar(255) DEFAULT NULL,
  `path` varchar(255) DEFAULT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `icon` varchar(255) DEFAULT NULL,
  `is_active` enum('0','1') DEFAULT '1',
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `menus`
--

INSERT INTO `menus` (`id`, `uuid`, `ref_menu_group_id`, `parent_id`, `urutan`, `route`, `path`, `nama`, `icon`, `is_active`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '3a553ae6-d07a-498b-8a59-eb1b4880fb22', 1, NULL, 1, 'dashboard/index', 'dashboard/', 'Beranda', 'bx bx-home-alt', '1', '2022-08-27 04:56:10', '2022-09-09 07:26:31', NULL),
(2, '9be618e6-2abd-4ef9-b1bc-288075b8662c', 2, NULL, 2, '#', NULL, 'Manajemen Menu', 'bx bx-menu-alt-left', '1', '2022-08-27 04:56:10', '2022-08-30 07:24:41', NULL),
(3, 'ea968bb0-4594-471f-b761-1f5db30447f1', 2, 2, 2, 'menu/index', 'menu/', 'Menu Utama', NULL, '1', '2022-08-27 04:56:10', '2022-09-09 06:55:13', NULL),
(4, 'cf3f5511-1559-4d6f-aecb-73e82b1a4870', 2, 2, 3, 'menu/sub', 'menu/', 'Sub Menu', NULL, '1', '2022-08-27 04:56:10', '2022-09-09 06:55:13', NULL),
(5, 'a33cee4a-0780-4b60-bd44-ec05f245431b', 2, NULL, 3, 'otoritas/index', 'otoritas/', 'Otoritas', 'bx bx-key', '1', '2022-08-27 04:56:10', '2022-09-09 06:55:13', NULL),
(6, '22cd2eaf-d1a7-41cc-8ee8-9fecab5b1274', 2, NULL, 5, 'users/index', 'users/', 'Pengguna', 'bx bx-user', '1', '2022-08-27 04:56:10', '2022-09-09 06:55:13', NULL),
(7, NULL, 2, NULL, 4, 'hak_akses/index', 'hak_akses/', 'Hak Akses', 'bx bx-lock-open', '1', '2022-08-27 07:37:35', '2022-09-09 06:55:13', NULL),
(8, '94b673c6-640d-4f99-b0e7-28b584ff0b48', NULL, 2, 1, 'referensi/group_menu/index', 'referensi/group_menu/', 'Grup Menu', NULL, '1', '2022-08-27 15:11:40', '2022-09-09 06:55:13', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `menu_role`
--

CREATE TABLE `menu_role` (
  `role_id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `action_id` int(11) NOT NULL,
  `is_active` enum('0','1') DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `menu_role`
--

INSERT INTO `menu_role` (`role_id`, `menu_id`, `action_id`, `is_active`) VALUES
(1, 1, 1, '1'),
(1, 1, 2, '0'),
(1, 1, 3, '0'),
(1, 1, 4, '0'),
(1, 2, 1, '1'),
(1, 3, 1, '1'),
(1, 3, 2, '1'),
(1, 3, 3, '1'),
(1, 3, 4, '1'),
(1, 4, 1, '1'),
(1, 4, 2, '1'),
(1, 4, 3, '1'),
(1, 4, 4, '1'),
(1, 5, 1, '1'),
(1, 5, 2, '1'),
(1, 5, 3, '1'),
(1, 5, 4, '1'),
(1, 6, 1, '1'),
(1, 6, 2, '1'),
(1, 6, 3, '1'),
(1, 6, 4, '1'),
(1, 7, 1, '1'),
(1, 7, 2, '1'),
(1, 7, 3, '1'),
(1, 7, 4, '1'),
(1, 8, 1, '1'),
(1, 8, 2, '1'),
(1, 8, 3, '1'),
(1, 8, 4, '1'),
(2, 1, 1, '1'),
(2, 1, 2, '0');

-- --------------------------------------------------------

--
-- Table structure for table `ref_menu_group`
--

CREATE TABLE `ref_menu_group` (
  `id` int(11) NOT NULL,
  `uuid` varchar(255) DEFAULT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `urutan` int(11) DEFAULT NULL,
  `is_active` enum('0','1') DEFAULT '1',
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `ref_menu_group`
--

INSERT INTO `ref_menu_group` (`id`, `uuid`, `nama`, `urutan`, `is_active`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '7a3da03e-89fd-4396-a47a-ad8a9b35c695', 'Dashboard', 1, '1', '2022-08-27 05:46:12', '2022-08-30 08:15:49', NULL),
(2, 'c7db7e15-c120-4224-8fe6-8cc63354e90e', 'Pengaturan', 3, '1', '2022-08-27 05:46:35', '2022-08-27 16:07:20', NULL),
(3, NULL, 'Utama', 2, '1', '2022-08-27 16:07:00', '2022-08-27 16:07:15', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `uuid` varchar(255) DEFAULT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `is_active` enum('0','1') DEFAULT '1',
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `uuid`, `nama`, `is_active`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'c03bd81b-3310-4a40-bf06-6dd811b90d77', 'administrator', '1', '2022-08-27 04:56:09', '2022-08-30 08:07:41', NULL),
(2, 'acc44540-857b-441d-afcb-b755367ef2e6', 'operator', '1', '2022-08-27 04:56:09', '2022-08-30 08:07:54', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `uuid` varchar(255) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `is_active` enum('0','1') DEFAULT '1',
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `uuid`, `username`, `email`, `password`, `nama`, `is_active`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '861e5d40-4415-44d8-a7b0-1d8a7d2b4433', 'admin', 'admin@email.com', '$argon2i$v=19$m=65536,t=4,p=1$V3RqZGZ4MDBBSUFOdlZmbA$Uug6urHzLLhEDCyjbKjfH4zc0Bk0WETlIwT4SdTozdw', 'Administrator', '1', '2022-08-27 04:56:10', '2022-09-12 12:52:38', NULL),
(2, '874da2f6-8556-4688-8b7e-c6b41df8071a', 'operator', 'operator@email.com', '$argon2i$v=19$m=65536,t=4,p=1$bzY1b1EvbzBoY0Vtekhwdg$HvZ5Ney2rqHsOV8P2ZqPFpQOPbRIE4xeF+gJoG4QsyI', 'Operator', '1', '2022-08-27 04:56:10', '2022-08-30 12:07:48', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_role`
--

CREATE TABLE `user_role` (
  `user_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `is_active` enum('0','1') DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `user_role`
--

INSERT INTO `user_role` (`user_id`, `role_id`, `is_active`) VALUES
(1, 1, '1'),
(1, 2, '1'),
(2, 1, '0'),
(2, 2, '1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `actions`
--
ALTER TABLE `actions`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `ci_sessions`
--
ALTER TABLE `ci_sessions`
  ADD KEY `ci_sessions_timestamp` (`timestamp`) USING BTREE;

--
-- Indexes for table `contoh`
--
ALTER TABLE `contoh`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `menu_role`
--
ALTER TABLE `menu_role`
  ADD PRIMARY KEY (`role_id`,`menu_id`,`action_id`) USING BTREE,
  ADD KEY `role` (`role_id`) USING BTREE,
  ADD KEY `menu` (`menu_id`) USING BTREE,
  ADD KEY `action` (`action_id`) USING BTREE;

--
-- Indexes for table `ref_menu_group`
--
ALTER TABLE `ref_menu_group`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `user_role`
--
ALTER TABLE `user_role`
  ADD PRIMARY KEY (`user_id`,`role_id`) USING BTREE;

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `actions`
--
ALTER TABLE `actions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `contoh`
--
ALTER TABLE `contoh`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `menus`
--
ALTER TABLE `menus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `ref_menu_group`
--
ALTER TABLE `ref_menu_group`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
