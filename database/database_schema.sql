-- ==================================================================================
-- PHẦN 1: KHỞI TẠO CẤU TRÚC CƠ SỞ DỮ LIỆU (SCHEMA)
-- ==================================================================================

-- 1. Xóa CSDL cũ nếu tồn tại (Để làm mới lại từ đầu)
DROP DATABASE IF EXISTS ql_kehoachhoctap;

-- 2. Tạo CSDL mới
CREATE DATABASE ql_kehoachhoctap CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE ql_kehoachhoctap;

-- 3. Bảng Tài khoản (Dùng chung cho Admin, Sinh viên, Cố vấn)
CREATE TABLE TaiKhoan (
    ID_TaiKhoan INT AUTO_INCREMENT PRIMARY KEY,
    TenDangNhap VARCHAR(50) NOT NULL UNIQUE,
    MatKhau VARCHAR(255) NOT NULL, -- Mật khẩu (MD5/Bcrypt)
    QuyenHan ENUM('Admin', 'SinhVien', 'CoVanHocTap') NOT NULL DEFAULT 'SinhVien',
    NgayTao TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- 4. Bảng Cố vấn học tập
CREATE TABLE CoVanHocTap (
    MaCoVan VARCHAR(20) PRIMARY KEY,
    HoTen VARCHAR(100) NOT NULL,
    Email VARCHAR(100),
    Khoa VARCHAR(100),
    ID_TaiKhoan INT,
    FOREIGN KEY (ID_TaiKhoan) REFERENCES TaiKhoan(ID_TaiKhoan) ON DELETE SET NULL
);

-- 5. Bảng Lớp (Một Cố vấn quản lý nhiều lớp)
CREATE TABLE Lop (
    MaLop VARCHAR(20) PRIMARY KEY,
    TenLop VARCHAR(100) NOT NULL,
    MaCoVan VARCHAR(20),
    FOREIGN KEY (MaCoVan) REFERENCES CoVanHocTap(MaCoVan) ON DELETE SET NULL
);

-- 6. Bảng Chương trình đào tạo
CREATE TABLE ChuongTrinhDaoTao (
    MaCTDT VARCHAR(20) PRIMARY KEY,
    TenChuongTrinh VARCHAR(150) NOT NULL,
    NamApDung INT,
    TongSoTinChi INT
);

-- 7. Bảng Sinh viên (Liên kết với Tài khoản, Lớp và CTĐT)
CREATE TABLE SinhVien (
    MSSV VARCHAR(20) PRIMARY KEY,
    HoTen VARCHAR(100) NOT NULL,
    NgaySinh DATE,
    Email VARCHAR(100),
    SoDienThoai VARCHAR(15),
    MaLop VARCHAR(20),
    MaCTDT VARCHAR(20),
    ID_TaiKhoan INT,
    FOREIGN KEY (MaLop) REFERENCES Lop(MaLop),
    FOREIGN KEY (MaCTDT) REFERENCES ChuongTrinhDaoTao(MaCTDT),
    FOREIGN KEY (ID_TaiKhoan) REFERENCES TaiKhoan(ID_TaiKhoan) ON DELETE SET NULL
);

-- 8. Bảng Học phần (Môn học)
CREATE TABLE HocPhan (
    MaHocPhan VARCHAR(20) PRIMARY KEY,
    TenHocPhan VARCHAR(150) NOT NULL,
    SoTinChi INT NOT NULL,
    SoTietLyThuyet INT DEFAULT 0,
    SoTietThucHanh INT DEFAULT 0,
    HocKyGoiY INT -- Học kỳ đề xuất (1, 2, 3...)
);

-- 9. Bảng Điều kiện tiên quyết (Học phần A phải học trước Học phần B)
CREATE TABLE DieuKienTienQuyet (
    ID INT AUTO_INCREMENT PRIMARY KEY,
    MaHocPhan VARCHAR(20),          -- Môn học hiện tại (ví dụ: Lập trình Web)
    MaHocPhan_TienQuyet VARCHAR(20), -- Môn phải học trước (ví dụ: Cơ sở dữ liệu)
    FOREIGN KEY (MaHocPhan) REFERENCES HocPhan(MaHocPhan),
    FOREIGN KEY (MaHocPhan_TienQuyet) REFERENCES HocPhan(MaHocPhan)
);

-- 10. Bảng Kết quả học tập (Lịch sử điểm để check điều kiện tiên quyết)
CREATE TABLE KetQuaHocTap (
    ID INT AUTO_INCREMENT PRIMARY KEY,
    MSSV VARCHAR(20),
    MaHocPhan VARCHAR(20),
    DiemTongKet FLOAT,
    TrangThai ENUM('Dat', 'KhongDat', 'DangHoc') DEFAULT 'DangHoc',
    FOREIGN KEY (MSSV) REFERENCES SinhVien(MSSV),
    FOREIGN KEY (MaHocPhan) REFERENCES HocPhan(MaHocPhan)
);

-- 11. Bảng Kế hoạch học tập (Phiếu đăng ký mỗi kỳ)
CREATE TABLE KeHoachHocTap (
    ID_KeHoach INT AUTO_INCREMENT PRIMARY KEY,
    MSSV VARCHAR(20),
    HocKy VARCHAR(10) NOT NULL, -- "1", "2", "He"
    NamHoc VARCHAR(20) NOT NULL, -- "2024-2025"
    NgayLap DATETIME DEFAULT CURRENT_TIMESTAMP,
    TrangThai ENUM('MoiTao', 'ChoDuyet', 'DaDuyet', 'TuChoi', 'YeuCauSua') DEFAULT 'MoiTao',
    GhiChuCuaCoVan TEXT, 
    FOREIGN KEY (MSSV) REFERENCES SinhVien(MSSV) ON DELETE CASCADE
);

-- 12. Bảng Chi tiết Kế hoạch (Các môn trong phiếu đăng ký)
CREATE TABLE ChiTietKeHoach (
    ID INT AUTO_INCREMENT PRIMARY KEY,
    ID_KeHoach INT,
    MaHocPhan VARCHAR(20),
    FOREIGN KEY (ID_KeHoach) REFERENCES KeHoachHocTap(ID_KeHoach) ON DELETE CASCADE,
    FOREIGN KEY (MaHocPhan) REFERENCES HocPhan(MaHocPhan)
);

-- 13. Bảng Lịch học (Để check trùng lịch)
CREATE TABLE LichHoc (
    ID_Lich INT AUTO_INCREMENT PRIMARY KEY,
    MaHocPhan VARCHAR(20),
    Thu INT, -- 2, 3, 4, 5, 6, 7, 8
    TietBatDau INT,
    SoTiet INT,
    PhongHoc VARCHAR(50),
    FOREIGN KEY (MaHocPhan) REFERENCES HocPhan(MaHocPhan)
);


-- ==================================================================================
-- PHẦN 2: THÊM DỮ LIỆU MẪU (SEED DATA)
-- ==================================================================================

-- 1. Tài khoản (Pass demo MD5 của '123456' là e10adc3949ba59abbe56e057f20f883e)
INSERT INTO TaiKhoan (ID_TaiKhoan, TenDangNhap, MatKhau, QuyenHan) VALUES 
(1, 'admin', 'e10adc3949ba59abbe56e057f20f883e', 'Admin'),
(2, 'gv001', 'e10adc3949ba59abbe56e057f20f883e', 'CoVanHocTap'),
(3, '11001', 'e10adc3949ba59abbe56e057f20f883e', 'SinhVien'),
(4, '11002', 'e10adc3949ba59abbe56e057f20f883e', 'SinhVien');

-- 2. Cố vấn học tập
INSERT INTO CoVanHocTap (MaCoVan, HoTen, Email, Khoa, ID_TaiKhoan) VALUES 
('GV001', 'Nguyễn Văn Thầy', 'thaygv@tvu.edu.vn', 'Khoa Kỹ thuật Công nghệ', 2);

-- 3. Lớp
INSERT INTO Lop (MaLop, TenLop, MaCoVan) VALUES 
('DA21TT', 'Đại học CNTT Khóa 2021', 'GV001');

-- 4. Chương trình đào tạo
INSERT INTO ChuongTrinhDaoTao (MaCTDT, TenChuongTrinh, NamApDung, TongSoTinChi) VALUES 
('CNTT_2021', 'Kỹ sư Công nghệ thông tin', 2021, 150);

-- 5. Sinh viên
INSERT INTO SinhVien (MSSV, HoTen, NgaySinh, Email, SoDienThoai, MaLop, MaCTDT, ID_TaiKhoan) VALUES 
('11001', 'Trần Văn Sinh', '2003-01-01', 'sv1@tvu.edu.vn', '0901234567', 'DA21TT', 'CNTT_2021', 3),
('11002', 'Lê Thị Học', '2003-05-20', 'sv2@tvu.edu.vn', '0909876543', 'DA21TT', 'CNTT_2021', 4);

-- 6. Học phần
INSERT INTO HocPhan (MaHocPhan, TenHocPhan, SoTinChi, SoTietLyThuyet, SoTietThucHanh, HocKyGoiY) VALUES 
('TIN101', 'Tin học đại cương', 3, 30, 30, 1),
('TOAN01', 'Toán cao cấp A1', 3, 45, 0, 1),
('CNTT100', 'Nhập môn lập trình', 3, 30, 30, 2),
('CNTT201', 'Cấu trúc dữ liệu', 3, 30, 30, 3),
('CNTT202', 'Cơ sở dữ liệu', 3, 45, 0, 3),
('CNTT203', 'Lập trình Web', 3, 30, 30, 4),
('CNTT204', 'Mạng máy tính', 3, 30, 30, 4);

-- 7. Điều kiện tiên quyết
-- Phải học Nhập môn lập trình trước Cấu trúc dữ liệu
INSERT INTO DieuKienTienQuyet (MaHocPhan, MaHocPhan_TienQuyet) VALUES 
('CNTT201', 'CNTT100'), 
('CNTT203', 'CNTT202'); -- Web cần CSDL

-- 8. Kết quả học tập (Lịch sử)
-- SV 11001 đã đậu Nhập môn lập trình và CSDL -> Đủ điều kiện học Web và CTDL
INSERT INTO KetQuaHocTap (MSSV, MaHocPhan, DiemTongKet, TrangThai) VALUES 
('11001', 'CNTT100', 8.5, 'Dat'), 
('11001', 'CNTT202', 7.0, 'Dat'),
('11001', 'TIN101', 3.5, 'KhongDat'); -- Rớt môn Tin

-- 9. Lịch học (Để test trùng lịch)
INSERT INTO LichHoc (MaHocPhan, Thu, TietBatDau, SoTiet, PhongHoc) VALUES 
('CNTT203', 2, 1, 3, 'B1-202'), -- Thứ 2, Tiết 1-3
('CNTT204', 2, 2, 3, 'B1-203'), -- Thứ 2, Tiết 2-4 (TRÙNG LỊCH với môn trên)
('CNTT201', 3, 7, 3, 'B1-105'); -- Thứ 3, Chiều

-- 10. Kế hoạch học tập mẫu
INSERT INTO KeHoachHocTap (ID_KeHoach, MSSV, HocKy, NamHoc, NgayLap, TrangThai, GhiChuCuaCoVan) VALUES 
(1, '11001', '1', '2025-2026', NOW(), 'ChoDuyet', NULL);

-- Chi tiết kế hoạch mẫu
INSERT INTO ChiTietKeHoach (ID_KeHoach, MaHocPhan) VALUES 
(1, 'CNTT203'), 
(1, 'CNTT201');