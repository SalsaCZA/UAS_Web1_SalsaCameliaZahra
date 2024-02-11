<?php
header("Access-Control-Allow-Origin: *");
include('../koneksi/koneksi.php');

$id = $_POST["id"];
$nama = $_POST["nama"];
$alamat = $_POST["alamat"];
$tanggal_lahir = $_POST["tanggal_lahir"];

// Periksa apakah file gambar dikirimkan
if (isset($_FILES['url_image']) && $_FILES['url_image']['error'] === UPLOAD_ERR_OK) {
    // File gambar dikirimkan, tangani unggahan
    $namafile = $_FILES['url_image']['name'];
    $tmp_name = $_FILES['url_image']['tmp_name'];
    $upload_directory = 'archive/';

    // Pindahkan file ke direktori yang ditentukan
    move_uploaded_file($tmp_name, $upload_directory . $namafile);

    // Update data dengan file gambar
    $statement = $koneksi->prepare("UPDATE tbl_peserta SET nama=?, alamat=?, img=?, tanggal_lahir=? WHERE id=?");
    $statement->execute([$nama, $alamat, $upload_directory . $namafile, $tanggal_lahir, $id]);
} else {
    // File gambar tidak dikirimkan, tangani tanpa file gambar
    $statement = $koneksi->prepare("UPDATE tbl_peserta SET nama=?, alamat=?, tanggal_lahir=? WHERE id=?");
    $statement->execute([$nama, $alamat, $tanggal_lahir, $id]);
}

$message = "Data berhasil diubah";
echo $message;
?>