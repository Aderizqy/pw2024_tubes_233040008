<?php
require "koneksi.php";
$queryMenu = mysqli_query($conn, "SELECT kategori_id, nama, harga, foto, detail FROM menu LIMIT 6");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mie.Gacoan</title>
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
                        <a class="nav-link text-uppercase text-dark fw-normal" href="#home">Beranda</a>
                    </li>
                    <li class="nav-item px-2 py-2">
                        <a class="nav-link text-uppercase text-dark" href="#tentang">Tentang</a>
                    </li>
                    <li class="nav-item px-2 py-2">
                        <a class="nav-link text-uppercase text-dark" href="menu.php">Menu</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Home -->

    <section id="home">
        <div class="container-fluid banner d-flex align-items-center">
            <div class="container text-center text-white">
                <h1 class="judul">Mie Gacoan</h1>
                <h3 class="judul">Jagonya Mie</h3>
                <div class="col-8 offset-2">
                    <form action="menu.php" method="get">
                        <div class="input-group input-group-lg my-3">
                            <input type="text" class="form-control" placeholder="Nama Menu" aria-label="Recipient's username" aria-describedby="basic-addon2" name="keyword">
                            <button type="submit" class="btn btn-warning">Telusuri</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- Kategori -->

    <div class="container-fluid py-5">
        <div class="container text-center">
            <h3 class="judul-body">Kategori Terlaris</h3>

            <div class="row mt-5">
                <div class="col-md-4 mb-3">
                    <div class="highlighted-kategori kategori-mie d-flex justify-content-center align-items-center">
                        <h4 class="text-white"><a class="no-decoration" href="menu.php?kategori=mie">Mie</a></h4>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <div class="highlighted-kategori kategori-dimsum d-flex justify-content-center align-items-center">
                        <h4 class="text-white"><a class="no-decoration" href="menu.php?kategori=mie">Dimsum</a></h4>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <div class="highlighted-kategori kategori-es-segar d-flex justify-content-center align-items-center">
                        <h4 class="text-white"><a class="no-decoration" href="menu.php?kategori=mie">Es Segar</a></h4>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Tentang -->

    <section id="tentang">
        <div class="text-center mt-5 mb-5">
            <h3 class="judul-body">Tentang Kami</h3>
        </div>
        <div class="container mt-5">
            <div class="row justify-content-center align-items-center">
                <div class="col-md-4 text-center">
                    <img src="./img/aboutimg1.jpg" alt="" class="rounded-4 img-fluid mb-3">
                </div>
                <div class="col-md-4 text-center">
                    <img src="./img/aboutimg2.jpg" alt="" class="rounded-4 img-fluid mb-3">
                </div>
                <div class="col-md-4 text-center">
                    <img src="./img/aboutimg3.jpg" alt="" class="rounded-4 img-fluid mb-3">
                </div>
                <div class="col-md-10 col-9">
                    <p class="mt-lg-2">"Mie Gacoan" adalah sebuah merk dagang dari jaringan restaurant mie pedas No. 1 di Indonesia, yang menjadi anak perusahaan PT Pesta Pora Abadi. Berdiri sejak awal tahun 2016, saat ini merk "Mie Gacoan" telah tumbuh menjadi market leader F&B terbesar di Indonesia. Mengusung konsep bersantap modern dengan harga yang affordable, kehadiran "Mie Gacoan" telah mendapatkan apresiasi luar biasa di setiap market dimana "Mie Gacoan" hadir untuk melayani puluhan ribu pelanggan setiap bulannya. Oleh karena itu, inovasi akan selalu dikedepankan agar "Mie Gacoan" tetap relevan dan menjadi pilihan terbaik bagi para customer loyal.</p>
                </div>
            </div>
        </div>

        </div>
    </section>

    <!-- Menu -->

    <section id="menu">
        <div class="container-fluid py-5">
            <div class="container text-center">
                <h3 class="judul-body">
                    Menu
                </h3>

                <div class="row mt-5">
                    <?php while ($data = mysqli_fetch_array($queryMenu)) { ?>
                        <div class="col-sm-6 col-md-4 mb-2">
                            <div class="card h-100 card-hover">
                                <div class="img-box">
                                    <img src="img/<?php echo $data['foto']; ?>" class="card-img-top" alt="...">
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo $data['nama']; ?></h5>
                                    <p class="card-text text-truncate"><?php echo $data['detail']; ?></p>
                                    <p class="card-text">Rp. <?php echo $data['harga']; ?></p>
                                    <a href="menu-detail.php?nama=<?php echo $data['nama'] ?>" class="btn btn-warning">Lihat Detail</a>
                                </div>
                            </div>
                        </div>
                    <?Php } ?>
                </div>

                <a class="btn btn-outline-warning mt-5" href="menu.php">See more</a>

            </div>
        </div>
    </section>

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
                        <li><a href="#home" class="footer-link text-decoration-none text-uppercase text-white">Beranda</a></li>
                        <li><a href="#tentang" class="footer-link text-decoration-none text-uppercase text-white">Tentang</a></li>
                        <li><a href="#menu" class="footer-link text-decoration-none text-uppercase text-white">Menu</a></li>
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

    <!-- JS Bootstrap -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>

</html>