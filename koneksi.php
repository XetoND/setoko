<?php
session_start();
ob_start();
$conn = mysqli_connect("localhost","root","","setoko");

function query($query){
  global $conn;
  $result = mysqli_query($conn,$query);
  $rows = [];
  while($row = mysqli_fetch_assoc($result)){
    $rows[] = $row;
  }
  return $rows;

}

function register($data){
  global $conn;

  $email = $data['email'];
  $username = $data['username'];
  $passwd = $data['passwd'];

  $validasi = query("SELECT (email) FROM user WHERE email='$email'");
    if(count($validasi)>0){
      return 0;
    }

  mysqli_query($conn,"INSERT INTO user (email,username,passwd)
  VALUE('$email','$username','$passwd')");

  return mysqli_affected_rows($conn);
}

function produk($data) {
    global $conn;
    $nama_barang = $data['nama_barang'];
    $stok_barang = $data['stok_barang'];
    $harga_barang = $data['harga_barang'];
    $deskripsi_barang = $data['deskripsi_barang'];
    $tgl_tambah = $data['tgl_tambah'];
    $gambar_barang = upload();
    if(!$gambar_barang){
      return false;
    }

    $query = "INSERT INTO barang(nama_barang,stok_barang,harga_barang,deskripsi_barang,tgl_tambah,gambar_barang)
        VALUES ('$nama_barang','$stok_barang','$harga_barang','$deskripsi_barang','$tgl_tambah','$gambar_barang')
                 ";
    mysqli_query($conn,$query);

    return mysqli_affected_rows($conn);
}

function upload(){
    $nameFile =$_FILES["gambar_barang"]["name"];
    $sizeFile =$_FILES["gambar_barang"]["size"];
    $error =$_FILES["gambar_barang"]["error"];
    $tmpName =$_FILES["gambar_barang"]["tmp_name"];

    if($error === 4){
      echo"<script>
            alert('Anda Belum Memasukan Gambar!!!')
      </script>";
      return false;
    }

    $ekstensiFile = ['jpg','jpeg','png'];
    $ekstensiGambar = explode('.',$nameFile);
    $ekstensiGambar = strtolower(end($ekstensiGambar));
    if(!in_array($ekstensiGambar, $ekstensiFile)){
      echo"<script>
            alert('Yang Anda bukan Upload Gambar!!!')
            </script>";
      return false;
    }

    if($sizeFile > 3000000 ){
      echo"<script>
            alert('Ukuran Gambar Terlalu Besar!!!')
      </script>";
      return false;
    }

    $nameFileNew = uniqid();
    $nameFileNew .= '.';
    $nameFileNew .= $ekstensiGambar;

    move_uploaded_file($tmpName,'gambar_produk/'.$nameFileNew);
    return $nameFileNew;
}

function update($data) {
    global $conn;


    $id_barang = $data['id_barang'];
    $nama_barang = $data['nama_barang'];
    $stok_barang = $data['stok_barang'];
    $harga_barang = $data['harga_barang'];
    $deskripsi_barang = $data['deskripsi_barang'];
    $tgl_update = $data['tgl_update'];
    $gambar_barang = $data['oldGambar'];

    if ($_FILES['gambar_barang']['error'] !== 4){
        $gambar_barang = upload();
    }

    if (!$gambar_barang) {
        return false;
    }

    $query = "UPDATE barang
                SET nama_barang='$nama_barang' ,
                    stok_barang='$stok_barang',
                    harga_barang='$harga_barang',
                    deskripsi_barang='$deskripsi_barang',
                    gambar_barang='$gambar_barang',
                    tgl_update='$tgl_update'
                WHERE id_barang='$id_barang'";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

?>
