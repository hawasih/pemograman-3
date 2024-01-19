-- Database: `univ_uas_iii`

-- Struktur dari tabel `mahasiswa`
CREATE TABLE `mahasiswa` (
  `id_mhs` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(50) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `nim` varchar(10) NOT NULL,
  `jk` char(1) NOT NULL,
  `status` varchar(20) NOT NULL,
  `id_sks` int(11) NOT NULL,
  `jm_sks` int(11) NOT NULL,
  `id_matkul` int(11) NOT NULL,
  PRIMARY KEY (`id_mhs`),
  FOREIGN KEY (`id_matkul`) REFERENCES `matkul` (`id_matkul`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Struktur dari tabel `matkul`
CREATE TABLE `matkul` (
  `id_matkul` int(11) NOT NULL AUTO_INCREMENT,
  `id_sks` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  PRIMARY KEY (`id_matkul`),
  FOREIGN KEY (`id_sks`) REFERENCES `sks` (`id_sks`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Struktur dari tabel `sks`
CREATE TABLE `sks` (
  `id_sks` int(11) NOT NULL AUTO_INCREMENT,
  `jm_sks` int(11) NOT NULL,
  PRIMARY KEY (`id_sks`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- AUTO_INCREMENT untuk tabel `mahasiswa`
ALTER TABLE `mahasiswa`
  MODIFY `id_mhs` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

-- AUTO_INCREMENT untuk tabel `matkul`
ALTER TABLE `matkul`
  MODIFY `id_matkul` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

-- AUTO_INCREMENT untuk tabel `sks`
ALTER TABLE `sks`
  MODIFY `id_sks` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

-- Query untuk menampilkan data mahasiswa dan jumlah SKS
SELECT a.nama AS mahasiswa, b.jm_sks
FROM mahasiswa a
JOIN sks b ON a.id_sks = b.id_sks;

-- Query untuk menampilkan data mahasiswa, matkul dan jumlah SKS
SELECT
  CONCAT(mahasiswa.nama, ' - ', matkul.nama) AS mahasiswa_matkul,
  mahasiswa.jm_sks AS sks
FROM
  mahasiswa
INNER JOIN
  matkul
ON
  mahasiswa.id_matkul = matkul.id_matkul;

-- Query untuk menampilkan data nama, alamat, jk dan status
SELECT
  nama,
  alamat,
  jk,
  status
FROM
  mahasiswa;
