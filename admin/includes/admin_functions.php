<?php
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
            if($instert_query_result){
                echo "Insertion successful!";
            }
            else{
                die("problem with insertion!");
            }
        }
        
    }
}

function showPosts(){
    global $connection;
    $post_query = "SELECT * FROM posts";
    $result_post_query = mysqli_query($connection, $post_query);
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
        echo"
        <tr>
                                <td>$post_id</td>
                                <td>$post_author</td>
                                <td>$post_title</td>
                                <td>$post_category</td>
                                <td>$post_status</td>
                                <td><img width='100' src='../images/$post_image'></td>
                                <td>$post_tags</td>
                                <td>$post_comment</td>
                                <td>$post_date</td>
                            </tr>   ";
    }
}
?>