-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 19, 2024 at 04:06 PM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lms`
--

-- --------------------------------------------------------

--
-- Table structure for table `become_instructors`
--

CREATE TABLE `become_instructors` (
  `id` int UNSIGNED NOT NULL,
  `user_id` int UNSIGNED NOT NULL,
  `certificate` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `status` enum('pending','accept','reject') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `created_at` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `become_instructors`
--

INSERT INTO `become_instructors` (`id`, `user_id`, `certificate`, `description`, `status`, `created_at`) VALUES
(5, 930, '/store/930/certificate.jpg', 'I taught design in London for two years.', 'pending', 1626242477);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int UNSIGNED NOT NULL,
  `parent_id` int DEFAULT '0',
  `title` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `icon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order` int UNSIGNED DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `parent_id`, `title`, `slug`, `icon`, `order`) VALUES
(528, 0, 'Development', NULL, '/store/1/default_images/categories_icons/code.svg', 0),
(606, 528, 'Backend Development', 'Backend-Development', NULL, 1),
(607, 528, 'Mobile Development', 'Mobile-Development', NULL, 2),
(608, 528, 'Web Development', 'Web-Development', NULL, 3),
(612, 0, 'Kiểm Tra', NULL, '/store/1/default_images/categories_icons/pie-chart.svg', 0),
(613, 612, 'Bài Kiểm Tra', 'danh-muc-tong-hop-bai-kiem-tra', NULL, 3);

-- --------------------------------------------------------

--
-- Table structure for table `chapter_content`
--

CREATE TABLE `chapter_content` (
  `id` int NOT NULL,
  `chapter_id` int DEFAULT '0',
  `webinar_id` int DEFAULT '0',
  `title` varchar(999) COLLATE utf8mb3_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `chapter_content`
--

INSERT INTO `chapter_content` (`id`, `chapter_id`, `webinar_id`, `title`) VALUES
(1, 1, 2010, 'Bắt đầu khóa học'),
(3, 3, 1, 'Cài đặt môi trường, công cụ cần thiết');

-- --------------------------------------------------------

--
-- Table structure for table `faqs`
--

CREATE TABLE `faqs` (
  `id` int UNSIGNED NOT NULL,
  `creator_id` int UNSIGNED NOT NULL,
  `webinar_id` int UNSIGNED NOT NULL,
  `title` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `answer` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `order` int UNSIGNED DEFAULT NULL,
  `created_at` int UNSIGNED DEFAULT NULL,
  `updated_at` int UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `faqs`
--

INSERT INTO `faqs` (`id`, `creator_id`, `webinar_id`, `title`, `answer`, `order`, `created_at`, `updated_at`) VALUES
(13, 1016, 2010, 'Người mới bắt đầu có thể tham gia khóa học này không?', 'Đây là khóa học dành cho người mới bắt đầu nên bạn sẽ làm quen với chủ đề này từ đầu.', NULL, 1624908798, NULL),
(14, 1016, 2010, 'Làm thế nào tôi có thể nhận được cập nhật khóa học?', 'Bạn sẽ nhận được thông báo sau khi mỗi bản cập nhật được phát hành để bạn có thể tải xuống các tệp cập nhật từ trang khóa học.', NULL, 1624908812, NULL),
(15, 1016, 2010, 'Đây có phải là một khóa học được hỗ trợ?', 'Có, bạn có thể liên lạc với người hướng dẫn bằng hệ thống hỗ trợ.', NULL, 1624908829, NULL),
(16, 1016, 2010, 'Làm cách nào tôi có thể tải xuống các tệp bài tập?', 'Tất cả các tệp bài tập có thể được tải xuống từ tab nội dung trên trang khóa học.', NULL, 1624908852, NULL),
(17, 1016, 2010, 'Tôi có thể có một cuộc họp riêng với người hướng dẫn?', 'Có, bạn có thể đặt trước cuộc gặp 1-1 với người hướng dẫn bằng cách sử dụng hồ sơ của người hướng dẫn.', NULL, 1624908868, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `favourite_courses`
--

CREATE TABLE `favourite_courses` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `course_slug` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `time` varchar(20) COLLATE utf8mb3_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `favourite_courses`
--

INSERT INTO `favourite_courses` (`id`, `user_id`, `course_slug`, `time`) VALUES
(1, 22, 'phan-tich-va-thiet-ke-co-so-du-lieu', '1695129685'),
(2, 1, 'phan-tich-va-thiet-ke-co-so-du-lieu', '1706428419'),
(3, 1, 'Learn-Python-Programming', '1713080213'),
(4, 30, 'Learn-Python-Programming', '1715946673'),
(5, 30, 'phan-tich-va-thiet-ke-co-so-du-lieu', '1715999822'),
(6, 30, 'tong-hop-kiem-tra', '1716133538');

-- --------------------------------------------------------

--
-- Table structure for table `files`
--

CREATE TABLE `files` (
  `id` int UNSIGNED NOT NULL,
  `creator_id` int UNSIGNED NOT NULL,
  `webinar_id` int UNSIGNED NOT NULL,
  `chapter_id` int NOT NULL,
  `title` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `accessibility` enum('free','paid') COLLATE utf8mb4_unicode_ci NOT NULL,
  `downloadable` tinyint(1) DEFAULT '0',
  `storage` enum('local','online') COLLATE utf8mb4_unicode_ci NOT NULL,
  `file` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `volume` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_type` enum('video','document') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'document',
  `description` varchar(1000) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order` int UNSIGNED DEFAULT NULL,
  `created_at` int NOT NULL,
  `updated_at` int DEFAULT NULL,
  `deleted_at` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `files`
--

INSERT INTO `files` (`id`, `creator_id`, `webinar_id`, `chapter_id`, `title`, `accessibility`, `downloadable`, `storage`, `file`, `volume`, `file_type`, `description`, `order`, `created_at`, `updated_at`, `deleted_at`) VALUES
(32, 1016, 2010, 1, 'Phân tích và thiết kế cơ sở dữ liệu - Buổi 1', 'free', 0, 'online', 'https://youtu.be/UBQbreSjEdc', '0', 'video', 'Khóa học database', 3, 1624870086, 1624870190, NULL),
(60, 1016, 2010, 1, 'Phân tích và thiết kế cơ sở dữ liệu - Buổi 2', 'free', 0, 'local', 'http://commondatastorage.googleapis.com/gtv-videos-bucket/sample/BigBuckBunny.mp4', '46.5', 'video', 'Khóa học database phần 2', 3, 1624870086, 1624870190, NULL),
(61, 1016, 2010, 1, 'BÀI GIẢNG DẠNG PDF', 'free', 0, 'online', 'https://www.clickdimensions.com/links/TestPDFfile.pdf', '45', 'document', 'Bài giảng database pdf full', 3, 1624870086, 1624870190, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `history_recharge`
--

CREATE TABLE `history_recharge` (
  `id` int NOT NULL,
  `type` varchar(99) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `email` varchar(999) NOT NULL,
  `telco` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `serial` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `pin` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `amount` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `note` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `request_id` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `trans_id` int NOT NULL,
  `status` int NOT NULL,
  `callback_time` int NOT NULL,
  `time` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `history_recharge`
--

INSERT INTO `history_recharge` (`id`, `type`, `email`, `telco`, `serial`, `pin`, `amount`, `note`, `request_id`, `trans_id`, `status`, `callback_time`, `time`) VALUES
(1, 'Nạp Thẻ Cào', 'taoprolamnha@gmail.com', 'VIETTEL', '03940191029301', '039401910293019', '10000', NULL, 'localhost714894', 995003, 1, 1687682856, 1687530915),
(2, 'Nạp Thẻ Cào', 'taoprolamnha@gmail.com', 'VIETTEL', '34059101920394', '994059101920394', '10000', NULL, 'localhost698232', 490349, 1, 1687681563, 1687681517),
(3, 'Nạp Thẻ Cào', 'taoprolamnha@gmail.com', 'VIETTEL', '99940591019203', '999405910192031', '50000', NULL, 'localhost364942', 951736, 0, 0, 1687932866),
(4, 'Nạp Thẻ Cào', 'taoprolamnha@gmail.com', 'VIETTEL', '13238683431653', '231346538606831', '300000', NULL, '192.168.1.6201161', 382903, 0, 0, 1688113699),
(6, 'Nạp Thẻ Cào', 'khaidev.com@gmail.com', 'VIETTEL', '88984958945895', '994019203910292', '10000', NULL, 'localhost129892', 421750, 1, 1714815976, 1714815849),
(7, 'Nạp Thẻ Cào', 'lequangnguyen1221@gmail.com', 'VIETTEL', '99405910293049', '940192039401923', '30000', NULL, 'localhost114891', 517377, 1, 1716116069, 1716116016);

-- --------------------------------------------------------

--
-- Table structure for table `login_records`
--

CREATE TABLE `login_records` (
  `id` int NOT NULL,
  `user_email` varchar(30) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `user_id` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `device_id` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `login_time` int NOT NULL,
  `type` varchar(11) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT 'local'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `login_records`
--

INSERT INTO `login_records` (`id`, `user_email`, `user_id`, `device_id`, `login_time`, `type`) VALUES
(1, 'lequangkhai.dev@gmail.com', '115292141256719766504', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/124.0.0.0 Safari/537.36 Edg/124.0.0.0', 1714813342, 'google'),
(2, 'leminhphuc172@gmail.com', '101320735742166193812', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/124.0.0.0 Safari/537.36 Edg/124.0.0.0', 1714814724, 'google'),
(3, 'leminhphuc172@gmail.com', '101320735742166193812', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/124.0.0.0 Safari/537.36 Edg/124.0.0.0', 1714814773, 'google'),
(4, 'leminhphuc172@gmail.com', '101320735742166193812', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/124.0.0.0 Safari/537.36 Edg/124.0.0.0', 1714889492, 'google'),
(5, 'leminhphuc172@gmail.com', '101320735742166193812', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/124.0.0.0 Safari/537.36 Edg/124.0.0.0', 1715951505, 'google'),
(6, 'lequangnguyen1221@gmail.com', '101627640638781966694', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/124.0.0.0 Safari/537.36 Edg/124.0.0.0', 1715951576, 'google'),
(7, 'lequangnguyen1221@gmail.com', '101627640638781966694', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/124.0.0.0 Safari/537.36 Edg/124.0.0.0', 1716042066, 'google'),
(8, 'lequangnguyen1221@gmail.com', '101627640638781966694', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/124.0.0.0 Safari/537.36 Edg/124.0.0.0', 1716042235, 'google'),
(9, 'lequangnguyen1221@gmail.com', '101627640638781966694', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/124.0.0.0 Safari/537.36 Edg/124.0.0.0', 1716042764, 'google'),
(10, 'lequangnguyen1221@gmail.com', '101627640638781966694', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/124.0.0.0 Safari/537.36 Edg/124.0.0.0', 1716043359, 'google'),
(11, 'lequangnguyen1221@gmail.com', '101627640638781966694', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/125.0.0.0 Safari/537.36 Edg/125.0.0.0', 1716101227, 'google'),
(12, 'lequangnguyen1221@gmail.com', '101627640638781966694', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/125.0.0.0 Safari/537.36 Edg/125.0.0.0', 1716102588, 'google'),
(13, 'lequangnguyen1221@gmail.com', '101627640638781966694', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/125.0.0.0 Safari/537.36 Edg/125.0.0.0', 1716107047, 'google'),
(14, 'lequangnguyen1221@gmail.com', '101627640638781966694', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/125.0.0.0 Safari/537.36 Edg/125.0.0.0', 1716107099, 'google'),
(15, 'leminhphuc172@gmail.com', '101320735742166193812', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/125.0.0.0 Safari/537.36', 1716107529, 'google'),
(16, 'leminhphuc172@gmail.com', '101320735742166193812', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/125.0.0.0 Safari/537.36', 1716107950, 'google'),
(17, 'leminhphuc172@gmail.com', '101320735742166193812', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/125.0.0.0 Safari/537.36', 1716108002, 'google'),
(18, 'leminhphuc172@gmail.com', '101320735742166193812', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/125.0.0.0 Safari/537.36', 1716108112, 'google'),
(19, 'leminhphuc172@gmail.com', '101320735742166193812', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/125.0.0.0 Safari/537.36', 1716108430, 'google'),
(20, 'minhphucle172@gmail.com', '102079304912228253864', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/125.0.0.0 Safari/537.36', 1716108603, 'google'),
(21, 'minhphucle172@gmail.com', '102079304912228253864', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/125.0.0.0 Safari/537.36', 1716108767, 'google'),
(22, 'minhphucle172@gmail.com', '102079304912228253864', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/125.0.0.0 Safari/537.36', 1716108919, 'google'),
(23, 'leminhphuc172@gmail.com', '101320735742166193812', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/125.0.0.0 Safari/537.36', 1716109492, 'google'),
(24, 'leminhphuc172@gmail.com', '101320735742166193812', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/125.0.0.0 Safari/537.36', 1716109635, 'google'),
(25, 'leminhphuc172@gmail.com', '101320735742166193812', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/125.0.0.0 Safari/537.36', 1716109805, 'google'),
(26, 'leminhphuc172@gmail.com', '101320735742166193812', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/125.0.0.0 Safari/537.36', 1716109879, 'google'),
(27, 'leminhphuc172@gmail.com', '101320735742166193812', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/125.0.0.0 Safari/537.36', 1716110583, 'google'),
(28, 'leminhphuc172@gmail.com', '101320735742166193812', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/125.0.0.0 Safari/537.36', 1716110841, 'google'),
(29, 'leminhphuc172@gmail.com', '101320735742166193812', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/125.0.0.0 Safari/537.36', 1716111066, 'google'),
(30, 'minhphucle172@gmail.com', '102079304912228253864', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/125.0.0.0 Safari/537.36', 1716111741, 'google'),
(31, 'lequangnguyen1221@gmail.com', '101627640638781966694', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/125.0.0.0 Safari/537.36 Edg/125.0.0.0', 1716111985, 'google'),
(32, 'lequangnguyen1221@gmail.com', '101627640638781966694', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/125.0.0.0 Safari/537.36 Edg/125.0.0.0', 1716130663, 'google');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int UNSIGNED NOT NULL,
  `user_id` int UNSIGNED NOT NULL,
  `webinar_id` int NOT NULL,
  `status` enum('pedding','success') COLLATE utf8mb4_unicode_ci NOT NULL,
  `payment_method` enum('vnpay','momo','coins','free') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `amount` int UNSIGNED NOT NULL,
  `total_amount` int DEFAULT NULL,
  `trans_id` text COLLATE utf8mb4_unicode_ci,
  `note` varchar(999) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `webinar_id`, `status`, `payment_method`, `amount`, `total_amount`, `trans_id`, `note`, `created_at`) VALUES
(1, 30, 1, 'success', 'momo', 5000000, 5000000, '72751716117552', 'Thanh toán: Học Lập Trình Python Cơ Bản Đến Nâng Cao', 1716117552),
(2, 30, 2010, 'success', 'free', 0, 0, 'free4249', NULL, 1716125191),
(3, 30, 2011, 'success', 'free', 0, 0, 'free9476', NULL, 1716133136);

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` int UNSIGNED NOT NULL,
  `user_id` int UNSIGNED NOT NULL,
  `order_id` int UNSIGNED NOT NULL,
  `webinar_id` int UNSIGNED DEFAULT NULL,
  `trans_id` varchar(99) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` int UNSIGNED DEFAULT NULL,
  `total_amount` int DEFAULT NULL,
  `type` enum('vnpay','momo','coins','free') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` int UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `user_id`, `order_id`, `webinar_id`, `trans_id`, `amount`, `total_amount`, `type`, `created_at`) VALUES
