<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Duyệt kế hoạch</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        :root{ --accent:#3b82f6; --surface:#ffffff; --bg:#f6f8fb; }
        body{ background:var(--bg); min-height:100vh; font-family: "Segoe UI", Tahoma, Arial, sans-serif; padding:28px 20px; color:#0f172a; }
        .container{ max-width:800px; }
        .card{ border-radius:10px; border:1px solid #eef2ff; background:var(--surface); box-shadow:0 6px 18px rgba(15,23,42,0.04); overflow:hidden; }
        .card-header{ background:transparent; color:#0f172a; padding:16px 20px; border-bottom:1px solid #f1f5f9; font-weight:700; font-size:16px; }
        .card-header h5{ margin:0; display:flex; align-items:center; gap:10px; }
        .card-body{ padding:20px; }
        .table{ margin-bottom:0; }
        .table thead{ background:transparent; }
        .table thead th{ color:#0f172a; padding:12px; font-weight:700; border-bottom:2px solid #eef2ff; }
        .table tbody tr{ border-bottom:1px solid #f1f5f9; transition:all .12s ease; }
        .table tbody tr:hover{ background:#fbfdff; }
        .table tbody td{ padding:12px; color:#0f172a; vertical-align:middle; }
        .table tbody td strong{ color:var(--accent); }
        .table-info{ background:#eef2ff; border-top:1px solid var(--accent); }
        .table-info td{ color:var(--accent); font-weight:700; }
        .form-label{ color:#0f172a; font-weight:700; margin-bottom:10px; }
        .form-control{ border-radius:8px; border:1px solid #eef2ff; padding:10px 12px; font-size:14px; transition:all .12s ease; }
        .form-control:focus{ border-color:var(--accent); box-shadow:0 0 0 0.12rem rgba(59,130,246,0.12); }
        .btn{ border-radius:8px; padding:8px 16px; font-weight:700; font-size:14px; border:none; display:inline-flex; align-items:center; gap:8px; transition:all .12s ease; }
        .btn-secondary{ background:#94a3b8; color:#fff; }
        .btn-secondary:hover{ background:#7c8fa8; }
        .btn-danger{ background:linear-gradient(90deg,#ef4444,#dc2626); color:#fff; }
        .btn-danger:hover{ background:linear-gradient(90deg,#f87171,#ef4444); }
        .btn-success{ background:linear-gradient(90deg,#2563eb,#3b82f6); color:#fff; }
        .btn-success:hover{ background:linear-gradient(90deg,#1d4ed8,#2563eb); }
        .d-flex{ flex-wrap:wrap; gap:12px; }
        hr{ border-color:#f1f5f9; margin:20px 0; }
        @media (max-width:768px){ body{ padding:18px 10px; } .card-body{ padding:14px; } .btn{ padding:6px 12px; font-size:13px; } .d-flex{ justify-content:center; } .d-flex > div{ width:100%; display:flex; gap:8px; } .d-flex > div > button{ flex:1; } }
    </style>
</head>
<body>

<div class="container mt-5">
    <div class="card col-md-8 mx-auto">
        <div class="card-header">
            <h5>
                <i class="fas fa-clipboard-list"></i>Chi tiết Kế hoạch đăng ký
            </h5>
        </div>
        <div class="card-body">
            
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th><i class="fas fa-code me-2"></i>Mã HP</th>
                        <th><i class="fas fa-book me-2"></i>Tên học phần</th>
                        <th class="text-center"><i class="fas fa-coins me-2"></i>Số TC</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $tongTC = 0;
                    if (isset($chiTiet)) {
                        foreach ($chiTiet as $hp): 
                            $tongTC += $hp['SoTinChi'];
                    ?>
                        <tr>
                            <td><strong><?php echo $hp['MaHocPhan']; ?></strong></td>
                            <td><?php echo $hp['TenHocPhan']; ?></td>
                            <td class="text-center"><strong><?php echo $hp['SoTinChi']; ?></strong></td>
                        </tr>
                    <?php endforeach; } ?>
                    <tr class="table-info">
                        <td colspan="2" style="text-align: right;"><i class="fas fa-sum me-2"></i><strong>Tổng tín chỉ:</strong></td>
                        <td class="text-center"><strong><?php echo $tongTC; ?> TC</strong></td>
                    </tr>
                </tbody>
            </table>

            <hr>
            
            <form action="index.php?page=advisor_process" method="POST">
                <input type="hidden" name="id_ke_hoach" value="<?php echo $_GET['id']; ?>">
                
                <div class="mb-3">
                    <label class="form-label"><i class="fas fa-pen me-2"></i>Ghi chú / Nhận xét:</label>
                    <textarea name="ghi_chu" class="form-control" rows="3" placeholder="Nhập lý do nếu từ chối..."></textarea>
                </div>

                <div class="d-flex justify-content-between">
                    <a href="index.php?page=advisor_dashboard" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i>Quay lại
                    </a>
                    <div>
                        <button type="submit" name="action" value="reject" class="btn btn-danger me-2">
                            <i class="fas fa-times-circle"></i>Từ chối
                        </button>
                        <button type="submit" name="action" value="approve" class="btn btn-success">
                            <i class="fas fa-check-circle"></i>Phê duyệt
                        </button>
                    </div>
                </div>
            </form>

        </div>
    </div>
</div>

</body>
</html>