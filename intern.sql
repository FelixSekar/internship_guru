-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 25, 2018 at 02:32 AM
-- Server version: 10.1.30-MariaDB
-- PHP Version: 7.2.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `intern`
--

-- --------------------------------------------------------

--
-- Table structure for table `applied`
--

CREATE TABLE `applied` (
  `id` int(11) NOT NULL,
  `std_id` int(11) NOT NULL,
  `int_id` int(11) NOT NULL,
  `app` varchar(200) NOT NULL,
  `status` varchar(10) NOT NULL DEFAULT 'Applied',
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `applied`
--

INSERT INTO `applied` (`id`, `std_id`, `int_id`, `app`, `status`, `timestamp`) VALUES
(2, 2, 1, 'I have good practical knowledge. Worked on projects using both back end and front end technologies. I would be able to the given task in the given time.', 'Applied', '2018-06-24 23:40:28'),
(3, 2, 2, 'I love Google', 'Applied', '2018-06-25 00:02:35'),
(5, 5, 2, 'I love Google', 'Applied', '2018-06-25 00:26:40'),
(6, 5, 1, 'Made for FB', 'Applied', '2018-06-25 00:26:55');

-- --------------------------------------------------------

--
-- Table structure for table `emp_account`
--

CREATE TABLE `emp_account` (
  `id` int(11) NOT NULL,
  `cmp_name` varchar(20) NOT NULL,
  `email` varchar(20) NOT NULL,
  `pwd` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `emp_account`
--

INSERT INTO `emp_account` (`id`, `cmp_name`, `email`, `pwd`) VALUES
(2, 'Google', 'google@gmail.com', '$2y$10$F4UVfHKJWQCUQ6IO.AIdKut5KAIOGWb/mxPFCr8rWh/QVmJl1Vsf.'),
(3, 'Facebook', 'facebook@gmail.com', '$2y$10$4y.0xnHbLNJNyIXC3/d6Cu1cFxQy9WqUtwURGD/chBLZ39HDHSsLa');

-- --------------------------------------------------------

--
-- Table structure for table `internships`
--

CREATE TABLE `internships` (
  `id` int(11) NOT NULL,
  `emp_id` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `category` varchar(30) NOT NULL,
  `apply_by` date NOT NULL,
  `duration` int(11) NOT NULL,
  `location` varchar(30) NOT NULL,
  `des` varchar(200) NOT NULL,
  `stipend` int(10) NOT NULL,
  `status` varchar(11) NOT NULL DEFAULT 'Open',
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `internships`
--

INSERT INTO `internships` (`id`, `emp_id`, `title`, `category`, `apply_by`, `duration`, `location`, `des`, `stipend`, `status`, `timestamp`) VALUES
(1, 3, 'Anglar Js Dev', 'Web Development', '2018-06-30', 3, 'Mumbai', 'Build Websites using Angular Js', 1000, 'Open', '2018-06-24 22:50:43'),
(2, 2, 'Web Dev', 'Web Development', '2018-06-22', 3, 'Work From Home', 'Make Websites From Home					      		', 1000, 'Open', '2018-06-24 21:28:28');

-- --------------------------------------------------------

--
-- Table structure for table `std_account`
--

CREATE TABLE `std_account` (
  `id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `pwd` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `std_account`
--

INSERT INTO `std_account` (`id`, `name`, `email`, `pwd`) VALUES
(2, 'Felix Sekar', 'felixsekar11@gmail.com', '$2y$10$4nRjUmivs0zLXESNCAx./.RV1E.9Q1c4gfGga05cofKHEoxbxsKQC'),
(3, 'Patrick Sekar', 'patrick@gmail.com', '$2y$10$RCiUYIip/gLR1SL1CAHM4eRCOmd9P33kXz0jXSkXmio/cr46uVzIO'),
(4, 'Santa Claus', 'santa@gmail.com', '$2y$10$V3WkBhFgj3qRg9w5N.DlQ.M6OkNDWurs4/odm01VWuD2tZmMj5AZe'),
(5, 'James Bond', 'james@gmail.com', '$2y$10$sI3BBEuYBdR46enxLS.vmOzpvLgjBgtt3RXcXtzTiCVxHs9We5bsK'),
(6, 'Raj Kumar', 'raj@gmail.com', '$2y$10$UIBwT8Hv8QnGgX47jzLmwueiIlmYsVXooTlJVIxOyLn8YGEK2KTNi');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `applied`
--
ALTER TABLE `applied`
  ADD PRIMARY KEY (`id`),
  ADD KEY `int_id` (`int_id`),
  ADD KEY `std_id` (`std_id`);

--
-- Indexes for table `emp_account`
--
ALTER TABLE `emp_account`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `internships`
--
ALTER TABLE `internships`
  ADD PRIMARY KEY (`id`),
  ADD KEY `emp_id` (`emp_id`);

--
-- Indexes for table `std_account`
--
ALTER TABLE `std_account`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `applied`
--
ALTER TABLE `applied`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `emp_account`
--
ALTER TABLE `emp_account`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `internships`
--
ALTER TABLE `internships`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `std_account`
--
ALTER TABLE `std_account`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `applied`
--
ALTER TABLE `applied`
  ADD CONSTRAINT `applied_ibfk_1` FOREIGN KEY (`int_id`) REFERENCES `internships` (`id`),
  ADD CONSTRAINT `applied_ibfk_2` FOREIGN KEY (`std_id`) REFERENCES `std_account` (`id`);

--
-- Constraints for table `internships`
--
ALTER TABLE `internships`
  ADD CONSTRAINT `internships_ibfk_1` FOREIGN KEY (`emp_id`) REFERENCES `emp_account` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
