<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Cố vấn Học tập</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root{ --accent:#3b82f6; --muted:#6b7280; --surface:#ffffff; --bg:#f6f8fb; }
        body{ background:var(--bg); font-family: "Segoe UI", Tahoma, Arial, sans-serif; color:#0f172a; }
        
        /* Navbar Style */
        .navbar{ background:var(--surface) !important; border-bottom:3px solid var(--accent); padding:12px 0; }
        .navbar-brand{ color:var(--accent) !important; font-weight:700; font-size:18px; }
        .navbar-text{ color:#334155; font-weight:600; }
        .btn-warning{ background:#f59e0b; border:none; color:#fff; }
        .btn-warning:hover{ background:#d97706; }
        .btn-outline-danger{ color:#dc2626; border-color:#dc2626; }
        .btn-outline-danger:hover{ background:#dc2626; border-color:#dc2626; color:#fff; }
        
        /* Card Style */
        .card{ border-radius:10px; border:1px solid #eef2ff; background:var(--surface); box-shadow:0 6px 18px rgba(15,23,42,0.04); transition:transform .12s ease; }
        .card:hover{ transform:translateY(-3px); }
        .card-header{ background:transparent; border-bottom:1px solid #f1f5f9; font-weight:700; padding:14px 18px; color:#0f172a; }
        .card-body{ padding:16px 18px; }
        
        /* Stats Card */
        .stats-card{ text-align:center; padding:22px; }
        .stats-card .display-4{ font-size:40px; font-weight:800; color:var(--accent); }
        .stats-card .text-muted{ color:#475569; font-weight:600; }
        
        /* Action Card */
        .action-card{ text-align:center; padding:20px; }
        .action-card i{ font-size:32px; color:#cbd5e1; margin-bottom:12px; }
        .action-card p{ color:#64748b; margin:12px 0; }
        
        /* Table */
        .table{ margin-bottom:0; }
        .table thead th{ background:transparent; color:#0f172a; font-weight:700; border-bottom:2px solid #eef2ff; }
        .table tbody tr{ border-bottom:1px solid #f1f5f9; transition:all .12s ease; }
        .table tbody tr:hover{ background:#fbfdff; }
        .table tbody td{ padding:12px; vertical-align:middle; }
        .table tbody td .fw-bold{ color:var(--accent); }
        .table tbody td .text-primary{ color:var(--accent); }
        .badge{ border-radius:8px; padding:6px 10px; font-weight:700; font-size:12px; }
        .badge.bg-secondary{ background:#cbd5e1; }
        
        /* Modals */
        .modal-content{ border-radius:10px; border:1px solid #eef2ff; }
        .modal-header{ border-bottom:1px solid #f1f5f9; }
        .modal-body{ padding:16px; }
        .modal-footer{ border-top:1px solid #f1f5f9; }
        .modal-header.bg-danger{ background:linear-gradient(90deg,#ef4444,#dc2626); color:#fff; }
        
        /* Buttons */
        .btn-success{ background:linear-gradient(90deg,#2563eb,#3b82f6); color:#fff; border:none; }
        .btn-success:hover{ background:linear-gradient(90deg,#1d4ed8,#2563eb); }
        .btn-danger{ background:linear-gradient(90deg,#ef4444,#dc2626); color:#fff; border:none; }
        .btn-danger:hover{ background:linear-gradient(90deg,#f87171,#ef4444); }
        .btn-secondary{ background:#94a3b8; color:#fff; border:none; }
        .btn-secondary:hover{ background:#7c8fa8; }
        
        @media (max-width:768px){ .container{ padding:18px 10px; } }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg mb-4">
    <div class="container">
        <a class="navbar-brand" href="#">
            <i class="fas fa-user-tie me-2"></i>CỐ VẤN HỌC TẬP
        </a>
        
        <div class="d-flex align-items-center ms-auto">
            <span class="navbar-text me-3 d-none d-md-block">
                Xin chào, <?= $_SESSION['username'] ?? 'Giảng viên' ?>
            </span>
            <a href="index.php?page=change_password" class="btn btn-sm btn-warning text-white fw-bold me-2">
                <i class="fas fa-key"></i> Đổi mật khẩu
            </a>
            <a href="index.php?page=logout" class="btn btn-sm btn-outline-danger fw-bold">
                <i class="fas fa-sign-out-alt"></i> Đăng xuất
            </a>
        </div>
    </div>
</nav>

<div class="container">
    
    <div class="row g-4 mb-4">
        
        <div class="col-md-5 col-lg-4">
            <div class="card h-100">
                <div class="card-header">
                    <i class="fas fa-users me-2"></i> Quản lý sinh viên
                </div>
                <div class="card-body action-card d-flex flex-column justify-content-center">
                    <div>
                        <i class="fas fa-user-graduate"></i>
                    </div>
                    <p>
                        Xem danh sách lớp chủ nhiệm và xét duyệt tiến độ học tập.
                    </p>
                    <a href="index.php?page=advisor_student_list" class="btn btn-sm btn-primary fw-bold" style="background:var(--accent); border:none; align-self:center;">
                        <i class="fas fa-tasks me-1"></i> Danh sách & Xét duyệt
                    </a>
                </div>
            </div>
        </div>

        <div class="col-md-7 col-lg-8">
            <div class="card h-100 stats-card d-flex align-items-center justify-content-center">
                <div class="text-center">
                    <div class="display-4 mb-2"><?php echo isset($dsChoDuyet) ? count($dsChoDuyet) : 0; ?></div>
                    <div class="text-muted"><i class="fas fa-clock me-2"></i>Yêu cầu đang chờ duyệt</div>
                    <p class="small text-secondary mt-2">Cập nhật theo thời gian thực</p>
                </div>
            </div>
        </div>
    </div>

    <div class="card shadow border-0">
        <div class="card-header">
            <h5 class="mb-0 fw-bold">
                <i class="fas fa-file-signature me-2"></i>Danh sách Kế hoạch Chờ duyệt
            </h5>
        </div>
        <div class="card-body p-0">
            <table class="table table-hover mb-0 align-middle">
                <thead>
                    <tr>
                        <th>Sinh viên</th>
                        <th>Lớp</th>
                        <th>Ngày lập</th>
                        <th>Chi tiết môn học</th>
                        <th class="text-end">Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    // Khởi tạo Model (Kiểm tra nếu chưa có)
                    if (!isset($model)) {
                        $advisorModel = new AdvisorModel(); 
                    } else {
                        $advisorModel = $model;
                    }
                    ?>

                    <?php if (!empty($dsChoDuyet)): ?>
                        <?php foreach ($dsChoDuyet as $kh): ?>
                        <tr>
                            <td>
                                <div class="fw-bold"><?php echo htmlspecialchars($kh['HoTen']); ?></div>
                                <small class="text-muted"><?php echo htmlspecialchars($kh['MSSV']); ?></small>
                            </td>
                            <td><span class="badge bg-secondary"><?php echo htmlspecialchars($kh['MaLop']); ?></span></td>
                            <td><?php echo date('d/m/Y', strtotime($kh['NgayLap'])); ?></td>
                            
                            <td>
                                <?php 
                                    // Lấy chi tiết kế hoạch
                                    $details = $advisorModel->getPlanDetails($kh['ID_KeHoach']);
                                    $tongTC = 0;
                                    foreach($details as $d) $tongTC += $d['SoTinChi'];
                                ?>
                                <span class="fw-bold text-primary"><?php echo count($details); ?> môn</span>
                                <span class="text-muted"> | <?php echo $tongTC; ?> TC</span>
                                <br>
                                <a href="#" class="small text-decoration-none" data-bs-toggle="modal" data-bs-target="#modalDetails<?php echo $kh['ID_KeHoach']; ?>">
                                    <i class="fas fa-eye me-1"></i>Xem chi tiết
                                </a>

                                <div class="modal fade" id="modalDetails<?php echo $kh['ID_KeHoach']; ?>" tabindex="-1">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Chi tiết: <?php echo htmlspecialchars($kh['HoTen']); ?></h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>
                                            <div class="modal-body">
                                                <table class="table table-sm table-bordered">
                                                    <thead class="table-primary">
                                                        <tr>
                                                            <th>Mã HP</th>
                                                            <th>Tên học phần</th>
                                                            <th>Số TC</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php foreach($details as $d): ?>
                                                        <tr>
                                                            <td><?php echo htmlspecialchars($d['MaHocPhan']); ?></td>
                                                            <td><?php echo htmlspecialchars($d['TenHocPhan']); ?></td>
                                                            <td class="text-center"><?php echo $d['SoTinChi']; ?></td>
                                                        </tr>
                                                        <?php endforeach; ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>

                            <td class="text-end">
                                <a href="index.php?page=advisor_approve&id=<?php echo $kh['ID_KeHoach']; ?>" 
                                   class="btn btn-success btn-sm fw-bold me-1"
                                   onclick="return confirm('Xác nhận DUYỆT kế hoạch này?');">
                                   <i class="fa fa-check"></i> Duyệt
                                </a>

                                <button type="button" class="btn btn-danger btn-sm fw-bold" 
                                        data-bs-toggle="modal" data-bs-target="#rejectModal<?php echo $kh['ID_KeHoach']; ?>">
                                    <i class="fa fa-times"></i> Từ chối
                                </button>

                                <div class="modal fade text-start" id="rejectModal<?php echo $kh['ID_KeHoach']; ?>" tabindex="-1">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <form action="index.php?page=advisor_reject" method="POST">
                                                <div class="modal-header bg-danger text-white">
                                                    <h5 class="modal-title">Từ chối Kế hoạch</h5>
                                                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <input type="hidden" name="id_kehoach" value="<?php echo $kh['ID_KeHoach']; ?>">
                                                    <div class="mb-3">
                                                        <label class="form-label fw-bold">Lý do từ chối:</label>
                                                        <textarea name="ly_do" class="form-control" rows="3" required placeholder="Nhập lý do..."></textarea>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                                                    <button type="submit" class="btn btn-danger fw-bold">Xác nhận</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5" class="text-center py-5 text-muted">
                                <i class="fas fa-check-circle fa-3x text-success mb-3 opacity-50"></i>
                                <h5 class="fw-light">Hiện tại không có yêu cầu nào cần duyệt.</h5>
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>