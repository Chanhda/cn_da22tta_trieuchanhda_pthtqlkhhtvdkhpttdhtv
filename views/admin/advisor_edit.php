<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Sửa Cố Vấn</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="card shadow">
            <div class="card-header bg-warning text-dark">
                <h4 class="mb-0">✏️ Cập Nhật Thông Tin Cố Vấn</h4>
            </div>
            <div class="card-body">
                <form action="index.php?page=admin_advisor_update" method="POST">
                    <div class="mb-3">
                        <label class="form-label">Mã Số Giảng Viên (MSGV):</label>
                        <input type="text" name="msgv" class="form-control bg-secondary text-white" value="<?= $advisor['MSGV'] ?>" readonly>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Họ Tên:</label>
                        <input type="text" name="ho_ten" class="form-control" value="<?= $advisor['HoTen'] ?>" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Email:</label>
                        <input type="email" name="email" class="form-control" value="<?= $advisor['Email'] ?>" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Số Điện Thoại:</label>
                        <input type="text" name="sdt" class="form-control" value="<?= $advisor['SoDienThoai'] ?>">
                    </div>

                    <button type="submit" class="btn btn-primary">Lưu Thay Đổi</button>
                    <a href="index.php?page=admin_advisors" class="btn btn-secondary">Hủy</a>
                </form>
            </div>
        </div>
    </div>
</body>
</html>