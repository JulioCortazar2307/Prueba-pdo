-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 04-08-2025 a las 20:54:40
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
-- Base de datos: `ejercicio`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user`
--

CREATE TABLE `user` (
  `documento` int(11) NOT NULL,
  `nombres` text NOT NULL,
  `contrasena` varchar(500) NOT NULL,
  `user` varchar(100) NOT NULL,
  `id_tip_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `user`
--

INSERT INTO `user` (`documento`, `nombres`, `contrasena`, `user`, `id_tip_user`) VALUES
(122, 'sd', 'asda', 'asdsa', 2),
(1030281200, 'julio ', '123456789', 'jules', 1),
(1030281211, 'sebas', '123456789', 'sebastian', 2),
(1030281286, 'juanes', '12345678', 'juanitos', 3),
(1039281230, 'Juan ', '123456789', 'Juanito', 2),
(1111111111, 'jules', '123456789', 'robo', 2),
(2147483647, 'juan esteban', '$2y$10$rbUOoTOV3etmjBg/9hET1uQ5PJPMIk1ZlBcZXZ8W6pRAmthVKEHGa', 'hashing', 2);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`documento`),
  ADD KEY `id_tip_user` (`id_tip_user`);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`id_tip_user`) REFERENCES `tip_user` (`Id_tip_user`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
