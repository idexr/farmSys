<?php 
    include 'connect.php';
    try {
        $conn = new PDO("sqlsrv:server=$serverName;Database=$database", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
        $stmt = $conn->query('SELECT * FROM SortType');
        $SortType = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
        echo json_encode($SortType);

    } catch (PDOException $e) {
        echo 'ไม่สามารถเชื่อมต่อกับฐานข้อมูล: ' . $e->getMessage();
    }
    
    $conn = null;
?>