<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sửa môn học</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { background: linear-gradient(135deg, #f3f4f6 0%, #e5e7eb 100%); min-height: 100vh; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
        .page-container { padding: 60px 20px; display: flex; align-items: center; justify-content: center; min-height: 100vh; }
        .form-card { background: white; border-radius: 20px; box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1); overflow: hidden; animation: slideUp 0.6s ease-out; max-width: 700px; width: 100%; }
        .card-header { background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%); color: white; padding: 32px 28px; position: relative; overflow: hidden; }
        .card-header::before { content: ''; position: absolute; top: -50%; right: -50%; width: 200%; height: 200%; background: radial-gradient(circle, rgba(255,255,255,0.15) 0%, transparent 70%); animation: float 3s ease-in-out infinite; }
        .card-header h5 { position: relative; z-index: 1; font-weight: 800; font-size: 22px; margin: 0; display: flex; align-items: center; gap: 12px; }
        .card-header i { font-size: 24px; }
        .card-body { padding: 40px 32px; background: #fafbfc; }
        .form-group { margin-bottom: 24px; }
        .form-label { color: #1f2937; font-weight: 700; margin-bottom: 10px; font-size: 14px; display: flex; align-items: center; gap: 8px; }
        .form-label i { color: #3b82f6; font-size: 16px; }
        .form-control { border-radius: 12px !important; border: 2px solid #e5e7eb !important; padding: 14px 16px !important; font-size: 15px; transition: all 0.3s ease; background: white; color: #1f2937; font-weight: 500; }
        .form-control:focus { border-color: #f59e0b !important; box-shadow: 0 0 0 4px rgba(245, 158, 11, 0.1) !important; background: white !important; }
        .form-control:read-only { background: #f3f4f6 !important; color: #6b7280; cursor: not-allowed; }
        .form-row { display: grid; grid-template-columns: 1fr 1fr; gap: 24px; }
        .btn-container { display: flex; gap: 16px; margin-top: 40px; }
        .btn-cancel { background: #e5e7eb; border: none !important; color: #374151 !important; border-radius: 12px; padding: 14px 32px !important; font-weight: 700; font-size: 15px; transition: all 0.3s ease; display: inline-flex; align-items: center; gap: 8px; text-decoration: none; }
        .btn-cancel:hover { background: #d1d5db; transform: translateY(-2px); box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1); color: #1f2937 !important; }
        .btn-save { background: linear-gradient(135deg, #3b82f6 0%, #1e40af 100%); border: none !important; color: white !important; border-radius: 12px; padding: 14px 32px !important; font-weight: 700; font-size: 15px; transition: all 0.3s ease; display: inline-flex; align-items: center; gap: 8px; flex: 1; justify-content: center; }
        .btn-save:hover { transform: translateY(-2px); box-shadow: 0 8px 20px rgba(59, 130, 246, 0.3); background: linear-gradient(135deg, #1e40af 0%, #1e3a8a 100%) !important; color: white !important; }
        .input-group-icon { position: relative; }
        .input-group-icon i { position: absolute; right: 16px; top: 50%; transform: translateY(-50%); color: #9ca3af; pointer-events: none; }
        hr { border-color: #e5e7eb; margin: 32px 0; }
        @keyframes slideUp { from { opacity: 0; transform: translateY(30px); } to { opacity: 1; transform: translateY(0); } }
        @keyframes float { 0%, 100% { transform: translateY(0px); } 50% { transform: translateY(-20px); } }
        @media (max-width: 768px) { .page-container { padding: 20px; } .card-header { padding: 24px 20px; } .card-header h5 { font-size: 18px; } .card-body { padding: 24px 20px; } .form-row { grid-template-columns: 1fr; gap: 16px; } .btn-container { flex-direction: column; gap: 12px; } .btn-save, .btn-cancel { padding: 12px 20px !important; } }
    </style>
</head>
<body>

<div class="page-container">
    <div class="form-card">
        <div class="card-header">
            <h5>
                <i class="fas fa-edit"></i>Chỉnh sửa Học phần: <span style="color: #fef3c7;"><?php echo htmlspecialchars($course['MaHocPhan']); ?></span>
            </h5>
        </div>
        <div class="card-body">
            
            <form action="index.php?page=admin_course_update" method="POST">
                
                <div class="form-group">
                    <label class="form-label">
                        <i class="fas fa-code"></i>Mã học phần
                    </label>
                    <input type="text" name="ma_hp" class="form-control" value="<?php echo htmlspecialchars($course['MaHocPhan']); ?>" readonly>
                </div>

                <div class="form-group">
                    <label class="form-label">
                        <i class="fas fa-book"></i>Tên học phần
                    </label>
                    <input type="text" name="ten_hp" class="form-control" value="<?php echo htmlspecialchars($course['TenHocPhan']); ?>" required>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">
                            <i class="fas fa-coins"></i>Số tín chỉ
                        </label>
                        <input type="number" name="so_tc" class="form-control" value="<?php echo $course['SoTinChi']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label">
                            <i class="fas fa-calendar"></i>Học kỳ gợi ý
                        </label>
                        <input type="number" name="hk" class="form-control" 
                               value="<?php echo $course['MaHocKy'] ?? $course['HocKyGoiY'] ?? $course['HocKy'] ?? ''; ?>" required>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">
                            <i class="fas fa-graduation-cap"></i>Tiết Lý thuyết
                        </label>
                        <input type="number" name="lt" class="form-control" value="<?php echo $course['SoTietLyThuyet']; ?>">
                    </div>
                    <div class="form-group">
                        <label class="form-label">
                            <i class="fas fa-flask"></i>Tiết Thực hành
                        </label>
                        <input type="number" name="th" class="form-control" value="<?php echo $course['SoTietThucHanh']; ?>">
                    </div>
                </div>

                <div class="btn-container">
                    <a href="index.php?page=admin_courses" class="btn-cancel">
                        <i class="fas fa-arrow-left"></i>Hủy bỏ
                    </a>
                    <button type="submit" class="btn-save">
                        <i class="fas fa-check"></i>Lưu thay đổi
                    </button>
                </div>
            </form>

        </div>
    </div>
</div>

</body>
</html>