-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 14, 2024 at 07:40 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `peminjamanit`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_brg`
--

CREATE TABLE `tb_brg` (
  `idBrg` int(11) NOT NULL,
  `sKode` varchar(30) NOT NULL,
  `sName` varchar(60) NOT NULL,
  `decQty` float NOT NULL DEFAULT 0,
  `sType` int(11) NOT NULL,
  `iCreateBy` int(11) NOT NULL,
  `dtCreate` datetime NOT NULL DEFAULT current_timestamp(),
  `iModifyBy` int(11) DEFAULT NULL,
  `dtModify` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `tb_brg`
--

INSERT INTO `tb_brg` (`idBrg`, `sKode`, `sName`, `decQty`, `sType`, `iCreateBy`, `dtCreate`, `iModifyBy`, `dtModify`) VALUES
(10, 'A001', 'PC Besar', 29, 1, 2, '2024-05-14 23:05:36', 2, '2024-05-14 23:14:32'),
(11, 'A002', 'Mini PC', 46, 1, 2, '2024-05-14 23:05:57', 2, '2024-05-14 23:14:39'),
(12, 'A003', 'Monitor', 60, 1, 2, '2024-05-14 23:07:04', NULL, NULL),
(13, 'A004', 'Proyektor', 10, 1, 2, '2024-05-14 23:08:19', 2, '2024-05-14 23:14:52'),
(14, 'A005', 'Handphone - Iphone', 20, 1, 2, '2024-05-14 23:09:18', NULL, NULL),
(15, 'B001', 'Mouse', 100, 2, 2, '2024-05-14 23:09:43', NULL, NULL),
(16, 'A006', 'Laptop', 50, 1, 2, '2024-05-14 23:11:16', NULL, NULL),
(17, 'A007', 'Printer', 10, 1, 2, '2024-05-14 23:12:35', NULL, NULL),
(18, 'B002', 'Kabel Charger Laptop', 100, 2, 2, '2024-05-14 23:13:22', 2, '2024-05-14 23:15:16'),
(19, 'B003', 'Kabel Charger Iphone', 40, 2, 2, '2024-05-14 23:13:43', 2, '2024-05-14 23:15:24'),
(20, 'B004', 'Kabel HDMI', 50, 2, 2, '2024-05-14 23:14:23', NULL, NULL),
(21, 'B004', 'Kabel USB', 20, 2, 2, '2024-05-14 23:15:56', NULL, NULL),
(22, 'B005', 'HardDisk', 300, 2, 2, '2024-05-14 23:16:23', NULL, NULL),
(23, 'B006', 'Suku Cadang Printer', 40, 2, 2, '2024-05-14 23:16:50', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tb_request`
--

