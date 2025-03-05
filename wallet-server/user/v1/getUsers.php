<?php
include("../../connection/connection.php");

header('Content-Type: application/json');

$response = [
    "success" => false,
    "message" => "unable to fetch users",
    "errors" => []
];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['currentUserId'])) {
        $currentUserId = intval($_POST['currentUserId']);
    } else {
        $userId = 0;
    }

    if ($currentUserId > 0) {

        $sql = "SELECT id, full_name FROM users WHERE id != ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "i", $currentUserId);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        $users = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $users[] = [
                'id' => $row['id'],
                'name' => $row['full_name']
            ];
        }

        $response["success"] = true;
        $response["users"] = $users;
    } else {
        $response["message"] = "Invalid user ID";
    }
}

echo json_encode($response);
exit();
    
