<?php
include("../../connection/connection.php");

header('Content-Type: application/json');

$response = [
    "success" => false,
    "message" => "Invalid credentials",
    "errors" => []
];

if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    $userId = isset($_POST['userId']) ? intval($_POST['userId']) : 0;

    if($userId>0){
        $sql = "SELECT balance FROM wallets WHERE user_id = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "i", $userId);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        $wallet = mysqli_fetch_assoc($result);

        if ($wallet) {
            $response["success"] = true;
            $response["balance"] = $wallet['balance'];
        } 
        else {
            $response["message"] = "No wallet found for this user";
        }
    }
        else{
            $response["message"] = "Invalid user ID";
        }
    }

    echo json_encode($response);
exit();