CREATE TABLE `tb_request` (
  `idReq` int(11) NOT NULL,
  `sReqNum` varchar(50) NOT NULL,
  `sEmpID` varchar(50) NOT NULL,
  `sKdBrg` varchar(50) NOT NULL,
  `decReqQty` float NOT NULL,
  `dtReqStart` datetime NOT NULL,
  `dtReqEnd` datetime NOT NULL,
  `sEmpApp` varchar(50) NOT NULL,
  `iStatus` int(11) NOT NULL,
  `iCreateBy` int(11) NOT NULL,
  `dtCreate` datetime NOT NULL DEFAULT current_timestamp(),
  `iModifyBy` int(11) DEFAULT NULL,
  `dtModify` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tb_user`
--

CREATE TABLE `tb_user` (
  `idUser` int(11) NOT NULL,
  `sEmpID` varchar(50) NOT NULL,
  `sFullname` varchar(150) DEFAULT NULL,
  `sPassword` text NOT NULL,
  `sRole` varchar(30) NOT NULL DEFAULT 'user',
  `dtCreate` datetime DEFAULT current_timestamp(),
  `iCreateBy` int(11) DEFAULT 0,
  `dtModify` datetime DEFAULT NULL,
  `iModifyBy` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `tb_user`
--

INSERT INTO `tb_user` (`idUser`, `sEmpID`, `sFullname`, `sPassword`, `sRole`, `dtCreate`, `iCreateBy`, `dtModify`, `iModifyBy`) VALUES
(2, 'IF001', 'Ramadhan Wijaya', '67bc53927165bc7f259fbbf38e402dcb48ee81f7ab9d2725ac01d62dabd26b050a33f7bd6c75136391e4aabc253da074048ef8dc8756390e5166427507fdcf509vw+EvXPv74mvl7+3YS6Zo8tIWY73n92bmgemeFe8uA=', 'ADMIN', '2024-05-04 21:35:44', 0, '2024-05-14 23:19:23', 2),
(9, '12345', 'Anggi Prasetyo', '2350af78fbe92dfc14b1c00f8e2297c34acf595c7cf805b1f1fac2371e3ae4326449a497472aa89278561582bed2f1e4d27bf8bc22ac48356f49a0fb80706b444hhTZesA26nMQTgXJO03FsaDfHrXP/sbyJ6hcRjbzR8=', 'USER', '2024-05-11 15:21:29', 1, NULL, NULL),
(10, 'IF001', 'Devano Danendra', 'b30364acd77216fae996259fef517be63c37361f13c80e201c4619a2635d79ec7d3ff5dbdc2ddcffbe6f9f51948fb8d3e6e20bd2d24e4c4ac93b06d1d62c5edbF8vJSZDrX+JLqDDH8lnb1mzyxPzC262HFFGcp7oh3uA=', 'USER', '2024-05-14 19:21:04', 2, NULL, NULL);

-- --------------------------------------------------------

--
-- Stand-in structure for view `vrequest`
-- (See below for the actual view)
--
CREATE TABLE `vrequest` (
`idReq` int(11)
,`sReqNum` varchar(50)
,`sEmpID` varchar(50)
,`sFullname` varchar(150)
,`sKdBrg` varchar(50)
,`sName` varchar(60)
,`decReqQty` float
,`dtReqStart` datetime
,`dtReqEnd` datetime
,`sEmpApp` varchar(50)
,`sNameApp` varchar(150)
,`iStatus` int(11)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `vstock`
-- (See below for the actual view)
--
CREATE TABLE `vstock` (
`sKode` varchar(30)
,`sName` varchar(60)
,`decQty` double
);

-- --------------------------------------------------------

--
-- Structure for view `vrequest`
--
DROP TABLE IF EXISTS `vrequest`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vrequest`  AS SELECT `r`.`idReq` AS `idReq`, `r`.`sReqNum` AS `sReqNum`, `r`.`sEmpID` AS `sEmpID`, `u`.`sFullname` AS `sFullname`, `r`.`sKdBrg` AS `sKdBrg`, `b`.`sName` AS `sName`, `r`.`decReqQty` AS `decReqQty`, `r`.`dtReqStart` AS `dtReqStart`, `r`.`dtReqEnd` AS `dtReqEnd`, `r`.`sEmpApp` AS `sEmpApp`, `u2`.`sFullname` AS `sNameApp`, `r`.`iStatus` AS `iStatus` FROM (((`tb_request` `r` left join `tb_user` `u` on(`u`.`sEmpID` = `r`.`sEmpID`)) left join `tb_user` `u2` on(`u2`.`sEmpID` = `r`.`sEmpApp`)) left join `tb_brg` `b` on(`b`.`sKode` = `r`.`sKdBrg`)) GROUP BY `r`.`sReqNum`, `r`.`sEmpID`, `r`.`sKdBrg`, `r`.`decReqQty`, `r`.`dtReqStart`, `r`.`dtReqEnd`, `r`.`sEmpApp` ORDER BY `r`.`sReqNum` ASC ;

-- --------------------------------------------------------

--
-- Structure for view `vstock`
--
DROP TABLE IF EXISTS `vstock`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vstock`  AS SELECT `tb_brg`.`sKode` AS `sKode`, `tb_brg`.`sName` AS `sName`, sum(`tb_brg`.`decQty`) AS `decQty` FROM `tb_brg` GROUP BY `tb_brg`.`sKode`, `tb_brg`.`sName` ORDER BY `tb_brg`.`sKode` ASC ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_brg`
--
ALTER TABLE `tb_brg`
  ADD PRIMARY KEY (`idBrg`);

--
-- Indexes for table `tb_request`
--
ALTER TABLE `tb_request`
  ADD PRIMARY KEY (`idReq`),
  ADD UNIQUE KEY `sReqNum` (`sReqNum`);

--
-- Indexes for table `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`idUser`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_brg`
--
ALTER TABLE `tb_brg`
  MODIFY `idBrg` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `tb_request`
--
ALTER TABLE `tb_request`
  MODIFY `idReq` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `idUser` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
