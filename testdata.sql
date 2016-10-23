-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Oct 23, 2016 at 08:59 PM
-- Server version: 5.6.28
-- PHP Version: 7.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `studentinfo`
--

-- --------------------------------------------------------

--
-- Table structure for table `administrator`
--

CREATE TABLE `administrator` (
  `id` int(11) NOT NULL,
  `adminid` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `administrator`
--

INSERT INTO `administrator` (`id`, `adminid`, `password`, `created_date`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', '2016-09-21 10:29:46');

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `id` int(11) NOT NULL,
  `attid` varchar(255) NOT NULL,
  `studid` varchar(255) NOT NULL,
  `subid` varchar(255) NOT NULL,
  `totalclasses` varchar(255) NOT NULL,
  `attendedclasses` varchar(255) NOT NULL,
  `percentage` varchar(255) NOT NULL,
  `comment` varchar(255) NOT NULL,
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `attendance`
--

INSERT INTO `attendance` (`id`, `attid`, `studid`, `subid`, `totalclasses`, `attendedclasses`, `percentage`, `comment`, `created_date`) VALUES
(1, 'att100', 'stu100', 's100', '90', '10', '', '', '2016-09-21 15:43:04');

-- --------------------------------------------------------

--
-- Table structure for table `calendar`
--

CREATE TABLE `calendar` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `startdate` varchar(48) NOT NULL,
  `enddate` varchar(48) NOT NULL,
  `lecid` varchar(48) NOT NULL,
  `allDay` varchar(5) NOT NULL,
  `status` varchar(50) NOT NULL DEFAULT 'pending',
  `lec_entry` varchar(255) NOT NULL DEFAULT 'false',
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `calendar`
--

INSERT INTO `calendar` (`id`, `title`, `startdate`, `enddate`, `lecid`, `allDay`, `status`, `lec_entry`, `created_date`) VALUES
(63, 'Ahilaa', '2016-10-05T15:00:00', '2016-10-05T16:00:00', 'Robertl', 'false', 'pending', 'false', '2016-10-04 11:47:35'),
(64, 'Students Meeting', '2016-10-04T20:30:00-07:00', '2016-10-04T23:30:00-07:00', '', 'false', 'master', 'true', '2016-10-04 12:49:27'),
(65, 'Students Meeting', '2016-10-05T14:30:00-07:00', '2016-10-05T18:30:00-07:00', '', 'false', 'master', 'true', '2016-10-04 12:49:27'),
(71, 'Students Meeting', '2016-10-04T20:30:00-07:00', '2016-10-04T23:30:00-07:00', 'wang', 'false', 'master', 'true', '2016-10-04 18:14:31'),
(72, 'Students Meeting', '2016-10-05T14:30:00-07:00', '2016-10-05T18:30:00-07:00', 'wang', 'false', 'master', 'true', '2016-10-04 18:14:31'),
(73, 'STUDENET INTERACTION', '2016-10-06T20:00:00-07:00', '2016-10-06T23:30:00-07:00', 'wang', 'false', 'master', 'true', '2016-10-04 18:14:31'),
(74, 'Students Meeting', '2016-10-04T20:30:00-07:00', '2016-10-04T23:30:00-07:00', 'Robertl', 'false', 'master', 'true', '2016-10-04 18:16:30'),
(75, 'Students Meeting', '2016-10-05T14:30:00-07:00', '2016-10-05T18:30:00-07:00', 'Robertl', 'false', 'master', 'true', '2016-10-04 18:16:30'),
(76, 'STUDENET INTERACTION', '2016-10-06T20:00:00-07:00', '2016-10-06T23:30:00-07:00', 'Robertl', 'false', 'master', 'true', '2016-10-04 18:16:30'),
(77, 'New Event', '2016-10-06T20:00:00', '2016-10-06T21:00:00', 'Robertl', 'false', 'accepted', 'false', '2016-10-04 18:17:25'),
(78, 'New Event', '2016-10-07T13:30:00-07:00', '2016-10-07T13:30:00-07:00', 'Robertl', 'false', 'accepted', 'false', '2016-10-06 14:52:23');

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `emailid` varchar(255) NOT NULL,
  `contactno` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE `course` (
  `id` int(11) NOT NULL,
  `courseid` varchar(255) NOT NULL,
  `coursename` varchar(255) NOT NULL,
  `comment` text NOT NULL,
  `coursekey` varchar(255) NOT NULL,
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`id`, `courseid`, `coursename`, `comment`, `coursekey`, `created_date`) VALUES
(1, 'COMP589', 'SOFTWARE METRICS', '', 'COMP589', '2016-09-21 10:39:28'),
(2, 'COMP583', 'SOFTWARE ENGG MGMT', 'Software engineering managamnet', 'COMP583', '2016-09-22 15:01:21'),
(3, 'COMP582', 'SOFTWARE REQ SPEC', 'Software requirement specification', 'COMP582', '2016-09-22 15:01:21');

-- --------------------------------------------------------

--
-- Table structure for table `examination`
--

CREATE TABLE `examination` (
  `id` int(11) NOT NULL,
  `examid` varchar(255) NOT NULL,
  `studid` varchar(255) NOT NULL,
  `subid` varchar(255) NOT NULL,
  `courseid` varchar(255) NOT NULL,
  `internaltype` varchar(255) NOT NULL,
  `maxmarks` varchar(255) NOT NULL,
  `scored` varchar(255) NOT NULL,
  `percentage` varchar(255) NOT NULL,
  `result` varchar(255) NOT NULL,
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `lectures`
--

CREATE TABLE `lectures` (
  `id` int(11) NOT NULL,
  `lecid` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `lecname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `courseid` varchar(255) NOT NULL,
  `cal_feed_url` varchar(400) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `address` varchar(600) NOT NULL,
  `contactno` varchar(255) NOT NULL,
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `lectures`
--

INSERT INTO `lectures` (`id`, `lecid`, `password`, `lecname`, `email`, `courseid`, `cal_feed_url`, `gender`, `address`, `contactno`, `created_date`) VALUES
(1, 'Robertl', '5f4dcc3b5aa765d61d8327deb882cf99', 'Robert Lingard', 'csungroupprojectsem1@gmail.com', 'COMP589', 'https://www.googleapis.com/calendar/v3/calendars/1d29s7r26j3dek6se89gfl3klc%40group.calendar.google.com/events?key=AIzaSyAo3XpqJn3o8koEeQGom0mVAlsGmdd_tyU&maxResults=10&futureevents=true&singleevents=true', '', '', '', '2016-09-21 10:34:52'),
(3, 'wang', '5f4dcc3b5aa765d61d8327deb882cf99', 'Wang', '', 'COMP583', 'https://www.googleapis.com/calendar/v3/calendars/1d29s7r26j3dek6se89gfl3klc%40group.calendar.google.com/events?key=AIzaSyAo3XpqJn3o8koEeQGom0mVAlsGmdd_tyU&maxResults=10&futureevents=true&singleevents=true', 'Male', 'Northridge', '2323223232', '2016-09-21 23:05:45');

-- --------------------------------------------------------

--
-- Table structure for table `studentdetails`
--

CREATE TABLE `studentdetails` (
  `id` int(11) NOT NULL,
  `studid` varchar(255) NOT NULL,
  `studfname` varchar(255) NOT NULL,
  `studlname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `dob` date NOT NULL,
  `fathername` varchar(255) NOT NULL,
  `address` varchar(600) NOT NULL,
  `contactno` varchar(255) NOT NULL,
  `courseid` varchar(255) NOT NULL,
  `semester` int(11) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `studentdetails`
--

INSERT INTO `studentdetails` (`id`, `studid`, `studfname`, `studlname`, `email`, `password`, `dob`, `fathername`, `address`, `contactno`, `courseid`, `semester`, `gender`, `created_date`) VALUES
(1, 'stu100', 'Ahilaa', 'Kamuthurai', 'akilakamuthurai@gmail.com', 'a377353e9b09450f27f3b214503b4871', '1982-01-17', 'Kamuthurai', 'Studio city', '8183196443', 'COMP589', 1, 'Female', '2016-09-21 10:48:44');

-- --------------------------------------------------------

--
-- Table structure for table `subject`
--

CREATE TABLE `subject` (
  `id` int(11) NOT NULL,
  `subid` varchar(255) NOT NULL,
  `subname` varchar(255) NOT NULL,
  `courseid` varchar(255) NOT NULL,
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `subject`
--

INSERT INTO `subject` (`id`, `subid`, `subname`, `courseid`, `created_date`) VALUES
(1, 's100', 'SOFTWARE METRICS', 'c100', '2016-09-21 15:39:27');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `administrator`
--
ALTER TABLE `administrator`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `calendar`
--
ALTER TABLE `calendar`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `course`
--
ALTER TABLE `course`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `examination`
--
ALTER TABLE `examination`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lectures`
--
ALTER TABLE `lectures`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `studentdetails`
--
ALTER TABLE `studentdetails`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subject`
--
ALTER TABLE `subject`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `administrator`
--
ALTER TABLE `administrator`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `calendar`
--
ALTER TABLE `calendar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;
--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `course`
--
ALTER TABLE `course`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `examination`
--
ALTER TABLE `examination`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `lectures`
--
ALTER TABLE `lectures`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `studentdetails`
--
ALTER TABLE `studentdetails`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `subject`
--
ALTER TABLE `subject`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;