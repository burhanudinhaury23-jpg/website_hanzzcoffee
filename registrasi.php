
<?php
require 'function.php';

if(isset($_POST["register"])) {

    if(registrasi($_POST) > 0) {
        echo "<script>
                alert('User baru berhasil ditambahkan!');
                document.location.href='login.php';
              </script>";
    } else {
        echo mysqli_error($conn);
    }

}
?>


<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi Hanzz Coffee</title>
    <link rel="stylesheet" href="style.css">

    <style>
        /* Halaman Registrasi */
        .page-register {
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 30px;
        }

        .page-register .container {
            width: 100%;
            max-width: 520px;
            margin: 0;
        }

        .page-register .form-card {
            padding: 40px 45px;
        }
    </style>
</head>

<body class="page-register">

    <div class="container">
        <div class="form-card">

            <h3 style="text-align: center;">Registrasi Hanzz Coffee</h3>

            <form action="" method="post">

                <!-- Nama -->
                <div class="form-group">
                    <label for="nama">Nama</label>
                    <input type="text" name="nama" id="nama"
                        placeholder="Masukkan nama lengkap" required>
                </div>

                <!-- Email -->
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email"
                        placeholder="Masukkan email" required>
                </div>

                <!-- Password -->
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password"
                        placeholder="Masukkan password" required>
                </div>

                <!-- Konfirmasi Password -->
                <div class="form-group">
                    <label for="konfirmasi_password">Konfirmasi Password</label>
                    <input type="password" name="konfirmasi_password"
                        id="konfirmasi_password"
                        placeholder="Masukkan kembali password" required>
                </div>

                <!-- Button -->
                <div class="button-group">
                    <button type="submit" name="register" class="btn btn-edit">
                        Registrasi
                    </button>

                    <a href="login.php" class="btn btn-kembali">
                        Login
                    </a>
                </div>

            </form>

        </div>
    </div>

</body>
</html>
