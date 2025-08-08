<?php
// File untuk menyimpan data supplier
$data_file = 'simpan_supply.json';

// Fungsi untuk memuat dan menyimpan data
function load_data() {
    global $data_file;
    return file_exists($data_file) ? json_decode(file_get_contents($data_file), true) : [];
}

function save_data($data) {
    global $data_file;
    file_put_contents($data_file, json_encode($data, JSON_PRETTY_PRINT));
}

// Tambah supplier
if (isset($_POST['tambah_supplier'])) {
    $suppliers = load_data();
    $suppliers[] = [
        'id' => uniqid(),
        'nama' => $_POST['nama'],
        'alamat' => $_POST['alamat'],
        'telepon' => $_POST['telepon'],
        'tanggal' => $_POST['tanggal'],
        'barang' => $_POST ['barang'],
        'kategori' => $_POST['kategori'],
        'jumlah' => $_POST['jumlah'],
        'harga' => $_POST['harga']

    ];
    save_data($suppliers);
    echo "<script>alert('Supplier berhasil ditambahkan');</script>";
}

// Hapus supplier
if (isset($_GET['hapus'])) {
    $suppliers = load_data();
    $suppliers = array_filter($suppliers, fn($supplier) => $supplier['id'] !== $_GET['hapus']);
    save_data(array_values($suppliers));
    echo "<script>alert('Supplier berhasil dihapus');</script>";
}

$suppliers = load_data();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Manajemen Supplier</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        .container { width: 80%; margin: 0 auto; }
        table { width: 120%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 12px; text-align: left; }
        input[type="text"] { width: 100%; padding: 8px; margin-top: 5px; }
        input[type="number"] { width: 100%; padding: 8px; margin-top: 5px; }
        input[type="date"] { width: 100%; padding: 8px; margin-top: 5px; }
        button {background-color: #C5B0CD; border-radius: 8px;}
    </style>
</head>
<body>
    <div class="container">
        <h1>Manajemen Supplier</h1>
        
        <h2>Tambah Supplier Baru</h2>
        <form method="post">
            <label>Nama Supplier:</label><input type="text" name="nama" required><br><br>
            <label>Alamat:</label><br><textarea name="alamat" rows="5" cols="100" required></textarea> <br><br>
            <label>Telepon:</label><input type="number" name="telepon" required> <br><br>
            <label>Tanggal Masuk:</label><input type="date" name="tanggal" required> <br><br>
            <label>Barang yang Disuplai:</label><input type="text" name="barang" required> <br><br>
            <label>Kategori:</label><br>
            <select name="kategori" style="width: 100%; padding: 8px; margin-top: 5px;" required>
                <option value="">--Pilih Kategori--</option>
                <option value="makanan">Makanan</option>
                <option value="minuman">Minuman</option>
                <option value="perlengkapan">Perlengkapan</option>
                <option value="kecantikan">Kecantikan</option>
                <option value="kesehatan">Kesehatan</option>
                <option value="lainnya">Lainnya</option>
            </select><br><br>
            <label>Jumlah:</label><input type="number" name="jumlah" required> <br><br>
            <label>Harga/pcs:</label><input type="number" name="harga" required> <br><br>
            <button type="submit" name="tambah_supplier">Simpan Supplier</button>
        </form>
        
        <h2>Daftar Supplier</h2>
        <table>
            <tr>
                <th>ID</th>
                <th>Nama</th>
                <th>Alamat</th>
                <th>Telepon</th>
                <th>Tanggal <br>Masuk</th>
                <th>Barang</th>
                <th>Kategori</th>
                <th>Jumlah</th>
                <th>Harga/pcs</th>
                <th>Total</th>
                <th>Aksi</th>
            </tr>
            <?php if (empty($suppliers)): ?>
                <tr><td colspan="11">Tidak ada data supplier</td></tr>
            <?php else: ?>
                <?php foreach ($suppliers as $supplier): ?>
                    <tr>
                        <td><?= sprintf('%09d', $supplier['id']) ?></td>
                        <td><?= $supplier['nama'] ?></td>
                        <td><?= $supplier['alamat'] ?></td>
                        <td><?= $supplier['telepon'] ?></td>
                        <td><?= $supplier['tanggal'] ?></td>
                        <td><?= $supplier['barang']?></td>
                        <td><?= $supplier['kategori'] ?></td>
                        <td><?= $supplier['jumlah']?></td>
                        <td><?= $supplier['harga']?></td>
                        <td><?= $supplier['harga'] * $supplier['jumlah'] ?></td>
                        <td><a href="?hapus=<?= $supplier['id'] ?>">Hapus</a></td>
                    </tr>
                <?php endforeach; ?>
            <?php endif ?>
        </table>
    </div>
</body>
</html>

