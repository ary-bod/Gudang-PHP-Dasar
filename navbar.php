<nav class="navbar navbar-expand-lg navbar-light" style="background-color: #e6ccb2; color: #7f5539;">
  <div class="container">
    <a class="navbar-brand" href="index.php">Gudang</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav ml-auto">
        <?php if (!isset($_SESSION['username'])) : ?>
          <li class="nav-item">
            <a class="nav-link" href="login.php">Masuk</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="register.php">Registrasi</a>
          </li>
        <?php else : ?>
          <li class="nav-item">
            <a class="nav-link" href="logout.php">Keluar</a>
          </li>
        <?php endif; ?>
      </ul>
    </div>
  </div>
</nav>