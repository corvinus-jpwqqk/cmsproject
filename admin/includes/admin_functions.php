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
?>