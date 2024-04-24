-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 24, 2024 at 09:47 AM
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
-- Database: `qr_attendance_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_attendance`
--

CREATE TABLE `tbl_attendance` (
  `tbl_attendance_id` int(11) NOT NULL,
  `tbl_student_id` int(11) NOT NULL,
  `time_in` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbl_attendance`
--

INSERT INTO `tbl_attendance` (`tbl_attendance_id`, `tbl_student_id`, `time_in`) VALUES
(11, 3, '2024-04-23 20:54:37'),
(12, 3, '2024-04-23 21:00:18'),
(13, 3, '2024-04-23 21:01:30'),
(14, 7, '2024-04-24 01:41:23');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_student`
--

CREATE TABLE `tbl_student` (
  `tbl_student_id` int(11) NOT NULL,
  `student_name` varchar(255) NOT NULL,
  `course_section` varchar(255) NOT NULL,
  `generated_code` varchar(255) NOT NULL,
  `profile_picture` varchar(255) NOT NULL DEFAULT 'default.jpeg'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbl_student`
--

INSERT INTO `tbl_student` (`tbl_student_id`, `student_name`, `course_section`, `generated_code`, `profile_picture`) VALUES
(1, 'Neal Aaron Alvarez', 'STEM', 'neal', './profile_pictures/default.jpg.jpeg'),
(2, 'Ronne Harlie Balonso ', 'STEM', 'ronne', ''),
(3, 'Marc Angelo Bongar', 'STEM', 'marc', ''),
(4, 'Rylee Alyxiz Cardiño', 'STEM', 'rylee', ''),
(5, 'Mark Anthony Domingo ', 'STEM', 'mark', ''),
(6, 'Jhann Henrie Dueñas', 'STEM', 'jhann', ''),
(7, 'Kevin Grabriel Gonzales ', 'STEM', 'kevin', ''),
(8, 'Adrian Rafael Inocando', 'STEM', 'adrian', ''),
(9, 'Gabriel Miguel Magtalas ', 'STEM', 'gabriel', ''),
(10, 'Venise Rodge  Maniego', 'STEM', 'rodge', ''),
(11, 'Kenneth Mariano', 'STEM', 'kenneth', ''),
(12, 'Renz Moises Natividad', 'STEM', 'renz', ''),
(13, 'John Flovd Arvey Navarro', 'STEM', 'john', ''),
(14, 'Carl Loren Pahayahay ', 'STEM', 'loren', ''),
(15, 'Harvey Pengson', 'STEM', 'harvey', ''),
(16, 'Jose Miguel Samson', 'STEM', 'jose', ''),
(17, 'Tristan Patrick San Roque', 'STEM', 'tristan', ''),
(18, 'Ralph Tristan Santos', 'STEM', 'ralph', ''),
(19, 'John Leigh Ric Vinoya', 'STEM', 'john', ''),
(20, 'Carl Gabriel Vitalista ', 'STEM', 'carl', ''),
(21, 'Jociel Abellana', 'STEM', 'jociel', ''),
(22, 'Micah Daniela Cayetano', 'STEM', 'micah', ''),
(23, 'Reina Trishia Cuestas', 'STEM', 'trishia', ''),
(24, 'Shemiah Pearl Cuestas', 'STEM', 'shemiah', ''),
(25, 'Khryztine Angela Leoncio', 'STEM', 'khryztine', ''),
(26, 'Francine Martinez', 'STEM', 'francine', ''),
(27, 'Nicole Masadao', 'STEM', 'nicoleM', ''),
(28, 'Nicole Peñalosa', 'STEM', 'nicoleP', 'profile_pictures/default.jpg.jpeg'),
(29, 'Arisa Sakakibara', 'STEM', 'arisa', ''),
(30, 'Charlotte Theseira', 'STEM', 'charlotte', 'profile_pictures/default.jpg.jpeg'),
(31, 'Angela Jade Yasis', 'STEM', 'jade', '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

CREATE TABLE `tbl_users` (
  `tbl_student_id` int(11) NOT NULL,
  `email` varchar(25) NOT NULL,
  `password` char(255) NOT NULL,
  `profile_picture` varchar(255) NOT NULL DEFAULT 'default.jpg'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`tbl_student_id`, `email`, `password`, `profile_picture`) VALUES
(1, 'Alvarez@gmail.com', 'Alvarez01', 'default.jpg'),
(2, 'Balonso@gmail.com', 'Balonso02', 'default.jpg'),
(3, 'Bongar@gmail.com', 'Bongar03', 'default.jpg'),
(4, 'Cardino@gmail.com', 'Cardino04', 'default.jpg'),
(5, 'Domingo@gmail.com', 'Domingo05', 'default.jpg'),
(6, 'Duenas@gmail.com', 'Duenas06', 'default.jpg'),
(7, 'Gonzales@gmail.com', 'Gonzales07', 'default.jpg'),
(8, 'Inocando@gmail.com', 'Inocando08', 'default.jpg'),
(9, 'Magtalas@gmail.com', 'Magtalas09', 'default.jpg'),
(10, 'Maniego@gmail.com', 'Maniego10', 'default.jpg'),
(11, 'Mariano@gmail.com', 'Mariano11', 'default.jpg'),
(12, 'Natividad@gmail.com', 'Natividad12', 'default.jpg'),
(13, 'Navarro@gmail.com', 'Navarro13', 'default.jpg'),
(14, 'Pahayahay@gmail.com', 'Pahayahay14', 'default.jpg'),
(15, 'Pengson@gmail.com', 'Pengson15', 'default.jpg'),
(16, 'Samson@gmail.com', 'Samson16', 'default.jpg'),
(17, 'SanRoque@gmail.com', 'SanRoque17', 'default.jpg'),
(18, 'Santos@gmail.com', 'Santos18', 'default.jpg'),
(19, 'Vinoya@gmail.com', 'Vinoya19', 'default.jpg'),
(20, 'Vitalista@gmail.com', 'Vitalista20', 'default.jpg'),
(21, 'Abellana@gmail.com', 'Abellana21', 'default.jpg'),
(22, 'Cayetano@gmail.com', 'Cayetano22', 'default.jpg'),
(23, 'R.Cuestas@gmail.com', 'R.Cuestas23', 'default.jpg'),
(24, 'S.Cuestas@gmail.com', 'S.Cuestas24', 'default.jpg'),
(25, 'Leoncio@gmail.com', 'Leoncio25', 'default.jpg'),
(26, 'Martinez@gmail.com', 'Martinez26', 'default.jpg'),
(27, 'Masadao@gmail.com', 'Masadao27', 'default.jpg'),
(28, 'Penalosa@gmail.com', 'Penalosa28', 'default.jpg'),
(29, 'Sakakibara@gmail.com', 'Sakakibara29', 'default.jpg'),
(30, 'Theseira@gmail.com', 'Theseira30', 'profile_pictures/wallpaper.png'),
(31, 'Yasis@gmail.com', 'Yasis31', 'default.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_attendance`
--
ALTER TABLE `tbl_attendance`
  ADD PRIMARY KEY (`tbl_attendance_id`);

--
-- Indexes for table `tbl_student`
--
ALTER TABLE `tbl_student`
  ADD PRIMARY KEY (`tbl_student_id`);

--
-- Indexes for table `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD PRIMARY KEY (`tbl_student_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_attendance`
--
ALTER TABLE `tbl_attendance`
  MODIFY `tbl_attendance_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `tbl_student`
--
ALTER TABLE `tbl_student`
  MODIFY `tbl_student_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD CONSTRAINT `tbl_users_ibfk_1` FOREIGN KEY (`tbl_student_id`) REFERENCES `tbl_student` (`tbl_student_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
