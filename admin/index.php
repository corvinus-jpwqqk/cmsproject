<!-- ADMIN INDEX -->
<?php
    include "includes/admin_header.php";
    include "..includes/connect.php";
?>
<?php
global $connection;
$session = session_id();
$time = time();
$time_out_in_seconds = 60;
$time_out = $time - $time_out_in_seconds;
$query = "SELECT * FROM users_online WHERE session='$session'";
$send_query = mysqli_query($connection, $query);
$count = mysqli_num_rows($send_query);
if($count == NULL){
    mysqli_query($connection, "INSERT INTO users_online(session, time) VALUES ('$session', '$time')");
}
else{
    mysqli_query($connection, "UPDATE users_online SET time='$time' WHERE session='$session'");
}
$users_online_query = "SELECT * FROM users_online WHERE time > '$time_out'";
$users_online = mysqli_query($connection, $users_online_query);
$count_user = mysqli_num_rows($users_online);
?>


<body>
    <div id="wrapper">
        <!-- Navigation -->
        <?php
            include "includes/admin_navigation.php";
        ?>
        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            <?php
                                echo $count_user;
                            ?>
                            
                            <small>Subheading</small>
                        </h1>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i>  <a href="index.html">Dashboard</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-file"></i> Blank Page
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->
<?php
    include "includes/admin_footer.php";
?>