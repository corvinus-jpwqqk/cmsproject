<?php
    include "includes/admin_header.php";
    //include "../includes/connect.php";
?>
<?php
function getComments(){
    if(isset($_GET['getcom'])){
        global $connection;
        $post_id = $_GET['getcom'];
        $query = "SELECT * FROM comments WHERE comment_post_id = $post_id";
        $getcomments = mysqli_query($connection, $query);
        while($row = mysqli_fetch_assoc($getcomments)){
             $comment_date = $row['comment_date'];
             $comment_author = $row['comment_author'];
             $comment_email = $row['comment_email'];
             $comment_status = $row['comment_status'];
             $comment_content = $row['comment_content'];
            echo "<tr>
            <td>$comment_author</td>
            <td>$comment_date</td>
            <td>$comment_email</td>
            <td>$comment_status</td>
            <td>$comment_content</td>
            </tr>";
        }
    }
}
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
                            
                            <small>Subheading</small>
                        </h1>
    <table class="table table-bordered">
    <tr>
<th>Author</th>
<th>Date</th>
<th>Email</th>
<th>Status</th>
<th>Content</th>
    </tr>
    <?php getComments(); ?>
    </table>


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