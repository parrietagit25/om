-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 10-08-2024 a las 04:44:20
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `om`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias_om`
--

CREATE TABLE `categorias_om` (
  `id` int(11) NOT NULL,
  `descripcion` varchar(50) NOT NULL,
  `stat` int(1) NOT NULL COMMENT '1=on; 2=off',
  `fecha_log` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `products_om`
--

CREATE TABLE `products_om` (
  `id` int(11) NOT NULL,
  `descripcion` text NOT NULL,
  `photo` varchar(250) NOT NULL,
  `id_business_partner` int(11) NOT NULL,
  `stat` int(1) NOT NULL COMMENT '1=on;\r\n2=off',
  `fecha_log` timestamp NOT NULL DEFAULT current_timestamp(),
  `id_user_log` int(11) NOT NULL,
  `id_categoria` int(11) NOT NULL,
  `precio` decimal(11,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users_om`
--

CREATE TABLE `users_om` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `apellido` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `stat` int(1) NOT NULL,
  `fecha_log` timestamp NOT NULL DEFAULT current_timestamp(),
  `pass` varchar(250) NOT NULL,
  `tipo_user` int(1) NOT NULL COMMENT '1=admin\r\n2=regular\r\n3=business partner'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categorias_om`
--
ALTER TABLE `categorias_om`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `products_om`
--
ALTER TABLE `products_om`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `users_om`
--
ALTER TABLE `users_om`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categorias_om`
--
ALTER TABLE `categorias_om`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `products_om`
--
ALTER TABLE `products_om`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `users_om`
--
ALTER TABLE `users_om`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
