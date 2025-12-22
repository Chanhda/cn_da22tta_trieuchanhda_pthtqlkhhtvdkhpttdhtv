<?php
require_once __DIR__ . '/../config/Database.php';

class ClassModel {
    private $conn;

    public function __construct() {
        $db = new Database();
        $this->conn = $db->connect();
    }

    // 1. Lấy danh sách tất cả các lớp (Kèm tên Cố vấn nếu có)
    public function getAllClasses() {
        $sql = "SELECT l.*, cv.HoTen as TenCoVan 
                FROM Lop l
                LEFT JOIN CoVanHocTap cv ON l.MaCoVan = cv.MaCoVan
                ORDER BY l.MaLop ASC";
        $result = $this->conn->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    // 2. Thêm lớp mới
    public function addClass($maLop, $tenLop, $maCoVan) {
        $sql = "INSERT INTO Lop (MaLop, TenLop, MaCoVan) VALUES (?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("sss", $maLop, $tenLop, $maCoVan);
        
        try {
            return $stmt->execute();
        } catch (mysqli_sql_exception $e) {
            return false; // Trả về false nếu trùng mã lớp
        }
    }

    // 3. Xóa lớp
    public function deleteClass($maLop) {
        $sql = "DELETE FROM Lop WHERE MaLop = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $maLop);
        
        try {
            return $stmt->execute();
        } catch (mysqli_sql_exception $e) {
            return false; // Không xóa được nếu lớp đang có sinh viên
        }
    }
}
?>