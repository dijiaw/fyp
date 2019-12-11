-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jul 30, 2019 at 07:22 PM
-- Server version: 10.1.36-MariaDB
-- PHP Version: 7.2.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `FYP`
--

-- --------------------------------------------------------

--
-- Table structure for table `area`
--

CREATE TABLE `area` (
  `areaid` int(11) NOT NULL,
  `area` varchar(20) NOT NULL,
  `leadid` int(11) NOT NULL,
  `adminid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `area`
--

INSERT INTO `area` (`areaid`, `area`, `leadid`, `adminid`) VALUES
(1, 'ECAL', 14, 144),
(2, 'ENIC', 86, 145),
(3, 'INON', 114, 146),
(4, 'HRH', 95, 147),
(5, 'Others', 147, 147);

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE `course` (
  `courseid` int(11) NOT NULL,
  `area` varchar(20) NOT NULL,
  `code` varchar(20) NOT NULL,
  `coursename` varchar(100) NOT NULL,
  `exam` varchar(10) DEFAULT 'yes',
  `offered` varchar(10) DEFAULT 'yes',
  `ugpg` varchar(10) DEFAULT 'ug'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`courseid`, `area`, `code`, `coursename`, `exam`, `offered`, `ugpg`) VALUES
(1, 'INON', 'EE0001', 'IMPACT OF ELECTROMAGNETIC RADIATION ON HUMANS', 'no', 'yes', 'UG'),
(2, 'Others', 'EE0040 / IM0040', 'ENGINEERS AND SOCIETY', 'yes', 'yes', 'UG'),
(3, 'ENIC', 'EE1002', 'PHYSICS FOUNDATION FOR ELECTRICAL AND ELECTRONIC ENGINEERING', 'yes', 'yes', 'UG'),
(4, 'ENIC', 'EE1003', 'INTRODUCTION TO MATERIALS FOR ELECTRONICS', 'yes', 'yes', 'UG'),
(5, 'ECAL', 'EE2001', 'CIRCUIT ANALYSIS', 'yes', 'yes', 'UG'),
(6, 'ENIC', 'EE2002', 'ANALOG ELECTRONICS', 'yes', 'yes', 'UG'),
(7, 'ENIC', 'EE2003', 'SEMICONDUCTOR FUNDAMENTALS', 'yes', 'yes', 'UG'),
(8, 'ENIC', 'EE2004 / IM1004', 'DIGITAL ELECTRONICS', 'yes', 'yes', 'UG'),
(9, 'ECAL', 'EE2006 / IM2006', 'ENGINEERING MATHEMATICS I', 'yes', 'yes', 'UG'),
(10, 'ECAL', 'EE2007 / IM2007', 'ENGINEERING MATHEMATICS II', 'yes', 'yes', 'UG'),
(11, 'INON', 'EE2008 / IM1001', 'DATA STRUCTURES AND ALGORITHMS', 'yes', 'yes', 'UG'),
(12, 'INON', 'EE2010 / IM2004', 'SIGNALS AND SYSTEMS', 'yes', 'yes', 'UG'),
(13, 'INON', 'EE3001', 'ENGINEERING ELECTROMAGNETICS', 'yes', 'yes', 'UG'),
(14, 'INON', 'EE3002 / IM2002', 'MICROPROCESSORS', 'yes', 'yes', 'UG'),
(15, 'ECAL', 'EE3010', 'ELECTRICAL DEVICES AND MACHINES', 'yes', 'yes', 'UG'),
(16, 'ECAL', 'EE3011', 'MODELLING AND CONTROL', 'yes', 'yes', 'UG'),
(17, 'INON', 'EE3012 / IM3002', 'COMMUNICATION PRINCIPLES', 'yes', 'yes', 'UG'),
(18, 'ENIC', 'EE3013', 'SEMICONDUCTOR DEVICES AND PROCESSING', 'yes', 'yes', 'UG'),
(19, 'INON', 'EE3014 / IM3001', 'DIGITAL SIGNAL PROCESSING', 'yes', 'yes', 'UG'),
(20, 'ECAL', 'EE3015', 'POWER SYSTEMS AND PROTECTION', 'yes', 'yes', 'UG'),
(21, 'INON', 'EE3017 / IM2003', 'COMPUTER COMMUNICATIONS', 'yes', 'yes', 'UG'),
(22, 'ENIC', 'EE3018', 'INTRODUCTION TO PHOTONICS', 'yes', 'yes', 'UG'),
(23, 'ENIC', 'EE3019', 'INTEGRATED ELECTRONICS', 'yes', 'yes', 'UG'),
(24, 'INON', 'EE4001 / IM2001', 'SOFTWARE ENGINEERING', 'yes', 'yes', 'UG'),
(25, 'INON', 'EE4105 / IM4105', 'CELLULAR COMMUNICATION SYSTEM DESIGN', 'no', 'yes', 'UG'),
(26, 'INON', 'EE4109', 'WIRELESS SYSTEM DESIGN', 'no', 'yes', 'UG'),
(27, 'INON', 'EE4110', 'OPTICAL COMMUNICATION SYSTEM DESIGN', 'yes', 'yes', 'UG'),
(28, 'INON', 'EE4152 / IM4152', 'DIGITAL COMMUNICATIONS', 'yes', 'yes', 'UG'),
(29, 'INON', 'EE4153 / IM4153', 'TELECOMMUNICATION SYSTEMS', 'no', 'yes', 'UG'),
(30, 'INON', 'EE4188 / IM4188', 'WIRELESS COMMUNICATIONS', 'yes', 'yes', 'UG'),
(31, 'INON', 'EE4190', 'INTRODUCTION TO MODERN RADAR', 'yes', 'yes', 'UG'),
(32, 'ECAL', 'EE4207', 'CONTROL ENGINEERING DESIGN', 'yes', 'yes', 'UG'),
(33, 'ECAL', 'EE4208', 'INTELLIGENT SYSTEMS DESIGN', 'no', 'yes', 'UG'),
(34, 'ECAL', 'EE4265', 'PROCESS CONTROL SYSTEMS', 'yes', 'yes', 'UG'),
(35, 'ECAL', 'EE4266', 'COMPUTER VISION', 'yes', 'yes', 'UG'),
(36, 'ECAL', 'EE4268', 'ROBOTICS AND AUTOMATION', 'yes', 'yes', 'UG'),
(37, 'ECAL', 'EE4273', 'DIGITAL CONTROL SYSTEMS', 'no', 'yes', 'UG'),
(38, 'ECAL', 'EE4285', 'COMPUTATIONAL INTELLIGENCE', 'no', 'yes', 'UG'),
(39, 'ENIC', 'EE4303', 'MIXED-SIGNAL IC DESIGN', 'yes', 'yes', 'UG'),
(40, 'ENIC', 'EE4304', 'RADIO FREQUENCY INTEGRATED SYSTEM DESIGN', 'no', 'yes', 'UG'),
(41, 'ENIC', 'EE4305', 'DIGITAL DESIGN WITH HDL', 'yes', 'yes', 'UG'),
(42, 'ENIC', 'EE4340', 'VLSI SYSTEMS', 'yes', 'yes', 'UG'),
(43, 'ENIC', 'EE4341', 'ADVANCED ANALOG CIRCUITS', 'yes', 'yes', 'UG'),
(44, 'ENIC', 'EE4343', 'RADIO FREQUENCY CIRCUITS', 'no', 'yes', 'UG'),
(45, 'ENIC', 'EE4344', 'ANALYSIS AND DESIGN OF INTEGRATED CIRCUITS', 'no', 'yes', 'UG'),
(46, 'INON', 'EE4413 / IM4413', 'DSP SYSTEM DESIGN', 'yes', 'yes', 'UG'),
(47, 'INON', 'EE4455 / IM4455', 'EMBEDDED SYSTEMS', 'no', 'yes', 'UG'),
(48, 'INON', 'EE4475 / IM4475', 'AUDIO SIGNAL PROCESSING', 'yes', 'yes', 'UG'),
(49, 'INON', 'EE4476 / IM4476', 'IMAGE PROCESSING', 'yes', 'yes', 'UG'),
(50, 'INON', 'EE4478 / IM4478', 'DIGITAL VIDEO PROCESSING', 'yes', 'no', 'UG'),
(51, 'INON', 'EE4483 / IM4483', 'ARTIFICIAL INTELLIGENCE AND DATA MINING', 'yes', 'yes', 'UG'),
(52, 'ECAL', 'EE4503', 'POWER ENGINEERING DESIGN', 'yes', 'yes', 'UG'),
(53, 'ECAL', 'EE4504', 'DESIGN OF CLEAN ENERGY SYSTEMS', 'no', 'yes', 'UG'),
(54, 'ECAL', 'EE4530', 'POWER SYSTEM ANALYSIS AND CONTROL', 'yes', 'yes', 'UG'),
(55, 'ECAL', 'EE4532', 'POWER ELECTRONICS AND DRIVES', 'yes', 'yes', 'UG'),
(56, 'ECAL', 'EE4534', 'MODERN DISTRIBUTION SYSTEMS WITH RENEWABLE RESOURCES', 'no', 'yes', 'UG'),
(57, 'ENIC', 'EE4613', 'CMOS PROCESS AND DEVICE SIMULATION', 'yes', 'yes', 'UG'),
(58, 'ENIC', 'EE4614', 'DEVICE PARAMETER EXTRACTION AND LAYOUT IMPLEMENTATION', 'no', 'yes', 'UG'),
(59, 'ENIC', 'EE4646', 'VLSI TECHNOLOGY', 'yes', 'yes', 'UG'),
(60, 'ENIC', 'EE4647', 'MICROELECTRONIC DEVICES', 'yes', 'yes', 'UG'),
(61, 'INON', 'EE4717 / IM4717', 'WEB APPLICATION DESIGN', 'yes', 'yes', 'UG'),
(62, 'INON', 'EE4718 / IM4718', 'ENTERPRISE NETWORK DESIGN', 'yes', 'no', 'UG'),
(63, 'INON', 'EE4756 / IM4756', 'COMPUTER ARCHITECTURE', 'yes', 'no', 'UG'),
(64, 'INON', 'EE4758 / IM3003', 'INFORMATION SECURITY', 'yes', 'yes', 'UG'),
(65, 'INON', 'EE4761 / IM4761', 'COMPUTER NETWORKING', 'yes', 'yes', 'UG'),
(66, 'INON', 'EE4791 / IM4791', 'DATABASE SYSTEMS', 'yes', 'no', 'UG'),
(67, 'ENIC', 'EE4838', 'LASER ENGINEERING AND APPLICATIONS', 'yes', 'no', 'UG'),
(68, 'Others', 'EE4840', 'BIOPHOTONICS', 'yes', 'no', 'UG'),
(69, 'ECAL', 'EE4901', 'BIOMEDICAL CONTROL SYSTEM DESIGN', 'yes', 'yes', 'UG'),
(70, 'ECAL', 'EE4902', 'DESIGN OF MEDICAL INFORMATION PROCESSING SYSTEMS', 'yes', 'no', 'UG'),
(71, 'ECAL', 'EE4903', 'PHYSIOLOGICAL SYSTEMS ANALYSIS', 'yes', 'yes', 'UG'),
(72, 'ECAL', 'EE4904', 'BIOMEDICAL INSTRUMENTATION', 'yes', 'no', 'UG'),
(73, 'INON', 'EE8061', 'INNOVATION AND TECHNOLOGY MANAGEMENT', 'yes', 'yes', 'UG'),
(74, 'ENIC', 'EE8064', 'INTELLECTUAL PROPERTY FOR ELECTRONICS ENGINEERS', 'yes', 'no', 'UG'),
(75, 'Others', 'EE8067', 'CERAMICS IN HISTORY, ARTS, GEMSTONES, ENVIRONMENT, AND MODERN LIFE', 'yes', 'no', 'UG'),
(76, 'INON', 'EE8084', 'CYBER SECURITY', 'yes', 'yes', 'UG'),
(77, 'ECAL', 'EE8085', 'ELECTRIFICATION FOR THE BUILT ENVIRONMENT', 'yes', 'yes', 'UG'),
(78, 'ENIC', 'EE8086', 'ASTRONOMY - STARS, GALAXIES AND COSMOLOGY', 'yes', 'yes', 'UG'),
(79, 'ECAL', 'EE8087', 'LIVING WITH MATHEMATICS', 'no', 'yes', 'UG'),
(80, 'INON', 'EE8092', 'DIGITAL LIFESTYLE', 'no', 'yes', 'UG'),
(81, 'ENIC', 'EE8093', 'ENERGY DEVICES FOR SUSTAINABLE URBAN ENVIRONMENT', 'yes', 'no', 'UG'),
(82, 'INON', 'EE8094', 'IMPACT OF ELECTROMAGNETIC RADIATION ON HUMANS', 'yes', 'no', 'UG'),
(83, 'ENIC', 'FE1008', 'COMPUTING', 'yes', 'no', 'UG'),
(84, 'ENIC', 'IM1002', 'ANALOG ELECTRONICS', 'yes', 'no', 'UG'),
(85, 'INON', 'IM1003', 'OBJECT-ORIENTED PROGRAMMING', 'yes', 'no', 'UG'),
(86, 'INON', 'EE1005 / IM1005', 'FROM COMPUTATIONAL THINKING TO PROGRAMMING', 'yes', 'yes', 'UG'),
(87, 'ENIC', 'EE6307', 'ANALOG INTEGRATED CIRCUIT DESIGN', 'yes', 'yes', 'PG'),
(88, 'ENIC', 'EE6601', 'ADVANCED WAFER PROCESSING', 'yes', 'yes', 'PG'),
(89, 'ENIC', 'EE6602', 'QUALITY AND RELIABILITY ENGINEERING', 'yes', 'yes', 'PG'),
(90, 'ENIC', 'EE6610', 'INTEGRATED CIRCUIT PACKAGING', 'yes', 'yes', 'PG'),
(91, 'ENIC', 'EE7602', 'DESIGN, FABRICATION AND ANALYSIS OF ELECTRONICS DEVICES', 'yes', 'yes', 'PG'),
(92, 'ENIC', 'EE7603', 'ADVANCED SEMICONDUCTOR PHYSICS', 'yes', 'yes', 'PG'),
(93, 'INON', 'EE6010', 'PROJECT MANAGEMENT & TECHNOPRENEURSHIP', 'yes', 'yes', 'PG'),
(94, 'INON', 'EE6122', 'OPTICAL FIBRE COMMUNICATIONS', 'yes', 'yes', 'PG');

-- --------------------------------------------------------

--
-- Table structure for table `examstaff`
--

CREATE TABLE `examstaff` (
  `examid` int(11) NOT NULL,
  `staffid` int(11) NOT NULL,
  `courseid` int(11) NOT NULL,
  `role` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `examstaff`
--

INSERT INTO `examstaff` (`examid`, `staffid`, `courseid`, `role`) VALUES
(1, 99, 5, 'C'),
(2, 127, 9, 'C'),
(3, 67, 10, 'C'),
(4, 59, 15, 'C'),
(5, 41, 16, 'C'),
(6, 36, 20, 'C'),
(7, 14, 32, 'C'),
(8, 12, 34, 'C'),
(9, 118, 35, 'C'),
(10, 19, 36, 'C'),
(11, 98, 52, 'C'),
(12, 33, 54, 'C'),
(13, 2, 55, 'C'),
(14, 99, 69, 'C'),
(15, 76, 71, 'C'),
(16, 33, 77, 'C'),
(17, 99, 5, 'E'),
(19, 127, 9, 'E'),
(20, 116, 9, 'E'),
(21, 67, 10, 'E'),
(22, 26, 10, 'E'),
(23, 59, 15, 'E'),
(24, 14, 15, 'E'),
(25, 41, 16, 'E'),
(26, 130, 16, 'E'),
(27, 36, 20, 'E'),
(28, 122, 20, 'E'),
(29, 14, 32, 'E'),
(30, 67, 32, 'E'),
(31, 12, 34, 'E'),
(32, 118, 35, 'E'),
(33, 19, 36, 'E'),
(34, 117, 36, 'E'),
(35, 148, 52, 'E'),
(36, 33, 54, 'E'),
(37, 124, 54, 'E'),
(38, 2, 55, 'E'),
(39, 111, 55, 'E'),
(40, 99, 69, 'E'),
(41, 76, 71, 'E'),
(42, 149, 77, 'E'),
(43, 99, 5, 'M'),
(44, 48, 5, 'M'),
(45, 127, 9, 'M'),
(46, 116, 9, 'M'),
(47, 67, 10, 'M'),
(48, 26, 10, 'M'),
(49, 59, 15, 'M'),
(50, 14, 15, 'M'),
(51, 41, 16, 'M'),
(52, 130, 16, 'M'),
(53, 36, 20, 'M'),
(54, 122, 20, 'M'),
(55, 14, 32, 'M'),
(56, 67, 32, 'M'),
(57, 101, 34, 'M'),
(58, 26, 35, 'M'),
(59, 19, 36, 'M'),
(60, 117, 36, 'M'),
(61, 98, 52, 'M'),
(62, 33, 54, 'M'),
(63, 124, 54, 'M'),
(64, 2, 55, 'M'),
(65, 111, 55, 'M'),
(66, 126, 69, 'M'),
(67, 48, 71, 'M'),
(68, 33, 77, 'M'),
(69, 137, 3, 'C'),
(70, 119, 4, 'C'),
(71, 105, 86, 'C'),
(72, 141, 6, 'C'),
(73, 109, 7, 'C'),
(74, 35, 8, 'C'),
(75, 81, 18, 'C'),
(76, 123, 22, 'C'),
(77, 47, 23, 'C'),
(78, 96, 39, 'C'),
(79, 40, 41, 'C'),
(80, 52, 42, 'C'),
(81, 89, 43, 'C'),
(82, 143, 57, 'C'),
(83, 22, 59, 'C'),
(84, 6, 60, 'C'),
(85, 133, 78, 'C'),
(86, 134, 3, 'E'),
(87, 87, 3, 'E'),
(88, 137, 3, 'E'),
(89, 49, 4, 'E'),
(90, 119, 4, 'E'),
(91, 105, 86, 'E'),
(92, 115, 86, 'E'),
(93, 141, 6, 'E'),
(94, 7, 6, 'E'),
(95, 16, 6, 'E'),
(96, 96, 6, 'E'),
(97, 97, 6, 'E'),
(98, 109, 7, 'E'),
(99, 81, 7, 'E'),
(100, 86, 7, 'E'),
(101, 35, 8, 'E'),
(102, 38, 8, 'E'),
(103, 81, 18, 'E'),
(104, 112, 18, 'E'),
(105, 123, 22, 'E'),
(106, 73, 22, 'E'),
(107, 47, 23, 'E'),
(108, 38, 23, 'E'),
(109, 96, 39, 'E'),
(110, 135, 39, 'E'),
(111, 40, 41, 'E'),
(112, 52, 42, 'E'),
(113, 54, 42, 'E'),
(114, 89, 43, 'E'),
(115, 141, 43, 'E'),
(116, 143, 57, 'E'),
(117, 22, 57, 'E'),
(118, 22, 59, 'E'),
(119, 6, 60, 'E'),
(120, 136, 60, 'E'),
(121, 133, 78, 'E'),
(122, 84, 78, 'E'),
(123, 134, 3, 'M'),
(124, 87, 3, 'M'),
(125, 137, 3, 'M'),
(126, 49, 4, 'M'),
(127, 119, 4, 'M'),
(128, 105, 86, 'M'),
(129, 115, 86, 'M'),
(130, 141, 6, 'M'),
(131, 7, 6, 'M'),
(132, 16, 6, 'M'),
(133, 96, 6, 'M'),
(134, 97, 6, 'M'),
(135, 109, 7, 'M'),
(136, 81, 7, 'M'),
(137, 86, 7, 'M'),
(138, 35, 8, 'M'),
(139, 38, 8, 'M'),
(140, 81, 18, 'M'),
(141, 112, 18, 'M'),
(142, 123, 22, 'M'),
(143, 73, 22, 'M'),
(144, 47, 23, 'M'),
(145, 38, 23, 'M'),
(146, 96, 39, 'M'),
(147, 135, 39, 'M'),
(148, 16, 41, 'M'),
(149, 52, 42, 'M'),
(150, 54, 42, 'M'),
(151, 89, 43, 'M'),
(152, 141, 43, 'M'),
(153, 143, 57, 'M'),
(154, 22, 57, 'M'),
(155, 150, 59, 'M'),
(156, 6, 60, 'M'),
(157, 136, 60, 'M'),
(158, 133, 78, 'M'),
(159, 84, 78, 'M'),
(160, 113, 11, 'C'),
(161, 74, 12, 'C'),
(162, 107, 13, 'C'),
(163, 13, 14, 'C'),
(164, 31, 17, 'C'),
(165, 132, 19, 'C'),
(166, 92, 21, 'C'),
(167, 20, 24, 'C'),
(168, 95, 27, 'C'),
(169, 63, 28, 'C'),
(170, 102, 30, 'C'),
(171, 80, 31, 'C'),
(172, 80, 46, 'C'),
(173, 9, 48, 'C'),
(174, 44, 49, 'C'),
(175, 108, 51, 'C'),
(176, 25, 61, 'C'),
(177, 77, 64, 'C'),
(178, 75, 65, 'C'),
(179, 77, 73, 'C'),
(180, 121, 76, 'C'),
(182, 70, 11, 'E'),
(183, 113, 11, 'E'),
(184, 74, 12, 'E'),
(185, 93, 13, 'E'),
(186, 107, 13, 'E'),
(187, 13, 14, 'E'),
(188, 78, 14, 'E'),
(189, 31, 17, 'E'),
(190, 37, 17, 'E'),
(191, 50, 19, 'E'),
(192, 132, 19, 'E'),
(193, 24, 21, 'E'),
(194, 92, 21, 'E'),
(195, 20, 24, 'E'),
(196, 151, 24, 'E'),
(197, 95, 27, 'E'),
(198, 125, 27, 'E'),
(199, 63, 28, 'E'),
(200, 91, 30, 'E'),
(201, 102, 30, 'E'),
(202, 78, 31, 'E'),
(203, 80, 31, 'E'),
(204, 152, 31, 'E'),
(205, 80, 46, 'E'),
(206, 90, 46, 'E'),
(207, 9, 48, 'E'),
(208, 153, 48, 'E'),
(209, 44, 49, 'E'),
(210, 108, 49, 'E'),
(211, 20, 51, 'E'),
(212, 108, 51, 'E'),
(213, 25, 61, 'E'),
(214, 154, 61, 'E'),
(215, 77, 64, 'E'),
(216, 75, 65, 'E'),
(217, 129, 65, 'E'),
(218, 77, 73, 'E'),
(219, 153, 73, 'E'),
(220, 121, 76, 'E'),
(222, 61, 1, 'E'),
(223, 72, 1, 'E'),
(224, 70, 11, 'M'),
(225, 113, 11, 'M'),
(226, 80, 12, 'M'),
(227, 93, 13, 'M'),
(228, 107, 13, 'M'),
(229, 13, 14, 'M'),
(230, 78, 14, 'M'),
(231, 31, 17, 'M'),
(232, 37, 17, 'M'),
(233, 50, 19, 'M'),
(234, 132, 19, 'M'),
(235, 24, 21, 'M'),
(236, 92, 21, 'M'),
(237, 20, 24, 'M'),
(238, 151, 24, 'M'),
(239, 95, 27, 'M'),
(240, 125, 27, 'M'),
(241, 31, 28, 'M'),
(242, 91, 30, 'M'),
(243, 102, 30, 'M'),
(244, 78, 31, 'M'),
(245, 80, 31, 'M'),
(246, 152, 31, 'M'),
(247, 80, 46, 'M'),
(248, 90, 46, 'M'),
(249, 9, 48, 'M'),
(250, 153, 48, 'M'),
(251, 44, 49, 'M'),
(252, 108, 49, 'M'),
(253, 20, 51, 'M'),
(254, 108, 51, 'M'),
(255, 25, 61, 'M'),
(256, 154, 61, 'M'),
(257, 90, 64, 'M'),
(258, 75, 65, 'M'),
(259, 129, 65, 'M'),
(260, 77, 73, 'M'),
(261, 153, 73, 'M'),
(262, 13, 76, 'M'),
(263, 8, 1, 'M'),
(264, 61, 1, 'M'),
(265, 72, 1, 'M'),
(266, 155, 2, 'E'),
(267, 156, 2, 'E'),
(268, 155, 2, 'C'),
(269, 98, 2, 'M'),
(270, 157, 2, 'M'),
(271, 47, 87, 'C'),
(272, 15, 87, 'E'),
(273, 47, 87, 'E'),
(274, 97, 87, 'E'),
(275, 15, 87, 'M'),
(276, 47, 87, 'M'),
(277, 97, 87, 'M'),
(279, 72, 1, 'C'),
(280, 95, 5, 'E');

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `userid` int(11) NOT NULL,
  `firstname` varchar(50) DEFAULT NULL,
  `lastname` varchar(50) DEFAULT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `role` varchar(10) DEFAULT 'normal',
  `areaid` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`userid`, `firstname`, `lastname`, `email`, `password`, `role`, `areaid`) VALUES
(4, 'admin', 'admin', 'admin@admin', '111111', 'admin', 3),
(5, 'testing', 'TianFu', '111@111', '111111', 'normal', NULL),
(6, 'testing', 'Sandy', 'test@test', '111111', 'normal', NULL),
(7, 'testing', 'test2', 'shichenyu@shichenyu', '111111', 'normal', NULL),
(8, 'Fern Testing', 'Shiu', 'testingshiufern@ntu.edu.sg', '111111', 'admin', NULL),
(12, 'Chenyu', 'Testing', 'chenyu@shi', '111111', 'normal', NULL),
(13, 'demo', 'testing', 'demo@shi', '111111', 'admin', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `staffid` int(11) NOT NULL,
  `area` varchar(20) DEFAULT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `appointment` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`staffid`, `area`, `name`, `email`, `appointment`) VALUES
(1, 'ENIC', 'Abdulkadir C Yucel', 'acyucel@ntu.edu.sg', 'Assistant Professor'),
(2, 'ECAL', 'Ali Iftekhar Maswood', 'EAMASWOOD@ntu.edu.sg', 'Associate Professor'),
(3, 'ECAL', 'Amal Chandran', 'achandran@ntu.edu.sg', 'Assistant Professor'),
(4, 'ECAL', 'Amer Mohammad Yusuf Mohammad Ghias', 'amer.ghias@ntu.edu.sg', 'Assistant Professor'),
(5, 'INON', 'Anamitra Makur', 'EAMakur@ntu.edu.sg', 'Associate Professor'),
(6, 'ENIC', 'Ang Diing Shenp', 'EDSAng@ntu.edu.sg', 'Associate Professor'),
(7, 'ENIC', 'Arindam Basu', 'arindam.basu@ntu.edu.sg', 'Associate Professor'),
(8, 'INON', 'Arokiaswami Alphones', 'EAlphones@ntu.edu.sg', 'Associate Professor'),
(9, 'INON', 'Bi Guoan', 'EGBI@ntu.edu.sg', 'Associate Professor'),
(10, 'ENIC', 'Bongjin Kim', 'bjkim@ntu.edu.sg', 'Assistant Professor'),
(11, 'ENIC', 'Boon Chirn Chye', 'ECCBoon@ntu.edu.sg', 'Associate Professor'),
(12, 'ECAL', 'Cai Wenjian', 'ewjcai@ntu.edu.sg', 'Associate Professor'),
(13, 'INON', 'Chan Chee Keong', 'ECKCHAN@ntu.edu.sg', 'Senior Lecturer'),
(14, 'ECAL', 'Chan Chok You, John', 'ECYCHAN@ntu.edu.sg', 'Associate Professor'),
(15, 'ENIC', 'Chan Pak Kwong', 'epkchan@ntu.edu.sg', 'Associate Professor'),
(16, 'ENIC', 'Chang Chip Hong', 'ECHChang@ntu.edu.sg', 'Associate Professor'),
(17, 'ENIC', 'Chang Wonkeun', 'wonkeun.chang@ntu.edu.sg', 'Nanyang Assistant Professor'),
(18, 'INON', 'Chau Lap Pui', 'elpchau@ntu.edu.sg', 'Associate Professor'),
(19, 'ECAL', 'Cheah Chien Chern', 'ECCCheah@ntu.edu.sg', 'Associate Professor'),
(20, 'INON', 'Chen Lihui', 'ELHCHEN@ntu.edu.sg', 'Associate Professor'),
(21, 'ENIC', 'Chen Shoushun', 'eechenss@ntu.edu.sg', 'Associate Professor'),
(22, 'ENIC', 'Chen Tupei', 'EChenTP@ntu.edu.sg', 'Associate Professor'),
(23, 'ENIC', 'Chen Yu Chen', 'yucchen@ntu.edu.sg', 'Nanyang Assistant Professor'),
(24, 'INON', 'Cheng Tee Hiang', 'ETHCHENG@ntu.edu.sg', 'Professor'),
(25, 'INON', 'Chong Yong Kim', 'EYKCHONG@ntu.edu.sg', 'Associate Professor'),
(26, 'ECAL', 'Chua Chin Seng', 'ECSChua@ntu.edu.sg', 'Associate Professor'),
(27, 'INON', 'Chua Hock Chuan', 'EHCHUA@ntu.edu.sg', 'Associate Professor'),
(28, 'ENIC', 'Cuong Huy Dang', 'HCDang@ntu.edu.sg', 'Assistant Professor'),
(29, 'ENIC', 'Donguk Nam', 'dnam@ntu.edu.sg', 'Assistant Professor'),
(30, 'ECAL', 'Er Meng Joo', 'EMJER@ntu.edu.sg', 'Professor'),
(31, 'INON', 'Erry Gunawan', 'EGUNAWAN@ntu.edu.sg', 'Associate Professor'),
(32, 'ENIC', 'Fan Weijun', 'EWJFan@ntu.edu.sg', 'Associate Professor'),
(33, 'ECAL', 'Foo Yi Shyh, Eddy', 'EddyFoo@ntu.edu.sg', 'Lecturer'),
(34, 'INON', 'Gan Woon Seng', 'EWSGAN@ntu.edu.sg', 'Professor'),
(35, 'ENIC', 'Goh Wang Ling', 'EWLGOH@ntu.edu.sg', 'Associate Professor'),
(36, 'ECAL', 'Gooi Hoay Beng', 'EHBGOOI@ntu.edu.sg', 'Associate Professor'),
(37, 'INON', 'Guan Yong Liang', 'EYLGuan@ntu.edu.sg', 'Associate Professor'),
(38, 'ENIC', 'Gwee Bah Hwee', 'ebhgwee@ntu.edu.sg', 'Associate Professor'),
(39, 'ENIC', 'Hilmi Volkan Demir', 'HVDEMIR@ntu.edu.sg', 'Professor'),
(40, 'ENIC', 'Ho Duan Juat', 'EHDJWONG@ntu.edu.sg', 'Associate Professor'),
(41, 'ECAL', 'Hu Guoqiang', 'GQHu@ntu.edu.sg', 'Associate Professor'),
(42, 'ECAL', 'Huang Guangbin', 'EGBHuang@ntu.edu.sg', 'Professor'),
(43, 'ECAL', 'Hung Dinh Nguyen', 'hunghtd@ntu.edu.sg', 'Assistant Professor'),
(44, 'INON', 'Jiang Xudong', 'EXDJiang@ntu.edu.sg', 'Associate Professor'),
(45, 'ENIC', 'Jong Ching Chuen', 'ECCJONG@ntu.edu.sg', 'Associate Professor'),
(46, 'ECAL', 'Josep Pou', 'j.pou@ntu.edu.sg', 'Associate Professor'),
(47, 'ENIC', 'Joseph Chang', 'EJSCHANG@ntu.edu.sg', 'Professor'),
(48, 'ECAL', 'Justin Dauwels', 'JDAUWELS@ntu.edu.sg', 'Associate Professor'),
(49, 'ENIC', 'Kantisara Pita', 'ekpita@ntu.edu.sg', 'Associate Professor'),
(50, 'INON', 'Khong Wai Hoong, Andy', 'AndyKhong@ntu.edu.sg', 'Associate Professor'),
(51, 'ENIC', 'Kim Munho', 'munho.kim@ntu.edu.sg', 'Assistant Professor'),
(52, 'ENIC', 'Kim Tae Hyoung', 'THKIM@ntu.edu.sg', 'Associate Professor'),
(53, 'INON', 'Koh Soo Ngee', 'ESNKOH@ntu.edu.sg', 'Professor'),
(54, 'ENIC', 'Kong Zhi Hui', 'ZHKong@ntu.edu.sg', 'Assistant Professor'),
(55, 'INON', 'Kot Chichung, Alex', 'EACKOT@ntu.edu.sg', 'Professor'),
(56, 'ECAL', 'Lalit Kumar Goel', 'ELKGOEL@ntu.edu.sg', 'Professor'),
(57, 'ENIC', 'Lau Kim Teen', 'EKTLAU@ntu.edu.sg', 'Associate Professor'),
(58, 'INON', 'Law Choi Look', 'ECLLAW@ntu.edu.sg', 'Associate Professor'),
(59, 'ECAL', 'Lee Peng Hin', '', 'Associate Professor'),
(60, 'ENIC', 'Lee Seok Woo', 'sw.lee@ntu.edu.sg', 'Assistant Professor'),
(61, 'INON', 'Lee Yee Hui', 'EYHLee@ntu.edu.sg', 'Associate Professor'),
(62, 'ENIC', 'Leong Wei Lin', 'wlleong@ntu.edu.sg', 'Assistant Professor'),
(63, 'INON', 'Li Kwok Hung', 'EKHLI@ntu.edu.sg', 'Associate Professor'),
(64, 'HRH', 'Lim Jit Poh, Jessica', 'EJLIM@ntu.edu.sg', 'Senior Lecturer'),
(65, 'ENIC', 'Lim Meng Hiot', 'EMHLIM@ntu.edu.sg', 'Associate Professor'),
(66, 'INON', 'Lin Zhiping', 'EZPLin@ntu.edu.sg', 'Associate Professor'),
(67, 'ECAL', 'Ling Keck Voon', 'EKVLING@ntu.edu.sg', 'Associate Professor'),
(68, 'ENIC', 'Liu Ai Qun', 'EAQLiu@ntu.edu.sg', 'Professor'),
(69, 'ECAL', 'Liu Linbo', 'LIULINBO@ntu.edu.sg', 'Nanyang Assistant Professor'),
(70, 'INON', 'Low Chor Ping', 'ICPLOW@ntu.edu.sg', 'Associate Professor'),
(71, 'ECAL', 'Low Teck Seng', 'TSLOW@ntu.edu.sg', 'Professor'),
(72, 'INON', 'Lu Yilong', 'EYLU@ntu.edu.sg', 'Professor'),
(73, 'ENIC', 'Luo Yu', 'luoyu@ntu.edu.sg', 'Assistant Professor'),
(74, 'INON', 'Ma Kai-Kuang', 'EKKMA@ntu.edu.sg', 'Professor'),
(75, 'INON', 'Ma Maode', 'EMDMa@ntu.edu.sg', 'Associate Professor'),
(76, 'ECAL', 'Mao Kezhi', 'EKZMao@ntu.edu.sg', 'Associate Professor'),
(77, 'INON', 'Mohammed Yakoob Siyal', 'EYAKOOB@ntu.edu.sg', 'Associate Professor'),
(78, 'INON', 'Muhammad Faeyz Karim', 'faeyz@ntu.edu.sg', 'Senior Lecturer'),
(79, 'ENIC', 'Ng Beng Koon', 'EBKNg@ntu.edu.sg', 'Associate Professor'),
(80, 'INON', 'Ng Boon Poh', 'EBPNG@ntu.edu.sg', 'Associate Professor'),
(81, 'ENIC', 'Ng Geok Ing', 'EGING@ntu.edu.sg', 'Associate Professor'),
(82, 'ENIC', 'Ngo Quoc Nam, John', 'EQNNgo@ntu.edu.sg', 'Associate Professor'),
(83, 'INON', 'Pina Marziliano', 'EPina@ntu.edu.sg', 'Associate Professor'),
(84, 'ENIC', 'Poenar Daniel Puiu', 'EPDPuiu@ntu.edu.sg', 'Associate Professor'),
(85, 'ECAL', 'Ponnuthurai N Suganthan', 'EPNSugan@ntu.edu.sg', 'Associate Professor'),
(86, 'ENIC', 'Radhakrishnan K', 'ERADHA@ntu.edu.sg', 'Associate Professor'),
(87, 'ENIC', 'Rusli', 'erusli@ntu.edu.sg', 'Associate Professor'),
(88, 'INON', 'Saman S Abeysekera', 'Esabeysekera@ntu.edu.sg', 'Associate Professor'),
(89, 'ENIC', 'See Kye Yak', 'EKYSEE@ntu.edu.sg', 'Associate Professor'),
(90, 'INON', 'Seow Chee Kiat', 'ckseow@ntu.edu.sg', 'Senior Lecturer'),
(91, 'INON', 'Ser Wee', 'ewser@ntu.edu.sg', 'Associate Professor'),
(92, 'INON', 'Shao Xuguang, Michelle', 'XGShao@ntu.edu.sg', 'Senior Lecturer'),
(93, 'INON', 'Sheel Aditya', 'ESAditya@ntu.edu.sg', 'Associate Professor'),
(94, 'INON', 'Shen Zhongxiang', 'EZXShen@ntu.edu.sg', 'Professor'),
(95, 'INON', 'Shum Ping', 'EPShum@ntu.edu.sg', 'Professor'),
(96, 'ENIC', 'Siek Liter', 'ELSIEK@ntu.edu.sg', 'Associate Professor'),
(97, 'ENIC', 'Sit Ji-Jon', 'jijon@ntu.edu.sg', 'Senior Lecturer'),
(98, 'ECAL', 'So Ping Lam', 'EPLSo@ntu.edu.sg', 'Associate Professor'),
(99, 'ECAL', 'Soh Cheong Boon', 'ECBSOH@ntu.edu.sg', 'Associate Professor'),
(100, 'ECAL', 'Soh Yeng Chai', 'EYCSOH@ntu.edu.sg', 'Professor'),
(101, 'ECAL', 'Song Qing', 'EQSONG@ntu.edu.sg', 'Associate Professor'),
(102, 'INON', 'Soong Boon Hee', 'EBHSOONG@ntu.edu.sg', 'Associate Professor'),
(103, 'ECAL', 'Su Rong', 'RSu@ntu.edu.sg', 'Associate Professor'),
(104, 'ENIC', 'Sun Changqing', 'ECQSun@ntu.edu.sg', 'Associate Professor'),
(105, 'INON', 'Tan Chee Wah, Wesley', '', 'Lecturer'),
(106, 'INON', 'Tan Eng Leong', 'EELTan@ntu.edu.sg', 'Associate Professor'),
(107, 'INON', 'Tan Soon Yim', 'ESYTAN@ntu.edu.sg', 'Associate Professor'),
(108, 'INON', 'Tan Yap Peng', 'EYPTan@ntu.edu.sg', 'Professor'),
(109, 'ENIC', 'Tang Dingyuan', 'EDYTang@ntu.edu.sg', 'Associate Professor'),
(110, 'ENIC', 'Tang Xiaohong', 'EXHTang@ntu.edu.sg', 'Associate Professor'),
(111, 'ECAL', 'Tang Yi', 'yitang@ntu.edu.sg', 'Assistant Professor'),
(112, 'ENIC', 'Tay Beng Kang', 'EBKTAY@ntu.edu.sg', 'Professor'),
(113, 'INON', 'Tay Wee Peng', 'wptay@ntu.edu.sg', 'Associate Professor'),
(114, 'INON', 'Teh Kah Chan', 'EKCTeh@ntu.edu.sg', 'Associate Professor'),
(115, 'ENIC', 'Teo Hang Tong, Edwin', 'HTTEO@ntu.edu.sg', 'Associate Professor'),
(116, 'ECAL', 'Teoh Eam Khwang', 'EEKTEOH@ntu.edu.sg', 'Associate Professor'),
(117, 'ECAL', 'Wang Dan Wei', 'EDWWANG@ntu.edu.sg', 'Professor'),
(118, 'ECAL', 'Wang Han', 'HW@ntu.edu.sg', 'Associate Professor'),
(119, 'ENIC', 'Wang Hong', 'EWANGHONG@ntu.edu.sg', 'Associate Professor'),
(120, 'ECAL', 'Wang Jianliang', 'EJLWANG@ntu.edu.sg', 'Associate Professor'),
(121, 'INON', 'Wang Lipo', 'ELPWang@ntu.edu.sg', 'Associate Professor'),
(122, 'ECAL', 'Wang Peng', 'epwang@ntu.edu.sg', 'Professor'),
(123, 'ENIC', 'Wang Qijie', 'qjwang@ntu.edu.sg', 'Associate Professor'),
(124, 'ECAL', 'Wang Youyi', 'EYYWANG@ntu.edu.sg', 'Professor'),
(125, 'ENIC', 'Wei Lei', 'wei.lei@ntu.edu.sg', 'Nanyang Assistant Professor'),
(126, 'ECAL', 'Wen Changyun', 'ECYWEN@ntu.edu.sg', 'Professor'),
(127, 'ECAL', 'Wong Jia Yiing, Patricia', 'EJYWong@ntu.edu.sg', 'Associate Professor'),
(128, 'ENIC', 'Wong Kin Shun, Terence', 'EKSWONG@ntu.edu.sg', 'Associate Professor'),
(129, 'INON', 'Xiao Gaoxi', 'EGXXiao@ntu.edu.sg', 'Associate Professor'),
(130, 'ECAL', 'Xie Lihua', 'ELHXIE@ntu.edu.sg', 'Professor'),
(131, 'ECAL', 'Xu Yan', 'xuyan@ntu.edu.sg', 'Nanyang Assistant Professor'),
(132, 'INON', 'Yap Kim Hui', 'EKHYap@ntu.edu.sg', 'Associate Professor'),
(133, 'ENIC', 'Yong Ken-Tye', 'ktyong@ntu.edu.sg', 'Associate Professor'),
(134, 'ENIC', 'Yoo Seong Woo', 'seon.yoo@ntu.edu.sg', 'Assistant Professor'),
(135, 'ENIC', 'Yvonne Lam Ying Hung', 'EYHLAM@ntu.edu.sg', 'Associate Professor'),
(136, 'ENIC', 'Zhang Dao Hua', 'EDHZHANG@ntu.edu.sg', 'Professor'),
(137, 'ENIC', 'Zhang Qing', 'eqzhang@ntu.edu.sg', 'Professor'),
(138, 'ECAL', 'Zhang Xin, Jack ', 'jackzhang@ntu.edu.sg', 'Assistant Professor'),
(139, 'ECAL', 'Zhang Xinan', 'zhangxn@ntu.edu.sg', 'Lecturer'),
(140, 'ENIC', 'Zhang Yue Ping', 'EYPZhang@ntu.edu.sg', 'Professor'),
(141, 'ENIC', 'Zheng Yuanjin', 'YJZHENG@ntu.edu.sg', 'Associate Professor'),
(142, 'INON', 'Zhong Wende', 'EWDZhong@ntu.edu.sg', 'Professor'),
(143, 'ENIC', 'Zhou Xing', 'EXZHOU@ntu.edu.sg', 'Associate Professor'),
(144, 'Admin', 'Ong Leh Woo, Grace', 'ELWWU@ntu.edu.sg', 'Admin Assistant'),
(145, 'Admin', 'Thian-Lim Ai Fang', 'EAFTHIAN@ntu.edu.sg', 'Admin Assistant'),
(146, 'Admin', 'Fernandez-Lam Siew Gan Serene', 'ESGLAM@ntu.edu.sg', 'Admin Assistant'),
(147, 'Admin', 'Ng Shiu Fern', 'ngsf@ntu.edu.sg', 'Admin Assistant'),
(148, 'Others', 'Timmy Mok', NULL, 'O'),
(149, 'Others', 'Kang Kok Hin', NULL, 'O'),
(150, 'Others', 'TAN CHUAN SENG', NULL, 'O'),
(151, 'Others', 'TAN HEE BENG KUAN (PT)', NULL, 'O'),
(152, 'Others', 'TAN SHEN HSIAO', NULL, 'O'),
(153, 'Others', 'FOO SAY WEI (PT)', NULL, 'O'),
(154, 'Others', 'ANG YEW HOCK (PT)', NULL, 'O'),
(155, 'Others', 'JESSICA NG', NULL, 'O'),
(156, 'Others', 'NG ENG PING', NULL, 'O'),
(157, 'Others', 'A/P Ang Cheng Guan (RSIS)', NULL, 'O');

-- --------------------------------------------------------

--
-- Table structure for table `status`
--

CREATE TABLE `status` (
  `statusid` int(11) NOT NULL,
  `status` varchar(50) NOT NULL,
  `deadline` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `status`
--

INSERT INTO `status` (`statusid`, `status`, `deadline`) VALUES
(1, 'Drafting', '2018-09-11'),
(2, 'Area Lead Reviewing', '2018-09-25'),
(3, 'Acad Review (OAS)', '2018-10-09'),
(4, 'Acad Review (non OAS)', '2018-10-16'),
(5, 'Chair Reviewing', '2018-12-25');

-- --------------------------------------------------------

--
-- Table structure for table `tracking`
--

CREATE TABLE `tracking` (
  `trackingid` int(11) NOT NULL,
  `courseid` int(11) NOT NULL,
  `statusid` int(11) DEFAULT '1',
  `adminid` int(11) DEFAULT '8'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tracking`
--

INSERT INTO `tracking` (`trackingid`, `courseid`, `statusid`, `adminid`) VALUES
(1, 1, 1, 5),
(2, 2, 2, 5),
(3, 3, 1, 5),
(4, 4, 5, 4),
(5, 5, 3, 7),
(6, 6, 4, 4),
(7, 7, 3, 4),
(8, 8, 3, 4),
(9, 9, 4, 4),
(10, 10, 1, 4),
(11, 11, 4, 4),
(12, 12, 3, 4),
(13, 13, 1, 4),
(14, 14, 1, 4),
(15, 15, 1, 4),
(16, 16, 1, 4),
(17, 17, 1, 4),
(18, 18, 1, 4),
(19, 19, 1, 4),
(20, 20, 1, 4),
(21, 21, 1, 4),
(22, 22, 1, 4),
(23, 23, 1, 4),
(24, 24, 1, 4),
(25, 25, 1, 4),
(26, 26, 1, 4),
(27, 27, 1, 4),
(28, 28, 1, 4),
(29, 29, 1, 4),
(30, 30, 4, 4),
(31, 31, 1, 4),
(32, 32, 1, 4),
(33, 33, 1, 4),
(34, 34, 1, 4),
(35, 35, 1, 4),
(36, 36, 1, 4),
(37, 37, 1, 4),
(38, 38, 1, 4),
(39, 39, 1, 4),
(40, 40, 1, 4),
(41, 41, 1, 4),
(42, 42, 1, 4),
(43, 43, 1, 4),
(44, 44, 1, 4),
(45, 45, 1, 4),
(46, 46, 1, 4),
(47, 47, 1, 4),
(48, 48, 1, 4),
(49, 49, 1, 4),
(50, 50, 1, 4),
(51, 51, 1, 4),
(52, 52, 1, 4),
(53, 53, 1, 4),
(54, 54, 1, 4),
(55, 55, 1, 4),
(56, 56, 1, 4),
(57, 57, 3, 4),
(58, 58, 1, 4),
(59, 59, 1, 4),
(60, 60, 1, 4),
(61, 61, 1, 4),
(62, 62, 1, 4),
(63, 63, 1, 4),
(64, 64, 1, 4),
(65, 65, 1, 4),
(66, 66, 1, 4),
(67, 67, 1, 4),
(68, 68, 1, 4),
(69, 69, 1, 4),
(70, 70, 1, 4),
(71, 71, 1, 4),
(72, 72, 1, 4),
(73, 73, 1, 4),
(74, 74, 1, 4),
(75, 75, 1, 4),
(76, 76, 1, 4),
(77, 77, 1, 4),
(78, 78, 1, 4),
(79, 79, 1, 4),
(80, 80, 1, 4),
(81, 81, 1, 4),
(82, 82, 3, 4),
(83, 83, 3, 4),
(84, 84, 3, 4),
(85, 85, 1, 4),
(86, 86, 1, 4),
(87, 87, 1, 4),
(88, 88, 1, 6),
(89, 89, 1, 4),
(90, 90, 1, 4),
(91, 91, 1, 4),
(92, 92, 1, 4),
(93, 93, 1, 4),
(94, 94, 1, 4);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `area`
--
ALTER TABLE `area`
  ADD PRIMARY KEY (`areaid`),
  ADD KEY `leadid` (`leadid`),
  ADD KEY `adminid` (`adminid`);

--
-- Indexes for table `course`
--
ALTER TABLE `course`
  ADD PRIMARY KEY (`courseid`);

--
-- Indexes for table `examstaff`
--
ALTER TABLE `examstaff`
  ADD PRIMARY KEY (`examid`),
  ADD KEY `staffid` (`staffid`),
  ADD KEY `courseid` (`courseid`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`userid`),
  ADD KEY `areaid` (`areaid`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`staffid`);

--
-- Indexes for table `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`statusid`);

--
-- Indexes for table `tracking`
--
ALTER TABLE `tracking`
  ADD PRIMARY KEY (`trackingid`),
  ADD KEY `courseid` (`courseid`),
  ADD KEY `statusid` (`statusid`),
  ADD KEY `adminid` (`adminid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `area`
--
ALTER TABLE `area`
  MODIFY `areaid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `course`
--
ALTER TABLE `course`
  MODIFY `courseid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=95;

--
-- AUTO_INCREMENT for table `examstaff`
--
ALTER TABLE `examstaff`
  MODIFY `examid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=281;

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `userid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `staffid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=158;

--
-- AUTO_INCREMENT for table `status`
--
ALTER TABLE `status`
  MODIFY `statusid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tracking`
--
ALTER TABLE `tracking`
  MODIFY `trackingid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=95;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `area`
--
ALTER TABLE `area`
  ADD CONSTRAINT `area_ibfk_1` FOREIGN KEY (`leadid`) REFERENCES `staff` (`staffid`),
  ADD CONSTRAINT `area_ibfk_2` FOREIGN KEY (`adminid`) REFERENCES `staff` (`staffid`);

--
-- Constraints for table `examstaff`
--
ALTER TABLE `examstaff`
  ADD CONSTRAINT `examstaff_ibfk_1` FOREIGN KEY (`staffid`) REFERENCES `staff` (`staffid`),
  ADD CONSTRAINT `examstaff_ibfk_2` FOREIGN KEY (`courseid`) REFERENCES `course` (`courseid`);

--
-- Constraints for table `login`
--
ALTER TABLE `login`
  ADD CONSTRAINT `login_ibfk_1` FOREIGN KEY (`areaid`) REFERENCES `area` (`areaid`);

--
-- Constraints for table `tracking`
--
ALTER TABLE `tracking`
  ADD CONSTRAINT `tracking_ibfk_2` FOREIGN KEY (`courseid`) REFERENCES `course` (`courseid`),
  ADD CONSTRAINT `tracking_ibfk_3` FOREIGN KEY (`statusid`) REFERENCES `status` (`statusid`),
  ADD CONSTRAINT `tracking_ibfk_4` FOREIGN KEY (`adminid`) REFERENCES `login` (`userid`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
