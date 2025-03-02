<?php

include("../connection/connection.php");
header('Content-Type: application/json');

$response=[
    "success"=> false,
    "message"=> "Invalid credentials"
];

if(isset($_POST['login'])){
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT email,password FROM users WHERE email=?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "ss", $email,$password);
    mysqli_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $user = mysqli_fetch_array($result, MYSQLI_ASSOC);
    
}



?>