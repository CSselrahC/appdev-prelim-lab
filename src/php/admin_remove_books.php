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

    $book_id = $_POST['book_id'];
    $sql = "DELETE FROM `books-table` WHERE id = '$book_id'";

    if ($mysqli->query($sql) === TRUE) {
        echo "Book removed successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $mysqli->error;
    }

    $sql = "SELECT id, book_name, book_author, book_description, borrow_status, borrower FROM `books-table`";
    $result = $mysqli->query($sql);

    if ($result->num_rows > 0) {
        echo "<table>";
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
        echo "0 results";
    }
    $mysqli->close();
    ?>

    <li><a href="../admin/add_books.html" id="adminBtn">Go Back</a></li>
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