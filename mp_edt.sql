-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Aug 19, 2025 at 03:40 AM
-- Server version: 8.1.0
-- PHP Version: 8.2.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mp_edt`
--

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('356a192b7913b04c54574d18c28d46e6395428ab', 'i:1;', 1755497321),
('356a192b7913b04c54574d18c28d46e6395428ab:timer', 'i:1755497321;', 1755497321),
('livewire-rate-limiter:a17961fa74e9275d529f489537f179c05d50c2f3', 'i:1;', 1755517844),
('livewire-rate-limiter:a17961fa74e9275d529f489537f179c05d50c2f3:timer', 'i:1755517844;', 1755517844),
('spatie.permission.cache', 'a:3:{s:5:\"alias\";a:4:{s:1:\"a\";s:2:\"id\";s:1:\"b\";s:4:\"name\";s:1:\"c\";s:10:\"guard_name\";s:1:\"r\";s:5:\"roles\";}s:11:\"permissions\";a:137:{i:0;a:4:{s:1:\"a\";i:1;s:1:\"b\";s:9:\"view_role\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:4;}}i:1;a:4:{s:1:\"a\";i:2;s:1:\"b\";s:13:\"view_any_role\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:4;}}i:2;a:4:{s:1:\"a\";i:3;s:1:\"b\";s:11:\"create_role\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:4;}}i:3;a:4:{s:1:\"a\";i:4;s:1:\"b\";s:11:\"update_role\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:4;}}i:4;a:4:{s:1:\"a\";i:5;s:1:\"b\";s:11:\"delete_role\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:4;}}i:5;a:4:{s:1:\"a\";i:6;s:1:\"b\";s:15:\"delete_any_role\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:4;}}i:6;a:4:{s:1:\"a\";i:7;s:1:\"b\";s:12:\"view_company\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:4;}}i:7;a:4:{s:1:\"a\";i:8;s:1:\"b\";s:14:\"create_company\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:4;}}i:8;a:4:{s:1:\"a\";i:9;s:1:\"b\";s:14:\"update_company\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:4;}}i:9;a:4:{s:1:\"a\";i:10;s:1:\"b\";s:14:\"delete_company\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:4;}}i:10;a:4:{s:1:\"a\";i:11;s:1:\"b\";s:20:\"view_delivery::order\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:2;i:1;i:4;}}i:11;a:4:{s:1:\"a\";i:12;s:1:\"b\";s:22:\"create_delivery::order\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:2;i:1;i:4;}}i:12;a:4:{s:1:\"a\";i:13;s:1:\"b\";s:22:\"update_delivery::order\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:2;i:1;i:4;}}i:13;a:4:{s:1:\"a\";i:14;s:1:\"b\";s:22:\"delete_delivery::order\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:2;i:1;i:4;}}i:14;a:4:{s:1:\"a\";i:15;s:1:\"b\";s:16:\"view_file::order\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:2;i:1;i:4;}}i:15;a:4:{s:1:\"a\";i:16;s:1:\"b\";s:18:\"create_file::order\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:2;i:1;i:4;}}i:16;a:4:{s:1:\"a\";i:17;s:1:\"b\";s:18:\"update_file::order\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:2;i:1;i:4;}}i:17;a:4:{s:1:\"a\";i:18;s:1:\"b\";s:18:\"delete_file::order\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:2;i:1;i:4;}}i:18;a:4:{s:1:\"a\";i:19;s:1:\"b\";s:16:\"view_item::order\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:2;i:1;i:4;}}i:19;a:4:{s:1:\"a\";i:20;s:1:\"b\";s:18:\"create_item::order\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:2;i:1;i:4;}}i:20;a:4:{s:1:\"a\";i:21;s:1:\"b\";s:18:\"update_item::order\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:2;i:1;i:4;}}i:21;a:4:{s:1:\"a\";i:22;s:1:\"b\";s:18:\"delete_item::order\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:2;i:1;i:4;}}i:22;a:4:{s:1:\"a\";i:23;s:1:\"b\";s:12:\"view_project\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:2;i:1;i:4;}}i:23;a:4:{s:1:\"a\";i:24;s:1:\"b\";s:14:\"create_project\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:2;i:1;i:4;}}i:24;a:4:{s:1:\"a\";i:25;s:1:\"b\";s:14:\"update_project\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:2;i:1;i:4;}}i:25;a:4:{s:1:\"a\";i:26;s:1:\"b\";s:14:\"delete_project\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:2;i:1;i:4;}}i:26;a:4:{s:1:\"a\";i:27;s:1:\"b\";s:20:\"view_purchase::order\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:4;}}i:27;a:4:{s:1:\"a\";i:28;s:1:\"b\";s:22:\"create_purchase::order\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:4;}}i:28;a:4:{s:1:\"a\";i:29;s:1:\"b\";s:22:\"update_purchase::order\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:4;}}i:29;a:4:{s:1:\"a\";i:30;s:1:\"b\";s:22:\"delete_purchase::order\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:4;}}i:30;a:4:{s:1:\"a\";i:31;s:1:\"b\";s:25:\"view_purchase::order::out\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:2;i:1;i:4;}}i:31;a:4:{s:1:\"a\";i:32;s:1:\"b\";s:27:\"create_purchase::order::out\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:2;i:1;i:4;}}i:32;a:4:{s:1:\"a\";i:33;s:1:\"b\";s:27:\"update_purchase::order::out\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:2;i:1;i:4;}}i:33;a:4:{s:1:\"a\";i:34;s:1:\"b\";s:27:\"delete_purchase::order::out\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:2;i:1;i:4;}}i:34;a:4:{s:1:\"a\";i:35;s:1:\"b\";s:17:\"view_third::party\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:2;i:1;i:4;}}i:35;a:4:{s:1:\"a\";i:36;s:1:\"b\";s:19:\"create_third::party\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:2;i:1;i:4;}}i:36;a:4:{s:1:\"a\";i:37;s:1:\"b\";s:19:\"update_third::party\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:2;i:1;i:4;}}i:37;a:4:{s:1:\"a\";i:38;s:1:\"b\";s:19:\"delete_third::party\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:2;i:1;i:4;}}i:38;a:4:{s:1:\"a\";i:39;s:1:\"b\";s:9:\"view_user\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:4;}}i:39;a:4:{s:1:\"a\";i:40;s:1:\"b\";s:11:\"create_user\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:4;}}i:40;a:4:{s:1:\"a\";i:41;s:1:\"b\";s:11:\"update_user\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:4;}}i:41;a:4:{s:1:\"a\";i:42;s:1:\"b\";s:11:\"delete_user\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:4;}}i:42;a:4:{s:1:\"a\";i:43;s:1:\"b\";s:11:\"view_vendor\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:4;}}i:43;a:4:{s:1:\"a\";i:44;s:1:\"b\";s:13:\"create_vendor\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:4;}}i:44;a:4:{s:1:\"a\";i:45;s:1:\"b\";s:13:\"update_vendor\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:4;}}i:45;a:4:{s:1:\"a\";i:46;s:1:\"b\";s:13:\"delete_vendor\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:4;}}i:46;a:4:{s:1:\"a\";i:47;s:1:\"b\";s:22:\"page_BusinessDashboard\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:4;}}i:47;a:4:{s:1:\"a\";i:48;s:1:\"b\";s:16:\"page_SalesReport\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:2;i:1;i:4;}}i:48;a:4:{s:1:\"a\";i:49;s:1:\"b\";s:23:\"widget_BusinessOverview\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:2;i:1;i:4;}}i:49;a:4:{s:1:\"a\";i:50;s:1:\"b\";s:20:\"widget_StatsOverview\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:2;i:1;i:4;}}i:50;a:4:{s:1:\"a\";i:51;s:1:\"b\";s:21:\"widget_RecentProjects\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:2;i:1;i:4;}}i:51;a:4:{s:1:\"a\";i:52;s:1:\"b\";s:25:\"widget_ProjectStatusChart\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:2;i:1;i:4;}}i:52;a:4:{s:1:\"a\";i:53;s:1:\"b\";s:23:\"widget_FinancialSummary\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:2;i:1;i:4;}}i:53;a:4:{s:1:\"a\";i:54;s:1:\"b\";s:20:\"widget_TasksOverview\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:2;i:1;i:4;}}i:54;a:4:{s:1:\"a\";i:55;s:1:\"b\";s:20:\"widget_ExpensesChart\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:2;i:1;i:4;}}i:55;a:4:{s:1:\"a\";i:56;s:1:\"b\";s:20:\"widget_InvoiceStatus\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:2;i:1;i:4;}}i:56;a:3:{s:1:\"a\";i:57;s:1:\"b\";s:17:\"page_sales_report\";s:1:\"c\";s:3:\"web\";}i:57;a:4:{s:1:\"a\";i:58;s:1:\"b\";s:16:\"view_any_company\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:2;i:1;i:4;}}i:58;a:4:{s:1:\"a\";i:59;s:1:\"b\";s:24:\"view_any_delivery::order\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:2;i:1;i:4;}}i:59;a:4:{s:1:\"a\";i:60;s:1:\"b\";s:20:\"view_any_file::order\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:2;i:1;i:4;}}i:60;a:4:{s:1:\"a\";i:61;s:1:\"b\";s:20:\"view_any_item::order\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:2;i:1;i:4;}}i:61;a:4:{s:1:\"a\";i:62;s:1:\"b\";s:16:\"view_any_project\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:2;i:1;i:4;}}i:62;a:4:{s:1:\"a\";i:63;s:1:\"b\";s:24:\"view_any_purchase::order\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:4;}}i:63;a:4:{s:1:\"a\";i:64;s:1:\"b\";s:21:\"view_any_third::party\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:2;i:1;i:4;}}i:64;a:4:{s:1:\"a\";i:65;s:1:\"b\";s:13:\"view_any_user\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:4;}}i:65;a:4:{s:1:\"a\";i:66;s:1:\"b\";s:15:\"restore_company\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:4;}}i:66;a:4:{s:1:\"a\";i:67;s:1:\"b\";s:19:\"restore_any_company\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:4;}}i:67;a:4:{s:1:\"a\";i:68;s:1:\"b\";s:17:\"replicate_company\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:4;}}i:68;a:4:{s:1:\"a\";i:69;s:1:\"b\";s:15:\"reorder_company\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:4;}}i:69;a:4:{s:1:\"a\";i:70;s:1:\"b\";s:18:\"delete_any_company\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:4;}}i:70;a:4:{s:1:\"a\";i:71;s:1:\"b\";s:20:\"force_delete_company\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:4;}}i:71;a:4:{s:1:\"a\";i:72;s:1:\"b\";s:24:\"force_delete_any_company\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:4;}}i:72;a:4:{s:1:\"a\";i:73;s:1:\"b\";s:23:\"restore_delivery::order\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:4;}}i:73;a:4:{s:1:\"a\";i:74;s:1:\"b\";s:27:\"restore_any_delivery::order\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:4;}}i:74;a:4:{s:1:\"a\";i:75;s:1:\"b\";s:25:\"replicate_delivery::order\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:4;}}i:75;a:4:{s:1:\"a\";i:76;s:1:\"b\";s:23:\"reorder_delivery::order\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:4;}}i:76;a:4:{s:1:\"a\";i:77;s:1:\"b\";s:26:\"delete_any_delivery::order\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:4;}}i:77;a:4:{s:1:\"a\";i:78;s:1:\"b\";s:28:\"force_delete_delivery::order\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:4;}}i:78;a:4:{s:1:\"a\";i:79;s:1:\"b\";s:32:\"force_delete_any_delivery::order\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:4;}}i:79;a:4:{s:1:\"a\";i:80;s:1:\"b\";s:19:\"restore_file::order\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:4;}}i:80;a:4:{s:1:\"a\";i:81;s:1:\"b\";s:23:\"restore_any_file::order\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:4;}}i:81;a:4:{s:1:\"a\";i:82;s:1:\"b\";s:21:\"replicate_file::order\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:4;}}i:82;a:4:{s:1:\"a\";i:83;s:1:\"b\";s:19:\"reorder_file::order\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:4;}}i:83;a:4:{s:1:\"a\";i:84;s:1:\"b\";s:22:\"delete_any_file::order\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:4;}}i:84;a:4:{s:1:\"a\";i:85;s:1:\"b\";s:24:\"force_delete_file::order\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:4;}}i:85;a:4:{s:1:\"a\";i:86;s:1:\"b\";s:28:\"force_delete_any_file::order\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:4;}}i:86;a:4:{s:1:\"a\";i:87;s:1:\"b\";s:19:\"restore_item::order\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:4;}}i:87;a:4:{s:1:\"a\";i:88;s:1:\"b\";s:23:\"restore_any_item::order\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:4;}}i:88;a:4:{s:1:\"a\";i:89;s:1:\"b\";s:21:\"replicate_item::order\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:4;}}i:89;a:4:{s:1:\"a\";i:90;s:1:\"b\";s:19:\"reorder_item::order\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:4;}}i:90;a:4:{s:1:\"a\";i:91;s:1:\"b\";s:22:\"delete_any_item::order\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:4;}}i:91;a:4:{s:1:\"a\";i:92;s:1:\"b\";s:24:\"force_delete_item::order\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:4;}}i:92;a:4:{s:1:\"a\";i:93;s:1:\"b\";s:28:\"force_delete_any_item::order\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:4;}}i:93;a:4:{s:1:\"a\";i:94;s:1:\"b\";s:15:\"restore_project\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:4;}}i:94;a:4:{s:1:\"a\";i:95;s:1:\"b\";s:19:\"restore_any_project\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:4;}}i:95;a:4:{s:1:\"a\";i:96;s:1:\"b\";s:17:\"replicate_project\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:4;}}i:96;a:4:{s:1:\"a\";i:97;s:1:\"b\";s:15:\"reorder_project\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:4;}}i:97;a:4:{s:1:\"a\";i:98;s:1:\"b\";s:18:\"delete_any_project\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:4;}}i:98;a:4:{s:1:\"a\";i:99;s:1:\"b\";s:20:\"force_delete_project\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:4;}}i:99;a:4:{s:1:\"a\";i:100;s:1:\"b\";s:24:\"force_delete_any_project\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:4;}}i:100;a:4:{s:1:\"a\";i:101;s:1:\"b\";s:23:\"restore_purchase::order\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:4;}}i:101;a:4:{s:1:\"a\";i:102;s:1:\"b\";s:27:\"restore_any_purchase::order\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:4;}}i:102;a:4:{s:1:\"a\";i:103;s:1:\"b\";s:25:\"replicate_purchase::order\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:4;}}i:103;a:4:{s:1:\"a\";i:104;s:1:\"b\";s:23:\"reorder_purchase::order\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:4;}}i:104;a:4:{s:1:\"a\";i:105;s:1:\"b\";s:26:\"delete_any_purchase::order\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:4;}}i:105;a:4:{s:1:\"a\";i:106;s:1:\"b\";s:28:\"force_delete_purchase::order\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:4;}}i:106;a:4:{s:1:\"a\";i:107;s:1:\"b\";s:32:\"force_delete_any_purchase::order\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:4;}}i:107;a:4:{s:1:\"a\";i:108;s:1:\"b\";s:29:\"view_any_purchase::order::out\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:2;i:1;i:4;}}i:108;a:4:{s:1:\"a\";i:109;s:1:\"b\";s:28:\"restore_purchase::order::out\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:2;i:1;i:4;}}i:109;a:4:{s:1:\"a\";i:110;s:1:\"b\";s:32:\"restore_any_purchase::order::out\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:2;i:1;i:4;}}i:110;a:4:{s:1:\"a\";i:111;s:1:\"b\";s:30:\"replicate_purchase::order::out\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:2;i:1;i:4;}}i:111;a:4:{s:1:\"a\";i:112;s:1:\"b\";s:28:\"reorder_purchase::order::out\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:2;i:1;i:4;}}i:112;a:4:{s:1:\"a\";i:113;s:1:\"b\";s:31:\"delete_any_purchase::order::out\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:2;i:1;i:4;}}i:113;a:4:{s:1:\"a\";i:114;s:1:\"b\";s:33:\"force_delete_purchase::order::out\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:2;i:1;i:4;}}i:114;a:4:{s:1:\"a\";i:115;s:1:\"b\";s:37:\"force_delete_any_purchase::order::out\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:2;i:1;i:4;}}i:115;a:4:{s:1:\"a\";i:116;s:1:\"b\";s:20:\"restore_third::party\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:2;i:1;i:4;}}i:116;a:4:{s:1:\"a\";i:117;s:1:\"b\";s:24:\"restore_any_third::party\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:2;i:1;i:4;}}i:117;a:4:{s:1:\"a\";i:118;s:1:\"b\";s:22:\"replicate_third::party\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:2;i:1;i:4;}}i:118;a:4:{s:1:\"a\";i:119;s:1:\"b\";s:20:\"reorder_third::party\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:2;i:1;i:4;}}i:119;a:4:{s:1:\"a\";i:120;s:1:\"b\";s:23:\"delete_any_third::party\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:2;i:1;i:4;}}i:120;a:4:{s:1:\"a\";i:121;s:1:\"b\";s:25:\"force_delete_third::party\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:2;i:1;i:4;}}i:121;a:4:{s:1:\"a\";i:122;s:1:\"b\";s:29:\"force_delete_any_third::party\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:2;i:1;i:4;}}i:122;a:4:{s:1:\"a\";i:123;s:1:\"b\";s:12:\"restore_user\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:4;}}i:123;a:4:{s:1:\"a\";i:124;s:1:\"b\";s:16:\"restore_any_user\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:4;}}i:124;a:4:{s:1:\"a\";i:125;s:1:\"b\";s:14:\"replicate_user\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:4;}}i:125;a:4:{s:1:\"a\";i:126;s:1:\"b\";s:12:\"reorder_user\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:4;}}i:126;a:4:{s:1:\"a\";i:127;s:1:\"b\";s:15:\"delete_any_user\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:4;}}i:127;a:4:{s:1:\"a\";i:128;s:1:\"b\";s:17:\"force_delete_user\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:4;}}i:128;a:4:{s:1:\"a\";i:129;s:1:\"b\";s:21:\"force_delete_any_user\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:4;}}i:129;a:4:{s:1:\"a\";i:130;s:1:\"b\";s:15:\"view_any_vendor\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:4;}}i:130;a:4:{s:1:\"a\";i:131;s:1:\"b\";s:14:\"restore_vendor\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:4;}}i:131;a:4:{s:1:\"a\";i:132;s:1:\"b\";s:18:\"restore_any_vendor\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:4;}}i:132;a:4:{s:1:\"a\";i:133;s:1:\"b\";s:16:\"replicate_vendor\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:4;}}i:133;a:4:{s:1:\"a\";i:134;s:1:\"b\";s:14:\"reorder_vendor\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:4;}}i:134;a:4:{s:1:\"a\";i:135;s:1:\"b\";s:17:\"delete_any_vendor\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:4;}}i:135;a:4:{s:1:\"a\";i:136;s:1:\"b\";s:19:\"force_delete_vendor\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:4;}}i:136;a:4:{s:1:\"a\";i:137;s:1:\"b\";s:23:\"force_delete_any_vendor\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:4;}}}s:5:\"roles\";a:2:{i:0;a:3:{s:1:\"a\";i:4;s:1:\"b\";s:11:\"super_admin\";s:1:\"c\";s:3:\"web\";}i:1;a:3:{s:1:\"a\";i:2;s:1:\"b\";s:7:\"Finance\";s:1:\"c\";s:3:\"web\";}}}', 1755593952);

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
-- Table structure for table `companies`
--

CREATE TABLE `companies` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `specialist` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `website` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `owner` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `vat` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `companies`
--

INSERT INTO `companies` (`id`, `name`, `specialist`, `address`, `email`, `website`, `owner`, `vat`, `created_at`, `updated_at`) VALUES
(1, 'PT. ESA DATA TEKNIKA', 'Specialist in IT Infrastructure | Data Center, Mechanical & Electrical, Security System', 'Jl. Raya Alternatif Cibubur No. 60. A 16820', 'adm@datateknika.com', 'www.datateknika.com', 'Robi Alfian Muhtar', NULL, '2025-08-10 02:23:07', '2025-08-10 02:23:07');

-- --------------------------------------------------------

--
-- Table structure for table `delivery_items`
--

CREATE TABLE `delivery_items` (
  `id` bigint UNSIGNED NOT NULL,
  `delivery_order_id` bigint UNSIGNED NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `qty` int NOT NULL,
  `uom` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `delivery_items`
--

INSERT INTO `delivery_items` (`id`, `delivery_order_id`, `description`, `qty`, `uom`, `created_at`, `updated_at`) VALUES
(1, 1, 'Kabel', 1, 'Pack', '2025-08-13 02:23:26', '2025-08-13 02:23:26');

-- --------------------------------------------------------

--
-- Table structure for table `delivery_orders`
--

CREATE TABLE `delivery_orders` (
  `id` bigint UNSIGNED NOT NULL,
  `code` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `purchase_order_id` bigint UNSIGNED NOT NULL,
  `status` enum('Draft','Delivered') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `delivery_orders`
--

INSERT INTO `delivery_orders` (`id`, `code`, `purchase_order_id`, `status`, `created_at`, `updated_at`) VALUES
(1, '01/EDT/DO/UNKNOWN/08/2025', 1, 'Draft', '2025-08-13 02:23:05', '2025-08-13 02:23:05');

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
-- Table structure for table `file_orders`
--

CREATE TABLE `file_orders` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `purchase_order_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `invoices`
--

