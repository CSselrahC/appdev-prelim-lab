<?php
// ---------------- DATABASE CONNECTION ----------------

// Database connection
$servername = "db";
$username = "root";
$password = "rootpassword"; // change if your root user has a password
$database = "librarysys_db";

$conn = new mysqli($servername, $username, $password, $database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
session_start();

// ---------------- SEARCH FUNCTION ----------------
$search_query = "";
if (isset($_GET['query'])) {
    $search_query = $_GET['query'];
    $sql = "SELECT * FROM books 
            WHERE title LIKE '%$search_query%' 
               OR author LIKE '%$search_query%'
               OR genre LIKE '%$search_query%'";
} else {
    $sql = "SELECT * FROM books";
}
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Library Management System</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0; padding: 0;
            background: #f9f9f9;
        }
        nav {
            background: #333;
            padding: 10px;
        }
        nav a {
            color: white;
            text-decoration: none;
            margin: 0 15px;
        }
        h1 { text-align: center; margin-top: 20px; }
        .search-box {
            text-align: center;
            margin: 20px;
        }
        .search-box input {
            padding: 8px;
            width: 250px;
        }
        .search-box button {
            padding: 8px 12px;
        }
        table {
            width: 80%;
            margin: auto;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid #aaa;
        }
        th, td {
            padding: 10px;
            text-align: center;
        }
        footer {
            background: #333;
            color: white;
            text-align: center;
            padding: 15px;
            margin-top: 40px;
        }
    </style>
</head>
<body>
    <!-- ---------------- NAVIGATION BAR ---------------- -->
    <nav>
        <a href="index.php">Home</a>
        <a href="#">Catalog</a>
        <a href="#">Add Book</a>
        <a href="#">Borrow/Return</a>
        <a href="#">Login</a>
        <a href="#">Register</a>
    </nav>

    <!-- ---------------- WELCOME MESSAGE ---------------- -->
    <h1>Welcome to the Library</h1>

    <!-- ---------------- SEARCH FORM ---------------- -->
    <div class="search-box">
        <form method="GET" action="">
            <input type="text" name="query" placeholder="Search for a book..." value="<?php echo htmlspecialchars($search_query); ?>">
            <button type="submit">Search</button>
        </form>
    </div>

    <!-- ---------------- BOOK LIST ---------------- -->
    <table>
        <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Author</th>
            <th>Genre</th>
            <th>Year</th>
            <th>Status</th>
        </tr>
        <?php if ($result && $result->num_rows > 0): ?>
            <?php while($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo htmlspecialchars($row['title']); ?></td>
                    <td><?php echo htmlspecialchars($row['author']); ?></td>
                    <td><?php echo htmlspecialchars($row['genre']); ?></td>
                    <td><?php echo $row['year_published']; ?></td>
                    <td><?php echo ucfirst($row['status']); ?></td>
                </tr>
            <?php endwhile; ?>
        <?php else: ?>
            <tr><td colspan="6">No books found</td></tr>
        <?php endif; ?>
    </table>

    <!-- ---------------- FOOTER ---------------- -->
    <footer>
        <p>&copy; <?php echo date("Y"); ?> Simple Library Management System</p>
    </footer>
</body>
</html>

