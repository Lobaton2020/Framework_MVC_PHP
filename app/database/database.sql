-- Base de datos de prueba

-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 13-09-2020 a las 08:37:00
-- Versión del servidor: 8.0.19
-- Versión de PHP: 7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `testuser`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rols`
--

CREATE TABLE `rols` (
  `idrol` int NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `rols`
--

INSERT INTO `rols` (`idrol`, `name`) VALUES
(1, 'Visitante'),
(2, 'cliente');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `typecategories`
--

CREATE TABLE `typecategories` (
  `idtypecategory` int NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `iduser` int NOT NULL,
  `idrol` int NOT NULL,
  `name` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `nickname` varchar(50) NOT NULL,
  `password` varchar(200) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `born_date` date DEFAULT NULL,
  `create_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`iduser`, `idrol`, `name`, `lastname`, `email`, `nickname`, `password`, `status`, `born_date`, `create_date`) VALUES
(4, 1, '2', '3', '4', 'jUNA', '$2y$10$Ei3Kqob6XMzWlL7.gQqhkelgVMPWQjo6LCoQiOcgpsHSKNwx3C91K', 1, NULL, '2020-09-12 23:09:02'),
(5, 1, '2', '3', '4', 'jUNA', '$2y$10$Ly1JLwtCvRC1gVpWb.h2cOALJjZtzS/q563aZ5huzP3CR9H.miXae', 0, NULL, '2020-09-12 23:09:02'),
(6, 1, '2', '3', '4', 'jUNA', '$2y$10$qAt6BqKMlMyW3LncDOx81.IUmtMhEN4FOWjR2b68QzIOltXyYnb1m', 1, NULL, '2020-09-12 23:05:08'),
(7, 1, '2', '3', '4', 'jUNA', '$2y$10$tNtZsGA2dA5NIVb9v/DA4elZ0/PnjARwqTd2IvEZp8tmVE.nQEUGC', 1, NULL, '2020-09-13 01:05:24'),
(8, 1, '2', '3', '4', 'jUNA', '$2y$10$kWeX6sQIrOrsLDsb6U1BCOMmTLHLW38LYeR0StKHpChF5L/YbemzO', 1, NULL, '2020-09-13 02:01:50'),
(9, 1, '2', '3', '4', 'jUNA', '$2y$10$7OaVD01uVq.JED3s2KZEF.f3bp0rzek0tpyluvNnI9hKax515Hboa', 1, NULL, '2020-09-13 02:02:29');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `rols`
--
ALTER TABLE `rols`
  ADD PRIMARY KEY (`idrol`);

--
-- Indices de la tabla `typecategories`
--
ALTER TABLE `typecategories`
  ADD PRIMARY KEY (`idtypecategory`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`iduser`),
  ADD KEY `idrol` (`idrol`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `rols`
--
ALTER TABLE `rols`
  MODIFY `idrol` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `typecategories`
--
ALTER TABLE `typecategories`
  MODIFY `idtypecategory` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `iduser` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`idrol`) REFERENCES `rols` (`idrol`);
COMMIT;
