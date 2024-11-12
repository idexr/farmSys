<?php
include 'connect.php';

try {
    $conn = new PDO("sqlsrv:server=$serverName;Database=$database", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // ดึงข้อมูลจำนวนไก่ทั้งหมด
    $sqlTotal = 'SELECT SUM(ChickenF + ChickenM) as total FROM Chicken';
    $stmtTotal = $conn->query($sqlTotal);
    $totalCount = $stmtTotal->fetch(PDO::FETCH_ASSOC)['total'];

    // ดึงข้อมูลจาก Chicken สำหรับฟาร์มที่ระบุ
    $sqlCK = 'SELECT Farm.FarmID, Farm.FarmName, SUM(Chicken.ChickenF + Chicken.ChickenM) as totalCK 
               FROM Chicken 
               INNER JOIN Farm ON Chicken.FarmID = Farm.FarmID 
               WHERE Farm.FarmID IN (:farm1, :farm2, :farm3, :farm4) 
               GROUP BY Farm.FarmID, Farm.FarmName
               ORDER BY Farm.FarmID';

    $stmtCK = $conn->prepare($sqlCK);
    $stmtCK->bindValue(':farm1', 'f-001', PDO::PARAM_STR);
    $stmtCK->bindValue(':farm2', 'f-002', PDO::PARAM_STR);
    $stmtCK->bindValue(':farm3', 'f-003', PDO::PARAM_STR);
    $stmtCK->bindValue(':farm4', 'f-004', PDO::PARAM_STR);
    $stmtCK->execute();
    
    // เก็บผลลัพธ์ในอาร์เรย์
    $result = $stmtCK->fetchAll(PDO::FETCH_ASSOC);

    // คำนวณเปอร์เซ็นต์
    foreach ($result as &$item) {
        $item['percentage'] = $totalCount > 0 ? ($item['totalCK'] / $totalCount) * 100 : 0; // คำนวณเปอร์เซ็นต์
    }

    // ส่งผลลัพธ์กลับในรูปแบบ JSON
    echo json_encode($result);

} catch (PDOException $e) {
    echo json_encode(['status' => 'error', 'message' => 'Database error: ' . $e->getMessage()]);
}

$conn = null;
?>