-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 23, 2024 at 06:24 AM
-- Server version: 8.0.32
-- PHP Version: 8.2.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `edupick`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `adminID` int NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `firstName` varchar(30) COLLATE utf8mb4_general_ci NOT NULL,
  `lastName` varchar(30) COLLATE utf8mb4_general_ci NOT NULL,
  `contactNumber` varchar(13) COLLATE utf8mb4_general_ci NOT NULL,
  `regDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `IsDeleted` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`adminID`, `email`, `password`, `firstName`, `lastName`, `contactNumber`, `regDate`, `IsDeleted`) VALUES
(1, 'admin@edupick.com', '$2y$10$nGsc6BxLxT4GwBlhmurBM.d/8whBz9YIs69i1cA3y1DYkF.7dqh0O', 'Admin', 'EduPick', '0712341234', '2024-02-07 18:13:42', 0);

-- --------------------------------------------------------

--
-- Table structure for table `child`
--

CREATE TABLE `child` (
  `childID` int NOT NULL,
  `firstName` varchar(30) COLLATE utf8mb4_general_ci NOT NULL,
  `lastName` varchar(30) COLLATE utf8mb4_general_ci NOT NULL,
  `school` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `grade` int NOT NULL,
  `absentState` tinyint(1) NOT NULL,
  `parentID` int NOT NULL,
  `vanID` int DEFAULT NULL,
  `regDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `isDeleted` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `child`
--

INSERT INTO `child` (`childID`, `firstName`, `lastName`, `school`, `grade`, `absentState`, `parentID`, `vanID`, `regDate`, `isDeleted`) VALUES
(16, 'Ravien', 'Dalpatadu', 'Royal College, Colombo', 5, 0, 11, NULL, '2024-04-14 17:14:56', 0),
(17, 'Danudu', 'Madusha', 'Thurstan College, Colombo', 11, 0, 11, NULL, '2024-04-14 17:15:08', 0),
(18, 'Liviru', 'Samarawickrama', 'Ananda College, Colombo', 13, 0, 11, NULL, '2024-04-14 17:15:54', 0);

-- --------------------------------------------------------

--
-- Table structure for table `city`
--

