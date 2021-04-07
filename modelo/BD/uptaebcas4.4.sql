-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 29-03-2021 a las 16:35:00
-- Versión del servidor: 10.1.28-MariaDB
-- Versión de PHP: 7.1.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `uptaebcas`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bitacora`
--

CREATE TABLE `bitacora` (
  `id_bitacora` int(11) NOT NULL,
  `id_usuario_sistema` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `hora` time NOT NULL,
  `accion` varchar(350) NOT NULL,
  `ip_address` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `bitacora`
--

INSERT INTO `bitacora` (`id_bitacora`, `id_usuario_sistema`, `fecha`, `hora`, `accion`, `ip_address`) VALUES
(3, 57, '2021-03-09', '12:12:52', 'Registró al usuario Nicolle Lopez, con cédula: 44444444', '::1'),
(4, 57, '2021-03-09', '12:13:40', 'Registró al usuario Asda Sasdas, con cédula: 55555555', '::1'),
(5, 57, '2021-03-09', '12:14:14', 'Registró al usuario Dos Dos, con cédula: 66666666', '::1'),
(6, 57, '2021-03-09', '12:14:40', 'Registró al usuario Tres Tres, con cédula: 77777777', '::1'),
(7, 57, '2021-03-09', '12:16:55', 'Modificó al usuario Uno Sasdas, con cédula: 55555555', '::1'),
(8, 57, '2021-03-09', '12:17:26', 'Generó reporte de operadores registrados', '::1'),
(9, 57, '2021-03-09', '12:18:31', 'Eliminó al usuario Nicolle Lopez, con cédula: 44444444', '::1'),
(10, 57, '2021-03-09', '12:22:40', 'Registró al beneficiario S S, con cédula: 77444444', '::1'),
(11, 57, '2021-03-09', '12:23:32', 'Registró al beneficiario As Sdsd, con cédula: 888888888', '::1'),
(12, 57, '2021-03-09', '12:23:58', 'Modificó al beneficiario Sas S, con cédula: 77444444', '::1'),
(13, 57, '2021-03-09', '12:26:01', 'Registró la clasificación Pastillas', '::1'),
(14, 57, '2021-03-09', '12:27:42', 'Modificó el catalogo Acetaminofen a Dol en la clasificación Pastillas', '::1'),
(15, 57, '2021-03-09', '12:28:07', 'Registró el producto Asdasd en el catalogo Dol, ubicado en la clasificación Pastillas', '::1'),
(16, 57, '2021-03-09', '12:28:26', 'Registró exitosamente el operativo Medicinas', '::1'),
(17, 57, '2021-03-09', '12:28:33', 'Publicó el operativo Medicinas', '::1'),
(18, 57, '2021-03-09', '12:30:28', 'Login out', '::1'),
(22, 80, '2021-02-03', '13:04:14', 'Login success', '::1'),
(23, 57, '2021-03-12', '13:09:24', 'Registró la clasificación Dfgdfg', '::1'),
(24, 57, '2021-03-12', '13:37:44', 'Registró la clasificación Ertert', '::1'),
(25, 57, '2021-03-12', '13:44:50', 'Eliminó la clasificación Ertert', '::1'),
(98, 80, '2020-12-01', '02:20:49', 'Login success', '::1'),
(100, 57, '2021-03-13', '02:21:23', 'Eliminó al usuario Luis Lopez, con cédula: 5734875', '::1'),
(101, 57, '2021-03-13', '09:18:40', 'Login out', '::1'),
(104, 77, '2021-03-09', '12:09:18', 'Login success', '::1'),
(106, 57, '2021-03-19', '19:27:22', 'Login out', '::1'),
(114, 77, '2021-03-19', '01:28:26', 'Nuevo beneficiario registrado, con cedula: 5734751', '::1'),
(115, 77, '2021-03-19', '01:29:34', 'Login success', '::1'),
(116, 77, '2021-03-19', '01:33:39', 'Login out', '::1'),
(117, 57, '2021-03-19', '01:34:01', 'Login success', '::1'),
(118, 57, '2021-03-19', '01:34:31', 'Registró al usuario Aaaa Eeeeee, con cédula: 8754877', '::1'),
(119, 57, '2021-03-19', '01:35:09', 'Registró al beneficiario Tttt Nnnnn, con cédula: 6666666', '::1'),
(120, 57, '2021-03-19', '01:35:24', 'Login out', '::1'),
(132, 77, '2020-10-06', '12:20:20', 'Login success', '::1'),
(133, 80, '2018-05-10', '12:37:20', 'Login success', '::1'),
(134, 57, '2021-03-22', '15:26:15', 'Login out', '::1'),
(135, 80, '2019-08-05', '07:51:43', 'Login success', '::1'),
(136, 57, '2021-03-26', '07:56:34', 'Login out', '::1'),
(137, 57, '2021-03-26', '07:58:58', 'Login success', '::1'),
(140, 72, '2021-03-29', '20:45:51', 'Login success', '::1'),
(141, 72, '2021-03-29', '20:46:55', 'Login out', '::1'),
(146, 57, '2021-03-29', '20:52:14', 'Login success', '::1'),
(147, 57, '2021-03-29', '20:54:39', 'Registró el producto Asd en el catalogo S, ubicado en la clasificación Alimentos', '::1'),
(148, 57, '2021-03-29', '20:56:07', 'Login out', '::1'),
(149, 57, '2021-03-29', '08:44:04', 'Login success', '::1'),
(150, 57, '2021-03-29', '08:45:36', 'Login out', '::1'),
(151, 57, '2021-03-29', '08:45:54', 'Login success', '::1'),
(152, 57, '2021-03-29', '08:46:02', 'Login out', '::1'),
(153, 57, '2021-03-29', '08:47:23', 'Login success', '::1'),
(154, 57, '2021-03-29', '09:09:12', 'Login out', '::1'),
(155, 68, '2021-03-29', '09:09:33', 'Login success', '::1'),
(156, 68, '2021-03-29', '09:11:24', 'Login out', '::1'),
(157, 72, '2021-03-29', '09:11:49', 'Login success', '::1'),
(158, 72, '2021-03-29', '09:14:12', 'Registró al beneficiario Lion Gutierrez, con cédula: 6543217', '::1'),
(159, 72, '2021-03-29', '09:14:58', 'Login out', '::1'),
(160, 57, '2021-03-29', '09:15:17', 'Login success', '::1'),
(161, 57, '2021-03-29', '09:36:03', 'Le quitó el operativo al beneficiario V-12345673', '::1'),
(162, 57, '2021-03-29', '09:36:12', 'Entregó el operativo al beneficiario V-12345673', '::1'),
(163, 57, '2021-03-29', '09:54:00', 'Registró exitosamente el operativo Medicinas', '::1'),
(164, 57, '2021-03-29', '09:55:23', 'Modificó el operativo Medicinas', '::1'),
(165, 57, '2021-03-29', '10:01:28', 'Registró exitosamente el operativo Medicinas', '::1'),
(166, 57, '2021-03-29', '10:02:32', 'Registró exitosamente el operativo Gas', '::1'),
(167, 57, '2021-03-29', '10:03:13', 'Modificó el catalogo Ghg a Leche en la clasificación Alimentos', '::1'),
(168, 57, '2021-03-29', '10:03:23', 'Modificó el catalogo S a Harina en la clasificación Alimentos', '::1'),
(169, 57, '2021-03-29', '10:03:50', 'Modificó el producto Harina De Trigo del catalogo de Harina, ubicado en la clasificación Alimentos', '::1'),
(170, 57, '2021-03-29', '10:04:16', 'Registró exitosamente el operativo Gas', '::1'),
(171, 57, '2021-03-29', '10:06:21', 'Registró la clasificación Alimentos', '::1'),
(172, 57, '2021-03-29', '10:06:31', 'Registró la clasificación Gas', '::1'),
(173, 57, '2021-03-29', '10:06:45', 'Registró la clasificación Utiles', '::1'),
(174, 57, '2021-03-29', '10:07:00', 'Registró la clasificación Medicinas', '::1'),
(175, 57, '2021-03-29', '10:07:16', 'Registró el catalogo Leche en la clasificación Alimentos', '::1'),
(176, 57, '2021-03-29', '10:07:24', 'Registró el catalogo Harina en la clasificación Alimentos', '::1'),
(177, 57, '2021-03-29', '10:08:28', 'Registró el producto Leche Liquida en el catalogo Leche, ubicado en la clasificación Alimentos', '::1'),
(178, 57, '2021-03-29', '10:09:15', 'Registró el producto Harina De Trigo en el catalogo Harina, ubicado en la clasificación Alimentos', '::1'),
(179, 57, '2021-03-29', '10:09:46', 'Registró el catalogo Bombona en la clasificación Gas', '::1'),
(180, 57, '2021-03-29', '10:10:18', 'Registró el producto Bombona  en el catalogo Bombona, ubicado en la clasificación Gas', '::1'),
(181, 57, '2021-03-29', '10:11:30', 'Registró el catalogo Lapices en la clasificación Utiles', '::1'),
(182, 57, '2021-03-29', '10:12:05', 'Registró el producto Lapiz en el catalogo Lapices, ubicado en la clasificación Utiles', '::1'),
(183, 57, '2021-03-29', '10:12:47', 'Registró el catalogo Pastillas en la clasificación Medicinas', '::1'),
(184, 57, '2021-03-29', '10:13:25', 'Registró el producto Acetaminofen en el catalogo Pastillas, ubicado en la clasificación Medicinas', '::1'),
(185, 57, '2021-03-29', '10:13:51', 'Registró exitosamente el operativo Medicinas', '::1'),
(186, 57, '2021-03-29', '10:14:54', 'Registró exitosamente el operativo Medicinas', '::1'),
(187, 57, '2021-03-29', '10:15:11', 'Registró exitosamente el operativo Gas', '::1'),
(188, 57, '2021-03-29', '10:16:00', 'Registró exitosamente el operativo Gas', '::1'),
(189, 57, '2021-03-29', '10:16:23', 'Registró exitosamente el operativo Medicinas', '::1'),
(190, 57, '2021-03-29', '10:17:11', 'Registró exitosamente el operativo Medicinas', '::1'),
(191, 57, '2021-03-29', '10:17:26', 'Registró exitosamente el operativo Utiles', '::1'),
(192, 57, '2021-03-29', '10:18:13', 'Registró exitosamente el operativo Utiles', '::1'),
(193, 57, '2021-03-29', '10:18:35', 'Registró exitosamente el operativo Gas 2', '::1'),
(194, 57, '2021-03-29', '10:19:22', 'Registró exitosamente el operativo Gas 2', '::1'),
(195, 57, '2021-03-29', '10:19:42', 'Registró exitosamente el operativo Clap 2', '::1'),
(196, 57, '2021-03-29', '10:20:22', 'Registró exitosamente el operativo Clap 2', '::1'),
(197, 57, '2021-03-29', '10:20:46', 'Registró exitosamente el operativo Leche', '::1'),
(198, 57, '2021-03-29', '10:21:27', 'Registró exitosamente el operativo Leche', '::1'),
(199, 57, '2021-03-29', '10:21:45', 'Registró exitosamente el operativo Combo Navideño', '::1'),
(200, 57, '2021-03-29', '10:22:27', 'Registró exitosamente el operativo Combo Navideño', '::1'),
(201, 57, '2021-03-29', '10:22:54', 'Registró exitosamente el operativo Clap', '::1'),
(202, 57, '2021-03-29', '10:24:17', 'Registró exitosamente el operativo Clap', '::1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `buzon`
--

CREATE TABLE `buzon` (
  `idBuzon` int(11) NOT NULL,
  `foto_icono` varchar(200) NOT NULL,
  `idEmisor` int(11) DEFAULT NULL,
  `idReceptor` int(11) DEFAULT NULL,
  `asunto` varchar(100) NOT NULL,
  `mensaje` varchar(1500) NOT NULL,
  `tipo` set('1','2','3') NOT NULL,
  `favorito` set('0','1') NOT NULL,
  `fecha` datetime NOT NULL,
  `leido` set('0','1') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `buzon`
--

INSERT INTO `buzon` (`idBuzon`, `foto_icono`, `idEmisor`, `idReceptor`, `asunto`, `mensaje`, `tipo`, `favorito`, `fecha`, `leido`) VALUES
(37, '1', 0, 68, '¡Nueva actualización!', 'Se han actualizado algunas funciones del sistema CAS', '1', '0', '2021-03-07 06:13:08', '0'),
(38, '1', 0, 69, 'Sistema CAS', '*Muy buen dia Maria Hernandez*<br><br>\r\n					\r\n					*¡El sistema CAS le da la bienvenida a nuestra plataforma!*<br><br>', '1', '0', '2021-03-09 17:11:24', ''),
(39, '1', 0, 70, 'Sistema CAS', '*Muy buen dia Nicolle Lopez*<br><br>\r\n						\r\n						*¡El sistema CAS le da la bienvenida a nuestra plataforma!*<br><br>', '1', '0', '2021-03-09 17:12:52', ''),
(40, '1', 0, 71, 'Sistema CAS', '*Muy buen dia Asda Sasdas*<br><br>\r\n						\r\n						*¡El sistema CAS le da la bienvenida a nuestra plataforma!*<br><br>', '1', '0', '2021-03-09 17:13:40', '1'),
(41, '1', 0, 72, 'Sistema CAS', '*Muy buen dia Dos Dos*<br><br>\r\n						\r\n						*¡El sistema CAS le da la bienvenida a nuestra plataforma!*<br><br>', '1', '0', '2021-03-09 17:14:14', ''),
(42, '1', 0, 73, 'Sistema CAS', '*Muy buen dia Tres Tres*<br><br>\r\n						\r\n						*¡El sistema CAS le da la bienvenida a nuestra plataforma!*<br><br>', '1', '0', '2021-03-09 17:14:40', ''),
(43, '1', 0, 74, 'Sistema CAS', '*Muy buen dia S S*<br><br>\r\n						\r\n						*¡El sistema CAS le da la bienvenida a nuestra plataforma!*<br><br>', '1', '0', '2021-03-09 17:22:40', ''),
(44, '1', 0, 75, 'Sistema CAS', '*Muy buen dia As Sdsd*<br><br>\r\n						\r\n						*¡El sistema CAS le da la bienvenida a nuestra plataforma!*<br><br>', '1', '0', '2021-03-09 17:23:32', ''),
(45, '2', 0, 69, 'Nuevo evento CAS', '*Muy buen dia beneficiario Maria Hernandez*<br><br>\r\n					\r\n					*¡El Software CAS le notifica que hay un nuevo operativo disponible, realice su pago y registrelo ahora en nuestra plataforma!*<br><br>\r\n\r\n					- Nombre del operativo: Medicinas<br><br>\r\n					- Su costo: 232323232<br><br>\r\n					- Fecha de inicio: 2021-03-09<br><br>\r\n					- Fecha de caducidad: 2021-03-12<br><br>\r\n					- Descripcion del operativo: Asdasd<br><br>\r\n					- Banco admitido: Banco Caroní C.A. Banco Universal<br><br>\r\n\r\n					************ FELIZ DIA, Y RECUERDE GENERAR SU PAGO PARA HACERLE LA ENTREGA DEL MISMO ************<br><br>', '1', '0', '2021-03-09 17:28:33', ''),
(46, '2', 0, 74, 'Nuevo evento CAS', '*Muy buen dia beneficiario Sas S*<br><br>\r\n					\r\n					*¡El Software CAS le notifica que hay un nuevo operativo disponible, realice su pago y registrelo ahora en nuestra plataforma!*<br><br>\r\n\r\n					- Nombre del operativo: Medicinas<br><br>\r\n					- Su costo: 232323232<br><br>\r\n					- Fecha de inicio: 2021-03-09<br><br>\r\n					- Fecha de caducidad: 2021-03-12<br><br>\r\n					- Descripcion del operativo: Asdasd<br><br>\r\n					- Banco admitido: Banco Caroní C.A. Banco Universal<br><br>\r\n\r\n					************ FELIZ DIA, Y RECUERDE GENERAR SU PAGO PARA HACERLE LA ENTREGA DEL MISMO ************<br><br>', '1', '0', '2021-03-09 17:28:33', ''),
(47, '2', 0, 75, 'Nuevo evento CAS', '*Muy buen dia beneficiario As Sdsd*<br><br>\r\n					\r\n					*¡El Software CAS le notifica que hay un nuevo operativo disponible, realice su pago y registrelo ahora en nuestra plataforma!*<br><br>\r\n\r\n					- Nombre del operativo: Medicinas<br><br>\r\n					- Su costo: 232323232<br><br>\r\n					- Fecha de inicio: 2021-03-09<br><br>\r\n					- Fecha de caducidad: 2021-03-12<br><br>\r\n					- Descripcion del operativo: Asdasd<br><br>\r\n					- Banco admitido: Banco Caroní C.A. Banco Universal<br><br>\r\n\r\n					************ FELIZ DIA, Y RECUERDE GENERAR SU PAGO PARA HACERLE LA ENTREGA DEL MISMO ************<br><br>', '1', '0', '2021-03-09 17:28:33', ''),
(48, '2', 0, 69, 'Recordatorio CAS', '*Muy buen dia beneficiario Maria Hernandez*<br><br>\r\n					\r\n					*¡Les recordamos que tiene un operativo por pagar, realice su pago y registrelo ahora en nuestra plataforma!*<br><br>\r\n\r\n					- Nombre del operativo: Medicinas<br><br>\r\n					- Su costo: 232323232<br><br>\r\n					- Fecha de inicio: 2021-03-09<br><br>\r\n					- Fecha de caducidad: 2021-03-12<br><br>\r\n					- Descripcion del operativo: Asdasd<br><br>\r\n					- Banco admitido: Banco Caroní C.A. Banco Universal<br><br>\r\n\r\n					************ FELIZ DIA, Y RECUERDE GENERAR SU PAGO PARA HACERLE LA ENTREGA DEL MISMO ************<br><br>', '1', '0', '2021-03-09 17:30:24', ''),
(49, '2', 0, 74, 'Recordatorio CAS', '*Muy buen dia beneficiario Sas S*<br><br>\r\n					\r\n					*¡Les recordamos que tiene un operativo por pagar, realice su pago y registrelo ahora en nuestra plataforma!*<br><br>\r\n\r\n					- Nombre del operativo: Medicinas<br><br>\r\n					- Su costo: 232323232<br><br>\r\n					- Fecha de inicio: 2021-03-09<br><br>\r\n					- Fecha de caducidad: 2021-03-12<br><br>\r\n					- Descripcion del operativo: Asdasd<br><br>\r\n					- Banco admitido: Banco Caroní C.A. Banco Universal<br><br>\r\n\r\n					************ FELIZ DIA, Y RECUERDE GENERAR SU PAGO PARA HACERLE LA ENTREGA DEL MISMO ************<br><br>', '1', '0', '2021-03-09 17:30:24', ''),
(50, '2', 0, 75, 'Recordatorio CAS', '*Muy buen dia beneficiario As Sdsd*<br><br>\r\n					\r\n					*¡Les recordamos que tiene un operativo por pagar, realice su pago y registrelo ahora en nuestra plataforma!*<br><br>\r\n\r\n					- Nombre del operativo: Medicinas<br><br>\r\n					- Su costo: 232323232<br><br>\r\n					- Fecha de inicio: 2021-03-09<br><br>\r\n					- Fecha de caducidad: 2021-03-12<br><br>\r\n					- Descripcion del operativo: Asdasd<br><br>\r\n					- Banco admitido: Banco Caroní C.A. Banco Universal<br><br>\r\n\r\n					************ FELIZ DIA, Y RECUERDE GENERAR SU PAGO PARA HACERLE LA ENTREGA DEL MISMO ************<br><br>', '1', '0', '2021-03-09 17:30:24', ''),
(51, 'img/photouser.jgp', 1, 2, 'Buenas tardes', 'Es para notificarle que estamos haciendo un test de prueba', '2', '0', '0000-00-00 00:00:00', ''),
(52, 'img/photouser.jgp', 1, 2, 'Buenas tardes', 'Es para notificarle que estamos haciendo un test de prueba', '2', '0', '0000-00-00 00:00:00', ''),
(53, 'img/photouser.jgp', 1, 2, 'Buenas tardes', 'Es para notificarle que estamos haciendo un test de prueba', '2', '0', '0000-00-00 00:00:00', ''),
(54, 'img/photouser.jgp', 1, 2, 'Buenas tardes', 'Es para notificarle que estamos haciendo un test de prueba', '2', '0', '0000-00-00 00:00:00', ''),
(55, 'img/photouser.jgp', 1, 2, 'Buenas tardes', 'Es para notificarle que estamos haciendo un test de prueba', '2', '0', '0000-00-00 00:00:00', ''),
(56, 'img/photouser.jgp', 1, 2, 'Buenas tardes', 'Es para notificarle que estamos haciendo un test de prueba', '2', '0', '0000-00-00 00:00:00', ''),
(57, 'img/photouser.jgp', 1, 2, 'Buenas tardes', 'Es para notificarle que estamos haciendo un test de prueba', '2', '0', '0000-00-00 00:00:00', ''),
(58, 'img/photouser.jgp', 1, 2, 'Buenas tardes', 'Es para notificarle que estamos haciendo un test de prueba', '2', '0', '0000-00-00 00:00:00', ''),
(59, 'img/photouser.jgp', 1, 2, 'Buenas tardes', 'Es para notificarle que estamos haciendo un test de prueba', '2', '0', '0000-00-00 00:00:00', ''),
(60, 'img/photouser.jgp', 1, 2, 'Buenas tardes', 'Es para notificarle que estamos haciendo un test de prueba', '2', '0', '0000-00-00 00:00:00', ''),
(61, 'img/photouser.jgp', 1, 2, 'Buenas tardes', 'Es para notificarle que estamos haciendo un test de prueba', '2', '0', '0000-00-00 00:00:00', ''),
(62, 'img/photouser.jgp', 1, 2, 'Buenas tardes', 'Es para notificarle que estamos haciendo un test de prueba', '2', '0', '0000-00-00 00:00:00', ''),
(63, 'img/photouser.jgp', 1, 2, 'Buenas tardes', 'Es para notificarle que estamos haciendo un test de prueba', '2', '0', '0000-00-00 00:00:00', ''),
(64, 'img/photouser.jgp', 1, 2, 'Buenas tardes', 'Es para notificarle que estamos haciendo un test de prueba', '2', '0', '0000-00-00 00:00:00', ''),
(65, 'img/photouser.jgp', 1, 2, 'Buenas tardes', 'Es para notificarle que estamos haciendo un test de prueba', '2', '0', '0000-00-00 00:00:00', ''),
(66, 'img/photouser.jgp', 1, 2, 'Buenas tardes', 'Es para notificarle que estamos haciendo un test de prueba', '2', '0', '0000-00-00 00:00:00', ''),
(67, 'img/photouser.jgp', 1, 2, 'Buenas tardes', 'Es para notificarle que estamos haciendo un test de prueba', '2', '0', '0000-00-00 00:00:00', ''),
(68, 'img/photouser.jgp', 1, 2, 'Buenas tardes', 'Es para notificarle que estamos haciendo un test de prueba', '2', '0', '0000-00-00 00:00:00', ''),
(69, 'img/photouser.jgp', 1, 2, 'Buenas tardes', 'Es para notificarle que estamos haciendo un test de prueba', '2', '0', '0000-00-00 00:00:00', ''),
(70, 'img/photouser.jgp', 1, 2, 'Buenas tardes', 'Es para notificarle que estamos haciendo un test de prueba', '2', '0', '0000-00-00 00:00:00', ''),
(71, 'img/photouser.jgp', 1, 2, 'Buenas tardes', 'Es para notificarle que estamos haciendo un test de prueba', '2', '0', '0000-00-00 00:00:00', ''),
(72, 'img/photouser.jgp', 1, 2, 'Buenas tardes', 'Es para notificarle que estamos haciendo un test de prueba', '2', '0', '0000-00-00 00:00:00', ''),
(73, 'img/photouser.jgp', 1, 2, 'Buenas tardes', 'Es para notificarle que estamos haciendo un test de prueba', '2', '0', '0000-00-00 00:00:00', ''),
(74, 'img/photouser.jgp', 1, 2, 'Buenas tardes', 'Es para notificarle que estamos haciendo un test de prueba', '2', '0', '0000-00-00 00:00:00', ''),
(75, 'img/photouser.jgp', 1, 2, 'Buenas tardes', 'Es para notificarle que estamos haciendo un test de prueba', '2', '0', '0000-00-00 00:00:00', ''),
(76, 'img/photouser.jgp', 1, 2, 'Buenas tardes', 'Es para notificarle que estamos haciendo un test de prueba', '2', '0', '0000-00-00 00:00:00', ''),
(77, 'img/photouser.jgp', 1, 2, 'Buenas tardes', 'Es para notificarle que estamos haciendo un test de prueba', '2', '0', '0000-00-00 00:00:00', ''),
(78, 'img/photouser.jgp', 1, 2, 'Buenas tardes', 'Es para notificarle que estamos haciendo un test de prueba', '2', '0', '0000-00-00 00:00:00', ''),
(79, 'img/photouser.jgp', 1, 2, 'Buenas tardes', 'Es para notificarle que estamos haciendo un test de prueba', '2', '0', '0000-00-00 00:00:00', ''),
(80, 'img/photouser.jgp', 1, 2, 'Buenas tardes', 'Es para notificarle que estamos haciendo un test de prueba', '2', '0', '0000-00-00 00:00:00', ''),
(81, 'img/photouser.jgp', 1, 2, 'Buenas tardes', 'Es para notificarle que estamos haciendo un test de prueba', '2', '0', '0000-00-00 00:00:00', ''),
(82, 'img/photouser.jgp', 1, 2, 'Buenas tardes', 'Es para notificarle que estamos haciendo un test de prueba', '2', '0', '0000-00-00 00:00:00', ''),
(83, 'img/photouser.jgp', 1, 2, 'Buenas tardes', 'Es para notificarle que estamos haciendo un test de prueba', '2', '0', '0000-00-00 00:00:00', ''),
(84, 'img/photouser.jgp', 1, 2, 'Buenas tardes', 'Es para notificarle que estamos haciendo un test de prueba', '2', '0', '0000-00-00 00:00:00', ''),
(85, '1', 0, 75, 'Sistema CAS', '*Muy buen dia Malditaaaaaaa Nomentirateamo*<br><br>\n					\n					*¡El sistema CAS le da la bienvenida a nuestra plataforma!*<br><br>', '1', '0', '2021-03-19 05:18:42', ''),
(86, '1', 0, 75, 'Sistema CAS', '*Muy buen dia Perrrrraa Malditaaaa*<br><br>\n					\n					*¡El sistema CAS le da la bienvenida a nuestra plataforma!*<br><br>', '1', '0', '2021-03-19 05:46:40', ''),
(87, '1', 0, 76, 'Sistema CAS', '*Muy buen dia Perraaa Asdasd*<br><br>\n					\n					*¡El sistema CAS le da la bienvenida a nuestra plataforma!*<br><br>', '1', '0', '2021-03-19 05:51:55', ''),
(88, '1', 0, 77, 'Sistema CAS', '*Muy buen dia Conaaa Sadas*<br><br>\n					\n					*¡El sistema CAS le da la bienvenida a nuestra plataforma!*<br><br>', '1', '0', '2021-03-19 06:28:26', ''),
(89, '1', 0, 78, 'Sistema CAS', '*Muy buen dia Aaaa Eeeeee*<br><br>\n						\n						*¡El sistema CAS le da la bienvenida a nuestra plataforma!*<br><br>', '1', '0', '2021-03-19 06:34:31', ''),
(90, '1', 0, 79, 'Sistema CAS', '*Muy buen dia Tttt Nnnnn*<br><br>\n						\n						*¡El sistema CAS le da la bienvenida a nuestra plataforma!*<br><br>', '1', '0', '2021-03-19 06:35:09', ''),
(91, 'vista/config/img/users/12345678-IMG-20160522-WA0030.jpg', 57, 57, 'HOLA', 'ASD', '3', '1', '2021-03-22 17:37:52', ''),
(92, 'vista/config/img/users/12345678-IMG-20160522-WA0030.jpg', 57, 57, 'HOLA', 'JJ', '2', '0', '2021-03-26 13:01:57', '1'),
(93, '1', 0, 80, 'Sistema CAS', '*Muy buen dia Lion Gutierrez*<br><br>\n						\n						*¡El sistema CAS le da la bienvenida a nuestra plataforma!*<br><br>', '1', '0', '2021-03-29 15:14:12', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `catalogo`
--

CREATE TABLE `catalogo` (
  `id_catalogo` int(11) NOT NULL,
  `id_clasificacion` int(11) NOT NULL,
  `nombre_catalogo` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='catalogo para las diversidades';

--
-- Volcado de datos para la tabla `catalogo`
--

INSERT INTO `catalogo` (`id_catalogo`, `id_clasificacion`, `nombre_catalogo`) VALUES
(3, 116, 'Leche'),
(4, 116, 'Harina'),
(5, 117, 'Bombona'),
(6, 118, 'Lapices'),
(7, 119, 'Pastillas');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clasificacion`
--

