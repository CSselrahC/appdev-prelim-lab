<?php
    $servername = "localhost"; // Your database host
    $username = "root"; // Your database username
    $password = "rootpassword"; // Your database password
    $dbname = "library-db"; // Your database name

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    echo "Connected successfully";

    // You can now execute SQL queries using $conn->query() or prepared statements
    // ...

    // Close connection (optional, as PHP closes it automatically at script end)
    $conn->close();
?>