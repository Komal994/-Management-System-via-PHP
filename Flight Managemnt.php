<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "flight_booking_management"; 
$port = 3307; 

$conn = new mysqli($servername, $username, $password, $dbname, $port);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['insert'])) {
        $passenger_name = $_POST['passenger_name'];
        $flight_from = $_POST['flight_from'];
        $flight_to = $_POST['flight_to'];
        $flight_date = $_POST['flight_date'];
        $departure_date = $_POST['departure_date'];
        $arrival_date = $_POST['arrival_date'];
        $phone_number = $_POST['phone_number'];
        $email_id = $_POST['email_id'];

        $stmt = $conn->prepare("INSERT INTO bookings (passenger_name, flight_from, flight_to, flight_date, departure_date, arrival_date, phone_number, email_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssssss", $passenger_name, $flight_from, $flight_to, $flight_date, $departure_date, $arrival_date, $phone_number, $email_id);

        if ($stmt->execute()) {
            echo "Booking record created successfully";
        } else {
            echo "Error: " . $stmt->error;
        }
        $stmt->close();
    }

    if (isset($_POST['delete'])) {
        $phone_number = $_POST['phone_number'];

        $stmt = $conn->prepare("DELETE FROM bookings WHERE phone_number = ?");
        $stmt->bind_param("s", $phone_number);

        if ($stmt->execute()) {
            echo "Booking record deleted successfully";
        } else {
            echo "Error deleting record: " . $stmt->error;
        }
        $stmt->close();
    }

    if (isset($_POST['update'])) {
        $phone_number = $_POST['phone_number'];
        $passenger_name = $_POST['passenger_name'];
        $flight_from = $_POST['flight_from'];
        $flight_to = $_POST['flight_to'];
        $flight_date = $_POST['flight_date'];
        $departure_date = $_POST['departure_date'];
        $arrival_date = $_POST['arrival_date'];
        $email_id = $_POST['email_id'];

        $stmt = $conn->prepare("UPDATE bookings SET passenger_name = ?, flight_from = ?, flight_to = ?, flight_date = ?, departure_date = ?, arrival_date = ?, email_id = ? WHERE phone_number = ?");
        $stmt->bind_param("ssssssss", $passenger_name, $flight_from, $flight_to, $flight_date, $departure_date, $arrival_date, $email_id, $phone_number);

        if ($stmt->execute()) {
            echo "Booking record updated successfully";
        } else {
            echo "Error updating record: " . $stmt->error;
        }
        $stmt->close();
    }
}

// D
$sql = "SELECT passenger_name, flight_from, flight_to, flight_date, departure_date, arrival_date, phone_number, email_id FROM bookings";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Flight Booking Management System</title>
</head>
<body>
    <h2>Insert New Booking</h2>
    <form method="POST" action="">
        <label for="passenger_name">Passenger Name:</label>
        <input type="text" name="passenger_name" required><br><br>

        <label for="flight_from">From:</label>
        <input type="text" name="flight_from" required><br><br>

        <label for="flight_to">To:</label>
        <input type="text" name="flight_to" required><br><br>

        <label for="flight_date">Flight Date:</label>
        <input type="date" name="flight_date" required><br><br>

        <label for="departure_date">Departure Date:</label>
        <input type="date" name="departure_date" required><br><br>

        <label for="arrival_date">Arrival Date:</label>
        <input type="date" name="arrival_date" required><br><br>

        <label for="phone_number">Phone Number:</label>
        <input type="text" name="phone_number" required><br><br>

        <label for="email_id">Email ID:</label>
        <input type="email" name="email_id" required><br><br>

        <input type="submit" name="insert" value="Add Booking">
    </form>

    <h2>Update Booking Information</h2>
    <form method="POST" action="">
        <label for="phone_number">Phone Number:</label>
        <input type="text" name="phone_number" required><br><br>

        <label for="passenger_name">Passenger Name:</label>
        <input type="text" name="passenger_name" required><br><br>

        <label for="flight_from">From:</label>
        <input type="text" name="flight_from" required><br><br>

        <label for="flight_to">To:</label>
        <input type="text" name="flight_to" required><br><br>

        <label for="flight_date">Flight Date:</label>
        <input type="date" name="flight_date" required><br><br>

        <label for="departure_date">Departure Date:</label>
        <input type="date" name="departure_date" required><br><br>

        <label for="arrival_date">Arrival Date:</label>
        <input type="date" name="arrival_date" required><br><br>

        <label for="email_id">Email ID:</label>
        <input type="email" name="email_id" required><br><br>

        <input type="submit" name="update" value="Update Booking">
    </form>

    <h2>Delete Booking Record</h2>
    <form method="POST" action="">
        <label for="phone_number">Phone Number:</label>
        <input type="text" name="phone_number" required><br><br>

        <input type="submit" name="delete" value="Delete Booking">
    </form>

    <h2>Bookings List</h2>
    <table border="1">
        <tr>
            <th>Passenger Name</th>
            <th>From</th>
            <th>To</th>
            <th>Flight Date</th>
            <th>Departure Date</th>
            <th>Arrival Date</th>
            <th>Phone Number</th>
            <th>Email ID</th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($row["passenger_name"]) . "</td>";
                echo "<td>" . htmlspecialchars($row["flight_from"]) . "</td>";
                echo "<td>" . htmlspecialchars($row["flight_to"]) . "</td>";
                echo "<td>" . htmlspecialchars($row["flight_date"]) . "</td>";
                echo "<td>" . htmlspecialchars($row["departure_date"]) . "</td>";
                echo "<td>" . htmlspecialchars($row["arrival_date"]) . "</td>";
                echo "<td>" . htmlspecialchars($row["phone_number"]) . "</td>";
                echo "<td>" . htmlspecialchars($row["email_id"]) . "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='8'>No records found</td></tr>";
        }
        ?>
    </table>
</body>
</html>

<?php
$conn->close();
?>
