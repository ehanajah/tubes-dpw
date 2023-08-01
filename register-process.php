<?php
session_start();

include("include/data.php");
include("include/functions.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Periksa apakah password dan confirmPassword sama
    $confirmPassword = $_POST['confirmPassword'];
    $password = $_POST['password'];
    $email = $_POST['email'];

    foreach ($users as $user){
        if($email == $user['email']) {
            // Jika password dan confirmPassword tidak sama, kembali ke halaman registration.php dengan pesan kesalahan
            $_SESSION['registration_error_email'] = "An account with this email already exists.";
            header("Location: register.php");
            exit();
        }
    }

    if ($password !== $confirmPassword) {
        // Jika password dan confirmPassword tidak sama, kembali ke halaman registration.php dengan pesan kesalahan
        $_SESSION['registration_error_pass'] = "Confirmation password input is different with password input.";
        header("Location: register.php");
        exit();
    }

    include 'include/config.php';

    // Prepare the query using placeholders
    $query = "INSERT INTO users (role, username, email, password) VALUES ('user', ?, ?, ?)";

    // Prepare the statement
    if ($stmt = $conn->prepare($query)) {
        // Hash the password
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Bind parameters to the statement
        $stmt->bind_param("sss", $_POST['username'], $email, $hashedPassword);

        // Execute the statement
        if ($stmt->execute()) {
            // Get the user_id generated from the registration
            $user_id = $stmt->insert_id;

            // Insert empty data into addresses table with the corresponding user_id
            $addresses_query = "INSERT INTO addresses (user_id) VALUES (?)";
            $stmt_addresses = $conn->prepare($addresses_query);
            $stmt_addresses->bind_param("i", $user_id);
            $stmt_addresses->execute();

            // Store success message in session
            $_SESSION['registration_success'] = "Registration success, please log in!";

            // Redirect to login.php upon successful insertion
            header("Location: login.php");
            exit;
        } else {
            echo "Error: " . $stmt->error;
        }

        // Close the statement
        $stmt->close();
    } else {
        echo "Error: " . $conn->error;
    }

    // Close the database connection
    $conn->close();
}
