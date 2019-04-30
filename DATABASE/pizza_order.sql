-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
-- Generation Time: Apr 29, 2019 at 01:32 PM
-- Server version: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `pizza_order`
--

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE IF NOT EXISTS `orders` (
`id` int(11) NOT NULL,
  `time_placed` varchar(20) NOT NULL,
  `name` varchar(50) NOT NULL,
  `contact_number` varchar(20) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `time_placed`, `name`, `contact_number`) VALUES
(1, '20190109141844', 'Kennedy Owiro', '+254704026160'),
(2, '20190109192130', 'Martin W.', '+254767091908'),
(3, '20190414130449', 'Bruno Mars', '7850002100'),
(4, '20190414132503', 'Christine', '450110002'),
(5, '20190414132808', 'Demo', '4580000002');

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE IF NOT EXISTS `order_details` (
  `order_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `isPizza` int(11) NOT NULL COMMENT '1=Pizza, 0=Toppings',
  `qty` int(11) NOT NULL,
  `size` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`order_id`, `item_id`, `isPizza`, `qty`, `size`) VALUES
(1, 1, 1, 1, 10),
(1, 2, 1, 1, 18),
(1, 3, 1, 2, 14),
(1, 6, 1, 2, 18),
(1, 9, 1, 1, 14),
(1, 1, 0, 1, 14),
(1, 2, 0, 1, 10),
(1, 3, 0, 1, 18),
(1, 4, 0, 1, 10),
(1, 5, 0, 1, 18),
(1, 7, 0, 1, 10),
(1, 8, 0, 1, 14),
(1, 10, 0, 1, 18),
(2, 1, 1, 1, 10),
(2, 2, 1, 1, 18),
(2, 3, 1, 2, 14),
(2, 6, 1, 2, 18),
(2, 9, 1, 1, 14),
(2, 1, 0, 1, 14),
(2, 2, 0, 1, 10),
(2, 3, 0, 1, 18),
(2, 4, 0, 1, 10),
(2, 5, 0, 1, 18),
(2, 7, 0, 1, 10),
(2, 8, 0, 1, 14),
(2, 10, 0, 1, 18),
(3, 1, 1, 1, 14),
(3, 3, 1, 3, 18),
(3, 10, 1, 1, 10),
(3, 1, 0, 1, 10),
(4, 1, 0, 1, 10),
(4, 8, 1, 2, 14),
(5, 1, 0, 1, 10),
(5, 8, 1, 2, 14);

-- --------------------------------------------------------

--
-- Table structure for table `pizza`
--

CREATE TABLE IF NOT EXISTS `pizza` (
`id` int(11) NOT NULL,
  `category` varchar(20) NOT NULL,
  `name` varchar(30) NOT NULL,
  `description` varchar(200) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pizza`
--

INSERT INTO `pizza` (`id`, `category`, `name`, `description`) VALUES
(1, 'CLASSIC PIZZA', 'CHEESE', 'double layer of tomatoes'),
(2, 'CLASSIC PIZZA', 'FETA CHEESE', 'pepperoni\r\n'),
(3, 'CLASSIC PIZZA', 'PEPPERONI', 'pepperoni & Ham'),
(4, 'CLASSIC PIZZA', 'MANHATTAN MEATLOVERS', 'ham, pepperoni, sausage, Olives, Pineapple'),
(5, 'CLASSIC PIZZA', 'GARDEN SPECIAL', 'tomatoes, olives, sausage'),
(6, 'CLASSIC PIZZA', 'HAWAIIAN', 'ham and pineapple'),
(7, 'CLASSIC PIZZA', 'NEW YORK''S FINEST', 'Italian sausage, ham and pepperoni'),
(8, 'SPECIALTY PIZZA', 'WITH DELUXE TOPPINGS, 'Sausage', 'Feta cheese', 'Tomatoes', 'Olives'),

-- --------------------------------------------------------

--
-- Table structure for table `pizza_size`
--

CREATE TABLE IF NOT EXISTS `pizza_size` (
`id` int(11) NOT NULL,
  `pizza_id` int(11) NOT NULL,
  `size` int(3) NOT NULL COMMENT 'in inch',
  `price` float NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pizza_size`
--

INSERT INTO `pizza_size` (`id`, `pizza_id`, `size`, `price`) VALUES
(1, 1, Small, 12),
(2, 1, Medium, 14),
(3, 1, Large, 16),

-- --------------------------------------------------------

--
-- Table structure for table `toppings`
--

CREATE TABLE IF NOT EXISTS `toppings` (
`id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `toppings`
--

INSERT INTO `toppings` (`id`, `name`) VALUES
(1, 'Cheese'),
(2, 'Ham'),
(3, 'Pineapple'),
(4, 'Sausage'),
(5, 'Feta Cheese'),
(6, 'Pepperoni'),
(7, 'Tomatoes'),
(8, 'Olives');

-- --------------------------------------------------------

--
-- Table structure for table `toppings_size`
--

CREATE TABLE IF NOT EXISTS `toppings_size` (
`id` int(11) NOT NULL,
  `toppings_id` int(11) NOT NULL,
  `size` int(3) NOT NULL COMMENT 'in inch',
  `price` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `toppings_size`
--

INSERT INTO `toppings_size` (`id`, `toppings_id`, `size`, `price`) VALUES
(1, 1, Small, 0.05),
(2, 1, Medium, 0.75),
(3, 1, Large, 4),
(4, 2, Small, 35),
(5, 2, Medium, 0.75),
(6, 2, Large, 4),
(7, 3, Small, 35),
(8, 3, Medium, 0.75),
(9, 3, Large, 4),
(10, 4, Small, 0.05),
(11, 4, Medium, 0.75),
(12, 4, Large, 4),
(13, 5, Small, 2),
(14, 5, Medium, 3),
(15, 5, Large, 1),
(16, 6, Small, 0.05),
(17, 6, Medium, 3),
(18, 6, Large, 1),
(19, 7, Small, 2),
(20, 7, Medium, 3),
(21, 7, Large, 1),
(22, 8, Small, 2),
(23, 8, Medium, 3),
(24, 8, Large, 1);




--
-- Indexes for dumped tables
--

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pizza`
--
ALTER TABLE `pizza`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pizza_size`
--
ALTER TABLE `pizza_size`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `toppings`
--
ALTER TABLE `toppings`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `toppings_size`
--
ALTER TABLE `toppings_size`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `pizza`
--
ALTER TABLE `pizza`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `pizza_size`
--
ALTER TABLE `pizza_size`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=43;
--
-- AUTO_INCREMENT for table `toppings`
--
ALTER TABLE `toppings`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `toppings_size`
--
ALTER TABLE `toppings_size`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=34;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
