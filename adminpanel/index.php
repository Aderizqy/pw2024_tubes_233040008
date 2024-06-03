<?php
require "./session.php";
require "../koneksi.php";

$queryKategori = mysqli_query($conn, "SELECT * FROM kategori");
$jumlahKategori = mysqli_num_rows($queryKategori);

$queryMenu = mysqli_query($conn, "SELECT * FROM menu");
$jumlahMenu = mysqli_num_rows($queryMenu);
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Mie.Gacoan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>

<style>
    body {
        background-color: aqua;
    }

    .text-white {
        color: white !important;
    }

    .kotak {
        border: solid;
    }

    .summary-kategori,
    .summary-produk {
        border-radius: 15px;
        background-color: blueviolet;
    }

    .bxicons {
        font-size: 130px;
    }
</style>

<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mx-auto me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="../adminpanel/">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="kategori.php">Kategori</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="menu.php">Menu</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php">Logout</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../index.php">Users</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page"><i class='bx bxs-home'></i>Home</li>
            </ol>
        </nav>
        <h2>Halaman Admin</h2>

        <div class="container mt-5">
            <div class="row">
                <div class="col-lg-4 col-md-6 mb-3">
                    <div class="summary-kategori p-3">
                        <div class="row">
                            <div class="col-6">
                                <i class='bx bx-category text-black-50 bxicons'></i>
                            </div>
                            <div class="col-6 text-white">
                                <h2 class="fs-2">Kategori</h2>
                                <p class="fs-4"><?php echo $jumlahKategori ?> Kategori</p>
                                <p><a href="kategori.php" class="text-white text-decoration-none">Lihat detail</a></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mb-3">
                    <div class="summary-produk p-3">
                        <div class="row">
                            <div class="col-6">
                                <i class='bx bx-food-menu text-black-50 bxicons'></i>
                            </div>
                            <div class="col-6 text-white">
                                <h2 class="fs-2">Menu</h2>
                                <p class="fs-4"><?php echo $jumlahMenu ?> Menu</p>
                                <p><a href="menu.php" class="text-white text-decoration-none">Lihat detail</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>