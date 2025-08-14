--
-- Base de datos: `sastreria`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `administrador`
--

CREATE TABLE `administrador` (
  `CVE_ADMINISTRADOR` int(11) NOT NULL,
  `CVE_PERSONA` int(11) DEFAULT NULL,
  `CLAVE` varchar(8) NOT NULL,
  `PASSWORD` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE `categoria` (
  `CVE_CATEGORIA` int(11) NOT NULL,
  `NOMBRE` varchar(50) NOT NULL,
  `DESCRIPCION` varchar(200) DEFAULT NULL,
  `imagen` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias_prendas`
--

CREATE TABLE `categorias_prendas` (
  `CVE_CATEGORIA` int(11) NOT NULL,
  `CVE_PRENDA` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `citas`
--

CREATE TABLE `citas` (
  `CVE_CITAS` int(11) NOT NULL,
  `CVE_CLIENTE` int(11) DEFAULT NULL,
  `FECHA` datetime(6) NOT NULL,
  `MENSAJE` longtext DEFAULT NULL,
  `CANSELADO` tinyint(1) DEFAULT NULL,
  `imagen` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE `cliente` (
  `CVE_CLIENTE` int(11) NOT NULL,
  `CVE_PERSONA` int(11) DEFAULT NULL,
  `CVE_MEDIDAS` int(11) DEFAULT NULL,
  `TELEFONO` bigint(20) NOT NULL,
  `CORREO` varchar(30) NOT NULL,
  `DIRECCION` varchar(150) NOT NULL,
  `CLAVE` varchar(8) NOT NULL,
  `password` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`CVE_CLIENTE`, `CVE_PERSONA`, `CVE_MEDIDAS`, `TELEFONO`, `CORREO`, `DIRECCION`, `CLAVE`, `password`) VALUES
(1, 1, NULL, 0, '', '', '0342', '123');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_ventas`
--

CREATE TABLE `detalle_ventas` (
  `CVE_VENTAS` int(11) NOT NULL,
  `CVE_PRENDA` int(11) NOT NULL,
  `CANTIDAD` int(11) NOT NULL,
  `TOTAL` decimal(19,4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `medidas`
--

CREATE TABLE `medidas` (
  `CVE_MEDIDAS` int(11) NOT NULL,
  `HOMBRO` double DEFAULT NULL,
  `CADERA` double DEFAULT NULL,
  `CINTURA` double DEFAULT NULL,
  `ALTURA` double DEFAULT NULL,
  `CONTORNO_BRAZO` double DEFAULT NULL,
  `LARGO_BRAZO` double DEFAULT NULL,
  `ESPALDA` double DEFAULT NULL,
  `CUELLO` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos`
--

CREATE TABLE `pedidos` (
  `CVE_PEDIDOS` int(11) NOT NULL,
  `CVE_CLIENTE` int(11) DEFAULT NULL,
  `CVE_VENTAS` int(11) DEFAULT NULL,
  `CLAVE` varchar(8) NOT NULL,
  `FECHA_PEDIDO` datetime(6) NOT NULL,
  `FECHA_ENTREGA` datetime(6) NOT NULL,
  `MENSAJE` longtext DEFAULT NULL,
  `image` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `persona`
--

CREATE TABLE `persona` (
  `CVE_PERSONA` int(11) NOT NULL,
  `NOMBRE` varchar(50) NOT NULL,
  `PATERNO` varchar(50) NOT NULL,
  `MATERNO` varchar(50) NOT NULL,
  `EDAD` tinyint(3) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `persona`
--

INSERT INTO `persona` (`CVE_PERSONA`, `NOMBRE`, `PATERNO`, `MATERNO`, `EDAD`) VALUES
(1, 'Pedro', 'Alvarez', 'Hernández', 23);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `prenda`
--

CREATE TABLE `prenda` (
  `CVE_PRENDA` int(11) NOT NULL,
  `CVE_TALLAS` int(11) DEFAULT NULL,
  `NOMBRE` varchar(100) NOT NULL,
  `DESCRIPCION` varchar(200) NOT NULL,
  `PRECIO` decimal(19,4) NOT NULL,
  `ESTADO` tinyint(1) NOT NULL,
  `IMAGEN` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tallas`
--

CREATE TABLE `tallas` (
  `CVE_TALLAS` int(11) NOT NULL,
  `NUM_TALLA` varchar(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas`
--

CREATE TABLE `ventas` (
  `CVE_VENTAS` int(11) NOT NULL,
  `CVE_CLIENTE` int(11) DEFAULT NULL,
  `FECHA_VENTA` datetime(6) NOT NULL,
  `PAGADO` tinyint(1) NOT NULL,
  `FECHA_PAGO` datetime(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `administrador`
--
ALTER TABLE `administrador`
  ADD PRIMARY KEY (`CVE_ADMINISTRADOR`),
  ADD KEY `FK_ADMINIST_REFERENCE_PERSONA` (`CVE_PERSONA`);

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`CVE_CATEGORIA`);

--
-- Indices de la tabla `categorias_prendas`
--
ALTER TABLE `categorias_prendas`
  ADD PRIMARY KEY (`CVE_CATEGORIA`,`CVE_PRENDA`),
  ADD KEY `FK_CATEGORI_REFERENCE_PRENDA` (`CVE_PRENDA`);

--
-- Indices de la tabla `citas`
--
ALTER TABLE `citas`
  ADD PRIMARY KEY (`CVE_CITAS`),
  ADD KEY `FK_CITAS_REFERENCE_CLIENTE` (`CVE_CLIENTE`);

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`CVE_CLIENTE`),
  ADD KEY `FK_CLIENTE_REFERENCE_PERSONA` (`CVE_PERSONA`),
  ADD KEY `FK_CLIENTE_REFERENCE_MEDIDAS` (`CVE_MEDIDAS`);

--
-- Indices de la tabla `detalle_ventas`
--
ALTER TABLE `detalle_ventas`
  ADD PRIMARY KEY (`CVE_VENTAS`,`CVE_PRENDA`),
  ADD KEY `FK_DETALLE__REFERENCE_PRENDA` (`CVE_PRENDA`);

--
-- Indices de la tabla `medidas`
--
ALTER TABLE `medidas`
  ADD PRIMARY KEY (`CVE_MEDIDAS`);

--
-- Indices de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`CVE_PEDIDOS`),
  ADD KEY `FK_PEDIDOS_REFERENCE_VENTAS` (`CVE_VENTAS`),
  ADD KEY `FK_PEDIDOS_REFERENCE_CLIENTE` (`CVE_CLIENTE`);

--
-- Indices de la tabla `persona`
--
ALTER TABLE `persona`
  ADD PRIMARY KEY (`CVE_PERSONA`);

--
-- Indices de la tabla `prenda`
--
ALTER TABLE `prenda`
  ADD PRIMARY KEY (`CVE_PRENDA`),
  ADD KEY `FK_PRENDA_REFERENCE_TALLAS` (`CVE_TALLAS`);

--
-- Indices de la tabla `tallas`
--
ALTER TABLE `tallas`
  ADD PRIMARY KEY (`CVE_TALLAS`);

--
-- Indices de la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD PRIMARY KEY (`CVE_VENTAS`),
  ADD KEY `FK_VENTAS_REFERENCE_CLIENTE` (`CVE_CLIENTE`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `administrador`
--
ALTER TABLE `administrador`
  MODIFY `CVE_ADMINISTRADOR` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `CVE_CATEGORIA` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `citas`
--
ALTER TABLE `citas`
  MODIFY `CVE_CITAS` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `cliente`
--
ALTER TABLE `cliente`
  MODIFY `CVE_CLIENTE` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `detalle_ventas`
--
ALTER TABLE `detalle_ventas`
  MODIFY `CVE_VENTAS` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT de la tabla `medidas`
--
ALTER TABLE `medidas`
  MODIFY `CVE_MEDIDAS` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `CVE_PEDIDOS` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `persona`
--
ALTER TABLE `persona`
  MODIFY `CVE_PERSONA` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `prenda`
--
ALTER TABLE `prenda`
  MODIFY `CVE_PRENDA` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `tallas`
--
ALTER TABLE `tallas`
  MODIFY `CVE_TALLAS` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `ventas`
--
ALTER TABLE `ventas`
  MODIFY `CVE_VENTAS` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `administrador`
--
ALTER TABLE `administrador`
  ADD CONSTRAINT `FK_ADMINIST_REFERENCE_PERSONA` FOREIGN KEY (`CVE_PERSONA`) REFERENCES `persona` (`CVE_PERSONA`);

--
-- Filtros para la tabla `categorias_prendas`
--
ALTER TABLE `categorias_prendas`
  ADD CONSTRAINT `FK_CATEGORI_REFERENCE_CATEGORI` FOREIGN KEY (`CVE_CATEGORIA`) REFERENCES `categoria` (`CVE_CATEGORIA`),
  ADD CONSTRAINT `FK_CATEGORI_REFERENCE_PRENDA` FOREIGN KEY (`CVE_PRENDA`) REFERENCES `prenda` (`CVE_PRENDA`);

--
-- Filtros para la tabla `citas`
--
ALTER TABLE `citas`
  ADD CONSTRAINT `FK_CITAS_REFERENCE_CLIENTE` FOREIGN KEY (`CVE_CLIENTE`) REFERENCES `cliente` (`CVE_CLIENTE`);

--
-- Filtros para la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD CONSTRAINT `FK_CLIENTE_REFERENCE_MEDIDAS` FOREIGN KEY (`CVE_MEDIDAS`) REFERENCES `medidas` (`CVE_MEDIDAS`),
  ADD CONSTRAINT `FK_CLIENTE_REFERENCE_PERSONA` FOREIGN KEY (`CVE_PERSONA`) REFERENCES `persona` (`CVE_PERSONA`);

--
-- Filtros para la tabla `detalle_ventas`
--
ALTER TABLE `detalle_ventas`
  ADD CONSTRAINT `FK_DETALLE__REFERENCE_PRENDA` FOREIGN KEY (`CVE_PRENDA`) REFERENCES `prenda` (`CVE_PRENDA`),
  ADD CONSTRAINT `FK_DETALLE__REFERENCE_VENTAS` FOREIGN KEY (`CVE_VENTAS`) REFERENCES `ventas` (`CVE_VENTAS`);

--
-- Filtros para la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD CONSTRAINT `FK_PEDIDOS_REFERENCE_CLIENTE` FOREIGN KEY (`CVE_CLIENTE`) REFERENCES `cliente` (`CVE_CLIENTE`),
  ADD CONSTRAINT `FK_PEDIDOS_REFERENCE_VENTAS` FOREIGN KEY (`CVE_VENTAS`) REFERENCES `ventas` (`CVE_VENTAS`);

--
-- Filtros para la tabla `prenda`
--
ALTER TABLE `prenda`
  ADD CONSTRAINT `FK_PRENDA_REFERENCE_TALLAS` FOREIGN KEY (`CVE_TALLAS`) REFERENCES `tallas` (`CVE_TALLAS`);

--
-- Filtros para la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD CONSTRAINT `FK_VENTAS_REFERENCE_CLIENTE` FOREIGN KEY (`CVE_CLIENTE`) REFERENCES `cliente` (`CVE_CLIENTE`);
COMMIT;

