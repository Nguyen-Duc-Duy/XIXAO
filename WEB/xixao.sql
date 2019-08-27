-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th7 07, 2019 lúc 05:34 PM
-- Phiên bản máy phục vụ: 10.3.16-MariaDB
-- Phiên bản PHP: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `xixao`
--
CREATE DATABASE IF NOT EXISTS `xixao` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `xixao`;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `admin_acc`
--

DROP TABLE IF EXISTS `admin_acc`;
CREATE TABLE `admin_acc` (
  `id` int(11) NOT NULL COMMENT 'chỉ mục tài khoản admin',
  `name_ad` varchar(50) NOT NULL COMMENT 'tên quản trị viên',
  `email_ad` varchar(100) NOT NULL COMMENT 'email của quản trị',
  `phone_ad` int(11) NOT NULL COMMENT 'sđt quản trị',
  `avt_ad` varchar(100) DEFAULT NULL COMMENT 'ảnh avatar quản trị',
  `name_acc` varchar(50) NOT NULL COMMENT 'tên tài khoản quản trị',
  `pass` varchar(100) NOT NULL COMMENT 'mật khẩu tài khoản',
  `date_create` datetime NOT NULL COMMENT 'ngày tạo tài khoản'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='tài khoản admin';

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `banner`
--

DROP TABLE IF EXISTS `banner`;
CREATE TABLE `banner` (
  `id` int(11) NOT NULL COMMENT 'chỉ mục banner',
  `id_category_child` int(11) NOT NULL COMMENT 'chỉ mục danh mục con ',
  `name_img` varchar(200) NOT NULL COMMENT 'tên ảnh banner'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='banner theo danh mucj';

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `category`
--

DROP TABLE IF EXISTS `category`;
CREATE TABLE `category` (
  `id` int(11) NOT NULL COMMENT 'chỉ mục danh mục cha và con',
  `id_parent` int(11) NOT NULL COMMENT 'chỉ mục danh mục cha',
  `name` varchar(50) NOT NULL COMMENT 'tên danh mục'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='danh mục cha và danh mục con cua sp';

--
-- Đang đổ dữ liệu cho bảng `category`
--

INSERT INTO `category` (`id`, `id_parent`, `name`) VALUES
(1, 0, 'nam'),
(2, 0, 'nu'),
(3, 1, 'Winter'),
(4, 1, 'Nude'),
(5, 2, 'Nude'),
(6, 2, 'Skirt');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `color`
--

DROP TABLE IF EXISTS `color`;
CREATE TABLE `color` (
  `id` int(11) NOT NULL COMMENT 'chỉ mục mầu sp',
  `color` varchar(50) NOT NULL COMMENT 'tên mầu'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='mầu';

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `feel`
--

DROP TABLE IF EXISTS `feel`;
CREATE TABLE `feel` (
  `id` int(11) NOT NULL COMMENT 'chỉ mục tương tác sản phẩm',
  `name_feel` varchar(50) NOT NULL COMMENT 'tên loại tương tác'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `list_img`
--

DROP TABLE IF EXISTS `list_img`;
CREATE TABLE `list_img` (
  `id` int(11) NOT NULL COMMENT 'chỉ mục ảnh sp',
  `id_product` int(11) NOT NULL COMMENT 'chỉ mục sản phẩm',
  `name_img` varchar(200) NOT NULL COMMENT 'tên ảnh của sản phẩm'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='anh chi tiet';

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `orders`
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE `orders` (
  `id` int(11) NOT NULL COMMENT 'chỉ mục bảng đơn hàng',
  `name_ship` varchar(50) NOT NULL COMMENT 'tên người nhận',
  `adress_ship` varchar(120) NOT NULL COMMENT 'địa chỉ người nhận',
  `email_ship` varchar(100) NOT NULL COMMENT 'emai người nhận',
  `phone_ship` int(11) NOT NULL COMMENT 'sđt người nhận',
  `id_user` int(11) NOT NULL COMMENT 'chỉ mục khách hàng',
  `status` varchar(20) NOT NULL COMMENT 'trạng thái đơn hàng',
  `money` float NOT NULL COMMENT 'tổng số tiền của đơn hàng',
  `date_create` datetime NOT NULL COMMENT 'ngày tạo đơn hàng'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='đơn hàng';

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `order_detail`
--

DROP TABLE IF EXISTS `order_detail`;
CREATE TABLE `order_detail` (
  `id` int(11) NOT NULL COMMENT 'chỉ mục bảng chi tiết đơn hàng',
  `id_product` int(11) NOT NULL COMMENT 'chỉ mục sp',
  `id_order` int(11) NOT NULL COMMENT 'chỉ mục đơn hàng',
  `quantity` tinyint(4) NOT NULL COMMENT 'số lượng sản phẩm'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='chi tiet don hang';

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `product`
--

DROP TABLE IF EXISTS `product`;
CREATE TABLE `product` (
  `id` int(11) NOT NULL COMMENT 'chỉ mục của sp',
  `name_product` varchar(50) NOT NULL COMMENT 'têm sản phẩm',
  `price` float NOT NULL COMMENT 'giá bán',
  `sale` float DEFAULT NULL COMMENT 'giá sale',
  `img_product` varchar(200) NOT NULL COMMENT 'tên ảnh chính của sp',
  `id_category_parent` int(11) NOT NULL COMMENT 'chỉ mục danh mục cha',
  `id_category_child` int(11) NOT NULL COMMENT 'chỉ mục danh mục con',
  `star` tinyint(4) DEFAULT NULL COMMENT 'số sao chất lượng sp',
  `descript` varchar(500) DEFAULT NULL COMMENT 'mô tả về sản phẩm',
  `date_create` datetime NOT NULL COMMENT 'ngày tạo'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='thông tin sản phẩm';

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `product_color`
--

DROP TABLE IF EXISTS `product_color`;
CREATE TABLE `product_color` (
  `id` int(11) NOT NULL COMMENT 'chỉ mục mầu sp',
  `id_product` int(11) NOT NULL COMMENT 'chỉ mục sản phẩm',
  `id_color` int(11) NOT NULL COMMENT 'chỉ mục mầu'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='mầu sản phẩm';

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `product_feel`
--

DROP TABLE IF EXISTS `product_feel`;
CREATE TABLE `product_feel` (
  `id` int(11) NOT NULL COMMENT 'chỉ mục tương tác sản phẩm',
  `id_product` int(11) NOT NULL COMMENT 'chỉ mục sản phẩm',
  `id_feel` int(11) NOT NULL COMMENT 'chỉ mục tương tác',
  `id_user` int(11) NOT NULL COMMENT 'chỉ mục người dùng'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='trạng thái tương tác cua nguoi dung va san pham';

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `product_size`
--

DROP TABLE IF EXISTS `product_size`;
CREATE TABLE `product_size` (
  `id` int(11) NOT NULL COMMENT 'chỉ mục cỡ sản phẩm',
  `id_product` int(11) NOT NULL COMMENT 'chỉ mục sản phẩm',
  `id_size` int(11) NOT NULL COMMENT 'chỉ mục cỡ'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='size san pham';

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `size`
--

DROP TABLE IF EXISTS `size`;
CREATE TABLE `size` (
  `id` int(11) NOT NULL COMMENT 'chỉ mục cỡ',
  `size` varchar(20) NOT NULL COMMENT 'cỡ'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='kich co';

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `slider`
--

DROP TABLE IF EXISTS `slider`;
CREATE TABLE `slider` (
  `id` int(11) NOT NULL COMMENT 'chỉ mục slider',
  `id_category_parent` int(11) NOT NULL COMMENT 'chỉ mục danh mục cha',
  `name_img` varchar(200) NOT NULL COMMENT 'tên ảnh slider'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='slider theo danh mucj';

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `user_acc`
--

DROP TABLE IF EXISTS `user_acc`;
CREATE TABLE `user_acc` (
  `id` int(11) NOT NULL COMMENT 'chỉ mục tk người dùng',
  `name_user` varchar(50) NOT NULL COMMENT 'tên người dùng',
  `adress` varchar(120) NOT NULL COMMENT 'địa chỉ người dùng',
  `email` varchar(100) NOT NULL COMMENT 'email người dùng',
  `phone` int(11) NOT NULL COMMENT 'sđt người dùng',
  `name_acc` int(50) NOT NULL COMMENT 'tên tài khoản người dùng',
  `avt` varchar(100) DEFAULT NULL COMMENT 'ảnh avatar tài khoản',
  `pass` varchar(100) NOT NULL COMMENT 'mật khẩu tài khoản người dùng',
  `date_create` datetime NOT NULL COMMENT 'ngày tạo'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='tài khoản user';

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `admin_acc`
--
ALTER TABLE `admin_acc`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `banner`
--
ALTER TABLE `banner`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_banner_category` (`id_category_child`);

--
-- Chỉ mục cho bảng `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `color`
--
ALTER TABLE `color`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `feel`
--
ALTER TABLE `feel`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `list_img`
--
ALTER TABLE `list_img`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_list_img_product` (`id_product`);

--
-- Chỉ mục cho bảng `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_orders_user` (`id_user`);

--
-- Chỉ mục cho bảng `order_detail`
--
ALTER TABLE `order_detail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_order_detail_product` (`id_product`),
  ADD KEY `FK_order_detail_order` (`id_order`);

--
-- Chỉ mục cho bảng `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_product_category_parent` (`id_category_parent`),
  ADD KEY `FK_product_category_child` (`id_category_child`);

--
-- Chỉ mục cho bảng `product_color`
--
ALTER TABLE `product_color`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_product_color_product` (`id_product`),
  ADD KEY `FK_product_color_color` (`id_color`);

--
-- Chỉ mục cho bảng `product_feel`
--
ALTER TABLE `product_feel`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_product_feel_product` (`id_product`),
  ADD KEY `FK_product_feel_feel` (`id_feel`),
  ADD KEY `FK_product_feel_user` (`id_user`);

--
-- Chỉ mục cho bảng `product_size`
--
ALTER TABLE `product_size`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_product_size_product` (`id_product`),
  ADD KEY `FK_product_size_size` (`id_size`);

--
-- Chỉ mục cho bảng `size`
--
ALTER TABLE `size`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `slider`
--
ALTER TABLE `slider`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_slider_category` (`id_category_parent`);

--
-- Chỉ mục cho bảng `user_acc`
--
ALTER TABLE `user_acc`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `admin_acc`
--
ALTER TABLE `admin_acc`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'chỉ mục tài khoản admin';

--
-- AUTO_INCREMENT cho bảng `banner`
--
ALTER TABLE `banner`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'chỉ mục banner';

--
-- AUTO_INCREMENT cho bảng `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'chỉ mục danh mục cha và con', AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `color`
--
ALTER TABLE `color`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'chỉ mục mầu sp';

--
-- AUTO_INCREMENT cho bảng `feel`
--
ALTER TABLE `feel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'chỉ mục tương tác sản phẩm';

--
-- AUTO_INCREMENT cho bảng `list_img`
--
ALTER TABLE `list_img`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'chỉ mục ảnh sp';

--
-- AUTO_INCREMENT cho bảng `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'chỉ mục bảng đơn hàng';

--
-- AUTO_INCREMENT cho bảng `order_detail`
--
ALTER TABLE `order_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'chỉ mục bảng chi tiết đơn hàng';

--
-- AUTO_INCREMENT cho bảng `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'chỉ mục của sp';

--
-- AUTO_INCREMENT cho bảng `product_color`
--
ALTER TABLE `product_color`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'chỉ mục mầu sp';

--
-- AUTO_INCREMENT cho bảng `product_feel`
--
ALTER TABLE `product_feel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'chỉ mục tương tác sản phẩm';

--
-- AUTO_INCREMENT cho bảng `product_size`
--
ALTER TABLE `product_size`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'chỉ mục cỡ sản phẩm';

--
-- AUTO_INCREMENT cho bảng `size`
--
ALTER TABLE `size`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'chỉ mục cỡ';

--
-- AUTO_INCREMENT cho bảng `slider`
--
ALTER TABLE `slider`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'chỉ mục slider';

--
-- AUTO_INCREMENT cho bảng `user_acc`
--
ALTER TABLE `user_acc`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'chỉ mục tk người dùng';

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `banner`
--
ALTER TABLE `banner`
  ADD CONSTRAINT `FK_banner_category` FOREIGN KEY (`id_category_child`) REFERENCES `category` (`id`);

--
-- Các ràng buộc cho bảng `list_img`
--
ALTER TABLE `list_img`
  ADD CONSTRAINT `FK_list_img_product` FOREIGN KEY (`id_product`) REFERENCES `product` (`id`);

--
-- Các ràng buộc cho bảng `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `FK_orders_user` FOREIGN KEY (`id_user`) REFERENCES `user_acc` (`id`);

--
-- Các ràng buộc cho bảng `order_detail`
--
ALTER TABLE `order_detail`
  ADD CONSTRAINT `FK_order_detail_order` FOREIGN KEY (`id_order`) REFERENCES `orders` (`id`),
  ADD CONSTRAINT `FK_order_detail_product` FOREIGN KEY (`id_product`) REFERENCES `product` (`id`);

--
-- Các ràng buộc cho bảng `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `FK_product_category_child` FOREIGN KEY (`id_category_child`) REFERENCES `category` (`id`),
  ADD CONSTRAINT `FK_product_category_parent` FOREIGN KEY (`id_category_parent`) REFERENCES `category` (`id`);

--
-- Các ràng buộc cho bảng `product_color`
--
ALTER TABLE `product_color`
  ADD CONSTRAINT `FK_product_color_color` FOREIGN KEY (`id_color`) REFERENCES `color` (`id`),
  ADD CONSTRAINT `FK_product_color_product` FOREIGN KEY (`id_product`) REFERENCES `product` (`id`);

--
-- Các ràng buộc cho bảng `product_feel`
--
ALTER TABLE `product_feel`
  ADD CONSTRAINT `FK_product_feel_feel` FOREIGN KEY (`id_feel`) REFERENCES `feel` (`id`),
  ADD CONSTRAINT `FK_product_feel_product` FOREIGN KEY (`id_product`) REFERENCES `product` (`id`),
  ADD CONSTRAINT `FK_product_feel_user` FOREIGN KEY (`id_user`) REFERENCES `user_acc` (`id`);

--
-- Các ràng buộc cho bảng `product_size`
--
ALTER TABLE `product_size`
  ADD CONSTRAINT `FK_product_size_product` FOREIGN KEY (`id_product`) REFERENCES `product` (`id`),
  ADD CONSTRAINT `FK_product_size_size` FOREIGN KEY (`id_size`) REFERENCES `size` (`id`);

--
-- Các ràng buộc cho bảng `slider`
--
ALTER TABLE `slider`
  ADD CONSTRAINT `FK_slider_category` FOREIGN KEY (`id_category_parent`) REFERENCES `category` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
