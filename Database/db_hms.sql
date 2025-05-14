-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 13, 2025 at 11:30 AM
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
(1, '2025-03-01', 'S0001', 1),
(2, '2025-03-02', 'S0001', 1),
(3, '2025-03-03', 'S0001', 1),
(4, '2025-03-04', 'S0001', 0),
(5, '2025-03-05', 'S0001', 1),
(6, '2025-03-06', 'S0001', 1),
(7, '2025-03-07', 'S0001', 1),
(8, '2025-03-08', 'S0001', 1),
(9, '2025-03-09', 'S0001', 0),
(10, '2025-03-10', 'S0001', 1),
(11, '2025-03-11', 'S0001', 1),
(12, '2025-03-12', 'S0001', 1),
(13, '2025-03-13', 'S0001', 1),
(14, '2025-03-14', 'S0001', 1),
(15, '2025-03-15', 'S0001', 1),
(16, '2025-03-16', 'S0001', 1),
(17, '2025-03-17', 'S0001', 0),
(18, '2025-03-18', 'S0001', 1),
(19, '2025-03-19', 'S0001', 1),
(20, '2025-03-20', 'S0001', 1),
(21, '2025-03-21', 'S0001', 1),
(22, '2025-03-22', 'S0001', 1),
(23, '2025-03-23', 'S0001', 1),
(24, '2025-03-24', 'S0001', 0),
(25, '2025-03-25', 'S0001', 1),
(26, '2025-03-26', 'S0001', 1),
(27, '2025-03-27', 'S0001', 1),
(28, '2025-03-28', 'S0001', 1),
(29, '2025-03-29', 'S0001', 1),
(30, '2025-03-30', 'S0001', 1),
(31, '2025-03-31', 'S0001', 1),
(32, '2025-04-01', 'S0001', 0),
(33, '2025-04-02', 'S0001', 1),
(34, '2025-04-03', 'S0001', 0),
(35, '2025-04-04', 'S0001', 1),
(36, '2025-04-05', 'S0001', 0),
(37, '2025-04-06', 'S0001', 1),
(38, '2025-04-07', 'S0001', 0),
(39, '2025-04-08', 'S0001', 1),
(40, '2025-04-09', 'S0001', 0),
(41, '2025-04-10', 'S0001', 1),
(42, '2025-04-11', 'S0001', 1),
(43, '2025-04-12', 'S0001', 0),
(44, '2025-04-13', 'S0001', 1),
(45, '2025-04-14', 'S0001', 0),
(46, '2025-04-15', 'S0001', 1),
(47, '2025-04-16', 'S0001', 0),
(48, '2025-04-17', 'S0001', 1),
(49, '2025-04-18', 'S0001', 1),
(50, '2025-04-19', 'S0001', 0),
(51, '2025-04-20', 'S0001', 1),
(52, '2025-04-21', 'S0001', 0),
(53, '2025-04-22', 'S0001', 1),
(54, '2025-04-23', 'S0001', 0),
(55, '2025-04-24', 'S0001', 1),
(56, '2025-04-25', 'S0001', 1),
(57, '2025-04-26', 'S0001', 0),
(58, '2025-04-27', 'S0001', 1),
(59, '2025-04-28', 'S0001', 0),
(60, '2025-04-29', 'S0001', 0),
(61, '2025-04-30', 'S0001', 0),
(62, '2025-04-01', 'S0002', 1),
(63, '2025-04-02', 'S0002', 1),
(64, '2025-04-03', 'S0002', 1),
(65, '2025-04-04', 'S0002', 1),
(66, '2025-04-05', 'S0002', 1),
(67, '2025-04-06', 'S0002', 1),
(68, '2025-04-07', 'S0002', 1),
(69, '2025-04-08', 'S0002', 1),
(70, '2025-04-09', 'S0002', 1),
(71, '2025-04-10', 'S0002', 0),
(72, '2025-04-11', 'S0002', 0),
(73, '2025-04-12', 'S0002', 0),
(74, '2025-04-13', 'S0002', 0),
(75, '2025-04-14', 'S0002', 1),
(76, '2025-04-15', 'S0002', 1),
(77, '2025-04-16', 'S0002', 1),
(78, '2025-04-17', 'S0002', 1),
(79, '2025-04-18', 'S0002', 1),
(80, '2025-04-19', 'S0002', 1),
(81, '2025-04-20', 'S0002', 1),
(82, '2025-04-21', 'S0002', 1),
(83, '2025-04-22', 'S0002', 1),
(84, '2025-04-23', 'S0002', 1),
(85, '2025-04-24', 'S0002', 1),
(86, '2025-04-25', 'S0002', 1),
(87, '2025-04-26', 'S0002', 1),
(88, '2025-04-27', 'S0002', 1),
(89, '2025-04-28', 'S0002', 1),
(90, '2025-04-29', 'S0002', 1),
(91, '2025-04-30', 'S0002', 1),
(92, '2025-05-01', 'S0001', 1),
(93, '2025-05-02', 'S0001', 1),
(94, '2025-05-03', 'S0001', 1),
(95, '2025-05-04', 'S0001', 1),
(96, '2025-05-05', 'S0001', 1),
(97, '2025-05-06', 'S0001', 1),
(98, '2025-05-07', 'S0001', 1),
(99, '2025-05-08', 'S0001', 1),
(100, '2025-05-09', 'S0001', 1),
(101, '2025-05-10', 'S0001', 1),
(102, '2025-05-11', 'S0001', 1),
(103, '2025-05-12', 'S0001', 1),
(104, '2025-05-01', 'S0002', 1),
(105, '2025-05-02', 'S0002', 1),
(106, '2025-05-03', 'S0002', 1),
(107, '2025-05-04', 'S0002', 1),
(108, '2025-05-05', 'S0002', 1),
(109, '2025-05-06', 'S0002', 1),
(110, '2025-05-07', 'S0002', 1),
(111, '2025-05-08', 'S0002', 1),
(112, '2025-05-09', 'S0002', 1),
(113, '2025-05-10', 'S0002', 1),
(114, '2025-05-11', 'S0002', 1),
(115, '2025-05-12', 'S0002', 0),
(118, '2025-05-13', 'S0002', 0),
(119, '2025-05-13', 'S0001', 1);

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
(1, 6, 2000);

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

