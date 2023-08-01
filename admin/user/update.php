<?php
session_start();
include "../../include/config.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // mengambil data dari inputan user
    $user_id = $_POST["user_id"];
    $first_name = $_POST["firstName"]; // Diubah menjadi $first_name
    $last_name = $_POST["lastName"]; // Diubah menjadi $last_name
    $username = $_POST["username"];
    $no_hp = $_POST["mobile"]; // Diubah menjadi $no_hp
    $email = $_POST["email"];

    // memperbarui data menggunakan prepared statement dengan bind parameter
    $query = "UPDATE users 
              SET first_name = ?, last_name = ?, username = ?, email = ?, mobile = ?
              WHERE user_id = ?";

    $stmt = $conn->prepare($query);
    $stmt->bind_param("sssssi", $first_name, $last_name, $username, $email, $no_hp, $user_id);

    // jika berhasil maka dialihkan ke halaman produk
    if ($stmt->execute()) {
        $_SESSION['user_update_successful'] = "User data updated successfully!";
        header("Location: ../user-detail.php?id=$user_id");
        exit();
    } else {
        echo "Error executing query: " . $stmt->error;
    }

    $stmt->close();
}
