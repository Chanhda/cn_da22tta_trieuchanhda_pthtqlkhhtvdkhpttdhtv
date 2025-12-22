<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Quản lý Tiên quyết</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        :root { --primary-blue: #3b82f6; --dark-blue: #1e40af; }
        body { background: linear-gradient(135deg, #f3f4f6 0%, #e5e7eb 100%); min-height: 100vh; }
        .container-main { max-width: 900px; margin: 40px auto; }
        .card { border: none; border-radius: 16px; box-shadow: 0 10px 30px rgba(0,0,0,0.1); }
        .card-header { background: linear-gradient(135deg, var(--primary-blue) 0%, var(--dark-blue) 100%); color: white; border-radius: 16px 16px 0 0 !important; padding: 24px; display: flex; justify-content: space-between; align-items: center; }
        .card-header h5 { margin: 0; font-weight: 800; font-size: 20px; }
        .btn-back { background: white; color: var(--dark-blue); border: none; font-weight: 700; }
        .btn-back:hover { transform: translateY(-2px); box-shadow: 0 4px 12px rgba(0,0,0,0.15); }
        .card-body { padding: 32px; }
        .alert { border-radius: 12px; border: none; background: #dbeafe; color: #0c4a6e; padding: 14px 16px; }
        .form-row { display: flex; gap: 12px; margin-bottom: 24px; flex-wrap: wrap; align-items: flex-end; border-bottom: 2px solid #e5e7eb; padding-bottom: 24px; }
        .form-group { flex: 1; min-width: 200px; }
        .form-label { font-weight: 700; color: var(--dark-blue); font-size: 14px; display: block; margin-bottom: 8px; }
        .form-select { border-radius: 10px; border: 2px solid #e5e7eb; padding: 12px 14px; transition: all 0.3s ease; }
        .form-select:focus { border-color: var(--primary-blue); box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.1); }
        .btn-add { background: linear-gradient(135deg, #10b981 0%, #059669 100%); color: white; border: none; font-weight: 700; padding: 12px 24px; border-radius: 10px; transition: all 0.3s ease; }
        .btn-add:hover { transform: translateY(-2px); box-shadow: 0 6px 16px rgba(16, 185, 129, 0.3); }
        .table { margin-top: 24px; border-collapse: separate; border-spacing: 0; }
        .table thead { background: linear-gradient(135deg, #eff6ff 0%, #f0f9ff 100%); }
        .table th { border: none; color: var(--dark-blue); font-weight: 700; padding: 16px; text-align: left; }
        .table td { border: none; padding: 14px 16px; border-top: 1px solid #f3f4f6; }
        .table tbody tr { transition: all 0.3s ease; }
        .table tbody tr:hover { background: #fafbfc; }
        .table tbody tr:hover { transform: translateX(4px); }
        .btn-delete { background: #fee2e2; color: #b91c1c; border: none; font-weight: 700; padding: 8px 12px; border-radius: 8px; transition: all 0.3s ease; }
        .btn-delete:hover { background: #fca5a5; transform: translateY(-1px); }
        .code-badge { background: #f0f9ff; color: var(--primary-blue); padding: 4px 12px; border-radius: 8px; font-family: monospace; font-weight: 700; }
    </style>
</head>
<body>

<div class="container-main">
    <div class="card">
        <div class="card-header">
            <h5><i class="fas fa-link"></i> Tiên quyết: <?php echo $course['TenHocPhan']; ?></h5>
            <a href="index.php?page=admin_courses" class="btn btn-back"><i class="fas fa-arrow-left"></i> Quay lại</a>
        </div>

        <div class="card-body">
            
            <div class="alert">
                <i class="fas fa-info-circle"></i> Sinh viên <strong>PHẢI ĐẬU</strong> các môn dưới đây trước khi đăng ký môn này.
            </div>

            <form action="index.php?page=admin_prereq_store" method="POST" class="form-row">
                <input type="hidden" name="ma_hp" value="<?php echo $course['MaHocPhan']; ?>">
                
                <div class="form-group" style="flex: 2;">
                    <label class="form-label">-- Chọn môn tiên quyết --</label>
                    <select name="ma_hp_tq" class="form-select" required>
                        <option value="">-- Chọn --</option>
                        <?php foreach ($allCourses as $c): ?>
                            <?php if($c['MaHocPhan'] !== $course['MaHocPhan']): ?>
                                <option value="<?php echo $c['MaHocPhan']; ?>">
                                    <?php echo $c['TenHocPhan']; ?> (<?php echo $c['MaHocPhan']; ?>)
                                </option>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </select>
                </div>
                <button type="submit" class="btn-add"><i class="fas fa-plus"></i> Thêm ĐK</button>
            </form>

            <table class="table">
                <thead>
                    <tr>
                        <th style="width: 150px;"><i class="fas fa-code"></i> Mã HP</th>
                        <th><i class="fas fa-book-reader"></i> Tên môn tiên quyết</th>
                        <th style="width: 80px; text-align: center;"><i class="fas fa-trash"></i> Xóa</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($prereqs as $p): ?>
                    <tr>
                        <td><span class="code-badge"><?php echo $p['MaHocPhanTienQuyet']; ?></span></td>
                        <td><?php echo $p['TenHocPhanTQ']; ?></td>
                        <td class="text-center">
                            <a href="index.php?page=admin_prereq_delete&id_dk=<?php echo $p['ID']; ?>&ma_hp=<?php echo $course['MaHocPhan']; ?>" 
                               class="btn btn-delete" onclick="return confirm('Xóa điều kiện này?');">
                               <i class="fas fa-trash"></i>
                            </a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                    <?php if (empty($prereqs)): ?>
                    <tr><td colspan="3" class="text-center text-muted py-4"><i class="fas fa-inbox"></i> Chưa có tiên quyết nào</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

</body>
</html>
            
            <div class="alert">
                <i class="fas fa-info-circle"></i> Sinh viên <strong>PHẢI ĐẬU</strong> các môn dưới đây trước khi đăng ký môn này.
            </div>

            <form action="index.php?page=admin_prereq_store" method="POST" class="form-row">
                <input type="hidden" name="ma_hp" value="<?php echo $course['MaHocPhan']; ?>">
                
                <div class="form-group" style="flex: 2;">
                    <label class="form-label">-- Chọn môn tiên quyết --</label>
                    <select name="ma_hp_tq" class="form-select" required>
                        <option value="">-- Chọn --</option>
                        <?php foreach ($allCourses as $c): ?>
                            <?php if($c['MaHocPhan'] !== $course['MaHocPhan']): ?>
                                <option value="<?php echo $c['MaHocPhan']; ?>">
                                    <?php echo $c['TenHocPhan']; ?> (<?php echo $c['MaHocPhan']; ?>)
                                </option>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </select>
                </div>
                <button type="submit" class="btn-add"><i class="fas fa-plus"></i> Thêm ĐK</button>
            </form>

            <table class="table">
                <thead>
                    <tr>
                        <th style="width: 150px;"><i class="fas fa-code"></i> Mã HP</th>
                        <th><i class="fas fa-book-reader"></i> Tên môn tiên quyết</th>
                        <th style="width: 80px; text-align: center;"><i class="fas fa-trash"></i> Xóa</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($prereqs as $p): ?>
                    <tr>
                        <td><span class="code-badge"><?php echo $p['MaHocPhanTienQuyet']; ?></span></td>
                        <td><?php echo $p['TenHocPhanTQ']; ?></td>
                        <td class="text-center">
                            <a href="index.php?page=admin_prereq_delete&id_dk=<?php echo $p['ID']; ?>&ma_hp=<?php echo $course['MaHocPhan']; ?>" 
                               class="btn btn-delete" onclick="return confirm('Xóa điều kiện này?');">
                               <i class="fas fa-trash"></i>
                            </a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                    <?php if (empty($prereqs)): ?>
                    <tr><td colspan="3" class="text-center text-muted py-4"><i class="fas fa-inbox"></i> Chưa có tiên quyết nào</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

</body>
</html>