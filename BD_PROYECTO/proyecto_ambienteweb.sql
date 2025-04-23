-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3307
-- Tiempo de generación: 23-04-2025 a las 22:37:47
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
-- Base de datos: `proyecto_ambienteweb`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `calendario`
--

CREATE TABLE `calendario` (
  `CALENDARIO_ID` int(11) NOT NULL,
  `EVENTO_ID` int(11) DEFAULT NULL,
  `FECHA` date DEFAULT NULL,
  `HORA` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `equipos`
--

CREATE TABLE `equipos` (
  `EQUIPO_ID` int(11) NOT NULL,
  `NOMBRE` varchar(100) DEFAULT NULL,
  `ENTRENADOR_ID` int(11) DEFAULT NULL,
  `DEPORTE` varchar(50) DEFAULT NULL,
  `DESCRIPCION` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estadisticas`
--

CREATE TABLE `estadisticas` (
  `ESTADISTICA_ID` int(11) NOT NULL,
  `EVENTO_ID` int(11) DEFAULT NULL,
  `EQUIPO_ID` int(11) DEFAULT NULL,
  `PARTICIPANTES` int(11) DEFAULT NULL,
  `FECHA_REPORTE` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `eventos`
--

CREATE TABLE `eventos` (
  `EVENTO_ID` int(11) NOT NULL,
  `NOMBRE` varchar(100) DEFAULT NULL,
  `FECHA` date DEFAULT NULL,
  `UBICACION` varchar(255) DEFAULT NULL,
  `TIPO_ACTIVIDAD` varchar(100) DEFAULT NULL,
  `DESCRIPCION` varchar(255) DEFAULT NULL,
  `ORGANIZADOR_ID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `foro`
--

CREATE TABLE `foro` (
  `PUBLICACION_ID` int(11) NOT NULL,
  `USUARIO_ID` int(11) DEFAULT NULL,
  `TITULO` varchar(255) DEFAULT NULL,
  `LINK` varchar(2033) DEFAULT NULL,
  `FECHA_PUBLICACION` date DEFAULT NULL,
  `DESCRIPCION` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `foro`
--

INSERT INTO `foro` (`PUBLICACION_ID`, `USUARIO_ID`, `TITULO`, `LINK`, `FECHA_PUBLICACION`, `DESCRIPCION`) VALUES
(2, NULL, '', 'https://www.youtube.com/watch?v=Rxcyo08LaPM', '2025-04-23', 'Esta rutina esta enfocada en personas que realizan deportes de contacto como puede ser MMA, Boxeo'),
(4, 1, '', 'https://www.youtube.com/watch?v=Rxcyo08LaPM', '2025-04-23', 'Esta rutina esta enfocada en personas que realizan deportes de contacto como puede ser MMA, Boxeo'),
(5, 1, '', 'https://www.youtube.com/watch?v=SRa6seKnn2Q', '2025-04-23', 'Esta rutina tiene la función de ayudar a incrementar el salto vertical de los jugadores'),
(6, 1, '', 'https://www.youtube.com/watch?v=SRa6seKnn2Q', '2025-04-23', 'Esta rutina tiene la función de ayudar a incrementar el salto vertical de los jugadores'),
(7, 1, '', 'https://www.youtube.com/watch?v=SRa6seKnn2Q', '2025-04-23', 'Esta rutina tiene la función de ayudar a incrementar el salto vertical de los jugadores'),
(8, 1, '', 'https://www.youtube.com/watch?v=SRa6seKnn2Q', '2025-04-23', 'Esta rutina tiene la función de ayudar a incrementar el salto vertical de los jugadores'),
(9, 1, '', 'https://www.youtube.com/watch?v=SRa6seKnn2Q', '2025-04-23', 'Esta rutina esta enfocada en personas que realizan deportes de contacto como puede ser MMA, Boxeo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inscripciones`
--

CREATE TABLE `inscripciones` (
  `INSCRIPCION_ID` int(11) NOT NULL,
  `USUARIO_ID` int(11) DEFAULT NULL,
  `EVENTO_ID` int(11) DEFAULT NULL,
  `EQUIPO_ID` int(11) DEFAULT NULL,
  `FECHA` date DEFAULT NULL,
  `ESTADO` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `notificaciones`
--

CREATE TABLE `notificaciones` (
  `NOTIFICACION_ID` int(11) NOT NULL,
  `USUARIO_ID` int(11) DEFAULT NULL,
  `MENSAJE` varchar(255) DEFAULT NULL,
  `FECHA_ENVIO` date DEFAULT NULL,
  `ESTADO` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `USUARIOS_ID` int(11) NOT NULL,
  `NOMBRE` varchar(100) DEFAULT NULL,
  `APELLIDO` varchar(100) DEFAULT NULL,
  `EMAIL` varchar(100) DEFAULT NULL,
  `PASSWORD` varchar(255) DEFAULT NULL,
  `ROL` varchar(10) DEFAULT NULL,
  `FECHA_REGISTRO` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`USUARIOS_ID`, `NOMBRE`, `APELLIDO`, `EMAIL`, `PASSWORD`, `ROL`, `FECHA_REGISTRO`) VALUES
(1, 'Evan', 'Marin', 'emarin@mail.com', 'adminEvan', 'admin', '2025-04-12');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `calendario`
--
ALTER TABLE `calendario`
  ADD PRIMARY KEY (`CALENDARIO_ID`),
  ADD KEY `EVENTO_ID` (`EVENTO_ID`);

--
-- Indices de la tabla `equipos`
--
ALTER TABLE `equipos`
  ADD PRIMARY KEY (`EQUIPO_ID`),
  ADD KEY `ENTRENADOR_ID` (`ENTRENADOR_ID`);

--
-- Indices de la tabla `estadisticas`
--
ALTER TABLE `estadisticas`
  ADD PRIMARY KEY (`ESTADISTICA_ID`),
  ADD KEY `EVENTO_ID` (`EVENTO_ID`),
  ADD KEY `EQUIPO_ID` (`EQUIPO_ID`);

--
-- Indices de la tabla `eventos`
--
ALTER TABLE `eventos`
  ADD PRIMARY KEY (`EVENTO_ID`),
  ADD KEY `ORGANIZADOR_ID` (`ORGANIZADOR_ID`);

--
-- Indices de la tabla `foro`
--
ALTER TABLE `foro`
  ADD PRIMARY KEY (`PUBLICACION_ID`),
  ADD KEY `USUARIO_ID` (`USUARIO_ID`);

--
-- Indices de la tabla `inscripciones`
--
ALTER TABLE `inscripciones`
  ADD PRIMARY KEY (`INSCRIPCION_ID`),
  ADD KEY `USUARIO_ID` (`USUARIO_ID`),
  ADD KEY `EVENTO_ID` (`EVENTO_ID`),
  ADD KEY `EQUIPO_ID` (`EQUIPO_ID`);

--
-- Indices de la tabla `notificaciones`
--
ALTER TABLE `notificaciones`
  ADD PRIMARY KEY (`NOTIFICACION_ID`),
  ADD KEY `USUARIO_ID` (`USUARIO_ID`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`USUARIOS_ID`),
  ADD UNIQUE KEY `EMAIL` (`EMAIL`),
  ADD UNIQUE KEY `PASSWORD` (`PASSWORD`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `calendario`
--
ALTER TABLE `calendario`
  MODIFY `CALENDARIO_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `equipos`
--
ALTER TABLE `equipos`
  MODIFY `EQUIPO_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `estadisticas`
--
ALTER TABLE `estadisticas`
  MODIFY `ESTADISTICA_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `eventos`
--
ALTER TABLE `eventos`
  MODIFY `EVENTO_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `foro`
--
ALTER TABLE `foro`
  MODIFY `PUBLICACION_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `inscripciones`
--
ALTER TABLE `inscripciones`
  MODIFY `INSCRIPCION_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `notificaciones`
--
ALTER TABLE `notificaciones`
  MODIFY `NOTIFICACION_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `USUARIOS_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `calendario`
--
ALTER TABLE `calendario`
  ADD CONSTRAINT `calendario_ibfk_1` FOREIGN KEY (`EVENTO_ID`) REFERENCES `eventos` (`EVENTO_ID`);

--
-- Filtros para la tabla `equipos`
--
ALTER TABLE `equipos`
  ADD CONSTRAINT `equipos_ibfk_1` FOREIGN KEY (`ENTRENADOR_ID`) REFERENCES `usuarios` (`USUARIOS_ID`);

--
-- Filtros para la tabla `estadisticas`
--
ALTER TABLE `estadisticas`
  ADD CONSTRAINT `estadisticas_ibfk_1` FOREIGN KEY (`EVENTO_ID`) REFERENCES `eventos` (`EVENTO_ID`),
  ADD CONSTRAINT `estadisticas_ibfk_2` FOREIGN KEY (`EQUIPO_ID`) REFERENCES `equipos` (`EQUIPO_ID`);

--
-- Filtros para la tabla `eventos`
--
ALTER TABLE `eventos`
  ADD CONSTRAINT `eventos_ibfk_1` FOREIGN KEY (`ORGANIZADOR_ID`) REFERENCES `usuarios` (`USUARIOS_ID`);

--
-- Filtros para la tabla `foro`
--
ALTER TABLE `foro`
  ADD CONSTRAINT `foro_ibfk_1` FOREIGN KEY (`USUARIO_ID`) REFERENCES `usuarios` (`USUARIOS_ID`);

--
-- Filtros para la tabla `inscripciones`
--
ALTER TABLE `inscripciones`
  ADD CONSTRAINT `inscripciones_ibfk_1` FOREIGN KEY (`USUARIO_ID`) REFERENCES `usuarios` (`USUARIOS_ID`),
  ADD CONSTRAINT `inscripciones_ibfk_2` FOREIGN KEY (`EVENTO_ID`) REFERENCES `eventos` (`EVENTO_ID`),
  ADD CONSTRAINT `inscripciones_ibfk_3` FOREIGN KEY (`EQUIPO_ID`) REFERENCES `equipos` (`EQUIPO_ID`);

--
-- Filtros para la tabla `notificaciones`
--
ALTER TABLE `notificaciones`
  ADD CONSTRAINT `notificaciones_ibfk_1` FOREIGN KEY (`USUARIO_ID`) REFERENCES `usuarios` (`USUARIOS_ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
