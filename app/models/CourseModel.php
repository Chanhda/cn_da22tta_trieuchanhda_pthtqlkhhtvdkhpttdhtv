<?php
require_once __DIR__ . '/../config/Database.php';

class CourseModel {
    private $conn;

    public function __construct() {
        $db = new Database();
        $this->conn = $db->connect();
    }

    // ==========================================================
    // PHẦN 1: QUẢN TRỊ VIÊN (ADMIN) - CRUD CƠ BẢN
    // ==========================================================

    // 1. Lấy danh sách tất cả môn học (Cho Admin hiển thị bảng)
    public function getAllCourses() {
        $sql = "SELECT * FROM HocPhan ORDER BY MaHocPhan ASC";
        $result = $this->conn->query($sql);
        if (!$result) return [];
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    // 2. Lấy thông tin chi tiết 1 môn học (Để Sửa, hoặc xem chi tiết)
    public function getCourseById($id) {
        $sql = "SELECT * FROM HocPhan WHERE MaHocPhan = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    // 3. Thêm môn học mới
    public function addCourse($ma, $ten, $tinchi, $lt, $th, $hocky) {
        // Kiểm tra trùng mã trước
        $check = "SELECT MaHocPhan FROM HocPhan WHERE MaHocPhan = ?";
        $stmtCheck = $this->conn->prepare($check);
        $stmtCheck->bind_param("s", $ma);
        $stmtCheck->execute();
        if ($stmtCheck->get_result()->num_rows > 0) {
            return false; // Đã tồn tại
        }

        $sql = "INSERT INTO HocPhan (MaHocPhan, TenHocPhan, SoTinChi, SoTietLyThuyet, SoTietThucHanh, HocKyGoiY) 
                VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ssiiii", $ma, $ten, $tinchi, $lt, $th, $hocky);
        return $stmt->execute();
    }

    // 4. Cập nhật môn học
    public function updateCourse($ma, $ten, $tinchi, $lt, $th, $hocky) {
        $sql = "UPDATE HocPhan SET TenHocPhan=?, SoTinChi=?, SoTietLyThuyet=?, SoTietThucHanh=?, HocKyGoiY=? 
                WHERE MaHocPhan=?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("siiiis", $ten, $tinchi, $lt, $th, $hocky, $ma);
        return $stmt->execute();
    }

    // 5. Xóa môn học
    public function deleteCourse($id) {
        $sql = "DELETE FROM HocPhan WHERE MaHocPhan = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $id);
        try {
            return $stmt->execute();
        } catch (mysqli_sql_exception $e) {
            return false; // Lỗi ràng buộc khóa ngoại (đang có sinh viên học)
        }
    }

    // ==========================================================
    // PHẦN 2: QUẢN TRỊ VIÊN (ADMIN) - LỊCH HỌC & TIÊN QUYẾT
    // ==========================================================

    // 6. Lấy lịch học của 1 môn
    public function getSchedule($maHP) {
        $sql = "SELECT * FROM ThoiKhoaBieu WHERE MaHocPhan = ? ORDER BY Thu ASC, TietBatDau ASC";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $maHP);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    // 7. Thêm lịch học
    public function addSchedule($maHP, $thu, $tiet, $soTiet, $phong, $gv) {
        $sql = "INSERT INTO ThoiKhoaBieu (MaHocPhan, Thu, TietBatDau, SoTiet, PhongHoc, GiangVien) 
                VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("siiiss", $maHP, $thu, $tiet, $soTiet, $phong, $gv);
        return $stmt->execute();
    }

    // 8. Xóa lịch học
    public function deleteSchedule($idTKB) {
        $sql = "DELETE FROM ThoiKhoaBieu WHERE ID_TKB = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $idTKB);
        return $stmt->execute();
    }

    // 9. Lấy danh sách môn tiên quyết
    public function getPrerequisites($maHP) {
        $sql = "SELECT dk.*, hp.TenHocPhan as TenHocPhanTQ 
                FROM DieuKienTienQuyet dk 
                JOIN HocPhan hp ON dk.MaHocPhanTienQuyet = hp.MaHocPhan
                WHERE dk.MaHocPhan = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $maHP);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    // 10. Thêm điều kiện tiên quyết
    public function addPrerequisite($maHP, $maHPTQ) {
        // Kiểm tra tồn tại chưa
        $check = "SELECT ID FROM DieuKienTienQuyet WHERE MaHocPhan = ? AND MaHocPhanTienQuyet = ?";
        $stmtCheck = $this->conn->prepare($check);
        $stmtCheck->bind_param("ss", $maHP, $maHPTQ);
        $stmtCheck->execute();
        if ($stmtCheck->get_result()->num_rows > 0) return false;

        $sql = "INSERT INTO DieuKienTienQuyet (MaHocPhan, MaHocPhanTienQuyet) VALUES (?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ss", $maHP, $maHPTQ);
        return $stmt->execute();
    }

    // 11. Xóa điều kiện tiên quyết
    public function deletePrerequisite($id) {
        $sql = "DELETE FROM DieuKienTienQuyet WHERE ID = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }

    // ==========================================================
    // PHẦN 3: SINH VIÊN - LẬP KẾ HOẠCH (LOGIC PHỨC TẠP)
    // ==========================================================

    // 12. Lấy danh sách môn học ĐẦY ĐỦ (Kèm Lịch & Tiên quyết) để Sinh viên đăng ký
    public function getAllCoursesWithDetails() {
        $sql = "SELECT hp.*, 
                       tkb.Thu, tkb.TietBatDau, tkb.SoTiet, tkb.PhongHoc,
                       dk.MaHocPhanTienQuyet
                FROM HocPhan hp
                LEFT JOIN ThoiKhoaBieu tkb ON hp.MaHocPhan = tkb.MaHocPhan
                LEFT JOIN DieuKienTienQuyet dk ON hp.MaHocPhan = dk.MaHocPhan
                ORDER BY hp.HocKyGoiY ASC";
        
        $result = $this->conn->query($sql);
        $courses = [];
        
        // Xử lý gom nhóm dữ liệu (Vì 1 môn có thể có nhiều dòng do Join bảng)
        while ($row = $result->fetch_assoc()) {
            $maHP = $row['MaHocPhan'];
            if (!isset($courses[$maHP])) {
                $courses[$maHP] = [
                    'MaHocPhan' => $row['MaHocPhan'],
                    'TenHocPhan' => $row['TenHocPhan'],
                    'SoTinChi' => $row['SoTinChi'],
                    'HocKyGoiY' => $row['HocKyGoiY'],
                    // Format text hiển thị
                    'LichHoc' => ($row['Thu']) ? "Thứ {$row['Thu']} (Tiết {$row['TietBatDau']}-" . ($row['TietBatDau'] + $row['SoTiet'] - 1) . ")" : "Chưa có lịch",
                    // Dữ liệu thô để check trùng
                    'RawLich' => [
                        'Thu' => $row['Thu'], 
                        'Start' => (int)$row['TietBatDau'], 
                        'End' => (int)$row['TietBatDau'] + (int)$row['SoTiet'] - 1
                    ],
                    'TienQuyet' => []
                ];
            }
            // Gom các môn tiên quyết vào mảng
            if ($row['MaHocPhanTienQuyet']) {
                // Tránh duplicate nếu dòng bị lặp do join lịch học
                if (!in_array($row['MaHocPhanTienQuyet'], $courses[$maHP]['TienQuyet'])) {
                    $courses[$maHP]['TienQuyet'][] = $row['MaHocPhanTienQuyet'];
                }
            }
        }
        return $courses;
    }
}
?>