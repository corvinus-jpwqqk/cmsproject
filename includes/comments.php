                <!-- Blog Comments -->

                <?php
                    if(isset($_POST['create_comment'])){
                        //global $connection;
                        $comment_author = $_POST['comment_author'];
                        $comment_content = $_POST['comment_content'];
                        $comment_email = $_POST['comment_email'];
                        $postid = $_GET['postid'];
                        //$comment_date = now();
                        $comment_insert_query = "INSERT INTO comments (comment_post_id, ";
                        $comment_insert_query .= "comment_date, comment_author, comment_email, ";
                        $comment_insert_query .= "comment_content, comment_status) VALUES ";
                        $comment_insert_query .= "($postid, now(), '{$comment_author}', ";
                        $comment_insert_query .= "'{$comment_email}', '{$comment_content}', 'unapproved')";
                        $comment_instert = mysqli_query($connection, $comment_insert_query);
                        if($comment_instert){
                            $comment_count_query = "UPDATE posts SET post_comment_count=post_comment_count+1 ";
                            $comment_count_query .= "WHERE post_id = $postid";
                            $comment_inc = mysqli_query($connection, $comment_count_query);
                        }
                    }
                ?>
                <!-- Comments Form -->
                <div class="well">
                    <h4>Leave a Comment:</h4>
                    <form action="" method="post" role="form">
                        <div class="form-group">
                            <label for="comment_author">Author</label>
                            <input type="text" class="form-control" name="comment_author">
                        </div>
                        <div class="form-group">
                            <label for="comment_email">Email</label>
                            <input type="email" name="comment_email" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="comment_content">Email</label>
                            <textarea class="form-control" rows="3" name=comment_content></textarea>
                        </div>
                        <button type="submit" name="create_comment" class="btn btn-primary">Submit</button>
                    </form>
                </div>

                <hr>

                <!-- Posted Comments -->
                    <?php
                        global $connection;
                        $postid = $_GET['postid'];
                        $comment_query = "SELECT * FROM comments WHERE comment_status='approved' AND comment_post_id=$postid";
                        $comments_query_result = mysqli_query($connection, $comment_query);
                        while($row = mysqli_fetch_assoc($comments_query_result)){
                            $comment_author = $row['comment_author'];
                            $comment_date = $row['comment_date'];
                            $comment_content = $row['comment_content']; ?>
                            <div class="media">
                            <div class="media-body">
                                <h4 class="media-heading"><?php echo $comment_author; ?>
                                    <small>On <?php echo $comment_date; ?></small>
                                </h4>
                                <?php echo $comment_content; ?>
                            </div>
                        </div>


                        <?php } ?>
                <!-- Comment -->


                <!-- Comment -->
                <!--
                <div class="media">
                    <a class="pull-left" href="#">
                        <img class="media-object" src="http://placehold.it/64x64" alt="">
                    </a>
                    <div class="media-body">
                        <h4 class="media-heading">Start Bootstrap
                            <small>August 25, 2014 at 9:30 PM</small>
                        </h4>
                        Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
                         Nested Comment 
                        <div class="media">
                            <a class="pull-left" href="#">
                                <img class="media-object" src="http://placehold.it/64x64" alt="">
                            </a>
                            <div class="media-body">
                                <h4 class="media-heading">Nested Start Bootstrap
                                    <small>August 25, 2014 at 9:30 PM</small>
                                </h4>
                                Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
                            </div>
                        </div>
                         End Nested Comment -->
                        
                    </div>
                </div>
                