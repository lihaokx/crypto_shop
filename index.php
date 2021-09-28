<?php 

	include('config/db_connect.php');

	// write query for all coins
	$sql = 'SELECT cryptoName, cryptoNumber, id FROM currencies ORDER BY created_at';

	// get the result set (set of rows)
	$result = mysqli_query($conn, $sql);

	// fetch the resulting rows as an array
	$coins = mysqli_fetch_all($result, MYSQLI_ASSOC);

	// free the $result from memory (good practise)
	mysqli_free_result($result);

	// close connection
	mysqli_close($conn);


?>

<!DOCTYPE html>
<html>
	
	<?php include('templates/header.php'); ?>

	<h4 class="center grey-text">Coins!</h4>

	<div class="container" style="margin:40px auto -30px;">
		<div class="row">

			<?php foreach($coins as $coin): ?>

				<div class="col s6 m4">
					<div class="card z-depth-0" style="margin: 30px  0px">
						<!-- <i class="fa-brands fa-bitcoin"></i> -->
						<span style="font-size: 2em; color: #F8CC20;  margin: -40px 80px 0px ;">
							<i class="fab fa-bitcoin  fa-4x" style=" margin: -40px auto 0px ;"></i>
						</span>
						<div class="card-content center">
							<h5>Currency: <?php echo htmlspecialchars($coin['cryptoName']); ?></h5>
							<h5>Amount: <?php echo htmlspecialchars($coin['cryptoNumber']); ?> </h5>
 
						</div>
						<div class="card-action right-align">
							<a class="brand-text" href="details.php?id=<?php echo $coin['id'] ?>">more info</a>
						</div>
					</div>
				</div>

			<?php endforeach; ?>

		</div>
	</div>

	<?php include('templates/footer.php'); ?>

</html>