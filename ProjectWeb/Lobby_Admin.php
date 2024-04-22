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
    <link rel="stylesheet" href="style2.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

</head>
<body>


    <form class="card2">    
            

            <div class="sign-in">อุปกรณ์</div>

        <div class="container">  
         <table id="example"  class="table table-hover table-bordered table-dark" cellspacing="0" width="100%">
         <br><br>
            <thead>
             <tr class="table-active"  >
                    <th width="10%"><h5>Code</th>
                    <th width="10%"><h5>Name</th>
                    <th width="25%"><h5>Comments</th>
                    <th width="15%"><h5>User</th>
                    <th width="10%"><h5>dates</th>
                    <th width="10%"><h5>datee</th>
                    <th width="10%"><h5>Img</th>
                    <th width="10%"><h5>status</th>
            </tr>
            </thead>
            <tbody>
                <?php 

                    $user = $row['studentid'];
                    $stmt = $conn->query("SELECT * FROM request WHERE status = 'Accept'  ");
                    $stmt->execute();
                    $item = $stmt->fetchAll();

                    if (!$item) {
                        echo "<p><td colspan='6' class='text-center'>No Ite available</td></p>";
                    } else {
                    foreach($item as $items)  {  

                        if($items['status'] == 'Accept'){
                            $color="green";
                        }else if ($items['status'] == 'request'){
                            $color="yellow";
                        }

                ?>
                     <tr class="table-secondary">
                        <td><?php echo $items['code']; ?></td>
                        <td><?php echo $items['name']; ?></td>
                        <td><?php echo $items['comments']; ?></td>
                        <td><?php echo $items['user']; ?></td>
                        <td><?php echo $items['dates']; ?></td>
                        <td><?php echo $items['datee']; ?></td>
                        <td width="250px"><img class="rounded" width="100%" src="uploads/<?php echo $items['img2']; ?>" alt=""></td>
                        <td align="center"><font color="<?=$color?>"><?php echo $items['status']; ?></font></td>
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
</body>

</html>