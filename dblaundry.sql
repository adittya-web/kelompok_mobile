-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 24, 2025 at 12:45 PM
-- Server version: 5.7.39
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dblaundry`
--

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `service_id` bigint(20) UNSIGNED NOT NULL,
  `weight` double NOT NULL,
  `pickup_date` date NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_price` decimal(10,2) NOT NULL,
  `status` enum('Menunggu Konfirmasi','Dijemput','Diproses','Selesai','Dikirim','Dibatalkan') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Menunggu Konfirmasi',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`id`, `user_id`, `service_id`, `weight`, `pickup_date`, `address`, `total_price`, `status`, `created_at`, `updated_at`) VALUES
(6, 4, 1, 1, '2025-07-15', 'Padang', 7000.00, 'Selesai', '2025-07-15 01:43:34', '2025-07-22 09:48:37'),
(7, 2, 1, 2, '2025-07-22', 'padang', 14000.00, 'Selesai', '2025-07-22 01:37:45', '2025-07-24 05:13:06'),
(8, 5, 1, 1, '2025-07-22', 'pyk', 7000.00, 'Dikirim', '2025-07-22 03:24:57', '2025-07-22 04:16:00'),
(9, 6, 2, 2, '2025-07-23', 'Padang', 18000.00, 'Selesai', '2025-07-22 11:32:13', '2025-07-22 11:33:24'),
(10, 7, 2, 1, '2025-07-23', 'padang', 9000.00, 'Selesai', '2025-07-23 01:19:26', '2025-07-23 01:34:46'),
(11, 7, 1, 2, '2025-07-24', 'jln gajah 2', 14000.00, 'Selesai', '2025-07-23 01:39:56', '2025-07-23 01:41:06'),
(12, 7, 2, 3, '2025-07-23', 'Padangq', 27000.00, 'Dikirim', '2025-07-23 01:45:36', '2025-07-23 02:11:30'),
(13, 8, 1, 1, '2025-07-23', 'Padang', 7000.00, 'Dikirim', '2025-07-23 02:04:09', '2025-07-23 02:06:12');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_06_23_094850_create_services_table', 1),
(5, '2025_06_23_095736_create_bookings_table', 1),
(6, '2025_06_23_095800_create_payments_table', 1),
(7, '2025_06_23_095914_create_order_trackings_table', 1),
(8, '2025_06_23_100333_create_personal_access_tokens_table', 1),
(9, '2025_07_22_090347_add_fcm_token_to_users_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `order_trackings`
--

CREATE TABLE `order_trackings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `booking_id` bigint(20) UNSIGNED NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `note` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(70) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `booking_id` bigint(20) UNSIGNED NOT NULL,
  `payment_method` enum('Transfer','COD') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Transfer',
  `payment_status` enum('Pending','Lunas','Gagal') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Pending',
  `proof_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `paid_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `booking_id`, `payment_method`, `payment_status`, `proof_image`, `paid_at`, `created_at`, `updated_at`) VALUES
(15, 7, 'COD', 'Lunas', NULL, NULL, '2025-07-22 01:39:03', '2025-07-22 01:39:22'),
(16, 9, 'COD', 'Lunas', NULL, NULL, '2025-07-22 11:33:55', '2025-07-22 11:34:06'),
(17, 13, 'Transfer', 'Lunas', NULL, NULL, '2025-07-23 02:05:38', '2025-07-23 02:05:54');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `personal_access_tokens`
--

INSERT INTO `personal_access_tokens` (`id`, `tokenable_type`, `tokenable_id`, `name`, `token`, `abilities`, `last_used_at`, `expires_at`, `created_at`, `updated_at`) VALUES
(1, 'App\\Models\\User', 1, 'mobile', '55bc099e4ff465dfdba372c5fd0f5db153ffa89ba5eda1876347a159ee8f3b5b', '[\"*\"]', NULL, NULL, '2025-06-27 03:15:26', '2025-06-27 03:15:26'),
(2, 'App\\Models\\User', 1, 'mobile', 'f0428762e83b92fb4cf8102b55788a062d6eb9baec373d4c25e7721c1d55f04e', '[\"*\"]', NULL, NULL, '2025-06-27 03:16:47', '2025-06-27 03:16:47'),
(3, 'App\\Models\\User', 1, 'mobile', 'a8f595fe73efa6cebf60cb4506a55f2e3ae29dcaf12a156ed23c27ec08f7e4b8', '[\"*\"]', NULL, NULL, '2025-06-27 03:24:09', '2025-06-27 03:24:09'),
(4, 'App\\Models\\User', 1, 'mobile', '0d8597d33bbdae7af230bd476b2f3638293bdbb2773fa18e389040fdef9a2d69', '[\"*\"]', NULL, NULL, '2025-06-27 03:29:06', '2025-06-27 03:29:06'),
(5, 'App\\Models\\User', 1, 'mobile', '99a6b3f6c69a3192d324f3004b2c427991d77d7ab8d11ca267e941df4adcd55f', '[\"*\"]', NULL, NULL, '2025-06-27 03:33:36', '2025-06-27 03:33:36'),
(6, 'App\\Models\\User', 1, 'mobile', '02d01ac90c1fc81423866930fe0c0cbb5e3364e3bf00942af2a8a301d1a6b36c', '[\"*\"]', '2025-06-27 03:49:09', NULL, '2025-06-27 03:48:43', '2025-06-27 03:49:09'),
(7, 'App\\Models\\User', 1, 'mobile', 'f4d6247096eb8521938db9c050cf7f7709b1c638c5f47350b67559362b4fd4aa', '[\"*\"]', '2025-06-27 04:03:02', NULL, '2025-06-27 04:02:29', '2025-06-27 04:03:02'),
(8, 'App\\Models\\User', 1, 'mobile', '2d74ba2a8f0d66ff6711552375f50d1cf91628391f34c051003b0e79a3a85607', '[\"*\"]', '2025-06-27 04:14:21', NULL, '2025-06-27 04:13:53', '2025-06-27 04:14:21'),
(9, 'App\\Models\\User', 1, 'mobile', '3b6d85b0eeb389a6a19bcf4aaec9d172373c7ee7932b44789438a39306abfdf1', '[\"*\"]', NULL, NULL, '2025-06-27 04:23:31', '2025-06-27 04:23:31'),
(10, 'App\\Models\\User', 1, 'mobile', '6b42a3a53cf06c8f8c608c42409690c4bcd53bc42e35f3f94c78b0d2fb5e0b26', '[\"*\"]', NULL, NULL, '2025-06-27 05:00:10', '2025-06-27 05:00:10'),
(11, 'App\\Models\\User', 1, 'mobile', '3496f73a97ce9f5d0bcfa493ee4bc947b89fc6d2c35e2143d5a4bb2ea6a8311b', '[\"*\"]', NULL, NULL, '2025-06-27 05:13:12', '2025-06-27 05:13:12'),
(12, 'App\\Models\\User', 2, 'mobile', '13323980b426a04f29c258eda543b0361a42e12181f32f94b86f6c57154ff581', '[\"*\"]', '2025-06-28 00:58:34', NULL, '2025-06-28 00:57:05', '2025-06-28 00:58:34'),
(13, 'App\\Models\\User', 2, 'mobile', '9c15ab8dd7895b5b59965bbe004ab693a9209c3cabd042fc7bdd1dbf200ac385', '[\"*\"]', '2025-06-28 01:00:28', NULL, '2025-06-28 01:00:20', '2025-06-28 01:00:28'),
(14, 'App\\Models\\User', 2, 'mobile', '48ea24447c885df15a0fba4d85e33e75c9779020a821f99ec4952199f701fd4c', '[\"*\"]', '2025-06-28 01:03:38', NULL, '2025-06-28 01:03:12', '2025-06-28 01:03:38'),
(15, 'App\\Models\\User', 2, 'mobile', 'a1b48159ffdcf7ea681588af6f27da17dd89126f9f01b035d8e7202e7364a773', '[\"*\"]', '2025-06-28 01:06:16', NULL, '2025-06-28 01:05:54', '2025-06-28 01:06:16'),
(16, 'App\\Models\\User', 2, 'mobile', '949ac2dcfd6d6e296bca695d7c81808db1b5de66d076b774fa558f93f5881dbe', '[\"*\"]', '2025-06-28 01:10:22', NULL, '2025-06-28 01:10:15', '2025-06-28 01:10:22'),
(17, 'App\\Models\\User', 2, 'mobile', '081ed60ddd4b16a4f11431af0012599351f1f871b66295f54f3329925ed24e65', '[\"*\"]', '2025-06-28 01:21:24', NULL, '2025-06-28 01:14:06', '2025-06-28 01:21:24'),
(18, 'App\\Models\\User', 2, 'mobile', 'efd8e21ebb6f03e05080579e8dcef8a743afe42bd658a2fa66710f77fc61065e', '[\"*\"]', '2025-06-28 01:27:36', NULL, '2025-06-28 01:27:12', '2025-06-28 01:27:36'),
(19, 'App\\Models\\User', 2, 'mobile', '3536b5ca7c343b84d6941544cdc9351591ea7b71ff81ba9b8b942269ea21dfc2', '[\"*\"]', '2025-06-28 01:30:25', NULL, '2025-06-28 01:30:17', '2025-06-28 01:30:25'),
(20, 'App\\Models\\User', 2, 'mobile', '38c4b4dfeecc7638394c878a6747a00d5926b874bd7959b92b13bd46afd921ab', '[\"*\"]', '2025-06-28 01:33:37', NULL, '2025-06-28 01:33:30', '2025-06-28 01:33:37'),
(21, 'App\\Models\\User', 2, 'mobile', '35d02ba9dfc3f7cec8820527d67353ad88f6c6eefec98a5674e5c6261b53d908', '[\"*\"]', '2025-06-28 01:35:08', NULL, '2025-06-28 01:35:00', '2025-06-28 01:35:08'),
(22, 'App\\Models\\User', 2, 'mobile', '27220d303db983b8e2dc43b24a65b5ebbbf5229bcd63f3d64fecedb757b58828', '[\"*\"]', '2025-06-28 01:38:14', NULL, '2025-06-28 01:38:07', '2025-06-28 01:38:14'),
(23, 'App\\Models\\User', 2, 'mobile', '16d695ba1a751c3517ec28a0b83faebfbe879e4e16581e928e2be5361140521c', '[\"*\"]', '2025-06-28 01:44:13', NULL, '2025-06-28 01:44:05', '2025-06-28 01:44:13'),
(24, 'App\\Models\\User', 2, 'mobile', '547c98455d8ea8aafb94e7227c9b27f23a6625a241e6399288d3d08d5d4bebde', '[\"*\"]', '2025-06-28 01:46:35', NULL, '2025-06-28 01:46:21', '2025-06-28 01:46:35'),
(25, 'App\\Models\\User', 2, 'mobile', 'b5c89bf1236c44607a98b8d8232bff91666e48feb34c12a59b08bf1df69e5eaa', '[\"*\"]', '2025-06-28 01:52:23', NULL, '2025-06-28 01:52:01', '2025-06-28 01:52:23'),
(26, 'App\\Models\\User', 2, 'mobile', '8cfa83980e0f52e3e2139726546a4da98dfd8c5aeff7588ba2975de85fe35a9f', '[\"*\"]', NULL, NULL, '2025-06-28 01:58:22', '2025-06-28 01:58:22'),
(27, 'App\\Models\\User', 2, 'mobile', '898a63a83840b073625c651d2f1703936042fa8d8ead01ee98a70d332f575964', '[\"*\"]', NULL, NULL, '2025-06-28 01:58:24', '2025-06-28 01:58:24'),
(28, 'App\\Models\\User', 2, 'mobile', 'd84f180614a5881415c046e0bf10247e62c9f43a3ce28c001010cb4211c95442', '[\"*\"]', NULL, NULL, '2025-06-28 01:58:24', '2025-06-28 01:58:24'),
(29, 'App\\Models\\User', 2, 'mobile', 'f6f5d7b26c7315c9df57cf45c09632593382d03e75d36eacce4dc3bfb5fcce45', '[\"*\"]', NULL, NULL, '2025-06-28 01:58:24', '2025-06-28 01:58:24'),
(30, 'App\\Models\\User', 2, 'mobile', '03c304ab19d99c38464e7cea6577b4bd70546a4a3c531f53fa30867547da2f26', '[\"*\"]', NULL, NULL, '2025-06-28 01:58:24', '2025-06-28 01:58:24'),
(31, 'App\\Models\\User', 2, 'mobile', 'a2a484bdc94a4ccde47a47048ce62ffda38df73f99fcc9b9b52a37198df04a8c', '[\"*\"]', NULL, NULL, '2025-06-28 01:58:24', '2025-06-28 01:58:24'),
(32, 'App\\Models\\User', 2, 'mobile', 'f84551dcda766f6c35c44bff11e27bda93609d6fcdd98a535587c5acfddf0b89', '[\"*\"]', NULL, NULL, '2025-06-28 01:58:24', '2025-06-28 01:58:24'),
(33, 'App\\Models\\User', 2, 'mobile', 'ef5535f2a7517ff2e4649bdb506734821431fd6ff4edf90fba72a96faaf6c122', '[\"*\"]', '2025-06-28 01:58:49', NULL, '2025-06-28 01:58:24', '2025-06-28 01:58:49'),
(34, 'App\\Models\\User', 2, 'mobile', 'd567f2d867047dd8f77891e6eabb355970db959060f15e815bfa14baa690d2a3', '[\"*\"]', '2025-06-28 02:04:08', NULL, '2025-06-28 02:03:59', '2025-06-28 02:04:08'),
(35, 'App\\Models\\User', 2, 'mobile', 'eedacae903d9e70512e96f7a7685a865cfb7d4c932eb156d1f1e326a8f3e395b', '[\"*\"]', '2025-06-28 02:07:30', NULL, '2025-06-28 02:06:57', '2025-06-28 02:07:30'),
(36, 'App\\Models\\User', 2, 'mobile', 'fd2513912f21af8a49aa8ba305a95d5d2630f4dd33bdb43207e473f80e4a8310', '[\"*\"]', '2025-06-28 02:21:37', NULL, '2025-06-28 02:13:25', '2025-06-28 02:21:37'),
(37, 'App\\Models\\User', 2, 'mobile', '8350a2e51007f9de063c828dd31e7b797668108cf221e6893dda9d9c27f7785b', '[\"*\"]', '2025-06-28 02:22:56', NULL, '2025-06-28 02:22:15', '2025-06-28 02:22:56'),
(38, 'App\\Models\\User', 2, 'mobile', '049c65c40b692603fb2f32d318045a3308880245263805a09a596a0db3e2ce92', '[\"*\"]', '2025-06-28 02:25:04', NULL, '2025-06-28 02:25:02', '2025-06-28 02:25:04'),
(39, 'App\\Models\\User', 2, 'mobile', '89642b61f481a3d7e6a6ca0ebdd7765be0755909b7e5079e2ef4ec8b41e8743a', '[\"*\"]', '2025-06-28 02:44:03', NULL, '2025-06-28 02:44:02', '2025-06-28 02:44:03'),
(40, 'App\\Models\\User', 2, 'mobile', '24792eb916ca2f730d780e9834678095993216e8b4d8dbddf5ffc38ad66b444e', '[\"*\"]', '2025-06-28 02:46:52', NULL, '2025-06-28 02:46:48', '2025-06-28 02:46:52'),
(41, 'App\\Models\\User', 2, 'mobile', '067a937384d726e5642e6724f762ce6c7272616358580539b9b019599b87dd37', '[\"*\"]', '2025-06-28 02:53:16', NULL, '2025-06-28 02:53:01', '2025-06-28 02:53:16'),
(42, 'App\\Models\\User', 2, 'mobile', 'a0725ad9276cd8a49e00561ac1e92ed330b2d8f7e82e7a12137048cd779958ba', '[\"*\"]', '2025-06-28 02:55:03', NULL, '2025-06-28 02:54:50', '2025-06-28 02:55:03'),
(43, 'App\\Models\\User', 2, 'mobile', '64e87ce9e84a2c1a1c7f3fde080578a80a4005c5237f1681e309dfecbc5fbbaf', '[\"*\"]', '2025-06-28 03:08:04', NULL, '2025-06-28 03:07:50', '2025-06-28 03:08:04'),
(44, 'App\\Models\\User', 2, 'mobile', 'fa9852c57dbd04328404f2aab9bfd2d92ed3913bf209de8dab0d303316b1d067', '[\"*\"]', '2025-06-28 03:10:27', NULL, '2025-06-28 03:10:01', '2025-06-28 03:10:27'),
(45, 'App\\Models\\User', 2, 'mobile', '574bce6e58efcb3c02835c5c4b08a86e12684c23a243c6c0dea04f8cc8598754', '[\"*\"]', '2025-06-28 03:12:12', NULL, '2025-06-28 03:12:01', '2025-06-28 03:12:12'),
(46, 'App\\Models\\User', 2, 'mobile', '21ab8b4bb594235f96d6d5652e1449fc3aa54da7df6faef50b4cdbbc62612f04', '[\"*\"]', '2025-06-28 03:15:14', NULL, '2025-06-28 03:15:12', '2025-06-28 03:15:14'),
(47, 'App\\Models\\User', 2, 'mobile', '21b64a991d271fd884f2d774c312c70b9f0e43b814663f0d99d44d344a9b3c3c', '[\"*\"]', '2025-06-28 03:16:23', NULL, '2025-06-28 03:15:47', '2025-06-28 03:16:23'),
(48, 'App\\Models\\User', 2, 'mobile', '12344c05d8bb6039a67ff82731dea63be5afe59b4f1ab0a5bd8244fe203ca923', '[\"*\"]', '2025-06-28 03:25:03', NULL, '2025-06-28 03:25:02', '2025-06-28 03:25:03'),
(49, 'App\\Models\\User', 2, 'mobile', '85c41714977a85076a3ce89d7436aeb4daa2e4e638d621c1a281ab50b77e1a4b', '[\"*\"]', '2025-06-28 03:26:26', NULL, '2025-06-28 03:25:53', '2025-06-28 03:26:26'),
(50, 'App\\Models\\User', 2, 'mobile', '4f4a5a895d0475c359478cb5fb4f129a1e788d3d9a2fb58e5a5176082bd5ed11', '[\"*\"]', '2025-06-28 03:30:56', NULL, '2025-06-28 03:30:45', '2025-06-28 03:30:56'),
(51, 'App\\Models\\User', 2, 'mobile', '056c40bb3fada16b14b4b7d621a6e892c6708f28312b0babd5f866dfb5f1a8ef', '[\"*\"]', NULL, NULL, '2025-06-28 03:35:05', '2025-06-28 03:35:05'),
(52, 'App\\Models\\User', 2, 'auth_token', 'b75870bcb11c4cd2e8c56b1fc98d09d15b6a3f3b085d89767a62dd895b3df9f8', '[\"*\"]', NULL, NULL, '2025-06-29 00:17:33', '2025-06-29 00:17:33'),
(53, 'App\\Models\\User', 2, 'auth_token', 'c2e8a087b4d8879dd3ac981506de941ed2536dfd2f81e32199e7d220beb2dc57', '[\"*\"]', NULL, NULL, '2025-06-29 00:22:34', '2025-06-29 00:22:34'),
(54, 'App\\Models\\User', 2, 'auth_token', 'b9d1578605dd06104b9abf70c22e2399830b37b052f157b745e0a601baa0c52b', '[\"*\"]', NULL, NULL, '2025-06-29 00:25:27', '2025-06-29 00:25:27'),
(55, 'App\\Models\\User', 2, 'auth_token', '96f99c53cad0d47f4d9d4bfcac5807136863036279035bf3c78d4ea008aef69e', '[\"*\"]', '2025-06-29 01:50:57', NULL, '2025-06-29 01:42:53', '2025-06-29 01:50:57'),
(56, 'App\\Models\\User', 2, 'auth_token', '2a57ded9788e943522fc037b080e50e008ed22c949c48ca0419afc5124fa9c80', '[\"*\"]', NULL, NULL, '2025-06-29 02:04:04', '2025-06-29 02:04:04'),
(57, 'App\\Models\\User', 2, 'auth_token', '481198e51694d2aebd5ee9495c543b290b4aa8206bed9b3ce13d0155dbf91cb4', '[\"*\"]', NULL, NULL, '2025-06-29 02:24:51', '2025-06-29 02:24:51'),
(58, 'App\\Models\\User', 2, 'auth_token', '06e1c86e894b48b86814526ffcbf88c33e57a996351da65b2206bdca91a1ff45', '[\"*\"]', NULL, NULL, '2025-06-29 02:25:26', '2025-06-29 02:25:26'),
(59, 'App\\Models\\User', 2, 'auth_token', 'be0dc3a38111405f900e253b17b773cd15e4304e9c6f0764a39fd4dbbc66474f', '[\"*\"]', NULL, NULL, '2025-06-29 02:27:55', '2025-06-29 02:27:55'),
(60, 'App\\Models\\User', 2, 'auth_token', '581e47edfb9f0e61623977313b88ce3e024009c8b88cc6038398d1284e253a6f', '[\"*\"]', NULL, NULL, '2025-06-29 02:31:22', '2025-06-29 02:31:22'),
(61, 'App\\Models\\User', 2, 'auth_token', '92a4455fc5eaddadb130301aa11a2e0c1bef33b8bdf08b3dcd6e537884299f31', '[\"*\"]', NULL, NULL, '2025-06-29 02:34:27', '2025-06-29 02:34:27'),
(62, 'App\\Models\\User', 2, 'auth_token', '0633de22fb0328fc2d0bbcaa8cc0ec28654de6505eb250bae3b243c133a68f85', '[\"*\"]', NULL, NULL, '2025-06-29 02:48:46', '2025-06-29 02:48:46'),
(63, 'App\\Models\\User', 2, 'auth_token', '0b582b411fc80f447b078f4f9c53bbfa09e724d61e7ef4d37c968cbe040f1ac1', '[\"*\"]', NULL, NULL, '2025-06-29 03:12:58', '2025-06-29 03:12:58'),
(64, 'App\\Models\\User', 2, 'auth_token', '4a099c1fc2a18ebe1848a3ec76d57ab680c6c8e0eea80f31470c81ecd3f74cae', '[\"*\"]', NULL, NULL, '2025-06-29 03:35:44', '2025-06-29 03:35:44'),
(65, 'App\\Models\\User', 2, 'auth_token', '3c90e25a24b0f0f467998a6ed7be37491b1b77d2c4934eb0b389e75a07b8e0da', '[\"*\"]', '2025-06-29 03:48:55', NULL, '2025-06-29 03:42:16', '2025-06-29 03:48:55'),
(66, 'App\\Models\\User', 2, 'auth_token', 'd782047d1622cc52231f68fdb5b482fdac109a9d7111014297ff1b088569bd51', '[\"*\"]', '2025-06-29 04:03:06', NULL, '2025-06-29 03:49:10', '2025-06-29 04:03:06'),
(67, 'App\\Models\\User', 2, 'auth_token', 'b801acdf429d6d7019557a2f0128c6aa58d5173b33759e34fe92e5848c9e3a42', '[\"*\"]', NULL, NULL, '2025-06-29 04:13:44', '2025-06-29 04:13:44'),
(68, 'App\\Models\\User', 2, 'auth_token', '2171464241f59a1a74b4ea9dbf8d527600a8b14f79ea1619f809652bf3064a24', '[\"*\"]', '2025-06-29 04:52:00', NULL, '2025-06-29 04:16:32', '2025-06-29 04:52:00'),
(69, 'App\\Models\\User', 2, 'auth_token', 'ec86bb28859714befde46d49b6b1dab4dcfd0564406dbee6fd6ea3dc1cc152ab', '[\"*\"]', NULL, NULL, '2025-06-29 05:34:31', '2025-06-29 05:34:31'),
(70, 'App\\Models\\User', 2, 'auth_token', '0aa145c70fa8ac59708601d4574dbf7a2d244a8835484396b517996c0fa87041', '[\"*\"]', NULL, NULL, '2025-06-30 09:35:11', '2025-06-30 09:35:11'),
(71, 'App\\Models\\User', 2, 'auth_token', 'c0ff3dfe2c13a77797a0dfbcb5018bd3e8e42bfbb980e7e7d07371d8c464bccb', '[\"*\"]', '2025-07-07 03:37:48', NULL, '2025-07-01 05:13:05', '2025-07-07 03:37:48'),
(72, 'App\\Models\\User', 4, 'auth_token', '8a6c2645156c652c8f9212fbb44c35843ea00874db8559810281287d3d22290b', '[\"*\"]', '2025-07-15 01:49:00', NULL, '2025-07-07 04:10:50', '2025-07-15 01:49:00'),
(73, 'App\\Models\\User', 2, 'token-name', '8356dad475d626315a6ca522eeacce4ee828b133fed7a315dcae294187bd4fc5', '[\"*\"]', NULL, NULL, '2025-07-22 01:34:55', '2025-07-22 01:34:55'),
(74, 'App\\Models\\User', 2, 'token-name', 'a1274b10e0d4628a743a2985e0109c8edaa54544202c3aac4161eed838ad539e', '[\"*\"]', '2025-07-22 01:44:50', NULL, '2025-07-22 01:35:52', '2025-07-22 01:44:50'),
(75, 'App\\Models\\User', 5, 'token-name', '2d7fc3052f105fde55c5c6ca1a6b242c54f7c3f4f9f127bec2a9bd14259665f6', '[\"*\"]', NULL, NULL, '2025-07-22 02:35:02', '2025-07-22 02:35:02'),
(76, 'App\\Models\\User', 5, 'token-name', 'fdc3ad83f1d77d017bfe01018a14cc7d8e7dea71e8afdbd222cf88ef4125bc11', '[\"*\"]', '2025-07-22 03:32:39', NULL, '2025-07-22 03:24:34', '2025-07-22 03:32:39'),
(77, 'App\\Models\\User', 5, 'token-name', 'd7b91c2e8b569f8583813681d7336e3f0edee3102fe6942301f63814172a28a3', '[\"*\"]', '2025-07-22 03:48:28', NULL, '2025-07-22 03:46:07', '2025-07-22 03:48:28'),
(78, 'App\\Models\\User', 5, 'token-name', '203ef7f57623557da9a638e2db11157818e64ebd329d77910090f3ea81eec25d', '[\"*\"]', '2025-07-22 03:58:08', NULL, '2025-07-22 03:57:29', '2025-07-22 03:58:08'),
(79, 'App\\Models\\User', 5, 'token-name', '70e7e2e3ec93a552bed71b7aa9645a12734d70b2905d1a623a274576c08d5d46', '[\"*\"]', '2025-07-22 04:16:11', NULL, '2025-07-22 04:15:34', '2025-07-22 04:16:11'),
(80, 'App\\Models\\User', 2, 'token-name', 'ac8957497edc7d68ef88bd4f7c23f3f73c8536425c49dbfa390714c12ab917d8', '[\"*\"]', '2025-07-22 09:05:30', NULL, '2025-07-22 08:50:39', '2025-07-22 09:05:30'),
(81, 'App\\Models\\User', 2, 'token-name', 'b90f62436ea471a40e3a178c335788f81a5a67e83aafd91473ba54059803901f', '[\"*\"]', '2025-07-22 09:07:49', NULL, '2025-07-22 09:07:39', '2025-07-22 09:07:49'),
(82, 'App\\Models\\User', 2, 'token-name', '34d6a6986805da9537c460c3c2b380322158f39d7af5827dddb6570e6b42eaff', '[\"*\"]', '2025-07-22 09:32:00', NULL, '2025-07-22 09:30:50', '2025-07-22 09:32:00'),
(83, 'App\\Models\\User', 2, 'token-name', '2723873d65e31fb5d55032f1f660644f5a47d3d07f37ab4d0bb55ac0a84a9f29', '[\"*\"]', '2025-07-22 09:33:55', NULL, '2025-07-22 09:33:51', '2025-07-22 09:33:55'),
(84, 'App\\Models\\User', 2, 'token-name', 'eef437e3dd12d93aeb0ac710bf17c805375ec2a9125bc87b90a4047cd384bc49', '[\"*\"]', '2025-07-22 09:36:01', NULL, '2025-07-22 09:35:58', '2025-07-22 09:36:01'),
(85, 'App\\Models\\User', 2, 'token-name', '92c6043ce76e749ffd89890fe12815c993e9365b10b6e333ebd36d236529a3ac', '[\"*\"]', '2025-07-22 09:40:38', NULL, '2025-07-22 09:40:32', '2025-07-22 09:40:38'),
(86, 'App\\Models\\User', 2, 'token-name', '0e6344195f3914be5b2fdcaae43337da09d89568c516abc468fce05419f283de', '[\"*\"]', '2025-07-22 09:45:08', NULL, '2025-07-22 09:44:59', '2025-07-22 09:45:08'),
(87, 'App\\Models\\User', 2, 'token-name', '9284169bc83b5b206d1e10b9a51a013ee48eee94b1eddf141304b2655aac100e', '[\"*\"]', '2025-07-22 09:54:40', NULL, '2025-07-22 09:47:20', '2025-07-22 09:54:40'),
(88, 'App\\Models\\User', 2, 'token-name', '05592aa140aa100c7e82228896b807753b62b01a16fe8153181cc1959ec3d397', '[\"*\"]', '2025-07-22 10:00:38', NULL, '2025-07-22 10:00:34', '2025-07-22 10:00:38'),
(89, 'App\\Models\\User', 6, 'authToken', 'ef202112d4f45cd9be2019ee1cddb0e3d75e0686defb2c632e1249e7ef5bd140', '[\"*\"]', '2025-07-22 10:54:18', NULL, '2025-07-22 10:54:16', '2025-07-22 10:54:18'),
(90, 'App\\Models\\User', 6, 'authToken', '9179d758b6b09933ed48db566431e3493ecf1166637b006e8b6f6332381e54d6', '[\"*\"]', '2025-07-22 10:54:49', NULL, '2025-07-22 10:54:48', '2025-07-22 10:54:49'),
(91, 'App\\Models\\User', 7, 'authToken', '41ef4c3efd700dea255b7c6dd5b6b84861caf4833a23782b134251fa34e07236', '[\"*\"]', '2025-07-22 10:56:27', NULL, '2025-07-22 10:56:26', '2025-07-22 10:56:27'),
(92, 'App\\Models\\User', 2, 'token-name', 'deba6273a921e52b1c6bab24bd32725a5c938dc3c2c527f12818e6bd19b22070', '[\"*\"]', '2025-07-22 11:30:39', NULL, '2025-07-22 11:14:11', '2025-07-22 11:30:39'),
(93, 'App\\Models\\User', 6, 'authToken', '0b1238013234710eff8c3a1fce1de32fcc50c223ea4d6482aa59b7db5070070d', '[\"*\"]', '2025-07-22 11:35:17', NULL, '2025-07-22 11:31:44', '2025-07-22 11:35:17'),
(94, 'App\\Models\\User', 7, 'authToken', 'ed4e4b9064ab0ebdb37158bb9d91a6d92453f29d423584c9e5f559a0d195061b', '[\"*\"]', '2025-07-23 01:20:11', NULL, '2025-07-23 01:19:10', '2025-07-23 01:20:11'),
(95, 'App\\Models\\User', 7, 'authToken', 'defd498a50421f705f0601da0c061c5eed2ef86144b4613d7cd8395c22785de0', '[\"*\"]', '2025-07-23 01:23:33', NULL, '2025-07-23 01:20:52', '2025-07-23 01:23:33'),
(96, 'App\\Models\\User', 7, 'authToken', '699fb009669224615004acca8bbb618d0ee61b6bf2440ab9b417d2db800eb48b', '[\"*\"]', '2025-07-23 01:27:20', NULL, '2025-07-23 01:27:20', '2025-07-23 01:27:20'),
(97, 'App\\Models\\User', 7, 'authToken', 'ff50470574ab7bde7505ea230535df5c119707774265788388c0c52dc0bbcb0f', '[\"*\"]', '2025-07-23 01:29:19', NULL, '2025-07-23 01:28:34', '2025-07-23 01:29:19'),
(98, 'App\\Models\\User', 7, 'authToken', '7aa2c6697f8590d405c54ef8131e2e15224fc203d4b9b1834e31b94d5c5416a8', '[\"*\"]', '2025-07-23 01:35:06', NULL, '2025-07-23 01:29:38', '2025-07-23 01:35:06'),
(99, 'App\\Models\\User', 7, 'authToken', '52f5eb57fd4ad7ac6ac3f3b3732bfa7a3da34b170a4316c0fc9960275d7d02a2', '[\"*\"]', '2025-07-23 01:46:10', NULL, '2025-07-23 01:35:21', '2025-07-23 01:46:10'),
(100, 'App\\Models\\User', 8, 'authToken', 'dcc9b87f82c0279bdb7b33b1999a7da9b851785ba8ec0186097d56421fd105cf', '[\"*\"]', '2025-07-23 02:06:14', NULL, '2025-07-23 02:03:42', '2025-07-23 02:06:14'),
(101, 'App\\Models\\User', 2, 'token-name', 'eef8634159bcc1e4673b41b68c6114c09b6298076aec7019f19ec460156947ce', '[\"*\"]', '2025-07-24 05:14:20', NULL, '2025-07-24 05:12:37', '2025-07-24 05:14:20'),
(102, 'App\\Models\\User', 7, 'authToken', 'b56f7b1e001692b534e519712b205ebc66f75a862e907c6a848863543a2b2eba', '[\"*\"]', '2025-07-24 05:26:51', NULL, '2025-07-24 05:24:14', '2025-07-24 05:26:51'),
(103, 'App\\Models\\User', 7, 'authToken', '73fac5e275902be68b6a9fbbd00d3c551990195026e592795f373c9a49b3d2e0', '[\"*\"]', '2025-07-24 05:28:13', NULL, '2025-07-24 05:27:11', '2025-07-24 05:28:13');

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `keterangan` text COLLATE utf8mb4_unicode_ci,
  `harga` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `nama`, `keterangan`, `harga`, `created_at`, `updated_at`) VALUES
(1, 'Cuci Kering', 'Laundry Cuci Kering', 7000.00, '2025-06-27 02:42:56', '2025-06-27 02:42:56'),
(2, 'Cuci Setrika', 'Laundry Cuci Setrika', 9000.00, '2025-06-27 02:43:17', '2025-06-27 02:43:17');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('hqW3D9D8osQh80iM3GJqDSWJOwI6zh8svXBNx2ok', 2, '10.28.208.185', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:140.0) Gecko/20100101 Firefox/140.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiU0d4aGx0TlByV2IybEVLTTdlazJOazBqc3pZT1ZsUzQ3ZUpFZWJVZiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzQ6Imh0dHA6Ly8xMC4yOC4yMDguMTg1OjgwMDAvYm9va2luZ3MiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToyO30=', 1753359190),
('Jq9djLIYTFZzxjuIwkPmzpTe2mf91MzpTahQFcve', NULL, '10.17.12.185', 'PostmanRuntime/7.39.1', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoib25LeFVFOTA5NzlIdEpzeVJsSHdtWDNsVWlkU292Wnd2dTdlamRUdCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzA6Imh0dHA6Ly8xMC4xNy4xMi4xODU6ODAwMC9sb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1753182511),
('QFVHlpT9hgSVn4lLeOXUvBSIz9BBcbz99rjhm4DY', 2, '10.17.12.185', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36 Edg/138.0.0.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiWVBnUjNUUlRwQXFEWGlUaE1SSm5DZ1pWdkZ5T2pIcTU5YkRGT0NoNCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzI6Imh0dHA6Ly8xMC4xNy4xMi4xODU6ODAwMC9sYXBvcmFuIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6Mjt9', 1753262500),
('xLHkAKqhk9Vemcqu7SkscYOJXVajvcaTx5omPYNQ', 2, '192.168.1.5', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:140.0) Gecko/20100101 Firefox/140.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiRkdldE9CczdwZnFhUkI4RVYzYWpHU2VQemxGZlZ0cm1yQzFxWFliZiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzI6Imh0dHA6Ly8xOTIuMTY4LjEuNTo4MDAwL3BheW1lbnRzIjt9czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6Mjt9', 1753209246),
('YfKgPRC417VE4ydEUi4hcHAacvDsfvDem04JBQ1t', 2, '10.17.12.185', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:140.0) Gecko/20100101 Firefox/140.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiTzVmMHRmdVRlVVZLa1BWSkFkb3dZeXhHb2g0ejVaTUs4QTk4MFF1cSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzM6Imh0dHA6Ly8xMC4xNy4xMi4xODU6ODAwMC9ib29raW5ncyI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjI7fQ==', 1753182961);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(70) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `fcm_token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `fcm_token`) VALUES
(1, 'attaya', 'attaya@gmail.com', NULL, '$2y$12$zFWZkbCSR44Zmi.UYFQDnOMzwNSYQpQTF2vXMGXbq4EJpPw5Sjo7q', NULL, '2025-06-27 02:47:40', '2025-06-27 02:47:40', NULL),
(2, 'attayafp', 'attayafp@gmail.com', NULL, '$2y$12$jJ2XN2lWa9Qd3FE5P3.y/u.PIuyFTkILaFYmr7ergOwJrO7RoUlsa', NULL, '2025-06-28 00:53:09', '2025-07-22 08:50:39', 'e3d9DBpvRAegWjafzr1bp1:APA91bHZEEZwkHMM0QY0qRGeatQcGBoc3kEoFmcqYHNDY6XYijvBe0Tikk1sgxZqsAwM4F-jVy7hsL7Sq3ddW3itOC4_mUJ_l1-DZLUDsLNe2oEWHV5WJi0'),
(3, 'pakis', 'pakis@gmail.com', NULL, '$2y$12$pYhsHcftwMOikeHFfErp3u5NPoeFF07q3//Oi1R/gQpiMvWbPYHiG', NULL, '2025-06-30 01:18:16', '2025-06-30 01:18:16', NULL),
(4, 'fadil', 'fadil@gmail.com', NULL, '$2y$12$kjhia/3BKyZoGvwmyRHC8OrbHkQu1YngdMmEGlCND/CTwKvErHtPG', NULL, '2025-07-07 00:22:29', '2025-07-07 00:22:29', NULL),
(5, 'mail', 'mail@gmail.com', NULL, '$2y$10$hR2GemBUwjz/76fUV9ylPeDlc/mQAy60BvIbQ4HrBNWhIKrdegC3i', NULL, '2025-07-22 08:26:37', '2025-07-22 04:15:34', 'e3d9DBpvRAegWjafzr1bp1:APA91bHZEEZwkHMM0QY0qRGeatQcGBoc3kEoFmcqYHNDY6XYijvBe0Tikk1sgxZqsAwM4F-jVy7hsL7Sq3ddW3itOC4_mUJ_l1-DZLUDsLNe2oEWHV5WJi0'),
(6, 'Attaya', 'ataya230223@gmail.com', NULL, '$2y$12$fPiHL9tPXXXRXurcOYNX1O1E2Grnbnh9hclLu2w64UdhT3hGeIcna', NULL, '2025-07-22 10:54:16', '2025-07-22 10:54:17', 'e3d9DBpvRAegWjafzr1bp1:APA91bHZEEZwkHMM0QY0qRGeatQcGBoc3kEoFmcqYHNDY6XYijvBe0Tikk1sgxZqsAwM4F-jVy7hsL7Sq3ddW3itOC4_mUJ_l1-DZLUDsLNe2oEWHV5WJi0'),
(7, 'Attaya Fiqri Pradana', 'attaya040404@gmail.com', NULL, '$2y$12$Z9lp0Lxya1BsxvDIyzRw3O8CyiT4iDYbMwkjgxI6UuZziqencpiDS', NULL, '2025-07-22 10:56:26', '2025-07-22 10:56:26', 'e3d9DBpvRAegWjafzr1bp1:APA91bHZEEZwkHMM0QY0qRGeatQcGBoc3kEoFmcqYHNDY6XYijvBe0Tikk1sgxZqsAwM4F-jVy7hsL7Sq3ddW3itOC4_mUJ_l1-DZLUDsLNe2oEWHV5WJi0'),
(8, 'Adittya Alyandra', 'adittyaalyandra224@gmail.com', NULL, '$2y$12$x2bKhcJhswfW5m39jl4.PO43ikOto8CF8fojqrX69et7fauuQtezG', NULL, '2025-07-23 02:03:42', '2025-07-23 02:03:42', 'eLHRbqnETf--pFEV4ohZIR:APA91bEN_AA7U3nF--FXX9p-hMJdHMeVxKI577JHZ2IHnO7Nkv7Z564J1fLll8_X6ZcpqHHPU4l7VwGM60Ysrjo88dRoKs40ikTi_0AQpMFZNxJwxtRjZSE');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bookings_user_id_foreign` (`user_id`),
  ADD KEY `bookings_service_id_foreign` (`service_id`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_trackings`
--
ALTER TABLE `order_trackings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_trackings_booking_id_foreign` (`booking_id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `payments_booking_id_foreign` (`booking_id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

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
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `order_trackings`
--
ALTER TABLE `order_trackings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=104;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bookings`
--
ALTER TABLE `bookings`
  ADD CONSTRAINT `bookings_service_id_foreign` FOREIGN KEY (`service_id`) REFERENCES `services` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `bookings_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `order_trackings`
--
ALTER TABLE `order_trackings`
  ADD CONSTRAINT `order_trackings_booking_id_foreign` FOREIGN KEY (`booking_id`) REFERENCES `bookings` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payments_booking_id_foreign` FOREIGN KEY (`booking_id`) REFERENCES `bookings` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
