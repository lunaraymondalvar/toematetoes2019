
<?php require_once '../partials/template.php'; ?>

<?php function get_page_content() { 

if(isset($_SESSION['user']) && $_SESSION['user']['roles_id'] == 1) {

global $conn;
?>

	<div class="container">
		<h4 class="text-center">User Admin Page</h4>
		<div class="row">
			<div class="col-sm-9 offset-sm-2">
				<table class="table table-responsive table-striped table-dark">
					<thead>
						<tr class="text-center">
							<td class="text-left">Username</td>
							<td class="text-left">First Name</td>
							<td class="text-left">Last Name</td>
							<td class="text-left">Email</td>
							<td class="text-left">Role</td>
							<td class="text-left">Action</td>
						</tr>
					</thead>
					<tbody>
						<?php 
						$get_user_detail_query = "SELECT u.id, u.username, u.firstname, u.lastname, u.email, r.name AS role FROM users u JOIN roles r ON (u.roles_id = r.id); ";
						$user_details = mysqli_query($conn, $get_user_detail_query);
						foreach ($user_details as $indiv_user) {
							// var_export($indiv_user);
						?>

						<tr>
							<td><?php echo $indiv_user['username']; ?></td> <!-- username -->
							<td><?php echo $indiv_user['firstname']; ?></td> <!-- firstname -->
							<td><?php echo $indiv_user['lastname']; ?></td> <!-- lastname -->
							<td><?php echo $indiv_user['email']; ?></td> <!-- email -->
							<td><?php echo $indiv_user['role']; ?></td> <!-- role -->
							<td>
								<?php 
								$id = $indiv_user['id'];
								if($indiv_user['role'] == "admin") {
									echo "<a href='../controllers/grant_admin.php?id=$id' class='btn btn-danger'> Revoke Admin </a>";
								} else {
									echo "<a href='../controllers/grant_admin.php?id=$id' class='btn btn-primary'> Make Admin </a>";
								}
								?>
							</td>
						</tr>
					<?php }; ?>
					</tbody>
				</table>
			</div> <!-- end of cols -->
		</div> <!-- end of row -->
	</div> <!-- end of container -->


<?php } else {
	header('Location: ./error.php');
} ?>

<?php } ?>