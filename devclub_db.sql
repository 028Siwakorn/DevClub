-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 16, 2025 at 05:12 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `devclub_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `admin_id` int(11) NOT NULL,
  `fullname` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`admin_id`, `fullname`, `email`, `password`) VALUES
(1, 'ผู้ดูแลระบบ', 'admin@devclub.com', '123456'),
(2, 'รัชชานนท์ ลี้เจริญ', 'dewtete@gmail.com', 'te0946475522'),
(3, 'ศิวกรณ์', 'Siwakron@gmail.com', '123456');

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE `members` (
  `member_id` int(11) NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `major` varchar(100) NOT NULL,
  `academic_year` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`member_id`, `fullname`, `email`, `major`, `academic_year`) VALUES
(3, 'สมชาย ใจดี', 'somchai@example.com', 'คณิตศาสตร์', 2565),
(4, 'สมหญิง แสนดี', 'somying@example.com', 'ฟิสิกส์', 2564),
(5, 'ณัฐวุฒิ พงษ์ชัย', 'nattawut@example.com', 'เคมี', 2565),
(6, 'พรพิมล ศรีสุข', 'pornpimol@example.com', 'ชีววิทยา', 2563),
(7, 'วิษณุ แก้วใส', 'wisanu@example.com', 'วิทยาการคอมพิวเตอร์', 2565),
(8, 'อรทัย นิลมงคล', 'ornthai@example.com', 'สถิติ', 2564),
(9, 'จิรัฏฐ์ ศรีทอง', 'jiratt@example.com', 'วิศวกรรมซอฟต์แวร์', 2565),
(10, 'กิติพัฒน์ เกียรติวงศ์', 'kitipat@example.com', 'วิทยาการคอมพิวเตอร์', 2563),
(11, 'สุดารัตน์ แสงทอง', 'sudarat@example.com', 'ฟิสิกส์', 2565),
(12, 'อนุชา บุญมี', 'anucha@example.com', 'วิศวกรรมซอฟต์แวร์', 2564);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`admin_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`member_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `members`
--
ALTER TABLE `members`
  MODIFY `member_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
