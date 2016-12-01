-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 30, 2016 at 05:59 PM
-- Server version: 10.1.16-MariaDB
-- PHP Version: 5.6.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+07:00";


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
DROP TABLE IF EXISTS `car_model`;
CREATE TABLE `car_model` (
  `CAR_ID` int(11) NOT NULL,
  `MANUFACTURER` varchar(255) NOT NULL,
  `MODEL` varchar(255) NOT NULL,
  `PRICE` int(11) NOT NULL,
  `DISABLE`int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `car_model`
--

INSERT INTO `car_model` (`CAR_ID`, `MANUFACTURER`, `MODEL`, `PRICE`,`DISABLE`) VALUES
(1, 'lamborghini', 'Aventador roadster', 20000000, 0),
(2, 'lamborghini', 'Hurucan Coupe', 12000000, 0),
(3, 'Porsche', '918 Spyder', 40000000, 0),
(4, 'Porsche', '911 Turbo S', 11000000, 0),
(5, 'Bugatti', 'Chiron', 100000000, 0),
(6, 'Bugatti', 'Veyron', 70000000, 0),
(7, 'Audi', 'RS 7', 5000000, 0),
(8, 'Audi', 'R8 V10 Plus', 10500000, 0);

-- --------------------------------------------------------

--
-- Table structure for table `car_order`
--
DROP TABLE IF EXISTS `car_order`;
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
  `ORDER_STATUS` varchar(25) NOT NULL DEFAULT 'Waiting for payment',
  `DELIVERY_STATUS` varchar(25) NOT NULL DEFAULT 'No'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--
DROP TABLE IF EXISTS `customer`;
CREATE TABLE `customer` (
  `CUSTOMER_ID` int(11) NOT NULL,
  `CUSTOMER_TITLE` varchar(50) NOT NULL,
  `CUSTOMER_FNAME` varchar(50) NOT NULL,
  `CUSTOMER_LNAME` varchar(50) NOT NULL,
  `CUSTOMER_DOB` date NOT NULL,
  `CUSTOMER_ADDRESS` int(11) NOT NULL,
  `CUSTOMER_EMAIL` varchar(50) NOT NULL,
  `CUSTOMER_PHONE` varchar(25) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`CUSTOMER_ID`, `CUSTOMER_TITLE`, `CUSTOMER_FNAME`, `CUSTOMER_LNAME`,`CUSTOMER_DOB`,`CUSTOMER_ADDRESS`, `CUSTOMER_EMAIL`, `CUSTOMER_PHONE`) VALUES
(1, 'Mr.', 'NoppanutN', 'NongPle','1996-1-1', 2, 'Nop@hotmail.com', '08000000000'),
(2, 'Mr.', 'Faluke', 'Yutechalion','1996-1-1', 1, 'Fluke@hotmail.com', '0811111111');


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
DROP TABLE IF EXISTS `customer_address`;
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
(2, '72/14 ABC Road Bangken', 'Bangkok', 'Thailand', '10220');


-- --------------------------------------------------------

--
-- Table structure for table `ex_color`
--
DROP TABLE IF EXISTS `ex_color`;
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
(2, 'Blue', 110000),
(3, 'Green', 120000),
(4, 'Black', 130000),
(5, 'White', 140000);

-- --------------------------------------------------------

--
-- Table structure for table `in_color`
--
DROP TABLE IF EXISTS `in_color`;
CREATE TABLE `in_color` (
  `IN_COLOR_ID` int(11) NOT NULL,
  `IN_COLOR_NAME` varchar(25) NOT NULL,
  `PRICE` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `in_color`
--

INSERT INTO `in_color` (`IN_COLOR_ID`, `IN_COLOR_NAME`, `PRICE`) VALUES
(1, 'Red', 130000),
(2, 'Black', 120000),
(3, 'Brown', 110000),
(4, 'White', 100000);

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--
DROP TABLE IF EXISTS `staff`;
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
  `USER_PHONE` varchar(25) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`USER_ID`, `USER_TITLE`, `USER_FNAME`, `USER_LNAME`, `USER_ADDRESS`, `USER_EMAIL`, `USER_USERNAME`, `USER_PASSWD`, `USER_POSITION`, `USER_PHONE`) VALUES
(1, 'Mr.', 'Rujiphat', 'Tanapitpibul', 2, 'rujiphat_cl2eam@hotmail.com', 'creamy', 'creamy1', 'salesman', '1101402'),
(2, 'Ms.', 'Mercy', 'Angel', 3, 'Mercy@hotmail.com', 'Mercy', 'Mercynarak', 'accountant', '2563487954102'),
(3, 'Ms.', 'Ana', 'Olaion', 1, 'Ana@hotmail.com', 'Ana', 'Anaoldmak', 'delivery man', '3458721021589'),
(4, 'Mr.', 'Admin', 'Admin', 1, 'Admin@gmail.com', 'admin', 'pass', 'admin', '0');


-- --------------------------------------------------------

--
-- Table structure for table `useraddress`
--
DROP TABLE IF EXISTS `useraddress`;
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
(1, '50/15 PhaholyotinA Road Bangken', 'Bangkok', 'Thailand', '10220'),
(2, '50/16 PhaholyotinB Road Bangken', 'Bangkok', 'Thailand', '10220'),
(3, '50/17 PhaholyotinC Road Bangken', 'Bangkok', 'Thailand', '10220'),
(4, '50/18 PhaholyotinD Road Bangken', 'Bangkok', 'Thailand', '10220');


-- --------------------------------------------------------

--
-- Table structure for table `wheel`
--
DROP TABLE IF EXISTS `wheel`;
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
  MODIFY `CAR_ORDER_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `CUSTOMER_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `customer_address`
--
ALTER TABLE `customer_address`
  MODIFY `ADDRESS_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
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
  MODIFY `USER_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `useraddress`
--
ALTER TABLE `useraddress`
  MODIFY `ADDRESS_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `wheel`
--
ALTER TABLE `wheel`
  MODIFY `WHEEL_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
