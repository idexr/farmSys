<?php 
    include 'connect.php';
    try {
        $conn = new PDO("sqlsrv:server=$serverName;Database=$database", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
        $sql = 'SELECT Chicken.ChickenID
                    ,importChicken.importID
                    ,importChicken.breedID
                    ,Chicken.FarmID
                    ,Chicken.CoopID
                    ,Breeds.breedName
                    ,Farm.FarmName
                    ,Coop.CoopName
                    ,Chicken.ChickenF
                    ,Chicken.ChickenM
                    ,Chicken.ChickenStatus
                    ,Chicken.ChickenDate
                    ,Chicken.ChickenTime
                FROM Chicken
                INNER JOIN importChicken ON Chicken.importID = importChicken.importID
                INNER JOIN Breeds ON importChicken.breedID=Breeds.breedID
                INNER JOIN Farm ON Chicken.FarmID=Farm.FarmID
                INNER JOIN Coop ON Chicken.CoopID=Coop.CoopID
                ORDER BY Chicken.ChickenID DESC';
        $stmt = $conn->query($sql);
        $Chicken = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
        echo json_encode($Chicken);

    } catch (PDOException $e) {
        echo 'ไม่สามารถเชื่อมต่อกับฐานข้อมูล: ' . $e->getMessage();
    }
    
    $conn = null;
?>