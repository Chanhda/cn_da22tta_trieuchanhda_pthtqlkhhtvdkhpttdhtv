<?php
require_once __DIR__ . '/../config/Database.php';

class AdminModel {
    private $conn;

    public function __construct() {
        $db = new Database();
        $this->conn = $db->connect();
    }

    // --- 1. PHẦN QUẢN LÝ HỌC PHẦN ---

    // Lấy thông tin 1 học phần theo Mã HP (Để hiển thị vào form Sửa)
    public function getCourseById($maHocPhan) {
        // Kiểm tra xem bảng của bạn tên là HocPhan hay MonHoc nhé
        $sql = "SELECT * FROM HocPhan WHERE MaHocPhan = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $maHocPhan);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    // Cập nhật học phần (Dùng khi bấm Lưu)
    public function updateCourse($maHocPhan, $tenHocPhan, $soTinChi, $soTietLT, $soTietTH, $hocKy) {
        $sql = "UPDATE HocPhan SET TenHocPhan=?, SoTinChi=?, SoTietLyThuyet=?, SoTietThucHanh=?, MaHocKy=? WHERE MaHocPhan=?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("siiiis", $tenHocPhan, $soTinChi, $soTietLT, $soTietTH, $hocKy, $maHocPhan);
        return $stmt->execute();
    }

    // --- 2. PHẦN QUẢN LÝ SINH VIÊN ---

    // Lấy thông tin 1 sinh viên (Để hiển thị vào form Sửa)
    public function getStudentById($mssv) {
        $sql = "SELECT * FROM SinhVien WHERE MSSV = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $mssv);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    // Cập nhật sinh viên (Dùng khi bấm Lưu)
    public function updateStudent($mssv, $hoTen, $maLop, $email) {
        $sql = "UPDATE SinhVien SET HoTen=?, MaLop=?, Email=? WHERE MSSV=?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ssss", $hoTen, $maLop, $email, $mssv);
        return $stmt->execute();
    }
}
?>