<?php
session_start(); // Start session for managing user login state

include('adminconfig.php'); // Include database configuration

// Check if form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve username and password from form
    $Email = $_POST['Email'];
    $Password = $_POST['Password'];

    // Prepare SQL statement to retrieve user data
    $stmt = $conn->prepare("SELECT PoundofficerID, Firstname, Middlename, Lastname, Username, Email, Password, Province, City, Barangay, ContactNumber, Street, Sheltername, photos ,user_type FROM poundoffcer WHERE Email = ?");

    // Check if the prepare() method failed
    if ($stmt === false) {
        die("Error preparing statement: " . $conn->error);
    }

    $stmt->bind_param("s", $Email);

    // Execute the statement
    $stmt->execute();

    // Bind result variables
    $stmt->bind_result($PoundofficerID, $Firstname, $Middlename, $Lastname, $Username, $storedEmail, $storedPassword, $Province, $City, $Barangay, $ContactNumber, $Street, $Sheltername, $photos, $user_type);

    // Fetch and verify user
    if ($stmt->fetch()) {
        // Verify password (using password_verify if passwords are hashed)
        if ($Password === $storedPassword) {
            // Password is correct, set session variables
            $_SESSION['PoundofficerID'] = $PoundofficerID;
            $_SESSION['Firstname'] = $Firstname;
            $_SESSION['Middlename'] = $Middlename;
            $_SESSION['Lastname'] = $Lastname;
            $_SESSION['Email'] = $storedEmail;
            $_SESSION['Province'] = $Province;
            $_SESSION['City'] = $City;
            $_SESSION['Barangay'] = $Barangay;
            $_SESSION['Street'] = $Street;
            $_SESSION['ContactNumber'] = $ContactNumber;
            $_SESSION['user_type'] = $user_type;
            $_SESSION['photos'] = $photos;
            // Redirect to dashboard or home page
            $_SESSION['loginSuccessMessage'] = "Login successful!";
            header("Location: admindashboard.php");
            exit();
        } else {
            // Password is incorrect
            $_SESSION['loginError'] = "Invalid password";
            echo "<script type='text/javascript'>
                alert('Invalid password');
                window.location.href = 'adminlanding.php';
              </script>";
            exit();
        }
    } else {
        // User not found
        $_SESSION['loginError'] = "User not found";
        echo "<script type='text/javascript'>
                alert('User not found');
                window.location.href = 'adminlanding.php';
              </script>";
        exit();
    }

    // Close the statement

}
// Close connection
$conn->close();
?>
