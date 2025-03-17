-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th3 17, 2025 lúc 01:04 PM
-- Phiên bản máy phục vụ: 10.4.28-MariaDB
-- Phiên bản PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `ecommerce2024`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `carts`
--

CREATE TABLE `carts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `category` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `quantity` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `image` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `categories`
--

INSERT INTO `categories` (`id`, `name`, `image`, `created_at`, `updated_at`) VALUES
(1, 'Vòng cổ', 'categories/45LoTJYSjMGz0wzvQBzVlhsFPXKaGofjLOxUxGPH.png', '2024-10-06 01:29:11', '2024-10-05 18:41:22'),
(2, 'Hoa tai', 'categories/p6shapBjzJtZILLdOATnh1yx5gyldo6X8N6DK4vB.jpg', '2024-10-06 01:29:11', '2024-10-05 19:33:34'),
(3, 'Vòng tay', 'categories/0c1oA75lTZi5mCKhLZZ1byG8ySDguKEybrusqilD.png', '2024-10-06 01:29:11', '2024-10-05 19:33:49'),
(4, 'Nhẫn', 'categories/zkFvvQqdwEzx00XgTzaZGeuyrMSlXB2XgnLBUKnc.jpg', '2024-10-06 01:29:11', '2024-10-05 19:34:05'),
(5, 'Lắc chân', 'categories/AStqxiFRaW1yDwpdisWi7QrsOJvWcLNk4cDcEzlH.png', '2024-10-06 01:29:11', '2024-10-05 19:34:25'),
(6, 'Cài áo', 'categories/4OO7IDUbMRh40gnCj05vxAlVmZdZo2Iuhspipj8O.jpg', '2024-10-06 01:29:11', '2024-10-05 19:34:35'),
(7, 'Khuy măng sét', 'categories/P2owwq2uc76p1WKMbxdwCc3T8nCZO7dGMW1O5rmy.jpg', '2024-10-06 01:29:11', '2024-10-05 19:36:31'),
(8, 'Mặt dây chuyền', 'categories/mIP1ukcQHFEsG92fCd9wTMGsbfyVoW75C64oyqLm.png', '2024-10-06 01:29:11', '2024-10-05 19:34:51'),
(9, 'Charm', 'categories/tXHpYNXtb7D9ZK2Xg3xb8eLj5mgoQt2gNNEBlLlO.jpg', '2024-10-06 01:29:11', '2024-10-05 19:35:34'),
(10, 'Dây chuyền', 'categories/torbMY0yD591yEyu9Q8jFhLwJUCTmt5Z9kpTwCPp.jpg', '2024-10-06 01:29:11', '2024-10-05 19:35:50');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `failed_jobs`
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
-- Cấu trúc bảng cho bảng `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2024_08_26_004425_create_categories_table', 1),
(5, '2024_09_09_004149_create_products_table', 1),
(6, '2024_09_16_003213_add_columns_to_users_table', 1),
(7, '2024_09_16_020433_add_role_to_users_table', 1),
(8, '2024_09_23_040848_update_image_column_in_products_table', 1),
(9, '2024_09_30_001628_create_orders_table', 1),
(10, '2024_09_30_001641_create_order_items_table', 1),
(11, '2024_09_30_025048_modify_total_column_in_orders_table', 1),
(12, '2024_10_05_133455_create_carts_table', 1),
(13, '2024_10_07_025313_create_payments_table', 2);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `total` decimal(17,2) NOT NULL,
  `status` enum('processing','paid','cancelled') NOT NULL DEFAULT 'processing',
  `payment_method` enum('COD','online') NOT NULL DEFAULT 'COD',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `total`, `status`, `payment_method`, `created_at`, `updated_at`) VALUES
