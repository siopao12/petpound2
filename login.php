<?php
session_start(); // Start session for managing user login state

include('config.php'); // Include database configuration

// Check if form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve username and password from form
    $Email = $_POST['Email'];
    $Password = $_POST['Password'];

    // Prepare SQL statement to retrieve user data
    $stmt = $conn->prepare("SELECT PetownerID, FirstName, MiddleName, LastName, Email, Password, Province, City, Barangay, Street, ContactNumber, Photos, user_type FROM petowner WHERE Email = ?");
    $stmt->bind_param("s", $Email);

    // Execute the statement
    $stmt->execute();

    // Bind result variables
    $stmt->bind_result($PetownerID, $FirstName, $MiddleName, $LastName, $storedEmail, $storedPassword, $Province, $City, $Barangay, $Street, $ContactNumber, $Photos, $user_type);

    // Fetch and verify user
    if ($stmt->fetch()) {
        // Verify password (using password_verify if using hashed passwords)
        if ($Password === $storedPassword) { // Replace with password_verify($Password, $storedPassword) if passwords are hashed
            // Password is correct, set session variables
            $_SESSION['PetownerID'] = $PetownerID;
            $_SESSION['FirstName'] = $FirstName;
            $_SESSION['MiddleName'] = $MiddleName;
            $_SESSION['LastName'] = $LastName;
            $_SESSION['Email'] = $storedEmail;
            $_SESSION['Province'] = $Province;
            $_SESSION['City'] = $City;
            $_SESSION['Barangay'] = $Barangay;
            $_SESSION['Street'] = $Street;
            $_SESSION['ContactNumber'] = $ContactNumber;
            $_SESSION['Photos'] = $Photos;
            $_SESSION['user_type'] = $user_type;

            // Redirect to the dashboard
            header("Location: dashboard.php");
            exit();
        } else {
            // Password is incorrect
            $_SESSION['loginError'] = "Invalid password";
            echo "<script type='text/javascript'>
                alert('Invalid password');
                window.location.href = 'landing.php';
              </script>";
            exit();
        }
    } else {
        // User not found
        $_SESSION['loginError'] = "User not found";
        echo "<script type='text/javascript'>
                alert('User not found');
                window.location.href = 'landing.php';
              </script>";
        exit();
    }
    
    // Close the statement
}
// Close connection
$conn->close();
?>
