-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 17-03-2024 a las 04:57:05
-- Versión del servidor: 10.4.24-MariaDB
-- Versión de PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `app_web`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `actividades`
--

CREATE TABLE `actividades` (
  `codigo_actividad` int(10) NOT NULL,
  `nombre_actividad` varchar(50) NOT NULL,
  `descripcion_actividad` varchar(100) DEFAULT NULL,
  `tipo_actividad` enum('Fuerza','Aerobics','Flexibilidad','Resistencia','Combate') NOT NULL,
  `requisitos_actividad` varchar(100) DEFAULT NULL,
  `estado_actividad` enum('Disponible','Inactiva') NOT NULL,
  `objetivos_actividad` varchar(100) DEFAULT NULL,
  `area_actividad` varchar(50) DEFAULT NULL,
  `foto_actividad` varchar(300) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `actividades`
--

INSERT INTO `actividades` (`codigo_actividad`, `nombre_actividad`, `descripcion_actividad`, `tipo_actividad`, `requisitos_actividad`, `estado_actividad`, `objetivos_actividad`, `area_actividad`, `foto_actividad`) VALUES
(1010, 'Entrenamiento de Fuerza', 'Rutina de levantamiento de pesas', 'Fuerza', 'Experiencia previa en ejercicios de fuerza', 'Disponible', 'Aumentar la masa muscular', 'Gimnasio', '../../uploads/users/service-1.jpg'),
(1011, 'Clase de Aerobics', 'Rutina de cardio con música enérgica', 'Aerobics', 'Ropa cómoda y zapatillas deportivas', 'Disponible', 'Mejorar la resistencia cardiovascular', 'Aeróbicos', '../../uploads/users/grupo-pilates-trabajando-gimnasio.jpg'),
(1012, 'Yoga para Flexibilidad', 'Sesión de yoga centrada en estiramientos', 'Flexibilidad', 'Ropa cómoda y esterilla de yoga', 'Disponible', 'Aumentar la flexibilidad y relajación', 'Yoga', '../../uploads/users/chica-guapa-dedica-gimnasio.jpg'),
(1013, 'Carrera de Resistencia', 'Carrera larga en terreno variado', 'Resistencia', 'Zapatillas adecuadas y hidratación', 'Disponible', 'Mejorar la resistencia cardiovascular', 'Pista', '../../uploads/users/featured3.png'),
(1014, 'Entrenamiento de Combate', 'Clase de artes marciales y combate', 'Combate', 'Equipo de protección y vestimenta adecuada', 'Disponible', 'Desarrollar habilidades de autodefensa', 'Gimnasio', '../../uploads/users/featured2.png'),
(1015, 'Clase de Ciclismo Indoor', 'Sesión de ciclismo en bicicletas estáticas', 'Aerobics', 'Ropa cómoda y botella de agua', 'Disponible', 'Mejorar la resistencia cardiovascular', 'Sala de Ciclismo', '../../uploads/users/featured1.png'),
(1016, 'Body Pump', 'Clase de entrenamiento de fuerza utilizando barras y pesas', 'Fuerza', 'Experiencia previa en ejercicios de fuerza recomendada', 'Disponible', 'Mejorar la fuerza y la resistencia muscular', 'Gimnasio', '../../uploads/users/gallery-07.jpg'),
(1017, 'Pilates', 'Clase de Pilates que se enfoca en el fortalecimiento y la flexibilidad', 'Flexibilidad', 'Experiencia previa en Pilates recomendada', 'Disponible', 'Mejorar la flexibilidad y la fuerza del núcleo', 'Estudio de Pilates', '../../uploads/users/pilates.jpg');

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `clientes`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `clientes` (
`id_usuario` bigint(12)
,`tipo_documento_usuario` enum('CC','CE','PASAPORTE')
,`nombres_usuario` varchar(50)
,`apellidos_usuario` varchar(50)
,`fecha_nacimiento_usuario` date
,`email_usuario` varchar(50)
,`telefono_usuario` bigint(12)
,`estado_usuario` enum('Activo','Inactivo')
,`rol_usuario` varchar(50)
,`clavemd` varchar(200)
,`foto_usuario` varchar(300)
);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compras_pedidos`
--

CREATE TABLE `compras_pedidos` (
  `codigo_compra_proveedor` int(10) NOT NULL,
  `fecha_entrega_proveedor` date NOT NULL,
  `hora_entrega_proveedor` time NOT NULL,
  `metodo_pago_proveedor` enum('Efectivo') NOT NULL,
  `estado_pedido_proveedor` enum('Comprado','Enviado','Entregado','Devuelto','Cancelado') NOT NULL,
  `forma_entrega_proveedor` enum('Enviar a domicilio') NOT NULL,
  `direccion_gimnasio` varchar(200) NOT NULL,
  `codigo_producto` int(10) NOT NULL,
  `id_usuario` bigint(12) NOT NULL,
  `precio_pedido_proveedor` decimal(10,2) NOT NULL,
  `cantidad_pedido_proveedor` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `compras_pedidos`
--

INSERT INTO `compras_pedidos` (`codigo_compra_proveedor`, `fecha_entrega_proveedor`, `hora_entrega_proveedor`, `metodo_pago_proveedor`, `estado_pedido_proveedor`, `forma_entrega_proveedor`, `direccion_gimnasio`, `codigo_producto`, `id_usuario`, `precio_pedido_proveedor`, `cantidad_pedido_proveedor`) VALUES
(13, '2024-01-19', '14:30:00', 'Efectivo', 'Comprado', 'Enviar a domicilio', 'Cra 10c # 49f - 98 sur', 3010, 1000000001, '252988.50', 1),
(14, '2024-01-22', '10:10:00', 'Efectivo', 'Comprado', 'Enviar a domicilio', 'Cra 10c # 49f - 98 sur', 3011, 1000000002, '288122.15', 1),
(15, '2024-01-22', '13:00:00', 'Efectivo', 'Comprado', 'Enviar a domicilio', 'Cra 10c # 49f - 98 sur', 3012, 1000000003, '523250.00', 1),
(16, '2024-01-22', '23:39:00', 'Efectivo', 'Comprado', 'Enviar a domicilio', 'Cra 10c # 49f - 98 sur', 3013, 1000000001, '187335.00', 1),
(17, '2024-01-19', '20:47:00', 'Efectivo', 'Comprado', 'Enviar a domicilio', 'Cra10c #49f - 98 sur', 3015, 1000000002, '161000.00', 1),
(18, '2024-01-22', '15:06:00', 'Efectivo', 'Comprado', 'Enviar a domicilio', 'Cra10 c #49f - 98 sur', 3013, 1000000002, '187335.00', 1),
(19, '2024-01-27', '13:10:00', 'Efectivo', 'Comprado', 'Enviar a domicilio', 'Cra 10c #49f - 98 sur', 3015, 1000000003, '161000.00', 1);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `entrenadores`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `entrenadores` (
`id_usuario` bigint(12)
,`tipo_documento_usuario` enum('CC','CE','PASAPORTE')
,`nombres_usuario` varchar(50)
,`apellidos_usuario` varchar(50)
,`fecha_nacimiento_usuario` date
,`email_usuario` varchar(50)
,`telefono_usuario` bigint(12)
,`estado_usuario` enum('Activo','Inactivo')
,`rol_usuario` varchar(50)
,`clavemd` varchar(200)
,`foto_usuario` varchar(300)
);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inscripciones_libres`
--

CREATE TABLE `inscripciones_libres` (
  `codigo_inscripcion_libre` int(10) NOT NULL,
  `fecha_inicio_actividad` date NOT NULL,
  `hora_inicio_actividad` time NOT NULL,
  `estado_inscripcion_libre` enum('Programada','Finalizada') NOT NULL,
  `comentarios_inscripcion_libre` varchar(100) DEFAULT NULL,
  `codigo_actividad` int(10) NOT NULL,
  `codigo_venta_plan` int(10) NOT NULL,
  `id_usuario` bigint(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `inscripciones_libres`
--

INSERT INTO `inscripciones_libres` (`codigo_inscripcion_libre`, `fecha_inicio_actividad`, `hora_inicio_actividad`, `estado_inscripcion_libre`, `comentarios_inscripcion_libre`, `codigo_actividad`, `codigo_venta_plan`, `id_usuario`) VALUES
(1, '2024-01-22', '20:01:00', 'Programada', 'LLegar puntual al sitio previo', 1010, 5, 1033773831),
(3, '2024-01-21', '13:30:00', 'Programada', 'Inscripcion programada', 1013, 6, 1022478452);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inscripciones_personalizadas`
--

CREATE TABLE `inscripciones_personalizadas` (
  `codigo_inscripcion_perso` int(10) NOT NULL,
  `fecha_inicio_actividad` date NOT NULL,
  `hora_inicio_actividad` time NOT NULL,
  `estado_inscripcion_perso` enum('Programada','Asistio','No Asistio','Finalizada') NOT NULL,
  `comentarios_inscripcion_perso` varchar(100) DEFAULT NULL,
  `codigo_actividad` int(10) NOT NULL,
  `codigo_venta_plan` int(10) NOT NULL,
  `id_usuario` bigint(12) NOT NULL,
  `id_entrenador` bigint(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `inscripciones_personalizadas`
--

INSERT INTO `inscripciones_personalizadas` (`codigo_inscripcion_perso`, `fecha_inicio_actividad`, `hora_inicio_actividad`, `estado_inscripcion_perso`, `comentarios_inscripcion_perso`, `codigo_actividad`, `codigo_venta_plan`, `id_usuario`, `id_entrenador`) VALUES
(1, '2024-01-23', '10:30:00', 'Programada', 'Actividad programada', 1010, 5, 1033773831, 1044578412),
(2, '2024-01-24', '10:00:00', 'Programada', 'Actividad programada', 1012, 5, 1033773831, 1752149632);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pagos_entrenadores`
--

CREATE TABLE `pagos_entrenadores` (
  `codigo_pago_entrenador` int(10) NOT NULL,
  `fecha_pago_entrenador` date NOT NULL,
  `hora_pago_entrenador` time NOT NULL,
  `metodo_pago_entrenador` enum('Tarjeta de Credito','Tarjeta de Debito','Transferencia desde un banco con PSE','Pago  en efectivo con Efecty') NOT NULL,
  `precio_final_pago_entrenador` int(10) NOT NULL,
  `estado_pago_entrenador` enum('Aprobado','Completado','Cancelado') NOT NULL,
  `id_entrenador` bigint(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `planes`
--

CREATE TABLE `planes` (
  `codigo_plan` int(10) NOT NULL,
  `nombre_plan` varchar(50) NOT NULL,
  `descripcion_plan` varchar(100) DEFAULT NULL,
  `precio_plan` int(10) NOT NULL,
  `porcentaje_ganancia_plan` decimal(10,2) NOT NULL,
  `precio_final_plan` decimal(10,2) NOT NULL,
  `duracion_plan` varchar(10) NOT NULL,
  `acceso_servicios_plan` text NOT NULL,
  `restricciones_plan` text NOT NULL,
  `estado_plan` enum('Disponible','Inactivo','Pausado') NOT NULL,
  `descuentos_plan` varchar(100) DEFAULT NULL,
  `categoria_plan` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `planes`
--

INSERT INTO `planes` (`codigo_plan`, `nombre_plan`, `descripcion_plan`, `precio_plan`, `porcentaje_ganancia_plan`, `precio_final_plan`, `duracion_plan`, `acceso_servicios_plan`, `restricciones_plan`, `estado_plan`, `descuentos_plan`, `categoria_plan`) VALUES
(2025, 'Platino', 'Experiencia premium de bienestar', 100000, '0.15', '115000.00', '2 Meses', 'Acceso exclusivo a todas las áreas y entrenador personal', 'Reservas prioritarias', 'Disponible', 'Descuento de 20%', 'Premium'),
(2026, 'Oro', 'Acceso completo a todas las áreas', 80000, '0.15', '92000.00', '1 Mes', 'Acceso total a instalaciones y clases, incluye entrenador personal', 'Ninguno', 'Disponible', 'Descuento de 10%', 'Premium'),
(2027, 'Plata', 'Acceso a instalaciones básicas', 50000, '0.15', '57500.00', '1 Mes', 'Acceso a áreas de entrenamiento', 'No válido para clases premium', 'Disponible', 'Sin descuento adicional %0', 'Estandar'),
(2028, 'Principiante', 'Acceso a instalaciones básicas', 50000, '0.15', '57500.00', '1 Mes', 'Acceso a áreas de entrenamiento', 'No válido para clases premium', 'Disponible', 'Sin descuento adicional %0', 'Estandar');

--
-- Disparadores `planes`
--
DELIMITER $$
CREATE TRIGGER `actualizar_precio_final` BEFORE UPDATE ON `planes` FOR EACH ROW BEGIN
    IF NEW.porcentaje_ganancia_plan <> OLD.porcentaje_ganancia_plan THEN
        SET NEW.precio_final_plan = ROUND(NEW.precio_plan + (NEW.precio_plan * NEW.porcentaje_ganancia_plan), 2);
    END IF;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `calcular_precio_final_insert` BEFORE INSERT ON `planes` FOR EACH ROW BEGIN
    SET NEW.precio_final_plan = ROUND(NEW.precio_plan + (NEW.precio_plan * NEW.porcentaje_ganancia_plan), 2);
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `codigo_producto` int(10) NOT NULL,
  `nombre_producto` varchar(50) NOT NULL,
  `descripcion_producto` varchar(100) DEFAULT NULL,
  `cantidad_productos_disponibles` int(10) NOT NULL,
  `fecha_vencimiento_producto` date DEFAULT NULL,
  `categoria_producto` enum('Nutricion Deportiva','Accesorios de Entrenamiento','Ropa Deportiva') NOT NULL,
  `marca_producto` varchar(50) NOT NULL,
  `estado_producto` enum('Disponible','Agotado') NOT NULL,
  `precio_inicial_producto` int(10) NOT NULL,
  `porcentaje_ganancia_producto` decimal(10,2) NOT NULL,
  `precio_final_producto` decimal(10,2) NOT NULL,
  `foto_producto` varchar(300) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`codigo_producto`, `nombre_producto`, `descripcion_producto`, `cantidad_productos_disponibles`, `fecha_vencimiento_producto`, `categoria_producto`, `marca_producto`, `estado_producto`, `precio_inicial_producto`, `porcentaje_ganancia_producto`, `precio_final_producto`, `foto_producto`) VALUES
(3010, 'Pesas', 'Pesas de Gimnasio 25kg', 1, '0000-00-00', 'Accesorios de Entrenamiento', 'Rogue Fitness', 'Disponible', 219990, '0.15', '252988.50', '../../uploads/users/mancuernas-suelo-gimnasio-ai-generativo.jpg'),
(3011, 'Mancuernas', 'Mancuernas para gimnasio', 1, '0000-00-00', 'Accesorios de Entrenamiento', 'Life Fitness', 'Disponible', 250541, '0.15', '288122.15', '../../uploads/users/arreglo-mancuernas-gimnasio.jpg'),
(3012, 'Zapatillas deportivas', 'Zapatillas para deportistas', 1, '0000-00-00', 'Ropa Deportiva', 'Nike', 'Disponible', 455000, '0.15', '523250.00', '../../uploads/users/Zapatillas.jpg'),
(3013, 'Guantes de Boxeo', 'Guantes de Cuero Sintetico', 1, '0000-00-00', 'Accesorios de Entrenamiento', 'Rival Boxing', 'Disponible', 162900, '0.15', '187335.00', '../../uploads/users/par-guantes-deporte-boxeo.jpg'),
(3014, 'Cinturón de Levantamiento', 'Cinturón de levantamiento', 1, '0000-00-00', 'Accesorios de Entrenamiento', 'Beast gear', 'Disponible', 269581, '0.15', '310018.15', '../../uploads/users/cinturon.jpg'),
(3015, 'Proteína', 'Suplemento de proteína en polvo', 1, '0000-00-00', 'Nutricion Deportiva', 'Intenze', 'Disponible', 140000, '0.15', '161000.00', '../../uploads/users/Proteinaintenze.jpg'),
(3016, 'Mancuernas', 'Mancuernas para gimnasio', 1, '0000-00-00', 'Accesorios de Entrenamiento', 'Rogue Fitness', 'Disponible', 250541, '0.15', '288122.15', '../../uploads/users/MancuernasFont.jpg');

--
-- Disparadores `productos`
--
DELIMITER $$
CREATE TRIGGER `actualizar_precio_producto_update` BEFORE UPDATE ON `productos` FOR EACH ROW BEGIN
	IF NEW.porcentaje_ganancia_producto <> OLD.porcentaje_ganancia_producto THEN 
		SET NEW.precio_final_producto = ROUND(NEW.precio_inicial_producto + (NEW.precio_inicial_producto * NEW.porcentaje_ganancia_producto), 2);
	END IF;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `calcular_precio_producto_insert` BEFORE INSERT ON `productos` FOR EACH ROW BEGIN
	SET NEW.precio_final_producto = ROUND(NEW.precio_inicial_producto + (NEW.precio_inicial_producto * NEW.porcentaje_ganancia_producto), 2);
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `proveedores`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `proveedores` (
`id_usuario` bigint(12)
,`tipo_documento_usuario` enum('CC','CE','PASAPORTE')
,`nombres_usuario` varchar(50)
,`apellidos_usuario` varchar(50)
,`fecha_nacimiento_usuario` date
,`email_usuario` varchar(50)
,`telefono_usuario` bigint(12)
,`estado_usuario` enum('Activo','Inactivo')
,`rol_usuario` varchar(50)
,`clavemd` varchar(200)
,`foto_usuario` varchar(300)
);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` bigint(12) NOT NULL,
  `tipo_documento_usuario` enum('CC','CE','PASAPORTE') NOT NULL,
  `nombres_usuario` varchar(50) NOT NULL,
  `apellidos_usuario` varchar(50) NOT NULL,
  `fecha_nacimiento_usuario` date NOT NULL,
  `email_usuario` varchar(50) NOT NULL,
  `telefono_usuario` bigint(12) NOT NULL,
  `estado_usuario` enum('Activo','Inactivo') NOT NULL,
  `rol_usuario` varchar(50) NOT NULL,
  `clavemd` varchar(200) NOT NULL,
  `foto_usuario` varchar(300) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `tipo_documento_usuario`, `nombres_usuario`, `apellidos_usuario`, `fecha_nacimiento_usuario`, `email_usuario`, `telefono_usuario`, `estado_usuario`, `rol_usuario`, `clavemd`, `foto_usuario`) VALUES
(1000000001, 'CC', 'Sebastian', 'Jimenez Carvajal', '1998-09-18', 'sebastian@gymsoftsolutions@gmail.com', 3145678021, 'Activo', 'Proveedor', '$2y$10$2gmWlH24Y7txHqwl1o2/veFxdj8DpXsFKz2dIpU7gzlMa/Q.4kvJG', '../../uploads/users/sebas.jpg'),
(1000000002, 'CC', 'Alejandro ', 'Jimenez Bejarano', '1997-05-22', 'alejandro_jimenez@gymsoftsolutions@gmail.com', 3217412541, 'Activo', 'Proveedor', '$2y$10$2Ei9uf9xvbOsaixu7.yCYe0xUrH9eP3tw4wbfx3w9EkdXwP7UY/Ci', '../../uploads/users/ProfileMen.png'),
(1000000003, 'CC', 'Cindy Lorena', 'Manrique Castro', '1995-07-29', 'cindy_manrique@gymsoftsolutions@gmail.com', 3145678021, 'Activo', 'Proveedor', '$2y$10$bEHu2W1/Q0.OYMjjC6o28eyXsi07q.JsgHPwUz2MlhRRfxnKAXbCq', '../../uploads/users/ProfileLady.jpg'),
(1022457841, 'CC', 'Duver Alejandro', 'Baquero Silva', '1998-06-15', 'duver_alejandro@gmail.com', 3145784787, 'Activo', 'Cliente', '$2y$10$wO.KRBY337HSCPcB0sVwSeE3PEpYk.eTC/eNrjx2wZWpePtNok9jS', '../../uploads/users/disparo-alta-vista-hombre-sonriente-gorra.jpg'),
(1022478452, 'CC', 'Guillermo andres', 'Nova Forero', '1995-12-28', 'guillermo_nova@gmail.com', 3215871085, 'Activo', 'Cliente', '$2y$10$oXDfmpui4YdnGbNT6XWhSO4SVQjZjQsTA.0hVXb5KjeUlAZM1TZFe', '../../uploads/users/site-reliability-engineer.jpg'),
(1022478458, 'CC', 'Claudia Marcela', 'Hernandez Amaya', '1997-05-14', 'claudia_marcela@gmail.com', 3217784150, 'Activo', 'Cliente', '$2y$10$.3kOi0q76CcRGwde3f9LT.d8apX2/rzF.khUPLieuEKoGRNYSaJCu', '../../uploads/users/vista-frontal-sonriente-mujer-posando.jpg'),
(1033478521, 'CC', 'Fabian Oswaldo', 'Toro Hernandez', '1998-08-14', 'fabia_xt_20086@gmail.com', 3232316423, 'Activo', 'Cliente', '$2y$10$jahhVfQhj3J5bbdcEuLVguG2KpfYJhkWY8Amjih9vVn1Qf4mRH/PG', '../../uploads/users/team-2.jpg'),
(1033773831, 'CC', 'Danny Steban', 'Toro Hernandez', '1995-03-22', 'danny.toro.1995@gmail.com', 3217799030, 'Activo', 'Administrador', '$2y$10$E9TZs2EN3JO0rykZKB/eR.ggt6GQUN5Xxaxc1V8wMGs0wkpC6UO6C', '../../uploads/users/IMG_20230107_174203.jpg'),
(1044514784, 'CC', 'Andres Camilo', 'Miranda Ortiz', '1995-06-14', 'andres.camilo.ortiz@gmail.com', 3231478745, 'Activo', 'Cliente', '$2y$10$YecsbfQ19nVjt6hXOt2UjuWRumfuOroWESkwwi.HcT61XLPK7EEAK', '../../uploads/users/bg-5.jpg'),
(1044578412, 'CC', 'Edwin Alexander', 'Huertas Hernandez', '1989-08-18', 'alex_edwin@gmail.com', 3234786425, 'Activo', 'Entrenador', '$2y$10$OlU3blAA8WH7M8uQmCBhwuBUFfSSFew0GqjviVakue.eeVlJzeAxO', '../../uploads/users/team-3.jpg'),
(1044587965, 'CC', 'Deysi Johana', 'Patiño Diaz', '1996-05-14', 'desysi_diaz@gmail.com', 3104289014, 'Activo', 'Entrenador', '$2y$10$wgs45jSgESxYbfnN0lSXouISL19dBygsRo9YWtpgZsss4Y8JwJWye', '../../uploads/users/team-4.jpg'),
(1044782014, 'CC', 'Cristian David', 'Molano Torres', '1996-05-14', 'cristian_molano@mail.com', 3145678956, 'Activo', 'Entrenador', '$2y$10$zAu05JnXztW81tpqxRJEmupYtQG0J.kQUJAWdcI99e4beRQKbN73S', '../../uploads/users/team-1.jpg'),
(1044784254, 'CC', 'Ana Maria', 'Hernandez Amaya', '1998-06-15', 'dstoro1@misena.edu.co', 3145678450, 'Activo', 'Administrador', '$2y$10$dj0fCMfD1Sa2R7USvJBWne.64mAGIUauksv9wTNB7CTJ.dE6ZYwS2', '../../uploads/users/mujer-sonriendo.jpg'),
(1045279145, 'CC', 'Andres Felipe', 'Lago Enciso', '1999-09-22', 'andres_felipeLago@gmail.com', 3232316423, 'Activo', 'Entrenador', '$2y$10$bTyXsSBJcp5bShj7U55Xp.m0MmJKSA.bSsITGAnYrvUkFCRKzuxPO', '../../uploads/users/boxer-masculino-posando-camiseta-brazos-cruzados.jpg'),
(1047589423, 'CC', 'Laura Daniela', 'Vasquez Pedraza', '1998-09-23', 'daniela_123@gmail.com', 3145678495, 'Activo', 'Entrenador', '$2y$10$KH3/5ZBPwVSznL3S0NtNlu/4xHlZ.UP6u5ChWPLI0CSecTwz.HjUu', '../../uploads/users/entrenador3.jpg'),
(1047842598, 'CC', 'Diego Arbey', 'Diaz Jaramillo', '1995-05-15', 'diego_diaz@gmail.com', 3051786080, 'Activo', 'Entrenador', '$2y$10$K45t1N1FPW5S2rik88m2uOQx2C0vb5rV6J1ga7a2eImUTlVBhzKJq', '../../uploads/users/imagen1.jpg'),
(1055478412, 'CC', 'Oscar Ivan', 'Cepeda Hernandez', '1992-02-10', 'oscar_cepeda123@gmail.com', 3232316423, 'Activo', 'Cliente', '$2y$10$79/a7/q0X2wyLYEChgAXmurzJj71vgUyke34DQSKBQg1pKQFxqhiy', '../../uploads/users/service-6.jpg'),
(1055478941, 'CC', 'Andrea Liseth', 'Mendoza Castro', '1998-06-15', 'andrea_mendoza@gmail.com', 3217799030, 'Activo', 'Cliente', '$2y$10$s07owapuVhvvDq/qKh3Ax.xCC6hnwDz1C/mSCfu8XMEBbDFWBvt1G', '../../uploads/users/mujer-joven.jpg'),
(1074589412, 'CC', 'Lorena Yamileth', 'Ramirez Valero', '1992-03-15', 'lorena_ramirez@gmail.com', 3217584068, 'Activo', 'Entrenador', '$2y$10$o8g3y9XA0ltqc9KcQUrYM.4FDH6hhCmOMJ26UNJTImV9QvaIQkXcW', '../../uploads/users/entrenadora5.jpg'),
(1077845982, 'CE', 'Pedro Leon', 'Duarte Jimenez', '1995-03-25', 'pedro_leon@gmail.com', 3232316423, 'Activo', 'Entrenador', '$2y$10$Neqh0QuoesLNh24sXmOkFehQNm9USxV0CkyGjQWkEE3z7O1oaiXfG', '../../uploads/users/hombre-forma-vista-frontal-pesas.jpg'),
(1752149632, 'CC', 'Angie Tatiana', 'Pulido Ruiz', '1999-02-06', 'angie_pulido@gmail.com', 3145678956, 'Activo', 'Entrenador', '$2y$10$CLYwadYluSKrGKUsrsUrpOYUjQF7uA0swk1zF0.r5p9Efi1w7qGQq', '../../uploads/users/entrenadora6.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas_pedidos`
--

CREATE TABLE `ventas_pedidos` (
  `codigo_venta_producto` int(10) NOT NULL,
  `fecha_entrega_cliente` date NOT NULL,
  `hora_entrega_cliente` time NOT NULL,
  `metodo_pago_cliente` enum('Efectivo') NOT NULL,
  `estado_pedido_cliente` enum('Comprado','Enviado','Entregado','Devuelto','Cancelado') NOT NULL,
  `forma_entrega_cliente` enum('Enviar a domicilio') NOT NULL,
  `direccion_residencia` varchar(200) NOT NULL,
  `codigo_producto` int(10) NOT NULL,
  `id_usuario` bigint(12) NOT NULL,
  `precio_pedido_cliente` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `ventas_pedidos`
--

INSERT INTO `ventas_pedidos` (`codigo_venta_producto`, `fecha_entrega_cliente`, `hora_entrega_cliente`, `metodo_pago_cliente`, `estado_pedido_cliente`, `forma_entrega_cliente`, `direccion_residencia`, `codigo_producto`, `id_usuario`, `precio_pedido_cliente`) VALUES
(3, '2024-01-24', '19:42:00', 'Efectivo', 'Comprado', 'Enviar a domicilio', 'Cra 10 # 78 - 21', 3010, 1033773831, '252988.50'),
(4, '2024-01-19', '09:30:00', 'Efectivo', 'Enviado', 'Enviar a domicilio', 'Cll 137 sur #3a - 44 int 6 casa 44', 3012, 1033478521, '523250.00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas_planes`
--

CREATE TABLE `ventas_planes` (
  `codigo_venta_plan` int(10) NOT NULL,
  `fecha_entrega_plan` date NOT NULL,
  `hora_entrega_plan` time NOT NULL,
  `metodo_pago_plan` enum('Efectivo') NOT NULL,
  `estado_venta_plan` enum('Comprado','Enviado','Entregado','Devuelto','Vencido') NOT NULL,
  `forma_entrega` enum('Enviar a domicilio') NOT NULL,
  `direccion_entrega` varchar(200) NOT NULL,
  `codigo_plan` int(10) NOT NULL,
  `id_usuario` bigint(12) NOT NULL,
  `precio_venta_plan` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `ventas_planes`
--

INSERT INTO `ventas_planes` (`codigo_venta_plan`, `fecha_entrega_plan`, `hora_entrega_plan`, `metodo_pago_plan`, `estado_venta_plan`, `forma_entrega`, `direccion_entrega`, `codigo_plan`, `id_usuario`, `precio_venta_plan`) VALUES
(5, '2024-01-15', '13:00:00', 'Efectivo', 'Comprado', 'Enviar a domicilio', 'Cra10c #49f - 98 sur', 2025, 1033773831, '115000.00'),
(6, '2024-01-15', '22:00:00', 'Efectivo', 'Comprado', 'Enviar a domicilio', 'Calle137 sur #3a-44 sur', 2026, 1022478452, '92000.00'),
(7, '2024-01-15', '18:32:00', 'Efectivo', 'Comprado', 'Enviar a domicilio', 'Cll137 sur # 78b - 57', 2027, 1022478458, '57500.00'),
(8, '2024-01-19', '13:14:00', 'Efectivo', 'Enviado', 'Enviar a domicilio', 'Cra7 # 100 - 24a', 2026, 1033478521, '92000.00');

-- --------------------------------------------------------

--
-- Estructura para la vista `clientes`
--
DROP TABLE IF EXISTS `clientes`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `clientes`  AS SELECT `usuarios`.`id_usuario` AS `id_usuario`, `usuarios`.`tipo_documento_usuario` AS `tipo_documento_usuario`, `usuarios`.`nombres_usuario` AS `nombres_usuario`, `usuarios`.`apellidos_usuario` AS `apellidos_usuario`, `usuarios`.`fecha_nacimiento_usuario` AS `fecha_nacimiento_usuario`, `usuarios`.`email_usuario` AS `email_usuario`, `usuarios`.`telefono_usuario` AS `telefono_usuario`, `usuarios`.`estado_usuario` AS `estado_usuario`, `usuarios`.`rol_usuario` AS `rol_usuario`, `usuarios`.`clavemd` AS `clavemd`, `usuarios`.`foto_usuario` AS `foto_usuario` FROM `usuarios` WHERE `usuarios`.`rol_usuario` = 'Cliente''Cliente'  ;

-- --------------------------------------------------------

--
-- Estructura para la vista `entrenadores`
--
DROP TABLE IF EXISTS `entrenadores`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `entrenadores`  AS SELECT `usuarios`.`id_usuario` AS `id_usuario`, `usuarios`.`tipo_documento_usuario` AS `tipo_documento_usuario`, `usuarios`.`nombres_usuario` AS `nombres_usuario`, `usuarios`.`apellidos_usuario` AS `apellidos_usuario`, `usuarios`.`fecha_nacimiento_usuario` AS `fecha_nacimiento_usuario`, `usuarios`.`email_usuario` AS `email_usuario`, `usuarios`.`telefono_usuario` AS `telefono_usuario`, `usuarios`.`estado_usuario` AS `estado_usuario`, `usuarios`.`rol_usuario` AS `rol_usuario`, `usuarios`.`clavemd` AS `clavemd`, `usuarios`.`foto_usuario` AS `foto_usuario` FROM `usuarios` WHERE `usuarios`.`rol_usuario` = 'Entrenador''Entrenador'  ;

-- --------------------------------------------------------

--
-- Estructura para la vista `proveedores`
--
DROP TABLE IF EXISTS `proveedores`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `proveedores`  AS SELECT `usuarios`.`id_usuario` AS `id_usuario`, `usuarios`.`tipo_documento_usuario` AS `tipo_documento_usuario`, `usuarios`.`nombres_usuario` AS `nombres_usuario`, `usuarios`.`apellidos_usuario` AS `apellidos_usuario`, `usuarios`.`fecha_nacimiento_usuario` AS `fecha_nacimiento_usuario`, `usuarios`.`email_usuario` AS `email_usuario`, `usuarios`.`telefono_usuario` AS `telefono_usuario`, `usuarios`.`estado_usuario` AS `estado_usuario`, `usuarios`.`rol_usuario` AS `rol_usuario`, `usuarios`.`clavemd` AS `clavemd`, `usuarios`.`foto_usuario` AS `foto_usuario` FROM `usuarios` WHERE `usuarios`.`rol_usuario` = 'Proveedor''Proveedor'  ;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `actividades`
--
ALTER TABLE `actividades`
  ADD PRIMARY KEY (`codigo_actividad`);

--
-- Indices de la tabla `compras_pedidos`
--
ALTER TABLE `compras_pedidos`
  ADD PRIMARY KEY (`codigo_compra_proveedor`),
  ADD KEY `codigo_producto` (`codigo_producto`),
  ADD KEY `id_proveedor` (`id_usuario`);

--
-- Indices de la tabla `inscripciones_libres`
--
ALTER TABLE `inscripciones_libres`
  ADD PRIMARY KEY (`codigo_inscripcion_libre`),
  ADD KEY `codigo_actividad` (`codigo_actividad`),
  ADD KEY `codigo_venta_plan` (`codigo_venta_plan`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `inscripciones_personalizadas`
--
ALTER TABLE `inscripciones_personalizadas`
  ADD PRIMARY KEY (`codigo_inscripcion_perso`),
  ADD KEY `codigo_actividad` (`codigo_actividad`),
  ADD KEY `codigo_venta_plan` (`codigo_venta_plan`),
  ADD KEY `id_cliente` (`id_usuario`),
  ADD KEY `id_entrenador` (`id_entrenador`);

--
-- Indices de la tabla `pagos_entrenadores`
--
ALTER TABLE `pagos_entrenadores`
  ADD PRIMARY KEY (`codigo_pago_entrenador`),
  ADD KEY `id_entrenador` (`id_entrenador`);

--
-- Indices de la tabla `planes`
--
ALTER TABLE `planes`
  ADD PRIMARY KEY (`codigo_plan`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`codigo_producto`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`);

--
-- Indices de la tabla `ventas_pedidos`
--
ALTER TABLE `ventas_pedidos`
  ADD PRIMARY KEY (`codigo_venta_producto`),
  ADD KEY `codigo_producto` (`codigo_producto`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `ventas_planes`
--
ALTER TABLE `ventas_planes`
  ADD PRIMARY KEY (`codigo_venta_plan`),
  ADD KEY `codigo_plan` (`codigo_plan`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `compras_pedidos`
--
ALTER TABLE `compras_pedidos`
  MODIFY `codigo_compra_proveedor` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de la tabla `inscripciones_libres`
--
ALTER TABLE `inscripciones_libres`
  MODIFY `codigo_inscripcion_libre` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `inscripciones_personalizadas`
--
ALTER TABLE `inscripciones_personalizadas`
  MODIFY `codigo_inscripcion_perso` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `pagos_entrenadores`
--
ALTER TABLE `pagos_entrenadores`
  MODIFY `codigo_pago_entrenador` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `ventas_pedidos`
--
ALTER TABLE `ventas_pedidos`
  MODIFY `codigo_venta_producto` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `ventas_planes`
--
ALTER TABLE `ventas_planes`
  MODIFY `codigo_venta_plan` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `compras_pedidos`
--
ALTER TABLE `compras_pedidos`
  ADD CONSTRAINT `compras_pedidos_ibfk_1` FOREIGN KEY (`codigo_producto`) REFERENCES `productos` (`codigo_producto`),
  ADD CONSTRAINT `compras_pedidos_ibfk_2` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`);

--
-- Filtros para la tabla `inscripciones_libres`
--
ALTER TABLE `inscripciones_libres`
  ADD CONSTRAINT `inscripciones_libres_ibfk_1` FOREIGN KEY (`codigo_actividad`) REFERENCES `actividades` (`codigo_actividad`),
  ADD CONSTRAINT `inscripciones_libres_ibfk_2` FOREIGN KEY (`codigo_venta_plan`) REFERENCES `ventas_planes` (`codigo_venta_plan`),
  ADD CONSTRAINT `inscripciones_libres_ibfk_3` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`);

--
-- Filtros para la tabla `inscripciones_personalizadas`
--
ALTER TABLE `inscripciones_personalizadas`
  ADD CONSTRAINT `inscripciones_personalizadas_ibfk_1` FOREIGN KEY (`codigo_actividad`) REFERENCES `actividades` (`codigo_actividad`),
  ADD CONSTRAINT `inscripciones_personalizadas_ibfk_2` FOREIGN KEY (`codigo_venta_plan`) REFERENCES `ventas_planes` (`codigo_venta_plan`),
  ADD CONSTRAINT `inscripciones_personalizadas_ibfk_3` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`),
  ADD CONSTRAINT `inscripciones_personalizadas_ibfk_4` FOREIGN KEY (`id_entrenador`) REFERENCES `usuarios` (`id_usuario`);

--
-- Filtros para la tabla `pagos_entrenadores`
--
ALTER TABLE `pagos_entrenadores`
  ADD CONSTRAINT `pagos_entrenadores_ibfk_1` FOREIGN KEY (`id_entrenador`) REFERENCES `usuarios` (`id_usuario`);

--
-- Filtros para la tabla `ventas_pedidos`
--
ALTER TABLE `ventas_pedidos`
  ADD CONSTRAINT `ventas_pedidos_ibfk_1` FOREIGN KEY (`codigo_producto`) REFERENCES `productos` (`codigo_producto`),
  ADD CONSTRAINT `ventas_pedidos_ibfk_2` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`);

--
-- Filtros para la tabla `ventas_planes`
--
ALTER TABLE `ventas_planes`
  ADD CONSTRAINT `ventas_planes_ibfk_1` FOREIGN KEY (`codigo_plan`) REFERENCES `planes` (`codigo_plan`),
  ADD CONSTRAINT `ventas_planes_ibfk_2` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
