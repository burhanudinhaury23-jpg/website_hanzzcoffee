<?php
require 'function.php';

if (isset($_POST['submit'])) {

    if (tambah_data($_POST) > 0) {
        echo "<script>
                alert('Produk berhasil ditambahkan!');
                document.location.href='index.php';
              </script>";
    } else {
        echo "<script>
                alert('Gagal menambahkan produk!');
              </script>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Produk Hanzz Coffee</title>
    <link rel="stylesheet" href="style.css">
</head>

<body class="page-form">

<div class="container">

    <div class="form-card">

        <h3>Tambah Produk Hanzz Coffee</h3>

    <form action="" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="nama_produk">Nama Produk</label>
                <input
                    type="text"
                    name="nama_produk"
                    id="nama_produk"
                    placeholder="Masukkan nama produk"
                    required
                >
            </div>

            <div class="form-group">
                <label for="kategori">Kategori</label>
                <select name="kategori" id="kategori" required>
                    <option value="">Pilih Kategori</option>
                    <option value="Kopi">Kopi</option>
                    <option value="Non-Kopi">Non-Kopi</option>
                    <option value="Makanan">Makanan</option>
                </select>
            </div>

            <div class="form-group">
                <label for="harga">Harga</label>
                <input
                    type="number"
                    name="harga"
                    id="harga"
                    placeholder="Masukkan harga produk"
                    min="0"
                    required
                >
            </div>

            <div class="form-group">
                <label for="deskripsi">Deskripsi Produk</label>
                <textarea
                    name="deskripsi"
                    id="deskripsi"
                    rows="4"
                    placeholder="Masukkan deskripsi produk"
                    required
                ></textarea>
            </div>

            <div class="form-group">
                <label for="gambar">Foto Produk</label>
                <input
                    type="file"
                    name="gambar"
                    id="gambar"
                    accept="image/*"
                    required
                >
            </div>

            <div class="button-group">
               <button type="submit" name="submit" class="btn btn-tambah">
               Tambah Produk
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
