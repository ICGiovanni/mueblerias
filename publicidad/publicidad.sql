CREATE TABLE publicidad
(
	id_publicidad INT NOT NULL AUTO_INCREMENT,
	nombre VARCHAR(300) NOT NULL,
	contenido BLOB NOT NULL,
	PRIMARY KEY(id_publicidad)
) ENGINE = InnoDB;

CREATE TABLE `publicidad` (
  `id_publicidad` int(11) NOT NULL,
  `nombre` varchar(300) NOT NULL,
  `contenido` longtext NOT NULL,
  `fecha` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `publicidad`
--
ALTER TABLE `publicidad`
  ADD PRIMARY KEY (`id_publicidad`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `publicidad`
--
ALTER TABLE `publicidad`
  MODIFY `id_publicidad` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
