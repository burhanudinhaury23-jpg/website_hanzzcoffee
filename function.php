
<?php

// koneksi ke database
$conn = mysqli_connect("localhost", "root", "", "hanzz_coffee_db");

function query_db($query) {
    global $conn;

    $result = mysqli_query($conn, $query);
    $rows = [];

    while( $row = mysqli_fetch_assoc($result) ) {
        $rows[] = $row;
    }

    return $rows;
}

// FUNGSI TAMBAH PRODUK
function tambah_data($data) {
    global $conn;

    $nama_produk = mysqli_real_escape_string($conn, $data['nama_produk']);
    $kategori = mysqli_real_escape_string($conn, $data['kategori']);
    $harga = $data['harga'];
    $deskripsi = mysqli_real_escape_string($conn, $data['deskripsi']);

    // upload gambar
    $gambar = upload_gambar();

    if( !$gambar ) {
        return false;
    }

    $query = "INSERT INTO produk (nama_produk, kategori, harga, deskripsi, gambar)
              VALUES ('$nama_produk', '$kategori', '$harga', '$deskripsi', '$gambar')";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

// FUNGSI HAPUS PRODUK
function hapus_data($id) {
    global $conn;

    $id = (int) $id;

    $query = "DELETE FROM produk WHERE id = $id";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

// FUNGSI EDIT PRODUK

function edit_data($data) {
    global $conn;

    $id = (int) $data['id'];
    $nama_produk = mysqli_real_escape_string($conn, $data['nama_produk']);
    $kategori = mysqli_real_escape_string($conn, $data['kategori']);
    $harga = $data['harga'];
    $deskripsi = mysqli_real_escape_string($conn, $data['deskripsi']);

    // cek apakah ada gambar baru
    if( $_FILES['gambar']['error'] === 4 ) {
        $gambar = $data['gambar_lama'];
    } else {
        $gambar = upload_gambar();

        if( !$gambar ) {
            return false;
        }
    }

    $query = "UPDATE produk SET
                nama_produk = '$nama_produk',
                kategori = '$kategori',
                harga = '$harga',
                deskripsi = '$deskripsi',
                gambar = '$gambar'
              WHERE id = $id";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}


// FUNGSI SEARCH
function cari_data($keyword) {
    global $conn;

    $keyword = mysqli_real_escape_string($conn, $keyword);

    $query = "SELECT * FROM produk
              WHERE
              nama_produk LIKE '%$keyword%' OR
              kategori LIKE '%$keyword%' OR
              deskripsi LIKE '%$keyword%'";

    return query_db($query);
}

// FUNGSI UPLOAD GAMBAR
function upload_gambar() {

    // setting file
    $namaFile = $_FILES['gambar']['name'];
    $ukuranFile = $_FILES['gambar']['size'];
    $error = $_FILES['gambar']['error'];
    $tmpName = $_FILES['gambar']['tmp_name'];

    // cek apakah ada gambar yang diupload
    if( $error === 4 ) {
        echo "<script>
                alert('Kamu belum upload gambar produk!');
              </script>";
        return false;
    }

    // cek ekstensi gambar
    $ekstensiGambarValid = ['jpg', 'jpeg', 'png'];
    $ekstensiGambar = explode('.', $namaFile);
    $ekstensiGambar = strtolower(end($ekstensiGambar));

    if( !in_array($ekstensiGambar, $ekstensiGambarValid) ) {
        echo "<script>
                alert('File yang diupload harus berupa JPG, JPEG, atau PNG!');
              </script>";
        return false;
    }

    // cek ukuran gambar maksimal 5 MB
    if( $ukuranFile > 5000000 ) {
        echo "<script>
                alert('Ukuran gambar terlalu besar! Maksimal 5 MB.');
              </script>";
        return false;
    }

    // membuat nama file baru
    $namaFileBaru = uniqid();
    $namaFileBaru .= '.';
    $namaFileBaru .= $ekstensiGambar;

    // memindahkan gambar ke folder img
    move_uploaded_file($tmpName, 'img/' . $namaFileBaru);

    return $namaFileBaru;
}

// FUNGSI REGISTRASI
function registrasi($data) {
    global $conn;

    $nama = mysqli_real_escape_string($conn, $data['nama']);
    $email = mysqli_real_escape_string($conn, $data['email']);
    $password = $data['password'];
    $konfirmasi_password = $data['konfirmasi_password'];

    // cek email sudah terdaftar atau belum
    $result = mysqli_query($conn, "SELECT email FROM users WHERE email = '$email'");

    if( mysqli_fetch_assoc($result) ) {
        echo "<script>
                alert('Email sudah terdaftar! Gunakan email lainnya!');
              </script>";
        return false;
    }

    // cek konfirmasi password
    if( $password !== $konfirmasi_password ) {
        echo "<script>
                alert('Konfirmasi password tidak sesuai!');
              </script>";
        return false;
    }

    // enkripsi password
    $password = password_hash($password, PASSWORD_DEFAULT);

    // memasukkan data pengguna
    mysqli_query($conn, "INSERT INTO users (nama, email, password)
                         VALUES ('$nama', '$email', '$password')");

    return mysqli_affected_rows($conn);
}

?>
