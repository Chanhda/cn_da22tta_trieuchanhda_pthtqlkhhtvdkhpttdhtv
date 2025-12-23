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
    // Sửa lại hàm deleteClass chuẩn hơn
    public function deleteClass($maLop) {
        // Cắt khoảng trắng thừa (nếu có) từ URL
        $maLop = trim($maLop);

        // 1. Kiểm tra sinh viên (Code cũ của bạn)
        $checkSql = "SELECT COUNT(*) as total FROM SinhVien WHERE MaLop = ?";
        $stmtCheck = $this->conn->prepare($checkSql);
        $stmtCheck->bind_param("s", $maLop);
        $stmtCheck->execute();
        $result = $stmtCheck->get_result()->fetch_assoc();

        if ($result['total'] > 0) {
            return false; // Có sinh viên -> Không xóa
        }

        // 2. Thực hiện xóa
        $sql = "DELETE FROM Lop WHERE MaLop = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $maLop);
        
        try {
            $stmt->execute();
            // KIỂM TRA QUAN TRỌNG: Có dòng nào thực sự bị xóa không?
            if ($stmt->affected_rows > 0) {
                return true; // Xóa thành công thật
            } else {
                return false; // SQL chạy ngon nhưng không xóa được ai (do sai Mã)
            }
        } catch (mysqli_sql_exception $e) {
            return false;
        }
    }
    // 4. Lấy thông tin 1 lớp theo Mã lớp (Dùng cho chức năng Sửa)
    public function getClassById($maLop) {
        $sql = "SELECT * FROM Lop WHERE MaLop = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $maLop);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    // 5. Cập nhật thông tin lớp
    public function updateClass($maLop, $tenLop, $maCoVan) {
        $sql = "UPDATE Lop SET TenLop = ?, MaCoVan = ? WHERE MaLop = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("sss", $tenLop, $maCoVan, $maLop);
        
        try {
            return $stmt->execute();
        } catch (mysqli_sql_exception $e) {
            return false;
        }
    }
}
?>