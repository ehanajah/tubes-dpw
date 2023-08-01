<?php
session_start();

include("../include/data.php");
include("../include/functions.php");
include("include/header.php");

// Memeriksa peran admin dan mengalihkan jika bukan admin
checkAdminRole();


if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $user_id = intval($id);
}
$user = getUserById($user_id, $users);
$orders = getOrdersByUserId($user_id, $orders);
$address = getAddressByUserId($user_id, $addresses);

?>

<div class="container">
    <!-- Data User -->
    <h2 class="mx-4 mt-4">User Detail</h2>
    <div class="row mx-4 mt-4 mb-5">

        <?php if (isset($_SESSION['user_update_successful'])) : ?>

            <div colspan="10" class="alert alert-success alert-dismissible fade show" role="alert">
                <?= $_SESSION['user_update_successful']; ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>

        <?php
            unset($_SESSION['user_update_successful']);
        endif; ?>

        <div class="col-6">
            <table class="table table-borderless">
                <tr>
                    <th scope="row" class="col-3">User Id</th>
                    <td><?= $user['user_id']; ?></td>
                </tr>
                <tr>
                    <th scope="row" class="col-3">Full Name</th>
                    <td><?= $user['first_name']; ?> <?= $user['last_name']; ?></td>
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
                    <th scope="row" class="col-3">Mobile</th>
                    <td><?= $user['mobile']; ?></td>
                </tr>
            </table>
            <div class="mt-5 row">
                <!-- Button modal edit user -->
                <button type="button" class="btn btn-success rounded-0 col-2" data-bs-toggle="modal" data-bs-target="#editUserModal_<?= $user["user_id"]; ?>">
                    Edit
                </button>
                <form id="deleteForm" action="user/delete.php" method="post" class="col">
                    <input type="hidden" id="user_id" name="user_id" value="<?= $user["user_id"]; ?>">
                    <button id="confirmButton" class="btn btn-danger rounded-0">Delete</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Alamat -->
    <h2 class="mx-4 mt-4">Address</h2>
    <div class="row mx-4 mt-4 mb-5">
        <div class="col-10 table-responsive">

            <?php if (isset($_SESSION['address_update_successful'])) : ?>

                <div colspan="10" class="alert alert-success alert-dismissible fade show" role="alert">
                    <?= $_SESSION['address_update_successful']; ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>

            <?php
                unset($_SESSION['address_update_successful']);
            endif; ?>

            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Address Id</th>
                        <th scope="col">City</th>
                        <th scope="col">Province</th>
                        <th scope="col">Zip</th>
                        <th scope="col"><Address></Address></th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody class="table-group-divider">
                    <?php if ($address != null) : ?>
                        <tr>
                            <th scope="row"><?= $address['address_id']; ?></th>
                            <td><?= $address['city']; ?></td>
                            <td><?= $address['province']; ?></td>
                            <td><?= $address['zip']; ?></td>
                            <td><?= $address['address']; ?></td>
                            <!-- Button modal edit alamat -->
                            <td><a class="badge text-bg-success rounded-0 text-decoration-none" data-bs-toggle="modal" data-bs-target="#editAddressModal" href="#" <?= $address['address_id']; ?>>Edit</a></td>
                        </tr>
                    <?php else : ?>
                        <tr>
                            <td colspan="4" class="text-center">No data</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Riwayat Pembelian -->
    <h2 class="mx-4 mt-4">Order History</h2>
    <div class="row mx-4 mt-4 mb-5">
        <div class="col-10 table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Order Id</th>
                        <th scope="col">Total Price</th>
                        <th scope="col">Date</th>
                        <th scope="col">Payment Status</th>
                    </tr>
                </thead>
                <tbody class="table-group-divider">
                    <?php if ($orders != null) : ?>
                        <?php foreach ($orders as $order): ?>
                            <tr>
                            <th scope="row"><?= $order['order_id']; ?></th>
                            <td><?= $order['total_amount']; ?></td>
                            <td><?= $order['order_date']; ?></td>
                            <td><?= $order['payment_status']; ?></td>
                            <td><a class="text-decoration-none badge text-bg-primary rounded-0" href="order-detail.php?id=<?= $order['order_id']; ?>">Detail</a></td>
                        </tr>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <tr>
                            <td colspan="4" class="text-center">No ada data</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const confirmButton = document.getElementById('confirmButton');
        confirmButton.addEventListener('click', function(e) {
            e.preventDefault();
            confirmAction('Are you sure?', "You won't be able to revert this!", 'Success!', 'Data deleted successfully.', this.form);
        });
    });
</script>
<?php include("include/footer.php"); ?>


<!-- Modal edit user -->
<div class="modal fade" id="editUserModal_<?= $user["user_id"]; ?>" tabindex="-1" aria-labelledby="editUserModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form method="post" action="user/update.php">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="editUserModalLabel">Edit Data</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="user_id" name="user_id" value="<?= $user["user_id"]; ?>">
                    <div class="mb-3">
                        <label for="firstName" class="form-label">First Name</label>
                        <input type="text" class="form-control" id="firstName" name="firstName" value="<?= $user['first_name']; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="lastName" class="form-label">First Name</label>
                        <input type="text" class="form-control" id="lastName" name="lastName" value="<?= $user['last_name']; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control" id="username" name="username" value="<?= $user['username']; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email address</label>
                        <input type="email" class="form-control" id="email" name="email" value="<?= $user['email']; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="mobile" class="form-label">Mobile</label>
                        <input type="number" class="form-control" id="mobile" name="mobile" value="<?= $user['mobile']; ?>">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Modal edit alamat -->
<div class="modal fade" id="editAddressModal" tabindex="-1" aria-labelledby="editAddressModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form method="POST" action="user/update-address.php">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="editAddressModalLabel">Edit Data</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="user_id" name="user_id" value="<?= $user["user_id"]; ?>">
                    <input type="hidden" id="address_id" name="address_id" value="<?= $address["address_id"]; ?>">
                    <div class="mb-3">
                        <label for="city" class="form-label">City</label>
                        <input type="text" class="form-control" id="city" name="city" value="<?= $address['city']; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="province" class="form-label">Province</label>
                        <input type="text" class="form-control" id="province" name="province" value="<?= $address['province']; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="zip" class="form-label">Zip</label>
                        <input type="text" class="form-control" id="zip" name="zip" value="<?= $address['zip']; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="address" class="form-label"><Address></Address></label>
                        <textarea class="form-control" id="address" rows="3" name="address"><?= $address['address']; ?></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </div>
            </div>
        </form>
    </div>
</div>