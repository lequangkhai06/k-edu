-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th6 09, 2023 lúc 03:08 AM
-- Phiên bản máy phục vụ: 10.4.27-MariaDB
-- Phiên bản PHP: 8.0.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `lms`
--

DELIMITER $$
--
-- Thủ tục
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `insertData` (IN `in_username` VARCHAR(40), IN `in_gender` VARCHAR(8), IN `in_mobile` VARCHAR(20), IN `in_email` VARCHAR(20), IN `in_dob` VARCHAR(10), IN `in_joining_date` VARCHAR(10), IN `in_userid` VARCHAR(20))   BEGIN
INSERT INTO users(username, gender, mobile, email, dob, joining_date, userid) VALUES(in_username,in_gender,in_mobile,in_email,in_dob,in_joining_date,in_userid);
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `become_instructors`
--

CREATE TABLE `become_instructors` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `certificate` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `status` enum('pending','accept','reject') NOT NULL DEFAULT 'pending',
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Đang đổ dữ liệu cho bảng `become_instructors`
--

INSERT INTO `become_instructors` (`id`, `user_id`, `certificate`, `description`, `status`, `created_at`) VALUES
(5, 930, '/store/930/certificate.jpg', 'I taught design in London for two years.', 'pending', 1626242477);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `categories`
--

CREATE TABLE `categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `parent_id` int(11) DEFAULT 0,
  `title` varchar(64) NOT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `icon` varchar(255) DEFAULT NULL,
  `order` int(10) UNSIGNED DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Đang đổ dữ liệu cho bảng `categories`
--

INSERT INTO `categories` (`id`, `parent_id`, `title`, `slug`, `icon`, `order`) VALUES
(528, 0, 'Development', NULL, '/store/1/default_images/categories_icons/code.svg', 0),
(606, 528, 'Backend Development', 'Backend-Development', NULL, 1),
(607, 528, 'Mobile Development', 'Mobile-Development', NULL, 2),
(608, 528, 'Web Development', 'Web-Development', NULL, 3);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `comments`
--

CREATE TABLE `comments` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `review_id` int(10) UNSIGNED DEFAULT NULL,
  `webinar_id` int(10) UNSIGNED DEFAULT NULL,
  `blog_id` int(10) UNSIGNED DEFAULT NULL,
  `reply_id` int(10) UNSIGNED DEFAULT NULL,
  `comment` text DEFAULT NULL,
  `status` enum('pending','active') NOT NULL,
  `report` tinyint(1) NOT NULL DEFAULT 0,
  `disabled` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` int(11) NOT NULL,
  `viewed_at` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Đang đổ dữ liệu cho bảng `comments`
--

