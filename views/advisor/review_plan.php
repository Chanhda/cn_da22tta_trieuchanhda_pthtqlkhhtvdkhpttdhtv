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
        :root { --primary-gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%); --success-gradient: linear-gradient(135deg, #10b981 0%, #059669 100%); --danger-gradient: linear-gradient(135deg, #ef4444 0%, #dc2626 100%); }
        body { background: var(--primary-gradient) !important; min-height: 100vh; font-family: 'Nunito', Arial, sans-serif; padding: 40px 20px; }
        .container { max-width: 800px; }
        .card { border-radius: 20px !important; border: none !important; box-shadow: 0 10px 40px rgba(102, 126, 234, 0.3) !important; overflow: hidden; animation: slideUp 0.6s ease-out; }
        .card-header { background: var(--primary-gradient) !important; color: white !important; padding: 25px !important; border: none !important; font-weight: 800; font-size: 18px; position: relative; overflow: hidden; }
        .card-header::before { content: ''; position: absolute; top: -50%; right: -50%; width: 200%; height: 200%; background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%); animation: float 3s ease-in-out infinite; }
        .card-header h5 { position: relative; z-index: 1; margin: 0 !important; display: flex; align-items: center; gap: 10px; }
        .card-body { padding: 30px !important; background: #f8f9ff; }
        .table { margin-bottom: 0 !important; border-radius: 15px; overflow: hidden; }
        .table thead { background: var(--primary-gradient) !important; }
        .table thead th { color: white !important; padding: 16px 14px !important; font-weight: 700 !important; font-size: 14px !important; border: none !important; letter-spacing: 0.5px; }
        .table tbody tr { border-bottom: 1px solid #e0e0e0 !important; transition: all 0.3s ease; }
        .table tbody tr:hover { background-color: #f5f5ff !important; transform: translateX(3px); }
        .table tbody tr:nth-child(even) { background-color: #fafafe; }
        .table tbody td { padding: 14px !important; color: #333; vertical-align: middle; }
        .table tbody td strong { color: #667eea; }
        .table-info { background: linear-gradient(135deg, rgba(102, 126, 234, 0.1) 0%, rgba(118, 75, 162, 0.1) 100%) !important; font-weight: 700; border-top: 2px solid #667eea !important; }
        .table-info td { color: #667eea; padding: 16px 14px !important; }
        .form-label { color: #333; font-weight: 700 !important; margin-bottom: 12px; }
        .form-control { border-radius: 12px !important; border: 2px solid #e0e0e0 !important; padding: 14px 16px !important; font-size: 15px; transition: all 0.3s ease; font-family: 'Nunito', Arial, sans-serif; }
        .form-control:focus { border-color: #667eea !important; box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25) !important; background-color: white !important; }
        .btn { border-radius: 12px !important; padding: 12px 24px !important; font-weight: 700 !important; font-size: 15px; transition: all 0.3s ease; border: none !important; display: inline-flex; align-items: center; gap: 8px; }
        .btn-secondary { background: linear-gradient(135deg, #6b7280 0%, #4b5563 100%) !important; color: white !important; box-shadow: 0 4px 12px rgba(107, 114, 128, 0.3); }
        .btn-secondary:hover { transform: translateY(-3px); box-shadow: 0 8px 20px rgba(107, 114, 128, 0.4); background: linear-gradient(135deg, #9ca3af 0%, #6b7280 100%) !important; color: white !important; }
        .btn-danger { background: var(--danger-gradient) !important; color: white !important; box-shadow: 0 4px 12px rgba(239, 68, 68, 0.3); }
        .btn-danger:hover { transform: translateY(-3px); box-shadow: 0 8px 20px rgba(239, 68, 68, 0.4); background: linear-gradient(135deg, #f87171 0%, #ef4444 100%) !important; color: white !important; }
        .btn-success { background: var(--success-gradient) !important; color: white !important; box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3); }
        .btn-success:hover { transform: translateY(-3px); box-shadow: 0 8px 20px rgba(16, 185, 129, 0.4); background: linear-gradient(135deg, #34d399 0%, #10b981 100%) !important; color: white !important; }
        .d-flex { flex-wrap: wrap; gap: 15px; }
        hr { border-color: #e0e0e0; margin: 25px 0; }
        @keyframes slideUp { from { opacity: 0; transform: translateY(30px); } to { opacity: 1; transform: translateY(0); } }
        @keyframes float { 0%, 100% { transform: translateY(0px); } 50% { transform: translateY(-20px); } }
        @media (max-width: 768px) { body { padding: 20px 10px; } .card-body { padding: 20px !important; } .btn { padding: 10px 18px !important; font-size: 13px; } .d-flex { justify-content: center; } .d-flex > div { width: 100%; display: flex; gap: 10px; } .d-flex > div > button { flex: 1; } }
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