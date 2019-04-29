-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 29, 2019 at 04:08 AM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sushi`
--

-- --------------------------------------------------------

--
-- Table structure for table `color`
--

CREATE TABLE `color` (
  `color_id` int(2) NOT NULL,
  `color_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `color`
--

INSERT INTO `color` (`color_id`, `color_name`) VALUES
(1, 'แดง'),
(2, 'เขียว'),
(3, 'ม่วง'),
(4, 'ดำ'),
(5, 'เหลือง'),
(6, 'ส้ม'),
(7, 'ชมพู'),
(8, 'ขาว');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `customer_id` int(3) UNSIGNED ZEROFILL NOT NULL,
  `title_id` int(2) NOT NULL,
  `name_store` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `customer_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `tel` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `telephone` varchar(40) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`customer_id`, `title_id`, `name_store`, `customer_name`, `address`, `tel`, `telephone`) VALUES
(001, 0, '', 'ลูกค้าเงินสด', '', '', ''),
(002, 1, 'ร้านธงชัย', 'ธงชัย ใจดี', 'หมู่บ้านพิมพาภรณ์ 292/94 หมู่ 10 ตำบลทุ่งสุขลา อำเภอศรีราชา จังหวัดชลบุรี 20230', '0-2333-3344', '089-765-4433'),
(003, 2, 'ร้านฟ้าใส', 'ฟ้าใส  มีสุข', 'หมู่บ้านทุ่งโปง 8/2 หมู่ 3 ถนนสุขุมวิท ตำบลบึง อำเภอศรีราชา จังหวัดชลบุรี 20210', '0-2454-6667', '090-456-7899'),
(004, 3, 'ร้านสุมารี ซูชิ', 'สุมารี ใจตรง', 'หมู่บ้านสริน 43/2 หมู่ 3 ถนนสุขุมวิท ตำบลทุ่งสุขลา อำเภอศรีราชา จังหวัดชลบุรี 20230', '0-2233-4454', '081-050-3489');

-- --------------------------------------------------------

--
-- Table structure for table `delivery`
--

CREATE TABLE `delivery` (
  `delivery_id` int(3) UNSIGNED ZEROFILL NOT NULL,
  `delivery_status_id` int(1) NOT NULL,
  `customer_id` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `delivery_status`
--

CREATE TABLE `delivery_status` (
  `delivery_status_id` int(1) NOT NULL,
  `delivery_status_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `delivery_status`
--

INSERT INTO `delivery_status` (`delivery_status_id`, `delivery_status_name`) VALUES
(1, 'จัดส่งแล้ว'),
(2, 'ยังไม่จัดส่ง');

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `login_id` int(3) UNSIGNED ZEROFILL NOT NULL,
  `email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`login_id`, `email`, `password`, `timestamp`) VALUES
(001, '', '12345', '2019-04-27 11:53:51'),
(002, 'sirinya@gmail.com', '12345', '2019-04-27 11:55:01'),
(003, 'sirinya@gmail.com', '12345', '2019-04-27 13:03:49'),
(004, 'sirinya@gmail.com', '12345', '2019-04-28 07:10:17'),
(005, 'sirin@gmail.com', '12345', '2019-04-28 07:10:57'),
(006, 'yanyong@gmail.com', '12345', '2019-04-28 07:11:27'),
(007, 'sirinya@gmail.com', '12345', '2019-04-28 07:11:56'),
(008, 'sirin@gmail.com', '12345', '2019-04-28 08:00:36'),
(009, 'sirinya@gmail.com', '12345', '2019-04-28 08:00:59'),
(010, 'sirinya@gmail.com', '12345', '2019-04-28 13:41:32'),
(011, 'sirinya@gmail.com', '12345', '2019-04-28 13:45:08'),
(012, 'sirinya@gmail.com', '12345', '2019-04-29 01:04:51');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `orders_id` int(3) UNSIGNED ZEROFILL NOT NULL,
  `store_id` int(3) NOT NULL,
  `products_id` int(3) NOT NULL,
  `stock_quantity` int(10) NOT NULL,
  `orders_sumprice` double(10,2) NOT NULL,
  `orders_total` double(10,2) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`orders_id`, `store_id`, `products_id`, `stock_quantity`, `orders_sumprice`, `orders_total`, `date`) VALUES
(027, 3, 8, 30, 6900.00, 0.00, '2019-04-21 09:01:14'),
(039, 1, 20, 30, 3300.00, 3531.00, '2019-04-27 02:51:15'),
(040, 1, 21, 20, 2800.00, 2996.00, '2019-04-27 02:52:10'),
(041, 1, 22, 50, 12000.00, 12840.00, '2019-04-27 03:02:55'),
(042, 1, 23, 30, 2550.00, 2728.50, '2019-04-27 03:03:48'),
(043, 1, 24, 30, 4800.00, 5136.00, '2019-04-27 03:08:56'),
(044, 1, 25, 40, 5600.00, 5992.00, '2019-04-27 09:15:53'),
(045, 1, 26, 40, 2400.00, 2568.00, '2019-04-28 07:33:38'),
(046, 1, 27, 60, 3720.00, 3980.40, '2019-04-28 07:33:59'),
(047, 1, 28, 50, 2250.00, 2407.50, '2019-04-28 07:34:41');

-- --------------------------------------------------------

--
-- Table structure for table `orders_detail`
--

CREATE TABLE `orders_detail` (
  `orders_detail_id` int(3) UNSIGNED ZEROFILL NOT NULL,
  `orders_id` int(3) NOT NULL,
  `products_id` int(3) NOT NULL,
  `quantity` int(10) NOT NULL,
  `sumprice` double(10,2) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `products_id` int(3) UNSIGNED ZEROFILL NOT NULL,
  `color_id` int(2) NOT NULL,
  `products_type_id` int(1) NOT NULL,
  `products_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `pic` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `price` double(10,2) NOT NULL,
  `cost` double(10,2) NOT NULL,
  `mfd` date NOT NULL,
  `exd` date NOT NULL,
  `stock` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`products_id`, `color_id`, `products_type_id`, `products_name`, `pic`, `price`, `cost`, `mfd`, `exd`, `stock`) VALUES
