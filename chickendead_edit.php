<?php
date_default_timezone_set('Asia/Bangkok');
header('Content-Type: application/json');

// นำเข้าไฟล์สำหรับเชื่อมต่อฐานข้อมูล
include 'connect.php';

try {
    // เชื่อมต่อฐานข้อมูลด้วย PDO
    $conn = new PDO("sqlsrv:server=$serverName;Database=$database", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // รับข้อมูลจากฟอร์มที่ส่งมา
    $id = isset($_POST['id']) ? $_POST['id'] : '';
    $farm = isset($_POST['farm']) ? $_POST['farm'] : '';
    $coop = isset($_POST['coop']) ? $_POST['coop'] : '';
    $dead_f = isset($_POST['dead_f']) ? $_POST['dead_f'] : '';
    $dead_m = isset($_POST['dead_m']) ? $_POST['dead_m'] : '';
    $dead = isset($_POST['dead']) ? $_POST['dead'] : '';
    $inputDate = isset($_POST['inputDate']) ? $_POST['inputDate'] : '';
    $currentTime = date('H:i:s');
    $currentDate = date('Y-m-d', strtotime($inputDate));

    // ตรวจสอบว่า id และข้อมูลอื่นๆ ถูกส่งมาอย่างถูกต้อง
    if (!empty($id) && !empty($farm) && !empty($coop) && !empty($dead) && !empty($inputDate)) {

        // SQL สำหรับอัปเดตข้อมูลในตาราง
        $sql = "UPDATE Dead SET 
                    FarmID = :farm, 
                    CoopID = :coop, 
                    DeadF = :dead_f, 
                    DeadM = :dead_m, 
                    DeadTypeID = :dead, 
                    DeadDate = :currentDate,
                    DeadTime = :currentTime
                WHERE DeadID = :id";

        // เตรียม statement
        $stmt = $conn->prepare($sql);

        // ผูกค่าที่ได้จาก POST กับ statement
        $stmt->bindParam(':id', $id, PDO::PARAM_STR);
        $stmt->bindParam(':farm', $farm, PDO::PARAM_STR);
        $stmt->bindParam(':coop', $coop, PDO::PARAM_STR);
        $stmt->bindParam(':dead_f', $dead_f, PDO::PARAM_INT);
        $stmt->bindParam(':dead_m', $dead_m, PDO::PARAM_INT);
        $stmt->bindParam(':dead', $dead, PDO::PARAM_STR);
        $stmt->bindParam(':currentDate', $currentDate, PDO::PARAM_STR);
        $stmt->bindParam(':currentTime', $currentTime, PDO::PARAM_STR);

        // ดำเนินการอัปเดตข้อมูล
        if ($stmt->execute()) {
            // หากสำเร็จ ส่งผลลัพธ์ในรูปแบบ JSON
            echo json_encode(["status" => "success", "message" => "Record updated successfully"]);
        } else {
            // หากล้มเหลว ส่งผลลัพธ์ในรูปแบบ JSON
            echo json_encode(["status" => "error", "message" => "Error updating record"]);
        }

    } else {
        // หากข้อมูลไม่ถูกต้องหรือไม่ครบถ้วน
        echo json_encode(["status" => "error", "message" => "Invalid or missing data"]);
    }

} catch (PDOException $e) {
    // กรณีเกิดข้อผิดพลาดในการเชื่อมต่อหรือการทำงาน
    echo json_encode(["status" => "error", "message" => "Connection failed: " . $e->getMessage()]);
}

// ปิดการเชื่อมต่อ
$conn = null;
?>