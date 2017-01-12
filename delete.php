<?php

require_once 'database.php';
if (isset($_SESSION['user_name'])) {
    if (auto_logout("active")) {
        session_unset();
        session_destroy();
        header("location:login.php");
        exit();
    } else {
        if (isset($_GET['data'])) {
            if (isset($_GET['id'])) {
                $id = stripcslashes($_GET['id']);
                $comp_name = stripcslashes($_GET['comp_name']);
                try {
                    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    $sql = "UPDATE clients_information SET delete_status='true' where id=$id";
                    $sql1 = "UPDATE domain_information SET delete_status='true' where company_name='$comp_name'";
                    $conn->exec($sql);
                    $conn->exec($sql1);
                } catch (PDOException $e) {
                    echo $sql . "<br>" . $e->getMessage();
                }
                header("location:main_view.php?data");
            }
            $conn = NULL;
        } else {
            header("location:index.php");
        }
    }
} else {
    header("location:login.php");
}
?>
