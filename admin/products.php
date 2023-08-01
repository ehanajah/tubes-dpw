<?php
session_start();

include("../include/data.php");
include("../include/functions.php");
include("include/header.php");

// Memeriksa peran admin dan mengalihkan jika bukan admin
checkAdminRole();


// Mengurutkan data produk secara descending berdasarkan product_id
usort($products, function ($a, $b) {
    return $b['product_id'] - $a['product_id'];
});

?>

<div class="container">
    <div class="row mx-4 mt-4 mb-5">
        <div class="col-10">

            <?php if (isset($_SESSION['process_success'])) : ?>

                <div colspan="10" class="alert alert-success alert-dismissible fade show" role="alert">
                    <?= $_SESSION['process_success']; ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>

            <?php
                unset($_SESSION['process_success']);
            elseif (isset($_SESSION['delete_succesful'])) : ?>

                <div colspan="10" class="alert alert-success alert-dismissible fade show" role="alert">
                    <?= $_SESSION['delete_succesful']; ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>

            <?php
                unset($_SESSION['delete_succesful']);
            endif; ?>

            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Produk Id</th>
                        <th scope="col">Category</th>
                        <th scope="col">Name</th>
                        <th scope="col">Description</th>
                        <th scope="col">Price</th>
                    </tr>
                </thead>
                <tbody class="table-group-divider">
                    <?php if ($products != null) : ?>
                        <?php $num = 1; ?>
                        <?php foreach ($products as $product) : ?>
                            <tr>
                                <th scope="row">
                                    <?= $num; ?>
                                    <?php $num += 1; ?>
                                </th>
                                <td><?= $product['product_id']; ?></td>
                                <td>
                                    <?php $category = getCategoryById($product['category_id'], $categories); ?>
                                    <?= $category['category_name']; ?>
                                </td>
                                <td><?= $product['product_title']; ?></td>
                                <td>
                                    <div class="col-11 text-truncate"><?= $product['product_desc']; ?></div>
                                </td>
                                <td>
                                    <div class="col-11 text-truncate">
                                        <?php $price = $product['product_price']; ?>
                                        Rp <?= number_format($price, 0, ',', '.'); ?>
                                    </div>
                                </td>
                                <td><a class="text-decoration-none badge rounded-0 text-bg-primary" href="product-detail.php?id=<?= $product['product_id']; ?>">Details</a></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <tr>
                            <td colspan="4" class="text-center">No data</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>



        <!-- Button modal tambah produk -->
        <div class="col-1"></div>
        <button type="button" class="btn btn-primary my-4 col-1 rounded-0" style="height: fit-content;" data-bs-toggle="modal" data-bs-target="#tambahProdukModal">
            Add
        </button>
    </div>

    <?php include("include/footer.php"); ?>

    <!-- Modal tambah produk -->
    <div class="modal fade" id="tambahProdukModal" tabindex="-1" aria-labelledby="tambahProdukModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="tambahProdukModalLabel">Add Product</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="product/add.php" method="post" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="category" class="form-label">Categori</label>
                            <select class="form-select" id="category" name="category">
                                <option selected disabled>Choose category</option>
                                <option value="1">Shirt</option>
                                <option value="2">Pants</option>
                                <option value="3">Outer</option>
                                <option value="4">T-shirt</option>
                                <option value="5">Accessories</option>
                            </select>
                        </div>
                        <div class=" mb-3">
                            <label for="title" class="form-label">Name</label>
                            <input type="text" class="form-control" id="title" name="title">
                        </div>
                        <div class=" mb-3">
                            <label for="desc" class="form-label">Description</label>
                            <input type="text" class="form-control" id="desc" name="desc">
                        </div>
                        <div class=" mb-3">
                            <label for="price" class="form-label">Price</label>
                            <input type="number" class="form-control" id="price" name="price">
                        </div>
                        <div class=" mb-3">
                            <label for="image" class="form-label">Image</label>
                            <input type="file" class="form-control" id="image" name="image">
                        </div>
                        <label for=" stock" class="form-label">Stock</label>
                        <div class=" mb-3 border p-4">
                            <div class="row mx-2 my-2">
                                <label for="stock" class="form-label col">Size</label>
                                <label for="stock-amout" class="form-label col">Stock Amount</label>
                            </div>
                            <div class="row mx-2 my-2">
                                <label for="stock" class="form-label col">S</label>
                                <input type="number" class="form-control col" id="s_stock" name="s_stock" value="0">
                            </div>
                            <div class="row mx-2 my-2">
                                <label for="stock" class="form-label col">M</label>
                                <input type="number" class="form-control col" id="m_stock" name="m_stock" value="0">
                            </div>
                            <div class="row mx-2 my-2">
                                <label for="stock" class="form-label col">L</label>
                                <input type="number" class="form-control col" id="l_stock" name="l_stock" value="0">
                            </div>
                        </div>
                    </div>
                    <div class=" modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>