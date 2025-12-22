<?php
class Validation {

    // 1. Kiểm tra Tiên quyết
    // Trả về mảng các lỗi (nếu có)
    public static function checkPrerequisites($selectedCourses, $passedCourses, $prerequisiteRules) {
        $errors = [];
        
        foreach ($prerequisiteRules as $rule) {
            $monDangKy = $rule['MaHocPhan'];
            $monCanHoc = $rule['MaHocPhan_TienQuyet'];
            $tenMonCanHoc = $rule['TenTienQuyet'];

            // Nếu môn đăng ký nằm trong danh sách chọn
            if (in_array($monDangKy, $selectedCourses)) {
                // Kiểm tra xem đã học môn cần học chưa
                if (!in_array($monCanHoc, $passedCourses)) {
                    $errors[] = "Môn <b>$monDangKy</b> yêu cầu phải học xong môn <b>$tenMonCanHoc ($monCanHoc)</b> trước.";
                }
            }
        }
        return $errors;
    }

    // 2. Kiểm tra Trùng lịch
    public static function checkScheduleConflict($schedules) {
        $errors = [];
        $count = count($schedules);

        // So sánh từng cặp lịch học
        for ($i = 0; $i < $count - 1; $i++) {
            for ($j = $i + 1; $j < $count; $j++) {
                $monA = $schedules[$i];
                $monB = $schedules[$j];

                // Nếu cùng Thứ
                if ($monA['Thu'] == $monB['Thu']) {
                    // Kiểm tra khoảng thời gian có chồng lên nhau không
                    // Công thức: (StartA < EndB) && (StartB < EndA)
                    $endA = $monA['TietBatDau'] + $monA['SoTiet'];
                    $endB = $monB['TietBatDau'] + $monB['SoTiet'];

                    if ($monA['TietBatDau'] < $endB && $monB['TietBatDau'] < $endA) {
                        $thu = ($monA['Thu'] == 8) ? "Chủ Nhật" : "Thứ " . $monA['Thu'];
                        $errors[] = "Trùng lịch học <b>$thu</b> giữa môn <b>{$monA['TenHocPhan']}</b> và <b>{$monB['TenHocPhan']}</b>.";
                    }
                }
            }
        }
        return $errors;
    }
}
?>