--
-- Dumping data for table `tbl_complaint`
--

INSERT INTO `tbl_complaint` (`complaint_id`, `complaint`, `complaint_date`, `user_id`, `reply_date`, `complaint_reply`, `complaint_status`) VALUES
(1, 'Lights ae not working in floor 1 room number 3', '2025-05-13', 'S0001', '2025-05-13', 'We are working on it.', 2);

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
(1, 3, 2025, 'S0001', 2, 6000, 1);

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
(1, 'S0002', '2025-04-10', '2025-04-14', '2025-04-09', 'Going Home', 1),
(2, 'S0002', '2025-05-12', '2025-05-14', '2025-05-10', 'Going Home', 1);

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

--
-- Dumping data for table `tbl_mess`
--

INSERT INTO `tbl_mess` (`mess_id`, `mess_date`, `breakfast`, `lunch`, `tea_time`, `dinner`, `veg_status`, `nonveg_status`) VALUES
(1, '2025-05-14', 'Tea, Appam & Kadala Curry', 'Rice & Veggies', 'Tea & Parippuvada', 'Masala Dosa', 0, 1),
(2, '2025-05-15', 'Tea, Puttu & Kadala Curry', 'Rice & veggies', 'Tea & Parippuvada', 'Chappathi & Chicken/Cauliflower', 0, 0),
(3, '2025-05-16', 'Tea, Dosa  & Sambar', 'Rice & veggies', 'Tea & Uzhunnu Vada', 'Rice & Fish Curry/ Onion Curry', 0, 0),
(4, '2025-05-17', 'Tea, Appam & Kadala Curry', 'Rice & veggies', 'Tea & Biscuit', 'Biriyani & Chicken/Cauliflower', 0, 0),
(5, '2025-05-18', 'Tea, Idly & Chutney', 'Rice & veggies', 'Tea & Sweet Potato', 'Porotta & Beef/Soya Beans', 0, 0),
(6, '2025-05-19', 'Tea, Uppma & Banana', 'Rice & veggies', 'Tea & Sugiyan', 'Chappathi & Chicken/Cauliflower', 0, 0),
(7, '2025-05-20', 'Tea, Appam & Kadala Curry', 'Rice & veggies', 'Tea & Pazhampori', 'Masala Dosa', 0, 0);

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
(1, 3, 2025, 'S0001', 26, 2000, '2025-03-31', 1, '2025-04-03', 0);

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

--
-- Dumping data for table `tbl_messpreference`
--

INSERT INTO `tbl_messpreference` (`messpreference_id`, `mess_id`, `user_id`, `preference_status`) VALUES
(2, 8, 'S0002', 2),
(3, 8, 'S0001', 1);

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

--
-- Dumping data for table `tbl_movement`
--

