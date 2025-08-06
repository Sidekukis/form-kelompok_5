<!DOCTYPE html>
<html>
<head>
    <title>Formulir Peminjaman Buku</title>
</head>
<body>

<h2>Formulir Peminjaman Buku</h2>

<form method="post" action="">
    <label>Nama Peminjam:</label><br>
    <input type="text" name="nama" required><br><br>

    <label>NISN</label><br>
    <input type="text" name="nisn" required><br><br>

    <label>Judul Buku:</label><br>
    <input type="text" name="judul_buku" required><br><br>

    <label>Tanggal Pinjam:</label><br>
    <input type="date" name="tanggal_pinjam" required><br><br>

    <label>Tanggal Kembali:</label><br>
    <input type="date" name="tanggal_kembali" required><br><br>

    <input type="submit" value="Pinjam Buku">
</form>

<?php


// peminjaman buku
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama =($_POST['nama']);
    $nisn =($_POST['nisn']);
    $judul_buku =($_POST['judul_buku']);
    $tanggal_pinjam =($_POST['tanggal_pinjam']);
    $tanggal_kembali =($_POST['tanggal_kembali']);

    echo "<h3>Data Peminjaman:</h3>";
    echo "Nama: $nama <br>";
    echo "NISN: $nisn <br>";
    echo "Judul Buku: $judul_buku <br>";
    echo "Tanggal Pinjam: $tanggal_pinjam <br>";
    echo "Tanggal Kembali: $tanggal_kembali <br>";
}
?>

</body>
</html>
