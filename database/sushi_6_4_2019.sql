-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 06, 2019 at 03:01 PM
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
-- Table structure for table `amphur`
--

CREATE TABLE `amphur` (
  `amphur_id` int(3) NOT NULL,
  `amphur_code` varchar(4) COLLATE utf8_unicode_ci NOT NULL,
  `amphur_name` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `postcode` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
  `province_id` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
(6, 'ส้ม');

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
(001, 1, 'เงินสด', 'ลูกค้าเงินสด', '', '', ''),
(002, 1, 'ร้านธงชัย', 'ธงชัย ใจดี', 'หมู่บ้านพิมพาภรณ์ 292/94 หมู่ 10 ตำบลทุ่งสุขลา อำเภอศรีราชา จังหวัดชลบุรี 20230', '0-2333-3344', '089-765-4433'),
(003, 2, 'ร้านฟ้าใส', 'ฟ้าใส  มีสุข', 'หมู่บ้านทุ่งโปง 8/2 หมู่ 3 ถนนสุขุมวิท ตำบลบึง อำเภอศรีราชา จังหวัดชลบุรี 20210', '0-2454-6667', '090-456-7899');

-- --------------------------------------------------------

--
-- Table structure for table `delivery`
--

CREATE TABLE `delivery` (
  `delivery_id` int(10) NOT NULL,
  `delivery_status_id` int(1) NOT NULL,
  `customer_id` int(10) NOT NULL,
  `orders_id` int(10) NOT NULL,
  `province_id` int(2) NOT NULL
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
  `login_id` int(10) NOT NULL,
  `email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `orders_id` int(10) NOT NULL,
  `store_id` int(10) NOT NULL,
  `products_id` int(10) NOT NULL,
  `stock_quantity` int(4) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`orders_id`, `store_id`, `products_id`, `stock_quantity`, `date`) VALUES
(3, 1, 5, 2, '2019-04-06 06:52:54'),
(4, 1, 4, 1, '2019-04-06 06:54:11'),
(5, 1, 2, 10, '2019-04-06 06:54:18'),
(15, 2, 1, 1, '2019-04-06 10:46:26'),
(16, 2, 2, 1, '2019-04-06 10:46:33'),
(17, 2, 4, 1, '2019-04-06 10:46:36');

-- --------------------------------------------------------

--
-- Table structure for table `orders_detail`
--

CREATE TABLE `orders_detail` (
  `orders_detail_id` int(10) NOT NULL,
  `orders_id` int(10) NOT NULL,
  `products_id` int(10) NOT NULL,
  `quantity` int(4) NOT NULL,
  `sumprice` double(10,2) NOT NULL
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
(001, 1, 1, 'ยำสาาหร่าย', 'bub_s_girly_by_munionguy-d7fc4di.png', 66.00, 60.00, '2019-04-04', '2019-04-30', 76),
(002, 2, 1, 'ปูอัด', 'boo__by_munionguy-d5fhv5p.png', 70.00, 65.00, '2019-04-04', '2019-04-30', 64),
(004, 3, 1, 'ปูอัด', 'bonar_by_munionguy-d6x0fud.png', 70.00, 65.00, '2019-04-04', '2019-04-30', 68),
(005, 4, 1, 'rrrrrr', 'bub_s_girly_by_munionguy-d7fc4di.png', 100.00, 80.00, '2019-04-04', '2019-04-25', 89);

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
-- Table structure for table `province`
--

CREATE TABLE `province` (
  `province_id` int(5) NOT NULL,
  `province_code` varchar(2) COLLATE utf8_unicode_ci NOT NULL,
  `province_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sell`
--

CREATE TABLE `sell` (
  `sell_id` int(10) NOT NULL,
  `customer_id` int(10) NOT NULL,
  `products_id` int(10) NOT NULL,
  `sell_quantity` int(4) NOT NULL,
  `delivery_status_id` int(11) NOT NULL DEFAULT '2',
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `sell`
--

INSERT INTO `sell` (`sell_id`, `customer_id`, `products_id`, `sell_quantity`, `delivery_status_id`, `date`) VALUES
(3, 1, 5, 2, 1, '2019-04-06 11:54:15'),
(5, 2, 5, 1, 1, '2019-04-06 11:55:05'),
(7, 2, 2, 1, 2, '2019-04-06 12:08:38'),
(8, 2, 4, 1, 2, '2019-04-06 12:08:42'),
(10, 3, 4, 1, 2, '2019-04-06 12:19:15'),
(12, 3, 1, 1, 2, '2019-04-06 12:19:20'),
(13, 1, 1, 1, 2, '2019-04-06 12:58:58');

-- --------------------------------------------------------

--
-- Table structure for table `sell_detail`
--

CREATE TABLE `sell_detail` (
  `sell_detail_id` int(10) NOT NULL,
  `orders_id` int(10) NOT NULL,
  `products_id` int(10) NOT NULL,
  `customer_id` int(10) NOT NULL,
  `quantity` int(4) NOT NULL,
  `price` double(10,2) NOT NULL,
  `sumprice` double(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `stock`
--

CREATE TABLE `stock` (
  `stock_id` int(10) NOT NULL,
  `store_id` int(10) NOT NULL,
  `products_id` int(3) UNSIGNED ZEROFILL NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `stock_quantity` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `stock`
--

INSERT INTO `stock` (`stock_id`, `store_id`, `products_id`, `date`, `stock_quantity`) VALUES
(11, 1, 004, '2019-04-06 05:50:00', 9),
(13, 1, 004, '2019-04-06 06:48:06', 1),
(14, 1, 004, '2019-04-06 06:48:46', 1),
(15, 1, 002, '2019-04-06 06:48:56', 1),
(16, 1, 002, '2019-04-06 06:49:45', 1);

-- --------------------------------------------------------

--
-- Table structure for table `stock_detail`
--

CREATE TABLE `stock_detail` (
  `stock_detail_id` int(10) NOT NULL,
  `products_id` int(3) NOT NULL,
  `stock_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `store`
--

CREATE TABLE `store` (
  `store_id` int(10) NOT NULL,
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
(1, 'ร้านมะนาว วัตถุดิบซูชิ', 'หมู่บ้านพิมทอง 164 หมู่ที่ 4 ถนนสุขุมวิท ตำบลบางละมุง อำเภอบางละมุง ชลบุรี 20150', '0-2344-4560', '081-050-3488', '0745528000046'),
(2, 'ร้าน กุลกุล', 'หมู่บ้านนาวีเฮ้าส์6 14 หมู่ที่ 6 ตำบลสัตหีบ อำเภอสัตหีบ จังหวัดชลบุรี 20180', '0-2356-9089', '091-050-3477', '0745528000045');

-- --------------------------------------------------------

--
-- Table structure for table `tambon`
--

CREATE TABLE `tambon` (
  `tambon_id` int(5) NOT NULL,
  `tambon_name` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `tambon_code` varchar(6) COLLATE utf8_unicode_ci NOT NULL,
  `amphur_id` int(5) NOT NULL,
  `province_id` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
  `users_id` int(10) NOT NULL,
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
(1, 2, 'ad01', 'sirinya', 'jaitrong', '096-115-0039', 'sirinya@gmail.com', '12345', 'Ct07_CD.jpg', 1),
(6, 2, 'ow01', 'สิรินทร์', 'ศรีโต', '094-942-6535', 'sirin@gmail.com', '12345', 'Ct08.CD.jpg', 2),
(7, 1, 'em01', 'ยรรยง', 'หมื่นอาษา', '098-757-5765', 'yanyong@gmail.com', '12345', 'owner.jpg', 3);

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
-- Indexes for table `amphur`
--
ALTER TABLE `amphur`
  ADD PRIMARY KEY (`amphur_id`);

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
-- Indexes for table `province`
--
ALTER TABLE `province`
  ADD PRIMARY KEY (`province_id`);

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
-- Indexes for table `tambon`
--
ALTER TABLE `tambon`
  ADD PRIMARY KEY (`tambon_id`);

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
-- AUTO_INCREMENT for table `amphur`
--
ALTER TABLE `amphur`
  MODIFY `amphur_id` int(3) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `color`
--
ALTER TABLE `color`
  MODIFY `color_id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `customer_id` int(3) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `delivery`
--
ALTER TABLE `delivery`
  MODIFY `delivery_id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `delivery_status`
--
ALTER TABLE `delivery_status`
  MODIFY `delivery_status_id` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `login_id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `orders_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `orders_detail`
--
ALTER TABLE `orders_detail`
  MODIFY `orders_detail_id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `products_id` int(3) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `products_type`
--
ALTER TABLE `products_type`
  MODIFY `products_type_id` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `province`
--
ALTER TABLE `province`
  MODIFY `province_id` int(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sell`
--
ALTER TABLE `sell`
  MODIFY `sell_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `sell_detail`
--
ALTER TABLE `sell_detail`
  MODIFY `sell_detail_id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `stock`
--
ALTER TABLE `stock`
  MODIFY `stock_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `stock_detail`
--
ALTER TABLE `stock_detail`
  MODIFY `stock_detail_id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `store`
--
ALTER TABLE `store`
  MODIFY `store_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tambon`
--
ALTER TABLE `tambon`
  MODIFY `tambon_id` int(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `title`
--
ALTER TABLE `title`
  MODIFY `title_id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `users_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users_status`
--
ALTER TABLE `users_status`
  MODIFY `users_status_id` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
