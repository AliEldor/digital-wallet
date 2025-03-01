<?php
$hostName="localhost";
$dbUser="root";
$dbPassword="";
$dbName = "digitalwallet";
$conn=mysqli_connect($hostName,$dbUser,$dbPassword,$dbName);
if(!$conn){
    die("something went wrong");
}


?>