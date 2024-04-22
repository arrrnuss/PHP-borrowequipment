
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


</head>
<body>


    <div class="container">
    <div class="row">
      <div class="col-lg-12 text-center">

    <div class="container mt-5">
        <div class="row">
        <h2 class="display-5 text-center">อุปกรณ์ทั้งหมด</h2>
            <div class="col-md-6">
            
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
                    <th width="10%"><h5>Code</th>
                    <th width="10%"><h5>Name</th>
                    <th width="40%"><h5>Comments</th>
                    <th width="10%"><h5>Img</th>
                    <th width="6%"><h5>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    $stmt = $conn->query("SELECT * FROM item WHERE status ='' ");
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
                        <td  width="250px"><img class="rounded" width="100%" src="uploads/<?php echo $items['img']; ?>" alt=""></td>
                        <td>
                            <a href="form_re.php?id=<?php echo $items['id']; ?>" class="btn btn-outline-success" >ยืมอุปกรณ์</a>
                        </td>
                    </tr>
                <?php }  } ?>
            </tbody>
            </table>
         </div>

    </div>

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