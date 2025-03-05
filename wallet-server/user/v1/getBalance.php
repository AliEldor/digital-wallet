<?php
include("../../connection/connection.php");

header('Content-Type: application/json');

$response = [
    "success" => false,
    "message" => "Invalid credentials",
    "errors" => []
];

if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    $userId = isset($_POST['userId']) ? intval($_POST['userId']) : 0;

    