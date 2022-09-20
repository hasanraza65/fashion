-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 20, 2022 at 01:50 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.2.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fashion`
--

-- --------------------------------------------------------

--
-- Table structure for table `bank_details`
--

CREATE TABLE `bank_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `account_no` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bank_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `branch_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ifsc_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `banners`
--

CREATE TABLE `banners` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `banners`
--

INSERT INTO `banners` (`id`, `name`, `icon`, `created_at`, `updated_at`) VALUES
(1, 'test1', 'test.png', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `catlogs`
--

CREATE TABLE `catlogs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `img1` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `img2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `img3` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `catlog_categories`
--

CREATE TABLE `catlog_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `deliverystatuses`
--

CREATE TABLE `deliverystatuses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `comment` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ecom_order_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `deliverystatuses`
--

INSERT INTO `deliverystatuses` (`id`, `status`, `comment`, `ecom_order_id`, `created_at`, `updated_at`) VALUES
(3, 'Ordered', 'Order has been placed', 9, '2022-09-19 08:16:01', '2022-09-19 08:16:01'),
(4, 'Shipped', 'testing', 9, '2022-09-19 08:44:21', '2022-09-19 08:44:21'),
(5, 'Shipped', 'tesgggg', 9, '2022-09-19 08:46:40', '2022-09-19 08:46:40'),
(6, 'Arriving', 'ffff', 9, '2022-09-19 08:47:13', '2022-09-19 08:47:13'),
(7, 'Out for delivery', NULL, 9, '2022-09-19 08:47:46', '2022-09-19 08:47:46'),
(8, 'Out for delivery', NULL, 9, '2022-09-20 05:37:13', '2022-09-20 05:37:13'),
(9, 'Ordered', 'Order has been placed', 10, '2022-09-20 05:59:56', '2022-09-20 05:59:56');

-- --------------------------------------------------------

--
-- Table structure for table `designer_details`
--

CREATE TABLE `designer_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `title_tag` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `percentage` int(11) DEFAULT NULL,
  `adhar_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `adhar_pic` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lat` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lng` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `designer_products`
--

CREATE TABLE `designer_products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ecom_orders`
--

CREATE TABLE `ecom_orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `payment_status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Pending',
  `razorpayid` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `delivery_status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT 'Processing',
  `tracking_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `buyer_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ecom_orders`
--

INSERT INTO `ecom_orders` (`id`, `payment_status`, `razorpayid`, `delivery_status`, `tracking_id`, `buyer_id`, `created_at`, `updated_at`) VALUES
(1, 'Pending', NULL, 'Processing', NULL, 3, '2022-08-23 02:46:25', '2022-08-23 02:46:25'),
(2, 'Pending', NULL, 'Processing', NULL, 3, '2022-08-23 02:46:58', '2022-08-23 02:46:58'),
(3, 'Pending', NULL, 'Processing', NULL, 3, '2022-08-23 02:49:22', '2022-08-23 02:49:22'),
(4, 'Pending', NULL, 'Processing', NULL, 3, '2022-08-23 02:51:08', '2022-08-23 02:51:08'),
(5, 'Pending', NULL, 'Processing', NULL, 3, '2022-08-23 02:51:34', '2022-08-23 02:51:34'),
(8, 'Pending', NULL, 'Processing', NULL, 4, '2022-09-19 08:10:07', '2022-09-19 08:10:07'),
(9, 'Pending', NULL, 'Out for delivery', NULL, 4, '2022-09-19 08:16:01', '2022-09-20 05:37:13'),
(10, 'Pending', NULL, 'Processing', '30460147', 4, '2022-09-20 05:59:56', '2022-09-20 05:59:56');

-- --------------------------------------------------------

--
-- Table structure for table `ecom_order_items`
--

CREATE TABLE `ecom_order_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED DEFAULT NULL,
  `selected_qty` int(11) NOT NULL DEFAULT 0,
  `price` int(11) NOT NULL DEFAULT 0,
  `ecom_order_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ecom_order_items`
--

