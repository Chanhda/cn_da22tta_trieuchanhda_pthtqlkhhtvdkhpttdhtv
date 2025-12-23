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

    // 5. Xóa môn học (Phiên bản nâng cấp: Dọn dẹp dữ liệu con trước)
    public function deleteCourse($id) {
        $id = trim($id);
        
        // 1. Xóa Lịch học (Bảng lichhoc và thoikhoabieu)
        $this->conn->query("DELETE FROM LichHoc WHERE MaHocPhan = '$id'");
        $this->conn->query("DELETE FROM ThoiKhoaBieu WHERE MaHocPhan = '$id'");

        // 2. Xóa Điều kiện tiên quyết
        $this->conn->query("DELETE FROM DieuKienTienQuyet WHERE MaHocPhan = '$id' OR MaHocPhanTienQuyet = '$id'");

        // 3. Xóa Chi tiết kế hoạch (Dự định học của SV)
        $this->conn->query("DELETE FROM ChiTietKeHoach WHERE MaHocPhan = '$id'");

        // 4. Kiểm tra xem có Điểm chưa (Bảng KetQuaHocTap)
        // Nếu có điểm rồi thì TUYỆT ĐỐI KHÔNG XÓA để bảo toàn lịch sử học tập
        $checkDiem = $this->conn->query("SELECT COUNT(*) as c FROM KetQuaHocTap WHERE MaHocPhan = '$id'");
        if ($checkDiem->fetch_assoc()['c'] > 0) {
            return false; // Có điểm rồi, chặn lại ngay
        }

        // 5. Xóa Môn học
        $sql = "DELETE FROM HocPhan WHERE MaHocPhan = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $id);
        
        try {
            $stmt->execute();
            return $stmt->affected_rows > 0;
        } catch (mysqli_sql_exception $e) {
            return false;
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

    // 12. Lấy danh sách môn học ĐẦY ĐỦ (Đã sửa lỗi hiển thị nhiều lịch học)
   public function getAllCoursesWithDetails() {
        $sql = "SELECT hp.*, 
                       tkb.ID_TKB, tkb.Thu, tkb.TietBatDau, tkb.SoTiet, tkb.PhongHoc,
                       dk.MaHocPhanTienQuyet
                FROM HocPhan hp
                -- Dùng TRIM để chắc chắn khớp mã
                LEFT JOIN ThoiKhoaBieu tkb ON TRIM(hp.MaHocPhan) = TRIM(tkb.MaHocPhan)
                LEFT JOIN DieuKienTienQuyet dk ON hp.MaHocPhan = dk.MaHocPhan
                ORDER BY hp.HocKyGoiY ASC, hp.MaHocPhan ASC";
        
        $result = $this->conn->query($sql);
        $courses = [];
        
        while ($row = $result->fetch_assoc()) {
            $maHP = $row['MaHocPhan'];

            if (!isset($courses[$maHP])) {
                $courses[$maHP] = [
                    'MaHocPhan' => $row['MaHocPhan'],
                    'TenHocPhan' => $row['TenHocPhan'],
                    'SoTinChi' => $row['SoTinChi'],
                    'HocKyGoiY' => $row['HocKyGoiY'],
                    'LichHoc' => [],
                    // [QUAN TRỌNG] Bổ sung dòng này để View nhận diện được lịch
                    'RawLich' => ['Thu' => 0, 'Start' => 0, 'End' => 0],
                    'TienQuyet' => []
                ];
            }

            // Xử lý Lịch học
            if ($row['ID_TKB']) {
                $thuHienThi = ($row['Thu'] == 8) ? "CN" : "T{$row['Thu']}";
                $lichText = "{$thuHienThi} (Tiết {$row['TietBatDau']}-" . ($row['TietBatDau'] + $row['SoTiet'] - 1) . ") P.{$row['PhongHoc']}";
                
                if (!in_array($lichText, $courses[$maHP]['LichHoc'])) {
                    $courses[$maHP]['LichHoc'][] = $lichText;
                }

                // [QUAN TRỌNG] Nạp dữ liệu cho RawLich
                if ($courses[$maHP]['RawLich']['Thu'] == 0) {
                    $courses[$maHP]['RawLich'] = [
                        'Thu' => (int)$row['Thu'], 
                        'Start' => (int)$row['TietBatDau'], 
                        'End' => (int)$row['TietBatDau'] + (int)$row['SoTiet'] - 1
                    ];
                }
            }

            // Xử lý Tiên quyết
            if ($row['MaHocPhanTienQuyet']) {
                if (!in_array($row['MaHocPhanTienQuyet'], $courses[$maHP]['TienQuyet'])) {
                    $courses[$maHP]['TienQuyet'][] = $row['MaHocPhanTienQuyet'];
                }
            }
        }

        // Format lại lần cuối
        foreach ($courses as $key => $course) {
            if (empty($course['LichHoc'])) {
                $courses[$key]['LichHoc'] = null;
            } else {
                $courses[$key]['LichHoc'] = implode("<br>", $course['LichHoc']);
            }
        }

        return $courses;
    }
}
?>