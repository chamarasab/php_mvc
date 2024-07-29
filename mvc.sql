-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jul 29, 2024 at 08:17 AM
-- Server version: 11.4.2-MariaDB
-- PHP Version: 8.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mvc`
--

-- --------------------------------------------------------

--
-- Table structure for table `inquiry`
--

CREATE TABLE `inquiry` (
  `no` int(11) NOT NULL,
  `id_type` varchar(50) DEFAULT NULL,
  `id_number` varchar(13) DEFAULT NULL,
  `requested_report` varchar(50) DEFAULT NULL,
  `report_date` date NOT NULL DEFAULT current_timestamp(),
  `subject_type` varchar(50) DEFAULT NULL,
  `scoring_tag` varchar(50) DEFAULT NULL,
  `created_at` date NOT NULL DEFAULT current_timestamp(),
  `batch_type` varchar(10) NOT NULL DEFAULT '01',
  `approval` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `inquiry`
--

INSERT INTO `inquiry` (`no`, `id_type`, `id_number`, `requested_report`, `report_date`, `subject_type`, `scoring_tag`, `created_at`, `batch_type`, `approval`) VALUES
(1, 'NIC', '123456789V', 'Credit Report', '2024-07-24', 'Individual', 'tag3', '2024-07-24', '01', 0),
(3, 'NIC', '987654321V', 'Credit Report', '2024-07-24', 'Individual', 'tag3', '2024-07-24', '01', 0),
(4, 'NIC', '951592315V', 'Credit Report', '2024-07-23', 'Individual', 'tag2', '2024-07-24', '01', 0),
(5, 'NIC', '951592335V', 'Credit Report', '2024-07-25', 'Individual', 'tag2', '2024-07-24', '02', 0),
(8, 'NIC', '951592135V', 'Credit Report', '2024-07-26', 'Individual', 'tag2', '2024-07-24', '01', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `expires_at` timestamp NULL DEFAULT (current_timestamp() + interval 1 minute)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`id`, `email`, `token`, `created_at`, `expires_at`) VALUES
(1, 'kalana@example.com', '74bb2887d7f56024e80a10df34d1d436', '2024-07-18 10:07:25', '2024-07-19 07:21:35'),
(2, 'chamara.orbit@gmail.com', '9e88388c43c3209d35d941fe6c831e55', '2024-07-18 10:10:17', '2024-07-19 07:21:35'),
(3, 'chamara.orbit@gmail.com', 'acbe652ad09584a88827fe14d51e9a26', '2024-07-18 10:26:14', '2024-07-19 07:21:35'),
(4, 'chamara.orbit@gmail.com', '0928fca85de6527890981c68c425990c', '2024-07-18 10:26:16', '2024-07-19 07:21:35'),
(5, 'chamara.orbit@gmail.com', 'dfc2d9295d38873c8a1f87a8ad623ba3', '2024-07-18 10:26:32', '2024-07-19 07:21:35'),
(6, 'chamara.orbit@gmail.com', '338e5768ddc4ef6b17d85a8d5dc01f2a', '2024-07-18 10:27:18', '2024-07-19 07:21:35'),
(7, 'chamara.orbit@gmail.com', 'c4193c1481333388c6cd192e484d9b20', '2024-07-18 10:27:39', '2024-07-19 07:21:35'),
(8, 'chamara.orbit@gmail.com', '87cfa30272cfca37dd3673338a44be80', '2024-07-18 10:29:05', '2024-07-19 07:21:35'),
(9, 'chamara.orbit@gmail.com', '6bf87f2470ddb6d2c6581c454afbaca2', '2024-07-18 10:29:06', '2024-07-19 07:21:35'),
(10, 'chamara.orbit@gmail.com', 'e6ba502eee65030c159ea0da0e7665db', '2024-07-18 10:32:21', '2024-07-19 07:21:35'),
(11, 'chamara.orbit@gmail.com', 'a31ff485b073053d6b8fbe577226c9da', '2024-07-18 10:32:28', '2024-07-19 07:21:35'),
(12, 'chamara.orbit@gmail.com', 'b9b2e7b083e918bb643a123d24c661c0', '2024-07-18 11:02:27', '2024-07-19 07:21:35'),
(13, 'chamara.orbit@gmail.com', '34875a99f062556cc3c6225fd3a877e1', '2024-07-18 11:12:46', '2024-07-19 07:21:35'),
(14, 'chamara.orbit@gmail.com', 'a08dab1f006a525a2bbbba4bab219491', '2024-07-18 11:25:19', '2024-07-19 07:21:35'),
(15, 'chamara.orbit@gmail.com', 'b2a28729a1fe4d575ca5ed51cb27f55e', '2024-07-18 11:31:05', '2024-07-19 07:21:35'),
(16, 'chamara.orbit@gmail.com', 'b3c6efa1173688959386f0160281fae5', '2024-07-18 11:31:53', '2024-07-19 07:21:35'),
(17, 'chamara.orbit@gmail.com', 'e4a1287b081fb009afb6d9b8df4d6988', '2024-07-18 11:31:59', '2024-07-19 07:21:35'),
(18, 'chamara.orbit@gmail.com', '845406750b4b14466dd3e8b035511790', '2024-07-18 11:47:24', '2024-07-19 07:21:35'),
(19, 'chamara.orbit@gmail.com', '0e7d8ab917645522d03ea65ffe7e75f7', '2024-07-18 11:47:35', '2024-07-19 07:21:35'),
(20, 'chamara.orbit@gmail.com', '5572041ac933e0bbe2c733235fbd2698', '2024-07-18 11:49:25', '2024-07-19 07:21:35'),
(21, 'chamara.orbit@gmail.com', 'fabe789c60de083a0b867fb43c824697', '2024-07-18 11:49:26', '2024-07-19 07:21:35'),
(22, 'chamara.orbit@gmail.com', 'f231e0e21d0aa76c3a4f3ac45e3f49e6', '2024-07-19 05:21:01', '2024-07-19 07:21:35'),
(23, 'chamara.orbit@gmail.com', '3452c5d6bbe9721fea4837682204a07f', '2024-07-19 05:21:03', '2024-07-19 07:21:35'),
(24, 'chamara.orbit@gmail.com', '113d597301c924afb95d4545b3220246', '2024-07-19 05:21:04', '2024-07-19 07:21:35'),
(25, 'chamara.orbit@gmail.com', '6d3af5e7832e0574b7ae8084da747866', '2024-07-19 05:21:05', '2024-07-19 07:21:35'),
(26, 'chamara.orbit@gmail.com', '3658787489ae6f510ecb9d7f44493dd7', '2024-07-19 05:21:24', '2024-07-19 07:21:35'),
(27, 'chamara.orbit@gmail.com', '7976232e7f7b0fc1138d181ff9e1b7bb', '2024-07-19 05:24:16', '2024-07-19 07:21:35'),
(28, 'chamara.orbit@gmail.com', 'f9d544cfd219d490a0e4df6b95177561', '2024-07-19 05:24:17', '2024-07-19 07:21:35'),
(29, 'chamara.orbit@gmail.com', 'f53eb0d5982067437c8e700ea1f10ad3', '2024-07-19 05:24:18', '2024-07-19 07:21:35'),
(30, 'chamara.orbit@gmail.com', 'd58cdb2933dadaa8aeb260429a9f630b', '2024-07-19 05:24:20', '2024-07-19 07:21:35'),
(31, 'chamara.orbit@gmail.com', 'dc6d2a59a121cf057cd2f24e587e15c4', '2024-07-19 05:24:54', '2024-07-19 07:21:35'),
(32, 'chamara.orbit@gmail.com', 'e93fa1e4e0ea4dba88453a70d7f1a82a', '2024-07-19 05:24:54', '2024-07-19 07:21:35'),
(33, 'chamara.orbit@gmail.com', 'e70467aaa289b7d983cf9c268b9f6e7f', '2024-07-19 05:54:40', '2024-07-19 07:21:35'),
(34, 'chamara.orbit@gmail.com', 'e07751bebef4c6be21928fea112022ae', '2024-07-19 05:54:42', '2024-07-19 07:21:35'),
(35, 'chamara.orbit@gmail.com', '505255aba864268f63bd0df971fd09fd', '2024-07-19 05:56:00', '2024-07-19 07:21:35'),
(36, 'chamara.orbit@gmail.com', '6f5aa35a9b988782c0bfcaa03991caf3', '2024-07-19 06:36:46', '2024-07-19 07:21:35'),
(37, 'chamara.orbit@gmail.com', '7679e8e5319a9ed0b8309e3bc13475f0', '2024-07-19 06:38:25', '2024-07-19 07:21:35'),
(38, 'chamara.orbit@gmail.com', '54b4e79479cef04a9c41911d2cf6fa05', '2024-07-19 06:40:15', '2024-07-19 07:21:35'),
(47, 'chamara.orbit@gmail.com', '5ffdd74c8d8f4efb460c4ae29fcf2bb2', '2024-07-21 08:51:44', '2024-07-21 08:52:44'),
(48, 'roxgustav@gmail.com', '706827127aea280c032293ab4170cf19', '2024-07-21 09:09:46', '2024-07-21 09:10:46'),
(50, 'chathurangarulz@gmail.com', '56e933a20d2c5e668f59db0fbef4b5b7', '2024-07-24 06:40:27', '2024-07-24 06:41:27'),
(51, 'chathurangarulz@gmail.com', 'cc2da5231e480b6c7f581e97140f832b', '2024-07-24 06:47:51', '2024-07-24 06:48:51');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `logged_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `logged_at`) VALUES
(1, 'John Doe', 'john.doe@example.com', '$2y$10$Wl.BHI1Isw8SwUJvYRvTqeQIpc0Ein5gsH/CukJCmX9XG5d3QScl2', '2024-07-18 05:42:09'),
(3, 'Malith Ekanayake', 'malith@example.com', '$2y$10$xyPJJC/X9NPn/f4wPU6gluHlInDwI29N4YUG8hpSrW6vSRCgdRhm2', '2024-07-18 05:44:40'),
(4, 'Saroja Ekanayake', 'saroja@example.com', '$2y$10$pHGUxq4VM/nUKTOUgkqDL.LtkMMmlzIiVe75lccn79xEMGk.EouWC', '2024-07-18 07:00:20'),
(7, 'Supun Chathuranga', 'supun@example.com', '$2y$10$xI6LvdSJIGBW9HMVLz79P.zxTrzq9P.eIEl8mV40Ql1iSdpgK4gkW', '2024-07-18 08:25:49'),
(9, 'Malan Jayasinghe', 'malan@example.com', '$2y$10$j1/CVom/qELkcuLLXt3CouzJZ8Q6J55gzyS6Px5CH3YzYZPH.tDkm', '2024-07-18 08:49:32'),
(10, 'Kalana Jayaweera', 'kalana@example.com', '$2y$10$ZxwYJ4k1kukF7ORES/0sr.M1Rm7SxJP0zuiZPiWWpFKtlMGja4Hr2', '2024-07-18 09:42:51'),
(15, 'Chamara Orbit', 'chamara.orbit@gmail.com', '$2y$10$YobN.d6p5Sl/L5fiste9HO16jMomoVguh0/HFUQ0vRU/6gNFLhRIy', '2024-07-24 06:53:43'),
(17, 'Chamara Ekanayake', 'chamaraekanayake.dev@gmail.com', '$2y$10$HAX1T9gXriOvUGcSNcH5PObufjXjAY4.86jKBKvNl9L3INUC8YWju', '2024-07-19 11:51:59'),
(24, 'Supun Chathuranga', 'chathurangarulz@gmail.com', '$2y$10$ZFIfruWMVHdBSDAKvZxpEOVGGJx4xmS90UMHkOhlR5v1ihrnXkYeK', '2024-07-24 06:40:01'),
(25, 'Ishara Priyadarshanai', 'ishara@gmail.com', '$2y$10$45o59wAZEGWTiLcqWdNq0elzcz7M5wqQ9saiMGzk7ICbYPXRl4Da.', '2024-07-24 06:54:21');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `inquiry`
--
ALTER TABLE `inquiry`
  ADD PRIMARY KEY (`no`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
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
-- AUTO_INCREMENT for table `inquiry`
--
ALTER TABLE `inquiry`
  MODIFY `no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `password_resets`
--
ALTER TABLE `password_resets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
