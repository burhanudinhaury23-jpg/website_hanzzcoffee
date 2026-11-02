
<?php
require 'function.php';

$id = $_GET['id'];

if (hapus_data($id) > 0) {
    echo "<script>
            alert('Produk berhasil dihapus!');
            document.location.href='index.php';
          </script>";
} else {
    echo "<script>
            alert('Gagal menghapus produk!');
            document.location.href='index.php';
          </script>";
}
?>
