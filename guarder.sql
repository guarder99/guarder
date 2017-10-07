-- phpMyAdmin SQL Dump
-- version 4.3.11
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 15-03-2017 a las 16:44:31
-- Versión del servidor: 5.6.24
-- Versión de PHP: 5.6.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `guarder`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `acudiente`
--

CREATE TABLE IF NOT EXISTS `acudiente` (
  `idAcudiente` mediumint(9) NOT NULL,
  `nombreAcudiente` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `cedulaAcudiente` varchar(10) COLLATE utf8_spanish_ci NOT NULL,
  `celularAcudiente` varchar(10) COLLATE utf8_spanish_ci NOT NULL,
  `parentescoAcudiente` varchar(50) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=1033 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `acudiente`
--

INSERT INTO `acudiente` (`idAcudiente`, `nombreAcudiente`, `cedulaAcudiente`, `celularAcudiente`, `parentescoAcudiente`) VALUES
(1022, 'luz angela lopez garcia', '65145785', '3214587562', 'tia maternal'),
(1023, 'Sebastian pardo castillo', '100548523', '3103562458', 'chofer'),
(1024, 'milena meneses ardila', '65875623', '7589563', 'persona de confianza'),
(1025, 'Carolina diaz', '100245862', '3145628956', 'Tia'),
(1032, 'Sara Reyes', '100548578', '3102548652', 'Chofer');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `auditoria`
--

CREATE TABLE IF NOT EXISTS `auditoria` (
  `idAuditoria` int(11) NOT NULL,
  `FechaAuditoria` date NOT NULL,
  `DescripcionAuditoria` varchar(80) COLLATE utf8_spanish_ci NOT NULL,
  `idUsuarioAuditoria` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=233 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `auditoria`
--

INSERT INTO `auditoria` (`idAuditoria`, `FechaAuditoria`, `DescripcionAuditoria`, `idUsuarioAuditoria`) VALUES
(110, '2002-02-22', 'primera auditoria por reglamento de educacion', 60),
(120, '2015-01-10', 'auditoria por instalacion de un software nuevo y sofisticado', 61),
(123, '2017-03-14', 'ModificoAcudiente', 65),
(124, '2017-03-14', 'InsertoAcudiente', 65),
(125, '2017-03-14', 'ModificoAvances', 65),
(126, '2017-03-14', 'InsertoCursos', 65),
(127, '2017-03-14', 'InsertoDepartamento', 65),
(128, '2017-03-14', 'InsertoDepartamento', 65),
(129, '2017-03-14', 'InsertoDepartamento', 65),
(130, '2017-03-14', 'EliminoDepartamento', 65),
(131, '2017-03-14', 'InsertoEnfermedad', 65),
(132, '2017-03-14', 'EliminoEnfermedad', 65),
(133, '2017-03-14', 'InsertoEnfermedad', 65),
(134, '2017-03-14', 'InsertoEstudiante', 65),
(135, '2017-03-14', 'EliminoEstudiante', 65),
(136, '2017-03-14', 'InsertoIncidencia', 65),
(137, '2017-03-14', 'EliminoIncidencia', 65),
(138, '2017-03-15', 'EliminoMatricula', 65),
(139, '2017-03-15', 'EliminoMatricula', 65),
(140, '2017-03-15', 'EliminoMatricula', 65),
(141, '2017-03-15', 'InsertoMensualidad', 65),
(142, '2017-03-15', 'InsertoMunicipio', 65),
(143, '2017-03-15', 'ModificoMunicipio', 65),
(144, '2017-03-15', 'InsertoNivel', 65),
(145, '2017-03-15', 'ModificoPadres', 65),
(146, '2017-03-15', 'ModificoPadres', 65),
(147, '2017-03-15', 'ModificoPadres', 65),
(148, '2017-03-15', 'EliminoParentesco', 65),
(149, '2017-03-15', 'EliminoParentesco', 65),
(150, '2017-03-15', 'EliminoParentesco', 65),
(151, '2017-03-15', 'InsertoParentesco', 65),
(152, '2017-03-15', 'EliminoParentesco', 65),
(153, '2017-03-15', 'InsertoProfesores', 65),
(154, '2017-03-15', 'InsertoRestricciones', 65),
(155, '2017-03-15', 'EliminoRestricciones', 65),
(156, '2017-03-15', 'InsertoRoles', 65),
(157, '2017-03-15', 'InsertoUsuario', 65),
(158, '2017-03-15', 'InsertoRestricciones', 65),
(159, '2017-03-15', 'EliminoRestricciones', 69),
(160, '2017-03-15', 'InsertoRestricciones', 69),
(161, '2017-03-15', 'InsertoUsuario', 69),
(162, '2017-03-15', 'ModificoRoles', 70),
(163, '2017-03-15', 'EliminoRoles', 70),
(164, '2017-03-15', 'ModificoRoles', 70),
(165, '2017-03-15', 'ModificoRoles', 70),
(166, '2017-03-15', 'ModificoRoles', 70),
(167, '2017-03-15', 'ModificoRoles', 70),
(168, '2017-03-15', 'ModificoRoles', 70),
(169, '2017-03-15', 'ModificoRoles', 70),
(170, '2017-03-15', 'ModificoRoles', 70),
(171, '2017-03-15', 'ModificoRoles', 70),
(172, '2017-03-15', 'ModificoRoles', 70),
(173, '2017-03-15', 'ModificoRoles', 70),
(174, '2017-03-15', 'ModificoRoles', 70),
(175, '2017-03-15', 'ModificoRoles', 70),
(176, '2017-03-15', 'ModificoRoles', 70),
(177, '2017-03-15', 'ModificoRoles', 70),
(178, '2017-03-15', 'ModificoRoles', 70),
(179, '2017-03-15', 'ModificoRoles', 70),
(180, '2017-03-15', 'ModificoRoles', 70),
(181, '2017-03-15', 'ModificoRoles', 70),
(182, '2017-03-15', 'ModificoRoles', 70),
(183, '2017-03-15', 'ModificoRoles', 70),
(184, '2017-03-15', 'ModificoRoles', 70),
(185, '2017-03-15', 'ModificoRoles', 70),
(186, '2017-03-15', 'ModificoRoles', 70),
(187, '2017-03-15', 'ModificoRoles', 70),
(188, '2017-03-15', 'ModificoRoles', 70),
(189, '2017-03-15', 'ModificoRoles', 70),
(190, '2017-03-15', 'ModificoRoles', 70),
(191, '2017-03-15', 'ModificoRoles', 70),
(192, '2017-03-15', 'ModificoRoles', 70),
(193, '2017-03-15', 'ModificoRoles', 70),
(194, '2017-03-15', 'ModificoRoles', 70),
(195, '2017-03-15', 'ModificoRoles', 70),
(196, '2017-03-15', 'ModificoRoles', 70),
(197, '2017-03-15', 'ModificoRoles', 70),
(198, '2017-03-15', 'ModificoRoles', 70),
(199, '2017-03-15', 'ModificoRoles', 70),
(200, '2017-03-15', 'ModificoRoles', 70),
(201, '2017-03-15', 'ModificoRoles', 70),
(202, '2017-03-15', 'ModificoRoles', 70),
(203, '2017-03-15', 'InsertoMensualidad', 70),
(204, '2017-03-15', 'ModificoRoles', 70),
(205, '2017-03-15', 'ModificoRoles', 70),
(206, '2017-03-15', 'ModificoRoles', 70),
(207, '2017-03-15', 'ModificoRoles', 70),
(208, '2017-03-15', 'ModificoRoles', 70),
(209, '2017-03-15', 'ModificoRoles', 70),
(210, '2017-03-15', 'ModificoRoles', 70),
(211, '2017-03-15', 'ModificoRoles', 70),
(212, '2017-03-15', 'ModificoRoles', 70),
(213, '2017-03-15', 'ModificoRoles', 70),
(214, '2017-03-15', 'ModificoRoles', 70),
(215, '2017-03-15', 'ModificoRoles', 70),
(216, '2017-03-15', 'ModificoRoles', 70),
(217, '2017-03-15', 'ModificoRoles', 70),
(218, '2017-03-15', 'ModificoRoles', 70),
(219, '2017-03-15', 'ModificoRoles', 70),
(220, '2017-03-15', 'ModificoRoles', 70),
(221, '2017-03-15', 'ModificoRoles', 70),
(222, '2017-03-15', 'ModificoRoles', 70),
(223, '2017-03-15', 'ModificoRoles', 70),
(224, '2017-03-15', 'ModificoRoles', 70),
(225, '2017-03-15', 'ModificoRoles', 70),
(226, '2017-03-15', 'ModificoRoles', 70),
(227, '2017-03-15', 'ModificoRoles', 70),
(228, '2017-03-15', 'ModificoRoles', 70),
(229, '2017-03-15', 'ModificoRoles', 70),
(230, '2017-03-15', 'ModificoRoles', 70),
(231, '2017-03-15', 'ModificoRoles', 70),
(232, '2017-03-15', 'ModificoRoles', 70);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `avances`
--

CREATE TABLE IF NOT EXISTS `avances` (
  `idAvances` mediumint(4) NOT NULL,
  `fechaAvances` date NOT NULL,
  `avancesFisicos` text COLLATE utf8_spanish_ci NOT NULL,
  `avancesGeneral` text COLLATE utf8_spanish_ci NOT NULL,
  `avancesVerbal` text COLLATE utf8_spanish_ci NOT NULL,
  `avancesSocial` text COLLATE utf8_spanish_ci NOT NULL,
  `avancesMatematicos` text COLLATE utf8_spanish_ci NOT NULL,
  `idEstudianteAvance` mediumint(4) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=115 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `avances`
--

INSERT INTO `avances` (`idAvances`, `fechaAvances`, `avancesFisicos`, `avancesGeneral`, `avancesVerbal`, `avancesSocial`, `avancesMatematicos`, `idEstudianteAvance`) VALUES
(110, '2000-11-29', 'cumple con las operaciones o ejercicios que se le han propuesto', 'esta atrazado en algunos cambios o situaciones necesita ayuda de sus padres', 'atrasado en habla y reconocimiento de algunas palabras necesita ayuda con terapias para bocabulario', 'no se comunica con sus compañeros es muy agresivo necesita terapia ', 'no sabe nada de matemáticas ni números ni nada ', 22),
(111, '2002-11-29', 'cumple con las operaciones o ejercicios que se le han propuesto', 'expresa sus emociones es muy activo y hace que sus compañeros lo sigan se ve que esta bien educado y tiene buen ', 'se comunica bien con sus profesores y se le entiende las palabras que dice', 'se comunica con todos sus compañeros lo que cual hace que sea sociable', 'reconoce alguna operaciones y numero pero le falta mas practica', 23),
(112, '2000-11-30', 'cumple con las operaciones o ejercicios que se le han propuesto\r\n', 'esta atrazado en algunos cambios o situaciones necesita ayuda de sus padres', 'atrasado en habla y reconocimiento de algunas palabras necesita ayuda con terapias para bocabulario', 'no se comunica con sus compañeros es muy agresivo necesita terapia ', 'reconoce alguna operaciones y numero pero le falta mas practica', 24),
(113, '2002-11-30', 'cumple con las operaciones o ejercicios que se le han propuesto', 'esta atrazado en algunos cambios o situaciones necesita ayuda de sus padres', 'esta atrazado en algunos cambios o situaciones necesita ayuda de sus padres', 'se comunica con todos sus compañeros lo que cual hace que sea sociable', 'expresa sus emociones es muy activo y hace que sus compañeros lo sigan se ve que esta bien educado y tiene buen ', 24);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cursos`
--

CREATE TABLE IF NOT EXISTS `cursos` (
  `idCursos` tinyint(4) NOT NULL,
  `gradosCursos` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `idProfesoresCursos` smallint(4) NOT NULL,
  `idNivelCursos` tinyint(4) NOT NULL,
  `idAuxiliarCursos` smallint(4) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `cursos`
--

INSERT INTO `cursos` (`idCursos`, `gradosCursos`, `idProfesoresCursos`, `idNivelCursos`, `idAuxiliarCursos`) VALUES
(25, 'grado cero', 26, 1, 26),
(26, 'grado prescolar', 25, 2, 25),
(27, 'grado quinder', 27, 3, 27),
(28, 'grado prequinder', 28, 2, 28),
(29, 'grado cero', 28, 2, 26),
(31, 'grado quinder', 28, 2, 26);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `departamento`
--

CREATE TABLE IF NOT EXISTS `departamento` (
  `idDepartamento` tinyint(4) NOT NULL,
  `nombreDepartamento` varchar(30) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=125 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `departamento`
--

INSERT INTO `departamento` (`idDepartamento`, `nombreDepartamento`) VALUES
(122, 'santander');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `enfermedad`
--

CREATE TABLE IF NOT EXISTS `enfermedad` (
  `idEnfermedad` smallint(4) NOT NULL,
  `descripcionEnfermedad` varchar(40) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `enfermedad`
--

INSERT INTO `enfermedad` (`idEnfermedad`, `descripcionEnfermedad`) VALUES
(1, 'infeccion en garganta: amigdalitis'),
(2, 'fiebe a altos grados: sintomas de gripa'),
(3, 'gripa avansada'),
(4, 'desnutricion, paludismo'),
(6, 'gripa ');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estudiante`
--

CREATE TABLE IF NOT EXISTS `estudiante` (
  `idEstudiante` mediumint(4) NOT NULL,
  `nombreEstudiante` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `apellidoEstudiante` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `fechaNacimientoEstudiante` date NOT NULL,
  `generoEstudiante` char(1) COLLATE utf8_spanish_ci NOT NULL,
  `idMunicipioEstudiante` smallint(4) NOT NULL,
  `idPadreEstudiante` mediumint(4) NOT NULL,
  `idMadreEstudiante` mediumint(4) NOT NULL,
  `idAcudienteEstudiante` mediumint(4) NOT NULL,
  `idCursoEstudiante` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `estudiante`
--

INSERT INTO `estudiante` (`idEstudiante`, `nombreEstudiante`, `apellidoEstudiante`, `fechaNacimientoEstudiante`, `generoEstudiante`, `idMunicipioEstudiante`, `idPadreEstudiante`, `idMadreEstudiante`, `idAcudienteEstudiante`, `idCursoEstudiante`) VALUES
(22, 'anamaria', 'garcia lopez', '2010-02-25', 'f', 1, 2, 1, 1022, 25),
(23, 'sebastian', 'diaz hurtado', '2000-01-25', 'm', 2, 4, 3, 1025, 26),
(24, 'luis carlos', 'olarte olarte', '2000-05-10', 'm', 1, 6, 5, 1023, 27),
(25, 'luisa fernanda', 'manjarez serrana', '2001-10-25', 'f', 2, 8, 7, 1024, 28);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `incidencia`
--

CREATE TABLE IF NOT EXISTS `incidencia` (
  `idIncidencia` mediumint(4) NOT NULL,
  `fechayHoraIncidencia` datetime NOT NULL,
  `descripcionIncidencia` varchar(80) COLLATE utf8_spanish_ci NOT NULL,
  `idEnfermedadIncidencia` smallint(4) NOT NULL,
  `idEstudianteIncidencia` mediumint(4) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `incidencia`
--

INSERT INTO `incidencia` (`idIncidencia`, `fechayHoraIncidencia`, `descripcionIncidencia`, `idEnfermedadIncidencia`, `idEstudianteIncidencia`) VALUES
(2, '2012-06-16 10:00:00', 'despues de aplicar el tratamiento presenta la persistencia de la infeccion ', 1, 22),
(3, '2012-06-20 08:00:00', 'presenta otra vez la desnutricion despues de meses atra avisar al bienestar', 4, 25),
(4, '2012-06-25 10:30:00', 'presenta una bronquitis aguda lo que lleba a hospitalizacion', 3, 23);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `matricula`
--

CREATE TABLE IF NOT EXISTS `matricula` (
  `idMatricula` mediumint(4) NOT NULL,
  `fechaMatricula` date NOT NULL,
  `valorMatricula` mediumint(20) NOT NULL,
  `idEstudiantesMatricula` mediumint(4) NOT NULL,
  `idCursosMatricula` tinyint(4) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=114 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `matricula`
--

INSERT INTO `matricula` (`idMatricula`, `fechaMatricula`, `valorMatricula`, `idEstudiantesMatricula`, `idCursosMatricula`) VALUES
(102, '2011-02-22', 150000, 22, 25),
(103, '2012-02-16', 150000, 23, 26),
(104, '2013-02-11', 160000, 24, 27),
(105, '2014-01-25', 170000, 25, 28),
(106, '2016-01-02', 150000, 22, 26),
(109, '2017-03-01', 150000, 23, 26),
(110, '2017-03-01', 170000, 25, 29);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mensualidad`
--

CREATE TABLE IF NOT EXISTS `mensualidad` (
  `idMensualidad` mediumint(4) NOT NULL,
  `valorMensualidad` mediumint(20) NOT NULL,
  `mesPagoMensualidad` tinyint(20) NOT NULL,
  `fechaMensualidad` date NOT NULL,
  `idEstudiantesMensualidad` mediumint(4) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `mensualidad`
--

INSERT INTO `mensualidad` (`idMensualidad`, `valorMensualidad`, `mesPagoMensualidad`, `fechaMensualidad`, `idEstudiantesMensualidad`) VALUES
(1, 800000, 3, '2012-02-03', 22),
(2, 50000, 1, '2012-12-03', 23),
(3, 250000, 5, '2012-06-22', 24),
(4, 20000, 6, '2013-12-06', 25),
(5, 100000, 2, '2017-02-28', 25),
(6, 150000, 3, '2017-03-01', 24);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `municipio`
--

CREATE TABLE IF NOT EXISTS `municipio` (
  `idMunicipio` smallint(4) NOT NULL,
  `nombreMunicipio` varchar(90) COLLATE utf8_spanish_ci NOT NULL,
  `idDepartamentoMunicipio` tinyint(4) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `municipio`
--

INSERT INTO `municipio` (`idMunicipio`, `nombreMunicipio`, `idDepartamentoMunicipio`) VALUES
(1, 'velez', 122),
(2, 'barbosa', 122),
(3, 'la paz', 122);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `nivel`
--

CREATE TABLE IF NOT EXISTS `nivel` (
  `idNivel` tinyint(4) NOT NULL,
  `nombreNivel` varchar(20) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `nivel`
--

INSERT INTO `nivel` (`idNivel`, `nombreNivel`) VALUES
(1, 'principiante'),
(2, 'medio'),
(3, 'avanzado'),
(4, 'Principiante');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `padres`
--

CREATE TABLE IF NOT EXISTS `padres` (
  `idPadres` mediumint(4) NOT NULL,
  `nombrePadres` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `apellidoPadres` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `documentoPadres` varchar(10) COLLATE utf8_spanish_ci NOT NULL,
  `celularPadres` varchar(11) COLLATE utf8_spanish_ci NOT NULL,
  `direccionPadres` varchar(40) COLLATE utf8_spanish_ci NOT NULL,
  `correoPadres` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `estratoPadres` tinyint(1) NOT NULL,
  `parentesco` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `idParentescoPadres` tinyint(4) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `padres`
--

INSERT INTO `padres` (`idPadres`, `nombrePadres`, `apellidoPadres`, `documentoPadres`, `celularPadres`, `direccionPadres`, `correoPadres`, `estratoPadres`, `parentesco`, `idParentescoPadres`) VALUES
(1, 'ana maria', 'lopez garcia', '65231480', '3124587569', 'kra 6 calle 4-5', 'no tiene', 2, 'madre', 4),
(2, 'angelmaria', 'garcia saavedra', '65369856', '3214589568', 'kra 6 calle 4-5', 'angelito@gmail.com', 2, 'padre', 2),
(3, 'ana lucia', 'hurtado garcia', '100562487', '3225689562', 'calle 6 N 10 - 11', 'ana123@google.com', 3, 'madre', 2),
(4, 'juan carlos', 'diaz mendez', '100562489', '3187548956', 'calle 6 N 10 - 11', 'juancho@hotmail.es', 3, 'padre', 3),
(5, 'luz marina', 'olarte saavedra', '65895423', '314458756', 'vereda san veicente', 'luz10@hotmail.es', 4, 'madre', 5),
(6, 'martin ulpiano', 'olarte meneses', '65895426', '3158756235', 'vereda san vicente', 'martinUl@homail.com', 4, 'padre', 6),
(7, 'sandra milena', 'serrano garcia', '65874512', '3124587542', 'calle 3 kra 5', 'sandrita@miempresa.es', 3, 'madre', 7),
(8, 'gonsalo', 'manjarez meneses', '98654475', '3189562547', 'calle 3 kra 5', 'gosalin@hotmail.com', 3, 'padre', 8),
(19, 'sara', 'reyes', '216515', '512512', 'calle 4 kra 7', 'sara@gmail.es', 2, '', 8);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `parentesco`
--

CREATE TABLE IF NOT EXISTS `parentesco` (
  `idParentesco` tinyint(4) NOT NULL,
  `descripcionParentesco` varchar(20) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `parentesco`
--

INSERT INTO `parentesco` (`idParentesco`, `descripcionParentesco`) VALUES
(1, 'madre'),
(2, 'tio'),
(3, 'padre'),
(4, 'primo'),
(5, 'tia'),
(6, 'abuelo'),
(7, 'abuela'),
(8, 'niñera');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `profesores`
--

CREATE TABLE IF NOT EXISTS `profesores` (
  `idProfesores` smallint(4) NOT NULL,
  `documentoProfesores` varchar(11) COLLATE utf8_spanish_ci NOT NULL,
  `nombreProfesores` varchar(70) COLLATE utf8_spanish_ci NOT NULL,
  `celularProfesores` varchar(11) COLLATE utf8_spanish_ci NOT NULL,
  `direccionProfesores` varchar(60) COLLATE utf8_spanish_ci NOT NULL,
  `correoProfesores` varchar(70) COLLATE utf8_spanish_ci NOT NULL,
  `fechaIngreso` date NOT NULL,
  `idEstudiantesProfesores` mediumint(4) NOT NULL,
  `esAuxiliar` varchar(2) COLLATE utf8_spanish_ci NOT NULL,
  `idEsAuxiliar` smallint(4) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `profesores`
--

INSERT INTO `profesores` (`idProfesores`, `documentoProfesores`, `nombreProfesores`, `celularProfesores`, `direccionProfesores`, `correoProfesores`, `fechaIngreso`, `idEstudiantesProfesores`, `esAuxiliar`, `idEsAuxiliar`) VALUES
(25, '65847562', 'mario mendez ordoñez', '3214587562', 'calle 6 N 10', 'mario34@profesores.es', '2010-06-25', 22, 'no', 1),
(26, '69523625', 'juliana meneses ardila', '7514236', 'kra 9 N 9-12 barbosa', 'juliana36@profesores.es', '2013-01-02', 23, 'si', 11),
(27, '65425895', 'juan luis guerra mateus', '3225689652', 'calle 1 N 67', 'juanluis38@profesore.es', '2010-08-26', 24, 'no', 2),
(28, '10025632', 'luisa fernanda', '7589652', 'calle 8 kra 6 N 01-2', 'luisafernanda40@profesores.es', '2011-02-02', 25, 'si', 12),
(30, '1005485726', 'Antonia Mateus', '3202287592', 'calle 10 Kra 8', 'atoni12@profesores.es', '2017-01-09', 25, 'si', 11);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `restricciones`
--

CREATE TABLE IF NOT EXISTS `restricciones` (
  `idRestricciones` mediumint(9) NOT NULL,
  `descripcionRestricciones` varchar(90) COLLATE utf8_spanish_ci NOT NULL,
  `idEstudianteRestricciones` mediumint(9) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `restricciones`
--

INSERT INTO `restricciones` (`idRestricciones`, `descripcionRestricciones`, `idEstudianteRestricciones`) VALUES
(10, 'alergica a las fresas', 22),
(11, 'alergico al mani', 23),
(12, 'renitis aguda', 24),
(13, 'alergica a las fresas', 25),
(17, 'gripa', 22);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE IF NOT EXISTS `roles` (
  `idRoles` tinyint(4) NOT NULL,
  `nombreRoles` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `estudianteRoles` varchar(4) COLLATE utf8_spanish_ci NOT NULL,
  `municipioRoles` varchar(4) COLLATE utf8_spanish_ci NOT NULL,
  `departamentoRoles` varchar(4) COLLATE utf8_spanish_ci NOT NULL,
  `padresRoles` varchar(4) COLLATE utf8_spanish_ci NOT NULL,
  `parentescoRoles` varchar(4) COLLATE utf8_spanish_ci NOT NULL,
  `incidenciaRoles` varchar(4) COLLATE utf8_spanish_ci NOT NULL,
  `enfermedadRoles` varchar(4) COLLATE utf8_spanish_ci NOT NULL,
  `restriccionesRoles` varchar(4) COLLATE utf8_spanish_ci NOT NULL,
  `avancesRoles` varchar(4) COLLATE utf8_spanish_ci NOT NULL,
  `profesoresRoles` varchar(4) COLLATE utf8_spanish_ci NOT NULL,
  `cursosRoles` varchar(4) COLLATE utf8_spanish_ci NOT NULL,
  `nivelRoles` varchar(4) COLLATE utf8_spanish_ci NOT NULL,
  `matriculaRoles` varchar(4) COLLATE utf8_spanish_ci NOT NULL,
  `mensualidadRoles` varchar(4) COLLATE utf8_spanish_ci NOT NULL,
  `acudienteRoles` varchar(4) COLLATE utf8_spanish_ci NOT NULL,
  `usuarioRoles` varchar(4) COLLATE utf8_spanish_ci NOT NULL,
  `rolesRoles` varchar(4) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`idRoles`, `nombreRoles`, `estudianteRoles`, `municipioRoles`, `departamentoRoles`, `padresRoles`, `parentescoRoles`, `incidenciaRoles`, `enfermedadRoles`, `restriccionesRoles`, `avancesRoles`, `profesoresRoles`, `cursosRoles`, `nivelRoles`, `matriculaRoles`, `mensualidadRoles`, `acudienteRoles`, `usuarioRoles`, `rolesRoles`) VALUES
(5, 'administrador', 'crud', 'r', 'crud', 'r', 'r', 'crud', 'crud', 'crud', 'r', 'crud', 'crud', 'crud', 'crud', 'crud', 'crud', 'r', 'crud'),
(6, 'estudiante', 'crud', 'crud', 'crud', 'crud', 'crud', 'crud', 'crud', 'crud', 'crud', 'crud', 'crud', 'crud', 'crud', 'crud', 'crud', 'crud', 'crud'),
(7, 'padres', 'crud', 'crud', 'crud', 'crud', 'crud', 'crud', 'crud', 'crud', 'crud', 'crud', 'crud', 'crud', 'crud', 'crud', 'crud', 'crud', 'crud'),
(8, 'profesores', 'crud', 'crud', 'crud', 'crud', 'crud', 'crud', 'crud', 'crud', 'crud', 'crud', 'crud', 'crud', 'crud', 'crud', 'crud', 'crud', 'crud'),
(9, 'padre', 'crud', 'crud', 'crud', 'crud', 'crud', 'crud', 'crud', 'crud', 'crud', 'crud', 'crud', 'crud', 'crud', 'crud', 'crud', 'crud', 'crud'),
(10, 'administrador', 'crud', 'crud', 'crud', 'crud', 'crud', 'crud', 'crud', 'crud', 'crud', 'crud', 'crud', 'crud', 'crud', 'crud', 'crud', 'crud', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE IF NOT EXISTS `usuario` (
  `idUsuario` int(11) NOT NULL,
  `nombreUsuario` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `correoUsuario` varchar(60) COLLATE utf8_spanish_ci NOT NULL,
  `claveUsuario` varbinary(64) NOT NULL,
  `fechaRegistroUsuario` date NOT NULL,
  `celularUsuario` varchar(11) COLLATE utf8_spanish_ci NOT NULL,
  `idRolesUsuario` tinyint(4) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=71 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`idUsuario`, `nombreUsuario`, `correoUsuario`, `claveUsuario`, `fechaRegistroUsuario`, `celularUsuario`, `idRolesUsuario`) VALUES
(60, 'ana maria lopez garcia', 'anamaria@gmail.com', 0x35393934343731616262303131313261666363313831353966366363373462346635313162393938303664613539623363616635613963313733636163666335, '2011-02-01', '3124587569', 7),
(61, 'mario mendez ordoñez', 'mario07@hotmail.com', 0x30336163363734323136663365313563373631656531613565323535663036373935333632336338623338386234343539653133663937386437633834366634, '2010-06-25', '3214587562', 8),
(62, 'melissa Marin ', 'melissa24@hotmail.com', 0x64346538393733653034653635376134633631363637343833383033353664636563643134326235363133376264336139653664306437353734346131343832, '2017-02-03', '31321154891', 9),
(63, 'Julian ruiz', 'julian@gmail.com', 0x63653066656537653631663963373466313131306630653539343061383062346630353966313839323137643063336432366262343139363064346266353937, '2017-01-02', '3312547868', 6),
(64, 'Pedro Perez ', 'pedro@gmail.com', 0x65653563643764356439366338383734313137383931623263393261303336663936393138653636633130326263363938616537373534326331383666393831, '2017-02-02', '3132115489', 5),
(65, 'Dayana Velasco', 'dayana@hotmail.com', 0x65663739376338313138663032646662363439363037646435643366386337363233303438633963303633643533326363393563356564376138393861363466, '2017-12-01', '251452585', 8),
(67, 'Marina Perez', 'marina10@hotmail.com', 0x65653761376236393232643136323238313635366331623766366163373230656634626430383665373838653265643262346465653561373465386162346638, '2017-03-01', '3105478110', 7),
(69, 'Hugo Fontecha', 'hugo7@hotmail.es', 0x37356134636236396537393038343962323138616637363564623738636339643935363339663435326666623438653030316665616262343039336262663663, '2017-03-01', '3132445879', 5),
(70, 'Edith Hernandez', 'edith10@hotmal.com', 0x32323766313832633965366664333838623336663033366230313339626436613234633363663533626330313134323937383833356630373038663165366235, '2017-03-02', '3144807585', 5);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `acudiente`
--
ALTER TABLE `acudiente`
  ADD PRIMARY KEY (`idAcudiente`);

--
-- Indices de la tabla `auditoria`
--
ALTER TABLE `auditoria`
  ADD PRIMARY KEY (`idAuditoria`), ADD KEY `idUsuarioAuditoria` (`idUsuarioAuditoria`);

--
-- Indices de la tabla `avances`
--
ALTER TABLE `avances`
  ADD PRIMARY KEY (`idAvances`), ADD KEY `idEstudiante` (`idEstudianteAvance`);

--
-- Indices de la tabla `cursos`
--
ALTER TABLE `cursos`
  ADD PRIMARY KEY (`idCursos`), ADD KEY `idProfesorCurso` (`idProfesoresCursos`), ADD KEY `idNivelesCursos` (`idNivelCursos`), ADD KEY `idAxuxiliarCursos` (`idAuxiliarCursos`);

--
-- Indices de la tabla `departamento`
--
ALTER TABLE `departamento`
  ADD PRIMARY KEY (`idDepartamento`);

--
-- Indices de la tabla `enfermedad`
--
ALTER TABLE `enfermedad`
  ADD PRIMARY KEY (`idEnfermedad`);

--
-- Indices de la tabla `estudiante`
--
ALTER TABLE `estudiante`
  ADD PRIMARY KEY (`idEstudiante`), ADD KEY `idMunicipioEstudiante` (`idMunicipioEstudiante`), ADD KEY `idPadreEstudiante` (`idPadreEstudiante`), ADD KEY `idMadreEstudiante` (`idMadreEstudiante`), ADD KEY `idAcudienteEstudiante` (`idAcudienteEstudiante`), ADD KEY `idCursoEstudiante` (`idCursoEstudiante`);

--
-- Indices de la tabla `incidencia`
--
ALTER TABLE `incidencia`
  ADD PRIMARY KEY (`idIncidencia`), ADD KEY `idEnfermedadIncidencia` (`idEnfermedadIncidencia`), ADD KEY `idEstudianteIncidencia` (`idEstudianteIncidencia`), ADD KEY `idEnfermedadIncidencia_2` (`idEnfermedadIncidencia`), ADD KEY `idEstudianteIncidencia_2` (`idEstudianteIncidencia`);

--
-- Indices de la tabla `matricula`
--
ALTER TABLE `matricula`
  ADD PRIMARY KEY (`idMatricula`), ADD KEY `idEstudiantesMatricula` (`idEstudiantesMatricula`), ADD KEY `idCursosMatricula` (`idCursosMatricula`);

--
-- Indices de la tabla `mensualidad`
--
ALTER TABLE `mensualidad`
  ADD PRIMARY KEY (`idMensualidad`), ADD KEY `idEstudiantesMensualidad` (`idEstudiantesMensualidad`);

--
-- Indices de la tabla `municipio`
--
ALTER TABLE `municipio`
  ADD PRIMARY KEY (`idMunicipio`), ADD KEY `idDepartamentoMunicipio` (`idDepartamentoMunicipio`);

--
-- Indices de la tabla `nivel`
--
ALTER TABLE `nivel`
  ADD PRIMARY KEY (`idNivel`);

--
-- Indices de la tabla `padres`
--
ALTER TABLE `padres`
  ADD PRIMARY KEY (`idPadres`), ADD KEY `idParentescoPadres` (`idParentescoPadres`);

--
-- Indices de la tabla `parentesco`
--
ALTER TABLE `parentesco`
  ADD PRIMARY KEY (`idParentesco`);

--
-- Indices de la tabla `profesores`
--
ALTER TABLE `profesores`
  ADD PRIMARY KEY (`idProfesores`), ADD KEY `idEstudiantesProfesores` (`idEstudiantesProfesores`), ADD KEY `idEstudiantesProfesores_2` (`idEstudiantesProfesores`);

--
-- Indices de la tabla `restricciones`
--
ALTER TABLE `restricciones`
  ADD PRIMARY KEY (`idRestricciones`), ADD KEY `idEstudianteRestricciones` (`idEstudianteRestricciones`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`idRoles`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`idUsuario`), ADD KEY `idRolesUsuario` (`idRolesUsuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `acudiente`
--
ALTER TABLE `acudiente`
  MODIFY `idAcudiente` mediumint(9) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=1033;
--
-- AUTO_INCREMENT de la tabla `auditoria`
--
ALTER TABLE `auditoria`
  MODIFY `idAuditoria` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=233;
--
-- AUTO_INCREMENT de la tabla `avances`
--
ALTER TABLE `avances`
  MODIFY `idAvances` mediumint(4) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=115;
--
-- AUTO_INCREMENT de la tabla `cursos`
--
ALTER TABLE `cursos`
  MODIFY `idCursos` tinyint(4) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=32;
--
-- AUTO_INCREMENT de la tabla `departamento`
--
ALTER TABLE `departamento`
  MODIFY `idDepartamento` tinyint(4) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=125;
--
-- AUTO_INCREMENT de la tabla `enfermedad`
--
ALTER TABLE `enfermedad`
  MODIFY `idEnfermedad` smallint(4) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT de la tabla `estudiante`
--
ALTER TABLE `estudiante`
  MODIFY `idEstudiante` mediumint(4) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=30;
--
-- AUTO_INCREMENT de la tabla `incidencia`
--
ALTER TABLE `incidencia`
  MODIFY `idIncidencia` mediumint(4) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT de la tabla `matricula`
--
ALTER TABLE `matricula`
  MODIFY `idMatricula` mediumint(4) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=114;
--
-- AUTO_INCREMENT de la tabla `mensualidad`
--
ALTER TABLE `mensualidad`
  MODIFY `idMensualidad` mediumint(4) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT de la tabla `municipio`
--
ALTER TABLE `municipio`
  MODIFY `idMunicipio` smallint(4) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `nivel`
--
ALTER TABLE `nivel`
  MODIFY `idNivel` tinyint(4) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `padres`
--
ALTER TABLE `padres`
  MODIFY `idPadres` mediumint(4) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT de la tabla `parentesco`
--
ALTER TABLE `parentesco`
  MODIFY `idParentesco` tinyint(4) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT de la tabla `profesores`
--
ALTER TABLE `profesores`
  MODIFY `idProfesores` smallint(4) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=31;
--
-- AUTO_INCREMENT de la tabla `restricciones`
--
ALTER TABLE `restricciones`
  MODIFY `idRestricciones` mediumint(9) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `idRoles` tinyint(4) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `idUsuario` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=71;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `auditoria`
--
ALTER TABLE `auditoria`
ADD CONSTRAINT `fkidUsuarioAuditoria` FOREIGN KEY (`idUsuarioAuditoria`) REFERENCES `usuario` (`idUsuario`);

--
-- Filtros para la tabla `avances`
--
ALTER TABLE `avances`
ADD CONSTRAINT `fkidEstudianteAvances` FOREIGN KEY (`idEstudianteAvance`) REFERENCES `estudiante` (`idEstudiante`);

--
-- Filtros para la tabla `cursos`
--
ALTER TABLE `cursos`
ADD CONSTRAINT `fkidAxuliarCursos` FOREIGN KEY (`idAuxiliarCursos`) REFERENCES `profesores` (`idProfesores`),
ADD CONSTRAINT `fkidNivelesCursos` FOREIGN KEY (`idNivelCursos`) REFERENCES `nivel` (`idNivel`),
ADD CONSTRAINT `fkidProfesoresCursos` FOREIGN KEY (`idProfesoresCursos`) REFERENCES `profesores` (`idProfesores`);

--
-- Filtros para la tabla `estudiante`
--
ALTER TABLE `estudiante`
ADD CONSTRAINT `fkiMadreEstudiante` FOREIGN KEY (`idMadreEstudiante`) REFERENCES `padres` (`idPadres`),
ADD CONSTRAINT `fkidAcudiente` FOREIGN KEY (`idAcudienteEstudiante`) REFERENCES `acudiente` (`idAcudiente`),
ADD CONSTRAINT `fkidMunicipioEstudiante` FOREIGN KEY (`idMunicipioEstudiante`) REFERENCES `municipio` (`idMunicipio`),
ADD CONSTRAINT `fkidPadreEstudiante` FOREIGN KEY (`idPadreEstudiante`) REFERENCES `padres` (`idPadres`);

--
-- Filtros para la tabla `incidencia`
--
ALTER TABLE `incidencia`
ADD CONSTRAINT `fkidEnfermedadIncidencia` FOREIGN KEY (`idEnfermedadIncidencia`) REFERENCES `enfermedad` (`idEnfermedad`),
ADD CONSTRAINT `fkidEstudianteIncidencia` FOREIGN KEY (`idEstudianteIncidencia`) REFERENCES `estudiante` (`idEstudiante`);

--
-- Filtros para la tabla `matricula`
--
ALTER TABLE `matricula`
ADD CONSTRAINT `fkidCursosMatricula` FOREIGN KEY (`idCursosMatricula`) REFERENCES `cursos` (`idCursos`),
ADD CONSTRAINT `fkidEstudianteMaticula` FOREIGN KEY (`idEstudiantesMatricula`) REFERENCES `estudiante` (`idEstudiante`);

--
-- Filtros para la tabla `mensualidad`
--
ALTER TABLE `mensualidad`
ADD CONSTRAINT ` idEstudianteMensualidad` FOREIGN KEY (`idEstudiantesMensualidad`) REFERENCES `estudiante` (`idEstudiante`);

--
-- Filtros para la tabla `municipio`
--
ALTER TABLE `municipio`
ADD CONSTRAINT `fkdepartamentomunicipio` FOREIGN KEY (`idDepartamentoMunicipio`) REFERENCES `departamento` (`idDepartamento`);

--
-- Filtros para la tabla `padres`
--
ALTER TABLE `padres`
ADD CONSTRAINT `fkidParentescoPadres` FOREIGN KEY (`idParentescoPadres`) REFERENCES `parentesco` (`idParentesco`);

--
-- Filtros para la tabla `profesores`
--
ALTER TABLE `profesores`
ADD CONSTRAINT `fkidEstudiantesProfesores` FOREIGN KEY (`idEstudiantesProfesores`) REFERENCES `estudiante` (`idEstudiante`);

--
-- Filtros para la tabla `restricciones`
--
ALTER TABLE `restricciones`
ADD CONSTRAINT `fkidEstudianteRestricciones` FOREIGN KEY (`idEstudianteRestricciones`) REFERENCES `estudiante` (`idEstudiante`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
ADD CONSTRAINT `fkidRolesUsuario` FOREIGN KEY (`idRolesUsuario`) REFERENCES `roles` (`idRoles`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
