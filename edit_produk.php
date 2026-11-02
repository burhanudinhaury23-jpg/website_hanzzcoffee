
<?php
require 'function.php';

$id = (int) $_GET['id'];
$produk = query_db("SELECT * FROM produk WHERE id = $id")[0];

if (isset($_POST['submit'])) {

    if (edit_data($_POST) > 0) {
        echo "<script>
                alert('Data produk berhasil diubah!');
                document.location.href='index.php';
              </script>";
    } else {
        echo "<script>
                alert('Gagal mengubah data produk!');
                document.location.href='index.php';
              </script>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Produk Hanzz Coffee</title>
    <link rel="stylesheet" href="style.css">
</head>

<body class="page-form">

<div class="container">

    <div class="form-card">

        <h3>Edit Produk Hanzz Coffee</h3>

        <form action="" method="post" enctype="multipart/form-data">

            <!-- ID Produk -->
            <input type="hidden" name="id"
                value="<?php echo $produk['id']; ?>">

            <!-- Gambar Lama -->
            <input type="hidden" name="gambar_lama"
                value="<?php echo htmlspecialchars($produk['gambar']); ?>">

            <!-- Nama Produk -->
            <div class="form-group">
                <label for="nama_produk">Nama Produk</label>
                <input type="text" name="nama_produk" id="nama_produk"
                    value="<?php echo htmlspecialchars($produk['nama_produk']); ?>"
                    required>
            </div>

            <!-- Kategori -->
            <div class="form-group">
                <label for="kategori">Kategori</label>
                <input type="text" name="kategori" id="kategori"
                    value="<?php echo htmlspecialchars($produk['kategori']); ?>"
                    required>
            </div>

            <!-- Harga -->
            <div class="form-group">
                <label for="harga">Harga</label>
                <input type="number" name="harga" id="harga"
                    value="<?php echo $produk['harga']; ?>"
                    required>
            </div>

            <!-- Deskripsi -->
            <div class="form-group">
                <label for="deskripsi">Deskripsi</label>
                <input type="text" name="deskripsi" id="deskripsi"
                    value="<?php echo htmlspecialchars($produk['deskripsi']); ?>"
                    required>
            </div>

            <!-- Gambar -->
            <div class="form-group">
                <label for="gambar">Gambar Produk</label>

                <p>Gambar saat ini:</p>

                <img
                    src="img/<?php echo htmlspecialchars($produk['gambar']); ?>"
                    width="100"
                    height="80"
                    style="object-fit: cover; border-radius: 8px; margin: 10px 0;"
                    alt="Foto Produk">

                <input type="file" name="gambar" id="gambar"
                    accept=".jpg,.jpeg,.png">
            </div>

            <!-- Button -->
            <div class="button-group">

                <button type="submit" name="submit"
                    class="btn btn-edit">
                    Edit Produk
                </button>

                <a href="index.php" class="btn btn-kembali">
                    Kembali
                </a>

            </div>

        </form>

    </div>
</div>

</body>
</html>
