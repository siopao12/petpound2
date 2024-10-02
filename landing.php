<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pet Impound Service</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="css/landing.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
<header>
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <img src="images/logo.png" alt="Pet Impound Logo" style="height: 40px;">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Service</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Impound</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Vet portal</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">About us</a>
                    </li>
                </ul>
                <button class="btn btn-primary ms-auto" data-bs-target="#exampleModalToggle" data-bs-toggle="modal">Register</button>
            </div>
        </div>
    </nav>
</header>


    <main>
        <section class="intro">
            <h1>Be a responsible owner claim your pets now and keep them safe!</h1>
            <p>Ensuring pet safety and well-being through responsible impoundment procedures.</p>
        </section>

        <section class="services">
            <div class="service">
                <img src="images/catsdog.jpg" alt="Register Pet">
                <div class="service-content">
                    <h2>REGISTER PET</h2>
                    <p>Setup your contact info on your QR code or ID tag. If your pet get lost, the finder can scan and return to you!</p>
                    <a href="#" class="btn" data-bs-target="#exampleModalToggle" data-bs-toggle="modal">Enter Here</a>
                </div>
            </div>
            <div class="service">
                <img src="images/petvet.jpg" alt="Vet Portal">
                <div class="service-content">
                    <h2>VET PORTAL</h2>
                    <p>If your pet has not received a rabies vaccination, you can get it here at the trusted veterinarian's clinic.</p>
                    <a href="#" class="btn" data-bs-target="#exampleModalToggle" data-bs-toggle="modal">Enter Here</a>
                </div>
            </div>
            <div class="service">
                <img src="images/impound.jpg" alt="Pet Impound">
                <div class="service-content">
                    <h2>PET IMPOUND</h2>
                    <p>If your pet is lost, you can check here to see if it has been brought to the impound facility.</p>
                    <a href="#" class="btn" data-bs-target="#exampleModalToggle" data-bs-toggle="modal">Enter Here</a>
                </div>
            </div>
        </section>

        <section class="report-section">
            <div class="report-image">
                <img src="images/lost.png" alt="Report lost and found pet">
                <div class="report-content">
                    <h2>REPORT LOST AND FOUND PET</h2>
                    <p>If your pet is lost, you can report it here and check if it has been found. If you find a pet that has a QR code or ID tags you can scan or input here to contact the owner. If not, you can file a report for a lost pet or found pet.</p>
                    <a href="#" class="btn" data-bs-target="#exampleModalToggle" data-bs-toggle="modal">Enter Here</a>
                </div>
            </div>
        </section>

        <section class="steps">
            <div class="step">
                <img src="images/qrcode.jpg" alt="Step 1: Register Tag">
                <h3>Step 1: Register Tag</h3>
                <p>Register your pet at Petpound to obtain tags. The registration fee is 500 pesos, which includes proof of ownership. Along with the QR code, ID tags, and dog collar. But if your pet is not received vaccination you can go to vet portal to get your rabies vaccination.</p>
            </div>
            <div class="step">
                <img src="images/dog.png" alt="Step 2: Lost Pet">
                <h3>Step 2: Lost Pet</h3>
                <p>If your Pet gets lost along his tag and your contact info, be sure your info is up to date so you can be contacted. Also if your pet is lost and not yet registered you can file a report in this app.</p>
            </div>
            <div class="step">
                <img src="images/cellphone.png" alt="Step 3: Finder Scans">
                <h3>Step 3: Finder Scans</h3>
                <p>These tags mean you'll get less phone calls about lost pets! The tag can be scanned by the finder and the owner can be contacted directly. The person that finds pets without a tag can also report it.</p>
            </div>
            <div class="step">
                <img src="images/pet.png" alt="Step 4: Pet Returned">
                <h3>Step 4: Pet Returned</h3>
                <p>Reunite with your pet without posting on social media! The finder can directly scan the QR code and contact the owner through the Petpound system.</p>
            </div>
        </section>

        <!-- First Modal-->
        <div class="modal fade" id="exampleModalToggle" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalToggleLabel">Sign Up</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="container">
                            <form action="login.php" method="post" class="signup-form" id="signupForm">
                                <div class="input-group mb-3">
                                    <input type="email" class="form-control" name="Email" id="email" placeholder="Email Address" required>
                                </div>
                                <div class="input-group mb-3 position-relative">
                                    <input type="password" class="form-control" name="Password" id="loginPassword" placeholder="Password" required>
                                    <span class="position-absolute top-50 end-0 translate-middle-y me-3">
                                        <i class="fa-solid fa-eye-slash" id="toggleLoginPassword" style="cursor: pointer;"></i>
                                    </span>
                                </div>
                                <div class="options d-flex justify-content-between align-items-center mb-3">
                                    <label class="form-check-label">
                                        <input type="checkbox" class="form-check-input"> Remember me
                                    </label>
                                    <a href="#" class="forgot-password">Forget Password?</a>
                                </div>
                                <button type="submit" class="btn btn-primary w-100">LOGIN</button>
                                <p class="create-account text-center mt-3" data-bs-target="#exampleModalToggle2" data-bs-toggle="modal">Don’t have an account? <a href="#">Create account</a></p>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

