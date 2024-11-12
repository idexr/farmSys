<?php 
    include 'connect.php';
    try {
        $conn = new PDO("sqlsrv:server=$serverName;Database=$database", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
        $stmt = $conn->query('SELECT * FROM Farm');
        $farm = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
        echo json_encode($farm);

    } catch (PDOException $e) {
        echo 'ไม่สามารถเชื่อมต่อกับฐานข้อมูล: ' . $e->getMessage();
    }
    
    $conn = null;
?>