<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập Hệ thống</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        .login-container {
            width: 100%;
            max-width: 420px;
            padding: 15px;
        }
        
        .login-card {
            width: 100%;
            border: none;
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            background: white;
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
        
        .login-card .card-body {
            padding: 40px 35px;
        }
        
        .brand-logo {
            width: 100px;
            height: 100px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 25px;
            color: white;
            font-size: 48px;
            font-weight: bold;
            box-shadow: 0 10px 25px rgba(102, 126, 234, 0.4);
        }
        
        .login-title {
            text-align: center;
            font-size: 28px;
            font-weight: 700;
            color: #2c3e50;
            margin-bottom: 10px;
            letter-spacing: -0.5px;
        }
        
        .login-subtitle {
            text-align: center;
            font-size: 13px;
            color: #95a5a6;
            margin-bottom: 30px;
            font-weight: 500;
        }
        
        .alert {
            border-radius: 12px;
            border: none;
            font-size: 14px;
            font-weight: 600;
            animation: shake 0.5s;
        }
        
        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            25% { transform: translateX(-5px); }
            75% { transform: translateX(5px); }
        }
        
        .form-group {
            margin-bottom: 20px;
        }
        
        .form-label {
            font-weight: 600;
            color: #2c3e50;
            font-size: 13px;
            letter-spacing: 0.5px;
            text-transform: uppercase;
            margin-bottom: 10px;
            display: block;
        }
        
        .form-control {
            border: 2px solid #e8eef5;
            border-radius: 12px;
            padding: 12px 16px;
            font-size: 14px;
            transition: all 0.3s ease;
            background-color: #f8f9fb;
            color: #2c3e50;
        }
        
        .form-control:focus {
            border-color: #667eea;
            background-color: white;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
            outline: none;
        }
        
        .form-control::placeholder {
            color: #bdc3c7;
            font-size: 13px;
        }
        
        .btn-login {
            width: 100%;
            padding: 14px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            border-radius: 12px;
            color: white;
            font-size: 15px;
            font-weight: 700;
            letter-spacing: 0.5px;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-top: 10px;
            box-shadow: 0 10px 20px rgba(102, 126, 234, 0.3);
            text-transform: uppercase;
        }
        
        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 15px 30px rgba(102, 126, 234, 0.4);
            color: white;
            background: linear-gradient(135deg, #7c8ff0 0%, #8d5cb5 100%);
        }
        
        .btn-login:active {
            transform: translateY(0);
        }
        
        .demo-section {
            margin-top: 35px;
            padding-top: 25px;
            border-top: 2px solid #ecf0f1;
        }
        
        .demo-title {
            font-size: 12px;
            font-weight: 700;
            color: #2c3e50;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }
        
        .demo-title i {
            color: #667eea;
            font-size: 14px;
        }
        
        .demo-accounts {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }
        
        .demo-account {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 12px;
            background: linear-gradient(135deg, #f8f9fb 0%, #ecf0f1 100%);
            border-radius: 10px;
            border-left: 4px solid #667eea;
            transition: all 0.3s ease;
            cursor: pointer;
        }
        
        .demo-account:hover {
            background: linear-gradient(135deg, #ecf0f1 0%, #f8f9fb 100%);
            transform: translateX(3px);
        }
        
        .demo-label {
            font-size: 12px;
            font-weight: 600;
            color: #7f8c8d;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        
        .demo-code {
            background: white;
            color: #667eea;
            padding: 6px 12px;
            border-radius: 6px;
            font-weight: 700;
            font-size: 13px;
            font-family: 'Courier New', monospace;
            border: 1px solid #667eea;
        }
    </style>
</head>
<body>

<div class="login-container">
    <div class="card login-card">
        <div class="card-body">
            <div class="brand-logo">🎓</div>
            
            <h1 class="login-title">Đăng Nhập</h1>
            <p class="login-subtitle">Hệ thống quản lý kế hoạch học tập</p>
            
            <?php if(isset($error)): ?>
                <div class="alert alert-danger mb-4">
                    <i class="fas fa-exclamation-circle me-2"></i>
                    <?php echo $error; ?>
                </div>
            <?php endif; ?>

            <form action="index.php?page=login" method="POST">
                
                <div class="form-group">
                    <label class="form-label">Tên đăng nhập</label>
                    <input type="text" name="username" class="form-control" placeholder="MSSV hoặc Mã GV" required autofocus>
                </div>
                
                <div class="form-group">
                    <label class="form-label">Mật khẩu</label>
                    <input type="password" name="password" class="form-control" placeholder="Nhập mật khẩu" required>
                </div>
                
                <button type="submit" class="btn btn-login">
                    <i class="fas fa-sign-in-alt me-2"></i>Đăng nhập
                </button>
            </form>
            
            <div class="demo-section">
                <div class="demo-title">
                    <i class="fas fa-graduation-cap"></i>
                    Tài khoản Demo (Mật khẩu: 123456)
                </div>
                
                <div class="demo-accounts">
                    <div class="demo-account">
                        <span class="demo-label">Sinh viên</span>
                        <span class="demo-code">11001</span>
                    </div>
                    <div class="demo-account">
                        <span class="demo-label">Giáo viên</span>
                        <span class="demo-code">gv001</span>
                    </div>
                    <div class="demo-account">
                        <span class="demo-label">Quản trị viên</span>
                        <span class="demo-code">admin</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>