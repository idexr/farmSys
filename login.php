<?php
session_start();
include 'connect.php';
//header('Content-Type: application/json');
try {
    $conn = new PDO("sqlsrv:server=$serverName;Database=$database", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $inputUsername = $_POST['username'];
    $inputPassword = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM Users WHERE UserName = :username");
    $stmt->execute(['username' => $inputUsername]);

    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if (count($user) > 0) {
        if ($inputPassword === $user['UserPassword']) { 
            $_SESSION['username'] = $user['UserName'];
            $_SESSION['level'] = $user['UserLevel'];
            echo json_encode(['status' => 'success', 'level' => $user['UserLevel']]);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Incorrect password']);
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'User not found']);
    }
} catch (PDOException $e) {
    echo json_encode(['status' => 'error', 'message' => 'Connection failed: ' . $e->getMessage()]);
}

$conn = null;
?>