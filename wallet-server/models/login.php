<?php
session_start();
include("../connection/connection.php");

header('Content-Type: application/json');

$response = [
    "success" => false,
    "message" => "Invalid credentials",
    "errors" => []
];

// it's displaying missing requirments///

// if (isset($_POST['login'])) {
//     $email = $_POST['email'];
//     $password = $_POST['password'];
//     $errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';
    $errors = [];


    
    if (empty($email) || empty($password)) {
        $errors[] = "Email and password are required.";
    }

    if (empty($errors)) {
        
        $sql = "SELECT * FROM users WHERE email=?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "s", $email);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $user = mysqli_fetch_array($result, MYSQLI_ASSOC);

        if ($user) {
            
            if (password_verify($password, $user["password"])) {
    
                $_SESSION["user"] = "yes";
                $_SESSION["user_id"] = $user["id"];
                $_SESSION["user_name"] = $user["full_name"];

                $response["success"] = true;
              
            } else {
                
                $response["message"] = "Incorrect password.";
                $errors[] = "Incorrect password.";
            }
        } else {
            
            $response["success"] = false;
            $response["message"] = "User not found.";
            $errors[] = "User not found.";
        }
    }

    if (!empty($errors)) {
        $response["success"] = false;
        $response["message"] = "Login failed";
        $response["errors"] = $errors;
    }
} else {
    $response["message"] = "Missing required fields";
    $response["post_data"] = $_POST;
}


echo json_encode($response);
exit();
