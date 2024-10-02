<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['PoundofficerID'])) {
    header("Location: adminlanding.php");
    exit();
}

// Include the database configuration file
include('adminconfig.php');

// Fetch user details from session variables safely
$Firstname = $_SESSION['Firstname'] ?? '';
$Middlename = $_SESSION['Middlename'] ?? '';
$Lastname = $_SESSION['Lastname'] ?? '';
$Gender = $_SESSION['Gender'] ?? '';
$ContactNumber = $_SESSION['ContactNumber'] ?? '';
$Email = $_SESSION['Email'] ?? '';
$Photos = $_SESSION['Photos'] ?? '';
$Province = $_SESSION['Province'] ?? '';
$Barangay = $_SESSION['Barangay'] ?? '';
$City = $_SESSION['City'] ?? '';
$Street = $_SESSION['Street'] ?? '';
$user_type=$_SESSION['user_type']?? '';

// Fetch data from the database
$query = "SELECT ApplicantID, Firstname, Lastname, Email, ContactNumber, ValidID, Resume, Status, Description FROM applicants";
$result = $conn->query($query);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Responsive Navbar with Sidebar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/admindashboard.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-custom">
    <div class="container-fluid">
        <button class="menu-button" id="sidebar-toggle" type="button">&#9776;</button>
        <a class="navbar-brand" href="#">
            <img src="images/logos.png" width="30" height="30" class="d-inline-block align-top" alt="">
            PetPound
        </a>
        <button class="navbar-toggler custom-toggler collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="custom-toggler-icon">&#9660;</span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link" href="#">
                        <i class="fa-solid fa-bell fa-1x"></i> Notification
                    </a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownLanguage" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fa-solid fa-globe fa-1x"></i> Language
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownLanguage">
                        <li><a class="dropdown-item" href="#">English</a></li>
                        <li><a class="dropdown-item" href="#">Tagalog</a></li>
                        <li><a class="dropdown-item" href="#">Bisaya</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownProfile" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <?php if (!empty($Photos)) : ?>
                            <img src="<?php echo htmlspecialchars($Photos); ?>" alt="User Photo" width="30" height="30">
                        <?php else : ?>
                            <img src="images/default_profile.png" alt="Profile" width="30" height="30">
                        <?php endif; ?>
                        <?php echo htmlspecialchars($user_type); ?>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownProfile">
                        <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#profileModal">Profile</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="adminlogout.php">Logout</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- Sidebar -->
<div id="mySidebar" class="sidebar">
    <div class="profile-sidebarmain">
        <a href="#" class="active"><i class="fa-solid fa-tachometer-alt fa-lg"></i> <span>Dashboard</span></a>
        <a href="#"><i class="fa-solid fa-book fa-lg"></i> <span>Resources</span></a>
        <a href="#"><i class="fa-solid fa-dog fa-lg"></i> <span>Pet Register</span></a>
        <a href="#"><i class="fa-solid fa-stethoscope fa-lg"></i> <span>VetClinic</span></a>
        <a href="#"><i class="fa-solid fa-file-alt fa-lg"></i> <span>Report</span></a>
    </div>
</div>

