<?php
require "session.php";
require "../koneksi.php";

$queryKategori = mysqli_query($conn, "SELECT * FROM kategori");
$jumlahKategori = mysqli_num_rows($queryKategori);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mie.Gacoan | Kategori</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>

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
                <li class="breadcrumb-item active" aria-current="page">
                    <a href="../adminpanel" class="text-decoration-none text-muted">
                        <i class='bx bxs-home'></i>Home
                    </a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                    Kategori
                </li>
            </ol>
        </nav>

        <div class="my-5 col-12 col-md-6">
            <h3>Tambah Kategori</h3>
            <form action="" method="post">
                <div class="">
                    <label for="kategori">Kategori</label>
                    <input type="text" id="kategori" name="kategori" placeholder="nama kategori" class="form-control">
                </div>
                <div class="mt-3">
                    <button class="btn btn-primary" type="submit" name="simpan_kategori">Simpan</button>
                </div>
            </form>

            <?php
            if (isset($_POST['simpan_kategori'])) {
                $kategori = htmlspecialchars($_POST['kategori']);

                $queryExist = mysqli_query($conn, "SELECT nama FROM kategori WHERE nama='$kategori'");
                $jumlahDataKategoriBaru = mysqli_num_rows($queryExist);

                if ($jumlahDataKategoriBaru > 0) {
            ?>
                    <div class="alert alert-warning mt-3" role="alert">
                        Kategori Sudah Ada
                    </div>
                    <meta http-equiv="refresh" content="2; url=kategori.php" />
                    <?php
                } else {
                    $querySimpan = mysqli_query($conn, "INSERT INTO kategori (nama) VALUES ('$kategori')");
                    if ($querySimpan) {
                    ?>
                        <div class="alert alert-primary mt-3" role="alert">
                            Kategori berhasil di tambahkan👌
                        </div>
                        <meta http-equiv="refresh" content="2; url=kategori.php" />
            <?php

                    } else {
                        echo mysqli_error($conn);
                    }
                }
            }
            ?>

        </div>

        <div class="mt-3">
            <h2>List Kategori</h2>

            <div class="table-responsive mt-5">
                <table class="table">

                    <head>
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Nama</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if ($jumlahKategori == 0) {
                            ?>
                                <tr>
                                    <td colspan="3">Data tidak Tersedia</td>
                                </tr>
                                <?php
                            } else {
                                $jumlah = 1;
                                while ($data = mysqli_fetch_array($queryKategori)) {
                                ?>
                                    <tr>
                                        <td><?php echo $jumlah; ?></td>
                                        <td><?php echo $data['nama']; ?></td>
                                        <td>
                                            <a href="kategori-detail.php?p=<?php echo $data['kategori_id']; ?>" class="btn btn-info">
                                                <i class='bx bx-search'></i>
                                            </a>
                                        </td>
                                    </tr>

                            <?php
                                    $jumlah++;
                                }
                            }
                            ?>
                        </tbody>
                    </head>
                </table>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    </div>
</body>

</html>