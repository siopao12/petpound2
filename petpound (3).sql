-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 24, 2024 at 07:50 AM
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
-- Database: `petpound`
--

-- --------------------------------------------------------

--
-- Table structure for table `petowner`
--

CREATE TABLE `petowner` (
  `PetownerID` int(50) NOT NULL,
  `Firstname` varchar(50) NOT NULL,
  `Middlename` varchar(50) NOT NULL,
  `Lastname` varchar(50) NOT NULL,
  `Gender` varchar(50) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `Password` varchar(100) NOT NULL,
  `Province` varchar(100) NOT NULL,
  `City` varchar(100) NOT NULL,
  `Barangay` varchar(100) NOT NULL,
  `Street` varchar(255) NOT NULL,
  `Contactnumber` varchar(20) NOT NULL,
  `Photos` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `petowner`
--

INSERT INTO `petowner` (`PetownerID`, `Firstname`, `Middlename`, `Lastname`, `Gender`, `Email`, `Password`, `Province`, `City`, `Barangay`, `Street`, `Contactnumber`, `Photos`) VALUES
(2, 'John', 'E', 'Ruelo', '', 'evangs111@gmail.com', 'pogi123', 'davao del sur', 'Davao City', 'Marapangi', 'Tukbisa Village Block 6 lot 2', '09993891933', 'uploads/350190991_3181920232110530_8639170864784440573_n.jpg'),
(6, 'Yuki', 'E', 'Yazuken', 'Female', 'yuki@gmail.com', 'yuki23', 'davao del norte', 'Pagadian City', 'Buhangin', 'Block 6 lot 2 Buhangin street', '09500847723', 'uploads/t-zzzzz-3-1-1.jpg'),
(7, 'Katrina', 'Evangelio', 'Ruelo', 'Female', 'katrina@gmail.com', 'gwapako', 'davao del norte', 'Pagadian city', 'Kiblawan', 'Block 6 lot 2 Kiblawan village', '09271572108', 'uploads/358114500_3528901274096098_4989274061429945314_n.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `petowner`
--
ALTER TABLE `petowner`
  ADD PRIMARY KEY (`PetownerID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `petowner`
--
ALTER TABLE `petowner`
  MODIFY `PetownerID` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
