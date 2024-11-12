<?php
    include 'connect.php';
    try {
        $conn = new PDO("sqlsrv:server=$serverName;Database=$database", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // ดึงข้อมูลจาก Chicken
        $sqlCK = 'SELECT SUM(ChickenF + ChickenM) as totalCK FROM Chicken WHERE FarmID = :farm';
        $stmtCK = $conn->prepare($sqlCK);
        $stmtCK->bindValue(':farm', 'f-002', PDO::PARAM_STR);
        $stmtCK->execute();
        $totalCK = $stmtCK->fetch(PDO::FETCH_ASSOC);

        // ดึงข้อมูลจาก Dead
        $sqlD = 'SELECT SUM(DeadF + DeadM) as totalD FROM Dead WHERE FarmID = :farm';
        $stmtD = $conn->prepare($sqlD);
        $stmtD->bindValue(':farm', 'f-002', PDO::PARAM_STR);
        $stmtD->execute();
        $totalD = $stmtD->fetch(PDO::FETCH_ASSOC);

        // ดึงข้อมูลจาก sort
        $sqlS = 'SELECT SUM(SortF + SortM) as totalS FROM Sort WHERE FarmID = :farm';
        $stmtS = $conn->prepare($sqlS);
        $stmtS->bindValue(':farm', 'f-002', PDO::PARAM_STR);
        $stmtS->execute();
        $totalS = $stmtS->fetch(PDO::FETCH_ASSOC);

        // รวมผลลัพธ์
        $result = [
            'totalCK' => $totalCK['totalCK'],
            'totalD' => $totalD['totalD'],
            'totalS' => $totalS['totalS'],
            'difference' => $totalCK['totalCK'] - $totalD['totalD'] - $totalS['totalS'],
            'perD' => ($totalD['totalD']/$totalCK['totalCK'])*100
        ];

        echo json_encode($result);

    } catch (PDOException $e) {
        echo json_encode(['status' => 'error', 'message' => 'Database error: ' . $e->getMessage()]);
    }

    $conn = null;
?>