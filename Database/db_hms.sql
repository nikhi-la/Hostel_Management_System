-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 30, 2025 at 07:47 PM
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
-- Database: `db_hms`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_attendance`
--

CREATE TABLE `tbl_attendance` (
  `attendance_id` int(11) NOT NULL,
  `attendance_date` date NOT NULL,
  `user_id` varchar(20) NOT NULL,
  `attendance_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_attendance`
--

INSERT INTO `tbl_attendance` (`attendance_id`, `attendance_date`, `user_id`, `attendance_status`) VALUES
(1, '2025-02-01', 'S0001', 0),
(2, '2025-02-02', 'S0001', 0),
(3, '2025-02-03', 'S0001', 1),
(4, '2025-02-04', 'S0001', 1),
(5, '2025-02-05', 'S0001', 1),
(6, '2025-02-06', 'S0001', 1),
(7, '2025-02-07', 'S0001', 1),
(8, '2025-02-08', 'S0001', 0),
(9, '2025-02-09', 'S0001', 0),
(10, '2025-02-10', 'S0001', 1),
(11, '2025-02-11', 'S0001', 1),
(12, '2025-02-12', 'S0001', 1),
(13, '2025-02-13', 'S0001', 1),
(14, '2025-02-14', 'S0001', 1),
(15, '2025-02-15', 'S0001', 0),
(16, '2025-02-16', 'S0001', 0),
(17, '2025-02-17', 'S0001', 1),
(18, '2025-02-18', 'S0001', 1),
(19, '2025-02-19', 'S0001', 1),
(20, '2025-02-20', 'S0001', 1),
(21, '2025-02-21', 'S0001', 1),
(22, '2025-02-22', 'S0001', 0),
(23, '2025-02-23', 'S0001', 0),
(24, '2025-02-24', 'S0001', 1),
(25, '2025-02-25', 'S0001', 1),
(26, '2025-02-26', 'S0001', 1),
(27, '2025-02-27', 'S0001', 1),
(28, '2025-02-28', 'S0001', 1),
(29, '2025-03-01', 'S0001', 0),
(30, '2025-03-02', 'S0001', 0),
(31, '2025-03-03', 'S0001', 1),
(32, '2025-03-04', 'S0001', 1),
(33, '2025-03-05', 'S0001', 1),
(34, '2025-03-06', 'S0001', 1),
(35, '2025-03-07', 'S0001', 1),
(36, '2025-03-08', 'S0001', 0),
(37, '2025-03-09', 'S0001', 0),
(38, '2025-03-10', 'S0001', 1),
(39, '2025-03-11', 'S0001', 1),
(40, '2025-03-12', 'S0001', 1),
(41, '2025-03-13', 'S0001', 1),
(42, '2025-03-14', 'S0001', 1),
(43, '2025-03-15', 'S0001', 0),
(44, '2025-03-16', 'S0001', 0),
(45, '2025-03-17', 'S0001', 1),
(46, '2025-03-18', 'S0001', 1),
(47, '2025-03-19', 'S0001', 1),
(48, '2025-03-20', 'S0001', 1),
(49, '2025-03-21', 'S0001', 1),
(50, '2025-03-22', 'S0001', 0),
(51, '2025-03-23', 'S0001', 0),
(52, '2025-03-24', 'S0001', 1),
(53, '2025-03-25', 'S0001', 1),
(54, '2025-03-26', 'S0001', 1),
(55, '2025-03-27', 'S0001', 1),
(56, '2025-03-28', 'S0001', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_basic`
--

