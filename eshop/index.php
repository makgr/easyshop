
<?php 

require('backend/pages/connect.php');


require_once 'classes/class.Cart.php';

// Initialize cart object
$cart = new Cart([
  // Maximum item can added to cart, 0 = Unlimited
  'cartMaxItem' => 0,

  // Maximum quantity of a item can be added to cart, 0 = Unlimited
  'itemMaxQuantity' => 15,

  // Do not use cookie, cart items will gone after browser closed
  'useCookie' => false,
]);



?>
<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Shop Homepage - Start Bootstrap Template</title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/shop-homepage.css" rel="stylesheet">

    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">


  </head>

  <body>

    <!-- Navigation -->
    <?php include('navbar.php'); ?>

    <!-- Page Content -->
    <div class="container">

      <div class="row">

        <div class="col-lg-3">

          <h1 class="my-4">Shop Name</h1>
          <div class="list-group">
            <a href="#" class="list-group-item">Category 1</a>
            <a href="#" class="list-group-item">Category 2</a>
            <a href="#" class="list-group-item">Category 3</a>
          </div>

        </div>
        <!-- /.col-lg-3 -->

        <div class="col-lg-9">

          <div id="carouselExampleIndicators" class="carousel slide my-4" data-ride="carousel">
            <ol class="carousel-indicators">
              <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
              <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
              <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner" role="listbox">
              <div class="carousel-item active">
                <img class="d-block img-fluid" src="http://placehold.it/900x350" alt="First slide">
              </div>
              <div class="carousel-item">
                <img class="d-block img-fluid" src="http://placehold.it/900x350" alt="Second slide">
              </div>
              <div class="carousel-item">
                <img class="d-block img-fluid" src="http://placehold.it/900x350" alt="Third slide">
              </div>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="sr-only">Next</span>
            </a>
          </div>

          <div class="row">


            <?php

                                $sql = "SELECT products.*, categories.category_name FROM `products` INNER JOIN categories ON products.product_category = categories.catid ORDER BY products.product_name";



                                $res = mysqli_query($con, $sql);

                                $nums = mysqli_num_rows($res);




                                // $products = array();

                                //  while ($row = mysqli_fetch_assoc($res)) {
                                    
                                //            // print_r($row);

                                //             //echo "<br/>";


                                //           $products[] = $row;
                                //         }


                                // for ($i=5; $i < 10; $i++) { 
                                  
                                //   $products[$i] = $i."N";
                                // }


                                //echo $s =json_encode($products);
                                //$ss =json_decode($s);

                                //print_r($ss);

                                

                                if($nums >0)
                                {

                                   $i = 1;

                                        while ($row = mysqli_fetch_assoc($res)) {
                                    
                                           // print_r($row);

                                            //echo "<br/>";


                                          $products[] = $row;
                                           

                                    ?>

                                         <div class="col-lg-4 col-md-6 mb-4">
                                          <div class="card h-100">
                                            <a href="#"><img class="card-img-top" src="http://placehold.it/700x400" alt=""></a>
                                            <div class="card-body">
                                              <h4 class="card-title">
                                                <a href="#"><?php echo $row['product_name']; ?></a>
                                              </h4>
                                              <h5>$24.99</h5>
                                              <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet numquam aspernatur!</p>
                                            </div>
                                            <div class="card-footer">
                                              <small class="text-muted">&#9733; &#9733; &#9733; &#9733; &#9734;</small>
                                            </div>


                                            <form>
                                              <input type="hidden" value="<?php echo $row['product_id']; ?>" class="product-id" />

                                        


                                                <div class="form-group">
                                                  <label>Quantity:</label>
                                                  <input type="number" value="1" class="form-control quantity" />
                                                </div>
                                                <div class="form-group">
                                                  <button class="btn btn-danger add-to-cart"><i class="fa fa-shopping-cart"></i> Add to Cart</button>
                                                </div>
                                              </form>
                                          </div>
                                        </div>

                                    <?php
                                  }

                                }
                                else
                                {
                                    echo "No record found";
                                }
                                ?>

           

          </div>
          <!-- /.row -->

        </div>
        <!-- /.col-lg-9 -->

      </div>
      <!-- /.row -->

    </div>
    <!-- /.container -->

    <!-- Footer -->
   
     <?php include('footer.php'); ?>

    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>



    <script>
      $(document).ready(function(){
        $('.add-to-cart').on('click', function(e){
          e.preventDefault();

          var $btn = $(this);
          var id = $btn.parent().parent().find('.product-id').val();
          //var color = $btn.parent().parent().find('.color').val() || '';
          var qty = $btn.parent().parent().find('.quantity').val();



          var $form = $('<form action="cart_action.php?a=cart" method="post" />').html('<input type="hidden" name="add" value=""><input type="hidden" name="id" value="' + id + '"><input type="hidden" name="qty" value="' + qty + '">');

          $('body').append($form);
          $form.submit();
        });

        $('.btn-update').on('click', function(){
          var $btn = $(this);
          var id = $btn.attr('data-id');
          var qty = $btn.parent().parent().find('.quantity').val();
          //var color = $btn.attr('data-color');

          //add_to_cart(id, qty)

          var $form = $('<form action="cart_action.php?a=cart" method="post" />').html('<input type="hidden" name="update" value=""><input type="hidden" name="id" value="'+id+'"><input type="hidden" name="qty" value="'+qty+'">');

          $('body').append($form);
          $form.submit();
        });

        $('.btn-remove').on('click', function(){
          var $btn = $(this);
          var id = $btn.attr('data-id');
          //var color = $btn.attr('data-color');

          var $form = $('<form action="cart_action.php?a=cart" method="post" />').html('<input type="hidden" name="remove" value=""><input type="hidden" name="id" value="'+id+'">');

          $('body').append($form);
          $form.submit();
        });

        $('.btn-empty-cart').on('click', function(){
          var $form = $('<form action="cart_action.php?a=cart" method="post" />').html('<input type="hidden" name="empty" value="">');

          $('body').append($form);
          $form.submit();
        });
      });
    </script>

  </body>

</html>
