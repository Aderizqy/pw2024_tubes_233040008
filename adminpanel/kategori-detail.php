<?php
require "session.php";
require "../koneksi.php";

$id = $_GET['p'];

$queryKategori = mysqli_query($conn, "SELECT * FROM kategori WHERE kategori_id='$id'");
$data = mysqli_fetch_array($queryKategori);
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Mie.Gacoan | Kategori Detail</title>
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
        <h2>Detail Kategori</h2>

        <div class="col-12 col-md-6">
            <form action="" method="post">
                <div>
                    <label for="kategori">Kategori</label>
                    <input type="text" name="kategori" id="kategori" class="form-control" autocomplete="off" value="<?php echo $data['nama']; ?>">
                </div>

                <div class="mt-3">
                    <button type="submit" class="btn btn-primary" name="editBtn">Edit</button>
                    <button type="submit" class="btn btn-danger" name="deleteBtn">Hapus</button>
                </div>
            </form>

            <?php
            // Proses edit kategori
            if (isset($_POST['editBtn'])) {
                $kategori = htmlspecialchars($_POST['kategori']);
                if ($data['nama'] == $kategori) {
            ?>
                    <meta http-equiv="refresh" content="0; url=kategori.php" />
                    <?php
                } else {
                    $queryCeck = mysqli_query($conn, "SELECT * FROM kategori WHERE nama='$kategori'");
                    $jumlahData = mysqli_num_rows($queryCeck);

                    if ($jumlahData > 0) {
                    ?>
                        <div class="alert alert-warning mt-3" role="alert">
                            Kategori sudah ada. Silakan pilih nama kategori lain.
                        </div>
                        <meta http-equiv="refresh" content="2; url=kategori.php" />
                        <?php
                    } else {
                        $querySimpan = mysqli_query($conn, "UPDATE kategori SET nama='$kategori' WHERE kategori_id='$id'");
                        if ($querySimpan) {
                        ?>
                            <div class="alert alert-primary mt-3" role="alert">
                                Kategori berhasil diperbarui.
                            </div>
                            <meta http-equiv="refresh" content="2; url=kategori.php" />
                    <?php
                        } else {
                            echo mysqli_error($conn);
                        }
                    }
                }
            }

            if (isset($_POST['deleteBtn'])) {
                $queryCeck = mysqli_query($conn, "SELECT * FROM menu WHERE kategori_id='$id'");
                $dataCount = mysqli_num_rows($queryCeck);

                if ($dataCount > 0) {
                    ?>
                    <div class="alert alert-warning mt-3" role="alert">
                        Kategori Tidak bisa Dihapus.
                    </div>
                <?php
                    die();
                }

                $queryDelete = mysqli_query($conn, "DELETE FROM kategori WHERE kategori_id='$id'");

                if ($queryDelete) {
                ?>
                    <div class="alert alert-primary mt-3" role="alert">
                        Kategori berhasil Dihapus.
                    </div>
                    <meta http-equiv="refresh" content="2; url=kategori.php" />
            <?php
                } else {
                    echo mysqli_error($conn);
                }
            }
            ?>
        </div>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>