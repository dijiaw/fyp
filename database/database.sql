-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
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
  `ugpg` varchar(10) DEFAULT 'ug',
  `type` varchar(10) NOT NULL,
  `school` varchar(10) DEFAULT 'EEE',
  `au` int(10) NOT NULL,
  `tel` varchar(10) DEFAULT 'yes',
  `year` int(10) DEFAULT 1,
  `hoursperstaff` float(10) NOT NULL,
  `numofgroups` int(10) NOT NULL,
  `numofweeks` int(10) NOT NULL,
  `hoursperweek` float(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`courseid`, `area`, `code`, `coursename`, `exam`, `offered`, `ugpg`, `type`, `school`, `au`, `tel`, `year`, `hoursperstaff`, `numofgroups`, `numofweeks`, `hoursperweek`) VALUES
(1, 'INON', 'EE0001', 'IMPACT OF ELECTROMAGNETIC RADIATION ON HUMANS', 'no', 'yes', 'UG', 'LEC', 'EEE', '3', 'yes', '2', '13', '5', '13', '3'),
(2, 'Others', 'EE0040 / IM0040', 'ENGINEERS AND SOCIETY', 'yes', 'yes', 'UG', 'LEC', 'EEE', '3', 'yes', '2', '13', '5', '13', '3'),
(3, 'ENIC', 'EE1002', 'PHYSICS FOUNDATION FOR ELECTRICAL AND ELECTRONIC ENGINEERING', 'yes', 'yes', 'UG', 'LEC', 'EEE', '3', 'yes', '2', '13', '5', '13', '3'),
(4, 'ENIC', 'EE1003', 'INTRODUCTION TO MATERIALS FOR ELECTRONICS', 'yes', 'yes', 'UG', 'LEC', 'EEE', '3', 'yes', '2', '13', '5', '13', '3'),
(5, 'ECAL', 'EE2001', 'CIRCUIT ANALYSIS', 'yes', 'yes', 'UG', 'LEC', 'EEE', '3', 'yes', '2', '13', '5', '13', '3'),
(6, 'ECAL', 'EE2001', 'CIRCUIT ANALYSIS', 'yes', 'yes', 'UG', 'LAB', 'EEE', '3', 'yes', '2', '13', '5', '13', '3'),
(7, 'ECAL', 'EE2001', 'CIRCUIT ANALYSIS', 'yes', 'yes', 'UG', 'TUT', 'EEE', '3', 'yes', '2', '13', '5', '13', '3');
-- (6, 'ENIC', 'EE2002', 'ANALOG ELECTRONICS', 'yes', 'yes', 'UG', 'LEC', 'EEE', 3, 'yes', 2, 13, 5, 13, 3),
-- (7, 'ENIC', 'EE2003', 'SEMICONDUCTOR FUNDAMENTALS', 'yes', 'yes', 'UG', 'LEC', 'EEE', 3, 'yes', 2, 13, 5, 13, 3),
-- (8, 'ENIC', 'EE2004 / IM1004', 'DIGITAL ELECTRONICS', 'yes', 'yes', 'UG', 'LEC', 'EEE', 3, 'yes', 2, 13, 5, 13, 3),
-- (9, 'ECAL', 'EE2006 / IM2006', 'ENGINEERING MATHEMATICS I', 'yes', 'yes', 'UG', 'LEC', 'EEE', 3, 'yes', 2, 13, 5, 13, 3),
-- (10, 'ECAL', 'EE2007 / IM2007', 'ENGINEERING MATHEMATICS II', 'yes', 'yes', 'UG', 'LEC', 'EEE', 3, 'yes', 2, 13, 5, 13, 3),
-- (11, 'INON', 'EE2008 / IM1001', 'DATA STRUCTURES AND ALGORITHMS', 'yes', 'yes', 'UG', 'LEC', 'EEE', 3, 'yes', 2, 13, 5, 13, 3),
-- (12, 'INON', 'EE2010 / IM2004', 'SIGNALS AND SYSTEMS', 'yes', 'yes', 'UG', 'LEC', 'EEE', 3, 'yes', 2, 13, 5, 13, 3),
-- (13, 'INON', 'EE3001', 'ENGINEERING ELECTROMAGNETICS', 'yes', 'yes', 'UG', 'LEC', 'EEE', 3, 'yes', 2, 13, 5, 13, 3),
-- (14, 'INON', 'EE3002 / IM2002', 'MICROPROCESSORS', 'yes', 'yes', 'UG', 'LEC', 'EEE', 3, 'yes', 2, 13, 5, 13, 3),
-- (15, 'ECAL', 'EE3010', 'ELECTRICAL DEVICES AND MACHINES', 'yes', 'yes', 'UG', 'LEC', 'EEE', 3, 'yes', 2, 13, 5, 13, 3),
-- (16, 'ECAL', 'EE3011', 'MODELLING AND CONTROL', 'yes', 'yes', 'UG', 'LEC', 'EEE', 3, 'yes', 2, 13, 5, 13, 3),
-- (17, 'INON', 'EE3012 / IM3002', 'COMMUNICATION PRINCIPLES', 'yes', 'yes', 'UG', 'LEC', 'EEE', 3, 'yes', 2, 13, 5, 13, 3),
-- (18, 'ENIC', 'EE3013', 'SEMICONDUCTOR DEVICES AND PROCESSING', 'yes', 'yes', 'UG', 'LEC', 'EEE', 3, 'yes', 2, 13, 5, 13, 3),
-- (19, 'INON', 'EE3014 / IM3001', 'DIGITAL SIGNAL PROCESSING', 'yes', 'yes', 'UG', 'LEC', 'EEE', 3, 'yes', 2, 13, 5, 13, 3),
-- (20, 'ECAL', 'EE3015', 'POWER SYSTEMS AND PROTECTION', 'yes', 'yes', 'UG', 'LEC', 'EEE', 3, 'yes', 2, 13, 5, 13, 3),
-- (21, 'INON', 'EE3017 / IM2003', 'COMPUTER COMMUNICATIONS', 'yes', 'yes', 'UG', 'LEC', 'EEE', 3, 'yes', 2, 13, 5, 13, 3),
-- (22, 'ENIC', 'EE3018', 'INTRODUCTION TO PHOTONICS', 'yes', 'yes', 'UG', 'LEC', 'EEE', 3, 'yes', 2, 13, 5, 13, 3),
-- (23, 'ENIC', 'EE3019', 'INTEGRATED ELECTRONICS', 'yes', 'yes', 'UG', 'LEC', 'EEE', 3, 'yes', 2, 13, 5, 13, 3),
-- (24, 'INON', 'EE4001 / IM2001', 'SOFTWARE ENGINEERING', 'yes', 'yes', 'UG', 'LEC', 'EEE', 3, 'yes', 2, 13, 5, 13, 3),
-- (25, 'INON', 'EE4105 / IM4105', 'CELLULAR COMMUNICATION SYSTEM DESIGN', 'no', 'yes', 'UG', 'LEC', 'EEE', 3, 'yes', 2, 13, 5, 13, 3),
-- (26, 'INON', 'EE4109', 'WIRELESS SYSTEM DESIGN', 'no', 'yes', 'UG', 'LEC', 'EEE', 3, 'yes', 2, 13, 5, 13, 3),
-- (27, 'INON', 'EE4110', 'OPTICAL COMMUNICATION SYSTEM DESIGN', 'yes', 'yes', 'UG', 'LEC', 'EEE', 3, 'yes', 2, 13, 5, 13, 3),
-- (28, 'INON', 'EE4152 / IM4152', 'DIGITAL COMMUNICATIONS', 'yes', 'yes', 'UG', 'LEC', 'EEE', 3, 'yes', 2, 13, 5, 13, 3),
-- (29, 'INON', 'EE4153 / IM4153', 'TELECOMMUNICATION SYSTEMS', 'no', 'yes', 'UG', 'LEC', 'EEE', 3, 'yes', 2, 13, 5, 13, 3),
-- (30, 'INON', 'EE4188 / IM4188', 'WIRELESS COMMUNICATIONS', 'yes', 'yes', 'UG', 'LEC', 'EEE', 3, 'yes', 2, 13, 5, 13, 3),
-- (31, 'INON', 'EE4190', 'INTRODUCTION TO MODERN RADAR', 'yes', 'yes', 'UG', 'LEC', 'EEE', 3, 'yes', 2, 13, 5, 13, 3),
-- (32, 'ECAL', 'EE4207', 'CONTROL ENGINEERING DESIGN', 'yes', 'yes', 'UG', 'LEC', 'EEE', 3, 'yes', 2, 13, 5, 13, 3),
-- (33, 'ECAL', 'EE4208', 'INTELLIGENT SYSTEMS DESIGN', 'no', 'yes', 'UG', 'LEC', 'EEE', 3, 'yes', 2, 13, 5, 13, 3),
-- (34, 'ECAL', 'EE4265', 'PROCESS CONTROL SYSTEMS', 'yes', 'yes', 'UG', 'LEC', 'EEE', 3, 'yes', 2, 13, 5, 13, 3),
-- (35, 'ECAL', 'EE4266', 'COMPUTER VISION', 'yes', 'yes', 'UG', 'LEC', 'EEE', 3, 'yes', 2, 13, 5, 13, 3),
-- (36, 'ECAL', 'EE4268', 'ROBOTICS AND AUTOMATION', 'yes', 'yes', 'UG', 'LEC', 'EEE', 3, 'yes', 2, 13, 5, 13, 3),
-- (37, 'ECAL', 'EE4273', 'DIGITAL CONTROL SYSTEMS', 'no', 'yes', 'UG', 'LEC', 'EEE', 3, 'yes', 2, 13, 5, 13, 3),
-- (38, 'ECAL', 'EE4285', 'COMPUTATIONAL INTELLIGENCE', 'no', 'yes', 'UG', 'LEC', 'EEE', 3, 'yes', 2, 13, 5, 13, 3),
-- (39, 'ENIC', 'EE4303', 'MIXED-SIGNAL IC DESIGN', 'yes', 'yes', 'UG', 'LEC', 'EEE', 3, 'yes', 2, 13, 5, 13, 3),
-- (40, 'ENIC', 'EE4304', 'RADIO FREQUENCY INTEGRATED SYSTEM DESIGN', 'no', 'yes', 'UG', 'LEC', 'EEE', 3, 'yes', 2, 13, 5, 13, 3),
-- (41, 'ENIC', 'EE4305', 'DIGITAL DESIGN WITH HDL', 'yes', 'yes', 'UG', 'LEC', 'EEE', 3, 'yes', 2, 13, 5, 13, 3),
-- (42, 'ENIC', 'EE4340', 'VLSI SYSTEMS', 'yes', 'yes', 'UG', 'LEC', 'EEE', 3, 'yes', 2, 13, 5, 13, 3),
-- (43, 'ENIC', 'EE4341', 'ADVANCED ANALOG CIRCUITS', 'yes', 'yes', 'UG', 'LEC', 'EEE', 3, 'yes', 2, 13, 5, 13, 3),
-- (44, 'ENIC', 'EE4343', 'RADIO FREQUENCY CIRCUITS', 'no', 'yes', 'UG', 'LEC', 'EEE', 3, 'yes', 2, 13, 5, 13, 3),
-- (45, 'ENIC', 'EE4344', 'ANALYSIS AND DESIGN OF INTEGRATED CIRCUITS', 'no', 'yes', 'UG', 'LEC', 'EEE', 3, 'yes', 2, 13, 5, 13, 3),
-- (46, 'INON', 'EE4413 / IM4413', 'DSP SYSTEM DESIGN', 'yes', 'yes', 'UG', 'LEC', 'EEE', 3, 'yes', 2, 13, 5, 13, 3),
-- (47, 'INON', 'EE4455 / IM4455', 'EMBEDDED SYSTEMS', 'no', 'yes', 'UG', 'LEC', 'EEE', 3, 'yes', 2, 13, 5, 13, 3),
-- (48, 'INON', 'EE4475 / IM4475', 'AUDIO SIGNAL PROCESSING', 'yes', 'yes', 'UG', 'LEC', 'EEE', 3, 'yes', 2, 13, 5, 13, 3),
-- (49, 'INON', 'EE4476 / IM4476', 'IMAGE PROCESSING', 'yes', 'yes', 'UG', 'LEC', 'EEE', 3, 'yes', 2, 13, 5, 13, 3),
-- (50, 'INON', 'EE4478 / IM4478', 'DIGITAL VIDEO PROCESSING', 'yes', 'no', 'UG', 'LEC', 'EEE', 3, 'yes', 2, 13, 5, 13, 3),
-- (51, 'INON', 'EE4483 / IM4483', 'ARTIFICIAL INTELLIGENCE AND DATA MINING', 'yes', 'yes', 'UG', 'LEC', 'EEE', 3, 'yes', 2, 13, 5, 13, 3),
-- (52, 'ECAL', 'EE4503', 'POWER ENGINEERING DESIGN', 'yes', 'yes', 'UG', 'LEC', 'EEE', 3, 'yes', 2, 13, 5, 13, 3),
-- (53, 'ECAL', 'EE4504', 'DESIGN OF CLEAN ENERGY SYSTEMS', 'no', 'yes', 'UG', 'LEC', 'EEE', 3, 'yes', 2, 13, 5, 13, 3),
-- (54, 'ECAL', 'EE4530', 'POWER SYSTEM ANALYSIS AND CONTROL', 'yes', 'yes', 'UG', 'LEC', 'EEE', 3, 'yes', 2, 13, 5, 13, 3),
-- (55, 'ECAL', 'EE4532', 'POWER ELECTRONICS AND DRIVES', 'yes', 'yes', 'UG', 'LEC', 'EEE', 3, 'yes', 2, 13, 5, 13, 3),
-- (56, 'ECAL', 'EE4534', 'MODERN DISTRIBUTION SYSTEMS WITH RENEWABLE RESOURCES', 'no', 'yes', 'UG', 'LEC', 'EEE', 3, 'yes', 2, 13, 5, 13, 3),
-- (57, 'ENIC', 'EE4613', 'CMOS PROCESS AND DEVICE SIMULATION', 'yes', 'yes', 'UG', 'LEC', 'EEE', 3, 'yes', 2, 13, 5, 13, 3),
-- (58, 'ENIC', 'EE4614', 'DEVICE PARAMETER EXTRACTION AND LAYOUT IMPLEMENTATION', 'no', 'yes', 'UG', 'LEC', 'EEE', 3, 'yes', 2, 13, 5, 13, 3),
-- (59, 'ENIC', 'EE4646', 'VLSI TECHNOLOGY', 'yes', 'yes', 'UG', 'LEC', 'EEE', 3, 'yes', 2, 13, 5, 13, 3),
-- (60, 'ENIC', 'EE4647', 'MICROELECTRONIC DEVICES', 'yes', 'yes', 'UG', 'LEC', 'EEE', 3, 'yes', 2, 13, 5, 13, 3),
-- (61, 'INON', 'EE4717 / IM4717', 'WEB APPLICATION DESIGN', 'yes', 'yes', 'UG', 'LEC', 'EEE', 3, 'yes', 2, 13, 5, 13, 3),
-- (62, 'INON', 'EE4718 / IM4718', 'ENTERPRISE NETWORK DESIGN', 'yes', 'no', 'UG', 'LEC', 'EEE', 3, 'yes', 2, 13, 5, 13, 3),
-- (63, 'INON', 'EE4756 / IM4756', 'COMPUTER ARCHITECTURE', 'yes', 'no', 'UG', 'LEC', 'EEE', 3, 'yes', 2, 13, 5, 13, 3),
-- (64, 'INON', 'EE4758 / IM3003', 'INFORMATION SECURITY', 'yes', 'yes', 'UG', 'LEC', 'EEE', 3, 'yes', 2, 13, 5, 13, 3),
-- (65, 'INON', 'EE4761 / IM4761', 'COMPUTER NETWORKING', 'yes', 'yes', 'UG', 'LEC', 'EEE', 3, 'yes', 2, 13, 5, 13, 3),
-- (66, 'INON', 'EE4791 / IM4791', 'DATABASE SYSTEMS', 'yes', 'no', 'UG', 'LEC', 'EEE', 3, 'yes', 2, 13, 5, 13, 3),
-- (67, 'ENIC', 'EE4838', 'LASER ENGINEERING AND APPLICATIONS', 'yes', 'no', 'UG', 'LEC', 'EEE', 3, 'yes', 2, 13, 5, 13, 3),
-- (68, 'Others', 'EE4840', 'BIOPHOTONICS', 'yes', 'no', 'UG', 'LEC', 'EEE', 3, 'yes', 2, 13, 5, 13, 3),
-- (69, 'ECAL', 'EE4901', 'BIOMEDICAL CONTROL SYSTEM DESIGN', 'yes', 'yes', 'UG', 'LEC', 'EEE', 3, 'yes', 2, 13, 5, 13, 3),
-- (70, 'ECAL', 'EE4902', 'DESIGN OF MEDICAL INFORMATION PROCESSING SYSTEMS', 'yes', 'no', 'UG', 'LEC', 'EEE', 3, 'yes', 2, 13, 5, 13, 3),
-- (71, 'ECAL', 'EE4903', 'PHYSIOLOGICAL SYSTEMS ANALYSIS', 'yes', 'yes', 'UG', 'LEC', 'EEE', 3, 'yes', 2, 13, 5, 13, 3),
-- (72, 'ECAL', 'EE4904', 'BIOMEDICAL INSTRUMENTATION', 'yes', 'no', 'UG', 'LEC', 'EEE', 3, 'yes', 2, 13, 5, 13, 3),
-- (73, 'INON', 'EE8061', 'INNOVATION AND TECHNOLOGY MANAGEMENT', 'yes', 'yes', 'UG', 'LEC', 'EEE', 3, 'yes', 2, 13, 5, 13, 3),
-- (74, 'ENIC', 'EE8064', 'INTELLECTUAL PROPERTY FOR ELECTRONICS ENGINEERS', 'yes', 'no', 'UG', 'LEC', 'EEE', 3, 'yes', 2, 13, 5, 13, 3),
-- (75, 'Others', 'EE8067', 'CERAMICS IN HISTORY, ARTS, GEMSTONES, ENVIRONMENT, AND MODERN LIFE', 'yes', 'no', 'UG', 'LEC', 'EEE', 3, 'yes', 2, 13, 5, 13, 3),
-- (76, 'INON', 'EE8084', 'CYBER SECURITY', 'yes', 'yes', 'UG', 'LEC', 'EEE', 3, 'yes', 2, 13, 5, 13, 3),
-- (77, 'ECAL', 'EE8085', 'ELECTRIFICATION FOR THE BUILT ENVIRONMENT', 'yes', 'yes', 'UG', 'LEC', 'EEE', 3, 'yes', 2, 13, 5, 13, 3),
-- (78, 'ENIC', 'EE8086', 'ASTRONOMY - STARS, GALAXIES AND COSMOLOGY', 'yes', 'yes', 'UG', 'LEC', 'EEE', 3, 'yes', 2, 13, 5, 13, 3),
-- (79, 'ECAL', 'EE8087', 'LIVING WITH MATHEMATICS', 'no', 'yes', 'UG', 'LEC', 'EEE', 3, 'yes', 2, 13, 5, 13, 3),
-- (80, 'INON', 'EE8092', 'DIGITAL LIFESTYLE', 'no', 'yes', 'UG', 'LEC', 'EEE', 3, 'yes', 2, 13, 5, 13, 3),
-- (81, 'ENIC', 'EE8093', 'ENERGY DEVICES FOR SUSTAINABLE URBAN ENVIRONMENT', 'yes', 'no', 'UG', 'LEC', 'EEE', 3, 'yes', 2, 13, 5, 13, 3),
-- (82, 'INON', 'EE8094', 'IMPACT OF ELECTROMAGNETIC RADIATION ON HUMANS', 'yes', 'no', 'UG', 'LEC', 'EEE', 3, 'yes', 2, 13, 5, 13, 3),
-- (83, 'ENIC', 'FE1008', 'COMPUTING', 'yes', 'no', 'UG', 'LEC', 'EEE', 3, 'yes', 2, 13, 5, 13, 3),
-- (84, 'ENIC', 'IM1002', 'ANALOG ELECTRONICS', 'yes', 'no', 'UG', 'LEC', 'EEE', 3, 'yes', 2, 13, 5, 13, 3),
-- (85, 'INON', 'IM1003', 'OBJECT-ORIENTED PROGRAMMING', 'yes', 'no', 'UG', 'LEC', 'EEE', 3, 'yes', 2, 13, 5, 13, 3),
-- (86, 'INON', 'EE1005 / IM1005', 'FROM COMPUTATIONAL THINKING TO PROGRAMMING', 'yes', 'yes', 'UG', 'LEC', 'EEE', 3, 'yes', 2, 13, 5, 13, 3),
-- (87, 'ENIC', 'EE6307', 'ANALOG INTEGRATED CIRCUIT DESIGN', 'yes', 'yes', 'PG', 'LEC', 'EEE', 3, 'yes', 2, 13, 5, 13, 3),
-- (88, 'ENIC', 'EE6601', 'ADVANCED WAFER PROCESSING', 'yes', 'yes', 'PG', 'LEC', 'EEE', 3, 'yes', 2, 13, 5, 13, 3),
-- (89, 'ENIC', 'EE6602', 'QUALITY AND RELIABILITY ENGINEERING', 'yes', 'yes', 'PG', 'LEC', 'EEE', 3, 'yes', 2, 13, 5, 13, 3),
-- (90, 'ENIC', 'EE6610', 'INTEGRATED CIRCUIT PACKAGING', 'yes', 'yes', 'PG', 'LEC', 'EEE', 3, 'yes', 2, 13, 5, 13, 3),
-- (91, 'ENIC', 'EE7602', 'DESIGN, FABRICATION AND ANALYSIS OF ELECTRONICS DEVICES', 'yes', 'yes', 'PG', 'LEC', 'EEE', 3, 'yes', 2, 13, 5, 13, 3),
-- (92, 'ENIC', 'EE7603', 'ADVANCED SEMICONDUCTOR PHYSICS', 'yes', 'yes', 'PG', 'LEC', 'EEE', 3, 'yes', 2, 13, 5, 13, 3),
-- (93, 'INON', 'EE6010', 'PROJECT MANAGEMENT & TECHNOPRENEURSHIP', 'yes', 'yes', 'PG', 'LEC', 'EEE', 3, 'yes', 2, 13, 5, 13, 3),
-- (94, 'INON', 'EE6122', 'OPTICAL FIBRE COMMUNICATIONS', 'yes', 'yes', 'PG', 'LEC', 'EEE', 3, 'yes', 2, 13, 5, 13, 3);

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
  `areaid` int(11) DEFAULT NULL,
  `staffid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`userid`, `firstname`, `lastname`, `email`, `password`, `role`, `areaid`, `staffid`) VALUES
(1, 'admin', 'admin', 'admin@admin', '111111', 'admin', NULL, 1),
(2, 'normal', 'faculty', 'normal@normal', '111111', 'normal', NULL, 2),
(3, 'area', 'lead', 'area@area', '111111', 'area', 3, 3);


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
(3, 'ECAL', 'Amal Chandran', 'achandran@ntu.edu.sg', 'Assistant Professor');


-- --------------------------------------------------------

--
-- Table structure for table `plan`
--

CREATE TABLE `plan` (
  `planid` int(11) NOT NULL,
  `year` varchar(20) DEFAULT NULL,
  `courseid` int(11) NOT NULL,
  `staffid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `staff`
