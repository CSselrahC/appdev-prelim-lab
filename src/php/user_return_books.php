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
        // Connect to the database
        $conn = new mysqli("db", "root", "rootpassword", "library-db");

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Get POST data
        $returner_name = $_POST['returner_name'];
        $book_id = $_POST['book_id'];

        // Query to find the book
        $sql = "SELECT borrower FROM `books-table` WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $book_id);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $stmt->bind_result($borrower);
            $stmt->fetch();

            if ($borrower === $returner_name) {
                // Update the book as returned (set borrower to NULL or similar)
                $update_sql = "UPDATE `books-table` SET borrower = NULL, borrow_status = 'Available' WHERE id = ?";
                $update_stmt = $conn->prepare($update_sql);
                $update_stmt->bind_param("s", $book_id);
                if ($update_stmt->execute()) {
                    echo "Book returned successfully!";
                } else {
                    echo "Error updating record.";
                }
                $update_stmt->close();
            } else {
                echo "Returner name does not match borrower.";
            }
        } else {
            echo "Book not found.";
        }

        $sql = "SELECT id, book_name, book_author, book_description, borrow_status, borrower FROM `books-table`";
        $result = $conn->query($sql);

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

        $stmt->close();
        $conn->close();
    ?>

    <a href="../user/user.html" id="backBtn">Go Back</a>
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
