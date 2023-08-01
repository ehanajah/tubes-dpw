<?php
session_start();
include "../../include/config.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // mengambil data dari inputan user
    $user_id = $_POST["user_id"];
    $address_id = $_POST["address_id"];
    $city = $_POST["city"];
    $province = $_POST["province"];
    $zip = $_POST["zip"];
    $address = $_POST["address"];

    // memperbarui data menggunakan query sql
    $query = "UPDATE addresses SET city = ?, province = ?, zip = ?, address = ? 
              WHERE address_id = ?";

    // mempersiapkan prepared statement
    $stmt = $conn->prepare($query);

    // bind parameter ke prepared statement
    $stmt->bind_param("ssisi", $city, $province, $zip, $address, $address_id);

    // jika berhasil maka dialihkan ke halaman produk
    if ($stmt->execute()) {
        $_SESSION['address_update_successful'] = "User address updated successfully!";
        header("Location: ../user-detail.php?id=$user_id");
        exit();
    } else {
        echo "Error executing query: " . $stmt->error;
    }

    // menutup prepared statement
    $stmt->close();
}
?>
