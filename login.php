<?php
session_start();

require 'function.php';

if (isset($_POST['login'])) {

    $email = $_POST['email'];
    $password = $_POST['password'];

    // Mengamankan input email
    $email = mysqli_real_escape_string($conn, $email);

    // Mencari email pada database
    $result = mysqli_query($conn, "SELECT * FROM users WHERE email = '$email'");

    if (mysqli_num_rows($result) === 1) {

        $row = mysqli_fetch_assoc($result);

        // Memeriksa password
        if (password_verify($password, $row['password'])) {

            $_SESSION['session_login'] = true;
            $_SESSION['email'] = $row['email'];
            $_SESSION['nama'] = $row['nama'];

            header('Location: index.php');
            exit;

        } else {
            echo "<script>
                    alert('Password yang kamu masukkan salah!');
                  </script>";
        }

    } else {
        echo "<script>
                alert('Email tidak ditemukan!');
              </script>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login By Admin Hanzz Coffee</title>
    <link rel="stylesheet" href="style.css">

    <style>
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

            <h3 style="text-align: center;">
                Login By Admin Hanzz Coffee
            </h3>

            <form action="" method="post">

                <!-- Email -->
                <div class="form-group">
                    <label for="email">Email</label>
                    <input
                        type="email"
                        name="email"
                        placeholder="Masukkan email"
                        required>
                </div>

                <!-- Password -->
                <div class="form-group">
                    <label for="password">Password</label>
                    <input
                        type="password"
                        name="password"
                        placeholder="Masukkan password"
                        required>
                </div>

                <!-- Button -->
                <div class="button-group">

                    <button type="submit" name="login" class="btn btn-edit">
                        Login
                    </button>

                    <a href="registrasi.php" class="btn btn-kembali">
                        Registrasi Belum Punya Akun ?
                    </a>

                </div>

            </form>

        </div>

    </div>

</body>
</html>
