<?php
$mysqli = new mysqli("db", "root", "rootpassword", "library-db");

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

$name = $_POST['name'];
$author = $_POST['author'];
$description = $_POST['description'];

$sql = "INSERT INTO `books-table` (book_name, book_author, book_description) VALUES ('$name', '$author', '$description')";

if ($mysqli->query($sql) === TRUE) {
    echo "New book added successfully";
} else {
    echo "Error: " . $sql . "<br>" . $mysqli->error;
}

$sql = "SELECT * FROM `books-table`";
$result = $mysqli->query($sql);
if ($result->num_rows > 0) {
    echo "<table border='1'>";
    echo "<tr>";
    // Output table headers
    while ($fieldinfo = $result->fetch_field()) {
        echo "<th>" . $fieldinfo->name . "</th>";
    }
    echo "</tr>";

    // Output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<tr>";
        foreach ($row as $value) {
            echo "<td>" . $value . "</td>";
        }
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "0 results";
}
$mysqli->close();
?>