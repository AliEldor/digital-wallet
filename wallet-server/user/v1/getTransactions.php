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

$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "ii", $userId, $userId);

if (mysqli_stmt_execute($stmt)) {
    $result = mysqli_stmt_get_result($stmt);
    
    while ($row = mysqli_fetch_assoc($result)) {
        $response['transactions'][] = $row;
    }

    $response['success'] = true;
    $response['message'] = "Transactions fetched successfully";
}
else {
    $response['message'] = "Error executing query";
}

    }
    else{
        $response['message'] = "User ID not provided";
    }
}

echo json_encode($response);
exit();