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
  <script src="/docs/5.3/assets/js/color-modes.js"></script>
</head>

<body>
  <div class="container">
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
        <a class="nav-item nav-link link-body-emphasis active" href="#">Discover</a>
        <a class="nav-item nav-link link-body-emphasis nav-scroll" href="#new">New Arrivals</a>
        <a class="nav-item nav-link link-body-emphasis" href="shop.php">All Products</a>
        <a class="nav-item nav-link link-body-emphasis" href="#">Exclusive</a>
        <a class="nav-item nav-link link-body-emphasis" href="#">Featured</a>
        <a class="nav-item nav-link link-body-emphasis" href="#">Collaboration</a>
      </nav>
    </div>
  </div>

  <main class="container">
    <div id="carouselExampleCaptions" class="carousel slide carousel-fade" data-bs-ride="carousel">
      <div class="carousel-indicators">
        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
      </div>
      <div class="carousel-inner">
        <div class="carousel-item active">
          <img src="https://www.kingscross.co.uk/media/Paul-Smith-Coal-Drops-HR-6-1920x1080.jpg?cache=1684855070" class="d-block w-100" alt="...">
          <div class="carousel-caption d-none d-md-block">
            <h5>First slide label</h5>
            <p>Some representative placeholder content for the first slide.</p>
          </div>
        </div>
        <div class="carousel-item">
          <img src="https://wallpaperaccess.com/full/1448063.jpg" class="d-block w-100" alt="...">
          <div class="carousel-caption d-none d-md-block">
            <h5>Second slide label</h5>
            <p>Some representative placeholder content for the second slide.</p>
          </div>
        </div>
        <div class="carousel-item">
          <img src="https://assets.gqindia.com/photos/64ae7991ca23363cf3f5fa0b/16:9/pass/Is-a-capsule-wardrobe-possible-in-the-age-of-consumerism_001.jpg" class="d-block w-100" alt="...">
          <div class="carousel-caption d-none d-md-block">
            <h5>Third slide label</h5>
            <p>Some representative placeholder content for the third slide.</p>
          </div>
        </div>
      </div>
      <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
      </button>
    </div>
  </main>

  <section id="new" class="container my-5">
    <h3 class="text-center">New Arrivals</h3>
    <p class="text-center mx-5 px-5">Discover all the new arrivals of the MONTEGO's ready-to-wear collection Fall-Winter 2023. Browse items that you need for your wardobe: T-Shirt, Shirt, Outerwear, Pants, Accessories, Many more..</p>
    <div class="row justify-content-center">
      <div class="col-md-4 mt-3">
        <div class="card shadow-sm">
          <img src="https://dynamic.zacdn.com/SwTJz8sFqpcrWlp_5GtF9E3MNyo=/filters:quality(70):format(webp)/https://static-id.zacdn.com/p/tolliver-2125-8177763-1.jpg" class="card-img-top" alt="Product 1">
          <div class="card-body">
            <h5 class="card-title">Long Sleeve Henley T-Shirt</h5>
            <p class="card-text">Summer-Sale Offers!</p>
          </div>
        </div>
      </div>
      <div class="col-md-4 mt-3">
        <div class="card shadow-sm">
          <img style="max-height: 600px;" src="https://dynamic.zacdn.com/zybimNptBZ_GUMND-4M_K_gLG30=/filters:quality(70):format(webp)/https://static-id.zacdn.com/p/desigual-7908-9355893-1.jpg" class="card-img-top" alt="Product 2">
          <div class="card-body">
            <h5 class="card-title">Overcoat Jacket</h5>
            <p class="card-text">Summer-Sale Offers!</p>
          </div>
        </div>
      </div>
      <div class="col-md-4 mt-3">
        <div class="card shadow-sm">
          <img style="max-height: 600px;" src="https://dynamic.zacdn.com/7v_0OrGVO3kr1zoyAwOvAqOkPmY=/filters:quality(70):format(webp)/https://static-id.zacdn.com/p/defacto-3211-8854173-1.jpg" class="card-img-top" alt="Product 3">
          <div class="card-body">
            <h5 class="card-title">Smart Casual Blazer</h5>
            <p class="card-text d-flex">Summer-Sale Offers!</p>
          </div>
        </div>
      </div>
    </div>
    <div class="d-flex justify-content-center mt-4 pt-2">
      <a class="btn btn-outline-dark py-2 px-5 rounded-0">EXPLORE THE COLLECTIONS</a>
    </div>
  </section>

  <hr>

  <section id="product" class="container my-5">
    <h3 class="text-center">All Products</h3>
    <div class="row">

      <?php
      // Menghitung total jumlah produk
      $totalProducts = count($products);

      // Batasi tampilan hanya 4 produk terakhir
      $productLimit = 4;

      // Jika ada lebih dari 4 produk, mulai dari indeks produk terakhir dan mundur hingga mencapai 4 produk terakhir
      for ($i = $totalProducts - 1; $i >= max($totalProducts - $productLimit, 0); $i--) {
        $product = $products[$i];
        $price = $product['product_price'];
      ?>
        <div class="col-md-3 mt-4">
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
      <?php
      }
      ?>

    </div>
    <div class="d-flex justify-content-center">
      <a class="btn btn-dark py-2 px-4 mt-5 rounded-0" href="shop.php">More Products</a>
    </div>
  </section>



  <?php include("include/footer.php"); ?>
  <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
  <script src="js/script.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js" integrity="sha384-fbbOQedDUMZZ5KreZpsbe1LCZPVmfTnH7ois6mU1QK+m14rQ1l2bGBq41eYeM/fS" crossorigin="anonymous"></script>



</body>

</html>