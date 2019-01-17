<?php require_once '../partials/template.php'; ?>

<?php function get_page_content() { 
	if(isset($_SESSION['user']) && $_SESSION['user']['roles_id'] == 1) {

	global $conn;
?>

<?php  

$item_id = $_GET['id'];
$sql = "SELECT * FROM items WHERE id = '$item_id' ";
$result = mysqli_query($conn, $sql);
$item = mysqli_fetch_assoc($result);
// var_dump($item);

?>

<div class="container">
	<div class="row">
		<div class="col-sm-8 offset-sm-2">
			<form action="../controllers/process_edit_item.php" method="POST">
				<div class="form-group">
					<label for="name">Name</label>
					<input type="text" class="form-control" name="name" value="<?php echo $item['name']; ?>" required>
				</div>

				<div class="form-group">
					<label for="price">Price</label>
					<input type="text" class="form-control" name="price" value="<?php echo $item['price']; ?>" required>
				</div>

				<div class="form-group">
					<label for="description">Description</label>
					<textarea class="form-control col-8" name="description" id="description" row="5"><?php echo $item['description']; ?></textarea>
				</div>

				<div class="form-group">
					<label for="price">Categories</label>
					<select class="form-control col-8" name="category_id" id="cateory" required>
						<?php 
						$sql = "SELECT * FROM categories";
						$categories = mysqli_query($conn, $sql);
						foreach ($categories as $category) {
							extract($category);

							$selected = $item['category_id'] == $id ? 'selected': ''; //ternary operator

							echo "<option value='$id' $selected>$name</option>";
						}

						?>
					</select>

				</div>


				<input type="hidden" name="id" value="<?php echo $item['id']; ?>">
				<button class="btn btn-primary" type="submit">Update Changes</button>

			</form> <!-- end of edit form -->
		</div>	
	</div>
</div>

<?php } else {
	header('Location: ./error.php');
} ?>


<?php } ?>