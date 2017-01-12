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
                    <title>Client details</title>
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
                        function confirmDelete(){
                            var id = dlt_lnk_id;
                            var id = "dlt_"+ id;
                            document.getElementById(id).click();
                        }
                        $(document).ready(function () {
                            $(".butn_dlt").on('click', function () {
                                $(".popup").fadeIn('slow');
                                $(".cover").fadeIn('slow');
                            });
                            $(".butn_dlt_2").on('click', function () {
                                $(".popup_2").fadeIn('slow');
                                $(".cover").fadeIn('slow');
                            });
                            $(".butn_dlt_final").on('click', function () {
                                $(".popup_2").fadeOut('slow');
                                $(".popup_final").fadeIn('slow');
                            });
                            $(".gcls").on('click', function () {
                                $(".cover").fadeOut('slow');
                                $(".popup").fadeOut('slow');
                                $(".popup_2").fadeOut('slow');
                                $(".popup_final").fadeOut('slow');
                            });
                            $('.cover').on('click', function () {
                                $(".cover").fadeOut('slow');
                                $(".popup").fadeOut('slow');
                                $(".popup_2").fadeOut('slow');
                                $(".popup_final").fadeOut('slow');
                            });
                            $('.dlt_cancel').on('click', function () {
                                $(".cover").fadeOut('slow');
                                $(".popup").fadeOut('slow');
                                $(".popup_2").fadeOut('slow');
                                $(".popup_final").fadeOut('slow');
                            });
                        });
                        
                    </script>
                </head>
                <body>
                    <?php
                    if (isset($_GET['comp_name'])) {
                        $comp_name = stripcslashes($_GET['comp_name']);
                        try {
                            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                            $sql = $conn->prepare("SELECT * from clients_information where company_name='$comp_name' and delete_status='false'");
                            $sql->execute();
                            $data = $sql->fetch(PDO::FETCH_ASSOC);
                        } catch (PDOException $e) {
                            echo $sql . "<br>" . $e->getMessage();
                        }
                        ?>
                        <div class="container-fluid">
                            <div class="popup">
                                    <span id="close" class="glyphicon glyphicon-remove-sign cls"></span>
                                    <p class="confirm_msg">You want to delete this domain??</p>
                                    <div class="option">
                                        <button class="dlt_cancel">No</button>
                                        <button onclick="confirmDelete();">Yes</button>
                                    </div>
                                </div>
                            <div class="popup_2">
                                    <span id="close" class="glyphicon glyphicon-remove-sign cls"></span>
                                    <p class="confirm_msg">Delete it permanently? </p>
                                    <div class="option">
                                        <button class="dlt_cancel">cancel</button>
                                        <button class="butn_dlt_final">delete</button>
                                    </div>
                                </div>
                            <div class="popup_final">
                                    <span id="close" class="glyphicon glyphicon-remove-sign cls"></span>
                                    <p class="confirm_msg">Are you sure??</p>
                                    <div class="option">
                                        <button class="dlt_cancel">No</button>
                                        <button onclick="confirmDelete();">Yes</button>
                                    </div>
                                </div>
                            <div class="container">
                                <p class="top-right"><span class="h1"><?php echo $comp_name; ?> details</span><span class="logout"><a href="logout.php?data"><span class="glyphicon glyphicon-log-out"></span>&nbsp;Logout</a></span></p>
                                <a href="index.php" class="btn btn-primary btn_main"><span class="glyphicon glyphicon-home"></span>&nbsp;Home</a>
                                <a href="main_view.php?data" class="btn btn-primary btn_main"><span class="glyphicon glyphicon-arrow-left"></span>&nbsp;Back</a>
                                <a href="client_update.php?id=<?php echo $data['id']; ?>&data" class="btn btn-primary btn_main"><span class="glyphicon glyphicon-edit"></span>&nbsp;Edit client</a>
                                <a href="add_domain.php?comp_name=<?php echo $comp_name; ?>&data" class="btn btn-primary btn_main"><span class="glyphicon glyphicon-plus"></span>&nbsp;Add new domain</a><br><br>
                                <div class="row cust_detail_body">
                                    <table>
                                        <tr>
                                            <td>Company Name</td>
                                            <td>&nbsp;:&nbsp;&nbsp;</td>
                                            <td><?php echo $data['company_name']; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Customer Name</td>
                                            <td>&nbsp;:&nbsp;&nbsp;</td>
                                            <td><?php echo $data['customer_name']; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Customer Email</td>
                                            <td>&nbsp;:&nbsp;&nbsp;</td>
                                            <td><?php echo $data['customer_email']; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Address</td>
                                            <td>&nbsp;:&nbsp;&nbsp;</td>
                                            <td><?php echo $data['address_1'] . "<br>" . $data['address_2'] . "<br>" . $data['address_3']; ?></td>
                                        </tr>
                                        <tr>
                                            <td>City</td>
                                            <td>&nbsp;:&nbsp;&nbsp;</td>
                                            <td><?php echo $data['city']; ?></td>
                                        </tr>
                                        <tr>
                                            <td>State</td>
                                            <td>&nbsp;:&nbsp;&nbsp;</td>
                                            <td><?php echo $data['state']; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Country</td>
                                            <td>&nbsp;:&nbsp;&nbsp;</td>
                                            <td><?php echo $data['country']; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Pincode</td>
                                            <td>&nbsp;:&nbsp;&nbsp;</td>
                                            <td><?php echo $data['pincode']; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Contact number</td>
                                            <td>&nbsp;:&nbsp;&nbsp;</td>
                                            <td><?php echo $data['country_code']; ?>&nbsp;<?php echo $data['prifix']; ?>&nbsp;<?php echo $data['contact_number']; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Mobile Number</td>
                                            <td>&nbsp;:&nbsp;&nbsp;</td>
                                            <td><?php echo $data['country_code']; ?>&nbsp;<?php echo $data['mobile_number']; ?></td>
                                        </tr>
                                    </table><br><br>
                                </div>
                                <div class="row domains">
                                    <div class="active_domain col-lg-6 col-md-6 col-sm-6">
                                        <h3>Active domain details</h3>
                                        <?php
                                        try {
                                            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                                            $sql1 = $conn->prepare("SELECT * from domain_information where company_name='$comp_name' and delete_status='false'");
                                            $sql1->execute();
                                        } catch (PDOException $e) {
                                            echo $sql . "<br>" . $e->getMessage();
                                        }
                                        $x = 1;
                                        while ($data1 = $sql1->fetch(PDO::FETCH_ASSOC)) {
                                            ?>
                                            <script type="text/javascript">
                                                $(document).ready(function () {
                                                    $(".div<?php echo $x; ?>").hide();
                                                });
                                                $(document).ready(function () {
                                                    $(".btn<?php echo $x; ?>").click(function () {
                                                        $(".div<?php echo $x; ?>").fadeToggle(1000);

                                                    });
                                                });

                                            </script>
                                            <script type="text/javascript">
                                                function ClipBoard(elem, btn) {
                                                    var aux = document.createElement("input");
                                                    aux.setAttribute("value", document.getElementById(elem).innerHTML);
                                                    document.body.appendChild(aux);
                                                    aux.select();
                                                    document.execCommand("copy");
                                                    document.body.removeChild(aux);
                                                    $(btn).tooltip('show');
                                                }
                                                function Change(element) {
                                                    var text = document.getElementById(element).firstChild;
                                                    text.data = text.data == "expand" ? "collapse" : "expand";
                                                }
                                            </script>
                                            <div class="domain_details">
                                                <br>
                                                <div class="domain_name"><strong><?php echo $data1['domain_name']; ?></strong></div>
                                                <div class="domain_buttons">
                                                    <!--<a id="exp_btn_<?php echo $x; ?>" class="btn<?php echo $x; ?>" href="#" onclick="change_expand_button(this.id);"><span class="glyphicon glyphicon-chevron-down"></span></a>&nbsp;  -->
                                                    <button type="button" id="exp_btn_<?php echo $x; ?>" class="btn btn-info btn-xs btn_action btn<?php echo $x; ?>" onclick="Change(this.id);">expand</button>
                                                    <a href="domain_update.php?id=<?php echo $data1['id']; ?>&data" class="btn btn-warning btn-xs btn_action">Edit</a>
                                                    <a href="delete_domain.php?id=<?php echo $data1['id']; ?>&comp_name=<?php echo $data1['company_name']; ?>&data" id="dlt_id_active<?php echo $x; ?>" class="hdn_lnk"></a>
                                                    <button id="id_active<?php echo $x; ?>" class="btn btn-danger btn-xs btn_action butn_dlt" onclick="checkDelete(this.id);">Delete</button>
                                                </div>
                                                <div class=" domain_detail div<?php echo $x; ?>">
                                                    <table class="tbl_domain_detail">
                                                        <tr>
                                                            <td>Admin Name</td>
                                                            <td>&nbsp;:&nbsp;&nbsp;</td>
                                                            <td><span  id="a_name<?php echo $x; ?>"><?php echo $data1['admin_name']; ?></span>
                                                                <button type="button" id="btn_a_name<?php echo $x; ?>" class="copy btn btn-xs btn-success btn_action" onclick="ClipBoard('a_name<?php echo $x; ?>', '#btn_a_name<?php echo $x; ?>')" data-toggle="tooltip" title="copied!">copy</button></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Admin Email</td>
                                                            <td>&nbsp;:&nbsp;&nbsp;</td>
                                                            <td><span  id="a_email<?php echo $x; ?>"><?php echo $data1['admin_email']; ?></span>
                                                                <input type="button" value="copy" id="btn_a_email<?php echo $x; ?>" class="copy btn btn-xs btn-success btn_action" onclick="ClipBoard('a_email<?php echo $x; ?>', '#btn_a_email<?php echo $x; ?>')" data-toggle="tooltip"  title="copied!"></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Admin Password</td>
                                                            <td>&nbsp;:&nbsp;&nbsp;</td>
                                                            <td><span id="a_pass<?php echo $x; ?>"><?php echo $data1['admin_password']; ?></span>
                                                                <input type="button" value="copy" id="btn_a_pass<?php echo $x; ?>" class="copy btn btn-xs btn-success btn_action" onclick="ClipBoard('a_pass<?php echo $x; ?>', '#btn_a_pass<?php echo $x; ?>')" data-toggle="tooltip"  title="copied!"></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Editor Name</td>
                                                            <td>&nbsp;:&nbsp;&nbsp;</td>
                                                            <td><span id="e_name<?php echo $x; ?>"><?php echo $data1['editor_name']; ?></span>
                                                                <input type="button" value="copy" id="btn_e_name<?php echo $x; ?>" class="copy btn btn-xs btn-success btn_action" onclick="ClipBoard('e_name<?php echo $x; ?>', '#btn_e_name<?php echo $x; ?>')" data-toggle="tooltip"  title="copied!"></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Editor Password</td>
                                                            <td>&nbsp;:&nbsp;&nbsp;</td>
                                                            <td><span id="e_pass<?php echo $x; ?>"><?php echo $data1['editor_password']; ?></span>
                                                                <input type="button" value="copy" id="btn_e_pass<?php echo $x; ?>" class="copy btn btn-xs btn-success btn_action" onclick="ClipBoard('e_pass<?php echo $x; ?>', '#btn_e_pass<?php echo $x; ?>')" data-toggle="tooltip"  title="copied!"></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Editor Email</td>
                                                            <td>&nbsp;:&nbsp;&nbsp;</td>
                                                            <td><span id="e_email<?php echo $x; ?>"><?php echo $data1['editor_email']; ?></span>
                                                                <input type="button" value="copy" id="btn_e_email<?php echo $x; ?>" class="copy btn btn-xs btn-success btn_action" onclick="ClipBoard('e_email<?php echo $x; ?>', '#btn_e_email<?php echo $x; ?>')" data-toggle="tooltip"  title="copied!"></td>
                                                        </tr>
                                                    </table><br>
                                                </div>
                                            </div>
                                            <?php
                                            $x++;
                                        }
                                        ?>
                                    </div>
                                    <div class="deleted_domain col-lg-6 col-md-6 col-sm-6">
                                        <h3>Deleted domain details</h3>
                                        <?php
                                        try {
                                            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                                            $sql1 = $conn->prepare("SELECT * from domain_information where company_name='$comp_name' and delete_status='true'");
                                            $sql1->execute();
                                        } catch (PDOException $e) {
                                            echo $sql . "<br>" . $e->getMessage();
                                        }
                                        $x = 1;
                                        while ($data1 = $sql1->fetch(PDO::FETCH_ASSOC)) {
                                            ?>
                                            <script type="text/javascript">
                                                $(document).ready(function () {
                                                    $(".del_div<?php echo $x; ?>").hide();
                                                })

                                                $(document).ready(function () {
                                                    $(".del_btn<?php echo $x; ?>").click(function () {
                                                        $(".del_div<?php echo $x; ?>").fadeToggle(1000);

                                                    })
                                                })
                                            </script>
                                            <script type="text/javascript">
                                                function ClipBoard(elem, btn) {
                                                    var aux = document.createElement("input");
                                                    aux.setAttribute("value", document.getElementById(elem).innerHTML);
                                                    document.body.appendChild(aux);
                                                    aux.select();
                                                    document.execCommand("copy");
                                                    document.body.removeChild(aux);
                                                    $(btn).tooltip('show');
                                                }
                                                function Change(element) {
                                                    var text = document.getElementById(element).firstChild;
                                                    text.data = text.data == "expand" ? "collapse" : "expand";
                                                }
                                            </script>
                                            <div class="deleted_domain_details">
                                                <br>
                                                <div class="domain_name"><strong><?php echo $data1['domain_name']; ?></strong></div>
                                                <div class="domain_buttons">
                                                    <!-- <a id="exp_btn_<?php echo $x; ?>" class="btn<?php echo $x; ?>" href="#" onclick="change_expand_button(this.id);"><span class="glyphicon glyphicon-chevron-down"></span></a>&nbsp; -->
                                                    <button type="button" id="del_exp_btn_<?php echo $x; ?>" class="btn btn-info btn-xs btn_action del_btn<?php echo $x; ?>" onclick="Change(this.id);">expand</button>
                                                    <a href="domain_restore.php?id=<?php echo $data1['id']; ?>&comp_name=<?php echo $data1['company_name']; ?>&data" class="btn btn-warning btn-xs btn_action">Restore</a>
                                                    <a href="delete_domain_permanently.php?id=<?php echo $data1['id']; ?>&comp_name=<?php echo $data1['company_name']; ?>&data" id="dlt_id_deleted<?php echo $x; ?>" class="hdn_lnk"></a>
                                                    <button id="id_deleted<?php echo $x; ?>" class="btn btn-danger btn-xs btn_action butn_dlt_2" onclick="checkDelete(this.id);">Delete</button>
                                                
                                                </div>
                                                <div class=" domain_detail del_div<?php echo $x; ?>">
                                                    <table class="tbl_domain_detail">
                                                        <tr>
                                                            <td>Admin Name</td>
                                                            <td>&nbsp;:&nbsp;&nbsp;</td>
                                                            <td><span  id="del_a_name<?php echo $x; ?>"><?php echo $data1['admin_name']; ?></span>
                                                                <button type="button" id="del_btn_a_name<?php echo $x; ?>" class="copy btn btn-xs btn-success btn_action" onclick="ClipBoard('del_a_name<?php echo $x; ?>', '#del_btn_a_name<?php echo $x; ?>')" data-toggle="tooltip" title="copied!">copy</button></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Admin Email</td>
                                                            <td>&nbsp;:&nbsp;&nbsp;</td>
                                                            <td><span  id="del_a_email<?php echo $x; ?>"><?php echo $data1['admin_email']; ?></span>
                                                                <input type="button" value="copy" id="del_btn_a_email<?php echo $x; ?>" class="copy btn btn-xs btn-success btn_action" onclick="ClipBoard('del_a_email<?php echo $x; ?>', '#del_btn_a_email<?php echo $x; ?>')" data-toggle="tooltip"  title="copied!"></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Admin Password</td>
                                                            <td>&nbsp;:&nbsp;&nbsp;</td>
                                                            <td><span id="del_a_pass<?php echo $x; ?>"><?php echo $data1['admin_password']; ?></span>
                                                                <input type="button" value="copy" id="del_btn_a_pass<?php echo $x; ?>" class="copy btn btn-xs btn-success btn_action" onclick="ClipBoard('del_a_pass<?php echo $x; ?>', '#del_btn_a_pass<?php echo $x; ?>')" data-toggle="tooltip"  title="copied!"></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Editor Name</td>
                                                            <td>&nbsp;:&nbsp;&nbsp;</td>
                                                            <td><span id="del_e_name<?php echo $x; ?>"><?php echo $data1['editor_name']; ?></span>
                                                                <input type="button" value="copy" id="del_btn_e_name<?php echo $x; ?>" class="copy btn btn-xs btn-success btn_action" onclick="ClipBoard('del_e_name<?php echo $x; ?>', '#del_btn_e_name<?php echo $x; ?>')" data-toggle="tooltip"  title="copied!"></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Editor Password</td>
                                                            <td>&nbsp;:&nbsp;&nbsp;</td>
                                                            <td><span id="del_e_pass<?php echo $x; ?>"><?php echo $data1['editor_password']; ?></span>
                                                                <input type="button" value="copy" id="del_btn_e_pass<?php echo $x; ?>" class="copy btn btn-xs btn-success btn_action" onclick="ClipBoard('del_e_pass<?php echo $x; ?>', '#del_btn_e_pass<?php echo $x; ?>')" data-toggle="tooltip"  title="copied!"></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Editor Email</td>
                                                            <td>&nbsp;:&nbsp;&nbsp;</td>
                                                            <td><span id="del_e_email<?php echo $x; ?>"><?php echo $data1['editor_email']; ?></span>
                                                                <input type="button" value="copy" id="del_btn_e_email<?php echo $x; ?>" class="copy btn btn-xs btn-success btn_action" onclick="ClipBoard('del_e_email<?php echo $x; ?>', '#del_btn_e_email<?php echo $x; ?>')" data-toggle="tooltip"  title="copied!"></td>
                                                        </tr>
                                                    </table><br>
                                                </div>
                                            </div>
                                            <?php
                                            $x++;
                                        }
                                        ?>
                                    </div>
                                </div>
                                <?php
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