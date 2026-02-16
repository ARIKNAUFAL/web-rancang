-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 26 Jan 2023 pada 04.19
-- Versi server: 10.4.27-MariaDB
-- Versi PHP: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_course`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin`
--

CREATE TABLE `admin` (
  `id` char(5) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` text NOT NULL,
  `email` varchar(40) NOT NULL,
  `status` enum('Active','Non-active') DEFAULT 'Active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data untuk tabel `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`, `email`, `status`) VALUES
('A0001', 'ivan', 'ivan123', 'ivan@gmail.com', 'Active'),
('A0002', 'arik', 'arik123', 'arik@gmail.com', 'Active'),
('A0003', 'jono', 'jono123', 'jono@gmail.com', 'Active'),
('A0004', 'renaldi', '$2y$10$7fpc1x8h/GNKNUj8wyWfaeQve.sLi8JjoYtmzXb/1leOvBzNHJAxe', 'renaldi@gmail.com', 'Non-active'),
('A0005', 'renaldi1', '$2y$10$33nvGOddtFxbzT/nTcC2ueClsaKfC/ZAIII46USLDO579Syb0GjVK', 'renaldi1@gmail.com', 'Active'),
('A0006', 'zidan', '$2y$10$N/HZjYvqwYPNVi2AS5XlfeNh1p9Qcru6cjb4odFJ9g.Dfeu6L/MdC', 'zidan@gmail.com', 'Active'),
('A0007', 'yasmin', '$2y$10$w0.XQ1eEodS3N2E8szQtouwS/3tlHj74Tbf1ybVWE4UY4zLv/2xq2', 'yasmin@gmail.com', 'Non-active'),
('A0008', 'kira', '$2y$10$xlXFkmgWzhzrvsjRI1FjfO5y86wpeoOCdsIUWH7jBiJsRkyi5e1qa', 'ariknaufal2003@gmail.com', 'Active');

--
-- Trigger `admin`
--
DELIMITER $$
CREATE TRIGGER `admin_a_insert` AFTER INSERT ON `admin` FOR EACH ROW BEGIN
    INSERT INTO `profile_admin`(`admin_id`, `first_name`, `last_name`, `address`, `phone_number`, `photo_profile`) VALUES (NEW.id,NEW.username,'','','','');
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `category`
--

CREATE TABLE `category` (
  `id` char(5) NOT NULL,
  `name` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data untuk tabel `category`
--

INSERT INTO `category` (`id`, `name`) VALUES
('C0003', 'Back-end'),
('C0007', 'Figma'),
('C0002', 'Front-end'),
('C0001', 'Full-stack developer'),
('C0004', 'Java'),
('C0005', 'JavaScript'),
('C0006', 'PHP');

-- --------------------------------------------------------

--
-- Struktur dari tabel `class`
--

CREATE TABLE `class` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `lesson_id` int(11) NOT NULL,
  `enroll_date` date NOT NULL DEFAULT curdate()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data untuk tabel `class`
--

INSERT INTO `class` (`id`, `student_id`, `lesson_id`, `enroll_date`) VALUES
(3, 7, 5, '2023-01-24'),
(4, 7, 1, '2023-01-24');

-- --------------------------------------------------------

--
-- Struktur dari tabel `course_suggestion`
--

CREATE TABLE `course_suggestion` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `admin_id` char(5) DEFAULT NULL,
  `topic` varchar(100) NOT NULL,
  `message` varchar(200) NOT NULL,
  `status` enum('New','Responded','Declined') NOT NULL DEFAULT 'New',
  `date` date NOT NULL DEFAULT curdate()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data untuk tabel `course_suggestion`
--

INSERT INTO `course_suggestion` (`id`, `student_id`, `admin_id`, `topic`, `message`, `status`, `date`) VALUES
(7, 7, 'A0008', 'Figma', 'want to learn about design app', 'Responded', '2023-01-24'),
(8, 7, 'A0008', 'Data Structure', 'pengen', 'Declined', '2023-01-24'),
(9, 7, NULL, 'ReactJS', 'INGIN BELALAR', 'New', '2023-01-24');

-- --------------------------------------------------------

--
-- Stand-in struktur untuk tampilan `detailed_admin`
-- (Lihat di bawah untuk tampilan aktual)
--
CREATE TABLE `detailed_admin` (
`Fullname` varchar(31)
,`Phone Number` varchar(13)
,`Email` varchar(40)
,`Status` enum('Active','Non-active')
);

-- --------------------------------------------------------

--
-- Struktur dari tabel `feedback`
--

CREATE TABLE `feedback` (
  `id` int(11) NOT NULL,
  `lesson_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `comment` varchar(10000) NOT NULL,
  `date_comment` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data untuk tabel `feedback`
--

INSERT INTO `feedback` (`id`, `lesson_id`, `student_id`, `comment`, `date_comment`) VALUES
(5, 1, 7, 'bagus', '2023-01-24 01:25:38'),
(6, 1, 7, 'video nya keren', '2023-01-24 04:57:49'),
(7, 5, 7, 'k', '2023-01-26 01:41:58'),
(8, 5, 7, 'k', '2023-01-26 01:42:01'),
(9, 5, 7, 'k', '2023-01-26 01:42:03');

-- --------------------------------------------------------

--
-- Stand-in struktur untuk tampilan `inserted_lesson`
-- (Lihat di bawah untuk tampilan aktual)
--
CREATE TABLE `inserted_lesson` (
`Lesson Name` varchar(100)
,`Category` varchar(100)
,`Inserted By` varchar(31)
);

-- --------------------------------------------------------

--
-- Struktur dari tabel `lesson`
--

CREATE TABLE `lesson` (
  `id` int(11) NOT NULL,
  `admin_id` char(5) NOT NULL,
  `category_id` char(5) DEFAULT NULL,
  `name` varchar(100) NOT NULL,
  `thumbnail` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `link` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data untuk tabel `lesson`
--

INSERT INTO `lesson` (`id`, `admin_id`, `category_id`, `name`, `thumbnail`, `description`, `link`) VALUES
(1, 'A0005', 'C0002', 'Learn HTML - Full Tutorial for Beginners', 'images/lessons/Z47mlCbEjocxecPlMDvwY73DM7sJvYMBqfg6Ndfa.png', 'Learn HTML in this complete course for beginners. This is an all-in-one beginner tutorial to help you learn web development skills. This course teaches HTML5.', 'https://www.youtube.com/watch?v=kUMe1FH4CHE'),
(2, 'A0008', 'C0002', 'JavaScript DOM', 'images/lessons/C3Q0e32h12B4UjbvtRPY3ByX3hWtzECF0ELSgfQc.png', 'Hey gang, welcome to your very first JavaScript DOM tutorial. In this tutorial Ill explain exactly what the DOM is (document object model) and how we can use it in JavaScript to interact with web pages in the browser.', 'https://www.youtube.com/watch?v=FIORjGvT0kk&list=PL4cUxeGkcC9gfoKa5la9dsdCNpuey2s-V'),
(5, 'A0008', 'C0003', 'Basic Golang', 'images/lessons\\GW1YUk7wvfwvjOQZpkfZmPd55UQbarORHNWpQg9U.png', 'Learn basic golang', 'https://www.youtube.com/watch?v=YS4e4q9oBaU'),
(7, 'A0005', 'C0003', 'Python', 'images/lessons\\NO5ck3gkNsnylazn8F3taQ4lpvXb9b7MCDX44Rjp.jpg', 'https://www.youtube.com/watch?v=kqtD5dpn9C8', 'https://www.youtube.com/watch?v=kqtD5dpn9C8'),
(8, 'A0008', 'C0003', 'Ruby', 'images/lessons\\TVYmjokdVblu79TYarsBZTRVQROrwFf6KtdlZo1S.jpg', 'Ruby in 100 Seconds', 'https://www.youtube.com/watch?v=UYm0kfnRTJk'),
(9, 'A0008', 'C0003', 'Database Management Systems', 'images/lessons\\NGCh69Nsu5tabvZ8uGKVxyiQ11YLtOhbQ479Y3G9.png', 'Introduction To Database Management', 'https://www.youtube.com/watch?v=ztHopE5Wnpc'),
(10, 'A0008', 'C0002', 'Git & Github', 'images/lessons\\Ljm7oR9jPWvI7w29mGZUqvOWqlJ2eD5a4q2tYvrT.png', 'Learn Git&Hub Tools', 'https://www.youtube.com/watch?v=RGOj5yH7evk'),
(11, 'A0008', 'C0002', 'CSS Tutorial For Beginners', 'images/lessons\\8SH7l5rhO0lPZaoujNK1RfSG5QsR5VtO6RmRvT4x.png', 'In this in-depth course, you will learn about all the key features of CSS. This is the most comprehensive CSS course we\'ve published to date. So if you want to become an expert in Cascading Style Sheets, this is the course for you.', 'https://www.youtube.com/watch?v=OXGznpKZ_sA'),
(12, 'A0008', 'C0002', 'JavaScript Tutorial For Beginners', 'images/lessons\\LZBPGkTtLR2xR7j4HScgB0nMVi0SirRc4xetZmbq.png', 'This complete 134-part JavaScript tutorial for beginners will teach you everything you need to know to get started with the JavaScript programming language.', 'https://www.youtube.com/watch?v=PkZNo7MFNFg'),
(13, 'A0008', 'C0002', 'JavaScript DOM', 'images/lessons\\3aVWxH1r998Bm3iWmwMQdepHmriLoyZvZk9hjxiE.jpg', 'Learn about JavaScript DOM manipulation in this beginner\'s tutorial. This is when you use JavaScript to add, remove, and modify elements of a website. \r\n\r\nIn the first part of the course, you will learn about the basic features of a website DOM and the JavaScript commands you can use to manipulate the DOM. In the second part of the course, you will use what you have learned to create practical examples ranging from beginner to advanced.', 'https://youtu.be/5fb2aPlgoys'),
(14, 'A0008', 'C0006', 'PHP For Beginnners', 'images/lessons\\FF9NiGqXTrW3ar9i5W0iLQhGTwhg3tRpN32zGbzN.png', 'Your first step in learning PHP. We will go over all of the fundamentals and create a small PHP/MySQL project.', 'https://www.youtube.com/watch?v=BUCiSSyIGGU'),
(15, 'A0008', 'C0006', 'PHP OOP', 'images/lessons\\usrw6T7pDaOTETzm4dmUS8EAHSATKw6SK0trUwTn.png', 'Setelah belajar PHP Dasar, saatnya kita belajar PHP Object Oriented Programming (PHP Pemrograman Berorientasi Objek). OOP adalah sudut pandang dalam bahasa pemrograman yang sangat populer. OOP wajib dimengerti jika kita ingin lebih baik lagi menjadi programmer PHP, terutama saat ini kebanyakan library dan framework di PHP sudah menggunakan OOP', 'https://www.youtube.com/watch?v=_P2t0lCzU-Q'),
(16, 'A0008', 'C0001', 'MySQL - Database', 'images/lessons\\qv3Ss7ScnViYz5EW7iLpXAnHLk8NhqS26uhQloIQ.jpg', 'Di video kali ini, saya akan bahas tentang belajar database MySQL, salah satu database relational yang paling populer di dunia. Di video ini kita akan banyak belajar tentang perintah SQL di MySQL dari pembuatan database, table dan manipulasi data di MySQL. Tak lupa kita juga akan belajar tentang relational, foreign key, join table, dan lain-lain.', 'https://www.youtube.com/watch?v=xYBclb-sYQ4'),
(17, 'A0008', 'C0004', 'Java Full Course', 'images/lessons\\p1SbIWHvzOnSYGzt4y2sWI9P20VkXdUE92i3d6Ae.png', 'Java Full Course', 'https://www.youtube.com/watch?v=xk4_1vDrzzo'),
(18, 'A0008', 'C0001', 'Browser Developer Tools', 'images/lessons\\x37jrtpjs5QLpXQ6K5Pdq5kUH6WQyLGifWiF63jV.jpg', 'Demystifying the Browser Networking Tab in Developer Tools With Examples', 'https://www.youtube.com/watch?v=LBgfSwX4GDI'),
(19, 'A0008', 'C0001', 'Testing/Debugging', 'images/lessons\\4L0qxw70NDy6OeFfAxeBXSWxVk6HMsYGRGGwUQMm.png', 'What is Testing | What is Debugging | Testing in Nutshell | Neeraj Kumar Singh', 'https://www.youtube.com/watch?v=BW2TtfcK-1A'),
(20, 'A0008', 'C0001', 'Command Line', 'images/lessons\\Nq7ZKN7u3Jrm2KSk8OYj6rh5gfjY4TZKiihhjaDe.png', '40 Windows Commands you NEED to know (in 10 Minutes)', 'https://www.youtube.com/watch?v=Jfvg3CS1X3A'),
(21, 'A0008', 'C0003', 'Figma', 'images/lessons\\DoRU8AYa3UP9IZytG3qDfjN9JCKuRdATpMqfFort.png', 'Figma UI Design Tutorial: Get Started (2022)', 'https://www.youtube.com/watch?v=NA7LoY23MlA');

-- --------------------------------------------------------

--
-- Struktur dari tabel `lesson_audit`
--

CREATE TABLE `lesson_audit` (
  `id` int(11) NOT NULL,
  `admin_id` char(5) NOT NULL,
  `audit_action` varchar(106) NOT NULL,
  `date` date NOT NULL DEFAULT curdate()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data untuk tabel `lesson_audit`
--

INSERT INTO `lesson_audit` (`id`, `admin_id`, `audit_action`, `date`) VALUES
(1, 'A0001', 'Insert: Learn HTML - Full Tutorial for Beginners', '2023-01-07'),
(8, 'A0005', 'Insert : ReactJS category', '2023-01-20'),
(9, 'A0005', 'Update : from ReactJS to JEST category', '2023-01-20'),
(10, 'A0005', 'Insert: Intro to Laravel', '2023-01-23'),
(11, 'A0005', 'Update: Intro to Laravel2', '2023-01-23'),
(12, 'A0005', 'Update: Intro to Laravel2', '2023-01-23'),
(13, 'A0005', 'Update: Intro to Laravel2', '2023-01-23'),
(14, 'A0005', 'Update: Intro to Laravel2', '2023-01-23'),
(15, 'A0005', 'Insert : lara category', '2023-01-23'),
(16, 'A0005', 'Update : from lara to lara2 category', '2023-01-23'),
(17, 'A0005', 'Update: Learn HTML - Full Tutorial for Beginners', '2023-01-23'),
(18, 'A0005', 'Update: JavaScript DOM', '2023-01-23'),
(19, 'A0005', 'Insert: Basic Golang', '2023-01-23'),
(20, 'A0005', 'Insert: Symfony Basic', '2023-01-23'),
(21, 'A0005', 'Update: Symfony Advanced', '2023-01-23'),
(22, 'A0005', 'Update: Symfony Advanced', '2023-01-23'),
(23, 'A0005', 'Update: Basic Golang', '2023-01-24'),
(24, 'A0005', 'Insert: Python', '2023-01-24'),
(25, 'A0008', 'Insert: Ruby', '2023-01-24'),
(26, 'A0008', 'Insert: Database Management Systems', '2023-01-24'),
(27, 'A0008', 'Insert: Git & Github', '2023-01-24'),
(28, 'A0008', 'Insert: CSS Tutorial For Beginners', '2023-01-24'),
(29, 'A0008', 'Insert: JavaScript Tutorial For Beginners', '2023-01-24'),
(30, 'A0008', 'Insert: JavaScript DOM', '2023-01-24'),
(31, 'A0008', 'Update: JavaScript DOM', '2023-01-24'),
(32, 'A0008', 'Insert: PHP For Beginnners', '2023-01-24'),
(33, 'A0008', 'Insert: PHP OOP', '2023-01-24'),
(34, 'A0008', 'Insert: MySQL - Database', '2023-01-24'),
(35, 'A0008', 'Insert: Java Full Course', '2023-01-24'),
(36, 'A0008', 'Update: Ruby', '2023-01-24'),
(37, 'A0008', 'Update: Basic Golang', '2023-01-24'),
(38, 'A0008', 'Insert: Browser Developer Tools', '2023-01-24'),
(39, 'A0008', 'Insert: Testing/Debugging', '2023-01-24'),
(40, 'A0008', 'Update: Testing/Debugging', '2023-01-24'),
(41, 'A0008', 'Insert: Command Line', '2023-01-24'),
(42, 'A0008', 'Update: MySQL - Database', '2023-01-24'),
(43, 'A0008', 'Insert: Figma', '2023-01-24'),
(44, 'A0008', 'Insert : Figma category', '2023-01-24');

-- --------------------------------------------------------

--
-- Struktur dari tabel `notification`
--

CREATE TABLE `notification` (
  `course_suggestion_id` int(11) NOT NULL,
  `message` varchar(232) NOT NULL,
  `date` date NOT NULL DEFAULT curdate(),
  `link` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `profile_admin`
--

CREATE TABLE `profile_admin` (
  `admin_id` char(5) NOT NULL,
  `first_name` varchar(15) DEFAULT NULL,
  `last_name` varchar(15) DEFAULT NULL,
  `address` varchar(30) DEFAULT NULL,
  `phone_number` varchar(13) DEFAULT NULL,
  `gender` enum('Male','Female') DEFAULT 'Male',
  `photo_profile` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data untuk tabel `profile_admin`
--

INSERT INTO `profile_admin` (`admin_id`, `first_name`, `last_name`, `address`, `phone_number`, `gender`, `photo_profile`) VALUES
('A0001', 'M. Ivan', 'Ra\'is', 'JL TANGERANG NO.18', '323902482', 'Male', 'ivan-photo.jpg'),
('A0002', 'Arik', 'Naufal', 'JL BEKASI NO.18', '31253125', 'Male', 'arik-photo.jpg'),
('A0003', 'jono', '', '', NULL, 'Male', ''),
('A0004', 'renaldi', '', '', '', 'Male', ''),
('A0005', 'renaldinasa', 'adama', 'Bekasi', '089898787', 'Male', '01202023024634.jpg'),
('A0006', 'zidan', 'muhammad', 'jakarta', '082142314409', 'Male', '01162023012347.png'),
('A0007', 'yasmin', '', '', '', 'Male', ''),
('A0008', 'anselma', 'putri', 'Jl Jagakarsa', '087545329087', 'Female', '01162023025030.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `profile_student`
--

CREATE TABLE `profile_student` (
  `student_id` int(11) NOT NULL,
  `first_name` varchar(15) NOT NULL,
  `last_name` varchar(15) NOT NULL,
  `address` varchar(30) NOT NULL,
  `phone_number` varchar(13) NOT NULL,
  `gender` enum('Male','Female') NOT NULL DEFAULT 'Male',
  `photo_profile` varchar(255) DEFAULT 'templateFrontend/resources/images/Default-Profile.png'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data untuk tabel `profile_student`
--

INSERT INTO `profile_student` (`student_id`, `first_name`, `last_name`, `address`, `phone_number`, `gender`, `photo_profile`) VALUES
(1, 'Raniya', 'Maryam', 'Jl. Random', '23456789', 'Female', 'raniya-photo.png'),
(2, 'Yudha', 'Ardhana', 'Jl. Nusa Indah', '34567890', 'Male', 'templateFrontend/resources/images/Default-Profile.png	'),
(3, 'jamal', '', '', '', 'Male', 'templateFrontend/resources/images/Default-Profile.png	'),
(7, 'habib', 'riziq', 'bekasi', '082142314409', 'Male', 'images/profiles\\r6hzeBX2Sdgp1cB9cZv5tp0zEO4jc8zr1lptsFTV.jpg');

-- --------------------------------------------------------

--
-- Stand-in struktur untuk tampilan `request_manager`
-- (Lihat di bawah untuk tampilan aktual)
--
CREATE TABLE `request_manager` (
`Fullname` varchar(31)
,`Email` varchar(40)
,`Topic` varchar(100)
,`Message` varchar(200)
,`Status` enum('New','Responded','Declined')
,`Date` date
);

-- --------------------------------------------------------

--
-- Struktur dari tabel `roadmap`
--

CREATE TABLE `roadmap` (
  `id` int(11) NOT NULL,
  `category_id` char(5) NOT NULL,
  `lesson_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data untuk tabel `roadmap`
--

INSERT INTO `roadmap` (`id`, `category_id`, `lesson_id`) VALUES
(1, 'C0002', 1),
(2, 'C0002', 2),
(3, 'C0003', 5),
(5, 'C0003', 7),
(6, 'C0003', 8),
(7, 'C0003', 9),
(8, 'C0002', 10),
(9, 'C0002', 11),
(10, 'C0002', 12),
(11, 'C0002', 13),
(12, 'C0006', 14),
(13, 'C0006', 15),
(14, 'C0001', 16),
(15, 'C0004', 17),
(16, 'C0001', 18),
(17, 'C0001', 19),
(18, 'C0001', 20),
(19, 'C0003', 21);

-- --------------------------------------------------------

--
-- Struktur dari tabel `student`
--

CREATE TABLE `student` (
  `id` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(40) NOT NULL,
  `status` enum('Active','Non-active') DEFAULT 'Active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data untuk tabel `student`
--

INSERT INTO `student` (`id`, `username`, `password`, `email`, `status`) VALUES
(1, 'raniya', 'raniya123', 'raniya@gmail.com', 'Active'),
(2, 'yudha', 'yudha123', 'yudha@gmail.com', 'Active'),
(3, 'jamal', 'jamal123', 'jamal@gmail.com', 'Active'),
(7, 'ariknaufal', '$2y$10$SVemzsm7mhpL3rxklbqcfuNaW0u74vRI9TraepZD1zKMcG03j8r8y', 'ariknaufal2003@gmail.com', 'Active');

--
-- Trigger `student`
--
DELIMITER $$
CREATE TRIGGER `student_a_insert` AFTER INSERT ON `student` FOR EACH ROW BEGIN
    INSERT INTO `profile_student`(`student_id`, `first_name`, `last_name`, `address`, `phone_number`) VALUES (NEW.id,NEW.username,'','','');
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur untuk view `detailed_admin`
--
DROP TABLE IF EXISTS `detailed_admin`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `detailed_admin`  AS SELECT concat(`profile_admin`.`first_name`,' ',`profile_admin`.`last_name`) AS `Fullname`, `profile_admin`.`phone_number` AS `Phone Number`, `admin`.`email` AS `Email`, `admin`.`status` AS `Status` FROM (`admin` join `profile_admin` on(`profile_admin`.`admin_id` = `admin`.`id`))  ;

-- --------------------------------------------------------

--
-- Struktur untuk view `inserted_lesson`
--
DROP TABLE IF EXISTS `inserted_lesson`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `inserted_lesson`  AS SELECT `lesson`.`name` AS `Lesson Name`, `category`.`name` AS `Category`, concat(`profile_admin`.`first_name`,' ',`profile_admin`.`last_name`) AS `Inserted By` FROM ((((`admin` join `profile_admin` on(`profile_admin`.`admin_id` = `admin`.`id`)) join `lesson` on(`lesson`.`admin_id` = `admin`.`id`)) join `roadmap` on(`roadmap`.`lesson_id` = `lesson`.`id`)) join `category` on(`category`.`id` = `roadmap`.`category_id`))  ;

-- --------------------------------------------------------

--
-- Struktur untuk view `request_manager`
--
DROP TABLE IF EXISTS `request_manager`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `request_manager`  AS SELECT concat(`profile_student`.`first_name`,' ',`profile_student`.`last_name`) AS `Fullname`, `student`.`email` AS `Email`, `course_suggestion`.`topic` AS `Topic`, `course_suggestion`.`message` AS `Message`, `course_suggestion`.`status` AS `Status`, `course_suggestion`.`date` AS `Date` FROM ((`student` join `profile_student` on(`profile_student`.`student_id` = `student`.`id`)) join `course_suggestion` on(`course_suggestion`.`student_id` = `student`.`id`)) ORDER BY field(`course_suggestion`.`status`,'New','Responded','Declined') ASC  ;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UC_Username` (`username`),
  ADD UNIQUE KEY `UC_Email` (`email`),
  ADD UNIQUE KEY `IDX_AdminUsername` (`username`),
  ADD KEY `IDX_AdminPassword` (`password`(1024));

--
-- Indeks untuk tabel `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UC_Name` (`name`);

--
-- Indeks untuk tabel `class`
--
ALTER TABLE `class`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_Class_Student` (`student_id`),
  ADD KEY `FK_Class_Lesson` (`lesson_id`);

--
-- Indeks untuk tabel `course_suggestion`
--
ALTER TABLE `course_suggestion`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_CourseSuggestion_Student` (`student_id`),
  ADD KEY `FK_CourseSuggestion_Admin` (`admin_id`);

--
-- Indeks untuk tabel `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_Feedback_Student` (`student_id`),
  ADD KEY `FK_Feedback_Lesson` (`lesson_id`);

--
-- Indeks untuk tabel `lesson`
--
ALTER TABLE `lesson`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UC_Link` (`link`),
  ADD KEY `FK_Lesson_Admin` (`admin_id`),
  ADD KEY `IDX_LessonName` (`name`),
  ADD KEY `FK_Lesson_Category` (`category_id`);

--
-- Indeks untuk tabel `lesson_audit`
--
ALTER TABLE `lesson_audit`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_LessonAudit_Admin` (`admin_id`),
  ADD KEY `IDX_LessonAuditAuditAction` (`audit_action`);

--
-- Indeks untuk tabel `notification`
--
ALTER TABLE `notification`
  ADD PRIMARY KEY (`course_suggestion_id`),
  ADD UNIQUE KEY `UC_Link` (`link`);

--
-- Indeks untuk tabel `profile_admin`
--
ALTER TABLE `profile_admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indeks untuk tabel `profile_student`
--
ALTER TABLE `profile_student`
  ADD PRIMARY KEY (`student_id`);

--
-- Indeks untuk tabel `roadmap`
--
ALTER TABLE `roadmap`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_Roadmap_Category` (`category_id`),
  ADD KEY `FK_Roadmap_lesson` (`lesson_id`);

--
-- Indeks untuk tabel `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UC_Username` (`username`),
  ADD UNIQUE KEY `UC_Email` (`email`),
  ADD UNIQUE KEY `IDX_StudentUsername` (`username`),
  ADD KEY `IDX_StudentPassword` (`password`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `class`
--
ALTER TABLE `class`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `course_suggestion`
--
ALTER TABLE `course_suggestion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `feedback`
--
ALTER TABLE `feedback`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `lesson`
--
ALTER TABLE `lesson`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT untuk tabel `lesson_audit`
--
ALTER TABLE `lesson_audit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT untuk tabel `roadmap`
--
ALTER TABLE `roadmap`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT untuk tabel `student`
--
ALTER TABLE `student`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `class`
--
ALTER TABLE `class`
  ADD CONSTRAINT `FK_Class_Lesson` FOREIGN KEY (`lesson_id`) REFERENCES `lesson` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_Class_Student` FOREIGN KEY (`student_id`) REFERENCES `student` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `course_suggestion`
--
ALTER TABLE `course_suggestion`
  ADD CONSTRAINT `FK_CourseSuggestion_Admin` FOREIGN KEY (`admin_id`) REFERENCES `admin` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `FK_CourseSuggestion_Student` FOREIGN KEY (`student_id`) REFERENCES `student` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `feedback`
--
ALTER TABLE `feedback`
  ADD CONSTRAINT `FK_Feedback_Lesson` FOREIGN KEY (`lesson_id`) REFERENCES `lesson` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_Feedback_Student` FOREIGN KEY (`student_id`) REFERENCES `student` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `lesson`
--
ALTER TABLE `lesson`
  ADD CONSTRAINT `FK_Lesson_Admin` FOREIGN KEY (`admin_id`) REFERENCES `admin` (`id`),
  ADD CONSTRAINT `FK_Lesson_Category` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`) ON DELETE SET NULL;

--
-- Ketidakleluasaan untuk tabel `lesson_audit`
--
ALTER TABLE `lesson_audit`
  ADD CONSTRAINT `FK_LessonAudit_Admin` FOREIGN KEY (`admin_id`) REFERENCES `admin` (`id`);

--
-- Ketidakleluasaan untuk tabel `notification`
--
ALTER TABLE `notification`
  ADD CONSTRAINT `FK_Notification_CourseSuggestion` FOREIGN KEY (`course_suggestion_id`) REFERENCES `course_suggestion` (`id`);

--
-- Ketidakleluasaan untuk tabel `profile_admin`
--
ALTER TABLE `profile_admin`
  ADD CONSTRAINT `FK_ProfileAdmin_Admin` FOREIGN KEY (`admin_id`) REFERENCES `admin` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `profile_student`
--
ALTER TABLE `profile_student`
  ADD CONSTRAINT `FK_ProfileStudent_Student` FOREIGN KEY (`student_id`) REFERENCES `student` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `roadmap`
--
ALTER TABLE `roadmap`
  ADD CONSTRAINT `FK_Roadmap_Category` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_Roadmap_lesson` FOREIGN KEY (`lesson_id`) REFERENCES `lesson` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
