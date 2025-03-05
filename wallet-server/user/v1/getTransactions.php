<?php
include("../../connection/connection.php");

header('Content-Type: application/json');

$response = [
    "success" => false,
    "message" => "Unable to fetch transactions",
    "transactions" => []
];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['userId'])) {
        $userId = intval($_POST['userId']);

        $sql = "SELECT 
                    transaction_type, 
                    amount, 
                    created_at
                FROM 
                    transactions
                WHERE 
                    sender_id = ? OR recipient_id = ?
                ORDER BY 
                    created_at DESC
                LIMIT 10";

    }
}