CREATE TABLE `invoices` (
  `id` bigint UNSIGNED NOT NULL,
  `code` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `amount_paid` int NOT NULL,
  `remaining_balance` int NOT NULL,
  `purchase_order_id` bigint UNSIGNED NOT NULL,
  `status` enum('Unpaid','Send','Paid') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Unpaid',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `invoices`
--

INSERT INTO `invoices` (`id`, `code`, `name`, `description`, `amount_paid`, `remaining_balance`, `purchase_order_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 'INV_202508130001', 'Category 6A Cable', 'ASD - PT ABC', 100000, 2675000, 3, 'Unpaid', '2025-08-12 17:00:00', '2025-08-12 21:28:19');

-- --------------------------------------------------------

--
-- Table structure for table `item_orders`
--

CREATE TABLE `item_orders` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` enum('Material','Service') COLLATE utf8mb4_unicode_ci NOT NULL,
  `purchase_order_id` bigint UNSIGNED NOT NULL,
  `price` int NOT NULL,
  `qty` int NOT NULL,
  `total` int NOT NULL,
  `status` enum('Preparation','Delivery','Done') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Preparation',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `item_orders`
--

INSERT INTO `item_orders` (`id`, `name`, `type`, `purchase_order_id`, `price`, `qty`, `total`, `status`, `created_at`, `updated_at`) VALUES
(1, 'UPS', 'Material', 1, 500000, 1, 500000, 'Preparation', '2025-07-30 20:32:34', '2025-07-30 20:32:34'),
(2, 'Instalasi', 'Service', 1, 1000000, 1, 1000000, 'Preparation', '2025-07-30 20:32:54', '2025-07-30 20:32:54'),
(3, 'Server', 'Material', 3, 1500000, 1, 1500000, 'Preparation', '2025-07-30 20:47:14', '2025-07-30 20:47:14'),
(4, 'Instalasi', 'Service', 3, 1000000, 1, 1000000, 'Preparation', '2025-07-30 20:47:47', '2025-07-30 20:47:47'),
(5, 'Server', 'Material', 4, 1000000, 1, 1000000, 'Preparation', '2025-07-30 20:50:06', '2025-07-30 20:50:06');

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
(68, '0001_01_01_000000_create_users_table', 1),
(69, '0001_01_01_000001_create_cache_table', 1),
(70, '0001_01_01_000002_create_jobs_table', 1),
(71, '2025_01_31_033002_create_companies_table', 1),
(72, '2025_01_31_041156_create_purchase_orders_table', 1),
(73, '2025_01_31_042652_create_venddors_table', 1),
(74, '2025_01_31_092215_create_delivery_orders_table', 1),
(75, '2025_05_27_033051_create_third_parties_table', 1),
(76, '2025_05_27_044250_create_projects_table', 1),
(77, '2025_06_28_104232_create_item_order_table', 1),
(78, '2025_06_28_104308_create_file_orders_table', 1),
(79, '2025_07_04_142239_create_invoices_table', 1),
(80, '2025_07_05_000000_add_remaining_balance_to_invoices_table', 1),
(81, '2025_07_07_000000_create_delivery_items_table', 1),
(82, '2025_07_24_052734_create_permission_tables', 1),
(85, '2025_08_01_000000_create_tasks_table', 2),
(86, '2025_08_01_000001_create_unexpected_expenses_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(4, 'App\\Models\\User', 1),
(2, 'App\\Models\\User', 2);

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
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'view_role', 'web', '2025-08-12 21:07:21', '2025-08-12 21:07:21'),
(2, 'view_any_role', 'web', '2025-08-12 21:07:21', '2025-08-12 21:07:21'),
(3, 'create_role', 'web', '2025-08-12 21:07:21', '2025-08-12 21:07:21'),
(4, 'update_role', 'web', '2025-08-12 21:07:21', '2025-08-12 21:07:21'),
(5, 'delete_role', 'web', '2025-08-12 21:07:21', '2025-08-12 21:07:21'),
(6, 'delete_any_role', 'web', '2025-08-12 21:07:21', '2025-08-12 21:07:21'),
(7, 'view_company', 'web', '2025-08-12 21:12:37', '2025-08-12 21:12:37'),
(8, 'create_company', 'web', '2025-08-12 21:12:37', '2025-08-12 21:12:37'),
(9, 'update_company', 'web', '2025-08-12 21:12:37', '2025-08-12 21:12:37'),
(10, 'delete_company', 'web', '2025-08-12 21:12:37', '2025-08-12 21:12:37'),
(11, 'view_delivery::order', 'web', '2025-08-12 21:12:37', '2025-08-12 21:12:37'),
(12, 'create_delivery::order', 'web', '2025-08-12 21:12:37', '2025-08-12 21:12:37'),
(13, 'update_delivery::order', 'web', '2025-08-12 21:12:37', '2025-08-12 21:12:37'),
(14, 'delete_delivery::order', 'web', '2025-08-12 21:12:37', '2025-08-12 21:12:37'),
(15, 'view_file::order', 'web', '2025-08-12 21:12:37', '2025-08-12 21:12:37'),
(16, 'create_file::order', 'web', '2025-08-12 21:12:37', '2025-08-12 21:12:37'),
(17, 'update_file::order', 'web', '2025-08-12 21:12:37', '2025-08-12 21:12:37'),
(18, 'delete_file::order', 'web', '2025-08-12 21:12:37', '2025-08-12 21:12:37'),
(19, 'view_item::order', 'web', '2025-08-12 21:12:37', '2025-08-12 21:12:37'),
(20, 'create_item::order', 'web', '2025-08-12 21:12:37', '2025-08-12 21:12:37'),
(21, 'update_item::order', 'web', '2025-08-12 21:12:37', '2025-08-12 21:12:37'),
(22, 'delete_item::order', 'web', '2025-08-12 21:12:37', '2025-08-12 21:12:37'),
(23, 'view_project', 'web', '2025-08-12 21:12:37', '2025-08-12 21:12:37'),
(24, 'create_project', 'web', '2025-08-12 21:12:37', '2025-08-12 21:12:37'),
(25, 'update_project', 'web', '2025-08-12 21:12:37', '2025-08-12 21:12:37'),
(26, 'delete_project', 'web', '2025-08-12 21:12:37', '2025-08-12 21:12:37'),
(27, 'view_purchase::order', 'web', '2025-08-12 21:12:37', '2025-08-12 21:12:37'),
(28, 'create_purchase::order', 'web', '2025-08-12 21:12:37', '2025-08-12 21:12:37'),
(29, 'update_purchase::order', 'web', '2025-08-12 21:12:37', '2025-08-12 21:12:37'),
(30, 'delete_purchase::order', 'web', '2025-08-12 21:12:37', '2025-08-12 21:12:37'),
(31, 'view_purchase::order::out', 'web', '2025-08-12 21:12:37', '2025-08-12 21:12:37'),
(32, 'create_purchase::order::out', 'web', '2025-08-12 21:12:37', '2025-08-12 21:12:37'),
(33, 'update_purchase::order::out', 'web', '2025-08-12 21:12:37', '2025-08-12 21:12:37'),
(34, 'delete_purchase::order::out', 'web', '2025-08-12 21:12:37', '2025-08-12 21:12:37'),
(35, 'view_third::party', 'web', '2025-08-12 21:12:37', '2025-08-12 21:12:37'),
(36, 'create_third::party', 'web', '2025-08-12 21:12:37', '2025-08-12 21:12:37'),
(37, 'update_third::party', 'web', '2025-08-12 21:12:37', '2025-08-12 21:12:37'),
(38, 'delete_third::party', 'web', '2025-08-12 21:12:37', '2025-08-12 21:12:37'),
(39, 'view_user', 'web', '2025-08-12 21:12:37', '2025-08-12 21:12:37'),
(40, 'create_user', 'web', '2025-08-12 21:12:37', '2025-08-12 21:12:37'),
(41, 'update_user', 'web', '2025-08-12 21:12:37', '2025-08-12 21:12:37'),
(42, 'delete_user', 'web', '2025-08-12 21:12:37', '2025-08-12 21:12:37'),
(47, 'page_BusinessDashboard', 'web', '2025-08-12 21:12:37', '2025-08-12 21:12:37'),
(48, 'page_SalesReport', 'web', '2025-08-12 21:12:37', '2025-08-12 21:12:37'),
(49, 'widget_BusinessOverview', 'web', '2025-08-12 21:12:37', '2025-08-12 21:12:37'),
(50, 'widget_StatsOverview', 'web', '2025-08-12 21:12:37', '2025-08-12 21:12:37'),
(51, 'widget_RecentProjects', 'web', '2025-08-12 21:12:37', '2025-08-12 21:12:37'),
(52, 'widget_ProjectStatusChart', 'web', '2025-08-12 21:12:37', '2025-08-12 21:12:37'),
(53, 'widget_FinancialSummary', 'web', '2025-08-12 21:12:37', '2025-08-12 21:12:37'),
(54, 'widget_TasksOverview', 'web', '2025-08-12 21:12:37', '2025-08-12 21:12:37'),
(55, 'widget_ExpensesChart', 'web', '2025-08-12 21:12:37', '2025-08-12 21:12:37'),
(56, 'widget_InvoiceStatus', 'web', '2025-08-12 21:12:37', '2025-08-12 21:12:37'),
(57, 'page_sales_report', 'web', '2025-08-18 00:46:05', '2025-08-18 00:46:05'),
(58, 'view_any_company', 'web', '2025-08-18 00:55:55', '2025-08-18 00:55:55'),
(59, 'view_any_delivery::order', 'web', '2025-08-18 00:55:55', '2025-08-18 00:55:55'),
(60, 'view_any_file::order', 'web', '2025-08-18 00:55:55', '2025-08-18 00:55:55'),
(61, 'view_any_item::order', 'web', '2025-08-18 00:55:55', '2025-08-18 00:55:55'),
(62, 'view_any_project', 'web', '2025-08-18 00:55:55', '2025-08-18 00:55:55'),
(63, 'view_any_purchase::order', 'web', '2025-08-18 00:55:55', '2025-08-18 00:55:55'),
(64, 'view_any_third::party', 'web', '2025-08-18 00:55:55', '2025-08-18 00:55:55'),
(65, 'view_any_user', 'web', '2025-08-18 00:55:55', '2025-08-18 00:55:55'),
(66, 'restore_company', 'web', '2025-08-18 01:00:11', '2025-08-18 01:00:11'),
(67, 'restore_any_company', 'web', '2025-08-18 01:00:11', '2025-08-18 01:00:11'),
(68, 'replicate_company', 'web', '2025-08-18 01:00:11', '2025-08-18 01:00:11'),
(69, 'reorder_company', 'web', '2025-08-18 01:00:11', '2025-08-18 01:00:11'),
(70, 'delete_any_company', 'web', '2025-08-18 01:00:11', '2025-08-18 01:00:11'),
(71, 'force_delete_company', 'web', '2025-08-18 01:00:11', '2025-08-18 01:00:11'),
(72, 'force_delete_any_company', 'web', '2025-08-18 01:00:11', '2025-08-18 01:00:11'),
(73, 'restore_delivery::order', 'web', '2025-08-18 01:00:11', '2025-08-18 01:00:11'),
(74, 'restore_any_delivery::order', 'web', '2025-08-18 01:00:11', '2025-08-18 01:00:11'),
(75, 'replicate_delivery::order', 'web', '2025-08-18 01:00:11', '2025-08-18 01:00:11'),
(76, 'reorder_delivery::order', 'web', '2025-08-18 01:00:11', '2025-08-18 01:00:11'),
(77, 'delete_any_delivery::order', 'web', '2025-08-18 01:00:11', '2025-08-18 01:00:11'),
(78, 'force_delete_delivery::order', 'web', '2025-08-18 01:00:11', '2025-08-18 01:00:11'),
(79, 'force_delete_any_delivery::order', 'web', '2025-08-18 01:00:11', '2025-08-18 01:00:11'),
(80, 'restore_file::order', 'web', '2025-08-18 01:00:11', '2025-08-18 01:00:11'),
(81, 'restore_any_file::order', 'web', '2025-08-18 01:00:11', '2025-08-18 01:00:11'),
(82, 'replicate_file::order', 'web', '2025-08-18 01:00:11', '2025-08-18 01:00:11'),
(83, 'reorder_file::order', 'web', '2025-08-18 01:00:11', '2025-08-18 01:00:11'),
(84, 'delete_any_file::order', 'web', '2025-08-18 01:00:11', '2025-08-18 01:00:11'),
(85, 'force_delete_file::order', 'web', '2025-08-18 01:00:11', '2025-08-18 01:00:11'),
(86, 'force_delete_any_file::order', 'web', '2025-08-18 01:00:11', '2025-08-18 01:00:11'),
(87, 'restore_item::order', 'web', '2025-08-18 01:00:11', '2025-08-18 01:00:11'),
(88, 'restore_any_item::order', 'web', '2025-08-18 01:00:11', '2025-08-18 01:00:11'),
(89, 'replicate_item::order', 'web', '2025-08-18 01:00:11', '2025-08-18 01:00:11'),
(90, 'reorder_item::order', 'web', '2025-08-18 01:00:11', '2025-08-18 01:00:11'),
(91, 'delete_any_item::order', 'web', '2025-08-18 01:00:11', '2025-08-18 01:00:11'),
(92, 'force_delete_item::order', 'web', '2025-08-18 01:00:11', '2025-08-18 01:00:11'),
(93, 'force_delete_any_item::order', 'web', '2025-08-18 01:00:11', '2025-08-18 01:00:11'),
(94, 'restore_project', 'web', '2025-08-18 01:00:11', '2025-08-18 01:00:11'),
(95, 'restore_any_project', 'web', '2025-08-18 01:00:11', '2025-08-18 01:00:11'),
(96, 'replicate_project', 'web', '2025-08-18 01:00:11', '2025-08-18 01:00:11'),
(97, 'reorder_project', 'web', '2025-08-18 01:00:11', '2025-08-18 01:00:11'),
(98, 'delete_any_project', 'web', '2025-08-18 01:00:11', '2025-08-18 01:00:11'),
(99, 'force_delete_project', 'web', '2025-08-18 01:00:11', '2025-08-18 01:00:11'),
(100, 'force_delete_any_project', 'web', '2025-08-18 01:00:11', '2025-08-18 01:00:11'),
(101, 'restore_purchase::order', 'web', '2025-08-18 01:00:11', '2025-08-18 01:00:11'),
(102, 'restore_any_purchase::order', 'web', '2025-08-18 01:00:11', '2025-08-18 01:00:11'),
(103, 'replicate_purchase::order', 'web', '2025-08-18 01:00:11', '2025-08-18 01:00:11'),
(104, 'reorder_purchase::order', 'web', '2025-08-18 01:00:11', '2025-08-18 01:00:11'),
(105, 'delete_any_purchase::order', 'web', '2025-08-18 01:00:11', '2025-08-18 01:00:11'),
(106, 'force_delete_purchase::order', 'web', '2025-08-18 01:00:11', '2025-08-18 01:00:11'),
(107, 'force_delete_any_purchase::order', 'web', '2025-08-18 01:00:11', '2025-08-18 01:00:11'),
(108, 'view_any_purchase::order::out', 'web', '2025-08-18 01:00:11', '2025-08-18 01:00:11'),
(109, 'restore_purchase::order::out', 'web', '2025-08-18 01:00:11', '2025-08-18 01:00:11'),
(110, 'restore_any_purchase::order::out', 'web', '2025-08-18 01:00:11', '2025-08-18 01:00:11'),
(111, 'replicate_purchase::order::out', 'web', '2025-08-18 01:00:11', '2025-08-18 01:00:11'),
(112, 'reorder_purchase::order::out', 'web', '2025-08-18 01:00:11', '2025-08-18 01:00:11'),
(113, 'delete_any_purchase::order::out', 'web', '2025-08-18 01:00:11', '2025-08-18 01:00:11'),
(114, 'force_delete_purchase::order::out', 'web', '2025-08-18 01:00:11', '2025-08-18 01:00:11'),
(115, 'force_delete_any_purchase::order::out', 'web', '2025-08-18 01:00:12', '2025-08-18 01:00:12'),
(116, 'restore_third::party', 'web', '2025-08-18 01:00:12', '2025-08-18 01:00:12'),
(117, 'restore_any_third::party', 'web', '2025-08-18 01:00:12', '2025-08-18 01:00:12'),
(118, 'replicate_third::party', 'web', '2025-08-18 01:00:12', '2025-08-18 01:00:12'),
(119, 'reorder_third::party', 'web', '2025-08-18 01:00:12', '2025-08-18 01:00:12'),
(120, 'delete_any_third::party', 'web', '2025-08-18 01:00:12', '2025-08-18 01:00:12'),
(121, 'force_delete_third::party', 'web', '2025-08-18 01:00:12', '2025-08-18 01:00:12'),
(122, 'force_delete_any_third::party', 'web', '2025-08-18 01:00:12', '2025-08-18 01:00:12'),
(123, 'restore_user', 'web', '2025-08-18 01:00:12', '2025-08-18 01:00:12'),
(124, 'restore_any_user', 'web', '2025-08-18 01:00:12', '2025-08-18 01:00:12'),
(125, 'replicate_user', 'web', '2025-08-18 01:00:12', '2025-08-18 01:00:12'),
(126, 'reorder_user', 'web', '2025-08-18 01:00:12', '2025-08-18 01:00:12'),
(127, 'delete_any_user', 'web', '2025-08-18 01:00:12', '2025-08-18 01:00:12'),
(128, 'force_delete_user', 'web', '2025-08-18 01:00:12', '2025-08-18 01:00:12'),
(129, 'force_delete_any_user', 'web', '2025-08-18 01:00:12', '2025-08-18 01:00:12');

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE `projects` (
  `id` bigint UNSIGNED NOT NULL,
  `code` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `project_location` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `third_party_id` bigint UNSIGNED NOT NULL,
  `planned_date` date NOT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `status` enum('Pending','Preparation','Process','BAST','Success','Cancel') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Pending',
  `cost` int NOT NULL DEFAULT '0',
  `remaining_invoice` int NOT NULL DEFAULT '0',
  `expenses` int NOT NULL DEFAULT '0',
  `net_cost` int NOT NULL DEFAULT '0',
  `description` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`id`, `code`, `name`, `project_location`, `third_party_id`, `planned_date`, `start_date`, `end_date`, `status`, `cost`, `remaining_invoice`, `expenses`, `net_cost`, `description`, `created_at`, `updated_at`) VALUES
(1, 'EP2508-0001', 'Instalasi UPS Hotel Holiday', ' Jl. R.E. Martadinata No.12AA Ancol, Jakarta Utara 14430', 1, '2025-07-30', '2025-07-30', '2025-07-31', 'BAST', 1500000, 1500000, 60000, 1440000, NULL, '2025-07-30 02:27:12', '2025-08-17 23:09:37'),
(2, 'EP2507-0002', 'Instalasi Server Hotel Paragon', ' Jl. R.E. Martadinata No.12AA Ancol, Jakarta Utara 14430', 2, '2025-07-30', '2025-07-30', '2025-07-31', 'Pending', 2500000, 2500000, 1060000, 1440000, 'Instalasi Server pada Hotel Paragon Pusat', '2025-07-30 20:45:14', '2025-08-12 21:28:19');

-- --------------------------------------------------------

--
-- Table structure for table `purchase_orders`
--

CREATE TABLE `purchase_orders` (
  `id` bigint UNSIGNED NOT NULL,
  `project_id` bigint UNSIGNED NOT NULL,
  `order_code` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` enum('In','Out') COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('Preparation','Process','BAST','Success','Cancel') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Preparation',
  `price` int NOT NULL,
  `sales_tax` int NOT NULL,
  `inc_tax` int NOT NULL,
  `discount` int NOT NULL,
  `payment_terms` enum('DP 30%, Progress 30%, After BAST 40%','DP 50%, Progress 20%, After BAST 25%, Retensi 1 Bulan 5%','30% Down Payment, 60% Before Delivery, 10% After TesComm','Cash On Delivery','50% DP, 50% After BAST','50% DP, 50% Before Delivery','Invoice/Maintenance Visit','No DP, 100% After Completion','40% Before Delivery, 55% After BAST, 5% Retention','100% Before Delivery','DP 30%, Progress 30%, After Completion 35%, 5% Retention','Due Upon Receipt') COLLATE utf8mb4_unicode_ci NOT NULL,
  `payment_type` enum('Bank Transfer','Cash','Check','Credit Card','Debit Payment Order') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `purchase_orders`
--

INSERT INTO `purchase_orders` (`id`, `project_id`, `order_code`, `type`, `status`, `price`, `sales_tax`, `inc_tax`, `discount`, `payment_terms`, `payment_type`, `created_at`, `updated_at`) VALUES
(1, 1, 'POI2507-0001', 'In', 'Preparation', 1500000, 11, 1665000, 0, '100% Before Delivery', 'Bank Transfer', '2025-07-30 19:59:03', '2025-07-30 20:32:57'),
(2, 1, 'POO2507-0002', 'Out', 'Preparation', 0, 11, 0, 0, 'Cash On Delivery', 'Cash', '2025-07-30 20:04:55', '2025-07-30 20:04:55'),
(3, 2, 'POI2507-0003', 'In', 'Preparation', 2500000, 11, 2775000, 0, 'No DP, 100% After Completion', 'Bank Transfer', '2025-07-30 20:46:04', '2025-07-30 20:47:55'),
(4, 2, 'POO2507-0004', 'Out', 'Preparation', 1000000, 11, 0, 0, 'No DP, 100% After Completion', 'Cash', '2025-07-30 20:49:27', '2025-07-30 20:50:06');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(2, 'Finance', 'web', '2025-08-12 21:16:45', '2025-08-12 21:16:45'),
(4, 'super_admin', 'web', '2025-08-18 01:20:39', '2025-08-18 01:20:39');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint UNSIGNED NOT NULL,
  `role_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(11, 2),
(12, 2),
(13, 2),
(14, 2),
(15, 2),
(16, 2),
(17, 2),
(18, 2),
(19, 2),
(20, 2),
(21, 2),
(22, 2),
(23, 2),
(24, 2),
(25, 2),
(26, 2),
(31, 2),
(32, 2),
(33, 2),
(34, 2),
(35, 2),
(36, 2),
(37, 2),
(38, 2),
(48, 2),
(49, 2),
(50, 2),
(51, 2),
(52, 2),
(53, 2),
(54, 2),
(55, 2),
(56, 2),
(58, 2),
(59, 2),
(60, 2),
(61, 2),
(62, 2),
(64, 2),
(108, 2),
(109, 2),
(110, 2),
(111, 2),
(112, 2),
(113, 2),
(114, 2),
(115, 2),
(116, 2),
(117, 2),
(118, 2),
(119, 2),
(120, 2),
(121, 2),
(122, 2),
(1, 4),
(2, 4),
(3, 4),
(4, 4),
(5, 4),
(6, 4),
(7, 4),
(8, 4),
(9, 4),
(10, 4),
(11, 4),
(12, 4),
(13, 4),
(14, 4),
(15, 4),
(16, 4),
(17, 4),
(18, 4),
(19, 4),
(20, 4),
(21, 4),
(22, 4),
(23, 4),
(24, 4),
(25, 4),
(26, 4),
(27, 4),
(28, 4),
(29, 4),
(30, 4),
(31, 4),
(32, 4),
(33, 4),
(34, 4),
(35, 4),
(36, 4),
(37, 4),
(38, 4),
(39, 4),
(40, 4),
(41, 4),
(42, 4),
(47, 4),
(48, 4),
(49, 4),
(50, 4),
(51, 4),
(52, 4),
(53, 4),
(54, 4),
(55, 4),
(56, 4),
(58, 4),
(59, 4),
(60, 4),
(61, 4),
(62, 4),
(63, 4),
(64, 4),
(65, 4),
(66, 4),
(67, 4),
(68, 4),
(69, 4),
(70, 4),
(71, 4),
(72, 4),
(73, 4),
(74, 4),
(75, 4),
(76, 4),
(77, 4),
(78, 4),
(79, 4),
(80, 4),
(81, 4),
(82, 4),
(83, 4),
(84, 4),
(85, 4),
(86, 4),
(87, 4),
(88, 4),
(89, 4),
(90, 4),
(91, 4),
(92, 4),
(93, 4),
(94, 4),
(95, 4),
(96, 4),
(97, 4),
(98, 4),
(99, 4),
(100, 4),
(101, 4),
(102, 4),
(103, 4),
(104, 4),
(105, 4),
(106, 4),
(107, 4),
(108, 4),
(109, 4),
(110, 4),
(111, 4),
(112, 4),
(113, 4),
(114, 4),
(115, 4),
(116, 4),
(117, 4),
(118, 4),
(119, 4),
(120, 4),
(121, 4),
(122, 4),
(123, 4),
(124, 4),
(125, 4),
(126, 4),
(127, 4),
(128, 4),
(129, 4);

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
('jq3f2j1vlHrqP2njRN33vlGEF9z8LyZlsYKOe4oG', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36 Edg/139.0.0.0', 'YTo2OntzOjY6Il90b2tlbiI7czo0MDoiRUc2OU9GeU9TTkpSN0NuOHZjU1F6a1ZBSm01ejdjYkxjVmplU00yYyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDU6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hcHAvcHJvamVjdHMvMS90aW1lbGluZSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6MzoidXJsIjthOjA6e31zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO3M6MTc6InBhc3N3b3JkX2hhc2hfd2ViIjtzOjYwOiIkMnkkMTIkcWNIVXQydk9ZbkcwQ0Y3cWc0UU1zdVl1LzR1dVAwU0VDUm9MNEZtMkVTSUNtVGNnaUdMQk8iO30=', 1755519160);

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

CREATE TABLE `tasks` (
  `id` bigint UNSIGNED NOT NULL,
  `project_id` bigint UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `task_date` date NOT NULL,
  `coordinator` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `worker_count` int NOT NULL,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('Pending','In Progress','Completed') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tasks`
--

INSERT INTO `tasks` (`id`, `project_id`, `name`, `description`, `task_date`, `coordinator`, `worker_count`, `photo`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'Instalasi', 'Melakukan instalasi server pada Hotel Holiday', '2025-07-31', 'Muhammad Maulana', 5, 'task-photos/01K2HD6QFSJXSX5TFFDQS47KG9.jpg', 'Completed', '2025-07-30 20:07:00', '2025-08-17 23:07:58'),
(2, 2, 'Instalasi', 'Instalasi Server Hotel Paragon', '2025-07-31', 'Muhammad Maulana', 3, 'task-photos/01K1F9R08AMM447NFXPM8PQZYW.png', 'Pending', '2025-07-30 20:52:18', '2025-07-30 20:52:18'),
(3, 1, 'Maintenance', 'asd', '2025-08-18', 'Muhammad Maulana', 2, 'task-photos/01K2XWMZVHQF953JW0KPE0Q38R.png', 'Pending', '2025-08-17 23:07:47', '2025-08-17 23:07:47');

-- --------------------------------------------------------

--
-- Table structure for table `third_parties`
--

CREATE TABLE `third_parties` (
  `id` bigint UNSIGNED NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alias` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` enum('Customer','Vendor') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Customer',
  `status` enum('Active','Non Active') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Active',
  `vat` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telepon` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `website` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `third_parties`
--

INSERT INTO `third_parties` (`id`, `code`, `name`, `alias`, `type`, `status`, `vat`, `contact`, `telepon`, `address`, `website`, `created_at`, `updated_at`) VALUES
(1, 'EC250700001', 'PT. AMPNET', 'PT. AMPNET', 'Customer', 'Active', '84124912', 'Alan', '081287577202', 'Jl. Raya Alternatif Cibubur No. 60. A 16820', NULL, '2025-07-30 02:24:05', '2025-07-30 02:24:05'),
(2, 'EC250700002', 'PT. Paragon', 'PT. Paragon', 'Customer', 'Active', '84124912', 'Reza', '081287577202', 'Jl. Raya Alternatif Cibubur No. 60. A 16820', NULL, '2025-07-30 20:44:14', '2025-07-30 20:44:14');

-- --------------------------------------------------------

--
-- Table structure for table `unexpected_expenses`
--

CREATE TABLE `unexpected_expenses` (
  `id` bigint UNSIGNED NOT NULL,
  `project_id` bigint UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `expense_date` date NOT NULL,
  `amount` int NOT NULL,
  `receipt` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `unexpected_expenses`
--

INSERT INTO `unexpected_expenses` (`id`, `project_id`, `name`, `description`, `expense_date`, `amount`, `receipt`, `created_at`, `updated_at`) VALUES
(1, 1, 'Konsumsi Teknisi', 'Nasi Padan 5 Bungkus @12.000', '2025-07-31', 60000, 'expense-receipts/01K1F7B9689FV4Q7RYHHD82TED.png', '2025-07-30 20:10:04', '2025-07-30 20:10:24'),
(2, 2, 'Konsumsi Teknisi', 'Nasi Padang Paket 12 Ribu', '2025-07-31', 60000, 'expense-receipts/01K1F9VEM0R0BS6SX7DZJJE1BV.png', '2025-07-30 20:53:22', '2025-07-30 20:54:12');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` enum('Customer','Logistik','Finance','Vendor','Owner','Admin') COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@edt.com', '$2y$12$qcHUt2vOYnG0CF7qg4QMsuYu/4uuP0SECRoL4Fm2ESICmTcgiGLBO', 'Admin', NULL, NULL, NULL),
(2, 'Finance', 'finance@edt.com', '$2y$12$Ig2Bpzl3tyqM/PCoxHNyqeKyfHdvzMCIDex4MF3I8d0Jnr3k3QYZq', 'Customer', NULL, '2025-08-12 21:17:50', '2025-08-12 21:17:50');

-- --------------------------------------------------------

--
-- Table structure for table `vendors`
--

CREATE TABLE `vendors` (
  `id` bigint UNSIGNED NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `vat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telepon` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

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
-- Indexes for table `companies`
--
ALTER TABLE `companies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `delivery_items`
--
ALTER TABLE `delivery_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `delivery_orders`
--
ALTER TABLE `delivery_orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `file_orders`
--
ALTER TABLE `file_orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `invoices`
--
ALTER TABLE `invoices`
  ADD PRIMARY KEY (`id`),
  ADD KEY `invoices_purchase_order_id_foreign` (`purchase_order_id`);

--
-- Indexes for table `item_orders`
--
ALTER TABLE `item_orders`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `projects_code_unique` (`code`),
  ADD KEY `projects_third_party_id_foreign` (`third_party_id`);

--
-- Indexes for table `purchase_orders`
--
ALTER TABLE `purchase_orders`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `purchase_orders_order_code_unique` (`order_code`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tasks_project_id_foreign` (`project_id`);

--
-- Indexes for table `third_parties`
--
ALTER TABLE `third_parties`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `unexpected_expenses`
--
ALTER TABLE `unexpected_expenses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `unexpected_expenses_project_id_foreign` (`project_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `vendors`
--
ALTER TABLE `vendors`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `companies`
--
ALTER TABLE `companies`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `delivery_items`
--
ALTER TABLE `delivery_items`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `delivery_orders`
--
ALTER TABLE `delivery_orders`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `file_orders`
--
ALTER TABLE `file_orders`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `invoices`
--
ALTER TABLE `invoices`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `item_orders`
--
ALTER TABLE `item_orders`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=87;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=138;

--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `purchase_orders`
--
ALTER TABLE `purchase_orders`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `third_parties`
--
ALTER TABLE `third_parties`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `unexpected_expenses`
--
ALTER TABLE `unexpected_expenses`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `vendors`
--
ALTER TABLE `vendors`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `invoices`
--
ALTER TABLE `invoices`
  ADD CONSTRAINT `invoices_purchase_order_id_foreign` FOREIGN KEY (`purchase_order_id`) REFERENCES `purchase_orders` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `projects`
--
ALTER TABLE `projects`
  ADD CONSTRAINT `projects_third_party_id_foreign` FOREIGN KEY (`third_party_id`) REFERENCES `third_parties` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `tasks`
--
ALTER TABLE `tasks`
  ADD CONSTRAINT `tasks_project_id_foreign` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `unexpected_expenses`
--
ALTER TABLE `unexpected_expenses`
  ADD CONSTRAINT `unexpected_expenses_project_id_foreign` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
