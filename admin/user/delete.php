<?php
session_start();
include "../../include/config.php";

if (isset($_POST["user_id"])) {

    // mengambil data dari parameter url
    $id = $_POST["user_id"];

    // menggunakan prepared statement dengan parameter binding untuk menghindari SQL injection
    $query = "DELETE FROM addresses WHERE user_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id);

    // eksekusi prepared statement
    if ($stmt->execute()) {
        $query1 = "DELETE FROM cart WHERE user_id = ?";
        $stmt1 = $conn->prepare($query1);
        $stmt1->bind_param("i", $id);

        if ($stmt1->execute()) {
            $query2 = "DELETE FROM users WHERE user_id = ?";
            $stmt2 = $conn->prepare($query2);
            $stmt2->bind_param("i", $id);
            
            if ($stmt2->execute()) {
                // Jika ketiga query berhasil dieksekusi, alihkan ke halaman user
                $_SESSION['delete_successful'] = "User data deleted successfully!";
                header("Location: ../users.php");
                exit();
            } else {
                echo "Error executing query: " . $stmt2->error;
            }
        } else {
            echo "Error executing query: " . $stmt1->error;
        }
    } else {
        echo "Error executing query: " . $stmt->error;
    }

    // Tutup prepared statement
    $stmt->close();
    $stmt1->close();
    $stmt2->close();
}
