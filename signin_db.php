<?php 

    session_start();
    require_once 'config/db.php';

    if (isset($_POST['signin'])) {
        $studentid = $_POST['studentid'];
        $password = $_POST['password'];

      
        if (empty($studentid)) {
            $_SESSION['error'] = 'กรุณากรอกรหัสนักศึกษา';
            header("location: signin.php");
        } else if (empty($password)) {
            $_SESSION['error'] = 'กรุณากรอกรหัสผ่าน';
            header("location: signin.php");

        }else {
            try {

                $check_data = $conn->prepare("SELECT * FROM users WHERE studentid = :studentid");
                $check_data->bindParam(":studentid", $studentid);
                $check_data->execute();
                $row = $check_data->fetch(PDO::FETCH_ASSOC);

                if ($check_data->rowCount() > 0) {

                    if ($studentid == $row['studentid']) {
                        if (password_verify($password, $row['password'])) {
                            if ($row['urole'] == 'admin') {
                                $_SESSION['admin_login'] = $row['id'];
                                header("location: Lobby_Admin.php");
                            } else {
                                $_SESSION['user_login'] = $row['id'];
                                header("location: user.php");
                            }
                        } else {
                            $_SESSION['error'] = 'รหัสผ่านผิด';
                            header("location: signin.php");
                        }
                    } else {
                        $_SESSION['error'] = 'รหัสนักศึกษาผิด';
                        header("location: signin.php");
                    }
                } else {
                    $_SESSION['error'] = "ไม่มีรหัสนักศึกษานี้ในระบบ กรุณาสมัครสมาชิก";
                    header("location: signin.php");
                }

            } catch(PDOException $e) {
                echo $e->getMessage();
            }
        }
    }


?>