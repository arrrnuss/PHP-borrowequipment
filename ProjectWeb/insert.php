<?php

    session_start();
    require_once "config/db.php";

    if (isset($_POST['submit'])){
        $code = $_POST['code'];
        $name = $_POST['name'];
        $comments = $_POST['comments'];
        $img = $_FILES['img'];

        $allow = array('jpg','jpeg','png');
        $extension = explode('.', $img['name']);
        $fileActExt = strtolower(end($extension));
        $fileNew = rand() . "." . $fileActExt;
        $filePath = "uploads/".$fileNew;

        if (in_array($fileActExt, $allow)){
            if($img['size'] >0 && $img['error'] == 0){
                if(move_uploaded_file($img['tmp_name'], $filePath)){
                    $sql = $conn->prepare("INSERT INTO item(code, name, comments, img) 
                                                    VALUES(:code, :name, :comments, :img) ");
                    $sql->bindParam(":code",$code);
                    $sql->bindParam(":name",$name);
                    $sql->bindParam(":comments",$comments);
                    $sql->bindParam(":img",$fileNew);
                    $sql->execute();

                    if ($sql) {
                        $_SESSION['success'] = "Data has been inserted succesfully";
                        header("location: manage.php");
                    } else {
                        $_SESSION['error'] = "Data has not been inserted succesfully";
                        header("location: manage.php");
                    }
                }
            }

        }
    }

?>

