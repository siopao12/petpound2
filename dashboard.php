<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['PetownerID'])) {
    header("Location: landing.php");
    exit();
}

// Fetch user details from session variables safely
$FirstName = $_SESSION['FirstName'] ?? '';
$MiddleName = $_SESSION['MiddleName'] ?? '';
$LastName = $_SESSION['LastName'] ?? '';
$Gender = $_SESSION['Gender'] ?? '';
$ContactNumber = $_SESSION['ContactNumber'] ?? '';
$Email = $_SESSION['Email'] ?? '';
$Photos = $_SESSION['Photos'] ?? '';
$Province = $_SESSION['Province'] ?? '';
$Barangay = $_SESSION['Barangay'] ?? '';
$City = $_SESSION['City'] ?? '';
$Street = $_SESSION['Street'] ?? '';
$user_type = $_SESSION['user_type'] ?? '';

// Include the database configuration file
include('config.php');

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
    <title>User Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/dashboard.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-custom">
    <div class="container-fluid">
        <button class="menu-button" id="sidebar-toggle" type="button">&#9776;</button>
        <a class="navbar-brand" href="#">
            <img src="images/logo.png" width="30" height="30" class="d-inline-block align-top" alt="">
            PetPound
        </a>
        <ul class="navbar-nav ms-auto d-flex flex-row align-items-center">
            <li class="nav-item">
                <a class="nav-link p-2" href="#">
                    <i class="fa-solid fa-bell fa-1x"></i> <span class="d-none d-lg-inline">Notification</span>
                </a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle p-2" href="#" id="navbarDropdownLanguage" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fa-solid fa-globe fa-1x"></i> <span class="d-none d-lg-inline">Language</span>
                </a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownLanguage">
                    <li><a class="dropdown-item" href="#">English</a></li>
                    <li><a class="dropdown-item" href="#">Tagalog</a></li>
                    <li><a class="dropdown-item" href="#">Bisaya</a></li>
                </ul>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle p-2" href="#" id="navbarDropdownProfile" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <?php if (!empty($Photos)) : ?>
                        <img src="<?php echo htmlspecialchars($Photos); ?>" alt="User Photo" width="30" height="30">
                    <?php else : ?>
                        <img src="images/default_profile.png" alt="Profile" width="30" height="30">
                    <?php endif; ?>
                    <span class="d-none d-lg-inline"><?php echo htmlspecialchars($FirstName); ?></span>
                </a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownProfile">
                    <!-- Dropdown content remains unchanged -->
                    <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#profileModal">Profile</a></li>

                    <?php if ($_SESSION['user_type'] !== 'admin') : ?>
                    <!-- Non-admin user options -->
                    <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#applyAnimalOfficerModal">Apply Animal Control Officer</a></li>
                    <li><a class="dropdown-item" href="#">Apply Veterinarian Position</a></li>
                    <?php else : ?>
                    <!-- Admin user options -->
                    <li class="admin-link"><a class="dropdown-item" href="users.php">Admin Dashboard</a></li>
                    <li class="admin-link"><a class="dropdown-item" href="manage_users.php">Manage Users</a></li>
                    <?php endif; ?>

                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                </ul>
            </li>
        </ul>
    </div>
</nav>

<!-- Sidebar -->
<div id="mySidebar" class="sidebar">
    <div class="profile-sidebarmain">
        <a href="#" class="active"><i class="fa-solid fa-tachometer-alt fa-lg"></i> <span>Dashboard</span></a>
        <a href="#"><i class="fa-solid fa-book fa-lg"></i> <span>Resources</span></a>
        <a href="#"><i class="fa-solid fa-dog fa-lg"></i> <span>Pet Register</span></a>
        
        <!-- VetClinic with integrated dropdown -->
        <a href="#vetClinicSubmenu" class="dropdown-toggle" data-bs-toggle="collapse" aria-expanded="false">
            <i class="fa-solid fa-stethoscope fa-lg"></i> <span>VetClinic</span>
        </a>
        <ul class="collapse list-unstyled" id="vetClinicSubmenu">
            <li><a class="dropdown-item" href="#">Clinic Information</a></li>
            <li><a class="dropdown-item" href="#">Appointments</a></li>
            <li><a class="dropdown-item" href="#">Veterinarians</a></li>
            <li><a class="dropdown-item" href="#">Services</a></li>
        </ul>
        <a href="#"><i class="fa-solid fa-file-alt fa-lg"></i> <span>Report</span></a>                   
        <!-- Manage Account with dropdown -->
        <a href="#manageAccountSubmenu" class="dropdown-toggle" data-bs-toggle="collapse" aria-expanded="false">
            <i class="fa-solid fa-user fa-lg"></i> <span>Manage Account</span>
        </a>
        <ul class="collapse list-unstyled" id="manageAccountSubmenu">
            <li><a class="dropdown-item" href="#">Transaction History</a></li>
            <li><a class="dropdown-item" href="#">Registered History</a></li>
            <li><a class="dropdown-item" href="#">Report History</a></li>
        </ul>
        
    </div>
