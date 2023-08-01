<?php
include("include/config.php");
include("include/functions.php");

session_start();

$user_id = $_SESSION['user_id'];

// Jika form update telah di-submit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];
    $address = $_POST['address'];
    $city = $_POST['city'];
    $province = $_POST['province'];
    $zip = $_POST['zip'];

    // Update data user
    $queryUpdateUser = "UPDATE users SET username=?, first_name=?, last_name=?, email=?, mobile=? WHERE user_id=?";
    $stmtUpdateUser = $conn->prepare($queryUpdateUser);
    $stmtUpdateUser->bind_param("sssssi", $username, $firstName, $lastName, $email, $mobile, $user_id);
    if ($stmtUpdateUser->execute()) {
        // Jika data user berhasil di-update, lanjutkan dengan update alamat
        $queryUpdateAddress = "UPDATE addresses SET address=?, city=?, province=?, zip=? WHERE user_id=?";
        $stmtUpdateAddress = $conn->prepare($queryUpdateAddress);
        $stmtUpdateAddress->bind_param("ssssi", $address, $city, $province, $zip, $user_id);
        if ($stmtUpdateAddress->execute()) {
            // Jika data alamat berhasil di-update, kembali ke halaman user
            $_SESSION['user_update_success'] = "Data updated successfully!";
            header("Location: user.php");
            exit;
        } else {
            echo "Error updating address: " . $stmtUpdateAddress->error;
        }
        $stmtUpdateAddress->close();
    } else {
        echo "Error updating user: " . $stmtUpdateUser->error;
    }
    $stmtUpdateUser->close();
}