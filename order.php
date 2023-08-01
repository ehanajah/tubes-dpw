<?php
include('include/data.php');
include('include/functions.php');

session_start();
if(!(isLoggedIn())) {
  header('Location: index.php');
}
if(isAdmin()) {
  header('Location: index.php');
}

$user_id = $_SESSION['user_id'];
$orders = getOrdersByUserId($user_id, $orders);

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
  <style>
    html,
    body {
      height: 100%;
      margin: 0;
      padding: 0;
    }

    body {
      min-height: 100vh;
    }

    footer {
      position: relative;
      left: 0;
      bottom: 0;
      width: 100%;
    }
  </style>
</head>

<body>
  <div class="container mb-3">
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
            <div class="dropdown-center">
              <a class="link-dark" href="#" aria-label="Akun" data-bs-toggle="dropdown" aria-expanded="false">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-person" viewBox="0 0 16 16">
                  <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6Zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0Zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4Zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10Z" />
                </svg>
              </a>
              <ul class="dropdown-menu mt-3">
                <li><a class="dropdown-item" href="user.php">My Account</a></li>
                <li><a class="dropdown-item" href="#">My Orders</a></li>
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

  <section id="ordered" class="container mt-4">
    <h4 class="mb-4">My Orders</h4>

    <?php foreach ($orders as $order) : ?>
      <?php

      $status = '';

      if (isset($order['payment_status']) && $order['payment_status'] == 'waiting_for_payment') {
        $status = 'Waiting for Payment';
      } elseif (isset($order['order_status']) && $order['order_status'] == 'waiting_for_acc') {
        $status = 'Waiting for Acc';
      } elseif (isset($order['order_status']) && $order['order_status'] == 'accepted') {
        $status = 'Confirmed';
      } elseif (isset($order['order_status']) && $order['order_status'] == 'declined') {
        $status = 'Declined';
      }


      $items = getOrderItemByOrderId($order['order_id'], $order_items);
      foreach ($items as $item) : ?>
        <?php $product = getProductById($item['product_id'], $products); ?>
        <div class="border d-flex align-items-center p-3 row">
          <div class="ms-2 col-2">
            <img style="max-height: 80px;" src="upload/<?= $product['product_image']; ?>" class="card-img-top" alt="Product 1">
          </div>
          <div class="ms-4 col-2">
            <h5 class="card-title mb-0"><?= $product['product_title']; ?></h5>
            <?php $total_price = $product['product_price'] * $item['quantity']; ?>
            <p class="card-text">Rp <?= number_format($total_price, 0, ',', '.'); ?></p>
          </div>
          <div class="mx-5 col-4 mt-3 d-flex justify-content-between flex-fill">
            <p><strong>QTY:</strong> <?= $item['quantity']; ?></p>
            <?php $category = getCategoryById($product['category_id'], $categories); ?>
            <p><strong>Category:</strong> <?= $category['category_name']; ?></p>
            <p><strong>Size:</strong> <?= $item['size']; ?></p>
            <p><strong>Date Ordered:</strong> <?= date('Y-m-d H:i:s', strtotime($order['order_date'])); ?></p>
            <p><strong>Status:</strong>
              <?php if (isset($order['payment_status']) && $order['payment_status'] == 'waiting_for_payment') : ?>
                <a href="payment.php?id=<?= $order['order_id']; ?>"><?= $status; ?></a>
              <?php else : ?>
                <?= $status; ?>
              <?php endif; ?>
            </p>
          </div>
        </div>
      <?php endforeach; ?>
    <?php endforeach; ?>

  </section>

  <?php include("include/footer.php"); ?>
  <script src="js/script.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js" integrity="sha384-fbbOQedDUMZZ5KreZpsbe1LCZPVmfTnH7ois6mU1QK+m14rQ1l2bGBq41eYeM/fS" crossorigin="anonymous"></script>



</body>

</html>