CREATE TABLE `city` (
  `cityId` int NOT NULL,
  `name` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `city`
--

INSERT INTO `city` (`cityId`, `name`) VALUES
(1, 'Nugegoda'),
(2, 'Maharagama'),
(3, 'Kottawa'),
(4, 'Homagama');

-- --------------------------------------------------------

--
-- Table structure for table `driver`
--

CREATE TABLE `driver` (
  `driverID` int NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `firstName` varchar(30) COLLATE utf8mb4_general_ci NOT NULL,
  `lastName` varchar(30) COLLATE utf8mb4_general_ci NOT NULL,
  `nic` varchar(12) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `address` varchar(1000) COLLATE utf8mb4_general_ci NOT NULL,
  `contactNumber` varchar(13) COLLATE utf8mb4_general_ci NOT NULL,
  `ownerID` int DEFAULT NULL,
  `vehicleID` int DEFAULT NULL,
  `image_profilePhoto` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `image_nicFront` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `image_nicBack` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `image_licenseFront` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `image_licenseBack` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `doc_policeReport` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `doc_proofResidence` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `regDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `formState` tinyint(1) NOT NULL DEFAULT '0',
  `pendingState` tinyint(1) NOT NULL DEFAULT '0',
  `approvedState` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `driver`
--

INSERT INTO `driver` (`driverID`, `email`, `password`, `firstName`, `lastName`, `nic`, `address`, `contactNumber`, `ownerID`, `vehicleID`, `image_profilePhoto`, `image_nicFront`, `image_nicBack`, `image_licenseFront`, `image_licenseBack`, `doc_policeReport`, `doc_proofResidence`, `regDate`, `formState`, `pendingState`, `approvedState`) VALUES
(4, 'kasun@gmail.com', '$2y$10$4IWo9ZrQ24lJ2fXttjvuBuXk7XMkhwBKSsnZ.g9nSbgf.5Q1M64T6', 'Kasun', 'Hansamal', '123456789v', '29/3, Kaduwela Road, Malabe', '0717897890', NULL, NULL, 'driver\\profilePhoto\\6623536cb39018.06674227.jpg', 'driver\\nicFront\\6623536cb3bdf4.99934571.jpg', 'driver\\nicBack\\6623536cb3dd82.29576842.jpg', 'driver\\licenseFront\\6623536cb3fb04.37079381.jpg', 'driver\\licenseBack\\6623536cb42d80.22740070.jpg', 'driver\\policeReport\\6623536cb44af8.86251921.pdf', 'driver\\proofResidence\\6623536cb464b5.82286233.pdf', '2024-04-17 06:23:31', 1, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `drivervehiclerequest`
--

CREATE TABLE `drivervehiclerequest` (
  `requestId` int NOT NULL,
  `driverId` int NOT NULL,
  `vehicleId` int NOT NULL,
  `declinedState` int NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `incident`
--

CREATE TABLE `incident` (
  `incidentID` int NOT NULL,
  `description` varchar(1000) COLLATE utf8mb4_general_ci NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `parentID` int NOT NULL,
  `vehicleID` int NOT NULL,
  `resolvedState` varchar(30) COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `owner`
--

CREATE TABLE `owner` (
  `ownerID` int NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `firstName` varchar(30) COLLATE utf8mb4_general_ci NOT NULL,
  `lastName` varchar(30) COLLATE utf8mb4_general_ci NOT NULL,
  `contactNumber` varchar(13) COLLATE utf8mb4_general_ci NOT NULL,
  `regDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `owner`
--

INSERT INTO `owner` (`ownerID`, `email`, `password`, `firstName`, `lastName`, `contactNumber`, `regDate`) VALUES
(5, 'dasun@gmail.com', '$2y$10$ZtqU0z9v71HzDhR2EmgcpuBjN/LNV7eozE87XxnLcRqhKqE/TW.Yu', 'Dasun', 'Thathsara', '0798769876', '2024-04-21 04:52:20');

-- --------------------------------------------------------

--
-- Table structure for table `parent`
--

CREATE TABLE `parent` (
  `parentID` int NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `firstName` varchar(30) COLLATE utf8mb4_general_ci NOT NULL,
  `lastName` varchar(30) COLLATE utf8mb4_general_ci NOT NULL,
  `city` varchar(60) COLLATE utf8mb4_general_ci NOT NULL,
  `contactNumber` varchar(13) COLLATE utf8mb4_general_ci NOT NULL,
  `regDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `parent`
--

INSERT INTO `parent` (`parentID`, `email`, `password`, `firstName`, `lastName`, `city`, `contactNumber`, `regDate`) VALUES
(11, 'nisal@gmail.com', '$2y$10$sc95vWPSxmWTeSbw/QKk0O5kGkQhO1mCngsC4SSuwoQY9BSWuzPPW', 'Nisal', 'Peiris', 'Kottawa', '0712341234', '2024-04-14 17:14:39');

-- --------------------------------------------------------

--
-- Table structure for table `school`
--

CREATE TABLE `school` (
  `schoolId` int NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `school`
--

INSERT INTO `school` (`schoolId`, `name`) VALUES
(1, 'Royal College, Colombo'),
(2, 'Ananda College, Colombo'),
(3, 'Thurstan College, Colombo');

-- --------------------------------------------------------

--
-- Table structure for table `vehicle`
--

CREATE TABLE `vehicle` (
  `vehicleId` int NOT NULL,
  `licensePlate` varchar(30) NOT NULL,
  `model` varchar(255) NOT NULL,
  `modelYear` varchar(4) NOT NULL,
  `vacantSeats` int NOT NULL,
  `totalSeats` int NOT NULL,
  `ownerId` int NOT NULL,
  `driverId` int DEFAULT NULL,
  `ac` tinyint(1) NOT NULL,
  `highroof` tinyint(1) NOT NULL,
  `image_vehicle` varchar(255) DEFAULT NULL,
  `doc_emissions` varchar(255) DEFAULT NULL,
  `doc_registration` varchar(255) DEFAULT NULL,
  `approvedState` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `vehicle`
--

INSERT INTO `vehicle` (`vehicleId`, `licensePlate`, `model`, `modelYear`, `vacantSeats`, `totalSeats`, `ownerId`, `driverId`, `ac`, `highroof`, `image_vehicle`, `doc_emissions`, `doc_registration`, `approvedState`) VALUES
(1, 'PH - 2556', 'Toyota Hiace', '2011', 4, 9, 5, NULL, 1, 0, 'vehicle\\vehicleImage\\6625da6d7739e4.09669164.jpg', 'vehicle\\emissionsReport\\6625da6d7784e9.08419725.pdf', 'vehicle\\registrationDoc\\6625da6d775fa8.94803719.pdf', 0);

-- --------------------------------------------------------

--
-- Table structure for table `vehiclecities`
--

CREATE TABLE `vehiclecities` (
  `vehicleCityId` int NOT NULL,
  `vehicleId` int NOT NULL,
  `cityId` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `vehiclecities`
--

INSERT INTO `vehiclecities` (`vehicleCityId`, `vehicleId`, `cityId`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 1, 3);

-- --------------------------------------------------------

--
-- Table structure for table `vehicleschools`
--

CREATE TABLE `vehicleschools` (
  `vehicleSchoolId` int NOT NULL,
  `vehicleId` int NOT NULL,
  `schoolId` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `vehicleschools`
--

INSERT INTO `vehicleschools` (`vehicleSchoolId`, `vehicleId`, `schoolId`) VALUES
(1, 1, 1),
(2, 1, 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`adminID`);

--
-- Indexes for table `child`
--
ALTER TABLE `child`
  ADD PRIMARY KEY (`childID`);

--
-- Indexes for table `city`
--
ALTER TABLE `city`
  ADD PRIMARY KEY (`cityId`);

--
-- Indexes for table `driver`
--
ALTER TABLE `driver`
  ADD PRIMARY KEY (`driverID`);

--
-- Indexes for table `drivervehiclerequest`
--
ALTER TABLE `drivervehiclerequest`
  ADD PRIMARY KEY (`requestId`);

--
-- Indexes for table `incident`
--
ALTER TABLE `incident`
  ADD PRIMARY KEY (`incidentID`);

--
-- Indexes for table `owner`
--
ALTER TABLE `owner`
  ADD PRIMARY KEY (`ownerID`);

--
-- Indexes for table `parent`
--
ALTER TABLE `parent`
  ADD PRIMARY KEY (`parentID`);

--
-- Indexes for table `school`
--
ALTER TABLE `school`
  ADD PRIMARY KEY (`schoolId`);

--
-- Indexes for table `vehicle`
--
ALTER TABLE `vehicle`
  ADD PRIMARY KEY (`vehicleId`);

--
-- Indexes for table `vehiclecities`
--
ALTER TABLE `vehiclecities`
  ADD PRIMARY KEY (`vehicleCityId`);

--
-- Indexes for table `vehicleschools`
--
ALTER TABLE `vehicleschools`
  ADD PRIMARY KEY (`vehicleSchoolId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `adminID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `child`
--
ALTER TABLE `child`
  MODIFY `childID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `city`
--
ALTER TABLE `city`
  MODIFY `cityId` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `driver`
--
ALTER TABLE `driver`
  MODIFY `driverID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `drivervehiclerequest`
--
ALTER TABLE `drivervehiclerequest`
  MODIFY `requestId` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `incident`
--
ALTER TABLE `incident`
  MODIFY `incidentID` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `owner`
--
ALTER TABLE `owner`
  MODIFY `ownerID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `parent`
--
ALTER TABLE `parent`
  MODIFY `parentID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `school`
--
ALTER TABLE `school`
  MODIFY `schoolId` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `vehicle`
--
ALTER TABLE `vehicle`
  MODIFY `vehicleId` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `vehiclecities`
--
ALTER TABLE `vehiclecities`
  MODIFY `vehicleCityId` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `vehicleschools`
--
ALTER TABLE `vehicleschools`
  MODIFY `vehicleSchoolId` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
