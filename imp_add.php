<?php
    header('Content-Type: application/json'); 
    date_default_timezone_set('Asia/Bangkok');
    include 'connect.php';

    try {
        $conn = new PDO("sqlsrv:server=$serverName;Database=$database", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $breed = isset($_POST['breed']) ? $_POST['breed'] : '';
        $qty = isset($_POST['qty']) ? $_POST['qty'] : '';
        $price = isset($_POST['price']) ? $_POST['price'] : '';
        $inputDate = isset($_POST['inputDate']) ? $_POST['inputDate'] : '';
        $currentTime = date('Y-m-d H:i:s');
        $currentDate = date('Y-m-d', strtotime($inputDate));

        // ตรวจสอบว่ามีการกรอกข้อมูลครบถ้วน
        if (!empty($breed) && !empty($qty) && !empty($price)) {

            
            $IDstmt = $conn->prepare("SELECT TOP(1) importID FROM importChicken ORDER BY importID DESC");
            $IDstmt->execute();
            $ID = $IDstmt->fetch(PDO::FETCH_ASSOC);
        
            $lastID = 0; // กำหนดค่าเริ่มต้นให้กับ $lastID

            if (!empty($ID) && isset($ID['importID'])) {
                $c = substr($ID['importID'], 4); // ตัด "imp-" ออกจาก importID
                $lastID = intval($c); // แปลงส่วนที่เหลือเป็นเลขจำนวนเต็ม
            }
            
            // สร้าง importID ใหม่
            $newID = str_pad($lastID + 1, 3, '0', STR_PAD_LEFT);
            $importID = "imp-" . $newID;

            $sql = "INSERT INTO importChicken (importID, breedID, importQTY, importPrice, importDate, importTime) 
            VALUES (:importID, :breed, :qty, :price, :currentDate, :currentTime)";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':importID', $importID);
            $stmt->bindParam(':breed', $breed);
            $stmt->bindParam(':qty', $qty, PDO::PARAM_INT);
            $stmt->bindParam(':price', $price, PDO::PARAM_INT);
            $stmt->bindParam(':currentDate', $currentDate);
            $stmt->bindParam(':currentTime', $currentTime);

            if ($stmt->execute()) {
                echo json_encode(['status' => 'success', 'message' => 'Record added successfully']);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Error adding record']);
            }
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Invalid input data']);
        }
    } catch (PDOException $e) {
        echo json_encode(['status' => 'error', 'message' => 'Database error: ' . $e->getMessage()]);
    } finally {
        $conn = null; // ปิดการเชื่อมต่อ
    }
?>