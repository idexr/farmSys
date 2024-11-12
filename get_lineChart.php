<?php
include 'connect.php';

try {
    $conn = new PDO("sqlsrv:server=$serverName;Database=$database", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // ดึงข้อมูลการตายของไก่รายเดือน
    $sqlMortality = '
        SELECT 
            MONTH(DeadDate) AS month,
            SUM(DeadF + DeadM) AS mortality_count
        FROM 
            Dead
        WHERE 
            YEAR(DeadDate) = :year
        GROUP BY 
            MONTH(DeadDate)
        ORDER BY 
            MONTH(DeadDate)';

    $stmtMortality = $conn->prepare($sqlMortality);
    $stmtMortality->bindValue(':year', date('Y'), PDO::PARAM_INT);  // ดึงข้อมูลของปีปัจจุบัน
    $stmtMortality->execute();

    // แมปหมายเลขเดือนให้เป็นชื่อเดือนภาษาไทย
    $thaiMonths = [
        1 => 'มกราคม', 2 => 'กุมภาพันธ์', 3 => 'มีนาคม', 
        4 => 'เมษายน', 5 => 'พฤษภาคม', 6 => 'มิถุนายน', 
        7 => 'กรกฎาคม', 8 => 'สิงหาคม', 9 => 'กันยายน', 
        10 => 'ตุลาคม', 11 => 'พฤศจิกายน', 12 => 'ธันวาคม'
    ];

    // จัดผลลัพธ์ให้อยู่ในรูปแบบ JSON
    $monthlyData = [
        "labels" => [],
        "mortality" => []
    ];

    while ($row = $stmtMortality->fetch(PDO::FETCH_ASSOC)) {
        $monthlyData['labels'][] = $thaiMonths[$row['month']];  // ใช้ชื่อเดือนภาษาไทย
        $monthlyData['mortality'][] = $row['mortality_count'];
    }

    echo json_encode($monthlyData);

} catch (PDOException $e) {
    echo json_encode(['status' => 'error', 'message' => 'Database error: ' . $e->getMessage()]);
}

$conn = null;
?>
