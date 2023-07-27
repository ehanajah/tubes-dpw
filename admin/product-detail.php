<?php

include("static-data.php");
include("include/functions.php");
include("include/header.php");

// // Memeriksa peran admin dan mengalihkan jika bukan admin
// checkAdminRole();

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $product_id = intval($id);
}
$product = getProductById($product_id, $products);
$product_stocks = getProductStocks($product_id, $product_stocks);

?>

<div class="container">
    <!-- Data User -->
    <div class="d-flex row mx-4 mt-4 mb-5 justify-content-between">
        <div class="col-6 table-responsive">
            <h2 colspan="6" class="mx-4 mb-4">Detail Produk</h2>
            <div class="border px-4 py-4 my-3">
                <img src="https://source.unsplash.com/random/40×40/?tshirt" class="shadow-sm rounded-0 mx-auto d-block my-4" style="width: 400px; height: 400px;">
                <div class="row mx-5">
                    <table class="table my-5">
                        <tr>
                            <th scope="col">Nama</th>
                            <td class="fs-6"><?= $product['product_title']; ?></td>
                        </tr>
                        <tr>
                            <th scope="col">Harga</th>
                            <td>
                                <?php $price = $product['product_price']; ?>
                                Rp <?= number_format($price, 0, ',', '.'); ?>
                            </td>
                        </tr>
                        <tr>
                            <th scope="col">Deskripsi</th>
                            <td><?= $product['product_desc']; ?></td>
                        </tr>
                    </table>
                    <div class="my-4 d-flex justify-content-end">
                        <!-- Button edit produk -->
                        <button type="button" class="btn btn-primary rounded-0 mx-1" data-bs-toggle="modal" data-bs-target="#editProdukModal_<?= $product["product_id"]; ?>">
                            Edit
                        </button>
                        <a href="#" class="btn btn-danger rounded-0 mx-1">Hapus</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-4">
            <div class="border">
                <div class="mx-4 my-4">
                    <div class="row mx-3">
                        <h4 class="mx-3 my-4">Stok</h4>
                        <hr>
                        <table class="table my-5">
                            <thead>
                                <tr>
                                    <th scope="col">Ukuran</th>
                                    <th scope="col">Jumlah stok</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($product_stocks as $product_stock) : ?>
                                    <tr>
                                        <th scope="col"><?= $product_stock['product_size']; ?></th>
                                        <td class="fs-6"><?= $product_stock['product_stock']; ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                        <!-- Button edit stok -->
                        <button type="button" class="btn btn-primary rounded-0 my-2 mb-3" data-bs-toggle="modal" data-bs-target="#editStokModal_<?= $product_stock["product_id"]; ?>">
                            Edit
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include("include/footer.php"); ?>

<!-- Modal edit produk-->
<div class="modal fade" id="editProdukModal_<?= $product["product_id"]; ?>" tabindex="-1" aria-labelledby="editProdukModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="editProdukModalLabel">Edit Produk</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="" method="post">
                <div class="modal-body">
                    <input type="hidden" name="produk_id" value="<?= $product["product_id"]; ?>">
                    <div class="mb-3">
                        <label for="title" class="form-label">Nama</label>
                        <input type="text" class="form-control" id="title" name="title" value="<?= $product["product_title"]; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="price" class="form-label">Harga</label>
                        <input type="number" class="form-control" id="price" name="price" value="<?= $product["product_price"]; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="desc" class="form-label">Deskripsi</label>
                        <input type="text" class="form-control" id="desc" name="desc" value="<?= $product["product_desc"]; ?>">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="Submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal edit stok-->
<?php 

$s_stock = '';
$m_stock = '';
$l_stock = '';

foreach ($product_stocks as $product_stock) {
    if ($product_stock['product_size'] == 's') {
        $s_stock = $product_stock['product_stock'];
    } elseif ($product_stock['product_size'] == 'm') {
        $m_stock = $product_stock['product_stock'];
    } elseif ($product_stock['product_size'] == 'l') {
        $l_stock = $product_stock['product_stock'];
    }
} 

?>

    <div class="modal fade" id="editStokModal_<?= $product_stock["product_id"]; ?>" tabindex="-1" aria-labelledby="editStokModalLabel" aria-hidden="true">
        <!-- Modal content here -->
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="editStokModalLabel">Modal title</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="" method="post">
                    <div class="modal-body">
                        <input type="hidden" name="produk_id" value="<?= $product["product_id"]; ?>">
                        <div class="row mx-2 my-2">
                            <label for="price" class="form-label col">Size</label>
                            <label for="price" class="form-label col">Jumlah Stok</label>
                        </div>
                        <div class="row mx-2 my-2">
                            <label for="price_s" class="form-label col">S</label>
                            <input type="number" class="form-control col" id="price_s" name="stock_s" value="<?= $s_stock ?>">
                        </div>
                        <div class="row mx-2 my-2">
                            <label for="price_m" class="form-label col">M</label>
                            <input type="number" class="form-control col" id="price_m" name="stock_m" value="<?= $m_stock ?>">
                        </div>
                        <div class="row mx-2 my-2">
                            <label for="price_l" class="form-label col">L</label>
                            <input type="number" class="form-control col" id="price_l" name="stock_l" value="<?= $l_stock ?>">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
