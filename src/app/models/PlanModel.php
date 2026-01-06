<?php
require_once __DIR__ . '/../config/Database.php';

class PlanModel {
    private $conn;

    public function __construct() {
        $db = new Database();
        $this->conn = $db->connect();
    }

    // 1. Tạo phiếu kế hoạch mới (Trả về ID của phiếu vừa tạo)
    public function createPlan($mssv, $hocKy, $namHoc) {
        $sql = "INSERT INTO KeHoachHocTap (MSSV, HocKy, NamHoc, TrangThai) VALUES (?, ?, ?, 'MoiTao')";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("sss", $mssv, $hocKy, $namHoc);
        
        if ($stmt->execute()) {
            return $this->conn->insert_id; // Lấy ID tự tăng vừa tạo
        }
        return false;
    }

    // 2. Thêm chi tiết môn học vào phiếu
    public function addPlanDetail($idKeHoach, $maHocPhan) {
        $sql = "INSERT INTO ChiTietKeHoach (ID_KeHoach, MaHocPhan) VALUES (?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("is", $idKeHoach, $maHocPhan);
        return $stmt->execute();
    }
}
?>