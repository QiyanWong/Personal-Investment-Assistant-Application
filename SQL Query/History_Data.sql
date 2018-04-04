-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Apr 20, 2017 at 03:10 AM
-- Server version: 5.6.35
-- PHP Version: 7.0.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `History_Data`
--

-- --------------------------------------------------------

--
-- Table structure for table `CCF`
--

CREATE TABLE `CCF` (
  `His_Date` date DEFAULT NULL,
  `Open_Price` decimal(10,6) NOT NULL,
  `High_Price` decimal(10,6) NOT NULL,
  `Low_Price` decimal(10,6) NOT NULL,
  `Close_Price` decimal(10,6) NOT NULL,
  `Volume` decimal(20,0) NOT NULL,
  `Adj_Close` decimal(10,6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `FB`
--

CREATE TABLE `FB` (
  `His_Date` date DEFAULT NULL,
  `Open_Price` decimal(10,6) NOT NULL,
  `High_Price` decimal(10,6) NOT NULL,
  `Low_Price` decimal(10,6) NOT NULL,
  `Close_Price` decimal(10,6) NOT NULL,
  `Volume` decimal(20,0) NOT NULL,
  `Adj_Close` decimal(10,6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `GOOG`
--

CREATE TABLE `GOOG` (
  `His_Date` date DEFAULT NULL,
  `Open_Price` decimal(10,6) NOT NULL,
  `High_Price` decimal(10,6) NOT NULL,
  `Low_Price` decimal(10,6) NOT NULL,
  `Close_Price` decimal(10,6) NOT NULL,
  `Volume` decimal(20,0) NOT NULL,
  `Adj_Close` decimal(10,6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `MSFT`
--

CREATE TABLE `MSFT` (
  `His_Date` date DEFAULT NULL,
  `Open_Price` decimal(10,6) NOT NULL,
  `High_Price` decimal(10,6) NOT NULL,
  `Low_Price` decimal(10,6) NOT NULL,
  `Close_Price` decimal(10,6) NOT NULL,
  `Volume` decimal(20,0) NOT NULL,
  `Adj_Close` decimal(10,6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `YHOO`
--

CREATE TABLE `YHOO` (
  `His_Date` date DEFAULT NULL,
  `Open_Price` decimal(10,6) NOT NULL,
  `High_Price` decimal(10,6) NOT NULL,
  `Low_Price` decimal(10,6) NOT NULL,
  `Close_Price` decimal(10,6) NOT NULL,
  `Volume` decimal(20,0) NOT NULL,
  `Adj_Close` decimal(10,6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
