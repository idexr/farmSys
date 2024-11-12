<?php
// กำหนด Content-Type เป็น JSON เพื่อให้เข้ากับการตอบกลับ AJAX
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
    $sort_f = isset($_POST['sort_f']) ? $_POST['sort_f'] : '';
    $sort_m = isset($_POST['sort_m']) ? $_POST['sort_m'] : '';
    $sort = isset($_POST['sort']) ? $_POST['sort'] : '';
    $inputDate = isset($_POST['inputDate']) ? $_POST['inputDate'] : '';
    $currentTime = date('H:i:s');
    $currentDate = date('Y-m-d', strtotime($inputDate));

    // ตรวจสอบว่า id และข้อมูลอื่นๆ ถูกส่งมาอย่างถูกต้อง
    if (!empty($id) && !empty($farm) && !empty($coop) && !empty($sort_f) && !empty($sort_m) && !empty($sort) && !empty($inputDate)) {

        // SQL สำหรับอัปเดตข้อมูลในตาราง
        $sql = "UPDATE Chickensort SET 
                    FarmID = :farm, 
                    CoopID = :coop, 
                    sortF = :sort_f, 
                    sortM = :sort_m, 
                    sortTypeID = :sort, 
                    sortDate = :currentDate,
                    sortTime = :currentTime
                WHERE ChickenID = :id";

        // เตรียม statement
        $stmt = $conn->prepare($sql);

        // ผูกค่าที่ได้จาก POST กับ statement
        $stmt->bindParam(':id', $id, PDO::PARAM_STR);
        $stmt->bindParam(':farm', $farm, PDO::PARAM_STR);
        $stmt->bindParam(':coop', $coop, PDO::PARAM_STR);
        $stmt->bindParam(':sort_f', $sort_f, PDO::PARAM_INT);
        $stmt->bindParam(':sort_m', $sort_m, PDO::PARAM_INT);
        $stmt->bindParam(':sort', $sort, PDO::PARAM_STR);
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