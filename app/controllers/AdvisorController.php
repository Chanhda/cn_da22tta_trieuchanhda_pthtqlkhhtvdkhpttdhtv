<?php
require_once __DIR__ . '/AuthController.php';
require_once __DIR__ . '/../models/AdvisorModel.php';

class AdvisorController extends AuthController {

    private function checkAdvisorAuth() {
        if (session_status() === PHP_SESSION_NONE) session_start();
        if (!isset($_SESSION['is_logged_in']) || $_SESSION['role'] !== 'CoVanHocTap') {
            header("Location: index.php?page=login");
            exit;
        }
    }

    public function dashboard() {
        $this->checkAdvisorAuth();
        $maCoVan = $_SESSION['user_id'];
        
        $model = new AdvisorModel();
        // Lấy danh sách sơ bộ
        $dsChoDuyet = $model->getPendingPlans($maCoVan);

        // Truyền biến $model sang View để View dùng cho việc lấy chi tiết (tránh khởi tạo lại new Model ở View)
        // Hoặc View sẽ tự khởi tạo 1 lần duy nhất.
        require_once __DIR__ . '/../../views/advisor/dashboard.php';
    }

    public function approve() {
        $this->checkAdvisorAuth();
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

    public function reject() {
        $this->checkAdvisorAuth();
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
    // Xem danh sách lớp chủ nhiệm
    public function class_list() {
        $this->checkAdvisorAuth();
        $maCoVan = $_SESSION['user_id'];
        
        // Gọi Model để lấy danh sách lớp của cố vấn này
        // (Lưu ý: Bạn cần đảm bảo ClassModel có hàm getClassesByAdvisor($maCoVan))
        // Nếu chưa có, ta dùng tạm SQL trực tiếp ở đây hoặc thêm vào model
        $db = new Database();
        $conn = $db->connect();
        $sql = "SELECT * FROM Lop WHERE MaCoVan = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $maCoVan);
        $stmt->execute();
        $dsLop = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

        require_once __DIR__ . '/../../views/advisor/class_list.php';
    }
}
?>