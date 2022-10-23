<?php
require_once "koneksi.php";

if(!isset($_SESSION['login'])){
  header('location: login.php');
}

$dataUser = query("SELECT id, username FROM user WHERE id = {$_SESSION['login']}");
foreach($dataUser as $data);

$dataBarang = query("SELECT * FROM barang WHERE id_barang='{$_GET['id_barang']}'");

if(isset($_POST['orderNow'])){
  $newQuantity = $_POST['oldQuantity']-$_POST['quantity'];
  mysqli_query($conn, "INSERT INTO carts(user_id,produk_id,quantity)
                        VALUES({$_SESSION['login']},
                                {$_POST['produkId']},
                                {$_POST['quantity']})");
  mysqli_query($conn, "UPDATE barang SET stok_barang=$newQuantity");
    header("location: http://localhost/setoko/detail_produk.php?id_barang={$_POST['produkId']}");
}
?>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="canonical" href="https://getbootstrap.com/docs/5.2/examples/navbars-offcanvas/">
    <link rel="canonical" href="https://getbootstrap.com/docs/5.2/examples/album/">
    <link href="assets/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="css/offcanvas.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <title>Detail Produk</title>
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

<section style="background-color: #eee; margin-top: 128px;">
  <div class="container py-5">
    <div class="row bg-light p-3">
      <?php
        foreach( $dataBarang as $d ):
      ?>
      <div class="col-md-4 py-3">
        <img src="<?= empty($d['gambar_barang']) ? 'gambar_produk/gambar_kosong.jpg' : 'gambar_produk/'.$d['gambar_barang'] ?>" class="img-fluid rounded">
      </div>
      <div class="col-md-6">
        <div class="d-flex flex-column justify-content-between gap-1">
          <div class="d-flex flex-column justify-content-center">
            <h3><?= $d['nama_barang']?></h3>
            <small>Stok Produk : <?= $d['stok_barang']?></small>
          </div>
          <h1><?= "Rp.".number_format($d['harga_barang'],2,",","."); ?></h1>
          <div class="d-flex align-items-center border border-end-0 border-start-0">
            <h5>Details</h5>
          </div>
          <div class="mb-4 mb-md-0 overflow-auto" style="height: 200px;">
            <?=$d['deskripsi_barang']?>
          </div>
        </div>
      </div>
      <div class="col-md-2 d-flex flex-column justify-content-start align-items-center">
        <h2>Buy Now</h2>
          <form  action="" method="POST">
            <input type="hidden" name="produkId" value="<?= $d['id_barang']?>">
            <input type="hidden" name="oldQuantity" value="<?= $d['stok_barang']?>">
            <div class="mb-3">
              <input type="number" class="form-control" id="counter" onchange="quantityCounter()" value="1" min="1" name="quantity">
            </div>
            <button class="w-100 btn btn-primary" type="submit" name="orderNow">Beli</button>
          </form>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

    <footer class="text-muted py-5">
      <div class="container">
        <p class="float-end mb-1">
          <a href="#">Back to top</a>
        </p>
      </div>
    </footer>
  </body>
</html>

<?php
ob_end_flush();
?>
