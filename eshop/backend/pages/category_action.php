<?php 

require('connect.php');

    if($_SERVER['REQUEST_METHOD']=="POST")
    {

       //$_POST['email'];
       //$_GET['email'];

       $category_name =  mysqli_real_escape_string($con,$_REQUEST['category_name']);

       $catid =  mysqli_real_escape_string($con,$_REQUEST['catid']);

       if($catid >0)
       {
          // Update query here

         $sql = "UPDATE `categories` SET `category_name`='$category_name' WHERE catid = '$catid'";
       }
       else
       {
        // Insert query here

        $sql = "INSERT INTO `categories`(`catid`, `category_name`) VALUES (NULL,'$category_name')";
       }
       

       $res = mysqli_query($con, $sql);


       if(!$res)
       {
          //echo "Not inserted ".mysqli_error($res);
          header('location:category_add.php');
       }
       else
       {
         //echo "Inserted ";

          header('location:category_list.php');
       }


    }

 ?>