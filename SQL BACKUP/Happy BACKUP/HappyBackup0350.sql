-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 22, 2018 at 11:20 PM
-- Server version: 10.1.30-MariaDB
-- PHP Version: 7.2.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `college_noticeboard`
--

-- --------------------------------------------------------

--
-- Table structure for table `academic_calender`
--

CREATE TABLE `academic_calender` (
  `collegecode` varchar(15) NOT NULL,
  `academicimage` text NOT NULL,
  `authoremail` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `email` varchar(30) NOT NULL,
  `name` varchar(30) NOT NULL,
  `collegecode` varchar(10) NOT NULL,
  `password` text NOT NULL,
  `mobileno` int(15) NOT NULL,
  `dob` date NOT NULL,
  `gender` varchar(5) NOT NULL,
  `profilephoto` text NOT NULL,
  `collegelogo` text NOT NULL,
  `collegename` varchar(50) NOT NULL,
  `collegecity` varchar(30) NOT NULL,
  `collegestate` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`email`, `name`, `collegecode`, `password`, `mobileno`, `dob`, `gender`, `profilephoto`, `collegelogo`, `collegename`, `collegecity`, `collegestate`) VALUES
('happy11234@gmail.com', 'Happy Singh', '01871sdsd', '8801f8e29626c3fafffc', 2147483647, '0000-00-00', 'male', '../Storage/AdminProfiles/Admin01871sdsd.png', '../Storage/CollegeIcons/Logo01871sdsd.png', 'SISTEC', 'Gandhinagar', 'MP'),
('happy1123@gmail.com', 'Happy Singh', '01871', '8801f8e29626c3fafffc', 2147483647, '0000-00-00', 'male', '../Storage/AdminProfiles/Admin01871.png', '../Storage/CollegeIcons/Logo01871.png', 'SISTEC', 'Gandhinagar', 'MP'),
('happy11vcvc234@gmail.com', 'Happy Singh', '01871sdsdc', '8801f8e29626c3fafffc', 2147483647, '2017-12-11', 'male', '../Storage/AdminProfiles/Admin01871sdsdcvcv.png', '../Storage/CollegeIcons/Logo01871sdsdcvcv.png', 'SISTEC', 'Gandhinagar', 'MP'),
('happy11vcvcsdsd234@gmail.com', 'Happy Singh', '01871sdsdc', '8801f8e29626c3fafffc', 2147483647, '2017-12-11', 'male', 'Admin01871sdsdcvcvdsds.png', 'Logo01871sdsdcvcvdsds.png', 'SISTEC', 'Gandhinagar', 'MP'),
('happy11vcvcsdsd23@gmail.com', 'Happy Singh', '01871sdsdc', '8801f8e29626c3fafffc', 2147483647, '2017-12-11', 'male', 'Admin01871sdsdcvcvdsd.png', 'Logo01871sdsdcvcvdsd.png', 'SISTEC', 'Gandhinagar', 'MP'),
('happy123@gmail.com', 'Happy Singh', '0187', '8801f8e29626c3fafffc', 2147483647, '0000-00-00', 'male', '../..//College_Noticeboard_Web_API/Storage/AdminProfiles/0187.png', '../..//College_Noticeboard_Web_API/Storage/CollegeIcons/0187.png', 'SISTEC', 'Gandhinagar', 'MP'),
('happy1sdsd1vcvcsdsd23@gmail.co', 'Happy Singh', '01871sdsdc', '8801f8e29626c3fafffc', 2147483647, '2017-12-11', 'male', 'Admin01871sdsdcvcvdsdds.png', 'Logo01871sdsdcvcvdsdds.png', 'SISTEC', 'Gandhinagar', 'MP'),
('happy321@gmail.com', 'Happy Singh', '0187cs', '8801f8e29626c3fafffc', 2147483647, '2017-12-11', 'male', 'Admin0187cs.png', 'Logo0187cs.png', 'SISTEC', 'Gandhinagar', 'MP'),
('happy@gmail.com', 'Happy Singh', 'sdsd', '8801f8e29626c3fafffc', 2147483647, '0000-00-00', 'male', '../..//College_Noticeboard_Web_API/Storage/AdminProfiles/sdsd.png', '../..//College_Noticeboard_Web_API/Storage/CollegeIcons/sdsd.png', 'SISTEC', 'Gandhinagar', 'MP');

-- --------------------------------------------------------

--
-- Table structure for table `college_time_table`
--

