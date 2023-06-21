-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 19, 2023 at 10:14 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cee_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_acc`
--

CREATE TABLE `admin_acc` (
  `admin_id` int(11) NOT NULL,
  `admin_user` varchar(1000) NOT NULL,
  `admin_pass` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `admin_acc`
--

INSERT INTO `admin_acc` (`admin_id`, `admin_user`, `admin_pass`) VALUES
(1, 'admin@username', 'admin@password'),
(2, 'mohamed', '1234');

-- --------------------------------------------------------

--
-- Table structure for table `course_tbl`
--

CREATE TABLE `course_tbl` (
  `cou_id` int(11) NOT NULL,
  `cou_name` varchar(1000) NOT NULL,
  `cou_created` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `course_tbl`
--

INSERT INTO `course_tbl` (`cou_id`, `cou_name`, `cou_created`) VALUES
(1, 'DATABASE', '2023-06-19 15:22:08'),
(2, 'DATA STRUCTURES', '2023-06-19 15:23:35'),
(3, 'VISUAL PROGRAMING', '2023-06-19 15:23:59'),
(4, 'PHYSICS', '2023-06-19 15:24:50');

-- --------------------------------------------------------

--
-- Table structure for table `examinee_course_tbl`
--

CREATE TABLE `examinee_course_tbl` (
  `examinee_course_id` int(11) NOT NULL,
  `examinee_id` int(11) DEFAULT NULL,
  `cou_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `examinee_course_tbl`
--

INSERT INTO `examinee_course_tbl` (`examinee_course_id`, `examinee_id`, `cou_id`) VALUES
(21, 1, 1),
(22, 1, 3),
(23, 2, 2),
(24, 2, 4),
(25, 3, 1),
(26, 3, 2),
(27, 3, 4);

-- --------------------------------------------------------

--
-- Table structure for table `examinee_tbl`
--

