<?php

include("include/data.php");
include("include/functions.php");

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
            <?php if (!(isAdmin())): ?>
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
            <?php endif; ?>
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
        <a class="nav-item nav-link link-body-emphasis active" href="#">All Products</a>
        <a class="nav-item nav-link link-body-emphasis" href="#">Exclusive</a>
        <a class="nav-item nav-link link-body-emphasis" href="#">Featured</a>
        <a class="nav-item nav-link link-body-emphasis" href="#">Collaboration</a>
      </nav>
    </div>
  </div>

  <!-- ini buat current navigation -->
  <div class="container">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a class="link-dark" href="index.php">Home</a></li>
        <li class="breadcrumb-item"><a class="link-dark" href="shop.php">Products</a></li>
        <li class="breadcrumb-item active" aria-current="page"><?= $product['product_title']; ?></li>
      </ol>
    </nav>
  </div>

  <section id="details" class="container mt-3">
    <form action="add-to-cart.php" method="post">
      <input type="hidden" name="id" value="<?= $product['product_id']; ?>">
      <div class="row">
        <div class="col-7">
          <div class="shadow-sm border rounded">
            <div class="row justify-content-center">
              <div class="col-10">
                <img src="upload/<?= $product['product_image']; ?>" class="card-img-top rounded" alt="Product 1">
              </div>
            </div>
          </div>
        </div>
        <div class="col-4 ms-5">

          <?php if (isset($_SESSION['add_to_cart_successful'])) : ?>
            <div class="alert alert-success alert-dismissible fade show rounded-0" role="alert">
              <?= $_SESSION['add_to_cart_successful']; ?>
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
          <?php
            unset($_SESSION['add_to_cart_successful']);
          elseif (isset($_SESSION['item_already_exists'])) : ?>
            <div class="alert alert-warning alert-dismissible fade show rounded-0" role="alert">
              <?= $_SESSION['item_already_exists']; ?>
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
          <?php
            unset($_SESSION['item_already_exists']);
          endif; ?>

          <h3><?= $product['product_title']; ?></h3>
          <h4 class="my-4">RP. <?= number_format($price, 0, ',', '.'); ?></h4>
          <strong>Size: </strong>
          <br>
          <div class="btn-group mt-2 mb-4 w-100" role="group" aria-label="Basic radio toggle button group">
            <input type="radio" class="btn-check" name="btnradio" id="btnradio1" autocomplete="off" value="s" checked>
            <label class="btn btn-outline-dark rounded-0" for="btnradio1">S</label>

            <input type="radio" class="btn-check" name="btnradio" id="btnradio2" autocomplete="off" value="m">
            <label class="btn btn-outline-dark rounded-0" for="btnradio2">M</label>

            <input type="radio" class="btn-check" name="btnradio" id="btnradio3" autocomplete="off" value="l">
            <label class="btn btn-outline-dark rounded-0" for="btnradio3">L</label>
          </div>
          <br>

          <?php
            $sStock = getProductStockWithSpecificSize($product_id, $product_stocks, 's');
            $mStock = getProductStockWithSpecificSize($product_id, $product_stocks, 'm');
            $lStock = getProductStockWithSpecificSize($product_id, $product_stocks, 'l'); 
          ?>
          <div id="stockS" class="stock-info mb-3">
            <strong>Stock : </strong>
            <span id="stockSizeS"><?= $sStock; ?></span>
          </div>

          <div id="stockM" class="stock-info mb-3">
            <strong>Stock : </strong>
            <span id="stockSizeM"><?= $mStock; ?></span>
          </div>

          <div id="stockL" class="stock-info mb-3">
            <strong>Stock : </strong>
            <span id="stockSizeL"><?= $lStock; ?></span>
          </div>

          <strong>Quantity: </strong>
          <br>
          <div class="input-group mt-2 mb-4" style="width: 35%;">
            <button type="button" class="btn btn-outline-dark rounded-0" onclick="decreaseQuantity()">-</button>
            <input type="number" class="form-control text-center border border-dark" name="qty" id="qty" value="1" min="1" max="" aria-label="Quantity" aria-describedby="add-to-cart">
            <button type="button" class="btn btn-outline-dark rounded-0" onclick="increaseQuantity()">+</button>
          </div>
          <p id="quantityError" class="text-danger"></p>
          <?php if (isset($_SESSION['username'])): ?>
            <?php if (!(isAdmin())): ?>
          <button type="submit" id="addToCartBtn" class="btn btn-sm btn-dark border-0 w-100 rounded-0 py-2 mt-3" disabled><strong>Add to Cart</strong></button>              
            <?php endif; ?>
          <?php  else: ?>
          <a href="login.php" class="btn btn-sm btn-dark border-0 w-100 rounded-0 py-2 mt-3"><strong>Login to Buy</strong></a>
          <?php endif; ?>
        </div>
        <div class="col-1"></div>
      </div>
    </form>
  </section>

  <div class="container desc mt-3">
    <div class="border-top border-bottom py-4 px-3">
      <h4><u>Description</u></h4>
      <p>
        <br>
        <?= $product['product_desc']; ?>
      </p>
    </div>
  </div>




  <section id="product" class="container my-5">
    <h3 class="text-center">You May Also Like</h3>
    <div class="row">
      <div class="col-md-3 mt-4">
        <a href="#" class="link-dark text-decoration-none">
          <div class="card shadow-sm text-center justify-content-center">
            <img src="https://tinkerlust.s3.ap-southeast-1.amazonaws.com/products/c41dfe7e-a4a6-47ca-bde3-340b8da2b282/original/1280x1280/IMG_0033_18032-KO-356.JPG" class="card-img-top" alt="Product 1">
            <div class="card-body">
              <h5 class="card-title">Basic T-Shirt</h5>
              <p class="card-text">RP. 200.000</p>
              <a href="#" class="btn btn-sm btn-outline-dark border-0 w-100 rounded-0 py-2 mt-3"><strong><u>Buy Now</u></strong></a>
            </div>
          </div>
        </a>
      </div>
      <div class="col-md-3 mt-4">
        <a href="#" class="link-dark text-decoration-none">
          <div class="card shadow-sm text-center justify-content-center">
            <img src="https://tinkerlust.s3.ap-southeast-1.amazonaws.com/products/c41dfe7e-a4a6-47ca-bde3-340b8da2b282/original/1280x1280/IMG_0033_18032-KO-356.JPG" class="card-img-top" alt="Product 1">
            <div class="card-body">
              <h5 class="card-title">Basic T-Shirt</h5>
              <p class="card-text">RP. 200.000</p>
              <a href="#" class="btn btn-sm btn-outline-dark border-0 w-100 rounded-0 py-2 mt-3"><strong><u>Buy Now</u></strong></a>
            </div>
          </div>
        </a>
      </div>
      <div class="col-md-3 mt-4">
        <a href="#" class="link-dark text-decoration-none">
          <div class="card shadow-sm text-center justify-content-center">
            <img src="https://tinkerlust.s3.ap-southeast-1.amazonaws.com/products/c41dfe7e-a4a6-47ca-bde3-340b8da2b282/original/1280x1280/IMG_0033_18032-KO-356.JPG" class="card-img-top" alt="Product 1">
            <div class="card-body">
              <h5 class="card-title">Basic T-Shirt</h5>
              <p class="card-text">RP. 200.000</p>
              <a href="#" class="btn btn-sm btn-outline-dark border-0 w-100 rounded-0 py-2 mt-3"><strong><u>Buy Now</u></strong></a>
            </div>
          </div>
        </a>
      </div>
      <div class="col-md-3 mt-4">
        <a href="#" class="link-dark text-decoration-none">
          <div class="card shadow-sm text-center justify-content-center">
            <img src="https://tinkerlust.s3.ap-southeast-1.amazonaws.com/products/c41dfe7e-a4a6-47ca-bde3-340b8da2b282/original/1280x1280/IMG_0033_18032-KO-356.JPG" class="card-img-top" alt="Product 1">
            <div class="card-body">
              <h5 class="card-title">Basic T-Shirt</h5>
              <p class="card-text">RP. 200.000</p>
              <a href="#" class="btn btn-sm btn-outline-dark border-0 w-100 rounded-0 py-2 mt-3"><strong><u>Buy Now</u></strong></a>
            </div>
          </div>
        </a>
      </div>
    </div>
  </section>

  <?php include("include/footer.php"); ?>

  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js" integrity="sha384-fbbOQedDUMZZ5KreZpsbe1LCZPVmfTnH7ois6mU1QK+m14rQ1l2bGBq41eYeM/fS" crossorigin="anonymous"></script>
  <script>
    function decreaseQuantity() {
      const quantityInput = document.getElementById("qty");
      if (quantityInput.value > 1) {
        quantityInput.value = parseInt(quantityInput.value) - 1;
      }
    }

    function increaseQuantity() {
      const quantityInput = document.getElementById("qty");
      const maxStock = parseInt(quantityInput.max);
      const currentQuantity = parseInt(quantityInput.value);
      const addToCartBtn = document.getElementById("addToCartBtn");

      if (currentQuantity < maxStock) {
        quantityInput.value = currentQuantity + 1;
        addToCartBtn.disabled = false; // Aktifkan tombol jika jumlah masih di bawah stok
      } else {
        document.getElementById("quantityError").innerText = "Quantity melebihi stok yang tersedia!";
        setTimeout(function() {
          document.getElementById("quantityError").innerText = "";
        }, 3000); // Hapus pesan setelah 3 detik
        addToCartBtn.disabled = true; // Nonaktifkan tombol jika jumlah melebihi stok
      }
    }

    function goBack() {
      window.history.back();
    }

    // Function untuk menyembunyikan semua div dengan class "stock-info"
    function hideAllStocks() {
      const stockInfos = document.querySelectorAll(".stock-info");
      stockInfos.forEach(stockInfo => {
        stockInfo.style.display = "none";
      });
    }

    // Function untuk menampilkan stok sesuai dengan radio button yang aktif
    function showStockBySize(size) {
      hideAllStocks();
      const stockDiv = document.getElementById(`stock${size.toUpperCase()}`);
      stockDiv.style.display = "block";
    }

    // Event listener untuk setiap input radio button
    const radioButtons = document.querySelectorAll('input[name="btnradio"]');
    radioButtons.forEach(radioButton => {
      radioButton.addEventListener("change", (event) => {
        const size = event.target.value;
        showStockBySize(size);
      });
    });

    // Panggil fungsi hideAllStocks() untuk menyembunyikan semua stok saat halaman dimuat
    hideAllStocks();

    // Panggil fungsi showStockBySize() untuk menampilkan stok sesuai dengan radio button yang aktif saat halaman dimuat
    const checkedRadioButton = document.querySelector('input[name="btnradio"]:checked');
    if (checkedRadioButton) {
      const size = checkedRadioButton.value;
      showStockBySize(size);
    }

    // Function untuk mengatur nilai maksimum input quantity berdasarkan stok dari ukuran yang dipilih
    function setMaxQuantityBySize(size) {
      const stockDiv = document.getElementById(`stockSize${size.toUpperCase()}`);
      const stock = parseInt(stockDiv.innerText, 10);
      const quantityInput = document.getElementById("qty");
      quantityInput.max = stock;
      document.getElementById("quantityError").innerText = ""; // Hapus pesan error jika ada

      const currentQuantity = parseInt(quantityInput.value);
      const addToCartBtn = document.getElementById("addToCartBtn");

      if (currentQuantity > stock) {
        addToCartBtn.disabled = true; // Nonaktifkan tombol jika quantity melebihi stok yang tersedia
      } else {
        addToCartBtn.disabled = false; // Aktifkan tombol jika quantity masih di bawah stok yang tersedia
      }
    }


    // Event listener untuk setiap input radio button
    radioButtons.forEach(radioButton => {
      radioButton.addEventListener("change", (event) => {
        const size = event.target.value;
        showStockBySize(size);
        setMaxQuantityBySize(size); // Set nilai maksimum input quantity berdasarkan stok dari ukuran yang dipilih
      });
    });

    // Panggil fungsi setMaxQuantityBySize() untuk mengatur nilai maksimum input quantity saat halaman dimuat
    if (checkedRadioButton) {
      const size = checkedRadioButton.value;
      setMaxQuantityBySize(size);
    }
  </script>
</body>

</html>