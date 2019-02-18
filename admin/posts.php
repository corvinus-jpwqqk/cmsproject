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
                                showPosts();
                                break;
                        }
                        if(isset($_POST['checkBoxArray'])){
                            foreach ($_POST['checkBoxArray'] as $checkBoxValue) {
                                $bulk_options = $_POST['bulk_options'];
                                switch($bulk_options){
                                    case "publish":
                                    $query = "UPDATE posts SET post_status='published' WHERE post_id=$checkBoxValue";
                                    $update = mysqli_query($connection, $query);
                                    if(!$update){
                                        die("Query failed: ".mysqli_error($connection));
                                    }
                                    header('Location: posts.php');
                                    break;
                                    case 'draft':
                                    $query = "UPDATE posts SET post_status='draft' WHERE post_id=$checkBoxValue";
                                    $update = mysqli_query($connection, $query);
                                    if(!$update){
                                        die("Query failed: ".mysqli_error($connection));
                                    }
                                    header('Location: posts.php');
                                    break;
                                    case "delete":
                                    $query = "DELETE FROM posts WHERE post_id={$checkBoxValue}";
                                    $delete = mysqli_query($connection, $query);
                                    if(!$delete){
                                        die("Query failed: ".mysqli_error($connection));
                                    }
                                    header('Location: posts.php');
                                    break;
                                    default:
                                    break;
                                }
                            }
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
<script src="js/scripts.js"></script>