(1, 3, 17500000.00, 'processing', 'COD', '2024-10-06 13:16:26', '2024-10-28 00:05:32'),
(2, 3, 17500000.00, 'paid', 'COD', '2024-10-06 13:17:33', '2024-10-24 20:02:57'),
(3, 3, 17500000.00, 'processing', 'COD', '2024-10-06 13:19:25', '2024-10-06 13:19:25'),
(4, 3, 2500000.00, 'processing', 'COD', '2024-10-06 13:26:49', '2024-10-06 13:26:49'),
(5, 3, 122000000.00, 'cancelled', 'online', '2024-10-06 13:34:25', '2024-10-24 20:10:56'),
(6, 3, 122000000.00, 'processing', 'online', '2024-10-06 13:37:45', '2024-10-06 13:37:45'),
(7, 3, 4500000.00, 'processing', 'online', '2024-10-06 14:37:24', '2024-10-06 14:37:24'),
(8, 3, 300000.00, 'processing', 'COD', '2024-10-06 14:37:37', '2024-10-06 14:37:37'),
(9, 3, 15000000.00, 'processing', 'COD', '2024-10-24 22:14:10', '2024-10-24 22:14:10'),
(10, 3, 90000000.00, 'processing', 'COD', '2024-10-24 22:15:29', '2024-10-24 22:15:29'),
(11, 3, 5000000.00, 'processing', 'online', '2024-10-25 05:39:18', '2024-10-25 05:39:18'),
(12, 3, 45000000.00, 'processing', 'COD', '2024-10-25 05:41:29', '2024-10-25 05:41:29'),
(13, 3, 15000000.00, 'processing', 'online', '2024-10-25 21:59:38', '2024-10-25 21:59:38'),
(14, 3, 2500000.00, 'processing', 'COD', '2024-10-26 05:06:02', '2024-10-26 05:06:02'),
(15, 3, 17500000.00, 'processing', 'COD', '2024-10-28 00:03:52', '2024-10-28 00:03:52'),
(16, 3, 377500000.00, 'paid', 'COD', '2024-10-28 00:04:20', '2024-10-28 00:05:43'),
(17, 3, 1800000.00, 'processing', 'COD', '2024-10-28 02:26:09', '2024-10-28 02:26:09');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `order_items`
--

CREATE TABLE `order_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `orders_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `image` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `order_items`
--

