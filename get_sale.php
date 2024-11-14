<?php 
    include 'connect.php';
    try {
        $conn = new PDO("sqlsrv:server=$serverName;Database=$database", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
        $sql = "SELECT s.SaleID
                    ,b.breedName
                    ,f.FarmID
                    ,f.FarmName
                    ,co.CoopID
                    ,co.CoopName
                    ,s.SaleF
                    ,s.SaleM
                    ,st.SaleTypeName
                    ,s.SalePrice
                    ,s.SaleDate
                FROM Sale AS s
                LEFT JOIN Chicken AS c ON s.ChickenID=c.ChickenID
                LEFT JOIN importChicken AS imp ON c.importID=imp.importID
                LEFT JOIN Breeds AS b ON imp.breedID=b.breedID
                LEFT JOIN Farm AS f ON s.FarmID=f.FarmID
                LEFT JOIN Coop AS co ON s.CoopID=co.CoopID
                LEFT JOIN SaleType AS st ON s.SaleTypeID=st.SaleTypeID";
        $stmt = $conn->query($sql);
        $Sale = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
        echo json_encode($Sale);

    } catch (PDOException $e) {
        echo 'ไม่สามารถเชื่อมต่อกับฐานข้อมูล: ' . $e->getMessage();
    }
    
    $conn = null;
?>