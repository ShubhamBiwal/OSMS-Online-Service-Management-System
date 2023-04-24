-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 24, 2023 at 12:36 PM
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
  `a_password` varchar(60) COLLATE latin7_general_cs NOT NULL,
  `a_contact` bigint(20) NOT NULL,
  `a_address` varchar(60) COLLATE latin7_general_cs NOT NULL,
  `a_img` varchar(60) COLLATE latin7_general_cs NOT NULL,
  `a_otp` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin7 COLLATE=latin7_general_cs;

--
-- Dumping data for table `admin_login`
--

INSERT INTO `admin_login` (`a_id`, `a_name`, `a_email`, `a_password`, `a_contact`, `a_address`, `a_img`, `a_otp`) VALUES
(1, 'Shubham kumar', 'shubhamkumarbiwal@gmail.com', 'aaaa', 7896541235, 'RJ', 'a_images/image2.jpeg', 666958);

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
(1, 'mouse', '2023-03-01', 6, 10, 150, 250),
(2, 'keyboard', '2023-03-02', 5, 5, 500, 750),
(3, 'Charger', '2023-03-03', 7, 8, 1500, 2000),
(4, 'Switch', '2023-03-04', 13, 15, 78, 100),
(5, 'remote', '2023-03-05', 4, 5, 50, 85),
(6, 'USB Cable', '2023-03-06', 15, 15, 30.5, 50.7);

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `m_id` int(11) NOT NULL,
  `f_name` varchar(60) COLLATE latin7_general_cs NOT NULL,
  `m_subject` varchar(70) COLLATE latin7_general_cs NOT NULL,
  `email` varchar(60) COLLATE latin7_general_cs NOT NULL,
  `mobile` bigint(20) NOT NULL,
  `message` longtext COLLATE latin7_general_cs NOT NULL,
  `m_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin7 COLLATE=latin7_general_cs;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`m_id`, `f_name`, `m_subject`, `email`, `mobile`, `message`, `m_date`) VALUES
(29, 'jsghcbjs', 'snbcbxs', 'shubhamkumarbiwal@gmail.com', 494997, '5464', '2023-04-21'),
(30, 'jsghcbjs', 'snbcbxs', 'shubhamkumarbiwal@gmail.com', 54496496, 'dfghj', '2023-04-21'),
(31, 'jsghcbjs', 'snbcbxs', 'shubhamkumarbiwal@gmail.com', 6130, 'xvbnm,.', '2023-04-21'),
(32, 'jsghcbjs', 'snbcbxs', 'shubhamkumarbiwal@gmail.com', 84664, 'hdbhc', '2023-04-21'),
(33, 'jsghcbjs', 'snbcbxs', 'shubhamkumarbiwal@gmail.com', 8484, 'nbvvhxc', '2023-04-21'),
(34, 'jsghcbjs', 'snbcbxs', 'shubhamkumarbiwal@gmail.com', 84463, 'nbjhbh', '2023-04-21'),
(36, 'shubham kumar', 'nothing', 'shubhamkumarbiwal@gmail.com', 9944646, 'dfghvn n', '2023-04-21'),
(37, 'shubham kumar', 'snbcbxs', 'shubhamkumarbiwal@gmail.com', 886514, 'vcbn m', '2023-04-21'),
(38, 'shubham kumar', 'nothing', 'shubhamkumarbiwal@gmail.com', 74569823, 'cxcxvbnm', '2023-04-21');

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
(1, 3, 'rakesh', 'chirawa', 'Charger', 1, 2000, 2000, '2023-04-18'),
(2, 1, 'jhhu', 'fcgvhbjnkml', 'mouse', 1, 250, 250, '2023-04-21');

-- --------------------------------------------------------

--
-- Table structure for table `requests_tb`
--

CREATE TABLE `requests_tb` (
  `request_id` int(11) NOT NULL,
  `u_id` int(11) NOT NULL,
  `s_appliance` varchar(60) COLLATE latin7_general_cs NOT NULL,
  `s_service` varchar(60) COLLATE latin7_general_cs NOT NULL,
  `request_desc` text COLLATE latin7_general_cs NOT NULL,
  `requester_name` varchar(60) COLLATE latin7_general_cs NOT NULL,
  `requester_add1` text COLLATE latin7_general_cs NOT NULL,
  `requester_add2` text COLLATE latin7_general_cs NOT NULL,
  `requester_city` varchar(60) COLLATE latin7_general_cs NOT NULL,
  `requester_state` varchar(60) COLLATE latin7_general_cs NOT NULL,
  `requester_email` varchar(60) COLLATE latin7_general_cs NOT NULL,
  `requester_mobile` bigint(20) NOT NULL,
  `requester_alt_mobile` bigint(20) NOT NULL,
  `request_date` date NOT NULL,
  `s_price` int(11) NOT NULL,
  `request_code` varchar(60) COLLATE latin7_general_cs NOT NULL,
  `tech_id` int(11) NOT NULL,
  `assign_tech` varchar(60) COLLATE latin7_general_cs NOT NULL,
  `tech_mobile` bigint(20) NOT NULL,
  `tech_email` varchar(60) COLLATE latin7_general_cs NOT NULL,
  `assign_date` date NOT NULL,
  `work_date` date NOT NULL,
  `r_status` int(11) NOT NULL,
  `admin_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin7 COLLATE=latin7_general_cs;

