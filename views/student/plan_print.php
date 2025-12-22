<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>In Kế hoạch học tập</title>
    <style>
        body { font-family: "Times New Roman", Times, serif; font-size: 13pt; line-height: 1.5; margin: 0; padding: 20px; }
        .container { width: 210mm; margin: 0 auto; } /* Khổ A4 */
        .header { text-align: center; margin-bottom: 20px; }
        .header h3, .header h4 { margin: 5px 0; font-weight: bold; }
        .tieu-ngu { font-weight: bold; text-decoration: underline; margin-bottom: 15px; display: block; }
        .title { text-align: center; font-size: 16pt; font-weight: bold; margin: 25px 0; text-transform: uppercase; }
        
        .info-section { margin-bottom: 20px; }
        .info-row { display: flex; justify-content: space-between; margin-bottom: 5px; }
        
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        table, th, td { border: 1px solid black; }
        th { background-color: #f0f0f0; padding: 10px; text-align: center; }
        td { padding: 8px; }
        .center { text-align: center; }

        .signature-section { margin-top: 50px; display: flex; justify-content: space-between; text-align: center; }
        .sign-box { width: 45%; }
        
        /* Chỉ thị cho máy in */
        @media print {
            .no-print { display: none; }
            @page { margin: 20mm; }
        }
    </style>
    <link href="assets/css/style.css" rel="stylesheet">
</head>
<body>

<div class="container">
    <div class="no-print" style="text-align: right; margin-bottom: 20px;">
        <button onclick="window.print()" style="padding: 10px 20px; background: #0d6efd; color: white; border: none; cursor: pointer; font-weight: bold; margin-right: 10px;">🖨️ IN PHIẾU NÀY</button>
        
        <a href="index.php?page=dashboard" style="padding: 10px 20px; background: #6c757d; color: white; border: none; cursor: pointer; text-decoration: none; display: inline-block;">🔙 Quay lại</a>
    </div>

    <div class="header">
        <h4>TRƯỜNG ĐẠI HỌC TRÀ VINH</h4>
        <h4>KHOA KỸ THUẬT VÀ CÔNG NGHỆ</h4>
        <br>
        <h4>CỘNG HÒA XÃ HỘI CHỦ NGHĨA VIỆT NAM</h4>
        <span class="tieu-ngu">Độc lập - Tự do - Hạnh phúc</span>
    </div>

    <div class="title">PHIẾU ĐĂNG KÝ KẾ HOẠCH HỌC TẬP</div>

    <div class="info-section">
        <div class="info-row">
            <span>Họ và tên sinh viên: <b><?php echo $sinhVien['HoTen']; ?></b></span>
            <span>MSSV: <b><?php echo $sinhVien['MSSV']; ?></b></span>
        </div>
        <div class="info-row">
            <span>Lớp: <?php echo $sinhVien['MaLop']; ?></span>
            <span>Chương trình: <?php echo $sinhVien['MaCTDT']; ?></span>
        </div>
        <div class="info-row">
            <span>Ngày lập phiếu: <?php echo date('d/m/Y', strtotime($keHoach['NgayLap'])); ?></span>
            <span>Trạng thái: 
                <?php 
                    if($keHoach['TrangThai'] == 'DaDuyet') echo '<b>ĐÃ DUYỆT</b>';
                    elseif($keHoach['TrangThai'] == 'TuChoi') echo '<b>ĐÃ TỪ CHỐI</b>';
                    else echo 'Chờ duyệt';
                ?>
            </span>
        </div>
    </div>

    <p>Kính gửi Cố vấn học tập, em xin đăng ký kế hoạch học tập dự kiến như sau:</p>
    
    <table>
        <thead>
            <tr>
                <th style="width: 10%;">STT</th>
                <th style="width: 20%;">Mã HP</th>
                <th>Tên học phần</th>
                <th style="width: 10%;">Số TC</th>
                <th style="width: 15%;">LT / TH</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $stt = 1; 
            $tongTC = 0;
            if (!empty($chiTiet)):
                foreach ($chiTiet as $hp): 
                    $tongTC += $hp['SoTinChi'];
            ?>
            <tr>
                <td class="center"><?php echo $stt++; ?></td>
                <td class="center"><?php echo $hp['MaHocPhan']; ?></td>
                <td><?php echo $hp['TenHocPhan']; ?></td>
                <td class="center"><?php echo $hp['SoTinChi']; ?></td>
                <td class="center"><?php echo $hp['SoTietLyThuyet']; ?> / <?php echo $hp['SoTietThucHanh']; ?></td>
            </tr>
            <?php endforeach; endif; ?>
            
            <tr>
                <td colspan="3" style="text-align: right; font-weight: bold; padding-right: 20px;">Tổng số tín chỉ:</td>
                <td class="center" style="font-weight: bold;"><?php echo $tongTC; ?></td>
                <td></td>
            </tr>
        </tbody>
    </table>

    <div class="signature-section">
        <div class="sign-box">
            <p><b>SINH VIÊN ĐĂNG KÝ</b></p>
            <p><i>(Ký và ghi rõ họ tên)</i></p>
            <br><br><br><br>
            <b><?php echo $sinhVien['HoTen']; ?></b>
        </div>

        <div class="sign-box">
            <p>Trà Vinh, ngày......tháng......năm......</p>
            <p><b>CỐ VẤN HỌC TẬP</b></p>
            <p><i>(Duyệt và ký tên)</i></p>
            <br><br><br><br>
            <p>.............................................</p>
        </div>
    </div>
</div>

</body>
</html>