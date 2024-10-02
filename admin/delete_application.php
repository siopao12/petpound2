<?php
include('adminconfig.php'); // Include your database configuration

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $applicantID = $_POST['ApplicantID'];

    if (isset($applicantID)) {
        // Fetch the Email of the applicant before deleting
        $emailQuery = "SELECT Email FROM applicants WHERE ApplicantID = ?";
        if ($stmt1 = $conn->prepare($emailQuery)) {
            $stmt1->bind_param("i", $applicantID);
            $stmt1->execute();
            $stmt1->bind_result($Email);
            if ($stmt1->fetch()) {
                $stmt1->close();

                // Delete the applicant from the applicants table
                $sql = "DELETE FROM applicants WHERE ApplicantID = ?";
                if ($stmt2 = $conn->prepare($sql)) {
                    $stmt2->bind_param("i", $applicantID);
                    if ($stmt2->execute()) {
                        echo "success";
                    } else {
                        echo "Error: Could not delete application. " . $stmt2->error;
                    }
                    $stmt2->close();
                } else {
                    echo "Error: Could not prepare delete statement.";
                }

                // After deletion, ensure that the user's type in the petowner table is not elevated to admin
                $checkUserType = "SELECT user_type FROM petowner WHERE Email = ? AND user_type = 'admin'";
                if ($stmt3 = $conn->prepare($checkUserType)) {
                    $stmt3->bind_param("s", $Email);
                    $stmt3->execute();
                    $result = $stmt3->get_result();
                    if ($result->num_rows > 0) {
                        // Optionally, you can add logic here if you want to handle cases where the user was already an admin
                        // This logic would ensure that no incorrect changes are made.
                    }
                    $stmt3->close();
                } else {
                    echo "Error: Could not prepare statement to check user type.";
                }
            } else {
                echo "Error: Could not fetch email from applicants table.";
            }
        } else {
            echo "Error: Could not prepare statement to fetch email.";
        }
    } else {
        echo "Error: Applicant ID not received.";
    }
}

$conn->close();
?>
