<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['PetownerID'])) {
    header("Location: users.php");
    exit();
}

// Include the database configuration file
include('config.php');

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
$user_type = $_SESSION['user_type'] ?? '';

// Check if the user is an admin
if ($user_type !== 'admin') {
    echo "You do not have permission to access this page.";
    exit();
}

// Fetch animals from the database
$query = "SELECT ImpoundID, AnimalName, Gender, AnimalColor, DateCaught, TimeCaught, LocationCaught, HoldingStartDate, HoldingEndDate, HoldingStatus, HoldingReason, HoldingFee, AnimalImage, Description FROM animalimpound";
$stmt = $conn->prepare($query);

// Check if the statement was prepared successfully
if (!$stmt) {
    die("Query preparation failed: " . $conn->error);
}

$stmt->execute();
$result = $stmt->get_result();
$animals = $result->fetch_all(MYSQLI_ASSOC);
$stmt->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/users.css">
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
                        <li><a class="dropdown-item" href="logout.php">Logout</a></li>
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
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3>Registered Animals</h3>
        <div>
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addAnimalModal">Add Animals</button>
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
                <th>ImpoundID</th>
                <th>Animal Name</th>
                <th>Gender</th>
                <th>Animal Color</th>
                <th>Date Caught</th>
                <th>Time Caught</th>
                <th>Location Caught</th>
                <th>Holding Start Date</th>
                <th>Holding End Date</th>
                <th>Holding Status</th>
                <th>Holding Reason</th>
                <th>Holding Fee</th>
                <th>Animal Image</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($animals)) : ?>
                <?php foreach ($animals as $animal) : ?>
                    <tr>
                        <td><?php echo htmlspecialchars($animal['ImpoundID']); ?></td>
                        <td><?php echo htmlspecialchars($animal['AnimalName']); ?></td>
                        <td><?php echo htmlspecialchars($animal['Gender']); ?></td>
                        <td><?php echo htmlspecialchars($animal['AnimalColor']); ?></td>
                        <td><?php echo htmlspecialchars($animal['DateCaught']); ?></td>
                        <td><?php echo htmlspecialchars($animal['TimeCaught']); ?></td>
                        <td><?php echo htmlspecialchars($animal['LocationCaught']); ?></td>
                        <td><?php echo htmlspecialchars($animal['HoldingStartDate']); ?></td>
                        <td><?php echo htmlspecialchars($animal['HoldingEndDate']); ?></td>
                        <td><?php echo htmlspecialchars($animal['HoldingStatus']); ?></td>
                        <td><?php echo htmlspecialchars($animal['HoldingReason']); ?></td>
                        <td><?php echo htmlspecialchars($animal['HoldingFee']); ?></td>
                        <td>
                            <img src="<?php echo 'uploads/animals/' . htmlspecialchars($animal['AnimalImage']); ?>" alt="Animal Image" width="50" height="50" onclick="showImageModal('<?php echo 'uploads/animals/' . htmlspecialchars($animal['AnimalImage']); ?>')">
                        </td>
                        <td>
                        <button class="btn btn-warning btn-sm" onclick="openEditModal(<?php echo htmlspecialchars(json_encode($animal)); ?>)">Edit</button>
                        <form action="addanimal.php" method="POST" style="display:inline;">
                            <input type="hidden" name="action" value="delete">
                            <input type="hidden" name="ImpoundID" value="<?php echo $animal['ImpoundID']; ?>">
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this animal?')">Delete</button>
                        </form>
                    </td>
                    </tr>
                <?php endforeach; ?>
            <?php else : ?>
                <tr><td colspan="14">No animals registered yet.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<!-- Add Animal Modal -->
