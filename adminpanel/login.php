<?php
session_start();
require "../koneksi.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mie.Gacoan | Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<style>
    body {
        background: url('../img/div2.jpg');
        background-size: cover;
        background-position: center;
    }

    .main {
        height: 100vh;
    }

    .login-box {
        width: 80%;
        max-width: 500px;
        height: auto;
        box-sizing: border-box;
        border-radius: 10px;
        background-color: rgba(255,255,255,0.5);
    }

    .card-header {
        font-size: 28px;
    }
</style>

<body>

    <div class="main d-flex flex-column justify-content-center align-items-center">
        <div class="login-box p-4 shadow">
            <div class="card-header text-center">
                <h2>Login</h2>
            </div>
            <form action="" method="post">
                <div>
                    <label for="username">Username</label>
                    <input type="text" class="form-control" name="username" id="username" autocomplete="off">
                </div>
                <div>
                    <label for="password">Password</label>
                    <input type="text" class="form-control" name="password" id="password" autocomplete="off">
                </div>
                <div>
                    <button class="btn btn-success form-control mt-3" type="submit" name="loginbtn">Login</button>
                </div>
            </form>
        </div>
        <div class="mt-3" style="width: 500px">
            <?php
            if (isset($_POST['loginbtn'])) {
                $username = htmlspecialchars($_POST['username']);
                $password = htmlspecialchars($_POST['password']);

                $query = mysqli_query($conn, "SELECT * FROM users WHERE username='$username'");
                $countdata = mysqli_num_rows($query);
                $data = mysqli_fetch_array($query);

                if ($countdata > 0) {
                    if (password_verify($password, $data['password'])) {
                        $_SESSION['username'] = $data['username'];
                        $_SESSION['login'] = true;
                        header('location: index.php');
                    } else {
            ?>
                        <div class="alert alert-warning" role="alert">
                            Password Salah!!
                        </div>
                    <?php
                    }
                } else {
                    ?>
                    <div class="alert alert-warning" role="alert">
                        Akun tidak Tersedia
                    </div>
            <?php
                }
            }

            ?>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>