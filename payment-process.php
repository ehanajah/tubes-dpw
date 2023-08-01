<?php 

session_start();

include('include/data.php');
include('include/functions.php');

$user_id = $_SESSION['user_id'];

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $address_id = $_POST['address_id'];
    $payment_status = 'paid';
    $order_id = $_POST['order_id'];

    require('include/config.php');

    $query = "UPDATE orders SET address_id = ?, payment_status = ? WHERE order_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("isi", $address_id, $payment_status, $order_id);

    if ($stmt->execute()) {
        header("Location: order.php");
    } else {
        echo "Error executing query: " . $stmt->error;
    }
    $stmt->close();
}