-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 11, 2019 at 07:41 PM
-- Server version: 5.7.14
-- PHP Version: 5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `library`
--

-- --------------------------------------------------------

--
-- Table structure for table `author`
--

CREATE TABLE `author` (
  `aid` int(5) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `author`
--

INSERT INTO `author` (`aid`, `name`) VALUES
(0, 'Unknown Author'),
(1, 'Vaikkom Muhammad Basheer'),
(2, 'Science Author'),
(3, 'Chetan Bhagat'),
(4, 'Programmer');

-- --------------------------------------------------------

--
-- Table structure for table `book`
--

CREATE TABLE `book` (
  `bid` int(5) NOT NULL,
  `barcode` varchar(15) DEFAULT NULL,
  `name` varchar(50) NOT NULL,
  `edition` smallint(2) NOT NULL,
  `pubid` int(5) NOT NULL,
  `authid` int(5) NOT NULL,
  `catid` int(5) NOT NULL,
  `isbn` varchar(13) NOT NULL,
  `issue` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0=not issued, 1= issued'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `book`
--

INSERT INTO `book` (`bid`, `barcode`, `name`, `edition`, `pubid`, `authid`, `catid`, `isbn`, `issue`) VALUES
(1, '000100022963789', 'Balyakalasakhi', 3, 2, 1, 2, '7418529637894', 0),
(2, '000200038369123', 'MySQL', 8, 4, 4, 3, '1472583691236', 1),
(3, '000300032741456', 'C++', 12, 4, 4, 3, '9638527414568', 0),
(4, '000400012085419', 'Physics', 1, 3, 2, 1, '9516320854196', 0),
(5, '000500026789654', 'Half Girlfriend', 2, 1, 3, 2, '1234567896542', 0);

-- --------------------------------------------------------

--
-- Table structure for table `bookissue`
--

CREATE TABLE `bookissue` (
  `isid` int(5) NOT NULL,
  `uid` int(5) NOT NULL,
  `bid` int(5) NOT NULL,
  `issuedate` date NOT NULL,
  `returndate` date DEFAULT NULL,
  `fine` int(4) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bookissue`
--

INSERT INTO `bookissue` (`isid`, `uid`, `bid`, `issuedate`, `returndate`, `fine`) VALUES
(1, 2, 1, '2019-02-25', '2019-03-11', 0),
(2, 4, 5, '2019-01-07', '2019-03-11', 240),
(3, 2, 2, '2019-03-11', NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `cid` int(5) NOT NULL,
  `name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`cid`, `name`) VALUES
(0, 'Other'),
(1, 'Science and Technology'),
(2, 'Novels'),
(3, 'Programming');

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `lid` int(5) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(100) NOT NULL,
  `type` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`lid`, `username`, `password`, `type`) VALUES
(1, 'admin', '$2y$10$id1hQbjfcwsSN6Dlu/BbAuVgNPcj6..ly65v6TRs7XnXpVYwkGHGy', 0),
(2, 'anaz123', '$2y$10$JEjgImwm9dsmWVkQ7YeOue.xGGbJd2HPV55/1xIF56SGLyXkymNz2', 1),
(3, 'thejusr', '$2y$10$hSDSuAP.KjltoC/BmuTz6.d0pmTdvWDfwX5CV2gi8X1Zatz95/EVu', 1),
(4, 'abhishek', '$2y$10$uP93OnKtHYGoA7Q.JFTuN.PBlpY1SVyp1ASL7SQLaaWbr66X7lcGa', 1);

-- --------------------------------------------------------

--
-- Table structure for table `publisher`
--

CREATE TABLE `publisher` (
  `pid` int(5) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `publisher`
--

INSERT INTO `publisher` (`pid`, `name`) VALUES
(0, 'Unknown Publisher'),
(1, 'XYZ Publishers'),
(2, 'ABC Publishers'),
(3, 'Science Publishers'),
(4, 'Programming  Publishers');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `uid` int(5) NOT NULL,
  `rfid` varchar(10) DEFAULT NULL,
  `name` varchar(50) NOT NULL,
  `username` varchar(20) NOT NULL,
  `email` varchar(30) NOT NULL,
  `mobile` bigint(10) NOT NULL,
  `rgon` date NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`uid`, `rfid`, `name`, `username`, `email`, `mobile`, `rgon`, `status`) VALUES
(1, '0', 'Admin', 'admin', '', 0, '1900-01-01', 1),
(2, '0014450963', 'Anaz', 'anaz123', 'anaz@lms.prj', 9966771122, '2019-03-04', 1),
(3, NULL, 'Rince Thejus Raju', 'thejusr', 'thejus@lms.prj', 7418529635, '2019-03-05', 1),
(4, '0012991560', 'Abhishek', 'abhishek', 'abhishek@lms.prj', 8946512345, '2019-03-08', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `author`
--
ALTER TABLE `author`
  ADD PRIMARY KEY (`aid`);

--
-- Indexes for table `book`
--
ALTER TABLE `book`
  ADD PRIMARY KEY (`bid`),
  ADD UNIQUE KEY `barcode` (`barcode`),
  ADD KEY `authid` (`authid`),
  ADD KEY `catid` (`catid`),
  ADD KEY `authid_2` (`authid`),
  ADD KEY `pubid` (`pubid`);

--
-- Indexes for table `bookissue`
--
ALTER TABLE `bookissue`
  ADD PRIMARY KEY (`isid`),
  ADD KEY `uid` (`uid`),
  ADD KEY `bid` (`bid`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`cid`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`lid`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `publisher`
--
ALTER TABLE `publisher`
  ADD PRIMARY KEY (`pid`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`uid`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `mobile` (`mobile`),
  ADD UNIQUE KEY `rfid` (`rfid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `author`
--
ALTER TABLE `author`
  MODIFY `aid` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `book`
--
ALTER TABLE `book`
  MODIFY `bid` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `bookissue`
--
ALTER TABLE `bookissue`
  MODIFY `isid` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `cid` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `lid` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `publisher`
--
ALTER TABLE `publisher`
  MODIFY `pid` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `uid` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `book`
--
ALTER TABLE `book`
  ADD CONSTRAINT `book_ibfk_1` FOREIGN KEY (`authid`) REFERENCES `author` (`aid`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `book_ibfk_2` FOREIGN KEY (`catid`) REFERENCES `category` (`cid`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `book_ibfk_3` FOREIGN KEY (`pubid`) REFERENCES `publisher` (`pid`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `bookissue`
--
ALTER TABLE `bookissue`
  ADD CONSTRAINT `bookissue_ibfk_1` FOREIGN KEY (`bid`) REFERENCES `book` (`bid`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `bookissue_ibfk_2` FOREIGN KEY (`uid`) REFERENCES `user` (`uid`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `login`
--
ALTER TABLE `login`
  ADD CONSTRAINT `login_ibfk_1` FOREIGN KEY (`username`) REFERENCES `user` (`username`) ON DELETE NO ACTION ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
