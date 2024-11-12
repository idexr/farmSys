<?php
include 'connect.php';

try {
    $conn = new PDO("sqlsrv:server=$serverName;Database=$database", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // ดึงข้อมูลจำนวนไก่ทั้งหมด
    $sqlTotal = 'SELECT SUM(ChickenF + ChickenM) as totalChickens FROM Chicken';
    $stmtTotal = $conn->prepare($sqlTotal);
    $stmtTotal->execute();
    $totalChickens = $stmtTotal->fetch(PDO::FETCH_ASSOC);

    // ดึงข้อมูลจำนวนไก่ที่สูญเสียทั้งหมด
    $sqlLost = 'SELECT SUM(DeadF + DeadM) as totalLost FROM Dead';
    $stmtLost = $conn->prepare($sqlLost);
    $stmtLost->execute();
    $totalLost = $stmtLost->fetch(PDO::FETCH_ASSOC);

    // ดึงข้อมูลจำนวนไก่สำหรับฟาร์มที่ระบุ
    $sqlCK = 'SELECT FarmID, SUM(ChickenF + ChickenM) as totalCK 
               FROM Chicken 
               WHERE FarmID IN (:farm1, :farm2, :farm3, :farm4) 
               GROUP BY FarmID';

    $stmtCK = $conn->prepare($sqlCK);
    $stmtCK->bindValue(':farm1', 'f001', PDO::PARAM_STR);
    $stmtCK->bindValue(':farm2', 'f002', PDO::PARAM_STR);
    $stmtCK->bindValue(':farm3', 'f003', PDO::PARAM_STR);
    $stmtCK->bindValue(':farm4', 'f004', PDO::PARAM_STR);
    $stmtCK->execute();
    
    // เก็บผลลัพธ์ในอาร์เรย์
    $farmData = $stmtCK->fetchAll(PDO::FETCH_ASSOC);
    
    // ส่งผลลัพธ์กลับในรูปแบบ JSON
    echo json_encode([
        'totalChickens' => $totalChickens['totalChickens'],
        'totalLost' => $totalLost['totalLost'],
        'farmData' => $farmData
    ]);

} catch (PDOException $e) {
    echo json_encode(['status' => 'error', 'message' => 'Database error: ' . $e->getMessage()]);
}

$conn = null;
?>