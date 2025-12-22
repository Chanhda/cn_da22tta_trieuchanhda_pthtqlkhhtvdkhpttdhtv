<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($pageTitle) ? $pageTitle : 'Hệ thống Quản lý Học tập'; ?></title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700;800&display=swap" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark mb-4 shadow-sm">
    <div class="container">
        <a class="navbar-brand fw-bold" href="#">
            <i class="fas fa-university me-2"></i> TVU MANAGER
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto">
                <?php if (isset($_SESSION['role'])): ?>
                    <?php if ($_SESSION['role'] == 'Admin'): ?>
                        <li class="nav-item"><a class="nav-link" href="index.php?page=admin_courses">Học phần</a></li>
                        <li class="nav-item"><a class="nav-link" href="index.php?page=admin_students">Sinh viên</a></li>
                        <li class="nav-item"><a class="nav-link" href="index.php?page=admin_advisors">Cố vấn</a></li>
                        <li class="nav-item"><a class="nav-link" href="index.php?page=admin_classes">Lớp học</a></li>
                    <?php elseif ($_SESSION['role'] == 'SinhVien'): ?>
                        <li class="nav-item"><a class="nav-link" href="index.php?page=dashboard">Dashboard</a></li>
                        <li class="nav-item"><a class="nav-link" href="index.php?page=create_plan">Lập kế hoạch</a></li>
                        <li class="nav-item"><a class="nav-link" href="index.php?page=schedule">Thời khóa biểu</a></li>
                    <?php elseif ($_SESSION['role'] == 'CoVanHocTap'): ?>
                        <li class="nav-item"><a class="nav-link" href="index.php?page=advisor_dashboard">Duyệt kế hoạch</a></li>
                        <li class="nav-item"><a class="nav-link" href="index.php?page=advisor_class_list">Lớp quản lý</a></li>
                    <?php endif; ?>
                <?php endif; ?>
            </ul>

            <div class="d-flex align-items-center">
                <?php if (isset($_SESSION['user_name'])): ?>
                    <span class="text-white me-3 d-none d-md-block">Hi, <?php echo htmlspecialchars($_SESSION['user_name']); ?></span>
                    <a href="index.php?page=logout" class="btn btn-sm btn-light text-primary fw-bold btn-rounded">Đăng xuất</a>
                <?php else: ?>
                    <a href="index.php?page=login" class="btn btn-sm btn-light fw-bold">Đăng nhập</a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</nav>

<div class="container min-vh-100 pb-5">