<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Quản lý Sinh viên</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        :root { --primary-blue: #3b82f6; --dark-blue: #1e40af; }
        body { background: linear-gradient(135deg, #f3f4f6 0%, #e5e7eb 100%); }
        .navbar { background: white; border-bottom: 3px solid var(--primary-blue); box-shadow: 0 2px 8px rgba(0,0,0,0.08); }
        .navbar-brand { color: var(--dark-blue) !important; font-weight: 900; letter-spacing: 1px; font-size: 20px; }
        .nav-link { color: #6b7280 !important; font-weight: 600; transition: all 0.3s ease; position: relative; padding-bottom: 8px !important; }
        .nav-link:hover::after { content: ''; position: absolute; bottom: 0; left: 0; right: 0; height: 3px; background: var(--primary-blue); animation: slideInUp 0.3s ease; }
        .nav-link.active { color: var(--primary-blue) !important; }
        .nav-link.active::after { content: ''; position: absolute; bottom: 0; left: 0; right: 0; height: 3px; background: var(--primary-blue); }
        .navbar-text { font-weight: 600; color: #374151 !important; }
        .btn-logout { color: #6b7280; border-color: #d1d5db; transition: all 0.3s ease; }
        .btn-logout:hover { background: #f3f4f6; border-color: var(--primary-blue); color: var(--primary-blue); }
        @keyframes slideInUp { from { transform: translateY(4px); opacity: 0; } to { transform: translateY(0); opacity: 1; } }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg sticky-top">
    <div class="container-fluid px-4">
        <a class="navbar-brand" href="#"><i class="fas fa-cog"></i> ADMIN PANEL</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#adminNavbar" aria-controls="adminNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>
        
        <div class="collapse navbar-collapse" id="adminNavbar">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="index.php?page=admin_courses"><i class="fas fa-book"></i> Học phần</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="index.php?page=admin_students"><i class="fas fa-users"></i> Sinh viên</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php?page=admin_advisors"><i class="fas fa-user-tie"></i> Cố vấn</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php?page=admin_classes"><i class="fas fa-chalkboard"></i> Lớp học</a>
                </li>
            </ul>

            <div class="d-flex align-items-center gap-2">
                <span class="navbar-text d-none d-md-inline">Xin chào, Quản trị viên</span>
                <a href="index.php?page=change_password" class="btn btn-sm btn-outline-secondary btn-logout"><i class="fas fa-lock"></i> Đổi mật khẩu</a>
                <a href="index.php?page=logout" class="btn btn-sm btn-outline-secondary btn-logout"><i class="fas fa-sign-out-alt"></i> Đăng xuất</a>
            </div>
        </div>
    </div>
</nav>

<div class="container-fluid px-4 py-4">
    <div class="row mb-4">
        <div class="col-md-8">
            <h2 class="fw-bold" style="color: var(--dark-blue); font-size: 28px;"><i class="fas fa-users"></i> Quản lý Sinh viên</h2>
            <p class="text-muted mb-0">Danh sách toàn bộ sinh viên trong hệ thống</p>
        </div>
        <div class="col-md-4 text-md-end">
            <button type="button" class="btn fw-bold" style="background: linear-gradient(135deg, #3b82f6 0%, #1e40af 100%); color: white;" data-bs-toggle="modal" data-bs-target="#addStudentModal">
                <i class="fas fa-plus"></i> Thêm Sinh viên
            </button>
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-md-6">
            <div class="input-group">
                <span class="input-group-text" style="background: white; border: 2px solid #e5e7eb;">
                    <i class="fas fa-search" style="color: #9ca3af;"></i>
                </span>
                <input type="text" class="form-control" placeholder="Tìm kiếm MSSV, họ tên..." style="border: 2px solid #e5e7eb; border-left: none;">
            </div>
        </div>
    </div>

    <div class="card shadow-sm border-0" style="border-radius: 12px;">
        <div class="card-body p-0">
            <table class="table table-hover mb-0">
                <thead>
                    <tr style="background: linear-gradient(135deg, #eff6ff 0%, #f0f9ff 100%);">
                        <th style="border: none; color: var(--dark-blue); font-weight: 700; padding: 16px;">MSSV</th>
                        <th style="border: none; color: var(--dark-blue); font-weight: 700; padding: 16px;">Họ tên</th>
                        <th style="border: none; color: var(--dark-blue); font-weight: 700; padding: 16px;">Lớp</th>
                        <th style="border: none; color: var(--dark-blue); font-weight: 700; padding: 16px;">CTĐT</th>
                        <th style="border: none; color: var(--dark-blue); font-weight: 700; padding: 16px;">Email</th>
                        <th style="border: none; color: var(--dark-blue); font-weight: 700; padding: 16px; width: 160px;">Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($dsSinhVien)): ?>
                        <?php foreach ($dsSinhVien as $sv): ?>
                        <tr style="border-top: 1px solid #f3f4f6; transition: all 0.3s ease; transform: scale(1);" onmouseover="this.style.backgroundColor='#fafbfc'; this.style.transform='scale(1.01)';" onmouseout="this.style.backgroundColor='white'; this.style.transform='scale(1)';")>
                            <td style="padding: 14px 16px; border: none;" class="fw-bold" style="color: var(--primary-blue);"><?php echo $sv['MSSV']; ?></td>
                            <td style="padding: 14px 16px; border: none;"><?php echo $sv['HoTen']; ?></td>
                            <td style="padding: 14px 16px; border: none;" class="text-center"><span style="background: #f0f9ff; padding: 4px 8px; border-radius: 6px; color: var(--primary-blue); font-weight: 600;"><?php echo $sv['MaLop']; ?></span></td>
                            <td style="padding: 14px 16px; border: none;" class="text-center"><?php echo $sv['MaCTDT']; ?></td>
                            <td style="padding: 14px 16px; border: none; color: #6b7280;"><?php echo $sv['Email']; ?></td>
                            <td style="padding: 14px 16px; border: none;" class="text-center">
                                <a href="index.php?page=admin_student_edit&mssv=<?php echo $sv['MSSV']; ?>" 
                                   class="btn btn-sm" style="background: #fef3c7; color: #b45309; border: none; font-weight: 600; transition: all 0.3s ease;" onmouseover="this.style.backgroundColor='#fcd34d';" onmouseout="this.style.backgroundColor='#fef3c7';"><i class="fas fa-edit"></i> Sửa</a>
                                <a href="index.php?page=admin_student_delete&mssv=<?php echo $sv['MSSV']; ?>" 
                                   class="btn btn-sm" style="background: #fee2e2; color: #b91c1c; border: none; font-weight: 600; transition: all 0.3s ease;" onmouseover="this.style.backgroundColor='#fca5a5';" onmouseout="this.style.backgroundColor='#fee2e2';" onclick="return confirm('CẢNH BÁO: Xóa sinh viên này sẽ xóa luôn tài khoản đăng nhập. Tiếp tục?');"><i class="fas fa-trash"></i> Xóa</a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr style="border: none;"><td colspan="6" class="text-center text-muted py-5" style="border: none;"><i class="fas fa-inbox" style="font-size: 32px; margin-bottom: 10px; display: block; opacity: 0.5;"></i>Chưa có sinh viên nào.</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="modal fade" id="addStudentModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content" style="border: none; border-radius: 12px;">
            <div class="modal-header" style="background: linear-gradient(135deg, #3b82f6 0%, #1e40af 100%); border: none; border-radius: 12px 12px 0 0;">
                <h5 class="modal-title fw-bold" style="color: white;"><i class="fas fa-user-plus"></i> Thêm Sinh viên mới</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <form action="index.php?page=admin_student_store" method="POST">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-6 mb-3">
                            <label class="form-label fw-bold">MSSV (Username) <span class="text-danger">*</span></label>
                            <input type="text" name="mssv" class="form-control" required>
                        </div>
                        <div class="col-6 mb-3">
                            <label class="form-label fw-bold">Họ tên <span class="text-danger">*</span></label>
                            <input type="text" name="ho_ten" class="form-control" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6 mb-3">
                            <label class="form-label">Lớp <span class="text-danger">*</span></label>
                            <input type="text" name="lop" class="form-control" required>
                        </div>
                        <div class="col-6 mb-3">
                            <label class="form-label">Chương trình ĐT <span class="text-danger">*</span></label>
                            <input type="text" name="ctdt" class="form-control" value="CNTT_<?php echo date('Y'); ?>" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email <span class="text-danger">*</span></label>
                        <input type="email" name="email" class="form-control" required>
                    </div>
                    <hr>
                    <div class="mb-3 bg-light p-2 rounded border">
                        <label class="form-label fw-bold text-danger mb-1">Mật khẩu khởi tạo</label>
                        <input type="text" name="password" class="form-control fw-bold" value="123456" required>
                    </div>
                </div>
                <div class="modal-footer" style="border-top: 1px solid #e5e7eb;">
                    <button type="button" class="btn fw-bold" style="background: #e5e7eb; color: #374151;" data-bs-dismiss="modal">Hủy</button>
                    <button type="submit" class="btn fw-bold" style="background: linear-gradient(135deg, #3b82f6 0%, #1e40af 100%); color: white;">Lưu Sinh viên</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>