INSERT INTO `order_items` (`id`, `orders_id`, `product_id`, `quantity`, `price`, `image`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, 15000000.00, 'products/YFohCfHiMlds0r0uFMd3qVy3vIxJxy8z8Iq4NxdL.png', '2024-10-06 13:16:26', '2024-10-06 13:16:26'),
(2, 1, 2, 1, 2500000.00, 'products/773ZKfvTmso6YSVuMK0tSKjy7nijxtX1VvrAOmvC.jpg', '2024-10-06 13:16:26', '2024-10-06 13:16:26'),
(3, 2, 1, 1, 15000000.00, 'products/YFohCfHiMlds0r0uFMd3qVy3vIxJxy8z8Iq4NxdL.png', '2024-10-06 13:17:33', '2024-10-06 13:17:33'),
(4, 2, 2, 1, 2500000.00, 'products/773ZKfvTmso6YSVuMK0tSKjy7nijxtX1VvrAOmvC.jpg', '2024-10-06 13:17:33', '2024-10-06 13:17:33'),
(5, 3, 1, 1, 15000000.00, 'products/YFohCfHiMlds0r0uFMd3qVy3vIxJxy8z8Iq4NxdL.png', '2024-10-06 13:19:25', '2024-10-06 13:19:25'),
(6, 3, 2, 1, 2500000.00, 'products/773ZKfvTmso6YSVuMK0tSKjy7nijxtX1VvrAOmvC.jpg', '2024-10-06 13:19:25', '2024-10-06 13:19:25'),
(7, 4, 2, 1, 2500000.00, 'products/773ZKfvTmso6YSVuMK0tSKjy7nijxtX1VvrAOmvC.jpg', '2024-10-06 13:26:49', '2024-10-06 13:26:49'),
(8, 5, 3, 1, 75000000.00, 'products/M2LlbOvdpHx9t2TLUrjGa8jdfrgdMxr8VGrCkNum.jpg', '2024-10-06 13:34:25', '2024-10-06 13:34:25'),
(9, 5, 2, 6, 2500000.00, 'products/773ZKfvTmso6YSVuMK0tSKjy7nijxtX1VvrAOmvC.jpg', '2024-10-06 13:34:25', '2024-10-06 13:34:25'),
(10, 5, 6, 1, 32000000.00, 'products/s2ZKTyxfAQjeTkFutAFMfR6PypBb6BLZNsJWXbYm.png', '2024-10-06 13:34:25', '2024-10-06 13:34:25'),
(11, 6, 3, 1, 75000000.00, 'products/M2LlbOvdpHx9t2TLUrjGa8jdfrgdMxr8VGrCkNum.jpg', '2024-10-06 13:37:45', '2024-10-06 13:37:45'),
(12, 6, 2, 6, 2500000.00, 'products/773ZKfvTmso6YSVuMK0tSKjy7nijxtX1VvrAOmvC.jpg', '2024-10-06 13:37:45', '2024-10-06 13:37:45'),
(13, 6, 6, 1, 32000000.00, 'products/s2ZKTyxfAQjeTkFutAFMfR6PypBb6BLZNsJWXbYm.png', '2024-10-06 13:37:45', '2024-10-06 13:37:45'),
(14, 7, 2, 1, 2500000.00, 'products/773ZKfvTmso6YSVuMK0tSKjy7nijxtX1VvrAOmvC.jpg', '2024-10-06 14:37:24', '2024-10-06 14:37:24'),
(15, 7, 18, 1, 2000000.00, 'products/IfUfgC4AgloCLD0ozAlGeiqkhNEqM1OCOqIeojMj.png', '2024-10-06 14:37:24', '2024-10-06 14:37:24'),
(16, 8, 23, 1, 300000.00, 'products/KUD58OKADP3TvobpExxrtXeeidVebqm3WIBqaGm4.png', '2024-10-06 14:37:37', '2024-10-06 14:37:37'),
(17, 9, 1, 1, 15000000.00, 'products/YFohCfHiMlds0r0uFMd3qVy3vIxJxy8z8Iq4NxdL.png', '2024-10-24 22:14:10', '2024-10-24 22:14:10'),
(18, 10, 1, 1, 15000000.00, 'products/YFohCfHiMlds0r0uFMd3qVy3vIxJxy8z8Iq4NxdL.png', '2024-10-24 22:15:29', '2024-10-24 22:15:29'),
(19, 10, 3, 1, 75000000.00, 'products/M2LlbOvdpHx9t2TLUrjGa8jdfrgdMxr8VGrCkNum.jpg', '2024-10-24 22:15:29', '2024-10-24 22:15:29'),
(20, 11, 5, 1, 5000000.00, 'products/hXXXtmGKALAQDIFwbr7jYmcXrMVnkjjb4Z3lgEV5.jpg', '2024-10-25 05:39:18', '2024-10-25 05:39:18'),
(21, 12, 10, 1, 45000000.00, 'products/me6zhI7cQTyYHL7OvrsjCcJtVeiHXGFbCd2xlr02.png', '2024-10-25 05:41:29', '2024-10-25 05:41:29'),
(22, 13, 1, 1, 15000000.00, 'products/YFohCfHiMlds0r0uFMd3qVy3vIxJxy8z8Iq4NxdL.png', '2024-10-25 21:59:38', '2024-10-25 21:59:38'),
(23, 14, 2, 1, 2500000.00, 'products/773ZKfvTmso6YSVuMK0tSKjy7nijxtX1VvrAOmvC.jpg', '2024-10-26 05:06:02', '2024-10-26 05:06:02'),
(24, 15, 2, 1, 2500000.00, 'products/773ZKfvTmso6YSVuMK0tSKjy7nijxtX1VvrAOmvC.jpg', '2024-10-28 00:03:52', '2024-10-28 00:03:52'),
(25, 15, 1, 1, 15000000.00, 'products/YFohCfHiMlds0r0uFMd3qVy3vIxJxy8z8Iq4NxdL.png', '2024-10-28 00:03:52', '2024-10-28 00:03:52'),
(26, 16, 2, 1, 2500000.00, 'products/773ZKfvTmso6YSVuMK0tSKjy7nijxtX1VvrAOmvC.jpg', '2024-10-28 00:04:20', '2024-10-28 00:04:20'),
(27, 16, 3, 5, 75000000.00, 'products/M2LlbOvdpHx9t2TLUrjGa8jdfrgdMxr8VGrCkNum.jpg', '2024-10-28 00:04:20', '2024-10-28 00:04:20'),
(28, 17, 21, 1, 1800000.00, 'products/23woIB0HEhMLZoVW6tOD5j4tZL1JpPhzvFiXHT5E.jpg', '2024-10-28 02:26:09', '2024-10-28 02:26:09');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `payments`
--

CREATE TABLE `payments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `amount` decimal(15,2) NOT NULL,
  `payment_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `payment_method` enum('COD','online') NOT NULL DEFAULT 'online',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `payments`
--

