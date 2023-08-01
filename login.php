<?php

session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Login</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
	<style>
		#side-card {
			background-image: url("img/Homepage.png");
			background-size: cover;
			background-repeat: no-repeat;
		}

		button.btn.btn-primary.btn-block.fa-lg.mb-3 {
			width: 70%;
			background-color: #2426ee;
			color: black;
		}

		body {
			border-radius: 0px;
		}

		@media (min-width: 768px) {
			.gradient-form {
				height: 100vh !important;
			}
		}

		@media (min-width: 769px) {
			.gradient-custom-2 {
				border-top-right-radius: .3rem;
				border-bottom-right-radius: .3rem;
			}
		}
	</style>
</head>

<body class="bg-dark">
	<section class="h-100">
		<div class="container py-5 h-100">
			<div class="row d-flex justify-content-center align-items-center h-100">
				<div class="col-xl-10">
					<div class="card text-black rounded-0 border-0">
						<div class="row g-0">
							<div class="col-lg-6">
								<div class="card-body p-md-5 mx-md-4 rounded-0">

									<div>
										<h1 class="mt-1 mb-5 pb-1">Welcome Back</h1>
									</div>
									
									<?php if (isset($_SESSION['registration_success'])) : ?>
										<div class="alert alert-success alert-dismissible fade show rounded-0" role="alert">
											<?= $_SESSION['registration_success']; ?>
											<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
										</div>
									<?php
										unset($_SESSION['registration_success']);
									elseif (isset($_SESSION['login_error'])) : ?>
										<div class="alert alert-warning alert-dismissible fade show rounded-0" role="alert">
											<?= $_SESSION['login_error']; ?>
											<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
										</div>
									<?php
										unset($_SESSION['login_error']);
									endif; ?>

									<form action="login-process.php" method="POST">
										<p>Please login to your account</p>
										<div class="form-outline mb-4">
											<label class="form-label" for="email">Email</label>
											<input type="email" id="email" name="email" class="form-control" placeholder="Email address" />
										</div>

										<div class="form-outline mb-4">
											<label class="form-label" for="password">Password</label>
											<input type="password" id="password" name="password" class="form-control" placeholder="Insert Your Password" />
										</div>

										<div class="text-center pt-1 mb-1 pb-1">
											<button class="btn btn-dark btn-lg fa-lg mb-3 rounded-0" type="submit" style="width:100%">Login</button>
										</div>

										<div class="text-center pt-1 mb-5 pb-1">
											<a class="text-muted" href="#!">Forgot password?</a>
										</div>

										<div class="d-flex align-items-center justify-content-center pb-4">
											<p class="mb-0 me-2">Don't have an account?</p>
											<a href="register.php" class="btn btn-outline-dark rounded-0">Create new</a>
										</div>

									</form>

								</div>
							</div>
							<div class="col-lg-6 d-flex align-items-center bg-dark rounded-0" id="side-card">
								<div class="text-white px-3 py-4 p-md-5 mx-md-4 text-justify">
									<h2 class="mb-4">Monday Alter Ego</h4>
										<p class="small mb-0">Montego is a contemporary clothing brand that caters to the latest fashion trends. As a prominent distro specializing in modern apparel, Montego offers a wide range of stylish and up-to-date clothing choices, perfect for the fashion-forward individuals. Their collections feature trendy designs, high-quality fabrics, and unique styles that appeal to young and fashion-conscious customers. With a focus on staying ahead of the curve, Montego continually introduces fresh and innovative clothing options, making it a preferred destination for those seeking trendy and fashionable attire.</p>
								</div>
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