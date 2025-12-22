<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Thời khóa biểu</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
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
            font-weight: 700;
            letter-spacing: 0.5px;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .navbar .btn {
            border-radius: 8px;
            font-weight: 600;
            transition: all 0.3s ease;
            border: none;
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

        .navbar .btn-outline-light {
            color: white !important;
            border-color: white !important;
        }

        .navbar .btn-outline-light:hover {
            background-color: rgba(255, 255, 255, 0.2);
            transform: translateY(-2px);
        }

        /* Container */
        .container {
            max-width: 1400px;
        }

        /* Header */
        .schedule-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
            padding: 1.5rem;
            background: white;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .schedule-header h3 {
            color: #667eea;
            font-size: 1.8rem;
            font-weight: 700;
            letter-spacing: 0.5px;
            margin: 0;
        }

        .schedule-header .btn-print {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white !important;
            border: none !important;
            border-radius: 10px;
            padding: 0.75rem 1.5rem;
            font-weight: 600;
            box-shadow: 0 4px 12px rgba(102, 126, 234, 0.3);
            transition: all 0.3s ease;
        }

        .schedule-header .btn-print:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(102, 126, 234, 0.4);
        }

        /* Alert */
        .alert-info {
            background: linear-gradient(135deg, #dbeafe 0%, #bfdbfe 100%) !important;
            border: 1px solid #93c5fd !important;
            color: #1e40af !important;
            border-radius: 12px !important;
            padding: 1.2rem !important;
        }

        .alert-info small {
            font-size: 0.95rem;
            font-weight: 500;
        }

        /* Card */
        .card {
            border: none !important;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
            overflow: hidden;
        }

        /* Table */
        .table-schedule {
            margin-bottom: 0;
        }

        .table-schedule thead {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }

        .table-schedule thead th {
            border: none !important;
            padding: 1.2rem !important;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            font-size: 0.95rem;
        }

        .table-schedule tbody tr {
            border-bottom: 1px solid #e5e7eb;
        }

        .table-schedule tbody td {
            padding: 0.8rem !important;
            vertical-align: middle;
            height: 70px;
        }

        .tiet-col {
            width: 70px;
            background: linear-gradient(135deg, #f9fafb 0%, #f3f4f6 100%);
            font-weight: 700;
            color: #667eea;
            text-align: center;
            border-right: 2px solid #e5e7eb;
        }

        /* Class cell */
        .bg-class {
            background: linear-gradient(135deg, #fef3c7 0%, #fde68a 100%);
            border-left: 4px solid #6fa1f7ff;
            color: #78350f;
            padding: 10px;
            border-radius: 8px;
            text-align: left;
            transition: all 0.3s ease;
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: center;
            box-shadow: 0 2px 8px rgba(245, 158, 11, 0.2);
        }

        .bg-class:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 16px rgba(245, 158, 11, 0.3);
            background: linear-gradient(135deg, #fcd34d 0%, #fbbf24 100%);
        }

        .bg-class .course-name {
            font-weight: 700;
            font-size: 0.9rem;
            color: #d97706;
            text-transform: uppercase;
            margin-bottom: 0.4rem;
        }

        .bg-class .course-room {
            font-size: 0.8rem;
            margin-bottom: 0.3rem;
        }

        .bg-class .course-teacher {
            font-size: 0.75rem;
            color: #92400e;
            font-style: italic;
            margin-bottom: 0.3rem;
        }

        .bg-class .course-code {
            font-size: 0.7rem;
            color: #b45309;
            opacity: 0.8;
        }

        /* Separator row */
        .table-schedule .separator-row {
            background-color: #f3f4f6;
            height: 8px !important;
        }

        .table-schedule .separator-row td {
            padding: 0 !important;
            border: none !important;
        }

        /* Empty cell */
        .table-schedule tbody td:empty {
            background-color: #fafafa;
        }

        /* Footer */
        .schedule-footer {
            text-align: center;
            margin-top: 2rem;
            color: #6b7280;
            font-size: 0.9rem;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .schedule-header {
                flex-direction: column;
                gap: 1rem;
                text-align: center;
            }

            .schedule-header h3 {
                font-size: 1.3rem;
            }

            .table-schedule thead th {
                padding: 0.8rem !important;
                font-size: 0.8rem;
            }

            .table-schedule tbody td {
                padding: 0.6rem !important;
                height: auto;
                min-height: 50px;
            }

            .tiet-col {
                width: 50px;
                padding: 0.6rem !important;
                font-size: 0.9rem;
            }

            .bg-class {
                padding: 0.6rem;
            }

            .bg-class .course-name {
                font-size: 0.75rem;
            }

            .bg-class .course-room {
                font-size: 0.7rem;
            }

            .bg-class .course-teacher {
                font-size: 0.65rem;
            }

            .bg-class .course-code {
                font-size: 0.6rem;
            }
        }

        /* Animation */
        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .card {
            animation: slideIn 0.5s ease-out;
        }

        /* Print */
        @media print {
            body {
                background: white !important;
            }

            .schedule-header,
            .schedule-footer {
                display: none !important;
            }

            .card {
                box-shadow: none !important;
            }
        }
    </style>
    <link href="assets/css/style.css" rel="stylesheet">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark mb-4">
    <div class="container">
        <a class="navbar-brand" href="index.php?page=dashboard">
            <i class="fas fa-calendar-alt me-2"></i>CỔNG SINH VIÊN
        </a>
        <div class="d-flex align-items-center gap-3 text-white">
            <span class="d-none d-md-block">
                <i class="fas fa-user-circle me-1"></i>Xin chào, <?php echo htmlspecialchars($_SESSION['user_name'] ?? 'Sinh viên'); ?>
            </span>
            <a href="index.php?page=dashboard" class="btn btn-sm btn-light fw-bold">
                <i class="fas fa-home me-1"></i>Dashboard
            </a>
            <a href="index.php?page=logout" class="btn btn-sm btn-outline-light fw-bold">
                <i class="fas fa-sign-out-alt me-1"></i>Đăng xuất
            </a>
        </div>
    </div>
</nav>

<div class="container pb-5">
    <div class="schedule-header">
        <h3>
            <i class="fas fa-calendar-check me-2"></i>THỜI KHÓA BIỂU CÁ NHÂN
        </h3>
        <button onclick="window.print()" class="btn btn-print btn-sm">
            <i class="fas fa-file-pdf me-2"></i>In lịch học
        </button>
    </div>
    
    <div class="alert alert-info shadow-sm">
        <small>
            <i class="fas fa-info-circle me-2"></i>
            Thời khóa biểu hiển thị dựa trên các học phần thuộc Kế hoạch <b>ĐÃ ĐƯỢC DUYỆT</b>
        </small>
    </div>

    <div class="card shadow">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-bordered table-schedule mb-0">
                    <thead>
                        <tr>
                            <th class="tiet-col">
                                <i class="fas fa-clock me-1"></i>Tiết
                            </th>
                            <th width="13%">
                                <i class="fas fa-calendar-day me-1"></i>Thứ 2
                            </th>
                            <th width="13%">
                                <i class="fas fa-calendar-day me-1"></i>Thứ 3
                            </th>
                            <th width="13%">
                                <i class="fas fa-calendar-day me-1"></i>Thứ 4
                            </th>
                            <th width="13%">
                                <i class="fas fa-calendar-day me-1"></i>Thứ 5
                            </th>
                            <th width="13%">
                                <i class="fas fa-calendar-day me-1"></i>Thứ 6
                            </th>
                            <th width="13%">
                                <i class="fas fa-calendar-day me-1"></i>Thứ 7
                            </th>
                            <th width="13%">
                                <i class="fas fa-sun me-1"></i>CN
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        // Duyệt từ Tiết 1 đến Tiết 12 (Sáng + Chiều + Tối)
                        for ($tiet = 1; $tiet <= 12; $tiet++): 
                        ?>
                        <tr>
                            <td class="tiet-col"><?php echo $tiet; ?></td>
                            
                            <?php 
                            // Duyệt từ Thứ 2 (2) đến Chủ nhật (8)
                            for ($thu = 2; $thu <= 8; $thu++): 
                                
                                // Kiểm tra dữ liệu từ Controller
                                $cell = $scheduleMatrix[$thu][$tiet] ?? null;

                                // TRƯỜNG HỢP 1: Ô bị gộp (do môn học ở tiết trước kéo dài xuống)
                                if ($cell === 'skip') {
                                    continue; // Bỏ qua, không vẽ thẻ <td>
                                }
                                
                                // TRƯỜNG HỢP 2: Ô có môn học (Bắt đầu)
                                if (is_array($cell)) {
                                    ?>
                                    <td rowspan="<?php echo $cell['SoTiet']; ?>" class="p-1">
                                        <div class="bg-class">
                                            <div class="course-name">
                                                <?php echo htmlspecialchars($cell['TenHP']); ?>
                                            </div>
                                            <div class="course-room">
                                                <i class="fas fa-door-open me-1"></i>Phòng: <span class="fw-bold"><?php echo htmlspecialchars($cell['Phong']); ?></span>
                                            </div>
                                            <div class="course-teacher">
                                                <i class="fas fa-chalkboard-user me-1"></i><?php echo htmlspecialchars($cell['GV']); ?>
                                            </div>
                                            <div class="course-code">
                                                (<?php echo htmlspecialchars($cell['MaHP']); ?>)
                                            </div>
                                        </div>
                                    </td>
                                    <?php
                                } 
                                // TRƯỜNG HỢP 3: Ô trống
                                else {
                                    echo "<td></td>";
                                }
                            endfor; 
                            ?>
                        </tr>
                        
                        <?php if ($tiet == 5 || $tiet == 10): ?>
                            <tr class="separator-row"><td colspan="8"></td></tr>
                        <?php endif; ?>

                        <?php endfor; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    
    <div class="schedule-footer">
        <i class="fas fa-graduation-cap me-1"></i>Hệ thống Quản lý Học tập - Trường Đại học Trà Vinh
    </div>
</div>

</body>
</html>