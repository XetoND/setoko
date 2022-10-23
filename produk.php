<?php
require_once "koneksi.php";

if(!isset($_SESSION['login'])){
  header('location: login.php');
}

$data = query("SELECT * FROM barang");
?>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.101.0">
    <title>Page Product</title>
    <link rel="canonical" href="https://getbootstrap.com/docs/5.2/examples/album/">
    <link href="assets/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }

      .b-example-divider {
        height: 3rem;
        background-color: rgba(0, 0, 0, .1);
        border: solid rgba(0, 0, 0, .15);
        border-width: 1px 0;
        box-shadow: inset 0 .5em 1.5em rgba(0, 0, 0, .1), inset 0 .125em .5em rgba(0, 0, 0, .15);
      }

      .b-example-vr {
        flex-shrink: 0;
        width: 1.5rem;
        height: 100vh;
      }

      .bi {
        vertical-align: -.125em;
        fill: currentColor;
      }

      .nav-scroller {
        position: relative;
        z-index: 2;
        height: 2.75rem;
        overflow-y: hidden;
      }

      .nav-scroller .nav {
        display: flex;
        flex-wrap: nowrap;
        padding-bottom: 1rem;
        margin-top: -1px;
        overflow-x: auto;
        text-align: center;
        white-space: nowrap;
        -webkit-overflow-scrolling: touch;
      }
    </style>


  </head>
<body>
  <main>
    <nav class="navbar navbar-dark bg-dark" aria-label="Dark offcanvas navbar">
      <div class="container-fluid">
        <a class="navbar-brand" href="menu.php">SeToKo</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbarDark" aria-controls="offcanvasNavbarDark">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="offcanvas offcanvas-end text-bg-dark" tabindex="-1" id="offcanvasNavbarDark" aria-labelledby="offcanvasNavbarDarkLabel">
          <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="offcanvasNavbarDarkLabel">SeToKo</h5>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
          </div>
          <div class="offcanvas-body">
            <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="menu.php">Home</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="dashboard.php">Dashboard</a>
              </li>
              <?php if(isset($_SESSION['admin'])):?>
              <li class="nav-item">
                <a class="nav-link" href="logout.php">Logout</a>
              </li>
              <?php endif;?>
            </ul>
          </div>
        </div>
      </div>
    </nav>
  </main>

<main>
  <section class="py-5 text-center container">
    <div class="row py-lg-5">
      <div class="col-lg-6 col-md-8 mx-auto">
        <h1 class="fw-light">Produk Tersedia</h1>
        <p class="lead text-muted">Tambah,Edit atau Delete Produk yang tersedia</p>
        <p>
          <a href="input_produk.php" class="btn btn-primary my-2">Tambah Produk</a>
        </p>
      </div>
    </div>
  </section>
    <div class="container">
      <div class="row row-cols-2 row-cols-lg-5 g-2 g-lg-3">
        <?php
          foreach( $data as $d ):
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
                  <a type="button" class="btn btn-sm btn-outline-secondary" href="update.php?id_barang=<?= $d['id_barang'] ?>">Update</a>
                  <a type="button" class="btn btn-sm btn-outline-danger" href="delete.php?id_barang=<?= $d['id_barang'] ?>" name="removeProduct">Hapus</a>
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

<!-- JS -->
<script src="assets/dist/js/bootstrap.bundle.min.js"></script>
<!-- /JS -->

</body>
</html>
