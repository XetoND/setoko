<?php
require_once "koneksi.php";

if(isset($_SESSION['login'])){
  header('location:menu.php');
}

if(isset($_POST['login'])){
  $data = query("SELECT id, admin FROM user WHERE email='{$_POST['email']}' AND passwd= '{$_POST['passwd']}'");
    if (!empty($data)) {
        foreach($data as $d)
        $_SESSION['login'] = $d['id'];
        if($d['admin']){
            $_SESSION['admin'] = $d['id'];
        }
        header('location: menu.php');
        exit();
    }
    else{
      echo "
            <script>
                alert('Data Salah Silahkan Coba Lagi');

            </script>";
    }
  }
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans&family=Poppins:wght@300;400&display=swap" rel="stylesheet">
    <title>SeToko</title>
  </head>
  <body>
      <h1 class="h3 mb-3 text-center pt-3">SeToKo</h1>
      <div class="container col-xl-10 col-xxl-8 px-4 py-5">
      <div class="row align-items-center g-lg-5 py-5">
        <div class="col-lg-7 text-center text-lg-start">
          <h1 class="display-4 fw-bold lh-1 mb-3">Vertically centered hero sign-up form</h1>
          <p class="col-lg-10 fs-4">Below is an example form built entirely with Bootstrap’s form controls. Each required form group has a validation state that can be triggered by attempting to submit the form without completing it.</p>
        </div>
        <div class="col-md-10 mx-auto col-lg-5">
          <form class="p-4 p-md-5 border rounded-3 bg-light" action="" method="POST">
            <div class="text-center">
            <h2>Masuk Sekarang</h2>
            <p>Belum Punya Akun SeToko? <a href="register.php">Daftar disini.</a></p>
            </div>
            <div class="form-floating mb-3">
              <input type="email" class="form-control" id="floatingInput" name="email" placeholder="name@example.com">
              <label for="floatingInput">Email address</label>
            </div>
            <div class="form-floating mb-3">
              <input type="password" class="form-control" id="floatingPassword" name="passwd" placeholder="Password">
              <label for="floatingPassword">Password</label>
            </div>
            <button class="w-100 btn btn-lg btn-primary" type="submit" name="login">Masuk</button>
            <hr class="my-4">
          </form>
        </div>
      </div>
    </div>
  </body>
</html>