<div class="modal fade" id="addAnimalModal" tabindex="-1" aria-labelledby="addAnimalModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addAnimalModalLabel">Add New Animal</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="addanimal.php" method="post" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="animalName" class="form-label">Animal Name</label>
                            <input type="text" class="form-control" id="animalName" name="AnimalName" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="animalGender" class="form-label">Gender</label>
                            <select class="form-select" id="animalGender" name="Gender" required>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                                <option value="Unknown">Unknown</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="animalColor" class="form-label">Animal Color</label>
                            <input type="text" class="form-control" id="animalColor" name="AnimalColor" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="dateCaught" class="form-label">Date Caught</label>
                            <input type="date" class="form-control" id="dateCaught" name="DateCaught" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="timeCaught" class="form-label">Time Caught</label>
                            <input type="time" class="form-control" id="timeCaught" name="TimeCaught" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="locationCaught" class="form-label">Location Caught</label>
                            <input type="text" class="form-control" id="locationCaught" name="LocationCaught" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="holdingStartDate" class="form-label">Holding Start Date</label>
                            <input type="date" class="form-control" id="holdingStartDate" name="HoldingStartDate" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="holdingEndDate" class="form-label">Holding End Date</label>
                            <input type="date" class="form-control" id="holdingEndDate" name="HoldingEndDate" value="" readonly>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="holdingStatus" class="form-label">Holding Status</label>
                            <input type="text" class="form-control" id="holdingStatus" name="HoldingStatus" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="holdingReason" class="form-label">Holding Reason</label>
                            <input type="text" class="form-control" id="holdingReason" name="HoldingReason" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="holdingFee" class="form-label">Holding Fee</label>
                            <input type="number" step="0.01" class="form-control" id="holdingFee" name="HoldingFee" value="" readonly>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="animalImage" class="form-label">Upload Image of Animal</label>
                            <input type="file" class="form-control" id="animalImage" name="AnimalImage" accept="image/*" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control" id="description" name="Description" rows="4" placeholder="Enter a brief description of the animal..." required></textarea>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary">Add Animal</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<!-- Edit Animal Modal -->
