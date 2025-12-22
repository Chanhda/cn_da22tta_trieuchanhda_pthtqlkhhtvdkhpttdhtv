<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Cố vấn Học tập - Duyệt kế hoạch</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root{ --accent:#3b82f6; --muted:#6b7280; --surface:#ffffff; --bg:#f6f8fb; }
        body{ background:var(--bg); font-family: "Segoe UI", Tahoma, Arial, sans-serif; color:#0f172a; }
        .navbar{ background:var(--surface) !important; border-bottom:3px solid var(--accent); padding:12px 0; }
        .navbar-brand{ color:var(--accent) !important; font-weight:700; font-size:18px; }
        .navbar-text{ color:#334155; font-weight:600; }
        .btn-warning{ background:linear-gradient(90deg,#f59e0b,#f97316); color:#fff; border:none; }
        .btn-light{ background:#fff; color:var(--accent); border:1px solid #e6eefc; }
        .container{ padding:26px 20px; }
        .card{ border-radius:10px; border:1px solid #eef2ff; background:var(--surface); box-shadow:0 6px 18px rgba(15,23,42,0.04); }
        .card-header{ background:transparent; border-bottom:1px solid #f1f5f9; font-weight:700; padding:14px 18px; }
        .card-body{ padding:16px 18px; }
        .stats-card{ text-align:center; padding:22px; }
        .stats-card .display-4{ font-size:40px; font-weight:800; color:var(--accent); }
        .stats-card .text-muted{ color:#475569; font-weight:600; }
        .table thead th{ background:transparent; color:#0f172a; font-weight:700; border-bottom:2px solid #eef2ff; }
        .table tbody tr:hover{ background:#fbfdff; }
        .badge.custom{ background:#eef2ff; color:var(--accent); font-weight:700; border-radius:8px; }
        .btn{ border-radius:8px; font-weight:700; }
        .btn-success{ background:linear-gradient(90deg,#2563eb,#3b82f6); color:#fff; border:none; }
        .btn-danger{ background:linear-gradient(90deg,#ef4444,#dc2626); color:#fff; border:none; }
        @media (max-width:768px){ .container{ padding:18px 10px; } }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg mb-4">
    <div class="container">
        <a class="navbar-brand" href="#">🎓 CỐ VẤN HỌC TẬP</a>
        <div class="d-flex align-items-center">
            <span class="navbar-text text-white me-3">
                Xin chào, <?php echo htmlspecialchars($_SESSION['user_name']); ?>
            </span>
            <a href="index.php?page=change_password" class="btn btn-sm btn-warning text-dark fw-bold me-2">🔐 Đổi mật khẩu</a>
            <a href="index.php?page=logout" class="btn btn-sm btn-light fw-bold text-primary">Đăng xuất</a>
        </div>
    </div>
</nav>

<div class="container">
    <div class="row">
        <div class="col-md-3 mb-4">
            <div class="card stats-card">
                <div class="card-body">
                    <div class="display-4"><?php echo count($dsChoDuyet); ?></div>
                    <div class="text-muted"><i class="fas fa-hourglass-half me-2"></i>Yêu cầu đang chờ duyệt</div>
                    <hr>
                    <small class="text-secondary">Hãy kiểm tra kỹ các môn học trước khi Duyệt.</small>
                </div>
            </div>
        </div>

        <div class="col-md-9">
            <div class="card shadow border-0">
                <div class="card-header">
                    <span>📋 Danh sách Kế hoạch Chờ duyệt</span>
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
                            // --- SỬA LỖI HIỆU NĂNG ---
                            // Khởi tạo Model 1 lần DUY NHẤT ở đây, KHÔNG để trong vòng lặp
                            // (Biến $model này có thể đã được truyền từ Controller, nếu chưa thì khởi tạo mới)
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
                                            // Tái sử dụng $advisorModel đã tạo bên trên
                                            $details = $advisorModel->getPlanDetails($kh['ID_KeHoach']);
                                            $tongTC = 0;
                                            foreach($details as $d) $tongTC += $d['SoTinChi'];
                                        ?>
                                        <span class="fw-bold" style="color:var(--accent);"><?php echo count($details); ?> môn</span>
                                        <span class="text-muted">| <?php echo $tongTC; ?> TC</span>
                                        <br>
                                        <a href="#" class="small text-decoration-none" data-bs-toggle="modal" data-bs-target="#modalDetails<?php echo $kh['ID_KeHoach']; ?>">
                                            👁️ Xem chi tiết
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
                                        <h5 class="fw-light">Hiện tại không có yêu cầu nào cần duyệt.</h5>
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>