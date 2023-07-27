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
              <div class="dropdown-center">
                <a class="link-dark" href="#" aria-label="Akun" data-bs-toggle="dropdown" aria-expanded="false">
                  <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-person" viewBox="0 0 16 16">
                    <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6Zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0Zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4Zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10Z"/>
                  </svg>
                </a>
                <ul class="dropdown-menu mt-3">
                  <li><a class="dropdown-item" href="#">My Account</a></li>
                  <li><a class="dropdown-item" href="#">My Orders</a></li>
                  <li><hr class="dropdown-divider"></li>
                  <li><a class="dropdown-item px-3" href="#">Sign Out</a></li>
                </ul>
              </div>
              <a class="link-dark" href="#" aria-label="Cart">
                <i class="bi bi-bag mx-3"></i>
              </a>
              <a class="btn btn-sm btn-dark" href="#">Sign In</a>
            </div>
          </div>
        </header>
      
        <div class="nav-scroller py-1 mb-2 border-bottom">
          <nav class="nav nav-underline justify-content-between">
            <a class="nav-item nav-link link-body-emphasis" href="index.html">Discover</a>
            <a class="nav-item nav-link link-body-emphasis" href="index.html #new">New Arrivals</a>
            <a class="nav-item nav-link link-body-emphasis" href="shop.html">All Products</a>
            <a class="nav-item nav-link link-body-emphasis" href="#">Exclusive</a>
            <a class="nav-item nav-link link-body-emphasis" href="#">Featured</a>
            <a class="nav-item nav-link link-body-emphasis" href="#">Collaboration</a>
          </nav>
        </div>
      </div>

      <section id="ordered" class="container mt-4">
        <h4 class="mb-4">My Orders</h4>
        <a class="text-decoration-none link-dark" href="#">
            <div class="border d-flex align-items-center p-3">
                <div class="ms-2">
                    <img style="max-height: 80px;" src="https://tinkerlust.s3.ap-southeast-1.amazonaws.com/products/c41dfe7e-a4a6-47ca-bde3-340b8da2b282/original/1280x1280/IMG_0033_18032-KO-356.JPG" class="card-img-top" alt="Product 1">
                </div>
                <div class="ms-4">
                    <h5 class="card-title mb-0">Basic T-Shirt</h5>
                    <p class="card-text">RP. 200.000</p>
                </div>
                <div class="mx-5 mt-3 d-flex justify-content-between flex-fill">
                    <p><strong>QTY:</strong> 1</p>
                    <p><strong>Category:</strong> T-Shirt</p>
                    <p><strong>Size:</strong> XXL</p>
                    <p><strong>Date Ordered:</strong> 12/08/2003</p>
                    <p><strong>Shipment Option:</strong> Express</p>
                    <p><strong>Status:</strong> Proceed</p>
                </div>
            </div>
        </a>
        <a class="text-decoration-none link-dark" href="#">
            <div class="border d-flex align-items-center p-3">
                <div class="ms-2">
                    <img style="max-height: 80px;" src="https://tinkerlust.s3.ap-southeast-1.amazonaws.com/products/c41dfe7e-a4a6-47ca-bde3-340b8da2b282/original/1280x1280/IMG_0033_18032-KO-356.JPG" class="card-img-top" alt="Product 1">
                </div>
                <div class="ms-4">
                    <h5 class="card-title mb-0">Basic T-Shirt</h5>
                    <p class="card-text">RP. 200.000</p>
                </div>
                <div class="mx-5 mt-3 d-flex justify-content-between flex-fill">
                    <p><strong>QTY:</strong> 1</p>
                    <p><strong>Category:</strong> T-Shirt</p>
                    <p><strong>Size:</strong> XXL</p>
                    <p><strong>Date Ordered:</strong> 12/08/2003</p>
                    <p><strong>Shipment Option:</strong> Express</p>
                    <p><strong>Status:</strong> Proceed</p>
                </div>
            </div>
        </a>
        <a class="text-decoration-none link-dark" href="#">
            <div class="border d-flex align-items-center p-3">
                <div class="ms-2">
                    <img style="max-height: 80px;" src="https://tinkerlust.s3.ap-southeast-1.amazonaws.com/products/c41dfe7e-a4a6-47ca-bde3-340b8da2b282/original/1280x1280/IMG_0033_18032-KO-356.JPG" class="card-img-top" alt="Product 1">
                </div>
                <div class="ms-4">
                    <h5 class="card-title mb-0">Basic T-Shirt</h5>
                    <p class="card-text">RP. 200.000</p>
                </div>
                <div class="mx-5 mt-3 d-flex justify-content-between flex-fill">
                    <p><strong>QTY:</strong> 1</p>
                    <p><strong>Category:</strong> T-Shirt</p>
                    <p><strong>Size:</strong> XXL</p>
                    <p><strong>Date Ordered:</strong> 12/08/2003</p>
                    <p><strong>Shipment Option:</strong> Express</p>
                    <p><strong>Status:</strong> Proceed</p>
                </div>
            </div>
        </a>
    </section>
      
      <footer class="py-5 text-center text-light bg-dark mt-5">
        <p>Blog template built for <a href="https://getbootstrap.com/">Bootstrap</a> by <a href="https://twitter.com/mdo">@mdo</a>.</p>
        <p class="mb-0">
          <a href="#">Back to top</a>
        </p>
      </footer>
      <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js" integrity="sha384-fbbOQedDUMZZ5KreZpsbe1LCZPVmfTnH7ois6mU1QK+m14rQ1l2bGBq41eYeM/fS" crossorigin="anonymous"></script>
  
      
  
  </body>
</html>

