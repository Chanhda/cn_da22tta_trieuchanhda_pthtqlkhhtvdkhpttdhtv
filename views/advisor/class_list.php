<style>
    :root {
        --primary-gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        --secondary-gradient: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
    }

    body {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        min-height: 100vh;
        font-family: 'Nunito', sans-serif;
    }

    .row {
        padding: 40px 20px;
    }

    .card {
        border-radius: 20px !important;
        box-shadow: 0 10px 40px rgba(102, 126, 234, 0.3) !important;
        border: none !important;
        overflow: hidden;
        animation: slideUp 0.6s ease-out;
    }

    .card-header {
        background: var(--primary-gradient) !important;
        padding: 25px !important;
        border: none !important;
        color: white !important;
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
        background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
        animation: float 3s ease-in-out infinite;
    }

    .card-header h5 {
        font-weight: 800 !important;
        font-size: 22px !important;
        position: relative;
        z-index: 1;
        margin: 0 !important;
    }

    .card-header i {
        font-size: 24px;
    }

    .card-body {
        padding: 30px !important;
        background: #f8f9ff;
    }

    .alert {
        border-radius: 15px !important;
        border: none !important;
        padding: 25px !important;
        text-align: center !important;
        font-weight: 600 !important;
        font-size: 16px;
        animation: slideUp 0.5s ease-out;
    }

    .alert-warning {
        background: linear-gradient(135deg, #f5a623 0%, #f5842e 100%) !important;
        color: white !important;
        box-shadow: 0 4px 15px rgba(245, 166, 35, 0.3);
    }

    .alert-warning i {
        margin-right: 10px;
    }

    .table-responsive {
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
    }

    .table {
        margin-bottom: 0 !important;
        font-size: 15px;
    }

    .table thead {
        background: var(--primary-gradient) !important;
    }

    .table thead th {
        color: white !important;
        padding: 18px 16px !important;
        font-weight: 700 !important;
        font-size: 14px !important;
        letter-spacing: 0.5px;
        border: none !important;
    }

    .table tbody tr {
        border-bottom: 1px solid #e0e0e0 !important;
        transition: all 0.3s ease;
    }

    .table tbody tr:hover {
        background-color: #f5f5ff !important;
        transform: translateX(5px);
        box-shadow: inset 0 0 10px rgba(102, 126, 234, 0.1);
    }

    .table tbody tr:nth-child(even) {
        background-color: #f9f9ff;
    }

    .table tbody td {
        padding: 16px !important;
        color: #333;
        vertical-align: middle;
    }

    .table tbody td.fw-bold {
        color: #667eea !important;
        font-size: 16px;
    }

    .badge {
        border-radius: 8px !important;
        padding: 8px 14px !important;
        font-weight: 700 !important;
        font-size: 13px;
        background: linear-gradient(135deg, #a8edea 0%, #fed6e3 100%) !important;
        color: #333 !important;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    }

    .btn {
        border-radius: 10px !important;
        padding: 10px 20px !important;
        font-weight: 700 !important;
        font-size: 13px;
        transition: all 0.3s ease;
        border: none !important;
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }

    .btn-info {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%) !important;
        color: white !important;
        box-shadow: 0 4px 12px rgba(102, 126, 234, 0.3);
    }

    .btn-info:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 20px rgba(102, 126, 234, 0.4);
        background: linear-gradient(135deg, #7c8ff0 0%, #8d5cb5 100%) !important;
        color: white !important;
    }

    @keyframes slideUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes float {
        0%, 100% {
            transform: translateY(0px);
        }
        50% {
            transform: translateY(-20px);
        }
    }

    @media (max-width: 768px) {
        .card {
            margin: 0 -10px;
            border-radius: 15px !important;
        }

        .card-header h5 {
            font-size: 18px !important;
        }

        .card-body {
            padding: 20px !important;
        }

        .table {
            font-size: 13px;
        }

        .table thead th {
            padding: 12px 8px !important;
        }

        .table tbody td {
            padding: 12px 8px !important;
        }

        .btn {
            padding: 8px 16px !important;
            font-size: 12px;
        }

        .row {
            padding: 20px 10px;
        }
    }
</style>

<div class="row justify-content-center">
    <div class="col-md-10">
        <div class="card shadow border-0">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0"><i class="fas fa-chalkboard-teacher me-2"></i> Lớp tôi quản lý</h5>
            </div>
            <div class="card-body">
                <?php if(empty($dsLop)): ?>
                    <div class="alert alert-warning text-center">
                        <i class="fas fa-inbox"></i> Bạn chưa được phân công chủ nhiệm lớp nào.
                    </div>
                <?php else: ?>
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th><i class="fas fa-key me-2"></i>Mã Lớp</th>
                                    <th><i class="fas fa-graduation-cap me-2"></i>Tên Lớp</th>
                                    <th class="text-center"><i class="fas fa-users me-2"></i>Số lượng SV</th>
                                    <th class="text-end"><i class="fas fa-cogs me-2"></i>Hành động</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($dsLop as $lop): ?>
                                <tr>
                                    <td class="fw-bold"><?php echo $lop['MaLop']; ?></td>
                                    <td><?php echo $lop['TenLop']; ?></td>
                                    <td class="text-center">
                                        <span class="badge"><i class="fas fa-user-circle me-1"></i>--</span> 
                                    </td>
                                    <td class="text-end">
                                        <a href="#" class="btn btn-sm btn-info text-white">
                                            <i class="fas fa-users"></i> Xem SV
                                        </a>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>