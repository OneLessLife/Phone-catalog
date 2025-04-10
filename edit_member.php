<?php
	
	require_once "conn.php";
	require_once "functions.php";

	
	$message = '';  //message to tell user about record update status
	
	//if form is submited
	if($_POST){
		
		$id        = $_POST['id'];
		$firstname = $_POST['firstname'];
		$lastname  = $_POST['lastname'];
		$city      = $_POST['city'];
		$phone     = $_POST['phone'];
		
		$query ="UPDATE users 
				 SET
				 id = '$id',
				 firstname= '$firstname',
				 lastname = '$lastname',
				 city     = '$city',
				 phone    = '$phone' 
				 WHERE 
				 id = '$id' ";
		$result = mysqli_query($conn, $query) or die(mysqli_error($conn));
		
		$message  =  "RECORD UPDATED";
	}
	
	
	
	
	//if http request contains parameter named id
	if(isset($_REQUEST['id'])){
		$id = $_REQUEST['id'];
		$query = "SELECT * FROM users WHERE id = '$id' ";
		$result = mysqli_query($conn, $query) or die(mysqli_error($conn));
		
		$row = mysqli_fetch_assoc($result);
		$id = $row['id'];
		$firstname = $row['firstname'];
		$lastname  = $row['lastname'];
		$city      = $row['city'];
		$phone     = $row['phone'];
		$pic       = $row['pic'];
		$pic_tag   = '';
		if($pic){
			$pic_tag = "<img src='$pic' class='pic'>";
		}
	
		
	}
	

	if(isset($_FILES['pic']))   {
		$img_path=".";
		$posted='pic'; 
		if ($_FILES[$posted]['name']){	
			$uploaded_file = upload($posted, $img_path); 
			if ($uploaded_file){ 
				$query="UPDATE users SET pic='$uploaded_file' WHERE users.firstname='$firstname' "; 
				mysqli_query($conn, $query) or die($query.":".mysqli_error($conn));		
			}
			else {
				$message  .= " - USER IMAGE FAILED TO UPLOAD.";
			}
		}		
	}
	/************************************** /PIC/ *************************************************/


	$query = "SELECT * FROM users WHERE firstname = '$firstname' ";
	$result = mysqli_query($conn, $query) or die(mysqli_error($conn));
	
	$row = mysqli_fetch_assoc($result);
	$firstname = $row['firstname'];
	$lastname  = $row['lastname'];
	$city      = $row['city'];
	$phone     = $row['phone'];
	$pic       = $row['pic'];
	$pic_tag   = '';
	if($pic){
		$pic_tag = "<img src='$pic' class='pic'>";
	}


	
 //if($_POST)

?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title> EDIT MEMBER FORM </title>
<style>
	h1{
		text-align:center;	
		color:white;
		font-family:Tahoma;
	}
	
	label{
		display:block;
		margin-top:20px;
		font-size:20px;
		font-family:Tahoma;
		color:white;
	}
	
	input[type="text"]{
		font-size:20px;
		font-family:Tahoma;
		padding:5px;
		color:gray;	
		width:100%;
	}
	
	#wrapper{
		width:500px;
		padding:20px;
		background-color:#09C;
		margin:auto;
	}
	
	form{
		width:60%;
		margin:auto;	
	}
</style>
</head>

<body>


<div id="wrapper">
  <h1> EDIT MEMBER FORM </h1>
	
    <form action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
    
      <label for="id">ID</label>
      <input type="text" name="id" id="id" readonly value="<?= $id ?>">
      
      <label for="firstname">Firstname</label>
      <input type="text" name="firstname" id="firstname" value="<?= $firstname ?>">
      
      <label for="lastname">Lastname</label>
      <input type="text" name="lastname" id="lastname" value="<?= $lastname ?>">
      
      
      <label for="city">City</label>
      <input type="text" name="city" id="city" value="<?= $city ?>">
      
      <label for="phone">Phone</label>
      <input type="text" name="phone" id="phone" value="<?= $phone ?>">
      <br><br>
      
      <div class="pic"> <?= $pic_tag ?> </div>
	  <br><br>
      
      <input name="pic" id="pic" type="file" accept="image/*" onchange="loadFile(event)">
		<br>
		<div id="preview"></div>
		<img id="output" width="100">
	  <br>

      <input type="submit" name="submit" id="submit" value="Update">
      
    </form>

</div>
<br><br>
<div align="center"> <?= $message ?></div>
<br><br>
<div align="center"> <a href="admin1.php"> Go to index </a> </div>
</body>
</html>