CREATE TABLE `tbl_basic` (
  `basic_id` int(11) NOT NULL,
  `floor_count` int(11) NOT NULL,
  `mess_expense` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_basic`
--

INSERT INTO `tbl_basic` (`basic_id`, `floor_count`, `mess_expense`) VALUES
(1, 7, 2000);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_complaint`
--

CREATE TABLE `tbl_complaint` (
  `complaint_id` int(11) NOT NULL,
  `complaint` varchar(500) NOT NULL,
  `complaint_date` date NOT NULL,
  `user_id` varchar(20) NOT NULL,
  `reply_date` date DEFAULT NULL,
  `complaint_reply` varchar(500) DEFAULT NULL,
  `complaint_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_hostelrentpayment`
--

CREATE TABLE `tbl_hostelrentpayment` (
  `rent_id` int(11) NOT NULL,
  `hostelrent_month` int(11) NOT NULL,
  `hostelrent_year` int(11) NOT NULL,
  `user_id` varchar(20) NOT NULL,
  `room_share` int(11) NOT NULL,
  `room_rent` int(11) NOT NULL,
  `payment_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_hostelrentpayment`
--

INSERT INTO `tbl_hostelrentpayment` (`rent_id`, `hostelrent_month`, `hostelrent_year`, `user_id`, `room_share`, `room_rent`, `payment_status`) VALUES
(1, 2, 2025, 'S0001', 2, 6000, 1),
(2, 3, 2025, 'S0001', 2, 6000, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_leave`
--

CREATE TABLE `tbl_leave` (
  `leave_id` int(11) NOT NULL,
  `user_id` varchar(20) NOT NULL,
  `from_date` date NOT NULL,
  `to_date` date NOT NULL,
  `applied_date` date NOT NULL,
  `leave_reason` varchar(500) NOT NULL,
  `leave_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_leave`
--

INSERT INTO `tbl_leave` (`leave_id`, `user_id`, `from_date`, `to_date`, `applied_date`, `leave_reason`, `leave_status`) VALUES
(1, 'S0001', '2025-04-01', '2025-04-04', '2025-03-29', 'IV from college', 2);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_mess`
--

CREATE TABLE `tbl_mess` (
  `mess_id` int(11) NOT NULL,
  `mess_date` date NOT NULL,
  `breakfast` varchar(100) NOT NULL,
  `lunch` varchar(100) NOT NULL,
  `tea_time` varchar(100) NOT NULL,
  `dinner` varchar(100) NOT NULL,
  `veg_status` int(11) NOT NULL,
  `nonveg_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_messfee`
--

CREATE TABLE `tbl_messfee` (
  `messfee_id` int(11) NOT NULL,
  `month` int(11) NOT NULL,
  `year` int(11) NOT NULL,
  `user_id` varchar(11) NOT NULL,
  `present_count` int(11) NOT NULL,
  `mess_fees` int(11) NOT NULL,
  `added_date` date NOT NULL,
  `payment_status` int(11) NOT NULL,
  `payed_date` date DEFAULT NULL,
  `due_amount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_messfee`
--

INSERT INTO `tbl_messfee` (`messfee_id`, `month`, `year`, `user_id`, `present_count`, `mess_fees`, `added_date`, `payment_status`, `payed_date`, `due_amount`) VALUES
(1, 2, 2025, 'S0001', 20, 2000, '2025-03-01', 1, '2025-03-29', 200),
(2, 3, 2025, 'S0001', 19, 2000, '2025-03-29', 1, '2025-03-29', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_messpreference`
--

CREATE TABLE `tbl_messpreference` (
  `messpreference_id` int(11) NOT NULL,
  `mess_id` int(11) NOT NULL,
  `user_id` varchar(20) NOT NULL,
  `preference_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_movement`
--

CREATE TABLE `tbl_movement` (
  `movement_id` int(11) NOT NULL,
  `user_id` varchar(20) NOT NULL,
  `out_date` date NOT NULL,
  `out_time` varchar(10) NOT NULL,
  `in_date` date DEFAULT NULL,
  `in_time` varchar(10) DEFAULT NULL,
  `reason` varchar(50) NOT NULL,
  `out_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_parent`
--

CREATE TABLE `tbl_parent` (
  `user_id` varchar(20) NOT NULL,
  `student_id` varchar(20) NOT NULL,
  `verification_status` int(11) NOT NULL,
  `parent_name` varchar(20) NOT NULL,
  `parent_relation` varchar(20) NOT NULL,
  `parent_contact` varchar(20) NOT NULL,
  `parent_photo` varchar(50) NOT NULL,
  `parent_proof` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_parent`
--

INSERT INTO `tbl_parent` (`user_id`, `student_id`, `verification_status`, `parent_name`, `parent_relation`, `parent_contact`, `parent_photo`, `parent_proof`) VALUES
('P0001', 'S0001', 4, 'Shiby Baby', 'Mother', '9656124940', 'S2 Basic Rooms.png', 'IMG_20241204_0003.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_room`
--

CREATE TABLE `tbl_room` (
  `room_id` int(11) NOT NULL,
  `room_floor` int(11) NOT NULL,
  `room_number` int(11) NOT NULL,
  `room_type` int(11) NOT NULL,
  `room_capacity` int(11) NOT NULL,
  `no_of_occupants` int(11) NOT NULL,
  `room_rent` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_room`
--

INSERT INTO `tbl_room` (`room_id`, `room_floor`, `room_number`, `room_type`, `room_capacity`, `no_of_occupants`, `room_rent`) VALUES
(1, 1, 1, 1, 1, 0, 6500),
(2, 1, 2, 2, 1, 0, 5000),
(3, 1, 3, 1, 2, 0, 6000),
(4, 1, 4, 2, 2, 0, 4500),
(5, 1, 5, 1, 3, 0, 5500),
(6, 1, 6, 2, 3, 0, 4000),
(7, 1, 7, 1, 4, 0, 5000),
(8, 1, 8, 2, 4, 0, 3500),
(9, 1, 9, 1, 5, 0, 4500),
(10, 1, 10, 2, 5, 0, 3000),
(11, 2, 1, 1, 1, 0, 6500),
(12, 2, 2, 2, 1, 0, 5000),
(13, 2, 3, 1, 2, 0, 6000),
(14, 2, 4, 2, 2, 0, 4500),
(15, 2, 5, 1, 3, 0, 5500),
(16, 2, 6, 2, 3, 0, 4000),
(17, 2, 7, 1, 4, 0, 5000),
(18, 2, 8, 2, 4, 0, 3500),
(19, 2, 9, 1, 5, 0, 4500),
(20, 2, 10, 2, 5, 0, 3000),
(21, 3, 1, 1, 1, 0, 6500),
(22, 3, 2, 2, 1, 0, 5000),
(23, 3, 3, 1, 2, 0, 6000),
(24, 3, 4, 2, 2, 0, 4500),
(25, 3, 5, 1, 3, 0, 5500),
(26, 3, 6, 2, 3, 0, 4000),
(27, 3, 7, 1, 4, 0, 5000),
(28, 3, 8, 2, 4, 0, 3500),
(29, 3, 9, 1, 5, 0, 4500),
(30, 3, 10, 2, 5, 0, 3000),
(31, 4, 1, 1, 1, 0, 6500),
(32, 4, 2, 2, 1, 0, 5000),
(33, 4, 3, 1, 2, 0, 6000),
(34, 4, 4, 2, 2, 0, 4500),
(35, 4, 5, 1, 3, 0, 5500),
(36, 4, 6, 2, 3, 0, 4000),
(37, 4, 7, 1, 4, 0, 5000),
(38, 4, 8, 2, 4, 0, 3500),
(39, 4, 9, 1, 5, 0, 4500),
(40, 4, 10, 2, 5, 0, 3000);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_roomchangerequest`
--

CREATE TABLE `tbl_roomchangerequest` (
  `request_id` int(11) NOT NULL,
  `room_id` int(11) DEFAULT NULL,
  `user_id` varchar(20) NOT NULL,
  `reason` varchar(200) DEFAULT NULL,
  `requested_room_id` int(11) NOT NULL,
  `roomchange_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_roomchangerequest`
--

INSERT INTO `tbl_roomchangerequest` (`request_id`, `room_id`, `user_id`, `reason`, `requested_room_id`, `roomchange_status`) VALUES
(1, 0, 'S0001', NULL, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_roompreference`
--

CREATE TABLE `tbl_roompreference` (
  `room_id` int(11) NOT NULL,
  `user_id` varchar(20) NOT NULL,
  `room_verification_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_roomtype`
--

CREATE TABLE `tbl_roomtype` (
  `roomtype_id` int(11) NOT NULL,
  `room_share` int(11) NOT NULL,
  `room_type` int(11) NOT NULL,
  `room_amount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_roomtype`
--

INSERT INTO `tbl_roomtype` (`roomtype_id`, `room_share`, `room_type`, `room_amount`) VALUES
(1, 1, 1, 6500),
(2, 1, 2, 5000),
(3, 2, 1, 6000),
(4, 2, 2, 4500),
(5, 3, 1, 5500),
(6, 3, 2, 4000),
(7, 4, 1, 5000),
(8, 4, 2, 3500),
(9, 5, 1, 4500),
(10, 5, 2, 3000);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_student`
--

CREATE TABLE `tbl_student` (
  `user_id` varchar(20) NOT NULL,
  `verification_status` int(11) NOT NULL,
  `student_firstname` varchar(20) NOT NULL,
  `student_middlename` varchar(20) NOT NULL,
  `student_lastname` varchar(20) NOT NULL,
  `student_dob` date NOT NULL,
  `student_gender` varchar(20) NOT NULL,
  `student_country` varchar(20) NOT NULL,
  `student_district` varchar(20) NOT NULL,
  `student_city` varchar(20) NOT NULL,
  `student_housename` varchar(20) NOT NULL,
  `student_pincode` int(11) NOT NULL,
  `student_contact` varchar(10) NOT NULL,
  `student_photo` varchar(100) NOT NULL,
  `student_proof` varchar(100) NOT NULL,
  `student_doj` date NOT NULL,
  `caution_deposit_status` int(11) NOT NULL,
  `caution_payed_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_student`
--

INSERT INTO `tbl_student` (`user_id`, `verification_status`, `student_firstname`, `student_middlename`, `student_lastname`, `student_dob`, `student_gender`, `student_country`, `student_district`, `student_city`, `student_housename`, `student_pincode`, `student_contact`, `student_photo`, `student_proof`, `student_doj`, `caution_deposit_status`, `caution_payed_date`) VALUES
('S0001', 4, 'Nikhila', '', 'Baby', '2001-11-15', 'Female', 'India', 'Ernakulam', 'Perumbavoor', 'Malikudy', 683546, '9745620479', 'Payment gateway.png', 'Akhila-Merged.pdf', '2025-02-01', 1, '2025-03-29');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `user_id` varchar(20) NOT NULL,
  `user_email` varchar(100) NOT NULL,
  `user_password` varchar(20) NOT NULL,
  `user_type` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`user_id`, `user_email`, `user_password`, `user_type`) VALUES
('P0001', 'shibykmathai@gmail.com', 'MZe^VqsuDB', 'parent'),
('S0001', 'nikhilababy75782@gmail.com', 'n12345678', 'student'),
('W0001', 'warden@gmail.com', 'warden123', 'warden');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_attendance`
--
ALTER TABLE `tbl_attendance`
  ADD PRIMARY KEY (`attendance_id`);

--
-- Indexes for table `tbl_basic`
--
ALTER TABLE `tbl_basic`
  ADD PRIMARY KEY (`basic_id`);

--
-- Indexes for table `tbl_complaint`
--
ALTER TABLE `tbl_complaint`
  ADD PRIMARY KEY (`complaint_id`);

--
-- Indexes for table `tbl_hostelrentpayment`
--
ALTER TABLE `tbl_hostelrentpayment`
  ADD PRIMARY KEY (`rent_id`);

--
-- Indexes for table `tbl_leave`
--
ALTER TABLE `tbl_leave`
  ADD PRIMARY KEY (`leave_id`);

--
-- Indexes for table `tbl_mess`
--
ALTER TABLE `tbl_mess`
  ADD PRIMARY KEY (`mess_id`);

--
-- Indexes for table `tbl_messfee`
--
ALTER TABLE `tbl_messfee`
  ADD PRIMARY KEY (`messfee_id`);

--
-- Indexes for table `tbl_messpreference`
--
ALTER TABLE `tbl_messpreference`
  ADD PRIMARY KEY (`messpreference_id`);

--
-- Indexes for table `tbl_movement`
--
ALTER TABLE `tbl_movement`
  ADD PRIMARY KEY (`movement_id`);

--
-- Indexes for table `tbl_room`
--
ALTER TABLE `tbl_room`
  ADD PRIMARY KEY (`room_id`);

--
-- Indexes for table `tbl_roomchangerequest`
--
ALTER TABLE `tbl_roomchangerequest`
  ADD PRIMARY KEY (`request_id`);

--
-- Indexes for table `tbl_roomtype`
--
ALTER TABLE `tbl_roomtype`
  ADD PRIMARY KEY (`roomtype_id`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_attendance`
--
ALTER TABLE `tbl_attendance`
  MODIFY `attendance_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `tbl_basic`
--
ALTER TABLE `tbl_basic`
  MODIFY `basic_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_complaint`
--
ALTER TABLE `tbl_complaint`
  MODIFY `complaint_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_hostelrentpayment`
--
ALTER TABLE `tbl_hostelrentpayment`
  MODIFY `rent_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_leave`
--
ALTER TABLE `tbl_leave`
  MODIFY `leave_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_mess`
--
ALTER TABLE `tbl_mess`
  MODIFY `mess_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_messfee`
--
ALTER TABLE `tbl_messfee`
  MODIFY `messfee_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_messpreference`
--
ALTER TABLE `tbl_messpreference`
  MODIFY `messpreference_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_movement`
--
ALTER TABLE `tbl_movement`
  MODIFY `movement_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_room`
--
ALTER TABLE `tbl_room`
  MODIFY `room_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `tbl_roomchangerequest`
--
ALTER TABLE `tbl_roomchangerequest`
  MODIFY `request_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_roomtype`
--
ALTER TABLE `tbl_roomtype`
  MODIFY `roomtype_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
