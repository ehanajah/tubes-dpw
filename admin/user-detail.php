<?php

include("static-data.php");
include("include/functions.php");
include("include/header.php");

// // Memeriksa peran admin dan mengalihkan jika bukan admin
// checkAdminRole();


if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $user_id = intval($id);
}
$user = getUserById($user_id, $users);
$order = getOrderByUserId($user_id, $orders);
$addresses = getAddressesByUserId($user_id, $addresses);
$reviews = getReviewsByUserId($user_id, $reviews);

?>

<div class="container">
    <!-- Data User -->
    <h2 class="mx-4 mt-4">Detail User</h2>
    <div class="row mx-4 mt-4 mb-5">
        <div class="col-6">
            <table class="table table-borderless">
                <tr>
                    <th scope="row" class="col-3">Id Pengguna</th>
                    <td><?= $user['user_id']; ?></td>
                </tr>
                <tr>
                    <th scope="row" class="col-3">Username</th>
                    <td><?= $user['username']; ?></td>
                </tr>
                <tr>
                    <th scope="row" class="col-3">Email</th>
                    <td><?= $user['email']; ?></td>
                </tr>
                <tr>
                    <th scope="row" class="col-3">No Hp</th>
                    <td><?= $user['mobile']; ?></td>
                </tr>
            </table>
            <div class="mt-5">
                <!-- Button modal edit user -->
                <button type="button" class="btn btn-success rounded-0" data-bs-toggle="modal" data-bs-target="#editUserModal">
                    Edit
                </button>
                <a href="#" class="btn btn-danger rounded-0">Hapus</a>
            </div>
        </div>
    </div>

    <!-- Alamat -->
    <h2 class="mx-4 mt-4">Alamat Terdaftar</h2>
    <div class="row mx-4 mt-4 mb-5">
        <div class="col-10 table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Id Address</th>
                        <th scope="col">Kabupaten / Kota</th>
                        <th scope="col">Provinsi</th>
                        <th scope="col">Kode Pos</th>
                        <th scope="col">Alamat</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody class="table-group-divider">
                    <?php if ($addresses != null) : ?>
                        <?php foreach ($addresses as $address) : ?>
                            <tr>
                                <th scope="row"><?= $address['address_id']; ?></th>
                                <td><?= $address['city']; ?></td>
                                <td><?= $address['province']; ?></td>
                                <td><?= $address['zip']; ?></td>
                                <td><?= $address['address']; ?></td>
                                <!-- Button modal edit alamat -->
                                <td><a class="badge text-bg-success rounded-0 text-decoration-none" data-bs-toggle="modal" data-bs-target="#editAddressModal" href="#" <?= $address['address_id']; ?>>Edit</a></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <tr>
                            <td colspan="4" class="text-center">Tidak ada data</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Riwayat Pembelian -->
    <h2 class="mx-4 mt-4">Riwayat Pembelian</h2>
    <div class="row mx-4 mt-4 mb-5">
        <div class="col-10 table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Id Pemesanan</th>
                        <th scope="col">Total Harga</th>
                        <th scope="col">Tanggal</th>
                        <th scope="col">Status Pembayaran</th>
                    </tr>
                </thead>
                <tbody class="table-group-divider">
                    <?php if ($order != null) : ?>
                        <tr>
                            <th scope="row"><?= $order['order_id']; ?></th>
                            <td><?= $order['total_amount']; ?></td>
                            <td><?= $order['order_date']; ?></td>
                            <td><?= $order['payment_status']; ?></td>
                            <td><a class="text-decoration-none badge text-bg-primary rounded-0" href="order-detail.php?id=<?= $order['order_id']; ?>">Detail</a></td>
                        </tr>
                    <?php else : ?>
                        <tr>
                            <td colspan="4" class="text-center">Tidak ada data</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Review -->
    <h2 class="mx-4 mt-4">Review</h2>
    <div class="row mx-4 mt-4 mb-5">
        <div class="col-10 table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Id Review</th>
                        <th scope="col">Produk</th>
                        <th scope="col">Rating</th>
                        <th scope="col">Comment</th>
                    </tr>
                </thead>
                <tbody class="table-group-divider">
                    <?php if ($reviews != null) : ?>
                        <?php foreach ($reviews as $review) : ?>
                            <tr>
                                <th scope="row"><?= $review['review_id']; ?></th>
                                <td>
                                    <?php $product = getProductById($review['product_id'], $products); ?>
                                    <?= $product['product_title']; ?>
                                </td>
                                <td><?= $review['rating']; ?>/5</td>
                                <td><?= $review['comment']; ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <tr>
                            <td colspan="4" class="text-center">Tidak ada data</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>


<?php include("include/footer.php"); ?>


<!-- Modal edit user -->
<div class="modal fade" id="editUserModal" tabindex="-1" aria-labelledby="editUserModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form method="post" action="">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="editUserModalLabel">Edit Data</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="produk_id" value="<?= $user["user_id"]; ?>">
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control" id="username" name="username" value="<?= $user['username']; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email address</label>
                        <input type="email" class="form-control" id="email" name="email" value="<?= $user['email']; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="mobile" class="form-label">No Hp</label>
                        <input type="number" class="form-control" id="mobile" name="mobile" value="<?= $user['mobile']; ?>">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Modal edit alamat -->
<?php foreach ($addresses as $address) : ?>
<div class="modal fade" id="editAddressModal" tabindex="-1" aria-labelledby="editAddressModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form method="post" action="">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="editAddressModalLabel">Edit Data</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="produk_id" value="<?= $address["address_id"]; ?>">
                    <div class="mb-3">
                        <label for="city" class="form-label">Kota / Kabupaten</label>
                        <input type="text" class="form-control" id="city" name="city" value="<?= $address['city']; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="province" class="form-label">Provinsi</label>
                        <input type="text" class="form-control" id="province" name="province" value="<?= $address['province']; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="zip" class="form-label">Kode Pos</label>
                        <input type="text" class="form-control" id="zip" name="zip" value="<?= $address['zip']; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="address" class="form-label">Alamat</label>
                        <textarea class="form-control" id="address" rows="3" name="address"><?= $address['address']; ?></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </div>
        </form>
    </div>
</div>
<?php endforeach; ?>