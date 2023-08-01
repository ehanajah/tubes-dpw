<?php

session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>

<body class="bg-dark">
    <section>
        <div class="d-flex align-items-center h-100">
            <div class="container h-100 rounded-0">
                <div class="row d-flex justify-content-center align-items-center h-100">
                    <div class="col-12 col-xl-8 my-3">
                        <div class="card rounded-0">
                            <div class="card-body p-5">
                                <h1 class="mt-1 mb-5 pb-1 text-center">Create an Account</h1>
                                <div class="my-3">
                                    <?php if (isset($_SESSION['registration_error_email'])): ?>
                                        <div class="alert alert-warning alert-dismissible fade show rounded-0" role="alert">
                                            <?= $_SESSION['registration_error_email']; ?>
                                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                        </div>
                                    <?php
                                        unset($_SESSION['registration_error_email']);
                                    elseif (isset($_SESSION['registration_error_pass'])): ?>
                                        <div class="alert alert-warning alert-dismissible fade show rounded-0" role="alert">
                                            <?= $_SESSION['registration_error_pass']; ?>
                                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                        </div>
                                    <?php
                                        unset($_SESSION['registration_error_pass']);
                                    endif; ?>
                                </div>

                                <form action="register-process.php" method="POST">
                                    <div class="form-outline mb-3">
                                        <label class="form-label" for="username">Your Username</label>
                                        <input type="text" id="username" name="username" class="form-control" placeholder="username" />
                                    </div>

                                    <div class="form-outline mb-3">
                                        <label class="form-label" for="email">Your Email</label>
                                        <input type="email" id="email" name="email" class="form-control" placeholder="example@email.com" />
                                    </div>

                                    <div class="form-outline mb-3">
                                        <label class="form-label" for="password">Password</label>
                                        <input type="password" id="password" name="password" class="form-control" placeholder="Password" />
                                    </div>

                                    <div class="form-outline mb-3">
                                        <label class="form-label" for="confirmPassword">Repeat your password</label>
                                        <input type="password" id="confirmPassword" name="confirmPassword" class="form-control" placeholder="Type it Again" />
                                    </div>

                                    <div class="form-check d-flex justify-content-center mb-3">
                                        <input class="form-check-input me-2" type="checkbox" value="" id="form2Example3cg" required>
                                        <label class="form-check-label" for="form2Example3g">
                                            I agree all statements in <a href="#!" class="text-body"><u>Terms of service</u></a>
                                        </label>
                                    </div>

                                    <div class="d-flex justify-content-center">
                                        <button type="submit" class="btn btn-dark btn-block rounded-0" style="width:50%">Register</button>
                                    </div>
                                    <p class="text-center text-muted mt-5 mb-0">Already have an account? <a href="login.php" class="fw-bold text-body"><u class="btn btn-outline-dark rounded-0">Login here</u></a></p>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>

</html>