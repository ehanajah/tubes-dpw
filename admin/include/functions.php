<?php

// Fungsi untuk memeriksa halaman yang aktif
function isPageActive($page)
{
    $currentUrl = $_SERVER['PHP_SELF'];
    $currentPage = basename($currentUrl);

    return ($currentPage === $page);
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
    } elseif(isPageActive("orders.php")) {
        return "Orders";
    } elseif(isPageActive("user-detail.php")) {
        return "Customer Detail Page";
    } elseif(isPageActive("order-detail.php")) {
        return "Order Detail Page";
    } elseif(isPageActive("product-detail.php")) {
        return "Product Detail Page";
    }
}

// Fungsi untuk memeriksa peran admin
function checkAdminRole()
{
    session_start();

    if ($_SESSION["role"] != "admin") {
        header("Location: ../index.php");
        exit();
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
        if ($user['user_id'] === $user_id) {
            return $user;
        }
    }
    return null;
}
function login($email, $password, $users)
{
    foreach ($users as $user) {
        if ($user['email'] == $email && $user['password'] == $password) {
            return $user;
        }
    }
    return null;
}


// Order function
function getOrderById($order_id, $orders)
{
    foreach ($orders as $order) {
        if ($order['order_id'] === $order_id) {
            return $order;
        }
    }
    return null;
}
function getOrderByUserId($user_id, $orders)
{
    foreach ($orders as $order) {
        if ($order['user_id'] === $user_id) {
            return $order;
        }
    }
    return null;
}

// Order items function
function getOrderItemById($order_item_id, $order_items)
{
    foreach ($order_items as $order_item) {
        if ($order_item['order_item_id'] === $order_item_id) {
            return $order_item;
        }
    }
    return null;
}
function getOrderItemByOrderId($order_id, $order_items)
{
    $matchingOrderItem = array();

    foreach ($order_items as $order_item) {
        if ($order_item['order_id'] === $order_id) {
            $matchingOrderItem[] = $order_item;
        }
    }

    return $matchingOrderItem;
}

function countOrderItemsByOrderId($order_items, $order_id) {
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
        if ($address['address_id'] === $address_id) {
            return $address;
        }
    }
    return null;
}
function getAddressByUserId($user_id, $addresses) 
{
    foreach ($addresses as $address) {
        if ($address['user_id'] === $user_id) {
            return $address;
        }
    }
    return null;
}
// function getAddressesByUserId($user_id, $addresses) 
// {
//     $matchingAddresses = array();

//     foreach ($addresses as $address) {
//         if ($address['user_id'] === $user_id) {
//             $matchingAddresses[] = $address;
//         }
//     }

//     return $matchingAddresses;
// }

// Product function
function getProductById($product_id, $products)
{
    foreach ($products as $product) {
        if ($product['product_id'] === $product_id) {
            return $product;
        }
    }
    return null;
}

// Review function
function getReviewtById($review_id, $reviews)
{
    foreach ($reviews as $review) {
        if ($review['review_id'] === $review_id) {
            return $review;
        }
    }
    return null;
}
function getReviewsByUserId($user_id, $reviews)
{
    $matchingRevews = array();

    foreach ($reviews as $review) {
        if ($review['user_id'] === $user_id) {
            $matchingRevews[] = $review;
        }
    }

    return $matchingRevews;
}

// Product stock function
function getProductStocks($product_id, $product_stocks)
{    
    $matchingProductStocks = array();

    foreach ($product_stocks as $product_stock) {
        if ($product_stock['product_id'] === $product_id) {
            $matchingProductStocks[] = $product_stock;
        }
    }

    return $matchingProductStocks;
}