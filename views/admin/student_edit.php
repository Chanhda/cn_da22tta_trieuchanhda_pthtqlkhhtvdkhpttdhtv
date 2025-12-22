<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Sửa thông tin Sinh viên</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        :root { --primary-blue: #3b82f6; --dark-blue: #1e40af; --orange: #f59e0b; }
        body { background: linear-gradient(135deg, #f3f4f6 0%, #e5e7eb 100%); }
        .page-container { 
            display: flex; 
            align-items: center; 
            justify-content: center; 
            min-height: 100vh; 
            padding: 60px 20px;
        }
        .form-card {
            background: white;
            border-radius: 20px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
            max-width: 700px;
            width: 100%;
            animation: slideUp 0.6s ease-out;
            overflow: hidden;
        }
        .card-header {
            background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
            color: white;
            padding: 32px 28px;
            position: relative;
            overflow: hidden;
        }
        .card-header::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255,255,255,0.1) 1px, transparent 1px);
            background-size: 50px 50px;
            animation: float 6s ease-in-out infinite;
        }
        .card-header h5 { position: relative; z-index: 1; margin: 0; font-size: 24px; font-weight: 800; letter-spacing: 0.5px; }
        .form-body { padding: 32px 28px; }
        .form-group-row { display: grid; grid-template-columns: 1fr; gap: 20px; margin-bottom: 24px; }
        @media (min-width: 576px) { .form-group-row { grid-template-columns: 1fr 1fr; } }
        .form-control { 
            border-radius: 12px; 
            border: 2px solid #e5e7eb; 
            padding: 14px 16px; 
            font-size: 14px;
            transition: all 0.3s ease;
            background: #f9fafb;
        }
        .form-control:focus { 
            background: white;
            border-color: #f59e0b;
            box-shadow: 0 0 0 4px rgba(245, 158, 11, 0.1);
            outline: none;
        }
        .form-control:disabled { background-color: #f3f4f6; }
        .form-label { 
            font-weight: 700; 
            color: var(--dark-blue); 
            font-size: 14px; 
            margin-bottom: 8px; 
            display: block;
        }
        .form-label i { margin-right: 8px; color: #f59e0b; width: 16px; }
        .form-actions { 
            display: flex; 
            gap: 12px; 
            margin-top: 32px; 
            padding-top: 24px; 
            border-top: 1px solid #e5e7eb;
        }
        .btn-cancel { 
            background: #e5e7eb; 
            color: #374151; 
            border: none; 
            padding: 14px 32px; 
            border-radius: 12px;
            font-weight: 700;
            transition: all 0.3s ease;
            flex: 1;
        }
        .btn-cancel:hover { background: #d1d5db; color: #1f2937; }
        .btn-save { 
            background: linear-gradient(135deg, #3b82f6 0%, #1e40af 100%); 
            color: white; 
            border: none; 
            padding: 14px 32px;
            border-radius: 12px; 
            font-weight: 700;
            transition: all 0.3s ease;
            flex: 1;
        }
        .btn-save:hover { transform: translateY(-2px); box-shadow: 0 8px 16px rgba(59, 130, 246, 0.3); }
        @keyframes slideUp { 
            from { transform: translateY(30px); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
        }
    </style>
</head>
<body>

<div class="page-container">
    <div class="form-card">
        <div class="card-header">
            <h5><i class="fas fa-edit"></i> Sửa thông tin Sinh viên</h5>
        </div>

        <div class="form-body">
            <form action="index.php?page=admin_student_update" method="POST">
                
                <div class="form-group-row">
                    <div>
                        <label class="form-label"><i class="fas fa-id-card"></i>MSSV</label>
                        <input type="text" name="mssv" class="form-control" 
                               value="<?php echo htmlspecialchars($sv['MSSV']); ?>" readonly>
                    </div>
                    <div>
                        <label class="form-label"><i class="fas fa-user"></i>Họ và tên</label>
                        <input type="text" name="ho_ten" class="form-control" 
                               value="<?php echo htmlspecialchars($sv['HoTen']); ?>" required>
                    </div>
                </div>

                <div class="form-group-row">
                    <div>
                        <label class="form-label"><i class="fas fa-school"></i>Lớp</label>
                        <input type="text" name="lop" class="form-control" 
                               value="<?php echo htmlspecialchars($sv['MaLop']); ?>" required>
                    </div>
                    <div>
                        <label class="form-label"><i class="fas fa-book-reader"></i>Chương trình ĐT</label>
                        <input type="text" name="ctdt" class="form-control" 
                               value="<?php echo htmlspecialchars($sv['ChuongTrinhDaoTao'] ?? $sv['MaCTDT'] ?? ''); ?>" required>
                    </div>
                </div>

                <div>
                    <label class="form-label"><i class="fas fa-envelope"></i>Email</label>
                    <input type="email" name="email" class="form-control" 
                           value="<?php echo htmlspecialchars($sv['Email']); ?>" required>
                </div>

                <div class="form-actions">
                    <a href="index.php?page=admin_students" class="btn-cancel">
                        <i class="fas fa-arrow-left"></i> Quay lại
                    </a>
                    <button type="submit" class="btn-save">
                        <i class="fas fa-save"></i> Lưu thay đổi
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>

</body>
</html>