INSERT INTO `payments` (`id`, `order_id`, `amount`, `payment_date`, `payment_method`, `created_at`, `updated_at`) VALUES
(1, 3, 17500000.00, '2024-10-06 20:19:25', 'COD', '2024-10-06 13:19:25', '2024-10-06 13:19:25'),
(2, 4, 2500000.00, '2024-10-06 20:26:49', 'COD', '2024-10-06 13:26:49', '2024-10-06 13:26:49'),
(3, 6, 122000000.00, '2024-10-06 20:37:45', 'online', '2024-10-06 13:37:45', '2024-10-06 13:37:45'),
(4, 7, 4500000.00, '2024-10-06 21:37:24', 'online', '2024-10-06 14:37:24', '2024-10-06 14:37:24'),
(5, 8, 300000.00, '2024-10-06 21:37:37', 'COD', '2024-10-06 14:37:37', '2024-10-06 14:37:37'),
(6, 9, 15000000.00, '2024-10-25 05:14:10', 'COD', '2024-10-24 22:14:10', '2024-10-24 22:14:10'),
(7, 10, 90000000.00, '2024-10-25 05:15:29', 'COD', '2024-10-24 22:15:29', '2024-10-24 22:15:29'),
(8, 11, 5000000.00, '2024-10-25 12:39:18', 'online', '2024-10-25 05:39:18', '2024-10-25 05:39:18'),
(9, 12, 45000000.00, '2024-10-25 12:41:29', 'COD', '2024-10-25 05:41:29', '2024-10-25 05:41:29'),
(10, 13, 15000000.00, '2024-10-26 04:59:38', 'online', '2024-10-25 21:59:38', '2024-10-25 21:59:38'),
(11, 14, 2500000.00, '2024-10-26 05:06:02', 'COD', '2024-10-26 05:06:02', '2024-10-26 05:06:02'),
(12, 15, 17500000.00, '2024-10-28 00:03:52', 'COD', '2024-10-28 00:03:52', '2024-10-28 00:03:52'),
(13, 16, 377500000.00, '2024-10-28 00:04:20', 'COD', '2024-10-28 00:04:20', '2024-10-28 00:04:20'),
(14, 17, 1800000.00, '2024-10-28 02:26:09', 'COD', '2024-10-28 02:26:09', '2024-10-28 02:26:09');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `image` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `products`
--

