<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Danh sách Sinh viên - Cố vấn Học tập</title>
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
        .card-body{ padding:0; }
        .table thead th{ background:transparent; color:#0f172a; font-weight:700; border-bottom:2px solid #eef2ff; padding:14px; }
        .table tbody td{ padding:12px 14px; vertical-align:middle; }
        .table tbody tr:hover{ background:#fbfdff; }
        .badge{ border-radius:8px; padding:6px 10px; font-weight:700; font-size:12px; }
        .student-link{ color:var(--accent); font-weight:600; text-decoration:none; }
        .student-link:hover{ text-decoration:underline; }
        .btn-check-progress{ background:linear-gradient(90deg,#2563eb,#3b82f6); color:#fff; border:none; font-weight:700; }
        .btn-check-progress:hover{ background:linear-gradient(90deg,#1d4ed8,#2563eb); }
        @media (max-width:768px){ .container{ padding:18px 10px; } }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg">
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

<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold mb-1">Danh sách Sinh viên Quản lý</h2>
            <p class="text-muted small mb-0">Quản lý và xét duyệt tiến độ học tập</p>
        </div>
    </div>

    <div class="card">
        <div class="card-body p-0">
            <table class="table table-hover align-middle mb-0">
                <thead>
                    <tr>
                        <th>MSSV</th>
                        <th>Họ và Tên</th>
                        <th>Lớp</th>
                        <th>Email</th>
                        <th>Chương Trình</th>
                        <th class="text-center">Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($dsSinhVien)): ?>
                        <?php foreach ($dsSinhVien as $sv): ?>
                        <tr>
                            <td class="fw-bold"><?= $sv['MSSV'] ?></td>
                            
                            <td>
                                <a href="index.php?page=advisor_check_progress&mssv=<?= $sv['MSSV'] ?>" class="student-link">
                                    <i class="fas fa-user-graduate me-1"></i><?= $sv['HoTen'] ?>
                                </a>
                            </td>

                            <td><span class="badge bg-light text-dark border"><?= $sv['MaLop'] ?></span></td>
                            <td class="small"><?= $sv['Email'] ?></td>
                            <td><small><?= $sv['MaCTDT'] ?? 'CNTT' ?></small></td>
                            
                            <td class="text-center">
                                <a href="index.php?page=advisor_check_progress&mssv=<?= $sv['MSSV'] ?>" class="btn btn-sm btn-check-progress">
                                    <i class="fas fa-tasks me-1"></i> Xét duyệt
                                </a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6" class="text-center py-5 text-muted">
                                <p class="mt-3">Chưa có sinh viên nào trong danh sách quản lý.</p>
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