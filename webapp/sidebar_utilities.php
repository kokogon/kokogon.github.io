<?php 
session_start();
if(isset($_POST['Logout'])){
    session_destroy();
    header("Location:index.php");
}
?>
