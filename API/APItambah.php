<?php
header("Access-Control-Allow-Origin: *");
header("Cache-Control: no-cache, no-store, max-age=0, must-revalidate");
header("X-Content-Type-Options: nosniff");

include("../koneksi/koneksi.php");

if(isset($_POST["nama"], $_POST["alamat"], $_POST["tanggal_lahir"], $_FILES['img'])) {
    $nama = $_POST["nama"];
    $alamat = $_POST["alamat"];
    $tanggal_lahir = $_POST["tanggal_lahir"];
    $namafile = $_FILES['img']['name'];
    $tmp_name = $_FILES['img']['tmp_name'];

    // Check if the 'archive' directory exists, create it if not
    if (!is_dir('archive')) {
        mkdir('archive', 0755, true);
    }

    try {
        move_uploaded_file($tmp_name, 'archive/'.$namafile);

        $statement = $koneksi->prepare("INSERT INTO tbl_peserta (id, nama, alamat, img, tanggal_lahir) VALUES (NULL,?,?,?,?)");
        $statement->execute([$nama, $alamat, 'archive/' . $namafile, $tanggal_lahir]);

        $pesan = "Data peserta berhasil ditambah";
        echo $pesan;
    } catch (PDOException $e) {
        // This will catch any PDOExceptions
        echo "Database error: " . $e->getMessage();
    } catch (Exception $e) {
        // This will catch any general exceptions
        echo "General error: " . $e->getMessage();
    }
} else {
    echo "Invalid request. Please make sure all required fields are filled.";
}
?>