INSERT INTO `ecom_order_items` (`id`, `product_id`, `selected_qty`, `price`, `ecom_order_id`, `created_at`, `updated_at`) VALUES
(3, 4, 2, 200, 3, '2022-08-23 02:49:22', '2022-08-23 02:49:22'),
(4, 7, 3, 500, 3, '2022-08-23 02:49:22', '2022-08-23 02:49:22'),
(5, 4, 2, 200, 4, '2022-08-23 02:51:08', '2022-08-23 02:51:08'),
(6, 7, 3, 500, 4, '2022-08-23 02:51:08', '2022-08-23 02:51:08'),
(7, 4, 1, 200, 8, '2022-09-19 08:10:07', '2022-09-19 08:10:07'),
(8, 7, 1, 500, 8, '2022-09-19 08:10:07', '2022-09-19 08:10:07'),
(9, 4, 1, 200, 9, '2022-09-19 08:16:01', '2022-09-19 08:16:01'),
(10, 7, 1, 500, 9, '2022-09-19 08:16:01', '2022-09-19 08:16:01'),
(11, 4, 1, 200, 10, '2022-09-20 05:59:56', '2022-09-20 05:59:56'),
(12, 7, 1, 500, 10, '2022-09-20 05:59:56', '2022-09-20 05:59:56');

-- --------------------------------------------------------

--
-- Table structure for table `extras`
--

