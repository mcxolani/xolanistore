<?php
session_start();

//require 'db_con.php';
	include 'cart.class.php';

include 'includes/header.php';
		if(loggedin()&&getuserfield('admin')){
		header("Location: manage.php");
		die();
	}
?>
    <!-- Main jumbotron for a primary marketing message or call to action -->
<div class="container">

		<h4>Shopping Cart</h4><hr>

</div>



    <div class="container">
    
      <div class="row">
	  
	  <section class="col-lg-2 ">
   <table class="">
   <th>Categories<hr></th>
				<tr><td><a href="products.php#cat1" >Pianos<hr id="error"></a></td></tr>
				<tr><td ><a href="products.php#cat2" >Guitors<hr></a></td></tr>
				<tr><td ><a href="products.php#cat3" >Speakers<hr></a></td></tr>
				<tr><td ><a href="products.php#cat4" >Microphones<hr></a></td></tr>
				<tr><td ><a href="products.php#cat5" >Stands<hr></a></td></tr>
   
   </table>  
   </section>
   
    <section class="col-lg-8 pull-right">
	  <?php if($_SESSION['cart']>0){?>
	  <table class="table table-striped ">
	  <th>Name</th>
	  <th>Quantity</th>
	  <th>Price</th>
	  <th>SubTotal</th>
	
      	<?php
		
foreach($_SESSION['cart'] as $cart_id => $value){
				if($value > 0){
					$id = $cart_id;
					$get = mysql_query('select id, name, unit_price FROM product WHERE id='.clear_string((int)$id).'');
					while($row = mysql_fetch_assoc($get)){
					$sub = $row['unit_price']*$value;?>

					<tr>
	  <td><a href="product.php?prodid=<?php echo $id;?>"><?php echo $row['name']; ?></a></td>
	  <td><a href="cart.class.php?remove=<?php echo $id;?>"><span class="badge success" id="error"> - </a></span >
				<?php echo $value; ?>
						<a href="cart.class.php?add_to_cart=<?php echo $id;?>"><span class="badge success" id="error"> + </a></span >
						</td>
	  <td><?php echo 'R'.number_format($row['unit_price'],2); ?></td>
	  <td><?php echo 'R'.number_format($sub,2); ?> 
	  <a href="cart.class.php?delete=<?php echo $id;?>"><span class="badge badge-success" id="error"> DELETE </a></span ></td>
	  </tr>
	  
	
	  <?php
					}
				}
				$total += $sub;
				 
			}
			}
				echo '</table>';
				if($total==0){
					$_SESSION['total'] =0;
					echo "<h3>your cart is empty</h3>";
					
				}else{
					echo "<p>Total: R".$_SESSION['total']=$total."<br></p>";
					echo "<p>paypal checkout</p>";
				}


	
?>
 </section>
</div>
</div>

<div class="container">
 <h2>Whats New in Our Shop</h2><hr>

			 <?php
				$query = "SELECT * FROM product order by id desc limit 4";
				$run_query = mysql_query($query);
			
				while($row = mysql_fetch_assoc($run_query)){
				echo '  <div class="col col-lg-3 col-md-3 col-sm-3">';
					echo '<div class="panel panel-default">';
					echo '<div class="panel-body">';
					echo "<a href='product.php?prodid=".$row['id']."'><img width='100%' src='".$row['image']."'/></a>";
					echo ' </div>';
					echo "<div class=\"panel-footer\"><a href='product.php?prodid=".$row['id']."'>".$row['name']."</a><span class=\"badge pull-right\">R".number_format($row['unit_price'], 2)."</span></div>";
					echo ' </div>';
					
					echo ' </div>';
				}

			?>

</div>
			<?php
include 'includes/footer.php';
?>