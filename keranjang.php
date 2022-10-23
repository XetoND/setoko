<?php
require_once "koneksi.php";

if(!isset($_SESSION['login'])){
  header('location: login.php');
}

$dataUser = query("SELECT id, username FROM user WHERE id = {$_SESSION['login']}");
foreach($dataUser as $data);

$dataProduk = mysqli_query($conn,"SELECT
                                c.order_id,
                                c.quantity AS total_buy,
                                c.order_status,
                                b.nama_barang,
                                b.stok_barang,
                                b.harga_barang,
                                b.gambar_barang,
                                u.username
                                FROM carts AS c
                                INNER JOIN barang AS b ON
                                  b.id_barang = c.produk_id
                                INNER JOIN user AS u ON
                                  u.id = c.user_id
                                WHERE c.user_id = {$_SESSION['login']}
                                ORDER BY c.order_status");


?>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="canonical" href="https://getbootstrap.com/docs/5.2/examples/navbars-offcanvas/">
    <link rel="canonical" href="https://getbootstrap.com/docs/5.2/examples/album/">
    <link href="assets/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="css/offcanvas.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.2/css/all.css" />
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

    <form action="Checkout.php" method="post" class="cart-items" style="padding: 2% 0">
                        <div class="row bg-white">
                          <?php
                            foreach( $dataProduk as $d ):
                          ?>
                          <input type="hidden" name="orderId" value="<?= $d['order_id'] ?>">
                            <div class="col-md-3 pl-0 ms-3">
                                <img src="<?= empty($d['gambar_barang']) ? 'gambar_produk/gambar_kosong.jpg' : 'gambar_produk/'.$d['gambar_barang'] ?>" class="img-fluid">
                            </div>
                            <div class="col-md-6">
                                <h5 class="pt-2"><?= $d['nama_barang']?></h5>
                                <small class="text-secondary" name="total"><?= $d['total_buy']?></small>
                                <h5 class="pt-2" name="hargaProduk"><?= "Rp.".number_format($d['harga_barang'],2,",","."); ?></h5>
                                <button name="" class="btn btn-warning">Checkout</button>
                                <button class="btn btn-danger mx-2" name="removeCart">Hapus</button>
                            </div>
                            <?php endforeach; ?>
                        </div>
                </form>

  </body>
</html>
