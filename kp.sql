-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 02, 2021 at 05:46 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.4.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kp`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `categoryName` varchar(255) NOT NULL,
  `categoryDescription` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `categoryName`, `categoryDescription`) VALUES
(1, 'Drink - Coffe', 'Minuman yang mengandung coffein'),
(2, 'Drink - Non Coffe', 'Minuman Tanpa coffein'),
(3, 'Makanan', 'Membuat perutmu kenyangggggggggg');

-- --------------------------------------------------------

--
-- Table structure for table `orderhistory`
--

CREATE TABLE `orderhistory` (
  `id` int(11) NOT NULL,
  `orderId` int(11) NOT NULL,
  `status` varchar(255) DEFAULT NULL,
  `keterangan` varchar(255) DEFAULT NULL,
  `postingDate` date NOT NULL DEFAULT current_timestamp(),
  `totalBelanja` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orderhistory`
--

INSERT INTO `orderhistory` (`id`, `orderId`, `status`, `keterangan`, `postingDate`, `totalBelanja`) VALUES
(59, 52, 'Selesai', 'Orderan Telah Selesai', '2021-06-18', 19000),
(60, 53, 'Selesai', 'Orderan Telah Selesai', '2021-06-24', 25000),
(61, 54, 'Selesai', 'Orderan Telah Selesai', '2021-06-24', 12000),
(62, 55, 'Selesai', 'Orderan Telah Selesai', '2021-06-24', 19000),
(63, 57, 'Selesai', 'Orderan Telah Selesai', '2021-06-24', 12000),
(64, 56, 'Selesai', 'Orderan Telah Selesai', '2021-06-24', 19000),
(65, 56, 'Selesai', 'Orderan Telah Selesai', '2021-06-24', 19000),
(66, 63, 'Selesai', 'Orderan Telah Selesai', '2021-06-24', 25000),
(67, 58, 'Selesai', 'Orderan Telah Selesai', '2021-06-24', 19000),
(68, 59, 'Selesai', 'Orderan Telah Selesai', '2021-06-24', 20000),
(69, 60, 'Selesai', 'Orderan Telah Selesai', '2021-06-20', 20000),
(70, 61, 'Selesai', 'Orderan Telah Selesai', '2021-06-21', 25000),
(71, 62, 'Selesai', 'Orderan Telah Selesai', '2021-06-20', 20000),
(72, 64, 'Selesai', 'Orderan Telah Selesai', '2021-06-24', 57000),
(73, 65, 'Selesai', 'Orderan Telah Selesai', '2021-06-24', 75000),
(74, 66, 'Selesai', 'Orderan Telah Selesai', '2021-06-24', 20000),
(75, 67, 'Selesai', 'Orderan Telah Selesai', '2021-06-24', 20000),
(76, 68, 'Selesai', 'Orderan Telah Selesai', '2021-06-24', 19000),
(77, 72, 'Selesai', 'Orderan Telah Selesai', '2021-06-26', 19000),
(78, 69, 'Selesai', 'Orderan Telah Selesai', '2021-06-26', 50000),
(79, 70, 'Selesai', 'Orderan Telah Selesai', '2021-06-26', 18000),
(80, 71, 'Selesai', 'Orderan Telah Selesai', '2021-06-26', 20000),
(81, 73, 'Selesai', 'Orderan Telah Selesai', '2021-06-26', 25000),
(82, 74, 'Selesai', 'Orderan Telah Selesai', '2021-06-26', 25000),
(83, 75, 'Selesai', 'Orderan Telah Selesai', '2021-06-26', 20000),
(84, 76, 'Selesai', 'Orderan Telah Selesai', '2021-06-28', 50000),
(85, 77, 'Selesai', 'Orderan Telah Selesai', '2021-06-28', 18000),
(86, 78, 'Selesai', 'Orderan Telah Selesai', '2021-06-28', 20000),
(87, 79, 'Selesai', 'Orderan Telah Selesai', '2021-06-29', 25000),
(88, 81, 'Selesai', 'Orderan Telah Selesai', '2021-06-29', 19000),
(89, 82, 'Selesai', 'Orderan Telah Selesai', '2021-06-30', 25000),
(90, 80, 'Selesai', 'Orderan Telah Selesai', '2021-06-30', 18000),
(91, 83, 'Selesai', 'Orderan Telah Selesai', '2021-07-02', 0),
(92, 84, 'Selesai', 'Orderan Telah Selesai', '2021-07-02', 0),
(93, 85, 'Selesai', 'Orderan Telah Selesai', '2021-07-02', 0),
(94, 86, 'Selesai', 'Orderan Telah Selesai', '2021-07-02', 0),
(95, 87, 'Selesai', 'Orderan Telah Selesai', '2021-07-02', 0),
(96, 88, 'Selesai', 'Orderan Telah Selesai', '2021-07-02', 25000),
(97, 89, 'Selesai', 'Orderan Telah Selesai', '2021-07-02', 18000),
(98, 90, 'Selesai', 'Orderan Telah Selesai', '2021-07-02', 57000),
(99, 91, 'Selesai', 'Orderan Telah Selesai', '2021-07-02', 25000),
(100, 92, 'Selesai', 'Orderan Telah Selesai', '2021-07-02', 19000),
(101, 93, 'Selesai', 'Orderan Telah Selesai', '2021-07-02', 76000);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `userId` int(11) DEFAULT NULL,
  `customer` varchar(200) NOT NULL,
  `productId` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `orderDate` date NOT NULL DEFAULT current_timestamp(),
  `paymentMethod` varchar(50) DEFAULT NULL,
  `orderStatus` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `userId`, `customer`, `productId`, `quantity`, `orderDate`, `paymentMethod`, `orderStatus`) VALUES
