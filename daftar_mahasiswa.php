<?php
include 'koneksi.php';

// Mengecek apakah ada kata kunci pencarian yang diberikan
if (isset($_GET['search'])) {
    $searchTerm = mysqli_real_escape_string($conn, $_GET['search']);

    // Query untuk mengambil data mahasiswa sesuai dengan kata kunci
    $query_mahasiswa = "SELECT nim, nama FROM mahasiswa WHERE nama LIKE '$searchTerm%'";
} else {
    // Jika tidak ada kata kunci, ambil semua data mahasiswa
    $query_mahasiswa = "SELECT nim, nama FROM mahasiswa";
}

$result_mahasiswa = mysqli_query($conn, $query_mahasiswa);

$mahasiswa = array();
while ($row_mahasiswa = mysqli_fetch_assoc($result_mahasiswa)) {
    $mahasiswa[] = $row_mahasiswa;
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Daftar Mahasiswa</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            height: 100vh;
        }

        table {
            width: 70%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: left;
        }

        th {
            background-color: #4CAF50;
            color: white;
        }

        a {
            text-decoration: none;
            color: #4CAF50;
        }

        .search-container {
            margin-top: 20px;
            margin-bottom: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            width: 70%;
        }

        .search-container input[type=text] {
            padding: 10px;
            margin-top: 8px;
            margin-bottom: 8px;
            width: 80%;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        .search-container button {
            padding: 10px;
            margin-top: 8px;
            margin-bottom: 8px;
            margin-left: 6px;
            background: #4CAF50;
            border: none;
            border-radius: 4px;
            color: white;
            cursor: pointer;
        }

        .add-button {
            padding: 10px;
            background: #4CAF50;
            border: none;
            border-radius: 4px;
            color: white;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <h2>Daftar Mahasiswa</h2>
    <div class="search-container">
        <form action="daftar_mahasiswa.php" method="GET">
            <input type="text" placeholder="Cari mahasiswa..." name="search">
            <button type="submit"><i class="fa fa-search"></i></button>
        </form>
        <a href="input.php" class="add-button"><i class="fa fa-plus"></i> Tambah Data</a>
    </div>

    <table>
        <tr>
            <th>NIM</th>
            <th>Nama</th>
            <th>Aksi</th>
        </tr>
        <?php foreach ($mahasiswa as $mhs) : ?>
            <tr>
                <td><?= $mhs['nim'] ?></td>
                <td><?= $mhs['nama'] ?></td>
                <td><a href="detail_mahasiswa.php?id=<?= $mhs['nim'] ?>"><i class="fa fa-eye"></i> Lihat</a></td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
