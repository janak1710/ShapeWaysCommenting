<?php
	// Error reporting:
	error_reporting(E_ALL^E_WARNING);
	include "connect.php";
	include "comment.class.php";
	$product_id = filter_input(INPUT_POST,'productName');
	$comments = array();
	$result = mysqli_query($link, "SELECT C.body, UC.username, C.create_time FROM Comment C 
JOIN User_credentials UC ON C.author_user_id = UC.user_id
JOIN Product P ON C.product_id = P.product_id 
WHERE P.product_id = ".$product_id."
ORDER BY comment_id ASC");
	
	if(mysqli_num_rows($result) > 0){
		while($row = mysqli_fetch_assoc($result)){
			$comments[] = new Comment($row);
		}

		$html = "";
		foreach($comments as $c){
			$html .= $c->markup();
		}

		echo json_encode(array('status'=>1,'html'=>$html));
	} else {
		echo '{"status":0}';
	}

	?>