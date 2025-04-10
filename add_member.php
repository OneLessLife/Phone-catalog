<?php
	
	require_once "conn.php";
	require_once "functions.php";
	
	$message   = '';
	$firstname = '';
	$lastname  = '';
	$city      = '';
	$phone     = '';
	$admin = '';
	$pic_tag   = '';
		
	//if form is submited
	if($_POST){

		$firstname = $_POST['firstname'];
		$lastname  = $_POST['lastname'];
		$city      = $_POST['city'];
		$phone     = $_POST['phone'];
		$admin = $_POST['admin'];
		$query ="INSERT INTO  users 
					(firstname, lastname, city, phone,admin)
					VALUES
					('$firstname', '$lastname', '$city',  '$phone',  '$admin')";
					
		$result = mysqli_query($conn, $query) or die(mysqli_error($conn));
		$message  =  "RECORD ADDED SUCCESFULLY!";
		

		/************************************** PIC *************************************************/
		if(isset($_FILES['pic']))   {
			$img_path="./pics/";
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
		$admin = $row['admin'];
		$pic       = $row['pic'];
		$pic_tag   = '';
		if($pic){
			$pic_tag = "<img src='$pic' class='pic'>";
		}


		
	} //if($_POST)
	
?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title> ADD NEW MEMBER </title>
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
		background-color:purple;
		margin:auto;
	}
	
	form{
		width:60%;
		margin:auto;	
	}
	
	#preview{
		margin-top:12px;
		color:white;
		font-family:Tahoma;
	}
</style>
</head>

<body>
<div id="wrapper">
  <h1> ADD NEW MEMBER FORM </h1>
	
    <form action="<?= $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data">
      
      <label for="firstname">Firstname</label>
      <input type="text" name="firstname" id="firstname" value="<?= $firstname ?>" required>
      
      <label for="lastname">Lastname</label>
      <input type="text" name="lastname" id="lastname" value="<?= $lastname ?>" required>
      
      
      <label for="city">City</label>
      <input type="text" name="city" id="city" value="<?= $city ?>">
      
      <label for="phone">Phone</label>
      <input type="text" name="phone" id="phone" value="<?= $phone ?>">
	  
	  <label for="admin">Admin</label>
      <input type="text" name="admin" id="admin" value="<?= $admin ?>">
      <br><br>
      
      <div class="pic"> <?= $pic_tag ?> </div>
	  <br><br>
      
      <input name="pic" id="pic" type="file" accept="image/*" onchange="loadFile(event)">
		<br>
		<div id="preview"></div>
		<img id="output" width="100">
		<br><br>

      <input type="submit" name="submit" id="submit" value="Add member">
      
    </form>

</div>
<br><br>
<div align="center"> <?= $message ?></div>
<br><br>
<div align="center"> <a href="admin1.php"> Go to index </a> </div>



<script>
  var loadFile = function(event) {
	 document.getElementById('preview').innerHTML = "Photo preview";
    var output = document.getElementById('output');
    output.src = URL.createObjectURL(event.target.files[0]);
    output.onload = function() {
      URL.revokeObjectURL(output.src) // free memory
    }
  };
</script>
</body>
</html>