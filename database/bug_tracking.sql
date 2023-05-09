-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 09, 2023 at 08:42 PM
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
-- Database: `bug_tracking`
--

-- --------------------------------------------------------

--
-- Table structure for table `bug`
--

CREATE TABLE `bug` (
  `bugID` int(11) NOT NULL,
  `staffAssignedID` int(11) DEFAULT NULL,
  `customerReportedID` int(11) NOT NULL,
  `bug title` varchar(255) NOT NULL,
  `bug details` text NOT NULL,
  `solved` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bug`
--

INSERT INTO `bug` (`bugID`, `staffAssignedID`, `customerReportedID`, `bug title`, `bug details`, `solved`) VALUES
(3, 17, 3, 'SignIn', 'solveIt', 0),
(4, 12, 3, 'SignOut', 'solve', 1),
(6, 13, 3, 'solve it', 'please', 0),
(7, 13, 3, 'hello', 'hello hello', 0),
(8, NULL, 3, 'bye', 'bye bye', 0),
(9, NULL, 3, 'Bug Facebook', 'cant login', 0);

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `messageID` int(11) NOT NULL,
  `senderID` int(11) NOT NULL,
  `recipientID` int(11) NOT NULL,
  `message` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`messageID`, `senderID`, `recipientID`, `message`) VALUES
(23, 1, 13, 'hello abdallah'),
(24, 12, 1, 'hello admin'),
(26, 12, 3, 'Solved bug'),
(27, 12, 3, 'Solved bug (SignOut)'),
(28, 12, 3, 'Solved bug name: (SignOut)');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `staffID` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `typeID` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`staffID`, `username`, `password`, `name`, `typeID`) VALUES
(1, 'admin@gmail.com', '202cb962ac59075b964b07152d234b70', 'admin', 1),
(3, 'customer@gmail.com', '202cb962ac59075b964b07152d234b70', 'customer', 2),
(12, 'staff@gmail.com', '202cb962ac59075b964b07152d234b70', 'staff', 0),
(13, 'abdallah@gmail.com', '202cb962ac59075b964b07152d234b70', 'abdallah', 0),
(15, 'cus2@gmail.com', '698d51a19d8a121ce581499d7b701668', 'Kandeel', 2),
(17, 'ayman@gmail.com', '202cb962ac59075b964b07152d234b70', 'Ayman', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bug`
--
ALTER TABLE `bug`
  ADD PRIMARY KEY (`bugID`),
  ADD KEY `bug_ibfk_1` (`customerReportedID`),
  ADD KEY `bug_ibfk_2` (`staffAssignedID`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`messageID`),
  ADD KEY `senderID` (`senderID`),
  ADD KEY `recipientID` (`recipientID`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`staffID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bug`
--
ALTER TABLE `bug`
  MODIFY `bugID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `messageID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `staffID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bug`
--
ALTER TABLE `bug`
  ADD CONSTRAINT `bug_ibfk_1` FOREIGN KEY (`customerReportedID`) REFERENCES `user` (`staffID`),
  ADD CONSTRAINT `bug_ibfk_2` FOREIGN KEY (`staffAssignedID`) REFERENCES `user` (`staffID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `messages_ibfk_1` FOREIGN KEY (`senderID`) REFERENCES `user` (`staffID`) ON DELETE CASCADE,
  ADD CONSTRAINT `messages_ibfk_2` FOREIGN KEY (`recipientID`) REFERENCES `user` (`staffID`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
