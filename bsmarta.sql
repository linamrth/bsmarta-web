-- phpMyAdmin SQL Dump
-- version 4.8.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 24, 2018 at 01:51 PM
-- Server version: 10.1.31-MariaDB
-- PHP Version: 7.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bsmarta`
--

-- --------------------------------------------------------

--
-- Table structure for table `cabang`
--

CREATE TABLE `cabang` (
  `idcabang` int(11) NOT NULL,
  `namacabang` varchar(50) DEFAULT NULL,
  `jenis` varchar(10) DEFAULT NULL,
  `alamat` varchar(200) NOT NULL,
  `telepon` varchar(50) NOT NULL,
  `fax` varchar(50) NOT NULL,
  `kabupaten` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cabang`
--

INSERT INTO `cabang` (`idcabang`, `namacabang`, `jenis`, `alamat`, `telepon`, `fax`, `kabupaten`) VALUES
(1, 'Bsmart Pusat', 'Kursus', 'Jl. Gayungkebonsari Timur no.47 B, Surabaya', '031 - 829 0800', '031 – 829 8078', 'Surabaya'),
(2, 'TK Buah Hati', 'Sekolah', 'TK Buah Hati BundaJl. Klampis Ngasem 3 / 31Klampis Ngasem, Sukolilo, Surabaya', '081 2327 4436', '081 2327 4436', 'Surabaya'),
(3, 'TK Cendekia', 'Sekolah', 'Jl. Samanhudi no. 68\nGedung TK Cendekia 2 lt 2 Jasem\nSidoarjo', '0851 0370 6066', '-', 'Sidoarjo'),
(4, 'TK Bebekan', 'Sekolah', 'TK ABA Bebekan SepanjangJl. Ketegan Bar., RT.15/RW.4, Sepanjang, Taman, Kabupaten Sidoarjo, Jawa T', '0851 0506 3666', '0851 0506 3666', 'Sidoarjo'),
(5, 'PAUD Al Hikmah', 'Sekolah', 'PAUD Al Hikmah, Ngetal, Pogalan, Trenggalek', '085 3202 2725', '-', 'Trenggalek'),
(6, 'TK Blitar', 'Sekolah', 'TK ABA 4 Blitar\nJl. Dr. Sutomo 34, Sananwetan, Blitar', '0815 5591 6262', '-', 'Blitar'),
(7, 'Bsmart Blitar', 'Kursus', 'Jl. Suren no 57\r\nBlitar', '0856 0425 5740', '-', 'Blitar'),
(8, 'RA As-syifa', 'Sekolah', 'RA As-Syifa Jl. Ampera no 1 Supiturang Pronojiwo, Lumajang', '081 2327 4436', '081 2327 4436', 'Lumajang'),
(9, 'TK Boyolangu', 'Sekolah', 'TK ABA Boyolangu Tulungagung\nDusun Boyolangu RT 008 RW 001 Boyolangu\nTulungagung', '0811 330 2277', '-', 'Tulungagung'),
(10, 'SD Muhammadiyah', 'Sekolah', 'SD Muhammadiyah 1 TulungagungJl. RA. Kartini no. 35 Tulungagung', '08113302277', '08113302277', 'Tulungagung');

-- --------------------------------------------------------

--
-- Table structure for table `guru`
--

