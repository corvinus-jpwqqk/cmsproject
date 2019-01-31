<?php
function confirmQuery($query_result){
    global $connection;
    if(!$query_result){
        die("Query failed". mysqli_error($connection));
    }
}

function showCategories(){
    global $connection;
    $cat_query = "SELECT * FROM categories";
    $cat_query_result = mysqli_query($connection, $cat_query);
    while($row = mysqli_fetch_assoc($cat_query_result)){
        $catid = $row['cat_id'];
        $catname = $row['cat_title'];
        echo "<tr>
            <td>{$catid}</td>
            <td>{$catname}</td>
            <td><a href='categories.php?delete={$catid}'>delete</td>
        </tr>";
    }
}
function deleteCategory(){
if(isset($_GET['delete'])){
    global $connection;
    $delete_id=$_GET['delete'];
    $delete_query = "DELETE FROM categories WHERE cat_id={$delete_id}";
    $result_delete_query = mysqli_query($connection, $delete_query);
    if($result_delete_query){
        header('Location: categories.php');
        //refreshes the page basically
    }
    else{
        die("problem with deleting category");
    }
}
}

function newCategory(){
    global $connection;
    if(isset($_POST['submit'])){
        $new_cat_title = $_POST['cat_title'];
        if($new_cat_title == '' || empty($new_cat_title)){
            echo "This line shoudn't be empty";
        }
        else{
            $cat_insert_query = "INSERT INTO categories (cat_title) VALUES ('$new_cat_title')";
            $instert_query_result = mysqli_query($connection, $cat_insert_query);
            confirmQuery($instert_query_result);
        }
        
    }
}

function deletePost(){
    global $connection;
    if(isset($_GET['delete'])){
        $delete_id = $_GET['delete'];
        $del_post_query = "DELETE FROM posts WHERE post_id={$delete_id}";
        $delete_query = mysqli_query($connection, $del_post_query);
        confirmQuery($delete_query);
        if($delete_query){
            header('Location: posts.php');
        }
    }
}


function showPosts(){
    global $connection;
    $post_query = "SELECT * FROM posts";
    $result_post_query = mysqli_query($connection, $post_query);
    echo "
        <table class='table table-bordered table-hover'><thead>
        <tr>
        <th>Id</th>
        <th>Author</th>
        <th>Title</th>
        <th>Category</th>
        <th>Status</th>
        <th>Image</th>
        <th>Tags</th>
        <th>Comments</th>
        <th>Date</th>
        </tr>
        </thead>
        <tbody>
    ";
    while($row = mysqli_fetch_assoc($result_post_query)){
        $post_id = $row['post_id'];
        $post_author = $row['post_author'];
        $post_date = $row['post_date'];
        $post_image = $row['post_image'];
        $post_content = $row['post_content'];
        $post_tags = $row['post_tags'];
        $post_comment = $row['post_comment_count'];
        $post_id = $row['post_id'];
        $post_title = $row['post_title'];
        $post_category = $row['post_category_id'];
        $post_status = $row['post_status'];
        echo "
                <tr>
                <td>$post_id</td>
                <td>$post_author</td>
                <td>$post_title</td>";

                $cat_id_query = "SELECT * FROM categories WHERE cat_id=$post_category";
                $cat_id_result = mysqli_query($connection, $cat_id_query);
                while($row = mysqli_fetch_assoc($cat_id_result)){
                    $current_category = $row['cat_title'];
                }
                echo "
                <td>$current_category</td>
                <td>$post_status</td>
                <td><img width='100' src='../images/$post_image'></td>
                <td>$post_tags</td>
                <td>$post_comment</td>
                <td>$post_date</td>
                <td><a href='./posts.php?source=edit_post&edit={$post_id}'>Edit</a></td>
                <td><a href='./posts.php?delete={$post_id}'>Delete</a></td>
                </tr>";
    }
    echo "</tbody></table>";
}

