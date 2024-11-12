<?php 
    include 'connect.php';
    try {
        $conn = new PDO("sqlsrv:server=$serverName;Database=$database", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        $sql = 'SELECT Sort.SortID, Sort.FarmID, Sort.CoopID, Sort.SortTypeID, Breeds.breedName, Farm.FarmName, Coop.CoopName, Sort.SortF, Sort.SortM, SortType.SortTypeName, Sort.SortDate, Sort.SortTime
                FROM Sort
                INNER JOIN Chicken ON sort.ChickenID=Chicken.ChickenID
				INNER JOIN importChicken ON Chicken.importID=importChicken.importID
                INNER JOIN Breeds ON importChicken.breedID=Breeds.breedID
                INNER JOIN Farm ON Sort.FarmID=Farm.FarmID
                INNER JOIN Coop ON Sort.CoopID=Coop.CoopID
                INNER JOIN SortType ON Sort.SortTypeID=SortType.SortTypeID';
        $stmt = $conn->query($sql);
        $Sort = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
        echo json_encode($Sort);

    } catch (PDOException $e) {
        echo 'ไม่สามารถเชื่อมต่อกับฐานข้อมูล: ' . $e->getMessage();
    }
    
    $conn = null;
?>