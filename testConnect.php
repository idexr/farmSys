<?php
// กำหนดข้อมูลการเชื่อมต่อ
$serverName = "192.168.101.201\SQLEXPRESS,1433"; // หรือใช้ชื่อเครื่องเช่น (local)\SQLEXPRESS
$database = "NCPFarm";
$username = "sa";
$password = "888_qazwsx";

try {
    // สร้างการเชื่อมต่อด้วย PDO
    $conn = new PDO("sqlsrv:Server=$serverName;Database=$database", $username, $password);

    // กำหนดโหมด error เพื่อแสดงข้อผิดพลาดแบบ exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    echo "เชื่อมต่อฐานข้อมูลสำเร็จ!";
}
catch (PDOException $e) {
    // แสดงข้อผิดพลาดหากการเชื่อมต่อล้มเหลว
    echo "การเชื่อมต่อล้มเหลว: " . $e->getMessage();
}
?>

