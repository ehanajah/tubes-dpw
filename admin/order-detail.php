<?php
session_start();

include("../include/data.php");
include("../include/functions.php");
include("include/header.php");

// Memeriksa peran admin dan mengalihkan jika bukan admin
checkAdminRole();


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
            <hr>
            <?php if (isset($_SESSION['order_status_update'])) : ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <?= $_SESSION['order_status_update']; ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php
                unset($_SESSION['order_status_update']);
            endif; ?>
            <table class="table table-borderless">
                <thead>
                    <tr>
                        <th scope="col">Product</th>
                        <th scope="col">Size</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Price</th>
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
                                <td><?= $order_item['size']; ?></td>
                                <td><?= $order_item['quantity']; ?></td>
                                <td>Rp <?= number_format($total_amount, 0, ',', '.'); ?></td>
                            </tr>
                            <?php $total_price += $total_amount; ?>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <tr>
                            <td colspan="3" class="text-center">No data</td>
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
                    <h4 class="mx-3 my-4">Detail</h4>
                    <hr>
                    <div class="row">
                        <h6 class="col">Order Id</h6>
                        <p class="col"><?= $order['order_id']; ?></p>
                    </div>
                    <div class="row">
                        <h6 class="col">Username</h6>
                        <p class="col"><?= $user['username']; ?></p>
                    </div>
                    <div class="row">
                        <h6 class="col">Order Date</h6>
                        <p class="col"><?= $order['order_date']; ?></p>
                    </div>
                    <div class="row">
                        <h6 class="col">Address</h6>
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
                        <p class="col"><?= orderStatus($order); ?></p>
                    </div>
                    <?php if ($order['order_status'] == 'waiting_for_acc') : ?>
                        <div class="row">
                            <div class="col d-flex justify-content-end">
                                <div class="d-flex">
                                    <form action="order/proceed.php" method="post" class="col">
                                        <input type="hidden" id="order_id" name="order_id" value="<?= $order["order_id"]; ?>">
                                        <button type="submit" class="btn btn-success rounded-0 me-2">Proceed</button>
                                    </form>
                                    <form id="declineForm" action="order/decline.php" method="post" class="col">
                                        <input type="hidden" id="order_id" name="order_id" value="<?= $order["order_id"]; ?>">
                                        <button id="declineConfirmButton" class="btn btn-outline-danger rounded-0">Decline</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const declineConfirmButton = document.getElementById('declineConfirmButton');
        declineConfirmButton.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            confirmAction('Are you sure?', "You won't be able to revert this!", 'Success!', 'Order declined successfully.', this.form);
        });
    });
</script>
<?php include("include/footer.php"); ?>