<!-- Registration Modal -->
<div class="modal fade" id="exampleModalToggle2" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="padding: 15px;">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalToggleLabel2">Create Account</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="registration.php" method="post" class="create-account-form">
                    <div class="row">
                        <div class="col-md-6 col-12 mb-3">
                            <input type="text" class="form-control" name="FirstName" placeholder="First Name" required>
                        </div>
                        <div class="col-md-6 col-12 mb-3">
                            <input type="text" class="form-control" name="Middlename" placeholder="Middle Name" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-12 mb-3">
                            <input type="text" class="form-control" name="LastName" placeholder="Last Name" required>
                        </div>
                        <div class="col-md-6 col-12 mb-3">
                            <select class="form-select" name="Gender" required>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                                <option value="Others">Others</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-12 mb-3">
                            <input type="email" class="form-control" name="Email" placeholder="Email" required>
                        </div>
                        <div class="col-md-6 col-12 mb-3 position-relative">
                            <input type="password" class="form-control" name="Password" id="registerPassword" placeholder="Password" required>
                            <span class="position-absolute top-50 end-0 translate-middle-y me-3">
                                <i class="fa-solid fa-eye-slash fa-sm" id="toggleRegisterPassword" style="cursor: pointer;"></i>
                            </span>
                        </div>
                    </div>
                    <h4>Address</h4>
                    <div class="row">
                        <div class="col-md-6 col-12 mb-3">
                            <select class="form-control" id="province" name="Province" required>
                                <option value="">Select Province</option>
                            </select>
                        </div>
                        <div class="col-md-6 col-12 mb-3">
                            <select class="form-control" id="city" name="City" required>
                                <option value="">Select City</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-12 mb-3">
                            <select class="form-control" id="barangay" name="Barangay" required>
                                <option value="">Select Barangay</option>
                            </select>
                        </div>
                        <div class="col-md-6 col-12 mb-3">
                            <input type="text" class="form-control" name="Contactnumber" placeholder="Contact Number" required>
                        </div>
                    </div>
                    <div class="form-row mb-3">
                        <input type="text" class="form-control" name="Street" placeholder="Street" required>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Create Account</button>
                </form>
                <p class="text-center mt-3">Already have an account? <a href="#" data-bs-target="#exampleModalToggle" data-bs-toggle="modal">Login</a></p>
            </div>
        </div>
    </div>
</div>

    </main>

    <footer>
        <p>&copy; 2024 Pet Impound Service. All rights reserved.</p>
    </footer>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/scriptl.js"></script>
</body>
</html>