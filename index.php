
<?php
require 'function.php';

// Mengambil seluruh data produk
$produk = query_db("SELECT * FROM produk");

// Fitur pencarian
if (isset($_POST['cari'])) {
    $keyword = $_POST['keyword'];
    $produk = cari_data($keyword);
}

// ================= PAGINATION =================

// Jumlah data yang ditampilkan setiap halaman
$jumlahDataPerhalaman = 5;

// Menghitung jumlah seluruh data
$jumlahData = count($produk);

// Menghitung jumlah halaman
$jumlahHalaman = ceil($jumlahData / $jumlahDataPerhalaman);

// Menentukan halaman aktif
$halamanAktif = isset($_GET['halaman']) ? (int)$_GET['halaman'] : 1;

// Membatasi halaman aktif
$jumlahHalaman = max(1, $jumlahHalaman);
$halamanAktif = max(1, min($halamanAktif, $jumlahHalaman));

// Menghitung data awal
$awalData = ($jumlahDataPerhalaman * $halamanAktif) - $jumlahDataPerhalaman;

// Mengambil data sesuai halaman
$produk = array_slice($produk, $awalData, $jumlahDataPerhalaman);

?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Produk Hanzz Coffee</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="style.css">
</head>

<body class="page-index">
    <div class="container">

        <h3 style="text-align: center;">
            Daftar Produk Hanzz Coffee
        </h3>

        <div class="top-bar">

            <!-- Searching -->
            <form action="" method="post" class="search-box">
                <input
                    type="text"
                    name="keyword"
                    placeholder="Cari nama produk atau kategori..."
                >
                <button type="submit" name="cari" class="btn btn-cari">
                    Cari
                </button>
            </form>

            <!-- Tambah Data -->
            <a href="tambah_produk.php" class="btn btn-tambah">
                + Tambah Produk
            </a>

            <!-- Logout -->
            <a href="logout.php" class="btn btn-logout"
                onclick="return confirm('Apakah kamu yakin ingin logout?')">
                Logout
            </a>

        </div>

        <!-- TABEL PRODUK -->
        <table>
            <thead>
                <tr>
                    <th>NO.</th>
                    <th>ID</th>
                    <th>Foto Produk</th>
                    <th>Nama Produk</th>
                    <th>Kategori</th>
                    <th>Harga</th>
                    <th>Deskripsi</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>

                <?php $nomor = $awalData + 1; ?>

                <?php foreach ($produk as $data): ?>
                <tr>
                    <td><?php echo $nomor++; ?></td>

                    <td>
                        <?php echo $data['id']; ?>
                    </td>

                    <td>
                        <img
                            src="img/<?php echo htmlspecialchars($data['gambar']); ?>"
                            width="100"
                            height="80"
                            style="object-fit: cover; border-radius: 8px;"
                            alt="<?php echo htmlspecialchars($data['nama_produk']); ?>"
                        >
                    </td>

                    <td>
                        <?php echo htmlspecialchars($data['nama_produk']); ?>
                    </td>

                    <td>
                        <?php echo htmlspecialchars($data['kategori']); ?>
                    </td>

                    <td style="white-space: nowrap; min-width: 150px; text-align: center;">
                        Rp.&nbsp;<?= number_format($data['harga'], 0, ',', '.') ?>
                    </td>

                    <td>
                        <?php echo htmlspecialchars($data['deskripsi']); ?>
                    </td>

                    <td>
                        <a href="edit_produk.php?id=<?php echo $data['id']; ?>"
                            class="btn btn-edit">
                            Edit
                        </a>

                        <a href="hapus_produk.php?id=<?php echo $data['id']; ?>"
                            class="btn btn-hapus"
                            onclick="return confirm('Apakah kamu yakin ingin menghapus produk ini?')">
                            Hapus
                        </a>
                    </td>

                </tr>
                <?php endforeach; ?>

                <?php if (empty($produk)): ?>
                <tr>
                    <td colspan="8" style="text-align: center;">
                        Data produk tidak ditemukan.
                    </td>
                </tr>
                <?php endif; ?>

            </tbody>
        </table>

        <!-- PAGINATION -->
        <div class="pagination">

            <!-- Previous -->
            <?php if ($halamanAktif > 1): ?>
                <a href="?halaman=<?= $halamanAktif - 1 ?>" class="prev">
                    &laquo; Previous
                </a>
            <?php else: ?>
                <span class="pagination-disabled">
                    &laquo; Previous
                </span>
            <?php endif; ?>

            <!-- Nomor Halaman -->
            <?php for ($i = 1; $i <= $jumlahHalaman; $i++): ?>

                <?php if ($i == $halamanAktif): ?>
                    <span class="active">
                        <?= $i; ?>
                    </span>
                <?php else: ?>
                    <a href="?halaman=<?= $i ?>">
                        <?= $i; ?>
                    </a>
                <?php endif; ?>

            <?php endfor; ?>

            <!-- Next -->
            <?php if ($halamanAktif < $jumlahHalaman): ?>
                <a href="?halaman=<?= $halamanAktif + 1 ?>" class="next">
                    Next &raquo;
                </a>
            <?php else: ?>
                <span class="pagination-disabled">
                    Next &raquo;
                </span>
            <?php endif; ?>

        </div>

        <!-- Informasi Jumlah Data -->
        <p style="text-align: center; margin-top: 15px;">
            Menampilkan
            <?= $jumlahData > 0 ? $awalData + 1 : 0; ?>
            -
            <?= min($awalData + $jumlahDataPerhalaman, $jumlahData); ?>
            dari <?= $jumlahData; ?> produk
        </p>

    </div>
</body>

</html>
