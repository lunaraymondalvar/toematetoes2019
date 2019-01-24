<?php require_once '../partials/template.php'; ?>

<?php function get_page_content() { 
	if(!isset($_SESSION['user']) || (isset($_SESSION['user'])) && $_SESSION['user']['roles_id'] == 2) {
	global $conn;
	?>
	<div class="container my-4">
		<div class="row">
			<div class="col-12">
				<h1>Cart Page</h1>
			</div>
		</div> <!-- end row -->
		<hr>

		<div class="table-responsive">
			<table class="table table-striped table-bordered">
				<thead>
					<tr class="text-center">
						<th>Item Name</th>
						<th>Item Price</th>
						<th>Item Quantity</th>
						<th>Item Image</th>
						<th>Item Subtotal</th>
						<th>Actions</th>
					</tr>
				</thead>

				<tbody>

					<?php 

					// var_dump($_SESSION['cart']);

						if(isset($_SESSION['cart']) && count($_SESSION['cart']) !=0) {

							$cart_total = 0;
							foreach ($_SESSION['cart'] as $id => $qty) {
								$sql = "SELECT * FROM items WHERE id ='$id' ";

								$result = mysqli_query($conn, $sql);
								$item = mysqli_fetch_assoc($result);
								$subTotal = $_SESSION['cart'][$id] * $item['price'];
								$cart_total += $subTotal;
					 ?>		
						<tr>
							<td class="item_name text-center"> <?php echo $item['name']; ?></td>
							<td class="item_price text-center"> <?php echo $item['price']; ?></td>
							<td class="item_quantity"> 
								<input type="number" value="<?php echo $qty; ?>" class="form-control text-right" data-id="<?php echo $id; ?>" min="1" >
							</td>
							<td>
								<img src="<?php echo $item['image_path']; ?>" class="img-fixed d-block">
							</td>
							<td class="item_subtotal text-center"> <?php echo $subTotal; ?></td>
							<td class="item_action text-center">
								<button class="btn btn-danger item-remove" data-id="<?php echo $id; ?>">Remove from cart</button>
							</td>
						</tr>
					<?php } ?>
				</tbody>
				<tfoot>
					<tr>
						<td class="text-right font-weight-bold" colspan="4">Total</td>
						<td class="text-right font-weight-bold" id="total_price">
							<?php echo $cart_total; ?>
						</td>
						
						<td class="text-center">
							<a href="./checkout.php" class="btn btn-primary">Proceed to checkout</a>
						</td>

					</tr>
				</tfoot>
				
				<?php 
					} else {
						echo '<tr>
								<td class="text-center" colspan="6"> No items in the cart </td>
							  </tr>
						';
					}

				 ?>
			</table>
		</div>		
	</div> <!-- end contianer -->

	<?php } else {
	header('Location: ./error.php');
	} ?>

	


<?php } ?>