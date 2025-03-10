-- phpMyAdmin SQL Dump
-- version 5.2.1
-- Created by KI Careers Team
--
-- Host: 127.0.0.1
-- Generation Time: Dec 22, 2024 at 08:45 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `wtxoeyoq_career_portal_new`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`, `username`, `email`, `password`, `created_at`, `updated_at`) VALUES
(1, 'KI Careers', 'admin', 'amirintencode@gmail.com', '5550eb7b798a66e8bb9e8bc2a3c9eb629ffe6343876fa59b531ad152b7deff5d', '2024-12-16 01:02:32', '2024-12-16 01:02:32');

-- --------------------------------------------------------

--
-- Table structure for table `applicants`
--

CREATE TABLE `applicants` (
  `sno` int(255) NOT NULL,
  `applicant_id` varchar(20) DEFAULT NULL,
  `jobid` varchar(200) DEFAULT NULL,
  `applied_id` varchar(30) NOT NULL,
  `name` varchar(200) DEFAULT NULL,
  `email` varchar(200) DEFAULT NULL,
  `phone` varchar(200) DEFAULT NULL,
  `countryCode` varchar(20) DEFAULT NULL,
  `residence` varchar(200) DEFAULT NULL,
  `dob` varchar(200) DEFAULT NULL,
  `profile_image` varchar(200) DEFAULT NULL,
  `current_emp` varchar(200) DEFAULT NULL,
  `current_sal` varchar(200) DEFAULT NULL,
  `experience` varchar(200) DEFAULT NULL,
  `apply_position` varchar(200) DEFAULT NULL,
  `job_city` varchar(200) DEFAULT NULL,
  `notice_period` varchar(200) DEFAULT NULL,
  `rolecategory` varchar(20) DEFAULT NULL,
  `resume` varchar(200) DEFAULT NULL,
  `kenz_resume` varchar(250) DEFAULT NULL,
  `apply_date` varchar(200) DEFAULT NULL,
  `apply_time` varchar(200) DEFAULT NULL,
  `status` enum('in process','on hold','selected','rejected') DEFAULT 'in process',
  `notice` varchar(200) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `applicants`
--

INSERT INTO `applicants` (`sno`, `applicant_id`, `jobid`, `applied_id`, `name`, `email`, `phone`, `countryCode`, `residence`, `dob`, `profile_image`, `current_emp`, `current_sal`, `experience`, `apply_position`, `job_city`, `notice_period`, `rolecategory`, `resume`, `kenz_resume`, `apply_date`, `apply_time`, `status`, `notice`) VALUES
(1, NULL, '24', '', 'sad', 'rizwan@esdy.in', '9232645123645', NULL, '--SELECT--', '2021-12-30', '1640849170.png', 'asdf', '1010', '8', 'SAP BW', 'KARACHI - PAKISTAN', 'One Week', NULL, '', NULL, '21/12/30', '12:56:09 PM', 'in process', NULL),
(2, NULL, '24', '', 'asdf', 'asdf@gmail.com', '9212312312', NULL, '--SELECT--', '2022-01-01', '1640849203.png', '123', '123', '10+', 'SAP BW', 'KARACHI - PAKISTAN', 'Two Week', NULL, '1640849203.docx', NULL, '21/12/30', '12:56:42 PM', 'in process', NULL),
(3, NULL, '24', '', 'jack', 'admin@gmail.com', '9212345678', NULL, 'Karachi', '2021-12-16', '1640850149.png', 'hyderabad', '1200', '1', 'SAP BW', 'KARACHI - PAKISTAN', 'One Week', NULL, '', NULL, '21/12/30', '01:12:28 PM', 'in process', NULL),
(4, NULL, '24', '', 'kenz', 'admin@gmail.com', '9299784456131', NULL, 'Karachi', '2021-12-15', '1640851403.png', 'hyderabad', '15000', '2', 'SAP BW', 'KARACHI - PAKISTAN', 'Two Week', NULL, '', NULL, '21/12/30', '01:33:23 PM', 'in process', NULL),
(5, NULL, '24', '', 'kenz', 'admin@gmail.com', '9299784456131', NULL, 'Karachi', '2021-12-15', '1640851607.png', 'hyderabad', '15000', '2', 'SAP BW', 'KARACHI - PAKISTAN', 'Two Week', NULL, '', NULL, '21/12/30', '01:36:47 PM', 'in process', NULL),
(6, NULL, '24', '', 'Allowance/Deduction Name', 'admin@gmail.com', '213-1', NULL, 'Karachi', '2020-12-30', '1640851678.png', 'hyderabad', '-1', '0', 'SAP BW', 'KARACHI - PAKISTAN', 'One Week', NULL, '', NULL, '21/12/30', '01:37:58 PM', 'in process', NULL),
(7, NULL, '24', '', 'Allowance/Deduction Name', 'admin@gmail.com', '213-1', NULL, 'Karachi', '2020-12-30', '1640852009.png', 'hyderabad', '-1', '0', 'SAP BW', 'KARACHI - PAKISTAN', 'One Week', NULL, '', NULL, '21/12/30', '01:43:29 PM', 'in process', NULL),
(8, NULL, '24', '', 'shaik rizone ali ', 'admin@gmail.com', '213-1', NULL, 'Karachi', '2021-12-31', '1640852079.png', 'hyderabad', '-1', '0', 'SAP BW', 'KARACHI - PAKISTAN', 'One Week', NULL, '', NULL, '21/12/30', '01:44:38 PM', 'in process', NULL),
(9, NULL, '24', '', 'shaik rizone ali ', 'admin@gmail.com', '213-1', NULL, 'Karachi', '2021-12-31', '1640852445.png', 'hyderabad', '-1', '0', 'SAP BW', 'KARACHI - PAKISTAN', 'One Week', NULL, '', NULL, '21/12/30', '01:50:45 PM', 'in process', NULL),
(10, NULL, '24', '', 'Allowance/Deduction Name sha sahab ', 'admin@gmail.com', '92-2', NULL, 'hyderabad', '2021-12-31', '1640852531.png', 'hyderabad', '-1', '1', 'SAP BW', 'KARACHI - PAKISTAN', 'One Week', NULL, '', NULL, '21/12/30', '01:52:10 PM', 'in process', NULL),
(11, NULL, '24', '', 'md', 'mwajisap@gmail.com', '92300001201', NULL, 'hyderabad', '1999-12-13', '1642505356.png', 'kenz', '321456', '10+', 'SAP BW', 'RIYADH - KSA', 'Two Months', NULL, '', NULL, '22/01/18', '04:59:16 PM', 'in process', NULL),
(12, NULL, '24', '', 'waji', 'mwajisap@gmail.com', '929620124587', NULL, 'hyderabad', '1977-12-13', '1642505597.png', 'KENz', '123000', '10+', 'SAP BW', 'RIYADH - KSA', 'Two Months', NULL, '', NULL, '22/01/18', '05:03:17 PM', 'in process', NULL),
(13, NULL, '24', '', 'Khan', 'mwajisap@gmail.com', '92539845000', NULL, 'hyderabad', '1977-03-04', '1645356983.png', 'kenz', '80000', '10+', 'SAP BW', 'KARACHI - PAKISTAN', 'Two Months', NULL, '1645356983.docx', '13-kenz.png', '22/02/20', '05:06:22 PM', 'in process', NULL),
(14, NULL, '25', '', 'Muhammad Iqbal', 'iqbal.jde@gmail.com', '97470080122', NULL, '--SELECT--', '1980-01-12', '1645461121.jpg', 'QD-SBG Construction', '12345678', '10+', 'JD Edwards Consultant', 'Off-Shore', 'One Month', NULL, '1645461122.docx', '14-kenz.pdf', '22/02/21', '10:02:01 PM', 'in process', NULL),
(15, NULL, '24', '', 'ilias', 'iliasahmedb4u@gmail.com', '918019360014', NULL, 'hyderabad', '2022-04-05', '1646748718.jpg', 'test', '123', '3', 'SAP BW', 'Off-Shore', 'One Week', NULL, '1646748718.pdf', NULL, '22/03/08', '07:41:58 PM', 'in process', NULL),
(16, NULL, '24', '', 'ilias', 'iliasahmedb4u@gmail.com', '918019360014', NULL, 'hyderabad', '2022-04-05', '1646748836.jpg', 'test', '123', '3', 'SAP BW', 'Off-Shore', 'One Week', NULL, '1646748836.pdf', NULL, '22/03/08', '07:43:55 PM', 'in process', NULL),
(17, NULL, '24', '', 'ilias', 'iliasahmedb4u@gmail.com', '918019360014', NULL, 'hyderabad', '2022-04-05', '1646749253.jpg', 'test', '123', '3', 'SAP BW', 'Off-Shore', 'One Week', NULL, '1646749253.pdf', NULL, '22/03/08', '07:50:53 PM', 'in process', NULL),
(18, NULL, '24', '', 'ilias', 'iliasahmedb4u@gmail.com', '918019360014', NULL, 'hyderabad', '2022-04-05', '1646749262.jpg', 'test', '123', '3', 'SAP BW', 'Off-Shore', 'One Week', NULL, '1646749262.pdf', NULL, '22/03/08', '07:51:02 PM', 'in process', NULL),
(19, NULL, '24', '', 'ilias', 'iliasahmedb4u@gmail.com', '918019360014', NULL, 'hyderabad', '2022-04-05', '1646749287.jpg', 'test', '123', '3', 'SAP BW', 'Off-Shore', 'One Week', NULL, '1646749287.pdf', NULL, '22/03/08', '07:51:26 PM', 'in process', NULL),
(20, NULL, '24', '', 'ilias', 'iliasahmedb4u@gmail.com', '918019360014', NULL, 'hyderabad', '2022-04-05', '1646750152.jpg', 'test', '123', '3', 'SAP BW', 'Off-Shore', 'One Week', NULL, '1646750152.pdf', NULL, '22/03/08', '08:05:52 PM', 'in process', NULL),
(21, NULL, '26', '', 'Ahmad Saib ', 'ahmad.saib@outlook.com', '92923475024969', NULL, '--SELECT--', '1983-02-14', '1647338541.jpg', 'Infiniun', '1', '9', 'Java Developer', 'Off-Shore', 'One Month', NULL, '1647338541.doc', '21-kenz.pdf', '22/03/15', '03:32:21 PM', 'in process', NULL),
(22, NULL, '27', '', 'Akif A Dadan', 'akifdadan@gmail.com', '966562762958', NULL, '--SELECT--', '1982-02-11', '1647338960.jpg', 'Baud Telecom Company', '1', '10', 'Project Manager ', 'Off-Shore', 'One Month', NULL, '1647338960.pdf', '22-kenz.pdf', '22/03/15', '03:39:20 PM', 'in process', NULL),
(23, NULL, '31', '', 'Adil Zahoor Anjum', 'adil.zahoor.anjum@gmail.com', '923359981005', NULL, '--SELECT--', '1980-12-02', '1647339289.jpg', 'Androweb', '1', '4', 'Android Developer', 'Off-Shore', 'One Month', NULL, '1647339289.pdf', '23-kenz.pdf', '22/03/15', '03:44:48 PM', 'in process', NULL),
(24, NULL, '31', '', 'Humayun Sikander', 'humayunsikander@gmail.com', '9203359400599', NULL, '--SELECT--', '1980-12-02', '1647339437.jpg', 'Evamp & Saanga', '1', '4', 'Android Developer', 'Off-Shore', 'One Month', NULL, '1647339437.pdf', '24-kenz.pdf', '22/03/15', '03:47:17 PM', 'in process', NULL),
(25, NULL, '31', '', 'I B R A R H U S S A I N', 'ibrar.hussain8797@gmail.com', '923338797067', NULL, '--SELECT--', '1980-12-20', '', 'Punjab Information Technology Board', '1', '3', 'Android Developer', 'Off-Shore', 'One Month', NULL, '1647339606.pdf', '25-kenz.pdf', '22/03/15', '03:50:05 PM', 'in process', NULL),
(26, NULL, '31', '', 'Shuban Aslam', 'shubanali12@gmail.com', '923078459587', NULL, '--SELECT--', '1980-02-14', '1647339851.jpg', 'GAYTE', '1', '4', 'Android Developer', 'Off-Shore', 'One Month', NULL, '1647339851.pdf', '26-kenz.pdf', '22/03/15', '03:54:10 PM', 'in process', NULL),
(27, NULL, '28', '', 'Atiq ur Rehman', 'mirzaatiq1310@gmail.com', '923347472537', NULL, '--SELECT--', '1980-01-01', '1647340039.jpg', 'Pakistan Telecommunication Company ', '1', '6', 'SAP FICO', 'Off-Shore', 'One Month', NULL, '1647340039.doc', '27-kenz.pdf', '22/03/15', '03:57:18 PM', 'in process', NULL),
(28, NULL, '28', '', 'BALAKRISHNA GOUD', 'balagoud2000@gmail.com', '919663266447', NULL, '--SELECT--', '1980-01-01', '1647340173.jpg', 'COPART', '1', '10+', 'SAP FICO', 'Off-Shore', 'One Month', NULL, '1647340173.docx', '28-kenz.pdf', '22/03/15', '03:59:32 PM', 'in process', NULL),
(29, NULL, '26', '', 'Faisal Mehmood', 'faisalmaher979@gmail.com', '923123126767', NULL, '--SELECT--', '1980-01-01', '1647340328.jpg', 'TALLYMARKS CONSULTING', '1', '4', 'Java Developer', 'Off-Shore', 'One Month', NULL, '1647340328.pdf', NULL, '22/03/15', '04:02:08 PM', 'in process', NULL),
(30, NULL, '27', '', 'GUNJAN M ACHARYA', 'gunjan.acharya3@gmail.com', '9107874467350', NULL, '--SELECT--', '1980-01-01', '1647340444.jpg', 'Vistaprint India ', '1', '10+', 'Project Manager ', 'Off-Shore', 'One Month', NULL, '1647340444.doc', '30-kenz.pdf', '22/03/15', '04:04:03 PM', 'in process', NULL),
(31, NULL, '26', '', 'MASOOM MAHMAD TAMBE', 'MASOOMTAMBE143@gmail.com', '917775860435', NULL, '--SELECT--', '1980-01-01', '1647340701.jpg', 'mphatek system', '1', '6', 'Java Developer', 'Off-Shore', 'One Month', NULL, '1647340701.pdf', '31-kenz.pdf', '22/03/15', '04:08:20 PM', 'in process', NULL),
(32, NULL, '26', '', 'Mehran Laghari', 'mehrank530@gmail.com', '92923133914280', NULL, '--SELECT--', '1985-02-11', '1647340834.jpg', 'CQ Technologies', '1', '5', 'Java Developer', 'Off-Shore', 'One Month', NULL, '1647340834.pdf', '32-kenz.pdf', '22/03/15', '04:10:34 PM', 'in process', NULL),
(33, NULL, '27', '', 'MOHAMED MASHOOD THOOMBATH', 'tmmashood@gmail.com', '966966552234402', NULL, '--SELECT--', '1980-01-01', '1647340969.jpg', 'Riyad Bank', '1', '10+', 'Project Manager ', 'RIYADH - KSA', 'One Month', NULL, '1647340969.pdf', NULL, '22/03/15', '04:12:49 PM', 'in process', NULL),
(34, NULL, '27', '', 'MOHAMMED AHMEDUDDIN', 'ahmedcurves@gmail.com', '966503281726', NULL, '--SELECT--', '1980-01-01', '1647341072.jpg', 'Jawraa Riyadh- KSA', '1', '10+', 'Project Manager ', 'Off-Shore', 'One Month', NULL, '1647341072.pdf', '34-kenz.pdf', '22/03/15', '04:14:31 PM', 'in process', NULL),
(35, NULL, '26', '', 'Mohammed  Shafiq', 'Shafiq2000us@gmail.com', '966571677340', NULL, '--SELECT--', '1980-01-01', '1647341215.jpg', 'TechGraylogix', '1', '9', 'Java Developer', 'Off-Shore', 'One Month', NULL, '1647341215.pdf', '35-kenz.pdf', '22/03/15', '04:16:55 PM', 'in process', NULL),
(36, NULL, '26', '', 'MUHAMMAD ASAD KHAN', 'asadkhan742@gmail.com', '923442448934', NULL, '--SELECT--', '1980-01-01', '1647363632.jpg', 'FWU Ag', '1', '9', 'Java Developer', 'Off-Shore', 'One Month', NULL, '1647363632.pdf', '36-kenz.pdf', '22/03/15', '10:30:31 PM', 'in process', NULL),
(37, NULL, '29', '', 'Muhammad Junaid Usman', 'junaid.usman@live.com', '923452081626', NULL, '--SELECT--', '1984-04-15', '1647363870.jpg', 'IAMPLIFY CONSULTING SOLUTIONS PVT(LTD)', '1', '6', 'Oracle fusion HCM', 'Off-Shore', 'One Month', NULL, '1647363870.doc', '37-kenz.pdf', '22/03/15', '10:34:29 PM', 'in process', NULL),
(38, NULL, '28', '', 'Muhammad Usman', 'm.usman14314@gmail.com', '923217244232', NULL, '--SELECT--', '1987-10-09', '1647364044.jpg', 'Crowe Harworth International', '1', '4', 'SAP FICO', 'Off-Shore', 'One Month', NULL, '1647364044.docx', NULL, '22/03/15', '10:37:23 PM', 'in process', NULL),
(39, NULL, '32', '', 'ADIL AHAED', 'adilamed07@gmail.com', '966538871534', NULL, '--SELECT--', '1980-01-01', '1647364562.jpg', 'ARABSIGN COMPANY', '1', '3', 'Web Developer', 'Off-Shore', 'One Month', NULL, '1647364562.pdf', '39-kenz.pdf', '22/03/15', '10:46:02 PM', 'in process', NULL),
(40, NULL, '33', '', 'Aqeel', 'khaja.aqeel@gmail.com', '96697235654', NULL, '--SELECT--', '1980-01-01', '1647365382.jpg', 'Aâ€™Saffa Foods S.A.O.G ', '1', '10+', 'Oracle Apps Consultant', 'Off-Shore', 'One Month', NULL, '1647365382.doc', '40-kenz.pdf', '22/03/15', '10:59:41 PM', 'in process', NULL),
(41, NULL, '29', '', 'ARSALAN AHMED SIDDIQUI', 'arslan.siddiqui@hotmail.com', '923002601507', NULL, '--SELECT--', '1980-01-01', '1647365758.jpg', 'Master Motors', '1', '10+', 'Oracle fusion HCM', 'Off-Shore', 'One Month', NULL, '1647365758.pdf', '41-kenz.pdf', '22/03/15', '11:05:58 PM', 'in process', NULL),
(42, NULL, '25', '', 'Sajjad Zamir Syed', 'sszit760@gmail.com', '27836623090', NULL, '--SELECT--', '1976-12-07', '1647366149.jpg', 'TRAKKER PTY LTD', '1', '10', 'JD Edwards Consultant', 'Off-Shore', 'One Month', NULL, '1647366149.docx', '42-kenz.pdf', '22/03/15', '11:12:28 PM', 'in process', NULL),
(43, NULL, '26', '', 'SYED SHOYEB', 'syedshoyeb1@gmail.com', '917013122662', NULL, '--SELECT--', '1980-01-01', '1647366414.jpg', 'Capgemini', '1', '4', 'Java Developer', 'Off-Shore', 'One Month', NULL, '1647366414.pdf', '43-kenz.pdf', '22/03/15', '11:16:54 PM', 'in process', NULL),
(44, NULL, '31', '', 'Taseer Ahmad', 'taseer.ahmadd@gmail.com', '923034172052', NULL, '--SELECT--', '1980-01-01', '1647366635.jpg', 'Augersoft', '1', '5', 'Android Developer', 'Off-Shore', 'One Month', NULL, '1647366635.pdf', '44-kenz.pdf', '22/03/15', '11:20:34 PM', 'in process', NULL),
(45, NULL, '26', '', 'Vimal T D', 'vimaltd532@gmail.com', '919995247532', NULL, '--SELECT--', '1980-01-01', '1647366849.jpg', 'Webcontentor', '1', '6', 'Java Developer', 'Off-Shore', 'One Month', NULL, '1647366849.pdf', '45-kenz.pdf', '22/03/15', '11:24:09 PM', 'in process', NULL),
(46, NULL, '39', '', 'Rasool Khan Shaik', 'srasoolkhan.81@gmail.com', '9660592347662', NULL, '--SELECT--', '1981-07-26', '1650803518.png', 'Katerra Saudi Arabia', '28000', '10+', 'ERP SAP Project System Consultant', 'DAMMAM - KSA', 'One Month', NULL, '1650803518.doc', '46-kenz.pdf', '22/04/24', '06:01:58 PM', 'in process', NULL),
(47, NULL, '37', '', 'Hasnat Ahmed', 'hasnat@gmail.com', '923333141163', NULL, 'Karachi', '1974-11-25', '1650887385.JPG', 'Abacus', '1', '10+', 'ERP SAP HCM Payroll/Time Consultant', 'JEDDAH - KSA', 'One Month', NULL, '1650887385.doc', '47-kenz.pdf', '22/04/25', '05:19:44 PM', 'in process', NULL),
(48, NULL, '37', '', 'Rashid Munir', 'rashidsap7@gmail.com', '923247006691', NULL, 'Karachi', '1992-06-04', '1650897163.jpg', 'Qarshi Industries pvt Ltd', '200000', '9', 'ERP SAP HCM Payroll/Time Consultant', 'JEDDAH - KSA', 'One Month', NULL, '1650897163.pdf', '48-kenz.pdf', '22/04/25', '08:02:43 PM', 'in process', NULL),
(49, NULL, '39', '', 'Nabeel Bhatty', 'nabeel.bhatty@gmail.com', '923452430956', NULL, 'Karachi', '1983-11-05', '1650957115.jpg', 'IBM ', '265000', '10+', 'ERP SAP Project System Consultant', 'DAMMAM - KSA', 'One Month', NULL, '1650957115.pdf', '49-kenz.pdf', '22/04/26', '12:41:55 PM', 'in process', NULL),
(50, NULL, '39', '', 'GHAZALA SALEEM AWAN  (Islamabad Pakistan)', 'geezee1010@gmail.com', '9203345400605', NULL, 'Karachi', '1980-12-30', '1650961268.jpg', 'PAKISTAN TELECOMMUNICATION COMPANY LIMITED /UFONE (ETISALAT SUBSIDORY)', '107000', '10+', 'ERP SAP Project System Consultant', 'DAMMAM - KSA', 'One Month', NULL, '1650961268.pdf', '50-kenz.pdf', '22/04/26', '01:51:07 PM', 'in process', NULL),
(51, NULL, '38', '', 'Arif Ali Siddiqui', 'arif_ali_sidd@yahoo.com', '923478353778', NULL, 'Karachi', '1985-12-02', '', 'Gatron Industries Limited', '300000', '9', 'SAP FICO ', 'RIYADH - KSA', 'Two Week', NULL, '1651041233.pdf', '51-kenz.pdf', '22/04/27', '12:03:55 PM', 'in process', NULL),
(52, NULL, '34', '', 'Kaman Singh', 'kamansingh.sap@gmail.com', '966599055275', NULL, 'Riyadh', '1988-02-23', '1651145181.jpg', 'Almarai', '12534', '10', 'SAP BPC Consultant', 'RIYADH - KSA', 'Two Months', NULL, '1651145181.doc', '52-kenz.pdf', '22/04/28', '04:56:20 PM', 'in process', NULL),
(53, NULL, '38', '', 'S NAGA RAMESH BABU', 'rameshmba006@gmail.com', '966570856187', NULL, 'Riyadh', '1979-06-11', '1651161779.jpg', 'Almarai', '12000', '6', 'SAP FICO ', 'RIYADH - KSA', 'One Month', NULL, '1651161779.docx', '53-kenz.pdf', '22/04/28', '09:32:58 PM', 'in process', NULL),
(54, NULL, '38', '', 'Mirza Umer Muhammad', 'umermirza4@gmail.com', '923234877539', NULL, 'Karachi', '1980-02-10', '1651308536.jpg', 'Qarshi Industries ', '407000', '10+', 'SAP FICO ', 'DAMMAM - KSA', 'Two Week', NULL, '1651308536.doc', '54-kenz.pdf', '22/04/30', '02:18:56 PM', 'in process', NULL),
(55, NULL, '38', '', 'Srivittal Vanamala', 'srivittal.vanamala@gmail.com', '919849981178', NULL, 'hyderabad', '1978-01-01', '1651406207.jpg', 'Accenture Solutions Pvt Ltd', '3500000', '10+', 'SAP FICO ', 'HYDERABAD - INDIA', 'More', NULL, '1651406207.doc', '55-kenz.pdf', '22/05/01', '05:26:47 PM', 'in process', NULL),
(56, NULL, '38', '', 'Farrukh Iqbal Khan', 'farrukhcfc@gmail.com', '923336559512', NULL, 'Karachi', '1983-08-21', '1652678842.jpg', 'Sr. FICO & FM-GM Consultant', '260', '10+', 'SAP FICO ', 'DAMMAM - KSA', 'Two Months', NULL, '1652678842.pdf', NULL, '22/05/16', '10:57:22 AM', 'in process', NULL),
(57, NULL, '37', '', 'Barket Ali Zafar', 'sapconsultant05@gmail.com', '966506889348', NULL, 'Dammam', '1977-06-06', '1652694866.png', 'WIPRO Arabia Ltd', '23500', '10+', 'ERP SAP HCM Payroll/Time Consultant', 'DAMMAM - KSA', 'One Month', NULL, '1652694866.pdf', NULL, '22/05/16', '03:24:26 PM', 'in process', NULL),
(58, NULL, '50', '', 'Shaik Munazeer Hasen', 'munazeer.erp@gmail.com', '919986161087', NULL, 'hyderabad', '1987-08-14', '1653994328.jpg', 'IBM', '2000000', '8', 'Oracle HCM EBM', 'Yanbu - KSA', 'More', NULL, '1653994328.doc', NULL, '22/05/31', '04:22:07 PM', 'in process', NULL),
(59, NULL, '38', '', 'Mohammad Rizwan', 'mohammad.rizwan7011@gmail.com', '2138451088829', NULL, 'hyderabad', '1986-07-18', '', 'L&T infotech', '114000', '9', 'SAP FICO ', 'AL KHOBAR - KSA', 'More', NULL, '1657134691.doc', NULL, '22/07/07', '12:41:30 AM', 'in process', NULL),
(60, NULL, '37', '', 'Hasnat', 'hasnat@gmail.com', '923333141163', NULL, 'Karachi', '1974-11-11', '1657189494.JPG', 'Abacus Global', '9', '10+', 'ERP SAP HCM Payroll/Time Consultant', 'Off-Shore', 'One Month', NULL, '1657189494.doc', NULL, '22/07/07', '03:54:53 PM', 'in process', NULL),
(61, NULL, '41', '', 'Mohammed Ghouse', 'mohammedghousesf@gmail.com', '918977676933', NULL, 'hyderabad', '1990-11-13', '1657208029.jpg', 'PwC India', '1540000', '9', 'ERP SAP Success Factors Consultant RCM/RMK configuration experience.', 'RIYADH - KSA', 'Two Months', NULL, '1657208029.docx', NULL, '22/07/07', '09:03:48 PM', 'in process', NULL),
(62, NULL, '38', '', 'Tarek H. Chowdhury', 'tarekhchy@gmail.com', '8801819210126', NULL, '--SELECT--', '1971-10-08', '1657449316.jpg', 'EPIC Group ', '200000', '10+', 'SAP FICO ', 'JEDDAH - KSA', 'One Month', NULL, '1657449316.pdf', NULL, '22/07/10', '04:05:16 PM', 'in process', NULL),
(63, NULL, '53', '', 'Sarfaraz Alam', 'sarfrazmca10@gmail.com', '918287978927', NULL, 'hyderabad', '1987-01-03', '', 'AGTS Dubai', '23400', '10+', 'SAP Development (ABAP / Fiori) - Senior Analyst', 'Dubai - UAE', 'Two Week', NULL, '1658572030.doc', NULL, '22/07/23', '03:57:09 PM', 'in process', NULL),
(64, NULL, '40', '', 'Kashif Abdul Ghafoor', 'kashifabdulghafoor@gmail.com', '9200923343228907', NULL, 'Karachi', '1983-02-20', '', 'Siemens Pakistan Eng.  Co Ltd', '0000', '10+', 'ERP SAP Success Factors Consultant PMGM configuration experience.', 'KARACHI - PAKISTAN', 'Two Months', NULL, '1672152351.pdf', NULL, '22/12/27', '08:15:50 PM', 'in process', NULL),
(65, NULL, '41', '', 'Kashif Abdul Ghafoor', 'kashifabdulghafoor@gmail.com', '9200923343228907', NULL, 'Karachi', '1983-02-20', '', 'Siemens Pakistan Eng.  Co Ltd', '0000', '10+', 'ERP SAP Success Factors Consultant RCM/RMK configuration experience.', 'Dubai - UAE', 'Two Months', NULL, '1672152598.pdf', NULL, '22/12/27', '08:19:57 PM', 'in process', NULL),
(66, NULL, '40', '', 'Mudassar Mehmood', 'mudassarpk94@gmail.com', '966531373372', NULL, 'Riyadh', '1993-10-18', '', 'SAPIENT Hub', '8000', '6', 'ERP SAP Success Factors Consultant PMGM configuration experience.', 'NEOM - KSA', 'One Week', NULL, '1672871727.docx', NULL, '23/01/05', '04:05:26 AM', 'in process', NULL),
(67, NULL, '38', '', 'Umer Muhammad ', 'umermughal@msn.com', '966538413788', NULL, 'Riyadh', '1979-06-28', '1675902437.jpg', 'Astra Industrial Group ', '25800', '10+', 'SAP FICO ', 'JEDDAH - KSA', 'One Week', NULL, '1675902437.pdf', NULL, '23/02/09', '05:57:17 AM', 'in process', NULL),
(68, NULL, '52', '', 'Javed Saifi', 'javedjsaifi@gmail.com', '971557141609', NULL, 'Offshore', '1994-09-04', '1675920040.jpg', 'UIX TECHNOLOGIES LIMITED', '11000', '5', 'SAP PS - Senior Analyst', 'RIYADH - KSA', 'Two Months', NULL, '1675920040.pdf', NULL, '23/02/09', '10:50:40 AM', 'in process', NULL),
(69, NULL, '38', '', 'Abdul Jabbar', 'a.jabbar272@gmail.com', '971568837197', NULL, '--SELECT--', '1983-01-30', '1675921024.jpg', 'Abu Dhabi Digital Authority', '30000', '10+', 'SAP FICO ', 'Dubai - UAE', 'Two Week', NULL, '1675921024.pdf', NULL, '23/02/09', '11:07:04 AM', 'in process', NULL),
(70, NULL, '54', '', 'Abdul Jabbar', 'a.jabbar272@gmail.com', '971568837197', NULL, '--SELECT--', '1983-01-30', '1675921119.jpg', 'Abu Dhabi Digital Authority', '30000', '10+', 'SAP FI/CO - Senior Analyst', 'Dubai - UAE', 'Two Week', NULL, '1675921119.pdf', NULL, '23/02/09', '11:08:38 AM', 'in process', NULL),
(71, NULL, '95', '', 'Abdul Jabbar', 'a.jabbar272@gmail.com', '971568837197', NULL, '--SELECT--', '1983-01-30', '1675921240.jpg', 'Abu Dhabi Digital Authority', '30000', '10+', 'SAP FI Consultant', 'RIYADH - KSA', 'Two Week', NULL, '1675921240.pdf', NULL, '23/02/09', '11:10:40 AM', 'in process', NULL),
(72, NULL, '39', '', 'MUHAMMAD SALEEM', 'm_saleemali@hotmail.com', '966564507005', NULL, 'Riyadh', '1976-12-16', '1675925244.png', 'ABUNNYYAN HOLDING GROUP', '24768', '10+', 'ERP SAP Project System Consultant', 'RIYADH - KSA', 'Two Months', NULL, '1675925244.pdf', NULL, '23/02/09', '12:17:23 PM', 'in process', NULL),
(73, NULL, '38', '', 'Muhammad Hanif Abid ', 'hanif786.cma@gmail.com', '923414521224', NULL, 'Karachi', '1980-06-10', '1675944290.png', 'Master Tiles & Ceramic Indusries', '300000', '8', 'SAP FICO ', 'RIYADH - KSA', 'Two Week', NULL, '1675944290.pdf', NULL, '23/02/09', '05:34:49 PM', 'in process', NULL),
(74, NULL, '54', '', 'Muhammad Hanif Abid ', 'hanif786.cma@gmail.com', '9203414521224', NULL, 'Karachi', '1980-06-10', '1675944507.png', 'Master Tiles & Ceramic Indusries', '300000', '8', 'SAP FI/CO - Senior Analyst', 'RIYADH - KSA', 'Two Week', NULL, '1675944507.pdf', NULL, '23/02/09', '05:38:26 PM', 'in process', NULL),
(75, NULL, '37', '', 'Rashid Munir', 'rashidsap7@gmail.com', '923247006691', NULL, 'Karachi', '1992-06-04', '', 'Abacus Consulting', '300000', '9', 'ERP SAP HCM Payroll/Time Consultant', 'RIYADH - KSA', 'One Month', NULL, '1675957654.pdf', NULL, '23/02/09', '09:17:34 PM', 'in process', NULL),
(76, NULL, '51', '', 'sadiqueashfaque', 'sadiqueashfaque194@gmail.com', '919123431945', NULL, 'hyderabad', '2000-02-17', '1676019999.jpg', 'fresher', '0', '0', 'SAP MM - Senior Analyst', 'Dubai - UAE', 'One Week', NULL, '1676019999.pdf', NULL, '23/02/10', '02:36:39 PM', 'in process', NULL),
(77, NULL, '37', '', 'Adnan Sheikh', 'md.adnansheikh94@gmail.com', '918380806095', NULL, '--SELECT--', '1994-12-24', '1676033887.jpg', 'Globalization Partners', '450000', '4', 'ERP SAP HCM Payroll/Time Consultant', 'NEOM - KSA', 'One Month', NULL, '1676033887.pdf', NULL, '23/02/10', '06:28:06 PM', 'in process', NULL),
(78, NULL, '54', '', 'Haroon Hameed', 'haroon351hameed@gmail.com', '923056767261', NULL, '--SELECT--', '1990-06-26', '', 'Volka Food Int Ltd.', '400000', '5', 'SAP FI/CO - Senior Analyst', 'Dubai - UAE', 'One Month', NULL, '1676112292.pdf', NULL, '23/02/11', '04:14:52 PM', 'in process', NULL),
(79, NULL, '38', '', 'Muhammad Ayaz', 'ayaz.fico@gmail.com', '97451041097', NULL, 'Offshore', '1983-09-18', '', 'Power International holding ', '31000', '8', 'SAP FICO ', 'RIYADH - KSA', 'One Month', NULL, '1676180420.docx', NULL, '23/02/12', '11:10:20 AM', 'in process', NULL),
(80, NULL, '54', '', 'Muhammad Ayaz', 'ayaz.fico@gmail.com', '97451041097', NULL, 'Offshore', '1983-09-18', '', 'Power International holding ', '31000', '7', 'SAP FI/CO - Senior Analyst', 'RIYADH - KSA', 'One Month', NULL, '1676180740.docx', NULL, '23/02/12', '11:15:39 AM', 'in process', NULL),
(81, NULL, '104', '', 'ilias ahmed', 'sia.in@kenz-innovations.com', '918019360014', NULL, 'hyderabad', '1998-08-05', '1676290610.jpg', 'Kenz', '40000', '5', '.NET backend developer', 'Dubai - UAE', 'Two Week', NULL, '1676290610.pdf', NULL, '23/02/13', '05:46:51 PM', 'in process', NULL),
(82, NULL, '24', '', 'OWAIS', 'mdowaisali@gmail.com', '916302366868', NULL, 'hyderabad', '1980-11-08', '1678728425.png', 'KENZ', '100000', '10+', 'SAP BW', 'HYDERABAD - INDIA', 'Two Week', NULL, '1678728426.pdf', NULL, '23/03/13', '10:57:06 PM', 'in process', NULL),
(83, NULL, '53', '', 'M. Rumzaan Sultan', 'Muhammad.Rumzaan@gmail.com', '971555863488', NULL, 'Karachi', '1980-08-20', '1679269478.png', 'Abacus Consulting', '18000', '10', 'SAP Development (ABAP / Fiori) - Senior Analyst', 'AL KHOBAR - KSA', 'Two Week', NULL, '1679269478.docx', NULL, '23/03/20', '05:14:38 AM', 'in process', NULL),
(84, NULL, '53', '', 'hammad', 'hammadarain2010@gmail.com', '9233338380008', NULL, 'Karachi', '1991-05-18', '1679291961.PNG', 'Abap Developer ', '80000', '2', 'SAP Development (ABAP / Fiori) - Senior Analyst', 'KARACHI - PAKISTAN', 'One Month', NULL, '1679291961.pdf', NULL, '23/03/20', '11:29:20 AM', 'in process', NULL),
(85, NULL, '68', '', 'Application Developer II', 'm.asharmateen@gmail.com', '923066049264', NULL, 'Karachi', '1996-04-11', '1679378666.jpg', 'Din Textile Lahore', '220000', '5', 'Application Developer II', 'Egypt & KSA', 'One Month', NULL, '1679378666.pdf', NULL, '23/03/21', '11:34:25 AM', 'in process', NULL),
(86, NULL, '24', '', 'Adnan Rock', 'mohdadnan2716@gmail.com', '213987542944', NULL, 'hyderabad', '2023-03-30', '1680161352.png', 'ESDY', '1200000', '2', 'SAP BW', 'JUBAIL - KSA', 'Two Week', NULL, '', NULL, '23/03/30', '09:29:12 AM', 'in process', NULL),
(87, NULL, '75', '', 'Kavya Gorrepati', 'kavya@esdy.in', '213898885552', NULL, 'hyderabad', '2023-03-09', '1680161573.png', 'ESDY', '2', '10', 'Functional Analyst IV (Saudi Nationals)', 'Off-Shore', 'One Month', NULL, '1680161573.pdf', NULL, '23/03/30', '09:32:53 AM', 'in process', NULL),
(88, NULL, '24', '1', 'Syed Rizwan Ul Haq', 'morgan@gmail.com', '21391007 81165', NULL, 'hyderabad', '2017-06-13', '1680254131.png', 'ESDY', '888888', '1', 'SAP BW', 'KARACHI - PAKISTAN', 'Two Week', NULL, 'uploads/-11680251424.csv', NULL, '23/03/31', '11:15:30 AM', 'in process', NULL),
(89, NULL, '50', '1', 'Syed Rizwan Ul Haq', 'morgan@gmail.com', '97791007 81165', NULL, 'Riyadh', '2023-03-08', '1680255384.png', 'ESDY', '55555', '1', 'Oracle HCM EBM', 'DAMMAM - KSA', 'One Week', NULL, 'uploads/-11680251424.csv', NULL, '23/03/31', '11:36:23 AM', 'in process', NULL),
(92, NULL, '51', '1', 'Syed Rizwan Ul Haq', 'morgan@gmail.com', '21391007 81165', NULL, 'Sukkur', '2023-03-24', '1680258964.jpg', 'ESDY', '4845564', '8', 'SAP MM - Senior Analyst', 'DAMMAM - KSA', 'One Week', NULL, 'uploads/-11680251424.csv', NULL, '23/03/31', '12:36:03 PM', 'in process', NULL),
(93, NULL, '24', '', 'ilias ahmed', 'iliasahmedb4u@gmail.com', '918019360114', '91', 'hyderabad', '2023-04-14', NULL, 'Esdy', '420000', '7', 'SAP BW', 'Egypt & KSA', 'One Week', '', NULL, NULL, NULL, NULL, 'in process', NULL),
(94, 'AC130423080404', '24', '', 'ilias ahmed', 'iliasahmedb4u@gmail.com', '918019360014', '91', 'hyderabad', '2023-04-14', NULL, NULL, NULL, '1', 'SAP BW', 'HYDERABAD - INDIA', 'Two Week', '', NULL, NULL, '13/04/2023', NULL, 'in process', NULL),
(95, 'AC130423080425', '24', '', 'ilias ahmed', 'iliasahmedb4u@gmail.com', '918019360014', '91', 'hyderabad', '2023-04-14', NULL, 'Kenz', '140000', '1', 'SAP BW', 'HYDERABAD - INDIA', 'Two Week', '', NULL, NULL, '13/04/2023', NULL, 'in process', NULL),
(96, 'AC130423090414', '24', '', 'ilias ahmed', 'iliasahmedb4u@gmail.com', '918019360114', '91', 'hyderabad', '2023-04-14', '49560089_1231152017041053_5636550298555121664_n.jpg', 'Kenz', '120000', '5', 'SAP BW', 'HYDERABAD - INDIA', 'More', '', '', NULL, '13/04/2023', NULL, 'in process', NULL),
(97, 'AC130423060429', '38', '', 'ilias ahmed', 'iliasahmedb4u@gmail.com', '918019360014', '91', 'hyderabad', '2023-04-14', '.', 'Esdy', '1260000', '0', 'SAP FICO ', 'Bangladesh & Egypt', 'Two Week', 'SENIOR SAP CONSULTAN', NULL, NULL, '13/04/2023', NULL, 'in process', NULL),
(98, 'AC130423060416', '53', '', 'ilias ahmed', 'iliasahmedb4u@gmail.com', '2138019360014', '213', 'hyderabad', '2023-04-14', '.', 'esdy', '780654', '0', 'SAP Development (ABAP / Fiori) - Senior Analyst', 'NEOM - KSA', 'Two Week', '', NULL, NULL, '13/04/2023', NULL, 'in process', NULL),
(99, 'AC170423020413', '11', '', 'Developer', 'developer@outlook.com', '21365461561', '213', 'hyderabad', '1555-08-19', '.png', 'jsdnfj', '5555', '0', 'Chief Technician (Mechanical)', 'HYDERABAD - INDIA', 'Two Week', '', NULL, NULL, '17/04/2023', NULL, 'in process', NULL),
(100, 'AC170423020435', '11', '', 'Dev2', 'dev2@outlook.com', '2135+65651', '213', 'hyderabad', '4112-09-19', '.png', 'sojdnfjn', '3251', '0', 'Chief Technician (Mechanical)', 'Dubai - UAE', 'Two Week', '', 'Dev2-11681756955.png', NULL, '17/04/2023', NULL, 'in process', NULL),
(101, 'AC170423030420', '11', '', 'ilias ahmed', 'test@kenz.com', '918019360014', '91', 'hyderabad', '2023-04-18', '.', 'Kenz', '1000000', '6', 'Chief Technician (Mechanical)', 'HYDERABAD - INDIA', 'Two Week', '', 'ilias ahmed-11681759100.', NULL, '17/04/2023', NULL, 'in process', NULL),
(102, 'AC170423030441', '12', '', 'Shahzad Khan', 'mrshahzad_ahmed@yahoo.com ', '64277007524', '64', 'hyderabad', '2023-04-18', '.', 'Independent Contractor', '1000000', '10+', 'Warranty Advisor', 'HYDERABAD - INDIA', 'One Week', '', 'Shahzad Khan-11681760141.', NULL, '17/04/2023', NULL, 'in process', NULL),
(103, NULL, '144', '14', 'Amir Ahmed', 'amirintencode@gmail.com', '9109179928275', NULL, 'hyderabad', '1985-02-05', '1730915315.jpg', 'Intencode', '55000', '9', 'Full Stack Developer', 'HYDERABAD - INDIA', 'Two Months', NULL, '1730915315.pdf', NULL, '24/11/06', '11:18:35 PM', 'in process', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `certificates_tbl`
--

CREATE TABLE `certificates_tbl` (
  `id` int(11) NOT NULL,
  `emp_id` int(11) NOT NULL,
  `certificate_name` varchar(255) NOT NULL,
  `issued_by` varchar(255) NOT NULL,
  `issue_date` date NOT NULL,
  `valid_till` date DEFAULT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `certificates_tbl`
--

INSERT INTO `certificates_tbl` (`id`, `emp_id`, `certificate_name`, `issued_by`, `issue_date`, `valid_till`, `description`, `created_at`, `updated_at`) VALUES
(1, 16, 'Certified Java Programmer', 'Oracle', '2023-07-11', NULL, '• Achieved proficiency in Java programming fundamentals, including object-oriented concepts, data structures, and algorithms.\r\n\r\nAWS Certified Solutions Architect – Associate\r\nAmazon Web Services, 2022\r\n• Demonstrated expertise in designing distributed systems, cost-optimization, and security practices on AWS cloud platform.', '2024-12-11 10:57:40', '2024-12-11 10:57:40'),
(2, 16, 'Certification in Business or Project Management', 'Scrum Alliance', '2024-06-05', NULL, 'Project Management Institute, 2022\r\n• Acquired in-depth knowledge of project management processes, tools, and techniques to lead successful projects.', '2024-12-11 11:00:17', '2024-12-11 11:00:17');

-- --------------------------------------------------------

--
-- Table structure for table `certification`
--

CREATE TABLE `certification` (
  `id` int(10) NOT NULL,
  `application_id` varchar(20) DEFAULT NULL,
  `content` text DEFAULT NULL,
  `added_date` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `certification`
--

INSERT INTO `certification` (`id`, `application_id`, `content`, `added_date`) VALUES
(1, 'AC130423090414', 'Certified Ethical hacker', '2023-04-14 03:09:14'),
(2, 'AC130423090414', 'Certified Amazon Web Service Developer', '2023-04-14 03:09:14'),
(3, 'AC130423090414', 'Certified Google web developer', '2023-04-14 03:09:14'),
(4, 'AC130423090414', 'Certified Red Hat linux administrator', '2023-04-14 03:09:14'),
(5, 'AC130423060429', 'test', '2023-04-14 06:37:29'),
(6, 'AC130423060416', 'test', '2023-04-14 06:42:16'),
(7, 'AC170423020413', 'sdjknf', '2023-04-18 02:37:13'),
(8, 'AC170423020435', 'josdnfjn', '2023-04-18 02:42:35'),
(9, 'AC170423030420', 'Certified Ethical Hacker', '2023-04-18 03:18:20'),
(10, 'AC170423030420', 'Google Certified Android Developer', '2023-04-18 03:18:20'),
(11, 'AC170423030420', 'Red Hat linux administration', '2023-04-18 03:18:20'),
(12, 'AC170423030441', 'SAP Certified Application Professional â€“ S/4 Financials', '2023-04-18 03:35:41'),
(13, 'AC170423030441', 'Sap Certified Activate Project Manager/C_ACT_2016', '2023-04-18 03:35:41'),
(14, 'AC170423030441', 'SAP Certified Cloud Analytic/ SAC_2008', '2023-04-18 03:35:41'),
(15, 'AC170423030441', 'SAP Certified Business Process Foundation &amp; Integration /TERP10', '2023-04-18 03:35:41');

-- --------------------------------------------------------

--
-- Table structure for table `city`
--

CREATE TABLE `city` (
  `sno` int(10) NOT NULL,
  `city` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `city`
--

INSERT INTO `city` (`sno`, `city`) VALUES
(1, 'Karachi'),
(2, 'hyderabad'),
(3, 'Sukkur'),
(4, 'Dammam'),
(5, 'Riyadh'),
(6, 'Offshore');

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `id` int(11) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `country_code` varchar(20) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `company` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`id`, `first_name`, `last_name`, `email`, `country_code`, `phone`, `company`, `address`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Amir', 'Ahmed', 'amirintencode@gmail.com', '91', '9179928275', 'Loopintechies Services Pvt Ltd', '16-11-16/A/56\r\nAfzal Nagar, Teegalguda, Malakpet', 1, '2024-12-06 05:51:38', '2024-12-14 13:13:50'),
(4, 'Enamul', 'Haque', 'editor@editormindloops.org', '91', '8822773344', 'Milisoft eServices Pvt Ltd', 'Ghaziabad, UP', 1, '2024-12-15 18:48:02', '2024-12-15 18:48:02'),
(5, 'Sagar', 'Kumar', 'sagar@gmail.com', '91', '8765345612', 'MS Care', 'Patel Nagar, Delhi', 1, '2024-12-15 18:49:15', '2024-12-15 18:49:15');

-- --------------------------------------------------------

--
-- Table structure for table `education_tbl`
--

CREATE TABLE `education_tbl` (
  `id` int(11) NOT NULL,
  `emp_id` int(11) NOT NULL,
  `degree` varchar(255) NOT NULL,
  `university_name` varchar(255) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date DEFAULT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `education_tbl`
--

INSERT INTO `education_tbl` (`id`, `emp_id`, `degree`, `university_name`, `start_date`, `end_date`, `description`, `created_at`, `updated_at`) VALUES
(1, 16, 'B.Tech', 'WBUT', '2006-07-31', '2010-06-30', 'Done B.Tech CSE', '2024-12-06 07:24:07', '2024-12-06 07:24:07'),
(2, 16, 'I.Sc', 'BIEC', '2001-07-31', '2003-06-30', 'XII in Science', '2024-12-06 11:43:10', '2024-12-06 11:43:10'),
(3, 16, 'Matric', 'NBSE', '2000-03-05', '2001-05-30', '', '2024-12-12 09:08:44', '2024-12-12 09:08:44');

-- --------------------------------------------------------

--
-- Table structure for table `employee_skills_tbl`
--

CREATE TABLE `employee_skills_tbl` (
  `id` int(11) NOT NULL,
  `emp_id` int(11) NOT NULL,
  `skill_name` varchar(255) NOT NULL,
  `skill_level` varchar(50) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employee_skills_tbl`
