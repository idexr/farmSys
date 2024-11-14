<?php
date_default_timezone_set('Asia/Bangkok');
header('Content-Type: application/json');
include 'connect.php';

try {
    $conn = new PDO("sqlsrv:server=$serverName;Database=$database", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // รับค่าจาก POST
    $farm = isset($_POST['farm']) ? $_POST['farm'] : '';
    $coop = isset($_POST['coop']) ? $_POST['coop'] : '';
    $sale_f = isset($_POST['sale_f']) ? $_POST['sale_f'] : '';
    $sale_m = isset($_POST['sale_m']) ? $_POST['sale_m'] : '';
    $type = isset($_POST['type']) ? $_POST['type'] : '';
    $price = isset($_POST['price']) ? $_POST['price'] : '';
    $inputDate = isset($_POST['inputDate']) ? $_POST['inputDate'] : '';
    $currentTime = date('Y-m-d H:i:s');
    $currentDate = date('Y-m-d', strtotime($inputDate));

    // ตรวจสอบข้อมูล
    if (!empty($farm) && !empty($coop) && !empty($inputDate)) {

        // ดึง ChickenID
        $stmt = $conn->prepare("SELECT * FROM Chicken WHERE FarmID = :farm AND CoopID = :coop");
        $stmt->bindParam(':farm', $farm);
        $stmt->bindParam(':coop', $coop);
        $stmt->execute();
        $ck = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($ck) {
            // เพิ่มข้อมูลในตาราง Dead
            $sql = "INSERT INTO Sale (ChickenID, FarmID, CoopID, SaleF, SaleM, SaleTypeID, SalePrice, SaleDate, SaleTime) 
                    VALUES (:chicken, :farm, :coop, :sale_f, :sale_m, :saleType, :salePrice, :currentDate, :currentTime)";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':chicken', $ck['ChickenID']);
            $stmt->bindParam(':farm', $farm);
            $stmt->bindParam(':coop', $coop);
            $stmt->bindParam(':sale_f', $sale_f, PDO::PARAM_INT);
            $stmt->bindParam(':sale_m', $sale_m, PDO::PARAM_INT);
            $stmt->bindParam(':saleType', $type);
            $stmt->bindParam(':salePrice', $price);
            $stmt->bindParam(':currentDate', $currentDate);
            $stmt->bindParam(':currentTime', $currentTime);

            if ($stmt->execute()) {
                echo json_encode(['status' => 'success', 'message' => 'Record added successfully']);   
            } else {
                echo json_encode(["status" => "error", "message" => "Error adding Dead record"]);
            }
        } else {
            echo json_encode(["status" => "error", "message" => "No ChickenID found"]);
        }
    } else {
        echo json_encode(["status" => "error", "message" => "Invalid ID"]);
    }

} catch (PDOException $e) {
    echo json_encode(['status' => 'error', 'message' => 'Error adding record: ' . $e->getMessage()]);
}

$conn = null;
?>