CREATE TABLE `college_time_table` (
  `collegecode` varchar(10) NOT NULL,
  `dept` varchar(15) NOT NULL,
  `sem` varchar(15) NOT NULL,
  `section` varchar(10) NOT NULL,
  `timetableimage` text NOT NULL,
  `authoremail` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `content`
--

CREATE TABLE `content` (
  `collegecode` varchar(10) NOT NULL,
  `contentid` varchar(10) NOT NULL,
  `imageflag` tinyint(1) NOT NULL,
  `textflag` tinyint(1) NOT NULL,
  `contentstring` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `notice_college`
--

CREATE TABLE `notice_college` (
  `collegecode` varchar(10) NOT NULL,
  `authoremail` varchar(30) NOT NULL,
  `contentid` varchar(10) NOT NULL,
  `time` datetime NOT NULL,
  `title` text NOT NULL,
  `type` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `notice_dept`
--

CREATE TABLE `notice_dept` (
  `collegecode` varchar(10) NOT NULL,
  `authoremail` varchar(30) NOT NULL,
  `contentid` varchar(10) NOT NULL,
  `time` datetime NOT NULL,
  `title` text NOT NULL,
  `dept` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `notice_tg`
--

CREATE TABLE `notice_tg` (
  `collegecode` varchar(10) NOT NULL,
  `authoremail` varchar(30) NOT NULL,
  `contentid` varchar(10) NOT NULL,
  `time` datetime NOT NULL,
  `title` text NOT NULL,
  `dept` varchar(15) NOT NULL,
  `sem` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `person`
--

CREATE TABLE `person` (
  `email` varchar(30) NOT NULL,
  `password` text NOT NULL,
  `name` varchar(30) NOT NULL,
  `mobileno` varchar(12) NOT NULL,
  `dob` date NOT NULL,
  `gender` varchar(10) NOT NULL,
  `collegecode` varchar(20) NOT NULL,
  `personprofile` text NOT NULL,
  `tgflag` tinyint(1) NOT NULL,
  `tgsem` varchar(15) NOT NULL,
  `dept` varchar(15) NOT NULL,
  `role` varchar(15) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `person`
--

INSERT INTO `person` (`email`, `password`, `name`, `mobileno`, `dob`, `gender`, `collegecode`, `personprofile`, `tgflag`, `tgsem`, `dept`, `role`) VALUES
('happy1sdsd1vcvcsdsd23@gmail.co', '8801f8e29626c3fafffcfb21de48a3', 'Happy Singh', '9103245698', '2017-12-11', 'male', '01871sdsdcvcvdsdds', 'Person01871sdsdcvcvdsdds.png', 0, 'CSE 6th sem', 'Computer Scienc', 'Accountent'),
('happysdsd1sdsd1vcvcsdsd23@gmai', '19068bb969a34c076af8355f48ef3b', 'Happy Singh', '9103245698', '2017-12-11', 'male', '0187sd1sdsdcvcvdsdds', 'Person0187sd1sdsdcvcvdsdds.png', 0, 'CSE 6th sem', 'Computer Scienc', 'Accountent'),
('happysssdsd1sdsd1vcvcsdsd23@gm', '19068bb969a34c076af8355f48ef3b', 'Happy Singh', '9103245698', '2017-12-11', 'male', '0187sd1sdsdcvcvdsdds', 'Personhappysssdsd1sdsd1vcvcsdsd23@gmail.com.png', 0, 'CSE 6th sem', 'Computer Scienc', 'Accountent');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `email` varchar(30) NOT NULL,
  `name` varchar(30) NOT NULL,
  `password` text NOT NULL,
  `mobileno` int(12) NOT NULL,
  `dob` date NOT NULL,
  `gender` varchar(10) NOT NULL,
  `collegecode` varchar(15) NOT NULL,
  `studentprofile` text NOT NULL,
  `dept` varchar(10) NOT NULL,
  `sem` varchar(15) NOT NULL,
  `tgemail` varchar(30) NOT NULL,
  `enrollment` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`email`, `name`, `password`, `mobileno`, `dob`, `gender`, `collegecode`, `studentprofile`, `dept`, `sem`, `tgemail`, `enrollment`) VALUES
('stu@gmail.com', 'Lucky Singh', '8801f8e29626c3fafffcfb21de48a3b3', 2147483647, '2018-02-12', 'male', '0187', 'sdsdsds', 'cse', '6', 'happy@gmail.com', '0187cs151035');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `academic_calender`
--
ALTER TABLE `academic_calender`
  ADD PRIMARY KEY (`collegecode`);

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `college_time_table`
--
ALTER TABLE `college_time_table`
  ADD PRIMARY KEY (`collegecode`);

--
-- Indexes for table `notice_college`
--
ALTER TABLE `notice_college`
  ADD PRIMARY KEY (`contentid`);

--
-- Indexes for table `notice_dept`
--
ALTER TABLE `notice_dept`
  ADD PRIMARY KEY (`contentid`);

--
-- Indexes for table `notice_tg`
--
ALTER TABLE `notice_tg`
  ADD PRIMARY KEY (`contentid`);

--
-- Indexes for table `person`
--
ALTER TABLE `person`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`email`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
