-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 04, 2022 at 07:08 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Database: `spms_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `add_vehicle`
--

CREATE TABLE `add_vehicle` (
  `id` int(11) NOT NULL,
  `vehicle_no` varchar(200) NOT NULL,
  `parking_area_no` varchar(200) NOT NULL,
  `vehicle_type` varchar(200) NOT NULL,
  `parking_charge` varchar(200) NOT NULL,
  `status` varchar(10) NOT NULL DEFAULT '0',
  `arrival_time` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `add_vehicle`
--

INSERT INTO `add_vehicle` (`id`, `vehicle_no`, `parking_area_no`, `vehicle_type`, `parking_charge`, `status`, `arrival_time`) VALUES
(34, 'GBN-2306', '1', 'Car Type 101', '7', '1', '2022-07-04 09:29:13'),
(35, 'ABC-1234', '1', 'Car Type 101', '7', '1', '2022-07-04 09:29:47'),
(36, 'GBN-2306', '2', 'Car', '4', '0', '2022-07-04 10:43:15');

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `name` varchar(120) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`, `username`, `password`) VALUES
(1, 'Administrator', 'admin', 'admin123');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `cat_id` int(11) NOT NULL,
  `parking_area_no` varchar(100) NOT NULL,
  `vehicle_type` varchar(100) NOT NULL,
  `vehicle_limit` varchar(200) NOT NULL,
  `parking_charge` varchar(200) NOT NULL,
  `status` varchar(10) NOT NULL DEFAULT '0',
  `doc` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`cat_id`, `parking_area_no`, `vehicle_type`, `vehicle_limit`, `parking_charge`, `status`, `doc`) VALUES
(1, '2', 'Car', '18', '4', '1', '2020-04-19 19:33:44'),
(3, '6', 'Motorcycle', '26', '2', '1', '2021-05-15 19:04:41'),
(4, '2', 'Mini Van', '8', '5', '1', '2021-05-15 20:10:39'),
(5, '7', 'Pickup Van', '11', '5', '1', '2021-05-15 22:21:51'),
(6, '9', 'Minibus', '6', '6', '1', '2021-05-15 22:22:53'),
(7, '1', 'Car Type 101', '5', '7', '1', '2022-07-04 08:46:51');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `add_vehicle`
--
ALTER TABLE `add_vehicle`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`cat_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `add_vehicle`
--
ALTER TABLE `add_vehicle`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `cat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;
