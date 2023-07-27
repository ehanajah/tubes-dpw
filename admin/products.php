<?php

include("static-data.php");
include("include/functions.php");
include("include/header.php");

// // Memeriksa peran admin dan mengalihkan jika bukan admin
// checkAdminRole();

?>


<div class="container">
    <div class="row mx-4 mt-4 mb-5">
        <div class="col-10">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Id Produk </th>
                        <th scope="col">Kategori</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Deskripsi</th>
                        <th scope="col">Harga</th>
                    </tr>
                </thead>
                <tbody class="table-group-divider">
                    <?php foreach ($products as $product) : ?>
                        <tr>
                            <th scope="row"><?= $product['product_id']; ?></th>
                            <td>
                                <?php $category = getCategoryById($product['category_id'], $categories); ?>
                                <?= $category['category_name']; ?>
                            </td>
                            <td><?= $product['product_title']; ?></td>
                            <td><?= $product['product_desc']; ?></td>
                            <td><?= $product['product_price']; ?></td>
                            <td><a class="text-decoration-none badge rounded-0 text-bg-primary" href="product-detail.php?id=<?= $product['product_id']; ?>">Detail</a></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>




        <!-- Button modal tambah produk -->
        <div class="col-1"></div>
        <button type="button" class="btn btn-primary my-4 col-1 rounded-0" style="height: fit-content;" data-bs-toggle="modal" data-bs-target="#tambahProdukModal">
            Tambah
        </button>
    </div>

    <?php include("include/footer.php"); ?>

    <!-- Modal tambah produk -->
    <div class="modal fade" id="tambahProdukModal" tabindex="-1" aria-labelledby="tambahProdukModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form method="post" action="">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="tambahProdukModalLabel">Tambah Data</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="" method="post">
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="category" class="form-label">Kategori</label>
                                <input type="text" class="form-control" id="category" name="category"">
                            </div>
                            <div class=" mb-3">
                                <label for="title" class="form-label">Nama</label>
                                <input type="text" class="form-control" id="title" name="title"">
                            </div>
                            <div class=" mb-3">
                                <label for="desc" class="form-label">Deskripsi</label>
                                <input type="text" class="form-control" id="desc" name="desc"">
                            </div>
                            <div class=" mb-3">
                                <label for="price" class="form-label">Harga</label>
                                <input type="number" class="form-control" id="price" name="price"">
                            </div>
                            <label for="stock" class="form-label">Stok</label>
                            <div class=" mb-3 border p-4">
                                <div class="row mx-2 my-2">
                                    <label for="stock" class="form-label col">Size</label>
                                    <label for="stock" class="form-label col">Jumlah Stok</label>
                                </div>
                                <div class="row mx-2 my-2">
                                    <label for="stock" class="form-label col">S</label>
                                    <input type="number" class="form-control col" id="s_stock" name="s_stock">
                                </div>
                                <div class="row mx-2 my-2">
                                    <label for="stock" class="form-label col">M</label>
                                    <input type="number" class="form-control col" id="m_stock" name="m_stock">
                                </div>
                                <div class="row mx-2 my-2">
                                    <label for="stock" class="form-label col">L</label>
                                    <input type="number" class="form-control col" id="l_stock" name="l_stock">
                                </div>
                            </div>
                        </div>
                        <div class=" modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </form>
        </div>
    </div>