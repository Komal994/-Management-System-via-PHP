<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "employee_management"; 
$port = 3307; 

$conn = new mysqli($servername, $username, $password, $dbname, $port);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['insert'])) {
        $employee_name = $_POST['employee_name'];
        $employee_id = $_POST['employee_id'];
        $department_name = $_POST['department_name'];
        $phone_number = $_POST['phone_number'];
        $joining_date = $_POST['joining_date'];

        $stmt = $conn->prepare("INSERT INTO employees (employee_name, employee_id, department_name, phone_number, joining_date) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $employee_name, $employee_id, $department_name, $phone_number, $joining_date);

        if ($stmt->execute()) {
            echo "Employee added successfully.";
        } else {
            echo "Error: " . $stmt->error;
        }
        $stmt->close();
    }

    if (isset($_POST['delete'])) {
        $employee_id = $_POST['employee_id'];

        $stmt = $conn->prepare("DELETE FROM employees WHERE employee_id = ?");
        $stmt->bind_param("s", $employee_id);

        if ($stmt->execute()) {
            echo "Employee deleted successfully.";
        } else {
            echo "Error: " . $stmt->error;
        }
        $stmt->close();
    }

    if (isset($_POST['update'])) {
        $employee_id = $_POST['employee_id'];
        $employee_name = $_POST['employee_name'];
        $department_name = $_POST['department_name'];
        $phone_number = $_POST['phone_number'];
        $joining_date = $_POST['joining_date'];

        $stmt = $conn->prepare("UPDATE employees SET employee_name = ?, department_name = ?, phone_number = ?, joining_date = ? WHERE employee_id = ?");
        $stmt->bind_param("sssss", $employee_name, $department_name, $phone_number, $joining_date, $employee_id);

        if ($stmt->execute()) {
            echo "Employee details updated successfully.";
        } else {
            echo "Error: " . $stmt->error;
        }
        $stmt->close();
    }
}


$sql = "SELECT employee_name, employee_id, department_name, phone_number, joining_date FROM employees";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Employee Management System</title>
    <script>
        function validateForm() {
            var name = document.forms["employeeForm"]["employee_name"].value;
            var id = document.forms["employeeForm"]["employee_id"].value;
            var department = document.forms["employeeForm"]["department_name"].value;
            var phone = document.forms["employeeForm"]["phone_number"].value;
            var date = document.forms["employeeForm"]["joining_date"].value;

            if (name == "" || id == "" || department == "" || phone == "" || date == "") {
                alert("All fields must be filled out");
                return false;
            }

            
        }
    </script>
</head>
<body>
    <h2>Insert New Employee</h2>
    <form name="employeeForm" method="POST" action="" onsubmit="return validateForm()">
        <label for="employee_name">Employee Name:</label>
        <input type="text" name="employee_name" required><br><br>

        <label for="employee_id">Employee ID:</label>
        <input type="text" name="employee_id" required><br><br>

        <label for="department_name">Department Name:</label>
        <input type="text" name="department_name" required><br><br>

        <label for="phone_number">Phone Number:</label>
        <input type="text" name="phone_number" required><br><br>

        <label for="joining_date">Joining Date:</label>
        <input type="date" name="joining_date" required><br><br>

        <input type="submit" name="insert" value="Add Employee">
    </form>

    <h2>Update Employee Information</h2>
    <form name="employeeForm" method="POST" action="" onsubmit="return validateForm()">
        <label for="employee_id">Employee ID:</label>
        <input type="text" name="employee_id" required><br><br>

        <label for="employee_name">Employee Name:</label>
        <input type="text" name="employee_name"><br><br>

        <label for="department_name">Department Name:</label>
        <input type="text" name="department_name"><br><br>

        <label for="phone_number">Phone Number:</label>
        <input type="text" name="phone_number"><br><br>

        <label for="joining_date">Joining Date:</label>
        <input type="date" name="joining_date"><br><br>

        <input type="submit" name="update" value="Update Employee">
    </form>

    <h2>Delete Employee Record</h2>
    <form method="POST" action="">
        <label for="employee_id">Employee ID:</label>
        <input type="text" name="employee_id" required><br><br>

        <input type="submit" name="delete" value="Delete Employee">
    </form>

    <h2>Employee Records</h2>
    <table border="1">
        <tr>
            <th>Employee Name</th>
            <th>Employee ID</th>
            <th>Department Name</th>
            <th>Phone Number</th>
            <th>Joining Date</th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($row["employee_name"]) . "</td>";
                echo "<td>" . htmlspecialchars($row["employee_id"]) . "</td>";
                echo "<td>" . htmlspecialchars($row["department_name"]) . "</td>";
                echo "<td>" . htmlspecialchars($row["phone_number"]) . "</td>";
                echo "<td>" . htmlspecialchars($row["joining_date"]) . "</td>";
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
