<?php
// Membuat koneksi ke database
$koneksi = new mysqli('localhost', 'root', '', 'dikaputra');

// Memeriksa koneksi
if ($koneksi->connect_error) {
    die("Koneksi gagal: " . $koneksi->connect_error);
}

// Memeriksa apakah ada data yang dikirim dari form login
if (isset($_POST['login'])) {
    // Mendapatkan nilai yang dikirim dari form
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Melakukan query untuk memeriksa apakah username dan password cocok dengan data di database
    $query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
    $result = $koneksi->query($query);

    if ($result->num_rows == 1) {
        // Jika username dan password cocok, maka mendapatkan data pengguna
        $row = $result->fetch_assoc();
        $role = $row['role'];

        // Memeriksa peran pengguna
        if ($role == 'admin') {
            // Set session username
            session_start();
            $_SESSION['username'] = $username;

            // Redirect ke halaman admin
            header("Location: pasien.php");
            exit();
        } elseif ($role == 'user') {
            // Set session username
            session_start();
            $_SESSION['username'] = $username;

            // Redirect ke halaman pasien
            header("Location: show.php");
            exit();
        }
    } else {
        // Jika username atau password tidak cocok, menampilkan pesan kesalahan
        $error = "Username atau password salah!";
    }
}
?>