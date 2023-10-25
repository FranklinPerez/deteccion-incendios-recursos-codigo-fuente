-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 25, 2023 at 06:24 PM
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
-- Table structure for table `correo_notificar`
--

CREATE TABLE `correo_notificar` (
  `id_correo` int(11) NOT NULL,
  `correo_notificar` varchar(100) NOT NULL,
  `codigo_verificacion` int(11) NOT NULL,
  `estado_verificacion` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `correo_notificar`
--

INSERT INTO `correo_notificar` (`id_correo`, `correo_notificar`, `codigo_verificacion`, `estado_verificacion`) VALUES
(2, 'franklin9perez952012@gmail.com', 691211, 'verificado');

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
(15, 'fuga de gas detectada', 'gas', '2023-10-20', '13:03:24'),
(16, 'fuego detectado', 'fuego', '2023-10-20', '13:03:52');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `correo_notificar`
--
ALTER TABLE `correo_notificar`
  ADD PRIMARY KEY (`id_correo`);

--
-- Indexes for table `gas_fuego_detectado`
--
ALTER TABLE `gas_fuego_detectado`
  ADD PRIMARY KEY (`id_alarma`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `correo_notificar`
--
ALTER TABLE `correo_notificar`
  MODIFY `id_correo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `gas_fuego_detectado`
--
ALTER TABLE `gas_fuego_detectado`
  MODIFY `id_alarma` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;
