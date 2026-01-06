<?php
// 1. SETUP GIAO DIỆN CHUNG
$pageTitle = "Cập nhật Cố vấn";
require_once __DIR__ . '/../layouts/header.php';
require_once __DIR__ . '/../layouts/sidebar.php';
?>

<div class="main-content">
    <div class="container-fluid">
        
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="page-title mb-0">
                <i class="fas fa-user-edit text-primary me-2"></i>Cập nhật Cố Vấn
            </h2>
            <a href="index.php?page=admin_advisors" class="btn btn-light border text-secondary">
                <i class="fas fa-arrow-left me-1"></i> Quay lại
            </a>
        </div>

        <div class="row">
            <div class="col-md-8 mx-auto">
                <div class="card-custom">
                    <div class="card-body p-4">
                        
                        <form action="index.php?page=admin_advisor_update" method="POST">
                            
                            <div class="mb-4">
                                <label class="form-label fw-bold text-secondary">Mã Số Giảng Viên</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0 text-muted">
                                        <i class="fas fa-id-badge"></i>
                                    </span>
                                    <input type="text" name="msgv" 
                                           class="form-control bg-light text-secondary border-start-0" 
                                           value="<?= $advisor['MaCoVan'] ?? $advisor['MSGV'] ?? '' ?>" 
                                           readonly>
                                    </div>
                                <div class="form-text fst-italic">Mã giảng viên không thể thay đổi.</div>
                            </div>

                            <div class="mb-4">
                                <label class="form-label fw-bold text-secondary">Họ và Tên</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-white border-end-0 text-muted">
                                        <i class="fas fa-user"></i>
                                    </span>
                                    <input type="text" name="ho_ten" 
                                           class="form-control border-start-0" 
                                           value="<?= $advisor['HoTen'] ?>" 
                                           required>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-4">
                                    <label class="form-label fw-bold text-secondary">Email</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-white border-end-0 text-muted">
                                            <i class="fas fa-envelope"></i>
                                        </span>
                                        <input type="email" name="email" 
                                               class="form-control border-start-0" 
                                               value="<?= $advisor['Email'] ?>" 
                                               required>
                                    </div>
                                </div>

                                <div class="col-md-6 mb-4">
                                    <label class="form-label fw-bold text-secondary">Số Điện Thoại</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-white border-end-0 text-muted">
                                            <i class="fas fa-phone"></i>
                                        </span>
                                        <input type="text" name="sdt" 
                                               class="form-control border-start-0" 
                                               value="<?= $advisor['SoDienThoai'] ?>">
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex justify-content-end gap-2 mt-4 pt-3 border-top">
                                <a href="index.php?page=admin_advisors" class="btn btn-light px-4">
                                    Hủy bỏ
                                </a>
                                <button type="submit" class="btn btn-primary px-4 fw-bold">
                                    <i class="fas fa-save me-1"></i> Lưu Thay Đổi
                                </button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php 
require_once __DIR__ . '/../layouts/footer.php'; 
?>