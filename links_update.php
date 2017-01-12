<!DOCTYPE html>
<!-- php code starts  -->
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
            if (isset($_POST['update'])) {
//reciving field details.
                $lst_name = stripcslashes($_POST['list_name']);
                $lst_disc = stripcslashes($_POST['list_disc']);
                try {
                //error exception
                    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $list_name = stripcslashes($_GET['list_name']);
                $sql = $conn->prepare("SELECT * from links_list where list_name = '$list_name' and delete_status='false'");
                $sql->execute();
                $db_row = $sql->rowCount();
                $form_row = $_POST['n'];
                } catch (PDOException $e) {
                    echo $sql . "<br>" . $e->getMessage();
                }
                if($db_row == $form_row){
                     try {
                //error exception
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $sql1 = $conn->prepare("SELECT id from links_list where list_name = '$list_name' and delete_status='false'");
                $sql1->execute();
                } catch (PDOException $e) {
                    echo $sql1 . "<br>" . $e->getMessage();
                }
                $j=1;
                $i=1;
                while ($data1 = $sql1->fetch(PDO::FETCH_ASSOC)) {
                for($i;$i<=$j;$i++){
                    $link =stripcslashes($_POST[$i]);
                    $id = $data1['id'];
                if(strlen(trim($link)) !="" || $link != NULL){
                    $sql = "UPDATE links_list SET list_name='$lst_name',list_description='$lst_disc',links='$link' WHERE id=$id and delete_status='false'";
                    $stmt = $conn->exec($sql);
                }else{
                    $sql = "UPDATE links_list SET delete_status='true' WHERE id=$id and delete_status='false'";
                    $stmt = $conn->exec($sql);
                }
                }
                $j++;
                }
                header("location:view_links.php?list_name=$lst_name&data");
                } else {
                    try {
                //error exception
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $sql1 = $conn->prepare("SELECT id from links_list where list_name = '$list_name' and delete_status='false'");
                $sql1->execute();
                } catch (PDOException $e) {
                    echo $sql1 . "<br>" . $e->getMessage();
                }
                $j=1;
                $i=1;
                while ($data1 = $sql1->fetch(PDO::FETCH_ASSOC)) {
                for($i;$i<=$j;$i++){
                    $link =stripcslashes($_POST[$i]);
                    $id = $data1['id'];
                if(strlen(trim($link)) !="" || $link != NULL){
                    $sql = "UPDATE links_list SET list_name='$lst_name',list_description='$lst_disc',links='$link' WHERE id=$id and delete_status='false'";
                    $stmt = $conn->exec($sql);
                }else{
                    $sql = "UPDATE links_list SET delete_status='true' WHERE id=$id and delete_status='false'";
                    $stmt = $conn->exec($sql);
                }
                }
                $j++;
                }
                $k = $form_row; 
                $l = $db_row + 1;
                for($l;$l<=$k;$l++){
                    $link =stripcslashes($_POST[$l]);
                if(strlen(trim($link)) !="" || $link != NULL){
                    try {
                //error exception
                    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    $sql = "INSERT INTO links_list(list_name, list_description, links) VALUES ('$lst_name','$lst_disc','$link')";
                    $conn->exec($sql);
                } catch (PDOException $e) {
                    echo $sql . "<br>" . $e->getMessage();
                }}
            }
               header("location:view_links.php?list_name=$lst_name&data");
                }
                }
                
            if(isset($_GET['list_name'])){
                try {
                //error exception
                    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $list_name = stripcslashes($_GET['list_name']);
                $sql = $conn->prepare("SELECT DISTINCT list_name,list_description from links_list where list_name = '$list_name' and delete_status='false'");
                $sql->execute();
                $data = $sql->fetch(PDO::FETCH_ASSOC);
                } catch (PDOException $e) {
                    echo $sql . "<br>" . $e->getMessage();
                }
            ?>
            <!-- HTML content starts from hear -->
            <html>
                <head>
                    <meta charset="UTF-8">
                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                    <title>Add links</title>
                    <link rel="stylesheet" href="css/bootstrap.min.css">
                    <link rel="stylesheet" href="css/bootstrap-theme.min.css">
                    <link rel="stylesheet" href="css/style.css">
                    <script src="js/jquery.min.js"></script>
                    <script type="text/javascript">
                        function validation() {
                            if (nameBlank()) {
                                if (descBlank()) {
                                    return true;
                                } else {
                                    return false;
                                }
                            }else{
                                return false;
                            }
                        }
                            function nameBlank() {
                                var spac = /^[ ]*$/;
                                var ln = document.getElementById('list_name');
                                if (ln.value == "" || ln.value == null) {
                                    ln.focus();
                                    document.getElementById('msg_ln').innerHTML = "Please enter name";
                                    return false;
                                } else {
                                    if (ln.value.match(spac)) {
                                        ln.focus();
                                        document.getElementById('msg_ln').innerHTML = "Please enter name";
                                        return false;
                                    } else {
                                        return true;
                                    }
                                }
                            }
                            function descBlank() {
                                var spac = /^[ ]*$/;
                                var ld = document.getElementById('list_desc');
                                if (ld.value == "" || ld.value == null) {
                                    ld.focus();
                                    document.getElementById('msg_ld').innerHTML = "Please enter description";
                                    return false;
                                } else {
                                    if (ld.value.match(spac)) {
                                        ld.focus();
                                        document.getElementById('msg_ld').innerHTML = "Please enter description";
                                        return false;
                                    } else {
                                        return true;
                                    }
                                }
                            }
                        function addLink(tblId){
                            var table = document.getElementById(tblId);
                            var rowCount = table.rows.length;
                            var row = table.insertRow(rowCount);
                            
                            var cel1 = row.insertCell(0);
                            cel1.innerHTML = rowCount;
                            cel1.className = "names";
                            
                            var cel2 = row.insertCell(1);
                            var element1 = document.createElement("input");
                            element1.type="text";
                            element1.name=rowCount;
                            element1.className="form-control lst_lnk";
                            cel2.appendChild(element1);
                            
                            document.getElementById('n').value=rowCount;
                        }
                    </script>
                </head>
                <body>
                    <div class="container-fluid">
                        <div class="container">
                            <p class="top-right"><span class="h1">Enter list details</span><span class="logout"><a href="logout.php?data"><span class="glyphicon glyphicon-log-out"></span>&nbsp;Logout</a></span></p>
                            <a href="index.php" class="btn btn-primary btn_main"><span class="glyphicon glyphicon-home"></span>&nbsp;Home</a>
                            <a href="link_list.php?data" class="btn btn-primary btn_main"><span class="glyphicon glyphicon-arrow-left"></span>&nbsp;Back</a>
                            <br><br>
                            <!-- client detail form starting  -->
                            <div class="link_dtail">
                                <form name="link_list" id="link_list" action="links_update.php?list_name=<?php echo $data['list_name']; ?>&data" method="post" onsubmit="return validation();">
                                    <table>
                                        <tr>
                                            <td class="names">List name</td>
                                            <td><input class="form-control lst_dtl" type="text" name="list_name" id="list_name" value="<?php echo $data['list_name']; ?>" required></td>
                                            <td><p class="mesg" id="msg_ln"></p></td>
                                        </tr>
                                        <tr>
                                            <td class="names">List description</td>
                                            <td><textarea class="form-control lst_dtl" id="list_desc" name="list_disc" required><?php echo $data['list_description']; ?></textarea></td>
                                            <td><p class="mesg" id="msg_ld"></p></td>
                                        </tr></table><br><br>
                                        <table id="tbl_link_list">
                                        <tr>
                                            <td class="names">Links</td><td></td>
                                        </tr>
                                        <?php
                                        try {
                                            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                                            $sql1 = $conn->prepare("SELECT links from links_list where list_name='$list_name' and delete_status='false'");
                                            $sql1->execute();
                                        } catch (PDOException $e) {
                                            echo $sql1 . "<br>" . $e->getMessage();
                                        }
                                        $x = 1;
                                        while ($data1 = $sql1->fetch(PDO::FETCH_ASSOC)) {
                                            ?>
                                        <tr>
                                            <td class="names"><?php echo $x; ?></td><td><input class="form-control lst_lnk" type="text" name="<?php echo $x; ?>" value="<?php echo $data1['links']; ?>"></td>
                                        </tr>
                                        <?php
                                        $x++;
                                        }
                                        ?>
                                    </table>
                                        <div>
                                        <label><input name="n" type="hidden" id="n" value="<?php echo $x-1; ?>"></label>
                                    <br><br>
                                    <button type="submit" name="update" class="btn btn-success btn_action"><span class="glyphicon glyphicon-floppy-save"></span>&nbsp;Update</button>
                                    <button type="reset" name="reset" class="btn btn-warning btn_action"><span class="glyphicon glyphicon-refresh"></span>&nbsp;Reset</button>
                                    <button type="button" name="add" class="btn btn-primary btn_action" onclick="addLink('tbl_link_list');"><span class="glyphicon glyphicon-plus"></span>&nbsp;Add links</button>
                                        </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </body>
            </html>
            <?php
            $conn = NULL; 
            }else{
                header("location:link_list.php?data");
            }
        } else {
            header("location:index.php");
        }
    }
} else {
    header("location:login.php");
}
?>