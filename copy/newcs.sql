-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 20, 2024 at 06:09 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `newcs`
--

-- --------------------------------------------------------

--
-- Table structure for table `posterdetails`
--

CREATE TABLE `posterdetails` (
  `posterDetail_ID` int(20) DEFAULT NULL,
  `companyID` int(50) DEFAULT NULL,
  `posterID` int(20) DEFAULT NULL,
  `posterCode` varchar(100) DEFAULT NULL,
  `posterName` varchar(100) DEFAULT NULL,
  `RefDate` varchar(50) DEFAULT NULL,
  `RefNo` varchar(50) DEFAULT NULL,
  `CompanyName` varchar(100) DEFAULT NULL,
  `ContactPerson` varchar(100) DEFAULT NULL,
  `ContactMobile` varchar(100) DEFAULT NULL,
  `SaleValue` varchar(100) DEFAULT NULL,
  `Description` varchar(100) DEFAULT NULL,
  `Tax` varchar(50) DEFAULT NULL,
  `Total` varchar(50) DEFAULT NULL,
  `ExecutiveName` varchar(100) DEFAULT NULL,
  `ExecutiveMobile` varchar(100) DEFAULT NULL,
  `Product` varchar(50) DEFAULT NULL,
  `Remark` varchar(100) DEFAULT NULL,
  `CreatedDate` date NOT NULL DEFAULT current_timestamp(),
  `CreatedBy` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `posterdetails`
--

INSERT INTO `posterdetails` (`posterDetail_ID`, `companyID`, `posterID`, `posterCode`, `posterName`, `RefDate`, `RefNo`, `CompanyName`, `ContactPerson`, `ContactMobile`, `SaleValue`, `Description`, `Tax`, `Total`, `ExecutiveName`, `ExecutiveMobile`, `Product`, `Remark`, `CreatedDate`, `CreatedBy`) VALUES
(1, 12, 1, '1', 'Tally', '20/03/2002', 'rws-29002', 'Ahmed', 'Ahmed', '9009929', '90000', 'Ahmed', '100', '10000', 'Ahmed', '90000', 'Tally', 'Ahmed', '2024-01-18', 'ahmed'),
(2, NULL, 1, 'RWS-001', 'TALLYSURP', '', '', 'Tally Solutions Pvt Ltd', NULL, NULL, '', '', '', '20/40/14/black', '', '', 'TallyERP', NULL, '2024-01-20', NULL),
(3, 0, 2, 'RWS-002', 'TALLYSURP', '', '', 'Tally Solutions Pvt Ltd', NULL, NULL, '', '', '', '90/187/14/white', '', '', 'TallyCloud', NULL, '2024-01-20', 'admin'),
(4, 0, 2, 'RWS-002', 'TALLYSURP', '', '', 'B.JALALAHMED', NULL, NULL, '', '', '', '90/187/14/white', '', '', 'TallyCloud', NULL, '2024-01-20', 'admin'),
(5, 0, 2, 'RWS-002', 'TALLYSURP', '', '', 'ahjj', NULL, NULL, '', '', '', '90/187/14/white', '', '', 'TallyCloud', NULL, '2024-01-20', 'admin'),
(6, 0, 2, 'RWS-002', 'TALLYSURP', '', '', 'Tally Solutions Pvt Ltd', NULL, NULL, '', '', '', '90/187/14/white', '', '', 'TallyCloud', NULL, '2024-01-20', 'admin'),
(7, 0, 2, 'RWS-002', 'TALLYSURP', '', '', 'Tally Solutions Pvt Ltd', NULL, NULL, '', '', '', '90/187/14/white', '', '', 'TallyCloud', NULL, '2024-01-20', 'admin'),
(8, 0, 2, 'RWS-002', 'TALLYSURP', '', '', 'Tally Solutions Pvt Ltd', NULL, NULL, '', '', '', '90/187/14/white', '', '', 'TallyCloud', NULL, '2024-01-20', 'admin'),
(9, 0, 2, 'RWS-002', 'TALLYSURP', '', '', 'Tally Solutions Pvt Ltd', NULL, NULL, '', '', '', '90/187/14/white', '', '', 'TallyCloud', NULL, '2024-01-20', 'admin'),
(10, 0, 2, 'RWS-002', 'TALLYSURP', '', '', 'Tally Solutions Pvt Ltd', NULL, NULL, '', '', '', '90/187/14/white', '', '', 'TallyCloud', NULL, '2024-01-20', 'admin'),
(11, 0, 2, 'RWS-002', 'TALLYSURP', '', '', 'Tally Solutions Pvt Ltd', NULL, NULL, '', '', '', '90/187/14/white', '', '', 'TallyCloud', NULL, '2024-01-20', 'admin'),
(12, 0, 2, 'RWS-002', 'TALLYSURP', '', '', 'Tally Solutions Pvt Ltd', NULL, NULL, '', '', '', '90/187/14/white', '', '', 'TallyCloud', NULL, '2024-01-20', 'admin'),
(13, 0, 2, 'RWS-002', 'TALLYSURP', '', '', 'Tally Solutions Pvt Ltd', NULL, NULL, '', '', '', '90/187/14/white', '', '', 'TallyCloud', NULL, '2024-01-20', 'admin'),
(14, 0, 2, 'RWS-002', 'TALLYSURP', '', '', 'Tally Solutions Pvt Ltd', NULL, NULL, '', '', '', '90/187/14/white', '', '', 'TallyCloud', NULL, '2024-01-20', 'admin'),
(15, 0, 2, 'RWS-002', 'TALLYSURP', '', '', 'Tally Solutions Pvt Ltd', NULL, NULL, '', '', '', '90/187/14/white', '', '', 'TallyCloud', NULL, '2024-01-20', 'admin'),
(16, 0, 2, 'RWS-002', 'TALLYSURP', '', '', 'Tally Solutions Pvt Ltd', NULL, NULL, '', '', '', '90/187/14/white', '', '', 'TallyCloud', NULL, '2024-01-20', 'admin'),
(17, 0, 2, 'RWS-002', 'TALLYSURP', '', '', 'Tally Solutions Pvt Ltd', NULL, NULL, '', '', '', '90/187/14/white', '', '', 'TallyCloud', NULL, '2024-01-20', 'admin'),
(18, 0, 2, 'RWS-002', 'TALLYSURP', '', '', 'Tally Solutions Pvt Ltd', NULL, NULL, '', '', '', '90/187/14/white', '', '', 'TallyCloud', NULL, '2024-01-20', 'admin'),
(19, 0, 2, 'RWS-002', 'TALLYSURP', '', '', 'Tally Solutions Pvt Ltd', NULL, NULL, '', '', '', '90/187/14/white', '', '', 'TallyCloud', NULL, '2024-01-20', 'admin'),
(20, 0, 2, 'RWS-002', 'TALLYSURP', '', '', 'Tally Solutions Pvt Ltd', NULL, NULL, '', '', '', '90/187/14/white', '', '', 'TallyCloud', NULL, '2024-01-20', 'admin'),
(21, 0, 2, 'RWS-002', 'TALLYSURP', '', '', 'Tally Solutions Pvt Ltd', NULL, NULL, '', '', '', '90/187/14/white', '', '', 'TallyCloud', NULL, '2024-01-20', 'admin'),
(22, 0, 2, 'RWS-002', 'TALLYSURP', '', '', 'Tally Solutions Pvt Ltd', NULL, NULL, '', '', '', '90/187/14/white', '', '', 'TallyCloud', NULL, '2024-01-20', 'admin'),
(23, 0, 2, 'RWS-002', 'TALLYSURP', '', '', 'Tally Solutions Pvt Ltd', NULL, NULL, '', '', '', '90/187/14/white', '', '', 'TallyCloud', NULL, '2024-01-20', 'admin'),
(24, 0, 2, 'RWS-002', 'TALLYSURP', '', '', 'Tally Solutions Pvt Ltd', NULL, NULL, '', '', '', '90/187/14/white', '', '', 'TallyCloud', NULL, '2024-01-20', 'admin'),
(25, 0, 2, 'RWS-002', 'TALLYSURP', '', '', 'Tally Solutions Pvt Ltd', NULL, NULL, '', '', '', '90/187/14/white', '', '', 'TallyCloud', NULL, '2024-01-20', 'admin'),
(26, 0, 2, 'RWS-002', 'TALLYSURP', '', '', 'Tally Solutions Pvt Ltd', NULL, NULL, '', '', '', '90/187/14/white', '', '', 'TallyCloud', NULL, '2024-01-20', 'admin'),
(27, 0, 2, 'RWS-002', 'TALLYSURP', '', '', 'Tally Solutions Pvt Ltd', NULL, NULL, '', '', '', '90/187/14/white', '', '', 'TallyCloud', NULL, '2024-01-20', 'admin'),
(28, 0, 2, 'RWS-002', 'TALLYSURP', '', '', 'Tally Solutions Pvt Ltd', NULL, NULL, '', '', '', '90/187/14/white', '', '', 'TallyCloud', NULL, '2024-01-20', 'admin'),
(29, 0, 2, 'RWS-002', 'TALLYSURP', '', '', 'kdbhzsmda', NULL, NULL, '', '', '', '90/187/14/white', '', '', 'TallyCloud', NULL, '2024-01-20', 'admin'),
(30, 0, 2, 'RWS-002', 'TALLYSURP', '', '', 'Tally Solutions Pvt Ltd', NULL, NULL, '', '', '', '90/187/14/white', '', '', 'TallyCloud', NULL, '2024-01-20', 'admin'),
(31, 0, 2, 'RWS-002', 'TALLYSURP', '', '', 'My Tally', NULL, NULL, '', '', '', '90/187/14/white', '', '', 'TallyCloud', NULL, '2024-01-20', 'admin'),
(32, 0, 2, 'RWS-002', 'TALLYSURP', '', '', 'My Tally', NULL, NULL, '', '', '', '90/187/14/white', '', '', 'TallyCloud', NULL, '2024-01-20', 'admin'),
(33, 0, 2, 'RWS-002', 'TALLYSURP', '', '', 'Two Tally', NULL, NULL, '', '', '', '90/187/14/white', '', '', 'TallyCloud', NULL, '2024-01-20', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `postermaster`
--

CREATE TABLE `postermaster` (
  `posterID` int(20) DEFAULT NULL,
  `posterCode` varchar(100) DEFAULT NULL,
  `posterName` varchar(100) DEFAULT NULL,
  `RefDatepos` varchar(100) DEFAULT NULL,
  `RefNopos` varchar(100) DEFAULT NULL,
  `CompanyNamepos` varchar(100) DEFAULT NULL,
  `ContactPersonpos` varchar(100) DEFAULT NULL,
  `ContactMobilepos` varchar(100) DEFAULT NULL,
  `SaleValuepos` varchar(100) DEFAULT NULL,
  `Descriptionpos` varchar(100) DEFAULT NULL,
  `TaxPos` varchar(100) DEFAULT NULL,
  `TotalPos` varchar(100) DEFAULT NULL,
  `ExecutiveNamePos` varchar(100) DEFAULT NULL,
  `ExecutiveMobilePos` varchar(100) DEFAULT NULL,
  `Product` varchar(100) DEFAULT NULL,
  `SaleValueDef` varchar(100) DEFAULT NULL,
  `TaxDef` varchar(100) DEFAULT NULL,
  `TotalDef` varchar(100) DEFAULT NULL,
  `DescriptionDef` varchar(200) DEFAULT NULL,
  `OrderSeq` varchar(100) DEFAULT NULL,
  `Flags` varchar(100) DEFAULT NULL,
  `DocType` varchar(100) DEFAULT NULL,
  `keywords` varchar(100) DEFAULT NULL,
  `file_name` varchar(100) DEFAULT NULL,
  `created_at` date NOT NULL DEFAULT current_timestamp(),
  `created_by` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `postermaster`
--

INSERT INTO `postermaster` (`posterID`, `posterCode`, `posterName`, `RefDatepos`, `RefNopos`, `CompanyNamepos`, `ContactPersonpos`, `ContactMobilepos`, `SaleValuepos`, `Descriptionpos`, `TaxPos`, `TotalPos`, `ExecutiveNamePos`, `ExecutiveMobilePos`, `Product`, `SaleValueDef`, `TaxDef`, `TotalDef`, `DescriptionDef`, `OrderSeq`, `Flags`, `DocType`, `keywords`, `file_name`, `created_at`, `created_by`) VALUES
(1, 'RWS-001', 'TALLYSURP', '50/30/14/black', '20/90/14/black', '20/30/14/red', '20/80/14/black', '20/20/14/black', '20/40/14/black', '20/50/14/black', '90/200/14/white', '90/205/14/white', '20/60/14/black', '20/70/14/black', 'TallyERP', '10000', '1000', '10000', 'This is an Tally ERP Product', '1', 'favorite,important', 'quotation', 'TallySU', 'Tally.pdf', '2024-01-10', 'admin'),
(2, 'RWS-002', 'TALLYSURP', '20/20/14/red', '20/30/14/red', '20/40/14/red', '20/50/14/red', '90/184/14/white', '90/187/14/white', '90/190/14/white', '90/200/14/white', '90/205/14/white', '20/60/14/red', '20/70/14/red', 'TallyCloud', '10000', '1000', '10000', 'This is an Tally ERP Product', '1', 'favorite', 'poster', 'TallySURP', 'TALLYSURP.jpg', '2024-01-10', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `user_master`
--

CREATE TABLE `user_master` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `role` varchar(50) NOT NULL,
  `tags` varchar(100) NOT NULL,
  `created_at` date NOT NULL,
  `edited_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_master`
--

INSERT INTO `user_master` (`id`, `username`, `password`, `role`, `tags`, `created_at`, `edited_at`) VALUES
(1, 'admin', '$2y$12$jZ.NNTnhfYFe1B.wu6m0felvqABorqhLRSxFona7W9eAyxuP7PmYi', 'admin', 'all', '2023-10-25', '2023-10-25'),
(2, 'user1', '$2y$12$jZ.NNTnhfYFe1B.wu6m0felvqABorqhLRSxFona7W9eAyxuP7PmYi', 'user', 'address,ideas', '2023-10-26', '2023-10-26');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `posterdetails`
--
ALTER TABLE `posterdetails`
  ADD UNIQUE KEY `posterDetail_id` (`posterDetail_ID`);

--
-- Indexes for table `postermaster`
--
ALTER TABLE `postermaster`
  ADD UNIQUE KEY `postid` (`posterID`),
  ADD UNIQUE KEY `postcode` (`posterCode`);

--
-- Indexes for table `user_master`
--
ALTER TABLE `user_master`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `user_master`
--
ALTER TABLE `user_master`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
