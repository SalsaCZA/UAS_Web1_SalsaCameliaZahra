<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ubah Password</title>
    <link href="css/ubah.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
        }

        .navbar-brand {
            font-size: 1.5rem;
        }

        #UserLogin {
            font-weight: bold;
        }

        footer {
            text-align: center;
            padding: 20px 0;
            background-color: #343a40;
            color: #fff;
        }

        footer p {
            margin: 0;
        }
    </style>
</head>

<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-md navbar-dark bg-dark mb-5">
        <div class="container-fluid">
            <a class="navbar-brand" href="#"><i class="bi bi-key"></i> Ubah Password</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="dashboard.php">Dashboard</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <h2>Selamat datang <span id="UserLogin"></span></h2>

        <!-- Formulir Ubah Password -->
        <form id="changePasswordForm">
            <div class="mb-3">
                <label for="currentPassword" class="form-label">Password Saat Ini</label>
                <input type="password" class="form-control" id="currentPassword" name="currentPassword" required>
            </div>
            <div class="mb-3">
                <label for="newPassword" class="form-label">Password Baru</label>
                <input type="password" class="form-control" id="newPassword" name="newPassword" required>
            </div>
            <button type="submit" class="btn btn-primary">Ubah Password</button>
        </form>
        <!-- End Formulir Ubah Password -->
    </div>

    <!-- Footer -->
    <footer id="footer">
        <p>&copy; 21552011135_SALSA CAMELIA ZAHRA_TIFRP221PB_UASWEB1</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script>
        var UserLogin = localStorage.getItem('nama');
        document.getElementById('UserLogin').innerText = UserLogin;

        function clearFormFields() {
            document.getElementById('currentPassword').value = '';
            document.getElementById('newPassword').value = '';
        }

        function changePassword(currentPassword, newPassword) {
            const sessionToken = localStorage.getItem('session_token');
            const formData = new FormData();
            formData.append('username', UserLogin);
            formData.append('currentPassword', currentPassword);
            formData.append('newPassword', newPassword);
            formData.append('session_token', sessionToken);

            axios.post('https://salsacameliazahra.000webhostapp.com/API/APIubah.php', formData)
                .then(response => {
                    if (response.data.status === 'success') {
                        alert('Password berhasil diubah');
                        clearFormFields();
                    } else {
                        alert('Gagal mengubah password: ' + response.data.message);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Terjadi kesalahan saat mengubah password');
                });
        }

        document.getElementById('changePasswordForm').addEventListener('submit', function (event) {
            event.preventDefault();
            const currentPassword = document.getElementById('currentPassword').value;
            const newPassword = document.getElementById('newPassword').value;
            changePassword(currentPassword, newPassword);
        });
    </script>

</body>

</html>
