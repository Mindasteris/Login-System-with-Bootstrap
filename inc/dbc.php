<?php
    //Connect to Database (demo_login)
    define("DBHOST", "localhost");
    define("DBUSER", "root");
    define("DBPASS", "");
    define("DBNAME", "demo_login");

    $conn = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);

    if(!$conn) {
        die("Connection Failed: " . $conn->connect_error());
    }
    
?>