--
-- Dumping data for table `requests_tb`
--

INSERT INTO `requests_tb` (`request_id`, `u_id`, `s_appliance`, `s_service`, `request_desc`, `requester_name`, `requester_add1`, `requester_add2`, `requester_city`, `requester_state`, `requester_email`, `requester_mobile`, `requester_alt_mobile`, `request_date`, `s_price`, `request_code`, `tech_id`, `assign_tech`, `tech_mobile`, `tech_email`, `assign_date`, `work_date`, `r_status`, `admin_status`) VALUES
(1, 1, 'ac', 'maintenance', 'nothing jndjv jdjv jdnfkcc kskief kjirv hgbv  jfv', 'shubham ', 'h n 45 birla colony', 'aajad chauk', 'Pilani', 'Rajasthan', 'shubhamkumarbiwal@gmail.com', 6345895624, 78955487, '2023-04-23', 700, 'eKjuJMpr62', 1, 'shubham kumar', 637896545, 'shubhamkumarbiwal@gmail.com', '2023-04-25', '2023-04-24', 3, 2),
(4, 1, 'tv', 'installation', 'nothing jndjv jdjv jdnfkcc kskief kjirv hgbv  jfv', 'shubham ', 'h n 45 birla colony', 'aajad chauk', 'Pilani', 'Rajasthan', 'shubhamkumarbiwal@gmail.com', 6345895624, 0, '2023-04-23', 400, 't5E6xHj4M8', 1, 'shubham kumar', 637896545, 'shubhamkumarbiwal@gmail.com', '2023-04-28', '0000-00-00', 0, 0),
(5, 1, 'fridge', 'fault repair', 'nothing jndjv jdjv jdnfkcc kskief kjirv hgbv  jfv', 'shubham ', 'h n 45 birla colony', 'aajad chauk', 'Pilani', 'Rajasthan', 'shubhamkumarbiwal@gmail.com', 6345895624, 756982369, '2023-04-23', 550, 'hqD5RdXmzx', 1, 'shubham kumar', 637896545, 'shubhamkumarbiwal@gmail.com', '2023-04-24', '2023-04-23', 3, 2),
(6, 1, 'cooler', 'fault repair', 'nothing jndjv jdjv jdnfkcc kskief kjirv hgbv  jfv', 'shubham ', 'h n 45 birla colony', 'aajad chauk', 'Pilani', 'Rajasthan', 'shubhamkumarbiwal@gmail.com', 6345895624, 0, '2023-04-23', 350, 'UuHRV3b5kM', 1, 'shubham kumar', 637896545, 'shubhamkumarbiwal@gmail.com', '2023-04-26', '2023-04-24', 3, 2),
(7, 1, 'iron', 'fault repair', 'nothing jndjv jdjv jdnfkcc kskief kjirv hgbv  jfv', 'shubham ', 'h n 45 birla colony', 'aajad chauk', 'Pilani', 'Rajasthan', 'shubhamkumarbiwal@gmail.com', 6345895624, 0, '2023-04-23', 150, 'otOJ3QXGRC', 1, 'shubham kumar', 637896545, 'shubhamkumarbiwal@gmail.com', '2023-04-25', '0000-00-00', 0, 0),
(8, 1, 'fridge', 'fault repair', 'nothing jndjv jdjv jdnfkcc kskief kjirv hgbv  jfv', 'shubham ', 'h n 45 birla colony', 'aajad chauk', 'Pilani', 'Rajasthan', 'shubhamkumarbiwal@gmail.com', 6345895624, 0, '2023-04-24', 550, 'skatnVu9dg', 1, 'shubham kumar', 637896545, 'shubhamkumarbiwal@gmail.com', '2023-04-26', '2023-04-24', 3, 2),
(9, 1, 'juicer', 'fault repair', 'nothing jndjv jdjv jdnfkcc kskief kjirv hgbv  jfv', 'shubham ', 'h n 45 birla colony', 'aajad chauk', 'Pilani', 'Rajasthan', 'shubhamkumarbiwal@gmail.com', 6345895624, 0, '2023-04-24', 251, 'OlRd9oSKvI', 1, 'shubham kumar', 637896545, 'shubhamkumarbiwal@gmail.com', '2023-04-27', '0000-00-00', 2, 1),
(10, 1, 'cooler', 'fault repair', 'nothing jndjv jdjv jdnfkcc kskief kjirv hgbv  jfv', 'shubham ', 'h n 45 birla colony', 'aajad chauk', 'Pilani', 'Rajasthan', 'shubhamkumarbiwal@gmail.com', 6345895624, 0, '2023-04-24', 350, 'i6s4C5UPl3', 1, 'shubham kumar', 637896545, 'shubhamkumarbiwal@gmail.com', '2023-04-25', '0000-00-00', 2, 1),
(11, 1, 'ceiling fan', 'fault repair', 'nothing jndjv jdjv jdnfkcc kskief kjirv hgbv  jfv', 'shubham ', 'h n 45 birla colony', 'aajad chauk', 'Pilani', 'Rajasthan', 'shubhamkumarbiwal@gmail.com', 6345895624, 0, '2023-04-24', 400, 'DsbjIpXEHR', 1, 'shubham kumar', 637896545, 'shubhamkumarbiwal@gmail.com', '2023-04-24', '0000-00-00', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `services_tb`
--

CREATE TABLE `services_tb` (
  `s_id` int(11) NOT NULL,
  `appliance_name` varchar(60) COLLATE latin7_general_cs NOT NULL,
  `service_name` varchar(60) COLLATE latin7_general_cs NOT NULL,
  `service_price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin7 COLLATE=latin7_general_cs;

--
-- Dumping data for table `services_tb`
--

INSERT INTO `services_tb` (`s_id`, `appliance_name`, `service_name`, `service_price`) VALUES
(2, 'ceiling fan', 'fault repair', 400),
(3, 'ceiling fan', 'maintenance', 500),
(4, 'tv', 'fault repair', 450),
(6, 'ac', 'maintenance', 700),
(7, 'ac', 'fault repair', 600),
(8, 'ac', 'installation', 550),
(9, 'ceiling fan', 'installation', 250),
(10, 'tv', 'installation', 400),
(11, 'tv', 'maintenance', 350),
(12, 'washing machine', 'fault repair', 850),
(13, 'washing machine', 'installation', 250),
(14, 'washing machine', 'maintenance', 280),
(15, 'fridge', 'fault repair', 550),
(16, 'cooler', 'fault repair', 350),
(17, 'iron', 'fault repair', 150),
(19, 'juicer', 'fault repair', 251),
(24, 'juicer', 'maintenance', 154);

-- --------------------------------------------------------

--
-- Table structure for table `technician_tb`
--

CREATE TABLE `technician_tb` (
  `tech_id` int(11) NOT NULL,
  `tech_name` varchar(60) COLLATE latin7_general_cs NOT NULL,
  `tech_city` varchar(60) COLLATE latin7_general_cs NOT NULL,
  `tech_mobile` bigint(20) NOT NULL,
  `tech_email` varchar(60) COLLATE latin7_general_cs NOT NULL,
  `tech_password` varchar(60) COLLATE latin7_general_cs NOT NULL,
  `code` int(11) NOT NULL,
  `t_img` varchar(60) COLLATE latin7_general_cs NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin7 COLLATE=latin7_general_cs;

--
-- Dumping data for table `technician_tb`
--

INSERT INTO `technician_tb` (`tech_id`, `tech_name`, `tech_city`, `tech_mobile`, `tech_email`, `tech_password`, `code`, `t_img`) VALUES
(1, 'shubham kumar', 'pilani', 637896545, 'shubhamkumarbiwal@gmail.com', '1234', 0, 'tech_images/image2.jpeg'),
(2, 'sagar chauhan', 'meerut', 8660462671, 'nssagarrajput@gmail.com', '1234', 0, ''),
(3, 'hrishabh raj', 'patna', 745698239, 'raj.hrishabh@gmail.com', '1234', 0, ''),
(4, 'rahul poddar', 'delhi', 742369853, 'rahul@gmail.com', '1234', 0, ''),
(5, 'aditya powder', 'darbhanga', 8574962697, 'aditya@gmail.com', '4567', 0, ''),
(6, 'avinash mishra', 'gorakhpur', 7569823698, 'avinash@gmail.com', '2589', 0, '');

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
  `u_image` varchar(255) COLLATE latin7_general_cs NOT NULL,
  `code` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin7 COLLATE=latin7_general_cs;

--
-- Dumping data for table `user_login`
--

INSERT INTO `user_login` (`u_id`, `u_name`, `u_email`, `u_password`, `u_add1`, `u_add2`, `u_city`, `u_state`, `u_zip`, `u_mobile`, `u_image`, `code`) VALUES
(1, 'shubham ', 'shubhamkumarbiwal@gmail.com', '1234', 'street no 5', 'Buhana', 'Jhunjhunu', 'Rajasthan', 333502, 6345895624, 'pf_images/image2.jpeg', 544548),
(2, 'SSS', 'sk@ss', '4', '', '', '', '', 0, 888, '', 0),
(5, 'dummy', 'dummy@d', '22', '', '', '', '', 0, 7410, '', 0),
(10, 'kumar biwal', 'k@k', 'bb', '', '', '', '', 0, 741, '', 0),
(11, 'Sagar', 'nssagarrajput@gmail.com', '1234', '', '', '', 'Uttar Pradesh', 0, 8630115689, '', 760443),
(12, 'rohan', 'rohan@gmail.com', '1234', '', '', '', '', 0, 412356987, '', 0),
(13, 'rohan kumar', 'rohanku@gmail.com', '1234', '', '', '', '', 0, 979797, '', 0),
(14, 'Avinash', 'avinash@gmail.com', '78', '', '', '', '', 0, 745689635, '', 0),
(15, 'Avinash mishra', 'avinashm@gmail.com', '1234', '', '', '', '', 0, 7456949, '', 0),
(16, 'Avinash mishra', 'avinashmi@gmail.com', '1234', '', '', '', '', 0, 7946565, '', 0),
(17, 'Avinash kumar', 'avinashmk@gmail.com', '4321', '', '', '', '', 0, 74566985, '', 0),
(18, 'Knox Doyle', 'selojasile@mailinator.com', 'sagar', '', '', '', '', 0, 87, '', 0),
(19, 'Jana Baxter', 'fulow@mailinator.com', 'Pa$$w0rd!', '', '', '', '', 0, 72, '', 0),
(20, 'Cody Avery', 'zedubik@mailinator.com', 'Pa$$w0rd!', '', '', '', '', 0, 24, '', 0),
(21, 'Irma Donaldson', 'dosylyc@mailinator.com', 'Pa$$w0rd!', '', '', '', '', 0, 63, '', 0);

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
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`m_id`);

--
-- Indexes for table `product_sell`
--
ALTER TABLE `product_sell`
  ADD PRIMARY KEY (`cid`);

--
-- Indexes for table `requests_tb`
--
ALTER TABLE `requests_tb`
  ADD PRIMARY KEY (`request_id`);

--
-- Indexes for table `services_tb`
--
ALTER TABLE `services_tb`
  ADD PRIMARY KEY (`s_id`);

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
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `m_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `product_sell`
--
ALTER TABLE `product_sell`
  MODIFY `cid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `requests_tb`
--
ALTER TABLE `requests_tb`
  MODIFY `request_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `services_tb`
--
ALTER TABLE `services_tb`
  MODIFY `s_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `technician_tb`
--
ALTER TABLE `technician_tb`
  MODIFY `tech_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `user_login`
--
ALTER TABLE `user_login`
  MODIFY `u_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
