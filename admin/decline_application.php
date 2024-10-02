<?php
session_start();
include('adminconfig.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $applicantID = $_POST['ApplicantID'];

    if (isset($applicantID)) {
        // Update the applicants table status to 'declined'
        $sql = "UPDATE applicants SET Status = 'declined' WHERE ApplicantID = ?";

        if ($stmt = $conn->prepare($sql)) {
            $stmt->bind_param("i", $applicantID);

            if ($stmt->execute()) {
                // Ensure the user session is updated
                if (isset($_SESSION['PetownerID']) && $_SESSION['PetownerID'] == $applicantID) {
                    // Reset user type in session
                    $_SESSION['user_type'] = 'user';  // Assuming 'user' is the default non-admin role
                    // Debugging - Check session
                    error_log("User type after decline: " . $_SESSION['user_type']);
                }
                echo json_encode(['status' => 'success', 'user_type' => $_SESSION['user_type']]);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Could not decline application. ' . $stmt->error]);
            }
            $stmt->close();
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Could not prepare statement.']);
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Applicant ID not received.']);
    }
}

$conn->close();


?>
