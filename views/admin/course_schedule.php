<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Quản lý Lịch học</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        :root { --primary-blue: #3b82f6; --dark-blue: #1e40af; }
        body { background: linear-gradient(135deg, #f3f4f6 0%, #e5e7eb 100%); min-height: 100vh; }
        .container-main { max-width: 1000px; margin: 40px auto; }
        .card { border: none; border-radius: 16px; box-shadow: 0 10px 30px rgba(0,0,0,0.1); }
        .card-header { background: linear-gradient(135deg, var(--primary-blue) 0%, var(--dark-blue) 100%); color: white; border-radius: 16px 16px 0 0 !important; padding: 24px; display: flex; justify-content: space-between; align-items: center; }
        .card-header h5 { margin: 0; font-weight: 800; font-size: 20px; }
        .btn-back { background: white; color: var(--dark-blue); border: none; font-weight: 700; }
        .btn-back:hover { transform: translateY(-2px); box-shadow: 0 4px 12px rgba(0,0,0,0.15); }
        .card-body { padding: 32px; }
        .form-row { display: grid; grid-template-columns: repeat(auto-fit, minmax(150px, 1fr)); gap: 16px; margin-bottom: 24px; padding-bottom: 24px; border-bottom: 2px solid #e5e7eb; }
        .form-group { display: flex; flex-direction: column; }
        .form-label { font-weight: 700; color: var(--dark-blue); font-size: 13px; display: block; margin-bottom: 8px; }
        .form-control, .form-select { border-radius: 10px; border: 2px solid #e5e7eb; padding: 12px 14px; transition: all 0.3s ease; font-size: 14px; }
        .form-control:focus, .form-select:focus { border-color: var(--primary-blue); box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.1); background: white; }
        .btn-add { background: linear-gradient(135deg, #10b981 0%, #059669 100%); color: white; border: none; font-weight: 700; padding: 12px 24px; border-radius: 10px; transition: all 0.3s ease; align-self: flex-end; }
        .btn-add:hover { transform: translateY(-2px); box-shadow: 0 6px 16px rgba(16, 185, 129, 0.3); }
        .table { margin-top: 24px; border-collapse: separate; border-spacing: 0; }
        .table thead { background: linear-gradient(135deg, #eff6ff 0%, #f0f9ff 100%); }
        .table th { border: none; color: var(--dark-blue); font-weight: 700; padding: 16px; text-align: center; }
        .table td { border: none; padding: 14px 16px; border-top: 1px solid #f3f4f6; text-align: center; }
        .table tbody tr { transition: all 0.3s ease; }
        .table tbody tr:hover { background: #fafbfc; }
        .btn-delete { background: #fee2e2; color: #b91c1c; border: none; font-weight: 700; padding: 8px 12px; border-radius: 8px; transition: all 0.3s ease; }
        .btn-delete:hover { background: #fca5a5; transform: translateY(-1px); }
        .schedule-badge { background: #f0f9ff; color: var(--primary-blue); padding: 6px 12px; border-radius: 8px; font-family: monospace; font-weight: 700; display: inline-block; }
        .day-badge { background: linear-gradient(135deg, #fecaca 0%, #fca5a5 100%); color: #7f1d1d; padding: 4px 12px; border-radius: 6px; font-weight: 700; font-size: 13px; }
    </style>
</head>
<body>

<div class="container-main">
    <div class="card">
        <div class="card-header">
            <h5><i class="fas fa-calendar-alt"></i> Lịch học: <?php echo $course['TenHocPhan']; ?> (<?php echo $course['MaHocPhan']; ?>)</h5>
            <a href="index.php?page=admin_courses" class="btn btn-back"><i class="fas fa-arrow-left"></i> Quay lại</a>
        </div>

        <div class="card-body">
            
            <form action="index.php?page=admin_schedule_store" method="POST" class="form-row">
                <input type="hidden" name="ma_hp" value="<?php echo $course['MaHocPhan']; ?>">
                
                <div class="form-group">
                    <label class="form-label"><i class="fas fa-calendar-day"></i> Thứ</label>
                    <select name="thu" class="form-select" required>
                        <?php 
                        // SỬA ĐOẠN NÀY: Kiểm tra nếu là 8 thì in "Chủ Nhật"
                        for($i=2; $i<=8; $i++) {
                            $tenThu = ($i == 8) ? "Chủ Nhật" : "Thứ $i";
                            echo "<option value='$i'>$tenThu</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label"><i class="fas fa-clock"></i> Tiết BĐ</label>
                    <input type="number" name="tiet" class="form-control" min="1" max="12" placeholder="1" required>
                </div>
                <div class="form-group">
                    <label class="form-label"><i class="fas fa-hourglass-half"></i> Số tiết</label>
                    <input type="number" name="so_tiet" class="form-control" min="1" max="5" placeholder="2" required>
                </div>
                <div class="form-group">
                    <label class="form-label"><i class="fas fa-door-open"></i> Phòng</label>
                    <input type="text" name="phong" class="form-control" placeholder="B1-202" required>
                </div>
                <div class="form-group">
                    <label class="form-label"><i class="fas fa-chalkboard-user"></i> Giảng viên</label>
                    <input type="text" name="gv" class="form-control" placeholder="Họ tên" required>
                </div>
                <button type="submit" class="btn-add"><i class="fas fa-plus"></i> Thêm Lịch</button>
            </form>

            <table class="table">
                <thead>
                    <tr>
                        <th><i class="fas fa-calendar-day"></i> Thứ</th>
                        <th><i class="fas fa-clock"></i> Tiết</th>
                        <th><i class="fas fa-door-open"></i> Phòng</th>
                        <th><i class="fas fa-chalkboard-user"></i> Giảng viên</th>
                        <th><i class="fas fa-trash"></i> Xóa</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($schedule as $s): ?>
                    <tr style="transition: all 0.3s ease;" onmouseover="this.style.backgroundColor='#fafbfc';" onmouseout="this.style.backgroundColor='white';">
                        <td>
                            <span class="day-badge">
                                <?php 
                                // SỬA ĐOẠN NÀY: Hiển thị trong bảng cũng phải là Chủ Nhật
                                echo ($s['Thu'] == 8) ? "Chủ Nhật" : "Thứ " . $s['Thu']; 
                                ?>
                            </span>
                        </td>
                        <td><span class="schedule-badge"><?php echo $s['TietBatDau']; ?> - <?php echo $s['TietBatDau']+$s['SoTiet']-1; ?></span></td>
                        <td><span class="schedule-badge"><?php echo $s['PhongHoc']; ?></span></td>
                        <td><?php echo $s['GiangVien']; ?></td>
                        <td>
                            <a href="index.php?page=admin_schedule_delete&id_tkb=<?php echo $s['ID_TKB']; ?>&ma_hp=<?php echo $course['MaHocPhan']; ?>" 
                               class="btn btn-delete" onclick="return confirm('Xóa lịch này?');">
                               <i class="fas fa-trash"></i>
                            </a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                    <?php if (empty($schedule)): ?>
                    <tr><td colspan="5" class="text-center text-muted py-4"><i class="fas fa-inbox"></i> Chưa có lịch học nào</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

</body>
</html>