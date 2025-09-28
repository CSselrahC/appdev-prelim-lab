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

    <div id="book-list">
        <?php
        $mysqli = new mysqli("db", "root", "rootpassword", "library-db");

        if ($mysqli->connect_error) {
            die("Connection failed: " . $mysqli->connect_error);
        }

        $search_query = "";
        $sql = "SELECT * FROM `books-table`";
        if (isset($_GET['query'])) {
            $search_query = $_GET['query'];
            $sql = "SELECT * FROM `books-table` WHERE book_name LIKE '%$search_query%' OR book_author LIKE '%$search_query%';";
        }

        $result = $mysqli->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo '<div class="book-card">';
                echo '<p><strong>ID:</strong> ' . htmlspecialchars($row['id']) . '</p>';
                echo '<h3>' . htmlspecialchars($row['book_name']) . '</h3>';
                echo '<p><strong>Author:</strong> ' . htmlspecialchars($row['book_author']) . '</p>';
                echo '<p><strong>Description:</strong> ' . htmlspecialchars($row['book_description']) . '</p>';
                echo '<p><strong>Status:</strong> ' . ($row['borrow_status']) . '</p>';
                echo '<p><strong>Borrower:</strong> ' . htmlspecialchars($row['borrower'] ? $row['borrower'] : 'N/A') . '</p>';
                echo '</div>';
                echo '<br>';
            }
        } else {
            echo "0 results";
        }
        $mysqli->close();
        ?>
    </div>
    <a href="user_browse_books.php" id="backBtn">Go Back</a>
    <footer>
        <p>Simple Library Management System</p>
        <p>CCS112 - Applications Development and Emerging Technologies</p>

        <div id="contacts">
            <p>Contact us:
                <a href="https://github.com/CSselrahC" target="_blank">CSselrahC</a> | 
                <a href="https://github.com/cntaxc" target="_blank">cntaxc</a>
            </p>
        </div>
    </footer>
</body>
</html>