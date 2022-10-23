<?php
require_once "koneksi.php";

if(!isset($_SESSION['login'])){
  header('location: login.php');
}

if (isset($_POST['submit'])) {
    if(produk($_POST) > 0){
      echo"<script>
              alert('Berhasil Menambah Produk/Barang');
              window.location = 'produk.php';
          </script>";
    }else{
      echo"<script>
              alert('Produk/Barang Gagal Ditambahkan');
          </script>";
  }
  }

?>

<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.101.0">
    <title>Input Produk</title>
    <link rel="canonical" href="https://getbootstrap.com/docs/5.2/examples/checkout/">
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


    <!-- Custom styles for this template -->
    <link href="css/form-validation.css" rel="stylesheet">
  </head>
  <body class="bg-light">
<div class="container">
  <main>
    <div class="py-5 text-center">
      <h2>Tambahkan Produk Baru</h2>
    </div>
    <div class="row g-5">
      <div class="col-md-7 col-lg-8">
        <h4 class="mb-3">Data Produk</h4>
        <form action="" method="post" enctype="multipart/form-data">
          <div class="row g-3">
            <div class="col-sm-6">
              <label for="nama_barang" class="form-label">Nama Produk</label>
              <input type="text" class="form-control" id="nama_barang" name="nama_barang" required>
            </div>

            <div class="col-sm-6">
              <label for="stok_barang" class="form-label">Stok Produk</label>
              <input type="text" class="form-control" id="stok_barang" name="stok_barang" required>
            </div>

            <div class="col-sm-12">
              <label for="harga_barang" class="form-label">Harga Produk</label>
              <input type="text" class="form-control" id="harga_barang" name="harga_barang" required>
            </div>

            <div class="col-sm-12">
              <label for="deskripsi_barang" class="form-label">Deskripsi Barang</label>
              <textarea class="form-control" name="deskripsi_barang" id="deskripsi_barang" required></textarea>
            </div>

            <div class="col-sm-12">
              <label for="gambar_barang" class="form-label">Foto Produk</label>
              <input type="file" class="form-control" name="gambar_barang" id="gambar_barang">
            </div>

            <div class="col-sm-12">
              <label for="tgl_tambah" class="form-label">Tanggal Ditambah</label>
              <input type="date" class="form-control" name="tgl_tambah" id="tgl_tambah">
            </div>
          <hr class="my-4">
          <button class="w-100 btn btn-primary btn-lg" type="submit" name="submit">Tambah Produk</button>
        </form>
      </div>
    </div>
  </main>
  <footer class="my-5 pt-5 text-muted text-center text-small">
    <p class="mb-1">SeToKo</p>
  </footer>
</div>

    <script src="assets/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/form-validation.js"></script>
  </body>
</html>
