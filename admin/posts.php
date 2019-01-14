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
                            View All Posts
                        </h1>
                        <?php 
                        if(isset($_GET['source'])){
                            $source = $_GET['source'];
                        }
                        else{
                            $source = "";
                            }
                        switch($source){
                            case 'add_post';
                                include "includes/add_post.php";
                                break;
                            case 'edit_post';
                                include "includes/edit_post.php";
                                break;
                            default:
                                echo "default";
                                showPosts();
                                break;
                        }
                            deletePost();
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