<div class="modal fade" id="editAnimalModal" tabindex="-1" aria-labelledby="editAnimalModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editAnimalModalLabel">Edit Animal Information</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="addanimal.php" method="post" enctype="multipart/form-data">
                    <input type="hidden" id="editImpoundID" name="ImpoundID">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="editAnimalName" class="form-label">Animal Name</label>
                            <input type="text" class="form-control" id="editAnimalName" name="AnimalName" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="editAnimalGender" class="form-label">Gender</label>
                            <select class="form-select" id="editAnimalGender" name="Gender" required>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                                <option value="Unknown">Unknown</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="editAnimalColor" class="form-label">Animal Color</label>
                            <input type="text" class="form-control" id="editAnimalColor" name="AnimalColor" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="editDateCaught" class="form-label">Date Caught</label>
                            <input type="date" class="form-control" id="editDateCaught" name="DateCaught" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="editTimeCaught" class="form-label">Time Caught</label>
                            <input type="time" class="form-control" id="editTimeCaught" name="TimeCaught" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="editLocationCaught" class="form-label">Location Caught</label>
                            <input type="text" class="form-control" id="editLocationCaught" name="LocationCaught" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="editHoldingStartDate" class="form-label">Holding Start Date</label>
                            <input type="date" class="form-control" id="editHoldingStartDate" name="HoldingStartDate" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="editHoldingEndDate" class="form-label">Holding End Date</label>
                            <input type="date" class="form-control" id="editHoldingEndDate" name="HoldingEndDate" readonly>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="editHoldingStatus" class="form-label">Holding Status</label>
                            <input type="text" class="form-control" id="editHoldingStatus" name="HoldingStatus" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="editHoldingReason" class="form-label">Holding Reason</label>
                            <input type="text" class="form-control" id="editHoldingReason" name="HoldingReason" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="editHoldingFee" class="form-label">Holding Fee</label>
                            <input type="number" step="0.01" class="form-control" id="editHoldingFee" name="HoldingFee" readonly>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="editAnimalImage" class="form-label">Upload New Image of Animal</label>
                            <input type="file" class="form-control" id="editAnimalImage" name="AnimalImage" accept="image/*">
                            <img id="editImagePreview" src="#" alt="Image Preview" style="display:none; margin-top: 10px; max-width: 100px;">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 mb-3">
                            <label for="editDescription" class="form-label">Description</label>
                            <textarea class="form-control" id="editDescription" name="Description" rows="4" placeholder="Enter a brief description of the animal..." required></textarea>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
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
                                <div class="col-md6 mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="email" name="Email" value="<?php echo htmlspecialchars($Email); ?>">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="contactNumber" class="form-label">Contact Number</label>
                                    <input type="text" class="form-control" id="contactNumber" name="ContactNumber" value="<?php echo htmlspecialchars($ContactNumber); ?>">
                                </div>
                                <div class="col-md6 mb-3">
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

    // Automatically set HoldingEndDate and calculate HoldingFee
    document.getElementById('holdingStartDate').addEventListener('change', function() {
        var startDate = new Date(this.value);
        var endDate = new Date(startDate);
        endDate.setDate(startDate.getDate() + 3); // HoldingEndDate is 3 days after start date

        var currentDate = new Date();
        var holdingFee = 0;

        if (currentDate <= endDate) {
            var timeDiff = currentDate.getTime() - startDate.getTime();
            var daysHeld = Math.floor(timeDiff / (1000 * 3600 * 24)) + 1; // Add 1 to count the first day
            holdingFee = daysHeld * 500;
        } else {
            var timeDiff = endDate.getTime() - startDate.getTime();
            var daysHeld = Math.floor(timeDiff / (1000 * 3600 * 24)) + 1; // Add 1 to count the first day
            holdingFee = daysHeld * 500;
        }

        document.getElementById('holdingEndDate').value = endDate.toISOString().split('T')[0];
        document.getElementById('holdingFee').value = holdingFee;
    });

    // Preview image before upload
    function updateModal_previewImage(event) {
        var reader = new FileReader();
        reader.onload = function(){
            var output = document.getElementById('updateModal_imagePreview');
            output.src = reader.result;
            output.style.display = 'block';
        };
        reader.readAsDataURL(event.target.files[0]);
    }

    // Show image in modal
    function showImageModal(src) {
        document.getElementById('imageModalSrc').src = src;
        var imageModal = new bootstrap.Modal(document.getElementById('imageModal'));
        imageModal.show();
    }

    // Open edit modal and populate fields
    function openEditModal(animal) {
        document.getElementById('editImpoundID').value = animal.ImpoundID;
        document.getElementById('editAnimalName').value = animal.AnimalName;
        document.getElementById('editAnimalGender').value = animal.Gender;
        document.getElementById('editAnimalColor').value = animal.AnimalColor;
        document.getElementById('editDateCaught').value = animal.DateCaught;
        document.getElementById('editTimeCaught').value = animal.TimeCaught;
        document.getElementById('editLocationCaught').value = animal.LocationCaught;
        document.getElementById('editHoldingStartDate').value = animal.HoldingStartDate;
        document.getElementById('editHoldingEndDate').value = animal.HoldingEndDate;
        document.getElementById('editHoldingStatus').value = animal.HoldingStatus;
        document.getElementById('editHoldingReason').value = animal.HoldingReason;

        var startDate = new Date(animal.HoldingStartDate);
        var endDate = new Date(animal.HoldingEndDate);
        var currentDate = new Date();
        var holdingFee = 0;

        if (currentDate <= endDate) {
            var timeDiff = currentDate.getTime() - startDate.getTime();
            var daysHeld = Math.floor(timeDiff / (1000 * 3600 * 24)) + 1; // Add 1 to count the first day
            holdingFee = daysHeld * 500;
        } else {
            var timeDiff = endDate.getTime() - startDate.getTime();
            var daysHeld = Math.floor(timeDiff / (1000 * 3600 * 24)) + 1; // Add 1 to count the first day
            holdingFee = daysHeld * 500;
        }

        document.getElementById('editHoldingFee').value = holdingFee;

        // Set the image preview
        document.getElementById('editImagePreview').src = 'uploads/animals/' + animal.AnimalImage;
        document.getElementById('editImagePreview').style.display = 'block';

        var editModal = new bootstrap.Modal(document.getElementById('editAnimalModal'));
        editModal.show();
    }
</script>
</body>
</html>

<?php
// Close database connection
$conn->close();
?>
