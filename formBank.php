<?php
// Baca file JSON
$jsonFile = 'dataNasabah.json';
$nasabah_list = json_decode(file_get_contents($jsonFile), true);

// Variabel hasil transaksi
$hasil_transaksi = [];

$error_message = "";

if (isset($_POST['submit'])) {
    $no_rek = $_POST['no_rekening'];
    $jenis = $_POST['jenis_transaksi'];
    $jumlah = (int)$_POST['jumlah_transaksi'];
    // $saldo_awal = $_POST['saldo_awal'];
    $timestamp = date("Y-m-d H:i:s");

    // Cari nasabah & update saldo
    foreach ($nasabah_list as &$nasabah) {
        if ($nasabah['no_rekening'] == $no_rek) {
            $saldo_awal = $nasabah['saldo_awal'];
            if ($jenis === "Penyetoran") {
                $saldo_akhir = $saldo_awal + $jumlah;
            } elseif ($jenis === "Penarikan" && $jumlah > $saldo_awal) {
                $error_message = "Saldo tidak mencukupi untuk penarikan sebesar " . number_format($jumlah, 2);
                break; // hentikan loop
            } 
            else {
                $saldo_akhir = $saldo_awal - $jumlah;
            }

            // Update saldo di array nasabah
            $nasabah['saldo_awal'] = $saldo_akhir;

            // Data transaksi untuk ditampilkan
            $hasil_transaksi = [
                "no_rekening" => $no_rek,
                "nama_nasabah" => $nasabah['nama_nasabah'],
                "jenis_transaksi" => $jenis,
                "timestamp" => $timestamp,
                "saldo_awal" => $saldo_awal,
                "jumlah_transaksi" => $jumlah,
                "saldo_akhir" => $saldo_akhir
            ];
            break;
        }
    }
    unset($nasabah); // hapus referensi

    // Simpan perubahan ke file JSON
    file_put_contents($jsonFile, json_encode($nasabah_list, JSON_PRETTY_PRINT));
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Transaksi Nasabah</title>
    <style>
        table {
            border-collapse: collapse;
            width: 80%;
        }
        th, td {
            border: 1px solid #333;
            padding: 8px;
            text-align: center;
        }
        th {
            background-color: #eee;
        }
        /* .penyetoran { background-color: #d4edda; }
        .penarikan { background-color: #f8d7da; } */
    </style>
</head>
<body>

<h2>Form Transaksi Nasabah</h2>
<form method="post">
    <label>No Rekening:</label>
    <select name="no_rekening" required>
        <option value="">-- Pilih Nasabah --</option>
        <?php foreach ($nasabah_list as $n): ?>
            <option value="<?= $n['no_rekening'] ?>"><?= $n['no_rekening'] ?> - <?= $n['nama_nasabah'] ?></option>
        <?php endforeach; ?>
    </select><br><br>

    <label>Jenis Transaksi:</label>
    <select name="jenis_transaksi" required>
        <option value="Penyetoran">Penyetoran</option>
        <option value="Penarikan">Penarikan</option>
    </select><br><br>

    <label>Jumlah Transaksi:</label>
    <input type="number" name="jumlah_transaksi" min="1" required><br><br>

    <button type="submit" name="submit">Proses Transaksi</button>
</form>

<?php if (!empty($error_message) || !empty($hasil_transaksi)): ?>
    <?php if (!empty($error_message)): ?>
        <p style="color:red;"><?= $error_message; ?></p>
        <p> Saldo anda saat ini <?= number_format($saldo_awal, 2) ?></p>
    <?php else: ?>
        
    <h2>Hasil Transaksi</h2>
    <table>
        <tr>
            <th>No Rekening</th>
            <th>Nama Nasabah</th>
            <th>Jenis Transaksi</th>
            <th>Waktu Transaksi</th>
            <th>Saldo Awal</th>
            <th>Jumlah Transaksi</th>
            <th>Saldo Akhir</th>
        </tr>
        <tr class="<?= strtolower($hasil_transaksi['jenis_transaksi']) ?>">
            <td><?= $hasil_transaksi['no_rekening'] ?></td>
            <td><?= $hasil_transaksi['nama_nasabah'] ?></td>
            <td><?= $hasil_transaksi['jenis_transaksi'] ?></td>
            <td><?= $hasil_transaksi['timestamp'] ?></td>
            <td><?= number_format($hasil_transaksi['saldo_awal'], 0, ',', '.') ?></td>
            <td><?= number_format($hasil_transaksi['jumlah_transaksi'], 0, ',', '.') ?></td>
            <td><?= number_format($hasil_transaksi['saldo_akhir'], 0, ',', '.') ?></td>
        </tr>
    </table>
    <?php endif; ?>

<?php endif; ?>

</body>
</html>
