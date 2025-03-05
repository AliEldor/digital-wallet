<?php
include("../../connection/connection.php");

header('Content-Type: application/json');

$response = [
    "success" => false,
    "message" => "Invalid request",
    "errors" => []
];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userId = isset($_POST['userId']) ? intval($_POST['userId']) : 0;
    $amount = isset($_POST['amount']) ? floatval($_POST['amount']) : 0;

    if ($userId <= 0) {
        $response["message"] = "Invalid user ID";
        echo json_encode($response);
        exit();
    }


}