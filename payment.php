<?php

include("admin/static-data.php");
include("admin/include/functions.php");

session_start();

?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Montego</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.17/dist/sweetalert2.min.css">
  <style>
    @media (min-width: 1025px) {
      .h-custom {
        height: 100vh !important;
      }
    }
    
    @media screen and (max-width: 767px) {
        @media(min-width: 10px){
        form.needs-validation{
        width: 90%;
      }
    }

        
    }

    .card-registration .select-input.form-control[readonly]:not([disabled]) {
      font-size: 1rem;
      line-height: 2.15;
      padding-left: .75em;
      padding-right: .75em;
    }

    .card-registration .select-arrow {
      top: 13px;
    }

    .bg-grey {
      background-color: #eae8e8;
    }

    @media (min-width: 1025px) {
      .h-custom {
        height: 100vh !important;
      }
    }

    .card-registration .select-input.form-control[readonly]:not([disabled]) {
      font-size: 1rem;
      line-height: 2.15;
      padding-left: .75em;
      padding-right: .75em;
    }

    .card-registration .select-arrow {
      top: 13px;
    }

    .bg-grey {
      background-color: #eae8e8;
    }

    @media (min-width: 992px) {
      .card-registration-2 .bg-grey {
        border-top-right-radius: 16px;
        border-bottom-right-radius: 16px;
      }
    }

    @media (max-width: 991px) {
      .card-registration-2 .bg-grey {
        border-bottom-left-radius: 16px;
        border-bottom-right-radius: 16px;
      }
    }

    @media (min-width: 992px) {
      .card-registration-2 .bg-grey {
        border-top-right-radius: 16px;
        border-bottom-right-radius: 16px;
      }
    }

    @media (max-width: 991px) {
      .card-registration-2 .bg-grey {
        border-bottom-left-radius: 16px;
        border-bottom-right-radius: 16px;
      }
    }
  </style>
</head>

