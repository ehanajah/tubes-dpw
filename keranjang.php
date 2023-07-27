<?php

include("admin/static-data.php");
include("admin/include/functions.php");

session_start();

if (isset($_GET['id'])) {
  $id = $_GET['id'];
  $product_id = intval($id);
}
$product = getProductById($product_id, $products);

$price = $product['product_price'];

?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Montego</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
  <style>
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

<body class="bg-white">
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
          <?php if(isset($_SESSION["username"])): ?>
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
              <a class="link-dark" href="#" aria-label="Cart">
                <i class="bi bi-bag mx-3"></i>
              </a>
              <?php else: ?>
              <a class="btn btn-sm btn-dark" href="login.php">Sign In</a>
              <?php endif; ?>
        </div>
      </div>
    </header>
  <section class="h-100 h-custom bg-white">
    <div class="container py-5 h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-12">
          <div class="card card-registration card-registration-2 border-0 mb-4" style="border-radius: 0px;">
            <div class="card-body p-0">
              <div class="row g-0">
                <div class="col-lg-8">
                  <div class="p-5">
                    <div class="d-flex justify-content-between align-items-center mb-5">
                      <h1 class="fw-bold mb-0 text-black">Shopping Cart</h1>
                      <h6 class="mb-0 text-muted">3 items</h6>
                    </div>
                    <!-- card part -->
                    <hr class="my-4">
                    <div class="row mb-4 d-flex justify-content-between align-items-center">
                      <div class="col-lg-3 col-md-12 mb-4 mb-lg-0">
                        <!-- Image -->
                        <div class="bg-image hover-overlay hover-zoom ripple rounded" data-mdb-ripple-color="light">
                          <img src="https://static.zara.net/photos///2022/V/0/3/p/5252/606/406/2/w/1920/5252606406_6_1_1.jpg?ts=1645117254732" class="w-100" alt="Blue Jeans Jacket" />
                          <a href="#!">
                            <div class="mask" style="background-color: rgba(251, 251, 251, 0.2)"></div>
                          </a>
                        </div>
                        <!-- Image -->
                      </div>

                      <div class="col-lg-5 col-md-6 mb-4 mb-lg-0">
                        <!-- Data -->
                        <h3><strong>Blue Denim Shirt</strong></h3>
                        <p>Color: blue</p>
                        <p>Size: M</p>
                        <button type="button" class="btn btn-danger btn-md me-1 mb-2 rounded-0" data-mdb-toggle="tooltip" title="Remove item">
                          <i class="fas fa-trash"></i>
                        </button>
                      </div>

                      <div class="col-lg-4 col-md-6 mb-4 mb-lg-0">
                        <!-- Quantity -->
                        <div class="d-flex mb-4" style="max-width: 300px">
                          <button class="btn btn-dark px-3 me-2 rounded-0" style="height:fit-content"
                            onclick="this.parentNode.querySelector('input[type=number]').stepDown()">
                            <i class="fas fa-minus"></i>
                          </button>

                          <div class="form-outline text-center">
                            <input id="form1" min="0" name="quantity" value="1" type="number" class="form-control" />
                            <label class="form-label" for="form1">Quantity</label>
                          </div>

                          <button class="btn btn-dark px-3 py-2 ms-2 rounded-0" style="height:fit-content"
                            onclick="this.parentNode.querySelector('input[type=number]').stepUp()">
                            <i class="fa-solid fa-plus"></i>
                          </button>
                        </div>
                        <!-- Quantity -->

                        <!-- Price -->
                        <p class="text-start text-end">
                          <strong> Price: $17.99</strong>
                        </p>
                        <!-- Price -->
                      </div>
                    </div>

                    <hr class="my-4">

                    <div class="row mb-4 d-flex justify-content-between align-items-center">
                      <div class="col-lg-3 col-md-12 mb-4 mb-lg-0">
                        <!-- Image -->
                        <div class="bg-image hover-overlay hover-zoom ripple rounded" data-mdb-ripple-color="light">
                          <img src="https://static.zara.net/photos///2022/V/0/3/p/5252/606/406/2/w/1920/5252606406_6_1_1.jpg?ts=1645117254732" class="w-100" alt="Blue Jeans Jacket" />
                          <a href="#!">
                            <div class="mask" style="background-color: rgba(251, 251, 251, 0.2)"></div>
                          </a>
                        </div>
                        <!-- Image -->
                      </div>

                      <div class="col-lg-5 col-md-6 mb-4 mb-lg-0">
                        <!-- Data -->
                        <h3><strong>Blue Denim Shirt</strong></h3>
                        <p>Color: blue</p>
                        <p>Size: M</p>
                        <button type="button" class="btn btn-danger btn-md me-1 mb-2 rounded-0" data-mdb-toggle="tooltip" title="Remove item">
                          <i class="fas fa-trash"></i>
                        </button>
                      </div>

                      <div class="col-lg-4 col-md-6 mb-4 mb-lg-0">
                        <!-- Quantity -->
                        <div class="d-flex mb-4" style="max-width: 300px">
                          <button class="btn btn-dark px-3 me-2 rounded-0" style="height:fit-content"
                            onclick="this.parentNode.querySelector('input[type=number]').stepDown()">
                            <i class="fas fa-minus"></i>
                          </button>

                          <div class="form-outline text-center">
                            <input id="form1" min="0" name="quantity" value="1" type="number" class="form-control" />
                            <label class="form-label" for="form1">Quantity</label>
                          </div>

                          <button class="btn btn-dark px-3 py-2 ms-2 rounded-0" style="height:fit-content"
                            onclick="this.parentNode.querySelector('input[type=number]').stepUp()">
                            <i class="fa-solid fa-plus"></i>
                          </button>
                        </div>
                        <!-- Quantity -->

                        <!-- Price -->
                        <p class="text-start text-end">
                          <strong> Price: $17.99</strong>
                        </p>
                        <!-- Price -->
                      </div>
                    </div>

                    <hr class="my-4">

                    <div class="pt-5">
                      <h6 class="mb-0"><a href="index.php" class="text-body"><i
                            class="fas fa-long-arrow-alt-left me-2"></i>Back to shop</a></h6>
                    </div>
                  </div>
                </div>
                <div class="col-lg-4 bg-dark text-white border-0">
                  <div class="p-5">
                    <h3 class="mb-0 text-white">Summary</h3>
                    <div class="my-3">
                      <hr>
                      <p>Products : Rp209.000</p>
                      <p>Shipping: Rp.15.000</p>
                      <hr>
                      <p>Total Price</h6>
                      <h5 class="mt-0 text-info">Rp.224.000</h6>
                    </div>
                    <button type="button" class="btn btn-outline-light btn-lg rounded-0 mt-1">
                      Pay Now
                    </button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    </div>
  </section>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz"
    crossorigin="anonymous"></script>
  <script src="https://kit.fontawesome.com/a04d5e0b0c.js" crossorigin="anonymous"></script>
</body>

</html>