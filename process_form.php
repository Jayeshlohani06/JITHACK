<?php
$servername = "localhost";
$username = "root@localhost";
$password = "123";
$database = "sanskar_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Function to sanitize form inputs
function sanitize_input($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}

// Handle Needy Form submission
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["needy_submit"])) {
    $name = sanitize_input($_POST["name"]);
    $address = sanitize_input($_POST["address"]);
    $phone = sanitize_input($_POST["phone"]);
    $children = intval($_POST["children"]);
    $adults = intval($_POST["adults"]);

    // Prepare and bind SQL statement
    $stmt = $conn->prepare("INSERT INTO needy_responses (name, address, phone, children, adults) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssi", $name, $address, $phone, $children, $adults);

    // Execute the statement
    if ($stmt->execute() === TRUE) {
        echo "Needy response recorded successfully.";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

// Handle Abundant Form submission
// Add similar blocks for other form sections...

$conn->close();
?>
:
