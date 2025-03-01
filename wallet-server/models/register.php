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

    if (empty($fullName) || empty($email) || empty($password)) {
        $errors[] = "All fields are required.";
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email.";
    }
    if (strlen($password) < 5) {
        $errors[] = "Password must be at least 5 characters.";
    }

    $sql = "SELECT * FROM users WHERE email =?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) > 0) {
        $errors[] = "Email already exists";
    }
    if (!empty($errors)) {
        $response["success"] = false;
        $response["message"] = "Registration failed";
        $response["errors"] = $errors;
    } else {
        $stmt = mysqli_prepare($conn, "INSERT INTO users (full_name, email, password) VALUES (?, ?, ?)");
        mysqli_stmt_bind_param($stmt, "sss", $fullName, $email, $passwordHash);
        mysqli_stmt_execute($stmt);

        if ($stmt) {
            $response["success"] = true;
            $response["message"] = "Registration successful";
        } else {
            $response["success"] = false;
            $response["message"] = "Something went wrong: " . mysqli_error($conn);
        }
    }
} else {
    $response["message"] = "Missing required fields";
}

echo json_encode($response);