<!-- Main content -->
<div class="main-content container-fluid mt-5" id="main-content">
    <div class="row">
        <h2>Dashboard Overview</h2>
        <div class="col-md-4 mb-3">
            <div class="card text-white bg-primary">
                <div class="card-body">
                    <h5 class="card-title">Total Revenue</h5>
                    <p class="card-text">$50,000</p>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card text-white bg-success">
                <div class="card-body">
                    <h5 class="card-title">Registered Accounts</h5>
                    <p class="card-text">1500</p>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card text-white bg-warning">
                <div class="card-body">
                    <h5 class="card-title">Products Sold</h5>
                    <p class="card-text">2000</p>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card text-white bg-danger">
                <div class="card-body">
                    <h5 class="card-title">Pending Approvals</h5>
                    <p class="card-text">25</p>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card text-white bg-info">
                <div class="card-body">
                    <h5 class="card-title">Total Feedback</h5>
                    <p class="card-text">300</p>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card text-white bg-secondary">
                <div class="card-body">
                    <h5 class="card-title">New Users</h5>
                    <p class="card-text">120</p>
                </div>
            </div>
        </div>
    </div>

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3>Registered Accounts / User Purchases</h3>
        <div>
            <button class="btn btn-primary">Add New</button>
            <input type="text" class="form-control d-inline-block" placeholder="Search" style="width: 200px;">
            <select class="form-select d-inline-block" style="width: 150px;">
                <option>Sort By</option>
                <option>Name</option>
                <option>Date</option>
                <option>Status</option>
            </select>
        </div>
    </div>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Firstname</th>
                <th>Lastname</th>
                <th>Email</th>
                <th>ContactNumber</th>
                <th>Status</th>
                <th>Description</th>
                <th>Valid ID</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $idFilePath = htmlspecialchars($row['ValidID']);
                    $resumeFilePath = htmlspecialchars($row['Resume']);
                    $applicantID = htmlspecialchars($row['ApplicantID']);
                    echo "<tr id='row-{$applicantID}'>";
                    echo "<td>" . htmlspecialchars($row['Firstname']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['Lastname']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['Email']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['ContactNumber']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['Status']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['Description']) . "</td>";
                    echo "<td><img src='{$idFilePath}' alt='Valid ID' style='max-width: 100px; max-height: 100px;' onclick='showImageModal(this.src)' onerror=\"this.onerror=null; this.src='images/default_image.png'\"></td>";
                    echo "<td>
                        <a href='" . $resumeFilePath . "' class='btn btn-primary btn-sm' download>Download Resume</a>
                        <button class='btn btn-success btn-sm' onclick='approveApplication({$applicantID})'>Approve</button>
                        <button class='btn btn-warning btn-sm' onclick='declineApplication({$applicantID})'>Decline</button>
                        <button class='btn btn-danger btn-sm' onclick='deleteApplication({$applicantID})'>Delete</button>
                    </td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='8'>No records found</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>

<!-- Profile Update Modal -->
<div class="modal fade" id="profileModal" tabindex="-1" aria-labelledby="profileModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="profileModalLabel">My Profile</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="profile-sidebar">
                            <div class="profile" style="font-weight: 600">
                                <img src="<?php echo htmlspecialchars($Photos) ?: 'images/default_profile.png'; ?>" alt="Profile Image"> 
                                <p><?php echo htmlspecialchars($Firstname . ' ' . $Lastname); ?></p>
                                <p>+<?php echo htmlspecialchars($ContactNumber); ?></p>
                            </div>
                            <ul>
                                <li>Receipts</li>
                                <li>Registered</li>
                                <li>Reports</li>
                                <li>Help & Support</li>
                                <li><a href="logout.php">Logout</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <form action="updateP.php" method="post" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="firstName" class="form-label">First Name</label>
                                    <input type="text" class="form-control" id="firstName" name="FirstName" value="<?php echo htmlspecialchars($Firstname); ?>">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="middleName" class="form-label">Middle Name</label>
                                    <input type="text" class="form-control" id="middleName" name="MiddleName" value="<?php echo htmlspecialchars($Middlename); ?>">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="lastName" class="form-label">Last Name</label>
                                    <input type="text" class="form-control" id="lastName" name="LastName" value="<?php echo htmlspecialchars($Lastname); ?>">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="email" name="Email" value="<?php echo htmlspecialchars($Email); ?>">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="contactNumber" class="form-label">Contact Number</label>
                                    <input type="text" class="form-control" id="contactNumber" name="ContactNumber" value="<?php echo htmlspecialchars($ContactNumber); ?>">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="newPassword" class="form-label">New Password</label>
                                    <input type="password" class="form-control" id="newPassword" name="Password">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="province" class="form-label">Province</label>
                                    <input type="text" class="form-control" id="province" name="Province" value="<?php echo htmlspecialchars($Province); ?>">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="city" class="form-label">City</label>
                                    <input type="text" class="form-control" id="city" name="City" value="<?php echo htmlspecialchars($City); ?>">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="Sex" class="form-label">Select Gender</label>
                                    <select class="form-select" name="Gender">
                                        <option value="Male" <?php if($Gender == "Male") echo "selected"; ?>>Male</option>
                                        <option value="Female" <?php if($Gender == "Female") echo "selected"; ?>>Female</option>
                                        <option value="Others" <?php if($Gender == "Others") echo "selected"; ?>>Others</option>
                                    </select>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="barangay" class="form-label">Barangay</label>
                                    <input type="text" class="form-control" name="Barangay" value="<?php echo htmlspecialchars($Barangay); ?>">
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="street" class="form-label">Street</label>
                                <input type="text" class="form-control" id="street" name="Street" value="<?php echo htmlspecialchars($Street); ?>">
                            </div>
                            <div class="mb-3">
                                <label for="updateModal_profilePicture" class="form-label">Profile Picture</label>
                                <input type="file" class="form-control" id="updateModal_profilePicture" name="Photos" accept="image/*" onchange="updateModal_previewImage(event)">
                                <img id="updateModal_imagePreview" src="#" alt="Image Preview" style="display:none; margin-top: 10px; max-width: 100px;">
                            </div>
                            <div class="d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary">Save Changes</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Image Modal for Zoom -->
