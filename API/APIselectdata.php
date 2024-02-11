<?php
header("Access-Control-Allow-Origin: *");

// Include the MySQLi connection file
include('../koneksi/koneksi.php');

$id = isset($_GET["id"]) ? $_GET["id"] : null;

try {
    $statement = $koneksi->prepare("SELECT * FROM tbl_peserta WHERE id = ?");
    $statement->bind_param('i', $id);
    $statement->execute();
    $result = $statement->get_result();

    $data = $result->fetch_assoc();

    if ($data) {
        echo json_encode($data);
    } else {
        echo json_encode(["error" => "Data not found"]);
    }
} catch (mysqli_sql_exception $cek_koneksi) {
    die('Error: ' . $cek_koneksi->getMessage());
}
?>