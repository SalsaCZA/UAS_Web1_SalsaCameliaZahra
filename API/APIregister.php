<?php
include("../koneksi/koneksi.php");

// API endpoint for user registration
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Mengambil data dari form-data
    $username = $_POST['username'] ?? null;
    $password = $_POST['password'] ?? null;
    $name = $_POST['name'] ?? null;
    
    // Memeriksa apakah data yang dibutuhkan tersedia
    if ($username && $password && $name) {
        try {
            // Hashing password dengan SHA1
            $hashed_password = sha1($password);
            
            // Menyiapkan pernyataan SQL untuk INSERT
            $stmt = $koneksi->prepare("INSERT INTO tbl_user (username, password, name, session_token) VALUES (?, ?, ?, NULL)");
            $stmt->bind_param("sss", $username, $hashed_password, $name);
            $stmt->execute();
            $stmt->close();
            http_response_code(200);
            echo json_encode(array("message" => "User registered successfully"));
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode(array("error" => $e->getMessage()));
        }
    } else {
        // Jika data yang dibutuhkan tidak tersedia, kirim respons kesalahan
        http_response_code(400);
        echo json_encode(array("error" => "Missing parameters"));
    }
}
?>