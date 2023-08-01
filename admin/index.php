<?php
session_start();

include('../include/data.php');
include('../include/functions.php');
include('include/header.php');

// Memeriksa peran admin dan mengalihkan jika bukan admin
checkAdminRole();

$revenue = 0;
// Langkah 1: Mendapatkan order_id dari order dengan order_status "accepted"
$accepted_orders = array_filter($orders, function ($order) {
    return $order['order_status'] === 'accepted';
});

if (!empty($accepted_orders)) {
    $accepted_order_ids = array_column($accepted_orders, 'order_id');

    // Langkah 2: Menghitung total pendapatan dari order_items yang telah diterima
    foreach ($order_items as $order_item) {
        if (in_array($order_item['order_id'], $accepted_order_ids)) {
            $total_amount = $order_item['price'] * $order_item['quantity'];
            $revenue += $total_amount;
        }
    }
}

$waitingForAccOrders = [];

foreach ($orders as $order) {
    if ($order['order_status'] == 'waiting_for_acc' && $order['payment_status'] == 'paid') {
        $waitingForAccOrders[] = $order;
    }
}
?>

<div class="bg-body px-5">
    <div class="row navbar bg-body-light">
        <div class="container">
            <div class="row my-4">
                <div class="col-md-6">
                    <a href="orders.php" style="text-decoration: none;">
                        <div class="card mb-3 bg-primary text-white rounded-0" style="width: 540px; height: 120px;">
                            <div class="row g-0">
                                <div class="col-md-3">
                                    <i class="fa-solid fa-box-open mx-4 mt-4" style="color: #ffffff; font-size: 65px;"></i>
                                </div>
                                <div class="col-md-9">
                                    <div class="card-body">
                                        <h1 class="card-text"><?= count($orders); ?></h1>
                                        <h5 class="card-title">Total Orders</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>

                    <a href="orders.php" style="text-decoration: none;">
                        <div class="card mb-3 bg-success text-white rounded-0" style="width: 540px; height: 120px;">
                            <div class="row g-0">
                                <div class="col-md-3 text-center">
                                    <i class="fa-solid fa-coins mx-3 mt-4" style="color: #ffffff; font-size: 65px;"></i>
                                </div>
                                <div class="col-md-9 mt-1">
                                    <div class="card-body">
                                        <h2 class="card-text">Rp <?= number_format($revenue, 0, ',', '.'); ?></h1>
                                            <h5 class="card-title">Revenue</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>

                </div>
                <div class="col-md-6">
                    <a href="users.php" style="text-decoration: none;">
                        <div class="card mb-3 bg-warning text-light rounded-0" style="width: 540px; height:120px;">
                            <div class="row g-0">
                                <div class="col-md-3 text-center">
                                    <i class="fa-solid fa-user mx-5 mt-4" style="color: #ffffff; font-size: 65px;"></i>
                                </div>
                                <div class="col-md-9">
                                    <div class="card-body">
                                        <h1 class="card-text"><?= count($users); ?></h1>
                                        <h5 class="card-title">Total Users</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>

                    <a href="products.php" style="text-decoration: none;">
                        <div class="card mb-3 bg-danger text-light rounded-0" style="width: 540px; height:120px;">
                            <div class="row g-0">
                                <div class="col-md-3 text-center">
                                    <i class="fa-solid fa-shirt mx-4 my-4" style="color: #ffffff; font-size: 55px;"></i>
                                </div>
                                <div class="col-md-9">
                                    <div class="card-body">
                                        <h1 class="card-text"><?= count($products); ?></h1>
                                        <h5 class="card-title">Total Products</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>

                </div>
            </div>
        </div>

        <div class="container my-4">
            <div class="container pt-3 py-2">
                <h2>Newest Order</h2>
                <hr>
                <?php if (isset($_SESSION['order_status_update'])) : ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <?= $_SESSION['order_status_update']; ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php
                    unset($_SESSION['order_status_update']);
                endif; ?>
            </div>
            <?php if (!empty($waitingForAccOrders)) : ?>
                <?php foreach ($waitingForAccOrders as $waitingForAccOrder) : ?>
                    <?php $user = getUserById($waitingForAccOrder['user_id'], $users); ?>
                    <div class="blog_post mb-2 border rounded-0">
                        <div class="row mx-4">
                            <div class="col-md-8 py-3">
                                <div class="container_copy">
                                    <h4><?= $user['username']; ?></h4>
                                    <p style="margin-bottom: 4px;">Total items: <?= countOrderItemsByOrderId($order_items, $waitingForAccOrder['order_id']); ?></p>
                                    <p style="margin-bottom: 4px;">
                                        <?php $total = $waitingForAccOrder['total_amount']; ?>
                                        Total: Rp <?= number_format($total, 0, ',', '.'); ?>
                                    </p>
                                    <p></p>
                                    <a class="text-primary text-decoration-none" href='order-detail.php?id=<?= $waitingForAccOrder['order_id']; ?>'>
                                        <h6>Check Detail</p>
                                    </a>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="container mt-5  d-flex justify-content-end">
                                    <form action="order/proceed.php" method="post">
                                        <input type="hidden" id="order_id" name="order_id" value="<?= $waitingForAccOrder["order_id"]; ?>">
                                        <button type="submit" class="btn btn-success bt-lg rounded-0 me-2">Proceed</button>
                                    </form>
                                    <form id="declineForm" action="order/decline.php" method="post">
                                        <input type="hidden" id="order_id" name="order_id" value="<?= $waitingForAccOrder["order_id"]; ?>">
                                        <button id="declineConfirmButton" class="btn btn-outline-danger rounded-0">Decline</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
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