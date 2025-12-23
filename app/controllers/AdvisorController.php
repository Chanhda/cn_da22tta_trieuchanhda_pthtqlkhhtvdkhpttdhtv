<?php
// Nạp các Model cần thiết
require_once __DIR__ . '/../models/AdvisorModel.php';
require_once __DIR__ . '/../models/StudentModel.php';
// require_once __DIR__ . '/../core/Database.php'; // Mở comment nếu cần dùng Database trực tiếp

class AdvisorController {

    // --- 1. HÀM KIỂM TRA QUYỀN (Sửa tên thành checkAuth cho thống nhất) ---
    private function checkAuth() {
        if (session_status() === PHP_SESSION_NONE) session_start();
        // Kiểm tra đăng nhập và đúng quyền Cố vấn
        if (!isset($_SESSION['is_logged_in']) || $_SESSION['role'] !== 'CoVanHocTap') {
            header("Location: index.php?page=login");
            exit;
        }
    }

    // --- 2. TRANG CHỦ (DASHBOARD) ---
    public function dashboard() {
        $this->checkAuth();
        $maCoVan = $_SESSION['user_id'];
        
        $model = new AdvisorModel();
        // Lấy danh sách kế hoạch chờ duyệt
        $dsChoDuyet = $model->getPendingPlans($maCoVan);

        require_once __DIR__ . '/../../views/advisor/dashboard.php';
    }

    // --- 3. DANH SÁCH SINH VIÊN ---
   public function student_list() {
        $this->checkAuth();
        
        // 1. Lấy mã cố vấn đang đăng nhập
        $maCoVan = $_SESSION['user_id']; 
        
        $model = new StudentModel();
        
        // 2. Gọi hàm mới: Chỉ lấy sinh viên của cố vấn này
        $dsSinhVien = $model->getStudentsByAdvisor($maCoVan);

        // 3. Gọi giao diện (Không cần sửa file view)
        require_once __DIR__ . '/../../views/advisor/student_list.php';
    }
    // --- 4. XÉT DUYỆT TIẾN ĐỘ (Hiện bảng môn học) ---
    public function check_progress() {
        $this->checkAuth();
        
        if (isset($_GET['mssv'])) {
            $mssv = $_GET['mssv'];
            $model = new AdvisorModel();
            
            // Lấy danh sách điểm/tiến độ
            $transcript = $model->getStudentGrades($mssv);
            
            require_once __DIR__ . '/../../views/advisor/check_progress.php';
        } else {
            header("Location: index.php?page=advisor_student_list");
        }
    }

    // --- 5. XỬ LÝ BẤM NÚT ĐẠT/KHÔNG ĐẠT ---
    public function toggle_status() {
        $this->checkAuth();
        
        if (isset($_GET['mssv']) && isset($_GET['mahp']) && isset($_GET['status'])) {
            $mssv = $_GET['mssv'];
            $maHP = $_GET['mahp'];
            $status = $_GET['status']; // 'Dat' hoặc 'KhongDat'

            $model = new AdvisorModel();
            $model->updateCourseStatus($mssv, $maHP, $status);
            
            // Quay lại trang cũ
            header("Location: index.php?page=advisor_check_progress&mssv=" . $mssv);
            exit;
        }
    }

    // --- 6. DUYỆT KẾ HOẠCH (Ở Dashboard) ---
    public function approve() {
        $this->checkAuth();
        if (isset($_GET['id'])) {
            $idKeHoach = $_GET['id'];
            $model = new AdvisorModel();
            if ($model->updateStatus($idKeHoach, 'DaDuyet')) {
                echo "<script>alert('Đã DUYỆT thành công!'); window.location.href='index.php?page=advisor_dashboard';</script>";
            } else {
                echo "<script>alert('Lỗi hệ thống!'); window.location.href='index.php?page=advisor_dashboard';</script>";
            }
        }
    }

    // --- 7. TỪ CHỐI KẾ HOẠCH (Ở Dashboard) ---
    public function reject() {
        $this->checkAuth();
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $idKeHoach = $_POST['id_kehoach'];
            $lyDo = $_POST['ly_do'];
            $model = new AdvisorModel();
            
            if ($model->updateStatus($idKeHoach, 'TuChoi', $lyDo)) {
                echo "<script>alert('Đã TỪ CHỐI kế hoạch!'); window.location.href='index.php?page=advisor_dashboard';</script>";
            } else {
                echo "<script>alert('Lỗi hệ thống!'); window.location.href='index.php?page=advisor_dashboard';</script>";
            }
        }
    }
}
?>