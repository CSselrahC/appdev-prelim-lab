<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library MS</title>
    <link rel="stylesheet" type="text/css" href="../css/user_browse_style.css">
</head>

<body>
    <header>
        <h1>Library Management System</h1>
    </header>

    <div id="content">
        <h2>📚 Browse Books</h2>
        <?php
 
        $mysqli = new mysqli("db", "root", "rootpassword", "library-db");

        if ($mysqli->connect_error) {
            die("Connection failed: " . $mysqli->connect_error);
        }

        $sql = "SELECT book_name, book_author, book_description FROM `books-table`";
        $result = $mysqli->query($sql);
        ?>

        <div id="book-list">
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo '<div class="book-card">';
                    echo '<h3>' . htmlspecialchars($row['book_name']) . '</h3>';
                    echo '<p><strong>Author:</strong> ' . htmlspecialchars($row['book_author']) . '</p>';
                    echo '<p><strong>Description:</strong> ' . htmlspecialchars($row['book_description']) . '</p>';
                    echo '</div>';
                }
            } else {
                echo "<p style='text-align:center;'>No books found in the library.</p>";
            }
            ?>
        </div>
    </div>
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

<?php
$mysqli->close();
?>
