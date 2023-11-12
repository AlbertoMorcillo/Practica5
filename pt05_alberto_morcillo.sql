-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 12-11-2023 a las 17:48:18
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `pt05_alberto_morcillo`
--
CREATE DATABASE IF NOT EXISTS `pt05_alberto_morcillo` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `pt05_alberto_morcillo`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `articles`
--

DROP TABLE IF EXISTS `articles`;
CREATE TABLE IF NOT EXISTS `articles` (
  `article_id` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` text DEFAULT NULL,
  `article` text DEFAULT NULL,
  `usuari_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`article_id`),
  KEY `usuari_id` (`usuari_id`)
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `articles`
--

INSERT INTO `articles` (`article_id`, `titulo`, `article`, `usuari_id`) VALUES
(1, '', 'Cualquiera capaz de hacerte enfadar se convierte en tu dueño.', NULL),
(2, '', 'La felicidad y la libertad comienzan con la clara comprensión de un principio: algunas cosas están bajo nuestro control y otras no.', NULL),
(3, '', 'Incluso si aún no eres un Sócrates, debes vivir como quien desea ser un Sócrates.', NULL),
(4, '', 'El amigo debe ser como el dinero; antes de necesitarlo, es necesario saber su valor.', NULL),
(5, '', 'Es mejor cambiar de opinión que mantenerse en la errónea.', NULL),
(6, '', 'El único conocimiento verdadero es saber que no sabes nada.', NULL),
(7, '', 'Los monos son demasiado buenos para que el hombre pueda descender de ellos', NULL),
(8, '', 'La palabra más soez y la carta más grosera son mejores, son más educadas que el silencio', NULL),
(9, '', 'La mentira más común es aquella con la que las personas se engañan a sí mismas', NULL),
(10, '', 'Es difícil encontrar la felicidad dentro de uno mismo, pero es imposible encontrarla en otro lugar.', NULL),
(11, '', 'El que no disfruta de la soledad, no amará a la libertad.', NULL),
(12, '', 'Toda verdad pasa por tres etapas. Primero, es ridiculizada. En segundo lugar, es violentamente rechazada. En tercer lugar, es aceptada como evidente por sí misma.', NULL),
(13, '', 'El hombre es el único animal que causa dolor a otros sin más objeto que querer hacerlo.', NULL),
(14, '', 'Mi ambición está limitada por mi pereza.', NULL),
(15, '', 'Pensar es el diálogo del alma consigo misma.', NULL),
(16, '', 'La música es para el alma lo que la gimnasia para el cuerpo.', NULL),
(17, '', 'El sabio querrá estar siempre con quien sea mejor que él.', NULL),
(18, '', 'El objetivo de la educación es la virtud y la meta de convertirse en un buen ciudadano.', NULL),
(19, '', 'La civilización es el triunfo de la persuasión sobre la fuerza.', NULL),
(20, '', 'La ignorancia es la semilla de todo mal.', NULL),
(23, '', 'hola', NULL),
(24, '', 'prueba', NULL),
(25, '', 'prueba2', NULL),
(26, '', 'a', NULL),
(27, '', 'aaa', NULL),
(28, '', 'aaaa', NULL),
(29, '', 'hola', NULL),
(33, '', 'Soy pepito', 9),
(35, '', 'que tal', 9),
(36, '', 'que tal', 9),
(37, '', 'a', 9),
(38, '', 'Ver para creer', 3),
(39, '', 'haha', 3),
(40, '', 'a', 3),
(41, '', 'a', 3),
(42, '', 'a', 3),
(43, '', 'a', 3),
(48, '', 'a', 3),
(50, NULL, 'asdad', 13);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuaris`
--

DROP TABLE IF EXISTS `usuaris`;
CREATE TABLE IF NOT EXISTS `usuaris` (
  `usuari_id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `contrasena` varchar(255) NOT NULL,
  `token` text NOT NULL,
  PRIMARY KEY (`usuari_id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuaris`
--

INSERT INTO `usuaris` (`usuari_id`, `email`, `contrasena`, `token`) VALUES
(3, 'alberto@gmail.com', 'Ab1234567', ''),
(4, 'alberto2@gmail.com', 'Ab1234567', ''),
(5, 'alberto3@gmail.com', 'Ab1234567', ''),
(6, 'alberto4@gmail.com', 'Ab1234567', ''),
(7, 'alberto9@hotmail.com', 'Ab1234567', ''),
(8, 'informaticomondongo@gmail.com', 'Ab1234567', ''),
(9, 'pepito@gmail.com', '$2y$10$g.OgOBB4g71VtQZx0GsSUOIJjq4c3fM4P.VHIXCyMnV5xcmonrxa6', ''),
(11, 'rand@gmail.com', '$2y$10$hcBl2AWIIJfYiFVeU74ROOaDw.B4rumV93D2KbzEdM0od6CO9vroO', ''),
(12, 'admin@gmail.com', '$2y$10$fZlHMayi1iq9eEUT62oqf./wICMVgI/5dsRmRm6CdJHygufuaX1wG', ''),
(13, 'a.morcillo@sapalomera.cat', '$2y$10$Srj8Pd9FS0gpIyQMcHXbQuL9fm6voXw8/DagIFGC6.VGiDykko1BW', '6877b8f72a0c635c6cfb2aecccfb14b5'),
(16, 'asasas@gmail.com', '$2y$10$RO9tdNSMKk38Sk9ZT9Lh5epvezKnXDGvSKhUQojqSvCKNn3pN1NOS', '');

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `articles`
--
ALTER TABLE `articles`
  ADD CONSTRAINT `articles_ibfk_1` FOREIGN KEY (`usuari_id`) REFERENCES `usuaris` (`usuari_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
