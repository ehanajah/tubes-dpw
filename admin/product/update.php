<?php
session_start();

include("../../include/config.php");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // mengambil data dari inputan user dan membersihkannya dari karakter yang tidak diinginkan
    $product_id = $conn->real_escape_string($_POST["product_id"]);
    $title = $conn->real_escape_string($_POST["title"]);
    $price = $conn->real_escape_string($_POST["price"]);
    $desc = $conn->real_escape_string($_POST["desc"]);

    // menggunakan prepared statement dengan parameter binding untuk menghindari SQL injection
    $query = "UPDATE products SET product_title = ?, product_price = ?, product_desc = ? 
                WHERE product_id = ?";

    $stmt = $conn->prepare($query);
    $stmt->bind_param("sisi", $title, $price, $desc, $product_id);

    // melakukan update data produk
    if ($stmt->execute()) {
        // mengalihkan ke halaman detail produk
        $_SESSION['update_successful'] = "Data updated succesfully!";
        header("Location: ../product-detail.php?id=$product_id");
        exit();
    } else {
        echo "Error executing query: " . $stmt->error;
    }

    // Tutup prepared statement
    $stmt->close();
}
?>
