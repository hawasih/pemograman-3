<?php
include 'koneksi.php';

$query_matkul = "SELECT id_matkul, nama FROM matkul";
$result_matkul = mysqli_query($conn, $query_matkul);

$matkul = array();
while ($row_matkul = mysqli_fetch_assoc($result_matkul)) {
    $matkul[] = $row_matkul;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $nim = $_POST['nim'];
    $jk = $_POST['jk'];
    $status = $_POST['status']; // This should now contain 'Aktif' or 'Drop Out'
    $id_matkul = $_POST['matkul'];
    $jm_sks = $_POST['jm_sks'];

    $query_insert = "INSERT INTO mahasiswa (nama, alamat, nim, jk, status, id_matkul, jm_sks) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $query_insert);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "ssssssi", $nama, $alamat, $nim, $jk, $status, $id_matkul, $jm_sks);
        $result_insert = mysqli_stmt_execute($stmt);

        if ($result_insert) {
            // Dapatkan ID mahasiswa yang baru saja dimasukkan
            $new_mahasiswa_id = mysqli_insert_id($conn);

            // Redirect ke halaman detail_mahasiswa.php dengan ID mahasiswa baru
            header("Location: detail_mahasiswa.php?id=$new_mahasiswa_id");
            exit(); // Stop further execution
        } else {
            echo "Error: " . mysqli_stmt_error($stmt);
        }

        mysqli_stmt_close($stmt);
    } else {
        echo "Error in preparing the statement: " . mysqli_error($conn);
    }
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Input Mahasiswa</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 400px;
            margin: auto;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
        }

        input, select {
            width: 100%;
            padding: 8px;
            margin-bottom: 12px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        input[type="submit"] {
            background-color: #4caf50;
            color: #fff;
            cursor: pointer;
        }

        select {
            cursor: pointer;
        }
    </style>
</head>
<body>
    <form action="input.php" method="post">
        <label for="nama">Nama:</label>
        <input type="text" name="nama" id="nama" required>
        
        <label for="alamat">Alamat:</label>
        <input type="text" name="alamat" id="alamat" required>
        
        <label for="nim">NIM:</label>
        <input type="text" name="nim" id="nim" required>
        
        <label for="jk">Jenis Kelamin:</label>
        <select name="jk" id="jk" required>
            <option value="L">Laki-laki</option>
            <option value="P">Perempuan</option>
        </select>
        
        <label for="status">Status:</label>
        <select name="status" id="status" required>
            <option value="Aktif">Aktif</option>
            <option value="Drop Out">Drop Out</option>
        </select>
        
        <label for="matkul">Pilih Mata Kuliah:</label>
        <select name="matkul" id="matkul" required>
            <?php foreach ($matkul as $m) : ?>
                <option value="<?= $m['id_matkul'] ?>"><?= $m['nama'] ?></option>
            <?php endforeach; ?>
        </select>
        
        <label for="jm_sks">Jumlah SKS:</label>
        <input type="number" name="jm_sks" id="jm_sks" min="0" required>
        
        <input type="submit" value="Simpan">
    </form>
</body>
</html>
