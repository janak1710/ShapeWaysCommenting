<?php
	// Error reporting:
	error_reporting(E_ALL^E_WARNING);
	include "connect.php";
	include "comment.class.php";
	session_start();
	
	if(!(isset($_SESSION["logged_in"]) && $_SESSION["logged_in"])){
		header("Location: login.php");
		exit;
	}
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><title>Simple AJAX Commenting System</title><script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
<script type="text/javascript" src="script.js"></script>
<link rel="stylesheet" type="text/css" href="styles.css" />
</head>
<body>
<h1>Simple AJAX Commenting System</h1>
<div class="topcorner"><a href="logout.php">Logout</a></div>
<div id="main">
  <div id="product">
<label for="productName">Select a Product</label>
    <select name="productName" id ="productName" form="addCommentForm">
      <?php 
	$sql = mysqli_query($link, "SELECT * FROM Product order by product_name ASC");
	while ($row = mysqli_fetch_assoc($sql)){
		echo "<option value=". $row['product_id'].">" . $row['product_name']. "</option>";
	}

	?>
    </select>
  </div>
  <div id ="comments"></div>
  <div id="addCommentContainer">
    <p>Add a Comment</p>
    <form id="addCommentForm" method="post" action="">
      <div>
        <label for="body">Comment Body</label>
        <textarea name="body" id="body" cols="20" rows="5"></textarea>
        <input type="submit" id="submit" value="Submit" />
      </div>
    </form>
  </div>
</div>
</body>
</html>