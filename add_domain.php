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
            $company_name = stripcslashes($_GET['comp_name']);
            if (isset($_POST['save'])) {

//reciving field details.
                $company_name = stripcslashes(trim($_GET['comp_name']));
                $domain_name = stripcslashes(trim($_POST['domain_name']));
                $admin_email = stripcslashes(trim($_POST['admin_email']));
                $admin_name = stripcslashes(trim($_POST['admin_name']));
                $admin_password = stripcslashes(trim($_POST['admin_password']));
                $editor_name = stripcslashes(trim($_POST['editor_name']));
                $editor_password = stripcslashes(trim($_POST['editor_password']));
                $editor_email = stripcslashes(trim($_POST['editor_email']));

//creating database connection.
                try {
//error exception
                    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    $sql = "INSERT INTO domain_information(company_name, domain_name, admin_name, admin_email, admin_password, editor_name, editor_password, editor_email)
VALUES ('$company_name','$domain_name','$admin_name','$admin_email','$admin_password','$editor_name','$editor_password','$editor_email')";
                    $conn->exec($sql);
                    header("location:customer_detail.php?comp_name=$company_name&data");
                } catch (PDOException $e) {
                    echo $sql . "<br>" . $e->getMessage();
                }
            }
            ?>
            <!-- HTML content starts from hear -->
            <html>
                <head>
                    <meta charset="UTF-8">
                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                    <title>Add domain details</title>
                    <link rel="stylesheet" href="css/bootstrap.min.css">
                    <link rel="stylesheet" href="css/bootstrap-theme.min.css">
                    <link rel="stylesheet" href="css/style.css">
                    <script type="text/javascript">
                        function validation() {
                            if (do_Name()) {
                                if (ad_Name()) {
                                    if (ad_Email()) {
                                        if (ad_Password()) {
                                            if (ed_Name()) {
                                                if (ed_Password()) {
                                                    if (ed_Email()) {
                                                        return true;
                                                    } else {
                                                        return false;
                                                    }
                                                } else {
                                                    return false;
                                                }
                                            } else {
                                                return false;
                                            }
                                        } else {
                                            return false;
                                        }
                                    } else {
                                        return false;
                                    }
                                } else {
                                    return false;
                                }
                            } else {
                                return false;
                            }
                        }
                        function ad_Email() {
                            var check = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
                            var spac = /^[ ]*$/;
                            var ad_email = document.getElementById('admin_email');
                            ;
                            if (ad_email.value == "" || ad_email.value == null) {
                                ad_email.focus();
                                document.getElementById('ad_em_mesg').innerHTML = "Please enter admin email";
                                return false;
                            } else {
                                if (ad_email.value.match(spac)) {
                                    ad_email.focus();
                                    document.getElementById('ad_em_mesg').innerHTML = "Please enter valid admin email";
                                    return false;
                                } else {
                                    if (ad_email.value.match(check)) {
                                        return true;
                                    } else {
                                        ad_email.focus();
                                        document.getElementById('ad_em_mesg').innerHTML = "Please enter valid admin email";
                                        return false;
                                    }
                                }
                            }
                        }
                        function ed_Email() {
                            var check = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
                            var spac = /^[ ]*$/;
                            var ed_email = document.getElementById('editor_email');
                            ;
                            if (ed_email.value == "" || ed_email.value == null) {
                                ed_email.focus();
                                document.getElementById('ed_em_mesg').innerHTML = "Please enter editor email";
                                return false;
                            } else {
                                if (ed_email.value.match(spac)) {
                                    ed_email.focus();
                                    document.getElementById('ed_em_mesg').innerHTML = "Please enter valid editor email";
                                    return false;
                                } else {
                                    if (ed_email.value.match(check)) {
                                        return true;
                                    } else {
                                        ed_email.focus();
                                        document.getElementById('ed_em_mesg').innerHTML = "Please enter valid editor email";
                                        return false;
                                    }
                                }
                            }
                        }
                        function do_Name() {
                            var do_name = document.getElementById('domain_name');
                            var alpha = /^[A-Za-z.]*$/;
                            var spac = /^[ ]*$/;
                            if (do_name.value == "" || do_name.value == null) {
                                do_name.focus();
                                document.getElementById('do_nam_mesg').innerHTML = "Please enter name";
                                return false;
                            } else {
                                if (do_name.value.match(spac)) {
                                    do_name.focus();
                                    document.getElementById('do_nam_mesg').innerHTML = "Please enter valid name";
                                    return false;
                                } else {
                                    if (do_name.value.match(alpha)) {
                                        return true;
                                    } else {
                                        do_name.focus();
                                        document.getElementById('do_nam_mesg').innerHTML = "Please enter valid name";
                                        return false;
                                    }
                                }
                            }
                        }
                        function ad_Name() {
                            var ad_name = document.getElementById('admin_name');
                            var alpha = /^[A-Za-z0-9]*$/;
                            var spac = /^[ ]*$/;
                            if (ad_name.value == "" || ad_name.value == null) {
                                ad_name.focus();
                                document.getElementById('ad_nam_mesg').innerHTML = "Please enter name";
                                return false;
                            } else {
                                if (ad_name.value.match(spac)) {
                                    ad_name.focus();
                                    document.getElementById('ad_nam_mesg').innerHTML = "Please enter valid name";
                                    return false;
                                } else {
                                    if (ad_name.value.match(alpha)) {
                                        return true;
                                    } else {
                                        ad_name.focus();
                                        document.getElementById('ad_nam_mesg').innerHTML = "Please enter valid name";
                                        return false;
                                    }
                                }
                            }
                        }
                        function ed_Name() {
                            var ed_name = document.getElementById('editor_name');
                            var alpha = /^[A-Za-z ]*$/;
                            var spac = /^[ ]*$/;
                            if (ed_name.value == "" || ed_name.value == null) {
                                ed_name.focus();
                                document.getElementById('ed_nam_mesg').innerHTML = "Please enter name";
                                return false;
                            } else {
                                if (ed_name.value.match(spac)) {
                                    ed_name.focus();
                                    document.getElementById('ed_nam_mesg').innerHTML = "Please enter valid name";
                                    return false;
                                } else {
                                    if (ed_name.value.match(alpha)) {
                                        return true;
                                    } else {
                                        ed_name.focus();
                                        document.getElementById('ed_nam_mesg').innerHTML = "Please enter valid name";
                                        return false;
                                    }
                                }
                            }
                        }
                        function ad_Password() {
                            var spac = /^[ ]*$/;
                            var ad_pass = document.getElementById('admin_password');
                            if (ad_pass.value == "" || ad_pass.value == null) {
                                ad_pass.focus();
                                document.getElementById('ad_ps_mesg').innerHTML = "Please enter password";
                                return false;
                            } else {
                                if (ad_pass.value.match(spac)) {
                                    ad_pass.focus();
                                    document.getElementById('ad_ps_mesg').innerHTML = "Please enter valid password";
                                    return false;
                                } else {
                                    return true;
                                }
                            }
                        }
                        function ed_Password() {
                            var spac = /^[ ]*$/;
                            var ed_pass = document.getElementById('editor_password');
                            if (ed_pass.value == "" || ed_pass.value == null) {
                                ed_pass.focus();
                                document.getElementById('ed_ps_mesg').innerHTML = "Please enter password";
                                return false;
                            } else {
                                if (ed_pass.value.match(spac)) {
                                    ed_pass.focus();
                                    document.getElementById('ed_ps_mesg').innerHTML = "Please enter valid password";
                                    return false;
                                } else {
                                    return true;
                                }
                            }
                        }
                    </script>
                </head>
                <body onload="document.client_detail.domain_name.focus();">
                    <div class="container-fluid">
                        <div class="container">
                            <p class="top-right"><span class="h2">Enter <?php echo $company_name; ?> domain details</span><span class="logout"><a href="logout.php?data"><span class="glyphicon glyphicon-log-out"></span>&nbsp;Logout</a></span></p>
                            <a href="index.php" class="btn btn-primary btn_main"><span class="glyphicon glyphicon-home"></span>&nbsp;Home</a>
                            <a href="customer_detail.php?comp_name=<?php echo $company_name; ?>&data" class="btn btn-primary btn_main"><span class="glyphicon glyphicon-arrow-left"></span>&nbsp;Back</a>
                            <br><br>
                            <!-- client detail form starting  -->
                            <form name="client_detail" action="add_domain.php?comp_name=<?php echo $company_name; ?>&data" method="post" onsubmit="return validation();">
                                <table class="table_main">
                                    <tr>
                                        <td>
                                            Domain name 
                                        </td>
                                        <td class="data_field">
                                            <input class="form-control" type="text" name="domain_name" id="domain_name" required>
                                        </td>
                                        <td><p class="mesg" id="do_nam_mesg"></p></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Admin Name 
                                        </td>
                                        <td class="data_field">
                                            <input class="form-control" type="text" name="admin_name" id="admin_name" pattern="^([a-zA-Z0-9\s]{3,})$" required>
                                        </td>
                                        <td><p class="mesg" id="ad_nam_mesg"></p></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Admin Email 
                                        </td>
                                        <td class="data_field">
                                            <input class="form-control" type="email" name="admin_email" id="admin_email" required>
                                        </td>
                                        <td><p class="mesg" id="ad_em_mesg"></p></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Admin Password 
                                        </td>
                                        <td class="data_field">
                                            <input class="form-control" type="text" name="admin_password" id="admin_password" required>
                                        </td>
                                        <td><p class="mesg" id="ad_ps_mesg"></p></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Editor Name 
                                        </td>
                                        <td class="data_field">
                                            <input class="form-control" type="text" name="editor_name" id="editor_name" pattern="^([a-zA-Z\s]{3,})$" required>
                                        </td>
                                        <td><p class="mesg" id="ed_nam_mesg"></p></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Editor Password 
                                        </td>
                                        <td class="data_field">
                                            <input class="form-control" type="text" name="editor_password" id="editor_password" required>
                                        </td>
                                        <td><p class="mesg" id="ed_ps_mesg"></p></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Editor Email 
                                        </td>
                                        <td class="data_field">
                                            <input class="form-control" type="email" name="editor_email" id="editor_email" required>
                                        </td>
                                        <td><p class="mesg" id="ed_em_mesg"></p></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <button type="submit" name="save" class="btn btn-success btn_action"><span class="glyphicon glyphicon-save"></span>&nbsp;Add domain</button>
                                            <button type="reset" name="reset" class="btn btn-warning btn_action"><span class="glyphicon glyphicon-refresh"></span>&nbsp;Reset</button>
                                        </td>
                                    </tr>
                                </table>
                            </form>
                        </div>
                    </div>
                </body>
            </html>
            <?php
            $conn = NULL;
        } else {
            header("location:index.php");
        }
    }
} else {
    header("location:login.php");
}
?>