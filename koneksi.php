<?php
// Koneksi ke database
$host = "localhost";  
$username = "root";    
$password = "";       
$database = "univ_uas_iii"; 

$conn = mysqli_connect($host, $username, $password, $database);

// Periksa koneksi
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>
