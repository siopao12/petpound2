<?php
include('adminconfig.php');

// Check if form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Prepare the statement
    $stmt = $conn->prepare("INSERT INTO poundoffcer (Firstname, Middlename, Lastname, Gender, Email, Password, Username, Province, City, Barangay, ContactNumber, Street, Sheltername, user_type) 
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 'admin')");

    // Check if the prepare() method failed
    if ($stmt === false) {
        die("Error preparing statement: " . $conn->error);
    }

    // Bind the parameters
    $stmt->bind_param("sssssssssssss", $Firstname, $Middlename, $Lastname, $Gender, $Email, $Password, $Username, $Province, $City, $Barangay, $ContactNumber, $Street, $Shelter);

    // Set parameters from POST data
    $Firstname = $_POST['Firstname']; // Corrected the case to match HTML
    $Middlename = isset($_POST['Middlename']) ? $_POST['Middlename'] : null; // Corrected the case to match HTML
    $Lastname = $_POST['Lastname']; // Corrected the case to match HTML
    $Gender = $_POST['Gender'];
    $Email = $_POST['Email'];
    $Password = $_POST['Password'];
    $Username = $_POST['Username'];
    $Province = $_POST['Province'];
    $City = $_POST['City'];
    $Barangay = $_POST['Barangay'];
    $ContactNumber = $_POST['ContactNumber'];
    $Street = $_POST['Street'];
    $Shelter = $_POST['Shelter'];

    // Execute the statement
    if ($stmt->execute()) {
        $message = "New record created successfully";
    } else {
        $message = "Error: " . $stmt->error;
    }

    // Close statement
    $stmt->close();
} else {
    $message = "Form submission method not valid.";
}

// Close connection
$conn->close();

// Output JavaScript for alert and redirection
echo "<script type='text/javascript'>
        alert('$message');
        window.location.href = 'adminlanding.php';
      </script>";
?>
