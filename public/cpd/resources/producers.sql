-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 18, 2022 at 07:14 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sicefa`
--

-- --------------------------------------------------------

--
-- Table structure for table `producers`
--

CREATE TABLE `producers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `producers`
--

INSERT INTO `producers` (`id`, `name`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Waldemar Bravo', NULL, NULL, NULL),
(2, 'Ernesto Vergel ', NULL, NULL, NULL),
(3, 'Ramon Castro', NULL, NULL, NULL),
(4, 'Ramiro Santofimio', NULL, NULL, NULL),
(5, 'Etediel Diaz', NULL, NULL, NULL),
(6, 'Uldarico Pacheco', NULL, NULL, NULL),
(7, 'Hernan Garcia', NULL, NULL, NULL),
(8, 'Jose Ferney Figeroa  ', NULL, NULL, NULL),
(9, 'Edgar Cerquera', NULL, NULL, NULL),
(10, 'Daniel Ramirez ', NULL, NULL, NULL),
(11, 'Aldemar Guzman', NULL, NULL, NULL),
(12, 'Angel Antonio Cachaya ', NULL, NULL, NULL),
(13, 'Orlando Escobar ', NULL, NULL, NULL),
(14, 'Carlos Pastrana', NULL, NULL, NULL),
(15, 'Juan de dios Duran', NULL, NULL, NULL),
(16, 'Honorio Suaza', NULL, NULL, NULL),
(17, 'Yaneth Perdomo', NULL, NULL, NULL),
(18, 'Saturnino Avila Toledo', NULL, NULL, NULL),
(19, 'Rubiela Mota Mota', NULL, NULL, NULL),
(20, 'Javier Humberto Paredes', NULL, NULL, NULL),
(21, 'Ebli Gomez', NULL, NULL, NULL),
(22, 'Centro de Formacion Agroindustrial ', NULL, NULL, NULL),
(23, 'Angel coronado ', NULL, NULL, NULL),
(24, 'Hector Angel Ramirez Quintero', NULL, NULL, NULL),
(25, 'Gustavo Castillo', NULL, NULL, NULL),
(26, 'Emiliano Camacho', NULL, NULL, NULL),
(27, 'Marcela Ortiz', NULL, NULL, NULL),
(28, 'Maria Elvia Perez', NULL, NULL, NULL),
(29, 'Orlando Gonzales Moyano', NULL, NULL, NULL),
(30, 'Rosalbina Suaza', NULL, NULL, NULL),
(31, 'Oscar Neira ', NULL, NULL, NULL),
(32, 'Alexander Gonzalez ', NULL, NULL, NULL),
(33, 'Rigoberto Barrios Aragones', NULL, NULL, NULL),
(34, 'Hober Ortiz', NULL, NULL, NULL),
(35, 'Rosalba Veru', NULL, NULL, NULL),
(36, 'Graciela Rodriguez Salazar', NULL, NULL, NULL),
(37, 'Luis Carlos Avila', NULL, NULL, NULL),
(38, 'Gilma Rocha', NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `producers`
--
ALTER TABLE `producers`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `producers`
--
ALTER TABLE `producers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
