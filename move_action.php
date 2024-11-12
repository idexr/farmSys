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
    $chicken = isset($_POST['chicken']) ? $_POST['chicken'] : '';
    $move = isset($_POST['move']) ? $_POST['move'] : '';
    $chickenF = isset($_POST['chickenF']) ? $_POST['chickenF'] : '';
    $chickenM = isset($_POST['chickenM']) ? $_POST['chickenM'] : '';
    $inputDate = isset($_POST['inputDate']) ? $_POST['inputDate'] : '';
    $currentTime = date('Y-m-d H:i:s');
    $currentDate = date('Y-m-d', strtotime($inputDate));
    $status = '1';

    // ตรวจสอบว่า id และข้อมูลอื่นๆ ถูกส่งมาอย่างถูกต้อง
    if (!empty($id) && !empty($farm) && !empty($coop) && !empty($chicken) && !empty($inputDate)) {
        // ตรวจสอบว่าเล้าที่ต้องการย้ายไปมีอยู่ในฐานข้อมูลหรือไม่
        $sqlCheckCoop = "SELECT COUNT(*) FROM Chicken WHERE CoopID = :movecoop AND FarmID = :farm";
        $stmtCheckCoop = $conn->prepare($sqlCheckCoop);
        $stmtCheckCoop->bindParam(':movecoop', $move, PDO::PARAM_STR);
        $stmtCheckCoop->bindParam(':farm', $farm, PDO::PARAM_STR);
        $stmtCheckCoop->execute();

        $coopExists = $stmtCheckCoop->fetchColumn() > 0; // ตรวจสอบว่าเล้านั้นมีอยู่หรือไม่

        if($coopExists){
            // ถ้าเล้ามีอยู่ ทำการย้ายไก่ตามปกติ
            // SQL สำหรับอัปเดตตาราง Chicken เพื่อลดจำนวนไก่ในฟาร์มต้นทาง
            // SQL สำหรับเพิ่มข้อมูลลงในตาราง Move
            $sql = "INSERT INTO Move (ChickenID, FarmID, CoopID, MoveF, MoveM, MoveCoopID, MoveDate, MoveTime)
                    VALUES (:id, :farm, :coop, :chickenF, :chickenM, :movecoop, :currentDate, :currentTime)";
            $stmtInsert = $conn->prepare($sql);

            // ผูกค่าที่ได้จาก POST กับ statement
            $stmtInsert->bindParam(':id', $id, PDO::PARAM_STR);
            $stmtInsert->bindParam(':farm', $farm, PDO::PARAM_STR);
            $stmtInsert->bindParam(':coop', $coop, PDO::PARAM_STR);
            $stmtInsert->bindParam(':movecoop', $move, PDO::PARAM_STR);
            $stmtInsert->bindParam(':chickenF', $chickenF, PDO::PARAM_INT);
            $stmtInsert->bindParam(':chickenM', $chickenM, PDO::PARAM_INT);
            $stmtInsert->bindParam(':currentDate', $currentDate, PDO::PARAM_STR);
            $stmtInsert->bindParam(':currentTime', $currentTime, PDO::PARAM_STR);
            $stmtInsert->execute();

            // SQL สำหรับอัปเดตตาราง Chicken เพื่อลดจำนวนไก่ในฟาร์มต้นทาง
            $sqlUpdate1 = "UPDATE Chicken SET ChickenF = ChickenF - :chickenF ,ChickenM = ChickenM - :chickenM 
                        WHERE FarmID = :farm AND CoopID = :coop AND ChickenID = :id";
            $stmtUpdate1 = $conn->prepare($sqlUpdate1);
            $stmtUpdate1->bindParam(':id', $id, PDO::PARAM_STR);
            $stmtUpdate1->bindParam(':farm', $farm, PDO::PARAM_STR);
            $stmtUpdate1->bindParam(':coop', $coop, PDO::PARAM_STR);
            $stmtUpdate1->bindParam(':chickenF', $chickenF, PDO::PARAM_INT);
            $stmtUpdate1->bindParam(':chickenM', $chickenM, PDO::PARAM_INT);
            $stmtUpdate1->execute();

            // SQL สำหรับอัปเดตตาราง Chicken เพื่อเพิ่มจำนวนไก่ในฟาร์มปลายทาง
            $sqlUpdate2 = "UPDATE Chicken SET ChickenF = ChickenF + :chickenF ,ChickenM = ChickenM + :chickenM 
                        WHERE FarmID = :farm AND CoopID = :movecoop AND ChickenID = :id";
            $stmtUpdate2 = $conn->prepare($sqlUpdate2);
            $stmtUpdate2->bindParam(':id', $id, PDO::PARAM_STR);
            $stmtUpdate2->bindParam(':farm', $farm, PDO::PARAM_STR);
            $stmtUpdate2->bindParam(':movecoop', $move, PDO::PARAM_STR);
            $stmtUpdate2->bindParam(':chickenF', $chickenF, PDO::PARAM_INT);
            $stmtUpdate2->bindParam(':chickenM', $chickenM, PDO::PARAM_INT);

            // ดำเนินการอัปเดตข้อมูล
            if ($stmtUpdate2->execute()) {
                // หากสำเร็จ ส่งผลลัพธ์ในรูปแบบ JSON
                echo json_encode(["status" => "success", "message" => "Record updated successfully"]);
            } else {
                // หากล้มเหลว ส่งผลลัพธ์ในรูปแบบ JSON
                echo json_encode(["status" => "error", "message" => "Error updating record"]);
            }
        } else {
            $sql = "INSERT INTO Move (ChickenID, FarmID, CoopID, MoveF, MoveM, MoveCoopID, MoveDate, MoveTime)
                    VALUES (:id, :farm, :coop, :chickenF, :chickenM, :movecoop, :currentDate, :currentTime)";
            $stmtInsert = $conn->prepare($sql);

            // ผูกค่าที่ได้จาก POST กับ statement
            $stmtInsert->bindParam(':id', $id, PDO::PARAM_STR);
            $stmtInsert->bindParam(':farm', $farm, PDO::PARAM_STR);
            $stmtInsert->bindParam(':coop', $coop, PDO::PARAM_STR);
            $stmtInsert->bindParam(':movecoop', $move, PDO::PARAM_STR);
            $stmtInsert->bindParam(':chickenF', $chickenF, PDO::PARAM_INT);
            $stmtInsert->bindParam(':chickenM', $chickenM, PDO::PARAM_INT);
            $stmtInsert->bindParam(':currentDate', $currentDate, PDO::PARAM_STR);
            $stmtInsert->bindParam(':currentTime', $currentTime, PDO::PARAM_STR);
            $stmtInsert->execute();

            // SQL สำหรับอัปเดตตาราง Chicken เพื่อลดจำนวนไก่ในฟาร์มต้นทาง
            $sqlUpdate1 = "UPDATE Chicken SET ChickenF = ChickenF - :chickenF ,ChickenM = ChickenM - :chickenM 
                        WHERE FarmID = :farm AND CoopID = :coop AND ChickenID = :id";
            $stmtUpdate1 = $conn->prepare($sqlUpdate1);
            $stmtUpdate1->bindParam(':id', $id, PDO::PARAM_STR);
            $stmtUpdate1->bindParam(':farm', $farm, PDO::PARAM_STR);
            $stmtUpdate1->bindParam(':coop', $coop, PDO::PARAM_STR);
            $stmtUpdate1->bindParam(':chickenF', $chickenF, PDO::PARAM_INT);
            $stmtUpdate1->bindParam(':chickenM', $chickenM, PDO::PARAM_INT);
            $stmtUpdate1->execute();
            // ถ้าเล้าไม่มีอยู่ ให้สร้างเล้าใหม่
            $stmt = $conn->prepare("SELECT TOP(1) ChickenID FROM Chicken ORDER BY ChickenID DESC");
            $stmt->execute();
            $ID = $stmt->fetch(PDO::FETCH_ASSOC);
        
            if (!empty($ID)) {
                $c = substr($ID['ChickenID'],3);
                $lastID = intval($c);
                $newID = str_pad($lastID + 1, 3, '0', STR_PAD_LEFT);
                $chickenID = "ck-".strval($newID);
            }else{
                $newID = str_pad($lastID + 1, 3, '0', STR_PAD_LEFT);
                $chickenID = "ck-".strval($newID);
            }

            $sqlCreateCoop = "INSERT INTO Chicken (ChickenID, breedID, FarmID, CoopID, ChickenF, ChickenM, ChickenPrice, ChickenStatus, ChickenDate, ChickenTime) 
                              VALUES (:chickenID, :chicken, :farm, :coop, :chickenF, :chickenM, :chickenPrice, :chickenStatus, :currentDate, :currentTime)";
            $stmtCreateCoop = $conn->prepare($sqlCreateCoop);

            // ผูกค่าที่จะส่งไปในคำสั่ง
            $stmtCreateCoop->bindParam(':chickenID', $chickenID, PDO::PARAM_STR);
            $stmtCreateCoop->bindParam(':chicken', $chicken, PDO::PARAM_STR);
            $stmtCreateCoop->bindParam(':farm', $farm, PDO::PARAM_STR);
            $stmtCreateCoop->bindParam(':coop', $move, PDO::PARAM_STR);
            $stmtCreateCoop->bindParam(':chickenF', $chickenF, PDO::PARAM_INT);
            $stmtCreateCoop->bindParam(':chickenM', $chickenM, PDO::PARAM_INT);
            $stmtCreateCoop->bindParam(':chickenStatus', $status, PDO::PARAM_STR);
            $stmtCreateCoop->bindParam(':currentDate', $currentDate, PDO::PARAM_STR);
            $stmtCreateCoop->bindParam(':currentTime', $currentTime, PDO::PARAM_STR);

            // ถ้าสร้างเล้าใหม่สำเร็จ
            if ($stmtCreateCoop->execute()) {
            echo json_encode(["status" => "success", "message" => "New coop created and chickens added."]);
            } else {
            echo json_encode(["status" => "error", "message" => "Error creating new coop."]);
            }
        }

        // SQL สำหรับเพิ่มข้อมูลลงในตาราง Move
        $sql = "INSERT INTO Move (ChickenID, FarmID, CoopID, MoveF, MoveM, MoveCoopID, MoveDate, MoveTime)
                VALUES (:id, :farm, :coop, :chickenF, :chickenM, :movecoop, :currentDate, :currentTime)";
        $stmtInsert = $conn->prepare($sql);

        // ผูกค่าที่ได้จาก POST กับ statement
        $stmtInsert->bindParam(':id', $id, PDO::PARAM_STR);
        $stmtInsert->bindParam(':farm', $farm, PDO::PARAM_STR);
        $stmtInsert->bindParam(':coop', $coop, PDO::PARAM_STR);
        $stmtInsert->bindParam(':movecoop', $move, PDO::PARAM_STR);
        $stmtInsert->bindParam(':chickenF', $chickenF, PDO::PARAM_INT);
        $stmtInsert->bindParam(':chickenM', $chickenM, PDO::PARAM_INT);
        $stmtInsert->bindParam(':currentDate', $currentDate, PDO::PARAM_STR);
        $stmtInsert->bindParam(':currentTime', $currentTime, PDO::PARAM_STR);
        $stmtInsert->execute();

        // SQL สำหรับอัปเดตตาราง Chicken เพื่อลดจำนวนไก่ในฟาร์มต้นทาง
        $sqlUpdate1 = "UPDATE Chicken SET ChickenF = ChickenF - :chickenF ,ChickenM = ChickenM - :chickenM 
                       WHERE FarmID = :farm AND CoopID = :coop AND ChickenID = :id";
        $stmtUpdate1 = $conn->prepare($sqlUpdate1);
        $stmtUpdate1->bindParam(':id', $id, PDO::PARAM_STR);
        $stmtUpdate1->bindParam(':farm', $farm, PDO::PARAM_STR);
        $stmtUpdate1->bindParam(':coop', $coop, PDO::PARAM_STR);
        $stmtUpdate1->bindParam(':chickenF', $chickenF, PDO::PARAM_INT);
        $stmtUpdate1->bindParam(':chickenM', $chickenM, PDO::PARAM_INT);
        $stmtUpdate1->execute();

        // SQL สำหรับอัปเดตตาราง Chicken เพื่อเพิ่มจำนวนไก่ในฟาร์มปลายทาง
        $sqlUpdate2 = "UPDATE Chicken SET ChickenF = ChickenF + :chickenF ,ChickenM = ChickenM + :chickenM 
                       WHERE FarmID = :farm AND CoopID = :movecoop AND ChickenID = :id";
        $stmtUpdate2 = $conn->prepare($sqlUpdate2);
        $stmtUpdate2->bindParam(':id', $id, PDO::PARAM_STR);
        $stmtUpdate2->bindParam(':farm', $farm, PDO::PARAM_STR);
        $stmtUpdate2->bindParam(':movecoop', $move, PDO::PARAM_STR);
        $stmtUpdate2->bindParam(':chickenF', $chickenF, PDO::PARAM_INT);
        $stmtUpdate2->bindParam(':chickenM', $chickenM, PDO::PARAM_INT);

        // ดำเนินการอัปเดตข้อมูล
        if ($stmtUpdate2->execute()) {
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