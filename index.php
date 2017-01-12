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
        ?>
        <html>
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1">
                <title>Home</title>
                <link rel="stylesheet" href="css/bootstrap.min.css">
                <link rel="stylesheet" href="css/bootstrap-theme.min.css">
                <link rel="stylesheet" href="css/style.css">
            </head>
            <body>
                <div class="container-fluid">
                    <div class="container" >
                        <div class="row logo"><img src="images/Logos -800 x 440 px-04.png" class="img-responsive" style="margin-left:auto; margin-right: auto;"></div>
                        <div class="row menu">
                            <header>
                                <hr>
                                <ul>
                                    <li class="menu_list"><a href="index.php">Home</a></li>
                                    <li class="menu_list client_list">Clients<div class="clients"><a href="add_client.php?data">Add</a>
                                            <a href="main_view.php?data">View</a></div></li>
                                    <li class="menu_list link_list">Links<div class="links"><a href="add_links.php?data">Add</a>
                                            <a href="link_list.php?data">View</a></div></li>      
                                    <li class="menu_list"><a href="add_client.php?data">Add Clients</a></li>
                                    <li class="menu_list"><a href="logout.php?data">Logout</a></li>
                                    <li class="menu_list"><a href="#">Setting</a></li>
                                </ul>
                            </header>
                        </div>
                        <div class="row body">
                        </div>
                    </div>
                    <div class="footer">
                        <span class="left_footer">All right &copy; reserved</span>
                        <span class="right_footer">TigerDen &reg; Solution</span>
                    </div>
                </div>
            </body>
        </html>
        <?php
        $conn = NULL;
    }
} else {
    header("location:login.php");
}