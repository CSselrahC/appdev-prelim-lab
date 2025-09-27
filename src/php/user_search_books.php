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