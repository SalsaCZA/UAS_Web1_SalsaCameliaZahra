

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/login.css">
    <title>SALSA CAMELIA ZAHRA - Login</title>
</head>
<body>
    <header>
        <nav>
            <div class="logo">LOGIN LES ONLINE BAHASA INGGRIS</div>
            <ul class="nav-links">
                <li><a href="home.php">Home</a></li>
                <li><a href="register.php">Register</a></li>
                <!-- Add more navigation links as needed -->
            </ul>
        </nav>
    </header>

    <main>
        <div class="container">
            <div class="login-container">
            <form id="login-form" class="form" action="login.php" method="post">
                    <h2>Login</h2>
                    <label for="username">Username:</label>
                    <input type="text" id="username" name="username" class="username" required>
                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password" class="password" required>
                    <button type="button" class="btn btn-primary mt-3" onclick="Login()">Login</button>
                </form>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer id="footer">
        <p class="copyright">&copy; 21552011135_SALSA CAMELIA ZAHRA_TIFRP221PB_UASWEB1</p>

    </footer>

    <!--  script -->
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script>
        function Login() {
            //mendapatkan nilai dari form
            const username = document.getElementById('username').value;
            const password = document.getElementById('password').value;

            //membuat object form data
            const formData = new FormData();
            formData.append('username', username);
            formData.append('password', password);

            //konfigurasi axios
            axios.post('https://salsacameliazahra.000webhostapp.com/API/APIlogin.php',formData)
            .then(response => {
                console.log(response)
                //handle respon dari server
                if(response.data.status == 'success') {
                    //jika login berhasil buka dashboard
                    const sessionToken = response.data.session_token;
                    localStorage.setItem('session_token',sessionToken);
                    window.location.href = 'index.php';
                } else {
                    //jika gagal
                    alert('Login Failed. Please check your credentials.');
                }
            })
            .catch(error => {
                //handle kesalahan koneksi server
                console.error('Error during login:',error);
            });
        }
    </script>

</body>
</html>
