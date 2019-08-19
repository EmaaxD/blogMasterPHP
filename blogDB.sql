-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 20-08-2019 a las 01:24:28
-- Versión del servidor: 10.1.25-MariaDB
-- Versión de PHP: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `blogmasterphp`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `id_categoria` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id_categoria`, `nombre`) VALUES
(1, 'desarrollo web'),
(2, 'software'),
(3, 'seguridad informatica'),
(4, 'juegos'),
(5, 'robotica'),
(6, 'japon');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `entradas`
--

CREATE TABLE `entradas` (
  `id_entrada` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_cate` int(11) NOT NULL,
  `titulo` varchar(100) NOT NULL,
  `descripcion` text,
  `fecha` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `entradas`
--

INSERT INTO `entradas` (`id_entrada`, `id_usuario`, `id_cate`, `titulo`, `descripcion`, `fecha`) VALUES
(1, 1, 1, 'developer php', 'desarrolla aplicaciones dinamicas con el mejor lenguaje de desarrollo web PHP', '2019-07-26'),
(2, 4, 2, 'oracle dejara de vivir', 'segun los medio dicen que oracle dejara de ser usado por razones logicas', '2019-06-10'),
(3, 5, 4, 'me encanta el fornitee', 'desde que salio me encanto y lo juego a menudo me gusta el forniteee', '2019-06-03'),
(4, 6, 3, 'todo es penetrable', 'no ahi nada que no se pueda hackear o obtener informacion de otra cpu', '2019-05-15'),
(5, 8, 6, 'los mejores animes lpm', 'en japon se elavoran los animes mas visto y vendido a niver mundial', '2019-05-15'),
(6, 7, 6, 'comensara con emicion de anime', 'netflix acepto el trato de pasar anime en su plataforma', '2019-03-01'),
(7, 15, 1, 'lo mejor del desarrollo web', 'ultimamente esta teniendo mas tendencia en el mundo', '2019-07-26'),
(12, 15, 1, 'pepazoo', 'esta re bueno el papaso', '2019-08-18'),
(14, 15, 2, 'emaaa', 'asdasd', '2019-08-19'),
(15, 15, 2, 'darling in the fanxx', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\r\ntempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\r\nquis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\r\nconsequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\r\ncillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\r\nproident, sunt in culpa qui officia deserunt mollit anim id est laborum.', '2019-08-19');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_user` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `apellido` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `fecha` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_user`, `nombre`, `apellido`, `email`, `password`, `fecha`) VALUES
(1, 'ema', 'mamani', 'asd@as.com', '$2y$12$esefcTIQL9D1cvWIUjqw/.8t5/3tWJIeWJdx/ClV/zCAk9CQCxcpu', '2019-07-18'),
(4, 'thomas', 'mamani', 'thomas@as.com', '$2y$12$4eZ/Z6No90OCyEgOWD6chur58RYt.D6T2KfH9wiXPhsk53Y4ZPoUW', '2019-07-18'),
(5, 'cami', 'chan', 'cami@chan.com', '$2y$12$Aa9hzkGu8xzyG/EEjDzP.e0QMCih1D2ao8EdMNU9l1GONQ/4swai6', '2019-07-18'),
(6, 'high', 'score', 'high@score.com', '$2y$12$aRyh1qZn0DaDUgYWFGAFQueEdjcWcTvxDL5W21eUHxuSZtbe9I5IS', '2019-07-18'),
(7, 'netflix', 'anime', 'netflix@anime.com', '$2y$12$F5b3v9dIysEwQ9JKN/jGxeXN4TMea7BVutKQulazTfvazeJnN0TVK', '2019-07-18'),
(8, 'crunchy', 'roll', 'crunchy@roll.com', '$2y$12$bo.bhLmrG4qqIR/Hf0ZB4.Z3fbrBYBi7idojS.ErJqxid8daTE6Sm', '2019-07-18'),
(9, 'need&#34;', 'as&#39;', 'asda@as.com', '$2y$12$aIyHtNJ9wizMZcek5Eckpef3b.G4huE7oathhz5mDePAFvt/xqhBO', '2019-07-25'),
(10, 'asd&#34;', 'asdasd&#34;', 'asd@asd.com', '$2y$12$xO6UzyG7tnVxEtAQW7PyLesseUpzAxoAomkppaP5aKqi/hkSajURq', '2019-07-25'),
(12, 'asd\"', 'asdad\'', 'asdad@asd.com', '$2y$12$Z4yWNKF1VXtME.vHuWvXu.OVou3wxgWiNEs.kMv8X6Y53kZCbPopm', '2019-07-25'),
(13, 'black\"', 'bear\'', 'asdasd@asd.com', '$2y$12$.nxOFMiePGbPr7ZGnZFGgutNwduI/PbHRAIxEHhspOKh/8yXln5by', '2019-07-25'),
(14, 'young', 'tuhg', 'asda@asd.com', '$2y$12$2E9LQY1oGJkaV.BLcy2BreYuAC9NMDuGlLdKN24gw0euUaK5KmiEy', '2019-07-25'),
(15, 'manuuu', 'mamani', 'manu@manu.com', '$2y$12$gsCa9D7iqjr4uTvG1wlSYuL8Rl1xy32TL0.xQnDVU84A.kMcw.tVK', '2019-07-25'),
(16, 'ivo', 'mamani', 'ivo@gmail.com', '$2y$12$EvSlfIeAzbi/aUWzlQ1uOO1gY1gIWY4JuZ9ezEBXQuhmuNYaD7zYu', '2019-07-28'),
(17, 'test', 'test', 'test@test.com', '$2y$12$St5scGxgycXGTICPwE2U4ubh6HW7yeYMaV71QJZnQe4ySXIIKunYu', '2019-07-28');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id_categoria`);

--
-- Indices de la tabla `entradas`
--
ALTER TABLE `entradas`
  ADD PRIMARY KEY (`id_entrada`),
  ADD KEY `fk_entrada_usuario` (`id_usuario`),
  ADD KEY `fk_entrada_categoria` (`id_cate`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `uq_email` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id_categoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT de la tabla `entradas`
--
ALTER TABLE `entradas`
  MODIFY `id_entrada` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `entradas`
--
ALTER TABLE `entradas`
  ADD CONSTRAINT `fk_entrada_categoria` FOREIGN KEY (`id_cate`) REFERENCES `categorias` (`id_categoria`),
  ADD CONSTRAINT `fk_entrada_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_user`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
