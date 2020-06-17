-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 03, 2020 at 08:48 PM
-- Server version: 10.1.40-MariaDB
-- PHP Version: 7.1.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `insurance`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `name` varchar(300) NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` varchar(300) NOT NULL,
  `role` varchar(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`, `email`, `password`, `role`) VALUES
(1, 'admin', 'admin@admin.com', '5f4dcc3b5aa765d61d8327deb882cf99', '0');

-- --------------------------------------------------------

--
-- Table structure for table `claims`
--

CREATE TABLE `claims` (
  `id` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `pnumber` int(11) NOT NULL,
  `agent_id` int(11) NOT NULL,
  `subject` varchar(500) NOT NULL,
  `message` varchar(500) NOT NULL,
  `date` date NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `claims`
--

INSERT INTO `claims` (`id`, `uid`, `pnumber`, `agent_id`, `subject`, `message`, `date`, `status`) VALUES
(1, 4, 2, 2, 'This claim is from client1 to agent1', 'This claim is from client1 to agent1', '2020-05-28', 1),
(2, 3, 1, 1, 'test test test test test testtest test test test test testtest test test test test testtest test test test test test', 'test test test test test testtest test test test test testtest test test test test testtest test test test test testtest test test test test testtest test test test test testtest test test test test testtest test test test test test', '2020-05-29', 1);

-- --------------------------------------------------------

--
-- Table structure for table `subscribers`
--

CREATE TABLE `subscribers` (
  `id` int(11) NOT NULL,
  `email` varchar(600) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subscribers`
--

INSERT INTO `subscribers` (`id`, `email`, `status`) VALUES
(1, 'saini.navneet007@gmail.com', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `fname` varchar(600) NOT NULL,
  `lname` varchar(600) NOT NULL,
  `phone` varchar(600) NOT NULL,
  `email` varchar(600) NOT NULL,
  `status` int(11) NOT NULL,
  `password` varchar(600) NOT NULL,
  `role` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `fname`, `lname`, `phone`, `email`, `status`, `password`, `role`) VALUES
(1, 'Agent', 'Agent123', '7707873000', 'agent@agent.com', 1, '202cb962ac59075b964b07152d234b70', 'a'),
(2, 'agent1', 'agent1', '9999999999', 'agent1@agent1.com', 1, '202cb962ac59075b964b07152d234b70', 'a'),
(3, 'client', 'client', '01111111111', 'client@client.com', 1, '202cb962ac59075b964b07152d234b70', 'c'),
(4, 'Client1', 'Client1', '0902318', 'client1@client1.com', 1, '202cb962ac59075b964b07152d234b70', 'c');

-- --------------------------------------------------------

--
-- Table structure for table `user_info`
--

CREATE TABLE `user_info` (
  `id` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `agent_id` int(11) NOT NULL,
  `pnumber` varchar(300) NOT NULL,
  `longi` varchar(11) DEFAULT '0',
  `lati` varchar(11) NOT NULL DEFAULT '0',
  `image` varchar(300) DEFAULT NULL,
  `address` varchar(600) NOT NULL,
  `plygonarray` varchar(600) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_info`
--

INSERT INTO `user_info` (`id`, `uid`, `agent_id`, `pnumber`, `longi`, `lati`, `image`, `address`, `plygonarray`) VALUES
(1, 3, 1, '1', '76.8213952', '30.7027226', 'images/google-mapdddd_1590684613.PNG', 'Chandigarh%20Railway%20Station%20%E0%A8%9A%E0%A9%B0%E0%A8%A1%E0%A9%80%E0%A8%97%E0%A9%9C%E0%A9%8D%E0%A8%B9%20%E0%A8%B0%E0%A9%87%E0%A8%B2%E0%A8%B5%E0%A9%87%20%E0%A8%B8%E0%A8%9F%E0%A9%87%E0%A8%B8%E0%A8%BC%E0%A8%A8,%20Daria,%20Chandigarh,%20India', '%5B%2230.702861%2C76.821198%22%2C%2230.702486%2C76.821297%22%2C%2230.702582%2C76.821954%22%2C%2230.702988%2C76.821772%22%5D'),
(2, 4, 2, '2', '87.3183852', '22.3405341', 'images/google-mapdddd_1590688677.PNG', 'Kharagpur%20Railway%20Station%20Road,%20Kharagpur,%20West%20Bengal,%20India', '%5B%2222.341067%2C87.318387%22%2C%2222.340903%2C87.318435%22%2C%2222.34092%2C87.318566%22%2C%2222.341097%2C87.318502%22%5D');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `claims`
--
ALTER TABLE `claims`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subscribers`
--
ALTER TABLE `subscribers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_info`
--
ALTER TABLE `user_info`
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
-- AUTO_INCREMENT for table `claims`
--
ALTER TABLE `claims`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `subscribers`
--
ALTER TABLE `subscribers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user_info`
--
ALTER TABLE `user_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
