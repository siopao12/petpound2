<?php
include('config.php');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize form inputs
    $Firstname = htmlspecialchars(trim($_POST['Firstname']));
    $Lastname = htmlspecialchars(trim($_POST['Lastname']));
    $Email = filter_var(trim($_POST['Email']), FILTER_SANITIZE_EMAIL);
    $ContactNumber = htmlspecialchars(trim($_POST['ContactNumber']));
    $Description = htmlspecialchars(trim($_POST['Description']));
    $Status = 'pending'; // Default status

    // Handle file uploads
    $idFile = $_FILES['ID'];
    $resumeFile = $_FILES['Resume'];

    // Define allowed file types and size limit (e.g., 2MB)
    $allowedFileTypes = ['image/jpeg', 'image/png', 'application/pdf'];
    $maxFileSize = 2 * 1024 * 1024; // 2MB

    // Define file paths
    $idDirectory = 'ValidID/';
    $resumeDirectory = 'Resume/';
    $idFilePath = $idDirectory . basename($idFile['name']);
    $resumeFilePath = $resumeDirectory . basename($resumeFile['name']);

    // Ensure the directories exist
    if (!is_dir($idDirectory)) {
        mkdir($idDirectory, 0777, true);
    }
    if (!is_dir($resumeDirectory)) {
        mkdir($resumeDirectory, 0777, true);
    }

    // Validate file type and size for ID
    if (in_array($idFile['type'], $allowedFileTypes) && $idFile['size'] <= $maxFileSize) {
        $idUploadSuccess = move_uploaded_file($idFile['tmp_name'], $idFilePath);
    } else {
        $idUploadSuccess = false;
    }

    // Validate file type and size for Resume
    if (in_array($resumeFile['type'], $allowedFileTypes) && $resumeFile['size'] <= $maxFileSize) {
        $resumeUploadSuccess = move_uploaded_file($resumeFile['tmp_name'], $resumeFilePath);
    } else {
        $resumeUploadSuccess = false;
    }

    if ($idUploadSuccess && $resumeUploadSuccess) {
        // Prepare and bind
        $stmt = $conn->prepare("INSERT INTO applicants (Firstname, Lastname, Email, ContactNumber, ValidID, Resume, Description, Status) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssssss", $Firstname, $Lastname, $Email, $ContactNumber, $idFilePath, $resumeFilePath, $Description, $Status);

        if ($stmt->execute() === TRUE) {
            echo "<script>
                    alert('Please wait for 2 days to validate your information. We will notify you as soon as possible. Thanks for applying!');
                    window.location.href = 'dashboard.php'; // Redirect to the dashboard or desired page
                  </script>";
        } else {
            echo "<script>
                    alert('There was an error submitting your application. Please try again.');
                    window.history.back(); // Redirect back to the form
                  </script>";
        }

        $stmt->close();
    } else {
        $errorMessage = 'There was an error uploading your files.';
        if (!$idUploadSuccess) {
            $errorMessage .= ' Please ensure your ID is a JPEG, PNG, or PDF file and does not exceed 2MB.';
        }
        if (!$resumeUploadSuccess) {
            $errorMessage .= ' Please ensure your resume is a PDF file and does not exceed 2MB.';
        }
        echo "<script>
                alert('$errorMessage');
                window.history.back(); // Redirect back to the form
              </script>";
    }

    $conn->close();
}
?>
