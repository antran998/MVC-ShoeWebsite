-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 31, 2019 at 06:26 AM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ql_giay`
--

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE `account` (
  `ID` varchar(5) COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `USERNAME` varchar(20) COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `PASSWORD` varchar(50) COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `CREATE_TIME` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`ID`, `USERNAME`, `PASSWORD`, `CREATE_TIME`) VALUES
('A3548', 'antran456', '123456789', '2019-05-24 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `account_info`
--

CREATE TABLE `account_info` (
  `ID` varchar(5) COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `FULL_NAME` varchar(50) COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `EMAIL` varchar(100) COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `ADDRESS` varchar(100) COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `PHONE` varchar(13) COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `MONEY_PAID` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Dumping data for table `account_info`
--

INSERT INTO `account_info` (`ID`, `FULL_NAME`, `EMAIL`, `ADDRESS`, `PHONE`, `MONEY_PAID`) VALUES
('A3548', 'An Bả', 'baoan11111@gmail.com', '36 Trần Quang Cơ, Phú Thạnh, Tân Phú', '0395558787', 10950000),
('G4337', 'An Trần', 'baoan11111@gmail.com', '36 Trần Quang Cơ', '0123456789', 1950000);

-- --------------------------------------------------------

--
-- Table structure for table `buying_history`
--

CREATE TABLE `buying_history` (
  `ID_HISTORY` int(11) NOT NULL,
  `ID` varchar(5) COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `ID_ITEM` int(20) NOT NULL,
  `TOTAL_PRICE` double NOT NULL,
  `SINGLE_PRICE` double NOT NULL,
  `DATE_BOUGHT` datetime NOT NULL,
  `VOUCHER` varchar(20) COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `QUANTITY` int(11) NOT NULL,
  `SHIPFEE` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Dumping data for table `buying_history`
--

INSERT INTO `buying_history` (`ID_HISTORY`, `ID`, `ID_ITEM`, `TOTAL_PRICE`, `SINGLE_PRICE`, `DATE_BOUGHT`, `VOUCHER`, `QUANTITY`, `SHIPFEE`) VALUES
(7, 'A3548', 5, 20000, 10000, '2019-05-29 02:06:56', 'ADVSD', 5, 20000),
(58, 'A3548', 1, 2000000, 2000000, '2019-05-30 19:04:42', 'ADVSD', 1, 50000),
(60, 'A3548', 12, 3950000, 1950000, '2019-05-31 01:35:21', 'ADVSD', 1, 50000),
(67, 'A3548', 1, 3950000, 2000000, '2019-05-31 03:37:00', 'ADVSD', 1, 100000),
(68, 'A3548', 12, 3950000, 1950000, '2019-05-31 03:37:00', 'ADVSD', 1, 100000),
(69, 'G4337', 12, 1950000, 1950000, '2019-05-31 05:16:49', 'ADVSD', 1, 0),
(71, 'A3548', 11, 1600000, 1600000, '2019-05-31 05:42:42', 'ADVSD', 1, 50000),
(72, 'A3548', 12, 1950000, 1950000, '2019-05-31 05:43:53', 'ADVSD', 1, 50000),
(73, 'A3548', 12, 1950000, 1950000, '2019-05-31 05:45:12', 'ADVSD', 1, 50000),
(74, 'A3548', 9, 2100000, 2100000, '2019-05-31 05:47:53', 'ADVSD', 1, 0),
(75, 'A3548', 10, 2000000, 2000000, '2019-05-31 05:51:13', 'ADVSD', 1, 100000),
(76, 'A3548', 12, 1950000, 1950000, '2019-05-31 05:53:32', 'ADVSD', 1, 0),
(77, 'A3548', 9, 2100000, 2100000, '2019-05-31 05:55:35', 'ADVSD', 1, 0),
(78, 'A3548', 10, 2000000, 2000000, '2019-05-31 05:56:28', 'ADVSD', 1, 0),
(79, 'A3548', 12, 1950000, 1950000, '2019-05-31 05:58:38', 'ADVSD', 1, 0),
(80, 'A3548', 1, 2000000, 2000000, '2019-05-31 10:27:54', 'ADVSD', 1, 50000);

-- --------------------------------------------------------

--
-- Table structure for table `cus_review`
--

CREATE TABLE `cus_review` (
  `ID_REVIEW` int(11) NOT NULL,
  `ID` varchar(5) COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `CONTENT` text COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `DATE_POST` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `ID_ITEM` int(20) NOT NULL,
  `NAME` varchar(50) COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `PRICE` double NOT NULL,
  `DISCOUNT_PRICE` double NOT NULL,
  `IMG_ITEM` varchar(1000) COLLATE utf8mb4_vietnamese_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`ID_ITEM`, `NAME`, `PRICE`, `DISCOUNT_PRICE`, `IMG_ITEM`) VALUES
(1, 'Adidas Alpha G28589', 2200000, 2000000, 'img/1.png'),
(2, 'Adidas Alpha BG28590', 2600000, 2100000, 'img/2.png'),
(3, 'Adidas Alpha Bouce G28591', 2500000, 2200000, 'img/3.png'),
(4, 'Adidas Alpha Bouce G28592', 2200000, 2000000, 'img/4.png'),
(5, 'Adidas Oz Run F35560', 1800000, 1600000, 'img/5.png'),
(6, 'Adidas EE6254', 4000000, 3800000, 'img/6.png'),
(7, 'Adidas BC BB7418', 2600000, 2500000, 'img/7.png'),
(8, 'Nike AirMax AT5458', 1600000, 1500000, 'img/8.png'),
(9, 'Nike Free AQ1289003', 2200000, 2100000, 'img/9.png'),
(10, 'VANS M005', 2200000, 2000000, 'img/10.png'),
(11, 'VANS M013', 1750000, 1600000, 'img/11.png'),
(12, 'NewBalance Tennis WC', 2300000, 1950000, 'img/12.png');

-- --------------------------------------------------------

--
-- Table structure for table `voucher`
--

CREATE TABLE `voucher` (
  `ID_VOUCHER` varchar(8) COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `STATUS` varchar(8) COLLATE utf8mb4_vietnamese_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Dumping data for table `voucher`
--

INSERT INTO `voucher` (`ID_VOUCHER`, `STATUS`) VALUES
('ADVSD', 'OK');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `ID` (`ID`,`USERNAME`);

--
-- Indexes for table `account_info`
--
ALTER TABLE `account_info`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `ID` (`ID`),
  ADD UNIQUE KEY `PHONE` (`PHONE`);

--
-- Indexes for table `buying_history`
--
ALTER TABLE `buying_history`
  ADD PRIMARY KEY (`ID_HISTORY`),
  ADD KEY `ID_ITEM` (`ID_ITEM`),
  ADD KEY `ID_VOUCHER` (`VOUCHER`),
  ADD KEY `ID_FOR_ACCOUNT` (`ID`);

--
-- Indexes for table `cus_review`
--
ALTER TABLE `cus_review`
  ADD PRIMARY KEY (`ID_REVIEW`),
  ADD KEY `ACCOUNT_ID` (`ID`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`ID_ITEM`),
  ADD UNIQUE KEY `NAME` (`NAME`);

--
-- Indexes for table `voucher`
--
ALTER TABLE `voucher`
  ADD PRIMARY KEY (`ID_VOUCHER`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `buying_history`
--
ALTER TABLE `buying_history`
  MODIFY `ID_HISTORY` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- AUTO_INCREMENT for table `cus_review`
--
ALTER TABLE `cus_review`
  MODIFY `ID_REVIEW` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `account`
--
ALTER TABLE `account`
  ADD CONSTRAINT `ID_ACCOUNT` FOREIGN KEY (`ID`) REFERENCES `account_info` (`ID`);

--
-- Constraints for table `buying_history`
--
ALTER TABLE `buying_history`
  ADD CONSTRAINT `ID_FOR_ACCOUNT` FOREIGN KEY (`ID`) REFERENCES `account_info` (`ID`),
  ADD CONSTRAINT `ID_ITEM` FOREIGN KEY (`ID_ITEM`) REFERENCES `items` (`ID_ITEM`),
  ADD CONSTRAINT `ID_VOUCHER` FOREIGN KEY (`VOUCHER`) REFERENCES `voucher` (`ID_VOUCHER`);

--
-- Constraints for table `cus_review`
--
ALTER TABLE `cus_review`
  ADD CONSTRAINT `ACCOUNT_ID` FOREIGN KEY (`ID`) REFERENCES `account_info` (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
