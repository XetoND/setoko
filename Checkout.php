<?php
include 'koneksi.php';

if(isset($_POST['removeProduct'])){
  $id_barang=$_GET['id_barang'];
  mysqli_query($conn,"DELETE FROM barang WHERE id_barang='$id_barang'");
  header("location: produk.php");
}


if(isset($_POST['removeCart'])){
  $order_id = $_POST['orderId'];
  mysqli_query($conn,"DELETE FROM carts WHERE order_id = '$order_id'");
  header("location: keranjang.php");
}

?>
