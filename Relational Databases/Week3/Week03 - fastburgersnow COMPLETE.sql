-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 11, 2023 at 01:02 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fastburgersnow`
--

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `customer_id` int(11) NOT NULL,
  `customer_surname` varchar(45) DEFAULT NULL,
  `customer_firstname` varchar(45) DEFAULT NULL,
  `customer_phone` varchar(45) DEFAULT NULL,
  `customer_email` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`customer_id`, `customer_surname`, `customer_firstname`, `customer_phone`, `customer_email`) VALUES
(1, 'Smith', 'John', '5551234', 'john.smith@email.com'),
(2, 'Doe', 'Jane', '5555678', 'jane.doe@email.com'),
(3, 'Williams', 'David', '5559012', 'david.williams@email.com'),
(4, 'Lee', 'Sophie', '5553456', 'sophie.lee@email.com'),
(5, 'Brown', 'Michael', '5557890', 'michael.brown@email.com'),
(6, 'Garcia', 'Maria', '5552345', 'maria.garcia@email.com'),
(7, 'Taylor', 'Emily', '5556789', 'emily.taylor@email.com'),
(8, 'Martinez', 'Juan', '5550123', 'juan.martinez@email.com'),
(9, 'Anderson', 'Sarah', '5554567', 'sarah.anderson@email.com'),
(10, 'Jones', 'James', '5558901', 'james.jones@email.com');

-- --------------------------------------------------------

--
-- Table structure for table `ordering`
--

CREATE TABLE `ordering` (
  `customer_customer_id` int(11) NOT NULL,
  `staff_staff_id` int(11) NOT NULL,
  `order_item` varchar(45) DEFAULT NULL,
  `order_type` varchar(45) DEFAULT NULL,
  `order_time` datetime DEFAULT NULL,
  `order_date` date DEFAULT NULL,
  `payment_id` float DEFAULT NULL,
  `item_no` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ordering`
--

INSERT INTO `ordering` (`customer_customer_id`, `staff_staff_id`, `order_item`, `order_type`, `order_time`, `order_date`, `payment_id`, `item_no`) VALUES
(1, 1, 'Cheeseburger', 'Dine-in', '0000-00-00 00:00:00', '2023-05-11', 1, 1),
(2, 3, 'French Fries', 'Takeaway', '0000-00-00 00:00:00', '2023-05-11', 2, 4),
(3, 6, 'Coca-Cola', 'Dine-in', '0000-00-00 00:00:00', '2023-05-11', 3, 6),
(4, 2, 'Double Bacon Burger', 'Takeaway', '0000-00-00 00:00:00', '2023-05-12', 4, 2),
(5, 5, 'Sweet Potato Fries', 'Dine-in', '0000-00-00 00:00:00', '2023-05-12', 5, 5),
(6, 9, 'Vanilla Ice Cream', 'Takeaway', '0000-00-00 00:00:00', '2023-05-12', 6, 10),
(7, 7, 'Chocolate Brownie', 'Dine-in', '0000-00-00 00:00:00', '2023-05-13', 7, 9),
(8, 4, 'Pepsi', 'Takeaway', '0000-00-00 00:00:00', '2023-05-13', 8, 7),
(9, 10, 'Veggie Burger', 'Dine-in', '0000-00-00 00:00:00', '2023-05-13', 9, 3),
(10, 8, 'Sprite', 'Takeaway', '0000-00-00 00:00:00', '2023-05-14', 10, 8);

-- --------------------------------------------------------

--
-- Table structure for table `order_item`
--

