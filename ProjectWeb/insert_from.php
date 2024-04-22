<?php

    session_start();
    require_once "config/db.php";
    

    if (isset($_POST['confirm'])){
        $id = $_POST['id'];
        $code = $_POST['code'];
        $name = $_POST['name'];
        $comments = $_POST['comments'];
        $user = $_POST['user'];
        $dates = $_POST['dates'];
        $datee = $_POST['datee'];
        $status = $_POST['status'];
        $fileNew = $_POST['img2'];


        $sql = $conn->prepare("UPDATE item SET status = :status WHERE id=:id");
        $sql->bindParam(":id",$id);
        $sql->bindParam(":status", $status);
        $sql->execute();
        
        

                    $sql = $conn->prepare("INSERT INTO request (id, code, name, comments, user, dates, datee, status, img2) 
                                                        VALUES(:id, :code, :name, :comments, :user, :dates, :datee, :status, :img2) ");
                    $sql->bindParam(":id",$id);
                    $sql->bindParam(":code",$code);
                    $sql->bindParam(":name",$name);
                    $sql->bindParam(":comments",$comments);
                    $sql->bindParam(":user",$user);
                    $sql->bindParam(":dates", $dates);
                    $sql->bindParam(":datee", $datee);
                    $sql->bindParam(":status", $status);
                    $sql->bindParam(":img2",$fileNew);
                    $sql->execute();

                    if ($sql) {
                        $_SESSION['success'] = "Request has been send to Admin";
                        header("location: user.php");
                    } else {
                        $_SESSION['error'] = "Request has not been send to Admin";
                        header("location: user.php");
                    }
                }

?>