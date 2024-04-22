<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

</head>
<body>
    
            <form action="signin_db.php" method="post" class="card" >
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


    <div class="sign-in">Sign in</div>
        <!-- <img src="https://sv1.picz.in.th/images/2022/04/19/8HbCr8.png" alt="" width="72" height="57"> -->
        <i id="logo" class="fa-solid fa-circle-user"></i>

        <div class="login-form">
            <i class="fa-solid fa-user" id="logo-input"></i>
            <label for="studentid" class="form-label"></label>
            <input type="text" class="input" name="studentid" aria-describedby="studentid" placeholder="StudentID">
        </div>

        <div class="login-form">
            <i class="fa-solid fa-lock" id="logo-input"></i>
            <label for="password" class="form-label"></label>
            <input type="password" class="input" name="password" placeholder="Password">
        </div>

    <br>
    <button type="submit" name="signin" class="btn-submit">Sign In</button><hr>
    <a href="Register.php" >Sign up</a>
</form>
                    
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
</body>
</html>