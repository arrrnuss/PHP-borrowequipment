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
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="style2.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
</head>
<body>
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


    <form class="card2">
            

      <div class="sign-in">อุปกรณ์ที่ยืม</div>

        <div class="container">  
         <table id="example"  class="table table-hover table-bordered table-dark" cellspacing="0" width="100%">
         <br><br>
            <thead>
             <tr class="table-active"  >
                    <th width="10%"><h5>Code</th>
                    <th width="10%"><h5>Name</th>
                    <th width="40%"><h5>Comments</th>
                    <th width="10%"><h5>dates</th>
                    <th width="10%"><h5>datee</th>
                    <th width="10%"><h5>Img</th>
                    <th width="10%"><h5>status</th>
                    <th width="15%"><h5>Actions</th>
            </tr>
            </thead>
            <tbody>
                <?php 

                    $user = $row['studentid'];
                    $stmt = $conn->query("SELECT * FROM request WHERE user = $user  ");
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
                        <td><?php echo $items['dates']; ?></td>
                        <td><?php echo $items['datee']; ?></td>
                        <td width="250px"><img class="rounded" width="100%" src="uploads/<?php echo $items['img2']; ?>" alt=""></td>
                        <td><?php echo $items['status']; ?></td>
                        <td>
                            <a href="form_re.php?id=<?php echo $items['id']; ?>" class="btn btn-outline-danger">ยกเลิกการยืม</a>
                        </td>
                    </tr>
                <?php }  } ?>
            </tbody>
            </table>
        </div>
    </form>
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

    <!-- <script>
        if(document.compatMode == "CSS1Compat"){
            alert("Stan");
        }else if (document.compatMode == "BackCompat"){
            alert("Quirks");
        }
    </script> -->

</body>

</html>