</div>

<!-- Main Content -->
<div class="container-fluid mt-4 main-content" id="main-content">
    <div class="row d-flex align-items-center mb-3">
        <div class="col-12 col-md-6">
            <h4 class="mb-2">Available pets in the Impound:</h4>
        </div>
        <div class="col-12 col-md-6 d-flex justify-content-end">
            <form class="d-flex search-form w-100">
                <div class="input-group me-2">
                    <span class="input-group-text"><i class="fa-solid fa-magnifying-glass"></i></span>
                    <input class="form-control" type="search" placeholder="Search" aria-label="Search">
                </div>
                <div class="dropdown">
                    <a class="btn btn-secondary" href="#" role="button" id="sortByDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fa-solid fa-filter"></i> <!-- Font Awesome icon -->
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="sortByDropdown">
                        <li><a class="dropdown-item" href="#">Dog</a></li>
                        <li><a class="dropdown-item" href="#">Cat</a></li>
                        <li><a class="dropdown-item" href="#">Bird</a></li>
                        <li><a class="dropdown-item" href="#">Others</a></li>
                    </ul>
                </div>
            </form>
        </div>
    </div>

    <div class="row card-container">
        <?php if (!empty($animals)) : ?>
            <?php foreach ($animals as $animal) : ?>
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <img src="<?php echo 'uploads/animals/' . htmlspecialchars($animal['AnimalImage']); ?>" class="card-img-top" alt="<?php echo htmlspecialchars($animal['AnimalName']); ?>">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo htmlspecialchars($animal['AnimalName']); ?></h5>
                            <p class="card-text"><?php echo htmlspecialchars($animal['Description']); ?></p>
                            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#detailsModal<?php echo htmlspecialchars($animal['ImpoundID']); ?>">More Details</button>
                        </div>
                    </div>
                </div>

                <!-- Details Modal -->
                <div class="modal fade" id="detailsModal<?php echo htmlspecialchars($animal['ImpoundID']); ?>" tabindex="-1" aria-labelledby="detailsModalLabel<?php echo htmlspecialchars($animal['ImpoundID']); ?>" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="detailsModalLabel<?php echo htmlspecialchars($animal['ImpoundID']); ?>"><?php echo htmlspecialchars($animal['AnimalName']); ?> - Details</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <img src="<?php echo 'uploads/animals/' . htmlspecialchars($animal['AnimalImage']); ?>" class="img-fluid" alt="<?php echo htmlspecialchars($animal['AnimalName']); ?>">
                                    </div>
                                    <div class="col-md-6">
                                        <p><strong>Gender:</strong> <?php echo htmlspecialchars($animal['Gender']); ?></p>
                                        <p><strong>Color:</strong> <?php echo htmlspecialchars($animal['AnimalColor']); ?></p>
                                        <p><strong>Date Caught:</strong> <?php echo htmlspecialchars($animal['DateCaught']); ?></p>
                                        <p><strong>Time Caught:</strong> <?php echo htmlspecialchars($animal['TimeCaught']); ?></p>
                                        <p><strong>Location Caught:</strong> <?php echo htmlspecialchars($animal['LocationCaught']); ?></p>
                                        <p><strong>Holding Start Date:</strong> <?php echo htmlspecialchars($animal['HoldingStartDate']); ?></p>
                                        <p><strong>Holding End Date:</strong> <?php echo htmlspecialchars($animal['HoldingEndDate']); ?></p>
                                        <p><strong>Holding Status:</strong> <?php echo htmlspecialchars($animal['HoldingStatus']); ?></p>
                                        <p><strong>Holding Reason:</strong> <?php echo htmlspecialchars($animal['HoldingReason']); ?></p>
                                        <p><strong>Holding Fee:</strong> <?php echo htmlspecialchars($animal['HoldingFee']); ?></p>
                                        <p><strong>Description:</strong> <?php echo htmlspecialchars($animal['Description']); ?></p>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <a href="claim.php?ImpoundID=<?php echo htmlspecialchars($animal['ImpoundID']); ?>" class="btn btn-success" style="background-color:#FF5722;">Claim</a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else : ?>
            <p>No animals available in the impound at the moment.</p>
        <?php endif; ?>
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
                                <p><?php echo htmlspecialchars($FirstName . ' ' . $LastName); ?></p>
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
                                    <input type="text" class="form-control" id="firstName" name="FirstName" value="<?php echo htmlspecialchars($FirstName); ?>">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="middleName" class="form-label">Middle Name</label>
                                    <input type="text" class="form-control" id="middleName" name="MiddleName" value="<?php echo htmlspecialchars($MiddleName); ?>">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="lastName" class="form-label">Last Name</label>
                                    <input type="text" class="form-control" id="lastName" name="LastName" value="<?php echo htmlspecialchars($LastName); ?>">
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

