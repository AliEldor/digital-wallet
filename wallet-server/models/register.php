<?php

include("../connection/connection.php");
header('Content-Type: application/json');

$response = [
    "success" => false,
    "message" => "",
    "errors" => []
];

if (isset($_POST['name']) && isset($_POST['email']) && isset($_POST['password'])) {
    $fullName = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $passwordHash = password_hash($password, PASSWORD_DEFAULT);
    $errors = [];

    
