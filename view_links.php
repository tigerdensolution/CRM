<!DOCTYPE html>
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
            ?>
            <html>
                <head>
                    <meta charset="UTF-8">
                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                    <title>List links</title>
                    <link rel="stylesheet" href="css/bootstrap.min.css">
                    <link rel="stylesheet" href="css/bootstrap-theme.min.css">
                    <link rel="stylesheet" href="css/style.css">
                    <script src="js/jquery.min.js"></script>
                    <script src="js/bootstrap.min.js"></script>
                    <script src="js/bootbox.min.js"></script>
                    <script type="text/javascript">
                        var dlt_lnk_id;
                        function checkDelete(id) {
                            dlt_lnk_id = id;
                        }
                        function confirmDelete() {
                            var id = dlt_lnk_id;
                            var id = "dlt_" + id;
                            document.getElementById(id).click();
                        }
                        function Search() {
                            document.getElementById("form_main_detail").submit();
                        }
                        $(document).ready(function () {
                            $(".butn_dlt").on('click', function () {
                                $(".popup").fadeIn('slow');
                                $(".cover").fadeIn('slow');
                            });
                            $(".cls").on('click', function () {
                                $(".cover").fadeOut('slow');
                                $(".popup").fadeOut('slow');
                            });
                            $('.cover').on('click', function () {
                                $(".cover").fadeOut('slow');
                                $(".popup").fadeOut('slow');
                            });
                            $('.dlt_cancel').on('click', function () {
                                $(".cover").fadeOut('slow');
                                $(".popup").fadeOut('slow');
                            });
                        });
                    </script>
                </head>
                <body>
                    <?php
                    if (isset($_GET['list_name'])) {
                        $list_name = stripcslashes($_GET['list_name']);
                        try {
                            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                            $sql = $conn->prepare("SELECT * from links_list where list_name='$list_name' and delete_status='false'");
                            $sql->execute();
                            $data = $sql->fetch(PDO::FETCH_ASSOC);
                        } catch (PDOException $e) {
                            echo $sql . "<br>" . $e->getMessage();
                        }
                        ?>
                        <div class="container-fluid">
                            <div class="popup">
                                <span id="close" class="glyphicon glyphicon-remove-sign cls"></span>
                                <p class="confirm_msg">You want to delete this link?</p>
                                <div class="option">
                                    <button class="dlt_cancel">No</button>
                                    <button onclick="confirmDelete();">Yes</button>
                                </div>
                            </div>
                            <div class="container">
                                <p class="top-right"><span class="h1"><?php echo $list_name; ?>&nbsp;list details</span><span class="logout"><a href="logout.php?data"><span class="glyphicon glyphicon-log-out"></span>&nbsp;Logout</a></span></p>
                                <a href="index.php" class="btn btn-primary btn_main"><span class="glyphicon glyphicon-home"></span>&nbsp;Home</a>
                                <a href="link_list.php?data" class="btn btn-primary btn_main"><span class="glyphicon glyphicon-arrow-left"></span>&nbsp;Back</a>
                                <a href="links_update.php?list_name=<?php echo $data['list_name']; ?>&data" class="btn btn-primary btn_main"><span class="glyphicon glyphicon-edit"></span>&nbsp;Edit client</a>
                                <div class="row list_detail_body">
                                    <table>
                                        <tr>
                                            <td>List Name</td>
                                            <td>&nbsp;:&nbsp;&nbsp;</td>
                                            <td><?php echo $data['list_name']; ?></td>
                                        </tr>
                                        <tr>
                                            <td>List Description</td>
                                            <td>&nbsp;:&nbsp;&nbsp;</td>
                                            <td><?php echo $data['list_description']; ?></td>
                                        </tr>
                                    </table><br><br>
                                </div>
                                <div class="links_body">
                                    <?php
                                    try {
                                        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                                        $sql1 = $conn->prepare("SELECT * from links_list where list_name='$list_name' and delete_status='false'");
                                        $sql1->execute();
                                    } catch (PDOException $e) {
                                        echo $sql . "<br>" . $e->getMessage();
                                    }
                                    while ($data1 = $sql1->fetch(PDO::FETCH_ASSOC)) {
                                        $l = $data1['links'];
                                        $lnk .= "window.open('$l');";
                                    }
                                    ?> 
                                    <div class="list_headding"><span class="h3">Links list</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a class="btn btn-success btn-xs btn_action lnk_btn" onclick="<?php echo $lnk; ?>" target="_blank">Open all links</a></div>
                                    <div class="list_link">
                                        <br>
                                        <table>
                                            <?php
                                            try {
                                                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                                                $sql2 = $conn->prepare("SELECT * from links_list where list_name='$list_name' and delete_status='false'");
                                                $sql2->execute();
                                            } catch (PDOException $e) {
                                                echo $sql . "<br>" . $e->getMessage();
                                            }
                                            $x = 1;
                                            while ($data2 = $sql2->fetch(PDO::FETCH_ASSOC)) {
                                                ?>
                                                <tr>
                                                    <td><a href="<?php echo $data2['links']; ?>" target="_blank"><?php echo $data2['links']; ?></a>&nbsp;&nbsp;&nbsp;</td>
                                                    <td><a id="dlt_id<?php echo $x; ?>" href="delete_link_list.php?id=<?php echo $data2['id']; ?>&list_name=<?php echo $list_name; ?>&data" class="hdn_lnk"></a>
                                                        <button id="id<?php echo $x; ?>" class="btn btn-danger btn-xs btn_action butn_dlt" onclick="checkDelete(this.id);">Delete</button>
                                                    </td>
                                                </tr>
                                                <?php
                                                $x++;
                                            }
                                            ?>
                                        </table><br>
                                    </div>
                                </div>
                                <?php
                            } else {
                                header("location:link_list.php?data");
                            }
                            $conn = NULL;
                            ?>
                        </div>
                        <div class="cover"></div>
                    </div>
                </body>
            </html>
            <?php
        } else {
            header("location:index.php");
        }
    }
} else {
    header("location:login.php");
}