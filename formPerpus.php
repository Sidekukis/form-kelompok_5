<!DOCTYPE html>
<html>
<head>
    <title>Formulir Peminjaman Buku</title>
    <style>
      table { width: 100%; border-collapse: collapse; margin-top: 20px; }
      th, td { border: 1px solid #ddd; padding: 12px; text-align: left; }
      th { background-color: #f2f2f2; }
      label { font-weight: bold; }
      .form-group {
        margin-bottom: 15px;
      }
    </style>
</head>
<body>

<h2>Formulir Peminjaman Buku</h2>

<form method="post" action="">
    <div class="form-group">
        <label>1. Nama :</label><br>
        <input type="text" name="nama" required>
    </div>

    <div class="form-group">
        <label>2. NISN :</label><br>
        <input type="number" name="nisn" required>
    </div>

    <div class="form-group">
        <label>3. Kelas :</label><br>
        <input type="text" name="kelas" required>
    </div>

    <div class="form-group">
        <label>4. Jurusan :</label><br>
        <input type="text" name="jurusan" required>
    </div>

    <div class="form-group">
        <label>5. Judul Buku :</label><br>
        <select name="buku" required>
            <option value="">--Pilih Buku--</option>
            <option value="si kancil">si kancil</option>
            <option value="laut bercerita">laut bercerita</option>
            <option value="bumi manusia">bumi manusia</option>
        </select>
    </div>

    <div class="form-group">
        <label>6. Tanggal Pinjam :</label><br>
        <input type="date" name="tanggal_pinjam" required>
    </div>

    <div class="form-group">
        <label>7. Tanggal Kembali :</label><br>
        <input type="date" name="tanggal_kembali" required>
    </div>

    <input type="submit" value="Pinjam Buku">
</form>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST['nama'];
    $nisn = $_POST['nisn'];
    $kelas = $_POST['kelas'];
    $jurusan = $_POST['jurusan'];
    $buku = $_POST['buku'];
    $tanggal_pinjam = $_POST['tanggal_pinjam'];
    $tanggal_kembali = $_POST['tanggal_kembali'];

    // Hitung lama pinjam dalam hari
    $tgl_pinjam = new DateTime($tanggal_pinjam);
    $tgl_kembali = new DateTime($tanggal_kembali);
    $interval = $tgl_pinjam->diff($tgl_kembali);
    $lama_pinjam = $interval->days;

    echo "<h3>Data Peminjaman:</h3>";
    echo "<table>";
    echo "<tr><th>No.</th><th>Nama</th><th>NISN</th><th>Kelas</th><th>Jurusan</th><th>Judul Buku</th><th>Tanggal Pinjam</th><th>Tanggal Kembali</th><th>Lama Pinjam</th>/tr>";
    echo "<tr><td>1</td><td>$nama</td><td>$nisn</td><td>$kelas</td><td>$jurusan</td><td>$buku</td><td>$tanggal_pinjam</td><td>$tanggal_kembali</td><td>$lama_pinjam</td>s</tr>";
    echo "</table>";
}
?>

</body>
</html>
