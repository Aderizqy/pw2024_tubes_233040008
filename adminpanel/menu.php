<?php
require "./session.php";
require "../koneksi.php";

$queryMenu = mysqli_query($conn, "SELECT  a.*, b.nama AS nama_kategori FROM menu a JOIN kategori b ON a.kategori_id=b.kategori_id");
$jumlahMenu = mysqli_num_rows($queryMenu);

$queryKategori = mysqli_query($conn, "SELECT * FROM kategori"); {
    function generateRandomString($length = 10)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[random_int(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Menu</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
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
                    Menu
                </li>
            </ol>
        </nav>
        <div class="my-5 col-12 col-md-6">
            <h3>Tambah Menu</h3>

            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
                <div>
                    <label for="nama">Nama</label>
                    <input type="text" id="nama" name="nama" class="form-control" autocomplete="off">
                </div>
                <div class="mt-2">
                    <label for="kategori">Kategori</label>
                    <select name="kategori_id" id="kategori" class="form-control">
                        <option value="">-Pilih Kategori-</option>
                        <?php
                        while ($data = mysqli_fetch_array($queryKategori)) {
                        ?>
                            <option value="<?php echo $data['kategori_id']; ?>"><?php echo $data['nama']; ?></option>
                        <?php
                        }
                        ?>
                    </select>
                </div>
                <div class="mt-2">
                    <label for="harga">Harga</label>
                    <input type="number" name="harga" id="harga" class="form-control">
                </div>
                <div class="mt-2">
                    <label for="foto">Foto</label>
                    <input type="file" name="foto" id="foto" class="form-control">
                </div>
                <div class="mt-2">
                    <label for="detail">Detail</label>
                    <textarea name="detail" id="detail" cols="30" rows="10" class="form-control"></textarea>
                </div>
                <div class="mt-2">
                    <label for="ketersediaan_stok">Ketersediaan Stok</label>
                    <select name="ketersediaan_stok" id="ketersediaan_stok" class="form-control">
                        <option value="tersedia">Tersedia</option>
                        <option value="habis">Habis</option>
                    </select>
                </div>
                <div class="mt-2">
                    <button type="submit" class="btn btn-primary" name="simpan">Simpan</button>
                </div>
            </form>

            <?php
            if (isset($_POST['simpan'])) {
                $nama = htmlspecialchars($_POST['nama']);
                $kategori = htmlspecialchars($_POST['kategori_id']);
                $harga = htmlspecialchars($_POST['harga']);
                $detail = htmlspecialchars($_POST['detail']);
                $ketersediaanStok = htmlspecialchars($_POST['ketersediaan_stok']);

                $target_dir = "../img/";
                $nama_file = basename($_FILES["foto"]["name"]);
                $target_file = $target_dir . $nama_file;
                $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
                $image_size = $_FILES["foto"]["size"];
                $random_name = generateRandomString(20);
                $new_name = $random_name . "." . $imageFileType;

                if ($nama == '' || $kategori == '' || $harga == '') {
            ?>
                    <div class="alert alert-warning mt-3" role="alert">
                        Nama, kategori, dan harga Wajib diisi
                    </div>
                    <?php
                } else {
                    if ($nama_file != '') {
                        if ($image_size > 10000000) {
                    ?>
                            <div class="alert alert-warning mt-3" role="alert">
                                File tidak boleh lebih dari 1 MB
                            </div>
                            <?php
                        } else {
                            if ($imageFileType != 'jpg' && $imageFileType != 'png' && $imageFileType != 'gif') {
                            ?>
                                <div class="alert alert-warning mt-3" role="alert">
                                    Format file Harus bertipe jpg, png, gif
                                </div>
                        <?php
                            } else {
                                move_uploaded_file($_FILES['foto']['tmp_name'], $target_dir . $new_name);
                            }
                        }
                    }

                    $queryTambah = mysqli_query($conn, "INSERT INTO menu (kategori_id, nama, harga, foto, detail, ketersediaan_stok) VALUES ('$kategori', '$nama', '$harga', '$new_name', '$detail', '$ketersediaanStok')");

                    if ($queryTambah) {
                        ?>
                        <div class="alert alert-primary mt-3" role="alert">
                            Menu berhasil Tersimpan
                        </div>

                        <meta http-equiv="refresh" content="2; url=menu.php" />
            <?php
                    }
                }
            }
            ?>
        </div>
        <div class="mt-3 mb-5">
            <h2>List Menu</h2>

            <div class="table-responsive mt-5">
                <table class="table">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nama</th>
                            <th>Kategori</th>
                            <th>Harga</th>
                            <th>Ketersediaan Stok</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($jumlahMenu == 0) {
                        ?>
                            <tr>
                                <td colspan="5" class="text-center">Menu tidak Tersedia</td>
                            </tr>
                            <?php
                        } else {
                            $jumlah = 1;
                            while ($data = mysqli_fetch_array($queryMenu)) {
                            ?>
                                <tr>
                                    <td><?php echo $jumlah; ?></td>
                                    <td><?php echo $data['nama']; ?></td>
                                    <td><?php echo $data['nama_kategori']; ?></td>
                                    <td><?php echo $data['harga']; ?></td>
                                    <td><?php echo $data['ketersediaan_stok']; ?></td>
                                    <td>
                                        <a href="menu-detail.php?p=<?php echo $data['menu_id']; ?>" class="btn btn-info"><i class='bx bx-search'></i>
                                        </a>
                                    </td>
                                </tr>
                        <?php
                                $jumlah++;
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>