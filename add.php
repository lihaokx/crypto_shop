<?php

	include('config/db_connect.php');

	$email = $cryptoName ='';
	$cryptoNumber = 0;
	$errors = array('email' => '', 'cryptoName' => '', 'cryptoNumber' => '');

	if(isset($_POST['submit'])){
		
		// check email
		if(empty($_POST['email'])){
			$errors['email'] = 'An email is required';
		} else{
			$email = $_POST['email'];
			if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
				$errors['email'] = 'Email must be a valid email address';
			}
		}

		// check title
		if(empty($_POST['cryptoName'])){
			$errors['cryptoName'] = 'A crypto name is required';
		} else{
			$title = $_POST['cryptoName'];
			// if(!preg_match('/^[a-zA-Z\s]+$/', $title)){
			// 	$errors['cryptoName'] = 'Title must be letters and spaces only';
			// }
		}

		// check ingredients
		if(empty($_POST['cryptoNumber'])){
			$errors['cryptoNumber'] = 'The number of crypto currency is required';
		} else{
			$cryptoNumber = $_POST['cryptoNumber'];
			// if(!preg_match('/^([a-zA-Z\s]+)(,\s*[a-zA-Z\s]*)*$/', $ingredients)){
				// $errors['cryptoNumber'] = 'Ingredients must be a comma separated list';
			// }
		}

		if(array_filter($errors)){
			//echo 'errors in form';
		} else {
			// escape sql chars
			$email = mysqli_real_escape_string($conn, $_POST['email']);
			$cryptoName = mysqli_real_escape_string($conn, $_POST['cryptoName']);
			$cryptoNumber = mysqli_real_escape_string($conn, $_POST['cryptoNumber']);

			// create sql
			$sql = "INSERT INTO currencies(cryptoName,email,cryptoNumber) VALUES('$cryptoName','$email','$cryptoNumber')";

			// save to db and check
			if(mysqli_query($conn, $sql)){
				// success
				header('Location: index.php');
			} else {
				echo 'query error: '. mysqli_error($conn);
			}
			
		}

	} // end POST check

?>

<!DOCTYPE html>
<html>
	
	<?php include('templates/header.php'); ?>

	<section class="container grey-text">
		<h4 class="center">Add an Order</h4>
		<form class="white" action="add.php" method="POST">
			<label>Your Email:</label>
			<input type="text" name="email" value="<?php echo htmlspecialchars($email) ?>">
			<div class="red-text"><?php echo $errors['email']; ?></div>
			<label for="cryptoName" >Name of coins:</label>
			<select name="cryptoName" id="cryptoName"  style="display: block;">
				<option value="Bitcoin">Bitcoin</option>
				<option value="Ethereum">Ethereum</option>
				<option value="XRP">XRP</option>
				<option value="Dogecoin">Dogecoin</option>
				<option value="Litecoin">Litecoin</option>
			</select>
			<div class="red-text"><?php echo $errors['cryptoName']; ?></div>
			<label>Number of coins</label>
			<input type="text" name="cryptoNumber" value="<?php echo htmlspecialchars($cryptoNumber) ?>">
			<div class="red-text"><?php echo $errors['cryptoNumber']; ?></div>
			<div class="center">
				<input type="submit" name="submit" value="Submit" class="btn brand z-depth-0">
			</div>
		</form>
	</section>

	<?php include('templates/footer.php'); ?>

</html>