<body>
<header class="border-bottom lh-1 py-3">
          <div class="row flex-nowrap justify-content-between align-items-center">
            <div class="col-4 pt-1">
              <a class="link-dark" href="#">Subscribe</a>
            </div>
            <div class="col-4 text-center">
              <a class="blog-header-logo text-body-emphasis text-decoration-none fw-bold" href="#">MONTEGO</a>
            </div>
            <div class="col-4 d-flex justify-content-end align-items-center">
              <div class="dropdown">
                <a class="link-dark" type="button" data-bs-toggle="dropdown" aria-expanded="false"  data-bs-offset="130,20">
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
              <?php if(isset($_SESSION["email"])): ?>
              <div class="dropdown-center">
                <a class="link-dark" href="#" aria-label="Akun" data-bs-toggle="dropdown" aria-expanded="false">
                  <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-person" viewBox="0 0 16 16">
                    <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6Zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0Zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4Zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10Z"/>
                  </svg>
                </a>
                <ul class="dropdown-menu mt-3">
                  <li><a class="dropdown-item" href="user.php">My Account</a></li>
                  <li><a class="dropdown-item" href="#">My Orders</a></li>
                  <li><hr class="dropdown-divider"></li>
                  <li><a class="dropdown-item px-3" href="logout.php">Sign Out</a></li>
                </ul>
              </div>
              <a class="link-dark" href="keranjang.php" aria-label="Cart">
                <i class="bi bi-bag mx-3"></i>
              </a>
              <?php else: ?>
              <a class="btn btn-sm btn-dark" href="login.php">Sign In</a>
              <?php endif; ?>
            </div>
          </div>
        </header>
      
        <div class="nav-scroller py-1 mb-2 border-bottom">
          <nav class="nav nav-underline justify-content-between">
            <a class="nav-item nav-link link-body-emphasis active" href="#">Discover</a>
            <a class="nav-item nav-link link-body-emphasis nav-scroll" href="#new">New Arrivals</a>
            <a class="nav-item nav-link link-body-emphasis" href="shop.php">All Products</a>
            <a class="nav-item nav-link link-body-emphasis" href="#">Exclusive</a>
            <a class="nav-item nav-link link-body-emphasis" href="#">Featured</a>
            <a class="nav-item nav-link link-body-emphasis" href="#">Collaboration</a>
          </nav>
        </div>
      </div>
      
  <section class="h-100 h-custom"">
    <div class="container py-5 h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-12">
          <div class="card card-registration card-registration-2" style="border-radius: 0px;">
          <div class="py-5 text-center">
                <h1>Checkout</h1>
                <p class="lead">Silahkan isi data sesuai dengan data diri Anda</p>
            </div>

            <div class="row g-5">
                <div class="col-md-5 col-lg-3 order-md-last">
                    <h4 class="d-flex justify-content-between align-items-center mb-3">
                        <span class="text-dark">Detail Order</span>
                        <span class="badge bg-dark rounded-0">3</span>
                    </h4>
                    <ul class="list-group mb-3">
                        <li class="list-group-item d-flex justify-content-between lh-sm">
                            <div>
                                <h6 class="my-0">Product name</h6>
                                <small class="text-body-secondary">Brief description</small>
                            </div>
                            <span class="text-body-secondary">$12</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between lh-sm">
                            <div>
                                <h6 class="my-0">Second product</h6>
                                <small class="text-body-secondary">Brief description</small>
                            </div>
                            <span class="text-body-secondary">$8</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between lh-sm">
                            <div>
                                <h6 class="my-0">Third item</h6>
                                <small class="text-body-secondary">Brief description</small>
                            </div>
                            <span class="text-body-secondary">$5</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between">
                            <span>Total (USD)</span>
                            <strong>$20</strong>
                        </li>

                        <button id="confirmButton" class="w-100 btn btn-dark btn-lg my-3 rounded-0" type="submit">Confirm</button>
                    </ul>

                </div>
                <div class="col-md-5 col-lg-8 ms-5">
                    <h4 class="mb-3">Fill This Form</h4>
                    <form class="needs-validation" novalidate>
                        <div class="row g-3">

                            <div class="col-12">
                                <label for="username" class="form-label">Receipt Name</label>
                                <div class="input-group has-validation">
                                    <input type="text" class="form-control" id="username" placeholder="Masukkan Nama Penerima"
                                        required>
                                </div>
                            </div>

                            <div class="col-12">
                                <label for="address" class="form-label">Address</label>
                                <input type="text" class="form-control" id="address" placeholder="1234 Main St" required>
                            </div>

                            <div class="col-md-5">
                                <label for="provinsi" class="form-label">Region</label>
                                <input type="text" class="form-control" id="provinsi" placeholder="Jawa Tengah" required>
                            </div>

                            <div class="col-md-4">
                                <label for="state" class="form-label">City</label>
                                <input type="text" class="form-control" id="city" placeholder="Purwokerto" required>
                            </div>

                            <div class="col-md-3">
                                <label for="zip" class="form-label">Zip</label>
                                <input type="text" class="form-control" id="zip" placeholder="" required>
                                <div class="invalid-feedback">
                                    Zip code required.
                                </div>
                            </div>
                        </div>

                        <hr class="my-4">

                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="save-info">
                            <label class="form-check-label" for="save-info">Save this information for next time</label>
                        </div>

                        <hr class="my-4">

                        <h4 class="mb-3">Payment</h4>

                        <div class="my-3">
                            <div class="form-check">
                                <input id="credit" name="paymentMethod" type="radio" class="form-check-input" checked
                                    required>
                                <label class="form-check-label" for="credit">Credit card</label>
                            </div>
                            <div class="form-check">
                                <input id="debit" name="paymentMethod" type="radio" class="form-check-input" required>
                                <label class="form-check-label" for="debit">Debit card</label>
                            </div>
                            <div class="form-check">
                                <input id="paypal" name="paymentMethod" type="radio" class="form-check-input" required>
                                <label class="form-check-label" for="paypal">PayPal</label>
                            </div>
                        </div>

                        <div class="row gy-3">
                            <div class="col-md-6">
                                <label for="cc-name" class="form-label">Name on card</label>
                                <input type="text" class="form-control" id="cc-name" placeholder="" required>
                                <small class="text-body-secondary">Full name as displayed on card</small>
                                <div class="invalid-feedback">
                                    Name on card is required
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label for="cc-number" class="form-label">Credit card number</label>
                                <input type="text" class="form-control" id="cc-number" placeholder="" required>
                                <div class="invalid-feedback">
                                    Credit card number is required
                                </div>
                            </div>

                            <div class="col-md-3">
                                <label for="cc-expiration" class="form-label">Expiration</label>
                                <input type="text" class="form-control" id="cc-expiration" placeholder="" required>
                                <div class="invalid-feedback">
                                    Expiration date required
                                </div>
                            </div>

                            <div class="col-md-3">
                                <label for="cc-cvv" class="form-label">CVV</label>
                                <input type="text" class="form-control" id="cc-cvv" placeholder="" required>
                                <div class="invalid-feedback">
                                    Security code required
                                </div>
                            </div>
                        </div>

                        <hr class="my-4">
                    </form>
                </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    </div>
  </section>

  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.17/dist/sweetalert2.all.min.js"></script>
  <script src="js/script.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz"crossorigin="anonymous"></script>
  <script src="https://kit.fontawesome.com/a04d5e0b0c.js" crossorigin="anonymous"></script>
  <script src="sweetalert2.all.min.js"></script>
</body>

</html>