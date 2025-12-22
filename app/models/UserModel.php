<?php
require_once __DIR__ . '/../config/Database.php';

class UserModel {
    private $conn;

    public function __construct() {
        $db = new Database();
        $this->conn = $db->connect();
    }

    // 1. Kiểm tra đăng nhập
    public function checkLogin($username, $password) {
        // LƯU Ý QUAN TRỌNG: 
        // Tạm thời bỏ MD5 để khớp với dữ liệu mẫu '123456' trong database.
        // Nếu muốn bảo mật, sau này cần update database thành mã hash và bật lại dòng md5.
        
        // $hashedPass = md5($password); // Tạm tắt
        $storedPass = $password;      // Dùng pass thường để so sánh

        $sql = "SELECT * FROM TaiKhoan WHERE TenDangNhap = ? AND MatKhau = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ss", $username, $storedPass);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            return $result->fetch_assoc();
        } else {
            return false;
        }
    }

    // 2. Lấy thông tin chi tiết (MSSV/MaCoVan) dựa trên ID Tài khoản
    public function getUserDetails($idTaiKhoan, $quyen) {
        $sql = "";
        if ($quyen == 'SinhVien') {
            $sql = "SELECT MSSV as UserID, HoTen FROM SinhVien WHERE ID_TaiKhoan = ?";
        } elseif ($quyen == 'CoVanHocTap') {
            $sql = "SELECT MaCoVan as UserID, HoTen FROM CoVanHocTap WHERE ID_TaiKhoan = ?";
        } else {
            return null; // Admin không có bảng chi tiết riêng, hoặc xử lý sau
        }

        if ($sql) {
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("i", $idTaiKhoan);
            $stmt->execute();
            return $stmt->get_result()->fetch_assoc();
        }
        return null;
    }

    // 3. Tạo tài khoản mới
    public function createAccount($username, $password, $quyen) {
        // Tương tự, tạm tắt MD5 khi tạo mới để đồng bộ hệ thống
        // $hashedPass = md5($password); 
        $storedPass = $password;

        // Sửa 'QuyenHan' thành 'Quyen' cho đúng tên cột trong Database
        $sql = "INSERT INTO TaiKhoan (TenDangNhap, MatKhau, Quyen) VALUES (?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("sss", $username, $storedPass, $quyen);
        
        try {
            if ($stmt->execute()) {
                return $this->conn->insert_id;
            }
        } catch (Exception $e) {
            return false; // Trùng tên đăng nhập
        }
        return false;
    }
    
    // 4. Xóa tài khoản
    public function deleteAccount($idTaiKhoan) {
        $sql = "DELETE FROM TaiKhoan WHERE ID_TaiKhoan = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $idTaiKhoan);
        return $stmt->execute();
    }

    // 5. Kiểm tra mật khẩu cũ
    public function getCurrentPassword($userId) {
        $sql = "SELECT MatKhau FROM TaiKhoan WHERE ID_TaiKhoan = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc();
        return $result ? $result['MatKhau'] : null;
    }

    // 6. Đổi mật khẩu
    public function changePassword($userId, $newPassword) {
        // Chưa bật MD5 vội, giữ plain text cho đồng bộ
        $sql = "UPDATE TaiKhoan SET MatKhau = ? WHERE ID_TaiKhoan = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("si", $newPassword, $userId);
        return $stmt->execute();
    }
}
?>