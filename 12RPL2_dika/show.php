<?php
// Memulai sesi
session_start();

// Memeriksa apakah pengguna telah login
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

if (isset($_POST['logout'])) {
    session_destroy();
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>MyApp | Halaman Utama</title>
	<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
</head>
<body>
	<div class="container">
		<nav class="navbar navbar-expand-lg navbar-light bg-light">
			<div class="container-fluid">
				<a class="navbar-brand" href="#">MyApp</a>
				<button class="navbar-toggler" type="button" data-bs-toggle="colapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>
				<div class="collapse navbar-collapse" id="navbarSupportedContent">
					<ul class="navbar-nav me-auto mb-2 mb-lg-0">
						<li class="nav-item">
							<a class="nav-link" aria-current="page" href="#">Home</a>
						</li>
						<li class="nav-item">
							<a class="nav-link active" href="#">Pasien</a>
						</li>
					</ul>

                    <form class="d-flex" method="POST" action="pasien.php">
                        <button class="btn btn-outline-primary" type="submit" name="logout">Logout</button>
                    </form>
				</div>
			</div>
		</nav>
		<div class="row mt-3">
			<div class="col-sm">
				<h3>Tabel Pasien</h3>
			</div>
		</div>
		<div class="row mt-3">
			<div class="col">
				<table class="table table-striped table-hover table-">
					<tr>
						<th>No</th>
						<th>ID Pasien</th>
						<th>Nama Pasien</th>
						<th>Jenis Kelamin</th>
						<th>Alamat</th>
					</tr>

					<?php
					include 'koneksi.php';
					$no = 1;
					$hasil = $koneksi->query("SELECT * FROM pasien");
					?>
					<?php
					while ($row = $hasil->fetch_assoc()) {
						# code...

					?>
					<tr>
						<td><?= $no++;?></td>
						<td><?= $row['idPasien']; ?></td>
						<td><?= $row['nmPasien']; ?></td>
						<td><?= $row['jk']; ?></td>
						<td><?= $row['alamat']; ?></td>
					</tr>
					<?php
				}
					?>
				</table>
			</div>
		</div>
	</div>
</body>

<script src="assets/js/bootstrap.min.js"></script>

</html>