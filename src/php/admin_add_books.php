<?php
    $name = $_POST['name'];
    $author = $_POST['author'];
    $description = $_POST['description'];

    // Database connection
    $conn = new mysqli('localhost', 'root', 'rootpassword', 'library');
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } else {
        $stmt = $conn->prepare("INSERT INTO books-db (book_name, book_author, book_description) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $name, $author, $description);
        $stmt->execute();
        echo "New book added successfully";
        $stmt->close();
        $conn->close();
    }
?>