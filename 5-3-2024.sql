-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 03, 2024 at 09:44 AM
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
(608, 528, 'Web Development', 'Web-Development', NULL, 3);

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
(3, 1, 'Learn-Python-Programming', '1713080213');

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
  `file_type` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
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
(32, 1016, 2010, 1, 'Phân tích và thiết kế cơ sở dữ liệu - Buổi 1', 'free', 0, 'online', 'https://youtu.be/UBQbreSjEdc', '46.00 MB', 'video', 'Khóa học database', 3, 1624870086, 1624870190, NULL),
(60, 1016, 2010, 1, 'Phân tích và thiết kế cơ sở dữ liệu - Buổi 2', 'free', 0, 'local', 'http://commondatastorage.googleapis.com/gtv-videos-bucket/sample/BigBuckBunny.mp4', '46.00 MB', 'video', 'Khóa học database phần 2', 3, 1624870086, 1624870190, NULL);

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
(4, 'Nạp Thẻ Cào', 'taoprolamnha@gmail.com', 'VIETTEL', '13238683431653', '231346538606831', '300000', NULL, '192.168.1.6201161', 382903, 0, 0, 1688113699);

-- --------------------------------------------------------

--
-- Table structure for table `login_records`
--

CREATE TABLE `login_records` (
  `id` int NOT NULL,
  `user_email` varchar(30) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `user_id` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `device_id` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `login_time` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `login_records`
--

INSERT INTO `login_records` (`id`, `user_email`, `user_id`, `device_id`, `login_time`) VALUES
(1, 'taoprolamnha@gmail.com', NULL, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36 Edg/114.0.1823.43', 1687323326),
(2, 'taoprolamnha@gmail.com', NULL, 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Mobile Safari/537.36', 1687323341),
(3, 'taoprolamnha@gmail.com', NULL, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36 Edg/114.0.1823.43', 1687447898),
(4, 'taoprolamnha@gmail.com', NULL, 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Mobile Safari/537.36', 1687451102),
(5, 'lequangkhai.dev@gmail.com', NULL, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36 Edg/114.0.1823.58', 1687682110),
(6, 'taoprolamnha@gmail.com', NULL, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36 Edg/114.0.1823.58', 1688052903),
(7, 'taoprolamnha@gmail.com', NULL, 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Mobile Safari/537.36', 1688056712),
(8, 'lequangkhai.dev@gmail.com', NULL, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36 Edg/114.0.1823.58', 1691566327),
(9, 'lequangkhai.dev@gmail.com', NULL, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36 Edg/114.0.1823.58', 1691569496),
(10, 'taoprolamnha@gmail.com', NULL, 'Mozilla/5.0 (Linux; Android 6.0; Nexus 5 Build/MRA58N) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Mobile Safari/537.36 Edg/114.0.1823.58', 1691995189),
(11, 'taquochung@gmail.com', NULL, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36 Edg/114.0.1823.58', 1691995228),
(12, 'taquochung@gmail.com', NULL, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36 Edg/114.0.1823.58', 1691995240),
(13, 'taquochung@gmail.com', NULL, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36 Edg/114.0.1823.58', 1691995698),
(14, 'taquochung@gmail.com', NULL, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36 Edg/114.0.1823.58', 1691996216),
(15, 'lequangkhai.dev@gmail.com', NULL, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36 Edg/114.0.1823.58', 1691996278),
(16, 'lequangkhai.dev@gmail.com', NULL, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36 Edg/114.0.1823.58', 1691996308),
(17, 'lequangkhai.dev@gmail.com', NULL, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/115.0.0.0 Safari/537.36 Edg/115.0.1901.203', 1692715614),
(18, 'lequangkhai.dev@gmail.com', NULL, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/115.0.0.0 Safari/537.36 Edg/115.0.1901.203', 1692716065),
(19, 'lequangkhai.dev@gmail.com', NULL, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/117.0.0.0 Safari/537.36 Edg/117.0.2045.31', 1695040212),
(20, 'lequangkhai.dev@gmail.com', NULL, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/121.0.0.0 Safari/537.36 Edg/121.0.0.0', 1706427993),
(21, 'lequangkhai.dev@gmail.com', NULL, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/122.0.0.0 Safari/537.36 Edg/122.0.0.0', 1709471360),
(22, 'lequangkhai.dev@gmail.com', NULL, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/122.0.0.0 Safari/537.36 Edg/122.0.0.0', 1710079905),
(23, 'lequangkhai.dev@gmail.com', NULL, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/123.0.0.0 Safari/537.36 Edg/123.0.0.0', 1712327644),
(24, 'lequangkhai.dev@gmail.com', NULL, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/123.0.0.0 Safari/537.36 Edg/123.0.0.0', 1713080160),
(25, 'lequangkhai.dev@gmail.com', NULL, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/123.0.0.0 Safari/537.36 Edg/123.0.0.0', 1713278228);

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
(3, 1, 2010, 'success', 'free', 0, 0, 'free6619', NULL, 1692716273),
(4, 19, 1, 'pedding', 'momo', 5000000, 5000000, '98261693557757', 'Thanh toán: Học Lập Trình Python Cơ Bản Đến Nâng Cao', 1693557758),
(5, 19, 1, 'pedding', 'momo', 5000000, 5000000, '38861693557765', 'Thanh toán: Học Lập Trình Python Cơ Bản Đến Nâng Cao', 1693557766),
(6, 19, 1, 'pedding', 'momo', 5000000, 5000000, '44051693557769', 'Thanh toán: Học Lập Trình Python Cơ Bản Đến Nâng Cao', 1693557770),
(7, 19, 1, 'success', 'momo', 5000000, 5000000, '45431693557825', 'Thanh toán: Học Lập Trình Python Cơ Bản Đến Nâng Cao', 1693557825),
(8, 19, 2010, 'success', 'free', 0, 0, 'free9215', NULL, 1694442306),
(9, 1, 1, 'pedding', 'vnpay', 5000000, 5000000, '40071706428297', 'Thanh toán: Học Lập Trình Python Cơ Bản Đến Nâng Cao', 1706428297),
(10, 1, 1, 'pedding', 'momo', 5000000, 5000000, '91871706428317', 'Thanh toán: Học Lập Trình Python Cơ Bản Đến Nâng Cao', 1706428317),
(11, 1, 1, 'pedding', 'momo', 5000000, 5000000, '50321710079934', 'Thanh toán: Học Lập Trình Python Cơ Bản Đến Nâng Cao', 1710079935),
(12, 1, 1, 'pedding', 'momo', 5000000, 5000000, '47741710079948', 'Thanh toán: Học Lập Trình Python Cơ Bản Đến Nâng Cao', 1710079949),
(13, 1, 1, 'pedding', 'vnpay', 5000000, 5000000, '90971710079967', 'Thanh toán: Học Lập Trình Python Cơ Bản Đến Nâng Cao', 1710079967),
(14, 1, 1, 'success', 'coins', 5000000, 5000000, '91971712327653', 'Thanh toán: Học Lập Trình Python Cơ Bản Đến Nâng Cao', 1712327653);

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
(3, 1, 3, 2010, 'free6619', 0, 0, 'free', 1692716273),
(4, 19, 7, 1, '45431693557825', 5000000, 5000000, 'momo', 1693557871),
(5, 19, 8, 2010, 'free9215', 0, 0, 'free', 1694442306),
(6, 1, 14, 1, '91971712327653', 5000000, 5000000, 'coins', 1712327653);

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
(12, 'yirili8496@namewok.com', 'register', 'Đăng ký tài khoản bằng email: yirili8496@namewok.com', 'fp975917', '28/01/2024 - 14:39:18');

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
(13, 934, 1, 3, 'Chương trình Hello World với Python3', '/store/934/hero (9).jpg', 5, 'Học được cách chạy chương trình với câu lệnh Hello World! đầu tiên', '\n                <h4 class=\"font-16 font-weight-bold text-dark\">Hello, World!</h4>\n\n                    <div class=\"pb-5 mt-15 main-image rounded-lg w-100\">\n                                <img src=\"https://lms2.rocket-soft.org/store/934/hero (9).jpg\" class=\"img-cover bg-gray200\" alt=\"Hello, World!\">\n                            </div>\n\n                    <div>Python is a very simple language, and has a very straightforward syntax. It encourages programmers to program without boilerplate (prepared) code. The simplest directive in Python is the \"print\" directive - it simply prints out a line (and also includes a newline, unlike in C).</div><div><br></div><div>There are two major Python versions, Python 2 and Python 3. Python 2 and 3 are quite different. This tutorial uses Python 3, because it more semantically correct and supports newer features.</div><div><br></div><div>For example, one difference between Python 2 and 3 is the print statement. In Python 2, the \"print\" statement is not a function, and therefore it is invoked without parentheses. However, in Python 3, it is a function, and must be invoked with parentheses.</div>\n               ', 'free', 1, 1624954655, 1624956965),
(14, 934, 1, 3, 'Biến & Lệnh gán', '/store/934/hero (14).jpg', 10, 'Học cách khai báo biến & đặt tên đúng quy cách, các lỗi thường gặp ...', '<div>There is a list of tutorials suitable for experienced programmers on the BeginnersGuide/Tutorials page. There is also a list of resources in other languages which might be useful if English is not your first language.</div><div><br></div><div>The online documentation is your first port of call for definitive information. There is a fairly brief tutorial that gives you basic information about the language and gets you started. You can follow this by looking at the library reference for a full description of Python\'s many libraries and the language reference for a complete (though somewhat dry) explanation of Python\'s syntax. If you are looking for common Python recipes and patterns, you can browse the ActiveState Python Cookbook</div>', 'free', 2, 1624954929, NULL),
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
  `avatar` varchar(9999) DEFAULT 'https://i.imgur.com/b0VF3PJ.png',
  `border` varchar(999) NOT NULL DEFAULT 'https://i.imgur.com/0aDdQyR.png',
  `coins` int NOT NULL DEFAULT '0',
  `accumulation` int NOT NULL DEFAULT '0',
  `level` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_vietnamese_ci NOT NULL DEFAULT 'member',
  `status` int NOT NULL DEFAULT '0',
  `bio` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci,
  `address` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_vietnamese_ci NOT NULL,
  `stars` int NOT NULL DEFAULT '0',
  `verified` tinyint(1) NOT NULL DEFAULT '0',
  `token` varchar(50) DEFAULT NULL,
  `ip_addr` varchar(30) DEFAULT NULL,
  `registration_type` enum('local','google','facebook','zalo') CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'local'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `name`, `username`, `password`, `mobile`, `google_id`, `facebook_id`, `zalo_id`, `avatar`, `border`, `coins`, `accumulation`, `level`, `status`, `bio`, `address`, `stars`, `verified`, `token`, `ip_addr`, `registration_type`) VALUES
(1, 'lequangkhai.dev@gmail.com', 'LE QUANG KHAI', 'lewankhai', '08bdd00e4a7ffe666ccf92f948055c4c', '0387290231', NULL, NULL, NULL, 'https://i.imgur.com/b0VF3PJ.png', 'https://i.imgur.com/0aDdQyR.png', 0, 0, 'admin', 0, 'Admin', 'Đăk Nông - Việt Nam', 5, 1, 'rYfRxyMeoUg8yZHqYZJJq1at8CbD186hIShDCirHHd7v0EjFoL', '::1', 'local'),
(2, 'taquochung@gmail.com', 'Tạ Quốc Hùng', 'taquochung', 'd159310f36eb4af64a5fd4ddced658c7', '0', NULL, NULL, NULL, 'https://i.imgur.com/szPJ6lq.jpg', 'https://i.imgur.com/0aDdQyR.png', 99809999, 0, 'instructor', 0, 'Giáo viên tin học', 'Đăk Nông - Việt Nam', 4, 0, NULL, '192.168.1.7', 'local'),
(3, 'nguyenthienphu@gmail.com', 'Nguyễn Thiên Phú', 'nguyenthienphu', 'bc14d50dd1b205c067e70ece8eec4b0a', '0', NULL, NULL, NULL, 'https://i.imgur.com/PnWx9Sz.jpg', 'https://i.imgur.com/cuaCwYj.png', 99809999, 0, 'instructor', 0, 'Giáo viên lịch sử', 'Đăk Nông - Việt Nam', 4, 0, NULL, NULL, 'local'),
(4, 'ltmylinh@gmail.com', 'Lê Thị Mỹ Linh', 'lethimylinh', '9536686afad9da668b62647f2aeaf73b49bb32f9a9fe74485731469b6ee38eb1', '0', NULL, NULL, NULL, 'https://i.imgur.com/ylzP35E.jpg', 'https://i.imgur.com/3V3dSIU.png', 99809999, 0, 'instructor', 0, 'Giáo viên tin học', 'Đăk Nông - Việt Nam', 3, 0, NULL, NULL, 'local'),
(5, 'httham@gmail.com', 'Hoàng Thị Thắm', 'hoangthitham', '9536686afad9da668b62647f2aeaf73b49bb32f9a9fe74485731469b6ee38eb1', '0', NULL, NULL, NULL, 'https://i.imgur.com/GWrufYw.jpg', 'https://i.imgur.com/le8HXCC.png', 99809999, 0, 'instructor', 0, 'Giáo viên Anh văn', 'Đăk Nông - Việt Nam', 5, 0, NULL, NULL, 'local'),
(11, 'dothiloan111974@gmail.com', 'Đỗ Thị Loan', 'thloan406', 'b68ab1ad12d6a0bb55a06e8a203e56ac', '0359731848', NULL, NULL, NULL, 'https://i.imgur.com/b0VF3PJ.png', 'https://i.imgur.com/0aDdQyR.png', 0, 0, 'member', 0, NULL, 'Đăk Nông - Việt Nam', 0, 1, 'MgZ16JrbXFT2qB3EMms1WSMihVbm1ULSho6I6Cnc9BTm65hmgM', '::1', 'local'),
(12, 'leminhphuc172@gmail.com', 'Lê Minh Phúc', 'lminhphc865', '313e4ac6415fd333d832f3a51153c2d4', '0374842702', NULL, NULL, NULL, 'https://i.imgur.com/b0VF3PJ.png', 'https://i.imgur.com/0aDdQyR.png', 0, 0, 'member', 0, NULL, 'Đăk Nông - Việt Nam', 0, 1, 'imoiRzm5i9AjSmnG9F0LKmf28lUC28cyA7YP0tmOOC4D6nOBkv', '::1', 'local'),
(13, 'taoprolamnha@gmail.com', 'ZendVN', 'lvnbn7788', '7a868cbfe6b9307d339bbd0fa5447960', '0944179302', NULL, NULL, NULL, 'https://yt3.googleusercontent.com/ytc/AGIKgqOJxNDFHMyR6HRrkR_ZUjpVshQOu2XZpiDlKCKc=s176-c-k-c0x00ffffff-no-rj', 'https://i.imgur.com/0aDdQyR.png', 20000, 20000, 'member', 0, NULL, 'Không rõ', 0, 1, 'cHhQz1DIW0KmCLV6wWlIUbZcUiGZa8ffocAIMfQTqFyUqQZvE7', '192.168.1.7', 'local'),
(14, 'wofet55025@royalka.com', 'WOFET', 'wofet2688', '89a365a0f455e45b7c80ab106fced449', '0398202931', NULL, NULL, NULL, 'https://i.imgur.com/b0VF3PJ.png', 'https://i.imgur.com/0aDdQyR.png', 0, 0, 'member', 0, NULL, 'Không rõ', 0, 1, 'c3Wa4LNNQhPzK2dX85ZplruzDo2gOc9ERgXws6O15F3E4fgv4m', '::1', 'local'),
(15, 'lnt71586@nezid.com', '123434444', '1234344446802', '54c45bed9d08ac5a3dab56bdd5dd97cf', '0944441929', NULL, NULL, NULL, 'https://i.imgur.com/b0VF3PJ.png', 'https://i.imgur.com/0aDdQyR.png', 0, 0, 'member', 0, NULL, 'Không rõ', 0, 1, 'C6lHRb71sytwxBqrsN3GHURI7qoU8XxC1UQnr0pZvJHViFH6Zt', '::1', 'local'),
(16, 'jfk34635@nezid.com', 'Đức Tài', 'cti8911', 'a5669274e4c42d195f3f7e63c7dc10f6', '0819203910', NULL, NULL, NULL, 'https://i.imgur.com/b0VF3PJ.png', 'https://i.imgur.com/0aDdQyR.png', 0, 0, 'member', 0, NULL, 'Không rõ', 0, 1, '23mLLUEsTEbC5DByPQT6BzWNxwLmJ6rOBLGUnVNNkhsP4ju6kq', '::1', 'local'),
(19, 'lequangnguyen1221@gmail.com', 'KHAI LE QUANG', 'khailequang8198', 'c52f1bd66cc19d05628bd8bf27af3ad6', '0', '101627640638781966694', NULL, NULL, 'https://i.imgur.com/b0VF3PJ.png', 'https://i.imgur.com/0aDdQyR.png', 0, 0, 'member', 0, NULL, 'Không rõ', 0, 1, 'P1IZRKPygTkfj7HMfKVkanTU33sQaJp3oMeFLqVBBLKxJNroBQ', '::1', 'google'),
(20, 'khaidev.com@gmail.com', 'QUANG KHAI LE', 'quangkhaile6722', '44c4c17332cace2124a1a836d9fc4b6f', '0', '106147087279158489583', NULL, NULL, 'https://i.imgur.com/b0VF3PJ.png', 'https://i.imgur.com/0aDdQyR.png', 0, 0, 'admin', 0, NULL, 'Không rõ', 0, 1, 'd2c9AJbtXkKtYNfaVt1o9iNzc65bMcgoDw4ExoNxWOaH8LLMjC', '::1', 'google'),
(22, 'lequangngyeie9e@gmailc.om', 'LE QUANG NGUYEN', 'lequangnguyen1679', 'b3f4bb701cbb751864439aad9a74dbb2', '0391029301', NULL, NULL, NULL, 'https://i.imgur.com/b0VF3PJ.png', 'https://i.imgur.com/0aDdQyR.png', 0, 0, 'member', 0, NULL, 'Không rõ', 0, 1, 'HRBMDqtfFGNJpbHioCQUDstRFbWtDn3FzDrOZyTxLu9AWUY53Y', '::1', 'local');

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
(1, 'wofet55025@royalka.com', 2010, 'file_id', 1, 0, 32, '1691572895'),
(2, 'wofet55025@royalka.com', 2010, 'file_id', 1, 0, 60, '1691572896'),
(3, 'lequangkhai.dev@gmail.com', 1, 'text_lesson', 3, 13, 0, '1692116859'),
(4, 'lequangkhai.dev@gmail.com', 1, 'text_lesson', 3, 14, 0, '1692116860'),
(5, 'lequangkhai.dev@gmail.com', 1, 'text_lesson', 3, 15, 0, '1692116862'),
(6, 'lequangkhai.dev@gmail.com', 1, 'text_lesson', 3, 16, 0, '1692116863'),
(7, 'lequangkhai.dev@gmail.com', 2010, 'file_id', 1, 0, 60, '1692121813'),
(8, 'lequangkhai.dev@gmail.com', 2010, 'file_id', 1, 0, 32, '1692121819');

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
  `video_demo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
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
(1, 1, 606, 'text_lesson', 0, 'Học Lập Trình Python Cơ Bản Đến Nâng Cao', 'Learn-Python-Programming', 35, 'Learn Python Programming the Easy Way, Complete with Examples, Quizzes, Exercises and more. Learn Python 2 and Python 3.', 'https://www.freecodecamp.org/news/content/images/2022/02/Banner-10.png', 'https://i.imgur.com/CAziExj.jpg', '/store/934/Python for Beginners.mp4', NULL, 5000000, 50, '<p>Whether you want to:</p><p>- build the skills you need to get your first Python programming job</p><p>- move to a more senior software developer position</p><p>- get started with Machine Learning, Data Science, Django or other hot areas that Python specialises in</p><p>- or just learn Python to be able to create your own Python apps quickly.</p><p>…then you need a solid foundation in Python programming. And this course is designed to give you those core skills, fast.</p><p>This course is aimed at complete beginners who have never programmed before, as well as existing programmers who want to increase their career options by learning Python.</p><p>The fact is, Python is one of the most popular programming languages in the world – Huge companies like Google use it in mission critical applications like Google Search.</p><p>And Python is the number one language choice for machine learning, data science and artificial intelligence. To get those high paying jobs you need an expert knowledge of Python, and that’s what you will get from this course.</p><p>By the end of the course you’ll be able to apply in confidence for Python programming jobs. And yes, this applies even if you have never programmed before. With the right skills which you will learn in this course, you can become employable and valuable in the eyes of future employers.</p><p>Here’s what a few students have told us about the course after going through it.</p><p>“I had very limited programming experience before I started this course, so I have really learned a lot from the first few sections. It has taken me from essentially zero programming skill to a level where I\'m comfortable using Python to analyze data for my lab reports, and I\'m not even halfway done the course yet. There are other courses out there which focus on data analysis, but those courses are usually targeted at people who already know how to program which is why I chose this course instead. “ – Christian DiMaria</p><p><br></p><p>“I have been puttering through your Python course . In that time, though, and without finishing it yet I\'ve been able to automate quite a bit at my work. I work in a school system and unifying data from our various student information systems can be incredibly frustrating, time consuming, and at times challenging. Using your course, I\'ve learned enough to write applications that turn massive text files into dictionaries that get \"stitched\" together like a database and output to properly formatted CSV files and then uploaded via SFTP to various systems for secure processing. Our teachers, students, and the tech department have greatly benefitted from this automation. I just wanted to drop you a note thanking you for helping me learn this skill.” – Keith Medlin</p><p><br></p><p>“This course was great. Within 3 weeks I was able to write my own database related applications.” – Theo Coenen</p><p><br></p><p>And there are many more students who love the course – check out all the reviews for yourself.</p><p>Will this course give you core python skills?</p><p>Yes it will.  There are a range of exciting opportunities for Python developers. All of them require a solid understanding of Python, and that’s what you will learn in this course.</p><p>Will the course teach me data science, machine learning and artificial intelligence?</p><p>No, it won’t do that – All of these topics are branches of Python programming.  And all of them require a solid understanding of the Python language.</p><p>Nearly all courses on these topics assume that you understand Python, and without it you will quickly become lost and confused.</p><p>This course will give you that core, solid understanding of the Python programming language.</p><p>By the end of the course you will be ready to apply for Python programming positions as well as move on to specific areas of Python, as listed above.</p><p>Why should you take this course?</p><p>There are a lot of Python courses on Udemy – Your instructors, Tim and Jean-Paul are pretty unique in that between them they have around 70 years of professional programming experience.  That’s more than a lifetime of skills you get to learn Python from.</p><p>You can enrol in the course safe in the knowledge that they are not just teachers, but professional programmers with real commercial programming experience, having worked with big companies like IBM, Mitsubishi, Fujitsu and Saab in the past.</p><p>As such you will not only be learning Python, but you will be learning industry best practices for Python programming that real employers demand. </p><p>And if that’s not enough take a read of some of the many reviews from happy students – there are around 100,000 students who have left around 19,000 reviews.</p><p>This is one of the most popular courses on Python programming on Udemy.</p><p>Student Quote: “Tim and JP are excellent teachers and are constantly answering questions and surveying students on new topics they will like to learn. This isn\'t a Python course it’s THE Python course you need.” – Sean Burger</p><p>Ready to get started, developer?</p><p>Enrol now using the “Add to Cart” button on the right, and get started on your way to creative, advanced Python brilliance. Or, take this course for a free spin using the preview feature, so you know you’re 100% certain this course is for you.</p><p>See you on the inside (hurry, your Python class is waiting!)</p><div><br></div>', 1, 0, 0, 0, 'thank you .', 'active', 111, 1624954285, 1625949854, NULL, 4),
(2010, 13, 606, 'text_lesson', 0, 'Phân tích và thiết kế cơ sở dữ liệu', 'phan-tich-va-thiet-ke-co-so-du-lieu', 35, 'Database, SQL, Cơ Sở Dữ Liệu, Miễn Phí', 'https://i.imgur.com/EmXh20E.png', 'https://i.imgur.com/9D47YNc.png', 'http://commondatastorage.googleapis.com/gtv-videos-bucket/sample/BigBuckBunny.mp4', NULL, 0, 0, '\n  <h1>Khóa học Phân tích và thiết kế cơ sở dữ liệu</h1>\n  \n  <h2>Giới thiệu khóa học</h2>\n  <p>\n    Khóa học Phân tích và thiết kế cơ sở dữ liệu là một khóa học cung cấp kiến thức cơ bản và nâng cao về việc phân tích, thiết kế và quản lý cơ sở dữ liệu trong các dự án phần mềm.\n  </p>\n\n  <h2>Nội dung khóa học</h2>\n  <p>\n    Trong khóa học này, bạn sẽ được học về:\n  </p>\n  <ul>\n    <li>Khái niệm cơ bản về cơ sở dữ liệu</li>\n    <li>Phân tích yêu cầu cơ sở dữ liệu</li>\n    <li>Mô hình hóa dữ liệu</li>\n    <li>Thiết kế cơ sở dữ liệu quan hệ</li>\n    <li>Ngôn ngữ truy vấn cơ sở dữ liệu SQL</li>\n    <li>Bảo mật và quản lý cơ sở dữ liệu</li>\n  </ul>\n\n  <h2>Đối tượng học</h2>\n  <p>\n    Khóa học Phân tích và thiết kế cơ sở dữ liệu dành cho:\n  </p>\n  <ul>\n    <li>Sinh viên ngành Công nghệ thông tin</li>\n    <li>Lập trình viên muốn nâng cao kỹ năng về cơ sở dữ liệu</li>\n    <li>Các nhà phát triển phần mềm</li>\n  </ul>\n\n  <h2>Yêu cầu tiên quyết</h2>\n  <p>\n    Để tham gia khóa học này, bạn cần có kiến thức cơ bản về lập trình và cơ sở dữ liệu.\n  </p>\n\n  <h2>Thời lượng khóa học</h2>\n  <p>\n    Khóa học này kéo dài trong 10 tuần với tổng cộng 30 giờ học.\n  </p>\n\n  <h2>Đăng ký</h2>\n  <p>\n    Để đăng ký tham gia khóa học Phân tích và thiết kế cơ sở dữ liệu, vui lòng liên hệ với chúng tôi qua số điện thoại hoặc email sau:\n  </p>\n  <ul>\n    <li>Số điện thoại: 0123456789</li>\n    <li>Email: example@example.com</li>\n  </ul>', 1, 0, 0, 0, 'thank you .', 'active', 0, 1624954285, 1625949854, NULL, 4);

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
  `status` enum('pending','active') COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `webinar_reviews`
--

INSERT INTO `webinar_reviews` (`id`, `webinar_id`, `user_id`, `user_type`, `rates`, `description`, `liked`, `created_at`, `status`) VALUES
(20, 1, 1, 'show', '5', 'Khóa học này có đầy đủ các thông tin du lịch. Tôi rất biết ơn về những lời khuyên mới mà tôi chưa từng nghe trước đây. Cảm ơn :)', 0, 1626214531, 'active'),
(21, 2010, 2, 'show', '4.75', 'Chắc chắn đề nghị cho bất cứ ai bắt đầu excel. Nếu bạn đã quen thuộc với những điều cơ bản và mới chỉ sử dụng excel như một máy tính, điều này sẽ giúp bạn nhận ra mức độ linh hoạt của nó và cách sử dụng nó một cách hiệu quả.', 0, 1626214590, 'active'),
(22, 2010, 3, 'show', '5', 'Khóa học bao gồm tất cả những điều cơ bản cần thiết cùng với các ứng dụng mang đến cho người học mức độ tiếp xúc cao trong lập trình python.\n\nTôi thích cách giải thích khóa học, tức là bằng cách chỉ ra các lỗi và cách sửa chúng. Điều này cho phép người học tự gỡ lỗi các vấn đề.\n\nHãy tiếp tục phát huy.', 0, 1626214647, 'active'),
(46, 1, 19, 'hide', '5', 'Khoá học rất hay nha!', 82, 1694511608, 'active');

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
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=612;

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
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `files`
--
ALTER TABLE `files`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `history_recharge`
--
ALTER TABLE `history_recharge`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `login_records`
--
ALTER TABLE `login_records`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `send_email`
--
ALTER TABLE `send_email`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

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
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `user_passed_lesson`
--
ALTER TABLE `user_passed_lesson`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `webinars`
--
ALTER TABLE `webinars`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2011;

--
-- AUTO_INCREMENT for table `webinar_reviews`
--
ALTER TABLE `webinar_reviews`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
