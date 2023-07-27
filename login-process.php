<?php

include("admin/static-data.php");
include("admin/include/functions.php");


session_start();

$email = $_POST['email'];
$password = $_POST['password'];

$user = login($email, $password, $users);

if ($user !== null) {
    $_SESSION["username"] = $user["username"];
    $_SESSION["user_id"] = $user["user_id"];
    $_SESSION["role"] = $user["role"];

    if ($_SESSION["role"] == "admin") {
        header("Location: admin/index.php");
        exit();
    } else {
        header("Location: index.php");
        exit();
    }
} else {
    header("Location: login.php");
    exit();
}