(52, 1, 'Samsul', 3, 1, '2021-05-24', 'tunai', 'Selesai'),
(53, 1, 'Samsul', 4, 1, '2021-06-24', 'tunai', 'Selesai'),
(54, 1, 'Samsul', 8, 1, '2021-06-24', 'tunai', 'Selesai'),
(55, 6, '', 3, 1, '2021-06-24', 'tunai', 'Selesai'),
(56, 6, 'angga', 3, 1, '2021-06-24', 'tunai', 'Selesai'),
(57, 6, 'angga', 8, 1, '2021-06-24', 'tunai', 'Selesai'),
(58, 1, 'angga', 3, 1, '2021-06-24', 'tunai', 'Selesai'),
(59, 1, 'angga', 1, 1, '2021-06-24', 'tunai', 'Selesai'),
(60, 1, 'angga', 1, 1, '2021-06-20', 'tunai', 'Selesai'),
(61, 1, 'angga', 4, 1, '2021-06-21', 'tunai', 'Selesai'),
(62, 1, 'angga', 1, 1, '2021-06-20', 'tunai', 'Selesai'),
(63, 1, 'angga', 4, 1, '2021-06-24', 'tunai', 'Selesai'),
(64, 1, 'Samsul', 3, 3, '2021-06-24', 'tunai', 'Selesai'),
(65, 1, 'Samsul', 4, 3, '2021-06-24', 'tunai', 'Selesai'),
(66, 1, 'angga', 1, 1, '2021-06-24', 'tunai', 'Selesai'),
(67, 1, 'Samsul', 1, 1, '2021-06-24', 'tunai', 'Selesai'),
(68, 1, 'angga', 3, 1, '2021-06-24', 'tunai', 'Selesai'),
(69, 1, 'Angga', 4, 2, '2021-06-26', 'tunai', 'Selesai'),
(70, 1, 'Angga', 5, 1, '2021-06-26', 'tunai', 'Selesai'),
(71, 1, 'angga', 1, 1, '2021-06-26', 'tunai', 'Selesai'),
(72, 1, 'Angga Syamsul', 3, 1, '2021-06-26', 'tunai', 'Selesai'),
(73, 1, 'Angga', 4, 1, '2021-06-26', 'tunai', 'Selesai'),
(74, 1, 'Angga', 4, 1, '2021-06-26', 'tunai', 'Selesai'),
(75, 1, 'Angga Syamsul', 1, 1, '2021-06-26', 'tunai', 'Selesai'),
(76, 1, 'Angga Syamsul', 4, 2, '2021-06-28', 'tunai', 'Selesai'),
(77, 1, 'Angga Syamsul', 5, 1, '2021-06-28', 'tunai', 'Selesai'),
(78, 1, 'Samsul', 1, 1, '2021-06-28', 'tunai', 'Selesai'),
(79, 1, 'Angga', 4, 1, '2021-06-29', 'tunai', 'Selesai'),
(80, 1, 'Angga', 5, 1, '2021-06-29', 'tunai', 'Selesai'),
(81, 1, 'angga', 3, 1, '2021-06-29', 'tunai', 'Selesai'),
(82, 1, 'angga', 4, 1, '2021-06-29', 'tunai', 'Selesai'),
(83, 1, 'Samsul', 3, 1, '2021-07-01', 'tunai', 'Selesai'),
(84, 1, 'Samsul', 4, 1, '2021-07-01', 'tunai', 'Selesai'),
(85, 1, 'Samsul', 5, 1, '2021-07-01', 'tunai', 'Selesai'),
(86, 1, 'Samsul', 4, 1, '2021-07-01', 'tunai', 'Selesai'),
(87, 1, 'Samsul', 5, 1, '2021-07-01', 'tunai', 'Selesai'),
(88, 1, 'angga', 4, 1, '2021-07-02', 'tunai', 'Selesai'),
(89, 1, 'angga', 5, 1, '2021-07-02', 'tunai', 'Selesai'),
(90, 1, 'Pupuh', 3, 3, '2021-07-02', 'tunai', 'Selesai'),
(91, 1, 'Pupuh', 4, 1, '2021-07-02', 'tunai', 'Selesai'),
(92, 1, 'ropeah', 7, 1, '2021-07-02', 'tunai', 'Selesai'),
(93, 1, 'ropeah', 10, 4, '2021-07-02', 'tunai', 'Selesai');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `category` int(11) NOT NULL,
  `productName` varchar(255) NOT NULL,
  `productPrice` int(11) NOT NULL,
  `productDescription` longtext NOT NULL,
  `qty` int(11) NOT NULL,
  `productImage` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `category`, `productName`, `productPrice`, `productDescription`, `qty`, `productImage`) VALUES
