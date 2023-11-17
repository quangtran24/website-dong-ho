-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 17, 2017 at 03:09 PM
-- Server version: 10.1.10-MariaDB
-- PHP Version: 7.0.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `L8watch`
--

-- --------------------------------------------------------



--
-- Tạo bảng "Người dùng" (User)
CREATE TABLE NgườiDùng (
MãNgườiDùng INT PRIMARY KEY,
Tên VARCHAR(50),
TênTàiKhoản VARCHAR(50),
Email VARCHAR(100),
MậtKhẩu VARCHAR(100),
ĐịaChỉ VARCHAR(200),
SốĐiệnThoại VARCHAR(20),
quyen tinyint(4) NOT NULL DEFAULT '0'
)ENGINE=InnoDB DEFAULT CHARSET=utf8;
INSERT INTO `NgườiDùng` (MãNgườiDùng, Tên, TênTàiKhoản, Email, MậtKhẩu, ĐịaChỉ, SốĐiệnThoại, quyen)VALUES
(1,'tran van quang', 'tranquang', 'tranquang24.hust', '123', 'BKHN', '0329506959', 1),
(2,'tran van quang', 'tranquang2', 'tranquang25.hust', '123', 'BKHN', '0329506959', 0);
-- Tạo bảng "Danh mục" (Category)
CREATE TABLE DanhMục (
MãDanhMục INT PRIMARY KEY,
Tên VARCHAR(50),
MôTả VARCHAR(200)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `DanhMục` (`MãDanhMục`, `Tên`, `MôTả`) VALUES
(1, 'Rolex', 'Thụy Sỹ'),
(2, 'Cartier', 'Pháp'),
(3, 'Omega', 'Thụy Sỹ'),
(4, 'Patek Philippe', 'Thụy Sỹ'),
(5, 'Piaget', 'Thụy Sỹ'),
(6, 'Montblanc', 'Đức');




CREATE TABLE SảnPhẩm (
MãSảnPhẩm INT PRIMARY KEY,
TênSP VARCHAR(255) NOT NULL,
Giá VARCHAR(20) NOT NULL,
BảoHành TINYINT NOT NULL,
TrọngLượng INT NOT NULL,
ChấtLiệu VARCHAR(100) NOT NULL,
ChốngNước TINYINT NOT NULL,
NăngLượng VARCHAR(100) NOT NULL,
LoạiBảoHành VARCHAR(100) NOT NULL,
KíchThước VARCHAR(100) NOT NULL,
Màu VARCHAR(100) NOT NULL,
DànhCho VARCHAR(20) NOT NULL,
PhụKiện VARCHAR(255) NOT NULL,
KhuyếnMãi VARCHAR(100) NOT NULL,
TìnhTrạng VARCHAR(100) NOT NULL,
MãDanhMục INT NOT NULL,
ẢnhChính VARCHAR(255) NOT NULL,
LượtMua INT NOT NULL,
LượtXem INT NOT NULL,
NgàyNhập datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
FOREIGN KEY (MãDanhMục) REFERENCES DanhMục(MãDanhMục)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO SảnPhẩm (MãSảnPhẩm, TênSP, Giá, BảoHành, TrọngLượng, ChấtLiệu, ChốngNước, NăngLượng, LoạiBảoHành, KíchThước, Màu, DànhCho, PhụKiện, KhuyếnMãi, TìnhTrạng, MãDanhMục, ẢnhChính, LượtMua, LượtXem, NgàyNhập)
VALUES 

(1, 'Đồng hồ Rolex Datejust 179384-0002', '1 280 000', 24, 200, 'Inox, kính cường lực', 1, 'pin', 'Tại cửa hàng', '20 x 2 x 0.2', 'Bạc', 'Nam', 'Không', '10', 'new', 1, 'images/rolex/Rolex-Datejust-179384-0002.png', 119, 2100, '2017-10-30 04:14:16'),
(2, 'Đồng hồ Rolex Datejust 179174-0031', '1 580 000', 24, 210, 'Inox cao cấp, kính cường lực', 1, 'pin', 'Tại cửa hàng', '20 x 2 x 0.2', 'Bạc', 'Nam', 'Không', '10', 'new', 1, 'images/rolex/Rolex-Datejust-179174-0031.png', 2, 133, '2017-10-30 04:14:16'),
(3, 'Đồng hồ ROLEX DAYJUST 126300', '2 280 000', 36, 150, 'bạc, kính cường lực g4', 1, 'pin, điện', 'Tại nhà máy', '21 x 2 x 0.2', 'Bạc', 'Nam', '1 dây sạc', '20', 'new', 1, 'images/rolex/ROLEX-DAYJUST-126300.png', 321, 781, '2017-10-31 10:26:26'),
(4, 'Đồng hồ Rolex Datejust 179174-0094', '980 000', 24, 210, 'Inox cao cấp, kính cường lực', 0, 'pin', 'Tại cửa hàng', '20 x 2 x 0.2', 'Bạc', 'Nam', 'Không', '10', 'new', 1, 'images/rolex/Rolex-Datejust-179174-0094.png', 1230, 3101, '0000-00-00 00:00:00'),
(5, 'Đồng hồ Piaget 444', '450 000', 12, 300, 'Nhôm, kính', 0, 'pin', 'Tại cửa hàng', '20 x 2 x 0.2', 'Vàng kim', 'Nam, nữ', 'Không', '10', 'new', 5, 'images/piaget/piaget-444.png', 1231, 4321, '0000-00-00 00:00:00'),
(6, 'Đồng hồ Patek Philippe 778', '1 580 000', 24, 210, 'Inox cao cấp, kính cường lực', 1, 'pin', 'Tại cửa hàng', '20 x 2 x 0.2', 'Đen', 'Nam và Nữ', 'Không', '15', 'new', 4, 'images/patek-philippe/Patek-Philippe-778.png', 21, 134, '0000-00-00 00:00:00'),
(7, 'Đồng hồ Omega 102', '4 280 000', 36, 150, 'Đồng, kính cường lực g4', 1, 'pin', 'Tại nhà máy', '21 x 2 x 0.2', 'Đồng', 'Nam', 'Không', '20', 'new', 3, 'images/omega/omega-102.png', 123, 2432, '2017-11-14 00:00:00'),
(8, 'Đồng hồ montblanc e112', '380 000', 6, 213, 'da', 0, 'pin', 'Tại cửa hàng', '20 x 2 x 0.2', 'Đen', 'Nam và Nữ', 'Không', '5', 'new', 6, 'images/montblanc/montblanc-e112.png', 1232, 2314, '2017-11-17 09:00:35'),
(9, 'Đồng hồ Cartier 503', '410 000', 6, 213, 'da', 0, 'pin', 'Tại cửa hàng', '20 x 2 x 0.2', 'Đen', 'Nam và Nữ', 'Không', '5', 'new', 2, 'images/cartier/Cartier-503.png', 1231, 6344, '2017-11-10 11:33:00'),
(10, 'Đồng hồ Omega 307', '1 280 000', 12, 200, 'da, kính cao cấp', 1, 'Pin', 'Tại nơi sản xuất', '20 x 2 x 0.2', 'Xanh đen', 'Nam và Nữ', 'Không', '10%', 'Còn hàng', 3, 'images/omega/Omega 307.png', 1231, 1290, '2017-11-06 16:54:01'),
(11, 'Đồng hồ Omega CO', '2 280 000', 12, 200, 'da, kính cao cấp', 1, 'Pin', 'Tại nơi sản xuất', '20 x 2 x 0.2', 'Xanh đen', 'Nam và Nữ', 'Không', '10%', 'Còn hàng', 3, 'images/omega/omega CO.png', 123, 2290, '2017-11-06 16:54:01'),
(12, 'Đồng hồ Omega Xial', '2910000', 24, 100, 'Bạc, kính cường lực ', 1, 'Pin ', 'Tại nơi sản xuất ', '20 x 2 x 0.2 ', 'Bạc ', 'Nam ', 'Không ', '20% ', 'Còn hàng ', 3, 'images/omega/omega Xial.png ', 335, 2561, '0000-00-00 00:00:00'),
(13, 'Đồng hồ Cartier 604', '1 280 000', 24, 200, 'Inox, kính cường lực', 1, 'pin', 'Tại cửa hàng', '20 x 2 x 0.2', 'Đen', 'Nam', 'Không', '10', 'new', 2, 'images/cartier/cartier 604.png', 119, 2100, '2017-11-06 04:14:16'),
(14, 'Đồng hồ Cartier 705', '1 580 000', 24, 210, 'Inox cao cấp, kính cường lực', 1, 'pin', 'Tại cửa hàng', '20 x 2 x 0.2', 'Đen', 'Nam', 'Không', '10', 'new', 2, 'images/cartier/cartier 705.png', 2, 133, '2017-10-30 04:14:16'),
(15, 'Đồng hồ Cartier 806', '2 280 000', 36, 150, 'bạc, kính cường lực g4', 1, 'pin, điện', 'Tại nhà máy', '21 x 2 x 0.2', 'Nâu', 'Nam', '1 dây sạc', '20', 'new', 2, 'images/cartier/cartier 806.png', 321, 781, '2017-11-06 10:26:26'),
(16, 'Đồng hồ Cartier 907', '980 000', 24, 210, 'Inox cao cấp, kính cường lực', 0, 'pin', 'Tại cửa hàng', '20 x 2 x 0.2', 'Nâu', 'Nam', 'Không', '10', 'new', 2, 'images/cartier/cartier 907.png', 1230, 3101, '2017-11-06 05:16:15'),
(17, 'Đồng hồ Montblanc 1', '1 280 000', 24, 200, 'Inox, kính cường lực', 1, 'pin', 'Tại cửa hàng', '20 x 2 x 0.2', 'Đen', 'Nam', 'Không', '10', 'new', 6, 'images/montblanc/montblanc 1.png', 119, 2100, '2017-11-06 04:14:16'),
(18, 'Đồng hồ Montblanc 2', '1 580 000', 24, 210, 'Inox cao cấp, kính cường lực', 1, 'pin', 'Tại cửa hàng', '20 x 2 x 0.2', 'Đen', 'Nam', 'Không', '10', 'new', 6, 'images/montblanc/montblanc 2.png', 2, 133, '2017-10-30 04:14:16'),
(19, 'Đồng hồ Montblanc 3', '2 280 000', 36, 150, 'bạc, kính cường lực g4', 1, 'pin, điện', 'Tại nhà máy', '21 x 2 x 0.2', 'Đen', 'Nam', '1 dây sạc', '20', 'new', 6, 'images/montblanc/montblanc 3.png', 321, 781, '2017-11-06 10:26:26'),
(20, 'Đồng hồ Montblanc 4', '980 000', 24, 210, 'Inox cao cấp, kính cường lực', 0, 'pin', 'Tại cửa hàng', '20 x 2 x 0.2', 'Đen', 'Nam', 'Không', '10', 'new', 6, 'images/montblanc/montblanc 4.png', 1230, 3101, '2017-11-06 05:16:15'),
(21, 'Đồng hồ Piaget Z1', '1 280 000', 24, 200, 'Inox, kính cường lực', 1, 'pin', 'Tại cửa hàng', '20 x 2 x 0.2', 'Đen', 'Nam', 'Không', '10', 'new', 5, 'images/piaget/piaget z1.png', 119, 2100, '2017-11-06 04:14:16'),
(22, 'Đồng hồ Piaget Z2', '1 580 000', 24, 210, 'Inox cao cấp, kính cường lực', 1, 'pin', 'Tại cửa hàng', '20 x 2 x 0.2', 'Nâu', 'Nam', 'Không', '10', 'new', 5, 'images/piaget/piaget z2.png', 2, 133, '2017-10-30 04:14:16'),
(23, 'Đồng hồ Piaget Z3', '2 280 000', 36, 150, 'bạc, kính cường lực g4', 1, 'pin, điện', 'Tại nhà máy', '21 x 2 x 0.2', 'Bạc, xanh dương', 'Nam', '1 dây sạc', '20', 'new', 5, 'images/piaget/piaget z3.png', 321, 781, '2017-11-06 10:26:26'),
(24, 'Đồng hồ Piaget Z4', '980 000', 24, 210, 'Inox cao cấp, kính cường lực', 0, 'pin', 'Tại cửa hàng', '20 x 2 x 0.2', 'Đen', 'Nam', 'Không', '10', 'new', 5, 'images/piaget/piaget z4.png', 1230, 3101, '2017-11-06 05:16:15'),
(25, 'sp test', '980 000', 24, 210, 'Inox cao cấp, kính cường lực', 0, 'pin', 'Tại cửa hàng', '20 x 2 x 0.2', 'Đen', 'Nam', 'Không', '10', 'new', 5, 'images/piaget/piaget z4.png', 1230, 3101, '2017-11-06 05:16:15');

-- Tạo bảng "Đơn hàng" (Order)
CREATE TABLE ĐơnHàng (
MãĐơnHàng INT PRIMARY KEY,
MãNgườiDùng INT,
NgàyĐặt DATE,
TổngSốTiền DECIMAL(10, 2),
TrạngThái VARCHAR(50),
FOREIGN KEY (MãNgườiDùng) REFERENCES NgườiDùng(MãNgườiDùng)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Tạo bảng "Chi tiết đơn hàng" (OrderDetail)
CREATE TABLE ChiTiếtĐơnHàng (
MãChiTiếtĐơnHàng INT PRIMARY KEY,
MãĐơnHàng INT,
MãSảnPhẩm INT,
SốLượng INT,
ĐơnGiá DECIMAL(10, 2),
FOREIGN KEY (MãĐơnHàng) REFERENCES ĐơnHàng(MãĐơnHàng),
FOREIGN KEY (MãSảnPhẩm) REFERENCES SảnPhẩm(MãSảnPhẩm)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Tạo bảng "Bình luận" (Comment)
CREATE TABLE BìnhLuận (
MãBìnhLuận INT PRIMARY KEY,
MãNgườiDùng INT,
MãSảnPhẩm INT,
NộiDung VARCHAR(200),
NgàyBìnhLuận DATE,
FOREIGN KEY (MãNgườiDùng) REFERENCES NgườiDùng(MãNgườiDùng),
FOREIGN KEY (MãSảnPhẩm) REFERENCES SảnPhẩm(MãSảnPhẩm)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `bìnhluận` (`MãBìnhLuận`, `MãNgườiDùng`, `MãSảnPhẩm`, `NộiDung`, `NgàyBìnhLuận`) VALUES
(1, 1, 1, 'Đồng hồ rất đẹp!', '2023-07-02'),
(2, 1, 2, 'Mình đã mua sản phẩm này và rất hài lòng!', '2023-07-02'),
(3, 1, 3, 'Đồng hồ chất lượng cao, đáng giá giá tiền!', '2023-07-02'),
(4, 1, 4, 'Giao hàng nhanh chóng, sản phẩm đúng như mô tả!', '2023-07-02'),
(5, 1, 5, 'Thiết kế sang trọng, đẳng cấp!', '2023-07-02'),
(6, 1, 6, 'Tôi đã mua cho người thân và họ rất thích!', '2023-07-02'),
(7, 1, 7, 'Đồng hồ có kiểu dáng đẹp, phù hợp với mọi trang phục!', '2023-07-02'),
(8, 1, 8, 'Giá cả hợp lý, đáng mua!', '2023-07-02'),
(9, 1, 9, 'Đồng hồ nhẹ nhàng, thích hợp dùng hàng ngày!', '2023-07-02'),
(10, 1, 10, 'Chất lượng sản phẩm tuyệt vời!', '2023-07-02'),
(11, 1, 11, 'Đồng hồ Patek Philippe luôn là lựa chọn hàng đầu của tôi!', '2023-07-02'),
(12, 1, 12, 'Đẳng cấp và sang trọng!', '2023-07-02'),
(13, 1, 13, 'Đồng hồ Omega chất lượng tuyệt vời!', '2023-07-02'),
(14, 1, 14, 'Mình đã sở hữu một chiếc và rất hài lòng!', '2023-07-02'),
(15, 1, 15, 'Đồng hồ Montblanc đẹp và bền!', '2023-07-02'),
(16, 1, 16, 'Sản phẩm tốt, đáng mua!', '2023-07-02'),
(17, 1, 17, 'Cartier 503 rất đẹp, tôi rất hài lòng với sản phẩm này!', '2023-07-02'),
(18, 1, 18, 'Chất lượng sản phẩm cao cấp!', '2023-07-02'),
(19, 1, 19, 'Omega 307 là một sự lựa chọn tuyệt vời!', '2023-07-02'),
(20, 1, 20, 'Tôi đã mua cho bạn bè và họ rất thích!', '2023-07-02'),
(21, 1, 21, 'Omega CO là một chiếc đồng hồ đáng mua!', '2023-07-02'),
(22, 1, 22, 'Sản phẩm chất lượng cao!', '2023-07-02'),
(23, 1, 23, 'Đồng hồ Omega Xial sang trọng và đẳng cấp!', '2023-07-02'),
(24, 1, 24, 'Tôi rất hài lòng với sản phẩm này!', '2023-07-02'),
(25, 1, 25, 'Cartier 604 là một chiếc đồng hồ đẹp!', '2023-07-02');

-- Tạo bảng "Đánh giá" (Rating)
CREATE TABLE ĐánhGiá (
MãĐánhGiá INT PRIMARY KEY,
MãNgườiDùng INT,
MãSảnPhẩm INT,
Điểm INT,
NgàyĐánhGiá DATE,
FOREIGN KEY (MãNgườiDùng) REFERENCES NgườiDùng(MãNgườiDùng),
FOREIGN KEY (MãSảnPhẩm) REFERENCES SảnPhẩm(MãSảnPhẩm)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Tạo bảng "Giỏ hàng" (Cart)
CREATE TABLE GiỏHàng (
MãGiỏHàng INT PRIMARY KEY,
MãNgườiDùng INT,
MãSảnPhẩm INT,
SốLượng INT,
FOREIGN KEY (MãNgườiDùng) REFERENCES NgườiDùng(MãNgườiDùng),
FOREIGN KEY (MãSảnPhẩm) REFERENCES SảnPhẩm(MãSảnPhẩm)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;



-- Tạo bảng "Phương thức thanh toán" (PaymentMethod)
CREATE TABLE PhươngThứcThanhToán (
MãPhươngThứcThanhToán INT PRIMARY KEY,
Tên VARCHAR(50),
MôTả VARCHAR(200)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO PhươngThứcThanhToán (MãPhươngThứcThanhToán, Tên, MôTả)
VALUES
  (1, 'Tiền mặt', 'Thanh toán bằng tiền mặt khi nhận hàng'),
  (2, 'Chuyển khoản', 'Thanh toán bằng chuyển khoản qua ngân hàng'),
  (3, 'Thẻ tín dụng', 'Thanh toán bằng thẻ tín dụng'),
  (4, 'Ví điện tử', 'Thanh toán bằng ví điện tử như ZaloPay, MoMo');


CREATE TABLE VậnChuyển (
  MãVậnChuyển INT PRIMARY KEY,
  TênVậnChuyển VARCHAR(100),
  NgàyVậnChuyển DATE,
  NgàyDựKiếnGiao DATE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO VậnChuyển (MãVậnChuyển, TênVậnChuyển, NgàyVậnChuyển, NgàyDựKiếnGiao)
VALUES
  (1, 'Giao hàng nhanh', '2023-06-15', '2023-06-17'),
  (2, 'Chuyển phát tiết kiệm', '2023-06-16', '2023-06-20'),
  (3, 'Giao hàng trong ngày', '2023-06-15', '2023-06-15'),
  (4, 'Giao hàng quốc tế', '2023-06-14', '2023-06-25');


-- Tạo bảng "Hóa đơn" (Invoice)
CREATE TABLE HóaĐơn (
  MãHóaĐơn INT PRIMARY KEY,
  MãĐơnHàng INT,
  MãVậnChuyển INT,
  MãPhươngThứcThanhToán INT,
  TổngSốTiền DECIMAL(10, 2),
  NgàyHóaĐơn DATE,
  FOREIGN KEY (MãĐơnHàng) REFERENCES ĐơnHàng(MãĐơnHàng),
  FOREIGN KEY (MãPhươngThứcThanhToán) REFERENCES PhươngThứcThanhToán(MãPhươngThứcThanhToán),
  FOREIGN KEY (MãVậnChuyển) REFERENCES VậnChuyển(MãVậnChuyển)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


-- Tạo bảng "Nhà sản xuất" (Manufacturer)
CREATE TABLE NhàSảnXuất (
MãNhàSảnXuất INT PRIMARY KEY,
Tên VARCHAR(100),
MãSảnPhẩm INT,
FOREIGN KEY (MãSảnPhẩm) REFERENCES SảnPhẩm(MãSảnPhẩm)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Tạo bảng "Bảo hành" (Warranty)
CREATE TABLE BảoHành (
MãBảoHành INT PRIMARY KEY,
MãSảnPhẩm INT,
ThờiGian INT,
FOREIGN KEY (MãSảnPhẩm) REFERENCES SảnPhẩm(MãSảnPhẩm)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;




-- Tạo bảng "Coupon"
CREATE TABLE Coupon (
MãCoupon INT PRIMARY KEY,
MãSảnPhẩm INT,
MãNgườiDùng INT,
MãGiỏHàng INT,
Code VARCHAR(50),
GiảmGiá DECIMAL(10, 2),
FOREIGN KEY (MãSảnPhẩm) REFERENCES SảnPhẩm(MãSảnPhẩm),
FOREIGN KEY (MãNgườiDùng) REFERENCES NgườiDùng(MãNgườiDùng),
FOREIGN KEY (MãGiỏHàng) REFERENCES GiỏHàng(MãGiỏHàng)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Tạo bảng "Sản Phẩm Yêu Thích" (Bookmark)
CREATE TABLE SảnPhẩmYêuThích (
MãSảnPhẩmYêuThích INT PRIMARY KEY,
MãNgườiDùng INT,
MãSảnPhẩm INT,
FOREIGN KEY (MãNgườiDùng) REFERENCES NgườiDùng(MãNgườiDùng),
FOREIGN KEY (MãSảnPhẩm) REFERENCES SảnPhẩm(MãSảnPhẩm)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;


-- Tạo bảng "Khuyến mãi" (Promotion)
CREATE TABLE KhuyếnMãi (
MãKhuyếnMãi INT PRIMARY KEY,
MãSảnPhẩm INT,
NgàyBắtĐầu DATE,
NgàyKếtThúc DATE,
GiảmGiá DECIMAL(10, 2),
FOREIGN KEY (MãSảnPhẩm) REFERENCES SảnPhẩm(MãSảnPhẩm)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Tạo bảng "Liên hệ" (Contact)
CREATE TABLE LiênHệ (
MãLiênHệ INT PRIMARY KEY,
MãNgườiDùng INT,
Tên VARCHAR(50),
Email VARCHAR(100),
SốĐiệnThoại VARCHAR(20),
NộiDung VARCHAR(200),
FOREIGN KEY (MãNgườiDùng) REFERENCES NgườiDùng(MãNgườiDùng)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Tạo bảng "Nhà cung cấp" (Supplier)
CREATE TABLE NhàCungCấp (
MãNhàCungCấp INT PRIMARY KEY,
Tên VARCHAR(100),
MãSảnPhẩm INT,
FOREIGN KEY (MãSảnPhẩm) REFERENCES SảnPhẩm(MãSảnPhẩm)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Tạo bảng "Thẻ" (Card)
CREATE TABLE Thẻ (
MãThẻ INT PRIMARY KEY,
MãNgườiDùng INT,
Tên VARCHAR(50),
SốThẻ VARCHAR(16),
NgàyHếtHạn DATE,
FOREIGN KEY (MãNgườiDùng) REFERENCES NgườiDùng(MãNgườiDùng)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;