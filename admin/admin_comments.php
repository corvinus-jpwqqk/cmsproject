<?php
    include "includes/admin_header.php";
    include "includes/admin_functions.php";
?>

<body>
    <div id="wrapper">
        <!-- Navigation -->
        <?php
            include "includes/admin_navigation.php";
            updateComments();
        ?>
        <div id="page-wrapper">
            <div class="container-fluid">
                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            View All Comments
                        </h1>
                        
                        <?php showComments(); ?>
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