<!-- Apply Animal Control Officer Modal -->
<div class="modal fade" id="applyAnimalOfficerModal" tabindex="-1" aria-labelledby="applyAnimalOfficerModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="applyAnimalOfficerModalLabel">Apply Animal Control Officer</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="applyAnimalOfficerForm" action="applicants.php" method="post" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="applyFirstName" class="form-label">First Name</label>
                            <input type="text" class="form-control" id="applyFirstName" name="Firstname" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="applyLastName" class="form-label">Last Name</label>
                            <input type="text" class="form-control" id="applyLastName" name="Lastname" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="applyEmail" class="form-label">Email</label>
                            <input type="email" class="form-control" id="applyEmail" name="Email" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="applyContactNumber" class="form-label">Contact Number</label>
                            <input type="text" class="form-control" id="applyContactNumber" name="ContactNumber" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="applyID" class="form-label">Upload ID</label>
                        <input type="file" class="form-control" id="applyID" name="ID" accept="image/*,application/pdf" required>
                    </div>
                    <div class="mb-3">
                        <label for="applyResume" class="form-label">Upload Resume</label>
                        <input type="file" class="form-control" id="applyResume" name="Resume" accept="application/pdf" required>
                    </div>
                    <div class="mb-3">
                        <label for="applyDescription" class="form-label">Description</label>
                        <textarea class="form-control" id="applyDescription" name="Description" rows="3"></textarea>
                    </div>
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary">Submit Application</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
// Sidebar toggle
document.getElementById("sidebar-toggle").addEventListener("click", function() {
    document.getElementById("mySidebar").classList.toggle("show");
    
    

    // Apply shifting only on screens larger than 768px
    if (window.innerWidth > 768) {
        document.getElementById("mySidebar").classList.toggle("expanded");
        document.getElementById("main-content").classList.toggle("shifted");
    }
    document.querySelectorAll('.sidebar a').forEach(link => {
    link.addEventListener('click', function() {
        // Toggle the show-text class to display the text when icon is clicked
        this.closest('.sidebar').classList.toggle('show-text');
    });
});
});


    // Profile picture preview
    function updateModal_previewImage(event) {
        var reader = new FileReader();
        reader.onload = function(){
            var output = document.getElementById('updateModal_imagePreview');
            output.src = reader.result;
            output.style.display = 'block';
        };
        reader.readAsDataURL(event.target.files[0]);
    }
    
    // Function to update the dropdown menu based on the user_type
    function updateDropdownMenu(user_type) {
        const adminLinks = document.querySelectorAll('.admin-link');
        if (user_type !== 'admin') {
            adminLinks.forEach(link => {
                link.style.display = 'none'; // Hide admin options if user is not an admin
            });
        }
    }
    
    function filterAnimals(type) {
        const cards = document.querySelectorAll('.animal-card');
        cards.forEach(card => {
            const animalType = card.getAttribute('data-animal-type');
            if (animalType === type || type === 'Others' && (animalType !== 'Dog' && animalType !== 'Cat' && animalType !== 'Bird')) {
                card.style.display = 'block';
            } else {
                card.style.display = 'none';
            }
        });
    }
</script>
</body>
</html>