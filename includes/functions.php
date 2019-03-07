<?php
include "connect.php";
function escape($string){
    global $connection;
    return mysqli_read_escape_string($connection, trim($string));
}
?>