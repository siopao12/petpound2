<?php
// Include the database configuration file
include('config.php');

// Check if the form is submitted for adding or editing an animal
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the request is to delete an animal record
    if (isset($_POST['action']) && $_POST['action'] == 'delete' && isset($_POST['ImpoundID'])) {
        $ImpoundID = $_POST['ImpoundID'];

        // Delete the animal from the animalimpound table
        $deleteQuery = "DELETE FROM animalimpound WHERE ImpoundID = ?";
        $stmt = $conn->prepare($deleteQuery);
        $stmt->bind_param("i", $ImpoundID);
        if ($stmt->execute()) {
            echo "<script>alert('Animal record deleted successfully.'); window.location.href = 'users.php';</script>";
        } else {
            echo "<script>alert('Failed to delete the record.'); window.location.href = 'users.php';</script>";
        }
        $stmt->close();
    } else {
        // Proceed with the rest of your existing POST handling for adding/editing an animal
        $AnimalName = mysqli_real_escape_string($conn, $_POST['AnimalName']);
        $Gender = mysqli_real_escape_string($conn, $_POST['Gender']);
        $AnimalColor = mysqli_real_escape_string($conn, $_POST['AnimalColor']);
        $DateCaught = mysqli_real_escape_string($conn, $_POST['DateCaught']);
        $TimeCaught = mysqli_real_escape_string($conn, $_POST['TimeCaught']);
        $LocationCaught = mysqli_real_escape_string($conn, $_POST['LocationCaught']);
        $HoldingStartDate = mysqli_real_escape_string($conn, $_POST['HoldingStartDate']);
        
        // Calculate HoldingEndDate (3 days after HoldingStartDate)
        $HoldingEndDate = date('Y-m-d', strtotime($HoldingStartDate . ' + 3 days'));

        // Calculate HoldingFee (500 PHP per day based on the number of days held)
        $currentDate = date('Y-m-d');
        $endDate = min($currentDate, $HoldingEndDate);  // Use the current date or end date, whichever is earlier

        $holdingDays = (strtotime($endDate) - strtotime($HoldingStartDate)) / (60 * 60 * 24);
        if ($holdingDays < 1) {
            $holdingDays = 1; // Minimum fee for 1 day
        }
        $HoldingFee = 500 * ceil($holdingDays); // 500 PHP per day
        
        $HoldingStatus = mysqli_real_escape_string($conn, $_POST['HoldingStatus']);
        $HoldingReason = mysqli_real_escape_string($conn, $_POST['HoldingReason']);
        $Description = mysqli_real_escape_string($conn, $_POST['Description']); // Sanitize description input
        
        // Handle the image upload
        if (!empty($_FILES["AnimalImage"]["tmp_name"])) {
            $targetDir = "uploads/animals/";
            $AnimalImage = basename($_FILES["AnimalImage"]["name"]);
            $targetFilePath = $targetDir . $AnimalImage;
            $imageFileType = strtolower(pathinfo($targetFilePath, PATHINFO_EXTENSION));
            $uploadOk = 1;

            // Check if the file is an actual image
            $check = getimagesize($_FILES["AnimalImage"]["tmp_name"]);
            if ($check === false) {
                echo "<script>alert('File is not an image.');</script>";
                $uploadOk = 0;
            }

            // Check file size (limit set to 10MB)
            if ($_FILES["AnimalImage"]["size"] > 10485760) {
                echo "<script>alert('Sorry, your file is too large. Maximum file size is 10MB.');</script>";
                $uploadOk = 0;
            }

            // Allow only certain file formats
            $allowedFormats = array("jpg", "jpeg", "png");
            if (!in_array($imageFileType, $allowedFormats)) {
                echo "<script>alert('Sorry, only JPG, JPEG, & PNG files are allowed.');</script>";
                $uploadOk = 0;
            }

            // Check if $uploadOk is set to 0 by an error
            if ($uploadOk == 0) {
                echo "<script>alert('Sorry, your file was not uploaded.');</script>";
            } else {
                // If everything is ok, try to upload the file
                if (move_uploaded_file($_FILES["AnimalImage"]["tmp_name"], $targetFilePath)) {
                    // Insert or update the database record
                    handleDatabaseOperation($conn, $AnimalName, $Gender, $AnimalColor, $DateCaught, $TimeCaught, $LocationCaught, $HoldingStartDate, $HoldingEndDate, $HoldingStatus, $HoldingReason, $HoldingFee, $AnimalImage, $Description);
                } else {
                    echo "<script>alert('Sorry, there was an error uploading your file.');</script>";
                }
            }
        } else {
            // No file was uploaded, so just handle the database operation without the image
            handleDatabaseOperation($conn, $AnimalName, $Gender, $AnimalColor, $DateCaught, $TimeCaught, $LocationCaught, $HoldingStartDate, $HoldingEndDate, $HoldingStatus, $HoldingReason, $HoldingFee, null, $Description);
        }
    }
}

// Function to handle database insert/update
function handleDatabaseOperation($conn, $AnimalName, $Gender, $AnimalColor, $DateCaught, $TimeCaught, $LocationCaught, $HoldingStartDate, $HoldingEndDate, $HoldingStatus, $HoldingReason, $HoldingFee, $AnimalImage, $Description) {
    if (isset($_POST['ImpoundID'])) {
        // Update existing animal record
        $ImpoundID = mysqli_real_escape_string($conn, $_POST['ImpoundID']);
        $sql = "UPDATE animalimpound 
                SET AnimalName='$AnimalName', Gender='$Gender', AnimalColor='$AnimalColor', DateCaught='$DateCaught', 
                    TimeCaught='$TimeCaught', LocationCaught='$LocationCaught', HoldingStartDate='$HoldingStartDate', 
                    HoldingEndDate='$HoldingEndDate', HoldingStatus='$HoldingStatus', HoldingReason='$HoldingReason', 
                    HoldingFee='$HoldingFee', Description='$Description'";
        
        if ($AnimalImage !== null) {
            $sql .= ", AnimalImage='$AnimalImage'";
        }
        
        $sql .= " WHERE ImpoundID='$ImpoundID'";

        if (mysqli_query($conn, $sql)) {
            echo "<script>alert('Animal record updated successfully.'); window.location.href = 'users.php';</script>";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    } else {
        // Insert a new animal record
        $sql = "INSERT INTO animalimpound (AnimalName, Gender, AnimalColor, DateCaught, TimeCaught, LocationCaught, HoldingStartDate, HoldingEndDate, HoldingStatus, HoldingReason, HoldingFee, AnimalImage, Description) 
                VALUES ('$AnimalName', '$Gender', '$AnimalColor', '$DateCaught', '$TimeCaught', '$LocationCaught', '$HoldingStartDate', '$HoldingEndDate', '$HoldingStatus', '$HoldingReason', '$HoldingFee', '$AnimalImage', '$Description')";
        if (mysqli_query($conn, $sql)) {
            echo "<script>alert('New animal added successfully.'); window.location.href = 'users.php';</script>";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    }
}

// Close the database connection
mysqli_close($conn);
?>