INSERT INTO `comments` (`id`, `user_id`, `review_id`, `webinar_id`, `blog_id`, `reply_id`, `comment`, `status`, `report`, `disabled`, `created_at`, `viewed_at`) VALUES
(43, 996, NULL, 2004, NULL, NULL, 'Hi.\r\nWhat is the level of this course?', 'active', 0, 0, 1625863108, NULL),
(44, 930, NULL, 1998, NULL, NULL, 'I have already taken another course with this teacher. His teaching method is excellent.', 'active', 0, 0, 1625863203, 1625863611),
(45, 979, NULL, 1999, NULL, NULL, 'Is it possible to participate in this course without participating in the prerequisite course?', 'active', 0, 0, 1625863345, NULL),
(47, 1015, NULL, 1998, NULL, 44, 'Thanks a lot for your comment, Best regards.', 'active', 0, 0, 1625863726, 1626235570),
(48, 3, NULL, 1997, NULL, NULL, 'Will we be able to build applications at the end of this course?', 'active', 0, 0, 1625864259, 1625864297),
(49, 934, NULL, 1997, NULL, 48, 'Hi.\r\nYes you can.', 'active', 0, 0, 1625864351, NULL),
(50, 1016, NULL, 2006, NULL, NULL, 'Will this course be updated in the future?', 'active', 0, 0, 1625864416, NULL),
(51, 995, NULL, 2004, NULL, NULL, 'Will we receive a certificate at the end of this course?', 'active', 0, 0, 1625864526, NULL),
(52, 1015, NULL, 2002, NULL, NULL, 'Perfect course, thank you.', 'active', 0, 0, 1626235679, NULL),
(53, 995, NULL, 1995, NULL, NULL, 'Course files are not complete !!!', 'active', 0, 0, 1626240118, 1626240169),
(54, 1016, NULL, 1995, NULL, 53, 'Please prove. The course files are complete and 90% of the students are satisfied.', 'active', 0, 0, 1626240342, 1626241422),
(55, 929, NULL, 1995, NULL, NULL, 'Is it possible to update the course ?', 'active', 0, 0, 1626241320, 1626241422),
(56, 929, NULL, 2003, NULL, NULL, 'Hi.\r\nIs it possible to start the class earlier?', 'active', 0, 0, 1626241386, NULL),
(57, 1016, NULL, 1995, NULL, 55, 'No, but it may change in the future. Thank you', 'active', 0, 0, 1626241505, NULL),
(58, 3, NULL, 2003, NULL, 56, 'Hi kate.\r\nNo, but it may change in the future. Thank you', 'active', 0, 0, 1626242070, NULL),
(60, 995, NULL, NULL, 23, NULL, 'I really enjoyed this article. You are a very good writer', 'pending', 0, 0, 1626242653, NULL),
(63, 996, NULL, 2003, NULL, NULL, 'As i already new a lot on this matter i was surprised that i actually find out that there are more ways to tweak your time management', 'active', 0, 0, 1626509327, NULL),
(64, 1015, NULL, 1995, NULL, NULL, 'Great course that gives you the basic knowledge needed to become a product manager.', 'pending', 0, 0, 1626509546, NULL),
(65, 863, NULL, 2002, NULL, 52, 'We are very happy that you are satisfied with this course.', 'pending', 0, 0, 1626509913, NULL),
(66, 930, NULL, NULL, 21, NULL, 'Thank you. It was a very good article', 'pending', 0, 0, 1626510056, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `comments_reports`
--

CREATE TABLE `comments_reports` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `blog_id` int(10) UNSIGNED DEFAULT NULL,
  `webinar_id` int(10) UNSIGNED DEFAULT NULL,
  `comment_id` int(10) UNSIGNED NOT NULL,
  `message` text NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Đang đổ dữ liệu cho bảng `comments_reports`
--

INSERT INTO `comments_reports` (`id`, `user_id`, `blog_id`, `webinar_id`, `comment_id`, `message`, `created_at`) VALUES
(5, 1016, NULL, 1995, 53, 'this is a spam comment.', 1626240256);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `faqs`
--

CREATE TABLE `faqs` (
  `id` int(10) UNSIGNED NOT NULL,
  `creator_id` int(10) UNSIGNED NOT NULL,
  `webinar_id` int(10) UNSIGNED NOT NULL,
  `title` varchar(64) NOT NULL,
  `answer` text NOT NULL,
  `order` int(10) UNSIGNED DEFAULT NULL,
  `created_at` int(10) UNSIGNED DEFAULT NULL,
  `updated_at` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Đang đổ dữ liệu cho bảng `faqs`
--

INSERT INTO `faqs` (`id`, `creator_id`, `webinar_id`, `title`, `answer`, `order`, `created_at`, `updated_at`) VALUES
(13, 1016, 2010, 'What is the course level?', 'This is a course for beginners so you will get familiar with the topic from scratch.', NULL, 1624908798, NULL),
(14, 1016, 2010, 'How can I get course updates?', 'You will receive a notification after each update is released so you can download updated files from the course page.', NULL, 1624908812, NULL),
(15, 1016, 2010, 'Is it a supported course?', 'Yes, you can get in touch with the instructor using the support system.', NULL, 1624908829, NULL),
(16, 1016, 2010, 'How can I download exercise files?', 'All of the exercise files could be downloaded from the content tab on the course page.', NULL, 1624908852, NULL),
(17, 1016, 2010, 'Can I have a private meeting with the instructor?', 'Yes, you can reserve a 1 to 1 meeting with the instructor using the instructor profile.', NULL, 1624908868, NULL),
(18, 1015, 1996, 'What is the course level??', 'This is a course for beginners so you will get familiar with the topic from scratch.', NULL, 1624945244, NULL),
(19, 1015, 1996, 'How can I get course updates?', 'You will receive a notification after each update is released so you can download updated files from the course page.', NULL, 1624945306, NULL),
(20, 1015, 1996, 'Is it a supported course?', 'Yes, you can get in touch with the instructor using the support system.', NULL, 1624945328, NULL),
(21, 934, 1997, 'What is the course level?', 'This is a course for beginners so you will get familiar with the topic from scratch.', NULL, 1624956994, NULL),
(22, 934, 1997, 'How can I get course updates?', 'You will receive a notification after each update is released so you can download updated files from the course page.', NULL, 1624957014, NULL),
(23, 929, 1999, 'What is the course level?', 'This is a course for beginners so you will get familiar with the topic from scratch.', NULL, 1625039334, NULL),
(24, 929, 1999, 'How can I download exercise files?', 'All of the exercise files could be downloaded from the content tab on the course page.', NULL, 1625039363, NULL),
(25, 929, 1999, 'Can I have a private meeting with the instructor?', 'Yes, you can reserve a 1 to 1 meeting with the instructor using the instructor profile.', NULL, 1625039377, NULL),
(26, 867, 2000, 'How can I get course updates?', 'You will receive a notification after each update is released so you can download updated files from the course page.', NULL, 1625046069, NULL),
(27, 867, 2000, 'What is the course level?', 'This is a course for beginners so you will get familiar with the topic from scratch.', NULL, 1625046102, NULL),
(28, 3, 2001, 'Is it a supported course?', 'Yes, you can get in touch with the instructor using the support system.', NULL, 1625079104, NULL),
(29, 864, 2003, 'How can I get course updates?', 'You will receive a notification after each update is released so you can download updated files from the course page.', NULL, 1625300294, NULL),
(30, 864, 2003, 'Can I have a private meeting with the instructor?', 'Yes, you can reserve a 1 to 1 meeting with the instructor using the instructor profile.', NULL, 1625300305, NULL),
(31, 864, 2003, 'Is it a supported course?', 'Yes, you can get in touch with the instructor using the support system.', NULL, 1625300320, NULL),
(32, 4, 2005, 'What is the course level?', 'This is a course for beginners so you will get familiar with the topic from scratch.', NULL, 1625691029, NULL),
(33, 4, 2005, 'Is it a supported course?', 'Yes, you can get in touch with the instructor using the support system.', NULL, 1625691056, NULL),
(34, 4, 2005, 'Can I have a private meeting with the instructor?', 'Yes, you can reserve a 1 to 1 meeting with the instructor using the instructor profile.', NULL, 1625691083, NULL),
(35, 867, 2006, 'Is it a supported course?', 'Yes, you can get in touch with the instructor using the support system.', NULL, 1625694463, NULL),
(36, 867, 2006, 'Can I have a private meeting with the instructor?', 'Yes, you can reserve a 1 to 1 meeting with the instructor using the instructor profile.', NULL, 1625694481, NULL),
(37, 1015, 1998, 'What is the course level?', 'This is a course for beginners so you will get familiar with the topic from scratch.', NULL, 1626109158, NULL),
(38, 1015, 1998, 'Is it a supported course?', 'Yes, you can get in touch with the instructor using the support system.', NULL, 1626109178, NULL),
(39, 1015, 1998, 'Can I have a private meeting with the instructor?', 'Yes, you can reserve a 1 to 1 meeting with the instructor using the instructor profile.', NULL, 1626109196, NULL),
(40, 867, 2007, 'What is the course level?', 'This is a course for beginners so you will get familiar with the topic from scratch.', NULL, 1626234581, NULL),
(41, 867, 2007, 'How can I get course updates?', 'You will receive a notification after each update is released so you can download updated files from the course page.', NULL, 1626234619, NULL),
(42, 867, 2007, 'Is it a supported course?', 'Yes, you can get in touch with the instructor using the support system.', NULL, 1626234666, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `files`
--

CREATE TABLE `files` (
  `id` int(10) UNSIGNED NOT NULL,
  `creator_id` int(10) UNSIGNED NOT NULL,
  `webinar_id` int(10) UNSIGNED NOT NULL,
  `title` varchar(64) NOT NULL,
  `accessibility` enum('free','paid') NOT NULL,
  `downloadable` tinyint(1) DEFAULT 0,
  `storage` enum('local','online') NOT NULL,
  `file` varchar(255) NOT NULL,
  `volume` varchar(64) NOT NULL,
  `file_type` varchar(64) NOT NULL,
  `description` varchar(1000) DEFAULT NULL,
  `order` int(10) UNSIGNED DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) DEFAULT NULL,
  `deleted_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Đang đổ dữ liệu cho bảng `files`
--

INSERT INTO `files` (`id`, `creator_id`, `webinar_id`, `title`, `accessibility`, `downloadable`, `storage`, `file`, `volume`, `file_type`, `description`, `order`, `created_at`, `updated_at`, `deleted_at`) VALUES
(31, 1016, 1995, 'Course Overview (Youtube)', 'free', 0, 'online', 'https://youtu.be/pCmh6XaMVxs', '136.00 MB', 'video', 'Understand the varying role of a Product Manager through different types and sizes of companies', 2, 1624869878, 1624869904, NULL),
(32, 1016, 1995, 'What is a Product? (Youtube)', 'free', 0, 'online', 'https://youtu.be/yUOC-Y0f5ZQ', '46.00 MB', 'video', 'Let’s get basic – what is a product?\r\n\r\nProducts, like ghosts, are all around you (read that in a spooky voice).\r\n\r\nSure, it sounds simple, but there’s a lot more nuance to this than just looking up the dictionary definition.', 3, 1624870086, 1624870190, NULL),
(33, 1016, 1995, 'Ideas and User Needs (Vimeo)', 'free', 0, 'online', 'https://vimeo.com/354744129', '280.00 MB', 'video', 'Welcome to the land of ideas and user needs! Have you ever.', 4, 1624871143, 1624942361, NULL),
(34, 1016, 1995, 'Demo Video', 'free', 1, 'local', '/store/1016/Become A Product Manager.mp4', '5.82 MB', 'mp4', 'The most complete course available on Product Management.', 1, 1624942577, 1624942601, NULL),
(35, 934, 1997, 'Demo Video', 'free', 1, 'local', '/store/934/Python for Beginners.mp4', '7.09 MB', 'mp4', 'Python is an interpreted high-level general-purpose programming language. Python\'s design philosophy emphasizes code readability with its notable use of significant indentation.', NULL, 1624956937, NULL, NULL),
(36, 1015, 1998, 'Introduction Class', 'free', 0, 'local', '/store/1015/Microsoft Excel - Excel from Beginner to Advanced.mkv', '4.10 MB', 'mkv', 'Microsoft Excel is a spreadsheet developed by Microsoft for Windows, macOS, Android and iOS. It features calculation, graphing tools, pivot tables, and a macro programming language called Visual Basic for Applications (VBA).', NULL, 1624966718, NULL, NULL),
(37, 929, 1999, 'Introduction', 'free', 1, 'local', '/store/929/How To Manage & Influence Your Virtual Team.mkv', '10.58 MB', 'mkv', 'In this welcome  video, I give you a quick overview of what the course is about.', NULL, 1625038371, 1625043314, NULL),
(38, 929, 1999, 'Principles of Behavior Change', 'paid', 1, 'local', '/store/929/How to Manage & Influence Your Virtual Team.mp4', '4.46 MB', 'mp4', 'In this lecture, I discuss an overview of the \"Principles of Behavior Change\" module, the 4 power principles of behavior change, and what you should know about those principles when managing your virtual team.', NULL, 1625038447, NULL, NULL),
(39, 929, 1999, 'The Power of Writing', 'paid', 1, 'local', '/store/929/How to Manage & Influence Your Virtual Team.mp4', '4.46 MB', 'mp4', 'In this lecture, I discuss the following: The mysterious power of writing things down and The advantages of writing tasks out to your virtual team', NULL, 1625038633, NULL, NULL),
(40, 929, 1999, 'Before the Meeting', 'paid', 1, 'local', '/store/929/How to Manage & Influence Your Virtual Team.mp4', '4.46 MB', 'mp4', 'In this lecture, I discuss the five things you should do before every meeting, and how to manage everyone’s expectations through a well-crafted meeting agenda.', NULL, 1625039003, NULL, NULL),
(41, 929, 1999, 'During the Meeting', 'paid', 1, 'local', '/store/929/How to Manage & Influence Your Virtual Team.mp4', '4.46 MB', 'mp4', 'In this lecture, I discuss the five things you should do during every meeting, and how to facilitate your meetings to keep everyone focused on their tasks.', NULL, 1625039096, NULL, NULL),
(42, 929, 1999, 'After the Meeting', 'paid', 1, 'local', '/store/929/How to Manage & Influence Your Virtual Team.mp4', '4.46 MB', 'mp4', 'In this lecture, I discuss the two things you should do after every meeting, and how to follow up with your team to make sure they are committed to getting their actions completed.', NULL, 1625039180, NULL, NULL),
(43, 867, 2000, 'Introduction', 'free', 1, 'local', '/store/867/Effective Time Management.mkv', '1.59 MB', 'mkv', 'If you have ever taken a time management course, you\'ve probably faced the frustration of trying to manage your time better and not succeeding.', NULL, 1625045148, NULL, NULL),
(44, 863, 2002, 'Why Your Fitness Matters', 'free', 0, 'local', '/store/863/Why Your Fitness Matters.mp4', '4.72 MB', 'mp4', 'Unfortunately, the internet is full of false fitness gurus that sell you all kinds of workouts plans and gimmicks that are overpriced and don\'t work.', NULL, 1625123527, 1625123886, NULL),
(45, 864, 2003, 'Introduction', 'free', 1, 'local', '/store/864/Active Listening- You Can Be a Great Listener.mkv', '3.78 MB', 'mkv', 'Improve your reactive habits, define your listening mindset, amplify your curiosity, & add value as a great listener', NULL, 1625300200, NULL, NULL),
(46, 929, 2004, 'Exponential', 'paid', 1, 'local', '/store/929/The Future of Energy.mkv', '15.00 MB', 'mkv', 'Here you will gain and understanding of how consumption is more important than finds of non-renewable energy. Also other matters that affect the future development of non-renewable key and primary fuels', NULL, 1625685492, NULL, NULL),
(47, 929, 2004, 'Importance of Oil', 'paid', 1, 'local', '/store/929/The Future of Energy.mkv', '15.00 MB', 'mkv', 'Here we test your knowledge of what you learned hopefully listening to our second lecture.', NULL, 1625685578, 1625685587, NULL),
(48, 929, 2004, 'Behavioural Solutions', 'paid', 1, 'local', '/store/929/The Future of Energy.mkv', '15.00 MB', 'mkv', 'Here you will gain and understanding of how consumption is more important than finds of non-renewable energy. Also other matters that affect the future development of non-renewable key and primary fuels', NULL, 1625685691, NULL, NULL),
(49, 4, 2005, 'Welcome !!', 'free', 0, 'online', 'https://youtu.be/z-xkbNLIB5w', '52.00 MB', 'video', 'Today we are going to learn the basics of creating a good design. This can apply from web design to graphic design in general.\r\nI put together my top 5 tips and tricks to create a good design from scratch.', NULL, 1625690308, NULL, NULL),
(50, 4, 2005, 'CSS Essentials', 'paid', 0, 'online', 'https://youtu.be/jx5jmI0UlXU', '75.00 MB', 'video', 'Chances are you have heard of relative and absolute position in CSS, but did you know there are still three other positions? In this video I will be covering all five CSS positions (static, relative, absolute, fixed, and sticky) .', NULL, 1625690699, NULL, NULL),
(51, 4, 2005, 'Intermediate CSS', 'paid', 0, 'online', 'https://youtu.be/IyYC-hSFEFQ', '168.00 MB', 'video', 'Learn more about Intermediate CSS features like CSS Grid, Flexbox, and custom properties (aka. variables). Kyle, from Web Dev Simplified, will walk through a few Intermediate CSS challenges and discuss some of our favorite CSS tips and tricks.', NULL, 1625690835, NULL, NULL),
(52, 867, 2006, 'Welcome to the Course!', 'free', 1, 'local', '/store/867/How to Travel Around the World on a Budget.mkv', '13.10 MB', 'mkv', 'A warm welcome to the course! Feel free to contact me if you have any questions', NULL, 1625694176, NULL, NULL),
(53, 867, 2006, 'Health & Safety', 'paid', 1, 'local', '/store/867/How to Travel Around the World on a Budget.mkv', '13.10 MB', 'mkv', 'The point of this lecture is to share with you numerous safety tips I\'ve learned during my journey.', NULL, 1625694214, 1625694243, NULL),
(54, 867, 2006, 'Where To Sleep during your Travels?', 'paid', 1, 'local', '/store/867/How to Travel Around the World on a Budget.mkv', '13.10 MB', 'mkv', 'After this lesson you\'ll know what exactly is Couchsurfing and what to expect.', NULL, 1625694330, NULL, NULL),
(55, 867, 2006, 'Ready to go? The last things to do!', 'paid', 1, 'local', '/store/867/How to Travel Around the World on a Budget.mkv', '13.10 MB', 'mkv', 'In this video I\'ll share with you some tips to earn money on the road and I will take my example as a digital nomad to show you what works.', NULL, 1625694401, NULL, NULL),
(56, 867, 2007, 'Overview', 'free', 1, 'local', '/store/867/Travel Management Course.mkv', '13.48 MB', 'mkv', 'The course content is uniquely customized in a way to give each student who participates in this course the best skill orientation and the basic knowledge required to enter the travel and tourism industry.', NULL, 1626234339, 1626234405, NULL),
(57, 867, 2007, 'Understanding Maps', 'free', 1, 'local', '/store/867/Travel Management Course.mkv', '13.48 MB', 'mkv', 'The course content is uniquely customized in a way to give each student who participates in this course the best skill orientation and the basic knowledge required to enter the travel and tourism industry.', NULL, 1626234398, NULL, NULL),
(58, 867, 2007, 'World Time', 'free', 1, 'local', '/store/867/Travel Management Course.mkv', '13.48 MB', 'mkv', 'The course content is uniquely customized in a way to give each student who participates in this course the best skill orientation and the basic knowledge required to enter the travel and tourism industry.', NULL, 1626234448, NULL, NULL),
(59, 867, 2007, 'Travel Technology', 'free', 1, 'local', '/store/867/Travel Management Course.mkv', '13.48 MB', 'mkv', 'The course content is uniquely customized in a way to give each student who participates in this course the best skill orientation and the basic knowledge require', NULL, 1626234512, NULL, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `send_email`
--

CREATE TABLE `send_email` (
  `id` int(10) NOT NULL,
  `email` varchar(255) NOT NULL,
  `action` varchar(255) NOT NULL,
  `msg` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `code` varchar(255) DEFAULT NULL,
  `time` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `send_email`
--

INSERT INTO `send_email` (`id`, `email`, `action`, `msg`, `code`, `time`) VALUES
(1, 'lequangkhai.dev@gmail.com', 'reset-password', 'Đặt lại mật khẩu qua email: lequangkhai.dev@gmail.com', 'fp998294', '04/06/2023 - 13:48:15'),
(2, 'lequangkhai.dev@gmail.com', 'reset-password', 'Đặt lại mật khẩu qua email: lequangkhai.dev@gmail.com', 'fp676864', '04/06/2023 - 19:52:11'),
(3, 'lequangkhai.dev@gmail.com', 'reset-password', 'Đặt lại mật khẩu qua email: lequangkhai.dev@gmail.com', 'fp793700', '04/06/2023 - 19:53:37'),
(4, 'lequangkhai.dev@gmail.com', 'reset-password', 'Đặt lại mật khẩu qua email: lequangkhai.dev@gmail.com', 'fp408120', '04/06/2023 - 19:58:03'),
(5, 'lequangkhai.dev@gmail.com', 'reset-password', 'Đặt lại mật khẩu qua email: lequangkhai.dev@gmail.com', 'fp479309', '04/06/2023 - 20:04:28'),
(6, 'lequangkhai.dev@gmail.com', 'reset-password', 'Đặt lại mật khẩu qua email: lequangkhai.dev@gmail.com', 'fp353310', '07/06/2023 - 20:53:25'),
(7, 'lequangkhai.dev@gmail.com', 'new-password', 'Mật khẩu mới được gửi tới email: lequangkhai.dev@gmail.com', 'AtbMhqKUS7', '07/06/2023 - 20:54:17');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `settings`
--

CREATE TABLE `settings` (
  `id` int(11) NOT NULL,
  `type` varchar(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL,
  `detail` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `notifies` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT 'on',
  `captcha` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT 'off',
  `status` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT 'on'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Đang đổ dữ liệu cho bảng `settings`
--

INSERT INTO `settings` (`id`, `type`, `detail`, `notifies`, `captcha`, `status`) VALUES
(1, 'SETTING', '{\"title\":\"DEMO SHOP GAME\",\"description\":\"Shop Game Free Fire\",\"keyword\":\"free fire, shop game, shop free fire\",\"cash_reg\":\"5000\",\"sale_card\":\"\",\"fanpage\":\"Shop-Thanh-H\\u01b0ng-Gaming-101466702687859\",\"notify\":\"https:\\/\\/upanh.cf\\/aklc56k5pd.png\",\"partner_id\":\"9122550161\",\"partner_key\":\"061c720dc499139206fc7a247f65731e\",\"apikey_captcha\":\"6LfCQvUhAAAAAI7Mzrh8g7VkrSxASau5DeqUEovs\",\"app_id\":\"x\",\"app_secret\":\"x\",\"logo\":\"\\/assets\\/upload\\/shop\\/d4403133e07b5da0a35501221a295e9f.png\",\"thumb\":\"\\/assets\\/upload\\/shop\\/b8ee37e8cf2b24dc9ced5262babf5993.gif\",\"background\":\"https:\\/\\/quanlyshop.vip\\/upload\\/doanhmuc\\/1662493129520197.png\"}', 'on', 'on', 'on');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tags`
--

CREATE TABLE `tags` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(64) NOT NULL,
  `webinar_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Đang đổ dữ liệu cho bảng `tags`
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
-- Cấu trúc bảng cho bảng `text_lessons`
--

CREATE TABLE `text_lessons` (
  `id` int(10) UNSIGNED NOT NULL,
  `creator_id` int(10) UNSIGNED NOT NULL,
  `webinar_id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `study_time` int(10) UNSIGNED DEFAULT NULL,
  `summary` text NOT NULL,
  `content` longtext NOT NULL,
  `accessibility` enum('free','paid') NOT NULL DEFAULT 'free',
  `order` int(10) UNSIGNED DEFAULT NULL,
  `created_at` int(10) UNSIGNED NOT NULL,
  `updated_at` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Đang đổ dữ liệu cho bảng `text_lessons`
--

INSERT INTO `text_lessons` (`id`, `creator_id`, `webinar_id`, `title`, `image`, `study_time`, `summary`, `content`, `accessibility`, `order`, `created_at`, `updated_at`) VALUES
(13, 934, 1997, 'Hello, World!', '/store/934/hero (9).jpg', 5, 'Get started learning Python with DataCamp\'s free Intro to Python tutorial. Learn Data Science by completing interactive coding challenges and watching videos by expert instructors. Start Now!', '<div>Python is a very simple language, and has a very straightforward syntax. It encourages programmers to program without boilerplate (prepared) code. The simplest directive in Python is the \"print\" directive - it simply prints out a line (and also includes a newline, unlike in C).</div><div><br></div><div>There are two major Python versions, Python 2 and Python 3. Python 2 and 3 are quite different. This tutorial uses Python 3, because it more semantically correct and supports newer features.</div><div><br></div><div>For example, one difference between Python 2 and 3 is the print statement. In Python 2, the \"print\" statement is not a function, and therefore it is invoked without parentheses. However, in Python 3, it is a function, and must be invoked with parentheses.</div>', 'free', 1, 1624954655, 1624956965),
(14, 934, 1997, 'Learning', '/store/934/hero (14).jpg', 10, 'Before getting started, you may want to find out which IDEs and text editors are tailored to make Python editing easy, browse the list of introductory books, or look at code samples that you might find helpful.', '<div>There is a list of tutorials suitable for experienced programmers on the BeginnersGuide/Tutorials page. There is also a list of resources in other languages which might be useful if English is not your first language.</div><div><br></div><div>The online documentation is your first port of call for definitive information. There is a fairly brief tutorial that gives you basic information about the language and gets you started. You can follow this by looking at the library reference for a full description of Python\'s many libraries and the language reference for a complete (though somewhat dry) explanation of Python\'s syntax. If you are looking for common Python recipes and patterns, you can browse the ActiveState Python Cookbook</div>', 'free', 2, 1624954929, NULL),
(15, 934, 1997, 'Looking for Something Specific?', '/store/934/hero (4).jpg', 20, 'If you want to know whether a particular application, or a library with particular functionality, is available in Python there are a number of possible sources of information.', '<p>If you want to know whether a particular application, or a library with particular functionality, is available in Python there are a number of possible sources of information. The Python web site provides a Python Package Index (also known as the Cheese Shop, a reference to the Monty Python script of that name). There is also a search page for a number of sources of Python-related information. Failing that, just Google for a phrase including the word \'\'python\'\' and you may well get the result you need. If all else fails, ask on the python newsgroup and there\'s a good chance someone will put you on the right track.</p><p>Python is an interpreted high-level general-purpose programming language. Python\'s design philosophy emphasizes code readability with its notable use of significant indentation. Its language constructs as well as its object-oriented approach aim to help programmers write clear, logical code for small and large-scale projects.[30]</p><p><br></p><p>Python is dynamically-typed and garbage-collected. It supports multiple programming paradigms, including structured (particularly, procedural), object-oriented and functional programming. Python is often described as a \"batteries included\" language due to its comprehensive standard library.[31]</p><p><br></p><p>Guido van Rossum began working on Python in the late 1980s, as a successor to the ABC programming language, and first released it in 1991 as Python 0.9.0.[32] Python 2.0 was released in 2000 and introduced new features, such as list comprehensions and a garbage collection system using reference counting. Python 3.0 was released in 2008 and was a major revision of the language that is not completely backward-compatible and much Python 2 code does not run unmodified on Python 3. Python 2 was discontinued with version 2.7.18 in 2020.[33]</p><p><br></p><p>Python consistently ranks as one of the most popular programming languages.</p>', 'free', 3, 1624956733, 1624956813);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(999) DEFAULT NULL,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL,
  `username` varchar(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL,
  `mobile` varchar(255) NOT NULL,
  `google_id` varchar(255) DEFAULT NULL,
  `facebook_id` varchar(255) DEFAULT NULL,
  `avatar` varchar(9999) DEFAULT 'https://i.imgur.com/b0VF3PJ.png',
  `border` varchar(999) NOT NULL DEFAULT 'https://i.imgur.com/0aDdQyR.png',
  `coins` int(255) NOT NULL DEFAULT 0,
  `accumulation` int(255) NOT NULL DEFAULT 0,
  `level` varchar(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL DEFAULT 'member',
  `status` int(11) NOT NULL DEFAULT 0,
  `bio` text CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `address` varchar(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL,
  `stars` int(1) NOT NULL DEFAULT 0,
  `verified` tinyint(1) NOT NULL DEFAULT 0,
  `token` varchar(50) DEFAULT NULL,
  `ip_addr` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `email`, `name`, `username`, `password`, `mobile`, `google_id`, `facebook_id`, `avatar`, `border`, `coins`, `accumulation`, `level`, `status`, `bio`, `address`, `stars`, `verified`, `token`, `ip_addr`) VALUES
(1, 'lequangkhai.dev@gmail.com', 'Lê Quang Khải', 'lewankhai', 'ce52ec2455883edcd28c79eb037c190b', '0387290231', NULL, NULL, 'https://i.imgur.com/b0VF3PJ.png', 'https://i.imgur.com/0aDdQyR.png', 99809999, 0, 'admin', 0, 'Admin', 'Đăk Nông - Việt Nam', 5, 1, 'epaW5BbsQ0tokjoguOrmEJdM1vmh1k71r8VOG61u30684Ok336', '::1'),
(2, 'taquochung@gmail.com', 'Tạ Quốc Hùng', 'taquochung', '9536686afad9da668b62647f2aeaf73b49bb32f9a9fe74485731469b6ee38eb1', '0', NULL, NULL, 'https://i.imgur.com/szPJ6lq.jpg', 'https://i.imgur.com/0aDdQyR.png', 99809999, 0, 'instructor', 0, 'Giáo viên tin học', 'Đăk Nông - Việt Nam', 4, 0, NULL, NULL),
(3, 'nguyenthienphu@gmail.com', 'Nguyễn Thiên Phú', 'nguyenthienphu', '9536686afad9da668b62647f2aeaf73b49bb32f9a9fe74485731469b6ee38eb1', '0', NULL, NULL, 'https://i.imgur.com/PnWx9Sz.jpg', 'https://i.imgur.com/cuaCwYj.png', 99809999, 0, 'instructor', 0, 'Giáo viên lịch sử', 'Đăk Nông - Việt Nam', 4, 0, NULL, NULL),
(4, 'ltmylinh@gmail.com', 'Lê Thị Mỹ Linh', 'lethimylinh', '9536686afad9da668b62647f2aeaf73b49bb32f9a9fe74485731469b6ee38eb1', '0', NULL, NULL, 'https://i.imgur.com/ylzP35E.jpg', 'https://i.imgur.com/3V3dSIU.png', 99809999, 0, 'instructor', 0, 'Giáo viên tin học', 'Đăk Nông - Việt Nam', 3, 0, NULL, NULL),
(5, 'httham@gmail.com', 'Hoàng Thị Thắm', 'hoangthitham', '9536686afad9da668b62647f2aeaf73b49bb32f9a9fe74485731469b6ee38eb1', '0', NULL, NULL, 'https://i.imgur.com/GWrufYw.jpg', 'https://i.imgur.com/le8HXCC.png', 99809999, 0, 'instructor', 0, 'Giáo viên Anh văn', 'Đăk Nông - Việt Nam', 5, 0, NULL, NULL),
(11, 'dothiloan111974@gmail.com', 'Đỗ Thị Loan', 'thloan406', 'b68ab1ad12d6a0bb55a06e8a203e56ac', '0359731848', NULL, NULL, 'https://i.imgur.com/b0VF3PJ.png', 'https://i.imgur.com/0aDdQyR.png', 0, 0, 'member', 0, NULL, 'Đăk Nông - Việt Nam', 0, 1, 'MgZ16JrbXFT2qB3EMms1WSMihVbm1ULSho6I6Cnc9BTm65hmgM', '::1'),
(12, 'leminhphuc172@gmail.com', 'Lê Minh Phúc', 'lminhphc865', '313e4ac6415fd333d832f3a51153c2d4', '0374842702', NULL, NULL, 'https://i.imgur.com/b0VF3PJ.png', 'https://i.imgur.com/0aDdQyR.png', 0, 0, 'member', 0, NULL, 'Đăk Nông - Việt Nam', 0, 1, 'imoiRzm5i9AjSmnG9F0LKmf28lUC28cyA7YP0tmOOC4D6nOBkv', '::1');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `webinars`
--

CREATE TABLE `webinars` (
  `id` int(10) UNSIGNED NOT NULL,
  `teacher_id` int(10) UNSIGNED NOT NULL,
  `category_id` int(10) UNSIGNED DEFAULT NULL,
  `type` enum('webinar','course','text_lesson') NOT NULL,
  `private` tinyint(1) NOT NULL DEFAULT 0,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `start_date` int(11) DEFAULT NULL,
  `duration` int(10) UNSIGNED DEFAULT NULL,
  `seo_description` varchar(255) DEFAULT NULL,
  `thumbnail` varchar(255) NOT NULL,
  `image_cover` varchar(255) NOT NULL,
  `video_demo` varchar(255) DEFAULT NULL,
  `capacity` int(10) UNSIGNED DEFAULT NULL,
  `price` int(10) UNSIGNED DEFAULT NULL,
  `discount` int(3) NOT NULL DEFAULT 0,
  `description` text DEFAULT NULL,
  `support` tinyint(1) DEFAULT 0,
  `downloadable` tinyint(1) DEFAULT 0,
  `partner_instructor` tinyint(1) DEFAULT 0,
  `subscribe` tinyint(1) DEFAULT 0,
  `message_for_reviewer` text DEFAULT NULL,
  `status` enum('active','pending','is_draft','inactive') NOT NULL,
  `user_order` int(10) NOT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) DEFAULT NULL,
  `deleted_at` int(11) DEFAULT NULL,
  `stars` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Đang đổ dữ liệu cho bảng `webinars`
--

INSERT INTO `webinars` (`id`, `teacher_id`, `category_id`, `type`, `private`, `title`, `slug`, `start_date`, `duration`, `seo_description`, `thumbnail`, `image_cover`, `video_demo`, `capacity`, `price`, `discount`, `description`, `support`, `downloadable`, `partner_instructor`, `subscribe`, `message_for_reviewer`, `status`, `user_order`, `created_at`, `updated_at`, `deleted_at`, `stars`) VALUES
(1, 1, 606, 'text_lesson', 0, 'Học Lập Trình Python', 'Learn-Python-Programming', NULL, 35, 'Learn Python Programming the Easy Way, Complete with Examples, Quizzes, Exercises and more. Learn Python 2 and Python 3.', 'https://200lab-blog.imgix.net/2023/04/Python-la-gi.png', '/store/934/hero (4).jpg', '/store/934/Python for Beginners.mp4', NULL, 5000000, 50, '<p>Whether you want to:</p><p>- build the skills you need to get your first Python programming job</p><p>- move to a more senior software developer position</p><p>- get started with Machine Learning, Data Science, Django or other hot areas that Python specialises in</p><p>- or just learn Python to be able to create your own Python apps quickly.</p><p>…then you need a solid foundation in Python programming. And this course is designed to give you those core skills, fast.</p><p>This course is aimed at complete beginners who have never programmed before, as well as existing programmers who want to increase their career options by learning Python.</p><p>The fact is, Python is one of the most popular programming languages in the world – Huge companies like Google use it in mission critical applications like Google Search.</p><p>And Python is the number one language choice for machine learning, data science and artificial intelligence. To get those high paying jobs you need an expert knowledge of Python, and that’s what you will get from this course.</p><p>By the end of the course you’ll be able to apply in confidence for Python programming jobs. And yes, this applies even if you have never programmed before. With the right skills which you will learn in this course, you can become employable and valuable in the eyes of future employers.</p><p>Here’s what a few students have told us about the course after going through it.</p><p>“I had very limited programming experience before I started this course, so I have really learned a lot from the first few sections. It has taken me from essentially zero programming skill to a level where I\'m comfortable using Python to analyze data for my lab reports, and I\'m not even halfway done the course yet. There are other courses out there which focus on data analysis, but those courses are usually targeted at people who already know how to program which is why I chose this course instead. “ – Christian DiMaria</p><p><br></p><p>“I have been puttering through your Python course . In that time, though, and without finishing it yet I\'ve been able to automate quite a bit at my work. I work in a school system and unifying data from our various student information systems can be incredibly frustrating, time consuming, and at times challenging. Using your course, I\'ve learned enough to write applications that turn massive text files into dictionaries that get \"stitched\" together like a database and output to properly formatted CSV files and then uploaded via SFTP to various systems for secure processing. Our teachers, students, and the tech department have greatly benefitted from this automation. I just wanted to drop you a note thanking you for helping me learn this skill.” – Keith Medlin</p><p><br></p><p>“This course was great. Within 3 weeks I was able to write my own database related applications.” – Theo Coenen</p><p><br></p><p>And there are many more students who love the course – check out all the reviews for yourself.</p><p>Will this course give you core python skills?</p><p>Yes it will.  There are a range of exciting opportunities for Python developers. All of them require a solid understanding of Python, and that’s what you will learn in this course.</p><p>Will the course teach me data science, machine learning and artificial intelligence?</p><p>No, it won’t do that – All of these topics are branches of Python programming.  And all of them require a solid understanding of the Python language.</p><p>Nearly all courses on these topics assume that you understand Python, and without it you will quickly become lost and confused.</p><p>This course will give you that core, solid understanding of the Python programming language.</p><p>By the end of the course you will be ready to apply for Python programming positions as well as move on to specific areas of Python, as listed above.</p><p>Why should you take this course?</p><p>There are a lot of Python courses on Udemy – Your instructors, Tim and Jean-Paul are pretty unique in that between them they have around 70 years of professional programming experience.  That’s more than a lifetime of skills you get to learn Python from.</p><p>You can enrol in the course safe in the knowledge that they are not just teachers, but professional programmers with real commercial programming experience, having worked with big companies like IBM, Mitsubishi, Fujitsu and Saab in the past.</p><p>As such you will not only be learning Python, but you will be learning industry best practices for Python programming that real employers demand. </p><p>And if that’s not enough take a read of some of the many reviews from happy students – there are around 100,000 students who have left around 19,000 reviews.</p><p>This is one of the most popular courses on Python programming on Udemy.</p><p>Student Quote: “Tim and JP are excellent teachers and are constantly answering questions and surveying students on new topics they will like to learn. This isn\'t a Python course it’s THE Python course you need.” – Sean Burger</p><p>Ready to get started, developer?</p><p>Enrol now using the “Add to Cart” button on the right, and get started on your way to creative, advanced Python brilliance. Or, take this course for a free spin using the preview feature, so you know you’re 100% certain this course is for you.</p><p>See you on the inside (hurry, your Python class is waiting!)</p><div><br></div>', 1, 0, 0, 0, 'thank you .', 'active', 100, 1624954285, 1625949854, NULL, 4),
(2010, 1, 606, 'text_lesson', 0, 'Học Lập Trình PHP', 'Learn-PHP', NULL, 35, 'Learn Python Programming the Easy Way, Complete with Examples, Quizzes, Exercises and more. Learn Python 2 and Python 3.', 'https://letdiv.com/wp-content/uploads/2021/06/php-course.jpg', '/store/934/hero (4).jpg', '/store/934/Python for Beginners.mp4', NULL, 0, 0, '  <h1>Khóa học lập trình PHP</h1>\n  <p>Xin chào!</p>\n  <p>Chào mừng bạn đến với khóa học lập trình PHP! Trong khóa học này, chúng tôi sẽ giúp bạn tìm hiểu về ngôn ngữ lập trình PHP và cung cấp cho bạn những kiến thức cần thiết để xây dựng các ứng dụng web động mạnh mẽ.</p>\n  <h2>Tại sao nên học lập trình PHP?</h2>\n  <p>PHP là một ngôn ngữ lập trình phổ biến và mạnh mẽ được sử dụng rộng rãi trong phát triển web. Với PHP, bạn có thể xây dựng các trang web động, các hệ thống quản lý nội dung (CMS), cửa hàng trực tuyến, diễn đàn, và nhiều ứng dụng web khác.</p>\n  <h2>Nội dung khóa học</h2>\n  <p>Khóa học lập trình PHP sẽ bao gồm các chủ đề sau:</p>\n  <ul>\n    <li>Cú pháp và cấu trúc cơ bản của PHP</li>\n    <li>Xử lý biến và dữ liệu trong PHP</li>\n    <li>Các loại điều kiện và vòng lặp</li>\n    <li>Hàm và mảng trong PHP</li>\n    <li>Kết nối và truy vấn cơ sở dữ liệu</li>\n    <li>Xử lý form và tương亠tác với người dùng</li>\n    <li>Xây dựng ứng dụng web đơn giản</li>\n  </ul>\n  <h2>Lợi ích của khóa học</h2>\n  <p>Khi hoàn thành khóa học lập trình PHP, bạn sẽ có được những kỹ năng cần thiết để:</p>\n  <ul>\n    <li>Phát triển các ứng dụng web động sử dụng PHP</li>\n    <li>Hiểu và áp dụng cú pháp PHP</li>\n    <li>Xử lý và lưu trữ dữ liệu trong cơ sở dữ liệu</li>\n    <li>Tương tác với người dùng thông qua form và các yêu cầu HTTP</li>\n    <li>Hiểu các khái niệm cơ bản của lập trình web</li>\n  </ul>\n  <h2>Đối tượng hướng đến</h2>\n  <p>Khóa học này dành cho những người muốn bắt đầu học lập trình PHP và xây dựng các ứng dụng web động. Không cần có kiến thức lập trình trước đây, tuy nhiên, kiến thức cơ bản về HTML và CSS sẽ là một lợi thế.</p>\n  <h2>Yêu cầu phần cứng và phần mềm</h2>\n  <p>Để tham gia khóa học, bạn cần có:</p>\n  <ul>\n    <li>Một máy tính với kết nối Internet</li>\n    <li>Một trình duyệt web (khuyến nghị sử dụng Google Chrome hoặc Mozilla Firefox)</li>\n    <li>Một trình soạn thảo mã nguồn (khuyến nghị sử dụng Sublime Text hoặc Visual Studio Code)</li>\n    <li>Một máy chủ web cục bộ như XAMPP hoặc WAMP (sẽ được hướng dẫn cài đặt trong khóa học)</li>\n  </ul>\n  <h2>Bắt đầu học</h2>\n  <p>Để tham gia khóa học lập trình PHP, vui lòng đăng ký và truy cập vào hệ thống của chúng tôi. Bạn sẽ có thể truy cập vào tất cả các bài giảng, tài liệu, và bài tập thực hành.</p>\n  <p>Cảm ơn bạn đã quan tâm đến khóa học lập trình PHP! Chúng tôi hy vọng rằng khóa học sẽ giúp bạn có được kiến thức và kỹ năng cần thiết để phát triển các ứng dụng web động.</p>\n  <p>Chúc bạn học tốt!</p>', 1, 0, 0, 0, 'thank you .', 'active', 0, 1624954285, 1625949854, NULL, 4);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `webinar_reviews`
--

CREATE TABLE `webinar_reviews` (
  `id` int(10) UNSIGNED NOT NULL,
  `webinar_id` int(10) UNSIGNED NOT NULL,
  `creator_id` int(10) UNSIGNED NOT NULL,
  `content_quality` int(10) UNSIGNED NOT NULL,
  `instructor_skills` int(10) UNSIGNED NOT NULL,
  `purchase_worth` int(10) UNSIGNED NOT NULL,
  `support_quality` int(10) UNSIGNED NOT NULL,
  `rates` char(10) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` int(10) UNSIGNED NOT NULL,
  `status` enum('pending','active') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Đang đổ dữ liệu cho bảng `webinar_reviews`
--

INSERT INTO `webinar_reviews` (`id`, `webinar_id`, `creator_id`, `content_quality`, `instructor_skills`, `purchase_worth`, `support_quality`, `rates`, `description`, `created_at`, `status`) VALUES
(20, 2006, 996, 5, 5, 5, 5, '5', 'This course is full of traveling information. I\'m so thankful for new tips that I didn\'t hear before. Thanks:)', 1626214531, 'active'),
(21, 1998, 996, 5, 5, 4, 5, '4.75', 'Definitely recommended for anyone starting out excel. If you are familiar with the basics and have only been using excel as a calculator this will help you realize how versatile it is and how to use it effectively.', 1626214590, 'active'),
(22, 1997, 996, 5, 5, 5, 5, '5', 'The course covers all the basics required along with applications which gives the learner a high level of exposure in python programming.\r\n\r\nI liked the way the course is explained ie, by showing the errors and how to correct them. This enables the learner to debug issues on his own.\r\n\r\nKeep up the good work.', 1626214647, 'active'),
(23, 1996, 996, 4, 4, 4, 4, '4', 'It\'s a nice course for who is new in Linux distribution. You may take this course for Basic Linux Literacy. Thanks to honourable instructor', 1626214731, 'active'),
(24, 1995, 996, 5, 5, 5, 5, '5', 'Very clear and entertaining course, made me feel prepared to take the next step in my journey to become a product manager! 10/10 would totally recomend.', 1626214849, 'active'),
(25, 2005, 995, 5, 4, 4, 4, '4.25', 'Has some previous experience. But wanted to further develop this knowledge and chose to do it thoroughly. So this course definitely feels right to me.', 1626232945, 'active'),
(26, 2004, 995, 2, 2, 3, 3, '2.5', 'Didn\'t have the expert deliver the information. Heavily political bashing. Full disaster and scare rather than being leveled and focused on the science.', 1626233054, 'active'),
(27, 2001, 995, 2, 3, 3, 3, '2.75', 'this last lecture about controller and routing didnt worked for me. Second page is not loading even after taking uploaded resources.', 1626233222, 'active'),
(28, 1995, 995, 3, 4, 4, 4, '3.75', 'The course is completely worth. The instructors gave practical instances and interviewed two successful PMs. In short it taught me all the necessities. The resource PDF is treasure.', 1626233313, 'active'),
(29, 1999, 995, 4, 4, 4, 3, '3.75', 'Good Course, It has good tips and information, it is important to apply these on your day-to-day to make sure that you get the best of it. Liked the summary slides.', 1626233413, 'active'),
(30, 2002, 995, 5, 5, 5, 5, '5', 'The instructor is very clear in his teaching and he makes it so simple for anyone to understand what he is teaching. I\'m glad I chose him to take this course.', 1626283457, 'active'),
(31, 2002, 979, 5, 5, 5, 5, '5', 'Personally I love fitness and wanted to gain more knowledge because I love to workout and also help people get in shape and I found the right course. It\'s amazing and I am learning a lot.', 1626283559, 'active'),
(32, 2000, 996, 5, 5, 5, 5, '5', 'Great course, concise and to the point. Realized how much time I have been wasting. Tried some of the concept mentioned in this course from other readings before but the framework provided here to create a sustainable environment/process for success was the missing piece to keep things from falling apart soon after starting.', 1626508980, 'active');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `become_instructors`
--
ALTER TABLE `become_instructors`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `become_instructors_user_id_foreign` (`user_id`) USING BTREE;

--
-- Chỉ mục cho bảng `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `parent_id` (`parent_id`) USING BTREE;

--
-- Chỉ mục cho bảng `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `comments_webinar_id_foreign` (`webinar_id`) USING BTREE,
  ADD KEY `comments_user_id_foreign` (`user_id`) USING BTREE,
  ADD KEY `comments_review_id_foreign` (`review_id`) USING BTREE,
  ADD KEY `comments_reply_id_foreign` (`reply_id`) USING BTREE;

--
-- Chỉ mục cho bảng `comments_reports`
--
ALTER TABLE `comments_reports`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `comments_reports_comment_id_foreign` (`comment_id`) USING BTREE;

--
-- Chỉ mục cho bảng `faqs`
--
ALTER TABLE `faqs`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `faqs_webinar_id_foreign` (`webinar_id`) USING BTREE,
  ADD KEY `faqs_creator_id_foreign` (`creator_id`) USING BTREE;

--
-- Chỉ mục cho bảng `files`
--
ALTER TABLE `files`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `files_webinar_id_foreign` (`webinar_id`) USING BTREE,
  ADD KEY `files_creator_id_foreign` (`creator_id`) USING BTREE;

--
-- Chỉ mục cho bảng `send_email`
--
ALTER TABLE `send_email`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `tags_webinar_id_foreign` (`webinar_id`) USING BTREE;

--
-- Chỉ mục cho bảng `text_lessons`
--
ALTER TABLE `text_lessons`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `text_lessons_creator_id_foreign` (`creator_id`) USING BTREE,
  ADD KEY `text_lessons_webinar_id_foreign` (`webinar_id`) USING BTREE;

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `webinars`
--
ALTER TABLE `webinars`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD UNIQUE KEY `webinars_slug_unique` (`slug`) USING BTREE,
  ADD KEY `webinars_teacher_id_foreign` (`teacher_id`) USING BTREE,
  ADD KEY `webinars_category_id_foreign` (`category_id`) USING BTREE,
  ADD KEY `webinars_slug_index` (`slug`) USING BTREE;

--
-- Chỉ mục cho bảng `webinar_reviews`
--
ALTER TABLE `webinar_reviews`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `webinar_reviews_webinar_id_foreign` (`webinar_id`) USING BTREE,
  ADD KEY `webinar_reviews_creator_id_foreign` (`creator_id`) USING BTREE;

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `become_instructors`
--
ALTER TABLE `become_instructors`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=612;

--
-- AUTO_INCREMENT cho bảng `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT cho bảng `comments_reports`
--
ALTER TABLE `comments_reports`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `faqs`
--
ALTER TABLE `faqs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT cho bảng `files`
--
ALTER TABLE `files`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT cho bảng `send_email`
--
ALTER TABLE `send_email`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT cho bảng `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `tags`
--
ALTER TABLE `tags`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6414;

--
-- AUTO_INCREMENT cho bảng `text_lessons`
--
ALTER TABLE `text_lessons`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT cho bảng `webinars`
--
ALTER TABLE `webinars`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2011;

--
-- AUTO_INCREMENT cho bảng `webinar_reviews`
--
ALTER TABLE `webinar_reviews`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `comments_reports`
--
ALTER TABLE `comments_reports`
  ADD CONSTRAINT `comments_reports_comment_id_foreign` FOREIGN KEY (`comment_id`) REFERENCES `comments` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
