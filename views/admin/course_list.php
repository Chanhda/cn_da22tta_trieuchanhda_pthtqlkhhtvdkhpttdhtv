<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Quản lý Học phần</title>
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
                    <a class="nav-link active" href="index.php?page=admin_courses"><i class="fas fa-book"></i> Học phần</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php?page=admin_students"><i class="fas fa-users"></i> Sinh viên</a>
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
            <h2 class="fw-bold" style="color: var(--dark-blue); font-size: 28px;"><i class="fas fa-book"></i> Quản lý Học phần</h2>
            <p class="text-muted mb-0">Danh sách các môn học và thông tin chi tiết</p>
        </div>
        <div class="col-md-4 text-md-end">
            <button type="button" class="btn fw-bold" style="background: linear-gradient(135deg, #3b82f6 0%, #1e40af 100%); color: white;" data-bs-toggle="modal" data-bs-target="#addCourseModal">
                <i class="fas fa-plus"></i> Thêm Học phần
            </button>
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-md-6">
            <div class="input-group">
                <span class="input-group-text" style="background: white; border: 2px solid #e5e7eb;">
                    <i class="fas fa-search" style="color: #9ca3af;"></i>
                </span>
                <input type="text" class="form-control" placeholder="Tìm kiếm mã, tên học phần..." style="border: 2px solid #e5e7eb; border-left: none;">
            </div>
        </div>
    </div>

    <div class="card shadow-sm border-0" style="border-radius: 12px;">
        <div class="card-body p-0">
            <table class="table table-hover mb-0">
                <thead>
                    <tr style="background: linear-gradient(135deg, #eff6ff 0%, #f0f9ff 100%);">
                        <th style="border: none; color: var(--dark-blue); font-weight: 700; padding: 16px;">Mã HP</th>
                        <th style="border: none; color: var(--dark-blue); font-weight: 700; padding: 16px;">Tên học phần</th>
                        <th style="border: none; color: var(--dark-blue); font-weight: 700; padding: 16px; text-align: center;">Số TC</th>
                        <th style="border: none; color: var(--dark-blue); font-weight: 700; padding: 16px; text-align: center;">LT</th>
                        <th style="border: none; color: var(--dark-blue); font-weight: 700; padding: 16px; text-align: center;">TH</th>
                        <th style="border: none; color: var(--dark-blue); font-weight: 700; padding: 16px; text-align: center;">HK Gợi ý</th>
                        <th style="border: none; color: var(--dark-blue); font-weight: 700; padding: 16px; text-align: center; width: 200px;">Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($courses)): ?>
                        <?php foreach ($courses as $hp): ?>
                        <tr style="border-top: 1px solid #f3f4f6; transition: all 0.3s ease; transform: scale(1);" onmouseover="this.style.backgroundColor='#fafbfc'; this.style.transform='scale(1.01)';" onmouseout="this.style.backgroundColor='white'; this.style.transform='scale(1)';")>
                            <td style="padding: 14px 16px; border: none; color: var(--primary-blue);" class="fw-bold"><?php echo $hp['MaHocPhan']; ?></td>
                            <td style="padding: 14px 16px; border: none;"><?php echo $hp['TenHocPhan']; ?></td>
                            <td style="padding: 14px 16px; border: none; text-align: center;" class="fw-bold"><?php echo $hp['SoTinChi']; ?></td>
                            <td style="padding: 14px 16px; border: none; text-align: center;"><?php echo $hp['SoTietLyThuyet']; ?></td>
                            <td style="padding: 14px 16px; border: none; text-align: center;"><?php echo $hp['SoTietThucHanh']; ?></td>
                            <td style="padding: 14px 16px; border: none; text-align: center;" class="fw-bold" style="color: var(--primary-blue);"><?php echo $hp['HocKyGoiY']; ?></td>
                            <td style="padding: 14px 16px; border: none; text-align: center;">
                                <div class="d-flex justify-content-center gap-2">
                                    <a href="index.php?page=admin_course_schedule&id=<?php echo $hp['MaHocPhan']; ?>" class="btn btn-sm" style="background: #dbeafe; color: #0c4a6e; border: none; font-weight: 600;" title="Lịch"><i class="fas fa-calendar"></i></a>
                                    <a href="index.php?page=admin_course_prerequisite&id=<?php echo $hp['MaHocPhan']; ?>" class="btn btn-sm" style="background: #e0e7ff; color: #3730a3; border: none; font-weight: 600;" title="Tiên quyết"><i class="fas fa-link"></i></a>
                                    <a href="index.php?page=admin_course_edit&id=<?php echo $hp['MaHocPhan']; ?>" class="btn btn-sm" style="background: #fef3c7; color: #b45309; border: none; font-weight: 600;" title="Sửa"><i class="fas fa-edit"></i></a>
                                    <a href="index.php?page=admin_course_delete&id=<?php echo $hp['MaHocPhan']; ?>" class="btn btn-sm" style="background: #fee2e2; color: #b91c1c; border: none; font-weight: 600;" onclick="return confirm('Xóa môn này?');" title="Xóa"><i class="fas fa-trash"></i></a>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr style="border: none;"><td colspan="7" class="text-center text-muted py-5" style="border: none;"><i class="fas fa-inbox" style="font-size: 32px; margin-bottom: 10px; display: block; opacity: 0.5;"></i>Chưa có dữ liệu</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="modal fade" id="addCourseModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" style="border: none; border-radius: 12px;">
            <div class="modal-header" style="background: linear-gradient(135deg, #3b82f6 0%, #1e40af 100%); border: none; border-radius: 12px 12px 0 0;">
                <h5 class="modal-title fw-bold" style="color: white;"><i class="fas fa-plus-circle"></i> Thêm Mới Học Phần</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <form action="index.php?page=admin_course_store" method="POST">
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label fw-bold">Mã học phần <span class="text-danger">*</span></label>
                        <input type="text" name="ma_hp" class="form-control" placeholder="VD: CNTT999" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Tên học phần <span class="text-danger">*</span></label>
                        <input type="text" name="ten_hp" class="form-control" required>
                    </div>
                    <div class="row">
                        <div class="col-6 mb-3">
                            <label class="form-label">Số Tín chỉ</label>
                            <input type="number" name="so_tc" class="form-control" value="3" required>
                        </div>
                        <div class="col-6 mb-3">
                            <label class="form-label">Học kỳ gợi ý</label>
                            <input type="number" name="hk" class="form-control" value="1" min="1" max="10">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6 mb-3">
                            <label class="form-label">Số tiết Lý thuyết</label>
                            <input type="number" name="lt" class="form-control" value="30">
                        </div>
                        <div class="col-6 mb-3">
                            <label class="form-label">Số tiết Thực hành</label>
                            <input type="number" name="th" class="form-control" value="30">
                        </div>
                    </div>
                </div>
                <div class="modal-footer" style="border-top: 1px solid #e5e7eb;">
                    <button type="button" class="btn fw-bold" style="background: #e5e7eb; color: #374151;" data-bs-dismiss="modal">Hủy</button>
                    <button type="submit" class="btn fw-bold" style="background: linear-gradient(135deg, #3b82f6 0%, #1e40af 100%); color: white;">Lưu Học Phần</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>