CREATE TABLE `extras` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` decimal(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `extra_orders`
--

CREATE TABLE `extra_orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` int(11) NOT NULL,
  `extra_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `total_amount` decimal(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `fabrics`
--

CREATE TABLE `fabrics` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon_image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `fabric_orders`
--

CREATE TABLE `fabric_orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` int(11) NOT NULL,
  `fabric_id` int(11) NOT NULL,
  `used_for` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `favorite_products`
--

CREATE TABLE `favorite_products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `favorite_products`
--

INSERT INTO `favorite_products` (`id`, `product_id`, `user_id`, `created_at`, `updated_at`) VALUES
(2, 2, 4, '2022-09-20 05:20:13', '2022-09-20 05:20:13');

-- --------------------------------------------------------

--
-- Table structure for table `manufacturer_details`
--

CREATE TABLE `manufacturer_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `percentage` int(11) DEFAULT NULL,
  `adhar_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `adhar_pic` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lat` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lng` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `manufacturing_costs`
--

CREATE TABLE `manufacturing_costs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `style_no` bigint(20) NOT NULL,
  `style_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `manufacuturing_cost` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `member_transactions`
--

CREATE TABLE `member_transactions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `amount` decimal(8,2) NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
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
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2016_06_01_000001_create_oauth_auth_codes_table', 1),
(4, '2016_06_01_000002_create_oauth_access_tokens_table', 1),
(5, '2016_06_01_000003_create_oauth_refresh_tokens_table', 1),
(6, '2016_06_01_000004_create_oauth_clients_table', 1),
(7, '2016_06_01_000005_create_oauth_personal_access_clients_table', 1),
(8, '2019_08_19_000000_create_failed_jobs_table', 1),
(9, '2020_12_22_063441_create_roles_table', 1),
(10, '2020_12_23_054947_create_designer_details_table', 1),
(11, '2020_12_23_055259_create_manufacturer_details_table', 1),
(12, '2020_12_23_055422_create_bank_details_table', 1),
(13, '2020_12_23_063754_create_fabrics_table', 1),
(14, '2020_12_23_070055_create_catlog_categories_table', 1),
(15, '2020_12_23_071657_create_catlogs_table', 1),
(16, '2020_12_23_072055_create_orders_table', 1),
(17, '2020_12_23_080800_create_order_details_table', 1),
(18, '2020_12_23_091510_create_transactions_table', 1),
(19, '2020_12_23_091751_create_member_transactions_table', 1),
(20, '2020_12_26_074738_create_extras_table', 1),
(21, '2020_12_26_115145_create_extra_orders_table', 1),
(22, '2020_12_27_235506_create_fabric_orders_table', 1),
(23, '2020_12_27_235734_create_manufacturing_costs_table', 1),
(24, '2020_12_30_012421_create_banners_table', 1),
(25, '2022_08_17_091530_create_product_categories_table', 1),
(26, '2022_08_17_091549_create_products_table', 1),
(27, '2022_08_22_092119_add_cols_to_products', 2),
(28, '2022_08_22_101336_alter_colsto_products', 3),
(29, '2022_08_22_111747_create_designer_products_table', 4),
(30, '2022_08_23_054759_create_table_ecom_orders', 4),
(31, '2022_08_23_060346_create_orders_items', 4),
(32, '2022_08_23_070032_create_ecom_order_items', 5),
(33, '2022_08_27_102146_addcolto_products', 6),
(34, '2022_08_31_080707_add_col_to_ecom_orders', 7),
(35, '2022_08_31_105927_addrazor_col_to_ecom_orders', 7),
(36, '2022_09_19_121423_addmorecolto_users', 8),
(37, '2022_09_19_124916_create_deliverystatuses_table', 9),
(38, '2022_09_20_090417_create_favorite_products_table', 10),
(39, '2022_09_20_103025_addmorecolto_product', 11),
(40, '2022_09_20_103605_addmorecolto_table_ecom_orders', 12);

-- --------------------------------------------------------

--
-- Table structure for table `oauth_access_tokens`
--

CREATE TABLE `oauth_access_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `oauth_access_tokens`
--

INSERT INTO `oauth_access_tokens` (`id`, `user_id`, `client_id`, `name`, `scopes`, `revoked`, `created_at`, `updated_at`, `expires_at`) VALUES
('11df122740792608b1113e25e74b052b6108bdf51e27681d2dc4b1fc8c7661825a4855ee2d08d993', 4, 1, 'authToken', '[]', 0, '2022-09-19 07:20:20', '2022-09-19 07:20:20', '2023-09-19 12:20:20'),
('3ba0262467b826f16741b084c18960dc96ef1557a624b817cca385e5819a99fb270a81fead2e709f', 4, 3, 'authToken', '[]', 0, '2022-09-19 07:26:35', '2022-09-19 07:26:35', '2023-09-19 12:26:35'),
('4096ff603f6a5b30f63030d13af10636032fe1e6de44bfb57a0298fe82275546894365c4a43b37ea', 3, 1, 'authToken', '[]', 0, '2022-09-19 07:19:58', '2022-09-19 07:19:58', '2023-09-19 12:19:58'),
('57806a33820d652e6ccda8a4f9b1249020c7ef0b17d497103204229c73e1b43a7f6bc6195ee4f95b', 4, 3, 'authToken', '[]', 0, '2022-09-20 04:17:09', '2022-09-20 04:17:09', '2023-09-20 09:17:09'),
('5ae4c082c064cb4aa0553477a898196dd01294a23f385c412124c6b69cfa850276a2d096f6638699', 4, 3, 'authToken', '[]', 0, '2022-09-19 07:28:38', '2022-09-19 07:28:38', '2023-09-19 12:28:38'),
('b00774a3cb7648ffd65d21b94c4d84a600bfa6da853d0fe945214411e71db263deb7d1fe51fedac4', 3, 1, 'authToken', '[]', 0, '2022-08-22 06:28:21', '2022-08-22 06:28:21', '2023-08-22 11:28:21'),
('d4292cc1586f72e1f2864ea6acba4bf9f1b0a38eb222435cc5b8f8b10fa8fbdb4ff384a3963c639e', 4, 3, 'authToken', '[]', 0, '2022-09-19 07:26:54', '2022-09-19 07:26:54', '2023-09-19 12:26:54'),
('dc968f5cda3241e0f3aa2ca7997ef520b3afa6ecb455cf48d61813fb4b020a9e779f0ee9acea2e91', 4, 3, 'authToken', '[]', 0, '2022-09-19 07:25:47', '2022-09-19 07:25:47', '2023-09-19 12:25:47'),
('f556cc15b1ab7ee5da875de957021d150ea43ab746b2d505f8786d4974445dd05bcc94bc23a8810e', 3, 1, 'authToken', '[]', 0, '2022-08-23 01:21:40', '2022-08-23 01:21:40', '2023-08-23 06:21:40');

-- --------------------------------------------------------

--
-- Table structure for table `oauth_auth_codes`
--

CREATE TABLE `oauth_auth_codes` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_clients`
--

CREATE TABLE `oauth_clients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `secret` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `provider` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `redirect` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `personal_access_client` tinyint(1) NOT NULL,
  `password_client` tinyint(1) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `oauth_clients`
--

INSERT INTO `oauth_clients` (`id`, `user_id`, `name`, `secret`, `provider`, `redirect`, `personal_access_client`, `password_client`, `revoked`, `created_at`, `updated_at`) VALUES
(1, NULL, 'Paint Personal Access Client', '8IN1gUh2NEeH6FH9WJdXF9xJMxf9j3DHB8agOmVp', NULL, 'http://localhost', 1, 0, 0, '2022-08-22 06:27:46', '2022-08-22 06:27:46'),
(2, NULL, 'Paint Password Grant Client', 'Ew50f91IdayGSsiKXXAGcHp22jSQ4ybSxTw4geEg', 'users', 'http://localhost', 0, 1, 0, '2022-08-22 06:27:46', '2022-08-22 06:27:46'),
(3, 4, 'personalaccess', '2MdN5uEspnnfC7z3MJrIMYox1PWLS5JwtNjiX7Sm', 'users', 'http://localhost', 1, 0, 0, '2022-09-19 07:25:37', '2022-09-19 07:25:37');

-- --------------------------------------------------------

--
-- Table structure for table `oauth_personal_access_clients`
--

CREATE TABLE `oauth_personal_access_clients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `oauth_personal_access_clients`
--

INSERT INTO `oauth_personal_access_clients` (`id`, `client_id`, `created_at`, `updated_at`) VALUES
(1, 1, '2022-08-22 06:27:46', '2022-08-22 06:27:46'),
(2, 3, '2022-09-19 07:25:37', '2022-09-19 07:25:37');

-- --------------------------------------------------------

--
-- Table structure for table `oauth_refresh_tokens`
--

CREATE TABLE `oauth_refresh_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `access_token_id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `designer_id` int(11) NOT NULL,
  `manufacturer_id` int(11) NOT NULL,
  `amount` decimal(8,2) NOT NULL,
  `payment_status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `order_status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` int(11) NOT NULL,
  `fabric_id` int(11) NOT NULL,
  `costing_table_id` int(11) NOT NULL,
  `design_image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_of_peice` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_id` bigint(20) UNSIGNED DEFAULT NULL,
  `p_price` double(8,2) DEFAULT NULL,
  `p_qty` int(11) DEFAULT NULL,
  `sort_description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rating` double(8,2) DEFAULT 5.00,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `in_stock` tinyint(1) NOT NULL DEFAULT 1,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `user_id`, `name`, `category_id`, `p_price`, `p_qty`, `sort_description`, `description`, `rating`, `image`, `in_stock`, `is_active`, `created_at`, `updated_at`) VALUES
