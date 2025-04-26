-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3307
-- Tiempo de generación: 26-04-2025 a las 04:18:31
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

--
-- Volcado de datos para la tabla `eventos`
--

INSERT INTO `eventos` (`EVENTO_ID`, `NOMBRE`, `FECHA`, `UBICACION`, `TIPO_ACTIVIDAD`, `DESCRIPCION`, `ORGANIZADOR_ID`) VALUES
(1, 'Torneo de Fútbol Comunitario', '2025-04-27', 'Estadio Municipal', 'Deportivo', 'Torneo amistoso de fútbol para todas las edades. Se formarán equipos de 6 jugadores.', 1),
(8, 'Media Maratón Urbana', '2025-06-22', 'Parque Central', 'Deportivo', 'Carrera de 21km por las principales calles de la ciudad. Incluye hidratación y camiseta conmemorativa.', 1),
(9, 'Clase de Yoga al Aire Libre', '2025-04-30', 'Parque de los Jacarandás', 'Bienestar', 'Sesión de yoga para principiantes y avanzados. Trae tu mat y ropa cómoda.', 1),
(10, 'Competencia de Natación', '2025-06-10', 'Piscina Olímpica Municipal', 'Deportivo', 'Competencia de natación en categorías infantil, juvenil y adultos. Pruebas de 50m, 100m y relevos.', 1),
(11, 'Paseo en Bicicleta Familiar', '2025-05-05', 'Plaza Principal', 'Recreativo', 'Recorrido de 15km por la ciudad. Actividad para toda la familia. Traer bicicleta y casco obligatorio.', 1),
(12, 'Taller de Nutrición Deportiva', '2025-04-27', 'Centro Comunitario', 'Educativo', 'Aprende sobre alimentación adecuada para optimizar tu rendimiento deportivo. Impartido por nutricionistas especializados.', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `foro`
--

CREATE TABLE `foro` (
  `PUBLICACION_ID` int(11) NOT NULL,
  `USUARIO_ID` int(11) DEFAULT NULL,
  `CONTENIDO` varchar(255) DEFAULT NULL,
  `FECHA_PUBLICACION` date DEFAULT NULL,
  `TIPO` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `foro`
--

INSERT INTO `foro` (`PUBLICACION_ID`, `USUARIO_ID`, `CONTENIDO`, `FECHA_PUBLICACION`, `TIPO`) VALUES
(1, 2, 'Hola mi nombre es Juan', '2025-04-26', 'articulo');

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

--
-- Volcado de datos para la tabla `inscripciones`
--

INSERT INTO `inscripciones` (`INSCRIPCION_ID`, `USUARIO_ID`, `EVENTO_ID`, `EQUIPO_ID`, `FECHA`, `ESTADO`) VALUES
(1, 2, 1, NULL, '2025-04-25', 'aprobada');

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
(1, 'Evan', 'Marin', 'emarin@mail.com', 'admin1', 'admin', '2025-04-09'),
(2, 'Juan', 'Perez', 'jperez@mail.com', 'prueba', 'usuario', '2025-04-09'),
(4, 'Prueba', 'prueba', 'prueba@mail.com', 'prueba2', 'usuario', '2025-04-21');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `eventos`
--
ALTER TABLE `eventos`
  ADD PRIMARY KEY (`EVENTO_ID`);

--
-- Indices de la tabla `foro`
--
ALTER TABLE `foro`
  ADD PRIMARY KEY (`PUBLICACION_ID`);

--
-- Indices de la tabla `inscripciones`
--
ALTER TABLE `inscripciones`
  ADD PRIMARY KEY (`INSCRIPCION_ID`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`USUARIOS_ID`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `eventos`
--
ALTER TABLE `eventos`
  MODIFY `EVENTO_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `foro`
--
ALTER TABLE `foro`
  MODIFY `PUBLICACION_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `inscripciones`
--
ALTER TABLE `inscripciones`
  MODIFY `INSCRIPCION_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `USUARIOS_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
