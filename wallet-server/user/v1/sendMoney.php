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

    if (empty($errors)) {
        // Start a transaction
        mysqli_begin_transaction($conn);

        try {
            
            $recipient_sql = "SELECT id FROM users WHERE id = ?";
            $recipient_stmt = mysqli_prepare($conn, $recipient_sql);
            mysqli_stmt_bind_param($recipient_stmt, "i", $recipientId);
            mysqli_stmt_execute($recipient_stmt);
            $recipient_result = mysqli_stmt_get_result($recipient_stmt);
            $recipient = mysqli_fetch_assoc($recipient_result);

        }

        if (!$recipient) {
            throw new Exception("Recipient not found");
        }

        $balance_sql = "SELECT balance FROM wallets WHERE user_id = ?";
            $balance_stmt = mysqli_prepare($conn, $balance_sql);
            mysqli_stmt_bind_param($balance_stmt, "i", $senderId);
            mysqli_stmt_execute($balance_stmt);
            $balance_result = mysqli_stmt_get_result($balance_stmt);
            $balance_row = mysqli_fetch_assoc($balance_result);

            if ($balance_row['balance'] < $amount) {
                throw new Exception("Insufficient balance");
            }


    }