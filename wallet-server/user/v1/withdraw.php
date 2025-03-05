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

    mysqli_begin_transaction($conn);

    try {
        // Get current balance
        $sql = "SELECT balance FROM wallets WHERE user_id = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "i", $userId);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $wallet = mysqli_fetch_assoc($result);

        if (!$wallet) {
            throw new Exception("No wallet found for this user");
        }

        $currentBalance = floatval($wallet['balance']);

        if ($currentBalance < $amount) {
            throw new Exception("Insufficient funds");
        }

        // Update  balance
        $newBalance = $currentBalance - $amount;
        $sql = "UPDATE wallets SET balance = ? WHERE user_id = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "di", $newBalance, $userId);
        $updateResult = mysqli_stmt_execute($stmt);

        if (!$updateResult) {
            throw new Exception("Failed to update wallet balance");
        }

        // Record the transaction
        $sql = "INSERT INTO transactions (sender_id, recipient_id, amount, transaction_type) VALUES (?, ?, ?, 'withdrawal')";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "iid", $userId, $userId, $amount);
        $insertResult = mysqli_stmt_execute($stmt);

        if (!$insertResult) {
            throw new Exception("Failed to record transaction");
        }

        mysqli_commit($conn);

        $response["success"] = true;
        $response["message"] = "Withdrawal successful";
        $response["new_balance"] = $newBalance;

    }

    catch (Exception $e) {
        // Rollback transaction on error
        mysqli_rollback($conn);
        $response["message"] = $e->getMessage();
    }
}

echo json_encode($response);
exit();

