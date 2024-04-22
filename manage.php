<?php
    session_start();
    require_once 'config/db.php';
    if (!isset($_SESSION['admin_login'])){
        $_SESSION['error'] = 'กรุณาเข้าสู่ระบบ';
        header('location: signin.php');
    }
	include 'Navbar_A.html';

    if (isset($_GET['delete'])){
        $delete_id = $_GET['delete'];
        $deletestmt = $conn->query("DELETE FROM item WHERE id = $delete_id");
        $deletestmt->execute();

        if ($deletestmt){
            echo "<script>alert('Data has been deleted successfully');</script>";
            $_SESSION['success'] = "Data has been deleted successfully";
            header("refresh:1; url=manage.php");
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
</head>
<body>

<div class="modal fade" id="userModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Item</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="insert.php" method="post" enctype="multipart/form-data" >
          <div class="mb-3">
            <label for="code" class="col-form-label">Code</label>
            <input type="text" require  class="form-control" name="code">
          </div>
          <div class="mb-3">
            <label for="name" class="col-form-label">Name</label>
            <input type="text" require class="form-control" name="name">
          </div>
          <div class="mb-3">
            <label for="comments" class="col-form-label">Comments</label>
            <input type="text" require class="form-control" name="comments">
          </div>
          <div class="mb-3">
            <label for="img" class="col-form-label">Image :</label>
            <input type="file" require  class="form-control" id="imgInput" name="img">
            <img width="100%" id= "previewImg" alt="">
          </div>

          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" name="submit" class="btn btn-success">Submit</button>
          </div>

        </form>
      </div>
     
    </div>
  </div>
</div>

    <div class="container mt-5">
        <div class="row">
        <h2 class="display-5 text-center">เพิ่มอุปกรณ์</h2>
        <h2 class="display-5 text-center">*ให้มีการเซ็ทค่า status เป็นว่าง ตั้งแต่ตอนแอดอุปกรณ์* ตอนมีคนยืมอุปกรณ์ ให้ส่งค่าไปอัพเดท status  ในตาราง item พร้อมกับ insert ข้อมูลในตาราง request
            **กันลืม</h2>
            <h2 class="display-5 text-center">เมื่อมีการลบหรืออัพเดทอุปกรณ์ ให้มีการลบในอีกตารางด้วย</h2>
            <div class="col-md-6">
            </div>


            <div class="col-md-6 d-flex justify-content-end">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#userModal">ADD</button>
            </div>
        </div>
        <br><br>
            <?php if (isset($_SESSION['success'])){ ?>
                <div class="alert alert-success">
                    <?php 
                        echo $_SESSION['success']; 
                        unset($_SESSION['success']);
                    ?>
                </div>
            <?php } ?>
            <?php if (isset($_SESSION['error'])){ ?>
                <div class="alert alert-danger">
                    <?php 
                        echo $_SESSION['error']; 
                        unset($_SESSION['error']);
                    ?>
                </div>
            <?php } ?>
        <div class="container">  
        <table id="example"  class="table table-hover table-bordered table-dark" cellspacing="0" width="100%">
            <thead>
            <tr class="table-active"  >
                    <th width="10%">Code</th>
                    <th width="10%">Name</th>
                    <th width="40%">Comments</th>
                    <th width="10%">Img</th>
                    <th width="12%">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    $stmt = $conn->query("SELECT * FROM item");
                    $stmt->execute();
                    $item = $stmt->fetchAll();

                    if (!$item) {
                        echo "<p><td colspan='6' class='text-center'>No Ite available</td></p>";
                    } else {
                    foreach($item as $items)  {  
                ?>
                    <tr class="table-secondary">
                        <td><?php echo $items['code']; ?></td>
                        <td><?php echo $items['name']; ?></td>
                        <td><?php echo $items['comments']; ?></td>
                        <td width="250px"><img class="rounded" width="100%" src="uploads/<?php echo $items['img']; ?>" alt=""></td>
                        <td>
                            <a href="edit.php?id=<?php echo $items['id']; ?>" class="btn btn-warning">Edit</a>
                            <a onclick="return confirm('Are you sure you want to delete?');" href="?delete=<?php echo $items['id']; ?>" class="btn btn-danger">Delete</a>
                        </td>
                    </tr>
                <?php }  } ?>
            </tbody>
            </table>
         </div>
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