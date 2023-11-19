-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: sql105.byetcluster.com
-- Generation Time: Dec 14, 2022 at 10:48 PM
-- Server version: 10.3.27-MariaDB
-- PHP Version: 7.2.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `epiz_31809323_needy`
--

-- --------------------------------------------------------

--
-- Table structure for table `college_names`
--

CREATE TABLE `college_names` (
  `uni_id` int(11) NOT NULL,
  `college_id` int(11) NOT NULL,
  `college_name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `college_names`
--

INSERT INTO `college_names` (`uni_id`, `college_id`, `college_name`) VALUES
(1, 1, 'Acme'),
(3, 4, 'NCIT');

-- --------------------------------------------------------

--
-- Table structure for table `depart_tables`
--

CREATE TABLE `depart_tables` (
  `id` int(11) NOT NULL,
  `depart_id` varchar(11) NOT NULL,
  `depart_name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `depart_tables`
--

INSERT INTO `depart_tables` (`id`, `depart_id`, `depart_name`) VALUES
(3, 'AR', 'Architecture'),
(6, 'CH', 'Chemical'),
(1, 'CI', 'Civil'),
(2, 'CO', 'Computer'),
(4, 'EL', 'Electrical'),
(5, 'ME', 'Mechanical');

-- --------------------------------------------------------

--
-- Table structure for table `notemaker_tables`
--

CREATE TABLE `notemaker_tables` (
  `notemaker_id` int(11) NOT NULL,
  `notemaker_name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `notemaker_tables`
--

INSERT INTO `notemaker_tables` (`notemaker_id`, `notemaker_name`) VALUES
(7, 'Kalpana Karki'),
(8, 'Manisha Lama'),
(9, 'Roshani Ghimire'),
(11, 'Unknown'),
(14, 'Sushmita Dhamala'),
(15, 'Shivaraj Dhakal'),
(16, 'Masen'),
(17, 'Saroj Bista'),
(18, 'Sanjaya chauwal');

-- --------------------------------------------------------

--
-- Table structure for table `note_list`
--

CREATE TABLE `note_list` (
  `note_id` int(11) NOT NULL,
  `uni_id` int(11) NOT NULL,
  `college_id` int(11) DEFAULT NULL,
  `depart_id` varchar(11) NOT NULL,
  `semester` varchar(11) NOT NULL,
  `subject_id` varchar(11) NOT NULL,
  `notemaker_id` int(11) NOT NULL,
  `approved_status` int(20) DEFAULT NULL COMMENT '1 = approved, 2 = not approved ',
  `note` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `note_list`
--

INSERT INTO `note_list` (`note_id`, `uni_id`, `college_id`, `depart_id`, `semester`, `subject_id`, `notemaker_id`,`approved_status`, `note`) VALUES
(10, 1, 1, 'CO', 'IV', '12', 7, 1, 'NeedyE-CO1127DBMS-Chapter 1 (11 files merged).pdf'),
(11, 1, 1, 'CO', 'I', '9', 11, 1, 'NeedyE-CO1911Engg-Drawing-I-Tutorial-Solution.pdf'),
(12, 1, 1, 'CO', 'I', '11', 9, 1, 'NeedyE-CO1119lecture-notes-on-elements-devices-of-computing-tech.pdf'),
(15, 1, 1, 'CO', 'IV', '29', 14, 1, 'NeedyE-CO12914SOCIOLOGY..pdf'),
(18, 1, 1, 'CO', 'I', '10', 8, 1, 'NeedyE-CO1108computer-programming-_c_-lecture-notes.pdf'),
(20, 1, 1, 'CO', 'VI', '23', 11, 1, 'NeedyE-CO12311Computer Networks.pdf'),
(21, 1, 1, 'CI', 'VI', '38', 15, 1, 'NeedyE-CI13815FoundationNum_Soln_final_assessment-Shivaraj-Dhakal.pdf'),
(22, 1, 1, 'CO', 'V', '33', 16, 1, 'NeedyE-CO13311ResearchAndMethodology.pdf'),
(23, 1, 1, 'CO', 'VI', '24', 16, 1, 'NeedyE-CO12416EngineeringEconomic.pdf'),
(24, 1, 1, 'CO', 'V', '32', 9, 1, 'NeedyE-CO1329Compile note of OS by Roshani.pdf'),
(25, 1, 1, 'CI', 'IV', '39', 16, 1, 'NeedyE-CI13916ResearchAndMethodology.pdf'),
(26, 3, 4, 'CO', 'IV', '14', 17, 1, 'NeedyE-CO31417MALP_manual.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `semester`
--

CREATE TABLE `semester` (
  `semester` varchar(11) NOT NULL,
  `sem_name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `semester`
--

INSERT INTO `semester` (`semester`, `sem_name`) VALUES
('I', 'I'),
('II', 'II'),
('III', 'III'),
('IV', 'IV'),
('V', 'V'),
('VI', 'VI'),
('VII', 'VII'),
('VIII', 'VIII');

-- --------------------------------------------------------

--
-- Table structure for table `subject_names`
--

CREATE TABLE `subject_names` (
  `uni_id` int(11) NOT NULL,
  `depart_id` varchar(11) NOT NULL,
  `semester` varchar(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `subject_name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subject_names`
--

INSERT INTO `subject_names` (`uni_id`, `depart_id`, `semester`, `subject_id`, `subject_name`) VALUES
(1, 'CO', 'I', 7, 'Physics'),
(1, 'CO', 'I', 9, 'Engineering Drawing'),
(1, 'CO', 'I', 10, 'Computer Programming'),
(1, 'CO', 'I', 11, 'Elements Devices of Computing (EDoC)'),
(1, 'CO', 'IV', 12, 'Database Management System (DBMS)'),
(1, 'CO', 'IV', 13, 'Communication System'),
(1, 'CO', 'IV', 14, 'Microprocessor'),
(1, 'CO', 'II', 15, 'Applied Mechanics'),
(1, 'CO', 'II', 16, 'Object Oriented Programming (OOP)'),
(1, 'CO', 'II', 17, 'Chemistry'),
(1, 'CO', 'II', 18, 'Digital Logic'),
(1, 'CO', 'II', 19, 'Electrical Engineering'),
(1, 'CO', 'III', 20, 'Computer Organization and desigh (COD)'),
(1, 'CO', 'III', 21, 'Data structure and Algorithm (DSA)'),
(1, 'CO', 'III', 22, 'Information System Design( ISD)'),
(1, 'CO', 'VI', 23, 'Computer Networks'),
(1, 'CO', 'VI', 24, 'Engineering Economics'),
(1, 'CO', 'VI', 25, 'Multimedia Computing and technology'),
(1, 'CO', 'VI', 26, 'Project and Organization Management'),
(1, 'CO', 'VI', 27, 'Theory Of Computation (TOC)'),
(1, 'CO', 'IV', 28, 'Free and Open Source Programming (FOSP)'),
(1, 'CO', 'IV', 29, 'Applied Sociology'),
(1, 'CO', 'V', 30, 'Algorithm Analysis and Design'),
(1, 'CO', 'V', 31, 'Computer Graphics'),
(1, 'CO', 'V', 32, 'Operating System'),
(1, 'CO', 'V', 33, 'Research Methodology'),
(1, 'CO', 'III', 35, 'Electronic Devices Circuit (EDC)'),
(1, 'CI', 'VI', 38, 'Foundation Engineering'),
(1, 'CI', 'IV', 39, 'Research Methodology');

-- --------------------------------------------------------

--
-- Table structure for table `subscriber_info`
--

CREATE TABLE `subscriber_info` (
  `subs_id` int(11) NOT NULL,
  `subscriber_email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subscriber_info`
--

INSERT INTO `subscriber_info` (`subs_id`, `subscriber_email`) VALUES
(1, 'me@gmail.com'),
(2, 'shisir.rai@acme.edu.np'),
(5, 'haha@gmail.com'),
(6, 'techymanjil96@gamail.com');

-- --------------------------------------------------------

--
-- Table structure for table `uni_tables`
--

CREATE TABLE `uni_tables` (
  `uni_id` int(11) NOT NULL,
  `uni_name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `uni_tables`
--

INSERT INTO `uni_tables` (`uni_id`, `uni_name`) VALUES
(1, 'Purbanchal'),
(2, 'Tribhuvan (TU)'),
(3, 'Pokhara');

-- --------------------------------------------------------

--
-- Table structure for table `user_info`
--

CREATE TABLE `user_info` (
  `id` int(11) NOT NULL,
  `user_name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(200) DEFAULT NULL,
  `role` int(20) DEFAULT NULL COMMENT '1 = admin, 2 = user ',
  `p_image` varchar(33) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_info`
--

INSERT INTO `user_info` (`id`, `user_name`, `email`, `password`, `role`, `p_image`) VALUES
(1, 'subarna', 'hello@gmail.com', 'Hello123', 1, 'SAM_2677.JPG'),
(18, 'Subodh', 'asubodh45@gmail.com', '12345678', 1, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `college_names`
--
ALTER TABLE `college_names`
  ADD PRIMARY KEY (`college_id`);

--
-- Indexes for table `depart_tables`
--
ALTER TABLE `depart_tables`
  ADD PRIMARY KEY (`depart_id`);

--
-- Indexes for table `notemaker_tables`
--
ALTER TABLE `notemaker_tables`
  ADD PRIMARY KEY (`notemaker_id`);

--
-- Indexes for table `note_list`
--
ALTER TABLE `note_list`
  ADD PRIMARY KEY (`note_id`);

--
-- Indexes for table `subject_names`
--
ALTER TABLE `subject_names`
  ADD PRIMARY KEY (`subject_id`);

--
-- Indexes for table `subscriber_info`
--
ALTER TABLE `subscriber_info`
  ADD PRIMARY KEY (`subs_id`);

--
-- Indexes for table `uni_tables`
--
ALTER TABLE `uni_tables`
  ADD PRIMARY KEY (`uni_id`);

--
-- Indexes for table `user_info`
--
ALTER TABLE `user_info`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `college_names`
--
ALTER TABLE `college_names`
  MODIFY `college_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `notemaker_tables`
--
ALTER TABLE `notemaker_tables`
  MODIFY `notemaker_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `note_list`
--
ALTER TABLE `note_list`
  MODIFY `note_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `subject_names`
--
ALTER TABLE `subject_names`
  MODIFY `subject_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `subscriber_info`
--
ALTER TABLE `subscriber_info`
  MODIFY `subs_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `uni_tables`
--
ALTER TABLE `uni_tables`
  MODIFY `uni_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user_info`
--
ALTER TABLE `user_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
