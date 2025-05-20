<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "library"; 
$port = 3307; 

$conn = new mysqli($servername, $username, $password, $dbname, $port);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['insert'])) {
        $book_name = $_POST['book_name'];
        $isbn_no = $_POST['isbn_no'];
        $book_title = $_POST['book_title'];
        $author_name = $_POST['author_name'];
        $publisher_name = $_POST['publisher_name'];

        
        $stmt = $conn->prepare("INSERT INTO books (book_name, isbn_no, book_title, author_name, publisher_name) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $book_name, $isbn_no, $book_title, $author_name, $publisher_name);

        if ($stmt->execute()) {
            echo "New book record created successfully";
        } else {
            echo "Error: " . $stmt->error;
        }
        $stmt->close();
    }

    if (isset($_POST['delete'])) {
        $isbn_no = $_POST['isbn_no'];

        $stmt = $conn->prepare("DELETE FROM books WHERE isbn_no = ?");
        $stmt->bind_param("s", $isbn_no);

        if ($stmt->execute()) {
            echo "Book record deleted successfully";
        } else {
            echo "Error deleting record: " . $stmt->error;
        }
        $stmt->close();
    }

    if (isset($_POST['update'])) {
        $isbn_no = $_POST['isbn_no'];
        $book_name = $_POST['book_name'];
        $book_title = $_POST['book_title'];
        $author_name = $_POST['author_name'];
        $publisher_name = $_POST['publisher_name'];

        $stmt = $conn->prepare("UPDATE books SET book_name = ?, book_title = ?, author_name = ?, publisher_name = ? WHERE isbn_no = ?");
        $stmt->bind_param("sssss", $book_name, $book_title, $author_name, $publisher_name, $isbn_no);

        if ($stmt->execute()) {
            echo "Book record updated successfully";
        } else {
            echo "Error updating record: " . $stmt->error;
        }
        $stmt->close();
    }
}


$sql = "SELECT book_name, isbn_no, book_title, author_name, publisher_name FROM books";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Library Management System</title>
</head>
<body>
    <h2>Insert New Book</h2>
    <form method="POST" action="">
        <label for="book_name">Book Name:</label>
        <input type="text" name="book_name" required><br><br>
        
        <label for="isbn_no">ISBN No:</label>
        <input type="text" name="isbn_no" required><br><br>
        
        <label for="book_title">Book Title:</label>
        <input type="text" name="book_title" required><br><br>

        <label for="author_name">Author Name:</label>
        <input type="text" name="author_name" required><br><br>

        <label for="publisher_name">Publisher Name:</label>
        <input type="text" name="publisher_name" required><br><br>

        <input type="submit" name="insert" value="Add Book">
    </form>

    <h2>Update Book Information</h2>
    <form method="POST" action="">
        <label for="isbn_no">ISBN No:</label>
        <input type="text" name="isbn_no" required><br><br>

        <label for="book_name">Book Name:</label>
        <input type="text" name="book_name" required><br><br>
        
        <label for="book_title">Book Title:</label>
        <input type="text" name="book_title" required><br><br>

        <label for="author_name">Author Name:</label>
        <input type="text" name="author_name" required><br><br>

        <label for="publisher_name">Publisher Name:</label>
        <input type="text" name="publisher_name" required><br><br>

        <input type="submit" name="update" value="Update Book">
    </form>

    <h2>Delete Book Record</h2>
    <form method="POST" action="">
        <label for="isbn_no">ISBN No:</label>
        <input type="text" name="isbn_no" required><br><br>

        <input type="submit" name="delete" value="Delete Book">
    </form>

    <h2>Books List</h2>
    <table border="1">
        <tr>
            <th>Book Name</th>
            <th>ISBN No</th>
            <th>Book Title</th>
            <th>Author Name</th>
            <th>Publisher Name</th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($row["book_name"]) . "</td>";
                echo "<td>" . htmlspecialchars($row["isbn_no"]) . "</td>";
                echo "<td>" . htmlspecialchars($row["book_title"]) . "</td>";
                echo "<td>" . htmlspecialchars($row["author_name"]) . "</td>";
                echo "<td>" . htmlspecialchars($row["publisher_name"]) . "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='5'>No records found</td></tr>";
        }
        ?>
    </table>
</body>
</html>

<?php
$conn->close();
?>
