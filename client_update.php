
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
                $company_name = stripcslashes(trim($_POST['company_name']));
                $customer_name = stripcslashes(trim($_POST['customer_name']));
                $customer_email = stripcslashes(trim($_POST['customer_email']));
                $address_1 = stripcslashes(trim($_POST['address_1']));
                $address_2 = stripcslashes(trim($_POST['address_2']));
                $address_3 = stripcslashes(trim($_POST['address_3']));
                $city = stripcslashes(trim($_POST['city']));
                $state = stripcslashes(trim($_POST['state']));
                $country = stripcslashes(trim($_POST['country']));
                $country_code = stripcslashes(trim($_POST['country_code']));
                $pincode = stripcslashes(trim($_POST['pincode']));
                $prifix = stripcslashes(trim($_POST['prifix']));
                $contact_number = stripcslashes(trim($_POST['contact_number']));
                $mobile_number = stripcslashes(trim($_POST['mobile_number']));
                if ($mobile_number == NULL || $mobile_number == "") {
                    $mobile_number = 0;
                }
                //echo $mobile_number;
//creating database connection.
                try {
//error exception
                    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                    $id = stripcslashes($_GET['id']);
                    $cmp_name = stripcslashes($_GET['comp_name']);
                    $sql = "UPDATE clients_information SET customer_email='$customer_email',customer_name='$customer_name',company_name='$company_name',address_1='$address_1',address_2='$address_2',address_3='$address_3',city='$city',state='$state',country='$country',country_code='$country_code',pincode=$pincode,prifix=$prifix,contact_number=$contact_number,mobile_number=$mobile_number WHERE id=$id and delete_status='false'";
                    $stmt = $conn->exec($sql);
                    $sql1 = "UPDATE domain_information SET company_name='$company_name' where company_name='$cmp_name'";
                    $stmt1 = $conn->exec($sql1);
                    header("location:customer_detail.php?comp_name=$company_name&data");
                } catch (PDOException $e) {
                    echo $sql . "<br>" . $e->getMessage();
                }
            }
            if (isset($_GET['id'])) {
                $id = stripcslashes($_GET['id']);
                $sql = $conn->prepare("SELECT * from clients_information where id = $id and delete_status='false'");
                $sql->execute();
                $data = $sql->fetch(PDO::FETCH_ASSOC);
                ?>
                <!-- HTML content starts from hear -->
                <html>
                    <head>
                        <meta charset="UTF-8">
                        <meta name="viewport" content="width=device-width, initial-scale=1.0">
                        <title>update client details</title>
                        <link rel="stylesheet" href="css/bootstrap.min.css">
                        <link rel="stylesheet" href="css/bootstrap-theme.min.css">
                        <link rel="stylesheet" href="css/style.css">
                        <script>
                            function validation() {
                                if (co_Name()) {
                                    if (cus_Name()) {
                                        if (Email()) {
                                            if (Address()) {
                                                if (City()) {
                                                    if (State()) {
                                                        if (Country()) {
                                                            if (country_Code()) {
                                                                if (Pincode()) {
                                                                    if (Prifix()) {
                                                                        if (con_Number()) {
                                                                            if (mob_Number()) {
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
                            function co_Name() {
                                var co_name = document.getElementById('company_name');
                                var alpha = /^[A-Za-z(). ]*$/;
                                var spac = /^[ ]*$/;
                                if (co_name.value == "" || co_name.value == null) {
                                    co_name.focus();
                                    document.getElementById('co_na_mesg').innerHTML = "Please enter name";
                                    return false;
                                } else {
                                    if (co_name.value.match(spac)) {
                                        co_name.focus();
                                        document.getElementById('co_na_mesg').innerHTML = "Please enter valid name";
                                        return false;
                                    } else {
                                        if (co_name.value.match(alpha)) {
                                            return true;
                                        } else {
                                            co_name.focus();
                                            document.getElementById('co_na_mesg').innerHTML = "Please enter valid name";
                                            return false;
                                        }
                                    }
                                }
                            }
                            function cus_Name() {
                                var cus_name = document.getElementById('customer_name');
                                var alpha = /^[A-Za-z .]*$/;
                                var spac = /^[ ]*$/;
                                if (cus_name.value == "" || cus_name.value == null) {
                                    cus_name.focus();
                                    document.getElementById('cu_na_mesg').innerHTML = "Please enter name";
                                    return false;
                                } else {
                                    if (cus_name.value.match(spac)) {
                                        cus_name.focus();
                                        document.getElementById('cu_na_mesg').innerHTML = "Please enter valid name";
                                        return false;
                                    } else {
                                        if (cus_name.value.match(alpha)) {
                                            return true;
                                        } else {
                                            cus_name.focus();
                                            document.getElementById('cu_na_mesg').innerHTML = "Please enter valid name";
                                            return false;
                                        }
                                    }
                                }
                            }
                            function City() {
                                var city = document.getElementById('city');
                                var alpha = /^[A-Za-z ]*$/;
                                var spac = /^[ ]*$/;
                                if (city.value == "" || city.value == null) {
                                    city.focus();
                                    document.getElementById('cit_mesg').innerHTML = "Please enter city";
                                    return false;
                                } else {
                                    if (city.value.match(spac)) {
                                        city.focus();
                                        document.getElementById('cit_mesg').innerHTML = "Please enter valid city";
                                        return false;
                                    } else {
                                        if (city.value.match(alpha)) {
                                            return true;
                                        } else {
                                            city.focus();
                                            document.getElementById('cit_mesg').innerHTML = "Please enter valid city";
                                            return false;
                                        }
                                    }
                                }
                            }
                            function State() {
                                var state = document.getElementById('state');
                                var alpha = /^[A-Za-z ]*$/;
                                var spac = /^[ ]*$/;
                                if (state.value == "" || state.value == null) {
                                    state.focus();
                                    document.getElementById('sta_mesg').innerHTML = "Please enter state";
                                    return false;
                                } else {
                                    if (state.value.match(spac)) {
                                        cus_name.focus();
                                        document.getElementById('sta_mesg').innerHTML = "Please enter valid state";
                                        return false;
                                    } else {
                                        if (state.value.match(alpha)) {
                                            return true;
                                        } else {
                                            state.focus();
                                            document.getElementById('sta_mesg').innerHTML = "Please enter valid state";
                                            return false;
                                        }
                                    }
                                }
                            }
                            function Country() {
                                var country = document.getElementById('country');
                                var alpha = /^[A-Za-z ]*$/;
                                var spac = /^[ ]*$/;
                                if (country.value == "" || country.value == null) {
                                    country.focus();
                                    document.getElementById('con_mesg').innerHTML = "Please enter country";
                                    return false;
                                } else {
                                    if (country.value.match(spac)) {
                                        country.focus();
                                        document.getElementById('cun_mesg').innerHTML = "Please enter valid country";
                                        return false;
                                    } else {
                                        if (country.value.match(alpha)) {
                                            return true;
                                        } else {
                                            country.focus();
                                            document.getElementById('cun_mesg').innerHTML = "Please enter valid country";
                                            return false;
                                        }
                                    }
                                }
                            }
                            function mob_Number() {
                                var number = /^[0-9]{10}$/;
                                var spac = /^[ ]*$/;
                                var zero = /^[0]*$/;
                                var mob_num = document.getElementById('mobile_number');
                                if (mob_num.value == "" || mob_num.value == null) {
                                    return true;
                                } else {
                                    if (mob_num.value.match(spac)) {
                                        mob_num.focus();
                                        document.getElementById('mob_mesg').innerHTML = "Please enter valid mobile number";
                                        return false;
                                    } else {
                                        if (mob_num.value.match(number)) {
                                            return true;
                                        } else {
                                            if (mob_num.value.match(zero)) {
                                                return true;
                                            } else {
                                                mob_num.focus();
                                                document.getElementById('mob_mesg').innerHTML = "Please enter valid mobile number";
                                                return false;
                                            }
                                        }
                                    }
                                }
                            }
                            function con_Number() {
                                var number = /^[0-9]{7}$/;
                                var spac = /^[ ]*$/;
                                var con_num = document.getElementById('contact_number');
                                if (con_num.value == "" || con_num.value == null) {
                                    con_num.focus();
                                    document.getElementById('con_mesg').innerHTML = "Please enter mobile number";
                                    return false;
                                } else {
                                    if (con_num.value.match(spac)) {
                                        con_num.focus();
                                        document.getElementById('con_mesg').innerHTML = "Please enter valid mobile number";
                                        return false;
                                    } else {
                                        if (con_num.value.match(number)) {
                                            return true;
                                        } else {
                                            con_num.focus();
                                            document.getElementById('con_mesg').innerHTML = "Please enter valid mobile number";
                                            return false;
                                        }
                                    }
                                }
                            }
                            function Prifix() {
                                var number = /^[0-9]{3}$/;
                                var spac = /^[ ]*$/;
                                var prifix = document.getElementById('prifix');
                                if (prifix.value == "" || prifix.value == null) {
                                    prifix.focus();
                                    document.getElementById('pri_mesg').innerHTML = "Please enter prifix";
                                    return false;
                                } else {
                                    if (prifix.value.match(spac)) {
                                        prifix.focus();
                                        document.getElementById('pri_mesg').innerHTML = "Please enter valid prifix";
                                        return false;
                                    } else {
                                        if (prifix.value.match(number)) {
                                            return true;
                                        } else {
                                            prifix.focus();
                                            document.getElementById('pri_mesg').innerHTML = "Please enter valid prifix";
                                            return false;
                                        }
                                    }
                                }
                            }
                            function Pincode() {
                                var number = /^[0-9]{6}$/;
                                var spac = /^[ ]*$/;
                                var pincode = document.getElementById('pincode');
                                if (pincode.value == "" || pincode.value == null) {
                                    pincode.focus();
                                    document.getElementById('pin_mesg').innerHTML = "Please enter pincode";
                                    return false;
                                } else {
                                    if (pincode.value.match(spac)) {
                                        pincode.focus();
                                        document.getElementById('pin_mesg').innerHTML = "Please enter valid pincode";
                                        return false;
                                    } else {
                                        if (pincode.value.match(number)) {
                                            return true;
                                        } else {
                                            pincode.focus();
                                            document.getElementById('pin_mesg').innerHTML = "Please enter valid pincode";
                                            return false;
                                        }
                                    }
                                }
                            }
                            function Email() {
                                var check = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
                                var spac = /^[ ]*$/;
                                var cus_email = document.getElementById('customer_email');
                                if (cus_email.value == "" || cus_email.value == null) {
                                    cus_email.focus();
                                    document.getElementById('cu_em_mesg').innerHTML = "Please enter customer email";
                                    return false;
                                } else {
                                    if (cus_email.value.match(spac)) {
                                        cus_email.focus();
                                        document.getElementById('cu_em_mesg').innerHTML = "Please enter valid customer email";
                                        return false;
                                    } else {
                                        if (cus_email.value.match(check)) {
                                            return true;
                                        } else {
                                            cus_email.focus();
                                            document.getElementById('cu_em_mesg').innerHTML = "Please enter valid customer email";
                                            return false;
                                        }
                                    }
                                }
                            }
                            function Address() {
                                var spac = /^[ ]*$/;
                                var add_1 = document.getElementById('address_1');
                                if (add_1.value == "" || add_1.value == null) {
                                    add_1.focus();
                                    document.getElementById('a1_mesg').innerHTML = "Please enter address";
                                    return false;
                                } else {
                                    if (add_1.value.match(spac)) {
                                        add_1.focus();
                                        document.getElementById('a1_mesg').innerHTML = "Please enter valid address";
                                        return false;
                                    } else {
                                        return true;
                                    }
                                }
                            }
                            function country_Code() {
                                var check = /^\+\d{1,3}$/;
                                var spac = /^[ ]*$/;
                                var con_code = document.getElementById('country_code');
                                if (con_code.value == "" || con_code.value == null) {
                                    con_code.focus();
                                    document.getElementById('cun_co_mesg').innerHTML = "Please enter country code";
                                    return false;
                                } else {
                                    if (con_code.value.match(spac)) {
                                        con_code.focus();
                                        document.getElementById('cun_co_mesg').innerHTML = "Please enter valid country code";
                                        return false;
                                    } else {
                                        if (con_code.value.match(check)) {
                                            return true;
                                        } else {
                                            con_code.focus();
                                            document.getElementById('cun_co_mesg').innerHTML = "Please enter valid country code";
                                            return false;
                                        }
                                    }
                                }
                            }
                        </script>
                    </head>
                    <body onload="document.client_detail.company_name.focus();">
                        <div class="container-fluid">
                            <div class="container">
                                <p class="top-right"><span class="h1">Enter client details</span><span class="logout"><a href="logout.php?data"><span class="glyphicon glyphicon-log-out"></span>&nbsp;Logout</a></span></p>
                                <a href="index.php" class="btn btn-primary btn_main"><span class="glyphicon glyphicon-home"></span>&nbsp;Home</a>
                                <a href="customer_detail.php?comp_name=<?php echo $data['company_name']; ?>&data" class="btn btn-primary btn_main"><span class="glyphicon glyphicon-arrow-left"></span>&nbsp;Back</a><br><br>
                                <!-- client detail form starting  -->
                                <div>
                                    <form name="client_detail" action="client_update.php?id=<?php echo $data['id']; ?>&comp_name=<?php echo $data['company_name']; ?>&data" method="post" onsubmit="return validation();">
                                        <div class="tbl_domain col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                            <table>
                                                <tr>
                                                    <td class="domain_dtl">
                                                        Company Name 
                                                    </td>
                                                    <td>
                                                        <input class="form-control" type="text" name="company_name" id="company_name" value="<?php echo $data['company_name']; ?>" pattern="^([a-zA-Z().\s]{3,})$" required>
                                                    </td>
                                                    <td><p class="mesg" id="co_na_mesg"></p></td>
                                                </tr>
                                                <tr>
                                                    <td class="domain_dtl">
                                                        Customer Name 
                                                    </td>
                                                    <td>
                                                        <input class="form-control" type="text" name="customer_name" id="customer_name" value="<?php echo $data['customer_name']; ?>" pattern="^([a-zA-Z.\s]{3,})$" required>
                                                    </td>
                                                    <td><p class="mesg" id="cu_na_mesg"></p></td>
                                                </tr>
                                                <tr>
                                                    <td class="domain_dtl">
                                                        Customer Email Id 
                                                    </td>
                                                    <td>
                                                        <input class="form-control" type="email" name="customer_email" id="customer_email" value="<?php echo $data['customer_email']; ?>" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" required>
                                                    </td>
                                                    <td><p class="mesg" id="cu_em_mesg"></p></td>
                                                </tr>
                                                <tr>
                                                    <td class="domain_dtl">
                                                        Address 1 
                                                    </td>
                                                    <td>
                                                        <textarea class="form-control" name="address_1" id="address_1" required><?php echo $data['address_1']; ?></textarea>
                                                    </td>
                                                    <td><p class="mesg" id="a1_mesg"></p></td>
                                                </tr>
                                                <tr>
                                                    <td class="domain_dtl">
                                                        Address 2 
                                                    </td>
                                                    <td>
                                                        <textarea class="form-control" name="address_2" id="address_2"><?php echo $data['address_2']; ?></textarea>
                                                    </td>
                                                    <td><p class="mesg" id="a2_mesg"></p></td>
                                                </tr>
                                                <tr>
                                                    <td class="domain_dtl">
                                                        Address 3 
                                                    </td>
                                                    <td>
                                                        <textarea class="form-control" name="address_3" id="address_3"><?php echo $data['address_3']; ?></textarea>
                                                    </td>
                                                    <td><p class="mesg" id="a3_mesg"></p></td>
                                                </tr></table>
                                        </div><div class="tbl_domain col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                            <table>
                                                <tr>
                                                    <td class="domain_dtl">
                                                        City 
                                                    </td>
                                                    <td>
                                                        <input class="form-control" type="text" name="city" id="city" value="<?php echo $data['city']; ?>" required>
                                                    </td>
                                                    <td><p class="mesg" id="cit_mesg"></p></td>
                                                </tr>
                                                <tr>
                                                    <td class="domain_dtl">
                                                        State 
                                                    </td>
                                                    <td>
                                                        <input class="form-control" type="text" name="state" id="state" value="<?php echo $data['state']; ?>" required>
                                                    </td>
                                                    <td><p class="mesg" id="sta_mesg"></p></td>
                                                </tr>
                                                <tr>
                                                    <td class="domain_dtl">
                                                        Country 
                                                    </td>
                                                    <td>
                                                        <input class="form-control" type="text" name="country" id="country" value="<?php echo $data['country']; ?>" required>
                                                    </td>
                                                    <td><p class="mesg" id="cun_mesg"></p></td>
                                                </tr>
                                                <tr>
                                                    <td class="domain_dtl">
                                                        Country code
                                                    </td>
                                                    <td>
                                                        <input class="form-control" type="text" name="country_code" id="country_code" value="<?php echo $data['country_code']; ?>" required>
                                                    </td>
                                                    <td><p class="mesg" id="cun_co_mesg"></p></td>
                                                </tr>
                                                <tr>
                                                    <td class="domain_dtl">
                                                        Pincode 
                                                    </td>
                                                    <td>
                                                        <input class="form-control" type="number" name="pincode" id="pincode" value="<?php echo $data['pincode']; ?>" required>
                                                    </td>
                                                    <td><p class="mesg" id="pin_mesg"></p></td>
                                                </tr>
                                                <tr>
                                                    <td class="domain_dtl">
                                                        Prifix 
                                                    </td>
                                                    <td>
                                                        <input class="form-control" type="number" name="prifix" id="prifix" value="<?php echo $data['prifix']; ?>" required>
                                                    </td>
                                                    <td><p class="mesg" id="pri_mesg"></p></td>
                                                </tr>
                                                <tr>
                                                    <td class="domain_dtl">
                                                        Contact Number&nbsp;&nbsp;&nbsp;
                                                    </td>
                                                    <td>
                                                        <input class="form-control" type="tel" name="contact_number" id="contact_number" value="<?php echo $data['contact_number']; ?>" required>
                                                    </td>
                                                    <td><p class="mesg" id="con_mesg"></p></td>
                                                </tr>
                                                <tr>
                                                    <td class="domain_dtl">
                                                        Mobile Number 
                                                    </td>
                                                    <td>
                                                        <input class="form-control" type="tel" name="mobile_number" id="mobile_number" value="<?php echo $data['mobile_number']; ?>" >
                                                    </td>
                                                    <td><p class="mesg" id="mob_mesg"></p></td>
                                                </tr></table></div>
                                        <div style="clear: left;">
                                            <button type="submit" name="update" class="btn btn-success btn_action"><span class="glyphicon glyphicon-floppy-save"></span>&nbsp;Update</button>
                                            <button type="reset" name="reset" class="btn btn-warning btn_action"><span class="glyphicon glyphicon-refresh"></span>&nbsp;Reset</button></div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </body>
                </html>
                <?php
                $conn = NULL;
            } else {
                header("location:main_view?data");
            }
        } else {
            header("location:index.php");
        }
    }
} else {
    header("location:login.php");
}
?>