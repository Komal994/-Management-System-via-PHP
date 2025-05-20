<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Registration Form</title>
    <style>
       
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f0f2f5;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            padding: 0;
            overflow: hidden; 
        }
        
        .form-container {
            background-color: #e6e6fa; 
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.15);
            max-width: 400px;
            width: 100%;
            max-height: 90vh; 
            overflow-y: auto; 
            transition: transform 0.3s ease;
        }
        
        h2 {
            color: #333333;
            font-size: 24px;
            font-weight: 600;
            margin-bottom: 20px;
            text-align: center;
        }
        
        label, input[type="text"], input[type="password"], select {
            display: block;
            width: 100%;
            margin-bottom: 12px;
            padding: 10px;
            border: 1px solid #cccccc;
            border-radius: 8px;
            font-size: 14px;
            color: #333333;
        }
        button {
            width: 100%;
            padding: 12px;
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 16px;
            font-weight: 600;
            transition: background-color 0.3s ease, transform 0.3s ease;
        }
        button:hover {
            background-color: #218838;
            transform: translateY(-3px);
        }
        .error {
            color: #e74c3c;
            font-size: 13px;
            display: block;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h2>Student Registration Form</h2>
        <form method="POST" action="">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required>

            <label for="email">Email:</label>
            <input type="text" id="email" name="email" required>
            <span class="error" id="emailError"></span>

            <label for="phone">Phone Number:</label>
            <input type="text" id="phone" name="phone" required>

            <label for="zipcode">Zip Code:</label>
            <input type="text" id="zipcode" name="zipcode" required>

            <label for="state">State:</label>
            <select id="state" name="state" required>
                <option value="">--Select State--</option>
                <option value="JK">Jammu and Kashmir</option>
                <option value="JH">Jharkhand</option>
                <option value="KA">Karnataka</option>
                <option value="KL">Kerala</option>
                <option value="MP">Madhya Pradesh</option>
                <option value="MH">Maharashtra</option>
            </select>

            <label>Gender:</label>
            <div class="gender-options">
                <input type="radio" id="male" name="gender" value="Male" required>
                <label for="male">Male</label>
                <input type="radio" id="female" name="gender" value="Female" required>
                <label for="female">Female</label>
                <input type="radio" id="other" name="gender" value="Other" required>
                <label for="other">Other</label>
            </div>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>

            <label for="confirmPassword">Confirm Password:</label>
            <input type="password" id="confirmPassword" name="confirmPassword" required>

            <button type="submit">Register</button>
        </form>
        
        <?php
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "student_db";
            $port = 3307;

            $conn = new mysqli($servername, $username, $password, $dbname, $port);
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            $name = $conn->real_escape_string($_POST['name']);
            $email = $conn->real_escape_string($_POST['email']);
            $phone = $conn->real_escape_string($_POST['phone']);
            $zipcode = $conn->real_escape_string($_POST['zipcode']);
            $state = $conn->real_escape_string($_POST['state']);
            $gender = $conn->real_escape_string($_POST['gender']);
            $password = $conn->real_escape_string($_POST['password']);

           
            $emailCheckQuery = "SELECT * FROM students WHERE email = '$email'";
            $result = $conn->query($emailCheckQuery);

            if ($result->num_rows > 0) {
                echo "<p class='error'>Email already exists. Please use a different email.</p>";
            } else {
                // Proceed with insertion
                $sql = "INSERT INTO students (name, email, phone, zipcode, state, gender, password) 
                        VALUES ('$name', '$email', '$phone', '$zipcode', '$state', '$gender', '$password')";

                if ($conn->query($sql) === TRUE) {
                    echo "<p>Registration successful!</p>";
                } else {
                    echo "<p>Error: " . $sql . "<br>" . $conn->error . "</p>";
                }
            }

            $conn->close();
        }
        ?>
    </div>
</body>
</html>
