<?php

include("include/data.php");
include("include/functions.php");

session_start();
if(!(isLoggedIn())) {
  header('Location: index.php');
}
if(isAdmin()) {
  header('Location: index.php');
}

$user_id = $_SESSION['user_id'];
$user = getUserById($user_id, $users);

$address = getAddressByUserId($user_id, $addresses);
?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>MONTEGO</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Rubik&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="css/style.css">
  <script src="/docs/5.3/assets/js/color-modes.js"></script>
</head>

<body>
  <div class="container mb-3">
    <header class="border-bottom lh-1 py-3">
      <div class="row flex-nowrap justify-content-between align-items-center">
        <div class="col-4 pt-1">
          <a href="#" onclick="goBack()"><i class="bi bi-arrow-left-circle mx-3 fs-4 text-dark"></i></a>
        </div>
        <div class="col-4 text-center">
          <a class="blog-header-logo text-body-emphasis text-decoration-none fw-bold" href="#">MONTEGO</a>
        </div>
        <div class="col-4 d-flex justify-content-end align-items-center">
          <div class="dropdown">
            <a class="link-dark" type="button" data-bs-toggle="dropdown" aria-expanded="false" data-bs-offset="130,20">
              <i class="bi bi-search mx-3"></i>
            </a>
            <ul class="dropdown-menu" style="width: 500px">
              <li>
                <form class="px-4 py-3">
                  <div class="form-floating">
                    <input type="text" class="form-control rounded-0 border-dark border-top-0 border-start-0 border-end-0" id="searchInput" placeholder="search">
                    <label class="text-secondary" for="searchInput">What are you looking for?</label>
                  </div>
                </form>
              </li>
              <!-- <li><a class="dropdown-item" href="#">Another action</a></li>
                  <li><a class="dropdown-item" href="#">Something else here</a></li> -->
            </ul>
          </div>
          <?php if (isset($_SESSION["username"])) : ?>
            <div class="dropdown-center">
              <a class="link-dark" href="#" aria-label="Akun" data-bs-toggle="dropdown" aria-expanded="false">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-person" viewBox="0 0 16 16">
                  <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6Zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0Zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4Zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10Z" />
                </svg>
              </a>
              <ul class="dropdown-menu mt-3">
                <li><a class="dropdown-item" href="user.php">My Account</a></li>
                <li><a class="dropdown-item" href="order.php">My Orders</a></li>
                <li>
                  <hr class="dropdown-divider">
                </li>
                <li><a class="dropdown-item px-3" href="logout.php">Sign Out</a></li>
              </ul>
            </div>
            <a class="link-dark" href="cart.php" aria-label="Cart">
              <i class="bi bi-bag mx-3"></i>
            </a>
          <?php else : ?>
            <a class="btn btn-sm btn-dark" href="login.php">Sign In</a>
          <?php endif; ?>
        </div>
      </div>
    </header>

    <div class="nav-scroller py-1 mb-2 border-bottom">
      <nav class="nav nav-underline justify-content-between">
        <a class="nav-item nav-link link-body-emphasis" href="index.php">Discover</a>
        <a class="nav-item nav-link link-body-emphasis" href="index.php #new">New Arrivals</a>
        <a class="nav-item nav-link link-body-emphasis" href="shop.php">All Products</a>
        <a class="nav-item nav-link link-body-emphasis" href="#">Exclusive</a>
        <a class="nav-item nav-link link-body-emphasis" href="#">Featured</a>
        <a class="nav-item nav-link link-body-emphasis" href="#">Collaboration</a>
      </nav>
    </div>
  </div>

  <section class="container">
    <form action="update-user.php" method="post">
      <div class="text-center my-5">
        <h3>Account Settings</h3>
      </div>
      <div class="row">
        <?php if (isset($_SESSION['user_update_success'])) : ?>
          <div class="alert alert-success alert-dismissible fade show rounded-0" role="alert">
            <?= $_SESSION['user_update_success']; ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
        <?php
          unset($_SESSION['user_update_success']);
        endif; ?>
        <div class="col-3">
          <div class="sticky-top px-3 pb-3">
            <ul class="list-group rounded-0">
              <h5>Your Informations</h5>
              <hr class="mt-2">
            </ul>
          </div>
        </div>
        <div class="col-9">
          <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input type="text" class="form-control rounded-0" id="username" name="username" placeholder="Enter your username" value="<?= $user['username']; ?>">
          </div>
          <div class="row">
            <div class="col-6">
              <div class="mb-3">
                <label for="firstName" class="form-label">First Name</label>
                <input type="text" class="form-control rounded-0" id="firstName" name="firstName" placeholder="Enter your first name" value="<?= $user['first_name']; ?>">
              </div>
            </div>
            <div class="col-6">
              <div class="mb-3">
                <label for="lastName" class="form-label">Last Name</label>
                <input type="text" class="form-control rounded-0" id="lastName" name="lastName" placeholder="Enter your last name" value="<?= $user['last_name']; ?>">
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-3">
          <div class="px-3 pb-3">
            <div class="list-group rounded-0">
              <h5>Account Details</h5>
              <hr class="mt-2">
            </div>
          </div>
        </div>
        <div class="col-9">
          <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control rounded-0" id="email" name="email" placeholder="Enter your email address" value="<?= $user['email']; ?>">
          </div>
          <div class="form-group">
            <label for="mobile">Phone Number:</label>
            <input type="text" class="form-control rounded-0" id="mobile" name="mobile" placeholder="Enter your phone number" value="<?= $user['mobile']; ?>">
          </div>
          <div class="form-group mt-3">
            <label for="address">Address:</label>
            <input type="text" class="form-control rounded-0" id="address" name="address" rows="3" placeholder="Street" value="<?= $address['address']; ?>">
            <div class="row mt-3">
              <div class="col-4">
                <input type="text" class="form-control rounded-0" id="city" name="city" rows="3" placeholder="City" value="<?= $address['city']; ?>">
              </div>
              <div class="col-4">
                <input type="text" class="form-control rounded-0" id="province" name="province" rows="3" placeholder="Province" value="<?= $address['province']; ?>">
              </div>
              <div class="col-4">
                <input type="text" class="form-control rounded-0" id="zip" name="zip" rows="3" placeholder="ZIP" value="<?= $address['zip']; ?>">
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="text-center">
        <a href="user.php" type="button" class="btn btn-sm btn-outline-dark rounded-0 py-2 px-5 mt-5 me-3">Cancel</a>
        <a href="#" type="button" class="btn btn-sm btn-dark rounded-0 py-2 px-5 mt-5" data-bs-toggle="modal" data-bs-target="#exampleModal">Apply</a>
      </div>

      <!-- Modal -->
      <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="exampleModalLabel">Confirm all your changes</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              Save all your changes?
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-sm btn-white" data-bs-dismiss="modal"><u>Revert</u></button>
              <button type="submit" class="btn btn-sm btn-dark rounded-0">Save changes</button>
            </div>
          </div>
        </div>
      </div>
    </form>
  </section>

  <?php include("include/footer.php"); ?>
  <script>
    function goBack() {
      window.history.back();
    }
  </script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js" integrity="sha384-fbbOQedDUMZZ5KreZpsbe1LCZPVmfTnH7ois6mU1QK+m14rQ1l2bGBq41eYeM/fS" crossorigin="anonymous"></script>



</body>

</html>