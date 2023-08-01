<?php require_once "../include/functions.php"; ?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Halaman Admin</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
  <style>
    .blog_post {
      background: #fff;
      width: 1100px;
      border-radius: 10px;
    }

    img {
      height: 8.3rem;
      width: 8.3rem;
      position: relative;
      border-radius: 100%;
      box-shadow: 1px 1px 2rem rgba(0, 0, 0, 0.3);
      z-index: 1;
    }
  </style>
</head>

<body class="row container-fluid">
  <!-- Sidebar -->
  <div class="d-flex flex-column flex-shrink-0 p-3 text-bg-dark sticky-top col-lg-2" style="height: 100vh; ">
    <a href="../index.php" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
      <span class="fs-4">Montego</span>
    </a>
    <hr>
    <ul class="nav nav-pills flex-column mb-auto">
      <li class="nav-item">
        <a href="index.php" class="nav-link text-white rounded-0 <?= isPageActive('index.php') ? 'active' : ''; ?>" <?= isPageActive('index.php') ? 'aria-current="page"' : ''; ?>>
          Dashboard
        </a>
      </li>
      <li>
        <a href="products.php" class="nav-link text-white rounded-0 <?= isPageActive('products.php') ? 'active' : ''; ?>" <?= isPageActive('products.php') ? 'aria-current="page"' : ''; ?>>
          Products
        </a>

      </li>
      <li>
        <a href="orders.php" class="nav-link text-white rounded-0 <?= isPageActive('orders.php') ? 'active' : ''; ?>" <?= isPageActive('orders.php') ? 'aria-current="page"' : ''; ?>>
          Orders
        </a>
      </li>
      <li>
        <a href="users.php" class="nav-link text-white rounded-0 <?= isPageActive('users.php') ? 'active' : ''; ?>" <?= isPageActive('users.php') ? 'aria-current="page"' : ''; ?>>
          Customers
        </a>
      </li>
    </ul>
    <hr>
    <strong><a class="text-decoration-none text-white" href="../logout.php">Sign out</a></strong>
  </div>

  <div class="col-lg-10">
    <nav class="row navbar bg-body-light border-bottom sticky-top bg-white">
      <div class="container">
        <?php if(!isPageActive('index.php')): ?>
        <a href="#" onclick="goBack()"><i class="bi bi-arrow-left-circle mx-3 fs-4 text-dark"></i></a>
        <?php endif; ?>
        <h2 class="mx-5 mt-2"><?= pageActiveName() ?></h2>
      </div>
    </nav>