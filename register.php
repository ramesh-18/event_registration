<?php
// Capture and sanitize form data
$firstname = htmlspecialchars(trim($_POST["firstname"]));
$lastname = htmlspecialchars(trim($_POST["lastname"]));
$email = htmlspecialchars(trim($_POST["email"]));
$gender = htmlspecialchars(trim($_POST["gender"]));
$phonenumber = htmlspecialchars(trim($_POST["phonenumber"]));
$collegename = htmlspecialchars(trim($_POST["collegename"]));

// Check if optional fields are set and sanitize them
$Techevent = isset($_POST["Techevent"]) ? htmlspecialchars(trim($_POST["Techevent"])) : '';
$NonTechevent = isset($_POST["NonTechevent"]) ? htmlspecialchars(trim($_POST["NonTechevent"])) : '';

// Create connection
$conn = new mysqli('localhost', 'root', '1234', 'db_college_registration');

// Check connection
if ($conn->connect_error) {
    error_log('Connection Failed: ' . $conn->connect_error, 0);
    die('Connection Failed. Please try again later.');
} else {
    $stmt = $conn->prepare("INSERT INTO registrations (firstname, lastname, email, gender, phonenumber, collegename, Techevent, NonTechevent) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssssss", $firstname, $lastname, $email, $gender, $phonenumber, $collegename, $Techevent, $NonTechevent);

    // Execute statement
    if ($stmt->execute()) {
        echo "Registration successful...";
    } else {
        error_log('Error: ' . $stmt->error, 0);
        echo "Error: There was an issue with your registration.";
    }

    // Close statement and connection
    $stmt->close();
    $conn->close();
}
?>
