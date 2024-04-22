<?php
    session_start();
    require_once 'config/db.php';
    if (!isset($_SESSION['admin_login'])){
        $_SESSION['error'] = 'กรุณาเข้าสู่ระบบ';
        header('location: signin.php');
    }
	  include 'Navbar_A.html';

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
        <h1>Accept Item ให้มีการอัพเดทคอมเม้นถึง User เพิ่ม update ให้ติ๊ก</h1>
        <hr>
        <form action="accept.php" method="post" enctype="multipart/form-data" >
            <?php 
                if (isset($_GET['id'])){
                    $id = $_GET['id'];
                    $stmt = $conn->query("SELECT * FROM request WHERE id=$id");
                    $stmt->execute();
                    $data = $stmt->fetch();
                }


                ?>
          <div class="mb-3">
            <input type="hidden" readonly value="<?= $data['id']; ?>" require  class="form-control" name="id">
            <label for="code" class="col-form-label">Code</label>
            <input type="text" readonly  value="<?= $data['code']; ?>" require  class="form-control" name="code">
            <input type="hidden"  value="<?= $data['img2']; ?>" require  class="form-control" name="img3">
          </div>
          <div class="mb-3">
            <label for="name" class="col-form-label">Name</label>
            <input type="text" readonly  value="<?= $data['name']; ?>" require class="form-control" name="name">
          </div>
          <div class="mb-3">
            <label for="comments" class="col-form-label">Comments</label>
            <input type="text" value="<?= $data['comments']; ?>" require class="form-control" name="comments">
          </div>
          <div class="mb-3">
            <label for="user" class="col-form-label">User : </label>
            <input type="text" readonly value="<?= $data['user']; ?>" require class="form-control"  name="user">
          </div>
          <div class="mb-3">
            <label for="dates" class="col-form-label">Date Start : </label>
            <input type="date" name="dates" readonly  value="<?= $data['dates']; ?>" require class="form-control">
          </div>
          <div class="mb-3">
            <label for="datee" class="col-form-label">Date End : </label>
            <input type="date" name="datee"  readonly  value="<?= $data['datee']; ?>" require class="form-control">
          </div>
          <div class="mb-3">
            <label for="status" class="col-form-label">Accept: </label>
            <input type="checkbox" value="Accept"  require name="status">
          </div>
          <div class="mb-3">
            <label for="img" class="col-form-label">Image :</label>
            <img width="100%" src="uploads/<?= $data['img2'];?>" name="previewImg" alt="">
          </div>

          <div class="modal-footer">
            <a class="btn btn-secondary" href="user.php">Go Back</a>
            <button type="submit" name="ac" class="btn btn-success">ยืนยันการยืม</button>
          </div>

        </form>
            
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
    <script>
        let imgInput = document.getElementById('imgInput');
        let previewImg = document.getElementById('previewImg');

        imgInput.onchange = evt => {
            const [file] = imgInput.files;
            if (file) {
                previewImg.src = URL.createObjectURL(file);
            }
        }
    </script>

</body>
</html>