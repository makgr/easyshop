<?php 
 require 'connect.php';

if($_SERVER['REQUEST_METHOD'] == "POST")
{
   // $_POST['email'];
   // $_POST['email'];
   $email =  mysqli_real_escape_string($con,$_REQUEST['email']);
   $password =  md5($_REQUEST['password']);
   $first_name =  mysqli_real_escape_string($con,$_REQUEST['first_name']);
   $last_name =  mysqli_real_escape_string($con,$_REQUEST['last_name']);
   $country =  mysqli_real_escape_string($con,$_REQUEST['country']);

   $role_id = 1;
   $active = 1;



   $sql = "INSERT INTO `users`( `email`, `Password`, `first_name`, `last_name`, `country`, `role_id`, `active`, `created_at`) VALUES ('$email','$password','$first_name','$last_name','$country','$role_id','$active',now())";

   $res = mysqli_query($con,$sql);

   if(!$res){
      //echo 'Not inserted'.mysqli_error($res);
   	header("registration.php");
   }else{
   	//echo 'Inserted';
   	header("login.php");
   }

}

?>