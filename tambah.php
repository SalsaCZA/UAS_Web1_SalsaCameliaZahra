<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Peserta</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link href="css/tambah.css" rel="stylesheet">
</head>

<body>
    <nav class="navbar navbar-expand-md mb-5">
        <div class="container-fluid mx-auto">
            <a class="navbar-brand" href="#">LES BAHASA INGGRIS ONLINE</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="tampil.php">Tampil</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="dashboard.php">Dashboard</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <h2 style="text-align: center; ">Tambah Peserta</h2>
    <form id="formTambahPeserta" enctype="multipart/form-data">
        <label for="nama">Nama:</label>
        <input type="text" id="nama" name="nama">

        <label for="alamat">Alamat:</label>
        <textarea id="alamat" name="alamat"></textarea>

        <label for="tanggal_lahir">Tanggal Lahir:</label>
        <input type="date" id="tanggal_lahir" name="tanggal_lahir">

        <label for="img">Gambar:</label>
        <input type="file" id="img" name="img">

        <button type="submit">Tambah Peserta</button>
    </form>

    <!-- Footer -->
    <footer id="footer" style="text-align: center; ">
        <p style="color: #777;">&copy; 21552011135_SALSA CAMELIA ZAHRA_TIFRP221PB_UASWEB1</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script>
        document.getElementById("formTambahPeserta").addEventListener("submit", function (event) {
            event.preventDefault();
            const formData = new FormData(this);

            axios.post('https://salsacameliazahra.000webhostapp.com/API/APItambah.php', formData, {
                headers: {
                    'Content-Type': 'multipart/form-data'
                }
            })
                .then(function (response) {
                    alert(response.data);
                    // Arahkan ke tampil.php jika sukses
                    window.location.href = 'tampil.php';
                })
                .catch(function (error) {
                    console.error('Error:', error);
                    alert("Terjadi kesalahan saat menambah peserta.");
                });
        });
    </script>
</body>

</html>