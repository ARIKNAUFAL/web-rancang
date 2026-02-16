-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 07, 2024 at 06:12 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

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
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` char(5) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` text NOT NULL,
  `email` varchar(40) NOT NULL,
  `status` enum('Active','Non-active') DEFAULT 'Active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`, `email`, `status`) VALUES
('A0008', 'kira', '$2y$10$xlXFkmgWzhzrvsjRI1FjfO5y86wpeoOCdsIUWH7jBiJsRkyi5e1qa', 'ariknaufal2003@gmail.com', 'Active'),
('A0009', 'ariknaufal', '$2y$10$elNii60NtVejlQB2rhizHOv.898WSXvDoWSkHzsMbZj0jjfaDEWnW', '9944@smkmutumalang.sch.id', 'Active'),
('A0010', 'lisalfaisal', '$2y$10$aTqXVKWn04eZjCv4/58Nk.P3QpaemNSbenGOEBSWEOHPfa7zoqw.q', 'lisalfaisal@gmail.com', 'Active');

--
-- Triggers `admin`
--
DELIMITER $$
CREATE TRIGGER `admin_a_insert` AFTER INSERT ON `admin` FOR EACH ROW BEGIN
    INSERT INTO `profile_admin`(`admin_id`, `first_name`, `last_name`, `address`, `phone_number`, `photo_profile`) VALUES (NEW.id,NEW.username,'','','','');
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` char(5) NOT NULL,
  `name` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `category`
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
-- Table structure for table `class`
--

CREATE TABLE `class` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `lesson_id` int(11) NOT NULL,
  `enroll_date` date NOT NULL DEFAULT curdate()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `class`
--

INSERT INTO `class` (`id`, `student_id`, `lesson_id`, `enroll_date`) VALUES
(5, 8, 26, '2024-02-07'),
(6, 8, 27, '2024-02-07'),
(7, 8, 29, '2024-02-07');

-- --------------------------------------------------------

--
-- Table structure for table `course_suggestion`
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
-- Dumping data for table `course_suggestion`
--

INSERT INTO `course_suggestion` (`id`, `student_id`, `admin_id`, `topic`, `message`, `status`, `date`) VALUES
(10, 8, 'A0010', 'Backend', 'saya ingin pelajaran tentang react js', 'Responded', '2024-02-07');

-- --------------------------------------------------------

--
-- Stand-in structure for view `detailed_admin`
-- (See below for the actual view)
--
CREATE TABLE `detailed_admin` (
`Fullname` varchar(31)
,`Phone Number` varchar(13)
,`Email` varchar(40)
,`Status` enum('Active','Non-active')
);

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `id` int(11) NOT NULL,
  `lesson_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `comment` varchar(10000) NOT NULL,
  `date_comment` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`id`, `lesson_id`, `student_id`, `comment`, `date_comment`) VALUES
(10, 26, 8, 'sangat bagus tutorial nya', '2024-02-07 16:08:23');

-- --------------------------------------------------------

--
-- Stand-in structure for view `inserted_lesson`
-- (See below for the actual view)
--
CREATE TABLE `inserted_lesson` (
`Lesson Name` varchar(100)
,`Category` varchar(100)
,`Inserted By` varchar(31)
);

-- --------------------------------------------------------

--
-- Table structure for table `lesson`
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
-- Dumping data for table `lesson`
--

