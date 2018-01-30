<?php 

require('connect.php');

 $catid =  $_REQUEST['catid'];


    
      $sql =  "DELETE FROM categories WHERE catid = '$catid'";
       

       $res = mysqli_query($con, $sql);


       if(!$res)
       {
          //echo "Not inserted ".mysqli_error($res);
          //header('location:category_add.php');
          echo 0;
       }
       else
       {
        echo 1;
         //echo "Inserted ";

          //header('location:category_list.php');
       }



 ?>