CREATE TABLE `order_item` (
  `item_no` int(10) NOT NULL,
  `item_type` varchar(45) DEFAULT NULL,
  `item_name` varchar(45) DEFAULT NULL,
  `quantity` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_item`
--

INSERT INTO `order_item` (`item_no`, `item_type`, `item_name`, `quantity`) VALUES
(1, 'Burger', 'Cheeseburger', 2),
(2, 'Burger', 'Double Bacon Burger', 1),
(3, 'Burger', 'Veggie Burger', 3),
(4, 'Fries', 'French Fries', 4),
(5, 'Fries', 'Sweet Potato Fries', 2),
(6, 'Drink', 'Coca-Cola', 2),
(7, 'Drink', 'Pepsi', 1),
(8, 'Drink', 'Sprite', 1),
(9, 'Dessert', 'Chocolate Brownie', 2),
(10, 'Dessert', 'Vanilla Ice Cream', 3);

-- --------------------------------------------------------

--
-- Table structure for table `outlet`
--

CREATE TABLE `outlet` (
  `outlet_id` int(10) NOT NULL,
  `outlet_suburb` varchar(45) DEFAULT NULL,
  `outlet_phone` int(10) DEFAULT NULL,
  `company_id` int(10) DEFAULT NULL,
  `company_name` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `outlet`
--

INSERT INTO `outlet` (`outlet_id`, `outlet_suburb`, `outlet_phone`, `company_id`, `company_name`) VALUES
(1, 'Chatswood', 212345678, 1, 'FastBurgersNow'),
(2, 'Parramatta', 223456789, 1, 'FastBurgersNow'),
(3, 'Bondi Junction', 234567890, 1, 'FastBurgersNow'),
(4, 'Newtown', 245678901, 1, 'FastBurgersNow'),
(5, 'Surry Hills', 256789012, 1, 'FastBurgersNow'),
(6, 'Strathfield', 267890123, 1, 'FastBurgersNow'),
(7, 'Darlinghurst', 278901234, 1, 'FastBurgersNow'),
(8, 'North Sydney', 289012345, 1, 'FastBurgersNow'),
(9, 'Mascot', 290123456, 1, 'FastBurgersNow'),
(10, 'Bankstown', 201234567, 1, 'FastBurgersNow');

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `payment_id` float NOT NULL,
  `payment_amount` float DEFAULT NULL,
  `account_no` varchar(45) DEFAULT NULL,
  `bsb_no` varchar(45) DEFAULT NULL,
  `customer_customer_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`payment_id`, `payment_amount`, `account_no`, `bsb_no`, `customer_customer_id`) VALUES
(1, 100, '12345678', '064321', 1),
(2, 200.5, '87654321', '123456', 2),
(3, 50, '98765432', '654321', 3),
(4, 150.75, '45678901', '246810', 4),
(5, 75.25, '23456789', '135792', 5),
(6, 300, '34567890', '098765', 6),
(7, 125.5, '56789012', '975310', 7),
(8, 175.25, '78901234', '864209', 8),
(9, 80, '90123456', '753198', 9),
(10, 225.75, '01234567', '642087', 10);

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `staff_id` int(11) NOT NULL,
  `staff_surname` varchar(45) DEFAULT NULL,
  `staff_firstname` varchar(45) DEFAULT NULL,
  `outlet_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`staff_id`, `staff_surname`, `staff_firstname`, `outlet_id`) VALUES
(1, 'Smith', 'John', 1),
(2, 'Johnson', 'Emily', 2),
(3, 'Williams', 'James', 3),
(4, 'Brown', 'Sophia', 4),
(5, 'Garcia', 'Oliver', 5),
(6, 'Davis', 'Isabella', 6),
(7, 'Miller', 'Michael', 7),
(8, 'Wilson', 'Ava', 8),
(9, 'Jones', 'William', 9),
(10, 'Taylor', 'Mia', 10);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`customer_id`);

--
-- Indexes for table `ordering`
--
ALTER TABLE `ordering`
  ADD PRIMARY KEY (`customer_customer_id`,`staff_staff_id`),
  ADD KEY `item_no` (`item_no`),
  ADD KEY `payment_id` (`payment_id`);

--
-- Indexes for table `order_item`
--
ALTER TABLE `order_item`
  ADD PRIMARY KEY (`item_no`);

--
-- Indexes for table `outlet`
--
ALTER TABLE `outlet`
  ADD PRIMARY KEY (`outlet_id`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`payment_id`,`customer_customer_id`),
  ADD KEY `customer_customer_id` (`customer_customer_id`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`staff_id`),
  ADD KEY `outlet_id` (`outlet_id`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `ordering`
--
ALTER TABLE `ordering`
  ADD CONSTRAINT `ordering_ibfk_1` FOREIGN KEY (`customer_customer_id`) REFERENCES `customer` (`customer_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ordering_ibfk_2` FOREIGN KEY (`item_no`) REFERENCES `order_item` (`item_no`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ordering_ibfk_3` FOREIGN KEY (`payment_id`) REFERENCES `payment` (`payment_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `payment`
--
ALTER TABLE `payment`
  ADD CONSTRAINT `payment_ibfk_1` FOREIGN KEY (`customer_customer_id`) REFERENCES `customer` (`customer_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `staff`
--
ALTER TABLE `staff`
  ADD CONSTRAINT `staff_ibfk_1` FOREIGN KEY (`outlet_id`) REFERENCES `outlet` (`outlet_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
