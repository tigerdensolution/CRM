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
            if (isset($_GET['list_name'])) {
                $list_name = stripcslashes($_GET['list_name']);
                try {
                    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    $sql = "UPDATE links_list SET delete_status='true' where list_name='$list_name'";
                    $conn->exec($sql);
                } catch (PDOException $e) {
                    echo $sql . "<br>" . $e->getMessage();
                }
                header("location:link_list.php?data");
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
