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

$sql = "SELECT products.*, categories.category_name FROM `products` INNER JOIN categories ON products.product_category = categories.catid ORDER BY products.product_name";



    $res = mysqli_query($con, $sql);

    $nums = mysqli_num_rows($res);




    $products = array();

     while ($row = mysqli_fetch_assoc($res)) {
        
               // print_r($row);

                //echo "<br/>";


              $products[] = $row;
            }


    // for ($i=5; $i < 10; $i++) { 
      
    //   $products[$i] = $i."N";
    // }


     $s =json_encode($products);
    $products =json_decode($s);

                                //print_r($ss);
// A collection of sample products




// Shopping Cart Page

	$cartContents = '
	<div class="alert alert-warning">
		<i class="fa fa-info-circle"></i> There are no items in the cart.
	</div>';

	// Empty the cart
	if (isset($_POST['empty'])) {
		$cart->clear();
	}

	// Add item
	if (isset($_POST['add'])) {
		foreach ($products as $product) {
			if ($_POST['id'] == $product->product_id) {
				break;
			}
		}

		$cart->add($product->product_id, $_POST['qty'], [
			'price' => $product->product_price,
			//'color' => (isset($_POST['color'])) ? $_POST['color'] : '',
		]);
	}

	// Update item
	if (isset($_POST['update'])) {
		foreach ($products as $product) {
			if ($_POST['id'] == $product->product_id) {
				break;
			}
		}

		$cart->update($product->product_id, $_POST['qty'], [
			'price' => $product->product_price,
			//'color' => (isset($_POST['color'])) ? $_POST['color'] : '',
		]);
	}

	// Remove item
	if (isset($_POST['remove'])) {
		foreach ($products as $product) {
			if ($_POST['id'] == $product->product_id) {
				break;
			}
		}

		$cart->remove($product->product_id, [
			'price' => $product->product_price,
			//'color' => (isset($_POST['color'])) ? $_POST['color'] : '',
		]);
	}

	if (!$cart->isEmpty()) {
		$allItems = $cart->getItems();

		$cartContents = '
		<table class="table table-striped table-hover">
			<thead>
				<tr>
					<th class="col-md-7">Product</th>
					<th class="col-md-3 text-center">Quantity</th>
					<th class="col-md-2 text-right">Price</th>
				</tr>
			</thead>
			<tbody>';

		foreach ($allItems as $id => $items) {
			foreach ($items as $item) {
				foreach ($products as $product) {
					if ($id == $product->product_id) {
						break;
					}
				}

				$cartContents .= '
				<tr>
					<td>'.$product->product_name.'</td>
					<td class="text-center"><div class="form-group"><input type="number" value="'.$item['quantity'].'" class="form-control quantity pull-left" style="width:100px"><div class="pull-right"><button class="btn btn-default btn-update" data-id="'.$id.'" data-color=""><i class="fa fa-refresh"></i> Update</button><button class="btn btn-danger btn-remove" data-id="'.$id.'" data-color=""><i class="fa fa-trash"></i></button></div></div></td>
					<td class="text-right">$'.$item['attributes']['price'].'</td>
				</tr>';
			}
		}

		$cartContents .= '
			</tbody>
		</table>

		<div class="text-right">
			<h3>Total:<br />$'.number_format($cart->getAttributeTotal('price'), 2, '.', ',').'</h3>
		</div>

		<p>
			<div class="pull-left">
				<button class="btn btn-danger btn-empty-cart">Empty Cart</button>
			</div>
			<div class="pull-right text-right">
				<a href="?a=home" class="btn btn-default">Continue Shopping</a>
				<a href="#" class="btn btn-danger">Checkout</a>
			</div>
		</p>';
	}

?>


<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<meta name="description" content="">
		<meta name="author" content="">

		<title>Cart - A Simple PHP Cart Library by Sei Kan</title>

		<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
		<link href="https://maxcdn.bootstrapcdn.com/bootswatch/3.3.7/cosmo/bootstrap.min.css" rel="stylesheet">
		<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">

		<style>
			body{margin-top:50px;margin-bottom:200px}
		</style>
	</head>

	<body>
		<div class="navbar navbar-default navbar-fixed-top">
			<div class="container">
				<div class="navbar-header">
					<a href="?a=shop" class="navbar-brand">Sample Shop</a>
					<button class="navbar-toggle" type="button" data-toggle="collapse" data-target="#navbar-main">
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
				</div>

				<div class="navbar-collapse collapse" id="navbar-main">
					<ul class="nav navbar-nav">
						<li><a href="?a=cart" id="li-cart"><i class="fa fa-shopping-cart"></i> Cart (<?php echo $cart->getTotalItem(); ?>)</a></li>
					</ul>
				</div>
			</div>
		</div>

		
		<div class="container">
			<h1>Shopping Cart</h1>

			<div class="row">
				<div class="col-md-12">
					 <div class="table-responsive">
						<?php echo $cartContents; ?>
					 </div>
				</div>
			</div>
		</div>
		
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

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