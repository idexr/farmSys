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
    $dead_f = isset($_POST['dead_f']) ? $_POST['dead_f'] : '';
    $dead_m = isset($_POST['dead_m']) ? $_POST['dead_m'] : '';
    $sort_f = isset($_POST['sort_f']) ? $_POST['sort_f'] : '';
    $sort_m = isset($_POST['sort_m']) ? $_POST['sort_m'] : '';
    $sort = isset($_POST['sort']) ? $_POST['sort'] : '';
    $dead = isset($_POST['dead']) ? $_POST['dead'] : '';
    $inputDate = isset($_POST['inputDate']) ? $_POST['inputDate'] : '';
    $currentTime = date('Y-m-d H:i:s');
    $currentDate = date('Y-m-d', strtotime($inputDate));

    // ตรวจสอบข้อมูล
    if (!empty($farm) && !empty($coop)) {

        // ดึง ChickenID
        $stmt = $conn->prepare("SELECT * FROM Chicken WHERE FarmID = :farm AND CoopID = :coop");
        $stmt->bindParam(':farm', $farm);
        $stmt->bindParam(':coop', $coop);
        $stmt->execute();
        $ck = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($ck) {
            // เพิ่มข้อมูลในตาราง Dead
            $sql = "INSERT INTO Dead (ChickenID, FarmID, CoopID, DeadF, DeadM, DeadTypeID, DeadDate, DeadTime) 
                    VALUES (:chicken, :farm, :coop, :dead_f, :dead_m, :deadType, :currentDate, :currentTime)";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':chicken', $ck['ChickenID']);
            $stmt->bindParam(':farm', $farm);
            $stmt->bindParam(':coop', $coop);
            $stmt->bindParam(':dead_f', $dead_f, PDO::PARAM_INT);
            $stmt->bindParam(':dead_m', $dead_m, PDO::PARAM_INT);
            $stmt->bindParam(':deadType', $dead);
            $stmt->bindParam(':currentDate', $currentDate);
            $stmt->bindParam(':currentTime', $currentTime);

            if ($stmt->execute()) {
                // ตรวจสอบเงื่อนไขการเพิ่มข้อมูลใน Sort
                if ($sort != "") {
                    $sql = "INSERT INTO Sort (ChickenID, FarmID, CoopID, SortF, SortM, SortTypeID, SortDate, SortTime) 
                            VALUES (:chicken, :farm, :coop, :sort_f, :sort_m, :cause, :currentDate, :currentTime)";
                    $stmt = $conn->prepare($sql);
                    $stmt->bindParam(':chicken', $ck['ChickenID']);
                    $stmt->bindParam(':farm', $farm);
                    $stmt->bindParam(':coop', $coop);
                    $stmt->bindParam(':sort_f', $sort_f, PDO::PARAM_INT);
                    $stmt->bindParam(':sort_m', $sort_m, PDO::PARAM_INT);
                    $stmt->bindParam(':cause', $sort);
                    $stmt->bindParam(':currentDate', $currentDate);
                    $stmt->bindParam(':currentTime', $currentTime);

                    if ($stmt->execute()) {
                        echo json_encode(['status' => 'success', 'message' => 'Record added successfully']);
                    } else {
                        echo json_encode(["status" => "error", "message" => "Error adding Sort record"]);
                    }
                } else {
                    echo json_encode(['status' => 'success', 'message' => 'Record added successfully']);
                }
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
