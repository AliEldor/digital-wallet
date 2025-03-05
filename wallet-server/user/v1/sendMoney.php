<?php
include("../../connection/connection.php");

header('Content-Type: application/json');

$response = [
    "success" => false,
    "message" => "Unable to process the request",
    "errors" => []
];

$senderId = isset($_POST['senderId']) ? intval($_POST['senderId']) : 0;
    $recipientId = isset($_POST['recipientId']) ? intval($_POST['recipientId']) : 0;
    $amount = isset($_POST['amount']) ? floatval($_POST['amount']) : 0;

    $errors = [];
    if ($senderId <= 0) {
        $errors[] = "Invalid sender ID";
    }
    if ($recipientId <= 0) {
        $errors[] = "Invalid recipient ID";
    }
    if ($amount <= 0) {
        $errors[] = "Invalid amount";
    }