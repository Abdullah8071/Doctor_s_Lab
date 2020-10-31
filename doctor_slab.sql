-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 31, 2020 at 09:45 PM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.2.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `doctor'slab`
--

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE `course` (
  `course_id` int(11) NOT NULL,
  `course_name` varchar(100) NOT NULL,
  `course_instructor` varchar(50) NOT NULL,
  `course_fee` int(11) NOT NULL,
  `course_description` text NOT NULL,
  `starting_date` varchar(11) NOT NULL,
  `course_cover_image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`course_id`, `course_name`, `course_instructor`, `course_fee`, `course_description`, `starting_date`, `course_cover_image`) VALUES
(1, 'C', 'Shehzad', 1000, 'C is a general-purpose, procedural computer programming language supporting structured programming, lexical variable scope, and recursion, with a static type system. \r\n\r\nBy design, C provides constructs that map efficiently to typical machine instructions.', '2020-10-15', 'C_Language.jpg'),
(2, 'C++', 'Nauman Atique', 1500, 'C++ is a cross-platform language that can be used to create high-performance applications. \r\nC++ was developed by Bjarne Stroustrup, as an extension to the C language. \r\nC++ gives programmers a high level of control over system resources and memory.', '2020-10-25', 'C++_Language.jpg'),
(3, 'Java', 'M. Rafi', 2000, 'Java is a popular programming language, created in 1995. It is owned by Oracle, and more than 3 billion devices run Java. It is used for: Mobile applications (specially Android apps) Desktop applications.\r\n\r\nJava is a popular programming language, created in 1995. It is owned by Oracle, and more than 3 billion devices run Java. It is used for: Mobile applications (specially Android apps) Desktop applications.', '2020-10-15', 'Java_Language.png'),
(5, 'Hala Madrid', 'NAveed', 4000, 'https://meet.google.com/ayv-vnvr-zjp', '2020-10-31', 'images_(1).jpg');

-- --------------------------------------------------------

--
-- Table structure for table `course_content`
--

CREATE TABLE `course_content` (
  `course_content_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `course_name` varchar(100) NOT NULL,
  `course_day` varchar(10) NOT NULL,
  `lecture_name` varchar(100) NOT NULL,
  `zoom_link` varchar(300) NOT NULL,
  `video_1_name` varchar(100) NOT NULL,
  `video_1` varchar(100) NOT NULL,
  `video_2_name` varchar(100) NOT NULL,
  `video_2` varchar(100) NOT NULL,
  `video_3_name` varchar(100) NOT NULL,
  `video_3` varchar(100) NOT NULL,
  `video_4_name` varchar(100) NOT NULL,
  `video_4` varchar(100) NOT NULL,
  `video_5_name` varchar(100) NOT NULL,
  `video_5` varchar(100) NOT NULL,
  `lecture_document` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `course_content`
--

INSERT INTO `course_content` (`course_content_id`, `course_id`, `course_name`, `course_day`, `lecture_name`, `zoom_link`, `video_1_name`, `video_1`, `video_2_name`, `video_2`, `video_3_name`, `video_3`, `video_4_name`, `video_4`, `video_5_name`, `video_5`, `lecture_document`) VALUES
(1, 5, 'Hala Madrid', 'Day_1', 'Pointers', 'https://meet.google.com/ayv-vn', 'abdill', 'videoplayback_(1).mp4', '', '', '', '', '', '', '', '', 'PakRailTicket.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `Username` varchar(20) NOT NULL,
  `Password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`Username`, `Password`) VALUES
('admin', '46f86faa6bbf9ac94a7e459509a20ed0');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `fullname` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `phone` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `fullname`, `email`, `password`, `phone`) VALUES
(2, 'Abdullah Qadri', 'abdullahqadri13@gmail.com', 'ee11cbb19052e40b07aac0ca060c23ee', '013231233');

-- --------------------------------------------------------

--
-- Table structure for table `user_reg_courses`
--

CREATE TABLE `user_reg_courses` (
  `user_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `subscription_status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_reg_courses`
--

INSERT INTO `user_reg_courses` (`user_id`, `course_id`, `subscription_status`) VALUES
(2, 2, 1),
(2, 5, 1),
(3, 2, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `course`
--
ALTER TABLE `course`
  ADD PRIMARY KEY (`course_id`);

--
-- Indexes for table `course_content`
--
ALTER TABLE `course_content`
  ADD PRIMARY KEY (`course_content_id`),
  ADD KEY `course_id` (`course_id`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`Username`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `user_reg_courses`
--
ALTER TABLE `user_reg_courses`
  ADD PRIMARY KEY (`user_id`,`course_id`),
  ADD KEY `course_id` (`course_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `course_content`
--
ALTER TABLE `course_content`
  ADD CONSTRAINT `course_content_ibfk_1` FOREIGN KEY (`course_id`) REFERENCES `course` (`course_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user_reg_courses`
--
ALTER TABLE `user_reg_courses`
  ADD CONSTRAINT `user_reg_courses_ibfk_1` FOREIGN KEY (`course_id`) REFERENCES `course` (`course_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
