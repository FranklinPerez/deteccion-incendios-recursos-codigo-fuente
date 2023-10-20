-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 20, 2023 at 07:26 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.0.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Database: `arc_deteccion_incendios`
--

-- --------------------------------------------------------

--
-- Table structure for table `gas_fuego_detectado`
--

CREATE TABLE `gas_fuego_detectado` (
  `id_alarma` int(11) NOT NULL,
  `descripcion_alarma` varchar(50) NOT NULL,
  `tipo_alarma` varchar(50) NOT NULL,
  `fecha_alarma` date NOT NULL,
  `hora_alarma` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `gas_fuego_detectado`
--

INSERT INTO `gas_fuego_detectado` (`id_alarma`, `descripcion_alarma`, `tipo_alarma`, `fecha_alarma`, `hora_alarma`) VALUES
(11, 'fuego detectado', 'fuego', '2023-10-20', '11:25:34'),
(12, 'fuga de gas detectada', 'gas', '2023-10-20', '11:25:43');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `gas_fuego_detectado`
--
ALTER TABLE `gas_fuego_detectado`
  ADD PRIMARY KEY (`id_alarma`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `gas_fuego_detectado`
--
ALTER TABLE `gas_fuego_detectado`
  MODIFY `id_alarma` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;
