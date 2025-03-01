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
    
}



?>