<?php
    $conn = new mysqli("localhost","root","root","flipzonx");
    if($conn->connect_error)
    {
        die("connection failed: ".mysqli_connect_error);
    }
?>