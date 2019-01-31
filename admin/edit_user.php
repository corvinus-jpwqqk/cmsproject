<?php
    include "includes/admin_header.php";
    include "includes/admin_functions.php";
?>
<?php
if(isset($_GET['edituser'])){
    global $connection;
    $edit_id = $_GET['edituser'];
    $select_users_query = "SELECT * FROM users;";
    $select_query_result = mysqli_query($connection, $select_users_query);
    while($row = mysqli_fetch_assoc($select_query_result)){
        $user_name = $row['user_name'];
        $user_password = $row['user_password'];
        $user_firstname = $row['user_firstname'];
        $user_lastname = $row['user_lastname'];
        $user_role = $row['user_role'];
        $user_image = $row['user_image'];
    }
    
}
if(isset($_POST['update_user'])){
    $user_name = $_POST['user_name'];
    $user_password = $_POST['user_password'];
    $user_firstname = $_POST['user_firstname'];
    $user_lastname = $_POST['user_lastname'];
    $user_role =  $_POST['user_role'];
    $user_image = $_FILES['user_image']['name'];
    $user_image_temp = $_FILES['user_image']['tmp_name'];
    move_uploaded_file($user_image_temp, "../images/$user_image");
    if(empty($user_image)){
        $image_query = "SELECT * FROM users WHERE user_id=$edit_id";
        $im_query_result = mysqli_query($connection, $image_query);
        while($row = mysqli_fetch_assoc($im_query_result)){
            $user_image = $row['user_image'];
        }
    }
    $update_user_query = "UPDATE users SET ";
    $update_user_query .= "user_name = '{$user_name}', ";
    $update_user_query .= "user_password = '{$user_password}', ";
    $update_user_query .= "user_firstname = '{$user_firstname}', ";
    $update_user_query .= "user_lastname = '{$user_lastname}', ";
    $update_user_query .= "user_role = '{$user_role}' ";
    $update_user_query .= "user_image = '{$user_image}' ";
    $update_user_query .= "WHERE user_id = {$edit_id}";
    $update_user_result = mysqli_query($connection, $update_user_query);
    header("Location: admin_users.php");
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
                            Edit User
                        </h1>
<form action="" method="post" enctype="multipart/form-data">
<div class="form-group">
    <label for="user_name">UserName</label>
    <input type="text" class="form-control" name="user_name" value="<?php echo $user_name; ?>">
</div>
<div class="form-group">
    <label for="user_password">User Password</label>
    <input type="password" class="form-control" name="user_password" value="<?php echo $user_password; ?>">
</div>
<div class="form-group">
    <label for="user_firstname">First Name</label>
    <input type="text" class="form-control" name="user_firstname" value="<?php echo $user_firstname; ?>">
</div>
<div class="form-group">
    <label for="user_lastname">Last Name</label>
    <input type="text" class="form-control" name="user_lastname" value="<?php echo $user_lastname; ?>">
</div>
<div class="form-group">
    <label for="user_image">Image</label>
    <img width="100px" src="../images/<?php echo $user_image ?>">
    <input type="file" name="user_image">
</div>
<div class="form-group">
    <label for="user_role">Role</label>
    <input type="text" class="form-control" name="user_role" value="<?php echo $user_role; ?>">
</div>
<div class="form-group">
    <input type="submit" class="btn btn-primary" name="update_user" value="Update">
</div>
</form>
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


