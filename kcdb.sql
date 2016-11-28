-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 28, 2016 at 01:55 AM
-- Server version: 10.1.16-MariaDB
-- PHP Version: 5.6.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kcdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `car_model`
--

CREATE TABLE `car_model` (
  `CAR_ID` int(11) NOT NULL,
  `MANUFACTURER` varchar(255) NOT NULL,
  `MODEL` varchar(255) NOT NULL,
  `PRICE` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `car_model`
--

INSERT INTO `car_model` (`CAR_ID`, `MANUFACTURER`, `MODEL`, `PRICE`) VALUES
(1, 'lamborghini', 'AVENTADOR ROADSTER', 20000000),
(2, 'lamborghini', 'HURACAN COUPE', 10000000),
(3, 'Porsche', '918 Spyder', 40000000),
(4, 'Porsche', '911 Turbo S', 10000000),
(5, 'Bugatti', 'CHIRON', 100000000),
(6, 'Bugatti', 'VEYRON', 70000000),
(7, 'Audi', 'RS 7', 5000000),
(8, 'Audi', 'R8 V10 Plus', 10000000);

-- --------------------------------------------------------

--
-- Table structure for table `car_order`
--

CREATE TABLE `car_order` (
  `CAR_ORDER_ID` int(11) NOT NULL,
  `CAR_ID` int(11) NOT NULL,
  `PRICE` int(11) NOT NULL,
  `EX_COLOR_ID` int(11) NOT NULL,
  `IN_COLOR_ID` int(11) NOT NULL,
  `WHEEL_ID` int(11) NOT NULL,
  `INSURANCE` varchar(25) NOT NULL,
  `SALESMAN_ID` int(11) NOT NULL,
  `CUSTOMER_ID` int(11) NOT NULL,
  `dealDate` date DEFAULT NULL,
  `DEPOSIT_PAYMENT_STATUS` date DEFAULT NULL,
  `REMAINING_PAYMENT_STATUS` date DEFAULT NULL,
  `ORDER_STATUS` varchar(25) NOT NULL,
  `DELIVERY_STATUS` varchar(25) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `car_order`
--

INSERT INTO `car_order` (`CAR_ORDER_ID`, `CAR_ID`, `PRICE`, `EX_COLOR_ID`, `IN_COLOR_ID`, `WHEEL_ID`, `INSURANCE`, `SALESMAN_ID`, `CUSTOMER_ID`, `dealDate`, `DEPOSIT_PAYMENT_STATUS`, `REMAINING_PAYMENT_STATUS`, `ORDER_STATUS`, `DELIVERY_STATUS`) VALUES
(1, 5, 50170000, 2, 2, 2, 'Axa', 1, 1, '2016-10-24', '2016-10-31', '2016-10-31', 'Yes', 'Yes'),
(2, 1, 15160000, 5, 3, 1, 'Tanachart', 3, 2, '2016-10-23', '2016-10-30', NULL, 'No', 'No');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `CUSTOMER_ID` int(11) NOT NULL,
  `CUSTOMER_TITLE` varchar(50) NOT NULL,
  `CUSTOMER_FNAME` varchar(50) NOT NULL,
  `CUSTOMER_LNAME` varchar(50) NOT NULL,
  `CUSTOMER_ADDRESS` int(11) NOT NULL,
  `CUSTOMER_EMAIL` varchar(50) NOT NULL,
  `CUSTOMER_PINCODE` varchar(25) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`CUSTOMER_ID`, `CUSTOMER_TITLE`, `CUSTOMER_FNAME`, `CUSTOMER_LNAME`, `CUSTOMER_ADDRESS`, `CUSTOMER_EMAIL`, `CUSTOMER_PINCODE`) VALUES
(1, 'Mr.', 'NoppanutN', 'NongPle', 2, 'Nop@hotmail.com', '1021457896532'),
(2, 'Mr.', 'Faluke', 'Yutechalion', 1, 'Fluke@hotmail.com', '4125897652301'),
(3, '', 'abc', 'abc', 0, 'aa', '1234567890'),
(4, '', 'abc', 'abc', 0, 'aa', '1234567890'),
(5, '', 'aa', 'aa', 0, 'aaa', '12378213'),
(6, '', 'aa', 'aa', 0, 'aaa', '12378213'),
(7, '', 'aa', 'aabb', 0, 'aaa', '12378213'),
(8, '', 'aa', 'aabb', 0, 'aaa', '12378213'),
(9, '', 'aa', 'aabb', 0, 'aaa', '12378213'),
(10, '', 'aa', 'aabb', 3, 'aaa', '12378213'),
(11, '', 'aa', 'aabb', 12, 'aaa', '12378213'),
(12, '', 'aa', 'aabb', 12, 'aaa', '12378213'),
(13, '', 'aacas', 'aabbasc', 12, 'aaa', '12378213'),
(14, '', 'aacas', 'aabbasc', 12, 'aaa', '12378213'),
(15, '', 'aacas', 'aabbasc', 12, 'aaa', '12378213'),
(16, '', 'aacas', 'aabbasc', 12, 'aaa', '12378213'),
(17, '', 'ccbcbcb', 'cbcbcb', 14, 'sdafsa', '10574'),
(18, '', 'ccbcbcb', 'cbcbcb', 14, 'sdafsa', '10574'),
(19, '', 'ccbcbcb', 'cbcbcb', 14, 'sdafsa', '10574'),
(20, '', 'ccbcbcb', 'cbcbcb', 14, 'sdafsa', '10574'),
(21, '', 'ccbcbcb', 'cbcbcb', 14, 'sdafsa', '10574'),
(22, '', 'ccbcbcb', 'cbcbcb', 14, 'sdafsa', '10574'),
(23, '', 'ccbcbcb', 'cbcbcb', 14, 'sdafsa', '10574'),
(24, '', 'zaxs', 'sxaz', 16, 'dfsdf', '123123'),
(25, '', 'zaxsdfg', 'sxazdfgdfg', 16, 'dfsdf', '123123'),
(26, '', 'perry', 'perry', 18, 'g', 'g'),
(27, '', 'berry', 'berry', 18, 'd', '2'),
(28, '', 'qq', 'qq', 20, 'q', 'q'),
(29, '', 'nn', 'qq', 20, 'q', 'q'),
(30, '', 'nnb', 'qq', 22, 'q', 'q'),
(31, '', 'sadf', 'asdf', 23, '', ''),
(32, '', 'e', 'e', 24, 'e', 'e'),
(33, '', 'p', 'p', 25, 'p', 'p'),
(34, 'MR.', 'r', 'r', 26, 'r', 'r'),
(35, 'MS.', 'v', 'v', 27, 'v', 'v');

--
-- Triggers `customer`
--
DELIMITER $$
CREATE TRIGGER `ins_checkduplicatecustomer` BEFORE INSERT ON `customer` FOR EACH ROW BEGIN

DECLARE i,rowcount INT;
SET i = 1;
SET rowcount = (SELECT COUNT(*) FROM customer);

WHILE i<=rowcount DO

	IF new.CUSTOMER_FNAME = (SELECT CUSTOMER_FNAME FROM customer WHERE CUSTOMER_ID = i) AND new.CUSTOMER_LNAME = (SELECT CUSTOMER_LNAME FROM customer WHERE CUSTOMER_ID = i) THEN
    	SIGNAL SQLSTATE "45000"
        SET MESSAGE_TEXT = "duplicate customer";
    END IF;
    
    SET i = i+1;
END WHILE;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `customer_address`
--

CREATE TABLE `customer_address` (
  `ADDRESS_ID` int(11) NOT NULL,
  `ADDRESS` varchar(255) NOT NULL,
  `CITY` varchar(30) NOT NULL,
  `COUNTRY` varchar(30) NOT NULL,
  `ZIPCODE` varchar(5) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `customer_address`
--

INSERT INTO `customer_address` (`ADDRESS_ID`, `ADDRESS`, `CITY`, `COUNTRY`, `ZIPCODE`) VALUES
(1, '50/13 Phaholyotin Road Bangken', 'Bangkok', 'Thailand', '10220'),
(2, '50/14 Phaholyotin Road Bangken', 'Bangkok', 'Thailand', '10220'),
(3, 'asdfasdf', 'asdfas', 'asdfasdf', '123'),
(4, 'asdfasdf', 'asdfas', 'asdfasdf', '123'),
(5, 'asdfasdf', 'asdfas', 'asdfasdf', '123'),
(6, 'asdfasdf', 'asdfas', 'asdfasdf', '123'),
(7, 'asdfasdf', 'asdfas', 'asdfasdf', '123'),
(8, 'asdfasdf', 'asdfas', 'asdfasdf', '123'),
(9, 'a', 'a', 'a', 'a'),
(10, 'b', 'b', 'b', 'b'),
(11, 'c', 'c', 'c', 'c'),
(12, 'asdfa', 'asdfas', 'asdfasdf', '123'),
(13, 'asdfa', 'f', 'asdfasdf', '123'),
(14, 'sdfgsdfg', 'erter', 'ertert', 'erter'),
(15, 'sdfgsdfg', 'erter', 'ertert', 'erter'),
(16, 'asdgwdsesa', 'asdf', 'asdf', 'asdf'),
(17, 'asdgwdsesa', 'asdf', 'asdf', 'asdf'),
(18, 'm', 'g', 'g', 'g'),
(19, 'm', 'd', 'd', 'd'),
(20, 'q', 'q', 'q', 'q'),
(21, 'o', 'q', 'q', 'q'),
(22, 'od', 'q', 'q', 'q'),
(23, '', '', '', ''),
(24, 'e', 'e', 'e', 'e'),
(25, 'p', 'p', 'p', 'p'),
(26, 'r', 'r', 'r', 'r'),
(27, 'v', 'v', 'v', 'v');

--
-- Triggers `customer_address`
--
DELIMITER $$
CREATE TRIGGER `ins_checkduplicate` BEFORE INSERT ON `customer_address` FOR EACH ROW BEGIN

DECLARE rowcount INT;
DECLARE i INT;

SET i = 1;
SET rowcount = (SELECT COUNT(*) FROM customer_address);

WHILE i<=rowcount DO

	IF new.ADDRESS = (SELECT ADDRESS FROM customer_address WHERE ADDRESS_ID = i) THEN
    	SIGNAL SQLSTATE "45000"
        SET MESSAGE_TEXT = "duplicate address";
    END IF;
    
    SET i=i+1;
    
END WHILE;


END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `ex_color`
--

CREATE TABLE `ex_color` (
  `EX_COLOR_ID` int(11) NOT NULL,
  `EX_COLOR_NAME` varchar(25) NOT NULL,
  `PRICE` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ex_color`
--

INSERT INTO `ex_color` (`EX_COLOR_ID`, `EX_COLOR_NAME`, `PRICE`) VALUES
(1, 'Red', 100000),
(2, 'Blue', 100000),
(3, 'Green', 100000),
(4, 'Black', 100000),
(5, 'White', 100000);

-- --------------------------------------------------------

--
-- Table structure for table `in_color`
--

CREATE TABLE `in_color` (
  `IN_COLOR_ID` int(11) NOT NULL,
  `IN_COLOR_NAME` varchar(25) NOT NULL,
  `PRICE` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `in_color`
--

INSERT INTO `in_color` (`IN_COLOR_ID`, `IN_COLOR_NAME`, `PRICE`) VALUES
(1, 'Red', 100000),
(2, 'Black', 100000),
(3, 'Brown', 100000),
(4, 'White', 100000);

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `USER_ID` int(11) NOT NULL,
  `USER_TITLE` varchar(10) NOT NULL,
  `USER_FNAME` varchar(50) NOT NULL,
  `USER_LNAME` varchar(50) NOT NULL,
  `USER_ADDRESS` int(11) NOT NULL,
  `USER_EMAIL` varchar(50) NOT NULL,
  `USER_USERNAME` varchar(25) NOT NULL,
  `USER_PASSWD` varchar(25) NOT NULL,
  `USER_POSITION` varchar(25) NOT NULL,
  `USER_PINCODE` varchar(25) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`USER_ID`, `USER_TITLE`, `USER_FNAME`, `USER_LNAME`, `USER_ADDRESS`, `USER_EMAIL`, `USER_USERNAME`, `USER_PASSWD`, `USER_POSITION`, `USER_PINCODE`) VALUES
(1, 'Mr.', 'Rujiphat', 'Tanapitpibul', 2, 'rujiphat_cl2eam@hotmail.com', 'creamy', 'creamy1', 'salesman', '1101402153589'),
(2, 'Ms.', 'Mercy', 'Angel', 3, 'Mercy@hotmail.com', 'Mercy', 'Mercynarak', 'accountant', '2563487954102'),
(3, 'Ms.', 'Ana', 'Olaion', 1, 'Ana@hotmail.com', 'Ana', 'Anaoldmak', 'delivery man', '3458721021589');

-- --------------------------------------------------------

--
-- Table structure for table `useraddress`
--

CREATE TABLE `useraddress` (
  `ADDRESS_ID` int(11) NOT NULL,
  `ADDRESS` varchar(255) NOT NULL,
  `CITY` varchar(30) NOT NULL,
  `COUNTRY` varchar(30) NOT NULL,
  `ZIPCODE` varchar(5) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `useraddress`
--

INSERT INTO `useraddress` (`ADDRESS_ID`, `ADDRESS`, `CITY`, `COUNTRY`, `ZIPCODE`) VALUES
(1, '50/15 Phaholyotin Road Bangken', 'Bangkok', 'Thailand', '10220'),
(2, '50/16 Phaholyotin Road Bangken', 'Bangkok', 'Thailand', '10220'),
(3, '50/17 Phaholyotin Road Bangken', 'Bangkok', 'Thailand', '10220');

-- --------------------------------------------------------

--
-- Table structure for table `wheel`
--

CREATE TABLE `wheel` (
  `WHEEL_ID` int(11) NOT NULL,
  `WHEEL_NAME` varchar(25) NOT NULL,
  `PRICE` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `wheel`
--

INSERT INTO `wheel` (`WHEEL_ID`, `WHEEL_NAME`, `PRICE`) VALUES
(1, 'Blaque Diamond BD-8', 48000),
(2, 'Fuel Cleaver', 42500),
(3, 'Sporza V5', 40000);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `car_model`
--
ALTER TABLE `car_model`
  ADD PRIMARY KEY (`CAR_ID`);

--
-- Indexes for table `car_order`
--
ALTER TABLE `car_order`
  ADD PRIMARY KEY (`CAR_ORDER_ID`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`CUSTOMER_ID`);

--
-- Indexes for table `customer_address`
--
ALTER TABLE `customer_address`
  ADD PRIMARY KEY (`ADDRESS_ID`);

--
-- Indexes for table `ex_color`
--
ALTER TABLE `ex_color`
  ADD PRIMARY KEY (`EX_COLOR_ID`);

--
-- Indexes for table `in_color`
--
ALTER TABLE `in_color`
  ADD PRIMARY KEY (`IN_COLOR_ID`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`USER_ID`);

--
-- Indexes for table `useraddress`
--
ALTER TABLE `useraddress`
  ADD PRIMARY KEY (`ADDRESS_ID`);

--
-- Indexes for table `wheel`
--
ALTER TABLE `wheel`
  ADD PRIMARY KEY (`WHEEL_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `car_model`
--
ALTER TABLE `car_model`
  MODIFY `CAR_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `car_order`
--
ALTER TABLE `car_order`
  MODIFY `CAR_ORDER_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `CUSTOMER_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;
--
-- AUTO_INCREMENT for table `customer_address`
--
ALTER TABLE `customer_address`
  MODIFY `ADDRESS_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
--
-- AUTO_INCREMENT for table `ex_color`
--
ALTER TABLE `ex_color`
  MODIFY `EX_COLOR_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `in_color`
--
ALTER TABLE `in_color`
  MODIFY `IN_COLOR_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `USER_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `useraddress`
--
ALTER TABLE `useraddress`
  MODIFY `ADDRESS_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `wheel`
--
ALTER TABLE `wheel`
  MODIFY `WHEEL_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
