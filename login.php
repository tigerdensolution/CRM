<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Login</title>
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/bootstrap-theme.min.css">
        <link rel="stylesheet" href="css/loginStyle.css">
        <script>
            function Validation() {
                if (checkName()) {
                    if (checkPass()) {
                        return true;
                    } else {
                        return false;
                    }
                } else {
                    return false;
                }

            }
            function checkName() {
                var spac = /^[ ]*$/;
                var uname = document.getElementById('uname');
                if (uname.value == "" || uname.value == null) {
                    uname.focus();
                    return false;
                } else {
                    if (uname.value.match(spac)) {
                        uname.focus();
                        return false;
                    } else {
                        return true;
                    }
                }
            }
            function checkPass() {
                var spac = /^[ ]*$/;
                var upasw = document.getElementById('upasw');
                if (upasw.value == "" || upasw.value == null) {
                    upasw.focus();
                    return false;
                } else {
                    if (upasw.value.match(spac)) {
                        upasw.focus();
                        return false;
                    } else {
                        return true;
                    }
                }
            }
        </script>
    </head>
    <body onload="document.login.uname.focus();">
        <?php
        if (isset($_POST['login'])) {

            require_once 'database.php';
            $uname = trim($_POST['uname']);
            $upasw = trim($_POST['upasw']);
            $uname = stripcslashes($uname);
            $upasw = stripcslashes(md5($upasw));
            try {
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $sql = $conn->prepare("SELECT * from user_login where user_name='$uname' and password='$upasw'");
                $sql->execute();
            } catch (PDOException $e) {
                echo $sql . "<br>" . $e->getMessage();
            }
            $count = $sql->rowCount();
            if ($count > 0) {
                $data = $sql->fetch(PDO::FETCH_ASSOC);
                $user_name = $data['user_name'];
                $password = $data['password'];
                if ($user_name = $uname && $password = $upasw) {
                    $_SESSION['user_name'] = $uname;
                    $_SESSION['active'] = time();
                    header("location:index.php");
                }
            }
            ?>
            <div class="container-fluid login_page">
                <div class="login_panel">
                    <form action="login.php" method="post" name="login">
                        <h2>CRM Web Logic</h2>
                        <input type="text" id="uname" class="form_input" name="uname" placeholder="user name"><br>
                        <input type="password" id="upasw" class="form_input" name="upasw" placeholder="password"><br>
                        <p class="mesgs">incorrect user name or password</p>
                        <button class="form_btn" name="login" onclick="return Validation();">Login</button>
                    </form>
                </div>
            </div>
        <?php } else { ?>
            <div class="container-fluid login_page">
                <div class="login_panel">
                    <form action="login.php" method="post" name="login">
                        <h2>CRM Web Logic</h2>
                        <input type="text" id="uname" class="form_input" name="uname" placeholder="user name"><br>
                        <input type="password" id="upasw" class="form_input" name="upasw" placeholder="password"><br>
                        <p class="mesgs" style="visibility:hidden;">incorrect user name or password</p>
                        <button type="submit" class="form_btn" name="login" onclick="return Validation();">Login</button>
                    </form>
                </div>
            </div>
            <?php
            $conn = NULL;
        }
        ?>
    </body>
</html>