INSERT INTO `lesson` (`id`, `admin_id`, `category_id`, `name`, `thumbnail`, `description`, `link`) VALUES
(22, 'A0009', 'C0002', 'HTML', 'images/lessons\\hHimCJcw0raWJhkneshpdck4Y7dOGDtQ6W7X4t51.png', 'HTML Tutorial for Beginners', 'https://www.youtube.com/watch?v=FQdaUv95mR8&pp=ygUbaHRtbCB0dXRvcmlhbCBmb3IgYmVnaW5uZXJz'),
(26, 'A0009', 'C0002', 'Learn CSS For Beginner', 'images/lessons\\vMpP3HkM3ZHzjrNwZAHZDYzLx0aAOMSm3zP3VMR5.png', 'In this in-depth course, you will learn about all the key features of CSS. This is the most comprehensive CSS course we\'ve published to date. So if you want to become an expert in Cascading Style Sheets, this is the course for you.', 'https://youtu.be/OXGznpKZ_sA?si=uDYs5oA4yaDvJRtR'),
(27, 'A0009', 'C0002', 'Angular', 'images/lessons\\O1c4apltod6rgwfHYVCAVXgEBnh2CPbk8ew5twxJ.png', 'Learn Angular in this complete course for beginners. First you will learn the basics of Typescript and then you will learn about important Angular concepts such as binding, dependency injection, forms, routing, and more.', 'https://youtu.be/3qBXWUpoPHo?si=Nm3QpVyZH0nVei6r'),
(28, 'A0009', 'C0003', 'Learn Java Full Course', 'images/lessons\\3aHdds6enVY1tczh7V13Y6A8wi5GMALZHQQWGjfW.png', 'Learn Java full Course In This Tutorial', 'https://www.youtube.com/watch?v=xk4_1vDrzzo&pp=ygUQamF2YSBmdWxsIGNvdXJzZQ%3D%3D'),
(29, 'A0009', 'C0003', 'Codeighniter 4', 'images/lessons\\PTMW5w25Zl1PnpdTAX9HfmDBvCLh4z2YBKKcNBVO.png', 'This is the first part of CodeIgniter 4 crud tutorials', 'https://youtu.be/FKElo_SXHK0?si=H5lUWGpO1gJcQx9o'),
(30, 'A0009', 'C0003', 'Learn PHP-DOM', 'images/lessons\\NKFLRy7meTto1WapwdhO02OUwsihV6fvmtD1vDLa.png', 'PHP and the DOM (Warren Uhrich)', 'https://youtu.be/meg5dBPgpnc?si=zpVLiHgL3gQT2q5Y'),
(31, 'A0010', 'C0005', 'Learn JavaScript', 'images/lessons\\at5ZY1ey7TRl3yFTHaRjuEojSue4BPHvX3OhXR5F.png', 'JavaScript Full Course for free', 'https://youtu.be/lfmg-EJ8gm4?si=BXDWkrm0_EBWcnQ5'),
(32, 'A0010', 'C0005', 'Learn JavaScript DOM', 'images/lessons\\yyiWtyEooOZRrVJl9fChP0bIV3BTtHD9CxyjUJBR.jpg', 'Tutorial belajar coding javascript materi dom document object model untuk pemula. Jangan lupa ada tugas menanti juga, tonton sampai habis ya', 'https://youtu.be/Y8wDTG7qjuA?si=jHsKhEYpqTStJ297'),
(33, 'A0010', 'C0005', 'Learn JSP Servlet', 'images/lessons\\kBDqjtuybX3WW2kTY4P67InkKBOoN09yeCccG2lJ.jpg', 'Introduction to Servlets', 'https://youtu.be/7TOmdDJc14s?si=lWMfbnIsS3Fuw1Ki'),
(34, 'A0010', 'C0007', 'Learn Figma Software', 'images/lessons\\wiTSh5duperGuz9aeHPAovtcfY1kxMO1RDIyM7tM.png', 'In this video, we will start creating variables!\r\n\r\nLuis will show you :\r\n\r\n1) Where variables live within a file\r\n2) How to create color, boolean, text, and number variables\r\n3) How to use modes to manage theming and densities', 'https://youtu.be/HP6Iny82NMM?si=tXqfNR8YSpwfnFvs'),
(35, 'A0010', 'C0007', 'Learn Design UI With Figma', 'images/lessons\\sRcKKiZn5RChrVY3cxJ11evwypJAejSD63BKg7Wc.png', 'Do you want to learn Figma but don’t know where to start? Well, if you follow this step-by-step tutorial, it will only take you 24 minutes to learn all the basics you need to know to start designing apps and websites in Figma.\r\n\r\nIn this Figma tutorial for beginners, UX designer Amr guides you through Figma’s interface and tools following a very valuable principle to start mastering this tool. “If you want to learn the basics, you should copy other designs”.', 'https://youtu.be/FTFaQWZBqQ8?si=85v6uJoVB15j9yOG'),
(36, 'A0010', 'C0005', 'Learn React JS', 'images/lessons\\mbPKM11If1rnfJCbSVsVNt7d3SGBNdGL8bdFV322.png', 'Setup React JS Untuk Pemula Bahasa Indonesia', 'https://youtu.be/3Jgju76gS2g?si=QVH2GC-purHQN8j1');

