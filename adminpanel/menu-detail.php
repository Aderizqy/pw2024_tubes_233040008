<?php
require "session.php";
require "../koneksi.php";

$id = $_GET['p'];

$queryMenu = mysqli_query($conn, "SELECT a.*, b.nama AS nama_kategori FROM menu a JOIN kategori b ON a.kategori_id=b.kategori_id WHERE a.menu_id='$id'");
$data = mysqli_fetch_array($queryMenu);

$queryKategori = mysqli_query($conn, "SELECT * FROM kategori WHERE kategori_id != '$data[kategori_id]'"); {
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

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mie.Gacoan | Menu Detail</title>
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
        <h2>Detail Menu</h2>

        <div class="col-12 col-md-6 mb-5">
            <form action="" method="post" enctype="multipart/form-data">
                <div>
                    <label for="nama">Nama</label>
                    <input type="text" id="nama" name="nama" value="<?php echo $data['nama']; ?>" class="form-control" autocomplete="off" required>
                </div>
                <div class="mt-2">
                    <label for="kategori">Kategori</label>
                    <select name="kategori_id" id="kategori" class="form-control">
                        <option value="<?php echo $data['kategori_id']; ?>"><?php echo $data['nama_kategori']; ?></option>
                        <?php
                        while ($dataKategori = mysqli_fetch_array($queryKategori)) {
                        ?>
                            <option value="<?php echo $dataKategori['kategori_id']; ?>"><?php echo $dataKategori['nama']; ?></option>
                        <?php
                        }
                        ?>
                    </select>
                </div>
                <div class="mt-2">
                    <label for="harga">Harga</label>
                    <input type="number" name="harga" id="harga" class="form-control" value="<?php echo $data['harga']; ?>">
                </div>
                <div class="mt-4 mb-4">
                    <label for="currentFoto">Foto Menu Sekarang</label>
                    <img src="../img/<?php echo $data['foto']; ?>" alt="" width="200px">
                </div>
                <div class="mt-2">
                    <label for="foto">Foto</label>
                    <input type="file" name="foto" id="foto" class="form-control">
                </div>
                <div class="mt-2">
                    <label for="detail">Detail</label>
                    <textarea name="detail" id="detail" cols="30" rows="10" class="form-control">
                        <?php echo $data['detail']; ?>
                    </textarea>
                </div>
                <div class="mt-2">
                    <label for="ketersediaan_stok">Ketersediaan Stok</label>
                    <select name="ketersediaan_stok" id="ketersediaan_stok" class="form-control">
                        <option value="<?php echo $data['ketersediaan_stok']; ?>"><?php echo $data['ketersediaan_stok']; ?></option>
                        <?php
                        if ($data['ketersediaan_stok'] == 'tersedia') {
                        ?>
                            <option value="tersedia">Tersedia</option>
                        <?php
                        } else {
                        ?>
                            <option value="habis">Habis</option>

                        <?php
                        }
                        ?>
                    </select>
                </div>
                <div class="mt-2">
                    <button type="submit" class="btn btn-primary" name="simpan">Simpan</button>
                    <button type="submit" class="btn btn-danger" name="hapus">Hapus</button>
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
                    $queryUpdate = mysqli_query($conn, "UPDATE menu SET kategori_id='$kategori', nama='$nama', harga='$harga', detail='$detail', ketersediaan_stok='$ketersediaanStok' WHERE menu_id='$id'");

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

                                $queryUpdate = mysqli_query($conn, "UPDATE menu SET foto '$new_name' WHERE menu_id = '$id'");

                                if ($queryUpdate) {
                                ?>
                                    <div class="alert alert-primary mt-3" role="alert">
                                        Menu berhasil diperbarui
                                    </div>

                                    <meta http-equiv="refresh" content="2; url=menu.php" />
                    <?php
                                } else {
                                    echo mysqli_error($conn);
                                }
                            }
                        }
                    }
                }
            }

            if (isset($_POST['hapus'])) {
                $queryHapus = mysqli_query($conn, "DELETE FROM menu WHERE menu_id='$id'");
                if ($queryHapus) {
                    ?>
                    <div class="alert alert-primary mt-3" role="alert">
                        Menu berhasil Dihapus.
                    </div>
                    <meta http-equiv="refresh" content="2; url=kategori.php" />
            <?php
                }
            }
            ?>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>