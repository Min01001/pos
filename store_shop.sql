-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 20, 2024 at 06:03 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `store_shop`
--

-- --------------------------------------------------------

--
-- Table structure for table `documents`
--

CREATE TABLE `documents` (
  `voncher` text NOT NULL,
  `item` text NOT NULL,
  `item_count` text NOT NULL,
  `price` int(11) NOT NULL,
  `note` text NOT NULL,
  `total_price` int(11) NOT NULL,
  `date` date NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `documents`
--

INSERT INTO `documents` (`voncher`, `item`, `item_count`, `price`, `note`, `total_price`, `date`, `id`) VALUES
('10001', 'ဆား', '2', 500, 'food', 1000, '2024-06-04', 1),
('1523', 'ဆန်', '10ပြည်', 2000, 'food', 20000, '2024-06-04', 2);

-- --------------------------------------------------------

--
-- Table structure for table `employy`
--

CREATE TABLE `employy` (
  `nrc` text NOT NULL,
  `name` text NOT NULL,
  `father` text NOT NULL,
  `address` text NOT NULL,
  `birthday` date NOT NULL,
  `position` text NOT NULL,
  `startdate` date NOT NULL,
  `salary` int(11) NOT NULL,
  `gender` text NOT NULL,
  `phone` text NOT NULL,
  `email` text NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employy`
--

INSERT INTO `employy` (`nrc`, `name`, `father`, `address`, `birthday`, `position`, `startdate`, `salary`, `gender`, `phone`, `email`, `id`) VALUES
('13/PaTaYa(N)001142', 'MG MG', 'U Myint', 'Yangon', '2003-10-14', 'inclusive', '2024-06-05', 250000, 'male', '09111222333', 'mgmg@gmail.com', 1);

-- --------------------------------------------------------

--
-- Table structure for table `incomes`
--

CREATE TABLE `incomes` (
  `note` text NOT NULL,
  `income` int(11) NOT NULL,
  `date` date NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `incomes`
--

INSERT INTO `incomes` (`note`, `income`, `date`, `id`) VALUES
('food', 100000, '2024-06-15', 4),
('food', 100000, '2024-06-15', 5),
('document', 50000, '2024-06-29', 6);

-- --------------------------------------------------------

--
-- Table structure for table `outcomes`
--

CREATE TABLE `outcomes` (
  `note` text NOT NULL,
  `outcome` int(11) NOT NULL,
  `date` date NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `outcomes`
--

INSERT INTO `outcomes` (`note`, `outcome`, `date`, `id`) VALUES
('food', 100000, '2024-06-15', 1),
('ice', 5000, '2024-06-29', 3);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `barcode` text NOT NULL,
  `product` text NOT NULL,
  `item` text NOT NULL,
  `price` int(11) NOT NULL,
  `total_price` int(11) NOT NULL,
  `profic` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `date` date NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`barcode`, `product`, `item`, `price`, `total_price`, `profic`, `quantity`, `total`, `date`, `id`) VALUES
('107', 'cokey', 'မုန့်', 1000, 1500, 500, 2, 3000, '2024-06-02', 24),
('1001', 'Item', 'မုန့်', 3000, 4000, 2000, 2, 8000, '2024-06-04', 26),
('1022', 'yanyan', 'အလှကုန်ပစ္စည်း', 1000, 1200, 1000, 10, 12000, '2024-06-06', 27),
('124', 'code', 'အလှကုန်ပစ္စည်း', 1000, 1500, 5000, 10, 15000, '2024-06-10', 28),
('1420', 'mick', 'မုန့်', 2000, 2500, 2500, 5, 12500, '2024-06-12', 31),
('1111', 'color', 'မုန့်', 2000, 2500, 2000, 4, 10000, '2024-06-16', 32),
('11110', 'https', 'မုန့်', 4000, 4500, 5000, 10, 45000, '2024-07-17', 33),
('5988539', 'chagger', 'မုန့်', 5000, 6000, 1000, 1, 6000, '2024-07-17', 35),
('5988539A0619', 'chagger', 'မုန့်', 5000, 6000, 1000, 1, 6000, '2024-07-17', 36),
('5996369A1977', 'chagger', 'မုန့်', 5000, 6000, 10000, 10, 60000, '2024-07-17', 37);

-- --------------------------------------------------------

--
-- Table structure for table `products_copy`
--

CREATE TABLE `products_copy` (
  `barcode` text NOT NULL,
  `product` text NOT NULL,
  `item` text NOT NULL,
  `price` int(11) NOT NULL,
  `total_price` int(11) NOT NULL,
  `profic` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `date` date NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products_copy`
--

INSERT INTO `products_copy` (`barcode`, `product`, `item`, `price`, `total_price`, `profic`, `quantity`, `total`, `date`, `id`) VALUES
('107', 'cokey', 'မုန့်', 1000, 1500, 500, 2, 3000, '2024-06-02', 24),
('1001', 'Item', 'မုန့်', 3000, 4000, 2000, 2, 8000, '2024-06-04', 26),
('102', 'yanyan', 'အလှကုန်ပစ္စည်း', 1000, 1200, 1000, 10, 12000, '2024-06-06', 27),
('124', 'code', 'အလှကုန်ပစ္စည်း', 1000, 1500, 5000, 10, 15000, '2024-06-10', 28),
('1420', 'mick', 'မုန့်', 2000, 2500, 2500, 5, 12500, '2024-06-12', 31),
('1111', 'color', 'မုန့်', 4000, 4500, 2000, 4, 18000, '2024-06-16', 32),
('1111', 'color', 'မုန့်', 4000, 4500, 500, 1, 4500, '2024-06-16', 33),
('102', 'yanyan', 'မုန့်', 1000, 1200, 1000, 5, 6000, '2024-06-16', 34),
('1420', 'mick', 'မုန့်', 2000, 2500, 2000, 4, 10000, '2024-06-16', 35);

-- --------------------------------------------------------

--
-- Table structure for table `sell`
--

CREATE TABLE `sell` (
  `barcode` text NOT NULL,
  `product` text NOT NULL,
  `item_count` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `total_price` int(11) NOT NULL,
  `date` date NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sell`
--

INSERT INTO `sell` (`barcode`, `product`, `item_count`, `price`, `total_price`, `date`, `id`) VALUES
('21', 'good', 1, 1000, 1000, '2024-06-04', 1),
('107', 'cokey', 1, 1000, 1000, '2024-06-06', 2),
('107', 'cokey', 1, 1000, 1000, '2024-06-06', 3),
('1001', 'Item', 1, 3000, 3000, '2024-06-06', 4),
('107', 'cokey', 1, 1000, 1000, '2024-06-06', 5),
('107', 'cokey', 1, 1000, 1000, '2024-06-06', 6),
('107', 'cokey', 2, 1000, 2000, '2024-06-06', 7),
('1001', 'Item', 1, 3000, 3000, '2024-06-06', 15),
('107', 'cokey', 1, 1000, 1000, '2024-06-06', 16),
('1001', 'Item', 2, 3000, 6000, '2024-06-06', 17),
('107', 'cokey', 1, 1000, 1000, '2024-06-06', 18),
('102', 'yanyan', 1, 1000, 1000, '2024-06-06', 19),
('107', 'cokey', 1, 1000, 1000, '2024-06-07', 20),
('102', 'yanyan', 3, 1000, 3000, '2024-06-10', 21),
('102', 'yanyan', 3, 1000, 3000, '2024-06-12', 22),
('1001', 'Item', 1, 3000, 3000, '2024-06-12', 23),
('124', 'code', 2, 1000, 2000, '2024-06-15', 24),
('124', 'code', 1, 1000, 1000, '2024-06-15', 25),
('102', 'yanyan', 2, 1000, 2000, '2024-06-15', 26),
('1111', 'color', 1, 4000, 4000, '2024-06-16', 27),
('1111', 'color', 1, 2000, 2000, '2024-06-16', 28),
('1111', 'color', 1, 2000, 2000, '2024-06-30', 29),
('124', 'code', 1, 1000, 1000, '2024-06-30', 30),
('1111', 'color', 1, 2000, 2000, '2024-06-30', 31),
('124', 'code', 2, 1000, 2000, '2024-06-30', 32),
('5988539', 'changer', 1, 5000, 5000, '2024-07-17', 33),
('5988539A0619', 'chagger', 1, 5000, 5000, '2024-07-17', 34),
('5996369A1977', 'chagger', 2, 5000, 10000, '2024-07-17', 35);

-- --------------------------------------------------------

--
-- Table structure for table `sell_record`
--

CREATE TABLE `sell_record` (
  `barcode` text NOT NULL,
  `product` text NOT NULL,
  `item_count` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `total_price` int(11) NOT NULL,
  `date` date NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_login`
--

CREATE TABLE `user_login` (
  `username` text NOT NULL,
  `password` int(11) NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_login`
--

INSERT INTO `user_login` (`username`, `password`, `id`) VALUES
('admin', 1234, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `documents`
--
ALTER TABLE `documents`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employy`
--
ALTER TABLE `employy`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `incomes`
--
ALTER TABLE `incomes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `outcomes`
--
ALTER TABLE `outcomes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products_copy`
--
ALTER TABLE `products_copy`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sell`
--
ALTER TABLE `sell`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sell_record`
--
ALTER TABLE `sell_record`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_login`
--
ALTER TABLE `user_login`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `documents`
--
ALTER TABLE `documents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `employy`
--
ALTER TABLE `employy`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `incomes`
--
ALTER TABLE `incomes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `outcomes`
--
ALTER TABLE `outcomes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `products_copy`
--
ALTER TABLE `products_copy`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `sell`
--
ALTER TABLE `sell`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `sell_record`
--
ALTER TABLE `sell_record`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `user_login`
--
ALTER TABLE `user_login`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
