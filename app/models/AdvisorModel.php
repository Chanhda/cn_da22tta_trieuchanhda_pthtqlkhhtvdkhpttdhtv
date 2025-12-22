<?php
require_once __DIR__ . '/../config/Database.php';

class AdvisorModel {
    private $conn;

    public function __construct() {
        $db = new Database();
        $this->conn = $db->connect();
    }

    // --- PHẦN DÀNH CHO GIẢNG VIÊN (CỐ VẤN) ---

    // 1. Lấy danh sách kế hoạch đang CHỜ DUYỆT
    public function getPendingPlans($maCoVan) {
        $sql = "SELECT kh.*, sv.HoTen, sv.MaLop 
                FROM KeHoachHocTap kh
                JOIN SinhVien sv ON kh.MSSV = sv.MSSV
                JOIN Lop l ON sv.MaLop = l.MaLop
                WHERE l.MaCoVan = ? AND kh.TrangThai = 'ChoDuyet'
                ORDER BY kh.NgayLap ASC";
        
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $maCoVan);
        $stmt->execute();
        
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    // 2. Lấy chi tiết kế hoạch
    public function getPlanDetails($idKeHoach) {
        $sql = "SELECT ct.*, hp.TenHocPhan, hp.SoTinChi 
                FROM ChiTietKeHoach ct
                JOIN HocPhan hp ON ct.MaHocPhan = hp.MaHocPhan
                WHERE ct.ID_KeHoach = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $idKeHoach);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    // 3. Cập nhật trạng thái (Duyệt/Từ chối)
    public function updateStatus($idKeHoach, $trangThai, $lyDo = '') {
        $sql = "UPDATE KeHoachHocTap SET TrangThai = ?, LyDoTuChoi = ? WHERE ID_KeHoach = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ssi", $trangThai, $lyDo, $idKeHoach);
        return $stmt->execute();
    }

    // --- PHẦN DÀNH CHO ADMIN (ĐÃ SỬA LỖI) ---

    // [ADMIN] 4. Lấy danh sách tất cả Cố vấn (SỬA LỖI: Bỏ JOIN bảng Khoa)
    public function getAllAdvisors() {
        // Chỉ lấy dữ liệu từ bảng CoVanHocTap và TaiKhoan
        $sql = "SELECT cv.*, tk.TenDangNhap 
                FROM CoVanHocTap cv
                JOIN TaiKhoan tk ON cv.ID_TaiKhoan = tk.ID_TaiKhoan
                ORDER BY cv.MaCoVan ASC";
        $result = $this->conn->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    // [ADMIN] 5. Thêm mới Cố vấn
    public function addAdvisor($maCoVan, $hoTen, $maKhoa, $email, $sdt, $idTaiKhoan) {
        $sql = "INSERT INTO CoVanHocTap (MaCoVan, HoTen, MaKhoa, Email, SoDienThoai, ID_TaiKhoan) 
                VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("sssssi", $maCoVan, $hoTen, $maKhoa, $email, $sdt, $idTaiKhoan);
        
        try {
            return $stmt->execute();
        } catch (mysqli_sql_exception $e) {
            return false;
        }
    }

    // [ADMIN] 6. Xóa Cố vấn
    public function deleteAdvisor($maCoVan) {
        $sql = "DELETE FROM CoVanHocTap WHERE MaCoVan = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $maCoVan);
        
        try {
            return $stmt->execute();
        } catch (mysqli_sql_exception $e) {
            return false;
        }
    }
}
?>