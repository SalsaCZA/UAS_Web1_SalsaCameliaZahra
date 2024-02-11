<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script>
        function checkSession() {
          //mendapatkan session_token
          const formData = new FormData();
          formData.append('session_token',localStorage.getItem('session_token'));

            //konfigurasi axios logout
            axios.post('https://salsacameliazahra.000webhostapp.com/API/APIsession.php',formData)
            .then(Response => {
                console.log(Response)
                //handle respon dari server
                if(Response.data.status === 'success') {
                    //jika login berhasil buka dashboard
                    const nama = Response.data.hasil.name || 'Default Name';
                    localStorage.setItem('nama',nama);
                    window.location.href = 'dashboard.php';
                } else {
                    //jika gagal
                    window.location.href = 'login.php';
                }
            })
            .catch(error => {
                //handle kesalahan koneksi server
                console.error('Error during login:',error);
            });
        }

        checkSession();
    </script>