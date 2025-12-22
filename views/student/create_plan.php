<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Lập Kế hoạch học tập</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">
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
            max-width: 1200px;
        }

        /* Card */
        .card {
            border: none !important;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
            overflow: hidden;
            transition: all 0.3s ease;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.2);
        }

        .card-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%) !important;
            color: white !important;
            border: none !important;
            padding: 1.5rem;
            font-weight: 700;
            font-size: 1.3rem;
            letter-spacing: 0.5px;
        }

        .card-body {
            padding: 2rem;
        }

        /* Table */
        .table {
            margin-bottom: 0;
        }

        .table thead {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .table thead th {
            border: none !important;
            padding: 1.2rem;
            vertical-align: middle;
        }

        .table tbody tr {
            border-bottom: 1px solid #e5e7eb;
            transition: all 0.3s ease;
        }

        .table tbody tr:hover {
            background-color: #f9fafb;
            transform: scale(1.01);
        }

        .table tbody td {
            padding: 1.2rem;
            vertical-align: middle;
            border: none;
        }

        .table-secondary {
            background-color: #f3f4f6 !important;
            opacity: 0.7;
        }

        .table-secondary:hover {
            background-color: #e5e7eb !important;
        }

        /* Checkbox */
        .form-check-input {
            width: 1.3rem;
            height: 1.3rem;
            border: 2px solid #667eea;
            border-radius: 0.35rem;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .form-check-input:checked {
            background-color: #667eea;
            border-color: #667eea;
            box-shadow: 0 0 0 0.25rem rgba(102, 126, 234, 0.25);
        }

        .form-check-input:hover:not(:disabled) {
            border-color: #7c8ff0;
            transform: scale(1.1);
        }

        .form-check-input:disabled {
            cursor: not-allowed;
            opacity: 0.5;
        }

        /* Badges & Statuses */
        .text-success {
            color: #10b981 !important;
            font-weight: 600;
        }

        .text-danger {
            color: #ef4444 !important;
            font-weight: 600;
        }

        .text-primary {
            color: #667eea !important;
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

        .btn-success {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            color: white;
            box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);
        }

        .btn-success:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(16, 185, 129, 0.4);
            background: linear-gradient(135deg, #059669 0%, #047857 100%);
            color: white;
        }

        /* Button container */
        .button-group {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 1rem;
            margin-top: 2rem;
            padding-top: 2rem;
            border-top: 2px solid #e5e7eb;
        }

        /* Status badges */
        .status-ok {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.4rem 0.8rem;
            background-color: #d1fae5;
            color: #065f46;
            border-radius: 8px;
            font-size: 0.85rem;
            font-weight: 600;
        }

        .status-missing {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.4rem 0.8rem;
            background-color: #fee2e2;
            color: #991b1b;
            border-radius: 8px;
            font-size: 0.85rem;
            font-weight: 600;
        }

        /* Course info */
        .course-code {
            font-family: 'Courier New', monospace;
            font-weight: 700;
            background-color: #f3f4f6;
            padding: 0.4rem 0.8rem;
            border-radius: 6px;
        }

        .course-schedule {
            background: linear-gradient(135deg, #fef3c7 0%, #fde68a 100%);
            padding: 0.4rem 0.8rem;
            border-radius: 6px;
            font-size: 0.9rem;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .card-header {
                font-size: 1.1rem;
                padding: 1rem;
            }

            .card-body {
                padding: 1rem;
            }

            .table thead th,
            .table tbody td {
                padding: 0.8rem !important;
                font-size: 0.9rem;
            }

            .button-group {
                flex-direction: column-reverse;
            }

            .button-group > * {
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
</head>
<body>
<div class="container mt-5">
    <div class="card shadow">
        <div class="card-header">
            <i class="fas fa-list-check me-2"></i>LẬP KẾ HOẠCH HỌC TẬP MỚI
        </div>
        <div class="card-body">
            <form action="index.php?page=store_plan" method="POST" id="planForm">
                <div class="table-responsive">
                    <table class="table align-middle">
                        <thead class="text-center">
                            <tr>
                                <th style="width: 5%;">
                                    <i class="fas fa-check-square me-1"></i>Chọn
                                </th>
                                <th style="width: 12%;">
                                    <i class="fas fa-code me-1"></i>Mã HP
                                </th>
                                <th style="width: 30%;">
                                    <i class="fas fa-book me-1"></i>Tên môn học
                                </th>
                                <th style="width: 8%;">
                                    <i class="fas fa-coins me-1"></i>TC
                                </th>
                                <th style="width: 20%;">
                                    <i class="fas fa-calendar me-1"></i>Lịch học
                                </th>
                                <th style="width: 25%;">
                                    <i class="fas fa-tasks me-1"></i>Tiên quyết
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($courses as $hp): ?>
                                <?php 
                                    $can = true; 
                                    $miss = [];
                                    foreach ($hp['TienQuyet'] as $tq) { 
                                        if (!in_array($tq, $passedCourses)) { 
                                            $can = false; 
                                            $miss[] = $tq; 
                                        } 
                                    }
                                    $sch = $hp['RawLich'];
                                    $attr = "data-thu='{$sch['Thu']}' data-start='{$sch['Start']}' data-end='{$sch['End']}' data-name='{$hp['TenHocPhan']}'";
                                ?>
                                <tr class="<?= $can ? '' : 'table-secondary text-muted' ?>">
                                    <td class="text-center">
                                        <input type="checkbox" name="mon_hoc[]" value="<?= $hp['MaHocPhan'] ?>" class="course-cb form-check-input" <?= $can ? '' : 'disabled' ?> <?= $attr ?>>
                                    </td>
                                    <td class="text-center">
                                        <span class="course-code"><?= $hp['MaHocPhan'] ?></span>
                                    </td>
                                    <td>
                                        <div class="fw-600 text-dark"><?= $hp['TenHocPhan'] ?></div>
                                    </td>
                                    <td class="text-center">
                                        <span class="badge bg-primary rounded-pill fs-6"><?= $hp['SoTinChi'] ?></span>
                                    </td>
                                    <td class="text-center">
                                        <span class="course-schedule"><?= $hp['LichHoc'] ?></span>
                                    </td>
                                    <td class="small">
                                        <?php if ($can): ?>
                                            <span class="status-ok">
                                                <i class="fas fa-check-circle"></i>Đủ ĐK
                                            </span>
                                        <?php else: ?>
                                            <span class="status-missing">
                                                <i class="fas fa-times-circle"></i>Thiếu: <?= implode(', ', $miss) ?>
                                            </span>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                
                <div class="button-group">
                    <a href="index.php?page=dashboard" class="btn btn-secondary">
                        <i class="fas fa-arrow-left me-2"></i>Quay lại
                    </a>
                    <button type="submit" class="btn btn-success fw-bold">
                        <i class="fas fa-save me-2"></i>Lưu Kế Hoạch
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
document.querySelectorAll('.course-cb').forEach(cb => {
    cb.addEventListener('change', function() {
        if (!this.checked) return;
        const t1 = this.dataset.thu; 
        const s1 = parseInt(this.dataset.start); 
        const e1 = parseInt(this.dataset.end);
        
        document.querySelectorAll('.course-cb:checked').forEach(o => {
            if (o === this) return;
            if (t1 === o.dataset.thu && s1 <= parseInt(o.dataset.end) && e1 >= parseInt(o.dataset.start)) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Trùng lịch học!',
                    text: `Trùng lịch với môn "${o.dataset.name}" vào Thứ ${t1}`,
                    confirmButtonColor: '#667eea',
                    confirmButtonText: 'Đã hiểu'
                });
                this.checked = false;
            }
        });
    });
});
</script>

</body>
</html>