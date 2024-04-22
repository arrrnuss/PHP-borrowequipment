<?php
    session_start();
    require_once 'config/db.php';

    if (isset($_POST['ac'])){
        $id = $_POST['id'];
        $code = $_POST['code'];
        $name = $_POST['name'];
        $comments = $_POST['comments'];
        $user = $_POST['user'];
        $dates = $_POST['dates'];
        $datee = $_POST['datee'];
        $status = $_POST['status'];


        $sql = $conn->prepare("UPDATE request SET code = :code, name = :name, comments = :comments, user = :user, dates = :dates, datee = :datee,
                                                    status = :status WHERE id=:id");
        $sql->bindParam(":id", $id);
        $sql->bindParam(":code",$code);
        $sql->bindParam(":name",$name);
        $sql->bindParam(":comments",$comments);
        $sql->bindParam(":user",$user);
        $sql->bindParam(":dates", $dates);
        $sql->bindParam(":datee", $datee);
        $sql->bindParam(":status", $status);
        $sql->execute();

        if ($sql) {
            $_SESSION['success'] = "Request has been Accept by Admin";
            header("location: request.php");
        } else {
            $_SESSION['error'] = "Data has not been Accept by Admin";
            header("location: request.php");
        }
    }

?>