INSERT INTO `tbl_movement` (`movement_id`, `user_id`, `out_date`, `out_time`, `in_date`, `in_time`, `reason`, `out_status`) VALUES
(1, 'S0002', '2025-04-10', '09:57:06am', '2025-04-13', '06:57:13pm', 'Home', 0),
(2, 'S0002', '2025-05-12', '07:58:38am', NULL, NULL, 'Home', 1),
(3, 'S0001', '2025-03-04', '09:00:06am', '2025-03-04', '05:00:13am', 'Shopping', 0),
(4, 'S0001', '2025-03-09', '11:00:00am', '2025-03-09', '02:00:13pm', 'Hospital', 0),
(5, 'S0001', '2025-03-17', '11:00:00am', '2025-03-17', '02:00:13pm', 'Hospital', 0);

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
('P0001', 'S0001', 1, 'George', 'Father', '9632587412', 'IMG-20221025-WA0099.jpg', 'Aadhar.pdf'),
('P0002', 'S0002', 1, 'Babu', 'Father', '8654791235', '20220429_130607.jpg', 'Aadhar.pdf'),
('P0003', 'S0003', 4, 'Eldho', 'Father', '9632548671', 'IMG-20240308-WA0046.jpg', 'Aadhar.pdf');

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
(3, 1, 3, 1, 2, 2, 6000),
(4, 1, 4, 2, 2, 0, 4500),
(5, 1, 5, 1, 3, 0, 5500),
(6, 1, 6, 2, 3, 0, 4000),
(7, 2, 1, 1, 1, 0, 6500),
(8, 2, 2, 2, 1, 0, 5000),
(9, 2, 3, 1, 2, 0, 6000),
(10, 2, 4, 2, 2, 0, 4500),
(11, 2, 5, 1, 3, 0, 5500),
(12, 2, 6, 2, 3, 0, 4000),
(13, 3, 1, 1, 1, 0, 6500),
(14, 3, 2, 2, 1, 0, 5000),
(15, 3, 3, 1, 2, 0, 6000),
(16, 3, 4, 2, 2, 0, 4500),
(17, 3, 5, 1, 3, 0, 5500),
(18, 3, 6, 2, 3, 0, 4000),
(19, 4, 1, 1, 1, 0, 6500),
(20, 4, 2, 2, 1, 0, 5000),
(21, 4, 3, 1, 2, 0, 6000),
(22, 4, 4, 2, 2, 0, 4500),
(23, 4, 5, 1, 3, 0, 5500),
(24, 5, 6, 2, 3, 0, 4000);

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
(1, 0, 'S0001', NULL, 3, 1),
(2, 0, 'S0002', NULL, 3, 1),
(3, 0, 'S0003', NULL, 4, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_roompreference`
--

CREATE TABLE `tbl_roompreference` (
  `room_id` int(11) NOT NULL,
  `user_id` varchar(20) NOT NULL,
  `room_verification_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_roompreference`
--

INSERT INTO `tbl_roompreference` (`room_id`, `user_id`, `room_verification_status`) VALUES
(3, 'S0001', 1),
(3, 'S0002', 1);

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
(6, 3, 2, 4000);

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
('S0001', 1, 'Biltta', '', 'George', '2002-02-09', 'Female', 'India', 'Ernakulam', 'Perumbavoor', 'Kollamavukudy', 683546, '9874563214', 'IMG-20221025-WA0099.jpg', 'Aadhar.pdf', '2025-03-01', 1, '2025-03-01'),
('S0002', 1, 'Merin', '', 'Babu', '2001-12-02', 'Female', 'India', 'Kottayam', 'Manarcad', 'Kanneth', 668532, '9685741234', '20220429_130607.jpg', 'Aadhar.pdf', '2025-04-01', 1, '2025-04-01'),
('S0003', 4, 'Anna', '', 'Eldho', '2002-03-06', 'Female', 'India', 'Ernakulam', 'Perumbavoor', 'Keechery', 658974, '9632587412', 'IMG-20240308-WA0046.jpg', 'Aadhar.pdf', '2025-05-13', 1, '2025-05-13');

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
('P0001', 'george@gmail.com', 'george@123', 'parent'),
('P0002', 'babu@gmail.com', 'ovCaT1ZwV^', 'parent'),
('P0003', 'eldho@gmail.com', 'SA3gPORfUw', 'parent'),
('S0001', 'biltta@gmail.com', 'biltta@123', 'student'),
('S0002', 'merin@gmail.com', 'merin@123', 'student'),
('S0003', 'anna@gmail.com', 'anna@12345', 'student'),
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
  MODIFY `attendance_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=120;

--
-- AUTO_INCREMENT for table `tbl_basic`
--
ALTER TABLE `tbl_basic`
  MODIFY `basic_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_complaint`
--
ALTER TABLE `tbl_complaint`
  MODIFY `complaint_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_hostelrentpayment`
--
ALTER TABLE `tbl_hostelrentpayment`
  MODIFY `rent_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tbl_leave`
--
ALTER TABLE `tbl_leave`
  MODIFY `leave_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_mess`
--
ALTER TABLE `tbl_mess`
  MODIFY `mess_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tbl_messfee`
--
ALTER TABLE `tbl_messfee`
  MODIFY `messfee_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tbl_messpreference`
--
ALTER TABLE `tbl_messpreference`
  MODIFY `messpreference_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_movement`
--
ALTER TABLE `tbl_movement`
  MODIFY `movement_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_room`
--
ALTER TABLE `tbl_room`
  MODIFY `room_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `tbl_roomchangerequest`
--
ALTER TABLE `tbl_roomchangerequest`
  MODIFY `request_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_roomtype`
--
ALTER TABLE `tbl_roomtype`
  MODIFY `roomtype_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
