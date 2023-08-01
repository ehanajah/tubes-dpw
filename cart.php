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
$carts = getCartsByUserId($user_id, $carts);

?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Montego</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
  <link href="https://fonts.googleapis.com/css2?family=Rubik&display=swap" rel="stylesheet">
  <style>
    body {
      font-family: rubik;
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
  <header class="border-bottom lh-1 py-3 container">
    <div class="row flex-nowrap justify-content-between align-items-center">
      <div class="col-4 pt-1">
        <a href="#" onclick="goBack()"><i class="bi bi-arrow-left-circle mx-3 fs-4 text-dark"></i></a>
      </div>
      <div class="col-4 text-center">
        <a class="blog-header-logo text-body-emphasis text-decoration-none fw-bold" href="index.php">MONTEGO</a>
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
          <a class="link-dark" href="#" aria-label="Cart">
            <i class="bi bi-bag mx-3"></i>
          </a>
        <?php else : ?>
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

                  <?php if (isset($_SESSION['remove_from_cart_successful'])) : ?>
                    <div class="alert alert-warning alert-dismissible fade show rounded-0 me-2" role="alert">
                      <?= $_SESSION['remove_from_cart_successful']; ?>
                      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                  <?php
                    unset($_SESSION['remove_from_cart_successful']);
                  endif; ?>

                  <div class="p-5">
                    <div class="d-flex justify-content-between align-items-center mb-5">
                      <h1 class="fw-bold mb-0 text-black">Shopping Cart</h1>
                      <h6 class="mb-0 text-muted"><?= count($carts); ?> item<?php if (count($carts) >= 2) : ?>s<?php endif; ?></h6>
                    </div>

                    <?php if ($carts != null) : ?>
                      <?php foreach ($carts as $cart) : ?>
                        <?php $product = getProductById($cart['product_id'], $products); ?>
                        <!-- card part -->
                        <hr class="my-4">
                        <div class="row mb-4 d-flex justify-content-between align-items-center">
                          <input class="col-lg-1 col-md-1 form-check-input me-1" type="checkbox" name="selected_items[]" data-price="<?= $product['product_price']; ?>" data-quantity="<?= $cart['quantity']; ?>" data-product-id="<?= $product['product_id']; ?>" data-selected-size="<?= $cart['selected_size']; ?>">

                          <div class="col-lg-3 col-md-11 mb-4 mb-lg-0">
                            <!-- Image -->
                            <div class="bg-image hover-overlay hover-zoom ripple rounded" data-mdb-ripple-color="light">
                              <img src="upload<?= $product['product_image']; ?>" class="w-100" alt="Blue Jeans Jacket" />
                              <a href="#!">
                                <div class="mask" style="background-color: rgba(251, 251, 251, 0.2)"></div>
                              </a>
                            </div>
                            <!-- Image -->
                          </div>

                          <div class="col-lg-4 col-md-6 mb-4 mb-lg-0">
                            <!-- Data -->
                            <h3><strong><?= $product['product_title']; ?></strong></h3>
                            <p>Size: <?= $cart['selected_size']; ?></p>
                            <form action="remove-item-cart.php" method="post">
                              <input type="hidden" name="product_id" value="<?= $product["product_id"]; ?>">
                              <input type="hidden" name="size" value="<?= $cart["selected_size"]; ?>">
                              <button type="submit" class="btn btn-danger btn-md me-1 mb-2 rounded-0" data-mdb-toggle="tooltip" title="Remove item">
                                <i class="fas fa-trash"></i>
                              </button>
                            </form>
                          </div>

                          <div class="col-lg-4 col-md-6 mb-4 mb-lg-0">
                            <!-- Quantity -->
                            <div class="d-flex mb-4" style="max-width: 300px">
                              <button class="btn btn-dark px-3 me-2 rounded-0" style="height:fit-content" onclick="this.parentNode.querySelector('input[type=number]').stepDown(); calculateTotal()">
                                <i class="fas fa-minus"></i>
                              </button>

                              <div class="form-outline text-center">
                                <input min="0" name="quantity" value="<?= $cart['quantity']; ?>" type="number" class="form-control item-quantity" onchange="calculateTotal()" />
                                <label class="form-label" for="form1">Quantity</label>
                              </div>

                              <button class="btn btn-dark px-3 py-2 ms-2 rounded-0" style="height:fit-content" onclick="this.parentNode.querySelector('input[type=number]').stepUp(); calculateTotal()">
                                <i class="fa-solid fa-plus"></i>
                              </button>
                            </div>
                            <!-- Quantity -->

                            <!-- Price -->

                            <p class="text-end"><strong> Product price: Rp <?= number_format($product['product_price'], 0, ',', '.'); ?></strong></p>

                            <!-- Price -->
                          </div>
                        </div>
                      <?php endforeach; ?>

                    <?php else : ?>
                      <!-- card empty -->
                      <hr class="my-4">
                      <div class="row mb-4 d-flex justify-content-between align-items-center">
                        <div class="text-center border border-opacity-50 py-5">
                          <div class="py-5">
                            <h2>No items</h2>
                            <a href="shop.php" class="text-decoration-none">Go to shop</a>
                          </div>
                        </div>
                      </div>
                    <?php endif; ?>

                    <hr class="my-4">

                    <div class="pt-5">
                      <h6 class="mb-0"><a href="index.php" class="text-body"><i class="fas fa-long-arrow-alt-left me-2"></i>Back to shop</a></h6>
                    </div>
                  </div>
                </div>
                <div class="col-lg-4 bg-dark text-white border-0">
                  <div class="p-5">
                    <h3 class="mb-0 text-white">Summary</h3>
                    <div class="my-3">
                      <hr>
                      <p>Products: <span id="total_price_p">Rp 0</span></p>
                      <p>Shipping: Free</p>
                      <hr>
                      <p>Total Price</p>
                      <h5 class="mt-0 text-info" id="total_price_h">Rp 0</h5>
                    </div>
                    <button type="button" class="btn btn-outline-light btn-lg rounded-0 mt-1" onclick="submitPayNowForm()">Pay Now</button>
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

  <form id="payNowForm" action="checkout.php" method="post"> <!-- Assuming process_payment.php is the PHP file that processes the payment -->
    <!-- Hidden input field to store the total price -->
    <input type="hidden" name="total_price" id="total_price" value="0">
    <!-- Hidden input field to store the selected items data as JSON -->
    <input type="hidden" name="selected_items_data" id="selected_items_data" value="">
  </form>

  <script>
    // Fungsi untuk menghitung total harga
    function calculateTotal() {
      var total = 0;
      var checkboxes = document.querySelectorAll('input[name="selected_items[]"]:checked');
      checkboxes.forEach(function(checkbox) {
        var product_price = parseInt(checkbox.getAttribute('data-price')); // Ubah variabel price menjadi product_price
        var quantityInput = checkbox.closest('.mb-4').querySelector('.item-quantity'); // Mengambil elemen input quantity terdekat dari checkbox
        var quantity = parseInt(quantityInput.value); // Mengambil nilai quantity dari input
        total += product_price * quantity; // Ubah price menjadi product_price
      });

      // Tampilkan total harga di elemen dengan ID "total_price"
      document.getElementById('total_price').textContent = 'Rp. ' + total.toLocaleString();
      document.getElementById('total_price_p').textContent = 'Rp. ' + total.toLocaleString();
      document.getElementById('total_price_h').textContent = 'Rp. ' + total.toLocaleString();
    }

    // Tambahkan event listener untuk checkbox agar memanggil fungsi calculateTotal saat status checked berubah
    var checkboxes = document.querySelectorAll('input[name="selected_items[]"]');
    checkboxes.forEach(function(checkbox) {
      checkbox.addEventListener('change', calculateTotal);
    });

    // Tambahkan event listener untuk setiap input quantity agar memanggil fungsi calculateTotal saat nilai quantity berubah
    var quantityInputs = document.querySelectorAll('.item-quantity');
    quantityInputs.forEach(function(input) {
      input.addEventListener('change', calculateTotal);
    });

    function getCheckedItems() {
      const checkedItems = [];
      const checkboxes = document.querySelectorAll('input[name="selected_items[]"]:checked');

      checkboxes.forEach(function(checkbox) {
        const product_id = checkbox.dataset.productId;
        const selected_size = checkbox.dataset.selectedSize;
        const quantityInput = checkbox.closest('.mb-4').querySelector('.item-quantity');
        const quantity = quantityInput.value;

        checkedItems.push({
          product_id: product_id,
          selected_size: selected_size,
          quantity: quantity,
        });
      });

      return checkedItems;
    }

    // Fungsi submit payment
    function submitPayNowForm() {
      var checkboxes = document.querySelectorAll('input[name="selected_items[]"]:checked');
      var totalPrice = 0;
      var selectedItemsData = [];

      checkboxes.forEach(function(checkbox) {
        var product_price = parseInt(checkbox.getAttribute('data-price'));
        var quantityInput = checkbox.closest('.mb-4').querySelector('.item-quantity');
        var quantity = parseInt(quantityInput.value);
        totalPrice += product_price * quantity;

        // Menambahkan data produk yang dipilih ke dalam array selectedItemsData
        var product_id = checkbox.dataset.productId;
        var selected_size = checkbox.dataset.selectedSize;
        selectedItemsData.push({
          product_id: product_id,
          selected_size: selected_size,
          quantity: quantity,
        });
      });
      
      // Simpan total harga dalam bentuk tersembunyi
      document.getElementById('total_price').value = totalPrice;
      // Simpan data produk yang dipilih sebagai JSON dalam bentuk tersembunyi
      document.getElementById('selected_items_data').value = JSON.stringify(selectedItemsData);

      // Submit form
      document.getElementById('payNowForm').submit();
    }
  </script>
  <script src="js/script.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
  <script src="https://kit.fontawesome.com/a04d5e0b0c.js" crossorigin="anonymous"></script>
</body>

</html>