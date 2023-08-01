<?php

session_start();

include('include/data.php');
include('include/functions.php');

$user_id = $_SESSION['user_id'];
$address = getAddressByUserId($user_id, $addresses);

// Struktur array input selected items
// $selected_items_data = [
//     [
//         'product_id' -> '1',
//         'selected_size' -> 's',
//         'quantity' -> '6'
//     ]
// ];

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Ambil nilai total harga dari input tersembunyi
    $total_price = $_POST["total_price"];

    // Ambil data produk yang dipilih dari input tersembunyi
    $selected_items_data = json_decode($_POST["selected_items_data"], true);

    $order_status = 'waiting_for_acc';
    $payment_status = 'waiting_for_payment';

    require('include/config.php');

    // menggunakan prepared statement dengan parameter binding untuk menghindari SQL injection
    $query = "INSERT INTO orders (user_id, total_amount, order_status, payment_status) VALUES (?, ?, ?, ?)";
    $query1 = "INSERT INTO order_items (order_id, user_id, product_id, quantity, price, size) VALUES (?, ?, ?, ?, ?, ?)";
    $query2 = "DELETE FROM cart WHERE user_id = ? AND product_id = ?";

    $stmt = $conn->prepare($query);
    $stmt->bind_param("iiss", $user_id, $total_price, $order_status, $payment_status);

    // eksekusi prepared statement
    if ($stmt->execute()) {
        // Get the mengambil order_id
        $order_id = $stmt->insert_id;


        foreach ($selected_items_data as $item) {
            $product_id = $item['product_id'];
            $selected_size = $item['selected_size'];
            $quantity = $item['quantity'];

            $product = getProductById($product_id, $products);
            $price = $product['product_price'];

            $stmt1 = $conn->prepare($query1);
            $stmt1->bind_param("iiiiis", $order_id, $user_id, $product_id, $quantity, $price, $selected_size);

            if ($stmt1->execute()) {
                $stmt2 = $conn->prepare($query2);
                $stmt2->bind_param("ii", $user_id, $product_id);

                if ($stmt2->execute()) {
                    header("Location: payment.php?id=$order_id");
                } else {
                    echo "Error executing query: " . $stmt2->error;
                }
            } else {
                echo "Error executing query: " . $stmt1->error;
            }
        }
        exit();
    } else {
        echo "Error executing query: " . $stmt->error;
    }

    // Tutup prepared statement
    $stmt->close();
    $stmt1->close();
    $stmt2->close();
}
