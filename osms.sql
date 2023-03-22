-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 20, 2023 at 10:30 AM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `osms`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_login`
--

CREATE TABLE `admin_login` (
  `a_id` int(11) NOT NULL,
  `a_name` varchar(60) COLLATE latin7_general_cs NOT NULL,
  `a_email` varchar(60) COLLATE latin7_general_cs NOT NULL,
  `a_password` varchar(60) COLLATE latin7_general_cs NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin7 COLLATE=latin7_general_cs;

--
-- Dumping data for table `admin_login`
--

INSERT INTO `admin_login` (`a_id`, `a_name`, `a_email`, `a_password`) VALUES
(1, 'Shubham', 'admin@gmail.com', '1234');

-- --------------------------------------------------------

--
-- Table structure for table `assets_tb`
--

CREATE TABLE `assets_tb` (
  `pid` int(11) NOT NULL,
  `pname` varchar(60) COLLATE latin7_general_cs NOT NULL,
  `pdop` date NOT NULL,
  `pavail` int(11) NOT NULL,
  `ptotal` int(11) NOT NULL,
  `porg_cost` float NOT NULL,
  `psell_cost` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin7 COLLATE=latin7_general_cs;

--
-- Dumping data for table `assets_tb`
--

INSERT INTO `assets_tb` (`pid`, `pname`, `pdop`, `pavail`, `ptotal`, `porg_cost`, `psell_cost`) VALUES
(1, 'mouse', '2023-03-01', 9, 10, 150, 250),
(2, 'keyboard', '2023-03-02', 5, 5, 500, 750),
(3, 'Charger', '2023-03-03', 8, 8, 1500, 2000),
(4, 'Switch', '2023-03-04', 15, 15, 78, 100),
(5, 'remote', '2023-03-05', 5, 5, 50, 85),
(6, 'USB Cable', '2023-03-06', 15, 15, 30.5, 50.7);

-- --------------------------------------------------------

--
-- Table structure for table `assign_work`
--

CREATE TABLE `assign_work` (
  `r_no` int(11) NOT NULL,
  `request_id` int(11) NOT NULL,
  `request_info` text COLLATE latin7_general_cs NOT NULL,
  `request_desc` text COLLATE latin7_general_cs NOT NULL,
  `requester_name` varchar(60) COLLATE latin7_general_cs NOT NULL,
  `requester_add1` text COLLATE latin7_general_cs NOT NULL,
  `requester_add2` text COLLATE latin7_general_cs NOT NULL,
  `requester_city` varchar(60) COLLATE latin7_general_cs NOT NULL,
  `requester_state` varchar(60) COLLATE latin7_general_cs NOT NULL,
  `requester_zip` int(11) NOT NULL,
  `requester_email` varchar(60) COLLATE latin7_general_cs NOT NULL,
  `requester_mobile` bigint(20) NOT NULL,
  `assign_tech` varchar(60) COLLATE latin7_general_cs NOT NULL,
  `assign_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin7 COLLATE=latin7_general_cs;

--
-- Dumping data for table `assign_work`
--

INSERT INTO `assign_work` (`r_no`, `request_id`, `request_info`, `request_desc`, `requester_name`, `requester_add1`, `requester_add2`, `requester_city`, `requester_state`, `requester_zip`, `requester_email`, `requester_mobile`, `assign_tech`, `assign_date`) VALUES
(1, 1, 'keyboard not working', 'fall from table', 'Shubham Kumar', 'H. 08', 'Sultana ahiran', 'Buhana', 'Rajasthan', 333502, 'shubham@gmail.com', 7877461789, 'Shubham ', '2023-03-20'),
(2, 2, 'mouse not working', 'scroll button not working', 'Ketan Kumar', 'street no 5', 'jhunjhunu', 'jhunjhunu', 'rajasthan', 335265, 'ketan@gmail.com', 7877562341, 'rahul', '2023-03-25');

-- --------------------------------------------------------

--
-- Table structure for table `product_sell`
--

