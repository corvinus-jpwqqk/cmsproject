<?php
if(isset($_GET['edit'])){
    global $connection;
    $edit_id = $_GET['edit'];
    $select_post_query = "SELECT * FROM posts WHERE post_id={$edit_id}";
    $select_query_result = mysqli_query($connection, $select_post_query);
    while($row = mysqli_fetch_assoc($select_query_result)){
        $post_author = $row['post_author'];
        $post_image = $row['post_image'];
        $post_tags = $row['post_tags'];
        $post_content = $row['post_content'];
        $post_title = $row['post_title'];
        $post_category = $row['post_category_id'];
        $post_status = $row['post_status'];
    }
}
if(isset($_POST['update_post'])){
    $post_title = $_POST['post_title'];
    $post_author = $_POST['post_author'];
    $post_status = $_POST['post_status'];
    $post_image = $_FILES['post_image']['name'];
    $post_image_temp = $_FILES['post_image']['tmp_name'];
    $post_tags = $_POST['post_tags'];
    $post_category_id = $_POST['post_category'];
    $post_content = $_POST['post_content'];
    move_uploaded_file($post_image_temp, "../images/$post_image");
    if(empty($post_image)){
        $image_query = "SELECT * FROM posts WHERE post_id={$edit_id}";
        $im_query_result = mysqli_query($connection, $image_query);
        while($row = mysqli_fetch_assoc($im_query_result)){
            $post_image = $row['post_image'];
        }
    }
    $update_post_query = "UPDATE posts SET ";
    $update_post_query .= "post_title = '{$post_title}', ";
    $update_post_query .= "post_category_id = '{$post_category_id}', ";
    $update_post_query .= "post_date = now(), ";
    $update_post_query .= "post_author = '{$post_author}', ";
    $update_post_query .= "post_status = '{$post_status}', ";
    $update_post_query .= "post_tags = '{$post_tags}', ";
    $update_post_query .= "post_content = '{$post_content}', ";
    $update_post_query .= "post_image = '{$post_image}' ";
    $update_post_query .= "WHERE post_id = {$edit_id}";
    $update_post_result = mysqli_query($connection, $update_post_query);
    confirmQuery($update_post_result);
}
?>

<form action="" method="post" enctype="multipart/form-data">
<div class="form-group">
    <label for="title">Post Title</label>
    <input type="text" class="form-control" name="post_title" value="<?php echo $post_title; ?>">
</div>
<div class="form-group">
    <label for="post_category">Post Category</label>
    <br>
    <select name="post_category" id="post_category">
        <?php
            $cat_query = "SELECT * FROM categories";
            $cat_query_result = mysqli_query($connection, $cat_query);
            while($row = mysqli_fetch_assoc($cat_query_result)){
                $cat_id = $row['cat_id'];
                $cat_name = $row['cat_title'];
                if($cat_id == $post_category){
                    echo "<option selected=\"selected\" value='{$cat_id}''>{$cat_name}</option>";
                }
                else{
                    echo "<option value='{$cat_id}''>{$cat_name}</option>";
                }
            }
        ?>
    </select>
    
<div class="form-group">
    <label for="post_author">Post Author</label>
    <input type="text" class="form-control" name="post_author" value="<?php echo $post_author; ?>">
</div>
<div class="form-group">
    <label for="post_status">Post Status</label>
    <input type="text" class="form-control" name="post_status" value="<?php echo $post_status; ?>">
</div>
<div class="form-group">
    <label for="post_image">Post Image</label>
    <img width="100px" src="../images/<?php echo $post_image ?>">
    <input type="file" name="post_image">
</div>
<div class="form-group">
    <label for="post_tags">Post Tags</label>
    <input type="text" class="form-control" name="post_tags" value="<?php echo $post_tags; ?>">
</div>
<div class="form-group">
    <label for="post_content">Post Content</label>
    <textarea type="text" class="form-control" name="post_content" id="" cols="30" rows="10" ><?php echo $post_content; ?></textarea>
</div>
<div class="form-group">
    <input type="submit" class="btn btn-primary" name="update_post" value="Edit">
</div>
</form>