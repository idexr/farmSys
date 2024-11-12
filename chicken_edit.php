<?php
header('Content-Type: application/json');
date_default_timezone_set('Asia/Bangkok');
include 'connect.php';

try {
    // เชื่อมต่อฐานข้อมูลด้วย PDO
    $conn = new PDO("sqlsrv:server=$serverName;Database=$database", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // รับข้อมูลจากฟอร์มที่ส่งมา
    $id = isset($_POST['id']) ? $_POST['id'] : '';
    $farm = isset($_POST['farm']) ? $_POST['farm'] : '';
    $coop = isset($_POST['coop']) ? $_POST['coop'] : '';
    $chicken = isset($_POST['chicken']) ? $_POST['chicken'] : '';
    $chickenF = isset($_POST['chickenF']) ? $_POST['chickenF'] : '';
    $chickenM = isset($_POST['chickenM']) ? $_POST['chickenM'] : '';
    $inputDate = isset($_POST['inputDate']) ? $_POST['inputDate'] : '';
    $currentTime = date('H:i:s');
    $currentDate = date('Y-m-d', strtotime($inputDate));

    // ตรวจสอบว่า id และข้อมูลอื่นๆ ถูกส่งมาอย่างถูกต้อง
    if (!empty($id) && !empty($farm) && !empty($coop) && !empty($chicken) && !empty($inputDate)) {

        // SQL สำหรับอัปเดตข้อมูลในตาราง
        $sql = "UPDATE Chicken SET 
                    importID = :importID,
                    FarmID = :farm, 
                    CoopID = :coop, 
                    ChickenF = :chickenF, 
                    ChickenM = :chickenM,  
                    ChickenDate = :currentDate,
                    ChickenTime = :currentTime
                WHERE ChickenID = :id";

        // เตรียม statement
        $stmt = $conn->prepare($sql);

        // ผูกค่าที่ได้จาก POST กับ statement
        $stmt->bindParam(':id', $id, PDO::PARAM_STR);
        $stmt->bindParam(':importID', $chicken, PDO::PARAM_STR);
        $stmt->bindParam(':farm', $farm, PDO::PARAM_STR);
        $stmt->bindParam(':coop', $coop, PDO::PARAM_STR);
        $stmt->bindParam(':chickenF', $chickenF, PDO::PARAM_INT);
        $stmt->bindParam(':chickenM', $chickenM, PDO::PARAM_INT);
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