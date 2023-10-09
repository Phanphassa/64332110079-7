<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "miniproject";

    $conn = mysqli_connect($servername, $username, $password, $dbname);
    
    if(!$conn){
        die("Connection success" . mysqli_connect_error());
    }
?>

