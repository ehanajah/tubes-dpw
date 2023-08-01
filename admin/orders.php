<?php
session_start();

include("../include/data.php");
include("../include/functions.php");
include("include/header.php");

// Memeriksa peran admin dan mengalihkan jika bukan admin
checkAdminRole();

?>

<div class="container mt-4">
    <div class="row mx-4 mt-4 mb-5">
        <div class="col-10">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Order Id</th>
                        <th scope="col">Username</th>
                        <th scope="col">Total Price</th>
                        <th scope="col">Date</th>
                        <th scope="col">Order Status</th>
                        <th scope="col">Payment Status</th>
                    </tr>
                </thead>
                <tbody class="table-group-divider">
                    <?php if ($orders != null) : ?>
                        <?php foreach ($orders as $order) : ?>
                            <?php 
                                
                                ?>
                            <tr>
                                <th scope="row"><?= $order['order_id']; ?></th>
                                <td>
                                    <?php $user = getUserById($order['user_id'], $users); ?>
                                    <?= $user['username']; ?>
                                </td>
                                <td>
                                    <?php $total_amount = $order['total_amount']; ?>
                                    Rp <?= number_format($total_amount, 0, ',', '.'); ?>
                                </td>
                                <td><?= $order['order_date']; ?></td>
                                <td><?= orderStatus($order); ?></td>
                                <td><?= $order['payment_status']; ?></td>
                                <td><a class="text-decoration-none rounded-0 badge text-bg-primary" href="order-detail.php?id=<?= $order['order_id']; ?>">Detail</a></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <tr>
                            <td colspan="10" class="text-center">Tidak ada data</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <?php include("include/footer.php"); ?>