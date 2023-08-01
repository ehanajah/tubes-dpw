<?php

session_start();

include('../../include/data.php');
include('../../include/functions.php');

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $order_id = $_POST['order_id'];
    $order_status = 'accepted';
    $order_items = getOrderItemByOrderId($order_id, $order_items);

    require('../../include/config.php');

    $query = "UPDATE orders SET order_status = ? WHERE order_id = ?";
    $query1 = "UPDATE product_stocks SET product_stock = ? WHERE product_id = ? AND product_size = ?";
    
    $stmt = $conn->prepare($query);
    $stmt->bind_param("si", $order_status, $order_id);

    if ($stmt->execute()) {

        foreach ($order_items as $order_item) {
            $product_id = $order_item['product_id'];
            $size = $order_item['size'];
            $stock = getProductStockWithSpecificSize($order_item['product_id'], $product_stocks, $size);
            $quantity = $order_item['quantity'];
            $newStock = $stock - $quantity;

            $stmt1 = $conn->prepare($query1);
            $stmt1->bind_param("iis", $newStock, $product_id, $size);

            try {
                $stmt1->execute();
            } catch (Exception $e) {
                die("Error executing query: " . $stmt1->error);
            }
        }

        // Setelah seluruh proses eksekusi produk berhasil selesai, simpan pesan konfirmasi
        $_SESSION['order_status_update'] = 'Order status updated, order processed!';

        // Arahkan admin kembali ke halaman referer
        if (isset($_SERVER['HTTP_REFERER'])) {
            $referer = $_SERVER['HTTP_REFERER'];
            header("Location: $referer");
        } else {
            // Jika tidak ada referer, arahkan ke halaman default (misalnya halaman index.php)
            header("Location: index.php");
        }
        exit();
    } else {
        die("Error executing query: " . $stmt->error);
    }

    $stmt->close();
    $stmt1->close();
}