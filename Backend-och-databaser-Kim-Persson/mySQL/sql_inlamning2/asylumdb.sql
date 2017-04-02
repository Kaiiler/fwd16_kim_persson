-- phpMyAdmin SQL Dump
-- version 4.4.15.5
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1:3306
-- Generation Time: Mar 31, 2017 at 01:18 PM
-- Server version: 5.6.34-log
-- PHP Version: 7.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `asylumdb`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `srcDiagnosis`(IN `arr` INT(11))
    NO SQL
BEGIN
SELECT COUNT(*), diagnosisID FROM `patient/diagnosis` WHERE diagnosisID = arr;
 
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `srcDoctor`(IN `arr` INT(11))
    NO SQL
BEGIN
SELECT 
    doctor.firstName as doctorfirst,
    doctor.lastName as doctorlast,
    doctor.doctorID,
    patient.firstName as patientfirst,
    patient.lastName as patientlast,
    patient.patientID
    FROM patient
    INNER JOIN doctor on docID = doctor.doctorID
    WHERE doctorID = arr;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `srcMedication`(IN `arr` INT(11))
    NO SQL
BEGIN
SELECT medicineID, medicineName, doseOZ, diagnosis.diagnosisName
    FROM medicine
    INNER JOIN diagnosis ON medicine.medicineID = diagnosis.diagnosisID
    WHERE diagnosis.diagnosisID = arr;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `srcNurse`(IN `arr` INT(11))
    NO SQL
BEGIN
SELECT 
    nurse.nurseID,
    nurse.firstName as nursefirst,
    nurse.lastName as nurselast,
    patient.patientID,
    patient.firstName as patientfirst,
    patient.lastName as patientlast
    FROM ((`nurse/patient`
    INNER JOIN nurse ON `nurse/patient`.nurseID = nurse.nurseID)
    INNER JOIN patient ON `nurse/patient`.patientID  = patient.patientID)
    WHERE nurse.nurseID = arr;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `srcSickness`(IN `arr` VARCHAR(255))
    NO SQL
BEGIN
    SELECT COUNT(*), diagnosis.diagnosisName, diagnosis.diagnosisID 
    FROM `patient/diagnosis` 
    INNER JOIN diagnosis ON `patient/diagnosis`.diagnosisID = diagnosis.diagnosisID 
    WHERE diagnosis.diagnosisName = arr;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `diagnosis`
--

