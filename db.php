<?php

    $servername = "127.0.0.1:3306";
    $username = "root"; 
    $password = "";
    $dbname = "fönster_övervakning";

    $con = mysqli_connect($servername,$username,$password,$dbname);
    if (!$con) {
        die('Could not connect: ' . mysqli_error($con));
    }
    mysqli_select_db($con,$dbname);
?>