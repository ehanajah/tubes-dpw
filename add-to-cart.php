<?php  
session_start();
include('include/functions.php');
include('include/data.php');


$user_id = $_SESSION['user_id'];
$carts = getCartsByUserId($user_id, $carts);

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $product_id = $_POST['id'];
    $size = $_POST['btnradio'];
    $qty = $_POST['qty'];

    foreach ($carts as $cart) {
        if ($cart['user_id'] == $user_id && $cart['product_id'] == $product_id && $cart['selected_size'] == $size) {
            $_SESSION['item_already_exists'] = "Item already exists in your cart!";
            header("Location: detail.php?id=$product_id");
            exit();
        }
    }

    include('include/config.php');

    // Prepare query
    $query = "INSERT INTO cart (user_id, product_id, selected_size, quantity) VALUES (?, ?, ?, ?)";

    $stmt = $conn->prepare($query);
    $stmt->bind_param("iisi", $user_id, $product_id, $size, $qty);

    // jika berhasil maka dialihkan ke halaman produk
    if ($stmt->execute()) {
        $_SESSION['add_to_cart_successful'] = "Item has been added into cart!";
        header("Location: detail.php?id=$product_id");
        exit();
    } else {
        echo "Error executing query: " . $stmt->error;
    }

    $stmt->close();
}