<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fixed Sidebar Example</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/5.1.3/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-custom">
        <div class="container-fluid">
            <button class="menu-button" id="sidebar-toggle" type="button">&#9776;</button>
            <a class="navbar-brand" href="#">
                <img src="images/logo.png" width="30" height="30" class="d-inline-block align-top" alt="">
                PetPound
            </a>
            <button class="navbar-toggler custom-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="custom-toggler-icon">&#9660;</span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Services</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Pricing</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link disabled" aria-disabled="true">Disabled</a>
                    </li>
                </ul>
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item dropdown">
                        <a class="nav-link" href="#"><img src="images/notification.png" width="30" height="30" alt="Notif">Notification</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownLanguage" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="images/languages.png" width="30" height="30" alt="Language">Language
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
                            <?php echo htmlspecialchars($FirstName); ?>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownProfile">
                            <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#profileModal">Profile</a></li>
                            <li><a class="dropdown-item" href="#">Add Pets</a></li>
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

    <!-- Main Content -->
    <div class="main-content">
        <p>Your main content goes here.</p>
        <p>Scroll to see the sidebar staying in place.</p>
        <p>More content...</p>
        <p>Even more content...</p>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.min.js"></script>
    <script>
        // JavaScript for toggling the sidebar
        document.getElementById('sidebar-toggle').onclick = function() {
            document.getElementById('mySidebar').classList.toggle('expanded');
        };
    </script>
    <style>
        body {
    font-family: Arial, sans-serif;
    overflow-x: hidden; /* Prevent horizontal overflow */
}

.navbar-custom {
    background-color: #FF5722;
    z-index: 1000; /* Ensure navbar is above other content */
    position: fixed;
    width: 100%;
    top: 0;
    left: 0;
}

.navbar-custom .navbar-brand {
    color: white;
    font-weight: bold;
}

.navbar-custom .navbar-nav .nav-link {
    color: white;
}

.navbar-custom .form-control {
    border-radius: 10px;
}

.navbar-custom .nav-item img {
    border-radius: 50%;
    width: 30px;
    height: 30px;
    object-fit: cover;
}

.navbar-custom .menu-button {
    color: white;
    background-color: transparent;
    border: none;
    font-size: 24px;
    margin-right: 10px;
}

/* Navbar */
.nav-link {
    position: relative;
    text-decoration: none; /* Removes the default underline */
    color: inherit; /* Keeps the original color */
    color: white;
}

.nav-link:hover::after {
    content: '';
    position: absolute;
    width: 100%;
    height: 2px;
    background-color: white;
    left: 0;
    bottom: -2px; /* Adjust as needed */
    transition: width 0.3s;
}

.nav-link:hover {
    color: white; /* Changes the text color to white on hover */
}

.nav-item {
    margin-right: 15px; /* Adjust the value as needed */
    margin-left: 10px;
}

.search-form {
    width: 30%;
}

@media (max-width: 400px) {
    .search-form {
        width: auto;
        max-width: none;
    }
}

/* Sidebar Styles */
.sidebar {
    position: fixed;
    top: 56px; /* Adjust this to the height of your navbar */
    height: calc(100vh - 56px); /* Full height minus navbar height */
    width: 60px; /* Initial width for icons only */
    left: 0;
    background-color: #fff;
    transition: width 0.3s;
    overflow-x: hidden;
    white-space: nowrap;
    z-index: 999; /* Ensure sidebar is above other content */
}

.sidebar.expanded {
    width: 250px; /* Expanded width */
}

.sidebar a {
    padding: 15px;
    text-align: left;
    font-size: 18px;
    display: block;
    color: #000;
    text-decoration: none;
    transition: 0.3s;
}

.sidebar a i {
    min-width: 20px;
    margin-right: 10px;
}

.sidebar a span {
    display: none; /* Hide text initially */
}

.sidebar.expanded a span {
    display: inline; /* Show text when expanded */
}

.sidebar a:hover {
    background-color: #f1f1f1;
}

.sidebar .active {
    background-color: #e7f3f9;
}

.main-content {
    margin-left: 60px; /* Adjust to the initial width of the sidebar */
    padding: 20px;
    margin-top: 56px; /* Adjust to the height of the navbar */
}

.sidebar.expanded + .main-content {
    margin-left: 250px; /* Adjust to the expanded width of the sidebar */
}

    </style>
</body>
</html>
