<?php
	// Error reporting:
	error_reporting(E_ALL^E_WARNING);
	include "connect.php";
	include "comment.class.php";
	/*
	/	This array is going to be populated with either
	/	the data that was sent to the script, or the
	/	error messages.
	/*/
	$arr = array();
	$validates = Comment::validate($arr);
	
	if($validates){
		/* Everything is OK, insert to database: */
		session_start();
		$arr['user_id'] = $_SESSION['user_id'];
		$arr['username'] = $_SESSION['username'];
		mysqli_query($link, "INSERT INTO Comment(body,author_user_id, product_id)
					VALUES (
						'".$arr['body']."', ".$arr['user_id'].", ".$arr['product_id']."
					)");
		/*
		/	The data in $arr is escaped for the mysql query,
		/	but we need the unescaped variables, so we apply,
		/	stripslashes to all the elements in the array:
		/*/
		$arr['create_time'] = date('r',time());
		$arr = array_map('stripslashes',$arr);
		$insertedComment = new Comment($arr);
		/* Outputting the markup of the just-inserted comment: */
		echo json_encode(array('status'=>1,'html'=>$insertedComment->markup()));
	} else {
		/* Outputtng the error messages */
		echo '{"status":0,"errors":'.json_encode($arr).'}';
	}

	?>