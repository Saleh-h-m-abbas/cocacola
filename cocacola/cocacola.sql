-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Jan 05, 2019 at 03:29 AM
-- Server version: 5.7.23
-- PHP Version: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cocacola`
--

-- --------------------------------------------------------

--
-- Table structure for table `area`
--

CREATE TABLE `area` (
  `id` int(11) NOT NULL,
  `areadesc` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `area`
--

INSERT INTO `area` (`id`, `areadesc`) VALUES
(1, 'middle'),
(2, 'south'),
(3, 'north'),
(4, 'gaza');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `seg1` varchar(40) NOT NULL,
  `seg2` varchar(50) NOT NULL,
  `seg3` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `seg1`, `seg2`, `seg3`) VALUES
(5, 'cola', 'pet', 1.125),
(6, 'water', 'nrb', 1.5),
(7, 'cola', 'can', 2),
(8, 'water', 'pet', 330),
(9, 'juis', 'nrb', 300);

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `fullname` varchar(50) NOT NULL,
  `customertypeid` int(11) NOT NULL,
  `company` varchar(50) NOT NULL,
  `phone` int(11) NOT NULL,
  `areaid` int(11) NOT NULL,
  `country` varchar(20) NOT NULL,
  `street` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`id`, `username`, `fullname`, `customertypeid`, `company`, `phone`, `areaid`, `country`, `street`, `email`, `password`, `status`) VALUES
(8, 'saleh', 'saleh abbas', 1, 'paltel', 597398735, 1, 'ramallah', 'nablus', 'saleh.abbas@hotmail.com', '123', 0),
(10, 'ahmad', 'ahmad a h', 2, 'jorof', 7654321, 3, 'nablus', 'palestine', 'a@a.com', '321', 1);

-- --------------------------------------------------------

--
-- Table structure for table `customertype`
--

CREATE TABLE `customertype` (
  `custmeridty` int(11) NOT NULL,
  `typedesc` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `customertype`
--

INSERT INTO `customertype` (`custmeridty`, `typedesc`) VALUES
(1, 'supermarket'),
(2, 'reseller'),
(5, 'mini market'),
(6, 'restaurant'),
(8, 'mall');

-- --------------------------------------------------------

--
-- Table structure for table `cutomertableorder`
--

CREATE TABLE `cutomertableorder` (
  `cutomertableorderid` int(11) NOT NULL,
  `customerid` int(11) NOT NULL,
  `email` varchar(200) NOT NULL,
  `phone` int(11) NOT NULL,
  `typeid` int(11) NOT NULL,
  `companyname` varchar(200) NOT NULL,
  `areaid` int(11) NOT NULL,
  `country` varchar(200) NOT NULL,
  `street` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cutomertableorder`
--

INSERT INTO `cutomertableorder` (`cutomertableorderid`, `customerid`, `email`, `phone`, `typeid`, `companyname`, `areaid`, `country`, `street`) VALUES
(10, 10, 'a@a.com', 7654321, 2, 'jorof', 3, 'nablus', 'palestine'),
(11, 8, 'saleh.abbas@hotmail.com', 597398735, 1, 'paltel', 1, 'ramallah', 'nablus'),
(12, 10, 'a@a.com', 7654321, 2, 'jorof', 3, 'nablus', 'palestine'),
(13, 8, 'saleh.abbas@hotmail.com', 597398735, 1, 'paltel', 1, 'ramallah', 'nablus'),
(14, 10, 'a@a.com', 7654321, 2, 'jorof', 3, 'nablus', 'palestine'),
(15, 10, 'a@a.com', 7654321, 2, 'jorof', 3, 'nablus', 'palestine');

-- --------------------------------------------------------

--
-- Table structure for table `discount`
--

