<?php
session_start();

include("../../include/config.php");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // mengambil data dari inputan user dan membersihkannya dari karakter yang tidak diinginkan
    $product_id = $conn->real_escape_string($_POST["product_id"]);
    $s_stock = $conn->real_escape_string($_POST["s_stock"]);
    $m_stock = $conn->real_escape_string($_POST["m_stock"]);
    $l_stock = $conn->real_escape_string($_POST["l_stock"]);

    // menggunakan prepared statement dengan parameter binding untuk menghindari SQL injection
    $query = "UPDATE product_stocks SET product_stock = ? WHERE product_id = ? AND product_size = ?";

    $stmt = $conn->prepare($query);

    // Bind parameter s
    $size_s = 's';
    $stmt->bind_param("iis", $s_stock, $product_id, $size_s);
    $stmt->execute();

    // Bind parameter m
    $size_m = 'm';
    $stmt->bind_param("iis", $m_stock, $product_id, $size_m);
    $stmt->execute();

    // Bind parameter l
    $size_l = 'l';
    $stmt->bind_param("iis", $l_stock, $product_id, $size_l);
    $stmt->execute();

    // jika berhasil, alihkan ke halaman detail produk
    $_SESSION['stock_update_successful'] = "Stock updated successfully!";
    header("Location: ../product-detail.php?id=$product_id");
    exit();

    // Tutup prepared statement
    $stmt->close();
}
