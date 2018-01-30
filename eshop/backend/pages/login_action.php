<?php 
session_start();

require('connect.php');

    if($_SERVER['REQUEST_METHOD']=="POST")
    {

       //$_POST['email'];
       //$_GET['email'];

       $email =  mysqli_real_escape_string($con,$_REQUEST['email']);
       
       $password =  md5($_REQUEST['password']);
       
       $sql = "SELECT * FROM `users` WHERE email='$email' AND active = 1";

       $res = mysqli_query($con, $sql);

       $row = mysqli_fetch_assoc($res);


       $userid = $row['userid'];
       $password_db = $row['password'];
       $role_id = $row['role_id'];

       if(!$res)
       {
          //echo "Not inserted ".mysqli_error($res);
          header('location:login.php');
       }
       else
       {
         //echo "Inserted ";

          if( $password_db == $password)
          {
              if($role_id==1)
              {
                  //Create session keys & redirect to admin

                $_SESSION['userid'] = $userid;
                $_SESSION['user_type'] = 'Admin';

                header('location:index.php');
              }
              elseif($role_id==2)
              {
                //Create session keys & redirect to visitor 
                $_SESSION['userid'] = $userid;
                $_SESSION['user_type'] = 'Visitor';

                header('location:../../index.php');
              }
              else
              {
                // send back to home page
                 header('location:../../index.php');
              }
          }

          else
          {
            //echo "Not Ok";
             header('location:login.php');
          }

          //header('location:login.php');
       }


    }

 ?>