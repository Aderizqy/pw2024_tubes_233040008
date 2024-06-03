<?php
require "koneksi.php";

$nama = htmlspecialchars($_GET['nama']);
$queryMenu = mysqli_query($conn, "SELECT * FROM menu WHERE nama='$nama'");
$menu = mysqli_fetch_array($queryMenu);


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mie.Gacoan | Menu Detail</title>
    <link rel="stylesheet" href="./css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>

<body>
    <!-- Navbar  -->
    <nav class="navbar navbar-expand-lg navbar-light bg-warning py-2 fixed-top opacity-95">
        <div class="container-fluid p-3">
            <div class="logo ms-2">
                <img src="./img/logo-full.png" alt="Logo" width="52" height="39" class="d-inline-block align-text-top">
            </div>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mx-auto me-auto mb-2 mb-lg-0">
                    <li class="nav-item px-2 py-2">
                        <a class="nav-link text-uppercase text-dark fw-normal" href="./index.php">Beranda</a>
                    </li>
                    <li class="nav-item px-2 py-2">
                        <a class="nav-link text-uppercase text-dark" href="./index.php">Tentang</a>
                    </li>
                    <li class="nav-item px-2 py-2">
                        <a class="nav-link text-uppercase text-dark" href="menu.php">Menu</a>
                    </li>
                    <li class="nav-item px-2 py-2">
                        <a class="nav-link text-uppercase text-dark" href="./adminpanel/logout.php">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Detail Menu -->

    <div class="container-fluid py-5" style="padding-top: 80px;">
        <div class="container py-5" style="margin-top: 80px;">
            <div class="row">
                <div class="col-md-5 mb-3">
                    <img src="img/<?php echo $menu['foto']; ?>" class="w-100" alt="">
                </div>
                <div class="col-md-6 offset-md-1">
                    <h1><?php echo $menu['nama']; ?></h1>
                    <p class="fs-5"><?php echo $menu['detail']; ?></p>
                    <p class="fw-bold">Rp. <?php echo $menu['harga']; ?></p>
                    <p class="fs-5">Status Ketersediaan : <strong>"<?php echo $menu['ketersediaan_stok']; ?>"</strong></p>
                    <button type="button" class="btn btn-warning"><a class="no-decoration" href="https://api.whatsapp.com/send?phone=+6282316888673>&text=Hallo,Saya ingin membeli Menu ini"><i class='bx bxs-cart bx-md bx-tada'></i></a></button>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->

    <footer class="bg-dark text-white pt-5 pb-4">
        <div class="container">
            <div class="row">
                <div class="col-md-4 col-lg-6 mt-4 mt-md-0">
                    <div class="logo ms-2">
                        <img src="./img/logo-full.png" alt="Logo" width="120" height="100" class="d-inline-block align-text-top">
                    </div>
                </div>
                <div class="col-md-4 col-lg-3 mt-3 mt-md-0">
                    <h3 class="mb-2 text-warning">Link</h3>
                    <ul class="list-unstyled">
                        <li><a href="./index.php" class="footer-link text-decoration-none text-uppercase text-white">Beranda</a></li>
                        <li><a href="./index.php" class="footer-link text-decoration-none text-uppercase text-white">Tentang</a></li>
                        <li><a href="menu.php" class="footer-link text-decoration-none text-uppercase text-white">Menu</a></li>
                    </ul>
                </div>
                <div class="col-md-4 col-lg-3 mt-3 mt-md-0">
                    <h3 class="mb-2 text-warning">Social Media</h3>
                    <div class="d-flex gap-2">
                        <a class="social text-white" href="https://www.facebook.com/warunkgacoankota/"><i class='bx bxl-facebook bx-md'></i></a>
                        <a class="social text-white" href="https://www.instagram.com/mie.gacoan/"><i class='bx bxl-instagram bx-md'></i></a>
                        <a class="social text-white" href="https://x.com/mie_gacoan?mx=2"><i class='bx bxl-twitter bx-md'></i></a>
                        <a class="social text-white" href=""><i class='bx bxl-tiktok bx-md'></i></a>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <footer class="py-2 px-3 px-md-0 bg-warning">
        <p class="text-dark text-center mt-2">Copyright &#169; 2024. By Ade Rizqy Maulana</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>