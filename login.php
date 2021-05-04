<?php

include('connection.php');

if (isset($_SESSION['username'])) header('Location: index.php');

$pesan_error = "";
if ($_POST) {
  $username = $_POST['username'];
  $password = $_POST['password'];
  if (!$username || !$password) {
    $pesan_error = "Username dan password diperlukan.";
  } else {
    $result = mysqli_query($conn, "SELECT * FROM users WHERE username = '$username'");

    if (mysqli_num_rows($result) === 1) {
      $result = mysqli_fetch_assoc($result);

      if (password_verify($password, $result['password'])) {
        $_SESSION["name"] = $result['name'];
        $_SESSION["username"] = $result['username'];
        header("Location: index.php");
        exit();
      } else {
        $pesan_error = "Username dan password salah atau tidak ditemukan.";
      }
    } else {
      $pesan_error = "Username dan password salah atau tidak ditemukan.";
    }
  }
}
?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
  <title>Tempat Penyimpanan Buku | Halaman Login</title>

  <style>
    .btn-outline-brown {
      color: #7f5539;
      border-color: #9c6644;
    }

    .btn-outline-brown:hover {
      color: #fff;
      background-color: #9c6644;
      border-color: #9c6644;
    }

    .btn-brown {
      color: #e6ccb2;
      background-color: #9c6644;
      border-color: #9c6644;
    }

    .btn-brown:hover {
      color: #fff;
      background-color: #9c6644;
      border-color: #9c6644;
    }

    .alert-brown {
      border-color: #b08968;
      background-color: #ddb892;
      color: #7f5539;
    }

    th,
    td {
      vertical-align: middle !important;
    }
  </style>
</head>

<body style="background-color: #ede0d4;">
  <?php include('navbar.php') ?>
  <div class="container justify-content-center text-center mt-5">
    <div class="card" style="border-radius: 20px; background-color: #e6ccb2; color: #7f5539;">
      <div class=" card-body my-4 mx-4">
        <div class="card-title">
          <h1>Halaman Login</h1>
        </div>
        <?php if ($_POST && $pesan_error !== "") : ?>
          <div class="alert alert-warning" role="alert">
            <?= $pesan_error; ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
        <?php endif; ?>
        <form method="post">
          <div class="form-group text-left">
            <label for="username">Username</label>
            <input type="text" name="username" class="form-control" id="username">
          </div>
          <div class="form-group text-left">
            <label for="password">Password</label>
            <input type="password" name="password" class="form-control" id="password">
          </div>
          <button type="submit" class="btn btn-brown btn-block">Masuk</button>
        </form>
      </div>
    </div>
  </div>

  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
</body>

</html>