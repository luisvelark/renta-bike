-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 11-12-2020 a las 18:21:23
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
  `idFachada` int(11) NOT NULL,
  `idUsuarioAdminFK` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `administrador`
--

INSERT INTO `administrador` (`idFachada`, `idUsuarioAdminFK`) VALUES
(1, 7);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alquiler`
--

CREATE TABLE `alquiler` (
  `idAlquiler` int(11) NOT NULL,
  `idUsuarioCliente` int(11) NOT NULL,
  `idBicicleta` int(11) NOT NULL,
  `idPuntoE` int(11) NOT NULL,
  `idPuntoD` int(11) DEFAULT NULL,
  `fechaAlquiler` date NOT NULL,
  `horaInicioAlquiler` time NOT NULL,
  `HoraFinAlquiler` time NOT NULL,
  `HoraEntregaAlquiler` time DEFAULT NULL,
  `clienteAlternativo` int(11) DEFAULT NULL,
  `estadoAlquiler` enum('EnProceso','Activo','Finalizado','Perdido','Anulado') NOT NULL,
  `daño` enum('SinDanio','Recuperable','Irrecuperable') DEFAULT NULL,
  `ruta` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `alquiler`
--

INSERT INTO `alquiler` (`idAlquiler`, `idUsuarioCliente`, `idBicicleta`, `idPuntoE`, `idPuntoD`, `fechaAlquiler`, `horaInicioAlquiler`, `HoraFinAlquiler`, `HoraEntregaAlquiler`, `clienteAlternativo`, `estadoAlquiler`, `daño`, `ruta`) VALUES
(10, 8, 1, 1, 2, '2020-11-29', '20:20:00', '22:20:00', '00:00:00', 0, 'Anulado', '', 'la ruta'),
(12, 2, 2, 1, 2, '2020-12-03', '17:10:00', '19:10:00', '00:00:00', 0, 'Finalizado', '', 'la ruta'),
(19, 2, 11, 1, 1, '2020-12-09', '22:20:34', '00:20:34', '22:44:28', 0, 'Finalizado', 'SinDanio', ''),
(20, 2, 11, 1, NULL, '2020-12-09', '22:55:00', '00:55:00', NULL, 0, 'Perdido', NULL, NULL),
(21, 1, 1, 1, 1, '2020-12-09', '22:59:32', '00:59:32', '15:20:02', 0, 'Finalizado', 'Recuperable', ''),
(22, 2, 2, 1, NULL, '2020-12-09', '23:42:50', '01:42:50', NULL, 0, 'Anulado', NULL, NULL),
(23, 2, 2, 1, NULL, '2020-12-09', '08:00:00', '10:00:00', NULL, 0, 'Perdido', NULL, NULL),
(25, 2, 11, 1, 1, '2020-12-10', '11:44:28', '13:44:28', '11:52:07', 0, 'Finalizado', 'Recuperable', ''),
(26, 2, 12, 1, 1, '2020-12-10', '08:54:15', '10:54:15', '11:55:14', 0, 'Finalizado', 'Recuperable', ''),
(27, 2, 13, 1, 1, '2020-12-09', '18:56:07', '20:56:07', '11:57:05', 0, 'Finalizado', 'Recuperable', ''),
(28, 2, 14, 1, 1, '2020-12-10', '00:00:35', '02:00:35', '15:03:48', 0, 'Finalizado', 'Recuperable', ''),
(29, 2, 1, 1, 1, '2020-12-11', '02:20:00', '04:20:00', '04:00:09', 42578123, 'Finalizado', 'SinDanio', ''),
(30, 2, 1, 1, 1, '2020-12-11', '10:32:17', '12:32:17', '11:07:33', 42578123, 'Finalizado', 'SinDanio', ''),
(33, 2, 3, 1, 1, '2020-12-11', '14:13:42', '16:13:42', '14:17:15', 42578123, 'Finalizado', 'SinDanio', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alquiler_asignado`
--

