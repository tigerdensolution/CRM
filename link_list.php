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
                    <title>List details</title>
                    <link rel="stylesheet" href="css/bootstrap.min.css">
                    <link rel="stylesheet" href="css/bootstrap-theme.min.css">
                    <link rel="stylesheet" href="css/font-awesome.css">
                    <link rel="stylesheet" href="css/font-awesome.min.css">
                    <link rel="stylesheet" href="css/style.css">
                    <script src="js/jquery.min.js"></script>
                    <script src="js/bootstrap.min.js"></script>
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
                    <div class="container-fluid">
                        <div class="popup">
                            <span id="close" class="glyphicon glyphicon-remove-sign cls"></span>
                            <p class="confirm_msg">You want to delete this list??</p>
                            <div class="option">
                                <button class="dlt_cancel">No</button>
                                <button onclick="confirmDelete();">Yes</button>
                            </div>
                        </div>
                        <div class="container">
                            <!-- php code starts from hear -->
                            <?php
                            if (isset($_POST['search'])) {
                                $search_txt = $_POST['search_detail'];
                                $search_txt = stripcslashes($search_txt);
                                if (strlen(trim($search_txt)) > 0) {
                                    ?>
                                    <div>
                                        <p class="top-right"><span class="h1">List details</span><span class="logout"><a href="logout.php?data"><span class="glyphicon glyphicon-log-out"></span>&nbsp;Logout</a></span></p>
                                        <form action="link_list.php?data" method="post" id="form_main_detail">
                                            <a href="index.php" class="btn btn-primary btn_main"><span class="glyphicon glyphicon-home"></span>&nbsp;Home</a>
                                            <a href="add_links.php?data" class="btn btn-primary btn_main"><span class="glyphicon glyphicon glyphicon-plus"></span>&nbsp;Add list</a>
                                            <span class="search">
                                                <input type="text" name="search_detail" placeholder="list name" class="search_detail" id="search_detail" value="<?php echo $search_txt; ?>"/><button class="btn btn-success btn_search btn_main" name="search"><span class="glyphicon glyphicon-search"></span>&nbsp;search</button></span><br><br>
                                        </form></div>
                                    <div class="table-responsive tbl_client">
                                        <table class="table clint_detail_table">
                                            <tr>
                                                <th>Sl.No</th>
                                                <th>List Name</th>
                                                <th>List Description</th>
                                                <th class="icons">Details</th>
                                                <th class="icons">Edit</th>
                                                <th class="icons">Delete</th>
                                            </tr>
                                            <?php
                                            try {
                                                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                                                $sql = $conn->prepare("SELECT DISTINCT list_name,list_description from links_list WHERE delete_status='false' AND list_name LIKE ?");
                                                $result = $sql->execute(array('%' . $search_txt . '%'));
                                            } catch (PDOException $e) {
                                                echo $sql . "<br>" . $e->getMessage();
                                            }
                                            $count = $sql->rowCount();
                                            if ($count > 0) {
                                                $slno = 1;
                                                while ($data = $sql->fetch(PDO::FETCH_ASSOC)) {
                                                    ?>
                                                    <tr>
                                                        <td><?php echo $slno; ?></td>
                                                        <td><?php echo $data['list_name']; ?></td>
                                                        <td><?php echo $data['list_description']; ?></td> 
                                                        <td class="icons"><a href="view_links.php?list_name=<?php echo $data['list_name']; ?>&data"><span class="glyphicon glyphicon-list"></span></a></td>
                                                        <td class="icons"><a href="links_update.php?list_name=<?php echo $data['list_name']; ?>&data"><span class="glyphicon glyphicon-pencil"></span></a></td>
                                                        <td class="icons"><a id="dlt_id<?php echo $slno; ?>" href="delete_list.php?list_name=<?php echo $data['list_name']; ?>&data" class="hdn_lnk"></a><span id="id<?php echo $slno; ?>" class="glyphicon glyphicon-trash butn_dlt" onclick="checkDelete(this.id);"></span></td>
                                                    </tr>
                                                    <?php
                                                    $slno++;
                                                }
                                            } else {
                                                echo "<h3>Result not found</h3>";
                                            }
                                        } else {
                                            header("location:link_list.php?data");
                                        }
                                        ?>
                                    </table>
                                </div>
                            <?php } else { ?>
                                <p class="top-right"><span class="h1">List details</span><span class="logout"><a href="logout.php?data"><span class="glyphicon glyphicon-log-out"></span>&nbsp;Logout</a></span></p>
                                <form action="link_list.php?data" method="post" id="form_main_detail">
                                    <a href="index.php" class="btn btn-primary btn_main"><span class="glyphicon glyphicon-home"></span>&nbsp;Home</a>
                                    <a href="add_links.php?data" class="btn btn-primary btn_main"><span class="glyphicon glyphicon glyphicon-plus"></span>&nbsp;Add list</a>
                                    <span class="search">
                                        <input type="text" name="search_detail" placeholder="list name" class="search_detail" id="search_detail"/><button class="btn btn-success btn_search btn_main" name="search"><span class="glyphicon glyphicon-search"></span>&nbsp;search</button></span><br><br>
                                </form>
                                <div class="table-responsive tbl_client">
                                    <table class="table clint_detail_table">
                                        <tr>
                                            <th>Sl.No</th>
                                            <th>List Name</th>
                                            <th>List Description</th>
                                            <th class="icons">Details</th>
                                            <th class="icons">Edit</th>
                                            <th class="icons">Delete</th>
                                        </tr>
                                        <?php
                                        try {
                                            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                                            $sql = $conn->prepare("SELECT DISTINCT list_name,list_description from links_list where delete_status='false'");
                                            $result = $sql->execute();
                                        } catch (PDOException $e) {
                                            echo $sql . "<br>" . $e->getMessage();
                                        }
                                        $slno = 1;
                                        while ($data = $sql->fetch(PDO::FETCH_ASSOC)) {
                                            ?>
                                            <tr>
                                                <td><?php echo $slno; ?></td>
                                                <td><?php echo $data['list_name']; ?></td>
                                                <td><?php echo $data['list_description']; ?></td> 
                                                <td class="icons"><a href="view_links.php?list_name=<?php echo $data['list_name']; ?>&data"><span class="glyphicon glyphicon-list"></span></a></td>
                                                <td class="icons"><a href="links_update.php?list_name=<?php echo $data['list_name']; ?>&data"><span class="glyphicon glyphicon-pencil"></span></a></td>
                                                <td class="icons"><a id="dlt_id<?php echo $slno; ?>" href="delete_list.php?list_name=<?php echo $data['list_name']; ?>&data" class="hdn_lnk"></a><span id="id<?php echo $slno; ?>" class="glyphicon glyphicon-trash butn_dlt" onclick="checkDelete(this.id);"></span></td>
                                            </tr>
                                            <?php
                                            $slno++;
                                        }
                                        ?>
                                    </table>
                                </div> <?php } ?>
                        </div>
                        <div class="cover"></div>
                    </div>
                </body>
            </html>
            <?php
            $conn = null;
        } else {
            header("location:index.php");
        }
    }
} else {
    header("location:login.php");
}
?>
