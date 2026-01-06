<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Sinh viên</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link href="assets/css/style.css" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            min-height: 100vh;
        }

        /* Navbar */
        .navbar {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%) !important;
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
            padding: 1rem 0;
        }

        .navbar-brand {
            font-size: 1.5rem;
            letter-spacing: 0.5px;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .navbar .btn {
            border-radius: 8px;
            font-weight: 600;
            transition: all 0.3s ease;
            border: none;
        }

        .navbar .btn-warning {
            background-color: #ffc107 !important;
            color: #333 !important;
        }

        .navbar .btn-warning:hover {
            background-color: #ffb300 !important;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(255, 193, 7, 0.3);
        }

        .navbar .btn-light {
            background-color: white !important;
            color: #667eea !important;
        }

        .navbar .btn-light:hover {
            background-color: #f0f0f0 !important;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(255, 255, 255, 0.3);
        }

        /* Cards */
        .card {
            border: none !important;
            border-radius: 15px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            overflow: hidden;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 35px rgba(0, 0, 0, 0.15);
        }

        .card-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%) !important;
            color: white !important;
            border: none !important;
            padding: 1.5rem;
            font-weight: 700;
            font-size: 1.1rem;
        }

        .card-header.bg-success {
            background: linear-gradient(135deg, #56ab2f 0%, #a8e063 100%) !important;
        }

        .card-body {
            padding: 1.5rem;
        }

        /* Buttons */
        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            border-radius: 10px;
            padding: 10px 20px;
            font-weight: 600;
            transition: all 0.3s ease;
            box-shadow: 0 4px 12px rgba(102, 126, 234, 0.3);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(102, 126, 234, 0.4);
            background: linear-gradient(135deg, #7c8ff0 0%, #8d5cb5 100%);
            color: white;
        }

        .btn-danger {
            background: linear-gradient(135deg, #ee7752 0%, #e73c7e 100%);
            border: none;
            border-radius: 10px;
            font-weight: 600;
            transition: all 0.3s ease;
            box-shadow: 0 4px 12px rgba(231, 60, 126, 0.3);
        }

        .btn-danger:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(231, 60, 126, 0.4);
        }

        .btn-outline-primary {
            border: 2px solid #667eea;
            color: #667eea;
            border-radius: 10px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-outline-primary:hover {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-color: #667eea;
            color: white;
            transform: translateY(-2px);
        }

        /* Status Badges */
        .badge {
            border-radius: 8px;
            padding: 0.5rem 1rem;
            font-weight: 600;
            font-size: 0.9rem;
        }

        /* Status Text */
        .text-warning {
            color: #f59e0b !important;
        }

        .text-success {
            color: #10b981 !important;
        }

        .text-danger {
            color: #ef4444 !important;
        }

        /* Progress Bar */
        .progress {
            border-radius: 10px;
            background-color: #e5e7eb;
            height: 25px !important;
        }

        .progress-bar {
            border-radius: 10px;
            font-weight: 600;
            background: linear-gradient(90deg, #10b981 0%, #059669 100%) !important;
        }

        /* List Group */
        .list-group-item {
            border: none;
            border-bottom: 1px solid #f0f0f0;
            padding: 1rem;
            transition: all 0.3s ease;
        }

        .list-group-item:last-child {
            border-bottom: none;
        }

        .list-group-item:hover {
            background-color: #f9fafb;
        }

        /* Info Cards */
        .info-card {
            border-left: 4px solid #667eea;
        }

        /* Pulse Button Animation */
        .pulse-button {
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0% {
                box-shadow: 0 0 0 0 rgba(102, 126, 234, 0.7);
            }
            70% {
                box-shadow: 0 0 0 10px rgba(102, 126, 234, 0);
            }
            100% {
                box-shadow: 0 0 0 0 rgba(102, 126, 234, 0);
            }
        }

        /* Alert */
        .alert {
            border: none;
            border-radius: 10px;
            border-left: 4px solid;
        }

        .alert-danger {
            background-color: #fee2e2;
            border-left-color: #ef4444;
            color: #991b1b;
        }

        /* Container */
        .container {
            max-width: 1200px;
        }

        /* Row spacing */
        .row > [class*='col-'] {
            margin-bottom: 2rem;
        }

        /* Chart Container */
        .chart-container {
            position: relative;
            height: 250px;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .navbar-brand {
                font-size: 1.2rem;
            }

            .card-body {
                padding: 1rem;
            }

            .card-header {
                padding: 1rem;
                font-size: 1rem;
            }
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark mb-4">
    <div class="container">
        <a class="navbar-brand fw-bold" href="#">
            <i class="fas fa-graduation-cap me-2"></i>CỔNG SINH VIÊN
        </a>
        <div class="d-flex text-white align-items-center gap-3">
            <span class="fw-500">
                <i class="fas fa-user-circle me-1"></i>Xin chào, <?php echo $_SESSION['user_name']; ?>
            </span>
            <a href="index.php?page=change_password" class="btn btn-sm btn-warning text-dark fw-bold">
                <i class="fas fa-key me-1"></i>Đổi mật khẩu
            </a>
            <a href="index.php?page=logout" class="btn btn-sm btn-light fw-bold">
                <i class="fas fa-sign-out-alt me-1"></i>Đăng xuất
            </a>
        </div>
    </div>
</nav>

<div class="container">
    <div class="row">
        
        <div class="col-md-4 mb-4">
            
            <div class="card shadow-sm mb-4 info-card">
                <div class="card-header">
                    <i class="fas fa-user-card me-2"></i>Thông tin sinh viên
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <small class="text-muted d-block">Họ tên</small>
                        <strong class="text-dark"><?php echo $sinhVien['HoTen']; ?></strong>
                    </div>
                    <div class="mb-3">
                        <small class="text-muted d-block">MSSV</small>
                        <strong class="text-primary"><?php echo $sinhVien['MSSV']; ?></strong>
                    </div>
                    <div class="mb-3">
                        <small class="text-muted d-block">Lớp</small>
                        <strong class="text-dark"><?php echo $sinhVien['MaLop']; ?></strong>
                    </div>
                    <div>
                        <small class="text-muted d-block">Email</small>
                        <strong class="text-dark"><?php echo $sinhVien['Email']; ?></strong>
                    </div>
                </div>
            </div>

            <div class="card shadow-sm info-card">
                <div class="card-header bg-success">
                    <i class="fas fa-calendar-check me-2"></i>Kế hoạch học tập
                </div>
                <div class="card-body text-center">
                    <?php if ($keHoach): ?>
                        <p class="text-muted mb-2 small">
                            <i class="fas fa-calendar me-1"></i>Ngày lập: <strong><?php echo date('d/m/Y', strtotime($keHoach['NgayLap'])); ?></strong>
                        </p>
                        
                        <?php if($keHoach['TrangThai'] == 'ChoDuyet'): ?>
                            <div class="alert alert-warning border-0" role="alert">
                                <i class="fas fa-hourglass-half me-2"></i>
                                <strong>ĐANG CHỜ DUYỆT</strong>
                                <p class="small mt-2 mb-0">Vui lòng chờ Cố vấn kiểm tra kế hoạch của bạn.</p>
                            </div>
                        <?php elseif($keHoach['TrangThai'] == 'DaDuyet'): ?>
                            <div class="alert alert-success border-0" role="alert">
                                <i class="fas fa-check-circle me-2"></i>
                                <strong>ĐÃ ĐƯỢC DUYỆT</strong>
                                <p class="small mt-2 mb-0">Bạn có thể đăng ký học phần theo kế hoạch này.</p>
                            </div>
                        <?php else: ?>
                            <div class="alert alert-danger border-0" role="alert">
                                <i class="fas fa-times-circle me-2"></i>
                                <strong>BỊ TỪ CHỐI</strong>
                                <div class="text-start small mt-2 p-2 bg-light rounded">
                                    <strong>Lý do:</strong> 
                                    <p class="mb-0"><?php echo $keHoach['LyDoTuChoi'] ?? 'Không có lý do cụ thể'; ?></p>
                                </div>
                            </div>
                            <a href="index.php?page=create_plan" class="btn btn-danger btn-sm w-100 mt-2">
                                <i class="fas fa-redo me-1"></i>Lập lại kế hoạch
                            </a>
                        <?php endif; ?>

                        <div class="mt-3 border-top pt-3">
                            <a href="index.php?page=student_print" target="_blank" class="btn btn-outline-primary w-100 fw-bold">
                                <i class="fas fa-file-pdf me-1"></i>In Phiếu Kế hoạch
                            </a>
                        </div>

                    <?php else: ?>
                        <div class="text-center py-3">
                            <i class="fas fa-inbox text-muted" style="font-size: 3rem;"></i>
                            <p class="text-muted mt-3 mb-3">Bạn chưa lập kế hoạch nào</p>
                            <a href="index.php?page=create_plan" class="btn btn-primary pulse-button w-100 fw-bold">
                                <i class="fas fa-plus me-1"></i>Lập kế hoạch ngay
                            </a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <div class="col-md-8">
            
            <div class="card shadow-sm mb-4">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <h5 class="fw-bold text-primary mb-0">
                            <i class="fas fa-clock me-2"></i>Thời khóa biểu
                        </h5>
                        <small class="text-muted">Xem lịch học các môn đã được duyệt</small>
                    </div>
                    <a href="index.php?page=student_schedule" class="btn btn-primary fw-bold">
                        <i class="fas fa-arrow-right me-1"></i>Xem ngay
                    </a>
                </div>
            </div>

            <div class="card shadow mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span><i class="fas fa-chart-pie me-2"></i>Tiến độ học tập</span>
                    <span class="badge bg-primary rounded-pill">CTĐT: <?php echo $sinhVien['MaCTDT']; ?></span>
                </div>
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-md-5">
                            <div class="chart-container">
                                <canvas id="progressChart"></canvas>
                            </div>
                        </div>
                        <div class="col-md-7">
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item d-flex justify-content-between">
                                    <span class="fw-500">Tổng tín chỉ yêu cầu</span>
                                    <strong class="text-primary"><?php echo $tienDo['total']; ?> TC</strong>
                                </li>
                                <li class="list-group-item d-flex justify-content-between">
                                    <span class="fw-500">Đã tích lũy</span>
                                    <strong class="text-success"><?php echo $tienDo['accumulated']; ?> TC</strong>
                                </li>
                                <li class="list-group-item d-flex justify-content-between">
                                    <span class="fw-500">Còn lại</span>
                                    <strong class="text-danger"><?php echo $tienDo['remaining']; ?> TC</strong>
                                </li>
                            </ul>
                            
                            <div class="mt-4">
                                <small class="text-muted fw-600 d-block mb-2">
                                    <i class="fas fa-tachometer-alt me-1"></i>Thanh tiến độ
                                </small>
                                <div class="progress">
                                    <?php 
                                        $percent = ($tienDo['total'] > 0) ? round(($tienDo['accumulated'] / $tienDo['total']) * 100) : 0;
                                    ?>
                                    <div class="progress-bar progress-bar-striped progress-bar-animated" 
                                         role="progressbar" 
                                         aria-valuenow="<?php echo $percent; ?>" 
                                         aria-valuemin="0" 
                                         aria-valuemax="100"
                                         style="width: <?php echo $percent; ?>%;">
                                        <strong><?php echo $percent; ?>%</strong>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="card-title fw-bold text-primary mb-3">
                        <i class="fas fa-lightbulb me-2"></i>Gợi ý nhanh
                    </h5>
                    <p class="card-text text-muted mb-3">
                        Hệ thống nhận thấy bạn chưa hoàn thành các môn cơ sở. Hãy ưu tiên đăng ký trong kỳ tới để nâng cao tiến độ học tập.
                    </p>
                    <?php if (!$keHoach): ?>
                    <a href="index.php?page=create_plan" class="btn btn-primary fw-bold">
                        <i class="fas fa-arrow-right me-1"></i>Bắt đầu lập kế hoạch
                    </a>
                    <?php endif; ?>
                </div>
            </div>

        </div>
    </div>
</div> <script>
    const ctx = document.getElementById('progressChart').getContext('2d');
    new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: ['Đã tích lũy', 'Còn lại'],
            datasets: [{
                data: [<?php echo $tienDo['accumulated']; ?>, <?php echo $tienDo['remaining']; ?>],
                backgroundColor: ['#198754', '#dc3545'],
                hoverOffset: 4
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { position: 'bottom' }
            }
        }
    });
</script>

</body>
</html>