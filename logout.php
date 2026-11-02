
<?php
session_start();

// Menghapus semua data session
$_SESSION = [];
session_unset();
session_destroy();

// Kembali ke halaman login
header("Location: login.php");
exit;
?>
