<?php

include('connection.php');

if (!$_SESSION['username']) header('Location: login.php');

if ($_POST) {
  $title = ucwords($_POST['title']);
  $genre = ucwords($_POST['genre']);
  $published_year = $_POST['published_year'];
  $author = ucwords($_POST['author']);

  $query_insert_book = "INSERT INTO books (title, genre, published_year, author) VALUES ('$title', '$genre', '$published_year', '$author')";
}
?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
  <title>Tempat Penyimpanan Buku - Tambah Buku</title>

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
  </style>
</head>

<body style="background-color: #ede0d4;">
  <div class="container mt-5">
    <div class="jumbotron jumbotron-fluid" style="border-radius: 20px; padding-left: 60px; background-color: #e6ccb2; color: #7f5539;">
      <div class="container">
        <h1 class="display-3">Gudang Buku</h1>
        <p class="lead font-weight-normal">Sekarang kamu lagi di <b>Menu Tambah Buku</b> nih.</p>
      </div>
    </div>
    <div class="mt-5 px-4 py-4" style="border-radius: 20px; background-color: #e6ccb2; color: #9c6644;">
      <form action="" method="POST">
        <div class="row">
          <div class="col-md-12">
            <?php if ($_POST) : ?>
              <?php if (mysqli_query($conn, $query_insert_book)) : ?>
                <div class="alert alert-brown" role="alert">
                  Berhasil! Buku berhasil ditambahkan.
                </div>
              <?php else : ?>
                <div class="alert alert-warning" role="alert">
                  Maaf! Buku gagal ditambahkan.
                </div>
              <?php endif; ?>
            <?php endif; ?>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label for="title">Judul Buku</label>
              <input type="text" class="form-control" id="title" name="title" required>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label for="genre">Genre Buku</label>
              <input type="text" class="form-control" id="genre" name="genre" required>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label for="published_year">Tahun Terbit Buku</label>
              <input type="number" class="form-control" id="published_year" name="published_year" required>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label for="author">Penulis Buku</label>
              <input type="text" class="form-control" id="author" name="author" required>
            </div>
          </div>
          <div class="col-md-6">
            <a href="index.php" class="btn btn-outline-brown btn-block"><i class="fas fa-long-arrow-alt-left"></i> Kembali</a>
          </div>
          <div class="col-md-6">
            <button type="submit" class="btn btn-brown btn-block">Tambah Buku</button>
          </div>
        </div>
      </form>
    </div>
  </div>

  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>