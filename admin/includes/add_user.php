<?php
if(isset($_POST['create_user'])){
    global $connection;
    $user_name = $_POST['user_name'];
    $user_password = $_POST['user_password'];
    $user_email = $_POST['user_email'];
    $user_firstname = $_POST['user_firstname'];
    $user_lastname = $_POST['user_lastname'];
    $user_role = $_POST['user_role'];    
    $user_image = $_FILES['post_image']['name'];
    $user_image_temp = $_FILES['post_image']['tmp_name'];
    move_uploaded_file($user_image_temp, "../images/$user_image");
    $new_user_query = "INSERT INTO users (user_name, user_password, user_email, user_firstname, ";
    $new_user_query .= "user_lastname, user_role, user_image) VALUES ('{$user_name}', ";
    $new_user_query .= "'{$user_password}', '{$user_email}', '{$user_firstname}', ";
    $new_user_query .= "'{$user_lastname}', '{$user_role}', '{$user_image}')";
    $insert_user = mysqli_query($connection, $new_user_query);
    header("Location: admin_users.php");
}
?>

<form action="" method="post" enctype="multipart/form-data">
<div class="form-group">
    <label for="user_name">Username</label>
    <input type="text" class="form-control" name="user_name">
</div>

    
<div class="form-group">
    <label for="user_password">Password</label>
    <input type="password" class="form-control" name="user_password">
</div>
<div class="form-group">
    <label for="user_email">Email</label>
    <input type="text" class="form-control" name="user_email">
</div>
<div class="form-group">
    <label for="user_image">Image</label>
    <input type="file" name="user_image">
</div>
<div class="form-group">
    <label for="user_firstname">First name</label>
    <input type="text" class="form-control" name="user_firstname">
</div>
<div class="form-group">
    <label for="user_lastname">Last name</label>
    <input type="text" class="form-control" name="user_lastname">
</div>
<div class="form-group">
    <label for="user_role">Role</label>
    <input type="text" class="form-control" name="user_role">
</div>
<div class="form-group">
    <input type="submit" class="btn btn-primary" name="create_user" value="Create">
</div>
</form>