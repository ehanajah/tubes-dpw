<?php
session_start();

include("../include/data.php");
include("../include/functions.php");
include("include/header.php");

// Memeriksa peran admin dan mengalihkan jika bukan admin
checkAdminRole();

?>

<div class="container">
    <div class="row mx-4 my-2">
        <div class="col-10">

            <?php if (isset($_SESSION['delete_successful'])) : ?>

                <div colspan="10" class="alert alert-success alert-dismissible fade show" role="alert">
                    <?= $_SESSION['delete_successful']; ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>

            <?php
                unset($_SESSION['delete_successful']);
            endif; ?>

            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Usr Id</th>
                        <th scope="col">Username</th>
                        <th scope="col">Mobile</th>
                        <th scope="col">Email</th>
                    </tr>
                </thead>
                <tbody class="table-group-divider">
                    <?php if ($users != null) : ?>
                        <?php foreach ($users as $user) : ?>
                            <tr>
                                <th scope="row"><?= $user['user_id']; ?></th>
                                <td><?= $user['username']; ?></td>
                                <td><?= $user['mobile']; ?></td>
                                <td><?= $user['email']; ?></td>
                                <td>
                                    <?php if ($user['role'] != 'admin') : ?>
                                        <a class="text-decoration-none rounded-0 badge text-bg-primary" href="user-detail.php?id=<?= $user['user_id']; ?>">Detail</a>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <tr>
                            <td colspan="4" class="text-center">No data</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include("include/footer.php"); ?>