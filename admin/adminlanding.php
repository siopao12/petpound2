<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <title>PetPound Plus Sign Up</title>
    <link rel="stylesheet" href="css/admin.css">
</head>
<body>
    <div class="container d-flex align-items-center justify-content-center">
        <div class="login-container d-flex">
            <div class="left">
                <img src="images/logos.png" alt="PetPound Plus Logo">
                <p>Safeguarding Pets,<br>Strengthening Communities</p>
            </div>
            <div class="right">
                <h2>Sign up</h2>
                <form action="adminlogin.php" method="post" class="signup-form" id="signupForm">
                    <div class="input-group mb-3">
                        <input type="email" class="form-control" name="Email" id="email" placeholder="Email Address" required>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control" name="Password" id="loginPassword" placeholder="Password" required>
                    </div>
                    <div class="form-check mb-3 d-flex justify-content-between align-items-center">
                        <div>
                            <input type="checkbox" class="form-check-input" id="rememberMe">
                            <label class="form-check-label" for="rememberMe">Remember me</label>
                        </div>
                        <a href="#" class="forgot-password">Forget Password?</a>
                    </div>
                    <button type="submit" class="btn btn-login">LOGIN</button>
                    <div class="sign-up-link">
                        Don't have an account? <a href="#" data-bs-toggle="modal" data-bs-target="#exampleModalToggle2">Create account</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Registration Modal -->
    <div class="modal fade" id="exampleModalToggle2" aria-hidden="true" aria-labelledby="exampleModalToggleLabel2" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered" style="max-width: 600px">
            <div class="modal-content" style="padding: 15px">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalToggleLabel2">Create Account</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <form action="adminregistration.php" method="post" class="create-account-form">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <input type="text" class="form-control" name="Firstname" placeholder="First Name" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <input type="text" class="form-control" name="Middlename" placeholder="Middle Name" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <input type="text" class="form-control" name="Lastname" placeholder="Last Name">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <select class="form-select" name="Gender" required>
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                        <option value="Others">Others</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <input type="text" class="form-control" name="Email" placeholder="Email" required>
                                </div>
                                <div class="col-md-6 mb-3 position-relative">
                                    <input type="password" class="form-control" name="Password" id="registerPassword" placeholder="Password" required>
                                    <span class="position-absolute top-50 end-0 translate-middle-y me-3">
                                        <i class="fa-solid fa-eye-slash fa-sm" id="toggleRegisterPassword" style="cursor: pointer;"></i>
                                    </span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <input type="text" class="form-control" name="Username" placeholder="Username" required>
                                </div>
                                <div class="col-md-6 mb-3 position-relative">
                                    <input type="password" class="form-control" name="confirmPassword" id="confirmPassword" placeholder="Confirm Password" required>
                                    <span class="position-absolute top-50 end-0 translate-middle-y me-3">
                                        <i class="fa-solid fa-eye-slash fa-sm" id="toggleRegisterPassword" style="cursor: pointer;"></i>
                                    </span>
                                </div>
                            </div>
                            <h4>Shelter Address</h4>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <select class="form-control" id="province" name="Province" required>
                                        <option value="">Select Province</option>
                                        <!-- Provinces will be added here dynamically -->
                                    </select>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <select class="form-control" id="city" name="City" required>
                                        <option value="">Select City</option>
                                        <!-- Cities will be added here dynamically -->
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <select class="form-control" id="barangay" name="Barangay" required>
                                        <option value="">Select Barangay</option>
                                        <!-- Barangays will be added here dynamically -->
                                    </select>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <input type="text" class="form-control" name="ContactNumber" placeholder="Contact Number" required>
                                </div>
                            </div>
                            <div class="form-row mb-3">
                                <input type="text" class="form-control" name="Street" placeholder="Street" required>
                            </div>
                            <div class="form-row mb-3">
                                <input type="text" class="form-control" name="Shelter" placeholder="Shelter Name" required>
                            </div>
                            <button type="submit" class="btn btn-primary w-100 btn-create-account">Create Account</button>
                        </form>
                        <p class="text-center mt-3">Do you have an account? <a href="#" data-bs-target="#exampleModalToggle" data-bs-toggle="modal" style="color:#FF6600">Login</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/login.js"></script>

</body>
</html>
