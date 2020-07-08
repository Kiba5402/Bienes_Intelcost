CREATE DATABASE intelcost_bienes;

USE intelcost_bienes;
--
-- Base de datos: `intelcost_bienes`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bienes_guardados`
--

CREATE TABLE `bienes_guardados` (
  `id` int(11) NOT NULL,
  `idusr` int(11) NOT NULL,
  `idbien` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bien_raiz`
--

CREATE TABLE `bien_raiz` (
  `id_bien` int(11) NOT NULL,
  `Direccion` varchar(10) COLLATE utf8_spanish_ci NOT NULL,
  `Telefono` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `Codigo_postal` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `Precio` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `id_Tipo` int(11) NOT NULL,
  `id_Ciudad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;


--
-- Estructura de tabla para la tabla `ciudad`
--

CREATE TABLE `ciudad` (
  `id` int(11) NOT NULL,
  `nombre` varchar(20) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipos`
--

CREATE TABLE `tipos` (
  `id` int(11) NOT NULL,
  `tipo` varchar(20) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `idUsr` int(11) NOT NULL,
  `nombre` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `correo` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `pass` varchar(200) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`idUsr`, `nombre`, `correo`, `pass`) VALUES
(1, 'Cristian Reyes', 'cristian123@asd.com', '123'),
(2, 'Camilo Perez', 'camp11@qwe.com', '1234');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `bienes_guardados`
--
ALTER TABLE `bienes_guardados`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bienes_guardados_fk` (`idbien`),
  ADD KEY `bienes_guardados_fk_1` (`idusr`);

--
-- Indices de la tabla `bien_raiz`
--
ALTER TABLE `bien_raiz`
  ADD PRIMARY KEY (`id_bien`),
  ADD KEY `bien_raiz_fk` (`id_Tipo`),
  ADD KEY `bien_raiz_fk_1` (`id_Ciudad`);

--
-- Indices de la tabla `ciudad`
--
ALTER TABLE `ciudad`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tipos`
--
ALTER TABLE `tipos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`idUsr`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `bienes_guardados`
--
ALTER TABLE `bienes_guardados`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT de la tabla `bien_raiz`
--
ALTER TABLE `bien_raiz`
  MODIFY `id_bien` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT de la tabla `ciudad`
--
ALTER TABLE `ciudad`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `tipos`
--
ALTER TABLE `tipos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `idUsr` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `bienes_guardados`
--
ALTER TABLE `bienes_guardados`
  ADD CONSTRAINT `bienes_guardados_fk` FOREIGN KEY (`idbien`) REFERENCES `bien_raiz` (`id_bien`),
  ADD CONSTRAINT `bienes_guardados_fk_1` FOREIGN KEY (`idusr`) REFERENCES `usuario` (`idUsr`);

--
-- Filtros para la tabla `bien_raiz`
--
ALTER TABLE `bien_raiz`
  ADD CONSTRAINT `bien_raiz_fk` FOREIGN KEY (`id_Tipo`) REFERENCES `tipos` (`id`),
  ADD CONSTRAINT `bien_raiz_fk_1` FOREIGN KEY (`id_Ciudad`) REFERENCES `ciudad` (`id`);
COMMIT;

