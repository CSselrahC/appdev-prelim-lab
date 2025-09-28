  <!DOCTYPE html>
<html>
<head>
  <title>Library Management System</title>
  <style>
    body {
      margin: 0;
      font-family: Arial, sans-serif;
      background: #f4f4f9;
    }

    /* HEADER */
    header {
      background: #8B5E3C;
      padding: 20px;
      text-align: center;
      color: white;
      font-size: 24px;
      font-weight: bold;
    }

    /* SEARCH BAR CONTAINER */
    .search-container {
      text-align: center;
      margin: 30px auto;
    }

    /* SEARCH INPUT */
    .search-container input[type="text"] {
      width: 350px;
      padding: 12px 15px;
      border: 2px solid #8B5E3C;
      border-radius: 25px 0 0 25px;
      outline: none;
      font-size: 16px;
      transition: 0.3s;
    }

    .search-container input[type="text"]:focus {
      border-color: #5C3D2E;
      box-shadow: 0 0 5px #8B5E3C;
    }

    /* SEARCH BUTTON */
    .search-container button {
      padding: 12px 20px;
      border: none;
      background: #8B5E3C;
      color: white;
      font-size: 16px;
      cursor: pointer;
      border-radius: 0 25px 25px 0;
      transition: 0.3s;
    }

    .search-container button:hover {
      background: #5C3D2E;
    }
  </style>
</head>
<body>
  <header>
    Library Management System
  </header>

  <div class="search-container">
    <form method="GET" action="search_books.php">
      <input type="text" name="query" placeholder="ðŸ” Search for a book...">
      <button type="submit">Search</button>
    </form>
  </div>
</body>
</html>

