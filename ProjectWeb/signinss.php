<?php session_start(); ?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.84.0">
    <title>Sign In</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <link rel="stylesheet" href="style.css">
    <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/sign-in/">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    

    <!-- Bootstrap core CSS -->
<link href="../assets/dist/css/bootstrap.min.css" rel="stylesheet">

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
    </style>

    
    <!-- Custom styles for this template -->
    <link href="signin.css" rel="stylesheet">
  </head>
  <body >
    
    <div class="container">
      <form action="signin_db.php" method="post">
           <?php if(isset($_SESSION['error'])) { ?>
              <div class="alert alert-danger" role="alert">
                  <?php
                      echo $_SESSION['error'];
                      unset($_SESSION['error']);
                  ?>
              </div>
          <?php } ?>
          <?php if(isset($_SESSION['success'])) { ?>
              <div class="alert alert-success" role="alert">
                  <?php
                      echo $_SESSION['success'];
                      unset($_SESSION['success']);
                  ?>
              </div>
          <?php } ?>

<main class="form-signin">
  <form>
    <!-- <img src="https://sv1.picz.in.th/images/2022/04/19/8HbCr8.png" alt="" width="72" height="57"> -->
    <br><br>
    <h1 class="h3 mb-3 fw-normal">Sign in</h1>
    <i class="fa-solid fa-circle-user"></i>

    <div class="login-form">
        <i class="fa-solid fa-user"></i>
        <input type="text" class="form-control" name="studentid" aria-describedby="studentid" placeholder="StudentID">
        <span data-placeholder="Username"></span>
    </div>

    <div class="login-form">
        <i class="fa-solid fa-lock"></i>
        <input type="password" class="form-control" name="password" placeholder="Password">
        <span data-placeholder="Password"></span>
    </div>

<br>
<button type="submit" name="signin" class="btn btn-primary">Sign In</button><hr>
  </form>
  <a href="Register.php" >Register</a>
</main>
</form>

    
  </body>
</html>
