<?php
    include "includes/admin_header.php";
    include "includes/admin_functions.php";
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
                            Users
                        </h1>
                        <?php
                            if(isset($_GET['source'])){
                                $source = $_GET['source'];
                            }
                            else{
                                $source = "";
                            }
                            if($source == "add_user"){
                                include "includes/add_user.php";
                            }
                            else{
                                showUsers();
                            }
                         ?>
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