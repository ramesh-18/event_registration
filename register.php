<?php

$firstname = $_POST["firstname"];
$lastname = $_POST["lastname"];
$email = $_POST["email"];
$gender = $_POST["gender"];
$phonenumber = $_POST["phonenumber"];
$collegename = $_POST["collegename"];
$course = $_POST["Events"];

$conn = new mysqli('localhost', 'root', '', 'db_event_registration');

if ($conn->connect_error) {
    die('Connection Failed: ' . $conn->connect_error);
} else {
    $stmt = $conn->prepare("INSERT INTO registration (firstname, lastname, email, gender, phonenumber, collegename, Events) VALUES (?, ?, ?, ?, ?, ?, ?)");
    if ($stmt === false) {
        die('Error preparing statement: ' . $conn->error); // Output SQL error
    }
    $stmt->bind_param("ssssiss", $firstname, $lastname, $email, $gender, $phonenumber, $collegename, $course);
    if ($stmt->execute()) {
        echo "Registration successful...";
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
    $conn->close();
}
?>
