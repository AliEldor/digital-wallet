<?php
include("../connection/connection.php");

header('Content-Type: application/json');

$query = "SELECT COUNT(id) AS total_users FROM users";
$result = mysqli_query($conn, $query);

if ($row = mysqli_fetch_assoc($result)) {
    echo json_encode(["total_users" => $row['total_users']]);
} else {
    echo json_encode(["total_users" => 0]);
}
?>
