<?php

session_start();

include('../../include/data.php');
include('../../include/functions.php');

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $order_id = $_POST['order_id'];
    $order_status = 'declined';

    require('../../include/config.php');

    $query = "UPDATE orders SET order_status = ? WHERE order_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("si", $order_status, $order_id);

    if ($stmt->execute()) {
        // Setelah proses eksekusi selesai, arahkan admin kembali ke halaman referer
        if (isset($_SERVER['HTTP_REFERER'])) {
            $referer = $_SERVER['HTTP_REFERER'];
            $_SESSION['order_status_update'] = 'Order status updated, order declined!';
            header("Location: $referer");
        } else {
            // Jika tidak ada referer, arahkan ke halaman default (misalnya halaman index.php)
            header("Location: index.php");
        }
    } else {
        echo "Error executing query: " . $stmt->error;
    }
    $stmt->close();
}