--

INSERT INTO `employee_skills_tbl` (`id`, `emp_id`, `skill_name`, `skill_level`, `created_at`, `updated_at`) VALUES
(1, 16, 'HTML', 'Expert', '2024-12-10 04:54:04', '2024-12-10 04:54:04'),
(2, 16, 'CSS', 'Expert', '2024-12-10 04:54:15', '2024-12-10 04:54:15'),
(3, 16, 'PHP', 'Expert', '2024-12-10 04:54:22', '2024-12-10 04:54:22'),
(4, 16, 'Nodejs', 'Beginner', '2024-12-10 04:54:30', '2024-12-10 04:54:30'),
(5, 16, 'Reactjs', 'Intermediate', '2024-12-10 04:54:42', '2024-12-10 04:54:42'),
(6, 16, 'Python', 'Beginner', '2024-12-10 06:01:43', '2024-12-10 06:01:43');

-- --------------------------------------------------------

--
-- Table structure for table `employer_tbl`
--

CREATE TABLE `employer_tbl` (
  `id` int(10) NOT NULL,
  `name` varchar(200) DEFAULT NULL,
  `country_code` varchar(20) NOT NULL,
  `contact_number` varchar(20) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` text DEFAULT NULL,
  `company_name` varchar(200) DEFAULT NULL,
  `company_logo` varchar(200) NOT NULL,
  `company_description` text DEFAULT NULL,
  `designation` varchar(200) DEFAULT NULL,
  `company_address` text DEFAULT NULL,
  `city` varchar(50) DEFAULT NULL,
  `company_state` varchar(100) DEFAULT NULL,
  `company_country` varchar(100) DEFAULT NULL,
  `company_pincode` varchar(20) DEFAULT NULL,
  `added_date` datetime DEFAULT current_timestamp(),
  `token` varchar(200) DEFAULT NULL,
  `status` enum('pending','active','rejected','') NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employer_tbl`
--

INSERT INTO `employer_tbl` (`id`, `name`, `country_code`, `contact_number`, `email`, `password`, `company_name`, `company_logo`, `company_description`, `designation`, `company_address`, `city`, `company_state`, `company_country`, `company_pincode`, `added_date`, `token`, `status`) VALUES
(1, 'Mohammed Muzzamil Rahman', '', '09179928275', 'asdf0@gmail.com', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', 'kenz', '', '', 'talent acquisition', '', 'New Delhi', 'Delhi', 'India', '110025', '2023-03-29 15:06:29', NULL, 'active'),
(2, 'Mohammed Muzzamil Rahman', '', '09179928275', 'asdf1@gmail.com', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', 'kenz', '', '', 'talent acquisition', '', 'New Delhi', 'Delhi', 'India', '110025', '2023-04-04 15:47:20', NULL, 'active'),
(3, 'Mohammed Muzzamil Rahman', '', '09179928275', 'asdf@gmail.com', '774eb65391488d51f9a0818c192e6c174ec6d5058d8b9ac9d6c2698103a5b6c8', 'kenz', '../uploads/company_logos/logo_673ceba3e5f975.95505939.png', 'Ki Academy', 'talent acquisition', 'Hyderabad', 'New Delhi', 'Delhi', 'India', '110025', '2023-04-27 15:25:29', NULL, 'active'),
(6, 'Amir Ahmed', '', '9179928275', 'easn.aliamir@gmail.com', '774eb65391488d51f9a0818c192e6c174ec6d5058d8b9ac9d6c2698103a5b6c8', 'Intencode India Pvt Ltd', '../uploads/company_logos/logo_673454ea9231b1.53503591.png', 'IT company in Hyderabad', 'Admin', 'Amrutha Arched, Kachiguda', 'Hyderabad', 'Telengana', 'India', '500027', '2024-11-05 08:57:35', NULL, 'active'),
(7, 'Mohammed Abdul Raheem', '', '0507180649', 'abdulraheem@delmon.com.sa', '5c5b5926bc176f4e8e171a172239857519188075a59d7da7b3a6f5fa7df60619', 'Delmon SAP Services', '', 'Delmon SAP Services', 'SAP Sales Manager', 'Delmon SAP Services', 'Riyadh', 'Riyadh', 'Saudi Arabia', '11521', '2024-11-07 03:05:17', NULL, 'active'),
(8, 'Sunil Kumar', '', '7678221005', 'easnamirali@gmail.com', '90a0ed93ccbef0018af0b0659cf4b13590994a225365785f27e14a8eb17cfb53', 'Intencode India Pvt Ltd', '', 'IT Firm', 'Director', 'Kachiguda', 'Hyderabad', 'Telengana', 'India', '500027', '2024-11-07 10:36:39', NULL, 'active'),
(10, 'Farooq', '', '9346067676', 'info@intencode.com', '06704b146061704c5a625bfafe9175ca2091bd107535d4c729a3dadd21ca95c9', 'Intencode India Pvt Ltd', 'uploads/company_logos/logo_673225ab57a313.71260273.png', 'Intencode is an IT company', '', 'Hyderabad', 'Hyderabad', 'Telangana', 'India', '500027', '2024-11-11 21:11:31', 'ef95244f717137eb7f99c046a972b519', 'active'),
(11, 'KENZ Recruiting Team', '', '+917093019099', 'recruitment@kenz-innovations.com', '23faf1cea739ec6224275dfb776e2dd0a87af26d870e892b55738ed0f54a8cf0', 'KENZ Innovations LLC', 'uploads/company_logos/logo_67323eda5a99b9.63142686.png', 'KENZ Started off as an SAP solutions and services provider, KENZ soon expanded its footprint and wings across the globe and started offering end-to-end software services.\r\nUSA, Saudi Arabia, India, Australia, Canada &amp;amp; New Zealand', 'Recruitment Team', '5900 Balcones Drive STE 13688 Austin, TX, 78731 USA', 'Austin', 'Texas', 'USA', '78731', '2024-11-11 22:58:58', 'ddc23bb50cd4ba1b443e316675f85a4d', 'active'),
(12, 'Sabir Ali', '91', '07678221005', 'amirintencode@gmail.com', '5994471abb01112afcc18159f6cc74b4f511b99806da59b3caf5a9c173cacfc5', 'PT GAS', 'uploads/company_logos/logo_67519559bdec09.31171554.png', 'Kuch bhi', 'Sales Manager', 'Jamia Nagar, Saheenbagh\r\nFA 30, 3rd Floor', 'South West Delhi', 'Delhi', 'India', '110025', '2024-12-05 17:28:17', '3b3a7cdaa5e958f2ce7fb65f0fdd3a52', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `emp_tbl`
--

CREATE TABLE `emp_tbl` (
  `id` int(10) NOT NULL,
  `name` varchar(200) DEFAULT NULL,
  `profile_image` varchar(255) NOT NULL,
  `contact_number` varchar(20) DEFAULT NULL,
  `country_code` varchar(20) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` text DEFAULT NULL,
  `work_status` varchar(200) DEFAULT NULL,
  `whatsapp` varchar(50) DEFAULT NULL,
  `resume` text DEFAULT NULL,
  `experience` int(11) DEFAULT NULL,
  `certificate` varchar(255) DEFAULT NULL,
  `project` text DEFAULT NULL,
  `describe_you` text DEFAULT NULL,
  `professional_summary` text DEFAULT NULL,
  `added_date` datetime DEFAULT current_timestamp(),
  `status` enum('pending','active','on hold','') NOT NULL DEFAULT 'pending',
  `token` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `emp_tbl`
--

INSERT INTO `emp_tbl` (`id`, `name`, `profile_image`, `contact_number`, `country_code`, `email`, `password`, `work_status`, `whatsapp`, `resume`, `experience`, `certificate`, `project`, `describe_you`, `professional_summary`, `added_date`, `status`, `token`) VALUES
(1, 'Syed Rizwan', '', '988987474', '64', 'morgan@gmail.com', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', '', 'on', 'uploads/-11680251424.csv', 0, NULL, 'I created one webiste', 'communication-skills , punctual', NULL, '2023-03-31 14:00:05', 'active', ''),
(2, 'Kane Williamson', '', '889874236', '64', 'kane28@gmail.com', '8bb0cf6eb9b17d0f7d22b456f121257dc1254e1f01665370476383ea776df414', 'experienced', 'on', 'uploads/-11681111018.pdf', 0, '0', 'I created one webiste', 'work-under-pressure , team-player , communication-skills , punctual', NULL, '2023-04-10 12:45:33', 'active', ''),
(3, 'Pamba Naresh', '', '8877995522', '213', 'naresh@gmail.com', '8bb0cf6eb9b17d0f7d22b456f121257dc1254e1f01665370476383ea776df414', 'experienced', 'on', NULL, 0, '0', 'I created one webiste', 'Cool dude', NULL, '2023-04-11 16:03:22', 'active', ''),
(4, 'Vicktor Murphy', '', '988987474', '1246', 'murphy@gmail.com', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', 'experienced', 'on', NULL, 0, '0', 'I created one webiste', 'Honest worker', NULL, '2023-04-11 16:06:26', 'active', ''),
(5, 'Brock Lesnar', '', '988987474', '43', 'lesnar@gmail.com', '8bb0cf6eb9b17d0f7d22b456f121257dc1254e1f01665370476383ea776df414', '', 'on', 'uploads/-11681211445.pdf', 0, '0', 'I created one webiste', '', NULL, '2023-04-11 16:08:02', 'active', ''),
(6, 'amer', '', '7987908908', '375', 'admin@kenzinnovations.com', '5994471abb01112afcc18159f6cc74b4f511b99806da59b3caf5a9c173cacfc5', 'experienced', '', NULL, NULL, NULL, NULL, NULL, NULL, '2023-04-18 22:02:19', 'active', ''),
(7, 'khan', '', '7987908908', '91', 'khan123@gmail.com', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', 'experienced', '', 'uploads/-11681994480.xlsx', NULL, NULL, NULL, NULL, NULL, '2023-04-20 20:40:44', 'active', ''),
(8, 'Aman gorva', '', '9358728685', '91', 'amangorva12@gmail.com', 'efc1daf1a20c58216b9a44191f10194afb22053e7bde16ac2d4e69a90637f4f4', '', 'on', 'uploads/-11682594685.pdf', NULL, NULL, NULL, NULL, NULL, '2023-04-27 16:01:21', 'active', ''),
(9, 'Aman Gorva', '', '9166220288', '91', 'amangorva@gmail.com', '69944b92273a67adf0d26ff1c316d7f48cb5b249f1642be0a1de04e8ed5fc469', '', 'on', NULL, NULL, NULL, NULL, NULL, NULL, '2023-05-01 16:40:14', 'active', ''),
(10, 'shah', '', '15541548640', '381', 'shah@gmail.com', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', 'experienced', '', NULL, NULL, NULL, NULL, NULL, NULL, '2023-05-03 16:14:37', 'active', ''),
(11, 'Developer', '', '12345498740', '91', 'deve@oulook.com', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', 'experienced', '', NULL, NULL, NULL, NULL, NULL, NULL, '2023-05-03 16:27:46', 'active', ''),
(12, 'Muzzamil ur rahman Mohammed', '', '9603297470', '91', 'mohammed.muzzamilrahman@gmail.com', 'fffc267aaab4f7fd40cb54cc4b463fa98eac50a5527dbf49085c5f2f9fc5575e', 'experienced', '', NULL, NULL, NULL, NULL, NULL, NULL, '2023-05-05 20:42:55', 'active', ''),
(13, 'Mohammed Abdul Rahman', '', '8317687160', '91', 'rahman298263@gmail.com', 'bdaaefe58ea20898ae51827c9ff532f1503537376b50c4790d18623da31401fe', '', 'on', NULL, NULL, NULL, NULL, NULL, NULL, '2024-10-22 01:13:37', 'active', ''),
(15, 'syed arshad ali shah', '', '7093267456', '91', 'syedarshad_alishah19@yahoo.in', '99392673aa287b3d6911aa4974d236507d237b9d8a135a0aa8a45cf265293cdd', '', '', 'uploads/-11731953166.doc', NULL, NULL, NULL, NULL, NULL, '2024-11-18 23:29:22', 'active', '6f79cb3de97ec496367414b792db25b8'),
(16, 'Sunil Kumar', 'uploads/profile/67596f920c3522.63883279.png', '9179928275', '91', 'amirintencode@gmail.com', '5550eb7b798a66e8bb9e8bc2a3c9eb629ffe6343876fa59b531ad152b7deff5d', 'experienced', 'on', 'uploads/6757c12e116dc0.39673339.pdf', NULL, NULL, NULL, NULL, 'Experienced Software Developer with 5+ Years in Web Application Development\r\n\r\nI am a highly skilled and results-driven software developer with over 5 years of hands-on experience in designing, developing, and deploying scalable web applications. My expertise lies in both front-end and back-end development, utilizing modern technologies and frameworks to build robust solutions that improve user experiences and drive business growth. I have a deep understanding of the entire software development lifecycle, from gathering requirements and designing architecture to coding, testing, and maintaining applications.', '2024-11-19 00:03:48', 'active', 'f7bd945bb3418aebe9452b5c1e1cc14d');

-- --------------------------------------------------------

--
-- Table structure for table `experience_tbl`
--

CREATE TABLE `experience_tbl` (
  `id` int(11) NOT NULL,
  `emp_id` int(11) NOT NULL,
  `job_title` varchar(255) NOT NULL,
  `company_name` varchar(255) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date DEFAULT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `experience_tbl`
--

INSERT INTO `experience_tbl` (`id`, `emp_id`, `job_title`, `company_name`, `start_date`, `end_date`, `description`, `created_at`, `updated_at`) VALUES
(1, 16, 'Technical Lead', 'Intencode India Pvt Ltd', '2023-03-06', NULL, 'Working as Technical Lead', '2024-12-06 07:22:08', '2024-12-06 07:22:08'),
(2, 16, 'full stack developer', 'LoopinTechies Services India Pvt Ltd', '2020-08-18', '2023-02-28', 'Worked as Senior Wen Developer', '2024-12-06 07:22:55', '2024-12-06 07:22:55'),
(3, 16, 'PHP Developer', 'Seven Seaz Vacations Pvt Ltd', '2019-01-16', '2020-07-31', 'Worked as PHP developer and managed portal', '2024-12-06 07:23:34', '2024-12-12 10:11:44');

-- --------------------------------------------------------

--
-- Table structure for table `job_applications`
--

CREATE TABLE `job_applications` (
  `id` int(11) NOT NULL,
  `jobid` int(11) NOT NULL,
  `applied_id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `countryCode` varchar(10) DEFAULT NULL,
  `state` varchar(100) DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `experience` varchar(20) DEFAULT NULL,
  `current_emp` varchar(255) DEFAULT NULL,
  `current_sal` decimal(10,2) DEFAULT NULL,
  `apply_position` varchar(255) DEFAULT NULL,
  `job_city` varchar(100) DEFAULT NULL,
  `notice_period` varchar(50) DEFAULT NULL,
  `certifications` text DEFAULT NULL,
  `skills` text DEFAULT NULL,
  `projects` text DEFAULT NULL,
  `previous_experience` text DEFAULT NULL,
  `education` text DEFAULT NULL,
  `resume_file` varchar(255) DEFAULT NULL,
  `apply_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `profile_image` varchar(200) NOT NULL,
  `status` enum('in process','on hold','selected','rejected') NOT NULL DEFAULT 'in process'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `job_applications`
--

INSERT INTO `job_applications` (`id`, `jobid`, `applied_id`, `email`, `name`, `phone`, `countryCode`, `state`, `city`, `dob`, `experience`, `current_emp`, `current_sal`, `apply_position`, `job_city`, `notice_period`, `certifications`, `skills`, `projects`, `previous_experience`, `education`, `resume_file`, `apply_date`, `profile_image`, `status`) VALUES
(1, 9, 14, 'amirintencode@gmail.com', 'Amir Ahmed', '09179928275', '91', 'UP', 'Antu', '1985-02-05', '6', 'Intencode India Pvt Ltd', 65000.00, 'Senior Service Advisor (Body ', 'JUBAIL - KSA', 'One Month', '[[\"JavaScript\",\"fsdfdgd\"],[\"fdgfgdf\",\"fsdfdgd gfdfgdg\"],[\"gfdgdfgfd\",\"fsdfdgd gfdgdfgdf\"]]', '[[\"PHP\",\"Intermediate\"],[\"javascript\",\"Advanced\"]]', '[[\"Inventory Management System\",\"dfgdfgfd\"],[\"LMS\",\"dfgdfgfd fdgdf\"]]', '[[\"Loopintechies\",\"Senior Developer\",\"dfgdfgdf\"],[\"Loopintechies sdsdfhd\",\"Senior Developer\",\"dfgdfgdf\"]]', '[[\"MSIT\",\"B.Tech\",\"2010\"],[\"MSIT fgdggd\",\"ISC\",\"2003\"]]', 'uploads/resumes/resume_6736f124e69fe9.48645031.pdf', '2024-11-15 06:58:44', 'uploads/profile/profile_6736f124e6e560.68571988.jpg', 'in process'),
(2, 144, 15, 'syedarshad_alishah19@yahoo.in', 'syed arshad ali shah', '7093267456', '91', 'TG', 'Hyderabad', '1991-07-19', '10+', 'Kenz', 100000.00, 'Full Stack Developer', 'HYDERABAD - INDIA', 'One Week', '[[\"manager\",\"recruiter\"]]', '[[\"sales\",\"Advanced\"]]', '[[\"kenz\",\"sales\"]]', '[[\"bluewave\",\"manager\",\"recruiter\"]]', '[[\"bacholrs\",\"b.com\",\"2014\"]]', 'uploads/resumes/resume_673b83b9374dd7.54686141.doc', '2024-11-18 18:13:13', 'uploads/profile/profile_673b83b9376b80.32797203.PNG', 'in process'),
(3, 146, 15, 'syedarshad_alishah19@yahoo.in', 'syed arshad ali shah', '7093267456', '91', 'TG', 'Hyderabad', '1991-07-19', '10+', 'Kenz', 100000.00, 'Cloverleaf Interface Technical Consultant - Â  (137008)', 'HYDERABAD - INDIA', 'One Week', '[[\"manager\",\"sales\"]]', '[[\"sales\",\"Advanced\"]]', '[[\"kenz\",\"sales\"]]', '[[\"bluewave\",\"manager\",\"sales\"]]', '[[\"bacholrs\",\"b.com\",\"2014\"]]', 'uploads/resumes/resume_673b84b49ce524.85564667.doc', '2024-11-18 18:17:24', 'uploads/profile/profile_673b84b49cfce9.12065327.PNG', 'in process');

-- --------------------------------------------------------

--
-- Table structure for table `locations`
--

CREATE TABLE `locations` (
  `sno` int(200) NOT NULL,
  `name` varchar(400) DEFAULT NULL,
  `parent` varchar(200) DEFAULT NULL,
  `status` varchar(200) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `locations`
--

INSERT INTO `locations` (`sno`, `name`, `parent`, `status`) VALUES
(24, 'RIYADH - KSA', NULL, NULL),
(25, 'KARACHI - PAKISTAN', NULL, NULL),
(26, 'Off-Shore', NULL, NULL),
(27, 'DAMMAM - KSA', NULL, NULL),
(28, 'AL KHOBAR - KSA', NULL, NULL),
(29, 'JUBAIL - KSA', NULL, NULL),
(30, 'JEDDAH - KSA', NULL, NULL),
(31, 'HYDERABAD - INDIA', NULL, NULL),
(32, 'NEOM - KSA', NULL, NULL),
(33, 'Yanbu - KSA', NULL, NULL),
(35, 'Dubai - UAE', NULL, NULL),
(36, 'Bangladesh &amp; Egypt', NULL, NULL),
(41, 'USA', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `plans`
--

CREATE TABLE `plans` (
  `id` int(11) NOT NULL,
  `plan_name` varchar(100) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `duration` int(11) NOT NULL COMMENT 'Duration in days',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `plans`
--

INSERT INTO `plans` (`id`, `plan_name`, `price`, `duration`, `created_at`) VALUES
(1, 'Beginner', 29.00, 30, '2024-12-18 10:05:55'),
(2, 'Enterprise', 99.00, 150, '2024-12-18 10:06:52');

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE `post` (
  `sno` int(200) NOT NULL,
  `employer_id` int(11) NOT NULL,
  `job_title` varchar(500) DEFAULT NULL,
  `job_description` varchar(1000) DEFAULT NULL,
  `exper_min` varchar(200) DEFAULT NULL,
  `exper_max` varchar(200) DEFAULT NULL,
  `salary_min` varchar(200) DEFAULT NULL,
  `salary_max` varchar(200) DEFAULT NULL,
  `location` varchar(200) DEFAULT NULL,
  `role` varchar(200) DEFAULT NULL,
  `openings` varchar(200) DEFAULT NULL,
  `industry_type` varchar(200) DEFAULT NULL,
  `function_area` varchar(200) DEFAULT NULL,
  `emp_type` varchar(200) DEFAULT NULL,
  `role_category` varchar(200) DEFAULT NULL,
  `education` varchar(200) DEFAULT NULL,
  `skills` varchar(200) DEFAULT NULL,
  `post_date` varchar(200) DEFAULT NULL,
  `post_time` varchar(200) DEFAULT NULL,
  `status` enum('active','inactive','on hold','') DEFAULT 'active',
  `seq` int(10) DEFAULT NULL,
  `client_id` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`sno`, `employer_id`, `job_title`, `job_description`, `exper_min`, `exper_max`, `salary_min`, `salary_max`, `location`, `role`, `openings`, `industry_type`, `function_area`, `emp_type`, `role_category`, `education`, `skills`, `post_date`, `post_time`, `status`, `seq`, `client_id`, `created_at`) VALUES
(144, 6, 'Full Stack Developer', 'This is a position for php full stack developer', '3 Years', '5 Years', '50000', '80000', 'Egypt & KSA, Bangladesh & Egypt, Dubai - UAE', 'Developer', '3', 'IT', 'Development', 'Part Time', 'Full stack developer', 'B.Tech, MCA', 'PHP, JavaScript, CodeIgniter', '2024/11/05', '06:06:56 PM', 'active', NULL, NULL, '2024-12-16 05:45:48'),
(10, 0, 'Service Advisor (Mechanical)', 'You will be responsible to handle & manage service customers at the dealership; execute the service operations cycle (reception till delivery) and ensure customer satisfaction for services provided including complaints resolution.\n\nTo apply, you should be DAE / B.Tech / Graduate with 1 â€“ 2 years of relevant experience in a reputable OEM dealership.', '1 Year', '2 Years', '', '', 'All', 'Advisor', '', 'Automotive', 'Services', 'Fulltime', '', 'DAE / B.Tech / Graduate ', 'Relevant experience in a reputable OEM dealership.', '21/10/17', '11:19:30 AM', 'active', NULL, NULL, '2024-12-16 05:45:48'),
(9, 3, 'Senior Service Advisor (Body & Paint)', 'You will act as a liaison between customers and the service technicians for all paint and body repairs. You will determine the problems, perform inspections, communicate repair timelines to customer and provide technicians with accurate repair descriptions about the customersâ€™ concerns. You will execute the service operations cycle (reception till delivery), will manage end-to-end insurance claims process and ensure customer satisfaction.\n\nTo apply, you should be a DAE / B.Tech and possess 3 â€“ 5 years of technical expertise, mainly in body & paint area, working at a reputable OEM dealership. Technical plus Service Advisor certifications from a reputable OEM are highly preferred.', '0', '0', '', '', 'Egypt & KSA, Bangladesh & Egypt, Dubai - UAE, DAMMAM - KSA, Off-Shore, KARACHI - PAKISTAN, RIYADH - KSA', 'Project Manager', '5', 'Automotive', 'Services', 'Fulltime', '', 'DAE / B.Tech ', 'Technical expert, mainly in body & paint area, working at a reputable OEM dealership. Technical plus Service Advisor certifications from a reputable OEM are highly preferred.', '21/10/17', '11:16:26 AM', 'active', NULL, NULL, '2024-12-16 05:45:48'),
(7, 0, 'Service Manager', 'As a Service Manager, you are the person that our customers look to when they need help with their vehicle. You will manage the dealership service operations including but not limited to customer handling, workshop productivity, resource utilization, business enhancement & close liaison with OEM on various matters. You will responsible for taking customer through the entire repair process, keeping them informed on the status of their vehicle and ensuring their satisfaction before they leave our facility.\n\nTo apply, you should be B.Tech / B.E (post graduate business degree would be a plus) and possess 6 â€“ 8 years of relevant experience in a reputable OEM dealership.', '6 Years', '8 Years', '', '', 'All', 'Manager', '', 'Automotive', 'Services', 'Fulltime', '', 'B.Tech / B.E (post graduate business degree would be a plus)', 'Relevant experience in a reputable OEM dealership.', '21/10/17', '11:07:28 AM', 'active', NULL, NULL, '2024-12-16 05:45:48'),
(8, 0, 'Senior Service Advisor (Mechanical)', 'You will act as a liaison between customers and the service technicians for all mechanical repairs. You will determine the problems, perform inspections, communicate repair timelines to customer and provide technicians with accurate repair descriptions about the customersâ€™ concerns. You will execute the service operations cycle (reception till delivery), ensure post-repair vehicle safety and customer satisfaction.\n\nTo apply, you should be a DAE / B.Tech / Graduate with 3 â€“ 5 years of relevant experience in a reputable OEM dealership. Service advisor certifications from OEM is a plus.', '3 Years', '5 Years', '', '', 'All', 'Senior Service Advisor', '', 'Automotive', 'Services', 'Fulltime', '', 'DAE / B.Tech / Graduate ', 'Relevant experience in a reputable OEM dealership. Service advisor certifications from OEM is a plus.', '21/10/17', '11:11:30 AM', 'active', NULL, NULL, '2024-12-16 05:45:48'),
(6, 3, 'Parts Manager', 'You will manage the spare parts operations at your dealership; maintaining parts inventory; ordering as per sales growth and using DMS system while promoting sales of appropriate parts and accessories by accurately identifying the customerâ€™s needs and promoting the benefits of using genuine OEM parts. Understanding of partsâ€™ technical specifications and warehousing is a must.\n\nTo apply, you should be a B.Tech. / B.Com with 3-5 yearsâ€™ experience in auto parts industry. Working command of Accounting is a plus.', '0', '0', '', '', 'Egypt & KSA, Bangladesh & Egypt, Dubai - UAE, Yanbu - KSA, NEOM - KSA, HYDERABAD - INDIA, JEDDAH - KSA, JUBAIL - KSA, AL KHOBAR - KSA, DAMMAM - KSA, Off-Shore, KARACHI - PAKISTAN, RIYADH - KSA', 'Functional Analyst', '1', 'Automotive', 'Parts', 'Fulltime', '', 'B.Tech. / B.Com', 'Experience in auto parts industry. Working command of Accounting is a plus.', '21/10/17', '10:56:04 AM', 'active', NULL, NULL, '2024-12-16 05:45:48'),
(1, 0, 'Customer Relationship Manager', 'This job is for you if you have passion on delivering, at all times, an excellent customer experience across all customer touch points while bonding long-term business relationships with all of our customers. You will manage and implement Changanâ€™s CXM strategies and programs within your dealership, in both physical and digital domains. You will help set direction, drive change and innovation, inspire and coordinate cross functional teams to deliver an outstanding customer experience across every interaction.\n\nTo apply, you should be a Bachelorâ€™s / Masterâ€™s with 6-8 years of relevant experience in a corporate environment. Must possess excellent communication & customer management skills, hands-on CRM activities, able to set and track KPIs based on customersâ€™ qualitative feedback and complaints. Females are encouraged to apply.', '6 Years', '8 Years', '', '', 'All', 'Manager', '', 'Automotive', 'Customer Services', 'Fulltime', '', 'Bachelorâ€™s or Higher', 'Must possess excellent communication & customer management skills, hands-on CRM activities, able to set and track KPIs based on customersâ€™ qualitative feedback and complaints', '21/10/17', '10:53:17 AM', 'active', NULL, NULL, '2024-12-16 05:45:48'),
(3, 0, 'Floor Sales Manager', 'You\'ll help close sales on the dealership floor, maximizing delightful customer experience on every visit. Management of standard vehicle display, POS and proper staffing at all times will be your concerns.\n\nTo apply, you should be a Master\'s, preferably MBA with 4-6 years of automotive experience in managing floor sales, demonstrated passion for people management, understanding of sales best practices and customer retention strategies.', '4 Years', '6 Years', '', '', 'All', 'Sales Manager', '', 'Automotive', 'Floor', 'Fulltime', '', 'Master Degree preferably MBA', 'automotive experience in managing floor sales, demonstrated passion for people management, understanding of sales best practices and customer retention strategies.', '21/10/17', '10:47:34 AM', 'active', NULL, NULL, '2024-12-16 05:45:48'),
(2, 0, 'General Manager Sales', 'You will lead the sales team and function at the dealership; be responsible to set effective strategies resulting in achieving sales targets, empower, motivate and train your sales team to sell. Youâ€™ll manage sales at the dealership floor, to corporate customers and manage relationships with banks, government bodies, financial institutions and business entities. Youâ€™ll be expected to maintain a competitive edge by reviewing customer needs, market potential and areas of opportunity.\n\nIf you have deep understanding of customer needs combined with deep product knowledge supported by excellent communication, then you are our ideal candidate. Preferably, you should also be an MBA, with 10+ years of automotive sales experience; energetic, a self-starter possessing a strong demonstrated sale performance and business acumen.', '9 Years', '10 Years', '', '', 'All', 'General Manager', '', 'Automotive', 'Sales', 'Fulltime', '', 'MBA', 'Automotive sales experience; energetic, a self-starter possessing a strong demonstrated sale performance and business acumen.', '21/10/17', '02:13:26 PM', 'active', NULL, NULL, '2024-12-16 05:45:48'),
(24, 1, 'SAP BW', 'Overall 16+ years of experience which includes onsite and offshore\r\nexperience in providing SAP BW/4 HANA, HANA Modeling, S4 HANA\r\nanalytics using ABAP CDS Views, BW/BI and BODS.\r\nWorked on various projects like end to end implementation of SAP\r\nBW/4 HANA, S/4 HANA Analytic reporting, Implementation of SAP BW\r\n7.0 and 7.3 projects, Technical and Functional Upgrade from BW 3.x to\r\n7.0/7.3 ,BW/BI/BO Application maintenance and support projects and\r\nSAP BODS Data integration projects.', '0', '0', '25000', '35000', 'USA, Bangladesh & Egypt, Dubai - UAE', 'SAP BW Consultant', '1', 'Automotive', 'SAP Consulting', 'Part Time', 'Project Manager', 'MBA', 'SAP CERTIFICATE', '21/12/30', '01:38:25 AM', 'active', NULL, 0, '2024-12-16 05:45:48'),
(34, 0, 'SAP BPC Consultant', 'Duties & Responsibilities\nYou will be required to perform the following:\nâ€¢	Manage day to day support in BPC (Business Planning and Consolidations) area\nâ€¢	Configuration of Legal Consolidation and Management Consolidation in SAP BPC as per SOCPA/ IFRS standards\nâ€¢	Support ongoing project activities, enhancements and solve production incidents.\nâ€¢	Create and maintain dimensions, models, logic scripts, business process flows, business rules, member formulas, Input forms, Reports and other components of BPC\nâ€¢	Provide support for month-end, Quarter-end, Year-end activities\nâ€¢	Reporting and Risk Management\nâ€¢	Review and/or participate in solution build and test activities on BPC implementations, rollouts, or upgrade projects.\nâ€¢	Design functional solutions to solve business problems and needs, complete quality technical design specifications.\nâ€¢	Ensure successful completion of all deliverables: specifications, walkthroughs, product development, unit integration and regression test', '0', '0', '', '', 'Array', 'SENIOR SAP CONSULTANT', '2', 'Automotive', 'Financial Planning & Consolidation', 'Fulltime', '', 'Masters & Degree', 'Knowledge of BPC, Excel, and BPC Web UI', '22/04/22', '03:07:43 AM', 'active', NULL, NULL, '2024-12-16 05:45:48'),
(25, 0, 'JD Edwards Consultant', 'As an Application Developer, you will lead IBM into the future by translating system requirements into the design and development of customized systems in an agile environment. The success of IBM is in your hands as you transform vital business needs into code and drive innovation. Your work will power IBM and its clients globally, collaborating and integrating code into enterprise systems. You will have access to the latest education, tools and technology, and a limitless career path with the world s technology leader. Come to IBM and make a global impact!\n\nYour Role and Responsibilities\nAs Application Developer JD Edwards you will perform design and development in JDE Integrations with multiple application and involving Webmethods as middleware.\nResponsibilities\nâ€¢	Defining, analysing and reviewing technical Expertise in JDE Modules\nâ€¢	Ability to drive workshops, obtain requirements & perform gap analysis, create design, prepare & execute testing & data conversion,\nâ€¢	conduct key ', '6 Years', '8 Years', '', '', 'Array', '', '', 'Automotive', '', 'Full Time', 'JD Edward Consultant', '', '', '22/02/21', '09:55:36 PM', 'active', NULL, NULL, '2024-12-16 05:45:48'),
(26, 0, 'Java Developer', 'Roles and Responsibilities\nFamiliar in high performance, scalable J2EE implementations on Linux/Unix platforms with one or more of the following: Java Web Services, JSP, Spring MVC and IOC, Hibernate, Ant, JMS, XML, JBoss, Tomcat.\nJD:A Java developer is responsible for many duties throughout the development lifecycle of applications, from concept and design right through to testing.\nJava, Spring 5,Spring Position: Core Java.\nAbility to work with the team in the design and development aspects for the product following lean/ agile methodologies.\nMandatory : Spring MVC, Servlet, JSP, HTML5, CSS, JQuery, JavaScript and AJAX -Work in development team to build / enhance the next generation contact center solutions\n- 5 years of development and design experience in Software Development.\nGeneral Java programming Java swing programming Java, servlets \n', '5 Years', '8 Years', '', '', 'Array', '', '', '', '', 'Full Time', 'Developer', '', '', '22/03/15', '03:24:06 PM', 'active', NULL, NULL, '2024-12-16 05:45:48'),
(27, 0, 'Project Manager ', 'You are a strong project manager with extensive experience managing projects and shaping solutions in ambiguous environments.\nYou are highly motivated, results-oriented and user-focused with a proven record of successfully handling multiple projects in fast-paced environments.\nYou have comprehensive knowledge of product development and design processes - including how to manage design roadmaps, milestones and delivery\nYou manage multiple priorities and deadlines with context switching between projects without missing a beat.\nYou are a keen relationship builder at all levels of the organization, across many different technical, business, operational, design and other roles to bring the right groups into alignment in order to drive successful outcomes.\nYou are a self-starter with passion and expertise for leveraging available resources to establish standards and processes that support cross-functional teams and continuously seek improvement.\n10 years experience Program Management in Desi', '9 Years', '0', '', '', 'Array', '', '', '', '', 'Full Time', 'Manager', '', '', '22/03/15', '03:25:29 PM', 'active', NULL, NULL, '2024-12-16 05:45:48'),
(28, 0, 'SAP FICO', 'The qualifications listed below are representative of the minimum knowledge, skill, and/or ability required.\nSKILLS AND ABILITIES\nMust possess good communication skills, problem solving techniques, converting Business requirement to technical solution.\nâ€¢	Implementation of SAP add on technologies\nâ€¢	General Ledger - GL Master data, Foreign currency valuation, FSVs\nâ€¢	Accounts Payable - Vendor Master data, Automatic payment program, Advance Payments, Reports\nâ€¢	Banking - House banks, Manual bank statements, Electronic bank statements, Lockbox, ACH WIRE payments, Cleared checks.\nâ€¢	Accounts Receivable - Customer Master data, Advance payments, Dunning, Lock box and reports.\nâ€¢	Asset Accounting - Asset procurement, Asset sale, Asset retirement, Asset Scrap, Asset shootdown, Revaluation, Yearend activities.\nâ€¢	New General Ledger Accounting\nâ€¢	Should have knowledge on yearend activities.\nâ€¢	Enhancement and user-exits in areas of functional expertise\nâ€¢	Financial accounting and Cont', '6 Years', '0', '', '', 'Array', '', '', '', '', 'Full Time', 'Consultant', '', '', '22/03/15', '03:26:37 PM', 'active', NULL, NULL, '2024-12-16 05:45:48'),
(29, 0, 'Oracle fusion HCM', 'â€¢	Bachelors Degree in IT or equivalent\nâ€¢	Over all 5-7 years of experience in a similar environment\nâ€¢	Should have 2 years of exposure experience in Core HR, Talent Acquisition and Talent Management and OTBI or 1 year of exposure experience in Core HR, Absence Management, Payroll and BI Reports\nâ€¢	Should have worked in at least 1 implementation having exposure to the above HCM modules\nâ€¢	Hands on experience in fast formulas and developing reports and dashboards\nâ€¢	Should have strong knowledge in HCM Extracts/OTBI/BI Reports\nâ€¢	Experience in project lifecycle from documenting requirements to troubleshooting & support for the mentioned HCM modules\n', '5 Years', '8 Years', '', '', 'Array', '', '', '', '', 'Full Time', 'Consultant', '', '', '22/03/15', '03:27:26 PM', 'active', NULL, NULL, '2024-12-16 05:45:48'),
(31, 0, 'Android Developer', 'Roles and Responsibilities\n\n\nFamiliar with Android Studio & React Native\nWell Experienced with JAVA\nWriting clean and efficient codes for Android applications.\nMonitoring the performance of live apps and work on optimizing them at the code level.\nIdentifying and resolving bottlenecks, rectifying bugs and enhancing application performance.\nIntegrate with our back-end services to make sure we deliver great mobile apps for end users.\nCollaborating with cross-functional teams to define and design new features.\nStaying up to date with new mobile technology trends, applications, and protocols.\nCollaborate with designers.\n\nRequirements and qualifications\n\n\nExcellent skills in Android Developer using Kotlin, Java, Android SDK, Android NDK.\nExperience in design patterns mobile architecture using frameworks such as MVVM/MVC/MVP.\nFamiliarity with Restful APIs to effectively integrate Android applications.\nProficient understanding of code versioning tools such as Git.\nFamiliarity with various test', '5 Years', '0', '', '', 'Array', '', '', '', '', 'Full Time', 'Developer', '', '', '22/03/15', '03:42:22 PM', 'active', NULL, NULL, '2024-12-16 05:45:48'),
(32, 0, 'Web Developer', 'Builds, designs, and maintains all websites and software applications.\nRegulates exposure to business stakeholders and executive management as well as other authorities.\nDesigns, writes, and edits website content.\nUnderstands UI, cross-browser compatibility, and general web functions and standards.\nCreates solutions for identified problems or bugs.\nCommunicates with colleagues, managers, and stakeholders daily.\nExecutes assignments with the use of web applications, scripts, and programming languages such as HTML, CSS, JavaScript, and APIs.\nDevelops and validates test routines to ensure the quality of the external and internal interface.\nPlans and delivers software platforms and products across multiple organizational units.\nDesigns assignments with web services like REST, SOAP, etc.\nEvaluates written code to ensure it meets industry standards and is compatible with all devices.\nMaintains a professional understanding of web development by tracking trends and participating in study group', '5 Years', '0', '', '', 'Array', '', '', '', '', 'Full Time', 'Developer', '', '', '22/03/15', '10:42:44 PM', 'active', NULL, NULL, '2024-12-16 05:45:48'),
(35, 0, 'ERP SAP Treasury Consultant', 'Duties & Responsibilities\nYou will be required to perform the following:\nâ€¢	Manage Day to day support in SAP core Treasury & Risk Management module\nâ€¢	Money Market and Loans\nâ€¢	Foreign Exchange\nâ€¢	Interest Rate Swap\nâ€¢	Debt Management\nâ€¢	Limit Management\nâ€¢	Reporting and Risk Management\nâ€¢	Manage Day to Day support for B2B interface\nâ€¢	Supplier Payments\nâ€¢	SADAD Payments\nâ€¢	Payroll Payments\nâ€¢	Treasury Payments\nâ€¢	Bank to Bank Transfers\nâ€¢	Participate in SAP solution implementation projects (business requirements reviews, system configuration, test documentation and execution\nâ€¢	Work on internal Enhancement and internal projects and deliver end-to-end solutions.\nâ€¢	Expertise in cash and liquidity Management.', '5 Years', '7 Years', '', '', 'Array', 'ERP SAP Consultant', '2', 'Utility', 'ERP Consultant', 'Full Time', 'SENIOR SAP CONSULTANT', 'Masters & Degree', 'Experience in SAP CHARM- SOLMAN', '22/04/24', '03:48:50 PM', 'active', NULL, NULL, '2024-12-16 05:45:48'),
(36, 0, 'ERP SAP HCM Payroll/Time Consultant', 'Duties & Responsibilities\nYou will be required to perform the following:\nâ€¢	Manage Day to day support in SAP core Payroll & Time Management\nâ€¢	Payroll processing function & off-cycle payroll\nâ€¢	Configuration of payroll payments & deductions\nâ€¢	Design/Enhance Payroll Schema\nâ€¢	Configure payroll feature & writing PCR\nâ€¢	Absence/Attendances configuration\nâ€¢	Enhance and manage time evaluation\nâ€¢	Absence/Attendance valuation\nâ€¢	Work schedule and work schedule valuation\nâ€¢	HR/FI integration for payroll postings\nâ€¢	Participate in SAP solution implementation projects (business requirements reviews, system configuration, test documentation and execution\nâ€¢	Work on internal Enhancement and internal projects and deliver end-to-end solutions.', '5 Years', '7 Years', '', '', 'Array', 'SAP Payroll Consultant', '2', 'Utility', 'Payroll Management', 'Full Time', 'SENIOR SAP CONSULTANT', 'Masters & Degree', 'Experience in SAP CHARM- SOLMAN', '22/04/24', '04:01:00 PM', 'active', NULL, NULL, '2024-12-16 05:45:48'),
(37, 0, 'ERP SAP HCM Payroll/Time Consultant', 'Duties & Responsibilities\nYou will be required to perform the following:\nâ€¢	Manage Day to day support in SAP core Payroll & Time Management\nâ€¢	Payroll processing function & off-cycle payroll\nâ€¢	Configuration of payroll payments & deductions\nâ€¢	Design/Enhance Payroll Schema\nâ€¢	Configure payroll feature & writing PCR\nâ€¢	Absence/Attendances configuration\nâ€¢	Enhance and manage time evaluation\nâ€¢	Absence/Attendance valuation\nâ€¢	Work schedule and work schedule valuation\nâ€¢	HR/FI integration for payroll postings\nâ€¢	Participate in SAP solution implementation projects (business requirements reviews, system configuration, test documentation and execution\nâ€¢	Work on internal Enhancement and internal projects and deliver end-to-end solutions.', '5 Years', '7 Years', '', '', 'Array', 'SAP Payroll Consultant', '2', 'Utility', 'Payroll Management', 'Full Time', 'SENIOR SAP CONSULTANT', 'Masters & Degree', 'Experience in SAP CHARM- SOLMAN', '22/04/24', '04:03:47 PM', 'active', NULL, NULL, '2024-12-16 05:45:48'),
(38, 0, 'SAP FICO & Funds Management Consultant', 'Duties & Responsibilities\nYou will be required to perform the following:\nâ€¢	Manage day to day support in FICO & funds Management area\nâ€¢	Facilitate the support & Enhancement in GL, AR, AP, Asset Accounting area.\nâ€¢	Facilitate the support & Enhancement in Taxation (VAT & Withholding tax) area.\nâ€¢	Facilitate the support & Enhancement in Funds Management area.\nâ€¢	Manage support & Enhancement CO: Cost Centre Accounting, Internal Order Accounting, WBS, Profit center and COPA\nâ€¢	Management FI interfaces with SAP/Non-SAP systems\nâ€¢	Experience in Month end closing and Year closing process\nâ€¢	Manage Validation & Substitutions\nâ€¢	Manage Integration of FI with MM, PM, PS and HR modules\nâ€¢	Understand customer needs and quantify appropriate actions\nâ€¢	Design and deliver high quality solutions through system configuration that meet overall business requirements.\nâ€¢	Write Functional Specification / Configuration documents\n\nâ€¢	Participate in SAP solution implementation projects (business ', '6 Years', '8 Years', '', '', 'Array', 'SAP FICO Consultant', '2', 'Utility', 'Financial Planning & Consolidation', 'Full Time', 'SENIOR SAP CONSULTANT', 'Masters & Degree', 'Expertise in GL, AR, AP, Asset Accounting.', '22/04/24', '04:08:40 PM', 'active', NULL, NULL, '2024-12-16 05:45:48'),
(39, 0, 'ERP SAP Project System Consultant', 'Duties & Responsibilities\nCandidate will be required to perform the following:\n1. SAP PS/IM/PPM\nCore responsibility:\nA SAP Consultant must have all required Project System & investment management functional and Configuration knowledge in SAP ECC system.\nThe Consultant should have relevant experience in the following areas âˆ’\nDevelop & implement the new business requirements building solution via, engaging with SAP/Business/Third Parties for evaluating new requirement/solutions/features. Mainly in the area of PS & IM (Project System and Investment Management) Module.\nâ€¢	Good configuration knowledge of PS structures: WBS, Network, Milestones, Cost Planning, Budgeting, Material Requirement planning, Project quotation, Time sheets, Goods issues, and other project management activities in SAP PS. Also, Investment management IM Structures, IM planning, IM budgeting, Appropriation request\nâ€¢	Must have completed at least three end-to-end implementations.\nâ€¢	Experience on complete PS module', '7 Years', '10 Years', '', '', 'Array', 'ERP SAP Project System Consultant', '2', 'Utility', 'ERP Project System', 'Full Time', 'SENIOR SAP CONSULTANT', 'Masters & Degree', 'Extended knowledge and experience on RICEF, Familiarity with SAP Charm and Solution Manager', '22/04/24', '04:16:55 PM', 'active', NULL, NULL, '2024-12-16 05:45:48'),
(40, 0, 'ERP SAP Success Factors Consultant PMGM configuration experience.', 'Duties & Responsibilities\nCandidate will be required to perform the following:\nThe job requires relevant skills in the following SuccessFactors modules related to:\nâ€¢	SAP SuccessFactors Performance Management & Goal Management (PMGM)\nCore responsibility:\nSupport the SAP SuccessFactors PMGM and establish credibility with business and team members, ensuring buy-in of proposed solutions with the business team.\nPerform various analysis pertaining to PMGM system and project status to the higher management in terms of system usage, support handling and projects engagement.\nKey responsibilities:\nAbility to demonstrate system capability and provide solutions to the member firm queries pertinent to system functionality to resolve their performance technology requirements.\nAssist PMGM global implementation projects and co-ordinate with the member firms for smooth implementation.\nConduct System Training Workshops and help business to get onboard with the tool and guide them from the system persp', '5 Years', '7 Years', '', '', 'Array', 'SENIOR SAP CONSULTANT', '2', 'Automotive', 'ERP Success Factors Consultant', 'Fulltime', '', 'Masters & Degree', 'Experienced in SAP HCM, Strong knowledge & skill in XML coding.', '22/04/24', '04:27:19 PM', 'active', NULL, NULL, '2024-12-16 05:45:48'),
(41, 0, 'ERP SAP Success Factors Consultant RCM/RMK configuration experience.', 'Duties & Responsibilities\nCandidate will be required to perform the following:\nThe job requires relevant skills in the following SuccessFactors modules related to:\nâ€¢	SAP SuccessFactors Performance Management & Goal Management (PMGM)\nCore responsibility:\nSupport the SAP SuccessFactors PMGM and establish credibility with business and team members, ensuring buy-in of proposed solutions with the business team.\nPerform various analysis pertaining to PMGM system and project status to the higher management in terms of system usage, support handling and projects engagement.\nKey responsibilities:\nAbility to demonstrate system capability and provide solutions to the member firm queries pertinent to system functionality to resolve their performance technology requirements.\nAssist PMGM global implementation projects and co-ordinate with the member firms for smooth implementation.\nConduct System Training Workshops and help business to get onboard with the tool and guide them from the system persp', '5 Years', '7 Years', '', '', 'Array', 'ERP SAP Success Factors Consultant', '2', 'Utility', 'ERP Success Factors Consultant', 'Full Time', 'SENIOR SAP CONSULTANT', 'Masters & Degree', 'SAP SuccessFactors Strategic Workforce Planning certification.', '22/04/24', '07:48:06 PM', 'active', NULL, NULL, '2024-12-16 05:45:48'),
(50, 0, 'Oracle HCM EBM', 'Qualified candidates must have a BS or BA degree in Business, Technology, or equivalent degree or experience in HCM\r\n6 to 8 years of experience in Oracle HCM EBM\r\n1 to 2 years of experience in implementing or supporting Oracle HCM EBM, specifically Global HR, Workforce Management and Workforce Rewards\r\nPreferred experience with supporting/managing HR functions such as Benefits, Talent, Payroll or HR Generalist\r\nAbility to quickly understand HR concepts and apply to technology\r\nExcellent analytical and problem solving skills\r\nStrong written and verbal communication skills\r\nProven ability to work remotely and independently in support of clients\r\nDeveloping an understanding of a clients current state process and developing future state recommendations based on Oracles best business practices\r\nRecommending roadmaps to close performance gaps and developing high level implementation plans\r\nGathering and analyzing business requirements\r\nAligning business requirements and best practices to imp', '6 Years', '8 Years', '', '', 'Yanbu - KSA', 'Oracle HCM EBM', '2', 'Utility', 'Oracle HCM', 'Full Time', 'Oracle HCM Developer', 'BS or BA degree in Business, Technology, or equivalent degree or experience in HCM', '', '22/05/20', '05:33:18 PM', 'active', NULL, NULL, '2024-12-16 05:45:48'),
(51, 0, 'SAP MM - Senior Analyst', 'Requirement Duration - 5 to 6 Months\nCore Responsibilities\nSAP Application support to deliver the completion of SAP Service Requests\nwithin the expected SLAs, KPIs and within budget constrains (if any)\nmeeting expectations of KENZ key users and business process owners.\nWork with project internal & external stakeholders to ensure successful\nSAP IT service request delivery.\nShould have managed projects as well as SAP support assignments for\nminimum 10 years & should have exposure to Change Management.\nStrong coordination and cross team collaboration skills.\nThe area of responsibility includes master data structures, transactional\ndata, implemented functions and components, user roles and\nauthorizations, and applicable interfaces.\nThe following Key knowledge areas in the area of SAP MM have to be\ncovered:\nOrganizational Structure Elements Incl. Account Assignment\nConfiguration.\nVendor Master Data Structure & Processes & Configuration.\nMaterial Master Data Structure & Pro.', '10 Years', '0', '', 'AED 20k', 'Dubai - UAE', 'Senior Analyst', '2', 'Automotive', 'SAP Analyst', 'Fulltime', '', 'B.Sc.- Information Technology or equivalent, or higher. Very good knowledge of procurement management processes, financial and controlling management processes. SAP Certification in the core functiona', 'SAP Materials Management â€“ Expert. PKENZple Management â€“ Advanced. Business Process Modelling - Advanced. SAP ABAP Program Design Skills â€“ Advanced.', '22/07/21', '10:13:24 PM', 'active', NULL, NULL, '2024-12-16 05:45:48'),
(52, 0, 'SAP PS - Senior Analyst', 'Requirement Duration - 5 to 6 Months\nThe following Key knowledge areas in the area of SAP PS have to be covered: \nCreate Templates/WBS.\nCreate Project.\nProject Planning & Project / cost estimation (e.g. easy cost planning). \nBudgeting and Release.\nProject Implementation.\nProject Completion.\nBuilding PS report via report painter or builder. \nIntegration into another modules FI/CO, MM, SD, PP, P', '10 Years', '0', '', 'AED 20k', 'Dubai - UAE', 'Senior Analyst', '2', 'Automotive', 'SAP Analyst', 'Fulltime', '', 'B.Sc.- Information Technology or equivalent, or higher, and. Major in Operations Management, or equivalent. SAP Certification in the core functional module (PM or other).', 'General awareness of process and application integration options. Advanced adherence to formal testing techniques/methodology, consistently  delivering quality work product/deliverables. Adherence to ', '22/07/21', '10:26:12 PM', 'active', NULL, NULL, '2024-12-16 05:45:48'),
(114, 0, 'software intern', 'developing', '0', '1 Year', '10000', '15000', 'Dubai - UAE', 'intern', '1', 'type 1', 'area 1', 'Full Time', 'Data Scientist', 'BE', '', '23/03/13', '12:10:22 PM', 'inactive', NULL, NULL, '2024-12-16 05:45:48'),
(53, 0, 'SAP Development (ABAP / Fiori) - Senior Analyst', 'Requirement Duration - 5 to 6 Months\nJob responsibilities:\nSupport existing SAP Fiori applications and Develop state of the art,\nenterprise-class mobile solutions in SAP Fiori UX, Mobile app development\nplatforms that meet the business requirements and are supportable.\nApplication Security and Systems Integration.\nDeveloping Proof of Concepts.\nPerforms other job duties as assigned.\nDevelop UI5 components on SAP BTP (Cloud).\nCustom BTP framework development Using UI5.\nCustom Website / Portal development.\nDevelop SAP UI5/Fiori Application on SAP Cloud Platform.\nGood understanding of the standard services / libraries of the SAP Cloud\nPlatform.\nDevelopment using SAP Business Application studio.\nPrepares technical designs document and unit testing.', '10 Years', '0', '', 'AED 20k', 'Dubai - UAE', 'Senior Analyst', '2', 'Automotive', 'SAP Analyst', 'Fulltime', '', 'B.Sc.- Information Technology or equivalent, or higher.', 'Strong application development in SAP Fiori Components, Fiori Launchpad  (BTP), Fiori Gateway Services, SAP UI5, SAP Web IDE, Fiori Design patterns,  UI Theme designer, JavaScript, CSS, HTML5 and jQue', '22/07/21', '10:40:33 PM', 'inactive', NULL, NULL, '2024-12-16 05:45:48'),
(54, 0, 'SAP FI/CO - Senior Analyst', 'Requirement Duration - 5 to 6 Months\nThe following Key knowledge areas in the area of SAP FI/CO have to be\ncovered:\nGeneral Ledger Accounting process and configuration.\nAccounts Payable Accounting process and configuration.\nAccounts Receivable process and configuration.\nCheque Management process and configuration.\nPetty Cash Management process and configuration.\nBank Accounting & BRS process and configuration.\nAsset Accounting process and configuration.\nCost Center Accounting process and configuration.\nProfit Center Account process and configuration.\nManagement Reporting process and configuration.\nProcess Integration and configuration Knowledge in the area of MM, PS,\nPM, ETM and HCM.\nProject Cash Flow Management / Cash Flow Management.\nBank â€“ Electronic Transfer.\nProfit Center Accounting.\nLiquidity Management.', '10 Years', '0', '', 'AED 20k', 'Dubai - UAE', 'Senior Analyst', '2', 'Automotive', 'SAP Analyst', 'Fulltime', '', 'B.Sc.- Information Technology or equivalent, or higher.  Very good knowledge of financial management processes, controlling  management processes as well as project system and investment  management p', ' Very Good Experience and Working knowledge of configuration for specific  processes in SAP FI/CO. Good Experience in ABAP table content in regards to the SAP FI/CO', '22/07/22', '12:59:11 AM', 'inactive', NULL, NULL, '2024-12-16 05:45:48'),
(55, 0, 'SAP ETM - Senior Analyst ', 'Requirement Duration - 5 to 6 Months\nThe following Key knowledge areas in the area of SAP ETM have to be \ncovered: \nETM Master Data Process (Fleet & Recipient) and configuration.\nETM request, planning port and shipping document process and \nconfiguration.\nBPE â€“ based performance equipment.\nSD orders, settlement process and billing document process and \nconfiguration. \nIntegration process knowledge to FI/CO, PS, ETM and PM as well as \nconfiguration. \nKnowledge about the procurement process in SAP MM', '10 Years', '0', '', 'AED 20k', 'Dubai - UAE', 'Senior Analyst', '2', 'Automotive', 'SAP Analyst', 'Fulltime', '', 'B.Sc.- Information Technology or equivalent, or higher, and. Major in Operations Management, or equivalent. SAP Certification in the core functional module', 'Plant Maintenance Processes â€“ Expert. Facilities Management Processes - Expert. Document Management Systems Processes â€“ Advanced PKENZple Management â€“ Advanced. Communication and Presentation Sk', '22/07/22', '07:49:42 AM', 'inactive', NULL, NULL, '2024-12-16 05:45:48'),
(56, 0, 'SAP PM - Senior Analyst', 'Requirement Duration - 5 to 6 Months\nThe following Key knowledge areas in the area of SAP PM have to be \ncovered: \nPM Master Data Process and configuration.\nReactive Maintenance Process & Configuration. \nPreventative Maintenance Process & Configuration.\nCorrective Maintenance Process & Configuration.\nTimesheet for Work order Process & Configuration.\nMaterial planning for work order process & Configuration.\nIntegration process knowledge to FI/CO, HCM, MM and PS and \nconfiguration. ', '10 Years', '0', '', 'AED 20k', 'Dubai - UAE', 'Senior Analyst', '2', 'Automotive', 'SAP Analyst', 'Fulltime', '', 'B.Sc.- Information Technology or equivalent, or higher, and. Major in Operations Management, or equivalent. SAP Certification in the core functional module PM.', 'Plant Maintenance Processes â€“ Expert. Facilities Management Processes - Expert. Document Management Systems Processes â€“ Advanced. PKENZple Management â€“ Advanced. Communication and Presentation S', '22/07/22', '07:54:10 AM', 'inactive', NULL, NULL, '2024-12-16 05:45:48'),
(57, 0, 'SAP DMS - Senior Analyst', 'Requirement Duration - 5 to 6 Months\nDMS management process and configuration (Document Type \nConfiguration).\nWorkflow concept & process.\nWork with project internal & external stakeholders to ensure successful \nSAP IT service request delivery.\nShould have managed projects as well as SAP support assignments for \nminimum 10 years & should have exposure to Change Management. \nStrong coordination and cross team collaboration skill.', '10 Years', '0', '', 'AED 20k', 'Dubai - UAE', 'Senior Analyst', '2', 'Automotive', 'SAP Analyst', 'Fulltime', '', 'B.Sc.- Information Technology or equivalent, or higher, and. Major in Operations Management, or equivalent. SAP Certification in the core functional module', 'Plant Maintenance Processes â€“ Expert. Facilities Management Processes - Expert. Document Management Systems Processes â€“ Advanced. PKENZple Management â€“ Advanced. Communication and Presentation S', '22/07/22', '08:06:05 AM', 'inactive', NULL, NULL, '2024-12-16 05:45:48'),
(84, 0, 'Information Technology Technical Writer', 'Management and creation of required business and system documents in adherence to appropriate standards during business or technical writing processes and projects under the guidance of the project team members. These documents could include procedures, user manuals, system operation, and recovery instructions, project proposals, newsletters, presentations, and system design documents. Editing, standardizing, or making changes to material prepared by other writers or establishment personnel.', '3 Years', '0', '', '', 'RIYADH - KSA', 'IT Technical Writer', '2', 'Oil & Gas Refineries', 'Technical Writer', 'Full Time', 'IT Technical Writer ', 'Bachelorâ€™s degree in any related discipline.  ', '', '22/11/17', '11:37:03 AM', 'inactive', NULL, NULL, '2024-12-16 05:45:48'),
(67, 0, 'Application Developer I', 'Analyzing functional business applications and design specifications. Developing block diagrams, logic flow charts, Testing, debugging, and refining the computer software.', '6 Years', '0', '', '', 'RIYADH - KSA', 'Application Developer I', '2', 'Oil & Gas Refineries', 'Application Development', 'Full Time', 'Application Developer', 'B.Tech, Bsc or any other Relevant Degree', '', '22/11/16', '01:27:07 PM', 'inactive', NULL, NULL, '2024-12-16 05:45:48'),
(68, 0, 'Application Developer II', ' Analyzing functional business applications and design specifications. Developing block diagrams, logic flow charts, Testing, debugging, and refining the computer software.', '5 Years', '0', '', '', 'RIYADH - KSA', 'Application Developer II', '2', 'Oil & Gas Refineries', 'Application Development', 'Full Time', 'Application Developer', 'B.Tech, Bsc or any other Relevant Degree', '', '22/11/16', '01:30:11 PM', 'inactive', NULL, NULL, '2024-12-16 05:45:48'),
(69, 0, 'Application Developer III', 'Analyzing functional business applications and design specifications. Developing block diagrams, logic flow charts, Testing, debugging, and refining the computer software.', '4 Years', '0', '', '', 'RIYADH - KSA', 'Application Developer III', '2', 'Oil & Gas Refineries', 'Application Development', 'Full Time', 'Application Developer', 'B.Tech, Bsc or any other Relevant Degree', '', '22/11/16', '03:01:10 PM', 'inactive', NULL, NULL, '2024-12-16 05:45:48'),
(70, 0, 'Applications Developer IV (Saudi Nationals Only)', 'Analyzing functional business applications and design specifications. Developing block diagrams, logic flow charts, Testing, debugging, and refining the computer software.', '2 Years', '0', '', '', 'RIYADH - KSA', 'Application Developer IV', '2', 'Oil & Gas Refineries', 'Application Development', 'Full Time', 'Application Developer', 'B.Tech, Bsc or any other Relevant Degree', '', '22/11/16', '03:03:25 PM', 'inactive', NULL, NULL, '2024-12-16 05:45:48'),
(71, 0, 'Applications Developer V', 'Saudi Fresh Graduates Only. Analyzing functional business applications and design specifications. Developing block diagrams, logic flow charts, Testing, debugging, and refining the computer software.', '0', '0', '', '', 'RIYADH - KSA', 'Application Developer V', '2', 'Oil & Gas Refineries', 'Application Development', 'Full Time', 'Application Developer', 'B.Tech, Bsc or any other Relevant Degree', '', '22/11/17', '09:57:08 AM', 'inactive', NULL, NULL, '2024-12-16 05:45:48'),
(72, 0, 'Functional Analyst I', 'Defining problems, developing system requirements, programming specifications, from which programmers prepare detailed flow charts, programs, modeling and tests. Coordinating closely with programmers to ensure proper implementation of program and system specifications. ', '6 Years', '0', '', '', 'RIYADH - KSA', 'Functional Analyst I', '2', 'Oil & Gas Refineries', 'Functional Activites', 'Full Time', 'Functional Analyst', 'B.Tech, Bsc or any other Relevant Degree', '', '22/11/17', '10:01:53 AM', 'inactive', NULL, NULL, '2024-12-16 05:45:48'),
(73, 0, 'Functional Analyst II', 'Defining problems, developing system requirements, programming specifications, from which programmers prepare detailed flow charts, programs, modeling and tests. Coordinating closely with programmers to ensure proper implementation of program and system specifications.', '5 Years', '0', '', '', 'RIYADH - KSA', 'Functional Analyst II', '2', 'Oil & Gas Refineries', 'Functional Activites', 'Full Time', 'Functional Analyst', 'B.Tech, Bsc or any other Relevant Degree', '', '22/11/17', '10:11:32 AM', 'inactive', NULL, NULL, '2024-12-16 05:45:48'),
(74, 0, 'Functional Analyst III', 'Defining problems, developing system requirements, programming specifications, from which programmers prepare detailed flow charts, programs, modeling and tests. Coordinating closely with programmers to ensure proper implementation of program and system specifications.', '4 Years', '0', '', '', 'RIYADH - KSA', 'Functional Analyst III', '2', 'Oil & Gas Refineries', 'Functional Activities', 'Full Time', 'Functional Analyst', 'B.Tech, Bsc, Bcs or any other Relevant Degree', '', '22/11/17', '10:15:20 AM', 'inactive', NULL, NULL, '2024-12-16 05:45:48'),
(75, 0, 'Functional Analyst IV (Saudi Nationals)', 'Must Be Saudi National. Defining problems, developing system requirements, programming specifications, from which programmers prepare detailed flow charts, programs, modeling and tests. Coordinating closely with programmers to ensure proper implementation of program and system specifications.', '0', '0', '', '', 'RIYADH - KSA', 'Functional Analyst IV', '2', 'Oil & Gas Refineries', 'Functional Activities', 'Full Time', 'Functional Analyst', 'B.Tech, Bsc, Bcs or any other Relevant Degree', '', '22/11/17', '10:18:18 AM', 'inactive', NULL, NULL, '2024-12-16 05:45:48'),
(76, 0, 'Information Technology Consultant ', 'Developing analytical and computational techniques and methodology for problem solutions.  Performing enterprise-wide strategic systems planning, business information planning, and analysis. Performing process and data modeling in support of the planning and analysis efforts using both manual and automated tools.', '10 Years', '0', '', '', 'RIYADH - KSA', 'Information Technology Consultant', '2', 'Oil & Gas Refineries', 'Information Technology', 'Full Time', 'Consultant', 'B.Tech, Bsc, Bcs or any other Relevant Degree', '', '22/11/17', '10:25:15 AM', 'inactive', NULL, NULL, '2024-12-16 05:45:48'),
(77, 0, 'Senior Project Manager', 'Working as a program director or project advisor providing project vision, strategic consulting, and program management for all types. Developing and maintain the master implementation plan and set project standards. Ensuring on time delivery of agreed deliverables with good quality. Project tracking using checklist. Managing resources allocation and utilization. Plan and Managing change control.', '10 Years', '0', '', '', 'RIYADH - KSA', 'Senior Project Management ', '2', 'Oil & Gas Refineries', 'Project Management', 'Full Time', 'Project Manager', 'B.Tech, Bsc, Bcs or any other Relevant Degree', '', '22/11/17', '10:29:52 AM', 'inactive', NULL, NULL, '2024-12-16 05:45:48'),
(78, 0, 'Project Manager ', 'Developing and maintain the master implementation plan and set project standards. Ensuring on time delivery of agreed deliverables with good quality. Project tracking using checklist. Managing resources allocation and utilization. Plan and Managing change control.', '6 Years', '0', '', '', 'RIYADH - KSA', 'Project Manager', '2', 'Oil & Gas Refineries', 'Project Management', 'Full Time', 'Project Manager', 'B.Tech, Bsc, Bcs or any other Relevant Degree', '', '22/11/17', '10:41:42 AM', 'inactive', NULL, NULL, '2024-12-16 05:45:48'),
(79, 0, 'Integration Architecture Consultant I', 'Identifying various solution options including SAP and non-SAP software solutions, architecture design, development, implementation, change management and maintenance of a major business process automation solution. Executing project lifecycle as per Quality Management Systems guidelines.', '10 Years', '0', '', '', '', 'Integration Architecture Consultant', '2', 'Oil & Gas Refineries', 'Integration & Architecture ', 'Full Time', 'Consultant', 'B.Tech, Bsc, Bcs or any other Relevant Degree', '', '22/11/17', '10:54:00 AM', 'inactive', NULL, NULL, '2024-12-16 05:45:48'),
(80, 0, 'Integration & Architecture Consultant II', 'Identifying various solution options including SAP and non-SAP software solutions, architecture design, development, implementation, change management and maintenance of a major business process automation solution. Executing project lifecycle as per Quality Management Systems guidelines.', '6 Years', '0', '', '', 'RIYADH - KSA', 'Integration & Architecture Consultant', '2', 'Oil & Gas Refineries', 'Integration & Architecture ', 'Full Time', 'Consultant', 'B.Tech, Bsc, Bcs or any other Relevant Degree', '', '22/11/17', '10:57:47 AM', 'inactive', NULL, NULL, '2024-12-16 05:45:48'),
(81, 0, 'Integration & Architecture Consultant III', 'Identifying various solution options including SAP and non-SAP software solutions, architecture design, development, implementation, change management and maintenance of a major business process automation solution. Executing Project Lifecycle as per S-SDLC guidelines.', '4 Years', '0', '', '', 'RIYADH - KSA', 'Integration & Architecture Consultant', '2', 'Oil & Gas Refineries', 'Integration & Architecture ', 'Full Time', 'Consultant', 'B.Tech, Bsc, Bcs or any other Relevant Degree', '', '22/11/17', '11:01:12 AM', 'inactive', NULL, NULL, '2024-12-16 05:45:48'),
(82, 0, 'Change Management Consultant', 'Leading transition activities in support of IT integration and implementation efforts and adopt associated organization processes. Executing and improving the change strategy including transition management, communications, training, and role design. Extending the use of the practice to IT efforts outside of development through education and coaching.', '3 Years', '0', '', '', 'RIYADH - KSA', 'Change Management Consultant', '2', 'Oil & Gas Refineries', 'Change Management', 'Full Time', 'Consultant', 'B.Tech, Bsc, Bcs or any other Relevant Degree', '', '22/11/17', '11:06:26 AM', 'inactive', NULL, NULL, '2024-12-16 05:45:48'),
(83, 0, 'Training Development and Delivery ', 'Developing training needs analysis for project team and impacted organization users. Developing training materials (e-Learning, classroom and Audio and Video) as per customer standards. Developing instructional materials for the delivery of training. Coordinating and schedule reviews of the training materials.', '3 Years', '0', '', '', 'RIYADH - KSA', 'Training Development and Delivery ', '2', 'Oil & Gas Refineries', 'Training Development & Delivery ', 'Full Time', 'Training Development & Delivery ', 'Bachelorâ€™s degree in any related discipline.  ', '', '22/11/17', '11:20:56 AM', 'inactive', NULL, NULL, '2024-12-16 05:45:48'),
(85, 0, 'Information Technology Technical Writer', 'Management and creation of required business and system documents in adherence to appropriate standards during business or technical writing processes and projects under the guidance of the project team members. These documents could include procedures, user manuals, system operation, and recovery instructions, project proposals, newsletters, presentations, and system design documents. ', '3 Years', '0', '', '', 'RIYADH - KSA', 'IT Technical Writer', '2', 'Oil & Gas Refineries', 'Technical Writer', 'Full Time', 'IT Technical Writer ', 'Bachelorâ€™s degree in any related discipline.  ', '', '22/11/17', '11:39:23 AM', 'inactive', NULL, NULL, '2024-12-16 05:45:48'),
(86, 0, 'UX Designer', 'User research (user interview, server analytics, testing of existing product, identification of pain points). Sketching and wireframing of the new design covering user flow, screen layout, functionality. High-fidelity user interface (UI) design; usability testing of paper and digital prototypes.', '3 Years', '0', '', '', 'RIYADH - KSA', 'UX Designer', '2', 'Oil & Gas Refineries', 'UX Design', 'Full Time', 'UX Designer', 'Bachelorâ€™s degree in any related discipline.  ', '', '22/11/17', '11:42:48 AM', 'inactive', NULL, NULL, '2024-12-16 05:45:48');
INSERT INTO `post` (`sno`, `employer_id`, `job_title`, `job_description`, `exper_min`, `exper_max`, `salary_min`, `salary_max`, `location`, `role`, `openings`, `industry_type`, `function_area`, `emp_type`, `role_category`, `education`, `skills`, `post_date`, `post_time`, `status`, `seq`, `client_id`, `created_at`) VALUES
(87, 0, 'UI Designer', 'Create, improve and use wireframes, prototypes, style guides, user flows, and effectively communicate your interaction ideas using any of these methods. Build storyboards to conceptualize designs and convey project plans to clients and management. Improve the look and feel of interactive web and mobile applications.', '3 Years', '0', '', '', 'RIYADH - KSA', 'UI Designer', '2', 'Oil & Gas Refineries', 'UI Design ', 'Full Time', 'UI Designer', 'Bachelorâ€™s degree in any related discipline.  ', '', '22/11/17', '11:44:57 AM', 'inactive', NULL, NULL, '2024-12-16 05:45:48'),
(88, 0, 'Robotic Process Automation (RPA) Developer ', 'Understand the business process requirements and design. Expert on leading RPA tools such as UiPath and Blue Prism. Configuring new automation with efficient and easily understandable automation tools. Build, design, develop, test and implement RPA systems. Scripting and coding in RPA tool to resolve automation issues.', '4 Years', '0', '', '', 'RIYADH - KSA', 'Robotic Process Automation (RPA) Developer ', '2', 'Oil & Gas Refineries', 'Robotic Process Automation ', 'Full Time', 'Developer', 'B.Tech, Bsc, Bcs or any other Relevant Degree', '', '22/11/17', '11:49:09 AM', 'inactive', NULL, NULL, '2024-12-16 05:45:48'),
(89, 0, 'Robotic Process Automation (RPA) Business Analyst', 'Understand the business process requirements and design. Expert on leading RPA tools such as UiPath and Blue Prism.	Configuring new automation with efficient and easily understandable automation tools. Build, design, develop, test and implement RPA systems. Scripting and coding in RPA tool to resolve automation issues.', '4 Years', '0', '', '', 'RIYADH - KSA', 'Robotic Process Automation (RPA) Business Analyst', '2', 'Oil & Gas Refineries', 'Robotic Process Automation ', 'Full Time', 'Business Analyst ', 'B.Tech, Bsc, Bcs or any other Relevant Degree', '', '22/11/17', '11:51:20 AM', 'inactive', NULL, NULL, '2024-12-16 05:45:48'),
(90, 0, 'Chatbot Consultant / Developer', 'Understand the business requirements and design Build, design, develop, test and implement Chatbot use cases. ensure quality of coded components by performing end to end unit testing. Preparing the required documentation, including both program-level and user-level documentation.', '3 Years', '0', '', '', 'RIYADH - KSA', 'Chatbot Consultant / Developer', '2', 'Oil & Gas Refineries', 'Chatbot Consultant / Developer', 'Full Time', 'Chatbot Consultant / Developer', 'B.Tech, Bsc, Bcs or any other Relevant Degree', '', '22/11/17', '11:53:33 AM', 'inactive', NULL, NULL, '2024-12-16 05:45:48'),
(91, 0, 'Content Management Specialist/Developer', 'Design and develop custom modules to support various business processes in ECM/WCM systems. Review and map incoming requests to business objectives. Work closely with content and design teams to optimize visual experience. Perform quality review for the developed solution and provide feedback.', '4 Years', '0', '', '', 'RIYADH - KSA', 'Content Management Specialist/Developer', '2', 'Oil & Gas Refineries', 'Content Management ', 'Full Time', 'Content Management Specialist/Developer', 'B.Tech, Bsc, Bcs or any other Relevant Degree', '', '22/11/17', '11:56:05 AM', 'inactive', NULL, NULL, '2024-12-16 05:45:48'),
(92, 0, 'Content Capture Consultant/Developer', 'Serve as an Architect and provide technical support. Expertise in distributed installation and configuration of Kofax/Abbyy, setting up central/remote servers, workstations, scan stations, scan profiles, creating batch classes, release scripts. Develop end-to-end image capturing solution.', '4 Years', '0', '', '', 'RIYADH - KSA', 'Content Capture Consultant/Developer', '2', 'Oil & Gas Refineries', 'Content Capture ', 'Full Time', 'Content Capture Consultant/Developer', 'B.Tech, Bsc, Bcs or any other Relevant Degree', '', '22/11/17', '11:58:54 AM', 'inactive', NULL, NULL, '2024-12-16 05:45:48'),
(93, 0, 'Blockchain Consultant/ Developer', 'Understand the business requirements and design. Build, design, develop, test and implement Blockchain use cases. ensure quality of coded components by performing end to end unit testing. Preparing the required documentation, including both program-level and user-level documentation.', '2 Years', '3 Years', '', '', 'RIYADH - KSA', 'Blockchain Consultant/ Developer', '2', 'Oil & Gas Refineries', 'Blockchain', 'Full Time', 'Blockchain Consultant/ Developer', 'B.Tech, Bsc, Bcs or any other Relevant Degree', '', '22/11/17', '12:01:38 PM', 'inactive', NULL, NULL, '2024-12-16 05:45:48'),
(94, 0, 'Data Scientist', 'Carry out all the required data pre-processing activities for the data that will be used to implement the analytical models including, but not limited to, missing-value imputation, feature engineering, and outlier removal. Perform all the activities necessary for developing the analytical models, such as using Machine Learning, Natural Language Processing, Computer Vision, and Mathematical Optimization.', '5 Years', '0', '', '', 'RIYADH - KSA', 'Data Scientist', '2', 'Oil & Gas Refineries', 'Data Science ', 'Full Time', 'Data Scientist', 'Master of Science degree in Computer Science or an equivalent field', '', '22/11/17', '12:04:53 PM', 'inactive', NULL, NULL, '2024-12-16 05:45:48'),
(95, 0, 'SAP FI Consultant', 'Work closely with technical staff and outside resources to determine technical solutions and applications to meet the defined requirements in our S/4 Finance implementation. Work with the Finance team to implement BPC for best practices in planning and forecasting. Must be able to manage and prioritize multiple work packages. Maintaining current SAP system, including Incident Management, priority setting and follow up of issues. Creating blueprints and detailed designs for new or enhanced solutions. Translating key business processes in operational applications', '5 Years', '0', '', '', 'RIYADH - KSA', 'SAP FI Consultant', '2', 'Telecom', 'SAP Finance Functional Area', 'Contractual', 'Consultant', 'Bachlors degree in any related field', '', '23/02/09', '10:18:05 AM', 'inactive', NULL, NULL, '2024-12-16 05:45:48'),
(96, 0, 'SAP HCM Consultant', 'Excellent understanding of business processes in HCM and experience in Personnel Administration, Organizational Management, Time and Payroll modules. Excellent proficiency in problem solving, root cause analysis, gap analysis, configuration, customization, integration testing, system testing and go live support', '5 Years', '0', '', '', 'RIYADH - KSA', 'SAP HCM Consultant', '2', 'Telecom', 'Human Resource', 'Contractual', 'Consultant', 'B.Tech, Bsc, Bcs or any other Relevant Degree', '', '23/02/09', '01:48:47 PM', 'inactive', NULL, NULL, '2024-12-16 05:45:48'),
(97, 0, 'SAP CRM Consultant', 'Demand/Delivery Management. Become and grow into an IT / Process Champ in the area of sales, service and marketing processes based on the SAP CRM standard software. Execute the delivery demands through application customization and configuration.', '5 Years', '0', '', '', 'RIYADH - KSA', 'SAP CRM Consultant', '2', 'Telecom', 'Customer Relationship Management', 'Contractual', 'Consultant', 'B.Tech, Bsc, Bcs or any other Relevant Degree', '', '23/02/09', '01:57:05 PM', 'inactive', NULL, NULL, '2024-12-16 05:45:48'),
(98, 0, 'SAP PS Consultant', 'Create Project.\r\nProject Planning & Project / cost estimation (e.g. easy cost planning). \r\nBudgeting and Release.\r\nProject Implementation.\r\nProject Completion.\r\nBuilding PS report via report painter or builder. \r\nIntegration into another modules FI/CO, MM, SD, PP', '5 Years', '0', '', '', 'RIYADH - KSA', 'SAP PS Consultant', '2', 'Telecom', 'Project Management', 'Contractual', 'Consultant', 'B.Tech, Bsc, Bcs or any other Relevant Degree', '', '23/02/09', '02:24:39 PM', 'inactive', NULL, NULL, '2024-12-16 05:45:48'),
(99, 0, 'SAP Procurement Consultant', 'Purchasing related applications (such as SAP SRM, SAP SLC, SAP MM, etc.) you will be part of a Global Solution team.', '5 Years', '0', '', '', 'RIYADH - KSA', 'SAP Procurement Consultant', '2', 'Telecom', 'Procurement', 'Contractual', 'Consultant', 'B.Tech, Bsc, Bcs or any other Relevant Degree', '', '23/02/09', '02:35:02 PM', 'inactive', NULL, NULL, '2024-12-16 05:45:48'),
(100, 0, 'SA SD Consultant', 'Design, configuration and testing of SD, EWM, MM, processes in health care and shared services industry especially. Implementation of SAP SD technologies on projects in the EMEA region', '5 Years', '0', '', '', 'RIYADH - KSA', 'SAP SD Consultant', '2', 'Telecom', 'Sales and Distribution', 'Contractual', 'Consultant', 'B.Tech, Bsc, Bcs or any other Relevant Degree', '', '23/02/09', '02:37:33 PM', 'inactive', NULL, NULL, '2024-12-16 05:45:48'),
(101, 0, 'SAP HANA Consultant', 'Contribute to design of data models and data structures\r\nParticipate to all the project phases (Functional Specification, Technical Design, Development, Testing, Cutover and Hyper Care). Analyse performance bottlenecks (SQL Plans) and provide optimization techniques', '5 Years', '0', '', '', 'RIYADH - KSA', 'SAP HANA Consultant', '2', 'Telecom', 'High Performance Analytics Appliance', 'Contractual', 'Consultant', 'B.Tech, Bsc, Bcs or any other Relevant Degree', '', '23/02/09', '04:37:51 PM', 'inactive', NULL, NULL, '2024-12-16 05:45:48'),
(102, 0, 'Supply Chain Consultant', 'Lead analysis, design and transformation of Supply Chain Management processes. Distribution Network strategy. Stock inventory planning', '0', '0', '', '', 'Bangladesh & Egypt', 'Supply Chain Consultant', '2', 'Information Technology', 'Supply Chain', 'Contractual', '', 'B.Tech, Bsc, Bcs or any other Relevant Degree', '', '23/02/09', '04:41:43 PM', 'inactive', NULL, NULL, '2024-12-16 05:45:48'),
(103, 0, 'SAP MMConsultant', 'Should understand SAP and should know IM module. Should have high-level knowledge of the EWM module. Should have good communication (Written, Oral, and Presentation)', '5 Years', '0', '', '', 'RIYADH - KSA', 'SAP MM Consultant', '2', 'Telecom', 'Inventory Management', 'Contractual', 'Consultant', 'B.Tech, Bsc, Bcs or any other Relevant Degree', '', '23/02/09', '04:45:34 PM', 'inactive', NULL, NULL, '2024-12-16 05:45:48'),
(104, 0, '.NET backend developer', 'Required a .NET backend developer with good understanding of MVC framework', '4 Years', '0', '45000', '75000', 'Dubai - UAE', 'Software Developer', '2', 'Software', 'Development', 'Full Time', '.NET Developer', 'B.Tech', '', '23/02/13', '05:43:26 PM', 'inactive', NULL, NULL, '2024-12-16 05:45:48'),
(124, 0, 'Python developer', 'full stack python developer', '1 Year', '3 Years', '20000', '30000', 'HYDERABAD - INDIA', 'developer', '1', 'technology', 'software', 'Full Time', 'Python Developer', 'B.tech', '', '23/03/13', '04:40:26 PM', 'inactive', NULL, NULL, '2024-12-16 05:45:48'),
(126, 0, 'SAP Hybris E- Commerce SR. Consultant ', 'Must have 8-12+ Years of total work experience.\n- Strong experience in Hybris eCommerce platform.\n- Expert in Hybris foundational concepts, data modelling with Hybris and integrations.\n- Excellent knowledge in Hybris core concepts and commerce concepts, development of extensions and add-ons.', '4 Years', '10 Years', '', '', 'Off-Shore', 'SENIOR SAP CONSULTANT', '2', 'Automotive', ' SAP Hybris E-commerce Consultant', 'Fulltime', '', 'Bachelor and Master Degree in  Computer Science', 'Completed at least two Hybris implementations, knows the Hybris architecture and product roadmap, technical capabilities and challenges, and know Hybris implementation, support and maintenance practic', '23/03/14', '04:47:00 PM', 'inactive', NULL, NULL, '2024-12-16 05:45:48'),
(129, 0, 'SAP SOLMON Consultant', 'Minimum 5 years of experience in SAP SOLMON\nS/4 HANA Conversion / Migration is Needed.\nShould have experience in Configuring and Supporting Solution Manager 7.2 on functionalities like ChaRM, ITSM, Solution Documentation, Test Management, ERMS etc.\n', '0', '0', '', '', 'HYDERABAD - INDIA', 'Consultant', '4', 'Information Technology', 'SAP Solmon', 'Fulltime', '', 'Bachelors or Masters (Computer Science, IT, Finance, Technical, Any Specialization)', 'Charm, ITSM, ERMS Test management', '23/11/25', '11:13:02 PM', 'active', NULL, NULL, '2024-12-16 05:45:48'),
(130, 0, 'OS Administrator ', 'Minimum 4 years of experience in OS\r\nS/4 HANA Conversion / Migration is Needed\r\nPerform various audits on DNS, webservers, CMDB, inventory, Other Linux system administrative activities will be included pursuant to the candidateâ€™s skill set\r\nMaintain user accounts for enterprise systems including SAP, Email, and Active directory\r\n', '4 Years', '10 Years', '', '', 'HYDERABAD - INDIA', 'OS Administrator', '5', 'Information Technology', 'OS Administrator', 'Full Time', 'Consultant', 'B.E./ B. Tech (Computer Science, Information Science, Electronics and Communication) MCA/M. Tech (Computer Science)', '', '23/11/28', '08:58:27 PM', 'active', NULL, NULL, '2024-12-16 05:45:48'),
(131, 0, 'Project Manager', 'Minimum 4 years of experience in project management\r\nS/4 HANA Conversion / Migration Needed\r\nCoordinate internal resources and third parties/vendors for the flawless execution of projects.\r\nEnsure that all projects are delivered on-time, within scope and within budget.', '4 Years', '7 Years', '', '', 'HYDERABAD - INDIA', 'Project Manager', '4', 'Information Technology', 'Project Manager', 'Full Time', 'Project Manager', 'Bachelors or Masters (Computer Science, Engineering, Technical, IT)', '', '23/11/28', '09:02:22 PM', 'active', NULL, NULL, '2024-12-16 05:45:48'),
(132, 0, 'SAP ABAP + FIORI Consultant', 'Minimum 8 years of experience in ABAP\r\nS/4 HANA Conversion / Migration is needed.\r\nPrepare and deliver demonstrations/presentations in support of new requirements.\r\nCreate detailed design, architecture and process artifacts and implement the deployment plan.', '8 Years', '10 Years', '', '', 'HYDERABAD - INDIA', 'SAP ABAP + FIORI', '4', 'Information Technology', 'SAP', 'Full Time', 'Consultant', 'Bachelors or Masters (Computer Science, Engineering, Technical, IT)', '', '23/11/28', '09:05:29 PM', 'active', NULL, NULL, '2024-12-16 05:45:48'),
(133, 0, 'SAP Basis Consultant', 'Minimum 6 years of experience in BASIS', '6 Years', '10 Years', '', '', 'HYDERABAD - INDIA', 'SAP BASIS', '4', 'Information Technology', 'SAP', 'Full Time', 'Consultant', 'Bachelors or Masters (Computer Science, Engineering, Technical, IT)', '', '23/11/28', '09:08:30 PM', 'active', NULL, NULL, '2024-12-16 05:45:48'),
(134, 0, 'SAP Security Consultant', 'Minimum 5 years of experience in SAP Security\r\nS/4 HANA Conversion / Migration is needed.\r\nAdminister SAP GRC (Governance Risk & Compliance) Access Controls 10.0 including Access.\r\nAnalyse & understand current role and access restrictions from audit perspective and synchronize with existing SAP GRC access control to provide risk-free environment.', '5 Years', '10 Years', '', '', 'HYDERABAD - INDIA', 'SAP Security', '4', 'Information Technology', 'SAP', 'Full Time', 'Consultant', 'Bachelors or Masters (Computer Science, Engineering, Technical, IT)', '', '23/11/28', '09:36:18 PM', 'active', NULL, NULL, '2024-12-16 05:45:48'),
(135, 0, 'SAP QM Consultant', 'Minimum 5 years of experience in QM\r\nS/4 HANA Conversion / Migration is Needed.\r\nPrepare and deliver demonstrations/presentations in support of new requirements.', '5 Years', '10 Years', '', '', 'HYDERABAD - INDIA', 'SAP QM', '4', 'Information Technology', 'SAP', 'Full Time', 'Consultant', 'Bachelors or Masters (Computer Science, Engineering, IT, STEM Degree)', '', '23/11/28', '09:39:04 PM', 'active', NULL, NULL, '2024-12-16 05:45:48'),
(136, 0, 'SAP PP Consultant', 'Minimum 5 years of experience in MM\r\nS/4 HANA Conversion / Migration is Needed.\r\nDevelop and support SAP functionality in the business, primarily in FI/CO and PP\r\nProvide 1st and 2nd level SAP support for the local IT team.', '5 Years', '10 Years', '', '', 'HYDERABAD - INDIA', 'SAP PP', '4', 'Information Technology', 'SAP', 'Full Time', 'Consultant', 'Bachelors or Masters (Computer Science, Finance, Technical, Engineering, IT)', '', '23/11/28', '09:41:51 PM', 'active', NULL, NULL, '2024-12-16 05:45:48'),
(137, 0, 'SAP MM Consultant', 'Minimum 5 years of experience in MM\r\nS/4 HANA Conversion / Migration is Needed.\r\nIntegration with PS, SD, PP & FI\r\nDevelop functionalities needed for business processes, training, support, and to evaluate software usage effectiveness.', '5 Years', '10 Years', '', '', 'HYDERABAD - INDIA', 'SAP MM', '4', 'Information Technology', 'SAP', 'Full Time', 'Consultant', 'Bachelors or Masters (Computer Science, Finance, Technical, Engineering, IT)', '', '23/11/28', '09:45:00 PM', 'active', NULL, NULL, '2024-12-16 05:45:48'),
(138, 0, 'SAP CRM Consultant', 'Minimum 5 years of experience in CRM\r\nS/4 HANA Conversion / Migration is Needed.\r\nDemand/Delivery Management.\r\nBecome and grow into an IT / Process Champ in the area of sales, service and marketing processes based on the SAP CRM standard software.\r\nExecute the delivery demands through application customization and configuration.', '5 Years', '10 Years', '', '', 'HYDERABAD - INDIA', 'SAP CRM', '4', 'Information Technology', 'SAP', 'Full Time', 'Consultant', 'Bachelors or Masters (Computer Science, Finance, Technical, Engineering, IT)', '', '23/11/28', '09:51:26 PM', 'active', NULL, NULL, '2024-12-16 05:45:48'),
(139, 0, 'SAP FICO Consultant', 'Minimum 5 years of experience in FICO\r\nS/4 HANA Conversion / Migration is Needed.\r\nExperience with SAP FICO including accounts payable, purchase to pay process, accounts receivable, order to cash process, and general ledger.\r\nExperience with Vertex tax solution, fixed assets, and credit card processing', '5 Years', '10 Years', '', '', 'HYDERABAD - INDIA', 'SAP FICO', '4', 'Information Technology', 'SAP', 'Full Time', 'Consultant', 'Bachelors or Masters (Computer Science, Finance, Technical, Engineering, IT)', '', '23/11/28', '09:59:06 PM', 'active', NULL, NULL, '2024-12-16 05:45:48'),
(140, 0, 'SAP PM Consultant', 'Minimum 5 years of experience in PM\r\nS/4 HANA Conversion / Migration is Needed.\r\nEndeavour to maintain a standardized best practice approach to Supply Chain Management from a process and SAP perspective.\r\nResponsible for maintaining effective relationships with stakeholders e.g. SAP Solution Managers, Supply Chain leadership, site super-users, other workstream leads', '5 Years', '10 Years', '', '', 'HYDERABAD - INDIA', 'SAP PM', '4', 'Information Technology', 'SAP', '', 'Consultant', 'Bachelors or Masters (Computer Science, Finance, Technical, Engineering, IT)', '', '23/11/28', '10:04:01 PM', 'active', NULL, NULL, '2024-12-16 05:45:48'),
(141, 0, 'SAP HR Consultant', 'Minimum 5 years of experience in HR\r\nS/4 HANA Conversion / Migration is Needed.\r\nLeads a functional development area for the SuccessFactors competency SuccessFactors for Employee Central, Recruitment, Learning, Performance and Goals etc.\r\nWorking closely with our payroll department on all ROI and NI payroll issues general monthly payroll sickness/maternity benefits and any other social welfare/revenue matters, administering any data changes as required', '5 Years', '10 Years', '', '', 'HYDERABAD - INDIA', 'SAP HR', '4', 'Information Technology', 'SAP', 'Full Time', 'Consultant', 'Bachelors or Masters (Computer Science, HR, HRMS, Finance,Engineering, IT)', '', '23/11/28', '10:06:55 PM', 'active', NULL, NULL, '2024-12-16 05:45:48'),
(142, 0, 'SAP Life Science Consultant', 'Lead economic evaluations of significant projects, including the strategic planning process and modelling, research initiatives, capital expenditures, and acquisitions/divestitures.\r\nS/4 HANA Conversion / Migration is Needed.\r\nProactively contributing to the discussion and recommendations to the global management team to improve business performance.', '6 Years', '10 Years', '', '', 'HYDERABAD - INDIA', 'SAP Life Science', '4', 'Information Technology', 'SAP', 'Full Time', 'Consultant', 'B.S. in Accounting, Finance, Engineering or related degree and MBA.', '', '23/12/07', '06:21:56 PM', 'active', NULL, NULL, '2024-12-16 05:45:48'),
(143, 6, 'Testing', 'kuch v', '2 Years', '4 Years', '10000', '30000', 'Off-Shore, KARACHI - PAKISTAN, RIYADH - KSA', 'UI Designer', '1', 'IT', 'Development', 'Contractual', 'UI Developer', 'Graduation', 'Figma', '2024/11/05', '05:50:43 AM', 'active', NULL, NULL, '2024-12-16 05:45:48'),
(145, 10, 'UI/UX Graphics Designer', 'Figma\r\nMockups', '2 Years', '', '', '', 'HYDERABAD - INDIA', 'UX Designer', '1', 'IT', 'Development', 'Full Time', 'Designer', 'Undergraduate', 'Designing, Figma', '2024/11/11', '09:16:53 PM', 'active', NULL, NULL, '2024-12-16 05:45:48'),
(146, 11, 'Cloverleaf Interface Technical Consultant - Â  (137008)', 'Position Description and Job Skill Set:\r\n\r\nThe State of Mississippi, Division of Medicaid (DOM), is seeking proposals from interested and qualified professional entities to provide a Cloverleaf Interface Technical Consultant. This consultant will assist DOM in the maintenance and enhancement of an Infor Cloverleaf system used by DOM to authenticate and transmit administrative and clinical data transactions between DOM and its data trading partners. The resource will be required to be onsite for a project kick-off meeting. For the resourceâ€™s onsite work, DOM will provide office space. DOM will provide the resource a computer and accounts needed to perform the job. The project kick-off meeting will be held at DOMâ€™s Central Office location in the Walter Sillers Building at 550 High Street, Jackson, Mississippi, 39201. The resource must comply with all DOM security and physical access rules. The resource will be required to execute a Business Associate Agreement (BAA) with DOM. This co', '6 Years', '0', '', '', 'USA, Bangladesh & Egypt, Dubai - UAE, Yanbu - KSA, NEOM - KSA, HYDERABAD - INDIA, JEDDAH - KSA, JUBAIL - KSA, AL KHOBAR - KSA, DAMMAM - KSA, Off-Shore, KARACHI - PAKISTAN, RIYADH - KSA', 'Consultant', '1', 'MS Division of Medicaid', 'Consultant', 'Full Time', 'Application Developer', 'Graduation or Masters', 'Experience installing, configuring and maintaining Infor Cloverleaf modules and components, to include:  - Cloverleaf Integration Services (CIS) Platform  - Cloverleaf Data Integrator  - Cloverleaf Gl', '2024/11/11', '11:13:25 PM', 'active', NULL, NULL, '2024-12-16 05:45:48'),
(147, 11, 'SAP MM Support Role â€“ L1', 'Posting ID:- TechM146659 \r\nRole:- SAP MM Support Role â€“ L1\r\nLocation:- Winfield City KS  ( 5 Days Onsite Work)\r\nWork Permit:- USC and GC only\r\nMode of Hire:- Subcon\r\nWe need Candidate ready to work in 1st and 2nd Shift and on call support on Weekends\r\n\r\nRole:- SAP L1 Support MM Location:-Arkansas City, KS(Winfield KS) ( Day 1 Onsite role) Work permit:-  Visa Independent  Mode of hire:- SUbcon    JD  Incident Solving Â¿ Resolve known errors by means of SAP Notes, Knowledge Base articles, info docs derived from solved customer incidents, documentation, WIKI, or verifying customized entries or hardware parameters Â¿ Perform root cause analysis and provide solutions Â¿ Achieve a good level of customer satisfaction Â¿ Attend e Learning Lessons, Remote Learning Sessions, Classroom Training and Coaching Â¿ Share and document knowledge through creation of WIKI entries and Knowledge Base articles 2) Additional Tasks Â¿ Participate in weekend support/ 24x7 support activities Â¿ Report errors t', '0', '0', '', '', 'USA, Bangladesh & Egypt, Dubai - UAE, Yanbu - KSA, NEOM - KSA, HYDERABAD - INDIA, JEDDAH - KSA, JUBAIL - KSA, AL KHOBAR - KSA, DAMMAM - KSA, Off-Shore, KARACHI - PAKISTAN, RIYADH - KSA', 'Developer', '1', 'SAP MM ', 'SAP MM ', 'Contractual', 'Application Developer', 'Bachelors ', 'SAP, MM', '2024/11/12', '01:48:55 AM', 'inactive', NULL, NULL, '2024-12-16 05:45:48'),
(148, 11, 'BI Analyst - 137080', 'BI Analyst - 137080\r\nClient: State of UT\r\nLocation: West Jordan, UT (Local or non-local: Need Local)\r\nDuration:  2 Year from projected start date\r\nPlease recruit direct W-2 candidates to your firm.\r\nNeed â€“ GC / UC citizens\r\nResume Need - 2\r\n\r\nWill close submissions on 11/19/2024 4:00:00 PM\r\nTentative interview dates: November 20th and 21st\r\n\r\n\r\nJob Description:\r\n\r\nScope of Work\r\nThe State of Utah Department of Government Operations, Division of Technology Services (DTS) is looking for an experienced Business Intelligence (BI) Consultant to support the Utah Department of Corrections (UDC) in collecting, integrating, coding, querying, and reporting data. The selected Contractor will:\r\n\r\nDevelop and maintain systems for collecting, storing, and analyzing data\r\nfrom various sources within the corrections system.\r\nâ— Create dashboards and reports that provide insights into Key Performance Indicators (KPIs) such as recidivism rates, program participation and effectiveness, staff turnover,', '0', '0', '', '', 'USA, Bangladesh & Egypt, Dubai - UAE, Yanbu - KSA, NEOM - KSA, HYDERABAD - INDIA, JEDDAH - KSA, JUBAIL - KSA, AL KHOBAR - KSA, DAMMAM - KSA, Off-Shore, KARACHI - PAKISTAN, RIYADH - KSA', 'Business Analyst ', '1', 'BI Analyst ', 'BI Analyst ', 'Contractual', 'Application Developer', 'Bachelors ', 'Informix, PostgreSQL, and understanding data warehouse technologies (BigQuery, GCP).', '2024/11/12', '01:52:37 AM', 'inactive', NULL, NULL, '2024-12-16 05:45:48'),
(149, 11, 'Software Developer/Development Manager - 137079', 'Software Developer/Development Manager - 137079\r\nClient: State of UT\r\nLocation: Salt Lake City, UT (Local or non-local: Need Local)\r\nDuration:  5 Year from projected start date\r\nW2 - Subcontracting will not be approved for this recruitment. Please recruit direct W-2 candidates to your firm.\r\nGC / US citizen\r\nResume Need: 2\r\n \r\nWill close submissions on 11/19/2024 4:00:00 PM\r\nTentative interview dates: December 2nd and 3rd\r\n \r\n \r\nJob Description:\r\n \r\nThe Office of Vital Records and Statistics (OVRS) is looking for a software architect / development manager.  The OVRS development teams work on applications that track the facts of vital events (such as death, birth, stillbirth, divorce and marriage) and issuance of certificates.  This manager would oversee the creation of software products by coordinating multiple development teams.  They would also ensure that all teams are aligned with project goals, timelines, resources as well as crafting the shared architectural vision.  \r\n \r\n \r\nIn o', '0', '0', '', '', 'USA, Bangladesh & Egypt, Dubai - UAE, Yanbu - KSA, NEOM - KSA, HYDERABAD - INDIA, JEDDAH - KSA, JUBAIL - KSA, AL KHOBAR - KSA, DAMMAM - KSA, Off-Shore, KARACHI - PAKISTAN, RIYADH - KSA', 'Manager', '2', 'Development Manager', 'Development Manager', 'Contractual', 'Application Developer', 'Bachelors ', ': JAVA, SQL, architecting software applications, PHP, VBScript, debugging, scrum / agile development', '2024/11/12', '01:55:16 AM', 'inactive', NULL, NULL, '2024-12-16 05:45:48'),
(150, 11, 'Technical Specialist- Expert (750606) - Contractor Title: Cloud Engineer', 'Role: NCDIT - Technical Specialist- Expert (750606) - Contractor Title: Cloud Engineer\r\nClient: State of NC\r\nRemote Role\r\nLocation: 3700 Wake Forest Rd, Raleigh, NC\r\nRate: 90/hr. on c2c\r\nDue Date: 15th November 2024\r\nDuration: 1+ year\r\nJD\r\nDescription:\r\nThis contractor posting is for augmenting the NCDIT cloud services team with their project and daily operational work. This includes but not limited to on-boarding customers to AWS, Azure and GCP; working on customer tickets involving different services of AWS, Azure and GCP; assisting cloud services customers on issues and inquiries; working with the cloud services team.  \r\nKnowledge, Skills, and Abilities:\r\nâ€¢	7 years hands-on experience in public cloud (namely: AWS, Azure and GCP) utilizing native infrastructure services such as IAM, Organizations, Landing Zones, and others.\r\nâ€¢	Experience with cloud security compliance.\r\nâ€¢	Experience with cloud networking services/technologies.\r\nâ€¢	Knowledge of cloud high availability and redun', '0', '0', '', '', 'USA, Bangladesh & Egypt, Dubai - UAE, Yanbu - KSA, NEOM - KSA, HYDERABAD - INDIA, JEDDAH - KSA, JUBAIL - KSA, AL KHOBAR - KSA, DAMMAM - KSA, Off-Shore, KARACHI - PAKISTAN, RIYADH - KSA', 'Technical Specialist- Expert (750606) - Contractor Title: Cloud Engineer', '1', 'AWS', 'AWS', 'Contractual', 'Consultant', 'Bachelors ', 'â€¢	7 years hands-on experience in public cloud (namely: AWS, Azure and GCP) utilizing native infrastructure services such as IAM, Organizations, Landing Zones, and others. â€¢	Experience with cloud s', '2024/11/14', '08:54:02 PM', 'inactive', NULL, NULL, '2024-12-16 05:45:48'),
(151, 11, 'SAP MM', 'An experienced and well-qualified SAP MM consultant generally needs a combination of education, training, and experience. Here are some of the typical requirements and qualifications for the role: \r\nExperience: Most employers require several years of experience in a related field, such as procurement, inventory management, or supply chain management.\r\nTechnical skills: The consultant must have a good understanding of SAP MM software and the ability to configure, customize, and implement SAP MM solutions. Knowledge of other SAP modules, such as SD (Sales and Distribution) and FI (Financial Accounting), is also useful.\r\nAnalytical and problem-solving skills: A SAP MM consultant should also be able to analyze complex data and processes, identify problems, and propose effective solutions.\r\nCommunication skills: They must be able to communicate effectively with clients and team members, both verbally and in writing.\r\nBusiness acumen: They must have a good understanding of business processes', '0', '8 Years', '', '', 'USA, Bangladesh & Egypt, Dubai - UAE, Yanbu - KSA, NEOM - KSA, HYDERABAD - INDIA, JEDDAH - KSA, JUBAIL - KSA, AL KHOBAR - KSA, DAMMAM - KSA, Off-Shore, KARACHI - PAKISTAN, RIYADH - KSA', 'SAP MM', '2', 'FOOD', 'FOOD', 'Contractual', 'SENIOR SAP CONSULTANT', 'Bachelors ', 'MM', '2024/11/19', '12:22:06 AM', 'active', NULL, NULL, '2024-12-16 05:45:48'),
(152, 11, 'SAP FI', 'â€¢	Effective transition and hand-over of completed projects into BAU/Support\r\nâ€¢	This role will work independently and in collaboration with the SAP Functional Leads and full-time employees across the organization to provide SAP support within the specific functional domain FICO\r\nâ€¢	Improve cost roll processes and increase their frequency\r\nâ€¢	Enhance reporting capabilities through Business Warehouse/Business Objects focusing on OEE/OLE operational metrics\r\nâ€¢	In case of IT emergencies, coordinate 3rd level application support activities for the applications in their area in order to resume normal operations\r\nâ€¢	Perform complex design, configuration, testing and debugging in accounting related SAP modules\r\nâ€¢	Provide support to business users in the accounting area\r\nâ€¢	Set up and roll out new companies/entities\r\nâ€¢	Influence the business on SAP best practices for the Management Accounting\r\nâ€¢	Analyst will work in a matrixed environment including with other technical service ar', '0', '8 Years', '', '', 'USA, Bangladesh & Egypt, Dubai - UAE, Yanbu - KSA, NEOM - KSA, HYDERABAD - INDIA, JEDDAH - KSA, JUBAIL - KSA, AL KHOBAR - KSA, DAMMAM - KSA, Off-Shore, KARACHI - PAKISTAN, RIYADH - KSA', 'SAP FI', '2', 'FOOD', 'FOOD', 'Contractual', 'SENIOR SAP CONSULTANT', 'Bachelors ', 'FI', '2024/11/19', '12:25:48 AM', 'inactive', NULL, NULL, '2024-12-16 05:45:48'),
(153, 11, 'SAP TRM', 'â€¢	Should have implemented SAP Treasury(FSCM) in at least 3 projects (almost 5 years) in the capacity of lead(complete business blueprinting and realization).\r\nâ€¢	Comprehensive knowledge in FI, Costing including profitability analysis, New General Ledger, fund management.\r\nâ€¢	At least 3 years of experience in creating requirement specifications based on Architecture/Design /Detailing of Processes.\r\nâ€¢	Expertise in SAP core treasury module (Money Market and Loans, Foreign Exchange, Interest Rate Swap, Reporting and Risk Management).\r\nâ€¢	Expertise in cash and liquidity Management.\r\nâ€¢	Expertise in Banking, customer cash application, outgoing payment processing.\r\nâ€¢	Multiple SAP implementations in treasury, Banking, Cash Management.\r\nâ€¢	Experience in Receivables Management (Collections, dispute and credit management) desirable.\r\nâ€¢	Experience in S/4 HANA Finance desirable.\r\nâ€¢	Should be able to understand the existing client business processes and suggest/propose areas of improv', '0', '8 Years', '', '', 'USA, Bangladesh & Egypt, Dubai - UAE, Yanbu - KSA, NEOM - KSA, HYDERABAD - INDIA, JEDDAH - KSA, JUBAIL - KSA, AL KHOBAR - KSA, DAMMAM - KSA, Off-Shore, KARACHI - PAKISTAN, RIYADH - KSA', 'SAP TRM', '2', 'FOOD', 'FOOD', 'Contractual', 'SENIOR SAP CONSULTANT', 'Bachelors ', 'TRM', '2024/11/19', '12:31:04 AM', 'inactive', NULL, NULL, '2024-12-16 05:45:48'),
(154, 11, 'WebMethods.IO Integration Developer  ', '13+ years of development experience on web Methods Integration Suite ( web Methods IO Integration Server, Broker/ Universal Messaging, Trading Network, MWS, MFT, SAP Adapter, Salesforce Adapter, web Services). \r\nHands on experience in WebMethods.IO API Gateway, IO Integration, and IO MFT. \r\nImplementation experience on different EAI, B2B Integration patterns. \r\nExtensive knowledge on SAP, Salesforce, web Services Integrations, EDI, EDIINT AS2, Exchanging Certificates. \r\nMessage standards: EDI - X12, EDIFACT , XML, Flat Files Protocols: such as HTTP(S), FTP(S), SOAP/HTTP \r\n', '0', '0', '', '', 'USA, Bangladesh & Egypt, Dubai - UAE, Yanbu - KSA, NEOM - KSA, HYDERABAD - INDIA, JEDDAH - KSA, JUBAIL - KSA, AL KHOBAR - KSA, DAMMAM - KSA, Off-Shore, KARACHI - PAKISTAN, RIYADH - KSA', 'WebMethods.IO Integration Developer  ', '1', 'Integration ', 'Integration ', 'Contractual', 'Developer', 'Bachelors ', 'WebMethods.IO Integration Developer  ', '2024/11/19', '01:37:49 AM', 'inactive', NULL, NULL, '2024-12-16 05:45:48'),
(155, 10, 'Front End Developer (UI/UX)', 'Job Summary:\r\nWe are seeking a talented Front-End Developer (UI/UX) to join our team and help craft exceptional user experiences. The ideal candidate will combine strong technical skills in front-end development with a keen eye for design to bring user interfaces to life. You will work closely with designers and back-end developers to ensure seamless functionality and intuitive design, delivering responsive, user-friendly web applications.\r\n\r\nKey Responsibilities:\r\n- Develop and implement user interfaces using HTML, CSS, and JavaScript frameworks.\r\n- Collaborate with designers to translate UI/UX designs into pixel-perfect, responsive web pages.\r\n- Optimize front-end code for performance, scalability, and accessibility.\r\n- Ensure cross-browser and cross-platform compatibility.\r\n- Maintain and update existing websites and applications as needed.\r\n- Participate in design reviews and contribute ideas to improve the overall user experience.', '3 Years', '8 Years', '', '', 'HYDERABAD - INDIA', 'Front End Developer (UI/UX)', '2', 'IT - Web Development', '', 'Full Time', 'UI Designer', 'Graduation', 'Front End Technologies', '2024/11/19', '02:25:06 PM', 'active', NULL, NULL, '2024-12-16 05:45:48'),
(156, 10, 'Back End Developer', 'Job Summary:\r\nWe are looking for a skilled Back-End Developer to join our team and help build robust, scalable, and efficient server-side applications. The ideal candidate has strong programming skills, experience with database management, and the ability to integrate front-end components with server-side logic. You will play a critical role in developing and maintaining our core application functionalities and ensuring high performance and responsiveness.\r\n\r\nKey Responsibilities:\r\n-Design, develop, and maintain server-side architecture and applications.\r\n-Create and manage APIs to integrate front-end elements with server-side logic.\r\n-Optimize server performance for maximum speed and scalability.\r\n-Collaborate with front-end developers and other team members to define project requirements and deliverables.\r\n-Manage databases, ensuring data integrity, security, and efficiency.\r\n-Troubleshoot and debug server-side issues to ensure system reliability.\r\n-Stay updated with industry trends ', '2 Years', '8 Years', '', '', 'HYDERABAD - INDIA', 'Back End Developer', '2', 'IT - Web Development', '', 'Full Time', 'Application Developer', 'GradIuation', 'Proficiency in server-side languages (Python, Java, Node.js), database management (SQL, NoSQL), API development (REST, GraphQL), cloud services (AWS, Azure), and scalable system design.', '2024/11/19', '02:33:45 PM', 'active', NULL, NULL, '2024-12-16 05:45:48'),
(157, 10, 'Front End Developer (UI/UX)', 'As a Front-End Developer with UI/UX expertise, you will bridge the gap between design and technology. You will collaborate with our design and development teams to create visually appealing, accessible, and highly functional web interfaces. Your ability to translate UI/UX designs into interactive, responsive code will play a key role in delivering exceptional user experiences across web platforms.\r\n\r\nKey Responsibilities:\r\nUI/UX Design Implementation: Convert UI/UX designs into high-quality, responsive front-end code using HTML, CSS, and JavaScript (React, Vue.js, Angular, or similar frameworks).\r\nUser-Centered Design: Work closely with designers and product managers to ensure designs meet user needs and align with business objectives.\r\nCross-Functional Collaboration: Collaborate with back-end developers to integrate front-end functionality with server-side logic and databases.\r\nResponsive Web Development: Ensure web applications are fully responsive and optimized for various devices a', '3 Years', '8 Years', '', '', 'HYDERABAD - INDIA', 'Front End Developer (UI/UX)', '2', 'IT - Web Development', '', 'Full Time', 'Developer', 'Graduation', 'Front End Technologies', '2024/11/19', '03:37:59 PM', 'active', NULL, NULL, '2024-12-16 05:45:48'),
(158, 10, 'Full Stack Developer', 'We are looking for a skilled Full Stack Developer to join our dynamic team. The ideal candidate will have a deep understanding of both front-end and back-end technologies, a strong problem-solving ability, and a passion for creating scalable and robust web applications. You will be responsible for developing, enhancing, and maintaining our web platforms, ensuring a seamless user experience and efficient system operations.\r\n\r\nKey Responsibilities:\r\n\r\n1.Design and Development:\r\n\r\nDevelop, test, and maintain front-end and back-end components of web applications.\r\nWrite clean, maintainable, and efficient code using modern programming languages and frameworks.\r\nFront-End Development:\r\n\r\nBuild responsive, user-friendly interfaces with HTML, CSS, JavaScript, and frameworks like React, Angular, or Vue.js.\r\nCollaborate with designers to implement intuitive and visually appealing user interfaces.\r\n\r\n2.Back-End Development:\r\n\r\nDesign, develop, and maintain APIs and server-side logic using languag', '3 Years', '8 Years', '', '', 'HYDERABAD - INDIA', 'Full Stack Developer', '0', 'IT - Web Developement', '', 'Full Time', 'Developer', 'Graduation', 'Proficiency in front-end and back-end development, expertise in modern frameworks (React, Angular, Node.js), database management (SQL, NoSQL), API design, cloud platforms (AWS, Azure), and strong prob', '2024/11/19', '03:49:46 PM', 'active', NULL, NULL, '2024-12-16 05:45:48'),
(160, 10, 'System Design Architect', 'We are seeking an experienced System Design Architect to lead the architecture, design, and implementation of scalable and robust systems. You will work closely with engineering teams, product managers, and stakeholders to create solutions that meet business requirements while ensuring reliability, scalability, and performance.\r\n\r\nKey Responsibilities:\r\n\r\n1.System Architecture Design:\r\n\r\nDevelop high-level system architecture and design documentation.\r\nDefine and ensure adherence to architectural best practices and standards.\r\n\r\n2.Scalability and Performance:\r\n\r\nDesign systems for high availability, scalability, and performance.\r\nIdentify and mitigate potential bottlenecks and risks.\r\n\r\n3.Collaboration and Leadership:\r\n\r\nWork with cross-functional teams to understand technical and business requirements.\r\nProvide technical leadership and guidance to engineering teams.\r\n\r\n4.Technology Evaluation:\r\n\r\nAssess new technologies and frameworks to recommend the best solutions.\r\nEnsure the archi', '3 Years', '8 Years', '', '', 'HYDERABAD - INDIA', 'System Design Architect', '', 'IT - Web Development', '', 'Full Time', 'Application Developer', 'Graduation', 'xpertise in system architecture, distributed systems, microservices, cloud platforms (AWS, Azure), API design (REST, GraphQL), database modeling (SQL, NoSQL), and DevOps practices.', '2024/11/19', '04:19:34 PM', 'active', NULL, NULL, '2024-12-16 05:45:48'),
(159, 10, 'DevOps Specialist', 'We are seeking a highly skilled DevOps Specialist to join our team and drive the continuous integration, delivery, and deployment of robust software systems. As a DevOps Specialist, you will streamline and automate our development and operations processes, ensure high availability of services, and support the scalability of our infrastructure.\r\n\r\nKey Responsibilities:\r\n\r\n1.Infrastructure Automation:\r\n\r\nDesign, implement, and maintain CI/CD pipelines.\r\nAutomate repetitive tasks using tools like Jenkins, GitLab CI/CD, or CircleCI.\r\n\r\n2.Cloud and Systems Management:\r\n\r\nDeploy, monitor, and manage applications in cloud environments (AWS, Azure, Google Cloud).\r\nOptimize infrastructure for scalability, performance, and cost-efficiency.\r\n\r\n3.Monitoring and Troubleshooting:\r\n\r\nSet up monitoring, logging, and alerting systems (e.g., Prometheus, Grafana, ELK Stack).\r\nResolve system performance issues and ensure minimal downtime.\r\n\r\n4.Collaboration and Support:\r\n\r\nWork closely with development, Q', '3 Years', '8 Years', '', '', 'HYDERABAD - INDIA', 'DevOps Specialist', '', 'IT - Web Development', '', 'Full Time', 'Developer', 'Graduation', 'Expertise in CI/CD pipelines, cloud platforms (AWS, Azure, Google Cloud), containerization (Docker, Kubernetes), scripting (Bash, Python), infrastructure as code (Terraform, Ansible), and system monit', '2024/11/19', '04:09:35 PM', 'active', NULL, NULL, '2024-12-16 05:45:48'),
(161, 10, 'Business Analyst', 'We are looking for a detail-oriented and strategic Business Analyst to join our team. The ideal candidate will bridge the gap between business needs and technical solutions, analyze data, and provide actionable insights to support decision-making and optimize processes. You will collaborate with stakeholders to gather requirements, identify opportunities for improvement, and deliver solutions that drive business success.\r\n\r\nKey Responsibilities:\r\n\r\n1.Requirement Gathering and Analysis:\r\n\r\nCollaborate with stakeholders to gather, document, and analyze business requirements.\r\nTranslate business needs into functional and technical specifications.\r\n\r\n2.Process Improvement:\r\n\r\nIdentify inefficiencies in business processes and recommend solutions for improvement.\r\nCreate workflows, process maps, and use cases to support enhancements.\r\n\r\n3.Data Analysis and Reporting:\r\n\r\nAnalyze data to identify trends, patterns, and insights.\r\nPrepare reports and dashboards to inform business decisions.\r\n\r\n4', '3 Years', '8 Years', '', '', 'HYDERABAD - INDIA', 'Business Analyst', '', 'IT - Web Development', '', 'Full Time', 'Business Development Manager', 'Graduation', 'Strong analytical skills, data analysis proficiency (Excel, SQL, Power BI), process modeling (BPMN, UML), stakeholder management, and knowledge of project management and SDLC methodologies.', '2024/11/19', '04:23:14 PM', 'active', NULL, NULL, '2024-12-16 05:45:48'),
(162, 11, 'ServiceNow Technical Specialist  (751613)', 'JD\r\nServiceNow Technical Specialist for HRSD/WSD, ITOM, ITSM, and SPM -Candidates must reside in NC, preferably within commuting distance to Raleigh.\r\n\r\n***The candidate must come in to pick up his or her equipment on the first day at own expense. A candidate or a vendor representative must come in to drop off his or her equipment on the last day a town expense.\r\n***There will be times when this position will be required for on-site meetings in the Raleigh area, but most of the work will be remote. The candidate will need to reside in North Carolina, preferably within commuting distance to Raleigh.\r\nWe are seeking an experienced and highly motivated ServiceNow Developer to join our dynamic team. The ideal candidate will have a strong background in designing, developing, and implementing ServiceNow applications and solutions. You will be responsible for customizing and configuring the ServiceNow platform to meet business needs, as well as providing ongoing support and maintenance\r\nKey R', '0', '0', '', '', 'USA, Bangladesh & Egypt, Dubai - UAE, Yanbu - KSA, NEOM - KSA, HYDERABAD - INDIA, JEDDAH - KSA, JUBAIL - KSA, AL KHOBAR - KSA, DAMMAM - KSA, Off-Shore, KARACHI - PAKISTAN, RIYADH - KSA', 'ServiceNow Technical Specialist ', '1', 'NCDOT', 'NCDOT', 'Contractual', 'Senior Analyst', 'Bachelors ', 'HRSD/WSD, ITOM, ITSM, and SPM ', '2024/11/22', '11:55:06 PM', 'inactive', NULL, NULL, '2024-12-16 05:45:48'),
(163, 11, 'NCDOT - SharePoint Technical Specialist - Jr (722676)', 'NCDOT is seeking a SharePoint Product Specialist contractor for the Engineering Content Management group who will be responsible for managing and designing SharePoint and web-based business solutions and related materials.\r\n\r\nThe candidate must reside in the United States. If a resident of North Carolina, the candidate must be willing to come to Raleigh at their expense to pick up a laptop. If outside the state of North Carolina, use their personal computer to remote into a workstation. Position is remote with minimal in-person engagement if the candidate is local to the Raleigh area.\r\nNo computer programming/coding will be performed in this position; however, experience related to SharePoint or other web application development is required.\r\nDescription:\r\nThe North Carolina Department of Transportation (NCDOT) is seeking a Technical Specialist contractor for a 12-month engagement for the Engineering Application Services Department as an ECM Solution Designer. This person will be respo', '0', '0', '', '', 'USA, Bangladesh & Egypt, Dubai - UAE, Yanbu - KSA, NEOM - KSA, HYDERABAD - INDIA, JEDDAH - KSA, JUBAIL - KSA, AL KHOBAR - KSA, DAMMAM - KSA, Off-Shore, KARACHI - PAKISTAN, RIYADH - KSA', 'SharePoint Technical Specialist ', '1', 'NCDOT ', 'NCDOT ', 'Contractual', 'Application Developer', 'Bachelors ', 'SharePoint Business Analyst', '2024/11/22', '11:57:01 PM', 'inactive', NULL, NULL, '2024-12-16 05:45:48'),
(164, 11, 'NCDOT - AASHTOWare Project (AWP) Developer (751406)', 'The AASHTOWare Project Senior Developer (EAS LCS) - NC Department of Information Technology - Transportation - is a junior specialist level resource with specialized knowledge and experience in a specific technology.  \r\n\r\n****Preference will be given to candidates living in North Carolina. The candidate will need to use their own equipment from home to remote into the worksite (PC set up in the organization).\r\n\r\nIt\'s expected that the Technical Specialist will be available 8 hours during standard business hours, 8AM - 6PM M-F local time.\r\nThis is technical and analytical work in designing, developing, implementing and supporting AASHTOWare Project (AWP) for the NCDOT. This role works with business analysts and other technical staff to deliver required functionality for AWP Preconstruction and CRL modules to the NCDOT business customers in an agile environment. It is expected that this position will be needed for the next year or two. This is technical work with AWP and includes a wide ', '0', '0', '', '', 'USA, Bangladesh & Egypt, Dubai - UAE, Yanbu - KSA, NEOM - KSA, HYDERABAD - INDIA, JEDDAH - KSA, JUBAIL - KSA, AL KHOBAR - KSA, DAMMAM - KSA, Off-Shore, KARACHI - PAKISTAN, RIYADH - KSA', 'NCDOT - AASHTOWare Project (AWP) Developer (751406)', '1', 'NCDOT ', 'NCDOT ', 'Contractual', 'Developer', 'Bachelors ', 'AASHTOWare', '2024/11/22', '11:59:30 PM', 'inactive', NULL, NULL, '2024-12-16 05:45:48');
INSERT INTO `post` (`sno`, `employer_id`, `job_title`, `job_description`, `exper_min`, `exper_max`, `salary_min`, `salary_max`, `location`, `role`, `openings`, `industry_type`, `function_area`, `emp_type`, `role_category`, `education`, `skills`, `post_date`, `post_time`, `status`, `seq`, `client_id`, `created_at`) VALUES
(165, 11, 'oftware Solutions Architect - Solutions Specialist â€“ 137435 (The State of Michigan is looking for a Software Solutions Architect (MS Dynamics Experience Needed))', 'Top Skills & Years of Experience Required: \r\n\r\nâ€¢	Extensive experience with MS Dynamics - 3-5 years\r\nâ€¢	PL-600: Microsoft Power Platform Solution Architect Certified â€“ Highly Preferred \r\nâ€¢	Web Portal - 3-5 years\r\nâ€¢	PowerApps - 3-5 years\r\nâ€¢	Salesforce 3+ years \r\nâ€¢	Azure DevOps 5+ years\r\nâ€¢	Architect Experience 3-5 years \r\nâ€¢	Database Architecture Experience- 1-3 years \r\nâ€¢	Infrastructure/Network and Application Support - 5+ years\r\nâ€¢	Technical Customer Service Analyst - 5+ years\r\nâ€¢	Troubleshooting skills (ASP.NET, HTML, etc.) minimum years\' experience required - 5 years.\r\n', '10 Years', '', '', '', 'USA', 'Software Solutions Architect - Solutions Specialist â€“ 137435 ', '1', 'MS Dynamics ', 'MS Dynamics ', 'Contractual', 'Application Developer', 'Bachelors ', 'MS Dynamics Experience Needed', '2024/11/27', '10:55:26 PM', 'active', NULL, NULL, '2024-12-16 05:45:48'),
(166, 11, 'Technical Specialist - Mid Level - ECM Solution Designer (751702)', '\r\nJD\r\nThe North Carolina Department of Transportation (NCDOT) is seeking a SharePoint Technical Specialist - Mid Level - ECM Solutions Designer for a 12-month contract engagement for the Engineering Application Services Department. \r\n\r\n**Selected candidate must be comfortable using their own equipment to remote into a virtual workspace. A laptop will not be provided.**\r\n**No computer programming/coding will be performed in this position.**\r\nDescription:\r\nThe North Carolina Department of Transportation (NCDOT) is seeking a SharePoint Technical Specialist - Mid Level - ECM Solutions Designer for a 12-month contract engagement for the Engineering Application Services Department. The Technical Specialist/Solution Designer will design and implement SharePoint and web-based solutions that enhance critical Preconstruction processes within NCDOT\'s Transportation Life Cycle. Key responsibilities include translating requirements into user stories, tracking project progress, testing solutions, tr', '10 Years', '', '', '', 'USA', 'Technical Specialist - Mid Level - ECM Solution Designer (751702)', '1', 'NCDOT', 'NCDOT', 'Contractual', 'Senior Analyst', 'Bachelors ', 'Business Analyst', '2024/11/27', '10:58:20 PM', 'active', NULL, NULL, '2024-12-16 05:45:48'),
(167, 11, 'Technical Specialist, Construction (751767)', '\r\n**The candidate must reside in the United States\r\n**The manager has a strong preference for candidates currently living in NC\r\n**if a resident of North Carolina, the candidate must be willing to come to Raleigh at their expense to pick up a laptop\r\n**If NOT a resident in North Carolina, the candidate must be willing to use their personal computer to remote into a workstation\r\n**Position is remote with minimal in-person engagement if the candidate is local to the Raleigh area\r\n\r\nMANAGER NOTES:\r\nThis is a SharePoint Technical Specialist position responsible for Design, Quality Assurance, and Business Analysis.  There will not be any coding or SharePoint Administration work performed by the candidate in this position.  \r\n\r\nDescription:\r\nThe North Carolina Department of Transportation (NCDOT) is seeking a SharePoint Product Specialist contractor for a 12-month engagement for the Engineering Application Services Department as an ECM Construction Business Analyst.   This person will be res', '10 Years', '', '', '', 'USA', 'Technical Specialist, Construction (751767)', '1', 'North Carolina Department of Transportation (NCDOT) ', 'North Carolina Department of Transportation (NCDOT) ', 'Contractual', 'Senior Analyst', 'Bachelors ', 'SharePoint Business Analyst', '2024/11/27', '11:00:53 PM', 'active', NULL, NULL, '2024-12-16 05:45:48'),
(168, 11, 'SAP FICO Consultant', 'Role: SAP FICO Consultant\r\nLocation: Riyadh, Saudi Arabia  Offshore work in India  \r\nDuration: 1+ Years\r\n\r\n\r\nJob Responsibilities :\r\nImplement and configure SAP FICO modules according to project requirements.\r\nAnalyze business processes in the finance domain and recommend improvements.\r\nConduct requirement gathering sessions and document functional specifications.\r\nConfigure and test SAP FICO modules to meet client needs.\r\nProvide training and support to end-users.\r\nTroubleshoot and resolve issues related to SAP FICO modules.\r\nCollaborate with other SAP consultants to integrate FICO with other SAP modules.\r\nKeep abreast of SAP updates, developments, and best practices in FICO modules.\r\nProven experience as an SAP FICO Consultant.\r\nIn-depth knowledge of SAP FICO module, including configuration and testing.\r\nExperience with financial accounting and reporting processes.\r\nStrong analytical and problem-solving skills.\r\nExcellent communication and client-facing skills.\r\nAbility to work in a ', '8 Years', '', '', '', 'RIYADH - KSA', 'SAP FICO', '5-10', 'Renewable Digital Transformation ', 'FICO', 'Contractual', 'SENIOR SAP CONSULTANT', 'Bachelors ', 'FICO', '2024/11/28', '09:11:16 PM', 'active', NULL, NULL, '2024-12-16 05:45:48'),
(169, 11, 'Boomi Administrator (750879)', 'JD\r\nWe are seeking a skilled and dedicated Boomi Administrator to manage and optimize our Boomi Integration Platform. The ideal candidate will be responsible for the administration, configuration, and maintenance of Boomi environments.\r\n\r\nThe Boomi Administrator will work to ensure the seamless integration of applications and efficient data flow across the organization.\r\n\r\nKey Responsibilities:\r\nâ€¢	Configure, deploy, and maintain Boomi integration processes, including workflows, connectors, and mappings.\r\nâ€¢	Manage and maintain the infrastructure, OS and the deployed software\r\nâ€¢	Monitor and manage Boomi environments to ensure high availability, performance, and reliability.\r\nâ€¢	Troubleshoot and resolve issues related to Boomi integrations and data flows.\r\nâ€¢	Collaborate with business and technical teams to understand integration requirements and design solutions.\r\nâ€¢	Develop and implement integration processes, including data transformation, routing, and error handling.\r\nâ€¢	Ens', '10 Years', '', '', '', 'USA', 'Boomi Administrator ', '1', 'DHS', 'DHS ', 'Contractual', 'Developer', 'Bachelors ', 'Boomi', '2024/12/03', '08:32:13 PM', 'active', NULL, NULL, '2024-12-16 05:45:48'),
(170, 11, 'Rhapsody Development and Support - 137783', 'JOB DESCRIPTION:\r\n\r\nPosition Description and Job Skill Set:\r\n\r\nThe Mississippi State Department of Health (MSDH), Offices of Communicable Diseases and the Offices of Health Data, Operations and Research are seeking a Contractor with demonstrable knowledge and experience in working with the Rhapsody platform, developing Rhapsody software solutions, and implementing public health HL7 specification(s). To support MSDHâ€™s on-going data interoperability obligations (Promoting Interoperability, Data Modernization, Mississippi State Public Health Laboratory operations, Vital Statistics, etc), the contractor will work closely with key MSDH OHIT and program staff to develop and implement plans and processes to strengthen, expand and formalize Rhapsodyâ€™s capacity, capabilities and customer support. Identify and Develop a plan to implement CDC recommended changes to the existing Rhapsody environment. Draft MSDH Rhapsody Resource Plans (long and short term). Development of Rhapsody architectu', '0', '0', '50000', '70000', 'USA, Bangladesh & Egypt, Dubai - UAE, Yanbu - KSA, NEOM - KSA, HYDERABAD - INDIA, JEDDAH - KSA, JUBAIL - KSA, AL KHOBAR - KSA, DAMMAM - KSA, Off-Shore, KARACHI - PAKISTAN, RIYADH - KSA', 'Rhapsody Development and Support ', '1', 'Dept of Health', 'Rhapsody ', 'Contractual', 'Developer', 'Bachelors ', 'Rhapsody Development and Support Dept of Health ', '2024/12/03', '08:34:36 PM', 'active', NULL, 0, '2024-12-16 05:45:48'),
(171, 11, 'Health Information Exchange Coordinator - 137781', 'Work as MSDHâ€™s HIE Coordinator, establish working relationships with both relevant national and state level HINs/HIEs. Use the contractorâ€™s knowledge of public health, act as a business analyst and work with relevant MSDH programs to identify use cases and value of QHIN/HIE connections. Develop MSDH-specific information sharing processes to inform all programs of QHIN/HIE progress and value, serve as HIE proponent.. Monitor the value of the implemented connections and collaborate with MSDH programs and the QHIN/HIE to resolve data issues, expand QHIN/HIE services, etc. Represent MSDH as its HIE Coordinator, attend, facilitate, and coordinate meetings, as needed, with other public health related stakeholders relevant to MSDHâ€™s HIE Plan (e.g. Department of Medicaid, Department of Health Services, Department of Mental Health, Federally Qualified Health Centreâ€™s, etc.). Attend relevant national webinars related to QHINs and other national HIN efforts. Keep MSDH leadership abreast a', '10 Years', '', '', '', 'USA', 'Health Information Exchange Coordinator ', '1', 'State Dept of Health', 'Information Exchange ', 'Contractual', 'Consultant', 'Bachelors ', 'public health, QHIN\'s ', '2024/12/03', '08:37:06 PM', 'active', NULL, NULL, '2024-12-16 05:45:48'),
(172, 12, 'PHP Developer', 'We are seeking a skilled PHP Developer to join our dynamic team. The ideal candidate will have 3-4 years of experience in PHP development, a solid understanding of frameworks like CodeIgniter or Laravel, and a passion for delivering high-quality web applications.', '0', '0', '50000', '70000', 'USA, Bangladesh & Egypt, Dubai - UAE, Yanbu - KSA, NEOM - KSA, HYDERABAD - INDIA, JEDDAH - KSA, JUBAIL - KSA, AL KHOBAR - KSA, DAMMAM - KSA, Off-Shore, KARACHI - PAKISTAN, RIYADH - KSA', 'PHP Developer', '2', 'IT', 'Development', 'Full Time', 'Developer', 'B.Tech, MCA', 'PHP, JavaScript, HTML, CSS, Bootstrap', '2024/12/14', '02:22:13 PM', 'active', NULL, 0, '2024-12-16 05:45:48'),
(173, 12, 'Technical Lead', 'We are seeking a skilled PHP Developer to join our dynamic team. The ideal candidate will have 3-4 years of experience in PHP development, a solid understanding of frameworks like CodeIgniter or Laravel, and a passion for delivering high-quality web applications.\r\n\r\nKey Responsibilities:\r\n\r\nDevelop, test, and maintain scalable PHP-based applications.\r\nCollaborate with cross-functional teams to define, design, and ship new features.\r\nWrite clean, well-structured, and efficient code.\r\nIntegrate third-party APIs and web services.\r\nTroubleshoot and resolve application issues and bugs.\r\nStay updated with emerging technologies and industry trends.\r\nRequired Skills and Qualifications:\r\n\r\n3-4 years of experience in PHP development.\r\nProficiency in PHP frameworks like CodeIgniter or Laravel.\r\nStrong knowledge of MySQL, JavaScript, HTML, and CSS.\r\nExperience with RESTful APIs and integrating third-party services.\r\nFamiliarity with version control tools like Git.\r\nExcellent problem-solving and an', '3', '1', '50000', '70000', 'Bangladesh & Egypt, Dubai - UAE, Yanbu - KSA', 'Technical Lead', '2', 'Education', 'Development', 'Full Time', 'Application Developer', 'B.Tech, MCA', 'Java, PHP, Reactjs', '2024/12/14', '05:23:30 PM', 'active', 1, 1, '2024-12-16 05:45:48'),
(174, 12, 'Mobile App Developer', 'We are seeking a skilled and passionate Mobile App Developer to join our team. The ideal candidate will have experience in designing, developing, and maintaining mobile applications for Android and/or iOS platforms. You will collaborate with cross-functional teams to define, design, and implement innovative features that deliver the best possible user experience.', '2', '5', '25000', '50000', 'USA, Bangladesh & Egypt, Dubai - UAE', 'Android Developer', '2', 'Education', 'Development', 'Contractual', 'Application Developer', 'B.Tech, MCA', 'Java, PHP, Reactjs', '2024/12/15', '07:56:35 PM', 'active', 273, 5, '2024-12-16 05:45:48');

-- --------------------------------------------------------

--
-- Table structure for table `previous_exp_tbl`
--

CREATE TABLE `previous_exp_tbl` (
  `id` int(10) NOT NULL,
  `application_id` varchar(20) DEFAULT NULL,
  `previous_exp_content` text DEFAULT NULL,
  `added_date` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `previous_exp_tbl`
--

INSERT INTO `previous_exp_tbl` (`id`, `application_id`, `previous_exp_content`, `added_date`) VALUES
(1, 'AC130423080404', 'Previous Experience', '2023-04-14 02:21:04'),
(2, 'AC130423080425', 'Previous Experience', '2023-04-14 02:22:25'),
(4, 'AC130423090414', 'Worked as a Senior Software Developer for a Fortune 500 company, designing and developing complex web applications for clients across various industries.', '2023-04-14 03:12:20'),
(5, 'AC130423090414', 'Served as a Lead Developer for a startup, overseeing the development of a new platform from conception to launch.', '2023-04-14 03:13:09'),
(6, 'AC130423090414', 'Served as a Technical Lead for a government agency, developing and maintaining critical software systems that supported mission-critical operations.', '2023-04-14 03:13:09'),
(7, 'AC130423090414', 'Worked as a Full Stack Developer for a tech company, developing and maintaining both frontend and backend systems for web applications.', '2023-04-14 03:13:09'),
(8, 'AC130423060429', 'test', '2023-04-14 06:37:29'),
(9, 'AC130423060416', 'test', '2023-04-14 06:42:16'),
(10, 'AC170423020413', 'jsbdfjbd', '2023-04-18 02:37:13'),
(11, 'AC170423020435', 'sjdf', '2023-04-18 02:42:35'),
(12, 'AC170423030420', 'Worked at Kenz Innovation as a sr software developer', '2023-04-18 03:18:20'),
(13, 'AC170423030420', 'Worked at esdy as levek 3 full stack developer', '2023-04-18 03:18:20'),
(14, 'AC170423030441', 'Engage in Designing, Integration, Data Migration, and the development of SAP Payroll Integration with the HR-RAMCO solution', '2023-04-18 03:35:41'),
(15, 'AC170423030441', 'Responsible for the Testing, Requirement gathering, and collaboration with the team for any issue arising from the migration.', '2023-04-18 03:35:41'),
(16, 'AC170423030441', 'Continuous Improvement Digital Project â€“ Involved as an Initial Scope, Requirement Analysis, Future State Process Designing for various business-led initiatives Hybris Integration, Payment Channels, and Bank Integrations.', '2023-04-18 03:35:41');

-- --------------------------------------------------------

--
-- Table structure for table `projects_tbl`
--

CREATE TABLE `projects_tbl` (
  `id` int(11) NOT NULL,
  `emp_id` int(11) NOT NULL,
  `project_name` varchar(255) NOT NULL,
  `client` varchar(200) NOT NULL,
  `role` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date DEFAULT NULL,
  `technologies` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `projects_tbl`
--

INSERT INTO `projects_tbl` (`id`, `emp_id`, `project_name`, `client`, `role`, `description`, `start_date`, `end_date`, `technologies`, `created_at`, `updated_at`) VALUES
(1, 16, 'Personal Portfolio Website', 'Self', 'PHP Developer', 'Designed and developed a responsive personal portfolio website to showcase projects, achievements, and contact details. Utilized React for dynamic content and implemented a contact form using Node.js.', '2019-02-12', '2020-05-11', NULL, '2024-12-10 04:50:45', '2024-12-10 04:50:45'),
(2, 16, 'E-commerce Website', 'Loopintechies Services Pvt Ltd', 'Senior Developer', 'Built an e-commerce website with user authentication, a product catalog, and a shopping cart system. Integrated Stripe for payments and MongoDB for storing product data.', '2020-11-20', '2021-11-30', NULL, '2024-12-10 04:52:09', '2024-12-10 04:52:09');

-- --------------------------------------------------------

--
-- Table structure for table `pro_experience_tbl`
--

CREATE TABLE `pro_experience_tbl` (
  `id` int(10) NOT NULL,
  `application_id` varchar(20) DEFAULT NULL,
  `prof_exp_content` text DEFAULT NULL,
  `added_date` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pro_experience_tbl`
--

INSERT INTO `pro_experience_tbl` (`id`, `application_id`, `prof_exp_content`, `added_date`) VALUES
(1, NULL, '', '2023-04-14 01:30:48'),
(2, 'AC130423080404', 'How do describe your professional experience.', '2023-04-14 02:21:04'),
(3, 'AC130423080425', 'How do describe your professional experience.', '2023-04-14 02:22:25'),
(4, 'AC130423090414', 'Designed and developed complex web applications using various programming languages such as Java, Python, and JavaScript.', '2023-04-14 03:09:14'),
(5, 'AC130423090414', 'Led and managed a team of developers on multiple projects, ensuring timely delivery and high-quality work.', '2023-04-14 03:09:14'),
(6, 'AC130423090414', 'Developed and maintained robust backend systems for large-scale applications, implementing best practices for scalability and security.', '2023-04-14 03:09:14'),
(7, 'AC130423090414', 'Designed and optimized databases for efficient data storage and retrieval, utilizing SQL and NoSQL technologies.', '2023-04-14 03:09:14'),
(8, 'AC130423060429', 'test', '2023-04-14 06:37:29'),
(9, 'AC130423060416', 'test', '2023-04-14 06:42:16'),
(10, 'AC170423020413', 'sdjfnkjb', '2023-04-18 02:37:13'),
(11, 'AC170423020435', 'djfnjn', '2023-04-18 02:42:35'),
(12, 'AC170423030420', 'Full stack developer with 7+ years of experience', '2023-04-18 03:18:20'),
(13, 'AC170423030441', 'Certified SAP Activate Project Management and S/4Finance professional with over 13 years of experience integration in full life cycle implementation experience in the areas of Finance, Banking, Project System, and cross-module integration expertise include in Supply chain, Manufacturing, Digital, and Analytics across diverse organizations. Proficient in working on Roadmap, Business Case, Data Migration, System Integrations, Design, and Related configuration with various client systems.', '2023-04-18 03:35:41'),
(14, 'AC170423030441', 'Performed Solution Advisory, Solution Architect, and Team lead for various known global brands, i.e., PWC, DXC. SSBS, and IBM', '2023-04-18 03:35:41'),
(15, 'AC170423030441', 'Out of 19 Complete E2E implementation experience include 4 Implementations includes S/4 HANA', '2023-04-18 03:35:41'),
(16, 'AC170423030441', 'Involved in various Conversion, Greenfield Implementation using various data service tools like BODS, Data Service, and standard ERP upload programs, etc.', '2023-04-18 03:35:41');

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `sno` int(200) NOT NULL,
  `name` varchar(400) DEFAULT NULL,
  `parent` varchar(200) DEFAULT NULL,
  `status` varchar(200) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`sno`, `name`, `parent`, `status`) VALUES
(12, 'SAP BW CONSULTANT', NULL, NULL),
(13, 'JD Edward Consultant', NULL, NULL),
(14, 'Developer', NULL, NULL),
(7, 'Manager', NULL, NULL),
(15, 'Consultant', NULL, NULL),
(16, 'SENIOR SAP CONSULTANT', NULL, NULL),
(17, 'SAP SOLUTION ARCHITECT', NULL, NULL),
(18, 'SAP PROJECT MANAGER', NULL, NULL),
(19, 'PROGRAM MANAGER', NULL, NULL),
(20, 'SAP PROJECT DELIVERY MANAGER', NULL, NULL),
(21, 'Oracle HCM Developer', NULL, NULL),
(22, 'Python Developer', NULL, NULL),
(23, 'Senior Analyst', NULL, NULL),
(24, 'Application Developer', NULL, NULL),
(25, 'Functional Analyst', NULL, NULL),
(26, 'Project Manager', NULL, NULL),
(27, '.NET Developer', NULL, NULL),
(28, 'Training Development & Delivery ', NULL, NULL),
(29, 'Training Development & Delivery ', NULL, NULL),
(30, 'IT Technical Writer ', NULL, NULL),
(31, 'UI Designer', NULL, NULL),
(32, 'Business Analyst ', NULL, NULL),
(33, 'Chatbot Consultant / Developer', NULL, NULL),
(34, 'Content Management Specialist/Developer', NULL, NULL),
(35, 'Content Capture Consultant/Developer', NULL, NULL),
(36, 'Blockchain Consultant/ Developer', NULL, NULL),
(37, 'Data Scientist', NULL, NULL),
(38, 'UX Designer', NULL, NULL),
(39, 'SAP MES Consultant ', NULL, NULL),
(40, 'Business Development Manager', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `roles_tbl`
--

CREATE TABLE `roles_tbl` (
  `id` int(10) NOT NULL,
  `application_id` varchar(20) DEFAULT NULL,
  `roles_content` text DEFAULT NULL,
  `added_date` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `roles_tbl`
--

INSERT INTO `roles_tbl` (`id`, `application_id`, `roles_content`, `added_date`) VALUES
(1, 'AC130423080404', 'Describe your roles and responsibilities', '2023-04-14 02:21:04'),
(2, 'AC130423080425', 'Describe your roles and responsibilities', '2023-04-14 02:22:25'),
(3, 'AC130423090414', 'Develop and maintain complex web applications using various programming languages such as Java, Python, and JavaScript.', '2023-04-14 03:09:14'),
(4, 'AC130423090414', 'Collaborate with cross-functional teams including designers, QA engineers, and project managers to ensure project success.', '2023-04-14 03:15:57'),
(5, 'AC130423090414', 'Lead and manage a team of developers on multiple projects, ensuring timely delivery and high-quality work.', '2023-04-14 03:16:59'),
(6, 'AC130423090414', 'Work with clients to understand their business needs and develop customized solutions to meet those needs.', '2023-04-14 03:16:59'),
(7, 'AC130423090414', 'Implement continuous integration and deployment processes to streamline the development and delivery of applications.', '2023-04-14 03:16:59'),
(8, 'AC130423090414', 'Mentor junior developers, providing guidance and support to help them grow their skills and advance their careers.', '2023-04-14 03:16:59'),
(9, 'AC130423060429', 'test', '2023-04-14 06:37:29'),
(10, 'AC130423060416', 'test', '2023-04-14 06:42:16'),
(11, 'AC170423020413', 'kjdnfd', '2023-04-18 02:37:13'),
(12, 'AC170423020435', 'djfn', '2023-04-18 02:42:35'),
(13, 'AC170423030420', 'Software development', '2023-04-18 03:18:20'),
(14, 'AC170423030420', 'Project management', '2023-04-18 03:18:20'),
(15, 'AC170423030441', 'Coordinated activities related to identifying As-Is processes, drafting process documents with the end to end cycle, evaluating &amp; finalizing the business blueprint', '2023-04-18 03:35:41'),
(16, 'AC170423030441', 'Involved in BBP discussion, configuration, integration discussion, unit testing, Integration unit testing, including project audits like project health review &amp; project management review for SAP tower. Documented developed functional/ technical documentation, unit/ integration test scripts and end-user documentation', '2023-04-18 03:35:41');

-- --------------------------------------------------------

--
-- Table structure for table `skills_tbl`
--

CREATE TABLE `skills_tbl` (
  `id` int(10) NOT NULL,
  `application_id` varchar(20) DEFAULT NULL,
  `skills_content` text DEFAULT NULL,
  `added_date` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `skills_tbl`
--

INSERT INTO `skills_tbl` (`id`, `application_id`, `skills_content`, `added_date`) VALUES
(1, 'AC130423080404', 'What skill do you have?', '2023-04-14 02:21:04'),
(2, 'AC130423080425', 'What skill do you have?', '2023-04-14 02:22:25'),
(3, 'AC130423090414', 'Proficient in multiple programming languages such as Java, Python, JavaScript, Ruby, and C#.', '2023-04-14 03:09:14'),
(4, 'AC130423090414', 'Strong understanding of software development methodologies such as Agile and Waterfall.', '2023-04-14 03:09:14'),
(5, 'AC130423090414', 'Expertise in developing web applications using frameworks such as Spring, Django, Angular, React, and Vue.js.', '2023-04-14 03:09:14'),
(6, 'AC130423090414', 'Knowledge of cloud computing platforms such as AWS, Azure, and Google Cloud Platform.', '2023-04-14 03:09:14'),
(7, 'AC130423060429', 'test', '2023-04-14 06:37:29'),
(8, 'AC130423060416', 'test', '2023-04-14 06:42:16'),
(9, 'AC170423020413', 'skbdfkb', '2023-04-18 02:37:13'),
(10, 'AC170423020435', 'jsdndn', '2023-04-18 02:42:35'),
(11, 'AC170423030420', 'Full stack developer', '2023-04-18 03:18:20'),
(12, 'AC170423030420', 'project manager', '2023-04-18 03:18:20'),
(13, 'AC170423030420', 'team lead', '2023-04-18 03:18:20'),
(14, 'AC170423030420', 'scrum master', '2023-04-18 03:18:20'),
(15, 'AC170423030441', 'Specialised in Business Process (BPM) and Solution Design using both Top-Down and Bottom-Up Approaches.', '2023-04-18 03:35:41'),
(16, 'AC170423030441', 'Proficient in implementing ERP project stages, including requirements determination, gap analysis, business process reengineering, issue resolution, configuration, custom code specifications, testing, training, go-live assistance, and post-implementation support with the ticketing system', '2023-04-18 03:35:41'),
(17, 'AC170423030441', 'Efficient Team Leader &amp; Player, combining communication, interpersonal &amp; problem-solving skills with analytical, decision making and leadership capabilities to enhance organizational objectives', '2023-04-18 03:35:41'),
(18, 'AC170423030441', 'Adapted to various Business and Test tools, SAP- SOLMAN, ARIS, Visio, JIRA, HP-ALM and Microsoft Excel, etc', '2023-04-18 03:35:41');

-- --------------------------------------------------------

--
-- Table structure for table `subscriptions`
--

CREATE TABLE `subscriptions` (
  `id` int(11) NOT NULL,
  `employer_id` int(11) NOT NULL,
  `plan_id` int(11) DEFAULT NULL,
  `is_trial` tinyint(1) DEFAULT 0,
  `trial_end_date` date DEFAULT NULL,
  `start_date` date NOT NULL,
  `end_date` date DEFAULT NULL,
  `status` enum('active','inactive') DEFAULT 'active',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `upload_logo_tbl`
--

CREATE TABLE `upload_logo_tbl` (
  `id` int(10) NOT NULL,
  `logo_title` text DEFAULT NULL,
  `logo` text DEFAULT NULL,
  `added_date` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `upload_logo_tbl`
--

INSERT INTO `upload_logo_tbl` (`id`, `logo_title`, `logo`, `added_date`) VALUES
(2, 'Esdy', 'uploads/profile/Esdy-11682658992.png', '2023-04-28 10:44:13'),
(3, 'Mortage Technology', 'uploads/profile/Mortage Technology-11682659829.gif', '2023-04-28 11:00:29'),
(4, 'Galvanizing Success', 'uploads/profile/Galvanizing Success-11682659854.gif', '2023-04-28 11:00:54'),
(5, 'Fiserv', 'uploads/profile/Fiserv-11682659874.gif', '2023-04-28 11:01:14'),
(6, 'NICE', 'uploads/profile/NICE-11682659889.gif', '2023-04-28 11:01:29'),
(7, 'D Mart', 'uploads/profile/D Mart-11682659901.gif', '2023-04-28 11:01:41'),
(8, 'epiq', 'uploads/profile/epiq-11682659923.gif', '2023-04-28 11:02:03'),
(9, 'PHILIPS', 'uploads/profile/PHILIPS-11682659934.gif', '2023-04-28 11:02:14'),
(10, 'Mphasis', 'uploads/profile/Mphasis-11682659947.gif', '2023-04-28 11:02:27');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `applicants`
--
ALTER TABLE `applicants`
  ADD PRIMARY KEY (`sno`);

--
-- Indexes for table `certificates_tbl`
--
ALTER TABLE `certificates_tbl`
  ADD PRIMARY KEY (`id`),
  ADD KEY `emp_id` (`emp_id`);

--
-- Indexes for table `certification`
--
ALTER TABLE `certification`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `city`
--
ALTER TABLE `city`
  ADD PRIMARY KEY (`sno`);

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `education_tbl`
--
ALTER TABLE `education_tbl`
  ADD PRIMARY KEY (`id`),
  ADD KEY `emp_id` (`emp_id`);

--
-- Indexes for table `employee_skills_tbl`
--
ALTER TABLE `employee_skills_tbl`
  ADD PRIMARY KEY (`id`),
  ADD KEY `emp_id` (`emp_id`);

--
-- Indexes for table `employer_tbl`
--
ALTER TABLE `employer_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `emp_tbl`
--
ALTER TABLE `emp_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `experience_tbl`
--
ALTER TABLE `experience_tbl`
  ADD PRIMARY KEY (`id`),
  ADD KEY `emp_id` (`emp_id`);

--
-- Indexes for table `job_applications`
--
ALTER TABLE `job_applications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `locations`
--
ALTER TABLE `locations`
  ADD PRIMARY KEY (`sno`);

--
-- Indexes for table `plans`
--
ALTER TABLE `plans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`sno`),
  ADD UNIQUE KEY `seq` (`seq`);

--
-- Indexes for table `previous_exp_tbl`
--
ALTER TABLE `previous_exp_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `projects_tbl`
--
ALTER TABLE `projects_tbl`
  ADD PRIMARY KEY (`id`),
  ADD KEY `emp_id` (`emp_id`);

--
-- Indexes for table `pro_experience_tbl`
--
ALTER TABLE `pro_experience_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`sno`);

--
-- Indexes for table `roles_tbl`
--
ALTER TABLE `roles_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `skills_tbl`
--
ALTER TABLE `skills_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subscriptions`
--
ALTER TABLE `subscriptions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `employer_id` (`employer_id`),
  ADD KEY `plan_id` (`plan_id`);

--
-- Indexes for table `upload_logo_tbl`
--
ALTER TABLE `upload_logo_tbl`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `applicants`
--
ALTER TABLE `applicants`
  MODIFY `sno` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=104;

--
-- AUTO_INCREMENT for table `certificates_tbl`
--
ALTER TABLE `certificates_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `certification`
--
ALTER TABLE `certification`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `city`
--
ALTER TABLE `city`
  MODIFY `sno` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `education_tbl`
--
ALTER TABLE `education_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `employee_skills_tbl`
--
ALTER TABLE `employee_skills_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `employer_tbl`
--
ALTER TABLE `employer_tbl`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `emp_tbl`
--
ALTER TABLE `emp_tbl`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `experience_tbl`
--
ALTER TABLE `experience_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `job_applications`
--
ALTER TABLE `job_applications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `locations`
--
ALTER TABLE `locations`
  MODIFY `sno` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `plans`
--
ALTER TABLE `plans`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `post`
--
ALTER TABLE `post`
  MODIFY `sno` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=175;

--
-- AUTO_INCREMENT for table `previous_exp_tbl`
--
ALTER TABLE `previous_exp_tbl`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `projects_tbl`
--
ALTER TABLE `projects_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `pro_experience_tbl`
--
ALTER TABLE `pro_experience_tbl`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `sno` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `roles_tbl`
--
ALTER TABLE `roles_tbl`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `skills_tbl`
--
ALTER TABLE `skills_tbl`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `subscriptions`
--
ALTER TABLE `subscriptions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `upload_logo_tbl`
--
ALTER TABLE `upload_logo_tbl`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `certificates_tbl`
--
ALTER TABLE `certificates_tbl`
  ADD CONSTRAINT `certificates_tbl_ibfk_1` FOREIGN KEY (`emp_id`) REFERENCES `emp_tbl` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `education_tbl`
--
ALTER TABLE `education_tbl`
  ADD CONSTRAINT `education_tbl_ibfk_1` FOREIGN KEY (`emp_id`) REFERENCES `emp_tbl` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `employee_skills_tbl`
--
ALTER TABLE `employee_skills_tbl`
  ADD CONSTRAINT `employee_skills_tbl_ibfk_1` FOREIGN KEY (`emp_id`) REFERENCES `emp_tbl` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `experience_tbl`
--
ALTER TABLE `experience_tbl`
  ADD CONSTRAINT `experience_tbl_ibfk_1` FOREIGN KEY (`emp_id`) REFERENCES `emp_tbl` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `projects_tbl`
--
ALTER TABLE `projects_tbl`
  ADD CONSTRAINT `projects_tbl_ibfk_1` FOREIGN KEY (`emp_id`) REFERENCES `emp_tbl` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `subscriptions`
--
ALTER TABLE `subscriptions`
  ADD CONSTRAINT `subscriptions_ibfk_1` FOREIGN KEY (`employer_id`) REFERENCES `employer_tbl` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `subscriptions_ibfk_2` FOREIGN KEY (`plan_id`) REFERENCES `plans` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
