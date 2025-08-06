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
        'barang' => $_POST['barang']
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
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 12px; text-align: left; }
        input[type="text"] { width: 100%; padding: 8px; margin-top: 5px; }
        button {background-color: #C5B0CD;}
    </style>
</head>
<body>
    <div class="container">
        <h1>Manajemen Supplier</h1>
        
        <h2>Tambah Supplier Baru</h2>
        <form method="post">
            <label>Nama Supplier:</label><input type="text" name="nama" required><br><br>
            <label>Alamat:</label><input type="text" name="alamat" required> <br><br>
            <label>Telepon:</label><input type="text" name="telepon" required> <br><br>
            <label>Barang yang Disuplai:</label><input type="text" name="barang" required> <br><br>
            <button type="submit" name="tambah_supplier">Simpan Supplier</button>
        </form>
        
        <h2>Daftar Supplier</h2>
        <table>
            <tr>
                <th>ID</th>
                <th>Nama</th>
                <th>Alamat</th>
                <th>Telepon</th>
                <th>Barang</th>
                <th>Aksi</th>
            </tr>
            <?php if (empty($suppliers)): ?>
                <tr><td colspan="6">Tidak ada data supplier</td></tr>
            <?php else: ?>
                <?php foreach ($suppliers as $supplier): ?>
                    <tr>
                        <td><?= $supplier['id'], 0, 9 ?></td>
                        <td><?= $supplier['nama'] ?></td>
                        <td><?= $supplier['alamat'] ?></td>
                        <td><?= $supplier['telepon'] ?></td>
                        <td><?= $supplier['barang'] ?></td>
                        <td><a href="?hapus=<?= $supplier['id'] ?>">Hapus</a></td>
                    </tr>
                <?php endforeach; ?>
            <?php endif ?>
        </table>
    </div>
</body>
</html>
