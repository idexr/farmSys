<?php
    session_start();

    if(!isset($_SESSION['username'])){
        header("location:login.html");
        exit();
    }

    // กำหนดเวลาเซสชัน (15 นาที)
    $session_timeout = 15 * 60; // 15 นาทีในหน่วยวินาที

    // ตรวจสอบว่ามีการตั้งค่าเซสชันล่าสุดหรือไม่
    if (isset($_SESSION['LAST_ACTIVITY'])) {
        // หากเกินเวลาเซสชัน ให้ทำการลบเซสชันและออกจากระบบ
        if (time() - $_SESSION['LAST_ACTIVITY'] > $session_timeout) {
            session_unset();    // ล้างเซสชัน
            session_destroy();  // ทำลายเซสชัน
            header("Location: logout.php"); // ไปที่หน้า logout หรือหน้าที่ต้องการ
            exit();
        }
    }

    // อัปเดตเวลาเซสชันล่าสุด
    $_SESSION['LAST_ACTIVITY'] = time();
?>