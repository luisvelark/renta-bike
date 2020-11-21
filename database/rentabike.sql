-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 19-11-2020 a las 22:42:32
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

--
-- Volcado de datos para la tabla `administrador`
--

INSERT INTO `administrador` (`idUsuario`) VALUES
(2),
(7);

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

--
-- Volcado de datos para la tabla `alquiler`
--

INSERT INTO `alquiler` (`idAlquiler`, `idUsuarioCliente`, `idBicicleta`, `idPuntoE`, `idPuntoD`, `fechaAlquiler`, `horaInicioAlquiler`, `HoraFinAlquiler`, `HoraEntregaAlquiler`, `clienteAlternativo`, `estadoAlquiler`, `daño`, `ruta`) VALUES
(1, 1, 1, 2, 1, '2019-11-18', '14:30:00', '16:30:00', '16:25:00', NULL, 'Finalizado', 'SinDaño', NULL),
(2, 1, 2, 2, 1, '2019-11-20', '14:30:00', '16:30:00', '16:26:00', NULL, 'Finalizado', 'SinDaño', NULL),
(3, 1, 1, 2, 1, '2019-12-20', '14:00:00', '16:00:00', '15:55:00', NULL, 'Finalizado', 'SinDaño', NULL),
(4, 1, 1, 2, 1, '2020-01-25', '16:00:00', '18:00:00', '17:55:00', NULL, 'Finalizado', 'SinDaño', NULL),
(5, 1, 1, 2, 1, '2020-01-28', '16:00:00', '18:00:00', '17:56:00', NULL, 'Finalizado', 'SinDaño', NULL),
(6, 1, 1, 2, 1, '2020-02-05', '14:30:00', '16:30:00', '16:25:00', NULL, 'Finalizado', 'SinDaño', NULL),
(7, 1, 3, 2, 1, '2020-02-10', '14:30:00', '16:30:00', '16:29:00', NULL, 'Finalizado', 'SinDaño', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bicicleta`
--

CREATE TABLE `bicicleta` (
  `idBicicleta` int(11) NOT NULL,
  `numeroBicicleta` varchar(3) NOT NULL,
  `estado` enum('EnAlquiler','EnReparacion','Disponible') NOT NULL,
  `daño` enum('SinDaño','Recuperable','Irrecuperable') NOT NULL,
  `observaciones` varchar(100) NOT NULL,
  `idPuntoED` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `bicicleta`
--

INSERT INTO `bicicleta` (`idBicicleta`, `numeroBicicleta`, `estado`, `daño`, `observaciones`, `idPuntoED`) VALUES
(1, '001', 'Disponible', 'SinDaño', '', 1),
(2, '002', 'Disponible', 'SinDaño', '', 1),
(3, '003', 'Disponible', 'SinDaño', '', 1),
(4, '004', 'Disponible', 'SinDaño', '', 2),
(5, '005', 'Disponible', 'SinDaño', '', 2),
(6, '006', 'Disponible', 'SinDaño', '', 2);

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
  `puntajeTotal` float NOT NULL DEFAULT 0,
  `credito` float NOT NULL DEFAULT 0,
  `suspendido` tinyint(1) NOT NULL DEFAULT 0,
  `fechaInicioSuspencion` date DEFAULT NULL,
  `fechaFinSuspencion` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`idUsuario`, `puntajeTotal`, `credito`, `suspendido`, `fechaInicioSuspencion`, `fechaFinSuspencion`) VALUES
(1, 0, 350, 0, '2020-11-09', '2020-11-09'),
(3, 0, 0, 0, '2020-11-09', '2020-11-09'),
(4, 0, -350, 0, '2020-11-09', '2020-11-09'),
(5, 0, 0, 0, '2020-11-09', '2020-11-09'),
(8, 0, 0, 0, '2020-11-09', '2020-11-09');

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

--
-- Volcado de datos para la tabla `multa`
--

INSERT INTO `multa` (`idMulta`, `idUsuarioCliente`, `monto`, `fechaMulta`, `detalleMulta`, `pagado`) VALUES
(1, 1, 500, '2020-12-12', 'Por llegar tarde', 1),
(2, 1, 534, '2020-11-10', 'Por no confirmar alquiler', 1),
(3, 4, 5000, '2020-11-13', 'Por el email', 0);

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
  `calificacionTotal` float NOT NULL,
  `lat` varchar(11) NOT NULL,
  `lng` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `puntoentregadevolucion`
--

INSERT INTO `puntoentregadevolucion` (`idPuntoED`, `direccion`, `telefono`, `calificacionTotal`, `lat`, `lng`) VALUES
(1, 'Av. San Martín 500', 446123456, 0, '-45.8609651', '-67.4884351'),
(2, 'Av. Hipólito Yrigoyen 2351', 446123456, 0, '-45.8791456', '-67.5141204');

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
  `telefono` varchar(13) NOT NULL,
  `domicilio` varchar(50) NOT NULL,
  `cuil-cuit` varchar(11) NOT NULL,
  `fechaNacimiento` date NOT NULL,
  `contraseña` varchar(25) NOT NULL,
  `tipo` enum('administrador','cliente') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`idUsuario`, `dni`, `nombre`, `apellido`, `correo`, `telefono`, `domicilio`, `cuil-cuit`, `fechaNacimiento`, `contraseña`, `tipo`) VALUES
(1, 38802605, 'Esteban', 'Saavedra', 'esteban@esteban.com', '2974787869', 'Barrio Quirno Costa', '20388026058', '1995-12-12', 'contraseña', 'cliente'),
(2, 40872123, 'Cristian', 'Cañupan', 'caupancristian13@gmail.com', '297483647', 'Av Rivadavia 3504', '20408721238', '1998-01-29', 'asdasd', 'cliente'),
(3, 42578123, 'Carlitos', 'Perez', 'carlitosK@yahoo.com.ar', '2974836475', 'Roca 1221', '2142751236', '1978-10-15', 'lerolero123', 'cliente'),
(4, 42123456, 'Carla', 'Torrez', 'carlapocha@hotmail.com', '2975123321', 'Los claveles 123', '21421234568', '1990-06-25', 'qpwoei123', 'cliente'),
(5, 23312456, 'Miguel', 'Bernoli', 'miguelbernoli@yahoo.com.ar', '2974321123', 'Estados Unidos 404', '2033124566', '1974-07-14', 'hardlock', 'cliente'),
(6, 36123456, 'Brenda', 'Uribe', 'brenda@brenda.com', '2974123456', 'Barrio ceferino', '20361234567', '1991-08-02', 'estebancrack', 'administrador'),
(7, 12345678, 'admin', 'admin', 'admin', 'admin', '123456789', 'a', '0000-00-00', 'admin', 'administrador'),
(8, 12345678, 'cliente', 'cliente', 'cliente', 'cliente', '123456789', 'c', '0000-00-00', 'cliente', 'cliente');

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
  MODIFY `idAlquiler` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `bicicleta`
--
ALTER TABLE `bicicleta`
  MODIFY `idBicicleta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `calificacion`
--
ALTER TABLE `calificacion`
  MODIFY `idPuntoED` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `multa`
--
ALTER TABLE `multa`
  MODIFY `idMulta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `puntaje`
--
ALTER TABLE `puntaje`
  MODIFY `idPuntaje` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `puntoentregadevolucion`
--
ALTER TABLE `puntoentregadevolucion`
  MODIFY `idPuntoED` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `idUsuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

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
