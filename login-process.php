<?php

include("include/data.php");
include("include/functions.php");

session_start();

$email = $_POST['email'];
$password = $_POST['password'];

// Cari data pengguna berdasarkan email dari database
$user = getUserByEmail($email, $users);

if ($user !== null) {
    // Bandingkan password yang diinputkan dengan password yang telah dienkripsi di database
    if (password_verify($password, $user['password'])) {
        $_SESSION["username"] = $user["username"];
        $_SESSION["user_id"] = $user["user_id"];
        $_SESSION["role"] = $user["role"];

        if ($_SESSION["role"] == "admin") {
            header("Location: admin/index.php");
            exit();
        } else {
            header("Location: index.php");
            exit();
        }
    } else {
        // Jika password tidak sesuai, kembali ke halaman login
        $_SESSION['login_error'] = "Email or password is incorrect.";
        header("Location: login.php");
        exit();
    }
} else {
    // Jika pengguna tidak ditemukan, kembali ke halaman login
    $_SESSION['login_error'] = "Email or password is incorrect.";
    header("Location: login.php");
    exit();
}
?>
