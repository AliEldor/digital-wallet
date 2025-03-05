<?php
include("../../connection/connection.php");

header('Content-Type: application/json');

$response = [
    "success" => false,
    "message" => "Unable to fetch transactions",
    "transactions" => []
];

