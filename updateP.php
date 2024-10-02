<?php
include('config.php');
session_start();

if (!isset($_SESSION['PetownerID'])) {
    header("Location: landing.php");
    exit();
}

$PetownerID = $_SESSION['PetownerID'];
$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $FirstName = $_POST['FirstName'];
    $MiddleName = $_POST['MiddleName'];
    $LastName = $_POST['LastName'];
    $Gender = $_POST['Gender'];
    $ContactNumber = $_POST['ContactNumber'];
    $Email = $_POST['Email'];
    $Password = $_POST['Password'];
    $Province = $_POST['Province'];
    $City = $_POST['City'];
    $Barangay = $_POST['Barangay'];
    $Street = $_POST['Street'];

    // Handle file upload for Photos
    $Photos = NULL;
    if (isset($_FILES['Photos']) && $_FILES['Photos']['error'] == UPLOAD_ERR_OK) {
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["Photos"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Check if image file is an actual image or fake image
        $check = getimagesize($_FILES["Photos"]["tmp_name"]);
        if ($check !== false) {
            $uploadOk = 1;
        } else {
            $message = "File is not an image.";
            $uploadOk = 0;
        }

        // Check file size (limit to 5MB)
        if ($_FILES["Photos"]["size"] > 5 * 1024 * 1024) {
            $message = "Sorry, your file is too large. Maximum size allowed is 5 MB.";
            $uploadOk = 0;
        }

        // Allow only certain file formats
        $allowedExtensions = array('jpg', 'jpeg', 'png', 'gif');
        if (!in_array($imageFileType, $allowedExtensions)) {
            $message = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }

        if ($uploadOk == 1) {
            if (move_uploaded_file($_FILES["Photos"]["tmp_name"], $target_file)) {
                $Photos = $target_file;
            } else {
                $message = "Sorry, there was an error uploading your file.";
            }
        }
    }

    if ($Photos) {
        $stmt = $conn->prepare("UPDATE petowner SET Firstname=?, Middlename=?, Lastname=?, Gender=?, Email=?, Password=?, Province=?, City=?, Barangay=?, Street=?, Contactnumber=?, Photos=? WHERE PetownerID=?");
        $stmt->bind_param("ssssssssssssi", $FirstName, $MiddleName, $LastName, $Gender, $Email, $Password, $Province, $City, $Barangay, $Street, $ContactNumber, $Photos, $PetownerID);
    } else {
        $stmt = $conn->prepare("UPDATE petowner SET Firstname=?, Middlename=?, Lastname=?, Gender=?, Email=?, Password=?, Province=?, City=?, Barangay=?, Street=?, Contactnumber=? WHERE PetownerID=?");
        $stmt->bind_param("sssssssssssi", $FirstName, $MiddleName, $LastName, $Gender, $Email, $Password, $Province, $City, $Barangay, $Street, $ContactNumber, $PetownerID);
    }

    if ($stmt->execute()) {
        $message = "Profile updated successfully";
        $_SESSION['FirstName'] = $FirstName;
        $_SESSION['MiddleName'] = $MiddleName;
        $_SESSION['LastName'] = $LastName;
        $_SESSION['Gender'] = $Gender;
        $_SESSION['Email'] = $Email;
        $_SESSION['Province'] = $Province;
        $_SESSION['City'] = $City;
        $_SESSION['Barangay'] = $Barangay;
        $_SESSION['Street'] = $Street;
        $_SESSION['ContactNumber'] = $ContactNumber;
        $_SESSION['Photos'] = $Photos;
    } else {
        $message = "Error updating profile: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();

    echo "<script type='text/javascript'>
            alert('$message');
            window.location.href = 'dashboard.php';
          </script>";
} else {
    header("Location: dashboard.php");
    exit();
}
?>
