-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 17, 2022 at 05:31 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shop`
--

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `id` int(255) NOT NULL,
  `username` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(1000) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `coins` decimal(10,2) NOT NULL DEFAULT 0.00,
  `paid` decimal(10,2) NOT NULL DEFAULT 0.00,
  `type` enum('blacklisted','normal','manager','') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'normal',
  `ip` varchar(800) COLLATE utf8mb4_unicode_ci NOT NULL,
  `level` int(11) NOT NULL DEFAULT 0,
  `cooldown` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`id`, `username`, `password`, `email`, `coins`, `paid`, `type`, `ip`, `level`, `cooldown`) VALUES
(1, 'lolizapotter', '$2y$10$XT0BdrRZFWhrDb6uaZJ0EebC1HXGYCHuNOcnqUU4KWiTXqOSvZ.Xi', 'lolizapotter@gmail.com', '50.00', '0.00', 'manager', '::1', 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `key_topup`
--

CREATE TABLE `key_topup` (
  `id` int(11) NOT NULL,
  `keytext` varchar(255) NOT NULL,
  `amount` decimal(10,2) DEFAULT 0.00,
  `date` varchar(255) DEFAULT NULL,
  `owner` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `key_topup`
--

INSERT INTO `key_topup` (`id`, `keytext`, `amount`, `date`, `owner`, `status`) VALUES
(1, 'htr-3I7H5lnnIMDQyLyMHXe1A6ZqvzoD6TzU', '50.00', '2022-01-17 10:10:16', 'lolizapotter', 'success');

-- --------------------------------------------------------

--
-- Table structure for table `log_random`
--

CREATE TABLE `log_random` (
  `id` int(11) NOT NULL,
  `info` text NOT NULL,
  `date` text NOT NULL,
  `owner` text NOT NULL,
  `type` varchar(255) NOT NULL DEFAULT 'mc'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `log_topup`
--

CREATE TABLE `log_topup` (
  `id` int(11) NOT NULL,
  `transaction` varchar(255) NOT NULL,
  `point` decimal(10,2) NOT NULL,
  `username` varchar(255) NOT NULL,
  `time` text NOT NULL,
  `status` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `log_topup`
--

INSERT INTO `log_topup` (`id`, `transaction`, `point`, `username`, `time`, `status`) VALUES
(1, 'เติมเงินด้วยคีย์', '50.00', 'lolizapotter', '2022-01-17 10:10:16', 'success');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(255) NOT NULL,
  `name` varchar(1500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `help` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` decimal(10,2) NOT NULL DEFAULT 0.00,
  `pattern` enum('normaltext','code','eml:psw','usr:psw','usr:eml:psw') COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `image`, `description`, `help`, `price`, `pattern`) VALUES
