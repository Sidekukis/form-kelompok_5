<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Form Penarikan Tabungan</title>
</head>
<body>
    <h2>Form Penarikan Tabungan</h2>
    <form method="post">
        <label for="id_nasabah">ID Nasabah:</label><br>
        <input type="text" name="id_nasabah" required><br><br>

        <label for="nama">Nama Nasabah:</label><br>
        <input type="text" name="nama" required><br><br>

        <label for="tanggal">Tanggal Penarikan:</label><br>
        <input type="date" name="tanggal" value="<?php echo date('Y-m-d'); ?>" required><br><br>

        <label for="jumlah">Jumlah Penarikan (Rp):</label><br>
        <input type="number" name="jumlah" required><br><br>

        <label for="alasan">Alasan Penarikan:</label><br>
        <textarea name="alasan" rows="3" cols="30"></textarea><br><br>

        <label for="pin">PIN:</label><br>
        <input type="password" name="pin" required><br><br>

        <input type="submit" name="submit" value="Tarik">
    </form>

<?php
if (isset($_POST['submit'])) {
    $id = $_POST['id_nasabah'];
    $nama = $_POST['nama'];
    $tanggal = $_POST['tanggal'];
    $jumlah = $_POST['jumlah'];
    $alasan = $_POST['alasan'];
    $pin = $_POST['pin'];

    echo "<h2>Data Penarikan:</h2>";
    echo "ID Nasabah: $id<br>";
    echo "Nama: $nama<br>";
    echo "Tanggal Penarikan: $tanggal<br>";
    echo "Jumlah Penarikan: Rp " . number_format($jumlah, 0, ',', '.') . "<br>";
    echo "Alasan: $alasan<br>";
    echo "PIN: ****** (disembunyikan)<br>";
}
?>
</body>
</html>