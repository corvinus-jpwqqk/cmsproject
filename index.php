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

            <!-- Blog Entries Column -->
            <div class="col-md-8">
                <?php
                    $post_count_query = "SELECT * FROM posts";
                    $post_count_result = mysqli_query($connection, $post_count_query);
                    $post_count = mysqli_num_rows($post_count_result);
                    $post_count /= 2;
                    $post_count = ceil($post_count);
                ?>
                <h1 class="page-header">
                    Viewing all posts
                </h1>

                <!-- First Blog Post -->
                <?php
                if(isset($_GET['page'])){
                    $page = $_GET['page'];
                }
                else{
                    $page = 1;
                }
                $offset = $page*2 - 2;
                echo $offset;
                $query = "SELECT * FROM posts LIMIT $offset, 2";                    
                $result = mysqli_query($connection, $query);
                while($row = mysqli_fetch_assoc($result)){
                    $post_title = $row['post_title'];
                    $post_author = $row['post_author'];
                    $post_date = $row['post_date'];
                    $post_image = $row['post_image'];
                    $post_content = substr($row['post_content'],0,20)."...";
                    $post_id = $row['post_id'];
                    ?>
                    <h2>
                    <a href="post.php?postid=<?php echo $post_id; ?>"><?php echo $post_title ?></a>
                    </h2>
                    <p class="lead">
                        by <a href="author_post.php?author=<?php echo $post_author ?>&pid=<?php echo $post_id ?>"><?php echo $post_author ?></a>
                    </p>
                    <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $post_date ?></p>
                    <hr>
                    <img class="img-responsive" src="images/<?php echo $post_image ?>" alt="">
                    <hr>
                    <p><?php echo $post_content ?></p>
                    <a class="btn btn-primary" href="post.php?postid=<?php echo $post_id; ?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

                    <hr>
                    <?php }  ?>
            

            </div>

            <!-- Blog Sidebar Widgets Column -->
                    <?php
                    include "includes/sidebar.php";
                    ?>

        </div>
        <!-- /.row -->
        <ul class="pager">
            <?php
                for($i = 1 ; $i <= $post_count ; $i++){
                        echo "<li><a href='index.php?page=$i'>$i</li>";
                }
            ?>
        <hr>
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
