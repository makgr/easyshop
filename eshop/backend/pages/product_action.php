<?php 

require('connect.php');

    if($_SERVER['REQUEST_METHOD']=="POST")
    {

       //$_POST['email'];
      //$_GET['email'];

        $product_category =  mysqli_real_escape_string($con,$_REQUEST['product_category']);

        $product_name =  mysqli_real_escape_string($con,$_REQUEST['product_name']);
        $product_price =  mysqli_real_escape_string($con,$_REQUEST['product_price']);
        $product_details =  mysqli_real_escape_string($con,$_REQUEST['product_details']);
        $product_stock_in =  mysqli_real_escape_string($con,$_REQUEST['product_stock_in']);
        $product_status =  mysqli_real_escape_string($con,$_REQUEST['product_status']);

        $product_id = $_REQUEST['product_id']; 



        $product_image = "";
       
        $target_dir = "../../uploads/";
        $target_file = $target_dir . basename($_FILES["product_image"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        // Check if image file is a actual image or fake image
        if(isset($_POST["submit"])) {

          if (file_exists($_FILES["product_image"]["tmp_name"])) {
               $check = getimagesize($_FILES["product_image"]["tmp_name"]);
              if($check !== false) {
                  echo "File is an image - " . $check["mime"] . ".";
                  $uploadOk = 1;
              } else {
                  echo "File is not an image.";
                  $uploadOk = 0;
              }
          }
           
        }
        // Check if file already exists
        if (file_exists($target_file)) {
            echo "Sorry, file already exists.";
            $uploadOk = 0;
        }
        // Check file size
        if ($_FILES["product_image"]["size"] > 500000) {
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }
        // Allow certain file formats
        // if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        // && $imageFileType != "gif" ) {
        //     echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        //     $uploadOk = 0;
        // }

        $allow_ext =  array('jpg', 'jpeg', 'png', 'gif');

        if(!in_array($imageFileType, $allow_ext))
        {
          echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
          $uploadOk = 0;
        }

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
        // if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($_FILES["product_image"]["tmp_name"], $target_file)) {
                echo "The file ". basename( $_FILES["product_image"]["name"]). " has been uploaded.";
                $product_image = "uploads/".basename($_FILES["product_image"]["name"]);
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
       

       // $catid =  mysqli_real_escape_string($con,$_REQUEST['catid']);

       if($product_id >0)
       {
          // Update query here

        if($product_image !="")
        {
          $sql = "UPDATE `products` SET `product_name`='$product_name',`product_price`='$product_price',`product_image`='$product_image',`product_details`='$product_details',`product_category`='$product_category',`product_stock_in`='$product_stock_in',`product_status`='$product_status' WHERE product_id = '$product_id'";
        }
        else
        {
          $sql = "UPDATE `products` SET `product_name`='$product_name',`product_price`='$product_price',`product_details`='$product_details',`product_category`='$product_category',`product_stock_in`='$product_stock_in',`product_status`='$product_status' WHERE product_id = '$product_id'";
        }

         
       }
       else
       {
        // Insert query here

       

        $sql = " INSERT INTO `products`(`product_id`, `product_name`, `product_price`, `product_image`, `product_details`, `product_category`, `product_stock_in`, `product_status`) VALUES (NULL,'$product_name','$product_price','$product_image','$product_details','$product_category','$product_stock_in','$product_status')";
       }



       echo $product_image;
       

       $res = mysqli_query($con, $sql);


       if(!$res)
       {
          echo "Not inserted ".mysqli_error($res);
          //header('location:product_add.php');
       }
       else
       {
         echo "Inserted ";

          //header('location:product_list.php');
       }


    }

 ?>