<div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-body text-center">
                <img id="imageModalSrc" src="" alt="Zoomed Image" class="img-fluid">
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // Sidebar toggle
    document.getElementById("sidebar-toggle").addEventListener("click", function() {
        document.getElementById("mySidebar").classList.toggle("expanded");
        document.getElementById("main-content").classList.toggle("shifted");
    });

    // Function to show the image in a modal
    function showImageModal(src) {
        document.getElementById('imageModalSrc').src = src;
        var imageModal = new bootstrap.Modal(document.getElementById('imageModal'));
        imageModal.show();
    }

     // Function to approve an application via AJAX
     function approveApplication(applicantID) {
            if (confirm('Are you sure you want to approve this application?')) {
                console.log('Approve function called for ApplicantID:', applicantID);
                var xhr = new XMLHttpRequest();
                xhr.open("POST", "approve_application.php", true);
                xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

                xhr.onreadystatechange = function () {
                    if (xhr.readyState == 4 && xhr.status == 200) {
                        console.log('Approve response:', xhr.responseText);
                        if (xhr.responseText.trim() === "success") {
                            alert('Application approved successfully!');
                            var row = document.getElementById('row-' + applicantID);
                            row.parentNode.removeChild(row);
                        } else {
                            alert('Error: ' + xhr.responseText);
                        }
                    }
                };

                xhr.send("ApplicantID=" + applicantID);
            }
        }

        // Function to decline an application via AJAX
        function declineApplication(applicantID) {
            if (confirm('Are you sure you want to decline this application?')) {
                console.log('Decline function called for ApplicantID:', applicantID);
                var xhr = new XMLHttpRequest();
                xhr.open("POST", "decline_application.php", true);
                xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

                xhr.onreadystatechange = function () {
                    if (xhr.readyState == 4 && xhr.status == 200) {
                        console.log('Decline response:', xhr.responseText);
                        var response = JSON.parse(xhr.responseText);

                        if (response.status === "success") {
                            alert('Application declined successfully!');
                            var row = document.getElementById('row-' + applicantID);
                            if (row) {
                                row.parentNode.removeChild(row);
                            }
                        } else {
                            alert('Error: ' + response.message);
                        }
                    }
                };

                xhr.send("ApplicantID=" + applicantID);
            }
        }

        // Function to delete an application via AJAX
        function deleteApplication(applicantID) {
            if (confirm('Are you sure you want to delete this application?')) {
                console.log('Delete function called for ApplicantID:', applicantID);
                var xhr = new XMLHttpRequest();
                xhr.open("POST", "delete_application.php", true);
                xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

                xhr.onreadystatechange = function () {
                    if (xhr.readyState == 4 && xhr.status == 200) {
                        console.log('Delete response:', xhr.responseText);
                        if (xhr.responseText.trim() === "success") {
                            alert('Application deleted successfully!');
                            var row = document.getElementById('row-' + applicantID);
                            if (row) {
                                row.parentNode.removeChild(row);
                            }
                        } else {
                            alert('Error: ' + xhr.responseText);
                        }
                    }
                };

                xhr.send("ApplicantID=" + applicantID);
            }
        }
    </script>
</body>
</html>

<?php
// Close database connection
$conn->close();
?>