CREATE TABLE `clasificacion` (
  `id_clasificacion` int(11) NOT NULL,
  `nombre_clasificacion` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Clasificacion (alimentos, gas, etc)';

--
-- Volcado de datos para la tabla `clasificacion`
--

INSERT INTO `clasificacion` (`id_clasificacion`, `nombre_clasificacion`) VALUES
(116, 'Alimentos'),
(117, 'Gas'),
(118, 'Utiles'),
(119, 'Medicinas');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `diversidad`
--

CREATE TABLE `diversidad` (
  `id_diversidad` int(11) NOT NULL,
  `id_catalogo` int(11) NOT NULL,
  `nombre_diversidad` varchar(40) NOT NULL,
  `marca` varchar(40) NOT NULL,
  `contenido` varchar(30) NOT NULL,
  `descripcion` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Productos con sus variedades';

--
-- Volcado de datos para la tabla `diversidad`
--

INSERT INTO `diversidad` (`id_diversidad`, `id_catalogo`, `nombre_diversidad`, `marca`, `contenido`, `descripcion`) VALUES
(3, 3, 'Leche Liquida', 'El Tunal', '1 Litro', 'Leche Del Tunal'),
(4, 4, 'Harina De Trigo', 'Pan', '1 K', 'Harina Leudante'),
(5, 5, 'Bombona ', 'Servigas', '10 K ', 'Operativo Gas'),
(6, 6, 'Lapiz', 'Mongol', 'Hb', 'Lapiz De Dibujo'),
(7, 7, 'Acetaminofen', 'No Se', '10 Pastillas', 'Hola');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mensajes`
--

CREATE TABLE `mensajes` (
  `idMsj` int(11) NOT NULL,
  `idBuzon` int(11) NOT NULL,
  `idEmisor` int(11) NOT NULL,
  `idReceptor` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `mensajes`
--

INSERT INTO `mensajes` (`idMsj`, `idBuzon`, `idEmisor`, `idReceptor`) VALUES
(1, 91, 57, 57),
(2, 92, 57, 57);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `modulos`
--

CREATE TABLE `modulos` (
  `idModulo` int(11) NOT NULL,
  `icono` varchar(100) NOT NULL,
  `nombreModulo` varchar(20) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `modulos`
--

INSERT INTO `modulos` (`idModulo`, `icono`, `nombreModulo`) VALUES
(1, 'vista/config/img/Usuarios.png', 'Usuario'),
(2, 'vista/config/img/avatar3.png', 'Beneficiario'),
(3, 'vista/config/img/carrito.png', 'Operativo'),
(4, 'vista/config/img/seg.png', 'Seguridad'),
(5, 'vista/config/img/menu.png', 'Reporte');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `modulo_roles`
--

CREATE TABLE `modulo_roles` (
  `idModulo_rol` int(11) NOT NULL,
  `idModulo` int(11) NOT NULL,
  `idRol` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `modulo_roles`
--

INSERT INTO `modulo_roles` (`idModulo_rol`, `idModulo`, `idRol`) VALUES
(1, 1, 1),
(2, 2, 1),
(3, 3, 1),
(4, 4, 1),
(5, 5, 1),
(6, 1, 2),
(7, 2, 2),
(8, 3, 2),
(9, 4, 2),
(10, 5, 2),
(11, 5, 3),
(12, 2, 3),
(13, 3, 3),
(14, 3, 4),
(15, 1, 3),
(16, 4, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `operativo`
--

CREATE TABLE `operativo` (
  `id_operativo` int(11) NOT NULL,
  `nombre_operativo` varchar(30) NOT NULL,
  `precio_operativo` decimal(40,0) NOT NULL,
  `fecha_inicio_operativo` date NOT NULL,
  `fecha_final_operativo` date NOT NULL,
  `descripcion` varchar(350) NOT NULL,
  `estado` varchar(5) NOT NULL,
  `banco_admitido` varchar(200) NOT NULL,
  `foto` varchar(300) NOT NULL,
  `notificar_vencimiento` set('true','false') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `operativo`
--

INSERT INTO `operativo` (`id_operativo`, `nombre_operativo`, `precio_operativo`, `fecha_inicio_operativo`, `fecha_final_operativo`, `descripcion`, `estado`, `banco_admitido`, `foto`, `notificar_vencimiento`) VALUES
(1, 'Medicinas', '5000000', '2021-03-13', '2021-05-13', 'Operativo de medicinas', 'on', 'Banco Sofitasa Banco Universal', 'vista/config/img/operativo/Medicinas-dibujito final.png', ''),
(2, 'Gas', '20000', '2021-02-13', '2021-02-18', 'Operativo de servigas', 'clau', 'Banco Bicentenario', 'vista/config/img/operativo/Medicinas-dibujito final.png', ''),
(3, 'Medicinas', '20000', '2021-02-16', '2021-02-20', 'Operativo de medicinas', 'clau', 'Banco Bicentenario', 'vista/config/img/operativo/Medicinas-dibujito final.png', ''),
(4, 'Utiles', '20000', '2021-01-12', '2021-01-14', 'operativo de utiles escolares', 'clau', 'Banco Bicentenario', 'vista/config/img/operativo/Medicinas-dibujito final.png', ''),
(5, 'Gas 2', '20000', '2020-01-14', '2020-01-18', 'Operativo de gas', 'clau', 'Banco Bicentenario', 'vista/config/img/operativo/Medicinas-dibujito final.png', ''),
(6, 'Clap 2', '20000', '2020-02-19', '2020-02-21', 'Operativo de comida', 'clau', 'Banco Bicentenario', 'vista/config/img/operativo/Medicinas-dibujito final.png', ''),
(7, 'Leche', '20000', '2019-11-12', '2019-11-17', 'Operativo de leche', 'clau', 'Banco Bicentenario', 'vista/config/img/operativo/Medicinas-dibujito final.png', ''),
(8, 'Combo Navideño', '20000', '2020-12-02', '2020-12-09', 'Operativo navideño', 'clau', 'Banco Bicentenario', 'vista/config/img/operativo/Medicinas-dibujito final.png', ''),
(9, 'Clap', '80000', '2021-02-02', '2021-02-04', 'Operativo de comida', 'clau', 'Banco Bicentenario', 'vista/config/img/operativo/Medicinas-dibujito final.png', 'false');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `operativo_diversidad`
--

CREATE TABLE `operativo_diversidad` (
  `id_operativo_diversidad` int(11) NOT NULL,
  `id_operativo_nuevo` int(11) NOT NULL,
  `id_diversidad_operativo` int(11) NOT NULL,
  `cantidad_por_persona` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `operativo_diversidad`
--

INSERT INTO `operativo_diversidad` (`id_operativo_diversidad`, `id_operativo_nuevo`, `id_diversidad_operativo`, `cantidad_por_persona`) VALUES
(3, 1, 7, 1),
(4, 2, 5, 3),
(5, 3, 7, 1),
(6, 4, 6, 3),
(7, 5, 5, 1),
(8, 6, 4, 1),
(9, 7, 3, 3),
(10, 8, 4, 10),
(11, 9, 3, 3),
(12, 9, 4, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `operativo_usuario`
--

CREATE TABLE `operativo_usuario` (
  `id_operativo_usuario` int(11) NOT NULL,
  `id_usuario_` int(11) NOT NULL,
  `id_operativo_` int(11) NOT NULL,
  `referencia` varchar(40) NOT NULL,
  `banco` varchar(200) NOT NULL,
  `fecha_pago` date NOT NULL,
  `fecha_entrega` date NOT NULL,
  `estatud` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `operativo_usuario`
--

INSERT INTO `operativo_usuario` (`id_operativo_usuario`, `id_usuario_`, `id_operativo_`, `referencia`, `banco`, `fecha_pago`, `fecha_entrega`, `estatud`) VALUES
(1, 77, 1, '00000012', 'Banco Bicentenario', '2021-02-01', '2021-03-29', 'si'),
(2, 77, 9, '00000013', 'Banco Bicentenario', '2021-02-16', '2021-02-16', 'si'),
(3, 77, 4, '00000014', 'Banco Bicentenario', '2021-02-23', '2021-02-23', 'si'),
(26, 77, 4, '00000018', 'Banco Bicentenario', '2021-01-03', '2021-01-05', 'si'),
(27, 77, 8, '00000048', 'Banco Bicentenario', '2020-12-01', '2020-12-03', 'si');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permisos`
--

CREATE TABLE `permisos` (
  `idPermiso` int(10) NOT NULL,
  `icono` varchar(100) NOT NULL,
  `nombrePermiso` varchar(30) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `idModulo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `permisos`
--

INSERT INTO `permisos` (`idPermiso`, `icono`, `nombrePermiso`, `idModulo`) VALUES
(1, 'vista/config/img/Perfiles.png', 'Registrar usuarios', 1),
(2, 'vista/config/img/editar.png', 'Modificar usuarios', 1),
(3, 'vista/config/img/eliminar.png', 'Eliminar usuarios', 1),
(4, 'vista/config/img/Perfiles.png', 'Registrar beneficiarios', 2),
(5, 'vista/config/img/editar.png', 'Modificar beneficiarios', 2),
(6, 'vista/config/img/eliminar.png', 'Eliminar beneficiarios', 2),
(7, 'vista/config/img/cart.png', 'Registrar operativos', 3),
(8, 'vista/config/img/editar.png', 'Modificar operativos', 3),
(9, 'vista/config/img/eliminar.png', 'Eliminar operativos', 3),
(10, 'vista/config/img/diversidades_add.png', 'Añadir Diversidades', 3),
(11, 'vista/config/img/publicar.png', 'Publicar Operativo', 3),
(12, 'vista/config/img/producto.png', 'Distribuir Operativo', 3),
(13, 'vista/config/img/123456.png', 'Registrar Pago', 3),
(14, 'vista/config/img/editar.png', 'Modificar Pago', 3),
(15, 'vista/config/img/añ.png', 'Registrar clasificacion', 3),
(16, 'vista/config/img/editar.png', 'Modificar clasificacion', 3),
(17, 'vista/config/img/eliminar.png', 'Eliminar clasificacion', 3),
(18, 'vista/config/img/add_catalogo.png', 'Registrar catalogos', 3),
(19, 'vista/config/img/editar.png', 'Modificar catalogos', 3),
(20, 'vista/config/img/eliminar.png', 'Eliminar catalogos', 3),
(21, 'vista/config/img/add_catalogo.png', 'Registrar Diversidad', 3),
(22, 'vista/config/img/editar.png', 'Modificar Diversidad', 3),
(23, 'vista/config/img/eliminar.png', 'Eliminar Diversidad', 3),
(24, 'vista/config/img/descarga.jpg', 'Exportar Bitácoras', 4),
(25, 'vista/config/img/eliminar.png', 'Eliminar Bitácoras', 4),
(26, 'vista/config/img/permisos.png', 'Seguridad Avanzada', 4),
(27, 'vista/config/img/estadisticas.png', 'Visualizar Estadisticas', 5),
(28, 'vista/config/img/report.png', 'Generar Reportes', 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permisos_usuario`
--

CREATE TABLE `permisos_usuario` (
  `idRolUs` int(10) NOT NULL,
  `idUsuario` int(11) NOT NULL,
  `idPermiso` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `permisos_usuario`
--

INSERT INTO `permisos_usuario` (`idRolUs`, `idUsuario`, `idPermiso`) VALUES
(2967, 68, 1),
(2968, 68, 2),
(2969, 68, 3),
(2970, 68, 4),
(2971, 68, 5),
(2972, 68, 6),
(2973, 68, 7),
(2974, 68, 8),
(2975, 68, 9),
(2976, 68, 10),
(2977, 68, 11),
(2978, 68, 12),
(2979, 68, 15),
(2980, 68, 16),
(2981, 68, 17),
(2982, 68, 18),
(2983, 68, 19),
(2984, 68, 20),
(2985, 68, 21),
(2986, 68, 22),
(2987, 68, 23),
(2988, 68, 24),
(2989, 68, 25),
(2990, 68, 26),
(2991, 68, 27),
(2992, 68, 28),
(3026, 57, 1),
(3027, 57, 2),
(3028, 57, 3),
(3029, 57, 4),
(3030, 57, 5),
(3031, 57, 6),
(3032, 57, 7),
(3033, 57, 8),
(3034, 57, 9),
(3035, 57, 10),
(3036, 57, 11),
(3037, 57, 12),
(3038, 57, 13),
(3039, 57, 14),
(3040, 57, 15),
(3041, 57, 16),
(3042, 57, 17),
(3043, 57, 18),
(3044, 57, 19),
(3045, 57, 20),
(3046, 57, 21),
(3047, 57, 22),
(3048, 57, 23),
(3049, 57, 24),
(3050, 57, 25),
(3051, 57, 26),
(3052, 57, 27),
(3053, 57, 28),
(3089, 72, 4),
(3090, 72, 5),
(3091, 72, 6),
(3092, 72, 12),
(3093, 72, 28),
(3166, 80, 13),
(3167, 80, 14),
(3168, 77, 13),
(3169, 77, 14);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `preguntas_seguridad`
--

CREATE TABLE `preguntas_seguridad` (
  `idPregunta` int(11) NOT NULL,
  `idUsuario` int(11) NOT NULL,
  `pregunta` varchar(30) NOT NULL,
  `respuesta` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `preguntas_seguridad`
--

INSERT INTO `preguntas_seguridad` (`idPregunta`, `idUsuario`, `pregunta`, `respuesta`) VALUES
(1, 57, '¿Nombre de madre?', 'INGRID'),
(2, 57, 'padre', 'aa'),
(7, 77, '¿Nombre de madre?', 'A'),
(8, 77, 'V', 'B'),
(15, 72, '¿Nombre de madre?', 'a'),
(16, 72, 'b', 'b'),
(17, 68, '¿Nombre de madre?', 'a'),
(18, 68, 'pregunta 1 - a, pregunta 2 - b', 'b');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `idRol` int(11) NOT NULL,
  `nombreRol` varchar(30) NOT NULL,
  `statusRol` set('Enabled','Disabled') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`idRol`, `nombreRol`, `statusRol`) VALUES
(1, 'Super Usuario', 'Enabled'),
(2, 'Administrador', 'Enabled'),
(3, 'Operador', 'Enabled'),
(4, 'Beneficiario', 'Enabled');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id_usuario` int(11) NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `apellido` varchar(30) NOT NULL,
  `tcedula` varchar(1) NOT NULL,
  `cedula` varchar(12) NOT NULL,
  `contrasena` varchar(100) NOT NULL,
  `fecha_n` date NOT NULL,
  `email` varchar(30) NOT NULL,
  `temail` varchar(15) NOT NULL,
  `tcelular` varchar(5) NOT NULL,
  `celular` varchar(7) NOT NULL,
  `area` varchar(30) NOT NULL,
  `dependencia` varchar(100) NOT NULL,
  `direccion` varchar(350) NOT NULL,
  `tipo_rol` int(11) NOT NULL,
  `foto` varchar(200) NOT NULL,
  `status` set('Enabled','Disabled') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='tabla usuario (administrador - operador)';

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id_usuario`, `nombre`, `apellido`, `tcedula`, `cedula`, `contrasena`, `fecha_n`, `email`, `temail`, `tcelular`, `celular`, `area`, `dependencia`, `direccion`, `tipo_rol`, `foto`, `status`) VALUES
(57, 'Admin', 'Admin', 'V', '12345678', '$2y$07$UniversidadPolitecnicOVuZHDZ.vASSRES3G3SWJYmYupfayEJa', '1997-06-03', 'Superu', '@outlook.com', '0424', '5196637', '1', 'Turismo', 'Cabudare', 1, 'vista/config/img/users/12345678-dibujito final.png', ''),
(68, 'Agustin', 'Lozada', 'V', '12345671', '$2y$07$UniversidadPolitecnicOVuZHDZ.vASSRES3G3SWJYmYupfayEJa', '1980-01-03', 'Agustinlo', '@outlook.com', '0424', '5555555', 'System', 'Deporte', 'Barquisimeto', 2, 'vista/config/img/users/12345678-dibujito final.png', 'Enabled'),
(72, 'Willian', 'Perez', 'V', '12345672', '$2y$07$UniversidadPolitecnicOVuZHDZ.vASSRES3G3SWJYmYupfayEJa', '1997-04-28', 'luismlv_10', '@hotmail.com', '0424', '5555555', 'System', 'Agroalimentación', 'Cabudare', 3, 'vista/config/img/users/5734751-FB_IMG_1455995601181.jpg', 'Enabled'),
(77, 'Andres', 'Revilla', 'V', '12345673', '$2y$07$UniversidadPolitecnicOVuZHDZ.vASSRES3G3SWJYmYupfayEJa', '1997-04-06', 'andres_re', '@hotmail.com', '0424', '4444444', 'Docente', 'Agroalimentación', 'El cuji', 4, 'vista/config/img/users/5734751-FB_IMG_1455995601181.jpg', 'Enabled'),
(80, 'Lion', 'Gutierrez', 'V', '6543217', '$2y$07$UniversidadPolitecnicOfENtxmQ3AcT5KgT0FnSQiDncmJ1i3eW', '1997-02-12', 'Lion_10', '@yahoo.es', '0424', '5784468', 'Docente', 'Agroalimentación', 'Tamaca', 4, '', 'Enabled');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `bitacora`
--
ALTER TABLE `bitacora`
  ADD PRIMARY KEY (`id_bitacora`),
  ADD KEY `id_usuario_sistema` (`id_usuario_sistema`);

--
-- Indices de la tabla `buzon`
--
ALTER TABLE `buzon`
  ADD PRIMARY KEY (`idBuzon`);

--
-- Indices de la tabla `catalogo`
--
ALTER TABLE `catalogo`
  ADD PRIMARY KEY (`id_catalogo`),
  ADD KEY `id_clasificacion` (`id_clasificacion`);

--
-- Indices de la tabla `clasificacion`
--
ALTER TABLE `clasificacion`
  ADD PRIMARY KEY (`id_clasificacion`);

--
-- Indices de la tabla `diversidad`
--
ALTER TABLE `diversidad`
  ADD PRIMARY KEY (`id_diversidad`),
  ADD KEY `id_catalogo` (`id_catalogo`);

--
-- Indices de la tabla `mensajes`
--
ALTER TABLE `mensajes`
  ADD PRIMARY KEY (`idMsj`),
  ADD KEY `idEmisor` (`idEmisor`),
  ADD KEY `mensajes_ibfk_2` (`idBuzon`);

--
-- Indices de la tabla `modulos`
--
ALTER TABLE `modulos`
  ADD PRIMARY KEY (`idModulo`);

--
-- Indices de la tabla `modulo_roles`
--
ALTER TABLE `modulo_roles`
  ADD PRIMARY KEY (`idModulo_rol`),
  ADD KEY `idmodul` (`idModulo`),
  ADD KEY `idProfile` (`idRol`);

--
-- Indices de la tabla `operativo`
--
ALTER TABLE `operativo`
  ADD PRIMARY KEY (`id_operativo`);

--
-- Indices de la tabla `operativo_diversidad`
--
ALTER TABLE `operativo_diversidad`
  ADD PRIMARY KEY (`id_operativo_diversidad`),
  ADD KEY `id_operativo_nuevo` (`id_operativo_nuevo`),
  ADD KEY `id_diversidad_operativo` (`id_diversidad_operativo`);

--
-- Indices de la tabla `operativo_usuario`
--
ALTER TABLE `operativo_usuario`
  ADD PRIMARY KEY (`id_operativo_usuario`),
  ADD KEY `id_usuario_` (`id_usuario_`),
  ADD KEY `id_operativo_` (`id_operativo_`);

--
-- Indices de la tabla `permisos`
--
ALTER TABLE `permisos`
  ADD PRIMARY KEY (`idPermiso`),
  ADD KEY `idmodule` (`idModulo`);

--
-- Indices de la tabla `permisos_usuario`
--
ALTER TABLE `permisos_usuario`
  ADD PRIMARY KEY (`idRolUs`),
  ADD KEY `idUsers` (`idUsuario`),
  ADD KEY `idPermiso` (`idPermiso`);

--
-- Indices de la tabla `preguntas_seguridad`
--
ALTER TABLE `preguntas_seguridad`
  ADD PRIMARY KEY (`idPregunta`),
  ADD KEY `idUsuario` (`idUsuario`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`idRol`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id_usuario`),
  ADD UNIQUE KEY `cedula` (`cedula`),
  ADD KEY `tipo_rol` (`tipo_rol`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `bitacora`
--
ALTER TABLE `bitacora`
  MODIFY `id_bitacora` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=203;

--
-- AUTO_INCREMENT de la tabla `buzon`
--
ALTER TABLE `buzon`
  MODIFY `idBuzon` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=94;

--
-- AUTO_INCREMENT de la tabla `catalogo`
--
ALTER TABLE `catalogo`
  MODIFY `id_catalogo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `clasificacion`
--
ALTER TABLE `clasificacion`
  MODIFY `id_clasificacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=120;

--
-- AUTO_INCREMENT de la tabla `diversidad`
--
ALTER TABLE `diversidad`
  MODIFY `id_diversidad` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `mensajes`
--
ALTER TABLE `mensajes`
  MODIFY `idMsj` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `modulos`
--
ALTER TABLE `modulos`
  MODIFY `idModulo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `modulo_roles`
--
ALTER TABLE `modulo_roles`
  MODIFY `idModulo_rol` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `operativo`
--
ALTER TABLE `operativo`
  MODIFY `id_operativo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT de la tabla `operativo_diversidad`
--
ALTER TABLE `operativo_diversidad`
  MODIFY `id_operativo_diversidad` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `operativo_usuario`
--
ALTER TABLE `operativo_usuario`
  MODIFY `id_operativo_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=102;

--
-- AUTO_INCREMENT de la tabla `permisos`
--
ALTER TABLE `permisos`
  MODIFY `idPermiso` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT de la tabla `permisos_usuario`
--
ALTER TABLE `permisos_usuario`
  MODIFY `idRolUs` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3170;

--
-- AUTO_INCREMENT de la tabla `preguntas_seguridad`
--
ALTER TABLE `preguntas_seguridad`
  MODIFY `idPregunta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `idRol` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `bitacora`
--
ALTER TABLE `bitacora`
  ADD CONSTRAINT `bitacora_ibfk_1` FOREIGN KEY (`id_usuario_sistema`) REFERENCES `usuario` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `catalogo`
--
ALTER TABLE `catalogo`
  ADD CONSTRAINT `catalogo_ibfk_1` FOREIGN KEY (`id_clasificacion`) REFERENCES `clasificacion` (`id_clasificacion`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `diversidad`
--
ALTER TABLE `diversidad`
  ADD CONSTRAINT `diversidad_ibfk_1` FOREIGN KEY (`id_catalogo`) REFERENCES `catalogo` (`id_catalogo`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `mensajes`
--
ALTER TABLE `mensajes`
  ADD CONSTRAINT `mensajes_ibfk_1` FOREIGN KEY (`idEmisor`) REFERENCES `usuario` (`id_usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `mensajes_ibfk_2` FOREIGN KEY (`idBuzon`) REFERENCES `buzon` (`idBuzon`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `modulo_roles`
--
ALTER TABLE `modulo_roles`
  ADD CONSTRAINT `modulo_roles_ibfk_1` FOREIGN KEY (`idModulo`) REFERENCES `modulos` (`idModulo`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `modulo_roles_ibfk_2` FOREIGN KEY (`idRol`) REFERENCES `roles` (`idRol`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `operativo_diversidad`
--
ALTER TABLE `operativo_diversidad`
  ADD CONSTRAINT `operativo_diversidad_ibfk_1` FOREIGN KEY (`id_operativo_nuevo`) REFERENCES `operativo` (`id_operativo`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `operativo_diversidad_ibfk_2` FOREIGN KEY (`id_diversidad_operativo`) REFERENCES `diversidad` (`id_diversidad`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `operativo_usuario`
--
ALTER TABLE `operativo_usuario`
  ADD CONSTRAINT `operativo_usuario_ibfk_1` FOREIGN KEY (`id_usuario_`) REFERENCES `usuario` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `operativo_usuario_ibfk_2` FOREIGN KEY (`id_operativo_`) REFERENCES `operativo` (`id_operativo`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `permisos`
--
ALTER TABLE `permisos`
  ADD CONSTRAINT `permisos_ibfk_1` FOREIGN KEY (`idModulo`) REFERENCES `modulos` (`idModulo`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `permisos_usuario`
--
ALTER TABLE `permisos_usuario`
  ADD CONSTRAINT `permisos_usuario_ibfk_1` FOREIGN KEY (`idUsuario`) REFERENCES `usuario` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `permisos_usuario_ibfk_2` FOREIGN KEY (`idPermiso`) REFERENCES `permisos` (`idPermiso`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Filtros para la tabla `preguntas_seguridad`
--
ALTER TABLE `preguntas_seguridad`
  ADD CONSTRAINT `preguntas_seguridad_ibfk_1` FOREIGN KEY (`idUsuario`) REFERENCES `usuario` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`tipo_rol`) REFERENCES `roles` (`idRol`) ON DELETE NO ACTION ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
