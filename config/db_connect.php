<?php 

	// connect to the local database
	// $conn = mysqli_connect('localhost', 'haoli', 'going201', 'my_crypto');

	// connect to the deploy database
	$conn = mysqli_connect('localhost', 'lhlvth38_haoli', 'going201', 'lhlvth38_haoliSqlDatabase');

	// check connection
	if(!$conn){
		echo 'Connection error: '. mysqli_connect_error();
	}

?>