<?php

include("static-data.php");
include("include/functions.php");
include("include/header.php");

// // Memeriksa peran admin dan mengalihkan jika bukan admin
// checkAdminRole();

?>

<div class="container mt-4">
    <div class="row mx-4 mt-4 mb-5">
        <div class="col-10">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Id Pemesanan </th>
                        <th scope="col">Pengguna</th>
                        <th scope="col">Total Harga</th>
                        <th scope="col">Tanggal</th>
                        <th scope="col">Status Order</th>
                        <th scope="col">Status Pembayaran</th>
                    </tr>
                </thead>
                <tbody class="table-group-divider">
                    <?php foreach ($orders as $order) : ?>
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
                            <td><?= $order['order_status']; ?></td>
                            <td><?= $order['payment_status']; ?></td>
                            <td><a class="text-decoration-none rounded-0 badge text-bg-primary" href="order-detail.php?id=<?= $order['order_id']; ?>">Detail</a></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <?php include("include/footer.php"); ?>