function showComments(){
    global $connection;
    $comment_query = "SELECT * FROM comments";
    $comment_query_result = mysqli_query($connection, $comment_query);
    echo "
        <table class='table table-bordered table-hover'><thead>
        <tr>
        <th>Id</th>
        <th>In response to</th>
        <th>Date</th>
        <th>Author</th>
        <th>Email</th>
        <th>Content</th>
        <th>Status</th>
        </tr>
        </thead>
        <tbody>
    ";
    while($row = mysqli_fetch_assoc($comment_query_result)){
        $comment_id = $row['comment_id'];
        $comment_post_id = $row['comment_post_id'];
        $comment_date = $row['comment_date'];
        $comment_author = $row['comment_author'];
        $comment_email = $row['comment_email'];
        $comment_content = substr($row['comment_content'], 0, 20) . "...";
        $comment_status = $row['comment_status'];
        $comment_post_query = "SELECT * FROM posts WHERE post_id=$comment_post_id";
        $comment_post_query_result = mysqli_query($connection, $comment_post_query);
        while($row = mysqli_fetch_assoc($comment_post_query_result)){
            $comment_post = $row['post_title'];
        }
        
        echo "
                <tr>
                <td>$comment_id</td>
                <td>$comment_post</td>
                <td>$comment_date</td>
                <td>$comment_author</td>
                <td>$comment_email</td>
                <td>$comment_content</td>
                <td>$comment_status</td>
                <td><a href='./admin_comments.php?approve={$comment_id}'>Approve</a></td>
                <td><a href='./admin_comments.php?unapprove={$comment_id}'>Unapprove</a></td>
                <td><a href='./admin_comments.php?delete={$comment_id}'>Delete</a></td>
                </tr>";
    }
    echo "</tbody></table>";
}

function updateComments(){
    global $connection;
            if(isset($_GET['approve'])){
                $approve_id = $_GET['approve'];
                $approve_query = "UPDATE comments SET comment_status = 'approved' WHERE ";
                $approve_query .= "comment_id=$approve_id";
                $aproving = mysqli_query($connection, $approve_query);
                header('Location: admin_comments.php'); 
            }
            else if(isset($_GET['unapprove'])){
                $unapprove_id = $_GET['unapprove'];
                $unapprove_query = "UPDATE comments SET comment_status = 'unapproved' WHERE ";
                $unapprove_query .= "comment_id=$unapprove_id";
                $unaproving = mysqli_query($connection, $unapprove_query);
                header('Location: admin_comments.php'); 
            }
            else if(isset($_GET['delete'])){
                $delete_id = $_GET['delete'];
                $getpostid_query = "SELECT * FROM comments WHERE comment_id=$delete_id";
                $getpostid = mysqli_query($connection, $getpostid_query);
                while($row = mysqli_fetch_assoc($getpostid)){
                    $postid = $row['comment_post_id'];
                }
                // decrement post com count where post id = comment_post_id;
                $delete_query = "DELETE FROM comments WHERE comment_id=$delete_id";
                $deleting = mysqli_query($connection, $delete_query);
                $comment_count_update_query = "UPDATE posts ";
                $comment_count_update_query .= "SET post_comment_count=post_comment_count-1 ";
                $comment_count_update_query .= "WHERE post_id = $postid";
                $comment_count_update = mysqli_query($connection, $comment_count_update_query);
                header('Location: admin_comments.php'); 
            }
}

function showUsers(){
    global $connection;
    $user_query = "SELECT * FROM users";
    $users = mysqli_query($connection, $user_query);
    echo "
        <table class='table table-bordered table-hover'><thead>
        <tr>
        <th>Id</th>
        <th>Username</th>
        <th>Password</th>
        <th>Email</th>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Role</th>
        <th>Image</th>
        </tr>
        </thead>
        <tbody>
    ";
    while($row = mysqli_fetch_assoc($users)){
        $user_id = $row['user_id'];
        $user_name = $row['user_name'];
        $user_password = $row['user_password'];
        $user_email = $row['user_email'];
        $user_firstname = $row['user_firstname'];
        $user_lastname = $row['user_lastname'];
        $user_role = $row['user_role'];
        $user_image = $row['user_image'];
        $user_randSalt = $row['user_randSalt'];
        echo "
                <tr>
                <td>$user_id</td>
                <td>$user_name</td>
                <td>$user_password</td>
                <td>$user_email</td>
                <td>$user_firstname</td>
                <td>$user_lastname</td>
                <td>$user_role</td>
                <td><img src=\"images/";
                echo $user_image;
                echo "\"></td>
                <td><a href='./edit_user.php?edituser={$user_id}'>Edit</a></td>
                <td><a href='./admin_users.php?deleteuser={$user_id}'>Delete</a></td>
                </tr>";
    }
    echo "</tbody></table>";
}

function deleteUser(){
    global $connection;
    if(isset($_GET['deleteuser'])){
        $del_user_id = $_GET['deleteuser'];
        $del_user_query = "DELETE FROM users WHERE user_id=$del_user_id";
        $del_user = mysqli_query($connection, $del_user_query);
        header("Location: admin_users.php");
    }
}
?>