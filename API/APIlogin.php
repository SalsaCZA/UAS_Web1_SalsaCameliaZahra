<?php 
header("Access-Control-Allow-Origin: *");
include ('../koneksi/koneksi.php');

$username = $_POST["username"];
$password = $_POST["password"];

if (isset($username) && isset($password)){

    //Mengambil data pengguna dari database berdasarkan username
    $statement = $koneksi->prepare("SELECT id, username, password FROM tbl_user WHERE username = ?");
    $statement->bind_param("s", $username); // Mengikat parameter menggunakan bind_param
    $statement->execute(); // Tidak ada argumen yang diberikan pada execute
    $result = $statement->get_result();
    $user = $result->fetch_assoc();

    //Verifikasi kata sandi dengan menggnakan SHA1
    if ($user && sha1($password) === $user['password']) {
        //ika verifikasi berhasil, buat token sesi baru 
        $session_token = bin2hex(random_bytes(16));

        //perbarui token sesi di database
        $updateStatement = $koneksi->prepare("UPDATE tbl_user SET session_token = ? WHERE id = ?");
        $updateStatement->bind_param("si", $session_token, $user['id']); // sesuaikan tipe data parameter dan ikat parameter
        $updateStatement->execute(); // tidak perlu memberikan argumen pada execute

        //Mengembalikan respon JSON sukses dengan tokenn sesi
        echo json_encode(['status' => 'success', 'session_token' => $session_token]);
    } else {
        // Jika verifikasi gagal, kirim pesan kesalahan
        echo json_encode(['status' => 'error', 'message' => 'Kredensial tidak valid']);
    }
}else{
    // Jika permintaan tidak valid, kirim pesan kesalah 
    echo json_encode(['status' => 'error', 'message' => 'Permintaan tidak valid']);
    
}
?>