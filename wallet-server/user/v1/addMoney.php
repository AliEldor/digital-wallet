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
        

    }
}

echo json_encode($response);
exit();