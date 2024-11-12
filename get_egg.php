<?php 
    include 'connect.php';
    try {
        $conn = new PDO("sqlsrv:server=$serverName;Database=$database", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
        $sql = "SELECT er.ErID
                        ,f.FarmName
                        ,co.CoopName
                        ,er.ErLarge
                        ,er.ErSmall
                        ,er.ErDeformed
                        ,er.ErDirty
                        ,er.ErCrack
                        ,er.ErWrack
                        ,er.ErDate
                FROM EggRecord AS er
                LEFT JOIN Farm AS f ON er.FarmID=f.FarmID
                LEFT JOIN Coop AS co ON er.CoopID=co.CoopID";
        $stmt = $conn->query($sql);
        $er = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
        echo json_encode($er);

    } catch (PDOException $e) {
        echo 'ไม่สามารถเชื่อมต่อกับฐานข้อมูล: ' . $e->getMessage();
    }
    
    $conn = null;
?>