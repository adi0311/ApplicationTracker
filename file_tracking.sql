-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Nov 26, 2019 at 05:54 AM
-- Server version: 5.7.26
-- PHP Version: 7.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `file tracking`
--

-- --------------------------------------------------------

--
-- Table structure for table `application_faculty`
--

DROP TABLE IF EXISTS `application_faculty`;
CREATE TABLE IF NOT EXISTS `application_faculty` (
  `faculty_id` varchar(10) NOT NULL,
  `strdate` date NOT NULL,
  `endate` date NOT NULL,
  `type` varchar(10) NOT NULL,
  `purpose` varchar(20) NOT NULL,
  `status` varchar(10) NOT NULL,
  `result` varchar(10) NOT NULL,
  PRIMARY KEY (`faculty_id`,`strdate`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `application_faculty`
--

INSERT INTO `application_faculty` (`faculty_id`, `strdate`, `endate`, `type`, `purpose`, `status`, `result`) VALUES
('FC002', '2019-11-28', '2019-11-29', 'casual', 'holiday', 'Acad', 'Accepted'),
('FC004', '2019-11-14', '2019-11-15', 'halfpay', 'holiday', 'HOD', 'Accepted'),
('FC005', '2019-11-28', '2019-11-30', 'casual', 'holiday', 'HOD', 'Pending'),
('FC003', '2019-11-19', '2019-11-21', 'casual', 'holiday', 'HOD', 'Accepted'),
('FC007', '2019-11-22', '2019-11-23', 'halfpay', 'holiday', 'HOD', 'Pending'),
('FC004', '2019-11-06', '2019-11-08', 'halfpay', 'holiday', 'HOD', 'Pending'),
('FC002', '2019-10-02', '2019-10-10', 'casual', 'holiday', 'Acad', 'Rejected'),
('FC001', '2019-11-28', '2019-11-29', 'casual', 'holiday', 'Acad', 'Rejected'),
('FC002', '2019-11-27', '2019-11-29', 'casual', 'holiday', 'HOD', 'Accepted'),
('FC002', '2019-12-05', '2019-12-06', 'casual', 'holiday', 'HOD', 'Accepted');

-- --------------------------------------------------------

--
-- Table structure for table `application_student`
--

DROP TABLE IF EXISTS `application_student`;
CREATE TABLE IF NOT EXISTS `application_student` (
  `roll_no` varchar(10) NOT NULL,
  `strdate` date NOT NULL,
  `endate` date NOT NULL,
  `type` varchar(10) NOT NULL,
  `purpose` varchar(30) NOT NULL,
  `status` varchar(10) NOT NULL,
  `result` varchar(10) NOT NULL,
  PRIMARY KEY (`roll_no`,`strdate`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `application_student`
--

INSERT INTO `application_student` (`roll_no`, `strdate`, `endate`, `type`, `purpose`, `status`, `result`) VALUES
('2018363', '2019-11-24', '2019-11-27', 'casual', 'holiday', 'HOD', 'Accepted'),
('2018363', '2019-12-02', '2019-12-04', 'casual', 'holiday', 'HOD', 'Rejected'),
('2018308', '2019-11-14', '2019-11-18', 'casual', 'holiday', 'Acad', 'Rejected'),
('2018298', '2019-11-06', '2019-11-10', 'casual', 'holiday', 'Acad', 'Rejected'),
('2018300', '2019-11-28', '2019-11-30', 'Medical', 'holiday', 'HOD', 'Accepted'),
('2018308', '2019-10-08', '2019-10-09', 'Medical', 'holiday', 'HOD', 'Accepted'),
('2018363', '2019-12-11', '2019-12-12', 'casual', 'holiday', 'Acad', 'Accepted'),
('2018298', '2019-12-03', '2019-12-04', 'casual', 'Medical', 'HOD', 'Pending'),
('2018363', '2019-12-18', '2019-12-24', 'Medical', 'holiday', 'HOD', 'Accepted'),
('2018308', '2020-01-01', '2020-01-06', 'Medical', 'holiday', 'HOD', 'Accepted'),
('2018363', '2019-12-01', '2019-12-03', 'casual', 'holiday', 'Acad', 'Rejected'),
('2018363', '2019-11-22', '2019-11-24', 'casual', 'hh', 'HOD', 'Rejected'),
('2018363', '2019-11-27', '2019-11-29', 'casual', 'hh', 'HOD', 'Rejected'),
('2018363', '2019-11-05', '2019-11-07', 'casual', 'holiday', 'Acad', 'Rejected'),
('2018363', '2019-12-12', '2019-11-16', 'casual', 'Holiday', 'Acad', 'Pending'),
('2018308', '2019-11-28', '2019-11-30', 'casual', 'Holiday', 'HOD', 'Pending');

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

DROP TABLE IF EXISTS `department`;
CREATE TABLE IF NOT EXISTS `department` (
  `dept_id` varchar(10) NOT NULL,
  `name` varchar(50) NOT NULL,
  `hod_id` varchar(10) NOT NULL,
  PRIMARY KEY (`dept_id`),
  KEY `hod_id` (`hod_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`dept_id`, `name`, `hod_id`) VALUES
('ECE', 'Electronics and Communication Engineering ', 'FC006'),
('CSE', 'Computer Science and engineering', 'FC003'),
('ME', 'Mechanical engineering ', 'FC009');

-- --------------------------------------------------------

--
-- Table structure for table `faculty`
--

DROP TABLE IF EXISTS `faculty`;
CREATE TABLE IF NOT EXISTS `faculty` (
  `faculty_id` varchar(10) NOT NULL,
  `password` varchar(18) NOT NULL,
  `name` varchar(50) NOT NULL,
  `dept_id` varchar(10) NOT NULL,
  PRIMARY KEY (`faculty_id`),
  KEY `dept_id` (`dept_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `faculty`
--

INSERT INTO `faculty` (`faculty_id`, `password`, `name`, `dept_id`) VALUES
('FC001', '12345', 'Dr. Pritee Khanna', 'CSE'),
('FC002', '12345', 'Dr. Aparajita Ojha', 'CSE'),
('FC005', '12345', 'Dr. Irshad Ahmad Ansari', 'ECE'),
('FC004', '12345', 'Dr. P.N Kondekar', 'ECE'),
('FC003', '12345', 'Dr. Atul  Gupta', 'CSE'),
('FC006', '12345', 'Dr. P.K. Padhy', 'ECE'),
('FC007', '12345', 'Dr. Puneet Tandon', 'ME'),
('FC008', '12345', 'Dr. V.K. Gupta', 'ME'),
('FC009', '12345', 'Dr. Tanuja Sheorey', 'ME');

-- --------------------------------------------------------

--
-- Table structure for table `leave_faculty`
--

DROP TABLE IF EXISTS `leave_faculty`;
CREATE TABLE IF NOT EXISTS `leave_faculty` (
  `faculty_id` varchar(10) NOT NULL,
  `casual` int(2) NOT NULL,
  `earned` int(2) NOT NULL,
  `compensatory` int(2) NOT NULL,
  `halfpay` int(2) NOT NULL,
  `maternity` int(2) NOT NULL,
  PRIMARY KEY (`faculty_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `leave_faculty`
--

INSERT INTO `leave_faculty` (`faculty_id`, `casual`, `earned`, `compensatory`, `halfpay`, `maternity`) VALUES
('FC001', 10, 60, 2, 20, 180),
('FC002', 9, 60, 2, 20, 180),
('FC003', 8, 60, 2, 20, 0),
('FC004', 10, 60, 2, 19, 0),
('FC005', 8, 60, 2, 20, 0),
('FC006', 10, 60, 2, 20, 0),
('FC007', 10, 60, 2, 20, 0),
('FC008', 10, 60, 2, 20, 0),
('FC009', 10, 60, 2, 20, 180);

-- --------------------------------------------------------

--
-- Table structure for table `leave_student`
--

DROP TABLE IF EXISTS `leave_student`;
CREATE TABLE IF NOT EXISTS `leave_student` (
  `roll_no` int(7) NOT NULL,
  `casual` int(2) NOT NULL,
  `medical` int(2) NOT NULL,
  PRIMARY KEY (`roll_no`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `leave_student`
--

INSERT INTO `leave_student` (`roll_no`, `casual`, `medical`) VALUES
(2018298, 3, 7),
(2018308, 1, 7),
(2018300, 3, 7),
(2018363, 0, 7),
(2018297, 3, 7),
(2018307, 3, 7),
(2018362, 3, 7),
(2018374, 3, 7),
(2018364, 3, 7);

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

DROP TABLE IF EXISTS `student`;
CREATE TABLE IF NOT EXISTS `student` (
  `roll_no` int(7) NOT NULL,
  `name` varchar(20) NOT NULL,
  `password` varchar(18) NOT NULL,
  `dept_id` varchar(10) NOT NULL,
  PRIMARY KEY (`roll_no`),
  KEY `dept_id` (`dept_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`roll_no`, `name`, `password`, `dept_id`) VALUES
(2018363, 'Rohit Raghuvanshi', '12345', 'CSE'),
(2018298, 'Yugant verma', '12345', 'CSE'),
(2018300, 'Zaid Jilani', '12345', 'CSE'),
(2018308, 'Aditya Panwar', '12345', 'CSE'),
(2018307, 'Abhishek Sharma', '12345', 'ME'),
(2018364, 'Sameer gupta', '12345', 'ME'),
(2018362, 'Ritvik Mishra', '12345', 'ECE'),
(2018374, 'Shubham Malav', '12345', 'ME'),
(2018297, 'Yogendra singh', '12345', 'CSE');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
