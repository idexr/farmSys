<?php
    header('Content-Type: application/json'); 
    include 'connect.php';
    try {
        $conn = new PDO("sqlsrv:server=$serverName;Database=$database", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
        $name = isset($_POST['name']) ? $_POST['name'] : '';

        if (!empty($name)) {    
            $stmt = $conn->prepare("SELECT TOP(1) FarmID FROM Farm ORDER BY FarmID DESC");
            $stmt->execute();
            $ID = $stmt->fetch(PDO::FETCH_ASSOC);
        
            if (!empty($ID)) {
                $c = substr($ID['FarmID'],3);
                $lastID = intval($c);
                $newID = str_pad($lastID + 1, 3, '0', STR_PAD_LEFT);
                $FarmID = "b-".strval($newID);
            }else{
                $newID = str_pad($lastID + 1, 3, '0', STR_PAD_LEFT);
                $FarmID = "b-".strval($newID);
            }

            $sql = "INSERT INTO Farm (FarmID, FarmName) 
            VALUES (:id, :name)";
            $stmt = $conn->prepare($sql);

            // ผูกค่าเข้ากับ statement
            $stmt->bindParam(':id', $FarmID, PDO::PARAM_STR);
            $stmt->bindParam(':name', $name, PDO::PARAM_STR);

            // เพิ่มข้อมูล
            if ($stmt->execute()) {
                echo json_encode(['status' => 'success', 'message' => 'Record added successfully']);
            } else {
                echo json_encode(["status" => "error", "message" => "Error adding record"]);
            }
            
        } else {
            echo json_encode(["status" => "error", "message" => "Invalid ID"]);
        } 
        
    } catch (PDOException $e) {
        // ส่งการตอบกลับเมื่อมีข้อผิดพลาด
        echo json_encode(['status' => 'error', 'message' => 'Error adding record: ' . $e->getMessage()]);
    }
    
    
    $conn = null;
?>