--

INSERT INTO `plan` (`planid`, `year`, `courseid`, `staffid`) VALUES
(1, 2019, 1, 1),
(2, 2019, 2, 1),
(3, 2019, 3, 2),
(4, 2019, 4, 2),
(5, 2019, 5, 3);


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
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`userid`),
  ADD KEY `areaid` (`areaid`),
  ADD KEY `staffid` (`staffid`);


--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`staffid`);


--
-- Indexes for table `plan`
--
ALTER TABLE `plan`
  ADD PRIMARY KEY (`planid`),
  ADD KEY `courseid` (`courseid`),
  ADD KEY `staffid` (`staffid`);
  
  
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
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `userid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `staffid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `plan`
--
ALTER TABLE `plan`
  MODIFY `planid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;


-- Constraints for dumped tables
--

--
-- Constraints for table `area`
--
-- ALTER TABLE `area`
--   ADD CONSTRAINT `area_ibfk_1` FOREIGN KEY (`leadid`) REFERENCES `staff` (`staffid`),
--   ADD CONSTRAINT `area_ibfk_2` FOREIGN KEY (`adminid`) REFERENCES `staff` (`staffid`);

--
-- Constraints for table `login`
--
-- ALTER TABLE `login`
--   ADD CONSTRAINT `login_ibfk_1` FOREIGN KEY (`areaid`) REFERENCES `area` (`areaid`);


