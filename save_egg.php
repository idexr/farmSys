<?php
    date_default_timezone_set('Asia/Bangkok');

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $farm = isset($_POST['farm']) ? $_POST['farm'] : '';
        $coop = isset($_POST['coop']) ? $_POST['coop'] : '';
        $ErLarge = isset($_POST['ErLarge']) ? $_POST['ErLarge'] : '';
        $ErSmall = isset($_POST['ErSmall']) ? $_POST['ErSmall'] : '';
        $ErDeformed = isset($_POST['ErDeformed']) ? $_POST['ErDeformed'] : '';
        $ErDirty = isset($_POST['ErDirty']) ? $_POST['ErDirty'] : '';
        $ErCrack = isset($_POST['ErCrack']) ? $_POST['ErCrack'] : '';
        $ErWrack = isset($_POST['ErWrack']) ? $_POST['ErWrack'] : '';
        $inputDate = isset($_POST['inputDate']) ? $_POST['inputDate'] : '';
        $currentTime = date('H:i:s');
        $currentDate = date('Y-m-d', strtotime($inputDate));

        // ตรวจสอบว่ามีการกรอกข้อมูลครบถ้วน
        if (!empty($farm) && !empty($coop)) {

            include 'connect.php';
            $conn = new PDO("sqlsrv:server=$serverName;Database=$database", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $stmt = $conn->prepare("SELECT ChickenID FROM Chicken WHERE FarmID = :farm AND CoopID = :coop");
            $stmt->bindParam(':farm', $farm);
            $stmt->bindParam(':coop', $coop);
            $stmt->execute();
            $ck = $stmt->fetch(PDO::FETCH_ASSOC);

            $stmt = $conn->prepare("SELECT TOP(1) ErID FROM EggRecord ORDER BY ErID DESC");
            $stmt->execute();
            $ID = $stmt->fetch(PDO::FETCH_ASSOC);
        
            if (!empty($ID)) {
                $c = substr($ID['CauseTypeID'],3);
                $lastID = intval($c);
                $newID = $lastID + 1;
                $ErID = "ct-".strval($newID);
            }else{
                $newID = 1;
                $ErID = "ct-".strval($newID);
            }



            $sql = "INSERT INTO ChickenSort (ErID, FarmID, CoopID, ErDate, ErTime, ErLarge, ErSmall, ErDeformed, ErDirty, ErCrack, ErWrack, ChickenID) 
            VALUES (:id, :farm, :coop, :currentDate, :currentTime, :ErLarge, :ErSmall, :ErDeformed, :ErDirty, :ErCrack, :ErWrack, :chicken )";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':id', $ErID);
            $stmt->bindParam(':farm', $farm);
            $stmt->bindParam(':coop', $coop);
            $stmt->bindParam(':currentDate', $currentDate);
            $stmt->bindParam(':currentTime', $currentTime);
            $stmt->bindParam(':ErLarge', $ErLarge, PDO::PARAM_INT);
            $stmt->bindParam(':ErSmall', $ErSmall, PDO::PARAM_INT);
            $stmt->bindParam(':ErDeformed', $ErDeformed, PDO::PARAM_INT);
            $stmt->bindParam(':ErDirty', $ErDirty, PDO::PARAM_INT);
            $stmt->bindParam(':ErCrack', $ErCrack, PDO::PARAM_INT);
            $stmt->bindParam(':ErWrack', $ErWrack, PDO::PARAM_INT);
            $stmt->bindParam(':chicken', $ck['ChickenID']);
            $stmt->execute();
       
            $conn = null;

            echo "บันทึกข้อมูลสำเร็จ";
        } else {
            echo "กรุณากรอกข้อมูลให้ครบถ้วน!";
        }
    } else {
        echo "วิธีการเข้าถึงไม่ถูกต้อง!";
    }
?>