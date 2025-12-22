<?php
// Nạp các Model và Helper cần thiết
require_once __DIR__ . '/../models/CourseModel.php';
require_once __DIR__ . '/../models/PlanModel.php';
require_once __DIR__ . '/../models/StudentModel.php'; // Mới thêm
require_once __DIR__ . '/../helpers/Validation.php';  // Mới thêm

class PlanController {

    // 1. Hiển thị form lập kế hoạch
    public function create() {
        // Lấy danh sách môn học để hiển thị
        $courseModel = new CourseModel();
        $dsHocPhan = $courseModel->getAllCourses();

        // Hiển thị View
        require_once __DIR__ . '/../../views/student/create_plan.php';
    }

    // 2. Xử lý lưu kế hoạch (Đã có Validation)
    public function store() {
        session_start();
        // Giả lập lấy MSSV (sau này sẽ lấy từ $_SESSION['user_id'] thật)
        $mssv = isset($_SESSION['mssv']) ? $_SESSION['mssv'] : '11001';

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Lấy dữ liệu từ form
            $hocKy = $_POST['hoc_ky'];
            $namHoc = $_POST['nam_hoc'];
            // Lấy mảng môn học (nếu không chọn môn nào thì là mảng rỗng)
            $selectedCourses = isset($_POST['mon_hoc']) ? $_POST['mon_hoc'] : [];

            // Kiểm tra rỗng
            if (empty($selectedCourses)) {
                echo "<script>alert('Vui lòng chọn ít nhất 1 môn!'); window.history.back();</script>";
                return;
            }

            // ====================================================
            // BẮT ĐẦU KIỂM TRA LOGIC (VALIDATION)
            // ====================================================
            $studentModel = new StudentModel();
            $courseModel = new CourseModel();

            // A. Check Tiên quyết
            // Lấy danh sách môn SV đã đậu
            $passedCourses = $studentModel->getPassedCourses($mssv);
            // Lấy quy định tiên quyết của các môn SV vừa chọn
            $rules = $courseModel->getPrerequisites($selectedCourses);
            // Gọi hàm kiểm tra
            $errors1 = Validation::checkPrerequisites($selectedCourses, $passedCourses, $rules);

            // B. Check Trùng lịch
            // Lấy lịch học của các môn SV vừa chọn
            $schedules = $courseModel->getSchedules($selectedCourses);
            // Gọi hàm kiểm tra
            $errors2 = Validation::checkScheduleConflict($schedules);

            // Gộp tất cả lỗi lại
            $allErrors = array_merge($errors1, $errors2);

            // Nếu có bất kỳ lỗi nào -> Báo lỗi và Dừng lại (Không lưu)
            if (!empty($allErrors)) {
                $msg = implode("\\n", $allErrors); // Nối lỗi bằng ký tự xuống dòng
                $msg = strip_tags($msg); // Xóa thẻ HTML (<b>) để hiện trong alert
                
                // Hiển thị popup lỗi và quay lại trang trước
                echo "<script>alert('KHÔNG THỂ LƯU KẾ HOẠCH:\\n-----------------\\n$msg'); window.history.back();</script>";
                return; 
            }
            // ====================================================
            // KẾT THÚC KIỂM TRA - NẾU HỢP LỆ THÌ LƯU VÀO CSDL
            // ====================================================

            $planModel = new PlanModel();
            // 1. Tạo phiếu kế hoạch chung
            $planId = $planModel->createPlan($mssv, $hocKy, $namHoc);

            if ($planId) {
                // 2. Lưu chi tiết từng môn
                foreach ($selectedCourses as $maHP) {
                    $planModel->addPlanDetail($planId, $maHP);
                }
                
                // Thông báo thành công và về Dashboard
                echo "<script>alert('Lập kế hoạch thành công! Đã gửi cho Cố vấn.'); window.location.href='index.php?page=dashboard';</script>";
            } else {
                echo "Lỗi hệ thống! Không thể tạo kế hoạch.";
            }
        }
    }
}
?>