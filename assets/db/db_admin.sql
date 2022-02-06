-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 06, 2022 at 04:14 AM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 7.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_admin`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `username` varchar(30) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(50) NOT NULL,
  `role` varchar(50) NOT NULL DEFAULT 'user',
  `status` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`id`, `name`, `username`, `email`, `password`, `role`, `status`) VALUES
(10, 'Administrator', 'admin', 'admin@gmail.com', 'cd92a26534dba48cd785cdcc0b3e6bd1', 'admin', 1),
(11, 'Abdus Salam', 'abdus_salam', 'salam@gamil.com', 'ee11cbb19052e40b07aac0ca060c23ee', 'user', 1),
(12, 'Kamal Ahmed', 'kamal', 'kamal@gmail.com', 'ee11cbb19052e40b07aac0ca060c23ee', 'user', 1),
(13, 'Mahbub', 'mahbub', 'mahbub@gmail.com', 'ee11cbb19052e40b07aac0ca060c23ee', 'user', 1),
(14, 'Faruk Ahmed', 'faruk', 'faruk@gmail.com', 'ee11cbb19052e40b07aac0ca060c23ee', 'user', 1),
(15, 'Abdullah Al Mamun', 'mamun', 'mamun@gmail.com', 'ee11cbb19052e40b07aac0ca060c23ee', 'user', 0),
(16, 'Abdul Kader', 'kader', 'kader@gmail.com', 'ee11cbb19052e40b07aac0ca060c23ee', 'user', 1),
(17, 'Hasan Ali', 'hasan', 'hasan@gmail.com', 'ee11cbb19052e40b07aac0ca060c23ee', 'user', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
