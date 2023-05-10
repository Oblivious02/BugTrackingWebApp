SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";
CREATE TABLE `bug` (
  `bugID` int(11) NOT NULL,
  `staffAssignedID` int(11) DEFAULT NULL,
  `customerReportedID` int(11) NOT NULL,
  `bug title` varchar(255) NOT NULL,
  `bug details` text NOT NULL,
  `solved` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `bug` (`bugID`, `staffAssignedID`, `customerReportedID`, `bug title`, `bug details`, `solved`) VALUES
(1, 4, 2, 'Send button issue', 'Clicking on the button does nothing', 1);

CREATE TABLE `messages` (
  `messageID` int(11) NOT NULL,
  `senderID` int(11) NOT NULL,
  `recipientID` int(11) NOT NULL,
  `message` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `messages` (`messageID`, `senderID`, `recipientID`, `message`) VALUES
(1, 4, 2, 'Solved bug name: (Send button issue)'),
(2, 4, 2, 'Solved bug name: (Send button issue)'),
(3, 4, 2, 'Solved bug name: (Send button issue)'),
(4, 4, 2, 'Solved bug name: (Send button issue)'),
(5, 4, 2, 'Solved bug name: (Send button issue)'),
(6, 4, 2, 'Solved bug name: (Send button issue)'),
(7, 4, 2, 'Solved bug name: (Send button issue)'),
(8, 4, 2, 'Solved bug name: (Send button issue)'),
(9, 4, 2, 'Solved bug name: (Send button issue)'),
(10, 4, 2, 'Solved bug name: (Send button issue)'),
(11, 4, 2, 'Solved bug name: (Send button issue)'),
(12, 4, 2, 'Solved bug name: (Send button issue)'),
(13, 4, 2, 'Solved bug name: (Send button issue)');

CREATE TABLE `user` (
  `staffID` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `typeID` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

INSERT INTO `user` (`staffID`, `username`, `password`, `name`, `typeID`) VALUES
(1, 'admin@gmail.com', '202cb962ac59075b964b07152d234b70', 'Admin', 1),
(2, 'mged@gmail.com', '698d51a19d8a121ce581499d7b701668', 'mged', 2),
(3, 'Abdallah@gmail.com', '15de21c670ae7c3f6f3f1f37029303c9', 'Abdallah', 0),
(4, 'Kandeel@gmail.com', '202cb962ac59075b964b07152d234b70', 'Kandeel', 0);

ALTER TABLE `bug`
  ADD PRIMARY KEY (`bugID`),
  ADD KEY `bug_ibfk_1` (`customerReportedID`),
  ADD KEY `bug_ibfk_2` (`staffAssignedID`);

ALTER TABLE `messages`
  ADD PRIMARY KEY (`messageID`),
  ADD KEY `senderID` (`senderID`),
  ADD KEY `recipientID` (`recipientID`);

ALTER TABLE `user`
  ADD PRIMARY KEY (`staffID`);

ALTER TABLE `bug`
  MODIFY `bugID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

ALTER TABLE `messages`
  MODIFY `messageID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

ALTER TABLE `user`
  MODIFY `staffID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

ALTER TABLE `bug`
  ADD CONSTRAINT `bug_ibfk_1` FOREIGN KEY (`customerReportedID`) REFERENCES `user` (`staffID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `bug_ibfk_2` FOREIGN KEY (`staffAssignedID`) REFERENCES `user` (`staffID`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `messages`
  ADD CONSTRAINT `messages_ibfk_1` FOREIGN KEY (`senderID`) REFERENCES `user` (`staffID`) ON DELETE CASCADE,
  ADD CONSTRAINT `messages_ibfk_2` FOREIGN KEY (`recipientID`) REFERENCES `user` (`staffID`) ON DELETE CASCADE;
COMMIT;

