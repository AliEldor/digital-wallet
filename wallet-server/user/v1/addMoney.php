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

    
}

echo json_encode($response);
exit();