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
                $list = stripcslashes($_GET['list_name']);
                $id = stripcslashes($_GET['id']);
                try {
                    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    $sql = "UPDATE links_list SET delete_status='true' where id=$id";
                    $conn->exec($sql);
                } catch (PDOException $e) {
                    echo $sql . "<br>" . $e->getMessage();
                }
                header("location:view_links.php?list_name=$list&data");
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