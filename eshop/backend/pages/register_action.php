<?php 
 require 'connect.php';

if($_SERVER['REQUEST_METHOD'] == "POST")
{
   // $_POST['email'];
   // $_POST['email'];
   $email = $_REQUEST['email'];
   $password = $_REQUEST['password'];
   $first_name = $_REQUEST['first_name'];
   $last_name = $_REQUEST['last_name'];
   $country = $_REQUEST['country'];

   $role_id = 1;
   $active = 1;



   $sql = "INSERT INTO `users`( `email`, `Password`, `first_name`, `last_name`, `country`, `role_id`, `active`, `created_at`) VALUES ('$email','$password','$first_name','$last_name','$country','$role_id','$active',now())";

   $res = mysqli_query($con,$sql);

   if(!$res){
      echo 'Not inserted'.mysqli_error($res);
   }else{
   	echo 'Inserted';
   }

}

?>