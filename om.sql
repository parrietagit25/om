-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 13-08-2024 a las 16:57:58
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

--
-- Volcado de datos para la tabla `categorias_om`
--

INSERT INTO `categorias_om` (`id`, `descripcion`, `stat`, `fecha_log`) VALUES
(1, 'HOTELES', 1, '2024-08-11 02:37:22'),
(2, 'RESTAURANTES', 1, '2024-08-11 02:37:22'),
(3, 'BIENESTAR', 1, '2024-08-11 02:37:22'),
(4, 'DIVERSION', 1, '2024-08-11 02:37:22');

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
  `precio` decimal(11,2) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `titulo` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `products_om`
--

INSERT INTO `products_om` (`id`, `descripcion`, `photo`, `id_business_partner`, `stat`, `fecha_log`, `id_user_log`, `id_categoria`, `precio`, `cantidad`, `titulo`) VALUES
(2, 'RESTAURANTES', 'img/3.jpg', 6, 1, '2024-08-11 19:30:36', 1, 2, 50.00, 60, 'Pruba 222'),
(3, 'RESTAURANTES', 'img/4.jpg', 6, 1, '2024-08-11 20:15:20', 1, 2, 50.00, 50, 'Pruba 222'),
(4, 'DIVERSION', 'img/5.jpg', 6, 1, '2024-08-11 20:37:01', 1, 4, 50.00, 5000, 'cascasnueces'),
(5, 'RESTAURANTES', 'img/6.jpg', 6, 1, '2024-08-11 20:40:49', 1, 2, 50.00, 11, 'Pruba 333'),
(6, 'BIENESTAR', 'img/2.jpg', 6, 1, '2024-08-11 20:47:24', 1, 3, 50.00, 1000, 'EE'),
(7, 'qweqwe', 'img/1.jpg', 6, 1, '2024-08-11 20:48:14', 1, 3, 50.00, 100, 'EE');

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
-- Volcado de datos para la tabla `users_om`
--

INSERT INTO `users_om` (`id`, `username`, `nombre`, `apellido`, `email`, `stat`, `fecha_log`, `pass`, `tipo_user`) VALUES
(1, 'tayron', 'Pedro', 'Arrieta', 'pedroarrieta25@hotmail.com', 1, '2024-08-10 22:31:31', '$2y$10$sCD6Ol6zOvZgnNPKHMlrRet27X4QoaUmR9Lr4WtlyzlmBuCDH1RUe', 1),
(5, 'cliente', 'cliente', 'cliente', 'tayronperez17@gmail.com', 1, '2024-08-12 01:34:08', '$2y$10$6Riuwtas7fu28Ov8JDtdde.Ecd1vnLB894EtGZhMvgE88g4oYFADy', 2),
(6, 'socio', 'socio', 'socio', 'tayron.arrieta@gruasshl.com', 1, '2024-08-12 01:35:09', '$2y$10$TyM0UUPdoKXZe9B8UfaJBeqku0S1HJar7PyZdB.2tV623GYsn.66y', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas`
--

CREATE TABLE `ventas` (
  `id` int(11) NOT NULL,
  `id_product` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `cantidad` decimal(11,2) NOT NULL,
  `monto` decimal(11,0) NOT NULL,
  `monto_total` decimal(11,0) NOT NULL,
  `stat` int(11) NOT NULL,
  `fecha_log` timestamp NOT NULL DEFAULT current_timestamp(),
  `codigo_promo` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `ventas`
--

INSERT INTO `ventas` (`id`, `id_product`, `id_user`, `cantidad`, `monto`, `monto_total`, `stat`, `fecha_log`, `codigo_promo`) VALUES
(11, 6, 5, 1.00, 50, 50, 1, '2024-08-13 01:29:47', 'ddaa496955c5cbb1805f');

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
-- Indices de la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categorias_om`
--
ALTER TABLE `categorias_om`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `products_om`
--
ALTER TABLE `products_om`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `users_om`
--
ALTER TABLE `users_om`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `ventas`
--
ALTER TABLE `ventas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
