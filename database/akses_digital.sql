-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 10, 2025 at 07:48 AM
-- Server version: 8.0.30
-- PHP Version: 8.2.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `akses_digital`
--

-- --------------------------------------------------------

--
-- Table structure for table `activity`
--

CREATE TABLE `activity` (
  `log_id` int NOT NULL,
  `role` enum('Finance','Staff','Manager','Super Admin') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `activity_type` enum('Create','Update','Delete') NOT NULL,
  `target` varchar(255) NOT NULL,
  `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `ip_address` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `activity`
--

INSERT INTO `activity` (`log_id`, `role`, `activity_type`, `target`, `timestamp`, `ip_address`) VALUES
(1, 'Super Admin', 'Delete', 'Report ID: 5', '2025-01-09 09:06:54', '195.245.25.16'),
(2, 'Manager', 'Create', 'Task ID: 3', '2025-01-08 13:06:54', '195.245.25.16'),
(3, 'Manager', 'Delete', 'Customer ID: 7', '2025-01-08 13:10:06', '195.245.25.16'),
(4, 'Staff', 'Update', 'Task ID: 1', '2025-01-13 13:10:06', '188.245.25.19'),
(5, 'Staff', 'Update', 'Task ID: 3', '2025-01-05 13:13:05', '195.245.25.16'),
(6, 'Finance', 'Update', 'Income ID: 10', '2025-01-02 13:13:05', '188.245.25.17'),
(7, 'Staff', 'Update', 'Task ID: 5', '2025-01-01 13:15:15', '195.245.25.15'),
(8, 'Staff', 'Delete', 'Task ID: 11', '2025-01-01 13:15:15', '195.245.25.16'),
(9, 'Super Admin', 'Create', 'Customer ID: 10', '2025-01-04 13:16:17', '188.245.25.17'),
(10, 'Manager', 'Delete', 'Order ID: 9', '2025-01-03 13:16:17', '188.245.25.20'),
(11, 'Staff', 'Create', 'Task ID: 12', '2025-01-07 13:17:48', '188.245.25.17'),
(12, 'Staff', 'Update', 'Task ID: 3', '2025-01-06 13:17:48', '188.245.25.20');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `customer_id` bigint UNSIGNED NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `customer_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_number` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `company` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`customer_id`, `email`, `customer_name`, `phone_number`, `company`, `created_at`, `updated_at`) VALUES
(4, 'son@example.com', 'son hyung min', '(480) 555-0103', 'PT. Ayam', '2025-01-08 21:37:54', '2025-01-09 07:00:57'),
(5, 'cristiano@example.com', 'cristiano ronaldo', '(480) 555-0103', 'PT. Minyak', '2025-01-08 21:38:22', '2025-01-09 07:01:04'),
(6, 'mees.hilgersr@example.com', 'mees hilgers', '(480) 555-0103', 'Louis Vuitton', '2025-01-09 06:52:32', '2025-01-09 06:52:32'),
(7, 'tim.jennings@example.com', 'Ronald Richards', '(307) 555-0133', 'Nintendo', '2025-01-09 06:53:00', '2025-01-09 06:53:00'),
(8, 'tanya.hill@example.com', 'Darlene Robertson', '(480) 555-0103', 'PT. Makmur', '2025-01-09 06:53:36', '2025-01-09 06:53:36'),
(9, 'jackson.graham@example.com', 'Bessie Cooper', '(808) 555-0111', 'Berijalan', '2025-01-09 06:54:12', '2025-01-09 06:54:12'),
(10, 'alma.lawson@example.com', 'Esther Howard', '(684) 555-0102', 'Facebook', '2025-01-09 06:54:36', '2025-01-09 06:54:36'),
(11, 'jessica.hanson@example.com', 'Cameron Williamson', '(307) 555-0166', 'Pizza Hut', '2025-01-09 06:57:11', '2025-01-09 06:57:11'),
(12, 'lionel.messi@example.com', 'lionel messi', '(684) 555-0102', 'PT. Icik Bos', '2025-01-09 06:58:11', '2025-01-09 06:58:11'),
(13, 'debbie.baker@example.com', 'Darlene Robertson', '(480) 555-0103', 'PT. Adudu', '2025-01-09 06:58:42', '2025-01-09 06:58:42'),
(15, 'jay.idzes@example.com', 'jay idzes', '(808) 555-0111', 'Samsung', '2025-01-09 06:59:55', '2025-01-09 06:59:55'),
(17, 'roberto@example.com', 'roberto carlos', '(480) 555-0103', 'Volvo', '2025-01-09 18:07:22', '2025-01-09 18:07:34');

-- --------------------------------------------------------

--
-- Table structure for table `expense`
--

CREATE TABLE `expense` (
  `expense_id` int NOT NULL,
  `category` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `date` date NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `expense`
--

INSERT INTO `expense` (`expense_id`, `category`, `amount`, `date`, `description`) VALUES
(2, 'Operational', '200000.00', '2025-01-09', 'Internet Bill'),
(3, 'Operational', '30000.00', '2024-12-31', 'Internet Bill'),
(4, 'Operational', '200000.00', '2025-01-08', 'Internet Bill'),
(5, 'Operational', '5000000.00', '2025-01-08', 'Internet Bill'),
(6, 'Operational', '70000.00', '2025-01-09', 'Internet Bill'),
(7, 'Operational', '32000.00', '2025-01-09', 'Internet Bill'),
(8, 'Operational', '450000.00', '2025-01-07', 'Internet Bill'),
(9, 'Operational', '29000.00', '2025-01-08', 'Internet Bill'),
(10, 'Operational', '450000.00', '2025-01-09', 'Internet Bill'),
(11, 'Operational', '670000.00', '2025-01-07', 'Internet Bill'),
(12, 'Operational', '40000.00', '2025-01-02', 'Internet Bill'),
(14, 'Operational', '200000.00', '2025-01-14', 'Internet Bill');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `finance`
--

CREATE TABLE `finance` (
  `income_id` int NOT NULL,
  `customer_name` varchar(100) NOT NULL,
  `project_name` varchar(100) NOT NULL,
  `amount` decimal(15,2) NOT NULL,
  `date` date NOT NULL,
  `payment_method` enum('Cash','Bank Transfer','Credit Card','E-Wallet') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `finance`
--

INSERT INTO `finance` (`income_id`, `customer_name`, `project_name`, `amount`, `date`, `payment_method`) VALUES
(1, 'jay idzes', 'app development', '200000.00', '2025-01-09', 'E-Wallet'),
(3, 'mees hilgers', 'service', '1000000.00', '2025-01-06', 'Cash'),
(4, 'Darlene Robertson', 'maintanance', '28888.00', '2025-01-08', 'Credit Card'),
(6, 'Ronald Richards', 'service', '20000.00', '2025-01-03', 'Bank Transfer'),
(7, 'roberto carlos', 'development', '288880.00', '2025-01-08', 'Cash'),
(8, 'lionel messi', 'app development', '10000.00', '2025-01-01', 'Bank Transfer'),
(9, 'son hyung min', 'web development', '30000.00', '2025-01-18', 'Credit Card'),
(10, 'Esther Howard', 'maintanance', '600000.00', '2025-01-14', 'Bank Transfer'),
(11, 'Cameron Williamson', 'service', '20000.00', '2025-01-01', 'Cash'),
(12, 'cristiano ronaldo', 'maintanance', '20000.00', '2025-01-06', 'Cash'),
(13, 'Jerome Bell', 'app development', '20000.00', '2025-01-08', 'E-Wallet'),
(15, 'Devon Lane', 'development', '4000000.00', '2025-01-06', 'E-Wallet');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(4, '2025_01_07_040215_add_two_factor_columns_to_users_table', 1),
(5, '2025_01_07_040252_create_personal_access_tokens_table', 1),
(24, '0001_01_01_000000_create_users_table', 2),
(25, '0001_01_01_000001_create_cache_table', 2),
(26, '0001_01_01_000002_create_jobs_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

CREATE TABLE `order` (
  `order_id` bigint UNSIGNED NOT NULL,
  `service` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `details` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `order_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` enum('Pending','In Progress','Completed','On Hold','Cancelled') COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order`
--

INSERT INTO `order` (`order_id`, `service`, `details`, `order_date`, `status`, `price`, `created_at`, `updated_at`) VALUES
(8, 'Maintenance', 'Monthly website maintenance', '2025-01-06 17:00:00', 'Pending', '200000.00', '2025-01-09 07:17:57', '2025-01-09 07:22:34'),
(9, 'web development', 'Develop a corporate website', '2025-01-05 17:00:00', 'Completed', '1000000.00', '2025-01-09 07:24:00', '2025-01-09 07:24:00'),
(10, 'app development', 'Develop a corporate app', '2025-01-08 17:00:00', 'On Hold', '2330000.00', '2025-01-09 07:24:29', '2025-01-09 07:24:29'),
(11, 'SEO Optimization', 'SEO for e-commerce site', '2025-01-06 17:00:00', 'Cancelled', '400000.00', '2025-01-09 07:25:09', '2025-01-09 07:25:09'),
(12, 'Mobile App Design', 'Design UI/UX for mobile app\'', '2025-01-15 17:00:00', 'Pending', '2000.00', '2025-01-09 07:25:38', '2025-01-09 07:25:38'),
(13, 'Maintenance', 'Monthly website maintenance', '2025-01-12 17:00:00', 'Pending', '1000000.00', '2025-01-09 07:25:54', '2025-01-09 07:25:54'),
(14, 'Maintenance', 'Monthly app maintenance', '2025-01-14 17:00:00', 'On Hold', '2330000.00', '2025-01-09 07:26:09', '2025-01-09 07:26:09'),
(15, 'app development', 'Develop a corporate app', '2025-01-05 17:00:00', 'On Hold', '1000000.00', '2025-01-09 07:26:24', '2025-01-09 07:26:24'),
(16, 'SEO Optimization', 'SEO for e-commerce site', '2025-01-02 17:00:00', 'Pending', '2330000.00', '2025-01-09 07:26:36', '2025-01-09 07:26:36'),
(17, 'web development', 'Develop a corporate website', '2024-12-30 17:00:00', 'Completed', '1000000.00', '2025-01-09 07:26:55', '2025-01-09 07:26:55'),
(18, 'Maintenance', 'Monthly website maintenance', '2025-01-21 17:00:00', 'In Progress', '1000000.00', '2025-01-09 07:27:11', '2025-01-09 07:27:11'),
(21, 'Maintenance', 'Monthly website maintenance', '2025-01-15 17:00:00', 'On Hold', '200000.00', '2025-01-09 18:15:00', '2025-01-09 18:15:13');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `project`
--

CREATE TABLE `project` (
  `project_id` int NOT NULL,
  `project_name` varchar(100) NOT NULL,
  `start_date` date NOT NULL,
  `deadline` date NOT NULL,
  `staff` varchar(255) NOT NULL,
  `status` enum('Pending','In Progress','Completed','On Hold','Cancelled') DEFAULT 'Pending',
  `progress` int DEFAULT '0'
) ;

--
-- Dumping data for table `project`
--

INSERT INTO `project` (`project_id`, `project_name`, `start_date`, `deadline`, `staff`, `status`, `progress`) VALUES
(2, 'service', '2025-01-06', '2025-01-09', 'jay idzes', 'Completed', 100),
(3, 'development', '2025-01-06', '2025-01-23', 'teressa web', 'Cancelled', 0),
(4, 'maintanance', '2025-01-09', '2025-01-12', 'jane cooper', 'In Progress', 50),
(5, 'development', '2025-01-09', '2025-01-18', 'son hyung min', 'Completed', 100),
(6, 'development', '2025-01-09', '2025-01-14', 'mees hilgers', 'Pending', 0),
(8, 'app development', '2025-01-09', '2025-01-20', 'jay idzes', 'In Progress', 40),
(9, 'service', '2025-01-09', '2025-01-13', 'mees hilgers', 'Cancelled', 0),
(10, 'maintanance', '2025-01-07', '2025-01-09', 'jane cooper', 'Cancelled', 0),
(11, 'web development', '2025-01-02', '2025-01-09', 'Darlene Robertson', 'On Hold', 50),
(12, 'maintanance', '2025-01-09', '2025-01-15', 'Cameron Williamson', 'On Hold', 20),
(13, 'web development', '2024-12-31', '2025-01-09', 'jane cooper', 'Pending', 0),
(15, 'maintanance', '2025-01-10', '2025-01-21', 'mees hilgers', 'On Hold', 40);

-- --------------------------------------------------------

--
-- Table structure for table `report`
--

CREATE TABLE `report` (
  `report_id` int NOT NULL,
  `type` enum('Staff','Customer','Order','Project','Task','Finance') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `date_generated` date NOT NULL,
  `generated_by` enum('Finance','Staff','Manager','Super Admin') NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `report`
--

INSERT INTO `report` (`report_id`, `type`, `date_generated`, `generated_by`, `description`) VALUES
(1, 'Order', '2025-01-07', 'Manager', 'Order completion report for December 2024'),
(3, 'Finance', '2025-01-09', 'Finance', 'Monthly income report for January'),
(5, 'Task', '2025-01-06', 'Staff', 'System maintenance report for server upgrade'),
(6, 'Project', '2025-01-02', 'Super Admin', 'Project progress report for Q1 2025'),
(7, 'Finance', '2025-01-12', 'Finance', 'Monthly income report for January'),
(8, 'Task', '2025-01-02', 'Manager', 'System maintenance report for server upgrade'),
(9, 'Order', '2024-12-29', 'Super Admin', 'Project progress report for Q1 2025'),
(10, 'Task', '2025-01-28', 'Manager', 'System maintenance report for server upgrade'),
(11, 'Order', '2025-01-21', 'Manager', 'Order completion report for December 2024'),
(12, 'Finance', '2025-01-06', 'Super Admin', 'Monthly income report for January'),
(13, 'Finance', '2025-01-23', 'Finance', 'Monthly income report for January'),
(16, 'Staff', '2025-01-07', 'Staff', 'System maintenance report for server upgrade'),
(17, 'Order', '2025-01-15', 'Staff', 'System maintenance report for server upgrade');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('LsxR8mwJ64NPYjNF8Z0CNhyxANo9m8Lo668oqO3O', 30, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiaUhrakNLeUVCZ0w1d2M4U2JnS0VJR3FSVU9meGhuelJ4MW5wVlh5SSI7czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjMwOiJodHRwOi8vYWtzZXNkaWdpdGFsLnRlc3QvbG9naW4iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aTozMDt9', 1736495238);

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_number` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `staff_birth_date` date NOT NULL,
  `role` enum('super admin','manager','staff','finance') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'staff',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`id`, `name`, `email`, `phone_number`, `staff_birth_date`, `role`, `created_at`, `updated_at`) VALUES
(2, 'Jacob Jones', 'debra.holt@example.com', '(480) 555-0103', '2025-01-06', 'manager', '2025-01-08 19:25:53', '2025-01-09 06:35:17'),
(3, 'Robert Fox', 'alma.lawson@example.com', '(307) 555-0133', '2024-12-29', 'staff', '2025-01-09 06:20:44', '2025-01-09 06:20:44'),
(4, 'Ronald Richards', 'bill.sanders@example.com', '(808) 555-0111', '2024-02-06', 'staff', '2025-01-09 06:21:48', '2025-01-09 06:21:48'),
(6, 'Jane Cooper', 'nevaeh.simmons@example.com', '(217) 555-0113', '2025-01-15', 'finance', '2025-01-09 06:22:44', '2025-01-09 06:22:44'),
(7, 'Darlene Robertson', 'debbie.baker@example.com', '(406) 555-0120', '2025-01-05', 'staff', '2025-01-09 06:23:14', '2025-01-09 06:23:14'),
(8, 'Bessie Cooper', 'tim.jennings@example.com', '(505) 555-0125', '2025-01-07', 'finance', '2025-01-09 06:23:42', '2025-01-09 06:23:42'),
(9, 'Annette Black', 'jackson.graham@example.com', '(303) 555-0105', '2025-01-08', 'manager', '2025-01-09 06:24:22', '2025-01-09 06:24:22'),
(10, 'Esther Howard', 'jessica.hanson@example.com', '(307) 555-0133', '2025-01-10', 'staff', '2025-01-09 06:25:00', '2025-01-09 06:25:00'),
(11, 'Justin Hubner', 'justin.hubner@example.com', '(307) 555-0133', '2025-01-15', 'staff', '2025-01-09 06:25:37', '2025-01-09 06:25:37'),
(12, 'Jay Idzes', 'jay.idzes@example.com', '(505) 555-0137', '2025-01-23', 'staff', '2025-01-09 06:26:11', '2025-01-09 06:33:01'),
(13, 'mees hilgers', 'mees.hilgersr@example.com', '(307) 999-0133', '2025-01-20', 'staff', '2025-01-09 06:32:48', '2025-01-09 06:32:48'),
(15, 'Son hyung min', 'son@example.com', '(307) 555-0133', '2024-12-30', 'staff', '2025-01-09 18:22:14', '2025-01-09 18:22:22');

-- --------------------------------------------------------

--
-- Table structure for table `task`
--

CREATE TABLE `task` (
  `task_id` int NOT NULL,
  `task_name` varchar(100) NOT NULL,
  `assignee` varchar(100) NOT NULL,
  `priority` enum('Low','Medium','High','Critical') DEFAULT 'Medium',
  `deadline` date NOT NULL,
  `status` enum('Pending','In Progress','Completed','On Hold','Cancelled') DEFAULT 'Pending',
  `progress` int DEFAULT '0'
) ;

--
-- Dumping data for table `task`
--

INSERT INTO `task` (`task_id`, `task_name`, `assignee`, `priority`, `deadline`, `status`, `progress`) VALUES
(1, 'validasi form', 'jay idzes', 'High', '2025-01-24', 'Cancelled', 0),
(2, 'validasi email', 'lionel messi', 'Medium', '2025-01-09', 'Completed', 100),
(3, 'validasi password', 'roberto carlos', 'Low', '2025-01-09', 'On Hold', 20),
(4, 'validasi email', 'teressa web', 'Critical', '2025-01-09', 'On Hold', 90),
(5, 'validasi form', 'Albert jackson', 'Low', '2025-01-08', 'Pending', 0),
(6, 'validasi password', 'Albert Einstein', 'Medium', '2025-01-09', 'In Progress', 50),
(7, 'validasi email', 'jay idzes', 'Low', '2025-01-15', 'In Progress', 20),
(8, 'validasi password', 'roberto carlos', 'Critical', '2025-01-16', 'Completed', 100),
(10, 'validasi password', 'teressa web', 'Low', '2025-01-08', 'Pending', 0),
(11, 'validasi form', 'lionel messi', 'Critical', '2025-01-09', 'Completed', 100),
(12, 'validasi email', 'jay idzes', 'Low', '2025-01-01', 'Pending', 0),
(14, 'validasi password', 'roberto carlos', 'Medium', '2025-01-07', 'In Progress', 50);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_number` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `birth_date` date DEFAULT NULL,
  `role` enum('admin','user') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'user',
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `phone_number`, `birth_date`, `role`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(8, 'Jacob Jones', 'debra.holt@example.com', '(505) 555-0125', '2024-12-29', 'user', '$2y$12$oQ/ZmcCfPLnTLQ55iZz7UunWP2VlkO3KFMFpeVGFddUZS0Y6Y6IoG', NULL, '2025-01-08 01:28:35', '2025-01-09 20:20:38'),
(10, 'Robert Fox', 'alma.lawson@example.com', '(808) 555-0111', '2025-01-07', 'user', '$2y$12$sHM/xnME.kVHYFffcw0.E.4ghcOduCCZQNgqMdcksUXSrFGvLRknq', NULL, '2025-01-08 02:13:24', '2025-01-09 06:43:13'),
(12, 'Ronald Richards', 'jackson.graham@example.com', '(480) 555-0103', '2025-01-07', 'user', '$2y$12$1/9FMBgHi3ZeVtl4iTcnE..x7m/wT0lM14TQy1BNxa26SegSbyove', NULL, '2025-01-08 03:09:15', '2025-01-09 06:43:49'),
(14, 'Lisa Jojo', 'tanya.hill@example.com', '(217) 555-0113', '2025-01-05', 'user', '$2y$12$Sf0Ve24wkO0Mn9Bdnxud5elwGwKBteTXlBx1dyAgEX8EKx5UiMtoy', NULL, '2025-01-08 17:42:39', '2025-01-09 06:44:13'),
(15, 'robert Lewandowski', 'tim.jennings@example.com', '(505) 555-0125', '2025-01-01', 'user', '$2y$12$.rGC4sj9HTCUax7Zrq8VeOcw/TPqbfLJliWj4Q5BiFJ2A4z1sWERm', NULL, '2025-01-08 17:43:09', '2025-01-09 06:44:56'),
(17, 'Darlene Robertson', 'jessica.hanson@example.com', '(307) 555-0122', '2025-01-06', 'user', '$2y$12$17Izn68XEU40GFdApU0zOOA3c9WOnkr.LKw6FTa6OC4NoUnNmW3G.', NULL, '2025-01-08 17:54:09', '2025-01-09 06:46:01'),
(18, 'Jane Cooper', 'curtis.weaver@example.com', '(217) 545-0113', '2025-01-07', 'user', '$2y$12$wsK/wa8t.4ZjAluyjnJ0G.Gp7sqUFEq9tfxNLMkmkn/SarFL4TTxK', NULL, '2025-01-08 17:55:58', '2025-01-09 06:46:36'),
(19, 'mees hilgers', 'mees.hilgersr@example.com', '(480) 555-0103', '2025-01-05', 'user', '$2y$12$Il21r.ZLG.Px.ry5zZeq7OJ/3o4cda/isz6lveIngZGJqnt3tEzZm', NULL, '2025-01-08 17:57:33', '2025-01-09 06:46:58'),
(20, 'Jay Idzes', 'jay.idzes@example.com', '(480) 555-0103', '2025-01-07', 'user', '$2y$12$qdNJeJ99G5WzB1CIhupDZ.YIer/Qd5BJxxflC5FNreva.eqgKPhZC', NULL, '2025-01-08 17:58:16', '2025-01-09 06:47:14'),
(21, 'Lionel messi', 'lionel.messi@example.com', '(684) 555-0102', '2025-01-06', 'user', '$2y$12$Vee1syajwqohqWYR/lxZV.W9vzW.ACEa56BJV9Z4bgG2brvUlhxvO', NULL, '2025-01-08 17:59:20', '2025-01-09 06:47:45'),
(22, 'cristiano ronaldo', 'cristiano@example.com', '(217) 555-0113', '2025-01-07', 'user', '$2y$12$kV2GjgfgOQxsjU4R5hw7rOZF.liv.BYWEJ1GYwSwxnm681f1VgcvG', NULL, '2025-01-08 18:30:15', '2025-01-09 06:48:15'),
(25, 'vinicius junior', 'vinicius@example.com', '(505) 555-0125', '2025-01-07', 'user', '$2y$12$aBQTJYLO/JrGolP1UUUceuRGLGHPaSgNh9nZdPCu5pwZVzM7GtKyy', NULL, '2025-01-08 18:44:58', '2025-01-09 06:49:36'),
(26, 'Son hyung min', 'son@example.com', '(480) 555-0102', '2025-01-08', 'user', '$2y$12$cczeESK78UOTflbKCeKNxeHULfTjxwLxt8LI0luq/H021qoIZd9xu', NULL, '2025-01-09 18:26:17', '2025-01-09 18:26:31'),
(30, 'Yuuki', 'zidanealfareshy@gmail.com', '(480) 555-0103', NULL, 'user', '$2y$12$JqtpuLx/0yexDG/fDqGGCu2x0tPWLDHUr.XDOA07IajzgxzR/0Sla', NULL, '2025-01-09 20:23:26', '2025-01-09 20:23:26');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activity`
--
ALTER TABLE `activity`
  ADD PRIMARY KEY (`log_id`);

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
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`customer_id`),
  ADD UNIQUE KEY `customer_email_unique` (`email`);

--
-- Indexes for table `expense`
--
ALTER TABLE `expense`
  ADD PRIMARY KEY (`expense_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `finance`
--
ALTER TABLE `finance`
  ADD PRIMARY KEY (`income_id`);

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
-- Indexes for table `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `project`
--
ALTER TABLE `project`
  ADD PRIMARY KEY (`project_id`);

--
-- Indexes for table `report`
--
ALTER TABLE `report`
  ADD PRIMARY KEY (`report_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `staff_email_unique` (`email`);

--
-- Indexes for table `task`
--
ALTER TABLE `task`
  ADD PRIMARY KEY (`task_id`);

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
-- AUTO_INCREMENT for table `activity`
--
ALTER TABLE `activity`
  MODIFY `log_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `customer_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `expense`
--
ALTER TABLE `expense`
  MODIFY `expense_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `finance`
--
ALTER TABLE `finance`
  MODIFY `income_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `order`
--
ALTER TABLE `order`
  MODIFY `order_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `project`
--
ALTER TABLE `project`
  MODIFY `project_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `report`
--
ALTER TABLE `report`
  MODIFY `report_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `task`
--
ALTER TABLE `task`
  MODIFY `task_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
