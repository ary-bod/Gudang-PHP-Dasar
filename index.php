<?php

include('connection.php');
$books = mysqli_query($conn, "SELECT * FROM books");
$count = mysqli_query($conn, "SELECT count(*) as total from books");
?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
  <title>Tempat Penyimpanan Buku</title>

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

    th,
    td {
      vertical-align: middle !important;
    }
  </style>
</head>

<body style="background-color: #ede0d4;">
  <div class="container py-5">
    <div class="jumbotron jumbotron-fluid" style="border-radius: 20px; padding-left: 60px; background-color: #e6ccb2; color: #7f5539;">
      <div class="container">
        <h1 class="display-3">Gudang Buku</h1>
        <p class="lead font-weight-normal">Tempatnya? Tempatnya penyimpanan buku lah! Kok malah nanya?! Canda whehe.</p>
      </div>
    </div>
    <a class="btn btn-outline-dark mb-4" href="add.php">Tambah Buku</a>
    <input id="jumlah_buku" type="hidden" value="<?= mysqli_fetch_assoc($count)['total']; ?>">
    <table class="table table-hover" style="border-top-left-radius: 20px; border-top-right-radius: 20px; background-color: #e6ccb2; color: #9c6644;">
      <thead>
        <tr>
          <th scope="col">##</th>
          <th scope="col">Judul</th>
          <th scope="col">Genre</th>
          <th scope="col">Tahun Terbit</th>
          <th scope="col">Penulis</th>
          <th scope="col" class="text-center">Aksi</th>
        </tr>
      </thead>
      <tbody id="table-body">
        <?php if (mysqli_num_rows($books) > 0) : ?>
          <?php $number = 0; ?>
          <?php while ($book = mysqli_fetch_assoc($books)) { ?>
            <tr id="<?= $book['id']; ?>">
              <th scope="row"><?= ++$number; ?></th>
              <td><?= $book['title']; ?></td>
              <td><?= $book['genre']; ?></td>
              <td><?= $book['published_year']; ?></td>
              <td><?= $book['author']; ?></td>
              <td class="text-center">
                <a href="edit.php?id=<?= $book['id']; ?>" class="btn btn-outline-brown"><i class="far fa-edit"></i> Ubah</a>
                <a href="delete.php?id=<?= $book['id']; ?>" class="btn btn-outline-danger" data-id="<?= $book['id']; ?>"><i class="fas fa-trash"></i> Hapus</a>
              </td>
            </tr>
          <?php } ?>
        <?php else : ?>
          <tr>
            <td colspan="6" class="text-center">Data Buku tidak ditemukan ...</td>
          </tr>
        <?php endif;  ?>
    </table>
  </div>

  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

  <script>
    $(".btn.btn-outline-danger").each(function(index) {
      $(this).on("click", function(e) {
        e.preventDefault();
        let href = e.currentTarget.getAttribute('href')
        let id = e.currentTarget.getAttribute('data-id')
        let jumlah_buku = $('#jumlah_buku').val()

        Swal.fire({
          title: 'Yakin mau dihapus?',
          text: "Kamu nggak bisa mengembalikan data ini loh",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Sok, hapus aja!',
          cancelButtonText: "Gak jadi deh"
        }).then((result) => {
          if (result.isConfirmed) {
            jQuery.ajax({
              url: href,
              success: function(data) {
                if (data == 1) {
                  $(`#${id}`).fadeOut();
                  Swal.fire(
                    'Berhasil!',
                    'Data buku berhasil dihapus',
                    'success'
                  )
                  if (jumlah_buku - 1 == 0) $('#table-body').html(`<tr><td colspan="6" class="text-center">Data Buku tidak ditemukan ...</td></tr>`)
                  $('#jumlah_buku').val(jumlah_buku - 1)
                }
              }
            })
          }
        })
      })
    })
  </script>
</body>

</html>