-- --------------------------------------------------------

--
-- Table structure for table `lesson_audit`
--

CREATE TABLE `lesson_audit` (
  `id` int(11) NOT NULL,
  `admin_id` char(5) NOT NULL,
  `audit_action` varchar(106) NOT NULL,
  `date` date NOT NULL DEFAULT curdate()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `lesson_audit`
--

INSERT INTO `lesson_audit` (`id`, `admin_id`, `audit_action`, `date`) VALUES
(45, 'A0009', 'Insert: HTML', '2024-02-07'),
(46, 'A0009', 'Insert: Learn CSS', '2024-02-07'),
(47, 'A0009', 'Insert: CSS For Beginner', '2024-02-07'),
(48, 'A0009', 'Insert: Learn CSS For Beginner', '2024-02-07'),
(49, 'A0009', 'Insert: Angular', '2024-02-07'),
(50, 'A0009', 'Insert: Lavarel Tutorial For Beginner', '2024-02-07'),
(51, 'A0009', 'Insert: Codeighniter 4', '2024-02-07'),
(52, 'A0009', 'Update: Learn Java Full Course', '2024-02-07'),
(53, 'A0009', 'Update: Codeighniter 4', '2024-02-07'),
(54, 'A0009', 'Insert: Learn PHP-DOM', '2024-02-07'),
(55, 'A0010', 'Insert: Learn JavaScript', '2024-02-07'),
(56, 'A0010', 'Insert: Learn JavaScript DOM', '2024-02-07'),
(57, 'A0010', 'Insert: Learn JSP Servlet', '2024-02-07'),
(58, 'A0010', 'Insert: Learn Figma Software', '2024-02-07'),
(59, 'A0010', 'Insert: Learn Design UI With Figma', '2024-02-07'),
(60, 'A0010', 'Insert: Learn React JS', '2024-02-07');

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

CREATE TABLE `notification` (
  `course_suggestion_id` int(11) NOT NULL,
  `message` varchar(232) NOT NULL,
  `date` date NOT NULL DEFAULT curdate(),
  `link` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `profile_admin`
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
-- Dumping data for table `profile_admin`
--

INSERT INTO `profile_admin` (`admin_id`, `first_name`, `last_name`, `address`, `phone_number`, `gender`, `photo_profile`) VALUES
('A0008', 'anselma', 'putri', 'Jl Jagakarsa', '087545329087', 'Female', '01162023025030.jpg'),
('A0009', 'ariknaufal', '', '', '', 'Male', ''),
('A0010', 'lisalfaisal', '', '', '', 'Male', '');

-- --------------------------------------------------------

--
-- Table structure for table `profile_student`
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
-- Dumping data for table `profile_student`
--

INSERT INTO `profile_student` (`student_id`, `first_name`, `last_name`, `address`, `phone_number`, `gender`, `photo_profile`) VALUES
(8, 'ariknaufal', '', '', '', 'Male', 'templateFrontend/resources/images/Default-Profile.png');

-- --------------------------------------------------------

--
-- Stand-in structure for view `request_manager`
-- (See below for the actual view)
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
-- Table structure for table `roadmap`
--

CREATE TABLE `roadmap` (
  `id` int(11) NOT NULL,
  `category_id` char(5) NOT NULL,
  `lesson_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `roadmap`
--

INSERT INTO `roadmap` (`id`, `category_id`, `lesson_id`) VALUES
(20, 'C0002', 22),
(23, 'C0002', 26),
(24, 'C0002', 27),
(25, 'C0003', 28),
(26, 'C0003', 29),
(27, 'C0003', 30),
(28, 'C0005', 31),
(29, 'C0005', 32),
(30, 'C0005', 33),
(31, 'C0007', 34),
(32, 'C0007', 35),
(33, 'C0005', 36);

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `id` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(40) NOT NULL,
  `status` enum('Active','Non-active') DEFAULT 'Active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`id`, `username`, `password`, `email`, `status`) VALUES
(8, 'ariknaufal', '$2y$10$0LDbQQqTBsexXuqcd2PeGO8iXXbifbk.ZU3TAqxA.6Ncy3Vh3K/0u', 'ariknaufal2003@gmail.com', 'Active');

--
-- Triggers `student`
--
DELIMITER $$
CREATE TRIGGER `student_a_insert` AFTER INSERT ON `student` FOR EACH ROW BEGIN
    INSERT INTO `profile_student`(`student_id`, `first_name`, `last_name`, `address`, `phone_number`) VALUES (NEW.id,NEW.username,'','','');
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Structure for view `detailed_admin`
--
DROP TABLE IF EXISTS `detailed_admin`;

CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `detailed_admin`  AS SELECT concat(`profile_admin`.`first_name`,' ',`profile_admin`.`last_name`) AS `Fullname`, `profile_admin`.`phone_number` AS `Phone Number`, `admin`.`email` AS `Email`, `admin`.`status` AS `Status` FROM (`admin` join `profile_admin` on(`profile_admin`.`admin_id` = `admin`.`id`)) ;

-- --------------------------------------------------------

--
-- Structure for view `inserted_lesson`
--
DROP TABLE IF EXISTS `inserted_lesson`;

CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `inserted_lesson`  AS SELECT `lesson`.`name` AS `Lesson Name`, `category`.`name` AS `Category`, concat(`profile_admin`.`first_name`,' ',`profile_admin`.`last_name`) AS `Inserted By` FROM ((((`admin` join `profile_admin` on(`profile_admin`.`admin_id` = `admin`.`id`)) join `lesson` on(`lesson`.`admin_id` = `admin`.`id`)) join `roadmap` on(`roadmap`.`lesson_id` = `lesson`.`id`)) join `category` on(`category`.`id` = `roadmap`.`category_id`)) ;

-- --------------------------------------------------------

--
-- Structure for view `request_manager`
--
DROP TABLE IF EXISTS `request_manager`;

CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `request_manager`  AS SELECT concat(`profile_student`.`first_name`,' ',`profile_student`.`last_name`) AS `Fullname`, `student`.`email` AS `Email`, `course_suggestion`.`topic` AS `Topic`, `course_suggestion`.`message` AS `Message`, `course_suggestion`.`status` AS `Status`, `course_suggestion`.`date` AS `Date` FROM ((`student` join `profile_student` on(`profile_student`.`student_id` = `student`.`id`)) join `course_suggestion` on(`course_suggestion`.`student_id` = `student`.`id`)) ORDER BY field(`course_suggestion`.`status`,'New','Responded','Declined') ASC ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UC_Username` (`username`),
  ADD UNIQUE KEY `UC_Email` (`email`),
  ADD UNIQUE KEY `IDX_AdminUsername` (`username`),
  ADD KEY `IDX_AdminPassword` (`password`(1024));

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UC_Name` (`name`);

--
-- Indexes for table `class`
--
ALTER TABLE `class`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_Class_Student` (`student_id`),
  ADD KEY `FK_Class_Lesson` (`lesson_id`);

--
-- Indexes for table `course_suggestion`
--
ALTER TABLE `course_suggestion`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_CourseSuggestion_Student` (`student_id`),
  ADD KEY `FK_CourseSuggestion_Admin` (`admin_id`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_Feedback_Student` (`student_id`),
  ADD KEY `FK_Feedback_Lesson` (`lesson_id`);

--
-- Indexes for table `lesson`
--
ALTER TABLE `lesson`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UC_Link` (`link`),
  ADD KEY `FK_Lesson_Admin` (`admin_id`),
  ADD KEY `IDX_LessonName` (`name`),
  ADD KEY `FK_Lesson_Category` (`category_id`);

--
-- Indexes for table `lesson_audit`
--
ALTER TABLE `lesson_audit`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_LessonAudit_Admin` (`admin_id`),
  ADD KEY `IDX_LessonAuditAuditAction` (`audit_action`);

--
-- Indexes for table `notification`
--
ALTER TABLE `notification`
  ADD PRIMARY KEY (`course_suggestion_id`),
  ADD UNIQUE KEY `UC_Link` (`link`);

--
-- Indexes for table `profile_admin`
--
ALTER TABLE `profile_admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `profile_student`
--
ALTER TABLE `profile_student`
  ADD PRIMARY KEY (`student_id`);

--
-- Indexes for table `roadmap`
--
ALTER TABLE `roadmap`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_Roadmap_Category` (`category_id`),
  ADD KEY `FK_Roadmap_lesson` (`lesson_id`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UC_Username` (`username`),
  ADD UNIQUE KEY `UC_Email` (`email`),
  ADD UNIQUE KEY `IDX_StudentUsername` (`username`),
  ADD KEY `IDX_StudentPassword` (`password`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `class`
--
ALTER TABLE `class`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `course_suggestion`
--
ALTER TABLE `course_suggestion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `lesson`
--
ALTER TABLE `lesson`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `lesson_audit`
--
ALTER TABLE `lesson_audit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `roadmap`
--
ALTER TABLE `roadmap`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `class`
--
ALTER TABLE `class`
  ADD CONSTRAINT `FK_Class_Lesson` FOREIGN KEY (`lesson_id`) REFERENCES `lesson` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_Class_Student` FOREIGN KEY (`student_id`) REFERENCES `student` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `course_suggestion`
--
ALTER TABLE `course_suggestion`
  ADD CONSTRAINT `FK_CourseSuggestion_Admin` FOREIGN KEY (`admin_id`) REFERENCES `admin` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `FK_CourseSuggestion_Student` FOREIGN KEY (`student_id`) REFERENCES `student` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `feedback`
--
ALTER TABLE `feedback`
  ADD CONSTRAINT `FK_Feedback_Lesson` FOREIGN KEY (`lesson_id`) REFERENCES `lesson` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_Feedback_Student` FOREIGN KEY (`student_id`) REFERENCES `student` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `lesson`
--
ALTER TABLE `lesson`
  ADD CONSTRAINT `FK_Lesson_Admin` FOREIGN KEY (`admin_id`) REFERENCES `admin` (`id`),
  ADD CONSTRAINT `FK_Lesson_Category` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `lesson_audit`
--
ALTER TABLE `lesson_audit`
  ADD CONSTRAINT `FK_LessonAudit_Admin` FOREIGN KEY (`admin_id`) REFERENCES `admin` (`id`);

--
-- Constraints for table `notification`
--
ALTER TABLE `notification`
  ADD CONSTRAINT `FK_Notification_CourseSuggestion` FOREIGN KEY (`course_suggestion_id`) REFERENCES `course_suggestion` (`id`);

--
-- Constraints for table `profile_admin`
--
ALTER TABLE `profile_admin`
  ADD CONSTRAINT `FK_ProfileAdmin_Admin` FOREIGN KEY (`admin_id`) REFERENCES `admin` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `profile_student`
--
ALTER TABLE `profile_student`
  ADD CONSTRAINT `FK_ProfileStudent_Student` FOREIGN KEY (`student_id`) REFERENCES `student` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `roadmap`
--
ALTER TABLE `roadmap`
  ADD CONSTRAINT `FK_Roadmap_Category` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_Roadmap_lesson` FOREIGN KEY (`lesson_id`) REFERENCES `lesson` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
