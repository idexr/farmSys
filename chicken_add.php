<?php
    header('Content-Type: application/json'); 
    date_default_timezone_set('Asia/Bangkok');
    include 'connect.php';

    try {
        $conn = new PDO("sqlsrv:server=$serverName;Database=$database", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $farm = isset($_POST['farm']) ? $_POST['farm'] : '';
        $coop = isset($_POST['coop']) ? $_POST['coop'] : '';
        $importID = isset($_POST['chicken']) ? $_POST['chicken'] : '';
        $chickenF = isset($_POST['chickenF']) ? intval($_POST['chickenF']) : 0;
        $chickenM = isset($_POST['chickenM']) ? intval($_POST['chickenM']) : 0;
        $total = $chickenF + $chickenM;
        $status = '1';
        $inputDate = isset($_POST['inputDate']) ? $_POST['inputDate'] : '';
        $currentTime = date('Y-m-d H:i:s');
        $currentDate = date('Y-m-d', strtotime($inputDate));

        // ตรวจสอบว่ามีการกรอกข้อมูลครบถ้วน
        if (!empty($farm) && !empty($coop)) {


            $sql = 'SELECT importChicken.importID,
                        MAX(Breeds.breedID) AS breedID,
                        MAX(Breeds.breedName) AS breedName,
                        MAX(importChicken.importQTY) AS importQTY,
                        COALESCE(SUM(ISNULL(Chicken.ChickenF, 0) + ISNULL(Chicken.ChickenM, 0)), 0) AS totalChicken
                    FROM importChicken
                    INNER JOIN Breeds ON importChicken.breedID = Breeds.breedID
                    LEFT JOIN Chicken ON importChicken.importID = Chicken.importID
                    WHERE importChicken.importID = :importID
                    GROUP BY importChicken.importID
                    ORDER BY importChicken.importID DESC';
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':importID', $importID, PDO::PARAM_STR);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            // ตรวจสอบว่าได้ผลลัพธ์หรือไม่
            if ($result) {
                $importQTY = $result['importQTY'] - $result['totalChicken'];
            } else {
                echo json_encode(['status' => 'error', 'message' => 'ไม่พบข้อมูลสำหรับ importID ที่ระบุ']);
                exit;
            }

            if ($total > $importQTY) {
                echo json_encode(['status' => 'error', 'message' => 'เกินจำนวนที่นำเข้า สามารถเพิ่มได้อีก' . $importQTY . 'ตัว']);
                exit; // หยุดการทำงานและไม่บันทึกข้อมูล
            }
            
            $IDstmt = $conn->prepare("SELECT TOP(1) ChickenID FROM Chicken ORDER BY ChickenID DESC");
            $IDstmt->execute();
            $ID = $IDstmt->fetch(PDO::FETCH_ASSOC);
        
            $lastID = 0; // กำหนดค่าเริ่มต้นให้กับ $lastID

            if (!empty($ID) && isset($ID['ChickenID'])) {
                $c = substr($ID['ChickenID'], 3); // ตัด "imp-" ออกจาก importID
                $lastID = intval($c); // แปลงส่วนที่เหลือเป็นเลขจำนวนเต็ม
            }
            
            // สร้าง importID ใหม่
            $newID = str_pad($lastID + 1, 3, '0', STR_PAD_LEFT);
            $chickenID = "ck-" . $newID;

            $sql = "INSERT INTO Chicken (ChickenID, importID, FarmID, CoopID, ChickenF, ChickenM, ChickenStatus, ChickenDate, ChickenTime) 
            VALUES (:chickenID, :importID, :farm, :coop, :chickenF, :chickenM, :chickenStatus, :currentDate, :currentTime)";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':chickenID', $chickenID);
            $stmt->bindParam(':importID', $importID);
            $stmt->bindParam(':farm', $farm);
            $stmt->bindParam(':coop', $coop);
            $stmt->bindParam(':chickenF', $chickenF, PDO::PARAM_INT);
            $stmt->bindParam(':chickenM', $chickenM, PDO::PARAM_INT);
            $stmt->bindParam(':chickenStatus', $status);
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