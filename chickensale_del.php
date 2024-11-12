<?php
    header('Content-Type: application/json'); 
    include 'connect.php';
    try {
        $conn = new PDO("sqlsrv:server=$serverName;Database=$database", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
        $id = isset($_POST['id']) ? $_POST['id'] : '';

        if (!empty($id)) {    
            // สร้างคำสั่ง SQL เพื่อลบข้อมูลที่มี ID ตรงกับที่ส่งมา
            $sql = "DELETE FROM Sort WHERE SortID = :id";
            $stmt = $conn->prepare($sql);

            // ผูกค่า ID เข้ากับ statement
            $stmt->bindParam(':id', $id, PDO::PARAM_STR);

            // ลบข้อมูล
            if ($stmt->execute()) {
                echo json_encode(["status" => "success", "message" => "Record deleted successfully"]);
            } else {
                echo json_encode(["status" => "error", "message" => "Error deleting record"]);
            }

        } else {
            echo json_encode(["status" => "error", "message" => "Invalid ID"]);
        }

    } catch (PDOException $e) {
        echo json_encode(["status" => "error", "message" => "Connection failed: " . $e->getMessage()]);
    }
    
    
    $conn = null;
?>