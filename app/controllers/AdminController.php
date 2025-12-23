<?php
// NẠP CÁC MODEL CẦN THIẾT
require_once __DIR__ . '/../models/CourseModel.php';
require_once __DIR__ . '/../models/StudentModel.php';
require_once __DIR__ . '/../models/AdvisorModel.php';
require_once __DIR__ . '/../models/ClassModel.php';
require_once __DIR__ . '/../models/UserModel.php';

class AdminController {

    // Kiểm tra quyền Admin
    private function checkAuth() {
        if (session_status() === PHP_SESSION_NONE) session_start();
        if (!isset($_SESSION['is_logged_in']) || $_SESSION['role'] !== 'Admin') {
            header("Location: index.php?page=login");
            exit;
        }
    }

    // ====================================================
    // PHẦN 1: QUẢN LÝ HỌC PHẦN (COURSES)
    // ====================================================

    // 1. Danh sách
    public function course_list() {
        $this->checkAuth();
        $model = new CourseModel();
        $courses = $model->getAllCourses();
        require_once __DIR__ . '/../../views/admin/course_list.php';
    }

    // 2. Thêm mới
    public function course_store() {
        $this->checkAuth();
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $model = new CourseModel();
            // Lấy dữ liệu và ép kiểu an toàn
            $ma = trim($_POST['ma_hp']);
            $ten = trim($_POST['ten_hp']);
            $tc = (int)$_POST['so_tc'];
            $lt = (int)($_POST['lt'] ?? 0);
            $th = (int)($_POST['th'] ?? 0);
            $hk = (int)($_POST['hk'] ?? 1);

            if ($model->addCourse($ma, $ten, $tc, $lt, $th, $hk)) {
                echo "<script>alert('Thêm học phần thành công!'); window.location.href='index.php?page=admin_courses';</script>";
            } else {
                echo "<script>alert('Lỗi: Mã học phần đã tồn tại!'); window.history.back();</script>";
            }
        }
    }

    // 3. Form sửa
    public function course_edit() {
        $this->checkAuth();
        if (isset($_GET['id'])) {
            $model = new CourseModel();
            $course = $model->getCourseById($_GET['id']);
            if ($course) {
                require_once __DIR__ . '/../../views/admin/course_edit.php';
            } else {
                echo "<script>alert('Không tìm thấy môn học!'); window.location.href='index.php?page=admin_courses';</script>";
            }
        }
    }

    // 4. Cập nhật
    public function course_update() {
        $this->checkAuth();
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $model = new CourseModel();
            $kq = $model->updateCourse(
                $_POST['ma_hp'], $_POST['ten_hp'], $_POST['so_tc'], $_POST['lt'], $_POST['th'], $_POST['hk']
            );
            if ($kq) {
                echo "<script>alert('Cập nhật thành công!'); window.location.href='index.php?page=admin_courses';</script>";
            } else {
                echo "<script>alert('Lỗi cập nhật!'); window.history.back();</script>";
            }
        }
    }

    // 5. Xóa
    public function course_delete() {
        $this->checkAuth();
        if (isset($_GET['id'])) {
            $model = new CourseModel();
            if ($model->deleteCourse($_GET['id'])) {
                echo "<script>alert('Xóa thành công!'); window.location.href='index.php?page=admin_courses';</script>";
            } else {
                echo "<script>alert('Không thể xóa! Môn này đang có dữ liệu điểm hoặc lịch học.'); window.location.href='index.php?page=admin_courses';</script>";
            }
        }
    }

    // --- QUẢN LÝ LỊCH HỌC ---
    public function course_schedule() {
        $this->checkAuth();
        $model = new CourseModel();
        $maHP = $_GET['id'];
        $course = $model->getCourseById($maHP);
        $schedule = $model->getSchedule($maHP);
        require_once __DIR__ . '/../../views/admin/course_schedule.php';
    }

    public function course_schedule_store() {
        $this->checkAuth();
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $model = new CourseModel();
            $model->addSchedule($_POST['ma_hp'], $_POST['thu'], $_POST['tiet'], $_POST['so_tiet'], $_POST['phong'], $_POST['gv']);
            header("Location: index.php?page=admin_course_schedule&id=" . $_POST['ma_hp']);
        }
    }

    public function course_schedule_delete() {
        $this->checkAuth();
        $model = new CourseModel();
        $model->deleteSchedule($_GET['id_tkb']);
        header("Location: index.php?page=admin_course_schedule&id=" . $_GET['ma_hp']);
    }

    // --- QUẢN LÝ TIÊN QUYẾT ---
    public function course_prerequisite() {
        $this->checkAuth();
        $model = new CourseModel();
        $maHP = $_GET['id'];
        $course = $model->getCourseById($maHP);
        $prereqs = $model->getPrerequisites($maHP);
        $allCourses = $model->getAllCourses();
        require_once __DIR__ . '/../../views/admin/course_prerequisite.php';
    }

    public function course_prerequisite_store() {
        $this->checkAuth();
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $model = new CourseModel();
            $model->addPrerequisite($_POST['ma_hp'], $_POST['ma_hp_tq']);
            header("Location: index.php?page=admin_course_prerequisite&id=" . $_POST['ma_hp']);
        }
    }

    public function course_prerequisite_delete() {
        $this->checkAuth();
        $model = new CourseModel();
        $model->deletePrerequisite($_GET['id_dk']);
        header("Location: index.php?page=admin_course_prerequisite&id=" . $_GET['ma_hp']);
    }

    // ====================================================
    // PHẦN 2: QUẢN LÝ SINH VIÊN (STUDENTS)
    // ====================================================

    // 1. Danh sách
    public function student_list() {
        $this->checkAuth();
        $model = new StudentModel();
        $dsSinhVien = $model->getAllStudents();
        require_once __DIR__ . '/../../views/admin/student_list.php';
    }

    // 2. Thêm mới (Tự tạo tài khoản)
    public function student_store() {
        $this->checkAuth();
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $userModel = new UserModel();
            $mssv = $_POST['mssv'];
            $pass = $_POST['password'] ?: '123456';

            // Check trùng tài khoản
            if ($userModel->checkLogin($mssv, $pass)) {
                echo "<script>alert('Tài khoản $mssv đã tồn tại!'); window.history.back();</script>";
                return;
            }

            $newAccountId = $userModel->createAccount($mssv, $pass, 'SinhVien');
            if ($newAccountId) {
                $studentModel = new StudentModel();
                $kq = $studentModel->addStudent($mssv, $_POST['ho_ten'], $_POST['lop'], $_POST['email'], $_POST['ctdt'], $newAccountId);
                if($kq) {
                    echo "<script>alert('Thêm sinh viên thành công!'); window.location.href='index.php?page=admin_students';</script>";
                } else {
                    $userModel->deleteAccount($newAccountId); // Xóa rác nếu thêm SV lỗi
                    echo "<script>alert('Lỗi thêm thông tin!'); window.history.back();</script>";
                }
            } else {
                echo "<script>alert('Lỗi tạo tài khoản!'); window.history.back();</script>";
            }
        }
    }

    // 3. Form sửa
    public function student_edit() {
        $this->checkAuth();
        if (isset($_GET['mssv'])) {
            $model = new StudentModel();
            $sv = $model->getStudentInfo($_GET['mssv']);
            if ($sv) {
                require_once __DIR__ . '/../../views/admin/student_edit.php';
            }
        }
    }

    // 4. Cập nhật
    public function student_update() {
        $this->checkAuth();
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $model = new StudentModel();
            $model->updateStudent($_POST['mssv'], $_POST['ho_ten'], $_POST['lop'], $_POST['email'], $_POST['ctdt']);
            echo "<script>alert('Cập nhật thành công!'); window.location.href='index.php?page=admin_students';</script>";
        }
    }

    // 5. Xóa
    public function student_delete() {
        $this->checkAuth();
        if (isset($_GET['mssv'])) {
            $stModel = new StudentModel();
            $userModel = new UserModel();
            
            // Lấy ID tài khoản để xóa user
            $sv = $stModel->getStudentInfo($_GET['mssv']);
            $idTaiKhoan = $sv['ID_TaiKhoan'];

            if ($stModel->deleteStudent($_GET['mssv'])) {
                if ($idTaiKhoan) $userModel->deleteAccount($idTaiKhoan);
                echo "<script>alert('Xóa sinh viên thành công!'); window.location.href='index.php?page=admin_students';</script>";
            } else {
                echo "<script>alert('Lỗi xóa sinh viên!'); window.history.back();</script>";
            }
        }
    }

    // ====================================================
    // PHẦN 3: QUẢN LÝ CỐ VẤN (ADVISORS)
    // ====================================================

    // 1. Danh sách
    public function advisor_list() {
        $this->checkAuth();
        $model = new AdvisorModel();
        $dsCoVan = $model->getAllAdvisors();
        require_once __DIR__ . '/../../views/admin/advisor_list.php';
    }

    // 2. Thêm mới
    public function advisor_store() {
        $this->checkAuth();
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $userModel = new UserModel();
            $maGV = $_POST['ma_covan'];
            $pass = '123456';
            
            $newAccId = $userModel->createAccount($maGV, $pass, 'CoVanHocTap');
            if ($newAccId) {
                $advModel = new AdvisorModel();
                $kq = $advModel->addAdvisor($maGV, $_POST['ho_ten'], $_POST['khoa'], $_POST['email'], $_POST['sdt'], $newAccId);
                if ($kq) {
                    echo "<script>alert('Thêm cố vấn thành công!'); window.location.href='index.php?page=admin_advisors';</script>";
                } else {
                    $userModel->deleteAccount($newAccId);
                    echo "<script>alert('Lỗi thêm thông tin cố vấn!'); window.history.back();</script>";
                }
            } else {
                echo "<script>alert('Mã Cố vấn/Tài khoản trùng!'); window.history.back();</script>";
            }
        }
    }

    // 3. Form sửa (Đã thêm logic)
    public function advisor_edit() {
        $this->checkAuth();
        if (isset($_GET['id'])) {
            $model = new AdvisorModel();
            $gv = $model->getAdvisorById($_GET['id']);
            if ($gv) {
                require_once __DIR__ . '/../../views/admin/advisor_edit.php';
            } else {
                 echo "<script>alert('Không tìm thấy cố vấn!'); window.history.back();</script>";
            }
        }
    }

    // 4. Cập nhật (Đã thêm logic)
    public function advisor_update() {
        $this->checkAuth();
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $model = new AdvisorModel();
            
            // SỬA: Đổi 'ma_covan' thành 'msgv' để khớp với Form <input name="msgv">
            // Các trường 'ho_ten', 'email', 'sdt' thì giữ nguyên vì form đã đúng
            $kq = $model->updateAdvisor($_POST['msgv'], $_POST['ho_ten'], $_POST['email'], $_POST['sdt']); // Bỏ 'khoa' nếu form không có sửa khoa
            
            if ($kq) {
                echo "<script>alert('Cập nhật cố vấn thành công!'); window.location.href='index.php?page=admin_advisors';</script>";
            } else {
                echo "<script>alert('Lỗi cập nhật!'); window.history.back();</script>";
            }
        }
    }

    // 5. Xóa
    public function advisor_delete() {
        $this->checkAuth();
        if (isset($_GET['id'])) {
            $model = new AdvisorModel();
            $userModel = new UserModel();
            
            $gv = $model->getAdvisorById($_GET['id']);
            $idTaiKhoan = $gv['ID_TaiKhoan'];

            if ($model->deleteAdvisor($_GET['id'])) {
                if ($idTaiKhoan) $userModel->deleteAccount($idTaiKhoan);
                header("Location: index.php?page=admin_advisors");
            } else {
                 echo "<script>alert('Không thể xóa! Cố vấn đang quản lý lớp học.'); window.history.back();</script>";
            }
        }
    }

    // ====================================================
    // PHẦN 4: QUẢN LÝ LỚP HỌC (CLASSES)
    // ====================================================

    // 1. Danh sách
    public function class_list() {
        $this->checkAuth();
        $model = new ClassModel();
        $dsLop = $model->getAllClasses();
        // Lấy list cố vấn cho modal thêm
        $advModel = new AdvisorModel();
        $dsCoVan = $advModel->getAllAdvisors();
        require_once __DIR__ . '/../../views/admin/class_list.php';
    }

    // 2. Thêm mới
    public function class_store() {
        $this->checkAuth();
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $model = new ClassModel();
            if ($model->addClass($_POST['ma_lop'], $_POST['ten_lop'], $_POST['ma_covan'])) {
                echo "<script>alert('Thêm lớp thành công!'); window.location.href='index.php?page=admin_classes';</script>";
            } else {
                echo "<script>alert('Mã lớp trùng!'); window.history.back();</script>";
            }
        }
    }

    // 3. Form Sửa (Đã thêm logic)
    public function class_edit() {
        $this->checkAuth();
        // SỬA: Đổi 'ma_lop' thành 'id' để khớp với link <a href="...&id=...">
        if (isset($_GET['id'])) {
            $model = new ClassModel();
            $lop = $model->getClassById($_GET['id']); 
            
            $advModel = new AdvisorModel();
            $dsCoVan = $advModel->getAllAdvisors();
            
            if ($lop) {
                require_once __DIR__ . '/../../views/admin/class_edit.php';
            }
        }
    }

    // 4. Cập nhật (Đã thêm logic)
    public function class_update() {
        $this->checkAuth();
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $model = new ClassModel();
            // Cần thêm hàm updateClass vào ClassModel
            $kq = $model->updateClass($_POST['ma_lop'], $_POST['ten_lop'], $_POST['ma_covan']);
            if ($kq) {
                echo "<script>alert('Cập nhật lớp thành công!'); window.location.href='index.php?page=admin_classes';</script>";
            } else {
                 echo "<script>alert('Lỗi cập nhật!'); window.history.back();</script>";
            }
        }
    }

    // 5. Xóa
    public function class_delete() {
        $this->checkAuth();
        // Kiểm tra xem trên URL có tham số 'id' không (VD: ...&id=DA21TT)
        if (isset($_GET['id'])) {
            $model = new ClassModel();
            
            // SỬA: Phải truyền đúng $_GET['id'] vào hàm xóa
            $maLopCanXoa = $_GET['id'];
            
            if ($model->deleteClass($maLopCanXoa)) {
                // Xóa thành công -> Quay lại trang danh sách
                header("Location: index.php?page=admin_classes");
            } else {
                // Xóa thất bại (Do có sinh viên hoặc lỗi hệ thống)
                echo "<script>alert('Không thể xóa! Lớp đang có sinh viên hoặc lỗi dữ liệu.'); window.location.href='index.php?page=admin_classes';</script>";
            }
        }
    }
    
}
?>