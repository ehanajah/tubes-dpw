<?php

// Fungsi untuk memeriksa halaman yang aktif
function isPageActive($page)
{
    $currentUrl = $_SERVER['PHP_SELF'];
    $currentPage = basename($currentUrl);

    return ($currentPage === $page);
}

function orderStatus($order)
{
    if ($order['order_status'] == 'waiting_for_acc') {
        return 'Waiting for Acc';
    } elseif ($order['order_status'] == 'accepted') {
        return 'Accepted';
    } else {
        return 'Declined';
    }
}

// Fungsi judul page
function pageActiveName()
{
    if (isPageActive("index.php")) {
        return "Dashboard";
    } elseif (isPageActive("users.php")) {
        return "Customers";
    } elseif (isPageActive("products.php")) {
        return "Products";
    } elseif (isPageActive("orders.php")) {
        return "Orders";
    } elseif (isPageActive("user-detail.php")) {
        return "Customer Detail Page";
    } elseif (isPageActive("order-detail.php")) {
        return "Order Detail Page";
    } elseif (isPageActive("product-detail.php")) {
        return "Product Detail Page";
    }
}

// Fungsi untuk memeriksa peran admin
function checkAdminRole()
{
    if (isset($_SESSION["role"])) {
        if ($_SESSION["role"] != "admin") {
            header("Location: ../index.php");
            exit();
        }
    } else {
        header("Location: ../index.php");
        exit();
    }
}
function isAdmin() {
    if (isset($_SESSION['role'])) {
        if ($_SESSION['role'] == 'admin') {
            return true;
        }
    }
}

// Fungsi memeriksa login session
function isLoggedIn() {
    if (isset($_SESSION['username'])) {
        return true;
    }
}

// Category function
function getCategoryById($categoryId, $categories)
{
    foreach ($categories as $category) {
        if ($category['category_id'] == $categoryId) {
            return $category;
        }
    }
    return null;
}

// User function
function getUserById($user_id, $users)
{
    foreach ($users as $user) {
        if ($user['user_id'] == $user_id) {
            return $user;
        }
    }
    return null;
}
function getUserByEmail($email, $users)
{
    foreach ($users as $user) {
        if ($user['email'] == $email) {
            return $user;
        }
    }
    return null;
}


// Order function
function getOrderById($order_id, $orders)
{
    foreach ($orders as $order) {
        if ($order['order_id'] == $order_id) {
            return $order;
        }
    }
    return null;
}
function getOrdersByUserId($user_id, $orders)
{
    $matchingOrders = array();

    foreach ($orders as $order) {
        if ($order['user_id'] == $user_id) {
            $matchingOrders[] = $order;
        }
    }
    return $matchingOrders;
}

// Order items function
function getOrderItemById($order_item_id, $order_items)
{
    foreach ($order_items as $order_item) {
        if ($order_item['order_item_id'] == $order_item_id) {
            return $order_item;
        }
    }
    return null;
}
function getOrderItemByOrderId($order_id, $order_items)
{
    $matchingOrderItem = array();

    foreach ($order_items as $order_item) {
        if ($order_item['order_id'] == $order_id) {
            $matchingOrderItem[] = $order_item;
        }
    }

    return $matchingOrderItem;
}

function countOrderItemsByOrderId($order_items, $order_id)
{
    $count = 0;
    foreach ($order_items as $order_item) {
        if ($order_item['order_id'] === $order_id) {
            $count += $order_item['quantity'];
        }
    }
    return $count;
}

// Address function
function getAddressById($address_id, $addresses)
{
    foreach ($addresses as $address) {
        if ($address['address_id'] == $address_id) {
            return $address;
        }
    }
    return null;
}
function getAddressByUserId($user_id, $addresses)
{
    foreach ($addresses as $address) {
        if ($address['user_id'] == $user_id) {
            return $address;
        }
    }
    return null;
}

// Product function
function getProductById($product_id, $products)
{
    foreach ($products as $product) {
        if ($product['product_id'] == $product_id) {
            return $product;
        }
    }
    return null;
}
function getProductsByOrderId($order_id, $products, $order_items) {
    $matchingProducts = array();
    $order_items = getOrderItemByOrderId($order_id, $order_items);

    foreach ($order_items as $order_item) {
        $product_id = $order_item['product_id'];
        $product = getProductById($product_id, $products);
        $matchingProducts[] = $product;
    }

    return $matchingProducts;
}
// function getProductWithSpecificCategory($category_id, $products) {
//     $matchingProducts = array();

//     foreach ($products as $product) {
//         $product['category_id'] = $category_id;
//         $matchingProducts[] = $product;
//     }

//     return $matchingProducts;
// }

// // Review function
// function getReviewtById($review_id, $reviews)
// {
//     foreach ($reviews as $review) {
//         if ($review['review_id'] == $review_id) {
//             return $review;
//         }
//     }
//     return null;
// }
// function getReviewsByUserId($user_id, $reviews)
// {
//     $matchingRevews = array();

//     foreach ($reviews as $review) {
//         if ($review['user_id'] == $user_id) {
//             $matchingRevews[] = $review;
//         }
//     }

//     return $matchingRevews;
// }

// Product stock function
function getProductStocks($product_id, $product_stocks)
{
    $matchingProductStocks = array();

    foreach ($product_stocks as $product_stock) {
        if ($product_stock['product_id'] == $product_id) {
            $matchingProductStocks[] = $product_stock;
        }
    }

    return $matchingProductStocks;
}
function getProductStockWithSpecificSize($product_id, $product_stocks, $size) {
    foreach ($product_stocks as $product_stock) {
        if ($product_stock['product_id'] == $product_id && $product_stock['product_size'] == $size) {
            return $product_stock['product_stock'];
        }
    }
    return null;
}

// Cart functions
function getCartsByUserId($user_id, $carts)
{
    $matchingCarts = array();

    foreach ($carts as $cart) {
        if ($cart['user_id'] == $user_id) {
            $matchingCarts[] = $cart;
        }
    }

    return $matchingCarts;
}
