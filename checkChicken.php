<?php 
include 'connect.php';
$importID = $_GET['importID'] ?? '';
if(!empty($importID)){
    try {
        $conn = new PDO("sqlsrv:server=$serverName;Database=$database", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
        $sql = 'SELECT importQTY
                FROM importChicken
                WHERE importID = :importID';
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':importID', $importID);
        $stmt->execute();
        
        // ดึงค่าจากฐานข้อมูล
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
    
        // ตรวจสอบว่าพบข้อมูลหรือไม่
        if ($result) {
            $importQTY = $result['importQTY']; // ดึงค่าจำนวนที่นำเข้า
            echo json_encode(['importQTY' => $importQTY]); // ส่งกลับเป็น JSON
        } else {
            echo json_encode(['result' => 0, 'message' => 'ไม่พบข้อมูลสำหรับ importID ที่ระบุ']);
        }
    
    } catch (PDOException $e) {
        echo json_encode(['result' => -1, 'message' => 'ไม่สามารถเชื่อมต่อกับฐานข้อมูล: ' . $e->getMessage()]); // แจ้งข้อผิดพลาดเป็น JSON
    }
}else{
    try {
        $conn = new PDO("sqlsrv:server=$serverName;Database=$database", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
        // ดึง importID ที่ตรงตามเงื่อนไขจากฐานข้อมูล
        $subquery = 'SELECT importID FROM importChicken';
        $stmt = $conn->query($subquery);
        $selectedImportIDs = $stmt->fetchAll(PDO::FETCH_COLUMN);
    
        // หากไม่มี importID ที่ตรงเงื่อนไข ให้หยุดการทำงาน
        if (empty($selectedImportIDs)) {
            echo json_encode(['result' => 1, 'data' => []]); // แก้ไขให้ส่งค่ากลับเป็น JSON ที่มีโครงสร้างเดียวกัน
            exit;
        }
    
        // นำ importID ที่ได้มาใช้ในคำสั่งหลัก
        $sql = 'SELECT importChicken.importID,
                    MAX(Breeds.breedID) AS breedID,
                    MAX(Breeds.breedName) AS breedName,
                    MAX(importChicken.importQTY) AS importQTY,
                    COALESCE(SUM(ISNULL(Chicken.ChickenF, 0) + ISNULL(Chicken.ChickenM, 0)), 0) AS total
                FROM importChicken
                INNER JOIN Breeds ON importChicken.breedID = Breeds.breedID
                LEFT JOIN Chicken ON importChicken.importID = Chicken.importID
                GROUP BY importChicken.importID
                HAVING MAX(importChicken.importQTY) <> COALESCE(SUM(ISNULL(Chicken.ChickenF, 0) + ISNULL(Chicken.ChickenM, 0)), 0)
                    AND COALESCE(SUM(ISNULL(Chicken.ChickenF, 0) + ISNULL(Chicken.ChickenM, 0)), 0) <= MAX(importChicken.importQTY)
                ORDER BY importChicken.importID DESC';
    
        $stmt = $conn->query($sql);
        $Chicken = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
        // ตรวจสอบถ้า $Chicken เป็นค่าว่าง ให้ส่งค่ากลับเป็น 1
        if (empty($Chicken)) {
            echo json_encode(['result' => 1, 'data' => []]); // ค่ากลับเมื่อไม่มีข้อมูลใน $Chicken
        } else {
            echo json_encode(['result' => 0, 'data' => $Chicken]); // ส่งข้อมูล $Chicken กลับ
        }
    
    } catch (PDOException $e) {
        echo json_encode(['result' => -1, 'message' => 'ไม่สามารถเชื่อมต่อกับฐานข้อมูล: ' . $e->getMessage()]); // แจ้งข้อผิดพลาดเป็น JSON
    }
}


$conn = null;
?>