(3, 1, 'Test 2', 1, 600.00, 500, 'short des 2', 'long des 2', 4.50, NULL, 1, 1, '2022-08-22 03:59:51', '2022-08-23 05:16:58'),
(4, 1, 'Test 3', 1, 400.00, 43, 'des 3', 'des 33', 5.00, '', 1, 1, '2022-08-22 04:11:12', '2022-09-20 05:59:56'),
(7, 3, 'product from api', 1, 800.00, 6, 'test short', 'test description', 5.00, '', 1, 1, '2022-08-22 06:50:12', '2022-09-20 05:59:56');

-- --------------------------------------------------------

--
-- Table structure for table `product_categories`
--

CREATE TABLE `product_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_categories`
--

INSERT INTO `product_categories` (`id`, `name`, `icon`, `created_at`, `updated_at`) VALUES
(1, 'Test 1', '', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `role_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `role_name`, `created_at`, `updated_at`) VALUES
(1, 'admin', NULL, NULL),
(2, 'designer', NULL, NULL),
(4, 'customer', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` int(11) NOT NULL,
  `razorpay_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` decimal(8,2) NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `role_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `gender` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remarks` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_approved` tinyint(1) NOT NULL DEFAULT 1,
  `is_admin` tinyint(1) NOT NULL DEFAULT 0,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `phone`, `city`, `address`, `dob`, `email_verified_at`, `role_id`, `gender`, `avatar`, `remarks`, `password`, `is_approved`, `is_admin`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@mail.com', '3403877126', NULL, NULL, NULL, NULL, '1', NULL, NULL, NULL, '$2y$10$janHpavCkF2WkBF4iazR3.j9PrV4DWRNtJ0VPAmq8ESSlPSZv1WT6', 1, 1, NULL, '2022-08-20 04:12:23', '2022-08-20 04:12:23'),
(3, 'Designer', 'designer@mail.com', '1234567891', NULL, NULL, NULL, NULL, '2', NULL, NULL, NULL, '$2y$10$janHpavCkF2WkBF4iazR3.j9PrV4DWRNtJ0VPAmq8ESSlPSZv1WT6', 1, 0, NULL, '2022-08-20 04:12:23', '2022-08-20 04:12:23'),
(4, 'Test customer', 'testcustomer@mail.com', '123456789', 'Mumbai', 'Mumbai, INDIA', NULL, NULL, '4', 'male', NULL, NULL, '$2y$10$janHpavCkF2WkBF4iazR3.j9PrV4DWRNtJ0VPAmq8ESSlPSZv1WT6', 1, 0, NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bank_details`
--
ALTER TABLE `bank_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `banners`
--
ALTER TABLE `banners`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `catlogs`
--
ALTER TABLE `catlogs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `catlog_categories`
--
ALTER TABLE `catlog_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `deliverystatuses`
--
ALTER TABLE `deliverystatuses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `designer_details`
--
ALTER TABLE `designer_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `designer_products`
--
ALTER TABLE `designer_products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ecom_orders`
--
ALTER TABLE `ecom_orders`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `ecom_orders_tracking_id_unique` (`tracking_id`),
  ADD KEY `ecom_orders_buyer_id_foreign` (`buyer_id`);

--
-- Indexes for table `ecom_order_items`
--
ALTER TABLE `ecom_order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ecom_order_items_product_id_foreign` (`product_id`),
  ADD KEY `ecom_order_items_ecom_order_id_foreign` (`ecom_order_id`);

--
-- Indexes for table `extras`
--
ALTER TABLE `extras`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `extra_orders`
--
ALTER TABLE `extra_orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fabrics`
--
ALTER TABLE `fabrics`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fabric_orders`
--
ALTER TABLE `fabric_orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `favorite_products`
--
ALTER TABLE `favorite_products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `manufacturer_details`
--
ALTER TABLE `manufacturer_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `manufacturing_costs`
--
ALTER TABLE `manufacturing_costs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `member_transactions`
--
ALTER TABLE `member_transactions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `oauth_access_tokens`
--
ALTER TABLE `oauth_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_access_tokens_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_auth_codes`
--
ALTER TABLE `oauth_auth_codes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_auth_codes_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_clients`
--
ALTER TABLE `oauth_clients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_clients_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `oauth_refresh_tokens`
--
ALTER TABLE `oauth_refresh_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_refresh_tokens_access_token_id_index` (`access_token_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `products_category_id_foreign` (`category_id`);

--
-- Indexes for table `product_categories`
--
ALTER TABLE `product_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_phone_unique` (`phone`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bank_details`
--
ALTER TABLE `bank_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `banners`
--
ALTER TABLE `banners`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `catlogs`
--
ALTER TABLE `catlogs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `catlog_categories`
--
ALTER TABLE `catlog_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `deliverystatuses`
--
ALTER TABLE `deliverystatuses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `designer_details`
--
ALTER TABLE `designer_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `designer_products`
--
ALTER TABLE `designer_products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ecom_orders`
--
ALTER TABLE `ecom_orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `ecom_order_items`
--
ALTER TABLE `ecom_order_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `extras`
--
ALTER TABLE `extras`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `extra_orders`
--
ALTER TABLE `extra_orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `fabrics`
--
ALTER TABLE `fabrics`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `fabric_orders`
--
ALTER TABLE `fabric_orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `favorite_products`
--
ALTER TABLE `favorite_products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `manufacturer_details`
--
ALTER TABLE `manufacturer_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `manufacturing_costs`
--
ALTER TABLE `manufacturing_costs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `member_transactions`
--
ALTER TABLE `member_transactions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `oauth_clients`
--
ALTER TABLE `oauth_clients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `product_categories`
--
ALTER TABLE `product_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `ecom_orders`
--
ALTER TABLE `ecom_orders`
  ADD CONSTRAINT `ecom_orders_buyer_id_foreign` FOREIGN KEY (`buyer_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `ecom_order_items`
--
ALTER TABLE `ecom_order_items`
  ADD CONSTRAINT `ecom_order_items_ecom_order_id_foreign` FOREIGN KEY (`ecom_order_id`) REFERENCES `ecom_orders` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `ecom_order_items_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `product_categories` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
