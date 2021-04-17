<?php


require_once("inc/header.php");

$query='SELECT * FROM projects';
//query fire  
$run_query=mysqli_query($conn,$query);
// fetch data in array format 
$projects=mysqli_fetch_all($run_query,MYSQLI_ASSOC);
?>


<?php 
// Display the login btn if is user stored
if (!isset($_SESSION['email'])){?>
<a href="login.php" class="btn btn-primary m-3">Login</a>
<?php  }?>
<?php
// Display the login btn if is user not stored
if (isset($_SESSION['email'])){?>
<a href="logout.php" class="btn btn-danger m-3">Logout</a>
<?php  }?>

<?php if (isset($_SESSION['email'])){?>
    <a href="addProject.php" class="btn btn-success"> Add project</a>
<?php  }?>

<div class="contanier">
<div class="row">
<?php foreach($projects as $project) {?>
<div class="col-md-4">

<img class="img-fluid" src="images/<?php echo $project["img"] ?>" alt="">
<h1> <?php echo $project['name'] ?> </h1>
<a href="showproject.php?id= <?= $project['id']?>" class ="btn btn-primary"> View Detalis</a>
<?php if (isset( $_SESSION['email'])) {?>
<a href="edit.php?id=<?php echo $project['id']?>" class ="btn btn-success"> Edit</a>
<a href="delete.php?id=<?= $project['id']?>" class ="btn btn-danger"> Delete</a>
<?php }?>
</div>
<?php }?>


</div>


</div>