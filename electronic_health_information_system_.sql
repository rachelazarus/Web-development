-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 26, 2024 at 02:53 PM
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
-- Database: `electronic_health_information_system;`
--

-- --------------------------------------------------------

--
-- Table structure for table `appointments`
--

CREATE TABLE `appointments` (
  `Appointment_ID` int(11) NOT NULL,
  `Year` int(11) NOT NULL,
  `Month` int(11) NOT NULL,
  `Day` int(11) NOT NULL,
  `TimeSlot` time NOT NULL,
  `Patient_id` int(11) NOT NULL,
  `Doctor_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `doctors`
--

CREATE TABLE `doctors` (
  `Doctors_id` int(11) NOT NULL,
  `Profile_picture_path` varchar(255) NOT NULL,
  `Fullname` varchar(255) NOT NULL,
  `Age` int(11) NOT NULL,
  `Specialization` varchar(255) NOT NULL,
  `Contact_number` varchar(50) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Hire_date` datetime NOT NULL,
  `password` varchar(255) NOT NULL,
  `Availability` tinyint(1) NOT NULL,
  `Number_of_patient_record_entries` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `doctors`
--

INSERT INTO `doctors` (`Doctors_id`, `Profile_picture_path`, `Fullname`, `Age`, `Specialization`, `Contact_number`, `Email`, `Hire_date`, `password`, `Availability`, `Number_of_patient_record_entries`) VALUES
(1, '', 'Dr. John Mukuve', 46, 'General Practitioner', '0612345700', 'john.mukuve@gmail.com', '2024-10-26 14:27:31', 'doctorpass1', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `patients`
--

CREATE TABLE `patients` (
  `Patient_id` int(50) NOT NULL,
  `Profile_picture_path` varchar(255) NOT NULL,
  `Fullname` varchar(255) NOT NULL,
  `Age` int(11) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Contact_number` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `Number_of_records_entries` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `patients`
--

INSERT INTO `patients` (`Patient_id`, `Profile_picture_path`, `Fullname`, `Age`, `Email`, `Contact_number`, `password`, `Number_of_records_entries`) VALUES
(1, '', 'Tafara Kanyanga', 30, 'tafara.kanyanga@gmail.com', '+264812345678', 'password1', 2),
(2, '', 'Sophie Nujoma', 25, 'sophie.nujoma@gmail.com', '+264812345679', 'password2', 3),
(3, '', 'Elijah Kwangura', 40, 'elijah.kwangura@gmail.com', '+264812345680', 'password3', 7);

-- --------------------------------------------------------

--
-- Table structure for table `patient_record_entries`
--

CREATE TABLE `patient_record_entries` (
  `Record_entry_id` int(11) NOT NULL,
  `Temperature` float NOT NULL,
  `Weight` float NOT NULL,
  `Sickness_description` varchar(255) NOT NULL,
  `Diagnoses` varchar(255) NOT NULL,
  `Prescriptions` varchar(255) NOT NULL,
  `Patient_id` int(11) NOT NULL,
  `Doctors_id` int(11) NOT NULL,
  `Date_of_entry` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `patient_record_entries`
--

INSERT INTO `patient_record_entries` (`Record_entry_id`, `Temperature`, `Weight`, `Sickness_description`, `Diagnoses`, `Prescriptions`, `Patient_id`, `Doctors_id`, `Date_of_entry`) VALUES
(1, 98.6, 99.1, 'Flu-like symptoms', 'Influenza', 'Paracetamol 500mg', 1, 1, '2024-10-26 14:31:05');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appointments`
--
ALTER TABLE `appointments`
  ADD PRIMARY KEY (`Appointment_ID`),
  ADD KEY `app_doctorid_FK` (`Doctor_id`),
  ADD KEY `app_patientid_FK` (`Patient_id`);

--
-- Indexes for table `doctors`
--
ALTER TABLE `doctors`
  ADD PRIMARY KEY (`Doctors_id`);

--
-- Indexes for table `patients`
--
ALTER TABLE `patients`
  ADD PRIMARY KEY (`Patient_id`);

--
-- Indexes for table `patient_record_entries`
--
ALTER TABLE `patient_record_entries`
  ADD PRIMARY KEY (`Record_entry_id`),
  ADD KEY `record_doctorID_FK` (`Doctors_id`),
  ADD KEY `record_pateintID_FK` (`Patient_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `appointments`
--
ALTER TABLE `appointments`
  MODIFY `Appointment_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `doctors`
--
ALTER TABLE `doctors`
  MODIFY `Doctors_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `patients`
--
ALTER TABLE `patients`
  MODIFY `Patient_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `patient_record_entries`
--
ALTER TABLE `patient_record_entries`
  MODIFY `Record_entry_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `appointments`
--
ALTER TABLE `appointments`
  ADD CONSTRAINT `app_doctorid_FK` FOREIGN KEY (`Doctor_id`) REFERENCES `doctors` (`Doctors_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `app_patientid_FK` FOREIGN KEY (`Patient_id`) REFERENCES `patients` (`Patient_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `patient_record_entries`
--
ALTER TABLE `patient_record_entries`
  ADD CONSTRAINT `record_doctorID_FK` FOREIGN KEY (`Doctors_id`) REFERENCES `doctors` (`Doctors_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `record_pateintID_FK` FOREIGN KEY (`Patient_id`) REFERENCES `patients` (`Patient_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
