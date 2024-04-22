<?php
    session_start();
    require_once 'config/db.php';
    if (!isset($_SESSION['admin_login'])){
        $_SESSION['error'] = 'กรุณาเข้าสู่ระบบ';
        header('location: signin.php');
    }
	include 'Navbar_A.html';
    
    if (isset($_POST['update'])){
        $id = $_POST['id'];
        $code = $_POST['code'];
        $name = $_POST['name'];
        $comments = $_POST['comments'];
        $img = $_FILES['img'];
        $img2 = $_POST['img2'];
        $upload = $_FILES['img']['name'];

        if ($upload != ''){
            $allow = array('jpg','jpeg','png');
            $extension = explode('.', $img['name']);
            $fileActExt = strtolower(end($extension));
            $fileNew = rand() . "." . $fileActExt;
            $filePath = "uploads/".$fileNew;

            if (in_array($fileActExt, $allow)){
                if($img['size'] >0 && $img['error'] == 0){
                    move_uploaded_file($img['tmp_name'], $filePath);
                }
            }
        } else{
            $fileNew = $img2;
        }
        $sql = $conn->prepare("UPDATE item SET code = :code, name = :name, comments = :comments, img = :img WHERE id = :id");
        $sql->bindParam(":id", $id);
        $sql->bindParam(":code", $code);
        $sql->bindParam(":name", $name);
        $sql->bindParam(":comments", $comments);
        $sql->bindParam(":img", $fileNew);
        $sql->execute();

        if ($sql) {
            $_SESSION['success'] = "Data has been Updated succesfully";
            header("location: manage.php");
        } else {
            $_SESSION['error'] = "Data has not been Updated succesfully";
            header("location: manage.php");
        }

    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User page</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">

    <style>
        .container{
            max-width: 550px;
        }

    </style>

</head>
<body>

    <div class="container mt-5">
        <h1>Edit Item</h1>
        <hr>
        <form action="edit.php" method="post" enctype="multipart/form-data" >
            <?php 
                if (isset($_GET['id'])){
                    $id = $_GET['id'];
                    $stmt = $conn->query("SELECT * FROM item WHERE id=$id");
                    $stmt->execute();
                    $data = $stmt->fetch();
                }
                ?>
          <div class="mb-3">
            <input type="hidden" readonly value="<?= $data['id']; ?>" require  class="form-control" name="id">
            <label for="code" class="col-form-label">Code</label>
            <input type="text" value="<?= $data['code']; ?>" require  class="form-control" name="code">
            <input type="hidden" value="<?= $data['img']; ?>" require  class="form-control" name="img2">
          </div>
          <div class="mb-3">
            <label for="name" class="col-form-label">Name</label>
            <input type="text" value="<?= $data['name']; ?>" require class="form-control" name="name">
          </div>
          <div class="mb-3">
            <label for="comments" class="col-form-label">Comments</label>
            <input type="text" value="<?= $data['comments']; ?>" require class="form-control" name="comments">
          </div>
          <div class="mb-3">
            <label for="img" class="col-form-label">Image :</label>
            <input type="file" class="form-control" id="imgInput" name="img">
            <img width="100%" src="uploads/<?= $data['img'];?>" id= "previewImg" alt="">
          </div>

          <div class="modal-footer">
            <a class="btn btn-secondary" href="manage.php">Go Back</a>
            <button type="submit" name="update" class="btn btn-success">Update</button>
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