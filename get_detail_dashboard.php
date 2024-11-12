<?php
    include 'connect.php';
    try {
        $conn = new PDO("sqlsrv:server=$serverName;Database=$database", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $farmID = isset($_POST['farmId']) ? $_POST['farmId'] : null;
        
        $sql = "SELECT Chicken.FarmID, 
                    Coop.CoopName, 
                    SUM(Chicken.ChickenF) AS ChickenF, 
                    SUM(Chicken.ChickenM) AS ChickenM, 
                    SUM(COALESCE(Dead.DeadF, 0)) AS DeadF, 
                    SUM(COALESCE(Dead.DeadM, 0)) AS DeadM, 
                    SUM(COALESCE(Sort.SortF, 0)) AS SortF, 
                    SUM(COALESCE(Sort.SortM, 0)) AS SortM 
                FROM Chicken 
                LEFT JOIN Coop ON Chicken.CoopID = Coop.CoopID 
                LEFT JOIN Dead ON Chicken.FarmID = Dead.FarmID AND Chicken.CoopID = Dead.CoopID 
                LEFT JOIN Sort ON Chicken.FarmID = Sort.FarmID AND Chicken.CoopID = Sort.CoopID
                WHERE Chicken.FarmID = :farm
                GROUP BY Chicken.FarmID, Coop.CoopName";

        $stmt = $conn->prepare($sql);
        //$stmt->bindValue(':farm', 'f003', PDO::PARAM_STR);//ทดสอบแสดงข้อมูล
        $stmt->bindValue(':farm', $farmID, PDO::PARAM_STR);
        $stmt->execute();

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        echo json_encode($result);

    } catch (PDOException $e) {
        echo json_encode(['status' => 'error', 'message' => 'Database error: ' . $e->getMessage()]);
    }

    $conn = null;
?>
