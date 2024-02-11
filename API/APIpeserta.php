<?php
header("Access-Control-Allow-Origin: *");
include('../koneksi/koneksi.php');

$keyword = isset($_GET["key"]) ? '%' . $_GET["key"] . '%' : '';

$statement = $koneksi->prepare("SELECT * FROM tbl_peserta WHERE nama LIKE ?");
$statement->bind_param("s", $keyword);
$statement->execute();

$result = $statement->get_result();

$data = array();
while ($row = $result->fetch_assoc()) {
    // Sesuaikan URL gambar dengan struktur direktori yang benar
    $row["img"] = "https://salsacameliazahra.000webhostapp.com//API/" . $row["img"];
    $data[] = $row;
}

// Jika tidak ada data yang ditemukan, Anda bisa memberikan respons khusus
if (empty($data)) {
    $data = array("message" => "Data not found");
}

header('Content-Type: application/json; charset=utf-8');
echo json_encode($data);
?>