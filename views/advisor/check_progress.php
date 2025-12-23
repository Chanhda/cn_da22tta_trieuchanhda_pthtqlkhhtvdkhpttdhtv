<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Xét Duyệt Tiến Độ</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root{ --accent:#3b82f6; --surface:#ffffff; --bg:#f6f8fb; }
        body{ background:var(--bg); font-family: "Segoe UI", Tahoma, Arial, sans-serif; color:#0f172a; }
        .navbar{ background:var(--surface) !important; border-bottom:3px solid var(--accent); padding:12px 0; }
        .navbar-brand{ color:var(--accent) !important; font-weight:700; font-size:18px; }
        .navbar-text{ color:#334155; font-weight:600; }
        .btn-outline-light{ color:#fff; border-color:#fff; }
        .btn-outline-light:hover{ background:#fff; color:var(--accent); }
        .container{ padding:26px 20px; margin-top:0; }
        .card{ border-radius:10px; border:1px solid #eef2ff; background:var(--surface); box-shadow:0 6px 18px rgba(15,23,42,0.04); }
        .card-header{ background:transparent; border-bottom:1px solid #f1f5f9; font-weight:700; padding:14px 18px; color:#0f172a; display:flex; justify-content:space-between; align-items:center; }
        .card-header h5{ margin:0; }
        .card-body{ padding:16px 18px; }
        .table{ margin-bottom:0; }
        .table thead th{ background:transparent; color:#0f172a; font-weight:700; border-bottom:2px solid #eef2ff; }
        .table tbody tr{ border-bottom:1px solid #f1f5f9; transition:all .12s ease; }
        .table tbody tr:hover{ background:#fbfdff; }
        .table tbody td{ padding:12px; vertical-align:middle; }
        .badge{ border-radius:8px; padding:6px 10px; font-weight:700; font-size:12px; }
        .badge.bg-success{ background:#10b981; }
        .badge.bg-secondary{ background:#cbd5e1; }
        .btn{ border-radius:8px; padding:6px 12px; font-weight:700; font-size:13px; border:none; }
        .btn-outline-danger{ color:#dc2626; border-color:#dc2626; }
        .btn-outline-danger:hover{ background:#dc2626; border-color:#dc2626; color:#fff; }
        .btn-success{ background:linear-gradient(90deg,#2563eb,#3b82f6); color:#fff; }
        .btn-success:hover{ background:linear-gradient(90deg,#1d4ed8,#2563eb); }
        .btn-light{ background:#fff; color:var(--accent); border:1px solid #eef2ff; }
        .btn-light:hover{ background:#f8f9ff; }
        @media (max-width:768px){ .container{ padding:18px 10px; } }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg mb-4">
    <div class="container">
        <a class="navbar-brand" href="#">
            <i class="fas fa-chalkboard-teacher me-2"></i>CỐ VẤN HỌC TẬP
        </a>
    </div>
</nav>

<div class="container">
    <div class="card">
        <div class="card-header">
            <h5><i class="fas fa-tasks me-2"></i>Xét Duyệt Tiến Độ: <?= $_GET['mssv'] ?></h5>
            <a href="index.php?page=advisor_dashboard" class="btn btn-sm btn-light">
                <i class="fas fa-arrow-left me-1"></i>Quay lại
            </a>
        </div>
        <div class="card-body">
            <table class="table table-hover align-middle">
                <thead>
                    <tr>
                        <th>Mã HP</th>
                        <th>Tên Học Phần</th>
                        <th class="text-center">Số TC</th>
                        <th class="text-center">Trạng Thái Hiện Tại</th>
                        <th class="text-center">Hành Động</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($transcript as $row): ?>
                        <tr>
                            <td><?= $row['MaHocPhan'] ?></td>
                            <td><?= $row['TenHocPhan'] ?></td>
                            <td class="text-center"><?= $row['SoTinChi'] ?></td>
                            
                            <td class="text-center">
                                <?php if ($row['TrangThai'] == 'Dat'): ?>
                                    <span class="badge bg-success"><i class="fas fa-check me-1"></i>Đã Đạt</span>
                                <?php else: ?>
                                    <span class="badge bg-secondary"><i class="fas fa-clock me-1"></i>Chưa Đạt</span>
                                <?php endif; ?>
                            </td>

                            <td class="text-center">
                                <?php if ($row['TrangThai'] == 'Dat'): ?>
                                    <a href="index.php?page=advisor_toggle_status&mssv=<?= $_GET['mssv'] ?>&mahp=<?= $row['MaHocPhan'] ?>&status=KhongDat" 
                                       class="btn btn-outline-danger btn-sm">
                                       <i class="fas fa-times me-1"></i> Hủy Đạt
                                    </a>
                                <?php else: ?>
                                    <a href="index.php?page=advisor_toggle_status&mssv=<?= $_GET['mssv'] ?>&mahp=<?= $row['MaHocPhan'] ?>&status=Dat" 
                                       class="btn btn-success btn-sm">
                                       <i class="fas fa-check me-1"></i> Xác Nhận Đạt
                                    </a>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>