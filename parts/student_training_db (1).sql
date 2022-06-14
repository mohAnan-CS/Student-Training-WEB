-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3307:3307
-- Generation Time: Jun 14, 2022 at 05:30 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `student_training_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `city`
--

CREATE TABLE `city` (
  `id` int(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `country` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `city`
--

INSERT INTO `city` (`id`, `name`, `country`) VALUES
(8, 'Palestine', 'Tulkarm'),
(9, 'Palestine', 'Jerusalem'),
(10, 'Palestine', 'Ramallah'),
(11, 'Palestine', 'Nablus'),
(12, 'Palestine', 'Hebron');

-- --------------------------------------------------------

--
-- Table structure for table `company`
--

CREATE TABLE `company` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `cityid` int(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `tel` varchar(50) NOT NULL,
  `positioncount` varchar(10) NOT NULL,
  `positiondetails` varchar(50) NOT NULL,
  `logopath` varchar(100) NOT NULL,
  `userid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `company`
--

INSERT INTO `company` (`id`, `name`, `cityid`, `email`, `tel`, `positioncount`, `positiondetails`, `logopath`, `userid`) VALUES
(12, 'iconnect', 10, 'iconnect@hotmail.com', '05694533', '5', '7', 'images/company/iconnect.png', 15);

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `id` int(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `cityid` int(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `tel` varchar(50) NOT NULL,
  `university` varchar(50) NOT NULL,
  `major` varchar(50) NOT NULL,
  `projects` varchar(100) NOT NULL,
  `interests` varchar(200) NOT NULL,
  `photopath` varchar(100) NOT NULL,
  `userid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`id`, `name`, `cityid`, `email`, `tel`, `university`, `major`, `projects`, `interests`, `photopath`, `userid`) VALUES
(19, 'Mohammad Abo Jazar', 11, 'mohammad@hotmail.com', '0595693999', 'Birzeit', 'Computer Science', 'Hotel System', 'Backend developer', 'images/student/user (1).png', 13),
(20, 'Ibraheem ', 8, 'ibrahim@hotmail.com', '065756', 'birzeit', 'computer scince', 'resturant system', 'front end', 'images/student/people.png', 14);

-- --------------------------------------------------------

--
-- Table structure for table `students_applications`
--

CREATE TABLE `students_applications` (
  `id` int(50) NOT NULL,
  `studentid` int(20) NOT NULL,
  `companyid` int(20) NOT NULL,
  `applydate` varchar(50) NOT NULL,
  `applicationstatus` varchar(10) NOT NULL DEFAULT 'sent',
  `userid` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `students_applications`
--

INSERT INTO `students_applications` (`id`, `studentid`, `companyid`, `applydate`, `applicationstatus`, `userid`) VALUES
(68, 0, 0, '2022/06/14', 'sent', 13),
(70, 19, 12, '2022/06/14', 'reject', 13),
(71, 20, 12, '2022/06/14', 'sent', 14);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `displayname` varchar(50) NOT NULL,
  `lasthit` varchar(50) NOT NULL,
  `usertype` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `displayname`, `lasthit`, `usertype`) VALUES
(13, 'moh', '8aefb06c426e07a0a671a1e2488b4858d694a730', 'Mohammad Anan', '2022-06-30 15:37:49.', 'student'),
(14, 'majdi', '8aefb06c426e07a0a671a1e2488b4858d694a730', 'Majdi Qutait', '2022-06-24 15:39:17.', 'student'),
(15, 'obada', '8aefb06c426e07a0a671a1e2488b4858d694a730', 'Obada Jaras', '2022-06-30 18:48:52.', 'company'),
(16, 'diyar', '8aefb06c426e07a0a671a1e2488b4858d694a730', 'Diyar Barham', '2022-06-30 18:48:52.', 'company');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `city`
--
ALTER TABLE `city`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `company`
--
ALTER TABLE `company`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `tel` (`tel`),
  ADD KEY `userid` (`userid`),
  ADD KEY `cityid` (`cityid`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `tel` (`tel`),
  ADD KEY `cityid` (`cityid`),
  ADD KEY `university` (`university`),
  ADD KEY `userid` (`userid`);

--
-- Indexes for table `students_applications`
--
ALTER TABLE `students_applications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `city`
--
ALTER TABLE `city`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `company`
--
ALTER TABLE `company`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `students_applications`
--
ALTER TABLE `students_applications`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `company`
--
ALTER TABLE `company`
  ADD CONSTRAINT `company_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `company_ibfk_2` FOREIGN KEY (`cityid`) REFERENCES `city` (`id`);

--
-- Constraints for table `student`
--
ALTER TABLE `student`
  ADD CONSTRAINT `student_ibfk_2` FOREIGN KEY (`userid`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `student_ibfk_3` FOREIGN KEY (`cityid`) REFERENCES `city` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
