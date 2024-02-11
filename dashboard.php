<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link href="css/dashboard.css" rel="stylesheet">
</head>


<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-md mb-5">
        <div class="container-fluid mx-auto">
            <a class="navbar-brand" href="#">DASHBOARD</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="tambah.php">Tambah Data</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="tampil.php">Tampil Data</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="ubahpassword.php">Ubah Password</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="report.php">Report</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="#" onclick="Logout()">Logout</a>
                    </li>

                </ul>
            </div>
        </div>
    </nav>
    <!-- End Navbar -->

    <!-- Menu Utama-->
    <div class="container">
        <div class="row">
            <div class="col">
                <h2 id="wellcomeMessage">Selamat Datang di Dashboard</h2>
                <!-- Your content here -->
                <p>"Tingkatkan kemampuan bahasa Inggris Anda dengan mudah melalui platform kami yang intuitif dan interaktif untuk les bahasa Inggris online."</p>
            </div>
            <div class="col">
                <!-- Add your image here -->
                <img src="images/gbr4.jpeg" alt="Image Description" class="img-fluid">
            </div>
        </div>
    </div>
    <!-- End Menu Utama-->



    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script>
        //console.log(localStorage.getItem('nama'));
        var welcomeMessage = 'Selamat Datang ' + localStorage.getItem('nama');
        document.getElementById('wellcomeMessage').innerText = welcomeMessage;
    </script>

    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script>
        function Logout() {
            axios.post('https://salsacameliazahra.000webhostapp.com/API/APIlogout.php', {
                // tambahkan data yang diperlukan untuk proses logout, seperti token atau informasi pengguna
            })
                .then(function (response) {
                    // handle response jika logout berhasil
                    console.log(response.data);
                    // contoh: redirect ke halaman login setelah logout berhasil
                    window.location.href = "home.php";
                })
                .catch(function (error) {
                    // handle error jika terjadi kesalahan saat melakukan logout
                    console.error(error);
                    // contoh: menampilkan pesan kesalahan kepada pengguna
                    alert('Logout gagal. Silakan coba lagi.');
                });
        }
    </script>


    <!-- Footer -->
    <footer id="footer">
        <p class="copyright">&copy; 21552011135_SALSA CAMELIA ZAHRA_TIFRP221PB_UASWEB1</p>

    </footer>
    <!-- Footer -->


</body>

</html>