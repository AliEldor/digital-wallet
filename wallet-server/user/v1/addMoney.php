<?php
include("../../connection/connection.php");

header('Content-Type: application/json');

$response = [
    "success" => false,
    "message" => "unable to process the request",
    "errors" => []
];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['userId'])) {
        $userId = intval($_POST['userId']);
    } else {
        $userId = 0;
    }

    if (isset($_POST['amount'])) {
        $amount = floatval($_POST['amount']);
    } else {
        $amount = 0;
    }

    if ($userId > 0 && $amount > 0) {

    $sql = "UPDATE wallets SET balance = balance + ? WHERE user_id = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "di", $amount, $userId);
        

        if (mysqli_stmt_execute($stmt)) {

            // if there is time left could call it from getBalance
            
            $balance_sql = "SELECT balance FROM wallets WHERE user_id = ?";
            $balance_stmt = mysqli_prepare($conn, $balance_sql);
            mysqli_stmt_bind_param($balance_stmt, "i", $userId);
            mysqli_stmt_execute($balance_stmt);
            $balance_result = mysqli_stmt_get_result($balance_stmt);
            $balance_row = mysqli_fetch_assoc($balance_result);

            $response["success"] = true;
            $response["message"] = "Money added successfully";
            $response["new_balance"] = $balance_row['balance'];
        } else {
            $response["message"] = "Failed to add money";
        }
    } else {
        $response["message"] = "Invalid user ID or amount";
    }
}

echo json_encode($response);
exit();