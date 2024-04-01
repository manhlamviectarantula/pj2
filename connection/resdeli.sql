-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 15, 2024 at 05:47 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `resdeli`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `adm_id` int(11) NOT NULL,
  `username` varchar(222) NOT NULL,
  `email` varchar(222) NOT NULL,
  `phone` varchar(222) NOT NULL,
  `password` varchar(222) NOT NULL,
  `cre_date` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`adm_id`, `username`, `email`, `phone`, `password`, `cre_date`) VALUES
(1, 'manh', 'cknguyenmanh@gmail.com', '0383054328', 'manh12', '2024-03-15 23:47:37');

-- --------------------------------------------------------

--
-- Table structure for table `detail_orders`
--

CREATE TABLE `detail_orders` (
  `no` int(11) NOT NULL,
  `o_id` int(11) NOT NULL,
  `d_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `vou_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `dishes`
--

CREATE TABLE `dishes` (
  `d_id` int(11) NOT NULL,
  `rs_id` int(11) NOT NULL,
  `d_name` varchar(255) NOT NULL,
  `d_des` varchar(255) NOT NULL,
  `price` int(11) NOT NULL,
  `image` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `dishes`
--

INSERT INTO `dishes` (`d_id`, `rs_id`, `d_name`, `d_des`, `price`, `image`) VALUES
(1, 1, 'Chả cừu Yorkshire', 'Món chả cừu tan chảy trong miệng, vừa nhanh vừa dễ làm. Ăn nóng với salad thấm sốt.', 1499000, '62908867a48e4.jpg'),
(2, 1, 'Tôm hùm Thermidor', 'Tôm Hùm Thermidor gồm thịt tôm hùm được nấu trong nước sốt rượu vang đậm đà, được nhồi lại vào vỏ tôm hùm và có màu nâu.', 1899000, '629089fee52b9.jpg'),
(3, 4, 'Gà Madeira', 'Gà Madeira giống như Gà Marsala, được làm từ thịt gà, nấm. Nhưng loại rượu ướp nên hương vị của gà thì khác nhau.', 699000, '62908bdf2f581.jpg'),
(4, 1, 'Khoai tây nhồi thịt cừu', 'Chiên ngập dầu cả củ khoai tây trong 8-10 phút hoặc thoa ít dầu lên từng củ khoai tây. Trộn hành, tỏi, cà chua và nấm. Thêm sữa chua, gừng, tỏi, ớt, rau mùi, phô mai.', 249000, '62908d393465b.jpg'),
(5, 2, 'Mỳ Ý tôm', 'Mỳ Ý với tôm sốt cà chua tươi. Món ăn này có nguồn gốc từ miền nam nước Ý với sự kết hợp của tôm, tỏi, ớt và mì ống. Trang trí mỗi cái với muỗng canh rau mùi tây còn lại.', 429000, '606d7491a9d13.jpg'),
(6, 2, 'Khoai tây nghiền phô mai', 'Khoai tây nghiền phô mai thơm ngon. Hỗn hợp tuyệt vời nhất cho bàn tiệc Lễ Tạ ơn của bạn hoặc món ăn kèm hoàn hảo cho món thịt hầm xúc xích thuần chay. Mọi người sẽ thích nó mịn, sến.', 349000, '606d74c416da5.jpg'),
(7, 2, 'Gà chiên giòn', 'Thịt gà xé sợi ăn kèm sốt mù tạt mật ong đặc biệt.', 539000, '606d74f6ecbbb.jpg'),
(8, 2, 'Gà nướng chanh và mì ống', 'Ức gà nướng ướp hương thảo ăn kèm với khoai tây nghiền và mì ống tùy chọn.', 639000, '606d752a209c3.jpg'),
(9, 3, 'Cơm chiên Dương Châu', 'Cơm chiên Dương Châu từ Trung Quốc với bắp cải, đậu, cà rốt và hành lá.', 339000, '606d7575798fb.jpg'),
(10, 3, 'Bánh phồng tôm', '12 cái bánh phồng tôm chiên giòn', 89000, '606d75a7e21ec.jpg'),
(11, 3, 'Nem rán', 'Bắp cải, hành tây và cà rốt thái nhỏ, gói trong giấy gói nem nhà làm, chiên vàng giòn.', 239000, '606d75ce105d0.jpg'),
(12, 3, 'Gà Mãn Châu', 'Những miếng thịt gà nấu chậm với hành lá trong nhà của chúng tôi làm nước sốt kiểu Mãn Châu.', 549000, '606d7600dc54c.jpg'),
(13, 4, 'Cánh gà chiên', 'Cánh gà chiên sốt cay ăn kèm cần tây giòn và sốt phô mai xanh.', 329000, '606d765f69a19.jpg'),
(14, 4, 'Bánh phô mai Mac N', 'Phục vụ với Queso cay truyền thống và sốt Marinara của chúng tôi.', 179000, '606d768a1b2a1.jpg'),
(15, 4, 'Khoai tây sắn', 'Khoai tây cắt lát xoắn ốc, phủ Queso cay truyền thống của chúng tôi, pho mát Monterey Jack, cà chua trộn, kem chua và ngò tươi.', 449000, '606d76ad0c0cb.jpg'),
(16, 4, 'Nui xào thịt viên', 'Thịt bò viên tỏi-thảo mộc trộn với nước sốt Marinara tự làm và nui phủ mùi tây tươi.', 349000, '606d76eedbb99.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `momo`
--

CREATE TABLE `momo` (
  `id_momo` int(11) NOT NULL,
  `o_id` int(11) NOT NULL,
  `amount` varchar(50) NOT NULL,
  `order_type` varchar(50) NOT NULL,
  `pay_type` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order_status`
--

CREATE TABLE `order_status` (
  `sta_id` int(11) NOT NULL,
  `sta_name` varchar(222) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `order_status`
--

INSERT INTO `order_status` (`sta_id`, `sta_name`) VALUES
(1, 'Chờ xác nhận'),
(2, 'Đang giao'),
(3, 'Đã hủy'),
(4, 'Thành công');

-- --------------------------------------------------------

--
-- Table structure for table `restaurants`
--

CREATE TABLE `restaurants` (
  `rs_id` int(11) NOT NULL,
  `username` varchar(222) NOT NULL,
  `password` varchar(222) NOT NULL,
  `res_name` varchar(222) NOT NULL,
  `email` varchar(222) NOT NULL,
  `phone` varchar(222) NOT NULL,
  `url` varchar(222) NOT NULL,
  `o_hr` varchar(222) NOT NULL,
  `c_hr` varchar(222) NOT NULL,
  `o_days` varchar(222) NOT NULL,
  `address` text NOT NULL,
  `image` text NOT NULL,
  `cre_date` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `restaurants`
--

INSERT INTO `restaurants` (`rs_id`, `username`, `password`, `res_name`, `email`, `phone`, `url`, `o_hr`, `c_hr`, `o_days`, `address`, `image`, `cre_date`) VALUES
(1, 'elbow_room', '76786fee9609d6e143772a200b0019f7', 'The Elbow-Room Bistro', 'elbow_room@mail.com', '3547854700', 'https://the-elbow-room-bistro.business.site/', '8am', '8pm', 'Thứ 2 - Thứ 7', '52 Pasteur, Bến Nghé, Quận 1, Thành phố Hồ Chí Minh', '6290877b473ce.jpg', '2024-03-15 23:47:37'),
(2, 'nossa', 'b5bee2cf5f44d0852e2b3a18fd3c9f6d', 'Nossa ', 'nossa@gmail.com', '0557426406', 'www.nossa.com', '11am', '9pm', 'Thứ 2 - Thứ 7', '36 Phạm Hồng Thái, Phường Bến Thành, Quận 1, Thành phố Hồ Chí Minh', '606d720b5fc71.jpg', '2024-03-15 23:47:37'),
(3, 'laires', '40c43805bd2b12679fcb4a557c170bc4', 'Lai Restaurant', 'laires@mail.com', '1458745855', 'www.laivn.com', '9am', '8pm', 'Thứ 2 - Thứ 7', 'Tầng 28 Sedona Suites 92-94 Nam Kỳ Khởi Nghĩa, 28th Floor, Ward, Bến Nghé, Quận 1, Thành phố Hồ Chí Minh', '6290860e72d1e.jpg', '2024-03-15 23:47:37'),
(4, 'boomerangbistro', '4e37c9f88ff29c2780d9d21910b18a03', 'Boomerang Bistro', 'boomerangbistro@mail.com', '6545687458', 'www.boomerangsaigon.com', '7am', '8pm', 'Thứ 2 - Thứ 7', '107 Tôn Dật Tiên, Tân Phú, Quận 7, Thành phố Hồ Chí Minh', '6290af6f81887.jpg', '2024-03-15 23:47:37');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `u_id` int(11) NOT NULL,
  `username` varchar(222) NOT NULL,
  `f_name` varchar(222) NOT NULL,
  `l_name` varchar(222) NOT NULL,
  `email` varchar(222) NOT NULL,
  `phone` varchar(222) NOT NULL,
  `password` varchar(222) NOT NULL,
  `address` text NOT NULL,
  `cre_date` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users_orders`
--

CREATE TABLE `users_orders` (
  `o_id` int(11) NOT NULL,
  `u_id` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `sta_id` int(11) NOT NULL DEFAULT 1,
  `payment` text NOT NULL,
  `cre_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `voucher`
--

CREATE TABLE `voucher` (
  `vou_id` int(11) NOT NULL,
  `v_name` varchar(50) NOT NULL,
  `value` int(11) NOT NULL,
  `vou_des` varchar(222) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `voucher`
--

INSERT INTO `voucher` (`vou_id`, `v_name`, `value`, `vou_des`) VALUES
(1, 'KHONG', 0, 'Không có');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`adm_id`);

--
-- Indexes for table `detail_orders`
--
ALTER TABLE `detail_orders`
  ADD PRIMARY KEY (`no`),
  ADD KEY `o_id` (`o_id`),
  ADD KEY `d_id` (`d_id`),
  ADD KEY `vou_id` (`vou_id`);

--
-- Indexes for table `dishes`
--
ALTER TABLE `dishes`
  ADD PRIMARY KEY (`d_id`),
  ADD KEY `rs_id` (`rs_id`);

--
-- Indexes for table `momo`
--
ALTER TABLE `momo`
  ADD PRIMARY KEY (`id_momo`),
  ADD KEY `o_id` (`o_id`);

--
-- Indexes for table `order_status`
--
ALTER TABLE `order_status`
  ADD PRIMARY KEY (`sta_id`);

--
-- Indexes for table `restaurants`
--
ALTER TABLE `restaurants`
  ADD PRIMARY KEY (`rs_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`u_id`);

--
-- Indexes for table `users_orders`
--
ALTER TABLE `users_orders`
  ADD PRIMARY KEY (`o_id`),
  ADD KEY `sta_id` (`sta_id`),
  ADD KEY `u_id` (`u_id`);

--
-- Indexes for table `voucher`
--
ALTER TABLE `voucher`
  ADD PRIMARY KEY (`vou_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `adm_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `detail_orders`
--
ALTER TABLE `detail_orders`
  MODIFY `no` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `dishes`
--
ALTER TABLE `dishes`
  MODIFY `d_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `momo`
--
ALTER TABLE `momo`
  MODIFY `id_momo` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `order_status`
--
ALTER TABLE `order_status`
  MODIFY `sta_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `restaurants`
--
ALTER TABLE `restaurants`
  MODIFY `rs_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `u_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users_orders`
--
ALTER TABLE `users_orders`
  MODIFY `o_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `voucher`
--
ALTER TABLE `voucher`
  MODIFY `vou_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `detail_orders`
--
ALTER TABLE `detail_orders`
  ADD CONSTRAINT `detail_orders_ibfk_1` FOREIGN KEY (`o_id`) REFERENCES `users_orders` (`o_id`),
  ADD CONSTRAINT `detail_orders_ibfk_2` FOREIGN KEY (`d_id`) REFERENCES `dishes` (`d_id`),
  ADD CONSTRAINT `detail_orders_ibfk_3` FOREIGN KEY (`vou_id`) REFERENCES `voucher` (`vou_id`);

--
-- Constraints for table `dishes`
--
ALTER TABLE `dishes`
  ADD CONSTRAINT `dishes_ibfk_1` FOREIGN KEY (`rs_id`) REFERENCES `restaurants` (`rs_id`);

--
-- Constraints for table `momo`
--
ALTER TABLE `momo`
  ADD CONSTRAINT `momo_ibfk_1` FOREIGN KEY (`o_id`) REFERENCES `users_orders` (`o_id`);

--
-- Constraints for table `users_orders`
--
ALTER TABLE `users_orders`
  ADD CONSTRAINT `users_orders_ibfk_1` FOREIGN KEY (`sta_id`) REFERENCES `order_status` (`sta_id`),
  ADD CONSTRAINT `users_orders_ibfk_2` FOREIGN KEY (`u_id`) REFERENCES `users` (`u_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
