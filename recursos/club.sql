-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 20-01-2022 a las 19:38:35
-- Versión del servidor: 10.4.22-MariaDB
-- Versión de PHP: 8.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `club`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fechareserva`
--

CREATE TABLE `fechareserva` (
  `id` int(11) NOT NULL,
  `id_instalacion` int(11) NOT NULL,
  `fecha` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `horareserva`
--

CREATE TABLE `horareserva` (
  `id` int(11) NOT NULL,
  `id_fecha` int(11) NOT NULL,
  `h9` tinyint(4) NOT NULL,
  `h10` tinyint(4) NOT NULL,
  `h11` tinyint(4) NOT NULL,
  `h12` tinyint(4) NOT NULL,
  `h13` tinyint(4) NOT NULL,
  `h14` tinyint(4) NOT NULL,
  `h15` tinyint(4) NOT NULL,
  `h16` tinyint(4) NOT NULL,
  `h17` tinyint(4) NOT NULL,
  `h18` tinyint(4) NOT NULL,
  `h19` tinyint(4) NOT NULL,
  `h20` tinyint(4) NOT NULL,
  `h21` tinyint(4) NOT NULL,
  `h22` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `instalacion`
--

CREATE TABLE `instalacion` (
  `id` int(11) NOT NULL,
  `titulo` text NOT NULL,
  `foto` text NOT NULL,
  `descripcion` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `noticia`
--

CREATE TABLE `noticia` (
  `id` int(11) NOT NULL,
  `titulo` text NOT NULL,
  `foto` text NOT NULL,
  `descripcion` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reserva`
--

CREATE TABLE `reserva` (
  `id` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `r_padel1` tinyint(4) NOT NULL,
  `c_padel1` decimal(10,0) NOT NULL,
  `r_padel2` tinyint(4) NOT NULL,
  `c_padel2` decimal(10,0) NOT NULL,
  `r_tenis1` tinyint(4) NOT NULL,
  `c_tenis1` decimal(10,0) NOT NULL,
  `r_tenis2` tinyint(4) NOT NULL,
  `c_tenis2` decimal(10,0) NOT NULL,
  `r_futbol` tinyint(4) NOT NULL,
  `c_futbol` decimal(11,0) NOT NULL,
  `r_baloncesto` tinyint(4) NOT NULL,
  `c_baloncesto` decimal(10,0) NOT NULL,
  `r_barbacoa` tinyint(4) NOT NULL,
  `c_barbacoa` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id` int(11) NOT NULL,
  `nombre` text NOT NULL,
  `apellidos` text NOT NULL,
  `contrasena` int(11) NOT NULL,
  `dni` text NOT NULL,
  `nfamiliares` int(11) NOT NULL,
  `cuota` decimal(10,0) NOT NULL,
  `presidente` tinyint(4) NOT NULL,
  `autorizado` tinyint(4) NOT NULL,
  `admin` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `fechareserva`
--
ALTER TABLE `fechareserva`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_instalacion` (`id_instalacion`);

--
-- Indices de la tabla `horareserva`
--
ALTER TABLE `horareserva`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_fecha` (`id_fecha`);

--
-- Indices de la tabla `instalacion`
--
ALTER TABLE `instalacion`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `noticia`
--
ALTER TABLE `noticia`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `reserva`
--
ALTER TABLE `reserva`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `fechareserva`
--
ALTER TABLE `fechareserva`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `horareserva`
--
ALTER TABLE `horareserva`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `instalacion`
--
ALTER TABLE `instalacion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `noticia`
--
ALTER TABLE `noticia`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `reserva`
--
ALTER TABLE `reserva`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `fechareserva`
--
ALTER TABLE `fechareserva`
  ADD CONSTRAINT `fechareserva_ibfk_1` FOREIGN KEY (`id_instalacion`) REFERENCES `instalacion` (`id`);

--
-- Filtros para la tabla `horareserva`
--
ALTER TABLE `horareserva`
  ADD CONSTRAINT `horareserva_ibfk_1` FOREIGN KEY (`id_fecha`) REFERENCES `fechareserva` (`id`);

--
-- Filtros para la tabla `reserva`
--
ALTER TABLE `reserva`
  ADD CONSTRAINT `reserva_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