INSERT INTO `products` (`id`, `category_id`, `name`, `description`, `quantity`, `price`, `image`, `created_at`, `updated_at`) VALUES
(1, 1, 'Vòng cổ vàng 18K', 'Vòng cổ làm từ vàng 18K, thiết kế tinh tế.', 10, 15000000.00, 'products/YFohCfHiMlds0r0uFMd3qVy3vIxJxy8z8Iq4NxdL.png', '2024-10-06 01:54:32', '2024-10-05 18:57:29'),
(2, 1, 'Vòng cổ bạc Italia 925', 'Vòng cổ bạc cao cấp Italia 925, kiểu dáng thanh lịch.', 15, 2500000.00, 'products/773ZKfvTmso6YSVuMK0tSKjy7nijxtX1VvrAOmvC.jpg', '2024-10-06 01:54:32', '2024-10-05 18:59:08'),
(3, 1, 'Vòng cổ kim cương thiên nhiên', 'Vòng cổ gắn kim cương thiên nhiên, phong cách sang trọng.', 5, 75000000.00, 'products/M2LlbOvdpHx9t2TLUrjGa8jdfrgdMxr8VGrCkNum.jpg', '2024-10-06 01:54:32', '2024-10-05 19:00:05'),
(4, 1, 'Vòng cổ vàng 24K', 'Vòng cổ vàng 24K, thiết kế đẳng cấp.', 8, 20000000.00, 'products/kAAaIEtrAbJzIWG5ES0cqP5YzLfWHBTC0wIrmFTd.jpg', '2024-10-06 01:54:32', '2024-10-05 19:01:15'),
(5, 1, 'Vòng cổ bạc đính đá quý', 'Vòng cổ bạc kết hợp với đá quý xanh lục.', 12, 5000000.00, 'products/hXXXtmGKALAQDIFwbr7jYmcXrMVnkjjb4Z3lgEV5.jpg', '2024-10-06 01:54:32', '2024-10-05 19:01:56'),
(6, 1, 'Vòng cổ vàng đính hồng ngọc', 'Vòng cổ vàng đính hồng ngọc sang trọng.', 6, 32000000.00, 'products/s2ZKTyxfAQjeTkFutAFMfR6PypBb6BLZNsJWXbYm.png', '2024-10-06 01:54:32', '2024-10-05 19:06:28'),
(7, 1, 'Vòng cổ bạc đính ngọc trai', 'Vòng cổ bạc với viên ngọc trai tinh khiết.', 18, 4000000.00, 'products/GrMZC1A67GeaKvv5zLpx2NZccBhRzvwv3sz5fwqV.jpg', '2024-10-06 01:54:32', '2024-10-05 19:08:00'),
(8, 1, 'Vòng cổ vàng trắng 14K', 'Vòng cổ vàng trắng 14K, phù hợp mọi dịp.', 7, 22000000.00, 'products/gWWxroGWdXjqVT7qszoSpNyEW5Tz5iC6XL3Mr64m.jpg', '2024-10-06 01:54:32', '2024-10-05 19:10:06'),
(9, 1, 'Vòng cổ kim cương nhân tạo', 'Vòng cổ gắn kim cương nhân tạo lấp lánh.', 9, 18000000.00, 'products/k5chVyGyhXBIjU9c1R0ue2qA8w37ypNzoYvOy6uY.jpg', '2024-10-06 01:54:32', '2024-10-05 19:10:54'),
(10, 1, 'Vòng cổ vàng đính đá sapphire', 'Vòng cổ vàng đính đá sapphire xanh quý hiếm.', 5, 45000000.00, 'products/me6zhI7cQTyYHL7OvrsjCcJtVeiHXGFbCd2xlr02.png', '2024-10-06 01:54:32', '2024-10-05 19:12:08'),
(11, 2, 'Hoa tai vàng 18K', 'Hoa tai được làm từ vàng 18K cao cấp, thiết kế tinh tế.', 10, 1500000.00, 'products/5DZBUHCBsbAEvU0ipcUOWy0sDzZObz3NMXzKHdfo.jpg', '2024-10-06 02:20:33', '2024-10-05 19:22:57'),
(12, 3, 'Vòng tay bạc', 'Vòng tay bạc sáng bóng, thích hợp cho mọi dịp.', 20, 800000.00, 'products/cz30cVK2N7hccfQTN6Mc5FY5sUJG3voOe7dhPfUd.jpg', '2024-10-06 02:20:33', '2024-10-05 19:23:41'),
(13, 4, 'Nhẫn kim cương', 'Nhẫn kim cương tuyệt đẹp, phù hợp với những buổi tiệc sang trọng.', 5, 5000000.00, 'products/mAfaRd6YtBaE7NVA7V70Ou09OQhisk27acdrNI70.jpg', '2024-10-06 02:20:33', '2024-10-05 19:24:09'),
(14, 2, 'Hoa tai ngọc trai', 'Hoa tai được làm từ ngọc trai tự nhiên, tạo điểm nhấn sang trọng.', 15, 1200000.00, 'products/KiDduBJ0cINOLqJERTdgtj49e2zHYg9I8ejAQP14.jpg', '2024-10-06 02:21:31', '2024-10-05 19:25:49'),
(15, 2, 'Hoa tai bạc', 'Hoa tai bạc tinh xảo, phù hợp với nhiều phong cách.', 25, 700000.00, 'products/To3uFWaINeOEDBBYTrxpTDsChtkWXbJ2PAVLkHT5.png', '2024-10-06 02:21:31', '2024-10-05 19:26:34'),
(16, 3, 'Vòng tay đá quý', 'Vòng tay được làm từ đá quý tự nhiên, mang lại may mắn.', 10, 2500000.00, 'products/SpKvIgf48YXmoRFNAZYL1aklZExS9qc73hMDMIO9.png', '2024-10-06 02:21:31', '2024-10-05 19:27:09'),
(17, 3, 'Vòng tay vàng 24K', 'Vòng tay vàng 24K cao cấp, thiết kế đơn giản nhưng sang trọng.', 8, 3000000.00, 'products/CCERxUlOsaSA1y7fKLk5dgUBwIfyhR9umqIhfxyD.png', '2024-10-06 02:21:31', '2024-10-05 19:27:44'),
(18, 4, 'Nhẫn vàng khắc chữ', 'Nhẫn vàng có thể khắc chữ theo yêu cầu, món quà ý nghĩa.', 12, 2000000.00, 'products/IfUfgC4AgloCLD0ozAlGeiqkhNEqM1OCOqIeojMj.png', '2024-10-06 02:21:31', '2024-10-05 19:28:34'),
(19, 5, 'Lắc chân bạc', 'Lắc chân bạc nhẹ nhàng, dễ phối đồ cho mùa hè.', 30, 600000.00, 'products/zMSzRwtnIOjPSvYI0RklZ0gNiXjKQdxrpsueGzwl.png', '2024-10-06 02:21:31', '2024-10-05 19:29:12'),
(20, 6, 'Cài áo hình hoa', 'Cài áo hình hoa nghệ thuật, mang lại vẻ đẹp thanh lịch.', 20, 900000.00, 'products/tMylcRbTjJSzi556KCGPIGGG612sA0rtBJ6EAixt.jpg', '2024-10-06 02:21:31', '2024-10-05 19:29:52'),
(21, 7, 'Khuy măng sét kim loại', 'Khuy măng sét kim loại sang trọng, hoàn hảo cho bộ vest.', 5, 1800000.00, 'products/23woIB0HEhMLZoVW6tOD5j4tZL1JpPhzvFiXHT5E.jpg', '2024-10-06 02:21:31', '2024-10-05 19:30:34'),
(22, 8, 'Mặt dây chuyền hình trái tim', 'Mặt dây chuyền hình trái tim, món quà tình yêu tuyệt vời.', 18, 1300000.00, 'products/7Zs1ue8AxO5iDHKqU4ARF1zX6i62p5jKa1AQCBWz.jpg', '2024-10-06 02:21:31', '2024-10-05 19:31:15'),
(23, 9, 'Charm treo tay', 'Charm nhỏ xinh dễ thương, giúp vòng tay thêm phần nổi bật.', 50, 300000.00, 'products/KUD58OKADP3TvobpExxrtXeeidVebqm3WIBqaGm4.png', '2024-10-06 02:21:31', '2024-10-05 19:31:55');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('8TpsEQk5A8myVOqDXwV5yfwpQcepWwR3wbMYKEOg', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Safari/537.36 Edg/134.0.0.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoia0JWWHMyUDBmV1N0aHB6b0ZmM2tqYXYxSDB4dW4yaFVhTDhuN0NDViI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzQ6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi9vcmRlcnMiO31zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToyO30=', 1742212995),
('Yqq2CinQ3tXGpryRYKJKTNgdG4nTrHzAPY6gpGPt', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Safari/537.36 Edg/134.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiVHJxY0NpWTZxd1NpNmJaUDdoZzlvYlFLa01DRk5rQ2t6eEhsUW5aQiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1742212838);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','customer') NOT NULL DEFAULT 'customer',
  `image` text NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `role`, `image`, `remember_token`, `created_at`, `updated_at`) VALUES
