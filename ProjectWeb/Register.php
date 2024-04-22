<?php
    session_start();
    require_once 'config/db.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Regis</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>

   
        <form action="signup_db.php" method="post" class="card2">
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
            <?php if(isset($_SESSION['warning'])) { ?>
                <div class="alert alert-warning" role="alert">
                    <?php
                        echo $_SESSION['warning'];
                        unset($_SESSION['warning']);
                    ?>
                </div>
            <?php } ?>

        <div class="sign-up">Sign up</div>

            <div class="signup-form">
                <i class="fa-solid fa-id-badge" id="logo-input"></i>
                <label for="studentid" class="form-label"></label>
                <input type="text" class="input" name="studentid" aria-describedby="studentid" placeholder="StudentID" >
            </div>
            <div class="signup-form">
                <i class="fa-solid fa-user" id="logo-input"></i>
                <label for="Firstname" class="form-label">  </label>
                <input type="text" class="input" name="firstname" aria-describedby="firstname" placeholder="Firstname" >
            </div>
            <div class="signup-form">
                <i class="fa-solid fa-user" id="logo-input"></i>
                <label for="lastname" class="form-label"></label>
                <input type="text" class="input" name="lastname" aria-describedby="lastname" placeholder="Lastname">
            </div>
            <div class="signup-form">
                <i class="fa-solid fa-envelope" id="logo-input"></i>
                <label for="email" class="form-label"></label>
                <input type="email" class="input" name="email" aria-describedby="email" placeholder="Email">
            </div>
            <div class="signup-form">
                <i class="fa-solid fa-lock" id="logo-input"></i>
                <label for="password" class="form-label"></label>
                <input type="password" class="input" name="password" placeholder="Password">
            </div>
            <div class="signup-form">
                <i class="fa-solid fa-lock" id="logo-input"></i>
                <label for="confirm password" class="form-label"></label>
                <input type="password" class="input" name="c_password" placeholder="Confirm Password">
            </div>
            <button type="submit" name="signup" class="btn-submit">Sign Up</button>
           <a href="signin.php" >Sign in</a>
        </form>
        <hr>
      


</body>
</html>