(020, 6, 1, 'กุ้งหิมะ', 'กุ้งหิมะ.jpg', 120.00, 110.00, '2019-04-27', '2019-05-11', 15),
(021, 8, 1, 'หมึกสไลด์', 'หมึกสไลด์.jpg', 150.00, 140.00, '2019-04-27', '2019-05-11', 9),
(022, 8, 1, 'กุ้งแก้ว', 'กุ้งแก้ว.jpg', 250.00, 240.00, '2019-04-27', '2019-05-11', 25),
(023, 3, 1, 'ยำสาหร่าย', 'ยำสาหร่ายม่วง 500g.jpg', 90.00, 85.00, '2019-04-27', '2019-05-11', 24),
(024, 6, 1, 'กุ้งผีเสื้อ', 'กุ้งผีเสื้อM.jpg', 170.00, 160.00, '2019-04-27', '2019-05-11', 20),
(025, 6, 1, 'แชลมอลสไลด์', 'แชลมอลสไลด์.jpg', 150.00, 140.00, '2019-04-27', '2019-05-11', 30),
(026, 6, 1, 'ปูอัดสูตร2', 'ปูอัดสูตร2 40.jpg', 65.00, 60.00, '2019-04-28', '2019-05-11', 40),
(027, 6, 1, 'ปูดอัดJapan', 'ปูอัด Japan 40.jpg', 70.00, 62.00, '2019-04-28', '2019-05-11', 55),
(028, 5, 1, 'ไข่หวาน', 'ไข่หวาน เหลือง.jpg', 55.00, 45.00, '2019-04-28', '2019-05-11', 45);

-- --------------------------------------------------------

--
-- Table structure for table `products_type`
--

