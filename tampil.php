<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Peserta</title>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
    <link href="css/tampil.css" rel="stylesheet">

    <!-- Tambahkan link CSS Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-md navbar-dark bg-dark mb-5">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">LES BAHASA INGGRIS ONLINE</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="tambah.php">Tambah data</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="dashboard.php">Dashboard</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <h2>Data Peserta</h2>
    <!-- Tambahkan atribut id pada elemen input pencarian -->
    <div>
        <label for="search">Cari Peserta:</label>
        <input type="text" id="search" name="search">
    </div>
    <br>
    <table id="pesertaTable" class="display" style="width:100%">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Alamat</th>
                <th>Gambar</th>
                <th>Tanggal Lahir</th>
                <th>Aksi</th> <!-- Kolom tambahan untuk tombol Edit dan Delete -->
            </tr>
        </thead>
        <tbody>
            <!-- Data will be populated by JavaScript -->
        </tbody>
    </table>

    <!-- Footer -->
    <footer id="footer">
        <p class="copyright">&copy; 21552011135_SALSA CAMELIA ZAHRA_TIFRP221PB_UASWEB1</p>
    </footer>

    <!-- Tambahkan script JavaScript Bootstrap dan jQuery -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

    <script>
        $(document).ready(function () {
            $('#pesertaTable').DataTable({
                "processing": true,
                "serverSide": true,
                "ajax": {
                    url: 'https://salsacameliazahra.000webhostapp.com/API/APIpeserta.php',
                    type: 'GET',
                    data: function (data) {
                        // Menggunakan nilai dari elemen input dengan id "search"
                        data.key = $('#search').val();
                    },
                    dataSrc: '' // Tidak ada manipulasi data, karena strukturnya sudah sesuai
                },
                "columns": [
                    { "data": "id" }, // Menampilkan kolom id
                    { "data": "nama" }, // Menampilkan kolom nama
                    { "data": "alamat" }, // Menampilkan kolom alamat
                    {
                        "data": "img",
                        "render": function (data, type, row) {
                            return '<img src="' + data + '" alt="Image" style="max-width: 100px; max-height: 100px;">';
                        }
                    },
                    { "data": "tanggal_lahir" }, // Menampilkan kolom tanggal_lahir
                    {
                        "data": null,
                        "render": function (data, type, row) {
                            return '<button onclick="editData(' + row.id + ')">Edit</button>' +
                                '<button onclick="deleteData(' + row.id + ')">Delete</button>';
                        }
                    } // Kolom untuk tombol Edit dan Delete
                ]
            });

            // Event listener untuk memuat ulang data tabel saat nilai pencarian berubah
            $('#search').keyup(function () {
                $('#pesertaTable').DataTable().draw();
            });
        });

        function editData(id) {
            // Fungsi untuk mengarahkan pengguna ke halaman edit dengan ID sebagai parameter
            window.location.href = 'edit_peserta.php?id=' + id;
        }

        function deleteData(id) {
            var formData = new FormData();
            formData.append('idnews', id);

            if (confirm("Apakah anda yakin ingin menghapus data peserta?")) {
                axios.post('https://salsacameliazahra.000webhostapp.com/API/APIdelete.php', formData)
                    .then(function (response) {
                        alert(response.data);
                        $('#pesertaTable').DataTable().ajax.reload();
                    })
                    .catch(function (error) {
                        console.error(error);
                        alert('Gagal menghapus data peserta.');
                    });
            }
        }
    </script>
</body>

</html>
