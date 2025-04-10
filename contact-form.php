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
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
body {font-family: Arial, Helvetica, sans-serif;}
* {box-sizing: border-box;}

input[type=text], select, textarea {
  width: 100%;
  padding: 12px;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
  margin-top: 6px;
  margin-bottom: 16px;
  resize: vertical;
}

input[type=submit] {
  background-color: red;
  color: white;
  padding: 12px 20px;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}

input[type=submit]:hover {
  background-color: #45a049;
}

.container {
  border-radius: 5px;
  background-color: #f2f2f2;
  padding: 20px;
}
h2{
	text-align:center;
}
</style>
 <link rel="stylesheet" href="style.css">
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
// Get the modal
var modal = document.getElementById('id01');

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
</script>

                </ul>
      </div>
      </form>
    </nav>
  </div>

<br><br><br><br><br><br><br>

<div class="container">
  <form action="/action_page.php">
    <label for="firstname">First Name</label>
    <input type="text" id="fname" name="firstname" placeholder="Your name..">

    <label for="lastname">Last Name</label>
    <input type="text" id="lname" name="lastname" placeholder="Your last name..">

    <label for="city">City</label>
    <select id="city" name="city">
      <option value="Athens">Athens</option>
      <option value="Thessaloniki">Thessaloniki</option>
      <option value="Larisa">larisa</option>
    </select>

    <label for="subject">Subject</label>
    <textarea id="subject" name="subject" placeholder="Write something.." style="height:200px"></textarea>

    <input type="submit" value="Submit">
  </form>
</div>

</body>
</html>