CREATE TABLE `products_type` (
  `products_type_id` int(1) NOT NULL,
  `products_type_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `products_type`
--

INSERT INTO `products_type` (`products_type_id`, `products_type_name`) VALUES
(1, 'แช่แข็ง'),
(2, 'ไม่แช่แข็ง');

-- --------------------------------------------------------

--
-- Table structure for table `sell`
--

CREATE TABLE `sell` (
  `sell_id` int(3) UNSIGNED ZEROFILL NOT NULL,
  `customer_id` int(3) NOT NULL,
  `products_id` int(3) NOT NULL,
  `sell_quantity` int(4) NOT NULL,
  `sell_sumprice` double(10,2) NOT NULL,
  `sell_total` double(10,2) NOT NULL,
  `slip` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `delivery_status_id` int(1) NOT NULL DEFAULT '2',
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `pay` double(10,2) NOT NULL DEFAULT '0.00',
  `date_pay` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `sell`
--

INSERT INTO `sell` (`sell_id`, `customer_id`, `products_id`, `sell_quantity`, `sell_sumprice`, `sell_total`, `slip`, `delivery_status_id`, `date`, `pay`, `date_pay`) VALUES
(002, 1, 22, 10, 2500.00, 2675.00, '', 2, '2019-04-28 07:40:26', 1337.50, '2019-04-28 14:46:07'),
(003, 1, 24, 9, 1530.00, 1637.10, '', 2, '2019-04-28 07:40:31', 1637.10, '2019-04-28 14:46:10'),
(004, 1, 23, 5, 450.00, 481.50, '', 2, '2019-04-28 07:53:36', 481.50, '2019-04-28 14:55:43'),
(006, 2, 22, 5, 1250.00, 1337.50, '58444946_372854050000121_8562814106908753920_n.jpg', 1, '2019-04-28 07:58:23', 1337.50, '2019-04-28 15:07:54'),
(007, 2, 25, 9, 1350.00, 1444.50, '58444946_372854050000121_8562814106908753920_n.jpg', 1, '2019-04-28 08:10:07', 1444.50, '2019-04-28 15:10:16'),
(008, 2, 27, 5, 350.00, 374.50, '58444946_372854050000121_8562814106908753920_n.jpg', 1, '2019-04-28 08:35:46', 374.50, '2019-04-28 15:35:52'),
(009, 2, 28, 5, 275.00, 294.25, '58444946_372854050000121_8562814106908753920_n.jpg', 1, '2019-04-28 08:35:59', 294.25, '2019-04-28 15:36:05');

-- --------------------------------------------------------

--
-- Table structure for table `sell_detail`
--

CREATE TABLE `sell_detail` (
  `sell_detail_id` int(3) UNSIGNED ZEROFILL NOT NULL,
  `products_id` int(3) NOT NULL,
  `customer_id` int(3) NOT NULL,
  `quantity` int(10) NOT NULL,
  `price` double(10,2) NOT NULL,
  `sumprice` double(10,2) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `stock`
--

CREATE TABLE `stock` (
  `stock_id` int(3) UNSIGNED ZEROFILL NOT NULL,
  `store_id` int(3) NOT NULL,
  `products_id` int(3) UNSIGNED ZEROFILL NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `stock_quantity` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `stock`
--

INSERT INTO `stock` (`stock_id`, `store_id`, `products_id`, `date`, `stock_quantity`) VALUES
(019, 2, 002, '2019-04-07 07:28:34', 30),
(020, 1, 003, '2019-04-07 07:28:43', 20),
(021, 1, 004, '2019-04-07 07:28:50', 60),
(022, 1, 005, '2019-04-07 07:28:57', 100),
(032, 1, 001, '2019-04-10 07:24:38', 5),
(033, 1, 001, '2019-04-10 19:21:11', 10),
(034, 1, 001, '2019-04-20 08:01:04', 10);

-- --------------------------------------------------------

--
-- Table structure for table `stock_detail`
--

CREATE TABLE `stock_detail` (
  `stock_detail_id` int(3) UNSIGNED ZEROFILL NOT NULL,
  `products_id` int(3) NOT NULL,
  `stock_id` int(3) NOT NULL,
  `store_id` int(3) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `store`
--

CREATE TABLE `store` (
  `store_id` int(3) UNSIGNED ZEROFILL NOT NULL,
  `store_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `tel` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `telephone` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `tax` varchar(20) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `store`
--

INSERT INTO `store` (`store_id`, `store_name`, `address`, `tel`, `telephone`, `tax`) VALUES
(001, 'ร้านมะนาว วัตถุดิบซูชิ', 'หมู่บ้านพิมทอง 164 หมู่ที่ 4 ถนนสุขุมวิท ตำบลบางละมุง อำเภอบางละมุง ชลบุรี 20150', '0-2344-4560', '081-050-3488', '0745528000046'),
(002, 'ร้าน กุลกุล', 'หมู่บ้านนาวีเฮ้าส์6 14 หมู่ที่ 6 ตำบลสัตหีบ อำเภอสัตหีบ จังหวัดชลบุรี 20180', '0-2356-9089', '091-050-3477', '0745528000045'),
(003, 'ร้านใจใส การค้า', 'หมู่บ้านบางแสนวิลล์ เลขที่ 75/6 ถนนแสนสุข ตำบลแสนสุข อำเภอเมืองชลบุรี จังหวัดชลบุรี 20130 ', '0-2345-5667', '089-123-4567', '0912343001213');

-- --------------------------------------------------------

--
-- Table structure for table `title`
--

CREATE TABLE `title` (
  `title_id` int(2) NOT NULL,
  `title_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `title`
--

INSERT INTO `title` (`title_id`, `title_name`) VALUES
(1, 'นาย'),
(2, 'นางสาว'),
(3, 'นาง');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `users_id` int(3) UNSIGNED ZEROFILL NOT NULL,
  `title_id` int(2) NOT NULL,
  `codeusers` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `firstname` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `lastname` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `telephone` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `pic` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`users_id`, `title_id`, `codeusers`, `firstname`, `lastname`, `telephone`, `email`, `password`, `pic`, `status`) VALUES
(001, 2, 'ad01', 'sirinya', 'jaitrong', '096-115-0039', 'sirinya@gmail.com', '12345', 'Ct07_CD.jpg', 1),
(002, 2, 'ow01', 'สิรินทร์', 'ศรีโต', '094-942-6535', 'sirin@gmail.com', '12345', 'Ct08.CD.jpg', 2),
(003, 1, 'em01', 'ยรรยง', 'หมื่นอาษา', '098-757-5765', 'yanyong@gmail.com', '12345', 'owner.jpg', 3);

-- --------------------------------------------------------

--
-- Table structure for table `users_status`
--

CREATE TABLE `users_status` (
  `users_status_id` int(1) NOT NULL,
  `users_status_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users_status`
--

INSERT INTO `users_status` (`users_status_id`, `users_status_name`) VALUES
(1, 'ผู้ดูแลระบบ'),
(2, 'เจ้าของร้าน'),
(3, 'พนักงาน');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `color`
--
ALTER TABLE `color`
  ADD PRIMARY KEY (`color_id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`customer_id`);

--
-- Indexes for table `delivery`
--
ALTER TABLE `delivery`
  ADD PRIMARY KEY (`delivery_id`);

--
-- Indexes for table `delivery_status`
--
ALTER TABLE `delivery_status`
  ADD PRIMARY KEY (`delivery_status_id`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`login_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`orders_id`);

--
-- Indexes for table `orders_detail`
--
ALTER TABLE `orders_detail`
  ADD PRIMARY KEY (`orders_detail_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`products_id`);

--
-- Indexes for table `products_type`
--
ALTER TABLE `products_type`
  ADD PRIMARY KEY (`products_type_id`);

--
-- Indexes for table `sell`
--
ALTER TABLE `sell`
  ADD PRIMARY KEY (`sell_id`);

--
-- Indexes for table `sell_detail`
--
ALTER TABLE `sell_detail`
  ADD PRIMARY KEY (`sell_detail_id`);

--
-- Indexes for table `stock`
--
ALTER TABLE `stock`
  ADD PRIMARY KEY (`stock_id`);

--
-- Indexes for table `stock_detail`
--
ALTER TABLE `stock_detail`
  ADD PRIMARY KEY (`stock_detail_id`);

--
-- Indexes for table `store`
--
ALTER TABLE `store`
  ADD PRIMARY KEY (`store_id`);

--
-- Indexes for table `title`
--
ALTER TABLE `title`
  ADD PRIMARY KEY (`title_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`users_id`);

--
-- Indexes for table `users_status`
--
ALTER TABLE `users_status`
  ADD PRIMARY KEY (`users_status_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `color`
--
ALTER TABLE `color`
  MODIFY `color_id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `customer_id` int(3) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `delivery`
--
ALTER TABLE `delivery`
  MODIFY `delivery_id` int(3) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `delivery_status`
--
ALTER TABLE `delivery_status`
  MODIFY `delivery_status_id` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `login_id` int(3) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `orders_id` int(3) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `orders_detail`
--
ALTER TABLE `orders_detail`
  MODIFY `orders_detail_id` int(3) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `products_id` int(3) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `products_type`
--
ALTER TABLE `products_type`
  MODIFY `products_type_id` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `sell`
--
ALTER TABLE `sell`
  MODIFY `sell_id` int(3) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `sell_detail`
--
ALTER TABLE `sell_detail`
  MODIFY `sell_detail_id` int(3) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `stock`
--
ALTER TABLE `stock`
  MODIFY `stock_id` int(3) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `stock_detail`
--
ALTER TABLE `stock_detail`
  MODIFY `stock_detail_id` int(3) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `store`
--
ALTER TABLE `store`
  MODIFY `store_id` int(3) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `title`
--
ALTER TABLE `title`
  MODIFY `title_id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `users_id` int(3) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users_status`
--
ALTER TABLE `users_status`
  MODIFY `users_status_id` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