(1, 2, 'Chocolate', 20000, 'Chocolate', 12, '1-10.jpg'),
(3, 2, 'Squash Grape', 19000, 'Squash Grape', 12, '1-07.jpg'),
(4, 3, 'Lemon Dante', 25000, 'Lemon Dante', 10, '1-02.jpg'),
(5, 2, 'Squash Chocolate', 18000, 'Squash Chocolate', 12, '1-06.jpg'),
(6, 2, 'Lemon Squash', 19000, 'Lemon Squash', 12, '1-04.jpg'),
(7, 2, 'Squash Strawberry', 19000, 'Squash Strawberry', 12, '1-05.jpg'),
(8, 2, 'Starberry Deluxe', 12000, 'Starberry Deluxe', 12, '1-01.jpg'),
(9, 2, 'Squash Matcha', 25000, 'Squash Matcha', 23, '1-09.jpg'),
(10, 2, 'Squash berry', 19000, 'Squash berry', 12, '1-08.jpg'),
(11, 2, 'Starberry Creamy', 25000, 'Starberry Creamy', 12, '1-03.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `supervisor`
--

CREATE TABLE `supervisor` (
  `id` int(20) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `supervisor`
--

INSERT INTO `supervisor` (`id`, `username`, `password`) VALUES
(1, 'supervisor', '202cb962ac59075b964b07152d234b70');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_user`, `username`, `password`) VALUES
(1, 'kasir1', '202cb962ac59075b964b07152d234b70'),
(6, 'kasir2', '202cb962ac59075b964b07152d234b70'),
(8, 'kasir3', '202cb962ac59075b964b07152d234b70');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orderhistory`
--
ALTER TABLE `orderhistory`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orderId` (`orderId`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userId` (`userId`),
  ADD KEY `productId` (`productId`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category` (`category`);

--
-- Indexes for table `supervisor`
--
ALTER TABLE `supervisor`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `orderhistory`
--
ALTER TABLE `orderhistory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=102;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=94;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `supervisor`
--
ALTER TABLE `supervisor`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orderhistory`
--
ALTER TABLE `orderhistory`
  ADD CONSTRAINT `orderhistory_ibfk_1` FOREIGN KEY (`orderId`) REFERENCES `orders` (`id`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`productId`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`userId`) REFERENCES `users` (`id_user`);

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`category`) REFERENCES `category` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
