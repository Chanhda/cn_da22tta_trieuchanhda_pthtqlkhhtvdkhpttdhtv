-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th1 06, 2026 lúc 04:54 PM
-- Phiên bản máy phục vụ: 10.4.32-MariaDB
-- Phiên bản PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `ql_kehoachhoctap`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `chitietkehoach`
--

CREATE TABLE `chitietkehoach` (
  `ID` int(11) NOT NULL,
  `ID_KeHoach` int(11) DEFAULT NULL,
  `MaHocPhan` varchar(20) DEFAULT NULL,
  `TrangThaiMon` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `chitietkehoach`
--

INSERT INTO `chitietkehoach` (`ID`, `ID_KeHoach`, `MaHocPhan`, `TrangThaiMon`) VALUES
(11, 4, 'TIN101', 'ChuaHoc'),
(12, 4, 'TOAN01', 'ChuaHoc'),
(13, 4, 'CNTT202', 'ChuaHoc'),
(14, 4, 'CNTT204', 'ChuaHoc'),
(15, 5, 'TIN101', 'ChuaHoc'),
(16, 5, 'TOAN01', 'ChuaHoc'),
(17, 5, 'CNTT202', 'ChuaHoc'),
(18, 5, 'CNTT204', 'ChuaHoc');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `chuongtrinhdaotao`
--

CREATE TABLE `chuongtrinhdaotao` (
  `MaCTDT` varchar(20) NOT NULL,
  `TenChuongTrinh` varchar(150) NOT NULL,
  `NamApDung` int(11) DEFAULT NULL,
  `TongSoTinChi` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `chuongtrinhdaotao`
--

INSERT INTO `chuongtrinhdaotao` (`MaCTDT`, `TenChuongTrinh`, `NamApDung`, `TongSoTinChi`) VALUES
('CNTT_2021', 'Kỹ sư Công nghệ thông tin', 2021, 150),
('CNTT_2022', '', 2022, 150),
('CNTT_2023', 'Kỹ sư Công nghệ thông tin', 2023, 150);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `covanhoctap`
--

CREATE TABLE `covanhoctap` (
  `MaCoVan` varchar(20) NOT NULL,
  `HoTen` varchar(100) NOT NULL,
  `MaKhoa` varchar(50) DEFAULT '',
  `Email` varchar(100) DEFAULT NULL,
  `SoDienThoai` varchar(20) DEFAULT '',
  `Khoa` varchar(100) DEFAULT NULL,
  `ID_TaiKhoan` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `covanhoctap`
--

INSERT INTO `covanhoctap` (`MaCoVan`, `HoTen`, `MaKhoa`, `Email`, `SoDienThoai`, `Khoa`, `ID_TaiKhoan`) VALUES
('gv001', 'Giảng Viên Test', 'CNTT', 'gv@tvu.edu.vn', '0909000111', NULL, 2),
('gv002', 'Giảng Viên 2', 'CNTT', 'gv@tvu.edu.vn', '0909000111', NULL, 11);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `dieukientienquyet`
--

CREATE TABLE `dieukientienquyet` (
  `ID` int(11) NOT NULL,
  `MaHocPhan` varchar(20) DEFAULT NULL,
  `MaHocPhanTienQuyet` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `dieukientienquyet`
--

INSERT INTO `dieukientienquyet` (`ID`, `MaHocPhan`, `MaHocPhanTienQuyet`) VALUES
(1, 'CNTT201', 'CNTT100'),
(2, 'CNTT203', 'CNTT202'),
(3, 'CNTT100', 'CNTT201');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `hocphan`
--

CREATE TABLE `hocphan` (
  `MaHocPhan` varchar(20) NOT NULL,
  `TenHocPhan` varchar(150) NOT NULL,
  `SoTinChi` int(11) NOT NULL,
  `SoTietLyThuyet` int(11) DEFAULT 0,
  `SoTietThucHanh` int(11) DEFAULT 0,
  `HocKyGoiY` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `hocphan`
--

INSERT INTO `hocphan` (`MaHocPhan`, `TenHocPhan`, `SoTinChi`, `SoTietLyThuyet`, `SoTietThucHanh`, `HocKyGoiY`) VALUES
('CNTT100', 'Nhập môn lập trình', 3, 30, 30, 2),
('CNTT201', 'Cấu trúc dữ liệu', 3, 30, 30, 3),
('CNTT202', 'Cơ sở dữ liệu', 3, 45, 0, 3),
('CNTT203', 'Lập trình Web', 3, 30, 30, 4),
('CNTT204', 'Mạng máy tính', 3, 30, 30, 4),
('TIN101', 'Tin học đại cương', 3, 30, 30, 1),
('TOAN01', 'Toán cao cấp A1', 3, 45, 0, 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `kehoachhoctap`
--

CREATE TABLE `kehoachhoctap` (
  `ID_KeHoach` int(11) NOT NULL,
  `MSSV` varchar(20) DEFAULT NULL,
  `HocKy` varchar(10) NOT NULL,
  `NamHoc` varchar(20) NOT NULL,
  `NgayLap` datetime DEFAULT current_timestamp(),
  `TrangThai` enum('MoiTao','ChoDuyet','DaDuyet','TuChoi','YeuCauSua') DEFAULT 'MoiTao',
  `GhiChuCuaCoVan` text DEFAULT NULL,
  `LyDoTuChoi` text DEFAULT NULL,
  `GhiChu` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `kehoachhoctap`
--

INSERT INTO `kehoachhoctap` (`ID_KeHoach`, `MSSV`, `HocKy`, `NamHoc`, `NgayLap`, `TrangThai`, `GhiChuCuaCoVan`, `LyDoTuChoi`, `GhiChu`) VALUES
(4, '11001', '1', '2025-2026', '2025-12-23 20:47:40', 'DaDuyet', NULL, '', 'Đăng ký trực tuyến'),
(5, NULL, '1', '2025-2026', '2025-12-29 00:33:01', 'ChoDuyet', NULL, NULL, 'Đăng ký trực tuyến');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `ketquahoctap`
--

CREATE TABLE `ketquahoctap` (
  `ID` int(11) NOT NULL,
  `MSSV` varchar(20) DEFAULT NULL,
  `MaHocPhan` varchar(20) DEFAULT NULL,
  `DiemTongKet` float DEFAULT NULL,
  `TrangThai` enum('Dat','KhongDat','DangHoc') DEFAULT 'DangHoc'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `ketquahoctap`
--

INSERT INTO `ketquahoctap` (`ID`, `MSSV`, `MaHocPhan`, `DiemTongKet`, `TrangThai`) VALUES
(1, '11001', 'TIN101', 8.5, 'Dat'),
(2, '11001', 'TOAN01', 9, 'Dat'),
(3, '11001', 'CNTT100', 7.5, 'Dat'),
(26, '11001', 'CNTT201', 0, 'Dat'),
(27, '11001', 'CNTT202', 0, 'Dat');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `lichhoc`
--

CREATE TABLE `lichhoc` (
  `ID_Lich` int(11) NOT NULL,
  `MaHocPhan` varchar(20) DEFAULT NULL,
  `Thu` int(11) DEFAULT NULL,
  `TietBatDau` int(11) DEFAULT NULL,
  `SoTiet` int(11) DEFAULT NULL,
  `PhongHoc` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `lichhoc`
--

INSERT INTO `lichhoc` (`ID_Lich`, `MaHocPhan`, `Thu`, `TietBatDau`, `SoTiet`, `PhongHoc`) VALUES
(1, 'CNTT203', 2, 1, 3, 'B1-202'),
(2, 'CNTT204', 2, 2, 3, 'B1-203'),
(3, 'CNTT201', 3, 7, 3, 'B1-105');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `lop`
--

CREATE TABLE `lop` (
  `MaLop` varchar(20) NOT NULL,
  `TenLop` varchar(100) NOT NULL,
  `MaCoVan` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `lop`
--

INSERT INTO `lop` (`MaLop`, `TenLop`, `MaCoVan`) VALUES
('DA21TT', 'Đại học CNTT Khóa 2021', 'gv002'),
('DA21TTA', 'Đại học CNTT Khóa 21', 'gv001'),
('DA23TTA', 'Đại học CNTT Khóa 2023', NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `sinhvien`
--

CREATE TABLE `sinhvien` (
  `MSSV` varchar(20) NOT NULL,
  `HoTen` varchar(100) NOT NULL,
  `NgaySinh` date DEFAULT NULL,
  `Email` varchar(100) DEFAULT NULL,
  `SoDienThoai` varchar(15) DEFAULT NULL,
  `MaLop` varchar(20) DEFAULT NULL,
  `MaCTDT` varchar(20) DEFAULT NULL,
  `ID_TaiKhoan` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `sinhvien`
--

INSERT INTO `sinhvien` (`MSSV`, `HoTen`, `NgaySinh`, `Email`, `SoDienThoai`, `MaLop`, `MaCTDT`, `ID_TaiKhoan`) VALUES
('11001', 'Nguyễn Văn A', NULL, 'ssfhh@gmail.com', NULL, 'DA21TTA', 'CNTT_2021', 19),
('11002', 'Nguyễn Văn B', NULL, 'ssfhh@gmail.com', NULL, 'DA21TT', 'CNTT_2021', 20),
('11003', 'Nguyễn Văn C', NULL, 'ssfhh@gmail.com', NULL, 'DA21TTA', 'CNTT_2023', 19),
('11004', 'Nguyễn Văn D', NULL, 'vnf@gmail.com', NULL, 'DA21TT', 'CNTT_2021', 17),
('11005', 'Nguyễn Văn E', NULL, 'ssfhh@gmail.com', NULL, 'DA23TTA', 'CNTT_2023', 27);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `taikhoan`
--

CREATE TABLE `taikhoan` (
  `ID_TaiKhoan` int(11) NOT NULL,
  `TenDangNhap` varchar(50) NOT NULL,
  `MatKhau` varchar(255) NOT NULL,
  `Quyen` varchar(50) NOT NULL,
  `NgayTao` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `taikhoan`
--

INSERT INTO `taikhoan` (`ID_TaiKhoan`, `TenDangNhap`, `MatKhau`, `Quyen`, `NgayTao`) VALUES
(1, 'admin', '123456', 'Admin', '2025-12-20 17:01:58'),
(2, 'gv001', '123456', 'CoVanHocTap', '2025-12-20 17:01:58'),
(11, 'gv002', '123456', 'CoVanHocTap', '2025-12-20 17:01:58'),
(17, '11004', '123456', 'SinhVien', '2025-12-22 13:21:46'),
(19, '11001', '123456', 'SinhVien', '2025-12-22 14:38:37'),
(20, '11002', '123456', 'SinhVien', '2025-12-22 14:45:30'),
(27, '11005', '123456', 'SinhVien', '2025-12-22 15:00:33'),
(28, '11003', '123456', 'SinhVien', '2025-12-22 14:38:37');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `thoikhoabieu`
--

CREATE TABLE `thoikhoabieu` (
  `ID_TKB` int(11) NOT NULL,
  `MaHocPhan` varchar(20) DEFAULT NULL,
  `Thu` int(11) NOT NULL,
  `TietBatDau` int(11) NOT NULL,
  `SoTiet` int(11) NOT NULL,
  `PhongHoc` varchar(50) DEFAULT NULL,
  `GiangVien` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `thoikhoabieu`
--

INSERT INTO `thoikhoabieu` (`ID_TKB`, `MaHocPhan`, `Thu`, `TietBatDau`, `SoTiet`, `PhongHoc`, `GiangVien`) VALUES
(1, 'TOAN01', 2, 1, 3, 'B1-201', 'Nguyễn Văn A'),
(2, 'CNTT100', 3, 7, 3, 'Phòng máy 1', 'Trần Thị B'),
(3, 'CNTT201', 4, 1, 3, 'B1-305', 'Lê Văn C'),
(4, 'CNTT202', 4, 1, 3, 'B1-202', 'Phạm Văn D'),
(5, 'CNTT203', 6, 7, 3, 'Phòng máy 3', 'Nguyễn Thị E'),
(7, 'CNTT100', 2, 1, 4, 'B1_203', 'Trần Thị B'),
(8, 'CNTT204', 7, 1, 4, 'B1_203', 'Trần Thị B'),
(9, 'TIN101', 5, 6, 4, 'B11_201', 'Trần Thị C');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `chitietkehoach`
--
ALTER TABLE `chitietkehoach`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `ID_KeHoach` (`ID_KeHoach`),
  ADD KEY `MaHocPhan` (`MaHocPhan`);

--
-- Chỉ mục cho bảng `chuongtrinhdaotao`
--
ALTER TABLE `chuongtrinhdaotao`
  ADD PRIMARY KEY (`MaCTDT`);

--
-- Chỉ mục cho bảng `covanhoctap`
--
ALTER TABLE `covanhoctap`
  ADD PRIMARY KEY (`MaCoVan`),
  ADD KEY `ID_TaiKhoan` (`ID_TaiKhoan`);

--
-- Chỉ mục cho bảng `dieukientienquyet`
--
ALTER TABLE `dieukientienquyet`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `MaHocPhan` (`MaHocPhan`),
  ADD KEY `MaHocPhanTienQuyet` (`MaHocPhanTienQuyet`);

--
-- Chỉ mục cho bảng `hocphan`
--
ALTER TABLE `hocphan`
  ADD PRIMARY KEY (`MaHocPhan`);

--
-- Chỉ mục cho bảng `kehoachhoctap`
--
ALTER TABLE `kehoachhoctap`
  ADD PRIMARY KEY (`ID_KeHoach`),
  ADD KEY `MSSV` (`MSSV`);

--
-- Chỉ mục cho bảng `ketquahoctap`
--
ALTER TABLE `ketquahoctap`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `MSSV` (`MSSV`),
  ADD KEY `MaHocPhan` (`MaHocPhan`);

--
-- Chỉ mục cho bảng `lichhoc`
--
ALTER TABLE `lichhoc`
  ADD PRIMARY KEY (`ID_Lich`),
  ADD KEY `MaHocPhan` (`MaHocPhan`);

--
-- Chỉ mục cho bảng `lop`
--
ALTER TABLE `lop`
  ADD PRIMARY KEY (`MaLop`),
  ADD KEY `MaCoVan` (`MaCoVan`);

--
-- Chỉ mục cho bảng `sinhvien`
--
ALTER TABLE `sinhvien`
  ADD PRIMARY KEY (`MSSV`),
  ADD KEY `MaLop` (`MaLop`),
  ADD KEY `MaCTDT` (`MaCTDT`),
  ADD KEY `ID_TaiKhoan` (`ID_TaiKhoan`);

--
-- Chỉ mục cho bảng `taikhoan`
--
ALTER TABLE `taikhoan`
  ADD PRIMARY KEY (`ID_TaiKhoan`),
  ADD UNIQUE KEY `TenDangNhap` (`TenDangNhap`);

--
-- Chỉ mục cho bảng `thoikhoabieu`
--
ALTER TABLE `thoikhoabieu`
  ADD PRIMARY KEY (`ID_TKB`),
  ADD KEY `MaHocPhan` (`MaHocPhan`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `chitietkehoach`
--
ALTER TABLE `chitietkehoach`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT cho bảng `dieukientienquyet`
--
ALTER TABLE `dieukientienquyet`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `kehoachhoctap`
--
ALTER TABLE `kehoachhoctap`
  MODIFY `ID_KeHoach` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `ketquahoctap`
--
ALTER TABLE `ketquahoctap`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT cho bảng `lichhoc`
--
ALTER TABLE `lichhoc`
  MODIFY `ID_Lich` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `taikhoan`
--
ALTER TABLE `taikhoan`
  MODIFY `ID_TaiKhoan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT cho bảng `thoikhoabieu`
--
ALTER TABLE `thoikhoabieu`
  MODIFY `ID_TKB` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `chitietkehoach`
--
ALTER TABLE `chitietkehoach`
  ADD CONSTRAINT `chitietkehoach_ibfk_1` FOREIGN KEY (`ID_KeHoach`) REFERENCES `kehoachhoctap` (`ID_KeHoach`) ON DELETE CASCADE,
  ADD CONSTRAINT `chitietkehoach_ibfk_2` FOREIGN KEY (`MaHocPhan`) REFERENCES `hocphan` (`MaHocPhan`);

--
-- Các ràng buộc cho bảng `covanhoctap`
--
ALTER TABLE `covanhoctap`
  ADD CONSTRAINT `covanhoctap_ibfk_1` FOREIGN KEY (`ID_TaiKhoan`) REFERENCES `taikhoan` (`ID_TaiKhoan`) ON DELETE SET NULL;

--
-- Các ràng buộc cho bảng `dieukientienquyet`
--
ALTER TABLE `dieukientienquyet`
  ADD CONSTRAINT `dieukientienquyet_ibfk_1` FOREIGN KEY (`MaHocPhan`) REFERENCES `hocphan` (`MaHocPhan`),
  ADD CONSTRAINT `dieukientienquyet_ibfk_2` FOREIGN KEY (`MaHocPhanTienQuyet`) REFERENCES `hocphan` (`MaHocPhan`);

--
-- Các ràng buộc cho bảng `kehoachhoctap`
--
ALTER TABLE `kehoachhoctap`
  ADD CONSTRAINT `kehoachhoctap_ibfk_1` FOREIGN KEY (`MSSV`) REFERENCES `sinhvien` (`MSSV`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `ketquahoctap`
--
ALTER TABLE `ketquahoctap`
  ADD CONSTRAINT `ketquahoctap_ibfk_1` FOREIGN KEY (`MSSV`) REFERENCES `sinhvien` (`MSSV`),
  ADD CONSTRAINT `ketquahoctap_ibfk_2` FOREIGN KEY (`MaHocPhan`) REFERENCES `hocphan` (`MaHocPhan`);

--
-- Các ràng buộc cho bảng `lichhoc`
--
ALTER TABLE `lichhoc`
  ADD CONSTRAINT `lichhoc_ibfk_1` FOREIGN KEY (`MaHocPhan`) REFERENCES `hocphan` (`MaHocPhan`);

--
-- Các ràng buộc cho bảng `lop`
--
ALTER TABLE `lop`
  ADD CONSTRAINT `lop_ibfk_1` FOREIGN KEY (`MaCoVan`) REFERENCES `covanhoctap` (`MaCoVan`) ON DELETE SET NULL;

--
-- Các ràng buộc cho bảng `sinhvien`
--
ALTER TABLE `sinhvien`
  ADD CONSTRAINT `sinhvien_ibfk_1` FOREIGN KEY (`MaLop`) REFERENCES `lop` (`MaLop`),
  ADD CONSTRAINT `sinhvien_ibfk_2` FOREIGN KEY (`MaCTDT`) REFERENCES `chuongtrinhdaotao` (`MaCTDT`),
  ADD CONSTRAINT `sinhvien_ibfk_3` FOREIGN KEY (`ID_TaiKhoan`) REFERENCES `taikhoan` (`ID_TaiKhoan`) ON DELETE SET NULL;

--
-- Các ràng buộc cho bảng `thoikhoabieu`
--
ALTER TABLE `thoikhoabieu`
  ADD CONSTRAINT `thoikhoabieu_ibfk_1` FOREIGN KEY (`MaHocPhan`) REFERENCES `hocphan` (`MaHocPhan`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
