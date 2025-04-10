<?php
	session_start();
	require_once "conn.php"; //εναλλακτικες εντολες [include, require, include_once]
	//message for user after login attempt
	$message = '';
	
	//if post data exist
	if($_POST){
		//read field values
		$firstname='';
		if(isset($_POST['firstname'])){
			$firstname = $_POST['firstname'];
		}
		
		$admin='';
		if(isset($_POST['admin'])){
			$admin = $_POST['admin'];
		}	
		
		if($firstname && $admin){
			//build query
			$query = "SELECT * FROM users 
						WHERE 
						firstname='$firstname' 
						AND 
						admin='$admin' ";
						
			//execute query - $conn is initialised in conn.php
			$result = mysqli_query($conn, $query) or die(mysqli_error($conn));
			//number of records retreived
			$found = mysqli_num_rows($result);
			
			if($found){
				//initialise session variable
				$_SESSION['admin'] = "secret";
				//redirect to protected area
				header("location:admin1.php");
			}
			else {
				//set message for user
				$message = "Login failed. Please try again.";
			}
		}
		
		
		
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Phone Catalog</title>
  <link rel="stylesheet" href="style.css">
  <meta content="text/html; charset=iso-8859-2" http-equiv="Content-Type">
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
</head>
<body>
  <div class="wrapper">
    <nav>
      <input type="checkbox" id="show-search">
      <input type="checkbox" id="show-menu">
      <label for="show-menu" class="menu-icon"><i class="fas fa-bars"></i></label>
      <div class="content">
      <div class="logo"><a href="#">11880</a></div>
        <ul class="links">
          <li><a href="index2.php">Home</a></li>
		  <li><a href="edit-delete_CLIENT.php">Browse</a></li>
          <li>
            <a href="contact-form.php">Contact</a>
          </li>
		  <li><a href,button onclick="document.getElementById('id01').style.display='block'" style="width:auto;">Login</button>
</li></a>
<div id="id01" class="modal">
  
  <form class="modal-content animate" action="" method="post">
    <div class="imgcontainer">
      <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
    </div>
	<form action="<?php print $_SERVER['PHP_SELF'] ?>" method="post">
    <div class="container">
      <label for="firstname"><b>Firstname</b></label>
      <input type="text" name="firstname" id="firstname" value="" placeholder="firstname" required>

      <label for="admin"><b>Admin</b></label>
      <input type="text" name="admin" id="admin" value="" placeholder="admin" required>
        
      <button type="submit">Login</button>
    </div>
    <div class="container" style="background-color:#f1f1f1">
      <button type="button" onclick="document.getElementById('id01').style.display='none'" class="cancelbtn">Cancel</button>
      <span class="psw">Forgot <a href="#">password?</a></span>
    </div>
  </form>
</div>
</form>
<script>
var modal = document.getElementById('id01');

window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
</script>

                </ul>
      </div>
	  <label for="show-search" class="search-icon"><i class="fas fa-search"></i></label>
      <form action="edit-delete_CLIENT.php" class="search-box" method="post">
        <input type="text" name="search" placeholder="Type Something to Search..." required>
        <button type="submit" class="go-icon"><i class="fas fa-long-arrow-alt-right"></i></button>
    </nav>
  </div>
<br><br><br><br>
<div class="" style="max-width:1000px">
  <img class="mySlides" src="call1.jpg" style="width:100%">
  <img class="mySlides" src="call2.jpg" style="width:100%">
  <img class="mySlides" src="call3.jpg" style="width:100%">
</div>

<script>
var myIndex = 0;
carousel();

function carousel() {
  var i;
  var x = document.getElementsByClassName("mySlides");
  for (i = 0; i < x.length; i++) {
    x[i].style.display = "none";  
  }
  myIndex++;
  if (myIndex > x.length) {myIndex = 1}    
  x[myIndex-1].style.display = "block";  
  setTimeout(carousel, 3000); // Change image every 2 seconds
}
</script>
</body>
</html>
