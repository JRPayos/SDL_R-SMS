-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 31, 2024 at 04:18 PM
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
-- Database: `loginsystem`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(10) NOT NULL,
  `admin_fname` varchar(200) NOT NULL,
  `admin_lname` varchar(200) NOT NULL,
  `admin_email` varchar(200) NOT NULL,
  `admin_phonenum` bigint(11) NOT NULL,
  `admin_username` varchar(200) NOT NULL,
  `admin_password` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `admin_fname`, `admin_lname`, `admin_email`, `admin_phonenum`, `admin_username`, `admin_password`) VALUES
(8, 'Nikola', 'Jokić', 'Nikola_joker15@yahoo.com', 0, 'Joker15', '$2y$10$TzjYG/adGmxlKHl6SToY6.Hk7zENuw/k8DfroYnjvcHfR5a50FBce'),
(9, 'jin', 'eck', 'jovs@gmail.com', 0, 'JIn', '$2y$10$.zn2u7FVxlaEBnKxjng9We9wIEx4xu9LTsAmYl0vz1GRpePpJe9i2'),
(10, 'Thanasis', 'Atetoukambucks', 'thanasis123@gmail.com', 9159539824, 'thanasis_goat', '$2y$10$nc9cc.hlfl17Rm9Q7EjZZes37yUX1ipejZJfQdcsQSO0Ioxkz3AOK'),
(11, 'Lebron', 'James', 'lbj_goat@yahoo.com', 9279439410, 'lbj_goat', '$2y$10$hlNihKvwHRRFedLcF6MfRegHLETaEx0FhSz0qQRRp9jQERPZ.Npim'),
(12, 'Richard', 'Padilla', 'rpadilla@microsoft.com', 9698271418, 'richards', '$2y$10$c5AyVKrDnujZ1/spduFhouV2l3qtPqPGXOn0Q0CBK42JEGGYA7GVO');

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `brand_id` int(11) NOT NULL,
  `brand_name` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`brand_id`, `brand_name`) VALUES
(1, 'BLACK'),
(2, 'Flava'),
(3, 'RELX'),
(4, 'Instabar'),
(5, 'Elux'),
(6, 'Uzoq');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `cat_id` int(11) NOT NULL,
  `category_name` varchar(225) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`cat_id`, `category_name`) VALUES
(1, 'Vape'),
(2, 'E-liquid/Vape Juice');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `product_id` int(11) NOT NULL,
  `brand_id` int(11) NOT NULL,
  `product_name` varchar(225) NOT NULL,
  `product_stock` int(11) NOT NULL,
  `selling_price` int(11) NOT NULL,
  `supplier_price` int(11) NOT NULL,
  `supplier_name` varchar(255) NOT NULL,
  `product_added` datetime NOT NULL DEFAULT current_timestamp(),
  `product_modified` datetime NOT NULL DEFAULT current_timestamp(),
  `product_category_id` int(11) NOT NULL,
  `product_type_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`product_id`, `brand_id`, `product_name`, `product_stock`, `selling_price`, `supplier_price`, `supplier_name`, `product_added`, `product_modified`, `product_category_id`, `product_type_id`) VALUES
(11, 1, 'Elite V2 12000 prefilled pod', 19, 350, 250, 'Luca Donkey', '2024-05-06 09:55:52', '2024-05-22 14:55:52', 1, 3),
(12, 1, 'Elite V2 device', 10, 400, 350, 'Luca Donkey', '2024-05-06 09:16:03', '2024-05-30 03:15:59', 1, 2),
(14, 1, 'Elite 8000', 13, 300, 250, 'Luca Donkey', '2024-05-06 03:17:05', '2024-05-30 03:18:25', 1, 3),
(15, 2, 'Maze Pro 10000', 10, 500, 400, 'Air Supplier', '2024-05-15 10:20:40', '2024-05-30 03:22:14', 1, 1),
(16, 1, 'Infinity 2', 14, 700, 800, 'SDL', '2024-05-30 14:45:36', '2024-05-30 14:45:36', 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `sale`
--

CREATE TABLE `sale` (
  `sales_id` int(11) NOT NULL,
  `customer_name` varchar(225) NOT NULL,
  `product_item_id` int(11) NOT NULL,
  `item_quantity` int(11) NOT NULL,
  `total_price` int(11) NOT NULL,
  `date_purchased` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sale`
--

