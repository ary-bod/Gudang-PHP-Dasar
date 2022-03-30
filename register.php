<?php

include('connection.php');

if (isset($_SESSION['username'])) header('Location: index.php');

$pesan_error = "";
if ($_POST) {
  $name = $_POST['name'];
  $username = strtolower($_POST['username']);
  $password = $_POST['password'];

  var_dump($_POST);
  if (!$name || !$username || !$password) {
    $pesan_error = "Nama, Username, dan Password diperlukan.";
    var_dump("DUAR SATU 16");
  } else {
    $result = mysqli_query($conn, "SELECT username FROM users WHERE username='$username'");
    var_dump("DUAR SATU 19");
    if (mysqli_fetch_assoc($result)) {
      $pesan_error = "Username sudah digunakan oleh pengguna lain.";
      var_dump("DUAR SATU 22");
    } else {
      $password = password_hash($password, PASSWORD_DEFAULT);
      mysqli_query($conn, "INSERT INTO users VALUES('', '$name', '$username', '$password')");
      $register_status = mysqli_affected_rows($conn);
      var_dump("DUAR SATU 27");
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
  <title>Tempat Penyimpanan Buku | Halaman Registrasi</title>

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
          <h1>Halaman Registrasi</h1>
        </div>
        <?php if ($_POST && $pesan_error !== "") : ?>
          <div class="alert alert-warning" role="alert">
            <?= $pesan_error; ?>
            <?= mysqli_error($conn); ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
        <?php elseif ($_POST && $register_status == 1) : ?>
          <div class="alert alert-brown" role="alert">
            Register berhasil! Silahkan login untuk melanjutkan!
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
        <?php endif; ?>
        <form method="post">
          <div class="form-group text-left">
            <label for="name">Nama Lengkap</label>
            <input type="text" name="name" class="form-control" id="name">
          </div>
          <div class="form-group text-left">
            <label for="username">Username</label>
            <input type="text" name="username" class="form-control" id="username">
          </div>
          <div class="form-group text-left">
            <label for="password">Password</label>
            <input type="password" name="password" class="form-control" id="password">
          </div>
          <button type="submit" class="btn btn-brown btn-block">Register</button>
        </form>
      </div>
    </div>
  </div>

  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
</body>

</html>