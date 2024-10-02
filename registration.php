<?php
include('config.php');

// Check if form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Prepare the statement
    $stmt = $conn->prepare("INSERT INTO petowner (FirstName, Middlename, LastName, Gender, Email, Password, Province, City, Barangay, Street, Contactnumber,user_type) 
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?,'user')");

    // Check if the prepare() method failed
    if ($stmt === false) {
        die("Error preparing statement: " . $conn->error);
    }

    // Bind the parameters
    $stmt->bind_param("sssssssssss", $FirstName, $Middlename, $LastName, $Gender, $Email, $Password, $Province, $City, $Barangay, $Street, $Contactnumber);

    // Set parameters from POST data
    $FirstName= $_POST['FirstName'];
    $Middlename = isset($_POST['Middlename']) ? $_POST['Middlename'] : null;
    $LastName = $_POST['LastName'];
    $Gender=$_POST['Gender'];
    $Email = $_POST['Email'];
    $Password = $_POST['Password'];
    $Province = $_POST['Province'];
    $City = $_POST['City'];
    $Barangay = $_POST['Barangay'];
    $Street = $_POST['Street'];
    $Contactnumber = $_POST['Contactnumber'];

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
        window.location.href = 'landing.php';
      </script>";
?>