CREATE TABLE `examinee_tbl` (
  `exmne_id` int(11) NOT NULL,
  `exmne_fullname` varchar(1000) NOT NULL,
  `exmne_course` varchar(1000) NOT NULL,
  `exmne_gender` varchar(1000) NOT NULL,
  `exmne_birthdate` varchar(1000) NOT NULL,
  `exmne_year_level` varchar(1000) NOT NULL,
  `exmne_email` varchar(1000) NOT NULL,
  `exmne_password` varchar(1000) NOT NULL,
  `exmne_status` varchar(1000) NOT NULL DEFAULT 'active',
  `blocked` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `examinee_tbl`
--

INSERT INTO `examinee_tbl` (`exmne_id`, `exmne_fullname`, `exmne_course`, `exmne_gender`, `exmne_birthdate`, `exmne_year_level`, `exmne_email`, `exmne_password`, `exmne_status`, `blocked`) VALUES
(1, 'Mohamed Abdalla Fahem hassan', '', 'male', '2002-06-06', 'third year', 'mhmdtknlwjya185@gmail.com', '1234', 'active', 0),
(2, 'Mohamed Saad Rdawy Shehata', '', 'male', '2002-06-01', 'third year', 'sa3doni2714@gmail.com', '1234', 'active', 0),
(3, 'Abdalatif Ahmed Abdalatif Ahmed', '', 'male', '2002-06-01', 'third year', 'mohamed.drive185@gmail.com', '1234', 'active', 0);

-- --------------------------------------------------------

--
-- Table structure for table `exam_answers`
--

CREATE TABLE `exam_answers` (
  `exans_id` int(11) NOT NULL,
  `axmne_id` int(11) NOT NULL,
  `exam_id` int(11) NOT NULL,
  `quest_id` int(11) NOT NULL,
  `exans_answer` varchar(1000) NOT NULL,
  `exans_status` varchar(1000) NOT NULL DEFAULT 'new',
  `exans_created` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `exam_answers`
--

INSERT INTO `exam_answers` (`exans_id`, `axmne_id`, `exam_id`, `quest_id`, `exans_answer`, `exans_status`, `exans_created`) VALUES
(1, 1, 2, 2, 'a) First Normal Form (1NF)', 'old', '2023-06-19 18:00:17'),
(2, 1, 2, 4, 'c) A query that is nested inside another query.', 'old', '2023-06-19 18:00:17'),
(3, 1, 2, 5, 'c) AVG', 'old', '2023-06-19 18:00:17'),
(4, 1, 2, 1, 'c) INSERT', 'old', '2023-06-19 18:00:17'),
(5, 1, 2, 3, 'a) INNER JOIN', 'old', '2023-06-19 18:00:17'),
(6, 1, 2, 2, 'a) First Normal Form (1NF)', 'new', '2023-06-19 18:00:17'),
(7, 1, 2, 4, 'c) A query that is nested inside another query.', 'new', '2023-06-19 18:00:17'),
(8, 1, 2, 5, 'c) AVG', 'new', '2023-06-19 18:00:17'),
(9, 1, 2, 1, 'c) INSERT', 'new', '2023-06-19 18:00:17'),
(10, 1, 2, 3, 'a) INNER JOIN', 'new', '2023-06-19 18:00:17'),
(11, 3, 2, 2, 'a) First Normal Form (1NF)', 'old', '2023-06-19 18:15:27'),
(12, 3, 2, 5, 'c) AVG', 'old', '2023-06-19 18:15:27'),
(13, 3, 2, 1, 'c) INSERT', 'old', '2023-06-19 18:15:27'),
(14, 3, 2, 3, 'a) INNER JOIN', 'old', '2023-06-19 18:15:27'),
(15, 3, 2, 4, 'c) A query that is nested inside another query.', 'old', '2023-06-19 18:15:27'),
(16, 3, 2, 2, 'a) First Normal Form (1NF)', 'new', '2023-06-19 18:15:27'),
(17, 3, 2, 5, 'c) AVG', 'new', '2023-06-19 18:15:27'),
(18, 3, 2, 1, 'c) INSERT', 'new', '2023-06-19 18:15:27'),
(19, 3, 2, 3, 'a) INNER JOIN', 'new', '2023-06-19 18:15:27'),
(20, 3, 2, 4, 'c) A query that is nested inside another query.', 'new', '2023-06-19 18:15:27');

-- --------------------------------------------------------

--
-- Table structure for table `exam_attempt`
--

CREATE TABLE `exam_attempt` (
  `examat_id` int(11) NOT NULL,
  `exmne_id` int(11) NOT NULL,
  `exam_id` int(11) NOT NULL,
  `examat_status` varchar(1000) NOT NULL DEFAULT 'used'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `exam_attempt`
--

INSERT INTO `exam_attempt` (`examat_id`, `exmne_id`, `exam_id`, `examat_status`) VALUES
(1, 1, 2, 'used'),
(2, 3, 2, 'used');

-- --------------------------------------------------------

--
-- Table structure for table `exam_question_tbl`
--

CREATE TABLE `exam_question_tbl` (
  `eqt_id` int(11) NOT NULL,
  `exam_id` int(11) NOT NULL,
  `exam_question` varchar(1000) NOT NULL,
  `exam_ch1` varchar(1000) NOT NULL,
  `exam_ch2` varchar(1000) NOT NULL,
  `exam_ch3` varchar(1000) NOT NULL,
  `exam_ch4` varchar(1000) NOT NULL,
  `exam_answer` varchar(1000) NOT NULL,
  `exam_status` varchar(1000) NOT NULL DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `exam_question_tbl`
--

INSERT INTO `exam_question_tbl` (`eqt_id`, `exam_id`, `exam_question`, `exam_ch1`, `exam_ch2`, `exam_ch3`, `exam_ch4`, `exam_answer`, `exam_status`) VALUES
(1, 2, 'Which SQL statement is used to insert new data into a table?', 'a) UPDATE', 'b) DELETE', 'c) INSERT', 'd) SELECT', 'c) INSERT', 'active'),
(2, 2, 'Which normal form ensures that there are no repeating groups in a table?', 'a) First Normal Form (1NF)', 'b) Second Normal Form (2NF)', 'c) Third Normal Form (3NF)', 'd) Boyce-Codd Normal Form (BCNF)', 'a) First Normal Form (1NF)', 'active'),
(3, 2, 'Which join type returns only the rows that have matching values in both tables being joined?', 'a) INNER JOIN', 'b) LEFT JOIN', 'c) RIGHT JOIN', 'd) FULL JOIN', 'a) INNER JOIN', 'active'),
(4, 2, 'What is a subquery in SQL?', 'a) A query that retrieves data from multiple tables.', 'b) A query that is used to modify table data.', 'c) A query that is nested inside another query.', 'd) A query that is used to create new tables.', 'c) A query that is nested inside another query.', 'active'),
(5, 2, 'Which SQL function is used to calculate the average value of a numeric column?', 'a) COUNT', 'b) SUM', 'c) AVG', 'd) MAX', 'c) AVG', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `exam_tbl`
--

CREATE TABLE `exam_tbl` (
  `ex_id` int(11) NOT NULL,
  `cou_id` int(11) NOT NULL,
  `ex_title` varchar(1000) NOT NULL,
  `ex_time_limit` varchar(1000) NOT NULL,
  `ex_questlimit_display` int(11) NOT NULL,
  `ex_description` varchar(1000) NOT NULL,
  `published` tinyint(1) NOT NULL DEFAULT 0,
  `ex_created` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `exam_tbl`
--

INSERT INTO `exam_tbl` (`ex_id`, `cou_id`, `ex_title`, `ex_time_limit`, `ex_questlimit_display`, `ex_description`, `published`, `ex_created`) VALUES
(1, 4, 'Midterm', '30', 5, 'Midterm (Chapter1,Chapter2)', 0, '2023-06-19 15:36:02'),
(2, 1, 'Quiz', '30', 5, 'Data manipulation , Normalization techniques, Joins, subqueries, and aggregations', 0, '2023-06-19 19:42:51');

-- --------------------------------------------------------

--
-- Table structure for table `feedbacks_tbl`
--

CREATE TABLE `feedbacks_tbl` (
  `fb_id` int(11) NOT NULL,
  `exmne_id` int(11) NOT NULL,
  `fb_exmne_as` varchar(1000) NOT NULL,
  `fb_feedbacks` varchar(1000) NOT NULL,
  `fb_date` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_acc`
--
ALTER TABLE `admin_acc`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `course_tbl`
--
ALTER TABLE `course_tbl`
  ADD PRIMARY KEY (`cou_id`);

--
-- Indexes for table `examinee_course_tbl`
--
ALTER TABLE `examinee_course_tbl`
  ADD PRIMARY KEY (`examinee_course_id`),
  ADD KEY `examinee_id` (`examinee_id`),
  ADD KEY `cou_id` (`cou_id`);

--
-- Indexes for table `examinee_tbl`
--
ALTER TABLE `examinee_tbl`
  ADD PRIMARY KEY (`exmne_id`);

--
-- Indexes for table `exam_answers`
--
ALTER TABLE `exam_answers`
  ADD PRIMARY KEY (`exans_id`);

--
-- Indexes for table `exam_attempt`
--
ALTER TABLE `exam_attempt`
  ADD PRIMARY KEY (`examat_id`);

--
-- Indexes for table `exam_question_tbl`
--
ALTER TABLE `exam_question_tbl`
  ADD PRIMARY KEY (`eqt_id`);

--
-- Indexes for table `exam_tbl`
--
ALTER TABLE `exam_tbl`
  ADD PRIMARY KEY (`ex_id`);

--
-- Indexes for table `feedbacks_tbl`
--
ALTER TABLE `feedbacks_tbl`
  ADD PRIMARY KEY (`fb_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_acc`
--
ALTER TABLE `admin_acc`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `course_tbl`
--
ALTER TABLE `course_tbl`
  MODIFY `cou_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `examinee_course_tbl`
--
ALTER TABLE `examinee_course_tbl`
  MODIFY `examinee_course_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `examinee_tbl`
--
ALTER TABLE `examinee_tbl`
  MODIFY `exmne_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `exam_answers`
--
ALTER TABLE `exam_answers`
  MODIFY `exans_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `exam_attempt`
--
ALTER TABLE `exam_attempt`
  MODIFY `examat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `exam_question_tbl`
--
ALTER TABLE `exam_question_tbl`
  MODIFY `eqt_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `exam_tbl`
--
ALTER TABLE `exam_tbl`
  MODIFY `ex_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `feedbacks_tbl`
--
ALTER TABLE `feedbacks_tbl`
  MODIFY `fb_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `examinee_course_tbl`
--
ALTER TABLE `examinee_course_tbl`
  ADD CONSTRAINT `examinee_course_tbl_ibfk_1` FOREIGN KEY (`examinee_id`) REFERENCES `examinee_tbl` (`exmne_id`),
  ADD CONSTRAINT `examinee_course_tbl_ibfk_2` FOREIGN KEY (`cou_id`) REFERENCES `course_tbl` (`cou_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
