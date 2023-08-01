<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Ambil data dari form
    $category = $_POST["category"];
    $title = $_POST["title"];
    $desc = $_POST["desc"];
    $price = $_POST["price"];
    $s_stock = $_POST["s_stock"];
    $m_stock = $_POST["m_stock"];
    $l_stock = $_POST["l_stock"];

    // Penanganan unggah file
    $upload_dir = "../../upload/";
    $file_name = $_FILES["image"]["name"];
    $file_tmp = $_FILES["image"]["tmp_name"];
    $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
    $allowed_extensions = array("jpg", "jpeg", "png");

    if (!in_array($file_ext, $allowed_extensions)) {
        echo "Error: Hanya diperbolehkan file JPG, JPEG, dan PNG.";
        exit;
    }

    $product_image = uniqid() . "." . $file_ext;
    $upload_path = $upload_dir . $product_image;

    if (!move_uploaded_file($file_tmp, $upload_path)) {
        echo "Error: Gagal mengunggah gambar.";
        exit;
    }

    include('../../include/config.php');

    // Siapkan query
    $query = "INSERT INTO products (category_id, product_title, product_desc, product_price, product_image) VALUES (?, ?, ?, ?, ?)";

    // Siapkan pernyataan
    if ($stmt = $conn->prepare($query)) {
        // Bind parameter ke pernyataan
        $stmt->bind_param("issss", $category, $title, $desc, $price, $product_image);

        // Eksekusi pernyataan
        if ($stmt->execute()) {
            $size_s = "s";
            $size_m = "m";
            $size_l = "l";

            // Ambil ID produk yang baru saja dimasukkan
            $product_id = $conn->insert_id;

            // Proses masukkan data ke tabel "product_stock"
            $query_stock = "INSERT INTO product_stocks (product_id, product_size, product_stock) VALUES (?, ?, ?), (?, ?, ?), (?, ?, ?)";
            $stmt_stock = $conn->prepare($query_stock);
            $stmt_stock->bind_param("isiisiisi", $product_id, $size_s, $s_stock, $product_id, $size_m, $m_stock, $product_id, $size_l, $l_stock);
            if ($stmt_stock->execute()) {
                // Simpan pesan sukses di session
                $_SESSION['process_success'] = "Data baru telah ditambahkan!";

                // Alihkan ke halaman produk.php setelah berhasil memasukkan data
                header("Location: ../products.php");
                exit;
            } else {
                echo "Error executing query: " . $stmt_stock->error;
            }
        } else {
            echo "Error: " . $stmt->error;
        }

        // Tutup pernyataan
        $stmt->close();
    } else {
        echo "Error: " . $link->error;
    }

    // Tutup koneksi database
    $conn->close();
}
