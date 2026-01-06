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
        // Dùng TRIM để xử lý lỗi khoảng trắng (nếu có)
        $sql = "SELECT kh.*, sv.HoTen, sv.MaLop 
                FROM KeHoachHocTap kh
                JOIN SinhVien sv ON TRIM(kh.MSSV) = TRIM(sv.MSSV)
                JOIN Lop l ON TRIM(sv.MaLop) = TRIM(l.MaLop)
                WHERE TRIM(l.MaCoVan) = ? 
                AND kh.TrangThai = 'ChoDuyet'
                ORDER BY kh.NgayLap ASC";
        
        $stmt = $this->conn->prepare($sql);
        
        // Cắt khoảng trắng cho mã cố vấn đầu vào luôn
        $maCoVan = trim($maCoVan);
        
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
    // [ADMIN] 7. Lấy thông tin chi tiết 1 cố vấn theo ID (Sửa lỗi getAdvisorById)
    public function getAdvisorById($maCoVan) {
        $sql = "SELECT * FROM CoVanHocTap WHERE MaCoVan = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $maCoVan);
        $stmt->execute();
        $result = $stmt->get_result();
        // Trả về 1 dòng kết quả (mảng kết hợp)
        return $result->fetch_assoc();
    }

    // [ADMIN] 8. Cập nhật thông tin cố vấn (Thêm cái này để không bị lỗi tiếp theo)
    public function updateAdvisor($maCoVan, $hoTen, $maKhoa, $email, $sdt) {
        $sql = "UPDATE CoVanHocTap SET HoTen = ?, MaKhoa = ?, Email = ?, SoDienThoai = ? WHERE MaCoVan = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("sssss", $hoTen, $maKhoa, $email, $sdt, $maCoVan);
        
        try {
            return $stmt->execute();
        } catch (mysqli_sql_exception $e) {
            return false;
        }
    }
    // Thêm vào AdvisorModel.php

// 1. Lấy danh sách môn học và trạng thái hiện tại của SV
public function getStudentGrades($mssv) {
    // Kết nối bảng Môn học với bảng Kết quả để xem môn nào đã Đạt
    $sql = "SELECT hp.MaHocPhan, hp.TenHocPhan, hp.SoTinChi, 
                   kq.TrangThai, kq.DiemTongKet
            FROM HocPhan hp
            LEFT JOIN KetQuaHocTap kq ON hp.MaHocPhan = kq.MaHocPhan AND kq.MSSV = ?
            ORDER BY hp.HocKyGoiY ASC"; // Sắp xếp theo học kỳ cho dễ nhìn
            
    $stmt = $this->conn->prepare($sql);
    $stmt->bind_param("s", $mssv);
    $stmt->execute();
    return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
}

// 2. Cố vấn click xác nhận Đạt/Không Đạt
public function updateCourseStatus($mssv, $maHP, $status) {
    // Kiểm tra xem đã có dòng này trong bảng điểm chưa
    $check = $this->conn->prepare("SELECT ID FROM KetQuaHocTap WHERE MSSV = ? AND MaHocPhan = ?");
    $check->bind_param("ss", $mssv, $maHP);
    $check->execute();
    $result = $check->get_result();

    if ($result->num_rows > 0) {
        // Nếu có rồi -> Cập nhật trạng thái
        $sql = "UPDATE KetQuaHocTap SET TrangThai = ? WHERE MSSV = ? AND MaHocPhan = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("sss", $status, $mssv, $maHP);
    } else {
        // Nếu chưa có -> Thêm mới (Điểm để null hoặc 0)
        $sql = "INSERT INTO KetQuaHocTap (MSSV, MaHocPhan, TrangThai, DiemTongKet) VALUES (?, ?, ?, 0)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("sss", $mssv, $maHP, $status);
    }
    return $stmt->execute();
}

}
?>