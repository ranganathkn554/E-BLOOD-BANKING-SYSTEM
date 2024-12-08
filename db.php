<?php
   
    $host = "localhost";
    $username = "root"; 
    $password = ""; 
    $dbname = "ebloodbank";

    
    $conn = new mysqli($host, $username, $password, $dbname);
    if ($conn) {
        echo "Database connection successful!";
    }
    

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    // http://localhost:8080/pv5/index.html
    // http://localhost:8080/phpmyadmin/index.php?route=/table/sql&db=ebloodbank&table=users
