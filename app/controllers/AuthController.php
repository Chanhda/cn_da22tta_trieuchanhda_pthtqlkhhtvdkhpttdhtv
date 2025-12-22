<?php
require_once __DIR__ . '/../models/UserModel.php';

class AuthController {

    // Hàm duy nhất: Vừa hiện form, Vừa xử lý đăng nhập
    public function login() {
        if (session_status() === PHP_SESSION_NONE) session_start();

        // Nếu đã đăng nhập thì chuyển hướng luôn
        if (isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in'] === true) {
            $this->redirectUser($_SESSION['role']);
        }

        // --- PHẦN XỬ LÝ (Khi người dùng bấm nút) ---
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $username = $_POST['username'];
            $password = $_POST['password'];

            $userModel = new UserModel();
            // Gọi Model kiểm tra
            $account = $userModel->checkLogin($username, $password);

            if ($account) {
                // Đăng nhập thành công -> Lưu Session
                $_SESSION['is_logged_in'] = true;
                $_SESSION['account_id'] = $account['ID_TaiKhoan'];
                $_SESSION['role'] = $account['Quyen']; 
                $_SESSION['user_name'] = $account['TenDangNhap'];

                // Chuyển hướng theo quyền
                if ($account['Quyen'] == 'Admin') {
                    $_SESSION['user_id'] = 'ADMIN'; 
                    header("Location: index.php?page=admin_courses");
                    exit;
                } else {
                    // Lấy thông tin chi tiết (SV/GV)
                    $details = $userModel->getUserDetails($account['ID_TaiKhoan'], $account['Quyen']);
                    if ($details) {
                        $_SESSION['user_id'] = $details['UserID'];
                        $_SESSION['user_name'] = $details['HoTen'];
                        
                        if ($account['Quyen'] == 'SinhVien') header("Location: index.php?page=dashboard");
                        elseif ($account['Quyen'] == 'CoVanHocTap') header("Location: index.php?page=advisor_dashboard");
                        exit;
                    } else {
                        echo "<script>alert('Tài khoản đúng nhưng chưa có thông tin chi tiết!'); window.history.back();</script>";
                    }
                }
            } else {
                // Đăng nhập thất bại
                $error = "Tên đăng nhập hoặc mật khẩu không đúng!";
                require_once __DIR__ . '/../../views/auth/login.php';
            }
        } 
        // --- PHẦN HIỂN THỊ (Khi mới vào trang) ---
        else {
            require_once __DIR__ . '/../../views/auth/login.php';
        }
    }

    private function redirectUser($role) {
        if ($role == 'Admin') header("Location: index.php?page=admin_courses");
        elseif ($role == 'SinhVien') header("Location: index.php?page=dashboard");
        elseif ($role == 'CoVanHocTap') header("Location: index.php?page=advisor_dashboard");
        exit;
    }

    public function logout() {
        if (session_status() === PHP_SESSION_NONE) session_start();
        session_destroy();
        header("Location: index.php?page=login");
        exit;
    }
    
    // ... (Giữ nguyên phần change_password nếu muốn)
    public function change_password() {
    // 1. Kiểm tra đăng nhập
    if (session_status() === PHP_SESSION_NONE) session_start();
    if (!isset($_SESSION['is_logged_in'])) { header("Location: index.php?page=login"); exit; }

    // 2. Xử lý khi người dùng bấm nút LƯU (POST)
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $userId = $_SESSION['account_id']; // Hoặc user_id tùy session của bạn
        $model = new UserModel(); // Đảm bảo bạn đã require UserModel ở đầu file
        
        // Lấy pass cũ trong DB để so sánh
        $currentPassInDb = $model->getCurrentPassword($userId); // Hàm này phải có trong Model

        // Validate dữ liệu
        if ($_POST['old_pass'] !== $currentPassInDb) { 
            echo "<script>alert('Mật khẩu cũ không đúng!'); window.history.back();</script>"; 
            return; 
        }
        if ($_POST['new_pass'] !== $_POST['confirm_pass']) { 
            echo "<script>alert('Mật khẩu xác nhận không khớp!'); window.history.back();</script>"; 
            return; 
        }

        // Lưu pass mới
        $model->changePassword($userId, $_POST['new_pass']);
        echo "<script>alert('Đổi mật khẩu thành công! Vui lòng đăng nhập lại.'); window.location.href='index.php?page=logout';</script>";
    
    } else {
        // 3. Hiển thị Form (GET) -> GỌI FILE VIEW ĐẸP
        // DÒNG QUAN TRỌNG NHẤT LÀ Ở ĐÂY 👇
        require_once __DIR__ . '/../../views/auth/change_password.php';
    }
}
}
?>