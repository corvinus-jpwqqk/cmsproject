<?php
if(isset($_POST['create_post'])){  
    $post_title = $_POST['post_title'];
    $post_author = $_POST['post_author'];
    $post_status = $_POST['post_status'];
    $post_image = $_FILES['post_image']['name'];
    $post_image_temp = $_FILES['post_image']['tmp_name'];
    $post_tags = $_POST['post_tags'];
    $post_category_id = $_POST['post_category_id'];
    $post_content = $_POST['post_content'];
    $post_date = date('y-m-d');
    $post_comment_count = 2;
    move_uploaded_file($post_image_temp, "../images/$post_image");
    $new_post_query = "INSERT INTO posts(post_category_id, post_title, post_author, ";
    $new_post_query .= "post_date, post_image, post_content, post_tags, post_comment_count, post_status) ";
    $new_post_query .= "VALUES('{$post_category_id}', '{$post_title}', '{$post_author}', '{$post_date}', ";
    $new_post_query .= "'{$post_image}', '{$post_content}', '{$post_tags}', ";
    $new_post_query .= "'{$post_comment_count}', '{$post_status}')";
    $result = mysqli_query($connection, $new_post_query);
    
}
?>

<form action="" method="post" enctype="multipart/form-data">
<div class="form-group">
    <label for="title">Post Title</label>
    <input type="text" class="form-control" name="post_title">
</div>
<div class="form-group">
    <label for="post_category_id">Post Category</label>
    <br>
    <select name="post_category_id" id="post_category_id">
        <?php
            $cat_query = "SELECT * FROM categories";
            $cat_query_result = mysqli_query($connection, $cat_query);
            while($row = mysqli_fetch_assoc($cat_query_result)){
                $cat_id = $row['cat_id'];
                $cat_name = $row['cat_title'];
                echo "<option value='{$cat_id}''>{$cat_name}</option>";
            }
        ?>
    </select>
<div class="form-group">
    <label for="post_author">Post Author</label>
    <input type="text" class="form-control" name="post_author">
</div>
<div class="form-group">
    <label for="post_status">Post Status</label>
    <input type="text" class="form-control" name="post_status">
</div>
<div class="form-group">
    <label for="post_image">Post Image</label>
    <input type="file" name="post_image">
</div>
<div class="form-group">
    <label for="post_tags">Post Tags</label>
    <input type="text" class="form-control" name="post_tags">
</div>
<div class="form-group">
    <label for="post_content">Post Content</label>
    <textarea type="text" class="form-control" name="post_content" id="" cols="30" rows="10"></textarea>
</div>
<div class="form-group">
    <input type="submit" class="btn btn-primary" name="create_post" value="Publish">
</div>
</form>