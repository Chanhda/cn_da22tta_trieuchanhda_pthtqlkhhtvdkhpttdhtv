<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Sửa Lớp Học</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="card shadow">
            <div class="card-header bg-info text-white">
                <h4 class="mb-0">✏️ Cập Nhật Lớp Học</h4>
            </div>
            <div class="card-body">
                <form action="index.php?page=admin_class_update" method="POST">
                    <div class="mb-3">
                        <label class="form-label">Mã Lớp:</label>
                        <input type="text" name="ma_lop" class="form-control bg-secondary text-white" value="<?= $class['MaLop'] ?>" readonly>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Tên Lớp:</label>
                        <input type="text" name="ten_lop" class="form-control" value="<?= $class['TenLop'] ?>" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Cố Vấn Phụ Trách:</label>
                        <select name="msgv" class="form-select" required>
                            <?php foreach ($advisors as $adv): ?>
                                <option value="<?= $adv['MSGV'] ?>" <?= ($class['MSGV'] == $adv['MSGV']) ? 'selected' : '' ?>>
                                    <?= $adv['HoTen'] ?> (<?= $adv['MSGV'] ?>)
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary">Lưu Thay Đổi</button>
                    <a href="index.php?page=admin_classes" class="btn btn-secondary">Hủy</a>
                </form>
            </div>
        </div>
    </div>
</body>
</html>