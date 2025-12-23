<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Lớp tôi quản lý</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<style>
    :root{ --accent:#3b82f6; --surface:#ffffff; --bg:#f6f8fb; }
    body{ background:var(--bg); font-family: "Segoe UI", Tahoma, Arial, sans-serif; color:#0f172a; }
    .navbar{ background:var(--surface) !important; border-bottom:3px solid var(--accent); padding:12px 0; }
    .navbar-brand{ color:var(--accent) !important; font-weight:700; font-size:18px; }
    .navbar-text{ color:#334155; font-weight:600; }
    .btn-outline-danger{ color:#dc2626; border-color:#dc2626; }
    .btn-outline-danger:hover{ background:#dc2626; border-color:#dc2626; color:#fff; }
    .container{ padding:26px 20px; }
    .card{ border-radius:10px; border:1px solid #eef2ff; background:var(--surface); box-shadow:0 6px 18px rgba(15,23,42,0.04); }
    .card-header{ background:transparent; border-bottom:1px solid #f1f5f9; font-weight:700; padding:14px 18px; color:#0f172a; }
    .card-body{ padding:16px 18px; }
    .alert{ border-radius:10px; border:none; padding:18px; text-align:center; font-weight:600; }
    .alert-warning{ background:#fef3c7; color:#92400e; }
    .alert-warning i{ margin-right:8px; }
    .table{ margin-bottom:0; }
    .table thead th{ background:transparent; color:#0f172a; font-weight:700; border-bottom:2px solid #eef2ff; }
    .table tbody tr{ border-bottom:1px solid #f1f5f9; transition:all .12s ease; }
    .table tbody tr:hover{ background:#fbfdff; }
    .table tbody td{ padding:12px; vertical-align:middle; }
    .table tbody td.fw-bold{ color:var(--accent); }
    .badge{ border-radius:8px; padding:6px 10px; font-weight:700; font-size:12px; background:#eef2ff; color:var(--accent); }
    .btn-info{ background:linear-gradient(90deg,#2563eb,#3b82f6); color:#fff; border:none; font-weight:700; }
    .btn-info:hover{ background:linear-gradient(90deg,#1d4ed8,#2563eb); }
    @media (max-width:768px){ .container{ padding:18px 10px; } }
</style>
</head>
<body>

<nav class="navbar navbar-expand-lg mb-4">
    <div class="container">
        <a class="navbar-brand" href="#">
            <i class="fas fa-chalkboard-teacher me-2"></i>CỐ VẤN HỌC TẬP
        </a>
        <div class="d-flex align-items-center gap-3">
            <span class="navbar-text">
                Xin chào, <?= $_SESSION['username'] ?? 'Giảng viên' ?>
            </span>
            <a href="index.php?page=logout" class="btn btn-outline-danger btn-sm">
                <i class="fas fa-sign-out-alt me-1"></i>Đăng xuất
            </a>
        </div>
    </div>
</nav>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0"><i class="fas fa-chalkboard-teacher me-2"></i>Lớp tôi quản lý</h5>
                </div>
                <div class="card-body">
                    <?php if(empty($dsLop)): ?>
                        <div class="alert alert-warning">
                            <i class="fas fa-inbox"></i> Bạn chưa được phân công chủ nhiệm lớp nào.
                        </div>
                    <?php else: ?>
                        <div class="table-responsive">
                            <table class="table table-hover align-middle">
                                <thead>
                                    <tr>
                                        <th><i class="fas fa-key me-2"></i>Mã Lớp</th>
                                        <th><i class="fas fa-graduation-cap me-2"></i>Tên Lớp</th>
                                        <th class="text-center"><i class="fas fa-users me-2"></i>Số lượng SV</th>
                                        <th class="text-end"><i class="fas fa-cogs me-2"></i>Hành động</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($dsLop as $lop): ?>
                                    <tr>
                                        <td class="fw-bold"><?php echo $lop['MaLop']; ?></td>
                                        <td><?php echo $lop['TenLop']; ?></td>
                                        <td class="text-center">
                                            <span class="badge"><i class="fas fa-user-circle me-1"></i>--</span> 
                                        </td>
                                        <td class="text-end">
                                            <a href="#" class="btn btn-sm btn-info">
                                                <i class="fas fa-users me-1"></i> Xem SV
                                            </a>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>