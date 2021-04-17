<?php
require_once("inc/header.php");

if (isset($_POST['submit']) && isset($_GET['id'])) {
    $id=$_GET['id'];
   
     // fetch data from from inputs
     $name=htmlspecialchars(trim( $_POST['name']));
     $desc=htmlspecialchars(trim( $_POST['desc']));
     $file=$_FILES['file'];
     $url=htmlspecialchars(trim( $_POST['url']));
     $repo=htmlspecialchars(trim( $_POST['repo']));
 
     // fetch file info
     $query="select img from projects where id=$id  ";
     $run_query=mysqli_query($conn,$query);
     $img=mysqli_fetch_assoc($run_query);
   
     $oldImgName=$img['img'];
     
     
     
     
     $fileName=$file['name'];
     $fileTempName=$file['tmp_name'];
     
     $fileError=$file['error'];
 
       
        // make new file name 
        $ext=pathinfo($fileName,PATHINFO_EXTENSION);
        
        $fileNewName=uniqid().".".$ext;
     // validation  start of inputs
     $errors=[];
     //validation  of name
     if(empty($name)){
         $errors[]="Name is Required";
     }elseif(strlen($name)<5 || strlen($name)>255){
         $errors[]="length must be [5-155]";
     }elseif(!is_string($name) || is_numeric($name)){
         $errors[]="Name must be a string";
     }
     //validation  of desc
     if(empty($desc)){
         $errors[]="Name is Required";
     }elseif(strlen($desc)<5 || strlen($desc)>1000){
         $errors[]="length must be [5-155]";
     }
     
     //validation  of url
 
     if(! filter_var($url, FILTER_VALIDATE_URL)){
         $errors[]="Websit url not valid";
     }
      //validation  of repo
 
      if(! filter_var($repo, FILTER_VALIDATE_URL)){
         $errors[]="Websit url not valid";
     }
     // validation  end of inputs
 
}
//    if all is good start inserting to DB
   if (empty($errors)) {
       if (empty($fileName)) {
         
           $query="update projects set  name='$name', description='$desc' , img= '$oldImgName', url='$url',repo='$repo' WHERE id=$id ";
           $run_query=mysqli_query($conn, $query);
        
           header('location:index.php');
       }else{
        $query="update projects set  name='$name', description='$desc' , img= '$fileNewName', url='$url',repo='$repo' WHERE id=$id ";
        $run_query=mysqli_query($conn, $query);
        move_uploaded_file($fileTempName,"images/$fileNewName");
        header('location:index.php');
       }

}

?>