(2, 'admin', 'admin@gmail.com', NULL, '$2y$12$W6laz7rEQjYGMsVlWZeFYOVhpx6pYIlJsg5lx7bJHssOtEki8QLxa', 'admin', 'users/xNHryFt4Gx5Tj4jvlPVGE6KRzY5E1qVEB22gpBbX.png', NULL, '2024-10-05 18:26:41', '2024-10-05 18:42:29'),
(3, 'trung nguyen', 'tapnham1502@gmail.com', NULL, '$2y$12$uYdmL8M3KkwrgNENgWPHAuSISF9uaPUTDSvL4PMoGy1V2oJYLJBVS', 'customer', 'users/u1K0AY8WFviLflfp9AC2vBCqlrnYQPhh9zpcsvgB.png', NULL, '2024-10-05 18:45:23', '2024-10-26 06:59:27');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Chỉ mục cho bảng `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Chỉ mục cho bảng `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `carts_user_id_foreign` (`user_id`),
  ADD KEY `carts_product_id_foreign` (`product_id`);

--
-- Chỉ mục cho bảng `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Chỉ mục cho bảng `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Chỉ mục cho bảng `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orders_user_id_foreign` (`user_id`);

--
-- Chỉ mục cho bảng `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_items_orders_id_foreign` (`orders_id`),
  ADD KEY `order_items_product_id_foreign` (`product_id`);

--
-- Chỉ mục cho bảng `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Chỉ mục cho bảng `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `payments_order_id_foreign` (`order_id`);

--
-- Chỉ mục cho bảng `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `products_category_id_foreign` (`category_id`);

--
-- Chỉ mục cho bảng `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `carts`
--
ALTER TABLE `carts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT cho bảng `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT cho bảng `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT cho bảng `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT cho bảng `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT cho bảng `payments`
--
ALTER TABLE `payments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT cho bảng `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `carts`
--
ALTER TABLE `carts`
  ADD CONSTRAINT `carts_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `carts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_orders_id_foreign` FOREIGN KEY (`orders_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_items_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payments_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
