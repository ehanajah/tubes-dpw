<?php
session_start();
include "../../include/config.php";

if (isset($_POST["product_id"])) {

    // mengambil data dari parameter url dan membersihkannya dari karakter yang tidak diinginkan
    $id = $conn->real_escape_string($_POST["product_id"]);

    // menghapus data menggunakan prepared statement dengan parameter binding untuk menghindari SQL injection
    $query = "DELETE FROM product_stocks WHERE product_id = ?";

    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id);

    // jika berhasil maka dialihkan ke halaman produk
    if ($stmt->execute()) {
        $query = "DELETE FROM products WHERE product_id = ?";

        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $id);

        if ($stmt->execute()) {
            $_SESSION['delete_succesful'] = "Product data deleted succesfully!";
            header("Location: ../products.php");
            exit();
        } else {
            echo "Error executing query: " . $stmt->error;
        }
    } else {
        echo "Error executing query: " . $stmt->error;
    }

    // Tutup prepared statement
    $stmt->close();
}
?>
