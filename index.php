<?php
// 1. Khởi tạo Session
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// 2. Nạp các Controller
require_once 'src/app/controllers/AuthController.php';
require_once 'src/app/controllers/StudentController.php';
require_once 'src/app/controllers/AdvisorController.php';
require_once 'src/app/controllers/AdminController.php';

// 3. Lấy page từ URL
$page = isset($_GET['page']) ? $_GET['page'] : 'login';

// 4. Điều hướng
switch ($page) {
    
    // =============================================
    // 1. HỆ THỐNG (ĐĂNG NHẬP / ĐỔI MẬT KHẨU)
    // =============================================
    case 'login':
        $controller = new AuthController();
        $controller->login();
        break;
        
    case 'logout':
        $controller = new AuthController();
        $controller->logout();
        break;

    case 'change_password':
        $controller = new AuthController();
        $controller->change_password();
        break;

    // =============================================
    // 2. PHÂN HỆ SINH VIÊN
    // =============================================
    case 'dashboard':
        $controller = new StudentController();
        $controller->dashboard();
        break;

    case 'create_plan':
        $controller = new StudentController();
        $controller->create_plan(); 
        break;

    case 'store_plan':
        $controller = new StudentController();
        $controller->store_plan(); 
        break;

    case 'student_schedule':
        $controller = new StudentController();
        $controller->schedule();
        break;

    case 'student_print':
        $controller = new StudentController();
        $controller->print_plan();
        break;

    // =============================================
    // 3. PHÂN HỆ CỐ VẤN HỌC TẬP
    // =============================================
    case 'advisor_dashboard':
        $controller = new AdvisorController();
        $controller->dashboard();
        break;

    case 'advisor_approve':
        $controller = new AdvisorController();
        $controller->approve();
        break;

    case 'advisor_process': // Nếu bạn dùng tên này cho xử lý duyệt
    case 'advisor_reject':
        $controller = new AdvisorController();
        $controller->reject();
        break;

    // =============================================
    // 4. PHÂN HỆ QUẢN TRỊ VIÊN (ADMIN)
    // =============================================
    
    // --- QUẢN LÝ HỌC PHẦN ---
    case 'admin_dashboard': // Mặc định về trang học phần
    case 'admin_courses':
        $controller = new AdminController();
        $controller->course_list(); // Đã sửa từ index() thành course_list()
        break;
    
    case 'admin_course_store':
        $controller = new AdminController();
        $controller->course_store();
        break;

    case 'admin_course_edit':
        $controller = new AdminController();
        $controller->course_edit();
        break;

    case 'admin_course_update':
        $controller = new AdminController();
        $controller->course_update();
        break;

    case 'admin_course_delete':
        $controller = new AdminController();
        $controller->course_delete();
        break;

    // --- QUẢN LÝ LỊCH HỌC & TIÊN QUYẾT (Admin) ---
    case 'admin_course_schedule':
        $controller = new AdminController();
        $controller->course_schedule();
        break;
    case 'admin_schedule_store':
        $controller = new AdminController();
        $controller->course_schedule_store();
        break;
    case 'admin_schedule_delete':
        $controller = new AdminController();
        $controller->course_schedule_delete();
        break;

    case 'admin_course_prerequisite':
        $controller = new AdminController();
        $controller->course_prerequisite();
        break;
    case 'admin_prereq_store':
        $controller = new AdminController();
        $controller->course_prerequisite_store();
        break;
    case 'admin_prereq_delete':
        $controller = new AdminController();
        $controller->course_prerequisite_delete();
        break;

    // --- QUẢN LÝ SINH VIÊN ---
    case 'admin_students':
        $controller = new AdminController();
        $controller->student_list();
        break;
    case 'admin_student_store':
        $controller = new AdminController();
        $controller->student_store();
        break;
    case 'admin_student_edit':
        $controller = new AdminController();
        $controller->student_edit();
        break;
    case 'admin_student_update':
        $controller = new AdminController();
        $controller->student_update();
        break;
    case 'admin_student_delete':
        $controller = new AdminController();
        $controller->student_delete();
        break;

    // --- QUẢN LÝ CỐ VẤN ---
    case 'admin_advisors':
        $controller = new AdminController();
        $controller->advisor_list();
        break;
    case 'admin_advisor_store':
        $controller = new AdminController();
        $controller->advisor_store();
        break;
    case 'admin_advisor_edit':
        $controller = new AdminController();
        $controller->advisor_edit();
        break;
    case 'admin_advisor_update':
        $controller = new AdminController();
        $controller->advisor_update();
        break;
    case 'admin_advisor_delete':
        $controller = new AdminController();
        $controller->advisor_delete();
        break;

    // --- QUẢN LÝ LỚP HỌC ---
    case 'admin_classes':
        $controller = new AdminController();
        $controller->class_list();
        break;
    case 'admin_class_store':
        $controller = new AdminController();
        $controller->class_store();
        break;
    case 'admin_class_edit':
        $controller = new AdminController();
        $controller->class_edit();
        break;
    case 'admin_class_update':
        $controller = new AdminController();
        $controller->class_update();
        break;
    case 'admin_class_delete':
        $controller = new AdminController();
        $controller->class_delete();
        break;

    // =============================================
    // MẶC ĐỊNH (404 HOẶC VỀ LOGIN)
    // =============================================
    default:
        $controller = new AuthController();
        $controller->login();
        break;
    // --- CỐ VẤN XÉT DUYỆT ---
    case 'advisor_check_progress':
        $controller = new AdvisorController();
        $controller->check_progress();
        break;
        
    case 'advisor_toggle_status':
        $controller = new AdvisorController();
        $controller->toggle_status();
        break;
    // --- KHU VỰC CỐ VẤN ---
    case 'advisor_dashboard':
        $controller = new AdvisorController();
        $controller->dashboard();
        break;

    // 👇 THÊM ĐOẠN NÀY VÀO 👇
    case 'advisor_student_list': 
        $controller = new AdvisorController();
        $controller->student_list();
        break;

    case 'advisor_check_progress':
        $controller = new AdvisorController();
        $controller->check_progress();
        break;
        
    case 'advisor_toggle_status':
        $controller = new AdvisorController();
        $controller->toggle_status();
        break;
}
?>