CREATE TABLE `product_sell` (
  `cid` int(11) NOT NULL,
  `pid` int(11) NOT NULL,
  `cname` varchar(60) COLLATE latin7_general_cs NOT NULL,
  `caddress` varchar(60) COLLATE latin7_general_cs NOT NULL,
  `cpname` varchar(60) COLLATE latin7_general_cs NOT NULL,
  `cpquantity` int(11) NOT NULL,
  `cpeach` float NOT NULL,
  `cptotal` float NOT NULL,
  `cpdate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin7 COLLATE=latin7_general_cs;

--
-- Dumping data for table `product_sell`
--

INSERT INTO `product_sell` (`cid`, `pid`, `cname`, `caddress`, `cpname`, `cpquantity`, `cpeach`, `cptotal`, `cpdate`) VALUES
(1, 1, 'shubham', 'jhunjhunu raj.', 'mouse', 1, 250, 250, '2023-03-20');

-- --------------------------------------------------------

--
-- Table structure for table `submit_request`
--

CREATE TABLE `submit_request` (
  `request_id` int(11) NOT NULL,
  `request_info` text COLLATE latin7_general_cs NOT NULL,
  `request_desc` text COLLATE latin7_general_cs NOT NULL,
  `requester_name` varchar(60) COLLATE latin7_general_cs NOT NULL,
  `requester_add1` text COLLATE latin7_general_cs NOT NULL,
  `requester_add2` text COLLATE latin7_general_cs NOT NULL,
  `requester_city` varchar(60) COLLATE latin7_general_cs NOT NULL,
  `requester_state` varchar(60) COLLATE latin7_general_cs NOT NULL,
  `requester_zip` int(11) NOT NULL,
  `requester_email` varchar(60) COLLATE latin7_general_cs NOT NULL,
  `requester_mobile` bigint(20) NOT NULL,
  `request_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin7 COLLATE=latin7_general_cs;

--
-- Dumping data for table `submit_request`
--

INSERT INTO `submit_request` (`request_id`, `request_info`, `request_desc`, `requester_name`, `requester_add1`, `requester_add2`, `requester_city`, `requester_state`, `requester_zip`, `requester_email`, `requester_mobile`, `request_date`) VALUES
(3, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been t', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been tLorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been t', 'Rahul', 'street no 54', 'patna', 'patna', 'bihar', 456321, 'rahul@gmail.com', 485236975, '2023-03-17'),
(4, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been t', 't is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem I', 'sagar', 'house no 456', 'dulhera', 'Meerut', 'UP', 123456, 'sagar@gmail.com', 785214639, '2023-03-17'),
(5, 't is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem I', 't is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem I', 'aditya', 'sector 18', 'ballo majra', 'mohali', 'punjab', 123569, 'aditya@gmail.com', 5246317896, '2023-03-17'),
(6, 'keyboard not working lorem nknkdnndm dknkdnm jdme', 'fall from tablefall from tablefall from tablevvfall from tablefall from tablefall from table', 'hrishabh', 'street no 115', 'patna', 'patna', 'bihar', 745632, 'hrishabh@gmail.com', 7412589635, '2023-03-17'),
(7, 'ns have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', 'ns have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).ns have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', 'hrishabh', 'street no 5', 'jhunjhunu', 'jhunjhunu', 'bihar', 789456, 'hrishabh@gmail.com', 1234567895, '2023-03-17');

-- --------------------------------------------------------

--
-- Table structure for table `technician_tb`
--

CREATE TABLE `technician_tb` (
  `tech_id` int(11) NOT NULL,
  `tech_name` varchar(60) COLLATE latin7_general_cs NOT NULL,
  `tech_city` varchar(60) COLLATE latin7_general_cs NOT NULL,
  `tech_mobile` bigint(20) NOT NULL,
  `tech_email` varchar(60) COLLATE latin7_general_cs NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin7 COLLATE=latin7_general_cs;

--
-- Dumping data for table `technician_tb`
--

INSERT INTO `technician_tb` (`tech_id`, `tech_name`, `tech_city`, `tech_mobile`, `tech_email`) VALUES
(1, 'Shubham ', 'jhunjhunu', 7863459792, 'shubham@gmail.com'),
(2, 'Ketan', 'jhunjhunu', 7879466164, 'ketan@gmail.com'),
(3, 'hrishabh', 'delhi', 8523697418, 'hrishabh@gmail.com'),
(4, 'rahul', 'patna', 7845123696, 'rahul@gmail.com'),
(5, 'sagar', 'meerut', 86304512, 'sagar@gmail.com'),
(7, 'aditya powder', 'darbhanga', 4561237895, 'aditya@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `user_login`
--

CREATE TABLE `user_login` (
  `u_id` int(11) NOT NULL,
  `u_name` varchar(75) COLLATE latin7_general_cs NOT NULL,
  `u_email` varchar(75) COLLATE latin7_general_cs NOT NULL,
  `u_password` varchar(75) COLLATE latin7_general_cs NOT NULL,
  `u_add1` varchar(60) COLLATE latin7_general_cs NOT NULL,
  `u_add2` varchar(60) COLLATE latin7_general_cs NOT NULL,
  `u_city` varchar(60) COLLATE latin7_general_cs NOT NULL,
  `u_state` varchar(60) COLLATE latin7_general_cs NOT NULL,
  `u_zip` int(11) NOT NULL,
  `u_mobile` bigint(20) NOT NULL,
  `u_image` varchar(255) COLLATE latin7_general_cs NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin7 COLLATE=latin7_general_cs;

--
-- Dumping data for table `user_login`
--

INSERT INTO `user_login` (`u_id`, `u_name`, `u_email`, `u_password`, `u_add1`, `u_add2`, `u_city`, `u_state`, `u_zip`, `u_mobile`, `u_image`) VALUES
(1, 'Shubham Kumar', 'shubham@gmail.com', '1234', 'H. 08', 'Sultana ahiran', 'Buhana', 'Rajasthan', 333502, 7877461789, 'pf_images/pimg.jpeg'),
(2, 'Ketan Kumar', 'ketan@gmail.com', '1234', '', '', '', '', 0, 0, ''),
(3, 'Rahul', 'rahul@gmail.com', '1234', '', '', 'patna', '', 0, 0, ''),
(4, 'sagar', 'sagar@gmail.com', '1234', '', '', 'Meerut', 'UP', 0, 0, ''),
(5, 'aditya', 'aditya@gmail.com', '1234', '', '', '', '', 0, 0, ''),
(6, 'hrishabh', 'hrishabh@gmail.com', '1234', '', '', '', 'bihar', 0, 0, 'pf_images/image2.jpeg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_login`
--
ALTER TABLE `admin_login`
  ADD PRIMARY KEY (`a_id`);

--
-- Indexes for table `assets_tb`
--
ALTER TABLE `assets_tb`
  ADD PRIMARY KEY (`pid`);

--
-- Indexes for table `assign_work`
--
ALTER TABLE `assign_work`
  ADD PRIMARY KEY (`r_no`);

--
-- Indexes for table `product_sell`
--
ALTER TABLE `product_sell`
  ADD PRIMARY KEY (`cid`);

--
-- Indexes for table `submit_request`
--
ALTER TABLE `submit_request`
  ADD PRIMARY KEY (`request_id`);

--
-- Indexes for table `technician_tb`
--
ALTER TABLE `technician_tb`
  ADD PRIMARY KEY (`tech_id`);

--
-- Indexes for table `user_login`
--
ALTER TABLE `user_login`
  ADD PRIMARY KEY (`u_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_login`
--
ALTER TABLE `admin_login`
  MODIFY `a_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `assets_tb`
--
ALTER TABLE `assets_tb`
  MODIFY `pid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `assign_work`
--
ALTER TABLE `assign_work`
  MODIFY `r_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `product_sell`
--
ALTER TABLE `product_sell`
  MODIFY `cid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `submit_request`
--
ALTER TABLE `submit_request`
  MODIFY `request_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `technician_tb`
--
ALTER TABLE `technician_tb`
  MODIFY `tech_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `user_login`
--
ALTER TABLE `user_login`
  MODIFY `u_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
