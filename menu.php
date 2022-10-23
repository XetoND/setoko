<?php
require_once "koneksi.php";

if(!isset($_SESSION['login'])){
  header('location: login.php');
}

$dataUser = query("SELECT id, username FROM user WHERE id = {$_SESSION['login']}");
foreach($dataUser as $data);

$dataBarang = query("SELECT * FROM barang");
?>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="canonical" href="https://getbootstrap.com/docs/5.2/examples/navbars-offcanvas/">
    <link rel="canonical" href="https://getbootstrap.com/docs/5.2/examples/album/">
    <link href="assets/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="css/offcanvas.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <title>Halaman Menu</title>
  </head>
  <body>
    <!-- JS -->
    <script src="assets/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/offcanvas.js"></script>
    <!-- JS -->
    <main class="container">
      <nav class="navbar navbar-expand-lg fixed-top navbar-dark bg-dark" aria-label="Main navigation">
      <div class="container-fluid">
        <a class="navbar-brand" href="menu.php">SeToKo</a>
        <button class="navbar-toggler p-0 border-0" type="button" id="navbarSideCollapse" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="navbar-collapse offcanvas-collapse" id="navbarsExampleDefault">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link" href="#">Kategori</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Notifications</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Profile</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Switch account</a>
            </li>
            <?php if(isset($_SESSION['login'])): ?>
            <div class="position-fixed start-10 end-0">
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="" data-bs-toggle="dropdown" aria-expanded="false"><?= $data['username']?></a>
            <?php endif; ?>
                <ul class="dropdown-menu dropdown-menu-end">
                  <?php if(!isset($_SESSION['admin'])): ?>
                  <li><a class="dropdown-item" href="#">Pembelian</a></li>
                  <li><a class="dropdown-item" href="keranjang.php">Keranjang</a></li>
                  <?php endif; ?>
                  <?php if(isset($_SESSION['admin'])):?>
                  <li><a class="dropdown-item" href="dashboard.php">Dashboard</a></li>
                  <?php endif;?>
                  <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                </ul>
              </li>
            </div>
          </ul>
        </div>
      </div>
        </nav>
    </main>

    <main>
      <section class="py-5 text-center container">
        <div class="row py-lg-5">
          <div class="col-lg-6 col-md-8 mx-auto">
            <h1 class="fw-light">Produk Tersedia</h1>
            <p class="lead text-muted">Cari Barang atau Produk yang Ingin Anda Beli</p>
          </div>
        </div>
      </section>
        <div class="container">
          <div class="row row-cols-2 row-cols-lg-5 g-2 g-lg-3">
            <?php
              foreach( $dataBarang as $d ):
            ?>
            <div class="col">
              <div class="card shadow-sm">
                <img class="foto" src="gambar_produk/<?= $d['gambar_barang']?>" height="160px">
                <div class="card-body">
                  <p class="card-text"><?= $d['nama_barang'] ?></p>
                  <p class="card-text"><b><?= "Rp.".number_format($d['harga_barang'],2,",","."); ?></b></p>
                  <div class="d-flex justify-content-between align-items-center">
                    <div class="btn-group">
                      <a type="button" class="btn btn-sm btn-outline-primary" href="detail_produk.php?id_barang=<?= $d['id_barang'] ?>">Detail</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <?php
              endforeach;
            ?>
          </div>
        </div>
    </main>

    <footer class="text-muted py-5">
      <div class="container">
        <p class="float-end mb-1">
          <a href="#">Back to top</a>
        </p>
      </div>
    </footer>
  </body>
</html>
