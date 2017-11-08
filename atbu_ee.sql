-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 17, 2015 at 12:54 PM
-- Server version: 5.5.8
-- PHP Version: 5.3.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `atbu_ee`
--

-- --------------------------------------------------------

--
-- Table structure for table `academic_staff`
--

CREATE TABLE IF NOT EXISTS `academic_staff` (
  `user_id` int(5) NOT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `office` varchar(150) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `rank` varchar(100) DEFAULT NULL,
  `primary_teaching` varchar(100) DEFAULT NULL,
  `research` varchar(150) DEFAULT NULL,
  `education` text,
  `biography` text,
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `academic_staff`
--

INSERT INTO `academic_staff` (`user_id`, `phone`, `office`, `email`, `rank`, `primary_teaching`, `research`, `education`, `biography`) VALUES
(9, NULL, NULL, NULL, 'Professor/Coordinator EEP', NULL, NULL, NULL, NULL),
(10, NULL, NULL, NULL, 'Professor/ Director, EMDC', NULL, NULL, NULL, NULL),
(11, NULL, NULL, NULL, 'Professor/Coordinator C&amp;CP', NULL, NULL, NULL, NULL),
(12, NULL, NULL, NULL, 'Professor/ Coordinator MSP', NULL, NULL, 'BEng, MEng.PhD', NULL),
(13, NULL, NULL, NULL, 'Professor/ Director, ICT', NULL, NULL, 'BEng, MSc.PhD', NULL),
(14, NULL, NULL, NULL, 'Professor', NULL, NULL, 'BEng, MSc.PhD', NULL),
(15, NULL, NULL, NULL, 'Reader/PG Coordinator', NULL, NULL, 'BEng, MEng.PhD', NULL),
(16, NULL, NULL, NULL, 'Senior Lecturer/ Ass PG Coordinator', NULL, NULL, 'BEng, MSc.PhD', NULL),
(17, NULL, NULL, NULL, 'Senior Lecturer', NULL, NULL, 'BEng, MSc.PhD', NULL),
(18, NULL, NULL, NULL, 'Senior Lecturer/PGD Coordinator', NULL, NULL, 'BEng, MEng.', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `access_level`
--

CREATE TABLE IF NOT EXISTS `access_level` (
  `level_id` int(1) NOT NULL,
  `access_level` varchar(20) NOT NULL,
  PRIMARY KEY (`level_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `access_level`
--

INSERT INTO `access_level` (`level_id`, `access_level`) VALUES
(1, 'Administrator'),
(2, 'user');

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE IF NOT EXISTS `courses` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `level` varchar(20) NOT NULL,
  `semester` int(1) NOT NULL,
  `course_code` varchar(10) NOT NULL,
  `course_title` varchar(120) NOT NULL,
  `cu` varchar(5) NOT NULL,
  `pre_requisite` varchar(10) NOT NULL DEFAULT '-',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=114 ;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `level`, `semester`, `course_code`, `course_title`, `cu`, `pre_requisite`) VALUES
(1, '100', 1, 'MTH111', 'Elementary Algebra I', '3', '-'),
(2, '100', 1, 'MTH112', 'Calculus I', '3', '-'),
(3, '100', 1, 'PHY171', 'Basic Experimental Physics I', '1', ''),
(4, '100', 1, 'PHY183', 'Introductory Mechanics & Properties of Matter', '3', '-'),
(5, '100', 1, 'PHY184', 'Introductory Heat and Sound', '3', '-'),
(6, '100', 1, 'CHM101', 'Foundation Chemistry I', '4', '-'),
(7, '100', 1, 'GNS101', 'Use of English I', '2', '-'),
(8, '100', 1, 'GNS201', 'Library and Information Science ', '2', '-'),
(9, '100', 2, 'MTH121', 'Elementary Algebra II', '4', '-'),
(10, '100', 2, 'MTH122', 'Calculus II', '4', '-'),
(11, '100', 2, 'PHY172', 'Basic Experimental Physics II', '1', '-'),
(12, '100', 2, 'PHY188', 'Introductory Electricity & Magnetism', '3', '-'),
(13, '100', 2, 'CHM102', 'Foundation Chemistry II', '4', '-'),
(14, '100', 2, 'GNS102', 'Use of English II', '2', '-'),
(15, '100', 2, 'GNS202', 'Nigerian Peoples & Culture in the Context of African History', '2', '-'),
(16, '100', 2, 'CS142', 'Introductory Computer Science', '3', '-'),
(17, '200', 1, 'CE211', 'Strength of Materials I', '2', '-'),
(18, '200', 1, 'EE211', 'Electrical Engineering \nFundamentals I\n', '3', '-'),
(19, '200', 1, 'ME211', 'Engineering Mechanics I', '2', ''),
(20, '200', 1, 'ME212', 'Engineering Drawing I', '2', '-'),
(21, '200', 1, 'ME213', 'Thermo sciences I', '2', '-'),
(22, '200', 1, 'ME214', 'Workshop Practice I', '1', '-'),
(23, '200', 1, 'MTH212', 'Mathematical Methods I', '3', '-'),
(24, '200', 1, 'GNS301', 'Science, Technology and Society', '2', '-'),
(25, '200', 1, 'EG210', 'Engineering Laboratories I', '3', '-'),
(26, '200', 1, 'ES 217', 'Engineer in Society', '2', '-'),
(27, '200', 2, 'CE222', 'Strength of Materials II', '2', 'CE211'),
(28, '200', 2, 'CE223', 'Engineering Hydromechanics', '2', '-'),
(29, '200', 2, 'EE222', 'Electrical Engineering Fundamentals II', '3', 'EE211'),
(30, '200', 2, 'ME222', 'Engineering Mechanics II', '2', 'ME211'),
(31, '200', 2, 'ME223', 'Engineering Drawing II', '2', 'ME212'),
(32, '200', 2, 'ME224', 'Thermo sciences II', '2', 'ME213'),
(33, '200', 2, 'ME225', 'Workshop Practice II', '1', '-'),
(34, '200', 2, 'MTH222', 'Mathematical Methods II', '3', 'MTH212'),
(35, '200', 2, 'EG220', 'Engineering Laboratories II', '3', '-'),
(36, '200', 2, 'ME205', 'Material Science', '2', '-'),
(37, '200', 2, 'GNS222', 'Peace & Conflict Resolution', '2', '-'),
(38, '300', 1, 'MTH337', 'Numerical Analysis', '3', 'MTH222'),
(39, '300', 0, 'EA311', 'Introductory Engineering Statistics', '3', ''),
(40, '300', 1, 'EE311', 'Circuit Theory I', '3', 'EE211'),
(41, '300', 1, 'EE312', 'Analogue Electronics Circuits', '3', 'EE222'),
(42, '300', 1, 'EE313', 'Electromagnetic Fields & Waves', '3', ''),
(43, '300', 1, 'EE314', 'Telecommunication Principles', '3', '-'),
(44, '300', 1, 'EE316', 'Telecommunication Laboratory', '1', '-'),
(45, '300', 1, 'EE317', 'Electrical & Electronics Workshop ', '1', '-'),
(46, '300', 1, 'EE315', 'Measurement & Instrumentation', '3', '-'),
(47, '300', 2, 'MTH323', 'Complex Analysis', '3', '-'),
(48, '300', 2, 'EA321', 'Topics in Engineering Mathematics', '2', '-'),
(49, '300', 2, 'EE321', 'Electrical Machines I', '4', 'EE222'),
(50, '300', 2, 'EE322', 'Digital Electronics', '3', 'EE222'),
(51, '300', 2, 'EE323', 'Circuit Theory II ', '3', 'EE311'),
(52, '300', 2, 'EE324', 'Electromagnetic Fields & Waves II', '3', 'EE313'),
(53, '300', 2, 'EE325', 'Electrical Machines Laboratory', '1', ''),
(54, '300', 2, 'EE326', 'Analogue/Digital Electronics  Lab', '1', 'EE222'),
(55, '300', 2, 'EE327', 'Measurement / Instrumentation Lab', '1', '-'),
(56, '300', 2, 'GNS302', 'Private Business Management ', '2', ''),
(57, '400', 1, 'EE411', 'Control Engineering I', '3', 'EE311'),
(58, '400', 1, 'EE412', 'Project and Seminar I', '2', 'EE311, EE3'),
(59, '400', 1, 'EE413', 'Digital Systems ', '3', '-'),
(60, '400', 1, 'EE414', 'Analogue Circuit Design', '3', 'EE312'),
(61, '400', 1, 'EE415', 'Physical Electronics', '3', '-'),
(62, '400', 1, 'EE416', 'Power Systems Engineering I', '3', '-'),
(63, '400', 1, 'EE417', 'Digital Systems Laboratory', '1NE', '-'),
(64, '400', 1, 'EE418', 'Control  Engineering Laboratory', '1NE', '-'),
(65, '400', 1, 'EA413', 'Computer Prog. for Engineers', '2', 'CS142'),
(66, '400', 1, 'EE410', 'Power Systems Laboratory I', '1NE', '-'),
(67, '500PO', 1, 'EE501', 'Control Engineering II', '3', 'EE411'),
(68, '500PO', 1, 'EE502', 'Microcomputer & Microprocessor Systems', '3', 'EE413'),
(69, '500PO', 1, 'EE503', 'Electrical Machines II', '2', 'EE321'),
(70, '500PO', 1, 'EE504', 'High Voltage Engineering', '2', ''),
(71, '500PO', 1, 'EE505', 'Power Systems Engineering II', '3', 'EE416'),
(72, '500PO', 1, 'EE506', 'Power Electronics', '3', '-'),
(73, '500PO', 1, 'EE510', 'Project and Seminar II', '-', 'I.T.'),
(74, '500PO', 1, 'EE511', 'Computer Aided Systems Analysis   and Design', '3', '-'),
(75, '500PO', 1, 'EE512', 'Power Systems Engineering Lab.  II', '1NE', '-'),
(76, '500PO', 1, 'EE513', 'Microcomputer & Microprocessor Systems Laboratory', '1NE', '-'),
(78, '500PO', 1, '', 'Elective Course', '3', ''),
(79, '500PO', 2, 'EE510', 'Project and Seminar II', '4', 'IT'),
(80, '500PO', 2, 'EE514', 'Power System Communication and Control', '2', 'EE312'),
(81, '500PO', 2, 'EE515', 'Advanced Power Electronics', '2', 'EE 506'),
(82, '500PO', 2, 'EE516', 'Power Systems Engineering III', '3', 'EE505'),
(83, '500PO', 2, 'EE521', 'Advanced Electric and Magnetic Field Theory', '2', '-'),
(84, '500PO', 2, 'EE522', 'Electrical Services Design', '2', ''),
(85, '500PO', 2, 'EE523', 'System Reliability & Maintainability', '2', ''),
(86, '500PO', 2, '', 'Elective Course', '3', ''),
(87, '500EO', 1, 'EE501', 'Control Engineering II', '3', 'EE411'),
(88, '500EO', 1, 'EE502', 'Microcomputer & Microprocessor Systems', '3', 'EE413'),
(89, '500EO', 1, 'EE506', 'Power Electronics ', '3', ''),
(90, '500EO', 1, 'EE507', 'Digital Signal Processing', '2', ''),
(91, '500EO', 1, 'EE508', 'Microwave Engineering ', '3', 'EE324'),
(92, '500EO', 1, 'EE509', 'Microwave Engineering Laboratory ', '1NE', ''),
(93, '500EO', 1, 'EE510', 'Project and Seminar II ', '-', 'IT'),
(94, '500EO', 1, 'EE511', 'Computer Aided Analysis and Program.', '3', ''),
(95, '500EO', 1, 'EE513', 'Microcomputer & Microprocessor Systems Laboratory', '1NE', ''),
(96, '500EO', 1, 'EE518', 'Solid State Electronics', '2', ''),
(97, '500EO', 1, '', 'Elective Course', '3', ''),
(98, '500EO', 2, 'EE510', 'Project and Seminar II', '4', 'IT'),
(99, '500EO', 2, 'EE514', 'Power System Communication ', '2', 'EE312'),
(100, '500EO', 2, 'EE515', 'Advanced Power Electronics', '2', 'EE 506'),
(101, '500EO', 2, 'EE517', 'Telecommunication Engineering', '2', 'EE508'),
(102, '500EO', 2, 'EE519', 'Digital Communication System', '2', ''),
(103, '500EO', 2, 'EE520', 'Telecommunication Services Design', '2', ''),
(104, '500EO', 2, 'EE523', 'System Reliability & Maintainability', '2', ''),
(105, '500EO', 2, '', 'Elective Course', '3', ''),
(106, '500Elective', 1, 'ST371', 'Set & Probability Theory', '3', '-'),
(107, '500Elective', 1, 'ST372', 'Optimization Theory', '3', '-'),
(108, '500Elective', 1, 'ST381', 'Time Series & Index', '3', '-'),
(109, '500Elective', 1, 'CS535', 'Data Communication Network', '3', '-'),
(110, '500Elective', 2, 'ST382', 'Probability Theory II', '3', '-'),
(111, '500Elective', 2, 'MTH346', 'Operation Research II', '3', '-'),
(112, '500Elective', 2, 'CS543', 'Introduction to Computer Architecture', '3', '-'),
(113, '500Elective', 2, 'CS544', 'Introduction to Artificial Intelligence', '3', '-');

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE IF NOT EXISTS `login` (
  `user_id` int(5) NOT NULL,
  `username` varchar(40) NOT NULL,
  `password` varchar(40) NOT NULL,
  `access_level` int(1) NOT NULL,
  `staff_category` int(1) NOT NULL,
  `staff_id` int(2) NOT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`user_id`, `username`, `password`, `access_level`, `staff_category`, `staff_id`) VALUES
(177895, 'admin', 'pass', 1, 3, 1),
(1, 'ccc', '12345', 2, 3, 0),
(2, 'ila', '12345', 1, 3, 2),
(3, 'isah', '12345', 2, 2, 3);

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE IF NOT EXISTS `news` (
  `news_id` int(5) NOT NULL AUTO_INCREMENT,
  `user_id` int(4) NOT NULL,
  `newsCat` int(1) NOT NULL,
  `title` varchar(100) NOT NULL,
  `body` text NOT NULL,
  `date` date NOT NULL,
  PRIMARY KEY (`news_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`news_id`, `user_id`, `newsCat`, `title`, `body`, `date`) VALUES
(1, 1, 1, 'news of the day', 'content of the the news of the day is empty. But it''s going to be updated soon.', '2014-05-31'),
(2, 2, 2, 'Event Box Ticket', 'Testing Testing Testing Testing Testing Testing Testing Testing Testing Testing Testing Testing', '2014-05-20');

-- --------------------------------------------------------

--
-- Table structure for table `news_category`
--

CREATE TABLE IF NOT EXISTS `news_category` (
  `newsCat_id` int(1) NOT NULL,
  `newsCat` varchar(6) NOT NULL,
  PRIMARY KEY (`newsCat_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `news_category`
--

INSERT INTO `news_category` (`newsCat_id`, `newsCat`) VALUES
(1, 'news'),
(2, 'events');

-- --------------------------------------------------------

--
-- Table structure for table `nonacademic_staff`
--

CREATE TABLE IF NOT EXISTS `nonacademic_staff` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `phone` varchar(15) NOT NULL,
  `office` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `rank` varchar(50) NOT NULL,
  `qualification` varchar(250) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `nonacademic_staff`
--

INSERT INTO `nonacademic_staff` (`user_id`, `phone`, `office`, `email`, `rank`, `qualification`) VALUES
(3, '0802556987', 'office', 'sambonuruddeen@gmail.com', 'rtrt', 'hjngt');

-- --------------------------------------------------------

--
-- Table structure for table `qualification`
--

CREATE TABLE IF NOT EXISTS `qualification` (
  `user_id` int(5) NOT NULL,
  `qualification` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `qualification`
--


-- --------------------------------------------------------

--
-- Table structure for table `rank`
--

CREATE TABLE IF NOT EXISTS `rank` (
  `user_id` int(5) NOT NULL,
  `rank` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rank`
--


-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE IF NOT EXISTS `staff` (
  `user_id` int(5) NOT NULL AUTO_INCREMENT,
  `category_id` int(2) NOT NULL,
  `title` varchar(40) NOT NULL,
  `surname` varchar(40) NOT NULL,
  `othername` varchar(60) NOT NULL,
  `gender` varchar(7) NOT NULL,
  `access_level` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`user_id`, `category_id`, `title`, `surname`, `othername`, `gender`, `access_level`) VALUES
(9, 3, 'Professor', 'Bakare', 'G.A', 'male', 0),
(10, 3, 'Prof.', 'Aliyu', 'U.O', 'male', 0),
(11, 3, 'Prof.', 'Okereke', 'O.U', 'male', 0),
(12, 3, 'Prof.', 'Jiya', 'J.D', 'male', 0),
(13, 3, 'Prof.', 'Omizegba', 'E.E', 'female', 0),
(14, 3, 'Prof.', 'Aliyu', 'M.D', 'male', 0),
(15, 3, 'Dr.', 'Anene', 'E.C', 'female', 0),
(16, 3, 'Dr.', 'Guda', 'H.A', 'female', 0),
(17, 3, 'Dr.', 'Umar', 'N.B', 'female', 0),
(18, 3, 'Engr.', 'Salihu', 'A.A', 'male', 0);

-- --------------------------------------------------------

--
-- Table structure for table `staff_category`
--

CREATE TABLE IF NOT EXISTS `staff_category` (
  `cat_id` int(1) NOT NULL AUTO_INCREMENT,
  `category` varchar(20) NOT NULL,
  PRIMARY KEY (`cat_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `staff_category`
--

INSERT INTO `staff_category` (`cat_id`, `category`) VALUES
(1, 'Technical Staff'),
(2, 'Non Academic Staff'),
(3, 'Academic Staff');
