-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 04, 2024 at 02:12 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `calicloud`
--

-- --------------------------------------------------------

--
-- Table structure for table `reserveserviceoptions`
--

CREATE TABLE `reserveserviceoptions` (
  `reserve_service_id` int(11) NOT NULL,
  `service_option_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reserveservices`
--

CREATE TABLE `reserveservices` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `vehicle_id` int(11) NOT NULL,
  `pickup_location_lat` float NOT NULL,
  `pickup_location_lon` float NOT NULL,
  `dropoff_location_lat` float NOT NULL,
  `dropoff_location_lon` float NOT NULL,
  `distance` float NOT NULL,
  `total_price` int(11) NOT NULL,
  `payment_method` enum('CARD','QR') NOT NULL,
  `transport_status` enum('WAITING','GOING','ARRIVED','FINISHED') NOT NULL,
  `pickup_date` date NOT NULL,
  `pickup_time` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reserveservices`
--

INSERT INTO `reserveservices` (`id`, `user_id`, `vehicle_id`, `pickup_location_lat`, `pickup_location_lon`, `dropoff_location_lat`, `dropoff_location_lon`, `distance`, `total_price`, `payment_method`, `transport_status`, `pickup_date`, `pickup_time`) VALUES
(2, 1, 1, 13, 13, 20, 20, 100, 2650, 'CARD', 'WAITING', '2024-10-30', '15:13:00'),
(3, 1, 1, 13, 13, 20, 20, 100, 2650, 'CARD', 'WAITING', '2024-10-30', '15:13:00'),
(4, 1, 2, 13.8026, 100.5, 13.8274, 100.396, 17, 1052, 'QR', 'WAITING', '2024-11-05', '17:38:00'),
(5, 1, 2, 13.8026, 100.5, 13.8274, 100.396, 17, 1052, 'QR', 'WAITING', '2024-11-05', '17:38:00');

-- --------------------------------------------------------

--
-- Table structure for table `serviceoptions`
--

CREATE TABLE `serviceoptions` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `serviceoptions`
--

INSERT INTO `serviceoptions` (`id`, `name`, `price`) VALUES
(1, 'packing', 300),
(2, 'insurance', 500),
(3, 'rifting', 200);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `email` varchar(200) NOT NULL,
  `token` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `email`, `token`) VALUES
(1, 'test@mail.com', '$$$$');

-- --------------------------------------------------------

--
-- Table structure for table `vehicles`
--

CREATE TABLE `vehicles` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `initial_price` int(11) NOT NULL,
  `add_price` int(11) NOT NULL,
  `capacity` int(11) NOT NULL,
  `image_url` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vehicles`
--

INSERT INTO `vehicles` (`id`, `name`, `initial_price`, `add_price`, `capacity`, `image_url`) VALUES
(1, 'Box Truck Jumbo', 450, 15, 2400, 'box_truck_jumbo.png'),
(2, 'Box Truck', 199, 9, 1100, 'box_truck.png'),
(3, '4 Door Pickup Truck', 159, 9, 1100, '4_door_pickup.png'),
(4, 'SUV', 119, 9, 300, 'SUV.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `reserveserviceoptions`
--
ALTER TABLE `reserveserviceoptions`
  ADD PRIMARY KEY (`reserve_service_id`,`service_option_id`),
  ADD KEY `serviceoptions_fk_rso` (`service_option_id`);

--
-- Indexes for table `reserveservices`
--
ALTER TABLE `reserveservices`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_fk_rs` (`user_id`),
  ADD KEY `vehicle_fk_rs` (`vehicle_id`);

--
-- Indexes for table `serviceoptions`
--
ALTER TABLE `serviceoptions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `vehicles`
--
ALTER TABLE `vehicles`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `reserveservices`
--
ALTER TABLE `reserveservices`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `serviceoptions`
--
ALTER TABLE `serviceoptions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `vehicles`
--
ALTER TABLE `vehicles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `reserveserviceoptions`
--
ALTER TABLE `reserveserviceoptions`
  ADD CONSTRAINT `reserveservices_fk_rso` FOREIGN KEY (`reserve_service_id`) REFERENCES `reserveservices` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `serviceoptions_fk_rso` FOREIGN KEY (`service_option_id`) REFERENCES `serviceoptions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `reserveservices`
--
ALTER TABLE `reserveservices`
  ADD CONSTRAINT `user_fk_rs` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `vehicle_fk_rs` FOREIGN KEY (`vehicle_id`) REFERENCES `vehicles` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
