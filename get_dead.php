<?php 
    include 'connect.php';
    try {
        $conn = new PDO("sqlsrv:server=$serverName;Database=$database", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
        $sql = 'SELECT Dead.DeadID, Dead.FarmID, Dead.CoopID, Dead.DeadTypeID, Breeds.breedName, Farm.FarmName, Coop.CoopName, Dead.DeadF, Dead.DeadM, DeadType.DeadTypeName, Dead.DeadDate, Dead.DeadTime
                FROM Dead
                INNER JOIN Chicken ON Dead.ChickenID=Chicken.ChickenID
				INNER JOIN importChicken ON Chicken.importID=importChicken.importID
                INNER JOIN Breeds ON importChicken.breedID=Breeds.breedID
                INNER JOIN Farm ON Dead.FarmID=Farm.FarmID
                INNER JOIN Coop ON Dead.CoopID=Coop.CoopID
                INNER JOIN DeadType ON Dead.DeadTypeID=DeadType.DeadTypeID';
        $stmt = $conn->query($sql);
        $Dead = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
        echo json_encode($Dead);

    } catch (PDOException $e) {
        echo 'ไม่สามารถเชื่อมต่อกับฐานข้อมูล: ' . $e->getMessage();
    }
    
    $conn = null;
?>