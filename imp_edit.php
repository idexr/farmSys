<?php
// กำหนด Content-Type เป็น JSON เพื่อให้เข้ากับการตอบกลับ AJAX
header('Content-Type: application/json');

// นำเข้าไฟล์สำหรับเชื่อมต่อฐานข้อมูล
include 'connect.php';

try {
    // เชื่อมต่อฐานข้อมูลด้วย PDO
    $conn = new PDO("sqlsrv:server=$serverName;Database=$database", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $importID = isset($_POST['importID']) ? $_POST['importID'] : '';
    $breed = isset($_POST['breed']) ? $_POST['breed'] : '';
    $qty = isset($_POST['qty']) ? $_POST['qty'] : '';
    $price = isset($_POST['price']) ? $_POST['price'] : '';
    $inputDate = isset($_POST['inputDate']) ? $_POST['inputDate'] : '';
    $currentTime = date('Y-m-d H:i:s');
    $currentDate = date('Y-m-d', strtotime($inputDate));

    // ตรวจสอบว่า id และข้อมูลอื่นๆ ถูกส่งมาอย่างถูกต้อง
    if (!empty($importID) && !empty($breed) && !empty($qty) && !empty($price)) {

        // SQL สำหรับอัปเดตข้อมูลในตาราง
        $sql = "UPDATE importChicken SET 
                    breedID = :breed,
                    importQTY = :qty, 
                    importPrice = :price, 
                    importDate = :currentDate,
                    importTime = :currentTime
                WHERE importID = :importID";

        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':importID', $importID);
        $stmt->bindParam(':breed', $breed);
        $stmt->bindParam(':qty', $qty, PDO::PARAM_INT);
        $stmt->bindParam(':price', $price, PDO::PARAM_INT);
        $stmt->bindParam(':currentDate', $currentDate);
        $stmt->bindParam(':currentTime', $currentTime);

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