<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library MS</title>
    <link rel="stylesheet" type="text/css" href="../css/style.css">
</head>
<body>
    <header>
        <h1>Library Management System</h1>
    </header>
    <br>

<?php
$mysqli = new mysqli("db", "root", "rootpassword", "library-db");

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}
/* Carandang */
?>   
=======
    <?php
    $mysqli = new mysqli("db", "root", "rootpassword", "library-db");

    if ($mysqli->connect_error) {
        die("Connection failed: " . $mysqli->connect_error);
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $book_id = $_POST['id'];
        $edit_Name = $_POST['name'];
        $edit_Author = $_POST['author'];
        $edit_Description = $_POST['description'];

        $sql = "UPDATE `books-table` 
                SET book_name = '$edit_Name', book_author = '$edit_Author', book_description = '$edit_Description' 
                WHERE id = $book_id";

        $stmt = $mysqli->prepare($sql);
        if (!$stmt) {
            die("Prepare failed: " . $mysqli->error);
        }

        /*$stmt->bind_param("sssi", $edit_Name, $edit_Author, $edit_Description, $book_id);*/

        if ($stmt->execute()) {
            echo "<p style='color:green;'>✅ Book updated successfully!</p>";
        } else {
            echo "<p style='color:red;'>❌ Error: " . $stmt->error . "</p>";
        }

        $stmt->close();
    }

    $sql = "SELECT id, book_name, book_author, book_description, borrow_status, borrower FROM `books-table`";
    $result = $mysqli->query($sql);

    if ($result && $result->num_rows > 0) {
        echo "<h2>Books Table</h2>";
        echo "<table border='1' cellpadding='8' cellspacing='0'>";
        echo "<tr><th>ID</th><th>Book Name</th><th>Author</th><th>Description</th><th>Borrow Status</th><th>Borrower</th></tr>";
        while($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["id"]. "</td>";
            echo "<td>" . $row["book_name"]. "</td>";
            echo "<td>" . $row["book_author"]. "</td>";
            echo "<td>" . $row["book_description"]. "</td>";
            echo "<td>" . $row["borrow_status"]. "</td>";
            echo "<td>" . $row["borrower"]. "</td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "<p>No books found.</p>";
    }

    $mysqli->close();
    ?>

    <li><a href="../admin/admin.html" id="adminBtn">Go Back</a></li>
    <footer>
        <p>Simple Library Management System</p>
        <p>CCS112 - Applications Development and Emerging Technologies</p>
        <div id="contacts">
            <p>Contact us:
                <a href="https://github.com/CSselrahC" target="_blank">CSselrahC</a>
            </p>
        </div>
    </footer>
</body>
</html>
>>>>>>> ca9b877a3aae0dbed1fb9c18167cbd9db3d463bf