CREATE TABLE `guru` (
  `idguru` int(11) NOT NULL,
  `idcabang` int(11) NOT NULL,
  `namaguru` varchar(30) NOT NULL,
  `telepon` varchar(15) NOT NULL,
  `alamat` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `guru`
--

INSERT INTO `guru` (`idguru`, `idcabang`, `namaguru`, `telepon`, `alamat`) VALUES
(1, 1, 'Shifwatin', '+6282131438735', 'Sedayulawas RT 002 RW 004 Ds Sedayulawas Kec Brondong Kab Lamongan'),
(2, 1, 'Rosmelia Capriana', '+6285233058746', 'Jl Ahmad Yani Dusun Krajan Kidul RT 003 RW 017 Ds Balung Kulon Kec Balung Kota Jakarta'),
(3, 1, 'Dwi Aminawati', '+6285655505341', 'Jl Banda Gg Dahlia No 60 Gadingrejo RT 03 RW 02 Kota Pasuruan'),
(4, 1, 'Umul Aima', '+6285749019646', 'Jl. Dr. Cipto Mangunkusumo 42 RT 001 RW 001 Ds Keniten Kec Ponorogo Kab Ponorogo'),
(5, 1, 'Zunita Efi Ratnasari', '+6285735925943', 'Jl Seketi Dsn Semanding RT 002 RW 004 Ds Gondang Kec Plosoklaten Kab Kediri'),
(6, 1, 'Chuzaumatul Fitria', '+6282334093822', 'Jl Sememu Ketewel RT07 RW06 Pasirian Lumajang'),
(7, 1, 'Ghassani Anggiah', '+6283849317760', 'Jl Kutisari Selatan Gg IVa no.25 Surabaya');

-- --------------------------------------------------------

--
-- Table structure for table `guruskill`
--

CREATE TABLE `guruskill` (
  `idguruskill` int(11) NOT NULL,
  `idguru` int(11) NOT NULL,
  `idprogramlevel` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `guruskill`
--

INSERT INTO `guruskill` (`idguruskill`, `idguru`, `idprogramlevel`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 1, 3),
(4, 1, 4),
(5, 1, 5),
(6, 2, 1),
(7, 2, 2),
(8, 2, 3),
(9, 2, 4),
(10, 2, 5),
(11, 2, 5),
(12, 3, 1),
(13, 3, 2),
(14, 3, 3),
(15, 3, 4),
(16, 3, 5),
(17, 4, 1),
(18, 4, 2),
(19, 4, 3),
(20, 4, 4),
(21, 4, 5),
(22, 5, 1),
(23, 5, 2),
(24, 5, 3),
(25, 5, 4),
(26, 6, 1),
(28, 6, 2),
(30, 6, 3),
(31, 6, 4),
(32, 7, 1),
(33, 7, 2),
(34, 7, 3),
(35, 7, 4);

-- --------------------------------------------------------

--
-- Table structure for table `jadwal`
--

CREATE TABLE `jadwal` (
  `idjadwal` int(11) NOT NULL,
  `idsiswabelajar` int(11) NOT NULL DEFAULT '0',
  `idtrial` int(11) NOT NULL,
  `idguru` int(11) NOT NULL,
  `hari` varchar(20) NOT NULL,
  `jam` varchar(20) NOT NULL,
  `tanggal` date DEFAULT NULL,
  `statusjadwal` char(1) NOT NULL COMMENT 'T=Trial, U=Sudah Trial, K=Kursus'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jadwal`
--

INSERT INTO `jadwal` (`idjadwal`, `idsiswabelajar`, `idtrial`, `idguru`, `hari`, `jam`, `tanggal`, `statusjadwal`) VALUES
(176, 0, 79, 1, 'Selasa', '3', '2018-05-22', 'T'),
(175, 89, 0, 3, 'Jumat', '4', '2018-05-18', 'K'),
(174, 89, 0, 3, 'Rabu', '3', '2018-05-16', 'K'),
(173, 88, 0, 5, 'Rabu', '3', '2018-05-23', 'K'),
(172, 88, 0, 5, 'Senin', '1', '2018-05-21', 'K'),
(171, 87, 0, 4, 'Sabtu', '6', '2018-05-19', 'K'),
(170, 87, 0, 4, 'Kamis', '5', '2018-05-17', 'K'),
(169, 0, 78, 5, 'Jumat', '5', '2018-05-11', 'U'),
(168, 0, 77, 4, 'Kamis', '4', '2018-05-10', 'U'),
(167, 86, 0, 2, 'Kamis', '4', '2018-05-10', 'K'),
(166, 86, 0, 2, 'Selasa', '2', '2018-05-15', 'K'),
(165, 85, 0, 1, 'Rabu', '3', '2018-05-09', 'K'),
(164, 85, 0, 1, 'Senin', '1', '2018-05-14', 'K'),
(163, 0, 76, 3, 'Rabu', '3', '2018-05-09', 'U'),
(162, 0, 75, 2, 'Selasa', '2', '2018-05-08', 'U'),
(161, 0, 74, 1, 'Senin', '1', '2018-05-07', 'U');

-- --------------------------------------------------------

--
-- Table structure for table `jadwalgenerate`
--

CREATE TABLE `jadwalgenerate` (
  `idgenerate` int(11) NOT NULL,
  `idsiswabelajar` int(11) DEFAULT NULL,
  `idguru` int(11) DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `hari` varchar(15) DEFAULT NULL,
  `jam` varchar(15) DEFAULT NULL,
  `statusrapotkursus` varchar(1) NOT NULL DEFAULT 'B' COMMENT 'S=Sudah Terisi, B=Belum Terisi'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jadwalgenerate`
--

INSERT INTO `jadwalgenerate` (`idgenerate`, `idsiswabelajar`, `idguru`, `tanggal`, `hari`, `jam`, `statusrapotkursus`) VALUES
(2315, 85, 1, '2018-05-09', 'Rabu', '3', 'S'),
(2316, 85, 1, '2018-05-16', 'Rabu', '3', 'S'),
(2317, 85, 1, '2018-05-23', 'Rabu', '3', 'S'),
(2318, 85, 1, '2018-05-30', 'Rabu', '3', 'S'),
(2319, 85, 1, '2018-06-06', 'Rabu', '3', 'B'),
(2320, 85, 1, '2018-06-13', 'Rabu', '3', 'B'),
(2321, 85, 1, '2018-06-20', 'Rabu', '3', 'B'),
(2322, 85, 1, '2018-06-27', 'Rabu', '3', 'B'),
(2323, 85, 1, '2018-07-04', 'Rabu', '3', 'B'),
(2324, 85, 1, '2018-07-11', 'Rabu', '3', 'B'),
(2325, 85, 1, '2018-07-18', 'Rabu', '3', 'B'),
(2326, 85, 1, '2018-07-25', 'Rabu', '3', 'B'),
(2327, 85, 1, '2018-08-01', 'Rabu', '3', 'B'),
(2328, 85, 1, '2018-08-08', 'Rabu', '3', 'B'),
(2329, 85, 1, '2018-08-15', 'Rabu', '3', 'B'),
(2330, 85, 1, '2018-08-22', 'Rabu', '3', 'B'),
(2331, 85, 1, '2018-08-29', 'Rabu', '3', 'B'),
(2332, 85, 1, '2018-09-05', 'Rabu', '3', 'B'),
(2333, 85, 1, '2018-09-12', 'Rabu', '3', 'B'),
(2334, 85, 1, '2018-09-19', 'Rabu', '3', 'B'),
(2335, 85, 1, '2018-09-26', 'Rabu', '3', 'B'),
(2336, 85, 1, '2018-10-03', 'Rabu', '3', 'B'),
(2337, 85, 1, '2018-10-10', 'Rabu', '3', 'B'),
(2338, 85, 1, '2018-10-17', 'Rabu', '3', 'B'),
(2339, 85, 1, '2018-10-24', 'Rabu', '3', 'B'),
(2340, 85, 1, '2018-10-31', 'Rabu', '3', 'B'),
(2341, 85, 1, '2018-11-07', 'Rabu', '3', 'B'),
(2342, 85, 1, '2018-11-14', 'Rabu', '3', 'B'),
(2343, 85, 1, '2018-05-14', 'Senin', '1', 'S'),
(2344, 85, 1, '2018-05-21', 'Senin', '1', 'S'),
(2345, 85, 1, '2018-05-28', 'Senin', '1', 'S'),
(2346, 85, 1, '2018-06-04', 'Senin', '1', 'S'),
(2347, 85, 1, '2018-06-11', 'Senin', '1', 'B'),
(2348, 85, 1, '2018-06-18', 'Senin', '1', 'B'),
(2349, 85, 1, '2018-06-25', 'Senin', '1', 'B'),
(2350, 85, 1, '2018-07-02', 'Senin', '1', 'B'),
(2351, 85, 1, '2018-07-09', 'Senin', '1', 'B'),
(2352, 85, 1, '2018-07-16', 'Senin', '1', 'B'),
(2353, 85, 1, '2018-07-23', 'Senin', '1', 'B'),
(2354, 85, 1, '2018-07-30', 'Senin', '1', 'B'),
(2355, 85, 1, '2018-08-06', 'Senin', '1', 'B'),
(2356, 85, 1, '2018-08-13', 'Senin', '1', 'B'),
(2357, 85, 1, '2018-08-20', 'Senin', '1', 'B'),
(2358, 85, 1, '2018-08-27', 'Senin', '1', 'B'),
(2359, 85, 1, '2018-09-03', 'Senin', '1', 'B'),
(2360, 85, 1, '2018-09-10', 'Senin', '1', 'B'),
(2361, 85, 1, '2018-09-17', 'Senin', '1', 'B'),
(2362, 85, 1, '2018-09-24', 'Senin', '1', 'B'),
(2363, 85, 1, '2018-10-01', 'Senin', '1', 'B'),
(2364, 85, 1, '2018-10-08', 'Senin', '1', 'B'),
(2365, 85, 1, '2018-10-15', 'Senin', '1', 'B'),
(2366, 85, 1, '2018-10-22', 'Senin', '1', 'B'),
(2367, 85, 1, '2018-10-29', 'Senin', '1', 'B'),
(2368, 85, 1, '2018-11-05', 'Senin', '1', 'B'),
(2369, 85, 1, '2018-11-12', 'Senin', '1', 'B'),
(2370, 85, 1, '2018-11-19', 'Senin', '1', 'B'),
(2371, 87, 4, '2018-05-19', 'Sabtu', '6', 'S'),
(2372, 87, 4, '2018-05-26', 'Sabtu', '6', 'B'),
(2373, 87, 4, '2018-06-02', 'Sabtu', '6', 'B'),
(2374, 87, 4, '2018-06-09', 'Sabtu', '6', 'B'),
(2375, 87, 4, '2018-06-16', 'Sabtu', '6', 'B'),
(2376, 87, 4, '2018-06-23', 'Sabtu', '6', 'B'),
(2377, 87, 4, '2018-06-30', 'Sabtu', '6', 'B'),
(2378, 87, 4, '2018-07-07', 'Sabtu', '6', 'B'),
(2379, 87, 4, '2018-07-14', 'Sabtu', '6', 'B'),
(2380, 87, 4, '2018-07-21', 'Sabtu', '6', 'B'),
(2381, 87, 4, '2018-07-28', 'Sabtu', '6', 'B'),
(2382, 87, 4, '2018-08-04', 'Sabtu', '6', 'B'),
(2383, 87, 4, '2018-08-11', 'Sabtu', '6', 'B'),
(2384, 87, 4, '2018-08-18', 'Sabtu', '6', 'B'),
(2385, 87, 4, '2018-08-25', 'Sabtu', '6', 'B'),
(2386, 87, 4, '2018-09-01', 'Sabtu', '6', 'B'),
(2387, 87, 4, '2018-09-08', 'Sabtu', '6', 'B'),
(2388, 87, 4, '2018-09-15', 'Sabtu', '6', 'B'),
(2389, 87, 4, '2018-09-22', 'Sabtu', '6', 'B'),
(2390, 87, 4, '2018-09-29', 'Sabtu', '6', 'B'),
(2391, 87, 4, '2018-10-06', 'Sabtu', '6', 'B'),
(2392, 87, 4, '2018-10-13', 'Sabtu', '6', 'B'),
(2393, 87, 4, '2018-10-20', 'Sabtu', '6', 'B'),
(2394, 87, 4, '2018-10-27', 'Sabtu', '6', 'B'),
(2395, 87, 4, '2018-11-03', 'Sabtu', '6', 'B'),
(2396, 87, 4, '2018-11-10', 'Sabtu', '6', 'B'),
(2397, 87, 4, '2018-11-17', 'Sabtu', '6', 'B'),
(2398, 87, 4, '2018-11-24', 'Sabtu', '6', 'B'),
(2399, 87, 4, '2018-05-17', 'Kamis', '5', 'S'),
(2400, 87, 4, '2018-05-24', 'Kamis', '5', 'S'),
(2401, 87, 4, '2018-05-31', 'Kamis', '5', 'B'),
(2402, 87, 4, '2018-06-07', 'Kamis', '5', 'B'),
(2403, 87, 4, '2018-06-14', 'Kamis', '5', 'B'),
(2404, 87, 4, '2018-06-21', 'Kamis', '5', 'B'),
(2405, 87, 4, '2018-06-28', 'Kamis', '5', 'B'),
(2406, 87, 4, '2018-07-05', 'Kamis', '5', 'B'),
(2407, 87, 4, '2018-07-12', 'Kamis', '5', 'B'),
(2408, 87, 4, '2018-07-19', 'Kamis', '5', 'B'),
(2409, 87, 4, '2018-07-26', 'Kamis', '5', 'B'),
(2410, 87, 4, '2018-08-02', 'Kamis', '5', 'B'),
(2411, 87, 4, '2018-08-09', 'Kamis', '5', 'B'),
(2412, 87, 4, '2018-08-16', 'Kamis', '5', 'B'),
(2413, 87, 4, '2018-08-23', 'Kamis', '5', 'B'),
(2414, 87, 4, '2018-08-30', 'Kamis', '5', 'B'),
(2415, 87, 4, '2018-09-06', 'Kamis', '5', 'B'),
(2416, 87, 4, '2018-09-13', 'Kamis', '5', 'B'),
(2417, 87, 4, '2018-09-20', 'Kamis', '5', 'B'),
(2418, 87, 4, '2018-09-27', 'Kamis', '5', 'B'),
(2419, 87, 4, '2018-10-04', 'Kamis', '5', 'B'),
(2420, 87, 4, '2018-10-11', 'Kamis', '5', 'B'),
(2421, 87, 4, '2018-10-18', 'Kamis', '5', 'B'),
(2422, 87, 4, '2018-10-25', 'Kamis', '5', 'B'),
(2423, 87, 4, '2018-11-01', 'Kamis', '5', 'B'),
(2424, 87, 4, '2018-11-08', 'Kamis', '5', 'B'),
(2425, 87, 4, '2018-11-15', 'Kamis', '5', 'B'),
(2426, 87, 4, '2018-11-22', 'Kamis', '5', 'B'),
(2427, 86, 2, '2018-05-10', 'Kamis', '4', 'B'),
(2428, 86, 2, '2018-05-17', 'Kamis', '4', 'B'),
(2429, 86, 2, '2018-05-24', 'Kamis', '4', 'B'),
(2430, 86, 2, '2018-05-31', 'Kamis', '4', 'B'),
(2431, 86, 2, '2018-06-07', 'Kamis', '4', 'B'),
(2432, 86, 2, '2018-06-14', 'Kamis', '4', 'B'),
(2433, 86, 2, '2018-06-21', 'Kamis', '4', 'B'),
(2434, 86, 2, '2018-06-28', 'Kamis', '4', 'B'),
(2435, 86, 2, '2018-07-05', 'Kamis', '4', 'B'),
(2436, 86, 2, '2018-07-12', 'Kamis', '4', 'B'),
(2437, 86, 2, '2018-07-19', 'Kamis', '4', 'B'),
(2438, 86, 2, '2018-07-26', 'Kamis', '4', 'B'),
(2439, 86, 2, '2018-08-02', 'Kamis', '4', 'B'),
(2440, 86, 2, '2018-08-09', 'Kamis', '4', 'B'),
(2441, 86, 2, '2018-08-16', 'Kamis', '4', 'B'),
(2442, 86, 2, '2018-08-23', 'Kamis', '4', 'B'),
(2443, 86, 2, '2018-08-30', 'Kamis', '4', 'B'),
(2444, 86, 2, '2018-09-06', 'Kamis', '4', 'B'),
(2445, 86, 2, '2018-09-13', 'Kamis', '4', 'B'),
(2446, 86, 2, '2018-09-20', 'Kamis', '4', 'B'),
(2447, 86, 2, '2018-09-27', 'Kamis', '4', 'B'),
(2448, 86, 2, '2018-10-04', 'Kamis', '4', 'B'),
(2449, 86, 2, '2018-10-11', 'Kamis', '4', 'B'),
(2450, 86, 2, '2018-10-18', 'Kamis', '4', 'B'),
(2451, 86, 2, '2018-10-25', 'Kamis', '4', 'B'),
(2452, 86, 2, '2018-11-01', 'Kamis', '4', 'B'),
(2453, 86, 2, '2018-11-08', 'Kamis', '4', 'B'),
(2454, 86, 2, '2018-11-15', 'Kamis', '4', 'B'),
(2455, 86, 2, '2018-11-22', 'Kamis', '4', 'B'),
(2456, 86, 2, '2018-11-29', 'Kamis', '4', 'B'),
(2457, 86, 2, '2018-12-06', 'Kamis', '4', 'B'),
(2458, 86, 2, '2018-12-13', 'Kamis', '4', 'B'),
(2459, 86, 2, '2018-05-15', 'Selasa', '2', 'B'),
(2460, 86, 2, '2018-05-22', 'Selasa', '2', 'B'),
(2461, 86, 2, '2018-05-29', 'Selasa', '2', 'B'),
(2462, 86, 2, '2018-06-05', 'Selasa', '2', 'B'),
(2463, 86, 2, '2018-06-12', 'Selasa', '2', 'B'),
(2464, 86, 2, '2018-06-19', 'Selasa', '2', 'B'),
(2465, 86, 2, '2018-06-26', 'Selasa', '2', 'B'),
(2466, 86, 2, '2018-07-03', 'Selasa', '2', 'B'),
(2467, 86, 2, '2018-07-10', 'Selasa', '2', 'B'),
(2468, 86, 2, '2018-07-17', 'Selasa', '2', 'B'),
(2469, 86, 2, '2018-07-24', 'Selasa', '2', 'B'),
(2470, 86, 2, '2018-07-31', 'Selasa', '2', 'B'),
(2471, 86, 2, '2018-08-07', 'Selasa', '2', 'B'),
(2472, 86, 2, '2018-08-14', 'Selasa', '2', 'B'),
(2473, 86, 2, '2018-08-21', 'Selasa', '2', 'B'),
(2474, 86, 2, '2018-08-28', 'Selasa', '2', 'B'),
(2475, 86, 2, '2018-09-04', 'Selasa', '2', 'B'),
(2476, 86, 2, '2018-09-11', 'Selasa', '2', 'B'),
(2477, 86, 2, '2018-09-18', 'Selasa', '2', 'B'),
(2478, 86, 2, '2018-09-25', 'Selasa', '2', 'B'),
(2479, 86, 2, '2018-10-02', 'Selasa', '2', 'B'),
(2480, 86, 2, '2018-10-09', 'Selasa', '2', 'B'),
(2481, 86, 2, '2018-10-16', 'Selasa', '2', 'B'),
(2482, 86, 2, '2018-10-23', 'Selasa', '2', 'B'),
(2483, 86, 2, '2018-10-30', 'Selasa', '2', 'B'),
(2484, 86, 2, '2018-11-06', 'Selasa', '2', 'B'),
(2485, 86, 2, '2018-11-13', 'Selasa', '2', 'B'),
(2486, 86, 2, '2018-11-20', 'Selasa', '2', 'B'),
(2487, 86, 2, '2018-11-27', 'Selasa', '2', 'B'),
(2488, 86, 2, '2018-12-04', 'Selasa', '2', 'B'),
(2489, 86, 2, '2018-12-11', 'Selasa', '2', 'B'),
(2490, 86, 2, '2018-12-18', 'Selasa', '2', 'B'),
(2491, 88, 5, '2018-05-23', 'Rabu', '3', 'B'),
(2492, 88, 5, '2018-05-30', 'Rabu', '3', 'B'),
(2493, 88, 5, '2018-06-06', 'Rabu', '3', 'B'),
(2494, 88, 5, '2018-06-13', 'Rabu', '3', 'B'),
(2495, 88, 5, '2018-06-20', 'Rabu', '3', 'B'),
(2496, 88, 5, '2018-06-27', 'Rabu', '3', 'B'),
(2497, 88, 5, '2018-07-04', 'Rabu', '3', 'B'),
(2498, 88, 5, '2018-07-11', 'Rabu', '3', 'B'),
(2499, 88, 5, '2018-07-18', 'Rabu', '3', 'B'),
(2500, 88, 5, '2018-07-25', 'Rabu', '3', 'B'),
(2501, 88, 5, '2018-08-01', 'Rabu', '3', 'B'),
(2502, 88, 5, '2018-08-08', 'Rabu', '3', 'B'),
(2503, 88, 5, '2018-08-15', 'Rabu', '3', 'B'),
(2504, 88, 5, '2018-08-22', 'Rabu', '3', 'B'),
(2505, 88, 5, '2018-08-29', 'Rabu', '3', 'B'),
(2506, 88, 5, '2018-09-05', 'Rabu', '3', 'B'),
(2507, 88, 5, '2018-09-12', 'Rabu', '3', 'B'),
(2508, 88, 5, '2018-09-19', 'Rabu', '3', 'B'),
(2509, 88, 5, '2018-09-26', 'Rabu', '3', 'B'),
(2510, 88, 5, '2018-10-03', 'Rabu', '3', 'B'),
(2511, 88, 5, '2018-10-10', 'Rabu', '3', 'B'),
(2512, 88, 5, '2018-10-17', 'Rabu', '3', 'B'),
(2513, 88, 5, '2018-10-24', 'Rabu', '3', 'B'),
(2514, 88, 5, '2018-10-31', 'Rabu', '3', 'B'),
(2515, 88, 5, '2018-11-07', 'Rabu', '3', 'B'),
(2516, 88, 5, '2018-11-14', 'Rabu', '3', 'B'),
(2517, 88, 5, '2018-11-21', 'Rabu', '3', 'B'),
(2518, 88, 5, '2018-11-28', 'Rabu', '3', 'B'),
(2519, 88, 5, '2018-12-05', 'Rabu', '3', 'B'),
(2520, 88, 5, '2018-12-12', 'Rabu', '3', 'B'),
(2521, 88, 5, '2018-12-19', 'Rabu', '3', 'B'),
(2522, 88, 5, '2018-12-26', 'Rabu', '3', 'B'),
(2523, 88, 5, '2018-05-21', 'Senin', '1', 'B'),
(2524, 88, 5, '2018-05-28', 'Senin', '1', 'B'),
(2525, 88, 5, '2018-06-04', 'Senin', '1', 'B'),
(2526, 88, 5, '2018-06-11', 'Senin', '1', 'B'),
(2527, 88, 5, '2018-06-18', 'Senin', '1', 'B'),
(2528, 88, 5, '2018-06-25', 'Senin', '1', 'B'),
(2529, 88, 5, '2018-07-02', 'Senin', '1', 'B'),
(2530, 88, 5, '2018-07-09', 'Senin', '1', 'B'),
(2531, 88, 5, '2018-07-16', 'Senin', '1', 'B'),
(2532, 88, 5, '2018-07-23', 'Senin', '1', 'B'),
(2533, 88, 5, '2018-07-30', 'Senin', '1', 'B'),
(2534, 88, 5, '2018-08-06', 'Senin', '1', 'B'),
(2535, 88, 5, '2018-08-13', 'Senin', '1', 'B'),
(2536, 88, 5, '2018-08-20', 'Senin', '1', 'B'),
(2537, 88, 5, '2018-08-27', 'Senin', '1', 'B'),
(2538, 88, 5, '2018-09-03', 'Senin', '1', 'B'),
(2539, 88, 5, '2018-09-10', 'Senin', '1', 'B'),
(2540, 88, 5, '2018-09-17', 'Senin', '1', 'B'),
(2541, 88, 5, '2018-09-24', 'Senin', '1', 'B'),
(2542, 88, 5, '2018-10-01', 'Senin', '1', 'B'),
(2543, 88, 5, '2018-10-08', 'Senin', '1', 'B'),
(2544, 88, 5, '2018-10-15', 'Senin', '1', 'B'),
(2545, 88, 5, '2018-10-22', 'Senin', '1', 'B'),
(2546, 88, 5, '2018-10-29', 'Senin', '1', 'B'),
(2547, 88, 5, '2018-11-05', 'Senin', '1', 'B'),
(2548, 88, 5, '2018-11-12', 'Senin', '1', 'B'),
(2549, 88, 5, '2018-11-19', 'Senin', '1', 'B'),
(2550, 88, 5, '2018-11-26', 'Senin', '1', 'B'),
(2551, 88, 5, '2018-12-03', 'Senin', '1', 'B'),
(2552, 88, 5, '2018-12-10', 'Senin', '1', 'B'),
(2553, 88, 5, '2018-12-17', 'Senin', '1', 'B'),
(2554, 88, 5, '2018-12-24', 'Senin', '1', 'B'),
(2555, 89, 3, '2018-05-18', 'Jumat', '4', 'B'),
(2556, 89, 3, '2018-05-25', 'Jumat', '4', 'B'),
(2557, 89, 3, '2018-06-01', 'Jumat', '4', 'B'),
(2558, 89, 3, '2018-06-08', 'Jumat', '4', 'B'),
(2559, 89, 3, '2018-06-15', 'Jumat', '4', 'B'),
(2560, 89, 3, '2018-06-22', 'Jumat', '4', 'B'),
(2561, 89, 3, '2018-06-29', 'Jumat', '4', 'B'),
(2562, 89, 3, '2018-07-06', 'Jumat', '4', 'B'),
(2563, 89, 3, '2018-07-13', 'Jumat', '4', 'B'),
(2564, 89, 3, '2018-07-20', 'Jumat', '4', 'B'),
(2565, 89, 3, '2018-07-27', 'Jumat', '4', 'B'),
(2566, 89, 3, '2018-08-03', 'Jumat', '4', 'B'),
(2567, 89, 3, '2018-08-10', 'Jumat', '4', 'B'),
(2568, 89, 3, '2018-08-17', 'Jumat', '4', 'B'),
(2569, 89, 3, '2018-08-24', 'Jumat', '4', 'B'),
(2570, 89, 3, '2018-08-31', 'Jumat', '4', 'B'),
(2571, 89, 3, '2018-09-07', 'Jumat', '4', 'B'),
(2572, 89, 3, '2018-09-14', 'Jumat', '4', 'B'),
(2573, 89, 3, '2018-09-21', 'Jumat', '4', 'B'),
(2574, 89, 3, '2018-09-28', 'Jumat', '4', 'B'),
(2575, 89, 3, '2018-10-05', 'Jumat', '4', 'B'),
(2576, 89, 3, '2018-10-12', 'Jumat', '4', 'B'),
(2577, 89, 3, '2018-10-19', 'Jumat', '4', 'B'),
(2578, 89, 3, '2018-10-26', 'Jumat', '4', 'B'),
(2579, 89, 3, '2018-11-02', 'Jumat', '4', 'B'),
(2580, 89, 3, '2018-11-09', 'Jumat', '4', 'B'),
(2581, 89, 3, '2018-11-16', 'Jumat', '4', 'B'),
(2582, 89, 3, '2018-11-23', 'Jumat', '4', 'B'),
(2583, 89, 3, '2018-05-16', 'Rabu', '3', 'B'),
(2584, 89, 3, '2018-05-23', 'Rabu', '3', 'B'),
(2585, 89, 3, '2018-05-30', 'Rabu', '3', 'B'),
(2586, 89, 3, '2018-06-06', 'Rabu', '3', 'B'),
(2587, 89, 3, '2018-06-13', 'Rabu', '3', 'B'),
(2588, 89, 3, '2018-06-20', 'Rabu', '3', 'B'),
(2589, 89, 3, '2018-06-27', 'Rabu', '3', 'B'),
(2590, 89, 3, '2018-07-04', 'Rabu', '3', 'B'),
(2591, 89, 3, '2018-07-11', 'Rabu', '3', 'B'),
(2592, 89, 3, '2018-07-18', 'Rabu', '3', 'B'),
(2593, 89, 3, '2018-07-25', 'Rabu', '3', 'B'),
(2594, 89, 3, '2018-08-01', 'Rabu', '3', 'B'),
(2595, 89, 3, '2018-08-08', 'Rabu', '3', 'B'),
(2596, 89, 3, '2018-08-15', 'Rabu', '3', 'B'),
(2597, 89, 3, '2018-08-22', 'Rabu', '3', 'B'),
(2598, 89, 3, '2018-08-29', 'Rabu', '3', 'B'),
(2599, 89, 3, '2018-09-05', 'Rabu', '3', 'B'),
(2600, 89, 3, '2018-09-12', 'Rabu', '3', 'B'),
(2601, 89, 3, '2018-09-19', 'Rabu', '3', 'B'),
(2602, 89, 3, '2018-09-26', 'Rabu', '3', 'B'),
(2603, 89, 3, '2018-10-03', 'Rabu', '3', 'B'),
(2604, 89, 3, '2018-10-10', 'Rabu', '3', 'B'),
(2605, 89, 3, '2018-10-17', 'Rabu', '3', 'B'),
(2606, 89, 3, '2018-10-24', 'Rabu', '3', 'B'),
(2607, 89, 3, '2018-10-31', 'Rabu', '3', 'B'),
(2608, 89, 3, '2018-11-07', 'Rabu', '3', 'B'),
(2609, 89, 3, '2018-11-14', 'Rabu', '3', 'B'),
(2610, 89, 3, '2018-11-21', 'Rabu', '3', 'B');

-- --------------------------------------------------------

--
-- Table structure for table `kuisioner`
--

CREATE TABLE `kuisioner` (
  `idkuisioner` int(11) NOT NULL,
  `idorangtua` int(11) NOT NULL,
  `idsiswabelajar` int(11) NOT NULL,
  `idguru` int(11) NOT NULL,
  `statuskuisioner` varchar(1) NOT NULL DEFAULT 'B' COMMENT 'B=belum terisi, S=sudah terisi',
  `tanggal` date NOT NULL,
  `penguasaanmateri` int(11) NOT NULL,
  `kemampuanmengajar` int(11) NOT NULL,
  `kedisiplinan` int(11) NOT NULL,
  `tanggungjawabdantingkahlaku` int(11) NOT NULL,
  `kerjasama` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kuisioner`
--

INSERT INTO `kuisioner` (`idkuisioner`, `idorangtua`, `idsiswabelajar`, `idguru`, `statuskuisioner`, `tanggal`, `penguasaanmateri`, `kemampuanmengajar`, `kedisiplinan`, `tanggungjawabdantingkahlaku`, `kerjasama`) VALUES
(261, 14, 85, 1, 'S', '2018-05-14', 1, 2, 3, 4, 5),
(262, 14, 85, 1, 'B', '2018-05-19', 0, 0, 0, 0, 0),
(263, 14, 85, 1, 'B', '2018-05-20', 0, 0, 0, 0, 0),
(264, 14, 85, 1, 'B', '2018-06-04', 0, 0, 0, 0, 0),
(265, 14, 85, 1, 'B', '2018-06-11', 0, 0, 0, 0, 0),
(266, 14, 85, 1, 'B', '2018-06-18', 0, 0, 0, 0, 0),
(267, 14, 85, 1, 'B', '2018-06-25', 0, 0, 0, 0, 0),
(268, 14, 85, 1, 'B', '2018-07-02', 0, 0, 0, 0, 0),
(269, 14, 85, 1, 'B', '2018-07-09', 0, 0, 0, 0, 0),
(270, 14, 85, 1, 'B', '2018-07-16', 0, 0, 0, 0, 0),
(271, 14, 85, 1, 'B', '2018-07-23', 0, 0, 0, 0, 0),
(272, 14, 85, 1, 'B', '2018-07-30', 0, 0, 0, 0, 0),
(273, 14, 85, 1, 'B', '2018-08-06', 0, 0, 0, 0, 0),
(274, 14, 85, 1, 'B', '2018-08-13', 0, 0, 0, 0, 0),
(275, 14, 85, 1, 'B', '2018-08-20', 0, 0, 0, 0, 0),
(276, 14, 85, 1, 'B', '2018-08-27', 0, 0, 0, 0, 0),
(277, 14, 85, 1, 'B', '2018-09-03', 0, 0, 0, 0, 0),
(278, 14, 85, 1, 'B', '2018-09-10', 0, 0, 0, 0, 0),
(279, 14, 85, 1, 'B', '2018-09-17', 0, 0, 0, 0, 0),
(280, 14, 85, 1, 'B', '2018-09-24', 0, 0, 0, 0, 0),
(281, 14, 85, 1, 'B', '2018-10-01', 0, 0, 0, 0, 0),
(282, 14, 85, 1, 'B', '2018-10-08', 0, 0, 0, 0, 0),
(283, 14, 85, 1, 'B', '2018-10-15', 0, 0, 0, 0, 0),
(284, 14, 85, 1, 'B', '2018-10-22', 0, 0, 0, 0, 0),
(285, 14, 85, 1, 'B', '2018-10-29', 0, 0, 0, 0, 0),
(286, 14, 85, 1, 'B', '2018-11-05', 0, 0, 0, 0, 0),
(287, 14, 85, 1, 'B', '2018-11-12', 0, 0, 0, 0, 0),
(288, 14, 85, 1, 'B', '2018-11-19', 0, 0, 0, 0, 0),
(289, 15, 87, 4, 'B', '2018-05-17', 0, 0, 0, 0, 0),
(290, 15, 87, 4, 'B', '2018-05-24', 0, 0, 0, 0, 0),
(291, 15, 87, 4, 'B', '2018-05-31', 0, 0, 0, 0, 0),
(292, 15, 87, 4, 'B', '2018-06-07', 0, 0, 0, 0, 0),
(293, 15, 87, 4, 'B', '2018-06-14', 0, 0, 0, 0, 0),
(294, 15, 87, 4, 'B', '2018-06-21', 0, 0, 0, 0, 0),
(295, 15, 87, 4, 'B', '2018-06-28', 0, 0, 0, 0, 0),
(296, 15, 87, 4, 'B', '2018-07-05', 0, 0, 0, 0, 0),
(297, 15, 87, 4, 'B', '2018-07-12', 0, 0, 0, 0, 0),
(298, 15, 87, 4, 'B', '2018-07-19', 0, 0, 0, 0, 0),
(299, 15, 87, 4, 'B', '2018-07-26', 0, 0, 0, 0, 0),
(300, 15, 87, 4, 'B', '2018-08-02', 0, 0, 0, 0, 0),
(301, 15, 87, 4, 'B', '2018-08-09', 0, 0, 0, 0, 0),
(302, 15, 87, 4, 'B', '2018-08-16', 0, 0, 0, 0, 0),
(303, 15, 87, 4, 'B', '2018-08-23', 0, 0, 0, 0, 0),
(304, 15, 87, 4, 'B', '2018-08-30', 0, 0, 0, 0, 0),
(305, 15, 87, 4, 'B', '2018-09-06', 0, 0, 0, 0, 0),
(306, 15, 87, 4, 'B', '2018-09-13', 0, 0, 0, 0, 0),
(307, 15, 87, 4, 'B', '2018-09-20', 0, 0, 0, 0, 0),
(308, 15, 87, 4, 'B', '2018-09-27', 0, 0, 0, 0, 0),
(309, 15, 87, 4, 'B', '2018-10-04', 0, 0, 0, 0, 0),
(310, 15, 87, 4, 'B', '2018-10-11', 0, 0, 0, 0, 0),
(311, 15, 87, 4, 'B', '2018-10-18', 0, 0, 0, 0, 0),
(312, 15, 87, 4, 'B', '2018-10-25', 0, 0, 0, 0, 0),
(313, 15, 87, 4, 'B', '2018-11-01', 0, 0, 0, 0, 0),
(314, 15, 87, 4, 'B', '2018-11-08', 0, 0, 0, 0, 0),
(315, 15, 87, 4, 'B', '2018-11-15', 0, 0, 0, 0, 0),
(316, 15, 87, 4, 'B', '2018-11-22', 0, 0, 0, 0, 0),
(317, 14, 86, 2, 'B', '2018-05-15', 0, 0, 0, 0, 0),
(318, 14, 86, 2, 'B', '2018-05-22', 0, 0, 0, 0, 0),
(319, 14, 86, 2, 'B', '2018-05-29', 0, 0, 0, 0, 0),
(320, 14, 86, 2, 'B', '2018-06-05', 0, 0, 0, 0, 0),
(321, 14, 86, 2, 'B', '2018-06-12', 0, 0, 0, 0, 0),
(322, 14, 86, 2, 'B', '2018-06-19', 0, 0, 0, 0, 0),
(323, 14, 86, 2, 'B', '2018-06-26', 0, 0, 0, 0, 0),
(324, 14, 86, 2, 'B', '2018-07-03', 0, 0, 0, 0, 0),
(325, 14, 86, 2, 'B', '2018-07-10', 0, 0, 0, 0, 0),
(326, 14, 86, 2, 'B', '2018-07-17', 0, 0, 0, 0, 0),
(327, 14, 86, 2, 'B', '2018-07-24', 0, 0, 0, 0, 0),
(328, 14, 86, 2, 'B', '2018-07-31', 0, 0, 0, 0, 0),
(329, 14, 86, 2, 'B', '2018-08-07', 0, 0, 0, 0, 0),
(330, 14, 86, 2, 'B', '2018-08-14', 0, 0, 0, 0, 0),
(331, 14, 86, 2, 'B', '2018-08-21', 0, 0, 0, 0, 0),
(332, 14, 86, 2, 'B', '2018-08-28', 0, 0, 0, 0, 0),
(333, 14, 86, 2, 'B', '2018-09-04', 0, 0, 0, 0, 0),
(334, 14, 86, 2, 'B', '2018-09-11', 0, 0, 0, 0, 0),
(335, 14, 86, 2, 'B', '2018-09-18', 0, 0, 0, 0, 0),
(336, 14, 86, 2, 'B', '2018-09-25', 0, 0, 0, 0, 0),
(337, 14, 86, 2, 'B', '2018-10-02', 0, 0, 0, 0, 0),
(338, 14, 86, 2, 'B', '2018-10-09', 0, 0, 0, 0, 0),
(339, 14, 86, 2, 'B', '2018-10-16', 0, 0, 0, 0, 0),
(340, 14, 86, 2, 'B', '2018-10-23', 0, 0, 0, 0, 0),
(341, 14, 86, 2, 'B', '2018-10-30', 0, 0, 0, 0, 0),
(342, 14, 86, 2, 'B', '2018-11-06', 0, 0, 0, 0, 0),
(343, 14, 86, 2, 'B', '2018-11-13', 0, 0, 0, 0, 0),
(344, 14, 86, 2, 'B', '2018-11-20', 0, 0, 0, 0, 0),
(345, 14, 86, 2, 'B', '2018-11-27', 0, 0, 0, 0, 0),
(346, 14, 86, 2, 'B', '2018-12-04', 0, 0, 0, 0, 0),
(347, 14, 86, 2, 'B', '2018-12-11', 0, 0, 0, 0, 0),
(348, 14, 86, 2, 'B', '2018-12-18', 0, 0, 0, 0, 0),
(349, 15, 88, 5, 'B', '2018-05-21', 0, 0, 0, 0, 0),
(350, 15, 88, 5, 'B', '2018-05-28', 0, 0, 0, 0, 0),
(351, 15, 88, 5, 'B', '2018-06-04', 0, 0, 0, 0, 0),
(352, 15, 88, 5, 'B', '2018-06-11', 0, 0, 0, 0, 0),
(353, 15, 88, 5, 'B', '2018-06-18', 0, 0, 0, 0, 0),
(354, 15, 88, 5, 'B', '2018-06-25', 0, 0, 0, 0, 0),
(355, 15, 88, 5, 'B', '2018-07-02', 0, 0, 0, 0, 0),
(356, 15, 88, 5, 'B', '2018-07-09', 0, 0, 0, 0, 0),
(357, 15, 88, 5, 'B', '2018-07-16', 0, 0, 0, 0, 0),
(358, 15, 88, 5, 'B', '2018-07-23', 0, 0, 0, 0, 0),
(359, 15, 88, 5, 'B', '2018-07-30', 0, 0, 0, 0, 0),
(360, 15, 88, 5, 'B', '2018-08-06', 0, 0, 0, 0, 0),
(361, 15, 88, 5, 'B', '2018-08-13', 0, 0, 0, 0, 0),
(362, 15, 88, 5, 'B', '2018-08-20', 0, 0, 0, 0, 0),
(363, 15, 88, 5, 'B', '2018-08-27', 0, 0, 0, 0, 0),
(364, 15, 88, 5, 'B', '2018-09-03', 0, 0, 0, 0, 0),
(365, 15, 88, 5, 'B', '2018-09-10', 0, 0, 0, 0, 0),
(366, 15, 88, 5, 'B', '2018-09-17', 0, 0, 0, 0, 0),
(367, 15, 88, 5, 'B', '2018-09-24', 0, 0, 0, 0, 0),
(368, 15, 88, 5, 'B', '2018-10-01', 0, 0, 0, 0, 0),
(369, 15, 88, 5, 'B', '2018-10-08', 0, 0, 0, 0, 0),
(370, 15, 88, 5, 'B', '2018-10-15', 0, 0, 0, 0, 0),
(371, 15, 88, 5, 'B', '2018-10-22', 0, 0, 0, 0, 0),
(372, 15, 88, 5, 'B', '2018-10-29', 0, 0, 0, 0, 0),
(373, 15, 88, 5, 'B', '2018-11-05', 0, 0, 0, 0, 0),
(374, 15, 88, 5, 'B', '2018-11-12', 0, 0, 0, 0, 0),
(375, 15, 88, 5, 'B', '2018-11-19', 0, 0, 0, 0, 0),
(376, 15, 88, 5, 'B', '2018-11-26', 0, 0, 0, 0, 0),
(377, 15, 88, 5, 'B', '2018-12-03', 0, 0, 0, 0, 0),
(378, 15, 88, 5, 'B', '2018-12-10', 0, 0, 0, 0, 0),
(379, 15, 88, 5, 'B', '2018-12-17', 0, 0, 0, 0, 0),
(380, 15, 88, 5, 'B', '2018-12-24', 0, 0, 0, 0, 0),
(381, 14, 89, 3, 'B', '2018-05-16', 0, 0, 0, 0, 0),
(382, 14, 89, 3, 'B', '2018-05-23', 0, 0, 0, 0, 0),
(383, 14, 89, 3, 'B', '2018-05-30', 0, 0, 0, 0, 0),
(384, 14, 89, 3, 'B', '2018-06-06', 0, 0, 0, 0, 0),
(385, 14, 89, 3, 'B', '2018-06-13', 0, 0, 0, 0, 0),
(386, 14, 89, 3, 'B', '2018-06-20', 0, 0, 0, 0, 0),
(387, 14, 89, 3, 'B', '2018-06-27', 0, 0, 0, 0, 0),
(388, 14, 89, 3, 'B', '2018-07-04', 0, 0, 0, 0, 0),
(389, 14, 89, 3, 'B', '2018-07-11', 0, 0, 0, 0, 0),
(390, 14, 89, 3, 'B', '2018-07-18', 0, 0, 0, 0, 0),
(391, 14, 89, 3, 'B', '2018-07-25', 0, 0, 0, 0, 0),
(392, 14, 89, 3, 'B', '2018-08-01', 0, 0, 0, 0, 0),
(393, 14, 89, 3, 'B', '2018-08-08', 0, 0, 0, 0, 0),
(394, 14, 89, 3, 'B', '2018-08-15', 0, 0, 0, 0, 0),
(395, 14, 89, 3, 'B', '2018-08-22', 0, 0, 0, 0, 0),
(396, 14, 89, 3, 'B', '2018-08-29', 0, 0, 0, 0, 0),
(397, 14, 89, 3, 'B', '2018-09-05', 0, 0, 0, 0, 0),
(398, 14, 89, 3, 'B', '2018-09-12', 0, 0, 0, 0, 0),
(399, 14, 89, 3, 'B', '2018-09-19', 0, 0, 0, 0, 0),
(400, 14, 89, 3, 'B', '2018-09-26', 0, 0, 0, 0, 0),
(401, 14, 89, 3, 'B', '2018-10-03', 0, 0, 0, 0, 0),
(402, 14, 89, 3, 'B', '2018-10-10', 0, 0, 0, 0, 0),
(403, 14, 89, 3, 'B', '2018-10-17', 0, 0, 0, 0, 0),
(404, 14, 89, 3, 'B', '2018-10-24', 0, 0, 0, 0, 0),
(405, 14, 89, 3, 'B', '2018-10-31', 0, 0, 0, 0, 0),
(406, 14, 89, 3, 'B', '2018-11-07', 0, 0, 0, 0, 0),
(407, 14, 89, 3, 'B', '2018-11-14', 0, 0, 0, 0, 0),
(408, 14, 89, 3, 'B', '2018-11-21', 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `lessonplan`
--

CREATE TABLE `lessonplan` (
  `idlessonplan` int(11) NOT NULL,
  `idprogramlevel` int(11) NOT NULL,
  `pertemuan` int(11) NOT NULL,
  `hal` int(11) NOT NULL,
  `materi` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lessonplan`
--

INSERT INTO `lessonplan` (`idlessonplan`, `idprogramlevel`, `pertemuan`, `hal`, `materi`) VALUES
(1, 1, 1, 4, 'Kreativitas, pengenalan bunyi, mencari letak bunyi & simbol \"a\"'),
(2, 1, 2, 8, 'Review, pengenalan bunyi, mencari letak bunyi & simbol \"i\", motorik'),
(3, 1, 3, 12, 'Review, pengenalan bunyi, mencari letak bunyi & simbol \"u\", motorik'),
(4, 1, 4, 15, 'Review, pengenalan bunyi, mencari letak bunyi & simbol \"e\"'),
(5, 1, 5, 19, 'Review, pengenalan bunyi, mencari letak bunyi & simbol \"o\", motorik'),
(6, 1, 6, 22, 'Motorik & latihan melengkapi kata'),
(7, 1, 7, 25, 'Pengenalan bunyi & mencari letak bunyi \"ba..bu\"'),
(8, 1, 8, 28, 'Mencari letak bunyi \"be..bo\" & simbol \"b\', motorik \"ba…bo\"'),
(9, 1, 9, 30, 'Review \"ba..bo\", latihan melengkapi kata'),
(10, 1, 10, 34, 'Pengenalan bunyi & mencari letak bunyi \"ca….co\" & simbol \"c\"'),
(11, 1, 11, 37, 'Review simbol \"c\"; motorik \"ca…co\" & melengkapi kata'),
(12, 1, 12, 41, 'Pengenalan bunyi & mencari letak bunyi \"da….do\" & simbol \"d\"'),
(13, 1, 13, 44, 'Review \"ba…bo & ca..co\"; Latihan tarik garis & melengkapi kata; Motorik \"do…do\"'),
(14, 1, 14, 46, 'Membaca \"ba…bo - da…do\"; Latihan'),
(15, 1, 15, 50, 'Pengenalan bunyi & mencari letak bunyi \"fa….fo\" & simbol \"f\"; motorik \"fa…fo\"'),
(16, 1, 16, 53, 'Review; Radiant \"Ibu Fida\"; Pengenalan bunyi & mencari letak bunyi \"ga, gi & go\"'),
(17, 1, 17, 56, 'Mencari letak bunyi \"gu & ge\"; pengenalan simbol \"g\"; motorik \"ga…go\"'),
(18, 1, 18, 58, 'Review ba…bo - ga..go; Radiant \"Gigi\"; Latihan melengkapi kata'),
(19, 1, 19, 59, 'Pengenalan bunyi & mencari letak bunyi \"ha….ho\" & simbol \"h\"'),
(20, 1, 20, 64, 'Review; Membaca kata \"TTS\"; Latihan melengkapi kata'),
(21, 1, 21, 68, 'Pengenalan bunyi & mencari letak bunyi \"ja….jo\" & simbol \"j\"'),
(22, 1, 22, 71, 'Membaca suku kata \"fa..fo - ja…jo\"; Latihan; motorik \"ha…ho & ja…jo\" '),
(23, 1, 23, 73, 'Radiant \" Gajah\"; Latihan'),
(24, 1, 24, 76, 'Review; Latihan melengkapi kata; Pengenalan bunyi & mencari letak bunyi \"ka….ki\"'),
(25, 1, 25, 79, 'Mencari letak bunyi \"ki….ko\" & simbol \"k\"'),
(26, 1, 26, 83, 'Membaca kalimat; motorik \"ka…ko\", Latihan'),
(27, 1, 27, 84, 'Membaca kalimat; Review \"ka…ko\", Latihan melengkapi kata'),
(28, 1, 28, 86, 'Menulis kata; Radiant \"Keju\"'),
(29, 1, 29, 89, 'Radiant \"batu\"; Pengenalan bunyi & mencari letak bunyi \"la & li\" '),
(30, 1, 30, 92, 'Mencari letak bunyi \"li, lu, lo & le\" & simbol \"l\"; Radiant \"kayu\" '),
(31, 1, 31, 94, 'Membaca kata & kalimat'),
(32, 1, 32, 96, 'Review; Latihan melengkapi kata; Radiant laba-laba'),
(33, 1, 33, 99, 'Pengenalan bunyi \"ma..mo\"; Simbol \"m\"; Latihan melengkapi kata'),
(34, 1, 34, 101, 'Radiant \"jeruk\"; Membaca kalimat'),
(35, 1, 35, 104, 'Latihan melengkapi kata, Pengenalan bunyi \"na..no\"; Simbol \"n\";'),
(36, 1, 36, 107, 'Melengkapi kata; Membaca suku kata; Puzzle'),
(37, 1, 37, 109, 'Membaca kalimat; Radiant \"koki\"'),
(38, 1, 38, 112, 'Pengenalan bunyi \"pa..po\"; Simbol \"p\"; Latihan melengkapi kata'),
(39, 1, 39, 114, 'Radiant \"petani\" & \"Polisi\"'),
(40, 1, 40, 118, 'Latihan melengkapi kata; Simbol \"q\"; Pengenalan bunyi \"ra…ro\" & simbol \"r\"'),
(41, 1, 41, 120, 'Review \"ra…ro\"; Latihan melengkapi kata & TTS'),
(42, 1, 42, 123, 'Radiant \"perawat\", Pengenalan bunyi \"sa…so\" & Simbol \"s\"; '),
(43, 1, 43, 128, 'Latihan melengkapi kata & tarik garis'),
(44, 1, 44, 128, 'Latihan melengkapi kata; Radiant\"sepeda\"; membaca suku kata \"pa…po - sa…so\"'),
(45, 1, 45, 132, 'Pengenalan bunyi \"ta..to\"; Simbol \"t\"; Latihan melengkapi kata'),
(46, 1, 46, 134, 'Latihan melengkapi kata; Membaca kata'),
(47, 1, 47, 136, 'Review; Pengenalan bunyi \"va..vo\"; Simbol \"v\"; '),
(48, 1, 48, 139, 'Pengenalan bunyi \"wa..wo\"; Simbol \"w\"; Latihan melengkapi kata'),
(49, 1, 49, 143, 'Membaca kata; Simbol \"x\"; Membaca suku kata \"fa..fo-wa…wo\"; Puzzle'),
(50, 1, 50, 146, 'Review; Pengenalan bunyi \"ya..yo\" & simbol \"y\"; Latihan melengkapi kata'),
(51, 1, 51, 149, 'Review; Simbol \"z\"; Membaca suku kata \"xa…xo - za…zo\"; Latihan melengkapi kata'),
(52, 1, 52, 152, 'Radiant \"pepaya\"; Menulis kata'),
(53, 1, 53, 159, 'Menulis kata & radiant \"Gorila\"'),
(54, 1, 54, 160, 'Menulis kata & radiant \"matematika\"'),
(55, 1, 55, 161, 'Menulis kata & membaca kalimat'),
(56, 1, 56, 162, 'Menulis kata & membaca kalimat'),
(57, 2, 1, 4, 'Pengenalan bunyi akhiran \"m\" & latihan melengkapi kata'),
(58, 2, 2, 6, 'Latihan melengkapi kata & radiant \"Hakam\"'),
(59, 2, 3, 10, 'Pengenalan bunyi akhiran \"n\" & latihan melengkapi kata'),
(60, 2, 4, 12, 'Latihan melengkapi kata & radiant \"Panda\"'),
(61, 2, 5, 17, 'Pengenalan bunyi akhiran \"p\"; Latihan melengkapi kata & radiant \"hari masih pagi\"'),
(62, 2, 6, 21, 'Pengenalan bunyi akhiran \"l\"; Latihan melengkapi kata'),
(63, 2, 7, 25, 'Pengenalan bunyi akhiran \"s\"; Latihan melengkapi kata'),
(64, 2, 8, 29, 'Melengkapi kata; Radiant \"kastil\"; Pengenalan bunyi akhiran \"t\"'),
(65, 2, 9, 32, 'Lanjutan pengenalan bunyi akhiran \"t\"; Melengkapi kata'),
(66, 2, 10, 36, 'Pengenalan bunyi akhiran \"k\"; Latihan melengkapi kata'),
(67, 2, 11, 40, 'Melengkapi kata; membaca kata; Pengenalan bunyi akhiran \"r\"'),
(68, 2, 12, 43, 'Pengenalan bunyi akhiran \"r\"; Latihan melengkapi kata'),
(69, 2, 13, 48, 'Membaca kalimat & menulis; Pengenalan bunyi akhiran \"h\"; Latihan melengkapi kata'),
(70, 2, 14, 51, 'Latihan melengkapi kata; Pengenalan bunyi mengandung \"ng\"'),
(71, 2, 15, 55, 'Pengenalan bunyi akhiran \"ng\"; Latihan melengkapi kata'),
(72, 2, 16, 58, 'Latihan melengkapi kata; Membaca kata'),
(73, 2, 17, 61, 'Radiant \"zoo\'; Pengenalan bunyi mengandung \"ny\"; Latihan melengkapi kata'),
(74, 2, 18, 64, 'Radiant \"Penyihir\"; Membaca kata; Radiant \"kalkulator\"'),
(75, 2, 19, 67, 'Radiant \"mandi\"; menulis kata'),
(76, 2, 20, 68, 'Radiant \"kursi goyang\"; Menulis kata'),
(77, 3, 1, 4, 'Pengenalan materi ai…ao - oa…ae; Latihan menarik garis'),
(78, 3, 2, 7, 'Membaca kata & kalimat; Menulis kata'),
(79, 3, 3, 9, 'Membaca kalimat (melanjutkan); Menulis kata'),
(80, 3, 4, 11, 'Pengenalan materi bla…blo; zla…zlo'),
(81, 3, 5, 13, 'Radiant \"mas paijo\"; Pengenalan materi bra…bro; zra…zro'),
(82, 3, 6, 15, 'Radiant \"Indonesia\"'),
(83, 3, 7, 17, 'Membaca & Menulis kalimat'),
(84, 3, 8, 19, 'Membaca & Menulis kalimat; Pengenalan materi sha…sho - stra…stro'),
(85, 3, 9, 23, 'Membaca & Menulis kalimat; Menulis kata'),
(86, 3, 10, 24, 'Membaca & Menulis kalimat; Menulis kata'),
(87, 3, 11, 25, 'Membaca & Menulis kata; Menulis kata'),
(88, 4, 1, 4, 'Kreatifitas; Motorik, konsep 1 (kehadiran benda & simbol); variasi jari'),
(89, 4, 2, 8, 'Review'),
(90, 4, 3, 12, 'Konsep 3 Variasi jari; Latihan (melingkari & menulis angka, tarik garis)'),
(91, 4, 4, 15, 'Review'),
(92, 4, 5, 19, 'Motorik'),
(93, 4, 6, 21, 'Mewarnai'),
(94, 4, 7, 24, 'Latihan (melingkari & menulis angka, tarik garis)'),
(95, 4, 8, 27, 'Motorik (pandangan periferal)'),
(96, 4, 9, 29, 'Persamaan (? + ? = 8)'),
(97, 4, 10, 33, 'Konsep 6-7  (kehadiran benda & simbol)'),
(98, 4, 11, 36, 'Latihan (tarik garis & melingkari angka)'),
(99, 4, 12, 39, 'Konsep 9 - 10 (kehadiran benda & simbol)'),
(100, 4, 13, 42, 'Latihan (menulis bilangan & tarik garis)'),
(101, 4, 14, 45, 'Menebali 6-10'),
(102, 4, 15, 48, 'Latihan (melingkari angka)'),
(103, 4, 16, 50, 'Latihan (membuat gambar)'),
(104, 4, 17, 53, 'Mewarnai'),
(105, 4, 18, 56, 'Latihan (menulis angka & membuat gambar)'),
(106, 4, 19, 59, 'Latihan (membuat gambar)'),
(107, 4, 20, 62, 'Pola'),
(108, 4, 21, 65, 'Review & latihan teman kecil'),
(109, 4, 22, 68, 'Latihan teman kecil'),
(110, 4, 23, 71, 'Motorik (pandangan periferal)'),
(111, 4, 24, 74, 'Latihan teman kecil'),
(112, 4, 25, 76, 'Review & latihan teman besar'),
(113, 4, 26, 79, 'Review & latihan teman besar'),
(114, 4, 27, 82, 'Latihan teman besar'),
(115, 4, 28, 86, 'Mewarnai; Konsep sama (=), lebih banyak (>) & latihannya'),
(116, 4, 29, 91, 'Konsep sama (=), lebih sedikit (>) & latihannya; Konsep penjumlahan & pengurangan (+ & -)'),
(117, 4, 30, 94, 'Review konsep penjumlahan & pengurangan (+ & -)'),
(118, 4, 31, 97, 'Review konsep penjumlahan & pengurangan (+ & -)'),
(119, 4, 32, 101, 'Pemahaman simbol penjumlahan (+) & pengurangan (-)'),
(120, 4, 33, 104, 'Pemahaman simbol penjumlahan (+) & pengurangan (-)'),
(121, 4, 34, 108, 'Latihan teman besar, sama (=) & lebih banyak (>)'),
(122, 4, 35, 112, 'Latihan lebih sedikit (<)'),
(123, 4, 36, 115, 'Konsep & latihan penjumlahan (+)'),
(124, 4, 37, 118, 'Latihan teman kecil'),
(125, 4, 38, 121, 'Mewarnai'),
(126, 4, 39, 124, 'Latihan (+) & (-) (oo + o = …. & ooo - o = ….)'),
(127, 4, 40, 128, 'Motorik (Pandangan periferal)'),
(128, 4, 41, 131, 'Latihan (+) & (-) (oo + o = …. & ooo - o = ….)'),
(129, 4, 42, 135, 'Latihan (+) & (-) (oo + o = …. & ooo - o = ….)'),
(130, 4, 43, 138, 'Latihan (+) (oo + o = …. )'),
(131, 4, 44, 141, 'Latihan (-) (ooo-o=….)'),
(132, 4, 45, 143, 'Soal cerita (+) (oo+o=…)'),
(133, 4, 46, 146, 'Soal cerita (+) (-) (oo+o=… & ooo-o=...)'),
(134, 4, 47, 148, 'Soal cerita (+) (-) (oo+o=… & ooo-o=...)'),
(135, 4, 48, 151, 'Soal cerita (+) (-) (oo+o=… & ooo-o=...)'),
(136, 4, 49, 153, 'Soal cerita (+) (-) (oo+o=… & ooo-o=...)'),
(137, 4, 50, 155, 'Soal cerita (+) (-) (oo+o=… & ooo-o=...)'),
(138, 4, 51, 158, 'Konsep & latihan penjumlahan (oo-…=o)'),
(139, 4, 52, 161, 'Persamaan (? + ? = 8)'),
(140, 4, 53, 164, 'Soal cerita (+) (oo+…=ooo)'),
(141, 4, 54, 167, 'Persamaan (? + ? = 8)'),
(142, 4, 55, 170, 'Klasifikasi'),
(143, 4, 56, 173, 'Latihan (-)(ooo-…=o)'),
(144, 4, 57, 176, 'Pola'),
(145, 4, 58, 179, 'Persamaan (? + ? = 8)'),
(146, 4, 59, 183, 'Latihan (+) & (-) (…+o=ooo & …-o=ooo)'),
(147, 4, 60, 186, 'Latihan (+) & (-) (…+o=ooo & …-o=ooo)'),
(148, 4, 61, 189, 'Latihan(-) (…-o=ooo)'),
(149, 4, 62, 192, 'Klasifikasi'),
(150, 4, 63, 194, 'Soal Cerita (-) (…+o=ooo)'),
(151, 5, 1, 4, 'Konsep 11- 13 (kehadiran benda, Simbol & jari); Pengelompokkan; Latihan (melingkari angka)'),
(152, 5, 2, 8, 'Latihan (melingkari angka); Motorik mata; Konsep 14-15 (kehadiran benda, simbol & jari); Pengelompok'),
(153, 5, 3, 11, 'Review'),
(154, 5, 4, 14, 'Pengelompokkan'),
(155, 5, 5, 18, 'Persepsi'),
(156, 5, 6, 21, 'Konsep 16- 17 (kehadiran benda, Simbol & jari); Mewarnai; Motorik mata; Klasifikasi'),
(157, 5, 7, 25, 'Konsep 19- 20 (kehadiran benda, Simbol & jari); Klasifikasi; Latihan (melengkapi angka)'),
(158, 5, 8, 28, 'Perbandingan'),
(159, 5, 9, 31, 'Urutan angka'),
(160, 5, 10, 34, 'Latihan (melengkapi angka)'),
(161, 5, 11, 37, 'Latihan (+) (11-an)'),
(162, 5, 12, 41, 'Latihan (+) &(-) (11-an)'),
(163, 5, 13, 46, 'Simbol 10-an'),
(164, 5, 14, 49, 'Thingking skill (mencari jumlah bangun datar)'),
(165, 5, 15, 53, 'Dot'),
(166, 5, 16, 56, 'Motorik (pandangan periferal)'),
(167, 5, 17, 60, '(+) Permisalan'),
(168, 5, 18, 64, '(+) permisalan'),
(169, 5, 19, 68, '(+) permisalan'),
(170, 5, 20, 72, '(+) permisalan'),
(171, 5, 21, 75, 'Perbandingan'),
(172, 5, 22, 78, 'Latihan (+) & (-) (11-an)'),
(173, 5, 23, 81, 'Latihan (+) & (-) (11-an)'),
(174, 5, 24, 84, 'Soal cerita (+) & (-) (11-an)'),
(175, 5, 25, 88, 'Soal cerita (+) & (-) (11-an)'),
(176, 5, 26, 92, 'Latihan (+) & (-) (11-an)'),
(177, 5, 27, 96, 'Latihan (-) permisalan'),
(178, 5, 28, 98, 'Soal cerita (+) & (-) (11-an)'),
(179, 5, 29, 100, 'Soal cerita (+) & (-) (11-an)'),
(180, 5, 30, 102, 'Soal cerita (+) & (-) (11-an)');

-- --------------------------------------------------------

--
-- Table structure for table `materi`
--

CREATE TABLE `materi` (
  `idmateri` int(11) NOT NULL,
  `idprogramlevel` int(11) NOT NULL,
  `hal` int(11) NOT NULL,
  `materi` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `materi`
--

INSERT INTO `materi` (`idmateri`, `idprogramlevel`, `hal`, `materi`) VALUES
(1, 1, 1, 'Ikatan bounding (melatih kreatifitas anak)'),
(2, 1, 2, 'Pengenalan bunyi \"a\"'),
(3, 1, 3, 'Kepekaan bunyi (mencari letak bunyi \"a\")'),
(4, 1, 4, 'Pengenalan simbol \"a\"'),
(5, 1, 5, 'Pengenalan bunyi \"i\"'),
(6, 1, 6, 'Kepekaan bunyi (mencari letak bunyi \"i\")'),
(7, 1, 7, 'Pengenalan simbol \"i\"'),
(8, 1, 8, 'Mengenalkan garis lurus & lengkung, melatih motorik'),
(9, 1, 9, 'Pengenalan bunyi \"u\"'),
(10, 1, 10, 'Kepekaan bunyi (mencari letak bunyi \"u\")'),
(11, 1, 11, 'Pengenalan simbol \"u\"'),
(12, 1, 12, 'Review simbol \"a, I, u\" (menebali simbol)'),
(13, 1, 13, 'Pengenalan bunyi \"e\"'),
(14, 1, 14, 'Kepekaan bunyi (mencari letak bunyi \"e\")'),
(15, 1, 15, 'Pengenalan simbol \"e\"'),
(16, 1, 16, 'Pengenalan bunyi \"o\"'),
(17, 1, 17, 'Kepekaan bunyi (mencari letak bunyi \"o\")'),
(18, 1, 18, 'Pengenalan simbol \"o\"'),
(19, 1, 19, 'Review simbol \"e, o, u\" (menebali simbol)'),
(20, 1, 20, 'Review simbol \"a, I, u, e, o\" (menebali simbol)'),
(21, 1, 21, 'Latihan (melengkapi kata dengan huruf vokal)'),
(22, 1, 22, 'Latihan (melengkapi kata dengan huruf vokal)'),
(23, 1, 23, 'Pengenalan bunyi \"ba…bo\"'),
(24, 1, 24, 'Kepekaan bunyi (mencari letak bunyi \"ba & bi\")'),
(25, 1, 25, 'Kepekaan bunyi (mencari letak bunyi \"bu\")'),
(26, 1, 26, 'Kepekaan bunyi (mencari letak bunyi \"be..bo\")'),
(27, 1, 27, 'Pengenalan simbol \"b\"'),
(28, 1, 28, 'Pengenalan simbol bunyi & menebali ba..bo'),
(29, 1, 29, 'Latihan (melengkapi kata dengan huruf vokal)'),
(30, 1, 30, 'Latihan (melengkapi kata dengan suku kata ba…bo)'),
(31, 1, 31, 'Pengenalan bunyi \"ca…co\"'),
(32, 1, 32, 'Kepekaan bunyi (mencari letak bunyi \"ca & ci\")'),
(33, 1, 33, 'Kepekaan bunyi (mencari letak bunyi \"cu, ce, co\")'),
(34, 1, 34, 'Pengenalan simbol \"c\"'),
(35, 1, 35, 'Pengenalan simbol bunyi & menebali ca…co'),
(36, 1, 36, 'Latihan (melengkapi kata dengan suku kata ca…co)'),
(37, 1, 37, 'Latihan (melengkapi kata dengan suku kata ba…bo & ca…co)'),
(38, 1, 38, 'Pengenalan bunyi \"da…do\"'),
(39, 1, 39, 'Kepekaan bunyi (mencari letak bunyi \"da & di\")'),
(40, 1, 40, 'Kepekaan bunyi (mencari letak bunyi \"du, de, do\")'),
(41, 1, 41, 'Pengenalan simbol \"d\"'),
(42, 1, 42, 'Latihan (tarik garis da, do, di & a, b, c, d)'),
(43, 1, 43, 'Pengenalan simbol bunyi & menebali da…do'),
(44, 1, 44, 'Latihan (melengkapi kata dengan suku kata da…do)'),
(45, 1, 45, 'Review (membaca ba…bo, ca…co, da…do)'),
(46, 1, 46, 'Latihan (mencari suku kata ba..bo, ca…co, da…do)'),
(47, 1, 47, 'Pengenalan bunyi \"fa…fo\"'),
(48, 1, 48, 'Kepekaan bunyi (mencari letak bunyi \"fa…fo\")'),
(49, 1, 49, 'Pengenalan simbol \"f\"'),
(50, 1, 50, 'Pengenalan simbol bunyi & menebali fa…fo'),
(51, 1, 51, 'Radiant (membaca dan melengkapi kata \"Ibu Fida\")'),
(52, 1, 52, 'Pengenalan bunyi \"ga…go\"'),
(53, 1, 53, 'Kepekaan bunyi (mencari letak bunyi \"ga, gi, go\")'),
(54, 1, 54, 'Kepekaan bunyi (mencari letak bunyi \"gu, ge\")'),
(55, 1, 55, 'Pengenalan simbol \"g\"'),
(56, 1, 56, 'Pengenalan simbol bunyi & menebali ga…go'),
(57, 1, 57, 'Radiant (membaca dan melengkapi kata \"Gigi\")'),
(58, 1, 58, 'Latihan (melengkapi kata dengan suku kata ba…bo - ga..go)'),
(59, 1, 59, 'Pengenalan bunyi \"ha…ho\"'),
(60, 1, 60, 'Kepekaan bunyi (mencari letak bunyi \"ha & hi\")'),
(61, 1, 61, 'Kepekaan bunyi (mencari letak bunyi \"hu, he, ho\")'),
(62, 1, 62, 'Pengenalan simbol \"h\"'),
(63, 1, 63, 'Latihan (membaca kata)'),
(64, 1, 64, 'Latihan (menulis suku kata depan \"ga..go & ha..ho)'),
(65, 1, 65, 'Pengenalan bunyi \"ja…jo\"'),
(66, 1, 66, 'Kepekaan bunyi (mencari letak bunyi \"ja & ji\")'),
(67, 1, 67, 'Kepekaan bunyi (mencari letak bunyi \"ju, je, jo\")'),
(68, 1, 68, 'Pengenalan simbol \"j\"'),
(69, 1, 69, 'Review (membaca fa…fo-ja…jo)'),
(70, 1, 70, 'Latihan (mencari suku kata berawalan b, c, d, f, g, h, j)'),
(71, 1, 71, 'Pengenalan simbol bunyi & menebali ha…ho - ja..jo'),
(72, 1, 72, 'Radiant (membaca dan melengkapi kata \"Gajah\")'),
(73, 1, 73, 'Latihan (tarik garis ja,ju,je)'),
(74, 1, 74, 'Latihan (melengkapi kata dengan vokal & suku kata )'),
(75, 1, 75, 'Pengenalan bunyi \"ka…ko\"'),
(76, 1, 76, 'Kepekaan bunyi (mencari letak bunyi \"ka & ki\")'),
(77, 1, 77, 'Kepekaan bunyi (mencari letak bunyi \"ki & ku\")'),
(78, 1, 78, 'Kepekaan bunyi (mencari letak bunyi \"ke & ko\")'),
(79, 1, 79, 'Pengenalan simbol \"k\"'),
(80, 1, 80, 'Membaca kalimat'),
(81, 1, 81, 'Membaca kalimat'),
(82, 1, 82, 'Pengenalan simbol bunyi & menebali ka…ko'),
(83, 1, 83, 'Latihan (tarik garis ka…ko)'),
(84, 1, 84, 'Latihan (melengkapi kata suku kata ka…ko )'),
(85, 1, 85, 'Menulis kata sesuai gambar'),
(86, 1, 86, 'Radiant (membaca dan melengkapi kata \"Keju\")'),
(87, 1, 87, 'Radiant (membaca dan melengkapi kata \"Bahu\")'),
(88, 1, 88, 'Pengenalan bunyi \"la…lo\"'),
(89, 1, 89, 'Kepekaan bunyi (mencari letak bunyi \"la & li\")'),
(90, 1, 90, 'Kepekaan bunyi (mencari letak bunyi \"li , lu, le & lo\")'),
(91, 1, 91, 'Pengenalan simbol \"l\"'),
(92, 1, 92, 'Radiant (membaca dan melengkapi kata \"Kayu\")'),
(93, 1, 93, 'Membaca kata'),
(94, 1, 94, 'Membaca kalimat'),
(95, 1, 95, 'Latihan (melengkapi kata)'),
(96, 1, 96, 'Radiant (membaca dan melengkapi kata \"laba-laba\")'),
(97, 1, 97, 'Pengenalan bunyi \"ma…mo\"'),
(98, 1, 98, 'Pengenalan simbol \"m\"'),
(99, 1, 99, 'Latihan (melengkapi kata)'),
(100, 1, 100, 'Radiant (membaca dan melengkapi kata \"Jeruk\")'),
(101, 1, 101, 'Membaca kalimat'),
(102, 1, 102, 'Latihan (melengkapi kata)'),
(103, 1, 103, 'Pengenalan bunyi \"na…no\"'),
(104, 1, 104, 'Pengenalan simbol \"n\"'),
(105, 1, 105, 'Latihan (melengkapi kata)'),
(106, 1, 106, 'Review (membaca ka..ko - na..no)'),
(107, 1, 107, 'Latihan (mencari suku kata berawalan b, c, d, f, g, h, j, k, l, m, n)'),
(108, 1, 108, 'Membaca kalimat'),
(109, 1, 109, 'Radiant (membaca dan melengkapi kata \"koki\")'),
(110, 1, 110, 'Pengenalan bunyi \"pa…po\"'),
(111, 1, 111, 'Pengenalan simbol \"p\"'),
(112, 1, 112, 'Latihan (melengkapi kata)'),
(113, 1, 113, 'Radiant (membaca dan melengkapi kata \"petani\")'),
(114, 1, 114, 'Radiant (membaca dan melengkapi kata \"polisi\")'),
(115, 1, 115, 'Latihan (melengkapi kata)'),
(116, 1, 116, 'Pengenalan simbol \"q\"'),
(117, 1, 117, 'Pengenalan bunyi \"ra…ro\"'),
(118, 1, 118, 'Pengenalan simbol \"r\"'),
(119, 1, 119, 'Latihan (melengkapi kata)'),
(120, 1, 120, 'Latihan (mencari kata)'),
(121, 1, 121, 'Radiant (membaca dan melengkapi kata \"perawat\")'),
(122, 1, 122, 'Pengenalan bunyi \"sa…so\"'),
(123, 1, 123, 'Pengenalan simbol \"s\"'),
(124, 1, 124, 'Latihan (melengkapi kata)'),
(125, 1, 125, 'Latihan (tarik garis sa…so)'),
(126, 1, 126, 'Latihan (melengkapi kata)'),
(127, 1, 127, 'Radiant (membaca dan melengkapi kata \"sepeda\")'),
(128, 1, 128, 'Review (membaca pa..po - sa..so)'),
(129, 1, 129, 'Pengenalan bunyi \"ta…to\"'),
(130, 1, 130, 'Pengenalan simbol \"t\"'),
(131, 1, 131, 'Latihan (melengkapi kata)'),
(132, 1, 132, 'Latihan (melengkapi kata)'),
(133, 1, 133, 'Latihan (melengkapi kata)'),
(134, 1, 134, 'Membaca kata'),
(135, 1, 135, 'Pengenalan bunyi \"va…vo\"'),
(136, 1, 136, 'Pengenalan simbol \"v\"'),
(137, 1, 137, 'Pengenalan bunyi \"wa…wo\"'),
(138, 1, 138, 'Pengenalan simbol \"w\"'),
(139, 1, 139, 'Latihan (melengkapi kata)'),
(140, 1, 140, 'Membaca kata'),
(141, 1, 141, 'Pengenalan simbol \"x\"'),
(142, 1, 142, 'Review (membaca ta..to - wa..wo)'),
(143, 1, 143, 'Latihan (mencari kata)'),
(144, 1, 144, 'Pengenalan bunyi \"ya…yo\"'),
(145, 1, 145, 'Pengenalan simbol \"y\"'),
(146, 1, 146, 'Latihan (melengkapi kata)'),
(147, 1, 147, 'Pengenalan simbol \"z\"'),
(148, 1, 148, 'Review (membaca xa..xo - za..zo)'),
(149, 1, 149, 'Latihan (melengkapi kata)'),
(150, 1, 150, 'Radiant (membaca dan melengkapi kata \"pepaya\")'),
(151, 1, 151, 'Latihan (menulis kata sesuai gambar)'),
(152, 1, 152, 'Latihan (menulis kata sesuai gambar)'),
(153, 1, 153, 'Latihan (menulis kata sesuai gambar)'),
(154, 1, 154, 'Latihan (menulis kata sesuai gambar)'),
(155, 1, 155, 'Latihan (menulis kata sesuai gambar)'),
(156, 1, 156, 'Latihan (menulis kata sesuai gambar)'),
(157, 1, 157, 'Latihan (menulis kata sesuai gambar)'),
(158, 1, 158, 'Latihan (menulis kata sesuai gambar)'),
(159, 1, 159, 'Radiant (membaca dan melengkapi kata \"gorila\")'),
(160, 1, 160, 'Radiant (membaca dan melengkapi kata \"matematika\")'),
(161, 1, 161, 'Membaca kalimat'),
(162, 1, 162, 'Membaca kalimat'),
(163, 2, 1, 'Pengenalan bunyi akhiran \"m\"'),
(164, 2, 2, 'Membaca akhiran m (bam…bom-lam…lom)'),
(165, 2, 3, 'Membaca akhiran m (mam…mom-zam…zom)'),
(166, 2, 4, 'Latihan (melengkapi kata akhiran \"m\")'),
(167, 2, 5, 'Latihan (melengkapi kata akhiran \"m\")'),
(168, 2, 6, 'Radiant (membaca dan melengkapi kata \"Hakam\")'),
(169, 2, 7, 'Pengenalan bunyi akhiran \"n\"'),
(170, 2, 8, 'Membaca akhiran m (ban…bon-lan…lon)'),
(171, 2, 9, 'Membaca akhiran m (man…mon-zan…zon)'),
(172, 2, 10, 'Latihan (melengkapi kata akhiran \"n\")'),
(173, 2, 11, 'Latihan (melengkapi kata akhiran \"n\")'),
(174, 2, 12, 'Radiant (membaca dan melengkapi kata \"Panda\")'),
(175, 2, 13, 'Pengenalan bunyi akhiran \"p\"'),
(176, 2, 14, 'Membaca akhiran m (bap…bop-lap…lop)'),
(177, 2, 15, 'Membaca akhiran m (map…mop-zap…zop)'),
(178, 2, 16, 'Latihan (melengkapi kata akhiran \"p\")'),
(179, 2, 17, 'Radiant (membaca dan melengkapi kata \"hari masih……..\")'),
(180, 2, 18, 'Pengenalan bunyi akhiran \"l\"'),
(181, 2, 19, 'Membaca akhiran m (bal…bol-lal…lol)'),
(182, 2, 20, 'Membaca akhiran m (mal…mol-zal…zol)'),
(183, 2, 21, 'Latihan (melengkapi kata akhiran \"l\")'),
(184, 2, 22, 'Pengenalan bunyi akhiran \"s\"'),
(185, 2, 23, 'Membaca akhiran m (bas…bos-las…los)'),
(186, 2, 24, 'Membaca akhiran m (mas…mos-zas…zos)'),
(187, 2, 25, 'Latihan (melengkapi kata akhiran \"s\")'),
(188, 2, 26, 'Latihan (melengkapi kata akhiran \"s\")'),
(189, 2, 27, 'Radiant (membaca dan melengkapi kata \"Kastil adalah……..\")'),
(190, 2, 28, 'Pengenalan bunyi akhiran \"t\"'),
(191, 2, 29, 'Membaca akhiran m (bat…bot-lat…lot)'),
(192, 2, 30, 'Membaca akhiran m (mat…mot-zat…zot)'),
(193, 2, 31, 'Latihan (melengkapi kata akhiran \"t\")'),
(194, 2, 32, 'Latihan (melengkapi kata akhiran \"t\")'),
(195, 2, 33, 'Pengenalan bunyi akhiran \"k\"'),
(196, 2, 34, 'Membaca akhiran m (bak…bok-lak…lok)'),
(197, 2, 35, 'Membaca akhiran m (mak…mok-zak…zok)'),
(198, 2, 36, 'Latihan (melengkapi kata akhiran \"k\")'),
(199, 2, 37, 'Latihan (melengkapi kata akhiran \"k\")'),
(200, 2, 38, 'Membaca kata'),
(201, 2, 39, 'Pengenalan bunyi akhiran \"r\"'),
(202, 2, 40, 'Membaca akhiran m (bar…bor-lar…lor)'),
(203, 2, 41, 'Membaca akhiran m (mar…mor-zar…zor)'),
(204, 2, 42, 'Latihan (melengkapi kata akhiran \"r\")'),
(205, 2, 43, 'Latihan (melengkapi kata akhiran \"r\")'),
(206, 2, 44, 'Membaca & melengkapi kata (Bacaan \"Siput\")'),
(207, 2, 45, 'Pengenalan bunyi akhiran \"h\"'),
(208, 2, 46, 'Membaca akhiran m (bah…boh-lah…loh)'),
(209, 2, 47, 'Membaca akhiran m (mah…moh-zah…zoh)'),
(210, 2, 48, 'Latihan (melengkapi kata akhiran \"h\")'),
(211, 2, 49, 'Latihan (melengkapi kata akhiran \"h\")'),
(212, 2, 50, 'Pengenalan bunyi \"nga…ngo\" dan simbolnya'),
(213, 2, 51, 'Latihan (melengkapi kata \"nga..ngo\")'),
(214, 2, 52, 'Pengenalan bunyi akhiran \"ng\"'),
(215, 2, 53, 'Membaca akhiran m (bang…bong-lang…long)'),
(216, 2, 54, 'Membaca akhiran m (mang…mong-zang…zong)'),
(217, 2, 55, 'Latihan (melengkapi kata akhiran \"ng\")'),
(218, 2, 56, 'Latihan (melengkapi kata akhiran \"ng\")'),
(219, 2, 57, 'Latihan (melengkapi kata akhiran \"ng\")'),
(220, 2, 58, 'Membaca kata '),
(221, 2, 59, 'Radiant (membaca dan melengkapi kata \"aku senang…….\")'),
(222, 2, 60, 'Pengenalan bunyi \"nya…nyo\" dan simbolnya'),
(223, 2, 61, 'Latihan (melengkapi kata \"nya..nyo\")'),
(224, 2, 62, 'Radiant (membaca dan melengkapi kata \"ada seorang penyihir…….\")'),
(225, 2, 63, 'Membaca kata'),
(226, 2, 64, 'Radiant (membaca dan melengkapi kata \"kalkulator alat…….\")'),
(227, 2, 65, 'Radiant (membaca dan melengkapi kata \"kita harus mandi\")'),
(228, 2, 66, 'Radiant (membaca dan melengkapi kata \"di teras rumahku\")'),
(229, 2, 67, 'Menulis kata sesuai gambar'),
(230, 2, 68, 'Menulis kata sesuai gambar'),
(231, 3, 1, 'Pengenalan bunyi & dan simbol (materi double vocal ai…ao-oa…oe)'),
(232, 3, 2, 'Membaca suku kata mengandung double vocal(bai, tau……..nio, lae)'),
(233, 3, 3, 'Latihan (tarik garis materi double vocal)'),
(234, 3, 4, 'Latihan (tarik garis materi double vocal)'),
(235, 3, 5, 'Membaca kata'),
(236, 3, 6, 'Membaca kalimat'),
(237, 3, 7, 'Menulis kata (materi double vocal)'),
(238, 3, 8, 'Menulis kata (materi double vocal)'),
(239, 3, 9, 'Menulis kata (materi double vocal)'),
(240, 3, 10, 'Materi double konsonan \"bl\" (membaca bla…blo-zla…zlo)'),
(241, 3, 11, 'Mencari kata mengandung double konsonan'),
(242, 3, 12, 'Radiant (membaca dan melengkapi kata \"mas paijo\")'),
(243, 3, 13, 'Materi double konsonan \"br\" (membaca bra…bro-zra…zro)'),
(244, 3, 14, 'Radiant (membaca \"Indonesia\")'),
(245, 3, 15, 'Radiant (melengkapi kata \"Indonesia\")'),
(246, 3, 16, 'Membaca dan melengkapi bacaan (Zulkarnain pemuda…..)'),
(247, 3, 17, 'Membaca dan melengkapi bacaan (hari masih pagi)'),
(248, 3, 18, 'Membaca dan melengkapi bacaan (bapak Prasetyo……...)'),
(249, 3, 19, 'Materi double konsonan \"sh, sk, kh, st, sp, sw, sy & str\" (membaca suku kata & kata)'),
(250, 3, 20, 'Membaca dan melengkapi bacaan (Reihan seorang……...)'),
(251, 3, 21, 'Membaca kalimat'),
(252, 3, 22, 'Membaca kata'),
(253, 3, 23, 'Menulis kata sesuai gambar'),
(254, 3, 24, 'Menulis kata sesuai gambar'),
(255, 3, 25, 'Menulis kata sesuai gambar'),
(256, 4, 1, 'Bonding (membentuk ikatan melatih kreatifitas anak)'),
(257, 4, 2, 'Motorik 1'),
(258, 4, 3, 'Konsep bilangan 1'),
(259, 4, 4, 'Konsep bilangan 1 dengan jari'),
(260, 4, 5, 'Konsep bilangan 2'),
(261, 4, 6, 'Konsep bilangan 2 dengan jari'),
(262, 4, 7, 'Motorik 2'),
(263, 4, 8, 'Konsep bilangan 3'),
(264, 4, 9, 'Konsep bilangan 3 dengan jari'),
(265, 4, 10, 'Latihan 1 bilangan 1-3'),
(266, 4, 11, 'Latihan 2 bilangan 1-3'),
(267, 4, 12, 'Latihan 3 bilangan 1-3'),
(268, 4, 13, 'Motorik 3'),
(269, 4, 14, 'Konsep bilangan 4'),
(270, 4, 15, 'Konsep bilangan 4 dengan jari'),
(271, 4, 16, 'Motorik 4'),
(272, 4, 17, 'Konsep bilangan 5'),
(273, 4, 18, 'Konsep bilangan 5 dengan jari'),
(274, 4, 19, 'Review konsep bilangan 1-5'),
(275, 4, 20, 'Latihan bilangan 1-5'),
(276, 4, 21, 'Motorik 5'),
(277, 4, 22, 'Latihan 1 bilangan 1-5'),
(278, 4, 23, 'Latihan 2 bilangan 1-5'),
(279, 4, 24, 'Latihan 3 bilangan 1-5'),
(280, 4, 25, 'Motorik 6'),
(281, 4, 26, 'Latihan 4 bilangan 1-5'),
(282, 4, 27, 'Latihan 5 bilangan 1-5'),
(283, 4, 28, 'Konsep persamaan 1, Latihan 1  persamaan 1'),
(284, 4, 29, 'Latihan 6 bilangan 1-5, Latihan 7 bilangan 1-5'),
(285, 4, 30, 'Konsep bilangan 6'),
(286, 4, 31, 'Konsep bilangan 6 dengan jari'),
(287, 4, 32, 'Konsep bilangan 7'),
(288, 4, 33, 'Latihan 1 bilangan 5-7'),
(289, 4, 34, 'Latihan 2 bilangan 5-7'),
(290, 4, 35, 'Mencari perbedaan gambar, Latihan 3 bilangan 5-7'),
(291, 4, 36, 'Konsep bilangan 8'),
(292, 4, 37, 'Konsep bilangan 9'),
(293, 4, 38, 'Latihan 4 bilangan 5-7'),
(294, 4, 39, 'Konsep bilangan 10'),
(295, 4, 40, 'Latihan 1 bilangan 1-10'),
(296, 4, 41, 'Latihan 2 bilangan 1-10'),
(297, 4, 42, 'Motorik 7'),
(298, 4, 52, 'Latihan 8 bilangan 1-10'),
(299, 4, 53, 'Latihan 1 identifikasi & motorik mata'),
(300, 4, 54, 'Latihan 9 bilangan 1-10'),
(301, 4, 55, 'Latihan 10 bilangan 1-10, Latihan 4  persamaan 1'),
(302, 4, 56, 'Latihan 2 identifikasi & motorik mata'),
(303, 4, 57, 'Latihan 11 bilangan 1-10, Latihan 5  persamaan 1'),
(304, 4, 58, 'Pola 1, Latihan 12 bilangan 1-10'),
(305, 4, 59, 'Latihan 13 bilangan 1-10'),
(306, 4, 60, 'Pola 2, Latihan 14 bilangan 1-10'),
(307, 4, 61, 'Latihan 15 bilangan 1-10'),
(308, 4, 62, 'Konsep teman kecil'),
(309, 4, 63, 'Latihan 1 teman kecil, Latihan 16 bilangan 1-10'),
(310, 4, 64, 'Latihan 2 teman kecil, Latihan 6  persamaan 1'),
(311, 4, 65, 'Mencari perbedaan gambar'),
(312, 4, 43, 'Review konsep bilangan 6-10'),
(313, 4, 44, 'Latihan 3 bilangan 1-10'),
(314, 4, 45, 'Konsep urutan bilangan 1-10'),
(315, 4, 46, 'Latihan 4 bilangan 1-10, Latihan 5 bilangan 1-10, Urutan bilangan dengan gambar'),
(316, 4, 47, 'Konsep bangun dan warna'),
(317, 4, 48, 'Latihan 1 urutan bilangan 1-10'),
(318, 4, 49, 'Latihan 2 urutan bilangan 1-10'),
(319, 4, 50, 'Latihan 6 bilangan 1-10, Latihan 2  persamaan 1'),
(320, 4, 51, 'Latihan 7 bilangan 1-10, Latihan 3  persamaan 1'),
(321, 4, 66, 'Latihan 3 teman kecil, Latihan 3 identifikasi & motorik mata'),
(322, 4, 68, 'Latihan 4 teman kecil'),
(323, 4, 69, 'Motorik 8'),
(324, 4, 70, 'Latihan 5 teman kecil'),
(325, 4, 71, 'Latihan 7  persamaan 1'),
(326, 4, 72, 'Latihan 6 teman kecil'),
(327, 4, 73, 'Latihan 8  persamaan 1'),
(328, 4, 74, 'Konsep teman besar'),
(329, 4, 75, 'Latihan 1 teman besar'),
(330, 4, 76, 'Motorik 9'),
(331, 4, 77, 'Latihan 2 teman besar'),
(332, 4, 78, 'Latihan 3 teman besar'),
(333, 4, 79, 'Latihan 4 teman besar'),
(334, 4, 80, 'Latihan 5 teman besar'),
(335, 4, 81, 'Latihan 4 identifikasi & motorik mata'),
(336, 4, 82, 'Latihan 6 teman besar'),
(337, 4, 83, 'Konsep bangun dan warna'),
(338, 4, 84, 'Konsep sama dan tidak sama'),
(339, 4, 85, 'Latihan 1 konsep tidak sama'),
(340, 4, 86, 'Latihan 2 konsep tidak sama'),
(341, 4, 87, 'Latihan 1 konsep sama'),
(342, 4, 88, 'Latihan 1 konsep tidak sama'),
(343, 4, 89, 'Latihan 2 konsep tidak sama'),
(344, 4, 90, 'Konsep penjumlahan 1 '),
(345, 4, 91, 'Konsep pengurangan 1 '),
(346, 4, 92, 'Konsep penjumlahan 2'),
(347, 4, 93, 'Konsep pengurangan 2'),
(348, 4, 94, 'Latihan penjumlahan pengurangan secara realistik'),
(349, 4, 95, 'Konsep penjumlahan 3'),
(350, 4, 96, 'Konsep pengurangan 3'),
(351, 4, 97, 'Latihan penjumlahan pengurangan secara realistik'),
(352, 4, 98, 'Konsep benda yang bertambah atau berkurang, Pengenalan simbol penjumlahan dan pengurangan'),
(353, 4, 99, 'Latihan 1 penjumlahan dan pengurangan'),
(354, 4, 100, 'Latihan 3 konsep tidak sama'),
(355, 4, 101, 'Latihan 4 konsep tidak sama'),
(356, 4, 102, 'Latihan 2 penjumlahan dan pengurangan'),
(357, 4, 103, 'Geometri 1'),
(358, 4, 104, 'Geometri 1'),
(359, 4, 105, 'Latihan 7 teman besar'),
(360, 4, 106, 'Latihan 2 konsep sama'),
(361, 4, 107, 'Latihan 5 konsep tidak sama'),
(362, 4, 108, 'Latihan 6 konsep tidak sama'),
(363, 4, 109, 'Latihan 7 konsep tidak sama'),
(364, 4, 110, 'Latihan 8 konsep tidak sama'),
(365, 4, 111, 'Geometri 2'),
(366, 4, 112, 'Geometri 2'),
(367, 4, 113, 'Latihan 1 penjumlahan 1-10 (o+oo=ooo)'),
(368, 4, 114, 'Latihan 2 penjumlahan 1-10 (o+oo=ooo)'),
(369, 4, 115, 'Mencari perbedaan gambar, Latihan 1 penjumlahan 1-10 (o+oo=….)'),
(370, 4, 116, 'Latihan 8 teman besar, Latihan 2 penjumlahan 1-10 (o+oo=….)'),
(371, 4, 117, 'Latihan 3 penjumlahan 1-10 (o+oo=….)'),
(372, 4, 118, 'Latihan 1 variasi angka pembentuk jumlah 4 dan 5'),
(373, 4, 119, 'Konsep bangun dan warna'),
(374, 4, 120, 'Latihan 1 pengurangan 1-10 (ooo-o=oo)'),
(375, 4, 121, 'Latihan 2 pengurangan 1-10 (ooo-o=oo)'),
(376, 4, 122, 'Latihan 3 pengurangan 1-10 (ooo-o=oo)'),
(377, 4, 123, 'Latihan variasi angka pembentuk jumlah 6 dan 7'),
(378, 4, 124, 'Latihan 4 penjumlahan 1-10 (o+oo=….)'),
(379, 4, 125, 'Motorik 10'),
(380, 4, 126, 'Latihan 4 pengurangan 1-10 (ooo-o=…..)'),
(381, 4, 127, 'Latihan 4 penjumlahan 1-10 (o+oo=….)'),
(382, 4, 128, 'Latihan 5 identifikasi & motorik mata'),
(383, 4, 129, 'Latihan 5 pengurangan 1-10 (ooo-o=…..)'),
(384, 4, 130, 'Latihan 5 penjumlahan 1-10 (o+oo=….)'),
(385, 4, 131, 'Motorik 11, Latihan 6 pengurangan 1-10 (ooo-o=…..)'),
(386, 4, 132, 'Latihan 6 penjumlahan 1-10 (o+oo=….)'),
(387, 4, 133, 'Latihan 9 teman besar'),
(388, 4, 134, 'Latihan 7 pengurangan 1-10 (ooo-o=…..)'),
(389, 4, 135, 'Latihan 2 variasi angka pembentuk jumlah 7 dan 8'),
(390, 4, 136, 'Latihan 7 penjumlahan 1-10 (o+oo=….)'),
(391, 4, 137, 'Latihan 9  persamaan 2'),
(392, 4, 138, 'Latihan 8 penjumlahan 1-10 (o+oo=….)'),
(393, 4, 139, 'Latihan 8 pengurangan 1-10 (ooo-o=…..)'),
(394, 4, 140, 'Latihan 3 variasi angka pembentuk jumlah 6 dan 10'),
(395, 4, 141, 'Konsep soal cerita'),
(396, 4, 142, 'Latihan 1 soal cerita 1-10  (o+oo=….)'),
(397, 4, 143, 'Latihan 6 identifikasi & motorik mata'),
(398, 4, 144, 'Latihan 2 soal cerita 1-10 (o+oo=…/ooo-o=….)'),
(399, 4, 145, 'Latihan 1a klasifikasi'),
(400, 4, 146, 'Latihan 1b klasifikasi'),
(401, 4, 147, 'Latihan 3 soal cerita 1-10  (o+oo=…/ooo-o=….), Latihan 10  persamaan 2'),
(402, 4, 148, 'Latihan 4 soal cerita 1-10  (o+oo=…), Latihan 11  persamaan 2'),
(403, 4, 149, 'Latihan 5 soal cerita 1-10  (o+oo=…./ooo-o=….), Latihan 12  persamaan 2'),
(404, 4, 150, 'Latihan 2a klasifikasi'),
(405, 4, 151, 'Latihan 2b klasifikasi'),
(406, 4, 152, 'Latihan 5 soal cerita 1-10  (o+oo-o=…./ooo-o=….), Mencari perbedaan gambar'),
(407, 4, 153, 'Latihan 6 soal cerita 1-10  (o+oo=…)'),
(408, 4, 154, 'Latihan 7 soal cerita 1-10  (o+oo=…/ooo-o=….)'),
(409, 4, 155, 'Latihan 8 soal cerita 1-10  (o+oo=….)'),
(410, 4, 156, 'Konsep 2 Penjumlahan (oo+…=ooo)'),
(411, 4, 157, 'Latihan 1 penjumlahan (oo+….=ooo)'),
(412, 4, 158, 'Latihan 2 penjumlahan (oo+….=ooo)'),
(413, 4, 159, 'Latihan 12  persamaan 2'),
(414, 4, 160, 'Latihan 3 penjumlahan (oo+….=ooo)'),
(415, 4, 161, 'Latihan 1 pengulangan (ooo-….=o)'),
(416, 4, 162, 'Latihan 9 soal cerita 1-10  (o+….=ooo)'),
(417, 4, 163, 'Latihan 4 penjumlahan (oo+….=ooo)'),
(418, 4, 164, 'Latihan 2 pengulangan (ooo-….=o)'),
(419, 4, 165, 'Latihan 13  persamaan 2'),
(420, 4, 166, 'Latihan 10 soal cerita 1-10  (ooo-…=o)'),
(421, 4, 167, 'Latihan 3 pengulangan (ooo-….=o)'),
(422, 4, 168, 'Latihan 3a klasifikasi'),
(423, 4, 169, 'Latihan 3b klasifikasi'),
(424, 4, 170, 'Latihan 11 soal cerita 1-10  (…+oo=ooo)'),
(425, 4, 171, 'Latihan 4 pengulangan (ooo-….=o)'),
(426, 4, 172, 'Latihan 12 soal cerita 1-10  (…-oo=o)'),
(427, 4, 173, 'Latihan 13 soal cerita 1-10  (…+oo=ooo)'),
(428, 4, 174, 'Pola 8'),
(429, 4, 175, 'Latihan 1 penjumlahan (….+o=ooo)'),
(430, 4, 176, 'Latihan 2 penjumlahan (….+o=ooo)'),
(431, 4, 177, 'Latihan 14  persamaan 2'),
(432, 4, 178, 'Latihan 1 pengurangan (….-oo=o)'),
(433, 4, 179, 'Pola 9'),
(434, 4, 180, 'Latihan 3 penjumlahan (….+o=ooo)'),
(435, 4, 181, 'Latihan 2 pengurangan (….-oo=o)'),
(436, 4, 182, 'Geometri 2'),
(437, 4, 183, 'Geometri 2'),
(438, 4, 184, 'Latihan 4 penjumlahan (….+o=ooo)'),
(439, 4, 185, 'Latihan 3 pengurangan (….-oo=o)'),
(440, 4, 186, 'Latihan 14 soal cerita 1-10  (…+oo=ooo)'),
(441, 4, 187, 'Latihan 4 pengurangan (….-oo=o)'),
(442, 4, 188, 'Latihan 15 soal cerita 1-10  (ooo-….=o)'),
(443, 4, 189, 'Latihan 4a klasifikasi'),
(444, 4, 190, 'Latihan 4b klasifikasi'),
(445, 4, 191, 'Latihan 5 pengurangan (….-oo=o)'),
(446, 4, 192, 'Pola 9'),
(447, 4, 193, 'Latihan 16 soal cerita 1-10  (ooo-….=o)'),
(448, 4, 194, 'Motorik 11'),
(449, 5, 1, 'Konsep bilangan 11'),
(450, 5, 2, 'Konsep bilangan 12'),
(451, 5, 3, 'Konsep bilangan 13'),
(452, 5, 4, 'Pola 10, Latihan 1 bilangan 11-13'),
(453, 5, 5, 'Latihan 2 bilangan 11-13, Motorik 12'),
(454, 5, 6, 'Konsep bilangan 14'),
(455, 5, 7, 'Konsep bilangan 15'),
(456, 5, 8, 'Pola 11, Latihan 1 variasi angka pembentuk jumlah 10'),
(457, 5, 9, 'Latihan 2 bilangan 11-15'),
(458, 5, 10, 'Motorik 13'),
(459, 5, 11, 'Latihan 3 bilangan 11-15'),
(460, 5, 12, 'Pola 12, Latihan 2 variasi angka pembentuk jumlah 10'),
(461, 5, 13, 'Mencari perbedaan gambar, Latihan variasi angka pembentuk jumlah 12'),
(462, 5, 14, 'Latihan 5 bilangan 11-15'),
(463, 5, 15, 'Latihan persepsi gambar, Latihan 6 bilangan 11-15'),
(464, 5, 17, 'Geometri 3b'),
(465, 5, 18, 'Geometri 3c'),
(466, 5, 19, 'Konsep bilangan 16, Konsep bilangan 17'),
(467, 5, 20, 'Latihan 1 bilangan 11-17, Motorik 14'),
(468, 5, 21, 'Latihan 7 identifikasi & motorik mata'),
(469, 5, 22, 'Konsep bilangan 18, Konsep bilangan 19'),
(470, 5, 23, 'Latihan 5 klasifikasi'),
(471, 5, 24, 'Konsep bilangan 20'),
(472, 5, 25, 'Latihan  1 bilangan 11-20'),
(473, 5, 26, 'Pola 13, Latihan 2 bilangan 11-20'),
(474, 5, 27, 'Pola 14, Latihan 3 bilangan 11-20'),
(475, 5, 28, 'Latihan 4 bilangan 11-20'),
(476, 5, 29, 'Latihan 1 urutan bilangan 11-20'),
(477, 5, 30, 'Latihan 6 klasifikasi'),
(478, 5, 31, 'Latihan  5 bilangan 11-20, Urutan bilangan dengan gambar'),
(479, 5, 32, 'Latihan  6 bilangan 11-20, Pola 15'),
(480, 5, 33, 'Latihan  7 bilangan 11-20'),
(481, 5, 34, 'Latihan 1 penjumlahan 11-20 (o+oo=ooo/o+oo=…/o+…=ooo)'),
(482, 5, 35, 'Latihan 2 penjumlahan 11-20 (o+oo=ooo/o+oo=…/o+…=ooo)'),
(483, 5, 36, 'Latihan 3 penjumlahan 11-20 (o+oo=…), Matriks 3 x 3'),
(484, 5, 37, 'Latihan 4 penjumlahan 11-20 (o+oo=…), Matriks 3 x 3'),
(485, 5, 38, 'Latihan 4 penjumlahan 11-20 (+/-)'),
(486, 5, 39, 'Latihan 5 penjumlahan 11-20 (+/-), Pola 16'),
(487, 5, 40, 'Konsep kelompok sepuluh dalam bentuk simbol'),
(488, 5, 41, 'Konsep & latihan 1 kelompok sepuluh dalam bentuk simbol'),
(489, 5, 42, 'Konsep & latihan 2 kelompok sepuluh dalam bentuk simbol'),
(490, 5, 43, 'Konsep & latihan 3 kelompok sepuluh dalam bentuk simbol'),
(491, 5, 44, 'Motorik 15'),
(492, 5, 45, 'latihan 4 kelompok sepuluh dalam bentuk simbol'),
(493, 5, 46, 'latihan 5 kelompok sepuluh dalam bentuk simbol'),
(494, 5, 47, 'Geometri 4, Latihan 1  persamaan 3'),
(495, 5, 49, 'latihan 6 kelompok sepuluh dalam bentuk simbol'),
(496, 5, 50, 'Urutan bilangan dengan gambar, Latihan 2  persamaan 3'),
(497, 5, 51, 'Review konsep bilangan 11-15'),
(498, 5, 52, 'Matriks 3 x 3, Review konsep bilangan 16-17'),
(499, 5, 53, 'Urutan bilangan dengan gambar, Review konsep bilangan 18-20'),
(500, 5, 54, 'Motorik 16'),
(501, 5, 55, 'Review bilangan 20-50 dalam konsep simbol 10'),
(502, 5, 56, 'Motorik 17, Pola 17'),
(503, 5, 57, 'Konsep penjumlahan dengan simbol 10, Latihan 1 penjumlahan dengan simbol 10'),
(504, 5, 58, 'Latihan 2 penjumlahan dengan simbol 10'),
(505, 5, 59, 'Latihan 3 penjumlahan dengan simbol 10, Matriks 3 x 3'),
(506, 5, 60, 'Latihan 4 penjumlahan dengan simbol 10, Pola 18'),
(507, 5, 61, 'Latihan 5 penjumlahan dengan simbol 10, Pola 19'),
(508, 5, 62, 'Review penjumlahan dengan simbol 10'),
(509, 5, 63, 'lathan 6 penjumlahan dengan simbol 10'),
(510, 5, 64, 'Motorik 17'),
(511, 5, 65, 'lathan 7 penjumlahan dengan simbol 10'),
(512, 5, 66, 'Pola 20, Motorik 18'),
(513, 5, 67, 'lathan 8 penjumlahan dengan simbol 10'),
(514, 5, 68, 'Latihan 1 variasi angka pembentuk jumlah 15'),
(515, 5, 69, 'lathan 9 penjumlahan dengan simbol 10'),
(516, 5, 70, 'Latihan 3 konsep sama'),
(517, 5, 71, 'Latihan 7 klasifikasi'),
(518, 5, 72, 'Latihan 9 konsep tidak sama'),
(519, 5, 73, 'Latihan 10 konsep tidak sama'),
(520, 5, 74, 'Latihan 11 konsep tidak sama, Geometri 5'),
(521, 5, 75, 'Latihan 12 konsep tidak sama, Matriks 3 x 3'),
(522, 5, 76, 'Latihan 6 penjumlahan 11-20 (+/-)'),
(523, 5, 77, 'Latihan 7 penjumlahan 11-20 (+/-)'),
(524, 5, 78, 'Geometri 6, Matriks 3 x 3'),
(525, 5, 79, 'Latihan 7 penjumlahan 11-20 (+/-)'),
(526, 5, 80, 'Latihan penjumlahan 15-20 '),
(527, 5, 81, 'Matriks 3 x 3, Latihan 13 konsep tidak sama'),
(528, 5, 82, 'Latihan 16 soal cerita 11-20  (+) & (-)'),
(529, 5, 83, 'Latihan 17 soal cerita 11-20  (+) & (-), Latihan 14 konsep tidak sama'),
(530, 5, 84, 'Latihan 18 soal cerita 11-20  (+) & (-), Latihan 15 konsep tidak sama'),
(531, 5, 85, 'Latihan 19 soal cerita 11-20  (+) & (-)'),
(532, 5, 86, 'Latihan 16 konsep tidak sama'),
(533, 5, 87, 'Latihan 2 identifikasi & motorik mata'),
(534, 5, 88, 'Latihan 17 konsep tidak sama, Mencari perbedaan gambar'),
(535, 5, 89, 'Latihan 20 soal cerita 11-20  (+) & (-)'),
(536, 5, 90, 'Konsep pengurangan dengan simbol 10'),
(537, 5, 91, 'Latihan 1 pengurangan dengan simbol 10'),
(538, 5, 92, 'Motorik 19'),
(539, 5, 93, 'Latihan 1 pengurangan dengan simbol 10'),
(540, 5, 94, 'Pola 21, Mencari perbedaan gambar'),
(541, 5, 95, 'Latihan 2 pengurangan dengan simbol 10'),
(542, 5, 96, 'Latihan 20 soal cerita 11-20  (+) & (-), Latihan 3  persamaan 3'),
(543, 5, 97, 'Latihan 21 soal cerita 11-20  (+) & (-), Latihan 4 persamaan 3'),
(544, 5, 98, 'Latihan 22 soal cerita 11-20  (+) & (-), Pola 22'),
(545, 5, 99, 'Latihan 23 soal cerita 11-20  (+) & (-), Mencari perbedaan gambar'),
(546, 5, 100, 'Latihan 24 soal cerita 11-20  (+) & (-), Latihan 5 persamaan 3'),
(547, 5, 101, 'Latihan 25 soal cerita 11-20  (+) & (-), Latihan 6 persamaan 3'),
(548, 5, 102, 'Latihan 26 soal cerita 11-20  (+) & (-), Motorik 17');

-- --------------------------------------------------------

--
-- Table structure for table `migration`
--

CREATE TABLE `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `migration`
--

INSERT INTO `migration` (`version`, `apply_time`) VALUES
('m000000_000000_base', 1501572512),
('m130524_201442_init', 1501572513),
('m170916_055008_tabelcabangs', 1505541517),
('m170916_060315_tabelgurus', 1505542354);

-- --------------------------------------------------------

--
-- Table structure for table `orangtua`
--

CREATE TABLE `orangtua` (
  `idorangtua` int(11) NOT NULL,
  `namaortu` varchar(50) NOT NULL,
  `jeniskelamin` char(1) NOT NULL COMMENT 'L=Lakilaki, P=Perempuan',
  `telepon` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orangtua`
--

INSERT INTO `orangtua` (`idorangtua`, `namaortu`, `jeniskelamin`, `telepon`) VALUES
(14, 'Abdul Ghofur', 'L', '082334093822'),
(15, 'Usrek Wigihono', 'L', '083849317760');

-- --------------------------------------------------------

--
-- Table structure for table `pembayaran`
--

CREATE TABLE `pembayaran` (
  `idpembayaran` int(11) NOT NULL,
  `idsiswabelajar` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `statuspembayaran` varchar(1) NOT NULL DEFAULT 'B' COMMENT 'B=belum lunas, S=sudah lunas'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pembayaran`
--

INSERT INTO `pembayaran` (`idpembayaran`, `idsiswabelajar`, `tanggal`, `statuspembayaran`) VALUES
(190, 85, '2018-05-09', 'S'),
(191, 85, '2018-06-09', 'B'),
(192, 85, '2018-07-09', 'B'),
(193, 85, '2018-08-09', 'B'),
(194, 85, '2018-09-09', 'B'),
(195, 85, '2018-10-09', 'B'),
(196, 85, '2018-11-09', 'B'),
(197, 87, '2018-05-19', 'B'),
(198, 87, '2018-06-19', 'B'),
(199, 87, '2018-07-19', 'B'),
(200, 87, '2018-08-19', 'B'),
(201, 87, '2018-09-19', 'B'),
(202, 87, '2018-10-19', 'B'),
(203, 87, '2018-11-19', 'B'),
(204, 86, '2018-05-10', 'B'),
(205, 86, '2018-06-10', 'B'),
(206, 86, '2018-07-10', 'B'),
(207, 86, '2018-08-10', 'B'),
(208, 86, '2018-09-10', 'B'),
(209, 86, '2018-10-10', 'B'),
(210, 86, '2018-11-10', 'B'),
(211, 86, '2018-12-10', 'B'),
(212, 88, '2018-05-23', 'B'),
(213, 88, '2018-06-23', 'B'),
(214, 88, '2018-07-23', 'B'),
(215, 88, '2018-08-23', 'B'),
(216, 88, '2018-09-23', 'B'),
(217, 88, '2018-10-23', 'B'),
(218, 88, '2018-11-23', 'B'),
(219, 88, '2018-12-23', 'B'),
(220, 89, '2018-05-18', 'B'),
(221, 89, '2018-06-18', 'B'),
(222, 89, '2018-07-18', 'B'),
(223, 89, '2018-08-18', 'B'),
(224, 89, '2018-09-18', 'B'),
(225, 89, '2018-10-18', 'B'),
(226, 89, '2018-11-18', 'B');

-- --------------------------------------------------------

--
-- Table structure for table `program`
--

CREATE TABLE `program` (
  `idprogram` int(11) NOT NULL,
  `namaprogram` varchar(50) NOT NULL,
  `fasilitas` varchar(300) NOT NULL,
  `biayadaftar` int(16) NOT NULL,
  `biayakursus` int(16) NOT NULL,
  `biayatambahan` varchar(300) NOT NULL,
  `deskripsi` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `program`
--

INSERT INTO `program` (`idprogram`, `namaprogram`, `fasilitas`, `biayadaftar`, `biayakursus`, `biayatambahan`, `deskripsi`) VALUES
(1, 'Cinta Baca', 'Tas / Kaos B\'Smart, Modul lengkap selama belajar, Sertifikat Kelulusan', 200000, 225000, '-', 'Program membaca, menulis berbasis brain boosting yang disusun secara sistematis dan mudah diikuti. \r\nPenuh dengan gambar dan warna. Memudahkan orang tua memantau kemajuan hasil belajar ananda.\r\nBERGARANSI !!!'),
(2, 'Cinta Matika', 'Tas / Kaos B\'Smart , Modul level 1 - 2 selama belajar , Sertifikat Kelulusan\n', 200000, 225000, 'Modul Level 3 Rp 100.000, *dibayar menjelang kenaikan level 3', 'Program pengembangan kecerdasan visualspasial dan matematis.\r\nMengasah thinking skill, konsep bilangan, operasi hitung (+ - x :) dan soal cerita.\r\nAgar anak menggemari matematika dan siap belajar matematika tingkat lanjut. \r\nModul disusun secara sistematis, bergambar dan berwarna.');

-- --------------------------------------------------------

--
-- Table structure for table `programlevel`
--

CREATE TABLE `programlevel` (
  `idprogramlevel` int(11) NOT NULL,
  `idprogram` int(11) NOT NULL,
  `level` varchar(10) NOT NULL,
  `jmlpertemuan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `programlevel`
--

INSERT INTO `programlevel` (`idprogramlevel`, `idprogram`, `level`, `jmlpertemuan`) VALUES
(1, 1, '1', 56),
(2, 1, '2', 20),
(3, 1, '3', 11),
(4, 2, '1', 63),
(5, 2, '2', 30);

-- --------------------------------------------------------

--
-- Table structure for table `rapotbelajar`
--

CREATE TABLE `rapotbelajar` (
  `idrapotbelajar` int(11) NOT NULL,
  `idgenerate` int(10) NOT NULL,
  `idguru` int(10) NOT NULL,
  `tanggal` datetime NOT NULL,
  `pertemuanke` int(20) NOT NULL,
  `materi` varchar(500) NOT NULL,
  `halamanketercapaian` int(11) NOT NULL,
  `hasil` varchar(500) NOT NULL,
  `catatanguru` varchar(500) NOT NULL,
  `rewardhasil` varchar(10) NOT NULL,
  `rewardsikap` varchar(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rapotbelajar`
--

INSERT INTO `rapotbelajar` (`idrapotbelajar`, `idgenerate`, `idguru`, `tanggal`, `pertemuanke`, `materi`, `halamanketercapaian`, `hasil`, `catatanguru`, `rewardhasil`, `rewardsikap`) VALUES
(68, 2318, 1, '2018-05-23 16:17:21', 7, 'Pengenalan bunyi & mencari letak bunyi \"ba..bu\"', 25, 'baik', 'belajar terus', '2', '2'),
(69, 2346, 1, '2018-05-23 16:25:45', 8, 'Mencari letak bunyi \"be..bo\" & simbol \"b\', motorik \"ba…bo\"', 28, 'baik deh', 'duh baik banget', '3', '1'),
(66, 2345, 1, '2018-05-23 15:32:19', 6, 'Motorik & latihan melengkapi kata', 22, 'Keren banget', 'Pinter sekali', '3', '3'),
(59, 2399, 1, '2018-05-22 14:38:28', 1, 'Kreativitas, pengenalan bunyi, mencari letak bunyi & simbol \"a\"', 4, 'ddf', 'fgf', '1', '1'),
(67, 2318, 1, '2018-05-23 16:17:20', 7, 'Pengenalan bunyi & mencari letak bunyi \"ba..bu\"', 25, 'baik', 'belajar terus', '2', '2'),
(58, 2317, 1, '2018-05-22 14:36:36', 5, 'Review, pengenalan bunyi, mencari letak bunyi & simbol \"o\", motorik', 19, 'dshsdha', 'jdfsjdjs', '1', '1'),
(49, 2315, 1, '2018-05-17 10:12:27', 1, 'Kreativitas, pengenalan bunyi, mencari letak bunyi & simbol \"a\"', 5, 'Baik', 'hsaasd', '1', '1'),
(50, 2343, 1, '2018-05-17 10:12:43', 2, 'Review, pengenalan bunyi, mencari letak bunyi & simbol \"i\", motorik', 10, 'Baik', 'fdshhdfs', '2', '3'),
(51, 2316, 1, '2018-05-19 09:37:20', 3, 'Review, pengenalan bunyi, mencari letak bunyi & simbol \"u\", motorik', 12, 'Baik sekali', 'Belajar lagi yang pintar', '2', '3'),
(52, 2316, 1, '2018-05-19 09:38:36', 3, 'Review, pengenalan bunyi, mencari letak bunyi & simbol \"u\", motorik', 12, 'Baik sekali', 'Belajar lagi yang pintar', '2', '3'),
(53, 2316, 2, '2018-05-19 09:40:43', 3, 'Latihan (melingkari angka)', 49, 'Keren', 'Pinter', '3', '3'),
(54, 2316, 1, '2018-05-19 09:43:34', 3, 'Review, pengenalan bunyi, mencari letak bunyi & simbol \"u\", motorik', 2, 'Keren', 'Pinter', '3', '3'),
(55, 2344, 1, '2018-05-19 09:46:12', 4, 'Review, pengenalan bunyi, mencari letak bunyi & simbol \"e\"', 16, 'Keren banget', 'Pinter sekali', '3', '3'),
(56, 2399, 1, '2018-05-22 14:35:46', 1, 'Kreativitas, pengenalan bunyi, mencari letak bunyi & simbol \"a\"', 4, 'Baik', 'Belajar lagi membaca', '2', '3'),
(57, 2399, 1, '2018-05-22 14:36:04', 1, 'Kreativitas, pengenalan bunyi, mencari letak bunyi & simbol \"a\"', 4, 'belajar lagi', 'jhsjsadjk', '1', '1'),
(70, 2371, 1, '2018-05-24 09:26:21', 2, 'Review, pengenalan bunyi, mencari letak bunyi & simbol \"i\", motorik', 8, 'baik banget', 'lanjutkan belajarnya', '3', '2'),
(71, 2400, 1, '2018-05-24 10:15:06', 3, 'Review, pengenalan bunyi, mencari letak bunyi & simbol \"u\", motorik', 12, 'Baik banget anaknya', 'Lanjutkan belajarnya', '3', '3');

-- --------------------------------------------------------

--
-- Table structure for table `rapottrial`
--

CREATE TABLE `rapottrial` (
  `idhasiltrial` int(11) NOT NULL,
  `idjadwal` int(11) NOT NULL,
  `soal1` varchar(10) NOT NULL,
  `soal2` varchar(10) NOT NULL,
  `soal3` varchar(10) NOT NULL,
  `soal4` varchar(10) NOT NULL,
  `soal5` varchar(10) NOT NULL,
  `soal6` varchar(10) NOT NULL,
  `soal7` varchar(10) NOT NULL,
  `soal8` varchar(10) NOT NULL,
  `soal9` varchar(10) NOT NULL,
  `soal10` varchar(10) NOT NULL,
  `soal11` varchar(10) NOT NULL,
  `catatan` varchar(300) NOT NULL,
  `tgl` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rapottrial`
--

INSERT INTO `rapottrial` (`idhasiltrial`, `idjadwal`, `soal1`, `soal2`, `soal3`, `soal4`, `soal5`, `soal6`, `soal7`, `soal8`, `soal9`, `soal10`, `soal11`, `catatan`, `tgl`) VALUES
(50, 169, 'Ya', 'Baik', 'Baik', 'Baik', 'Baik', 'Baik', 'Baik', 'Ya', '', '', '', 'kjdfjhad', '2018-05-17 09:47:07'),
(48, 163, 'Ya', 'Ya', 'Ya', 'Baik', 'Baik', 'Baik', 'Baik', 'Baik', 'Baik', 'Tidak', 'Tidak', 'Bagus baik ', '2018-05-17 09:16:37'),
(49, 168, 'Ya', 'Ya', 'Ya', 'Baik', 'Baik', 'Baik', 'Baik', 'Baik', 'Baik', 'Ya', 'Ya', 'jhzdfjzskzdskj', '2018-05-17 09:19:57'),
(46, 161, 'Ya', 'Ya', 'Ya', 'Baik', 'Baik', 'Baik', 'Baik', 'Baik', 'Baik', 'Tidak', 'Tidak', 'Bagus banget', '2018-05-17 09:13:55'),
(47, 162, 'Ya', 'Baik', 'Baik', 'Baik', 'Baik', 'Baik', 'Baik', 'Tidak', '', '', '', 'Bagus sekali', '2018-05-17 09:15:09');

-- --------------------------------------------------------

--
-- Table structure for table `siswa`
--

CREATE TABLE `siswa` (
  `idsiswa` int(11) NOT NULL,
  `idcabang` int(11) NOT NULL,
  `idorangtua` int(11) NOT NULL,
  `namalengkap` varchar(50) NOT NULL,
  `namapanggilan` varchar(15) NOT NULL,
  `alamat` text NOT NULL,
  `tempatlahir` varchar(30) NOT NULL,
  `tgllahir` date NOT NULL,
  `asalsekolah` varchar(30) NOT NULL,
  `kelas` varchar(20) NOT NULL,
  `tgldaftar` date NOT NULL,
  `keterangan` text NOT NULL,
  `statussiswa` varchar(1) NOT NULL DEFAULT 'N' COMMENT 'N=Belum Trial, T=Sudah Daftar Trial, M=Selesai Trial, Y=Siswa Kursus'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `siswa`
--

INSERT INTO `siswa` (`idsiswa`, `idcabang`, `idorangtua`, `namalengkap`, `namapanggilan`, `alamat`, `tempatlahir`, `tgllahir`, `asalsekolah`, `kelas`, `tgldaftar`, `keterangan`, `statussiswa`) VALUES
(62, 1, 15, 'Febianti Mutia Hafit', 'Hafit', 'Jl Kutisari Selatan Gg IV A No 26', 'Surabaya', '2014-02-01', 'TK Dewi', 'TK A', '2018-05-21', 'Pintar mengaji', 'T'),
(61, 1, 15, 'Akbar Yudha Perkasa', 'Yudha', 'Jl Kutisari Selatan Gg IV a No 26', 'Surabaya', '2014-11-14', 'TK Dewi', 'TK A', '2018-05-17', 'memiliki kebutuhan khusus', 'Y'),
(58, 1, 14, 'Dimas Dwi Darmawan', 'Dimas', 'Jl Raya Malang No 90', 'Lumajang', '2013-08-23', 'TK Darma', 'TK B', '2018-05-17', 'Suka berhitung dan hafal perkalian ', 'Y'),
(60, 1, 15, 'Lina Meritha', 'Lina', 'Jl Kutisari Selatan Gg IV a No 26', 'Kediri', '2013-03-31', 'TK Dewi', 'TK B', '2018-05-17', 'tidak memiliki kebutuhan khusus', 'Y'),
(59, 1, 14, 'Wahyu Izzudin', 'Wahyu', 'Jl Raya Malang No 90', 'Lumajang', '2014-12-30', 'TK Darma', 'TK A', '2018-05-17', 'Belum bisa membaca', 'Y'),
(57, 1, 14, 'Ahmad Ardiansyah', 'Ardi', 'Jl Panggung No 67', 'Lumajang', '2013-01-17', 'TK Ar Rahman', 'TK B', '2018-05-17', 'Tidak bisa membaca huruf vokal', 'Y');

-- --------------------------------------------------------

--
-- Table structure for table `siswabelajar`
--

CREATE TABLE `siswabelajar` (
  `idsiswabelajar` int(11) NOT NULL,
  `idsiswa` int(11) NOT NULL,
  `idprogramlevel` int(11) NOT NULL,
  `idcabang` int(11) NOT NULL,
  `tgldaftar` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `siswabelajar`
--

INSERT INTO `siswabelajar` (`idsiswabelajar`, `idsiswa`, `idprogramlevel`, `idcabang`, `tgldaftar`) VALUES
(89, 59, 1, 1, '2018-05-17 09:48:51'),
(88, 60, 4, 1, '2018-05-17 09:47:55'),
(87, 61, 1, 1, '2018-05-17 09:20:17'),
(86, 58, 4, 1, '2018-05-17 09:15:16'),
(85, 57, 1, 1, '2018-05-17 09:14:08');

-- --------------------------------------------------------

--
-- Table structure for table `trial`
--

CREATE TABLE `trial` (
  `idtrial` int(11) NOT NULL,
  `idsiswa` int(11) NOT NULL,
  `idprogram` int(11) NOT NULL,
  `status` varchar(1) NOT NULL DEFAULT 'N' COMMENT 'N=belum trial, K=input nilai trial, Y=lihat hasil trial'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `trial`
--

INSERT INTO `trial` (`idtrial`, `idsiswa`, `idprogram`, `status`) VALUES
(79, 62, 1, 'K'),
(78, 60, 2, 'Y'),
(77, 61, 1, 'Y'),
(76, 59, 1, 'Y'),
(75, 58, 2, 'Y'),
(74, 57, 1, 'Y');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '10',
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `level` int(1) NOT NULL DEFAULT '1' COMMENT '1=admin, 2=kurikulum, 3=guru, 4=ortu, 5=direktur, 6=pimpinan',
  `idguru` int(11) DEFAULT NULL,
  `idorangtua` int(11) DEFAULT NULL,
  `idcabang` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `auth_key`, `password_hash`, `password_reset_token`, `email`, `status`, `created_at`, `updated_at`, `level`, `idguru`, `idorangtua`, `idcabang`) VALUES
(31, 'userdirektur', '64aaBXWpSFiYxg2IYveId4uQyGCo9Zk8', '$2y$13$cHedWAxGtouV.FT2.6nCAu2HBz7dDAmm6SUXT464tQZX3fnh151pe', NULL, 'userdirektur@gmail.com', 10, 1520495749, 1520495749, 5, NULL, NULL, 1),
(38, 'userortu', 'OgbPVtSAsjAU5NIl_tZEMQPAwWtakOOy', '$2y$13$nwDeRuy252GwkUsF5afHWuRyCAFuP3uTqLbaK7ljIDk7SCiAAZjNW', NULL, 'userortu@gmail.com', 10, 1525512926, 1525512926, 4, NULL, 15, 1),
(23, 'useradmin', 'RLEycqAac8bT7bS7rc_FNxJyhQDjP154', '$2y$13$7nYP79RNb1dqPQ3ulGEVG.C7wYnVrsj2EG4TrkfAv2bGOM5jSww/a', NULL, 'useradmin@gmail.com', 10, 1505568757, 1505568757, 1, NULL, NULL, 1),
(28, 'userkurikulum', 'V-O9eRfwU7fcMiPtkKAVI-Q9BjQDmNmp', '$2y$13$GXt20Qdthbt3qlER1UDWL.U0aBGpqTYZdCo/P4HycuOYrE.aXWMz2', NULL, 'userkurikulum@gmail.com', 10, 1520495617, 1520495617, 2, NULL, NULL, 1),
(29, 'userguru', 'CSLMLphbhlzt-3Y9rJLq3qFDhm4Obf-l', '$2y$13$S9OSgOKEEUjOZKknm/lklur/aIDx/4/.qDoPYDuQFu.1Ywz1Wr0qC', NULL, 'userguru@gmail.com', 10, 1520495665, 1520495665, 3, 1, NULL, 1),
(32, 'userpimpinan', '5nkriILi8Gjop3hxHooHXMnzx4DzqW1N', '$2y$13$tb7161XCPgkPs4aN0sFI5OKUBP.YW5YupkTAGGvrIDVdGlZdRqlSK', NULL, 'userpimpinan@gmail.com', 10, 1520495777, 1520495777, 6, NULL, NULL, 1),
(40, 'abdulghofur', '5bNc_dh5tQiEqybzrNMJ4fq01le8JTCP', '$2y$13$V.pzWfstKdvwXikKGDZQnuHHEILKFE7O1cCDxQtxyirlwWZhjwvgO', NULL, 'abdulghofur@gmail.com', 10, 1526539978, 1526539978, 4, NULL, 14, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cabang`
--
ALTER TABLE `cabang`
  ADD PRIMARY KEY (`idcabang`);

--
-- Indexes for table `guru`
--
ALTER TABLE `guru`
  ADD PRIMARY KEY (`idguru`);

--
-- Indexes for table `guruskill`
--
ALTER TABLE `guruskill`
  ADD PRIMARY KEY (`idguruskill`);

--
-- Indexes for table `jadwal`
--
ALTER TABLE `jadwal`
  ADD PRIMARY KEY (`idjadwal`);

--
-- Indexes for table `jadwalgenerate`
--
ALTER TABLE `jadwalgenerate`
  ADD PRIMARY KEY (`idgenerate`);

--
-- Indexes for table `kuisioner`
--
ALTER TABLE `kuisioner`
  ADD PRIMARY KEY (`idkuisioner`);

--
-- Indexes for table `lessonplan`
--
ALTER TABLE `lessonplan`
  ADD PRIMARY KEY (`idlessonplan`);

--
-- Indexes for table `materi`
--
ALTER TABLE `materi`
  ADD PRIMARY KEY (`idmateri`);

--
-- Indexes for table `migration`
--
ALTER TABLE `migration`
  ADD PRIMARY KEY (`version`);

--
-- Indexes for table `orangtua`
--
ALTER TABLE `orangtua`
  ADD PRIMARY KEY (`idorangtua`);

--
-- Indexes for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`idpembayaran`);

--
-- Indexes for table `program`
--
ALTER TABLE `program`
  ADD PRIMARY KEY (`idprogram`);

--
-- Indexes for table `programlevel`
--
ALTER TABLE `programlevel`
  ADD PRIMARY KEY (`idprogramlevel`),
  ADD KEY `id_program` (`idprogram`);

--
-- Indexes for table `rapotbelajar`
--
ALTER TABLE `rapotbelajar`
  ADD PRIMARY KEY (`idrapotbelajar`),
  ADD KEY `id_siswaprogram` (`idgenerate`);

--
-- Indexes for table `rapottrial`
--
ALTER TABLE `rapottrial`
  ADD PRIMARY KEY (`idhasiltrial`),
  ADD KEY `id_trial` (`idjadwal`);

--
-- Indexes for table `siswa`
--
ALTER TABLE `siswa`
  ADD PRIMARY KEY (`idsiswa`);

--
-- Indexes for table `siswabelajar`
--
ALTER TABLE `siswabelajar`
  ADD PRIMARY KEY (`idsiswabelajar`),
  ADD KEY `id_siswa` (`idsiswa`),
  ADD KEY `id_program` (`idprogramlevel`);

--
-- Indexes for table `trial`
--
ALTER TABLE `trial`
  ADD PRIMARY KEY (`idtrial`),
  ADD KEY `id_program` (`idprogram`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_ortu` (`idcabang`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cabang`
--
ALTER TABLE `cabang`
  MODIFY `idcabang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `guru`
--
ALTER TABLE `guru`
  MODIFY `idguru` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `guruskill`
--
ALTER TABLE `guruskill`
  MODIFY `idguruskill` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `jadwal`
--
ALTER TABLE `jadwal`
  MODIFY `idjadwal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=177;

--
-- AUTO_INCREMENT for table `jadwalgenerate`
--
ALTER TABLE `jadwalgenerate`
  MODIFY `idgenerate` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2611;

--
-- AUTO_INCREMENT for table `kuisioner`
--
ALTER TABLE `kuisioner`
  MODIFY `idkuisioner` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=409;

--
-- AUTO_INCREMENT for table `lessonplan`
--
ALTER TABLE `lessonplan`
  MODIFY `idlessonplan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=181;

--
-- AUTO_INCREMENT for table `materi`
--
ALTER TABLE `materi`
  MODIFY `idmateri` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=549;

--
-- AUTO_INCREMENT for table `orangtua`
--
ALTER TABLE `orangtua`
  MODIFY `idorangtua` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `idpembayaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=227;

--
-- AUTO_INCREMENT for table `program`
--
ALTER TABLE `program`
  MODIFY `idprogram` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `programlevel`
--
ALTER TABLE `programlevel`
  MODIFY `idprogramlevel` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `rapotbelajar`
--
ALTER TABLE `rapotbelajar`
  MODIFY `idrapotbelajar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT for table `rapottrial`
--
ALTER TABLE `rapottrial`
  MODIFY `idhasiltrial` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `siswa`
--
ALTER TABLE `siswa`
  MODIFY `idsiswa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT for table `siswabelajar`
--
ALTER TABLE `siswabelajar`
  MODIFY `idsiswabelajar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=90;

--
-- AUTO_INCREMENT for table `trial`
--
ALTER TABLE `trial`
  MODIFY `idtrial` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
