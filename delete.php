<?php 
require_once("inc/db-conection.php");

if (isset($_GET['id']) ){
    $id=$_GET['id'];
    $query="delete from projects where id=$id";
    $run_query=mysqli_query($conn,$query);
    header("location:index.php");
}