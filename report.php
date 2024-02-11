<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Dummy Chart</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.4/xlsx.full.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <!-- pdfmake -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.68/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.68/vfs_fonts.js"></script>
    <link href="css/report.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-md navbar-dark bg-dark mb-5">
        <div class="container-fluid">
            <a class="navbar-brand" href="#"><i class="bi bi-key"></i> Laporan Pengguna</a>
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

    <canvas id="myChart" width="200" height="200"></canvas>
    <button onclick="downloadPDF()">Download PDF</button>
    <button onclick="downloadExcel()">Download Excel</button>

    <!-- Footer -->
    <footer id="footer">
        <p>&copy; 21552011135_SALSA CAMELIA ZAHRA_TIFRP221PB_UASWEB1</p>
    </footer>

    <script>
        // Generate dummy data
        const labels = ['January', 'February', 'March', 'April', 'May', 'June', 'July'];
        const data = {
            labels: labels,
            datasets: [{
                label: 'My Dataset',
                backgroundColor: 'rgb(255, 99, 132)',
                borderColor: 'rgb(255, 99, 132)',
                data: [0, 10, 5, 2, 20, 30, 45],
            }]
        };

        // Create chart
        const ctx = document.getElementById('myChart').getContext('2d');
        const myChart = new Chart(ctx, {
            type: 'line',
            data: data,
            options: {
                responsive: false, // Make the chart not responsive
            }
        });

        // Function to download PDF
        function downloadPDF() {
            const canvas = document.getElementById('myChart');
            const pdf = pdfMake.createPdf({
                content: [{
                    image: canvas.toDataURL(),
                    width: 200 // Adjust width as needed
                }]
            });
            pdf.download('chart.pdf');
        }

        // Function to download Excel
        function downloadExcel() {
            const ws = XLSX.utils.aoa_to_sheet([
                labels,
                data.datasets[0].data
            ]);
            const wb = XLSX.utils.book_new();
            XLSX.utils.book_append_sheet(wb, ws, "Chart Data");
            XLSX.writeFile(wb, 'chart.xlsx');
        }
    </script>
</body>
</html>
