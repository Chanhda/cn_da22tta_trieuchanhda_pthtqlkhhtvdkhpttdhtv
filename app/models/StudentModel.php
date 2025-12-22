<?php
require_once __DIR__ . '/../config/Database.php';

class StudentModel {
    private $conn;

    public function __construct() {
        $db = new Database();
        $this->conn = $db->connect();
    }

    // ==========================================
    // PHẦN 1: DÀNH CHO SINH VIÊN
    // ==========================================

    // 1. Lấy thông tin sinh viên
    public function getStudentInfo($mssv) {
        $sql = "SELECT * FROM SinhVien WHERE MSSV = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $mssv);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    // 2. Lấy các môn đã đậu (để kiểm tra tiên quyết)
    public function getPassedCourses($mssv) {
        $sql = "SELECT MaHocPhan FROM KetQuaHocTap WHERE MSSV = ? AND TrangThai = 'Dat'";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $mssv);
        $stmt->execute();
        $result = $stmt->get_result();
        
        $passed = [];
        while ($row = $result->fetch_assoc()) {
            $passed[] = $row['MaHocPhan'];
        }
        return $passed;
    }

    // 3. Lấy kế hoạch mới nhất
    public function getLatestPlan($mssv) {
        $sql = "SELECT * FROM KeHoachHocTap WHERE MSSV = ? ORDER BY NgayLap DESC LIMIT 1";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $mssv);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    // 4. Tính toán tiến độ học tập
    public function getStudyProgress($mssv, $maCTDT) {
        // Lấy tổng tín chỉ yêu cầu
        $sqlTotal = "SELECT TongSoTinChi FROM ChuongTrinhDaoTao WHERE MaCTDT = ?";
        $stmtTotal = $this->conn->prepare($sqlTotal);
        $stmtTotal->bind_param("s", $maCTDT);
        $stmtTotal->execute();
        $resTotal = $stmtTotal->get_result()->fetch_assoc();
        $total = $resTotal['TongSoTinChi'] ?? 150;

        // Lấy số tín chỉ đã tích lũy
        $sqlDone = "SELECT SUM(hp.SoTinChi) as accumulated 
                    FROM KetQuaHocTap kq 
                    JOIN HocPhan hp ON kq.MaHocPhan = hp.MaHocPhan 
                    WHERE kq.MSSV = ? AND kq.TrangThai = 'Dat'";
        $stmtDone = $this->conn->prepare($sqlDone);
        $stmtDone->bind_param("s", $mssv);
        $stmtDone->execute();
        $resDone = $stmtDone->get_result()->fetch_assoc();
        $accumulated = $resDone['accumulated'] ?? 0;

        return [
            'total' => $total,
            'accumulated' => $accumulated,
            'remaining' => max(0, $total - $accumulated)
        ];
    }

    // 5. Lấy chi tiết kế hoạch
    public function getPlanDetails($idKeHoach) {
        $sql = "SELECT ct.*, hp.TenHocPhan, hp.SoTinChi, hp.SoTietLyThuyet, hp.SoTietThucHanh 
                FROM ChiTietKeHoach ct
                JOIN HocPhan hp ON ct.MaHocPhan = hp.MaHocPhan
                WHERE ct.ID_KeHoach = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $idKeHoach);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    // 6. Lấy Thời khóa biểu (ĐÃ SỬA: BỎ JOIN GIẢNG VIÊN ĐỂ TRÁNH LỖI)
    public function getStudentSchedule($mssv) {
        $sql = "SELECT tkb.*, hp.TenHocPhan
                FROM KeHoachHocTap kh
                JOIN ChiTietKeHoach ct ON kh.ID_KeHoach = ct.ID_KeHoach
                JOIN ThoiKhoaBieu tkb ON ct.MaHocPhan = tkb.MaHocPhan
                JOIN HocPhan hp ON tkb.MaHocPhan = hp.MaHocPhan
                WHERE kh.MSSV = ? 
                AND kh.TrangThai = 'DaDuyet'
                ORDER BY tkb.Thu ASC, tkb.TietBatDau ASC";
        
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $mssv);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    // ==========================================
    // PHẦN 2: DÀNH CHO ADMIN (CRUD Sinh viên)
    // ==========================================

    // 7. Lấy danh sách tất cả sinh viên
    public function getAllStudents() {
        $sql = "SELECT sv.*, tk.TenDangNhap 
                FROM SinhVien sv
                LEFT JOIN TaiKhoan tk ON sv.ID_TaiKhoan = tk.ID_TaiKhoan
                ORDER BY sv.MSSV ASC";
        $result = $this->conn->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    // 8. Thêm sinh viên mới
    public function addStudent($mssv, $hoTen, $maLop, $email, $maCTDT, $idTaiKhoan) {
        $sql = "INSERT INTO SinhVien (MSSV, HoTen, MaLop, Email, ChuongTrinhDaoTao, ID_TaiKhoan) 
                VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("sssssi", $mssv, $hoTen, $maLop, $email, $maCTDT, $idTaiKhoan);
        try { return $stmt->execute(); } catch (Exception $e) { return false; }
    }

    // 9. Cập nhật thông tin sinh viên
    public function updateStudent($mssv, $hoTen, $maLop, $email, $maCTDT) {
        $sql = "UPDATE SinhVien SET HoTen=?, MaLop=?, Email=?, ChuongTrinhDaoTao=? WHERE MSSV=?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("sssss", $hoTen, $maLop, $email, $maCTDT, $mssv);
        return $stmt->execute();
    }

    // 10. Xóa sinh viên
    public function deleteStudent($mssv) {
        $sql = "DELETE FROM SinhVien WHERE MSSV = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $mssv);
        try { return $stmt->execute(); } catch (Exception $e) { return false; }
    }
}
?>