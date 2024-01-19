<?php
include 'koneksi.php';

$id_mahasiswa = $_GET['id']; // Get the ID from the URL

$query_mahasiswa = "SELECT * FROM mahasiswa WHERE id_mhs = $id_mahasiswa";
$result_mahasiswa = mysqli_query($conn, $query_mahasiswa);

// Check if the query executed successfully
if ($result_mahasiswa === false) {
    // Handle the error
    die("Error executing query: " . mysqli_error($conn));
}

$mahasiswa = mysqli_fetch_assoc($result_mahasiswa);

if (!$mahasiswa) {
    // Handle the case where no student with the given ID is found
    echo "Mahasiswa tidak ditemukan.";
    exit();
}

$query_matkul = "SELECT nama FROM matkul WHERE id_matkul = " . $mahasiswa['id_matkul'];
$result_matkul = mysqli_query($conn, $query_matkul);

// Check if the query executed successfully
if ($result_matkul === false) {
    // Handle the error
    die("Error executing query: " . mysqli_error($conn));
}

$matkul = mysqli_fetch_assoc($result_matkul);

mysqli_close($conn);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Mahasiswa</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        h1 {
            color: #333;
            margin-bottom: 20px;
        }

        table {
            border-collapse: collapse;
            width: 80%;
            margin: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 15px;
            text-align: left;
        }

        th {
            background-color: #4caf50;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        a {
            text-decoration: none;
            color: #4caf50;
            font-weight: bold;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <h1>Detail Mahasiswa</h1>
    <table>
        <tr>
            <th>Mahasiswa</th>
            <th>Data</th>
        </tr>
        <tr>
            <td>Nama</td>
            <td><?= $mahasiswa['nama'] ?></td>
        </tr>
        <tr>
            <td>Alamat</td>
            <td><?= $mahasiswa['alamat'] ?></td>
        </tr>
        <tr>
            <td>NIM</td>
            <td><?= $mahasiswa['nim'] ?></td>
        </tr>
        <tr>
            <td>Jenis Kelamin</td>
            <td><?= $mahasiswa['jk'] ?></td>
        </tr>
        <tr>
            <td>Status</td>
            <td><?= $mahasiswa['status'] ?></td>
        </tr>
        <tr>
            <td>Mata Kuliah</td>
            <td><?= $matkul['nama'] ?></td>
        </tr>
        <tr>
            <td>Jumlah SKS</td>
            <td><?= $mahasiswa['jm_sks'] ?></td>
        </tr>
    </table>
    <a href="input.php">Kembali ke Input</a>
</body>
</html>
