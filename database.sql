-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 01, 2026 at 06:25 AM
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
-- Database: `fleet_track`
--

-- --------------------------------------------------------

--
-- Table structure for table `parcels`
--

CREATE TABLE `parcels` (
  `id` int(11) NOT NULL,
  `tracking_code` varchar(20) NOT NULL,
  `sender` varchar(100) NOT NULL,
  `receiver` varchar(100) NOT NULL,
  `origin` varchar(100) NOT NULL,
  `destination` varchar(100) NOT NULL,
  `weight` decimal(10,2) NOT NULL,
  `status` varchar(20) DEFAULT 'Pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `parcels`
--

INSERT INTO `parcels` (`id`, `tracking_code`, `sender`, `receiver`, `origin`, `destination`, `weight`, `status`, `created_at`) VALUES
(1, 'TRK-380285', 'vanessa', 'vina', 'Manila', 'Cebu', 2.50, 'Delivered', '2026-11-01 03:26:49'),
(2, 'TRK-512811', 'she', 'cae', 'Baguio', 'Davao', 1.20, 'Pending', '2026-11-01 03:26:49'),
(4, 'TRK-846291', 'Robert', 'Daniel', 'Cebu', 'Manila', 5.25, 'Delivered', '2026-11-01 03:30:07'),
(5, 'TRK-193857', 'Sophia', 'Isabella', 'Davao', 'Baguio', 1.75, 'Delivered', '2026-11-01 03:30:07'),
(6, 'TRK-625310', 'James', 'William', 'Pampanga', 'Cavite', 2.80, 'Pending', '2026-11-01 03:30:07'),
(7, 'TRK-471926', 'Olivia', 'Emma', 'Zambales', 'Manila', 4.00, 'In Transit', '2026-11-01 03:30:07'),
(8, 'TRK-583102', 'Benjamin', 'Lucas', 'Batangas', 'Cebu', 6.50, 'Delivered', '2026-11-01 03:30:07'),
(9, 'TRK-914725', 'Charlotte', 'Amelia', 'Baguio', 'Pangasinan', 1.25, 'Pending', '2026-11-01 03:30:07'),
(10, 'TRK-362819', 'Henry', 'Alexander', 'Iloilo', 'Davao', 3.20, 'In Transit', '2026-11-01 03:30:07'),
(11, 'TRK-758401', 'Ethan', 'Mason', 'Cavite', 'Laguna', 2.15, 'Delivered', '2026-11-01 03:30:07'),
(12, 'TRK-205693', 'Grace', 'Chloe', 'Tarlac', 'Nueva Ecija', 7.00, 'Pending', '2026-11-01 03:30:07');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(20) DEFAULT 'admin'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`) VALUES
(1, 'admin', 'admin123', 'admin'),
(2, 'john', 'john123', 'admin'),
(3, 'maria', 'maria123', 'staff'),
(4, 'carlos', 'carlos123', 'staff'),
(5, 'customer', 'password123', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `parcels`
--
ALTER TABLE `parcels`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `parcels`
--
ALTER TABLE `parcels`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
