-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 09, 2025 at 10:55 PM
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
-- Database: `inventar_pc`
--

-- --------------------------------------------------------

--
-- Table structure for table `audit_log`
--

CREATE TABLE `audit_log` (
  `id` int(11) NOT NULL,
  `user` varchar(100) DEFAULT NULL,
  `action` varchar(50) DEFAULT NULL,
  `entity` varchar(50) DEFAULT NULL,
  `entity_id` int(11) DEFAULT NULL,
  `details` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `sku` varchar(100) DEFAULT NULL,
  `name` varchar(200) DEFAULT NULL,
  `serial_number` varchar(150) DEFAULT NULL,
  `supplier_id` int(11) DEFAULT NULL,
  `category` varchar(100) DEFAULT NULL,
  `brand` varchar(100) DEFAULT NULL,
  `cpu` varchar(120) DEFAULT NULL,
  `ram` varchar(50) DEFAULT NULL,
  `storage` varchar(120) DEFAULT NULL,
  `gpu` varchar(120) DEFAULT NULL,
  `purchase_price` decimal(10,2) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `warranty` varchar(50) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` enum('OK','Defekt','Ne servis') DEFAULT 'OK'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `sku`, `name`, `serial_number`, `supplier_id`, `category`, `brand`, `cpu`, `ram`, `storage`, `gpu`, `purchase_price`, `price`, `quantity`, `warranty`, `image`, `created_at`, `status`) VALUES
(3, 'PC-1002', 'Dell OptiPlex 7080', 'SN-DLL-7080-002', 1, 'Desktop', 'Dell', 'Intel i5-10500', '16GB', '512GB SSD', 'Intel UHD 630', 620.00, 820.00, 7, '24 months', 'dell7080.jpg', '2025-12-04 21:55:09', 'OK'),
(4, 'PC-1003', 'Lenovo ThinkCentre M720s', 'SN-LNV-M720-003', 1, 'Desktop', 'Lenovo', 'Intel i7-9700', '16GB', '1TB HDD', 'Intel UHD 630', 590.00, 760.00, 4, '24 months', 'lenovo720s.jpg', '2025-12-04 21:55:09', 'OK'),
(5, 'PC-1004', 'HP EliteDesk 800 G6', 'SN-HP-ED800-004', 2, 'Desktop', 'HP', 'Intel i5-10500', '8GB', '256GB SSD', 'Intel UHD', 540.00, 720.00, 6, '12 months', 'hped800.jpg', '2025-12-04 21:55:09', 'OK'),
(6, 'LAP-2002', 'Dell Latitude 5520', 'SN-DLL-LAT5520-002', 1, 'Laptop', 'Dell', 'Intel i7-1165G7', '16GB', '512GB SSD', 'Intel Iris Xe', 820.00, 1050.00, 10, '24 months', 'dell5520.jpg', '2025-12-04 21:55:09', 'OK'),
(7, 'LAP-2003', 'HP EliteBook 840 G7', 'SN-HP-EB840-003', 2, 'Laptop', 'HP', 'Intel i5-10210U', '8GB', '256GB SSD', 'Intel UHD', 730.00, 920.00, 5, '24 months', 'hp840g7.jpg', '2025-12-04 21:55:09', 'OK'),
(8, 'LAP-2004', 'Lenovo ThinkPad T14 Gen2', 'SN-LNV-T14G2-004', 2, 'Laptop', 'Lenovo', 'AMD Ryzen 5 Pro', '16GB', '512GB SSD', 'Radeon Vega', 780.00, 980.00, 9, '36 months', 'lenovo14g2.jpg', '2025-12-04 21:55:09', 'OK'),
(9, 'LAP-2005', 'Acer Nitro 5', 'SN-ACR-NTR5-005', 1, 'Laptop', 'Acer', 'Intel i7-11800H', '16GB', '512GB SSD', 'Nvidia RTX 3060', 1080.00, 1350.00, 3, '24 months', 'nitro5.jpg', '2025-12-04 21:55:09', 'OK'),
(10, 'AIO-3001', 'Lenovo IdeaCentre AIO 5', 'SN-LNV-AIO5-001', 1, 'All-in-One', 'Lenovo', 'Intel i5-10400T', '8GB', '512GB SSD', 'Intel UHD', 520.00, 690.00, 4, '12 months', 'aio5.jpg', '2025-12-04 21:55:09', 'OK'),
(11, 'WS-4001', 'Dell Precision 3650 Workstation', 'SN-DLL-PR3650-001', 1, 'Workstation', 'Dell', 'Intel Xeon W-1250', '32GB', '1TB SSD', 'Nvidia Quadro P620', 1400.00, 1700.00, 2, '36 months', 'precision3650.jpg', '2025-12-04 21:55:09', 'OK'),
(12, 'WS-4002', 'HP ZBook Fury 15 G8', 'SN-HP-ZBF15-002', 2, 'Workstation Laptop', 'HP', 'Intel i7-11800H', '32GB', '1TB SSD', 'Nvidia RTX A2000', 1850.00, 2200.00, 2, '36 months', 'zbookfury15.jpg', '2025-12-04 21:55:09', 'OK'),
(14, 'MON-3002', 'Dell P2419H', 'SN-MON-DLL-3002', 1, 'Monitor', 'Dell', '', '', '', '', 150.00, 195.00, 8, '24 months', 'p2419h.jpg', '2025-12-04 21:55:29', 'OK'),
(15, 'MON-3003', 'HP EliteDisplay E243', 'SN-MON-HP-3003', 2, 'Monitor', 'HP', '', '', '', '', 160.00, 210.00, 10, '24 months', 'e243.jpg', '2025-12-04 21:55:29', 'OK'),
(16, 'MON-3004', 'HP V221', 'SN-MON-HP-3004', 2, 'Monitor', 'HP', '', '', '', '', 110.00, 150.00, 15, '12 months', 'v221.jpg', '2025-12-04 21:55:29', 'OK'),
(17, 'MON-3005', 'Lenovo ThinkVision T24i', 'SN-MON-LNV-3005', 1, 'Monitor', 'Lenovo', '', '', '', '', 170.00, 220.00, 9, '24 months', 't24i.jpg', '2025-12-04 21:55:29', 'OK'),
(18, 'MON-3006', 'Samsung Odyssey G3 24“', 'SN-MON-SMS-3006', 1, 'Monitor', 'Samsung', '', '', '', '', 190.00, 250.00, 6, '12 months', 'g3.jpg', '2025-12-04 21:55:29', 'OK'),
(19, 'MON-3007', 'Samsung S24F350', 'SN-MON-SMS-3007', 1, 'Monitor', 'Samsung', '', '', '', '', 100.00, 140.00, 18, '12 months', 's24f350.jpg', '2025-12-04 21:55:29', 'OK'),
(20, 'MON-3008', 'AOC 24B2XH', 'SN-MON-AOC-3008', 1, 'Monitor', 'AOC', '', '', '', '', 95.00, 130.00, 14, '12 months', '24b2xh.jpg', '2025-12-04 21:55:29', 'OK'),
(21, 'MON-3009', 'LG 24MP59G', 'SN-MON-LG-3009', 1, 'Monitor', 'LG', '', '', '', '', 140.00, 190.00, 7, '24 months', '24mp59g.jpg', '2025-12-04 21:55:29', 'OK'),
(22, 'MON-3010', 'Acer Nitro VG240Y', 'SN-MON-ACR-3010', 1, 'Monitor', 'Acer', '', '', '', '', 130.00, 175.00, 5, '24 months', 'vg240y.jpg', '2025-12-04 21:55:29', 'OK'),
(23, 'PRN-4001', 'HP LaserJet Pro M404dn', 'SN-PRN-HP-4001', 2, 'Printer', 'HP', '', '', '', '', 190.00, 250.00, 6, '12 months', 'm404dn.jpg', '2025-12-04 21:55:38', 'OK'),
(24, 'PRN-4002', 'HP LaserJet Pro M428fdw', 'SN-PRN-HP-4002', 2, 'Printer', 'HP', '', '', '', '', 280.00, 360.00, 4, '12 months', 'm428fdw.jpg', '2025-12-04 21:55:38', 'OK'),
(25, 'PRN-4003', 'Canon i-SENSYS MF445dw', NULL, 1, NULL, 'Canon', NULL, NULL, NULL, NULL, NULL, 340.00, 5, NULL, NULL, '2025-12-04 21:55:38', 'OK'),
(26, 'PRN-4004', 'Canon PIXMA G3420', 'SN-PRN-CAN-4004', 1, 'Printer', 'Canon', '', '', '', '', 180.00, 240.00, 7, '24 months', 'g3420.jpg', '2025-12-04 21:55:38', 'OK'),
(27, 'PRN-4005', 'Brother HL-L2350DW', 'SN-PRN-BRO-4005', 1, 'Printer', 'Brother', '', '', '', '', 140.00, 190.00, 12, '12 months', 'l2350dw.jpg', '2025-12-04 21:55:38', 'OK'),
(28, 'PRN-4006', 'Brother MFC-L2710DW', 'SN-PRN-BRO-4006', 1, 'Printer', 'Brother', '', '', '', '', 160.00, 220.00, 8, '12 months', 'l2710dw.jpg', '2025-12-04 21:55:38', 'OK'),
(29, 'PRN-4007', 'Epson EcoTank L3250', 'SN-PRN-EPS-4007', 1, 'Printer', 'Epson', '', '', '', '', 170.00, 230.00, 10, '24 months', 'l3250.jpg', '2025-12-04 21:55:38', 'OK'),
(30, 'PRN-4008', 'Epson WorkForce WF-2830', 'SN-PRN-EPS-4008', 1, 'Printer', 'Epson', '', '', '', '', 120.00, 170.00, 9, '12 months', 'wf2830.jpg', '2025-12-04 21:55:38', 'OK'),
(31, 'PRN-4009', 'Lexmark B2236dw', 'SN-PRN-LEX-4009', 2, 'Printer', 'Lexmark', '', '', '', '', 130.00, 180.00, 4, '24 months', 'b2236dw.jpg', '2025-12-04 21:55:38', 'OK'),
(32, 'PRN-4010', 'Kyocera ECOSYS P2040dn', 'SN-PRN-KYO-4010', 2, 'Printer', 'Kyocera', '', '', '', '', 220.00, 300.00, 3, '24 months', 'p2040dn.jpg', '2025-12-04 21:55:38', 'OK'),
(33, 'NET-5001', 'Cisco Catalyst 2960X', NULL, 1, NULL, 'Cisco', NULL, NULL, NULL, NULL, NULL, 1100.00, 2, NULL, NULL, '2025-12-04 21:55:44', 'OK'),
(34, 'NET-5002', 'Cisco RV345 VPN Router', 'SN-NET-CSC-5002', 1, 'Network', 'Cisco', '', '', '', '', 330.00, 450.00, 3, '24 months', 'rv345.jpg', '2025-12-04 21:55:44', 'OK'),
(35, 'NET-5003', 'Ubiquiti UniFi Switch 24', 'SN-NET-UBI-5003', 1, 'Network', 'Ubiquiti', '', '', '', '', 220.00, 300.00, 5, '24 months', 'usw24.jpg', '2025-12-04 21:55:44', 'OK'),
(36, 'NET-5004', 'Ubiquiti UniFi AP-AC Lite', 'SN-NET-UBI-5004', 1, 'Network', 'Ubiquiti', '', '', '', '', 70.00, 110.00, 10, '24 months', 'aclite.jpg', '2025-12-04 21:55:44', 'OK'),
(37, 'NET-5005', 'TP-Link Archer AX50', 'SN-NET-TPL-5005', 1, 'Network', 'TP-Link', '', '', '', '', 85.00, 130.00, 7, '24 months', 'ax50.jpg', '2025-12-04 21:55:44', 'OK'),
(38, 'NET-5006', 'TP-Link TL-SG1024', 'SN-NET-TPL-5006', 1, 'Network', 'TP-Link', '', '', '', '', 95.00, 140.00, 8, '24 months', 'sg1024.jpg', '2025-12-04 21:55:44', 'OK'),
(39, 'NET-5007', 'MikroTik hAP ac2', 'SN-NET-MKT-5007', 1, 'Network', 'MikroTik', '', '', '', '', 55.00, 85.00, 12, '12 months', 'hapac2.jpg', '2025-12-04 21:55:44', 'OK'),
(40, 'NET-5008', 'MikroTik Cloud Router Switch CRS326', 'SN-NET-MKT-5008', 1, 'Network', 'MikroTik', '', '', '', '', 190.00, 260.00, 3, '24 months', 'crs326.jpg', '2025-12-04 21:55:44', 'OK'),
(41, 'NET-5009', 'D-Link DGS-1210-24', 'SN-NET-DLK-5009', 1, 'Network', 'D-Link', '', '', '', '', 100.00, 150.00, 6, '24 months', 'dgs1210.jpg', '2025-12-04 21:55:44', 'OK'),
(42, 'NET-5010', 'Aruba Instant On AP22', 'SN-NET-ARB-5010', 2, 'Network', 'Aruba', '', '', '', '', 120.00, 170.00, 5, '24 months', 'ap22.jpg', '2025-12-04 21:55:44', 'OK');

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `id` int(11) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `total_price` decimal(10,2) DEFAULT NULL,
  `sold_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE `suppliers` (
  `id` int(11) NOT NULL,
  `name` varchar(150) DEFAULT NULL,
  `contact` varchar(150) DEFAULT NULL,
  `email` varchar(150) DEFAULT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `notes` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `suppliers`
--

INSERT INTO `suppliers` (`id`, `name`, `contact`, `email`, `phone`, `notes`) VALUES
(1, 'Dell Supplier Europe', 'Procurement', 'dell@example.com', '+381601234567', 'Main Dell distributor'),
(2, 'HP Central Supplier', 'Procurement', 'hp@example.com', '+381601234568', 'HP reseller');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role` enum('admin','user') DEFAULT 'user',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`, `created_at`) VALUES
(1, 'admin', 'admin123', 'admin', '2025-11-26 19:32:29'),
(2, 'staff', 'staff123', 'user', '2025-11-26 19:32:29');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `audit_log`
--
ALTER TABLE `audit_log`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `sku` (`sku`),
  ADD KEY `supplier_id` (`supplier_id`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `audit_log`
--
ALTER TABLE `audit_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`supplier_id`) REFERENCES `suppliers` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `sales`
--
ALTER TABLE `sales`
  ADD CONSTRAINT `sales_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
