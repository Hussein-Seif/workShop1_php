<?php
session_start();

require_once("inc/db-conection.php");
// check if submit button is checked and send data from from
if (isset($_POST['submit'])) {
    // fetch data from from inputs
    $email=$_POST['email'];
    $password=$_POST['password'];
 
    //query to get email from database
    $query="select * from users where email='$email'";
    //query fire
    $run_query=mysqli_query($conn, $query);
    //check if email is valid 
    if(mysqli_num_rows($run_query)>0){
    $user= mysqli_fetch_assoc($run_query);
     $isCorrect=password_verify($password,$user['password']);
    // if the password is correct 
    if ($isCorrect) {
        $_SESSION['email']=$email;
        header("Location:index.php");
    }
    // if the password is not correct 
    else{
        $_SESSION['errors'][]="password is incorrect";
        Print_r($_SESSION['errors']);
        header("Location:login.php");
    }
    
    }
    // if email is not correct
    else{
    $_SESSION['errors'][]="Email not found";
    Print_r($_SESSION['errors']);
    header("Location:login.php");

    }


}