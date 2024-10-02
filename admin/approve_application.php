<?php
include('adminconfig.php'); // Include your database configuration

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $applicantID = $_POST['ApplicantID'];

    if (isset($applicantID)) {
        // Update the applicants table status to 'approved'
        $sql1 = "UPDATE applicants SET Status = 'approved' WHERE ApplicantID = ?";

        if ($stmt1 = $conn->prepare($sql1)) {
            $stmt1->bind_param("i", $applicantID);

            if ($stmt1->execute()) {
                $stmt1->close();

                // Fetch the Email of the applicant to update in the petowner table
                $emailQuery = "SELECT Email FROM applicants WHERE ApplicantID = ?";
                if ($stmt2 = $conn->prepare($emailQuery)) {
                    $stmt2->bind_param("i", $applicantID);
                    $stmt2->execute();
                    $stmt2->bind_result($Email);
                    if ($stmt2->fetch()) {
                        $stmt2->close();

                        // Verify that this email exists in the petowner table
                        $emailCheckQuery = "SELECT * FROM petowner WHERE Email = ?";
                        if ($stmt3 = $conn->prepare($emailCheckQuery)) {
                            $stmt3->bind_param("s", $Email);
                            $stmt3->execute();
                            $result = $stmt3->get_result();

                            if ($result->num_rows > 0) {
                                $stmt3->close();

                                // Update the petowner table's user_type to 'admin'
                                $sql2 = "UPDATE petowner SET user_type = 'admin' WHERE Email = ?";
                                if ($stmt4 = $conn->prepare($sql2)) {
                                    $stmt4->bind_param("s", $Email);
                                    if ($stmt4->execute()) {
                                        echo "success"; // Return success response
                                    } else {
                                        echo "Error: Could not update petowner table. " . $stmt4->error;
                                    }
                                    $stmt4->close();
                                } else {
                                    echo "Error: Could not prepare update statement for petowner table.";
                                }
                            } else {
                                echo "Error: The email does not exist in the petowner table.";
                            }
                        } else {
                            echo "Error: Could not prepare statement to check email in petowner table.";
                        }
                    } else {
                        echo "Error: Could not fetch email from applicants table.";
                    }
                } else {
                    echo "Error: Could not prepare statement to fetch email.";
                }
            } else {
                echo "Error: Could not update applicants table. " . $stmt1->error;
            }
        } else {
            echo "Error: Could not prepare statement for applicants table.";
        }
    } else {
        echo "Error: Applicant ID not received.";
    }
}

$conn->close();
?>
