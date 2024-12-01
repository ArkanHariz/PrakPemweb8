<?php
// Koneksi ke database
$servername = "localhost:3308";
$username = "root";
$password = "";
$dbname = "db_lomba";

// Membuat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Memeriksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Proses formulir jika ada data yang dikirim
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];

    // Query untuk menyimpan data
    $sql = "INSERT INTO peserta_lomba (nama, alamat) VALUES ('$nama', '$alamat')";
    
    if ($conn->query($sql) === TRUE) {
        echo "<div class='success'>Data berhasil ditambahkan!</div>";
    } else {
        echo "<div class='error'>Error: " . $sql . "<br>" . $conn->error . "</div>";
    }
}

$limit = 10; // Jumlah data per halaman
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$start = ($page - 1) * $limit;

// Query untuk mengambil data
$sql = "SELECT * FROM peserta_lomba LIMIT $start, $limit";
$result = $conn->query($sql);

// Hitung total baris
$totalResult = $conn->query("SELECT COUNT(*) as total FROM peserta_lomba");
$totalData = $totalResult->fetch_assoc()['total'];
$totalPages = ceil($totalData / $limit);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lomba - Data Tabel</title>
    <style>
        /* Umum */
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f7f9fc;
            margin: 0;
            padding: 0;
            color: #333;
        }

        h1, h2 {
            text-align: center;
            color: #4CAF50;
            font-family: 'Courier New', Courier, monospace;
        }

        .container {
            width: 80%;
            margin: 0 auto;
            padding: 20px;
        }

        .form-container {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-bottom: 30px;
        }

        input[type="text"] {
            width: 45%;
            padding: 10px;
            margin-right: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 14px;
        }

        button {
            padding: 10px 20px;
            background-color: #4CAF50;
            border: none;
            color: white;
            border-radius: 4px;
            cursor: pointer;
            font-size: 14px;
        }

        button:hover {
            background-color: #45a049;
        }

        .error {
            color: #f44336;
            background-color: #ffebee;
            padding: 10px;
            margin: 10px 0;
            border-radius: 4px;
        }

        .success {
            color: #4CAF50;
            background-color: #e8f5e9;
            padding: 10px;
            margin: 10px 0;
            border-radius: 4px;
        }

        /* Tabel */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        th, td {
            text-align: center;
            padding: 12px;
            border: 1px solid #ddd;
        }

        th {
            background-color: #4CAF50;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        /* Pagination */
        .pagination {
            text-align: center;
            margin-top: 20px;
        }

        .pagination a {
            padding: 10px 15px;
            margin: 5px;
            background-color: #4CAF50;
            color: white;
            text-decoration: none;
            border-radius: 4px;
        }

        .pagination a:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>

<div class="container">

    <h1>Formulir Lomba</h1>

    <div class="form-container">
        <form method="POST" action="">
            <input type="text" name="nama" placeholder="Nama Peserta" required>
            <input type="text" name="alamat" placeholder="Alamat" required>
            <button type="submit">Tambah Peserta</button>
        </form>
    </div>

    <h2>Data Peserta Lomba</h2>

    <table>
        <tr>
            <th>ID</th>
            <th>Nama Peserta</th>
            <th>Alamat</th>
        </tr>

        <?php
        if ($result->num_rows > 0) {
            // Output data dari tiap baris
            while($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>" . $row["id"] . "</td>
                        <td>" . $row["nama"] . "</td>
                        <td>" . $row["alamat"] . "</td>
                    </tr>";
            }
        } else {
            echo "<tr><td colspan='3'>Tidak ada data.</td></tr>";
        }
        ?>

    </table>

    <div class="pagination">
        <?php
        // Pagination
        if ($page > 1) {
            echo "<a href='?page=" . ($page - 1) . "'>Sebelumnya</a>";
        }
        for ($i = 1; $i <= $totalPages; $i++) {
            echo "<a href='?page=" . $i . "'>" . $i . "</a>";
        }
        if ($page < $totalPages) {
            echo "<a href='?page=" . ($page + 1) . "'>Berikutnya</a>";
        }
        ?>
    </div>

</div>

</body>
</html>
