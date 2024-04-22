<?php
    session_start();
    require_once 'config/db.php';
    if (!isset($_SESSION['user_login'])){
        $_SESSION['error'] = 'กรุณาเข้าสู่ระบบ';
        header('location: signin.php');
    }
	  include 'Navbar_S.html';

?>
<!DOCTYPE html>
<html lang="en">
  
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <!-- Bootstrap core CSS -->
    <link href="../assets/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        .container{
            max-width: 550px;
        }

    </style>


</head>
<body>

<div class="container mt-5">
        <h1>Request Item ให้มีการส่งดีเทลไปให้แอดมินด้วยว่ายืมไปทำอะไร</h1>
        <hr>
        <form action="insert_from.php" method="post" enctype="multipart/form-data" >
            <?php 
                if (isset($_GET['id'])){
                    $id = $_GET['id'];
                    $stmt = $conn->query("SELECT * FROM item WHERE id=$id");
                    $stmt->execute();
                    $data = $stmt->fetch();
                }

                if(isset($_SESSION['user_login'])){
                  $user_id = $_SESSION['user_login'];
                  $stmt = $conn->query("SELECT * FROM users WHERE id = $user_id");
                  $stmt->execute();
                  $row = $stmt->fetch(PDO::FETCH_ASSOC);
                      }

                ?>
          <div class="mb-3">
            <input type="text" readonly value="<?= $data['id']; ?>" require  class="form-control" name="id">
            <label for="code" class="col-form-label">Code</label>
            <input type="text" readonly  value="<?= $data['code']; ?>" require  class="form-control" name="code">
            <input type="hidden"  value="<?= $data['img']; ?>" require  class="form-control" name="img2">
          </div>
          <div class="mb-3">
            <label for="name" class="col-form-label">Name</label>
            <input type="text" readonly  value="<?= $data['name']; ?>" require class="form-control" name="name">
          </div>
          <div class="mb-3">
            <label for="comments" class="col-form-label">Comments</label>
            <input type="text" readonly value="<?= $data['comments']; ?>" require class="form-control" name="comments">
          </div>
          <div class="mb-3">
            <label for="user" class="col-form-label">User : </label>
            <input type="text" readonly value="<?= $row['studentid']; ?>" require class="form-control"  name="user">
          </div>
          <div class="mb-3">
            <label for="dates" class="col-form-label">Date Start : </label>
            <input type="date" name="dates"  min="<?php echo date('Y-m-d');?>">
          </div>
          <div class="mb-3">
            <label for="datee" class="col-form-label">Date End : </label>
            <input type="date" name="datee"  min="<?php echo date('Y-m-d');?>">
          </div>
          <div class="mb-3">
            <label for="status" class="col-form-label">Request: </label>
            <input type="checkbox" value="request"  require name="status">
          </div>
          <div class="mb-3">
            <label for="img" class="col-form-label">Image :</label>
            <img width="100%" src="uploads/<?= $data['img'];?>" name="previewImg" alt="">
          </div>

          <div class="modal-footer">
            <a class="btn btn-secondary" href="user.php">Go Back</a>
            <button type="submit" name="confirm" class="btn btn-success">ยืนยันการยืม</button>
          </div>

        </form>
            
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
    <!-- <script>
        let imgInput = document.getElementById('imgInput');
        let previewImg = document.getElementById('previewImg');

        imgInput.onchange = evt => {
            const [file] = imgInput.files;
            if (file) {
                previewImg.src = URL.createObjectURL(file);
            }
        }
    </script> -->

</body>
</html>