CREATE TABLE `discount` (
  `id` int(11) NOT NULL,
  `discountdesc` varchar(50) NOT NULL,
  `itemcodeid` int(11) NOT NULL,
  `percentage` double NOT NULL,
  `discounttypeid` int(11) NOT NULL,
  `from` datetime NOT NULL,
  `to` datetime NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `discount`
--

INSERT INTO `discount` (`id`, `discountdesc`, `itemcodeid`, `percentage`, `discounttypeid`, `from`, `to`, `status`) VALUES
(2, 'discount %10', 209, 0.1, 1, '2018-11-21 00:00:00', '2018-11-30 00:00:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `discounttype`
--

CREATE TABLE `discounttype` (
  `id` int(11) NOT NULL,
  `type` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `discounttype`
--

INSERT INTO `discounttype` (`id`, `type`) VALUES
(1, 'bill'),
(2, 'item');

-- --------------------------------------------------------

--
-- Table structure for table `emp`
--

CREATE TABLE `emp` (
  `empno` int(11) NOT NULL,
  `user` varchar(40) NOT NULL,
  `email` varchar(200) NOT NULL,
  `pass` int(11) NOT NULL,
  `groupID` int(11) NOT NULL,
  `Date` date NOT NULL,
  `loged` int(11) NOT NULL DEFAULT '0',
  `status` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `emp`
--

INSERT INTO `emp` (`empno`, `user`, `email`, `pass`, `groupID`, `Date`, `loged`, `status`) VALUES
(1, 'admin', 'saleh.abbas@hotmail.com', 123456, 3, '0000-00-00', 0, 1),
(2, 'saleh', 'abbas@h.com', 123456, 2, '0000-00-00', 0, 1),
(12, 'ahmad', 'ahmad@nbc.ps', 123, 1, '2018-11-21', 0, 1),
(13, 'mahmood', 'mahmood@nbc.ps', 123, 2, '2018-11-21', 0, 1),
(14, 'ali', 'ali@nbc.ps', 123, 2, '2018-11-24', 0, 1),
(15, 'jad', 'jad@nbc.ps', 123, 1, '2018-11-24', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `invoice`
--

CREATE TABLE `invoice` (
  `invoiceid` int(11) NOT NULL,
  `selesmanid` int(11) NOT NULL,
  `customeridtable` int(11) NOT NULL,
  `ordertypeid` int(11) NOT NULL,
  `discountid` int(11) NOT NULL,
  `taxid` int(11) NOT NULL,
  `note` varchar(200) NOT NULL,
  `total` int(11) NOT NULL,
  `Invoicedate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `invoice`
--

INSERT INTO `invoice` (`invoiceid`, `selesmanid`, `customeridtable`, `ordertypeid`, `discountid`, `taxid`, `note`, `total`, `Invoicedate`) VALUES
(8, 2, 10, 1, 2, 1, '12', 24957, '2018-12-20'),
(9, 2, 11, 1, 2, 1, 'dd', 572, '2018-11-20'),
(10, 2, 12, 2, 2, 1, 'dd', 2468, '2018-10-20'),
(11, 2, 13, 1, 2, 1, 'as', 15264, '2018-12-20'),
(12, 2, 14, 2, 2, 1, 'dd', 3498, '2018-12-20'),
(13, 2, 15, 1, 2, 1, 'fff', 15264, '2018-12-20');

-- --------------------------------------------------------

--
-- Table structure for table `invTranslation`
--

CREATE TABLE `invTranslation` (
  `codeinvt` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `uofmcode` int(11) NOT NULL,
  `itemcodetrans` int(11) NOT NULL,
  `trxtypecode` int(11) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `fromorg` int(11) NOT NULL,
  `toorg` int(11) NOT NULL,
  `note` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `invTranslation`
--

INSERT INTO `invTranslation` (`codeinvt`, `qty`, `uofmcode`, `itemcodetrans`, `trxtypecode`, `date`, `time`, `fromorg`, `toorg`, `note`) VALUES
(2, 120, 1, 209, 1, '2018-11-21', '13:52:52', 47, 49, 'send'),
(3, 44, 2, 210, 48, '2018-11-21', '13:53:13', 49, 48, ''),
(4, -40, 1, 209, 1, '2018-11-21', '14:42:14', 47, 55, '');

-- --------------------------------------------------------

--
-- Table structure for table `invtranstype`
--

CREATE TABLE `invtranstype` (
  `invtycode` int(11) NOT NULL,
  `trxtypedesc` varchar(50) NOT NULL,
  `typeoftype` int(11) NOT NULL DEFAULT '0',
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `invtranstype`
--

INSERT INTO `invtranstype` (`invtycode`, `trxtypedesc`, `typeoftype`, `status`) VALUES
(1, 'Account issue', 0, 1),
(2, 'Subinventory Transfer', 1, 1),
(3, 'Direct Org Transfer', 1, 1),
(4, 'Cycle Count Adjust', 1, 1),
(5, 'Cycle Count Transfer', 1, 1),
(8, 'Physical Inv Adjust', 1, 1),
(9, 'Physical Inv Transfer', 1, 1),
(12, 'Intransit Receipt', 1, 1),
(15, 'RMA Receipt', 1, 1),
(17, 'WIP Completion Return', 1, 1),
(18, 'PO Receipt', 1, 1),
(21, 'Intransit Shipment', 1, 1),
(24, 'Standard cost update', 1, 1),
(25, 'WIP cost update', 1, 1),
(26, 'Periodic Cost Update', 1, 1),
(31, 'Account alias issue', 1, 1),
(32, 'Miscellaneous issue', 1, 1),
(33, 'Sales order issue', 1, 1),
(34, 'Internal order issue', 1, 1),
(35, 'WIP Issue', 1, 1),
(36, 'Return to Vendor', 1, 1),
(37, 'RMA Return', 1, 1),
(38, 'WIP Negative Issue', 1, 1),
(40, 'Account receipt', 1, 1),
(41, 'Account alias receipt', 1, 1),
(42, 'Miscellaneous receipt', 1, 1),
(43, 'WIP Return', 1, 1),
(44, 'WIP Completion', 1, 1),
(48, 'WIP Negative Return', 1, 1),
(50, 'Internal Order Xfer', 1, 1),
(51, 'Backflush Transfer', 1, 1),
(52, 'Sales Order Pick', 1, 1),
(53, 'Internal Order Pick', 1, 1),
(54, 'Int Order Direct Ship', 1, 1),
(61, 'Int Req Intr Rcpt', 1, 1),
(62, 'Int Order Intr Ship', 1, 1),
(63, 'Move Order Issue', 1, 1),
(64, 'Move Order Transfer', 1, 1),
(66, 'Project Borrow', 1, 1),
(67, 'Project Transfer', 1, 1),
(68, 'Project Payback', 1, 1),
(70, 'Shipment Rcpt Adjust', 1, 1),
(71, 'PO Rcpt Adjust', 1, 1),
(72, 'Int Req Rcpt Adjust', 1, 1),
(77, 'ProjectContract Issue', 1, 1),
(80, 'Average cost update', 1, 1),
(82, 'Inventory Lot Split', 1, 1),
(83, 'Inventory Lot Merge', 1, 1),
(84, 'Inventory Lot Translate', 1, 1),
(86, 'Cost Group Transfer', 1, 1),
(88, 'Container Unpack', 1, 1),
(90, 'WIP assembly scrap', 1, 1),
(91, 'WIP return from scrap', 1, 1),
(92, 'WIP estimated scrap', 1, 1),
(100, 'NBC Raw Material Consumption', 1, 1),
(101, 'NBC FG Production', 1, 1),
(102, 'trxtypedesc', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `item`
--

CREATE TABLE `item` (
  `itemcode` int(11) NOT NULL,
  `itemdesc` varchar(50) NOT NULL,
  `itemtype` int(50) NOT NULL,
  `itemcat` int(11) NOT NULL,
  `barcode` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `canbesold` int(11) NOT NULL DEFAULT '0',
  `addpos` int(11) NOT NULL DEFAULT '0',
  `addweb` int(11) NOT NULL DEFAULT '0',
  `weight` double NOT NULL,
  `descriptionforcustomers` varchar(500) NOT NULL,
  `descriptionfordeliveryorders` varchar(500) NOT NULL,
  `descriptionforinternaltransfers` varchar(500) NOT NULL,
  `itemimage` varchar(2000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `item`
--

INSERT INTO `item` (`itemcode`, `itemdesc`, `itemtype`, `itemcat`, `barcode`, `status`, `canbesold`, `addpos`, `addweb`, `weight`, `descriptionforcustomers`, `descriptionfordeliveryorders`, `descriptionforinternaltransfers`, `itemimage`) VALUES
(209, 'cocacola', 3, 7, 111, 1, 1, 1, 1, 5, 'a', 'b', 'c', 'coca-cola-2-liter.jpg'),
(210, 'Fanta', 3, 5, 112, 1, 1, 0, 1, 4, 'd', 'e', 'f', 'image.png'),
(211, 'arwa', 3, 8, 113, 1, 1, 1, 1, 4, 'j', 'h', 'k', '144703-001.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `itemonhand`
--

CREATE TABLE `itemonhand` (
  `itco` int(11) NOT NULL,
  `qty` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `itemonhand`
--

INSERT INTO `itemonhand` (`itco`, `qty`) VALUES
(209, 80),
(210, 44),
(211, 0);

-- --------------------------------------------------------

--
-- Table structure for table `itemprice`
--

CREATE TABLE `itemprice` (
  `itemcprice` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `from` date NOT NULL,
  `to` date NOT NULL,
  `cost` double NOT NULL,
  `time` datetime NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `itemprice`
--

INSERT INTO `itemprice` (`itemcprice`, `price`, `from`, `to`, `cost`, `time`, `status`) VALUES
(209, 12, '2018-11-21', '2018-11-30', 7, '2018-11-21 13:49:59', 0),
(210, 15, '2018-11-21', '2018-11-25', 10, '2018-11-21 13:51:04', 0),
(211, 8, '2018-11-21', '2018-11-23', 6, '2018-11-21 13:52:05', 0),
(209, 20, '2018-12-01', '2018-12-31', 0, '2018-11-21 14:59:49', 0),
(210, 12, '2018-11-14', '2018-11-20', 0, '2018-11-21 15:01:25', 0),
(210, 11, '2018-11-07', '2018-11-13', 0, '2018-11-21 15:03:34', 0),
(210, 14, '2018-11-22', '2018-11-24', 0, '2018-11-21 15:03:54', 1),
(209, 120, '2018-11-29', '2018-11-30', 0, '2018-11-21 15:13:03', 0),
(209, 120, '2018-11-29', '2018-11-30', 0, '2018-11-21 15:13:05', 0),
(209, 120, '2018-11-29', '2018-11-30', 0, '2018-11-21 15:13:26', 0),
(209, 120, '2018-11-29', '2018-11-30', 0, '2018-11-21 15:13:40', 0),
(209, 120, '2018-11-29', '2018-11-30', 0, '2018-11-21 15:13:51', 0),
(209, 120, '2018-11-29', '2018-11-30', 0, '2018-11-21 15:14:21', 0),
(209, 120, '2018-11-29', '2018-11-30', 0, '2018-11-21 15:14:33', 0),
(209, 120, '2018-11-29', '2018-11-30', 0, '2018-11-21 15:14:37', 0),
(209, 120, '2018-11-29', '2018-11-30', 0, '2018-11-21 15:15:57', 0),
(211, 150, '2019-01-01', '2019-01-31', 0, '2018-11-21 15:16:19', 1),
(209, 12, '2018-11-22', '2018-11-30', 0, '2018-11-21 15:43:35', 1);

-- --------------------------------------------------------

--
-- Table structure for table `itemtype`
--

CREATE TABLE `itemtype` (
  `id` int(11) NOT NULL,
  `type` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `itemtype`
--

INSERT INTO `itemtype` (`id`, `type`) VALUES
(1, 'FG'),
(2, 'Raw Material'),
(3, 'Spare part');

-- --------------------------------------------------------

--
-- Table structure for table `itemuofm`
--

CREATE TABLE `itemuofm` (
  `unititemcodeid` int(11) NOT NULL,
  `uofmid` int(11) NOT NULL,
  `numberofitem` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `itemuofm`
--

INSERT INTO `itemuofm` (`unititemcodeid`, `uofmid`, `numberofitem`) VALUES
(209, 2, 100),
(209, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `offer`
--

CREATE TABLE `offer` (
  `id` int(11) NOT NULL,
  `descoffer` varchar(50) NOT NULL,
  `offeritemcode` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `Bonus` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `offer`
--

INSERT INTO `offer` (`id`, `descoffer`, `offeritemcode`, `qty`, `Bonus`, `status`) VALUES
(2, '100item|10B', 211, 100, 10, 1),
(3, '50item|7B', 209, 50, 7, 1);

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

CREATE TABLE `order` (
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ordertype`
--

CREATE TABLE `ordertype` (
  `id` int(11) NOT NULL,
  `type` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ordertype`
--

INSERT INTO `ordertype` (`id`, `type`) VALUES
(1, 'Cash'),
(2, 'Receivables'),
(3, 'sheaq');

-- --------------------------------------------------------

--
-- Table structure for table `organization`
--

CREATE TABLE `organization` (
  `orgcode` int(11) NOT NULL,
  `desc` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `organization`
--

INSERT INTO `organization` (`orgcode`, `desc`) VALUES
(47, 'ramallah'),
(48, 'hebron'),
(49, 'tulkarem'),
(55, 'jenin');

-- --------------------------------------------------------

--
-- Table structure for table `quotations`
--

CREATE TABLE `quotations` (
  `qid` int(11) NOT NULL,
  `invoicenumber` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `dateoforder` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `quotations`
--

INSERT INTO `quotations` (`qid`, `invoicenumber`, `status`, `dateoforder`) VALUES
(8, 8, 1, '2018-12-20'),
(9, 9, 1, '2018-11-20'),
(10, 10, 1, '2018-10-20'),
(11, 11, 1, '2018-12-20'),
(12, 12, 0, '2018-12-20'),
(13, 13, 0, '2018-12-20');

-- --------------------------------------------------------

--
-- Table structure for table `salesman`
--

CREATE TABLE `salesman` (
  `id` int(11) NOT NULL,
  `empid` int(11) NOT NULL,
  `areaid` int(11) NOT NULL,
  `supervisorid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `salesman`
--

INSERT INTO `salesman` (`id`, `empid`, `areaid`, `supervisorid`) VALUES
(1, 12, 1, 1),
(2, 15, 4, 3);

-- --------------------------------------------------------

--
-- Table structure for table `supervisors`
--

CREATE TABLE `supervisors` (
  `id` int(11) NOT NULL,
  `empid` int(11) NOT NULL,
  `areaid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `supervisors`
--

INSERT INTO `supervisors` (`id`, `empid`, `areaid`) VALUES
(1, 13, 1),
(3, 14, 4);

-- --------------------------------------------------------

--
-- Table structure for table `tableorderitem`
--

CREATE TABLE `tableorderitem` (
  `tableid` int(11) NOT NULL,
  `invnumber` int(11) NOT NULL,
  `itemid` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `uom` int(11) NOT NULL,
  `offerid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tableorderitem`
--

INSERT INTO `tableorderitem` (`tableid`, `invnumber`, `itemid`, `qty`, `uom`, `offerid`) VALUES
(9, 8, 211, 12, 1, 2),
(10, 8, 211, 144, 1, 2),
(11, 8, 209, 12, 1, 3),
(12, 9, 209, 33, 1, 3),
(13, 9, 209, 12, 1, 3),
(14, 10, 209, 44, 1, 3),
(15, 10, 211, 12, 1, 2),
(16, 11, 209, 12, 100, 3),
(17, 12, 211, 22, 1, 2),
(18, 13, 209, 12, 100, 3);

-- --------------------------------------------------------

--
-- Table structure for table `tax`
--

CREATE TABLE `tax` (
  `id` int(11) NOT NULL,
  `taxdesc` varchar(50) NOT NULL,
  `taxpersentage` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tax`
--

INSERT INTO `tax` (`id`, `taxdesc`, `taxpersentage`) VALUES
(1, '16% tax ', 0.16);

-- --------------------------------------------------------

--
-- Table structure for table `Typeofsale`
--

CREATE TABLE `Typeofsale` (
  `id` int(11) NOT NULL,
  `type` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Typeofsale`
--

INSERT INTO `Typeofsale` (`id`, `type`) VALUES
(1, 'Direct sale'),
(2, 'Indirect sale');

-- --------------------------------------------------------

--
-- Table structure for table `uofm`
--

CREATE TABLE `uofm` (
  `id` int(11) NOT NULL,
  `uofm` varchar(50) NOT NULL,
  `weightofqty` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `uofm`
--

INSERT INTO `uofm` (`id`, `uofm`, `weightofqty`) VALUES
(1, 'package', 1),
(2, 'pallet', 2);

-- --------------------------------------------------------

--
-- Table structure for table `warehouse`
--

CREATE TABLE `warehouse` (
  `witco` int(11) NOT NULL,
  `warehouse` int(11) NOT NULL,
  `orgassignment` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `area`
--
ALTER TABLE `area`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customertypeid` (`customertypeid`),
  ADD KEY `custareaid` (`areaid`);

--
-- Indexes for table `customertype`
--
ALTER TABLE `customertype`
  ADD PRIMARY KEY (`custmeridty`);

--
-- Indexes for table `cutomertableorder`
--
ALTER TABLE `cutomertableorder`
  ADD PRIMARY KEY (`cutomertableorderid`),
  ADD KEY `customeridrel` (`customerid`);

--
-- Indexes for table `discount`
--
ALTER TABLE `discount`
  ADD PRIMARY KEY (`id`),
  ADD KEY `discounttypeidrel` (`discounttypeid`),
  ADD KEY `itemcodedisid` (`itemcodeid`);

--
-- Indexes for table `discounttype`
--
ALTER TABLE `discounttype`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `emp`
--
ALTER TABLE `emp`
  ADD PRIMARY KEY (`empno`);

--
-- Indexes for table `invoice`
--
ALTER TABLE `invoice`
  ADD PRIMARY KEY (`invoiceid`),
  ADD KEY `salesmanidrel` (`selesmanid`),
  ADD KEY `customeridtablerel` (`customeridtable`),
  ADD KEY `ordertypeidrel` (`ordertypeid`),
  ADD KEY `discountidrel` (`discountid`),
  ADD KEY `taxidrel` (`taxid`);

--
-- Indexes for table `invTranslation`
--
ALTER TABLE `invTranslation`
  ADD PRIMARY KEY (`codeinvt`),
  ADD KEY `invtype` (`trxtypecode`),
  ADD KEY `itemcodein` (`itemcodetrans`),
  ADD KEY `fromorgancode` (`fromorg`),
  ADD KEY `toorgancode` (`toorg`),
  ADD KEY `uofmcode` (`uofmcode`);

--
-- Indexes for table `invtranstype`
--
ALTER TABLE `invtranstype`
  ADD PRIMARY KEY (`invtycode`);

--
-- Indexes for table `item`
--
ALTER TABLE `item`
  ADD PRIMARY KEY (`itemcode`),
  ADD KEY `codecat` (`itemcat`),
  ADD KEY `typeofitem` (`itemtype`);

--
-- Indexes for table `itemonhand`
--
ALTER TABLE `itemonhand`
  ADD KEY `itemcodeonhand` (`itco`);

--
-- Indexes for table `itemprice`
--
ALTER TABLE `itemprice`
  ADD KEY `itemcodeprice` (`itemcprice`);

--
-- Indexes for table `itemtype`
--
ALTER TABLE `itemtype`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `itemuofm`
--
ALTER TABLE `itemuofm`
  ADD KEY `uofmidrel` (`uofmid`),
  ADD KEY `itemcoderelationship` (`unititemcodeid`);

--
-- Indexes for table `offer`
--
ALTER TABLE `offer`
  ADD PRIMARY KEY (`id`),
  ADD KEY `offeritemcodeid` (`offeritemcode`);

--
-- Indexes for table `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ordertype`
--
ALTER TABLE `ordertype`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `organization`
--
ALTER TABLE `organization`
  ADD PRIMARY KEY (`orgcode`);

--
-- Indexes for table `quotations`
--
ALTER TABLE `quotations`
  ADD PRIMARY KEY (`qid`),
  ADD KEY `invoicenumber` (`invoicenumber`);

--
-- Indexes for table `salesman`
--
ALTER TABLE `salesman`
  ADD PRIMARY KEY (`id`),
  ADD KEY `areaidrel` (`areaid`),
  ADD KEY `empidrel` (`empid`),
  ADD KEY `supervisorsid` (`supervisorid`);

--
-- Indexes for table `supervisors`
--
ALTER TABLE `supervisors`
  ADD PRIMARY KEY (`id`),
  ADD KEY `areaid` (`areaid`),
  ADD KEY `empidrela` (`empid`);

--
-- Indexes for table `tableorderitem`
--
ALTER TABLE `tableorderitem`
  ADD PRIMARY KEY (`tableid`),
  ADD KEY `itemidrel` (`itemid`),
  ADD KEY `offeridrel` (`offerid`),
  ADD KEY `invnumberrel` (`invnumber`);

--
-- Indexes for table `tax`
--
ALTER TABLE `tax`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `Typeofsale`
--
ALTER TABLE `Typeofsale`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `uofm`
--
ALTER TABLE `uofm`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `warehouse`
--
ALTER TABLE `warehouse`
  ADD KEY `itemcodewarehouse` (`witco`),
  ADD KEY `org` (`orgassignment`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `area`
--
ALTER TABLE `area`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `customertype`
--
ALTER TABLE `customertype`
  MODIFY `custmeridty` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `cutomertableorder`
--
ALTER TABLE `cutomertableorder`
  MODIFY `cutomertableorderid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `discount`
--
ALTER TABLE `discount`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `discounttype`
--
ALTER TABLE `discounttype`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `emp`
--
ALTER TABLE `emp`
  MODIFY `empno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `invoice`
--
ALTER TABLE `invoice`
  MODIFY `invoiceid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `invTranslation`
--
ALTER TABLE `invTranslation`
  MODIFY `codeinvt` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `invtranstype`
--
ALTER TABLE `invtranstype`
  MODIFY `invtycode` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=103;

--
-- AUTO_INCREMENT for table `item`
--
ALTER TABLE `item`
  MODIFY `itemcode` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=212;

--
-- AUTO_INCREMENT for table `itemtype`
--
ALTER TABLE `itemtype`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `offer`
--
ALTER TABLE `offer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `order`
--
ALTER TABLE `order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ordertype`
--
ALTER TABLE `ordertype`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `quotations`
--
ALTER TABLE `quotations`
  MODIFY `qid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `salesman`
--
ALTER TABLE `salesman`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `supervisors`
--
ALTER TABLE `supervisors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tableorderitem`
--
ALTER TABLE `tableorderitem`
  MODIFY `tableid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `tax`
--
ALTER TABLE `tax`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `Typeofsale`
--
ALTER TABLE `Typeofsale`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `uofm`
--
ALTER TABLE `uofm`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `customer`
--
ALTER TABLE `customer`
  ADD CONSTRAINT `custareaid` FOREIGN KEY (`areaid`) REFERENCES `area` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `customertypeid` FOREIGN KEY (`customertypeid`) REFERENCES `customertype` (`custmeridty`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `cutomertableorder`
--
ALTER TABLE `cutomertableorder`
  ADD CONSTRAINT `customeridrel` FOREIGN KEY (`customerid`) REFERENCES `customer` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `discount`
--
ALTER TABLE `discount`
  ADD CONSTRAINT `discounttypeidrel` FOREIGN KEY (`discounttypeid`) REFERENCES `discounttype` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `itemcodedisid` FOREIGN KEY (`itemcodeid`) REFERENCES `item` (`itemcode`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `invoice`
--
ALTER TABLE `invoice`
  ADD CONSTRAINT `customeridtablerel` FOREIGN KEY (`customeridtable`) REFERENCES `cutomertableorder` (`cutomertableorderid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `discountidrel` FOREIGN KEY (`discountid`) REFERENCES `discount` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ordertypeidrel` FOREIGN KEY (`ordertypeid`) REFERENCES `ordertype` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `salesmanidrel` FOREIGN KEY (`selesmanid`) REFERENCES `salesman` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `taxidrel` FOREIGN KEY (`taxid`) REFERENCES `tax` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `invTranslation`
--
ALTER TABLE `invTranslation`
  ADD CONSTRAINT `fromorgancode` FOREIGN KEY (`fromorg`) REFERENCES `organization` (`orgcode`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `invtype` FOREIGN KEY (`trxtypecode`) REFERENCES `invtranstype` (`invtycode`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `itemcodein` FOREIGN KEY (`itemcodetrans`) REFERENCES `item` (`itemcode`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `toorgancode` FOREIGN KEY (`toorg`) REFERENCES `organization` (`orgcode`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `uofmcode` FOREIGN KEY (`uofmcode`) REFERENCES `uofm` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `item`
--
ALTER TABLE `item`
  ADD CONSTRAINT `codecat` FOREIGN KEY (`itemcat`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `typeofitem` FOREIGN KEY (`itemtype`) REFERENCES `itemtype` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `itemonhand`
--
ALTER TABLE `itemonhand`
  ADD CONSTRAINT `itemcodeonhand` FOREIGN KEY (`itco`) REFERENCES `item` (`itemcode`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `itemprice`
--
ALTER TABLE `itemprice`
  ADD CONSTRAINT `itemcodeprice` FOREIGN KEY (`itemcprice`) REFERENCES `item` (`itemcode`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `itemuofm`
--
ALTER TABLE `itemuofm`
  ADD CONSTRAINT `itemcoderelationship` FOREIGN KEY (`unititemcodeid`) REFERENCES `item` (`itemcode`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `uofmidrel` FOREIGN KEY (`uofmid`) REFERENCES `uofm` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `offer`
--
ALTER TABLE `offer`
  ADD CONSTRAINT `offeritemcodeid` FOREIGN KEY (`offeritemcode`) REFERENCES `item` (`itemcode`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `quotations`
--
ALTER TABLE `quotations`
  ADD CONSTRAINT `invoicenumber` FOREIGN KEY (`invoicenumber`) REFERENCES `invoice` (`invoiceid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `salesman`
--
ALTER TABLE `salesman`
  ADD CONSTRAINT `areaidrel` FOREIGN KEY (`areaid`) REFERENCES `area` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `empidrel` FOREIGN KEY (`empid`) REFERENCES `emp` (`empno`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `supervisorsid` FOREIGN KEY (`supervisorid`) REFERENCES `supervisors` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `supervisors`
--
ALTER TABLE `supervisors`
  ADD CONSTRAINT `areaid` FOREIGN KEY (`areaid`) REFERENCES `area` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `empidrela` FOREIGN KEY (`empid`) REFERENCES `emp` (`empno`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tableorderitem`
--
ALTER TABLE `tableorderitem`
  ADD CONSTRAINT `invnumberrel` FOREIGN KEY (`invnumber`) REFERENCES `invoice` (`invoiceid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `itemidrel` FOREIGN KEY (`itemid`) REFERENCES `item` (`itemcode`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `offeridrel` FOREIGN KEY (`offerid`) REFERENCES `offer` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `warehouse`
--
ALTER TABLE `warehouse`
  ADD CONSTRAINT `itemcodewarehouse` FOREIGN KEY (`witco`) REFERENCES `item` (`itemcode`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `org` FOREIGN KEY (`orgassignment`) REFERENCES `organization` (`orgcode`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