(1, 'Minecraft NFA', 'https://media.discordapp.net/attachments/857581861621202994/894952336429023303/20210503_184308.jpg', 'Minecraft NFA\r\n└ ไม่สามารถเปลี่ยนข้อมูลได้ทุกอย่าง\r\n└ สุ่มการโดนแบนจากเซิร์ฟเวอร์ <a href=\"\">Hypixel</a>\r\n\r\nประกันการใช้งาน\r\n└ 1 วันหลังจากซื้อ', '► ดาวน์โหลดตัวเกมมายคราฟ<br>\r\n► กดล็อกอินด้วย Mojang<br>\r\n► Enjoy<br>', '2.00', 'eml:psw'),
(2, 'Minecraft SFA', 'https://media.discordapp.net/attachments/857581861621202994/894952341894201375/20210503_182750.jpg', 'Minecraft SFA\r\n└ สามารถเปลียนชื่อได้\r\n└ สามารถเปลียนรหัสได้\r\n└ สามารถเปลียนสกินได้\r\n└ ไม่สามารถเปลียน อีเมล กับ รหัสความปลอดภัยได้\r\n└ สุ่มการโดนแบนจากเซิร์ฟเวอร์ <a href=\"\">Hypixel</a>\r\n\r\nประกันการใช้งาน\r\n└ 1 วันหลังจากซื้อ', '► ดาวน์โหลดตัวเกมมายคราฟ<br>\r\n► (สามารถเปลี่ยนข้อมูลได้ที่ <a href=\"https://minecraft.net/en-us/\">Minecraft</a>)<br>\r\n► กดล็อกอินด้วย Mojang<br>\r\n► Enjoy<br>', '5.00', 'eml:psw'),
(3, 'Minecraft MFA', 'https://media.discordapp.net/attachments/857581861621202994/894952339344093184/20210503_182309.jpg', 'Minecraft MFA\r\n└ สามารถเปลียนชื่อได้\r\n└ สามารถเปลียนรหัสได้\r\n└ สามารถเปลียนสกินได้\r\n└ สามารถเปลียนอีเมลได้\r\n└ สามารถเปลียนรหัสรักษาความปลอดภัยได้\r\n└ สามารถเข้าถึงอีเมลของบัญชีได้\r\n└ สุ่มการโดนแบนจากเซิร์ฟเวอร์ <a href=\"\">Hypixel</a>\r\n\r\nประกันการใช้งาน\r\n└ ตลอดอายุการใช้งาน', '► ดาวน์โหลดตัวเกมมายคราฟ<br>\r\n► (สามารถเปลี่ยนข้อมูลได้ที่ <a href=\"https://minecraft.net/en-us/\">Minecraft</a>)<br>\r\n► กดล็อกอินด้วย Mojang<br>\r\n► Enjoy<br>', '350.00', 'normaltext'),
(4, 'Discord Nitro Classic 1 Month', 'https://support.discord.com/hc/article_attachments/360013500032/nitro_gif.gif', 'Discord Nitro Classic 1 Month\r\n└ ไนโตร์ดิสคอด 1 เดือน\r\n└ ใช้ได้กับทุกประเภท\r\n\r\nประกันการใช้งาน\r\n└ ประกันตลอดการใช้งาน (1 เดือน)', '► กดที่ลิงก์<br>\r\n► เพิ่มที่อยู่การชำระเงิน<br>\r\n► Enjoy กับมัน!<br>', '99.00', 'normaltext'),
(5, 'Discord Nitro 1 Month', 'https://gudstory.s3.us-east-2.amazonaws.com/wp-content/uploads/2021/02/08150513/Discord-Nitro.png', 'Discord Nitro 1 Month\r\n└ ไนโตร์ดิสคอด 1 เดือน\r\n└ ใช้ได้กับทุกประเภท\r\n\r\nประกันการใช้งาน\r\n└ ประกันตลอดการใช้งาน (1 เดือน)', '► กดที่ลิงก์<br>\r\n► เพิ่มที่อยู่การชำระเงิน<br>\r\n► Enjoy กับมัน!<br>', '219.00', 'normaltext'),
(6, 'Netflix Premium สุ่มจอ', 'https://digitalagemag.com/wp-content/uploads/2021/01/netflix.png', 'Netflix Premium สุ่มจอ\r\n└ ไม่สามารถเปลี่ยนข้อมูลได้ทุกอย่าง\r\n└ ใช้สำหรับดูเท่านั้น\r\n└ 1 โปรไฟล์เท่านั้นห้ามสร้างเพิ่ม มิเช่นนั้นประกันขาด\r\n\r\nประกันการใช้งาน\r\n└ 1 วัน', '► เข้าไปที่เว็บไซต์ <a href=\"https://netflix.com\">Netflix.com</a><br>\r\n► ล็อกอิน<br>\r\n► Enjoy<br>', '25.00', 'eml:psw'),
(7, 'OnlyFans สุ่มจำนวนเงิน', 'https://static.thairath.co.th/media/4DQpjUtzLUwmJZZSC5CnRPh8mlUiVesST50OMJ3Vf3lw.jpg', 'OnlyFans สุ่มจำนวนเงิน\r\n└ ไม่สามารถเปลี่ยนข้อมูลได้ทุกอย่าง\r\n└ กดซับได้แค่ 1 ต่ออาทิยต์หรือ 1 - 3\r\n└ สุ่มซับ\r\n└ เงินในบัญชี 0 - 100$\r\n└ บางบัญชีอาจเป็นบัญชีปล่าว\r\n\r\nประกันการใช้งาน\r\n└ 1 วัน', '► เข้าไปที่เว็บไซต์ <a href=\"https://onlyfans.com\">Onlyfans.com</a><br>\r\n► ล็อกอิน<br>\r\n► Enjoy<br>', '20.00', 'eml:psw'),
(8, 'PornHub Premium', 'https://ggsel.com/products_images/2741379/original/p1_2683200_5cc0806f.webp', 'PornHub Premium\r\n└ ไม่สามารถเปลี่ยนข้อมูลได้ทุกอย่าง\r\n\r\nประกันการใช้งาน\r\n└ 7 วัน', '► ใช้ VPN ของ <a href=\"https://nordvpn.com\">NordVPN</a> หรืออื่นๆก็ได้ หรือซื้อจากร้านเราก็ได้นะ<br>\r\n► เข้าไปที่เว็บไซต์ <a href=\"https://pornhub.com\">Pornhub.com</a><br>\r\n► ล็อกอิน<br>\r\n► Enjoy<br>', '70.00', 'eml:psw'),
(9, 'NordVPN', 'https://www.globalwatchonline.com/wp-content/uploads/2019/11/nord.jpg', 'NordVPN\r\n└ ไม่สามารถเปลี่ยนข้อมูลได้ทุกอย่าง\r\n\r\nประกันการใช้งาน\r\n└ 1 วัน', '► เข้าไปที่เว็บไซต์ <a href=\"https://nordvpn.com\">Nordvpn.com</a><br>\r\n► ดาวโหลดโปรแกรม><br>\r\n► ล็อกอิน<br>\r\n► Enjoy<br>', '25.00', 'eml:psw'),
(10, 'Optifine Cape [สุ่มย้าย]', 'https://ph-test-11.slatic.net/p/e91c73f85ef7f3237c40b09102cf4b49.jpg', 'Optifine Cape [สุ่มย้าย]\r\n└ สุ่มการย้าย [ย้ายผ้าคลุม]\r\n└ สุ่มบัญชีแบบ NFA/SFA\r\n└ บางตัวอาจจะย้ายผ้าคลุมไม่ได้\r\n\r\nประกันการใช้งาน\r\n└ 1 ชม.\r\n└ หากมีปัญหาโปรดติดต่อแอดมินให้เร็วที่สุด', '► ดาวน์โหลดตัวเกมมายคราฟ<br>\r\n► กดล็อกอินด้วย Mojang<br>\r\n► Enjoy<br>', '20.00', 'eml:psw'),

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `keywords` varchar(255) NOT NULL,
  `truewallet` varchar(255) NOT NULL,
  `discord` varchar(255) NOT NULL,
  `page_id` varchar(255) NOT NULL,
  `theme_color` varchar(255) NOT NULL,
  `logged_in_greeting` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `title`, `description`, `image`, `keywords`, `truewallet`, `discord`, `page_id`, `theme_color`, `logged_in_greeting`) VALUES
(1, 'lolizapotter', 'ร้านขายไอดีเกมมายคราฟ และเกมอื่นๆ<br>ที่ถูกกว่าราคาตลาดทั่วไป', '', 'Common_SHOP, ร้านขายชองเกี่ยวกับเกมส์ราคาถูก', '', 'https://www.facebook.com/', '', '#50cd89', 'ติดต่อสอบถามเกี่ยวกับสินค้า เติมเงิน หรือ รายงานระบบ');

-- --------------------------------------------------------

--
-- Table structure for table `stock`
--

CREATE TABLE `stock` (
  `id` int(255) NOT NULL,
  `type` int(255) NOT NULL,
  `contents` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `username` (`username`);

--
-- Indexes for table `key_topup`
--
ALTER TABLE `key_topup`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `log_random`
--
ALTER TABLE `log_random`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `log_topup`
--
ALTER TABLE `log_topup`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stock`
--
ALTER TABLE `stock`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `key_topup`
--
ALTER TABLE `key_topup`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `log_random`
--
ALTER TABLE `log_random`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `log_topup`
--
ALTER TABLE `log_topup`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `stock`
--
ALTER TABLE `stock`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
