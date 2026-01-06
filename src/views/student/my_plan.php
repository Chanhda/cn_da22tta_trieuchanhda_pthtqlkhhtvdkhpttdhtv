<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Chi tiết Kế hoạch học tập</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            min-height: 100vh;
            padding: 2rem 0;
        }

        .container {
            max-width: 900px;
        }

        /* Buttons */
        .btn {
            border-radius: 10px;
            font-weight: 600;
            padding: 0.75rem 1.5rem;
            transition: all 0.3s ease;
            border: none;
        }

        .btn-secondary {
            background-color: #6b7280;
            color: white;
            box-shadow: 0 4px 12px rgba(107, 114, 128, 0.3);
        }

        .btn-secondary:hover {
            background-color: #4b5563;
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(107, 114, 128, 0.4);
            color: white;
        }

        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            box-shadow: 0 4px 12px rgba(102, 126, 234, 0.3);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(102, 126, 234, 0.4);
            background: linear-gradient(135deg, #7c8ff0 0%, #8d5cb5 100%);
            color: white;
        }

        /* Card */
        .card {
            border: none !important;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
            overflow: hidden;
            transition: all 0.3s ease;
            background: white;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.2);
        }

        .card-body {
            padding: 2.5rem;
        }

        /* Header section */
        .header-section {
            text-align: center;
            margin-bottom: 2rem;
            padding-bottom: 2rem;
            border-bottom: 2px solid #e5e7eb;
        }

        .header-section h4 {
            color: #1f2937;
            font-size: 1.5rem;
            letter-spacing: 1px;
            text-transform: uppercase;
            margin-bottom: 0.5rem;
        }

        .header-section .semester-info {
            color: #667eea;
            font-weight: 600;
            font-size: 1.1rem;
            margin-bottom: 0.3rem;
        }

        .header-section .created-date {
            color: #9ca3af;
            font-size: 0.95rem;
            font-style: italic;
        }

        /* Info section */
        .info-section {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 2rem;
            margin-bottom: 2rem;
            padding: 1.5rem;
            background: linear-gradient(135deg, #f9fafb 0%, #f3f4f6 100%);
            border-radius: 12px;
        }

        .info-section .info-item {
            display: flex;
            flex-direction: column;
        }

        .info-section .info-label {
            font-size: 0.9rem;
            color: #6b7280;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            font-weight: 600;
            margin-bottom: 0.4rem;
        }

        .info-section .info-value {
            font-size: 1.1rem;
            color: #1f2937;
            font-weight: 600;
        }

        /* Table */
        .table {
            margin-bottom: 0;
        }

        .table thead {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }

        .table thead th {
            border: none !important;
            padding: 1.2rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            font-size: 0.95rem;
        }

        .table tbody tr {
            border-bottom: 1px solid #e5e7eb;
            transition: all 0.2s ease;
        }

        .table tbody tr:hover {
            background-color: #f9fafb;
            transform: scale(1.01);
        }

        .table tbody td {
            padding: 1.2rem;
            border: none !important;
            vertical-align: middle;
        }

        .table .text-center {
            text-align: center;
        }

        /* Total row */
        .table .total-row {
            background: linear-gradient(135deg, #f0f4ff 0%, #f5f3ff 100%);
            font-weight: 700;
            border-top: 2px solid #667eea !important;
            color: #667eea;
        }

        .table .total-row td {
            padding: 1.5rem !important;
        }

        /* Empty row */
        .table .empty-row {
            color: #9ca3af;
            padding: 2rem !important;
            font-style: italic;
        }

        /* Signature section */
        .signature-section {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 3rem;
            margin-top: 4rem;
            padding-top: 3rem;
            border-top: 2px solid #e5e7eb;
        }

        .signature-box {
            text-align: center;
        }

        .signature-box .title {
            font-weight: 700;
            color: #1f2937;
            font-size: 1rem;
            margin-bottom: 0.5rem;
        }

        .signature-box .subtitle {
            font-size: 0.9rem;
            color: #9ca3af;
            font-style: italic;
            margin-bottom: 2rem;
        }

        .signature-box .signature-line {
            height: 3rem;
            border-bottom: 2px solid #1f2937;
            margin-bottom: 0.5rem;
        }

        .signature-box .name {
            font-size: 0.95rem;
            color: #6b7280;
            margin-top: 1rem;
        }

        .signature-box .approved-badge {
            display: inline-block;
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            color: white;
            padding: 0.6rem 1.5rem;
            border-radius: 8px;
            font-weight: 600;
            font-size: 0.95rem;
            margin: 1rem 0;
            box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);
        }

        /* No-print section */
        .no-print {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
            gap: 1rem;
        }

        /* Print styles */
        @media print {
            .no-print { 
                display: none !important; 
            }

            body {
                background: white !important;
                padding: 0 !important;
            }

            .card {
                border: none !important;
                box-shadow: none !important;
                transform: none !important;
            }

            .btn {
                display: none !important;
            }

            .container {
                max-width: 100% !important;
            }

            .card-body {
                padding: 0 !important;
            }
        }

        /* Responsive */
        @media (max-width: 768px) {
            .card-body {
                padding: 1.5rem;
            }

            .info-section {
                grid-template-columns: 1fr;
                gap: 1rem;
            }

            .signature-section {
                grid-template-columns: 1fr;
                gap: 2rem;
            }

            .table thead th,
            .table tbody td {
                padding: 0.8rem !important;
                font-size: 0.9rem;
            }

            .no-print {
                flex-direction: column-reverse;
            }

            .no-print > * {
                width: 100%;
            }
        }

        /* Animation */
        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .card {
            animation: slideIn 0.5s ease-out;
        }
    </style>
    <link href="assets/css/style.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5 mb-5">
    
    <div class="no-print">
        <a href="index.php?page=dashboard" class="btn btn-secondary">
            <i class="fas fa-arrow-left me-2"></i>Quay lại Dashboard
        </a>
        <button onclick="window.print()" class="btn btn-primary">
            <i class="fas fa-file-pdf me-2"></i>In / Lưu PDF
        </button>
    </div>

    <div class="card shadow">
        <div class="card-body">
            
            <div class="header-section">
                <h4 class="fw-bold">
                    <i class="fas fa-clipboard-list me-2"></i>Phiếu Đăng Ký Kế Hoạch Học Tập
                </h4>
                <p class="semester-info mb-0">Học kỳ: <?php echo $keHoach['HocKy']; ?> - Năm học: <?php echo $keHoach['NamHoc']; ?></p>
                <p class="created-date">
                    <i class="fas fa-calendar-alt me-1"></i>Ngày lập: <?php echo date("d/m/Y H:i", strtotime($keHoach['NgayLap'])); ?>
                </p>
            </div>

            <div class="info-section">
                <div class="info-item">
                    <span class="info-label">
                        <i class="fas fa-user me-1"></i>Họ và tên
                    </span>
                    <span class="info-value"><?php echo $sinhVien['HoTen']; ?></span>
                </div>
                <div class="info-item">
                    <span class="info-label">
                        <i class="fas fa-id-card me-1"></i>MSSV
                    </span>
                    <span class="info-value"><?php echo $sinhVien['MSSV']; ?></span>
                </div>
                <div class="info-item">
                    <span class="info-label">
                        <i class="fas fa-graduation-cap me-1"></i>Lớp
                    </span>
                    <span class="info-value"><?php echo $sinhVien['MaLop']; ?></span>
                </div>
                <div class="info-item">
                    <span class="info-label">
                        <i class="fas fa-building me-1"></i>Khoa
                    </span>
                    <span class="info-value">Kỹ thuật và Công nghệ</span>
                </div>
            </div>

            <table class="table align-middle">
                <thead>
                    <tr>
                        <th class="text-center" style="width: 6%;">
                            <i class="fas fa-list-ol me-1"></i>STT
                        </th>
                        <th style="width: 15%;">
                            <i class="fas fa-code me-1"></i>Mã HP
                        </th>
                        <th>
                            <i class="fas fa-book me-1"></i>Tên học phần
                        </th>
                        <th class="text-center" style="width: 10%;">
                            <i class="fas fa-coins me-1"></i>TC
                        </th>
                        <th class="text-center" style="width: 16%;">
                            <i class="fas fa-clock me-1"></i>Tiết (LT/TH)
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $tongTC = 0; 
                    $stt = 1;
                    if (!empty($chiTietMoneHoc)) {
                        foreach ($chiTietMoneHoc as $hp): 
                            $tongTC += $hp['SoTinChi'];
                    ?>
                    <tr>
                        <td class="text-center fw-bold"><?php echo $stt++; ?></td>
                        <td>
                            <span class="badge bg-light text-dark fw-bold"><?php echo $hp['MaHocPhan']; ?></span>
                        </td>
                        <td><?php echo $hp['TenHocPhan']; ?></td>
                        <td class="text-center fw-bold"><?php echo $hp['SoTinChi']; ?></td>
                        <td class="text-center"><?php echo $hp['SoTietLyThuyet']; ?> / <?php echo $hp['SoTietThucHanh']; ?></td>
                    </tr>
                    <?php endforeach; 
                    } else { ?>
                        <tr>
                            <td colspan="5" class="text-center empty-row">
                                <i class="fas fa-inbox me-1"></i>Không có môn học nào
                            </td>
                        </tr>
                    <?php } ?>
                    
                    <tr class="total-row">
                        <td colspan="3" class="text-end">
                            <i class="fas fa-sum me-1"></i>Tổng cộng:
                        </td>
                        <td class="text-center"><?php echo $tongTC; ?> TC</td>
                        <td></td>
                    </tr>
                </tbody>
            </table>

            <div class="signature-section">
                <div class="signature-box">
                    <p class="title">
                        <i class="fas fa-user-check me-1"></i>Người lập bảng
                    </p>
                    <p class="subtitle">(Ký và ghi rõ họ tên)</p>
                    <div class="signature-line"></div>
                    <p class="name"><?php echo $sinhVien['HoTen']; ?></p>
                </div>
                <div class="signature-box">
                    <p class="title">
                        <i class="fas fa-user-tie me-1"></i>Cố vấn học tập
                    </p>
                    <p class="subtitle">(Xác nhận)</p>
                    
                    <?php if ($keHoach['TrangThai'] == 'DaDuyet'): ?>
                        <div class="approved-badge">
                            <i class="fas fa-check-circle me-1"></i>ĐÃ DUYỆT ONLINE
                        </div>
                    <?php else: ?>
                        <div class="signature-line"></div>
                    <?php endif; ?>
                </div>
            </div>

        </div>
    </div>
</div>

</body>
</html>