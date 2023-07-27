<?php

include("static-data.php");
include("include/functions.php");
include("include/header.php");

// // Memeriksa peran admin dan mengalihkan jika bukan admin
// checkAdminRole();

?>

<div class="container">
    <div class="row mx-4 my-2">
        <div class="col-10">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Id Pengguna </th>
                        <th scope="col">Username</th>
                        <th scope="col">No Hp</th>
                        <th scope="col">Email</th>
                    </tr>
                </thead>
                <tbody class="table-group-divider">
                    <?php foreach ($users as $user) : ?>
                        <tr>
                            <th scope="row"><?= $user['user_id']; ?></th>
                            <td><?= $user['username']; ?></td>
                            <td><?= $user['mobile']; ?></td>
                            <td><?= $user['email']; ?></td>
                            <td>
                                <?php if ($user['role'] != 'admin'): ?>
                                    <a class="text-decoration-none rounded-0 badge text-bg-primary" href="user-detail.php?id=<?= $user['user_id']; ?>">Detail</a>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include("include/footer.php"); ?>