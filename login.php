<?php
// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get user input
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Connect to the database
    $conn = new mysqli( 'Soham', 'Soham@123', 'users');

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare a secure SQL statement to prevent SQL injection
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ? AND password = ?");
    $stmt->bind_param("ss", $email, $password);

    // Execute the statement
    $stmt->execute();

    // Get the result
    $result = $stmt->get_result();

    // Check if login is successful
    if ($result->num_rows > 0) {
        // Retrieve user name
        $row = $result->fetch_assoc();
        echo "Welcome, " . $row['name'] . "!";
    } else {
        echo "Invalid login details!";
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
}
?>