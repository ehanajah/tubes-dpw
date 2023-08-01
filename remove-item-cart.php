<?php

session_start();

include('include/functions.php');
include('include/data.php');

$user_id = $_SESSION['user_id'];

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $product_id = $_POST['product_id'];
    $size = $_POST['size'];

    include('include/config.php');

    // Prepare query
    $query = "DELETE FROM cart WHERE user_id = ? AND product_id = ? AND selected_size = ?";

    $stmt = $conn->prepare($query);
    $stmt->bind_param("iis", $user_id, $product_id, $size);

    // jika berhasil maka dialihkan ke halaman produk
    if ($stmt->execute()) {
        $_SESSION['remove_from_cart_successful'] = "Item has removed from cart!";
        header("Location: cart.php");
        exit();
    } else {
        echo "Error executing query: " . $stmt->error;
    }

    $stmt->close();
}
