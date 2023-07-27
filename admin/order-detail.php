<?php

include("static-data.php");
include("include/functions.php");
include("include/header.php");

// // Memeriksa peran admin dan mengalihkan jika bukan admin
// checkAdminRole();


if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $order_id = intval($id);
}

$order_items = getOrderItemByOrderId($order_id, $order_items);
$order = getOrderById($order_id, $orders);
$user = getUserById($order['user_id'], $users);
$address = getAddressById($order['address_id'], $addresses);

?>

<div class="container">
    <!-- Data User -->
    <div class="d-flex row mx-4 mt-4 mb-5 justify-content-between">
        <div class="col-6 table-responsive">
            <h2 colspan="6" class="mx-4 mb-4">Detail Order</h2>
            <table class="table table-borderless">
                <thead>
                    <tr>
                        <th scope="col">Produk</th>
                        <th scope="col">Jumlah</th>
                        <th scope="col">Harga</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($order_items != null) : ?>
                        <?php $total_price = 0; ?>
                        <?php foreach ($order_items as $order_item) : ?>
                            <?php $product = getProductById($order_item['product_id'], $products); ?>
                            <?php $total_amount = $order_item['price'] * $order_item['quantity']; ?>
                            <tr>
                                <td><?= $product['product_title']; ?></td>
                                <td><?= $order_item['quantity']; ?></td>
                                <td>Rp <?= number_format($total_amount, 0, ',', '.'); ?></td>
                            </tr>
                            <?php $total_price += $total_amount; ?>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <tr>
                            <td colspan="3" class="text-center">Tidak ada data</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
            <hr>
            <div class="d-flex justify-content-between">
                <h5>Total</h5>
                <h6>
                    <?php if ($total_price > 0) : ?>
                        Rp <?= number_format($total_price, 0, ',', '.'); ?>
                    <?php endif; ?>
                </h6>
            </div>
        </div>

        <div class="col-4">
            <div class="border">
                <div class="mx-4 my-4">
                    <h4 class="mx-3 my-4">Rincian</h4>
                    <hr>
                    <div class="row">
                        <h6 class="col">Id Pemesanan</h6>
                        <p class="col"><?= $order['order_id']; ?></p>
                    </div>
                    <div class="row">
                        <h6 class="col">Nama Penerima</h6>
                        <p class="col"><?= $user['username']; ?></p>
                    </div>
                    <div class="row">
                        <h6 class="col">Tanggal Pemesanan</h6>
                        <p class="col"><?= $order['order_date']; ?></p>
                    </div>
                    <div class="row">
                        <h6 class="col">Alamat</h6>
                        <div class="col">
                            <p><?= $address['city']; ?></p>
                            <p><?= $address['province']; ?></p>
                            <p><?= $address['zip']; ?></p>
                            <p><?= $address['address']; ?></p>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <h4 class="col">Status</h4>
                        <p class="col"><?= $order['order_status']; ?></p>
                    </div>
                    <?php if($order['order_status'] == 'waiting for acc'): ?>
                    <div class="row">
                        <div class="col"></div>
                        <div class="col">
                            <a class="btn btn-success rounded-0 text-decoration-none" href="#">Acc</a>
                            <a class="btn btn-danger rounded-0 text-decoration-none" href="#">Decline</a>
                        </div>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include("include/footer.php"); ?>