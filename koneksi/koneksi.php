<?php

$database_host = "localhost";
$database_username = "id21728417_salsa28";
$database_password = "PTT31224t_";
$database_name = "id21728417_salsacameliazahra";


$koneksi = mysqli_connect($database_host, $database_username, $database_password, $database_name);

if (!$koneksi) {
    die("Koneksi Gagal: " . mysqli_connect_error());
} else {
   
}
?>