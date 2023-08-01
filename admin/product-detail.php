<?php
session_start();

include("../include/data.php");
include("../include/functions.php");
include("include/header.php");

// Memeriksa peran admin dan mengalihkan jika bukan admin
checkAdminRole();

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $product_id = intval($id);
} else {
    // Berikan nilai default jika $_GET['id'] tidak ada
    $product_id = null;
}

$product = getProductById($product_id, $products);
$product_stocks = getProductStocks($product_id, $product_stocks);

$s_stock = 0;
$m_stock = 0;
$l_stock = 0;

foreach ($product_stocks as $product_stock) {
    if ($product_stock['product_size'] == "s") {
        $s_stock = $product_stock['product_stock'];
    } elseif ($product_stock['product_size'] == 'm') {
        $m_stock = $product_stock['product_stock'];
    } elseif ($product_stock['product_size'] == 'l') {
        $l_stock = $product_stock['product_stock'];
    }
}

?>

<div class="container">
    <!-- Data User -->
    <div class="d-flex row mx-4 mt-4 mb-5 justify-content-between">
        <h2 colspan="6" class="mx-4 mb-4">Produck Detail</h2>

        <?php if (isset($_SESSION['update_successful'])): ?>

            <div colspan="10" class="alert alert-success alert-dismissible fade show" role="alert">
                <?= $_SESSION['update_successful']; ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>

        <?php
            unset($_SESSION['update_succesful']);
        elseif (isset($_SESSION['stock_update_successful'])): ?>

            <div colspan="10" class="alert alert-success alert-dismissible fade show" role="alert">
                <?= $_SESSION['stock_update_successful']; ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>

        <?php
            unset($_SESSION['stock_update_successful']);
        endif; ?>

        <div class="col-6 table-responsive">
            <div class="border px-4 py-4 my-3">
                <img src="../upload/<?= $product['product_image']; ?>" class="shadow-sm rounded-0 mx-auto d-block my-4 card-img-top" style="height: 400px;">
                <div class="row mx-5">
                    <table class="table my-5">
                        <tr>
                            <th scope="col">Name</th>
                            <td class="fs-6"><?= $product['product_title']; ?></td>
                        </tr>
                        <tr>
                            <th scope="col">Price</th>
                            <td>
                                <?php $price = $product['product_price']; ?>
                                Rp <?= number_format($price, 0, ',', '.'); ?>
                            </td>
                        </tr>
                        <tr>
                            <th scope="col">Description</th>
                            <td><?= $product['product_desc']; ?></td>
                        </tr>
                    </table>
                    <div class="my-4 d-flex justify-content-end">
                        <!-- Button edit produk -->
                        <button type="button" class="btn btn-primary rounded-0 mx-1" data-bs-toggle="modal" data-bs-target="#editProdukModal_<?= $product["product_id"]; ?>">
                            Edit
                        </button>
                        <form action="product/delete.php" method="post">
                            <input type="hidden" name="product_id" value="<?= $product["product_id"]; ?>">
                            <button type="submit" class="btn btn-danger rounded-0 mx-1">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-4">
            <div class="border py-4 my-3">
                <div class="mx-4 my-4">
                    <div class="row mx-3">
                        <h4 class="mx-3 my-4">Stock</h4>
                        <hr>
                        <table class="table my-5">
                            <thead>
                                <tr>
                                    <th scope="col">Size</th>
                                    <th scope="col">Stock Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="col">S</th>
                                    <td class="fs-6"><?= $s_stock; ?></td>
                                </tr>
                                <tr>
                                    <th scope="col">M</th>
                                    <td class="fs-6"><?= $m_stock; ?></td>
                                </tr>
                                <tr>
                                    <th scope="col">L</th>
                                    <td class="fs-6"><?= $l_stock; ?></td>
                                </tr>
                            </tbody>
                        </table>
                        <!-- Button edit stok -->
                        <button type="button" class="btn btn-primary rounded-0 my-2 mb-3" data-bs-toggle="modal" data-bs-target="#editStokModal_<?= $product["product_id"]; ?>">
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
            <form action="product/update.php" method="post">
                <div class="modal-body">
                    <input type="hidden" name="product_id" value="<?= $product["product_id"]; ?>">
                    <div class="mb-3">
                        <label for="title" class="form-label">Name</label>
                        <input type="text" class="form-control" id="title" name="title" value="<?= $product["product_title"]; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="price" class="form-label">Price</label>
                        <input type="number" class="form-control" id="price" name="price" value="<?= $product["product_price"]; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="desc" class="form-label">Description</label>
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
<div class="modal fade" id="editStokModal_<?= $product["product_id"]; ?>" tabindex="-1" aria-labelledby="editStokModalLabel" aria-hidden="true">
    <!-- Modal content here -->
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="editStokModalLabel">Modal title</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="product/update-stock.php" method="post">
                <div class="modal-body">
                    <input type="hidden" name="product_id" value="<?= $product["product_id"]; ?>">
                    <div class="row mx-2 my-2">
                        <label for="price" class="form-label col">Size</label>
                        <label for="price" class="form-label col">Stock Amount</label>
                    </div>
                    <div class="row mx-2 my-2">
                        <label for="price_s" class="form-label col">S</label>
                        <input type="number" class="form-control col" id="s_stock" name="s_stock" value="<?= $s_stock ?>">
                    </div>
                    <div class="row mx-2 my-2">
                        <label for="price_m" class="form-label col">M</label>
                        <input type="number" class="form-control col" id="m_stock" name="m_stock" value="<?= $m_stock ?>">
                    </div>
                    <div class="row mx-2 my-2">
                        <label for="price_l" class="form-label col">L</label>
                        <input type="number" class="form-control col" id="l_stock" name="l_stock" value="<?= $l_stock ?>">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>