<?php
    include "includes/header.php";
    include "includes/connect.php";
?>
<body>

    <!-- Navigation -->
    <?php
        include "includes/navigation.php";
    ?>
    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Post Content Column -->
            <div class="col-lg-8">

                <!-- Blog Post -->
<?php
    if(isset($_GET['postid'])){
        $postid = $_GET['postid'];
        global $connection;
        $getpost_query = "SELECT * FROM posts WHERE post_id=$postid";
        $getpost_query_result = mysqli_query($connection, $getpost_query);
        while($row = mysqli_fetch_assoc($getpost_query_result))
        {
            $post_title = $row['post_title'];
            $post_author = $row['post_author'];
            $post_date = $row['post_date'];
            $post_image = $row['post_image'];
            $post_content = $row['post_content'];
        }
    }
?>

                <!-- Title -->
                <h1><?php echo $post_title; ?></h1>

                <!-- Author -->
                <p class="lead">
                    by <a href="#"><?php echo $post_author; ?></a>
                </p>

                <hr>

                <!-- Date/Time -->
                <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $post_date; ?></p>

                <hr>

                <!-- Preview Image -->
                <img class="img-responsive" src="images/<?php echo $post_image; ?>" alt="nincen"> 
                <hr>

                <!-- Post Content -->
                
                <p><?php echo $post_content; ?></p>

                <hr>
        <?php
            include "includes/comments.php";
        ?>

            </div>

            <!-- Blog Sidebar Widgets Column -->
                    <?php
                        include "includes/sidebar.php";
                    ?>
                    </div>
        </div>
        <!-- /.row -->

        <hr>

        <!-- Footer -->
        <?php
            include "includes/footer.php";
        ?>

    </div>
    <!-- /.container -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</body>

</html>
