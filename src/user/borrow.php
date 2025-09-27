<?php
include 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $borrower_name = $_POST['borrower_name'];
    $book_title = $_POST['book_title'];

    $sql = "INSERT INTO borrowed_books (borrower_name, book_title, borrowed_date)
            VALUES ('$borrower_name', '$book_title', NOW())";

    if ($mysqli->query($sql) === TRUE) {
        echo "✅ Book borrowed successfully!";
        echo "<br><a href='view_borrowed.php'>View Borrowed Books</a>";
    } else {
        echo "Error: " . $sql . "<br>" . $mysqli->error;
    }
}

$mysqli->close();
?>