INSERT INTO `sale` (`sales_id`, `customer_name`, `product_item_id`, `item_quantity`, `total_price`, `date_purchased`) VALUES
(6, 'Jane Done', 11, 1, 350, '2024-05-30 00:45:39'),
(7, 'Jeniffer Lawrence', 11, 2, 700, '2024-05-30 00:45:39'),
(8, 'Keann Karlsen', 15, 1, 500, '2024-05-31 01:07:24'),
(9, 'John Cena', 11, 1, 350, '2024-05-31 01:08:16'),
(10, 'John Cena', 12, 1, 400, '2024-05-31 01:09:26'),
(11, 'Jeniffer Hughs', 15, 2, 1000, '2024-05-29 10:46:35'),
(12, 'Mang Bebot', 16, 1, 700, '2024-05-29 15:46:35'),
(13, 'Kanye North', 11, 1, 350, '2024-05-29 14:14:21'),
(14, 'Jonathan Adamson', 16, 2, 1400, '2024-05-31 14:31:33'),
(15, 'Jonathan Adamson', 11, 1, 350, '2024-05-31 15:05:03'),
(16, 'Juan Polo', 11, 1, 350, '2024-05-31 16:10:24'),
(17, 'testing', 11, 10, 10000, '2024-05-31 17:20:46'),
(18, 'testing', 11, 10, 10000, '2024-05-31 17:23:10'),
(19, 'tetet', 11, 10, 100000, '2024-05-31 17:24:00');

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `supplier_id` int(11) NOT NULL,
  `supplier_name` varchar(225) NOT NULL,
  `supplier_address` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`supplier_id`, `supplier_name`, `supplier_address`) VALUES
(1, 'Luka Donkey', '356 Quezon Blvd, Quiapo, Manila, 1001 Metro Manila'),
(2, 'SDL Enterprise', '103-B, MacArthur Highway, Marulas, Valenzuela, 1441 Metro Manila'),
(3, 'Joana Doe', '22 Mt.Samat, Caloocan, Metro Manila'),
(5, 'VST&Co.', 'Tower 1 Avida Turf Corner Lane S, 9th Ave, Taguig, Metro Manila');

-- --------------------------------------------------------

--
-- Table structure for table `supplier_delivery`
--

CREATE TABLE `supplier_delivery` (
  `supplier_delivery_id` int(11) NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `delivery_quantity` int(11) NOT NULL,
  `delivery_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `supplier_delivery`
--

INSERT INTO `supplier_delivery` (`supplier_delivery_id`, `supplier_id`, `product_id`, `delivery_quantity`, `delivery_date`) VALUES
(1, 2, 11, 12, '2024-05-31 13:55:29'),
(2, 5, 14, 10, '2024-05-31 13:56:04'),
(3, 1, 12, 10, '2024-05-31 16:05:53'),
(10, 3, 15, 10, '2024-05-31 17:01:42'),
(11, 3, 15, 10, '2024-05-31 17:04:36'),
(12, 1, 11, 7, '2024-05-31 17:05:16'),
(13, 1, 11, 3, '2024-05-31 17:08:20'),
(14, 1, 12, 10, '2024-05-31 17:09:31'),
(15, 1, 11, 2, '2024-05-31 17:11:37'),
(16, 1, 11, 1, '2024-05-31 17:13:50'),
(17, 1, 11, 2, '2024-05-31 17:15:00'),
(18, 1, 11, 1, '2024-05-31 17:16:31'),
(19, 1, 11, 10, '2024-05-31 17:18:00'),
(20, 3, 11, 5, '2024-05-31 17:23:35');

-- --------------------------------------------------------

--
-- Table structure for table `type`
--

CREATE TABLE `type` (
  `type_id` int(11) NOT NULL,
  `type_name` varchar(225) NOT NULL,
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `type`
--

INSERT INTO `type` (`type_id`, `type_name`, `category_id`) VALUES
(1, 'disposable pod', 1),
(2, 'pod kit device/battery', 1),
(3, 'pod kit e-liquid', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`brand_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `brand_id` (`brand_id`),
  ADD KEY `product_category_id` (`product_category_id`),
  ADD KEY `product_type_id` (`product_type_id`);

--
-- Indexes for table `sale`
--
ALTER TABLE `sale`
  ADD PRIMARY KEY (`sales_id`),
  ADD KEY `sale_ibfk_1` (`product_item_id`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`supplier_id`);

--
-- Indexes for table `supplier_delivery`
--
ALTER TABLE `supplier_delivery`
  ADD PRIMARY KEY (`supplier_delivery_id`),
  ADD KEY `supplier_delivery_ibfk_1` (`supplier_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `type`
--
ALTER TABLE `type`
  ADD PRIMARY KEY (`type_id`),
  ADD KEY `category_id` (`category_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `brand_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `sale`
--
ALTER TABLE `sale`
  MODIFY `sales_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `supplier_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `supplier_delivery`
--
ALTER TABLE `supplier_delivery`
  MODIFY `supplier_delivery_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`brand_id`) REFERENCES `brands` (`brand_id`),
  ADD CONSTRAINT `product_ibfk_2` FOREIGN KEY (`product_category_id`) REFERENCES `category` (`cat_id`),
  ADD CONSTRAINT `product_ibfk_3` FOREIGN KEY (`product_type_id`) REFERENCES `type` (`type_id`);

--
-- Constraints for table `sale`
--
ALTER TABLE `sale`
  ADD CONSTRAINT `sale_ibfk_1` FOREIGN KEY (`product_item_id`) REFERENCES `product` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `supplier_delivery`
--
ALTER TABLE `supplier_delivery`
  ADD CONSTRAINT `supplier_delivery_ibfk_1` FOREIGN KEY (`supplier_id`) REFERENCES `supplier` (`supplier_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `supplier_delivery_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `type`
--
ALTER TABLE `type`
  ADD CONSTRAINT `type_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `category` (`cat_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
