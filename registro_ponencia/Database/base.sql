-- phpMyAdmin SQL Dump
-- version 4.1.6
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 06-12-2014 a las 18:17:44
-- Versión del servidor: 5.6.16
-- Versión de PHP: 5.5.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `base`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_usuarios`
--

CREATE TABLE IF NOT EXISTS `tbl_usuarios` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID único de usuario',
  `usr_nombre` varchar(120) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Nombre completo del usuario',
  `usr_puesto` varchar(80) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Puesto que desempeña el usuario',
  `usr_nick` varchar(25) COLLATE utf8_unicode_ci NOT NULL COMMENT 'NickName de usuario',
  `usr_status` enum('Activo','Suspendido') COLLATE utf8_unicode_ci NOT NULL COMMENT 'Status de la cuenta de usuario',
  PRIMARY KEY (`id_user`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Tabla de datos usuarios' AUTO_INCREMENT=19 ;

--
-- Volcado de datos para la tabla `tbl_usuarios`
--

INSERT INTO `tbl_usuarios` (`id_user`, `usr_nombre`, `usr_puesto`, `usr_nick`, `usr_status`) VALUES
(5, 'Juan Carlos Arcila Díaz', 'administrador', 'caly', 'Activo'),
(17, 'Liliana Arcila Díaz', 'Administrador', 'liliana', 'Suspendido'),
(16, 'Luiza Salas', 'Vendedor', 'luiza', 'Activo'),
(18, 'Ana Díaz', 'Almacenero', 'anita', 'Suspendido');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
