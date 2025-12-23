<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý Cố vấn học tập</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { background: #f3f4f6; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
        .navbar { background: white !important; box-shadow: 0 2px 12px rgba(0, 0, 0, 0.08) !important; padding: 16px 0 !important; border-bottom: 3px solid #3b82f6; }
        .navbar-brand { font-weight: 900 !important; font-size: 20px !important; color: #1e40af !important; display: flex; align-items: center; gap: 12px; letter-spacing: 0.5px; }
        .navbar-brand i { color: #3b82f6; }
        .nav-link { color: #6b7280 !important; font-weight: 600; transition: all 0.3s ease; position: relative; }
        .nav-link::after { content: ''; position: absolute; bottom: -8px; left: 0; width: 0; height: 3px; background: #3b82f6; transition: width 0.3s ease; }
        .nav-link:hover { color: #3b82f6 !important; }
        .nav-link:hover::after { width: 100%; }
        .nav-link.active { color: #3b82f6 !important; }
        .nav-link.active::after { width: 100%; }
        .navbar-text { font-weight: 600; color: #374151 !important; }
        .btn-outline-light { border: 2px solid #e5e7eb !important; color: #374151 !important; font-weight: 700; background: white; transition: all 0.3s ease; }
        .btn-outline-light:hover { background: #3b82f6 !important; color: white !important; border-color: #3b82f6 !important; transform: translateY(-2px); }
        .container { padding: 40px 20px; max-width: 1200px; }
        .page-header { margin-bottom: 40px; }
        .page-title { font-size: 32px; font-weight: 900; color: #1f2937; margin-bottom: 8px; }
        .page-subtitle { color: #6b7280; font-size: 16px; }
        .header-actions { display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px; }
        .btn-add { background: linear-gradient(135deg, #3b82f6 0%, #1e40af 100%); border: none !important; border-radius: 10px !important; padding: 12px 28px !important; font-weight: 700 !important; color: white; box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3); transition: all 0.3s ease; }
        .btn-add:hover { transform: translateY(-2px); box-shadow: 0 8px 20px rgba(59, 130, 246, 0.4); background: linear-gradient(135deg, #1e40af 0%, #1e3a8a 100%) !important; }
        .search-box { position: relative; }
        .search-box input { border-radius: 10px !important; border: 2px solid #e5e7eb !important; padding: 12px 16px 12px 40px !important; font-size: 15px; transition: all 0.3s ease; }
        .search-box input:focus { border-color: #3b82f6 !important; box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1) !important; }
        .search-box i { position: absolute; left: 14px; top: 50%; transform: translateY(-50%); color: #9ca3af; }
        .table-card { background: white; border-radius: 16px; box-shadow: 0 2px 12px rgba(0, 0, 0, 0.08); overflow: hidden; animation: slideUp 0.5s ease-out; }
        .table { margin-bottom: 0 !important; }
        .table thead { background: linear-gradient(135deg, #eff6ff 0%, #f0f9ff 100%); border-bottom: 2px solid #bfdbfe !important; }
        .table thead th { color: #1e40af; padding: 18px 16px !important; font-weight: 700; font-size: 13px; border: none !important; letter-spacing: 0.5px; text-transform: uppercase; }
        .table tbody tr { border-bottom: 1px solid #e5e7eb !important; transition: all 0.3s ease; }
        .table tbody tr:hover { background: #f3f4f6 !important; transform: scale(1.01); }
        .table tbody tr:nth-child(even) { background: #fafbfc; }
        .table tbody td { padding: 16px !important; color: #1f2937; vertical-align: middle; font-size: 14px; }
        .advisor-code { font-weight: 700; color: #3b82f6; }
        .btn-delete { background: #fee2e2 !important; color: #dc2626 !important; border: none !important; border-radius: 8px !important; padding: 8px 14px !important; font-weight: 700; font-size: 12px; transition: all 0.3s ease; }
        .btn-delete:hover { background: #dc2626 !important; color: white !important; transform: translateY(-2px); }
        .empty-state { text-align: center; padding: 60px 20px; }
        .empty-state i { font-size: 64px; color: #d1d5db; margin-bottom: 16px; }
        .empty-state p { color: #9ca3af; font-size: 16px; }
        .modal-content { border-radius: 16px !important; border: none !important; box-shadow: 0 20px 60px rgba(0, 0, 0, 0.2) !important; }
        .modal-header { background: linear-gradient(135deg, #3b82f6 0%, #1e40af 100%); color: white !important; border: none !important; padding: 24px !important; }
        .modal-title { font-weight: 800; font-size: 20px; }
        .btn-close-white { filter: brightness(0) invert(1) !important; }
        .modal-body { padding: 28px !important; background: #f9fafb; }
        .modal-footer { background: #f9fafb; border: none !important; padding: 16px 28px !important; }
        .form-label { color: #374151; font-weight: 700 !important; margin-bottom: 10px; font-size: 14px; }
        .form-label .text-danger { color: #dc2626 !important; margin-left: 4px; }
        .form-control { border-radius: 10px !important; border: 2px solid #e5e7eb !important; padding: 12px 14px !important; font-size: 14px; transition: all 0.3s ease; background: white; }
        .form-control:focus { border-color: #3b82f6 !important; box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1) !important; background: white !important; }
        .password-section { background: #fef3c7; border: 2px solid #fcd34d; border-radius: 10px; padding: 16px; margin-top: 20px; }
        .password-section .form-label { color: #92400e; margin-bottom: 10px; }
        .password-section .form-control { background: white; border-color: #fcd34d; }
        .btn-save { background: linear-gradient(135deg, #3b82f6 0%, #1e40af 100%); border: none !important; color: white !important; border-radius: 10px; padding: 10px 24px !important; font-weight: 700; transition: all 0.3s ease; }
        .btn-save:hover { transform: translateY(-2px); box-shadow: 0 6px 16px rgba(59, 130, 246, 0.3); }
        .btn-cancel { background: #e5e7eb; border: none !important; color: #374151 !important; border-radius: 10px; padding: 10px 24px !important; font-weight: 700; transition: all 0.3s ease; }
        .btn-cancel:hover { background: #d1d5db; transform: translateY(-2px); }
        hr { border-color: #e5e7eb; margin: 20px 0; }
        @keyframes slideUp { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: translateY(0); } }
        @media (max-width: 768px) { .container { padding: 20px 10px; } .page-title { font-size: 24px; } .header-actions { flex-direction: column; gap: 15px; align-items: flex-start; } .table { font-size: 12px; } .table thead th { padding: 12px 8px !important; } .table tbody td { padding: 12px 8px !important; } .btn-add { padding: 10px 20px !important; } }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg">
    <div class="container-fluid px-4">
        <a class="navbar-brand" href="#">
            <i class="fas fa-building"></i>QUẢN LÝ HỆ THỐNG
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#adminNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>
        
        <div class="collapse navbar-collapse" id="adminNavbar">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-4">
                <li class="nav-item">
                    <a class="nav-link" href="index.php?page=admin_courses">
                        <i class="fas fa-book me-2"></i>Học phần
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php?page=admin_students">
                        <i class="fas fa-graduation-cap me-2"></i>Sinh viên
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="index.php?page=admin_advisors">
                        <i class="fas fa-chalkboard-user me-2"></i>Cố vấn
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php?page=admin_classes">
                        <i class="fas fa-door-open me-2"></i>Lớp học
                    </a>
                </li>
            </ul>
            <div class="d-flex align-items-center gap-3 ms-auto">
                <span class="navbar-text d-none d-lg-inline">
                    <i class="fas fa-user-tie me-2"></i>Admin
                </span>
                <a href="index.php?page=logout" class="btn btn-sm btn-outline-light">
                    <i class="fas fa-arrow-right-from-bracket me-1"></i>Đăng xuất
                </a>
            </div>
        </div>
    </div>
</nav>

<div class="container">
    <div class="page-header">
        <h1 class="page-title"><i class="fas fa-users me-2"></i>Quản lý Cố vấn Học tập</h1>
        <p class="page-subtitle">Quản lý danh sách cố vấn học tập của hệ thống</p>
    </div>

    <div class="header-actions">
        <div class="search-box flex-grow-1" style="max-width: 300px;">
            <i class="fas fa-search"></i>
            <input type="text" class="form-control" placeholder="Tìm kiếm cố vấn...">
        </div>
        <button type="button" class="btn btn-add" data-bs-toggle="modal" data-bs-target="#addAdvisorModal">
            <i class="fas fa-plus me-2"></i>Thêm Cố vấn
        </button>
    </div>

    <div class="table-card">
        <table class="table table-hover mb-0">
            <thead>
                <tr>
                    <th><i class="fas fa-hashtag me-2"></i>Mã CV</th>
                    <th><i class="fas fa-user me-2"></i>Họ tên</th>
                    <th><i class="fas fa-building me-2"></i>Khoa</th>
                    <th><i class="fas fa-envelope me-2"></i>Email</th>
                    <th class="text-center"><i class="fas fa-phone me-2"></i>SĐT</th>
                    <th class="text-center"><i class="fas fa-key me-2"></i>Tài khoản</th>
                    <th class="text-center" style="width: 100px;"><i class="fas fa-sliders me-2"></i>Hành động</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($dsCoVan)): ?>
                    <?php foreach ($dsCoVan as $cv): ?>
                    <tr>
                        <td><span class="advisor-code"><?php echo $cv['MaCoVan']; ?></span></td>
                        <td><?php echo $cv['HoTen']; ?></td>
                        <td><?php echo $cv['MaKhoa'] ?? '<span class="text-muted">—</span>'; ?></td>
                        <td><small><?php echo $cv['Email'] ?? '<span class="text-muted">—</span>'; ?></small></td>
                        <td class="text-center"><small><?php echo $cv['SoDienThoai'] ?? '<span class="text-muted">—</span>'; ?></small></td>
                        <td class="text-center"><small class="text-muted"><?php echo $cv['TenDangNhap'] ?? '<span class="text-muted">—</span>'; ?></small></td>
                        <td class="text-center">
                            <a href="index.php?page=admin_advisor_edit&id=<?php echo $cv['MaCoVan']; ?>" 
                            class="btn btn-warning btn-sm me-2" 
                            style="color: #fff; font-weight: 700;">
                            <i class="fas fa-edit me-1"></i>Sửa
                            </a>

                            <a href="index.php?page=admin_advisor_delete&id=<?php echo $cv['MaCoVan']; ?>" 
                            class="btn btn-delete"
                            onclick="return confirm('Xóa cố vấn này?');">
                            <i class="fas fa-trash me-1"></i>Xóa
                            </a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="7">
                            <div class="empty-state">
                                <i class="fas fa-inbox"></i>
                                <p>Chưa có dữ liệu cố vấn</p>
                            </div>
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<div class="modal fade" id="addAdvisorModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="fas fa-user-plus me-2"></i>Thêm Cố vấn mới
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <form action="index.php?page=admin_advisor_store" method="POST">
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">
                            Mã Cố vấn (Username) <span class="text-danger">*</span>
                        </label>
                        <input type="text" name="ma_covan" class="form-control" placeholder="VD: GV002" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">
                            Họ tên <span class="text-danger">*</span>
                        </label>
                        <input type="text" name="ho_ten" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">
                            Mã Khoa <span class="text-danger">*</span>
                        </label>
                        <input type="text" name="ma_khoa" class="form-control" value="CNTT" required>
                    </div>
                    <div class="row">
                        <div class="col-6 mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" class="form-control">
                        </div>
                        <div class="col-6 mb-3">
                            <label class="form-label">SĐT</label>
                            <input type="text" name="sdt" class="form-control">
                        </div>
                    </div>
                    <div class="password-section">
                        <label class="form-label mb-2">
                            <i class="fas fa-lock me-1"></i>Mật khẩu khởi tạo <span class="text-danger">*</span>
                        </label>
                        <input type="text" name="password" class="form-control fw-bold" value="123456" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-cancel" data-bs-dismiss="modal">
                        <i class="fas fa-times me-1"></i>Hủy
                    </button>
                    <button type="submit" class="btn btn-save">
                        <i class="fas fa-check me-1"></i>Lưu Cố vấn
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>