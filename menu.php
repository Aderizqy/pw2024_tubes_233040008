<?php
require "koneksi.php";

$queryKategori = mysqli_query($conn, "SELECT * FROM kategori");

// 
if (isset($_GET['keyword'])) {
    $keyword = $_GET['keyword'];
    $queryMenu = mysqli_query($conn, "SELECT * FROM menu WHERE nama LIKE '%$keyword%'");
}
// 
elseif (isset($_GET['kategori'])) {
    $kategori = $_GET['kategori'];
    $queryGetKategori = mysqli_query($conn, "SELECT kategori_id FROM kategori WHERE nama='$kategori'");
    $kategoriId = mysqli_fetch_array($queryGetKategori)['kategori_id'];

    $queryMenu = mysqli_query($conn, "SELECT * FROM menu WHERE kategori_id='$kategoriId'");
}
// 
else {
    $queryMenu = mysqli_query($conn, "SELECT * FROM menu");
}

$countData = mysqli_num_rows($queryMenu);
echo $countData;

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mie.Gacoan | Menu</title>
    <link rel="stylesheet" href="./css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>

<body>
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
                        <a class="nav-link text-uppercase text-dark" href="#menu">Menu</a>
                    </li>
                    <li class="nav-item px-2 py-2">
                        <a class="nav-link text-uppercase text-dark" href="../adminpanel/logout.php">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container-fluid banner-menu d-flex align-items-center">
        <div class="container text-center text-white">
            <h1 class="judul">Menu</h1>
        </div>
    </div>

    <div class="container py-5">
        <div class="row">
            <div class="col-lg-3 mb-5">
                <h3>Kategori</h3>
                <ul class="list-group">
                    <?php while ($kategori = mysqli_fetch_array($queryKategori)) { ?>
                        <a class="no-decoration custom-cursor-pointer" href="menu.php?kategori=<?php echo $kategori['nama']; ?>">
                            <li class="list-group-item"><?php echo $kategori['nama']; ?></li>
                        </a>
                    <?php } ?>
                </ul>
            </div>
            <div class="col-lg-9">
                <h3 class="text-center mb-3">Menu</h3>
                <div class="row">
                    <?php if ($countData < 1) { ?>
                        <h4 class="text-center my-5 text-danger">Kategori Yang Anda Cari Tidak Tersedia</h4>
                    <?php } ?>
                    <?php while ($menu = mysqli_fetch_array($queryMenu)) { ?>
                        <div class="col-md-4 mb-4">
                            <div class="card h-100 card-hover">
                                <div class="img-box">
                                    <img src="img/<?php echo $menu['foto']; ?>" class="card-img-top" alt="...">
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo $menu['nama']; ?></h5>
                                    <p class="card-text text-truncate"><?php echo $menu['detail']; ?></p>
                                    <p class="card-text">Rp. <?php echo $menu['harga']; ?></p>
                                    <a href="menu-detail.php?nama=<?php echo $menu['nama'] ?>" class="btn btn-warning">Lihat Detail</a>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>

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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>