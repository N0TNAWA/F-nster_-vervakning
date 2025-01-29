<?php
    header("Content-Type: text/event-stream");
    header("Cache-Control: no-cache");
    header("Connection: keep-alive");

    $servername = "127.0.0.1:3306";
    $username = "root"; 
    $password = "";
    $dbname = "fönster_övervakning";

    $con = mysqli_connect($servername,$username,$password,$dbname);
    if (!$con) {
        #echo "data: " . json_encode(array('wifi' => '0')) . "\n\n";
        die('Could not connect: ' . mysqli_error($con));
    }
    mysqli_select_db($con,$dbname);
    #echo "data: " . json_encode(array('wifi' => '1')) . "\n\n";
?>