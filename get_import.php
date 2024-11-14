<?php
    include 'connect.php'; // เชื่อมต่อกับฐานข้อมูล

    try {
        // สร้างการเชื่อมต่อกับฐานข้อมูล
        $conn = new PDO("sqlsrv:server=$serverName;Database=$database", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // สร้างคำสั่ง SQL เพื่อดึงข้อมูล
        $sql = 'SELECT imp.importID
                    ,b.breedID
                    ,b.breedName
                    ,imp.importQTY
                    ,imp.importPrice
                    ,imp.importDate
                    ,imp.importTime
                FROM importChicken AS imp
                LEFT JOIN Breeds AS b ON imp.breedID = b.breedID';
        
        $stmt = $conn->query($sql);
        $Chicken = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        echo json_encode($Chicken);

    } catch (PDOException $e) {
        echo 'ไม่สามารถเชื่อมต่อกับฐานข้อมูล: ' . $e->getMessage();
    }

    // ปิดการเชื่อมต่อ
    $conn = null;
?>
