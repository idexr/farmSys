<?php
    header('Content-Type: application/json'); 
    include 'connect.php';
    try {
        $conn = new PDO("sqlsrv:server=$serverName;Database=$database", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
        $id = isset($_POST['id']) ? $_POST['id'] : '';
        $name = isset($_POST['name']) ? $_POST['name'] : '';

        if (!empty($id) && !empty($name)) {    

            $sql = "UPDATE DeadType SET DeadTypeName = :name WHERE DeadTypeID = :id";
            $stmt = $conn->prepare($sql);

            // ผูกค่าเข้ากับ statement
            $stmt->bindParam(':id', $id, PDO::PARAM_STR);
            $stmt->bindParam(':name', $name, PDO::PARAM_STR);

            // อัปเดตข้อมูล
            if ($stmt->execute()) {
                echo json_encode(["status" => "success", "message" => "Record updated successfully"]);
            } else {
                echo json_encode(["status" => "error", "message" => "Error updating record"]);
            }
        
        } else {
            echo json_encode(["status" => "error", "message" => "Invalid ID"]);
        }

    } catch (PDOException $e) {
        echo json_encode(["status" => "error", "message" => "Connection failed: " . $e->getMessage()]);
    }
    
    
    $conn = null;
?>