CREATE TABLE IF NOT EXISTS `diagnosis` (
  `diagnosisID` int(11) NOT NULL,
  `diagnosisName` varchar(255) NOT NULL,
  `medID` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `diagnosis`
--

INSERT INTO `diagnosis` (`diagnosisID`, `diagnosisName`, `medID`) VALUES
(3, 'Poisoned', 6),
(4, 'Rabies', 4),
(5, 'Osteoperosis', 5);

-- --------------------------------------------------------

--
-- Table structure for table `doctor`
--

CREATE TABLE IF NOT EXISTS `doctor` (
  `doctorID` int(11) NOT NULL,
  `firstName` varchar(255) NOT NULL,
  `lastName` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `doctor`
--

INSERT INTO `doctor` (`doctorID`, `firstName`, `lastName`) VALUES
(1, 'Lars-Inge', 'Larsson'),
(2, 'Anne', 'Ahl'),
(3, 'Johan', 'Heskebeck'),
(4, 'Rick', 'Sanchez');

-- --------------------------------------------------------

--
-- Table structure for table `medicine`
--

CREATE TABLE IF NOT EXISTS `medicine` (
  `medicineID` int(11) NOT NULL,
  `medicineName` varchar(255) NOT NULL,
  `doseOZ` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `medicine`
--

INSERT INTO `medicine` (`medicineID`, `medicineName`, `doseOZ`) VALUES
(4, 'antiRabies', 2),
(5, 'antiOsteoperosis', 5),
(6, 'antidote', 10);

-- --------------------------------------------------------

--
-- Table structure for table `nurse`
--

CREATE TABLE IF NOT EXISTS `nurse` (
  `nurseID` int(11) NOT NULL,
  `firstName` varchar(255) NOT NULL,
  `lastName` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `nurse`
--

INSERT INTO `nurse` (`nurseID`, `firstName`, `lastName`) VALUES
(1, 'Bettan', 'Nilsson'),
(2, 'Hans-Eric', 'Åkesson');

-- --------------------------------------------------------

--
-- Table structure for table `nurse/patient`
--

CREATE TABLE IF NOT EXISTS `nurse/patient` (
  `nurseID` int(11) NOT NULL,
  `patientID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `nurse/patient`
--

INSERT INTO `nurse/patient` (`nurseID`, `patientID`) VALUES
(1, 3),
(2, 4),
(1, 5),
(2, 5),
(2, 6);

-- --------------------------------------------------------

--
-- Table structure for table `patient`
--

CREATE TABLE IF NOT EXISTS `patient` (
  `patientID` int(11) NOT NULL,
  `firstName` varchar(255) NOT NULL,
  `lastName` varchar(255) NOT NULL,
  `docID` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `patient`
--

INSERT INTO `patient` (`patientID`, `firstName`, `lastName`, `docID`) VALUES
(3, 'Kim', 'Persson', 1),
(4, 'Tim', 'Persson', 2),
(5, 'Jim', 'Persson', 2),
(6, 'Rim', 'Persson', 3);

-- --------------------------------------------------------

--
-- Table structure for table `patient/diagnosis`
--

CREATE TABLE IF NOT EXISTS `patient/diagnosis` (
  `patientID` int(11) NOT NULL,
  `diagnosisID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `patient/diagnosis`
--

INSERT INTO `patient/diagnosis` (`patientID`, `diagnosisID`) VALUES
(3, 3),
(6, 3),
(3, 4),
(4, 4),
(5, 5);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_doctorpatient`
--
CREATE TABLE IF NOT EXISTS `v_doctorpatient` (
`doctorfirst` varchar(255)
,`doctorlast` varchar(255)
,`doctorID` int(11)
,`patientfirst` varchar(255)
,`patientlast` varchar(255)
,`patientID` int(11)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_medicationsickness`
--
CREATE TABLE IF NOT EXISTS `v_medicationsickness` (
`medicineID` int(11)
,`medicineName` varchar(255)
,`doseOZ` int(11)
,`diagnosisName` varchar(255)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_patientsnurses`
--
CREATE TABLE IF NOT EXISTS `v_patientsnurses` (
`nurseID` int(11)
,`nursefirst` varchar(255)
,`nurselast` varchar(255)
,`patientID` int(11)
,`patientfirst` varchar(255)
,`patientlast` varchar(255)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_sicknesses`
--
CREATE TABLE IF NOT EXISTS `v_sicknesses` (
`COUNT(*)` bigint(21)
,`diagnosisID` int(11)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_sickpeople`
--
CREATE TABLE IF NOT EXISTS `v_sickpeople` (
`COUNT(patientID)` bigint(21)
);

-- --------------------------------------------------------

--
-- Structure for view `v_doctorpatient`
--
DROP TABLE IF EXISTS `v_doctorpatient`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_doctorpatient` AS select `doctor`.`firstName` AS `doctorfirst`,`doctor`.`lastName` AS `doctorlast`,`doctor`.`doctorID` AS `doctorID`,`patient`.`firstName` AS `patientfirst`,`patient`.`lastName` AS `patientlast`,`patient`.`patientID` AS `patientID` from (`patient` join `doctor` on((`patient`.`docID` = `doctor`.`doctorID`))) where (`doctor`.`doctorID` = 2);

-- --------------------------------------------------------

--
-- Structure for view `v_medicationsickness`
--
DROP TABLE IF EXISTS `v_medicationsickness`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_medicationsickness` AS select `medicine`.`medicineID` AS `medicineID`,`medicine`.`medicineName` AS `medicineName`,`medicine`.`doseOZ` AS `doseOZ`,`diagnosis`.`diagnosisName` AS `diagnosisName` from (`medicine` join `diagnosis` on((`medicine`.`medicineID` = `diagnosis`.`diagnosisID`)));

-- --------------------------------------------------------

--
-- Structure for view `v_patientsnurses`
--
DROP TABLE IF EXISTS `v_patientsnurses`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_patientsnurses` AS select `nurse`.`nurseID` AS `nurseID`,`nurse`.`firstName` AS `nursefirst`,`nurse`.`lastName` AS `nurselast`,`patient`.`patientID` AS `patientID`,`patient`.`firstName` AS `patientfirst`,`patient`.`lastName` AS `patientlast` from ((`nurse/patient` join `nurse` on((`nurse/patient`.`nurseID` = `nurse`.`nurseID`))) join `patient` on((`nurse/patient`.`patientID` = `patient`.`patientID`)));

-- --------------------------------------------------------

--
-- Structure for view `v_sicknesses`
--
DROP TABLE IF EXISTS `v_sicknesses`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_sicknesses` AS select count(0) AS `COUNT(*)`,`patient/diagnosis`.`diagnosisID` AS `diagnosisID` from `patient/diagnosis` group by `patient/diagnosis`.`diagnosisID`;

-- --------------------------------------------------------

--
-- Structure for view `v_sickpeople`
--
DROP TABLE IF EXISTS `v_sickpeople`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_sickpeople` AS select count(`patient`.`patientID`) AS `COUNT(patientID)` from `patient`;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `diagnosis`
--
ALTER TABLE `diagnosis`
  ADD PRIMARY KEY (`diagnosisID`),
  ADD KEY `medID` (`medID`);

--
-- Indexes for table `doctor`
--
ALTER TABLE `doctor`
  ADD PRIMARY KEY (`doctorID`);

--
-- Indexes for table `medicine`
--
ALTER TABLE `medicine`
  ADD PRIMARY KEY (`medicineID`);

--
-- Indexes for table `nurse`
--
ALTER TABLE `nurse`
  ADD PRIMARY KEY (`nurseID`);

--
-- Indexes for table `nurse/patient`
--
ALTER TABLE `nurse/patient`
  ADD PRIMARY KEY (`nurseID`,`patientID`),
  ADD KEY `fk_pp` (`patientID`);

--
-- Indexes for table `patient`
--
ALTER TABLE `patient`
  ADD PRIMARY KEY (`patientID`),
  ADD KEY `docID` (`docID`);

--
-- Indexes for table `patient/diagnosis`
--
ALTER TABLE `patient/diagnosis`
  ADD PRIMARY KEY (`patientID`,`diagnosisID`),
  ADD KEY `fk_dd` (`diagnosisID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `diagnosis`
--
ALTER TABLE `diagnosis`
  MODIFY `diagnosisID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `doctor`
--
ALTER TABLE `doctor`
  MODIFY `doctorID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `medicine`
--
ALTER TABLE `medicine`
  MODIFY `medicineID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `nurse`
--
ALTER TABLE `nurse`
  MODIFY `nurseID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `patient`
--
ALTER TABLE `patient`
  MODIFY `patientID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `diagnosis`
--
ALTER TABLE `diagnosis`
  ADD CONSTRAINT `diagnosis_ibfk_1` FOREIGN KEY (`medID`) REFERENCES `medicine` (`medicineID`);

--
-- Constraints for table `nurse/patient`
--
ALTER TABLE `nurse/patient`
  ADD CONSTRAINT `fk_nn` FOREIGN KEY (`nurseID`) REFERENCES `nurse` (`nurseID`),
  ADD CONSTRAINT `fk_pp` FOREIGN KEY (`patientID`) REFERENCES `patient` (`patientID`);

--
-- Constraints for table `patient`
--
ALTER TABLE `patient`
  ADD CONSTRAINT `patient_ibfk_1` FOREIGN KEY (`docID`) REFERENCES `doctor` (`doctorID`);

--
-- Constraints for table `patient/diagnosis`
--
ALTER TABLE `patient/diagnosis`
  ADD CONSTRAINT `fk_dd` FOREIGN KEY (`diagnosisID`) REFERENCES `diagnosis` (`diagnosisID`),
  ADD CONSTRAINT `fk_pptwo` FOREIGN KEY (`patientID`) REFERENCES `patient` (`patientID`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