(1, 30, 1, 1, '72751716117552', 5000000, 5000000, 'momo', 1716118055),
(2, 30, 2, 2010, 'free4249', 0, 0, 'free', 1716125191),
(3, 30, 3, 2011, 'free9476', 0, 0, 'free', 1716133136);

-- --------------------------------------------------------

--
-- Table structure for table `quizzes`
--

CREATE TABLE `quizzes` (
  `id` int UNSIGNED NOT NULL,
  `webinar_id` int UNSIGNED DEFAULT NULL,
  `creator_id` int UNSIGNED NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `time` int DEFAULT '0',
  `attempt` int DEFAULT NULL,
  `pass_mark` int NOT NULL,
  `certificate` tinyint(1) NOT NULL,
  `status` enum('active','inactive') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_mark` int UNSIGNED DEFAULT NULL,
  `show_result` enum('show','hide') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'show',
  `password` varchar(99) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` int NOT NULL,
  `updated_at` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `quizzes`
--

INSERT INTO `quizzes` (`id`, `webinar_id`, `creator_id`, `title`, `time`, `attempt`, `pass_mark`, `certificate`, `status`, `total_mark`, `show_result`, `password`, `created_at`, `updated_at`) VALUES
(28, 2010, 1, 'Trắc Nghiệm Nhanh', 5, 10, 30, 1, 'active', 100, 'show', NULL, 1624872015, NULL),
(35, 1, 1, 'Trắc Nghiệm Nhanh 2', 5, 10, 70, 1, 'active', 100, 'show', NULL, 1624872015, NULL),
(36, 2011, 1, 'KIỂM TRA LÝ THUYẾT TIN HỌC CƠ BẢN', 10, 2, 100, 1, 'active', 100, 'show', 'e10adc3949ba59abbe56e057f20f883e', 1624872015, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `quizzes_questions`
--

CREATE TABLE `quizzes_questions` (
  `id` int UNSIGNED NOT NULL,
  `quiz_id` int UNSIGNED NOT NULL,
  `creator_id` int UNSIGNED NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `grade` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` enum('multiple','descriptive') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `correct` varchar(1000) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` int NOT NULL,
  `updated_at` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `quizzes_questions`
--

INSERT INTO `quizzes_questions` (`id`, `quiz_id`, `creator_id`, `title`, `grade`, `type`, `correct`, `created_at`, `updated_at`) VALUES
(40, 28, 1, 'Đâu là thủ đô nước Pháp?', '20', 'multiple', NULL, 1624872142, NULL),
(41, 28, 1, 'Đâu là ngôn ngữ lập trình?', '20', 'multiple', NULL, 1624872345, NULL),
(72, 36, 1, 'Hệ điều hành là gì?', '10', 'multiple', NULL, 1624872345, NULL),
(73, 36, 1, 'Phím tắt nào được sử dụng để sao chép văn bản trong Windows?', '10', 'multiple', NULL, 1624872345, NULL),
(74, 36, 1, 'Microsoft Word là một phần mềm gì?', '10', 'multiple', NULL, 1624872345, NULL),
(75, 36, 1, 'HTML là viết tắt của gì?', '10', 'multiple', NULL, 1624872345, NULL),
(76, 36, 1, 'Phần cứng nào sau đây là thiết bị đầu ra?', '10', 'multiple', NULL, 1624872345, NULL),
(77, 36, 1, 'Trong Excel, hàm nào được sử dụng để tính tổng các giá trị trong một phạm vi?', '10', 'multiple', NULL, 1624872345, NULL),
(78, 36, 1, 'Trong mạng máy tính, từ viết tắt \'IP\' có nghĩa là gì?', '10', 'multiple', NULL, 1624872345, NULL),
(79, 36, 1, 'Phím tắt để lưu tệp tin trong hầu hết các ứng dụng là gì?', '10', 'multiple', NULL, 1624872345, NULL),
(80, 36, 1, 'Chương trình nào sau đây là trình duyệt web?', '10', 'multiple', NULL, 1624872345, NULL),
(81, 36, 1, 'Để khởi động lại máy tính, bạn nhấn tổ hợp phím nào?', '10', 'multiple', NULL, 1624872345, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `quizzes_questions_answers`
--

CREATE TABLE `quizzes_questions_answers` (
  `id` int UNSIGNED NOT NULL,
  `creator_id` int UNSIGNED NOT NULL,
  `question_id` int UNSIGNED NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `correct` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` int NOT NULL,
  `updated_at` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `quizzes_questions_answers`
--

INSERT INTO `quizzes_questions_answers` (`id`, `creator_id`, `question_id`, `title`, `image`, `correct`, `created_at`, `updated_at`) VALUES
(83, 1, 40, 'Paris', NULL, 1, 1624872142, NULL),
(84, 1, 40, 'Berlin', NULL, 0, 1624872142, NULL),
(85, 1, 40, 'London', NULL, 0, 1624872142, NULL),
(86, 1, 40, 'New York', NULL, 0, 1624872142, NULL),
(191, 1, 41, 'Python', NULL, 1, 1624872142, NULL),
(192, 1, 41, 'HTML', NULL, 0, 1624872142, NULL),
(193, 1, 72, 'A) Phần mềm quản lý phần cứng và phần mềm máy tính.', NULL, 1, 1624872142, NULL),
(194, 1, 72, 'B) Phần mềm tạo văn bản.', NULL, 0, 1624872142, NULL),
(195, 1, 72, 'C) Phần mềm duyệt web.', NULL, 0, 1624872142, NULL),
(196, 1, 72, 'D) Phần mềm đồ họa.', NULL, 0, 1624872142, NULL),
(197, 1, 73, 'A) Ctrl + V', NULL, 0, 1624872142, NULL),
(198, 1, 73, 'B) Ctrl + C', NULL, 1, 1624872142, NULL),
(199, 1, 73, 'C) Ctrl + X', NULL, 0, 1624872142, NULL),
(200, 1, 73, 'D) Ctrl + Z', NULL, 0, 1624872142, NULL),
(201, 1, 74, 'A) Phần mềm đồ họa.', NULL, 0, 1624872142, NULL),
(202, 1, 74, 'B) Phần mềm quản lý cơ sở dữ liệu.', NULL, 0, 1624872142, NULL),
(203, 1, 74, 'C) Phần mềm xử lý văn bản.', NULL, 1, 1624872142, NULL),
(204, 1, 74, 'D) Phần mềm diệt virus.', NULL, 0, 1624872142, NULL),
(205, 1, 75, 'A) Hyper Trainer Marking Language.', NULL, 0, 1624872142, NULL),
(206, 1, 75, 'B) Hyper Text Marketing Language.', NULL, 0, 1624872142, NULL),
(207, 1, 75, 'C) Hyper Text Markup Language.\r\n', NULL, 1, 1624872142, NULL),
(208, 1, 75, 'D) High Text Markup Language.', NULL, 0, 1624872142, NULL),
(209, 1, 76, 'A) Bàn phím.', NULL, 0, 1624872142, NULL),
(210, 1, 76, 'B) Chuột.', NULL, 0, 1624872142, NULL),
(211, 1, 76, 'C) Máy in.', NULL, 1, 1624872142, NULL),
(212, 1, 76, 'D) Máy quét.', NULL, 0, 1624872142, NULL),
(213, 1, 77, 'A) AVERAGE', NULL, 0, 1624872142, NULL),
(214, 1, 77, 'B) COUNT', NULL, 0, 1624872142, NULL),
(215, 1, 77, 'C) SUM', NULL, 1, 1624872142, NULL),
(216, 1, 77, 'D) MAX', NULL, 0, 1624872142, NULL),
(217, 1, 78, 'A) Internet Provider.', NULL, 0, 1624872142, NULL),
(218, 1, 78, 'B) Internet Protocol.', NULL, 1, 1624872142, NULL),
(219, 1, 78, 'C) Internal Protocol.', NULL, 0, 1624872142, NULL),
(220, 1, 78, 'D) Internet Processor.', NULL, 0, 1624872142, NULL),
(221, 1, 79, 'A) Ctrl + S', NULL, 1, 1624872142, NULL),
(222, 1, 79, 'B) Ctrl + P', NULL, 0, 1624872142, NULL),
(223, 1, 79, 'C) Ctrl + O', NULL, 0, 1624872142, NULL),
(224, 1, 79, 'D) Ctrl + N', NULL, 0, 1624872142, NULL),
(225, 1, 80, 'A) Microsoft Word.', NULL, 0, 1624872142, NULL),
(226, 1, 80, 'B) Adobe Photoshop.', NULL, 0, 1624872142, NULL),
(227, 1, 80, 'C) Google Chrome.', NULL, 1, 1624872142, NULL),
(228, 1, 80, 'D) Skype.', NULL, 0, 1624872142, NULL),
(229, 1, 81, 'A) Ctrl + Alt + Delete', NULL, 1, 1624872142, NULL),
(230, 1, 81, 'B) Ctrl + Shift + Esc', NULL, 0, 1624872142, NULL),
(231, 1, 81, 'C) Alt + F4', NULL, 0, 1624872142, NULL),
(232, 1, 81, 'D) Ctrl + Esc', NULL, 0, 1624872142, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `quizzes_results`
--

CREATE TABLE `quizzes_results` (
  `id` int UNSIGNED NOT NULL,
  `quiz_id` int UNSIGNED NOT NULL,
  `user_id` int UNSIGNED NOT NULL,
  `results` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `user_grade` int DEFAULT NULL,
  `status` enum('passed','failed','waiting') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'waiting',
  `created_at` varchar(99) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `quizzes_results`
--

INSERT INTO `quizzes_results` (`id`, `quiz_id`, `user_id`, `results`, `user_grade`, `status`, `created_at`) VALUES
(1, 36, 30, '[{\"72\":{\"user_ans\":193,\"correct\":193,\"status\":\"true\",\"grade\":\"10\",\"total_grade\":\"10\"}},{\"73\":{\"user_ans\":198,\"correct\":198,\"status\":\"true\",\"grade\":\"10\",\"total_grade\":\"10\"}},{\"74\":{\"user_ans\":203,\"correct\":203,\"status\":\"true\",\"grade\":\"10\",\"total_grade\":\"10\"}},{\"75\":{\"user_ans\":207,\"correct\":207,\"status\":\"true\",\"grade\":\"10\",\"total_grade\":\"10\"}},{\"76\":{\"user_ans\":211,\"correct\":211,\"status\":\"true\",\"grade\":\"10\",\"total_grade\":\"10\"}},{\"77\":{\"user_ans\":215,\"correct\":215,\"status\":\"true\",\"grade\":\"10\",\"total_grade\":\"10\"}},{\"78\":{\"user_ans\":218,\"correct\":218,\"status\":\"true\",\"grade\":\"10\",\"total_grade\":\"10\"}},{\"79\":{\"user_ans\":221,\"correct\":221,\"status\":\"true\",\"grade\":\"10\",\"total_grade\":\"10\"}},{\"80\":{\"user_ans\":227,\"correct\":227,\"status\":\"true\",\"grade\":\"10\",\"total_grade\":\"10\"}},{\"81\":{\"user_ans\":229,\"correct\":229,\"status\":\"true\",\"grade\":\"10\",\"total_grade\":\"10\"}}]', 100, 'passed', '1716134569');

-- --------------------------------------------------------

--
-- Table structure for table `send_email`
--

CREATE TABLE `send_email` (
  `id` int NOT NULL,
  `email` varchar(255) COLLATE utf8mb3_vietnamese_ci NOT NULL,
  `action` varchar(255) COLLATE utf8mb3_vietnamese_ci NOT NULL,
  `msg` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `code` varchar(255) COLLATE utf8mb3_vietnamese_ci DEFAULT NULL,
  `time` varchar(255) COLLATE utf8mb3_vietnamese_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_vietnamese_ci;

--
-- Dumping data for table `send_email`
--

INSERT INTO `send_email` (`id`, `email`, `action`, `msg`, `code`, `time`) VALUES
(1, 'jfk34635@nezid.com', 'register', 'Đăng ký tài khoản bằng email: jfk34635@nezid.com', 'fp964171', '22/08/2023 - 21:20:23'),
(2, 'lnt71586@nezid.com', 'register', 'Đăng ký tài khoản bằng email: lnt71586@nezid.com', 'fp433714', '22/08/2023 - 21:21:41'),
(3, 'jfk34635@nezid.com', 'register', 'Đăng ký tài khoản bằng email: jfk34635@nezid.com', 'fp282974', '22/08/2023 - 21:27:28'),
(5, 'lequangkhai.dev@gmail.com', 'reset-password', 'Đặt lại mật khẩu qua email: lequangkhai.dev@gmail.com', 'fp830023', '18/09/2023 - 19:55:47'),
(6, 'lequangkhai.dev@gmail.com', 'new-password', 'Mật khẩu mới được gửi tới email: lequangkhai.dev@gmail.com', 'pU6Y7LqcM0', '18/09/2023 - 19:56:48'),
(7, 'nguyenthienphu@gmail.com', 'reset-password', 'Đặt lại mật khẩu qua email: nguyenthienphu@gmail.com', 'fp928446', '18/09/2023 - 20:00:11'),
(8, 'nguyenthienphu@gmail.com', 'new-password', 'Mật khẩu mới được gửi tới email: nguyenthienphu@gmail.com', 'CsmTb9lpM6', '18/09/2023 - 20:00:29'),
(10, 'lequan@gmai.com', 'register', 'Đăng ký tài khoản bằng email: lequan@gmai.com', 'fp723855', '18/09/2023 - 20:32:12'),
(11, 'lequangngyeie9e@gmailc.om', 'register', 'Đăng ký tài khoản bằng email: lequangngyeie9e@gmailc.om', 'fp194542', '18/09/2023 - 20:40:14'),
(12, 'yirili8496@namewok.com', 'register', 'Đăng ký tài khoản bằng email: yirili8496@namewok.com', 'fp975917', '28/01/2024 - 14:39:18'),
(13, 'xho54208@ilebi.com', 'register', 'Đăng ký tài khoản bằng email: xho54208@ilebi.com', 'fp810811', '04/05/2024 - 14:37:22'),
(14, 'lelee2k6@gmail.com', 'register', 'Đăng ký tài khoản bằng email: lelee2k6@gmail.com', 'fp230278', '04/05/2024 - 14:47:12');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int NOT NULL,
  `type` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_vietnamese_ci NOT NULL,
  `detail` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `notifies` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'on',
  `captcha` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'off',
  `status` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'on'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `type`, `detail`, `notifies`, `captcha`, `status`) VALUES
(1, 'SETTING', '{\"title\":\"DEMO SHOP GAME\",\"description\":\"Shop Game Free Fire\",\"keyword\":\"free fire, shop game, shop free fire\",\"cash_reg\":\"5000\",\"sale_card\":\"\",\"fanpage\":\"Shop-Thanh-H\\u01b0ng-Gaming-101466702687859\",\"notify\":\"https:\\/\\/upanh.cf\\/aklc56k5pd.png\",\"partner_id\":\"9122550161\",\"partner_key\":\"061c720dc499139206fc7a247f65731e\",\"apikey_captcha\":\"6LfCQvUhAAAAAI7Mzrh8g7VkrSxASau5DeqUEovs\",\"app_id\":\"x\",\"app_secret\":\"x\",\"logo\":\"\\/assets\\/upload\\/shop\\/d4403133e07b5da0a35501221a295e9f.png\",\"thumb\":\"\\/assets\\/upload\\/shop\\/b8ee37e8cf2b24dc9ced5262babf5993.gif\",\"background\":\"https:\\/\\/quanlyshop.vip\\/upload\\/doanhmuc\\/1662493129520197.png\"}', 'on', 'on', 'on');

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE `tags` (
  `id` int UNSIGNED NOT NULL,
  `title` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `webinar_id` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `tags`
--

INSERT INTO `tags` (`id`, `title`, `webinar_id`) VALUES
(6253, 'Virtual Team', 1999),
(6254, 'Team', 1999),
(6355, 'web', 2005),
(6356, 'design', 2005),
(6357, 'web design', 2005),
(6364, 'travel', 2006),
(6365, 'trip', 2006),
(6366, 'World Trip', 2006),
(6373, 'Product Manager', 1995),
(6374, 'managment', 1995),
(6384, 'travel', 2007),
(6385, 'Travel Management', 2007),
(6386, 'trip', 2007),
(6393, 'Excel', 1998),
(6394, 'microsoft excel', 1998),
(6395, 'excel class', 1998),
(6396, 'Listening', 2003),
(6397, 'Listen', 2003),
(6398, 'Listener', 2003),
(6399, 'Angular', 2001),
(6400, 'AngularJS', 2001),
(6401, 'Javascript', 2001),
(6402, 'linux', 1996),
(6403, 'os', 1996),
(6404, 'network', 1996),
(6408, 'fitness', 2002),
(6409, 'Health & Fitness', 2002),
(6410, 'Health', 2002),
(6411, 'Time', 2000),
(6412, 'Time Management', 2000),
(6413, 'Save Time', 2000);

-- --------------------------------------------------------

--
-- Table structure for table `text_lessons`
--

CREATE TABLE `text_lessons` (
  `id` int UNSIGNED NOT NULL,
  `creator_id` int UNSIGNED NOT NULL,
  `webinar_id` int UNSIGNED NOT NULL,
  `chapter_id` int DEFAULT '0',
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `study_time` int UNSIGNED DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `accessibility` enum('free','paid') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'free',
  `order` int UNSIGNED DEFAULT NULL,
  `created_at` int UNSIGNED NOT NULL,
  `updated_at` int UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `text_lessons`
--

INSERT INTO `text_lessons` (`id`, `creator_id`, `webinar_id`, `chapter_id`, `title`, `image`, `study_time`, `description`, `content`, `accessibility`, `order`, `created_at`, `updated_at`) VALUES
(13, 934, 1, 3, 'Chương trình Hello World với Python3', '/store/934/hero (9).jpg', 5, 'Học được cách chạy chương trình với câu lệnh Hello World! đầu tiên', '\n            <h4 class=\"font-16 font-weight-bold text-dark\">Hello, World!</h4>\n\n                    <div class=\"pb-5 mt-15 main-image rounded-lg w-100\">\n                                <img src=\"https://miro.medium.com/v2/resize:fit:638/1*iND_uCSZM-UMdl5v5XxijA.png\" class=\"img-cover bg-gray200\" alt=\"Hello, World!\">\n                            </div>\n\n                    <div>Python is a very simple language, and has a very straightforward syntax. It encourages programmers to program without boilerplate (prepared) code. The simplest directive in Python is the \"print\" directive - it simply prints out a line (and also includes a newline, unlike in C).</div><div><br></div><div>There are two major Python versions, Python 2 and Python 3. Python 2 and 3 are quite different. This tutorial uses Python 3, because it more semantically correct and supports newer features.</div><div><br></div><div>For example, one difference between Python 2 and 3 is the print statement. In Python 2, the \"print\" statement is not a function, and therefore it is invoked without parentheses. However, in Python 3, it is a function, and must be invoked with parentheses.</div>\n               ', 'free', 1, 1624954655, 1624956965),
(14, 934, 1, 3, 'Biến & Lệnh gán', '/store/934/hero (14).jpg', 10, 'Học cách khai báo biến & đặt tên đúng quy cách, các lỗi thường gặp ...', '<p>\n<img src=\"https://cdn.educba.com/academy/wp-content/uploads/2023/06/Python-Variables-1.jpg\" />\n</p>', 'free', 2, 1624954929, NULL),
(15, 934, 1, 3, 'Câu lệnh vào ra', '/store/934/hero (4).jpg', 20, 'Câu lệnh input/output trong python', '<p>If you want to know whether a particular application, or a library with particular functionality, is available in Python there are a number of possible sources of information. The Python web site provides a Python Package Index (also known as the Cheese Shop, a reference to the Monty Python script of that name). There is also a search page for a number of sources of Python-related information. Failing that, just Google for a phrase including the word \'\'python\'\' and you may well get the result you need. If all else fails, ask on the python newsgroup and there\'s a good chance someone will put you on the right track.</p><p>Python is an interpreted high-level general-purpose programming language. Python\'s design philosophy emphasizes code readability with its notable use of significant indentation. Its language constructs as well as its object-oriented approach aim to help programmers write clear, logical code for small and large-scale projects.[30]</p><p><br></p><p>Python is dynamically-typed and garbage-collected. It supports multiple programming paradigms, including structured (particularly, procedural), object-oriented and functional programming. Python is often described as a \"batteries included\" language due to its comprehensive standard library.[31]</p><p><br></p><p>Guido van Rossum began working on Python in the late 1980s, as a successor to the ABC programming language, and first released it in 1991 as Python 0.9.0.[32] Python 2.0 was released in 2000 and introduced new features, such as list comprehensions and a garbage collection system using reference counting. Python 3.0 was released in 2008 and was a major revision of the language that is not completely backward-compatible and much Python 2 code does not run unmodified on Python 3. Python 2 was discontinued with version 2.7.18 in 2020.[33]</p><p><br></p><p>Python consistently ranks as one of the most popular programming languages.</p>', 'free', 3, 1624956733, 1624956813),
(16, 934, 1, 3, 'Vòng lặp while, for', '/store/934/hero (4).jpg', 20, 'Học được cách sử dụng câu lệnh vòng lặp for/ while trong Python và bài tập ứng dụng', '<p>If you want to know whether a particular application, or a library with particular functionality, is available in Python there are a number of possible sources of information. The Python web site provides a Python Package Index (also known as the Cheese Shop, a reference to the Monty Python script of that name). There is also a search page for a number of sources of Python-related information. Failing that, just Google for a phrase including the word \'\'python\'\' and you may well get the result you need. If all else fails, ask on the python newsgroup and there\'s a good chance someone will put you on the right track.</p><p>Python is an interpreted high-level general-purpose programming language. Python\'s design philosophy emphasizes code readability with its notable use of significant indentation. Its language constructs as well as its object-oriented approach aim to help programmers write clear, logical code for small and large-scale projects.[30]</p><p><br></p><p>Python is dynamically-typed and garbage-collected. It supports multiple programming paradigms, including structured (particularly, procedural), object-oriented and functional programming. Python is often described as a \"batteries included\" language due to its comprehensive standard library.[31]</p><p><br></p><p>Guido van Rossum began working on Python in the late 1980s, as a successor to the ABC programming language, and first released it in 1991 as Python 0.9.0.[32] Python 2.0 was released in 2000 and introduced new features, such as list comprehensions and a garbage collection system using reference counting. Python 3.0 was released in 2008 and was a major revision of the language that is not completely backward-compatible and much Python 2 code does not run unmodified on Python 3. Python 2 was discontinued with version 2.7.18 in 2020.[33]</p><p><br></p><p>Python consistently ranks as one of the most popular programming languages.</p>', 'free', 3, 1624956733, 1624956813);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `email` varchar(999) DEFAULT NULL,
  `name` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_vietnamese_ci NOT NULL,
  `username` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_vietnamese_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_vietnamese_ci NOT NULL,
  `mobile` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `google_id` varchar(255) DEFAULT NULL,
  `facebook_id` varchar(255) DEFAULT NULL,
  `zalo_id` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `avatar` varchar(999) DEFAULT 'https://i.imgur.com/b0VF3PJ.png',
  `border` varchar(999) NOT NULL DEFAULT 'https://i.imgur.com/0aDdQyR.png',
  `coins` int NOT NULL DEFAULT '0',
  `accumulation` int NOT NULL DEFAULT '0',
  `level` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_vietnamese_ci NOT NULL DEFAULT 'member',
  `status` int NOT NULL DEFAULT '0',
  `bio` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci,
  `address` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_vietnamese_ci NOT NULL,
  `stars` int NOT NULL DEFAULT '0',
  `verified` tinyint(1) NOT NULL DEFAULT '0',
  `token` varchar(99) DEFAULT NULL,
  `ip_addr` varchar(99) DEFAULT NULL,
  `registration_type` enum('local','google','facebook','zalo') CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'local'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `name`, `username`, `password`, `mobile`, `google_id`, `facebook_id`, `zalo_id`, `avatar`, `border`, `coins`, `accumulation`, `level`, `status`, `bio`, `address`, `stars`, `verified`, `token`, `ip_addr`, `registration_type`) VALUES
(1, 'lequangkhai.dev@gmail.com', 'ADMIN', 'lewankhai', '08bdd00e4a7ffe666ccf92f948055c4c', '0387290231', NULL, NULL, NULL, 'https://i.imgur.com/b0VF3PJ.png', 'https://i.imgur.com/0aDdQyR.png', 0, 0, 'admin', 0, 'Admin', 'Đăk Nông - Việt Nam', 5, 1, 'rYfRxyMeoUg8yZHqYZJJq1at8CbD186hIShDCirHHd7v0EjFoL', '::1', 'local'),
(2, 'taquochung@gmail.com', 'Tạ Quốc Hùng', 'taquochung', 'd159310f36eb4af64a5fd4ddced658c7', '0', NULL, NULL, NULL, 'https://i.imgur.com/szPJ6lq.jpg', 'https://i.imgur.com/0aDdQyR.png', 99809999, 0, 'instructor', 0, 'Giáo viên tin học', 'Đăk Nông - Việt Nam', 4, 0, NULL, '192.168.1.7', 'local'),
(3, 'nguyenthienphu@gmail.com', 'Nguyễn Thiên Phú', 'nguyenthienphu', 'bc14d50dd1b205c067e70ece8eec4b0a', '0', NULL, NULL, NULL, 'https://i.imgur.com/PnWx9Sz.jpg', 'https://i.imgur.com/cuaCwYj.png', 99809999, 0, 'instructor', 0, 'Giáo viên lịch sử', 'Đăk Nông - Việt Nam', 4, 0, NULL, NULL, 'local'),
(4, 'ltmylinh@gmail.com', 'Lê Thị Mỹ Linh', 'lethimylinh', '9536686afad9da668b62647f2aeaf73b49bb32f9a9fe74485731469b6ee38eb1', '0', NULL, NULL, NULL, 'https://i.imgur.com/ylzP35E.jpg', 'https://i.imgur.com/3V3dSIU.png', 99809999, 0, 'instructor', 0, 'Giáo viên tin học', 'Đăk Nông - Việt Nam', 3, 0, NULL, NULL, 'local'),
(5, 'httham@gmail.com', 'Hoàng Thị Thắm', 'hoangthitham', '9536686afad9da668b62647f2aeaf73b49bb32f9a9fe74485731469b6ee38eb1', '0', NULL, NULL, NULL, 'https://i.imgur.com/GWrufYw.jpg', 'https://i.imgur.com/le8HXCC.png', 99809999, 0, 'instructor', 0, 'Giáo viên Anh văn', 'Đăk Nông - Việt Nam', 5, 0, NULL, NULL, 'local'),
(11, 'dothiloan111974@gmail.com', 'Đỗ Thị Loan', 'thloan406', 'b68ab1ad12d6a0bb55a06e8a203e56ac', '0359731848', NULL, NULL, NULL, 'https://i.imgur.com/b0VF3PJ.png', 'https://i.imgur.com/0aDdQyR.png', 0, 0, 'member', 0, NULL, 'Đăk Nông - Việt Nam', 0, 1, 'MgZ16JrbXFT2qB3EMms1WSMihVbm1ULSho6I6Cnc9BTm65hmgM', '::1', 'local'),
(12, 'leminhphuc172@gmail.com', 'Lê Minh Phúc', 'lminhphc865', '313e4ac6415fd333d832f3a51153c2d4', '0374842702', NULL, NULL, NULL, 'https://i.imgur.com/b0VF3PJ.png', 'https://i.imgur.com/0aDdQyR.png', 0, 0, 'member', 0, NULL, 'Đăk Nông - Việt Nam', 0, 1, 'imoiRzm5i9AjSmnG9F0LKmf28lUC28cyA7YP0tmOOC4D6nOBkv', '::1', 'local'),
(13, 'taoprolamnha@gmail.com', 'ZendVN', 'lvnbn7788', '7a868cbfe6b9307d339bbd0fa5447960', '0944179322', NULL, NULL, NULL, 'https://yt3.googleusercontent.com/ytc/AIdro_mv93HtOdYQHuWkwgnpt4PNw1kTWBXS2l4gyXxzYx96Cw=s160-c-k-c0x00ffffff-no-rj', 'https://i.imgur.com/0aDdQyR.png', 20000, 20000, 'member', 0, NULL, 'Không rõ', 4, 1, 'cHhQz1DIW0KmCLV6wWlIUbZcUiGZa8ffocAIMfQTqFyUqQZvE7', '192.168.1.7', 'local'),
(27, 'lequangkhai.dev@gmail.com', 'Lê Quang Khải', 'l-quang-kh-i7086', '0266e33d3f546cb5436a10798e657d97', NULL, '115292141256719766504', NULL, NULL, 'https://yt3.ggpht.com/xoDLQ_PpqiBIfbHYd0Z9iyeAdFHw0RUF9ck92_Gdl1_C946G1L5rEbISZLqdLr7UqtLHCCRf=s108-c-k-c0x00ffffff-no-rj', 'https://i.imgur.com/0aDdQyR.png', 0, 0, 'member', 0, NULL, 'Không rõ', 0, 1, 'XV8heCKdhfuYBvADVRZi1LFoWPDmtQPwVUZ6TFlWZAhtKsY977', '::1', 'google'),
(28, 'leminhphuc172@gmail.com', 'Minh Phuc Le', 'minh-phuc-le6696', 'd14220ee66aeec73c49038385428ec4c', NULL, '101320735742166193812', NULL, NULL, 'https://lh3.googleusercontent.com/a/ACg8ocIokdsVTm8XhepIL-C_ZGxpsMdMZSUOaryLY4MwsEAlbfOvk9-f=s96-c', 'https://i.imgur.com/0aDdQyR.png', 0, 0, 'member', 0, NULL, 'Không rõ', 0, 1, 'mg5vYQeLAcmhyjbe1ykA9esFyczKZPBAWi2n8xk0L6JTMyabkE', '::1', 'google'),
(29, 'khaidev.com@gmail.com', 'QUANG KHAI LE', 'quang-khai-le9650', '705f2172834666788607efbfca35afb3', NULL, '106147087279158489583', NULL, NULL, 'https://yt3.ggpht.com/xoDLQ_PpqiBIfbHYd0Z9iyeAdFHw0RUF9ck92_Gdl1_C946G1L5rEbISZLqdLr7UqtLHCCRf=s108-c-k-c0x00ffffff-no-rj', 'https://i.imgur.com/0aDdQyR.png', 10000, 10000, 'member', 0, NULL, 'Không rõ', 0, 1, 'vf6GPdMyHj2XHx5ualENdJqZzxYTWmaJi5bYLmteXwpy3JIHzs', '::1', 'google'),
(30, 'lequangnguyen1221@gmail.com', 'KHAI LE QUANG', 'khai-le-quang8893', '6081594975a764c8e3a691fa2b3a321d', NULL, '101627640638781966694', NULL, NULL, 'https://lh3.googleusercontent.com/a/ACg8ocKX0F8-fU0r5nCQ1HIWSYSB28WThx10zZUoKeKJR5nEgstZT-mi=s96-c', 'https://i.imgur.com/0aDdQyR.png', 30000, 30000, 'member', 0, NULL, 'Không rõ', 0, 1, 'DcadMJ1OusqGwN5h8oE9E0uEO5EfKDSPP1IODAChuaQPSDrjIG', '::1', 'google'),
(31, 'minhphucle172@gmail.com', 'Minh Phúc Lê', 'minh-ph-c-l-6613', '362e80d4df43b03ae6d3f8540cd63626', NULL, '102079304912228253864', NULL, NULL, 'https://lh3.googleusercontent.com/a/ACg8ocJP_wnaKpfQDiskiq1CBVX5SFc_Hb9A0zijJ13PRiCVTR3Z=s96-c', 'https://i.imgur.com/0aDdQyR.png', 0, 0, 'member', 0, NULL, 'Không rõ', 0, 1, 'I4mHvD7mON9wwwGT9CrF4RqK9LiBwsL1eB6abCD2ljKyL7xZ1K', '::1', 'google');

-- --------------------------------------------------------

--
-- Table structure for table `user_passed_lesson`
--

CREATE TABLE `user_passed_lesson` (
  `id` int NOT NULL,
  `email` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `webinar_id` int NOT NULL,
  `webinar_type` varchar(99) COLLATE utf8mb3_unicode_ci NOT NULL,
  `chapter_id` int NOT NULL,
  `text_lesson_id` int NOT NULL,
  `file_id` int NOT NULL,
  `created_time` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `user_passed_lesson`
--

INSERT INTO `user_passed_lesson` (`id`, `email`, `webinar_id`, `webinar_type`, `chapter_id`, `text_lesson_id`, `file_id`, `created_time`) VALUES
(1, 'lequangnguyen1221@gmail.com', 2010, 'file_id', 1, 0, 32, '1716125827');

-- --------------------------------------------------------

--
-- Table structure for table `webinars`
--

CREATE TABLE `webinars` (
  `id` int UNSIGNED NOT NULL,
  `teacher_id` int UNSIGNED NOT NULL,
  `category_id` int UNSIGNED DEFAULT NULL,
  `type` enum('webinar','course','text_lesson') COLLATE utf8mb4_unicode_ci NOT NULL,
  `private` tinyint(1) NOT NULL DEFAULT '0',
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `duration` int UNSIGNED DEFAULT NULL,
  `seo_description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `thumbnail` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image_cover` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `video_demo` varchar(999) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `capacity` int UNSIGNED DEFAULT NULL,
  `price` int UNSIGNED DEFAULT NULL,
  `discount` int NOT NULL DEFAULT '0',
  `description` text COLLATE utf8mb4_unicode_ci,
  `support` tinyint(1) DEFAULT '0',
  `downloadable` tinyint(1) DEFAULT '0',
  `partner_instructor` tinyint(1) DEFAULT '0',
  `subscribe` tinyint(1) DEFAULT '0',
  `message_for_reviewer` text COLLATE utf8mb4_unicode_ci,
  `status` enum('active','pending','is_draft','inactive') COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_order` int NOT NULL,
  `created_at` int NOT NULL,
  `updated_at` int DEFAULT NULL,
  `deleted_at` int DEFAULT NULL,
  `stars` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `webinars`
--

INSERT INTO `webinars` (`id`, `teacher_id`, `category_id`, `type`, `private`, `title`, `slug`, `duration`, `seo_description`, `thumbnail`, `image_cover`, `video_demo`, `capacity`, `price`, `discount`, `description`, `support`, `downloadable`, `partner_instructor`, `subscribe`, `message_for_reviewer`, `status`, `user_order`, `created_at`, `updated_at`, `deleted_at`, `stars`) VALUES
(1, 2, 606, 'text_lesson', 0, 'Học Lập Trình Python Cơ Bản Đến Nâng Cao', 'Learn-Python-Programming', 35, 'Learn Python Programming the Easy Way, Complete with Examples, Quizzes, Exercises and more. Learn Python 2 and Python 3.', 'https://www.freecodecamp.org/news/content/images/2022/02/Banner-10.png', 'https://i.imgur.com/CAziExj.jpg', 'https://cdn-cf-east.streamable.com/video/mp4/xofx55.mp4?Expires=1716212147888&Key-Pair-Id=APKAIEYUVEN4EVB2OKEQ&Signature=KqdPaQDCKN7Ipp53qCJOJJ-jWgCrOnTJGyD6B8NormW0kzOD22vlUNWUxemOERTBPf~wAJtWvsT7CB1uJIxpIkPGB~oyFr7Bm7imsF93B8qb-skO3ek2GghGNhTCM~V-XlL-Tj5grn5~ssCTrGeQ8Ytt3HLdX3lviNvrls5xlRBaUM2K1SLKUXHUOWsCII9CB1kIkFtQt6KhCRwEhLxrRIETjOeZ3--lzYl2btXEzqpepDSIkBbSnRXge2srVP3i3AXAJttEP-a9iuwUzVrM~X-3xgSMLlevagxVQpJIVNI6SXtLrta926y-rGNB16AHaLTy2a7~R1VfIt~oeqdUrg__', NULL, 5000000, 50, 'Khóa học lập trình Python nâng cao là một khóa học thú vị và hấp dẫn, nhằm giúp bạn nắm vững và ứng dụng thành thạo các khái niệm và kỹ thuật lập trình Python trong các dự án phức tạp. Trong khóa học này, bạn sẽ khám phá sâu hơn về các chủ đề như lập trình hướng đối tượng, xử lý ngoại lệ, đa luồng, module và gói, và cấu trúc dữ liệu phổ biến như danh sách, bộ từ điển và bộ tự hình. Bạn sẽ được thực hành thông qua các bài tập thực tế và dự án thực tế, giúp bạn phát triển kỹ năng giải quyết vấn đề và xây dựng ứng dụng Python mạnh mẽ và linh hoạt hơn. Với khóa học này, bạn sẽ trở thành một lập trình viên Python nâng cao, sẵn sàng thách thức những dự án phức tạp và đóng góp vào thế giới phát triển phần mềm.', 1, 0, 0, 0, 'thank you .', 'active', 115, 1624954285, 1625949854, NULL, 4),
(2010, 13, 606, 'text_lesson', 0, 'Phân tích và thiết kế cơ sở dữ liệu', 'phan-tich-va-thiet-ke-co-so-du-lieu', 35, 'Database, SQL, Cơ Sở Dữ Liệu, Miễn Phí', 'https://i.imgur.com/9bW9yJe.png', 'https://i.imgur.com/IbtXAZp.jpeg', 'https://cdn-cf-east.streamable.com/video/mp4/1bprxm.mp4?Expires=1716357011928&Key-Pair-Id=APKAIEYUVEN4EVB2OKEQ&Signature=ZHQ1OXB-ikkN1AmsVoWzdqzDGdlSX92K3eUIvIUe--wYzem7ta8hZb-S7XByzjC7WgqwfkMUsbkzyzbGFWPKJNWUSP6aAfl8ENu-njJ2lanWSnYSnNMA5F7a6eFta0clN5Bq86BBpTGZSTTySz98eoswKDSN6eK7GLX8pj7B2FRzitziG0SF4PjenHNLQ2wxx4XpOtNflFMpOj0-OA5AbK0fOoDasiOQVhFPELfdTXrqpmvxma8D8yZSIMmf4f7c2yndQWFc9HNrd7Y3CEcxLIVtaJ7Zp~ey21F4R2OaffA9TdYFLXsDQBRz~c3~AaNvWfu5CIfOT7AbfnIoXFmPfw__', NULL, 0, 0, '\n  <h1>Khóa học Phân tích và thiết kế cơ sở dữ liệu</h1>\n  \n  <h2>Giới thiệu khóa học</h2>\n  <p>\n    Khóa học Phân tích và thiết kế cơ sở dữ liệu là một khóa học cung cấp kiến thức cơ bản và nâng cao về việc phân tích, thiết kế và quản lý cơ sở dữ liệu trong các dự án phần mềm.\n  </p>\n\n  <h2>Nội dung khóa học</h2>\n  <p>\n    Trong khóa học này, bạn sẽ được học về:\n  </p>\n  <ul>\n    <li>Khái niệm cơ bản về cơ sở dữ liệu</li>\n    <li>Phân tích yêu cầu cơ sở dữ liệu</li>\n    <li>Mô hình hóa dữ liệu</li>\n    <li>Thiết kế cơ sở dữ liệu quan hệ</li>\n    <li>Ngôn ngữ truy vấn cơ sở dữ liệu SQL</li>\n    <li>Bảo mật và quản lý cơ sở dữ liệu</li>\n  </ul>\n\n  <h2>Đối tượng học</h2>\n  <p>\n    Khóa học Phân tích và thiết kế cơ sở dữ liệu dành cho:\n  </p>\n  <ul>\n    <li>Sinh viên ngành Công nghệ thông tin</li>\n    <li>Lập trình viên muốn nâng cao kỹ năng về cơ sở dữ liệu</li>\n    <li>Các nhà phát triển phần mềm</li>\n  </ul>\n\n  <h2>Yêu cầu tiên quyết</h2>\n  <p>\n    Để tham gia khóa học này, bạn cần có kiến thức cơ bản về lập trình và cơ sở dữ liệu.\n  </p>\n\n  <h2>Thời lượng khóa học</h2>\n  <p>\n    Khóa học này kéo dài trong 10 tuần với tổng cộng 30 giờ học.\n  </p>\n\n  <h2>Đăng ký</h2>\n  <p>\n    Để đăng ký tham gia khóa học Phân tích và thiết kế cơ sở dữ liệu, vui lòng liên hệ với chúng tôi qua số điện thoại hoặc email sau:\n  </p>\n  <ul>\n    <li>Số điện thoại: 0123456789</li>\n    <li>Email: example@example.com</li>\n  </ul>', 1, 0, 0, 0, 'thank you .', 'active', 0, 1624954285, 1625949854, NULL, 4),
(2011, 1, 613, 'text_lesson', 0, 'TỔNG HỢP BÀI KIỂM TRA', 'tong-hop-kiem-tra', 35, 'TỔNG HỢP KIỂM TRA TRẮC NGHIỆM', 'https://i.imgur.com/CGIH7ll.png', 'https://i.imgur.com/Uv9N0Cz.png', 'https://cdn-cf-east.streamable.com/video/mp4/1bprxm.mp4?Expires=1716357011928&Key-Pair-Id=APKAIEYUVEN4EVB2OKEQ&Signature=ZHQ1OXB-ikkN1AmsVoWzdqzDGdlSX92K3eUIvIUe--wYzem7ta8hZb-S7XByzjC7WgqwfkMUsbkzyzbGFWPKJNWUSP6aAfl8ENu-njJ2lanWSnYSnNMA5F7a6eFta0clN5Bq86BBpTGZSTTySz98eoswKDSN6eK7GLX8pj7B2FRzitziG0SF4PjenHNLQ2wxx4XpOtNflFMpOj0-OA5AbK0fOoDasiOQVhFPELfdTXrqpmvxma8D8yZSIMmf4f7c2yndQWFc9HNrd7Y3CEcxLIVtaJ7Zp~ey21F4R2OaffA9TdYFLXsDQBRz~c3~AaNvWfu5CIfOT7AbfnIoXFmPfw__', NULL, 0, 0, '<h1>TỔNG HỢP TRẮC NGHIỆM ONLINE</h1>', 1, 0, 0, 0, 'thank you .', 'active', 0, 1624954285, 1625949854, NULL, 4);

-- --------------------------------------------------------

--
-- Table structure for table `webinar_reviews`
--

CREATE TABLE `webinar_reviews` (
  `id` int UNSIGNED NOT NULL,
  `webinar_id` int UNSIGNED NOT NULL,
  `user_id` int UNSIGNED NOT NULL,
  `user_type` enum('show','hide') COLLATE utf8mb4_unicode_ci NOT NULL,
  `rates` char(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `liked` int NOT NULL,
  `created_at` int UNSIGNED NOT NULL,
  `status` enum('pending','active') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `webinar_reviews`
--

INSERT INTO `webinar_reviews` (`id`, `webinar_id`, `user_id`, `user_type`, `rates`, `description`, `liked`, `created_at`, `status`) VALUES
(1, 1, 30, 'show', '5', 'OKE', 0, 1715948146, 'active'),
(2, 1, 30, 'hide', '5', 'OKE', 0, 1715948148, 'active'),
(3, 1, 30, 'hide', '5', 'OKE', 0, 1715948161, 'active'),
(4, 1, 30, 'show', '1', 'như cac', 0, 1715948685, 'active'),
(5, 1, 30, 'show', '1', '343442343', 0, 1715952057, 'pending'),
(6, 2010, 30, 'show', '5', 'Khoá học rất hay!', 0, 1715999783, 'active'),
(7, 2010, 30, 'hide', '5', 'Khoá học tuyệt vời!', 0, 1716100274, 'active'),
(9, 2011, 30, 'hide', '5', 'Cam on', 0, 1716133410, 'active');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `become_instructors`
--
ALTER TABLE `become_instructors`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `become_instructors_user_id_foreign` (`user_id`) USING BTREE;

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `parent_id` (`parent_id`) USING BTREE;

--
-- Indexes for table `chapter_content`
--
ALTER TABLE `chapter_content`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `faqs`
--
ALTER TABLE `faqs`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `faqs_webinar_id_foreign` (`webinar_id`) USING BTREE,
  ADD KEY `faqs_creator_id_foreign` (`creator_id`) USING BTREE;

--
-- Indexes for table `favourite_courses`
--
ALTER TABLE `favourite_courses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `files`
--
ALTER TABLE `files`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `files_webinar_id_foreign` (`webinar_id`) USING BTREE,
  ADD KEY `files_creator_id_foreign` (`creator_id`) USING BTREE;

--
-- Indexes for table `history_recharge`
--
ALTER TABLE `history_recharge`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `login_records`
--
ALTER TABLE `login_records`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `orders_user_id_foreign` (`user_id`) USING BTREE;

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `order_items_user_id_foreign` (`user_id`) USING BTREE,
  ADD KEY `order_items_order_id_foreign` (`order_id`) USING BTREE,
  ADD KEY `order_items_webinar_id_foreign` (`webinar_id`) USING BTREE,
  ADD KEY `order_items_ticket_id_foreign` (`trans_id`) USING BTREE;

--
-- Indexes for table `quizzes`
--
ALTER TABLE `quizzes`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `quizzes_webinar_id_foreign` (`webinar_id`) USING BTREE,
  ADD KEY `quizzes_creator_id_foreign` (`creator_id`) USING BTREE;

--
-- Indexes for table `quizzes_questions`
--
ALTER TABLE `quizzes_questions`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `quizzes_questions_quiz_id_foreign` (`quiz_id`) USING BTREE,
  ADD KEY `quizzes_questions_creator_id_foreign` (`creator_id`) USING BTREE;

--
-- Indexes for table `quizzes_questions_answers`
--
ALTER TABLE `quizzes_questions_answers`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `quizzes_questions_answers_question_id_foreign` (`question_id`) USING BTREE,
  ADD KEY `quizzes_questions_answers_creator_id_foreign` (`creator_id`) USING BTREE;

--
-- Indexes for table `quizzes_results`
--
ALTER TABLE `quizzes_results`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `quizzes_results_quiz_id_foreign` (`quiz_id`) USING BTREE,
  ADD KEY `quizzes_results_user_id_foreign` (`user_id`) USING BTREE;

--
-- Indexes for table `send_email`
--
ALTER TABLE `send_email`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `tags_webinar_id_foreign` (`webinar_id`) USING BTREE;

--
-- Indexes for table `text_lessons`
--
ALTER TABLE `text_lessons`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `text_lessons_creator_id_foreign` (`creator_id`) USING BTREE,
  ADD KEY `text_lessons_webinar_id_foreign` (`webinar_id`) USING BTREE;

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_passed_lesson`
--
ALTER TABLE `user_passed_lesson`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `webinars`
--
ALTER TABLE `webinars`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD UNIQUE KEY `webinars_slug_unique` (`slug`) USING BTREE,
  ADD KEY `webinars_teacher_id_foreign` (`teacher_id`) USING BTREE,
  ADD KEY `webinars_category_id_foreign` (`category_id`) USING BTREE,
  ADD KEY `webinars_slug_index` (`slug`) USING BTREE;

--
-- Indexes for table `webinar_reviews`
--
ALTER TABLE `webinar_reviews`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `webinar_reviews_webinar_id_foreign` (`webinar_id`) USING BTREE,
  ADD KEY `webinar_reviews_creator_id_foreign` (`user_id`) USING BTREE;

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `become_instructors`
--
ALTER TABLE `become_instructors`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=614;

--
-- AUTO_INCREMENT for table `chapter_content`
--
ALTER TABLE `chapter_content`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `faqs`
--
ALTER TABLE `faqs`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `favourite_courses`
--
ALTER TABLE `favourite_courses`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `files`
--
ALTER TABLE `files`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `history_recharge`
--
ALTER TABLE `history_recharge`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `login_records`
--
ALTER TABLE `login_records`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `quizzes`
--
ALTER TABLE `quizzes`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `quizzes_questions`
--
ALTER TABLE `quizzes_questions`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;

--
-- AUTO_INCREMENT for table `quizzes_questions_answers`
--
ALTER TABLE `quizzes_questions_answers`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=233;

--
-- AUTO_INCREMENT for table `quizzes_results`
--
ALTER TABLE `quizzes_results`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `send_email`
--
ALTER TABLE `send_email`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tags`
--
ALTER TABLE `tags`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6414;

--
-- AUTO_INCREMENT for table `text_lessons`
--
ALTER TABLE `text_lessons`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `user_passed_lesson`
--
ALTER TABLE `user_passed_lesson`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `webinars`
--
ALTER TABLE `webinars`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2012;

--
-- AUTO_INCREMENT for table `webinar_reviews`
--
ALTER TABLE `webinar_reviews`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
