<?php 
	//Start the Session
	session_start();
	require('connect.php');
	$errors = array();
	// If the form is submitted
	
	if (empty($_POST['username'])){
		$errors['username'] = 'Please enter a username';
	}

	
	if(empty($_POST['password'])){
		$errors['password'] = 'Please enter a password';
	}

	
	if(empty($errors)){
		$username = $_POST['username'];
		$password = $_POST['password'];
		// Checking the values are existing in the database or not
		$query = "SELECT * FROM `User_credentials` WHERE username='$username' and password='$password'";
		$result = mysqli_query($link, $query) or die(mysqli_error($link));
		$count = mysqli_num_rows($result);
		// If the posted values are equal to the database values, then session will be created for the user.
		
		if ($count == 1){
			$row = mysqli_fetch_assoc($result);
			$_SESSION['user_id'] = $row['user_id'];
			$_SESSION['logged_in'] = true;
			$_SESSION['username'] = $username;
		} else {
			// If the login credentials doesn't match, he will be shown with an error message.
			$errors['username'] = 'Please enter valid credentials';
		}

	}

	
	if(!empty($errors)){
		echo '{"status":0,"errors":'.json_encode($errors).'}';
	} else {
		echo '{"status":1}';
	}

	?>