<?php 
    include "connect.php";
    session_start();
?>

<?php
    $username = $_POST['username'];
    $password = $_POST['password'];
    $username = mysqli_real_escape_string($connection, $username);
    $password = mysqli_real_escape_string($connection, $password);
    $select_user_query = "SELECT * FROM users WHERE user_name='{$username}'";
    $user = mysqli_query($connection, $select_user_query);
        while($row = mysqli_fetch_assoc($user)){
            $user_id = $row['user_id'];
            $user_firstname = $row['user_firstname'];
            $user_lastname = $row['user_lastname'];
            $user_password = $row['user_password'];
            $user_role = $row['user_role'];
        }
    if($password == $user_password){
        //login
        $_SESSION['username'] = $username;
        $_SESSION['firstname'] = $user_firstname;
        $_SESSION['lastname'] = $user_lastname;
        $_SESSION['role'] = $user_role;
        header("Location:../admin/index.php");
    }
    else{
        header("Location:../index.php");
    }
?>