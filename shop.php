<?php

include("include/data.php");
include("include/functions.php");

session_start();

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
</head>

<body id="container">
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
            <?php if (!(isAdmin())) : ?>
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
        <li class="breadcrumb-item active" aria-current="page">All Products</li>
      </ol>
    </nav>
  </div>

  <section id="product" class="container mt-3">
    <div class="row">
      <div class="col-2">
        <div class="sticky-top px-3 pb-3 categories">
          <ul class="list-group rounded-0">
            <strong class="mt-3">Categories</strong>
            <hr class="mt-2">
            <?php foreach ($categories as $category) : ?>
              <li class="list-group-item border-0">
                <input class="form-check-input category-checkbox" type="checkbox" value="<?= $category['category_id']; ?>" id="categoryCheckbox<?= $category['category_id']; ?>" checked>
                <label class="form-check-label" for="categoryCheckbox<?= $category['category_id']; ?>"><?= $category['category_name']; ?></label>
              </li>
            <?php endforeach; ?>
            <hr>
            <div class="text-center mt-3">
              <a class="link-dark text-center nav-scroll" href="#container">back to top</a>
            </div>
        </div>
      </div>
      <div class="col-10">

        <div class="d-flex">
          <a class="link-dark text-decoration-none mt-1" type="button" data-bs-toggle="collapse" aria-expanded="false" data-bs-target="#collapseWidthExample">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-search me-1" viewBox="0 0 16 16">
              <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
            </svg>
          </a>
          <form class="w-100">
            <div class="form-group mb-0 mx-2">
              <input type="text" class="form-control border-0 rounded-0" id="searchInput" placeholder="Found any Product?">
            </div>
          </form>
          <!-- <a class="btn btn-dark rounded-0">Filters</a> -->
        </div>
        <hr>
        <div class="row">

          <?php foreach ($products as $product) : ?>
            <?php $price = $product['product_price']; ?>
            <div class="product-card col-md-4 mt-4" data-category="<?= $product['category_id']; ?>">
              <a href="#" class="link-dark text-decoration-none">
                <div class="card shadow-sm text-center justify-content-center">
                  <img src="upload/<?= $product['product_image']; ?>" class="card-img-top" alt="Product 1">
                  <div class="card-body">
                    <h5 class="card-title"><?= $product['product_title']; ?></h5>
                    <p class="card-text">RP. <?= number_format($price, 0, ',', '.'); ?></p>
                    <a href="detail.php?id=<?= $product['product_id']; ?>" class="btn btn-sm btn-outline-dark border-0 w-100 rounded-0 py-2 mt-3"><strong><u>Buy Now</u></strong></a>
                  </div>
                </div>
              </a>
            </div>
          <?php endforeach; ?>

        </div>
      </div>
    </div>
  </section>

  <?php include("include/footer.php"); ?>
  <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
  <script src="js/script.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js" integrity="sha384-fbbOQedDUMZZ5KreZpsbe1LCZPVmfTnH7ois6mU1QK+m14rQ1l2bGBq41eYeM/fS" crossorigin="anonymous"></script>
  <script>
    $(document).ready(function() {
      // Fungsi untuk memfilter produk berdasarkan kategori yang dipilih
      function filterProductsByCategory() {
        const selectedCategories = $('.category-checkbox:checked').map(function() {
          return this.value;
        }).get();

        if (selectedCategories.length === 0) {
          // Jika tidak ada kategori yang dipilih, tampilkan semua produk
          $('.product-card').show();
        } else {
          // Sembunyikan semua produk
          $('.product-card').hide();

          // Tampilkan kembali produk yang sesuai dengan kategori yang dipilih
          selectedCategories.forEach(category_id => {
            $(`.product-card[data-category="${category_id}"]`).show();
          });
        }
      }

      // Panggil fungsi filter saat halaman dimuat dan saat ada perubahan pada checkbox kategori
      $(document).ready(filterProductsByCategory);
      $('.category-checkbox').on('change', filterProductsByCategory);
    });
  </script>

</body>

</html>