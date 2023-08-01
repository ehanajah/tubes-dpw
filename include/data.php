<?php
include ("config.php");

// Query untuk mengambil data pengguna dari tabel "users"
$sqlUsers = "SELECT * FROM users";
$resultUsers = $conn->query($sqlUsers);

// Query untuk mengambil data pengguna dari tabel "cart"
$sqlCart = "SELECT * FROM cart";
$resultCart = $conn->query($sqlCart);

// Query untuk mengambil data alamat dari tabel "addresses"
$sqlAddresses = "SELECT * FROM addresses";
$resultAddresses = $conn->query($sqlAddresses);

// Query untuk mengambil data produk dari tabel "products"
$sqlProducts = "SELECT * FROM products";
$resultProducts = $conn->query($sqlProducts);

// Query untuk mengambil data stok produk dari tabel "product_stock"
$sqlProductStocks = "SELECT p.*, ps.product_size, ps.product_stock
FROM products p
INNER JOIN product_stocks ps ON p.product_id = ps.product_id";
$resultProductStocks = $conn->query($sqlProductStocks);

// Query untuk mengambil data kategori dari tabel "categories"
$sqlCategories = "SELECT * FROM categories";
$resultCategories = $conn->query($sqlCategories);

// Query untuk mengambil data pesanan dari tabel "orders"
$sqlOrders = "SELECT * FROM orders";
$resultOrders = $conn->query($sqlOrders);

// Query untuk mengambil data item pesanan dari tabel "order_items"
$sqlOrderItems = "SELECT * FROM order_items";
$resultOrderItems = $conn->query($sqlOrderItems);

// ... Query untuk mengambil data dari tabel-tabel lainnya ...

// Menutup koneksi ke database
$conn->close();

// Menginisialisasi array untuk menyimpan data
$users = array();
$carts = array();
$addresses = array();
$products = array();
$product_stocks = array();
$categories = array();
$orders = array();
$order_items = array();

// Memeriksa apakah ada data pengguna
if ($resultUsers !== false && $resultUsers->num_rows > 0) {
    // Loop untuk setiap baris dan mengambil data pengguna
    while ($row = $resultUsers->fetch_assoc()) {
        $users[] = $row;
    }
} else {
    $users = array();
}

// Memeriksa apakah ada data cart
if ($resultCart !== false && $resultCart->num_rows > 0) {
    // Loop untuk setiap baris dan mengambil data pengguna
    while ($row = $resultCart->fetch_assoc()) {
        $carts[] = $row;
    }
} else {
    $carts = array();
}

// Memeriksa apakah ada data alamat
if ($resultAddresses !== false && $resultAddresses->num_rows > 0) {
    // Loop untuk setiap baris dan mengambil data alamat
    while ($row = $resultAddresses->fetch_assoc()) {
        $addresses[] = $row;
    }
} else {
    $addresses = array();
}

// Memeriksa apakah ada data produk
if ($resultProducts !== false && $resultProducts->num_rows > 0) {
    // Loop untuk setiap baris dan mengambil data produk
    while ($row = $resultProducts->fetch_assoc()) {
        $products[] = $row;
    }
} else {
    $products = array();
}

// Memeriksa apakah ada data stok produk
if ($resultProductStocks !== false && $resultProductStocks->num_rows > 0) {
    // Loop untuk setiap baris dan mengambil data stok produk
    while ($row = $resultProductStocks->fetch_assoc()) {
        $product_stocks[] = $row;
    }
} else {
    $product_stocks = array();
}

// Memeriksa apakah ada data kategori
if ($resultCategories !== false && $resultCategories->num_rows > 0) {
    // Loop untuk setiap baris dan mengambil data kategori
    while ($row = $resultCategories->fetch_assoc()) {
        $categories[] = $row;
    }
} else {
    $categories = array();
}

// Memeriksa apakah ada data pesanan
if ($resultOrders !== false && $resultOrders->num_rows > 0) {
    // Loop untuk setiap baris dan mengambil data pesanan
    while ($row = $resultOrders->fetch_assoc()) {
        $orders[] = $row;
    }
} else {
    $orders = array();
}

// Memeriksa apakah ada data item pesanan
if ($resultOrderItems !== false && $resultOrderItems->num_rows > 0) {
    // Loop untuk setiap baris dan mengambil data item pesanan
    while ($row = $resultOrderItems->fetch_assoc()) {
        $order_items[] = $row;
    }
} else {
    $order_items = array();
}

