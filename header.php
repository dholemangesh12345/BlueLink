<?php
    include "config.php";
    session_start();
    $page = basename($_SERVER['PHP_SELF']);
    switch($page){
    case "single.php":
      if(isset($_GET['Pid'])){
        $sql_title = "SELECT Ptitle FROM postsdata WHERE Pid = {$_GET['Pid']}";
        $result_title = mysqli_query($conn, $sql_title);
        $row_title = mysqli_fetch_assoc($result_title);
        $page_title = $row_title['Ptitle'];
      }else{
        $page_title = "No Post Found";
      }
      break;
    case "category.php":
      if(isset($_GET['Cid'])){
        $sql_title = "SELECT Cname FROM categoriesdata WHERE Cid = {$_GET['Cid']}";
        $result_title = mysqli_query($conn, $sql_title);
        $row_title = mysqli_fetch_assoc($result_title);
        $page_title = $row_title['Cname'] . " News";
      }else{
        $page_title = "No Post Found";
      }
      break;
    case "user.php":
      if(isset($_GET['Uid'])){
        $sql_title = "SELECT Uname FROM usersdata WHERE Uid = {$_GET['Uid']}";
        $result_title = mysqli_query($conn, $sql_title);
        $row_title = mysqli_fetch_assoc($result_title);
        $page_title = "News By " . $row_title['Uname'];
      }else{
        $page_title = "No Post Found";
      }
      break;
    case "search.php":
      if(isset($_GET['search'])){
        $page_title = $_GET['search'];
      }else{
        $page_title = "No Post Found";
      }
      break;
    default:
      $page_title = 'Home';
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title><?php echo "Bluelinks | " . $page_title; ?></title>
    <!-- Bootstrap -->
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <!-- Font Awesome Icon -->
    <link rel="stylesheet" href="css/font-awesome.css">
    <!-- Custom stlylesheet -->
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<!-- HEADER -->
<div id="header">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row">
            <!-- LOGO -->
            <div class="col-md-offset-4 col-md-4">
                <a href="index.php" id="logo"><img src="images/bltransparent.png"></a>
            </div>
            <!-- /LOGO -->
        </div>
        <div class="row">
        <?php
            if(!isset($_SESSION['username'])) {
        ?>
        <a href="admin/index.php" class="admin-login">Login/Signup</a>
        <?php
            } else {
        ?>        
        <a href="admin/index.php" class="admin-login">View Account</a>
        <?php
            }
        ?>
        <a href="admin/about-developer.php" class="admin-login">About Developer</a>
        <a href="admin/feedback.php" class="admin-login">Feedback</a>
        </div>
    </div>
</div>
<!-- /HEADER -->
<!-- Menu Bar -->
<div id="menu-bar">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <?php
                    $sql_query = "SELECT * FROM categoriesdata";
                    $result = mysqli_query($conn, $sql_query) OR die("Query Failed!");
                ?>
                <ul class='menu'>
                    <li><a href='index.php'>Home</a></li>
                    <?php 
                        while($row = mysqli_fetch_assoc($result)) {
                            $active = "";
                            if(isset($_GET["Cid"])) {
                                if($row['Cid'] == $_GET["Cid"]){
                                    $active = "active";
                                }else{
                                    $active = "";
                                }
                            }
                            echo "<li> <a class='{$active}' href='category.php?Cid={$row['Cid']}'> {$row["Cname"]} </a> </li>";
                        }
                    ?>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- /Menu Bar -->
