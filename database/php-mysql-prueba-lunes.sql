-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 04-08-2025 a las 20:06:56
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `php-mysql-prueba-lunes`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tip_user`
--

CREATE TABLE `tip_user` (
  `id_tip_user` int(11) NOT NULL,
  `tipo_usuario` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tip_user`
--

INSERT INTO `tip_user` (`id_tip_user`, `tipo_usuario`) VALUES
(1, 'Instructor Tecnico'),
(2, 'Aprendiz'),
(3, 'Transversal');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user`
--

CREATE TABLE `user` (
  `dni` bigint(20) NOT NULL,
  `nombres` text NOT NULL,
  `telefono` bigint(20) NOT NULL,
  `correo` varchar(50) NOT NULL,
  `profesion` text NOT NULL,
  `contrasena` varchar(100) NOT NULL,
  `descripcion` varchar(1000) NOT NULL,
  `id_tip_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `user`
--

INSERT INTO `user` (`dni`, `nombres`, `telefono`, `correo`, `profesion`, `contrasena`, `descripcion`, `id_tip_user`) VALUES
(1030281200, 'JULIO CORTAZAR', 3242594286, 'juliocortazar@gmail.com', 'ESTUDIANTE', '1234567890', 'prueba de este nuevo campo en la base de datos', 2),
(1111111111, 'SEBASTIAN FLORIAN', 2147483647, 'sebastianfake@gmail.com', 'INSTRUCTOR', '1234567890', 'usuario con el nombre de seabstian y el rol de instructor para probar dirrecionamiento', 1),
(2222222222, 'JUANES ESPINOSA', 3136565555, 'juanes.fake@gmail.com', 'TRANSVERSAL', '1234567890', 'prueba de usuario con el nombre de juanes con el rol de transversal', 3),
(5555555555, 'JOSE FELIPE LAVAO ', 3121312312, 'juleslove4u@gmail.com', 'CONEJILLO DE INDIAS', '1234567890', 'prueba de cambio de valor maximo para telefono, dni en la base de datos cambio de int a bigint', 2);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `tip_user`
--
ALTER TABLE `tip_user`
  ADD PRIMARY KEY (`id_tip_user`);

--
-- Indices de la tabla `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`dni`),
  ADD KEY `id_tip_user` (`id_tip_user`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `tip_user`
--
ALTER TABLE `tip_user`
  MODIFY `id_tip_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `user`
--
ALTER TABLE `user`
  MODIFY `dni` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5555555556;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`id_tip_user`) REFERENCES `tip_user` (`id_tip_user`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
