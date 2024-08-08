-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 27, 2024 at 12:09 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `libdb`
--
CREATE DATABASE IF NOT EXISTS `umulib` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `umulib`;

--
-- Table structure for table `userlog`
--

CREATE TABLE `userlog` (
  `id` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `role` varchar(50) NOT NULL,
  `activity` varchar(150) NOT NULL,
  `activitydate` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `uid` int(11) NOT NULL,
  `fullname` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `branch` varchar(25) NOT NULL,
  `password` varchar(50) NOT NULL,
  `photo` varchar(200) DEFAULT NULL,
  `status` int(2) NOT NULL DEFAULT 0,
  `accstatus` int(2) NOT NULL DEFAULT 1,
  `role` varchar(20) NOT NULL DEFAULT 'librarian'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`uid`, `fullname`, `username`, `branch`, `password`, `photo`, `status`, `accstatus`, `role`) VALUES
(1, 'Derrick Walakira', 'admin', 'ABK', '1844156d4166d94387f1a4ad031ca5fa', 'admin.jpeg', 1, 1, 'admin');

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`uid`);


--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
