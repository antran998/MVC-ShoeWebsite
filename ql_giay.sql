-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 19, 2019 at 05:22 AM
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
('A14', 'maithuy147', 'x@T12345', '2019-06-18 14:48:17'),
('A3548', 'antran456', '123456789', '2019-05-24 00:00:00'),
('A5606', 'taimatseo555', 'x@T12345', '2019-06-18 01:27:17'),
('AD100', 'antran789', 'a@T12345', '2019-05-30 00:00:00');

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
('A14', 'Mai Thùy', 'maithuy@gmail.com', '36 Tran Quang Co', '0354777777', 0),
('A3548', 'An Bảo', 'baoan11111@gmail.com', '36 Trần Quang Cơ, Phú Thạnh, Tân Phú', '0395558787', 9870000),
('A5606', 'Tấn Tài', 'tantai@gmail.com', '155 Hòa Bình', '0384648948', 0),
('AD100', 'Trần Nguyễn Bảo An', 'scorpiopro123@gmail.com', '211 Thạch Lam', '0153818611', 10710000),
('G287', 'Lộc Nguyễn', 'locnguyen@gmail.com', '98 Hoàng Sa', '0354645468', 3850000),
('G462', 'Thúy Vân', 'vanthuy@gmail.com', '14 Nguyễn Trãi', '0351684685', 2150000);

-- --------------------------------------------------------

--
-- Table structure for table `buying_history`
--

