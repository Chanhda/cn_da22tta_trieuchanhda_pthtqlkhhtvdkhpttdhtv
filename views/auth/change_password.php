<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đổi Mật Khẩu</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700;800&display=swap" rel="stylesheet">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Nunito', sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 15px;
        }

        .container {
            width: 100%;
            max-width: 500px;
        }

        .card-change-pass {
            border: none;
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            width: 100%;
            overflow: hidden;
            animation: slideUp 0.6s ease-out;
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

        .card-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 2rem 1.5rem;
            text-align: center;
            border: none;
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
            background: radial-gradient(circle, rgba(255, 255, 255, 0.1) 1px, transparent 1px);
            background-size: 20px 20px;
            animation: float 6s ease-in-out infinite;
        }

        @keyframes float {
            0%, 100% { transform: translate(0, 0); }
            50% { transform: translate(10px, -10px); }
        }

        .card-header h4 {
            font-size: 28px;
            font-weight: 800;
            letter-spacing: 0.5px;
            position: relative;
            z-index: 1;
        }

        .icon-header {
            width: 60px;
            height: 60px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 15px;
            font-size: 28px;
            position: relative;
            z-index: 1;
        }

        .card-body {
            padding: 2rem;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-label {
            font-weight: 700;
            color: #2c3e50;
            font-size: 12px;
            letter-spacing: 0.5px;
            text-transform: uppercase;
            margin-bottom: 10px;
            display: block;
        }

        .input-group {
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
            border-radius: 12px;
            overflow: hidden;
            transition: all 0.3s ease;
        }

        .input-group:focus-within {
            box-shadow: 0 4px 20px rgba(102, 126, 234, 0.2);
            transform: translateY(-2px);
        }

        .input-group-text {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white !important;
            border: none !important;
            font-size: 16px;
            padding: 12px 16px;
        }

        .form-control {
            border: none !important;
            padding: 12px 16px !important;
            font-size: 14px;
            color: #2c3e50;
            background-color: #f8f9fb;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            background-color: white;
            box-shadow: none !important;
            color: #2c3e50;
        }

        .form-control::placeholder {
            color: #bdc3c7;
            font-size: 13px;
        }

        .password-strength {
            margin-top: 10px;
            display: none;
        }

        .strength-bar {
            height: 6px;
            background-color: #e5e7eb;
            border-radius: 10px;
            overflow: hidden;
            margin-bottom: 8px;
        }

        .strength-fill {
            height: 100%;
            width: 0%;
            border-radius: 10px;
            transition: all 0.3s ease;
        }

        .strength-text {
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .strength-weak .strength-fill {
            background-color: #ef4444;
            width: 33%;
        }

        .strength-weak .strength-text {
            color: #ef4444;
        }

        .strength-medium .strength-fill {
            background-color: #f59e0b;
            width: 66%;
        }

        .strength-medium .strength-text {
            color: #f59e0b;
        }

        .strength-strong .strength-fill {
            background-color: #10b981;
            width: 100%;
        }

        .strength-strong .strength-text {
            color: #10b981;
        }

        .match-feedback {
            font-size: 12px;
            margin-top: 8px;
            display: none;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .match-feedback.match {
            color: #10b981;
        }

        .match-feedback.mismatch {
            color: #ef4444;
        }

        .button-group {
            display: flex;
            gap: 12px;
            margin-top: 2rem;
            padding-top: 2rem;
            border-top: 2px solid #e5e7eb;
        }

        .btn-back {
            flex: 1;
            border-radius: 12px;
            padding: 12px 20px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            border: none;
            cursor: pointer;
            transition: all 0.3s ease;
            background-color: #e5e7eb;
            color: #4b5563;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .btn-back:hover {
            background-color: #d1d5db;
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
            color: #2c3e50;
        }

        .btn-save {
            flex: 1;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            border-radius: 12px;
            padding: 12px 20px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 10px 20px rgba(102, 126, 234, 0.3);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .btn-save:hover {
            transform: translateY(-2px);
            box-shadow: 0 15px 30px rgba(102, 126, 234, 0.4);
            background: linear-gradient(135deg, #7c8ff0 0%, #8d5cb5 100%);
            color: white;
        }

        .btn-save:active {
            transform: translateY(0);
        }

        .alert {
            border-radius: 12px;
            border: none;
            font-size: 14px;
            font-weight: 600;
            margin-bottom: 1.5rem;
            animation: slideIn 0.3s ease-out;
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateX(-20px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        @media (max-width: 576px) {
            .card-body {
                padding: 1.5rem;
            }

            .card-header h4 {
                font-size: 22px;
            }

            .button-group {
                flex-direction: column-reverse;
            }

            .btn-save,
            .btn-back {
                width: 100%;
            }
        }
    </style>
</head>
<body>

<div class="container">
    <div class="card card-change-pass">
        <div class="card-header">
            <div class="icon-header">
                <i class="fas fa-lock"></i>
            </div>
            <h4 class="mb-0">Đổi Mật Khẩu</h4>
        </div>
        <div class="card-body">
            
            <?php if(isset($error)): ?>
                <div class="alert alert-danger">
                    <i class="fas fa-exclamation-circle me-2"></i>
                    <?php echo $error; ?>
                </div>
            <?php endif; ?>

            <?php if(isset($success)): ?>
                <div class="alert alert-success">
                    <i class="fas fa-check-circle me-2"></i>
                    <?php echo $success; ?>
                </div>
            <?php endif; ?>

            <form action="" method="POST">
                
                <div class="form-group">
                    <label class="form-label">Mật khẩu hiện tại</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-key"></i></span>
                        <input type="password" name="old_pass" class="form-control" id="oldPass" placeholder="Nhập mật khẩu cũ..." required>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Mật khẩu mới</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-lock-open"></i></span>
                        <input type="password" name="new_pass" class="form-control" id="newPass" placeholder="Nhập mật khẩu mới..." required minlength="6">
                    </div>
                    <div class="password-strength" id="strengthMeter">
                        <div class="strength-bar">
                            <div class="strength-fill"></div>
                        </div>
                        <div class="strength-text" id="strengthText">Độ mạnh: Yếu</div>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Xác nhận mật khẩu mới</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-check-circle"></i></span>
                        <input type="password" name="confirm_pass" class="form-control" id="confirmPass" placeholder="Nhập lại mật khẩu mới..." required minlength="6">
                    </div>
                    <div class="match-feedback" id="matchFeedback">
                        <i class="fas fa-info-circle"></i>
                        <span id="matchText"></span>
                    </div>
                </div>

                <div class="button-group">
                    <a href="index.php?page=dashboard" class="btn-back">
                        <i class="fas fa-arrow-left"></i>Hủy bỏ
                    </a>
                    <button type="submit" class="btn-save">
                        <i class="fas fa-save"></i>Lưu thay đổi
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>

<script>
    function checkPasswordStrength(password) {
        let strength = 0;
        
        if (password.length >= 6) strength++;
        if (password.length >= 8) strength++;
        if (/[a-z]/.test(password) && /[A-Z]/.test(password)) strength++;
        if (/[0-9]/.test(password)) strength++;
        if (/[^a-zA-Z0-9]/.test(password)) strength++;
        
        return strength;
    }

    function updatePasswordStrength() {
        const newPassInput = document.getElementById('newPass');
        const strengthMeter = document.getElementById('strengthMeter');
        const strengthText = document.getElementById('strengthText');
        const password = newPassInput.value;

        if (password.length === 0) {
            strengthMeter.style.display = 'none';
            return;
        }

        strengthMeter.style.display = 'block';
        const strength = checkPasswordStrength(password);

        strengthMeter.classList.remove('strength-weak', 'strength-medium', 'strength-strong');

        if (strength <= 2) {
            strengthMeter.classList.add('strength-weak');
            strengthText.textContent = 'Độ mạnh: Yếu 🔴';
        } else if (strength <= 3) {
            strengthMeter.classList.add('strength-medium');
            strengthText.textContent = 'Độ mạnh: Trung bình 🟡';
        } else {
            strengthMeter.classList.add('strength-strong');
            strengthText.textContent = 'Độ mạnh: Mạnh 🟢';
        }
    }

    function updateMatchFeedback() {
        const newPassInput = document.getElementById('newPass');
        const confirmPassInput = document.getElementById('confirmPass');
        const matchFeedback = document.getElementById('matchFeedback');
        const matchText = document.getElementById('matchText');

        if (confirmPassInput.value.length === 0) {
            matchFeedback.style.display = 'none';
            confirmPassInput.style.borderColor = '';
            return;
        }

        matchFeedback.style.display = 'flex';

        if (newPassInput.value === confirmPassInput.value) {
            confirmPassInput.style.borderColor = '#10b981';
            matchText.textContent = 'Mật khẩu trùng khớp ✓';
            matchFeedback.classList.remove('mismatch');
            matchFeedback.classList.add('match');
        } else {
            confirmPassInput.style.borderColor = '#ef4444';
            matchText.textContent = 'Mật khẩu không trùng khớp';
            matchFeedback.classList.remove('match');
            matchFeedback.classList.add('mismatch');
        }
    }

    const newPassInput = document.getElementById('newPass');
    const confirmPassInput = document.getElementById('confirmPass');

    newPassInput.addEventListener('input', function() {
        updatePasswordStrength();
        updateMatchFeedback();
    });

    confirmPassInput.addEventListener('input', updateMatchFeedback);
</script>

</body>
</html>