CREATE TABLE `alquiler_asignado` (
  `idAlquilerAsignado` int(11) NOT NULL,
  `idAlquilerFK` int(11) NOT NULL,
  `idClienteFK` int(11) NOT NULL,
  `idClienteOriginal` int(11) NOT NULL,
  `activo` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `alquiler_asignado`
--

INSERT INTO `alquiler_asignado` (`idAlquilerAsignado`, `idAlquilerFK`, `idClienteFK`, `idClienteOriginal`, `activo`) VALUES
(4, 33, 3, 2, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bicicleta`
--

CREATE TABLE `bicicleta` (
  `idBicicleta` int(11) NOT NULL,
  `numeroBicicleta` varchar(3) NOT NULL,
  `estado` enum('EnAlquiler','EnReparacion','Disponible','NoDisponible') NOT NULL DEFAULT 'Disponible',
  `daño` enum('SinDanio','Recuperable','Irrecuperable') NOT NULL DEFAULT 'SinDanio',
  `observaciones` varchar(100) NOT NULL,
  `idPuntoED` int(11) NOT NULL,
  `precio` int(11) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `bicicleta`
--

INSERT INTO `bicicleta` (`idBicicleta`, `numeroBicicleta`, `estado`, `daño`, `observaciones`, `idPuntoED`, `precio`, `deleted_at`) VALUES
(1, '001', 'EnAlquiler', 'SinDanio', '', 1, 25000, NULL),
(2, '002', 'EnAlquiler', 'SinDanio', '', 1, 25000, NULL),
(3, '003', 'Disponible', 'SinDanio', '', 1, 25000, NULL),
(4, '004', 'Disponible', 'SinDanio', '', 2, 25000, NULL),
(5, '005', 'Disponible', 'SinDanio', '', 2, 25000, NULL),
(6, '006', 'Disponible', 'SinDanio', '', 2, 25000, NULL),
(7, '015', 'Disponible', 'SinDanio', '', 2, 25000, '2020-12-04 23:41:46'),
(8, '010', 'Disponible', 'SinDanio', '', 2, 25000, NULL),
(9, '011', 'Disponible', 'SinDanio', '', 1, 25000, NULL),
(10, '012', 'Disponible', 'SinDanio', '', 2, 25000, NULL),
(11, '013', 'Disponible', 'SinDanio', '', 1, 25000, NULL),
(12, '014', 'Disponible', 'SinDanio', '', 1, 25000, NULL),
(13, '015', 'Disponible', 'SinDanio', '', 1, 25000, NULL),
(14, '016', 'Disponible', 'SinDanio', '', 1, 25000, NULL),
(15, '020', 'Disponible', 'SinDanio', '', 1, 25000, '2020-12-10 04:48:44'),
(16, '020', 'Disponible', 'SinDanio', '', 1, 25000, NULL);

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

--
-- Volcado de datos para la tabla `calificacion`
--

INSERT INTO `calificacion` (`fechaCalificacion`, `idPuntoED`, `idUsuarioCliente`, `puntos`, `descripcion`) VALUES
('2020-11-22', 2, 3, 5, 'brenda lesa'),
('2020-11-22', 2, 3, 5, 'brenda mala onda'),
('2020-11-22', 2, 3, 1, 'brenda toma fernet'),
('2020-11-22', 2, 3, 3, 'brenda mala onda'),
('2020-11-22', 1, 1, 3, 'esteban genio. soy brenda! uwu'),
('2020-11-22', 1, 1, 3, 'brenda mala onda'),
('2020-11-22', 1, 1, 1, ''),
('2020-11-23', 1, 1, 4, 'brenda ortiva'),
('2020-11-23', 1, 1, 4, 'brenda genia'),
('2020-11-23', 1, 1, 4, 'brenda buena onda '),
('2020-11-23', 1, 1, 5, 'brenda lalala'),
('2020-11-23', 1, 1, 4, 'brenda tarada'),
('2020-11-23', 1, 1, 4, 'eaea'),
('2020-11-23', 1, 1, 5, ''),
('2020-11-23', 1, 1, 3, 'brenda tarada'),
('2020-11-23', 1, 1, 5, 'brenda mala onda'),
('2020-11-23', 1, 1, 5, 'brenda mala onda'),
('2020-11-23', 1, 1, 5, 'brenda mala onda'),
('2020-11-23', 1, 1, 5, ''),
('2020-12-02', 1, 1, 3, ''),
('2020-12-03', 1, 2, 5, ''),
('2020-12-03', 1, 2, 5, ''),
('2020-12-03', 1, 2, 5, ''),
('2020-12-03', 1, 2, 5, ''),
('2020-12-03', 1, 2, 5, ''),
('2020-12-03', 1, 2, 5, ''),
('2020-12-03', 1, 2, 5, ''),
('2020-12-03', 1, 2, 5, ''),
('2020-12-03', 1, 2, 5, ''),
('2020-12-03', 1, 2, 5, ''),
('2020-12-03', 1, 2, 5, ''),
('2020-12-03', 1, 2, 5, ''),
('2020-12-03', 1, 2, 5, ''),
('2020-12-03', 1, 2, 5, ''),
('2020-12-03', 1, 2, 5, ''),
('2020-12-03', 1, 2, 5, ''),
('2020-12-03', 1, 2, 5, ''),
('2020-12-07', 2, 2, 3, ''),
('2020-12-09', 1, 2, 3, ''),
('2020-12-09', 1, 2, 3, ''),
('2020-12-10', 1, 8, 3, '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE `cliente` (
  `idFachada` int(11) NOT NULL,
  `idUsuarioFK` int(11) NOT NULL,
  `puntajeTotal` float NOT NULL DEFAULT 0,
  `credito` float NOT NULL DEFAULT 0,
  `suspendido` tinyint(1) NOT NULL DEFAULT 0,
  `fechaInicioSuspencion` date DEFAULT NULL,
  `fechaFinSuspencion` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`idFachada`, `idUsuarioFK`, `puntajeTotal`, `credito`, `suspendido`, `fechaInicioSuspencion`, `fechaFinSuspencion`) VALUES
(1, 1, 260, 350, 0, NULL, NULL),
(2, 3, 0, 0, 0, NULL, NULL),
(3, 4, 0, -350, 0, NULL, NULL),
(4, 5, 0, 0, 0, NULL, NULL),
(5, 8, 0, 0, 0, NULL, NULL),
(6, 2, -242, 0, 0, NULL, NULL),
(7, 6, 0, 0, 0, NULL, NULL),
(8, 7, 0, 0, 0, NULL, NULL);

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
(3, 4, 5000, '2020-11-13', 'Por el email', 0),
(35, 2, 100, '2020-12-10', 'Asistencia a capacitación', 0),
(36, 2, 100, '2020-12-10', 'Asistencia a capacitación', 0),
(77, 2, 500, '2020-12-11', 'Multa 1', 0),
(78, 2, 1000, '2020-12-11', 'Multa 2', 0),
(82, 2, 1500, '2020-12-11', 'Multa 3', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `puntaje`
--

CREATE TABLE `puntaje` (
  `idPuntaje` int(11) NOT NULL,
  `idUsuarioCliente` int(11) NOT NULL,
  `puntos` int(11) NOT NULL,
  `detallePuntaje` varchar(100) NOT NULL,
  `fechaPuntaje` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `puntaje`
--

INSERT INTO `puntaje` (`idPuntaje`, `idUsuarioCliente`, `puntos`, `detallePuntaje`, `fechaPuntaje`) VALUES
(1, 1, 50, 'Reportar daño', '2020-11-25'),
(2, 1, 50, 'No hay otra bicicleta disponible', '2020-11-25'),
(3, 1, 50, 'No hay otra bicicleta disponible', '2020-11-25'),
(4, 1, 50, 'No hay otra bicicleta disponible', '2020-11-25'),
(5, 1, 50, 'No hay otra bicicleta disponible', '2020-11-26'),
(6, 1, 50, 'No hay otra bicicleta disponible', '2020-11-26'),
(7, 1, 50, 'No hay otra bicicleta disponible', '2020-11-26'),
(35, 2, -40, 'Retorno en terminos y con incidentes', '2020-12-10'),
(36, 2, -60, 'Retorno fuera de terminos y con incidentes', '2020-12-10'),
(37, 2, -90, 'Retorno despues de fuera de terminos y con incidentes', '2020-12-10'),
(42, 2, -60, 'Retorno fuera de terminos y con incidentes', '2020-12-10'),
(88, 2, -4, 'Por no concretar el alquiler', '2020-12-11'),
(89, 2, -4, 'Por no concretar el alquiler', '2020-12-11'),
(90, 2, -4, 'Por no concretar el alquiler', '2020-12-11'),
(93, 2, 5, 'Retorno en terminos y sin incidentes', '2020-12-11'),
(98, 2, 5, 'Retorno en terminos y sin incidentes', '2020-12-11'),
(99, 2, 5, 'Retorno en terminos y sin incidentes', '2020-12-11'),
(100, 2, 5, 'Retorno en terminos y sin incidentes', '2020-12-11');

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
(1, 'Av. San Martín 500', 446123456, 4, '-45.8609651', '-67.4884351'),
(2, 'Av. Hipólito Yrigoyen 2351', 446123456, 3, '-45.8791456', '-67.5141204');

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
  `tipo` enum('administrador','cliente') NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`idUsuario`, `dni`, `nombre`, `apellido`, `correo`, `telefono`, `domicilio`, `cuil-cuit`, `fechaNacimiento`, `contraseña`, `tipo`, `deleted_at`) VALUES
(1, 38802605, 'Esteban', 'Saavedra', 'esteban@esteban.com', '2974787869', 'Barrio Quirno Costa', '20388026058', '1995-12-12', 'contraseña', 'cliente', NULL),
(2, 40872123, 'Cristian', 'Cañupan', 'caupancristian13@gmail.com', '297483647', 'Av Rivadavia 3504', '20408721238', '1998-01-29', 'asdasd', 'cliente', NULL),
(3, 42578123, 'Carlitos', 'Perez', 'carlitosK@yahoo.com.ar', '2974836475', 'Roca 1221', '2142751236', '1978-10-15', 'lerolero123', 'cliente', NULL),
(4, 42123456, 'Carla', 'Torrez', 'carlapocha@hotmail.com', '2975123321', 'Los claveles 123', '21421234568', '1990-06-25', 'qpwoei123', 'cliente', NULL),
(5, 23312456, 'Miguel', 'Bernoli', 'miguelbernoli@yahoo.com.ar', '2974321123', 'Estados Unidos 404', '2033124566', '1974-07-14', 'hardlock', 'cliente', NULL),
(6, 36123456, 'Brenda', 'Uribe', 'brenda@brenda.com', '2974123456', 'Barrio ceferino', '20361234567', '1991-08-02', 'estebancrack', 'administrador', NULL),
(7, 12345678, 'admin', 'admin', 'admin', 'admin', '123456789', 'a', '0000-00-00', 'admin', 'administrador', NULL),
(8, 12345678, 'cliente', 'cliente', 'cliente', 'cliente', '123456789', 'c', '0000-00-00', 'cliente', 'cliente', NULL),
(9, 45123456, 'tu mami', 'si ella', 'lamamadella@nose.com', '123456789', 'Ceferino', '12345123456', '1982-12-12', '12345678', 'cliente', NULL),
(10, 37123456, 'tu', 'prima', 'laprima@hotmail.com', '1231231231', 'Ceferino', '12337123456', '1994-12-12', '12345678', 'cliente', NULL),
(11, 37802605, 'luca', 'hammond', 'luca@hamon.com', '2983123132', 'walmart', '12337802605', '1993-12-12', '12345678', 'cliente', NULL),
(12, 38802605, '', '', '', '', '', '', '0000-00-00', '', 'administrador', NULL),
(13, 62626262, 'dasda', 'dada', 'esteban@brendabloqueadora.com', '123456789', 'dadasdsa', '12362626262', '1919-12-12', '12345678', 'cliente', NULL),
(14, 12366666, 'brenda', 'la panadera', 'brenda@panadera.com', '123456789', 'kenedy por la prove', '12312366666', '1991-08-12', '12345678', 'administrador', NULL),
(15, 11112222, '3123123123', '2312312321', 'da@gmail.c32312312om', '12356789', 'lalala', '12311112222', '1885-12-12', '12345678', 'cliente', NULL),
(16, 11334455, '34', 'urive', 'angela@sistemas.com.lala', '123456789', 'calle 510', '12311334455', '1995-12-12', '12345678', 'cliente', NULL);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `administrador`
--
ALTER TABLE `administrador`
  ADD PRIMARY KEY (`idFachada`),
  ADD UNIQUE KEY `idUsuario` (`idUsuarioAdminFK`);

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
-- Indices de la tabla `alquiler_asignado`
--
ALTER TABLE `alquiler_asignado`
  ADD PRIMARY KEY (`idAlquilerAsignado`),
  ADD KEY `idAlquilerFK` (`idAlquilerFK`),
  ADD KEY `idClienteFK` (`idClienteFK`),
  ADD KEY `idClienteOriginal` (`idClienteOriginal`);

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
  ADD KEY `idPuntoED` (`idPuntoED`),
  ADD KEY `idUsuario` (`idUsuarioCliente`);

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`idFachada`),
  ADD UNIQUE KEY `idUsuario` (`idUsuarioFK`);

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
-- AUTO_INCREMENT de la tabla `administrador`
--
ALTER TABLE `administrador`
  MODIFY `idFachada` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `alquiler`
--
ALTER TABLE `alquiler`
  MODIFY `idAlquiler` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT de la tabla `alquiler_asignado`
--
ALTER TABLE `alquiler_asignado`
  MODIFY `idAlquilerAsignado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `bicicleta`
--
ALTER TABLE `bicicleta`
  MODIFY `idBicicleta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `calificacion`
--
ALTER TABLE `calificacion`
  MODIFY `idPuntoED` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `cliente`
--
ALTER TABLE `cliente`
  MODIFY `idFachada` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `multa`
--
ALTER TABLE `multa`
  MODIFY `idMulta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;

--
-- AUTO_INCREMENT de la tabla `puntaje`
--
ALTER TABLE `puntaje`
  MODIFY `idPuntaje` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

--
-- AUTO_INCREMENT de la tabla `puntoentregadevolucion`
--
ALTER TABLE `puntoentregadevolucion`
  MODIFY `idPuntoED` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `idUsuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `administrador`
--
ALTER TABLE `administrador`
  ADD CONSTRAINT `administrador_ibfk_1` FOREIGN KEY (`idUsuarioAdminFK`) REFERENCES `usuario` (`idUsuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `alquiler`
--
ALTER TABLE `alquiler`
  ADD CONSTRAINT `alquiler_ibfk_1` FOREIGN KEY (`idBicicleta`) REFERENCES `bicicleta` (`idBicicleta`),
  ADD CONSTRAINT `alquiler_ibfk_2` FOREIGN KEY (`idUsuarioCliente`) REFERENCES `cliente` (`idUsuarioFK`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `alquiler_ibfk_3` FOREIGN KEY (`idPuntoD`) REFERENCES `puntoentregadevolucion` (`idPuntoED`),
  ADD CONSTRAINT `alquiler_ibfk_4` FOREIGN KEY (`idPuntoE`) REFERENCES `puntoentregadevolucion` (`idPuntoED`);

--
-- Filtros para la tabla `alquiler_asignado`
--
ALTER TABLE `alquiler_asignado`
  ADD CONSTRAINT `alquiler_asignado_ibfk_1` FOREIGN KEY (`idAlquilerFK`) REFERENCES `alquiler` (`idAlquiler`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `alquiler_asignado_ibfk_2` FOREIGN KEY (`idClienteFK`) REFERENCES `cliente` (`idUsuarioFK`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `alquiler_asignado_ibfk_3` FOREIGN KEY (`idClienteOriginal`) REFERENCES `alquiler` (`idUsuarioCliente`) ON DELETE CASCADE ON UPDATE CASCADE;

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
  ADD CONSTRAINT `calificacion_ibfk_2` FOREIGN KEY (`idUsuarioCliente`) REFERENCES `cliente` (`idUsuarioFK`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD CONSTRAINT `cliente_ibfk1` FOREIGN KEY (`idUsuarioFK`) REFERENCES `usuario` (`idUsuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `multa`
--
ALTER TABLE `multa`
  ADD CONSTRAINT `multa_ibfk_1` FOREIGN KEY (`idUsuarioCliente`) REFERENCES `cliente` (`idUsuarioFK`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `puntaje`
--
ALTER TABLE `puntaje`
  ADD CONSTRAINT `puntaje_ibfk_1` FOREIGN KEY (`idUsuarioCliente`) REFERENCES `cliente` (`idUsuarioFK`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
