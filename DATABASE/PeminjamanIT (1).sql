-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Waktu pembuatan: 11 Bulan Mei 2024 pada 19.50
-- Versi server: 10.4.28-MariaDB
-- Versi PHP: 8.1.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `PeminjamanIT`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_brg`
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
-- Dumping data untuk tabel `tb_brg`
--

INSERT INTO `tb_brg` (`idBrg`, `sKode`, `sName`, `decQty`, `sType`, `iCreateBy`, `dtCreate`, `iModifyBy`, `dtModify`) VALUES
(7, 'M0001', 'Mouse Fantech', 200, 2, 1, '2024-05-11 18:51:14', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_request`
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

--
-- Dumping data untuk tabel `tb_request`
--

INSERT INTO `tb_request` (`idReq`, `sReqNum`, `sEmpID`, `sKdBrg`, `decReqQty`, `dtReqStart`, `dtReqEnd`, `sEmpApp`, `iStatus`, `iCreateBy`, `dtCreate`, `iModifyBy`, `dtModify`) VALUES
(0, 'JM3BRJ6I', '752846', 'M0001', 2, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', 1, 1, '2024-05-11 22:57:32', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_user`
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
-- Dumping data untuk tabel `tb_user`
--

INSERT INTO `tb_user` (`idUser`, `sEmpID`, `sFullname`, `sPassword`, `sRole`, `dtCreate`, `iCreateBy`, `dtModify`, `iModifyBy`) VALUES
(1, '752846', 'Arif Febriana', 'fa9b0a0ddf4adb0072c73d4faacc7e303a9795cd0801965dba5a6a329e17c2ead27f6abaaf2c1bd26c421fefa0da1a125d4a0218f8a1dde54268220cf419053cSYeP9WyXsBFijxw1kMZ5we0owBHHtORYVEHX6Tsp7Mk=', 'ADMIN', '2024-05-04 01:04:47', 0, '2024-05-11 02:58:22', 1),
(2, '123987', 'Rama Wijaya', '6a9d383e1e2a64942429e2af2ce5330a082138603e6e1a12e922fc6db157886cc3ce83724ecf2cb97fb57b32c181dc3a1f50136760630618dee8553cb9337e18Fy0WL9+esD6+ROyrg7JrlHxMKtHkAUYvoKQ1zGpHQEU=', 'admin', '2024-05-04 21:35:44', 0, NULL, NULL),
(3, '112233', 'Doni KurniawanD', 'aa0469b3c3b1b299b56e6199fca99f90c9aa1dbfbd344a79848807e18727cf6205e8ee1da32d6600735c02fa844119bdcf621db0bd24d2bb5c0087d148debfb51Qc4jY+4pq4yLiU/zws6xDDQvmoGclBw3zTQjfoyz1U=', 'USER', '2024-05-11 03:06:20', 1, '2024-05-11 03:08:40', 1),
(9, '12345', 'Anggi Prasetyo', '2350af78fbe92dfc14b1c00f8e2297c34acf595c7cf805b1f1fac2371e3ae4326449a497472aa89278561582bed2f1e4d27bf8bc22ac48356f49a0fb80706b444hhTZesA26nMQTgXJO03FsaDfHrXP/sbyJ6hcRjbzR8=', 'USER', '2024-05-11 15:21:29', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Stand-in struktur untuk tampilan `vrequest`
-- (Lihat di bawah untuk tampilan aktual)
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
-- Struktur untuk view `vrequest`
--
DROP TABLE IF EXISTS `vrequest`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `peminjamanit`.`vrequest`  AS SELECT `R`.`idReq` AS `idReq`, `R`.`sReqNum` AS `sReqNum`, `R`.`sEmpID` AS `sEmpID`, `U`.`sFullname` AS `sFullname`, `R`.`sKdBrg` AS `sKdBrg`, `B`.`sName` AS `sName`, `R`.`decReqQty` AS `decReqQty`, `R`.`dtReqStart` AS `dtReqStart`, `R`.`dtReqEnd` AS `dtReqEnd`, `R`.`sEmpApp` AS `sEmpApp`, `U2`.`sFullname` AS `sNameApp`, `R`.`iStatus` AS `iStatus` FROM (((`peminjamanit`.`tb_request` `R` left join `peminjamanit`.`tb_user` `U` on(`U`.`sEmpID` = `R`.`sEmpID`)) left join `peminjamanit`.`tb_user` `U2` on(`U2`.`sEmpID` = `R`.`sEmpApp`)) left join `peminjamanit`.`tb_brg` `B` on(`B`.`sKode` = `R`.`sKdBrg`)) ORDER BY `R`.`sReqNum` ASC ;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tb_brg`
--
ALTER TABLE `tb_brg`
  ADD PRIMARY KEY (`idBrg`);

--
-- Indeks untuk tabel `tb_request`
--
ALTER TABLE `tb_request`
  ADD PRIMARY KEY (`idReq`),
  ADD UNIQUE KEY `sReqNum` (`sReqNum`);

--
-- Indeks untuk tabel `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`idUser`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tb_brg`
--
ALTER TABLE `tb_brg`
  MODIFY `idBrg` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `idUser` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