CREATE TABLE `buying_history` (
  `ID_HISTORY` int(11) NOT NULL,
  `ID` varchar(5) COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `ID_ITEM` int(11) NOT NULL,
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
(149, 'AD100', 11, 5300000, 1600000, '2019-06-16 12:42:36', '', 1, 50000),
(150, 'AD100', 5, 5300000, 1600000, '2019-06-16 12:42:36', '', 1, 50000),
(151, 'AD100', 2, 5300000, 2100000, '2019-06-16 12:42:36', '', 1, 50000),
(152, 'G462', 9, 2100000, 2100000, '2019-06-16 19:05:32', '', 1, 50000),
(153, 'G287', 6, 3800000, 3800000, '2019-06-16 19:11:35', '', 1, 50000),
(154, 'A3548', 1, 10150000, 2000000, '2019-06-17 21:54:22', 'ADVSD20', 1, 50000),
(155, 'A3548', 12, 10150000, 1950000, '2019-06-17 21:54:22', 'ADVSD20', 1, 50000),
(156, 'A3548', 9, 10150000, 2100000, '2019-06-17 21:54:22', 'ADVSD20', 1, 50000),
(157, 'A3548', 8, 10150000, 2100000, '2019-06-17 21:54:22', 'ADVSD20', 1, 50000),
(158, 'A3548', 10, 10150000, 2000000, '2019-06-17 21:54:22', 'ADVSD20', 1, 50000),
(160, 'A3548', 5, 1600000, 1600000, '2019-06-18 01:33:29', '', 1, 100000),
(161, 'AD100', 6, 5900000, 3800000, '2019-06-18 12:16:16', 'AVAARW10', 1, 50000),
(162, 'AD100', 9, 5900000, 2100000, '2019-06-18 12:16:16', 'AVAARW10', 1, 50000);

-- --------------------------------------------------------

--
-- Table structure for table `cus_review`
--

CREATE TABLE `cus_review` (
  `ID_REVIEW` int(11) NOT NULL,
  `ID` varchar(5) COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `ID_ITEM` int(11) NOT NULL,
  `CONTENT` text COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `DATE_POST` datetime NOT NULL,
  `STAR` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Dumping data for table `cus_review`
--

INSERT INTO `cus_review` (`ID_REVIEW`, `ID`, `ID_ITEM`, `CONTENT`, `DATE_POST`, `STAR`) VALUES
(1, 'A3548', 1, 'an', '2019-05-31 12:17:25', 4),
(2, 'A3548', 1, 'hehe', '2019-05-31 12:18:06', 2),
(3, 'A3548', 1, 'hoho', '2019-05-31 12:18:41', 1),
(4, 'A3548', 1, 'hàng đẹp quá', '2019-05-31 12:20:35', 5),
(7, 'A3548', 1, 'bad', '2019-06-04 02:03:22', 3),
(10, 'A3548', 1, 'very', '2019-06-04 02:54:50', 4),
(11, 'A3548', 12, 'high', '2019-06-04 02:55:21', 5),
(13, 'A3548', 11, 'Mặt hàng này rất tốt', '2019-06-04 03:47:08', 5),
(14, 'A3548', 9, 'good', '2019-06-07 02:06:59', 4),
(15, 'A3548', 1, 'no', '2019-06-16 00:46:30', 1);

-- --------------------------------------------------------

--
-- Table structure for table `deleted_item`
--

CREATE TABLE `deleted_item` (
  `ID_DELETED` int(11) NOT NULL,
  `LAST_ID_ITEM` int(11) NOT NULL,
  `NAME_ITEM` varchar(100) COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `DATE_CREATE` datetime NOT NULL,
  `DATE_DELETE` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Dumping data for table `deleted_item`
--

INSERT INTO `deleted_item` (`ID_DELETED`, `LAST_ID_ITEM`, `NAME_ITEM`, `DATE_CREATE`, `DATE_DELETE`) VALUES
(1, 1, 'Adidas Alpha G28589', '2019-06-16 00:00:00', '0000-00-00 00:00:00'),
(2, 2, 'Adidas Alpha BG28590', '2019-06-16 00:00:00', '0000-00-00 00:00:00'),
(3, 3, 'Adidas Alpha Bouce G28591', '2019-06-16 00:00:00', '0000-00-00 00:00:00'),
(4, 4, 'Adidas Alpha Bouce G28592', '2019-06-16 00:00:00', '0000-00-00 00:00:00'),
(5, 5, 'Adidas Oz Run F35560', '2019-06-16 00:00:00', '0000-00-00 00:00:00'),
(6, 6, 'Adidas EE6254', '2019-06-16 00:00:00', '0000-00-00 00:00:00'),
(7, 7, 'Adidas BC BB7418', '2019-06-16 00:00:00', '0000-00-00 00:00:00'),
(8, 8, 'Nike AirMax AT545', '2019-06-16 00:00:00', '0000-00-00 00:00:00'),
(9, 9, 'Nike Free AQ1289003', '2019-06-16 00:00:00', '0000-00-00 00:00:00'),
(10, 10, 'VANS M005', '2019-06-16 00:00:00', '0000-00-00 00:00:00'),
(11, 11, 'VANS M013', '2019-06-16 00:00:00', '0000-00-00 00:00:00'),
(12, 12, 'NewBalance Tennis WC', '2019-06-16 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `ID_ITEM` int(11) NOT NULL,
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
(2, 'Adidas Alpha BG28590', 2500000, 2200000, 'img/2.png'),
(3, 'Adidas Alpha Bouce G28591', 2500000, 2200000, 'img/3.png'),
(4, 'Adidas Alpha Bouce G28592', 2200000, 2000000, 'img/4.png'),
(5, 'Adidas Oz Run F35560', 1800000, 1600000, 'img/5.png'),
(6, 'Adidas EE6254', 4000000, 3800000, 'img/6.png'),
(7, 'Adidas BC BB7418', 2600000, 2500000, 'img/7.png'),
(8, 'Nike AirMax AT5458', 2200000, 2100000, 'img/8.png'),
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
('', 'default'),
('ADVSD20', 'X'),
('AVAARW10', 'X'),
('FGIUI', 'OK'),
('QKMEE', 'OK'),
('SMDAJB', 'OK'),
('VOIDLIFH', 'OK'),
('ZKJKSDF', 'OK');

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
  ADD KEY `ACCOUNT_ID` (`ID`),
  ADD KEY `ITEM_ID` (`ID_ITEM`);

--
-- Indexes for table `deleted_item`
--
ALTER TABLE `deleted_item`
  ADD PRIMARY KEY (`ID_DELETED`);

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
  MODIFY `ID_HISTORY` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=163;

--
-- AUTO_INCREMENT for table `cus_review`
--
ALTER TABLE `cus_review`
  MODIFY `ID_REVIEW` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

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
  ADD CONSTRAINT `ID_VOUCHER` FOREIGN KEY (`VOUCHER`) REFERENCES `voucher` (`ID_VOUCHER`);

--
-- Constraints for table `cus_review`
--
ALTER TABLE `cus_review`
  ADD CONSTRAINT `ACCOUNT_ID` FOREIGN KEY (`ID`) REFERENCES `account_info` (`ID`),
  ADD CONSTRAINT `ITEM_ID` FOREIGN KEY (`ID_ITEM`) REFERENCES `items` (`ID_ITEM`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
