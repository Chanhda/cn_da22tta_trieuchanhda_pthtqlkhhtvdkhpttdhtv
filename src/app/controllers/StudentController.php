<?php
require_once __DIR__ . '/AuthController.php';
require_once __DIR__ . '/../models/StudentModel.php';
require_once __DIR__ . '/../models/CourseModel.php';

class StudentController extends AuthController {

    private function checkStudentAuth() {
        if (session_status() === PHP_SESSION_NONE) session_start();
        if (!isset($_SESSION['is_logged_in']) || $_SESSION['role'] !== 'SinhVien') {
            header("Location: index.php?page=login");
            exit;
        }
    }

    // 1. Dashboard
    public function dashboard() {
        $this->checkStudentAuth();
        $mssv = $_SESSION['user_id'];
        $model = new StudentModel();
        
        $sinhVien = $model->getStudentInfo($mssv);
        $keHoach = $model->getLatestPlan($mssv);
        $tienDo = $model->getStudyProgress($mssv, $sinhVien['ChuongTrinhDaoTao'] ?? '');
        
        require_once __DIR__ . '/../../views/student/dashboard.php';
    }

    // 2. Trang tạo kế hoạch
    public function create_plan() {
        $this->checkStudentAuth();
        $courseModel = new CourseModel();
        $studentModel = new StudentModel();
        

        $courses = $courseModel->getAllCoursesWithDetails();
        $passedCourses = $studentModel->getPassedCourses($_SESSION['user_id']);
        
        require_once __DIR__ . '/../../views/student/create_plan.php';
    }

    // 3. Xử lý lưu kế hoạch
    public function store_plan() {
        $this->checkStudentAuth();
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $mssv = $_SESSION['user_id'];
            $selected = $_POST['mon_hoc'] ?? [];
            
            if (empty($selected)) { 
                echo "<script>alert('Vui lòng chọn ít nhất một môn học!'); window.history.back();</script>"; 
                return; 
            }

            // Lưu vào Database (Kết nối trực tiếp để nhanh gọn, hoặc viết hàm addPlan trong Model)
            $db = new Database(); 
            $conn = $db->connect();
            
            $hocky = 1;
            $namhoc = "2025-2026";
            $ghichu = "Đăng ký trực tuyến"; // Đảm bảo bạn đã chạy lệnh thêm cột GhiChu trong SQL

            // Thêm vào bảng KeHoachHocTap
            $stmt = $conn->prepare("INSERT INTO KeHoachHocTap (MSSV, HocKy, NamHoc, NgayLap, TrangThai, GhiChu) VALUES (?, ?, ?, NOW(), 'ChoDuyet', ?)");
            $stmt->bind_param("siss", $mssv, $hocky, $namhoc, $ghichu);
            
            if ($stmt->execute()) {
                $id = $conn->insert_id;
                // Thêm vào bảng ChiTietKeHoach
                // Đảm bảo bạn đã chạy lệnh thêm cột TrangThaiMon trong SQL
                $stmtD = $conn->prepare("INSERT INTO ChiTietKeHoach (ID_KeHoach, MaHocPhan, TrangThaiMon) VALUES (?, ?, 'ChuaHoc')");
                foreach ($selected as $c) { 
                    $stmtD->bind_param("is", $id, $c); 
                    $stmtD->execute(); 
                }
                echo "<script>alert('Đăng ký kế hoạch thành công! Đang chờ duyệt.'); window.location.href='index.php?page=dashboard';</script>";
            } else {
                echo "<script>alert('Lỗi hệ thống khi lưu kế hoạch!'); window.history.back();</script>";
            }
        }
    }

    // 4. Hiển thị Thời khóa biểu (ĐÃ SỬA LOGIC MA TRẬN)
    public function schedule() {
        $this->checkStudentAuth();
        $model = new StudentModel();
        
        // Lấy dữ liệu thô
        $tkbRaw = $model->getStudentSchedule($_SESSION['user_id']);
        
        // Tạo ma trận rỗng
        $scheduleMatrix = [];
        for($thu = 2; $thu <= 8; $thu++) { 
             for($tiet = 1; $tiet <= 12; $tiet++) { 
                 $scheduleMatrix[$thu][$tiet] = null;
             }
        }

        // Đổ dữ liệu vào ma trận
        if (!empty($tkbRaw)) {
            foreach ($tkbRaw as $item) {
                $thu = (int)$item['Thu'];
                $bd = (int)$item['TietBatDau'];
                $st = (int)$item['SoTiet'];
                
                if ($thu >= 2 && $thu <= 8 && $bd >= 1 && $bd <= 12) {
                    $scheduleMatrix[$thu][$bd] = [
                        'TenHP' => $item['TenHocPhan'], 
                        'Phong' => $item['Phong'] ?? 'P.Chưa Xếp', // Đảm bảo cột Phong tồn tại trong DB
                        'GV' => $item['TenGiangVien'] ?? 'Chưa cập nhật', 
                        'SoTiet' => $st,
                        'MaHP' => $item['MaHocPhan']
                    ];
                    
                    // Đánh dấu skip
                    for ($k = 1; $k < $st; $k++) { 
                        if (($bd + $k) <= 12) $scheduleMatrix[$thu][$bd + $k] = 'skip'; 
                    }
                }
            }
        }
        
        require_once __DIR__ . '/../../views/student/schedule.php';
    }

    // 5. In kế hoạch
    public function print_plan() {
        $this->checkStudentAuth();
        $model = new StudentModel();
        
        $sinhVien = $model->getStudentInfo($_SESSION['user_id']);
        $keHoach = $model->getLatestPlan($_SESSION['user_id']);
        
        if ($keHoach) {
            $chiTiet = $model->getPlanDetails($keHoach['ID_KeHoach']);
            require_once __DIR__ . '/../../views/student/plan_print.php';
        } else {
            echo "<script>alert('Bạn chưa có kế hoạch nào để in!'); window.history.back();</script>";
        }
    }
}
?>