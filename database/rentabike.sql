-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 02-11-2020 a las 21:44:01
-- Versión del servidor: 10.4.14-MariaDB
-- Versión de PHP: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `rentabike`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `administrador`
--

CREATE TABLE `administrador` (
  `idUsuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alquiler`
--

CREATE TABLE `alquiler` (
  `idAlquiler` int(11) NOT NULL,
  `idUsuarioCliente` int(11) NOT NULL,
  `idBicicleta` int(11) NOT NULL,
  `idPuntoE` int(11) NOT NULL,
  `idPuntoD` int(11) NOT NULL,
  `fechaAlquiler` date NOT NULL,
  `horaInicioAlquiler` time NOT NULL,
  `HoraFinAlquiler` time NOT NULL,
  `HoraEntregaAlquiler` time NOT NULL,
  `clienteAlternativo` int(11) DEFAULT NULL,
  `estadoAlquiler` enum('EnProceso','Activo','Finalizado') NOT NULL,
  `daño` enum('SinDaño','Recuperable','Irrecuperable') NOT NULL,
  `ruta` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bicicleta`
--

CREATE TABLE `bicicleta` (
  `idBicicleta` int(11) NOT NULL,
  `numeroBicicleta` int(11) NOT NULL,
  `estado` enum('EnAlquiler','EnReparacion','Disponible') NOT NULL,
  `daño` enum('SinDaño','Recuperable','Irrecuperable') NOT NULL,
  `observaciones` varchar(100) NOT NULL,
  `idPuntoED` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `calificacion`
--

CREATE TABLE `calificacion` (
  `fechaCalificacion` date NOT NULL,
  `idPuntoED` int(11) NOT NULL,
  `idUsuarioCliente` int(11) NOT NULL,
  `puntos` int(11) NOT NULL,
  `descripcion` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE `cliente` (
  `idUsuario` int(11) NOT NULL,
  `puntajeTotal` float NOT NULL,
  `credito` float NOT NULL,
  `suspendido` tinyint(1) NOT NULL DEFAULT 0,
  `fechaInicioSuspencion` date DEFAULT NULL,
  `fechaFinSuspencion` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `multa`
--

CREATE TABLE `multa` (
  `idMulta` int(11) NOT NULL,
  `idUsuarioCliente` int(11) NOT NULL,
  `monto` int(11) NOT NULL,
  `fechaMulta` date NOT NULL,
  `detalleMulta` varchar(100) NOT NULL,
  `pagado` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `puntaje`
--

CREATE TABLE `puntaje` (
  `idPuntaje` int(11) NOT NULL,
  `idUsuarioCliente` int(11) NOT NULL,
  `detallePuntaje` varchar(100) NOT NULL,
  `fechaPuntaje` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `puntoentregadevolucion`
--

CREATE TABLE `puntoentregadevolucion` (
  `idPuntoED` int(11) NOT NULL,
  `direccion` varchar(50) NOT NULL,
  `telefono` int(11) NOT NULL,
  `calificacionTotal` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `idUsuario` int(11) NOT NULL,
  `dni` int(8) NOT NULL,
  `nombre` varchar(40) NOT NULL,
  `apellido` varchar(40) NOT NULL,
  `correo` varchar(40) NOT NULL,
  `telefono` int(11) NOT NULL,
  `domicilio` varchar(50) NOT NULL,
  `cuil-cuit` int(11) NOT NULL,
  `fechaNacimiento` date NOT NULL,
  `contraseña` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `administrador`
--
ALTER TABLE `administrador`
  ADD PRIMARY KEY (`idUsuario`);

--
-- Indices de la tabla `alquiler`
--
ALTER TABLE `alquiler`
  ADD PRIMARY KEY (`idAlquiler`),
  ADD KEY `idUsuario` (`idUsuarioCliente`),
  ADD KEY `idBicicleta` (`idBicicleta`),
  ADD KEY `idPuntoED` (`idPuntoD`,`idPuntoE`),
  ADD KEY `idPuntoE` (`idPuntoE`);

--
-- Indices de la tabla `bicicleta`
--
ALTER TABLE `bicicleta`
  ADD PRIMARY KEY (`idBicicleta`),
  ADD KEY `idPuntoED` (`idPuntoED`);

--
-- Indices de la tabla `calificacion`
--
ALTER TABLE `calificacion`
  ADD PRIMARY KEY (`fechaCalificacion`),
  ADD KEY `idPuntoED` (`idPuntoED`),
  ADD KEY `idUsuario` (`idUsuarioCliente`);

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`idUsuario`);

--
-- Indices de la tabla `multa`
--
ALTER TABLE `multa`
  ADD PRIMARY KEY (`idMulta`),
  ADD KEY `idUsuario` (`idUsuarioCliente`);

--
-- Indices de la tabla `puntaje`
--
ALTER TABLE `puntaje`
  ADD PRIMARY KEY (`idPuntaje`),
  ADD KEY `idUsuario` (`idUsuarioCliente`);

--
-- Indices de la tabla `puntoentregadevolucion`
--
ALTER TABLE `puntoentregadevolucion`
  ADD PRIMARY KEY (`idPuntoED`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`idUsuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `alquiler`
--
ALTER TABLE `alquiler`
  MODIFY `idAlquiler` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `bicicleta`
--
ALTER TABLE `bicicleta`
  MODIFY `idBicicleta` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `calificacion`
--
ALTER TABLE `calificacion`
  MODIFY `idPuntoED` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `multa`
--
ALTER TABLE `multa`
  MODIFY `idMulta` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `puntaje`
--
ALTER TABLE `puntaje`
  MODIFY `idPuntaje` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `puntoentregadevolucion`
--
ALTER TABLE `puntoentregadevolucion`
  MODIFY `idPuntoED` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `idUsuario` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `administrador`
--
ALTER TABLE `administrador`
  ADD CONSTRAINT `administrador_ibfk_1` FOREIGN KEY (`idUsuario`) REFERENCES `usuario` (`idUsuario`);

--
-- Filtros para la tabla `alquiler`
--
ALTER TABLE `alquiler`
  ADD CONSTRAINT `alquiler_ibfk_1` FOREIGN KEY (`idBicicleta`) REFERENCES `bicicleta` (`idBicicleta`),
  ADD CONSTRAINT `alquiler_ibfk_2` FOREIGN KEY (`idUsuarioCliente`) REFERENCES `cliente` (`idUsuario`),
  ADD CONSTRAINT `alquiler_ibfk_3` FOREIGN KEY (`idPuntoD`) REFERENCES `puntoentregadevolucion` (`idPuntoED`),
  ADD CONSTRAINT `alquiler_ibfk_4` FOREIGN KEY (`idPuntoE`) REFERENCES `puntoentregadevolucion` (`idPuntoED`);

--
-- Filtros para la tabla `bicicleta`
--
ALTER TABLE `bicicleta`
  ADD CONSTRAINT `bicicleta_ibfk_1` FOREIGN KEY (`idPuntoED`) REFERENCES `puntoentregadevolucion` (`idPuntoED`);

--
-- Filtros para la tabla `calificacion`
--
ALTER TABLE `calificacion`
  ADD CONSTRAINT `calificacion_ibfk_1` FOREIGN KEY (`idPuntoED`) REFERENCES `puntoentregadevolucion` (`idPuntoED`),
  ADD CONSTRAINT `calificacion_ibfk_2` FOREIGN KEY (`idUsuarioCliente`) REFERENCES `cliente` (`idUsuario`);

--
-- Filtros para la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD CONSTRAINT `cliente_ibfk_1` FOREIGN KEY (`idUsuario`) REFERENCES `usuario` (`idUsuario`);

--
-- Filtros para la tabla `multa`
--
ALTER TABLE `multa`
  ADD CONSTRAINT `multa_ibfk_1` FOREIGN KEY (`idUsuarioCliente`) REFERENCES `cliente` (`idUsuario`);

--
-- Filtros para la tabla `puntaje`
--
ALTER TABLE `puntaje`
  ADD CONSTRAINT `puntaje_ibfk_1` FOREIGN KEY (`idUsuarioCliente`) REFERENCES `cliente` (`idUsuario`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
