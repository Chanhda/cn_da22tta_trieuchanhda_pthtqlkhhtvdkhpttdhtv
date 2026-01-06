<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng ký Kế hoạch học tập</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        /* --- CORE STYLES --- */
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { 
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%); 
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; 
            min-height: 100vh; 
            padding-bottom: 3rem;
        }
        .container { max-width: 1200px; }

        /* --- NAVBAR --- */
        .navbar {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            border-bottom: 3px solid #667eea;
        }
        .navbar-brand { font-weight: 800; color: #4c51bf !important; letter-spacing: 0.5px; }

        /* --- CARD & FORM --- */
        .card { 
            border: none; 
            border-radius: 16px; 
            box-shadow: 0 10px 25px rgba(0,0,0,0.1); 
            overflow: hidden; 
            animation: slideUp 0.5s ease-out;
        }
        .card-header { 
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); 
            color: white; 
            padding: 1.5rem; 
            border: none;
        }
        .card-title { font-size: 1.25rem; font-weight: 700; margin: 0; }
        .card-subtitle { opacity: 0.9; font-size: 0.9rem; margin-top: 5px; }

        /* --- TABLE STYLES --- */
        .table-responsive { border-radius: 12px; }
        .table thead { background: #f8fafc; }
        .table thead th { 
            color: #475569; 
            font-weight: 700; 
            text-transform: uppercase; 
            font-size: 0.85rem; 
            padding: 1rem;
            border-bottom: 2px solid #e2e8f0;
        }
        .table tbody td { vertical-align: middle; padding: 1rem; color: #334155; }
        .table-hover tbody tr:hover { background-color: #f1f5f9; }
        
        /* Dòng bị vô hiệu hóa (Môn không đủ điều kiện) */
        .row-disabled { background-color: #f8fafc !important; color: #94a3b8 !important; }
        .row-disabled .course-code { background-color: #e2e8f0; color: #94a3b8; }

        /* --- ELEMENTS --- */
        .course-code { 
            font-family: 'Courier New', monospace; 
            font-weight: 700; 
            background-color: #e0e7ff; 
            color: #4338ca; 
            padding: 4px 8px; 
            border-radius: 6px; 
        }
        
        .badge-schedule {
            background: linear-gradient(135deg, #fffbeb 0%, #fef3c7 100%);
            color: #b45309;
            border: 1px solid #fcd34d;
            padding: 6px 12px;
            border-radius: 20px;
            font-weight: 600;
            font-size: 0.85rem;
            display: inline-block;
        }

        .status-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 6px 12px;
            border-radius: 8px;
            font-size: 0.85rem;
            font-weight: 600;
        }
        .status-ok { background-color: #dcfce7; color: #166534; }
        .status-fail { background-color: #fee2e2; color: #991b1b; }

        /* Checkbox Custom */
        .form-check-input {
            width: 1.4rem; height: 1.4rem;
            border: 2px solid #cbd5e1;
            cursor: pointer;
            transition: all 0.2s;
        }
        .form-check-input:checked {
            background-color: #667eea;
            border-color: #667eea;
            transform: scale(1.1);
        }

        /* --- FOOTER BUTTONS --- */
        .action-bar {
            background: #fff;
            padding: 1.5rem;
            border-top: 1px solid #e2e8f0;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .btn-custom {
            padding: 10px 24px;
            border-radius: 10px;
            font-weight: 600;
            transition: all 0.3s;
        }
        .btn-submit {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            color: white;
            border: none;
            box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);
        }
        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 16px rgba(16, 185, 129, 0.4);
            color: white;
        }

        @keyframes slideUp { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: translateY(0); } }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg sticky-top mb-5">
        <div class="container">
            <a class="navbar-brand" href="#"><i class="fas fa-graduation-cap me-2"></i>CỔNG ĐÀO TẠO</a>
            <div class="d-flex align-items-center gap-3">
                <div class="d-none d-md-block text-end">
                    <div class="fw-bold text-dark">Sinh viên</div>
                    <small class="text-muted">HK1 - 2025</small>
                </div>
                <a href="index.php?page=student_dashboard" class="btn btn-outline-secondary btn-sm rounded-pill px-3">
                    <i class="fas fa-arrow-left me-1"></i> Quay lại
                </a>
            </div>
        </div>
    </nav>

    <div class="container">
        <form action="index.php?page=store_plan" method="POST" id="planForm">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <div>
                        <h2 class="card-title"><i class="fas fa-edit me-2"></i>Đăng ký Kế hoạch học tập</h2>
                        <div class="card-subtitle">Vui lòng chọn các học phần cho kỳ học tới</div>
                    </div>
                    <span class="badge bg-white text-primary px-3 py-2 rounded-pill shadow-sm">
                        <i class="fas fa-calendar-alt me-1"></i> Năm học 2025-2026
                    </span>
                </div>

                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0 align-middle">
                            <thead>
                                <tr>
                                    <th class="text-center" style="width: 5%">Chọn</th>
                                    <th style="width: 10%">Mã HP</th>
                                    <th style="width: 30%">Tên Học Phần</th>
                                    <th class="text-center" style="width: 8%">TC</th>
                                    <th style="width: 25%">Lịch Học</th>
                                    <th style="width: 22%">Trạng Thái / Tiên Quyết</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($courses)): ?>
                                    <?php foreach ($courses as $hp): ?>
                                        <?php 
                                            // --- LOGIC PHP XỬ LÝ DỮ LIỆU --- //
                                            
                                            // 1. Kiểm tra Tiên quyết
                                            $canRegister = true; 
                                            $missingSubjects = [];
                                            
                                            if (!empty($hp['TienQuyet'])) {
                                                foreach ($hp['TienQuyet'] as $tq) { 
                                                    // Giả sử $passedCourses là mảng chứa mã các môn đã đậu
                                                    if (!in_array($tq, $passedCourses ?? [])) { 
                                                        $canRegister = false; 
                                                        $missingSubjects[] = $tq; 
                                                    } 
                                                }
                                            }

                                            // 2. Xử lý Lịch học (Tránh lỗi nếu không có lịch)
                                            $hasSchedule = !empty($hp['RawLich']) && !empty($hp['RawLich']['Thu']);
                                            $thu = $hasSchedule ? $hp['RawLich']['Thu'] : 0;
                                            $start = $hasSchedule ? $hp['RawLich']['Start'] : 0;
                                            $end = $hasSchedule ? $hp['RawLich']['End'] : 0;
                                            
                                            // Tạo Data Attributes cho JS dùng
                                            $dataAttrs = "data-name='{$hp['TenHocPhan']}' 
                                                          data-thu='{$thu}' 
                                                          data-start='{$start}' 
                                                          data-end='{$end}'";
                                        ?>

                                        <tr class="<?= $canRegister ? '' : 'row-disabled' ?>">
                                            <td class="text-center">
                                                <input type="checkbox" 
                                                       name="mon_hoc[]" 
                                                       value="<?= $hp['MaHocPhan'] ?>" 
                                                       class="form-check-input course-cb" 
                                                       <?= $canRegister ? '' : 'disabled' ?>
                                                       <?= $dataAttrs ?>>
                                            </td>
                                            <td>
                                                <span class="course-code"><?= $hp['MaHocPhan'] ?></span>
                                            </td>
                                            <td>
                                                <div class="fw-bold"><?= $hp['TenHocPhan'] ?></div>
                                                <?php if (!$canRegister): ?>
                                                    <small class="text-danger d-block d-md-none mt-1">
                                                        Thiếu: <?= implode(', ', $missingSubjects) ?>
                                                    </small>
                                                <?php endif; ?>
                                            </td>
                                            <td class="text-center fw-bold text-secondary">
                                                <?= $hp['SoTinChi'] ?>
                                            </td>
                                            <td>
                                                <?php if ($hasSchedule): ?>
                                                    <span class="badge-schedule">
                                                        <i class="far fa-clock me-1"></i><?= $hp['LichHoc'] ?>
                                                    </span>
                                                <?php else: ?>
                                                    <span class="text-muted small fst-italic">Chưa có lịch</span>
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <?php if ($canRegister): ?>
                                                    <span class="status-badge status-ok">
                                                        <i class="fas fa-check-circle"></i> Đủ điều kiện
                                                    </span>
                                                <?php else: ?>
                                                    <span class="status-badge status-fail" data-bs-toggle="tooltip" title="Bạn chưa học: <?= implode(', ', $missingSubjects) ?>">
                                                        <i class="fas fa-lock"></i> Thiếu: <?= implode(', ', $missingSubjects) ?>
                                                    </span>
                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="6" class="text-center py-5">
                                            <img src="https://cdn-icons-png.flaticon.com/512/7486/7486744.png" alt="Empty" style="width: 64px; opacity: 0.5;">
                                            <p class="text-muted mt-3">Hiện chưa có môn học nào được mở.</p>
                                        </td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="action-bar">
                    <div class="text-muted small">
                        <i class="fas fa-info-circle me-1"></i>
                        Vui lòng kiểm tra kỹ lịch học trước khi lưu.
                    </div>
                    <div class="d-flex gap-2">
                        <a href="index.php?page=student_dashboard" class="btn btn-light btn-custom text-secondary border">
                            Hủy bỏ
                        </a>
                        <button type="submit" class="btn btn-submit btn-custom">
                            <i class="fas fa-save me-2"></i>Lưu Kế Hoạch
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Khởi tạo Tooltip của Bootstrap (để hover xem môn thiếu)
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
            var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl)
            })

            // --- XỬ LÝ KIỂM TRA TRÙNG LỊCH ---
            const checkboxes = document.querySelectorAll('.course-cb');

            checkboxes.forEach(cb => {
                cb.addEventListener('change', function() {
                    // Nếu bỏ tick thì bỏ qua
                    if (!this.checked) return;

                    // Lấy thông tin lịch của môn vừa chọn
                    const nameCurrent = this.dataset.name;
                    const thuCurrent = parseInt(this.dataset.thu); 
                    const startCurrent = parseInt(this.dataset.start); 
                    const endCurrent = parseInt(this.dataset.end);
                    
                    // Nếu môn này chưa có lịch (thu=0) thì không cần check
                    if (thuCurrent === 0) return;

                    // Lấy tất cả các môn ĐANG ĐƯỢC CHỌN khác
                    const checkedBoxes = document.querySelectorAll('.course-cb:checked');
                    
                    checkedBoxes.forEach(other => {
                        if (other === this) return; // Bỏ qua chính nó

                        const nameOther = other.dataset.name;
                        const thuOther = parseInt(other.dataset.thu);
                        const startOther = parseInt(other.dataset.start);
                        const endOther = parseInt(other.dataset.end);

                        // Logic kiểm tra trùng: 
                        // 1. Cùng Thứ
                        // 2. Khoảng thời gian giao nhau: (StartA <= EndB) VÀ (EndA >= StartB)
                        if (thuOther !== 0 && thuCurrent === thuOther && startCurrent <= endOther && endCurrent >= startOther) {
                            
                            // Hiển thị thông báo lỗi bằng SweetAlert2
                            Swal.fire({
                                icon: 'error',
                                title: 'Phát hiện trùng lịch!',
                                html: `
                                    <div class="text-start bg-light p-3 rounded">
                                        <div class="text-danger fw-bold mb-2"><i class="fas fa-exclamation-triangle me-2"></i>Xung đột thời gian:</div>
                                        <div class="mb-1">1. <b>${nameCurrent}</b></div>
                                        <div class="mb-2">2. <b>${nameOther}</b></div>
                                        <hr>
                                        <div class="text-dark">
                                            Thời gian trùng: <span class="badge bg-warning text-dark">Thứ ${thuCurrent} (Tiết ${Math.max(startCurrent, startOther)} - ${Math.min(endCurrent, endOther)})</span>
                                        </div>
                                    </div>
                                `,
                                confirmButtonColor: '#d33',
                                confirmButtonText: 'Đã hiểu, tôi sẽ chọn lại'
                            });

                            // Tự động bỏ chọn môn vừa tick
                            this.checked = false;
                        }
                    });
                });
            });
            
            // --- XỬ LÝ SUBMIT FORM (Thêm xác nhận) ---
            document.getElementById('planForm').addEventListener('submit', function(e) {
                e.preventDefault(); // Chặn gửi ngay lập tức
                
                const selectedCount = document.querySelectorAll('.course-cb:checked').length;
                
                if (selectedCount === 0) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Chưa chọn môn nào',
                        text: 'Vui lòng chọn ít nhất 1 môn học để lập kế hoạch.'
                    });
                    return;
                }

                Swal.fire({
                    title: 'Xác nhận đăng ký?',
                    text: `Bạn đã chọn ${selectedCount} môn học. Bạn có chắc chắn muốn lưu kế hoạch này?`,
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#10b981',
                    cancelButtonColor: '#6b7280',
                    confirmButtonText: 'Đồng ý, Lưu ngay!',
                    cancelButtonText: 'Xem lại'
                }).then((result) => {
                    if (result.isConfirmed) {
                        this.submit(); // Gửi form thật
                    }
                });
            });
        });
    </script>
</body>
</html>