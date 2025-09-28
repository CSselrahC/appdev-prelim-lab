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

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $book_id = $_POST['book_id'];
        $borrower_name = $_POST['borrower_name'];

        $sql = "SELECT borrow_status FROM `books-table` WHERE id = $book_id";

        $result = $mysqli->query($sql);
        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            if ($row['borrow_status'] == 'available') {
                $sql = "UPDATE `books-table` 
                        SET borrow_status = 'borrowed', borrower = '$borrower_name' 
                        WHERE id = $book_id";

                $stmt = $mysqli->prepare($sql);
                if (!$stmt) {
                    die("Prepare failed: " . $mysqli->error);
                }
                
                if ($stmt->execute()) {
                    echo "<p style='color:green;'>✅ Book borrowed successfully!</p>";
                } else {
                    echo "<p style='color:red;'>❌ Error: " . $stmt->error . "</p>";
                }

                $stmt->close();
            } else {
                echo "<p style='color:red;'>❌ Book is already borrowed by someone!</p>";
            }
        } else {
            echo "<p style='color:red;'>❌ Book not found!</p>";
        }
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
